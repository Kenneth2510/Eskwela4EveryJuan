@include('partials.header')
<section class="flex flex-row w-full h-screen text-sm main-container bg-mainwhitebg md:text-base">

    @include('partials.instructorNav')
    @include('partials.learnerSidebar')

        
    {{-- MAIN --}}
    <section class="w-full px-2 pt-[70px] mx-2 mt-2 md:w-3/4 lg:w-9/12  overscroll-auto md:overflow-auto">
    {{-- course name/title --}}
    <a href="{{ url('/learner/dashboard') }}" class="w-8 h-8 m-2">
        <svg xmlns="http://www.w3.org/2000/svg" height="25" viewBox="0 -960 960 960" width="24"><path d="m313-440 224 224-57 56-320-320 320-320 57 56-224 224h487v80H313Z"/></svg>
    </a>

    <div class="relative z-0 pb-4 border rounded-lg shadow-lg text-black">
        <div class="mx-3 px-5 flex justify-between" id="courseInfo">
            <div class="" id="courseInfo_left">
                <h1 class="text-6xl font-semibold">{{$course->course_name}}</h1>
                <h4 class="text-4xl">{{$course->course_code}}</h4>
                <h4 class="text-xl mt-10">Course Level: {{$course->course_difficulty}}</h4>
                <h4 class="text-xl"><i class="fa-regular fa-clock text-darthmouthgreen"></i> Est. Time:  {{$totalCourseTime}}</h4>
                <h4 class="text-xl mt-3">Total  Units: {{$totalSyllabusCount}}</h4>
                <h4 class="text-xl pl-5"><i class="fa-regular fa-file text-darthmouthgreen"></i> Lessons: {{$totalLessonsCount}}</h4>
                <h4 class="text-xl pl-5"><i class="fa-regular fa-clipboard text-darthmouthgreen"></i> Activities: {{$totalActivitiesCount}}</h4>
                <h4 class="text-xl pl-5"><i class="fa-regular fa-pen-to-square text-darthmouthgreen"></i> Quizzes:  {{$totalQuizzesCount}}</h4>
            </div>
            <div class="flex flex-col justify-between items-center mr-10" id="courseInfo_right">
                <img class="mb-10 my-4 rounded-full w-40 h-40 lg:w-40 lg:h-40" src="{{ asset('storage/' . $course->profile_picture) }}" alt="Profile Picture">
                <div class="flex flex-col">
                    @if($isEnrolled)
                    <button class="my-1 px-5 py-3 text-xl rounded-xl bg-darthmouthgreen text-white hover:bg-white hover:text-darthmouthgreen hover:border-2 hover:border-darthmouthgreen">Enter</button>
                    @else
                    <button class="my-1 px-5 py-3 text-xl rounded-xl bg-darthmouthgreen text-white hover:bg-white hover:text-darthmouthgreen hover:border-2 hover:border-darthmouthgreen">Enroll Now</button>
                    @endif
                    
                    <button class="my-1 px-5 py-3 text-lg rounded-xl bg-darthmouthgreen text-white hover:bg-white hover:text-darthmouthgreen hover:border-2 hover:border-darthmouthgreen">View Details</button>    
                </div>
            </div>
        </div>
    </div>

    <div class="flex justify-between mt-10 px-5 relative z-0 pb-4 border rounded-lg shadow-lg text-black" id="courseDescAndTopics">
        <div class="w-7/12 overflow-y-auto h-[400px]" id="courseDesc">
            <h1 class="text-4xl font-semibold">Course Description</h1>
            <div class="whitespace-pre-line">
                {{$course->course_description}}
            </div>
        </div>
        <div class="w-5/12 ml-5 overflow-y-auto h-[400px]" id="courseTopics">
            <h1 class="text-4xl font-semibold">Course Topics</h1>
            @foreach ($syllabus as $topic)
                @if ($topic->category === "LESSON")
                    <h4 class="text-lg px-5 pt-5"><i class="fa-regular fa-file text-darthmouthgreen text-2xl "></i> - {{$topic->topic_title}}</h4>
                @elseif ($topic->category === "ACTIVITY")
                    <h4 class="text-lg px-5 pt-5"><i class="fa-regular fa-clipboard text-darthmouthgreen text-2xl "></i> - {{$topic->topic_title}}</h4>
                @elseif ($topic->category === "QUIZ")
                    <h4 class="text-lg px-5 pt-5"><i class="fa-regular fa-pen-to-square text-darthmouthgreen text-2xl "></i> - {{$topic->topic_title}}</h4>
                @endif
            @endforeach
        </div>
    </div>

    <div class="mt-5 flex justify-between" id="enrolledData">
        <div class="w-7/12 h-[100px]" id="totalEnrollees">
            <h1 class="mt-10 text-2xl text-center">
                <span class="text-6xl font-semibold text-darthmouthgreen">
                    {{$totalEnrolledCount}}
                </span><br>
                Learners Enrolled
            </h1>
        </div>
        <div class="w-5/12 flex justify-between items-center" id="learnerProgressData">
            <div class="mx-1" id="progressPercent">
                <h1 class="mt-10 text-2xl text-center">
                    <span class="text-6xl font-semibold text-darthmouthgreen">
                        {{$progressPercent}} %
                    </span><br>
                    Progress
                </h1>
            </div>
            <div class="mx-1" id="totalTimeSpent">
                <h1 class="mt-10 text-2xl text-center">
                    <span class="text-4xl font-semibold text-darthmouthgreen">
                        <i class="fa-regular fa-clock text-darthmouthgreen"></i> {{$totalLearnerTime}}
                    </span><br>
                    Time Spent
                </h1>
            </div>
        </div>
    </div>

    <div class="mt-16" id="learnerProgressArea">
        <div class="">
            <h1 class="text-4xl font-semibold">Your Progress</h1>
            <div class="mt-3 h-7 rounded-xl" style="background: #9DB0A3" id="skill_bar">
                <div class="h-7 relative bg-darthmouthgreen rounded-xl text-white text-center py-1" id="skill_per" per="{{$progressPercent}}%" style="max-width: {{$progressPercent}}%">{{$progressPercent}}%</div>
            </div>    
        </div>
        
        <div class="mx-5 px-5">
            <table class="w-full mt-5">
                <thead class="text-left">
                    <th class="text-lg">Topic</th>
                    <th class="text-lg">Status</th>
                </thead>
                <tbody id="enrollePercentArea">
                    @foreach ($syllabusProgress as $topic)
                    <tr>
                        <td class="px-5">{{$topic->topic_title}}</td>
                        <td>{{$topic->status}}</td>
                    </tr>
                    @endforeach
                    
                </tbody>
            </table>
        </div>
    </div>


    {{-- @if($isEnrolled !== null)

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
            </div>
        </form>
    </div>
    @endif --}}




       
</section>

@include('partials.learnerProfile')
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
</div>
</section>
@include('partials.footer')