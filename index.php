<?php
    require 'classes/Club';
    require 'classes/League';
    require 'classes/Player';
        
    //url constructors
    $root = "https://www.eurosport.com/football";
    $leagues = [  "premier-league", "serie-a", "bundesliga", "ligue-1", "liga" ];
    $lgtail = "standings.shtml";

    $test_url = "https://www.eurosport.com/football/premier-league/standings.shtml";

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $test_url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $html = curl_exec($ch);

    $dom = new DOMDocument();
    @ $dom->loadHTML($html);

    $anchors = $dom->getElementsByTagName("a");
    $teams = [];
    $x = 0;
    
    foreach($anchors as $i) {
        if ($x >= 40) $x = 0;
        if ($i->textContent == "Previous winners" || $x > 0)  $x++; 
        if ($x > 0 && ($x %2 == 0)) array_push($teams, $i->textContent);
    }

    print_r($teams);
    


    
    // foreach($as as $as) {
    //     $a_text = $as->textContent;
    //     $a_array[] = $a_text;
    //     echo $a_text . "<br>";
    // }

    // // $leagues = ['47/overview/premier-league', '55/overview/serie-a', '54/overview/bundesliga',  '53/overview/ligue-1', '/87/overview/laliga'];

    // // $url = "https://www.itsgarys.com/topfiveleague/data.json";
    // // $url = "sa-index.json";
    
    // $data = file_get_contents("https://www.eurosport.com/football/premier-league/standings.shtml");
    // // $json = json_decode($json);
    // //absolute right-1 max-w-full truncate left-8 lg:caps-s5-fx hidden md:block

    // var_dump($data);
    // // var_dump(json_decode($data));


    // pre




    
    // $json = file_get_contents($url);
    // $json = json_decode($json);

    // foreach ($json as $i) { //traverses clubs
    //     echo $i;
    //     // print_r($i); echo "<br><br>";
    //     // echo $i->name; echo "<br><br>";
    //     // echo $i[1]->name . "<br>";
    //     // foreach ($$i as $j) { //traverses players
    //     //     // echo $j->name . "<br>";
    //     //     print_r($j) . "<br>";
    //     // }
        
    // }
    
    // print_r($json->Atalanta[0]->name); //returns "Juan Musso"
    // echo $json->Atalanta[0]->name; //returns "Juan Musso"
    /*  Therefore: We need */

    // $myfile = fopen("data.json", "w") or die("Unable to open file!");
    
    



    
    // $opening_tag = '{';
    // $serie_A ='"Serie A" : [{}],"';
    // $bundesliga = '"Bundesliga" :[{}],"';
    // $ligue1 = '"Ligue 1" : [{}],"';
    // $laliga = '"La Liga" : [{}], "';
    // $preml = '"Premier League" : [{}]"';
    // $closing_tag = '}';

    

    // $txt = $opening_tag . $serie_A . $closing_tag;
    // fwrite($myfile, $txt);






    // fclose($myfile);
?>