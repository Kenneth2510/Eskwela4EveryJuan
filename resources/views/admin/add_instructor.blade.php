@include('partials.header')

<section id="AD_SB_sidebarfull" class="fixed top-0 left-0 z-20 w-16 h-full max-w-lg mx-auto px-auto smallpc:w-64 md:w-16 lg:w-64 bg-seagreen">
    <div id="AD_SB_sidebarfull_menu" class="relative w-full mt-5 text-center">
        <h1 class="hidden mx-1 text-2xl font-semibold text-white lg:block">Eskwela4EveryJuan</h1>
        <button class="">
            <i class="text-3xl fa-solid fa-bars" style="color: #ffffff;"></i>
        </button>
    </div>

    <div id="AD_SB_sidebar" class="relative w-16 mx-auto smallpc:w-64 lg:w-64 lg:px-5">
        <ul class="mx-auto list-none list-inside my-28">
            <li class="py-5 rounded-lg hover:bg-green-100 hover:bg-opacity-10 group ">
                <a href="/admin/dashboard">
                <div class="flex items-center px-3 rounded-lg" id="dashboard">
                    <i class="w-12 text-2xl text-center fa-solid fa-house px-auto group-hover:text-3xl" style="color: #ffffff;"></i>
                    <h3 class="hidden px-3 text-xl font-normal text-white lg:block group-hover:text-black group-hover:text-xl group-hover:font-semibold">Dashboard</h3>
                </div>
            </a></li>

            <li class="py-5 rounded-lg hover:bg-green-100 hover:bg-opacity-10 group">
                <a href="/admin/learners">
                <div class="flex items-center px-3 rounded-lg" id="learners">
                    <i class="w-12 text-2xl text-center fa-solid fa-user px-auto group-hover:text-3xl" style="color: #ffffff;"></i>
                    <h3 class="hidden px-3 text-xl font-normal text-white lg:block group-hover:text-black group-hover:text-xl group-hover:font-semibold">Learners</h3>
                </div>
            </a></li>


            <li class="py-5 rounded-lg hover:bg-green-100 hover:bg-opacity-10 group selected">
                <a href="/admin/instructors">
                <div class="flex items-center px-3 rounded-lg" id="instructors">
                    <i class="w-12 text-2xl text-center fa-solid fa-user-graduate px-auto group-hover:text-3xl" style="color: #ffffff;"></i>
                    <h3 class="hidden px-3 text-xl font-normal text-white lg:block group-hover:text-black group-hover:text-xl group-hover:font-semibold">Instructors</h3>
                </div>
            </a></li>

            <li class="py-5 rounded-lg hover:bg-green-100 hover:bg-opacity-10 group">
                <a href="">
                <div class="flex items-center px-3 rounded-lg" id="courses">
                    <i class="w-12 text-2xl text-center fa-solid fa-book px-auto group-hover:text-3xl" style="color: #ffffff;"></i>
                    <h3 class="hidden px-3 text-xl font-normal text-white lg:block group-hover:text-black group-hover:text-xl group-hover:font-semibold">Courses</h3>
                </div>
            </a></li>

            <li class="py-5 rounded-lg hover:bg-green-100 hover:bg-opacity-10 group">
                <a href="">
                <div class="flex items-center px-3 rounded-lg" id="performance">
                    <i class="w-12 text-2xl text-center fa-solid fa-chart-simple px-auto group-hover:text-3xl" style="color: #ffffff;"></i>
                    <h3 class="hidden px-3 text-xl font-normal text-white lg:block group-hover:text-black group-hover:text-xl group-hover:font-semibold">Performance</h3>
                </div>
            </a></li>

            <li class="py-5 rounded-lg hover:bg-green-100 hover:bg-opacity-10 group">
                <a href="">
                <div class="flex items-center px-3 rounded-lg" id="settings">
                    <i class="w-12 text-2xl text-center fa-solid fa-gear px-auto group-hover:text-3xl" style="color: #ffffff;"></i>
                    <h3 class="hidden px-3 text-xl font-normal text-white lg:block group-hover:text-black group-hover:text-xl group-hover:font-semibold">Settings</h3>
                </div>
            </a></li>


            <li class="py-5 mt-24 rounded-lg hover:bg-green-100 hover:bg-opacity-10 group">
                <a href="">
                <div class="flex items-center px-3 py-5 mx-auto text-xl font-medium text-white bg-darthmouthgreen rounded-2xl hover:bg-green-900" id="logout">
                    <i class="w-12 text-2xl text-center fa-solid fa-right-from-bracket px-auto group-hover:text-3xl" style="color: #ffffff;"></i>
                    <h3 class="hidden px-3 text-xl font-normal text-white lg:block group-hover:text-black group-hover:text-xl group-hover:font-semibold">Logout</h3>
                </div>
            </a></li>

        </ul>  
    </div>

    {{-- <div id="logout" class="flex justify-center py-5 mx-auto text-xl font-medium text-white bg-darthmouthgreen px-14 rounded-2xl hover:bg-green-900">
        <a href="" class="py-5 mx-auto text-xl font-medium text-white bg-darthmouthgreen px-14 rounded-2xl hover:bg-green-900">Logout</a>
        <a href="" class="">
            <div class="flex items-center " id="logout">
                <i class="w-12 text-2xl text-center fa-solid fa-right-from-bracket px-auto group-hover:text-3x" style="color: #ffffff;"></i>
                <h3 class="hidden px-3 text-xl font-normal text-white group-hover:text-black group-hover:text-xl group-hover:font-semibold">Settings</h3>
            </div>
        </a>
    </div> --}}
</section>

<section id="AD002_IA_container" class="relative ml-16 md:ml-16 lg:ml-64">

    <div id="AD002_IA_title" class="relative flex items-center justify-between h-16 px-3 mx-auto my-3 py-auto">
        <h1 class="text-4xl font-semibold">Add New Instructor</h1>
        <div id="adminuser" class="flex items-center">
            <h3 class="text-lg">admin</h3>
            <div id="icon" class="w-10 h-10 mx-3 rounded-full bg-slate-400"></div>
        </div>
    </div>

    <div id="AD002_IA_maincontainer" class="relative h-full px-5 py-5 mx-5 mt-5 bg-white shadow-2xl rounded-xl">
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
    
                    <div id="password" class="flex mt-5">
                        <h4 class="w-32 ml-3 text-lg font-medium leading-5 md:w-60 md:text-2xl">Password</h4>
                        <div class="">
                            <label for="instructor_password" class="hidden">Password</label>
                            <input type="password" name="instructor_password" class="px-3 py-2 text-lg border-2 border-black rounded-md md:text-xl w-15" placeholder="Password">
                            @error('instructor_password')
                            <p class="p-1 mt-2 text-xs text-red-500">
                                {{$message}}
                            </p>
                            @enderror
                        </div>
                    </div>
    
                    <div id="password_confirm" class="flex mt-5">
                        <h4 class="w-32 ml-3 text-lg font-medium leading-5 md:w-60 md:text-2xl">Cofirm Password</h4>
                        <div class="">
                            <label for="instructor_password_confirmation" class="hidden">Cofirm Password</label>
                            <input type="password" name="instructor_password_confirmation" class="px-3 py-2 text-lg border-2 border-black rounded-md md:text-xl w-15" placeholder="Confirm Password">
                            @error('instructor_password_confirmation')
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