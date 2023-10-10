@include('partials.header');

    <section>
        <header class="fixed top-0 left-0 z-40 flex flex-row items-center w-full px-4 py-4 bg-seagreen">
            <button class="hidden" id="hamb-but">
                
                <svg xmlns="http://www.w3.org/2000/svg" height="40" viewBox="0 -960 960 960" width="40"><path d="M120-240v-80h720v80H120Zm0-200v-80h720v80H120Zm0-200v-80h720v80H120Z"/></svg>
            </button>

            <a href="#">
                <span class="self-center text-lg font-semibold font-semibbold whitespace-nowrap md:text-2xl text-mainwhitebg">
                    Eskwela4EveryJuan
                </span>
            </a>

            <button class="absolute right-4" id="prof-open-btn">
                <img class="w-10 h-10" src="{{url('/assets/account-icon.svg')}}" alt="">
            </button>
        </header> 
        
        @include('partials.learner_sidebar');
        
        {{-- MAIN --}}
        <section class="relative w-full h-auto px-4 mt-28">   
            <div class="flex flex-row items-center justify-between h-20">
                <h1 class="text-xl font-semibold">Dashboard</h1>
                <form class="relative flex flex-row items-center" action="">
                    <button class="absolute left-0" type="submit">
                        <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="M784-120 532-372q-30 24-69 38t-83 14q-109 0-184.5-75.5T120-580q0-109 75.5-184.5T380-840q109 0 184.5 75.5T640-580q0 44-14 83t-38 69l252 252-56 56ZM380-400q75 0 127.5-52.5T560-580q0-75-52.5-127.5T380-760q-75 0-127.5 52.5T200-580q0 75 52.5 127.5T380-400Z"/></svg>
                    </button>
                    <input class="w-32 h-10 pl-6 rounded-lg" type="search" name="search" id="search" placeholder="search">
                </form>
            </div>
            
            {{-- OVERVIEW START --}}
            <div class="px-4 py-8 mx-4 mt-4 mb-4 border-2 rounded-lg shadow-lg">
                <h1 class="text-2xl font-semibold">New Courses</h1>
                
                <div class="flex flex-col flex-wrap mt-5">

                    <div class="p-2 my-5 font-medium shadow-lg bg-sky-400 rounded-xl">
                        <div class="h-24 rounded-lg bg-sky-600">
                            
                        </div>

                        <div class="mt-2 text-sm">
                            <h1 class="text-lg font-medium">New Course 1</h1>
                            <p class="text-gray-500">10 Lessons</p>
                        </div>
                        <div class="relative w-full h-14">
                            <svg class="absolute rounded cursor-pointer right-2 bottom-2 bg-sky-600" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="M504-480 320-664l56-56 240 240-240 240-56-56 184-184Z"/></svg>
                        </div>
                    </div>
                    
                    <div class="p-2 my-5 font-medium shadow-lg bg-sky-400 rounded-xl">
                        <div class="h-24 rounded-lg bg-sky-600">
                            
                        </div>

                        <div class="mt-2 text-sm">
                            <h1 class="text-lg font-medium">New Course 1</h1>
                            <p class="text-gray-500">10 Lessons</p>
                        </div>
                        <div class="relative w-full h-14">
                            <svg class="absolute rounded cursor-pointer right-2 bottom-2 bg-sky-600" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="M504-480 320-664l56-56 240 240-240 240-56-56 184-184Z"/></svg>
                        </div>
                    </div>
                    
                    <div class="p-2 my-5 font-medium shadow-lg bg-sky-400 rounded-xl">
                        <div class="h-24 rounded-lg bg-sky-600">
                            
                        </div>

                        <div class="mt-2 text-sm">
                            <h1 class="text-lg font-medium">New Course 1</h1>
                            <p class="text-gray-500">10 Lessons</p>
                        </div>
                        <div class="relative w-full h-14">
                            <svg class="absolute rounded cursor-pointer right-2 bottom-2 bg-sky-600" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="M504-480 320-664l56-56 240 240-240 240-56-56 184-184Z"/></svg>
                        </div>
                    </div>
                </div>
            </div>
            {{-- OVERVIEW END --}}

            {{-- MY COURSES START --}}
            <div class="px-4 py-8 mx-4 mb-4 border-2 rounded-lg shadow-lg">
                <div class="flex flex-row items-center justify-between mb-8 text-darthmouthgreen">
                    <h1 class="text-3xl font-semibold">My Courses</h1>
                    <a class="font-medium underline underline-offset-2" href="">view all</a>
                </div>

                <table class="w-full text-sm">
                    <thead class="text-xs">
                        <th>Course Name</th>
                        <th>Course Code</th>
                        <th>Start</th>
                        <th>Level</th>
                    </thead>

                    <tbody class="text-center">
                        <tr>
                            <td >
                                <img src="" alt="">
                                <div>
                                    <h1 class="">Course1</h1>
                                    <h3 class="hidden text-xs opacity-50">10 lessons</h3>
                                </div>
                            </td>
                            <td>000000</td>
                            <td>May 12</td>
                            <td>Beginner</td>
                        </tr>
                        <tr>
                            <td >
                                <img src="" alt="">
                                <div>
                                    <h1 class="">Course1</h1>
                                    <h3 class="hidden text-xs opacity-50">10 lessons</h3>
                                </div>
                            </td>
                            <td>000000</td>
                            <td>May 12</td>
                            <td>Beginner</td>
                        </tr>
                        <tr>
                            <td >
                                <img src="" alt="">
                                <div>
                                    <h1 class="">Course1</h1>
                                    <h3 class="hidden text-xs opacity-50">10 lessons</h3>
                                </div>
                            </td>
                            <td>000000</td>
                            <td>May 12</td>
                            <td>Beginner</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            {{-- MY COURSES END --}}
        </section>
        
    </section>

@include('partials.footer');