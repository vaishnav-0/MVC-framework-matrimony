<?php
abstract class tablefuncModel{
    protected $tablename;
    protected $columns = [];

    protected function checkCol($colNames){
        $retObj = new class{};
        $retObj->pass = false;
        $retObj->errMsg = "";
        $retObj->Exist = [];
        $passNo = 0;
        foreach($colNames as $colName){
            foreach($this->columns as $col){
                if($col = $colName){
                    $passNo++;
                    array_push($retObj->Exist, $col);
                    break;
                }
            }
        }
        if($passNo = count($colNames))
            $retObj->pass = true;
        else
            $retObj->errMsg = str_replace(["[","]"], "", array_diff($colNames,$retObj->Exist))." does not exist in ".$this->tabelname;
    }

    public function getall($params){
        if($params->attributes){
            $colCheck = $this->checkCol($params->attributes);
            if($col_check->pass){

            }else{
                echo $colCheck->errMsg;
            }
        }
    }

}
?>