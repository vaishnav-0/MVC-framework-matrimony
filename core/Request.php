<?php
namespace Core;
class Request
{
    public $url;
    private $path;
    private $method;
    public $body;
    public function __construct()
    {
        $this->body = new \stdClass;
        $this->url = $_SERVER['REQUEST_URI'];
        $this->evalReq();
    }
    
    public function strip()
    {   
        if (!function_exists('array_key_first')) { // polyfill for array_key_first
            function array_key_first(array $arr) {
                foreach($arr as $key => $unused) {
                    return $key;
                }
                return NULL;
            }
        }
        $ar = explode('/', trim($this->url,'/'));
        $ar_pos = array_search("matrimony", $ar) + 1;
        $ar_get_pos = array_key_first(preg_grep('/^\?/',$ar));
        $ar = array_slice($ar, $ar_pos);
        if(isset($ar_get_pos)){
            $ar = array_slice($ar, 0, $ar_get_pos - 1);
        }
        return $ar;
    }
    private function evalReq()
    {
        $arc = $this->strip();
        $this->path = implode('/',$arc);
        $this->method = $_SERVER['REQUEST_METHOD'];
        if($_GET){
            foreach($_GET as $key => $value)
                $this->body->{$key} = $value;
            return;
        }
        else if($_POST){
            foreach($_POST as $key => $value)
                $this->body->{$key} = $value;
            return;

        }else{
            $content = json_decode(file_get_contents("php://input"));
            if($content)
                foreach($content as $key => $value)
                    $this->body->{$key} = $value; 
        }
    }
    public function getArgs(){
        return $this->args;
    }
    public function getPath(){
        return $this->path;
    }
    public function getMethod(){
        return $this->method;
    }
}


