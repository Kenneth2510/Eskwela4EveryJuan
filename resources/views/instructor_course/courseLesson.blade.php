@include('partials.header')
<section class="flex flex-row w-full h-screen text-sm bg-mainwhitebg md:text-base">
    @include('partials.instructorNav')
    @include('partials.instructorSidebar')
    
    {{-- MAIN --}}
    <section class="w-full px-2 mt-2 mx-2 md:overflow-auto md:w-3/4 lg:w-9/12 md:pt-20">
        @php
        if (!function_exists('getRandomColor')) {
            function getRandomColor() {
            return '#' . str_pad(dechex(mt_rand(0, 0xFFFFFF)), 6, '0', STR_PAD_LEFT);
            }
        }
        
        // Generate a random color for mainBackgroundCol
        $mainBackgroundCol = getRandomColor();

        // Darken the mainBackgroundCol
        $mainColorRGB = sscanf($mainBackgroundCol, "#%02x%02x%02x");
        $mainBackgroundCol = sprintf("#%02x%02x%02x", $mainColorRGB[0] * 0.6, $mainColorRGB[1] * 0.6, $mainColorRGB[2] * 0.6);

        // Darken the mainBackgroundCol further for darkenedColor
        $darkenedColor = sprintf("#%02x%02x%02x", $mainColorRGB[0] * 0.4, $mainColorRGB[1] * 0.4, $mainColorRGB[2] * 0.4);
        @endphp

        
        <div style="background-color:{{$mainBackgroundCol}};" class="rounded-xl z-50 p-2  text-white">
            <a href="{{ url("/instructor/course/content/$course->course_id") }}" class="my-2 bg-gray-300 rounded-full ">
                <svg  xmlns="http://www.w3.org/2000/svg" height="30" viewBox="0 -960 960 960" width="24"><path d="M560-240 320-480l240-240 56 56-184 184 184 184-56 56Z"/></svg>
            </a>
            <h1 class="w-1/2 py-4 text-5xl font-bold"><span class="">{{ $course->course_name }}</span></h1>
            {{-- subheaders --}}
            <div class="flex flex-col fill-mainwhitebg">
                {{-- <div class="flex flex-row my-2">
                    <svg class="mr-2 " xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="M240-80q-33 0-56.5-23.5T160-160v-640q0-33 23.5-56.5T240-880h480q33 0 56.5 23.5T800-800v640q0 33-23.5 56.5T720-80H240Zm0-80h480v-640h-80v280l-100-60-100 60v-280H240v640Zm0 0v-640 640Zm200-360 100-60 100 60-100-60-100 60Z"/></svg>
                    <p>{{ $course->course_code }}</p>
                </div>
                <div class="flex flex-row my-2">
                    <svg class="mr-2" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="M480-120 200-272v-240L40-600l440-240 440 240v320h-80v-276l-80 44v240L480-120Zm0-332 274-148-274-148-274 148 274 148Zm0 241 200-108v-151L480-360 280-470v151l200 108Zm0-241Zm0 90Zm0 0Z"/></svg>
                    <p>{{ $course->course_difficulty }}</p>
                </div>
                <div class="flex flex-row my-2">
                    <p>Status: {{ $course->course_status }}</p>
                </div>
                <div class="flex">
                    
                    <div class="flex flex-row my-2">
                        <svg width="24" height="24" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g clip-path="url(#clip0_75_1498)">
                            <path d="M2.5 7.07007C4.7125 6.14507 7.885 5.14757 10.97 4.83757C14.295 4.50257 17.115 4.99507 18.75 6.71757V31.0826C16.4125 29.7576 13.45 29.5751 10.7175 29.8501C7.7675 30.1501 4.7925 31.0026 2.5 31.8776V7.07007ZM21.25 6.71757C22.885 4.99507 25.705 4.50257 29.03 4.83757C32.115 5.14757 35.2875 6.14507 37.5 7.07007V31.8776C35.205 31.0026 32.2325 30.1476 29.2825 29.8526C26.5475 29.5751 23.5875 29.7551 21.25 31.0826V6.71757ZM20 4.45757C17.5375 2.34007 13.9675 2.02507 10.7175 2.35007C6.9325 2.73257 3.1125 4.03007 0.7325 5.11257C0.514123 5.21189 0.328938 5.37195 0.199053 5.57365C0.0691667 5.77535 6.64286e-05 6.01017 0 6.25007L0 33.7501C5.7905e-05 33.9592 0.0525929 34.165 0.152793 34.3486C0.252993 34.5322 0.397654 34.6877 0.573527 34.8009C0.7494 34.914 0.950861 34.9813 1.15946 34.9964C1.36806 35.0116 1.57712 34.9742 1.7675 34.8876C3.9725 33.8876 7.525 32.6851 10.9675 32.3376C14.49 31.9826 17.4425 32.5551 19.025 34.5301C19.1421 34.6761 19.2905 34.7939 19.4593 34.8748C19.628 34.9558 19.8128 34.9978 20 34.9978C20.1872 34.9978 20.372 34.9558 20.5407 34.8748C20.7095 34.7939 20.8579 34.6761 20.975 34.5301C22.5575 32.5551 25.51 31.9826 29.03 32.3376C32.475 32.6851 36.03 33.8876 38.2325 34.8876C38.4229 34.9742 38.6319 35.0116 38.8405 34.9964C39.0491 34.9813 39.2506 34.914 39.4265 34.8009C39.6023 34.6877 39.747 34.5322 39.8472 34.3486C39.9474 34.165 39.9999 33.9592 40 33.7501V6.25007C39.9999 6.01017 39.9308 5.77535 39.8009 5.57365C39.6711 5.37195 39.4859 5.21189 39.2675 5.11257C36.8875 4.03007 33.0675 2.73257 29.2825 2.35007C26.0325 2.02257 22.4625 2.34007 20 4.45757Z" fill="#F8F8F8"/>
                            </g>
                            <defs>
                            <clipPath id="clip0_75_1498">
                            <rect width="40" height="40" fill="white"/>
                            </clipPath>
                            </defs>
                            </svg>
                        <p class="mx-2">{{ $lessonCount }} Lessons</p>
                    </div>
                    <div class="flex flex-row my-2">
                        <svg width="24" height="24" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M6.25 26.25C5.5625 26.25 4.97375 26.005 4.48375 25.515C3.99375 25.025 3.74917 24.4367 3.75 23.75V6.25C3.75 5.5625 3.995 4.97375 4.485 4.48375C4.975 3.99375 5.56334 3.74917 6.25 3.75H11.5C11.7708 3 12.2242 2.39583 12.86 1.9375C13.4958 1.47917 14.2092 1.25 15 1.25C15.7917 1.25 16.5054 1.47917 17.1413 1.9375C17.7771 2.39583 18.23 3 18.5 3.75H23.75C24.4375 3.75 25.0263 3.995 25.5163 4.485C26.0063 4.975 26.2508 5.56333 26.25 6.25V23.75C26.25 24.4375 26.005 25.0263 25.515 25.5163C25.025 26.0063 24.4367 26.2508 23.75 26.25H6.25ZM6.25 23.75H23.75V6.25H6.25V23.75ZM8.75 21.25H17.5V18.75H8.75V21.25ZM8.75 16.25H21.25V13.75H8.75V16.25ZM8.75 11.25H21.25V8.75H8.75V11.25ZM15 5.3125C15.2708 5.3125 15.4946 5.22375 15.6713 5.04625C15.8479 4.86875 15.9367 4.645 15.9375 4.375C15.9375 4.10417 15.8488 3.88042 15.6713 3.70375C15.4938 3.52708 15.27 3.43833 15 3.4375C14.7292 3.4375 14.5054 3.52625 14.3288 3.70375C14.1521 3.88125 14.0633 4.105 14.0625 4.375C14.0625 4.64583 14.1513 4.86958 14.3288 5.04625C14.5063 5.22292 14.73 5.31167 15 5.3125Z" fill="white"/>
                            </svg>
                        <p class="mx-2">{{ $activityCount }} Activities</p>
                    </div>
                    <div class="flex flex-row my-2">
                        <svg width="24" height="24" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M26.6391 8.59801L21.402 3.36207C21.2278 3.18792 21.0211 3.04977 20.7936 2.95551C20.5661 2.86126 20.3223 2.81274 20.076 2.81274C19.8297 2.81274 19.5859 2.86126 19.3584 2.95551C19.1308 3.04977 18.9241 3.18792 18.75 3.36207L4.29962 17.8125C4.12475 17.9859 3.98611 18.1924 3.89176 18.42C3.79741 18.6475 3.74922 18.8915 3.75001 19.1379V24.375C3.75001 24.8722 3.94755 25.3492 4.29918 25.7008C4.65081 26.0524 5.12773 26.25 5.62501 26.25H10.8621C11.1084 26.2508 11.3525 26.2026 11.58 26.1082C11.8075 26.0139 12.014 25.8752 12.1875 25.7004L21.9926 15.8964L22.4004 17.5254L18.0879 21.8367C17.912 22.0124 17.8131 22.2509 17.813 22.4995C17.8129 22.7482 17.9116 22.9867 18.0873 23.1627C18.2631 23.3386 18.5015 23.4375 18.7502 23.4376C18.9988 23.4377 19.2374 23.339 19.4133 23.1632L24.1008 18.4757C24.2154 18.3613 24.2985 18.2191 24.3418 18.063C24.3851 17.9069 24.3873 17.7423 24.3481 17.5851L23.5395 14.3496L26.6391 11.25C26.8132 11.0758 26.9514 10.8691 27.0456 10.6416C27.1399 10.4141 27.1884 10.1702 27.1884 9.92398C27.1884 9.67772 27.1399 9.43387 27.0456 9.20635C26.9514 8.97884 26.8132 8.77212 26.6391 8.59801ZM5.62501 21.0129L8.98712 24.375H5.62501V21.0129ZM11.25 23.9871L6.0129 18.75L15.9375 8.82535L21.1746 14.0625L11.25 23.9871ZM22.5 12.7371L17.2641 7.49996L20.0766 4.68746L25.3125 9.92457L22.5 12.7371Z" fill="white"/>
                            </svg>
                        <p class="mx-2">{{ $quizCount }} Quizzes</p>
                    </div> 
                </div>--}}
                <h1 class="w-1/2 py-4 text-4xl font-bold"><span class="">{{ $lessonInfo->lesson_title }}</span></h1>
            </div>
        </div>

            {{-- main content --}}
            <div class="px-2">
                <div class="text-l mt-1 text-gray-600">
                    <a href="{{ url('/instructor/courses') }}" class="">course></a>
                    <a href="{{ url("/instructor/course/$course->course_id") }}">{{$course->course_name}}></a>
                    <a href="{{ url("/instructor/course/content/$course->course_id") }}">content></a>
                    <a href="">{{ $lessonInfo->lesson_title }}</a>
                </div>
                {{-- overview --}}
                <div class="mb-4">
                    <div class="mt-5 pb-3 flex items-center justify-between my-4 border-b-2 border-seagreen">
                        <div class="relative flex items-center">
                            <svg class="absolute left-0 border-2 border-black rounded-full p-[2px]" xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 32 32"><path fill="currentColor" d="M19 10h7v2h-7zm0 5h7v2h-7zm0 5h7v2h-7zM6 10h7v2H6zm0 5h7v2H6zm0 5h7v2H6z"/><path fill="currentColor" d="M28 5H4a2.002 2.002 0 0 0-2 2v18a2.002 2.002 0 0 0 2 2h24a2.002 2.002 0 0 0 2-2V7a2.002 2.002 0 0 0-2-2ZM4 7h11v18H4Zm13 18V7h11v18Z"/></svg>
                        
                            {{-- <h1 class="pl-[50px] text-3xl font-bold">{{ $lessonInfo->lesson_title }}</h1> --}}
                            <input class="ml-[50px] w-[750px] text-3xl font-bold border-none" disabled type="text" name="lesson_title" id="lesson_title" value="{{ $lessonInfo->lesson_title }}">
                        </div>
                        <button id="edit_lesson_title" class="hidden">
                            <svg class="cursor-pointer" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="M80 0v-160h800V0H80Zm80-240v-150l362-362 150 150-362 362H160Zm80-80h36l284-282-38-38-282 284v36Zm477-326L567-796l72-72q11-12 28-11.5t28 11.5l94 94q11 11 11 27.5T789-718l-72 72ZM240-320Z"/></svg>
                        </button>
                        <div id="edit_lesson_btns" class="hidden">
                            <button id="save_lesson_btn" data-lesson-id="{{$lessonInfo->lesson_id}}" data-course-id="{{$lessonInfo->course_id}}" data-topic_id="{{$lessonInfo->topic_id}}" data-syllabus-id="{{$lessonInfo->syllabus_id}}" class=" text-white rounded-xl py-3 px-5" style="background-color:{{$mainBackgroundCol}}" onmouseover="this.style.backgroundColor='{{$darkenedColor}}'" onmouseout="this.style.backgroundColor='{{$mainBackgroundCol}}'">
                                Save
                            </button>
                            <button id="cancel_lesson_btn" class=" text-white rounded-xl py-3 px-5" style="background-color:{{$mainBackgroundCol}}" onmouseover="this.style.backgroundColor='{{$darkenedColor}}'" onmouseout="this.style.backgroundColor='{{$mainBackgroundCol}}'">
                                Cancel
                            </button>
                        </div>
                        
                    </div>
                </div>
                
                {{-- course --}}
                <div class="mt-5">
                    @if ($lessonInfo->picture !== null)
                    <div id="lesson_img" class="flex justify-center w-full h-[400px] my-4 rounded-lg shadow">
                        <div class="w-full h-[400px] overflow-hidden rounded-lg">
                            <img src="{{ asset("storage/$lessonInfo->picture") }}" class="object-contain w-full h-full" alt="">
                        </div>
                    </div>
                    
                    
                        <div id="edit_lesson_picture_btns" style="position: relative; top: 75%;" class="hidden flex justify-end">
                            <button id="" data-lesson-id="{{$lessonInfo->lesson_id}}" data-course-id="{{$lessonInfo->course_id}}" data-topic_id="{{$lessonInfo->topic_id}}" data-syllabus-id="{{$lessonInfo->syllabus_id}}" class=" add_lesson_picture_btn mr-3 flex text-white rounded-xl py-3 px-5" style="background-color:{{$mainBackgroundCol}}" onmouseover="this.style.backgroundColor='{{$darkenedColor}}'" onmouseout="this.style.backgroundColor='{{$mainBackgroundCol}}'">
                                Change Photo
                            </button>
                        </div>
                        @else
                        
                        <div id="edit_lesson_picture_btns" style="position: relative; top: 75%;" class="hidden flex justify-end">
                            <button id="" data-lesson-id="{{$lessonInfo->lesson_id}}" data-course-id="{{$lessonInfo->course_id}}" data-topic_id="{{$lessonInfo->topic_id}}" data-syllabus-id="{{$lessonInfo->syllabus_id}}" class="add_lesson_picture_btn mr-3 flex text-white rounded-xl py-3 px-5" style="background-color:{{$mainBackgroundCol}}" onmouseover="this.style.backgroundColor='{{$darkenedColor}}'" onmouseout="this.style.backgroundColor='{{$mainBackgroundCol}}'">
                                Add Photo
                            </button>
                        </div>
                        @endif
                    

                    <div id="pictureModal" class="hidden fixed inset-0 z-50 flex items-center justify-center">
                        <div class="modal-container bg-white w-11/12 md:max-w-md mx-auto rounded shadow-lg z-50 overflow-y-auto">
                            <div class="modal-content py-4 text-left px-6">
                                <!-- Modal header -->
                                <div class="flex justify-between items-center pb-3">
                                    <p class="text-2xl font-bold">Upload Picture</p>
                                    <button id="closeModal" class="text-gray-500 hover:text-gray-700">
                                        <svg class="fill-current h-6 w-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                            <path d="M12.293 7.293a1 1 0 00-1.414 0L10 8.586 8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 001.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 000-1.414z"/>
                                        </svg>
                                    </button>
                                </div>
                                <!-- Modal body -->
                                <div class="mb-4">
                                    <!-- Your form for uploading pictures goes here -->
                                    <form id="pictureUploadForm" data-lesson-id="{{$lessonInfo->lesson_id}}" data-course-id="{{$lessonInfo->course_id}}" data-topic_id="{{$lessonInfo->topic_id}}" data-syllabus-id="{{$lessonInfo->syllabus_id}}" enctype="multipart/form-data" method="POST">
                                        <input type="file" name="picture" id="lesson_title_picture" accept=".jpeg, .png, .jpg, .gif" />

                                        <div class="flex justify-between mt-4">
                                            <button type="submit" class="bg-green-600 text-white py-2 px-4 rounded hover:bg-green-900">Confirm</button>
                                            <button id="cancelUpload" class="bg-gray-300 text-gray-700 py-2 px-4 rounded hover:bg-gray-400">Cancel</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>




                    {{-- lesson content area --}}
                    <div id="main_content_area" class="">
                        @forelse ($lessonContent as $lesson)
                        <div data-content-order="{{$lesson->lesson_content_order}}" class="px-10 lesson_content_area my-2 mb-8 w-full">
                            <button class="edit_lesson_content hidden">
                                <svg class="cursor-pointer" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="M80 0v-160h800V0H80Zm80-240v-150l362-362 150 150-362 362H160Zm80-80h36l284-282-38-38-282 284v36Zm477-326L567-796l72-72q11-12 28-11.5t28 11.5l94 94q11 11 11 27.5T789-718l-72 72ZM240-320Z"/></svg>
                            </button>
                            
                            <input type="text" class="lesson_content_title_input text-2xl font-bold border-none w-10/12" disabled name="lesson_content_title_input" id="" value="{{ $lesson->lesson_content_title }}">
                            
                            @if ($lesson->picture !== null)
                                <img src="{{asset()}}" alt="">
                                
                            @else
                                
                            @endif
                            
                            <p class="lesson_content_input_disp text-xl w-full min-w-full max-w-full">{{$lesson->lesson_content}}</p>
                            <textarea name="lesson_content_input" id="" class="hidden text-xl lesson_content_input w-[200px] min-w-[200px] max-w-full"  disabled>{{ $lesson->lesson_content }}</textarea>
                            
                            <div class="edit_lesson_content_btns hidden flex w-full justify-end">
                                <button id="" class="save_lesson_content_btn mx-1 text-white rounded-xl py-3 px-5" style="background-color:{{$mainBackgroundCol}}" onmouseover="this.style.backgroundColor='{{$darkenedColor}}'" onmouseout="this.style.backgroundColor='{{$mainBackgroundCol}}'">
                                    Save
                                </button>
                                <button id="" class="delete_lesson_content_btn mx-1 text-white rounded-xl py-3 px-5 bg-red-600 hover:bg-red-800">
                                    Delete
                                </button>
                                <button id="" class="cancel_lesson_content_btn mx-1 text-white rounded-xl py-3 px-5" style="background-color:{{$mainBackgroundCol}}" onmouseover="this.style.backgroundColor='{{$darkenedColor}}'" onmouseout="this.style.backgroundColor='{{$mainBackgroundCol}}'">
                                    Cancel
                                </button>
                            </div>
                        </div>
                        @empty
                        <div class="my-2 mb-8">
                            {{-- <h1 class="text-lg font-medium">What is business?</h1> --}}
                            <p class="pl-4 text-justify">No Lesson content</p>
                        </div>
                        @endforelse

                    </div>
                    
                    

                    <button class="hidden flex items-center w-full px-10 py-4 mt-4 rounded-lg shadow-lg ring-2 ring-seagreen" id="lessonAddContent">
                        <svg class="mx-2" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="M440-440H200v-80h240v-240h80v240h240v80H520v240h-80v-240Z"/></svg>
                        <h1>Add New Content</h1>
                    </button>

                    
                    
                    <div class="flex justify-center w-full">
                        <button id="editLessonBtn" data-course-id="{{$lessonInfo->course_id}}" data-syllabus-id="{{$lessonInfo->syllabus_id}}" data-topic_id="{{$lessonInfo->topic_id}}" style="background-color:{{$mainBackgroundCol}}" onmouseover="this.style.backgroundColor='{{$darkenedColor}}'"
                        onmouseout="this.style.backgroundColor='{{$mainBackgroundCol}}'" class="w-1/2 py-5 mx-1 mt-4 text-white text-xl rounded-lg shadow-lg bg-seagreen hover:bg-green-800 hover:text-white">
                            <h1>Edit</h1>
                        </button>
                        <div id="editBtns" class="flex justify-end hidden w-full">
                            <button id="cancelEditBtn" style="background-color:{{$mainBackgroundCol}}" onmouseover="this.style.backgroundColor='{{$darkenedColor}}'"
                            onmouseout="this.style.backgroundColor='{{$mainBackgroundCol}}'" class="w-1/2 py-5 mx-1 mt-4 text-white text-xl rounded-lg shadow-lg bg-seagreen hover:bg-green-800 hover:text-white">
                                <h1>Cancel</h1>
                            </button>
                            <button id="saveEditBtn" style="background-color:{{$mainBackgroundCol}}" onmouseover="this.style.backgroundColor='{{$darkenedColor}}'"
                            onmouseout="this.style.backgroundColor='{{$mainBackgroundCol}}'" class="w-1/2 py-5 mx-1 mt-4 text-white text-xl rounded-lg shadow-lg bg-seagreen hover:bg-green-800 hover:text-white" data-lesson-id="{{$lessonInfo->lesson_id}}" data-course-id="{{$lessonInfo->course_id}}" data-syllabus-id="{{$lessonInfo->syllabus_id}}" data-topic_id="{{$lessonInfo->topic_id}}">
                                <h1>Apply All Changes</h1>
                            </button>
                        </div>
            
                    </div>             
                </div>
            </div>
        </div>
    </section>

    <div id="deleteLessonContentModal" class="hidden fixed top-0 left-0 w-screen h-screen flex justify-center items-center bg-black bg-opacity-50">
        {{-- <form id="deleteCourse" action="" data-course-id="{{ $course->course_id }}"> --}}
            {{-- @csrf --}}
            <div class="bg-white p-5 rounded-lg text-center">
                <p>Are you sure you want to delete this content?</p>
                <button type="button" id="confirmDelete" data-course-id="{{$course->course_id}}" class="px-4 py-2 bg-red-600 text-white rounded-md m-2">Confirm</button>
                <button type="button" id="cancelDelete" class="px-4 py-2 bg-gray-400 text-gray-700 rounded-md m-2">Cancel</button>
            </div>
        {{-- </form> --}}
        
    </div>

    {{-- <div class="fixed z-50 flex items-center hidden w-full h-screen bg-white bg-opacity-50" aria-hidden="true" id="lessonNewContent">
        <div class="relative w-full h-auto pt-8 m-auto mx-4 rounded shadow-lg bg-seagreen" id="lessonChildContent">
            <div class="flex flex-col m-4">
                <input class="h-8 px-2 rounded" type="text" placeholder="Enter Title">
            </div>

            <div class="m-4">
                <textarea class="w-full h-32 px-2 rounded resize-none" name="" id=""  placeholder="Enter Content"></textarea>
            </div>

            <div class="flex items-center justify-end mx-4 mb-4">
                <button class="w-16 py-2 mx-1 bg-gray-300 rounded-lg shadow-lg" id="lessonNewContentCloseBtn">
                    <h1>Close</h1>
                </button>
                <button class="w-16 py-2 mx-1 text-white rounded-lg shadow-lg bg-darthmouthgreen">
                    <h1>Save</h1>
                </button>
            </div>
        </div>
    </div> --}}

    <div id="addLessonContentModal" class="hidden fixed top-0 left-0 w-full h-full flex items-center justify-center bg-gray-200 bg-opacity-75">
        <div class="modal-content bg-white p-4 rounded-lg shadow-lg w-[500px]">
            <div class="w-full flex justify-end">
                <button id="closeAddLessonContentModal">
                    <i class="fa-solid fa-xmark text-xl" style="color: #949494;"></i>
                </button>
            </div>
            <h2 class="text-2xl font-semibold mb-2">Add Lesson Content</h2>
            <div class="mt-4">
                <label for="insertLessonContentTitle" class="text-lg font-semibold">Enter Title:</label>
                <input type="text" name="insertLessonContentTitle" id="insertLessonContentTitle" class="block w-full px-4 py-2 mt-2 rounded-md border border-gray-300 focus:ring focus:ring-seagreen focus:ring-opacity-50">
            </div>

            <div class="mt-4">
                <label for="insertLessonContent" class="text-lg font-semibold">Enter Content:</label>
                {{-- <input type="text" name="insertLessonContent" id="insertLessonContentTitle" class="block w-full px-4 py-2 mt-2 rounded-md border border-gray-300 focus:ring focus:ring-seagreen focus:ring-opacity-50"> --}}
                <textarea
                  name="insertLessonContent"
                    id="insertLessonContent"
                    class="block w-full px-4 py-2 mt-2 rounded-md border border-gray-300 focus:ring focus:ring-seagreen focus:ring-opacity-50"
                    cols="30"
                    rows="10"
                    style="white-space: pre;"
                  ></textarea>
              
            </div>
    
            <div class="mt-4">
                <label for="insertLocation" class="text-lg font-semibold">Insert Location:</label>
                <select id="insertLocation" class="block w-full px-4 py-2 mt-2 rounded-md border border-gray-300 focus:ring focus:ring-seagreen focus:ring-opacity-50">
                        <option value="START">At the Beginning</option>
                    @forelse ($lessonContent as $lesson)
                        <option value="{{ $lesson->lesson_content_title }}">AFTER {{ $lesson->lesson_content_title }}</option>
                    @empty
                        <option value="">At the Beginning</option>
                    @endforelse
                        <option value="END">In the End</option>
                </select>
            </div>
            <div class="w-full mt-5 flex justify-center">
                <button id="confirmAddLessonContentBtn" data-lesson-id="{{$lessonInfo->lesson_id}}" class="mx-2 mt-4 px-4 py-2 bg-seagreen text-white rounded hover:bg-darkenedColor">Confirm</button>
                <button id="cancelAddLessonContentBtn" class="mx-2 mt-4 px-4 py-2 bg-red-500 text-white rounded">Cancel</button>
            </div>
        </div>
    </div>
    @include('partials.instructorProfile')
</section>
@include('partials.footer')