@include('partials.header')

<section id="sidebarfull" class="fixed top-0 left-0 z-20 w-16 h-full max-w-lg mx-auto px-auto smallpc:w-64 md:w-16 lg:w-64 bg-seagreen">
    <div id="sidebarfull_menu" class="relative w-full mt-5 text-center">
        <h1 class="hidden mx-1 text-2xl font-semibold text-white lg:block">Eskwela4EveryJuan</h1>
        <button class="">
            <i class="text-3xl fa-solid fa-bars" style="color: #ffffff;"></i>
        </button>
    </div>

    <div id="sidebar" class="relative w-16 mx-auto smallpc:w-64 lg:w-64 lg:px-5">
        <ul class="mx-auto list-none list-inside my-28">
            <li class="py-5 rounded-lg hover:bg-green-100 hover:bg-opacity-10 group ">
                <a href="/admin/dashboard">
                <div class="flex items-center px-3 rounded-lg" id="dashboard">
                    <i class="w-12 text-2xl text-center fa-solid fa-house px-auto group-hover:text-3xl" style="color: #ffffff;"></i>
                    <h3 class="hidden px-3 text-xl font-normal text-white lg:block group-hover:text-black group-hover:text-xl group-hover:font-semibold">Dashboard</h3>
                </div>
            </a></li>

            <li class="py-5 rounded-lg hover:bg-green-100 hover:bg-opacity-10 group selected">
                <a href="/admin/learners">
                <div class="flex items-center px-3 rounded-lg" id="learners">
                    <i class="w-12 text-2xl text-center fa-solid fa-user px-auto group-hover:text-3xl" style="color: #ffffff;"></i>
                    <h3 class="hidden px-3 text-xl font-normal text-white lg:block group-hover:text-black group-hover:text-xl group-hover:font-semibold">Learners</h3>
                </div>
            </a></li>


            <li class="py-5 rounded-lg hover:bg-green-100 hover:bg-opacity-10 group">
                <a href="">
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

<section id="add_new_container" class="relative ml-16 md:ml-16 lg:ml-64">

    <div id="title" class="relative flex items-center justify-between h-16 px-3 mx-auto my-3 py-auto">
        <h1 class="text-4xl font-semibold">Add New Learner</h1>
        <div id="adminuser" class="flex items-center">
            <h3 class="text-lg">admin</h3>
            <div id="icon" class="w-10 h-10 mx-3 rounded-full bg-slate-400"></div>
        </div>
    </div>

    <div id="maincontainer" class="relative h-full px-5 py-5 mx-5 mt-5 bg-white shadow-2xl rounded-xl">
        <div class="mb-5">
            <a href="" class="">
                <i class="text-2xl md:text-3xl fa-solid fa-arrow-left" style="color: #000000;"></i>
            </a>
        </div>

        <form action="">
            @csrf
        <div class="smallpc:flex smallpc:items-start">
            <div id="personal_details_container" class="mx-auto my-5 smallpc:w-6/12">
                <h3 class="mb-5 text-3xl font-medium border-b-2 md:text-4xl border-b-black">Personal Details</h3>
                <div id="namefield" class="flex mt-5">
                    <h4 class="w-32 ml-3 text-lg font-medium md:w-40 md:text-2xl">Name</h4>
                    <div class="block">
                        <div class="mb-3">
                            <label for="fname" class="text-md font-regular md:text-lg">First Name</label>
                            <br>
                            <input type="text" name="fname" class="px-3 py-2 text-lg border-2 border-black rounded-md md:text-xl w-15" placeholder="First Name">
                        </div>
                        <div class="mb-3">
                            <label for="lname" class="text-md font-regular md:text-lg">Last Name</label><br>
                            <input type="text" name="lname" class="px-3 py-2 text-lg border-2 border-black rounded-md md:text-xl w-15"  placeholder="Last Name">
                        </div>
                        
                    </div>
                </div>
    
                <div id="bday_genderfield" class="">
                    <div id="bdayfield" class="flex mt-5">
                        <h4 class="w-32 ml-3 text-lg font-medium md:w-40 md:text-2xl">Birthday</h4>
                        <div class="">
                            <label for="bday" class="hidden">Birthday</label>
                            <input type="date" name="bday" class="px-3 py-2 text-lg border-2 border-black rounded-md md:text-xl w-15">
                        </div>
                    </div>
                    <div id="gender" class="flex mt-5">
                        <h4 class="w-32 ml-3 text-lg font-medium md:w-40 md:text-2xl">Gender</h4>
                        <div class="">
                            <label for="gender" class="hidden">Gender</label>
                            <select name="gender" id="gender" class="px-3 py-2 text-lg border-2 border-black rounded-md md:text-xl w-15">
                                <option value="" class=""></option>
                                <option value="male" class="">Male</option>
                                <option value="female" class="">Female</option>
                                <option value="others" class="">Preferred not to say</option>
                            </select>
                        </div>
                    </div>
                </div>
    
                <div id="email" class="flex mt-5">
                    <h4 class="w-32 ml-3 text-lg font-medium md:w-40 md:text-2xl">Email</h4>
                    <div class="">
                        <label for="email" class="hidden">Email</label>
                        <input type="email" name="email" class="px-3 py-2 text-lg border-2 border-black rounded-md w-15 md:text-xl" placeholder="Email">
                    </div>
                </div>
    
                <div id="contactno" class="flex mt-5">
                    <h4 class="w-32 ml-3 text-lg font-medium leading-5 md:w-40 md:text-2xl">Contact Number</h4>
                    <div class="">
                        <label for="contactno" class="hidden">Contact Number</label>
                        <input type="tel" id="contactno" pattern="[0-9]{10}" name="contactno" class="px-3 py-2 text-lg border-2 border-black rounded-md w-15 md:text-xl" placeholder="09">
                    </div>
                </div>
    
                <script>
                    // Add event listener to restrict input to numbers only
                    document.getElementById("contactno").addEventListener("input", function(event) {
                        event.target.value = event.target.value.replace(/\D/g, "");
                    });
                </script>
    
            </div>
    
            <div id="businessdetailsfields" class="mx-auto my-5 mt-16 smallpc:w-6/12">
                <h3 class="mb-5 text-3xl font-medium border-b-2 border-b-black md:text-4xl">Business Details</h3>
                <div id="businessfields_container" class="mt-5">
                    <div id="businessname" class="flex">
                        <h4 class="w-40 ml-3 text-lg font-medium leading-5 md:w-60 md:text-2xl">Business Name</h4>
                        <div class="">
                            <label for="businessname" class="hidden">Business Name</label>
                            <input type="text" class="px-3 py-2 text-lg border-2 border-black rounded-md md:text-xl w-15" name="businessname" placeholder="Business Name">
                        </div>
                    </div>
    
                    <div id="businessaddress" class="flex mt-5">
                        <h4 class="w-40 ml-3 text-lg font-medium md:w-60 md:text-2xl ">Business Address</h4>
                        <div class="">
                            <label for="businessaddress" class="hidden">Business Address</label>
                            <input type="text" class="px-3 py-2 text-lg border-2 border-black rounded-md md:text-xl w-15" name="businessaddress" placeholder="Business Address">
                        </div>
                    </div>
    
                    <div id="businessownername" class="flex mt-5">
                        <h4 class="w-40 ml-3 text-lg font-medium leading-5 md:w-60 md:text-2xl">Business Owner Name</h4>
                        <div class="">
                            <label for="businessownername" class="hidden">Business Owner Name</label>
                            <input type="text" class="px-3 py-2 text-lg border-2 border-black rounded-md md:text-xl w-15" name="businessownername" placeholder="Business Owner Name">
                        </div>
                    </div>
    
                    <div id="businessbplonumber" class="flex mt-5">
                        <h4 class="w-40 ml-3 text-lg font-medium leading-5 md:w-60 md:text-2xl">BPLO Account Number</h4>
                        <div class="">
                            <label for="businessbplonumber" class="hidden">BPLO Account Number</label>
                            <input type="text" class="px-3 py-2 text-lg border-2 border-black rounded-md md:text-xl w-15" name="businessbplonumber" placeholder="">
                        </div>
                    </div>
    
                    <div id="businesscategory" class="flex mt-5">
                        <h4 class="w-40 ml-3 text-lg font-medium leading-5 md:w-60 md:text-2xl">Business Category</h4>
                        <div class="">
                        <label for="businesscategory" class="hidden">Business Category</label>
                            <select name="businesscategory" id="" class="px-3 py-2 text-lg border-2 border-black rounded-md md:text-xl w-15">
                                <option value="" class=""></option>
                                <option value="micro" class="">Micro</option>
                                <option value="small" class="">Small</option>
                                <option value="large" class="">Large</option>
                            </select>
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
                            <label for="username" class="hidden">Username</label>
                            <input type="text" name="username" class="px-3 py-2 text-lg border-2 border-black rounded-md md:text-xl w-15" placeholder="Username">
                        </div>
                    </div>
    
                    <div id="password" class="flex mt-5">
                        <h4 class="w-32 ml-3 text-lg font-medium leading-5 md:w-60 md:text-2xl">Password</h4>
                        <div class="">
                            <label for="password" class="hidden">Password</label>
                            <input type="password" name="password" class="px-3 py-2 text-lg border-2 border-black rounded-md md:text-xl w-15" placeholder="Password">
                        </div>
                    </div>
    
                    <div id="password_confirm" class="flex mt-5">
                        <h4 class="w-32 ml-3 text-lg font-medium leading-5 md:w-60 md:text-2xl">Cofirm Password</h4>
                        <div class="">
                            <label for="password_confirm" class="hidden">Cofirm Password</label>
                            <input type="password" name="password_confirm" class="px-3 py-2 text-lg border-2 border-black rounded-md md:text-xl w-15" placeholder="Confirm Password">
                        </div>
                    </div>
    
                    <div id="securitynum" class="flex mt-5">
                        <h4 class="w-32 ml-3 text-lg font-medium leading-5 md:w-60 md:text-2xl">SecurityCode</h4>
                        <div class="">
                            <label for="securitynum" class="hidden">SecurityCode</label>
                            <input type="text" maxlength="6" name="securitynum" class="px-3 py-2 text-lg border-2 border-black rounded-md md:text-xl w-15" placeholder="Seucrity Code">
                        </div>
                    </div>
                </div>
            </div>
    
            <div id="button_container" class="pt-5 mx-auto mt-16 text-center border-2 border-t-black">
                <a href="" class="px-5 py-5 text-xl font-medium text-white bg-red-600 md:text-2xl hover:bg-red-900 rounded-xl">cancel</a>
                <button type="submit" class="px-5 py-5 text-xl font-medium text-white bg-green-600 md:text-2xl hover:bg-green-900 rounded-xl">Add New</button>
            </div>
        </form>
    </div>
    
    
</section>

@include('partials.footer')