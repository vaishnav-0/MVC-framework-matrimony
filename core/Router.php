<?php
namespace Core;

class Router
{
    public $url;
    private $controller;
    private $method;
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
    private function evalReq(){
        $arc = $this->strip();
        $this->controller = $arc[0];
        $this->method = $_SERVER['REQUEST_METHOD'];
    }
    public function getController()
    {
        return $this->controller;
    }
    public function getMethod()
    {
        return $this->method;
    }
    
}
