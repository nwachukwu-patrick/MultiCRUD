<?php
ob_start();
session_start();
require_once dirname(dirname(__DIR__))."/vendor/autoload.php";

new classes\header();
$config = new conf\config();
$connection = new conf\connection();

$emptyusername = false;
$emptypassword = false;
$emptyfirstname= false;
$emptylastname = false;
$emptyretypepassword = false;
$emptyemail = false;


$incorrectfirstname = 'Enter your firstname';
$incorrectlastname = 'Enter your lastname';
$incorrectusername = "Create Your Username";
$incorrectpassword = 'Enter Your Password';
$incorrectretypedpassword = 'Re-type your password';
$incorrectemail = 'Enter your Email';
if($_POST['register']){
    $username =  $_POST['username'];
    $password =  $_POST['password'];
    $email =  $_POST['email'];
    $firstname =  $_POST['firstname'];
    $lastname =  $_POST['lastname'];
    $retypepassword =  $_POST['retypepassword'];
    if(empty($username) && empty($password)
    && empty($firstname)&& empty($lastname)
    && empty($email)&& empty($retypepassword)){
        $emptyusername = true;
        $emptypassword = true;
        $emptyfirstname= true;
        $emptylastname = true;
        $emptyretypepassword = true;
        $emptyemail = true;
        $incorrectusername  = "Username is empty";
        $incorrectpassword  = "Password is empty";
        $incorrectfirstname = 'Firstname is empty';
        $incorrectlastname = 'Lastname is empty';
        $incorrectretypedpassword = 'Password is empty';
        $incorrectemail = 'Email is empty';
    }else if(empty($firstname) ){
        $emptyfirstname = true;
        $incorrectfirstname  = "firstname is empty";
    }else if(empty($lastname) ){
        $emptylastname = true;
        $incorrectlastname  = "lastname is empty";
    }else if(empty($email) ){
        $emptyemail = true;
        $incorrectemail  = "Email is empty";
    }else if(strpos($email,'@') == false ||
     strlen(strstr($email,'.')) > 5 ||
     strlen(strstr($email,'.')) < 2 ){
        $emptyemail = true;
        $incorrectemail  = "Invalid Email Provided";
    }else if(empty($username) ){
        $emptyusername = true;
        $incorrectusername  = "Username is empty";
    }else if(empty($password) ){
        $emptypassword = true;
        $incorrectpassword  = "Password is empty";
    }else if(empty($retypepassword) ){
        $emptyretypepassword = true;
        $incorrectretypedpassword  = "Password is empty";
    }else if(strlen($firstname) < 4 ){
        $emptyfirstname = true;
        $incorrectfirstname  = "Invalid ";
    }else if(strlen($lastname) < 4 ){
        $emptylastname = true;
        $incorrectlastname  = "Invalid ";
    }else if(strlen($email) < 4 ){
        $emptyemail = true;
        $incorrectemail  = "Invalid ";
    }else if(strlen($username) < 4 ){
        $emptyusername = true;
        $incorrectusername  = "Invalid ";
    }else if(strlen($password) < 4 ){
        $emptypassword = true;
        $incorrectpassword  = "Invalid ";
    }else if(strlen($retypepassword) < 4 ){
        $emptyretypepassword = true;
        $incorrectretypedpassword  = "Invalid ";
    }else if($password != $retypepassword ){
        $emptyretypepassword = true;
        $emptypassword = true;
        $incorrectpassword  = "Password is mismatch";
        $incorrectretypedpassword  = "Password is mismatch";
    }else{
       // Register user 
       if($connection -> insertIntoUsers(0,$firstname,$lastname,$username,password_hash($password,PASSWORD_DEFAULT),$email)){
        foreach($connection->selectUser($username) as $key => $val){
            $_SESSION['id'] = $val['userid'];
            $_SESSION['username']  = $val['username'];
        }
        if($username == 'ADMIN'){ 
            header("Location: /admin");
           }else{
            header("Location: /");
           }
       }else{
        echo 'Unable to register User';
       }

    }
    
    }

?>


<div class="container ">
<form role="form " class="row-2 " method="POST" action="">

<h3 class="help-bloc col-lg-4 mx-auto my-3"><?php echo $config->getAppName(); ?> </h3>

<div class="form-group mx-auto col-lg-4">
<label for="name">Enter your firstname</label>
<?php if($emptyfirstname == true){
    ?>
    <input type="text" class="form-control border-danger" name="firstname"
    placeholder="<?php echo $incorrectfirstname; ?>">
    <?php 
}else{?>
<input type="text" class="form-control " name="firstname"
placeholder="<?php echo $incorrectfirstname; ?>">
<?php }?>
</div>

<div class="form-group mx-auto col-lg-4">
<label for="name">Enter your lastname</label>
<?php if($emptylastname == true){
    ?>
    <input type="text" class="form-control border-danger" name="lastname"
    placeholder="<?php echo $incorrectlastname; ?>">
    <?php 
}else{?>
<input type="text" class="form-control " name="lastname"
placeholder="<?php echo $incorrectlastname; ?>">
<?php }?>
</div>

<div class="form-group mx-auto col-lg-4">
<label for="name">Enter your Email</label>
<?php if($emptyemail == true){
    ?>
    <input type="text" class="form-control border-danger" name="email"
    placeholder="<?php echo $incorrectemail; ?>">
    <?php 
}else{?>
<input type="text" class="form-control " name="email"
placeholder="<?php echo $incorrectemail; ?>">
<?php }?>
</div>

<div class="form-group mx-auto col-lg-4">
<label for="name">Create Your Username</label>
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


<div class="form-group mx-auto col-lg-4">
<label for="name">Enter Password</label>
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
<label for="name">Re-type your password</label>
<?php if($emptyretypepassword == true){
    ?>
<input type="password" class="form-control border-danger" name="retypepassword"
placeholder="<?php echo $incorrectretypedpassword; ?>">
<?php }else{ ?>
    <input type="password" class="form-control" name="retypepassword"
placeholder="<?php echo $incorrectretypedpassword; ?>">
<?php } ?>
</div>

<div class="form-group d-flex mx-auto col-lg-4">
<input type="submit" name="register" value="Sign up" class="btn col-lg-4 m my-4 btn-primary">
<p class="mx-auto">Already have Account <a href="/login.php">Login</a></p>
</div>
</form>
</div>



<?php

new classes\footer();