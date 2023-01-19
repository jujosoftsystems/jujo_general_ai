<?php
    /*
        Count API 
    */

    $param_1 = $_GET['startnum'];
    $param_2 = $_GET['endnum'];

    function count_abilitie($start_value, $end_value){

        $error_msg = "None all good"; // <-- default
        $result = ""; // <-- default

        // Check for user input errors
        if(empty($start_value) || empty($end_value)){
            if($start_value != 0 || $end_value != 0){
                $error_msg = "Sorry input parameters can't be blank or null.";
            }
        }

        if(is_numeric($start_value) && is_numeric($end_value)){

            if($start_value > $end_value){
                $error_msg = "Sorry first parameter cannot be greater than the second one.";
            }
            else{
                // Do the actual count
                $result_array = [];
                for($i = $start_value; $i<= $end_value; $i++) {
                    array_push($result_array, $i);
                }

                // Array to string!
                $result = implode(" ", $result_array);
            }
        }
        else{
            $error_msg = "Sorry input parameters can't be letters or characters.";
        }
       
        // Array for API!
        $count_abilitie_response = array(
            "api_id"=> "1",
            "result"=> $result,
            "error"=> $error_msg
        );

        // JSON array data
        header("Content-Type: application/json");
        print(json_encode($count_abilitie_response, JSON_PRETTY_PRINT));
    }

    count_abilitie($param_1, $param_2);
?>