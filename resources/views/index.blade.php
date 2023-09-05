@include('partials.header')

    <section class="w-screen h-screen bg-cover" style="background-image: url('{{ asset('assets/alexander-grey-eMP4sYPJ9x0-unsplash.jpg') }}')">

    <div class="p-5 text-xl font-bold titlearea font-poppins">Eskwela4EveryJuan</div>
    
    <div class="relative w-5/12 bg-gray-200 maincontent mx-28 top-56 bg-opacity-5">
    
        <text class="font-semibold leading-none text-7xl">Learn anything, anytime, anywhere</text>
        <p class="pt-5 text-2xl font-light">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Iusto tempore aliquam aperiam iste et dolor, iure debitis! Adipisci ad libero eveniet molestias explicabo sunt eligendi. Autem similique suscipit amet neque.</p>

        <div class="relative mt-12">
            <a href="/learner/login" class="px-16 py-6 text-2xl font-medium text-white bg-green-700 rounded-full hover:bg-green-800">Sign In</a>
            <a href="/instructor/login" class="text-xl font-bold text-black mx-7 hover:text-green-500">Sign In as Instructor</a>
        </div>
    </div>

    </section>

@include('partials.footer')