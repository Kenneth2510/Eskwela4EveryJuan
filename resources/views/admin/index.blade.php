@include('partials.header')

<section class="w-auto h-screen text-mainwhitebg">
    <section class="relative flex flex-col h-screen py-10 mx-auto lg:px-10 md:items-center md:justify-center lg:flex-row lg:justify-between">
        <div class="relative px-2 mx-auto border-white lg:py-10 lg:w-2/3 lg:border-r-2">
            <div class="relative text-center">
                <h1 class="text-2xl font-semibold leading-none text-black lg:text-7xl">Eskwela4EveryJuan</h1>
                <p class="hidden pt-5 text-base font-normal text-justify text-black lg:block">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Iusto tempore aliquam aperiam iste et dolor, iure debitis! Adipisci ad libero eveniet molestias explicabo sunt eligendi. Autem similique suscipit amet neque.</p>
            </div>
        </div>
    
        <div id="adminlogin" class="relative px-4 py-16 transition-opacity duration-100 md:border-2 md:w-3/5 md:my-4 lg:border-none lg:w-1/3">
            <form action="/admin/login" method="POST">
                @csrf
                <h3 class="text-lg font-semibold leading-none text-center text-black">Admin Login</h3>
                <div class="relative">
                    @error('admin_username')
                    <p class="p-1 mt-2 text-xs text-red-500">
                        {{$message}}
                    </p>
                    @enderror
                    <div class="flex flex-col my-5 lg:items-center lg:flex-row lg:justify-between ">
                        <label for="admin_username" class="my-2 font-medium text-black">Username:</label>
                        <input type="text" name="admin_username" class="AD-INP" placeholder="Username" value="{{ old('admin_username') }}">
                    </div>
                    <div class="flex flex-col my-5 lg:flex-row lg:justify-between lg:items-center">
                        <label for="password" class="my-2 font-medium text-black">Password:</label>
                        <input type="password" class="AD-INP" name="password" placeholder="Password">
                    </div>
                    <div class="relative right-0 grid lg:justify-end md:flex">
                        <x-forms.primary-button
                        color="seagreen"
                        name="Log in"
                        type="submit">
                        </x-forms.primary-button>
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
