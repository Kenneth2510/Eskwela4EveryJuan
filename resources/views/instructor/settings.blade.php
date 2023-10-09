@include('partials.header')

    <section class="relative w-full h-auto overflow-hidden text-sm bg-mainwhitebg">
        
        @include('partials.instructorNav')
        @include('partials.instructorSidebar')

        {{-- MAIN --}}
        <section class="relative mx-2 overflow-auto shadow-lg md:h-screen text-darthmouthgreen">
            <div class="top-0 right-0 md:absolute z-1 md:w-3/4 pt-[110px] md:pt-[60px] md:h-screen lg:w-10/12">
                <button class="w-8 h-8 m-2">
                    <svg class="md:10 md:h-10" xmlns="http://www.w3.org/2000/svg" height="20" viewBox="0 -960 960 960" width="24"><path d="m313-440 224 224-57 56-320-320 320-320 57 56-224 224h487v80H313Z"/></svg>
                </button>

                <h1 class="mb-4 text-lg font-semibold text-center md:text-xl lg:text-2xl">Instructor Settings</h1>

                <form class="pb-4 mx-4 text-sm text-black md:text-base lg:px-[200px]" action="">
                    @csrf
                    <div class="flex flex-col items-center justify-center mb-4">
                        <div class="w-20 h-20 bg-teal-500 rounded-full lg:w-32 lg:h-32">
                            
                        </div>
                        <h1 class="text-lg font-medium">Instructor 1</h1>
                        <button class="underline text-darthmouthgreen ">Update Picture</button>
                    </div>
                    <div class="flex flex-col lg:flex-row lg:flex-wrap">
                        <div class="FORM-CTNR lg:mr-20">
                            <label for="fname">Firstname:</label>
                            <input class="h-10 IN-V-INP lg:w-[400px]" type="text" name="fname" id="">
                        </div>
                        <div class="FORM-CTNR">
                            <label for="lname">Lastname:</label>
                            <input class="h-10 IN-V-INP lg:w-[400px]" type="text" name="lname" id="">
                        </div>
                    </div>
                    
                    <div class="flex flex-col lg:flex-row lg:flex-wrap">
                        <div class="FORM-CTNR lg:mr-20">
                            <label for="birthday">Birthday:</label>
                            <input class="h-10 IN-V-INP lg:w-[400px]" type="date" name="birthday" id="">
                        </div>
                        
                        <div class="FORM-CTNR">
                            <label for="gender">Gender</label>
                            <select class="h-10 IN-V-INP lg:w-[400px]" name="" id="">
                                <option value="" disabled selected>-- select an option --</option>
                                <option value="">Male</option>
                                <option value="">Female</option>
                            </select>
                        </div>
                    </div>

                    <div class="FORM-CTNR">
                        <label for="email">Email:</label>
                        <input class="h-10 IN-V-INP" type="email" name="email" id="">
                    </div>
                    <div class="FORM-CTNR">
                        <label for="contact_number">Contact Number:</label>
                        <input class="h-10 IN-V-INP" type="text" name="contact_number" id="">
                    </div>
                    <div class="FORM-CTNR">
                        <label for="username">Username:</label>
                        <input class="h-10 IN-V-INP" type="text" name="" id="">
                    </div>
                    <div class="FORM-CTNR">
                        <label for="password">Old Password:</label>
                        <input class="h-10 IN-V-INP" type="password" name="old_password" id="">
                    </div>
                    <div class="FORM-CTNR">
                        <label for="password">New Password:</label>
                        <input class="h-10 IN-V-INP" type="password" name="new_password" id="">
                    </div>
                    <div class="FORM-CTNR">
                        <label for="password_confirmation">Confirm New Password:</label>
                        <input class="h-10 IN-V-INP" type="password" name="password_confirmation" id="">
                    </div>
                    
                    <div class="grid h-auto my-10 text-black place-items-end" >
                        <button class="flex flex-row items-center justify-center w-24 h-10 rounded-lg bg-amber-400 hover:bg-amber-500 lg:h-14 lg:w-32" id="nxtBtn">
                            Update
                        </button>
                    </div>
                </form>
            </div>
            
        </section>
    </section>


@include('partials.footer')