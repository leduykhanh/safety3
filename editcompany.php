 <?php include_once 'config.php';
  include_once 'header.php';
  if(!$_GET['company_id'])
  {
	header("location:managecompany.php");  
  }
	  if(isset($_GET['company_id']))
						{
							
					//echo $_GET['id'];					
						
						}
				
				 $sel_user="SELECT * from company where company_id=' ". $_GET['company_id']. " '";
     $run_user=mysqli_query($con, $sel_user);
    // $check_user = mysqli_num_rows($run_user);
    //$Rec=mysql_fetch_array($Res);
   while($data=mysqli_fetch_array($run_user))
   {
  ?>
  <?php
   if(isset($_POST['btn-default']))
    {
	$name = mysqli_real_escape_string($con,$_POST['name']);
	$desc = mysqli_real_escape_string($con,$_POST['description']);
	
	$sql = "UPDATE company SET description='$desc',name='$name' WHERE company_id=' ". $_GET['company_id']. " '";

if (mysqli_query($con, $sql)) {
    echo "Record updated successfully";
} else {
    echo "Error updating record: " . mysqli_error($con);
}
	}
mysqli_close($con);

?>

     <div class="container" style="border:2px solid black;">
      
           
            <h3>Add a New Company</h3>
            <hr class="add_risk" />
         
              <form method="post" name="myForm" onSubmit="return validate();">
            <div class="row form-row">
            <div class="col-sm-2"><label>Name:</label></div>
            <div class="col-sm-4">
           <input class="span4" type="text" id="name" name="name" value="<?php echo  $data['name']; ?>"  required / >
            </div>
            </div>

              <div class="row form-below">
            <div class="col-sm-2"><label>Description:</label></div>
            <div class="col-sm-4">
           <input class="span4" type="text" id="description" name="description" value="<?php echo  $data['description']; ?>"  required />
            </div>
            </div>
            
               <div class="row form-below">
            <div class="col-sm-2"></div>
            <div class="col-sm-8">
            <div class=" col-sm-8 btn-right">
         	 <button type="submit"  name="btn-default"class="btn btn-default" >Update Details</button>
               <?php
   }
   ?>
            </div>
            </div>
            </div>
            </form>
            
    </div>
    <?php
	include 'footer.php';
	?>