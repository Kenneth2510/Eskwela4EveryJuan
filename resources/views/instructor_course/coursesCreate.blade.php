@include('partials.header');

<section class="relative w-full h-auto text-sm bg-mainwhitebg">
    <header class="fixed top-0 left-0 z-40 flex flex-row items-center w-full px-4 py-4 bg-seagreen">
            <a href="#">
                <span class="self-center text-lg font-semibold font-semibbold whitespace-nowrap md:text-2xl text-mainwhitebg">
                    Eskwela4EveryJuan
                </span>
            </a>
        </header>
    
    {{-- MAIN CONTENT --}}
    <div class="px-2 mt-12">
        <div class="flex flex-row items-center mb-4">
            <button class="p-1 mr-2 bg-gray-300 rounded-full" id="backCreateCourse">
                <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="m313-440 224 224-57 56-320-320 320-320 57 56-224 224h487v80H313Z"/></svg>
            </button>
            <h1 class="text-xl font-semibold">Create New Course</h1>
        </div>

        <form action="" class="px-2">
            @csrf
            {{-- FIRST HALF --}}
            <div id="firstCreateCourse">
                <div class="flex flex-col my-2">
                    <label for="">Course Name</label>
                    <input class="IN-V-INP" type="text">
                </div>
                <div class="flex flex-col my-2">
                    <label for="">Description</label>
                    <textarea class="h-24 resize-none" name="" id=""></textarea>
                </div>
                <div class="flex flex-col my-2">
                    <label for="">Course Difficulty</label>
                    <select class="IN-V-INP" name="" id="" >
                        <option value="" disabled selected>--select an option--</option>
                        <option value="">Beginner</option>
                        <option value="">Intermediate</option>
                        <option value="">Professional</option>
                    </select>
                </div>
                <div class="flex flex-col my-2">
                    <label for="">Upload Files</label>
                    <input class="w-full border border-gray-200 rounded-lg file:bg-darthmouthgreen file:text-white bg-ashgray" type="file" name="" id="fileInput" multiple>
                    <ul class="px-2 py-2" id="uploadedFileName">
                    </ul>
                </div>
                <div class="w-full mt-8 text-right">
                    <button class="w-24 h-8 bg-amber-400 hover:bg-amber-600" id="nextAddCourse">
                        Next
                    </button>
                </div>
                
            </div>
            

            {{-- SECOND HALF --}}
            <div class="hidden" id="secondCreateCourse">
                <h1 class="my-8 text-lg font-semibold">Initial set up of Syllabus</h1>
                
                <table class="w-full text-sm text-left">
                    <thead class="h-8 text-center uppercase bg-seagreen text-mainwhitebg">
                        <th class="pl-2 rounded-l">Lesson</th>
                        <th class="rounded-r">Topic</th>
                    </thead>
                    <tbody class="">
                        <tr>
                            <td class="text-center">01</td>
                            <td>Introduction to Business Admin</td>
                        </tr>
                        <tr>
                            <td class="text-center">02</td>
                            <td>Business Ethics and Social Resp.</td>
                        </tr>
                        <tr>
                            <td class="text-center">03</td>
                            <td>Management Principles</td>
                        </tr>
                        <tr>
                            <td class="text-center">04</td>
                            <td>Organizational Structure</td>
                        </tr>
                    </tbody>
                </table>
                <div class="w-full text-right">
                    <button class="h-10 px-2 mx-2 my-10 font-medium rounded cursor-pointer bg-amber-400 hover:bg-amber-500">
                        Add New Course
                    </button>
                </div>
                
            </div>
        </form>
    </div>
</section>

@include('partials.footer');