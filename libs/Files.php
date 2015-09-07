<?php

class Files{
    
    function __construct() {
        
    }
    
    /**
    * upload picture
    * @param string $file -- the name of the file to be uploaded
    * @param string $tmp_file -- temporary file 
    * @param string $file_ext -- file extension
    * @param string $relative_img_path - the relative path where the image should be placed 
    */
    public static function uploadPhoto($file, $tmp_file, $relative_img_path, $suffix, $fromAPI = false){
        
//        if($file_ext != "png" && $file_ext != "jpg" && $file_ext != "gif"){
//            $status_arr = array("isUploaded" => false);
//            return $status_arr;
//            die;
//        }
        
        $rand_file_name = uniqid();
        $db_image_path = ($fromAPI == true) ? URL . $relative_img_path . $rand_file_name . $file : URL . $relative_img_path . $file; //removed uniqid 
        
        $upload_path = ($fromAPI == true) ? $relative_img_path . $rand_file_name . $file : $relative_img_path . $file;
        
        if(move_uploaded_file($tmp_file, $upload_path)){
            $status_arr = array("isUploaded" => true, "dBImagePath" => $db_image_path);
        }
        else{
            $status_arr = array("isUploaded" => false);
        }
        
        return $status_arr;
    }
    
}