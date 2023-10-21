@include('partials.header')
@include('partials.sidebar')

<section id="view_learner_container" class="relative w-4/5 h-full left-80">

    <div id="title" class="relative flex items-center justify-between h-16 px-3 mx-auto my-3 py-auto">
        <h1 class="text-4xl font-semibold">View Learner Details</h1>
        <div id="adminuser" class="flex items-center">
            <h3 class="text-lg">{{ $adminCodeName }}</h3>
            <div id="icon" class="w-10 h-10 mx-3 rounded-full bg-slate-400"></div>
        </div>
    </div>

    <div id="maincontainer" class="relative max-h-full px-5 py-5 shadow-2xl bg-white mt-7 rounded-2xl">
        <div class="mb-5">
            <a href="/admin/view_course/{{$course->course_id}}" class="">
                <i class="text-2xl md:text-3xl fa-solid fa-arrow-left" style="color: #000000;"></i>
            </a>
        </div>


        <div class="flex">
            <div id="courseSidebar" class="py-10 w-1/5 bg-seagreen">
                <ul class="px-5 py-5 text-white text-xl font-medium">
                    <a href="/admin/manage_course/course_overview/{{ $course->course_id }}">
                        <li id="courseOverviewBtn" class="selected w-full py-5 rounded-xl px-2 mt-2 hover:bg-green-900">
                            <i class="fa-solid fa-book-open text-3xl pr-2"></i>
                            Course Overview
                    </li>
                    </a>
                    <a href="/admin/manage_course/enrollees/{{ $course->course_id }}">
                        <li id="enrolledLearnersBtn" class="w-full py-5 rounded-xl px-2 mt-2 hover:bg-green-900">
                            <i class="fa-solid fa-users text-3xl pr-2"></i>
                            Enrolled Learners
                    </li>
                    </a>
                    <a href="/admin/manage_course/content/{{ $course->course_id }}">
                        <li id="courseContentBtn" class="w-full py-5 rounded-xl px-2 mt-2 hover:bg-green-900">
                            <i class="fa-solid fa-book text-3xl pr-2"></i>
                            Course Content
                    </li>
                    </a>
                    
                    <li class="w-full py-3 rounded-xl px-2 mt-2">
                      
                    </li>
                    <li class="w-full py-3 rounded-xl px-2 mt-2">
                      
                    </li>
                </ul>
            </div>

            <div id="contentArea" class="mx-3 my-5 w-[1150px]">

                <div id="courseOverview" class="">
                    <div class="relative z-0 pb-4 bg-black border border-gray-400 rounded-lg shadow-lg text-mainwhitebg">
                        <img class="absolute top-0 left-0 object-cover w-full h-full pointer-events-none -z-10 opacity-30" src="{{asset('images/marketing-img.png')}}" alt="computer with microphone">
                        <div class="z-50 p-2 flex items-center justify-between">
                           
                            {{-- subheaders --}}
                            <div class="">
                                <h1 class="w-1/2 py-4 text-4xl font-semibold"><span class="">{{ $course->course_name }}</span></h1>
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
                                <div class="w-full">
                                    <button class="w-32 h-10 m-2 rounded-full bg-seagreen">
                                        <h1>View Course</h1>
                                    </button>
                                </div>
                            </div>
                            <div id="icon" class="my-3 mx-5 rounded-full">
                                <img class="w-32 h-32 mx-auto my-3 bg-gray-400 rounded-full" src="{{ asset('storage/'. $course->profile_picture)}}" alt="Profile Picture">
                                <p>Instructor</p>
                                <p class="text-white font-medium">{{$course->instructor_fname}} {{$course->instructor_lname}} </p>
                            </div>
                        </div>
                        
                    </div>
                   

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
                </div>

            </div>
        </div>
    </div>
</section>


@include('partials.footer')