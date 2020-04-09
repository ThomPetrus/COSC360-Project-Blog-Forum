<div class="main-container-forum">
    <div>
        <!-- Retrieve viewmodel data -->
        <?php 
        // In case there's no posts or comments
        if(isset($viewmodel['posts']))
            $posts = $viewmodel['posts']; 
            
        if(isset($viewmodel['comments']))
            $comments = $viewmodel['comments'];
            
        if(isset($viewmodel['categories']))
            $categories = $viewmodel['categories'];
        ?>

        <!-- Categories -->
        <div id="categories-panel">
            <?php foreach($categories as $category): ?>
            <button class="btn btn-light category-btn" id="catId-<?php echo $category['categoryId']; ?>">
                <?php echo $category['categoryTitle'];?>
            </button>
            <?php endforeach; ?>
        </div>

        <!-- Button for showing the categories / writing a new post -->
        <a class="btn btn-light category-expander category-btn">·CATEGORIES·</a>
        <?php if(isset($_SESSION['is_logged_in'])) : ?>
        <a class="btn btn-light category-btn" href="<?php echo ROOT_PATH;?>posts/add">·WRITE·NEW·POST·</a>
        <?php endif;?>

        <!-- For each post-->
        <?php $idx = 1; foreach($posts as $post) :?>

        <!-- User Post -->
        <div class="forum-content-container" id="catId-<?php echo $post['categoryId'];?>">

            <!--Post Header-->
            <h3><?php echo $post['title']; ?></h3>
            <div class="forum-content-header">
                
                <?php if($post['isAdmin']) echo '<small class=admin-tag>Admin</small>';?>
                <small><?php echo $post['date'].' - '.$post['fname'] . ' ' .$post['lname'].' - in '.$post['categoryTitle'];?></small>

                <!--Delete post button - only when post uid matches current userid -->
                <?php if($post['uid']==$_SESSION['user_data']['id'] || $_SESSION['user_data']['isAdmin']==TRUE):?>
                <!--Expand delete section button-->
                <a class="btn btn-light delete-forum-post-btn" id="delete-forum-post-<?php echo $idx;?>">-
                    Delete Post -</a>

                <!-- Delete form -->
                <div class="delete-forum-post-form" id="delete-form-<?php echo $idx;?>">

                    <form method="POST" action="<?php $_SERVER['PHP_SELF']?>../posts/deleteForumPost"
                        enctype="multipart/form-data">

                        <!-- use session variable to retrieve user id ? -->
                        <input name="postId" value="<?php echo $post['id'];?>" hidden>
                        <input class="btn btn-light" name="submit" type="submit" value="Confirm Delete?" />
                    </form>
                </div>
                <?php else: ?>
                    <a class="btn btn-light disabled delete-forum-post-btn" id="delete-forum-post-<?php echo $idx;?>">-
                    Delete Post -</a>
                <?php endif;?>
            </div>

            <!--Post Content-->
            <div class="forum-content">
                <a href="<?php echo '/uploads_posts/'.$post['img']; ?>">
                    <img id="post-img" class="post-img" src="<?php echo '/uploads_posts/'.$post['img']; ?>"
                        alt="Post Image" />
                </a>
                <p><?php echo $post['body'];?></p>
            </div>

            <!-- Post comment / Follow link buttons -->
            <div class="forum-content-btns">
                <a class="btn btn-light category-btn" href="<?php echo $post['link'];?>" target="_blank">·Follow Post Link·</a>
                <!-- Only if user is logged in comments may be added -->
                <?php if(isset($_SESSION['is_logged_in'])) : ?>
                <a class="btn btn-light category-btn add-comment-expander" id="expander-<?php echo $idx;?>">·Leave a
                    comment·</a>
                <?php endif;?>
                <a class="btn btn-light category-btn all-comment-expander" id="comment-expander-<?php echo $idx;?>">·Show All·</a>
            </div>

            <!-- Expanding form for adding a comment -->
            <div class="comment" id="add-comment-<?php echo $idx;?>">
                <form method="POST" action="<?php $_SERVER['PHP_SELF']?>/posts/addComment"
                    enctype="multipart/form-data">
                    <input name="post-id" value="<?php echo $post['id']?>" hidden>
                    <div class="form-group">
                        <label>Comment</label>
                        <textarea type="text" name="comment" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Link</label>
                        <input type="text" name="link" class="form-control" />
                    </div>
                    <div class="form-group">
                        <label>Image</label>
                        <input type="file" name="img" class="form-control" />
                    </div>
                    <input class="btn btn-light category-btn" name="submit" type="submit" value="Submit" />
                </form>
            </div>

            <!-- Post comments -->
            <!--Print header-->
            <div class="post-comments">
                <?php 
                    if(isset($comments)){
                        echo "<p class=\"lead\">·Comments·</p>";
                        echo "<small> Only 2 comments shown by default. Press \"Show all\" to see all comments!</small>";
                    }
                ?>

                <!--for each comment on this post-->
                <?php $idx_comment =1; foreach($comments as $comment):?>
                <?php if($comment['postId'] == $post['id']):?>

                <div class="forum-comment post-<?php echo $idx;?>" id="<?php echo $idx_comment;?>">
                    <!--Comment header-->
                    <div class="forum-content-header">
                        <small><?php echo $comment['datePosted'].' - '.$comment['fname'] . ' ' .$comment['lname'];?></small>

                        <!--Delete post button - only when post uid matches current userid -->
                        <?php if($comment['uid']==$_SESSION['user_data']['id'] || $_SESSION['user_data']['isAdmin']==TRUE):?>
                        <!--Expand delete section button-->
                        <a class="btn btn-light delete-post-comment-btn"
                            id="delete-post-comment-<?php echo $idx_comment;?>">- Delete Comment -</a>

                        <!-- Delete form -->
                        <div class="delete-post-comment-form" id="delete-post-comment-form-<?php echo $idx_comment;?>">

                            <form method="POST" action="<?php $_SERVER['PHP_SELF']?>../posts/deletePostComment"
                                enctype="multipart/form-data">

                                <!-- use session variable to retrieve user id ? -->
                                <input name="commentId" value="<?php echo $comment['commentId'];?>" hidden>
                                <input name="postId" value="<?php echo $post['id'];?>" hidden>
                                <input class="btn btn-light" name="submit" type="submit"
                                    value="Confirm Delete?" />
                            </form>
                        </div>
                        <?php endif;?>


                    </div>

                    <!--comment content-->
                    <div class="forum-comment-content clearfix">
                        <a href="<?php echo '/uploads_posts/'.$comment['img']; ?>">
                            <img id="post-img" src='<?php echo '/uploads_posts/'.$comment['img']; ?>'
                                alt="Post Image" />
                        </a>
                        <p><?php echo $comment['comment'];?></p>
                    </div>
                    <a class="btn btn-light portfolio-btn" href="<?php echo $post['link'];?>" target="_blank">·Follow Comment
                        Link·</a>
                </div>
                <?php $idx_comment++;?>
                <?php endif;?>
                <?php endforeach;?>
            </div>
        </div>
        <?php $idx++;?>
        <?php endforeach;?>
    </div>
</div>