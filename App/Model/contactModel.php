<?php
namespace Matr\Model;
class contactModel{
    public $con;
    public $queryBuilder;
    function __construct($conn)
    {
 
        $this->con = $conn;
        $this->queryBuilder = $conn->createQueryBuilder();


    }
    
    public function getContact($id){
        return $this->con->executeQuery($this->queryBuilder
        ->select('*')
        ->from('contact_details')
        ->where('contact_id = ?'),array($id)
        )->fetchAllAssociative;  
    }

    public function addContact($mob,$mail,$landline){
        return $this->con->executeStatement($this->queryBuilder->insert('contact_details')->values(
            array(
                'mobile_no' => '?',
                'mail_id' => '?',
                'landline' => '?'
            )
        ), array($mob,$mail,$landline));
    }

    public function editContact($id,$mob,$mail,$landline){
        return $this->con->executeStatement($this->queryBuilder
            ->update('contact_details')
            ->set('mobile_no',$mob )
            ->set('mail_id', $mail)
            ->set('landline',$landline)
            ->where('contact_id' ,$id)
        );

    }

    private function deleteContact($id){
        return $this->con->executeStatement($this->queryBuilder
            ->delete('contact_details')
            ->where('contact_id',$id)
        );      
    }

}

?>