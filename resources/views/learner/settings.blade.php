@include('partials.header')

    <section class="relative w-full h-auto overflow-hidden text-sm bg-mainwhitebg">
        <header class="fixed top-0 left-0 z-40 flex flex-row items-center w-full px-4 py-4 bg-seagreen">
            <a href="#">
                <span class="self-center text-lg font-semibold font-semibbold whitespace-nowrap md:text-2xl text-mainwhitebg">
                    Eskwela4EveryJuan
                </span>
            </a>
        </header>

        @include('partials.learnerSidebar')

        {{-- MAIN --}}
        <section style="left: 12%;" class="w-10/12 mx-2 mt-[110px] shadow-lg text-dartmouthgreen relative">
            <button class="w-8 h-8 m-2">
                <svg xmlns="http://www.w3.org/2000/svg" height="20" viewBox="0 -960 960 960" width="24"><path d="m313-440 224 224-57 56-320-320 320-320 57 56-224 224h487v80H313Z"/></svg>
            </button>

            <h1 class="mb-4 text-lg font-semibold text-center">Learner Settings</h1>

            
            <div class="flex flex-col items-center justify-center mb-4">
                <div class="w-20 h-20 bg-teal-500 rounded-full">
                  
                    <img class="rounded-full w-20 h-20" src="{{ asset('storage/' . $learner->profile_picture) }}
                    " alt="Profile Picture">
              </div>
               

                <h1 class="text-lg font-medium">{{ $learner->learner_fname }} {{ $learner->learner_lname }} </h1>
                
                <h3 class="mx-3 text-lg font-semibold text-center">Account Status: 
                    @if ($learner->status == 'Approved')
                    <div id="status" class="mx-1 text-lg text-center bg-green-500 py-auto w-28 rounded-xl">Approved</div>
                    @elseif ($learner->status == 'Rejected')
                    <div id="status" class="mx-1 text-lg text-center bg-red-500 py-auto w-28 rounded-xl">Rejected</div>
                    @else 
                    <div id="status" class="mx-1 text-lg text-center bg-yellow-300 py-auto w-28 rounded-xl">pending</div>
                    @endif
                </h3>
                  

                <div id="profilePicturePopup" class="fixed inset-0 bg-gray-800 bg-opacity-50 flex justify-center items-center z-50 hidden">
                    <div class="bg-white p-6 rounded-lg shadow-lg w-96">
                        <h1 class="text-lg font-semibold mb-4">Upload Profile Picture</h1>
                        
                        <form id="profilePictureForm" enctype="multipart/form-data" action="{{ url('/learner/update_profile') }}" method="POST">
                            @method('PUT')
                            @csrf
                            <!-- Add the hidden input field for the method -->
                            <input type="hidden" name="_method" value="PUT">
                            <div class="mb-4">
                                <input type="file" name="profile_picture" id="profile_picture" class="">
                                <label for="profile_picture" class="cursor-pointer bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600">
                                    Select Image
                                </label>
                                @error('profile_picture')
                                    <p class="p-1 mt-2 text-xs text-red-500">
                                        {{$message}}
                                    </p>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <button type="submit" class="bg-green-500 text-white py-2 px-4 rounded-lg hover:bg-green-600">
                                    Upload
                                </button>
                            </div>
                        </form>
                        
                        
                        <button id="closePopup" class="text-gray-600 hover:text-gray-800 text-sm cursor-pointer">Close</button>
                    </div>
                </div>

                
                <button id="updatePictureBtn" type="button" class="underline text-darthmouthgreen">Update Picture</button>

            </div>


                <form class="pb-4 mx-4 text-sm text-black" action="{{ url('/learner/settings') }}" method="POST">
                    @method('PUT')
                    @csrf

                <div class="flex flex-row items-center justify-start w-full h-10 px-2 my-2 border-2 rounded shadow-lg cursor-pointer border-seagreen" id="showLearnerPersonal">
                    <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="M440-440H200v-80h240v-240h80v240h240v80H520v240h-80v-240Z"/></svg>
                    <h1>Personal Information</h1>
                </div>
                
                <div class="hidden" id="learnerPersonal">
                    <div class="flex flex-col">
                        <div class="IN-FORM-CTNR">
                            <label for="learner_fname">Firstname:</label>
                            <input class="IN-V-INP" type="text" name="learner_fname" id="learner_fname" value="{{ $learner->learner_fname }}" disabled>
                            @error('fname')
                        <p class="text-red-500 text-lg mt-2 p-1">
                            {{$message}}
                        </p>
                        @enderror
                        </div>
                        <div class="IN-FORM-CTNR">
                            <label for="learner_lname">Lastname:</label>
                            <input class="IN-V-INP" type="text" name="learner_lname" id="learner_lname" value="{{ $learner->learner_lname }}" disabled>
                            @error('learner_lname')
                        <p class="text-red-500 text-lg mt-2 p-1">
                            {{$message}}
                        </p>
                        @enderror
                        </div>
                    </div>
                    
                    <div>
                        <div class="IN-FORM-CTNR">
                            <label for="learner_bday">Birthday:</label>
                            <input class="IN-V-INP" type="date" name="learner_bday" id="learner_bday" value="{{ $learner->learner_bday }}" disabled>
                            @error('learner_bday')
                        <p class="text-red-500 text-lg mt-2 p-1">
                            {{$message}}
                        </p>
                        @enderror
                        </div>
                        
                        <div class="IN-FORM-CTNR">
                            <label for="learner_gender">Gender</label>
                            <select class="IN-V-INP" name="learner_gender" id="learner_gender" disabled>
                                <option value="" {{ $learner->learner_gender == "" ? 'selected': '' }} disabled>-- select an option --</option>
                                <option value="Male" {{ $learner->learner_gender == "Male" ? 'selected': '' }} >Male</option>
                                <option value="Female" {{ $learner->learner_gender == "Female" ? 'selected': '' }} >Female</option>
                                <option value="Others" {{ $learner->learner_gender == "Others" ? 'selected': '' }} >Preferred not to say</option>
                            </select>
                            @error('learner_gender')
                        <p class="text-red-500 text-lg mt-2 p-1">
                            {{$message}}
                        </p>
                        @enderror
                        </div>
                    </div>

                    <div class="IN-FORM-CTNR">
                        <label for="learner_email">Email:</label>
                        <input class="IN-V-INP" type="email" name="learner_email" id="learner_email" value="{{ $learner->learner_email }}" disabled>
                        @error('learner_email')
                        <p class="text-red-500 text-lg mt-2 p-1">
                            {{$message}}
                        </p>
                        @enderror
                    </div>
                    <div class="IN-FORM-CTNR">
                        <label for="learner_contactno">Contact Number:</label>
                        <input class="IN-V-INP" type="text" name="learner_contactno" id="learner_contactno" value="{{ $learner->learner_contactno }}" disabled>
                        @error('learner_contactno')
                        <p class="text-red-500 text-lg mt-2 p-1">
                            {{$message}}
                        </p>
                        @enderror
                    </div>
                </div>

                <div class="flex flex-row items-center justify-start w-full h-10 px-2 my-2 border-2 rounded shadow-lg cursor-pointer border-seagreen" id="showLearnerBusiness">
                    <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="M440-440H200v-80h240v-240h80v240h240v80H520v240h-80v-240Z"/></svg>
                    <h1>Edit Business Information</h1>
            </div>
            
            <div class="hidden" id="learnerBusiness">
                <div class="IN-FORM-CTNR">
                    <label for="business_name">Business Name:</label>
                    <input class="IN-V-INP" type="text" name="business_name" id="business_name" value="{{ $business->business_name }}" disabled>
                    @error('business_name')
                        <p class="text-red-500 text-lg mt-2 p-1">
                            {{$message}}
                        </p>
                        @enderror
                </div>
                <div class="IN-FORM-CTNR">
                    <label for="bplo_account_number">Account Number:</label>
                    <input class="IN-V-INP" type="text" name="bplo_account_number" id="bplo_account_number" value="{{ $business->bplo_account_number }}" disabled>
                    @error('bplo_account_numnber')
                        <p class="text-red-500 text-lg mt-2 p-1">
                            {{$message}}
                        </p>
                        @enderror
                </div>
                <div class="IN-FORM-CTNR">
                    <label for="business_address">Business Address:</label>
                    <input class="IN-V-INP" type="text" name="business_address" id="business_address" value="{{ $business->business_address }}" disabled>
                    @error('business_address')
                        <p class="text-red-500 text-lg mt-2 p-1">
                            {{$message}}
                        </p>
                        @enderror
                </div>
                <div class="IN-FORM-CTNR">
                    <label for="business_owner_name">Business Owner:</label>
                    <input class="IN-V-INP" type="text" name="business_owner_name" id="business_owner_name" value="{{ $business->business_owner_name }}" disabled>
                    @error('business_owner_name')
                        <p class="text-red-500 text-lg mt-2 p-1">
                            {{$message}}
                        </p>
                        @enderror
                </div>
                <div class="IN-FORM-CTNR">
                    <label for="business_category">Business Category:</label>
                    <input class="IN-V-INP" type="text" name="business_category" id="business_category" value="{{ $business->business_category }}" disabled>
                    @error('business_category')
                        <p class="text-red-500 text-lg mt-2 p-1">
                            {{$message}}
                        </p>
                        @enderror
                </div>
            </div>

                <div class="flex flex-row items-center justify-start w-full h-10 px-2 my-2 border-2 rounded shadow-lg cursor-pointer border-seagreen" id="showLearnerLogin">
                        <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="M440-440H200v-80h240v-240h80v240h240v80H520v240h-80v-240Z"/></svg>
                        <h1>Login Information</h1>
                </div>

                <div class="" id="learnerLogin">
                    <div class="IN-FORM-CTNR">
                        <label for="learner_username">Username:</label>
                        <input class="IN-V-INP" type="text" name="learner_username" id="learner_username" value="{{ $learner->learner_username }}" disabled>
                        @error('learner_username')
                        <p class="text-red-500 text-lg mt-2 p-1">
                            {{$message}}
                        </p>
                        @enderror
                    </div>
                    <div class="IN-FORM-CTNR">
                        <label for="password">Password:</label>
                        <input class="IN-V-INP" type="password" name="old_password" id="password" value="{{ $learner->password }}" disabled>
                    </div>
                    <div id="password_confirmForm" class="IN-FORM-CTNR hidden">
                        <label for="password_confirmation">Confirm Password:</label>
                        <input class="IN-V-INP" type="password" name="password_confirmation" id="" required>
                        @error('password_confirmation')
                        <p class="text-red-500 text-lg mt-2 p-1">
                            {{$message}}
                        </p>
                        @enderror
                    </div>
                </div>
                
                
                
                    
                    
                    <div class="flex justify-end h-auto my-10 text-black place-items-end" >
                        <button type="button" class="flex flex-row items-center justify-center w-24 h-10 rounded-lg bg-amber-400 hover:bg-amber-500" id="editBtn">
                            Update
                        </button>
                        <a href="" id="cancelBtn" class="hidden mx-2 flex flex-row items-center justify-center w-24 h-10 rounded-lg bg-red-500 hover:bg-red-600">Cancel</a>
                        <button type="submit" class="hidden mx-2 flex flex-row items-center justify-center w-24 h-10 rounded-lg bg-green-500 hover:bg-green-600" id="updateBtn">
                            Save Changes
                        </button>
                        
                    </div>
                </div>
            </form>
        </section>
    </section>


@include('partials.footer')
