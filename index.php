<?php


// Require the config file
require('config.php');

require('classes/Bootstrap.php');
require('classes/Controller.php');
require('classes/Model.php');

require('controllers/home.php');
require('controllers/posts.php');
require('controllers/users.php');

require('models/home.php');
require('models/post.php');
require('models/user.php');


$bs = new Bootstrap($_GET);
$controller = $bs->createController();

if($controller){
    $controller->executeAction();
}
?>