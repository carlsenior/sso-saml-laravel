<?php

return [
    /*
    |--------------------------------------------------------------------------
    | SAML idP configuration file
    |--------------------------------------------------------------------------
    |
    | Use this file to configure the service providers you want to use.
    |
     */
    // Outputs data to your laravel.log file for debugging
    'debug' => true,
    // Define the email address field name in the users table
    'email_field' => 'email',
    // Define the name field in the users table
    'name_field' => 'name',
    // The URI to your login page
    'login_uri' => 'login',
    // Log out of the IdP after SLO
    'logout_after_slo' => env('LOGOUT_AFTER_SLO', false),
    // The URI to the saml metadata file, this describes your idP
    'issuer_uri' => 'metadata',
    // The certificate
    'cert' => env('SAMLIDP_CERT'),
    // Name of the certificate PEM file, ignored if cert is used
    'certname' => 'cert.pem',
    // The certificate key
    'key' => env('SAMLIDP_KEY'),
    // Name of the certificate key PEM file, ignored if key is used
    'keyname' => 'key.pem',
    // Encrypt requests and responses
    'encrypt_assertion' => true,
    // Make sure messages are signed
    'messages_signed' => false,
    // Defind what digital algorithm you want to use
    'digest_algorithm' => \RobRichards\XMLSecLibs\XMLSecurityDSig::SHA1,
    // list of all service providers
    'sp' => [
        // Base64 encoded ACS URL
         'aHR0cDovL2xvY2FsaG9zdDo4MDAwL3NhbWwyLzBlZjg3MWJhLTI5MzktNGI5ZS04Y2VkLTNhYmQwNTliMjgwOC9hY3M=' => [
             // Your destination is the ACS URL of the Service Provider
             'destination' => 'http://localhost:8000/saml2/0ef871ba-2939-4b9e-8ced-3abd059b2808/acs',
             'logout' => 'http://localhost:8000/saml2/0ef871ba-2939-4b9e-8ced-3abd059b2808/logout',

             // SP certificate
             'certificate' => 'MIID8TCCAtigAwIBAgIBADANBgkqhkiG9w0BAQUFADCBkTELMAkGA1UEBhMCdXMxETAPBgNVBAgMCE5ldyBZb3JrMQ4wDAYDVQQKDAVVYnlvdTEVMBMGA1UEAwwMdWJ5b3VhcHAuY29tMQswCQYDVQQHDAJOWTERMA8GA1UECwwIVWJ5b3VhcHAxKDAmBgkqhkiG9w0BCQEWGWNhcmwuc2VuaW9yLmRldkBnbWFpbC5jb20wHhcNMjMxMTIzMTMzNjA0WhcNMjQxMTIyMTMzNjA0WjCBkTELMAkGA1UEBhMCdXMxETAPBgNVBAgMCE5ldyBZb3JrMQ4wDAYDVQQKDAVVYnlvdTEVMBMGA1UEAwwMdWJ5b3VhcHAuY29tMQswCQYDVQQHDAJOWTERMA8GA1UECwwIVWJ5b3VhcHAxKDAmBgkqhkiG9w0BCQEWGWNhcmwuc2VuaW9yLmRldkBnbWFpbC5jb20wggEjMA0GCSqGSIb3DQEBAQUAA4IBEAAwggELAoIBAgCvyjyN6kMfWesqeVcZFZpRiifM3mQMGXFjuTG+B1NL9ReBraHaUFS3bf1ulpExxqdIYd76466StzrhFkKiIxK3c/8HkbUWSFIDgVZj7zCyMa6t57k9v4y4yVsYR7JjibKKgiVZEKksrxXTciGuzSaLVDPbwUdQ8FairPcMY/tLJg3YaCltAJ808lltNQZ+UDsmztvh4OlZBCo6FyPPhDnf0Via3jNJXlfI0+qw2pH+6VrqpWbkIrgIIIVYnc+9rjoPSAZCHA/8HeAuEHaEfNFEAO1GETpmr41UEOY+9WyzyGbKolP47t38olw1ygWCKyt2WJpyAf+dC6EMYHC5GMGfXwIDAQABo1AwTjAdBgNVHQ4EFgQUH4AUl/kQRE9tq2ExS4LfuRTSrBEwHwYDVR0jBBgwFoAUH4AUl/kQRE9tq2ExS4LfuRTSrBEwDAYDVR0TBAUwAwEB/zANBgkqhkiG9w0BAQUFAAOCAQIAmB3OAJdxaSTmzETNDx/WMkNGojI7CXhqxfVxMWvnGMsOIjKtpa7qWJEuKp/G1qZIS//8hH7uXMgyokwbdlvB2djPPiIRAaFIEFXy2GtV1fJ9Z/dQblNPyqf+CclbTaYHxXjCCdGC6otbBN3Lg0n6Uy8NxtEr3MR+BTZvwt8XMIsgi6mrw0AK0p0Htd0izfCr74e3gNSYICwp8umJRUXxF1zUdsF4CF0WqU8LG5Dr7K+owdlIYxZ7dwSJKHM7AysYG/mgaoNNFNBLa+zB0NPaYs1Eansz3y31ppHK3fn8ZYlu/wRLZZHCs9zFLNUyNoAXOJZGpOCfvqvv+2Hpm7VHtcM=',
            // Turn off auto appending of the idp query param
             'query_params' => false,
            // Turn off the encryption of the assertion per SP
             'encrypt_assertion' => false
         ]
    ],

    // If you need to redirect after SLO depending on SLO initiator
    // key is beginning of HTTP_REFERER value from SERVER, value is redirect path
    'sp_slo_redirects' => [
        'http://localhost:8000' => 'http://localhost:8000/logout'
    ],

    // All of the Laravel SAML IdP event / listener mappings.
    'events' => [
        'CodeGreenCreative\SamlIdp\Events\Assertion' => [],
        'Illuminate\Auth\Events\Logout' => ['CodeGreenCreative\SamlIdp\Listeners\SamlLogout'],
        'Illuminate\Auth\Events\Authenticated' => ['CodeGreenCreative\SamlIdp\Listeners\SamlAuthenticated'],
        'Illuminate\Auth\Events\Login' => ['CodeGreenCreative\SamlIdp\Listeners\SamlLogin'],
    ],

    // List of guards saml idp will catch Authenticated, Login and Logout events
    'guards' => ['web'],
];
