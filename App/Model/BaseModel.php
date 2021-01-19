<?php
namespace Matr\Model;

use Matr\Model\dbModel\tableModel;

//should return false if failed
class BaseModel extends tableModel
{
    protected $lastUpdatedVal;
    protected $lastUpdatedRow;
    public function __construct(string $tableName)
    {
        parent::__construct($tableName);
    }
    public function getQueryBuilder()
    {
        return $this->con->createQueryBuilder();
    }
    public function get()  
    {
        //If no argument given - will return all rows.
        //First argument should be the value/s to be bound to where. Can be of form (id)-bind to primary key,([id1:value,id2:value ...]) or ([])- select all
        //Second is the columns to be selected. Can be of the form ([col1,col2 ...]) or ([col1:alias,col2:alias ...]) to use alias column name 
        //Third parameter is whether to use DISTINCT clause or not. Should be a boolean
        $args = func_get_args();
        $id = $args[0];
        $columns = $args[1];
        $distinct = $args[2];
        $query = $this->getQueryBuilder()->select('*')->from($this->tableName);
        if(isset($columns)){
            $query = $this->getQueryBuilder();
            if(\isAssoc($columns)){
                foreach($columns as $key => $value){
                    $query->addSelect($key.' AS '.$value);
                }
            }else{
                foreach($columns as $value){
                    $query = $query->addSelect($value);
                }
            }
            $query = $query->from($this->tableName);
        }
        if (is_string($id) || is_numeric($id)) {
            $query = $this->bindWhere($query, [$this->primaryKey => $id]);
            if (!$exec = $query->execute()) {
                return false;
            }
            return $exec;
        }
        if (is_array($id)) {
            if(count($id) !== 0){
                $query = $this->bindWhere($query, $id);
            }
            
        }
        if($distinct === true){
            $query->distinct();
        }
        if (!$exec = $query->execute()) {
            return false;
        }
        return $exec;
    }
    public function add(array $data)
    {
        $query = $this->getQueryBuilder()->insert($this->tableName);
        $data = $this->filter($data);
        if (!$data) {
            return false;
        }
        $this->lastUpdatedVal = $data;
        $query = $this->bindValues($query, $data);
        if (!$query) {
            return false;
        }
        if (!$query->execute()) {
            return false;
        }
        $last = $this->con->lastInsertId();
        return $last;
    }
    public function edit($id, array $changes)
    {
        if (!$id) {
            return false;
        }
        $query = $this->getQueryBuilder()->update($this->tableName);
        $changes = $this->filter($changes);
        if (!$changes) {
            return false;
        }
        $this->lastUpdatedVal = $changes;
        $query = $this->bindInsValues($query, $changes);
        if (is_array($id)) {
            $query = $this->bindWhere($query, $id);
        } else {
            $query = $this->bindWhere($query, [$this->primaryKey => $id]);
        }
        if (!$query->execute()) {
            return false;
        }           

        return true;
    }
    public function delete($id)
    {
        if (!$id) {
            return false;
        }
        $deleted = $this->get($id)->fetchAll()[0];
        $this->lastUpdatedRow = $deleted;
        $this->lastUpdatedVal = $deleted;
        $query = $this->getQueryBuilder()->delete($this->tableName);
        if (is_array($id)) {
            $query = $this->bindWhere($query, $id);
        } else {
            $query = $this->bindWhere($query, [$this->primaryKey => $id]);
        }
        if (!$query->execute()) {
            return false;
        }
        return true;
    }
    public function bindValues($query, array $data)
    {
        foreach ($data as $key=>$value) {
            $query->setValue($key, ':'.$key);
            $query->setParameter($key, $value);
        }
        return $query;
    }
    public function bindInsValues($query, array $data)
    {
        foreach ($data as $key=>$value) {
            $query->set($key, ':'.$key);
            $query->setParameter($key, $value);
        }
        return $query;
    }
    public function bindWhere($query, array $id)
    {
        foreach ($id as $key=>$value) {
            $query->andWhere($key.'=:'.$key);
            $query->setParameter($key, $value);
        }
        return $query;
    }
    public function filter(array $data)
    {
        $data = \filterArray($data);
        if (empty($data)) {
            return false;
        }
        return $data;
    }
    public function getLastUpdatedVal()
    {
        return $this->lastUpdatedVal;
    }
    public function getLastUpdatedRow()
    {
        return $this->lastUpdatedRow;
    }
}
