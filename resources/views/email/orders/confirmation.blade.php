<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <title>Document</title>
</head>
<body>
    
    <div class="conf-email-container">
        <div class="logo-mail-cont">
            <img src="{{asset('img/logo-piccolo-nero.svg')}}" alt="Deliveboo - Logo">
            <div class="logo-row"></div>
        </div>

        <div class="">
            <h1>Grazie per il tuo ordine</h1>
            <p class="sub-n"> Ordine n° #00000{{--{{$order->id}}--}}</p>
            


            <h5>Ciao {{--{{$order->name}}--}}Ernesto,</h5>

            <p>Ti informiamo che il tuo ordine #00000{{--{{$order->id}}--}} è stato ricevuto </p>
            <p>L'importo totale pagato è {{--{{$order->price}}--}}</p>

            <h4>Riepilogo</h4>

            <div><strong>Numero ordine:</strong>  #00000{{--{{$order->id}}--}}</div>

            <div>
                <h5 class="your-dish">I tuoi piatti</h5>
                <ul>
                    {{--@foreach ($order->foods as $food)--}}
                        <li>    
                            <strong>Num. {{--{{$food->pivot->quantity}}--}}</strong> x {{--{{$food->name}}--}}
                            {{--@if($food->pivot->note)--}}
                                <div class="note">{{--{{$food->pivot->note}}--}}</div>
                            {{--@endif--}}
                        </li>
                    {{--@endforeach--}}
                </ul>
            </div>
        </div>
        
       

        
        
    </div>
    
</body>
</html>



