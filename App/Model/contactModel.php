<?php
namespace Matr\Model;

class contactModel extends BaseModel
{
    public function __construct()
    {
        parent::__construct('contact_details');
    }
    
    public function getContact($id)
    {
        return $this->get($id)?$this->get($id)->fetchAll():false;

    }

    public function addContact(array $data)
    {
        if(!$data['mobile_no']){
            return false;
        }
        return $this->add($data);

    }

    public function editContact($id,array $changes)
    {
        return $this->edit($id,$changes);

    }

    public function deleteContact($id)
    {
        return $this->delete($id);

    }
}
