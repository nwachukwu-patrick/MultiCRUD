<?php

namespace classes;
use conf\config as app;
use bootstrap\bootstrap as bootstrap;



class session{
    function __construct()
    {
        session_start();
    }
    function setsession($id,$name,$productid=''){
        $_SESSION['id'] = $id;
        $_SESSION['name'] = $name;
        $_SESSION['productid'] = $productid;
    }
    function setProductidsession($productid){
        $_SESSION['productid'] = $productid;
    }
    function getProductidsession(){
       return $_SESSION['productid'];
    }
    function getsessionid(){
        return $_SESSION['id'];
    }
}