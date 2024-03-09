@include('partials.header')

<section class="flex flex-row w-screen text-sm main-container bg-mainwhitebg md:text-base">
@include('partials.sidebar')




<section class="w-screen px-2 pt-[40px] mx-2 mt-2  overscroll-auto md:overflow-auto">
    <div class="flex justify-between px-10">
        <h1 class="text-6xl font-bold text-darthmouthgreen">Reports</h1>
        <div class="">
            <p class="text-xl font-semibold text-darthmouthgreen">{{$admin->admin_codename}}</p>
        </div>
    </div>

    <div class="" id="mainContainer">
        <div class="mt-10">
            <h1 class="mx-5 text-2xl font-semibold">Choose Category</h1>
            <hr class="my-3 border-t-2 border-gray-300">    
        </div>

        <div class="flex w-full">
            <div class="w-3/12 mt-10" id="reportCategoryArea">
                <select class="w-4/5 px-5 py-3 border-darthmouthgreen border text-xl rounded-xl" name="reportCategory" id="reportCategory">
                    <option value="" selected disabled>--choose category--</option>
                    <option value="Users">List of Users</option>
                    <option value="Session">Session Logs</option>
                    <option value="UserSession">User Session Logs</option>
                    <option value="Courses">List of Courses</option>
                    <option value="Enrollees">List of Course Enrollees</option>
                    <option value="CourseGradesheets">Course Gradesheets</option>
                    {{-- <option value="CoursePerformances">Course Performances</option> --}}
                    <option value="LearnerGradesheets">Learner Gradesheets</option>
                </select>
            </div>

            <div class="w-6/12 " id="selectedReportSubCategoryArea">

                <div class="mt-5 hidden" id="listUsersArea">
                    <form action="{{ url('admin/report/Users') }}"  method="GET">
                        <div class="mt-5" id="userCategoryArea">
                            <h1 class="text-xl font-semibold">Choose Category</h1>
                            <select class="w-4/5 px-5 py-3 border-darthmouthgreen border text-xl rounded-xl" name="userCategory" id="userCategory">
                                <option value="ALL" selected disabled>--choose user--</option>
                                <option value="Learners">Learners</option>
                                <option value="Instructors">Instructors</option>
                            </select>
                        </div>
    
                        <div class="mt-5" id="userStatusArea">
                            <h1 class="text-xl font-semibold">Choose Status</h1>
                            <select class="w-4/5 px-5 py-3 border-darthmouthgreen border text-xl rounded-xl" name="userStatus" id="userStatus">
                                <option value="" selected>ALL</option>
                                <option value="Pending">Pending</option>
                                <option value="Approved">Approved</option>
                                <option value="Rejected">Rejected</option>
                            </select>
                        </div>
    
    
                        <div class="mt-5" id="userDateTimeArea">
                            <input type="checkbox" name="userSelectedDayCheck" id="userSelectedDayCheck">
                            <label for="userSelectedDayCheck" class="text-lg">Custom Time</label><br>
    
                            <label for="userDateStart">Start Date</label>
                            <input type="date" class="w-1/5 border border-darthmouthgreen rounded-xl mx-5 px-3 py-2 " name="userDateStart" id="userDateStart">
                            
                            <label for="userDateFinish">Fisnish Date</label>
                            <input type="date" class="w-1/5 border border-darthmouthgreen rounded-xl mx-5 px-3 py-2 " name="userDateFinish" id="userDateFinish">
                        </div>


                        <div class="w-3/12 mt-10" id="generateArea">
                            <button type="submit" id="generateBtn" class="px-5 py-3 bg-darthmouthgreen text-white text-xl rounded-xl hover:bg-white hover:text-darthmouthgreen hover:border hover:border-darthmouthgreen">Generate Report</button>
                        </div>
                    </form>

                </div>


                <div class="mt-5 hidden " id="sessionDataArea">
                    <form action="{{ url('admin/report/Session') }}"  method="GET">
                        <div class="mt-5" id="userCategoryArea">
                            <h1 class="text-xl font-semibold">Choose Category</h1>
                            <select class="w-4/5 px-5 py-3 border-darthmouthgreen border text-xl rounded-xl" name="userCategory" id="userCategory">
                                <option value="ALL" selected>ALL Users</option>
                                <option value="Learners">Learners</option>
                                <option value="Instructors">Instructors</option>
                            </select>
                        </div>

                        <div class="mt-5" id="userDateTimeArea">
                            <input type="checkbox" name="userSelectedDayCheck" id="userSelectedDayCheck">
                            <label for="userSelectedDayCheck" class="text-lg">Custom Time</label><br>

                            <label for="userDateStart">Start Date</label>
                            <input type="date" class="w-1/5 border border-darthmouthgreen rounded-xl mx-5 px-3 py-2 " name="userDateStart" id="userDateStart">
                            
                            <label for="userDateFinish">Fisnish Date</label>
                            <input type="date" class="w-1/5 border border-darthmouthgreen rounded-xl mx-5 px-3 py-2 " name="userDateFinish" id="userDateFinish">
                        </div>

                        <div class="w-3/12 mt-10" id="generateArea">
                            <button type="submit" id="generateBtn" class="px-5 py-3 bg-darthmouthgreen text-white text-xl rounded-xl hover:bg-white hover:text-darthmouthgreen hover:border hover:border-darthmouthgreen">Generate Report</button>
                        </div>
                    </form>
                </div>

                
                <div class="mt-5 hidden " id="userSessionDataArea">
                    <form action="{{ url('admin/report/UserSession') }}"  method="GET">
                        <div class="mt-5" id="userCategoryArea">
                            <h1 class="text-xl font-semibold">Choose Category</h1>
                            <select class="w-4/5 px-5 py-3 border-darthmouthgreen border text-xl rounded-xl" name="userSessionCategory" id="userSessionCategory">
                                <option value="" selected disabled>--choose user--</option>
                                <option value="Learners">Learners</option>
                                <option value="Instructors">Instructors</option>
                            </select>
                        </div>
    
                        <div class="mt-5 hidden" id="userSessionLearnerArea">
                            <h1 class="text-xl font-semibold">Choose Learner</h1>
                            <select class="w-4/5 px-5 py-3 border-darthmouthgreen border text-xl rounded-xl" name="userSession" id="userSession">
                                <option value="" selected disabled>--choose user--</option>
                                @foreach ($learners as $learner)
                                <option value="{{$learner->learner_id}}">{{$learner->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mt-5 hidden" id="userSessionInstructorArea">
                            <h1 class="text-xl font-semibold">Choose Instructor</h1>
                            <select class="w-4/5 px-5 py-3 border-darthmouthgreen border text-xl rounded-xl" name="userSession" id="userSession">
                                <option value="" selected disabled>--choose user--</option>
                                @foreach ($instructors as $instructor)
                                <option value="{{$instructor->instructor_id}}">{{$instructor->name}}</option>
                                @endforeach
                            </select>
                        </div>
    
                        <div class="mt-5" id="userDateTimeArea">
                            <input type="checkbox" name="userSelectedDayCheck" id="userSelectedDayCheck">
                            <label for="userSelectedDayCheck" class="text-lg">Custom Time</label><br>
    
                            <label for="userDateStart">Start Date</label>
                            <input type="date" class="w-1/5 border border-darthmouthgreen rounded-xl mx-5 px-3 py-2 " name="userDateStart" id="userDateStart">
                            
                            <label for="userDateFinish">Fisnish Date</label>
                            <input type="date" class="w-1/5 border border-darthmouthgreen rounded-xl mx-5 px-3 py-2 " name="userDateFinish" id="userDateFinish">
                        </div>

                        <div class="w-3/12 mt-10" id="generateArea">
                            <button type="submit" id="generateBtn" class="px-5 py-3 bg-darthmouthgreen text-white text-xl rounded-xl hover:bg-white hover:text-darthmouthgreen hover:border hover:border-darthmouthgreen">Generate Report</button>
                        </div>
                    </form>

                </div>


                <div class="mt-5 hidden" id="listCourseArea">

                    <form action="{{ url('admin/report/Courses') }}"  method="GET">
                    <div class="mt-5" id="userCategoryArea">
                        <h1 class="text-xl font-semibold">Choose Category</h1>
                        <select class="w-4/5 px-5 py-3 border-darthmouthgreen border text-xl rounded-xl" name="courseCategory" id="courseCategory">
                            <option value="Simple" selected>Simple</option>
                            <option value="Detailed">Detailed</option>
                        </select>
                    </div>

                    <div class="mt-5" id="courseStatusArea">
                        <h1 class="text-xl font-semibold">Choose Status</h1>
                        <select class="w-4/5 px-5 py-3 border-darthmouthgreen border text-xl rounded-xl" name="courseStatus" id="courseStatus">
                            <option value="" selected>ALL</option>
                            <option value="Pending">Pending</option>
                            <option value="Approved">Approved</option>
                            <option value="Rejected">Rejected</option>
                        </select>
                    </div>

                    <div class="w-3/12 mt-10" id="generateArea">
                        <button type="submit" id="generateBtn" class="px-5 py-3 bg-darthmouthgreen text-white text-xl rounded-xl hover:bg-white hover:text-darthmouthgreen hover:border hover:border-darthmouthgreen">Generate Report</button>
                    </div>
                    </form>

                </div>
    
                <div class="mt-5 hidden" id="listCourseEnrolleesArea">
                    
                    <form action="{{ url('admin/report/Enrollees') }}"  method="GET">
                    <div class="mt-5" id="courseArea">
                        <h1 class="text-xl font-semibold">Choose Course</h1>
                        <select class="w-4/5 px-5 py-3 border-darthmouthgreen border text-xl rounded-xl" name="course" id="course">
                            
                            <option value="" selected disabled>--choose course--</option>
                            @foreach ($approvedCourses as $course)
                            <option value="{{$course->course_id}}">{{$course->course_name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mt-5" id="userStatusArea">
                        <h1 class="text-xl font-semibold">Choose Status</h1>
                        <select class="w-4/5 px-5 py-3 border-darthmouthgreen border text-xl rounded-xl" name="enrollmentStatus" id="enrollmentStatus">
                            <option value="" selected>ALL</option>
                            <option value="Pending">Pending</option>
                            <option value="Approved">Approved</option>
                            <option value="Rejected">Rejected</option>
                        </select>
                    </div>

                    <div class="mt-5" id="userDateTimeArea">
                        <input type="checkbox" name="userSelectedDayCheck" id="userSelectedDayCheck">
                        <label for="userSelectedDayCheck" class="text-lg">Custom Time</label><br>

                        <label for="userDateStart">Start Date</label>
                        <input type="date" class="w-1/5 border border-darthmouthgreen rounded-xl mx-5 px-3 py-2 " name="userDateStart" id="userDateStart">
                        
                        <label for="userDateFinish">Fisnish Date</label>
                        <input type="date" class="w-1/5 border border-darthmouthgreen rounded-xl mx-5 px-3 py-2 " name="userDateFinish" id="userDateFinish">
                    </div>

                    <div class="w-3/12 mt-10" id="generateArea">
                        <button type="submit" id="generateBtn" class="px-5 py-3 bg-darthmouthgreen text-white text-xl rounded-xl hover:bg-white hover:text-darthmouthgreen hover:border hover:border-darthmouthgreen">Generate Report</button>
                    </div>
                    </form>
                </div>



                <div class="mt-5 hidden" id="courseGradesheetArea">
                    
                    <form action="{{ url('admin/report/CourseGradesheets') }}"  method="GET">
                    <div class="mt-5" id="courseArea">
                        <h1 class="text-xl font-semibold">Choose Course</h1>
                        <select class="w-4/5 px-5 py-3 border-darthmouthgreen border text-xl rounded-xl" name="course" id="course">
                            <option value="" selected disabled>--choose course--</option>
                            @foreach ($approvedCourses as $course)
                            <option value="{{$course->course_id}}">{{$course->course_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="w-3/12 mt-10" id="generateArea">
                        <button type="submit" id="generateBtn" class="px-5 py-3 bg-darthmouthgreen text-white text-xl rounded-xl hover:bg-white hover:text-darthmouthgreen hover:border hover:border-darthmouthgreen">Generate Report</button>
                    </div>
                    </form>
                </div>


                {{-- <div class="mt-5 hidden" id="coursePerformanceArea">
                    <div class="mt-5" id="courseArea">
                        <h1 class="text-xl font-semibold">Choose Course</h1>
                        <select class="w-4/5 px-5 py-3 border-darthmouthgreen border text-xl rounded-xl" class="w-4/5 px-5 py-3 border-darthmouthgreen border text-xl rounded-xl" name="course" id="course">
                            <option value="" selected disabled>--choose course--</option>
                        </select>
                    </div>

                    <div class="mt-5" id="syllabusArea">
                        <h1 class="text-xl font-semibold">Choose Syllabus</h1>
                        <select class="w-4/5 px-5 py-3 border-darthmouthgreen border text-xl rounded-xl" name="syllabusCategory" id="syllabusCategory">
                            <option value="" selected disabled>--choose course--</option>
                        </select>
                    </div>
                </div> --}}


                <div class="mt-5 hidden" id="learnerPerformanceArea">
                    
                    <form action="{{ url('admin/report/LearnerGradesheets') }}"  method="GET">
                    <div class="mt-5" id="courseArea">
                        <h1 class="text-xl font-semibold">Choose Course</h1>
                        <select class="w-4/5 px-5 py-3 border-darthmouthgreen border text-xl rounded-xl" name="learnerCourseCategory" id="learnerCourseCategory">
                            <option value="" selected disabled>--choose course--</option>
                            @foreach ($approvedCourses as $course)
                            <option value="{{$course->course_id}}">{{$course->course_name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mt-5" id="learnerArea">
                        <h1 class="text-xl font-semibold">Choose Learner</h1>
                        <select class="w-4/5 px-5 py-3 border-darthmouthgreen border text-xl rounded-xl" name="learnerCourseUser" id="learnerCourseUser">
                            
                        </select>
                    </div>
                    <div class="w-3/12 mt-10" id="generateArea">
                        <button type="submit" id="generateBtn" class="px-5 py-3 bg-darthmouthgreen text-white text-xl rounded-xl hover:bg-white hover:text-darthmouthgreen hover:border hover:border-darthmouthgreen">Generate Report</button>
                    </div>
                    </form>


                </div>


            </div>



 
        </div>

    </div>

</section>
</section>

@include('partials.footer')