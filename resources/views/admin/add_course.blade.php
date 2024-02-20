@extends('layouts.admin_layout')

@section('content')
    <section id="AD002_IA_container" class="relative w-full h-screen px-4 overflow-auto pt-28 md:w-3/4 lg:w-10/12 md:pt-16">

        <div id="AD002_IA_title" class="relative flex items-center justify-between px-3 mx-auto my-3 text-black">
            <h1 class="py-4 text-2xl font-semibold">Add New Instructor</h1>
            <div id="adminuser" class="items-center hidden lg:flex">
                <h3 class="text-lg">{{ $adminCodeName }}</h3>
                <div id="icon" class="w-10 h-10 mx-3 rounded-full bg-slate-400"></div>
            </div>
        </div>
        <div id="AD002_IA_maincontainer" class="relative w-full px-2 text-black shadow-lg rounded-2xl">
            <div class="mb-5">
                <a href="/admin/instructors" class="">
                    <i class="text-xl fa-solid fa-arrow-left" style="color: #000000;"></i>
                </a>
            </div>

            <form id="addCourse" action="" method="POST">
                @csrf
            <div id="AD002_IA_content" class="flex flex-col text-base tw-full lg:flex-row lg:flex-wrap lg:flex-grow">
                <div id="AD002_IA_personal_details_container" class="my-5 lg:w-1/2">
                    <h3 class="mb-5 text-xl font-medium border-b-2 border-b-black">Course Details</h3>
                    <div id="namefield" class="flex justify-between w-full mt-5">
                        <h4 class="w-2/5 ml-3 font-medium">Course Name</h4>
                        <div id="AD002_IA_course" class="w-3/5">
                            <div class="mb-3">
                                <label for="course_name" class="hidden font-regular ">Course Name</label>
                                <input type="text" id="courseName" name="course_name" class="w-full p-2 border-2 border-black rounded-md w-15" placeholder="Course Name" value="{{ old('course_name') }}">
                                @error('course_name')
                                <p class="p-1 mt-2 text-xs text-red-500">
                                    {{$message}}
                                </p>
                                @enderror
                            </div>
                        </div>
                    </div>
        
                    <div id="AD002_IA_course_difficulty" class="">
                        <div id="gender" class="flex justify-between w-full mt-5">
                            <h4 class="w-2/5 ml-3 font-medium">Gender</h4>
                            <div class="w-3/5">
                                <label for="courseDifficulty" class="hidden">Course Difficulty</label>
                                <select name="course_difficulty" id="courseDifficulty" class="w-full p-2 border-2 border-black rounded-md">
                                    <option value="" {{old('courseDifficulty') == "" ? 'selected' : ''}} class="">--select difficulty--</option>
                                    <option value="Beginner" {{old('courseDifficulty') == "Beginner" ? 'selected' : ''}} class="">Beginner</option>
                                    <option value="Intermediate" {{old('courseDifficulty') == "Intermediate" ? 'selected' : ''}} class="">Intermediate</option>
                                    <option value="Advanced" {{old('courseDifficulty') == "Advanced" ? 'selected' : ''}} class="">Advanced</option>
                                </select>
                                @error('course_difficulty')
                                <p class="p-1 mt-2 text-xs text-red-500">
                                    {{$message}}
                                </p>
                                @enderror
                            </div>
                        </div>
                    </div>
        
                    <div id="AD002_IA_course_description" class="flex justify-between w-full mt-5">
                        <h4 class="w-2/5 ml-3 font-medium">Course Description</h4>
                        <div class="w-3/5">
                            <label for="courseDescription" class="hidden">Course Description</label>
                            <textarea name="course_description" id="courseDescription" class="w-full border-2 border-black rounded-md resize-none h-44 min-h-44 max-h-44"></textarea>
                            @error('course_description')
                                <p class="p-1 mt-2 text-xs text-red-500">
                                    {{$message}}
                                </p>
                                @enderror
                        </div>
                    </div>      
                </div>

                <div id="AD002_IA_instructor_field" class="my-5 lg:w-1/2">
                        <h3 class="mb-5 text-xl font-medium border-b-2 border-b-black">Instructor</h3>
                        <div id="AD002_IA_instructor_container" class="mt-5">
                            <div id="AD002_IA_instructor" class="flex justify-between w-full mt-5">
                                <h4 class="w-2/5 ml-3 font-medium">Instructor</h4>
                                <div class="w-3/5">
                                    <label for="instructor_id" class="hidden"></label>
                                    <select name="instructor_id" id="instructor_id" class="w-full p-2 border-2 border-black rounded-md">
                                        <option value="">Select an option</option>
                                        @foreach ($instructors as $instructor)
                                        <option value={{$instructor->id}}>{{$instructor->name}}</option>
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
            
        
                <div id="button_container" class="pt-5 mx-auto mt-16 text-center border-2 border-t-black">
                    <a href="/admin/instructors" class="px-5 py-5 text-xl font-medium text-white bg-red-600 md:text-2xl hover:bg-red-900 rounded-xl">Cancel</a>
                    <button type="submit" class="px-5 py-5 text-xl font-medium text-white bg-green-600 md:text-2xl hover:bg-green-900 rounded-xl">Add New</button>
                </div>
            </form>
        </div>
    </section>

    <script>
        $(document).ready(function() {

            var formSubmitted = false;

            $('#addCourse').submit(function(e) {
                e.preventDefault();

                const courseName = $('#courseName').val();
                const courseDifficulty = $('#courseDifficulty').val();
                const courseDescription = $('#courseDescription').val();
                const instructor = $('#instructor_id').val();

                if(courseName === '' || courseDifficulty === '' || courseDifficulty === null || courseDescription === '' || instructor === '' || instructor === null){
                    alert('Please enter values in the fields')

                    if(courseName === '') {
                        var errorMsg = `
                        <span class="text-red-600">*Please enter a Course Name*</span>
                        `;

                        $('#courseName').after(errorMsg);
                    }
                    if (courseDescription === '') {
                        var errorMsg = `
                        <span class="text-red-600">*Please enter a Course Description*</span>
                        `;

                        $('#courseDescription').before(errorMsg);
                    }
                    if (courseDifficulty === null || courseDifficulty === '') {
                        var errorMsg = `
                        <span class="text-red-600">*Please select a Course Difficulty*</span>
                        `;

                        $('#courseDifficulty').after(errorMsg);
                    } 

                    if (instructor === null || instructor === '') {
                        var errorMsg = `
                        <span class="text-red-600">*Please select a Course Difficulty*</span>
                        `;

                        $('#instructor_id').after(errorMsg);
                    } 
                } else {
                    var formData = new FormData(this);

                $.ajax({
                    type: 'POST',
                    url: '/admin/add_course',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        if(response && response.redirect_url) {
                            window.location.href= response.redirect_url
                        } else {
                            
                        }
                    }
                });
                }
                formSubmitted = true;
                $('#addCourse')[0].reset();
            })

        })
    </script>    
@endsection
