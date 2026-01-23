<!doctype html>
<html lang="en" class="h-full bg-gray-100">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>HPD Timesheet</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="h-full">
    <div class="min-h-full">
        <nav class="bg-gray-800">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="flex h-16 items-center justify-between">
                    <div class="flex items-center">
                        <div class="hidden md:block">
                            <div class="flex items-baseline space-x-4">
                                @auth
                                @if(auth()->user()->isAdmin())
                                <x-nav-link href="/timesheets" :active="request()->is('/timesheets')">Timesheets</x-nav-link>
                                @endif
                                <x-nav-link href="/my-timesheets" :active="request()->is('/my-timesheets')">My Timesheets</x-nav-link>
                                @endauth
                            </div>
                        </div>
                    </div>
                    <div class="hidden md:block">
                        <div class="ml-4 flex items-center md:ml-6">
                            @guest
                            <x-nav-link href="/login" :active="request()->is('login')">Log In</x-nav-link>
                            <x-nav-link href="/register" :active="request()->is('register')">Register</x-nav-link>
                            @endguest

                            @auth
                            <form method="POST" action="/logout">
                                @csrf

                                <x-form-button>Log Out</x-form-button>
                            </form>
                            @endauth
                        </div>
                    </div>
                    <div class="-mr-2 flex md:hidden">
                        <!-- Mobile menu button -->
                        <button type="button" class="relative inline-flex items-center justify-center rounded-md bg-gray-800 p-2 text-gray-400 hover:bg-gray-700 hover:text-white focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800" aria-controls="mobile-menu" aria-expanded="false">
                            <span class="absolute -inset-0.5"></span>
                            <span class="sr-only">Open main menu</span>
                            <!-- Menu open: "hidden", Menu closed: "block" -->
                            <svg class="block h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                            </svg>
                            <!-- Menu open: "block", Menu closed: "hidden" -->
                            <svg class="hidden h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Mobile menu, show/hide based on menu state. -->
            <div class="md:hidden" id="mobile-menu">
                <div class="space-y-1 px-2 pb-3 pt-2 sm:px-3">
                    <ul class="space-y-1 ml-2">
                        @auth
                        @if(auth()->user()->isAdmin())
                        <li>
                            <x-nav-link href="/timesheets" :active="request()->is('/timesheets')" class="block">Timesheets</x-nav-link>
                        </li>
                        @endif
                        <li>
                            <x-nav-link href="/my-timesheets" :active="request()->is('/my-timesheets')" class="block">My Timesheets</x-nav-link>
                        </li>
                        <li class="mt-2">
                            <form method="POST" action="/logout" class="px-3 py-2">
                                @csrf
                                <x-form-button>Log Out</x-form-button>
                            </form>
                        </li>
                        @endauth

                        @guest
                        <li>
                            <x-nav-link href="/login" :active="request()->is('login')" class="block">Log In</x-nav-link>
                        </li>
                        <li>
                            <x-nav-link href="/register" :active="request()->is('register')" class="block">Register</x-nav-link>
                        </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <header class="bg-white shadow">
            <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8 sm:flex sm:justify-between">
                <h1 class="text-3xl font-bold tracking-tight text-gray-900">{{ $heading }}</h1>

                @auth
                <div class="relative inline-block text-left mt-4 sm:mt-0">
                    <div>
                        <button type="button" id="create-dropdown-button" class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 leading-5 rounded-md hover:text-gray-500 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-300 dark:focus:border-blue-700 dark:active:bg-gray-700 dark:active:text-gray-300">
                            Create Timesheet
                            <svg class="-mr-1 ml-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </div>

                    <div id="create-dropdown-menu" class="hidden absolute right-0 z-10 mt-2 w-56 origin-top-right rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none dark:bg-gray-800">
                        <div class="py-1" role="none">
                            <a href="/timesheets/create" class="text-gray-700 block px-4 py-2 text-sm hover:bg-gray-100 hover:text-gray-900 dark:text-gray-300 dark:hover:bg-gray-700 dark:hover:text-gray-100" role="menuitem">Create Single Timesheet</a>
                            <a href="/timesheets/create-week" class="text-gray-700 block px-4 py-2 text-sm hover:bg-gray-100 hover:text-gray-900 dark:text-gray-300 dark:hover:bg-gray-700 dark:hover:text-gray-100" role="menuitem">Create Week</a>
                        </div>
                    </div>
                </div>
                @endauth
            </div>
        </header>

        <main>
            <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
                {{ $slot }}
            </div>
        </main>
    </div>

    <script>
        // Create Timesheet dropdown
        document.getElementById('create-dropdown-button').addEventListener('click', function() {
            const menu = document.getElementById('create-dropdown-menu');
            menu.classList.toggle('hidden');
        });

        // Mobile menu toggle (hamburger button)
        const mobileMenuButton = document.querySelector('[aria-controls="mobile-menu"]');
        const mobileMenu = document.getElementById('mobile-menu');

        if (mobileMenuButton && mobileMenu) {
            mobileMenuButton.addEventListener('click', function() {
                mobileMenu.classList.toggle('hidden');
            });
        }

        // Close dropdowns when clicking outside
        document.addEventListener('click', function(event) {
            const createButton = document.getElementById('create-dropdown-button');
            const createMenu = document.getElementById('create-dropdown-menu');

            if (createButton && createMenu && !createButton.contains(event.target) && !createMenu.contains(event.target)) {
                createMenu.classList.add('hidden');
            }
        });
    </script>
</body>

</html>