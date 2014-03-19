<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_profile extends CI_Model{
    public function getProfileInfo($profile_id){
        $query = new QUERY(array('TABLE'=>'Users','KEY'=>array('Id'=>$profile_id)));
        $result = $query->fetchRow();
        return $result;
    }
    
    public function getProfileTimeLine($profile_id,$account_type,$pageLimit){
        $query = new QUERY();
        $clause = "SELECT p.Id as PostId,Content,PostType,PostedAs,PostedAsId,SharedFromId,Filter,PostDate,u.Id as UserId,FirstName,LastName,SocialAvatar,CareerAvatar FROM Posts p
                   INNER JOIN Users u
                   ON u.id=p.PostedAsId
                   WHERE PostedAsId=:PostedAsId
                   AND PostedAs=:PostedAs
                   ORDER BY PostDate DESC
                   $pageLimit";
        $params = array('PostedAsId'=>$profile_id,'PostedAs'=>$account_type);
        $result = $query->run($clause, $params)->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
}