<?php
namespace Matr\Model\dbModel;

use Matr\Model\dbModel\dbconn\dbmatrModel as Connection;

abstract class tableModel
{
    protected $columns = [];
    protected $con;
    public function __construct()
    {
        $this->con = Connection::getCon();
       $this->columns = DB_META[$this->tablename];
    }                                   
    protected function checkCol($colNames) //checks if columns exist. (ARRAY)
    {
        $Exist = [];
        foreach ($colNames as $colName) {
            foreach ($this->columns as $col) {
                if ($col == $colName || $colName == "*") {
                    if ($colName == "*") {
                        array_push($Exist, "*");
                    }
                    array_push($Exist, $col);
                    break;
                }
            }
        }
        $noExt = array_values(array_diff($colNames, $Exist));
        if (0 == count($noExt)) {
            return true;
        } else {
            echo str_replace(["[","]"], "", json_encode($noExt))." does not exist in ".$this->tablename;
        }
        return false;
    }
    public function get($params) // select from table
    {
        if (isset($params)) {
            $attr = $params->attributes;
            $cond = $params->condition;
            $colCheck = $this->checkCol($attr);
            if (false !== $colCheck) {
                $queryBuilder = $this->con->createQueryBuilder();
                $query = $queryBuilder->select($attr)->from($this->tablename);
                return $this->con->fetchAllAssociative($query);
            }
        } else {

        }
    }
}
