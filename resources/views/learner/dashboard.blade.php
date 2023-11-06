@include('partials.header')

    <section class="flex flex-row w-full h-auto bg-mainwhitebg">
        @include('partials.instructorNav')
        

        {{-- SIDEBAR --}}
        @include('partials.learnerSidebar')

        
        {{-- MAIN --}}
        <section class="relative w-full h-screen px-4 md:overflow-auto md:w-3/4 lg:w-9/12">
            <div class="top-0 right-0 md:absolute z-1 pt-[110px] md:pt-[60px] ">
                <x-dashboard.header
                title="Dashboard"
                name="search"
                id="search"
                placeholder="search..." />
                
                    {{-- OVERVIEW START --}}
                <div class="px-4 py-8 mx-4 mt-4 mb-4 border-2 rounded-lg shadow-lg">
                    <h1 class="text-2xl font-semibold">New Courses</h1>
                    
                    <div class="flex flex-col flex-wrap mt-5 grow-1 md:flex-row">

                        {{-- <div class="p-2 my-5 font-medium shadow-lg bg-sky-400 rounded-xl md:h-64 md:w-48 md:mx-4">
                            <div class="h-24 rounded-lg bg-sky-600 md:h-32">
                                
                            </div>

                            <div class="mt-2 text-sm">
                                <h1 class="text-lg font-medium">New Course 1</h1>
                                <p class="text-gray-500">10 Lessons</p>
                            </div>
                            <div class="relative w-full h-14">
                                <svg class="absolute rounded cursor-pointer right-2 bottom-2 bg-sky-600" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="M504-480 320-664l56-56 240 240-240 240-56-56 184-184Z"/></svg>
                            </div>
                        </div>
                        
                        <div class="p-2 my-5 font-medium shadow-lg bg-sky-400 rounded-xl md:h-64 md:w-48 md:mx-4">
                            <div class="h-24 rounded-lg bg-sky-600 md:h-32">
                                
                            </div>

                            <div class="mt-2 text-sm">
                                <h1 class="text-lg font-medium">New Course 1</h1>
                                <p class="text-gray-500">10 Lessons</p>
                            </div>
                            <div class="relative w-full h-14">
                                <svg class="absolute rounded cursor-pointer right-2 bottom-2 bg-sky-600" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="M504-480 320-664l56-56 240 240-240 240-56-56 184-184Z"/></svg>
                            </div>
                        </div>
                        
                        <div class="p-2 my-5 font-medium shadow-lg bg-sky-400 rounded-xl md:h-64 md:w-48 md:mx-4">
                            <div class="h-24 rounded-lg bg-sky-600 md:h-32">
                                
                            </div>

                            <div class="mt-2 text-sm">
                                <h1 class="text-lg font-medium">New Course 1</h1>
                                <p class="text-gray-500">10 Lessons</p>
                            </div>
                            <div class="relative w-full h-14">
                                <svg class="absolute rounded cursor-pointer right-2 bottom-2 bg-sky-600" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="M504-480 320-664l56-56 240 240-240 240-56-56 184-184Z"/></svg>
                            </div>
                        </div> --}}

                        @foreach ($courses as $course)
        
                    @php
                        $firstColor = '#' . str_pad(dechex(mt_rand(0, 0xFFFFFF)), 6, '0', STR_PAD_LEFT);

                        $firstColorRGB = sscanf($firstColor, "#%02x%02x%02x");
                        $darkenedColor = sprintf("#%02x%02x%02x", $firstColorRGB[0] * 0.8, $firstColorRGB[1] * 0.8, $firstColorRGB[2] * 0.8);
                    @endphp
                    <div style="background-color: {{$firstColor}}" class="relative m-3 bg-indigo-400 rounded-lg shadow-lg h-72 w-52">
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
                    </div>
                </div>
                {{-- OVERVIEW END --}}

                {{-- MY COURSES START --}}
                <div class="px-4 py-8 mx-4 mb-4 border-2 rounded-lg shadow-lg">
                    <div class="flex flex-row items-center justify-between mb-8 text-darthmouthgreen">
                        <h1 class="text-3xl font-semibold">My Courses</h1>
                        <a class="font-medium underline underline-offset-2" href="">view all</a>
                    </div>

                    <div class="overflow-auto">
                        <table class="w-full text-base table-fixed">
                            <thead class="text-xs">
                                <th>Course Name</th>
                                <th>Course Code</th>
                                <th>Start</th>
                                <th>Level</th>
                            </thead>
        
                            <tbody class="text-center">
                                @foreach ($enrolledCourses as $enrolledCourse)
                                @php
                                $firstColor = '#' . str_pad(dechex(mt_rand(0, 0xFFFFFF)), 6, '0', STR_PAD_LEFT);
            
                                $firstColorRGB = sscanf($firstColor, "#%02x%02x%02x");
                                $darkenedColor = sprintf("#%02x%02x%02x", $firstColorRGB[0] * 0.8, $firstColorRGB[1] * 0.8, $firstColorRGB[2] * 0.8);
                            @endphp
                                <tr>
                                    <td class="flex flex-row items-center justify-center mb-4">
                                        {{-- <img class="hidden w-10 h-10 mx-2 bg-red-500 rounded-lg lg:block" src="" alt=""> --}}
                                        <div style="background-color:{{$firstColor}}" class="w-10 h-10 mx-2 rounded-lg lg:block"></div>
                                        <div>
                                            <h1 class="">{{$enrolledCourse->course_name}}</h1>
                                            <h3 class="hidden text-xs opacity-50 lg:block">10 lessons</h3>
                                        </div>
                                    </td>
                                    <td>{{$enrolledCourse->course_code}}</td>
                                    <td>{{$enrolledCourse->created_at}}</td>
                                    <td>{{$enrolledCourse->course_difficulty}}</td>
                                </tr>
                                @endforeach
                                {{-- <tr>
                                    <td class="flex flex-row items-center justify-center mb-4">
                                        <img class="hidden w-10 h-10 mx-2 bg-red-500 rounded-lg lg:block" src="" alt="">
                                        <div>
                                            <h1 class="">Course1</h1>
                                            <h3 class="hidden text-xs opacity-50 lg:block">10 lessons</h3>
                                        </div>
                                    </td>
                                    <td>000000</td>
                                    <td>May 12</td>
                                    <td>Beginner</td>
                                </tr>
                                <tr>
                                    <td class="flex flex-row items-center justify-center mb-4">
                                        <img class="hidden w-10 h-10 mx-2 bg-red-500 rounded-lg lg:block" src="" alt="">
                                        <div>
                                            <h1 class="">Course1</h1>
                                            <h3 class="hidden text-xs opacity-50 lg:block">10 lessons</h3>
                                        </div>
                                    </td>
                                    <td>000000</td>
                                    <td>May 12</td>
                                    <td>Beginner</td>
                                </tr>
                                <tr>
                                    <td class="flex flex-row items-center justify-center mb-4">
                                        <img class="hidden w-10 h-10 mx-2 bg-red-500 rounded-lg lg:block" src="" alt="">
                                        <div>
                                            <h1 class="">Course1</h1>
                                            <h3 class="hidden text-xs opacity-50 lg:block">10 lessons</h3>
                                        </div>
                                    </td>
                                    <td>000000</td>
                                    <td>May 12</td>
                                    <td>Beginner</td>
                                </tr>
                                <tr>
                                    <td class="flex flex-row items-center justify-center mb-4">
                                        <img class="hidden w-10 h-10 mx-2 bg-red-500 rounded-lg lg:block" src="" alt="">
                                        <div>
                                            <h1 class="">Course1</h1>
                                            <h3 class="hidden text-xs opacity-50 lg:block">10 lessons</h3>
                                        </div>
                                    </td>
                                    <td>000000</td>
                                    <td>May 12</td>
                                    <td>Beginner</td>
                                </tr>
                                <tr>
                                    <td class="flex flex-row items-center justify-center mb-4">
                                        <img class="hidden w-10 h-10 mx-2 bg-red-500 rounded-lg lg:block" src="" alt="">
                                        <div>
                                            <h1 class="">Course1</h1>
                                            <h3 class="hidden text-xs opacity-50 lg:block">10 lessons</h3>
                                        </div>
                                    </td>
                                    <td>000000</td>
                                    <td>May 12</td>
                                    <td>Beginner</td>
                                </tr> --}}
                            </tbody>
                        </table>
                    </div>
                    
                </div>
            </div>
            
            
            {{-- MY COURSES END --}}
        </section>

        @include('partials.learnerProfile')
        
    </section>

@include('partials.footer')