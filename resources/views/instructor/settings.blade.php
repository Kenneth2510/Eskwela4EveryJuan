@include('partials.header')

    <section class="relative w-full h-auto overflow-hidden text-sm bg-mainwhitebg">
        
        @include('partials.instructorNav')
        {{-- @include('partials.instructorSidebar') --}}

        {{-- @include('partials.instructor_sidebar') --}}

        {{-- MAIN --}}
        <section class="relative h-screen mx-2 overflow-auto shadow-lg text-darthmouthgreen">
            <div class="top-0 right-0 md:absolute z-1 md:w-3/4 pt-[110px] md:pt-[60px] md:h-screen lg:w-10/12">
                <button class="w-8 h-8 m-2">
                    <svg xmlns="http://www.w3.org/2000/svg" height="20" viewBox="0 -960 960 960" width="24"><path d="m313-440 224 224-57 56-320-320 320-320 57 56-224 224h487v80H313Z"/></svg>
                </button>

                <h1 class="mb-4 text-lg font-semibold text-center md:text-xl">Instructor Settings</h1>

                
                    <div class="flex flex-col items-center justify-center mb-4">
                        <div class="w-20 h-20 bg-teal-500 rounded-full">
                            @php
                                $pathParts = explode('/', $instructor->profile_picture);
                                
                                // $filename = end($pathParts);

                                // Add "storage/app/public" to the beginning of the URL path
                                $pathParts = array_merge(['Storage', 'app', 'public'], $pathParts);

                                $fileurl = asset(implode('/', $pathParts));
                                // dd($fileurl);
                            @endphp

                                <img src="{{ $fileurl }}" alt="Profile Picture">
                                {{-- <img src="{{ asset($instructor->profile_picture) }}" alt="Profile Picture"> --}}
                            {{-- <h3>{{ asset($instructor->profile_picture) }}</h3> --}}
                            {{-- <img src="{{ asset($cleaned_profile_picture_url) }}" alt="Profile Picture"> --}}
                        </div>
                        {{-- <img src="{{ asset('storage/instructors/Rano Steph/1696837493-defaul_profile.png') }}" alt="Profile Picture"> --}}
                        {{-- /storage/instructors/Rano Steph/1696837865-defaul_profile.png --}}


                        <h1 class="text-lg font-medium">{{ $instructor->instructor_fname }} {{ $instructor->instructor_lname }} </h1>
                        
                        <h3 class="mx-3 text-lg font-semibold text-center">Account Status: 
                            @if ($instructor->status == 'Approved')
                            <div id="status" class="mx-auto text-lg text-center bg-green-500 py-auto w-28 rounded-xl">Approved</div>
                            @elseif ($instructor->status == 'Rejected')
                            <div id="status" class="mx-auto text-lg text-center bg-red-500 py-auto w-28 rounded-xl">Rejected</div>
                            @else 
                            <div id="status" class="mx-auto text-lg text-center bg-yellow-300 py-auto w-28 rounded-xl">pending</div>
                            @endif
                        </h3>
                        

                        <div id="profilePicturePopup" class="fixed inset-0 z-50 flex items-center justify-center hidden bg-gray-800 bg-opacity-50">
                            <div class="p-6 bg-white rounded-lg shadow-lg w-96">
                                <h1 class="mb-4 text-lg font-semibold">Upload Profile Picture</h1>
                                
                                <form id="profilePictureForm" enctype="multipart/form-data" action="{{ url('/instructor/update_profile') }}" method="POST">
                                    @method('PUT')
                                    @csrf
                                    <!-- Add the hidden input field for the method -->
                                    <input type="hidden" name="_method" value="PUT">
                                    <div class="mb-4">
                                        <input type="file" name="profile_picture" id="profile_picture" class="">
                                        <label for="profile_picture" class="px-4 py-2 text-white bg-blue-500 rounded-lg cursor-pointer hover:bg-blue-600">
                                            Select Image
                                        </label>
                                        @error('profile_picture')
                                            <p class="p-1 mt-2 text-xs text-red-500">
                                                {{$message}}
                                            </p>
                                        @enderror
                                    </div>
                                    <div class="mb-4">
                                        <button type="submit" class="px-4 py-2 text-white bg-green-500 rounded-lg hover:bg-green-600">
                                            Upload
                                        </button>
                                    </div>
                                </form>
                                
                                
                                <button id="closePopup" class="text-sm text-gray-600 cursor-pointer hover:text-gray-800">Close</button>
                            </div>
                        </div>

                        
                        <button id="updatePictureBtn" type="button" class="underline text-darthmouthgreen">Update Picture</button>
    
                    </div>

                    
                    <form class="pb-4 mx-4 text-sm text-black md:text-lg" action="{{ url('/instructor/settings') }}" method="POST">
                        @method('PUT')
                        @csrf
                    <div class="flex flex-col">
                        <div class="FORM-CTNR">
                            <label for="instructor_fname">Firstname:</label>
                            <input class="IN-V-INP" type="text" name="instructor_fname" id="instructor_fname" value="{{ $instructor->instructor_fname }}" disabled>
                            @error('instructor_fname')
                                <p class="p-1 mt-2 text-xs text-red-500">
                                    {{$message}}
                                </p>
                                @enderror
                        </div>
                        <div class="FORM-CTNR">
                            <label for="instructor_lname">Lastname:</label>
                            <input class="IN-V-INP" type="text" name="instructor_lname" id="instructor_lname" value="{{ $instructor->instructor_lname }}" disabled>
                            @error('instructor_lname')
                                <p class="p-1 mt-2 text-xs text-red-500">
                                    {{$message}}
                                </p>
                                @enderror
                        </div>
                    </div>
                    
                    <div>
                        <div class="FORM-CTNR">
                            <label for="instructor_bday">Birthday:</label>
                            <input class="IN-V-INP" type="date" name="instructor_bday" id="instructor_bday" value="{{ $instructor->instructor_bday }}" disabled>
                            @error('instructor_bday')
                                <p class="p-1 mt-2 text-xs text-red-500">
                                    {{$message}}
                                </p>
                                @enderror
                        </div>
                        
                        <div class="FORM-CTNR">
                            <label for="instructor_gender">Gender</label>
                            <select class="IN-V-INP" name="instructor_gender" id="instructor_gender" disabled>
                                <option value="" {{ $instructor->instructor_gender == "" ? 'selected': '' }} disabled>-- select an option --</option>
                                <option value="Male" {{ $instructor->instructor_gender == "Male" ? 'selected': '' }} >Male</option>
                                <option value="Female" {{ $instructor->instructor_gender == "Femnale" ? 'selected': '' }} >Female</option>
                                <option value="Others" {{ $instructor->instructor_gender == "Others" ? 'selected': '' }} >Female</option>
                                @error('instructor_gender')
                                <p class="p-1 mt-2 text-xs text-red-500">
                                    {{$message}}
                                </p>
                                @enderror
                                
                            </select>
                        </div>
                    </div>

                    <div class="FORM-CTNR">
                        <label for="instructor_email">Email:</label>
                        <input class="IN-V-INP" type="instructor_email" name="instructor_email" id="" value="{{ $instructor->instructor_email }}" disabled>
                        @error('intructor_email')
                                <p class="p-1 mt-2 text-xs text-red-500">
                                    {{$message}}
                                </p>
                                @enderror
                    </div>
                    <div class="FORM-CTNR">
                        <label for="instructor_contactno">Contact Number:</label>
                        <input class="IN-V-INP" type="text" name="instructor_contactno" id="instructor_contactno" value="{{ $instructor->instructor_contactno }}" disabled>
                        @error('instructor_contactno')
                                <p class="p-1 mt-2 text-xs text-red-500">
                                    {{$message}}
                                </p>
                                @enderror
                    </div>
                    <div class="FORM-CTNR">
                        <label for="instructor_username">Username:</label>
                        <input class="IN-V-INP" type="text" name="instructor_username" id="instructor_username" value="{{ $instructor->instructor_username }}" disabled>
                        @error('instructor_username')
                                <p class="p-1 mt-2 text-xs text-red-500">
                                    {{$message}}
                                </p>
                                @enderror
                    </div>
                    <div class="FORM-CTNR">

                        <label for="password">Password:</label>
                        <input class="IN-V-INP" type="password" name="password" id="password" value="{{ $instructor->password }}" disabled>
                        @error('password_confirmation')
                                <p class="p-1 mt-2 text-xs text-red-500">
                                    {{$message}}
                                </p>
                                @enderror
                    </div>
                    {{-- <div class="hidden IN-FORM-CTNR">
                        <label for="password">Password:</label>
                        <input class="IN-V-INP" type="password" name="new_password" id="" >
                    </div> --}}
                    <div id="pass_confirm" class="hidden IN-FORM-CTNR">
                        <label for="password_confirmation">Confirm Password:</label>
                        <input class="IN-V-INP" type="password" name="password_confirmation" id="password_confirmation">

                    </div>

                    <div class="FORM-CTNR">
                        <label for="instructor_credentials" class="">CV or Resume</label>
                                @if($instructor->instructor_credentials)
                                    @php
                                        $pathParts = explode('/', $instructor->instructor_credentials);
                                        $filename = end($pathParts);
                                        $fileurl = asset("storage/$instructor->instructor_credentials");
                                    @endphp
                                <p class="text-xl w-96">File: <a href="{{ $fileurl }}" target="_blank">{{$filename}}</a></p>
                                @else
                                <p class="text-xl w-96">No file Uploaded</p>
                                @endif
                                <input id="instructor_credentials" type="file" accept="application/pdf" class="px-3 py-2 text-lg border-2 rounded-md md:text-xl w-15" name="instructor_credentials" placeholder="instructor_credentials" disabled value="{{$instructor->instructor_credentials}}">
                                @error('instructor_credentials')
                                <p class="p-1 mt-2 text-xs text-red-500">
                                    {{$message}}
                                </p>
                                @enderror
                    </div>
                    
                    <div class="grid h-auto grid-flow-col grid-cols-1 my-10 text-black place-items-end">
                        <button type="button" class="flex flex-row items-center justify-center w-24 h-10 rounded-lg bg-amber-400 hover:bg-amber-500" id="editBtn">
                            Edit
                        </button>

                        <a id="cancelBtn" href="" class="flex flex-row items-center justify-center hidden w-24 h-10 mx-5 bg-red-400 rounded-lg hover:bg-red-500 md:h-12 md:w-40">Cancel</a>
                        
                        <button type="submit" id="updateBtn" class="flex flex-row items-center justify-center hidden w-24 h-10 rounded-lg bg-amber-400 hover:bg-amber-500 md:h-12 md:w-40" id="editBtn">
                            Save Changes
                        </button>
                    </div>
                </form>
            </section>
    
            </div>
    </section>


@include('partials.footer')

<script>
    $(document).ready(function() {
        $('#editBtn').on('click', function(e) {
            e.preventDefault();
            // alert('test');
            $('#instructor_fname').prop("disabled", false).focus();
            $('#instructor_lname').prop("disabled", false);
            $('#instructor_bday').prop("disabled", false);
            $('#instructor_gender').prop("disabled", false);
            // $('#instructor_email').prop("disabled", false);        
            $('#instructor_contactno').prop("disabled", false);          
            $('#password').prop("disabled", false);
            $('#password').prop("readonly", true);

            
            $('#instructor_fname').prop("required", true);
            $('#instructor_lname').prop("required", true);
            $('#instructor_bday').prop("required", true);
            $('#instructor_gender').prop("required", true);
            $('#instructor_contactno').prop("required", true);
            $('#password_confirmation').prop("required", true);
                    
            // $('#instructor_credentials').prop("disabled", false);

            $('#pass_confirm').removeClass('hidden');

            $('#cancelBtn').removeClass('hidden');
            $('#updateBtn').removeClass('hidden');
            $('#editBtn').addClass('hidden');
        })

        $('#updatePictureBtn').click(function () {
            $('#profilePicturePopup').removeClass('hidden');
        });

        $('#closePopup').click(function () {
            $('#profilePicturePopup').addClass('hidden');
        });

    });
</script>