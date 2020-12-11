<?php
namespace Matr\Model\dbModel\dbconn;

require(CONFIG_PATH."Db_conf.php");
class dbmatrModel
{
    public $db;
    
    public static function GetCon()
    {
        $db = \Doctrine\DBAL\DriverManager::getConnection(DB_CONF);
        if (mysqli_connect_error()) {
            die("Cannot connect to database <br />".mysqli_connect_error());
        }
        return $db;
    }
}
