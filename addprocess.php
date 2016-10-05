 <?php
 include_once 'config.php';
 include_once 'header.php';
 if(isset($_POST['btn-default']))
{
	$compname= mysqli_real_escape_string($con,$_POST['company_name']);
	$lname= mysqli_real_escape_string($con,$_POST['location_name']);
	$name = mysqli_real_escape_string($con,$_POST['name']);
	$udesc = mysqli_real_escape_string($con,$_POST['description']);
	$status = mysqli_real_escape_string($con,$_POST['status']);
	
	$sql = "INSERT INTO process(company_id,location_id	,name,description,status) VALUES('$compname','$lname','$name','$udesc','$status')";
	if(mysqli_query($con,$sql))
{
	
	$msg_success= "Record added sucessfully";
	
}
	
	else
	{
		
		$msg_erorr= "Erorr in data insertion";
	
	?>
      <?php
	}
}

?>
  <script type="text/javascript">

// JavaScript Document

function validate()
{
 
   if( document.myForm.name.value == "" )
   {
     alert( "Please provide your process name!" );
     document.myForm.name.focus() ;
     return false;
   }
  
   if( document.myForm.description.value == "" )
   {
     alert( "Please provide some description!" );
     document.myForm.description.focus() ;
     return false;
   }
   
 return( true );
   }
  </script>

     <div class="container" style="border:2px solid black;">
      
           
            <h3>Add a New Process</h3>
             <?php if(isset($msg_success))
     {
    ?><h3 style="color:green;"><?php echo $msg_success;?> </h2>
    <?php
    }
    ?>
   <?php if(isset($msg_erorr))
    {
    ?><h3 style="color:red;"><?php echo $msg_erorr;?> </h2>
   <?php
    }
    ?>
            <hr class="add_risk" />
           <?php 
            if(isset($_GET['msg']))
						{
   						echo '<p>'.$_GET['msg'].'</p>'; //If message is set echo it
							}
			?>
              <form method="post" name="myForm" onSubmit="return validate();">
              
              
              
                   <div class="row form-row">
            <div class="col-sm-2"><label>Company Name:</label></div>
            <div class="col-sm-4">
           <select name="company_name" id="company_name" required >
                                <option value="">-----Select-----</option>
                                 <?php
                              $sql = "SELECT * FROM company";
                              $result = mysqli_query($con, $sql);

                    if (mysqli_num_rows($result) > 0) {
                 // output data of each row
               while($row = mysqli_fetch_assoc($result)) {
				   
				   ?><option value="<?php echo $row['company_id'];?>"><?php echo $row['name'];?></option><?php
                   }
				   }
				   ?>
                                </select>
            </div>
            </div>
            
            
              
              
              
            
            
             <div class="row form-row">
            <div class="col-sm-2"><label>Location Name:</label></div>
            <div class="col-sm-4">
           <select name="location_name" id="location_name" required >
                                <option value="">-----Select-----</option>
                                 <?php
                              $sql = "SELECT * FROM location";
                              $result = mysqli_query($con, $sql);

                    if (mysqli_num_rows($result) > 0) {
                 // output data of each row
               while($row = mysqli_fetch_assoc($result)) {
				   
				                   ?>
                   <option value="<?php echo $row['location_id'];?>"><?php echo $row['name'];?></option><?php
                   }
				   }
				   ?>
                                </select>
            </div>
            </div>
            
            <div class="row form-below">
            <div class="col-sm-2"><label>Name:</label></div>
            <div class="col-sm-4">
           <input class="span4" type="text" id="name" name="name"  required >
            </div>
            </div>

              <div class="row form-below">
            <div class="col-sm-2"><label>Description:</label></div>
            <div class="col-sm-4">
           <input class="span4" type="text" id="description" name="description"  required >
            </div>
            </div>
            
             <div class="row form-below">
            <div class="col-sm-2"><label>Status:</label></div>
            <div class="col-sm-4">
          <input type="radio" name="status" value="1" checked> Active<br>
          <input type="radio" name="status" value="0"> Non_Active<br>
            </div>
            </div>
            
            
            
               <div class="row form-below">
            <div class="col-sm-2"></div>
            <div class="col-sm-8">
            <div class=" col-sm-8 btn-right">
         	 <button type="submit"  name="btn-default"class="btn btn-default" >Add Process Here</button>
            </div>
            </div>
            </div>
            </form>
            
    </div>
    <?
	include 'footer.php';
	?>