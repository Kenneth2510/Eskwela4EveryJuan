@include('partials.header')

<section class="flex flex-row w-full h-screen text-sm main-container bg-mainwhitebg md:text-base">
    @include('partials.instructorNav')
    @include('partials.instructorSidebar')

    {{-- MAIN --}}
    <section class="w-full px-2 pt-[120px] mx-2 mt-2 md:w-3/4 lg:w-9/12  overscroll-auto md:overflow-auto">
        <div class="px-3 pb-4 overflow-auto rounded-lg shadow-lg b overscroll-auto">
            <a href="{{ url("/instructor/performances") }}" class="my-2 bg-gray-300 rounded-full ">
                <svg  xmlns="http://www.w3.org/2000/svg" height="30" viewBox="0 -960 960 960" width="24"><path d="M560-240 320-480l240-240 56 56-184 184 184 184-56 56Z"/></svg>
            </a>
            <h1 class="mx-5 text-xl font-normal  md:text-3xl">
                <span class="text-4xl font-bold text-darthmouthgreen">{{ $course->course_name }}</span>
                <hr class="border-t-2 border-gray-300 mt-6">
                <br>
                PERFORMANCE DASHBOARD</h1>

            <div class="mt-5 p-10 flex" id="genInfo">
                <div class="w-1/2 mx-3 h-[300px] border-2 border-darthmouthgreen" id="totalLearnersArea">
                    <div class=" mt-10 mx-10 h-2/3 text-center item-center flex justify-center">
                        
                        <i class="fa-solid fa-user text-darthmouthgreen text-[175px]"></i>
                        <p class="font-bold mt-3 py-14 mx-5 text-2xl"><span class="text-darthmouthgreen text-[125px]" id="totalLearnerCourseCount">0</span><br>Total Learner</p>
                    </div>
                    <div class="flex mt-5 justify-center">
                        <div class="flex items-center mx-3">
                            <div class="rounded-full w-3 h-3 mx-3 bg-darthmouthgreen"></div>
                            <p class="font-bold text-md">Approved: <span id="totalApprovedLearnerCourseCount" class="">0</span></p>
                        </div>

                        <div class="flex items-center mx-3">
                            <div class="rounded-full w-3 h-3 mx-3 bg-yellow-400"></div>
                            <p class="font-bold text-md">Pending: <span id="totalPendingLearnerCourseCount" class="">0</span></p>
                        </div>

                        <div class="flex items-center mx-3">
                            <div class="rounded-full w-3 h-3 mx-3 bg-red-700"></div>
                            <p class="font-bold text-md">Rejected: <span id="totalRejectedLearnerCourseCount" class="">0</span></p>
                        </div>
                    </div>
                </div>
                <div class="w-1/2 mx-3 h-[300px] border-2 border-darthmouthgreen" id="totalLearnersArea">
                    <div class=" mt-10 mx-10 h-2/3 text-center item-center flex justify-center">
                        
                        <i class="fa-solid fa-book-bookmark text-darthmouthgreen text-[175px]"></i>
                        <p class="font-bold mt-3 py-14 mx-5 text-2xl"><span class="text-darthmouthgreen text-[125px]" id="totalSyllabusCount">0</span><br>Total Topics</p>
                    </div>
                    <div class="flex mt-5 justify-center">
                        <div class="flex items-center mx-3">
                            <i class="fa-solid fa-file text-darthmouthgreen text-2xl mx-3"></i>
                            <p class="font-bold text-md">Lessons: <span id="totalLessonsCount" class="">0</span></p>
                        </div>

                        <div class="flex items-center mx-3">
                            <i class="fa-solid fa-clipboard text-darthmouthgreen text-2xl mx-3"></i>
                            <p class="font-bold text-md">Activities: <span id="totalActivitiesCount" class="">0</span></p>
                        </div>

                        <div class="flex items-center mx-3">
                            <i class="fa-solid fa-pen-to-square text-darthmouthgreen text-2xl mx-3"></i>
                            <p class="font-bold text-md">Quizzes: <span id="totalQuizzesCount" class="">0</span></p>
                        </div>
                    </div>
                </div>
            </div>

            <hr class="border-t-2 border-gray-300 my-6">

            <h1 class="text-2xl mx-5 mb-5">Course Progress</h1>
            <div class="flex justify-between" id="learnerCourseProgressArea">
                <div class="w-3/5 h-[350px] ml-5 border-2 border-darthmouthgreen" id="learnerCourseProgressChart">
                    <canvas id="learnerCourseDataChart"></canvas>
                </div>

                <div class="w-2/5 h-[350px] ml-5 border-2 border-darthmouthgreen overflow-y-scroll" id="learnerCourseListArea">
                    <table id="learnerCourseTable" class="w-full table-fixed">
                        <thead class="bg-darthmouthgreen text-white">
                            <th class="w-1/5">Name</th>
                            <th class="w-1/5">Date Enrolled</th>
                            <th class="w-1/5">Progress</th>
                            <th class="w-1/5"></th>
                        </thead>
                        <tbody class="learnerCourseRowData" style="max-height: 300px;">
                          
                        </tbody>
                    </table>
                </div>
                
                
            </div>

            <hr class="border-t-2 border-gray-300 my-6">

            <div class="flex flex-col justify-center items-center mt-5 w-full" id="topicDetailsArea">
                <div class="w-full" id="selectTopicArea">
                    <select name="" class="border-2 border-darthmouthgreen w-full text-lg px-5 py-3" id="selectTopic">
                        <option value="" disabled selected>Choose Topic</option>
                        @foreach ($syllabus as $topic)
                            <option value="{{ $topic->syllabus_id }}">{{ $topic->topic_title }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="w-full mx-10 mt-5 h-[400px] border-2 border-darthmouthgreen" id="learnerCourseTopicProgressChart">
                    <canvas id="learnerTopicDataChart"></canvas>
                </div>

                <div class="mt-5 w-full px-10 flex flex-col" id="learnerCourseTopicProgressTable">
                    <a href="" method="GET" class="text-right underline text-xl text-darthmouthgreen hover:text-green-950">view more details</a>
                    <table id="learnerSyllabusTable" class="w-full mt-5">
                        <thead class="bg-darthmouthgreen text-white">
                            <th class="w-1/5">Name</th>
                            <th class="w-1/5">Date Enrolled</th>
                            <th class="w-1/5">Progress</th>
                            <th class="w-1/5">Start Date</th>
                            <th class="w-1/5">Finish Date</th>
                            <th class="w-1/5"></th>
                        </thead>
                        <tbody class="learnerSyllabusRowData">
                       
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
@include('partials.instructorProfile')
</section>
@include('partials.footer')