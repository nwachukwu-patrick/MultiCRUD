<?php

namespace bootstrap;

ob_start();
require_once dirname(__DIR__)."/vendor/autoload.php";
use conf\config as config;

class bootstrap{
    function loadCss($cssfilename){
        $dir  = '/lib/css/'.$cssfilename;
       echo "<link rel=\"stylesheet\" href=\"$dir\">";
    }
    function loadJs($jsfilename){
        $dir = '/lib/js/'.$jsfilename;
        echo  "<script src=' $dir' type=\"text/javascript\"></script>";
    }
    function loadImg($imgfilename,$alt=''){
        $dir  = '/lib/img/'.$imgfilename;
        echo "<img src=\"$dir\" alt=\"$alt\">";
    }
    function loadImgWithSize($imgfilename,$width,$height,$alt=''){
        $dir  = '/lib/img/'.$imgfilename;
        echo "<img src=\"$dir\" style=\"width:$width; height:$height; \" alt=\"$alt\">";
    }
    function loadUrl($url,$linktext){
        $conf = new config();
        $u = '/';
        echo "<a href=\"$u\" class=\"btn btn-primary\">$linktext</a>";
    }
    function loadProductUrl($url,$linktext){
        $conf = new config();
        $u = '/?productid='.$url;
        echo "<a href=\"$u\" class=\"btn btn-primary\">$linktext</a>";
    }

}