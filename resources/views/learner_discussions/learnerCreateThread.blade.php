@include('partials.header')

<section class="flex flex-row w-full h-screen text-sm main-container bg-mainwhitebg md:text-base">
    @include('partials.instructorNav')
    @include('partials.learnerSidebar')

            {{-- MAIN --}}
    <section class="w-full px-2 pt-[120px] mx-2 mt-2 md:w-3/4 lg:w-9/12  overscroll-auto md:overflow-auto">
        <div class="px-3 pb-4 overflow-auto rounded-lg shadow-lg b overscroll-auto">
            <a href="{{ url("/instructor/discussions") }}" class="my-2 bg-gray-300 rounded-full ">
                <svg  xmlns="http://www.w3.org/2000/svg" height="30" viewBox="0 -960 960 960" width="24"><path d="M560-240 320-480l240-240 56 56-184 184 184 184-56 56Z"/></svg>
            </a>
            <h1 class="mx-5 text-2xl font-semibold md:text-3xl">DISCUSSION FORUMS</h1>
            <h1 class="mx-5 text-2xl mt-5 font-semibold md:text-2xl">Create a Discussion</h1>
            <hr class="border-t-2 border-gray-300 my-6">
            
            <div class="w-full my-3 px-40 pt-5" id="mainContainer">
                <div class="w-3/5" id="selectCommunityArea">
                    <label for="">Choose a group to post:</label>
                    <select name="" class="w-full py-3 text-lg px-3 border-2 border-darthmouthgreen rounded-xl" id="selectCommunity">
                        <option value="0" selected>All</option>
                        @foreach ($courses as $course)
                            <option value="{{ $course->course_id }}">{{ $course->course_name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class=" w-full mt-5 border-2 border-darthmouthgreen border-opacity-60 rounded-lg p-5" id="threadContentArea">
                    <div class="w-full flex" id="threadContentCategoryArea">
                        <button class="w-1/3 py-3 px3 bg-darthmouthgreen hover:bg-green-950 text-white text-lg discussionBtn_selected" id="textCategoryBtn">Post/Text</button>
                        <button class="w-1/3 py-3 px3 bg-darthmouthgreen hover:bg-green-950 text-white text-lg" id="photoCategoryBtn">Photo</button>
                        <button class="w-1/3 py-3 px3 bg-darthmouthgreen hover:bg-green-950 text-white text-lg" id="urlCategoryBtn">Link</button>
                    </div>

                    <div class="mt-5" id="threadTitleArea" style="display: flex; flex-direction: column;">
                        <label class="text-lg px-3" for="threadTitle_text" id="threadTitle_lbl">Title</label>
                        <div style="display: flex; position: relative;">
                            <textarea maxlength="300" class="mt-1 text-lg px-3 py-3 w-full border-2 border-darthmouthgreen border-opacity-60 rounded-lg" id="threadTitle_text" placeholder="Title" oninput="updateCharacterCount(this)"></textarea>
                            <span id="characterCount" class="text-sm px-3 py-2 text-gray-500" style="position: absolute; bottom: 0; right: 0;">0/300</span>
                        </div>
                    </div>
                    
                    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
                    <script>
                        function updateCharacterCount(textarea) {
                            const maxLength = 300;
                            const currentLength = $(textarea).val().length;
                            const remainingLength = maxLength - currentLength;
                    
                            if (remainingLength >= 0) {
                                $("#characterCount").text(currentLength + '/' + maxLength);
                            } else {
                                // If the user exceeds the limit, truncate the textarea value
                                $(textarea).val($(textarea).val().substring(0, maxLength));
                            }
                        }
                    </script>


                    <div class="mt-5" id="threadContent">
                        <div class="" id="textContent">
                            <textarea name="" class="p-3 w-full h-[300px] min-h-[300px] border-2 border-darthmouthgreen border-opacity-60 rounded-lg text-lg" id="threadContent_text" placeholder="text"></textarea>
                        </div>
                    </div>
                    <div class="w-full flex justify-end mt-5" id="postBtnArea">
                        <button class="py-5 px-8 bg-darthmouthgreen hover:bg-green-950 text-xl text-white rounded-xl" id="postBtn">POST</button>
                    </div>
                </div>

                
            </div>
            


        </div>
    </section>

    <div id="loaderModal" class="hidden fixed top-0 left-0 flex items-center justify-center w-full h-full bg-gray-200 bg-opacity-75 modal">
        <div class="modal-content flex flex-col justify-center items-center p-20 bg-white p-4 rounded-lg shadow-lg w-[500px]">
            <div class="three-body">
                <div class="three-body__dot"></div>
                <div class="three-body__dot"></div>
                <div class="three-body__dot"></div>
            </div>
            
        <p class="mt-5 text-xl text-darthmouthgreen">loading</p>  
        </div>
    </div>


    <div id="successModal" class="hidden fixed top-0 left-0 flex items-center justify-center w-full h-full bg-gray-200 bg-opacity-75 modal">
        <div class="modal-content flex flex-col justify-center items-center p-20 bg-white p-4 rounded-lg shadow-lg w-[500px]">
            <i class="fa-regular fa-circle-check text-[75px] text-darthmouthgreen"></i>
            <p class="mt-5 text-xl text-darthmouthgreen">Successful</p>  
        </div>
    </div>


    <div id="errorModal" class="hidden fixed top-0 left-0 flex items-center justify-center w-full h-full bg-gray-200 bg-opacity-75 modal">
        <div class="modal-content flex flex-col justify-center items-center p-20 bg-white p-4 rounded-lg shadow-lg w-[500px]">
            <i class="fa-regular fa-circle-xmark text-[75px] text-red-500"></i>
            <p class="mt-5 text-xl text-darthmouthgreen">Error</p>  
        </div>
    </div>
@include('partials.learnerProfile')
</section>
@include('partials.footer')