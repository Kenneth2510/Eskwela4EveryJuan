@include('partials.header')

    <nav class="fixed z-40 flex flex-row items-center w-full px-4 py-4 bg-green-600">
        <button id="hamb-but">
            
            <svg xmlns="http://www.w3.org/2000/svg" height="40" viewBox="0 -960 960 960" width="40"><path d="M120-240v-80h720v80H120Zm0-200v-80h720v80H120Zm0-200v-80h720v80H120Z"/></svg>
        </button>

        <a href="#">
            <span class="self-center text-xl font-bold font-semibbold whitespace-nowrap md:text-2xl">
                Eskwela4EveryJuan
            </span>
        </a>

        <button class="absolute right-4" id="prof-open-btn">
            <img class="w-10 h-10" src="{{url('/assets/account-icon.svg')}}" alt="">
        </button>
    </nav>  

    <section class="fixed z-10 h-full text-xl bg-green-600 mt-14" id="main-sidebar">
        
        <div class="hidden max-w-full mx-auto mt-20" id="max-sidebar">
            <ul class="text-white list-none list-inside">
                <li class="px-10 py-3 rounded-lg hover:bg-green-800">
                    <a class="flex flex-row" href="#">
                        <img class="mx-2" src="{{url('/assets/home-icon.svg')}}" alt="homeicon">
                        <h1>Dashboard</h1>
                    </a>
                </li>
                <li class="px-10 py-3 rounded-lg hover:bg-green-800">
                    <a class="flex flex-row" href="">
                        <img class="mx-2" src="{{url('/assets/chat-icon.svg')}}" alt="homeicon">
                        <h1>Chats</h1>
                    </a>
                </li>
                <li class="px-10 py-3 rounded-lg hover:bg-green-800">
                    <a class="flex flex-row" href="">
                        <img class="mx-2" src="{{url('/assets/course-icon.svg')}}" alt="homeicon">
                        <h1>Courses</h1>
                    </a>

                </li>
                <li class="px-10 py-3 rounded-lg hover:bg-green-800">
                    <a class="flex flex-row" href="">
                        <img class="mx-2" src="{{url('/assets/performance-icon.svg')}}" alt="homeicon">
                        <h1>Performance</h1>
                    </a>
                    
                </li>
                <li class="px-10 py-3 rounded-lg hover:bg-green-800">
                    <a class="flex flex-row" href="">
                        <img class="mx-2" src="{{url('/assets/calendar-icon.svg')}}" alt="homeicon">
                    <h1>Calendar</h1>
                </a>
                    
                </li>
                <li class="px-10 py-3 rounded-lg hover:bg-green-800">
                    <a class="flex flex-row" href="">
                        <img class="mx-2" src="{{url('/assets/settings-icon.svg')}}" alt="homeicon">
                    <h1>Settings</h1>
                </a>
                    
                </li>
            </ul>
        </div>

        <div class="max-w-full mx-auto mt-20" id="min-sidebar">
            <ul class="list-none list-inside">
                <li class="px-2 py-3 rounded-lg hover:bg-green-800">
                    <a class="flex flex-row" href="#">
                        <img class="mx-2" src="{{url('/assets/home-icon.svg')}}" alt="homeicon">
                    </a>
                </li>
                <li class="px-2 py-3 rounded-lg hover:bg-green-800">
                    <a class="flex flex-row" href="">
                        <img class="mx-2" src="{{url('/assets/chat-icon.svg')}}" alt="homeicon">
                    </a>
                </li>
                <li class="px-2 py-3 rounded-lg hover:bg-green-800">
                    <a class="flex flex-row" href="">
                        <img class="mx-2" src="{{url('/assets/course-icon.svg')}}" alt="homeicon">
                    </a>

                </li>
                <li class="px-2 py-3 rounded-lg hover:bg-green-800">
                    <a class="flex flex-row" href="">
                        <img class="mx-2" src="{{url('/assets/performance-icon.svg')}}" alt="homeicon">
                    </a>
                    
                </li>
                <li class="px-2 py-3 rounded-lg hover:bg-green-800">
                    <a class="flex flex-row" href="">
                        <img class="mx-2" src="{{url('/assets/calendar-icon.svg')}}" alt="homeicon">
                </a>
                    
                </li>
                <li class="px-2 py-3 rounded-lg hover:bg-green-800">
                    <a class="flex flex-row" href="">
                        <img class="mx-2" src="{{url('/assets/settings-icon.svg')}}" alt="homeicon">
                </a>
                </li>
            </ul>
        </div>
            
    </section>

    <section class="relative pt-16 mx-auto ml-14">
        <div class="fixed flex flex-row items-center justify-between min-w-full mx-auto bg-green-600 h-14">
            <h1 class="text-4xl">Dashboard</h1>
            <div class="relative pr-16">
                <img class="absolute top-2 left-2" src="{{url('/assets/search-icon.svg')}}" alt="">
                <input class="w-40 h-10 pl-8 rounded-xl" type="search" name="" id="">
            </div>
        </div>
        
        {{-- OVERVIEW START --}}
        <div class="px-4 py-8 mx-4 mt-20 mb-4 border-2 rounded-lg shadow-lg">
            <h1 class="text-3xl font-semibold">Overview</h1>
            
            <div class="flex flex-col mt-5">
                <div class="p-4 my-5 font-medium bg-green-200 shadow-lg rounded-xl">
                    <h2 class="text-2xl">Number of Courses</h2>
                    <div class="flex flex-row items-center">
                        <img class="w-20 h-20 bg-green-400 rounded-3xl" src="{{url('/assets/active-class-icon.svg')}}" alt="">
                        <h1 class="text-9xl">3</h1>
                        <p>active courses</p>
                    </div>

                    <div>
                        <h3>Total Active Courses: <span>3</span></h3>
                        <h3>Total Created Courses: <span>5</span></h3>
                    </div>
                </div>
                
                <div class="flex flex-col my-5">
                    <div class="flex flex-row items-center my-1 shadow-lg bg-violet-200 rounded-xl">
                        <img class="w-20 h-20 m-2" src="{{url('/assets/book-icon.svg')}}" alt="">
                        <div class="flex flex-col">
                            <h1 class="text-2xl font-bold">35</h1>
                            <p>total lessons added</p>
                        </div>
                    </div>
                    <div class="flex flex-row items-center my-1 shadow-lg bg-violet-200 rounded-xl">
                        <img class="w-20 h-20 m-2" src="{{url('/assets/book-icon.svg')}}" alt="">
                        <div class="flex flex-col">
                            <h1 class="text-2xl font-bold">13</h1>
                            <p>total assignments added</p>
                        </div>
                    </div>
                    <div class="flex flex-row items-center my-1 shadow-lg bg-violet-200 rounded-xl">
                        <img class="w-20 h-20 m-2" src="{{url('/assets/book-icon.svg')}}" alt="">
                        <div class="flex flex-col">
                            <h1 class="text-2xl font-bold">11</h1>
                            <p>total quizzes added</p>
                        </div>
                    </div>
                </div>

                <div class="p-4 my-5 font-medium bg-green-200 shadow-lg rounded-xl">
                    <h2 class="text-2xl">Number of Courses</h2>
                    <div class="flex flex-row items-center">
                        <img class="w-20 h-20 bg-green-400 rounded-3xl" src="{{url('/assets/active-class-icon.svg')}}" alt="">
                        <h1 class="text-9xl">3</h1>
                        <p>active courses</p>
                    </div>

                    <div>
                        <h3>Total Active Courses: <span>3</span></h3>
                        <h3>Total Created Courses: <span>5</span></h3>
                    </div>
                </div>
                
            </div>
        </div>
        {{-- OVERVIEW END --}}

        {{-- MY COURSES START --}}
        <div class="px-4 py-8 mx-4 mb-4 border-2 rounded-lg shadow-lg">
            <div class="flex flex-row justify-between mb-8">
                <h1 class="text-3xl font-semibold">My Courses</h1>
                <a class="font-medium text-green-600 underline" href="">view all</a>
            </div>

            <table>
                <thead class="">
                    <th>Course Name</th>
                    <th>Status</th>
                    <th>Course Code</th>
                    <th>Total Enrolled</th>
                    <th>Total Completes</th>
                </thead>

                <tbody class="text-center">
                    <tr>
                        <td>
                            <img src="" alt="">
                            <div>
                                <h1 class="text-lg">Course1</h1>
                                <h3 class="text-sm opacity-50">10 lessons</h3>
                            </div>
                        </td>
                        <td class="text-green-600">Active</td>
                        <td>000000</td>
                        <td>43</td>
                        <td>35/43</td>
                    </tr>
                    <tr>
                        <td>
                            <img src="" alt="">
                            <div>
                                <h1 class="text-lg">Course1</h1>
                                <h3 class="text-sm opacity-50">10 lessons</h3>
                            </div>
                        </td>
                        <td class="text-green-600">Active</td>
                        <td>000000</td>
                        <td>43</td>
                        <td>35/43</td>
                    </tr>
                    <tr>
                        <td>
                            <img src="" alt="">
                            <div>
                                <h1 class="text-lg">Course1</h1>
                                <h3 class="text-sm opacity-50">10 lessons</h3>
                            </div>
                        </td>
                        <td class="text-green-600">Active</td>
                        <td>000000</td>
                        <td>43</td>
                        <td>35/43</td>
                    </tr>
                    <tr>
                        <td>
                            <img src="" alt="">
                            <div>
                                <h1 class="text-lg">Course1</h1>
                                <h3 class="text-sm opacity-50">10 lessons</h3>
                            </div>
                        </td>
                        <td class="text-green-600">Active</td>
                        <td>000000</td>
                        <td>43</td>
                        <td>35/43</td>
                    </tr>
                    
                </tbody>
            </table>
        </div>
        {{-- MY COURSES END --}}
    </section>
    
    <section class="fixed top-0 z-50 hidden w-full h-full bg-white bg-opacity-50" id="profile">
        <button class="absolute z-50 top-4 right-4" id="prof-btn">
            <img src="{{url('/assets/close-icon.svg')}}" alt="">
        </button>

        <div class="float-right h-full p-4 bg-white w-60 pt-14">
            <div class="">
                <h1 class="text-2xl font-semibold">Profile</h1>

                <div class="grid place-items-center">
                    <img class="w-10 h-10 my-4 bg-green-500 rounded-full" src="" alt="">
                    <h1 class="text-lg font-medium">Person 1</h1>
                    <h3 class="text-sm opacity-50">Instructor ID 2</h3>
                </div>

                <div class="grid grid-flow-col">
                    <a href="">Edit Profile</a>
                    <a href="">view activity logs</a>
                </div>
            </div>
        </div>
    </section>

@include('partials.footer')