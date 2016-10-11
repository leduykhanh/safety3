<?php
session_start();
include_once 'config.php';
 //print_r($_SESSION);
 if(isset($_SESSION['adminid'])=='')
 {
 	?>
 	<script type="text/javascript">window.location.assign('index.php');</script>
 <?php
 }
include_once 'constant.php';
?>
<!DOCTYPE html>

<html>
<head>



    <meta charset="utf-8">
    <title>Inventory of Work Activities</title>

      </head>
      <style type="text/css">

	  .printbreak {
       page-break-before: always;
       }


    table, tr, td {
    border: 1px solid black;
    border-collapse: collapse;
     vertical-align: text-top;

    }
   #risk_register tr td {
    padding: 8px;

    }
table .heading
{


  text-align: left;
  background-color: #868080;
  color:white;
  font-size: 24px;


}

.no_border tr td

{
border-left: 0px;
    border-right: 0px;
}

th
{
    border:1px solid black;
}
td p{
    border: 1px solid;
    border-left: 0px;
    border-right: 0px;
    margin-top: 0px;
    margin-bottom: 0px;
    margin-left: -2px;
    margin-right: -2px;
    border-bottom: none;
    padding-left: 10px;
}
</style>

<body>
    <div class="container">


<?php
 // risk assessment details
        $sqlRisk = "SELECT * FROM riskassessment where id = $_GET[riskid]";
        $resultlRisk = mysqli_query($con, $sqlRisk);
        $riskRowCount= mysqli_num_rows($resultlRisk);
        $risk = mysqli_fetch_assoc($resultlRisk);

        $getAllWorkSql = "SELECT * FROM `workactivity` WHERE `riskId` = ".$_GET['riskid']." ORDER BY  `work_id` ASC ";
        $resultAllWork=mysqli_query($con, $getAllWorkSql);
        $totalWorkActivity = mysqli_num_rows($resultAllWork);

        $valueAllWork = mysqli_fetch_assoc($resultAllWork);

		//get user details
		$getAllUserSql = "SELECT * FROM `staff_login` WHERE `id` = ".$risk['createdBy']."";
        $resultAlluser=mysqli_query($con, $getAllUserSql);
       // $totalWorkActivity = mysqli_num_rows($resultAlluser);

        $valueAllUser = mysqli_fetch_assoc($resultAlluser);


?>



 <div id="risk_register" style="width:100%;margin-top:40px">
    <h1>Inventory of Work Activities</h1>
    <table id="risk_register_2" style="width:100%;">
        <tr >
                    <td rowspan="1" colspan="4" style="width:75%"><b>Department:Armada Aluminum Renovation Construction Pte Ltd</b></td>
                    <td rowspan="1" colspan="1" style="width:25%"><b>Date <?php echo $date = date('d-m-Y', strtotime($risk['createdDate']));?></b></td>
        </tr>
         <tr style="background-color:#817F88; color:white;">
                     <td rowspan="1" style="width:5%"><b>Ref</b></td>
                     <td rowspan="1" style="width:15%"><b>Location</b></td>
                     <td rowspan="1" style="width:20%"><b>Process</b></td>
                     <td rowspan="1" style="width:30%"><b>Work Activity</b></td>
                     <td rowspan="1" style="width:30%"><b>Remark</b></td>

                </tr>
        <tr>
                     <td rowspan="1" ><b>1</b></td>
                     <td rowspan="1" ><b><?php echo $risk['location'];?></b></td>
                     <td rowspan="1" ><b><?php echo wordwrap ($risk['process'], 15, "\n", 1);?></b></td>
                     <td rowspan="1" ><b><?php echo $valueAllWork['name'];?></b></td>
                     <td rowspan="1" ><b></b></td>

                </tr>
       <?php
       $risCount = 1;
       while($valueAllWork = mysqli_fetch_assoc($resultAllWork))
       {
        if($risCount == 1)
        {

       ?>


       <tr>
                     <td rowspan="1"><b><?php echo $risCount+1;?></b></td>
                     <td></td>
                     <td><b></b></td>
                     <td rowspan="1" ><b><?php echo $valueAllWork['name'];?></b></td>
                     <td rowspan="1" ><b></b></td>

        </tr>
        <?php
        $risCount++;
        }
        else
        {
        ?>
        <tr>
                     <td rowspan="1"><b><?php echo $risCount+1;?></b></td>
                    <td></td>
                    <td></td>

                     <td rowspan="1" ><b><?php echo $valueAllWork['name'];?></b></td>
                     <td rowspan="1" ><b></b></td>

        </tr>
    <?php
        $risCount++;
        }//else if ends
        }//while ends
    ?>
     <tr>
                     <td rowspan="1" ><b><?php echo $risCount+1;?></b></td>
                    </b></td>

                     <td colspan="2" ><b></b></td>
                     <td rowspan="1" ><b>Total:<?php echo $totalWorkActivity;?> Pages</b></td>
                     <td rowspan="1" ><b>Reference Number P-0<?php echo $risk['id']; echo $risk['id'];?></b></td>

                </tr>
    </table>

    <br />
    <strong>Note:</strong>
    <ol>


        <li>
            This form is to be completed before filling in the Risk Assessment Form.
        </li>
        <li>
            The contents of the Work Activity column in the Inventory of Work Activities Form is to be copied over to the Work Activity column in the Risk Assessment Form
        </li>
    </ol>
 </div>

<div id="risk_register" style="width:100%;" class="printbreak">
     <h1>Risk Assessment Form </h1>

        <?php
         $today = date('d-m-Y');

        //get all the ra leader from signe table for the risk assesment

        $sqlSigning = "SELECT * FROM signing where riskid = $_GET[riskid]";
        $resultlSigning = mysqli_query($con, $sqlSigning);
        $signingRowCount= mysqli_num_rows($resultlSigning);
        ?>



            <table id="risk_register_2" style="width:100%;">
            <?php
            $signee = mysqli_fetch_assoc($resultlSigning);
            $sqlRAMember = "SELECT * FROM  `ramember` WHERE  `riskid` = $_GET[riskid]";
            $resultlRAMember = mysqli_query($con, $sqlRAMember);
            $RAMemberRowCount= mysqli_num_rows($resultlRAMember);
            ?>
            <tr >
                    <td rowspan="1" colspan="1" style="width:15%;vertical-align: middle;">Department:</td>
                    <td rowspan="1" colspan="1" style="width:20%;vertical-align: middle;">Armada Aluminum Renovation Construction Pte Ltd</td>
                    <td rowspan="1" colspan="1" style="width:25%;vertical-align: middle;">RA Leader :<?php echo $valueAllUser['name'];?> <?php echo '<img width="80" src="staff/'.$valueAllUser["signature"].'"/>'; ?></td>
                    <td rowspan="3" colspan="1" style="width:15%;vertical-align: middle;">Approved by:Signature:</td>
                    <td rowspan="3" colspan="1" style="width:15%;vertical-align: middle;">
                    <?php if($risk['status'] ==2)
                        {
							echo '<img width="120" src="staff/'.$signee["signature"].'"/>';
						}
						?>
                     </td>
                    <td rowspan="6" colspan="1" style="width:10%;vertical-align: middle;">Reference Number<h1>P-0<?php echo $risk['id'];?></h1></td>

                </tr>
                 <tr>
                     <td rowspan="1" colspan="1" style="width:15%">Process:</td>
                     <td rowspan="1" colspan="1" style="width:20%"><?php echo wordwrap ($risk['process'], 15, "\n", 1);?></td>
                     <td rowspan="1" colspan="1" style="width:25%">RA Member 1: <?php $raMember = mysqli_fetch_assoc($resultlRAMember); echo $raMembers[$raMember['name']];?></td>
                </tr>
                <tr>
                     <td rowspan="1" colspan="1"style="width:15%">Process / Activity Location:</td>
                     <td rowspan="1" colspan="1" style="width:20%" ><?php echo $risk['location'];?></td>
                     <td rowspan="1" colspan="1" style="width:25%">RA Member 2: <?php $raMember = mysqli_fetch_assoc($resultlRAMember); echo $raMembers[$raMember['name']];?></td>
                </tr>

                <tr>
                     <td rowspan="1" colspan="1" style="width:15%">Original Assessment Date:</td>
                     <td rowspan="1" colspan="1" style="width:20%"><?php echo $date = date('d-m-Y', strtotime($risk['createdDate']));?></td>
                     <td rowspan="1" colspan="1" style="width:25%">RA Member 3:<?php $raMember = mysqli_fetch_assoc($resultlRAMember); echo $raMembers[$raMember['name']];?></td>
                     <td rowspan="1" colspan="1" style="width:15%">Name:</td>
                     <td rowspan="1" colspan="1" style="width:15%"><?php if($risk['status'] ==2){ echo $signee['name'];}?></td>
                </tr>

                <tr>
                     <td rowspan="1" colspan="1" style="width:15%">Last Review Date:</td>
                     <td rowspan="1" colspan="1" style="width:20%"><?php if($risk['approveDate'] !='0000-00-00 00:00:00')
                        {
							echo $date = date('d-m-Y', strtotime($risk['approveDate']));
						}
						?></td>
                     <td rowspan="1" colspan="1" style="width:25%">RA Member 4:<?php $raMember = mysqli_fetch_assoc($resultlRAMember); echo $raMember['name'];?></td>
                     <td rowspan="1" colspan="1" style="width:15%">Designation:</td>
                     <td rowspan="1" colspan="1" style="width:15%">

                     <?php if($risk['status'] ==2)
                        {
                            echo $signee['designation'];
                        }
                        ?></td>
                </tr>

                 <tr>
                     <td rowspan="1" colspan="1" style="width:15%" >Next Review Date:</td>
                     <td rowspan="1" colspan="1" style="width:20%">
					 <?php

					 if($risk['approveDate'] !='0000-00-00 00:00:00')
                        {
                          echo $date = date('d-m-Y', strtotime('+3 years', strtotime($risk['approveDate'])));

                        }
                        else if($risk['createdDate'] != '0000-00-00 00:00:00')
                        {
							echo $date = date('d-m-Y', strtotime('+3 years', strtotime($risk['createdDate'])));
						}
						else
						{
							echo '';
						}


					 ?>




                     </td>
                     <td rowspan="1" colspan="1" style="width:25%">RA Member 5:<?php $raMember = mysqli_fetch_assoc($resultlRAMember); echo $raMember['name'];?></td>
                     <td rowspan="1" colspan="1" style="width:15%">Date:</td>
                     <td rowspan="1" colspan="1" style="width:15%"><?php echo $today;?></td>
                </tr>




                </table>


                <table style="width:100%;">

                <tr style="background-color:#817F88; color:white;">
                     <td rowspan="1" colspan="3"><b>Hazard Identification</b></td>
                     <td rowspan="1" colspan="5"><b>Risk Evaluation</b></td>
                     <td rowspan="1" colspan="7"><b>Risk Control</b></td>

                </tr>


                <tr style="background-color:#817F88; color:white;">
                     <td rowspan="1" colspan="1"><b>Ref</b></td>
                     <td rowspan="1" colspan="1"><b>Work Activity</b></td>
                     <td rowspan="1" colspan="1"><b>Hazard</b></td>
                     <td rowspan="1" colspan="1"><b>Possible Injury / III-health</b></td>
                     <td rowspan="1" colspan="1"><b>Existing Risk Controls</b></td>
                     <td rowspan="1" colspan="1"><b>S</b></td>
                     <td rowspan="1" colspan="1"><b>L</b></td>
                     <td rowspan="1" colspan="1"><b>RPN</b></td>
                     <td rowspan="1" colspan="1"><b>Additional Controls</b></td>
                    <td rowspan="1" colspan="1"><b>S</b></td>
                     <td rowspan="1" colspan="1"><b>L</b></td>
                     <td rowspan="1" colspan="1"><b>RPN</b></td>

                     <td rowspan="1" colspan="1"><b>Implementation Person</b></td>
                     <td rowspan="1" colspan="1"><b>Due Date</b></td>
                     <td rowspan="1" colspan="1"><b>Remarks</b></td>

                </tr>
            <?php
                //get total work activity

                 $getAllWorkSql = "SELECT * FROM `workactivity` WHERE `riskId` = ".$_GET['riskid']." ORDER BY  `work_id` ASC ";
                 $resultAllWork=mysqli_query($con, $getAllWorkSql);
                 $totalWorkActivity = mysqli_num_rows($resultAllWork);
               $riskids = 1;
                $m=0;
				while($valueAllWork = mysqli_fetch_assoc($resultAllWork))
                {
                    $m++;
					//number of hazards in workactivity
                  $getAllHazardsSql = "SELECT * FROM `hazard` WHERE `work_id` = ".$valueAllWork['work_id']." ORDER BY `hazard_id` ASC";
                 $resultAllHazards=mysqli_query($con, $getAllHazardsSql);
                 $totalHazards = mysqli_num_rows($resultAllHazards);

                    $hazrdsControl = 1;
                    while($hzardsValue = mysqli_fetch_assoc($resultAllHazards))

                    {

                        if($hazrdsControl == 1)
                        {


                ?>
                                <tr>
                                    <td rowspan="<?php echo $totalHazards;?>" colspan="1"> <?php echo $m; ?></td>
                                    <td rowspan="<?php echo $totalHazards;?>" colspan="1">  <?php echo $valueAllWork['name'];?></td>
                                    <td rowspan="1" colspan="1"> <?php echo $harzard[$hzardsValue['name']];?></td>


                                    <td rowspan="1" colspan="1" style="text-align: justify;"> <?php echo $injury[$hzardsValue['accident']];?> </td>

                                    <td rowspan="1" colspan="1" style="text-align: justify;">

									<?php
									$existing_risk = unserialize($hzardsValue['risk_control']);
									if($existing_risk != "")
									{
										foreach($existing_risk as  $existing_risk_key => $existing_risk_value)
										{
											if(substr($existing_risk_key, 0, 3) === "c_t")
											{
												echo "<strong>".$existing_risk[$existing_risk_key]."</strong> <br>";
											}
											else{
												echo $existing_risk_control[$hzardsValue['name']][$existing_risk_value] ."<br>";
											}
										}
									}


									//echo wordwrap ($hzardsValue['risk_control'], 15, "\n", 1);?> </td>
                                    <td rowspan="1" colspan="1"> <?php echo $hzardsValue['security'];?></td>
                                    <td rowspan="1" colspan="1"> <?php echo $hzardsValue['likehood'];?> </td>

                                      <?php
									if($hzardsValue['likehood']=="-"|| $hzardsValue['security']=="-")
									{
										$RPN_TWO="-";
									}
									else
									{
										$RPN_TWO=$hzardsValue['security'] * $hzardsValue['likehood'];
									}
									?>

                                   <td rowspan="1" colspan="1"><?php echo $RPN_TWO;?>
                                     </td>


                                    <td rowspan="1" colspan="1"> <?php echo $hzardsValue['risk_additional'];?> </td>

                                    <?php
									if($hzardsValue['risk_additional']=="")
									{
										$securitysecond="-";
										$likehoodsecond="-";
										$RPN="-";
									}
									else
									{
										$securitysecond= $hzardsValue['securitysecond'];
										$likehoodsecond= $hzardsValue['likehoodsecond'];
										$RPN=$hzardsValue['securitysecond'] * $hzardsValue['likehoodsecond'];
									}
									?>

                                     <td rowspan="1" colspan="1"><?php echo $securitysecond;?></td>

                                     <td rowspan="1" colspan="1"><?php echo $likehoodsecond;?></td>





                                    <td rowspan="1" colspan="1"><?php echo $RPN;?>
                                     </td>

                                   <td rowspan="1" colspan="1"> <?php

                                         $getAllActtionOfficerSql = "SELECT * FROM `actionofficer` WHERE `hazardid` = ".$hzardsValue['hazard_id']."";
                                              $resultActtionOfficer = mysqli_query($con, $getAllActtionOfficerSql);


                                              while($valueAllActionOfficer = mysqli_fetch_assoc($resultActtionOfficer))
                                              {
                                                echo "<div>$valueAllActionOfficer[name]</div>";
                                              }



                                      ?> </td>

                                       <?php
									if($hzardsValue['risk_additional']=="")
									{
										$action_date="-";
									}
									else
									{
										$action_date= date('d-m-Y', strtotime($hzardsValue['action_date']));
									}
									?>



                                    <td rowspan="1" colspan="1"> <?php echo $action_date ;?> </td>
                                    <td rowspan="1" colspan="1"> - </td>
                                 </tr>
                <?php
                            }
                            else
                            {
                                ?>
                                    <tr>
                                      <td rowspan="1" colspan="1"> <?php echo $harzard[$hzardsValue['name']];?> </td>
                                      <td rowspan="1" colspan="1"> <?php echo $injury[$hzardsValue['accident']];?> </td>
                                      <td rowspan="1" colspan="1"> <?php $existing_risk = unserialize($hzardsValue['risk_control']);
										if($existing_risk != "")
										{
											foreach($existing_risk as  $existing_risk_key => $existing_risk_value)
											{

												if(substr($existing_risk_key, 0, 3) === "c_t")
											{
												echo "<strong>".$existing_risk[$existing_risk_key]."</strong> <br>";
											}
												else{
													echo $existing_risk_control[$hzardsValue['name']][$existing_risk_value] ."<br>";
												}
											}
										}
									?> </td>
                                      <td rowspan="1" colspan="1"> <?php echo $hzardsValue['security'];?></td>
                                      <td rowspan="1" colspan="1"> <?php echo $hzardsValue['likehood'];?> </td>
                                      <td rowspan="1" colspan="1"><?php echo $hzardsValue['security'] * $hzardsValue['likehood'];?>
                                     </td>
                                      <td rowspan="1" colspan="1"> <?php echo $hzardsValue['risk_additional'];?> </td>
                                        <?php
									if($hzardsValue['risk_additional']=="")
									{
										$securitysecond="-";
										$likehoodsecond="-";
										$RPN="-";
									}
									else
									{
										$securitysecond= $hzardsValue['securitysecond'];
										$likehoodsecond= $hzardsValue['likehoodsecond'];
										$RPN=$hzardsValue['securitysecond'] * $hzardsValue['likehoodsecond'];
									}
									?>


                                  <td rowspan="1" colspan="1"><?php echo $securitysecond;?></td>

                                     <td rowspan="1" colspan="1"><?php echo $likehoodsecond;?></td>

                                      <td rowspan="1" colspan="1"><?php echo $RPN;?>
                                     </td>

                                      <td rowspan="1" colspan="1"> <?php

                                         $getAllActtionOfficerSql = "SELECT * FROM `actionofficer` WHERE `hazardid` = ".$hzardsValue['hazard_id']."";
                                              $resultActtionOfficer = mysqli_query($con, $getAllActtionOfficerSql);


                                              while($valueAllActionOfficer = mysqli_fetch_assoc($resultActtionOfficer))
                                              {
                                                echo "<div>$valueAllActionOfficer[name]</div>";
                                              }



                                      ?> </td>
                                         <?php
									if($hzardsValue['risk_additional']=="")
									{
										$action_date="-";
									}
									else
									{
										$action_date= date('d-m-Y', strtotime($hzardsValue['action_date']));
									}
									?>



                                    <td rowspan="1" colspan="1"> <?php echo $action_date ;?> </td>
                                      <td rowspan="1" colspan="1"> - </td>
                                  </tr>
                                <?php
                            }
                            $hazrdsControl++;
                        }//hazards while contols


			   }//end of while  workactivity
                 ?>

            </table>

    </div>
<br>
<strong>Notes:</strong>
 <div id="risk_register" style="width:60%;margin-top:40px" class="printbreak">
 <h1>Risk Matrix </h1>
<table id="risk_register_2" style="width:100%;">
                <tr >
                    <td>Likelihood<br> Severity</td>
                    <td>Rare <br>(1)</td>
                    <td>Remote <br>(2)</td>
                    <td>Occasional<br>(3)</td>
                    <td>Frequent<br> (4) </td>
                     <td>Almost<br>  Certain(5) </td>


                </tr>
                 <tr >
                    <td>Catastrophic (5)</td>
                    <td>5</td>
                    <td>10</td>
                    <td>15</td>
                    <td>20</td>
                     <td>25</td>


                </tr>
                 <tr>
                    <td>Major (4)</td>
                    <td>4</td>
                    <td>8</td>
                    <td>12</td>
                    <td>16</td>
                     <td>20</td>
                </tr>

                 <tr>
                    <td>Moderate (3)</td>
                    <td>4</td>
                    <td>8</td>
                    <td>12</td>
                    <td>16</td>
                     <td>20</td>
                </tr>
                 <tr>
                    <td>Minor (2)</td>
                    <td>3</td>
                    <td>6</td>
                    <td>9</td>
                    <td>12</td>
                     <td>15</td>
                </tr>
                 <tr>
                    <td>Negligible (1)</td>
                    <td>2</td>
                    <td>4</td>
                    <td>6</td>
                    <td>8</td>
                     <td>10</td>
                </tr>
                </table>
</div>

 <div id="risk_register" style="width:80%;margin-top:40px">
<table id="risk_register_2" style="width:100%;">
                <tr >
                    <td>Level</td>
                    <td>Severity</td>
                    <td>Description</td>



                </tr>
                 <tr >
                    <td>5</td>
                    <td>Catastrophic</td>
                    <td>Fatality, fatal diseases or multiple major injuries</td>



                </tr>
                 <tr>
                    <td>4</td>
                    <td>Major</td>
                    <td>Serious injuries or life-threatening occupational disease (include amputations, major fractures, multiple injuries, occupational cancer, acute poisoning)</td>

                </tr>

                 <tr>
                    <td>3</td>
                    <td>Moderate </td>
                    <td>Injury requiring medical treatment or ill-health leading to disability (includes lacerations, burns, sprains, minor fractures, dermatitis, deafness, work-related upper limb disorders)</td>

                </tr>
                 <tr>
                    <td>2</td>
                    <td>Minor</td>
                    <td>Injury or ill-health requiring first-aid only ( includes minor cuts and bruises, irritation, ill-health with temporary discomfort).</td>

                </tr>
                 <tr>
                    <td>1</td>
                    <td>Negligible</td>
                    <td>Not likely to cause injury or ill-health</td>

                </tr>
                </table>
</div>


 <div id="risk_register" style="width:80%;margin-top:40px">
 <table id="risk_register_2" style="width:100%;">
                <tr >
                    <td>Level</td>
                    <td>Likelihood</td>
                    <td>Description</td>



                </tr>
                 <tr >
                    <td>1</td>
                    <td>Rare</td>
                    <td>Not expected to occur but still possible</td>



                </tr>
                 <tr>
                    <td>2</td>
                    <td>Remote</td>
                    <td>Not likely to occur under normal circumstances</td>

                </tr>

                 <tr>
                    <td>3</td>
                    <td>Occasional</td>
                    <td>Possible or known to occur</td>

                </tr>
                 <tr>
                    <td>4</td>
                    <td>Frequent</td>
                    <td>Common occurrence</td>

                </tr>
                 <tr>
                    <td>5</td>
                    <td>Almost Certain</td>
                    <td>Continual or repeating experience</td>

                </tr>
                </table>
</div>

<div id="risk_register" style="width:80%;margin-top:40px" class="printbreak">

<h1>Risk Evaluation</h1>
 <table id="risk_register_2" style="width:100%;">
                <tr >
                    <td>Risk Level</td>
                    <td>Risk Acceptability</td>
                    <td style="text-align:center">Recommended Actions</td>



                </tr>
                 <tr >
                    <td>Low Risk</td>
                    <td>Acceptable</td>
                    <td><ul><li>No additional risk control measures may be needed</li><li>Frequent review and monitoring of hazards are required to ensure that the risk level assigned is accurate and does not increase  over time</li></ul></td>



                </tr>
                 <tr>
                    <td>Medium Risk</td>
                    <td>Tolerable</td>
                    <td><ul><li>A careful evaluation of the hazards should be carried out to ensure that the risk level is reduced to as low as reasonably practicable (ALARP) within a defined time period.</li><li>Interim risk control measures, such as administrative controls or PPE, may be implemented while longer term measures are being established.</li><li>Management attention is required.</li></ul></td>

                </tr>

                 <tr>
                    <td>High Risk</td>
                    <td>Not acceptable</td>
                    <td><ul><li>High Risk level must be reduced to at least Medium Risk before work commences.</li><li>There should not be any interim risk control measures. Risk control measures should not be overly dependent on PPE or appliances</li><li>If applicable, the hazard should be eliminated before work commences.</li><li>Management review is required before work commences.</li></ul></td>


                </table>
         </div>
       <div style="margin: 0 auto; width: 656px; text-align: center;"><button onClick="window.print()">Save as PDF</button></div>
 </div>


    </body>
    </html>
