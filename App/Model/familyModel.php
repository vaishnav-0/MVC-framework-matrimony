<?php
use Doctrine\DBAL\Connection;

namespace Matr\Model;

class familyModel extends BaseModel
{
    public function __construct()
    {
        parent::__construct('family');
    }
    
    public function getFamily($id)
    {
        return $this->get($id)?$this->get($id)->fetchAll():false;
        
    }
    public function addFamily(array $data)
    {
        return $this->add($data);
    }

    public function editFamily($id, array $changes)
    {
        return $this->edit($id,$changes);
    }

    public function updateFamilyContact($id, $contact_id, $mcontact_id)
    {
        return $this->edit($id, ['fCId' => $contact_id, 'mCId' => $mcontact_id]);
        
    }

    public function deleteFamily($id)
    {
        return $this->delete($id);
    }
}
