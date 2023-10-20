@include('partials.header')

<section class="flex flex-row w-full h-screen bg-mainwhitebg">
    @include('partials.instructorNav')
    

    @include('partials.learnerSidebar')

        {{-- MAIN START --}}
        <section class="relative w-full h-screen px-4 pt-28 md:overflow-auto md:w-3/4 lg:w-9/12 md:pt-20">
            {{-- MAIN HEADER --}}
            <div class="flex flex-row items-center justify-between h-20 px-4">
                <h1 class="text-xl font-semibold md:text-4xl ">My Courses</h1>
                <form class="relative flex flex-row items-center" action="">
                    <button class="absolute left-0" type="submit">
                        <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="M784-120 532-372q-30 24-69 38t-83 14q-109 0-184.5-75.5T120-580q0-109 75.5-184.5T380-840q109 0 184.5 75.5T640-580q0 44-14 83t-38 69l252 252-56 56ZM380-400q75 0 127.5-52.5T560-580q0-75-52.5-127.5T380-760q-75 0-127.5 52.5T200-580q0 75 52.5 127.5T380-400Z"/></svg>
                    </button>
                    <input class="w-32 h-10 pl-6 rounded-lg md:w-64 md:h-12" type="search" name="search" id="search" placeholder="search">
                </form>
            </div>
    
            {{-- MAIN CONTENT --}}
            <div class="flex flex-row flex-wrap items-center justify-center mx-auto border-2 rounded-lg shadow grow lg:justify-start">
                @foreach ($learnerCourse as $course)
    
                @php
                    $firstColor = '#' . str_pad(dechex(mt_rand(0, 0xFFFFFF)), 6, '0', STR_PAD_LEFT);

                    $firstColorRGB = sscanf($firstColor, "#%02x%02x%02x");
                    $darkenedColor = sprintf("#%02x%02x%02x", $firstColorRGB[0] * 0.8, $firstColorRGB[1] * 0.8, $firstColorRGB[2] * 0.8);
                @endphp
                <div style="background-color: {{$firstColor}}" class="relative m-4 bg-indigo-400 rounded-lg shadow-lg h-72 w-52">
                    <div style="background-color: {{$darkenedColor}}" class="relative h-32 mx-auto my-4 rounded w-44">
                        <img class="absolute w-16 h-16 bg-yellow-500 rounded-full right-3 -bottom-4" src="{{ asset('storage/' . $course->profile_picture) }}"" alt="">
                    </div>
                    
                    <div class="px-4">
                        <h1 class="mb-2 overflow-hidden text-lg font-bold text-white whitespace-no-wrap">{{ $course->course_name }}</h1>

                        <div class="text-sm text-gray-100 ">
                            <p>{{ $course->course_code }}</p>
                            <h3>{{ $course->instructor_fname }} {{ $course->instructor_lname }}</h3>
                        </div>
                    </div>
                    
                    <a href="{{ url("/learner/course/$course->course_id") }}" style="background-color: {{$darkenedColor}}; right:0; bottom: 0;" class="absolute float-right mx-4 mb-3 rounded">
                        <svg class="w-10 h-10" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="M504-480 320-664l56-56 240 240-240 240-56-56 184-184Z"/></svg>
                    </a>
                </div>
            @endforeach
                {{-- <div class="m-4 bg-teal-400 rounded-lg shadow-lg h-72 w-52">
                    <div class="relative h-32 mx-auto my-4 bg-teal-600 rounded w-44">
                        <img class="absolute w-16 h-16 bg-yellow-500 rounded-full right-3 -bottom-4" src="" alt="">
                    </div>
                    
                    <div class="px-4">
                        <h1 class="mb-2 text-lg">Course 1</h1>
                        <div class="text-sm text-gray-500">
                            <p>000000</p>
                            <h3>Instructor 1</h3>
                        </div>
                    </div>
                    
                    <button class="float-right mx-4 bg-teal-700 rounded">
                        <svg class="w-10 h-10" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="M504-480 320-664l56-56 240 240-240 240-56-56 184-184Z"/></svg>
                    </button>
                </div>
                <div class="m-4 rounded-lg shadow-lg h-72 w-52 bg-cyan-400">
                    <div class="relative h-32 mx-auto my-4 rounded bg-cyan-600 w-44">
                        <img class="absolute w-16 h-16 bg-yellow-500 rounded-full right-3 -bottom-4" src="" alt="">
                    </div>
                    
                    <div class="px-4">
                        <h1 class="mb-2 text-lg">Course 1</h1>
                        <div class="text-sm text-gray-500">
                            <p>000000</p>
                            <h3>Instructor 1</h3>
                        </div>
                    </div>
                    
                    <button class="float-right mx-4 rounded bg-cyan-700">
                        <svg class="w-10 h-10" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="M504-480 320-664l56-56 240 240-240 240-56-56 184-184Z"/></svg>
                    </button>
                </div>
                <div class="m-4 bg-indigo-400 rounded-lg shadow-lg h-72 w-52">
                    <div class="relative h-32 mx-auto my-4 bg-indigo-600 rounded w-44">
                        <img class="absolute w-16 h-16 bg-yellow-500 rounded-full right-3 -bottom-4" src="" alt="">
                    </div>
                    
                    <div class="px-4">
                        <h1 class="mb-2 text-lg">Course 1</h1>
                        <div class="text-sm text-gray-500">
                            <p>000000</p>
                            <h3>Instructor 1</h3>
                        </div>
                    </div>
                    
                    <button class="float-right mx-4 bg-indigo-700 rounded">
                        <svg class="w-10 h-10" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="M504-480 320-664l56-56 240 240-240 240-56-56 184-184Z"/></svg>
                    </button>
                </div>
                <div class="m-4 rounded-lg shadow-lg bg-amber-400 h-72 w-52">
                    <div class="relative h-32 mx-auto my-4 rounded bg-amber-600 w-44">
                        <img class="absolute w-16 h-16 bg-yellow-500 rounded-full right-3 -bottom-4" src="" alt="">
                    </div>
                    
                    <div class="px-4">
                        <h1 class="mb-2 text-lg">Course 1</h1>
                        <div class="text-sm text-gray-500">
                            <p>000000</p>
                            <h3>Instructor 1</h3>
                        </div>
                    </div>
                    
                    <button class="float-right mx-4 rounded bg-amber-700">
                        <svg class="w-10 h-10" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="M504-480 320-664l56-56 240 240-240 240-56-56 184-184Z"/></svg>
                    </button>
                </div> --}}
                
    
{{--                 
                <a href="{{ url('/instructor/courses/create') }}" class="flex flex-col items-center justify-center m-4 bg-white rounded-lg shadow-lg w-52 h-72" id="addNewCourse">
                    <svg class="w-24 h-24" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="M440-440H200v-80h240v-240h80v240h240v80H520v240h-80v-240Z"/></svg>
                    <h1 class="text-lg font-medium">add new course</h1>
                </a> --}}
            </div>
        </section>
        {{-- MAIN END --}}
    
        {{--! variables undefined --}}
        @include('partials.learnerProfile')
        
    
    </section>
    
    @include('partials.footer')

</section>