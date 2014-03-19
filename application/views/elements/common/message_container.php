<input type="hidden" value="<?=$friend_id?>" id='friend_id'/>
<?php
//print_r($chatHistory);
$date_class = new DATE();
?>
<?php
foreach($chatHistory as $ch){
    $message_date = $date_class->getTimeDiff($ch['DateSent']);
    
    $query = new QUERY(array('TABLE'=>'Users','KEY'=>array('Id'=>$ch['Aid'])));
    $author_info = $query->fetchRow();
    
    if($user_current_account == 'SOCIAL'){
        $avatar = base_url().'media/social/avatars/thumb/'.$author_info['SocialAvatar'];
    }
    else if($user_current_account == 'CAREER'){
        $avatar = base_url().'media/career/avatars/thumb/'.$author_info['CareerAvatar'];
    }
    
    ?>
    <div id="chat<?=$ch['Id']?>" class="message-reply-container">
        <a title="Remove message" onclick="delete_the(<?=$ch['Id']?>,2)">
            <div class="delete_btn"></div>
        </a>
        <div class="message-reply-avatar">
            <a href="/profile?id=<?=$author_info['Id']?>"><img src="<?=$avatar?>"/></a>
        </div>
        <div class="message-reply-message">
            <span class="message-reply-author">
                <a href="/profile?id=<?=$author_info['Id']?>"><?=$author_info['FirstName'].' '.$author_info['LastName']?></a>
            </span>
            <div class="message-time">
                <div class="timeago"><?=$message_date?></div>
            </div>
            
            <?=$ch['Content']?>
            
        </div>
        <div id="del_chat_<?=$ch['Id']?>" class="delete_preloader"></div>
    </div>
<?php } ?>