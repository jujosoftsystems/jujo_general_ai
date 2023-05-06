<?php
    /*
        Crypto API 

        to get crypto prices

        https://api.coincap.io/v2/assets
    */

     // Call external news API
     $response_1 = file_get_contents('https://api.coincap.io/v2/assets');
     $api_1_result = json_decode($response_1, true);

     $result = "";

    // Array for API!
    $crypto_abilitie_response = array(
        "api_id"=> "4",
        "result"=>  $api_1_result,
        "error"=> $error_msg
    );

    // JSON array data
    header("Content-Type: application/json");
    print(json_encode($crypto_abilitie_response, JSON_PRETTY_PRINT));
?>