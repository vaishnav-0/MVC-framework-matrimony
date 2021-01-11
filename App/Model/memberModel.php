<?php
namespace Matr\Model;

class memberModel extends BaseModel
{
    public function __construct()
    {
        parent::__construct('members');
    }
    

    public function getAllMember()
    {
        return $this->get()?$this->get()->fetchAll():false;
    }
    public function getMember($id)
    {
        return $this->get($id)?$this->get($id)->fetchAll():false;
    }
    public function addMember(array $data)
    {
        return $this->add($data);
    }

    public function editMember($id, array $changes)
    {
        return $this->edit($id, $changes);
    }



    public function deleteMember($id)
    {
        return $this->delete($id);
    }
    /* public function editMember($id, $join_date, $name, $dob, $caste_rel_id, $height, $physique, $gender, $family_id, $occupation, $qualification, $photo, $contact_id, $complexion)
     {
         return $this->con->executeStatement(
             $this->queryBuilder
             ->update('members')
             ->set('mobile_no', $mob)
             ->set('mail_id', $mail)
             ->set('landline', $landline)
             ->where('contact_id', $id)
         );
     }

     public function updateMemberContact($id, $contact_id)
     {
         return $this->con->executeStatement(
             $this->queryBuilder
             ->update('members')
             ->set('contact_id', $contact_id)
             ->where('id', $id)
         );
     }

     public function updateMemberFamily($id, $family_id)
     {
         return $this->con->executeStatement(
             $this->queryBuilder
             ->update('members')
             ->set('family_id', $family_id)
             ->where('id', $id)
         );
     }

     private function deleteMember($id)
     {
         return $this->con->executeStatement(
             $this->queryBuilder
             ->delete('members')
             ->where('id', $id)
         );
     }       */
}
