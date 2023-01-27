<?php
    /*
        Weather API 

        @RobertC 1/15/2023
    */

    $param_1 = $_GET['place'];

    function weather_abilitie($place_value){

        $error_msg = "None all good"; // <-- default
        $result = ""; // <-- default

        // Need to make sure $place_value is a string not int before passing to the first API!

        // Call first API and get parameters need it for second API
        $response_1 = file_get_contents('https://geocode.maps.co/search?q='.$place_value);
        $api_1_result = json_decode($response_1, true);
        $lat_param = $api_1_result[0]["lat"];
        $lon_param = $api_1_result[0]["lon"];

        // "astro", "civil", "civillight"
        // more info on this API ---> https://github.com/Yeqzids/7timer-issues/wiki/Wiki
        $response_2 = file_get_contents('https://www.7timer.info/bin/civillight.php?lon='.$lon_param.'&lat='.$lat_param.'&ac=0&unit=metric&output=json');
        $api_2_result = json_decode($response_2, true);
/*
        foreach ($api_2_result as $index) {
            $result = $index[2]." ";
        }
*/     
        $result = $api_2_result["dataseries"][0]["weather"];
        
        // Array for API!
        $weather_abilitie_response = array(
            "api_id"=> "3",
            "result"=> $result,
            "error"=> $error_msg
        );

        // JSON array data
        header("Content-Type: application/json");
        print(json_encode($weather_abilitie_response, JSON_PRETTY_PRINT));

    }

    weather_abilitie($param_1);
?>