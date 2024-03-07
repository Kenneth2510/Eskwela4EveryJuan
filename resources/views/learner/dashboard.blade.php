@include('partials.header')

<section class="flex flex-row w-full h-screen text-sm main-container bg-mainwhitebg md:text-base">

    @include('partials.instructorNav')
    @include('partials.learnerSidebar')

        
    {{-- MAIN --}}
    <section class="w-full px-2 pt-[70px] mx-2 mt-2 md:w-3/4 lg:w-9/12  overscroll-auto md:overflow-auto">
        <div class="px-3 pb-4 rounded-lg shadow-lg b">
        
            <div class="" id="welcome">
                <h1 class="text-4xl font-semibold">Welcome back, {{$learner->learner_fname}}!</h1>
            </div>

            <hr class="border-t-2 border-gray-300 my-6">

            <h1 class="mx-5 text-2xl font-semibold">Overview</h1>

            <div class="mx-10 mt-5 flex justify-between" id="overview_area">
                <div class="text-center flex flex-col justify-between py-10 w-3/12 h-[250px] border-2 border-darthmouthgreen rounded-2xl" id="totalActiveCoursesArea">
                    <h1 class="text-[100px] pt-10 font-semibold text-darthmouthgreen" id="totalCoursesText">#</h1>
                    <p class="text-2xl mt-5  text-darthmouthgreen">Courses Enrolled</p>
                </div>
                <div class="text-center flex flex-col justify-between py-10 w-3/12 h-[250px] border-2 border-darthmouthgreen rounded-2xl" id="totalTopicsArea">
                    <h1 class="text-[100px] pt-10 font-semibold text-darthmouthgreen" id="totalTopicsText">#</h1>
                    <p class="text-2xl mt-5  text-darthmouthgreen">Topics Finished</p>
                </div>
                <div class="text-center flex flex-col justify-between py-10 w-3/12 h-[250px] border-2 border-darthmouthgreen rounded-2xl" id="totalTopicsArea">
                    <h1 class="text-[100px] pt-10 font-semibold text-darthmouthgreen" id="totalDaysActiveText">#</h1>
                    <p class="text-2xl mt-5  text-darthmouthgreen">Days Active</p>
                </div>
            </div>


            <hr class="border-t-2 border-gray-300 my-6">

                <div class="flex justify-between">
                    <h1 class="mx-5 text-2xl font-semibold">Continue your progress</h1>
                    <a href="{{ url('/learner/courses') }}" class="text-lg mx-10">view all</a>
                </div>
              

                <div class="h-80 relative overflow-hidden px-20" id="courseCarouselArea">
                    <button id="course_carousel_left_btn" class="mx-5 h-full absolute flex justify-center items-center left-0">
                        <i class="fa-solid fa-angle-left text-2xl"></i>
                    </button>
                    <button id="course_carousel_right_btn" class="mx-5 h-full absolute flex justify-center items-center right-0">
                        <i class="fa-solid fa-angle-right text-2xl"></i>
                    </button>
                    <div class="h-80 flex overflow-x-auto scroll scroll-smooth" id="courseCardContainer">
                        
                        @foreach ($enrolledCourses as $course)

                        <div style="background-color: #00693e" class="px-3 py-2 relative m-4 rounded-lg shadow-lg h-72 w-52">
                            <div style="background-color: #9DB0A3" class="relative h-32 mx-auto my-4 rounded w-44">
                                <img class="absolute w-16 h-16 bg-yellow-500 rounded-full right-3 -bottom-4" src="{{ asset('storage/' . $course->profile_picture) }}" alt="">
                            </div>
                            
                            <div class="px-4">
                                <h1 class="mb-2 overflow-hidden text-lg font-bold text-white whitespace-no-wrap">{{ $course->course_name }}</h1>
        
                                <div class="text-sm text-gray-100 ">
                                    <p>{{ $course->course_code }}</p>
                                    <h3>{{ $course->instructor_fname }} {{ $course->instructor_lname }}</h3>
                                </div>
                            </div>
                            
                            <a href="{{ url("/learner/course/$course->course_id") }}" style="background-color: #00693e; right:0; bottom: 0;" class="absolute float-right mx-4 mb-3 rounded">
                                <svg class="w-10 h-10" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="M504-480 320-664l56-56 240 240-240 240-56-56 184-184Z"/></svg>
                            </a>
                        </div>

                        @endforeach
                    </div>
                </div>


                <hr class="border-t-2 border-gray-300 my-6">

                <div class="mx-5 flex justify-between" id="learnerProgressArea">
                    <div class="mx-5 w-1/2 h-[350px] border-2 border-darthmouthgreen rounded-xl" id="courseProgressGraphArea">
                        <canvas id="courseProgressGraph"></canvas>
                    </div>

                    <div class="mx-5 w-1/2 h-[350px] flex flex-col justify-between" id="courseProgressDataArea">
                        <div class="w-full h-[170px] mb-3 border-2 flex items-center justify-center border-darthmouthgreen rounded-lg" id="courseCompletionRate">
                            <p class="font-bold text-2xl flex items-center"><span class="px-5 text-darthmouthgreen text-[85px]" id="completionRate">#%</span><br>Completion Rate</p>
                        </div>
                        <div class="w-full h-[170px] mt-3 border-2 flex flex-col justify-between items-center border-darthmouthgreen rounded-lg" id="courseTopicsCleared">
                            <div class="">
                                <p class="font-bold text-2xl flex items-center justify-center pt-10 text-center"><span class="text-darthmouthgreen text-[85px]" id="totalSyllabusCompletedCount">0 <i class="fa-solid fa-book-bookmark text-[50px]"></i></span> Topics Completed</p>
                            </div>
                            <div class="flex justify-between">
                                <div class="flex flex-col items-center mx-1">
                                    <i class="fa-solid fa-file text-darthmouthgreen text-xl mx-3"></i>
                                    <p class="font-bold text-md"><span id="totalLessonsCompletedCount" class="">0</span></p>
                                </div>
            
                                <div class="flex flex-col items-center mx-1">
                                    <i class="fa-solid fa-clipboard text-darthmouthgreen text-xl mx-3"></i>
                                    <p class="font-bold text-md"><span id="totalActivitiesCompletedCount" class="">0</span></p>
                                </div>
            
                                <div class="flex flex-col items-center mx-1">
                                    <i class="fa-solid fa-pen-to-square text-darthmouthgreen text-xl mx-3"></i>
                                    <p class="font-bold text-md"><span id="totalQuizzesCompletedCount" class="">0</span></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            <hr class="border-t-2 border-gray-300 my-6">

                <div class="flex justify-between">
                    <h1 class="mx-5 text-2xl font-semibold">New Available Courses</h1>
                    <a href="{{ url('/learner/courses') }}" class="text-lg mx-10">view all</a>
                </div>
              

                <div class="h-80 relative overflow-hidden px-20" id="courseCarouselArea">
                    <button id="course_carousel_left_btn" class="mx-5 h-full absolute flex justify-center items-center left-0">
                        <i class="fa-solid fa-angle-left text-2xl"></i>
                    </button>
                    <button id="course_carousel_right_btn" class="mx-5 h-full absolute flex justify-center items-center right-0">
                        <i class="fa-solid fa-angle-right text-2xl"></i>
                    </button>
                    <div class="h-80 flex overflow-x-auto scroll scroll-smooth" id="courseCardContainer">
                        
                        @foreach ($courses as $course)

                        <div style="background-color: #00693e" class="px-3 py-2 relative m-4 rounded-lg shadow-lg h-72 w-52">
                            <div style="background-color: #9DB0A3" class="relative h-32 mx-auto my-4 rounded w-44">
                                <img class="absolute w-16 h-16 bg-yellow-500 rounded-full right-3 -bottom-4" src="{{ asset('storage/' . $course->profile_picture) }}" alt="">
                            </div>
                            
                            <div class="px-4">
                                <h1 class="mb-2 overflow-hidden text-lg font-bold text-white whitespace-no-wrap">{{ $course->course_name }}</h1>
        
                                <div class="text-sm text-gray-100 ">
                                    <p>{{ $course->course_code }}</p>
                                    <h3>{{ $course->instructor_fname }} {{ $course->instructor_lname }}</h3>
                                </div>
                            </div>
                            
                            <a href="{{ url("/learner/course/$course->course_id") }}" style="background-color: #00693e; right:0; bottom: 0;" class="absolute float-right mx-4 mb-3 rounded">
                                <svg class="w-10 h-10" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="M504-480 320-664l56-56 240 240-240 240-56-56 184-184Z"/></svg>
                            </a>
                        </div>

                        @endforeach
                    </div>
                </div>
        
            <hr class="border-t-2 border-gray-300 my-6">

            <div class="flex justify-between">
                <h1 class="mx-5 text-2xl font-semibold">Your session data</h1>
                <a href="{{ url('/learner/performances') }}" class="text-lg mx-10">view all</a>
            </div>

            <div class="mt-5 flex justify-center" id="learnerSessionDataArea">
                    <div class="mx-5 w-11/12 h-[350px] border-2 border-darthmouthgreen rounded-xl" id="learnerSessionGraphArea">
                        <canvas id="learnerSessionGraph"></canvas>
                    </div>
            </div>

        
        </div>
    </section>

    {{-- @include('partials.learnerProfile') --}}
    @include('partials.chatbot')
        
    </section>

@include('partials.footer')