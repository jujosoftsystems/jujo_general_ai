<?php
    /*
        Collect "keywords" to be used to can appropriate API to return data back!
    */

    $host_url_param = 'http://192.168.1.182';

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $data = json_decode(file_get_contents('php://input'), true);
        $question = $data['question'];
        
        // Parse string for key words!
        $look_for = array("find", "quote", "quotes", "coin");
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
            if (preg_match($pattern, $question, $matches)){
                $next_word = $matches[1];   
                $response = file_get_contents($host_url_param.'/api/crypto.php?coin='.$next_word.'');
                $api_parse_result = json_decode($response, true);
                echo json_encode($api_parse_result);
            }
            else{
                echo json_encode(array("result" => "Please tell me what cryptocurrency/coin name you want know what is it's value today. By using coin fallow by its name, For example coin Bitcoin"));
            }
        }

        // Defualt 
        if(empty($last_word_found)){
            echo json_encode(array("result" => "Sorry I can't find anything on my knowledge base to assist you! You can ask for a random quote, to find you, a crypto coin current value. Type coin then follow by the name of the coin."));
        }

    }
?>