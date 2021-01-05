<?php
namespace Matr\Controller;
use Matr\Model\familyModel;
use Matr\Model\contactModel;
use Matr\Model\siblingModel;
use Core\utils\functions;

class Family extends BaseController{
    private $familyModel;
    public function __construct($a,$b){
        parent::__construct($a,$b);
        $this->familyModel = new familyModel($this->con);
    }

    public function get(){
        $result = $this->familyModel->getFamily($this->reqBody->id);
        return $this->cntrlRespond($result, true);
    }


    public function edit(){
        $result = $this->$familyModel->editFamily($this->reqBody->PId,
                        array
                        ("fname"=>$this->reqBody->fName,
                        "mName"=>$this->reqBody->mName,
                        "fCId"=>$this->reqBody->fCId,
                        "mCId"=>$this->reqBody->mCId,
                        "fOcc"=>$this->reqBody->fOcc,
                        "mOcc"=>$this->reqBody->mOcc,
                        )
        );
        return $this->cntrlRespond($result);
    }
    
    public function add(){
            ->addFamily(
                        $this->reqBody->fName,
                        $this->reqBody->mName,
                        $this->reqBody->fCId,
                        $this->reqBody->mCId,
                        $this->reqBody->fOcc,
                        $this->reqBody->mOcc
                    );

        // can be simplified by calling contact controller here :|
        $mconId = $this->contactModel     
            ->addContact(
                        $this->reqBody->mmobile,
                        $this->reqBody->mmail,
                        $this->reqBody->mlandline
                    );
        $fconId = $this->contactModel     
            ->addContact(
                        $this->reqBody->fmobile,
                        $this->reqBody->fmail,
                        $this->reqBody->flandline
                    );
        $res1 = $this->updateFamilyContact($famId,$mconId);
        $res2 = $this->updateFamilyContact($famId,$fconId);
        if(res1 && res2 == 1){
            return $this->cntrlRespond(true);
        }
        else
            return $this->cntrlRespond(false);
    }

    public function delete(){
        $result = $this->$familyModel->deleteFamily($this->$reqbody->id);
        return $this->cntrlRespond($result);


    }

}

?>