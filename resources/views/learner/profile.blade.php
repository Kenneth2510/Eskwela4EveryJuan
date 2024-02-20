@include('partials.header')

<section class="flex flex-row w-full h-screen text-sm main-container bg-mainwhitebg md:text-base">

    @include('partials.instructorNav')
    @include('partials.learnerSidebar')

        
    {{-- MAIN --}}
    <section class="w-full px-2 pt-[70px] mx-2 mt-2 md:w-3/4 lg:w-9/12  overscroll-auto md:overflow-auto">
        <div class="px-3 pb-4 rounded-lg shadow-lg b">

            <div class="flex" id="upper_container">

                <div class="flex flex-col items-center justify-start w-3/12 h-full py-10 mx-5 bg-white rounded-lg shadow-lg" id="upper_left_container">
                    <div class="relative flex flex-col items-center justify-start"  style="margin:0 auto; padding: auto;">
                        <img class="z-0 w-8/12 rounded-full h-8/12" src="{{ asset('storage/' . $learner->profile_picture) }}" alt="Profile Picture">
                        <button style="position: absolute; bottom: -6px; right: 50px;" class="w-12 h-12 text-white rounded-full z-5 bg-darthmouthgreen hover:bg-white hover:border-darthmouthgreen hover:border-2 hover:text-darthmouthgreen"><i class="fa-solid fa-camera"></i></button>
                    </div>

                    <div class="mt-10" id="name_area">
                        <h1 class="text-2xl font-semibold text-center">First Name Last Name</h1>
                    </div>

                    <div class="mt-5 text-center" id="account_status_area">
                        <h1 class="text-xl">LEARNER</h1>
                        <h1 class="text-xl">ID: 1</h1>

                        <div class="px-5 py-2 text-white bg-darthmouthgreen rounded-xl">Approved</div>
                        {{-- <div class="px-5 py-2 text-white bg-red-500 rounded-xl">Rejected</div>
                        <div class="px-5 py-2 text-white bg-yellow-600 rounded-xl">Pending</div> --}}
                    </div>

                    <div class="mt-10 text-center" id="email_area">
                        <h1 class="text-xl">Email</h1>
                        <h2 class="text-lg">email@email.com</h2>

                        <button class="px-5 py-3 text-lg text-white bg-darthmouthgreen hover:border-2 hover:bg-white hover:border-darthmouthgreen hover:text-darthmouthgreen rounded-xl">Send Message</button>
                    </div>
                </div> 

                
                <div class="w-9/12 h-full" id="upper_right_container">
                    <div class="w-full px-5 py-10 bg-white shadow-lg rounded-xl" id="upper_right_1">
                        <h1 class="text-4xl font-semibold text-darthmouthgreen">User Details</h1>

                        <hr class="my-6 border-t-2 border-gray-300">
                        <div class="flex w-full mt-5" id="userInfo">
                            <div class="w-1/2 mx-2" id="userInfo_left">
                                <div class="mt-3" id="firstNameArea">
                                    <label for="learner_fname">First Name</label><br>
                                    <input class="w-full h-12 px-5 py-1 border-2 rounded-lg border-darthmouthgreen" type="text" name="learner_fname" id="learner_fname">
                                </div>
                                <div class="mt-3" id="bdayArea">
                                    <label for="learner_bday ">Birthday</label><br>
                                    <input class="w-full h-12 px-5 py-1 border-2 rounded-lg border-darthmouthgreen" type="date" name="learner_bday " id="learner_bday ">
                                </div>
                                <div class="mt-3" id="contactArea">
                                    <label for="learner_contactno">Contact Number</label><br>
                                    <input class="w-full h-12 px-5 py-1 border-2 rounded-lg border-darthmouthgreen" type="text" maxlength="11" name="learner_contactno" id="learner_contactno" disabled>
                                    
                                </div>
                            </div>
                            <div class="w-1/2 mx-2" id="userInfo_right">
                                <div class="mt-3" id="lastNameArea">
                                    <label for="learner_lname">Last Name</label><br>
                                    <input class="w-full h-12 px-5 py-1 border-2 rounded-lg border-darthmouthgreen" type="text" name="learner_lname" id="learner_lname">
                                </div>
                                <div class="mt-3" id="genderArea">
                                    <label for="learner_gender">Gender</label><br>
                                    <select class="w-full h-12 px-5 py-1 border-2 rounded-lg border-darthmouthgreen" name="learner_gender" id="learner_gender">
                                        <option value="">-- select an option --</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                        <option value="Others">Preferred not to say</option>
                                    </select>
                                </div>
                                <div class="mt-3" id="emailArea">
                                    <label for="learner_email">Email Address</label><br>
                                    <input class="w-full h-12 px-5 py-1 border-2 rounded-lg border-darthmouthgreen" type="email" name="learner_email" id="learner_email" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="flex justify-end w-full px-5 mt-5">
                            <button class="px-5 py-3 text-lg text-white bg-darthmouthgreen hover:border-2 hover:bg-white hover:border-darthmouthgreen hover:text-darthmouthgreen rounded-xl">edit</button>
                        </div>
                    </div>

                        <div class="w-full px-5 py-10 mt-5 bg-white shadow-lg rounded-xl" id="upper_right_2">
                            <h1 class="text-4xl font-semibold text-darthmouthgreen">Business Details</h1>

                            <hr class="my-6 border-t-2 border-gray-300">

                            <div class="mt-3" id="businessNameArea">
                                <label for="business_name">Business Name</label><br>
                                <input class="w-full h-12 px-5 py-1 border-2 rounded-lg border-darthmouthgreen" type="text" name="business_name" id="business_name">
                            </div>

                            <div class="mt-3" id="businessAddressArea">
                                <label for="business_adddress">Business Address</label><br>
                                <input class="w-full h-12 px-5 py-1 border-2 rounded-lg border-darthmouthgreen" type="text" name="business_adddress" id="business_adddress">
                            </div>

                            <div class="mt-3" id="businessOwnerArea">
                                <label for="business_owner_name">Business Owner Name</label><br>
                                <input class="w-full h-12 px-5 py-1 border-2 rounded-lg border-darthmouthgreen" type="text" name="business_owner_name" id="business_owner_name">
                            </div>

                            <div class="mt-3" id="bplo_account_numberArea">
                                <label for="bplo_account_number">BPLO Account Number</label><br>
                                <input class="w-full h-12 px-5 py-1 border-2 rounded-lg border-darthmouthgreen" maxlength="13" type="text" name="bplo_account_number" id="bplo_account_number">
                            </div>

                            <div class="flex justify-between w-full">
                                                        
                                <div class="w-full mt-3 mr-2" id="business_categoryArea">
                                    <label for="business_category">Business Category</label><br>
                                    <select class="w-full h-12 px-5 py-1 border-2 rounded-lg border-darthmouthgreen" name="business_category" id="business_category">
                                        <option value="">-- select an option --</option>
                                        <option value="Micro">Micro</option>
                                        <option value="Small">Small</option>
                                        <option value="Medium">Medium</option>
                                    </select>
                                </div>

                                <div class="w-full mt-3 ml-2" id="business_classificationArea">
                                    <label for="business_classification">Business Classification</label><br>
                                    <select class="w-full h-12 px-5 py-1 border-2 rounded-lg border-darthmouthgreen" name="business_classification" id="business_classification">
                                        <option value="">-- select an option --</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                        <option value="Others">Preferred not to say</option>
                                    </select>
                                </div>
                            </div>

                            <div class="mt-3" id="business_descriptionArea">
                                <label for="business_description">Business Description</label><br>
                                <textarea name="business_description" class="w-full px-5 py-1 border-2 rounded-lg h-36 border-darthmouthgreen" id="business_description"></textarea>
                            </div>

                            <div class="flex justify-end w-full px-5 mt-5">
                                <button class="px-5 py-3 text-lg text-white bg-darthmouthgreen hover:border-2 hover:bg-white hover:border-darthmouthgreen hover:text-darthmouthgreen rounded-xl">edit</button>
                            </div>
                        </div>

                        <div class="w-full px-5 py-10 mt-5 bg-white shadow-lg rounded-xl" id="upper_right_3">
                            <h1 class="text-4xl font-semibold text-darthmouthgreen">Account Details</h1>

                            <hr class="my-6 border-t-2 border-gray-300">

                            <div class="mt-3" id="learner_usernameArea">
                                <label for="learner_username">Username</label><br>
                                <input class="w-full h-12 px-5 py-1 border-2 rounded-lg border-darthmouthgreen" type="text" name="learner_username" id="learner_username" disabled>
                            </div>

                            <div class="mt-3" id="learnerPasswordArea">
                                <label for="password">Password</label><br>
                                <input class="w-full h-12 px-5 py-1 border-2 rounded-lg border-darthmouthgreen" type="text" name="password" id="password">
                            </div>

                            <div class="mt-3" id="new_passwordArea">
                                <label for="learnerNewPassword">New Password</label><br>
                                <input class="w-full h-12 px-5 py-1 border-2 rounded-lg border-darthmouthgreen" type="text" name="learnerNewPassword" id="learnerNewPassword">
                            </div>

                            <div class="mt-3" id="learnerPasswordConfirmArea">
                                <label for="learnerNewPasswordConfirm">Confirm New Password</label><br>
                                <input class="w-full h-12 px-5 py-1 border-2 rounded-lg border-darthmouthgreen" type="text" name="learnerNewPasswordConfirm" id="learnerNewPasswordConfirm">
                            </div>

                            <div class="mt-3" id="securitCodeArea">
                                <label for="learner_security_code">Enter your Security Code</label><br>
                                <input class="w-full h-12 px-5 py-1 border-2 rounded-lg border-darthmouthgreen" type="text" maxlength="6" name="learner_security_code" id="learner_security_code">
                            </div>

                            <div class="flex justify-end w-full px-5 mt-5">
                                <button class="px-5 py-3 text-lg text-white bg-darthmouthgreen hover:border-2 hover:bg-white hover:border-darthmouthgreen hover:text-darthmouthgreen rounded-xl">Change Password</button>
                            </div>
                        </div>

                        <div class="w-full px-5 py-10 mt-5 bg-white shadow-lg rounded-xl" id="courseProgress">
                            <h1 class="text-4xl font-semibold text-darthmouthgreen">Courses Progress</h1>

                            <hr class="my-6 border-t-2 border-gray-300">

                            <table class="w-full">
                                <thead>
                                    <th>Course Name</th>
                                    <th>Status</th>
                                    <th>Start Period</th>
                                    <th>Finish Period</th>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="py-5">HTML</td>
                                        <td>IN PROGRESS</td>
                                        <td>02/14/2024</td>
                                        <td>02/14/2024</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        
                        <div class="w-full px-5 py-10 mt-5 bg-white shadow-lg rounded-xl" id="courseProgress">
                            <h1 class="text-4xl font-semibold text-darthmouthgreen">Your Credentials</h1>

                            <hr class="my-6 border-t-2 border-gray-300">

                            <a href="">sample</a>

                            <div class="flex justify-end w-full px-5 mt-5">
                                <button class="px-5 py-3 text-lg text-white bg-darthmouthgreen hover:border-2 hover:bg-white hover:border-darthmouthgreen hover:text-darthmouthgreen rounded-xl">Change File</button>
                            </div>
                        </div>


                                                
                        <div class="w-full px-5 py-10 mt-5 bg-white shadow-lg rounded-xl" id="courseProgress">
                            <h1 class="text-4xl font-semibold text-darthmouthgreen">Courses Managed</h1>

                            <hr class="my-6 border-t-2 border-gray-300">

                            <table class="w-full">
                                <thead>
                                    <th>Course Name</th>
                                    <th>Status</th>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="py-5">HTML</td>
                                        <td>IN PROGRESS</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
            
        </div>
    </section>

    @include('partials.learnerProfile')
        
    </section>

@include('partials.footer')