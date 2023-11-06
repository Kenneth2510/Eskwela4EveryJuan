@include('partials.header')
<section class="flex flex-row w-full h-screen text-sm bg-mainwhitebg md:text-base lg:h-screen">
    <header class="fixed top-0 left-0 z-40 flex flex-row items-center w-full px-4 py-4 bg-seagreen">
    <a href="#">
        <span class="self-center text-lg font-semibold font-semibbold whitespace-nowrap md:text-2xl text-mainwhitebg">
            Eskwela4EveryJuan
        </span>
    </a>
</header>  

@include('partials.learnerSidebar')

{{-- MAIN --}}
<section class="w-full pt-[125px] mx-4  overscroll-auto md:overflow-auto">
    {{-- course name/title --}}
    <a href="{{ url('/learner/dashboard') }}" class="w-8 h-8 m-2">
        <svg xmlns="http://www.w3.org/2000/svg" height="25" viewBox="0 -960 960 960" width="24"><path d="m313-440 224 224-57 56-320-320 320-320 57 56-224 224h487v80H313Z"/></svg>
    </a>
    <div class="relative z-0 pb-4 bg-black border border-gray-400 rounded-lg shadow-lg text-mainwhitebg">
        <img class="absolute top-0 left-0 object-cover w-full h-full pointer-events-none -z-10 opacity-30" src="{{asset('images/marketing-img.png')}}" alt="computer with microphone">
        <div class="z-50 p-2">
            <h1 class="w-1/2 py-4 text-lg font-semibold">{{$course->course_name}}</h1>
            {{-- subheaders --}}
            <div class="flex flex-col fill-mainwhitebg">
                <div class="flex flex-row my-2">
                    <svg class="mr-2 " xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="M240-80q-33 0-56.5-23.5T160-160v-640q0-33 23.5-56.5T240-880h480q33 0 56.5 23.5T800-800v640q0 33-23.5 56.5T720-80H240Zm0-80h480v-640h-80v280l-100-60-100 60v-280H240v640Zm0 0v-640 640Zm200-360 100-60 100 60-100-60-100 60Z"/></svg>
                    <p>{{$course->course_code}}</p>
                </div>
                <div class="flex flex-row my-2">
                    <svg class="mr-2" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="M480-120 200-272v-240L40-600l440-240 440 240v320h-80v-276l-80 44v240L480-120Zm0-332 274-148-274-148-274 148 274 148Zm0 241 200-108v-151L480-360 280-470v151l200 108Zm0-241Zm0 90Zm0 0Z"/></svg>
                    <p>{{$course->course_difficulty}}</p>
                </div>
                <div class="flex flex-row my-2">
                    <svg class="mr-2" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="M300-80q-58 0-99-41t-41-99v-520q0-58 41-99t99-41h500v600q-25 0-42.5 17.5T740-220q0 25 17.5 42.5T800-160v80H300Zm-60-267q14-7 29-10t31-3h20v-440h-20q-25 0-42.5 17.5T240-740v393Zm160-13h320v-440H400v440Zm-160 13v-453 453Zm60 187h373q-6-14-9.5-28.5T660-220q0-16 3-31t10-29H300q-26 0-43 17.5T240-220q0 26 17 43t43 17Z"/></svg>
                    <p>10 Lessons</p>
                </div>
                <div class="flex flex-row my-2">
                    @if ($isEnrolled !== null)
                    <p>Enroll Status: {{ $isEnrolled->status }}</p>
                    @endif
                </div>
            </div>
        </div>
        <div class="flex items-center w-full">
            @if ($isEnrolled !== null)
                <a href="" id="startBtn" class="w-32 h-10 px-6 py-2 m-2 rounded-full bg-seagreen hover:bg-green-800">
                    Start Now
                </a>
                <x-forms.primary-button
                color="red"
                name="Unenroll" 
                type="button"
                class="bg-red-600 hover:bg-red-700"
                id="unenrollBtn"/>
                {{-- <button type="button" id="unenrollBtn" class="w-32 h-10 m-2 bg-red-600 rounded-full hover:bg-red-800">
                    Unenroll
                </button> --}}
            @else
            <x-forms.primary-button
                color="seagreen"
                name="Enroll Now"
                type="button"
                class="hover:bg-green-800"
                id="enrollBtn"/>
                {{-- <button type="button" id="enrollBtn" class="w-32 h-10 m-2 rounded-full bg-seagreen hover:bg-green-800">
                    <h1>Enroll Now</h1>
                </button> --}}
            @endif

          

        </div>
        
        
        
        
    </div>
    @if($isEnrolled !== null)

    <div id="unenrollCourseModal" class="fixed top-0 left-0 z-30 flex items-center justify-center hidden w-screen h-screen bg-black bg-opacity-50">
        <form id="unenrollCourse" data-learner_course-id="{{ $isEnrolled->learner_course_id }}">
            @csrf
            <div class="p-5 text-center bg-white rounded-lg">
                <p>Are you sure you want to unenroll the course?</p>
                <x-forms.primary-button
                color="red"
                name="Unenroll"
                class="bg-red-600 hover:bg-red-700"
                id="confirmUnenroll"/>
                <x-forms.primary-button
                color="gray"
                name="Cancel" 
                type="button"
                id="cancelUnenroll"/>
                {{-- <button type="submit" id="confirmUnenroll" class="px-4 py-2 m-2 text-white bg-red-600 rounded-md">
                    Unenroll
                </button>
                <button type="button" id="cancelUnenroll" class="px-4 py-2 m-2 text-gray-700 bg-gray-400 rounded-md">
                    Cancel
                </button> --}}
            </div>
        </form>
    </div>

    @else 
    <div id="enrollCourseModal" class="fixed top-0 left-0 z-30 flex items-center justify-center hidden w-screen h-screen bg-black bg-opacity-50"> 
        <form id="enrollCourse" action="" data-course-id="{{$course->course_id}}">
            @csrf
            <div class="p-5 text-center bg-white rounded-lg">
                <p>Are you sure you want to Enroll course?</p>
                <x-forms.primary-button
                color="green"
                name="Confirm" 
                class="bg-green-600 hover:bg-green-700"
                id="confirmEnroll"/>
                <x-forms.primary-button
                color="gray"
                name="Cancel" 
                type="button"
                id="cancelEnroll"/>
                {{-- <button type="submit" id="confirmEnroll" class="px-4 py-2 m-2 text-white bg-green-600 rounded-md">Confirm</button>
                <button id="cancelEnroll" class="px-4 py-2 m-2 text-gray-700 bg-gray-400 rounded-md">Cancel</button> --}}
            </div>
        </form>
    </div>
    @endif


    {{-- course management --}}
    <div class="relative w-full mt-5">
        {{-- course left --}}
        @if($isEnrolled !== null)
        <div class="flex justify-between text-mainwhitebg fill-mainwhitebg">
            <button data-course-id="{{$course->course_id}}" id="showCourseManageModal" class="relative items-center w-1/2 h-16 p-2 mr-2 text-center rounded-lg bg-darthmouthgreen">
                <h1>Manage Course</h1>
                <svg class="absolute bottom-0 right-0 hidden mx-2 " xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="M647-440H160v-80h487L423-744l57-56 320 320-320 320-57-56 224-224Z"/></svg>
            </button>
            <button class="relative w-1/2 h-16 p-2 ml-2 text-center rounded-lg bg-seagreen">
                <h1>View Progress</h1>
                <svg class="absolute bottom-0 right-0 hidden mx-2" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="M647-440H160v-80h487L423-744l57-56 320 320-320 320-57-56 224-224Z"/></svg>
            </button>
        </div>
        @else 
        <div class="flex justify-between text-mainwhitebg fill-mainwhitebg">
            <a href="/learner/course/manage/{{ $course->course_id }}" class="relative w-1/2 h-16 p-2 mr-2 text-center rounded-lg bg-darthmouthgreen">
                <h1>Manage Course</h1>
                <svg class="absolute bottom-0 right-0 hidden mx-2 " xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="M647-440H160v-80h487L423-744l57-56 320 320-320 320-57-56 224-224Z"/></svg>
            </a>
            {{-- <button class="relative w-1/2 h-16 p-2 ml-2 text-center rounded-lg bg-seagreen">
                <h1>View Progress</h1>
                <svg class="absolute bottom-0 right-0 hidden mx-2" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="M647-440H160v-80h487L423-744l57-56 320 320-320 320-57-56 224-224Z"/></svg>
            </button> --}}
        </div>
        @endif



        {{-- course right --}}
        <div class="flex flex-col pt-4">
            <div class="flex flex-row items-center py-4 my-2 bg-teal-400 rounded-lg shadow-lg justify-evenly">
                <svg class="w-10 h-10 mr-2" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="m344-60-76-128-144-32 14-148-98-112 98-112-14-148 144-32 76-128 136 58 136-58 76 128 144 32-14 148 98 112-98 112 14 148-144 32-76 128-136-58-136 58Zm34-102 102-44 104 44 56-96 110-26-10-112 74-84-74-86 10-112-110-24-58-96-102 44-104-44-56 96-110 24 10 112-74 86 74 84-10 114 110 24 58 96Zm102-318Zm-42 142 226-226-56-58-170 170-86-84-56 56 142 142Z"/></svg>
                <h3 class="w-1/3">Completion Rate</h3>
                <h1 class="text-xl font-medium">98%</h1>
            </div>
            <div class="flex flex-row items-center py-4 my-2 rounded-lg shadow-lg bg-sky-400 justify-evenly">
                <svg class="w-10 h-10 mr-2" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="M702-480 560-622l57-56 85 85 170-170 56 57-226 226Zm-342 0q-66 0-113-47t-47-113q0-66 47-113t113-47q66 0 113 47t47 113q0 66-47 113t-113 47ZM40-160v-112q0-34 17.5-62.5T104-378q62-31 126-46.5T360-440q66 0 130 15.5T616-378q29 15 46.5 43.5T680-272v112H40Zm80-80h480v-32q0-11-5.5-20T580-306q-54-27-109-40.5T360-360q-56 0-111 13.5T140-306q-9 5-14.5 14t-5.5 20v32Zm240-320q33 0 56.5-23.5T440-640q0-33-23.5-56.5T360-720q-33 0-56.5 23.5T280-640q0 33 23.5 56.5T360-560Zm0 260Zm0-340Z"/></svg>
                <h3 class="w-1/3">Number of Completers</h3>
                <h1 class="text-xl font-medium">98</h1>
            </div>
            <div class="flex flex-row items-center py-4 my-2 rounded-lg shadow-lg bg-fuchsia-400 justify-evenly">
                <svg class="w-10 h-10 mr-2" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="M480-480q-66 0-113-47t-47-113q0-66 47-113t113-47q66 0 113 47t47 113q0 66-47 113t-113 47ZM160-160v-112q0-34 17.5-62.5T224-378q62-31 126-46.5T480-440q66 0 130 15.5T736-378q29 15 46.5 43.5T800-272v112H160Zm80-80h480v-32q0-11-5.5-20T700-306q-54-27-109-40.5T480-360q-56 0-111 13.5T260-306q-9 5-14.5 14t-5.5 20v32Zm240-320q33 0 56.5-23.5T560-640q0-33-23.5-56.5T480-720q-33 0-56.5 23.5T400-640q0 33 23.5 56.5T480-560Zm0-80Zm0 400Z"/></svg>
                <h3 class="w-1/3">Currently Enrolled</h3>
                <h1 class="text-xl font-medium">98</h1>
            </div>
        </div>

        <div id="L_courseManageModal"  class="fixed top-0 left-0 flex items-center justify-center hidden w-screen h-screen bg-black bg-opacity-50">
            
            <div id="courseManage" style="margin-left:15%;" class="w-full p-5 mx-5 bg-white rounded-lg overscroll-auto md:overflow-auto">
                <a href="" class="w-8 h-8 m-2">
                    <svg xmlns="http://www.w3.org/2000/svg" height="25" viewBox="0 -960 960 960" width="24">
                        <path d="m313-440 224 224-57 56-320-320 320-320 57 56-224 224h487v80H313Z"/>
                    </svg>
                </a>

                <div id="course_mainBody" class="flex mt-5 rounded-lg">
                    <div id="side_items" class="w-1/6 h-full bg-green-700 rounded-lg h-">
                        <ul class="px-5 py-5 text-xl font-medium text-white">
                            <li id="display_info_btn" class="w-full px-2 py-5 mt-2 rounded-xl hover:bg-green-900">
                                <i class="pr-2 text-3xl fa-solid fa-book-open"></i>
                                Course Info
                        </li>
                        <li id="enrolled_learners_btn" class="w-full px-2 py-5 mt-2 rounded-xl hover:bg-green-900">
                                <i class="pr-2 text-3xl fa-solid fa-users"></i>
                                Enrolled Learners
                        </li>
                        <li id="enrollment_summary_btn" class="w-full px-2 py-5 mt-2 rounded-xl hover:bg-green-900">
                                <i class="pr-2 text-3xl fa-solid fa-book"></i>
                                Enrollment Summary
                        </li>
                            <li class="w-full px-2 py-3 mt-2 rounded-xl"></li>
                            <li class="w-full px-2 py-3 mt-2 rounded-xl"></li>
                        </ul>
                    </div>
    
    
                    <div id="learner_course_info" class="w-full mx-5">
    
                    </div>
    
                    <div id="learner_enrolled_learners" class="hidden w-full mx-5">
                        <h1 class="text-2xl font-semibold border-b-2 border-black">Enrolled Learner</h1>
    
                        <form id="l_enrolleeForm" method="GET">
                            <div class="flex items-center">
                                <div class="flex items-center mx-10">
                                    <div class="mx-2">
                                        <label for="filterDate" class="">Filter by Date</label><br>
                                        <input type="date" id="filterDate" name="filterDate" class="w-40 px-2 py-2 text-base border-2 border-black rounded-xl">
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
                                    {{-- <button class="h-12 px-5 py-1 mx-3 text-lg font-medium bg-green-600 rounded-xl hover:bg-green-900 hover:text-white" type="submit">Filter</button> --}}
                                </div>
                                <div class="">
                                    <select name="searchBy" id="searchBy" class="w-40 px-2 py-2 text-lg border-2 border-black rounded-xl">
                                        <option value=""class="">Search By</option>
                                        <option value="learner_course_id">Enrollee ID</option>
                                        <option value="learner_id">Learner ID</option>
                                        <option value="name">Name</option>
                                        <option value="learner_email">Email</option>
                                        <option value="learner_contactno">Contact No.</option>
                                        {{-- <option value="created_at">Date Registered</option> --}}
                                        {{-- <option value="status">Status</option> --}}
                                    </select>
                                    <input type="text" id="searchVal" name="searchVal" class="px-2 py-2 ml-3 text-lg border-2 border-black w-80 rounded-xl"  placeholder="Type to search">
                                    {{-- <button class="px-3 py-2 mx-3 text-lg font-medium bg-green-600 rounded-xl hover:bg-green-900 hover:text-white" type="submit">Search</button>         --}}
                                </div>
                            </div>
                        </form>
    
                        <div id="learner_table" class="mt-5">
                            <table>
                                <thead class="text-left">
                                    <th class="w-1/5">Enrollee ID</th>
                                    <th class="w-1/5">Learner ID</th>
                                    <th class="w-1/5">Enrollee Info</th>
                                    <th class="w-1/5">Date</th>
                                    <th class="w-1/5">Status</th>
                                    <th class="w-1/5"></th>
                                </thead>
                                <tbody id="l_enrolleeTable">
                                </tbody>
                            </table>
                        </div>
                    </div>


                    <div id="enrollment_summary" class="hidden w-full mx-5 overflow-y-auto">
    
                    </div>
  
        </div>

    </div>
</section>
</section>
@include('partials.footer')