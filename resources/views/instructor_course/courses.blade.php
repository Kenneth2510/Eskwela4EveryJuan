@include('partials.header')

<section class="flex flex-row w-full h-screen bg-mainwhitebg">
    @include('partials.instructorNav')
    @include('partials.instructorSidebar')
    {{-- SIDEBAR END --}}
    
    {{-- MAIN START --}}
    <section class="relative w-full h-screen px-4 pt-28 md:overflow-auto md:w-3/4 lg:w-9/12 md:pt-20">
        {{-- MAIN HEADER --}}
        <div class="flex flex-row items-center justify-between h-20 px-4">
            <h1 class="text-xl font-semibold md:text-4xl ">My Courses</h1>
            <form class="relative flex flex-row items-center" action="">
                <button class="absolute left-0" type="submit">
                    <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="M784-120 532-372q-30 24-69 38t-83 14q-109 0-184.5-75.5T120-580q0-109 75.5-184.5T380-840q109 0 184.5 75.5T640-580q0 44-14 83t-38 69l252 252-56 56ZM380-400q75 0 127.5-52.5T560-580q0-75-52.5-127.5T380-760q-75 0-127.5 52.5T200-580q0 75 52.5 127.5T380-400Z"/></svg>
                </button>
                <input class="w-32 h-10 pl-6 rounded-lg md:w-64 md:h-12" type="search" name="search" id="searchCourse" placeholder="search">
            </form>
        </div>

        {{-- MAIN CONTENT --}}
        <div class="mt-5">
            <div class="flex justify-between">
                <h1 class="mx-5 text-2xl font-semibold">Recents</h1>
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
        </div>
        


        <hr class="border-t-2 border-gray-300 my-6">

        <div class="flex justify-between">
            <h1 class="mx-5 text-2xl font-semibold">All your courses</h1>
        </div>
        <div class="mt-5 flex flex-row flex-wrap items-center justify-center mx-auto border-2 rounded-lg shadow grow lg:justify-start">
  
            
            
            <div class="flex flex-row flex-wrap items-center justify-center" id="coursesArea">
                <div class="flex flex-row flex-wrap items-center justify-center" id="courses">
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
            
            <a href="{{ url('/instructor/courses/create') }}" class="flex flex-col items-center justify-center m-4 bg-white rounded-lg shadow-lg w-52 h-72" id="addNewCourse">
                <svg class="w-24 h-24" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="M440-440H200v-80h240v-240h80v240h240v80H520v240h-80v-240Z"/></svg>
                <h1 class="text-lg font-medium">add new course</h1>
            </a>
            </div>
            
        </div>
    </section>
    {{-- MAIN END --}}

    {{--! variables undefined --}}
    @include('partials.instructorProfile')
    

</section>

@include('partials.footer')