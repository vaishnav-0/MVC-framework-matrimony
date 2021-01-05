<?php
namespace Matr\Middleware;
use Closure;
use Core\Request;
use Core\Response;
use Core\MiddleLayerInterface;
class middlewareTest implements MiddleLayerInterface{
    public function handle(Request $req,Response $res, Closure $next):Response{
        if($req->body->auth)
            return $next($req,$res);
        return $res->withStatus(401);
    }
}