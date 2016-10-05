
<?php

include_once "config.php"; //connects to the database

if(isset($_GET['action']))
{          
    if($_GET['action']=="reset")
    {
        $encrypt = mysqli_real_escape_string($connection,$_GET['encrypt']);
        $query = "SELECT id FROM staff_login where md5(90*13+id)='".$encrypt."'";
        $result = mysqli_query($connection,$query);
        $Results = mysqli_fetch_array($result);
        if(count($Results)>=1)
        {
 
        }
        else
        {
            $message = 'Invalid key please try again. <a href="http://demo.phpgang.com/login-signup-in-php/#forget">Forget Password?</a>';
        }
    }
}
elseif(isset($_POST['action']))
{
 
    $encrypt      = mysqli_real_escape_string($connection,$_POST['action']);
    $password     = mysqli_real_escape_string($connection,$_POST['password']);
    $query = "SELECT id FROM staff_login where md5(90*13+id)='".$encrypt."'";
 
    $result = mysqli_query($connection,$query);
    $Results = mysqli_fetch_array($result);
    if(count($Results)>=1)
    {
        $query = "update users set password='".md5($password)."' where id='".$Results['id']."'";
        mysqli_query($connection,$query);
 
        $message = "Your password changed sucessfully <a href=\"http://demo.phpgang.com/login-signup-in-php/\">click here to login</a>.";
    }
    else
    {
        $message = 'Invalid key please try again. <a href="http://demo.phpgang.com/login-signup-in-php/#forget">Forget Password?</a>';
    }
}
else
{
    header("location: /login.php");
}

?>

<script>
function mypasswordmatch()
{
    var pass1 = $("#password").val();
    var pass2 = $("#password2").val();
    if (pass1 != pass2)
    {
        alert("Passwords do not match");
        return false;
    }
    else
    {
        $( "#reset" ).submit();
    }
}
</script>



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
			
            <h3 class="head_login"> Reset Password</h3>
            <div class=" head_login">
               <div class="row form-row">
          
<form action="" method="post">

        <div class="form-group">
        	<label for="username">Enter your new password: </label>
            <input type="text" class="form-control" size="100" name="password" id="password" value="Enter password here" />
            <label for="username">Re-enter your new password: </label>
            <input type="text" class="form-control" size="100" name="password2" id="password2" value="Enter password here"  value="abrakadabra"/>
            
            
        </div>

       <button type="submit" class="btn btn-default" id="reset">Reset your password</button>

    </form>
    </div>
    </div>

</body>

</html>
