<?php
namespace Matr\Controller;

use Matr\Model\addressModel;

class Contact extends BaseController
{
    private $addressModel;
    public function __construct($a, $b)
    {
        parent::__construct($a, $b);
        $this->addressModelModel = new addressModel();
    }

    // this is purely experimental

    public function get()
    {
        $result = $this->addressModel->getAddress($this->reqBody->id);
        if (!$result) {
            return $this->cntrlRespond(false);
        }
        return $this->cntrlRespond(['data' => $result]);
    }

    public function edit()
    {
        $result = $this->addressModel->editAddress(
            $this->reqBody->id,
            array(
                'address' => $this->reqBody->addr,	
                'locality'  => $this->reqBody->loc,	
                'city'	 => $this->reqBody->city,
                'district'	 => $this->reqBody->dist,
                'pin'	 => $this->reqBody->pin,
                'landmark'	 => $this->reqBody->landmark,
                )
        );
        if (!$result) {
            return $this->cntrlRespond(false);
        }

        return $this->cntrlRespond(['message' => 'Address updated']);
    }
    
    public function add()
    {
        $result = $this->addressModel->addAddress(
            array(
                'address' => $this->reqBody->addr,	
                'locality'  => $this->reqBody->loc,	
                'city'	 => $this->reqBody->city,
                'district'	 => $this->reqBody->dist,
                'pin'	 => $this->reqBody->pin,
                'landmark'	 => $this->reqBody->landmark,
                )
        );
        if (!$result) {
            return $this->cntrlRespond(false);
        }
            
        return $this->cntrlRespond(['message' => 'Address added',
            'data' => ['id' => $result]]);
    }

    public function delete()
    {
        $result = $this->addressModel->deleteAddress($this->reqBody->id);
        if (!$result) {
            return $this->cntrlRespond(false);
        }
        
        return $this->cntrlRespond(['message' => 'Address deleted']);
    }
}

?>