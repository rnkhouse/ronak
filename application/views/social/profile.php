<?php print_r($profile); ?>
<div class="row-body content-profile">
<div class="twelve columns">
    <div class="cover-container">
        <div class="cover-content">
            <a onclick="gallery('default.png', '11066rnkhouse', 'covers')" id="default.png">
                <div class="cover-image" style="background-position: center; background-image: url(http://phpdolphin.com/demo/thumb.php?src=default.png&w=900&h=200&t=c)">
                </div>
            </a>
            <div class="cover-description">
                <div class="cover-avatar-content">
                    <div class="cover-avatar">
                        <a href="<?=base_url()?>media/social/avatars/original/<?=$profile['general']['SocialAvatar']?>" class="group3">
                            <span id="avatar">
                                <img src="<?=base_url()?>media/social/avatars/thumb/<?=$profile['general']['SocialAvatar']?>" />
                            </span>
                        </a>
                        
                        <?php if($isOwner){ ?>
                            <div id="uploadImage" class="link">Upload New</div>
                            <div style="display:none">
                            <form id="imageform" method="post" enctype="multipart/form-data" action='profile/uploadImage'>
                                <input type="file" name="fileUploadPic" id="photoimg" />
                            </form>
                            </div>
                        <?php } ?>
                        
                    </div>
                </div>
                
                
                
                <div class="cover-description-content">
                    <span id="author11066rnkhouse"></span><span id="time11066rnkhouse"></span><div class="cover-username"><a href=""><?=$profile['general']['FirstName'].' '.$profile['general']['LastName']?></a></div>
                    <div class="cover-description-buttons"><div id="subscribe11066"><a href="<?=base_url()?>settings" title="Account Settings"><div class="edit_profile_btn"></div></a></div></div>
                </div>
            </div>
        </div>
    </div>


<div style="display:none">
<div id="cropbox">
    <div id="cropboxImage">
    <?php // image is comming from ajax response. the id of the image is: cropImage ?>
    </div>
<form action="" id="afterCrop" method="post" onsubmit="return checkCoords();">
    <input type="text" id="x" name="x" />
    <input type="text" id="y" name="y" />
    <input type="text" id="w" name="w" />
    <input type="text" id="h" name="h" />
    <input type="submit" value="Set Picture" class="btn btn-large btn-inverse" />
</form>
</div>
</div>

<script>
$(document).ready(function(){
    
    $('#uploadImage').on('click', function(){
        $('#photoimg').click();
    });
    
    $('#photoimg').on('change', function() { 
        $("#profilePage").html('');
        $("#profilePage").html('<img src="<?=base_url()?>assets/images/preloader.gif" alt="Uploading...." data-upload="true"/>'); // Loading image source...
        $("#imageform").ajaxForm({target: '#cropboxImage', cache: false}).submit();
    });
});



$('#cropImage').livequery(function() {
    $(function(){
        $('#cropImage').Jcrop({
            aspectRatio: 1,
            onSelect: updateCoords,
            minSize: [ 200, 200 ],
            maxSize: [ 400, 400 ],
            bgColor:     'black',
            bgOpacity:   .4,
            setSelect:   [0, 0, 200,200],
        });
    });

    function updateCoords(c){
        $('#x').val(c.x);
        $('#y').val(c.y);
        $('#w').val(c.w);
        $('#h').val(c.h);
    }

    function checkCoords(){
        if (parseInt($('#w').val())) return true;
    }
    
    $.colorbox({width:"75%", height:"75%", inline:true, href:"#cropbox"});
});


// Final submition of form:
$('form#afterCrop').on('submit',function(e){
    $.ajax({
            type: 'post',
            url: '/profile/afterCropImageUpload',
            data: $('form').serialize(),
            success: function (res) {
                //alert(res);
                location.reload(true);
            }
        });
    e.preventDefault();
});


// Show profile pic:
$(".group2").colorbox({rel:'group2', transition:"fade"});

</script>