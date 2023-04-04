<?php
session_start();
require_once dirname(dirname(__DIR__))."/vendor/autoload.php";

$connection = new conf\connection();

if($request = $_GET['request']){
    if($request == 'orders'){
        ?>
        <h3>Orders</h3>
         <table class="table table-striped table-sm">
          <thead>
            <tr>
            <th scope="col">User</th>
              <th scope="col">ordernumber</th>
              <th scope="col">orderid</th>
              <th scope="col">productid</th>
              <th scope="col">oderdate</th>
            </tr>
          </thead>
          <tbody>
            <?php
$allorder =  $connection->selectAllOrder();
        foreach($allorder as $key => $value){
    ?>
 
            <tr>
            <td><?php echo $connection->selectUserName($value['orderid']) ?></td>
            <td><?php  echo $value['ordernumber']; ?></td>
              <td><?php  echo $value['orderid']; ?></td>
              <td><?php  echo $value['productid']; ?></td>
              <td><?php  echo $value['oderdate']; ?></td>
            </tr>

<?php
  }
  ?>
   </tbody>
  </table>

  <?php
}elseif($request == "products"){
  ?>
  <h3 >Products</h3>
  <button onclick="request('addproduct')" class="text-right btn btn-primary btn-sm" style="float: left;">Add product</button>
  <button onclick="request('deleteproduct')" class="text-right btn btn-primary btn-sm" style="float: right;">Delete product</button>
   <table class="table table-striped table-sm">
    <thead>
      <tr>
      <th scope="col">ID</th>
        <th scope="col">product name</th>
        <th scope="col">product price</th>
        <th scope="col">product Description</th>
        <th scope="col">Date</th>
      </tr>
    </thead>
    <tbody>
      <?php
$allorder =  $connection->selectAllProduct();
  foreach($allorder as $key => $value){
?>

      <tr>
        <td><?php echo $value['productid'] ?></td>
        <td><?php  echo $value['productname']; ?></td>
        <td><?php  echo $value['productprice']; ?></td>
        <td><?php  echo $value['productdesc']; ?></td>
        <td><?php  echo $value['insertiondate']; ?></td>
      </tr>

<?php
}
?>
</tbody>
</table>

<?php
}elseif($request == "users"){
 ?>
<h3>Customers</h3>
 <table class="table table-striped table-sm">
  <thead>
    <tr>
    <th scope="col">Customer ID</th>
      <th scope="col">Username</th>
      <th scope="col">Firstname</th>
      <th scope="col">LastName</th>
      <th scope="col">Email</th>
    </tr>
  </thead>
  <tbody>
    <?php
$allorder =  $connection->selectAllUser();
foreach($allorder as $key => $value){
  if($value['username'] == 'ADMIN'){
    continue;
  }
?>

    <tr>
      <td><?php echo $value['userid'] ?></td>
      <td><?php  echo $value['username']; ?></td>
      <td><?php  echo $value['firstname']; ?></td>
      <td><?php  echo $value['lastname']; ?></td>
      <td><?php  echo $value['email']; ?></td>
    </tr>

<?php
}
?>
</tbody>
</table>

<?php
}elseif($request == "addproduct"){
?>

<div class="container mx-auto">
<button onclick="request('addcategory')"   class="text-right btn btn-primary btn-sm" style="float: right;">Add category</button>
<form role="form row" method="POST" action="upload.php" enctype="multipart/form-data">
<h3 class="help-block my-3">Add product</h3>

  

<div class="form-group col-lg-4">
<label for="name">product name</label>
<input type="text" class="form-control" name="productname"
placeholder="product name">
</div>

<div class="form-group col-lg-4">
<label for="name">product price</label>
<input type="text" class="form-control" name="price"
placeholder="product price">
</div>

<div class="form-group col-lg-4">
<label for="name">product description</label>
<textarea type="text" class="form-control" name="desc"
placeholder="product description"></textarea>
</div>

<div class="form-group col-lg-4">
<label for="name">Category</label><br>
<select name="category" id="category">
  <?php
$cat = $connection ->selectAllCategory();
foreach($cat as $key => $value){
  ?>
    <option value="<?php echo $value['categoryname']; ?>"><?php echo $value['categoryname']; ?></option>
    <?php
}

?>


</select>
</div>

<div class="form-group col-lg-4">
<label for="name">product image</label>
<input type="file" class="form-control" name="images[]"  multiple>
</div>
<br>
<input type="submit"  name="addproduct" value="Add Product" class="btn btn-primary">
</form>
</div>

<?php
}elseif($request == 'signout'){
  if(session_destroy()){
echo 'destroyed';
}
}elseif($request == "deleteproduct"){
  ?>
    <table class="table table-striped table-sm">
    <thead>
      <tr>
      <th scope="col">ID</th>
        <th scope="col">product name</th>
        <th scope="col">product price</th>
        <th scope="col">product Description</th>
        <th scope="col">Date</th>
      </tr>
    </thead>
    <tbody>
      <?php
  $allorder =  $connection->selectAllProduct();
  foreach($allorder as $key => $value){
?>

      <tr>
        <td><?php echo $value['productid'] ?></td>
        <td> <button onclick="deleteProduct('deletedproduct',<?php echo $value['productid'] ?>)" class="btn text-primary"> <?php  echo $value['productname']; ?>
      </button></td>
        <td><?php  echo $value['productprice']; ?></td>
        <td><?php  echo $value['productdesc']; ?></td>
        <td><?php  echo $value['insertiondate']; ?></td>
      </tr>

<?php
}
?>

</tbody>
</table>
<?php
}else if($request == 'deletedproduct'){
  $connection -> deleteProduct($_GET['param']);
  echo 'deleted';
}else if($request =='addtocart'){
  if(empty($_SESSION['id']) == true){
    echo 'redirect';
  }else{
    $cart =  new classes\cart();
  $cart->addtocart($_SESSION['id'],$_SESSION['productid'],$_GET['quantity']);
  $quantity = 0;
    foreach( $connection->selectAllFromCart($_SESSION['id']) as $key => $value){
    $quantity = $quantity + $value['productquantity'];
  }
  }
}else if($request =='viewcart'){
  echo 'viewcart';
}else if($request =='removefromcart'){
  echo 'removedfromcart';
}else if($request =='addcategory'){
?>
<div class="container mx-auto">
<form role="form row" method="POST" action="upload.php" enctype="multipart/form-data">
<h3 class="help-block my-3">Add Category</h3>


<div class="form-group col-lg-4">
<label for="name">Category name</label>
<input type="text" class="form-control" name="categoryname"
placeholder="Category name">

</div>


<div class="form-group col-lg-4">
<label for="name">Category image</label>
<input type="file" class="form-control" name="images[]"  multiple>
</div>
<br>
<input type="submit"  name="addcategory" value="Add Category" class="btn btn-primary">
</form>
</div>


<?php
}else if($request =='categories'){
  ?>
  <h3 >Categories</h3>
  <button onclick="request('addcategory')" class="text-right btn btn-primary btn-sm" style="float: left;">Add Category</button>
  <button onclick="request('deletecategory')" class="text-right btn btn-primary btn-sm" style="float: right;">Delete Category</button>
   <table class="table table-striped table-sm">
    <thead>
      <tr>
      <th scope="col">ID</th>
        <th scope="col">Category Name</th>
      </tr>
    </thead>
    <tbody>
      <?php
$allorder =  $connection->selectAllCategory();
  foreach($allorder as $key => $value){
?>

      <tr>
        <td><?php echo $value['categoryid'] ?></td>
        <td><?php  echo $value['categoryname']; ?></td>
      </tr>

<?php
}
?>
</tbody>
</table>

<?php
}else if($request == 'deletecategory'){
  ?>
  <table class="table table-striped table-sm">
  <thead>
    <tr>
    <th scope="col">ID</th>
      <th scope="col">product name</th>
    </tr>
  </thead>
  <tbody>
    <?php
$allcategory =  $connection->selectAllCategory();
foreach($allcategory as $key => $value){
?>

    <tr>
      <td><?php echo $value['categoryid'] ?></td>
      <td> <button onclick="deleteProduct('deletedcategory',<?php echo $value['categoryid'] ?>)" class="btn text-primary"> 
      <?php  echo $value['categoryname']; ?>
    </button></td>
    </tr>

<?php
}
?>

</tbody>
</table>
<?php
}else if($request =='deletedcategory'){
  
  $connection -> deleteCategory($_GET['param']);
echo 'deleted';
}
}




?>
