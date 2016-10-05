<?php
//define the receiver of the email
$to = 'mrphpguru@gmail.com';
//define the subject of the email
$subject = 'new approval request for you'; 
//create a boundary string. It must be unique 
//so we use the MD5 algorithm to generate a random hash
$random_hash = md5(time()); 
//define the headers we want passed. Note that they are separated with \r\n
$headers = "From: webmaster@mrphpguru.com\r\nReply-To: webmaster@mrphpguru.com";
//add boundary string and mime type specification
$headers .= "\r\nContent-Type: multipart/alternative; boundary=\"PHP-alt-".$random_hash."\""; 
//define the body of the message.
ob_start(); //Turn on output buffering
?>



Hello <?php echo $staffName;?>! Please review risk assessment and approve it

To approve risk assessment please use following credentials. 

Site link : http://demo.mrphpguru.com/riskmanagement

User name : <?php echo $_POST['staffEnail'][$j];?>

password: riskassessment

Check the link below to see particular riskassessment

http://demo.mrphpguru.com/riskmanagement?useremail=<?php echo $_POST['staffEnail'][$j];?>


Thanks
Admin




<?
//copy current buffer contents into $message variable and delete current output buffer
$message = ob_get_clean();
//send the email
$mail_sent = @mail( $to, $subject, $message, $headers );
//if the message is sent successfully print "Mail sent". Otherwise print "Mail failed" 
echo $mail_sent ? "Mail sent" : "Mail failed";
?>