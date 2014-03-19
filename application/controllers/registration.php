<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Registration extends MY_Controller {
    public function index(){
        $this->profilePic();
    }
    
    public function profilePic(){
        $system = new SYSTEM();
        $data = $this->load->view('common/registration_upload_image');
        $system->container($data);
    }
}