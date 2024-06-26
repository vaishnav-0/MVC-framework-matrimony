<?php
namespace Matr\Controller;

use Matr\Model\dbModel\dbconn\dbmatrModel as Connection;
use Core\Request;
use Core\Response;

abstract class BaseController
{
    protected $request;
    protected $response;
    protected $reqBody;
    public function __construct(Request $req, Response $res)
    {
        $this->request = $req;
        $this->response = $res;
        $this->reqBody = $this->request->getParsedBody();
    }
    protected function cntrlRespond($data)
    {
        if ($data) {
            return $this->response->json(array_merge(["status"=>"success"], $data));
        } else {
            return $this->response->json(["status"=>"fail"]);
        }
    }
    public function traverseAndConvert(array $ar){
        foreach($ar as $key => $val){
            if(is_array($val)){
                $arr = $this->traverseAndConvert($val);
                $ar[$key] = $arr;
            }
            if(is_string($val)){
                if($obj = json_decode($val)){
                    $ar[$key] = $obj;
                }
            }
        }
        return $ar;
    }
    
    public function callController($c, $f, array $body)
    {
        $req = new Request();
        $req = $req->withBody($body);
        $res = new Response();
        $c = 'Matr\\Controller\\'.$c;
        $controller = new $c($req, $res);
        return json_decode($controller->$f()->getBody());
    }
}
