@include('partials.header')

<section class="w-screen h-screen relative flex">
    <div id="LoginLeft" class="w-1/2 h-full bg-seagreen relative">
        <div class="titlearea text-3xl font-bold font-poppins p-5 text-white">Eskwela4EveryJuan</div>

        <div id="Logintitle" class="relative w-4/5 mx-auto mt-44">
            <text class="text-5xl font-bold text-white">Instructor Login</text>
            <p class="text-lg font-light mt-2 text-white">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Est voluptate ut, facere repellendus earum, at corrupti praesentium consectetur dignissimos,</p>
        </div>

        <form action="">
        @csrf
            <div class="relative mt-20 w-4/5 mx-auto px-12 border-b-2 border-green-950">
                <div id="EorU" class="relative flex items-center py-3">
                    <label for="EmailOrUsername" class="text-xl font-semibold w-72 text-white">Email or Username:</label>
                    <i class="fa-regular fa-envelope text-2xl bg-white py-3 px-2 border-black border-2 rounded-tl-lg rounded-bl-lg"></i>
                    <input type="text" name="EmailOrUsername" class="text-lg font-medium w-96 h-12 px-4 rounded-tr-lg rounded-br-lg shadow-lg" placeholder="Email">
                </div>
                <div id="pass" class="relative flex items-center py-3">
                    <label for="password" class="text-xl font-semibold w-72 text-white">Password:</label>
                    <i class="fa-solid fa-key text-2xl bg-white py-3 px-2 border-black border-2 rounded-tl-lg rounded-bl-lg"></i>
                    <input type="password" name="password" class="text-lg font-medium w-96 h-12 px-4 rounded-tr-lg rounded-br-lg shadow-lg" placeholder="Password">
                </div>
                <div class="relative flex items-center pt-2 pb-5 justify-end">
                    <a href="#" class="text-lg font-semibold text-white hover:text-green-900">Forgot Password?</a>
                </div>
                
            </div>
            <div id="button" class="relative mt-3 w-4/5 mx-auto px-12 py-2 flex justify-between">
                <div id="remember" class="flex items-center">
                    <input type="checkbox" name="rememberMe" class="bg-green-600 text-lg h-6 w-6 mr-3">
                    <label for="rememberMe" class="text-xl font-medium text-white">Remember me</label>
                </div>
                {{-- <a href="#" class="rounded-xl bg-green-700 text-white font-semibold text-xl py-3 px-7 hover:bg-green-900">Log in</a> --}}
                <button type="submit" class="rounded-xl bg-lemonchiffon text-black font-semibold text-xl py-3 px-7 hover:bg-green-900">Log in</button>
            </div>
        </form>

        <div class="relative mt-6 w-4/5 mx-auto py-2 flex justify-center" id="register">
            <p class="text-xl font-normal text-white">Don't have an account yet? <a href="/instructor/register" class="text-xl font-semibold text-lemonchiffon hover:text-green-900">Sign Up</a></p>
        </div>
    </div>
    
    <div id="LoginRight" class="w-1/2 h-full bg-neutral-200 relative right-0">
        //put those extra content to it
    </div>

</section>

@include('partials.footer')