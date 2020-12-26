<?php
namespace Matr\Controller;
use Matr\Model\dbModel\dbconn\dbmatrModel as Connection;
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
        $this->reqBody = $this->request->body;
        $this->con = Connection::GetCon();
    }
    protected function cntrlRespond($data, bool $pass){
        if ($pass) {
            $this->response->json((object) $data);
        } elseif ($data && !$pass) {
            $this->response->json((object)["status"=>"success"]);
        } else {
            $this->response->json((object)["status"=>"failed"]);
        }
    }
}
?>