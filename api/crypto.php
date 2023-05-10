<?php
    /*
        Crypto API 

        to get crypto prices

        https://www.coinlore.com/cryptocurrency-data-api            <--- Docs about this external API

        https://api.coinlore.net/api/tickers/?start=0&limit=100     <--- To get top 100 crypto coins (rank 1 to 100!)
        https://api.coinlore.net/api/tickers/?start=100&limit=100   <--- To get coins from rank 100 to rank 200 crypto coins
        https://api.coinlore.net/api/ticker/?id=90                  <--- BTC id example

    */

    $param_1 = $_GET['coin'];

    function crypto_abilitie(){

        $error_msg = "None all good"; // <-- default
        $result = ""; // <-- default

        // Call external news API
        $response_1 = file_get_contents('https://api.coinlore.net/api/tickers/?start=0&limit=100');
        $api_1_result = json_decode($response_1, true);

        $response_2 = file_get_contents('https://api.coinlore.net/api/tickers/?start=100&limit=100');
        $api_2_result = json_decode($response_2, true);

        // Combine 2 external APIs to one array for the data we need!
        $result_array_1 = [];
        $result_array_2 = [];
        for($i = 0; $i<= 100; $i++){
            foreach($api_1_result as $index_1){
                if(!empty($index_1[$i]["name"]) && !empty($index_1[$i]["price_usd"])){
                    array_push($result_array_1, ["Coin: "=>$index_1[$i]["name"]," Price: "=>$index_1[$i]["price_usd"] ] );
                }
            }
        }
        
        for($i = 0; $i<= 100; $i++){
            foreach($api_2_result as $index_2){
                if(!empty($index_1[$i]["name"]) && !empty($index_1[$i]["price_usd"])){
                    array_push($result_array_2, ["Coin: "=>$index_1[$i]["name"]," Price: "=>$index_1[$i]["price_usd"] ] );
                }
            }
        }

        // Clean array
        $result_combine = array_merge($result_array_1, $result_array_2);
        // Final array for result
        $result =  $result_combine;

        // Array for API!
        $crypto_abilitie_response = array(
            "api_id"=> "6",
            "result"=>  $result,
            "error"=> $error_msg
        );

        // JSON array data
        header("Content-Type: application/json");
        print(json_encode($crypto_abilitie_response, JSON_PRETTY_PRINT));

    }

    crypto_abilitie(); 
?>