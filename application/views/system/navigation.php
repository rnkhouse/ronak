<?php

$user_data = $this->session->userdata('logged_in');

$query = new QUERY(array('TABLE'=>'Users','KEY'=>array('Id'=>$user_data['Id'])));
$user_info = $query->fetchRow();
print_r($user_info);

?>
 <header>
 	<div class="container">
    	<div class="logo">
        	<a href="#"><img src="<?=base_url()?>assets/images/logo.png" alt="Logo"></a>
        </div>
        
        <div class="top-icons-area">
        
            <ul>
            	<li><a href="<?=base_url()?>home"><img src="<?=base_url()?>assets/images/profile-icon-1.png"></a></li>
            </ul>
            
            <div id="logo-group">
				<!-- Note: The activity badge color changes when clicked and resets the number to 0
				Suggestion: You may want to set a flag when this happens to tick off all checked messages / notifications -->
				<span id="activity" class="activity-dropdown">  <img src="<?=base_url()?>assets/images/profile-icon-3.png">  <i class="fa fa-user"></i> <b class="badge"> 21 </b> </span>

				<!-- AJAX-DROPDOWN : control this dropdown height, look and feel from the LESS variable file -->
				<div class="ajax-dropdown">

					<!-- the ID links are fetched via AJAX to the ajax container "ajax-notifications" -->
					<div class="btn-group btn-group-justified" data-toggle="buttons">
						<label class="btn btn-default">
							<input type="radio" name="activity" id="ajax/notify/mail.html">
							Msgs (14) </label>
						<label class="btn btn-default">
							<input type="radio" name="activity" id="ajax/notify/notifications.html">
							notify (3) </label>
						<label class="btn btn-default">
							<input type="radio" name="activity" id="ajax/notify/tasks.html">
							Tasks (4) </label>
					</div>

					<!-- notification content -->
					<div class="ajax-notifications custom-scroll">
                         <ul class="notification-body">
	<li>
		<span class="unread">
			<a class="msg" href="javascript:void(0);">
				<img width="40" height="40" class="air air-top-left margin-top-5" alt="" src="<?=base_url()?>assets/images/4.png">
				<span class="from">John Doe <i class="icon-paperclip"></i></span>
				<time>2 minutes ago</time>
				<span class="subject">Msed quia non numquam eius modi tempora</span>
				<span class="msg-body">Hello again and thanks for being a part of the newsletter. </span>
			</a>
		</span>
	</li>
	<li>
		<span>
			<a class="msg" href="javascript:void(0);">
				<img width="40" height="40" class="air air-top-left margin-top-5" alt="" src="<?=base_url()?>assets/images/female.png">
				<span class="from">Sonya Birthday</span>
				<time>Thursday, September 19th</time>
				<span class="subject">Incidunt ut labor</span>
				<span class="msg-body">sed quia non numquam eius modi tempora incidunt ut labor</span>
			</a>
		</span>
	</li>
	<li>
		<span>
			<a class="msg" href="javascript:void(0);">
				<img width="40" height="40" class="air air-top-left margin-top-5" alt="" src="<?=base_url()?>assets/images/1.png">
				<span class="from">Cristina Algera</span>
				<time>Sunday, September 15th</time>
				<span class="subject">Best-Selling Teethers</span>
				<span class="msg-body"> ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur?</span>
			</a>
		</span>
	</li>
	<li>
		<span>
			<a class="msg" href="javascript:void(0);">
				<img width="40" height="40" class="air air-top-left margin-top-5" alt="" src="<?=base_url()?>assets/images/male.png">
				<span class="from">Lam Tampora</span>
				<time>Saturday, September 14th</time>
				<span class="subject">Deadline due date</span>
				<span class="msg-body">imus qui blanditiis praesentium voluptatum deleniti atque corrup</span>
			</a>
		</span>
	</li>
	<li>
		<span class="unread">
			<a class="msg" href="javascript:void(0);">
				<img width="40" height="40" class="air air-top-left margin-top-5" alt="" src="<?=base_url()?>assets/images/sunny.png">
				<span class="from">Project approved! <i class="icon-paperclip"></i></span>
				<time>September 14th</time>
				<span class="subject">Et harum quidem rerum facilis est et expedita distinctio</span>
				<span class="msg-body">...</span>
			</a>
		</span>
	</li>
	<li>
		<span>
			<a class="msg" href="javascript:void(0);">
				<img width="40" height="40" class="air air-top-left margin-top-5" alt="" src="<?=base_url()?>assets/images/male.png">
				<span class="from">JEFF, me</span>
				<time>Friday, September 13th</time>
				<span class="subject">Bugs fixed! </span>
				<span class="msg-body">Nam libero tempore, cum soluta nobis est eligendi optio cumque</span>
			</a>
		</span>
	</li>
</ul>
 					</div>
					<!-- end notification content -->

					<!-- footer: refresh area -->
					<span> Last updated on: 12/12/2013 9:43AM
						 </span>
					<!-- end footer -->

				</div>
				<!-- END AJAX-DROPDOWN -->
			</div>
             
            <div class="btn-group">
            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
            
             <i class="glyphicon glyphicon-cog"></i>  
            </button>
             
            <ul class="dropdown-menu">
            	<li class="home"><a href="#">Settings</a></li>
                <li class="feed"><a href="/index.php/index/logout">Log Out</a></li>
            </ul>
          </div>
            <div class="top-user-area">
            	<a href="#">
                <img src="<?=base_url()?>assets/images/user-1.png">
                <p><?=$user_info['FirstName'].' '.$user_info['LastName']?></p>
                </a>
            </div>
            
        </div>
        <div class="search">
             <div class="input-group">
                <select name="timepass" class="custom-select">
                    <option>All</option>
                    <option>Social</option>
                    <option>Career</option>
                </select>
                <input type="text" class="search-box">
                <input name="" type="button" class="search-btn">
            </div>
        </div>
   </div>
 </header>

