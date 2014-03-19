
<div class="topbar_margin"></div>
<div class="row-body content-messages">
    <div class="nine columns" id="messages">
        <div class="message-container">
            <div class="message-content">
                <div class="message-form-header">
                    
                    <div class="message-form-user"><img src="http://phpdolphin.com/demo/themes/dolphin/images/icons/chat.png"></div>
                    <span class="chat-username">Conversation</span><span class="blocked-button"></span>
                    <div class="message-loader" style="display: none"><img src="http://phpdolphin.com/demo/themes/dolphin/images/preloader.gif"></div>
                </div>
                <div class="chat-container">
                        <div class="chat-error">You can start a conversation by chosing a person from your friends list.</div>
                </div>
                <div class="message-divider"></div>
                
                
                <div class="chat-form-inner"><input id="chat" class="chat-user" placeholder="Write a message..." name="chat" /></div>
            </div>
        </div>
    </div>
    <div class="three columns">
        <div class="sidebar-container widget-online-users">
            <div class="sidebar-content">
                <div class="sidebar-header">
                    <input type="text" placeholder="Search in friends"  id="search-list" />
                </div>
                <div class="search-list-container"></div>
                <div class="sidebar-chat-list">
                    <?php foreach($friends as $friend){
                        $status = strtolower($friend['Status']);
                        if($user_current_account == 'SOCIAL'){
                            $avatar = base_url().'media/social/avatars/thumb/'.$friend['SocialAvatar'];
                        }
                        else if($user_current_account == 'CAREER'){
                            $avatar = base_url().'media/career/avatars/thumb/'.$friend['CareerAvatar'];
                        }
                    ?>
                    <div class="sidebar-users">
                        <a onclick="loadChat(<?=$friend['Id']?>, 0)">
                            <img src="<?=base_url()?>assets/images/icons/<?=$status?>.png" class="sidebar-status-icon" />
                            <img src="<?=$avatar?>" width="25" height="25" />
                            <?=$friend['FirstName'].' '.$friend['LastName']?>
                        </a>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>



<script type="text/javascript">
    /*
function checkNewChat(x){
	var uid = $('#chat').attr('class');
	if(uid === 'chat-user') {
		setTimeout(checkNewChat, 1000);
	} else {
		$.ajax({
			type: "POST",
			url: "requests/loadChat",
			data: "uid="+uid.replace('chat-user', '')+"&type=1", 
			success: function(html) {
				 // html is a string of all output of the server script.
				if(html) {
					$('.chat-container').append(html);
					jQuery("div.timeago").timeago();
					
					// Scroll at the bottom of the div (focus new content)
					$(".chat-container").scrollTop($(".chat-container")[0].scrollHeight);
					
					notificationTitle(1);
				}
				if(!x) {
					setTimeout(checkNewChat, 1000);
				}
		   }
		});
	}
}*/
//checkNewChat();
</script>
