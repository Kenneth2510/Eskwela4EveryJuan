@include('partials.header')

<section id="sidebarfull" class="fixed top-0 left-0 z-20 h-full w-72 bg-seagreen">
    <div id="sidebarfull_menu" class="relative flex items-center px-2 py-3 mx-auto">
        <button class="">
            <i class="text-3xl fa-solid fa-bars" style="color: #ffffff;"></i>
        </button>
        <h1 class="pl-2 text-2xl font-semibold text-black">Eskwela4EveryJuan</h1>
    </div>

    <div id="sidebar" class="relative w-56 mx-auto">
        <ul class="mx-auto list-none list-inside my-28">
            <li class="py-5 rounded-lg hover:bg-green-100 hover:bg-opacity-10 group">
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


            <li class="py-5 rounded-lg hover:bg-green-100 hover:bg-opacity-10 group">
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

    <div id="logout" class="relative flex justify-center w-56 mx-auto">
        <a href="" class="py-5 mx-auto text-xl font-medium text-white bg-darthmouthgreen px-14 rounded-2xl hover:bg-green-900">Logout</a>
    </div>
</section>

<section id="sidebarmin" class="fixed top-0 left-0 z-20 hidden h-full w-14 bg-seagreen">
    <div id="sidebarmin_menu" class="relative flex items-center px-3 py-3 mx-auto">
        <button class="">
            <i class="text-3xl fa-solid fa-bars" style="color: #ffffff;"></i>
        </button>
    </div>

    <div id="sidebar" class="relative w-56 mx-auto">
        <ul class="mx-auto list-none list-inside my-28">
            <li class="py-5 rounded-lg hover:bg-green-100 hover:bg-opacity-10 group"><a href="">
                <div class="flex items-center px-1 rounded-lg" id="dashboard">
                    <i class="w-12 text-2xl text-center fa-solid fa-house px-auto group-hover:text-3xl" style="color: #ffffff;"></i>
                </div>
            </a></li>

            <li class="py-5 rounded-lg hover:bg-green-100 hover:bg-opacity-10 group"><a href="">
                <div class="flex items-center px-1 rounded-lg" id="learners">
                    <i class="w-12 text-2xl text-center fa-solid fa-user px-auto group-hover:text-3xl" style="color: #ffffff;"></i>
                </div>
            </a></li>


            <li class="py-5 rounded-lg hover:bg-green-100 hover:bg-opacity-10 group"><a href="">
                <div class="flex items-center px-1 rounded-lg" id="instructors">
                    <i class="w-12 text-2xl text-center fa-solid fa-user-graduate px-auto group-hover:text-3xl" style="color: #ffffff;"></i>
                </div>
            </a></li>

            <li class="py-5 rounded-lg hover:bg-green-100 hover:bg-opacity-10 group"><a href="">
                <div class="flex items-center px-1 rounded-lg" id="courses">
                    <i class="w-12 text-2xl text-center fa-solid fa-book px-auto group-hover:text-3xl" style="color: #ffffff;"></i>
                </div>
            </a></li>

            <li class="py-5 rounded-lg hover:bg-green-100 hover:bg-opacity-10 group"><a href="">
                <div class="flex items-center px-1 rounded-lg" id="performance">
                    <i class="w-12 text-2xl text-center fa-solid fa-chart-simple px-auto group-hover:text-3xl" style="color: #ffffff;"></i>
                </div>
            </a></li>

            <li class="py-5 rounded-lg hover:bg-green-100 hover:bg-opacity-10 group"><a href="">
                <div class="flex items-center px-1 rounded-lg" id="settings">
                    <i class="w-12 text-2xl text-center fa-solid fa-gear px-auto group-hover:text-3xl" style="color: #ffffff;"></i>
                </div>
            </a></li>

        </ul>  
    </div>
</section>

<section id="maincontent" class="relative w-4/5 left-80">
    <div id="title" class="relative flex items-center justify-between h-16 px-3 mx-auto my-3 py-auto">
        <h1 class="text-4xl font-semibold">Overview</h1>
        <div id="adminuser" class="flex items-center">
            <h3 class="text-lg">admin</h3>
            <div id="icon" class="w-10 h-10 mx-3 rounded-full bg-slate-400"></div>
        </div>
    </div>

    <div id="mainvalue" class="relative w-full mt-5">
        <div id="upper" class="flex items-center justify-around w-full py-3">
            <div id="totallearner" class="h-48 px-5 py-5 text-center bg-green-700 shadow-2xl w-72 rounded-2xl">
                <h3 class="text-2xl font-semibold text-white ">Total Learners</h3>
                <h2 class="font-bold text-white text-7xl mt-7">{{ $totalLearner }}</h2>
            </div>
            <div id="totalinstructors" class="h-48 px-5 py-5 text-center bg-green-700 shadow-2xl w-72 rounded-2xl">
                <h3 class="text-2xl font-semibold text-white ">Total Instructors</h3>
                <h2 class="font-bold text-white text-7xl mt-7">{{ $totalInstructor }}</h2>
            </div>
            <div id="totalcourses" class="h-48 px-5 py-5 text-center bg-green-700 shadow-2xl w-72 rounded-2xl">
                <h3 class="text-2xl font-semibold text-white ">Total Courses</h3>
                <h2 class="font-bold text-white text-7xl mt-7">30</h2>
            </div>
            <div id="activecourses" class="h-48 px-5 py-5 text-center bg-green-700 shadow-2xl w-72 rounded-2xl">
                <h3 class="text-2xl font-semibold text-white ">Active Courses</h3>
                <h2 class="font-bold text-white text-7xl mt-7">30</h2>
            </div>
        </div>

        <div id="lower" class="relative flex w-full h-full mt-3">
            <div id="lowerleft" class="w-8/12 my-auto mr-5">
                <div id="time" class="h-40 mb-10 shadow-2xl rounded-2xl bg-slate-400"></div>
                <div id="calendar" class="bg-blue-400 shadow-2xl h-96 rounded-2xl"></div>
            </div>
            <div id="lowerright" class="w-4/12 rounded-2xl">
                <div id="newadded" class="w-full px-5 py-5 mb-5 bg-white shadow-2xl rounded-2xl">
                    <h3 class="text-3xl font-semibold">Newly Approved</h3>
                    <div id="newlearner" class="flex items-center justify-between px-5 py-3 my-2 bg-green-600 rounded-xl">
                        <h4 class="text-2xl font-medium">New Learners</h4>
                        <h3 class="text-5xl">{{ $approvedLearner }}</h3>
                    </div>
                    <div id="newinstructor" class="flex items-center justify-between px-5 py-3 my-2 bg-green-600 rounded-xl">
                        <h4 class="text-2xl font-medium">New Instructors</h4>
                        <h3 class="text-5xl">{{ $approvedInstructor }}</h3>
                    </div>
                    <div id="newcourses" class="flex items-center justify-between px-5 py-3 my-2 bg-green-600 rounded-xl">
                        <h4 class="text-2xl font-medium">New Courses</h4>
                        <h3 class="text-5xl">15</h3>
                    </div>
                </div>

                <div id="pendingstatus" class="w-full px-5 py-5 bg-white shadow-2xl rounded-2xl">
                    <h3 class="text-3xl font-semibold">Pending Status</h3>
                    <div id="pendinglearner" class="flex items-center justify-between px-5 py-3 my-2 bg-green-600 rounded-xl">
                        <h4 class="text-2xl font-medium">Pending Learners</h4>
                        <h3 class="text-5xl">{{ $pendingLearner }}</h3>
                    </div>
                    <div id="pendinginstructor" class="flex items-center justify-between px-5 py-3 my-2 bg-green-600 rounded-xl">
                        <h4 class="text-2xl font-medium">Pending Instructors</h4>
                        <h3 class="text-5xl">{{ $pendingInstructor }}</h3>
                    </div>
                    <div id="pendingcourses" class="flex items-center justify-between px-5 py-3 my-2 bg-green-600 rounded-xl">
                        <h4 class="text-2xl font-medium">Pending Courses</h4>
                        <h3 class="text-5xl">15</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    $(document).ready(function () {
        $("#sidebarfull_menu").click(function () {
            $("#sidebarfull, #sidebarmin").toggleClass("hidden");
        });

        $("#sidebarmin_menu").click(function () {
            $("#sidebarfull, #sidebarmin").toggleClass("hidden");
        });
    });
</script>



@include('partials.footer')