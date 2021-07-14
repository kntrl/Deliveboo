<header>
    <nav id="nav-id">
        @if (Route::has('login'))
            <div class="top-right links">
                <img src="{{ asset("/img/logo.png") }}" alt="">
    
                <div class="container-commands">
                    <div class="shown-commands">
                        @auth
                            <a href="{{ url('home') }}">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}">Login</a>
    
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}">Register</a>
                            @endif
                        @endauth
                    </div>
    
                    {{-- da customizzare --}}
                    <div class="burger-menu">
                        <div class="black-bar"></div>
                        <div class="black-bar"></div>
                        <div class="black-bar"></div>
                    </div> 
                </div>
            </div>
        @endif
    </nav>

</header>