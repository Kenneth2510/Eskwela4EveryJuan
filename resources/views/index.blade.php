@include('partials.header')

    <section class="h-screen w-screen bg-cover" style="background-image: url('{{ asset('assets/alexander-grey-eMP4sYPJ9x0-unsplash.jpg') }}')">

    <div class="titlearea text-3xl font-bold font-poppins p-5">Eskwela4EveryJuan</div>
    
    <div class="maincontent relative w-5/12 bg-gray-200 mx-28 top-56 bg-opacity-5">
    
        <text class="text-7xl font-semibold leading-none">Learn anything, anytime, anywhere</text>
        <p class="text-2xl font-light pt-5">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Iusto tempore aliquam aperiam iste et dolor, iure debitis! Adipisci ad libero eveniet molestias explicabo sunt eligendi. Autem similique suscipit amet neque.</p>

        <div class="relative mt-12">
            <a href="/learner/login" class="py-6 px-16 rounded-full bg-green-700 text-white font-medium text-2xl hover:bg-green-800">Sign In</a>
            <a href="/instructor/login" class="text-black font-bold mx-7 text-xl hover:text-green-500">Sign In as Instructor</a>
        </div>
    </div>

    </section>

@include('partials.footer')

{{-- TEST 1 - 2 - 3 --}}