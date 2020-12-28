<?php
namespace Matr\Model;
class memberModel{
    public $con;
    public $queryBuilder;
    function __construct($conn)
    {
        $this->con = $conn;
        $this->queryBuilder = $conn->createQueryBuilder();
    }
    
    public function getMember($id){
        return $this->con->executeQuery($this->queryBuilder
        ->select('*')
        ->from('members')
        ->where('id = ?'),array($id)
        )->fetchAllAssociative();  
    }

    public function getAllMember($id){
        return $this->con->executeQuery($this->queryBuilder
        ->select('*')
        ->from('members'),array($id)
        )->fetchAllAssociative();  
    }

    public function addMember($join_date,$name,$dob,$caste_rel_id,$height,$physique,$gender,$occupation,$qualification,$photo,$complexion){
        return $this->con->executeStatement($this->queryBuilder->insert('members')->values(
            array(
                'join_date' => '?',	
                'name'  => '?',	
                'dob'	 => '?',
                'caste_rel_id'	 => '?',
                'height'	 => '?',
                'physique' => '?',	
                'gender'	 => '?',
                'occupation'	 => '?',
                'qualification'	 => '?',
                'photo'	 => '?',
                'complexion'	 => '?',
            )
        ), array($join_date,$name,$dob,$caste_rel_id,$height,$physique,$gender,$occupation,$qualification,$photo,$complexion));
    }

    public function editMember($id,$join_date,$name	,$dob,$caste_rel_id,$height,$physique,$gender,$family_id,$occupation,$qualification,$photo,$contact_id,$complexion){
        return $this->con->executeStatement($this->queryBuilder
            ->update('members')
            ->set('mobile_no',$mob )
            ->set('mail_id', $mail)
            ->set('landline',$landline)
            ->where('contact_id' ,$id)
        );

    }

    public function updateMember($id,$family_id,$contact_id){
        return $this->con->executeStatement($this->queryBuilder
            ->update('members')
            ->set('family_id',$family_id )
            ->set('contact_id', $contact_id)
            ->where('id' ,$id)
        );

    }

    private function deleteMember($id){
        return $this->con->executeStatement($this->queryBuilder
            ->delete('members')
            ->where('id',$id)
        );      
    }

}

?>