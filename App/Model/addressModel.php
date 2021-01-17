<?php
namespace Matr\Model;
class addressModel extends BaseModel{
    public $con;
    public $queryBuilder;
    function __construct()
    {
        parent::__construct('address');
    }
    public function getAddress($id){
        return $this->get($id)?$this->get($id)->fetchAll():false;
    }

    public function addAddress(array $data){
        return $this->add($data);

    }

    public function editAddress($id, array $changes){
        return $this->edit($id,$changes);


    }

    public function deleteAddress($id){
        return $this->delete($id);
    }
 /*   public function getAddress($id){
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
    */

}

?>