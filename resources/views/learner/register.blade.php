@include('partials.header')

<section class="w-screen h-screen relative flex">
    <div id="RegisterLeft" class="w-1/2 h-full bg-neutral-200 relative">
        <div class="titlearea text-3xl font-bold font-poppins p-5">Eskwela4EveryJuan</div>

       

        <form action="">
        @csrf
           
            <div id="personinfo" class="relative w-4/5 mx-auto mt-10">
                <div id="Registertitle" class="relative w-full mx-auto my-14">
                    <text class="text-5xl font-bold text-black">Create an Account</text>
                    <p class="text-lg font-light mt-2">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Est voluptate ut, facere repellendus earum, at corrupti praesentium consectetur dignissimos,</p>
                </div>
                <div class="flex justify-around my-5">
                    <div class="w-1/2">
                        <label for="first_name" class="text-xl font-semibold">First Name</label><br>
                        <input type="text" class="w-11/12 mx-0.5 px-3 py-1 text-lg shadow-xl rounded-md" name="first_name" placeholder="First Name">
                    </div>
                    <div class="w-1/2">
                        <label for="last_name" class="text-xl font-semibold">Last Name</label><br>
                        <input type="text" name="last_name" class="w-11/12 mx-0.5 px-3 py-1 text-lg shadow-xl rounded-md" placeholder="Last Name">
                    </div>
                </div>

                <div class="flex justify-around my-5 w-full">
                    <div class="w-1/2">
                        <label for="bday" class="text-xl font-semibold">Birthday</label><br>
                        <input type="date" name="bday" class="w-11/12 mx-0.5 px-3 py-1 text-lg shadow-xl rounded-md">
                    </div>
                    <div class="w-1/2">
                        <label for="gender" class="text-xl font-semibold">Gender</label><br>
                        <select name="gender" id="" class="w-11/12 mx-0.5 px-3 py-1 text-lg shadow-xl rounded-md">
                            <option value=""></option>
                            <option value="">Male</option>
                            <option value="">Female</option>
                        </select>
                    </div>
                </div>

                <div class="w-full my-5">
                    <label for="email" class="text-xl font-semibold">Email</label><br>
                    <input type="email" name="email" class="w-11/12 mx-0.5 px-3 py-1 text-lg shadow-xl rounded-md" placeholder="Email">
                </div>

                <div class="w-full my-5">
                    <label for="contactno" class="text-xl font-semibold">Contact Number</label><br>
                    <input type="tel" id="contactno" name="contactno" class="w-11/12 mx-0.5 px-3 py-1 text-lg shadow-xl rounded-md" placeholder="Contact Number" pattern="[0-9]{10}">
                </div>

                <div class="w-full my-5">
                    <label for="username" class="text-xl font-semibold">Username</label><br>
                    <input type="text" name="username" class="w-11/12 mx-0.5 px-3 py-1 text-lg shadow-xl rounded-md" placeholder="Username">
                </div>

                <div class="w-full my-5">
                    <label for="password" class="text-xl font-semibold">Password</label><br>
                    <input type="password" name="password" class="w-11/12 mx-0.5 px-3 py-1 text-lg shadow-xl rounded-md" placeholder="Password">
                </div>
                
                <div class="w-full my-5">
                    <label for="password_confirm" class="text-xl font-semibold">Confirm Password</label><br>
                    <input type="password" name="password_confirm" class="w-11/12 mx-0.5 px-3 py-1 text-lg shadow-xl rounded-md" placeholder="Confirm Password">
                </div>

                <div class="w-full mt-10 flex justify-end">
                    <button id="shownext" class="rounded-xl bg-green-700 text-white font-semibold text-xl py-3 px-7 hover:bg-green-900">Next  <i class="fa-solid fa-arrow-right" style="color: #ffffff;"></i></button>
                </div>
            </div>

            <div id="businessinfo" class="hidden relative w-4/5 mx-auto mt-10">
                <div id="Registertitle" class="relative w-full mx-auto my-14">
                    <text class="text-5xl font-bold text-black">About your Business</text>
                    <p class="text-lg font-light mt-2">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Est voluptate ut, facere repellendus earum, at corrupti praesentium consectetur dignissimos,</p>
                </div>

                <div class="w-full my-5">
                    <label for="businessname" class="text-xl font-semibold">Business Name:</label><br>
                    <input type="text" name="businessname" class="w-11/12 mx-0.5 px-3 py-1 text-lg shadow-xl rounded-md" placeholder="Business Name">
                </div>

                <div class="w-full my-5">
                    <label for="businessad" class="text-xl font-semibold">Business Address:</label><br>
                    <input type="text" name="businessad" class="w-11/12 mx-0.5 px-3 py-1 text-lg shadow-xl rounded-md" placeholder="Business Address">
                </div>

                <div class="w-full my-5">
                    <label for="businessowner" class="text-xl font-semibold">Business Owner Name:</label><br>
                    <input type="text" name="businessowner" class="w-11/12 mx-0.5 px-3 py-1 text-lg shadow-xl rounded-md" placeholder="Business Owner Name">
                </div>

                <div class="w-full my-5">
                    <label for="bploaccno" class="text-xl font-semibold">BPLO Account Number:</label><br>
                    <input type="text" name="bploaccno" class="w-11/12 mx-0.5 px-3 py-1 text-lg shadow-xl rounded-md" placeholder="BPLO Account Number">
                </div>

                <div class="relative border-t-2 border-green-800 mt-10 py-5">
                    <div class="flex items-center py-3">
                        <input type="checkbox" name="rememberMe" class="bg-green-600 text-lg h-6 w-6 mr-3">
                        <label for="rememberMe" class="text-xl font-medium">I've read and Accept <a href="" class="text-green-700 font-bold hover:text-green-900"> Terms & Conditions</a></label>
                    </div>
                    <div class="flex items-center py-3">
                        <input type="checkbox" name="rememberMe" class="bg-green-600 text-lg h-6 w-6 mr-3">
                        <label for="rememberMe" class="text-xl font-medium">Remember me</label>
                    </div>

                    <div class="mt-5 flex justify-end">
                        <button id="showprev" class="mx-5 rounded-xl bg-green-700 text-white font-semibold text-xl py-3 px-7 hover:bg-green-900"><i class="fa-solid fa-arrow-right fa-rotate-180" style="color: #ffffff;"> </i>    Back</button>
                        <button type="submit" class="rounded-xl bg-green-700 text-white font-semibold text-xl py-3 px-7 hover:bg-green-900">Create my Account</button>

                    </div>
                </div>
                <div class="relative mt-6 w-4/5 mx-auto py-2 flex justify-center" id="register">
                    <p class="text-xl font-normal">Already have an account? <a href="/learner/login" class="text-xl font-semibold text-green-700 hover:text-green-900">Sign In</a></p>
                </div>
        
            </div>


        </form>

       

    </div>
    
    <div id="RegisterRight" class="w-1/2 h-full bg-seagreen relative right-0">
        {{-- //put those extra content to it --}}
    </div>

</section>

<script>
    // Add event listener to restrict input to numbers only
    document.getElementById("contactno").addEventListener("input", function(event) {
        event.target.value = event.target.value.replace(/\D/g, "");
    });
</script>

<script>
    $(document).ready(function() {
        const form1 = $('#personinfo');
        const form2 = $('#businessinfo');
        const showForm2Button = $('#shownext');
        const showForm1Button = $('#showprev');

        showForm2Button.on('click', function(event) {
            event.preventDefault();
            form1.addClass('hidden');
            form2.removeClass('hidden');
        });

        showForm1Button.on('click', function(event) {
            event.preventDefault();
            form2.addClass('hidden');
            form1.removeClass('hidden');
        });
    });
  </script>


@include('partials.footer')