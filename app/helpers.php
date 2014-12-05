<?php

function getFormattedDateForEntry($datetime) {
    return $datetime ? $datetime->format("Y-m-d") : "";
}

function imageWithSize($url, $width, $height) {
    if( strpos($url, '?') === FALSE ){
        return $url.'?width='.intval($width).'&height='.intval($height);
    }else{
        return $url.'&width='.intval($width).'&height='.intval($height);
    }
}
