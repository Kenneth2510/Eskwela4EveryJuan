@extends('layouts.learner_layout')


@section('content')
        {{-- MAIN --}}
        <section class="w-full h-screen md:w-3/4 lg:w-10/12">
            <div class="h-full px-2 py-4 pt-24 rounded-lg shadow-lg md:overflow-hidden md:overflow-y-scroll md:pt-0">
            
                <div class="py-4" id="welcome">
                    <h1 class="text-2xl font-semibold md:text-3xl">Welcome back, {{$learner->learner_fname}}!</h1>
                </div>
                <div class="text-center flex flex-col justify-between py-10 w-3/12 h-[250px] border-2 border-darthmouthgreen rounded-2xl" id="totalTopicsArea">
                    <h1 class="text-[100px] pt-10 font-semibold text-darthmouthgreen" id="totalTopicsText">#</h1>
                    <p class="mt-5 text-2xl text-darthmouthgreen">Topics Finished</p>
                </div>
                <div class="text-center flex flex-col justify-between py-10 w-3/12 h-[250px] border-2 border-darthmouthgreen rounded-2xl" id="totalTopicsArea">
                    <h1 class="text-[100px] pt-10 font-semibold text-darthmouthgreen" id="totalDaysActiveText">#</h1>
                    <p class="mt-5 text-2xl text-darthmouthgreen">Days Active</p>
                </div>
            </div>


            <hr class="my-6 border-t-2 border-gray-300">

                <div class="flex justify-between">
                    <h1 class="mx-5 text-2xl font-semibold">Continue your progress</h1>
                    <a href="{{ url('/learner/courses') }}" class="mx-10 text-lg">view all</a>
                </div>
              

                <div class="relative px-20 overflow-hidden h-80" id="courseCarouselArea">
                    <button id="course_carousel_left_btn" class="absolute left-0 flex items-center justify-center h-full mx-5">
                        <i class="text-2xl fa-solid fa-angle-left"></i>
                    </button>
                    <button id="course_carousel_right_btn" class="absolute right-0 flex items-center justify-center h-full mx-5">
                        <i class="text-2xl fa-solid fa-angle-right"></i>
                    </button>
                    <div class="flex overflow-x-auto h-80 scroll scroll-smooth" id="courseCardContainer">
                        
                        @foreach ($enrolledCourses as $course)

                        <div style="background-color: #00693e" class="relative px-3 py-2 m-4 rounded-lg shadow-lg h-72 w-52">
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
                </div>

                    

                <hr class="my-6 border-t-2 border-gray-300">

                <div class="flex justify-between mx-5" id="learnerProgressArea">
                    <div class="mx-5 w-1/2 h-[350px] border-2 border-darthmouthgreen rounded-xl" id="courseProgressGraphArea">
                        <canvas id="courseProgressGraph"></canvas>
                    </div>

                    <div class="mx-5 w-1/2 h-[350px] flex flex-col justify-between" id="courseProgressDataArea">
                        <div class="w-full h-[170px] mb-3 border-2 flex items-center justify-center border-darthmouthgreen rounded-lg" id="courseCompletionRate">
                            <p class="flex items-center text-2xl font-bold"><span class="px-5 text-darthmouthgreen text-[85px]" id="completionRate">#%</span><br>Completion Rate</p>
                        </div>
                        <div class="w-full h-[170px] mt-3 border-2 flex flex-col justify-between items-center border-darthmouthgreen rounded-lg" id="courseTopicsCleared">
                            <div class="">
                                <p class="flex items-center justify-center pt-10 text-2xl font-bold text-center"><span class="text-darthmouthgreen text-[85px]" id="totalSyllabusCompletedCount">0 <i class="fa-solid fa-book-bookmark text-[50px]"></i></span> Topics Completed</p>
                            </div>
                            <div class="flex justify-between">
                                <div class="flex flex-col items-center mx-1">
                                    <i class="mx-3 text-xl fa-solid fa-file text-darthmouthgreen"></i>
                                    <p class="font-bold text-md"><span id="totalLessonsCompletedCount" class="">0</span></p>
                                </div>
            
                                <div class="flex flex-col items-center mx-1">
                                    <i class="mx-3 text-xl fa-solid fa-clipboard text-darthmouthgreen"></i>
                                    <p class="font-bold text-md"><span id="totalActivitiesCompletedCount" class="">0</span></p>
                                </div>
            
                                <div class="flex flex-col items-center mx-1">
                                    <i class="mx-3 text-xl fa-solid fa-pen-to-square text-darthmouthgreen"></i>
                                    <p class="font-bold text-md"><span id="totalQuizzesCompletedCount" class="">0</span></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            <hr class="my-6 border-t-2 border-gray-300">

                <div class="flex justify-between">
                    <h1 class="mx-5 text-2xl font-semibold">New Available Courses</h1>
                    <a href="{{ url('/learner/courses') }}" class="mx-10 text-lg">view all</a>
                </div>
              

                <div class="relative px-20 overflow-hidden h-80" id="courseCarouselArea">
                    <button id="course_carousel_left_btn" class="absolute left-0 flex items-center justify-center h-full mx-5">
                        <i class="text-2xl fa-solid fa-angle-left"></i>
                    </button>
                    <button id="course_carousel_right_btn" class="absolute right-0 flex items-center justify-center h-full mx-5">
                        <i class="text-2xl fa-solid fa-angle-right"></i>
                    </button>
                    <div class="flex overflow-x-auto h-80 scroll scroll-smooth" id="courseCardContainer">
                        
                        @foreach ($courses as $course)

                        <div style="background-color: #00693e" class="relative px-3 py-2 m-4 rounded-lg shadow-lg h-72 w-52">
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
                </div>
        
            <hr class="my-6 border-t-2 border-gray-300">

            <div class="flex justify-between">
                <h1 class="mx-5 text-2xl font-semibold">Your session data</h1>
                <a href="{{ url('/learner/performances') }}" class="mx-10 text-lg">view all</a>
            </div>

            <div class="flex justify-center mt-5" id="learnerSessionDataArea">
                    <div class="mx-5 w-11/12 h-[350px] border-2 border-darthmouthgreen rounded-xl" id="learnerSessionGraphArea">
                        <canvas id="learnerSessionGraph"></canvas>
                    </div>
            </div>

            
            </div>
        </section>

        {{-- @include('partials.learnerSideProfile') --}}
        @include('partials.chatbot')
@endsection
