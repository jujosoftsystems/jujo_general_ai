<?php
    /*
        Help API
    */
    function help_abilitie(){
        
        $error_msg = "None all good"; // <-- default
        $result = "Here are some abilities i have so far. I can give you  random quote by typing into the chat input quote or quotes. If you will like to know the weather 
                    I can help with that. Type weather fallow by the place. For example: weather Bastrop TX."; 
      
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