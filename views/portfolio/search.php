<?php 

if(isset($viewmodel))
    $results = $viewmodel; 

?>

<div class="forum-content-container">
    <div class="text-center welcome-panel portfolio-index-panel">
        <form class="portfolio-search-bar" action="<?php $_SERVER['PHP_SELF']?>/portfolio/search" method="POST">
            <div class="Search-bar">
                <input class="form-control text-center" name="query" type="text" placeholder="· Search · Portfolios ·"
                    aria-label="Search">
                <button class="btn btn-light search-bar-btn" value="submit" name="submit"
                    type="submit">·Search·</button>
            </div>
        </form>
        <?php if(isset($_SESSION['is_logged_in'])) : ?>
        <br>·OR·<br>

        <!-- User's portfolio -->
        <form class="portfolio-search-bar" action="<?php $_SERVER['PHP_SELF']?>/portfolio/portfoliopage" method="POST">
            <input type="text" name="userId" value="<?php echo $_SESSION['user_data']['id']?>" hidden>
            <button class="btn btn-light search-bar-btn" value="submit" name="submit" type="submit">·MY
                PORTFOLIO·</button>
        </form>
        <?php endif;?>


    </div>
    <p class="lead">Results:</p>
    <div class="search-results-container">
        <table class="table table-hover table-dark search-results-table">
            <thead>
                <tr>
                    <th scope="col">Full name</th>
                    <th scope="col">Occupation</th>
                    <th scope="col">Education</th>
                    <th scope="col">Portfolio</th>

                    <!--If user is admin select priviliges are shown-->
                    <?php if(isset($_SESSION['is_logged_in']) && $_SESSION['user_data']['isAdmin']==TRUE):?>
                    <th scope="col">Post Privilege</th>
                    <th scope="col">Login Privilege</th>
                    <th scope="col">Admin Privilege</th>
                    <th scope="col">Delete User</th>
                    <?php endif;?>
                </tr>
            </thead>
            <tbody>
                <?php foreach($results as $result):?>
                <tr>
                    <td><?php echo $result['fname'].' '.$result['lname'];?></td>
                    <td><?php echo $result['job']; ?></td>
                    <td><?php echo $result['edu']; ?></td>
                    <td>
                        <!-- Users portfolios -->
                        <form class="portfolio-search-bar" action="<?php $_SERVER['PHP_SELF']?>/portfolio/portfoliopage"
                            method="POST">
                            <input type="text" name="userId" value="<?php echo $result['userid']?>" hidden>
                            <button class="btn btn-light search-bar-btn" value="submit" name="submit"
                                type="submit">·Portfolio·</button>
                        </form>
                    </td>
                    <!--post privileges-->
                    <?php if(isset($_SESSION['is_logged_in']) && $_SESSION['user_data']['isAdmin']==TRUE): ?>
                    <td>
                        <form action="<?php $_SERVER['PHP_SELF']?>/users/changePostPrivilege" method="POST">
                            <input type="text" name="uid" value=<?php echo $result['userid'];?> hidden />
                            <button class="btn btn-dark" type="submit"
                                name="postPrivilege-<?php echo $result['canPost']==1?"TRUE":"FALSE";?>">
                                <?php echo $result['canPost']==1?"TRUE":"FALSE";?>
                            </button>
                        </form>
                    </td>
                    <!--log privileges-->
                    <td>
                        <form action="<?php $_SERVER['PHP_SELF']?>/users/changeLogPrivilege" method="POST">
                            <input type="text" name="uid" value=<?php echo $result['userid'];?> hidden />
                            <button class="btn btn-dark" type="submit"
                                name="logPrivilege-<?php echo $result['canLogIn']==1?"TRUE":"FALSE";?>">
                                <?php echo $result['canLogIn']==1?"TRUE":"FALSE";?>
                            </button>
                        </form>
                    </td>
                    <!--Admin privileges-->
                    <td>
                        <form action="<?php $_SERVER['PHP_SELF']?>/users/changeAdminPrivilege" method="POST">
                            <input type="text" name="uid" value=<?php echo $result['userid'];?> hidden />
                            <button class="btn btn-dark" type="submit"
                                name="adminPrivilege-<?php echo $result['isAdmin']==1?"TRUE":"FALSE";?>">
                                <?php echo $result['isAdmin']==1?"TRUE":"FALSE";?>
                            </button>
                        </form>
                    </td>
                    <!-- delete user -->
                    <td>
                        <form action="<?php $_SERVER['PHP_SELF']?>/users/deleteUser" method="POST">
                            <input type="text" name="uid" value=<?php echo $result['userid'];?> hidden />
                            <button class="btn btn-dark" type="submit" name="delete">
                                DELETE
                            </button>
                        </form>
                    </td>
                    <?php endif;?>
                </tr>
                <?php endforeach;?>
            </tbody>
        </table>
    </div>
</div>