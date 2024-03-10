@include('partials.header')
<section class="flex flex-row w-full h-screen text-sm bg-mainwhitebg md:text-base lg:h-screen">


@include('partials.learnerSidebar')

<section class="w-full px-2 pt-[100px] mx-2 mt-2 md:overflow-auto md:w-3/4 lg:w-9/12">
    <div  class="p-3 pb-4 overflow-auto bg-white rounded-lg shadow-lg overscroll-auto">
        <div style="background-color:{{$mainBackgroundCol}};" class="p-2 text-white fill-white rounded-xl">
            <a href="{{ url("/learner/course/manage/$syllabus->course_id/overview") }}" class="my-2 bg-gray-300 rounded-full ">
                <svg  xmlns="http://www.w3.org/2000/svg" height="30" viewBox="0 -960 960 960" width="24"><path d="M560-240 320-480l240-240 56 56-184 184 184 184-56 56Z"/></svg>
            </a>
            <h1 class="w-1/2 py-4 text-5xl font-bold"><span class="">{{ $syllabus->course_name }}</span></h1>
        {{-- subheaders --}}
            <div class="flex flex-col justify-between fill-mainwhitebg">
                <h1 class="w-1/2 py-4 text-4xl font-bold"><span class="">{{ $syllabus->activity_title }}</span></h1>
            </div>
        </div>   
       
        
        <div class="mx-2">
            <div class="mt-1 text-gray-600 text-l">
                <a href="{{ url('/learner/courses') }}" class="">course></a>
                <a href="{{ url("/learner/course/$syllabus->course_id") }}">{{$syllabus->course_name}}></a>
                <a href="{{ url("/learner/course/manage/$syllabus->course_id/overview") }}">content></a>
                <a href="">{{ $syllabus->activity_title }}</a>
            </div>
            {{-- head --}}
            <div class="flex justify-between py-4 mt-10 border-b-2">
                <div class="flex flex-row items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32"><path fill="currentColor" d="M12 29a1 1 0 0 1-.92-.62L6.33 17H2v-2h5a1 1 0 0 1 .92.62L12 25.28l8.06-21.63A1 1 0 0 1 21 3a1 1 0 0 1 .93.68L25.72 15H30v2h-5a1 1 0 0 1-.95-.68L21 7l-8.06 21.35A1 1 0 0 1 12 29Z"/></svg>
                    <h1 class="mx-2 text-2xl font-semibold" id="activity_title" data-course-id="{{$syllabus->course_id}}" data-syllabus-id="{{$syllabus->syllabus_id}}">{{$syllabus->activity_title}}</h1>
                </div>
                <h1 class="mx-2 text-2xl font-semibold">
                    @if ($activity->status === "NOT YET STARTED")
                    <span class="">STATUS: NOT YET STARTED</span>
                    @elseif ($activity->status === "COMPLETED")
                    <span class="">STATUS: COMPLETED</span>
                    @elseif ($activity->status === "IN PROGRESS")
                    <span class="">STATUS: TO BE SCORED</span>
                    @else
                    <span class="">STATUS: NOT YET STARTED</span>
                    @endif
                </h1>
            </div>
            
            {{-- body --}}
            <div class="py-4 " id="defaultView">
                <div class="flex flex-row items-center">
                    <h3 class="my-2 text-xl font-medium">Instructions:</h3>
                </div>

                <p style="white-space: pre-wrap">{{ $activity->activity_instructions }}</p>
     
                {{-- <textarea name="activity_instructions" class="w-full max-w-full min-w-full activity_instructions h-[200px]" disabled>{{$activity->activity_instructions}}</textarea> --}}

                <div class="flex flex-row items-center mt-5">
                    <h3 class="my-2 text-xl font-medium">Criteria:</h3>
                </div>
                <table class="rounded-xl">
                    <thead class="text-xl text-white bg-green-700 rounded-xl">
                        <th class="w-2/5">Criteria</th>
                        <th class="w-1/5">Score</th>
                        <th class="w-1/5"></th>
                    </thead>
                    <tbody>
                        @forelse ($activityCriteria as $criteria)
                        <tr>
                            <td>
                                <input type="text" class="" value="{{ $criteria->criteria_title }}" disabled>
                            </td>
                            <td class="flex justify-end">
                                <input type="text" class="flex text-center" value="{{ $criteria->score }}" disabled></td>
                            <td></td>
                        </tr>
                        @empty
                        <tr>
                            <td rowspan="3">No Criterias Found</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!--score and remarks area-->
        @if ($activityOutput)
            @foreach ($activityOutput as $output)
                <div class="px-10 mt-8" id="score_area">
                    <h1 class="mb-2 text-2xl font-semibold">Attempt Number: {{$output->attempt}}</h1>

                    @if($output->mark)
                    <h1 class="mb-2 text-2xl font-semibold">Attempt Taken on {{$output->updated_at}}</h1>
                    @endif
                    <div class="p-6 bg-gray-100 shadow-md rounded-xl">
                        <h1 class="mb-4 text-3xl font-bold">Score:</h1>
                        <h1 class="text-4xl font-bold text-green-600">{{$output->total_score}} <span class="text-2xl font-bold text-black"> / {{$totalScores}}</span></h1>
                        
                        <div class="my-5">
                            <h1 class="text-xl font-semibold">Remarks:</h1>

                                <span class="mx-2 text-2xl font-semibold {{ $output->mark == 'PASS' ? 'text-dartmouthgreen' : 'text-red-600' }}">
                                    {{ $output->mark }}
                                </span>
                            </h1>
                            
                        </div>

                        <div class="my-3">
                            @if($output)
                            <a href="{{ url("/learner/course/content/$syllabus->course_id/$syllabus->learner_course_id/activity/$syllabus->syllabus_id/answer/$output->attempt") }}" class="flex justify-center w-1/2 py-5 mx-3 text-xl font-semibold text-white bg-darthmouthgreen hover:bg-green-900 rounded-xl">
                                View Output
                            </a>
                            @endif
                        </div>
                        
                        
                    </div>
                </div>
            @endforeach
        @endif
        


        <!--buttons area-->
        <div class="flex mt-5">

            @if ($activityOutput->isNotEmpty())
                    @if ($activityOutput->count() == 1) {{-- if only 1 row --}}
                    @foreach($activityOutput as $output)
                        @if ($output->mark !== null || $output->mark !== '') {{-- if the mark is still null or no value --}}

                            @if ($output->mark == 'PASS') {{-- if mark is PASS --}}
                                <a href="{{ url("/learner/course/manage/$syllabus->course_id/overview") }}" class="flex justify-center w-1/2 py-5 mx-3 text-xl font-semibold text-white bg-darthmouthgreen hover:bg-green-900 rounded-xl">
                                    Return    
                                </a>
                                <a href="{{ url("/learner/course/content/$syllabus->course_id/$syllabus->learner_course_id/activity/$syllabus->syllabus_id/answer/$output->attempt") }}" class="flex justify-center w-1/2 py-5 mx-3 text-xl font-semibold text-white bg-gray-400 opacity-50 cursor-not-allowed rounded-xl">
                                    Answer Now
                                </a>   
                            @else {{-- if mark is FAIL --}}
                                <a href="{{ url("/learner/course/manage/$syllabus->course_id/overview") }}" class="flex justify-center w-1/2 py-5 mx-3 text-xl font-semibold text-white bg-darthmouthgreen hover:bg-green-900 rounded-xl">
                                    Return    
                                </a>
                                <a disabled href="" class="flex justify-center w-1/2 py-5 mx-3 text-xl font-semibold text-white bg-gray-400 opacity-50 cursor-not-allowed rounded-xl">
                                    Reattempt Now
                                </a>   
                            @endif

                        @else {{-- if mark is null and not yet started --}}

                            <a href="{{ url("/learner/course/manage/$syllabus->course_id/overview") }}" class="flex justify-center w-1/2 py-5 mx-3 text-xl font-semibold text-white bg-darthmouthgreen hover:bg-green-900 rounded-xl">
                                Return    
                            </a>
                            <a href="{{ url("/learner/course/content/$syllabus->course_id/$syllabus->learner_course_id/activity/$syllabus->syllabus_id/answer/$output->attempt") }}" class="flex justify-center w-1/2 py-5 mx-3 text-xl font-semibold text-white bg-darthmouthgreen hover:bg-green-900 rounded-xl">
                                Answer Now
                            </a>   
                        @endif
                    @endforeach   
                    @else {{-- if more than 1 attempt --}}
                        
                        @php
                            $lastRowActivityData = $activityOutput->last();
                        @endphp 
                        @if ($lastRowActivityData !== null)
                            @if ($lastRowActivityData->answer !== null) {{-- if not null--}}
                                
                                @if ($lastRowActivityData->mark == 'PASS') {{-- if mmark is PASS --}}
                                        
                                    <a href="{{ url("/learner/course/manage/$syllabus->course_id/overview") }}" class="flex justify-center w-1/2 py-5 mx-3 text-xl font-semibold text-white bg-darthmouthgreen hover:bg-green-900 rounded-xl">
                                        Return    
                                    </a>
                                    <a disabled href="" class="flex justify-center w-1/2 py-5 mx-3 text-xl font-semibold text-white bg-gray-400 opacity-50 cursor-not-allowed rounded-xl">
                                        Already Submitted
                                    </a>    
                                @else {{-- if mark is FAIL --}}

                                    <a href="{{ url("/learner/course/manage/$syllabus->course_id/overview") }}" class="flex justify-center w-1/2 py-5 mx-3 text-xl font-semibold text-white bg-darthmouthgreen hover:bg-green-900 rounded-xl">
                                        Return    
                                    </a>
                                    <a disabled href="" class="flex justify-center w-1/2 py-5 mx-3 text-xl font-semibold text-white bg-gray-400 opacity-50 cursor-not-allowed rounded-xl">
                                        Already Submitted
                                    </a>  
                                @endif

                            @else
                                {{-- if attempt 2 is not yet started --}}
                                    <!-- if attempt 2 is not yet started -->
                                <a href="{{ url("/learner/course/manage/$syllabus->course_id/overview") }}" class="flex justify-center w-1/2 py-5 mx-3 text-xl font-semibold text-white bg-darthmouthgreen hover:bg-green-900 rounded-xl">
                                    Return    
                                </a>
                                <a href="{{ url("/learner/course/content/$syllabus->course_id/$syllabus->learner_course_id/activity/$syllabus->syllabus_id/answer/$output->attempt") }}" class="flex justify-center w-1/2 py-5 mx-3 text-xl font-semibold text-white bg-darthmouthgreen hover:bg-green-900 rounded-xl">
                                    Answer Now
                                </a>  
                            @endif
                        @endif

                    @endif
                
            @else
                            <!-- if all null -->
                    <a href="{{ url("/learner/course/manage/$syllabus->course_id/overview") }}" class="flex justify-center w-1/2 py-5 mx-3 text-xl font-semibold text-white bg-darthmouthgreen hover:bg-green-900 rounded-xl">
                        Return    
                    </a> 
                    <a href="{{ url("/learner/course/content/$syllabus->course_id/$syllabus->learner_course_id/activity/$syllabus->syllabus_id/answer/1") }}" class="flex justify-center w-1/2 py-5 mx-3 text-xl font-semibold text-white bg-darthmouthgreen hover:bg-green-900 rounded-xl">
                        Answer Now
                    </a>   

            @endif
                <!-- test -->
        </div>


        {{-- <div class="px-10 mt-[50px] flex justify-between">
            <a href="{{ url("/learner/course/manage/$syllabus->course_id/overview") }}" class="flex justify-center w-1/2 py-5 mx-3 text-xl font-semibold text-white bg-darthmouthgreen hover:bg-green-900 rounded-xl">
                Return    
            </a>
            @if ($activity->status === "NOT YET STARTED")
            <a href="{{ url("/learner/course/content/$syllabus->course_id/$syllabus->learner_course_id/activity/$syllabus->syllabus_id/answer") }}" class="flex justify-center w-1/2 py-5 mx-3 text-xl font-semibold text-white bg-darthmouthgreen hover:bg-green-900 rounded-xl">
                Answer Now
            </a>   
            @elseif ($activity->status === "COMPLETED" || $activity->status === "IN PROGRESS")
            <a href="{{ url("/learner/course/content/$syllabus->course_id/$syllabus->learner_course_id/activity/$syllabus->syllabus_id/answer") }}" class="flex justify-center w-1/2 py-5 mx-3 text-xl font-semibold text-white bg-darthmouthgreen hover:bg-green-900 rounded-xl">
                View Output
            </a>   
            @else 
            <a href="{{ url("/learner/course/content/$syllabus->course_id/$syllabus->learner_course_id/activity/$syllabus->syllabus_id/answer") }}" class="flex justify-center w-1/2 py-5 mx-3 text-xl font-semibold text-white bg-darthmouthgreen hover:bg-green-900 rounded-xl">
                Answer Now
            </a>  
            @endif       
        </div> --}}


    </div>
</section>

{{-- @include('partials.learnerProfile') --}}
@include('partials.chatbot')
</section>


<div id="loaderModal" class="fixed top-0 left-0 z-50 flex items-center justify-center hidden w-full h-full bg-gray-200 bg-opacity-75 ">
    <div class="flex flex-col items-center justify-center w-full h-screen p-4 bg-white rounded-lg shadow-lg modal-content md:h-1/3 lg:w-1/3">
        <span class="loading loading-spinner text-primary loading-lg"></span> 
            
        <p class="mt-5 text-xl text-darthmouthgreen">loading</p>  
    </div>
</div>
@include('partials.footer')