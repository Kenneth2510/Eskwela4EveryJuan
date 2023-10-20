@include('partials.header')
@include('partials.sidebar')

<section id="AD002_IA_container" class="relative w-4/5 h-full left-80">

    <div id="AD002_IA_title" class="relative flex items-center justify-between h-16 px-3 mx-auto my-3 py-auto">
        <h1 class="text-4xl font-semibold">Add New Instructor</ h1>
        <div id="adminuser" class="flex items-center">
            <h3 class="text-lg">{{ $adminCodeName }}</h3>
            <div id="icon" class="w-10 h-10 mx-3 rounded-full bg-slate-400"></div>
        </div>
    </div>

    <div id="AD002_IA_maincontainer" class="relative max-h-full px-5 py-5 shadow-2xl bg-white mt-7 rounded-2xl">
        <div class="mb-5">
            <a href="/admin/course" class="">
                <i class="text-2xl md:text-3xl fa-solid fa-arrow-left" style="color: #000000;"></i>
            </a>
        </div>

        <form id="addCourse" action="" method="POST">
            @csrf
        <div id="AD002_IA_content" class="smallpc:flex smallpc:items-start">
            <div id="AD002_IA_personal_details_container" class="mx-auto my-5 smallpc:w-6/12">
                <h3 class="mb-5 text-3xl font-medium border-b-2 md:text-4xl border-b-black">Course Details</h3>
                <div id="namefield" class="flex mt-5">
                    <h4 class="w-32 ml-3 text-lg font-medium md:w-40 md:text-2xl">Course Name</h4>
                    <div id="AD002_IA_course" class="block">
                        <div class="mb-3">
                            <label for="course_name" class="hidden text-md font-regular md:text-lg">Course Name</label>
                            <input type="text" id="courseName" name="course_name" class="px-3 py-2 text-lg border-2 border-black rounded-md md:text-xl w-15" placeholder="Course Name" value="{{ old('course_name') }}">
                            @error('course_name')
                            <p class="p-1 mt-2 text-xs text-red-500">
                                {{$message}}
                            </p>
                            @enderror
                        </div>
                  
                        
                    </div>
                </div>
    
                <div id="AD002_IA_course_difficulty" class="">
                    <div id="gender" class="flex mt-5">
                        <h4 class="w-32 ml-3 text-lg font-medium md:w-40 md:text-2xl">Gender</h4>
                        <div class="">
                            <label for="courseDifficulty" class="hidden">Course Difficulty</label>
                            <select name="course_difficulty" id="courseDifficulty" class="px-3 py-2 text-lg border-2 border-black rounded-md md:text-xl w-15">
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
    
                <div id="AD002_IA_course_description" class="flex mt-5">
                    <h4 class="w-32 ml-3 text-lg font-medium md:w-40 md:text-2xl">Course Description</h4>
                    <div class="">
                        <label for="courseDescription" class="hidden">Course Description</label>
                        <textarea name="course_description" id="courseDescription" class="border-2 border-black rounded-md w-96 max-w-96 min-w-96 h-44 min-h-44 max-h-44"></textarea>
                        @error('course_description')
                            <p class="p-1 mt-2 text-xs text-red-500">
                                {{$message}}
                            </p>
                            @enderror
                    </div>
                </div>
    
    
    
            </div>
    
            <div id="AD002_IA_instructor_field" class="mx-auto my-5 mt-16 smallpc:w-6/12 smallpc:mt-5">
                <h3 class="mb-5 text-3xl font-medium border-b-2 border-b-black md:text-4xl">Instructor</h3>
                <div id="AD002_IA_instructor_container" class="mt-5">
                    <div id="AD002_IA_instructor" class="flex">
                        <h4 class="w-40 ml-3 text-lg font-medium leading-5 md:w-60 md:text-2xl">Instructor</h4>
                        <div class="ml-4">
                            <label for="instructor_id" class="hidden"></label>
                            <select name="instructor_id" id="instructor_id" class="px-3 py-2 text-lg border-2 border-black rounded-md md:text-xl w-15">
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
                <a href="/admin/instructors" class="px-5 py-5 text-xl font-medium text-white bg-red-600 md:text-2xl hover:bg-red-900 rounded-xl">cancel</a>
                <button type="submit" class="px-5 py-5 text-xl font-medium text-white bg-green-600 md:text-2xl hover:bg-green-900 rounded-xl">Add New</button>
            </div>
        </form>
    </div>
    
    
</section>

@include('partials.footer')

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