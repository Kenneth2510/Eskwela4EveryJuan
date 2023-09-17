@include('partials.header')
    <section class="absolute w-full h-screen bg-bottom bg-no-repeat bg-cover bg-homeImg -z-10"></section>
    
    <nav class="w-full px-4 py-4">
        <a href="#">
            <span class="self-center text-xl font-bold font-semibbold whitespace-nowrap md:text-2xl">
                Eskwela4EveryJuan
            </span>
        </a>
    </nav>  
    
    <header class="max-w-lg mx-auto mt-16 md:mx-10 md:max-w-xl lg:max-w-2xl">
        <h1 class="text-5xl font-bold text-center text-teal-700 md:leading-relaxed md:text-left md:text-5xl lg:text-6xl lg:leading-relaxed">
            Learn anything, anytime, anywhere
        </h1>
        <p class="mx-4 my-10 text-base text-center md:text-left md:text-xl lg:text-2xl md:max-w-lg lg:max-w-2xl">
            Lorem ipsum, dolor sit amet consectetur adipisicing elit. Iusto tempore aliquam aperiam iste et dolor, iure debitis! Adipisci ad libero eveniet molestias explicabo sunt eligendi. Autem similique suscipit amet neque.
        </p>
    </header>
    
    <section class="flex flex-col text-lg md:flex-row md:text-xl lg:text-2xl">
        <button class="h-16 mx-10 my-2 font-medium text-white rounded bg-darthmouthgreen md:w-52 md:rounded-xl md:mr-0 lg:h-20">
            Learner    
        </button>
        
        <button class="h-16 mx-10 my-2 font-medium bg-white rounded md:w-52 md:rounded-xl md:bg-transparent lg:w-60 lg:h-20">
            Sign in as Instructor
        </button>
    </section>
    
@include('partials.footer')