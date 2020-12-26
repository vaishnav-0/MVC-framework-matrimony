<?php
namespace Matr\Controller;
use Core\Request;
use Core\Response;
abstract class BaseController{
    protected $request;
    protected $response;
    protected $con;
    protected $reqBody;
    public function __construct(Request $req, Response $res){
        $this->request = $req;
        $this->response = $res;
    }
}
?>