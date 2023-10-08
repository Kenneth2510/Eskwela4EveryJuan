@include('partials.header')
    
    <section class="relative w-full h-auto bg-mainwhitebg">
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
        @include('partials.instructor_sidebar')
    
        {{-- SIDEBAR END --}}

        {{-- MAIN START --}}
        <section class="mx-auto pt-[122px] px-2">
            <div class="flex flex-row items-center justify-between w-full h-14">
                <h1 class="text-3xl font-semibold text-darthmouthgreen">Dashboard</h1>
                <div class="relative">
                    <button class="absolute left-0 top-2">
                        <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="M784-120 532-372q-30 24-69 38t-83 14q-109 0-184.5-75.5T120-580q0-109 75.5-184.5T380-840q109 0 184.5 75.5T640-580q0 44-14 83t-38 69l252 252-56 56ZM380-400q75 0 127.5-52.5T560-580q0-75-52.5-127.5T380-760q-75 0-127.5 52.5T200-580q0 75 52.5 127.5T380-400Z"/></svg>
                    </button>
                    <input class="w-40 h-10 pl-8 rounded-xl" type="search" name="" id="">
                </div>
            </div>
            
            {{-- OVERVIEW START --}}
            <div class="px-4 py-8 mx-4 mt-4 mb-4 border-2 rounded-lg shadow-lg">
                <h1 class="text-2xl font-semibold">Overview</h1>
                
                <div class="flex flex-col mt-5">
                    <div class="p-4 my-5 font-medium bg-teal-400 shadow-lg rounded-xl">
                        <h2 class="hidden text-2xl">Number of Courses</h2>
                        <div class="flex flex-row items-center justify-evenly">
                            <svg class="w-24 h-20 bg-teal-600 rounded-3xl" viewBox="0 0 44 36" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M41.5312 21.9062V11.75L22 1.59375L2.46875 11.75L22 21.9062L32.1562 17.2188V28.1562C32.1562 31.2812 27.4688 34.4062 22 34.4062C16.5312 34.4062 11.8438 31.2812 11.8438 28.1562V17.2188" stroke="white" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            <div class="flex flex-row items-center">
                                <h1 class="text-9xl">3</h1>
                                <p>Active Courses</p>
                            </div>
                        </div>

                        <div class="">  
                            <h3>
                                Created Courses: <span>5</span>
                            </h3>
                        </div>
                    </div>
                    
                    <div class="flex flex-col my-5">
                        <div class="flex flex-row items-center my-1 shadow-lg bg-violet-400 rounded-xl">
                            <svg class="w-16 h-16 p-2 m-4 rounded-lg bg-violet-600" viewBox="0 0 30 26" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M1.875 4.30249C3.53437 3.60874 5.91375 2.86061 8.2275 2.62811C10.7213 2.37686 12.8363 2.74624 14.0625 4.03812V22.3119C12.3094 21.3181 10.0875 21.1812 8.03813 21.3875C5.82563 21.6125 3.59437 22.2519 1.875 22.9081V4.30249ZM15.9375 4.03812C17.1637 2.74624 19.2788 2.37686 21.7725 2.62811C24.0863 2.86061 26.4656 3.60874 28.125 4.30249V22.9081C26.4037 22.2519 24.1744 21.6106 21.9619 21.3894C19.9106 21.1812 17.6906 21.3162 15.9375 22.3119V4.03812ZM15 2.34311C13.1531 0.75499 10.4756 0.51874 8.03813 0.76249C5.19938 1.04937 2.33438 2.02249 0.549375 2.83437C0.385592 2.90885 0.246704 3.0289 0.149289 3.18018C0.051875 3.33145 4.98214e-05 3.50756 0 3.68749L0 24.3125C4.34287e-05 24.4693 0.0394446 24.6237 0.114595 24.7614C0.189744 24.8991 0.298241 25.0157 0.430145 25.1006C0.56205 25.1855 0.713146 25.2359 0.869594 25.2473C1.02604 25.2586 1.18284 25.2306 1.32563 25.1656C2.97938 24.4156 5.64375 23.5137 8.22563 23.2531C10.8675 22.9869 13.0819 23.4162 14.2688 24.8975C14.3566 25.007 14.4679 25.0954 14.5945 25.1561C14.721 25.2168 14.8596 25.2483 15 25.2483C15.1404 25.2483 15.279 25.2168 15.4055 25.1561C15.5321 25.0954 15.6434 25.007 15.7313 24.8975C16.9181 23.4162 19.1325 22.9869 21.7725 23.2531C24.3563 23.5137 27.0225 24.4156 28.6744 25.1656C28.8172 25.2306 28.974 25.2586 29.1304 25.2473C29.2869 25.2359 29.438 25.1855 29.5699 25.1006C29.7018 25.0157 29.8103 24.8991 29.8854 24.7614C29.9606 24.6237 30 24.4693 30 24.3125V3.68749C30 3.50756 29.9481 3.33145 29.8507 3.18018C29.7533 3.0289 29.6144 2.90885 29.4506 2.83437C27.6656 2.02249 24.8006 1.04937 21.9619 0.76249C19.5244 0.516865 16.8469 0.75499 15 2.34311Z" fill="#F8F8F8"/>
                            </svg>
                            <div class="flex flex-col">
                                <h1 class="text-2xl font-bold">35</h1>
                                <p>total lessons added</p>
                            </div>
                        </div>
                        <div class="flex flex-row items-center my-1 shadow-lg bg-violet-400 rounded-xl">
                            <svg class="w-16 h-16 p-2 m-4 rounded-lg bg-violet-600" viewBox="0 0 30 26" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M1.875 4.30249C3.53437 3.60874 5.91375 2.86061 8.2275 2.62811C10.7213 2.37686 12.8363 2.74624 14.0625 4.03812V22.3119C12.3094 21.3181 10.0875 21.1812 8.03813 21.3875C5.82563 21.6125 3.59437 22.2519 1.875 22.9081V4.30249ZM15.9375 4.03812C17.1637 2.74624 19.2788 2.37686 21.7725 2.62811C24.0863 2.86061 26.4656 3.60874 28.125 4.30249V22.9081C26.4037 22.2519 24.1744 21.6106 21.9619 21.3894C19.9106 21.1812 17.6906 21.3162 15.9375 22.3119V4.03812ZM15 2.34311C13.1531 0.75499 10.4756 0.51874 8.03813 0.76249C5.19938 1.04937 2.33438 2.02249 0.549375 2.83437C0.385592 2.90885 0.246704 3.0289 0.149289 3.18018C0.051875 3.33145 4.98214e-05 3.50756 0 3.68749L0 24.3125C4.34287e-05 24.4693 0.0394446 24.6237 0.114595 24.7614C0.189744 24.8991 0.298241 25.0157 0.430145 25.1006C0.56205 25.1855 0.713146 25.2359 0.869594 25.2473C1.02604 25.2586 1.18284 25.2306 1.32563 25.1656C2.97938 24.4156 5.64375 23.5137 8.22563 23.2531C10.8675 22.9869 13.0819 23.4162 14.2688 24.8975C14.3566 25.007 14.4679 25.0954 14.5945 25.1561C14.721 25.2168 14.8596 25.2483 15 25.2483C15.1404 25.2483 15.279 25.2168 15.4055 25.1561C15.5321 25.0954 15.6434 25.007 15.7313 24.8975C16.9181 23.4162 19.1325 22.9869 21.7725 23.2531C24.3563 23.5137 27.0225 24.4156 28.6744 25.1656C28.8172 25.2306 28.974 25.2586 29.1304 25.2473C29.2869 25.2359 29.438 25.1855 29.5699 25.1006C29.7018 25.0157 29.8103 24.8991 29.8854 24.7614C29.9606 24.6237 30 24.4693 30 24.3125V3.68749C30 3.50756 29.9481 3.33145 29.8507 3.18018C29.7533 3.0289 29.6144 2.90885 29.4506 2.83437C27.6656 2.02249 24.8006 1.04937 21.9619 0.76249C19.5244 0.516865 16.8469 0.75499 15 2.34311Z" fill="#F8F8F8"/>
                            </svg>
                            <div class="flex flex-col">
                                <h1 class="text-2xl font-bold">13</h1>
                                <p>total assignments added</p>
                            </div>
                        </div>
                        <div class="flex flex-row items-center my-1 shadow-lg bg-violet-400 rounded-xl">
                            <svg class="w-16 h-16 p-2 m-4 rounded-lg bg-violet-600" viewBox="0 0 30 26" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M1.875 4.30249C3.53437 3.60874 5.91375 2.86061 8.2275 2.62811C10.7213 2.37686 12.8363 2.74624 14.0625 4.03812V22.3119C12.3094 21.3181 10.0875 21.1812 8.03813 21.3875C5.82563 21.6125 3.59437 22.2519 1.875 22.9081V4.30249ZM15.9375 4.03812C17.1637 2.74624 19.2788 2.37686 21.7725 2.62811C24.0863 2.86061 26.4656 3.60874 28.125 4.30249V22.9081C26.4037 22.2519 24.1744 21.6106 21.9619 21.3894C19.9106 21.1812 17.6906 21.3162 15.9375 22.3119V4.03812ZM15 2.34311C13.1531 0.75499 10.4756 0.51874 8.03813 0.76249C5.19938 1.04937 2.33438 2.02249 0.549375 2.83437C0.385592 2.90885 0.246704 3.0289 0.149289 3.18018C0.051875 3.33145 4.98214e-05 3.50756 0 3.68749L0 24.3125C4.34287e-05 24.4693 0.0394446 24.6237 0.114595 24.7614C0.189744 24.8991 0.298241 25.0157 0.430145 25.1006C0.56205 25.1855 0.713146 25.2359 0.869594 25.2473C1.02604 25.2586 1.18284 25.2306 1.32563 25.1656C2.97938 24.4156 5.64375 23.5137 8.22563 23.2531C10.8675 22.9869 13.0819 23.4162 14.2688 24.8975C14.3566 25.007 14.4679 25.0954 14.5945 25.1561C14.721 25.2168 14.8596 25.2483 15 25.2483C15.1404 25.2483 15.279 25.2168 15.4055 25.1561C15.5321 25.0954 15.6434 25.007 15.7313 24.8975C16.9181 23.4162 19.1325 22.9869 21.7725 23.2531C24.3563 23.5137 27.0225 24.4156 28.6744 25.1656C28.8172 25.2306 28.974 25.2586 29.1304 25.2473C29.2869 25.2359 29.438 25.1855 29.5699 25.1006C29.7018 25.0157 29.8103 24.8991 29.8854 24.7614C29.9606 24.6237 30 24.4693 30 24.3125V3.68749C30 3.50756 29.9481 3.33145 29.8507 3.18018C29.7533 3.0289 29.6144 2.90885 29.4506 2.83437C27.6656 2.02249 24.8006 1.04937 21.9619 0.76249C19.5244 0.516865 16.8469 0.75499 15 2.34311Z" fill="#F8F8F8"/>
                            </svg>
                            <div class="flex flex-col">
                                <h1 class="text-2xl font-bold">11</h1>
                                <p>total quizzes added</p>
                            </div>
                        </div>
                    </div>

                    <div class="p-4 my-5 font-medium shadow-lg bg-sky-400 rounded-xl">
                        <h2 class="text-xl ">Number of Learners</h2>
                        <div class="flex flex-row items-center justify-evenly">
                            <svg class="w-20 h-20 px-2 rounded-lg bg-sky-600"  viewBox="0 0 209 201" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M202.53 32.41L106.53 0.409983C104.888 -0.137475 103.112 -0.137475 101.47 0.409983L5.47 32.41C3.87705 32.941 2.49157 33.9598 1.50983 35.322C0.528097 36.6842 -0.000124423 38.3209 2.19836e-08 40V120C2.19836e-08 122.122 0.842854 124.157 2.34315 125.657C3.84344 127.157 5.87827 128 8 128C10.1217 128 12.1566 127.157 13.6569 125.657C15.1571 124.157 16 122.122 16 120V51.1L49.59 62.29C40.6656 76.708 37.8277 94.0784 41.6994 110.587C45.5711 127.096 55.8359 141.393 70.24 150.34C52.24 157.4 36.68 170.17 25.3 187.63C24.7082 188.51 24.2971 189.498 24.0906 190.538C23.8842 191.578 23.8865 192.649 24.0974 193.688C24.3084 194.727 24.7237 195.713 25.3193 196.59C25.915 197.467 26.679 198.217 27.567 198.797C28.455 199.376 29.4493 199.773 30.4921 199.964C31.5348 200.156 32.6053 200.138 33.6412 199.912C34.677 199.687 35.6577 199.257 36.5262 198.649C37.3946 198.041 38.1336 197.266 38.7 196.37C53.77 173.25 77.57 160 104 160C130.43 160 154.23 173.25 169.3 196.37C170.473 198.114 172.286 199.326 174.346 199.744C176.406 200.162 178.547 199.753 180.308 198.605C182.068 197.457 183.306 195.661 183.754 193.608C184.202 191.554 183.823 189.407 182.7 187.63C171.32 170.17 155.7 157.4 137.76 150.34C152.15 141.393 162.405 127.105 166.276 110.609C170.148 94.1122 167.319 76.7538 158.41 62.34L202.53 47.64C204.123 47.1093 205.509 46.0906 206.491 44.7284C207.473 43.3661 208.002 41.7293 208.002 40.05C208.002 38.3706 207.473 36.7339 206.491 35.3716C205.509 34.0094 204.123 32.9907 202.53 32.46V32.41ZM152 96C152.002 103.589 150.205 111.069 146.756 117.829C143.307 124.589 138.305 130.434 132.159 134.886C126.014 139.338 118.9 142.269 111.403 143.439C103.905 144.61 96.2364 143.986 89.0265 141.618C81.8166 139.251 75.2707 135.208 69.9259 129.821C64.5811 124.434 60.5897 117.857 58.2791 110.629C55.9685 103.4 55.4047 95.7273 56.6338 88.2389C57.863 80.7506 60.85 73.6604 65.35 67.55L101.47 79.55C103.112 80.0974 104.888 80.0974 106.53 79.55L142.65 67.55C148.728 75.7899 152.005 85.761 152 96ZM104 63.57L33.3 40L104 16.43L174.7 40L104 63.57Z" fill="white"/>
                            </svg>
                            <div class="flex flex-row items-center">
                                <h1 class="text-9xl">76</h1>
                                {{-- <p>Learners</p> --}}
                            </div>
                        </div>

                        <div>
                            <h3>Enrolled: <span>3</span></h3>
                            <h3>Completers: <span>5</span></h3>
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

                <table class="w-full text-base table-fixed">
                    <thead class="text-xs">
                        <th>Course Name</th>
                        <th>Status</th>
                        <th>Course Code</th>
                        <th>Total Enrolled</th>
                        <th>Total Completees</th>
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
                            <td class="flex justify-center">
                                <svg class="w-4 h-4" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M28 14C28 21.732 21.732 28 14 28C6.268 28 0 21.732 0 14C0 6.268 6.268 0 14 0C21.732 0 28 6.268 28 14Z" fill="#00D26A"/>
                                </svg>
                            </td>
                            <td>000000</td>
                            <td>43</td>
                            <td>35/43</td>
                        </tr>
                        <tr>
                            <td>
                                <img src="" alt="">
                                <div>
                                    <h1>Course1</h1>
                                    <h3 class="hidden text-xs opacity-50">10 lessons</h3>
                                </div>
                            </td>
                            <td class="flex justify-center">
                                <svg class="w-4 h-4" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M28 14C28 21.732 21.732 28 14 28C6.268 28 0 21.732 0 14C0 6.268 6.268 0 14 0C21.732 0 28 6.268 28 14Z" fill="#00D26A"/>
                                </svg>
                            </td>
                            <td>000000</td>
                            <td>43</td>
                            <td>35/43</td>
                        </tr>
                        <tr>
                            <td>
                                <img src="" alt="">
                                <div>
                                    <h1>Course1</h1>
                                    <h3 class="hidden text-xs opacity-50">10 lessons</h3>
                                </div>
                            </td>
                            <td class="flex justify-center">
                                <svg class="w-4 h-4" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M28 14C28 21.732 21.732 28 14 28C6.268 28 0 21.732 0 14C0 6.268 6.268 0 14 0C21.732 0 28 6.268 28 14Z" fill="#00D26A"/>
                                </svg>
                            </td>
                            <td>000000</td>
                            <td>43</td>
                            <td>35/43</td>
                        </tr>
                        <tr>
                            <td>
                                <img src="" alt="">
                                <div>
                                    <h1>Course1</h1>
                                    <h3 class="hidden text-xs opacity-50">10 lessons</h3>
                                </div>
                            </td>
                            <td class="flex justify-center">
                                <svg class="w-4 h-4" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M28 14C28 21.732 21.732 28 14 28C6.268 28 0 21.732 0 14C0 6.268 6.268 0 14 0C21.732 0 28 6.268 28 14Z" fill="#00D26A"/>
                                </svg>
                            </td>
                            <td>000000</td>
                            <td>43</td>
                            <td>35/43</td>
                        </tr>
                        
                    </tbody>
                </table>
            </div>
            {{-- MY COURSES END --}}
        </section>
        {{-- MAIN END --}}
        
        <section class="fixed top-0 z-50 hidden w-full h-full bg-white bg-opacity-50" id="profile">
            <button class="absolute z-50 top-4 right-4" id="prof-btn">
                <img src="{{url('/assets/close-icon.svg')}}" alt="">
            </button>

            <div class="float-right h-full p-4 bg-white w-60 pt-14">
                <div class="">
                    <h1 class="text-2xl font-semibold">Profile</h1>

                    <div class="grid place-items-center">
                        <img class="w-10 h-10 my-4 bg-green-500 rounded-full" src="" alt="">
                        <h1 class="text-lg font-medium">{{ $instructor_fname }} {{ $instructor_lname }}</h1>
                        <h3 class="text-sm opacity-50">Instructor ID: {{ $instructor_id }}</h3>
                    </div>

                    <div class="grid grid-flow-col">
                        <a href="">Edit Profile</a>
                        <a href="">view activity logs</a>
                    </div>
                </div>
            </div>
        </section>
    </section>



    
    

@include('partials.footer')