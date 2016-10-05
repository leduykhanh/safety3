<?php
    session_start();
	include_once('config.php');
	if(isset($_POST['remember'])) {
$year = time() + 31536000;
setcookie('remember_me', $_POST['email'], $year);
setcookie('remember_pass', $_POST['password'], $year);
}else{
	if(isset($_COOKIE['remember_me'])) {
		$past = time() - 1000;
		setcookie('remember_me', "", $past);
		setcookie('remember_pass', "", $past);
	}
}
?>
	<?php
	
	
	if($_SERVER['REQUEST_METHOD']=="POST")
{
	$email = mysqli_real_escape_string($con,$_POST['email']);
	$pass = mysqli_real_escape_string($con,$_POST['password']);
	$sel_user = "select * from staff_login where email='$email' AND password='$pass'";
	$run_user = mysqli_query($con, $sel_user);
	$check_user = mysqli_num_rows($run_user);
	   
	  
		if($check_user>0)
		{
			$result = mysqli_fetch_assoc($run_user);
			$_SESSION['email']=$email;
			$_SESSION['useremail'] = $result['email'];
			$_SESSION['adminid'] = $result['id'];
            $_SESSION['name'] = $result['name'];
		
			echo "<script>window.open('riskregister.php','_self')</script>";
		
		}
		else 
		{
					
			echo "<script>alert('username or password is not correct, try again!')</script>";
		
			echo "<script>window.open('login.php','_self')</script>";
		
		}

}

?>

 <!doctype html>
    <html>
    <head>
    <meta charset="utf-8">
    <title>Risk management</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="css/jquery.bxslider.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/styles.css">
    
    </head>

     <body>
    <div class="container">
     <div class="container_login">
     
     
     
     




	<form name="login" id="login" method="POST" action="">
    
        <div class="row">
      
            <div class="col-sm-12 form_pad">
             <div class="span4"></div>
               <div class="span4"><a href="#"><img class="center-block" src="images/risklogo.png"/></a></div>
                <div class="span4"></div>
			
            <h3 class="head_login">Risk Assessment Management Tool</h3>
            <div class=" head_login">
               <div class="row form-row">
            <div class="col-sm-4"><label>Staff ID:</label></div>
            <div class="col-sm-6">
            <?php if(isset($_COOKIE['remember_me']))
            {
                $cookie_me=$_COOKIE['remember_me'];
            }
            else
             {
                $cookie_me="";
             }   
           ?>
           <input class="span4" type="email" name="email" id="username" required value="<?php echo $cookie_me; ?>" />
            </div>
            
          </div>
          
        
          
           <div class="row form-row">
            <div class="col-sm-4"><label>Password</label></div>
            <?php if(isset($_COOKIE['remember_pass']))
            {
                $cookie_pass=$_COOKIE['remember_pass'];
            }
            else
             {
                $cookie_pass="";
             }   
           ?>
            <div class="col-sm-6">
           <input class="span4" type="password" name="password" id="password" required value="<?php echo $cookie_pass;?>"/>
            </div>
            
       
          
          
          
             <div class="col-sm-12">
            <div class=" col-sm-12 btn-right">
         
       <input  type="checkbox" name='remember' value="1"  />
         Remember Me 
            <button type="submit" class="button_cancel_new"><strong>Login</strong></button>
            <button class="button_send_documnet"><a href="forgotpassword.php"<strong>Forget Password</strong></button></a>
          </div>
             <?php
              if(isset($_GET['msg']))
            {
          echo '<p style="color:red">'.$_GET['msg'].'</p>'; //If message is set echo it
              }
             ?>
           </div>
            </div>
                </div>
     </div>
     </div>
     </div>
     </form>
     </body>
     <html>