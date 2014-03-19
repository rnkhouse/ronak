<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Index extends CI_Controller {
        public function __construct() {
            parent::__construct();
        }
	public function index()
	{
            if($this->session->userdata('logged_in')){
                redirect('/index.php/home');
            }
            else if(isset($_COOKIE['userId'])){
                $user_id = $_COOKIE['userId'];
                $this->load->model('model_home');
                $cookie_user = $this->model_home->getUserInfo($user_id);
                $sess_array = array(
                    'Id' => $cookie_user['Id'],
                    'Email' => $cookie_user['Email'],
                    'PrimaryAccount'=> $cookie_user['PrimaryAccount'],
                    'Social'=>$cookie_user['Social'],
                    'Career'=>$cookie_user['Career']
                );
                $sess_array['CurrentAccount'] = $cookie_user['PrimaryAccount'];
                $this->session->set_userdata('logged_in',$sess_array);
                
                redirect('/index.php/home');
            }
            else{
                // include dynamic date from common:
                $data['dynamic_date'] = $this->load->view('elements/common/dynamic_date','',TRUE);
                $this->load->view('/index',$data);
            }
            
	}
        
        public function loginVerify(){
            $email = isset($_POST['login_email'])?$_POST['login_email']:'';
            $password = isset($_POST['login_password'])?$_POST['login_password']:'';

            $fields = array('login_email' =>array('ALIAS'=>'Email','REQUIRED'),
                            'login_password'=>array('ALIAS'=>'Password','REQUIRED')
                           );
            $form   = new FORM($fields);
            $errors = $form->fetchAll_error();
            
            if(empty($errors)){
                // Check into the database...
                $isValidUser = $this->login($email, $password);
                if(is_array($isValidUser)){
                    $sess_array = array(
                        'Id' => $isValidUser['Id'],
                        'Email' => $isValidUser['Email'],
                        'PrimaryAccount'=> $isValidUser['PrimaryAccount'],
                        'Social'=>$isValidUser['Social'],
                        'Career'=>$isValidUser['Career']
                    );
                    $sess_array['CurrentAccount'] = $isValidUser['PrimaryAccount'];
                    $this->session->set_userdata('logged_in',$sess_array);
                    
                    // Set cookies:
                    setcookie('userId', $isValidUser['Id'], time()+60*60*24*30);
                    redirect('/index.php/home/');
                }
                else{
                    // include dynamic date from common:
                    $date['dynamic_date'] = $this->load->view('elements/common/dynamic_date','',TRUE);
                    $errors = array_merge($date,$errors);
                    $data  = $this->load->view('index',$isValidUser);
                }
            }
            else{
                // include dynamic date from common:
                $date['dynamic_date'] = $this->load->view('elements/common/dynamic_date','',TRUE);
                $errors = array_merge($date,$errors);
                $data  = $this->load->view('index',$errors);
            }
        }
        private function login($email, $password){
            $this->load->model('model_index');
            $result = $this->model_index->login($email, $password);
            return $result;
        }
        
        
        
        public function registrationValidate(){
            $validate = array('first_name' => array('ALIAS'=>'First Name','REQUIRED'),
                              'last_name'=> array('ALIAS'=>'Last Name','REQUIRED'),
                              'email' => array('ALIAS'=>'Email', 'REQUIRED','EMAIL'),
                              
                              'password' => array('ALIAS'=>'Password','REQUIRED'),
                              
                              );
            

            $form   = new FORM($validate);
            $errors = $form->fetchAll_error();
            
            
            
            // Check email in database...
            $email = isset($_POST['email'])?$_POST['email']:'';
            $query = new QUERY(array('TABLE'=>'Users','KEY'=>1));
            $allUsers = $query->fetchAll();
            foreach($allUsers as $user){
                if($user['Email'] == $email){
                    $errors['user_exist'] = "This user is already exist";
                }
            }
            
            if(empty($errors)){
                $first_name = isset($_POST['first_name'])?$_POST['first_name']:'';
                $last_name = isset($_POST['last_name'])?$_POST['last_name']:'';
                $password = isset($_POST['password'])?$_POST['password']:'';
                $gender = 'male';
                $primary_account = 'SOCIAL';
                
                if($gender == 'male' && $primary_account == 'SOCIAL'){
                    $social_avatar = 'default_male.jpg';
                }
                else if($gender == 'female' && $primary_account == 'SOCIAL'){
                    $social_avatar = 'default_female.jpg';
                }
                else if($gender == 'male' && $primary_account == 'CAREER'){
                    $career_avatar = 'default_male.jpg';
                }
                else if($gender == 'female' && $primary_account == 'CAREER'){
                    $career_avatar = 'default_female.jpg';
                }
                
                $data = array('FirstName'=>$first_name,
                              'LastName'=>$last_name,
                              'Email'=>$email,
                              'Password'=>md5($password),
                              'Gender'=>$gender,
                              'BirthDate'=>'1990-01-01',
                              'PrimaryAccount'=>$primary_account,
                              'SocialAvatar'=>isset($social_avatar)?$social_avatar:'',
                              'CareerAvatar'=>isset($career_avatar)?$career_avatar:'',
                             );
                
                $this->load->model('model_index');
                $new_user = $this->model_index->mainRegistration($data);
                if($new_user){
                    $sess_array = array(
                        'Id' => $new_user['Id'],
                        'Email' => $new_user['Email'],
                        'PrimaryAccount'=> $new_user['PrimaryAccount'],
                        'Social'=>$new_user['Social'],
                        'Career'=>$new_user['Career']
                    );
                    $sess_array['CurrentAccount'] = $new_user['PrimaryAccount'];
                    $this->session->set_userdata('logged_in',$sess_array);
                    $this->session->set_userdata('first_time',true);
                    
                    redirect('/index.php/home');
                }
                else{
                    echo "problem";
                    print_r($new_user);
                }
                
            }
            else{
                // include dynamic date from common:
                $date['dynamic_date'] = $this->load->view('elements/common/dynamic_date','',TRUE);
                $errors = array_merge($date,$errors);
                $data = $this->load->view('/index',$errors);
            }
        }
        
        public function logout(){
            session_start();
            // Before log out generate report:
            $user_session = $this->session->userdata('logged_in');
            
            // change user status to offline:
            $this->load->model('model_index');
            $this->model_index->changeStatus($user_session['Id'],'OFFLINE');
            
            $this->session->unset_userdata('logged_in');
            if($this->session->userdata('first_time')){
                $this->session->unset_userdata('first_time');
            }
            session_destroy();
            redirect('/', 'refresh');
        }
        
}
