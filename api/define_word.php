<?php
    /*
       Define a word API
    */

    $param_1 = $_GET['word'];

    function define_word_abilitie($word_value){

        $error_msg = "None all good"; // <-- default
        $result = ""; // <-- default

        // Check for user input errors
        if(empty($word_value)){      
            $error_msg = "Sorry input parameters can't be blank or null.";     
        }

        if(is_numeric($word_value)){
            $error_msg = "Sorry input parameters can't be a number."; 
        }

        // Call external API
        $response_1 = file_get_contents('https://api.dictionaryapi.dev/api/v2/entries/en/'.$word_value);
        $api_1_result = json_decode($response_1, true);
    
        if(!empty($api_1_result )){
            $result = $api_1_result[0]['meanings'][0]['definitions'][0]['definition']; 
        }
        else{
            $result = "Sorry can't find that definition or word! Also make sure not to pass a numeric value.";
        }

        // Array for API!
        $define_word_response = array(
            "api_id"=> "7",
            "result"=> $result,
            "error"=> $error_msg
        );

        // JSON array data
        header("Content-Type: application/json");
        print(json_encode($define_word_response, JSON_PRETTY_PRINT));

    }

    define_word_abilitie($param_1);

?>