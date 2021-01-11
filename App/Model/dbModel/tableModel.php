<?php
namespace Matr\Model\dbModel;

use Matr\Model\dbModel\dbconn\dbmatrModel as Connection;

abstract class tableModel
{
    protected $tableName;
    protected $columns = [];
    protected $con;
    protected $primaryKey;
    public function __construct(string $tableName)
    {
        $this->tableName = $tableName;
        $this->con = Connection::getCon();
        $this->setColumns();
        $this->setPrimaryKey();

    }
    protected function setPrimaryKey()
    {
        $res = $this->con->query("SHOW KEYS FROM ".$this->tableName." WHERE Key_name = 'PRIMARY'");
        if ($res) {
            $row_colname = $res->fetchAllAssociative();
            $this->primaryKey = $row_colname[0]['Column_name'];
        }
    }
    public function setColumns()
    {
        $res = $this->con->query("DESCRIBE ".$this->tableName);
        if ($res) {
            $cols = [];
            $row_colname = $res->fetchAllAssociative();
            foreach ($row_colname as $row) {
                array_push($cols, $row['Field']);
            }
            $this->columns = $cols;
        }
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
}
