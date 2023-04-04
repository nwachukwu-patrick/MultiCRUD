<?php
require_once dirname(dirname(dirname(__DIR__)))."/vendor/autoload.php";

// new classes\header();
$config = new conf\config();
$connection = new conf\connection();
$config->turnError();

if(isset($_POST['addproduct'])){
    $allowedtypes = array('jpg','png','jpeg','gif');
    $maxsize = 2 *1024 *1024;
   $uploaddir = realpath('../lib/img').'/';
    $productname = array();
    $i = 0;
    if(!empty(array_filter($_FILES['images']['name']))){
        foreach($_FILES['images']['name'] as $key => $value){
            $i += 1;
            $tempname = $_FILES['images']['tmp_name'][$key];
            $name = $_FILES['images']['name'][$key];
            $size = $_FILES['images']['size'][$key];
            $ext = pathinfo($name,PATHINFO_EXTENSION);
            $filepath = $uploaddir.$name;
            if(in_array(strtolower($ext),$allowedtypes)){
            if($size > $maxsize){
                echo "Error: file size is greater than max size";
            }
            if(!file_exists($filepath)){
                $name = 'product_'.time().$i.'.'.$ext;
               $filepath = $uploaddir.$name;
                if(move_uploaded_file($tempname,$filepath)){
                    array_push($productname,$name);
                }else{
                    echo 'error: uploading file<br>';
                }
            }else{
                echo 'file existed';
            }

        }else{
            echo 'file type not allowed';
        }
    }
    $cat = $connection -> selectCategory($_POST['category']);
    foreach($cat as $val){
        $connection -> insertIntoProducts(0,$_POST['productname'],$_POST['price'],$_POST['desc'],$val["categoryid"],implode(' ',$productname));
                    header('Location: /admin');
    }
    
}else{
    echo 'no file selected';
}
}



if(isset($_POST['addcategory'])){
$name =  $_POST['categoryname'];
$image = $_POST['images'];
$allowedtypes = array('jpg','png','jpeg','gif');
$maxsize = 2 *1024 *1024;
$uploaddir = realpath('../lib/img').'/';
$productname = array();
$i = 0;
if(!empty(array_filter($_FILES['images']['name']))){
    foreach($_FILES['images']['name'] as $key => $value){
        $i += 1;
        $tempname = $_FILES['images']['tmp_name'][$key];
        $name = $_FILES['images']['name'][$key];
        $size = $_FILES['images']['size'][$key];
        $ext = pathinfo($name,PATHINFO_EXTENSION);
        $filepath = $uploaddir.$name;
        if(in_array(strtolower($ext),$allowedtypes)){
        if($size > $maxsize){
            echo "Error: file size is greater than max size";
        }
        if(!file_exists($filepath)){
            $name = 'category_'.time().$i.'.'.$ext;
           $filepath = $uploaddir.$name;
            if(move_uploaded_file($tempname,$filepath)){
                array_push($productname,$name);
            }else{
                echo 'error: uploading file<br>';
            }
        }else{
            echo 'file existed';
        }

    }else{
        echo 'file type not allowed';
    }
}
$connection -> insertIntoCategories($_POST['categoryname'],implode(' ',$productname));
                header('Location: /admin');
}else{
echo 'no file selected';
}
}