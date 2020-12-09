<?php
require("conf/db_conf.php"); 
class dbconnModel{
    public $db;
    
    function __construct()
    {
        $this->db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        if(mysqli_connect_error())
        {
            die("Cannot connect to database <br />".mysqli_connect_error());
        }
    }
   

    
}
?>