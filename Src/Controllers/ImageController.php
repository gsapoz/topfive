<?php

function getClubImage($url) {
    //returns an image source for a club crest from the provided url
    $crest_url = "";

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $html = curl_exec($ch);
    
    $dom = new DOMDocument();
    @ $dom->loadHTML($html);

    $images = $dom->getElementsByTagName("img");
    
    return $images[1]->getAttribute('src');
    
}

function getLeagueImage($url) {
     //returns an image source for a league crest from the provided url
     $crest_url = ""; 
     return $crest_url;
}

?>