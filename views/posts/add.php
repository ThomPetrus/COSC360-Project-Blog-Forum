<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Post Something!</h3>
    </div>
    <div class="panel-body">
        <form method="POST" action="<?php $_SERVER['PHP_SELF']?>" enctype="multipart/form-data">
            <div class="form-group">
                <label>Title</label>
                <input type="text" name="title" class="form-control"/>
            </div>
            <div class="form-group">
                <label>Body</label>
                <textarea type="text" name="body" class="form-control"></textarea>
            </div>
            <div class="form-group">
                <label>Link</label>
                <input type="text" name="link" class="form-control"/>
            </div>
            <div class="form-group">
                <label>Image</label>
                <input type="file" name="img" class="form-control"/>
            </div>
            <input class="btn btn-primary" name="submit" type="submit" value="Submit"/>
            <a class="btn btn-danger" href="<?php echo ROOT_PATH?>posts">Cancel Post</a>
        </form>
    </div>
</div>