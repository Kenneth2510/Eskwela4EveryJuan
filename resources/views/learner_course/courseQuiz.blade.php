@include('partials.header')
<section class="flex flex-row w-full h-screen text-sm bg-mainwhitebg md:text-base lg:h-screen">


@include('partials.learnerSidebar')

<section class="w-full px-2 pt-[100px] mx-2 mt-2 md:overflow-auto md:w-3/4 lg:w-9/12">
    <div  class="p-3 pb-4 overflow-auto bg-white rounded-lg shadow-lg overscroll-auto">
        
        <div style="background-color:{{$mainBackgroundCol}};" class="p-2 text-white fill-white rounded-xl">
            <a href="{{ url("/learner/course/manage/$learnerSyllabusProgressData->course_id/overview") }}" class="my-2 bg-gray-300 rounded-full ">
                <svg  xmlns="http://www.w3.org/2000/svg" height="30" viewBox="0 -960 960 960" width="24"><path d="M560-240 320-480l240-240 56 56-184 184 184 184-56 56Z"/></svg>
            </a>
            <h1 class="w-1/2 py-4 text-5xl font-bold"><span class="">{{ $learnerSyllabusProgressData->course_name }}</span></h1>
        {{-- subheaders --}}
            <div class="flex flex-col justify-between fill-mainwhitebg">
                <h1 class="w-1/2 py-4 text-4xl font-bold"><span class="">{{ $learnerSyllabusProgressData->quiz_title }}</span></h1>
            </div>
        </div> 


        <div class="mx-2">
            <div class="mt-1 text-gray-600 text-l">
                <a href="{{ url('/learner/courses') }}" class="">course></a>
                <a href="{{ url("/learner/course/$learnerSyllabusProgressData->course_id") }}">{{$learnerSyllabusProgressData->course_name}}></a>
                <a href="{{ url("/learner/course/manage/$learnerSyllabusProgressData->course_id/overview") }}">content></a>
                <a href="">{{ $learnerSyllabusProgressData->quiz_title }}</a>
            </div>
            {{-- head --}}
            <div class="flex justify-between py-4 mt-10 border-b-2">
                <div class="flex flex-row items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32"><path fill="currentColor" d="M12 29a1 1 0 0 1-.92-.62L6.33 17H2v-2h5a1 1 0 0 1 .92.62L12 25.28l8.06-21.63A1 1 0 0 1 21 3a1 1 0 0 1 .93.68L25.72 15H30v2h-5a1 1 0 0 1-.95-.68L21 7l-8.06 21.35A1 1 0 0 1 12 29Z"/></svg>
                    <h1 class="mx-2 text-2xl font-semibold">{{$learnerSyllabusProgressData->quiz_title}}</h1>
                </div>
                <h1 class="mx-2 text-2xl font-semibold">
                    @if ($learnerSyllabusProgressData->status === "NOT YET STARTED")
                    <span class="">STATUS: NOT YET STARTED</span>
                    @elseif ($learnerSyllabusProgressData->status === "COMPLETED")
                    <span class="">STATUS: COMPLETED</span>
                    @else
                    <span class="">STATUS: IN PROGRESS</span>
                    @endif
                </h1>
            </div>

            <div class="flex flex-row items-center mt-5">
                <h3 class="my-2 text-xl font-medium">Coverage:</h3>
            </div>

            <div id="coverageArea" class="mt-5">
                <table class="w-full">
                    <thead class="h-10 text-2xl text-white bg-green-700 rounded-xl">
                      
                        <th class="w-4/5">Title</th>
                        <th class="w-3/5"></th>
                    </thead>

                    <tbody class="referenceTable">
           
                        @forelse ($quizReferenceData as $reference)
                        <tr class="h-16 py-5 mt-5">
                         
                            <td class="w-4/5">
                            <p class="mx-10 text-lg">{{$reference->topic_title}}</p>
                            </td>
                        
                        </tr>
                        @empty
                        <tr>
                            <td rowspan="3">No Criterias Found</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-16" id="durationArea">
                <h3 class="my-2 text-xl font-medium">Quiz Attempt Duration:</h3>
                <div class="">
                    <label class="text-lg" for="hours">Hours:</label>
                    <input disabled class="duration_input mx-3 px-1 w-1/12 border-2 border-gray-400 text-lg rounded-lg" type="number" id="hours" name="hours" min="0" placeholder="0" value="0" required>
            
                    <label class="text-lg" for="minutes">Minutes:</label>
                    <input disabled class="duration_input mx-3 px-1 w-1/12 border-2 border-gray-400 text-lg rounded-lg" type="number" id="minutes" name="minutes" min="0" max="59" placeholder="0" value="30" required>
            
                    <label class="text-lg" for="seconds">Seconds:</label>
                    <input disabled class="duration_input mx-3 px-1 w-1/12 border-2 border-gray-400 text-lg rounded-lg" type="number" id="seconds" name="seconds" min="0" max="59" placeholder="0" value="0" required>
                </div>
            </div>

            <script>
                document.addEventListener("DOMContentLoaded", function () {
                    // Get the milliseconds duration from your controller
                    let durationInMilliseconds = {{$learnerSyllabusProgressData->duration}};
            
                    // Calculate hours, minutes, and seconds
                    let hours = Math.floor(durationInMilliseconds / 3600000);
                    let minutes = Math.floor((durationInMilliseconds % 3600000) / 60000);
                    let seconds = Math.floor((durationInMilliseconds % 60000) / 1000);
            
                    // Set the values in the input fields
                    document.getElementById('hours').value = hours;
                    document.getElementById('minutes').value = minutes;
                    document.getElementById('seconds').value = seconds;
                });
            </script>

            @foreach ($learnerQuizProgressData as $quizAttemptData)
            <div class="mt-8 px-10" id="score_area">
                <h1 class="text-2xl font-semibold mb-2">Attempt Number: {{$quizAttemptData->attempt}}</h1>

                @if($quizAttemptData->remarks)
                <h1 class="text-2xl font-semibold mb-2">Attempt Taken on {{$quizAttemptData->updated_at}}</h1>
                @endif
                <div class="bg-gray-100 p-6 rounded-xl shadow-md">
                    <h1 class="text-3xl font-bold mb-4">Score:</h1>
                    <h1 class="text-4xl font-bold text-green-600">{{$quizAttemptData->score}} <span class="text-2xl font-bold text-black"> / {{$totalQuestionCount}}</span></h1>
                    
                    <div class="my-5">
                        <h1 class="text-xl font-semibold">Remarks:</h1>
   
                            <span class="mx-2 text-2xl font-semibold {{ $quizAttemptData->remarks == 'PASS' ? 'text-dartmouthgreen' : 'text-red-600' }}">
                                {{ $quizAttemptData->remarks }}
                            </span>
                        </h1>
                        
                    </div>

                    <div class="my-3">
                        @if($quizAttemptData->remarks)
                        <a href="{{ url("/learner/course/content/$quizAttemptData->course_id/$quizAttemptData->learner_course_id/quiz/$learnerSyllabusProgressData->syllabus_id/view_output/$quizAttemptData->attempt") }}" method="GET" class="py-3 px-5 bg-darthmouthgreen hover:bg-green-950 text-white text-lg rounded-xl">
                            View Output
                        </a> 
                        @endif
                    </div>
                    
                      
                </div>
            </div>
            @endforeach
            
            
        
            

        <div class="px-10 mt-[50px] flex justify-between">
            @if(count($learnerQuizProgressData) == 1)
                @foreach ($learnerQuizProgressData as $quizAttemptData)
                    
                    @if ($quizAttemptData->status == 'COMPLETED')
                        <!-- has attempt 1 only and complete -->
                        @if ($quizAttemptData->remarks == 'PASS')
                            <!-- has attempt 1 only and pass -->
                        <a href="{{ url("/learner/course/manage/$learnerSyllabusProgressData->course_id/overview") }}" class="flex justify-center w-1/2 py-5 mx-3 text-xl font-semibold text-white bg-darthmouthgreen hover:bg-green-900 rounded-xl">
                            Return    
                        </a>

                        <a href="{{ url("/learner/course/content/$quizAttemptData->course_id/$quizAttemptData->learner_course_id/quiz/$learnerSyllabusProgressData->syllabus_id/view_output/$quizAttemptData->attempt") }}" class="flex justify-center w-1/2 py-5 mx-3 text-xl font-semibold text-white bg-gray-400 rounded-xl cursor-not-allowed opacity-50">
                        View Output
                        </a>

                        @else
                            <!-- has attempt 1 only and fail -->
                        <a href="{{ url("/learner/course/manage/$learnerSyllabusProgressData->course_id/overview") }}" class="flex justify-center w-1/2 py-5 mx-3 text-xl font-semibold text-white bg-darthmouthgreen hover:bg-green-900 rounded-xl">
                            Return    
                        </a>

                        <a href="{{ url("/learner/course/content/$quizAttemptData->course_id/$quizAttemptData->learner_course_id/quiz/$learnerSyllabusProgressData->syllabus_id/reattempt") }}" class="flex justify-center w-1/2 py-5 mx-3 text-xl font-semibold text-white bg-darthmouthgreen hover:bg-green-900 rounded-xl">
                            Re attempt the Quiz
                        </a>

                        @endif

                    @else
                        <!-- has attempt 1 only and not yet started -->
                    <a href="{{ url("/learner/course/manage/$learnerSyllabusProgressData->course_id/overview") }}" class="flex justify-center w-1/2 py-5 mx-3 text-xl font-semibold text-white bg-darthmouthgreen hover:bg-green-900 rounded-xl">
                        Return    
                    </a>

                    <a href="{{ url("/learner/course/content/$learnerSyllabusProgressData->course_id/$learnerSyllabusProgressData->learner_course_id/quiz/$learnerSyllabusProgressData->syllabus_id/answer/$quizAttemptData->attempt") }}" class="flex justify-center w-1/2 py-5 mx-3 text-xl font-semibold text-white bg-darthmouthgreen hover:bg-green-900 rounded-xl">
                        Answer Now
                    </a>  

                    @endif


                @endforeach


            @else

                @php
                    $lastRowQuizAttemptData = $learnerQuizProgressData->last();
                @endphp
                {{-- {{ dd($lastRowQuizAttemptData) }} --}}

                @if ($lastRowQuizAttemptData->status == 'COMPLETED')
                    <!-- has attempt 2 and complete -->
                    @if ($lastRowQuizAttemptData->remarks == 'PASS')
                    <!-- has attempt 2 and pass -->
                    <a href="{{ url("/learner/course/manage/$learnerSyllabusProgressData->course_id/overview") }}" class="flex justify-center w-1/2 py-5 mx-3 text-xl font-semibold text-white bg-darthmouthgreen hover:bg-green-900 rounded-xl">
                        Return    
                    </a>

                    <a href="{{ url("/learner/course/content/$lastRowQuizAttemptData->course_id/$lastRowQuizAttemptData->learner_course_id/quiz/$learnerSyllabusProgressData->syllabus_id/view_output/$lastRowQuizAttemptData->attempt") }}" class="flex justify-center w-1/2 py-5 mx-3 text-xl font-semibold text-white bg-gray-400 rounded-xl cursor-not-allowed opacity-50">
                    View Output
                    </a>

                    @else
                    <!-- has attempt 2 and fail -->
                    <a href="{{ url("/learner/course/manage/$learnerSyllabusProgressData->course_id/overview") }}" class="flex justify-center w-1/2 py-5 mx-3 text-xl font-semibold text-white bg-darthmouthgreen hover:bg-green-900 rounded-xl">
                        Return    
                    </a>


                    <a href="{{ url("/learner/course/content/$lastRowQuizAttemptData->course_id/$lastRowQuizAttemptData->learner_course_id/quiz/$learnerSyllabusProgressData->syllabus_id/view_output/$lastRowQuizAttemptData->attempt") }}" class="flex justify-center w-1/2 py-5 mx-3 text-xl font-semibold text-white bg-gray-400 rounded-xl cursor-not-allowed opacity-50">
                        View Output
                    </a>
                    {{-- <a href="{{ url("/learner/course/content/$lastRowQuizAttemptData->course_id/$lastRowQuizAttemptData->learner_course_id/quiz/$learnerSyllabusProgressData->syllabus_id/reattempt") }}" class="flex justify-center w-1/2 py-5 mx-3 text-xl font-semibold text-white bg-darthmouthgreen hover:bg-green-900 rounded-xl">
                        Re attempt the Quiz
                    </a> --}}

                    @endif

                @else
                <!-- has attempt 2 and not yet started -->
                <a href="{{ url("/learner/course/manage/$learnerSyllabusProgressData->course_id/overview") }}" class="flex justify-center w-1/2 py-5 mx-3 text-xl font-semibold text-white bg-darthmouthgreen hover:bg-green-900 rounded-xl">
                Return    
                </a>

                <a href="{{ url("/learner/course/content/$learnerSyllabusProgressData->course_id/$learnerSyllabusProgressData->learner_course_id/quiz/$learnerSyllabusProgressData->syllabus_id/answer/$lastRowQuizAttemptData->attempt") }}" class="flex justify-center w-1/2 py-5 mx-3 text-xl font-semibold text-white bg-darthmouthgreen hover:bg-green-900 rounded-xl">
                Answer Now
                </a>  

                @endif

            @endif
        </div>
        


        
    </div>
</section>

@include('partials.learnerProfile')
</section>
@include('partials.footer')