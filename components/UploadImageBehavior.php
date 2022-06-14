<?php

namespace app\components;

use yii\web\UploadedFile;

class UploadImageBehavior extends \yii\base\Behavior
{
    private UploadedFile $_image;

    public function uploadFile(UploadedFile $file, $currentImage = '')
    {
        $this->_image = $file;

        $this->deleteCurrentImage($currentImage);

        return $this->saveImage();
    }

    private function getImageFolder()
    {
        return \Yii::getAlias('@web') . 'uploads/';
    }

    private function generateFileName()
    {
        return strtolower(md5(uniqid($this->_image->baseName)) . '.' . $this->_image->extension);
    }

    protected function deleteCurrentImage($currentImage)
    {
        if($this->isFileExists($currentImage)){
            unlink($this->getImageFolder() . $currentImage);
        }
    }

    private function isFileExists($currentImage)
    {
        return !empty($currentImage) && file_exists($this->getImageFolder() . $currentImage);
    }

    private function saveImage()
    {
        $filename = $this->generateFileName();
        $this->_image->saveAs($this->getImageFolder() . $filename);

        return $filename;
    }
}