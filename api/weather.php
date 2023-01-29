<?php
    /*
        Weather API 

        @RobertC 1/15/2023
    */

    $param_1 = $_GET['place'];


    function define_weather($weather_value){

        switch ($weather_value){
            case '':
                $weather_value_define = "";
                break;
            case '':
                $weather_value_define = "";
                break;
            case '':
                $weather_value_define = "";
                break;
            case '':
                $weather_value_define = "";
                break;
            case '':
                $weather_value_define = "";
                break;
            case '':
                $weather_value_define = "";
                break;
            case '':
                $weather_value_define = "";
                break;
            case '':
                $weather_value_define = "";
                break;
        } 

        return $weather_value_define;
    }

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

        /* Need definitions for 
           API json return data example:
           -------------------------------------
            "weather": "pcloudy",
                "temp2m": {
                    "max": 14,
                    "min": 7
                },
                "wind10m_max": 3
            -------------------------------------
            for weather:
                clear   --->	Total cloud cover less than 20%
                pcloudy	--->	Total cloud cover between 20%-80%
                cloudy	--->	Total cloud cover over 80%
                rain	--->	Rain
                snow	--->	Snow
                ts		--->	Thunderstorm
                tsrain	--->	Thunderstorm with rain

             -------------------------------------
             for temp2m:
                max ---> 2m max temperature in Censius
                min ---> 2m min temperature in Censius

             -------------------------------------
             for wind10m_max:
                1	--->    Below 0.3m/s (calm)
                2	--->    0.3-3.4m/s (light)
                3	--->    3.4-8.0m/s (moderate)
                4	--->    8.0-10.8m/s (fresh)
                5	--->    10.8-17.2m/s (strong)
                6	--->    17.2-24.5m/s (gale)
                7	--->    24.5-32.6m/s (storm)
                8	--->    Over 32.6m/s (hurricane)

        */


/*
        foreach ($api_2_result as $index) {
            $result = $index[2]." ";
        }
*/     
        $result = define_weather($api_2_result["dataseries"][0]["weather"]);
        
        // Array for API!
        $weather_abilitie_response = array(
            "api_id"=> "3",
            "result"=>  $result,
            "error"=> $error_msg
        );

        // JSON array data
        header("Content-Type: application/json");
        print(json_encode($weather_abilitie_response, JSON_PRETTY_PRINT));

    }

    weather_abilitie($param_1);
?>