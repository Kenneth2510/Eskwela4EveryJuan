@include('partials.header')

<section class="relative flex w-screen h-screen">
    <div id="RegisterLeft" class="relative w-1/2 h-full bg-neutral-200">
        <header class="fixed top-0 left-0 z-40 flex flex-row items-center w-full px-4 py-4 bg-seagreen">
            <a href="#">
                <span class="self-center text-lg font-semibold font-semibbold whitespace-nowrap md:text-2xl text-mainwhitebg">
                    Eskwela4EveryJuan
                </span>
            </a>
        </header>      

       

        <form action="{{ url('/learner/register') }}" method="POST">
        @csrf
           
            <div id="personinfo" class="relative w-4/5 mx-auto mt-10">
                <div id="Registertitle" class="relative w-full mx-auto my-14">
                    <h1 class="text-5xl font-bold text-black">Create an Account</h1>
                    <p class="mt-2 text-lg font-light">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Est voluptate ut, facere repellendus earum, at corrupti praesentium consectetur dignissimos,</p>
                </div>
                <div class="flex justify-around my-5">
                    <div class="w-1/2">
                        <label for="learner_fname" class="text-xl font-semibold">First Name</label><br>
                        <input type="text" class="w-11/12 mx-0.5 px-3 py-1 text-lg shadow-xl rounded-md" name="learner_fname" placeholder="First Name" value="{{ old('learner_fname') }}">
                        @error('learner_fname')
                        <p class="p-1 mt-2 text-xs text-red-500">
                            {{$message}}
                        </p>
                        @enderror
                    </div>
                    <div class="w-1/2">
                        <label for="learner_lname" class="text-xl font-semibold">Last Name</label><br>
                        <input type="text" name="learner_lname" class="w-11/12 mx-0.5 px-3 py-1 text-lg shadow-xl rounded-md" placeholder="Last Name" value="{{ old('learner_lname') }}">
                        @error('learner_lname')
                        <p class="p-1 mt-2 text-xs text-red-500">
                            {{$message}}
                        </p>
                        @enderror
                    </div>
                </div>

                <div class="flex justify-around w-full my-5">
                    <div class="w-1/2">
                        <label for="learner_bday" class="text-xl font-semibold">Birthday</label><br>
                        <input type="date" name="learner_bday" class="w-11/12 mx-0.5 px-3 py-1 text-lg shadow-xl rounded-md" value="{{ old('learner_bday') }}">
                        @error('learner_bday')
                        <p class="p-1 mt-2 text-xs text-red-500">
                            {{$message}}
                        </p>
                        @enderror
                    </div>
                    <div class="w-1/2">
                        <label for="learner_gender" class="text-xl font-semibold">Gender</label><br>
                        <select name="learner_gender" id="" class="w-11/12 mx-0.5 px-3 py-1 text-lg shadow-xl rounded-md">
                            <option value="" {{old('learner_gender') == "" ? 'selected' : ''}} class=""></option>
                            <option value="Male" {{old('learner_gender') == "Male" ? 'selected' : ''}} class="">Male</option>
                            <option value="Female" {{old('learner_gender') == "Female" ? 'selected' : ''}} class="">Female</option>
                            <option value="Others" {{old('learner_gender') == "Others" ? 'selected' : ''}} class="">Preferred not to say</option>
                        </select>
                        @error('learner_gender')
                        <p class="p-1 mt-2 text-xs text-red-500">
                            {{$message}}
                        </p>
                        @enderror
                    </div>
                </div>

                <div class="w-full my-5">
                    <label for="learner_email" class="text-xl font-semibold">Email</label><br>
                    <input type="email" name="learner_email" class="w-11/12 mx-0.5 px-3 py-1 text-lg shadow-xl rounded-md" placeholder="Email" value="{{ old('learner_email') }}">
                    @error('learner_email')
                        <p class="p-1 mt-2 text-xs text-red-500">
                            {{$message}}
                        </p>
                        @enderror
                </div>

                <div class="w-full my-5">
                    <label for="learner_contactno" class="text-xl font-semibold">Contact Number</label><br>
                    <input type="tel" id="learner_contactno" maxlength="11" pattern="[0-9]{11}" name="learner_contactno" class="w-11/12 mx-0.5 px-3 py-1 text-lg shadow-xl rounded-md" placeholder="09" value="{{ old('learner_contactno') }}">
                    @error('learner_contactno')
                        <p class="p-1 mt-2 text-xs text-red-500">
                            {{$message}}
                        </p>
                        @enderror
                </div>

                <div class="w-full my-5">
                    <label for="learner_username" class="text-xl font-semibold">Username</label><br>
                    <input type="text" name="learner_username" class="w-11/12 mx-0.5 px-3 py-1 text-lg shadow-xl rounded-md" placeholder="Username" value="{{ old('learner_username') }}">
                    @error('learner_username')
                        <p class="p-1 mt-2 text-xs text-red-500">
                            {{$message}}
                        </p>
                        @enderror
                </div>

                <div class="w-full my-5">
                    <label for="password" class="text-xl font-semibold">Password</label><br>
                    <input type="password" name="password" class="w-11/12 mx-0.5 px-3 py-1 text-lg shadow-xl rounded-md" placeholder="Password">
                    @error('password')
                    <p class="p-1 mt-2 text-xs text-red-500">
                        {{$message}}
                    </p>
                    @enderror
                </div>
                
                <div class="w-full my-5">
                    <label for="password_confirmation" class="text-xl font-semibold">Confirm Password</label><br>
                    <input type="password" name="password_confirmation" class="w-11/12 mx-0.5 px-3 py-1 text-lg shadow-xl rounded-md" placeholder="Confirm Password">
                </div>
                <div class="flex items-center ">
                    <div class="relative flex justify-center w-10/12 mx-auto mt-6 py-" id="register">
                        <p class="text-xl font-normal">Already have an account? <a href="{{ url('/learner') }}" class="text-xl font-semibold text-green-700 hover:text-green-900">Sign In</a></p>
                    </div>
                    <div class="flex justify-end w-full mt-10">
                        <button id="nextBtn" class="py-3 text-xl font-semibold text-white bg-green-700 rounded-xl px-7 hover:bg-green-900">Next  <i class="fa-solid fa-arrow-right" style="color: #ffffff;"></i></button>
                    </div>
                </div>
                
            </div>

            <div id="businessinfo" class="relative hidden w-4/5 mx-auto mt-10">
                <div id="Registertitle" class="relative w-full mx-auto my-14">
                    <h1 class="text-5xl font-bold text-black">About your Business</h1>
                    <p class="mt-2 text-lg font-light">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Est voluptate ut, facere repellendus earum, at corrupti praesentium consectetur dignissimos,</p>
                </div>

                <div class="w-full my-5">
                    <label for="business_name" class="text-xl font-semibold">Business Name:</label><br>
                    <input type="text" name="business_name" class="w-11/12 mx-0.5 px-3 py-1 text-lg shadow-xl rounded-md" placeholder="Business Name" value="{{ old('business_name') }}">
                    @error('business_name')
                        <p class="p-1 mt-2 text-xs text-red-500">
                            {{$message}}
                        </p>
                        @enderror
                </div>

                <div class="w-full my-5">
                    <label for="business_address" class="text-xl font-semibold">Business Address:</label><br>
                    <input type="text" name="business_address" class="w-11/12 mx-0.5 px-3 py-1 text-lg shadow-xl rounded-md" placeholder="Business Address" value="{{ old('business_address') }}">
                    @error('business_address')
                        <p class="p-1 mt-2 text-xs text-red-500">
                            {{$message}}
                        </p>
                        @enderror
                </div>

                <div class="w-full my-5">
                    <label for="business_owner_name" class="text-xl font-semibold">Business Owner Name:</label><br>
                    <input type="text" name="business_owner_name" class="w-11/12 mx-0.5 px-3 py-1 text-lg shadow-xl rounded-md" placeholder="Business Owner Name" value="{{ old('business_owner_name') }}">
                    @error('business_owner_name')
                        <p class="p-1 mt-2 text-xs text-red-500">
                            {{$message}}
                        </p>
                        @enderror
                </div>

                <div class="w-full my-5">
                    <label for="bplo_account_number" class="text-xl font-semibold">BPLO Account Number:</label><br>
                    <input type="text" name="bplo_account_number" class="w-11/12 mx-0.5 px-3 py-1 text-lg shadow-xl rounded-md" placeholder="BPLO Account Number" value="{{ old('bplo_account_number') }}">
                    @error('bplo_account_number')
                        <p class="p-1 mt-2 text-xs text-red-500">
                            {{$message}}
                        </p>
                        @enderror
                </div>

                <div class="w-1/2">
                    <label for="business_category" class="text-xl font-semibold">Business Category</label><br>
                    <select name="business_category" id="" class="w-11/12 mx-0.5 px-3 py-1 text-lg shadow-xl rounded-md">
                        <option value="" {{old('business_category') == "" ? 'selected' : ''}} class=""></option>
                        <option value="Micro" {{old('business_category') == "Micro" ? 'selected' : ''}} class="">Micro</option>
                        <option value="Small" {{old('business_category') == "Small" ? 'selected' : ''}} class="">Small</option>
                        <option value="Medium" {{old('business_category') == "Medium" ? 'selected' : ''}} class="">Medium</option>
                    </select>
                    @error('business_category')
                    <p class="p-1 mt-2 text-xs text-red-500">
                        {{$message}}
                    </p>
                    @enderror
                </div>

                <div class="relative py-5 mt-10 border-t-2 border-green-800">
                    {{-- <div class="flex items-center py-3">
                        <input type="checkbox" name="rememberMe" class="w-6 h-6 mr-3 text-lg bg-green-600">
                        <label for="rememberMe" class="text-xl font-medium">I've read and Accept <a href="" class="font-bold text-green-700 hover:text-green-900"> Terms & Conditions</a></label>
                    </div>
                    <div class="flex items-center py-3">
                        <input type="checkbox" name="rememberMe" class="w-6 h-6 mr-3 text-lg bg-green-600">
                        <label for="rememberMe" class="text-xl font-medium">Remember me</label>
                    </div> --}}

                    <div class="flex justify-end mt-5">
                        <button id="prevBtn" class="py-3 mx-5 text-xl font-semibold text-white bg-green-700 rounded-xl px-7 hover:bg-green-900"><i class="fa-solid fa-arrow-right fa-rotate-180" style="color: #ffffff;"> </i>    Back</button>
                        <button id="nextBtn2" class="py-3 text-xl font-semibold text-white bg-green-700 rounded-xl px-7 hover:bg-green-900">Next <i class="fa-solid fa-arrow-right" style="color: #ffffff;"> </i></button>

                    </div>
                </div>
                <div class="relative flex justify-center w-4/5 py-2 mx-auto mt-6" id="register">
                    <p class="text-xl font-normal">Already have an account? <a href="{{ url('/learner') }}" class="text-xl font-semibold text-green-700 hover:text-green-900">Sign In</a></p>
                </div>
        
            </div>

            <div id="securityCodeForm" class="relative hidden w-4/5 mx-auto mt-10">
                <div id="Registertitle" class="relative w-full mx-auto my-14">
                    <h1 class="text-5xl font-bold text-black">About your Business</h1>
                    <p class="mt-2 text-lg font-light">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Est voluptate ut, facere repellendus earum, at corrupti praesentium consectetur dignissimos,</p>
                </div>


               <div class="w-full my-5">
                    <label for="instructor_security_code">Security Code:</label>
                    <input class="code mx-1 h-16 text-center shadow outline-none focus:ring-black focus:ring-[1px]" type="password" name="security_code_1" id="" maxlength="1" size="1" min="0" max="9" pattern="{0-9}{1}" autofocus>
                    <input class="code h-16 mx-1 text-center shadow outline-none focus:ring-black focus:ring-[1px]" type="password" name="security_code_2" id="" maxlength="1" size="1" min="0" max="9" pattern="{0-9}{1}">
                    <input class="code h-16 mx-1 text-center shadow outline-none focus:ring-black focus:ring-[1px]" type="password" name="security_code_3" id="" maxlength="1" size="1" min="0" max="9" pattern="{0-9}{1}">
                    <input class="code h-16 mx-1 text-center shadow outline-none focus:ring-black focus:ring-[1px]" type="password" name="security_code_4" id="" maxlength="1" size="1" min="0" max="9" pattern="{0-9}{1}">
                    <input class="code h-16 mx-1 text-center shadow outline-none focus:ring-black focus:ring-[1px]" type="password" name="security_code_5" id="" maxlength="1" size="1" min="0" max="9" pattern="{0-9}{1}">
                    <input class="code h-16 mx-1 text-center shadow outline-none focus:ring-black focus:ring-[1px]" type="password" name="security_code_6" id="" maxlength="1" size="1" min="0" max="9" pattern="{0-9}{1}">

                    
                    <div class="relative py-5 mt-10 border-t-2 border-green-800">
                        <div class="flex items-center py-3">
                            <input type="checkbox" name="rememberMe" class="w-6 h-6 mr-3 text-lg bg-green-600">
                            <label for="rememberMe" class="text-xl font-medium">I've read and Accept <a href="" class="font-bold text-green-700 hover:text-green-900"> Terms & Conditions</a></label>
                        </div>
                        <div class="flex items-center py-3">
                            <input type="checkbox" name="rememberMe" class="w-6 h-6 mr-3 text-lg bg-green-600">
                            <label for="rememberMe" class="text-xl font-medium">Remember me</label>
                        </div>
    
                        <div class="flex justify-end mt-5">
                            <button id="prevBtn2" class="py-3 mx-5 text-xl font-semibold text-white bg-green-700 rounded-xl px-7 hover:bg-green-900"><i class="fa-solid fa-arrow-right fa-rotate-180" style="color: #ffffff;"> </i>    Back</button>
                            <button type="submit" class="py-3 text-xl font-semibold text-white bg-green-700 rounded-xl px-7 hover:bg-green-900">Create my Account</button>
    
                        </div>
                    </div>
                    <script>
                    
                        const inputFields = document.querySelectorAll('.code');
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
            </div>



        </form>

       

    </div>
    
    <div id="RegisterRight" class="relative right-0 w-1/2 h-full bg-seagreen">
        {{-- //put those extra content to it --}}
    </div>

</section>

<script>
    // Add event listener to restrict input to numbers only
    document.getElementById("contactno").addEventListener("input", function(event) {
        event.target.value = event.target.value.replace(/\D/g, "");
    });
</script>



@include('partials.footer')