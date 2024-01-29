@include('partials.header')
<section class="flex flex-row w-full h-screen text-sm main-container bg-mainwhitebg md:text-base">

    @include('partials.instructorNav')
    @include('partials.instructorSidebar')

        
    {{-- MAIN --}}
    <section class="w-full px-2 pt-[70px] mx-2 mt-2 md:w-3/4 lg:w-9/12  overscroll-auto md:overflow-auto">
        {{-- course name/title --}}
        <a href="{{ url('/instructor/courses') }}" class="w-8 h-8 m-2">
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
                        <button class="my-1 px-5 py-3 text-xl rounded-xl bg-darthmouthgreen text-white hover:bg-white hover:text-darthmouthgreen hover:border-2 hover:border-darthmouthgreen">Enter</button>
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


        <div class="mt-5 h-[250px] flex justify-between" id="enrolledData">
            <div class="w-5/12" id="totalEnrollees">
                <h1 class="mt-10 text-2xl text-center">
                    <span class="text-6xl font-semibold text-darthmouthgreen">
                        {{$totalEnrolledCount}}
                    </span><br>
                    Learners Enrolled
                </h1>
            </div>
            <div class="w-7/12 flex justify-between items-center" id="learnerProgressData">
                <canvas id="learnerProgressChart"></canvas>
            </div>
        </div>


        <div class="mt-16 mx-5" id="learnerProgressArea">
            <div class="">
                <h1 class="text-4xl font-semibold">Enrolled Learners</h1>
             
            </div>
            
            <div class="mx-5 px-5">
                <table class="w-full mt-5">
                    <thead class="text-left">
                        <th class="text-lg">Name</th>
                        <th class="text-lg">Email</th>
                        <th class="text-lg">Date Enrolled</th>
                        <th class="text-lg">Status</th>
                        <th class="text-lg"></th>
                    </thead>
                    <tbody id="enrollePercentArea">
                        @foreach ($courseEnrollees as $enrollee)
                            <tr>
                                <td class="py-5">{{$enrollee->learner_fname}} {{$enrollee->learner_lname}}</td>
                                <td>{{$enrollee->learner_email}}</td>
                                <td>{{$enrollee->start_period}}</td>
                                <td>{{$enrollee->course_progress}}</td>
                                <td>
                                    <a class="px-5 py-3 bg-darthmouthgreen text-white rounded-xl hover:bg-white hover:text-darthmouthgreen hover:border-2 hover:border-darthmouthgreen" href="{{ url("instructor/viewProfile/$enrollee->learner_id") }}">
                                        view profile
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    
        
    </section>
    
@include('partials.instructorProfile')    {{-- @include('instructor_course.courseManage'); --}}
</div>
</section>

@include('partials.footer')