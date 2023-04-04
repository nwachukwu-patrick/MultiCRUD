<?php
session_start();
require_once dirname(dirname(dirname(__DIR__)))."/vendor/autoload.php";
// use bootstrap\bootstrap;
use conf\config as config;
$config = new config();
$bootstrap = new bootstrap\bootstrap();
$config->turnError();
$conf = new config();
$bootstrap->loadCss('bootstrap.css');
$connection = new conf\connection();
if(empty($_SESSION['id'])){
    header("Location: ../login.php");
}

$admin  = new classes\admin();

$admin->admin();

?>











<?php



// $bootstrap->loadJs('index.js');
// $bootstrap->loadJs('admin-dashboard.js');
// new classes\footer();


