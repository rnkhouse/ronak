<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_message extends CI_Model{
    public function getFriendsDetail($friendsId){
        $query = new QUERY();
        $clause = "SELECT * FROM Users WHERE Id IN ($friendsId)";
        $result = $query->run($clause)->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
}