@extends('layouts.admin_layout')

@section('content')
    <section id="AD002_IA_container" class="relative w-full h-screen px-4 overflow-auto pt-28 md:w-3/4 lg:w-10/12 md:pt-16">

        <div id="AD002_IA_title" class="relative flex items-center justify-between px-3 mx-auto my-3 text-black">
            <h1 class="py-4 text-2xl font-semibold">Add New Instructor</h1>
            <div id="adminuser" class="items-center hidden lg:flex">
                <h3 class="text-lg">{{ $adminCodeName }}</h3>
                <div id="icon" class="w-10 h-10 mx-3 rounded-full bg-slate-400"></div>
            </div>
        </div>
        <div id="AD002_IA_maincontainer" class="relative w-full px-2 text-black shadow-lg rounded-2xl">
            <div class="mb-5">
                <a href="/admin/instructors" class="">
                    <i class="text-xl fa-solid fa-arrow-left" style="color: #000000;"></i>
                </a>
            </div>

            <form action="/admin/add_instructor" method="POST" enctype="multipart/form-data">
                @csrf
            <div id="AD002_IA_content" class="flex flex-col w-full text-base lg:flex-row lg:flex-wrap lg:flex-grow">
                <div id="AD002_IA_personal_details_container" class="my-5">
                    <h3 class="mb-5 text-xl font-medium border-b-2 border-b-black">Personal Details</h3>
                    <div id="namefield" class="flex justify-between w-full mt-5">
                        <h4 class="w-2/5 ml-3 font-medium ">Name</h4>
                        <div id="AD002_IA_name" class="w-3/5">
                            <div class="mb-3">
                                <label for="instructor_fname" class="font-regular md">First Name</label>
                                <br>
                                <input type="text" name="instructor_fname" class="w-full p-2 border-2 border-black rounded-md " placeholder="First Name" value="{{ old('instructor_fname') }}">
                                @error('instructor_fname')
                                <p class="p-1 mt-2 text-xs text-red-500">
                                    {{$message}}
                                </p>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="instructor_lname" class="font-regular md">Last Name</label><br>
                                <input type="text" name="instructor_lname" class="w-full p-2 border-2 border-black rounded-md "  placeholder="Last Name" value="{{ old('instructor_lname') }}">
                                @error('instructor_lname')
                                <p class="p-1 mt-2 text-xs text-red-500">
                                    {{$message}}
                                </p>
                                @enderror
                            </div>
                            
                        </div>
                    </div>
        
                    <div id="AD002_IA_bday_genderfield" class="">
                        <div id="bdayfield" class="flex justify-between w-full mt-5">
                            <h4 class="w-2/5 ml-3 font-medium">Birthday</h4>
                            <div class="w-3/5">
                                <label for="instructor_bday" class="hidden">Birthday</label>
                                <input type="date" name="instructor_bday" class="w-full p-2 border-2 border-black rounded-md " value="{{ old('instructor_bday') }}">
                                @error('instructor_bday')
                                <p class="p-1 mt-2 text-xs text-red-500">
                                    {{$message}}
                                </p>
                                @enderror
                            </div>
                        </div>
                        <div id="gender" class="flex justify-between w-full mt-5">
                            <h4 class="w-2/5 ml-3 font-medium">Gender</h4>
                            <div class="w-3/5">
                                <label for="instructor_gender" class="hidden">Gender</label>
                                <select name="instructor_gender" id="gender" class="w-full p-2 border-2 border-black rounded-md ">
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
        
                    <div id="AD002_IA_email" class="flex justify-between w-full mt-5">
                        <h4 class="w-2/5 ml-3 font-medium ">Email</h4>
                        <div class="w-3/5">
                            <label for="instructor_email" class="hidden">Email</label>
                            <input type="email" name="instructor_email" class="w-full p-2 border-2 border-black rounded-md" placeholder="Email" value="{{ old('instructor_email') }}">
                            @error('instructor_email')
                                <p class="p-1 mt-2 text-xs text-red-500">
                                    {{$message}}
                                </p>
                                @enderror
                        </div>
                    </div>
        
                    <div id="AD002_IA_contactno" class="flex justify-between w-full mt-5">
                        <h4 class="w-2/5 ml-3 font-medium">Contact Number</h4>
                        <div class="w-3/5">
                            <label for="instructor_contactno" class="hidden">Contact Number</label>
                            <input type="tel" id="instructor_contactno" maxlength="11" pattern="[0-9]{11}" name="instructor_contactno" class="w-full p-2 border-2 border-black rounded-md" placeholder="09" value="{{old('instructor_contactno')}}">
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
        
                <div id="AD002_IA_credentialsfields" class="my-5">
                    <h3 class="mb-5 text-xl font-medium border-b-2 border-b-black">Files</h3>
                    <div id="AD002_IA_credentials_container" class="mt-5">
                        <div id="AD002_IA_cv" class="flex justify-between w-full mt-5">
                            <h4 class="w-2/5 ml-3 font-medium">Curriculum Vitae or Resume</h4>
                            <div class="w-3/5">
                                <label for="instructor_credentials" class="">CV or Resume</label>
                                <input type="file" class="w-full p-2 border-2 border-black rounded-md" name="instructor_credentials" placeholder="" accept="application/pdf" value="{{old('instructor_credentials')}}">
                                @error('instructor_credentials')
                                <p class="p-1 mt-2 text-xs text-red-500">
                                    {{$message}}
                                </p>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div id="logindetailsfields" class="my-5">
                    <h3 class="mb-5 text-xl font-medium border-b-2 border-b-black">Login Details</h3>
                    <div id="logindetails_container" class="">
                        <div id="username" class="flex justify-between w-full mt-5">
                            <h4 class="w-2/5 ml-3 font-medium ">Username</h4>
                            <div class="w-3/5">
                                <label for="instructor_username" class="hidden">Username</label>
                                <input type="text" name="instructor_username" class="w-full p-2 border-2 border-black rounded-md w-15" placeholder="Username" value="{{ old('instructor_username') }}">
                            </div>
                            @error('instructor_username')
                                <p class="p-1 mt-2 text-xs text-red-500">
                                    {{$message}}
                                </p>
                                @enderror
                        </div>
        
                        <div id="" class="flex justify-between w-full mt-5">
                            <h4 class="w-2/5 ml-3 font-medium ">Password</h4>
                            <div class="w-3/5">
                                <label for="password" class="hidden">Password</label>
                                <input type="password" name="password" class="w-full p-2 border-2 border-black rounded-md w-15" placeholder="Password">
                                @error('password')
                                <p class="p-1 mt-2 text-xs text-red-500">
                                    {{$message}}
                                </p>
                                @enderror
                            </div>
                        </div>
        
                        <div id="" class="flex justify-between w-full mt-5">
                            <h4 class="w-2/5 ml-3 font-medium ">Cofirm Password</h4>
                            <div class="w-3/5">
                                <label for="password_confirmation" class="hidden">Cofirm Password</label>
                                <input type="password" name="password_confirmation" class="w-full p-2 border-2 border-black rounded-md w-15" placeholder="Confirm Password">
                                @error('password_confirmation')
                                <p class="p-1 mt-2 text-xs text-red-500">
                                    {{$message}}
                                </p>
                                @enderror
                            </div>
                        </div>
        
                        <div id="securitynum" class="flex justify-between w-full mt-5">
                            <h4 class="w-2/5 ml-3 font-medium md:">SecurityCode</h4>
                            <div class="w-3/5">
                                <label for="instructor_security_code" class="hidden">SecurityCode</label>
                                <input type="password" maxlength="6" name="instructor_security_code" class="w-full p-2 border-2 border-black rounded-md w-15" placeholder="Seucrity Code">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                
        

        
                <div id="button_container" class="pt-5 mx-auto mt-16 text-center border-2 border-t-black">
                    <a href="/admin/instructors" class="px-5 py-5 text-xl font-medium text-white bg-red-600 md:text-2xl hover:bg-red-900 rounded-xl">Cancel</a>
                    <button type="submit" class="px-5 py-5 text-xl font-medium text-white bg-green-600 md:text-2xl hover:bg-green-900 rounded-xl">Add New</button>
                </div>
            </form>
        </div>
        
        
    </section>    
@endsection
