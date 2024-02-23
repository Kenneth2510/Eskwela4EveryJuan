@extends('layouts.admin_layout')

@section('content')
    <section id="maincontent" class="relative w-full h-screen px-4 overflow-auto pt-28 md:w-3/4 lg:w-10/12 md:pt-16">
        <div id="title" class="relative flex items-center justify-between px-3 mx-auto my-3 text-black">
            <h1 class="py-4 text-2xl font-semibold lg:text-4xl">Courses Management</h1>
            <div id="adminuser" class="items-center hidden lg:flex">
                <h3 class="text-lg">{{ $adminCodeName }}</h3>
                <div id="icon" class="w-10 h-10 mx-3 rounded-full bg-slate-400"></div>
            </div>
        </div>
        <div id="maincontainer" class="relative w-full px-2 text-black shadow-lg rounded-2xl">
            <div id="containertitle" class="flex flex-col-reverse justify-between pt-1 pb-5 lg:flex-row">
                <h3 class="text-lg font-semibold lg:text-xl">All Courses</h3>
                <div class="flex flex-col lg:flex-row lg:justify-center lg:items-end">
                        <a href="{{ url('/admin/add_course') }}" class="py-4 my-2 text-sm font-medium text-center text-white bg-green-600 rounded-xl hover:bg-green-900 lg:py-2 lg:w-32 lg:my-0">Add New</a>
                    
                        <form action="{{ url('/admin/courses') }}" method="GET">
                            <div class="flex flex-col items-center w-full my-2 md:flex-row md:items-end lg:my-0">
                                <div class="flex flex-col w-full my-2 md:px-1 lg:flex-row lg:justify-center lg:my-0 lg:items-end">
                                    <div class="flex flex-row items-center justify-around w-full md:items-end lg:justify-center">
                                        <div class="w-2/4 mx-1">
                                            <label for="filterDate" class="">Filter by Date</label><br>
                                            <input type="date" name="filterDate" class="w-full p-2 text-sm border-2 border-black rounded" value="">
                                        </div>
                                        <div class="w-2/4 mx-1">
                                            <label for="filterStatus" class="">Filter by Status</label><br>
                                            <select name="filterStatus" id="filterStatus" class="w-full p-2 text-sm border-2 border-black rounded">
                                                <option value="">Select Status</option>
                                                <option value="Pending">Pending</option>
                                                <option value="Approved">Approved</option>
                                                <option value="Rejected">Rejected</option>
                                            </select>
                                        </div>
                                    </div>

                                    <button class="py-4 my-2 text-sm font-medium text-white bg-green-600 rounded-xl hover:bg-green-900 lg:py-2 lg:w-32 lg:my-0" type="submit">Filter</button>
                                </div>
                                <div class="flex flex-col w-full my-2 md:px-1 lg:flex-row lg:justify-center lg:my-0 lg:items-end">
                                    <div class="flex flex-row items-center justify-around w-full md:items-end lg:items-center lg:justify-center">
                                        <div class="w-2/4 mx-1">
                                            <select name="searchBy" id="" class="w-full p-2 text-sm border-2 border-black rounded">
                                                <option value="" class="">Search By</option>
                                                <option value="instructor_id">Instructor ID</option>
                                                <option value="name">Name</option>
                                                <option value="instructor_email">Email</option>
                                                <option value="instructor_contactno">Contact No.</option>
                                                {{-- <option value="status">Status</option> --}}
                                            </select>
                                        </div>
                                        <div class="w-2/4 mx-1">
                                            <input type="text" name="searchVal" class="w-full p-2 text-sm border-2 border-black rounded" placeholder="Type to search"> 
                                        </div>
                                    </div>
                                    
                                    <button class="py-4 my-2 text-sm font-medium text-white bg-green-600 rounded-xl hover:bg-green-900 lg:py-2 lg:w-32 lg:my-0" type="submit">Search</button>
                                </div>
                            </div>
                            
                        </form>
                    </div>
            </div>

            <div id="contenttable" class="h-auto py-4 overflow-x-scroll text-sm lg:overflow-hidden">
            <table class="hidden w-full text-center md:table">
                <thead class="border-b-2 border-black">
                    <th>Course ID</th>
                    <th>Course Code</th>
                    <th>Course Name</th>
                    <th>Course Instructor</th>
                    <th>Date Registered</th>
                    <th>Status</th>
                    <th></th>
                </thead>
                <tbody class="">
                    @forelse ($courses as $course)
                    <tr class="">
                        <td class="py-4 font-semibold">{{ $course->course_id }}</td>
                        <td>{{ $course->course_code }}</td>
                        <td class="py-4">{{ $course->course_name }}</td>
                        <td class="py-4">{{ $course->instructor_lname }}  {{ $course->instructor_fname }}</td>
                        <td class="py-4">{{ $course->created_at }}</td>
                        <td class="py-4">{{$course->course_status}}</td>
                        <td class="py-4"><a href="/admin/view_course/{{$course->course_id}}" class="px-3 py-2 mx-3 text-lg font-medium bg-green-600 rounded-xl hover:bg-green-900 hover:text-white">view</a></td>
                    </tr>
                    @empty
                    <tr>
                        <td class="py-1 text-lg font-normal" colspan="7">No courses found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>

            @forelse ($courses as $course)
                <table id="mobile-table" class="w-full mb-4 text-left border-2 table-fixed border-seagreen md:hidden">
                    <tr class=" bg-seagreen bg-opacity-30">
                        <th class="p-2">Course ID</th>
                        <td>{{ $course->course_id }}</td>
                    </tr>
                    <tr>
                        <th class="p-2">Course Code</th>
                        <td>{{ $course->course_code }}</td>
                    </tr>
                    <tr>
                        <th class="p-2">Course Name</th>
                        <td>{{ $course->course_name }}</td>
                    </tr>
                    <tr>
                        <th class="p-2">Course Instructor</th>
                        <td>{{ $course->instructor_lname }}  {{ $course->instructor_fname }}</td>
                    </tr>
                    <tr>
                        <th class="p-2">Date Registered</th>
                        <td>{{ $course->created_at }}</td>
                    </tr>
                    <tr>
                        <th class="p-2">Status</th>
                        <td>{{$course->course_status}}</td>
                    </tr>
                    <tr>
                        <th class="p-8"></th>
                        <td><a href="/admin/view_course/{{$course->course_id}}" class="px-4 py-2 text-sm font-medium text-white bg-green-600 rounded hover:bg-green-900">view</a></td>
                    </tr>
            @empty
                    <tr>
                        <td class="py-1 text-lg font-normal " colspan="7">No courses found.</td>
                    </tr>
                </table>
            @endforelse
            <div class="">{{$courses->links()}}</div>
            </div>
        </div>
    </section>    
@endsection
