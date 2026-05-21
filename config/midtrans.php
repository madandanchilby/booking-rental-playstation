<?php

return [
    'server_key' => env('MIDTRANS_SERVER_KEY', ''),
    'client_key' => env('MIDTRANS_CLIENT_KEY', ''),
    'is_production' => env('MIDTRANS_IS_PRODUCTION', false),
    'is_sanitized' => true,
    'is_3ds' => true,

    // Sandbox URLs
    'sandbox_base_url' => 'https://app.sandbox.midtrans.com/snap/v1',
    'production_base_url' => 'https://app.midtrans.com/snap/v1',

    // Simulator URL (for reference)
    'simulator_url' => 'https://simulator.sandbox.midtrans.com/',
];
