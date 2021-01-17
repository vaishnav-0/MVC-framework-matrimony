<?php
namespace Matr\Controller;

use Matr\Model\siblingModel;

class Sibling extends BaseController
{
    private $siblingModel;
    public function __construct($a, $b)
    {
        parent::__construct($a, $b);
        $this->siblingModel = new siblingModel();
    }

    public function get()
    {
        $result = $this->siblingModel->getSibling($this->reqBody->id);
        if (!$result) {
            return $this->cntrlRespond(false);
        }
        return $this->cntrlRespond(['data' => $result]);
    }
    public function getWFam()
    {
        $result = $this->siblingModel->getSibling(array('f_id' => $this->reqBody->id));
        if (!$result) {
            return $this->cntrlRespond(false);
        }
        return $this->cntrlRespond(['data' => $result]);
    }
    public function edit()
    {
        $result = $this->siblingModel->editSibling(
            $this->reqBody->sId,
            array("f_id"=>$this->reqBody->pId,
            "name"=>$this->reqBody->name,
            "age"=>$this->reqBody->age,
            "sex"=>$this->reqBody->sex,
            "marital_status"=>$this->reqBody->mar,
            )
        );
        if (!$result) {
            return $this->cntrlRespond(false);
        }
    
        return $this->cntrlRespond(['message' => 'Sibling updated']);
    }
    
    public function addBulk()
    {
        $sibIns = [];
        if ($this->reqBody->data && $this->reqBody->id) {
            $data = $this->reqBody->data;
            $this->reqBody->pId = $this->reqBody->id;
            foreach ($data as $key => $value) {
                $this->reqBody->name = $value->name;
                $this->reqBody->age = $value->age;
                $this->reqBody->sex = $value->sex;
                $this->reqBody->mar = $value->mar;
                $res = json_decode($this->add()->getBody());
                if($res->status === 'success'){
                    $sibIns[$key] = $res->data;
                }
            }
            return $this->cntrlRespond(['message' => 'Siblings added',
                                    'data' => $sibIns]);
        } else {
            return $this->cntrlRespond(false);
        }
    }
    public function add()
    {
        if (!$this->reqBody->pId) {
            return $this->cntrlRespond(false);
        }
        //print_r($this->reqBody);
        $sibId =  $this->siblingModel->addSibling(
            array("f_id"=>$this->reqBody->pId,
            "name"=>$this->reqBody->name,
            "age"=>$this->reqBody->age,
            "sex"=>$this->reqBody->sex,
            "marital_status"=>$this->reqBody->mar,
            )
        );
        if (!$sibId) {
            return $this->cntrlRespond(false);
        }
        // by calling controller

        
        return $this->cntrlRespond(['message' => 'Sibling added',
                                    'data' => ['id' => $sibId]]);
    }
    public function deleteWFam()
    {
        $result = $this->siblingModel->deleteSibling(array('f_id' => $this->reqBody->id));
        if (!$result) {
            return $this->cntrlRespond(false);
        }
        
        return $this->cntrlRespond(['message' => 'Siblings deleted']);
    }
    public function delete()
    {
        $result = $this->siblingModel->deleteSibling($this->reqBody->id);
        if (!$result) {
            return $this->cntrlRespond(false);
        }
        
        return $this->cntrlRespond(['message' => 'Sibling deleted']);
    }
}
