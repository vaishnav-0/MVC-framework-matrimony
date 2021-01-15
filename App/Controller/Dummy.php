<?php
namespace Matr\Controller;
use Core\data\addCaste;
class Dummy extends BaseController
{

    public function __construct($a, $b)
    {
        parent::__construct($a, $b);
    }

    public function dummy(){
        $c = new addCaste();
        return $this->response->json(["status"=>"success"]);
    }
}
