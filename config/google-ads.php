<?php
return [
    //Environment=> test/production
    'env' => 'test',
    //Google Ads
    'production' => [
        'developerToken' => "YOUR-DEV-TOKEN",
        'clientCustomerId' => "CLIENT-CUSTOMER-ID",
        'userAgent' => "YOUR-NAME",
        'clientId' => "CLIENT-ID",
        'clientSecret' => "CLIENT-SECRET",
        'refreshToken' => "REFRESH-TOKEN"
    ],
    'test' => [
        'developerToken' => "4G8DsNl4L1WM4rDhh3lvNg",
        'clientCustomerId' => "__clientCustomerId__",
        'userAgent' => "",
        'clientId' => "500676335322-nugdh2g2ll57cn59vo1gvrr74632ud43.apps.googleusercontent.com",
        'clientSecret' => "tfElDzkyaphkyaCmDVlH86lN",
        'refreshToken' => "1/hUz7KAKFR_6eRKgWpcunWsaK8aqHe7AIXWymNZdTHNA"
    ],
    'oAuth2' => [
        'authorizationUri' => 'https://accounts.google.com/o/oauth2/v2/auth',
        'redirectUri' => 'urn:ietf:wg:oauth:2.0:oob',
        'tokenCredentialUri' => 'https://www.googleapis.com/oauth2/v4/token',
        'scope' => 'https://www.googleapis.com/auth/adwords'
    ]
];
