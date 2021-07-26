<header>
    <nav id="nav-id">
        @if (Route::has('login'))
            <div class="top-right links">
                <img v-on:click="resetCategoryAndSlug()" src="{{ asset("/img/logo.png") }}" alt="Deliveboo logo">
                


                <div class="container-commands">
                    <div class="shown-commands">
                        @auth
                            <a href="{{ url('home') }}">Dashboard</a>
                        @else
                            <a id="ghosted-btn" href="{{ route('login') }}">Login</a>
    
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}">Register</a>
                            @endif
                        @endauth
                    </div>
    
                    

                    <div v-on:click="toggleCrossBurger()" class="burger-menu">
                        <div v-bind:id="upperBar" class="line upper black-bar"></div>
                        <div v-bind:id="crossRightBurgerBar" class="line middle black-bar"></div>
                        <div v-bind:id="crossLeftBurgerBar" class="line middle black-bar"></div>
                        <div v-bind:id="lowerBar" class="line lower black-bar"></div>
                    </div>
                </div>
            </div>
            <div id="slider-standard" v-bind:class="toggledSlider">
                @auth
                    <a href="{{ url('home') }}">Dashboard</a>
                @else
                    <a href="{{ route('login') }}">Login</a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}">Register</a>
                    @endif
                @endauth
            </div>
        @endif
    </nav>

</header>