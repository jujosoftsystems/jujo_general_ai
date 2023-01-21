<?php
    /*
        Random quotes API 
    */
    function random_quotes_abilitie(){
        $error_msg = "None all good"; // <-- default
        $result = ""; // <-- default
        
        $rand_quote_num = rand(1, 6);

        switch ($rand_quote_num){
            case 1:
                $result = "A lady's imagination is very rapid; it jumps from admiration to love, from love to matrimony in a moment.  -Jane Austen";
              break;
            case 2:
                $result = "AI might be superior to humans.";
              break;
            case 3:
                $result = "Our lives begin to end the day we become silent about things that matter.  -Martin Luther King Jr.";
              break;
            case 4:
                $result = "Faith is taking the first step even when you can't see the whole staircase.  -Martin Luther King Jr.";
              break;
            case 5:
                $result = "If you can't explain it to a six year old, you don't understand it yourself.  -Albert Einstein";
              break;
            default:
                $result = "Sorry Can't think of any quotes right now!";
        }

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