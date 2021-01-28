<?php
namespace Matr\Controller;
use Core\data\test as test;
class Dummy extends BaseController
{

    public function __construct($a, $b)
    {
        parent::__construct($a, $b);
    }

    public function dummy(){
        $c = new test();
        return $this->response->json(["data"=>$c->result]);
    }
}
