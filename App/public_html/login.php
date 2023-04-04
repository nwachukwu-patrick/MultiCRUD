<?php
session_start();
ob_start();
require_once dirname(dirname(__DIR__))."/vendor/autoload.php";

new classes\header();
$config = new conf\config();
$connection = new conf\connection();

$emptyusername = false;
$emptypassword = false;
$incorrectusername = "Enter Your Email";
$incorrectpassword = 'Enter Your Password';
if($_POST['login']){
    $username =  $_POST['username'];
    $password =  $_POST['password'];
    if(empty($username) && empty($password)){
        $emptyusername = true;
        $emptypassword = true;
        $incorrectusername  = "Username is empty";
        $incorrectpassword  = "Password is empty";
    }else if(empty($username) ){
        $emptyusername = true;
        $incorrectusername  = "Username is empty";
    }else if(strlen($username) < 4 ){
        $emptyusername = true;
        $incorrectusername  = "Invalid Username";
    }else if(empty($password) ){
        $emptypassword = true;
        $incorrectpassword  = "Password is empty";
    }else if(strlen($password) < 4 ){
        $emptypassword = true;
        $incorrectpassword  = "Invalid Password";
    }else{
        if(password_verify($password, $connection->selectPassword($username))){
           if($username == 'ADMIN'){
            foreach($connection->selectUser($username) as $key => $val){
                $_SESSION['id'] = $val['userid'];
                $_SESSION['username']  = $val['username'];
            }
            header("Location: /admin");
           }else{
            // echo $connection->selectUser($username)->{'username'};
            foreach($connection->selectUser($username) as $key => $val){
                $_SESSION['id'] = $val['userid'];
                $_SESSION['username']  = $val['username'];
            }
            header("Location: /");
           }
        }else{
            $emptyusername = true;
        $emptypassword = true;
        $incorrectusername  = "Wrong username or password";
        $incorrectpassword  = "Wrong username or password";
        }
    }
    
    }

?>

  <div class="container mx-5">
<form role="form " class="row-2 py-5 my-5 mx-5" method="POST" action="">

<h3 class="help-bloc col-lg-4 mx-auto my-3"><?php echo $config->getAppName(); ?> </h3>

<div class="form-group mx-auto col-lg-4">
<label for="name">username</label>
<?php if($emptyusername == true){
    ?>
    <input type="text" class="form-control border-danger" name="username"
    placeholder="<?php echo $incorrectusername; ?>">
    <?php 
}else{?>
<input type="text" class="form-control " name="username"
placeholder="<?php echo $incorrectusername; ?>">
<?php }?>
</div>

<div class="form-group mt-2 mx-auto col-lg-4">
<label for="name">Password</label>
<?php if($emptypassword == true){
    ?>
<input type="password" class="form-control border-danger" name="password"
placeholder="<?php echo $incorrectpassword; ?>">
<?php }else{ ?>
    <input type="password" class="form-control" name="password"
placeholder="<?php echo $incorrectpassword; ?>">
<?php } ?>
</div>

  <div class="form-group mx-auto col-lg-4">
  <p class="mx-auto">New User <a href="/signup.php">Sign Up</a></p>
<input type="submit" name="login" value="Login" class="btn col-lg-4 m-auto my-4 btn-primary">

</div>
</form>
</div>


<?php




new classes\footer();


