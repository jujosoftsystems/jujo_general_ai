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

         // Work in progress!

         // Testing
         $result = $word_value;

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