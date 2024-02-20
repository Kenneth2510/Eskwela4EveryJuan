@extends('layouts.admin_layout')

@section('content')
    <section id="view_learner_container" class="relative w-full h-screen px-4 overflow-auto pt-28 md:w-3/4 lg:w-10/12 md:pt-16">

        <div id="title" class="relative flex items-center justify-between px-3 mx-auto my-3 text-black">
            <h1 class="py-4 text-2xl font-semibold">View Learner Details</h1>
            <div id="adminuser" class="items-center hidden lg:flex">
                <h3 class="text-lg">{{ $adminCodeName }}</h3>
                <div id="icon" class="w-10 h-10 mx-3 rounded-full bg-slate-400"></div>
            </div>
        </div>

        <div id="maincontainer" class="relative w-full px-2 text-black shadow-lg rounded-2xl">
            <div class="mb-5">
                <a href="/admin/learners" class="">
                    <i class="text-xl fa-solid fa-arrow-left" style="color: #000000;"></i>
                </a>
            </div>
            
            <div id="icon" class="w-32 h-32 mx-auto my-3 bg-gray-400 rounded-full">
                <img class="w-32 h-32 mx-auto my-3 bg-gray-400 rounded-full" src="{{ asset('storage/' . $learner->profile_picture) }}
                                    " alt="Profile Picture">
            </div>
            <div id="learner_status" class="flex items-center justify-center ">
                
                <h3 class="mx-3 text-lg font-semibold">Account Status: </h3>
                @if ($learner->status == 'Approved')
                    <div id="status" class="mx-1 text-lg text-center bg-green-500 py-auto w-28 rounded-xl">Approved</div>
                    <div id="button" class="flex flex-col hidden mx-4">
                        <form action="/admin/pending_learner/{{$learner->learner_id}}" method="POST">
                            @method('put')
                            @csrf
                            <button class="my-1 text-lg text-center bg-yellow-300 py-auto w-28 rounded-xl hover:bg-yellow-500 hover:text-white">pending</button>
                        </form>
                        <form action="/admin/reject_learner/{{$learner->learner_id}}" method="POST">
                            @method('PUT')
                            @csrf
                            <button class="my-1 text-lg text-center bg-red-500 py-auto w-28 rounded-xl hover:bg-red-700 hover:text-white">reject</button>
                        </form>
                    </div> 
                @elseif ($learner->status == 'Rejected')
                    <div id="status" class="mx-1 text-lg text-center bg-red-500 py-auto w-28 rounded-xl">Rejected</div>
                    <div id="button" class="flex flex-col hidden mx-4">
                        <form action="/admin/pending_learner/{{$learner->learner_id}}" method="POST">
                            @method('put')
                            @csrf
                            <button class="my-1 text-lg text-center bg-yellow-300 py-auto w-28 rounded-xl hover:bg-yellow-500 hover:text-white">pending</button>
                        </form>
                        <form action="/admin/approve_learner/{{$learner->learner_id}}" method="POST">
                            @method('put')
                            @csrf
                            <button type="submit" class="my-1 text-lg text-center bg-green-500 py-auto w-28 rounded-xl hover:bg-green-700 hover:text-white">approve</button>
                        </form>
                    </div> 
                @else 
                    <div id="status" class="mx-1 text-lg text-center bg-yellow-300 py-auto w-28 rounded-xl">pending</div>
                    <div id="button" class="flex flex-col hidden mx-4">
                        <form action="/admin/approve_learner/{{$learner->learner_id}}" method="POST">
                            @method('put')
                            @csrf
                            <button type="submit" class="my-1 text-lg text-center bg-green-500 py-auto w-28 rounded-xl hover:bg-green-700 hover:text-white">approve</button>
                        </form>
                        
                        <form action="/admin/reject_learner/{{$learner->learner_id}}" method="POST">
                            @method('PUT')
                            @csrf
                            <button class="my-1 text-lg text-center bg-red-500 py-auto w-28 rounded-xl hover:bg-red-700 hover:text-white">reject</button>
                        </form>
                        
                    </div> 
                @endif
                
            </div>

            <form action="/admin/view_learner/{{$learner->learner_id}}" method="POST">
                @method('PUT')
                @csrf
            <div class="flex flex-col w-full text-base lg:flex-row lg:flex-wrap lg:flex-grow">
                <div id="personal_details_container" class="my-5">
                    <h3 class="mb-5 text-xl font-medium border-b-2 border-b-black">Personal Details</h3>
                    <div id="namefield" class="flex justify-between w-full mt-5">
                        <h4 class="w-2/5 ml-3 font-medium">Name</h4>
                        <div class="w-3/5">
                            <div class="mb-3">
                                <label for="learner_fname" class="font-regular">First Name</label>
                                <br>
                                <input id="learner_fname" type="text" name="learner_fname" class="w-full p-2 border-2 rounded-md" placeholder="First Name" disabled value="{{$learner->learner_fname}}" >
                                @error('learner_fname')
                                <p class="p-1 mt-2 text-xs text-red-500">
                                    {{$message}}
                                </p>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="learner_lname" class="font-regular">Last Name</label><br>
                                <input id="learner_lname" type="text" name="learner_lname" class="w-full p-2 border-2 rounded-md"  placeholder="Last Name" disabled value="{{$learner->learner_lname}}" >
                                @error('learner_lname')
                                <p class="p-1 mt-2 text-xs text-red-500">
                                    {{$message}}
                                </p>
                                @enderror
                            </div>
                            
                        </div>
                    </div>
        
                    <div id="bday_genderfield" class="">
                        <div id="bdayfield" class="flex justify-between w-full mt-5">
                            <h4 class="w-2/5 ml-3 font-medium">Birthday</h4>
                            <div class="w-3/5">
                                <label for="learner_bday" class="hidden">Birthday</label>
                                <input id="learner_bday" type="date" name="learner_bday" class="w-full p-2 border-2 rounded-md " disabled value="{{$learner->learner_bday}}" >
                                @error('learner_bday')
                                <p class="p-1 mt-2 text-xs text-red-500">
                                    {{$message}}
                                </p>
                                @enderror
                            </div>
                        </div>
                        <div id="genderfield" class="flex justify-between w-full mt-5">
                            <h4 class="w-2/5 ml-3 font-medium">Gender</h4>
                            <div class="w-3/5">
                                <label for="learner_gender" class="hidden">Gender</label>
                                <select name="learner_gender" id="learner_gender" class="w-full px-3 py-2 border-2 rounded-md" disabled>
                                    <option value="" {{$learner->learner_gender == "" ? 'selected' : ''}} class=""></option>
                                    <option value="Male" {{$learner->learner_gender == "Male" ? 'selected' : ''}} class="">Male</option>
                                    <option value="Female" {{$learner->learner_gender == "Female" ? 'selected' : ''}} class="">Female</option>
                                    <option value="Others" {{$learner->learner_gender == "Others" ? 'selected' : ''}} class="">Preferred not to say</option>
                                    
                                </select>
                                @error('learner_gender')
                                <p class="p-1 mt-2 text-xs text-red-500">
                                    {{$message}}
                                </p>
                                @enderror
                            </div>
                        </div>
                    </div>
        
                    <div id="emailfield" class="flex justify-between w-full mt-5">
                        <h4 class="w-2/5 ml-3 font-medium ">Email</h4>
                        <div class="w-3/5">
                            <label for="learner_email" class="hidden">Email</label>
                            <input id="learner_email" type="email" name="learner_email" class="w-full px-3 py-2 border-2 rounded-md " placeholder="Email" disabled value="{{$learner->learner_email}}">
                            @error('learner_email')
                                <p class="p-1 mt-2 text-xs text-red-500">
                                    {{$message}}
                                </p>
                                @enderror
                        </div>
                    </div>
        
                    <div id="contactno" class="flex justify-between w-full mt-5">
                        <h4 class="w-2/5 ml-3 font-medium">Contact Number</h4>
                        <div class="w-3/5">
                            <label for="learner_contactno" class="hidden">Contact Number</label>
                            <input type="tel" id="learner_contactno" pattern="[0-9]{11}" name="learner_contactno" class="w-full px-3 py-2 border-2 rounded-md" placeholder="09" disabled value="{{$learner->learner_contactno}}">
                            @error('learner_contactno')
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
        
                <div id="businessdetailsfields" class="my-5">
                    <h3 class="mb-5 text-xl font-medium border-b-2 border-b-black ">Business Details</h3>
                    <div id="businessfields_container" class="mt-5">
                        <div id="businessname" class="flex justify-between w-full mt-5">
                            <h4 class="w-2/5 ml-3 font-medium">Business Name</h4>
                            <div class="w-3/5">
                                <label for="business_name" class="hidden">Business Name</label>
                                <input id="business_name" type="text" class="w-full px-3 py-2 border-2 rounded-md" name="business_name" placeholder="Business Name" disabled value="{{ $business->business_name }}">
                                @error('business_name')
                                <p class="p-1 mt-2 text-xs text-red-500">
                                    {{$message}}
                                </p>
                                @enderror
                            </div>
                        </div>
        
                        <div id="businessaddress" class="flex justify-between w-full mt-5">
                            <h4 class="w-2/5 ml-3 font-medium">Business Address</h4>
                            <div class="w-3/5">
                                <label for="business_address" class="hidden">Business Address</label>
                                <input id="business_address" type="text" class="w-full px-3 py-2 border-2 rounded-md" name="business_address" placeholder="Business Address" disabled value="{{ $business->business_address }}">
                                @error('business_address')
                                <p class="p-1 mt-2 text-xs text-red-500">
                                    {{$message}}
                                </p>
                                @enderror
                            </div>
                        </div>
        
                        <div id="businessownername" class="flex justify-between w-full mt-5">
                            <h4 class="w-2/5 ml-3 font-medium ">Business Owner Name</h4>
                            <div class="w-3/5">
                                <label for="business_owner_name" class="hidden">Business Owner Name</label>
                                <input id="business_owner_name" type="text" class="w-full px-3 py-2 border-2 rounded-md" name="business_owner_name" placeholder="Business Owner Name" disabled value="{{ $business->business_owner_name }}">
                                @error('business_owner_name')
                                <p class="p-1 mt-2 text-xs text-red-500">
                                    {{$message}}
                                </p>
                                @enderror
                            </div>
                        </div>
        
                        <div id="businessbplonumber" class="flex justify-between w-full mt-5">
                            <h4 class="w-2/5 ml-3 font-medium ">BPLO Account Number</h4>
                            <div class="w-3/5">
                                <label for="bplo_account_number" class="hidden">BPLO Account Number</label>
                                <input id="bplo_account_number" type="text" class="w-full px-3 py-2 border-2 rounded-md" name="bplo_account_number" placeholder="" disabled value="{{ $business->bplo_account_number }}">
                                @error('bplo_account_number')
                                <p class="p-1 mt-2 text-xs text-red-500">
                                    {{$message}}
                                </p>
                                @enderror
                            </div>
                        </div>
        
                        <div id="businesscategory" class="flex justify-between w-full mt-5">
                            <h4 class="w-2/5 ml-3 font-medium ">Business Category</h4>
                            <div class="w-3/5">
                            <label for="business_category" class="hidden">Business Category</label>
                                <select name="business_category" id="business_category" class="w-full px-3 py-2 border-2 rounded-md" disabled>
                                    <option value="" {{$business->business_category == "" ? 'selected' : ''}} class=""></option>
                                    <option value="Micro" {{$business->business_category == "Micro" ? 'selected' : ''}} class="">Micro</option>
                                    <option value="Small" {{$business->business_category == "Small" ? 'selected' : ''}} class="">Small</option>
                                    <option value="Medium" {{$business->business_category == "Medium" ? 'selected' : ''}} class="">Medium</option>
                                </select>
                                @error('business_category')
                                <p class="p-1 mt-2 text-xs text-red-500">
                                    {{$message}}
                                </p>
                                @enderror
                            </div>
                        </div>
        
                    </div>
                </div>

                <div id="logindetailsfields" class="my-5">
                    <h3 class="mb-5 text-xl font-medium border-b-2 border-b-black ">Login Details</h3>
                    <div id="logindetails_container" class="">
                        <div id="usernamefield" class="flex justify-between w-full mt-5">
                            <h4 class="w-2/5 ml-3 font-medium ">Username</h4>
                            <div class="w-3/5">
                                <label for="learner_username" class="hidden">Username</label>
                                <input id="learner_username" type="text" name="learner_username" class="w-full px-3 py-2 border-2 rounded-md" placeholder="Username" disabled value={{$learner->learner_username}}>
                                @error('learner_username')
                                <p class="p-1 mt-2 text-xs text-red-500">
                                    {{$message}}
                                </p>
                                @enderror
                            </div>
                        </div>
        
                        <div id="passwordfield" class="flex justify-between w-full mt-5">
                            <h4 class="w-2/5 ml-3 font-medium ">Password</h4>
                            <div class="w-3/5">
                                <label for="learner_password" class="hidden">Password</label>
                                <input id="learner_password" type="password" name="learner_password" class="w-full px-3 py-2 border-2 rounded-md" placeholder="Password" disabled value="{{ $learner->learner_password }}">
                                @error('learner_password')
                                <p class="p-1 mt-2 text-xs text-red-500">
                                    {{$message}}
                                </p>
                                @enderror
                            </div>
                        </div>
        
                        <div id="password_confirmfield" class="flex justify-between w-full mt-5">
                            <h4 class="w-2/5 ml-3 font-medium ">Cofirm Password</h4>
                            <div class="w-3/5">
                                <label for="learner_password_confirm" class="hidden">Cofirm Password</label>
                                <input id="learner_password_confirm" type="password" name="learner_password_confirm" class="w-full px-3 py-2 border-2 rounded-md" placeholder="Confirm Password" disabled value="{{ $learner->learner_password }}">
                                @error('learner_password_confirm')
                                <p class="p-1 mt-2 text-xs text-red-500">
                                    {{$message}}
                                </p>
                                @enderror
                            </div>
                        </div>
        
                        <div id="securitynumfield" class="flex justify-between w-full mt-5">
                            <h4 class="w-2/5 ml-3 font-medium ">SecurityCode</h4>
                            <div class="w-3/5">
                                <label for="learner_security_code" class="hidden">SecurityCode</label>
                                <input id="learner_security_code" type="password" maxlength="6" name="learner_security_code" class="w-full px-3 py-2 border-2 rounded-md" placeholder="Seucrity Code" value="{{ $learner->learner_security_code }}">
                                @error('learner_security_code')
                                <p class="p-1 mt-2 text-xs text-red-500">
                                    {{$message}}
                                </p>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                
        


                <div class="">
                    <h1>Created at: {{ $learner->created_at }}</h1>
                    <h1>Last Modified at: {{ $learner->updated_at }}</h1>
                </div>
        
                <div id="button_container" class="flex justify-center pt-5 mx-auto mt-16 text-center border-2 border-t-black">
                    <a href="{{ url('/admin/learners') }}" id="return"class="px-5 py-5 mx-3 text-xl font-medium text-white bg-red-600 hover:bg-red-900 rounded-xl">Return</a>
                    <button type="button" id="cancel" class="hidden px-5 py-5 mx-3 text-xl font-medium text-white bg-red-600 hover:bg-red-900 rounded-xl">Cancel</button>

                    <button type="button" id="learner_edit_data" type="button" class="px-5 py-5 mx-3 text-xl font-medium text-white bg-green-600 hover:bg-green-900 rounded-xl">Edit Data</button>
                    
                    <button id="learner_update_data" type="button" class="hidden px-5 py-5 mx-3 text-xl font-medium text-white bg-green-600 hover:bg-green-900 rounded-xl">Apply Changes</button>

                    <div id="updateLearnerModal" class="fixed top-0 left-0 flex items-center justify-center hidden w-screen h-screen bg-black bg-opacity-50">
                        <div class="p-5 text-center bg-white rounded-lg">
                            <p>Are you sure you want to update this learner?</p>
                            <button type="submit" id="learner_confirmUpdate" class="px-4 py-2 m-2 text-white bg-green-600 rounded-md">Confirm</button>
                            <button type="button" id="learner_cancelUpdate" class="px-4 py-2 m-2 text-gray-700 bg-gray-400 rounded-md">Cancel</button>
                        </div>
                    </div>
                </form>

                    <button id="learner_delete_data" type="button" class="hidden px-5 py-5 mx-3 text-xl font-medium text-white bg-red-600 hover:bg-red-900 rounded-xl">Delete Data</button>

                    <div id="deleteLearnerModal" class="fixed top-0 left-0 flex items-center justify-center hidden w-screen h-screen bg-black bg-opacity-50">
                        <form id="learner_deleteCourse" action="" data-learner-id="{{ $learner->learner_id }}">
                            @csrf
                            <div class="p-5 text-center bg-white rounded-lg">
                                <p>Are you sure you want to delete this learner?</p>
                                <button type="submit" id="learner_confirmDelete" class="px-4 py-2 m-2 text-white bg-red-600 rounded-md">Confirm</button>
                                <button type="button" id="learner_cancelDelete" class="px-4 py-2 m-2 text-gray-700 bg-gray-400 rounded-md">Cancel</button>
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

        //         $('#button').removeClass('hidden');
        //         $('#update_data').removeClass('hidden');
        //         $('#delete_data').removeClass('hidden');
        //         $('#edit_data').addClass('hidden');
        //         $('#cancel').removeClass('hidden');
        //         $('#return').addClass('hidden');

        //         $('#learner_fname').prop("disabled", false).focus();
        //         $('#learner_lname').prop("disabled", false);
        //         $('#learner_bday').prop("disabled", false);
        //         $('#learner_gender').prop("disabled", false);
        //         $('#learner_email').prop("disabled", false);
        //         $('#learner_email').prop("readonly", true);
        //         $('#learner_contactno').prop("disabled", false);
        //         $('#learner_contactno').prop("readonly", true);

        //         $('#business_name').prop("disabled", false);
        //         $('#business_address').prop("disabled", false);
        //         $('#business_owner_name').prop("disabled", false);
        //         $('#bplo_account_number').prop("disabled", false);
        //         $('#business_category').prop("disabled", false);

        //         $('#learner_username').prop("disabled", false);
        //         // $('#learner_username').prop("readonly", true);
        //         $('#learner_password').prop("disabled", false);
        //         // $('#learner_password').prop("readonly", true);
        //         $('#learner_password_confirm').prop("disabled", false);
        //         // $('#learner_password_confirm').prop("readonly", true);
        //         $('#learner_security_code').prop("disabled", false);
        //         $('#learner_security_code').prop("readonly", true);
        //     })
        // })
    </script>    
@endsection
