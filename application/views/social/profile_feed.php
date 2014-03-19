<input type="hidden" value="<?=$profile_id?>" name="profile_id" id="profile_id"/>
<div id="featureContent">
        <div id="indexPosts"><?php $this->load->view('elements/timeline/text_message',$data=''); ?>
            <span>Loading</span>
            <span id='more'>...</span>
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
var profile_id = $('#profile_id').val();
var page = 1;
var lastPage = false;

$(window).scroll(function () {
    // HIDE LOADING ICON
    $('#more').hide();
    $('#no-more').hide();
    
    // SHOW LOADING ICON
    if($(window).scrollTop() + $(window).height() >= $(document).height() - 200) {						   
        if(!lastPage) {
            //$('#more').css("top","400");
            $('#more').show();
        }
    }
    
    // IF SCROLL BAR REACH TO THE END OF THE PAGE LOAD MORE DATA
    if(($(window).scrollTop() + $(window).height() === $(document).height()) && !lastPage) {
        // IF IT IS NOT LAST PAGE INCREMENT IT
        page++;
        // NOW LOAD MORE CONTENT 
           $.ajax({
                type: "POST",
                url: "/profile/socialProfileTimeLine/"+profile_id,
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
                        //$('#no-more').css("top","400");
                        $('#no-more').show();
                    }
                }
          });
       }
});


</script>