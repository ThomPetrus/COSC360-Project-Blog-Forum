<!DOCTYPE html>
<html lang="en">

<head>
    <title>·B·O·T·</title>

    <link rel="stylesheet" href="/assets/css/bootstrap.css">
    <link rel="stylesheet" href="/assets/css/style.css">

    <!--BootStrap-->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
    </script>

    <!-- jQuery and Related JavaScript-->
    <script src="https://code.jquery.com/jquery-3.4.1.js"
        integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
    <script type="text/javascript">
        window.jQuery || document.write('<script src="/assets/js/jquery-3.4.1.min.js"><\/script>')
    </script>

    <!--My JavaScript-->
    <script type="text/javascript" src="/assets/js/validation.js"></script>
    <script type="text/javascript" src="/assets/js/jquery-360.js"></script>

    <!--My CSS and Google Fonts-->
    <link href="https://fonts.googleapis.com/css?family=Comfortaa|Modak|Monoton|Permanent+Marker&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="/assets/css/reset.css">
    <link rel="stylesheet" href="/assets/css/style.css">
    <link rel="stylesheet" href="/assets/css/landingPageStyling.css">
    <link rel="stylesheet" href="/assets/css/BasicPortfolioStyling.css">
    <link rel="stylesheet" href="/assets/css/forumStyling.css">

</head>

<body>
    <nav class="navbar navbar-expand-md navbar-dark bg-dark" id="nav-bar">
        <a class="navbar-brand" href="<?php echo ROOT_PATH?>">·B·O·T·</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault"
            aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarsExampleDefault">

            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo ROOT_PATH; ?>">·Home· <span
                            class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo ROOT_PATH; ?>posts">·Forum·</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo ROOT_PATH; ?>portfolio">·Portfolios·</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">·Dropdown·</a>
                    <div class="dropdown-menu" aria-labelledby="dropdown01">
                        <a class="dropdown-item" href="<?php echo ROOT_PATH; ?>posts">·Forum·</a>
                        <a class="dropdown-item" href="<?php echo ROOT_PATH; ?>portfolio">·Portfolios·</a>
                        <a class="dropdown-item" href="<?php echo ROOT_PATH; ?>portfolio">·Search·</a>
                    </div>
                </li>
            </ul>

            <ul class="nav navbar-nav navbar-right">

                <!--If user is logged in display name / portfolio else login / register-->
                <?php if(isset($_SESSION['is_logged_in'])) : ?>

                <li class="nav-item">
                    <!-- User's portfolio -->
                    <form class="portfolio-search-bar" action="<?php $_SERVER['PHP_SELF']?>/portfolio/portfoliopage"
                        method="POST">
                        <input type="text" name="userId" value="<?php echo $_SESSION['user_data']['id']?>" hidden>
                        <button class="btn nav-link" value="submit" name="submit" type="submit">·Welcome
                            <?php echo $_SESSION['user_data']['fname']." ".$_SESSION['user_data']['lname'];?>·</button>
                    </form>
                </li>
                <a class="nav-link" href="<?php echo ROOT_PATH; ?>users/logout">·Log Out·</a>
                <li>

                </li>
                <?php else : ?>

                <li class="nav-item">
                    <a class="nav-link" href="<?php echo ROOT_PATH; ?>users/login">·Login·<span
                            class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo ROOT_PATH; ?>users/register">·Register·</a>
                </li>

                <?php endif; ?>

            </ul>
            <form class="form-inline my-2 my-lg-0" action="<?php $_SERVER['PHP_SELF']?>/portfolio/search" method="POST">
                <input class="form-control mr-sm-2" type="text" placeholder="Search" name="query" aria-label="Search">
                <button class="btn btn-light my-2 my-sm-0" name="submit" value="submit" type="submit">·Search·</button>
            </form>
        </div>
    </nav>
    <div class="container text-center">
        <div>
            <?php Messages::display()?>
            <?php require($view); ?>
        </div>
    </div>
</body>
<footer>
    <p>
        <i><small>Copyright &copy; Thomas Van De Crommenacer - 33970138 - February 2020</small></i>
    </p>
</footer>

</html>