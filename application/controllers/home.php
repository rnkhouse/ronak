<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MY_Controller {
    public function index(){
        $system = new SYSTEM();
        
        // Get loggedin user's info:
        $user_data = $this->session->userdata('logged_in');
        $this->load->model('model_home');
        $user_info_db = $this->model_home->getUserInfo($user_data['Id']);
        
        if($user_data['CurrentAccount'] == 'SOCIAL'){
            $all['avatar'] = base_url().'media/social/avatars/thumb/'.$user_info_db['SocialAvatar'];
            $all['name'] = $user_info_db['FirstName'].' '.$user_info_db['LastName'];
            $data = $this->load->view('common/home_post_container',$all,TRUE);
            // send timeline data with this view:
            $timeLineData = $this->timeLine();
            $data .= $this->load->view('common/home_feed',$timeLineData,TRUE);
            $data .= $this->load->view('social/home_side',$all,TRUE);
        }
        else if($user_data['CurrentAccount'] == 'CAREER'){
            $all['avatar'] = base_url().'media/career/avatars/thumb/'.$user_info_db['CareerAvatar'];
            $all['name'] = $user_info_db['FirstName'].' '.$user_info_db['LastName'];
            $data = $this->load->view('common/home_post_container',$all,TRUE);
            // send timeline data with this view:
            $timeLineData = $this->timeLine();
            $data .= $this->load->view('common/home_feed',$timeLineData,TRUE);
            $data .= $this->load->view('career/home_side',$all,TRUE);
        }
        
        $system->container($data);
    }
    
    // social timeline:
    public function timeLine(){
        $this->load->model('model_home');
        
        // Get loggedin user's info:
        $user_data = $this->session->userdata('logged_in');
        $data['user_id'] = $user_data['Id'];
        $data['user_current_account'] = $user_data['CurrentAccount'];
        
        $data['user_all_info'] = $this->model_home->getUserInfo($user_data['Id']);
        
        # PAGINATION
        $currentPage = isset($_POST['pageNumber'])       ? $_POST['pageNumber']: 1;
        $page 	     = isset($_POST['pageNumber'])       ? ($_POST['pageNumber'] - 1) * 10 : 0;
        $pageLimit   = " LIMIT $page, 10";
        
        $data['posts'] = $this->model_home->loadTimeLine($data['user_id'],$data['user_current_account'],$pageLimit);
        if(isset($_POST['ajax'])){
            echo $this->load->view('elements/timeline/text_message',$data);
        }
        else if(!isset($_POST['ajax'])){
            return $this->load->view('elements/timeline/text_message',$data,TRUE);
        }
        else{
            echo '';
        }
    }
    
    public function indexForNewTimeLine(){
        $system = new SYSTEM();
        
        // Get loggedin user's info:
        $user_data = $this->session->userdata('logged_in');
        $this->load->model('model_home');
        $user_info_db = $this->model_home->getUserInfo($user_data['Id']);
        
        if($user_data['CurrentAccount'] == 'SOCIAL'){
            $all['avatar'] = base_url().'media/social/avatars/thumb/'.$user_info_db['SocialAvatar'];
            $all['name'] = $user_info_db['FirstName'].' '.$user_info_db['LastName'];
            $data = $this->load->view('common/home_post_container',$all,TRUE);
            // send timeline data with this view:
            $timeLineData = $this->newTimeLine();
            $data .= $this->load->view('common/home_feed',$timeLineData,TRUE);
            $data .= $this->load->view('social/home_side',$all,TRUE);
        }
        else if($user_data['CurrentAccount'] == 'CAREER'){
            $all['avatar'] = base_url().'media/career/avatars/thumb/'.$user_info_db['CareerAvatar'];
            $all['name'] = $user_info_db['FirstName'].' '.$user_info_db['LastName'];
            $data = $this->load->view('common/home_post_container',$all,TRUE);
            // send timeline data with this view:
            $timeLineData = $this->newTimeLine();
            $data .= $this->load->view('common/home_feed',$timeLineData,TRUE);
            $data .= $this->load->view('career/home_side',$all,TRUE);
        }
        
        $system->container($data);
    }
    
    // New timeline:
    public function newTimeLine(){
        $this->load->model('model_home');
        
        if(isset($_POST['request_new_timeline'])){
            // Get loggedin user's info:
            $user_data = $this->session->userdata('logged_in');
            $data['user_id'] = $user_data['Id'];
            $data['user_current_account'] = $user_data['CurrentAccount'];
            
            $data['user_all_info'] = $this->model_home->getUserInfo($user_data['Id']);

            $data['posts'] = $this->model_home->loadNewTimeLine($data['user_id'],$data['user_current_account']);
            //echo '<pre>';
            //print_r($data['posts']);
            //echo '</pre>';
            echo $this->load->view('elements/new_timeline/text_message',$data);
        }
        else{
            echo "no direct access for now!";
        }
    }
    
    public function submitStatus(){
        $this->load->model('model_home');
        
        // Get loggedin user's info:
        $user_data = $this->session->userdata('logged_in');
        $data['user_id'] = $user_data['Id'];
        $data['user_current_account'] = $user_data['CurrentAccount'];
        
        $data['user_all_info'] = $this->model_home->getUserInfo($user_data['Id']);
        
        $content = ($_POST['post_message'] != '')?$_POST['post_message']:'';
        $filter = isset($_POST['filter'])?$_POST['filter']:'PUBLIC';
        
        if(!($_FILES['my_image']['type'][0])){
            $data['posts'] = $this->model_home->submitStatus($data['user_id'],$content,$data['user_current_account']);
        }
        else{
            foreach($_FILES['my_image']['type'] as $content_type){
                
            }
        }
        
        echo $this->load->view('elements/timeline/text_message',$data,TRUE);
    }
    
    
    
    
    // For account change:
    public function switchAccount(){
        $user_data = $this->session->userdata('logged_in');
        
        if($user_data['CurrentAccount'] == 'SOCIAL'){
            $user_data['CurrentAccount'] = 'CAREER';
            $this->session->set_userdata('logged_in',$user_data);
            echo 'career';
        }
        else if($user_data['CurrentAccount'] == 'CAREER'){
            $user_data['CurrentAccount'] = 'SOCIAL';
            $this->session->set_userdata('logged_in',$user_data);
            echo 'social';
        }
    }
    
    
}