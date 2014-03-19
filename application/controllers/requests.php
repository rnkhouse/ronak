<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Requests extends MY_Controller {
    public function index(){
        
    }
    
    public function delete(){
        // message or post Id
        $messageId = isset($_POST['messageId'])?$_POST['messageId']:'';
        // type = 0 => delete comment
        // type = 1 => delete message
        // type = 2 => delete chat
        $type = isset($_POST['type'])?$_POST['type']:'';
        
        $this->load->model('model_requests');
        if($type == 0){
            $response = $this->model_requests->deleteComment($messageId);
        }
        if($type == 1){
            $response = $this->model_requests->deletePost($messageId);
        }
        
        if(isset($response)){
            echo '1';
        }
    }
    
    
    public function like(){
        // post Id
        $messageId = isset($_POST['messageId'])?$_POST['messageId']:'';
        // type = 1 => like
        // type = 2 => dislike
        $type = isset($_POST['type'])?$_POST['type']:'';
        
        $this->load->model('model_requests');
        if($type == 1){
            $user_data = $this->getSessionData();
            $data = array('PostId'=>$messageId,
                          'UserId'=>$user_data['Id'],
                          );
            
            $this->model_requests->likePost($messageId,$data);
            $response = 1;
        }
        if($type == 2){
            $user_data = $this->getSessionData();
            $this->model_requests->dislikePost($messageId,$user_data['Id']);
            $response = 2;
        }
        
        
        
        if($response == 1){
            // Likes count:
            $totalLikes = $this->model_requests->postLikesCount($messageId);
            
            $type = 2; // here, 2 is for dislike next time.
            $new_form = '<a onclick="doLike('.$messageId.', '.$type.')" id="doLike'.$messageId.'">Dislike</a> - ';
            $new_form .= '<a onclick="focus_form('.$messageId.')">Comment</a> - ';
            $new_form .= '<a onclick="share('.$messageId.')">Share</a>';
            $new_form .= '<div class="like_btn" id="like_btn">'.$totalLikes.'</div>';
            
            echo $new_form;
        }
        
        if($response == 2){
            // Likes count:
            $totalLikes = $this->model_requests->postLikesCount($messageId);
            
            $type = 1; // here, 1 is for like next time.
            $new_form = '<a onclick="doLike('.$messageId.', '.$type.')" id="doLike'.$messageId.'">Like</a> - ';
            $new_form .= '<a onclick="focus_form('.$messageId.')">Comment</a> - ';
            $new_form .= '<a onclick="share('.$messageId.')">Share</a>';
            $new_form .= '<div class="like_btn" id="like_btn">'.$totalLikes.'</div>';
            
            echo $new_form;
        }
    }
    
    
    public function comments(){
        // post Id
        $messageId = isset($_POST['messageId'])?$_POST['messageId']:'';
        $comment = isset($_POST['comment'])?urldecode($_POST['comment']):'';
        $user_data = $this->getSessionData();
        
        $data = array('PostId'=>$messageId,
                      'Comment'=>$comment,
                      'CommentType'=>'text',
                      'CommentedAs'=>$user_data['CurrentAccount'],
                      'CommentedAsId'=>$user_data['Id']
                      );
        
        $this->load->model('model_requests');
        $data['new_comment'] = $this->model_requests->postComment($data);
        
        // Passing profile link and post avatar for new comment container...
        $data['profile_link'] = '/profile?id='.$user_data['Id'];
        
        // for avatar:
        $this->load->model('model_home');
        $image = $this->model_home->getUserInfo($user_data['Id']);
        if($user_data['CurrentAccount'] == 'SOCIAL'){
            $data['post_avatar'] = base_url().'media/social/avatars/thumb/'.$image['SocialAvatar'];
        }else if($user_data['CurrentAccount'] == 'CAREER'){
            $data['post_avatar'] = base_url().'media/career/avatars/thumb/'.$image['CareerAvatar'];
        }
        
        
        // We need to show new comments on timeline... Let's prepare view for it...
        echo $this->load->view('elements/timeline/new_comment_display',$data);
        
    }
    
    public function sharePost(){
        $postId = isset($_POST['id'])?$_POST['id']:'';
        
        $user_data = $this->session->userdata('logged_in');
        
        $this->load->model('model_requests');
        $response = $this->model_requests->sharePost($postId, $user_data['Id'], $user_data['CurrentAccount']);
        
        if(isset($response)){
            echo "This post has been shared on your timeline";
        }
    }
    
    
    public function loadChat(){
        $friend_id = isset($_POST['uid'])?$_POST['uid']:'';
        
        // Get loggedin user's info:
        $user_data = $this->session->userdata('logged_in');
        $data['user_id'] = $user_data['Id'];
        $data['user_current_account'] = $user_data['CurrentAccount'];
        
        $data['friend_id'] = $friend_id;
        
        $this->load->model('model_requests');
        $data['chatHistory'] = $this->model_requests->loadChatHistory($data['user_id'], $friend_id, $data['user_current_account']);
        
        
        echo $this->load->view('/elements/common/message_container',$data);
    }
    
    
    public function postChat(){
        $message = isset($_POST['message'])?$_POST['message']:'';
        $friend_id = isset($_POST['id'])?$_POST['id']:'';
        
        // Get loggedin user's info:
        $user_data = $this->session->userdata('logged_in');
        $data['user_id'] = $user_data['Id'];
        $data['user_current_account'] = $user_data['CurrentAccount'];
        
        $data['friend_id'] = $friend_id;
        
        $this->load->model('model_requests');
        
        $data_input = array('Content'=>$message,
                            'Atype'=>strtoupper($data['user_current_account']),
                            'Aid'=>$data['user_id'],
                            'Astatus'=>'ACTIVE',
                            'Btype'=>strtoupper($data['user_current_account']), // only social friend's send message to social, etc...
                            'Bid'=>$friend_id,
                            'Bstatus'=>'UNREAD',
                            );
        
        $data['chatHistory'] = $this->model_requests->postMessage($data_input);
        echo $this->load->view('/elements/common/message_container',$data);
        
    }
    
}
