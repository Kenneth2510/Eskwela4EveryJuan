@extends('layouts.instructor_login')

@section('content')
    {{-- MAIN --}}
    <div class="relative w-full h-screen pt-16 md:h-auto lg:h-screen lg:overflow-auto bg-mainwhitebg text-darthmouthgreen md:bg-mainwhitebg lg:w-1/2 lg:text-mainwhitebg lg:pt-24">
        <div class="rounded-lg md:shadow-xl md:w-3/4 md:mx-auto md:bg-mainwhitebg lg:bg-opacity-0 lg:shadow-transparent ">


            {{-- <x-header title="Create an Instructor Account" id="ins-head">
                <p class="text-sm md:text-base">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Aperiam quidem nobis quasi porro odio! Iusto, aliquam.</p>
            </x-header> --}}

            <h1 class="text-4xl font-bold text-darthmouthgreen">Create New Instructor Account</h1>
            <p class="mt-3 text-darthmouthgreen">Welcome, future instructor! We're excited to have you join our teaching community. Please provide the necessary information below to create your new account.</p>

            {{-- <form class="pb-4 mx-4 mt-10 text-sm" action="{{ url('/instructor/register1') }}" method="POST" enctype="multipart/form-data"> --}}

            <form class="pb-4 mx-4 mt-10" action="{{ url('/instructor/register') }}" method="POST" enctype="multipart/form-data">

                @csrf
                <div class="" id="first-form">
                    <div class="flex flex-col flex-nowrap lg:flex-row">
                        <div class=" FORM-CTNR lg:w-1/2 lg:mr-2">
                            <label for="instructor_fname" class="text-darthmouthgreen">Firstname:</label>
                            @error('instructor_fname')
                                <span class="p-1 text-sm text-red-500">
                                    {{$message}}
                                </span>
                            @enderror
                            <input class="border IN-V-INP border-darthmouthgreen" type="text" name="instructor_fname" id="instructor_fname" value="{{old('instructor_fname')}}">
                            
                        </div>
                        <div class=" FORM-CTNR lg:w-1/2 lg:ml-2">
                            <label for="instructor_lname" class="text-darthmouthgreen">Lastname:</label>
                            @error('instructor_lname')
                            <span class="p-1 text-sm text-red-500">
                                    {{$message}}
                                </span>
                            @enderror
                            <input class="border IN-V-INP border-darthmouthgreen" type="text" name="instructor_lname" id="instructor_lname" value="{{old('instructor_lname')}}">
                            
                        </div>
                    </div>
                    
                    <div class="flex flex-col lg:flex-row lg:justify-between">
                        <div class="lg:mr-2 FORM-CTNR lg:w-1/2">
                            <label for="instructor_bday" class="text-darthmouthgreen">Birthday:</label>
                            @error('instructor_bday')
                            <span class="p-1 text-sm text-red-500">
                                    {{$message}}
                                </span>
                            @enderror
                            <input class="border IN-V-INP border-darthmouthgreen" type="date" name="instructor_bday" id="instructor_bday" value="{{old('instructor_bday')}}">
                            
                        </div>
                        
                        <div class="lg:ml-2 FORM-CTNR lg:w-1/2">
                            <label for="instructor_gender" class="text-darthmouthgreen">Gender</label>
                            @error('instructor_gender')
                            <span class="p-1 text-sm text-red-500">
                                    {{$message}}
                                </span>
                            @enderror
                            <select name="instructor_gender" id="gender" class="border IN-V-INP border-darthmouthgreen">
                                <option value="" {{old('instructor_gender') == "" ? 'selected' : ''}} class=""></option>
                                <option value="Male" {{old('instructor_gender') == "Male" ? 'selected' : ''}} class="">Male</option>
                                <option value="Female" {{old('instructor_gender') == "Female" ? 'selected' : ''}} class="">Female</option>
                                <option value="Others" {{old('instructor_gender') == "Others" ? 'selected' : ''}} class="">Preferred not to say</option>
                            </select>
                            
                        </div>
                    </div>

                    <div class="FORM-CTNR">
                        <label for="instructor_email" class="text-darthmouthgreen">Email:</label>
                        @error('instructor_email')
                        <span class="p-1 text-sm text-red-500">
                                {{$message}}
                            </span>
                        @enderror
                        <input class="border IN-V-INP border-darthmouthgreen" type="email" name="instructor_email" id="instructor_email" value="{{old('instructor_email')}}">
                        
                    </div>
                    <div class="FORM-CTNR">
                        <label for="instructor_contactno" class="text-darthmouthgreen">Contact Number:</label>
                        {{-- <input class="IN-V-INP" type="text" name="instructor_contactno" id="instructor_contactno"> --}}
                        @error('instructor_contactno')
                        <span class="p-1 text-sm text-red-500">
                                {{$message}}
                            </span>
                        @enderror
                        <input type="tel" id="instructor_contactno" maxlength="11" pattern="[0-9]{11}" name="instructor_contactno" class="border IN-V-INP border-darthmouthgreen" placeholder="09" value="{{old('instructor_contactno')}}">
                        
                    </div>
                    <div class="FORM-CTNR">
                        <label for="instructor_username" class="text-darthmouthgreen">Username:</label>
                        @error('instructor_username')
                        <span class="p-1 text-sm text-red-500">
                                {{$message}}
                            </span>
                        @enderror
                        <input class="border IN-V-INP border-darthmouthgreen" type="text" name="instructor_username" id="instructor_username" value="{{old('instructor_username')}}">
                    
                    </div>
                    <div class="FORM-CTNR">
                        <label for="password" class=" text-darthmouthgreen">Password:</label>
                        @error('password')
                        <span class="p-1 text-sm text-red-500">
                                {{$message}}
                            </span>
                        @enderror
                        <input class="border IN-V-INP border-darthmouthgreen" type="password" name="password" id="">
                        
                    </div>
                    <div class="FORM-CTNR">
                        <label for="password_confirmation" class=" text-darthmouthgreen">Confirm Password:</label>
                        <input class="border IN-V-INP border-darthmouthgreen" type="password" name="password_confirmation" id="">
                    </div>

                    <div class="grid h-auto mt-5 text-black place-items-end" >
                        <button class="px-5 py-3 text-white rounded-xl bg-darthmouthgreen hover:bg-white hover:text-darthmouthgreen hover:ring-2 hover:ring-darthmouthgreen" id="nxtBtn" name="Next">Next</button>

                    </div>
                </div> 
                
                <div class="hidden overflow-hidden" id="resumeForm">
                    {{-- <div>
                        <button class="flex items-center w-24 h-8 rounded bg-mainwhitebg" id="bckBtn">
                            <svg class="pr-2" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="m313-440 224 224-57 56-320-320 320-320 57 56-224 224h487v80H313Z"/></svg>
                        </button>
                    </div> --}}
                    
                    <div class="px-4 mt-4">
                        {{-- <x-header title="About Credentials">
                            <p class="text-sm text-darthmouthgreen">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Aperiam quidem nobis quasi porro odio! Iusto, aliquam.</p>
                        </x-header> --}}

                        <h1 class="text-2xl font-bold text-darthmouthgreen">About Credentials</h1>
                        <p class="mt-3 text-darthmouthgreen md:text-base">Welcome, future instructor! To get started, please provide the required information below to set up your new account. Your credentials will be securely stored to ensure a seamless and personalized experience on our teaching platform.</p>
        
                    </div>

                    <div class="pb-4 my-8 font-semibold border-b-2" action="">
                        <label for="instructor_credentials" class=" text-darthmouthgreen">Upload CV or Resume</label>
                        @error('instructor_credentials')
                            <span class="p-1 text-sm text-red-500">
                                    {{$message}}
                                </span>
                            @enderror
                        <input type="file" name="instructor_credentials" id="instructor_credentials" accept="application/pdf" class="text-darthmouthgreen">
                        
                    </div>

                    <div class="">

                        <div class="grid h-auto my-10 text-black place-items-end" >
                            <div class="flex" >
                                {{-- <x-forms.secondary-button
                                name="Back"
                                id="prevBtn">
                                </x-forms.secondary-button>
                                <x-forms.primary-button
                                color="amber"
                                name="Next"
                                type="button"
                                id="nxtBtn2">

                                    <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24">
                                        <path d="M647-440H160v-80h487L423-744l57-56 320 320-320 320-57-56 224-224Z"/>
                                    </svg>
                                </x-forms.primary-button> --}}
                                <button class="px-5 py-3 mx-2 text-white rounded-xl bg-mintgreen hover:bg-white hover:text-darthmouthgreen hover:ring-2 hover:ring-darthmouthgreen" id="prevBtn" name="Back">Back</button>
                                <button class="px-5 py-3 mx-2 text-white rounded-xl bg-darthmouthgreen hover:bg-white hover:text-darthmouthgreen hover:ring-2 hover:ring-darthmouthgreen" id="nxtBtn2" name="Next">Next</button>

                            </div>
                            
                        </div>
                    </div>
                </div>


                <div class="hidden py-2 overflow-hidden" id="security_code">
                    {{-- <div>
                        <button class="flex items-center w-24 h-8 rounded bg-mainwhitebg" id="bckBtn">
                            <svg class="pr-2" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="m313-440 224 224-57 56-320-320 320-320 57 56-224 224h487v80H313Z"/></svg>
                        </button>
                    </div> --}}
                    
                    <div class="px-4 mt-4">
                        <h1 class="text-2xl font-bold text-darthmouthgreen">Set your Security Code</h1>
                        <p class="mt-3 text-darthmouthgreen">Secure your account by setting a unique security code. This code will add an extra layer of protection to your account, ensuring that only you can access sensitive information. Please choose a memorable code that combines numbers and letters to maximize security.</p>

                    </div>

                <div class="flex flex-wrap items-center pb-4 my-8 ml-5 font-semibold text-black border-b-2 security-code-container">
                        <label for="instructor_security_code" class="text-darthmouthgreen">Security Code:</label>
                        <div>
                            <input class="code m-1 h-16 text-center shadow outline-none focus:ring-black focus:ring-[1px]" type="password" name="security_code_1" id="" maxlength="1" size="1" min="0" max="9" pattern="{0-9}{1}" autofocus>
                            <input class="code h-16 m-1 text-center shadow outline-none focus:ring-black focus:ring-[1px]" type="password" name="security_code_2" id="" maxlength="1" size="1" min="0" max="9" pattern="{0-9}{1}">
                            <input class="code h-16 m-1 text-center shadow outline-none focus:ring-black focus:ring-[1px]" type="password" name="security_code_3" id="" maxlength="1" size="1" min="0" max="9" pattern="{0-9}{1}">
                            <input class="code h-16 m-1 text-center shadow outline-none focus:ring-black focus:ring-[1px]" type="password" name="security_code_4" id="" maxlength="1" size="1" min="0" max="9" pattern="{0-9}{1}">
                            <input class="code h-16 m-1 text-center shadow outline-none focus:ring-black focus:ring-[1px]" type="password" name="security_code_5" id="" maxlength="1" size="1" min="0" max="9" pattern="{0-9}{1}">
                            <input class="code h-16 m-1 text-center shadow outline-none focus:ring-black focus:ring-[1px]" type="password" name="security_code_6" id="" maxlength="1" size="1" min="0" max="9" pattern="{0-9}{1}">                                
                        </div>


                        
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
                        <span class="p-1 text-sm text-red-500">
                                    {{$message}}
                                </span>
                        @enderror
                        @error('security_code_2')
                        <span class="p-1 text-sm text-red-500">
                                    {{$message}}
                                </span>
                        @enderror
                        @error('security_code_3')
                        <span class="p-1 text-sm text-red-500">
                                    {{$message}}
                                </span>
                        @enderror
                        @error('security_code_4')
                        <span class="p-1 text-sm text-red-500">
                                    {{$message}}
                                </span>
                        @enderror
                        @error('security_code_5')
                        <span class="p-1 text-sm text-red-500">
                                    {{$message}}
                                </span>
                        @enderror
                        @error('security_code_6')
                        <span class="p-1 text-sm text-red-500">
                                    {{$message}}
                                </span>
                        @enderror
                

                    <div class="">
                        <div class="flex flex-row">
                            <input class="mx-2" type="checkbox" name="" id="">
                            <p class=" text-darthmouthgreen">I've read and accept <span class="font-bold text-darthmouthgreen"><a href="">Terms & Condition</a></span></p>
                        </div>
                        
                        <div class="grid h-auto mt-5 text-black place-items-end" >
                            <div class="flex">
                                {{-- <x-forms.secondary-button name="Return" id="prevBtn2"/>
                            
                                <x-forms.primary-button
                                color="amber"
                                name="Create my account"/> --}}

                                <button class="px-5 py-3 mx-2 text-white rounded-xl bg-mintgreen hover:bg-white hover:text-darthmouthgreen hover:ring-2 hover:ring-darthmouthgreen" id="prevBtn2" name="Back">Back</button>
                                <button class="px-5 py-3 mx-2 text-white rounded-xl bg-darthmouthgreen hover:bg-white hover:text-darthmouthgreen hover:ring-2 hover:ring-darthmouthgreen" id="" type="submit" name="Create my account">Create my account</button>
                            </div>
                        </div>
                    </div>
                </div>

            </form>

            <div class="w-full py-4 mx-auto text-center">

                <p class="text-darthmouthgreen md:text-darthmouthgreen">Already have an account?
                    <span class="font-bold text-darthmouthgreen md:text-darthmouthgreen">
                        <a href="{{ url('/instructor') }}">
                            Sign in
                        </a>
                    </span>
                </p>
            </div>
        </div>


        
        
    </div>

        {{-- MAIN LEFT --}}
        <div class="relative hidden h-screen bg-seagreen md:w-1/2 lg:block">
        {{-- IMAGE HOLDER --}}
        <div class="relative w-full h-full overflow-hidden rounded-lg">
            {{-- img-1 --}}
            <div class="hidden slides" id="slide1">
                <img src="{{asset('/images/ins-login-img1.png')}}" class="absolute block -translate-x-1/2 -translate-y-1/2 top-1/3 left-1/2" alt="image-1">
                <div class="absolute block text-center -translate-x-1/2 top-3/4 left-1/2">
                    <h1 class="text-2xl font-bold text-white">Maintain your Business</h1>
                    <p class="text-base text-white">Lorem ipsum dolor sit amet consectetur. Tellus ultrices in nibh malesuada sit justo fermentum. Elit id in pulvinar eget amet.</p>
                </div>
                
            </div>
            {{-- img-2 --}}
            <div class="hidden slides" id="slide2">
                <img src="{{asset('/images/ins-login-img2.png')}}" class="absolute block -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="image-2">
                <div class="absolute block text-center -translate-x-1/2 top-3/4 left-1/2">
                    <h1 class="text-2xl font-bold text-white">Maintain your Business</h1>
                    <p class="text-base text-white">Lorem ipsum dolor sit amet consectetur. Tellus ultrices in nibh malesuada sit justo fermentum. Elit id in pulvinar eget amet.</p>
                </div>
            </div>
            {{-- img-3 --}}
            <div class="hidden slides" id="slide3">
                <img src="{{asset('/images/ins-login-img3.png')}}" class="absolute block -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="image-3">
                <div class="absolute block text-center -translate-x-1/2 top-3/4 left-1/2">
                    <h1 class="text-2xl font-bold text-white">Maintain your Business</h1>
                    <p class="text-base text-white">Lorem ipsum dolor sit amet consectetur. Tellus ultrices in nibh malesuada sit justo fermentum. Elit id in pulvinar eget amet.</p>
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
            <span class="inline-flex items-center justify-center w-10 h-10 bg-white rounded-full dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                <svg class="w-4 h-4 text-white dark:text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 1 1 5l4 4"/>
                </svg>
                <span class="sr-only">Previous</span>
            </span>
        </button>

        <button type="button" class="absolute top-0 right-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" id="l-nextBtn">
            <span class="inline-flex items-center justify-center w-10 h-10 bg-white rounded-full dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                <svg class="w-4 h-4 text-white dark:text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                </svg>
                <span class="sr-only">Next</span>
            </span>
        </button>
    </div>
@endsection

