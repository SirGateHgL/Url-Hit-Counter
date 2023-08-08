<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Route Hit Counter Master Switch
    |--------------------------------------------------------------------------
    |
    | This option may be used to disable all Route Hit Counter watchers regardless
    | of their individual configuration, which simply provides a single
    | and convenient way to enable or disable Route Hit Counter data storage.
    |
    */

    'enabled' => env('ROUTE_HIT_COUNTER_ENABLED', true),

    /*
    |--------------------------------------------------------------------------
    | Route Hit Counter Route Middleware
    |--------------------------------------------------------------------------
    |
    | These middleware will be assigned to every Route Hit Counter route, giving you
    | the chance to add your own middleware to this list or change any of
    | the existing middleware. Or, you can simply stick with this list.
    |
    */

    'middleware' => [
        'web',
        'api',
    ],
];