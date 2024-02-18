@include('partials.header')

    <section class="relative flex flex-row w-full h-screen text-sm bg-mainwhitebg">
        <header class="fixed top-0 left-0 z-40 flex flex-row items-center w-full px-4 py-4 bg-transparent">
            <a href="#">
                <span class="self-center font-semibold font-semibbold whitespace-nowrap md:text-2xl text-darthmouthgreen">
                    Eskwela4EveryJuan
                </span>
            </a>
        </header>

        {{-- MAIN --}}
        <div class="w-full h-screen pt-16 md:h-auto lg:h-screen lg:overflow-auto bg-mainwhitebg text-darthmouthgreen md:bg-mainwhitebg lg:w-1/2 lg:text-mainwhitebg lg:pt-24">
            <div class="rounded-lg md:shadow-xl md:w-3/4 md:mx-auto md:bg-mainwhitebg lg:bg-opacity-0 lg:shadow-transparent ">

                {{-- <x-header title="Create an learner Account" id="ins-head">
                    <p class="text-sm md:text-base">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Aperiam quidem nobis quasi porro odio! Iusto, aliquam.</p>
                </x-header> --}}

                <h1 class="text-6xl font-bold text-darthmouthgreen">Create New Learner Account</h1>
                <p class="mt-3 text-sm text-darthmouthgreen md:text-base">Welcome, future learner! We're excited to have you join our learning community. Please provide the necessary information below to create your new account.</p>

                {{-- <form class="pb-4 mx-4 mt-10 text-sm" action="{{ url('/learner/register1') }}" method="POST" enctype="multipart/form-data"> --}}

                <form class="pb-4 mx-4 mt-10 text-sm" action="{{ url('/learner/register') }}" method="POST" enctype="multipart/form-data">

                    @csrf
                    <div class="" id="first-form">
                        <div class="flex flex-col flex-nowrap lg:flex-row">
                            <div class=" FORM-CTNR lg:w-1/2 lg:mr-2">
                                <label for="learner_fname" class="text-lg text-darthmouthgreen">Firstname:</label>
                                @error('learner_fname')
                                    <span class="p-1 text-sm text-red-500">
                                        {{$message}}
                                    </span>
                                @enderror
                                <input class="border IN-V-INP border-darthmouthgreen" type="text" name="learner_fname" id="learner_fname" value="{{old('learner_fname')}}">
                                
                            </div>
                            <div class=" FORM-CTNR lg:w-1/2 lg:ml-2">
                                <label for="learner_lname" class="text-lg text-darthmouthgreen">Lastname:</label>
                                @error('learner_lname')
                                <span class="p-1 text-sm text-red-500">
                                        {{$message}}
                                    </span>
                                @enderror
                                <input class="border IN-V-INP border-darthmouthgreen" type="text" name="learner_lname" id="learner_lname" value="{{old('learner_lname')}}">
                                
                            </div>
                        </div>
                        
                        <div class="flex flex-col lg:flex-row lg:justify-between">
                            <div class="lg:mr-2 FORM-CTNR lg:w-1/2">
                                <label for="learner_bday" class="text-lg text-darthmouthgreen">Birthday:</label>
                                @error('learner_bday')
                                <span class="p-1 text-sm text-red-500">
                                        {{$message}}
                                    </span>
                                @enderror
                                <input class="border IN-V-INP border-darthmouthgreen" type="date" name="learner_bday" id="learner_bday" value="{{old('learner_bday')}}">
                                
                            </div>
                            
                            <div class="lg:ml-2 FORM-CTNR lg:w-1/2">
                                <label for="learner_gender" class="text-lg text-darthmouthgreen">Gender</label>
                                @error('learner_gender')
                                <span class="p-1 text-sm text-red-500">
                                        {{$message}}
                                    </span>
                                @enderror
                                <select name="learner_gender" id="gender" class="border IN-V-INP border-darthmouthgreen">
                                    <option value="" {{old('learner_gender') == "" ? 'selected' : ''}} class=""></option>
                                    <option value="Male" {{old('learner_gender') == "Male" ? 'selected' : ''}} class="">Male</option>
                                    <option value="Female" {{old('learner_gender') == "Female" ? 'selected' : ''}} class="">Female</option>
                                    <option value="Others" {{old('learner_gender') == "Others" ? 'selected' : ''}} class="">Preferred not to say</option>
                                </select>
                                
                            </div>
                        </div>

                        <div class="FORM-CTNR">
                            <label for="learner_email" class="text-lg text-darthmouthgreen">Email:</label>
                            @error('learner_email')
                            <span class="p-1 text-sm text-red-500">
                                    {{$message}}
                                </span>
                            @enderror
                            <input class="border IN-V-INP border-darthmouthgreen" type="email" name="learner_email" id="learner_email" value="{{old('learner_email')}}">
                           
                        </div>
                        <div class="FORM-CTNR">
                            <label for="learner_contactno" class="text-lg text-darthmouthgreen">Contact Number:</label>
                            {{-- <input class="IN-V-INP" type="text" name="learner_contactno" id="learner_contactno"> --}}
                            @error('learner_contactno')
                            <span class="p-1 text-sm text-red-500">
                                    {{$message}}
                                </span>
                            @enderror
                            <input type="tel" id="learner_contactno" maxlength="11" pattern="[0-9]{11}" name="learner_contactno" class="border IN-V-INP border-darthmouthgreen" placeholder="09" value="{{old('learner_contactno')}}">
                           
                        </div>
                        <div class="FORM-CTNR">
                            <label for="learner_username" class="text-lg text-darthmouthgreen">Username:</label>
                            @error('learner_username')
                            <span class="p-1 text-sm text-red-500">
                                    {{$message}}
                                </span>
                            @enderror
                            <input class="border IN-V-INP border-darthmouthgreen" type="text" name="learner_username" id="learner_username" value="{{old('learner_username')}}">
                        
                        </div>
                        <div class="FORM-CTNR">
                            <label for="password" class="text-lg text-darthmouthgreen">Password:</label>
                            @error('password')
                            <span class="p-1 text-sm text-red-500">
                                    {{$message}}
                                </span>
                            @enderror
                            <input class="border IN-V-INP border-darthmouthgreen" type="password" name="password" id="">
                           
                        </div>
                        <div class="FORM-CTNR">
                            <label for="password_confirmation" class="text-lg text-darthmouthgreen">Confirm Password:</label>
                            <input class="border IN-V-INP border-darthmouthgreen" type="password" name="password_confirmation" id="">
                        </div>

                        

                        
                        <div class="grid h-auto mt-5 text-black place-items-end" >
                            <button class="px-5 py-3 text-xl text-white rounded-xl bg-darthmouthgreen hover:bg-white hover:text-darthmouthgreen hover:border-darthmouthgreen hover:border-2" id="nxtBtn" name="Next">Next <i class="fa-solid fa-arrow-right hover:text-darthmouthgreen"></i></button>
                        </div>
                    </div> 
                    
                    <div class="hidden overflow-hidden" id="resumeForm">
                        {{-- <div>
                            <button class="flex items-center w-24 h-8 rounded bg-mainwhitebg" id="bckBtn">
                                <svg class="pr-2" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="m313-440 224 224-57 56-320-320 320-320 57 56-224 224h487v80H313Z"/></svg>
                            </button>
                        </div> --}}
                        
                        <div class="px-4 mt-2 mb-2">
                            {{-- <x-header title="About Credentials">
                                <p class="text-sm text-darthmouthgreen">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Aperiam quidem nobis quasi porro odio! Iusto, aliquam.</p>
                            </x-header> --}}

                            <h1 class="text-2xl font-bold text-darthmouthgreen">About you Business</h1>
                            <p class="mt-3 text-xs text-darthmouthgreen md:text-base">Welcome, future learner! To tailor your experience and provide the best learning opportunities, please share some details about your business with us. Your information will be kept confidential and used solely for educational purposes.</p>
            
                        </div>

                        {{-- <div class="pb-4 my-8 font-semibold border-b-2" action="">
                            <label for="learner_credentials" class="text-lg text-darthmouthgreen">Upload CV or Resume</label>
                            @error('learner_credentials')
                                <span class="p-1 text-sm text-red-500">
                                        {{$message}}
                                    </span>
                                @enderror
                            <input type="file" name="learner_credentials" id="learner_credentials" accept="application/pdf" class="text-darthmouthgreen">
                            
                        </div> --}}

                        <div class="mt-4 FORM-CTNR">
                            <label for="business_name" class="text-lg text-darthmouthgreen">Business Name:</label>
                            @error('business_name')
                            <span class="p-1 text-sm text-red-500">
                                    {{$message}}
                                </span>
                            @enderror
                            <input class="border IN-V-INP border-darthmouthgreen" type="text" name="business_name" id="business_name" value="{{old('business_name')}}">
                        </div>

                        
                        <div class="mt-4 FORM-CTNR">
                            <label for="business_address" class="text-lg text-darthmouthgreen">Business Address:</label>
                            @error('business_address')
                            <span class="p-1 text-sm text-red-500">
                                    {{$message}}
                                </span>
                            @enderror
                            <input class="border IN-V-INP border-darthmouthgreen" type="text" name="business_address" id="business_address" value="{{old('business_address')}}">
                        </div>

                        
                        <div class="mt-4 FORM-CTNR">
                            <label for="business_owner_name" class="text-lg text-darthmouthgreen">Business Owner Name:</label>
                            @error('business_owner_name')
                            <span class="p-1 text-sm text-red-500">
                                    {{$message}}
                                </span>
                            @enderror
                            <input class="border IN-V-INP border-darthmouthgreen" type="text" name="business_owner_name" id="business_owner_name" value="{{old('business_owner_name')}}">
                        </div>
                        

                        <div class="mt-4 FORM-CTNR">
                            <label for="bplo_account_number" class="text-lg text-darthmouthgreen">BPLO Account Number:</label>
                            @error('bplo_account_number')
                            <span class="p-1 text-sm text-red-500">
                                    {{$message}}
                                </span>
                            @enderror
                            <input class="border IN-V-INP border-darthmouthgreen" type="text" maxlength="13" name="bplo_account_number" id="bplo_account_number" value="{{old('bplo_account_number')}}">
                        </div>

                        <div class=" FORM-CTNR lg:w-1/2">
                            <label for="business_category" class="text-lg text-darthmouthgreen">Business Category: </label>
                            @error('business_category')
                            <span class="p-1 text-sm text-red-500">
                                    {{$message}}
                                </span>
                            @enderror
                            <select name="business_category" id="gender" class="border IN-V-INP border-darthmouthgreen">
                                <option value="" {{old('business_category') == "" ? 'selected' : ''}} class=""></option>
                                <option value="Micro" {{old('business_category') == "Micro" ? 'selected' : ''}} class="">Micro</option>
                                <option value="Small" {{old('business_category') == "Small" ? 'selected' : ''}} class="">Small</option>
                                <option value="Medium" {{old('business_category') == "Medium" ? 'selected' : ''}} class="">Medium</option>
                            </select>
                            
                        </div>

                        <div class="">

                            <div class="grid h-auto my-10 text-black place-items-end" >
                                <div class="flex" >
    
                                    <button class="px-5 py-3 mx-2 text-xl text-white rounded-xl bg-darthmouthgreen hover:bg-white hover:text-darthmouthgreen hover:border-darthmouthgreen hover:border-2" id="prevBtn" name="Back"><i class="fa-solid fa-arrow-left hover:text-darthmouthgreen"></i>Back</button>
                                    <button class="px-5 py-3 mx-2 text-xl text-white rounded-xl bg-darthmouthgreen hover:bg-white hover:text-darthmouthgreen hover:border-darthmouthgreen hover:border-2" id="nxtBtn2" name="Next">Next <i class="fa-solid fa-arrow-right hover:text-darthmouthgreen"></i></button>
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
                            <h1 class="text-2xl font-bold text-darthmouthgreen">Set your Security Code</h1>
                            <p class="mt-3 text-xs text-darthmouthgreen md:text-base">Secure your account by setting a unique security code. This code will add an extra layer of protection to your account, ensuring that only you can access sensitive information. Please choose a memorable code that combines numbers and letters to maximize security.</p>

                        </div>

                    <div class="flex items-center pb-4 my-8 ml-5 font-semibold text-black border-b-2 security-code-container">
                            <label for="learner_security_code" class="text-xl text-darthmouthgreen">Security Code:</label>
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
                                <p class="text-sm text-darthmouthgreen">I've read and accept <span class="font-bold text-darthmouthgreen"><a href="">Terms & Condition</a></span></p>
                            </div>
                            
                            <div class="grid h-auto mt-5 text-black place-items-end" >
                                <div class="flex">
                                    {{-- <x-forms.secondary-button name="Return" id="prevBtn2"/>
                                
                                    <x-forms.primary-button
                                    color="amber"
                                    name="Create my account"/> --}}

                                    <button class="px-5 py-3 mx-2 text-xl text-white rounded-xl bg-darthmouthgreen hover:bg-white hover:text-darthmouthgreen hover:border-darthmouthgreen hover:border-2" id="prevBtn2" name="Back"><i class="fa-solid fa-arrow-left hover:text-darthmouthgreen"></i>Back</button>
                                    <button class="px-5 py-3 mx-2 text-xl text-white rounded-xl bg-darthmouthgreen hover:bg-white hover:text-darthmouthgreen hover:border-darthmouthgreen hover:border-2" id="" type="submit" name="Create my account">Create my account</button>
                                </div>
                            </div>
                        </div>
                    </div>

                </form>
  
                <div class="mx-auto mb-10 text-sm w-max md:text-base">

                    <p class="text-darthmouthgreen md:text-darthmouthgreen">Already have an account?
                        <span class="font-bold text-darthmouthgreen md:text-darthmouthgreen">
                            <a href="{{ url('/learner') }}">
                                Sign up
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
    </section>

@include('partials.footer')