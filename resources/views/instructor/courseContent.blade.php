@include('partials.header')
<section class="flex flex-row w-full h-screen text-sm bg-mainwhitebg md:text-base">
    @include('partials.instructorNav')
    @include('partials.instructorSidebar')
    
    {{-- MAIN --}}
    <section class="w-full  pt-[125px] mx-2  overscroll-auto md:overflow-auto">
        <div class="shadow-lg pb-4rounded-lg">
            {{-- header --}}
            <div class="relative px-2 rounded-t-lg bg-seagreen text-mainwhitebg">
                <button class="my-2 bg-gray-400 rounded-full ">
                    <svg  xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="M560-240 320-480l240-240 56 56-184 184 184 184-56 56Z"/></svg>
                </button>
                <h1 class="w-1/2 text-xl font-semibold">Introduction to Business Administration</h1>
                <p>Instructor 1</p>
                <p class="opacity-50">000000</p> 
            </div>

            {{-- main content --}}
            <div class="px-2">
                {{-- overview --}}
                <div class="mb-8">
                    <div class="flex items-center justify-between my-4 border-b-2 border-seagreen">
                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="m787-145 28-28-75-75v-112h-40v128l87 87Zm-587 25q-33 0-56.5-23.5T120-200v-560q0-33 23.5-56.5T200-840h560q33 0 56.5 23.5T840-760v268q-19-9-39-15.5t-41-9.5v-243H200v560h242q3 22 9.5 42t15.5 38H200Zm0-120v40-560 243-3 280Zm80-40h163q3-21 9.5-41t14.5-39H280v80Zm0-160h244q32-30 71.5-50t84.5-27v-3H280v80Zm0-160h400v-80H280v80ZM720-40q-83 0-141.5-58.5T520-240q0-83 58.5-141.5T720-440q83 0 141.5 58.5T920-240q0 83-58.5 141.5T720-40Z"/></svg>
                        
                            <h1 class="text-base font-medium">General Overview</h1>
                        </div>
                        
                        <svg class="cursor-pointer" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="M80 0v-160h800V0H80Zm80-240v-150l362-362 150 150-362 362H160Zm80-80h36l284-282-38-38-282 284v36Zm477-326L567-796l72-72q11-12 28-11.5t28 11.5l94 94q11 11 11 27.5T789-718l-72 72ZM240-320Z"/></svg>
                    </div>
                    <p class="px-4 text-justify">Lorem ipsum dolor sit amet consectetur. Sapien quis integer non dapibus egestas egestas tincidunt. Vitae facilisi est sed imperdiet sed pellentesque. Iaculis tincidunt amet elementum non ipsum leo. Sem bibendum montes eget at mattis a libero ultrices mattis.</p>
                </div>
                
                {{-- views --}}
                <div class="flex flex-col text-mainwhitebg fill-mainwhitebg">
                    <button class="flex items-center justify-between px-2 py-4 my-2 rounded-lg shadow-lg bg-seagreen">
                        <div class="flex items-center">
                            <svg class="mr-2" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.615 20H7a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v8m-3 5l2 2l4-4M9 8h4m-4 4h2"/></svg>
                            <h1>Syllabus</h1>
                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="M647-440H160v-80h487L423-744l57-56 320 320-320 320-57-56 224-224Z"/></svg>
                    </button>
                    <button class="flex items-center justify-between px-2 py-4 my-2 rounded-lg shadow-lg bg-seagreen">
                        <div class="flex items-center">
                            <svg class="mr-2" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.615 20H7a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v8m-3 5l2 2l4-4M9 8h4m-4 4h2"/></svg>
                            <h1>Lessons</h1>
                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="M647-440H160v-80h487L423-744l57-56 320 320-320 320-57-56 224-224Z"/></svg>
                    </button>
                    <button class="flex items-center justify-between px-2 py-4 my-2 rounded-lg shadow-lg bg-seagreen">
                        <div class="flex items-center">
                            <svg class="mr-2" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.615 20H7a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v8m-3 5l2 2l4-4M9 8h4m-4 4h2"/></svg>
                            <h1>Quizzes</h1>
                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="M647-440H160v-80h487L423-744l57-56 320 320-320 320-57-56 224-224Z"/></svg>
                    </button>
                    <button class="flex items-center justify-between px-2 py-4 my-2 rounded-lg shadow-lg bg-seagreen">
                        <div class="flex items-center">
                            <svg class="mr-2" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.615 20H7a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v8m-3 5l2 2l4-4M9 8h4m-4 4h2"/></svg>
                            <h1>Assignments</h1>
                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="M647-440H160v-80h487L423-744l57-56 320 320-320 320-57-56 224-224Z"/></svg>
                    </button>
                    
                    <button class="self-center w-1/2 py-4 rounded-lg shadow-lg bg-seagreen">
                        <h1>Add Content</h1>
                    </button>
                </div>
            </div>
        </div>
    </section>
</section>
@include('partials.footer')