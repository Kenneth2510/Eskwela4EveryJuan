@include('partials.header')
<section class="flex flex-row w-full h-screen text-sm bg-mainwhitebg md:text-base lg:h-screen">


@include('partials.learnerSidebar')

<section class="w-full px-2 pt-[100px] mx-2 mt-2 md:overflow-auto md:w-3/4 lg:w-9/12">
    <div  class="p-3 pb-4 overflow-auto bg-white rounded-lg shadow-lg overscroll-auto">
        
        <div style="background-color:{{$mainBackgroundCol}};" class="p-2 text-white fill-white rounded-xl">
            <a href="{{ url("/learner/course/manage/$learnerCourseData->course_id/overview") }}" class="my-2 bg-gray-300 rounded-full ">
                <svg  xmlns="http://www.w3.org/2000/svg" height="30" viewBox="0 -960 960 960" width="24"><path d="M560-240 320-480l240-240 56 56-184 184 184 184-56 56Z"/></svg>
            </a>
            <h1 class="w-1/2 py-4 text-5xl font-bold"><span class="">{{ $learnerCourseData->course_name }}</span></h1>
        {{-- subheaders --}}
            <div class="flex flex-col justify-between fill-mainwhitebg">
                <h1 class="w-1/2 py-4 text-4xl font-bold"><span class="">COURSE POST ASSESSMENT</span></h1>
            </div>
        </div> 


        <div class="mx-2">
            <div class="mt-1 text-gray-600 text-l">
                <a href="{{ url('/learner/courses') }}" class="">course></a>
                <a href="{{ url("/learner/course/$learnerCourseData->course_id") }}">{{$learnerCourseData->course_name}}></a>
                <a href="{{ url("/learner/course/manage/$learnerCourseData->course_id/overview") }}">content></a>
                <a href="">Post Assessment</a>
            </div>
            {{-- head --}}
            <div class="flex justify-between py-4 mt-10 border-b-2">
                <div class="flex flex-row items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32"><path fill="currentColor" d="M12 29a1 1 0 0 1-.92-.62L6.33 17H2v-2h5a1 1 0 0 1 .92.62L12 25.28l8.06-21.63A1 1 0 0 1 21 3a1 1 0 0 1 .93.68L25.72 15H30v2h-5a1 1 0 0 1-.95-.68L21 7l-8.06 21.35A1 1 0 0 1 12 29Z"/></svg>
                    <h1 class="mx-2 text-2xl font-semibold">Post Assessment</h1>
                </div>
                <h1 class="mx-2 text-2xl font-semibold">
                    @if ($postAssessmentData->status === "NOT YET STARTED")
                    <span class="">STATUS: NOT YET STARTED</span>
                    @elseif ($postAssessmentData->status === "COMPLETED")
                    <span class="">STATUS: COMPLETED</span>
                    @else
                    <span class="">STATUS: IN PROGRESS</span>
                    @endif
                </h1>
            </div>

            {{-- main content --}}
            <div class="flex mt-5">
                <div class="w-2/6 border-r-2 border-green-200 px-auto" id="quiz_info_area">
                    <div class="grid grid-cols-5 gap-2 px-3 py-5 mx-5 mt-5 border-2 border-gray-200" id="isAnsweredMeter">
                        {{-- <div class="flex items-center justify-center question_isAnswered w-[35px] h-[45px] hover:cursor-pointer border border-darthmouthgreen transition-all duration-300">1</div>
                        <div class="flex items-center justify-center question_isAnswered w-[35px] h-[45px] hover:cursor-pointer border border-darthmouthgreen transition-all duration-300">2</div>
                        <div class="flex items-center justify-center question_isAnswered w-[35px] h-[45px] hover:cursor-pointer border border-darthmouthgreen transition-all duration-300">3</div>
                        <div class="flex items-center justify-center question_isAnswered w-[35px] h-[45px] hover:cursor-pointer border border-darthmouthgreen transition-all duration-300">4</div>
                        <div class="flex items-center justify-center question_isAnswered w-[35px] h-[45px] hover:cursor-pointer border border-darthmouthgreen transition-all duration-300">5</div> --}}
                    </div>

                    {{-- <div class="mt-5">
                        <h1 class="">Time remaining: </h1>
                    </div> --}}
                    
                </div>

                <div id="quiz_content_area" class="w-full overflow-y-auto px-auto">
                    <div id="questionContainer" class="w-4/5 p-5 mx-auto my-5 rounded-lg">
                      
                    </div>
                    <div id="pagination" class="mx-10 mt-4 mb-8">
                        <button id="prevPage" class="px-4 py-2 text-gray-600 bg-gray-200 rounded-lg">Previous</button>
                        <span id="currentPage" class="mx-4 text-lg font-semibold">Page 1</span>
                        <button id="nextPage" class="px-4 py-2 text-gray-600 bg-gray-200 rounded-lg">Next</button>
                    </div>
                    
                
                </div>

            </div>

            <div class="w-full text-center" id="">
                <a href="{{ url("/learner/course/content/$learnerCourseData->course_id/$learnerCourseData->learner_course_id/post_assessment")}}" class="px-5 py-3 text-lg text-white rounded-lg bg-darthmouthgreen hover:bg-green-950">Return</a>
            </div>

        </div> 

    </div>
</section>

@include('partials.learnerProfile')
</section>
@include('partials.footer')