<div>
    <a class="btn btn-success btn-post" href="<?php echo ROOT_PATH;?>posts/add">POST</a>
    <?php foreach($viewmodel as $item) : ?>
    <div class="well">
        <h3><?php echo $item['title']; ?></h3>
        <small><?php echo $item['date'];?></small>
        <hr />
        <p><?php echo $item['body'];?></p>
        <br />
        <img src='<?php echo '/uploads_posts/'.$item['img']; ?>' alt="Post Image"/>
        <a class="btn btn-default" href="<?php echo $item['link'];?>" target="_blank">Follow Post's Link</a>
    </div>
    <?php endforeach;?>
</div>