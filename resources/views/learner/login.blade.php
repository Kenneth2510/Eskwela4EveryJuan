@include('partials.header')

    <section class="flex flex-row w-full h-screen text-sm ">
        
        <header class="fixed top-0 left-0 z-40 flex flex-row items-center w-full px-4 py-4 bg-transparent">
            <a href="#">
                <span class="self-center font-semibold font-semibbold whitespace-nowrap md:text-2xl text-mainwhitebg">
                    Eskwela4EveryJuan
                </span>
            </a>
        </header>
        
        {{-- MAIN --}}
        <div class="relative w-full h-screen bg-mainwhitebg text-darthmouthgreen md:flex md:justify-center md:items-center md:bg-seagreen lg:w-1/2 lg:text-mainwhitebg lg:pt-24" id="loginForm">
            <div class="rounded-lg md:shadow-xl md:w-3/4 md:mx-auto md:bg-mainwhitebg lg:bg-opacity-0 lg:shadow-transparent">
                <div class="px-4 pt-4 mt-16 md:mx-auto md:w-3/4 md:pt-8 lg:w-full lg:p-0 lg:m-0">
                    <h1 class="my-2 text-3xl font-bold md:text-4xl">learner Login</h1>
                    <p class="text-sm md:text-base">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Aperiam quidem nobis quasi porro odio! Iusto, aliquam.</p>
                </div>



                <form class="flex flex-col justify-center text-black rounded-lg md:mt-4 h-96 md:w-3/4 md:mx-auto lg:w-full lg:text-mainwhitebg" action="{{ url('/learner/login') }}" method="POST">
                    @csrf
                    <div class="pb-4 mx-4 text-sm border-b-4 md:text-base">
                        @error('learner_username')
                            <p class="p-1 mt-2 text-xs text-red-500">
                                {{$message}}
                            </p>
                        @enderror
                        <div class="flex flex-col my-4 lg:flex-row lg:justify-between lg:items-center" id="EorU">
                            <label class="font-medium lg:w-1/2" for="learner_username">Email or Username:</label>
                            <div class="relative lg:w-1/2">
                                <svg class="absolute w-8 h-8 mx-1 border-r-2 md:w-10 md:h-10 lg:my-1" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="M160-160q-33 0-56.5-23.5T80-240v-480q0-33 23.5-56.5T160-800h640q33 0 56.5 23.5T880-720v480q0 33-23.5 56.5T800-160H160Zm320-280L160-640v400h640v-400L480-440Zm0-80 320-200H160l320 200ZM160-640v-80 480-400Z"/></svg>
                                <input class="w-full h-8 pl-10 text-black rounded md:h-10 lg:h-12 md:pl-12" type="text" name="learner_username" id="learner_username" placeholder="Email or username" required>
                            </div>
                        </div>
                        
                        <div class="flex flex-col my-4 lg:flex-row lg:justify-between lg:items-center">
                            <label class="font-medium lg:w-1/2" for="password">Password:</label>
                            <div class="relative lg:w-1/2">
                                <svg class="absolute w-8 h-8 mx-1 border-r-2 md:w-10 md:h-10 lg:my-1" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="M240-80q-33 0-56.5-23.5T160-160v-400q0-33 23.5-56.5T240-640h40v-80q0-83 58.5-141.5T480-920q83 0 141.5 58.5T680-720v80h40q33 0 56.5 23.5T800-560v400q0 33-23.5 56.5T720-80H240Zm0-80h480v-400H240v400Zm240-120q33 0 56.5-23.5T560-360q0-33-23.5-56.5T480-440q-33 0-56.5 23.5T400-360q0 33 23.5 56.5T480-280ZM360-640h240v-80q0-50-35-85t-85-35q-50 0-85 35t-35 85v80ZM240-160v-400 400Z"/></svg>
                                <svg class="absolute right-0 w-6 h-6 mx-1 top-1 lg:w-8 lg:h-8" id="showPwd" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="M480-320q75 0 127.5-52.5T660-500q0-75-52.5-127.5T480-680q-75 0-127.5 52.5T300-500q0 75 52.5 127.5T480-320Zm0-72q-45 0-76.5-31.5T372-500q0-45 31.5-76.5T480-608q45 0 76.5 31.5T588-500q0 45-31.5 76.5T480-392Zm0 192q-146 0-266-81.5T40-500q54-137 174-218.5T480-800q146 0 266 81.5T920-500q-54 137-174 218.5T480-200Zm0-300Zm0 220q113 0 207.5-59.5T832-500q-50-101-144.5-160.5T480-720q-113 0-207.5 59.5T128-500q50 101 144.5 160.5T480-280Z"/></svg>
                                <svg class="absolute right-0 hidden w-6 h-6 mx-1 top-1 lg:my-1" id="hidePwd" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="m644-428-58-58q9-47-27-88t-93-32l-58-58q17-8 34.5-12t37.5-4q75 0 127.5 52.5T660-500q0 20-4 37.5T644-428Zm128 126-58-56q38-29 67.5-63.5T832-500q-50-101-143.5-160.5T480-720q-29 0-57 4t-55 12l-62-62q41-17 84-25.5t90-8.5q151 0 269 83.5T920-500q-23 59-60.5 109.5T772-302Zm20 246L624-222q-35 11-70.5 16.5T480-200q-151 0-269-83.5T40-500q21-53 53-98.5t73-81.5L56-792l56-56 736 736-56 56ZM222-624q-29 26-53 57t-41 67q50 101 143.5 160.5T480-280q20 0 39-2.5t39-5.5l-36-38q-11 3-21 4.5t-21 1.5q-75 0-127.5-52.5T300-500q0-11 1.5-21t4.5-21l-84-82Zm319 93Zm-151 75Z"/></svg>
                                
                                <input class="w-full h-8 pl-10 text-black rounded md:h-10 lg:h-12 md:pl-12" type="password" name="password" id="password" placeholder="Password">

                            </div>
                        </div>

                        <div class="w-full text-right text-darthmouthgreen lg:text-mainwhitebg md:font-medium">
                            <a href="">
                                Forgot Password?
                            </a>
                        </div>
                        
                        <div class="flex items-center justify-between px-4 my-4 md:text-base" id="button">
                            <div class="flex items-center" id="remember">
                                <input class="w-4 h-4 mx-1 accent-darthmouthgreen" type="checkbox" name="rememberMe">
                                <label for="">Remember me</label>
                            </div>
                            
                            <x-forms.primary-button color="amber" name="Log in" class="text-black" />
                            {{-- <button class="w-20 h-8 font-semibold text-black rounded bg-amber-400 hover:bg-amber-500 md:h-10 md:w-24 lg:rounded-lg" type="submit">
                                Log in
                            </button> --}}
                        </div>
                    </div>
                </form>

                <div class="mx-auto my-10 text-sm w-max md:text-base" id="register">
                    <p class="text-black md:text-mainwhitebg">Don't have an account yet?
                        <span class="font-semibold text-darthmouthgreen md:text-white">
                            <a href="{{url('/learner/register')}}">
                                Sign up
                            </a>
                        </span>
                    </p>
                </div>
            </div>
            
                

        </div>
        
        {{-- MAIN LEFT --}}
        <div class="relative hidden h-screen bg-ashgray md:w-1/2 lg:block">
            {{-- IMAGE HOLDER --}}
            <div class="relative w-full h-full overflow-hidden rounded-lg">
                {{-- img-1 --}}
                <div class=" slides" id="slide1">
                    <img src="{{asset('/images/ins-login-img1.png')}}" class="absolute block -translate-x-1/2 -translate-y-1/2 top-1/3 left-1/2" alt="image-1">
                    <div class="absolute block text-center -translate-x-1/2 top-3/4 left-1/2">
                        <h1 class="text-2xl font-bold">Maintain your Business</h1>
                        <p class="text-base">Lorem ipsum dolor sit amet consectetur. Tellus ultrices in nibh malesuada sit justo fermentum. Elit id in pulvinar eget amet.</p>
                    </div>

                </div>
                {{-- img-2 --}}
                <div class="hidden slides" id="slide2">
                    <img src="{{asset('/images/ins-login-img2.png')}}" class="absolute block -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="image-2">
                    <div class="absolute block text-center -translate-x-1/2 top-3/4 left-1/2">
                        <h1 class="text-2xl font-bold">Maintain your Business</h1>
                        <p class="text-base">Lorem ipsum dolor sit amet consectetur. Tellus ultrices in nibh malesuada sit justo fermentum. Elit id in pulvinar eget amet.</p>
                    </div>
                </div>
                {{-- img-3 --}}
                <div class="hidden slides" id="slide3">
                    <img src="{{asset('/images/ins-login-img3.png')}}" class="absolute block -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="image-3">
                    <div class="absolute block text-center -translate-x-1/2 top-3/4 left-1/2">
                        <h1 class="text-2xl font-bold">Maintain your Business</h1>
                        <p class="text-base">Lorem ipsum dolor sit amet consectetur. Tellus ultrices in nibh malesuada sit justo fermentum. Elit id in pulvinar eget amet.</p>
                    </div>
                </div>
            </div>

            {{-- BOTTOM BUTTONS --}}
            <div class="absolute z-30 flex space-x-3 -translate-x-1/2 bottom-5 left-1/2" id="carouselBtn">
                <button type="button" class="w-2 h-2 rounded-full bg-slate-200" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" class="w-2 h-2 rounded-full bg-slate-200" aria-current="true" aria-label="Slide 2"></button>
                <button type="button" class="w-2 h-2 rounded-full bg-slate-200" aria-current="true" aria-label="Slide 3"></button>
            </div>
            
            <button type="button" class="absolute top-0 left-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" id="l-prevBtn">
                <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                    <svg class="w-4 h-4 text-white dark:text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 1 1 5l4 4"/>
                    </svg>
                    <span class="sr-only">Previous</span>
                </span>
            </button>

            <button type="button" class="absolute top-0 right-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" id="l-nextBtn">
                <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                    <svg class="w-4 h-4 text-white dark:text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                    </svg>
                    <span class="sr-only">Next</span>
                </span>
            </button>
        </div>
        
    </section>

@include('partials.footer')