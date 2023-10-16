@include('partials.header')
<section class="flex flex-row w-full h-screen text-sm bg-mainwhitebg md:text-base lg:h-screen">
        <header class="fixed top-0 left-0 z-40 flex flex-row items-center w-full px-4 py-4 bg-seagreen">
        <a href="#">
            <span class="self-center text-lg font-semibold font-semibbold whitespace-nowrap md:text-2xl text-mainwhitebg">
                Eskwela4EveryJuan
            </span>
        </a>
    </header>  
        {{-- SIDEBAR --}}
    @include('partials.instructorSidebar')

    {{-- MAIN --}}
    <section class="w-full pt-[100px] mx-4 overscroll-auto md:overflow-auto">
        {{-- course name/title --}}
        <a href="{{ url()->previous() }}" class="w-8 h-8 m-2">
            <svg xmlns="http://www.w3.org/2000/svg" height="25" viewBox="0 -960 960 960" width="24"><path d="m313-440 224 224-57 56-320-320 320-320 57 56-224 224h487v80H313Z"/></svg>
        </a>
        <div class="relative z-0 pb-4 bg-black border border-gray-400 rounded-lg shadow-lg text-mainwhitebg">
            <img class="absolute top-0 left-0 object-cover w-full h-full pointer-events-none -z-10 opacity-30" src="{{asset('images/marketing-img.png')}}" alt="computer with microphone">
            <div class="z-50 p-2">
                <h1 class="w-1/2 py-4 text-4xl font-semibold"><span class="">{{ $course->course_name }}</span></h1>
                {{-- subheaders --}}
                <div class="flex flex-col fill-mainwhitebg">
                    <div class="flex flex-row my-2">
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
                    <div class="flex flex-row my-2">
                        <svg class="mr-2" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="M300-80q-58 0-99-41t-41-99v-520q0-58 41-99t99-41h500v600q-25 0-42.5 17.5T740-220q0 25 17.5 42.5T800-160v80H300Zm-60-267q14-7 29-10t31-3h20v-440h-20q-25 0-42.5 17.5T240-740v393Zm160-13h320v-440H400v440Zm-160 13v-453 453Zm60 187h373q-6-14-9.5-28.5T660-220q0-16 3-31t10-29H300q-26 0-43 17.5T240-220q0 26 17 43t43 17Z"/></svg>
                        <p>10 Lessons</p>
                    </div>
                </div>
            </div>
            <div class="w-full">
                <button class="w-32 h-10 m-2 rounded-full bg-seagreen">
                    <h1>View Course</h1>
                </button>
            </div>
        </div>

        <div id="courseManage" class="relative w-full mt-5">

            <div class="flex justify-between text-mainwhitebg fill-mainwhitebg">
                <button class="relative w-1/2 h-16 p-2 mr-2 text-center rounded-lg bg-darthmouthgreen">
                    <h1>Manage Course</h1>
                    <svg class="absolute bottom-0 right-0 hidden mx-2 " xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="M647-440H160v-80h487L423-744l57-56 320 320-320 320-57-56 224-224Z"/></svg>
                </button>
                <button class="relative w-1/2 h-16 p-2 ml-2 text-center rounded-lg bg-seagreen">
                    <h1>View Course</h1>
                    <svg class="absolute bottom-0 right-0 hidden mx-2" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="M647-440H160v-80h487L423-744l57-56 320 320-320 320-57-56 224-224Z"/></svg>
                </button>
            </div>

            <div class="mt-5 rounded-lg flex">
                <div id="side_items" class="w-1/6 h-full rounded-lg bg-green-700 h-">
                    <ul class="px-5 py-5 text-white text-xl font-medium">
                        <li id="edit_info_btn" class="w-full py-5 rounded-xl px-2 mt-2 hover:bg-green-900">
                                <i class="fa-solid fa-book-open text-3xl pr-2"></i>
                                Edit Info
                        </li>
                        <li id="enrolled_learners_btn" class="w-full py-5 rounded-xl px-2 mt-2 hover:bg-green-900">
                                <i class="fa-solid fa-users text-3xl pr-2"></i>
                                Enrolled Learners
                        </li>
                        <li id="course_summary_btn" class="w-full py-5 rounded-xl px-2 mt-2 hover:bg-green-900">
                                <i class="fa-solid fa-book text-3xl pr-2"></i>
                                Course Summary
                        </li>
                        <li class="w-full py-3 rounded-xl px-2 mt-2">
                          
                        </li>
                        <li class="w-full py-3 rounded-xl px-2 mt-2">
                          
                        </li>
                    </ul>
                </div>
                <div id="content_area" class=" w-5/6 m-5 overflow-y-auto">
                    <div id="course_info" class="">
                        <h1 class="text-2xl font-semibold border-black border-b-2">Course Information</h1>

                        <form id="updateCourse" name="updateCourse" data-course-id="{{ $course->course_id }}">
                            @csrf
                            <div id="info" class="mt-5 overflow-y-auto">
                                <div class="flex">
                                    <div class="w-2/5">
                                        <div class="flex justify-normal my-2">
                                            <label for="" class="text-lg w-2/6">Course ID:</label>
                                            <input type="text" value="{{ $course->course_id }}" class="text-lg w-4/6" disabled>
                                        </div>
                                        <div class="flex justify-normal my-2 ">
                                            <label for="course_name" class="text-lg w-2/6">Course Name:</label>
                                            <input type="text" id="course_name" name="course_name" value="{{ $course->course_name }}" class="text-lg  w-4/6" disabled>
                                        </div>
                                        <div class="flex justify-normal my-2 ">
                                            <label for="" class="text-lg w-2/6">Course Code:</label>
                                            <input type="text" value="{{ $course->course_code }}" class="text-lg  w-4/6" disabled>
                                        </div>
                                    </div>
                                    
                                    <div class="w-2/5 mx-5">
                                        <div class="flex justify-normal my-1 ">
                                            <h1 class="text-lg w-2/6">Course Status:</h1>
                                            @if ($course->course_status == 'Approved')
                                            <p class="px-5 py-2 rounded-full bg-green-600">Approved</p>
                                            @elseif ($course->course_status == 'Pending')
                                            <p class="px-5 py-2 rounded-full bg-yellow-400">Pending</p>
                                            @else
                                            <p class="px-5 py-2 rounded-full bg-red-600">Rejected</p>
                                            @endif
                                            
                                        </div>
                                        <div class="flex justify-normal my-1 py-1">
                                            <label for="" class="text-lg w-2/5">Course Difficulty:</label>
                                            <select name="course_difficulty" id="course_difficulty" class="w-2/5" disabled>
                                                <option value="" {{ $course->course_difficulty == '' ? 'selected' : '' }}>--select an option--</option>
                                                <option value="Beginner" {{ $course->course_difficulty == 'Beginner' ? 'selected': '' }}>Beginner</option>
                                                <option value="Intermediate" {{ $course->course_difficulty == 'Intermediate' ? 'selected': '' }}>Intermediate</option>
                                                <option value="Advanced" {{ $course->course_difficulty == 'Advanced' ? 'selected': '' }}>Advanced</option>
                                            </select>
                                        </div>
                                    </div>
    
                                    <div class="mt-5">
                                        <h1>Created {{ $course->created_at }} by {{ $course->instructor_fname }} {{ $course->instructor_lname }}</h1>
                                        <h1>Last Modified {{ $course->updated_at }}</h1>
                                    </div>
                                </div>
    
                                <div class="mt-1">
                                    <h1>Course Description</h1>
                                    {{-- <p class=" h-24 overflow-y-auto">{{ $course->course_description }}</p> --}}
                                    <textarea name="course_description" id="course_description" class="max-h-24 h-24 max-w-full w-full" disabled>{{ $course->course_description }}</textarea>
                                </div>
                                
                               
    
                                <div class="flex justify-end mr-16">
                                    <button type="button" id="editCourse" class="w-44 py-5 rounded-2xl text-lg font-medium bg-green-600 text-white hover:bg-green-800 focus">
                                        Edit Course Info
                                    </button>
    
                                    <button type="button" id="cancelEditCourse" class="hidden w-44 py-5 rounded-2xl text-lg font-medium bg-red-600 text-white hover:bg-red-800 focus">
                                        Cancel
                                    </button>
    
                                    <button type="submit" id="saveEditCourse" class="hidden w-44 py-5 rounded-2xl text-lg font-medium bg-green-600 text-white hover:bg-green-800 focus">
                                        Save Changes
                                    </button>
                                </div>
                                
                            </div>
                        </form>
                        
                    </div>


                    <div id="enrolled_learners" class="hidden">
                        <h1 class="text-2xl font-semibold border-black border-b-2">Enrolled Learner</h1>

                        <form action="" method="GET">
                            <div class="flex items-center">
                                <div class="flex items-center mx-10">
                                    <div class="mx-2">
                                        <label for="filterDate" class="">Filter by Date</label><br>
                                        <input type="date" name="filterDate" class="w-40 px-2 py-2 text-base border-2 border-black rounded-xl" value="">
                                    </div>
                                    <div class="mx-2">
                                        <label for="filterStatus" class="">Filter by Status</label><br>
                                        <select name="filterStatus" id="filterStatus" class="w-32 px-2 py-2 text-base border-2 border-black rounded-xl">
                                            <option value="">Select Status</option>
                                            <option value="Pending">Pending</option>
                                            <option value="Approved">Approved</option>
                                            <option value="Rejected">Rejected</option>
                                        </select>
                                    </div>
                                    <button class="h-12 px-5 py-1 mx-3 text-lg font-medium bg-green-600 rounded-xl hover:bg-green-900 hover:text-white" type="submit">Filter</button>
                                </div>
                                <div class="">
                                    <select name="searchBy" id="" class="w-40 px-2 py-2 text-lg border-2 border-black rounded-xl">
                                        <option value="" class="">Search By</option>
                                        <option value="learner_id">Learner ID</option>
                                        <option value="name">Name</option>
                                        <option value="learner_email">Email</option>
                                        <option value="learner_contactno">Contact No.</option>
                                        <option value="business_name">Business Name</option>
                                        {{-- <option value="created_at">Date Registered</option> --}}
                                        {{-- <option value="status">Status</option> --}}
                                    </select>
                                    <input type="text" name="searchVal" class="px-2 py-2 ml-3 text-lg border-2 border-black w-80 rounded-xl" placeholder="Type to search">
                                    <button class="px-3 py-2 mx-3 text-lg font-medium bg-green-600 rounded-xl hover:bg-green-900 hover:text-white" type="submit">Search</button>        
                                </div>
                            </div>
                        </form>

                        <div id="learner_table" class="mt-5">
                            <table>
                                <thead class="text-left">
                                    <th class="w-1/5">Enrollee ID</th>
                                    <th class="w-1/5">Learner ID</th>
                                    <th class="w-2/5">Enrollee Info</th>
                                    <th class="w-1/5">Date</th>
                                    <th class="w-1/5"></th>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>1</td>
                                        <td>
                                            <h1>Kenneth Timblaco</h1>
                                            <p>ktimblaco25@email.com</p>
                                        </td>
                                        <td>October 25, 2023</td>
                                        <td>
                                            <button class="px-5 py-2 rounded-2xl bg-green-500 hover:bg-green-700">
                                                view
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>


                    <div id="course_summary" class="overflow-y-auto hidden">
                        <h1 class="text-2xl font-semibold border-black border-b-2">Course Summary</h1>

                        <div class="flex justify-normal mt-3">
                            <div class="w-2/5">
                                <h1>Course Name: {{ $course->course_name }}</h1>
                                <h1>Course ID: {{ $course->course_id }}</h1>
                                <h1>Course Code: {{ $course->course_code }}</h1>
                            </div>
                            <div class="w-2/5">
                                <h1>Instructor: {{ $course->instructor_fname }} {{ $course->instructor_lname }}</h1>
                                <h1>Course Difficulty: {{ $course->course_difficulty }}</h1>
                                <div class="flex">
                                    <h1>Course Status: </h1>
                                    @if ($course->course_status == 'Approved')
                                   <p class="px-5 py-2 rounded-full bg-green-600">Approved</p>
                                   @elseif ($course->course_status == 'Pending')
                                   <p class="px-5 py-2 rounded-full bg-yellow-400">Pending</p>
                                   @else
                                   <p class="px-5 py-2 rounded-full bg-red-600">Rejected</p>
                                   @endif
                                </div>
                                
                            </div>
                            <div class="w-2/5">
                                <h1>Created at: {{ $course->created_at }}</h1>
                                <h1>Updated at: {{ $course->updated_at }}</h1>
                            </div>
                        </div>
                        
                        <div class="mt-3">
                            <h1>Course Description</h1>
                            <p class=" h-24 overflow-y-auto">{{ $course->course_description }}</p>
                        </div>

                        <div class="justify-end flex">
                            <button id="showDeleteModal" class="px-5 py-5 text-xl rounded-xl bg-red-600 hover:bg-red-700">Delete Course</button>
                        </div>
                        
                        <div id="deleteCourseModal" class="hidden fixed top-0 left-0 w-screen h-screen flex justify-center items-center bg-black bg-opacity-50">
                            <form id="deleteCourse" action="" data-course-id="{{ $course->course_id }}">
                                @csrf
                                <div class="bg-white p-5 rounded-lg text-center">
                                    <p>Are you sure you want to delete this course?</p>
                                    <button type="submit" id="confirmDelete" class="px-4 py-2 bg-red-600 text-white rounded-md m-2">Confirm</button>
                                    <button id="cancelDelete" class="px-4 py-2 bg-gray-400 text-gray-700 rounded-md m-2">Cancel</button>
                                </div>
                            </form>
                            
                        </div>
                        
                    </div>

                </div>
            </div>
            
        </div>


    @include('partials.footer')