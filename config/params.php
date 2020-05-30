<?php

use kartik\datecontrol\Module;

return [
    'adminEmail' => getenv('PAYPAL_EMAIL') ,
    'payPalClientId' => getenv('PAYPAL_ID') ,
    'payPalClientSecret' => getenv('PAYPAL_SECRET'),
    // 'senderEmail' => 'noreply@example.com',
    // 'senderName' => 'Example.com mailer',
    'smtpUsername' => 'yiijjujerez@gmail.com',
    'bsVersion' => '4.x', // this will set globally `bsVersion` to Bootstrap 4.x for all Krajee Extensions
    'dateControlDisplay' => [
        Module::FORMAT_DATE => 'php:d-m-Y',
        Module::FORMAT_TIME => 'php:H:i:s',
        Module::FORMAT_DATETIME => 'php:d-m-Y H:i:s', 
    ],
    // GUARDAR - format settings for saving each date attribute (PHP format example)
    'dateControlSave' => [
        Module::FORMAT_DATE => 'php:Y-m-d', // saves as unix timestamp
        Module::FORMAT_TIME => 'php:H:i:s',
        Module::FORMAT_DATETIME => 'php:Y-m-d H:i:s',
    ],

    'icon-framework' => 'fa', 

    'googleMapsUrlOptions' => [
        'key' => getenv('API_KEY'),
        'version' => '3.40',
        'language' => 'es', 
        
    ],

    'googleMapsOptions' => [
        'mapTypeId' => 'roadmap',
        'tilt' => 45,
        'zoom' => 100,
    ],
];
