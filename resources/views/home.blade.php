<html>
<head>
    <title>Home</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>

</head>
<body class="bg-gray-200">

<nav class="bg-white shadow dark:bg-gray-800">
{{--    <div x-data="{ isOpen: false }" class="max-w-3xl mx-auto py-3 px-6 md:px-0 md:flex md:justify-between md:items-center">--}}
{{--        <div class="flex justify-between items-center">--}}
{{--            <div class="flex items-center">--}}
{{--                <img src="#" class="h-8 shadow rounded-full" alt="">--}}
{{--                <a href="#" class="text-gray-800 text-xl hover:text-gray-700 ml-4">David Grzyb</a>--}}
{{--            </div>--}}
{{--            <!-- Mobile menu button -->--}}
{{--            <div class="flex md:hidden">--}}
{{--                <button--}}
{{--                    type="button"--}}
{{--                    class="text-gray-500 hover:text-gray-600 focus:outline-none focus:text-gray-600"--}}
{{--                    aria-label="toggle menu"--}}
{{--                    @click="isOpen = !isOpen"--}}
{{--                >--}}
{{--                    <svg viewBox="0 0 24 24" class="h-6 w-6 fill-current">--}}
{{--                        <path fill-rule="evenodd" d="M4 5h16a1 1 0 0 1 0 2H4a1 1 0 1 1 0-2zm0 6h16a1 1 0 0 1 0 2H4a1 1 0 0 1 0-2zm0 6h16a1 1 0 0 1 0 2H4a1 1 0 0 1 0-2z"></path>--}}
{{--                    </svg>--}}
{{--                </button>--}}
{{--            </div>--}}
{{--        </div>--}}

{{--        <!-- Menu, if mobile set to hidden -->--}}
{{--        <div :class="isOpen ? 'show' : 'hidden'" class="md:flex items-center md:block mt-4 md:mt-0">--}}
{{--            <div class="flex flex-col md:flex-row md:ml-6">--}}
{{--               <a href="{{route("artists")}}" class="px-2 py-1 mx-2 mt-2 text-sm font-medium text-gray-700 transition-colors duration-200 transform rounded-md md:mt-0 dark:text-gray-200 hover:bg-gray-300 dark:hover:bg-gray-700">Artists</a>--}}
{{--                    <a href="{{route("albums")}}" class="px-2 py-1 mx-2 mt-2 text-sm font-medium text-gray-700 transition-colors duration-200 transform rounded-md md:mt-0 dark:text-gray-200 hover:bg-gray-300 dark:hover:bg-gray-700">Albums</a>--}}
{{--                    <a href="{{route("studios")}}" class="px-2 py-1 mx-2 mt-2 text-sm font-medium text-gray-700 transition-colors duration-200 transform rounded-md md:mt-0 dark:text-gray-200 hover:bg-gray-300 dark:hover:bg-gray-700">Studios</a>--}}
{{--                    @auth--}}
{{--                        @can('admin', auth()->user())--}}
{{--                            <a href="{{route("manageUsers")}}" class="px-2 py-1 mx-2 mt-2 text-sm font-medium text-gray-700 transition-colors duration-200 transform rounded-md md:mt-0 dark:text-gray-200 hover:bg-gray-300 dark:hover:bg-gray-700">Manage users</a>--}}
{{--                            <a href="{{route("showStudios")}}" class="px-2 py-1 mx-2 mt-2 text-sm font-medium text-gray-700 transition-colors duration-200 transform rounded-md md:mt-0 dark:text-gray-200 hover:bg-gray-300 dark:hover:bg-gray-700">Manage studios</a>--}}
{{--                        @endcan--}}
{{--                    @endauth--}}
{{--                    @auth--}}
{{--                        @can('artist', auth()->user())--}}
{{--                            <a href="{{route("artistAlbums")}}" class="px-2 py-1 mx-2 mt-2 text-sm font-medium text-gray-700 transition-colors duration-200 transform rounded-md md:mt-0 dark:text-gray-200 hover:bg-gray-300 dark:hover:bg-gray-700">Your Albums</a>--}}
{{--                            <a href="{{route("artistSongs")}}" class="px-2 py-1 mx-2 mt-2 text-sm font-medium text-gray-700 transition-colors duration-200 transform rounded-md md:mt-0 dark:text-gray-200 hover:bg-gray-300 dark:hover:bg-gray-700">Your Songs</a>--}}
{{--                        @endcan--}}
{{--                    @endauth--}}
{{--                @auth--}}
{{--                    <div class="flex align-middle justify-center items-center mt-4 md:mt-0">--}}

{{--                        <div class="px-3">--}}
{{--                            <form class="m-0" action="{{route("logout")}}" method="post">--}}
{{--                                @csrf--}}
{{--                                <button type="submit">Logout</button>--}}
{{--                            </form>--}}
{{--                        </div>--}}

{{--                        <div class="px-3">--}}
{{--                            {{auth()->user()->firstname}}--}}
{{--                        </div>--}}

{{--                    </div>--}}
{{--                @endauth--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}

{{--    DIV I VJETER--}}


    <div x-data="{ open: false }" class="container px-6 py-3 mx-auto">
        <div class="md:flex md:items-center md:justify-between">
            <div class="flex items-center justify-between">
                <div class="text-xl font-semibold text-gray-700">
                    <a class="text-xl font-bold text-gray-800 dark:text-white md:text-2xl hover:text-gray-700
                    dark:hover:text-gray-300" href="{{route('artists')}}">MusicMania</a>
                </div>

                <!-- Mobile menu button -->
                <div class="flex md:hidden">
                    <button  @click="open = !open" type="button" class="text-gray-500 dark:text-gray-200 hover:text-gray-600
                     dark:hover:text-gray-400 focus:outline-none focus:text-gray-600 dark:focus:text-gray-400"
                            aria-label="toggle menu">
                        <svg viewBox="0 0 24 24" class="w-6 h-6 fill-current">
                            <path fill-rule="evenodd" d="M4 5h16a1 1 0 0 1 0 2H4a1 1 0 1 1 0-2zm0
                                6h16a1 1 0 0 1 0 2H4a1 1 0 0 1 0-2zm0 6h16a1 1 0 0 1 0 2H4a1 1 0 0 1 0-2z">
                            </path>
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Mobile Menu open: "block", Menu closed: "hidden" -->
            <div :class="open ? 'show' : 'hidden'" @click.away="open = false"  class="flex-1 md:block md:flex md:items-center md:justify-between">
                <div  class="flex flex-col -mx-4 md:flex-row md:items-center md:mx-8">
                    <a href="{{route("artists")}}" class="px-2 py-1 mx-2 mt-2 text-sm font-medium text-gray-700 transition-colors duration-200 transform rounded-md md:mt-0 dark:text-gray-200 hover:bg-gray-300 dark:hover:bg-gray-700">Artists</a>
                    <a href="{{route("albums")}}" class="px-2 py-1 mx-2 mt-2 text-sm font-medium text-gray-700 transition-colors duration-200 transform rounded-md md:mt-0 dark:text-gray-200 hover:bg-gray-300 dark:hover:bg-gray-700">Albums</a>
                    <a href="{{route("studios")}}" class="px-2 py-1 mx-2 mt-2 text-sm font-medium text-gray-700 transition-colors duration-200 transform rounded-md md:mt-0 dark:text-gray-200 hover:bg-gray-300 dark:hover:bg-gray-700">Studios</a>
                    @auth
                        @can('admin', auth()->user())
                            <a href="{{route("manageUsers")}}" class="px-2 py-1 mx-2 mt-2 text-sm font-medium text-gray-700 transition-colors duration-200 transform rounded-md md:mt-0 dark:text-gray-200 hover:bg-gray-300 dark:hover:bg-gray-700">Manage users</a>
                            <a href="{{route("showStudios")}}" class="px-2 py-1 mx-2 mt-2 text-sm font-medium text-gray-700 transition-colors duration-200 transform rounded-md md:mt-0 dark:text-gray-200 hover:bg-gray-300 dark:hover:bg-gray-700">Manage studios</a>
                        @endcan
                    @endauth
                    @auth
                        @can('artist', auth()->user())
                            <a href="{{route("artistAlbums")}}" class="px-2 py-1 mx-2 mt-2 text-sm font-medium text-gray-700 transition-colors duration-200 transform rounded-md md:mt-0 dark:text-gray-200 hover:bg-gray-300 dark:hover:bg-gray-700">Your Albums</a>
                            <a href="{{route("artistSongs")}}" class="px-2 py-1 mx-2 mt-2 text-sm font-medium text-gray-700 transition-colors duration-200 transform rounded-md md:mt-0 dark:text-gray-200 hover:bg-gray-300 dark:hover:bg-gray-700">Your Songs</a>
                        @endcan
                    @endauth
                </div>
                @auth
                    <div class="flex flex-col -mx-2 md:flex-row md:align-middle md:justify-center md:items-center md:mt-0">

                        <div class="px-2">
                            <form class="m-0" action="{{route("logout")}}" method="post">
                                @csrf
                                <button type="submit">Logout</button>
                            </form>
                        </div>

                        <div class="px-2 py-1 font-bold ">
                            {{auth()->user()->firstname}}
                        </div>

                    </div>
                @endauth

            </div>
        </div>
    </div>
</nav>



    @yield('content')

</body>
</html>
