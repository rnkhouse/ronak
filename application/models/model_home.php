<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_home extends CI_Model{
    public function loadTimeLine($user_id,$current_account,$pageLimit){
        $query = new QUERY();
        
        // Get friend list to get their posts on timeline:
        $list = $this->getFriendList($user_id,$current_account);
        $list_string = '';
        foreach($list as $l){
            $list_string .= $l['Friend'].',';
        }
        $list_string .= $user_id; // Add current logged in user's id to get his posts too.
        $clause = "SELECT p.Id as PostId,Content,PostType,PostedAs,PostedAsId,SharedFromId,Filter,PostDate,u.Id as UserId,FirstName,LastName,SocialAvatar,CareerAvatar FROM Posts p
                   INNER JOIN Users u
                   ON u.id=p.PostedAsId
                   WHERE Filter='PUBLIC' AND PostedAsId IN ($list_string)
                   AND PostedAs='$current_account'
                   ORDER BY PostDate DESC
                   $pageLimit";
        $result = $query->run($clause)->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    
    public function getFriendList($user_id,$current_account){
        $query = new QUERY();
        
        if($current_account == 'SOCIAL'){
            $clause = "SELECT f1.Friend 
                       FROM Friendship f1
                       INNER JOIN Friendship f2 ON f1.User = f2.Friend AND f1.Friend = f2.User
                       WHERE f1.User=:id";
            $params = array('id'=>$user_id);
            $result = $query->run($clause, $params)->fetchAll(PDO::FETCH_ASSOC);
        }
        else if($current_account == 'CAREER'){
            $clause = "SELECT f1.Friend 
                       FROM CareerFriendship f1
                       INNER JOIN CareerFriendship f2 ON f1.User = f2.Friend AND f1.Friend = f2.User
                       WHERE f1.User=:id";
            $params = array('id'=>$user_id);
            $result = $query->run($clause, $params)->fetchAll(PDO::FETCH_ASSOC);
        }
        return $result; // In result we will get friend's IDs.
    }
    
    public function loadNewTimeLine($user_id,$current_account){
        $query = new QUERY();
        
        // Get friend list to get their posts on timeline:
        $list = $this->getFriendList($user_id,$current_account);
        $list_string = '';
        foreach($list as $l){
            $list_string .= $l['Friend'].',';
        }
        $list_string .= $user_id; // Add current logged in user's id to get his posts too.
        
        $clause = "SELECT p.Id as PostId,Content,PostType,PostedAs,PostedAsId,SharedFromId,Filter,PostDate,u.Id as UserId,FirstName,LastName,SocialAvatar,CareerAvatar FROM Posts p
                   INNER JOIN Users u
                   ON u.id=p.PostedAsId
                   WHERE PostedAs = '$current_account' AND Filter='PUBLIC' AND PostedAsId IN ($list_string) AND
                   PostDate = (SELECT MAX(PostDate) FROM Posts p2 WHERE p.PostedAsID = p2.PostedAsId)
                   ORDER BY PostDate DESC
                   ";
        $result = $query->run($clause)->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    
    // To submit status from home page..
    public function submitStatus($id,$content,$user_current_account,$filter='PUBLIC'){
        $query = new QUERY(array('TABLE'=>'Posts'));
        $data = array('Content'=>$content,
                      'PostType'=>'text',
                      'PostedAs'=>$user_current_account,
                      'PostedAsId'=>$id,
                      'Filter'=>$filter,
                      );
        $result = $query->save($data);
        $new_post_id = $query->lastId();
        
        // If post submitted successfully, load timeline again:
        if($result){
            
            $query = new QUERY();
            $clause = "SELECT p.Id as PostId,Content,PostType,PostedAs,PostedAsId,SharedFromId,Filter,PostDate,u.Id as UserId,FirstName,LastName,SocialAvatar,CareerAvatar FROM Posts p
                   INNER JOIN Users u
                   ON u.id=p.PostedAsId
                   WHERE p.Id=$new_post_id
                   LIMIT 1";
            $new = $query->run($clause)->fetchAll(PDO::FETCH_ASSOC);
            return $new;
            
        }
    }
    
    // Toget user info:
    public function getUserInfo($id){
        $query = new QUERY(array('TABLE'=>'Users','KEY'=>array('Id'=>$id)));
        $result = $query->fetchRow();
        return $result;
    }
}