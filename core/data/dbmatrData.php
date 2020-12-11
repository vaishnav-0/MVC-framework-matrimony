<?php                            // Dont,t run this on server
namespace Core\data;

use Matr\Model\dbModel\dbconn\dbmatrModel as Connection;

class dbmatrData
{
    public function __construct() // creates dbmatrData.json 
    {
        $con = Connection::getCon();
        $db_obj = new class {
        };
        if ($result = $con->executeQuery('SHOW tables')) {
            $row = $result->fetchAllAssociative();
            foreach ($row as $col) {
                $res = $con->query("DESCRIBE ".$col['Tables_in_matrimony']);
                if ($res) {
                    $db_obj->{$col['Tables_in_matrimony']} = [];
                    $row_colname = $res->fetchAllAssociative();
                    foreach ($row_colname as $roww) {
                        array_push($db_obj->{$col['Tables_in_matrimony']}, $roww['Field']);
                    }
                }
            }
            file_put_contents(CORE_PATH."data/dbmatrData.json", json_encode($db_obj));
        }
    }
}
