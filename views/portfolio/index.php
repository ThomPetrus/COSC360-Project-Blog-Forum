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
            <button class="btn btn-light search-bar-btn" value="submit" name="submit"
                    type="submit">·MY PORTFOLIO·</button>
        </form>
        <?php endif;?>
    </div>
</div>