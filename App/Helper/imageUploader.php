<?php
namespace Matr\Helper;

class imageUploader
{
    public function addImage($image,$name)
    {
        $image = new \Bulletproof\Image($image);
        $image->setLocation(UPLOADED_IMAGE_PATH);
        $image->setName(uniqid(strtoupper(substr($name,0,4))."_"));              
        $image->getMime();  // bulletproof is strange
        $image->getFullPath();
        
        $upload = $image->upload();
        if ($upload) {
            return $upload->getName().'.'.$image->getMime();
        } else {
            return $image->getError();
        }
    }
}
