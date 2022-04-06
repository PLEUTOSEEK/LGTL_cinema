<?php

use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;

require 'PayPal-PHP-SDK/autoload.php';

// For test payments we want to enable the sandbox mode. If you want to put live
// payments through then this setting needs changing to `false`.
$enableSandbox = true;

// PayPal settings. Change these to your account details and the relevant URLs
// for your site.
$paypalConfig = [
    'client_id' => 'AfVvFGjxOV6j_sGlm5Uz1Rtwry_YLwK9uwqb8UYfnSUnxF9zoUQgh4xEubqu4DwXKiH5up1zxcaW8Utx',
    'client_secret' => 'EHpvn2TpObeCBcDVP9JVkgy9Wzz3cuhEez56vgiLsRWXcgh3vMlYRB6DPNa5hCET5QwWXVT_2vJYUsqH',
    'return_url' => 'http://localhost/LGTL_Cineplex/LGTL_cinema/ticket_booking/paypalEnv/response.php',
    'cancel_url' => 'http://localhost/LGTL_Cineplex/LGTL_cinema/home_page/home_page.php'
];

// Database settings. Change these for your database configuration.
$dbConfig = [
    'host' => 'localhost',
    'username' => 'root',
    'password' => '1234',
    'name' => 'lgtl_cinema'
];

$apiContext = getApiContext($paypalConfig['client_id'], $paypalConfig['client_secret'], $enableSandbox);

/**
 * Set up a connection to the API
 *
 * @param string $clientId
 * @param string $clientSecret
 * @param bool   $enableSandbox Sandbox mode toggle, true for test payments
 * @return \PayPal\Rest\ApiContext
 */
function getApiContext($clientId, $clientSecret, $enableSandbox = false) {
    $apiContext = new ApiContext(
            new OAuthTokenCredential($clientId, $clientSecret)
    );

    $apiContext->setConfig([
        'mode' => $enableSandbox ? 'sandbox' : 'live'
    ]);

    return $apiContext;
}
