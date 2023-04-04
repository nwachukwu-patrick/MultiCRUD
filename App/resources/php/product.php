<?php

namespace classes;
session_start();
use conf\connection as connection;
use bootstrap\bootstrap as bootstrap;
class product{

function displayAllProduct($limit){
 
?>
<div class="display-flex container">
  <h3>Products</h3>
<div class="row ">
  
<?php
$i = 0;
$bootstrap = new bootstrap();
$connection = new connection();
$product = $connection->selectAllProduct();
foreach($product as $key => $value){
  if($i == $limit){
    break;
  }
    ?>
    
     <div class=" d-lg-grid col-4 col-lg-3 my-3">
    <div class="card">
    <?php 
    $img = explode(' ',$value['productimage']);
    $bootstrap->loadImg($img[0]); 
    ?>
    
  <div class="card-body">
    <h5 class="card-title"><?php echo $value['productname'];?> 
     &rarr; $<?php echo $value['productprice']; ?> </h5>
    <p class="card-text"><?php echo $value['productdesc']; ?></p>
     <?php $bootstrap->loadProductUrl($value['productid'],'View'); ?>
    
  </div>
</div>
     </div>
     
  
     
<?php
$i++;
}

?>
</div>
</div>
<?php
}

function displayProduct($productid){

  ?>

<?php
$bootstrap = new bootstrap();
$connection = new connection();

$_SESSION['productid'] = $productid;
$product = $connection->selectProduct($productid);
foreach($product as $key => $value){
    ?>
    <div class=" container mx-auto">
    <div class="row mx-auto">
     <h3><?php echo $value['productname'];?></h3>
     <div class=" d-lg-grid col col-lg-5 my-3">
    <div class="card">
    <?php 
    $img = explode(' ',$value['productimage']);
    $bootstrap->loadImg($img[0]); 
    ?>
    </div> </div>

    <div class=" d-lg-grid col col-lg-5 my-3">
  <div class="car-body ">
    <h5 class="card-title"><?php echo $value['productname'];?> <br><br>
    Price: $<?php echo $value['productprice']; ?><br><br>
   Description
  </h5>
    <p class="card-text"><?php echo $value['productdesc']; ?></p>
    <div id='display'></div>
    <div>
    <button class="btn btn-primary" onclick="minus();">-</button>
    <span id='quantity'>1</span>
    <button class="btn btn-primary" onclick="plus();">+</button>
    </div><br>
     <button class="btn btn-primary " onclick="requesti('addtocart');">Add to cart</button>
     <button class="btn btn-primary btn-sm " style="float: right;">
    <a href="/cart.php?q=viewcart" class="text-white nav-link">Viewcart</a>
    </button>
     </div>
  </div>
    
    </div>
     </div>
     
  



  <?php
  
}
}


function displayImages($productid){

  ?>
<div class="display-flex container">
<div class="row ">

<?php
$bootstrap = new bootstrap();
$connection = new connection();
$product = $connection->selectProduct($productid);
foreach($product as $key => $value){
    ?>

    <?php 
    $img = explode(' ',$value['productimage']);
    foreach($img as $key => $value){
?>
     <div class=" d-lg-grid col-4 col-lg-3 my-3">
    <div class="card">
<?php
    $bootstrap->loadImg($value); 
?>
 </div> </div>
<?php
    }
    ?>
   
  
  <?php
}

?>
 </div>
</div>
<?php
}
function displayImage($productid){

  ?>
<div class="display-flex container">
<div class="row ">

<?php
$bootstrap = new bootstrap();
$connection = new connection();
$product = $connection->selectProduct($productid);
foreach($product as $key => $value){
    ?>

    <?php 
    $img = explode(' ',$value['productimage']);
?>
     <div class=" d-lg-grid col-4 col-lg-3 my-3">
    <div class="card">
<?php
    $bootstrap->loadImg($img[0]); 
?>
 </div> </div>
   
  
  <?php
}

?>
 </div>
</div>
<?php
}
}
