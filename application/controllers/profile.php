<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Profile extends MY_Controller {
    public function index(){
        $system = new SYSTEM();
        
        $user_data = $this->session->userdata('logged_in');
        $profile_id = isset($_GET['id'])?$_GET['id']:$user_data['Id'];
        
        if($user_data['CurrentAccount'] == 'SOCIAL'){
            $all['isOwner'] = $this->isOwner($profile_id);
            
            $all['profile'] = $this->socialMain($profile_id);
            $data = $this->load->view('social/profile',$all,TRUE);
            
            $timeLineData = $this->socialProfileTimeLine($profile_id);
            $data .= $this->load->view('social/profile_feed',$timeLineData,TRUE);
        }
        else if($user_data['CAREER'] == 'CAREER'){
            $all = $this->careerMain($profile_id);
            $data = $this->load->view('career/profile',$all,TRUE);
        }
        
        $system->container($data);
    }
    
    public function socialMain($profile_id){
        $this->load->model('model_profile');
        
        
        
        // Friend list:
        
        // General profile:
        $data['general'] = $this->model_profile->getProfileInfo($profile_id);
        
        // Photos:
        
        // Videos:
        
        return $data;
    }
    
    public function socialProfileTimeLine($profile_id){
        $this->load->model('model_profile');
        $this->load->model('model_home');
        
        // Get loggedin user's info:
        $user_data = $this->session->userdata('logged_in');
        $data['user_id'] = $user_data['Id'];
        $data['user_current_account'] = $user_data['CurrentAccount'];
        
        $data['user_all_info'] = $this->model_home->getUserInfo($user_data['Id']);
        
        // Profile Id:
        $data['profile_id'] = $profile_id; // We are passing this profile id to the profile timeline. because we need to have profile id on pagination (ajax request)
        
        
        // Timeline for the user:
        # PAGINATION
        $currentPage = isset($_POST['pageNumber'])       ? $_POST['pageNumber']: 1;
        $page 	     = isset($_POST['pageNumber'])       ? ($_POST['pageNumber'] - 1) * 10 : 0;
        $pageLimit   = " LIMIT $page, 10";
        
        $data['posts'] = $this->model_profile->getProfileTimeLine($profile_id,$account_type='SOCIAL',$pageLimit);
        if(isset($_POST['ajax'])){
            echo $this->load->view('elements/timeline/text_message',$data);
        }
        else{
            return $this->load->view('elements/timeline/text_message',$data,TRUE);
        }
    }
    
    
    
    
    public function careerMain($profile_id){
        // General profile:
    }
    
    public function uploadImage(){
        $image_class = new COMMON();
        
        if($_FILES['fileUploadPic']['name']!='' && $_FILES['fileUploadPic']['size']>0){
            
            $user_data = $this->session->userdata('logged_in');
            $new_id = $user_data['Id'];
            
            $file_destination = $_SERVER['DOCUMENT_ROOT'].'/media/social/avatars/temp';
            $assets           = array('FILENAME'=>$new_id);
            $results = $image_class->uploadImage($_FILES['fileUploadPic'], $file_destination, $assets, true); // true means exit on error.
            
            if($results){
                echo "<img src='".base_url()."media/social/avatars/temp/".$results[0]['filename']."' id='cropImage'/>";
            }
        }
    }
    
    public function afterCropImageUpload(){
        
        $user_data = $this->session->userdata('logged_in');
        $new_id = $user_data['Id'];
            
        $src = base_url()."media/social/avatars/temp/".$new_id."_1.jpg";
        
        
        $image = new Imagick($src);
        
        // save image before crop as original:
        $outFileOriginal = $_SERVER['DOCUMENT_ROOT'].'/media/social/avatars/original/'.$new_id.'.jpg';
        $image->writeimage($outFileOriginal);
        
        // save small image: CHANGE RESOLUTION:
        $outFileSmall = $_SERVER['DOCUMENT_ROOT'].'/media/social/avatars/small/'.$new_id.'.jpg';
        $image->cropImage($_POST['w'],$_POST['h'],$_POST['x'],$_POST['y']);
        $image->writeimage($outFileSmall);
        
        // crop and save as thumb:
        $outFileThumb = $_SERVER['DOCUMENT_ROOT'].'/media/social/avatars/thumb/'.$new_id.'.jpg';
        $image->cropImage($_POST['w'],$_POST['h'],$_POST['x'],$_POST['y']);
        $uploaded = $image->writeImage($outFileThumb);
        
        if($uploaded){
            $new_file_name = $new_id.'.jpg';
            $data = array('SocialAvatar'=>$new_file_name);
            $query = new QUERY(array('TABLE'=>'Users','KEY'=>array('Id'=>$new_id)));
            $query->save($data);
        }
    }
    
}