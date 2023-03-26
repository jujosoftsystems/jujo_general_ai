<?php
    /*
        News API 
    */

    // Might use ---> https://saurav.tech/NewsAPI/top-headlines/category/general/us.json

    /*
            Available categories:
                business
                entertainment
                general
                health
                science
                sports
                technology
    */

     // Call external news API
     $response_1 = file_get_contents('https://saurav.tech/NewsAPI/top-headlines/category/general/us.json');
     $api_1_result = json_decode($response_1, true);

     // testing...
     $result = $api_1_result;

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