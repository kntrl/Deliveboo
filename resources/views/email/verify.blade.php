<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <title>Document</title>
</head>
<body>
    
    
    <div Class="email-container">
        <div class="bg-email">            
                
            <div class="reg-email-container">
                <img src="{{asset('img/logo-piccolo-nero.svg')}}" alt="Deliveboo - Logo">
                <h1>Verifica la tua mail</h1>
                <h5>{{$userName}}</h5>
                <p>Per completare la registrazione è necessario verificare la tua email <a href="{{$url}}">cliccando qui</a> .</p>
                <p>Qualora il link non funzionasse copia e incolla questo indirizzo nel tuo broswer : </p>
                {{$url}}
            </div>         
            
        </div>        

    </div>


</body>
</html>