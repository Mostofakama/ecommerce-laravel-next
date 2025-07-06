<?php

return [

    /*
    |--------------------------------------------------------------------------
    | SSLCommerz Store ID
    |--------------------------------------------------------------------------
    |
    | This is your store ID provided by SSLCommerz. Use the testbox ID for
    | sandbox environment. Change to live ID before going to production.
    |
    */

    'store_id' => env('SSL_STORE_ID', 'testbox'),

    /*
    |--------------------------------------------------------------------------
    | SSLCommerz Store Password
    |--------------------------------------------------------------------------
    |
    | This is your store password. You can get it from your SSLCommerz account.
    | Use the default 'qwerty' for sandbox testing.
    |
    */

    'store_password' => env('SSL_STORE_PASSWORD', 'qwerty'),

    /*
    |--------------------------------------------------------------------------
    | Sandbox Mode
    |--------------------------------------------------------------------------
    |
    | Set this to true if you are testing in development (sandbox).
    | Set to false in production/live server.
    |
    */

    'sandbox' => env('SSL_SANDBOX', true),

    /*
    |--------------------------------------------------------------------------
    | Default Callback URLs
    |--------------------------------------------------------------------------
    |
    | You can override these URLs in runtime, but default values are useful.
    | These are used by SSLCommerz to redirect after payment actions.
    |
    */

    'success_url' => env('SSL_SUCCESS_URL', '/payment/success'),
    'fail_url'    => env('SSL_FAIL_URL', '/payment/fail'),
    'cancel_url'  => env('SSL_CANCEL_URL', '/payment/cancel'),

];
