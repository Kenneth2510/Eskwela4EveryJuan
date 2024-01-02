@include('partials.header')

<section class="flex flex-row w-full h-screen text-sm main-container bg-mainwhitebg md:text-base">
    @include('partials.instructorNav')
    @include('partials.learnerSidebar')

        {{-- MAIN --}}
    <section class="w-full px-2 pt-[120px] mx-2 mt-2 md:w-3/4 lg:w-9/12  overscroll-auto md:overflow-auto">
        <div class="px-3 pb-4 overflow-auto rounded-lg shadow-lg b overscroll-auto">
            <h1 class="mx-5 text-2xl font-semibold md:text-3xl">DISCUSSION FORUMS</h1>
            <hr class="border-t-2 border-gray-300 my-6">

            <div class="w-full my-5 px-40" id="mainContainer">
                <div class="w-full mt-5" id="createThread">
                    <a href="/learner/discussions/create">
                        <div class="w-full flex items-center border-2 border-darthmouthgreen p-5 rounded-lg border-opacity-75" id="createThreadBtnContent">
                            <div class="rounded-full w-[50px] h-[50px]">
                                <img class="rounded-full w-[50px] h-[50px]" src="{{ asset('storage/' . $learner->profile_picture) }}" alt="">
                            </div>
                            <div class="mx-3 rounded-xl w-5/6 border-2 border-darthmouthgreen border-opacity-60 h-[50px]"></div>
                            <div class="bg-darthmouthgreen hover:bg-green-950 text-white rounded-xl px-5 py-3">POST</div>
                        </div>
                    </a>
                </div>

                <hr class="border-t-2 border-gray-300 my-6">

                <div class="" id="threadMainContainer">

                    {{-- <div class="w-full flex border-2 my-5 border-darthmouthgreen rounded-lg border-opacity-75" id="thread">
                        <div class="w-1/12 border-r-2 border-darthmouthgreen border-opacity-50" id="upvoteArea">
                            <div class="flex flex-col items-center mt-5">
                                <button class="my-3" id="upvoteBtn">
                                    <i class="text-darthmouthgreen fa-regular fa-circle-up text-4xl"></i>
                                </button>
                                <span class="text-darthmouthgreen " id="upvote">#</span>
                                <button class="my-3" id="downvoteBtn">
                                    <i class="text-darthmouthgreen fa-regular fa-circle-down text-4xl"></i>
                                </button>
                            </div>
                            
                        </div>
                        <div class="w-11/12 mx-5 py-3" id="threadMainContentArea">
                            <div class="w-full flex items-center" id="userInfoArea">
                                <div class="rounded-full w-[35px] h-[35px] bg-green-950 mx-3"></div>
                                <h1 class="ml-1 text-lg font-semibold">user name</h1>
                                <h1 class="mx-5 text-lg font-normal">course name</h1>
                                <h1 class="text-md font-normal opacity-60">datetime</h1>
                            </div>
    
                            <a href="/instructor/discussion/view/">
                                <div class="w-full mx-5 mt-5" id="threadTitleArea">
                                    <h1 class="text-4xl font-bold">Title</h1>
                                </div>
        
                                <div class="w-full h-[150px] mx-5 mt-5" id="threadContentArea">
                                    <div class="" id="threadContent">
                                        <h1>test</h1>
                                    </div>
                                </div>
        
                                <div class="w-full mx-5 mt-5" id="commentsArea">
                                    <i class="fa-regular fa-comment text-darthmouthgreen"></i>
                                    <span class="">#</span>
                                    <span class="">comments</span>
                                </div>
                            </a>

                        </div>
                    </div> --}}

                    
                </div>

            </div>

        </div>
    </section>



@include('partials.learnerProfile')
</section>
@include('partials.footer')