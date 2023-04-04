<?php
use classes\product;

session_start();
require_once dirname(dirname(__DIR__))."/vendor/autoload.php";

use bootstrap\bootstrap;
use classes\footer;

new classes\header();
$config = new conf\config();
$connection = new conf\connection();
$bootstrap = new bootstrap();
$product = new product();
if(isset($_GET['categoryid'])){
    $get =  $_GET['categoryid'];
    // $cat = $connection -> selectCategoryById($get);
    
    $pro = $connection->selectProductByCategoryId($get);
    foreach($pro as $val){
       $product->displayProduct($val["productid"]); 
    }
   
}

$categories = $connection->selectAllCategory(); ?>
    
    <div class="container">
        <div class="row ">
        <h3>Category</h3>
                 
          
            <?php
    foreach($categories as $category){

?> <a href="/category.php?categoryid=<?php echo $category["categoryid"]; ?>" class=" col-4 col-lg-2  nav-link ">
<div class="card " style="width: 100% ;height:60% ;">
           <?php $bootstrap->loadImgWithSize($category["categoryimage"],'100%','100%'); 
           echo $category["categoryname"];
           ?>
        
            </div></a>
    <?php
    
}  
    ?>
    
        </div>
</div>
                 <?php
foreach($cat as $val){
    
 }
new footer();