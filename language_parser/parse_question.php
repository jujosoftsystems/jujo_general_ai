<?php
    /*
        Collect "keywords" to be used to can appropriate API to return data back!
    */

    $host_url_param = 'http://192.168.1.182';

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $data = json_decode(file_get_contents('php://input'), true);
        $question = strtolower($data['question']); 
        
        // Parse string for key words!
        $look_for = array("find", "quote", "quotes", "coin", "weather", "news", "help");
        $words = explode(" ", $question);
       
        // Iterate through each word and check if it matches any of the words to find
        foreach($words as $word){
            if(in_array($word, $look_for)){
                $last_word_found = $word;
            }  
        }
        
        if($last_word_found == 'find'){
            $response = file_get_contents($host_url_param.'/api/findme.php');
            $api_parse_result = json_decode($response, true);
            echo json_encode($api_parse_result);
        }

        if($last_word_found == 'quote' || $last_word_found == 'quotes'){
            $response = file_get_contents($host_url_param.'/api/random_quotes.php');
            $api_parse_result = json_decode($response, true);
            echo json_encode($api_parse_result);
        }

        if($last_word_found == 'coin'){
            $pattern = "/\b" . preg_quote("coin") . "\b\s+(\w+)/i";
            if(preg_match($pattern, $question, $matches)){
                $next_word = $matches[1];   
                $response = file_get_contents($host_url_param.'/api/crypto.php?coin='.ucfirst($next_word).'');
                $api_parse_result = json_decode($response, true);
                echo json_encode($api_parse_result);
            }
            else{
                echo json_encode(array("result" => "Please tell me what cryptocurrency/coin name you want to know what it's value today. By using coin fallow by its name, For example: coin Bitcoin."));
            }
        }

        if($last_word_found == 'weather'){
            $pattern = "/\b" . preg_quote("weather") . "\b\s+(\w+)/i";
            if(preg_match($pattern, $question, $matches)){
                $next_word = $matches[1];   
                $response = file_get_contents($host_url_param.'/api/weather.php?place='.$next_word.'');
                $api_parse_result = json_decode($response, true);
                echo json_encode($api_parse_result);
            }
            else{
                echo json_encode(array("result" => "I can assist you by telling the weather of a place by you using the keyword weather fallow by the place. For example: weather Austin TX."));
            }
        }

        if($last_word_found == 'news'){
            $pattern = "/\b" . preg_quote("news") . "\b\s+(\w+)/i";
            if(preg_match($pattern, $question, $matches)){
                $next_word = $matches[1];   
                $response = file_get_contents($host_url_param.'/api/news.php?topic='.$next_word.'');
                $api_parse_result = json_decode($response, true);
                echo json_encode($api_parse_result);
            }
            else{
                $response = file_get_contents($host_url_param.'/api/news.php?');
                $api_parse_result = json_decode($response, true);
                echo json_encode($api_parse_result);
            }
        }

        if($last_word_found == 'help'){
            $response = file_get_contents($host_url_param.'/api/help.php');
            $api_parse_result = json_decode($response, true);
            echo json_encode($api_parse_result);
        }

        // Defualt 
        if(empty($last_word_found)){
            echo json_encode(array("result" => "Sorry I can't find anything on my knowledge base to assist you! You can ask for a random quote, to find you, a crypto coin current value or today's news.Type help for more details on what I can do!"));
        }

    }
?>