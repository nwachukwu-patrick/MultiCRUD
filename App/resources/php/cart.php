<?php
namespace classes;
session_start();
use conf\connection;
class cart{
    private $conn ;
    function addtocart($id,$productid,$quantity)
    {
        $str = 0;
        $this->conn = new connection();
        if($out =  $this->conn->selectCart($id,$productid)){
         
            foreach($out as $key => $value){
                $str = $value['productquantity'];
            }
        if($this->conn->updateCart($id,$productid,($str+$quantity))){
            $cart = $this->conn->selectAllFromCart($_SESSION['id']);
    $quan = 0;
    foreach($cart as $key => $value){
      $quan = $quan + $value['productquantity'];
    }
    echo $quan;
        }
        }else{
            if($this->conn->insertIntoCart(0,$id,$productid,$quantity)){
                $cart = $this->conn->selectAllFromCart($_SESSION['id']);
    $quan = 0;
    foreach($cart as $key => $value){
      $quan = $quan + $value['productquantity'];
    }
    echo $quan;
            }
        }
    }
    function viewCart($cartid){
        $connection = new connection();
       return $connection->selectAllFromCart($cartid);
    }
}
