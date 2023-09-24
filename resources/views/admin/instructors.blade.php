@include('partials.header')

<section id="AD_SB_full" class="fixed top-0 left-0 z-20 h-full w-72 bg-seagreen">
    <div id="AD_SB_full_menu" class="relative flex items-center px-2 py-3 mx-auto">
        <button class="">
            <i class="text-3xl fa-solid fa-bars" style="color: #ffffff;"></i>
        </button>
        <h1 class="pl-2 text-2xl font-semibold text-black">Eskwela4EveryJuan</h1>
    </div>

    <div id="AD_SB_container" class="relative w-56 mx-auto">
        <ul class="mx-auto list-none list-inside my-28">
            <li class="py-5 rounded-lg hover:bg-green-100 hover:bg-opacity-10 group ">
                <a href="/admin/dashboard">
                <div class="flex items-center px-3 rounded-lg" id="dashboard">
                    <i class="w-12 text-2xl text-center fa-solid fa-house px-auto group-hover:text-3xl" style="color: #ffffff;"></i>
                    <h3 class="px-3 text-xl font-normal text-white group-hover:text-black group-hover:text-xl group-hover:font-semibold">Dashboard</h3>
                </div>
            </a></li>

            <li class="py-5 rounded-lg hover:bg-green-100 hover:bg-opacity-10 group">
                <a href="/admin/learners">
                <div class="flex items-center px-3 rounded-lg" id="learners">
                    <i class="w-12 text-2xl text-center fa-solid fa-user px-auto group-hover:text-3xl" style="color: #ffffff;"></i>
                    <h3 class="px-3 text-xl font-normal text-white group-hover:text-black group-hover:text-xl group-hover:font-semibold">Learners</h3>
                </div>
            </a></li>


            <li class="py-5 rounded-lg hover:bg-green-100 hover:bg-opacity-10 group selected">
                <a href="/admin/instructors">
                <div class="flex items-center px-3 rounded-lg" id="instructors">
                    <i class="w-12 text-2xl text-center fa-solid fa-user-graduate px-auto group-hover:text-3xl" style="color: #ffffff;"></i>
                    <h3 class="px-3 text-xl font-normal text-white group-hover:text-black group-hover:text-xl group-hover:font-semibold">Instructors</h3>
                </div>
            </a></li>

            <li class="py-5 rounded-lg hover:bg-green-100 hover:bg-opacity-10 group">
                <a href="">
                <div class="flex items-center px-3 rounded-lg" id="courses">
                    <i class="w-12 text-2xl text-center fa-solid fa-book px-auto group-hover:text-3xl" style="color: #ffffff;"></i>
                    <h3 class="px-3 text-xl font-normal text-white group-hover:text-black group-hover:text-xl group-hover:font-semibold">Courses</h3>
                </div>
            </a></li>

            <li class="py-5 rounded-lg hover:bg-green-100 hover:bg-opacity-10 group">
                <a href="">
                <div class="flex items-center px-3 rounded-lg" id="performance">
                    <i class="w-12 text-2xl text-center fa-solid fa-chart-simple px-auto group-hover:text-3xl" style="color: #ffffff;"></i>
                    <h3 class="px-3 text-xl font-normal text-white group-hover:text-black group-hover:text-xl group-hover:font-semibold">Performance</h3>
                </div>
            </a></li>

            <li class="py-5 rounded-lg hover:bg-green-100 hover:bg-opacity-10 group">
                <a href="">
                <div class="flex items-center px-3 rounded-lg" id="settings">
                    <i class="w-12 text-2xl text-center fa-solid fa-gear px-auto group-hover:text-3xl" style="color: #ffffff;"></i>
                    <h3 class="px-3 text-xl font-normal text-white group-hover:text-black group-hover:text-xl group-hover:font-semibold">Settings</h3>
                </div>
            </a></li>

        </ul>  
    </div>

    <div id="AD_SB_logout" class="relative flex justify-center w-56 mx-auto">
        <a href="" class="py-5 mx-auto text-xl font-medium text-white bg-darthmouthgreen px-14 rounded-2xl hover:bg-green-900">Logout</a>
    </div>
</section>

<section id="AD002_I_maincontent" class="relative w-4/5 h-full left-80">
    <div id="title" class="relative flex items-center justify-between h-16 px-3 mx-auto my-3 py-auto">
        <h1 class="text-4xl font-semibold">Instructor Management</h1>
        <div id="adminuser" class="flex items-center">
            <h3 class="text-lg">admin</h3>
            <div id="icon" class="w-10 h-10 mx-3 rounded-full bg-slate-400"></div>
        </div>
    </div>
    <div id="AD002_I_maincontainer" class="relative max-h-full px-5 py-5 shadow-2xl bg-mainwhitebg mt-7 rounded-2xl">
        <div id="containertitle" class="flex items-center justify-between pt-1 pb-5 px-auto">
            <h3 class="text-3xl font-semibold">All Instructors</h3>
            <div class="flex items-center">
                <a href="{{  url('/admin/add_instructor') }}" class="px-3 py-2 mx-3 text-lg font-medium bg-green-600 rounded-xl hover:bg-green-900 hover:text-white">Add New</a>
                <form action="{{ url('/admin/instructors') }}" method="GET">
                    <div class="flex items-center">
                        <div class="flex items-center mx-10">
                            <div class="mx-2">
                                <label for="filterDate" class="">Filter by Date</label><br>
                                <input type="date" name="filterDate" class="w-40 px-2 py-2 text-base border-2 border-black rounded-xl" value="">
                            </div>
                            <div class="mx-2">
                                <label for="filterStatus" class="">Filter by Status</label><br>
                                <select name="filterStatus" id="filterStatus" class="w-32 px-2 py-2 text-base border-2 border-black rounded-xl">
                                    <option value="">Select Status</option>
                                    <option value="Pending">Pending</option>
                                    <option value="Approved">Approved</option>
                                    <option value="Rejected">Rejected</option>
                                </select>
                            </div>
                            <button class="h-12 px-5 py-1 mx-3 text-lg font-medium bg-green-600 rounded-xl hover:bg-green-900 hover:text-white" type="submit">Filter</button>
                        </div>
                        <div class="">
                            <select name="searchBy" id="" class="w-40 px-2 py-2 text-lg border-2 border-black rounded-xl">
                                <option value="" class="">Search By</option>
                                <option value="instructor_id">Instructor ID</option>
                                <option value="name">Name</option>
                                <option value="instructor_email">Email</option>
                                <option value="instructor_contactno">Contact No.</option>
                                {{-- <option value="status">Status</option> --}}
                            </select>
                            <input type="text" name="searchVal" class="px-2 py-2 ml-3 text-lg border-2 border-black w-80 rounded-xl" placeholder="Type to search">
                            <button class="px-3 py-2 mx-3 text-lg font-medium bg-green-600 rounded-xl hover:bg-green-900 hover:text-white" type="submit">Search</button>
                        </div>
                    </div>
                    
                     </form>    
            </div>
        </div>

        <div id="AD002_I_contenttable" class="mt-7">
          <table class="">
            <thead class="border-b-2 border-black">
                <th class="w-2/12 text-xl text-left">Instructor ID</th>
                <th class="w-3/12 text-xl text-left">Name</th>
                <th class="w-3/12 text-xl text-left">Contact Info</th>
                <th class="w-2/12 text-xl text-left">Date Registered</th>
                <th class="w-1/12 text-xl text-left">Status</th>
                <th class="w-1/12"></th>
            </thead>
            <tbody class="">
                @forelse ($instructors as $instructor)
                <tr class="">
                    <td class="w-2/12 py-1 text-lg font-normal">{{ $instructor->instructor_id }}</td>
                    <td class="w-3/12 py-1 text-lg font-normal">{{ $instructor->instructor_fname }} {{ $instructor->instructor_lname }}</td>
                    <td class="w-3/12 py-1 text-lg font-normal">{{ $instructor->instructor_email }}<br>{{$instructor->instructor_contactno}}</td>
                    <td class="w-1/12 py-1 text-lg font-normal">{{ $instructor->created_at }}</td>
                    <td class="w-2/12 py-1 text-lg font-normal">{{ $instructor->status }}</td>
                    <td class="w-1/12"><a href="/admin/view_instructor/{{ $instructor->instructor_id }}" class="px-3 py-2 mx-3 text-lg font-medium bg-green-600 rounded-xl hover:bg-green-900 hover:text-white">view</a></td>
                </tr>
                @empty
                <tr>
                    <td class="py-1 text-lg font-normal" colspan="7">No learners found.</td>
                </tr>
                @endforelse
            </tbody>
          </table>
        <div class="">{{$instructors->links()}}</div>
        </div>
    </div>

@include('partials.footer')