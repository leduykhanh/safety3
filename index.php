<?php
session_start();
include_once('config.php');

if($_SESSION['adminid'])
{
    ?><script type="text/javascript">window.location.assign("listwork_activity.php")</script>
    <?php
}

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
		
			echo "<script>window.open('listwork_activity.php','_self')</script>";
		
		}
		else 
		{
					
			echo "<script>alert('username or password is not correct, try again!')</script>";
		
			echo "<script>window.open('index.php','_self')</script>";
		
		}

}

?>

 <!doctype html>
    <html>
    <head>
    <meta charset="utf-8">
    <title>Risk Management</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" integrity="sha256-7s5uDGW3AHqw6xtJmNNtr+OBRJUlgkNJEo78P4b0yRw= sha512-nNo+yCHEyn0smMxSswnf/OnX6/KwJuZTlNZBjauKhTK0c+zT+q5JOCx0UFhXQ6rJR9jg6Es8gPuD2uZcYDLqSw==" crossorigin="anonymous">

    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha256-3dkvEK0WLHRJ7/Csr0BZjAWxERc5WH7bdeUya2aXxdU= sha512-+L4yy6FRcDGbXJ9mPG8MT/3UCDzwR9gPeyFNMCtInsol++5m3bk2bXWKdZjvybmohrAsn3Ua5x8gfLnbE1YkOg==" crossorigin="anonymous">

    <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />

    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/styles.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha256-KXn5puMvxCw+dAYznun+drMdG1IFl3agK0p/pqT9KAo= sha512-2e8qq0ETcfWRI4HJBzQiA3UoyFk6tbNyG+qSaIBZLyW9Xf3sWZHN/lxe9fTh1U45DpPf07yj94KsUHHWe4Yk1A==" crossorigin="anonymous"></script>
   
   <style type="text/css">
 
body {
    font-family: Calibri, Candara, Segoe, 'Segoe UI', Optima, Arial, sans-serif;
    font-size: 13px;
}
   </style>
   

   </head>

    <body>
        <div class="container">
            <div class="container_login">

                <form name="login" id="login" method="POST" action="">
                    
                    <div class="col-sm-12">
                        <div class="col-sm-2"></div>
                        <div class="col-sm-8 form_pad">
                            <div>
                                <a href="#"><img class="center-block" src="images/risklogo.png"/></a>
                            </div>
                			
                            <h3 class="head_login" style="font-family:CALIBRI">Risk Assessment Management Tool</h3>
                            <div class=" head_login">

                                        <?php
                                          if(isset($_GET['msg']))
                                        {
                                      echo '<p style="color:red">'.$_GET['msg'].'</p>'; //If message is set echo it
                                          }
                                         ?>
                                <div class="col-sm-12 form-row">
                                    <div class="col-sm-4"><label style="font-family:CALIBRI">Staff ID:</label></div>
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
                          
                                <div class="col-sm-12 form-row">
                                    <div class="col-sm-4">
                                        <label style="font-family:CALIBRI">Password</label>
                                    </div>
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
                                </div> 
                          
                                <div class="col-sm-12 form-row" style="margin-top: 10px;">
                                    <div class=" col-sm-6" style=" margin-left:307px; margin-top:-20px;">
                             
                                            <!-- <input  type="checkbox" name='remember' value="1"  />
                                            Remember Me --> 
                                            <button type="submit" class="col-sm-6 btn btn-success btn-lg"><strong>Login</strong></button>
                                            <!--<button class="button_send_documnet"><a href="forgotpassword.php"<strong>Forget Password</strong></a></button>-->
                                    </div>
                                </div>                           
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </body>
<html>