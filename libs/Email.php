<?php 

class Email extends PHPMailer {
    
    function __construct($host, $port, $username, $password, $setFrom) {
        $this->IsSMTP();
        $this->SMTPDebug = 1;
        
        $this->SMTPAuth = true;
        $this->SMTPSecure = "ssl";
        $this->Host = $host;
        $this->Port = $port;
        $this->Username = $username;
        $this->Password = $password;
        $this->SetFrom($username, $setFrom);
        
        return $this->ErrorInfo;
    }
    
    public function send_msg($email, $name, $body, $subject){																																			
        $this->Subject = $subject; //create mail subject
        $this->MsgHTML($body); //create message body
        $e_arr = explode(",", $email);
        foreach($e_arr as $e_a){
            if($e_a != ""){
                $this->AddAddress($e_a, $name);
            }
        }			
        if(!$this->Send()) //send and verify if email was sent
        {$alert = false;} 
        else 
        {$alert = true;}

        return $alert;
    }

}