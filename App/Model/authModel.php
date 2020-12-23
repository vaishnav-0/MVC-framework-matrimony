<?php
class authModel{
    public $con;
    function __construct($conn){
        $this->con = $conn;
    }
    public function login($username,$password){
        return $this->con->executeStatement('SELECT * FROM users WHERE username = ? AND password = ? ',array($username,$password))->rowCount();
    }
}

?>