<?php
// Start session
session_start();
error_reporting(E_ALL ^ E_NOTICE);

// Directory Paths
$controllersPath = 'app/Controllers/';
$modelsPath = 'app/Models/';
$helpersPath = 'app/Helpers/';
$corePath = 'core/';

//Include Config
require('config/env.php');

require("{$corePath}Bootstrap.php");
require("{$corePath}Message.php");
require("{$corePath}Controller.php");
require("{$corePath}Model.php");
require("{$corePath}Session.php");

require("{$controllersPath}BookController.php");
require("{$controllersPath}UserController.php");
require("{$controllersPath}ContactController.php");

require("$modelsPath/BookModel.php");
require("$modelsPath/UserModel.php");

require("$helpersPath/index.php");

require("vendor/sendgrid-php/vendor/autoload.php");

$bootstrap = new Bootstrap($_REQUEST);
$controller = $bootstrap->createController();
if($controller){
    $controller->executeAction();
}