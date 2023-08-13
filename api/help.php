<?php
    /*
        Help API
    */
    function help_abilitie(){
        
        $error_msg = "None all good"; // <-- default
        $result = "Testing..."; 
      
        // Array for API!
        $help_abilitie_response = array(
            "api_id"=> "2",
            "result"=> $result,
            "error"=> $error_msg
        );

        // JSON array data
        header("Content-Type: application/json");
        print(json_encode($help_abilitie_response, JSON_PRETTY_PRINT));
    }

    help_abilitie();

?>