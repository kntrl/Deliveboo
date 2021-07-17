<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>DeliveBoo</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
        {{-- <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet"> --}}

        <link rel="stylesheet" href="{{asset('css/app.css')}}">
        <!-- Styles --> 

        {{-- Favicon --}}
        <link rel="shortcut icon" href="{{asset('/img/fav.ico')}}">
        
        {{-- Axios CDN --}}
        <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"></script>
        {{-- VUE --}}
        <script src="https://cdn.jsdelivr.net/npm/vue@2.6.12"></script>

    </head>

    <body>
        
        
        {{-- VUE ROOT --}}
        <div id="root">
            
            @include('partials/header')

            <div v-if="!category.length" class="changing-box">
                {{-- JUMBOTRON --}}
                <section class="my-jumbotron">
                    <img class="jm-img milkshake" src="{{ asset('/img/milkshake.svg') }}" alt="">
                    <img class="jm-img panino" src="{{ asset('/img/panino.svg') }}" alt="">
                    <img class="jm-img pollo" src="{{ asset('/img/pollo.svg') }}" alt="">
                    <img class="jm-img ramen" src="{{ asset('/img/ramen.svg') }}" alt="">
                    <img class="jm-img taco" src="{{ asset('/img/taco.svg') }}" alt="">
                    <img class="jm-img uovo" src="{{ asset('/img/uovo.svg') }}" alt="">


                    <div class="my-wrap">
                        <div class="left-side">
                            <h1 id="main-title">Hungry? You're in the right place</h1>
                            <p>Piatti tipici da tutto il mondo, direttamente a casa tua</p>
                            <a href="#order-now">Order Now</a>
                        </div>
                    </div>
                </section>

                {{-- MAIN CONTENT --}}
                <div id="order-now" class="content">
                    <main class="main-content">
                        <div class="container">
                            {{-- ROW 1 --}}
                            <h2 id="anim-h2">Categories of Restaurants</h2>
                            <div id="row1" class="row"> 
                                <div v-for="(el, index) in categories" class="col-sm-12 col-md-6 col-lg-3 card-temp">
                                    <div v-on:click="selectCategory(el.name)" class="inner-box">
                                        <img class="category-img" v-bind:src="`img/${el.slug}.png`" alt="">
                                        <h3>@{{el.name.charAt(0).toUpperCase() + el.name.slice(1)}}</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </main>
                </div>
            </div>

            
            <div v-else class="restaurants-box">
                <div class="">
                    {{-- <img src="" alt=""> --}}
                    <h1>Ordina @{{category}}</h1>
                    {{-- <select v-on:change="selectCategory(category)" v-model="category" id="" name="">
                        <option v-for="category in categories">@{{category.name}}</option>
                    </select> --}}
                </div>

                <div class="double-box">
                    {{-- RIBBONS --}}
                    <div class="ribbons-box">
                        <div v-for="categoria in categories" class="container-ribbon">
                            <span v-on:click="selectCategory(categoria.name)" v-bind:class="categoria.name == category ? activeRibbon : ''" class="pointy">@{{categoria.name.charAt(0).toUpperCase() + categoria.name.slice(1)}}</span>
                        </div>
                    </div>

                    {{-- RESTAURANTS --}}
                    <div class="restaurants-cards-container">
                        <div v-if="restaurants.length" v-for="(restaurant, index) in this.restaurants[0]" class="restaurant-card">
                            <h6>@{{restaurant.name}}</h6>
                            <h6>@{{restaurant.address}}</h6>
                            <p>@{{(String(restaurant.description).length > 30) ? restaurant.description.slice(0, 30) + "..." : restaurant.description }}</p>
                            <button>Menù</button>
                        </div>
                    </div>
                </div>
            </div>
            
            @include('partials/footer')
        </div>
    
        




        
        {{-- gsap --}}
        <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.6.1/gsap.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.6.1/ScrollTrigger.min.js"></script>

        {{-- my script --}}
        <script src="{{ asset("js/main.js") }}"></script>
        <script src="{{ asset("js/gsapAnimations.js") }}"></script>
    </body>
</html>
