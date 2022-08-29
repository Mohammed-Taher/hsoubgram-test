<nav x-data="{ open: false }" class="bg-white border-b border-gray-300">
    <!-- Primary Navigation Menu -->
    <div class="w-full max-w-5xl mx-auto px-4">
        <div class="flex sm:justify-between h-16">
            <div class="grow sm:grow-0 flex flex-row items-center">
                <!-- Logo -->
                <div class="flex items-center grow">
                    <a href="{{ route('home_page') }}">
                        <x-application-logo class="block h-7 w-auto fill-current text-gray-600"/>
                    </a>
                </div>


            </div>

            <!-- Search -->
            <div class="hidden sm:flex sm:items-center">
                <form action="/search">
                    <input type="text" name="search"
                           class="w-56 lg:w-72 border-none bg-gray-100 rounded-xl h-10 focus:ring-0"
                           placeholder="Search.."/>
                </form>
            </div>
            <!-- Settings Dropdown -->
            @guest()
                <div class="flex items-center space-x-3">
                    <a href="/login" class="text-sm text-gray-700 dark:text-gray-500 underline">{{__('Login')}}</a>
                    <a href="/register"
                       class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">{{__('Reigster')}}</a>
                </div>
            @endguest
            @auth
                <div class="flex items-center justify-center space-x-3">
                    <div class="space-x-3 text-[1.6rem] mr-2 leading-5">
                        <a href="{{ route('home_page') }}">
                            {!! (url()->current() == route('home_page')) ? '<i class="bx bxs-home-alt-2"></i>' : '<i class="bx bx-home-alt-2"></i>' !!}
                        </a>
                        <a href="{{ route('explore') }}">
                            {!! (url()->current() == route('explore')) ? '<i class="bx bxs-compass"></i>' : '<i class="bx bx-compass"></i>' !!}
                        </a>
                        <a href="{{ route('create_post') }}">
                            {!! (url()->current() == route('create_post')) ? '<i class="bx bxs-message-square-add"></i>' : '<i class="bx bx-message-square-add"></i>' !!}
                        </a>
                    </div>
                    <!-- Navigation Links -->
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button
                                class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                                <div><img class="w-6 h-6 rounded-full" src="{{auth()->user()->image}}"></div>

                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link
                                :href="route('user_profile', ['user'=> auth()->user()->username])">{{ __('Profile') }}</x-dropdown-link>
                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <x-dropdown-link :href="route('logout')"
                                                 onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                </div>
            @endauth


        </div>
    </div>

</nav>
