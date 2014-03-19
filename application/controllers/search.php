<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Search extends MY_Controller {
    public function index(){
        $system = new SYSTEM();
        $temp = '';
        $data = $this->load->view('social/home',$temp,TRUE);
        $system->container($data);
    }
    
    public function mainSearch(){
        $search_string = isset($_POST['search_string'])?$_POST['search_string']:'';
        
        $user_data = $this->session->userdata('logged_in');
        
        $this->load->model('model_search');
        $data['search_result'] = $this->model_search->mainSearch($search_string,$user_data['CurrentAccount']);
        
        // Pass search result to view:
        $final_search = $this->load->view('elements/search/main_search_display',$data,TRUE);
        
        // Pass this view to search box:
        echo $final_search;
    }
    
    public function showNotifications(){
        echo "result";
    }
}