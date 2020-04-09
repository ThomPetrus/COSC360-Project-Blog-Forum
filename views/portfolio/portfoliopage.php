<?php 

// Retrieve the viewmodel data 
if(isset($viewmodel))
    $user = $viewmodel;

    if(isset($viewmodel['portfolio']))
        $portfolio = $viewmodel['portfolio'];
    
    if(isset($viewmodel['posts']))
        $posts = $viewmodel['posts'];
    
    if(isset($viewmodel['carousel']))
        $carousel = $viewmodel['carousel'];

?>


<!-- If the current user navigated to their own portfolio a simple the edit portfolio btn is shown -->
<div class="portfolio-edit-button">
    <?php if(isset($_SESSION['is_logged_in']) && $portfolio[0]['userid']==$_SESSION['user_data']['id']) : ?>
    <a class="btn btn-light portfolio-btn edit-portfolio-btn-expander">·EDIT PORTFOLIO·</a>
    <?php endif;?>
</div>


<!-------------------------- Main container for the portfolio --------------------------->
<div class="portfolio-content-container">

    <!-------------------------- Carousel -------------------------->
    <div class="portfolio-content-header">

        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">

            <!-- Indicators for how many img -->
            <ol class="carousel-indicators">
                <?php $idx = 0; foreach($carousel as $img): ?>
                <li data-target="#carouselExampleIndicators" data-slide-to="<?php echo $idx++;?>"></li>
                <?php endforeach;?>
            </ol>

            <!-- 3 Carousel images from db - carousel won't load properly w/ foreach loop? -->
            <!-- TODO : change the files to have full path stored in db... -->
            <?php $idx=0; $imgs; foreach($carousel as $item){$imgs[$idx++]=$item['img']; }?>

            <div class="carousel-inner">
                <div class="carousel-item carousel-image active">
                    <img class="d-block w-100" src="<?php echo $imgs[0];?>" alt="First slide" />
                </div>
                <div class="carousel-item carousel-image">
                    <img class="d-block w-100" src="<?php echo $imgs[1];?>" alt="Second slide">
                </div>
                <div class="carousel-item carousel-image">
                    <img class="d-block w-100" src="<?php echo $imgs[2];?>" alt="Third slide">
                </div>
            </div>

            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>

            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>

        </div>

        <!---------------------------- Carousel Edit section ---------------------------->
        <div class="edit-portfolio-btn">
            <a class="btn btn-light portfolio-btn edit-carousel-btn">+ Add Image to Carousel +</a>

            <div class="edit-carousel-form">

                <small>By default your last 3 uploaded images are shown.</small>
                <form method="POST" action="<?php $_SERVER['PHP_SELF']?>editPortfolioCarousel"
                    enctype="multipart/form-data">

                    <!-- use name to determine carousel image, uid to determine to which user to upload it -->
                    <input name="carousel" value="<?php echo $_SESSION['user_data']['id'];?>" hidden>
                    <div class="form-group">
                        <input type="file" name="carousel-img" class="form-control" />
                    </div>
                    <input class="btn btn-light portfolio-btn" name="submit" type="submit" value="Submit" />
                </form>
            </div>
        </div>
    </div>

    <!--Allow colour change cards?-->

    <!----------------------------portfolio profile---------------------------->
    <div class="portfolio-content-body row">

        <div class="col-sm-4">
            <div class="card portfolio-profile">
                <div class="profile-picture">
                    <img class="card-img-top portfolio-post-img" src="<?php echo $portfolio[0]['profilePic']; ?>"
                        alt="Card image cap">
                </div>
                <div class="card-body">
                    <h5 class="card-title"><?php echo $portfolio[0]['fname'].' '.$portfolio[0]['lname']?></h5>
                </div>

                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <p class="card-text"><?php echo $portfolio[0]['profile'];?></p>
                    </li>
                    <li class="list-group-item">
                        <p><strong>Education:</strong></p>
                        <p class="card-text"><?php echo $portfolio[0]['edu'];?></p>
                    </li>
                    <li class="list-group-item">
                        <p><strong>Occupation:</strong></p>
                        <p class="card-text"><?php echo $portfolio[0]['job'];?></p>
                    </li>
                    <?php if(isset($portfolio[0]['website'])): ?>
                    <li class="list-group-item"><a class="btn btn-light"
                            href="<?php echo $portfolio[0]['website'];?>">Check Out My Website</a>

                    </li>
                    <?php endif;?>

                    <!----------------------------Portfolio Edit section------------------------------------------>
                    <div class="edit-portfolio-btn">
                        <a class="btn btn-light portfolio-btn edit-profile-btn">+ Edit Profile +</a>

                        <div class="edit-profile-form">
                            <small>By default only 1 profile picture is stored.</small>
                            <form method="POST" action="<?php $_SERVER['PHP_SELF'];?>editPortfolioProfile"
                                enctype="multipart/form-data">

                                <!-- Not needed necessarily but user id is sent to identify what profile to update -->
                                <input name="userId" value="<?php echo $_SESSION['user_data']['id'];?>" hidden>
                                <div class="form-group">
                                    <label>First Name</label>
                                    <input type="text" name="fname" class="form-control"></input>
                                </div>
                                <div class="form-group">
                                    <label>Last Name</label>
                                    <input type="text" name="lname" class="form-control"></input>
                                </div>
                                <div class="form-group">
                                    <label>Profile Picture</label>
                                    <input type="file" name="profilepic" class="form-control" />
                                </div>
                                <div class="form-group">
                                    <label>Profile Bio</label>
                                    <input type="text" name="profile" class="form-control"></input>
                                </div>
                                <div class="form-group">
                                    <label>Education</label>
                                    <input type="text" name="education" class="form-control"></input>
                                </div>
                                <div class="form-group">
                                    <label>Occupation</label>
                                    <input type="text" name="job" class="form-control"></input>
                                </div>
                                <div class="form-group">
                                    <label>Website</label>
                                    <input type="text" name="website" class="form-control"></input>
                                </div>
                                <input class="btn btn-light portfolio-btn" name="submit" type="submit" value="Submit" />
                                </br>
                                <small>Simply leave the fields you do not want changed empty!</br>
                                    Password recovery available on login page.</br>
                                </small>
                            </form>
                        </div>
                    </div>
                </ul>
            </div>
        </div>

        <!---------------------------- Portfolio profile posts---------------------------->
        <div class="col-sm-8">
            <div class="portfolio-posts">
                <?php $idx = 1; foreach($posts as $post):?>
                <div class="card">
                    <img class="card-img-top" src="<?php echo $post['img'];?>" alt="Post Image" />
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $post['title'];?></h5>
                        <p class="card-text"><?php echo $post['description'];?></p>
                    </div>
                    <div class="card-body">
                        <?php if(isset($post['link'])):?>
                        <a href="<?php echo $post['link'];?>" class="card-link">Follow Related link</a>
                        <?php endif; ?>
                    </div>

                    <!----------------------------Every post has an Edit section---------------------------->
                    <div class="edit-portfolio-btn portfolio-post">

                        <!--Expand edit section button-->
                        <a class="btn btn-light portfolio-btn edit-portfolio-post-btn"
                            id="edit-post-<?php echo $idx;?>">+ Edit Post +</a>
                        
                        <!--Expand delete section button-->
                        <a class="btn btn-light portfolio-btn delete-portfolio-post-btn"
                            id="delete-post-<?php echo $idx;?>">- Delete Post -</a>
                        
                        <!-- Delete form -->
                        <div class="delete-portfolio-post-form" id="delete-form-<?php echo $idx;?>">

                            <form method="POST" action="<?php $_SERVER['PHP_SELF']?>deletePortfolioPost"
                                enctype="multipart/form-data">

                                <!-- use session variable to retrieve user id ? -->
                                <input name="postId" value="<?php echo $post['postId'];?>" hidden>
                                <input class="btn btn-light portfolio-btn" name="submit" type="submit" value="Confirm Delete?" />
                            </form>
                        </div>
                
                        <div class="edit-portfolio-post-form" id="form-<?php echo $idx;?>">

                            <form method="POST" action="<?php $_SERVER['PHP_SELF']?>editPortfolioPost"
                                enctype="multipart/form-data">

                                <!-- use session variable to retrieve user id ? -->
                                <input name="postId" value="<?php echo $post['postId'];?>" hidden>

                                <div class="form-group">
                                    <label>Title</label>
                                    <input type="text" name="title" class="form-control"></input>
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
                                    <input type="file" name="postImg" class="form-control" />
                                </div>
                                <input class="btn btn-light portfolio-btn" name="submit" type="submit" value="Submit" />
                            </form>
                        </div>
                    </div>
                </div>
                <?php $idx++;?>
                <?php endforeach;?>
            </div>

            <!-- If the current user navigated to their own portfolio a simple add post button is shown -->
            <?php if(isset($_SESSION['is_logged_in']) && $portfolio[0]['userid']==$_SESSION['user_data']['id']) : ?>
            <a class="btn btn-light portfolio-btn add-post-expander">+ Add Post +</a>
            <?php endif;?>


            <!-- Expanding form for adding a post - Always visible for easy access -->
            <div class="portfolio-add-post">
                <form method="POST" action="<?php $_SERVER['PHP_SELF']?>addPost" enctype="multipart/form-data">

                    <input name="post-id" value="<?php echo $post['id']?>" hidden>

                    <div class="form-group">
                        <label>Title</label>
                        <input type="text" name="title" class="form-control"></input>
                    </div>
                    <div class="form-group">
                        <label>Body</label>
                        <textarea type="text" name="description" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Link</label>
                        <input type="text" name="link" class="form-control" />
                    </div>
                    <div class="form-group">
                        <label>Image / Media</label>
                        <input type="file" name="img" class="form-control" />
                    </div>

                    <input class="btn btn-light portfolio-btn" name="submit" type="submit" value="Submit" />
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Colour change can probably be handled by jQuery? Need to store set values in db though. -->