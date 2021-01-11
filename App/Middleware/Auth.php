<?php
namespace Matr\Middleware;

use Closure;
use Core\Request;
use Core\Response;
use Core\MiddleLayerInterface;

class Auth implements MiddleLayerInterface
{
    public function handle(Request $req, Response $res, Closure $next):Response
    {
        if (isset($_SESSION['Auth'])) {
            return $next($req, $res);
        } else {
            return $res->json(['status' => 'fail','message' => 'Not authorised']);
        }
    }
}
