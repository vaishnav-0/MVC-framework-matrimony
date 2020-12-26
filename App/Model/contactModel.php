<?php
namespace Matr\Model;
class contactModel{
    public $con;
    function __construct($conn)
    {
 
        $this->con = $conn;

    }
    
    public function getContact($id){
        return $this->con->executeStatement($queryBuilder
        ->select('*')
        ->from('contact_details')
        ->where('contact_id',$id)
        );  
    }

    public function addContact($mob,$mail,$landline){
        return $this->con->executeStatement($this->con->queryBuilder->insert('contact_details')->values(
            array(
                'mobile_no' => '?',
                'mail_id' => '?',
                'landline' => '?'
            )
        ), array($mob,$mail,$landline));
    }

    public function editContact($id,$mob,$mail,$landline){
        return $this->con->executeStatement($queryBuilder
            ->update('contact_details')
            ->set('mobile_no',$mob )
            ->set('mail_id', $mail)
            ->set('landline',$landline)
            ->where('contact_id' ,$id)
        );

    }

    private function deleteContact($id){
        return $this->con->executeStatement($queryBuilder
            ->delete('contact_details')
            ->where('contact_id',$id)
        );      
    }

}

?>