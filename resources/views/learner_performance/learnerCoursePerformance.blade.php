@include('partials.header')

<section class="flex flex-row w-full h-screen text-sm bg-mainwhitebg md:text-base lg:h-screen">
    @include('partials.instructorNav')
@include('partials.learnerSidebar')

<section class="w-full px-2 pt-[100px] mx-2 mt-2 md:overflow-auto md:w-3/4 lg:w-9/12">
    <div  class="p-3 pb-4 overflow-auto bg-white rounded-lg shadow-lg overscroll-auto">
        <a href="{{ url("/learner/performances") }}" class="my-2 bg-gray-300 rounded-full ">
            <svg  xmlns="http://www.w3.org/2000/svg" height="30" viewBox="0 -960 960 960" width="24"><path d="M560-240 320-480l240-240 56 56-184 184 184 184-56 56Z"/></svg>
        </a>
        <h1 class="mx-5 text-xl font-normal md:text-3xl">
            <span class="text-4xl font-bold text-darthmouthgreen">{{ $learnerCourseData->course_name }}</span><br>
            <span class="mt-5 text-2xl font-semibold text-darthmouthgreen">{{ $learner->learner_fname }} {{ $learner->learner_lname }}' course performance </span>
            <hr class="mt-6 border-t-2 border-gray-300">
            <br>
            PERFORMANCE DASHBOARD
        </h1>
        <hr class="my-6 border-t-2 border-gray-300">

        <div class="flex p-10 mt-5" id="genInfo">
            <div class="w-1/2 mx-3 h-[300px] border-2 border-darthmouthgreen" id="totalLearnerPerformancePercent">
                <div class="flex justify-center mx-10 mt-10 text-center h-2/3 item-center">
                    
                    <i class="fa-solid fa-user text-darthmouthgreen text-[175px]"></i>
                    <p class="mx-5 mt-3 text-2xl font-bold py-14"><span class="text-darthmouthgreen text-[125px]" id="learnerPerformancePercent">0</span><span class="text-darthmouthgreen text-[125px]">%</span><br>Syllabus Topics Completed</p>
                </div>
                <div class="flex justify-center mt-5">
                    <div class="flex items-center mx-1">
                        <div class="w-3 h-3 mx-2 rounded-full bg-darthmouthgreen"></div>
                        <p class="font-bold text-md">COMPLETED: <span id="totalCompletedSyllabus" class="">0</span></p>
                    </div>

                    <div class="flex items-center mx-1">
                        <div class="w-3 h-3 mx-2 bg-yellow-400 rounded-full"></div>
                        <p class="font-bold text-md">IN PROGRESS: <span id="totalInProgressSyllabus" class="">0</span></p>
                    </div>

                    <div class="flex items-center mx-1">
                        <div class="w-3 h-3 mx-2 bg-red-700 rounded-full"></div>
                        <p class="font-bold text-md">NOT YET STARTED: <span id="totalLockedSyllabus" class="">0</span></p>
                    </div>
                </div>
            </div>

            <div class="w-1/2 mx-3 h-[300px] border-2 border-darthmouthgreen" id="averageLearnerProgressTime">
                <div class="flex justify-center mx-10 mt-10 text-center h-2/3 item-center">
    
                    <i class="fa-solid fa-clock text-darthmouthgreen text-[175px]"></i>
                    <p class="mx-5 mt-3 text-2xl font-bold py-14"><span class="text-darthmouthgreen text-[50px]" id="averageLearnerProgress">0</span><br>Average Time of Completion</p>
                </div>
            </div>
        </div>


        <hr class="my-6 border-t-2 border-gray-300">

            <div class="flex p-10 mt-5 w-11/12 mx-auto h-[300px] border-2 border-darthmouthgreen  overflow-y-scroll" id="learnerSyllabusProgressTable">
                <table class="w-full table-fixed">
                    <thead >
                        <th>Topic ID</th>
                        <th>Topic Title</th>
                        <th>Category</th>
                        <th>Status</th>
                    </thead>
                    <tbody style="max-height: 300px;">
                        @foreach ($learnerSyllabusData as $course)
                        <tr class="text-center">
                            <td>{{ $course->topic_id }}</td>
                            <td>{{ $course->topic_title }}</td>
                            <td>{{ $course->category }}</td>
                            <td>{{ $course->status }}</td>
                        </tr>
                        @endforeach
                        
                    </tbody>
                </table>
            </div>

            <hr class="my-6 border-t-2 border-gray-300">

            <h1 class="mx-5 mb-5 text-2xl">Lesson Progress</h1>
            <div class=" px-7" id="learnerLessonProgressChartContainer">
                <div class="flex justify-between w-full">
                    <div class="w-1/2 h-[350px] ml-5 border-2 border-darthmouthgreen" id="learnerLessonProgressChartArea">
                        <canvas id="learnerLessonProgressChart"></canvas>
                    </div>
    
                    <div class="ml-5 w-1/2 h-[350px] flex flex-col justify-between" id="learnerLessonProgressChartTable">
                        
                        <div class="border-2 h-[230px] border-darthmouthgreen overflow-y-scroll" style="max-height: 230px;">
                            <table class="w-full table-fixed">
                                <thead class="text-white text-md bg-darthmouthgreen">
                                    <th class="w-1/5">Lesson Title</th>
                                    <th class="w-1/5">Status</th>
                                    <th class="w-1/5">Start Period</th>
                                    <th class="w-1/5">Finish Period</th>
                                </thead>
                                <tbody class="overflow-y-auto text-sm text-center learnerLessonProgressRowData" style="max-height: 220px;">
                                    <!-- Your table rows go here -->
                                </tbody>
                            </table>
                        </div>
                        
                        <div class="flex items-center px-10 py-3 mt-3 border-2 border-darthmouthgreen">
                            <i class="text-4xl fa-solid fa-clock text-darthmouthgreen"></i>
                            <p class="flex items-center mx-5 mt-3 text-xl font-bold"><span class="text-darthmouthgreen text-[50px] mr-5" id="averageLearnerLessonProgress">0</span>Average Time of Completion</p>
                        </div>
                    </div>
                    
                </div>
                
                <div class="w-full mt-5 h-[350px] ml-5 border-2 border-darthmouthgreen" id="learnerLessonProgressLineChartArea">
                    <canvas id="learnerLessonProgressLineChart"></canvas>
                </div>
            </div>

            <hr class="my-6 border-t-2 border-gray-300">

            <h1 class="mx-5 mb-5 text-2xl">Activity Progress</h1>
            <div class=" px-7" id="learnerActivityProgressChartContainer">
                <div class="flex justify-between">
                    <div class="w-1/2 h-[350px] ml-5 border-2 border-darthmouthgreen" id="learnerActivityProgressChartArea">
                        <canvas id="learnerActivityProgressChart"></canvas>
                    </div>
    
                    <div class="w-1/2 h-[350px] ml-5 border-2 border-darthmouthgreen overflow-y-scroll" id="learnerActivityProgressChartTable">
                        <table class="table-fixed">
                            <thead class="py-3 text-white text-md bg-darthmouthgreen">
                                <th class="w-1/5">Activity Title</th>
                                <th class="w-1/5">Status</th>
                                <th class="w-1/5">Start Period</th>
                                <th class="w-1/5">Finish Period</th>
                                <th class="w-1/5"></th>
                            </thead>
                            <tbody class="text-sm text-center learnerActivityProgressRowData" style="max-height: 350px;">
                        
                            </tbody>
                        </table>
                    </div>
                </div>
                

                <div class="flex justify-between">
                    <div class="w-full mt-5 h-[350px] ml-5 border-2 border-darthmouthgreen" id="learnerActivityProgressLineChartArea">
                        <canvas id="learnerActivityProgressLineChart"></canvas>
                    </div>
                    <div class="w-1/3 mt-5 h-[350px] ml-5 border-2 border-darthmouthgreen"  id="learnerActivityProgressRemarksChartArea">
                        <canvas id="learnerActivityProgressRemarksChart"></canvas>
                    </div>
                </div>
               
            </div>

        
            <hr class="my-6 border-t-2 border-gray-300">

            <h1 class="mx-5 mb-5 text-2xl">Quiz Progress</h1>
            <div class=" px-7" id="learnerQuizProgressChartContainer">
                <div class="flex justify-between">
                    <div class="w-1/3 h-[350px] ml-5 border-2 border-darthmouthgreen" id="learnerQuizProgressChartArea">
                        <canvas id="learnerQuizProgressChart"></canvas>
                    </div>
    
                    <div class="w-2/3 h-[350px] ml-5 border-2 overflow-y-auto border-darthmouthgreen" id="learnerQuizProgressChartTable">
                        <table>
                            <thead class="py-3 text-white text-md bg-darthmouthgreen">
                                <th class="w-2/12">Quiz Title</th>
                                <th class="w-1/12">Status</th>
                                <th class="w-1/12">Attempt</th>
                                <th class="w-1/12">Score</th>
                                <th class="w-1/12">Remarks</th>
                                <th class="w-2/12">Start Period</th>
                                <th class="w-2/12">Finish Period</th>
                                <th class="w-2/12"></th>
                            </thead>
                            <tbody class="text-sm text-center learnerQuizProgressRowData">
            
                            </tbody>
                        </table>
                    </div>
                </div>
                
                <div class="flex justify-between">
                    <div class="w-2/3 mt-5 h-[350px] ml-5 border-2 border-darthmouthgreen" id="learnerQuizProgressLineChartArea">
                        <canvas id="learnerQuizProgressLineChart"></canvas>
                    </div>
                    <div class="w-1/3 mt-5 h-[350px] ml-5 border-2 border-darthmouthgreen"  id="learnerQuizProgressRemarksChartArea">
                        <canvas id="learnerQuizProgressRemarksChart"></canvas>
                    </div>
                </div>
                

    </div>
</section>

@include('partials.learnerProfile')
</section>
@include('partials.footer')