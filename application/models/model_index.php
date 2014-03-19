<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_index extends CI_Model{
    public function login($email, $password){
        $enc_password = md5($password);
        $query = new QUERY(array('TABLE'=>'Users','KEY'=>array('Email'=>$email,'Password'=>$enc_password),'LIMIT'=>1));
        $login = $query->fetchRow();
        if($login){
            return $login;
        }
        else{
            return "Invalid email or password!";
        }
    }
    
    public function mainRegistration($data){
        $query = new QUERY(array('TABLE'=>'Users'));
        $result = $query->save($data);
        $new_registered_id = $query->lastId();
        
        // if registered, then get user's data...
        if($result){
            $query = new QUERY(array('TABLE'=>'Users','KEY'=>array('Id'=>$new_registered_id)));
            $new_user = $query->fetchRow();
            return $new_user;
        }
    }
    
    public function changeStatus($id, $status){
        $query = new QUERY(array('TABLE'=>'Users','KEY'=>array('Id'=>$id)));
        $result = $query->save(array('Status'=>$status));
        return $result;
    }
}
?>