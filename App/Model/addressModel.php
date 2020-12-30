<?php
namespace Matr\Model;
class addressModel{
    public $con;
    public $queryBuilder;
    function __construct($conn)
    {
        $this->con = $conn;
        $this->queryBuilder = $conn->createQueryBuilder();
    }
    
    public function getAddress($id){
        return $this->con->executeQuery($this->queryBuilder
        ->select('*')
        ->from('address')
        ->where('a_id = ?'),array($id)
        )->fetchAllAssociative();  
    }

    public function addAddress($address,$locality,$city,$district,$pin,$landmark){
        return $this->con->executeStatement($this->queryBuilder->insert('address')->values(
            array(
                'address' => '?',	
                'locality'  => '?',	
                'city'	 => '?',
                'district'	 => '?',
                'pin'	 => '?',
                'landmark'	 => '?',
                )
        ), array($address,$locality,$city,$district,$pin,$landmark));
    }

    public function editAddress($a_id,$address,$locality,$city,$district,$pin,$landmark){
        return $this->con->executeStatement($this->queryBuilder
            ->update('address')
            ->set('city',$city )
            ->set('district',$district )
            ->set('address', $address)
            ->set('locality',$locality)
            ->set('pin',$pin)
            ->set('landmark',$landmark)
            ->where('a_id' ,$a_id)
        );

    }

    private function deleteAddress($id){
        return $this->con->executeStatement($this->queryBuilder
            ->delete('address')
            ->where('a_id',$id)
        );      
    }

}

?>