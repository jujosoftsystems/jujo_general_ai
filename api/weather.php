<?php
    /*
        Weather API 

        @RobertC 1/15/2023
    */

    $param_1 = $_GET['place'];


    function define_weather($weather_value){

        switch ($weather_value){
            case "clear":
                $weather_value_define = "Total cloud cover less than 20%";
                break;
            case "pcloudy":
                $weather_value_define = "Total cloud cover between 20%-60%";
                break;
            case "mcloudy":
                $weather_value_define = "Total cloud cover between 60%-80%";
                break;
            case "cloudy":
                $weather_value_define = "Total cloud cover over over 80%";
                break;
            case "humid":
                $weather_value_define = "Relative humidity over 90% with total cloud cover less than 60%";
                break;
            case "lightrain":
                $weather_value_define = "Precipitation rate less than 4mm per hour with total cloud cover more than 80%";
                break;
            case "oshower":
                $weather_value_define = "Precipitation rate less than 4mm per hour with total cloud cover between 60%-80%";
                break;
            case "ishower":
                $weather_value_define = "Precipitation rate less than 4mm per hour with total cloud cover less than 60%";
                break;
            case "lightsnow":
                $weather_value_define = "Precipitation rate less than 4mm per hour";
                break;
            case "rain":
                $weather_value_define = "Precipitation rate over 4mm per hour";
                break;
            case "snow":
                $weather_value_define = "Precipitation rate over 4mm per hour";
                break;
            case "rainsnow":
                $weather_value_define = "Precipitation type to be ice pellets or freezing rain";
                break;
            case "ts":
                $weather_value_define = "Lifted Index less than -5 with precipitation rate below 4mm per hour";
                break;
            case "tsrain":
                $weather_value_define = "Lifted Index less than -5 with precipitation rate over 4mm per hour";
                break;
            default:
                $weather_value_define = "Sorry can't tell the weather right now!";
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
            //"result"=>  $api_2_result["dataseries"][0]["weather"],
            "error"=> $error_msg
        );

        // JSON array data
        header("Content-Type: application/json");
        print(json_encode($weather_abilitie_response, JSON_PRETTY_PRINT));

    }

    weather_abilitie($param_1);
?>