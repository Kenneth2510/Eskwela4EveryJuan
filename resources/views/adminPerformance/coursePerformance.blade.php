@include('partials.header')

<section class="flex flex-row w-screen text-sm main-container bg-mainwhitebg md:text-base">
@include('partials.sidebar')




<section class="w-screen px-2 pt-[40px] mx-2 mt-2  overscroll-auto md:overflow-auto">
    <div class="flex justify-between px-10">
        <h1 class="text-6xl font-bold text-darthmouthgreen">Performance Overview</h1>
        <div class="">
            <p class="text-xl font-semibold text-darthmouthgreen">{{$admin->admin_codename}}</p>
        </div>
    </div>

    <div class="mt-10">
        <div class="mb-5">
            <a href="/admin/performance" class="">
                <i class="text-2xl md:text-3xl fa-solid fa-arrow-left" style="color: #000000;"></i>
            </a>
        </div>
        <h1 class="mx-5 text-2xl font-semibold">{{$course->course_name}}'s Overview</h1>
        <hr class="my-6 border-t-2 border-gray-300">    
    </div>


    <div class="flex p-10 mt-5" id="genInfo">
        <div class="w-1/2 mx-3 h-[300px] border-2 border-darthmouthgreen" id="totalLearnersArea">
            <div class="flex justify-center mx-10 mt-10 text-center  h-2/3 item-center">
                
                <i class="fa-solid fa-user text-darthmouthgreen text-[175px]"></i>
                <p class="mx-5 mt-3 text-2xl font-bold py-14"><span class="text-darthmouthgreen text-[125px]" id="totalLearnerCourseCount">0</span><br>Total Learner</p>
            </div>
            <div class="flex justify-center mt-5">
                <div class="flex items-center mx-3">
                    <div class="w-3 h-3 mx-3 rounded-full bg-darthmouthgreen"></div>
                    <p class="font-bold text-md">Approved: <span id="totalApprovedLearnerCourseCount" class="">0</span></p>
                </div>

                <div class="flex items-center mx-3">
                    <div class="w-3 h-3 mx-3 bg-yellow-400 rounded-full"></div>
                    <p class="font-bold text-md">Pending: <span id="totalPendingLearnerCourseCount" class="">0</span></p>
                </div>

                <div class="flex items-center mx-3">
                    <div class="w-3 h-3 mx-3 bg-red-700 rounded-full"></div>
                    <p class="font-bold text-md">Rejected: <span id="totalRejectedLearnerCourseCount" class="">0</span></p>
                </div>
            </div>
        </div>
        <div class="w-1/2 mx-3 h-[300px] border-2 border-darthmouthgreen" id="totalLearnersArea">
            <div class="flex justify-center mx-10 mt-10 text-center  h-2/3 item-center">
                
                <i class="fa-solid fa-book-bookmark text-darthmouthgreen text-[175px]"></i>
                <p class="mx-5 mt-3 text-2xl font-bold py-14"><span class="text-darthmouthgreen text-[125px]" id="totalSyllabusCount">0</span><br>Total Topics</p>
            </div>
            <div class="flex justify-center mt-5">
                <div class="flex items-center mx-3">
                    <i class="mx-3 text-2xl fa-solid fa-file text-darthmouthgreen"></i>
                    <p class="font-bold text-md">Lessons: <span id="totalLessonsCount" class="">0</span></p>
                </div>

                <div class="flex items-center mx-3">
                    <i class="mx-3 text-2xl fa-solid fa-clipboard text-darthmouthgreen"></i>
                    <p class="font-bold text-md">Activities: <span id="totalActivitiesCount" class="">0</span></p>
                </div>

                <div class="flex items-center mx-3">
                    <i class="mx-3 text-2xl fa-solid fa-pen-to-square text-darthmouthgreen"></i>
                    <p class="font-bold text-md">Quizzes: <span id="totalQuizzesCount" class="">0</span></p>
                </div>
            </div>
        </div>
    </div>

    <hr class="my-6 border-t-2 border-gray-300">

    <h1 class="mx-5 mb-5 text-2xl">Course Progress</h1>
    <div class="flex justify-between" id="learnerCourseProgressArea">
        <div class="w-3/5 h-[350px] ml-5 border-2 border-darthmouthgreen" id="learnerCourseProgressChart">
            <canvas id="learnerCourseDataChart"></canvas>
        </div>

        <div class="w-2/5 h-[350px] ml-5 border-2 border-darthmouthgreen overflow-y-scroll" id="learnerCourseListArea">
            <table id="learnerCourseTable" class="w-full table-fixed">
                <thead class="text-white bg-darthmouthgreen">
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

    <hr class="my-6 border-t-2 border-gray-300">

    <div class="flex flex-col items-center justify-center w-full mt-5" id="topicDetailsArea">
        <div class="w-full" id="selectTopicArea">
            <select name="" class="w-full px-5 py-3 text-lg border-2 border-darthmouthgreen" id="selectTopic">
                <option value="" disabled selected>Choose Topic</option>
                @foreach ($syllabus as $topic)
                    <option value="{{ $topic->syllabus_id }}">{{ $topic->topic_title }}</option>
                @endforeach
            </select>
        </div>

        <div class="w-full mx-10 mt-5 h-[400px] border-2 border-darthmouthgreen" id="learnerCourseTopicProgressChart">
            <canvas id="learnerTopicDataChart"></canvas>
        </div>

        <div class="flex flex-col w-full px-10 mt-5" id="learnerCourseTopicProgressTable">
            <a href="" method="GET" class="text-xl text-right underline text-darthmouthgreen hover:text-green-950">view more details</a>
            <table id="learnerSyllabusTable" class="w-full mt-5">
                <thead class="text-white bg-darthmouthgreen">
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

    
</section>
</section>

@include('partials.footer')