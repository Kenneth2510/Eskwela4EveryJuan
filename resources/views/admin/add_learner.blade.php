@include('partials.header')
@include('partials.sidebar')

<section id="AD002_LA_container" class="relative w-4/5 h-full left-80">

    <div id="AD002_LA_title" class="relative flex items-center justify-between h-16 px-3 mx-auto my-3 py-auto">
        <h1 class="text-4xl font-semibold">Add New Learner</h1>
        <div id="adminuser" class="flex items-center">
            <h3 class="text-lg">{{ $adminCodeName }}</h3>
            <div id="icon" class="w-10 h-10 mx-3 rounded-full bg-slate-400"></div>
        </div>
    </div>

    <div id="AD002_LA_maincontainer" class="relative max-h-full px-5 py-5 shadow-2xl bg-white mt-7 rounded-2xl">
        <div class="mb-5">
            <a href="/admin/learners" class="">
                <i class="text-2xl md:text-3xl fa-solid fa-arrow-left" style="color: #000000;"></i>
            </a>
        </div>

        <form action="/admin/add_learner" method="POST">
            @csrf
        <div class="smallpc:flex smallpc:items-start">
            <div id="personal_details_container" class="mx-auto my-5 smallpc:w-6/12">
                <h3 class="mb-5 text-3xl font-medium border-b-2 md:text-4xl border-b-black">Personal Details</h3>
                <div id="AD002_LA_namefield" class="flex mt-5">
                    <h4 class="w-32 ml-3 text-lg font-medium md:w-40 md:text-2xl">Name</h4>
                    <div class="block">
                        <div class="mb-3">
                            <label for="learner_fname" class="text-md font-regular md:text-lg">First Name</label>
                            <br>
                            <input type="text" name="learner_fname" class="px-3 py-2 text-lg border-2 border-black rounded-md md:text-xl w-15" placeholder="First Name" value="{{old('learner_fname')}}">
                            @error('learner_fname')
                            <p class="p-1 mt-2 text-xs text-red-500">
                                {{$message}}
                            </p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="learner_lname" class="text-md font-regular md:text-lg">Last Name</label><br>
                            <input type="text" name="learner_lname" class="px-3 py-2 text-lg border-2 border-black rounded-md md:text-xl w-15"  placeholder="Last Name" value="{{old('learner_lname')}}">
                            @error('learner_lname')
                            <p class="p-1 mt-2 text-xs text-red-500">
                                {{$message}}
                            </p>
                            @enderror
                        </div>
                        
                    </div>
                </div>
    
                <div id="AD002_LA_bday_genderfield" class="">
                    <div id="AD002_LA_bdayfield" class="flex mt-5">
                        <h4 class="w-32 ml-3 text-lg font-medium md:w-40 md:text-2xl">Birthday</h4>
                        <div class="">
                            <label for="learner_bday" class="hidden">Birthday</label>
                            <input type="date" name="learner_bday" class="px-3 py-2 text-lg border-2 border-black rounded-md md:text-xl w-15" value="{{old('learner_bday')}}">
                            @error('learner_bday')
                            <p class="p-1 mt-2 text-xs text-red-500">
                                {{$message}}
                            </p>
                            @enderror
                        </div>
                    </div>
                    <div id="AD002_LA_gender" class="flex mt-5">
                        <h4 class="w-32 ml-3 text-lg font-medium md:w-40 md:text-2xl">Gender</h4>
                        <div class="">
                            <label for="learner_gender" class="hidden">Gender</label>
                            <select name="learner_gender" id="gender" class="px-3 py-2 text-lg border-2 border-black rounded-md md:text-xl w-15">
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
                </div>
    
                <div id="AD002_LA_email" class="flex mt-5">
                    <h4 class="w-32 ml-3 text-lg font-medium md:w-40 md:text-2xl">Email</h4>
                    <div class="">
                        <label for="learner_email" class="hidden">Email</label>
                        <input type="email" name="learner_email" class="px-3 py-2 text-lg border-2 border-black rounded-md w-15 md:text-xl" placeholder="Email" value="{{old('learner_email')}}">
                        @error('learner_email')
                            <p class="p-1 mt-2 text-xs text-red-500">
                                {{$message}}
                            </p>
                            @enderror
                    </div>
                </div>
    
                <div id="AD002_LA_contactno" class="flex mt-5">
                    <h4 class="w-32 ml-3 text-lg font-medium leading-5 md:w-40 md:text-2xl">Contact Number</h4>
                    <div class="">
                        <label for="learner_contactno" class="hidden">Contact Number</label>
                        <input type="tel" id="learner_contactno" maxlength="11" pattern="[0-9]{11}" name="learner_contactno" class="px-3 py-2 text-lg border-2 border-black rounded-md w-15 md:text-xl" placeholder="09" value="{{old('learner_contactno')}}">
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
    
            <div id="AD002_LA_businessdetailsfields" class="mx-auto my-5 mt-16 smallpc:w-6/12 smallpc:mt-5">
                <h3 class="mb-5 text-3xl font-medium border-b-2 border-b-black md:text-4xl">Business Details</h3>
                <div id="AD002_LA_businessfields_container" class="mt-5">
                    <div id="AD002_LA_businessname" class="flex">
                        <h4 class="w-40 ml-3 text-lg font-medium leading-5 md:w-60 md:text-2xl">Business Name</h4>
                        <div class="">
                            <label for="business_name" class="hidden">Business Name</label>
                            <input type="text" class="px-3 py-2 text-lg border-2 border-black rounded-md md:text-xl w-15" name="business_name" placeholder="Business Name" value="{{old('business_name')}}">
                            @error('business_name')
                            <p class="p-1 mt-2 text-xs text-red-500">
                                {{$message}}
                            </p>
                            @enderror
                        </div>
                    </div>
    
                    <div id="AD002_LA_businessaddress" class="flex mt-5">
                        <h4 class="w-40 ml-3 text-lg font-medium md:w-60 md:text-2xl ">Business Address</h4>
                        <div class="">
                            <label for="business_address" class="hidden">Business Address</label>
                            <input type="text" class="px-3 py-2 text-lg border-2 border-black rounded-md md:text-xl w-15" name="business_address" placeholder="Business Address" value="{{old('business_address')}}">
                            @error('business_address')
                            <p class="p-1 mt-2 text-xs text-red-500">
                                {{$message}}
                            </p>
                            @enderror
                        </div>
                    </div>
    
                    <div id="AD002_LA_businessownername" class="flex mt-5">
                        <h4 class="w-40 ml-3 text-lg font-medium leading-5 md:w-60 md:text-2xl">Business Owner Name</h4>
                        <div class="">
                            <label for="business_owner_name" class="hidden">Business Owner Name</label>
                            <input type="text" class="px-3 py-2 text-lg border-2 border-black rounded-md md:text-xl w-15" name="business_owner_name" placeholder="Business Owner Name" value="{{old('business_owner_name')}}">
                            @error('business_owner_name')
                            <p class="p-1 mt-2 text-xs text-red-500">
                                {{$message}}
                            </p>
                            @enderror
                        </div>
                    </div>
    
                    <div id="AD002_LA_businessbplonumber" class="flex mt-5">
                        <h4 class="w-40 ml-3 text-lg font-medium leading-5 md:w-60 md:text-2xl">BPLO Account Number</h4>
                        <div class="">
                            <label for="bplo_account_number" class="hidden">BPLO Account Number</label>
                            <input type="text" class="px-3 py-2 text-lg border-2 border-black rounded-md md:text-xl w-15" name="bplo_account_number" placeholder="" value="{{old('bplo_account_number')}}">
                            @error('bplo_account_number')
                            <p class="p-1 mt-2 text-xs text-red-500">
                                {{$message}}
                            </p>
                            @enderror
                        </div>
                    </div>
    
                    <div id="AD002_LA_businesscategory" class="flex mt-5">
                        <h4 class="w-40 ml-3 text-lg font-medium leading-5 md:w-60 md:text-2xl">Business Category</h4>
                        <div class="">
                        <label for="business_category" class="hidden">Business Category</label>
                            <select name="business_category" id="" class="px-3 py-2 text-lg border-2 border-black rounded-md md:text-xl w-15">
                                <option value="" {{old('business_category') == "" ? 'selected' : ''}} class=""></option>
                                <option value="micro" {{old('business_category') == "micro" ? 'selected' : ''}} class="">Micro</option>
                                <option value="small" {{old('business_category') == "small" ? 'selected' : ''}} class="">Small</option>
                                <option value="medium" {{old('business_category') == "medium" ? 'selected' : ''}} class="">Medium</option>
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

        </div>
            
    
            <div id="AD002_LA_logindetailsfields" class="mx-auto my-5 mt-16 smallpc:w-6/12">
                <h3 class="mb-5 text-3xl font-medium border-b-2 border-b-black md:text-4xl">Login Details</h3>
                <div id="AD002_LA_logindetails_container" class="">
                    <div id="username" class="flex">
                        <h4 class="w-32 ml-3 text-lg font-medium leading-5 md:w-60 md:text-2xl">Username</h4>
                        <div class="">
                            <label for="learner_username" class="hidden">Username</label>
                            <input type="text" name="learner_username" class="px-3 py-2 text-lg border-2 border-black rounded-md md:text-xl w-15" placeholder="Username" value="{{old('learner_username')}}">
                            @error('learner_username')
                            <p class="p-1 mt-2 text-xs text-red-500">
                                {{$message}}
                            </p>
                            @enderror
                        </div>
                    </div>
    
                    <div id="password_form" class="flex mt-5">
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
    
                    <div id="password_confirm_form" class="flex mt-5">
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
                            <label for="learner_security_code" class="hidden">SecurityCode</label>
                            <input type="password" maxlength="6" name="learner_security_code" class="px-3 py-2 text-lg border-2 border-black rounded-md md:text-xl w-15" placeholder="Security Code">
                            @error('learner_security_code')
                            <p class="p-1 mt-2 text-xs text-red-500">
                                {{$message}}
                            </p>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
    
            <div id="AD002_LA_button_container" class="pt-5 mx-auto mt-16 text-center border-2 border-t-black">
                <a href="/admin/learners" class="px-5 py-5 text-xl font-medium text-white bg-red-600 md:text-2xl hover:bg-red-900 rounded-xl">cancel</a>
                <button type="submit" class="px-5 py-5 text-xl font-medium text-white bg-green-600 md:text-2xl hover:bg-green-900 rounded-xl">Add New</button>
            </div>
        </form>
    </div>
    
    
</section>

@include('partials.footer')