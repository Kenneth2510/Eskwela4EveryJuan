@include('partials.header')

<section class="flex flex-row w-full h-screen text-sm main-container bg-mainwhitebg md:text-base">
    @include('partials.instructorNav')
    @include('partials.learnerSidebar')

        {{-- MAIN --}}
    <section class="w-full px-2 pt-[20px] mx-2 mt-2 md:w-3/4 lg:w-9/12  overscroll-auto md:overflow-auto">
        <div class="h-screen px-3 pb-4 overflow-auto rounded-lg shadow-lg b overscroll-auto">


            <div class="flex h-full" id="upper_container">

                <div class="w-3/12 h-full py-10 overflow-y-auto bg-white shadow-lg" id="upper_left_container">
                    
                    <div class="flex flex-col items-center justify-start w-full pb-5 border-b-2 border-b-darthmouthgreen" id="search_area">
                        <input type="text" name="search" id="search" class="px-5 py-3 bg-gray-300 rounded-full" placeholder="search">

                        <a href="" class="px-5 py-3 mt-3 text-white bg-darthmouthgreen rounded-2xl hover:border-2 hover:bg-white hover:border-darthmouthgreen hover:text-darthmouthgreen">Create Message</a>
                    </div>

                    <div class="w-full" id="message_list_area">
                        <ul>
                            <li class="border-b border-darthmouthgreen selectedMessage">
                                <button class="w-full">
                                    <div class="flex py-2 m-5">
                                        <div class="w-1/4" id="profile_photo_area">
                                            <img class="z-0 w-10 h-10 rounded-full" src="{{ asset('storage/' . $learner->profile_picture) }}" alt="Profile Picture">
                                        </div>
                                        <div class="w-3/4">
                                            <div class="flex flex-col items-start justify-start" id="userInfoArea">
                                                <h1 class="text-md">fname lname</h1>
                                                <h4 class="text-md">02/14/2024</h4>
                                            </div>
                                            <div class="text-left " id="previewmessge">
                                                <p class="text-sm opacity-30">sample message sample mesage sample message </p>
                                            </div>
                                        </div>

                                    </div>   
                                </button>
                            </li>

                            <li class="border-b border-darthmouthgreen">
                                <button class="w-full">
                                    <div class="flex py-2 m-5">
                                        <div class="w-1/4" id="profile_photo_area">
                                            <img class="z-0 w-10 h-10 rounded-full" src="{{ asset('storage/' . $learner->profile_picture) }}" alt="Profile Picture">
                                        </div>
                                        <div class="w-3/4">
                                            <div class="flex flex-col items-start justify-start" id="userInfoArea">
                                                <h1 class="text-md">fname lname</h1>
                                                <h4 class="text-md">02/14/2024</h4>
                                            </div>
                                            <div class="text-left " id="previewmessge">
                                                <p class="text-sm opacity-30">sample message sample mesage sample message </p>
                                            </div>
                                        </div>
                                        <div class="">
                                            <div class="w-2 h-2 rounded-full bg-darthmouthgreen"></div>
                                        </div>

                                    </div>   
                                </button>
                            </li>


                            <li class="border-b border-darthmouthgreen">
                                <button class="w-full">
                                    <div class="flex py-2 m-5">
                                        <div class="w-1/4" id="profile_photo_area">
                                            <img class="z-0 w-10 h-10 rounded-full" src="{{ asset('storage/' . $learner->profile_picture) }}" alt="Profile Picture">
                                        </div>
                                        <div class="w-3/4">
                                            <div class="flex flex-col items-start justify-start" id="userInfoArea">
                                                <h1 class="text-md">fname lname</h1>
                                                <h4 class="text-md">02/14/2024</h4>
                                            </div>
                                            <div class="text-left " id="previewmessge">
                                                <p class="text-sm opacity-30">sample message sample mesage sample message </p>
                                            </div>
                                        </div>

                                    </div>   
                                </button>
                            </li>


                            <li class="border-b border-darthmouthgreen">
                                <button class="w-full">
                                    <div class="flex py-2 m-5">
                                        <div class="w-1/4" id="profile_photo_area">
                                            <img class="z-0 w-10 h-10 rounded-full" src="{{ asset('storage/' . $learner->profile_picture) }}" alt="Profile Picture">
                                        </div>
                                        <div class="w-3/4">
                                            <div class="flex flex-col items-start justify-start" id="userInfoArea">
                                                <h1 class="text-md">fname lname</h1>
                                                <h4 class="text-md">02/14/2024</h4>
                                            </div>
                                            <div class="text-left " id="previewmessge">
                                                <p class="text-sm opacity-30">sample message sample mesage sample message </p>
                                            </div>
                                        </div>

                                    </div>   
                                </button>
                            </li>


                            <li class="border-b border-darthmouthgreen">
                                <button class="w-full">
                                    <div class="flex py-2 m-5">
                                        <div class="w-1/4" id="profile_photo_area">
                                            <img class="z-0 w-10 h-10 rounded-full" src="{{ asset('storage/' . $learner->profile_picture) }}" alt="Profile Picture">
                                        </div>
                                        <div class="w-3/4">
                                            <div class="flex flex-col items-start justify-start" id="userInfoArea">
                                                <h1 class="text-md">fname lname</h1>
                                                <h4 class="text-md">02/14/2024</h4>
                                            </div>
                                            <div class="text-left " id="previewmessge">
                                                <p class="text-sm opacity-30">sample message sample mesage sample message </p>
                                            </div>
                                        </div>

                                    </div>   
                                </button>
                            </li>


                            <li class="border-b border-darthmouthgreen">
                                <button class="w-full">
                                    <div class="flex py-2 m-5">
                                        <div class="w-1/4" id="profile_photo_area">
                                            <img class="z-0 w-10 h-10 rounded-full" src="{{ asset('storage/' . $learner->profile_picture) }}" alt="Profile Picture">
                                        </div>
                                        <div class="w-3/4">
                                            <div class="flex flex-col items-start justify-start" id="userInfoArea">
                                                <h1 class="text-md">fname lname</h1>
                                                <h4 class="text-md">02/14/2024</h4>
                                            </div>
                                            <div class="text-left " id="previewmessge">
                                                <p class="text-sm opacity-30">sample message sample mesage sample message </p>
                                            </div>
                                        </div>

                                    </div>   
                                </button>
                            </li>

                            <li class="border-b border-darthmouthgreen">
                                <button class="w-full">
                                    <div class="flex py-2 m-5">
                                        <div class="w-1/4" id="profile_photo_area">
                                            <img class="z-0 w-10 h-10 rounded-full" src="{{ asset('storage/' . $learner->profile_picture) }}" alt="Profile Picture">
                                        </div>
                                        <div class="w-3/4">
                                            <div class="flex flex-col items-start justify-start" id="userInfoArea">
                                                <h1 class="text-md">fname lname</h1>
                                                <h4 class="text-md">02/14/2024</h4>
                                            </div>
                                            <div class="text-left " id="previewmessge">
                                                <p class="text-sm opacity-30">sample message sample mesage sample message </p>
                                            </div>
                                        </div>

                                    </div>   
                                </button>
                            </li>

                            
                        </ul>
                    </div>

                </div> 
                <div class="w-9/12 h-full bg-white shadow-lg rounded-xl" id="upper_right_container">
                    <h1 class="px-5 py-10 text-3xl font-semibold text-darthmouthgreen">User Details</h1>
                    
                    <hr class="px-5 pt-10 my-6 border-t-2 border-gray-300">
                    
                    <div class="flex flex-col justify-between px-5" id="messageContentArea">
                        <div class="flex-grow overflow-y-auto" id="messageContainer">
                            <div class="pb-10 border-b border-darthmouthgreen" id="mainMessage">
                                <div class="flex items-center" id="userInfoArea">
                                    <div class="" id="profile_photo_area">
                                        <img class="z-0 w-16 h-16 rounded-full" src="{{ asset('storage/' . $learner->profile_picture) }}" alt="Profile Picture">
                                    </div>
                                    <div class="flex flex-col items-start justify-start pl-3" id="userInfoArea">
                                        <h1 class="text-lg">fname lname</h1>
                                        <h4 class="text-lg">02/14/2024</h4>
                                    </div>
                                </div>
                                <div class="px-16 mt-10" id="messageContent">
                                    <div><p>sample sample sample sample messaghe msapleam sapl;a</p></div>
                                </div>
                            </div>
                
                            <div class="mt-3" id="mainMessageReplyArea">
                                <div class="pb-10 mt-3 border-b border-darthmouthgreen" id="reply">
                                    <div class="flex items-center" id="userInfoArea">
                                        <div class="" id="profile_photo_area">
                                            <img class="z-0 w-16 h-16 rounded-full" src="{{ asset('storage/' . $learner->profile_picture) }}" alt="Profile Picture">
                                        </div>
                                        <div class="flex flex-col items-start justify-start pl-3" id="userInfoArea">
                                            <h1 class="text-lg">fname lname</h1>
                                            <h4 class="text-lg">02/14/2024</h4>
                                        </div>
                                    </div>
                                    <div class="px-16 mt-10" id="messageContent">
                                        <div><p>sample sample sample sample messaghe msapleam sapl;a</p></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                
                        <div class="flex items-center w-full mt-20" id="reply_area">
                            
                            <button class="px-5 py-3 mx-1 text-white rounded-full bg-darthmouthgreen hover:bg-white hover:text-darthmouthgreen hover:border hover:border-darthmouthgreen"><i class="fa-solid fa-image" style="color: #ffffff;"></i></button>
                            <button class="px-5 py-3 mx-1 text-white rounded-full bg-darthmouthgreen hover:bg-white hover:text-darthmouthgreen hover:border hover:border-darthmouthgreen"><i class="fa-solid fa-file" style="color: #ffffff;"></i></button>
                            <textarea name="reply" id="reply" class="w-9/12 p-3 border rounded-lg max-w-10/12 border-darthmouthgreen"></textarea>
                            <button class="px-5 py-3 ml-2 text-white bg-darthmouthgreen hover:bg-white hover:text-darthmouthgreen hover:border hover:border-darthmouthgreen rounded-xl">Send</button>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>



        </div>
    </section>



@include('partials.learnerProfile')
</section>
@include('partials.footer')