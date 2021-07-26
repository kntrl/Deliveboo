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
    <title>Document</title>
</head>
<body style="font-family: 'Poppins';">

    <div class="email-container" style="width:70%;margin: auto;">
        <div class="bg-email" style="height: 240px; background-color: #fcecd5;">            
                
            <div 
                class="reg-email-container" 
                style="
                    width: 70%;
                    margin: auto;     
                    text-align: center;
                    background-color: white;
                    position: relative;
                    top: 115px;
                    border-radius: 20px;
                    margin-bottom: 20px;
                ">
                <img style="width: 180px;margin-top: 30px;" src="{{asset('img/logo-piccolo-nero.svg')}}" alt="Deliveboo - Logo">
                <h1 style="
                text-transform: uppercase;
                width: 50%;
                margin: auto;"
                >
                    Benvenuto in DeliveBoo
                </h1>
                <h5 style="margin-top: 50px;">Ciao {{$userName}} ,</h5>
                <p>Siamo lieti di confermarti la creazione del tuo account su DeliveBoo,</p>
                <p>ora fai parte del nostro team!</p>
            </div>
            
            
        </div>
        
        
    </div>
    
    
</body>
</html>

