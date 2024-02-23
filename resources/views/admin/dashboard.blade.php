@extends('layouts.admin_layout')

@section('content')
    <section id="maincontent" class="relative w-full h-screen px-4 overflow-auto pt-28 md:w-3/4 lg:w-10/12 md:pt-16"> 
        <div id="title" class="relative flex items-center justify-between px-3 mx-auto my-3 text-black">
            <h1 class="py-4 text-2xl font-semibold md:text-4xl">Overview</h1>
            <div id="adminuser" class="items-center hidden md:flex">
                <h3 class="text-lg">{{ $adminCodeName }}</h3>
                <div id="icon" class="w-10 h-10 mx-3 rounded-full bg-slate-400"></div>
            </div>
        </div>

        <div id="mainvalue" class="relative w-full">
            <div id="upper" class="flex items-center justify-around w-full py-3 overflow-auto">
                <div id="totallearner" class="flex flex-col items-center justify-center w-1/4 h-32 mx-2 text-center bg-green-700 shadow-2xl rounded-2xl md:h-40 lg:w-72">
                    <h3 class="text-sm font-semibold text-white lg:text-2xl">Total Learners</h3>
                    <h2 class="text-2xl font-bold text-white lg:text-4xl">{{ $totalLearner }}</h2>
                </div>
                <div id="totalinstructors" class="flex flex-col items-center justify-center w-1/4 h-32 mx-2 text-center bg-green-700 shadow-2xl rounded-2xl md:h-40 lg:w-72">
                    <h3 class="text-sm font-semibold text-white lg:text-2xl">Total Instructors</h3>
                    <h2 class="text-2xl font-bold text-white lg:text-4xl">{{ $totalInstructor }}</h2>
                </div>
                <div id="totalcourses" class="flex flex-col items-center justify-center w-1/4 h-32 mx-2 text-center bg-green-700 shadow-2xl rounded-2xl md:h-40 lg:w-72">
                    <h3 class="text-sm font-semibold text-white lg:text-2xl">Total Courses</h3>
                    <h2 class="text-2xl font-bold text-white lg:text-4xl">30</h2>
                </div>
                <div id="activecourses" class="flex flex-col items-center justify-center w-1/4 h-32 mx-2 text-center bg-green-700 shadow-2xl rounded-2xl md:h-40 lg:w-72">
                    <h3 class="text-sm font-semibold text-white lg:text-2xl">Active Courses</h3>
                    <h2 class="text-2xl font-bold text-white lg:text-4xl">30</h2>
                </div>
            </div>

            <div id="lower" class="relative flex flex-col-reverse w-full h-auto px-2 lg:flex-row lg:justify-between">
                <div id="lowerleft" class="w-full lg:w-4/5 lg:my-2">
                    <div id="time" class="h-40 my-2 shadow-lg rounded-2xl bg-slate-400"></div>
                    <div id="calendar" class="my-2 bg-blue-400 shadow-lg h-96 rounded-2xl"></div>
                </div>
                <div id="lowerright" class="flex w-full rounded-2xl lg:flex-col lg:w-1/5 lg:p-4">
                    <div id="newadded" class="w-1/2 p-2 bg-white shadow-lg rounded-2xl lg:w-full">
                        <h3 class="text-lg font-semibold text-black">Newly Approved</h3>
                        <div id="newlearner" class="flex items-center justify-between px-2 py-4 my-2 bg-green-600 rounded-xl">
                            <h4 class="font-medium text-md">New Learners</h4>
                            <h3 class="text-2xl">{{ $approvedLearner }}</h3>
                        </div>
                        <div id="newinstructor" class="flex items-center justify-between px-2 py-4 my-2 bg-green-600 rounded-xl">
                            <h4 class="font-medium text-md">New Instructors</h4>
                            <h3 class="text-2xl">{{ $approvedInstructor }}</h3>
                        </div>
                        <div id="newcourses" class="flex items-center justify-between px-2 py-4 my-2 bg-green-600 rounded-xl">
                            <h4 class="font-medium text-md">New Courses</h4>
                            <h3 class="text-2xl">15</h3>
                        </div>
                    </div>

                    <div id="pendingstatus" class="w-1/2 p-2 bg-white shadow-lg rounded-2xl lg:w-full lg:my-2">
                        <h3 class="text-lg font-semibold text-black">Pending Status</h3>
                        <div id="pendinglearner" class="flex items-center justify-between px-2 py-4 my-2 bg-green-600 rounded-xl">
                            <h4 class="font-medium text-md">Pending Learners</h4>
                            <h3 class="text-2xl">{{ $pendingLearner }}</h3>
                        </div>
                        <div id="pendinginstructor" class="flex items-center justify-between px-2 py-4 my-2 bg-green-600 rounded-xl">
                            <h4 class="font-medium text-md">Pending Instructors</h4>
                            <h3 class="text-2xl">{{ $pendingInstructor }}</h3>
                        </div>
                        <div id="pendingcourses" class="flex items-center justify-between px-2 py-4 my-2 bg-green-600 rounded-xl">
                            <h4 class="font-medium text-md">Pending Courses</h4>
                            <h3 class="text-2xl">15</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection


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