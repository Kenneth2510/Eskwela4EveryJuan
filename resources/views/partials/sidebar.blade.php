<section id="sidebarfull" class="fixed z-20 w-full h-auto overflow-hidden text-white md:w-1/3 lg:w-2/12 md:relative">
    <div id="sidebar" class="fixed w-full bg-seagreen md:h-screen md:pt-16 top-14 md:relative">
        <ul class="flex flex-row justify-between w-full mx-auto list-none list-inside md:flex-col">
            <li id="admin_dashboard" class="py-5 rounded-lg hover:bg-green-100 hover:bg-opacity-10 group">
                <a href="/admin/dashboard">
                <div class="flex items-center px-3 rounded-lg" id="dashboard">
                    <i class="w-12 text-2xl text-center fa-solid fa-house px-auto group-hover:animate-pulse" style="color: #ffffff;"></i>
                    <h3 class="hidden px-3 text-lg font-normal text-white group-hover:animate-pulse group-hover:text-xl group-hover:font-semibold md:block">Dashboard</h3>
                </div>
            </a></li>

            <li id="admin_learners" class="py-5 rounded-lg hover:bg-green-100 hover:bg-opacity-10 group">
                <a href="/admin/learners">
                <div class="flex items-center px-3 rounded-lg" id="learners">
                    <i class="w-12 text-2xl text-center fa-solid fa-user px-auto group-hover:animate-pulse" style="color: #ffffff;"></i>
                    <h3 class="hidden px-3 text-lg font-normal text-white group-hover:animate-pulse group-hover:text-xl group-hover:font-semibold md:block">Learners</h3>
                </div>
            </a></li>


            <li id="admin_instructors" class="py-5 rounded-lg hover:bg-green-100 hover:bg-opacity-10 group">
                <a href="/admin/instructors">
                <div class="flex items-center px-3 rounded-lg" id="instructors">
                    <i class="w-12 text-2xl text-center fa-solid fa-user-graduate px-auto group-hover:animate-pulse" style="color: #ffffff;"></i>
                    <h3 class="hidden px-3 text-lg font-normal text-white group-hover:animate-pulse group-hover:text-xl group-hover:font-semibold md:block">Instructors</h3>
                </div>
            </a></li>

            <li id="admin_courses" class="py-5 rounded-lg hover:bg-green-100 hover:bg-opacity-10 group">
                <a href="/admin/courses">
                <div class="flex items-center px-3 rounded-lg" id="courses">
                    <i class="w-12 text-2xl text-center fa-solid fa-book px-auto group-hover:animate-pulse" style="color: #ffffff;"></i>
                    <h3 class="hidden px-3 text-lg font-normal text-white group-hover:animate-pulse group-hover:text-xl group-hover:font-semibold md:block">Courses</h3>
                </div>
            </a></li>

            <li id="admin_performance" class="py-5 rounded-lg hover:bg-green-100 hover:bg-opacity-10 group">
                <a href="">
                <div class="flex items-center px-3 rounded-lg" id="performance">
                    <i class="w-12 text-2xl text-center fa-solid fa-chart-simple px-auto group-hover:animate-pulse" style="color: #ffffff;"></i>
                    <h3 class="hidden px-3 text-lg font-normal text-white group-hover:animate-pulse group-hover:text-xl group-hover:font-semibold md:block">Performance</h3>
                </div>
            </a></li>

            <li id="admin_settings" class="py-5 rounded-lg hover:bg-green-100 hover:bg-opacity-10 group">
                <a href="">
                <div class="flex items-center px-3 rounded-lg" id="settings">
                    <i class="w-12 text-2xl text-center fa-solid fa-gear px-auto group-hover:animate-pulse" style="color: #ffffff;"></i>
                    <h3 class="hidden px-3 text-lg font-normal text-white group-hover:animate-pulse group-hover:text-xl group-hover:font-semibold md:block">Settings</h3>
                </div>
            </a></li>
        </ul>  
        <div id="logout" class="relative items-center justify-center hidden w-full mx-auto lg:flex">
            <form action="{{ url('/admin/logout') }}" method="POST">
                @csrf
                {{-- <button class="py-5 mx-auto text-xl font-medium text-white bg-darthmouthgreen px-14 rounded-2xl hover:bg-green-900">Logout</button> --}}
                <x-forms.primary-button
                color="darthmouthgreen"
                name="Log out"
                type="submit"
                class="w-56">
                </x-forms.primary-button>
            </form>
            
        </div>
    </div>

</section>
{{-- 
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
</section> --}}



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