<?php
namespace Core\data;
use Matr\Controller\Member;
use Matr\Controller\Contact;
use Matr\Controller\Family;
use Matr\Controller\Address;
use Matr\Controller\Sibling;
class MobPatch
{
    public $result;
    public function __construct()
    {
        $c = 0;
        $ver = 'v2' ;
        $prJson = json_decode(file_get_contents('../prFinal_'.$ver.'.json'));
        $memberTb = json_decode(file_get_contents('../member_tb.json'));
        foreach($prJson as $key => $value){
            foreach($memberTb as $index => $memJson){
                if($memJson->userid == $value->id){
                    $prJson[$key]->{'mobile'} = $memJson->pass;
                }
            }
        }
           file_put_contents('../prFinal_M_'.$ver.'.json',json_encode($prJson, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES ));     
    }
}