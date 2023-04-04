<?php

require_once dirname(dirname(__DIR__))."/vendor/autoload.php";

use conf\config as app;

        
$app = new app();
new classes\header();

$conn = new conf\connection();

$filename = 'settings.json';
$somecontent = "PHP";
try{
$settings = file_get_contents('settings.json',true);
$settings = json_decode($settings);

}catch(\Exception $e){
    // echo "error -> ".$e;
}

?>

<div class="container mx-auto">
<form role="form row" method="POST" action="">

<h3 class="help-block my-3">App Appearance</h3>

<div class="form-group col-lg-4">
<label for="name">Choose name for your app</label>
<input type="text" class="form-control" name="app-name"
placeholder="Enter Name">
</div>

<div class="form-group col-lg-4">
<label for="name">Enter app header color</label>
<input type="text" class="form-control" name="app-header-color"
placeholder="Enter color">
</div>

<div class="form-group col-lg-4">
<label for="name">App footer color</label>
<input type="text" class="form-control" name="app-footer-color"
placeholder="Enter color">
</div>

<div class="form-group col-lg-4">
<label for="name">App background color</label>
<input type="text" class="form-control" name="app-background-color"
placeholder="Enter color">
</div>

<div class="form-group col-lg-4">
<label for="name">App foreground color</label>
<input type="text" class="form-control" name="app-foreground-color"
placeholder="Enter color">
</div>

<h3 class="help-block my-3">Database Auth</h3>

<div class="form-group col-lg-4">
<label for="name">Database username</label>
<input type="text" class="form-control" name="database-username"
placeholder="Enter username">
</div>

<div class="form-group col-lg-4">
<label for="name">Database Password</label>
<input type="text" class="form-control" name="database-password"
placeholder="Enter password">
</div>

<div class="form-group col-lg-4">
<label for="name">Database  host</label>
<input type="text" class="form-control" name="database-host"
placeholder="Enter host">
</div>

<div class="checkbox">
<label>
<input type="checkbox"> Check me out</label>
</div>
<input type="submit" name="install" value="Submit" class="btn btn-primary">
</form>
</div>
<?php
 new classes\footer();

 
if($_POST['install']){
    $dir =  dirname(dirname(__DIR__))."/shared/config/settings.json";
   $db_host = $_POST['database-host'];
   $db_password = $_POST['database-password'];
   $db_user = $_POST['database-username'];
   $app_name = $_POST['app-name'];
   $app_header_color = $_POST['app-header-color'];
   $app_footer_color = $_POST['app-footer-color'];
   $app_background_color = $_POST['app-background-color'];
   $app_foreground_color = $_POST['app-foreground-color'];
   if(isset($db_host)){
    $settings = file_get_contents($dir);
    $array_of_settings = json_decode($settings,true);
    $array_of_settings['db_host'] =   $db_host;
    $array_of_settings['db_password'] =   $db_password;
    $array_of_settings['db_user'] =   $db_user;
    $array_of_settings['app_name'] =   $app_name;
    $array_of_settings['app_header_color'] =   $app_header_color;
    $array_of_settings['app_footer_color'] =   $app_footer_color;
    $array_of_settings['app_background_color'] =   $app_background_color;
    $array_of_settings['app_foreground_color'] =   $app_footer_color;
    $json = json_encode($array_of_settings,1);
    
    file_put_contents($dir,$json);
header('location: /');
   
   }
}
    ?>
    
</body>
</html>