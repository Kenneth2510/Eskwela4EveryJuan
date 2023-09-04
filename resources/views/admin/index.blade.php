@include('partials.header')

<section class="h-screen w-screen bg-cover" style="background-image: url('{{ asset('assets/ivan-aleksic-PDRFeeDniCk-unsplash.jpg') }}')">

    <div class="titlearea text-3xl font-bold font-poppins p-5">Eskwela4EveryJuan</div>
    
    <section class="relative flex items-center top-48 px-20 py-10 mx-auto bg-gray-400 bg-opacity-40">
        <div class="relative w-3/5 h-full left-0 border-r-2 border-white px-5">
            <div class="relative pr-15">
                <text class="text-7xl font-semibold leading-none text-black">Eskwela4EveryJuan</text>
                <p class="text-2xl font-normal pt-5 text-black">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Iusto tempore aliquam aperiam iste et dolor, iure debitis! Adipisci ad libero eveniet molestias explicabo sunt eligendi. Autem similique suscipit amet neque.</p>
        
                <div class="relative mt-12">
                    <button id="showloginadmin" class="py-6 px-16 rounded-full bg-seagreen text-white font-medium text-2xl hover:bg-green-800">Sign In</button>
             
                </div>
            </div>
        </div>
    
        <div id="adminlogin" class="relative hidden w-2/4 h-full ml-24 right-0 py-16 transition-opacity duration-100">
            <form action="">
                @csrf
    
                <div class="relative w-4/5">
                    <div class="flex items-center my-5">
                        <label for="username" class="w-32 text-black font-bold text-2xl mr-16">Username:</label>
                        <input type="text" name="username" class="py-3 text-base px-5 w-96 rounded-lg" placeholder="Username">
                    </div>
                    <div class="flex items-center my-5">
                        <label for="password" class="w-32 text-black font-bold text-2xl mr-16">Password</label>
                        <input type="text" class="py-3 text-base px-5 w-96 rounded-lg" name="password" placeholder="Password">
                    </div>
                    <div class="relative flex justify-between">
                        <p></p>
                        <button type="submit" class="bg-seagreen py-5 px-12 rounded-full text-white font-semibold text-xl hover:bg-green-900 mr-5">Login</button>
                    </div>
                </div>
            </form>
        </div>
    
    </section>

    
   
    </section>
    
    <script>
        $(document).ready(function() {
            const form1 = $('#adminlogin');
            const showForm2Button = $('#showloginadmin');
    
            showForm2Button.on('click', function(event) {
                event.preventDefault();
                form1.removeClass('hidden');
            });
        });
      </script>
@include('partials.footer')