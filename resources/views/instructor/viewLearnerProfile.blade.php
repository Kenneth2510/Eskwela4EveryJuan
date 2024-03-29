@include('partials.header')

<section class="flex flex-row w-full h-screen text-sm main-container bg-mainwhitebg md:text-base">

    @include('partials.instructorNav')
    @include('partials.instructorSidebar')

        
    {{-- MAIN --}}
    <section class="w-full px-2 pt-[70px] mx-2 mt-2 md:w-3/4 lg:w-9/12  overscroll-auto md:overflow-auto">
        <div class="px-3 pb-4 rounded-lg shadow-lg b">

            <a href="{{ back()->getTargetUrl() }}" class="w-8 h-8 m-2">
                <svg xmlns="http://www.w3.org/2000/svg" height="25" viewBox="0 -960 960 960" width="24"><path d="m313-440 224 224-57 56-320-320 320-320 57 56-224 224h487v80H313Z"/></svg>
            </a>
        
            <div class="flex" id="upper_container">

                <div class="flex flex-col items-center justify-start w-3/12 h-full py-10 mx-5 bg-white rounded-lg shadow-lg" id="upper_left_container">
                    <div class="relative flex flex-col items-center justify-start"  style="margin:0 auto; padding: auto;">
                        <img class="z-0 w-40 h-40 rounded-full" src="{{ asset('storage/' . $learner->profile_picture) }}" alt="Profile Picture">
                    </div>

                    <div class="mt-10" id="name_area">
                        <h1 class="text-2xl font-semibold text-center">{{$learner->learner_fname}} {{$learner->learner_lname}}</h1>
                    </div>

                    <div class="mt-5 text-center" id="account_status_area">
                        <h1 class="text-xl">LEARNER</h1>

                        @if ($learner->status == 'Approved')
                        <div class="px-5 py-2 text-white bg-darthmouthgreen rounded-xl">Approved</div>
                        @elseif ($learner->status == 'Pending')
                        <div class="px-5 py-2 text-white bg-yellow-600 rounded-xl">Pending</div>
                        @else
                        <div class="px-5 py-2 text-white bg-red-500 rounded-xl">Rejected</div>
                        @endif
                    </div>

                    <div class="mt-10 text-center" id="email_area">
                        <h1 class="text-xl">Email</h1>
                        <h2 class="mb-5 text-md">{{$learner->learner_email}}</h2>

                        <a href="{{ url('/instructor/message') }}?email={{ $learner->learner_email }}&type=Learner" class="px-5 py-3 mt-10 text-lg text-white bg-darthmouthgreen hover:border-2 hover:bg-white hover:border-darthmouthgreen hover:text-darthmouthgreen rounded-xl">Send Message</a>
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
                                    <input class="w-full h-12 px-5 py-1 border-2 rounded-lg border-darthmouthgreen" type="text" name="learner_fname" id="learner_fname" value="{{$learner->learner_fname}}" disabled>
                                    <span id="firstNameError" class="text-red-500"></span>
                                </div>
                                <div class="mt-3" id="bdayArea">
                                    <label for="learner_bday ">Birthday</label><br>
                                    <input class="w-full h-12 px-5 py-1 border-2 rounded-lg border-darthmouthgreen" type="date" name="learner_bday" id="learner_bday" value="{{$learner->learner_bday}}" disabled>
                                    <span id="bdayError" class="text-red-500"></span>
                                </div>
                                <div class="mt-3" id="contactArea">
                                    <label for="learner_contactno">Contact Number</label><br>
                                    <input class="w-full h-12 px-5 py-1 border-2 rounded-lg border-darthmouthgreen" type="text" maxlength="11" name="learner_contactno" id="learner_contactno" value="{{$learner->learner_contactno}}" disabled>
                                </div>
                            </div>
                            <div class="w-1/2 mx-2" id="userInfo_right">
                                <div class="mt-3" id="lastNameArea">
                                    <label for="learner_lname">Last Name</label><br>
                                    <input class="w-full h-12 px-5 py-1 border-2 rounded-lg border-darthmouthgreen" type="text" name="learner_lname" id="learner_lname" value="{{$learner->learner_lname}}" disabled>
                                    <span id="lastNameError" class="text-red-500"></span>
                                </div>
                                <div class="mt-3" id="genderArea">
                                    <label for="learner_gender">Gender</label><br>
                                    <select class="w-full h-12 px-5 py-1 border-2 rounded-lg border-darthmouthgreen" name="learner_gender" id="learner_gender" disabled>
                                        <option value="" {{$learner->learner_gender == "" ? 'selected' : ''}}>-- select an option --</option>
                                        <option value="Male" {{$learner->learner_gender == "Male" ? 'selected' : ''}}>Male</option>
                                        <option value="Female" {{$learner->learner_gender == "Female" ? 'selected' : ''}}>Female</option>
                                        <option value="Others" {{$learner->learner_gender == "Others" ? 'selected' : ''}}>Preferred not to say</option>
                                    </select>
                                    <span id="genderError" class="text-red-500"></span>
                                </div>
                                <div class="mt-3" id="emailArea">
                                    <label for="learner_email">Email Address</label><br>
                                    <input class="w-full h-12 px-5 py-1 border-2 rounded-lg border-darthmouthgreen" type="email" name="learner_email" id="learner_email" value="{{$learner->learner_email}}" disabled>
                                </div>
                            </div>
                        </div>
                    </div>

                        <div class="w-full px-5 py-10 mt-5 bg-white shadow-lg rounded-xl" id="upper_right_2">
                            <h1 class="text-4xl font-semibold text-darthmouthgreen">Business Details</h1>

                            <hr class="my-6 border-t-2 border-gray-300">
                     
                            <div class="mt-3" id="businessNameArea">
                                <label for="business_name">Business Name</label><br>
                                <input class="w-full h-12 px-5 py-1 border-2 rounded-lg border-darthmouthgreen" type="text" name="business_name" id="business_name" value="{{$business->business_name}}" disabled>
                                <span id="businessNameError" class="text-red-500"></span>
                            </div>

                            <div class="mt-3" id="businessAddressArea">
                                <label for="business_address">Business Address</label><br>
                                <input class="w-full h-12 px-5 py-1 border-2 rounded-lg border-darthmouthgreen" type="text" name="business_address" id="business_address" value="{{$business->business_address}}" disabled>
                                <span id="businessAddressError" class="text-red-500"></span>
                            </div>

                            <div class="mt-3" id="businessOwnerArea">
                                <label for="business_owner_name">Business Owner Name</label><br>
                                <input class="w-full h-12 px-5 py-1 border-2 rounded-lg border-darthmouthgreen" type="text" name="business_owner_name" id="business_owner_name" value="{{$business->business_owner_name}}" disabled>
                                <span id="businessOwnerNameError" class="text-red-500"></span>
                            </div>

                            <div class="mt-3" id="bplo_account_numberArea">
                                <label for="bplo_account_number">BPLO Account Number</label><br>
                                <input class="w-full h-12 px-5 py-1 border-2 rounded-lg border-darthmouthgreen" maxlength="13" type="text" name="bplo_account_number" id="bplo_account_number" value="{{$business->bplo_account_number}}" disabled>
                            </div>

                            <div class="flex justify-between w-full">
                                                        
                                <div class="w-full mt-3 mr-2" id="business_categoryArea">
                                    <label for="business_category">Business Category</label><br>
                                    <select class="w-full h-12 px-5 py-1 border-2 rounded-lg border-darthmouthgreen" name="business_category" id="business_category" disabled>
                                        <option value="" {{$business->business_category == "" ? 'selected' : ''}}>-- select an option --</option>
                                        <option value="Micro" {{$business->business_category == "Micro" ? 'selected' : ''}}>Micro</option>
                                        <option value="Small" {{$business->business_category == "Small" ? 'selected' : ''}}>Small</option>
                                        <option value="Medium" {{$business->business_category == "Medium" ? 'selected' : ''}}>Medium</option>
                                    </select>
                                    <span id="businessCategoryError" class="text-red-500"></span>
                                </div>

                                <div class="w-full mt-3 ml-2" id="business_classificationArea">
                                    <label for="business_classification">Business Classification</label><br>
                                    <select class="w-full h-12 px-5 py-1 border-2 rounded-lg border-darthmouthgreen" name="business_classification" id="business_classification" disabled>
                                        <option value="" {{$business->business_classification == "" ? 'selected' : ''}}>-- select an option --</option>
                                        <option value="Retail" {{$business->business_classification == "Retail" ? 'selected' : ''}}>Retail</option>
                                        <option value="Wholesale" {{$business->business_classification == "Wholesale" ? 'selected' : ''}}>Wholesale</option>
                                        <option value="Financial Services" {{$business->business_classification == "Financial Services" ? 'selected' : ''}}>Financial Services</option>
                                        <option value="Real Estate" {{$business->business_classification == "Real Estate" ? 'selected' : ''}}>Real Estate</option>
                                        <option value="Transportation and Logistics" {{$business->business_classification == "Transportation and Logistics" ? 'selected' : ''}}>Transportation and Logistics</option>
                                        <option value="Technology" {{$business->business_classification == "Technology" ? 'selected' : ''}}>Technology</option>
                                        <option value="Healthcare" {{$business->business_classification == "Healthcare" ? 'selected' : ''}}>Healthcare</option>
                                        <option value="Education and Training" {{$business->business_classification == "Education and Training" ? 'selected' : ''}}>Education and Training</option>
                                        <option value="Entertainment and Media" {{$business->business_classification == "Entertainment and Media" ? 'selected' : ''}}>Entertainment and Media</option>
                                        <option value="Hospitality and Tourism" {{$business->business_classification == "Hospitality and Tourism" ? 'selected' : ''}}>Hospitality and Tourism</option>

                                    </select>
                                    <span id="businessClassificationError" class="text-red-500"></span>
                                </div>
                            </div>

                            <div class="mt-3" id="business_descriptionArea">
                                <label for="business_description">Business Description</label><br>
                                <textarea name="business_description" class="w-full px-5 py-1 border-2 rounded-lg h-36 border-darthmouthgreen" id="business_description" disabled>{{$business->business_description}}</textarea>
                                <span id="businessDescriptionError" class="text-red-500"></span>
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
                                    <th></th>
                                </thead>
                                <tbody>
                                    @foreach ($courses as $course)
                                    <tr>
                                        <td class="py-5">{{ $course->course_name }}</td>
                                        <td>{{ $course->course_progress }}</td>
                                        <td>{{ $course->start_period }}</td>
                                        <td>{{ $course->finish_period }}</td>
                                        <td>
                                            <a href="{{ url("/learner/course/$$course->course_id") }}"></a>
                                        </td>
                                    </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>


                    </div>
                </div>
            </div>
            
        </div>
    </section>


    @include('partials.instructorProfile')
        
    </section>


@include('partials.footer')