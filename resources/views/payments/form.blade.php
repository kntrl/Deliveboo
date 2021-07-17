@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    {{-- Order details --}}
    <div class="col-12 col-sm-6 col-md-7 mb-2">
      <div class="card">
          <div class="card-header">
            <div class="card-title">Riepilogo Ordine</div>
          </div>    
          <div class="card-body">
            <p>Piatti ordinati :</p>
            {{-- Order's foods list --}}
            <ul>
              @foreach ($order->foods as $food)
                <li>{{$food->name .' - qta '. $food->pivot->quantity}}</li>
              @endforeach
            </ul>  
            {{-- Order total price --}}
            <div>Totale: {{$order->price}}</div>
          </div>
      </div>
    </div>

    {{--Payment Form column --}}
    <div class="col-12 col-sm-6 col-md-5">
      <div class="card">
        <div class="card-header">
          <div class="card-title">
            Pagamento
          </div>
        </div>
        <div class="card-body">
          {{-- Payment Form --}}
          <form method="post" id="payment-form" action="{{route('guest.checkout',['order'=>$order])}}">
            @csrf
            @method('POST')
            <label for="address">Indirizzo di consegna</label>
            <input type="text" name="address" id="address" value="{{ $order->delivery_address }}">
            {{-- Droping UI di Braintree --}}
            <div class="bt-drop-in-wrapper">
                <div id="bt-dropin"></div>
            </div>
    
            <input id="nonce" name="payment_method_nonce" type="hidden" />
            <button class="btn btn-primary" type="submit"><span>Paga ora</span></button>

            {{-- Terms and conditions --}}
            <div>
              <small>Metodo di pagamento sicuro gestito da Braintree</small>
            </div>

        </form>
      </div>
    </div>
  </div>
</div>


<script src="https://js.braintreegateway.com/web/dropin/1.31.0/js/dropin.min.js"></script>
<script>
var form = document.querySelector('#payment-form');
var client_token = "<?php echo($clientToken) ?>";

braintree.dropin.create({
  authorization: client_token,
  selector: '#bt-dropin',
  paypal: {
    flow: 'vault'
  }
}, function (createErr, instance) {
  if (createErr) {
    console.log('Create Error', createErr);
    return;
  }
  form.addEventListener('submit', function (event) {
    event.preventDefault();

    instance.requestPaymentMethod(function (err, payload) {
      if (err) {
        console.log('Request Payment Method Error', err);
        return;
      }

      // Add the nonce to the form and submit
      document.querySelector('#nonce').value = payload.nonce;
      form.submit();
    });
  });
});
</script>
@endsection