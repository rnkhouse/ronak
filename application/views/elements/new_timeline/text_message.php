<?php
$date_class = new DATE();
?>
<div id="newPost"></div>
<div id="mainContainer">
<?php
foreach($posts as $post){
    $post_link = '/post/'.strtolower($user_current_account).'?id='.$post['PostId'];
    $profile_link = '/profile?id='.$post['UserId'];
    $name = $post['FirstName'].' '.$post['LastName'];
    $content = $post['Content'];
    $date = $date_class->getTimeDiff($post['PostDate']);
    
    if($post['PostedAs'] == 'SOCIAL'){
        $post_avatar = base_url().'media/social/avatars/thumb/'.$post['SocialAvatar'];
    }
    else if($post['PostedAs'] == 'CAREER'){
        $post_avatar = base_url().'media/career/avatars/thumb/'.$post['CareerAvatar'];
    }
?>
<div class="message-container" id="timeline_messages<?=$post['PostId']?>">
<div class="message-content" id="timeline_single_message<?=$post['PostId']?>">
        <div class="message-inner">
            <div class="message-avatar" id="avatar">
                <a href="<?=$profile_link?>">
                    <img onmouseover="profileCard(11066, 20491, 0, 0);" onmouseout="profileCard(0, 0, 0, 1);" onclick="profileCard(0, 0, 1, 1);" src="<?=$post_avatar?>" />
                </a>
            </div>
            <div class="message-top">
                <?php if($post['UserId'] == $user_id){  // here, $user_id is session's user id'?>
                    <a onclick="delete_the(<?=$post['PostId']?>, 1)" title="Delete this message"><div class="delete_btn"></div></a>
                    <span id="privacy20491"><a onclick="privacy(20491, 0)" title="This message is public"><div class="public_btn"></div></a></span>
                <?php }else{ ?>
                    <a onclick="report_the(<?=$post['PostId']?>, 0)" title="Report this post"><div class="report_btn"></div></a>
                <?php } ?>
                <div class="message-author" id="author20491">
                        <a href="<?=$profile_link?>"><?=$name?></a>
                </div>
                <div id="nextPost">
                    Next
                </div>
                <div class="message-time">
                    <span id="time" class="timeago"><a href="<?=$post_link?>" target="_blank"><?=$date?></a>
                    </span>
                </div>
            </div>
            <div class="message-message">			
                <?=$content?>
            </div>
        </div>
        <div class="message-divider" style="float:center"></div>
        
        <?php
        // If there is a video then place here...
        if($post['PostType'] == 'media'){
            $query = new QUERY(array('TABLE'=>'PostsMedia','KEY'=>array('PostId'=>$post['PostId'])));
            $media = $query->fetchRow();
            
            if($media['MediaType'] == 'video'){
        ?>
        
            <div id="player" data-id="<?=$media['MediaContent']?>"></div>
            
        <?php
            }
        }
        ?>
        
        <div class="message-divider"></div>
        
        <?php if($post['SharedFromId']){
            
            $query = new QUERY(array('TABLE'=>'Users','KEY'=>array('Id'=>$post['SharedFromId'])));
            $postOwner = $query->fetchRow();
            
        ?>
        <div class="message-type-general event-shared">
            <img src="<?=$post_avatar?>" />I shared a 
            <a href=""><strong>message</strong></a> from 
            <a href=""><strong><?=$postOwner['FirstName'].' '.$postOwner['LastName']?></strong></a>.
        </div>
        <div class="message-divider"></div>
        <?php } ?>
        
        <!-- <div class="message-type-image event-picture"><a onclick="gallery('314297699_255446604_1511893036.jpg', 81, 'media')" id="314297699_255446604_1511893036.jpg"><img src="http://phpdolphin.com/demo/thumb.php?src=314297699_255446604_1511893036.jpg&w=650&h=300&t=m" /></a></div><div class="message-divider"></div> -->
        
        
        <?php
        
        // Lets check whether this post is liked by logged in person or not:
        $message_id = $post['PostId'];
        $query = new QUERY();
        $clause = "SELECT count(*) as count FROM PostsLikes WHERE PostId=:message_id AND UserId=:user_id";
        $params = array('message_id'=>$message_id,'user_id'=>$user_id);
        $isLiked = $query->run($clause,$params)->fetch();
        
        if($isLiked[0] == 1){ // if there is a like then type = 2 is for dislike.
            $type = 2;
        }
        else{ // if there is no like then type = 1 is for like.
            $type = 1;
        }
        
        // Likes count:
        $query = new QUERY();
        $clause = "SELECT count(Id) as count FROM PostsLikes WHERE PostId=:message_id";
        $params = array('message_id'=>$message_id);
        $likesCount = $query->run($clause,$params)->fetch();
        ?>
        
        <div class="message-replies">
            <div class="message-actions">
                <div class="message-actions-content" id="message-action<?=$post['PostId']?>">
                    <a onclick="doLike(<?=$post['PostId']?>, <?=$type?>)" id="doLike<?=$post['PostId']?>"><?php if($type==1){ ?>Like <?php }else{ ?>Dislike<?php } ?></a> -
                    <a onclick="focus_form(<?=$post['PostId']?>)">Comment</a> -
                    <a onclick="share(<?=$post['PostId']?>)">Share</a>
                    <div class="like_btn" id="like_btn"><?=$likesCount['count']?></div>
                </div>
            </div>
        </div>
        
        
        
        
        <?php
        
        $query = new QUERY();
        $message_id = $post['PostId'];
        $clause = "SELECT pc.Id,pc.PostId,pc.Comment,pc.CommentedAs,pc.CommentedAsId,pc.PostDate,u.FirstName,u.LastName,u.SocialAvatar,u.CareerAvatar FROM PostsComments pc INNER JOIN Users u ON u.Id=pc.CommentedAsId WHERE PostId=$message_id";
        $comments = $query->run($clause)->fetchAll(PDO::FETCH_ASSOC);
        
        foreach($comments as $comment): 
        $comment_date = $date_class->getTimeDiff($comment['PostDate']);
        
        //
        $commented_user_link = '/profile?id='.$comment['CommentedAsId'];
        if($comment['CommentedAs'] == 'SOCIAL'){
            $commented_user_avatar = base_url().'media/social/avatars/thumb/'.$comment['SocialAvatar'];
        }
        else if($comment['CommentedAs'] == 'CAREER'){
            $commented_user_avatar = base_url().'media/career/avatars/thumb/'.$comment['CareerAvatar'];
        }
        
        ?>
        <div class="message-reply-container" id="comment<?=$comment['Id']?>">
            <?php if($comment['CommentedAsId'] != $user_id){ ?>
                <a onclick="report_the(<?=$comment['Id']?>, 0)" title="Report this comment"><div class="report_btn"></div></a>
            <?php }else{ ?>
                <a onclick="delete_the(<?=$comment['Id']?>, 0)" title="Delete this comment"><div class="delete_btn"></div></a>
            <?php } ?>
            
            <div class="message-reply-avatar">
                <a href="<?=$commented_user_link?>"><img onmouseover="profileCard(10951, 4981, 1, 0)" onmouseout="profileCard(0, 0, 1, 1);" onclick="profileCard(0, 0, 1, 1);" src="<?=$commented_user_avatar?>" /></a>
            </div>
            <div class="message-reply-message">
                <span class="message-reply-author"><a href="<?=$commented_user_link?>"><?= $comment['FirstName'].' '.$comment['LastName'] ?></a></span>
                <?=$comment['Comment']?>
                <div class="message-time">
                    <div class="" title="">
                        <?=$comment_date?>
                    </div>
                </div>
            </div>
            <div class="delete_preloader" id="del_comment_4981"></div>
        </div>
        <?php endforeach; ?>
        
        <!-- For new comment -->
        <div class="message-reply-container" id="comments-list<?=$post['PostId']?>">
            
        </div>
        
        
        <?php
        
        $current_user_link = '/profile?id='.$user_id;
        if($user_current_account == 'SOCIAL'){
            $current_user_avatar = base_url().'media/social/avatars/thumb/'.$user_all_info['SocialAvatar'];
        }
        else if($user_current_account == 'CAREER'){
            $current_user_avatar = base_url().'media/career/avatars/thumb/'.$user_all_info['CareerAvatar'];
        }
        
        ?>
        <div class="message-comment-box-container" id="comment_box_20491">
            <div class="message-reply-avatar">
                    <a href="<?=$current_user_link?>"><img src="<?=$current_user_avatar?>" /></a>
            </div>
            <div class="message-comment-box-form">
                <textarea data-id="<?=$post['PostId']?>" id="comment-form<?=$post['PostId']?>" placeholder="Leave a comment..." class="comment-reply-textarea"></textarea>
            </div>
            
            <div class="delete_preloader" id="post_comment_<?=$post['PostId']?>"></div>
        </div>
</div>
</div>
<?php } ?>
</div>

<script type="text/javascript">

// On enter submit comment:
$('.comment-reply-textarea').keypress(function(e){
    if(e.keyCode == 13 && !e.shiftKey){
        var post_id = $(this).attr('data-id');
        postComment(post_id);
        $('#comment-form'+id).val('');
    }
    else if(e.keyCode == 13 && e.shiftKey){
        $('.comment-reply-textarea').css('height', "+=15");
    }
});



$(function(){
    var video_name = $('#player').attr('data-id');
    if(video_name){
        $("#player").flowplayer({
           playlist: [
              [
                 { mp4:  "http://dev.interfacetree.com/media/social/videos/"+video_name },
              ]
           ],
           ratio: 2/4 // video with 4:3 aspect ratio
        });
    }
});


</script>
