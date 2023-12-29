@include('partials.header')

<section class="flex flex-row w-full h-screen text-sm main-container bg-mainwhitebg md:text-base">
    @include('partials.instructorNav')
    @include('partials.instructorSidebar')

    {{-- MAIN --}}
    <section class="w-full px-2 pt-[120px] mx-2 mt-2 md:w-3/4 lg:w-9/12  overscroll-auto md:overflow-auto">
        <div class="px-3 pb-4 overflow-auto rounded-lg shadow-lg b overscroll-auto">
            <h1 class="mx-5 text-2xl font-semibold md:text-3xl">PERFORMANCE DASHBOARD</h1>
            <hr class="border-t-2 border-gray-300 my-6">
            
            <div class="mt-5 p-10 flex" id="genInfo">
                <div class="w-3/5 h-[300px] border-2 border-darthmouthgreen" id="totalCourseArea">
                    <div class=" mt-10 mx-10 h-2/3 text-center item-center flex justify-center">
                        <i class="fa-solid fa-book-open-reader text-darthmouthgreen text-[175px]"></i>
                        <p class="font-bold mt-3 py-14 mx-5 text-2xl"><span class="text-darthmouthgreen text-[125px]" id="totalCourseNum">0</span><br>Total Courses</p>
                    </div>
                    <div class="flex mt-5 justify-center">
                        <div class="flex items-center mx-5">
                            <div class="rounded-full w-3 h-3 mx-3 bg-darthmouthgreen"></div>
                            <p class="font-bold text-md">Approved: <span id="totalApprovedCourse" class="">0</span></p>
                        </div>

                        <div class="flex items-center mx-5">
                            <div class="rounded-full w-3 h-3 mx-3 bg-yellow-400"></div>
                            <p class="font-bold text-md">Pending: <span id="totalPendingCourse" class="">0</span></p>
                        </div>

                        <div class="flex items-center mx-5">
                            <div class="rounded-full w-3 h-3 mx-3 bg-red-700"></div>
                            <p class="font-bold text-md">Rejected: <span id="totalRejectedCourse" class="">0</span></p>
                        </div>
                    </div>
                    
                </div>
                <div class="mx-5 w-2/4 h-[300px] flex flex-col justify-between" id="totalCourseSubInfoArea">
                    <div class="h-[130px] border-2 border-darthmouthgreen flex items-center" id="enrolledLearnersArea">
                        <div class="py-5 ml-10 flex items-center">
                            <i class="fa-solid fa-user text-darthmouthgreen text-[75px]"></i>
                            <p class="font-bold text-md px-5 pt-5 text-center"><span class="text-darthmouthgreen text-[75px]" id="totalLearnersCount">0</span><br>Learners</p>
                        </div>
                        <div class="">
                            <div class="flex items-center mx-5">
                                <div class="rounded-full w-3 h-3 mx-3 bg-darthmouthgreen"></div>
                                <p class="font-bold text-md">Approved: <span id="totalApprovedLearnersCount" class="">0</span></p>
                            </div>
    
                            <div class="flex items-center mx-5">
                                <div class="rounded-full w-3 h-3 mx-3 bg-yellow-400"></div>
                                <p class="font-bold text-md">Pending: <span id="totalPendingLearnersCount" class="">0</span></p>
                            </div>
    
                            <div class="flex items-center mx-5">
                                <div class="rounded-full w-3 h-3 mx-3 bg-red-700"></div>
                                <p class="font-bold text-md">Rejected: <span id="totalRejectedLearnersCount" class="">0</span></p>
                            </div>
                        </div>
                    </div>

                    <div class="h-[130px] border-2 border-darthmouthgreen flex items-center" id="syllabusContentsArea">
                        <div class="py-5 ml-10 flex items-center">
                            <i class="fa-solid fa-book-bookmark text-darthmouthgreen text-[75px]"></i>
                            <p class="font-bold text-md px-8 pt-5 text-center"><span class="text-darthmouthgreen text-[75px]" id="totalSyllabusCount">0</span><br>Topics</p>
                        </div>
                        <div class="">
                            <div class="flex items-center mx-5">
                                <i class="fa-solid fa-file text-darthmouthgreen text-xl mx-3"></i>
                                <p class="font-bold text-md">Lessons: <span id="totalLessonsCount" class="">0</span></p>
                            </div>
    
                            <div class="flex items-center mx-5">
                                <i class="fa-solid fa-clipboard text-darthmouthgreen text-xl mx-3"></i>
                                <p class="font-bold text-md">Activities: <span id="totalActivitiesCount" class="">0</span></p>
                            </div>
    
                            <div class="flex items-center mx-5">
                                <i class="fa-solid fa-pen-to-square text-darthmouthgreen text-xl mx-3"></i>
                                <p class="font-bold text-md">Quizzes: <span id="totalQuizzesCount" class="">0</span></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <hr class="border-t-2 border-gray-300 my-6">

            <div class="w-full p-10" id="perCourseArea">
                <select name="" class="w-full text-lg px-5 py-3" id="perCourseSelectArea">
                    <option value="ALL" selected>ALL COURSES</option>
                    @foreach ($courses as $course)
                        <option value="{{ $course->course_id }}">{{ $course->course_name }}</option>
                    @endforeach
                </select>

                <div class="mt-5 w-full flex" id="perCourseInfoArea">
                    <div class="w-1/3 h-[350px] border-2 border-darthmouthgreen p-5" id="courseInfo"></div>

                    <div class="w-2/3 h-[350px] ml-5 border-2 border-darthmouthgreen" id="courseGraph">
                        <canvas id="courseDataChart"></canvas>
                    </div>
                </div>
            </div>

            <hr class="border-t-2 border-gray-300 my-6">

            <div class="w-full p-10" id="courseListArea">
                <h1 class="text-2xl mb-5 font-semibold text-black">List of Courses</h1>
                <table class="rounded-xl">
                    <thead class="bg-darthmouthgreen py-3 text-white text-xl">
                        <th class="w-1/5">Course Name</th>
                        <th class="w-1/5">Course Code</th>
                        <th class="w-1/5">Number of Active Enrolles</th>
                        <th class="w-1/5">Date Created</th>
                        <th class="w-1/5">Status</th>
                        <th class="w-1/5"></th>
                    </thead>

                    <tbody class="rowCourseDataArea mt-5">
                        <tr class="rowCourseData my-5 text-center">
                            <td class="mt-5 py-5">Sample 1</td>
                            <td>jrkh90</td>
                            <td>10/13</td>
                            <td>10/25/2024</td>
                            <td>Approved</td>
                            <td>
                                <a href="" method="GET" class="bg-darthmouthgreen hover:bg-green-950 text-white rounded-xl px-5 py-3">View</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
@include('partials.instructorProfile')
</section>
@include('partials.footer')