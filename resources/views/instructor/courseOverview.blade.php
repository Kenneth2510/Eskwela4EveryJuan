@include('partials.header')
<section class="flex flex-col bg-red-700">
        <header class="fixed top-0 left-0 z-40 flex flex-row items-center w-full px-4 py-4 bg-seagreen">
        <a href="#">
            <span class="self-center text-lg font-semibold font-semibbold whitespace-nowrap md:text-2xl text-mainwhitebg">
                Eskwela4EveryJuan
            </span>
        </a>
    </header>  
        {{-- SIDEBAR --}}
    @include('partials.instructorSidebar')

    {{-- MAIN --}}
    <section>
        {{-- course name/title --}}
        <div>
            <div>
                <h1>Marketing Fundamentals</h1>
                {{-- subheaders --}}
                <div>
                    <div>
                        
                    </div>
                </div>
            </div>
            <div></div>
        </div>
    </section>
</section>
@include('partials.footer')