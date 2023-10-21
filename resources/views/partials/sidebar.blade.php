<section id="sidebarfull" class="fixed top-0 left-0 z-20 h-full w-72 bg-seagreen">
    <div id="sidebarfull_menu" class="relative flex items-center px-2 py-3 mx-auto">
        <button class="">
            <i class="text-3xl fa-solid fa-bars" style="color: #ffffff;"></i>
        </button>
        <h1 class="pl-2 text-2xl font-semibold text-black">Eskwela4EveryJuan</h1>
    </div>

    <div id="sidebar" class="relative w-56 mx-auto">
        <ul class="mx-auto list-none list-inside my-28">
            <li id="admin_dashboard" class=" py-5 rounded-lg hover:bg-green-100 hover:bg-opacity-10 group">
                <a href="/admin/dashboard">
                <div class="flex items-center px-3 rounded-lg" id="dashboard">
                    <i class="w-12 text-2xl text-center fa-solid fa-house px-auto group-hover:text-3xl" style="color: #ffffff;"></i>
                    <h3 class="px-3 text-xl font-normal text-white group-hover:text-black group-hover:text-xl group-hover:font-semibold">Dashboard</h3>
                </div>
            </a></li>

            <li id="admin_learners" class="py-5 rounded-lg hover:bg-green-100 hover:bg-opacity-10 group">
                <a href="/admin/learners">
                <div class="flex items-center px-3 rounded-lg" id="learners">
                    <i class="w-12 text-2xl text-center fa-solid fa-user px-auto group-hover:text-3xl" style="color: #ffffff;"></i>
                    <h3 class="px-3 text-xl font-normal text-white group-hover:text-black group-hover:text-xl group-hover:font-semibold">Learners</h3>
                </div>
            </a></li>


            <li id="admin_instructors" class="py-5 rounded-lg hover:bg-green-100 hover:bg-opacity-10 group">
                <a href="/admin/instructors">
                <div class="flex items-center px-3 rounded-lg" id="instructors">
                    <i class="w-12 text-2xl text-center fa-solid fa-user-graduate px-auto group-hover:text-3xl" style="color: #ffffff;"></i>
                    <h3 class="px-3 text-xl font-normal text-white group-hover:text-black group-hover:text-xl group-hover:font-semibold">Instructors</h3>
                </div>
            </a></li>

            <li id="admin_courses" class="py-5 rounded-lg hover:bg-green-100 hover:bg-opacity-10 group">
                <a href="/admin/courses">
                <div class="flex items-center px-3 rounded-lg" id="courses">
                    <i class="w-12 text-2xl text-center fa-solid fa-book px-auto group-hover:text-3xl" style="color: #ffffff;"></i>
                    <h3 class="px-3 text-xl font-normal text-white group-hover:text-black group-hover:text-xl group-hover:font-semibold">Courses</h3>
                </div>
            </a></li>

            <li id="admin_performance" class="py-5 rounded-lg hover:bg-green-100 hover:bg-opacity-10 group">
                <a href="">
                <div class="flex items-center px-3 rounded-lg" id="performance">
                    <i class="w-12 text-2xl text-center fa-solid fa-chart-simple px-auto group-hover:text-3xl" style="color: #ffffff;"></i>
                    <h3 class="px-3 text-xl font-normal text-white group-hover:text-black group-hover:text-xl group-hover:font-semibold">Performance</h3>
                </div>
            </a></li>

            <li id="admin_settings" class="py-5 rounded-lg hover:bg-green-100 hover:bg-opacity-10 group">
                <a href="">
                <div class="flex items-center px-3 rounded-lg" id="settings">
                    <i class="w-12 text-2xl text-center fa-solid fa-gear px-auto group-hover:text-3xl" style="color: #ffffff;"></i>
                    <h3 class="px-3 text-xl font-normal text-white group-hover:text-black group-hover:text-xl group-hover:font-semibold">Settings</h3>
                </div>
            </a></li>

        </ul>  
    </div>

    <div id="logout" class="relative flex justify-center w-56 mx-auto">
        <form action="{{ url('/admin/logout') }}" method="POST">
            @csrf
            <button class="py-5 mx-auto text-xl font-medium text-white bg-darthmouthgreen px-14 rounded-2xl hover:bg-green-900">Logout</button>
        </form>
        
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



<script>
    $(document).ready(function() {
    var currentUrl = window.location.href;

    if(currentUrl.includes('/admin/dashboard')) {
        $('#admin_dashboard').addClass('selected');
    } else if (currentUrl.includes('/admin/learners') || currentUrl.includes('/admin/add_learner') || currentUrl.includes('/admin/view_learner')) {
        $('#admin_learners').addClass('selected');
    } else if (currentUrl.includes('/admin/instructors') || currentUrl.includes('/admin/add_instructor') || currentUrl.includes('/admin/view_instructor')) {
        $('#admin_instructors').addClass('selected');
    } else if (currentUrl.includes('/admin/courses')) || currentUrl.includes('/admin/add_course') || currentUrl.includes('/admin/view_course') || currentUrl.includes('/admin/manage_course'){
        $('#admin_courses').addClass('selected');
    } else if (currentUrl.includes('/admin/performance')) {
        $('#admin_performance').addClass('selected');
    } else if (currentUrl.includes('/admin/settings')) {
        $('#admin_settings').addClass('selected');
    } else {
        
    }
})
</script>