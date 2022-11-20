<style>
    .hoverable {
        position: relative;
    }


    .hoverable-block {
        z-index: 5;
        visibility: hidden;
        position: absolute;
        opacity: 0;
        transform: translateY(25px);
        transition: all 250ms ease-in-out;

    }

    .hoverable-block-arrow {
        left: 35px;
        z-index: 4;
        visibility: hidden;
        position: absolute;
        opacity: 0;
        transform: translateY(0px);
        transition: all 250ms ease-in-out;
    }

    .hoverable:hover .hoverable-block {
        visibility: visible;
        transform: translateY(10px);
        opacity: 1;
    }


    .hoverable:hover .hoverable-block-arrow {
        visibility: visible;
        transform: translateY(-15px);
        opacity: 1;
    }

    .bg{
        background-image: url("/img/headbg.webp");
        background-position: center;
        background-position: top;
        background-repeat: no-repeat;
        background-attachment: fixed;
        background-color: #87acdf;
    }
</style>
{{-- a3c2f9 --}}
<div class="bg h-[372px]  mx-auto relative hidden sm:block">

</div>
<nav x-data="{ open: false }" class="bg-[#821d21] max-w-7xl mx-auto">
    <!-- Primary Navigation Menu -->
    <div id="menu" class="max-w-7xl mx-auto px-4 ">

        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="pl-2 flex items-center">
                    <a href="{{ route('home') }}">
                        <img class="h-12" src="{{ config('app.url', 'http://localhost') }}/img/gerb.webp">
                    </a>
                </div>

                <div class="flex items-center mx-3 text-lg font-medium text-yellow-500"><a href="{{ route('home') }}">
                        Гдов.online</a></div>

                <!-- Navigation Links -->
                <div class="hidden space-x-4 sm:-my-px sm:ml-10 sm:flex items-center translate">
                    {{-- <x-nav-link :href="route('home')" :active="request()->routeIs('home2')">
                        {{ __('Администрация') }}
                    </x-nav-link> --}}


                    <div class="hoverable p-3">
                        <div class="text-lg font-medium text-white">О районе</div>
                        <div
                            class="w-0 h-0 border-[15px] border-transparent border-b-[15px] border-b-white hoverable-block-arrow shadow-lg">
                        </div>
                        <div class="bg-white py-5 shadow-lg   hoverable-block ">

                            <div class="py-2 px-5 whitespace-nowrap hover:bg-gray-100"><a
                                    href="{{ route('culture.history') }}">История района</a> </div>
                            <div class="py-2 px-5 whitespace-nowrap hover:bg-gray-100"><a
                                    href="{{ route('culture.live') }}">Жизнь района</a> </div>
                        </div>
                    </div>



                    <div class="hoverable p-3">
                        <div class="text-lg font-medium text-white">Туризм</div>
                        <div
                            class="w-0 h-0 border-[15px] border-transparent border-b-[15px] border-b-white hoverable-block-arrow shadow-lg">
                        </div>
                        <div class="bg-white py-5 shadow-lg  hoverable-block">
                            <div class="py-2 px-5 whitespace-nowrap hover:bg-gray-100"><a
                                    href="{{ route('culture.map') }}">Интерактивная карта</a> </div>
                            <div class="py-2 px-5 whitespace-nowrap hover:bg-gray-100"><a
                                    href="{{ route('tourism.places') }}">Достопримечательности</a></div>

                        </div>
                    </div>


                    <div class="text-lg font-medium text-white p-3">
                        <a href="{{ route('posts') }}">События</a>
                    </div>



                </div>


            </div>




            <!-- Settings Dropdown -->
            @auth
                <div class="hidden sm:flex sm:items-center sm:mr-6">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button
                                class="flex items-center text-lg font-medium text-white hover:text-gray-200 hover:border-gray-300 focus:outline-none focus:text-gray-200 focus:border-gray-300 transition duration-150 ease-in-out">
                                <div>{{ Auth::user()->name }}</div>

                                <div class="ml-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                            this.closest('form').submit();">
                                    {{ __('Выйти') }}
                                </x-dropdown-link>
                            </form>
                            <x-dropdown-link :href="route('profile.news')">
                                {{ __('Профиль') }}
                            </x-dropdown-link>
                        </x-slot>
                    </x-dropdown>
                </div>
            @else
                <div class="hidden space-x-4  sm:ml-10 sm:flex sm:items-center sm:mr-6">
                    <x-nav-link :href="route('login')" :active="request()->routeIs('login')">
                        {{ __('Войти') }}
                    </x-nav-link>
                </div>
            @endauth
            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 rounded-md text-white hover:text-gray-200 hover:bg-[#2f6d59] focus:outline-none focus:bg-[#2f6d59] focus:text-white transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('home')">
                {{ __('История района') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('home')">
                {{ __('Центр досуга и культуры') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('home')">
                {{ __('Подвиги') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('home')">
                {{ __('Почетные граждане Гдова') }}
            </x-responsive-nav-link>
        </div>

        <div class="pt-4 pb-1 border-t border-gray-200"></div>

        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('home')">
                {{ __('Куда сходить') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('tourism.map')">
                {{ __('Достопримечательности') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('home')">
                {{ __('Базы отдыха') }}
            </x-responsive-nav-link>

        </div>

        <div class="pt-4 pb-1 border-t border-gray-200"></div>

        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('home')">
                {{ __('Инвестициии') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('home')">
                {{ __('Льготные программы') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('home')">
                {{ __('Документы') }}
            </x-responsive-nav-link>

        </div>
        <div class="pt-4 pb-1 border-t border-gray-200"></div>

        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('posts')">
                {{ __('Новости') }}
            </x-responsive-nav-link>


        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200"></div>
        @auth
            <div class="px-4">
                <div class="font-medium text-base text-white">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-300">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                        onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        @else
            <div class="pt-2 pb-3 space-y-1 ">
                <x-responsive-nav-link :href="route('login')">
                    {{ __('Войти') }}
                </x-responsive-nav-link>
            </div>


        @endauth


    </div>

</nav>
