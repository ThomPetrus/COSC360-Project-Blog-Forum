<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="lead">Post Something!</h3>
    </div>

    <?php
        if(isset($viewmodel)){
            echo $viewmodel;
            $categories = $viewmodel;
        }
    ?>

    <div class="panel-body">
        <form method="POST" action="<?php $_SERVER['PHP_SELF']?>" enctype="multipart/form-data">
            <div class="form-group">
                <label>Title</label>
                <input type="text" name="title" class="form-control" />
            </div>
            <div class="form-group">
                <label>Body</label>
                <textarea type="text" name="body" class="form-control"></textarea>
            </div>
            <div class="form-group">
                <label>Link</label>
                <input type="text" name="link" class="form-control" />
            </div>
            <div class="form-group">
                <label>Image</label>
                <input type="file" name="img" class="form-control" />
            </div>

            <div class="form-group">
                <label>Category</label>
                
                <!-- There must be a better way of doing this, but for now it works. -->
                <select id="category" name="category">
                    <option value="1">Software</option>
                    <option value="2">Hardware</option>
                    <option value="3">Business</option>
                    <option value="4">Finance</option>
                    <option value="5">Arts</option>
                    <option value="6">Fine Arts</option>
                    <option value="7">Sports</option>
                    <option value="8">Engineering</option>
                    <option value="9">Science</option>
                    <option value="10">Random</option>
                </select>
            </div>
            <div>
                <?php if($_SESSION['user_data']['canPost']==1):?>
                <input class="btn btn-light category-btn" name="submit" type="submit" value="Submit" />
                <?php else:?>
                <input class="btn btn-danger portfolio-btn" value="YOUR POSTING PRIVILEGES WERE SUSPENDED." />
                <?php endif;?>
                <a class="btn btn-light category-btn" href="<?php echo ROOT_PATH?>posts">Cancel Post</a>
            </div>
        </form>
    </div>
</div>