<section class="w-screen h-screen bg-cover" style="background-image: url('{{ asset('assets/CityHall.jpg') }}')">

    {{-- <div class="p-5 text-3xl font-bold titlearea font-poppins">Eskwela4EveryJuan</div> --}}
    
    <section class="relative flex items-center justify-center h-full  bg-white  bg-opacity-70">
        {{-- <div class="relative left-0 w-3/5 h-full px-5 border-r-2 border-white">
            <div class="relative pr-15">
                <text class="font-semibold leading-none text-darthmouthgreen text-7xl">Eskwela4EveryJuan</text>
                <p class="pt-5 text-2xl font-normal text-black">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Iusto tempore aliquam aperiam iste et dolor, iure debitis! Adipisci ad libero eveniet molestias explicabo sunt eligendi. Autem similique suscipit amet neque.</p>
            </div>

   
        </div>
     --}}
     <div id="adminlogin" class="relative flex items-center justify-center h-full w-full transition-opacity duration-100">

        <div class="border-gray-200 shadow-xl bg-white p-16 bg-opacity-70 rounded-xl h-3/5 w-4/12">
            <div class="text-center" id="logoArea">
                <h1 class="text-darthmouthgreen text-xl font-bold">Eskwela4EveryJuan</h1>
            </div>
            <div class="text-center mt-10" id="welcomeArea">
                <p class="text-5xl text-darthmouthgreen">Welcome Back</p>
                <p class="text-md text-gray-600">Welcome Back!  Please login to your account.</p>
            </div>
            <div class="mt-10 w-full" id="formArea">
                <form action="/admin/login" method="POST">
                    @csrf
                    
                    <div class="relative">
                        <div class="my-3 w-full">
                            <label for="admin_username" class=" text-xl font-semibold text-darthmouthgreen">Username:</label>
                            <input type="text" name="admin_username" class="px-5 py-3 mt-2 rounded-md w-full border border-darthmouthgreen" placeholder="Username" value="{{ old('admin_username') }}" required>
                        </div>
                        <div class="my-3 w-full">
                            <label for="password" class="text-xl font-semibold text-darthmouthgreen">Password:</label>
                            <div class="relative items-center">
                                <input type="password" class="px-5 py-3 mt-2 rounded-md w-full border border-darthmouthgreen" name="password" id="password" placeholder="Password" required>
                                <button type="button" id="showPasswordBtn" class="absolute top-0 right-0 mr-3 mt-3 px-3 py-1 rounded-md text-xl">
                                    <i id="eyeIcon" class="fa-regular fa-eye" style="color: #025c26;"></i>
                                </button>
                            </div>
                        </div>
                        @error('admin_username')
                        <p class="p-1 mt-2 text-lg text-red-500">
                            {{$message}}
                        </p>
                        @enderror
                        <div class="relative flex mt-10 justify-between">
                            <p></p>
                            <button type="submit" class="w-full py-3 text-xl font-semibold text-white rounded-lg bg-seagreen hover:bg-green-900">Login</button>
                        </div>
                    </div>
                </form>
            </div>
    
        </div>
    
    </div>
        {{-- </div> --}}
    
    </section>

    
   
    </section>
    <script>
        $(document).ready(function() {
            $('#showPasswordBtn').click(function() {
                var passwordField = $('#password');
                var fieldType = passwordField.attr('type');
                if (fieldType === 'password') {
                    passwordField.attr('type', 'text');
                    $('#eyeIcon').removeClass('fa-eye').addClass('fa-eye-slash');
                } else {
                    passwordField.attr('type', 'password');
                    $('#eyeIcon').removeClass('fa-eye-slash').addClass('fa-eye');
                }
            });
        });
    </script>
    
@include('partials.footer')

