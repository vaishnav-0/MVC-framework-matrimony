<?php
namespace Matr\Model;
class siblingModel extends BaseModel{ 
    function __construct()
    {
        parent::__construct('sibling');

    }
    
    public function getSibling($id)
    {
        return $this->get($id)?$this->get($id)->fetchAll():false;
        
    }
    public function addSibling(array $data)
    {
        return $this->add($data);
    }

    public function editSibling($id, array $changes)
    {
        return $this->edit($id,$changes);
    }

    public function deleteSibling($id)
    {
        return $this->delete($id);
    }

}

?>