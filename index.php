<?php
    require 'Src/Classes/Club';
    require 'Src/Classes/League';
    require 'Src/Controllers/LeagueController.php';
    require 'Src/Classes/Player';
        
    $master_array = [];
    
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

        array_push($master_array, $this_league);
    }  
    
    // for($i = 0; $i < sizeof($master_array); $i++) {
    //     print_r($master_array[$i]);
    //     echo "<br><br>";
    // } 
?>