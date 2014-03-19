
<div class="search-results">
    <?php
    if(!empty($search_result)){
        ?>
        <div class="notification-inner">
            <a onclick="manageResults(1)">Manage</a>
            <a title="Close Resilts" onclick="manageResults(0)">
                <div class="delete_btn"></div>
            </a>
        </div>
        <?php
        foreach($search_result as $row): ?>
        <div class="message-inner">
            <div id="subscribe<?=$row['Id']?>"></div>
            <div id="avatar<?=$row['Id']?>" class="message-avatar">
                <a href="">
                    <img src="" />
                </a>
            </div>
            <div class="message-top">
                <div id="author<?=$row['Id']?>" class="message-author">
                    <a href="<?=base_url()?>profile?id=<?=$row['Id']?>"><?=$row['FirstName'].' '.$row['LastName']?></a>
                </div>
                <div class="message-time">

                </div>
            </div>
        </div>
        <?php
        endforeach;
    }
    else{
        echo "no results found!";
    }
    ?>
    
</div>
