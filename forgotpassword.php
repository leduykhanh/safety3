
<?php

include_once "config.php"; //connects to the database


if($_POST['action']=="password")
{
    $email      = mysqli_real_escape_string($connection,$_POST['email']);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) // Validate email address
    {
        $message =  "Invalid email address please type a valid email!!";
    }
    else
    {
        $query = "SELECT id FROM staff_login where email='".$email."'";
        $result = mysqli_query($connection,$query);
        $Results = mysqli_fetch_array($result);
 
        if(count($Results)>=1)
        {
            $encrypt = md5(1290*3+$Results['id']);
            $message = "Your password reset link send to your e-mail address.";
            $to=$email;
            $subject="Forget Password";
            $from = 'info@mrphpguru.com';
            $body='Hi, <br/> <br/>Your user ID is '.$Results['id'].' <br><br>Click here to reset your password http://demo.phpgang.com/login-signup-in-php/resetpassword.php?encrypt='.$encrypt.'&action=reset   <br/> <br/>--<br>PHPGang.com<br>Solve your problems.';
            $headers = "From: " . strip_tags($from) . "\r\n";
            $headers .= "Reply-To: ". strip_tags($from) . "\r\n";
            $headers .= "MIME-Version: 1.0\r\n";
            $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
 
            mail($to,$subject,$body,$headers);
        }
        else
        {
            $message = "Account not found please signup now!!";
        }
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


  <div class="row">
      
            <div class="col-sm-12 form_pad">
             <div class="span4"></div>
               <div class="span4"><a href="#"><img class="center-block" src="images/risklogo.png"/></a></div>
                <div class="span4"></div>
			
            <h3 class="head_login"> Password Recovery</h3>
            <div class=" head_login">
               <div class="row form-row">
          
<form action="" method="post">

        <div class="row" text-align="center">
        	<label for="username">email: </label>
            <input type="text" class="form-control" size="100" name="username" id="username" value="Enter email here" />
        </div>

       <button type="submit" class="btn btn-default" name="action">Get your password</button>

    </form>
    </div>
    </div>

</body>

</html>
