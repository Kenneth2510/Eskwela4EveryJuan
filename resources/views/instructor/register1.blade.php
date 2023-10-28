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


            <form class="pb-4 mx-4 mt-10 text-sm text-black" action="{{ url('/instructor/register') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="" id="first-form">
                    <div class="flex flex-col">
                        <div class="IN-FORM-CTNR">
                            <label for="instructor_fname">Firstname:</label>
                            <input class="IN-V-INP" type="text" name="instructor_fname" id="instructor_fname" value="{{old('instructor_fname')}}">
                            @error('instructor_fname')
                            <p class="p-1 mt-2 text-xs text-red-500">
                                {{$message}}
                            </p>
                            @enderror
                        </div>
                        <div class="IN-FORM-CTNR">
                            <label for="instructor_lname">Lastname:</label>
                            <input class="IN-V-INP" type="text" name="instructor_lname" id="instructor_lname" value="{{old('instructor_lname')}}">
                            @error('instructor_lname')
                            <p class="p-1 mt-2 text-xs text-red-500">
                                {{$message}}
                            </p>
                            @enderror
                        </div>
                    </div>
                    
                    <div>
                        <div class="IN-FORM-CTNR">
                            <label for="instructor_bday">Birthday:</label>
                            <input class="IN-V-INP" type="date" name="instructor_bday" id="instructor_bday" value="{{old('instructor_bday')}}">
                            @error('instructor_bday')
                            <p class="p-1 mt-2 text-xs text-red-500">
                                {{$message}}
                            </p>
                            @enderror
                        </div>
                        
                        <div class="IN-FORM-CTNR">
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

                    <div class="IN-FORM-CTNR">
                        <label for="instructor_email">Email:</label>
                        <input class="IN-V-INP" type="email" name="instructor_email" id="instructor_email" value="{{old('instructor_email')}}">
                        @error('instructor_email')
                            <p class="p-1 mt-2 text-xs text-red-500">
                                {{$message}}
                            </p>
                            @enderror
                    </div>
                    <div class="IN-FORM-CTNR">
                        <label for="instructor_contactno">Contact Number:</label>
                        {{-- <input class="IN-V-INP" type="text" name="instructor_contactno" id="instructor_contactno"> --}}
                        <input type="tel" id="instructor_contactno" maxlength="11" pattern="[0-9]{11}" name="instructor_contactno" class="IN-V-INP" placeholder="09" value="{{old('instructor_contactno')}}">
                        @error('instructor_contactno')
                            <p class="p-1 mt-2 text-xs text-red-500">
                                {{$message}}
                            </p>
                            @enderror
                    </div>
                    <div class="IN-FORM-CTNR">
                        <label for="instructor_username">Username:</label>
                        <input class="IN-V-INP" type="text" name="instructor_username" id="instructor_username" value="{{old('instructor_username')}}">
                        @error('instructor_username')
                            <p class="p-1 mt-2 text-xs text-red-500">
                                {{$message}}
                            </p>
                            @enderror
                    </div>
                    <div class="IN-FORM-CTNR">
                        <label for="password">Password:</label>
                        <input class="IN-V-INP" type="password" name="password" id="">
                        @error('password')
                            <p class="p-1 mt-2 text-xs text-red-500">
                                {{$message}}
                            </p>
                            @enderror
                    </div>
                    <div class="IN-FORM-CTNR">
                        <label for="password_confirmation">Confirm Password:</label>
                        <input class="IN-V-INP" type="password" name="password_confirmation" id="">
                    </div>

                    

                    
                    <div class="grid h-auto my-10 text-black place-items-end" >
                        <button class="flex flex-row items-center justify-center w-24 h-10 rounded-lg bg-amber-400 hover:bg-amber-500" id="nxtBtn">
                            <h1 class="text-xl">Next</h1>
                            <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="M647-440H160v-80h487L423-744l57-56 320 320-320 320-57-56 224-224Z"/></svg>
                        </button>
                    </div>
                </div> 
                
                <div class="hidden overflow-hidden" id="resumeForm">
                    {{-- <div>
                        <button class="flex items-center w-24 h-8 rounded bg-mainwhitebg" id="bckBtn">
                            <svg class="pr-2" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="m313-440 224 224-57 56-320-320 320-320 57 56-224 224h487v80H313Z"/></svg>
                        </button>
                    </div> --}}
                    
                    <div class="px-4 mt-4">
                        <h1 class="text-3xl font-bold text-darthmouthgreen">About Credentials</h1>
                        <p class="text-sm">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Aperiam quidem nobis quasi porro odio! Iusto, aliquam.</p>
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
                                <button class="flex flex-row items-center justify-center w-24 h-10 mx-2 bg-red-500 rounded-lg hover:bg-red-700" id="prevBtn">
                                    <h1 class="text-xl">Back</h1>
                                    <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="M647-440H160v-80h487L423-744l57-56 320 320-320 320-57-56 224-224Z"/></svg>
                                </button>
                                <button class="flex flex-row items-center justify-center w-24 h-10 mx-2 rounded-lg bg-amber-400 hover:bg-amber-500" id="nxtBtn2">
                                    <h1 class="text-xl">Next</h1>
                                    <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="M647-440H160v-80h487L423-744l57-56 320 320-320 320-57-56 224-224Z"/></svg>
                                </button>
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
                        <h1 class="text-3xl font-bold text-darthmouthgreen">Create your Security Code</h1>
                        <p class="text-sm">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Aperiam quidem nobis quasi porro odio! Iusto, aliquam.</p>
                    </div>

                   <div class="flex items-center pb-4 my-8 font-semibold border-b-2 security-code-container">
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
                                <button class="flex flex-row items-center justify-center w-24 h-10 bg-red-500 rounded-lg hover:bg-red-700" id="prevBtn2">
                                    <h1 class="text-xl">Return</h1>
                                    <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="M647-440H160v-80h487L423-744l57-56 320 320-320 320-57-56 224-224Z"/></svg>
                                </button>
                                <button type="submit" class="h-10 px-2 mx-2 text-xl font-medium rounded bg-amber-400 hover:bg-amber-500">Create my account</button>
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
        
    </section>

@include('partials.footer')