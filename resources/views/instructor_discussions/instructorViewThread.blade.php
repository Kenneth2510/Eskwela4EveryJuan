@include('partials.header')

<section class="flex flex-row w-full h-screen text-sm main-container bg-mainwhitebg md:text-base">
    @include('partials.instructorNav')
    @include('partials.instructorSidebar')

    {{-- MAIN --}}
    <section class="w-full px-2 pt-[120px] mx-2 mt-2 md:w-3/4 lg:w-9/12  overscroll-auto md:overflow-auto">
        <div class="px-3 pb-4 overflow-auto rounded-lg shadow-lg b overscroll-auto">
            <h1 class="mx-5 text-2xl font-semibold md:text-3xl">DISCUSSION FORUMS</h1>
            <hr class="border-t-2 border-gray-300 my-6">


            <div class="w-full my-5 px-40" id="mainContainer">
            
                <div data-thread-id="{{ $thread->thread_id }}" class="bg-white w-full flex border-2 my-5 border-darthmouthgreen rounded-lg border-opacity-75 thread" id="thread_{{ $thread->thread_id }}">
                    <div class="w-1/12 border-r-2 border-darthmouthgreen border-opacity-50" id="upvoteArea">
                    <div class="flex flex-col items-center mt-5">
                        <button class="my-3 upvote_button">
                            <i class="text-darthmouthgreen fa-regular fa-circle-up text-4xl"></i>
                        </button>
                        <span class="text-darthmouthgreen upvote_count" id="">{{ $thread->randomized_display_upvote }}</span>
                        <button class="my-3 downvote_button">
                            <i class="text-darthmouthgreen fa-regular fa-circle-down text-4xl"></i>
                        </button>
                    </div>
                        
                    </div>
                    <div class="w-11/12 mx-5 py-3" id="threadMainContentArea">
                        <div class="w-full flex items-center" id="userInfoArea">
                            <div class="rounded-full w-[35px] h-[35px] bg-green-950 mx-3">
                                <img class="rounded-full w-[35px] h-[35px]" src="{{ asset('storage/' . $thread->profile_picture) }}" alt="">
                            </div>
                            <h1 class="ml-1 text-lg font-semibold">{{ $thread->first_name }} {{ $thread->last_name }}</h1>
                            <h1 class="mx-5 text-lg font-normal">{{ $thread->community_name }}</h1>
                            <h1 class="text-md font-normal opacity-60">{{ $thread->created_at }}</h1>
                        </div>
    

                            <div class="w-full mx-5 mt-5" id="threadTitleArea">
                                <h1 class="text-4xl font-bold">{{ $thread->thread_title }}</h1>
                            </div>
    
                            <div class="w-full mx-5 mt-5 px-3" id="threadContentArea">

                                @if ($thread->thread_type === 'POST')
                                <div class="h-[150px]" id="threadContent">
                                    <h1>{{ $thread->thread_content }}</h1>
                                </div>
        
                                @elseif ($thread->thread_type === 'PHOTO')
                                <div class="h-[350px] flex justify-center" id="threadContent">
                                    <img class="h-[350px]" src="{{ asset('storage/' . $thread->thread_content) }}" alt="">
                                </div>
                                @else 
                                <div class="h-[150px]" id="threadContent">
                                    <a href="{{ $thread->thread_content }}">{{ $thread->thread_content }}</a>
                                </div>
                                @endif

                            </div>
    
                            <div class="w-full mx-5 mt-5" id="commentsArea">
                                <i class="fa-regular fa-comment text-darthmouthgreen"></i>
                                <span class="">{{ $thread->total_count }}</span>
                                <span class="">comments</span>
                            </div>

    
                            <div class="w-full mx-5 mt-5" id="commentInputArea">
                                <label for="commentInput" class="text-lg">Your Comment:</label>
                                <textarea name="" class="w-11/12 h-[250px] p-3 rounded-lg" id="commentInput" placeholder="comment"></textarea>
                                <div class="w-11/12 text-right">
                                    <button class="px-5 py-3 bg-darthmouthgreen hover:bg-green-950 text-white rounded-xl mt-3" id="submitCommentBtn">Submit</button>
                                </div>
                            </div>

                            <div class="" id="commentArea">
                                <h1 class="text-xl">Comments</h1>
                                <div class="mt-5" id="sortByArea">
                                    <select name="" class="" id="sortComments">
                                        <option value="NEW">Most Recent</option>
                                        <option value="TOP">Most Upvoted</option>
                                        <option value="OLD">Oldest</option>
                                    </select>
                                </div>
                                <hr class="border-t-2 border-gray-300 mt-2 mb-4">

                                {{-- comments --}}
                                <div class="" id="commentMainContainer">
    
                                    {{-- <div class="my-10 commentContainer">
                                        <div class="w-full flex items-center" id="userInfoArea">
                                            <div class="rounded-full w-[35px] h-[35px] bg-green-950 mx-3"></div>
                                            <h1 class="ml-1 text-lg font-semibold">user name</h1>
                                            <h1 class="mx-5 text-md font-normal opacity-60">datetime</h1>
                                        </div>
                                        <div class="mx-7 px-10 w-full border-l-2 border-darthmouthgreen border-opacity-60" id="commentContentArea">
                                            <div class="" id="comment">sample comment</div>
                                            <div class="flex items-center mt-5" id="commentUpvoteArea">
                                                <div class="flex items-center">
                                                    <button class="mr-3 upvote_button">
                                                        <i class="text-darthmouthgreen fa-regular fa-circle-up text-2xl"></i>
                                                    </button>
                                                    <span class="text-darthmouthgreen upvote_count" id="">{{ $thread->randomized_display_upvote }}</span>
                                                    <button class="ml-3 downvote_button">
                                                        <i class="text-darthmouthgreen fa-regular fa-circle-down text-2xl"></i>
                                                    </button>
                                                </div>
                                                <div class="mx-10 flex items-center" id="replyCount">
                                                    <i class="fa-regular fa-comment text-darthmouthgreen text-2xl"></i>
                                                    <span class="mx-3 text-darthmouthgreen">#</span>
                                                    <button class="px-3 py-1 bg-darthmouthgreen hover:bg-green-950 rounded-lg text-white">reply</button>
                                                </div>
                                            </div>
    
                                            <div class="mt-3" id="replyArea">
                                                <!-- replies -->
                                                <div class="" id="replyContainer">
                                                    <div class="w-full flex items-center" id="userInfoArea">
                                                        <div class="rounded-full w-[35px] h-[35px] bg-green-950 mx-3"></div>
                                                        <h1 class="ml-1 text-lg font-semibold">user name</h1>
                                                        <h1 class="mx-5 text-md font-normal opacity-60">datetime</h1>
                                                    </div>
                                                    <div class="mx-7 px-10 w-full border-l-2 border-darthmouthgreen border-opacity-60" id="commentContentArea">
                                                        <div class="" id="comment">sample comment</div>
                                                        <div class="flex items-center mt-5" id="commentUpvoteArea">
                                                            <div class="flex items-center">
                                                                <button class="mr-3 upvote_button">
                                                                    <i class="text-darthmouthgreen fa-regular fa-circle-up text-2xl"></i>
                                                                </button>
                                                                <span class="text-darthmouthgreen upvote_count" id="">{{ $thread->randomized_display_upvote }}</span>
                                                                <button class="ml-3 downvote_button">
                                                                    <i class="text-darthmouthgreen fa-regular fa-circle-down text-2xl"></i>
                                                                </button>
                                                            </div>
                                                            <div class="mx-10 flex items-center" id="replyCount">
                                                                <i class="fa-regular fa-comment text-darthmouthgreen text-2xl"></i>
                                                                <span class="mx-3 text-darthmouthgreen">#</span>
                                                                <button class="px-3 py-1 bg-darthmouthgreen hover:bg-green-950 rounded-lg text-white">reply</button>
                                                            </div>
                                                        </div>
                
                                                        <div class="mt-5" id="replyReplyArea">
                                                            <!-- reply to replies -->
                                                            <div class="" id="replyReplyContainer">
                                                                <div class="w-full flex items-center" id="userInfoArea">
                                                                    <div class="rounded-full w-[35px] h-[35px] bg-green-950 mx-3"></div>
                                                                    <h1 class="ml-1 text-lg font-semibold">user name</h1>
                                                                    <h1 class="mx-5 text-md font-normal opacity-60">datetime</h1>
                                                                </div>
                                                                <div class="mx-7 px-10 w-full border-l-2 border-darthmouthgreen border-opacity-60" id="commentContentArea">
                                                                    <div class="" id="comment">sample comment</div>
                                                                    <div class="flex items-center mt-5" id="commentUpvoteArea">
                                                                        <div class="flex items-center">
                                                                            <button class="mr-3 upvote_button">
                                                                                <i class="text-darthmouthgreen fa-regular fa-circle-up text-2xl"></i>
                                                                            </button>
                                                                            <span class="text-darthmouthgreen upvote_count" id="">{{ $thread->randomized_display_upvote }}</span>
                                                                            <button class="ml-3 downvote_button">
                                                                                <i class="text-darthmouthgreen fa-regular fa-circle-down text-2xl"></i>
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="mt-5 w-full" id="replyReplyInputArea">
                                                            <label for="replyReplyInput" class="text-lg">Your Reply:</label>
                                                            <textarea name="" class="w-full h-[100px] p-3 rounded-lg" id="replyReplyInput" placeholder="reply"></textarea>
                                                            <div class="text-right">
                                                                <button class="px-5 py-3 bg-darthmouthgreen hover:bg-green-950 text-white rounded-xl mt-3" id="replyReplyInputBtn">Submit</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
    
                                            </div>
                                            <div class="mt-5 w-full" id="commentReplyInputArea">
                                                <label for="commentReplyInput" class="text-lg">Your Reply:</label>
                                                <textarea name="" class="w-full h-[100px] p-3 rounded-lg" id="commentReplyInput" placeholder="comment"></textarea>
                                                <div class="text-right">
                                                    <button class="px-5 py-3 bg-darthmouthgreen hover:bg-green-950 text-white rounded-xl mt-3" id="commentReplyInputBtn">Submit</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div> --}}

                                </div>


                            </div>
                    </div>
                </div>

            
            </div>

            

        </div>
    </section>

    <div id="loaderModal" class="hidden fixed top-0 left-0 flex items-center justify-center w-full h-full bg-gray-200 bg-opacity-75 modal">
        <div class="modal-content flex flex-col justify-center items-center p-20 bg-white p-4 rounded-lg shadow-lg w-[500px]">
            <div class="three-body">
                <div class="three-body__dot"></div>
                <div class="three-body__dot"></div>
                <div class="three-body__dot"></div>
            </div>
            
        <p class="mt-5 text-xl text-darthmouthgreen">loading</p>  
        </div>
    </div>


    <div id="successModal" class="hidden fixed top-0 left-0 flex items-center justify-center w-full h-full bg-gray-200 bg-opacity-75 modal">
        <div class="modal-content flex flex-col justify-center items-center p-20 bg-white p-4 rounded-lg shadow-lg w-[500px]">
            <i class="fa-regular fa-circle-check text-[75px] text-darthmouthgreen"></i>
            <p class="mt-5 text-xl text-darthmouthgreen">Successful</p>  
        </div>
    </div>


    <div id="errorModal" class="hidden fixed top-0 left-0 flex items-center justify-center w-full h-full bg-gray-200 bg-opacity-75 modal">
        <div class="modal-content flex flex-col justify-center items-center p-20 bg-white p-4 rounded-lg shadow-lg w-[500px]">
            <i class="fa-regular fa-circle-xmark text-[75px] text-red-500"></i>
            <p class="mt-5 text-xl text-darthmouthgreen">Error</p>  
        </div>
    </div>

    
@include('partials.instructorProfile')
</section>
@include('partials.footer')