<?php
    /*
        News API 

        @RobertC 3/20/2023
    */

    // Array for API!
    $news_abilitie_response = array(
        "api_id"=> "4",
        "result"=> $result,
        "error"=> $error_msg
    );

    // JSON array data
    header("Content-Type: application/json");
    print(json_encode($news_abilitie_response, JSON_PRETTY_PRINT));



?>