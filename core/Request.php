<?php
namespace Core;
use Notihnio\RequestParser\RequestParser;
class Request
{
    public $url;
    private $path;
    private $method;
    private $body;
    public function __construct()
    {
        $this->body = new \stdClass;
    }
    
    public static function strip()
    {
        $ar = explode('/', trim(Request::getReqUrl(), '/'));
        $ar_pos = array_search("matrimony", $ar) + 1;
        $ar_get_pos = array_key_first(preg_grep('/^\?/', $ar));
        $ar = array_slice($ar, $ar_pos);
        if (isset($ar_get_pos)){
            $ar = array_slice($ar, 0, $ar_get_pos - 1);
        }
        return $ar;
    }
   
    public static function getReqMethod(){
        return $_SERVER['REQUEST_METHOD'];
    }
    public static function getReqUrl(){
        return $_SERVER['REQUEST_URI'];
    }
    public static function getReqPath(){
        $arc = Request::strip();
        return implode('/', $arc);
    }
    public static function getReqBody(){
        $req = RequestParser::parse();
        return $req->params;
    }
    public function withParsedBody($params){
        $new = clone $this;
        foreach ($params as $key => $value) {
            $new->body->{$key} = $value;
        }
        return $new;
    }
    public function getParsedBody(){
        return $this->body;
    }
    public function withUrl($url){
        $new = clone $this;
        $new->url = $url;
        return $new;
    }
    public function withMethod($method){
        $new = clone $this;
        $new->method = $method;
        return $new;
    }
    public function withPath($path){
        $new = clone $this;
        $new->path = $path;
        return $new;
    }
    public function getArgs()
    {
        return $this->args;
    }
    public function getPath()
    {
        return $this->path;
    }
    public function getMethod()
    {
        return $this->method;
    }
}
