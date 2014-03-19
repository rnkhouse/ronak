<?php
$date_class = new DATE();
$comment = $new_comment;
$comment_date = $date_class->getTimeDiff($comment['PostDate']);

$user_data = $this->session->userdata('logged_in');

?>

<div class="message-reply-container" id="comment<?=$comment['Id']?>">
    <?php if($comment['CommentedAsId'] != $user_data['Id']){ ?>
        <a onclick="report_the(<?=$comment['Id']?>, 0)" title="Report this comment"><div class="report_btn"></div></a>
    <?php }else{ ?>
        <a onclick="delete_the(<?=$comment['Id']?>, 0)" title="Delete this comment"><div class="delete_btn"></div></a>
    <?php } ?>
        
    <div class="message-reply-avatar">
        <a href="<?=$profile_link?>"><img onmouseover="profileCard(10951, 4981, 1, 0)" onmouseout="profileCard(0, 0, 1, 1);" onclick="profileCard(0, 0, 1, 1);" src="<?=$post_avatar?>" /></a>
    </div>
    <div class="message-reply-message">
        <span class="message-reply-author"><a href="<?=$profile_link?>"><?= $comment['FirstName'].' '.$comment['LastName'] ?></a></span>
        <?=$comment['Comment']?>
        <div class="message-time">
            <div class="" title="">
                <?=$comment_date?>
            </div>
        </div>
    </div>
    <div class="delete_preloader" id="del_comment_4981"></div>
</div>