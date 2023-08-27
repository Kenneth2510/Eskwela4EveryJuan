@include('partials.header')

<section id="sidebar" class="fixed h-full w-64 bg-seagreen top-0 z-20 left-0">


    <div id="sidebar" class="relative mx-auto w-56">
        <ul class="my-48 mx-auto list-none list-inside">
            <li class="py-5 rounded-lg hover:bg-green-100 hover:bg-opacity-10 group"><a href="">
                <div class="flex items-center px-3 rounded-lg" id="dashboard">
                    <i class="fa-solid fa-house text-2xl w-12 px-auto text-center group-hover:text-3xl" style="color: #ffffff;"></i>
                    <h3 class="text-xl text-white px-3 font-normal group-hover:text-black group-hover:text-xl group-hover:font-semibold">Dashboard</h3>
                </div>
            </a></li>

            <li class="py-5 rounded-lg hover:bg-green-100 hover:bg-opacity-10 group"><a href="">
                <div class="flex items-center px-3 rounded-lg" id="learners">
                    <i class="fa-solid fa-user text-2xl w-12 px-auto text-center group-hover:text-3xl" style="color: #ffffff;"></i>
                    <h3 class="text-xl text-white px-3 font-normal group-hover:text-black group-hover:text-xl group-hover:font-semibold">Learners</h3>
                </div>
            </a></li>


            <li class="py-5 rounded-lg hover:bg-green-100 hover:bg-opacity-10 group"><a href="">
                <div class="flex items-center px-3 rounded-lg" id="instructors">
                    <i class="fa-solid fa-user-graduate text-2xl w-12 px-auto text-center group-hover:text-3xl" style="color: #ffffff;"></i>
                    <h3 class="text-xl text-white px-3 font-normal group-hover:text-black group-hover:text-xl group-hover:font-semibold">Instructors</h3>
                </div>
            </a></li>

            <li class="py-5 rounded-lg hover:bg-green-100 hover:bg-opacity-10 group"><a href="">
                <div class="flex items-center px-3 rounded-lg" id="courses">
                    <i class="fa-solid fa-book text-2xl w-12 px-auto text-center group-hover:text-3xl" style="color: #ffffff;"></i>
                    <h3 class="text-xl text-white px-3 font-normal group-hover:text-black group-hover:text-xl group-hover:font-semibold">Courses</h3>
                </div>
            </a></li>

            <li class="py-5 rounded-lg hover:bg-green-100 hover:bg-opacity-10 group"><a href="">
                <div class="flex items-center px-3 rounded-lg" id="performance">
                    <i class="fa-solid fa-chart-simple text-2xl w-12 px-auto text-center group-hover:text-3xl" style="color: #ffffff;"></i>
                    <h3 class="text-xl text-white px-3 font-normal group-hover:text-black group-hover:text-xl group-hover:font-semibold">Performance</h3>
                </div>
            </a></li>

            <li class="py-5 rounded-lg hover:bg-green-100 hover:bg-opacity-10 group"><a href="">
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

<section id="maincontent" class="">
    <div id="title" class="">
        <h1 class="">Overview</h1>
        <div id="adminuser" class="">
            <h3 class="">admin</h3>
            <div id="icon" class=""></div>
        </div>
    </div>

    <div id="mainvalue" class="">
        <div id="upper" class="">
            <div id="totallearner" class="">
                <h3 class="">Total Learners</h3>
                <h2 class="">30</h2>
            </div>
            <div id="totalinstructors" class="">
                <h3 class="">Total Instructors</h3>
                <h2 class="">30</h2>
            </div>
            <div id="totalcourses" class="">
                <h3 class="">Total Courses</h3>
                <h2 class="">30</h2>
            </div>
            <div id="activecourses" class="">
                <h3 class="">Active Courses</h3>
                <h2 class="">30</h2>
            </div>
        </div>

        <div id="lower" class="">
            <div id="lowerleft" class="">
                <div id="time" class=""></div>
                <div id="calendar" class=""></div>
            </div>
            <div id="lowerright" class="">
                <div id="newadded" class="">
                    <h3 class="">Newly Added</h3>
                    <div id="newlearner" class="">
                        <h4 class="">New Learners</h4>
                        <h3 class="">15</h3>
                    </div>
                    <div id="newinstructor" class="">
                        <h4 class="">New Instructors</h4>
                        <h3 class="">15</h3>
                    </div>
                    <div id="newcourses" class="">
                        <h4 class="">New Courses</h4>
                        <h3 class="">15</h3>
                    </div>
                </div>

                <div id="pendingstatus" class="">
                    <h3 class="">Pending Status</h3>
                    <div id="pendinglearner" class="">
                        <h4 class="">Pending Learners</h4>
                        <h3 class="">15</h3>
                    </div>
                    <div id="pendinginstructor" class="">
                        <h4 class="">Pending Instructors</h4>
                        <h3 class="">15</h3>
                    </div>
                    <div id="pendingcourses" class="">
                        <h4 class="">Pending Courses</h4>
                        <h3 class="">15</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


@include('partials.footer')