<?php
    /*
        Find me API 
    */

    function find_me_abilitie(){
        
        $error_msg = "None all good"; // <-- default
        $result = ""; // <-- default

       // Call external API
       $response_1 = file_get_contents('https://get.geojs.io/v1/ip/geo.json');
       $api_1_result = json_decode($response_1, true);

       $result = "You are in ".$api_1_result["city"]." ".$api_1_result["region"]." ".$api_1_result["country"];
      
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