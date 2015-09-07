<?php
/**
 * Created by PhpStorm.
 * User: jmmiguel
 * Date: 4/27/14
 * Time: 12:06 AM
 */

class CURL {

    function __construct(){

    }

    public static function get($url, $fields = array()){

        $fields_string = "";
        foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value."&"; }
        rtrim($fields_string, '&');

        $fields_string = "?" . $fields_string;

        
        $ch = curl_init();

        // Set query data here with the URL
        curl_setopt($ch, CURLOPT_URL, $url . $fields_string); 

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, '60');
        $res = curl_exec($ch);

        if(curl_errno($ch)){
             $json = array("Message" => curl_error($ch), "Status" => INTERNAL_SERVER_ERROR);
                header('Content-Type: application/json');
                echo json_encode($json);
                die();
        }
        else{
            return json_decode($res);
        }
        curl_close($ch);        
    }

    public static function post($url, $fields = array()){

        $fields_string = "";

        //url-ify the data for the POST
        foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value."&"; }
        rtrim($fields_string, '&');

        //die($fields_string);

        //open connection
        $ch = curl_init();

        //set the url, number of POST vars, POST data
        curl_setopt($ch,CURLOPT_URL, $url);
        curl_setopt($ch,CURLOPT_POST, count($fields));
        curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
        curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);

        //execute post
        $res = curl_exec($ch);

        if(curl_errno($ch)){
             $json = array("Message" => curl_error($ch), "Status" => INTERNAL_SERVER_ERROR);
                header('Content-Type: application/json');
                echo json_encode($json);
                die();
        }
        else{
            return json_decode($res);
        }
        curl_close($ch);
    }
    
    public static function curlFB($qry_str = NULL){
        $ch = curl_init();
        // graph api CURL
        curl_setopt($ch, CURLOPT_URL, FB_BASE_URL . $qry_str); 

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, '30');
        $res = trim(curl_exec($ch));
        
        
        $res_arr = json_decode($res);
        
        if(json_last_error() == JSON_ERROR_NONE){
            $response = $res_arr;
        }
        else{
            $response = $res;
        }
       
        if(curl_errno($ch)){
            //$json = array("Message" => curl_error($ch), "Status" => INTERNAL_SERVER_ERROR); //500
             
            $json = array("Message" => curl_error($ch), "Status" => INTERNAL_SERVER_ERROR);
            header('Content-Type: application/json');
            echo json_encode($json);
            die();
        }
        else{
            return $response;
        }

        curl_close($ch);
    }
} 