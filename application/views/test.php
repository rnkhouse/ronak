<!DOCTYPE html>
<html lang="en-us">
	<head>
		<meta charset="utf-8">
		<!--<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">-->

		<title>Interfacetree</title>
		<meta name="description" content="">
		<meta name="author" content="">

		<!-- Use the correct meta names below for your web application
			 Ref: http://davidbcalhoun.com/2010/viewport-metatag 
			 
		<meta name="HandheldFriendly" content="True">
		<meta name="MobileOptimized" content="320">-->
		
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

		<!-- Basic Styles -->
		<link rel="stylesheet" type="text/css" media="screen" href="<?=base_url()?>assets/css/bootstrap.min.css">	
		<link rel="stylesheet" type="text/css" media="screen" href="<?=base_url()?>assets/css/font-awesome.min.css">

		<!-- SmartAdmin Styles : Please note (smartadmin-production.css) was created using LESS variables -->
		<link rel="stylesheet" type="text/css" media="screen" href="<?=base_url()?>assets/css/smartadmin-production.css">
		<link rel="stylesheet" type="text/css" media="screen" href="<?=base_url()?>assets/css/smartadmin-skins.css">	
		
		

		<!-- FAVICONS -->
		<link rel="shortcut icon" href="<?=base_url()?>assets/img/favicon/favicon.ico" type="image/x-icon">
		<link rel="icon" href="<?=base_url()?>assets/img/favicon/favicon.ico" type="image/x-icon">

		<!-- GOOGLE FONT -->
		<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,700italic,300,400,700">
                
                <!-- MY STYLE -->
		<link rel="stylesheet" href="<?=base_url()?>assets/css/your_style.css">

                
                <style>
                    .bs-example {
				position: relative;
				padding: 15px 15px 15px;
				margin: 0 0px 15px;
				background-color: #fafafa;
				border-color: #e5e5e5 #eee #eee;
				border-style: solid;
				border-width: 1px;
			}
			/* Echo out a label for the example */
			.bs-example:after {
				content: "";
				position: absolute;
				top: 15px;
				left: 15px;
				font-size: 12px;
				font-weight: bold;
				color: #bbb;
				text-transform: uppercase;
				letter-spacing: 1px;
			}
		
			/* Tweak display of the code snippets when following an example */
			.bs-example + .highlight {
				margin: -15px 0px 15px;
				border-radius: 0;
				border-width: 0 0 1px;
			}
		
			/* Make the examples and snippets not full-width */
			@media (min-width: 768px) {
				.bs-example {
					margin-left: 0;
					margin-right: 0;
					background-color: #fff;
					border-width: 1px;
					border-color: #ddd;
					border-radius: 4px 4px 0 0;
					box-shadow: none;
				}
				.bs-example + .highlight {
					margin-top: -16px;
					margin-left: 0;
					margin-right: 0;
					border-width: 1px;
					border-bottom-left-radius: 4px;
					border-bottom-right-radius: 4px;
				}
			}
		
			/* Undo width of container */
			.bs-example .container {
				width: auto;
			}
		
			/* Tweak content of examples for optimum awesome */
			.bs-example > p:last-child, .bs-example > ul:last-child, .bs-example > ol:last-child, .bs-example > blockquote:last-child, .bs-example > .form-control:last-child, .bs-example > .table:last-child, .bs-example > .navbar:last-child, .bs-example > .jumbotron:last-child, .bs-example > .alert:last-child, .bs-example > .panel:last-child, .bs-example > .list-group:last-child, .bs-example > .well:last-child, .bs-example > .progress:last-child, .bs-example > .table-responsive:last-child > .table {
				margin-bottom: 0;
			}
			.bs-example > p > .close {
				float: none;
			}
                </style>
                
                
	</head>
	<body class="smart-style-2">
		<!-- possible classes: minified, fixed-ribbon, fixed-header, fixed-width-->

		<!-- HEADER -->
		<header id="header">
			<div id="logo-group">

				<!-- PLACE YOUR LOGO HERE -->
				<span id="logo"> <img src="<?=base_url()?>assets/img/logo.png" alt="SmartAdmin"> </span>
				<!-- END LOGO PLACEHOLDER -->

				<!-- Note: The activity badge color changes when clicked and resets the number to 0
				Suggestion: You may want to set a flag when this happens to tick off all checked messages / notifications -->
				<span id="activity" class="activity-dropdown"> <i class="fa fa-user"></i> <b class="badge"> 21 </b> </span>

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

						<div class="alert alert-transparent">
							<h4>Click a button to show messages here</h4>
							This blank page message helps protect your privacy, or you can show the first message here automatically.
						</div>

						<i class="fa fa-lock fa-4x fa-border"></i>

					</div>
					<!-- end notification content -->

					<!-- footer: refresh area -->
					<span> Last updated on: 12/12/2013 9:43AM
						<button type="button" data-loading-text="<i class='fa fa-refresh fa-spin'></i> Loading..." class="btn btn-xs btn-default pull-right">
							<i class="fa fa-refresh"></i>
						</button> </span>
					<!-- end footer -->

				</div>
				<!-- END AJAX-DROPDOWN -->
			</div>

			<!-- projects dropdown -->
			<div id="project-context">

				<span class="label">You are in Social Media</span>
				<span id="project-selector" class="popover-trigger-element dropdown-toggle" data-toggle="dropdown">Switch<i class="fa fa-angle-down"></i></span>

				<!-- Suggestion: populate this list with fetch and push technique -->
				<ul class="dropdown-menu">
					<li>
						<a href="javascript:void(0);">Social Media</a>
					</li>
					<li>
						<a href="javascript:void(0);">Career Media</a>
					</li>
				</ul>
				<!-- end dropdown-menu-->

			</div>
			<!-- end projects dropdown -->

			<!-- pulled right: nav area -->
			<div class="pull-right">

				<!-- collapse menu button -->
				<div id="hide-menu" class="btn-header pull-right">
					<span> <a href="javascript:void(0);" title="Collapse Menu"><i class="fa fa-reorder"></i></a> </span>
				</div>
				<!-- end collapse menu -->

				<!-- logout button -->
				<div id="logout" class="btn-header transparent pull-right">
					<span> <a href="login.html" title="Sign Out"><i class="fa fa-sign-out"></i></a> </span>
				</div>
				<!-- end logout button -->

				<!-- search mobile button (this is hidden till mobile view port) -->
				<div id="search-mobile" class="btn-header transparent pull-right">
					<span> <a href="javascript:void(0)" title="Search"><i class="fa fa-search"></i></a> </span>
				</div>
				<!-- end search mobile button -->

				<!-- input: search field -->
				<form action="#search.html" class="header-search pull-right">
					<input type="text" placeholder="Find reports and more" id="search-fld">
					<button type="submit">
						<i class="fa fa-search"></i>
					</button>
					<a href="javascript:void(0);" id="cancel-search-js" title="Cancel Search"><i class="fa fa-times"></i></a>
				</form>
				<!-- end input: search field -->

			</div>
			<!-- end pulled right: nav area -->
                        
		</header>
		<!-- END HEADER -->

		<!-- Left panel : Navigation area -->
		<!-- Note: This width of the aside area can be adjusted through LESS variables -->
		<aside id="left-panel">

			<!-- User info -->
			<div class="login-info">
                            <span> <!-- User image size is adjusted inside CSS, it should stay as it --> <img src="img/avatars/sunny.png" alt="me" class="online" /> <a href="">Ronak Patel</a> </span>
			</div>
			<!-- end user info -->

			<!-- NAVIGATION : This navigation is also responsive

			To make this navigation dynamic please make sure to link the node
			(the reference to the nav > ul) after page load. Or the navigation
			will not initialize.
			-->
			<nav>
				<!-- NOTE: Notice the gaps after each icon usage <i></i>..
				Please note that these links work a bit different than
				traditional hre="" links. See documentation for details.
				-->

				<ul>
                                        <li>
                                            <a href="index.html" title="Dashboard"><i class="fa fa-lg fa-fw fa-home"></i> <span class="menu-item-parent">Dashboard</span></a>
					</li>
					<li>
                                            <a href="index.html" title="Home Feed"><i class="fa fa-lg fa-fw fa-home"></i> <span class="menu-item-parent">Home Feed</span></a>
					</li>
                                        <li>
                                            <a href="index.html" title="Quick Feed"><i class="fa fa-lg fa-fw fa-home"></i> <span class="menu-item-parent">Quick Feed</span></a>
					</li>
					<li class="active">
                                            <a href="inbox.html"><i class="fa fa-lg fa-fw fa-inbox"></i> <span class="menu-item-parent">Messages</span><span class="badge pull-right inbox-badge">14</span></a>
					</li>
					<li>
                                            <a href="#"><i class="fa fa-lg fa-fw fa-bar-chart-o"></i> <span class="menu-item-parent">Photos</span></a>
					</li>
					<li>
                                            <a href="#"><i class="fa fa-lg fa-fw fa-table"></i> <span class="menu-item-parent">Videos</span></a>
					</li>
					<li>
                                            <a href="#"><i class="fa fa-lg fa-fw fa-pencil-square-o"></i> <span class="menu-item-parent">Forms</span></a>
                                            <ul>
                                                <li>
                                                    <a href="form-elements.html">Smart Form Elements</a>
                                                </li>
                                                <li>
                                                    <a href="form-templates.html">Smart Form Layouts</a>
                                                </li>
                                            </ul>
					</li>
                                </ul>
			</nav>
			<span class="minifyme"> <i class="fa fa-arrow-circle-left hit"></i> </span>

		</aside>
		<!-- END NAVIGATION -->

		<!-- MAIN PANEL -->
		<div id="main" role="main">
			<!-- MAIN CONTENT -->
			<div id="content" style="opacity: 1;">
                            
                            <div class="row">
                                <div class="col-sm-9">
                                    
                                    <!-- Widget ID (each widget will need unique ID)-->
                                                    <div class="jarviswidget" id="wid-id-4" data-widget-colorbutton="false" data-widget-editbutton="false">
                                                            <header>
                                                                    <span class="widget-icon"> <i class="fa fa-eye"></i> </span>
                                                                    <h2>Submit Status</h2>
                                                            </header>
                                                        <div class="smart-form">
                                                        <!-- widget div-->
                                                        <div>
                                                            <label class="textarea textarea-expandable"> 
                                                            <textarea class="custom-scroll" placeholder="What's up?" rows="2"></textarea>
                                                            </label>
                                                        </div>
                                                        <!-- end widget div -->
                                                        </div>
                                                        
                                                    
                                                    <div class="btn-group">
                                                        <a class="btn btn-default" href="javascript:void(0);">Default</a>
                                                        <a class="btn btn-default dropdown-toggle" data-toggle="dropdown" href="javascript:void(0);"><span class="caret"></span></a>
                                                        <ul class="dropdown-menu">
                                                            <li>
                                                                    <a href="javascript:void(0);">Action</a>
                                                            </li>
                                                            <li>
                                                                    <a href="javascript:void(0);">Another action</a>
                                                            </li>
                                                            <li>
                                                                    <a href="javascript:void(0);">Something else here</a>
                                                            </li>
                                                            <li class="divider"></li>
                                                            <li>
                                                                    <a href="javascript:void(0);">Separated link</a>
                                                            </li>
                                                        </ul>
                                                    </div><!-- /btn-group -->
                                                </div>
                                    
                                    
                                    
                                </div>
                                <div class="col-sm-3">
                                    <div class="bs-example bs-example-type">
                                        <h3 class="text-primary" style="margin: 20px 0;">hi</h3>
                                    </div>
                                </div>
                            </div>
                            
			</div>
			<!-- END MAIN CONTENT -->
                </div>
		<!-- END MAIN PANEL -->

		<!--================================================== -->

		<!-- PACE LOADER - turn this on if you want ajax loading to show (caution: uses lots of memory on iDevices)-->
		<script data-pace-options='{ "restartOnRequestAfter": true }' src="<?=base_url()?>assets/js/plugin/pace/pace.min.js"></script>

		<!-- Link to Google CDN's jQuery + jQueryUI; fall back to local -->
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
		<script>
			if (!window.jQuery) {
				document.write('<script src="js/libs/jquery-2.0.2.min.js"><\/script>');
			}
		</script>

		<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
		<script>
			if (!window.jQuery.ui) {
				document.write('<script src="js/libs/jquery-ui-1.10.3.min.js"><\/script>');
			}
		</script>

		<!-- JS TOUCH : include this plugin for mobile drag / drop touch events
		<script src="js/plugin/jquery-touch/jquery.ui.touch-punch.min.js"></script> -->

		<!-- BOOTSTRAP JS -->
		<script src="<?=base_url()?>assets/js/bootstrap/bootstrap.min.js"></script>

		<!-- CUSTOM NOTIFICATION -->
		<script src="<?=base_url()?>assets/js/notification/SmartNotification.min.js"></script>

		<!-- JARVIS WIDGETS -->
		<script src="<?=base_url()?>assets/js/smartwidgets/jarvis.widget.min.js"></script>

		<!-- SPARKLINES -->
		<script src="<?=base_url()?>assets/js/plugin/sparkline/jquery.sparkline.min.js"></script>

		<!-- browser msie issue fix -->
		<script src="<?=base_url()?>assets/js/plugin/msie-fix/jquery.mb.browser.min.js"></script>

		<!-- SmartClick: For mobile devices -->
		<script src="<?=base_url()?>assets/js/plugin/smartclick/smartclick.js"></script>

		<!--[if IE 7]>

		<h1>Your browser is out of date, please update your browser by going to www.microsoft.com/download</h1>

		<![endif]-->

		

		<!-- MAIN APP JS FILE -->
		<script src="<?=base_url()?>assets/js/app.js"></script>
		
		<!-- PAGE RELATED PLUGIN(S) -->
		
		<script src="<?=base_url()?>assets/js/plugin/delete-table-row/delete-table-row.js"></script>
		
		<script src="<?=base_url()?>assets/js/plugin/summernote/summernote.js"></script>
		
		<script src="<?=base_url()?>assets/js/plugin/select2/select2.min.js"></script>
		
		<script type="text/javascript">
		
		$(document).ready(function() {
		
			// DO NOT REMOVE : GLOBAL FUNCTIONS!
			pageSetUp();
		
			// PAGE RELATED SCRIPTS
		
			/*
			 * Fixed table height
			 */
			
			tableHeightSize()
			
			$(window).resize(function() {
				tableHeightSize()
			})
			
			function tableHeightSize() {
				var tableHeight = $(window).height() - 212;
				$('.table-wrap').css('height', tableHeight + 'px');
			}
			
			/*
			 * LOAD INBOX MESSAGES
			 */
			loadInbox();
			function loadInbox() {
				loadURL("ajax/email/email-list.html", $('#inbox-content > .table-wrap'))
			}
		
			/*
			 * Buttons (compose mail and inbox load)
			 */
			$(".inbox-load").click(function() {
				loadInbox();
			});
		
			// compose email
			$("#compose-mail").click(function() {
				loadURL("ajax/email-compose.html", $('#inbox-content > .table-wrap'));
			})
		
		});	
			
		
		</script>


		<!-- Your GOOGLE ANALYTICS CODE Below -->
		<script type="text/javascript">
			var _gaq = _gaq || [];
			_gaq.push(['_setAccount', 'UA-XXXXXXXX-X']);
			_gaq.push(['_trackPageview']);

			(function() {
				var ga = document.createElement('script');
				ga.type = 'text/javascript';
				ga.async = true;
				ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
				var s = document.getElementsByTagName('script')[0];
				s.parentNode.insertBefore(ga, s);
			})();

		</script>

	</body>
</html>