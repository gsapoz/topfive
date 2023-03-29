<?php



function getLeagues($array) {
    //returns a threee dimensional array of Leagues, Clubs, and Players
    $leagues = [ 
        "Premier League" => "premier-league", 
        "Serie A" => "serie-a", 
        "Bundesliga" => "bundesliga", 
        "Ligue 1" => "ligue-1", 
        "La Liga" => "liga" 
    ];

    foreach($leagues as $key => $league) {
        $clubs = getClubs($league);

        $this_league = new League();
        $this_league->name = $key;
        $this_league->clubs = $clubs;
        array_push($array, $this_league);
    }  

    return $array;
}

function getClubs($league) {
    //returns an array of Clubs for the given League
    $url = "https://www.eurosport.com/football/" . $league . "/standings.shtml";

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $html = curl_exec($ch);
    
    $dom = new DOMDocument();
    @ $dom->loadHTML($html);

    $anchors = $dom->getElementsByTagName("a");
    
    $clubs = []; 
    $x = 0;
    
    foreach($anchors as $i) {
        if ($x >= 40) $x = 0;
        if ($i->textContent == "Previous winners" || $x > 0)  $x++; 
        if ($x > 0 && ($x %2 == 0)) 
        {
            $team_name = $i->textContent;
            $club_url = $i->getAttribute('href');    //gets URL for this specific club
            $this_club = new Club();
            $this_club->name = $team_name;
            $this_club->image = getClubImage($club_url);

            array_push($clubs, $this_club);
        }
    }
    
    sort($clubs);
    
    return $clubs;
}


?>