<?php

return [
    'server_key' => env('MIDTRANS_SERVER_KEY', 'SB-Mid-client-zC3xMtvDV82h4jV5'),
    'client_key' => env('MIDTRANS_CLIENT_KEY', 'SB-Mid-server-idX_6BhlmmuwdtPI8H6LXESi'),
    'is_production' => env('MIDTRANS_IS_PRODUCTION', false),
    'is_sanitized' => env('MIDTRANS_IS_SANITIZED', true),
    'is_3ds' => env('MIDTRANS_IS_3DS', true),
];
