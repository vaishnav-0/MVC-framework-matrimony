<?php

namespace Core\Routing;

trait VerbShortcutsTrait
{
    public function get($pattern,array $handler) {
        return $this->map(['GET'],$pattern,$handler);
    }
    public function post($pattern, array $handler) {
        return $this->map(['POST'],$pattern,$handler);
    }
    public function patch($pattern, array $handler) {
        return $this->map(['PATCH'],$pattern,$handler);
    }
    public function delete($pattern, array $handler) {
        return $this->map(['DELETE'],$pattern,$handler);
    }
}