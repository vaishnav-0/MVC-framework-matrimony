<?php
namespace Matr\Helper;

class upload{
    public function addImage($img){
        $image = new Bulletproof\Image($img);
        $image->setLocation('./static');
        if($image["pictures"]){
            $upload = $image->upload(); 
            if($upload){
                return $upload->getFullPath();
            }
            else{
                return $image->getError(); 
            }
        }
    }
}
?>