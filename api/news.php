<?php
    /*
        News API 
    */

    $param_1 = $_GET['topic'];

    // Might use ---> https://saurav.tech/NewsAPI/top-headlines/category/general/us.json

    // News topics/categories
    switch ($param_1){
        case "business":
            $topic_value_define = "business";
            break;
        case "entertainment":
            $topic_value_define = "entertainment";
            break;
        case "health":
            $topic_value_define = "health";
            break;
        case "science":
            $topic_value_define = "science";
            break;
        case "sports":
            $topic_value_define = "sports";
            break;
        case "technology":
            $topic_value_define = " technology";
            break;
        default:
            $topic_value_define = "general";
    }

     // Call external news API
     $response_1 = file_get_contents('https://saurav.tech/NewsAPI/top-headlines/category/'.$topic_value_define.'/us.json');
     $api_1_result = json_decode($response_1, true);

     // testing... Parseing just one news article!
     $result = $api_1_result["articles"][3]["title"]." ".$api_1_result["articles"][3]["description"];

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