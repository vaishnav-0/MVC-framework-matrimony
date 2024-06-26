<?php
namespace Core;
class Response
{
    protected $body;
    protected $statusCode;
    protected $reasonPhrase;
    protected $headers;
    protected $http_status_codes = array(100 => "Continue", 101 => "Switching Protocols", 102 => "Processing", 200 => "OK", 201 => "Created", 202 => "Accepted", 203 => "Non-Authoritative Information", 204 => "No Content", 205 => "Reset Content", 206 => "Partial Content", 207 => "Multi-Status", 300 => "Multiple Choices", 301 => "Moved Permanently", 302 => "Found", 303 => "See Other", 304 => "Not Modified", 305 => "Use Proxy", 306 => "(Unused)", 307 => "Temporary Redirect", 308 => "Permanent Redirect", 400 => "Bad Request", 401 => "Unauthorized", 402 => "Payment Required", 403 => "Forbidden", 404 => "Not Found", 405 => "Method Not Allowed", 406 => "Not Acceptable", 407 => "Proxy Authentication Required", 408 => "Request Timeout", 409 => "Conflict", 410 => "Gone", 411 => "Length Required", 412 => "Precondition Failed", 413 => "Request Entity Too Large", 414 => "Request-URI Too Long", 415 => "Unsupported Media Type", 416 => "Requested Range Not Satisfiable", 417 => "Expectation Failed", 418 => "I'm a teapot", 419 => "Authentication Timeout", 420 => "Enhance Your Calm", 422 => "Unprocessable Entity", 423 => "Locked", 424 => "Failed Dependency", 424 => "Method Failure", 425 => "Unordered Collection", 426 => "Upgrade Required", 428 => "Precondition Required", 429 => "Too Many Requests", 431 => "Request Header Fields Too Large", 444 => "No Response", 449 => "Retry With", 450 => "Blocked by Windows Parental Controls", 451 => "Unavailable For Legal Reasons", 494 => "Request Header Too Large", 495 => "Cert Error", 496 => "No Cert", 497 => "HTTP to HTTPS", 499 => "Client Closed Request", 500 => "Internal Server Error", 501 => "Not Implemented", 502 => "Bad Gateway", 503 => "Service Unavailable", 504 => "Gateway Timeout", 505 => "HTTP Version Not Supported", 506 => "Variant Also Negotiates", 507 => "Insufficient Storage", 508 => "Loop Detected", 509 => "Bandwidth Limit Exceeded", 510 => "Not Extended", 511 => "Network Authentication Required", 598 => "Network read timeout error", 599 => "Network connect timeout error");
    public function __construct(int $status = 200, array $headers = [])
    {
        $this->setStatusCode($status);
        $this->setHeaders($headers);
    }
    public function getProtocolVersion(){
        return $_SERVER["SERVER_PROTOCOL"];
    }
    public function json($obj)
    {
        $res = $this->withBody(json_encode($obj, JSON_FORCE_OBJECT));
        $res->setHeader('Content-Type',['application/json']);
        return $res;
    }
    public function getHeaders(){
        return $this->headers;
    }
    public function getHeader(string $name):array{
        if($this->headers[$name])
            return $this->headers[$name];
        return [];
    }
    public function withHeader(string $name,array $value){
        $new = clone $this;
        $new->setHeader($name,$value);
        return $new;
    }
    private function setHeaders($headers){
        $this->headers = $headers;

    }
    private function setHeader(string $feild,array $val){
        $this->headers[$feild] = $val;
    }
    public function withStatus($code) : Response
    {
        $new = clone $this;
        $new->setStatusCode($code);
        return $new;
    }
    public function getReasonPhrase() : string
    {
        return $this->reasonPhrase;
    }
    public function getStatusCode(){
            return $this->statusCode;
    }
    private function setStatusCode($code){
        if(isset($this->http_status_codes[$code]))
        {
            $this->statusCode = $code;
            $this->reasonPhrase = $this->http_status_codes[$code];}
        else{
            $this->statusCode = '500';
            $this->reasonPhrase = $this->http_status_codes['500'];
        }

    }
    public function getBody(){
        return $this->body;
    }
    public function withBody($body){
        $new = clone $this;
        $new->body = $body;
        return $new;
    }
    
}
