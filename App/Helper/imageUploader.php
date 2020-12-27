<?php
namespace Matr\Helper;
class imageUploader{
    public function addImage($image){

// import bulletproof here

        $image = new \Bulletproof\Image($image);
        $image->setLocation(UPLOADED_IMAGE_PATH);
        if($image["pictures"]){
            $upload = $image->upload(); 
            if($upload){
                return $upload->Getname();
            }
            else{
                return $image->getError(); 
            }
        }
    }
}
?>