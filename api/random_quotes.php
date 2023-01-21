<?php
    /*
        Random quotes API 
    */
    function random_quotes_abilitie(){
        $error_msg = "None all good"; // <-- default
        $result = ""; // <-- default
        
        $result = rand(1, 5);


        // Array for API!
        $random_quotes_abilitie_response = array(
            "api_id"=> "2",
            "result"=> $result,
            "error"=> $error_msg
        );

        // JSON array data
        header("Content-Type: application/json");
        print(json_encode($random_quotes_abilitie_response, JSON_PRETTY_PRINT));
    }

    random_quotes_abilitie();
?>