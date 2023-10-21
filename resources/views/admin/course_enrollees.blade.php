@include('partials.header')
@include('partials.sidebar')

<section id="view_learner_container" class="relative w-4/5 h-full left-80">

    <div id="title" class="relative flex items-center justify-between h-16 px-3 mx-auto my-3 py-auto">
        <h1 class="text-4xl font-semibold">View Learner Details</h1>
        <div id="adminuser" class="flex items-center">
            <h3 class="text-lg">{{ $adminCodeName }}</h3>
            <div id="icon" class="w-10 h-10 mx-3 rounded-full bg-slate-400"></div>
        </div>
    </div>

    <div id="maincontainer" class="relative max-h-full px-5 py-5 shadow-2xl bg-white mt-7 rounded-2xl">
        <div class="mb-5">
            <a href="/admin/view_course/{{$course->course_id}}" class="">
                <i class="text-2xl md:text-3xl fa-solid fa-arrow-left" style="color: #000000;"></i>
            </a>
        </div>


        <div class="flex">
            <div id="courseSidebar" class="py-10 w-1/5 bg-seagreen">
                <ul class="px-5 py-5 text-white text-xl font-medium">
                    <a href="/admin/manage_course/course_overview/{{ $course->course_id }}">
                        <li id="courseOverviewBtn" class="w-full py-5 rounded-xl px-2 mt-2 hover:bg-green-900">
                            <i class="fa-solid fa-book-open text-3xl pr-2"></i>
                            Course Overview
                    </li>
                    </a>
                    <a href="/admin/manage_course/enrollees/{{ $course->course_id }}">
                        <li id="enrolledLearnersBtn" class="selected w-full py-5 rounded-xl px-2 mt-2 hover:bg-green-900">
                            <i class="fa-solid fa-users text-3xl pr-2"></i>
                            Enrolled Learners
                    </li>
                    </a>
                    <a href="/admin/manage_course/content/{{ $course->course_id }}">
                        <li id="courseContentBtn" class="w-full py-5 rounded-xl px-2 mt-2 hover:bg-green-900">
                            <i class="fa-solid fa-book text-3xl pr-2"></i>
                            Course Content
                    </li>
                    </a>
                    
                    <li class="w-full py-3 rounded-xl px-2 mt-2">
                      
                    </li>
                    <li class="w-full py-3 rounded-xl px-2 mt-2">
                      
                    </li>
                </ul>
            </div>

            <div id="contentArea" class="mx-3 my-5 w-[1150px]">

                
                <div id="enrolled_learners" class="">
                    <h1 class="text-2xl font-semibold border-black border-b-2">Enrolled Learner</h1>

                    <form id="enrolleeForm" data-course-id="{{$course->course_id}}" action="/admin/manage_course/enrollees/{{$course->course_id}}" method="GET">
                        <div class="flex items-center">
                            <div class="flex items-center mx-10">
                                <div class="mx-2">
                                    <label for="filterDate" class="">Filter by Date</label><br>
                                    <input type="date" name="filterDate" class="w-40 px-2 py-2 text-base border-2 border-black rounded-xl" value="{{ request('filterDate') }}">
                                </div>
                                <div class="mx-2">
                                    <label for="filterStatus" class="">Filter by Status</label><br>
                                    <select name="filterStatus" id="filterStatus" class="w-32 px-2 py-2 text-base border-2 border-black rounded-xl">
                                        <option value="" {{ request('filterDate') == '' ? 'selected': ''}}>Select Status</option>
                                        <option value="Pending" {{ request('filterStatus') == 'Pending' ? 'selected': ''}}>Pending</option>
                                        <option value="Approved" {{ request('filterStatus') == 'Approved' ? 'selected': ''}}>Approved</option>
                                        <option value="Rejected" {{ request('filterStatus') == 'Rejected' ? 'selected': ''}}>Rejected</option>
                                    </select>
                                </div>
                                <button class="h-12 px-5 py-1 mx-3 text-lg font-medium bg-green-600 rounded-xl hover:bg-green-900 hover:text-white" type="submit">Filter</button>
                            </div>
                            <div class="">
                                <select name="searchBy" id="" class="w-40 px-2 py-2 text-lg border-2 border-black rounded-xl">
                                    <option value="" {{request('searchBy') == '' ? 'selected' : ''}}class="">Search By</option>
                                    <option value="learner_course_id" {{request('searchBy') == 'learner_course_id' ? 'selected' : ''}}>Enrollee ID</option>
                                    <option value="learner_id" {{request('searchBy') == 'learner_id' ? 'selected' : ''}}>Learner ID</option>
                                    <option value="name" {{request('searchBy') == 'name' ? 'selected' : ''}}>Name</option>
                                    <option value="learner_email" {{request('searchBy') == 'learner_email' ? 'selected' : ''}}>Email</option>
                                    <option value="learner_contactno" {{request('searchBy') == 'learner_contactno' ? 'selected' : ''}}>Contact No.</option>
                                    {{-- <option value="created_at">Date Registered</option> --}}
                                    {{-- <option value="status">Status</option> --}}
                                </select>
                                <input type="text" name="searchVal" class="px-2 py-2 ml-3 text-lg border-2 border-black w-80 rounded-xl" value="{{ request('searchVal') }}" placeholder="Type to search">
                                <button class="px-3 py-2 mx-3 text-lg font-medium bg-green-600 rounded-xl hover:bg-green-900 hover:text-white" type="submit">Search</button>        
                            </div>
                        </div>
                    </form>

                    <div id="learner_table" class="mt-5">
                        <table>
                            <thead class="text-left">
                                <th class="w-1/5">Enrollee ID</th>
                                <th class="w-1/5">Learner ID</th>
                                <th class="w-1/5">Enrollee Info</th>
                                <th class="w-1/5">Date</th>
                                <th class="w-1/5">Status</th>
                                <th class="w-1/5"></th>
                            </thead>
                            <tbody>
                                @forelse ($enrollees as $enrollee)
                                <tr>
                                    <td>{{$enrollee->learner_course_id}}</td>
                                    <td>{{$enrollee->learner_id}}</td>
                                    <td>
                                        <h1>{{$enrollee->learner_fname}} {{$enrollee->learner_lname}} </h1>
                                        <p>{{$enrollee->learner_email}}</p>
                                    </td>
                                    <td>{{$enrollee->created_at}}</td>
                                    <td>{{$enrollee->status}}</td>
                                    <td class="flex">
                                        {{-- <button class="px-5 py-2 rounded-2xl bg-green-500 hover:bg-green-700">
                                            view
                                        </button> --}}
                                        @if ($enrollee->status == 'Pending')
                                        <form action="/admin/manage_course/enrollee/approve/{{$enrollee->learner_course_id}}" method="POST">
                                            @method('PUT')
                                            @csrf
                                            <button class="py-1 px-3 mx-2 rounded-xl bg-green-500  hover:bg-green-700 hover:text-white">
                                                Approve
                                            </button>
                                        </form>
                                        <form action="/admin/manage_course/enrollee/reject/{{$enrollee->learner_course_id}}" method="POST">
                                            @method('PUT')
                                            @csrf
                                            <button class="py-1 px-3 mx-2 rounded-xl bg-red-500 hover:bg-red-700 hover:text-white">
                                                Reject
                                            </button>
                                        </form>
                                        
                                        @elseif ($enrollee->status == 'Rejected')
                                        <form action="/admin/manage_course/enrollee/pending/{{$enrollee->learner_course_id}}" method="POST">
                                            @method('PUT')
                                            @csrf
                                            <button class="py-1 px-3 mx-2 rounded-xl bg-yellow-500  hover:bg-yellow-700 hover:text-white">
                                                Pending
                                            </button>
                                        </form>
                                        @else
                                        <form action="/admin/manage_course/enrollee/pending/{{$enrollee->learner_course_id}}" method="POST">
                                            @method('PUT')
                                            @csrf
                                            <button class="py-1 px-3 mx-2 rounded-xl bg-yellow-500  hover:bg-yellow-700 hover:text-white">
                                                Pending
                                            </button>
                                        </form>
                                        <form action="/admin/manage_course/enrollee/reject/{{$enrollee->learner_course_id}}" method="POST">
                                            <button class="py-1 px-3 mx-2 rounded-xl bg-red-500 hover:bg-red-700 hover:text-white">
                                                Reject
                                            </button>
                                        </form>
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td class="py-1 text-lg font-normal" colspan="7">No enrollees found.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>


@include('partials.footer')