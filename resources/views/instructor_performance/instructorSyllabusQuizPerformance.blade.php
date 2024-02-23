@include('partials.header')

<section class="flex flex-row w-full h-screen text-sm main-container bg-mainwhitebg md:text-base">
    @include('partials.instructorNav')
    @include('partials.instructorSidebar')

    {{-- MAIN --}}
    <section class="w-full px-2 pt-[120px] mx-2 mt-2 md:w-3/4 lg:w-9/12  overscroll-auto md:overflow-auto">
        <div class="px-3 pb-4 overflow-auto rounded-lg shadow-lg b overscroll-auto">
            <a href="{{ url("/instructor/performances/course/$courseData->course_id") }}" class="my-2 bg-gray-300 rounded-full ">
                <svg  xmlns="http://www.w3.org/2000/svg" height="30" viewBox="0 -960 960 960" width="24"><path d="M560-240 320-480l240-240 56 56-184 184 184 184-56 56Z"/></svg>
            </a>
            <h1 class="mx-5 text-xl font-normal  md:text-3xl">
                <span class="text-4xl font-bold text-darthmouthgreen">{{ $courseData->course_name }}</span><br>
                <span class="mt-3 text-2xl font-semibold text-darthmouthgreen">{{ $syllabusData->topic_title }}</span>
                <hr class="border-t-2 border-gray-300 mt-6">
                <br>
                PERFORMANCE DASHBOARD</h1>

                <div class="mt-5 p-10 flex" id="genInfo">
                    <div class="w-1/2 mx-3 h-[300px] border-2 border-darthmouthgreen" id="totalLearnerProgressCount">
                        <div class=" mt-10 mx-10 h-2/3 text-center item-center flex justify-center">
                            
                            <i class="fa-solid fa-user text-darthmouthgreen text-[175px]"></i>
                            <p class="font-bold mt-3 py-14 mx-5 text-2xl"><span class="text-darthmouthgreen text-[125px]" id="totalLearnerSyllabusCompleteStatus">0</span><br>Learners Completed</p>
                        </div>
                        <div class="flex mt-5 justify-center">
                            <div class="flex items-center mx-1">
                                <div class="rounded-full w-3 h-3 mx-2 bg-darthmouthgreen"></div>
                                <p class="font-bold text-md">TOTAL: <span id="totalLearnersCount" class="">0</span></p>
                            </div>
    
                            <div class="flex items-center mx-1">
                                <div class="rounded-full w-3 h-3 mx-2 bg-yellow-400"></div>
                                <p class="font-bold text-md">IN PROGRESS: <span id="totalLearnerSyllabusInProgressStatus" class="">0</span></p>
                            </div>
    
                            <div class="flex items-center mx-1">
                                <div class="rounded-full w-3 h-3 mx-2 bg-red-700"></div>
                                <p class="font-bold text-md">NOT YET STARTED: <span id="totalLearnerSyllabusNotYetStatus" class="">0</span></p>
                            </div>
                        </div>
                    </div>
    
    
                    <div class="w-1/2 mx-3 h-[300px] border-2 border-darthmouthgreen" id="averageLearnerProgressTime">
                        <div class=" mt-10 mx-10 h-2/3 text-center item-center flex justify-center">
            
                            <i class="fa-solid fa-clock text-darthmouthgreen text-[175px]"></i>
                            <p class="font-bold mt-3 py-14 mx-5 text-2xl"><span class="text-darthmouthgreen text-[50px]" id="averageLearnerProgress">0</span><br>Average Time of Completion</p>
                        </div>
                    </div>
                </div>

                <hr class="border-t-2 border-gray-300 my-6">

                <h1 class="text-2xl mx-5 mb-5">Quiz Progress</h1>
                <div class="flex px-7 justify-between" id="learnerSyllabusChartsArea">

                    <div class="w-1/3 h-[350px] ml-5 border-2 border-darthmouthgreen" id="learnerSyllabusStatusChartArea">
                        <canvas id="learnerSyllabusStatusChart"></canvas>
                    </div>

                    <div class="w-1/3 h-[350px] ml-5 border-2 border-darthmouthgreen" id="learnerSyllabusStatusTimeChartArea">
                        <canvas id="learnerSyllabusStatusTimeChart"></canvas>
                    </div>

                    <div class="w-1/3 h-[350px] ml-5 border-2 border-darthmouthgreen" id="learnerSyllabusAttemptNumberChartArea">
                        <canvas id="learnerSyllabusAttemptNumberChart"></canvas>
                    </div>
                </div>

                <hr class="border-t-2 border-gray-300 my-6">

                <h1 class="text-2xl mx-5 mb-5">Quiz Outputs</h1>
                <div class="flex px-7 justify-between" id="learnerSyllabusOutputChartsArea">

                    <div class="w-2/3 h-[350px] ml-5 border-2 border-darthmouthgreen" id="learnerSyllabusOverallScoreChartArea">
                        <canvas id="learnerSyllabusOverallScoreChart"></canvas>
                    </div>

                    <div class="w-1/3 h-[350px] ml-5 border-2 border-darthmouthgreen" id="learnerSyllabusRemarksChartArea">
                        <canvas id="learnerSyllabusRemarksChart"></canvas>
                    </div>
                </div>


                <hr class="border-t-2 border-gray-300 my-6">

                <div class="mt-5 w-full px-10 flex flex-col" id="learnerSyllabusProgressTableArea" style="height: 500px; overflow-y: scroll;">
                    <table class="w-full mt-5">
                        <thead class="bg-darthmouthgreen text-white text-xl py-3">
                            <th class="w-2/12">Name</th>
                            <th class="w-1/12">Status</th>
                            <th class="w-1/12">Attempt</th>
                            <th class="w-1/12">Score</th>
                            <th class="w-1/12">Remarks</th>
                            <th class="w-2/12">Start Period</th>
                            <th class="w-2/12">Finish Period</th>
                            <th class="w-1/12"></th>
                        </thead>
                        <tbody class="text-center text-lg learnerSyllabusProgressRowData">
                           
                        </tbody>
                    </table>
                </div>


                <hr class="border-t-2 border-gray-300 my-6">

                <h1 class="text-2xl mx-5 mb-5">Quiz Content</h1>
                <div class="px-7 justify-between" id="learnerSyllabusQuizOutputArea">

                    {{-- <div class="flex">
                        <div class="w-2/3 h-[350px] ml-5 border-2 border-darthmouthgreen learnerSyllabusQuizContentOutputArea" id="">
                            <canvas id="learnerSyllabusQuizContentOutputArea"></canvas>
                        </div>
                    </div> --}}

                    
                    
                </div>

        </div>
    </section>
@include('partials.instructorProfile')
</section>
@include('partials.footer')