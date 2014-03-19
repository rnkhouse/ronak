<?php
class MY_Controller extends CI_Controller {
    public function __construct()
    {
        date_default_timezone_set('America/New_York');
        parent::__construct();
        if (!$this->session->userdata('logged_in'))
        {
            redirect('/');
        }
        // Now we can easily load our desired stuff
        $this->load->helper('url');
    }
    
    public function getSessionData(){
        return $this->session->userdata('logged_in');
    }
    public function getUserInfo($id){
        $this->load->model('model_home');
        return $this->model_home->getUserInfo($id);
    }
    
    // Check for loggedin user and guest user(profile viewer):
    public function isOwner($viewer_id){
        $user_session_data = $this->getSessionData();
        if($viewer_id == $user_session_data['Id']){
            return true;
        }
        else{
            return false;
        }
    }
    
    // My custom pagination function:
    public function my_pagination($url,$total_rows,$per_page){
        // Pagination:
        $this->load->library('pagination');
        $config['base_url'] = $url;
        $config['total_rows'] = $total_rows;
        $config['per_page'] = $per_page;
        $config['full_tag_open'] = "<p class='pagination'>";
        $config['full_tag_close'] = "</p>";
        $this->pagination->initialize($config);
        return $this->pagination->create_links();
    }
    // My custom pagination function:
    public function my_pagination_static($url,$total_rows,$per_page){
        // Pagination:
        $this->load->library('pagination');
        $config['base_url'] = $url;
        $config['total_rows'] = $total_rows;
        $config['per_page'] = $per_page;
        $config['full_tag_open'] = "<p class='pagination'>";
        $config['full_tag_close'] = "</p>";
        $config['uri_segment'] = 4;
        
        $this->pagination->initialize($config);
        return $this->pagination->create_links();
    }
}
?>