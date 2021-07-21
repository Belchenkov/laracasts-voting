<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Laracasts Voting</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Titillium+Web:wght@400;700;900&display=swap" rel="stylesheet">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
    </head>
    <body class="font-sans text-gray-900 text-sm bg-background">
        <header class="flex items-center justify-between px-8 py-4">
            <a href="/">
                <img src="{{asset('img/logo.svg')}}" alt="Logo">
            </a>
            <div class="flex items-center">
                @if (Route::has('login'))
                    <div class="px-6 py-4">
                        @auth
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <a
                                    href="{{route('logout')}}"
                                    onclick="event.preventDefault();
                                    this.closest('form').submit();"
                                >
                                    {{ __('Log Out') }}
                                </a>
                            </form>
                        @else
                            <a href="{{ route('login') }}" class="text-sm text-gray-700 underline">Log in</a>

                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 underline">Register</a>
                            @endif
                        @endauth
                    </div>
                @endif
                <a href="#">
                    <img
                        class="w-10 h-10 rounded-full"
                        src="https://www.gravatar.com/avatar/000000000000000000000?d=mp&f=y" alt="Avatar"
                    />
                </a>
            </div>
        </header>

        <main class="container mx-auto flex max-w-custom">
            <div class="w-70 mr-5">
                Add idea form goes here. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci aspernatur assumenda consequuntur corporis cum cumque delectus deleniti dolor dolore dolores ea ex facere fuga iusto maxime nesciunt officia pariatur perferendis quibusdam ratione reiciendis rem sapiente soluta tempora tempore, ut voluptate?
            </div>
            <div class="w-175">
                <nav class="flex items-center justify-between text-xs">
                    <ul class="flex uppercase font-semibold space-x-10 border-b-4 pb-3">
                        <li>
                            <a href="#" class="border-b-4 pb-3 border-blue">All Ideas (87)</a>
                        </li>
                        <li>
                            <a
                                href="#"
                                class="text-gray-400 transition duration-150 ease-in border-b-4 pb-3 hover:border-blue"
                            >Considering (6)</a>
                        </li>
                        <li>
                            <a
                                href="#"
                                class="text-gray-400 transition duration-150 ease-in border-b-4 pb-3 hover:border-blue"
                            >In Progress (1)</a>
                        </li>
                    </ul>

                    <ul class="flex uppercase font-semibold border-b-4 pb-3 space-x-10">
                        <li>
                            <a
                                href="#"
                                class="text-gray-400 transition duration-150 ease-in border-b-4 pb-3 hover:border-blue"
                            >Implemented (10)</a>
                        </li>
                        <li>
                            <a
                                href="#"
                                class="text-gray-400 transition duration-150 ease-in border-b-4 pb-3 hover:border-blue"
                            >Closed (55)</a>
                        </li>
                    </ul>
                </nav>

                <div class="mt-8">
                    {{ $slot }}
                </div>
            </div>
        </main>
    </body>
</html>
