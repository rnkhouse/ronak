<?php

$user_data = $this->session->userdata('logged_in');

?>
<div class="topbar">
    <div class="header">
        <!-- <a href="http://inrerfacetree.com"><div class="logo"></div><div class="logo-small"></div></a> -->
        <div class="search-input"><input type="text" id="search" placeholder="Search by people name" x-webkit-speech="x-webkit-speech" onwebkitspeechchange="liveSearch();"></div>
        <a href="/index/logout"><div class="menu_btn" title="Log Out"><img src="<?=base_url()?>assets/images/logout.png" /></div></a>
        <a onclick="showNotification('', '1')"><div class="menu_btn" id="notifications_btn" title="Notifications"><img src="<?=base_url()?>assets/images/notification.png" id="notifications_img" /></div></a>
        <a href="" id="messages_url"><div class="menu_btn" id="messages_btn" title="Messages"><img src="<?=base_url()?>assets/images/message.png" /></div></a>
        <a href=""><div class="menu_btn" title="Timeline"><img src="<?=base_url()?>assets/images/timeline.png" /></div></a>
        <a href="<?=base_url()?>home"><div class="menu_btn" title="News Feed"><img src="<?=base_url()?>assets/images/feed.png" /></div></a>
        <a href="<?=base_url()?>profile"><div class="menu"><div class="menu_img"><img src="<?=base_url()?>media/social/avatars/1.jpeg" /></div><div class="menu_name"><strong>rnkhouse</strong></div></div></a>
        <div>You are in <?=$user_data['CurrentAccount'].' '?>media.</div>
        <div class="notification-container">
                <div class="notification-content">
                        <div class="notification-inner">
                                <span id="global_page_url"><a href=""><strong>View More Notifications</strong></a></span>
                                <span id="chat_page_url"><a href=""><strong>View More Messages</strong></a></span>
                                <a onclick="showNotification('close')" title="Close Notifications"><div class="delete_btn"></div></a>
                        </div>
                        <div id="notifications-content"></div>
                        <div class="notification-row"><div class="notification-padding"><a href="http://phpdolphin.com/demo/index.php?a=settings&b=notifications">Notifications Settings</a></div></div>
                </div>
        </div>
    </div>
    <div class="search-container">
        
    </div>
</div>
<div class="topbar_margin"></div>


<script type="text/javascript">
		function checkNewNotifications(x) {
			// Retrieve the current notification values
			xy = $("#notifications_btn .notifications-number").html();
			xz = $("#messages_btn .notifications-number").html();
			
			// If there are not current values, reset them to 0
			if(!xy) {
				xy = 0;
			}
			if(!xz) {
				xz = 0;
			}
			$.ajax({
				type: "POST",
				url: "http://phpdolphin.com/demo/requests/check_notifications.php",
				data: "for=1",
				success: function(html) {
					// If the response does not include "No notifications" and is not empty show the notification
					if(html.indexOf("No notifications") == -1 && html !== "" && html !== "0") {
						result = jQuery.parseJSON(html);
						if(result.response.global > 0) {
							$("#notifications_btn").html(getNotificationImage()+"<span class=\"notificatons-number-container\"><span class=\"notifications-number\">"+result.response.global+"</span></span>");
						} else {
							$("#notifications_btn").html(getNotificationImage());
						}
						if(result.response.messages > 0) {
							$("#messages_btn").html(getMessagesImageUrl(1)+"<span class=\"notificatons-number-container\"><span class=\"notifications-number\">"+result.response.messages+"</span></span>");
							$("#messages_url").attr("onclick", "showNotification('', '2')");
							$("#messages_url").removeAttr("href");
						} else {
							$("#messages_btn").html(getMessagesImageUrl(1));
							$("#messages_url").removeAttr("onclick");
							$("#messages_url").attr("href", getMessagesImageUrl());
						}
						
						// If the new value is higher than the current one, and the current one is not equal to 0

						if(result.response.global > xy && xy != 0 || result.response.global == 1 && xy == 0) {
							checkAlert();
						} else if(result.response.messages > xz && xz != 0 || result.response.messages == 1 && xz == 0) {
							checkAlert();
						}
					}
					stopNotifications = setTimeout(checkNewNotifications, 10000);
			   }
			});
		}
		checkNewNotifications();
		
		function checkAlert() {
			if(!document.hasFocus()) {						
				// If the current document title doesn't have an alert, add one
				if(document.title.indexOf("(!)") == -1) {
					document.title = "(!) " + document.title;
				}
				notificationTitle(2);
			}
		}
		function getNotificationImage() {
			return "<img src=\"http://phpdolphin.com/demo/themes/dolphin/images/notification.png\" />";
		}
		function getMessagesImageUrl(x) {
			if(x) {
				return "<img src=\"http://phpdolphin.com/demo/themes/dolphin/images/message.png\" />";
			} else {
				return "http://phpdolphin.com/demo/index.php?a=messages";
			}
		}
		
		</script><audio id="soundNewNotification"><source src="http://phpdolphin.com/demo/themes/dolphin/sounds/soundNotification.ogg" type="audio/ogg"><source src="http://phpdolphin.com/demo/themes/dolphin/sounds/soundNotification.mp3" type="audio/mpeg"><source src="http://phpdolphin.com/demo/themes/dolphin/sounds/soundNotification.wav" type="audio/wav"></audio>


                
<script type="text/javascript">
$(function() {
	function checkNewMessages() {
		var uid = $('.last-message').attr('name');
		var last = $('.last-message').attr('id');
		var filter = $('.last-message').attr('title');
		var profile = $('.last-message').attr('alt');	
		
		// Prevents returning an error when no posts on profiles/feeds/subscriptions are available
		if(uid) {
			uid = uid.replace('name-', '');
		}
		if(last) {
			last = last.replace('last-', '');
		}
		if(filter) {
			filter = filter.replace('type-', '');
		}
		if(profile) {
			profile = profile.replace('profile-', '');
		}
		
		$.ajax({
			type: "POST",
			url: "requests/check_messages.php",
			data: "uid="+uid+"&id="+last+"&filter="+filter+"&profile="+profile+"&subs=1", 
			success: function(html) {
				 // html is a string of all output of the server script.
				if(html) {
					$('#last-'+last).prepend(html);
					$('#last-'+last).removeAttr('name id title alt');
				}
				setTimeout(checkNewMessages, 10000);
		   }
		});

	}
	checkNewMessages();
});
</script>
