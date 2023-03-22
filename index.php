<?php
    require 'Src/Classes/Club';
    require 'Src/Classes/League';
    require 'Src/Classes/Player';
    require 'Src/Controllers/ImageController.php';
    require 'Src/Controllers/LeagueController.php';
        
    $master_array = [];
    
    $master_array = getLeagues($master_array);

    $json = json_encode($master_array);

    //TO-DO: 
    //  1. Have this logic trigger on button click 
    //  2. Write this json to a file and download
    echo $json; //final product
  
?>