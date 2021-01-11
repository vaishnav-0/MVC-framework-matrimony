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
    public function get() //If no id given - will return all rows. Primary key is taken as id if none specified. Also compatible with multiple id([id1=>value1,....]).
    {
        $args = func_get_args();
        $id = $args[0];
        $query = $this->getQueryBuilder()->select('*')->from($this->tableName);
        if (count($args) === 0) {
            if (!$exec = $query->execute()) {
                return false;
            }
            return $exec;
        }
        if (is_string($id) || is_numeric($id)) {
            $query = $this->bindWhere($query, [$this->primaryKey => $id]);
            if (!$exec = $query->execute()) {
                return false;
            }
            return $exec;
        }
        if (is_array($id)) {
            $query = $this->bindWhere($query, $id);
            if (!$exec = $query->execute()) {
                return false;
            }
            return $exec;
        }
        return false;
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
        if (!$data) {
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
