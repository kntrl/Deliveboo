<?php
    return [
        'environment' => env('BRAINTREE_ENV'),
        'merchantId' => env('BRAINTREE_MERCHANT'),
        'publicKey' => env('BRAINTREE_PUBLIC'),
        'privateKey' => env('BRAINTREE_PRIVATE')
    ];