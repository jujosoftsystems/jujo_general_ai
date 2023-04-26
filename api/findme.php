<?php
    /*
        Find me API 

        external API to be user: https://get.geojs.io/v1/ip/geo.json

        return data example:

        {
            "city":"Bastrop",
            "accuracy":20,
            "timezone":"America\/Chicago",
            "longitude":"-97.2921",
            "organization":"AS7018 ATT-INTERNET4",
            "asn":7018,"ip":"2600:1700:2290:2740:bc16:ff9d:5f38:9770",
            "area_code":"0",
            "organization_name":"ATT-INTERNET4",
            "country_code":"US",
            "country_code3":"USA",
            "continent_code":"NA",
            "country":"United States",
            "region":"Texas",
            "latitude":"30.1388"
        }
        
    */

    function find_me_abilitie(){
        
        $error_msg = "None all good"; // <-- default
        $result = ""; // <-- default

       // Call external API
       $response_1 = file_get_contents('https://get.geojs.io/v1/ip/geo.json');
       $api_1_result = json_decode($response_1, true);

       $result = "You are in ". $api_1_result["city"];
      
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