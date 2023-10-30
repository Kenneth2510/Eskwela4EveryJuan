@include('partials.header')

<section class="flex flex-row w-full h-screen bg-mainwhitebg">
    @include('partials.instructorNav')
    @include('partials.instructorSidebar')
    {{-- MAIN CONTENT --}}
    <section class="w-full px-2 pt-28 md:overflow-auto md:w-3/4 lg:w-9/12 md:pt-20">
        <div class="flex flex-row items-center mb-4">
            <button class="p-1 mr-2 bg-gray-300 rounded-full" id="backCreateCourse">
                <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="m313-440 224 224-57 56-320-320 320-320 57 56-224 224h487v80H313Z"/></svg>
            </button>
            <h1 class="text-xl font-semibold">Create New Course</h1>
        </div>

        <form action="" id="addCourse" name="addCourse" class="px-2">
            @csrf
            {{-- FIRST HALF --}}
            <div id="firstCreateCourse">
                <div class="flex flex-col my-2">
                    <label for="course_name">Course Name</label>
                    <input class="IN-V-INP" id="course_name" name="course_name" type="text">
                </div>
                <div class="flex flex-col my-2">
                    <label for="course_description">Description</label>
                    <textarea class="h-24 resize-none" name="course_description" id="course_description"></textarea>
                </div>
                <div class="flex flex-col my-2">
                    <label for="course_difficulty">Course Difficulty</label>
                    <select class="IN-V-INP" name="course_difficulty" id="course_difficulty" >
                        <option value="" selected>--select an option--</option>
                        <option value="Beginner">Beginner</option>
                        <option value="Intermediate">Intermediate</option>
                        <option value="Advanced">Advanced</option>
                    </select>
                </div>
                {{-- <div class="flex flex-col my-2">
                    <label for="">Upload Files</label>
                    <input class="w-full border border-gray-200 rounded-lg file:bg-darthmouthgreen file:text-white bg-ashgray" type="file" name="" id="fileInput" multiple>
                    <ul class="px-2 py-2" id="uploadedFileName">
                    </ul>
                </div> --}}
                <div class="w-full mt-8 text-right">
                    <button type="button" class="w-24 h-8 bg-amber-400 hover:bg-amber-600" id="nextAddCourse">
                        Next
                    </button>
                </div>
                
            </div>
            

            {{-- SECOND HALF --}}
            <div class="hidden" id="secondCreateCourse">
                <h1 class="my-8 text-lg font-semibold">Initial set up of Syllabus</h1>
                
                
                <div id="lessonContainer">
                    <table class="w-full text-sm text-left">
                        <thead class="h-8 text-center uppercase bg-seagreen text-mainwhitebg">
                            <th class="pl-2 rounded-l">Lesson</th>
                            <th class="rounded-r">Topic</th>
                        </thead>
                        <tbody id="lesson_body" class="">

                                {{-- <tr class="border-b-2 border-black">
                                    <td class="text-center">1</td>
                                    <td class="flex items-center justify-between">
                                        <input type="text" disabled value="Lesson 1">
                                        <div class="">
                                            <button class="h-10 px-2 mx-2 my-10 font-medium rounded cursor-pointer bg-amber-400" id="edit-lesson">Edit</button>
                                            <button class="h-10 px-2 mx-2 my-10 font-medium rounded cursor-pointer bg-amber-400" id="delete-lesson">Delete</button>
                                        </div>
                                    </td>
                                </tr> --}}

                        </tbody>
                    </table>
                </div>
                <div class="flex items-center justify-around">
                    <button type="button" class="h-10 px-2 mx-2 my-10 font-medium rounded cursor-pointer bg-amber-400" id="addLesson_start">
                        Add New
                    </button>

                    <div id="addLesson_form" class="hidden">
                        <label for="lesson_name">Name:</label><br>
                        <input type="text" id="lesson_name" name="lesson_name">
                    </div>
                    <div id="addLesson_type" class="hidden">
                        <label for="lesson_type">Type:</label>
                        <select name="lesson_type" id="">
                            <option value="" disabled>--select type--</option>
                            <option value="">Lesson</option>
                            <option value="">Quiz</option>
                            <option value="">Assignment</option>
                        </select>
                    </div>
                    <div id="addLesson_button" class="hidden">
                        <button type="button" class="h-10 px-2 mx-2 my-10 font-medium rounded cursor-pointer bg-amber-400" id="addLesson_now">
                            Add Lesson Now
                        </button>
                        <button type="button" class="h-10 px-2 mx-2 my-10 font-medium rounded cursor-pointer bg-amber-400" id="addLesson_cancel">
                            Cancel
                        </button>
                    </div>
                </div>          
                
                <div class="w-full text-right">
                    <button type="button" class="h-10 px-2 mx-2 my-10 font-medium bg-red-600 rounded cursor-pointer" id="returnTo_first">
                        Return
                    </button>
                    <button type="submit" class="h-10 px-2 mx-2 my-10 font-medium rounded cursor-pointer bg-amber-400 hover:bg-amber-500">
                        Add New Course
                    </button>
                </div>
                
            </div>
        </form>
    </section>

                {{-- <div class="fixed z-50 flex items-center hidden w-full h-screen bg-white bg-opacity-50 rounded shadow-lg hiddenn backdrop-blur-sm" aria-hidden="true" id="selectTypeParent">
                    <div class="relative w-full h-auto pt-8 m-auto mx-4 rounded shadow-lg bg-seagreen" id="selectTypeChild">
                        <div class="flex flex-col items-center">
                            <label class="my-2 text-white" for="">Select one</label>
                            <select class="max-w-xs select select-bordered IN-V-INP" name="" id="">
                                <option value="" disabled selected>--Select here--</option>
                                <option value="">Lesson</option>
                                <option value="">Quiz</option>
                                <option value="">Assignment</option>
                            </select>
                        </div>
                        
                        <div class="flex flex-row items-center justify-center m-4">
                            <button class="px-4 py-2 mx-1 bg-gray-300 rounded-lg shadow-lg " id="selectTypeCloseBtn">
                                <h1>Close</h1>
                            </button>
                            <button class="px-4 py-2 mx-1 text-white rounded-lg shadow-lg bg-darthmouthgreen" id="selectTypeConfirmBtn">
                                <h1>Confirm</h1>
                            </button>
                        </div>
                        
                    </div>
                </div>       --}}
    
    @include('partials.instructorProfile')
</section>

@include('partials.footer')


