<footer>
    <div class="container">
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