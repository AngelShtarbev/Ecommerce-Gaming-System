<?php
class fileUpload {

    private $extentions = array('jpg', 'png', 'gif', 'jpeg', 'bmp');
    private $fileSize = 1024000;
    private $name;

    public function __construct($name) {
        $this->name = $name;
    }

    public function upload($path)
    {
        $fileTmp  = $_FILES[$this->name]['tmp_name'];
        return move_uploaded_file($fileTmp, $path);
    }

    public function validate()
    {
        $imageErrors = array();
        if (isset($_FILES[$this->name])) {
            $fileName = $_FILES[$this->name]['name'];
            $fileSize = $_FILES[$this->name]['size'];
            $fileTmp  = $_FILES[$this->name]['tmp_name'];
            $fileType = $_FILES[$this->name]['type'];
            $fileExtention = strtolower(end(explode('.', $fileName)));
            $allowExtentions = array('jpg','jpeg', 'png', 'gif');

            if (!in_array($fileExtention, $this->extentions)) {
                $imageErrors = 'Wrong extention';
            }

            if ($fileSize > $this->fileSize) {
                $imageErrors = 'Your file is bigger than 1mb';
            }

        }

        return $imageErrors;
    }

    public function getFilename()
    {
        if (isset($_FILES[$this->name]['name'])) {
            return $_FILES[$this->name]['name'];
        }

        return '';
    }

    public function getFileExtention()
    {
        if (isset($_FILES[$this->name])) {
            $fileExtention = strtolower(end(explode('.', $_FILES[$this->name]['name'])));
            return $fileExtention;
        }

        return '';
    }


    public function setFileSize($int)
    {
        $this->filesize = $int;
    }

    public function getFileSize()
    {
        return $this->fileSize;
    }

    public function setExtentions($array)
    {
        $this->extentions = $array;
    }

    public function getExtentions()
    {
        return $this->extentions;
    }


}