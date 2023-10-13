@include('partials.header')
<section class="flex flex-row w-full h-screen text-sm bg-mainwhitebg md:text-base">
    @include('partials.instructorNav')
    @include('partials.instructorSidebar')
    
    {{-- MAIN --}}
    <section class="w-full pt-[120px] mx-2  overscroll-auto md:overflow-auto">
        <div class="pb-4 mb-8 rounded-lg shadow-lg">
            {{-- header --}}
            <div class="relative px-2 rounded-t-lg bg-seagreen text-mainwhitebg">
                <button class="my-2 bg-gray-400 rounded-full ">
                    <svg  xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="M560-240 320-480l240-240 56 56-184 184 184 184-56 56Z"/></svg>
                </button>
                <h1 class="w-1/2 text-xl font-semibold">Business Administration</h1>
                <p>Instructor 1</p>
                <p class="opacity-50">000000</p>
                <button class="absolute bottom-0 right-0 w-16 py-2 m-2 text-black rounded bg-mainwhitebg">
                    <h1>Edit</h1>
                </button>
            </div>

            {{-- main content --}}
            <div class="px-2">
                {{-- overview --}}
                <div class="mb-4">
                    <div class="flex items-center justify-between my-4 border-b-2 border-seagreen">
                        <div class="relative flex items-center">
                            <svg class="absolute left-0 border-2 border-black rounded-full p-[2px]" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 32 32"><path fill="currentColor" d="M19 10h7v2h-7zm0 5h7v2h-7zm0 5h7v2h-7zM6 10h7v2H6zm0 5h7v2H6zm0 5h7v2H6z"/><path fill="currentColor" d="M28 5H4a2.002 2.002 0 0 0-2 2v18a2.002 2.002 0 0 0 2 2h24a2.002 2.002 0 0 0 2-2V7a2.002 2.002 0 0 0-2-2ZM4 7h11v18H4Zm13 18V7h11v18Z"/></svg>
                        
                            <h1 class="pl-[30px] text-base font-medium">Lesson 1: Introduction to Business Administration</h1>
                        </div>
                        
                        <svg class="cursor-pointer" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="M80 0v-160h800V0H80Zm80-240v-150l362-362 150 150-362 362H160Zm80-80h36l284-282-38-38-282 284v36Zm477-326L567-796l72-72q11-12 28-11.5t28 11.5l94 94q11 11 11 27.5T789-718l-72 72ZM240-320Z"/></svg>
                    </div>
                </div>
                
                {{-- course --}}
                <div>
                    <div class="h-40 my-4 bg-gray-200 rounded-lg shadow">
                        
                    </div>
                    <div class="my-2 mb-8">
                        <h1 class="text-lg font-medium">What is business?</h1>
                        <p class="pl-4 text-justify">This course provides an overview of the fundamentals of business administration, including key concepts, functions, and processes. Students will develop a solid understanding of various aspects of business operations, management, and decision-making.</p>
                    </div>
                    <div class="my-2 mb-4">
                        <h1 class="text-lg font-medium">Defining Business and it's Key Components</h1>
                        <p class="pl-4 text-justify">This course provides an overview of the fundamentals of business administration, including key concepts, functions, and processes. Students will develop a solid understanding of various aspects of business operations, management, and decision-making.</p>
                    </div>

                    <button class="flex items-center w-full py-4 mt-4 rounded-lg shadow-lg ring-2 ring-seagreen" id="lessonAddContent">
                        <svg class="mx-2" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="M440-440H200v-80h240v-240h80v240h240v80H520v240h-80v-240Z"/></svg>
                        <h1>Add New Content</h1>
                    </button>

                    
                    
                    <div class="flex justify-end w-full">
                        <button class="w-1/2 py-2 mt-4 text-white rounded-lg shadow-lg bg-seagreen">
                            <h1>Save</h1>
                        </button>
                    </div>             
                </div>
            </div>
        </div>
    </section>

    <div class="fixed z-50 flex items-center hidden w-full h-screen bg-white bg-opacity-50" aria-hidden="true" id="lessonNewContent">
        <div class="relative w-full pt-8 m-auto mx-4 rounded shadow-lg bg-seagreen h-1/2" id="lessonChildContent">
            <svg class="absolute top-0 right-0 m-4 cursor-pointer" id="lessonNewContentCloseSVG" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="m256-200-56-56 224-224-224-224 56-56 224 224 224-224 56 56-224 224 224 224-56 56-224-224-224 224Z"/></svg>
            
            <div class="flex flex-col m-4">
                <input class="h-8 px-2 rounded" type="text" placeholder="Enter Title">
            </div>

            <div class="m-4">
                <textarea class="w-full h-32 px-2 rounded resize-none" name="" id=""  placeholder="Enter Content"></textarea>
            </div>

            <div class="flex items-center justify-end mx-4">
                <button class="w-16 py-2 mx-1 bg-gray-300 rounded-lg shadow-lg" id="lessonNewContentCloseBtn">
                    <h1>Close</h1>
                </button>
                <button class="w-16 py-2 mx-1 text-white rounded-lg shadow-lg bg-darthmouthgreen">
                    <h1>Save</h1>
                </button>
            </div>
        </div>
    </div>
</section>
@include('partials.footer')