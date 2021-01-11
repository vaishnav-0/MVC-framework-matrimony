<?php
namespace Matr\Model;
class siblingModel extends BaseModel{ 
    function __construct()
    {
        parent::__construct('siblings');

    }
    
    public function getSibling($id){
        return $this->con->executeQuery($this->queryBuilder
        ->select('*')
        ->from('sibling')
        ->where('s_id = ?'),array($id)
        )->fetchAllAssociative();  
    }

    public function addSibling($f_id,$name,$age,$sex,$marital_status){
        return $this->con->executeStatement($this->queryBuilder->insert('sibling')->values(
            array(
                'f_id' => '?',	
                'name'  => '?',	
                'age'	 => '?',
                'sex'	 => '?',
                'marital_status'	 => '?'
                )
        ), array($f_id,$name,$age,$sex,$marital_status));
    }

    public function editSibling($s_id,$f_id	,$name,$age,$sex,$marital_status){
        return $this->con->executeStatement($this->queryBuilder
            ->update('sibling')
            ->set('f_id',$f_id )
            ->set('name', $name)
            ->set('age',$age)
            ->set('sex',$sex)
            ->set('marital_status',$marital_status)
            ->where('s_id' ,$id)
        );

    }

    private function deleteSibling($id){
        return $this->con->executeStatement($this->queryBuilder
            ->delete('sibling')
            ->where('s_id',$id)
        );      
    }

}

?>