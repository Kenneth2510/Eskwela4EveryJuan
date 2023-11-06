@include('partials.header')

<section class="main-container">
    @include('partials.instructorNav')
    @include('partials.instructorSidebar')

    {{-- MAIN --}}
    <section class="w-full px-2 pt-[120px] mx-2 mt-2 md:w-3/4 lg:w-9/12  overscroll-auto md:overflow-auto">
        <div class="p-3 pb-4 overflow-auto rounded-lg shadow-lg b overscroll-auto">
            <div class="p-2 text-white bg-purple-500 fill-white rounded-xl">
                <a href="">
                    <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="M560-240 320-480l240-240 56 56-184 184 184 184-56 56Z"/></svg>
                </a>
                <h1 class="py-4 text-4xl font-semibold ">Business</h1>
                <div class="flex flex-row my-2">
                    <svg class="mr-2" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="M240-80q-33 0-56.5-23.5T160-160v-640q0-33 23.5-56.5T240-880h480q33 0 56.5 23.5T800-800v640q0 33-23.5 56.5T720-80H240Zm0-80h480v-640h-80v280l-100-60-100 60v-280H240v640Zm0 0v-640 640Zm200-360 100-60 100 60-100-60-100 60Z"/></svg>
                    <p>CVSEDI</p>
                </div>
                <div class="flex flex-row my-2">
                    <svg class="mr-2" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="M480-120 200-272v-240L40-600l440-240 440 240v320h-80v-276l-80 44v240L480-120Zm0-332 274-148-274-148-274 148 274 148Zm0 241 200-108v-151L480-360 280-470v151l200 108Zm0-241Zm0 90Zm0 0Z"/></svg>
                    <p>Beginner</p>
                </div>
                <div class="flex flex-row my-2">
                    <p>Status: Pending</p>
                </div>
                <div class="flex">
                    <div class="flex flex-row my-2">
                        <svg width="30" height="26" viewBox="0 0 30 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M1.875 4.30249C3.53437 3.60874 5.91375 2.86061 8.2275 2.62811C10.7213 2.37686 12.8363 2.74624 14.0625 4.03812V22.3119C12.3094 21.3181 10.0875 21.1812 8.03813 21.3875C5.82563 21.6125 3.59437 22.2519 1.875 22.9081V4.30249ZM15.9375 4.03812C17.1637 2.74624 19.2788 2.37686 21.7725 2.62811C24.0863 2.86061 26.4656 3.60874 28.125 4.30249V22.9081C26.4037 22.2519 24.1744 21.6106 21.9619 21.3894C19.9106 21.1812 17.6906 21.3162 15.9375 22.3119V4.03812ZM15 2.34311C13.1531 0.75499 10.4756 0.51874 8.03813 0.76249C5.19938 1.04937 2.33438 2.02249 0.549375 2.83437C0.385592 2.90885 0.246704 3.0289 0.149289 3.18018C0.051875 3.33145 4.98214e-05 3.50756 0 3.68749L0 24.3125C4.34287e-05 24.4693 0.0394446 24.6237 0.114595 24.7614C0.189744 24.8991 0.298241 25.0157 0.430145 25.1006C0.56205 25.1855 0.713146 25.2359 0.869594 25.2473C1.02604 25.2586 1.18284 25.2306 1.32563 25.1656C2.97938 24.4156 5.64375 23.5137 8.22563 23.2531C10.8675 22.9869 13.0819 23.4162 14.2688 24.8975C14.3566 25.007 14.4679 25.0954 14.5945 25.1561C14.721 25.2168 14.8596 25.2483 15 25.2483C15.1404 25.2483 15.279 25.2168 15.4055 25.1561C15.5321 25.0954 15.6434 25.007 15.7313 24.8975C16.9181 23.4162 19.1325 22.9869 21.7725 23.2531C24.3563 23.5137 27.0225 24.4156 28.6744 25.1656C28.8172 25.2306 28.974 25.2586 29.1304 25.2473C29.2869 25.2359 29.438 25.1855 29.5699 25.1006C29.7018 25.0157 29.8103 24.8991 29.8854 24.7614C29.9606 24.6237 30 24.4693 30 24.3125V3.68749C30 3.50756 29.9481 3.33145 29.8507 3.18018C29.7533 3.0289 29.6144 2.90885 29.4506 2.83437C27.6656 2.02249 24.8006 1.04937 21.9619 0.76249C19.5244 0.516865 16.8469 0.75499 15 2.34311Z" fill="#F8F8F8"/>
                        </svg>
                        <p class="mx-2">0 Lessons</p>
                    </div>
                    <div class="flex flex-row my-2">
                        <svg width="24" height="24" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M6.25 26.25C5.5625 26.25 4.97375 26.005 4.48375 25.515C3.99375 25.025 3.74917 24.4367 3.75 23.75V6.25C3.75 5.5625 3.995 4.97375 4.485 4.48375C4.975 3.99375 5.56334 3.74917 6.25 3.75H11.5C11.7708 3 12.2242 2.39583 12.86 1.9375C13.4958 1.47917 14.2092 1.25 15 1.25C15.7917 1.25 16.5054 1.47917 17.1413 1.9375C17.7771 2.39583 18.23 3 18.5 3.75H23.75C24.4375 3.75 25.0263 3.995 25.5163 4.485C26.0063 4.975 26.2508 5.56333 26.25 6.25V23.75C26.25 24.4375 26.005 25.0263 25.515 25.5163C25.025 26.0063 24.4367 26.2508 23.75 26.25H6.25ZM6.25 23.75H23.75V6.25H6.25V23.75ZM8.75 21.25H17.5V18.75H8.75V21.25ZM8.75 16.25H21.25V13.75H8.75V16.25ZM8.75 11.25H21.25V8.75H8.75V11.25ZM15 5.3125C15.2708 5.3125 15.4946 5.22375 15.6713 5.04625C15.8479 4.86875 15.9367 4.645 15.9375 4.375C15.9375 4.10417 15.8488 3.88042 15.6713 3.70375C15.4938 3.52708 15.27 3.43833 15 3.4375C14.7292 3.4375 14.5054 3.52625 14.3288 3.70375C14.1521 3.88125 14.0633 4.105 14.0625 4.375C14.0625 4.64583 14.1513 4.86958 14.3288 5.04625C14.5063 5.22292 14.73 5.31167 15 5.3125Z" fill="white"/>
                        </svg>
                        <p class="mx-2">0 Activities</p>
                    </div>
                    <div class="flex flex-row my-2">
                        <svg width="24" height="24" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M26.6391 8.59801L21.402 3.36207C21.2278 3.18792 21.0211 3.04977 20.7936 2.95551C20.5661 2.86126 20.3223 2.81274 20.076 2.81274C19.8297 2.81274 19.5859 2.86126 19.3584 2.95551C19.1308 3.04977 18.9241 3.18792 18.75 3.36207L4.29962 17.8125C4.12475 17.9859 3.98611 18.1924 3.89176 18.42C3.79741 18.6475 3.74922 18.8915 3.75001 19.1379V24.375C3.75001 24.8722 3.94755 25.3492 4.29918 25.7008C4.65081 26.0524 5.12773 26.25 5.62501 26.25H10.8621C11.1084 26.2508 11.3525 26.2026 11.58 26.1082C11.8075 26.0139 12.014 25.8752 12.1875 25.7004L21.9926 15.8964L22.4004 17.5254L18.0879 21.8367C17.912 22.0124 17.8131 22.2509 17.813 22.4995C17.8129 22.7482 17.9116 22.9867 18.0873 23.1627C18.2631 23.3386 18.5015 23.4375 18.7502 23.4376C18.9988 23.4377 19.2374 23.339 19.4133 23.1632L24.1008 18.4757C24.2154 18.3613 24.2985 18.2191 24.3418 18.063C24.3851 17.9069 24.3873 17.7423 24.3481 17.5851L23.5395 14.3496L26.6391 11.25C26.8132 11.0758 26.9514 10.8691 27.0456 10.6416C27.1399 10.4141 27.1884 10.1702 27.1884 9.92398C27.1884 9.67772 27.1399 9.43387 27.0456 9.20635C26.9514 8.97884 26.8132 8.77212 26.6391 8.59801ZM5.62501 21.0129L8.98712 24.375H5.62501V21.0129ZM11.25 23.9871L6.0129 18.75L15.9375 8.82535L21.1746 14.0625L11.25 23.9871ZM22.5 12.7371L17.2641 7.49996L20.0766 4.68746L25.3125 9.92457L22.5 12.7371Z" fill="white"/>
                        </svg>
                        <p class="mx-2">0 Quizzes</p>
                    </div>
                </div>
            </div>
            
            <div class="mx-2">
                {{-- head --}}
                <div class="flex flex-row items-center py-4 border-b-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32"><path fill="currentColor" d="M12 29a1 1 0 0 1-.92-.62L6.33 17H2v-2h5a1 1 0 0 1 .92.62L12 25.28l8.06-21.63A1 1 0 0 1 21 3a1 1 0 0 1 .93.68L25.72 15H30v2h-5a1 1 0 0 1-.95-.68L21 7l-8.06 21.35A1 1 0 0 1 12 29Z"/></svg>
                    <h1 class="mx-2 text-2xl font-semibold">Activity 1</h1>
                </div>
                
                {{-- body --}}
                <div id="emptyActivity">
                    <x-forms.primary-button 
                    color="seagreen" 
                    name="Add Instructions" 
                    type="button" 
                    class="text-white" 
                    id="addInstructions"/>
                </div>
                <div class="hidden py-4" id="defaultView">
                    <div class="flex flex-row items-center">
                        <h3 class="my-2 text-xl font-medium">Instructions:</h3>
                        <svg class="mx-2" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="M80 0v-160h800V0H80Zm80-240v-150l362-362 150 150-362 362H160Zm80-80h36l284-282-38-38-282 284v36Zm477-326L567-796l72-72q11-12 28-11.5t28 11.5l94 94q11 11 11 27.5T789-718l-72 72ZM240-320Z"/></svg>
                    </div>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Autem atque praesentium eius eaque, minima ratione pariatur dolore labore iure in facere, fuga maxime voluptas soluta quo dicta sequi, ducimus illum.</p>

                    <div class="flex flex-row items-center">
                        <h3 class="my-2 text-xl font-medium">Criteria:</h3>
                        <svg class="mx-2" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="M80 0v-160h800V0H80Zm80-240v-150l362-362 150 150-362 362H160Zm80-80h36l284-282-38-38-282 284v36Zm477-326L567-796l72-72q11-12 28-11.5t28 11.5l94 94q11 11 11 27.5T789-718l-72 72ZM240-320Z"/></svg>
                    </div>
                    <p>Eme 1: <span>10/10</span></p>
                    <p>Eme 2: <span>10/10</span></p>
                    <p>Eme 3: <span>10/10</span></p>
                    <p>Total: <span>30/30</span></p>
                </div>
                <div class="my-2" id="studentsList">
                </div>
                <div class="my-2" id="studentsStatistics">

                </div>
            </div>
            <x-forms.primary-button 
            color="darthmouthgreen" 
            name="View Responses" 
            type="button" 
            class="text-white " 
            id="viewResponseActivity"/>
        </div>
    </section>

    <x-modal >
        <div class="flex flex-col">
            <div class="flex flex-row">
                <x-forms.primary-button 
                color="amber" 
                name="Student Responses" 
                type="button" 
                id="viewStudents"/>
                <x-forms.primary-button 
                color="amber" 
                name="Student's Statistics" 
                type="button" 
                id="viewStatistics"/>
            </div>
            
            <x-forms.secondary-button 
            name="Close" 
            class="mt-4" 
            id="closeAct"/>
        </div>
    </x-modal>

      
</section>

@include('partials.footer')