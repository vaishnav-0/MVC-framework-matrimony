<?php
class userModel{
    public $con;
    function __construct($conn){
        $this->con = $conn;
    }
    public static function init(){
        $schema = new \Doctrine\DBAL\Schema\Schema();

        $userTable = $schema->createTable("users");
        $userTable->addColumn("userId", "integer", array("autoincrement" => true));
        $userTable->addColumn("username", "string", array("length" => 50));
        $userTable->addColumn("password", "string", array("length" => 50));
        $userTable->addColumn("roleId", "integer");
        $userTable->setPrimaryKey(array("userId"));
    }

    public function login($username,$password){
        return $this->con->executeQuery('SELECT * FROM users WHERE username = ? AND password = ? ',array($username,$password))->rowCount();
    }

    public function register($username,$password,$role){
        return $this->con->executeStatement('INSERT INTO users (username, password, roleId) VALUES (?,?,?)', array($username,$password,$role));
    }
}

?>