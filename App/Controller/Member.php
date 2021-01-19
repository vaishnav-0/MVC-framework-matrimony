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
    public function getAllDet()
    {
        $result = $this->memberModel->getMember($this->reqBody->id)[0];
        if (!$result) {
            return $this->cntrlRespond(false);
        }
        if($json = json_decode($result['horoscope'])){
            $result['horoscope'] = $json;
        }
        if ($result['contact_id']) {
            $memCon = $this->callController('Contact', 'get', array(
                "id" => $result['contact_id'],
            ))->data->{0};
            $result['contact'] = $memCon;
        }
        if ($result['caste_rel_id']) {
            $memRel = $this->callController('Religion', 'getRelAndCaste', array(
                "id" => $result['caste_rel_id']
            ))->data->{0};
            $result['religion'] = $memRel;
        }
        if ($result['a_id']) {
            $memAdd = $this->callController('Address', 'get', array(
                "id" => $result['a_id'],
            ))->data->{0};
            $result['address'] = $memAdd;
        }
        if ($result['family_id']) {
            $memFam = $this->callController('Family', 'get', array(
                "id" => $result['family_id'],
            ))->data->{0};
            $result['family'] = $memFam;
            if ($memFam->fCId) {
                $fCon = $this->callController('Contact', 'get', array(
                    "id" => $memFam->fCId
                ))->data->{0};
                $result['family']->{'fCon'} = $fCon;
            }
            if ($memFam->mCId) {
                $mCon = $this->callController('Contact', 'get', array(
                    "id" => $memFam->mCId
                ))->data->{0};
                $result['family']->{'mCon'} = $mCon;
            }
            $memSib = $this->callController('Sibling', 'getWFam', array(
                "id" => $memFam->pId,
            ));
            if ($memSib->status === 'success') {
                $result['family']->{'sibling'} = $memSib->data;
            }
        }

        
        return $this->cntrlRespond(['data' => $result]);
    }
    public function edit()
    {
        $image = 'default.jpg';
        if ($_FILES['photo']['error'] === 0) {
            $imageUploader = new imageUploader;
            $image = $imageUploader->addImage($_FILES['photo'], json_decode($this->get()->getBody())->data->{0}->name);
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
                'star' => $this->reqBody->star,
                'horoscope' => $this->reqBody->horo
            )
        );
        
        $memconId = $this->callController('Contact', 'edit', array(
            "id" => $this->reqBody->id,
            "mobile" => $this->reqBody->mobile,
            "mail" =>$this->reqBody->mail,
            "landline" =>$this->reqBody->landline
        ));
        $aId = $this->callController('Address', 'edit', array(
            "id" => $this->reqBody->id,
            'addr' => $this->reqBody->addr,
            'city'	 => $this->reqBody->city,
            'dist'	 => $this->reqBody->dist,
            'pin'	 => $this->reqBody->pin,
            'landmark'	 => $this->reqBody->landmark,
            ));
        if (!$result) {
            return $this->cntrlRespond(false);
        }
        
        return $this->cntrlRespond(['message' => 'Member updated']);
    }
    
    public function add()
    {
        $image = 'default.jpg';
        if ($_FILES['photo']['error'] === 0) {
            $imageUploader = new imageUploader;
            $image = $imageUploader->addImage($_FILES['photo'], $this->reqBody->name);
        }
        $memId = $this->memberModel
            ->addMember(
                array(
                    'join_date' => $this->reqBody->join_date?$this->reqBody->join_date:date('Y-m-d'),
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
                    'family_id' => $this->reqBody->family,
                    'star' => $this->reqBody->star,
                    'horoscope' => $this->reqBody->horo
                )
            );
        if (!$memId) {
            return $this->cntrlRespond(false);
        }
        
        $aId = $this->callController('Address', 'add', array(
            'addr' => $this->reqBody->addr,
            'city'	 => $this->reqBody->city,
            'dist'	 => $this->reqBody->dist,
            'pin'	 => $this->reqBody->pin,
            'landmark'	 => $this->reqBody->landmark,
            ))->data->id;
        if ($aId) {
            $this->memberModel->editMember(
                $memId,
                array(
                'a_id' => $aId
            )
            );
        }
        $memconId = $this->callController('Contact', 'add', array(
            "mobile" => $this->reqBody->mobile,
            "mail" =>$this->reqBody->mail,
            "landline" =>$this->reqBody->landline
        ))->data->id;
        if ($memconId) {
            $this->memberModel->editMember(
                $memId,
                array(
                'contact_id' => $memconId
            )
            );
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
