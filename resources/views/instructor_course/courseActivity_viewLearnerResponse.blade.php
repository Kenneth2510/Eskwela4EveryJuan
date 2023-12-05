@include('partials.header')

<section class="flex flex-row w-full h-screen text-sm main-container bg-mainwhitebg md:text-base">
    @include('partials.instructorNav')
    @include('partials.instructorSidebar')

    {{-- MAIN --}}
    <section class="w-full px-2 pt-[120px] mx-2 mt-2 md:w-3/4 lg:w-9/12  overscroll-auto md:overflow-auto">
        <div class="p-3 pb-4 overflow-auto rounded-lg shadow-lg b overscroll-auto">
            <div style="background-color:{{$mainBackgroundCol}}" class="p-2 text-white fill-white rounded-xl">
                <a href="{{ url("/instructor/course/content/$course->course_id") }}" class="my-2 bg-gray-300 rounded-full ">
                    <svg  xmlns="http://www.w3.org/2000/svg" height="30" viewBox="0 -960 960 960" width="24"><path d="M560-240 320-480l240-240 56 56-184 184 184 184-56 56Z"/></svg>
                </a>
                <h1 class="w-1/2 py-4 text-5xl font-bold"><span class="">{{ $course->course_name }}</span></h1>
            {{-- subheaders --}}
                <div class="flex flex-col fill-mainwhitebg">
                    <h1 class="w-1/2 py-4 text-4xl font-bold"><span class="">{{ $activity->activity_title }}</span></h1>
                </div>
            </div>
            
            <div class="mx-2">
                <div class="mt-1 text-gray-600 text-l">
                    <a href="{{ url('/instructor/courses') }}" class="">course></a>
                    <a href="{{ url("/instructor/course/$course->course_id") }}">{{$course->course_name}}></a>
                    <a href="{{ url("/instructor/course/content/$course->course_id") }}">content></a>
                    <a href="">{{ $activity->activity_title }}</a>
                </div>

                {{-- head --}}
                <div class="flex flex-row items-center py-4 border-b-2 border-b-green-900">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32"><path fill="currentColor" d="M12 29a1 1 0 0 1-.92-.62L6.33 17H2v-2h5a1 1 0 0 1 .92.62L12 25.28l8.06-21.63A1 1 0 0 1 21 3a1 1 0 0 1 .93.68L25.72 15H30v2h-5a1 1 0 0 1-.95-.68L21 7l-8.06 21.35A1 1 0 0 1 12 29Z"/></svg>
                    <h1 class="mx-2 text-2xl font-semibold">{{$activity->activity_title}}</h1>
                </div>
                
                {{-- body --}}
                <div class="py-4 " id="defaultView">
                    <div class="flex flex-row items-center">
                        <h3 class="my-2 text-xl font-medium">Instructions:</h3>
                      
                        
                    </div>
                    {{-- <p>{{ $activity->activity_instructions }}</p> --}}
                    {{-- <input type="text" name="activity_instructions" class="w-full max-w-full min-w-full activity_instructions" value="{{$activity->activity_instructions}}" disabled> --}}

                    <textarea name="activity_instructions" class="w-full max-w-full min-w-full activity_instructions h-[200px]" disabled>{{$activity->activity_instructions}}</textarea>
             

                    <div class="flex flex-row items-center border-b-2 border-b-green-900">
                        <h3 class="my-2 text-2xl font-medium">{{$learnerActivityOutput->learner_fname}} {{$learnerActivityOutput->learner_lname}}'s output</h3>
                      

                    </div>
           

                    <textarea name="activity_instructions" class="border-2 border-black mt-2 rounded-xl p-3 w-full max-w-full min-w-full activity_instructions h-[200px]" disabled>{{$learnerActivityOutput->answer}}</textarea>

                    <div class="flex flex-row items-center mt-5">
                        <h3 class="my-2 text-xl font-medium">Criteria:</h3>
                    </div>

                    <table class="rounded-xl">
                        <thead class="text-xl text-white bg-green-700 rounded-xl">
                            <th class="w-2/5">Criteria</th>
                            <th class="w-1/5">Max Score</th>
                            <th class="w-1/5"><span id="given_score" class="">Given Score</span></th>
                        </thead>
                        <tbody>
                            @forelse ($learnerActivityScore as $criteria)
                            <tr>
                                <td>
                                    <input type="text" class="" value="{{ $criteria->criteria_title }}" disabled>
                                </td>
                                <td class="flex justify-end">
                                    <input type="text" class="flex text-center" value="{{ $criteria->criteria_score }}" disabled>
                                </td>
                                <td>
                                    <input type="number" 
                                           data-activity-content-criteria-id="{{ $criteria->activity_content_criteria_id }}"
                                            
                                           data-learner-activity-criteria-score-id="{{ $criteria->learner_activity_criteria_score_id }}"  
                                           class="flex px-3 py-3 text-center border-2 border-gray-500 criteriaScore" 
                                           max="{{ $criteria->criteria_score }}" 
                                           min="0"
                                           value="{{$criteria->score}}" disabled>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td rowspan="3">No Criterias Found</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                    
                    <br>
                    <br>
                    <br>
                    <div class="mb-16">
                        <p class="text-2xl font-semibold">Overall Total Score: </p>
                        <div class="">
                            <input type="number" id="overallScore_input" class="w-full px-5 py-5 text-4xl" value="{{$learnerActivityOutput->total_score}}" max="{{$activity->total_score}}" min="0" disabled> 
                            <p class="px-10 text-4xl">/ {{$activity->total_score}}</p>
                        </div>
                        
                    </div>

                    <div id="remarks_area" class="hidden">
                        <div class="flex flex-row items-center">
                            <h3 class="my-2 text-xl font-medium">Remarks:</h3> 
                        </div>

                        <textarea name="remarks" id="remarks" class="border-2 border-gray-200 rounded-xl px-3 py-3 w-full max-w-full min-w-full activity_instructions h-[200px]">{{$learnerActivityOutput->remarks}}</textarea>
                    </div>
                </div>

                <div class="flex justify-between w-full px-3 mx-3">
                    <a id="returnBtn" href="/instructor/course/content/{{$activity->course_id}}/{{$activity->syllabus_id}}}/activity/{{$activity->topic_id}}" class="w-1/2 px-5 py-5 mx-2 text-xl text-center text-white bg-green-700 rounded-xl hover:bg-green-900">Return</a>
                    <button id="cancelScoreBtn" class="hidden w-1/2 px-5 py-5 mx-2 text-xl text-center text-white bg-green-600 rounded-xl hover:bg-green-900">Cancel</button>
                    <button id="addScoreBtn" class="w-1/2 px-5 py-5 mx-2 text-xl text-center text-white bg-green-600 rounded-xl hover:bg-green-900">Add Score</button>
                    <button id="submitScoreBtn" class="hidden w-1/2 px-5 py-5 mx-2 text-xl text-center text-white bg-green-600 rounded-xl hover:bg-green-900">Submit Score</button>
                </div>
            </div>

        </section>

        <div id="confirmationModal" class="fixed inset-0 z-50 hidden overflow-y-auto bg-black bg-opacity-50 ">
            <div class="flex items-center justify-center min-h-screen">
                <div class="relative mx-auto bg-white shadow-lg w-96 rounded-xl">
                    <div class="flex flex-col items-start p-6">
                        <div class="flex items-center justify-between w-full mb-4">
                            <h2 class="text-xl font-semibold">Confirmation</h2>
                            <button id="closeModal" class="text-gray-500 hover:text-gray-700 focus:outline-none">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </button>
                        </div>
                        <p class="text-gray-600">Are you sure you want to submit the score?</p>
                        <div class="flex justify-end w-full mt-6">
                            <button id="confirmSubmit" class="px-4 py-2 text-white bg-green-500 rounded-md hover:bg-green-600 focus:outline-none"
                            data-learner-activity-output-id="{{$learnerActivityOutput->learner_activity_output_id}}" 
                            data-learner-course-id="{{$learnerActivityOutput->learner_course_id}}" 
                            data-activity-id="{{$learnerActivityOutput->activity_id}}" 
                            data-activity-content-id="{{$learnerActivityOutput->activity_content_id}}" 
                            >Yes</button>
                            <button id="cancelSubmit" class="px-4 py-2 ml-4 text-gray-700 bg-gray-300 rounded-md hover:bg-gray-400 focus:outline-none">Cancel</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

@include('partials.instructorProfile')
</section>
        
@include('partials.footer')