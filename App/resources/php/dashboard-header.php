<?php

namespace classes;
// session_start();
// error_reporting(E_ALL);
ini_set('display_errors',1);
use conf\config as app;
use bootstrap\bootstrap as bootstrap;
use conf\connection;

class dashboardheader{
  function __construct()
  {
    
    $bootstrap = new bootstrap();
    $app = new app();
    $currentfilename = basename($_SERVER['SCRIPT_NAME'],'.php');
    $con = new connection();
    if($cart = $con->selectAllFromCart($_SESSION['id'])){
    $quan = 0;
   foreach($cart as $key => $value){
     $quan = $quan + $value['productquantity'];
   }
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php
    
    if($currentfilename == 'index'){
      echo $app ->getAppName();
    }else{
      echo $currentfilename;
    }
    
    ?></title>
     <?php $bootstrap->loadCss('bootstrap.css');  ?>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light " style="background-color: <?php echo $app ->getHeaderColor()?>; color: <?php echo $app->getForegroundColor(); ?>;">
  <div class="container-fluid">
    <a class="navbar-brand" href="#"><?php echo $app ->getAppName(); ?></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="/">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/">Products</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active"  href="/cart.php" tabindex="-1" aria-disabled="false">Cart
             &nbsp;<sup style="background-color:white ;color:black; border: 1px solid yellowgreen;"  id="cart">
             <?php echo $quan; ?></sup></a>
        </li>
      </ul>
      <form class="d-flex">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>
    </div>
  </div>
</nav>
<?php
}
}