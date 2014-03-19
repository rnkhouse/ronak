<?php

class COMMON{
    function uploadImage($file_container,$file_destination,$assets=array(),$exit_on_error=false)
        {
           # ALLOWED INDEX FOR ASSETS
           # 'CAPTION'  : array(), must have the same number of elements as the file being uploaded  
           # 'FILENAME' : string,  the filename of the file being uploaded
           # 'RESIZE'   : boolean, (true by default) 
           # 'RATIO_X'  : boolean, (true by default) sets the ratio X resize
           # 'IMAGE_Y'  : numeric, (400 by default) sets the image Y value 
           
           $allowedTypes = array('image/gif','image/jpeg','image/jpg','image/pjpeg','image/x-png','image/png');
           
           
           # INITIATE FILES 
           $raw_files    = array();
           $valid_files  = array();
           $return_file  = array();
           $error        = false;
           
           if(is_array($file_container['name']))
               {
                    # PROCESS THE RAW FILE
                    foreach($file_container as $key => $files){
                         $count = 0;
                         foreach($files as $value){
                             $raw_files[$count][$key]      = $value;
                             $count++;
                         }
                    }
               }
           else
               { 
                  $raw_files[0] =   $file_container;
               }    
           
           # REMOVE INVALID FILES
           $index        = 0;
           $caption_ctr  = 0;
           foreach($raw_files as $raw_file){
               
                    #  BIND THE CAPTION TO THE PHOTO ARRAY. HANDLE IT IF ITS NOT PASSED AS AN ARRAY
                    $raw_file['caption'] = array_key_exists('CAPTION', $assets) ? (is_array($assets['CAPTION'])?$assets['CAPTION'][$caption_ctr]:$assets['CAPTION']) : '';
               
                    # FILTER THE VALID UPLOADS
                    if(in_array($raw_file['type'],$allowedTypes)){

                       $valid_files[$index] = $raw_file; 
                       $index++;
                    }
                    else if($exit_on_error){ return false; } 
                    
                    
                    $caption_ctr++;
              
           }
           
           
          # PROCESS THE UPLOAD
          $ctr = 1; 
          foreach($valid_files as $file){
              
                           # CREATE AN INSTANCE OF THE CLASS
                           if (!class_exists('upload')) {
                               require_once(APPPATH.'libraries/upload.php');
                           }
                           $handle = new upload($file);
                           
                           # UPLOAD OPTIONS
                           $handle->auto_create_dir    = false;
                           $handle->file_overwrite     = true;
                           
                           $handle->file_new_name_body = array_key_exists('FILENAME', $assets) ? $assets['FILENAME'].'_'.$ctr : $ctr;
                           $handle->image_resize       = array_key_exists('RESIZE', $assets)   ? $assets['RESIZE']            : true;
                           $handle->image_ratio_x      = array_key_exists('RATIO_X', $assets)  ? $assets['RATIO_X']           : true;
                           $handle->image_y            = array_key_exists('IMAGE_Y', $assets)  ? $assets['IMAGE_Y']           : 400;
                           
                           # CREATE THE FILE 
                           $handle->Process($file_destination); // DOC_ROOT . 'media/review_images/temp/'
                           
                           # IF AN ERROR OCCURRED
                           if(!$handle->processed){
                               $error = true; 
                               break;
                           }
                           
                           # PREPARE THE RETURN FILES
                           $return_file[$ctr -1]['filename'] = $handle->file_dst_name; 
                           $return_file[$ctr -1]['caption']  = $file['caption'];
                           
                           # INCREMENT THE COUNTER
                           $ctr++;               
          } 
          return !$error ? (!empty($return_file) ? $return_file : false) : false;
        }
}


?>
