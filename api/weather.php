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
                $weather_value_define = "Total cloud cover over 80%";
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

    function define_wind($wind_value){

        switch ($wind_value){
            case 1:
                $wind_value_define = "Below 0.3 miles per second (calm)";
                break;
            case 2:
                $wind_value_define = "0.3-3.4 miles per second (light)";
                break;
            case 3:
                 $wind_value_define = "3.4-8.0 miles per second (moderate)";
                break;
            case 4:
                $wind_value_define = "8.0-10.8 miles per second (fresh)";
                break;
            case 5:
                $wind_value_define = "10.8-17.2 miles per second (strong)";
                break;
            case 6:
                $wind_value_define = "17.2-24.5 miles per second (gale)";
                break;
            case 7:
                $wind_value_define = "24.5-32.6 miles per second (storm)";
                break;
            case 8:
                $wind_value_define = "Over 32.6 miles per second (hurricane)";
                break;
        }

        return $wind_value_define;

    }

    function weather_abilitie($place_value){

        $error_msg = "None all good"; // <-- default
        $result = ""; // <-- default

        // Making sure $place_value is not composed of or have any numbers on it!
        if(preg_match('~[0-9]+~', $place_value)){
            $error_msg = "Sorry place value can't be a number!";
        }
        
        if(empty($place_value)){
            $error_msg = "Sorry place value can't be empty!";
        }

        // Call first API and get parameters need it for second API
        $response_1 = file_get_contents('https://geocode.maps.co/search?q='.$place_value);
        $api_1_result = json_decode($response_1, true);
        $lat_param = $api_1_result[0]["lat"];
        $lon_param = $api_1_result[0]["lon"];

        // more info on this API ---> https://github.com/Yeqzids/7timer-issues/wiki/Wiki
        $response_2 = file_get_contents('https://www.7timer.info/bin/civillight.php?lon='.$lon_param.'&lat='.$lat_param.'&ac=0&unit=metric&output=json');
        $api_2_result = json_decode($response_2, true);

        // Convert celsuis to fahrenheit!
        $cel_to_fah_max = $api_2_result["dataseries"][0]["temp2m"]["max"] * 1.8 + 32;
        $cel_to_fah_min = $api_2_result["dataseries"][0]["temp2m"]["min"] * 1.8 + 32;
        $temp = "and a temperature of a max of ".$cel_to_fah_max." fahrenheit and a minimum of ".$cel_to_fah_min." fahrenheit";
        $weather_full_result = define_weather($api_2_result["dataseries"][0]["weather"])." ".$temp." and wind ".define_wind($api_2_result["dataseries"][0]["wind10m_max"]);
      
        // Array for API!
        $weather_abilitie_response = array(
            "api_id"=> "3",
            "result"=> $weather_full_result,
            "error"=> $error_msg
        );

        // JSON array data
        header("Content-Type: application/json");
        print(json_encode($weather_abilitie_response, JSON_PRETTY_PRINT));

    }

    weather_abilitie($param_1);
?>