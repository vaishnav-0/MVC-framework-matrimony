<?php
namespace Core;
class Request
{
    public $url;
    private $path;
    private $method;
    private $args = [];
    public function __construct()
    {
        $this->url = $_SERVER['REQUEST_URI'];
        $this->evalReq();
    }
    
    public function strip()
    {
        $ar = explode('/', $this->url);
        $ar_pos = array_search("matrimony", $ar) + 1;
        $ar = array_slice($ar, $ar_pos);
        return $ar;
    }
    private function evalReq()
    {
        $arc = $this->strip();
        $this->path = implode('/',$arc);
        $this->method = $_SERVER['REQUEST_METHOD'];
        if($_GET){
            foreach($_GET as $key => $value)
                $this->args[$key] = $value; 
        }
        else if($_POST){
            foreach($_POST as $key => $value)
                $this->args[$key] = $value; 
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


