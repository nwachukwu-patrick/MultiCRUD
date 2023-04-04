<?php
namespace conf;

use Exception;
use mysqli;

class connection{
    private $mysqli ;
    private $conf ;
    function __construct()
    {
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
        
        $this->conf =  new config();
        if($this->mysqli =  new mysqli($this->conf->getHost(),$this->conf->getDbUser(),$this->conf->getDbPassword())){
          $this->createDatabase();
          $this->createTable();
        }else{
            echo "Can't connect to mysql";
        }
        
    }
    function createDatabase(){
        $this->conf = new config();
        $database =  $this->conf->getAppName();
        $sql = "CREATE DATABASE IF NOT EXISTS $database";
        if($this->mysqli->query($sql)){
            $this->mysqli =  new mysqli($this->conf->getHost(),$this->conf->getDbUser(),$this->conf->getDbPassword(), $database);
        }else{
            $this->mysqli =  new mysqli($this->conf->getHost(),$this->conf->getDbUser(),$this->conf->getDbPassword(), $database);
        }


    }
    function createTable(){
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
        //create user table
        $query =  "CREATE TABLE IF NOT EXISTS users(
            userid int (20) NOT NULL PRIMARY KEY AUTO_INCREMENT,
            firstname VARCHAR (100) NOT NULL,
            lastname VARCHAR (100) NOT NULL,
            username VARCHAR (100) NOT NULL,
            password VARCHAR (100) NOT NULL,
            email VARCHAR (100) NOT NULL
        )"; $this->mysqli->multi_query($query);
        //create category table
        $query =  "CREATE TABLE IF NOT EXISTS categories(
            categoryid int (20) NOT NULL PRIMARY KEY AUTO_INCREMENT,
            categoryname VARCHAR (100) NOT NULL,
            categoryimage TEXT NOT NULL
        )"; $this->mysqli->multi_query($query);
        //create products table
         $query =  "CREATE TABLE IF NOT EXISTS products(
            productid int (20) NOT NULL  AUTO_INCREMENT,
            productname VARCHAR (100) NOT NULL,
            productprice int (12) NOT NULL,
            productdesc VARCHAR (255) NOT NULL,
            productcategory int (255) NOT NULL,
            insertiondate TIMESTAMP NOT NULL,
            productimage VARCHAR (100) NOT NULL,
            PRIMARY KEY (productid),
            FOREIGN KEY (productcategory) REFERENCES categories(categoryid)
        )";
         $this->mysqli->multi_query($query);
         //create cart table
        $query =  "CREATE TABLE IF NOT EXISTS cart(
            cartnumber int (20) NOT NULL PRIMARY KEY AUTO_INCREMENT,
            cartid int (20) NOT NULL ,
            productid int (20)  NOT NULL,
            productquantity int(255) NOT NULL,
            FOREIGN KEY (productid) REFERENCES products(productid),
            FOREIGN KEY (cartid) REFERENCES users(userid)
        )";
         $this->mysqli->query($query);
         //create order table
        $query = "CREATE TABLE IF NOT EXISTS orders(
            ordernumber int (20) NOT NULL PRIMARY KEY AUTO_INCREMENT,
            orderid int (20) NOT NULL,
            productid int (20) NOT NULL,
            oderdate TIMESTAMP NOT NULL,
            FOREIGN KEY (productid) REFERENCES products(productid),
            FOREIGN KEY (orderid) REFERENCES users(userid)
        )";
        $this->mysqli->query($query);
         }


    /*
**********************SELECT 

*/

 //select  cart
 function selectCart($cartid,$productid){
    $query = "SELECT * FROM `cart` WHERE cartid = $cartid AND productid = $productid";
    $result =  $this->mysqli->query($query);
    return $result->fetch_all(MYSQLI_ASSOC);
        }

function selectproductquantity($cartid,$productid){
            $query = "SELECT productquantity FROM `cart` WHERE  cartid = '$cartid' AND  productid = '$productid'";
            $result =  $this->mysqli->query($query);
            if($row = $result->fetch_row()){
                return $row[0];
            }else{
                return 'false';
            }
        }
    
//select  order 
function selectOrder($orderid,$productid){
    $query = "SELECT * FROM `orders` WHERE orderid = $orderid AND productid = $productid";
    $result =  $this->mysqli->query($query);
    return $result->fetch_all(MYSQLI_ASSOC);
        }

        //select product
function selectProduct($productid){
    $query = "SELECT * FROM `products` WHERE productid = $productid";
    $result =  $this->mysqli->query($query);
    return $result->fetch_all(MYSQLI_ASSOC);
        }

 function selectProductByCategoryId($categoryid){
            $query = "SELECT * FROM `products` WHERE productcategory = $categoryid";
            $result =  $this->mysqli->query($query);
            return $result->fetch_all(MYSQLI_ASSOC);
                }
function selectCategory($categoryname){
            $query = "SELECT * FROM `categories` WHERE categoryname ='$categoryname'";
            $result =  $this->mysqli->query($query);
            return $result->fetch_all(MYSQLI_ASSOC);
                }
function selectCategoryById($categoryid){
                    $query = "SELECT * FROM `categories` WHERE categoryid = $categoryid";
                    $result =  $this->mysqli->query($query);
                    return $result->fetch_all(MYSQLI_ASSOC);
                        }

        //select  user 
function selectUser($username){
    $query = "SELECT * FROM `users` WHERE  username = '$username'";
    $result =  $this->mysqli->query($query);
    if($result->fetch_all(MYSQLI_ASSOC)){
        return $result;
    }else{
        return 'User Not Found';
    }
        }

function selectPassword($username){
            $query = "SELECT password FROM `users` WHERE  username = '$username'";
    $result =  $this->mysqli->query($query);
    if($row = $result->fetch_row()){
        return $row[0];
    }else{
        return 'false';
    }
        }    
function selectUserName($id){
    $query = "SELECT username FROM `users` WHERE  userid = $id";
    $result =  $this->mysqli->query($query);
    return $result->fetch_row()[0];
}


    

    
/*
**********************SELECT ALL
************************FOR ADMIN AND DEVELOPER ONLY

*/

 //select all cart table
        function selectAllCart(){
            $query = "SELECT * FROM `cart`";
            $result =  $this->mysqli->query($query);
            return $result->fetch_all(MYSQLI_ASSOC);
                }
            
        //select all order table
        function selectAllOrder(){
            $query = "SELECT * FROM `orders`";
            $result =  $this->mysqli->query($query);
            return $result->fetch_all(MYSQLI_ASSOC);
                }
    
                //select all product table
        function selectAllProduct(){
            $query = "SELECT * FROM `productS`";
            $result =  $this->mysqli->query($query);
            return $result->fetch_all(MYSQLI_ASSOC);
                }
    
                
                //select all product table
        function selectAllCategory(){
            $query = "SELECT * FROM `categories`";
            $result =  $this->mysqli->query($query);
            return $result->fetch_all(MYSQLI_ASSOC);
                }
                //select all user table
        function selectAllUser(){
            $query = "SELECT * FROM `users`";
            $result =  $this->mysqli->query($query);
            return $result->fetch_all(MYSQLI_ASSOC);
                }

         function selectAllFromCart($cartid){
                    $query = "SELECT * FROM `cart` WHERE cartid = $cartid";
                    $result =  $this->mysqli->query($query);
                    return $result->fetch_all(MYSQLI_ASSOC);
                        }
                    

            
    
    
    
    
    
        

    
/*
**********************UPDATE

*/

 //update cart table
    function updateCart($cartid,$productid,$value){
$query = "UPDATE `cart` SET `productquantity`=$value WHERE cartid = $cartid AND productid = $productid";
$this->mysqli->query($query);
return true;
    }

    //update order table
    function updateOrder($orderid,$productid,$value){
        $query = "UPDATE `orders` SET `productid`=$value WHERE orderid = $orderid AND productid = $productid";
        $this->mysqli->query($query);
            }

            //update product table
    function updateProduct($productparam,$productid,$value){
        $query = "UPDATE `products` SET `$productparam`=$value WHERE  productid = $productid";
        $this->mysqli->query($query);
            }

            //update user table
    function updateUser($userparam,$userid,$value){
        $query = "UPDATE `users` SET `$userparam`=$value WHERE  userid = $userid";
        $this->mysqli->query($query);
            }
        





    
/*
**********************Delete 

*/

    //delete user
    function deleteUser($userid){
        $query = "SET FOREIGN_KEY_CHECKS = 0";
        $this->mysqli->query($query);
$query = "DELETE FROM `users` WHERE `users`.`userid` = $userid";
$this->mysqli->query($query);
    }

    //delete product
    function deleteProduct($productid){
        $query = "SET FOREIGN_KEY_CHECKS = 0";
        $this->mysqli->query($query);
$query = "DELETE FROM `products` WHERE `products`.`productid` = $productid";
$this->mysqli->query($query);
    }
    function deleteCategory($id){
$query = "DELETE FROM `categories` WHERE `categories`.`categoryid` = $id";
$this->mysqli->query($query);
return true;
    }
    //delete order
    function deleteOrder($orderid){
        $query = "SET FOREIGN_KEY_CHECKS = 0";
        $this->mysqli->query($query);
$query = "DELETE FROM `orders` WHERE `orders`.`orderid` = $orderid";
$this->mysqli->query($query);
    }
    //delete cart
    function deleteCart($productid,$cartid){
        $query = "SET FOREIGN_KEY_CHECKS = 0";
        $this->mysqli->query($query);
$query = "DELETE FROM `cart` WHERE `cart`.`productid` = $productid AND `cart`.`cartid`= $cartid ";
$this->mysqli->query($query);
    }

/*
**********************Insert 

*/


    function insertIntoUsers($userid,$firstname,$lastname,$username,$password,$email ){
        $query ="INSERT INTO users(userid,firstname,lastname,username,password,email	
        ) VALUES ($userid,'$firstname','$lastname','$username','$password','$email' )";
        if($this->mysqli->query($query)){
            return true;
        }else{
            return false;
        }
        
       
    }

    function insertIntoOrders($ordernumber,$orderid,$productid){
        $query ="INSERT INTO orders VALUES ($ordernumber,$orderid,$productid,NOW() )";
        $this->mysqli->query($query);
       
    }
    function insertIntoCart($cartnumber,$cartid,$productid,$productquantity){
        $query ="INSERT INTO cart VALUES ($cartnumber,$cartid,$productid,$productquantity)";
        $this->mysqli->query($query);
        return true;
       
    }

    function insertIntoCategories($categoryname,$categoryimage){
        $query ="INSERT INTO categories VALUES (0,'$categoryname','$categoryimage')";
        $this->mysqli->query($query);
        return true;
       
    }

    function insertIntoProducts($productid,$productname,$productprice,$productdesc,$productcategory,$productimage){
        $query ="INSERT INTO products VALUES ($productid,'$productname',$productprice,'$productdesc',$productcategory,NOW(),'$productimage' )";
        $this->mysqli->query($query);
       
    }

}




?>