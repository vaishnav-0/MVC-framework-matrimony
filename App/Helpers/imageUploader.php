<?php
namespace Matr\Helper;

class upload{
    public function addImage(){

// import bulletproof here

        $image = new Bulletproof\Image();
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