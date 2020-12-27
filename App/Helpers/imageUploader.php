<?php
namespace Matr\Helper;
use Bulletproof\Image;
class imageUploader{
    public function addImage($image){

// import bulletproof here

        $image = new Image($image);
        $image->setLocation(UPLOADED_IMAGE_PATH);
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