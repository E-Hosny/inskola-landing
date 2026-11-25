<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Google Analytics 4
    |--------------------------------------------------------------------------
    |
    | Set GA4_MEASUREMENT_ID in .env (example: G-XXXXXXXXXX).
    | Leave empty to disable tracking scripts in all environments.
    |
    */

    'ga4_measurement_id' => env('GA4_MEASUREMENT_ID', ''),

    /*
    |--------------------------------------------------------------------------
    | Google Ads (optional)
    |--------------------------------------------------------------------------
    */

    'google_ads_id' => env('GOOGLE_ADS_ID', ''),

    /*
    |--------------------------------------------------------------------------
    | Enabled environments
    |--------------------------------------------------------------------------
    */

    'enabled' => (bool) env('ANALYTICS_ENABLED', true),

];
