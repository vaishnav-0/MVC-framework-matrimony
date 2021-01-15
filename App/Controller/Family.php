<?php
namespace Matr\Controller;

use Matr\Model\familyModel;

class Family extends BaseController
{
    private $familyModel;

    public function __construct($a, $b)
    {
        parent::__construct($a, $b);
        $this->familyModel = new familyModel();
    }

    public function get()
    {
        $result = $this->familyModel->getFamily($this->reqBody->id);
        if (!$result) {
            return $this->cntrlRespond(false);
        }
        return $this->cntrlRespond(['data' => $result]);
    }

    public function edit()
    {
        $result = $this->familyModel->editFamily(
            $this->reqBody->PId,
            array("fName"=>$this->reqBody->fName,
                        "mName"=>$this->reqBody->mName,
                        "fOcc"=>$this->reqBody->fOcc,
                        "mOcc"=>$this->reqBody->mOcc
                )
        );
        if (!$result) {
            return $this->cntrlRespond(false);
        }
    
        return $this->cntrlRespond(['message' => 'Family updated']);
    }
    
    public function add()
    {
        $famId =  $this->familyModel->addFamily(
            array("fname"=>$this->reqBody->fName,
            "mName"=>$this->reqBody->mName,
            "fCId"=>$fconId,
            "mCId"=>$mconId,
            "fOcc"=>$this->reqBody->fOcc,
            "mOcc"=>$this->reqBody->mOcc
            )
        );
        if (!$famId) {
            return $this->cntrlRespond(false);
        }
        // by calling controller
        $mconId = $this->callController('Contact', 'add', array(
              "mobile" => $this->reqBody->mmobile,
              "mail" =>$this->reqBody->mmail,
              "landline" =>$this->reqBody->mlandline
          ))->data->id;

        $fconId = $this->callController('Contact', 'add', array(
              "mobile" => $this->reqBody->fmobile,
              "mail" =>$this->reqBody->fmail,
              "landline" =>$this->reqBody->flandline
          ))->data->id;
        $res = $this->familyModel->edit($famId, array('fCId' => $fconId, 'mCId' => $mconId));

        
        return $this->cntrlRespond(['message' => 'Family added',
                                    'data' => ['id' => $famId]]);
    }

    public function delete()
    {
        $result = $this->familyModel->deleteFamily($this->reqBody->id);
        if (!$result) {
            return $this->cntrlRespond(false);
        }
        
        return $this->cntrlRespond(['message' => 'Family deleted']);
    }
}
