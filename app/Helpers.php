<?php

use Carbon\Carbon;

if (!function_exists('youtube')) {
    function youtube($url)
    {
        preg_match("/^(?:http(?:s)?:\/\/)?(?:www\.)?(?:youtu\.be\/|youtube\.com\/(?:(?:watch)?\?(?:.*&)?v(?:i)?=|(?:embed|v|vi|user)\/))([^\?&\"'>]+)/", $url, $possible_id);

        return $possible_id[1];
    }
}

if (!function_exists('simpleDate')) {
    function simpleDate($datetime)
    {
        return Carbon::parse($datetime)->format('d.m.Y');
    }
}


if (!function_exists('dataAndTime')) {
    function dataAndTime($datetime)
    {
        return Carbon::parse($datetime)->toDayDateTimeString();
    }
}
