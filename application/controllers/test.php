<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Test extends CI_Controller {
    public function index(){
        $this->load->view('test');
    }
    
    public function timeLine(){
        echo "here";
        die();
        $this->load->model('model_home');
        
        // Get loggedin user's info:
        $user_data = $this->session->userdata('logged_in');
        $data['user_id'] = $user_data['Id'];
        $data['user_current_account'] = $user_data['CurrentAccount'];
        
        $data['posts'] = $this->model_home->loadTimeLine($data['user_id'],$pageNumber);
        echo $this->load->view('elements/timeline/text_message',$data);
        /*
        foreach($all as $a){
            $content = $a['Content'];
            echo '<h1><a href="'.$a['Id'].'">'.$a['Content'].'</a></h1><hr />';
            echo '<p>'.$content.'...</p><hr />';
        }
        */
    }
}