<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>DeliveBoo</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    {{-- <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet"> --}}
    {{-- FontAwesom --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    {{-- Favicon --}}
    <link rel="shortcut icon" href="{{asset('/img/fav.ico')}}">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    {{-- VUE --}}
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.12"></script>
    
</head>

<body>
    <div id="app">
        <div id="root">
            <nav id="dashboard-nav" class="app-navbar">
                <div class="app-navbar-container">
                    <a class="navbar-logo" href="{{ url('/') }}">
                        <img src="{{ asset("/img/logo.png") }}" alt="">
                    </a>
                    {{-- <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                        <span class="navbar-toggler-icon"></span>
                    </button> --}}
    
                    <div class="nav-left-side{{--collapse navbar-collapse--}}">
                        <!-- Left Side Of Navbar -->
                        <ul class=" {{--mr-auto--}}">
    
                        </ul>
    
                        <!-- Right Side Of Navbar -->
                        <ul class="nav-left-link{{--navbar-nav ml-auto--}}">
                            <!-- Authentication Links -->
                            @guest
    
                                <li class="drop-display-none{{--nav-item--}}">
                                    <a class="{{--nav-link--}}" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                                @if (Route::has('register'))
                                    <li class="drop-display-none{{--nav-item--}}">
                                        <a class="{{--nav-link--}}" href="{{ route('register') }}">{{ __('Register') }}</a>
                                    </li>
                                @endif

                                <div v-on:click="toggleCrossBurger()" class="burger-menu">
                                    <div v-bind:id="upperBar" class="line upper black-bar"></div>
                                    <div v-bind:id="crossRightBurgerBar" class="line middle black-bar"></div>
                                    <div v-bind:id="crossLeftBurgerBar" class="line middle black-bar"></div>
                                    <div v-bind:id="lowerBar" class="line lower black-bar"></div>
                                </div>
                                <div id="slider-standard" class="log-reg" v-bind:class="toggledSlider">
                                    
                                    <a  class="" href="{{ url('dashboard') }}">
                                        Login
                                    </a>
    
                                    <a class="" href="{{ route('admin.foods.index') }}">
                                        Registrati
                                    </a>
    
                                </div>
    
                            @else                       
    
                                
                                <li class="nav-item dropdown drop-display-none">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        {{ Auth::user()->name }}
                                    </a>                               
    
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
    
                                        <a  class="dropdown-item dashboard-drop-link" href="{{ url('dashboard') }}">
                                            Torna alla Dashboard
                                        </a>
    
                                        <a class="dropdown-item dashboard-drop-link" href="{{ route('admin.foods.index') }}">
                                            Gestisci i tuoi piatti
                                        </a>
    
                                        <a class="dropdown-item dashboard-drop-link" href="{{ route('admin.foods.create') }}">
                                            Aggiungi un piatto
                                        </a>
    
                                        <a class="dropdown-item dashboard-drop-link" href="{{ route('admin.orders.index') }}">
                                            Gestisci ordini
                                        </a>
        
    
                                        <a class="dropdown-item dashboard-drop-link" href="{{ route('logout') }}"
                                           onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>
    
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>                           
                                    </div>                              
                                </li>                             
                                
                                <div v-on:click="toggleCrossBurger()" class="burger-menu">
                                    <div v-bind:id="upperBar" class="line upper black-bar"></div>
                                    <div v-bind:id="crossRightBurgerBar" class="line middle black-bar"></div>
                                    <div v-bind:id="crossLeftBurgerBar" class="line middle black-bar"></div>
                                    <div v-bind:id="lowerBar" class="line lower black-bar"></div>
                                </div>
                                <div id="slider-standard" class="dash-slider" v-bind:class="toggledSlider">
                                    
                                    <a  class="" href="{{ url('dashboard') }}">
                                        Torna alla Dashboard
                                    </a>
    
                                    <a class="" href="{{ route('admin.foods.index') }}">
                                        Gestisci i tuoi piatti
                                    </a>
    
                                    <a class="" href="{{ route('admin.foods.create') }}">
                                        Aggiungi un piatto
                                    </a>
    
                                    <a class="" href="{{ route('admin.orders.index') }}">
                                        Gestisci ordini
                                    </a>
      
                                    <a class="" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
    
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>   
                                </div>         
                    
                            @endguest                     
                            
    
                        </ul>
    
                    </div>
                </div>
            </nav>
        </div>

        
        <main class="">
            @yield('content')
        </main>

    </div>


    {{-- gsap --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.6.1/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.6.1/ScrollTrigger.min.js"></script>

    {{-- my script --}}
    <script src="{{ asset("js/main.js") }}"></script>
    <script src="{{ asset("js/gsapAnimations.js") }}"></script>
</body>
</html>
