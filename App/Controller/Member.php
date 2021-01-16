<?php
namespace Matr\Controller;

use Matr\Model\memberModel;
use Matr\Model\contactModel;

use Matr\Helper\imageUploader;

class Member extends BaseController
{
    private $memberModel;
    public function __construct($a, $b)
    {
        parent::__construct($a, $b);
        $this->memberModel = new memberModel();
    }

    // this is purely experimental

    public function get()
    {
        $result = $this->memberModel->getMember($this->reqBody->id);
        if (!$result) {
            return $this->cntrlRespond(false);
        }
        return $this->cntrlRespond(['data' => $result]);
    }

    public function getAll()
    {
        $result = $this->memberModel->getAllMember();
        return $this->cntrlRespond(['data' => $result]);
    }

    public function edit()
    {
        if (isset($_FILES['photo'])) {
            $imageUploader = new imageUploader;
            $image = $imageUploader->addImage($_FILES['photo'], $this->reqBody->name);
        }
        $result = $this->memberModel->editMember(
            $this->reqBody->id,
            array(
                'join_date' => $this->reqBody->join_date,
                'name'  => $this->reqBody->name,
                'dob'	 => $this->reqBody->dob,
                'caste_rel_id'	 => $this->reqBody->caste_id,
                'height'	 => $this->reqBody->height,
                'physique' => $this->reqBody->physique,
                'gender'	 => $this->reqBody->gender,
                'occupation'	 => $this->reqBody->occupation,
                'qualification'	 => $this->reqBody->qualification,
                'photo'	 => $image,
                'complexion'	 => $this->reqBody->complexion,
                'contact_id' => $this->reqBody->contact,
                'a_id' => $this->reqBody->address,
                'family_id' => $this->reqBody->family,
                'horoscope' => $this->reqBody->horo
            )
        );
        if (!$result) {
            return $this->cntrlRespond(false);
        }


        return $this->cntrlRespond(['message' => 'Member updated']);
    }
    
    public function add()
    {
        $imageUploader = new imageUploader;
        $image = $imageUploader->addImage($_FILES['photo'], $this->reqBody->name);
        $memId = $this->memberModel
            ->addMember(
                array(
                    'join_date' => $this->reqBody->join_date?$this->reqBody->join_date:date('Y-m-d'),
                    'name'  => $this->reqBody->name,
                    'dob'	 => $this->reqBody->dob,
                    'caste_rel_id'	 => $this->reqBody->caste_rel_id,
                    'height'	 => $this->reqBody->height,
                    'physique' => $this->reqBody->physique,
                    'gender'	 => $this->reqBody->gender,
                    'occupation'	 => $this->reqBody->occupation,
                    'qualification'	 => $this->reqBody->qualification,
                    'photo'	 => $image,
                    'complexion'	 => $this->reqBody->complexion,
                    'contact_id' => $this->reqBody->contact,
                    'a_id' => $this->reqBody->address,
                    'family_id' => $this->reqBody->family,
                    'horoscope' => $this->reqBody->horo
                )
            );
        if (!$memId) {
            return $this->cntrlRespond(false);
        }
        

        return $this->cntrlRespond(['message' => 'Member added',
        'data' => ['id' => $memId]]);
    }

    public function delete()
    {
        $result = $this->memberModel->deleteMember($this->reqBody->id);
        if (!$result) {
            return $this->cntrlRespond(false);
        }
        
        return $this->cntrlRespond(['message' => 'Member deleted']);
    }
}
