<?php
namespace Matr\Model\dbModel\dbconn;

use Doctrine\DBAL\DriverManager as Connection;

require(CONFIG_PATH."Db_conf.php");
class dbmatrModel
{
    private $db;
    private static $instance = null;
    private function __construct()
    {
        $db = Connection::getConnection(DB_CONF);
        if (mysqli_connect_error()) {
            die("Cannot connect to database <br />".mysqli_connect_error());
        }
        $this->db = $db;
    }
    public static function getInstance()
    {
        if (self::$instance == null)
        {
          self::$instance = new dbmatrModel();
        }
        return self::$instance;
    }
    public function GetCon()
    {
        return $this->db;
    }
}
