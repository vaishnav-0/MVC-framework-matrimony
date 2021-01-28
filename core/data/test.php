<?php
namespace Core\data;

use Core\Request;
use Core\Response;
use Matr\Controller\Religion;
use Matr\Controller\Member;
use Matr\Controller\Contact;
use Matr\Controller\Family;
use Matr\Controller\Address;
use Matr\Controller\Sibling;

class test
{
    public $result;
    public function __construct()
    {
        $prJson = json_decode(file_get_contents('../prFinal_M_D_v2.json'));
        $req = new Request;
        $res = new Response;
        foreach ($prJson as $key => $val) {
            $reqRel = $req->withBody(array('rel'=>$val->reg));
            $rel = new Religion($reqRel, $res);
            $castes = json_decode($rel->getAllCaste()->getBody())->data;
            foreach ($castes as $k =>$v) {
                if ($v->caste == $val->cast) {
                    $casteId = $v->id;
                }
            }
            $horo = json_encode(array('board1' =>array('a1'=>$val->a1,'a2'=>$val->a2,'a3'=>$val->a3,'a4'=>$val->a4,'a5'=>$val->a5,'a6'=>$val->a6,'a7'=>$val->a7,'a8'=>$val->a8,'a9'=>$val->a9,'a10'=>$val->a10,'a11'=>$val->a11,'a12'=>$val->a12),
           'board2'=>array('b1'=>$val->a13,'b2'=>$val->a14,'b3'=>$val->a15,'b4'=>$val->a16,'b5'=>$val->a17,'b6'=>$val->a18,'b7'=>$val->a19,'b8'=>$val->a20,'b9'=>$val->a21,'b10'=>$val->a22,'b11'=>$val->a23,'b12'=>$val->a24)), JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
            $reqData = array(
                'join_date' => date('Y-m-d'),
                'name'  => $val->name,
                'dob'	 => \DateTime::createFromFormat('Y/d/m', $val->dat)?$val->dat:'1900/01/01',
                'caste_id'	 => $casteId,
                'height'	 => $val->height,
                'physique' => '',
                'gender'	 => $val->sex,
                'occupation'	 => $val->job,
                'qualification'	 => $val->qualification,
                'photo'	 => $val->upload,
                'complexion'	 => $val->comp,
                'star' => $val->star,
                'horo' => $horo,
                'addr' => $val->addr?$val->addr:'-',
                'city'	 => $val->loc?$val->loc:'-',
                'dist'	 => '-',
                'pin'	 => '0',
                'landmark'	 => '',
                "mobile" => is_numeric($val->tel)?$val->tel:$val->mob,
                "mail" =>'',
                "landline" =>''
            );
            $reqMem = $req->withBody($reqData);
            $mem = new Member($reqMem, $res);
            $memId = json_decode($mem->add()->getBody())->data->id;
            $reqFam = $req->withBody(array("fName"=>$val->fname?$val->fname:'-',
            "mName"=>$val->mname?$val->mname:'-',
            "fOcc"=>$val->focc,
            "mOcc"=>$val->mocc
            ));
            $fam = new Family($reqFam, $res);
            $famId = json_decode($fam->add()->getBody())->data->id;
            $reqMemUpd = $req->withBody(array('id' => $memId, 'family' => $famId));
            $mem = new Member($reqMemUpd, $res);
            $mem->edit();
        }
    }
}
