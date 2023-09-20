@include('partials.header')

    <section class="relative w-full h-auto bg-gradient-to-bl from-seagreen to-darthmouthgreen">
        <header class="fixed top-0 left-0 z-40 flex flex-row items-center w-full px-4 py-4 bg-seagreen">
            <a href="#">
                <span class="self-center text-lg font-semibold font-semibbold whitespace-nowrap md:text-2xl text-mainwhitebg">
                    Eskwela4EveryJuan
                </span>
            </a>
        </header>        

        {{-- MAIN --}}
        <div class="w-full pt-16 text-mainwhitebg">
            <div class="px-4 pt-4 ">
                <h1 class="my-2 text-3xl font-bold">Create an Instructor account</h1>
                <p class="text-sm">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Aperiam quidem nobis quasi porro odio! Iusto, aliquam.</p>
            </div>

            <form class="pb-4 mx-4 mt-10 text-sm" action="">
                @csrf
                <div class="">
                    <div class="flex flex-col">
                        <div class="flex flex-col my-2">
                            <label class="text-base font-medium" for="">Firstname:</label>
                            <input class="w-full h-8 pl-10 text-black rounded" type="text" name="" id="">
                        </div>
                        <div class="flex flex-col my-2">
                            <label class="text-base font-medium" for="">Lastname:</label>
                            <input class="w-full h-8 pl-10 text-black rounded" type="text" name="" id="">
                        </div>
                    </div>
                    
                    <div>
                        <div class="flex flex-col my-2">
                            <label class="text-base font-medium" for="">Birthday:</label>
                            <input class="w-full h-8 pl-10 text-black rounded" type="date" name="" id="">
                        </div>
                        
                        <div class="flex flex-col my-2">
                            <label class="text-base font-medium" for="gender">Gender</label>
                            <select class="w-full h-8 pl-10 text-black rounded" name="" id="">
                                <option value="" disabled selected>-- select an option --</option>
                                <option value="">Male</option>
                                <option value="">Female</option>
                            </select>
                        </div>
                    </div>

                    <div class="flex flex-col my-2">
                        <label class="text-base font-medium" for="">Email:</label>
                        <input class="w-full h-8 pl-10 text-black rounded" type="email" name="" id="">
                    </div>
                    <div class="flex flex-col my-2">
                        <label class="text-base font-medium" for="">Contact Number:</label>
                        <div>
                            {{-- <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="M798-120q-125 0-247-54.5T329-329Q229-429 174.5-551T120-798q0-18 12-30t30-12h162q14 0 25 9.5t13 22.5l26 140q2 16-1 27t-11 19l-97 98q20 37 47.5 71.5T387-386q31 31 65 57.5t72 48.5l94-94q9-9 23.5-13.5T670-390l138 28q14 4 23 14.5t9 23.5v162q0 18-12 30t-30 12ZM241-600l66-66-17-94h-89q5 41 14 81t26 79Zm358 358q39 17 79.5 27t81.5 13v-88l-94-19-67 67ZM241-600Zm358 358Z"/></svg> --}}
                            <input class="w-full h-8 pl-10 text-black rounded" type="email" name="" id="">
                        </div>
                    </div>
                    <div class="flex flex-col my-2">
                        <label class="text-base font-medium" for="">Username:</label>
                        <input class="w-full h-8 pl-10 text-black rounded" type="email" name="" id="">
                    </div>
                    <div class="flex flex-col my-2">
                        <label class="text-base font-medium" for="">Password:</label>
                        <input class="w-full h-8 pl-10 text-black rounded" type="email" name="" id="">
                    </div>
                    <div class="flex flex-col my-2">
                        <label class="text-base font-medium" for="">Confirm Password:</label>
                        <input class="w-full h-8 pl-10 text-black rounded" type="email" name="" id="">
                    </div>
                    
                    <div class="grid h-auto my-10 text-black place-items-end">
                        <button class="flex flex-row items-center justify-center w-24 h-10 rounded-lg bg-amber-400 hover:bg-amber-500">
                            <h1>Next</h1>
                            <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="M647-440H160v-80h487L423-744l57-56 320 320-320 320-57-56 224-224Z"/></svg>
                        </button>
                    </div>
                </div>
                
                <div class="hidden overflow-y-hidden">
                    <div class="px-4 pt-4">
                        <h1 class="my-2 text-3xl font-bold">About Credentials</h1>
                        <p class="text-sm">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Aperiam quidem nobis quasi porro odio! Iusto, aliquam.</p>
                    </div>

                    <div class="pb-4 my-8 border-b-2" action="">
                        <label for="">CV or Resume</label>
                        <input type="file" name="" id="">
                    </div>

                    <div>
                        <div class="flex flex-row">
                            <input class="mx-2" type="checkbox" name="" id="">
                            <p>I've read and accept <span>Terms & Condistion</span></p>
                        </div>

                        <div class="flex flex-row">
                            <input class="mx-2" type="checkbox" name="" id="">
                            <p>Remember me</p>
                        </div>

                        <div class="flex items-center justify-end mt-4 text-black">
                            <button class="flex items-center justify-center w-24 h-8 mx-2 rounded bg-mainwhitebg">
                                <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="m313-440 224 224-57 56-320-320 320-320 57 56-224 224h487v80H313Z"/></svg>
                                <h1>Back</h1>
                            </button>

                            <button class="w-auto h-8 px-2 mx-2 font-medium rounded bg-amber-400">Create my account</button>
                        </div>
                    </div>
                </div>
                
            </form>
        </div>
    </section>

@include('partials.footer')