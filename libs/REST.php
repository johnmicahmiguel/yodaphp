<?php

class REST {
    
    function __construct() {
        
    }
    
    public static function isRequestBodyValid($request_body = array(), $request_keys = array()){
        
        //validate if the request body is equal to the required number of request parameters needed
        if(count($request_body) != count($request_keys)){
            return false;
        }
        else{
            //determine if they keys in the request body is equal to the keys in request keys
            //determine if the values are not empty
            foreach($request_body as $key => $val){
                if(!in_array($key, $request_keys)){
                    return false;
                    die;
                }
//                if(empty($val)){
//                    return false;
//                    die;
//                }
            }
            return true;
        }
    }
    
    public static function isApiValid($type = NULL, $name = NULL, $version = NULL) {
        $db_obj = new Database(DB_TYPE, DB_HOST, DB_NAME, DB_USER, DB_PASS);
        $sth = $db_obj->prepare("SELECT id, status FROM api WHERE type = :type AND name = :name AND version = :version");
        $sth->execute(array(
            ":type" => $type,
            ":name" => $name,
            ":version" => $version
        ));
        $rowCount = $sth->rowCount();
        $data = $sth->fetch();
        if($rowCount == 0){
            return array(
                "isValid" => false,
                "response" => json_encode(array("Message" => "Invalid API! Check type, name, or version", "Status" => 404))
            );
        }
        else{
            
            if($data['status'] != "ON"){
                return array(
                    "isValid" => false,
                    "response" => json_encode(array("Message" => "We are experiencing technical difficulties, please try again after 15 minutes", "Status" => 403))
                );
            }
            else{
                return array(
                    "isValid" => true,
                    "response" => json_encode(array("Message" => "Success", "Status" => 200))
                );
            }
            
        }
    }
    
    
    public static function isRequestAuthenticated($hash_key = NULL){
        if(is_null($hash_key)){
            return false;
            die;
        }
        else{   
            $api_key = Hash::create("sha256", API_KEY_WORD, HASH_PASSWORD_KEY);
            if($api_key == $hash_key){
                return true;
            }
            else
                return false;
        }
    }
    
}