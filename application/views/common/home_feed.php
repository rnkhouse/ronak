<!--
<div class="sidebar-header" onclick="oldTimeLine()" style="float: left; width: 50%">Regular Time Line</div>
<div class="sidebar-header" onclick="newTimeLine()">New Time Line</div>
-->
<input type="hidden" id="whichTimeLine" value="" />

<div id="featureContent">
        <div id="indexPosts"><?php $this->load->view('elements/timeline/text_message',$data=''); ?>
            <span>.</span>
            <span id='more'>
                <img src="<?=base_url()?>assets/images/preloader.gif" />
            </span>
            <span id='no-more'>There are no more posts</span>
        </div>
    </div>
    
    <div id="overlay">
        <a class="close"></a>
        <div id="player">&nbsp;</div>
    </div>
<script>
/*
* Infinite Scrolling
*/
var page = 1;
var lastPage = false;

$(window).scroll(function () {
    // HIDE LOADING ICON
    $('#more').hide();
    $('#no-more').hide();
    
    // SHOW LOADING ICON
    if($(window).scrollTop() + $(window).height() >= $(document).height() - 200) {						   
        if(!lastPage) {
            $('#more').css("top","400");
            $('#more').show();
        }
    }
    
    // IF SCROLL BAR REACH TO THE END OF THE PAGE LOAD MORE DATA
    if(($(window).scrollTop() + $(window).height() === $(document).height()) && !lastPage) {
        // IF IT IS NOT LAST PAGE INCREMENT IT
        page++;
        // NOW LOAD MORE CONTENT 
        
        if($('#whichTimeLine').val() == ''){
           $.ajax({
                type: "POST",
                url: "/home/timeLine",
                data: {
                        pageNumber: page,
                        ajax : true
                },
                success: function(res){
                    if($.trim(res) !== '') {
                        $("#featureContent").append($(res));
                        //parseScript(res);
                    }
                    else {											
                        // SHOW MESSAGE FOR NO MORE POSTS
                        lastPage = true;
                        $('#no-more').css("top","400");
                        $('#no-more').show();
                    }
                }
          });
        }
        else if($('#whichTimeLine').val() == 'new'){
            $.ajax({
                type: "POST",
                url: "/home/newTimeLine",
                data: {
                        pageNumber: page,
                        ajax : true
                },
                success: function(res){
                    if($.trim(res) !== '') {
                        $("#featureContent").append($(res));
                        parseScript(res);
                    }
                    else {											
                        // SHOW MESSAGE FOR NO MORE POSTS
                        lastPage = true;
                        $('#no-more').css("top","400");
                        $('#no-more').show();
                    }
                }
          });
        }
       }
});

function newTimeLine(){
    $('#whichTimeLine').val('new');
    $.ajax({
        type: "POST",
        url: "/home/newTimeLine",
        data: {
            request_new_timeline: true,
        },
        success: function(res){
            $('#mainContainer').html(null);
            $('#indexPosts').html(null);
            $('#indexPosts').html(res);
        }
    });
}

function oldTimeLine(){
    $.ajax({
        type: "POST",
        url: "/home/timeLine",
        data: {
            ajax: true,
        },
        success: function(res){
            $('#mainContainer').html(null);
            $('#indexPosts').html(null);
            $('#indexPosts').html(res);
        }
    });
}

</script>