@extends('layouts.admin_layout')

@section('content')
    <section id="view_learner_container" class="relative w-full h-screen px-4 overflow-auto pt-28 md:w-3/4 lg:w-10/12 md:pt-16">

        <div id="title" class="relative flex items-center justify-between px-3 mx-auto my-3 text-black">
            <h1 class="py-4 text-2xl font-semibold">View Learner Details</h1>
            <div id="adminuser" class="items-center hidden lg:flex">
                <h3 class="text-lg">{{ $adminCodeName }}</h3>
                <div id="icon" class="w-10 h-10 mx-3 rounded-full bg-slate-400"></div>
            </div>
        </div>

        <div id="maincontainer" class="relative w-full px-2 text-black shadow-lg rounded-2xl">
            <div class="mb-5">
                <a href="/admin/learners" class="">
                    <i class="text-xl fa-solid fa-arrow-left" style="color: #000000;"></i>
                </a>
            </div>
            
            <div id="icon" class="w-32 h-32 mx-auto my-3 bg-gray-400 rounded-full">
                <img class="w-32 h-32 mx-auto my-3 bg-gray-400 rounded-full" src="{{ asset('storage/' . $course->profile_picture) }}
                                    " alt="Profile Picture">
            </div>
            
            <h3 class="mx-3 text-lg font-semibold text-center">Course Name: {{ $course->course_name }}</h3>
            <div id="course_status" class="flex items-center justify-center ">
                
                <h3 class="mx-3 text-lg font-semibold">Course Status: </h3>
                @if ($course->course_status == 'Approved')
                    <div id="status" class="mx-1 text-lg text-center bg-green-500 py-auto w-28 rounded-xl">Approved</div>
                    <div id="button" class="flex flex-col hidden mx-4">
                        <form action="/admin/pending_course/{{ $course->course_status }}" method="POST">
                            @method('put')
                            @csrf
                            <button class="my-1 text-lg text-center bg-yellow-300 py-auto w-28 rounded-xl hover:bg-yellow-500 hover:text-white">pending</button>
                        </form>
                        <form action="/admin/reject_course/{{ $course->course_status }}" method="POST">
                            @method('PUT')
                            @csrf
                            <button class="my-1 text-lg text-center bg-red-500 py-auto w-28 rounded-xl hover:bg-red-700 hover:text-white">reject</button>
                        </form>
                    </div> 
                @elseif ($course->course_status == 'Rejected')
                    <div id="status" class="mx-1 text-lg text-center bg-red-500 py-auto w-28 rounded-xl">Rejected</div>
                    <div id="button" class="flex flex-col hidden mx-4">
                        <form action="/admin/pending_course/{{ $course->course_id }}" method="POST">
                            @method('put')
                            @csrf
                            <button class="my-1 text-lg text-center bg-yellow-300 py-auto w-28 rounded-xl hover:bg-yellow-500 hover:text-white">pending</button>
                        </form>
                        <form action="/admin/approve_course/{{ $course->course_id }}" method="POST">
                            @method('put')
                            @csrf
                            <button type="submit" class="my-1 text-lg text-center bg-green-500 py-auto w-28 rounded-xl hover:bg-green-700 hover:text-white">approve</button>
                        </form>
                    </div> 
                @else 
                    <div id="status" class="mx-1 text-lg text-center bg-yellow-300 py-auto w-28 rounded-xl">pending</div>
                    <div id="button" class="flex flex-col hidden mx-4">
                        <form action="/admin/approve_course/{{ $course->course_id }}" method="POST">
                            @method('put')
                            @csrf
                            <button type="submit" class="my-1 text-lg text-center bg-green-500 py-auto w-28 rounded-xl hover:bg-green-700 hover:text-white">approve</button>
                        </form>
                        
                        <form action="/admin/reject_course/{{ $course->course_status }}" method="POST">
                            @method('PUT')
                            @csrf
                            <button class="my-1 text-lg text-center bg-red-500 py-auto w-28 rounded-xl hover:bg-red-700 hover:text-white">reject</button>
                        </form>
                        
                    </div> 
                @endif
                
            </div>

            <form action="" id="course_updateData_form" data-course-id="{{ $course->course_id }}">
                @csrf
            <div class="flex flex-col w-full text-base lg:flex-row lg:flex-wrap lg:flex-grow">
                <div id="courseDetailsFields" class="my-5 lg:w-1/2">
                    <h3 class="mb-5 text-xl font-medium border-b-2 border-b-black">Course Details</h3>
                    <div id="courseIdField" class="flex justify-between w-full mt-5">
                        <h4 class="w-2/5 ml-3 font-medium">Course ID</h4>
                        <div class="w-3/5">
                            <label for="course_id" class="hidden">Course ID</label>
                            <input id="course_id" type="text" name="course_id" class="w-full p-2 border-2 rounded-md" placeholder="Course ID" disabled value="{{ $course->course_id }}">
                        </div>
                    </div>

                    <div id="courseCodeField" class="flex justify-between w-full mt-5">
                        <h4 class="w-2/5 ml-3 font-medium">Course Code</h4>
                        <div class="w-3/5">
                            <label for="course_code" class="hidden">Course Code</label>
                            <input id="course_code" type="text" name="course_code" class="w-full p-2 border-2 rounded-md" placeholder="Course Code" disabled value="{{ $course->course_code }}">
                        </div>
                    </div>

                    <div id="coursedetails_container" class="mt-5">
                        <div id="course_name_field" class="flex">
                            <h4 class="w-2/5 ml-3 font-medium">Course Name</h4>
                            <div class="w-3/5">
                                <label for="course_name" class="hidden">Course Name</label>
                                <input id="course_name" type="text" name="course_name" class="w-full p-2 border-2 rounded-md" placeholder="Course Name" disabled value="{{ $course->course_name }}">
                            </div>
                        </div>
        
                        <div id="courseDifficulty" class="flex justify-between w-full mt-5">
                            <h4 class="w-2/5 ml-3 font-medium">Course Difficulty</h4>
                            <div class="w-3/5">
                                <label for="course_difficulty" class="hidden">Course Difficulty</label>
                                <select name="course_difficulty" id="course_difficulty" class="w-full p-2 border-2 rounded-md" disabled>
                                    <option value="" {{ $course->course_difficulty == "" ? 'selected': '' }} class=""></option>
                                    <option value="Beginner" {{ $course->course_difficulty == "Beginner" ? 'selected': '' }} class="">Beginner</option>
                                    <option value="Intermediate" {{ $course->course_difficulty == "Intermediate" ? 'selected': '' }} class="">Intermediate</option>
                                    <option value="Advanced" {{ $course->course_difficulty == "Advanced" ? 'selected': '' }} class="">Advanced</option>
                                </select>
                                @error('course_difficulty')
                                <p class="p-1 mt-2 text-xs text-red-500">
                                    {{$message}}
                                </p>
                                @enderror
                            </div>
                        </div>

                        <div id="courseIdField" class="flex justify-between w-full mt-5">
                            <h4 class="w-2/5 ml-3 font-medium">Course Description</h4>
                            <div class="w-3/5">
                                <label for="courseDescription" class="hidden">Course Description</label>
                            <textarea name="course_description" id="course_description" class="rounded-md w-96 max-w-96 min-w-96 h-44 min-h-44 max-h-44" disabled>{{ $course->course_description }}</textarea>
                            @error('course_description')
                                <p class="p-1 mt-2 text-xs text-red-500">
                                    {{$message}}
                                </p>
                                @enderror
                            </div>
                        </div>

                    
                        
                    </div>
                </div>

                <div id="AD002_IA_instructor_field" class="my-5 lg:w-1/2">
                    <h3 class="mb-5 text-xl font-medium border-b-2 border-b-black">Instructor</h3>
                    <div id="AD002_IA_instructor_container" class="mt-5">
                        <div id="AD002_IA_instructor" class="flex">
                            <h4 class="w-2/5 ml-3 font-medium">Instructor</h4>
                            <div class="w-3/5">
                                <label for="instructor_id" class="hidden"></label>
                                <select name="instructor_id" id="instructor_id" class="w-full p-2 border-2 rounded-md" disabled>
                                    <option value="" >Select an option</option>
                                    @foreach ($instructors as $instructor)
                                    <option value="{{$instructor->id}}" {{ $instructor->id == $course->instructor_id ? 'selected' : ''}}>{{$instructor->name}}</option>
                                    @endforeach
                                </select>
                                @error('instructor')
                                <p class="p-1 mt-2 text-xs text-red-500">
                                    {{$message}}
                                </p>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                <div class="">
                    <h1>Created at: {{ $course->created_at }}</h1>
                    <h1>Last Modified at: {{ $course->updated_at }}</h1>
                </div>

                <div class="mt-5 text-center">
                    <a href="/admin/manage_course/course_overview/{{$course->course_id}}" class="p-4 text-white bg-green-600 rounded-xl hover:bg-green-900">
                        Manage Course
                    </a>
                </div>                
            
        
                <div id="button_container" class="flex justify-center pt-5 mx-auto mt-16 text-center border-2 border-t-black">
                    <a href="{{ url('/admin/courses') }}" id="return"class="px-5 py-5 mx-3 text-xl font-medium text-white bg-red-600 md:text-2xl hover:bg-red-900 rounded-xl">Return</a>
                    <button type="button" id="cancel" class="hidden px-5 py-5 mx-3 text-xl font-medium text-white bg-red-600 md:text-2xl hover:bg-red-900 rounded-xl">cancel</button>

                    <button type="button" id="edit_data" type="button" class="px-5 py-5 mx-3 text-xl font-medium text-white bg-green-600 md:text-2xl hover:bg-green-900 rounded-xl">Edit Data</button>
                    
                    <button id="update_data" type="button" class="hidden px-5 py-5 mx-3 text-xl font-medium text-white bg-green-600 md:text-2xl hover:bg-green-900 rounded-xl">Apply Changes</button>

                    <div id="updateCourseModal" class="fixed top-0 left-0 flex items-center justify-center hidden w-screen h-screen bg-black bg-opacity-50">
                        <div class="p-5 text-center bg-white rounded-lg">
                            <p>Are you sure you want to update this course?</p>
                            <button type="submit" id="confirmUpdate" class="px-4 py-2 m-2 text-white bg-green-600 rounded-md">Confirm</button>
                            <button type="button" id="cancelUpdate" class="px-4 py-2 m-2 text-gray-700 bg-gray-400 rounded-md">Cancel</button>
                        </div>
                    </div>
                </form>

                    <button id="delete_data" type="button" class="hidden px-5 py-5 mx-3 text-xl font-medium text-white bg-red-600 md:text-2xl hover:bg-red-900 rounded-xl">Delete Data</button>

                    <div id="deleteCourseModal" class="fixed top-0 left-0 flex items-center justify-center hidden w-screen h-screen bg-black bg-opacity-50">
                        <form id="admin_deleteCourse" action="" data-course-id="{{ $course->course_id }}">
                            @csrf
                            <div class="p-5 text-center bg-white rounded-lg">
                                <p>Are you sure you want to delete this course?</p>
                                <button type="submit" id="admin_confirmDelete" class="px-4 py-2 m-2 text-white bg-red-600 rounded-md">Confirm</button>
                                <button type="button" id="admin_cancelDelete" class="px-4 py-2 m-2 text-gray-700 bg-gray-400 rounded-md">Cancel</button>
                            </div>
                        </form>
                        
                    </div>
                </div>
            </div>
                    
                    
        </div>

    </section>    
@endsection
