<?php
namespace Matr\Model\dbModel;

use Matr\Model\dbModel\dbconn\dbmatrModel as Connection;

abstract class tableModel
{
    protected $tablename;
    protected $columns = [];
    protected $con;
    public function __construct()
    {
        //set table name here
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
            $cond = each($params->condition);
            if ($attr) {
                $colCheck = $this->checkCol($attr);
                if (false !== $colCheck) {
                    if (!$cond) {
                        $queryBuilder = $this->con->createQueryBuilder();
                        $query = $queryBuilder->select($attr)->from($this->tablename);
                        return $this->con->fetchAllAssociative($query);
                    } elseif ($cond) {
                        $queryBuilder = $this->con->createQueryBuilder();
                     //   $query = $queryBuilder->select($attr)->from($this->tablename)->where($cond[key]);
                        return $this->con->fetchAllAssociative($query);
                    }
                }
            }else{
                return false;
            }
        } else {
            return false;
        }
    }
    public function add(){}
}
