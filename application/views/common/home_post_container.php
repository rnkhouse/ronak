<div class="newPost">
    <div class="title-area">
            <h2>New Post</h2>
    </div>

    <div class="post-contnet">
            <textarea name="" cols="" rows="" placeholder="Tell your feinds, what do you think.."></textarea>
    </div>

    <div class="post-tools">
            <ul>
            <li><a href="#"><img src="<?=base_url()?>assets/images/post-tool-icon-1.png"></a></li>
            <li><a href="#inline1" class="fancybox" ><img src="<?=base_url()?>assets/images/post-tool-icon-2.png"></a></li>
            <li><a href="#"><img src="<?=base_url()?>assets/images/post-tool-icon-3.png"></a></li>
            <li><a href="#"><img src="<?=base_url()?>assets/images/post-tool-icon-4.png"></a></li>
        </ul>
        <div id="inline1" style=" width:500px;display: none;">
                <div class="widget-body">

                <form action="upload.php" class="dropzone" id="mydropzone"><div class="dz-default dz-message"><span>Drop files here to upload</span></div></form>

        </div>
        </div>
        <div class="post-btn"><a href="#">Post</a></div>
    </div>
</div>
            <script>
                
                $('form#imageForm').submit(function(){
                    var formData = new FormData($(this)[0]);
                    $('#newPost').hide();
                    if($('#post_message').val() != ''){
                       $.ajax({
                                type: 'post',
                                url: '../home/submitStatus',
                                data: formData, //$('form').serialize()
                                async: false,
                                success: function (res) {
                                    $('#newPost').html(null);
                                    $('#newPost').html(res);
                                    $('#newPost').fadeIn(500);
                                    $('#post_message').val('');
                                },
                                cache: false,
                                contentType: false,
                                processData: false
                            });
                            return false;
                        //e.preventDefault();
                   }
                   else{
                       alert('What\'s in your mind?');
                   }
                });
                
                </script>