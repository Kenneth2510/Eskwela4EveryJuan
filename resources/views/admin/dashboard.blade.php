@include('partials.header')

<section class="flex flex-row w-screen text-sm main-container bg-mainwhitebg md:text-base">
@include('partials.sidebar')




<section class="w-screen px-2 pt-[40px] mx-2 mt-2  overscroll-auto md:overflow-auto">
    <div class="flex justify-between px-10">
        <h1 class="text-6xl font-bold text-darthmouthgreen">Overview</h1>
        <div class="">
            <p class="text-xl font-semibold text-darthmouthgreen">{{$admin->admin_codename}}</p>
        </div>
    </div>

    <div class="w-full px-3 pb-4 mt-10 rounded-lg shadow-lg b">


        <div class="flex justify-between w-full px-10 text-center" id="countDataMainArea">
            <div class="w-3/12 py-10 mx-2 border-2 shadow-lg border-darthmouthgreen rounded-xl" id="totalLearnerCountArea">
                
                <p class="font-bold text-7xl text-darthmouthgreen">{{$totalLearner}}</p>
                <h1 class="text-xl font-semibold text-darthmouthgreen">Total Learners</h1>
            </div>
            <div class="w-3/12 py-10 mx-2 border-2 shadow-lg border-darthmouthgreen rounded-xl" id="totalInstructorCountArea">
                
                <p class="font-bold text-7xl text-darthmouthgreen">{{$totalInstructor}}</p>
                <h1 class="text-xl font-semibold text-darthmouthgreen">Total Instructors</h1>
            </div>
            <div class="w-3/12 py-10 mx-2 border-2 shadow-lg border-darthmouthgreen rounded-xl" id="totalCourseCountArea">
                
                <p class="font-bold text-7xl text-darthmouthgreen">{{$totalCourse}}</p>
                <h1 class="text-xl font-semibold text-darthmouthgreen">Total Courses</h1>
            </div>
        </div>

        
        <hr class="my-6 border-2-t-2 border-2-gray-300">

        <div class="flex w-full mt-10" id="mainChartDataArea">
            <div class="w-1/2 mx-5" id="mainChartDataLeft">
                <div class="flex">
                    <div class="w-full p-2 my-3 flex flex-col justify-between mx-3 rounded-xl border-2 h-[250px] border-darthmouthgreen" id="learnerChartArea">
                        <p class="text-xl font-semibold text-darthmouthgreen">Learner Data</p>
                        <canvas id="learnerData"></canvas>
                    </div>
                    <div class="w-full p-2 my-3 mx-3 flex flex-col justify-between rounded-xl border-2 h-[250px] border-darthmouthgreen" id="instructorChartArea">
                        <p class="text-xl font-semibold text-darthmouthgreen">Instructor Data</p>
                        <canvas id="instructorData"></canvas>
                    </div>
                </div>
                <div class="flex">
                    <div class="w-full p-2 my-3 mx-3 flex flex-col justify-between rounded-xl border-2 h-[250px] border-darthmouthgreen" id="courseChartArea">
                        <p class="text-xl font-semibold text-darthmouthgreen">Course Data</p>
                        <canvas id="courseData"></canvas>
                    </div>
                    <div class="w-full p-2 my-3 mx-3 flex flex-col justify-between rounded-xl border-2 h-[250px] border-darthmouthgreen overflow-visible" id="adminRolesChartArea">
                        <p class="text-xl font-semibold text-darthmouthgreen">Admin Data</p>
                        <canvas id="adminData" class="overflow-x-auto"></canvas>
                    </div>
                </div>
            </div>
            <div class="w-1/2 mx-5 mt-3" id="mainChartDataRight">
                <h1 class="text-2xl font-semibold text-darthmouthgreen">Learner Course Progress</h1>
                <select name="selectedCourse" id="selectedCourse" class="w-full px-3 py-3 mt-5 border-2 text-md rounded-xl border-darthmouthgreen">
                    @foreach ($courses as $course)
                        <option value="{{$course->course_id}}">{{$course->course_name}}</option>
                    @endforeach
                </select>
                <div class="mt-3 rounded-xl border-2 border-darthmouthgreen w-full h-[400px]" id="courseProgressChartArea">
                    <canvas id="courseProgressChart" class="overflow-x-auto"></canvas>
                </div>
            </div>
        </div>
    </div>
</section>

    
</section>

@include('partials.footer')
