<img src="asset{{'img/logo.png'}}" alt="Deliveboo - Logo">

<h1>Conferma ordine</h1>

<p>Gentile {{$order->name}}</p>,
<p>Grazie per il tuo ordine (#00000{{$order->id}}).</p> 
<p>L'importo totale pagato è {{$order->price}}</p>

<h3>Riepilogo Ordine</h3>
<ul>
    @foreach ($order->foods as $food)
        <li>    
            <strong>Num. {{$food->pivot->quantity}}</strong> x {{$food->name}}
            @if($food->pivot->note)
                <div class="note">{{$food->pivot->note}}</div>
            @endif
        </li>
    @endforeach
</ul>
