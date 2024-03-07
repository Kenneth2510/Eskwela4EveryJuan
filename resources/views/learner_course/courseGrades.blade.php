@include('partials.header')
<section class="flex flex-row w-full h-screen text-sm bg-mainwhitebg md:text-base lg:h-screen">


@include('partials.learnerSidebar')

<section class="w-full px-2 pt-[100px] mx-2 mt-2 md:overflow-auto md:w-3/4 lg:w-9/12">
    <div  class="p-3 pb-4 overflow-auto bg-white rounded-lg shadow-lg overscroll-auto">
        
        <div style="background-color:{{$mainBackgroundCol}};" class="p-2 text-white fill-white rounded-xl">
            <a href="{{ url("/learner/course/manage/$courseData->course_id/overview") }}" class="my-2 bg-gray-300 rounded-full ">
                <svg  xmlns="http://www.w3.org/2000/svg" height="30" viewBox="0 -960 960 960" width="24"><path d="M560-240 320-480l240-240 56 56-184 184 184 184-56 56Z"/></svg>
            </a>
            <h1 class="w-1/2 py-4 text-5xl font-bold"><span class="">{{ $courseData->course_name }}</span></h1>
        {{-- subheaders --}}
            <div class="flex flex-col justify-between fill-mainwhitebg">
                <h1 class="w-1/2 py-4 text-4xl font-bold"><span class="">COURSE GRADESHEET</span></h1>
            </div>
        </div> 


        <div class="mx-2">
            <div class="mt-1 text-gray-600 text-l">
                <a href="{{ url('/learner/courses') }}" class="">course></a>
                <a href="{{ url("/learner/course/$courseData->course_id") }}">{{$courseData->course_name}}></a>
                <a href="{{ url("/learner/course/manage/$courseData->course_id/overview") }}">content></a>
                <a href="">Grades</a>
            </div>
            {{-- head --}}
            <div class="flex justify-between py-4 mt-10 border-b-2">
                <div class="flex flex-row items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32"><path fill="currentColor" d="M12 29a1 1 0 0 1-.92-.62L6.33 17H2v-2h5a1 1 0 0 1 .92.62L12 25.28l8.06-21.63A1 1 0 0 1 21 3a1 1 0 0 1 .93.68L25.72 15H30v2h-5a1 1 0 0 1-.95-.68L21 7l-8.06 21.35A1 1 0 0 1 12 29Z"/></svg>
                    <h1 class="mx-2 text-2xl font-semibold">Gradesheet</h1>
                </div>
                <h1 class="mx-2 text-2xl font-semibold">
                    @if ($courseData->course_progress === "NOT YET STARTED")
                    <span class="">STATUS: NOT YET STARTED</span>
                    @elseif ($courseData->course_progress === "COMPLETED")
                    <span class="">STATUS: COMPLETED</span>
                    @else
                    <span class="">STATUS: IN PROGRESS</span>
                    @endif
                </h1>
            </div>
        </div>

        <div class="mt-10">
            <h1 class="mx-2 text-2xl font-semibold">Pre Assessment</h1>
            <h1 class="py-5 mx-16 text-4xl font-bold text-green-600">{{$preAssessmentLearnerSumScore}} <span class="text-2xl font-bold text-black"> / {{$totalScoreCount_pre_assessment}}</span></h1>
        </div>
                    

        <div class="mt-10">
            <h1 class="mx-2 text-2xl font-semibold">Lessons</h1>
            <table class="text-center py-5 mx-16 w-[700px]">
                <thead>
                    <th>Lesson Title</th>
                    <th>Start Date</th>
                    <th>Finish Date</th>
                </thead>
                <tbody>
                    @foreach ($learnerLessonsData as $lesson)
                        <tr>
                            <td>{{ $lesson->lesson_title }}</td>
                            <td>{{ $lesson->start_period }}</td>
                            <td>{{ $lesson->finish_period }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-10">
            <h1 class="mx-2 text-2xl font-semibold">Activities</h1>
            <table class="text-center py-5 mx-16 w-[700px]">
                <thead>
                    <th>Activity Title</th>
                    <th>Score</th>
                </thead>
                <tbody>
                    @foreach ($activityScoresData as $activity)
                        <tr>
                            <td>{{ $activity->activity_title }}</td>
                            <td>{{ $activity->average_score }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-10">
            <h1 class="mx-2 text-2xl font-semibold">Quizzes</h1>
            <table class="text-center py-5 mx-16 w-[700px]">
                <thead>
                    <th>Quiz Title</th>
                    <th>Score</th>
                </thead>
                <tbody>
                    @foreach ($quizScoresData as $quiz)
                        <tr>
                            <td>{{ $quiz->quiz_title }}</td>
                            <td>{{ $quiz->average_score }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-10">
            <h1 class="mx-2 text-2xl font-semibold">Post Assessment</h1>
            <h1 class="py-5 mx-16 text-4xl font-bold text-green-600">{{$postAssessmentLearnerSumScore}} <span class="text-2xl font-bold text-black"> / {{$totalScoreCount_post_assessment}}</span></h1>
        </div>

        
        @if($courseData->course_progress === 'COMPLETED')
        <hr class="my-6 border-t-2 border-gray-300">
        <h1 class="mx-2 text-2xl font-semibold">Computation of Grades</h1>
        <div class="px-10 mt-3">

            <h1 class="text-xl font-bold">Activities</h1>
            <p class="py-5 mx-16 text-xl font-bold">[[ {{ $activityLearnerSumScore }}  / {{ $activityTotalSum }} ] x 100 ] x 35% = {{ $activityGrade }}%</p>

            
            <h1 class="text-xl font-bold">Quizzes</h1>
            <p class="py-5 mx-16 text-xl font-bold">[[ {{ $quizLearnerSumScore }}  / {{ $quizTotalSum }} ] x 100 ] x 35% = {{ $quizGrade }}%</p>


            <h1 class="text-xl font-bold">Post Assessment</h1>
            <p class="py-5 mx-16 text-xl font-bold">[[ {{ $postAssessmentLearnerSumScore }}  / {{ $totalScoreCount_post_assessment }} ] x 100 ] x 30% = {{ $postAssessmentScoreGrade }}%</p>

            <h1 class="text-xl font-bold text-green-600">Overall Grade</h1>
            <p class="py-5 mx-16 text-xl font-bold text-green-600">{{ $activityGrade }} + {{ $quizGrade }} + {{$postAssessmentScoreGrade}} = {{ $totalGrade }}%</p>
            

            <hr class="my-6 border-t-2 border-gray-300">
            <h1 class="text-2xl font-bold">Final Grade: <span class="text-green-600">{{$totalGrade}}%</span></h1>
            <h1 class="text-2xl font-bold">Remarks: <span class="text-green-600">{{$remarks}}</span></h1>
        </div>
        @endif
    </div>
</section>

@include('partials.learnerProfile')
</section>
@include('partials.footer')