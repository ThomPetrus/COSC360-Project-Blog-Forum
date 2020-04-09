<?php

// Start Session
session_start();


// Require the config file
require('config.php');

require('classes/Bootstrap.php');
require('classes/Controller.php');
require('classes/Model.php');
require('classes/Messages.php');

require('controllers/home.php');
require('controllers/posts.php');
require('controllers/users.php');
require('controllers/portfolio.php');

require('models/home.php');
require('models/post.php');
require('models/user.php');
require('models/portfolio.php');

// Use GET and bootstrap object to determine which controller and action was requested
$bs = new Bootstrap($_GET);

// Create said controller
$controller = $bs->createController();

// Execute the requestion action - i.e. controller = users and action = login
if($controller){
    $controller->executeAction();
}
?>