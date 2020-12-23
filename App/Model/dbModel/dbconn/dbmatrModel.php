<?php
namespace Matr\Model\dbModel\dbconn;
use Doctrine\DBAL\DriverManager as Connection;
require(CONFIG_PATH."Db_conf.php");
class dbmatrModel
{
    public $db;
    
    public static function GetCon()
    {
        $db = Connection::getConnection(DB_CONF);
        if (mysqli_connect_error()) {
            die("Cannot connect to database <br />".mysqli_connect_error());
        }
        return $db;
    }
}
