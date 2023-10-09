@include('partials.header')

<section class="w-screen h-screen bg-cover" style="background-image: url('{{ asset('assets/ivan-aleksic-PDRFeeDniCk-unsplash.jpg') }}')">

    <div class="p-5 text-3xl font-bold titlearea font-poppins">Eskwela4EveryJuan</div>
    
    <section class="relative flex items-center px-20 py-10 mx-auto bg-gray-400 top-48 bg-opacity-40">
        <div class="relative left-0 w-3/5 h-full px-5 border-r-2 border-white">
            <div class="relative pr-15">
                <text class="font-semibold leading-none text-black text-7xl">Eskwela4EveryJuan</text>
                <p class="pt-5 text-2xl font-normal text-black">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Iusto tempore aliquam aperiam iste et dolor, iure debitis! Adipisci ad libero eveniet molestias explicabo sunt eligendi. Autem similique suscipit amet neque.</p>
        
                <div class="relative mt-12">
                    <button id="showloginadmin" class="px-16 py-6 text-2xl font-medium text-white rounded-full bg-seagreen hover:bg-green-800">Sign In</button>
             
                </div>
            </div>
        </div>
    
        <div id="adminlogin" class="relative right-0 w-2/4 h-full py-16 ml-24 transition-opacity duration-100">
            <form action="/admin/login" method="POST">
                @csrf
                
                <div class="relative w-4/5">
                    @error('admin_username')
                    <p class="p-1 mt-2 text-xs text-red-500">
                        {{$message}}
                    </p>
                    @enderror
                    <div class="flex items-center my-5">
                        <label for="admin_username" class="w-32 mr-16 text-2xl font-bold text-black">Username:</label>
                        <input type="text" name="admin_username" class="px-5 py-3 text-base rounded-lg w-96" placeholder="Username" value="{{ old('admin_username') }}">
                    </div>
                    <div class="flex items-center my-5">
                        <label for="password" class="w-32 mr-16 text-2xl font-bold text-black">Password</label>
                        <input type="password" class="px-5 py-3 text-base rounded-lg w-96" name="password" placeholder="Password">
                    </div>
                    <div class="relative flex justify-between">
                        <p></p>
                        <button type="submit" class="px-12 py-5 mr-5 text-xl font-semibold text-white rounded-full bg-seagreen hover:bg-green-900">Login</button>
                    </div>
                </div>
            </form>
        </div>
    
    </section>

    
   
    </section>
    
    {{-- <script>
        $(document).ready(function() {
            const form1 = $('#adminlogin');
            const showForm2Button = $('#showloginadmin');
    
            showForm2Button.on('click', function(event) {
                event.preventDefault();
                form1.removeClass('hidden');
            });
        });
      </script> --}}
@include('partials.footer')
