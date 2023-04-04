<?php
use bootstrap\bootstrap;
use classes\product;
session_start();
use classes\cart;
use conf\connection;

require_once dirname(dirname(__DIR__))."/vendor/autoload.php";

if(isset($_SESSION['id'])){
    new classes\header();
    $bootstrap = new bootstrap();
    if($q = $_GET['q']){
        if($q  == 'viewcart'){
            ?>
            <div class="container mx-auto text-center my-4 py-5 col border px-auto" >
            <h3 class="help-block mx-auto  col px-auto my-3">Shopping Cart</h3>
            
            <?php  
            $cart = new cart();
            $conn = new connection();
            $products = new product();
            $quantity = 0;
            
            foreach($cart->viewCart($_SESSION['id']) as $key => $value){
              
                $product = $conn->selectProduct($value['productid']);
               ?>
    <?php  $products->displayImage($value['productid']); ?>
               <?php
                foreach($product as $k => $v){
                   $name = $v['productprice'].$value['productquantity'];
                   $productid = $value['productid'];
                    ?>
                    <div>
    <button class="btn btn-primary" onclick="minus(<?php echo $name; ?>);">-</button>
    <span id='quantity<?php echo $name; ?>'>1</span>
    <button class="btn btn-primary" onclick="plus(<?php echo $name; ?>);">+</button>
    </div><br>
                    <div class="form-group col py-2 ">
            <label for="name">
                <?php
                    echo $v['productname'];        ?>
            &nbsp;&nbsp;
            
            
            <?php 
                      $price = $price + $v['productprice'];
                      echo '$'.$v['productprice']. '  X '. $value['productquantity'].'<br>';
                      ?>
                      </label>
                      <button onclick="cart('removefromcart',
                      <?php echo $name; ?>,<?php echo $productid; ?>,
                      <?php echo $value['productquantity'] ?>);"
                       class="ms-5 btn btn-primary">Remove From Cart</button>
            </div>
            <?php
                }
            }
            
            ?>
            
             <div class="form-group col">
                <h4 class="help-block mx-auto  col px-auto my-3">Sub Total:
            <label for="name" class="text-end">$ <?php echo $price;  ?></label>
                </h4>
            </div>
            <div class="form-group col">
            <a class="btn btn-primary " href="/checkout.php">Checkout</a>
            </div>
            </div>
            <?php
        }elseif($q == 'removefromcart'){
            $quantity = $_GET['quantity'];
            $id = $_GET['productid'];

           ?>
            <div class="container mx-auto text-center my-4 py-5 col border px-auto" >
            <h3 class="help-block mx-auto  col px-auto my-3">Shopping Cart</h3>
            
            <?php  
            $cart = new cart();
            $conn = new connection();
            $products = new product();
            $price = 0;
            $name = 0;
            $conn->updateCart($_SESSION['id'],$id,$quantity);
            foreach($cart->viewCart($_SESSION['id']) as $key => $value){
              
                $product = $conn->selectProduct($value['productid']);
               ?>
    <?php  $products->displayImage($value['productid']); ?>
               <?php
                foreach($product as $k => $v){
                   $name = $v['productprice'].$value['productquantity'];
                   $productid = $value['productid'];
                    ?>
                    <div>
    <button class="btn btn-primary" onclick="minus(<?php echo $name; ?>);">-</button>
    <span id='quantity<?php echo $name; ?>'>1</span>
    <button class="btn btn-primary" onclick="plus(<?php echo $name; ?>);">+</button>
    </div><br>
                    <div class="form-group col py-2 ">
            <label for="name">
                <?php
                    echo $v['productname'];        ?>
            &nbsp;&nbsp;
            
            
            <?php 
                      $price = $price + $v['productprice'];
                      echo '$'.$v['productprice']. '  X '. $value['productquantity'].'<br>';
                      ?>
                      </label>
                      <button onclick="cart('removefromcart',
                      <?php echo $name; ?>,<?php echo $productid; ?>,
                      <?php echo $value['productquantity'] ?>);"
                       class="ms-5 btn btn-primary">Remove From Cart</button>
                    </div>
            <?php
                }
            }
            
            ?>
            
             <div class="form-group col">
                <h4 class="help-block mx-auto  col px-auto my-3">Sub Total:
            <label for="name" class="text-end">$ <?php echo $price;  ?></label>
                </h4>
            </div>
            <div class="form-group col">
            <a class="btn btn-primary " href="/checkout.php">Checkout</a>
            </div>
            </div>
            <?php
        }
    }else{


?>
<div class="container mx-auto text-center my-4 py-5 col border px-auto" >
<h3 class="help-block mx-auto  col px-auto my-3">Shopping Cart</h3>

<?php  
$cart = new cart();
$conn = new connection();
$price = 0;
foreach($cart->viewCart($_SESSION['id']) as $key => $value){
    $product = $conn->selectProduct($value['productid']);
    
    foreach($product as $k => $v){
        ?>
        <div class="form-group col py-2 ">
<label for="name">
    <?php
        echo $v['productname'];
        ?>
&nbsp;&nbsp;


<?php 
          $price = $price + $v['productprice'];
          echo '$'.$v['productprice']. '  X '. $value['productquantity'].'<br>';
          ?>
          </label>
</div>
<?php
    }
}

?>

 <div class="form-group col">
    <h4 class="help-block mx-auto  col px-auto my-3">Sub Total:
<label for="name" class="text-end">$ <?php echo $price;  ?></label>
    </h4>
</div>
<div class="form-group col">
<a class="btn btn-primary " href="/cart.php?q=viewcart">
    View Cart</a>
<a class="btn btn-primary " href="/checkout.php">Checkout</a>
</div>
</div>

<?php
    }
    ?>
<script>
    function cart(param,val,id,total){
        var quan = total - Number(document.getElementById('quantity'+val).innerHTML);
  var data = new Array('q='+param,'quantity='+quan,'productid='+id);
  document.location = "/cart.php?"+data.join("&");
  
  }

     function plus(val){
document.getElementById('quantity'+val).innerHTML =
Number(document.getElementById('quantity'+val).innerHTML) + 1;
  }
  function minus(val){
    document.getElementById('quantity'+val).innerHTML =
    Number(document.getElementById('quantity'+val).innerHTML) - 1;
  }



</script>
    <?php

new classes\footer();
}else{
    header('location: /login.php');
}