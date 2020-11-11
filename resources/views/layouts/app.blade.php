<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <!-- <link rel="stylesheet" href="{{ asset('css/app.css') }}"> -->

       {{-- @livewireStyles --}} 

        <!-- Scripts -->
        <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.7.3/dist/alpine.js" defer></script>
        <style>
        .logout-btn {
            color:white;
            margin-right:20px;
            margin-top:15px;
        } 
        .logout-btn a:hover {
            color:white;
            text-decoration: none;
        }
        </style>
    </head>
    <body class="font-sans antialiased">
    <nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="navbar-header">
        <a class="navbar-brand" href="#">Todo App</a>
        </div>
        <ul class="nav navbar-nav ">
        @if (Route::has('login'))
        @auth 
        <li class="active"><a href="{{route('task.index')}}">Home</a></li>
        <li><a href="#">  
        {{ Auth::user()->name }}
        </a>
        </li>
        <!-- <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="caret"></span></a>
            <ul class="dropdown-menu">
            <li><a href="{{ route('profile.show') }}">Profile</a></li>
            <li><a href="#">Manage</a></li>
            <li><a href="#">Reset Password</a></li>
            </ul>
        </li> -->
        <li><a href="{{route('task.create')}}">  
            Add Task
        </a>
        <li><a href="{{route('taskcategory.create')}}">  
            Add Task Category
        </a>
        </li>
        <li><a href="{{route('taskcategory.index')}}">  
            Category List
        </a>
        </li>
        @endif
        @endif
        </ul>
        <ul class="nav navbar-nav navbar-right">
        @if (Route::has('login'))
        @auth
        <li>
        <form method="POST" action="{{ route('logout') }}" class="logout-btn">
        @csrf
        <a href="{{ route('logout') }}" onclick="event.preventDefault();
            this.closest('form').submit();" style="color:white;">
        <span class="glyphicon glyphicon-log-out"></span> Logout</a>
        </form>
        </li>
        @else
            @if (Route::has('register'))
                <li><a href="{{ route('register') }}"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
            @endif
            <li><a href="{{ route('login') }}"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
        @endif
        @endif
        </ul>
    </div>
    </nav>
    @yield('content')

 {{--       <div class="min-h-screen bg-gray-100">
            @livewire('navigation-dropdown')

            <!-- Page Heading -->
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
            </div>
            </header>
            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>

        @stack('modals')

        @livewireScripts --}}
    </body>
</html>
