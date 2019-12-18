<?php

use Illuminate\Support\Str;

function getAnonymizedClientIpAddress($ip = null)
{

    return preg_replace(['/\.\d*$/','/[\da-f]*:[\da-f]*$/'], ['.xxx','xxxx:xxxx'], [ $ip ?? getClientIpAddress() ])[0];
}

function getClientIpAddress()
{
    return request()->server->get('HTTP_X_FORWARDED_FOR') ?
        explode(',', request()->server->get('HTTP_X_FORWARDED_FOR'))[0] :
        request()->server->get('REMOTE_ADDR');
}

function generateAvatar()
{
    $bgColor = [
        'blue',
        'gray',
        'green',
        'indigo',
        'orange',
        'purple',
        'red',
        'teal',
        'yellow',
    ];

    return "bg-{$bgColor[rand(0, count($bgColor)-1)]}-500";
}
function http_response($code)
{
    return \Symfony\Component\HttpFoundation\Response::$statusTexts[$code];
}

function normalizePhoneNumber($phoneNumber)
{
    return preg_replace('/\s|-/', '', $phoneNumber);
}

function normalizeString($string)
{
    return str_replace(' ', '_', preg_replace('/[^\d\sa-z]+/i', '', preg_replace("/&([a-z])[a-z]+;/i", "$1", strtolower(htmlentities(html_entity_decode($string))))));
}

function randomFileName($extension)
{
    return  Str::random(20) . '.' . $extension;
}

function normalizeDateForGoogleAds($date)
{
    return str_replace('-', '', strtolower($date));
}
