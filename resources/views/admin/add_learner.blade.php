@extends('layouts.admin_layout')

@section('content')
    <section id="AD002_LA_container" class="relative w-full h-screen px-4 overflow-auto pt-28 md:w-3/4 lg:w-10/12 md:pt-16">

        <div id="AD002_LA_title" class="relative flex items-center justify-between px-3 mx-auto my-3 text-black">
            <h1 class="py-4 text-2xl font-semibold">Add New Learner</h1>
            <div id="adminuser" class="items-center hidden lg:flex">
                <h3 class="text-lg">{{ $adminCodeName }}</h3>
                <div id="icon" class="w-10 h-10 mx-3 rounded-full bg-slate-400"></div>
            </div>
        </div>

        <div id="AD002_LA_maincontainer" class="relative w-full px-2 text-black shadow-lg rounded-2xl">
            <div class="mb-5">
                <a href="/admin/learners" class="">
                    <i class="text-xl fa-solid fa-arrow-left" style="color: #000000;"></i>
                </a>
            </div>

            <form action="/admin/add_learner" method="POST">
                @csrf
            <div class="flex flex-col w-full text-base lg:flex-row lg:flex-wrap lg:flex-grow">
                <div id="personal_details_container" class="my-5">
                    <h3 class="mb-5 text-xl font-medium border-b-2 border-b-black">Personal Details</h3>
                    <div id="AD002_LA_namefield" class="flex justify-between w-full mt-5">
                        <h4 class="w-2/5 ml-3 font-medium">Name</h4>
                        <div class="w-3/5">
                            <div class="mb-3">
                                <label for="learner_fname" class="font-regular ">First Name</label>
                                <br>
                                <input type="text" name="learner_fname" class="w-full p-2 border-2 border-black rounded-md " placeholder="First Name" value="{{old('learner_fname')}}">
                                @error('learner_fname')
                                <p class="p-1 mt-2 text-xs text-red-500">
                                    {{$message}}
                                </p>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="learner_lname" class="font-regular">Last Name</label><br>
                                <input type="text" name="learner_lname" class="w-full p-2 border-2 border-black rounded-md "  placeholder="Last Name" value="{{old('learner_lname')}}">
                                @error('learner_lname')
                                <p class="p-1 mt-2 text-xs text-red-500">
                                    {{$message}}
                                </p>
                                @enderror
                            </div>
                            
                        </div>
                    </div>
        
                    <div id="AD002_LA_bday_genderfield" class="">
                        <div id="AD002_LA_bdayfield" class="flex justify-between w-full mt-5">
                            <h4 class="w-2/5 ml-3 font-medium">Birthday</h4>
                            <div class="w-3/5">
                                <label for="learner_bday" class="hidden">Birthday</label>
                                <input type="date" name="learner_bday" class="w-full p-2 border-2 border-black rounded-md " value="{{old('learner_bday')}}">
                                @error('learner_bday')
                                <p class="p-1 mt-2 text-xs text-red-500">
                                    {{$message}}
                                </p>
                                @enderror
                            </div>
                        </div>
                        <div id="AD002_LA_gender" class="flex justify-between w-full mt-5">
                            <h4 class="w-2/5 ml-3 font-medium">Gender</h4>
                            <div class="w-3/5">
                                <label for="learner_gender" class="hidden">Gender</label>
                                <select name="learner_gender" id="gender" class="w-full p-2 border-2 border-black rounded-md ">
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
        
                    <div id="AD002_LA_email" class="flex justify-between w-full mt-5">
                        <h4 class="w-2/5 ml-3 font-medium">Email</h4>
                        <div class="w-3/5">
                            <label for="learner_email" class="hidden">Email</label>
                            <input type="email" name="learner_email" class="w-full p-2 border-2 border-black rounded-md " placeholder="Email" value="{{old('learner_email')}}">
                            @error('learner_email')
                                <p class="p-1 mt-2 text-xs text-red-500">
                                    {{$message}}
                                </p>
                                @enderror
                        </div>
                    </div>
        
                    <div id="AD002_LA_contactno" class="flex justify-between w-full mt-5">
                        <h4 class="w-2/5 ml-3 font-medium ">Contact Number</h4>
                        <div class="w-3/5">
                            <label for="learner_contactno" class="hidden">Contact Number</label>
                            <input type="tel" id="learner_contactno" maxlength="11" pattern="[0-9]{11}" name="learner_contactno" class="w-full p-2 border-2 border-black rounded-md " placeholder="09" value="{{old('learner_contactno')}}">
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
        
                <div id="AD002_LA_businessdetailsfields" class="my-5">
                    <h3 class="mb-5 text-xl font-medium border-b-2 border-b-black">Business Details</h3>
                    <div id="AD002_LA_businessfields_container" class="mt-5">
                        <div id="AD002_LA_businessname" class="flex justify-between w-full mt-5">
                            <h4 class="w-2/5 ml-3 font-medium">Business Name</h4>
                            <div class="w-3/5">
                                <label for="business_name" class="hidden">Business Name</label>
                                <input type="text" class="w-full p-2 border-2 border-black rounded-md" name="business_name" placeholder="Business Name" value="{{old('business_name')}}">
                                @error('business_name')
                                <p class="p-1 mt-2 text-xs text-red-500">
                                    {{$message}}
                                </p>
                                @enderror
                            </div>
                        </div>
        
                        <div id="AD002_LA_businessaddress" class="flex justify-between w-full mt-5">
                            <h4 class="w-2/5 ml-3 font-medium ">Business Address</h4>
                            <div class="w-3/5">
                                <label for="business_address" class="hidden">Business Address</label>
                                <input type="text" class="w-full p-2 border-2 border-black rounded-md" name="business_address" placeholder="Business Address" value="{{old('business_address')}}">
                                @error('business_address')
                                <p class="p-1 mt-2 text-xs text-red-500">
                                    {{$message}}
                                </p>
                                @enderror
                            </div>
                        </div>
        
                        <div id="AD002_LA_businessownername" class="flex justify-between w-full mt-5">
                            <h4 class="w-2/5 ml-3 font-medium">Business Owner Name</h4>
                            <div class="w-3/5">
                                <label for="business_owner_name" class="hidden">Business Owner Name</label>
                                <input type="text" class="w-full p-2 border-2 border-black rounded-md" name="business_owner_name" placeholder="Business Owner Name" value="{{old('business_owner_name')}}">
                                @error('business_owner_name')
                                <p class="p-1 mt-2 text-xs text-red-500">
                                    {{$message}}
                                </p>
                                @enderror
                            </div>
                        </div>
        
                        <div id="AD002_LA_businessbplonumber" class="flex justify-between w-full mt-5">
                            <h4 class="w-2/5 ml-3 font-medium">BPLO Account Number</h4>
                            <div class="w-3/5">
                                <label for="bplo_account_number" class="hidden">BPLO Account Number</label>
                                <input type="text" class="w-full p-2 border-2 border-black rounded-md" name="bplo_account_number" placeholder="" value="{{old('bplo_account_number')}}">
                                @error('bplo_account_number')
                                <p class="p-1 mt-2 text-xs text-red-500">
                                    {{$message}}
                                </p>
                                @enderror
                            </div>
                        </div>
        
                        <div id="AD002_LA_businesscategory" class="flex justify-between w-full mt-5">
                            <h4 class="w-2/5 ml-3 font-medium">Business Category</h4>
                            <div class="w-3/5">
                                <label for="business_category" class="hidden">Business Category</label>
                                <select name="business_category" id="" class="w-full p-2 border-2 border-black rounded-md">
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
                        </div>
        
                    </div>
                </div>
                
                <div id="AD002_LA_logindetailsfields" class="my-5">
                    <h3 class="mb-5 text-xl font-medium border-b-2 border-b-black">Login Details</h3>
                    <div id="AD002_LA_logindetails_container" class="">
                        <div id="username" class="flex justify-between w-full mt-5">
                            <h4 class="w-2/5 ml-3 font-medium">Username</h4>
                            <div class="w-3/5">
                                <label for="learner_username" class="hidden">Username</label>
                                <input type="text" name="learner_username" class="w-full p-2 border-2 border-black rounded-md" placeholder="Username" value="{{old('learner_username')}}">
                                @error('learner_username')
                                <p class="p-1 mt-2 text-xs text-red-500">
                                    {{$message}}
                                </p>
                                @enderror
                            </div>
                        </div>
        
                        <div id="password_form" class="flex justify-between w-full mt-5">
                            <h4 class="w-2/5 ml-3 font-medium">Password</h4>
                            <div class="w-3/5">
                                <label for="password" class="hidden">Password</label>
                                <input type="password" name="password" class="w-full p-2 border-2 border-black rounded-md" placeholder="Password">
                                @error('password')
                                <p class="p-1 mt-2 text-xs text-red-500">
                                    {{$message}}
                                </p>
                                @enderror
                            </div>
                        </div>
        
                        <div id="password_confirm_form" class="flex justify-between w-full mt-5">
                            <h4 class="w-2/5 ml-3 font-medium">Cofirm Password</h4>
                            <div class="w-3/5">
                                <label for="password_confirmation" class="hidden">Cofirm Password</label>
                                <input type="password" name="password_confirmation" class="w-full p-2 border-2 border-black rounded-md" placeholder="Confirm Password">
                                @error('password_confirmation')
                                <p class="p-1 mt-2 text-xs text-red-500">
                                    {{$message}}
                                </p>
                                @enderror
                            </div>
                        </div>
        
                        <div id="securitynum" class="flex justify-between w-full mt-5">
                            <h4 class="w-2/5 ml-3 font-medium">SecurityCode</h4>
                            <div class="w-3/5">
                                <label for="learner_security_code" class="hidden">SecurityCode</label>
                                <input type="password" maxlength="6" name="learner_security_code" class="w-full p-2 border-2 border-black rounded-md" placeholder="Security Code">
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
                
        

        
                <div id="AD002_LA_button_container" class="pt-5 mx-auto mt-16 text-center border-2 border-t-black">
                    <a href="/admin/learners" class="px-5 py-5 text-xl font-medium text-white bg-red-600 md:text-2xl hover:bg-red-900 rounded-xl">Cancel</a>
                    <button type="submit" class="px-5 py-5 text-xl font-medium text-white bg-green-600 md:text-2xl hover:bg-green-900 rounded-xl">Add New</button>
                </div>
            </form>
        </div>
        
        
    </section>
    
@endsection
