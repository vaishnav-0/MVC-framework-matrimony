<?php
namespace Matr\Helper;

class imageUploader
{
    public function addImage($image)
    {
        $image = new \Bulletproof\Image($image);
        $image->setLocation(UPLOADED_IMAGE_PATH);
        $image->getName();              // bulletproof is strange
        $image->getMime();
        $image->getFullPath();
        
        $upload = $image->upload();
        if ($upload) {
            return $upload->getName().'.'.$image->getMime();
        } else {
            return $image->getError();
        }
    }
}
