<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Message extends MY_Controller {
    public function index(){
        $system = new SYSTEM();
        
        
        $this->load->model('model_home');
        $this->load->model('model_message');
        
        // Get loggedin user's info:
        $user_data = $this->session->userdata('logged_in');
        $all['user_id'] = $user_data['Id'];
        $all['user_current_account'] = $user_data['CurrentAccount'];
        
        $friendsId = $this->model_home->getFriendList($all['user_id'],$all['user_current_account']);
        $friendsString = '';
        foreach($friendsId as $fId){
            $friendsString .= $fId['Friend'].',';
        }
        $all['friends'] = $this->model_message->getFriendsDetail(rtrim($friendsString, ","));
        
        $data = $this->load->view('/common/message',$all,TRUE);
        $system->container($data);
    }
}