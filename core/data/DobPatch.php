<?php
namespace Core\data;

use Matr\Controller\Member;
use Matr\Controller\Contact;
use Matr\Controller\Family;
use Matr\Controller\Address;
use Matr\Controller\Sibling;

class DobPatch
{
    public $result;
    public function __construct()
    {
        $c = 0;
        $ver = 'v2';
        $prJson = json_decode(file_get_contents('../prFinal_M_'.$ver.'.json'));
        $changes = ['JAN'=>'1','FEB'=>'2','MAR'=>'3','APR'=>'4','MAY'=>'5','JUN'=>'6','JUL'=>'7','AUG'=>'8','SEP'=>'9','OCT'=>'10','NOV'=>'11','DEC'=>'12'];
        foreach ($prJson as $k => $v) {
            $d = explode('/', $v->dat);
            if (!is_array($d)) {
                $d = explode(',', $v->dat);
            }
            if (!is_numeric($d[0])) {
                $d[0] = $changes[$d[0]];
                $tmp = $d[1];
                $d[1] = $d[0];
                $d[0] = $tmp;
            }
            $d = array_reverse($d);
            $prJson[$k]->dat = implode('/', $d);
        }
        print_r($prJson);
        file_put_contents('../prFinal_M_D_'.$ver.'.json', json_encode($prJson, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
    }
}
