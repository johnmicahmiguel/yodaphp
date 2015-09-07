<?php

class SMS {
    
    function __construct() {
        
    }
    
    public static function sendSMS($access_token = NULL, $numbers = array(), $msg = NULL){
        $url = "https://devapi.globelabs.com.ph/smsmessaging/v1/outbound/".GL_APP_SHORTCODE."/requests?access_token={$access_token}";
        
        $ch = curl_init( $url );
        
        $data = array("clientCorrelator" => "123456", 
                        "outboundSMSTextMessage" => array("message"=>$msg),
                        "address" => $numbers);
        
        # Setup request to send json via POST.
        $payload = json_encode( array( "outboundSMSMessageRequest"=> $data ) );
        curl_setopt( $ch, CURLOPT_POSTFIELDS, $payload );
        curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
        # Return response instead of printing.
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
        # Send request.
        $result = curl_exec($ch);
        curl_close($ch);
        # Print response.
        return $result;
    }
    
    public static function sendSemaphoreMsg($recipient_number = "", $msg = ""){
        
        $fields = array();
        $fields["api"] = "Eg35opQKyZsopsaXRqjz";
        $fields["number"] = $recipient_number; //safe use 63
        $fields["message"] = $msg;
        $fields["from"] = "PARTYPHILE";
        $fields_string = http_build_query($fields);
        $outbound_endpoint = "http://www.semaphore.co/v3/bulk_api/sms";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $outbound_endpoint);
        curl_setopt($ch,CURLOPT_POST, count($fields));
        curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($ch);
        curl_close($ch);
        
        return $output;
    }
    
    
    
}