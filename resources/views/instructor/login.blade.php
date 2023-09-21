@include('partials.header')

    <section class="relative flex w-full h-screen">
        
        <header class="fixed top-0 left-0 z-40 flex flex-row items-center w-full px-4 py-4 bg-seagreen">
            <a href="#">
                <span class="self-center text-lg font-semibold font-semibbold whitespace-nowrap md:text-2xl text-mainwhitebg">
                    Eskwela4EveryJuan
                </span>
            </a>
        </header>
        
        {{-- MAIN --}}
        <div class="w-full h-screen bg-mainwhitebg text-darthmouthgreen" id="loginForm">
            <div class="px-4 pt-4 mt-16">
                <h1 class="my-2 text-3xl font-bold">Instructor Login</h1>
                <p class="text-sm">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Aperiam quidem nobis quasi porro odio! Iusto, aliquam.</p>
            </div>

            <form class="mt-10 text-black" action="">
                @csrf
                <div class="pb-4 mx-4 text-sm border-b-4">
                    <div class="flex flex-col my-4">
                        <label class="text-base font-medium" for="">Email:</label>
                        <div class="relative">
                            <svg class="absolute w-8 h-8 mx-1 border-r-2" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="M160-160q-33 0-56.5-23.5T80-240v-480q0-33 23.5-56.5T160-800h640q33 0 56.5 23.5T880-720v480q0 33-23.5 56.5T800-160H160Zm320-280L160-640v400h640v-400L480-440Zm0-80 320-200H160l320 200ZM160-640v-80 480-400Z"/></svg>
                            <input class="w-full h-8 pl-10 text-black rounded" type="email" name="" id="">
                        </div>
                        
                    </div>
                    
                    <div class="flex flex-col my-4">
                        <label class="text-base font-medium" for="password">Password:</label>
                        <div class="relative">
                            <svg class="absolute w-8 h-8 mx-1 border-r-2" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="M240-80q-33 0-56.5-23.5T160-160v-400q0-33 23.5-56.5T240-640h40v-80q0-83 58.5-141.5T480-920q83 0 141.5 58.5T680-720v80h40q33 0 56.5 23.5T800-560v400q0 33-23.5 56.5T720-80H240Zm0-80h480v-400H240v400Zm240-120q33 0 56.5-23.5T560-360q0-33-23.5-56.5T480-440q-33 0-56.5 23.5T400-360q0 33 23.5 56.5T480-280ZM360-640h240v-80q0-50-35-85t-85-35q-50 0-85 35t-35 85v80ZM240-160v-400 400Z"/></svg>
                            <svg class="absolute right-0 w-6 h-6 mx-1 top-1" id="showPwd" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="M480-320q75 0 127.5-52.5T660-500q0-75-52.5-127.5T480-680q-75 0-127.5 52.5T300-500q0 75 52.5 127.5T480-320Zm0-72q-45 0-76.5-31.5T372-500q0-45 31.5-76.5T480-608q45 0 76.5 31.5T588-500q0 45-31.5 76.5T480-392Zm0 192q-146 0-266-81.5T40-500q54-137 174-218.5T480-800q146 0 266 81.5T920-500q-54 137-174 218.5T480-200Zm0-300Zm0 220q113 0 207.5-59.5T832-500q-50-101-144.5-160.5T480-720q-113 0-207.5 59.5T128-500q50 101 144.5 160.5T480-280Z"/></svg>
                            <svg class="absolute right-0 hidden w-6 h-6 mx-1 top-1" id="hidePwd" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="m644-428-58-58q9-47-27-88t-93-32l-58-58q17-8 34.5-12t37.5-4q75 0 127.5 52.5T660-500q0 20-4 37.5T644-428Zm128 126-58-56q38-29 67.5-63.5T832-500q-50-101-143.5-160.5T480-720q-29 0-57 4t-55 12l-62-62q41-17 84-25.5t90-8.5q151 0 269 83.5T920-500q-23 59-60.5 109.5T772-302Zm20 246L624-222q-35 11-70.5 16.5T480-200q-151 0-269-83.5T40-500q21-53 53-98.5t73-81.5L56-792l56-56 736 736-56 56ZM222-624q-29 26-53 57t-41 67q50 101 143.5 160.5T480-280q20 0 39-2.5t39-5.5l-36-38q-11 3-21 4.5t-21 1.5q-75 0-127.5-52.5T300-500q0-11 1.5-21t4.5-21l-84-82Zm319 93Zm-151 75Z"/></svg>
                            
                            <input class="w-full h-8 pl-10 text-black rounded" type="password" name="password" id="password">
                        </div>
                    </div>
                    
                    <a class="grid place-items-end" href="">
                        Forgot Password?
                    </a>
                </div>
                
                <div class="flex items-center justify-between px-4 my-4">
                    <div class="flex items-center">
                        <input class="w-4 h-4 mx-1 accent-darthmouthgreen" type="checkbox" name="" id="">
                        <label for="">Remember me</label>
                    </div>
                    
                    <button class="w-20 h-8 font-semibold text-black rounded bg-amber-400 hover:bg-amber-500" type="submit" id="loginBtn">
                        Log in
                    </button>
                </div>
            </form>
            
            <div class="mx-auto my-10 w-max">
                <p class="text-black">Don't have an account yet?
                    <span class="font-semibold text-darthmouthgreen">
                        <a href="/instructor/register1">
                            Sign up
                        </a>
                    </span>
                </p>
            </div>
        </div>
        
        {{-- SECURITY CODE --}}

        <div class="hidden w-full p-2 mt-16 bg-mainwhitebg text-darthmouthgreen" id="securityForm">
            <div class="relative h-8 text-xl font-semibold tracking-wide text-center">
                <svg class="absolute cursor-pointer" id="backBtn" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="m313-440 224 224-57 56-320-320 320-320 57 56-224 224h487v80H313Z"/></svg>
                <h1>Security Code</h1>
            </div>

            <div class="flex flex-col items-center justify-center text-lg font-medium">
                <img class="w-40 h-36" src="{{url('assets/security-icon.png')}}" alt="">
                <h1 class="text-black">Enter Security Code</h1>
            </div>

            <div class="flex flex-col items-center">
                <div class="my-6">
                    <input class="mx-1 h-16 text-center shadow outline-none focus:ring-black focus:ring-[1px]" type="text" name="" id="" maxlength="1" size="1" min="0" max="9" pattern="{0-9}{1}">
                    <input class="h-16 mx-1 text-center shadow outline-none focus:ring-black focus:ring-[1px]" type="text" name="" id="" maxlength="1" size="1" min="0" max="9" pattern="{0-9}{1}">
                    <input class="h-16 mx-1 text-center shadow outline-none focus:ring-black focus:ring-[1px]" type="text" name="" id="" maxlength="1" size="1" min="0" max="9" pattern="{0-9}{1}">
                    <input class="h-16 mx-1 text-center shadow outline-none focus:ring-black focus:ring-[1px]" type="text" name="" id="" maxlength="1" size="1" min="0" max="9" pattern="{0-9}{1}">
                </div>
                <button class="w-64 h-12 my-4 font-medium tracking-wide text-white rounded bg-seagreen hover:bg-darthmouthgreen focus:bg-darthmouthgreen">Verify</button>
            </div>

            <div class="text-center text-black">
                <h1>We just sent you a verification code</>
                <p class="font-semibold text-darthmouthgreen">Resend Code?</p>
            </div>
        </div>
    </section>

@include('partials.footer')