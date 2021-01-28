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
        $fam = json_decode($this->get()->getBody());
        $famId = $fam->data->{'0'}->pId;
        $mCId = $fam->data->{'0'}->mCId;
        $fCId = $fam->data->{'0'}->fCId;
        $result = $this->familyModel->editFamily(
            $this->reqBody->id,
            array("fName"=>$this->reqBody->fName,
                        "mName"=>$this->reqBody->mName,
                        "fOcc"=>$this->reqBody->fOcc,
                        "mOcc"=>$this->reqBody->mOcc
                )
        );
    
        if ($this->reqBody->fmobile || $this->reqBody->fmail || $this->reqBody->flandline && !$fCId) {
            $fconId = $this->callController('Contact', 'add', array(
                "mobile" => $this->reqBody->fmobile,
                "mail" =>$this->reqBody->fmail,
                "landline" =>$this->reqBody->flandline
            ))->data->id;
            $res = $this->familyModel->edit($famId, array('fCId' => $fconId));
        }
        if ($this->reqBody->mmobile || $this->reqBody->mmail || $this->reqBody->mlandline && !$mCId) {
            echo 'asad';
            $mconId = $this->callController('Contact', 'add', array(
            "mobile" => $this->reqBody->mmobile,
            "mail" =>$this->reqBody->mmail,
            "landline" =>$this->reqBody->mlandline
        ))->data->id;
            $res = $this->familyModel->edit($famId, array('mCId' => $mconId));
        }
        if ($fCId) {
            $edit = $this->callController('Contact', 'edit', array(
                "id" => $fCId,
                "mobile" => $this->reqBody->fmobile,
                "mail" =>$this->reqBody->fmail,
                "landline" =>$this->reqBody->flandline
            ))->status;
        }
        if ($mCId) {
            $edit = $this->callController('Contact', 'edit', array(
                "id" => $mCId,
                "mobile" => $this->reqBody->mmobile,
                "mail" =>$this->reqBody->mmail,
                "landline" =>$this->reqBody->mlandline
            ))->status;
        }
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
