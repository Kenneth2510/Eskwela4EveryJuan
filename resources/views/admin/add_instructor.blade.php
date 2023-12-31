@include('partials.header')
@include('partials.sidebar')

<section id="AD002_IA_container" class="relative w-4/5 h-full left-80">

    <div id="AD002_IA_title" class="relative flex items-center justify-between h-16 px-3 mx-auto my-3 py-auto">
        <h1 class="text-4xl font-semibold">Add New Instructor</h1>
        <div id="adminuser" class="flex items-center">
            <h3 class="text-lg">{{ $adminCodeName }}</h3>
            <div id="icon" class="w-10 h-10 mx-3 rounded-full bg-slate-400"></div>
        </div>
    </div>

    <div id="AD002_IA_maincontainer" class="relative max-h-full px-5 py-5 shadow-2xl bg-white mt-7 rounded-2xl">
        <div class="mb-5">
            <a href="/admin/instructors" class="">
                <i class="text-2xl md:text-3xl fa-solid fa-arrow-left" style="color: #000000;"></i>
            </a>
        </div>

        <form action="/admin/add_instructor" method="POST" enctype="multipart/form-data">
            @csrf
        <div id="AD002_IA_content" class="smallpc:flex smallpc:items-start">
            <div id="AD002_IA_personal_details_container" class="mx-auto my-5 smallpc:w-6/12">
                <h3 class="mb-5 text-3xl font-medium border-b-2 md:text-4xl border-b-black">Personal Details</h3>
                <div id="namefield" class="flex mt-5">
                    <h4 class="w-32 ml-3 text-lg font-medium md:w-40 md:text-2xl">Name</h4>
                    <div id="AD002_IA_name" class="block">
                        <div class="mb-3">
                            <label for="instructor_fname" class="text-md font-regular md:text-lg">First Name</label>
                            <br>
                            <input type="text" name="instructor_fname" class="px-3 py-2 text-lg border-2 border-black rounded-md md:text-xl w-15" placeholder="First Name" value="{{ old('instructor_fname') }}">
                            @error('instructor_fname')
                            <p class="p-1 mt-2 text-xs text-red-500">
                                {{$message}}
                            </p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="instructor_lname" class="text-md font-regular md:text-lg">Last Name</label><br>
                            <input type="text" name="instructor_lname" class="px-3 py-2 text-lg border-2 border-black rounded-md md:text-xl w-15"  placeholder="Last Name" value="{{ old('instructor_lname') }}">
                            @error('instructor_lname')
                            <p class="p-1 mt-2 text-xs text-red-500">
                                {{$message}}
                            </p>
                            @enderror
                        </div>
                        
                    </div>
                </div>
    
                <div id="AD002_IA_bday_genderfield" class="">
                    <div id="bdayfield" class="flex mt-5">
                        <h4 class="w-32 ml-3 text-lg font-medium md:w-40 md:text-2xl">Birthday</h4>
                        <div class="">
                            <label for="instructor_bday" class="hidden">Birthday</label>
                            <input type="date" name="instructor_bday" class="px-3 py-2 text-lg border-2 border-black rounded-md md:text-xl w-15" value="{{ old('instructor_bday') }}">
                            @error('instructor_bday')
                            <p class="p-1 mt-2 text-xs text-red-500">
                                {{$message}}
                            </p>
                            @enderror
                        </div>
                    </div>
                    <div id="gender" class="flex mt-5">
                        <h4 class="w-32 ml-3 text-lg font-medium md:w-40 md:text-2xl">Gender</h4>
                        <div class="">
                            <label for="instructor_gender" class="hidden">Gender</label>
                            <select name="instructor_gender" id="gender" class="px-3 py-2 text-lg border-2 border-black rounded-md md:text-xl w-15">
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
                </div>
    
                <div id="AD002_IA_email" class="flex mt-5">
                    <h4 class="w-32 ml-3 text-lg font-medium md:w-40 md:text-2xl">Email</h4>
                    <div class="">
                        <label for="instructor_email" class="hidden">Email</label>
                        <input type="email" name="instructor_email" class="px-3 py-2 text-lg border-2 border-black rounded-md w-15 md:text-xl" placeholder="Email" value="{{ old('instructor_email') }}">
                        @error('instructor_email')
                            <p class="p-1 mt-2 text-xs text-red-500">
                                {{$message}}
                            </p>
                            @enderror
                    </div>
                </div>
    
                <div id="AD002_IA_contactno" class="flex mt-5">
                    <h4 class="w-32 ml-3 text-lg font-medium leading-5 md:w-40 md:text-2xl">Contact Number</h4>
                    <div class="">
                        <label for="instructor_contactno" class="hidden">Contact Number</label>
                        <input type="tel" id="instructor_contactno" maxlength="11" pattern="[0-9]{11}" name="instructor_contactno" class="px-3 py-2 text-lg border-2 border-black rounded-md w-15 md:text-xl" placeholder="09" value="{{old('instructor_contactno')}}">
                        @error('instructor_contactno')
                            <p class="p-1 mt-2 text-xs text-red-500">
                                {{$message}}
                            </p>
                            @enderror
                    </div>
                </div>
    
                <script>
                    // Add event listener to restrict input to numbers only
                    document.getElementById("contactno").addEventListener("input", function(event) {
                        event.target.value = event.target.value.replace(/\D/g, "");
                    });
                </script>
    
            </div>
    
            <div id="AD002_IA_credentialsfields" class="mx-auto my-5 mt-16 smallpc:w-6/12 smallpc:mt-5">
                <h3 class="mb-5 text-3xl font-medium border-b-2 border-b-black md:text-4xl">Files</h3>
                <div id="AD002_IA_credentials_container" class="mt-5">
                    <div id="AD002_IA_cv" class="flex">
                        <h4 class="w-40 ml-3 text-lg font-medium leading-5 md:w-60 md:text-2xl">Curriculum Vitae or Resume</h4>
                        <div class="ml-4">
                            <label for="instructor_credentials" class="hidden">CV or Resume</label>
                            <input type="file" class="px-3 py-2 text-lg border-2 border-black rounded-md w-80 md:text-xl" name="instructor_credentials" placeholder="" accept="application/pdf" value="{{old('instructor_credentials')}}">
                            @error('instructor_credentials')
                            <p class="p-1 mt-2 text-xs text-red-500">
                                {{$message}}
                            </p>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

        </div>
            
    
            <div id="logindetailsfields" class="mx-auto my-5 mt-16 smallpc:w-6/12">
                <h3 class="mb-5 text-3xl font-medium border-b-2 border-b-black md:text-4xl">Login Details</h3>
                <div id="logindetails_container" class="">
                    <div id="username" class="flex">
                        <h4 class="w-32 ml-3 text-lg font-medium leading-5 md:w-60 md:text-2xl">Username</h4>
                        <div class="">
                            <label for="instructor_username" class="hidden">Username</label>
                            <input type="text" name="instructor_username" class="px-3 py-2 text-lg border-2 border-black rounded-md md:text-xl w-15" placeholder="Username" value="{{ old('instructor_username') }}">
                        </div>
                        @error('instructor_username')
                            <p class="p-1 mt-2 text-xs text-red-500">
                                {{$message}}
                            </p>
                            @enderror
                    </div>
    
                    <div id="" class="flex mt-5">
                        <h4 class="w-32 ml-3 text-lg font-medium leading-5 md:w-60 md:text-2xl">Password</h4>
                        <div class="">
                            <label for="password" class="hidden">Password</label>
                            <input type="password" name="password" class="px-3 py-2 text-lg border-2 border-black rounded-md md:text-xl w-15" placeholder="Password">
                            @error('password')
                            <p class="p-1 mt-2 text-xs text-red-500">
                                {{$message}}
                            </p>
                            @enderror
                        </div>
                    </div>
    
                    <div id="" class="flex mt-5">
                        <h4 class="w-32 ml-3 text-lg font-medium leading-5 md:w-60 md:text-2xl">Cofirm Password</h4>
                        <div class="">
                            <label for="password_confirmation" class="hidden">Cofirm Password</label>
                            <input type="password" name="password_confirmation" class="px-3 py-2 text-lg border-2 border-black rounded-md md:text-xl w-15" placeholder="Confirm Password">
                            @error('password_confirmation')
                            <p class="p-1 mt-2 text-xs text-red-500">
                                {{$message}}
                            </p>
                            @enderror
                        </div>
                    </div>
    
                    <div id="securitynum" class="flex mt-5">
                        <h4 class="w-32 ml-3 text-lg font-medium leading-5 md:w-60 md:text-2xl">SecurityCode</h4>
                        <div class="">
                            <label for="instructor_security_code" class="hidden">SecurityCode</label>
                            <input type="password" maxlength="6" name="instructor_security_code" class="px-3 py-2 text-lg border-2 border-black rounded-md md:text-xl w-15" placeholder="Seucrity Code">
                        </div>
                    </div>
                </div>
            </div>
    
            <div id="button_container" class="pt-5 mx-auto mt-16 text-center border-2 border-t-black">
                <a href="/admin/instructors" class="px-5 py-5 text-xl font-medium text-white bg-red-600 md:text-2xl hover:bg-red-900 rounded-xl">cancel</a>
                <button type="submit" class="px-5 py-5 text-xl font-medium text-white bg-green-600 md:text-2xl hover:bg-green-900 rounded-xl">Add New</button>
            </div>
        </form>
    </div>
    
    
</section>

@include('partials.footer')