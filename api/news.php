<?php
    /*
        News API 
    */
    $param_1 = $_GET['topic'];

    $ini_file = parse_ini_file('../api_keys/external_api_keys.ini');
    $the_api_key = $ini_file['news'];
   
    $error_msg = "None all good"; // <-- default

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
            $topic_value_define = "technology";
            break;
        default:
            $topic_value_define = "general"; // Takes care of blank/null topic variable!
    }

    // Have to use Curl for the NewsApi url API call. file_get_contents not working!
    $ch = curl_init();

    $url = 'https://newsapi.org/v2/top-headlines?category='.$topic_value_define.'&country=us&apiKey='.$the_api_key;
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_USERAGENT, 'MyNewsApp/1.0');
    $response = curl_exec($ch);
    curl_close($ch);

    $api_1_result = json_decode($response, true);

    $tip = " You can type news fallow by the topic to get topic specific news. For example news sports. The topics available are business, entertainment, health, science, sports, and technology.";

    $result = "Here are 3 top news I found. First one is an article title ".$api_1_result["articles"][0]["title"]." ".$api_1_result["articles"][0]["description"].
               " Second one is an article title ".$api_1_result["articles"][1]["title"]." ".$api_1_result["articles"][1]["description"].
               " Third one is an article title ".$api_1_result["articles"][2]["title"]." ".$api_1_result["articles"][2]["description"].$tip;
   
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