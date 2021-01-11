<?php
namespace Matr\Controller;

use Matr\Model\contactModel;

class Contact extends BaseController
{
    private $contactModel;
    public function __construct($a, $b)
    {
        parent::__construct($a, $b);
        $this->contactModel = new contactModel();
    }

    // this is purely experimental

    public function get()
    {
        $result = $this->contactModel->getContact($this->reqBody->id);
        if (!$result) {
            return $this->cntrlRespond(false);
        }
        return $this->cntrlRespond(['data' => $result]);
    }

    public function edit()
    {
        $result = $this->contactModel->editContact(
            $this->reqBody->id,
            array('mobile_no' => $this->reqBody->mobile,
            'mail_id' => $this->reqBody->mail,
            'landline' => $this->reqBody->landline)
        );
        if (!$result) {
            return $this->cntrlRespond(false);
        }

        return $this->cntrlRespond(['message' => 'Contact updated']);
    }
    
    public function add()
    {
        $result = $this->contactModel->addContact(
            array(
                'mobile_no' => $this->reqBody->mobile,
                'mail_id' => $this->reqBody->mail,
                'landline' => $this->reqBody->landline
            )
        );
        if (!$result) {
            return $this->cntrlRespond(false);
        }
            
        return $this->cntrlRespond(['message' => 'Contact added',
            'data' => ['id' => $result]]);
    }

    public function delete()
    {
        $result = $this->contactModel->deleteContact($this->reqBody->id);
        if (!$result) {
            return $this->cntrlRespond(false);
        }
        
        return $this->cntrlRespond(['message' => 'Contact deleted']);
    }
}
