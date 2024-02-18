@include('partials.header')

    <section class="relative flex flex-row w-full h-screen text-sm bg-mainwhitebg">
        <header class="fixed top-0 left-0 z-40 flex flex-row items-center w-full px-4 py-4 bg-transparent">
            <a href="#">
                <span class="self-center font-semibold font-semibbold whitespace-nowrap md:text-2xl text-mainwhitebg">
                    Eskwela4EveryJuan
                </span>
            </a>
        </header>   

        {{-- MAIN --}}
        <div class="w-full h-screen pt-16 lg:h-screen lg:overflow-auto text-darthmouthgreen md:bg-seagreen lg:w-1/2 lg:text-mainwhitebg lg:pt-24">
            <div class="rounded-lg md:overflow-hidden md:shadow-xl md:w-3/4 md:mx-auto md:bg-mainwhitebg lg:bg-opacity-0 lg:shadow-transparent md:h-4/5 md:overflow-y-scroll lg:h-auto lg:overflow-y-hidden">
                <x-header title="Create an Instructor Account" id="ins-head">
                    <p class="text-sm md:text-base">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Aperiam quidem nobis quasi porro odio! Iusto, aliquam.</p>
                </x-header>



                {{-- <form class="pb-4 mx-4 mt-10 text-sm" action="{{ url('/instructor/register1') }}" method="POST" enctype="multipart/form-data"> --}}

                <form class="pb-4 mx-4 mt-10 text-sm" action="{{ url('/instructor/register') }}" method="POST" enctype="multipart/form-data">

                    @csrf
                    <div class="" id="first-form">
                        <div class="flex flex-col flex-nowrap lg:flex-row">
                            <div class=" FORM-CTNR lg:w-1/2 lg:mr-2">
                                <label for="instructor_fname">Firstname:</label>
                                <input class="IN-V-INP" type="text" name="instructor_fname" id="instructor_fname" value="{{old('instructor_fname')}}">
                                @error('instructor_fname')
                                <p class="p-1 mt-2 text-xs text-red-500">
                                    {{$message}}
                                </p>
                                @enderror
                            </div>
                            <div class=" FORM-CTNR lg:w-1/2 lg:ml-2">
                                <label for="instructor_lname">Lastname:</label>
                                <input class="IN-V-INP" type="text" name="instructor_lname" id="instructor_lname" value="{{old('instructor_lname')}}">
                                @error('instructor_lname')
                                <p class="p-1 mt-2 text-xs text-red-500">
                                    {{$message}}
                                </p>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="flex flex-col lg:flex-row lg:justify-between">
                            <div class="lg:mr-2 FORM-CTNR lg:w-1/2">
                                <label for="instructor_bday">Birthday:</label>
                                <input class="IN-V-INP" type="date" name="instructor_bday" id="instructor_bday" value="{{old('instructor_bday')}}">
                                @error('instructor_bday')
                                <p class="p-1 mt-2 text-xs text-red-500">
                                    {{$message}}
                                </p>
                                @enderror
                            </div>
                            
                            <div class="lg:ml-2 FORM-CTNR lg:w-1/2">
                                <label for="instructor_gender">Gender</label>
                                <select name="instructor_gender" id="gender" class="IN-V-INP">
                                    <option value="" {{old('instructor_gender') == "" ? 'selected' : ''}} class=""></option>
                                    <option value="Male" {{old('instructor_gender') == "Male" ? 'selected' : ''}} class="">Male</option>
                                    <option value="Female" {{old('instructor_gender') == "Female" ? 'selected' : ''}} class="">Female</option>
                                    <option value="Others" {{old('instructor_gender') == "Others" ? 'selected' : ''}} class="">Preferred not to say</option>
                                </select>
                                @error('instructor_gender')
                                <p class="p-1 mt-2 text-xs text-red-500">
                                    {{$message}}
                                </p>
                                @enderror
                            </div>
                        </div>

                        <div class="FORM-CTNR">
                            <label for="instructor_email">Email:</label>
                            <input class="IN-V-INP" type="email" name="instructor_email" id="instructor_email" value="{{old('instructor_email')}}">
                            @error('instructor_email')
                                <p class="p-1 mt-2 text-xs text-red-500">
                                    {{$message}}
                                </p>
                                @enderror
                        </div>
                        <div class="FORM-CTNR">
                            <label for="instructor_contactno">Contact Number:</label>
                            {{-- <input class="IN-V-INP" type="text" name="instructor_contactno" id="instructor_contactno"> --}}
                            <input type="tel" id="instructor_contactno" maxlength="11" pattern="[0-9]{11}" name="instructor_contactno" class="IN-V-INP" placeholder="09" value="{{old('instructor_contactno')}}">
                            @error('instructor_contactno')
                                <p class="p-1 mt-2 text-xs text-red-500">
                                    {{$message}}
                                </p>
                                @enderror
                        </div>
                        <div class="FORM-CTNR">
                            <label for="instructor_username">Username:</label>
                            <input class="IN-V-INP" type="text" name="instructor_username" id="instructor_username" value="{{old('instructor_username')}}">
                            @error('instructor_username')
                                <p class="p-1 mt-2 text-xs text-red-500">
                                    {{$message}}
                                </p>
                                @enderror
                        </div>
                        <div class="FORM-CTNR">
                            <label for="password">Password:</label>
                            <input class="IN-V-INP" type="password" name="password" id="">
                            @error('password')
                                <p class="p-1 mt-2 text-xs text-red-500">
                                    {{$message}}
                                </p>
                                @enderror
                        </div>
                        <div class="FORM-CTNR">
                            <label for="password_confirmation">Confirm Password:</label>
                            <input class="IN-V-INP" type="password" name="password_confirmation" id="">
                        </div>

                        

                        
                        <div class="grid h-auto my-10 text-black place-items-end" >
                            <x-forms.primary-button
                            color="amber"
                            name="Next"
                            type="button"
                            id="nxtBtn">
                            </x-forms.primary-button>
                        </div>
                    </div> 
                    
                    <div class="hidden overflow-hidden" id="resumeForm">
                        {{-- <div>
                            <button class="flex items-center w-24 h-8 rounded bg-mainwhitebg" id="bckBtn">
                                <svg class="pr-2" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="m313-440 224 224-57 56-320-320 320-320 57 56-224 224h487v80H313Z"/></svg>
                            </button>
                        </div> --}}
                        
                        <div class="px-4 mt-4">
                            <x-header title="About Credentials">
                                <p class="text-sm">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Aperiam quidem nobis quasi porro odio! Iusto, aliquam.</p>
                            </x-header>
                        </div>

                        <div class="pb-4 my-8 font-semibold border-b-2" action="">
                            <label for="instructor_credentials">CV or Resume</label>
                            <input class="font-normal " type="file" name="instructor_credentials" id="instructor_credentials" accept="application/pdf">
                            @error('instructor_credentials')
                                <p class="p-1 mt-2 text-xs text-red-500">
                                    {{$message}}
                                </p>
                                @enderror
                        </div>

                        <div class="">

                            <div class="grid h-auto my-10 text-black place-items-end" >
                                <div class="flex" >
                                    <x-forms.secondary-button
                                    name="Back"
                                    id="prevBtn">
                                    </x-forms.secondary-button>
                                    <x-forms.primary-button
                                    color="amber"
                                    name="Next"
                                    type="button"
                                    id="nxtBtn2">
                                    </x-forms.primary-button>
                                </div>
                                
                            </div>
                        </div>
                    </div>


                    <div class="hidden overflow-hidden" id="security_code">
                        {{-- <div>
                            <button class="flex items-center w-24 h-8 rounded bg-mainwhitebg" id="bckBtn">
                                <svg class="pr-2" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="m313-440 224 224-57 56-320-320 320-320 57 56-224 224h487v80H313Z"/></svg>
                            </button>
                        </div> --}}
                        
                        <div class="px-4 mt-4">
                            <x-header title="Create your Security Code">
                                <p class="text-sm">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Aperiam quidem nobis quasi porro odio! Iusto, aliquam.</p>
                            </x-header>
                        </div>

                    <div class="flex items-center pb-4 my-8 font-semibold text-black border-b-2 security-code-container">
                            <label for="instructor_security_code" class="text-xl text-white">Security Code:</label>
                            <input class="code mx-1 h-16 text-center shadow outline-none focus:ring-black focus:ring-[1px]" type="password" name="security_code_1" id="" maxlength="1" size="1" min="0" max="9" pattern="{0-9}{1}" autofocus>
                            <input class="code h-16 mx-1 text-center shadow outline-none focus:ring-black focus:ring-[1px]" type="password" name="security_code_2" id="" maxlength="1" size="1" min="0" max="9" pattern="{0-9}{1}">
                            <input class="code h-16 mx-1 text-center shadow outline-none focus:ring-black focus:ring-[1px]" type="password" name="security_code_3" id="" maxlength="1" size="1" min="0" max="9" pattern="{0-9}{1}">
                            <input class="code h-16 mx-1 text-center shadow outline-none focus:ring-black focus:ring-[1px]" type="password" name="security_code_4" id="" maxlength="1" size="1" min="0" max="9" pattern="{0-9}{1}">
                            <input class="code h-16 mx-1 text-center shadow outline-none focus:ring-black focus:ring-[1px]" type="password" name="security_code_5" id="" maxlength="1" size="1" min="0" max="9" pattern="{0-9}{1}">
                            <input class="code h-16 mx-1 text-center shadow outline-none focus:ring-black focus:ring-[1px]" type="password" name="security_code_6" id="" maxlength="1" size="1" min="0" max="9" pattern="{0-9}{1}">

                            
                            <script>
                            
                                const inputFields = document.querySelectorAll('.security-code-container .code');
                                inputFields.forEach((input, index) => {
                                    input.addEventListener('input', (event) => {
            
                                    if (event.target.value !== '' && index < inputFields.length - 1) {
                                        inputFields[index + 1].focus();
                                    }
                                });
                            });

                            </script>
                        </div>
                        @error('security_code_1')
                            <p class="p-1 mt-2 text-xs text-red-500">
                                {{$message}}
                            </p>
                            @enderror
                            @error('security_code_2')
                            <p class="p-1 mt-2 text-xs text-red-500">
                                {{$message}}
                            </p>
                            @enderror
                            @error('security_code_3')
                            <p class="p-1 mt-2 text-xs text-red-500">
                                {{$message}}
                            </p>
                            @enderror
                            @error('security_code_4')
                            <p class="p-1 mt-2 text-xs text-red-500">
                                {{$message}}
                            </p>
                            @enderror
                            @error('security_code_5')
                            <p class="p-1 mt-2 text-xs text-red-500">
                                {{$message}}
                            </p>
                            @enderror
                            @error('security_code_6')
                            <p class="p-1 mt-2 text-xs text-red-500">
                                {{$message}}
                            </p>
                            @enderror
                    

                        <div class="">
                            <div class="flex flex-row">
                                <input class="mx-2" type="checkbox" name="" id="">
                                <p>I've read and accept <span class="font-medium text-darthmouthgreen"><a href="">Terms & Condition</a></span></p>
                            </div>
                            
                            <div class="grid h-auto my-10 text-black place-items-end" >
                                <div class="flex">
                                    <x-forms.secondary-button name="Return" id="prevBtn2"/>
                                
                                    <x-forms.primary-button
                                    color="amber"
                                    name="Create my account"/>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>


            <div class="flex flex-row items-center justify-center text-center md:h-14 lg:h-auto " id="ins-foot ">
                <h1 class="text-black md:text-mainwhitebg">Already have an account?
                    <a class="font-semibold text-darthmouthgreen md:text-mainwhitebg" href="{{ url('/instructor') }}">Log in</a>
                </h1>
            </div>
            
            
        </div>

        {{-- MAIN LEFT --}}
        <div class="relative hidden h-screen bg-ashgray md:w-1/2 lg:block">
            {{-- IMAGE HOLDER --}}
            <div class="relative w-full h-full overflow-hidden rounded-lg">
                {{-- img-1 --}}
                <div class="hidden slides" id="slide1">
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