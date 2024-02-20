@extends('layouts.landing_layout')

@section('content')
    <section class="relative w-full text-sm">
        <nav class="fixed top-0 z-50 w-full bg-darthmouthgreen start-0">
            <div class="flex flex-wrap items-center justify-between max-w-screen-xl px-4 py-2 mx-auto">
                <div>
                    <h1 class="self-center text-2xl font-semibold whitespace-nowrap">Eskwela4EveryJuan</h1>
                </div>
                <ul class="flex flex-row items-center justify-center divide-seagreen">
                    <li><a class="px-3 py-2" href="">Home</a></li>
                    <li><a class="px-3 py-2" href="">About</a></li>
                    <li><a class="px-3 py-2" href="">BPLO</a></li>
                    <li><a class="px-3 py-2" href="">Services</a></li>
                    <li><a class="px-3 py-2" href="">Contacts</a></li>
                </ul>
                <div class="flex flex-row items-center divide-x divide-seagreen">
                    <x-forms.primary-button
                    color="ashgray"
                    name="Get Started"
                    type="submit"
                    class="px-0">
                    </x-forms.primary-button>
                </div>                
            </div>
        </nav>

        <section class="relative w-full h-screen px-2 py-4 pt-16 text-black bg-white">
            <div class="flex flex-wrap justify-between h-full max-w-screen-xl mx-auto">
                <div id="left" class="flex flex-col justify-center w-1/2">
                    <div class="space-y-4">
                        <h1 class="w-3/4 text-5xl font-bold text-darthmouthgreen">Next-Level Learning, Made Easy.</h1>
                        <p class="text-sm text-justify">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Vel aliquid nisi ea veniam minima, aut provident quas laboriosam veritatis fugit mollitia quia pariatur iusto natus vitae quasi deserunt at rerum.Consequuntur non sit maxime deserunt. Obcaecati molestias ipsa possimus deserunt enim? Nulla nam fugiat dignissimos quidem quam distinctio porro ipsum ducimus atque officiis. Reprehenderit temporibus distinctio obcaecati, velit culpa laboriosam.</p>
                    </div>

                    <div class="flex flex-row items-center justify-end my-4 text-sm">
                        <x-forms.primary-button
                        color="ashgray"
                        name="Sign in as Learner"
                        type="submit"
                        class="text-black ">
                        </x-forms.primary-button>

                        <x-forms.primary-button
                        color="darthmouthgreen"
                        name="Sign in as Instructor"
                        type="submit"
                        class="text-white">
                        </x-forms.primary-button>
                    </div>
                </div>

                <div id="right" class="w-1/2">
                    <div class="flex items-center justify-end w-full h-full">
                        <div class="w-3/5 bg-red-500 h-4/5"></div>
                    </div>
                </div>            
            </div>
        </section>

        <section class="relative w-full h-screen px-2 py-4 pt-16 text-black">
            <div class="flex flex-wrap justify-between h-full max-w-screen-xl mx-auto">
                <div id="left" class="w-1/2">
                    <div class="flex items-center justify-center w-full h-full">
                        <div class="w-3/5 bg-red-500 h-4/5"></div>
                    </div>
                </div>                       
                <div id="right" class="flex flex-col justify-center w-1/2">
                    <div class="space-y-4">
                        <div class="flex flex-row w-4/5">
                            <span class="mx-2 text-4xl">&#8212;</span>
                            <h1 class="text-3xl font-bold">About our Learning Management System</h1>
                        </div>
                        
                        <p class="text-sm text-justify">Lorem ipsum dolor sit amet consectetur adipisicing elit. Et sint aliquam nemo labore. Omnis quam ab cumque vero nihil reiciendis itaque illo, veritatis tempore dolor necessitatibus quaerat tenetur quod natus.
                        Dolor, dolorum? Quae neque at molestiae incidunt corrupti, impedit harum veritatis placeat, consectetur nemo quidem dolorum temporibus, quo tempore! In nisi quo dolores quas, culpa autem eligendi harum optio eum.
                        Doloribus sint consequatur illum unde exercitationem recusandae maiores. Ullam, ea totam accusamus architecto reiciendis consequuntur, consectetur nisi fugit non, ut deserunt harum nesciunt dolore nobis natus animi pariatur vel. Asperiores.
                        Magnam nobis ullam hic voluptatibus quasi sint officiis suscipit rem ea placeat odio dolor possimus labore itaque nesciunt obcaecati, fuga quia amet, recusandae impedit. Nam itaque officia ex optio a!</p>
                    
                        <div>
                            <span><a class="font-medium text-darthmouthgreen hover:text-seagreen hover:underline" href="">Read more <i class="mx-1 fa-solid fa-arrow-right"></i></a></span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="relative w-full h-screen px-2 py-4 pt-16 text-black">
            <div class="h-full max-w-screen-xl mx-auto space-y-10">
                <div class="flex flex-row w-4/5 my-2">
                    <span class="text-4xl ">&#8212;</span>
                    <h1 class="text-3xl font-bold">Business Permits and Licensing Office</h1>
                </div>
                <div class="space-y-4 text-base text-center">
                    <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Iure, possimus. Officia quibusdam provident iste ad expedita? Nobis minus, reiciendis, maxime vitae expedita necessitatibus molestiae vero consectetur dolores, nostrum itaque inventore.
                    Possimus cumque distinctio iusto porro quisquam totam quia! Optio, earum voluptatum? Fuga omnis, qui ipsam ullam eius odit magni quae ratione aperiam unde iure totam, corporis officia alias earum illum.
                    Ex, veniam voluptate ducimus, libero quo sed in, temporibus saepe esse soluta unde! In corporis aliquid sint nobis minus totam quisquam, commodi exercitationem dolorum nemo, vel suscipit eveniet temporibus sed.
                    Dolores culpa dignissimos tempora quis numquam sint, labore dolore provident quidem nisi! Fuga sit perspiciatis dolores veniam quas fugiat natus, vel dignissimos, eius illum reiciendis. Qui totam quis ex corrupti?
                    Perferendis culpa adipisci molestiae sapiente sint. Quae necessitatibus similique atque sint harum magni natus ex earum incidunt fugit rem repudiandae illo minima ipsam, delectus dignissimos doloribus, aliquid eaque quia doloremque.</p>
                    <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Iure, possimus. Officia quibusdam provident iste ad expedita? Nobis minus, reiciendis, maxime vitae expedita necessitatibus molestiae vero consectetur dolores, nostrum itaque inventore.
                    Possimus cumque distinctio iusto porro quisquam totam quia! Optio, earum voluptatum? Fuga omnis, qui ipsam ullam eius odit magni quae ratione aperiam unde iure totam, corporis officia alias earum illum.
                    Ex, veniam voluptate ducimus, libero quo sed in, temporibus saepe esse soluta unde! In corporis aliquid sint nobis minus totam quisquam, commodi exercitationem dolorum nemo, vel suscipit eveniet temporibus sed.
                    Dolores culpa dignissimos tempora quis numquam sint, labore dolore provident quidem nisi! Fuga sit perspiciatis dolores veniam quas fugiat natus, vel dignissimos, eius illum reiciendis. Qui totam quis ex corrupti?
                    Perferendis culpa adipisci molestiae sapiente sint. Quae necessitatibus similique atque sint harum magni natus ex earum incidunt fugit rem repudiandae illo minima ipsam, delectus dignissimos doloribus, aliquid eaque quia doloremque.</p>
                </div>
            </div>
        </section>

        <section class="relative w-full h-screen px-2 py-4 pt-16 text-black">
            <div class="h-full max-w-screen-xl mx-auto space-y-10">
                <div class="flex flex-row w-4/5 my-2">
                    <span class="text-4xl ">&#8212;</span>
                    <h1 class="text-3xl font-bold">Services</h1>
                </div>

                <div class="flex items-center justify-center">
                    <div class="max-w-sm mx-2 border border-gray-200 rounded-lg">
                        <a href="">
                            <img class="rounded-t-lg" src="https://cdn2.wanderlust.co.uk/media/1008/kemeri-bog-from-above.jpg?anchor=center&mode=crop&width=1200&height=0&rnd=132162153630000000" alt="">
                        </a>
                        <div class="p-2">
                            <a href="">
                                <h3 class="mb-2 text-2xl font-medium">Service 1</h3>
                            </a>
                            <p class="h-32 mb-3 overflow-hidden overflow-ellipsis card-p">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Hic debitis recusandae sequi quibusdam reprehenderit voluptatum, aut praesentium corporis ducimus eligendi minima dignissimos magni tempore dolorem, odit consequatur omnis! Corrupti, accusantium!</p>
                            
                            <x-forms.primary-button
                            color="ashgray"
                            name="Read more"
                            type="submit"
                            class="px-0">
                            <i class="ml-2 fa-solid fa-arrow-right"></i>
                            </x-forms.primary-button>
                        </div>
                    </div>

                    <div class="max-w-sm mx-2 border border-gray-200 rounded-lg">
                        <a href="">
                            <img class="rounded-t-lg" src="https://cdn2.wanderlust.co.uk/media/1008/kemeri-bog-from-above.jpg?anchor=center&mode=crop&width=1200&height=0&rnd=132162153630000000" alt="">
                        </a>
                        <div class="p-2">
                            <a href="">
                                <h3 class="mb-2 text-2xl font-medium">Service 1</h3>
                            </a>
                            <p class="h-32 mb-3 overflow-hidden overflow-ellipsis card-p">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Hic debitis recusandae sequi quibusdam reprehenderit voluptatum, aut praesentium corporis ducimus eligendi minima dignissimos magni tempore dolorem, odit consequatur omnis! Corrupti, accusantium!</p>
                            
                            <x-forms.primary-button
                            color="ashgray"
                            name="Read more"
                            type="submit"
                            class="px-0">
                            <i class="ml-2 fa-solid fa-arrow-right"></i>
                            </x-forms.primary-button>
                        </div>
                    </div>

                    <div class="max-w-sm mx-2 border border-gray-200 rounded-lg">
                        <a href="">
                            <img class="rounded-t-lg" src="https://cdn2.wanderlust.co.uk/media/1008/kemeri-bog-from-above.jpg?anchor=center&mode=crop&width=1200&height=0&rnd=132162153630000000" alt="">
                        </a>
                        <div class="p-2">
                            <a href="">
                                <h3 class="mb-2 text-2xl font-medium">Service 1</h3>
                            </a>
                            <p class="h-32 mb-3 overflow-hidden overflow-ellipsis card-p">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Hic debitis recusandae sequi quibusdam reprehenderit voluptatum, aut praesentium corporis ducimus eligendi minima dignissimos magni tempore dolorem, odit consequatur omnis! Corrupti, accusantium!</p>
                            
                            <x-forms.primary-button
                            color="ashgray"
                            name="Read more"
                            type="submit"
                            class="px-0">
                            <i class="ml-2 fa-solid fa-arrow-right"></i>
                            </x-forms.primary-button>
                        </div>
                    </div>                    
                </div>

            </div>
        </section>

        <footer class="p-4 antialiased shadow bg-darthmouthgreen sm:flex sm:items-center sm:justify-between sm:p-6 xl:p-8">
            <p class="mb-4 text-sm text-center sm:mb-0">
                &copy; 2019-2022 <a href="" class="hover:underline" target="_blank">Eskwela4EveryJuan</a>. All rights reserved.
            </p>
            <div class="flex items-center justify-center space-x-1">
                <a href="#" data-tooltip-target="tooltip-facebook" class="inline-flex justify-center p-2 text-gray-500 rounded-lg cursor-pointer dark:text-gray-400 dark:hover:text-white hover:text-gray-900 hover:bg-gray-100 dark:hover:bg-gray-600">
                    <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 8 19">
                        <path fill-rule="evenodd" d="M6.135 3H8V0H6.135a4.147 4.147 0 0 0-4.142 4.142V6H0v3h2v9.938h3V9h2.021l.592-3H5V3.591A.6.6 0 0 1 5.592 3h.543Z" clip-rule="evenodd"/>
                    </svg>
                    <span class="sr-only">Facebook</span>
                </a>
                <div id="tooltip-facebook" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                    Like us on Facebook
                    <div class="tooltip-arrow" data-popper-arrow></div>
                </div>
                <a href="#" data-tooltip-target="tooltip-twitter" class="inline-flex justify-center p-2 text-gray-500 rounded-lg cursor-pointer dark:text-gray-400 dark:hover:text-white hover:text-gray-900 hover:bg-gray-100 dark:hover:bg-gray-600">
                    <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path fill="currentColor" d="M12.186 8.672 18.743.947h-2.927l-5.005 5.9-4.44-5.9H0l7.434 9.876-6.986 8.23h2.927l5.434-6.4 4.82 6.4H20L12.186 8.672Zm-2.267 2.671L8.544 9.515 3.2 2.42h2.2l4.312 5.719 1.375 1.828 5.731 7.613h-2.2l-4.699-6.237Z"/>
                    </svg>
                    <span class="sr-only">Twitter</span>
                </a>
                <div id="tooltip-twitter" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                    Follow us on Twitter
                    <div class="tooltip-arrow" data-popper-arrow></div>
                </div>
                <a href="#" data-tooltip-target="tooltip-github" class="inline-flex justify-center p-2 text-gray-500 rounded-lg cursor-pointer dark:text-gray-400 dark:hover:text-white hover:text-gray-900 hover:bg-gray-100 dark:hover:bg-gray-600">
                    <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 .333A9.911 9.911 0 0 0 6.866 19.65c.5.092.678-.215.678-.477 0-.237-.01-1.017-.014-1.845-2.757.6-3.338-1.169-3.338-1.169a2.627 2.627 0 0 0-1.1-1.451c-.9-.615.07-.6.07-.6a2.084 2.084 0 0 1 1.518 1.021 2.11 2.11 0 0 0 2.884.823c.044-.503.268-.973.63-1.325-2.2-.25-4.516-1.1-4.516-4.9A3.832 3.832 0 0 1 4.7 7.068a3.56 3.56 0 0 1 .095-2.623s.832-.266 2.726 1.016a9.409 9.409 0 0 1 4.962 0c1.89-1.282 2.717-1.016 2.717-1.016.366.83.402 1.768.1 2.623a3.827 3.827 0 0 1 1.02 2.659c0 3.807-2.319 4.644-4.525 4.889a2.366 2.366 0 0 1 .673 1.834c0 1.326-.012 2.394-.012 2.72 0 .263.18.572.681.475A9.911 9.911 0 0 0 10 .333Z" clip-rule="evenodd"/>
                    </svg>
                    <span class="sr-only">Github</span>
                </a>
                <div id="tooltip-github" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                    Star us on GitHub
                    <div class="tooltip-arrow" data-popper-arrow></div>
                </div>
                <a href="#" data-tooltip-target="tooltip-dribbble" class="inline-flex justify-center p-2 text-gray-500 rounded-lg cursor-pointer dark:text-gray-400 dark:hover:text-white hover:text-gray-900 hover:bg-gray-100 dark:hover:bg-gray-600">
                    <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 0a10 10 0 1 0 10 10A10.009 10.009 0 0 0 10 0Zm6.613 4.614a8.523 8.523 0 0 1 1.93 5.32 20.094 20.094 0 0 0-5.949-.274c-.059-.149-.122-.292-.184-.441a23.879 23.879 0 0 0-.566-1.239 11.41 11.41 0 0 0 4.769-3.366ZM8 1.707a8.821 8.821 0 0 1 2-.238 8.5 8.5 0 0 1 5.664 2.152 9.608 9.608 0 0 1-4.476 3.087A45.758 45.758 0 0 0 8 1.707ZM1.642 8.262a8.57 8.57 0 0 1 4.73-5.981A53.998 53.998 0 0 1 9.54 7.222a32.078 32.078 0 0 1-7.9 1.04h.002Zm2.01 7.46a8.51 8.51 0 0 1-2.2-5.707v-.262a31.64 31.64 0 0 0 8.777-1.219c.243.477.477.964.692 1.449-.114.032-.227.067-.336.1a13.569 13.569 0 0 0-6.942 5.636l.009.003ZM10 18.556a8.508 8.508 0 0 1-5.243-1.8 11.717 11.717 0 0 1 6.7-5.332.509.509 0 0 1 .055-.02 35.65 35.65 0 0 1 1.819 6.476 8.476 8.476 0 0 1-3.331.676Zm4.772-1.462A37.232 37.232 0 0 0 13.113 11a12.513 12.513 0 0 1 5.321.364 8.56 8.56 0 0 1-3.66 5.73h-.002Z" clip-rule="evenodd"/>
                    </svg>
                    <span class="sr-only">Dribbble</span>
                </a>
                <div id="tooltip-dribbble" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                    Follow us on Dribbble
                    <div class="tooltip-arrow" data-popper-arrow></div>
                </div>
            </div>
        </footer>
    </section>

    

@endsection