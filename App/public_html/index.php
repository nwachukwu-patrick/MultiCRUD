<?php
session_start();
use bootstrap\bootstrap;

use function classes\test;
require_once dirname(dirname(__DIR__))."/vendor/autoload.php";

new classes\header();
$product = new classes\product();
$category = new classes\category(6);
$bootstrap = new bootstrap();
if(isset($_GET['productid'])){
    $product->displayProduct($_GET['productid']);
    $product->displayImages($_GET['productid']);
    $product->displayAllProduct(6);
}else{
    ?>
    
<div class="container">
        <div class="row ">
        <h3>Category</h3>
                 
          
            <?php
    for($i = 0; $i  < count($category->name);$i++){

?> <a href="/category.php?categoryid=<?php echo $category->id[$i]; ?>" class=" col-4 col-lg-2  nav-link ">
<div class="card " style="width: 100% ;height:60% ;">
           <?php $bootstrap->loadImgWithSize($category->images[$i],'100%','100%'); 
           echo $category->name[$i];
           ?>
        
            </div></a>
    <?php
    
}  
    ?>
    
        </div>
</div>
<?php 
    $product->displayAllProduct(12);
}





$bootstrap->loadJs('index.js');
new classes\footer();

?>