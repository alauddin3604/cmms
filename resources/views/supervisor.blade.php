<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @if (Auth::check())
    <meta name="user-id" content="{{ Auth::guard('supervisor')->user()->id }}">
    @endif

    <title>CMMS - Supervisor</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
    <div id="app">
        <div class="flex min-h-screen">
            <div class="w-60 h-screen shadow-md bg-gray-800 px-1 sticky top-0">
                <div class="pt-4 pb-2 px-6 mt-20 mb-5">
                    <div class="grid grid-flow-row place-items-center justify-center">
                        <div class="shrink-0 row-span-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-14 w-14 bg-white rounded-lg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                              </svg>
                        </div>
                        <div class="ml-3 row-span-1">
                            <p class="text-sm font-semibold text-white item-center">{{
                                Auth::guard('supervisor')->user()->name }}</p>
                            <p class="text-xs text-white">Supervisor</p>
                        </div>
                    </div>
                </div>
                <ul class="relative">
                    <li class="relative">
                        <router-link
                            class="flex items-center text-sm py-4 px-6 h-12 overflow-hidden text-slate-50 text-ellipsis whitespace-nowrap rounded transition duration-300 ease-in-out"
                            data-mdb-ripple="true" data-mdb-ripple-color="dark" to="/supervisor/dashboard">Dashboard
                        </router-link>
                    </li>
                    <li class="relative">
                        <router-link
                            class="flex items-center text-sm py-4 px-6 h-12 overflow-hidden text-slate-50 text-ellipsis whitespace-nowrap rounded transition duration-300 ease-in-out"
                            data-mdb-ripple="true" data-mdb-ripple-color="dark" :to="{ name : 'workOrderHistory' }">Work Order
                            History</router-link>
                    </li>
                </ul>
                <div class="text-center bottom-0 absolute w-full">
                    <a href="{{ route('logout') }}"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                        class="flex items-center text-sm py-4 px-6 h-12 overflow-hidden text-slate-50 text-ellipsis whitespace-nowrap hover:underline rounded transition duration-300 ease-in-out">Log
                        Out</a>
                </div>
            </div>
            <div class="flex-1 flex overflow-hidden bg-gray-100">
                <header class="fixed bg-gray-900 shadow-md z-50 w-full px-100 py-5 flex justify-between items-center">
                </header>
                <main
                    class="bg-gray-100 flex py-3 px-4 border-b w-full h-full p-4 m-8 overflow-y-auto overflow-x-visible justify-center">
                    <router-view></router-view>
                </main>
            </div>
            <form id="logout-form" action="{{ route('logout') }}" method="post" style="display: none;">
                @csrf
            </form>
        </div>
    </div>
</body>

</html>