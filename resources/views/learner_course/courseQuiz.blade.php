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
            <a href="{{ url("/learner/course/manage/$learnerSyllabusProgressData->course_id/overview") }}" class="my-2 bg-gray-300 rounded-full ">
                <svg  xmlns="http://www.w3.org/2000/svg" height="30" viewBox="0 -960 960 960" width="24"><path d="M560-240 320-480l240-240 56 56-184 184 184 184-56 56Z"/></svg>
            </a>
            <h1 class="w-1/2 py-4 text-5xl font-bold"><span class="">{{ $learnerSyllabusProgressData->course_name }}</span></h1>
        {{-- subheaders --}}
            <div class="flex flex-col justify-between fill-mainwhitebg">
                <h1 class="w-1/2 py-4 text-4xl font-bold"><span class="">{{ $learnerSyllabusProgressData->quiz_title }}</span></h1>
            </div>
        </div> 


        <div class="mx-2">
            <div class="mt-1 text-gray-600 text-l">
                <a href="{{ url('/learner/courses') }}" class="">course></a>
                <a href="{{ url("/learner/course/$learnerSyllabusProgressData->course_id") }}">{{$learnerSyllabusProgressData->course_name}}></a>
                <a href="{{ url("/learner/course/manage/$learnerSyllabusProgressData->course_id/overview") }}">content></a>
                <a href="">{{ $learnerSyllabusProgressData->quiz_title }}</a>
            </div>
            {{-- head --}}
            <div class="flex justify-between py-4 mt-10 border-b-2">
                <div class="flex flex-row items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32"><path fill="currentColor" d="M12 29a1 1 0 0 1-.92-.62L6.33 17H2v-2h5a1 1 0 0 1 .92.62L12 25.28l8.06-21.63A1 1 0 0 1 21 3a1 1 0 0 1 .93.68L25.72 15H30v2h-5a1 1 0 0 1-.95-.68L21 7l-8.06 21.35A1 1 0 0 1 12 29Z"/></svg>
                    <h1 class="mx-2 text-2xl font-semibold">{{$learnerSyllabusProgressData->quiz_title}}</h1>
                </div>
                <h1 class="mx-2 text-2xl font-semibold">
                    @if ($learnerSyllabusProgressData->status === "NOT YET STARTED")
                    <span class="">STATUS: NOT YET STARTED</span>
                    @elseif ($learnerSyllabusProgressData->status === "COMPLETED")
                    <span class="">STATUS: COMPLETED</span>
                    @else
                    <span class="">STATUS: IN PROGRESS</span>
                    @endif
                </h1>
            </div>

            <div class="flex flex-row items-center mt-5">
                <h3 class="my-2 text-xl font-medium">Coverage:</h3>
            </div>

            <div id="coverageArea" class="mt-5">
                <table class="w-full">
                    <thead class="h-10 text-2xl text-white bg-green-700 rounded-xl">
                      
                        <th class="w-4/5">Title</th>
                        <th class="w-3/5"></th>
                    </thead>

                    <tbody class="referenceTable">
           
                        @forelse ($quizReferenceData as $reference)
                        <tr class="h-16 py-5 mt-5">
                         
                            <td class="w-4/5">
                            <p class="mx-10 text-lg">{{$reference->topic_title}}</p>
                            </td>
                        
                        </tr>
                        @empty
                        <tr>
                            <td rowspan="3">No Criterias Found</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-8 px-10" id="score_area">
                <h1 class="text-2xl font-semibold mb-2">Attempt Number: {{$learnerQuizProgressData->attempt}}</h1>

                @if($learnerQuizProgressData->remarks)
                <h1 class="text-2xl font-semibold mb-2">Attempt Taken on {{$learnerQuizProgressData->updated_at}}</h1>
                @endif
                <div class="bg-gray-100 p-6 rounded-xl shadow-md">
                    <h1 class="text-3xl font-bold mb-4">Score:</h1>
                    <h1 class="text-4xl font-bold text-green-600">{{$learnerQuizProgressData->score}} <span class="text-2xl font-bold text-black"> / {{$totalQuestionCount}}</span></h1>
                    
                    <div class="mt-4">
                        <h1 class="text-xl font-semibold">Remarks:</h1>
                        <p class="text-lg">{{$learnerQuizProgressData->remarks}}</p>
                        
                    </div>

                    @if($learnerQuizProgressData->remarks && $learnerQuizProgressData == 'FAIL')
                    <div class="mt-3">
                        <a href="" class="py-3 px-5 bg-darthmouthgreen hover:bg-green-950 text-white text-lg rounded-xl">Re attempt the Quiz</a>
                    </div>
                    @endif
                    @if($learnerQuizProgressData->remarks)
                    <div class="mt-3">
                        <a href="{{ url("/learner/course/content/$learnerSyllabusProgressData->course_id/$learnerSyllabusProgressData->learner_course_id/quiz/$learnerSyllabusProgressData->syllabus_id/view_output/$learnerQuizProgressData->attempt") }}" class="py-3 px-5 bg-darthmouthgreen hover:bg-green-950 text-white text-lg rounded-xl">
                            View Output
                        </a> 
                    </div>
                    @endif
                      
                </div>
            </div>
            

            <div class="px-10 mt-[50px] flex justify-between">
                <a href="{{ url("/learner/course/manage/$learnerSyllabusProgressData->course_id/overview") }}" class="flex justify-center w-1/2 py-5 mx-3 text-xl font-semibold text-white bg-darthmouthgreen hover:bg-green-900 rounded-xl">
                    Return    
                </a>
                @if ($learnerSyllabusProgressData->status === "NOT YET STARTED")
                <a href="{{ url("/learner/course/content/$learnerSyllabusProgressData->course_id/$learnerSyllabusProgressData->learner_course_id/quiz/$learnerSyllabusProgressData->syllabus_id/answer") }}" class="flex justify-center w-1/2 py-5 mx-3 text-xl font-semibold text-white bg-darthmouthgreen hover:bg-green-900 rounded-xl">
                    Answer Now
                </a>   
                @elseif ($learnerSyllabusProgressData->status === "COMPLETED" || $learnerSyllabusProgressData->status === "IN PROGRESS")
                <a href="#" class="flex justify-center w-1/2 py-5 mx-3 text-xl font-semibold text-white bg-gray-400 rounded-xl cursor-not-allowed opacity-50">
                    View Output
                </a>
                  
                @else 
                <a href="{{ url("/learner/course/content/$learnerSyllabusProgressData->course_id/$learnerSyllabusProgressData->learner_course_id/quiz/$learnerSyllabusProgressData->syllabus_id/answer") }}" class="flex justify-center w-1/2 py-5 mx-3 text-xl font-semibold text-white bg-darthmouthgreen hover:bg-green-900 rounded-xl">
                    Answer Now
                </a>  
                @endif       
            </div>
       
        </div>

    </div>
</section>

@include('partials.learnerProfile')
</section>
@include('partials.footer')