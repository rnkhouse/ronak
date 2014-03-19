<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_search extends CI_Model{
    public function mainSearch($search_string,$current_account){
        $query = new QUERY();
        $clause = "SELECT * FROM Users WHERE Social='1' AND
                   FirstName LIKE '$search_string%'
                   OR LastName LIKE '$search_string%'
                   OR Email LIKE '$search_string%'";
        $result = $query->run($clause)->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
}
