<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>DeliveBoo</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

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
        
        @include('partials/header')
        
        {{-- VUE ROOT --}}
        <div id="root">

            <div class="my-jumbotron">
    
                <div class="container">
                    <div class="row">
                        <div class="col-12 col-md-6 left-side">
                            <h1>Ordina i tuoi piatti preferiti direttamente dal tuo divano</h1>
                            <p>Piatti tipici da tutto il mondo, direttamente a casa tua</p>
                            <input type="text" name="" id="" placeholder="Cosa vorresti mangiare?">
                        </div>
                        
                        <div class="col-12 col-md-6 right-side">
                            <img src="{{asset("img/undraw_Hamburger_8ge6.png")}}" alt="">
                        </div>
                    </div>
                </div>
    
    
            </div>
    
    
    
            <div class="content">
                <main class="main-content">
                    <div class="container">
                        {{-- ROW 1 --}}
                        <div id="row1" class="row">
                            <div v-for="n in 4" class="col-sm-12 col-md-6 col-lg-3 card-temp">
                                <div class="inner-box">
                                    test
                                </div>
                            </div>
                        </div>
    
                        {{-- ROW 2 --}}
                        <div id="row2" class="row">
                            <div v-for="n in 4" class="col-sm-12 col-md-6 col-lg-3 card-temp">
                                <div class="inner-box">
                                    test
                                </div>
                            </div>
                        </div>
    
                        {{-- ROW 3 --}}
                        <div id="row3" class="row">
                            <div v-for="n in 4" class="col-sm-12 col-md-6 col-lg-3 card-temp">
                                <div class="inner-box">
                                    test
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
    
        

        @include('partials/footer')



        
        {{-- gsap --}}
        <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.6.1/gsap.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.6.1/ScrollTrigger.min.js"></script>

        {{-- my script --}}
        <script src="{{ asset("js/main.js") }}"></script>
        <script src="{{ asset("js/gsapAnimations.js") }}"></script>
    </body>
</html>
