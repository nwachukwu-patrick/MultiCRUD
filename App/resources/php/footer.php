<?php

namespace classes;
use conf\config as app;
use bootstrap\bootstrap as bootstrap;

class footer{
  function __construct()
  {
    
    $bootstrap = new bootstrap();
    $app = new app();
    $currentfilename = basename($_SERVER['SCRIPT_NAME'],'.php');
?>

<div class="container-fluid bg-dark text-white">
    <div class="row">
        <div class="col-sm">
          <ul class="list-unstyled">
            <li>
               <a href="/" class="nav-link text-white">home</a>
            </li>
            <li>
               <a href="/login.php" class="nav-link text-white">login</a>
            </li>
            <li>
               <a href="/signup.php" class="nav-link text-white">register</a>
            </li>
            <li>
               <a href="#" class="nav-link text-white">About Us</a>
            </li>
          </ul>
        </div>
        <div class="col-sm">
        <ul class="list-unstyled">
            <li>
               <a href="/category.php" class="nav-link text-white">category</a>
            </li>
            <li>
               <a href="#" class="nav-link text-white">products</a>
            </li>
            <li>
               <a href="/cart.php" class="nav-link text-white">Cart</a>
            </li>
            <li>
               <a href="/checkout.php" class="nav-link text-white">Check out</a>
            </li>
          </ul>
        </div>
        <div class="col-sm">
        <ul class="list-unstyled">
            <li>
               <a href="#" class="nav-link text-white">posts</a>
            </li>
            <li>
               <a href="#" class="nav-link text-white">download</a>
            </li>
            <li>
               <a href="#" class="nav-link text-white">privacy policy</a>
            </li>
            <li>
               <a href="#" class="nav-link text-white">help</a>
            </li>
          </ul>
        </div>
        <hr class="bg-white">
        <p class="text-white">Copyright &copy; <?php echo $app->getAppName(); ?> &trade;</p>
    </div>
</div>
<?php $bootstrap->loadJs('bootstrap.js'); ?>
  </body>
  </html>
<?php
}
}