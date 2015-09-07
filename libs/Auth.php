<?php

class Auth {
    
    public $storage;
    public $server;
    
    function __construct() {
        
        $dsn = 'mysql:dbname='.DB_NAME.';host='.DB_HOST.'';
        $username = DB_USER;
        $password = DB_PASS;
        
        OAuth2\Autoloader::register();
        $this->storage = new OAuth2\Storage\Pdo(array('dsn' => $dsn, 'username' => $username, 'password' => $password));
        $this->server = new OAuth2\Server($this->storage);
        $this->server->addGrantType(new OAuth2\GrantType\ClientCredentials($this->storage));
        $this->server->addGrantType(new OAuth2\GrantType\AuthorizationCode($this->storage));
        $this->server->addGrantType(new OAuth2\GrantType\RefreshToken($this->storage));
    }
    
    function init(){
        return $this->server;
    }
    
}