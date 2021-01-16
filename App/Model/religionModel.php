<?php
use Doctrine\DBAL\Connection;

namespace Matr\Model;

class religionModel extends BaseModel
{
    public function __construct()
    {
        parent::__construct('caste_religion');
    }
    public function getAllReligion()
    {   
        $res = $this->get([],['religion'],true);
        return $res?$res->fetchAll():false;
    }
    public function getAllCaste($religion)
    {   
        $res = $this->get(['religion' => $religion],['caste_id' => 'id','caste'=>'caste']);
        return $res?$res->fetchAll():false;
    }
    public function getReligion($id)
    {
        return $this->get($id)?$this->get($id)->fetchAll():false;
    }
    public function addReligion(array $data)
    {
        return $this->add($data);
    }
    public function addCaste(array $data)
    {
        return $this->add($data);
    }

    public function editFamily($id, array $changes)
    {
        return $this->edit($id, $changes);
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
