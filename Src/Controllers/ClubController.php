<?php
function getSquadURL($url) {

    // Find the position of "team/"
    $pos = strpos($url, "team/");

    // If "team/" is found
    if ($pos !== false) {
        // Insert "squad/" after "team/"
        $newString = substr_replace($url, "squad/", $pos + strlen("team/"), 0);
    } else {
        // "team/" not found, do something else
        $newString = $url;
    }

    // Output the new string
    return $newString;
}

function getClubPage($club) {
   $url = "https://www.espn.com/soccer/teams/_/league/" . "ENG.1/" . "english-premier-league";
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $html = curl_exec($ch);
    
    $dom = new DOMDocument();
    @ $dom->loadHTML($html);

    $headings = $dom->getElementsByTagName("h2");

    foreach($headings as $i) {
        if ($i->nodeValue == $club){
            //Add a "squad/" after "team/" and before "_/" 
            // return $i->parentNode->getAttribute('href'); 
            return $cluburl = getSquadURL($i->parentNode->getAttribute('href'));
        }
    }
}

function getClubPlayers($club) {
    $url = getClubPage($club);
    $url = "https://www.espn.com" . $url;
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $html = curl_exec($ch);
    
    $dom = new DOMDocument();
    @ $dom->loadHTML($html);

    $anchors = $dom->getElementsByTagName("a");

    $x = 0;
    $players = [];
    foreach($anchors as $i) {
        if ($i->nodeValue == "POS" || str_word_count($i->nodeValue) > 5) $x = 0;
        if ($i->nodeValue === "RC" || $x > 0)  $x++; 
        if ($x > 0 && $i->nodeValue != 'RC') {
            $this_player = new Player();
            $this_player->name = $i->nodeValue;
            $this_player->position = $i->parentNode->parentNode->nextSibling->nodeValue;
            $this_player->age = $i->parentNode->parentNode->nextSibling->nextSibling->nodeValue;
            $this_player->height = $i->parentNode->parentNode->nextSibling->nextSibling->nextSibling->nodeValue;
            $this_player->weight = $i->parentNode->parentNode->nextSibling->nextSibling->nextSibling->nextSibling->nodeValue;
            $this_player->nationality = $i->parentNode->parentNode->nextSibling->nextSibling->nextSibling->nextSibling->nextSibling->nodeValue;

            array_push($players, $this_player);
            
            
        }
    }

    $json = json_encode($players);
    print_r($json);
}


?>