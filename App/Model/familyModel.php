<?php
use Doctrine\DBAL\Connection;
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
        ), array($fName,$mName,$fCId,$mCId,$fOcc,$mOcc))->lastInsertId();
    }

    public function editFamily(array $changes){
        $changes = array_filter($changes,function($value){
            if($value)
                return true;
            return false;
        });
        $query = $this->queryBuilder->update('family');
        foreach($changes as $key=>$value)
            $query->set($key,$value);
        return $this->con->executeStatement($query);

    }

    public function updateFamilyContact($id,$contact_id,$mcontact_id){
        return $this->con->executeStatement($this->queryBuilder
            ->update('members')
            ->set('fCId', $contact_id)
            ->set('mCId', $mcontact_id)

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