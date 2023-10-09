@include('partials.header')

    <section class="relative w-full h-auto text-sm bg-mainwhitebg">
        <header class="fixed top-0 left-0 z-40 flex flex-row items-center w-full px-4 py-4 bg-seagreen">
            <a href="#">
                <span class="self-center text-lg font-semibold font-semibbold whitespace-nowrap md:text-2xl text-mainwhitebg">
                    Eskwela4EveryJuan
                </span>
            </a>
        </header>        

        {{-- MAIN --}}
        <div class="w-full h-screen pt-16 md:h-auto lg:h-screen lg:overflow-hidden text-darthmouthgreen md:bg-seagreen lg:w-1/2 lg:text-mainwhitebg lg:pt-24">
            <div class="rounded-lg md:shadow-xl md:w-3/4 md:mx-auto md:bg-mainwhitebg lg:bg-opacity-0 lg:shadow-transparent ">
                <div class="px-4 pt-4 md:mx-auto md:w-3/4 md:pt-8 lg:w-full lg:pt-0" id="ins-head">
                    <h1 class="my-2 text-3xl font-bold md:text-4xl">Create an Instructor account</h1>
                    <p class="text-sm md:text-base">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Aperiam quidem nobis quasi porro odio! Iusto, aliquam.</p>
                </div>

                <form class="h-auto pb-4 mx-4 mt-10 text-sm text-black md:mt-4 md:w-3/4 md:mx-auto lg:w-full lg:text-mainwhitebg" action="">
                    @csrf
                    <div class="pb-4 mx-4 text-sm border-b-4 md:text-base" id="first-form">
                        <div class="flex flex-col lg:flex-row lg:justify-between lg:flex-wrap">
                            <div class="FORM-CTNR">
                                <label for="fname">Firstname:</label>
                                <input class="IN-V-INP md:h-10 lg:h-12 lg:w-72" type="text" name="fname" id="">
                            </div>
                            <div class="FORM-CTNR">
                                <label for="lname">Lastname:</label>
                                <input class="IN-V-INP md:h-10 lg:h-12 lg:w-72" type="text" name="lname" id="">
                            </div>
                        </div>
                        
                        <div class="flex flex-col lg:flex-row lg:justify-between lg:flex-wrap">
                            <div class="FORM-CTNR">
                                <label for="birthday">Birthday:</label>
                                <input class="IN-V-INP md:h-10 lg:h-12 lg:w-72" type="date" name="birthday" id="">
                            </div>
                            
                            <div class="FORM-CTNR">
                                <label for="gender">Gender</label>
                                <select class="IN-V-INP md:h-10 lg:h-12 lg:w-72" name="" id="">
                                    <option value="" disabled selected>-- select an option --</option>
                                    <option value="">Male</option>
                                    <option value="">Female</option>
                                </select>
                            </div>
                        </div>

                        <div class="FORM-CTNR">
                            <label for="email">Email:</label>
                            <input class="IN-V-INP md:h-10 lg:h-12" type="email" name="email" id="">
                        </div>
                        <div class="FORM-CTNR">
                            <label for="contact_number">Contact Number:</label>
                            <input class="IN-V-INP md:h-10 lg:h-12" type="text" name="contact_number" id="">
                        </div>
                        <div class="FORM-CTNR">
                            <label for="username">Username:</label>
                            <input class="IN-V-INP md:h-10 lg:h-12" type="text" name="" id="">
                        </div>
                        <div class="FORM-CTNR">
                            <label for="password">Password:</label>
                            <input class="IN-V-INP md:h-10 lg:h-12" type="password" name="password" id="">
                        </div>
                        <div class="FORM-CTNR">
                            <label for="password_confirmation">Confirm Password:</label>
                            <input class="IN-V-INP md:h-10 lg:h-12" type="password" name="password_confirmation" id="">
                        </div>
                        
                        <div class="grid h-auto my-10 text-black place-items-end lg:my-4" >
                            <button class="flex flex-row items-center justify-center w-24 h-10 rounded-lg bg-amber-400 hover:bg-amber-500" type="submit" id="nxtBtn">
                                <h1>Next</h1>
                                <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="M647-440H160v-80h487L423-744l57-56 320 320-320 320-57-56 224-224Z"/></svg>
                            </button>
                        </div>
                    </div>
                    
                    <div class="hidden h-full overflow-hidden" id="resumeForm">
                        <div>
                            <button class="flex items-center w-24 h-8 rounded " id="bckBtn">
                                <svg class="pr-2 lg:w-8 lg:h-8" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="m313-440 224 224-57 56-320-320 320-320 57 56-224 224h487v80H313Z"/></svg>
                            </button>
                        </div>
                        
                        <div class="px-4 mt-4">
                            <h1 class="text-3xl font-bold text-darthmouthgreen lg:text-mainwhitebg lg:text-4xl">About Credentials</h1>
                            <p class="text-sm lg:text-base">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Aperiam quidem nobis quasi porro odio! Iusto, aliquam.</p>
                        </div>

                        <div class="pb-4 my-8 font-semibold border-b-2 lg:text-base" action="">
                            <label for="">CV or Resume</label>
                            <input class="font-normal " type="file" name="" id="">
                        </div>

                        <div class="text-sm lg:text-base">
                            <div class="flex flex-row">
                                <input class="mx-2" type="checkbox" name="" id="">
                                <p>I've read and accept <span class="font-medium text-darthmouthgreen lg:text-amber-400"><a href="">Terms & Condition</a></span></p>
                            </div>

                            <div class="flex flex-row">
                                <input class="mx-2" type="checkbox" name="" id="">
                                <p>Remember me</p>
                            </div>

                            <div class="flex items-center justify-end mt-4 text-black">
                                <button class="h-10 px-2 mx-2 font-medium rounded bg-amber-400 hover:bg-amber-500">Create my account</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>


            <div class="flex flex-row items-center justify-center text-center md:h-14 lg:h-auto " id="ins-foot ">
                <h1 class="text-black md:text-mainwhitebg">Already have an account?
                    <a class="font-semibold text-darthmouthgreen md:text-mainwhitebg" href="/instructor/login">Log in</a>
                </h1>
            </div>
        </div>
    </section>

@include('partials.footer')