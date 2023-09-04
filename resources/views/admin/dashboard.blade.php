@include('partials.header')

<section id="sidebarfull" class="fixed h-full w-72 bg-seagreen top-0 z-20 left-0">
    <div id="sidebarfull_menu" class="relative flex items-center px-2 mx-auto py-3">
        <button class="">
            <i class="fa-solid fa-bars text-3xl" style="color: #ffffff;"></i>
        </button>
        <h1 class="text-2xl font-semibold pl-2 text-black">Eskwela4EveryJuan</h1>
    </div>

    <div id="sidebar" class="relative mx-auto w-56">
        <ul class="my-28 mx-auto list-none list-inside">
            <li class="py-5 rounded-lg hover:bg-green-100 hover:bg-opacity-10 group">
                <a href="/admin/dashboard">
                <div class="flex items-center px-3 rounded-lg" id="dashboard">
                    <i class="fa-solid fa-house text-2xl w-12 px-auto text-center group-hover:text-3xl" style="color: #ffffff;"></i>
                    <h3 class="text-xl text-white px-3 font-normal group-hover:text-black group-hover:text-xl group-hover:font-semibold">Dashboard</h3>
                </div>
            </a></li>

            <li class="py-5 rounded-lg hover:bg-green-100 hover:bg-opacity-10 group">
                <a href="/admin/learners">
                <div class="flex items-center px-3 rounded-lg" id="learners">
                    <i class="fa-solid fa-user text-2xl w-12 px-auto text-center group-hover:text-3xl" style="color: #ffffff;"></i>
                    <h3 class="text-xl text-white px-3 font-normal group-hover:text-black group-hover:text-xl group-hover:font-semibold">Learners</h3>
                </div>
            </a></li>


            <li class="py-5 rounded-lg hover:bg-green-100 hover:bg-opacity-10 group">
                <a href="">
                <div class="flex items-center px-3 rounded-lg" id="instructors">
                    <i class="fa-solid fa-user-graduate text-2xl w-12 px-auto text-center group-hover:text-3xl" style="color: #ffffff;"></i>
                    <h3 class="text-xl text-white px-3 font-normal group-hover:text-black group-hover:text-xl group-hover:font-semibold">Instructors</h3>
                </div>
            </a></li>

            <li class="py-5 rounded-lg hover:bg-green-100 hover:bg-opacity-10 group">
                <a href="">
                <div class="flex items-center px-3 rounded-lg" id="courses">
                    <i class="fa-solid fa-book text-2xl w-12 px-auto text-center group-hover:text-3xl" style="color: #ffffff;"></i>
                    <h3 class="text-xl text-white px-3 font-normal group-hover:text-black group-hover:text-xl group-hover:font-semibold">Courses</h3>
                </div>
            </a></li>

            <li class="py-5 rounded-lg hover:bg-green-100 hover:bg-opacity-10 group">
                <a href="">
                <div class="flex items-center px-3 rounded-lg" id="performance">
                    <i class="fa-solid fa-chart-simple text-2xl w-12 px-auto text-center group-hover:text-3xl" style="color: #ffffff;"></i>
                    <h3 class="text-xl text-white px-3 font-normal group-hover:text-black group-hover:text-xl group-hover:font-semibold">Performance</h3>
                </div>
            </a></li>

            <li class="py-5 rounded-lg hover:bg-green-100 hover:bg-opacity-10 group">
                <a href="">
                <div class="flex items-center px-3 rounded-lg" id="settings">
                    <i class="fa-solid fa-gear text-2xl w-12 px-auto text-center group-hover:text-3xl" style="color: #ffffff;"></i>
                    <h3 class="text-xl text-white px-3 font-normal group-hover:text-black group-hover:text-xl group-hover:font-semibold">Settings</h3>
                </div>
            </a></li>

        </ul>  
    </div>

    <div id="logout" class="relative mx-auto w-56 flex justify-center">
        <a href="" class="py-5 bg-darthmouthgreen mx-auto px-14 rounded-2xl text-white text-xl font-medium hover:bg-green-900">Logout</a>
    </div>
</section>

<section id="sidebarmin" class="hidden fixed h-full w-14 bg-seagreen top-0 z-20 left-0">
    <div id="sidebarmin_menu" class="relative flex items-center px-3 mx-auto py-3">
        <button class="">
            <i class="fa-solid fa-bars text-3xl" style="color: #ffffff;"></i>
        </button>
    </div>

    <div id="sidebar" class="relative mx-auto w-56">
        <ul class="my-28 mx-auto list-none list-inside">
            <li class="py-5 rounded-lg hover:bg-green-100 hover:bg-opacity-10 group"><a href="">
                <div class="flex items-center px-1 rounded-lg" id="dashboard">
                    <i class="fa-solid fa-house text-2xl w-12 px-auto text-center group-hover:text-3xl" style="color: #ffffff;"></i>
                </div>
            </a></li>

            <li class="py-5 rounded-lg hover:bg-green-100 hover:bg-opacity-10 group"><a href="">
                <div class="flex items-center px-1 rounded-lg" id="learners">
                    <i class="fa-solid fa-user text-2xl w-12 px-auto text-center group-hover:text-3xl" style="color: #ffffff;"></i>
                </div>
            </a></li>


            <li class="py-5 rounded-lg hover:bg-green-100 hover:bg-opacity-10 group"><a href="">
                <div class="flex items-center px-1 rounded-lg" id="instructors">
                    <i class="fa-solid fa-user-graduate text-2xl w-12 px-auto text-center group-hover:text-3xl" style="color: #ffffff;"></i>
                </div>
            </a></li>

            <li class="py-5 rounded-lg hover:bg-green-100 hover:bg-opacity-10 group"><a href="">
                <div class="flex items-center px-1 rounded-lg" id="courses">
                    <i class="fa-solid fa-book text-2xl w-12 px-auto text-center group-hover:text-3xl" style="color: #ffffff;"></i>
                </div>
            </a></li>

            <li class="py-5 rounded-lg hover:bg-green-100 hover:bg-opacity-10 group"><a href="">
                <div class="flex items-center px-1 rounded-lg" id="performance">
                    <i class="fa-solid fa-chart-simple text-2xl w-12 px-auto text-center group-hover:text-3xl" style="color: #ffffff;"></i>
                </div>
            </a></li>

            <li class="py-5 rounded-lg hover:bg-green-100 hover:bg-opacity-10 group"><a href="">
                <div class="flex items-center px-1 rounded-lg" id="settings">
                    <i class="fa-solid fa-gear text-2xl w-12 px-auto text-center group-hover:text-3xl" style="color: #ffffff;"></i>
                </div>
            </a></li>

        </ul>  
    </div>
</section>

<section id="maincontent" class="relative w-4/5 left-80">
    <div id="title" class="relative flex justify-between my-3 mx-auto px-3 py-auto items-center h-16">
        <h1 class="text-4xl font-semibold">Overview</h1>
        <div id="adminuser" class="flex items-center">
            <h3 class="text-lg">admin</h3>
            <div id="icon" class="mx-3 h-10 w-10 bg-slate-400 rounded-full"></div>
        </div>
    </div>

    <div id="mainvalue" class="relative mt-5 w-full">
        <div id="upper" class="w-full flex justify-around items-center py-3">
            <div id="totallearner" class="bg-green-700 w-72 h-48 rounded-2xl px-5 py-5 text-center shadow-2xl">
                <h3 class="text-2xl font-semibold text-white ">Total Learners</h3>
                <h2 class="text-7xl font-bold text-white mt-7">30</h2>
            </div>
            <div id="totalinstructors" class="bg-green-700 w-72 h-48 rounded-2xl px-5 py-5 text-center shadow-2xl">
                <h3 class="text-2xl font-semibold text-white ">Total Instructors</h3>
                <h2 class="text-7xl font-bold text-white mt-7">30</h2>
            </div>
            <div id="totalcourses" class="bg-green-700 w-72 h-48 rounded-2xl px-5 py-5 text-center shadow-2xl">
                <h3 class="text-2xl font-semibold text-white ">Total Courses</h3>
                <h2 class="text-7xl font-bold text-white mt-7">30</h2>
            </div>
            <div id="activecourses" class="bg-green-700 w-72 h-48 rounded-2xl px-5 py-5 text-center shadow-2xl">
                <h3 class="text-2xl font-semibold text-white ">Active Courses</h3>
                <h2 class="text-7xl font-bold text-white mt-7">30</h2>
            </div>
        </div>

        <div id="lower" class="w-full h-full relative flex mt-3">
            <div id="lowerleft" class="w-8/12 my-auto mr-5">
                <div id="time" class="h-40 rounded-2xl mb-10 bg-slate-400 shadow-2xl"></div>
                <div id="calendar" class="h-96 rounded-2xl bg-blue-400 shadow-2xl"></div>
            </div>
            <div id="lowerright" class="w-4/12 rounded-2xl">
                <div id="newadded" class="w-full mb-5 bg-white rounded-2xl shadow-2xl px-5 py-5">
                    <h3 class="text-3xl font-semibold">Newly Added</h3>
                    <div id="newlearner" class="bg-green-600 my-2 rounded-xl px-5 py-3 flex justify-between items-center">
                        <h4 class="text-2xl font-medium">New Learners</h4>
                        <h3 class="text-5xl">15</h3>
                    </div>
                    <div id="newinstructor" class="bg-green-600 my-2 rounded-xl px-5 py-3 flex justify-between items-center">
                        <h4 class="text-2xl font-medium">New Instructors</h4>
                        <h3 class="text-5xl">15</h3>
                    </div>
                    <div id="newcourses" class="bg-green-600 my-2 rounded-xl px-5 py-3 flex justify-between items-center">
                        <h4 class="text-2xl font-medium">New Courses</h4>
                        <h3 class="text-5xl">15</h3>
                    </div>
                </div>

                <div id="pendingstatus" class="w-full bg-white rounded-2xl shadow-2xl px-5 py-5">
                    <h3 class="text-3xl font-semibold">Pending Status</h3>
                    <div id="pendinglearner" class="bg-green-600 my-2 rounded-xl px-5 py-3 flex justify-between items-center">
                        <h4 class="text-2xl font-medium">Pending Learners</h4>
                        <h3 class="text-5xl">15</h3>
                    </div>
                    <div id="pendinginstructor" class="bg-green-600 my-2 rounded-xl px-5 py-3 flex justify-between items-center">
                        <h4 class="text-2xl font-medium">Pending Instructors</h4>
                        <h3 class="text-5xl">15</h3>
                    </div>
                    <div id="pendingcourses" class="bg-green-600 my-2 rounded-xl px-5 py-3 flex justify-between items-center">
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