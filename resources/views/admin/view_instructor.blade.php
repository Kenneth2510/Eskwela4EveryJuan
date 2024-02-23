@extends('layouts.admin_layout')

@section('content')
    <section id="AD002_IA_view_learner_container" class="relative w-full h-screen px-4 overflow-auto pt-28 md:w-3/4 lg:w-10/12 md:pt-16">

        <div id="AD002_IA_title" class="relative flex items-center justify-between px-3 mx-auto my-3 text-black">
            <h1 class="py-4 text-2xl font-semibold">View Instructor Details</h1>
            <div id="adminuser" class="items-center hidden lg:flex">
                <h3 class="text-lg">{{ $adminCodeName }}</h3>
                <div id="icon" class="w-10 h-10 mx-3 rounded-full bg-slate-400"></div>
            </div>
        </div>

        <div id="AD002_IA_maincontainer" class="relative w-full px-2 text-black shadow-lg rounded-2xl">
            <div class="mb-5">
                <a href="{{ url('/admin/instructors') }}" class="">
                    <i class="text-xl fa-solid fa-arrow-left" style="color: #000000;"></i>
                </a>
            </div>
            
            <div id="icon" class="w-32 h-32 mx-auto my-3 bg-gray-400 rounded-full">
                <img class="w-32 h-32 mx-auto my-3 bg-gray-400 rounded-full" src="{{ asset('storage/' . $instructor->profile_picture) }}
                                    " alt="Profile Picture">
            </div>
            <div id="AD002_IA_instructor_status" class="flex items-center justify-center ">
                
                <h3 class="mx-3 text-lg font-semibold">Account Status: </h3>
                @if ($instructor->status == 'Approved')
                <div id="status" class="mx-1 text-lg text-center bg-green-500 py-auto w-28 rounded-xl">Approved</div>
                <div id="button" class="flex flex-col hidden mx-4">
                    <form action="/admin/pending_instructor/{{$instructor->instructor_id}}" method="POST">
                        @method('put')
                        @csrf
                        <button class="my-1 text-lg text-center bg-yellow-300 py-auto w-28 rounded-xl hover:bg-yellow-500 hover:text-white">pending</button>
                    </form>
                    <form action="/admin/reject_instructor/{{$instructor->instructor_id}}" method="POST">
                        @method('PUT')
                        @csrf
                        <button class="my-1 text-lg text-center bg-red-500 py-auto w-28 rounded-xl hover:bg-red-700 hover:text-white">reject</button>
                    </form>
                </div> 
            @elseif ($instructor->status == 'Rejected')
                <div id="status" class="mx-1 text-lg text-center bg-red-500 py-auto w-28 rounded-xl">Rejected</div>
                <div id="button" class="flex flex-col hidden mx-4">
                    <form action="/admin/pending_instructor/{{$instructor->instructor_id}}" method="POST">
                        @method('put')
                        @csrf
                        <button class="my-1 text-lg text-center bg-yellow-300 py-auto w-28 rounded-xl hover:bg-yellow-500 hover:text-white">pending</button>
                    </form>
                    <form action="/admin/approve_instructor/{{$instructor->instructor_id}}" method="POST">
                        @method('put')
                        @csrf
                        <button type="submit" class="my-1 text-lg text-center bg-green-500 py-auto w-28 rounded-xl hover:bg-green-700 hover:text-white">approve</button>
                    </form>
                </div> 
            @else 
                <div id="status" class="mx-1 text-lg text-center bg-yellow-300 py-auto w-28 rounded-xl">pending</div>
                <div id="button" class="flex flex-col hidden mx-4">
                    <form action="/admin/approve_instructor/{{$instructor->instructor_id}}" method="POST">
                        @method('put')
                        @csrf
                        <button type="submit" class="my-1 text-lg text-center bg-green-500 py-auto w-28 rounded-xl hover:bg-green-700 hover:text-white">approve</button>
                    </form>
                    
                    <form action="/admin/reject_instructor/{{$instructor->instructor_id}}" method="POST">
                        @method('PUT')
                        @csrf
                        <button class="my-1 text-lg text-center bg-red-500 py-auto w-28 rounded-xl hover:bg-red-700 hover:text-white">reject</button>
                    </form>
                    
                </div> 
            @endif
            </div>

            {{-- <form action="/admin/view_instructor/{{ $instructor->instructor_id }}" id="instructor_updateData_form" data-instructor-id="{{ $instructor->instructor_id }}" enctype="multipart/form-data"> --}}

                
            <form action="/admin/view_instructor/{{$instructor->instructor_id}}" method="POST" enctype="multipart/form-data">
                @method('PUT');
                @csrf
            <div id="AD002_IV_maincontainer" class="flex flex-col w-full text-base lg:flex-row lg:flex-wrap lg:flex-grow">
                <div id="AD002_IV_personal_details_container" class="my-5">
                    <h3 class="mb-5 text-xl font-medium border-b-2 border-b-black">Personal Details</h3>
                    <div id="AD002_IV_namefield" class="flex justify-between w-full mt-5">
                        <h4 class="w-2/5 ml-3 font-medium ">Name</h4>
                        <div class="w-3/5">
                            <div class="mb-3">
                                <label for="instructor_fname" class=" font-regular">First Name</label>
                                <br>
                                <input id="instructor_fname" type="text" name="instructor_fname" class="w-full px-3 py-2 border-2 rounded-md" placeholder="First Name" disabled value="{{$instructor->instructor_fname}}">
                                @error('instructorfname')
                                <p class="p-1 mt-2 text-xs text-red-500">
                                    {{$message}}
                                </p>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="instructor_lname" class=" font-regular">Last Name</label><br>
                                <input id="instructor_lname" type="text" name="instructor_lname" class="w-full px-3 py-2 border-2 rounded-md"  placeholder="Last Name" disabled value="{{$instructor->instructor_lname}}">
                                @error('instructor_lname')
                                <p class="p-1 mt-2 text-xs text-red-500">
                                    {{$message}}
                                </p>
                                @enderror
                            </div>
                            
                        </div>
                    </div>
        
                    <div id="AD002_IV_bday_genderfield" class="">
                        <div id="AD002_IV_bdayfield" class="flex justify-between w-full mt-5">
                            <h4 class="w-2/5 ml-3 font-medium ">Birthday</h4>
                            <div class="w-3/5">
                                <label for="instructor_bday" class="hidden">Birthday</label>
                                <input id="instructor_bday" type="date" name="instructor_bday" class="w-full px-3 py-2 border-2 rounded-md" disabled value="{{$instructor->instructor_bday}}">
                                @error('instructor_bday')
                                <p class="p-1 mt-2 text-xs text-red-500">
                                    {{$message}}
                                </p>
                                @enderror
                            </div>
                        </div>
                        <div id="AD002_IV_genderfield" class="flex justify-between w-full mt-5">
                            <h4 class="w-2/5 ml-3 font-medium ">Gender</h4>
                            <div class="w-3/5">
                                <label for="instructor_gender" class="hidden">Gender</label>
                                <select name="instructor_gender" id="instructor_gender" class="w-full px-3 py-2 border-2 rounded-md " disabled>
                                    <option value="" {{ $instructor->instructor_gender == "" ? 'selected': '' }} class=""></option>
                                    <option value="Male" {{ $instructor->instructor_gender == "Male" ? 'selected': '' }} class="">Male</option>
                                    <option value="Female" {{ $instructor->instructor_gender == "Female" ? 'selected': '' }} class="">Female</option>
                                    <option value="Others" {{ $instructor->instructor_gender == "Others" ? 'selected': '' }} class="">Preferred not to say</option>
                                </select>
                                @error('instructor_gender')
                                <p class="p-1 mt-2 text-xs text-red-500">
                                    {{$message}}
                                </p>
                                @enderror
                            </div>
                        </div>
                    </div>
        
                    <div id="AD002_IV_emailfield" class="flex justify-between w-full mt-5">
                        <h4 class="w-2/5 ml-3 font-medium ">Email</h4>
                        <div class="w-3/5">
                            <label for="instructor_email" class="hidden">Email</label>
                            <input id="instructor_email" type="email" name="instructor_email" class="w-full px-3 py-2 border-2 rounded-md" placeholder="Email" disabled value="{{$instructor->instructor_email}}">
                            @error('instructor_email')
                                <p class="p-1 mt-2 text-xs text-red-500">
                                    {{$message}}
                                </p>
                                @enderror
                        </div>
                    </div>
        
                    <div id="AD002_IV_contactno" class="flex justify-between w-full mt-5">
                        <h4 class="w-2/5 ml-3 font-medium">Contact Number</h4>
                        <div class="w-3/5">
                            <label for="instructor_contactno" class="hidden">Contact Number</label>
                            <input type="tel" id="instructor_contactno" maxlength="11" pattern="[0-9]{11}" name="instructor_contactno" class="w-full px-3 py-2 border-2 rounded-md" placeholder="09" disabled value="{{$instructor->instructor_contactno}}">
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
        
                <div id="AD002_IV_credentialsfields" class="my-5">
                    <h3 class="mb-5 text-xl font-medium border-b-2 border-b-black">Files</h3>
                    <div id="AD002_IV_credentials_container" class="mt-5">
                        <div id="AD002_IV_cv_resume" class="flex justify-between w-full mt-5">
                            <h4 class="w-2/5 ml-3 font-medium ">Curriculum Vitae or Resume</h4>
                            <div class="w-3/5">
                                <label for="instructor_credentials" class="hidden">CV or Resume</label>
                                @if($instructor->instructor_credentials)
                                    @php
                                        $pathParts = explode('/', $instructor->instructor_credentials);
                                        $filename = end($pathParts);
                                        $fileurl = asset("storage/$instructor->instructor_credentials");
                                    @endphp
                                <p class="">File: <a href="{{ $fileurl }}" target="_blank">{{$filename}}</a></p>
                                @else
                                <p class="">No file Uploaded</p>
                                @endif
                                <input id="instructor_credentials" type="file" accept="application/pdf" class="w-full px-3 py-2 border-2 rounded-md" name="instructor_credentials" placeholder="instructor_credentials" disabled value="{{$instructor->instructor_credentials}}">
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
                        <div id="usernamefield" class="flex justify-between w-full mt-5">
                            <h4 class="w-2/5 ml-3 font-medium ">Username</h4>
                            <div class="w-3/5">
                                <label for="instructor_username" class="hidden">Username</label>
                                <input id="instructor_username" type="text" name="instructor_username" class="px-3 py-2 border-2 rounded-md " placeholder="Username" disabled value="{{ $instructor->instructor_username }}">
                            </div>
                        </div>
        
                        <div id="passwordfield" class="flex justify-between w-full mt-5">
                            <h4 class="w-2/5 ml-3 font-medium ">Password</h4>
                            <div class="w-3/5">
                                <label for="instructor_password" class="hidden">Password</label>
                                <input id="instructor_password" type="password" name="instructor_password" class="px-3 py-2 border-2 rounded-md" placeholder="Password" disabled value="{{ $instructor->instructor_password }}">
                            </div>
                        </div>
        
                        <div id="password_confirmfield" class="flex justify-between w-full mt-5">
                            <h4 class="w-2/5 ml-3 font-medium ">Cofirm Password</h4>
                            <div class="w-3/5">
                                <label for="instructor_password_confirmation" class="hidden">Cofirm Password</label>
                                <input id="instructor_password_confirmation" type="password" name="instructor_password_confirmation" class="px-3 py-2 border-2 rounded-md" placeholder="Confirm Password" disabled>
                            </div>
                        </div>
        
                        <div id="securitynumfield" class="flex justify-between w-full mt-5">
                            <h4 class="w-2/5 ml-3 font-medium ">SecurityCode</h4>
                            <div class="w-3/5">
                                <label for="instructor_security_code" class="hidden">SecurityCode</label>
                                <input id="instructor_security_code" type="password" maxlength="6" name="instructor_security_code" class="px-3 py-2 border-2 rounded-md" placeholder="Seucrity Code" disabled value="{{ $instructor->instructor_security_code }}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                
        


                <div class="">
                    <h1>Created at: {{ $instructor->created_at }}</h1>
                    <h1>Last Modified at: {{ $instructor->updated_at }}</h1>
                </div>
        
                <div id="button_container" class="flex justify-center pt-5 mx-auto mt-16 text-center border-2 border-t-black">
                    <a href="{{ url('/admin/instructors') }}" id="return"class="px-5 py-5 mx-3 text-xl font-medium text-white bg-red-600 md:text-2xl hover:bg-red-900 rounded-xl">Return</a>
                    <button type="button" id="cancel" class="hidden px-5 py-5 mx-3 text-xl font-medium text-white bg-red-600 md:text-2xl hover:bg-red-900 rounded-xl">cancel</button>

                    <button type="button" id="instructor_edit_data" type="button" class="px-5 py-5 mx-3 text-xl font-medium text-white bg-green-600 md:text-2xl hover:bg-green-900 rounded-xl">Edit Data</button>
                    
                    <button id="instructor_update_data" type="button" class="hidden px-5 py-5 mx-3 text-xl font-medium text-white bg-green-600 md:text-2xl hover:bg-green-900 rounded-xl">Apply Changes</button>

                    <div id="updateInstructorModal" class="fixed top-0 left-0 flex items-center justify-center hidden w-screen h-screen bg-black bg-opacity-50">
                        <div class="p-5 text-center bg-white rounded-lg">
                            <p>Are you sure you want to update this instructor?</p>
                            <button type="submit" id="instructor_confirmUpdate" class="px-4 py-2 m-2 text-white bg-green-600 rounded-md">Confirm</button>
                            <button type="button" id="instructor_cancelUpdate" class="px-4 py-2 m-2 text-gray-700 bg-gray-400 rounded-md">Cancel</button>
                        </div>
                    </div>
                </form>

                    <button id="instructor_delete_data" type="button" class="hidden px-5 py-5 mx-3 text-xl font-medium text-white bg-red-600 md:text-2xl hover:bg-red-900 rounded-xl">Delete Data</button>

                    <div id="deleteInstructorModal" class="fixed top-0 left-0 flex items-center justify-center hidden w-screen h-screen bg-black bg-opacity-50">
                        <form id="instructor_deleteCourse" action="" data-instructor-id="{{ $instructor->instructor_id }}">
                            @csrf
                            <div class="p-5 text-center bg-white rounded-lg">
                                <p>Are you sure you want to delete this course?</p>
                                <button type="submit" id="instructor_confirmDelete" class="px-4 py-2 m-2 text-white bg-red-600 rounded-md">Confirm</button>
                                <button type="button" id="instructor_cancelDelete" class="px-4 py-2 m-2 text-gray-700 bg-gray-400 rounded-md">Cancel</button>
                            </div>
                        </form>
                        
                    </div>
                </div>
            </div>
            
        </div>

    </section>

    <script>
        // $(document).ready(function() {
        //     $('#edit_data').on('click', function(e) {
        //         e.preventDefault();

        //         // $('#password_confirmfield').removeClass('hidden');
        //         $('#button').removeClass('hidden');
        //         $('#update_data').removeClass('hidden');
        //         $('#delete_data').removeClass('hidden');
        //         $('#edit_data').addClass('hidden');
        //         $('#cancel').removeClass('hidden');
        //         $('#return').addClass('hidden');

        //         $('#instructor_fname').prop("disabled", false).focus();
        //         $('#instructor_lname').prop("disabled", false);
        //         $('#instructor_bday').prop("disabled", false);
        //         $('#instructor_gender').prop("disabled", false);
        //         // $('#instructor_email').prop("disabled", false);     9       
        //         $('#instructor_contactno').prop("disabled", false);
                        
        //         $('#instructor_credentials').prop("disabled", false);

        //         $('#instructor_username').prop("disabled", false);
        //         $('#instructor_username').prop("readonly", true);
        //         $('#instructor_password').prop("disabled", false);
        //         $('#instructor_password').prop("readonly", true);
        //         $('#instructor_password_confirmation').prop("disabled", false);
        //         $('#instructor_password_confirmation').prop("readonly", true);
        //         $('#instructor_security_code').prop("disabled", false);
        //         $('#instructor_security_code').prop("readonly", true);
        //     })
        // })
    </script>    
@endsection
