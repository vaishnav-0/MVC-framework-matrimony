<?php
namespace Matr\Helper;

class upload{
    public function addImage($image){

// import bulletproof here

        $image = new Bulletproof\Image($image);
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