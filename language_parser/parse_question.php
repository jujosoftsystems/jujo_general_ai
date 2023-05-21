<?php
    /*
        Collect "keywords" to be used to can appropriate API to return data back!
    */

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $data = json_decode(file_get_contents('php://input'), true);
        $question = $data['question'];
        
        // Parse string for key words!
        $look_for = array("find", "quote", "quotes");
        $words = explode(" ", $question);
       
        // Iterate through each word and check if it matches any of the words to find
        $testObj = "";

        foreach($words as $word){
            if(in_array($word, $look_for)){
                $last_word_found = $word;
            }  
        }
        
        if($last_word_found =='find'){
            $response = file_get_contents('http://192.168.1.182/api/findme.php');
            $api_parse_result = json_decode($response, true);
            echo json_encode($api_parse_result);
        }

        if($last_word_found == 'quote' || $last_word_found == 'quotes'){
            $response = file_get_contents('http://192.168.1.182/api/random_quotes.php');
            $api_parse_result = json_decode($response, true);
            echo json_encode($api_parse_result);
        }

        // Defualt 
        if(empty($last_word_found)){
            echo json_encode(array("result" => "Sorry I can't find anything on my knowledge base to assist you!"));
        }

    }
?>