<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
 
    <title>Interface Tree :: Login</title>

    <!-- Bootstrap core CSS -->
    <link href="<?=base_url()?>assets/css/bootstrap.css" rel="stylesheet">
    <link href="<?=base_url()?>assets/css/layout.css" rel="stylesheet">
    <link href="<?=base_url()?>assets/css/responsive.css" rel="stylesheet">
    <link href="<?=base_url()?>assets/fonts/fonts.css" rel="stylesheet">
    <link href="<?=base_url()?>assets/css/tab.css" rel="stylesheet">
    <link href="<?=base_url()?>assets/css/production.css" rel="stylesheet">
    <link href="<?=base_url()?>assets/css/myStyle.css" rel="stylesheet">
    
  </head>


  <body class="desktop-detected pace-done">

 <header>
 	<div class="container">
    	<div class="logo">
        	<a href="#"><img src="<?=base_url()?>assets/images/logo.png" alt="Logo"></a>
        </div>
   </div>
 </header>  
 
 <section>
 	<div class="container loginpage">
    	<div class="leftside">
        
         <div class="event-img"><img src="<?=base_url()?>assets/images/img-1.jpg"></div>
        <div class="trends">
        <h2>#Today Trends</h2>
        <div class="btn-group">
                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                      #Today Trends
                       
                    </button>
                     
                    <ul class="dropdown-menu">
                        <li><a href="#">#Palestine</a></li>
                        <li><a href="#">#Gaza</a></li>
                        <li><a href="#">#Israel</a></li>
                        <li><a href="#">#whatwhouldyoudo</a></li>
                        <li><a href="#">#happynewyear</a></li>
                    </ul>
                  </div>
        <ul id="scroller">
         
         <li><a href="#">#Palestine</a></li>
        <li><a href="#">#Gaza</a></li>
        <li><a href="#">#Israel</a></li>
        <li><a href="#">#whatwhouldyoudo</a></li>
        <li><a href="#">#happynewyear</a></li>
         <li><a href="#">#Palestine</a></li>
        <li><a href="#">#Gaza</a></li>
        <li><a href="#">#Israel</a></li>
        <li><a href="#">#whatwhouldyoudo</a></li>
        <li><a href="#">#happynewyear</a></li>
         <li><a href="#">#Palestine</a></li>
        <li><a href="#">#Gaza</a></li>
        <li><a href="#">#Israel</a></li>
        <li><a href="#">#whatwhouldyoudo</a></li>
        <li><a href="#">#happynewyear</a></li>
         <li><a href="#">#Palestine</a></li>
        <li><a href="#">#Gaza</a></li>
        <li><a href="#">#Israel</a></li>
        <li><a href="#">#whatwhouldyoudo</a></li>
        <li><a href="#">#happynewyear</a></li>
         <li><a href="#">#Palestine</a></li>
        <li><a href="#">#Gaza</a></li>
        <li><a href="#">#Israel</a></li>
        <li><a href="#">#whatwhouldyoudo</a></li>
        <li><a href="#">#happynewyear</a></li>
          </ul>   
         
         
        	
        </div>
        </div>
        <div class="mid">
           <div class="message-tab-area login-tab">
          	<div id="tabs">
                 <h2>Interface Tree</h2>
                  <h3>Where Social media meets Career media</h3>
               <ul>
                <li><a href="#tabs-1">Login	</a></li>
                
               </ul>
                <div id="tabs-1">
                  <div class="login-area">
                    <form name='login' action='/index.php/index/loginVerify' method='post'>
                        <span class='errorMessage'><?= isset($login_email)?$login_email['REQUIRED']:''; ?></span>
                        <input name="login_email" type="text" class="input-box" placeholder="Email">
                        
                        <span class='errorMessage'><?= isset($login_password)?$login_password['REQUIRED']:''; ?></span>
                        <input name="login_password" type="password" class="input-box" placeholder="Password">
                        
                        <label>Remember me <input name="" type="checkbox" value=""></label>
                        <input name="btnSignIn" type="submit" class="submit" value="Login">
                    </form>
                  </div>
           		  
           		</div>
                  <!--
           		<div id="tabs-2">
                 <div class="login-area">
                   
                  
                     
                     
                     <form name='registration' action='/index.php/index/registrationValidate' method='post'>
                        
                        <span class='errorMessage'><?= isset($first_name)?$first_name['REQUIRED']:''; ?></span>
                        <input name="first_name" type="text" class="input-box" placeholder="First name">
                        
                        <span class='errorMessage'><?= isset($last_name)?$last_name['REQUIRED']:''; ?></span>
                        <input name="last_name" type="text" class="input-box" placeholder="Last name">
                        
                        <span class='errorMessage'><?= isset($email)?$email['REQUIRED']:''; ?></span>
                        <span class='errorMessage'><?= isset($user_exist)?$user_exist:''; ?></span>
                        <input name="email" type="text" class="input-box" placeholder="Email">
                        
                        <span class='errorMessage'><?= isset($password)?$password['REQUIRED']:''; ?></span>
                        <input name="password" type="password" class="input-box" placeholder="Password">
                        
                        
                        <input name="btnSignUp" type="submit" class="submit" value="Sign Up">
                    </form>
                  </div>
           	     
                </div>
                  -->
             </div>
 			</div>
          </div>
         
        <div class="rightSide news">
        	<div class="event-img"><img src="<?=base_url()?>assets/images/img-2.jpg"></div>
       	  <div class="right-side-area newFeed">
            	<h2>News</h2>
             <ul id="scroller1">
        		 <li><a href="#">Bill S Kenney added a comment on your post. “Hey bro like you liked mine works follow me here to keep updated!”Bill S Kenney added a comment on your post. “Hey bro like you liked mine works follow me here to keep updated!”Bill S Kenney added a comment on your post. “Hey bro like you liked mine works follow me here to keep updated!”Bill S Kenney added a comment on your post. “Hey bro like you liked mine works follow me here to keep updated!”</a></li>
         	 </ul>
 				
            </div>
             
        </div>
    </div>
 </section>
 
 <footer>
 	<div class="container">
    	<div class="foot-user-con">
        	<ul>
                         	<li><a href="#"> <img src="<?=base_url()?>assets/images/friend-1.png"></a></li>
                         	<li><a href="#"><img src="<?=base_url()?>assets/images/friend-2.png"></a></li>
                         	<li><a href="#"><img src="<?=base_url()?>assets/images/friend-3.png"></a></li>
                         	<li><a href="#"><img src="<?=base_url()?>assets/images/friend-4.png"></a></li>
                         	<li><a href="#"><img src="<?=base_url()?>assets/images/friend-5.png"></a></li>
                         	<li><a href="#"><img src="<?=base_url()?>assets/images/friend-6.png"></a></li>
                         	<li><a href="#"><img src="<?=base_url()?>assets/images/friend-7.png"></a></li>
                         	<li><a href="#"><img src="<?=base_url()?>assets/images/friend-8.png"></a></li>
                         	<li><a href="#"><img src="<?=base_url()?>assets/images/friend-9.png"></a></li>
                         	<li><a href="#"><img src="<?=base_url()?>assets/images/friend-10.png"></a></li>
                         	<li><a href="#"><img src="<?=base_url()?>assets/images/friend-11.png"></a></li>
                         	<li><a href="#"><img src="<?=base_url()?>assets/images/friend-12.png"></a></li>
                         </ul>
        </div>
    	<div class="foot-text">
        	
<ul>
    <li><a href="#">Terms of Use</a></li>
    <li><a href="#">Privacy Policy</a></li>
    <li><a href="#">Disclaimer</a></li>
    <li><a href="#">Developers</a></li>
    <li><a href="#">Contact</a></li>
    <li><a href="#">About</a></li>
    <li><a href="#">Admin</a></li>
</ul>
<ul class="language">
<li class="title-language"> Language: </li>
<li><a href="#"> English</a></li>
<li><a href="#">Netherlands</a></li>
<li><a href="#">Romanian</a></li>
</ul>

<p>Copyright © 2014 Interfacetree. All rights reserved. Ronak's Production.</p>

        </div>
    </div>
 </footer>

   
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="<?=base_url()?>assets/js/jquery.min.js"></script>
    <script src="<?=base_url()?>assets/js/bootstrap.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $(".custom-select").each(function(){
                $(this).wrap("<span class='select-wrapper'></span>");
                $(this).after("<span class='holder'></span>");
            });
            $(".custom-select").change(function(){
                var selectedOption = $(this).find(":selected").text();
                $(this).next(".holder").text(selectedOption);
            }).trigger('change');
			
			$(".event-img").click(function() { $(this).css("display", "none"); });
        })
    </script>
     
    
    <script src="<?=base_url()?>assets/js/tab.js"></script>
    <script>
		$(function() {
		$( "#tabs" ).tabs();
		$( "#tabs1" ).tabs();
		$( "#tabs2" ).tabs();
		$( "#accordion" ).accordion();
		$( "#accordion1" ).accordion();
		});
	</script>
    
	<script type="text/javascript" src="<?=base_url()?>assets/js/jquery.simplyscroll.js"></script>
    <link rel="stylesheet" href="<?=base_url()?>assets/css/jquery.simplyscroll.css" media="all" type="text/css">
    <script type="text/javascript">
    (function($) {
        $(function() {
            $("#scroller").simplyScroll({orientation:'vertical',customClass:'vert'});
			 $("#scroller1").simplyScroll({orientation:'vertical',customClass:'vert'});
        });
    })(jQuery);
    </script>
	<script src="<?=base_url()?>assets/js/notification/SmartNotification.min.js"></script>    
    <!-- JARVIS WIDGETS -->
	<script src="<?=base_url()?>assets/js/smartwidgets/jarvis.widget.min.js"></script>
    <script src="<?=base_url()?>assets/js/app.js"></script>
    <script src="<?=base_url()?>assets/js/superbox/superbox.min.js"></script>
	<script type="text/javascript">
		
		// DO NOT REMOVE : GLOBAL FUNCTIONS!
		
		$(document).ready(function() {
			
			pageSetUp();
			
			$('.superbox').SuperBox();
			$('.superbox1').SuperBox();
		
		})

		</script>
    <script src="<?=base_url()?>assets/js/dropzone/dropzone.min.js"></script>
  </body>
</html>
