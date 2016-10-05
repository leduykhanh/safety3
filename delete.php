
<?php
include_once 'config.php';

if(isset($_GET['id']))
{
			$id= $_GET['id'];
		
		$sql = "DELETE FROM workactivity WHERE work_id=$id";
		
		if (mysqli_query($con, $sql)) 
		{
		  ?>
		  <script type="text/javascript">window.location.assign("listwork_activity.php?msg_delete")</script>
		  <?php
		} 
		
		else 
		{
			?>
			<script type="text/javascript">window.location.assign("listwork_activity.php?msg_error")</script>
			<?php
		
		}
}
?>

<?php
if(isset($_GET['hazardid']))
{
		$hid= $_GET['hazardid'];
		
		$sql = "DELETE FROM hazard WHERE hazard_id=$hid";
		
		if (mysqli_query($con, $sql)) 
		{
		  ?>
		  <script type="text/javascript">window.alert("Data deleted Sucessfully");</script>
		  <script type="text/javascript">window.location.assign("listwork_activity.php?msg_delete")</script>
		  <?php
		} 
		
		else 
		{
			?>
		  <script type="text/javascript">window.alert("Error in Deletion");</script>
		  <script type="text/javascript">window.location.assign("listwork_activity.php?msg_error")</script>
			<?php
		
		}
}
?>

<?php

if(isset($_GET['company_id']))
{
		$hid= $_GET['company_id'];
	
		$sql = "UPDATE company SET status=  '0' WHERE company_id =$hid";
		
		if (mysqli_query($con, $sql)) 
		{
		  ?>
		  <script type="text/javascript">window.alert("Data deleted Sucessfully");</script>
		  <script type="text/javascript">window.location.assign("managecompany.php?msg_delete")</script>
		  <?php
		} 
		
		else 
		{
			?>
		  <script type="text/javascript">window.alert("Error in Deletion");</script>
		  <script type="text/javascript">window.location.assign("managecompany.php?msg_error")</script>
			<?php
		
		}
}
?>



<?php

if(isset($_GET['company_id']))
{
		$cid= $_GET['company_id'];
	
		$sql ="UPDATE location SET status= '0' WHERE company_id =$cid";
		
		if (mysqli_query($con, $sql)) 
		{
		  ?>
		  <script type="text/javascript">window.alert("Data deleted Sucessfully");</script>
		  <script type="text/javascript">window.location.assign("managelocation.php?msg_delete")</script>
		  <?php
		} 
		
		else 
		{
			?>
		  <script type="text/javascript">window.alert("Error in Deletion");</script>
		  <script type="text/javascript">window.location.assign("managelocation.php?msg_error")</script>
			<?php
		
		}
}
?>



<?php

if(isset($_GET['location_id']))
{
		$lid= $_GET['location_id'];
	
		$sql = "UPDATE process SET status= '0' WHERE location_id =$lid";
		
		if (mysqli_query($con, $sql)) 
		{
		  ?>
		  <script type="text/javascript">window.alert("Data deleted Sucessfully");</script>
		  <script type="text/javascript">window.location.assign("manageprocess.php?msg_delete")</script>
		  <?php
		} 
		
		else 
		{
			?>
		  <script type="text/javascript">window.alert("Error in Deletion");</script>
		  <script type="text/javascript">window.location.assign("manageprocess.php?msg_error")</script>
			<?php
		
		}
}
?>