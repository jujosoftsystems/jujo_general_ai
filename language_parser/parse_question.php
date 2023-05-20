<?php
    /*
        Collect "keywords" to be used to can appropriate API to return data back!
    */

    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        $data = json_decode(file_get_contents('php://input'), true);
        $question = $data['question'];
        
        // findme
        // random_quotes

         // Call external API
         $response_1 = file_get_contents('http://192.168.1.182/api/random_quotes.php');
         $api_parse_result = json_decode($response_1, true);

         echo json_encode($api_parse_result);
    }
?>