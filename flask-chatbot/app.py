from flask import Flask, request, jsonify
import os
from PyPDF2 import PdfReader
from langchain.text_splitter import CharacterTextSplitter
from langchain_openai import OpenAIEmbeddings
from langchain_community.vectorstores import FAISS
from dotenv import load_dotenv
from collections import defaultdict
import shutil
from langchain_openai import ChatOpenAI
from langchain.memory import ConversationBufferMemory
from langchain.chains import ConversationalRetrievalChain
from langchain.memory import ChatMessageHistory


# Load environment variables from .env file
load_dotenv()

app = Flask(__name__)
session_data = defaultdict(dict)
def get_pdf_text(pdf_docs):
    texts = ""
    for pdf in pdf_docs:
        pdf_reader = PdfReader(pdf)
        for page in pdf_reader.pages:
            texts += page.extract_text()
    return texts


def get_text_chunks(text):
    text_splitter = CharacterTextSplitter(
        separator="\n",
        chunk_size=1000,
        chunk_overlap=200,
        length_function=len
    )
    chunks = text_splitter.split_text(text)
    return chunks

session_vector_stores = defaultdict(FAISS)

def get_vectorstore(session_id, text_chunks):
    if session_id in session_vector_stores:
        # Reset existing vector store
        del session_vector_stores[session_id]

    embeddings = OpenAIEmbeddings()
    session_vector_stores[session_id] = FAISS.from_texts(texts=text_chunks, embedding=embeddings)
    
    return session_vector_stores[session_id]


def get_conversation_chain(vectorstore):
    llm = ChatOpenAI()

    memory = ConversationBufferMemory(
        memory_key='chat_history', return_messages=True)
    
    conversation_chain = ConversationalRetrievalChain.from_llm(
        llm=llm,
        retriever=vectorstore.as_retriever(),
        memory=memory
    )
    return conversation_chain


def process_message(session_id, user_message):
    # Check if the session ID exists in the session_vector_stores
    if session_id not in session_vector_stores:
        return jsonify({'error': 'Session ID not found'})

    # Get the vector store for the session
    vectorstore = session_vector_stores[session_id]
    
    # # Initialize ChatMessageHistory
    # chat_history = ChatMessageHistory()

    # Get the conversation chain for the session
    conversation_chain = get_conversation_chain(vectorstore)
    
    user_message_with_instructions = f"!instructions! Act like a friendly tutor teaching a learner. Make it short as much as possible. When explaining the lessons, you can include the context from the learner data like the business or the course performance. {user_message}"


    # Add the user's message to the chat history
    # chat_history.add_user_message(user_message)

    # Invoke the conversation chain with the user's message and chat history
    response = conversation_chain({
        "question": user_message_with_instructions, 
    })
    
    
    chat_history = response['chat_history']
    
    for i, message in enumerate(chat_history):
        if i % 2 == 0:
            user_question = message.content
        else:
            ai_response = message.content

    # Extract the AI's response from the chain's output
    # ai_response = response['output']

    # Add the AI's response to the chat history
    # chat_history.add_ai_message(ai_response)

    # Return the AI's response
    return ai_response



@app.route('/upload/<session_id>', methods=['POST'])
def upload(session_id):
    # Create a folder for the specified session ID if it doesn't exist
    session_folder = os.path.join('data', session_id)
    os.makedirs(session_folder, exist_ok=True)

    uploaded_files = request.files.getlist('files')
    file_names = []
    extracted_texts = ""
    file_paths = []
    for file in uploaded_files:
        # Save the file to the session folder
        file_path = os.path.join(session_folder, file.filename)
        file.save(file_path)
        # Add the file name to the list
        file_names.append(file.filename)
        file_paths.append(file_path)
        
    extracted_texts = get_pdf_text(file_paths)

    # Get the text chunks
    chunks = get_text_chunks(extracted_texts)

    # Create vector store
    vectorstore = get_vectorstore(session_id, chunks)

    # Store the PDF files and vector store for this session
    session_data[session_id]['files'] = file_names
    session_data[session_id]['vectorstore'] = vectorstore

    return jsonify({
        'file_names': file_names,
        'extracted_texts': extracted_texts,
        # 'vector_stores': vectorstore,
    })




@app.route('/add_file/<session_id>', methods=['POST'])
def add_file(session_id):
    # Check if the session ID exists in the session_vector_stores
    if session_id not in session_vector_stores:
        return jsonify({'error': 'Session ID not found'})

    # Get the uploaded files
    uploaded_files = request.files.getlist('files')
    if not uploaded_files:
        return jsonify({'error': 'No file uploaded'})

    session_folder = os.path.join('data', session_id)
    os.makedirs(session_folder, exist_ok=True)
    
    file_names = []
    extracted_texts = ""
    file_paths = []
    
    for file in uploaded_files:
        # Save the file to the session folder
        file_path = os.path.join(session_folder, file.filename)
        file.save(file_path)
        # Add the file name to the list
        file_names.append(file.filename)
        file_paths.append(file_path)

    # Get the text chunks from the newly added files
    extracted_texts = get_pdf_text(file_paths)
    new_chunks = get_text_chunks(extracted_texts)

    # Get the existing text chunks
    existing_chunks = []
    if 'files' in session_data[session_id]:
        existing_files = session_data[session_id]['files']
        existing_file_paths = [os.path.join(session_folder, filename) for filename in existing_files]
        existing_texts = get_pdf_text(existing_file_paths)
        existing_chunks = get_text_chunks(existing_texts)

    # Combine the existing and new chunks
    all_chunks = existing_chunks + new_chunks

    # Create a new vector store with all chunks
    vectorstore = get_vectorstore(session_id, all_chunks)

    # Update the session data with the new files and vector store
    session_data[session_id]['files'] = file_names
    session_data[session_id]['vectorstore'] = vectorstore
    
    return jsonify({'message': 'Files added successfully'})


@app.route('/process_files/<session_id>', methods=['GET'])
def process_files(session_id):
    # Check if the session ID exists in the session_data dictionary
    if session_id not in session_data:
        return jsonify({'error': 'Session ID not found'})

    # Get the list of files for the session
    session_folder = os.path.join('data', session_id)
    session_files = session_data[session_id]['files']
    file_paths = [os.path.join(session_folder, file_name) for file_name in session_files]

    # Get the text from the files
    extracted_texts = get_pdf_text(file_paths)

    # Get the text chunks
    chunks = get_text_chunks(extracted_texts)

    # Create vector store
    vectorstore = get_vectorstore(session_id, chunks)

    # Update the session_data with the new files and vector store
    session_data[session_id]['vectorstore'] = vectorstore

    return jsonify({'message': 'Files processed successfully'})




@app.route('/reset/<session_id>', methods=['POST'])
def reset(session_id):
    # Check if the session ID exists in the session_vector_stores
    if session_id in session_vector_stores:
        # Delete the session data
        del session_vector_stores[session_id]

        # Delete the session directory
        session_folder = os.path.join('data', session_id)
        if os.path.exists(session_folder):
            # Remove files in the directory
            for filename in os.listdir(session_folder):
                file_path = os.path.join(session_folder, filename)
                try:
                    if os.path.isfile(file_path):
                        os.unlink(file_path)
                except Exception as e:
                    return jsonify({'error': f'Failed to delete file: {str(e)}'})

            # Remove the directory
            try:
                os.rmdir(session_folder)
            except Exception as e:
                return jsonify({'error': f'Failed to delete directory: {str(e)}'})

            return jsonify({'message': f'Session {session_id} reset successfully'})
        else:
            return jsonify({'error': 'Session directory not found'})
    else:
        return jsonify({'error': 'Session ID not found'})

@app.route('/chat/<session_id>', methods=['POST'])
def chat(session_id):
    # Check if the session ID exists in the session_vector_stores
    if session_id not in session_vector_stores:
        return jsonify({'error': 'Session ID not found'})

    # Get the user's message from the request
    user_message = request.json.get('question', '')

    # Process the message
    ai_response = process_message(session_id, user_message)

    # Return the AI's response
    return jsonify({'message': ai_response})

if __name__ == '__main__':
    app.run(debug=True)
