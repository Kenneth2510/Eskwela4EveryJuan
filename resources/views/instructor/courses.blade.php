@include('partials.header')

    <header class="fixed top-0 left-0 z-40 flex flex-row items-center w-full px-4 py-4 bg-seagreen">
        <a href="#">
            <span class="self-center text-xl font-semibold font-semibbold whitespace-nowrap md:text-2xl text-mainwhitebg">
                Eskwela4EveryJuan
            </span>
        </a>
        
        <button class="absolute right-4" id="prof-open-btn">
            <svg class="w-8 h-8 fill-white" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="M234-276q51-39 114-61.5T480-360q69 0 132 22.5T726-276q35-41 54.5-93T800-480q0-133-93.5-226.5T480-800q-133 0-226.5 93.5T160-480q0 59 19.5 111t54.5 93Zm246-164q-59 0-99.5-40.5T340-580q0-59 40.5-99.5T480-720q59 0 99.5 40.5T620-580q0 59-40.5 99.5T480-440Zm0 360q-83 0-156-31.5T197-197q-54-54-85.5-127T80-480q0-83 31.5-156T197-763q54-54 127-85.5T480-880q83 0 156 31.5T763-763q54 54 85.5 127T880-480q0 83-31.5 156T763-197q-54 54-127 85.5T480-80Zm0-80q53 0 100-15.5t86-44.5q-39-29-86-44.5T480-280q-53 0-100 15.5T294-220q39 29 86 44.5T480-160Zm0-360q26 0 43-17t17-43q0-26-17-43t-43-17q-26 0-43 17t-17 43q0 26 17 43t43 17Zm0-60Zm0 360Z"/></svg>
        </button>
    </header>
    
    {{-- PROFILE SETTINGS --}}
    <section class="fixed top-0 z-50 hidden w-full h-full bg-white bg-opacity-50" id="profile">
        <div class="float-right w-64 h-screen bg-white">
            <button class="absolute right-4 top-4" id="prof-btn">
                <svg class="" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="m256-200-56-56 224-224-224-224 56-56 224 224 224-224 56 56-224 224 224 224-56 56-224-224-224 224Z"/></svg>
            </button>

            <div class="flex flex-col items-center justify-center mt-10">
                <div class="flex items-center justify-between w-64 px-4">
                    <h1 class="my-4 text-3xl font-semibold">Profile</h1>
                    <svg class="bg-gray-400 rounded" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="M80 0v-160h800V0H80Zm80-240v-150l362-362 150 150-362 362H160Zm80-80h36l284-282-38-38-282 284v36Zm477-326L567-796l72-72q11-12 28-11.5t28 11.5l94 94q11 11 11 27.5T789-718l-72 72ZM240-320Z"/></svg> 
                </div>
                
                <img class="w-16 h-16 bg-green-500 rounded-full" src="" alt="">
                <h3 class="text-lg font-medium">Person 1</h3>
                <h4 class="text-base text-gray-400">Bakery</h4>
            </div>

            <div class="mx-auto my-4 w-max">
                <form action="">
                    <button class="underline underline-offset-2">Logout</button>
                </form>
            </div>

            <div class="px-2 mt-5">
                <h1 class="text-lg font-semibold">Activity Logs</h1>

                <div class="flex flex-row items-center py-2 my-2 border-b">
                    <img class="w-10 h-10 mx-1 bg-gray-300 rounded-full" src="" alt="">
                    <div class="text-sm">
                        <h1 class="">You have added Lesson 4</h1>
                        <h2>000000 - Course 1</h2>
                        <p class="text-xs">May 10 9:00AM</p>
                    </div>
                </div>
                
                <div class="flex flex-row items-center py-2 my-2 border-b">
                    <img class="w-10 h-10 mx-1 bg-gray-300 rounded-full" src="" alt="">
                    <div class="text-sm">
                        <h1 class="">You have added Lesson 4</h1>
                        <h2>000000 - Course 1</h2>
                        <p class="text-xs">May 10 9:00AM</p>
                    </div>
                </div>
                
                <div class="flex flex-row items-center py-2 my-2 border-b">
                    <img class="w-10 h-10 mx-1 bg-gray-300 rounded-full" src="" alt="">
                    <div class="text-sm">
                        <h1 class="">You have added Lesson 4</h1>
                        <h2>000000 - Course 1</h2>
                        <p class="text-xs">May 10 9:00AM</p>
                    </div>
                </div>

                <div class="flex flex-row items-center py-2 my-2 border-b">
                    <img class="w-10 h-10 mx-1 bg-gray-300 rounded-full" src="" alt="">
                    <div class="text-sm">
                        <h1 class="">You have added Lesson 4</h1>
                        <h2>000000 - Course 1</h2>
                        <p class="text-xs">May 10 9:00AM</p>
                    </div>
                </div>

                <p class="mx-auto underline cursor-pointer underline-offset-4 w-max">View all</p>
            </div>
        </div>
    </section>
    
    {{-- SIDEBAR START --}}
    <section class="fixed z-40 w-screen text-white md:h-screen top-14">
        <div class="bg-seagreen md:w-52 md:h-screen md:pt-16">
            <ul class="flex justify-between px-2 sm:flex-row md:flex-col">
                <li class="w-full py-3 rounded-lg hover:bg-darthmouthgreen group ">
                    <a class="flex items-center justify-center md:justify-start md:px-4 " href="#">
                        <svg class="mx-2 duration-500 stroke-white group-hover:stroke-black group-hover:animate-bounce" width="25" height="25" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <g opacity="0.7">
                        <path d="M21.875 19.7917V12.7781C21.875 12.213 21.76 11.6537 21.5371 11.1344C21.3141 10.6151 20.9879 10.1465 20.5781 9.75729L13.9354 3.44792C13.5482 3.08009 13.0346 2.875 12.5005 2.875C11.9665 2.875 11.4528 3.08009 11.0656 3.44792L4.42187 9.75729C4.01214 10.1465 3.68587 10.6151 3.46292 11.1344C3.23997 11.6537 3.125 12.213 3.125 12.7781V19.7917C3.125 20.3442 3.34449 20.8741 3.73519 21.2648C4.12589 21.6555 4.6558 21.875 5.20833 21.875H19.7917C20.3442 21.875 20.8741 21.6555 21.2648 21.2648C21.6555 20.8741 21.875 20.3442 21.875 19.7917Z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </g>
                        </svg>
                        <h1 class="hidden md:block group-hover:text-black">Dashboard</h1>
                    </a>
                </li>
                
                <li class="w-full py-3 rounded-lg hover:bg-darthmouthgreen group">
                    <a class="flex items-center justify-center md:justify-start md:px-4" href="">
                        <svg class="mx-2 duration-500 fill-white group-hover:fill-black group-hover:animate-bounce" width="23" height="23" viewBox="0 0 23 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M3.84962 17.0976C3.99883 17.2474 4.11317 17.4282 4.18448 17.6273C4.25579 17.8263 4.28232 18.0386 4.26219 18.2491C4.16116 19.2231 3.96962 20.1856 3.69006 21.1241C5.69537 20.6597 6.92013 20.1221 7.47644 19.8404C7.79197 19.6806 8.15535 19.6427 8.49706 19.734C9.47662 19.9951 10.4862 20.1266 11.5 20.125C17.2442 20.125 21.5625 16.0899 21.5625 11.5C21.5625 6.9115 17.2442 2.875 11.5 2.875C5.75575 2.875 1.4375 6.9115 1.4375 11.5C1.4375 13.6102 2.32444 15.5681 3.84962 17.0976ZM3.14094 22.7111C2.80035 22.7786 2.45865 22.8404 2.116 22.8965C1.8285 22.9425 1.61 22.6435 1.72356 22.3761C1.8512 22.0751 1.96819 21.7697 2.07431 21.4604L2.07862 21.4461C2.43512 20.4111 2.7255 19.2208 2.83188 18.1125C1.06806 16.3444 0 14.03 0 11.5C0 5.94262 5.14912 1.4375 11.5 1.4375C17.8509 1.4375 23 5.94262 23 11.5C23 17.0574 17.8509 21.5625 11.5 21.5625C10.361 21.564 9.22672 21.4161 8.12619 21.1226C7.37869 21.5007 5.77012 22.1892 3.14094 22.7111Z" fill-opacity="0.75"/>
                        </svg>
                        <h1 class="hidden md:block group-hover:text-black">Chats</h1>
                    </a>
                </li>
                
                <li class="w-full py-3 rounded-lg hover:bg-darthmouthgreen group">
                    <a class="flex items-center justify-center md:justify-start md:px-4" href="">
                        
                        <svg class="mx-2 duration-500 fill-white group-hover:fill-black group-hover:animate-bounce" width="27" height="27" viewBox="0 0 27 27" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M21.375 6.75H18V5.625C18 5.02826 17.7629 4.45597 17.341 4.03401C16.919 3.61205 16.3467 3.375 15.75 3.375H11.25C10.6533 3.375 10.081 3.61205 9.65901 4.03401C9.23705 4.45597 9 5.02826 9 5.625V6.75H5.625C4.72989 6.75 3.87145 7.10558 3.23851 7.73851C2.60558 8.37145 2.25 9.22989 2.25 10.125V20.25C2.25 21.1451 2.60558 22.0036 3.23851 22.6365C3.87145 23.2694 4.72989 23.625 5.625 23.625H21.375C22.2701 23.625 23.1285 23.2694 23.7615 22.6365C24.3944 22.0036 24.75 21.1451 24.75 20.25V10.125C24.75 9.22989 24.3944 8.37145 23.7615 7.73851C23.1285 7.10558 22.2701 6.75 21.375 6.75ZM11.25 5.625H15.75V6.75H11.25V5.625ZM22.5 20.25C22.5 20.5484 22.3815 20.8345 22.1705 21.0455C21.9595 21.2565 21.6734 21.375 21.375 21.375H5.625C5.32663 21.375 5.04048 21.2565 4.82951 21.0455C4.61853 20.8345 4.5 20.5484 4.5 20.25V13.9388L9.765 15.75C9.88445 15.7662 10.0055 15.7662 10.125 15.75H16.875C16.997 15.7477 17.1181 15.7288 17.235 15.6937L22.5 13.9388V20.25ZM22.5 11.565L16.695 13.5H10.305L4.5 11.565V10.125C4.5 9.82663 4.61853 9.54048 4.82951 9.32951C5.04048 9.11853 5.32663 9 5.625 9H21.375C21.6734 9 21.9595 9.11853 22.1705 9.32951C22.3815 9.54048 22.5 9.82663 22.5 10.125V11.565Z" fill-opacity="0.7"/>
                        </svg>

                        <h1 class="hidden md:block group-hover:text-black">Courses</h1>
                    </a>
                </li>

                <li class="w-full py-3 rounded-lg hover:bg-darthmouthgreen group">
                    <a class="flex items-center justify-center md:justify-start md:px-4" href="">
                        
                        <svg class="mx-2 duration-500 fill-white group-hover:fill-black group-hover:animate-bounce" width="25" height="25" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12.5002 6.24998C12.2239 6.24998 11.9589 6.35973 11.7636 6.55508C11.5682 6.75043 11.4585 7.01538 11.4585 7.29165V17.7083C11.4585 17.9846 11.5682 18.2495 11.7636 18.4449C11.9589 18.6402 12.2239 18.75 12.5002 18.75C12.7764 18.75 13.0414 18.6402 13.2367 18.4449C13.4321 18.2495 13.5418 17.9846 13.5418 17.7083V7.29165C13.5418 7.01538 13.4321 6.75043 13.2367 6.55508C13.0414 6.35973 12.7764 6.24998 12.5002 6.24998ZM7.29183 12.5C7.01556 12.5 6.75061 12.6097 6.55526 12.8051C6.35991 13.0004 6.25016 13.2654 6.25016 13.5416V17.7083C6.25016 17.9846 6.35991 18.2495 6.55526 18.4449C6.75061 18.6402 7.01556 18.75 7.29183 18.75C7.5681 18.75 7.83305 18.6402 8.0284 18.4449C8.22375 18.2495 8.3335 17.9846 8.3335 17.7083V13.5416C8.3335 13.2654 8.22375 13.0004 8.0284 12.8051C7.83305 12.6097 7.5681 12.5 7.29183 12.5ZM17.7085 10.4166C17.4322 10.4166 17.1673 10.5264 16.9719 10.7217C16.7766 10.9171 16.6668 11.182 16.6668 11.4583V17.7083C16.6668 17.9846 16.7766 18.2495 16.9719 18.4449C17.1673 18.6402 17.4322 18.75 17.7085 18.75C17.9848 18.75 18.2497 18.6402 18.4451 18.4449C18.6404 18.2495 18.7502 17.9846 18.7502 17.7083V11.4583C18.7502 11.182 18.6404 10.9171 18.4451 10.7217C18.2497 10.5264 17.9848 10.4166 17.7085 10.4166ZM19.7918 2.08331H5.2085C4.37969 2.08331 3.58484 2.41255 2.99879 2.9986C2.41274 3.58466 2.0835 4.37951 2.0835 5.20831V19.7916C2.0835 20.6204 2.41274 21.4153 2.99879 22.0014C3.58484 22.5874 4.37969 22.9166 5.2085 22.9166H19.7918C20.6206 22.9166 21.4155 22.5874 22.0015 22.0014C22.5876 21.4153 22.9168 20.6204 22.9168 19.7916V5.20831C22.9168 4.37951 22.5876 3.58466 22.0015 2.9986C21.4155 2.41255 20.6206 2.08331 19.7918 2.08331ZM20.8335 19.7916C20.8335 20.0679 20.7238 20.3329 20.5284 20.5282C20.3331 20.7236 20.0681 20.8333 19.7918 20.8333H5.2085C4.93223 20.8333 4.66728 20.7236 4.47193 20.5282C4.27658 20.3329 4.16683 20.0679 4.16683 19.7916V5.20831C4.16683 4.93205 4.27658 4.66709 4.47193 4.47174C4.66728 4.27639 4.93223 4.16665 5.2085 4.16665H19.7918C20.0681 4.16665 20.3331 4.27639 20.5284 4.47174C20.7238 4.66709 20.8335 4.93205 20.8335 5.20831V19.7916Z" fill-opacity="0.75"/>
                        </svg>

                        <h1 class="hidden md:block group-hover:text-black">Performance</h1>
                    </a>
                </li>

                <li class="w-full py-3 rounded-lg hover:bg-darthmouthgreen group">
                    <a class="flex items-center justify-center md:justify-start md:px-4" href="">
                        
                        <svg class="mx-2 duration-500 stroke-white group-hover:stroke-black group-hover:animate-bounce" width="25" height="25" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M2.0835 12.5C2.0835 8.5719 2.0835 6.60731 3.30433 5.38752C4.52412 4.16669 6.4887 4.16669 10.4168 4.16669H14.5835C18.5116 4.16669 20.4762 4.16669 21.696 5.38752C22.9168 6.60731 22.9168 8.5719 22.9168 12.5V14.5834C22.9168 18.5115 22.9168 20.4761 21.696 21.6959C20.4762 22.9167 18.5116 22.9167 14.5835 22.9167H10.4168C6.4887 22.9167 4.52412 22.9167 3.30433 21.6959C2.0835 20.4761 2.0835 18.5115 2.0835 14.5834V12.5Z"  stroke-opacity="0.75" stroke-width="2"/>
                        <path d="M7.29199 4.16669V2.60419M17.7087 4.16669V2.60419M2.60449 9.37502H22.3962"  stroke-opacity="0.75" stroke-width="2" stroke-linecap="round"/>
                        <path class="duration-500 fill-white stroke-white group-hover:fill-black group-hover:stroke-black" d="M18.75 17.7083C18.75 17.9846 18.6403 18.2496 18.4449 18.4449C18.2496 18.6403 17.9846 18.75 17.7083 18.75C17.4321 18.75 17.1671 18.6403 16.9718 18.4449C16.7764 18.2496 16.6667 17.9846 16.6667 17.7083C16.6667 17.4321 16.7764 17.1671 16.9718 16.9718C17.1671 16.7764 17.4321 16.6667 17.7083 16.6667C17.9846 16.6667 18.2496 16.7764 18.4449 16.9718C18.6403 17.1671 18.75 17.4321 18.75 17.7083ZM18.75 13.5417C18.75 13.8179 18.6403 14.0829 18.4449 14.2782C18.2496 14.4736 17.9846 14.5833 17.7083 14.5833C17.4321 14.5833 17.1671 14.4736 16.9718 14.2782C16.7764 14.0829 16.6667 13.8179 16.6667 13.5417C16.6667 13.2654 16.7764 13.0004 16.9718 12.8051C17.1671 12.6097 17.4321 12.5 17.7083 12.5C17.9846 12.5 18.2496 12.6097 18.4449 12.8051C18.6403 13.0004 18.75 13.2654 18.75 13.5417ZM13.5417 17.7083C13.5417 17.9846 13.4319 18.2496 13.2366 18.4449C13.0412 18.6403 12.7763 18.75 12.5 18.75C12.2237 18.75 11.9588 18.6403 11.7634 18.4449C11.5681 18.2496 11.4583 17.9846 11.4583 17.7083C11.4583 17.4321 11.5681 17.1671 11.7634 16.9718C11.9588 16.7764 12.2237 16.6667 12.5 16.6667C12.7763 16.6667 13.0412 16.7764 13.2366 16.9718C13.4319 17.1671 13.5417 17.4321 13.5417 17.7083ZM13.5417 13.5417C13.5417 13.8179 13.4319 14.0829 13.2366 14.2782C13.0412 14.4736 12.7763 14.5833 12.5 14.5833C12.2237 14.5833 11.9588 14.4736 11.7634 14.2782C11.5681 14.0829 11.4583 13.8179 11.4583 13.5417C11.4583 13.2654 11.5681 13.0004 11.7634 12.8051C11.9588 12.6097 12.2237 12.5 12.5 12.5C12.7763 12.5 13.0412 12.6097 13.2366 12.8051C13.4319 13.0004 13.5417 13.2654 13.5417 13.5417ZM8.33333 17.7083C8.33333 17.9846 8.22359 18.2496 8.02824 18.4449C7.83289 18.6403 7.56793 18.75 7.29167 18.75C7.0154 18.75 6.75045 18.6403 6.5551 18.4449C6.35975 18.2496 6.25 17.9846 6.25 17.7083C6.25 17.4321 6.35975 17.1671 6.5551 16.9718C6.75045 16.7764 7.0154 16.6667 7.29167 16.6667C7.56793 16.6667 7.83289 16.7764 8.02824 16.9718C8.22359 17.1671 8.33333 17.4321 8.33333 17.7083ZM8.33333 13.5417C8.33333 13.8179 8.22359 14.0829 8.02824 14.2782C7.83289 14.4736 7.56793 14.5833 7.29167 14.5833C7.0154 14.5833 6.75045 14.4736 6.5551 14.2782C6.35975 14.0829 6.25 13.8179 6.25 13.5417C6.25 13.2654 6.35975 13.0004 6.5551 12.8051C6.75045 12.6097 7.0154 12.5 7.29167 12.5C7.56793 12.5 7.83289 12.6097 8.02824 12.8051C8.22359 13.0004 8.33333 13.2654 8.33333 13.5417Z"  fill-opacity="0.75"/>
                        </svg>

                        <h1 class="hidden md:block group-hover:text-black">Calendar</h1>
                    </a>
                </li>

                <li class="w-full py-3 rounded-lg hover:bg-darthmouthgreen group">
                    <a class="flex items-center justify-center md:justify-start md:px-4" href="">
                        
                        <svg class="mx-2 duration-500 fill-white group-hover:fill-black group-hover:animate-bounce" width="25" height="25" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M11.6656 2.69475C11.9209 2.55301 12.208 2.47864 12.5 2.47864C12.792 2.47864 13.0791 2.55301 13.3344 2.69475L20.8344 6.86142C21.3802 7.16454 21.7188 7.73954 21.7188 8.36454V16.6354C21.7188 17.2604 21.3802 17.8354 20.8344 18.1385L13.3344 22.3052C13.0791 22.4469 12.792 22.5213 12.5 22.5213C12.208 22.5213 11.9209 22.4469 11.6656 22.3052L4.16562 18.1385C3.89752 17.9896 3.67414 17.7717 3.51863 17.5074C3.36312 17.2431 3.28116 16.942 3.28125 16.6354V8.36454C3.28125 7.73954 3.61979 7.16454 4.16562 6.86142L11.6656 2.69475ZM12.576 4.06142C12.5528 4.04846 12.5266 4.04167 12.5 4.04167C12.4734 4.04167 12.4472 4.04846 12.424 4.06142L4.92396 8.22808C4.8998 8.24154 4.87965 8.26117 4.86556 8.28496C4.85147 8.30875 4.84394 8.33585 4.84375 8.3635V16.6354C4.84375 16.6927 4.875 16.7448 4.92396 16.7729L12.424 20.9395C12.4472 20.9525 12.4734 20.9593 12.5 20.9593C12.5266 20.9593 12.5528 20.9525 12.576 20.9395L20.076 16.7729C20.1005 16.7592 20.1209 16.7393 20.135 16.7151C20.1491 16.6909 20.1564 16.6634 20.1562 16.6354V8.36454C20.1562 8.33672 20.1488 8.30939 20.1347 8.28541C20.1206 8.26142 20.1004 8.24163 20.076 8.22808L12.576 4.06142Z" fill-opacity="0.75"/>
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M7.55225 12.4999C7.55225 11.1876 8.07354 9.92913 9.00146 9.00121C9.92937 8.0733 11.1879 7.552 12.5002 7.552C13.8124 7.552 15.071 8.0733 15.9989 9.00121C16.9268 9.92913 17.4481 11.1876 17.4481 12.4999C17.4481 13.8122 16.9268 15.0707 15.9989 15.9986C15.071 16.9265 13.8124 17.4478 12.5002 17.4478C11.1879 17.4478 9.92937 16.9265 9.00146 15.9986C8.07354 15.0707 7.55225 13.8122 7.55225 12.4999ZM12.5002 9.1145C11.6023 9.1145 10.7412 9.47118 10.1063 10.1061C9.47142 10.741 9.11475 11.6021 9.11475 12.4999C9.11475 13.3978 9.47142 14.2589 10.1063 14.8938C10.7412 15.5287 11.6023 15.8853 12.5002 15.8853C13.398 15.8853 14.2591 15.5287 14.894 14.8938C15.5289 14.2589 15.8856 13.3978 15.8856 12.4999C15.8856 11.6021 15.5289 10.741 14.894 10.1061C14.2591 9.47118 13.398 9.1145 12.5002 9.1145Z" fill-opacity="0.75"/>
                        </svg>

                        <h1 class="hidden md:block group-hover:text-black">Settings</h1>
                    </a>
                </li>
                
                <button class="flex-row items-center justify-center hidden h-12 mt-10 rounded-lg bg-darthmouthgreen md:flex group hover:bg-seagreen">
                        <svg class="fill-white group-hover:fill-black" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="M200-120q-33 0-56.5-23.5T120-200v-560q0-33 23.5-56.5T200-840h280v80H200v560h280v80H200Zm440-160-55-58 102-102H360v-80h327L585-622l55-58 200 200-200 200Z"/></svg>
                        <h1 class="group-hover:text-black">Logout</h1>
                    </button>
            </ul>
        </div>
    </section>
    {{-- SIDEBAR END --}}
    
    {{-- MAIN START --}}
    <section class="relative w-full h-auto px-4 mt-28">
        {{-- MAIN HEADER --}}
        <div class="flex flex-row items-center justify-between h-20">
            <h1 class="text-xl font-semibold">My Courses</h1>
            <form class="relative flex flex-row items-center" action="">
                <button class="absolute left-0" type="submit">
                    <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="M784-120 532-372q-30 24-69 38t-83 14q-109 0-184.5-75.5T120-580q0-109 75.5-184.5T380-840q109 0 184.5 75.5T640-580q0 44-14 83t-38 69l252 252-56 56ZM380-400q75 0 127.5-52.5T560-580q0-75-52.5-127.5T380-760q-75 0-127.5 52.5T200-580q0 75 52.5 127.5T380-400Z"/></svg>
                </button>
                <input class="w-40 h-10 pl-6 rounded-lg" type="search" name="search" id="search" placeholder="search">
            </form>
        </div>

        {{-- MAIN CONTENT --}}
        <div class="grid w-full grid-flow-row mx-auto border-2 rounded-lg shadow place-items-center md:grid-cols-3 lg:grid-cols-5 md:place-items-start">
            <div class="my-4 bg-teal-400 rounded-lg shadow-lg h-72 w-52">
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
            <div class="my-4 rounded-lg shadow-lg h-72 w-52 bg-cyan-400">
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
            <div class="my-4 bg-indigo-400 rounded-lg shadow-lg h-72 w-52">
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
            <div class="my-4 rounded-lg shadow-lg bg-amber-400 h-72 w-52">
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
            </div>
            

            
            <button class="flex flex-col items-center justify-center my-4 bg-white rounded-lg shadow-lg w-52 h-72" id="addNewCourse">
                <svg class="w-24 h-24" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="M440-440H200v-80h240v-240h80v240h240v80H520v240h-80v-240Z"/></svg>
                <h1 class="text-lg font-medium">add new course</h1>
            </button>
        </div>
    </section>
    {{-- MAIN END --}}
    
@include('partials.footer')