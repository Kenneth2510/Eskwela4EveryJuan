@include('partials.header')
<section class="flex flex-row w-full h-screen text-sm bg-mainwhitebg md:text-base lg:h-screen">
    <header class="fixed top-0 left-0 z-40 flex flex-row items-center w-full px-4 py-4 bg-seagreen">
    <a href="#">
        <span class="self-center text-lg font-semibold font-semibbold whitespace-nowrap md:text-2xl text-mainwhitebg">
            Eskwela4EveryJuan
        </span>
    </a>
</header>  

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
                    <h1 class="mx-2 text-2xl font-semibold">{{$syllabus->activity_title}}</h1>
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
              
                <br>
                <br>
                <br>
                <div class="">
                  
                    <p class="text-2xl font-semibold">Overall Total Score: </p>
                    <input type="number" id="overallScore_input py-5 px-5 border-2 border-green-400" class="w-full text-4xl" value="{{$activity->total_score}}" disabled> 
                    <p class="px-10 text-4xl">/ {{$activity->total_score}}</p>
                </div>
            </div>
          
        </div>

        <div class="px-10 mt-[50px] flex justify-between">
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
        </div>
    </div>
</section>

@include('partials.learnerProfile')
</section>
@include('partials.footer')