@include('partials.header')

<section class="relative flex w-screen h-screen">
    <div id="LoginLeft" class="relative w-1/2 h-full bg-neutral-200">
        <div class="p-5 text-3xl font-bold titlearea font-poppins">Eskwela4EveryJuan</div>

        <div id="Logintitle" class="relative w-4/5 mx-auto mt-44">
            <text class="text-5xl font-bold text-black">Login</text>
            <p class="mt-2 text-lg font-light">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Est voluptate ut, facere repellendus earum, at corrupti praesentium consectetur dignissimos,</p>
        </div>

        <form action="{{ url('/learner/login') }}" method="POST">
        @csrf
            <div class="relative w-4/5 px-12 mx-auto mt-20 border-b-2 border-green-950">
                @error('learner_username')
                        <p class="text-red-500 text-lg mt-2 p-1">
                            {{$message}}
                        </p>
                        @enderror
                <div id="EorU" class="relative flex items-center py-3">
                    <label for="learner_username" class="text-xl font-semibold w-72">Username:</label>
                    <i class="px-2 py-3 text-2xl bg-white border-2 border-black rounded-tl-lg rounded-bl-lg fa-regular fa-envelope"></i>
                    <input type="text" name="learner_username" class="h-12 px-4 text-lg font-medium rounded-tr-lg rounded-br-lg shadow-lg w-96" placeholder="Username" autofocus>
                </div>
                <div id="pass" class="relative flex items-center py-3">
                    <label for="password" class="text-xl font-semibold w-72">Password:</label>
                    <i class="px-2 py-3 text-2xl bg-white border-2 border-black rounded-tl-lg rounded-bl-lg fa-solid fa-key"></i>
                    <input type="password" name="password" class="h-12 px-4 text-lg font-medium rounded-tr-lg rounded-br-lg shadow-lg w-96" placeholder="Password">
                </div>
                <div class="relative flex items-center justify-end pt-2 pb-5">
                    <a href="#" class="text-lg font-semibold text-green-700 hover:text-green-900">Forgot Password?</a>
                </div>
                
            </div>
            <div id="button" class="relative flex justify-between w-4/5 px-12 py-2 mx-auto mt-3">
                <div id="remember" class="flex items-center">
                    <input type="checkbox" name="rememberMe" class="w-6 h-6 mr-3 text-lg bg-green-600">
                    <label for="rememberMe" class="text-xl font-medium">Remember me</label>
                </div>
                {{-- <a href="#" class="py-3 text-xl font-semibold text-white bg-green-700 rounded-xl px-7 hover:bg-green-900">Log in</a> --}}
                <button type="submit" class="py-3 text-xl font-semibold text-white bg-green-700 rounded-xl px-7 hover:bg-green-900">Log in</button>
            </div>
        </form>

        <div class="relative flex justify-center w-4/5 py-2 mx-auto mt-6" id="register">
            <p class="text-xl font-normal">Don't have an account yet? <a href="/learner/register" class="text-xl font-semibold text-green-700 hover:text-green-900">Sign Up</a></p>
        </div>
    </div>
    
    <div id="LoginRight" class="relative right-0 w-1/2 h-full bg-seagreen">
        //put those extra content to it
    </div>

</section>

@include('partials.footer')