<?php

namespace classes;

session_start();
use conf\connection as connection;
use bootstrap\bootstrap as bootstrap;
class category{
    public $images = array();
    public $name = array();
    public $id = array();
    function __construct($limit){
 
        ?>
        
        <?php
        $i = 0;
        $bootstrap = new bootstrap();
        $connection = new connection();
        $product = $connection->selectAllCategory();
        foreach($product as $key => $value){
          if($i == $limit){
            break;
          }
          array_push($this->images,$value['categoryimage']);
          array_push($this->name,$value['categoryname']);
          array_push($this->id,$value['categoryid']);
            
            
        $i++;
        }
        
        ?>
        </div>
        </div>
        <?php
        }
        
}