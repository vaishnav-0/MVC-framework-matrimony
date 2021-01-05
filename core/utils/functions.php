<?php
namespace Core\utils\functions;
function filterArray(array $array){
    return array_filter($changes,function($value){
        if($value)
            return true;
        return false;
    });
}