<?php
    /*
        Find me API 

        external API to be user: https://get.geojs.io/v1/ip/geo.json
    */

    function find_me_abilitie(){
        
        $error_msg = "None all good"; // <-- default
        $result = ""; // <-- default

        $result = "find me test!";
      
        // Array for API!
        $find_me_abilitie_response = array(
            "api_id"=> "5",
            "result"=> $result,
            "error"=> $error_msg
        );

        // JSON array data
        header("Content-Type: application/json");
        print(json_encode($find_me_abilitie_response, JSON_PRETTY_PRINT));
    }

    find_me_abilitie(); 
?>