<?php
namespace Matr\Model;
class familyModel{
    public $con;
    public $queryBuilder;
    function __construct($conn)
    {
        $this->con = $conn;
        $this->queryBuilder = $conn->createQueryBuilder();
    }
    
    public function getFamily($id){
        return $this->con->executeQuery($this->queryBuilder
        ->select('*')
        ->from('family')
        ->where('id = ?'),array($id)
        )->fetchAllAssociative();  
    }

    public function addFamily($fName,$mName,$fCId,$mCId,$fOcc,$mOcc){
        return $this->con->executeStatement($this->queryBuilder->insert('family')->values(
            array(
                'fName' => '?',	
                'mName'  => '?',	
                'fCId'	 => '?',
                'mCId'	 => '?',
                'fOcc'	 => '?',
                'mOcc' => '?'
            )
        ), array($fName,$mName,$fCId,$mCId,$fOcc,$mOcc));
    }

    public function editFamily($id,$fName,$mName,$fCId,$mCId,$fOcc,$mOcc){
        return $this->con->executeStatement($this->queryBuilder
            ->update('family')
            ->set('fName',$fName )
            ->set('mName', $mName)
            ->set('fCId',$fCId)
            ->set('mCId',$mCId)
            ->set('fOcc',$fOcc)
            ->set('mOcc',$mOcc)
            ->where('pId' ,$id)
        );

    }

    private function deleteFamily($id){
        return $this->con->executeStatement($this->queryBuilder
            ->delete('family')
            ->where('pId',$id)
        );      
    }

}

?>