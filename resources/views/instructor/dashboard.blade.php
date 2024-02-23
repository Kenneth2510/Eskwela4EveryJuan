@extends('layouts.instructor_layout')

@section('content')

        {{-- MAIN START --}}
        <section class="w-full px-2 pt-[70px] mx-2 mt-2 md:w-3/4 lg:w-9/12  overscroll-auto md:overflow-auto">
            <div class="px-3 pb-4 overflow-auto rounded-lg shadow-lg b overscroll-auto">

                <div class="" id="welcome">
                    <h1 class="text-4xl font-semibold">Welcome back, {{$instructor->instructor_fname}}!</h1>
                </div>

                <hr class="border-t-2 border-gray-300 my-6">

                <h1 class="mx-5 text-2xl font-semibold">Overview</h1>

                <div class="mx-10 mt-5 flex justify-between" id="overview_area">
                    <div class="text-center flex flex-col justify-between py-10 w-3/12 h-[250px] border-2 border-darthmouthgreen rounded-2xl" id="totalActiveCoursesArea">
                        <h1 class="text-[100px] pt-10 font-semibold text-darthmouthgreen" id="totalCoursesText">#</h1>
                        <p class="text-2xl mt-5  text-darthmouthgreen">Active Courses Managed</p>
                    </div>
                    <div class="text-center flex flex-col justify-between py-10 w-3/12 h-[250px] border-2 border-darthmouthgreen rounded-2xl" id="totalLearnersArea">
                        <h1 class="text-[100px] pt-10 font-semibold text-darthmouthgreen" id="totalLearnersCountText">#</h1>
                        <p class="text-2xl mt-5  text-darthmouthgreen">Learners Enrolled</p>
                    </div>
                    <div class="text-center flex flex-col justify-between py-10 w-3/12 h-[250px] border-2 border-darthmouthgreen rounded-2xl" id="totalTopicsArea">
                        <h1 class="text-[100px] pt-10 font-semibold text-darthmouthgreen" id="totalSyllabusCountText">#</h1>
                        <p class="text-2xl mt-5  text-darthmouthgreen">Topics Created</p>
                    </div>
                </div>



                <hr class="border-t-2 border-gray-300 my-6">

                <div class="flex justify-between">
                    <h1 class="mx-5 text-2xl font-semibold">Manage your courses</h1>
                    <a href="{{ url('/instructor/courses') }}" class="text-lg mx-10">view all</a>
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
                                <img class="absolute w-16 h-16 bg-yellow-500 rounded-full right-3 -bottom-4" src="{{ asset('storage/' . $instructor->profile_picture) }}" alt="">
                            </div>
                            
                            <div class="px-4">
                                <h1 class="mb-2 overflow-hidden text-lg font-bold text-white whitespace-no-wrap">{{ $course->course_name }}</h1>
        
                                <div class="text-sm text-gray-100 ">
                                    <p>{{ $course->course_code }}</p>
                                    <h3>{{ $course->instructor_fname }} {{ $course->instructor_lname }}</h3>
                                </div>
                            </div>
                            
                            <a href="{{ url("/instructor/course/$course->course_id") }}" style="background-color: #00693e; right:0; bottom: 0;" class="absolute float-right mx-4 mb-3 rounded">
                                <svg class="w-10 h-10" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="M504-480 320-664l56-56 240 240-240 240-56-56 184-184Z"/></svg>
                            </a>
                        </div>

                        @endforeach
                    </div>
                </div>


            
            <hr class="border-t-2 border-gray-300 my-6">

            <div class="flex justify-between">
                <h1 class="mx-5 text-2xl font-semibold">Enrolled Learners</h1>
                <a href="{{ url('/instructor/courses') }}" class="text-lg mx-10">view all</a>
            </div>

            <div class="mx-5 w-11/12" id="enrolledLearnersArea">
                <table class="w-full mt-5">
                    <thead class="text-left">
                        <th class="text-lg">Course Name</th>
                        <th class="text-lg">Number of Enrollees</th>
                    </thead>
                    <tbody id="enrollePercentArea">
                        {{-- <tr>
                            <td>Course 1</td>
                            <td>
                                <div class="h-7 rounded-xl" style="background: #9DB0A3" id="skill_bar">
                                    <div class="h-7 relative bg-darthmouthgreen rounded-xl text-white text-center py-1" id="skill_per" per="70%" style="max-width: 70%">70%</div>
                                </div>
                            </td>
                        </tr> --}}
                    </tbody>
                </table>
            </div>

            </div>
        </section>
        {{-- MAIN END --}}      
@endsection

