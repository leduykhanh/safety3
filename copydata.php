<?php
 include_once 'config.php';
 ?>
 
 <?php
 if(isset($_GET['riskid']))
 {
        
	 
	    $sqlRiskcopy = "SELECT * FROM riskassessment where id = $_GET[riskid]";
        $resultlRiskcopy = mysqli_query($con, $sqlRiskcopy);
        $riskcopy = mysqli_fetch_assoc($resultlRiskcopy);
 }
  else
 {
	die( 'Not able to copy please try again' );
 }
 ?>
 <?php
     $today = date('Y-m-d H:i:s');
     $afterthreeYears = date('Y-m-d H:i:s', strtotime('+3 years'));  
     $riskdata= $riskcopy["createdBy"];
	 $riskdataone= $riskcopy["location"];
	 $riskdatatwo= $riskcopy["process"];
	 $riskdatathree= $riskcopy["createdDate"];
	 $riskdatafour= $riskcopy["approveDate"];
	 $riskdatafive= $riskcopy["revisionDate"];
	 $riskdatasix= $riskcopy["approveBy"];
	 $riskdataseven= $riskcopy["approverEmail"];
	 $riskdataeight= $riskcopy["status"];
 ?>
 <?php echo $sql_risk; ?>
 
 <?php
 $sql_risk = "INSERT INTO riskassessment       (createdBy,location,process,createdDate,approveDate,revisionDate,approveBy,approverEmail,status)
VALUES ('$riskdata', '$riskdataone', '$riskdatatwo', '$today', '0', '$afterthreeYears', '$riskdatasix', '$riskdataseven', '0')";
 $insert_copyrecord=mysqli_query($con, $sql_risk);
 $last_id = mysqli_insert_id($con);
 //signing insert Signing against 
 
if(isset($_GET['riskid']))
{
	    $sqlSigning = "SELECT * FROM signing where riskid = $_GET[riskid]";
        $resultSigning = mysqli_query($con, $sqlSigning);
		$numSigning= mysqli_num_rows($resultSigning);
		
		if($numSigning>0)
    	{
        	while ($riskSigning = mysqli_fetch_assoc($resultSigning))
			{
 
  				$sql_ramember = "INSERT INTO `signing` (`id`, `riskid`, `name`, `designation`, `email`, `signature`) VALUES (NULL, '".$last_id."', '".$riskSigning['name']."', '".$riskSigning['designation']."', '".$riskSigning['`email']."', '".$riskSigning['signature']."')";
			 	$insert_ramember=mysqli_query($con, $sql_ramember);
			}
		}
 }
 
 ?>
 
 
  <?php
 if(isset($_GET['riskid']))
 {
	    $sqlRamember = "SELECT * FROM ramember where riskid = $_GET[riskid]";
        $resultRamember = mysqli_query($con, $sqlRamember);
		$num_row= mysqli_num_rows($resultRamember);
    
	
	 if($num_row>0)
    {
        while ($riskRamember = mysqli_fetch_assoc($resultRamember))
		{
			 $sql_ramember = "INSERT INTO ramember (riskid,name,stauts) VALUES('".$last_id."', '".$riskRamember['name']."', '0')";
			 $insert_ramember=mysqli_query($con, $sql_ramember);
     
        }
    }
 }
 
 if(isset($_GET['riskid']))
 {
	    $sqlworkactivity = "SELECT * FROM workactivity where riskId = $_GET[riskid]";
        $resultworkactivity = mysqli_query($con, $sqlworkactivity);
	
		
		$num_row_one= mysqli_num_rows($resultworkactivity);
		 if($num_row_one>0)
			{
				while ($riskworkactivity = mysqli_fetch_assoc($resultworkactivity))
				{
				 	
					
				 $sql_workactivity = "INSERT INTO workactivity (riskId,name,created_by,created_on,status) VALUES( '".$last_id."','".$riskworkactivity['name']."', '".$riskworkactivity['created_by']."','".$today."', '0')";
					 
					 
					 
					 
					 $insert_workactivity=mysqli_query($con, $sql_workactivity);
					
					 
					 $newWorkId = mysqli_insert_id($con);
					 
					 
					 	//now need to create hazard in workactivity
						
						
							//get all hazards 
							
							$hazardsSql = "SELECT * FROM  `hazard` WHERE  `work_id` =".$riskworkactivity['work_id']."";
							
							 $resulHazards = mysqli_query($con, $hazardsSql);
							 $numHazards= mysqli_num_rows($resulHazards);
		 					if($numHazards>0)
							{
									while ($valueHazards  = mysqli_fetch_assoc($resulHazards))
									{
						
										$sql_hazards = "INSERT INTO `hazard` (`hazard_id`, `work_id`, `name`, `security`, `securitysecond`, `accident`, `likehood`, `likehoodsecond`, `risk_control`, `risk_label`, `risk_additional`, `action_officer`, `action_date`, `status`) VALUES (NULL, '".$newWorkId."', '".$valueHazards['name']."', '".$valueHazards['security']."', '".$valueHazards['securitysecond']."', '".$valueHazards['accident']."', '".$valueHazards['likehood']."', '".$valueHazards['likehoodsecond']."', '".$valueHazards['risk_control']."', '".$valueHazards['risk_label']."', '".$valueHazards['risk_additional']."', '".$valueHazards['action_officer']."', '".$valueHazards['action_date']."', '0')";
					 					$insert_hazards=mysqli_query($con, $sql_hazards);
					 					$newHazardsId = mysqli_insert_id($con);
										
										
										//get all action officer
										
										$actionofficerSql = "SELECT * FROM  `actionofficer` WHERE  `hazardid` =".$valueHazards['hazard_id']."";
										$resulActionofficer = mysqli_query($con, $actionofficerSql);
										$numActionofficer= mysqli_num_rows($resulActionofficer);
										if($numActionofficer>0)
										{
												while ($valueActionofficer  = mysqli_fetch_assoc($resulActionofficer))
												{
													 $sql_Actionofficer = "INSERT INTO actionofficer (hazardid,name) VALUES( '".$newHazardsId."','".$valueActionofficer['name']."')";
													 $insert_Actionofficer = mysqli_query($con, $sql_Actionofficer);
													 
													 $newActionofficerId = mysqli_insert_id($con);
													
												}
										}
										
										
										
										
										
									}
								}
					 
				}
			}
		
            
			 
           
 }

 ?>
  <script type="text/javascript">window.location.assign("listwork_activity.php?id=<?php echo $last_id;?>&status=0&copydata=Data Copied successfully")</script>
