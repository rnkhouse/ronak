<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_requests extends CI_Model{
    // For delete posts...
    public function deletePost($messageId){
        $query = new QUERY(array('TABLE'=>'Posts','KEY'=>array('Id'=>$messageId)));
        $result = $query->delete();
        return $result;
    }
    
    // For delete comments...
    public function deleteComment($commentId){
        $query = new QUERY(array('TABLE'=>'PostsComments','KEY'=>array('Id'=>$commentId)));
        $result = $query->delete();
        return $result;
    }
    
    // For like posts...
    public function likePost($messageId,$data){
        $query = new QUERY(array('TABLE'=>'PostsLikes'));
        $result = $query->save($data);
        return $result;
    }
    
    // For dislike posts...
    public function dislikePost($messageId,$userId){
        $query = new QUERY(array('TABLE'=>'PostsLikes','KEY'=>array('PostId'=>$messageId,'UserId'=>$userId)));
        $result = $query->delete();
        return $result;
    }
    
    // Likes count for post...
    public function postLikesCount($messageId){
        $query = new QUERY();
        $clause = "SELECT count(Id) as count FROM PostsLikes WHERE PostId=:message_id";
        $params = array('message_id'=>$messageId);
        $likesCount = $query->run($clause,$params)->fetch();
        $totalLikes = $likesCount['count'];
        return $totalLikes;
    }
    
    
    ////////////////////////////////////////////////////////////////////////////////////
    // For post comment...
    public function postComment($data){
        $query = new QUERY(array('TABLE'=>'PostsComments'));
        $result = $query->save($data);
        
        $new_comment_id = $query->lastId();
        
        if($result){
            return $this->getComment($new_comment_id);
        }
    }
    
    public function getComment($comment_id){
        $query = new QUERY();
        $clause = "SELECT pc.Id,pc.PostId,pc.Comment,pc.CommentedAs,pc.CommentedAsId,pc.PostDate,u.FirstName,u.LastName
                   FROM PostsComments pc
                   INNER JOIN Users u
                   ON u.Id=pc.CommentedAsId
                   WHERE pc.Id=:comment_id";
        $params = array('comment_id'=>$comment_id);
        $comment = $query->run($clause,$params)->fetch(PDO::FETCH_ASSOC);
        return $comment;
    }
    
    
    /////////////////////////////////////////////////////////////////////////////////////////////////////
    // Share post:
    // There are many types of posts: text, video, image...
    // We need to check it before share...
    public function sharePost($postId, $userId, $userAccountType){
        $query = new QUERY(array('TABLE'=>'Posts','KEY'=>array('Id'=>$postId)));
        $post_data = $query->fetchRow();
        
        // For text post:
        if(strtolower($post_data['PostType']) == 'text'){
            $query = new QUERY(array('TABLE'=>'Posts'));
            $data = array('Content'=>$post_data['Content'],
                          'PostType'=>'text',
                          'PostedAs'=>$userAccountType,
                          'PostedAsId'=>$userId,
                          'SharedFromId'=>$post_data['PostedAsId'],
                          'Filter'=>'PUBLIC',
                          );
            $result = $query->save($data);
        }
        
        return $result;
    }
    
    
    ///////////////////////////////////////////////////////////////////////////////////
    // Messages:
    public function loadChatHistory($user_id, $friend_id, $account_type){
        $query = new QUERY();
        $clause = "SELECT * FROM Messages
                   WHERE (Aid=:Aid OR Aid=:Bid) AND (Bid=:Aid OR Bid=:Bid) AND Atype=:Atype AND Btype=:Btype
                   ORDER BY DateSent ASC";
        $params = array('Aid'=>$user_id, 'Bid'=>$friend_id, 'Atype'=>$account_type, 'Btype'=>$account_type);
        $result = $query->run($clause, $params)->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    
    public function postMessage($data){
        $query = new QUERY(array('TABLE'=>'Messages'));
        $result = $query->save($data);
        $new_message_id = $query->lastId();
        if($result){
            return $this->loadNewChatMessage($new_message_id);
        }
        
    }
    
    
    public function loadNewChatMessage($new_message_id){
        $query = new QUERY();
        $clause = "SELECT * FROM Messages
                   WHERE Id=$new_message_id";
        $result = $query->run($clause)->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    
}