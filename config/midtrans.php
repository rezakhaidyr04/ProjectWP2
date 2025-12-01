<?php

return [
    'merchant_id' => env('MIDTRANS_MERCHANT_ID', 'G123456'),
    'client_key' => env('MIDTRANS_CLIENT_KEY', ''),
    'server_key' => env('MIDTRANS_SERVER_KEY', ''),
    'is_production' => env('MIDTRANS_IS_PRODUCTION', false),
    'sanitize' => env('MIDTRANS_SANITIZE', true),
];
