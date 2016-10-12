<?php include_once 'config.php';
session_start();
include_once 'header.php';
if(!$_SESSION['adminid'])
{
    ?><script type="text/javascript">window.location.assign("index.php")</script>
    <?php
}
include_once 'constant.php';
?>
  <style type="text/css">
    body { padding: 10px;}
    .clonedInput { border-radius: 5px; background-color: #def;}




    .red
    {
      color: red;
      font-size: 17px;
      font-weight: bolder;
    }
    .green
    {
      color: green;
      font-size: 17px;
      font-weight: bolder;
    }
    .yellow
    {
      color: yellow;
      font-size: 17px;
      font-weight: bolder;
    }
  .form-row{
	      margin-right: -15px;
    margin-left: -15px;
  }
  </style>
 <script src="workactivity.js"></script>




<?php
if(isset($_GET['riskid']) && $_GET['riskid'] != '')
{
  $getRiskAssesmentSQl = "SELECT * FROM  `riskassessment` WHERE id = ".$_GET['riskid']."";
  $resultAllRiskAssesment=mysqli_query($con, $getRiskAssesmentSQl);
  $valueRisk = mysqli_fetch_assoc($resultAllRiskAssesment);

  //print_r($valueRisk);

  //get user details

  $getUserSQl = "SELECT * FROM  `staff_login` WHERE id = ".$valueRisk['createdBy']."";
  $resultAllUser=mysqli_query($con, $getUserSQl);
  $valueUser = mysqli_fetch_assoc($resultAllUser);


  //get all work activity
  $getAllWorkSql = "SELECT * FROM `workactivity` WHERE `riskId` = ".$valueRisk['id']."";
  $resultAllWork=mysqli_query($con, $getAllWorkSql);


}
else
{

}
?>


<div class="container" style="border:2px solid black;">
<div style="border:1px solid #c0c0c0; padding:0 15px; float:left;">
<form method="post" action="riskmange.php?riskid=<?php echo $_GET['riskid'];?>" class="inlineForm" enctype="multipart/form-data">

    <?php
      $sqlRAMember = "SELECT * FROM  `ramember` WHERE  `riskid` =$_GET[riskid]";
      $resultRAMember=mysqli_query($con, $sqlRAMember);
      $numRAMamber =  mysqli_num_rows($resultRAMember);
      if($numRAMamber > 0)
      {

      }
      else
      {
        $numRAMamber = 1;
      }

    ?>
<input type="hidden" name="RA_MemberCount" id="RA_MemberCount" value="<?php echo $numRAMamber; ?>" />



      <div class="col-sm-12 form_pad">
                <h3>Add a New Risk Assessment</h3>
                <hr class="add_risk">

                <div class="row form-row">
                    <div class="col-sm-6">
                        <div class="row">
                          <label class="col-sm-4">RA Leader:</label>
                          <label class="col-sm-8"><?php echo $valueUser['name']; ?></label>
                        </div>
                    </div>
                </div>

                <div class="row form-row">
                          <div class="col-sm-6">
							<div class="row">
                            <label class="col-sm-4">Company:</label>
                            <label class="col-sm-8">Armada Aluminum Renovation Construction Pte Ltd</label>
                            </div>
                          </div>

                          <div class="col-sm-6">

                            <label class="col-sm-4">Reference No:</label>
                            <label class="col-sm-8">00<?php echo $valueRisk['id'];?></label>

                          </div>
                </div>


                <div class="row form-row">
                          <div class="col-sm-6">
<div class="row">
                            <label class="col-sm-4">Loaction:</label>
                            <label class="col-sm-8">
                              <input name="location" class="span4" type="text" id="inputSaving" placeholder="" required value="<?php echo $valueRisk['location'];?>"></label>
                              </div>
                          </div>

                          <div class="col-sm-6">

                            <label class="col-sm-4">Creation Date:</label>
                            <label class="col-sm-8">
                               <input name="creationDate" class="span4 date" type="text" id="creationDate" placeholder="" required value="<?php echo date('d-m-Y', strtotime($valueRisk['createdDate']));?>"></label>


                            </label>

                          </div>
                </div>


                <div class="row form-row">
                            <div class="col-sm-6">
                            <div class="row">
                              <label class="col-sm-4">Risk Process:</label>
                              <label class="col-sm-8">
                                <input name="process" class="span4" type="text" id="inputSaving" placeholder="" required value="<?php echo $valueRisk['process'];?>">
                              </label>
                              </div>
                            </div>
                            <div class="col-sm-6">
                              <label class="col-sm-4 compulsary">Expiry Date:</label>
                              <select  name="expiry_date">
                                <option value="1" <?php echo $valueRisk['expiry_date']==1?"selected":"";?>>1</option>
                                <option value="2" <?php echo $valueRisk['expiry_date']==2?"selected":"";?>>2</option>
                                <option value="3" <?php echo $valueRisk['expiry_date']==3?"selected":"";?>>3</option>
                              </select>
                              <span>year(s)</span>
                            </div>
                </div>
      </div>

<div class="row"><div class="col-sm-12"> <hr class="add_activity"></div></div>
   <button class="col-sm-2 btn btn-primary addMember" id="add_new_member" style="margin-bottom:10px">
        +Add RA Member</button>
              <?php

              if(mysqli_num_rows($resultRAMember) > 0)
              {


               while($valueRAMember = mysqli_fetch_assoc($resultRAMember))
               {
              ?>

                <div id="clonedInput1" class=" col-sm-12 form-row clonedInput repeatingMember">

                    <div class="col-sm-6">
                        <label class="col-sm-4">RA Members:</label>
                        <label class="col-sm-8">
                         <select name="RA_Member[]" class="span4 ra_members" id="inputSaving" required>
                            <option value="" <?php echo ($valueRAMember['name'] == "")?'selected="selected"' : ''; ?> >-- Select RA members --</option>
                            <option value="name1" <?php echo ($valueRAMember['name'] == "name1")?'selected="selected"' : ''; ?>>W. K. Chan</option>
                            <option value="name2" <?php echo ($valueRAMember['name'] == "name2")?'selected="selected"' : ''; ?>>Liang Kan Fat</option>
                        </select>
                        </label>
                    </div>
                     <button class="col-sm-1 btn btn-danger deleteMember">Remove</button>
              </div>
              <?php
              }

              }
              else
              {

                ?>
                   <div id="clonedInput1" class=" col-sm-12 form-row clonedInput repeatingMember">

                    <div class="col-sm-6">
                        <label class="col-sm-4">RA Members:</label>
                        <label class="col-sm-8">
                       <select name="RA_Member[]" class="span4 ra_members" id="inputSaving" required>
                            <option value="" >-- Select RA members --</option>
                            <option value="name1">W. K. Chan</option>
                            <option value="name2">Liang Kan Fat</option>
                        </select>
                        </label>
                    </div>
                        <button class="col-sm-1 btn btn-danger deleteMember">Remove</button>
                  </div>

                <?php
              }
              ?>
<div class="clearfix"></div>
<div class="row"><div class="col-sm-12"> <hr class="add_risk"></div></div>




<?php include_once('copyworkactivityedit.php');?>


 <input type="hidden" name="workactivityCount" id="workactivityCount" value="<?php echo $resultAllWork->num_rows; ?>" />

<?php
$wrk_act =1;
while($valueAllWork = mysqli_fetch_assoc($resultAllWork))
{
?>        <div id="clonedInput1" class="col-sm-12 form_pad clonedInput repeatingSection">
              <div class="col-sm-7"><h3 class="workActivityName">Work Activity <?php echo $wrk_act;?></h3></div>
                   <button class="col-sm-2 btn btn-success addWorkActivity" id="add_new_work" style="margin-top:15px;">+ Add a new work activity</button>

                   <input type="hidden" name="workactivity_a_id_1" id="workactivity_a_id_1" value="" />

                   <?php
                   //get all work activity
                    $getAllHazardsSql = "SELECT * FROM `hazard` WHERE `work_id` = ".$valueAllWork['work_id']."";
                    $resultAllHazards=mysqli_query($con, $getAllHazardsSql);
                    $numHazards = mysqli_num_rows($resultAllHazards);
                    if($numHazards > 0)
                    {
                      $numHazardsCount = $numHazards;
                    }
                    else
                    {
                      $numHazardsCount =  1;
                    }

                   ?>
                   <input type="hidden" name="hazardsCount[]" id="hazardsCount" value="<?php echo $numHazardsCount;?>" />
                   <input type="hidden"  id="work_activity_id" value="<?php echo $wrk_act; ?>" />

                  <button class="col-sm-2 btn btn-danger  deleteWorkActivity" style="margin-left:5px; margin-top:15px;">Remove work activity</button>

                    <div class="row">
                    <div class="col-sm-12">
                      <hr class="add_risk" />
                        <div class="row">
                        <div class="col-sm-12 form-row">
                        <div class="row">
                            <label class="col-sm-3" style="padding-left:29px;">Work Activity Name:</label>
                            <input class="col-sm-8" type="text" id="inputSaving" name="work_activity[]" value="<?php echo $valueAllWork['name'];?>" placeholder="" style="margin-left:9px;" required>
                        </div>
                        </div>
                        </div>

                       <div class="clearfix"></div>
                       <hr class="add_activity"/>

                    </div>
                    </div>
 <?php
$cntval = 1;
  while($valueAllHazards = mysqli_fetch_assoc($resultAllHazards))
  {
    $getAllHazardInjuryOthersSql = "SELECT * FROM `injury_hazard` WHERE `hazard_id` = ".$valueAllHazards['hazard_id']."";
    $resultAllHazardInjuryOthers=mysqli_query($con, $getAllHazardInjuryOthersSql);
  ?>

                  <div class="col-sm-12 hazardSection">
                  <div class="row">
                        <div class="col-sm-6">
                         <div class="row">
                            <label class="col-sm-6">Hazard:</label>
                            <select class="col-sm-6" name="Hazard[]"  onchange="get_injuery(this,this.value,'dynamic_data_control_injuery_<?php echo $wrk_act; ?>_<?php echo $cntval;?>',<?php echo $wrk_act; ?>,<?php echo $cntval ?>);">
                            	<option value="" >Choose Hazard</option>
                                <?php
								foreach($harzard as $harzard_key => $harzard_value)
								{
									$selected = ($harzard_key == $valueAllHazards['name'])? 'selected="selected"' : "";

									echo "<option value=\"".$harzard_key."\" ".$selected .">".$harzard_value."</option>";
								}
								?>


                            </select>
							 <div class="ajax_loader" style="display:none;position: absolute;right: 0;">
                                    <img src="ajax-loader.gif" />
                                </div>
                          </div>
                          <?php if ($valueAllHazards['name']=="other"){ ?>
                          <div class="form-row other_hazard" style="display:block">
                            <input style="width: 82%;float: left;margin: 0px 5px 5px 15px;"  type="text" class="with_textbox_value c_t_h_1" name="HazardOther[]" value="<?php echo $valueAllHazards['name_other']; ?>"/>
                          </div>
                          <?php } ?>

                          <div id="dynamic_data_control_injuery_<?php echo $wrk_act; ?>_<?php echo $cntval;?>">
                           <div class="row">
                            <label  class="col-sm-6">Possible Injury / Accident:</label>

                           <select class="col-sm-6" name="InjuryAccident[]"  onchange="servity_hood(this,this.value,<?php echo $wrk_act; ?>,<?php echo $cntval ?>);">
                            	<option value="">Choose InjuryAccident</option>
                                <?php
								if($valueAllHazards['accident'] != "" ){
								foreach($injury as $key_get_injuery => $value_get_injuery)
								{
									$selected_inj = ($key_get_injuery == $valueAllHazards['accident'])? 'selected="selected"' : "";

									echo "<option data-servity=\"".$severity[$key_get_injuery]."\" value=\"".$key_get_injuery."\" ".$selected_inj .">".$value_get_injuery."</option>";
								}
								}
								?>
                            </select>

                          </div>
                          <?php if(count($resultAllHazardInjuryOthers)>0){
                            // echo "<div class='col-sm-12' > Others </div>";
                            foreach ($resultAllHazardInjuryOthers as $v) {
                              echo '<input style="width: 82%;float: left;margin: 0px 5px 5px 0px;" type="text" name="InjuryAccidentOthers[]"   value="'.$v["injury"].'" >';
                              echo '<a style=" float:left;" href="javascript:void(0)" class="btn btn-danger c_t_j_'.$wrk_act.' remove_other_injury" data-id ="add_others_injury_'.$wrk_act.'_'.$wrk_act.'" data-remove="c_t_j_'.$wrk_act.'"> Remove</a>';
                            }
                          } ?>
                          <div class="row">
                            <div id="add_others_injury_<?php echo $wrk_act; ?>_<?php echo $wrk_act; ?>"></div>
                            <input type="hidden" name="hazardsOthersInjuryCount[]" id="hazardsOthersInjuryCount" value="1" />
                            <input type="button" class="col-sm-3 btn btn-primary add_others_injury" data-wrk ="<?php echo $wrk_act; ?>" data-haz ="<?php echo $wrk_act; ?>" value="Add others"  />
                          </div>

                         <div class="row">
                            <label class="col-sm-6">Existing Risk Control:</label>
                            <?php
                            if($valueAllHazards['name']!=="other"){
              							$e_r_c = $existing_risk_control[$valueAllHazards['name']];
              							$existing_riskcontroll = unserialize($valueAllHazards['risk_control']);

              							?>
                             <div class="col-sm-12">
                             <?php if($e_r_c != "") {	?>
                                   <div class="checkbox">
                                        <label><input type="checkbox" name="ExistingRiskControl[<?php echo $wrk_act; ?>][<?php echo $cntval ?>][]"  value="select_all" onclick="risk_control(this,'risk_control_<?php echo $wrk_act; ?>_<?php echo $cntval;?>');" <?php echo ($existing_riskcontroll != "") ?(in_array("select_all",$existing_riskcontroll)) ? 'checked="checked"' : "" : "" ?>>Select All</label>
                                    </div>
                                    <?php
              									 foreach($e_r_c as $key_get_e_r_c  => $value_get_e_r_c)
              									{
              										$selected = ($existing_riskcontroll != "") ?(in_array($key_get_e_r_c,$existing_riskcontroll)) ? 'checked="checked"' : "" : "";
              									echo  '<div class="checkbox">
                                                      <label><input type="checkbox" class="risk_control_'.$wrk_act.'_'.$cntval.'" name="ExistingRiskControl['.$wrk_act.']['.$cntval.'][]"  value="'.$key_get_e_r_c.'" '.$selected.' >'.$value_get_e_r_c.'</label>
                                                  </div>   ';
              										}
              									?>
                                                  <label style=" float: left;width: 100%;">If others, please specify</label><input style="width: 82%;float: left;margin: 0px 5px 5px 0px;" type="text" class="with_textbox_value" name="ExistingRiskControl[<?php echo $wrk_act; ?>][<?php echo $cntval ?>][c_t]" value="<?php echo $existing_riskcontroll["c_t"] ?>"/>
                                                  <?php } ?>
                                                  <div id="add_others_<?php echo $wrk_act; ?>_<?php echo $cntval ?>">
                                                  <?php
              									if($existing_riskcontroll != ""){
              									 foreach($existing_riskcontroll as $key_e_r_c  => $value_e_r_c)
              									{

              										if(substr($key_e_r_c, 0, 4) === "c_t_")
              										{
              										if($existing_riskcontroll[$key_e_r_c] != ""){
              										?>

                                                      <label class="<?php echo $key_e_r_c;?>"  style=" float: left;width: 100%;">If others, please specify</label><input style="width: 82%;float: left;margin: 0px 5px 5px 0px;" type="text" class="with_textbox_value <?php echo $key_e_r_c;?>" name="ExistingRiskControl[<?php echo $wrk_act; ?>][<?php echo $cntval ?>][<?php echo $key_e_r_c;?>]" value="<?php echo $existing_riskcontroll[$key_e_r_c] ?>"/> <a style=" float:left;" href="javascript:void(0)" data-id="add_others_<?php echo $wrk_act; ?>_<?php echo $cntval ?>" class="btn btn-danger <?php echo $key_e_r_c;?> remove_other_data" data-remove="<?php echo $key_e_r_c;?>"> Remove</a>
                                                      <br />
                                                <?php }
              									}
              								  }
              								}?>
                                                </div>
               <input type="button" class="col-sm-3 btn btn-primary add_others" data-wrk ="<?php echo $wrk_act; ?>" data-haz ="<?php echo $cntval ?>" value="Add others"  />
                                </div>
                              <?php }else{
                                echo '<textarea class="col-sm-6" value="" type="text" id="inputSaving" name="ExistingRiskControl['.$wrk_act.']['.$cntval.']" rows="5">'.$valueAllHazards['risk_control'].'</textarea>';
                              }?>

                          </div>
						  </div>

                          <div class="row" >
                            <label class="col-sm-6">Severity:</label>

                            <select class="severity col-sm-6 btn btn-default "  id="change_severity_<?php echo $wrk_act; ?>_<?php echo $cntval;?>" name="severity[]">
                              <option value="-">Select severity</option>
                              <option value="5" <?php if($valueAllHazards['security'] == '5') echo 'selected="selected"';?>>(5) Catastrophic</option>
                              <option value="4" <?php if($valueAllHazards['security'] == '4') echo 'selected="selected"';?>>(4) Major</option>
                              <option value="3" <?php if($valueAllHazards['security'] == '3') echo 'selected="selected"';?>>(3) Moderate</option>
                              <option value="2" <?php if($valueAllHazards['security'] == '2') echo 'selected="selected"';?>>(2) Minor</option>
                              <option value="1" <?php if($valueAllHazards['security'] == '1') echo 'selected="selected"';?>>(1) Negligible</option>
                            </select>


                          </div>

                          <div class="row" >
                            <label class="col-sm-6">Likelihood:</label>

                            <select class="likelihood col-sm-6 btn btn-default " id="change_likehood_<?php echo $wrk_act; ?>_<?php echo $cntval;?>" name="likelihood[]">
                              <option value="-">Select likelihood</option>
                              <option value="5" <?php if($valueAllHazards['likehood'] == '5') echo 'selected="selected"';?>>(5) Almost Certain</option>
                              <option value="4" <?php if($valueAllHazards['likehood'] == '4') echo 'selected="selected"';?>>(4) Frequent</option>
                              <option value="3" <?php if($valueAllHazards['likehood'] == '3') echo 'selected="selected"';?>>(3) Occasional</option>
                              <option value="2" <?php if($valueAllHazards['likehood'] == '2') echo 'selected="selected"';?>>(2) Remote</option>
                              <option value="1" <?php if($valueAllHazards['likehood'] == '1') echo 'selected="selected"';?>>(1) Rare</option>
                            </select>

                          </div>

                          <div class="row">
                            <label class="col-sm-6">Action Date:</label>

                             <?php
                            $time = strtotime($valueAllHazards['action_date']);

                            $yaer =  date('Y', $time);

                             $month = date('m', $time);

                            $day = date('d', $time);

                            ?>

                            <select class="col-sm-2 btn btn-default" id="inputSaving" name="actionDate[]">
                               <?php for ($i=1; $i < 32; $i++)
                              {
                                # code...
                                  if($day == $i)
                                  {
                                    $dSelcted = 'selected="selected"';
                                  }
                                  else
                                  {
                                    $dSelcted = '';
                                  }
                                ?>
                                  <option <?php echo $dSelcted;?> value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                <?php
                              }
                             ?>
                            </select>

                            <select class="col-sm-2 btn btn-default" id="inputSaving" name="actionMonth[]">
                              <?php for ($i=1; $i < 13; $i++)
                              {
                                # code...
                                if($month == $i)
                                  {
                                    $mSelcted = 'selected="selected"';
                                  }
                                  else
                                  {
                                    $mSelcted = '';
                                  }
                                ?>
                                  <option <?php echo $mSelcted;?> value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                <?php
                              }
                             ?>
                            </select>


                            <select class="col-sm-2 btn btn-default" id="inputSaving" name="actionYear[]">
                              <?php for ($i=2016; $i < 2025; $i++)
                              { if($yaer == $i)
                                  {
                                    $ySelcted = 'selected="selected"';
                                  }
                                  else
                                  {
                                    $ySelcted = '';
                                  }
                                # code...
                                ?>
                                  <option <?php echo $ySelcted;?> value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                <?php
                              }
                             ?>

                            </select>




                          </div>


						            </div>
                        <div class="col-sm-6">
                          <?php
                          $likelihood = $valueAllHazards['likehood'];
                          $severity = $valueAllHazards['security'];
                          $htmlRisk = '';
                          $riskValue = $likelihood * $severity;
                          if($riskValue > 0 && $riskValue < 4)
                           {
                              $htmlRisk = '<span class="green">Low Risk</span>';

                           }
                           else if($riskValue > 3 && $riskValue < 13)
                           {
                              $htmlRisk = '<span class="yellow">Medium Risk</span>';
                           }
                           else if($riskValue > 13 && $riskValue < 26)
                           {
                              $htmlRisk = '<span class="red">High Risk - Additional Risk Control is required below</span>';
                           }
                           else
                           {
                              $htmlRisk = '';
                           }

                          ?>




                          <div class="row">
                            <label class="col-sm-6">Risk Level:</label>
                            <label class="col-sm-6 riskLevel"><?php echo $htmlRisk; ?></label>
                          </div>

                          <div class="row">
                            <label class="col-sm-6">Additional Risk Control:</label>

                          <textarea  type="text" class="col-sm-6" id="inputSaving" name="additionalRiskContro[]" rows="5"><?php echo $valueAllHazards['risk_additional'];?></textarea>


                          </div>
                          <div class="clearfix"></div>

                          <div class="row">
                            <label class="col-sm-6">Severity:</label>

                            <select class="col-sm-6 severitysecond btn btn-default" id="inputSaving" name="severitySecond[]">
                              <option value="-">Select severity</option>
                              <option value="5" <?php if($valueAllHazards['securitysecond'] == '5') echo 'selected="selected"';?>>(5) Catastrophic</option>
                              <option value="4" <?php if($valueAllHazards['securitysecond'] == '4') echo 'selected="selected"';?>>(4) Major</option>
                              <option value="3" <?php if($valueAllHazards['securitysecond'] == '3') echo 'selected="selected"';?>>(3) Moderate</option>
                              <option value="2" <?php if($valueAllHazards['securitysecond'] == '2') echo 'selected="selected"';?>>(2) Minor</option>
                              <option value="1" <?php if($valueAllHazards['securitysecond'] == '1') echo 'selected="selected"';?>>(1) Negligible</option>
                            </select>


                          </div>

                          <div class="row">
                            <label class="col-sm-6">Likelihood:</label>

                            <select class="col-sm-6 likelihoodsecond btn btn-default" id="inputSaving" name="likelihoodSecond[]">
                              <option value="-">Select likelihood</option>
                              <option value="5" <?php if($valueAllHazards['likehoodsecond'] == '5') echo 'selected="selected"';?>>(5) Almost Certain</option>
                              <option value="4" <?php if($valueAllHazards['likehoodsecond'] == '4') echo 'selected="selected"';?>>(4) Frequent</option>
                              <option value="3" <?php if($valueAllHazards['likehoodsecond'] == '3') echo 'selected="selected"';?>>(3) Occasional</option>
                              <option value="2" <?php if($valueAllHazards['likehoodsecond'] == '2') echo 'selected="selected"';?>>(2) Remote</option>
                              <option value="1" <?php if($valueAllHazards['likehoodsecond'] == '1') echo 'selected="selected"';?>>(1) Rare</option>
                            </select>

                          </div>
                          <div class="clearfix"></div>
                        </div>
                   </div>
                       <div class="clearfix"></div>
                        <hr class="add_activity"/>
                        <?php

                        $sqlActionOfficer = "SELECT * FROM  `actionofficer` WHERE  `hazardid` =$valueAllHazards[hazard_id]";

                        $resultAllActionOfficer=mysqli_query($con, $sqlActionOfficer);
                         $numActionOfficer =  mysqli_num_rows($resultAllActionOfficer);
                          if($numActionOfficer > 0)
                          {

                          }
                          else
                          {
                            $numActionOfficer = 1;
                          }
                          ?>

                      <div class="row form-row">

                        <div class="col-sm-12">
                          <button class="col-sm-2 btn btn-primary addActionMember" id="add_new_member">+Action Officer</button>
                           <input type="hidden" name="hazardsActionOfficerCount[]" id="hazardsActionOfficerCount" value="<?php echo $numActionOfficer;?>" />
                        </div>
                      </div>



                          <?php
                           if($numActionOfficer > 0)
                          {
                              while($valueActionOfficer = mysqli_fetch_assoc($resultAllActionOfficer))
                              {
                              ?>
                              <div id="clonedInput1" class="row repeatingActionOfficer">

                                    <div class="col-sm-6">
                                      <div class="row">
                                        <label class="col-sm-6">Action Officer:</label>
                                        <?php
                                        if (in_array($valueActionOfficer['name'],array("W. K. Chan","Liang Kan Fat"))){ ?>
                                        <select name="actionOfficer[]"   class="col-sm-6 action_officers" >
                                            <option value="">Select Action Officer</option>
                                            <option value="W. K. Chan" <?php echo ($valueActionOfficer['name'] == "W. K. Chan")?'selected="selected"' : ''; ?>>W. K. Chan</option>
                                            <option value="Liang Kan Fat" <?php echo ($valueActionOfficer['name'] == "Liang Kan Fat")?'selected="selected"' : ''; ?>>Liang Kan Fat</option>
                                        </select>
                                        <?php
                                        }
                                        else {
                                          echo "<input type='text' name='actionOfficer[]' value='".$valueActionOfficer["name"]."'  class='col-sm-6 action_officers' >";
                                          }?>
                                      </div>
                                    </div>
                                    <button class="col-sm-1 btn btn-danger deleteActonOfficer" style="margin-left:20px;">Remove</button>
                              </div>

                              <?php
                              }
                          }
                          else
                          {

                        ?>
                          <div id="clonedInput1" class="row repeatingActionOfficer">

                                    <div class="col-sm-6">
                                      <div class="row">
                                        <label class="col-sm-6">Action Officer:</label>

                                          <select name="actionOfficer[]"   class="col-sm-6 action_officers" >
                                            <option value="">Select Action Officer</option>
                                            <option value="action_officer1">Action officer 1</option>
                                            <option value="action_officer2">Action officer 2</option>
                                            <option value="action_officer3">Action officer 3</option>
                                            <option value="action_officer4">Action officer 4</option>
                                            <option value="action_officer5">Action officer 5</option>
                                        </select>
                                      </div>
                                    </div>

                                     <button class="col-sm-1 btn btn-danger deleteActonOfficer" style="margin-left:20px;">Remove</button>
                              </div>
                        <?php
                          }
                        ?>








                       <div class="clearfix"></div>
                       <button class="col-sm-2 btn btn-success addHazards" id="add_new_work">+ Add hazards</button>
                       <button class="col-sm-2 btn btn-danger pull-right deleteHazards">Remove Hazards</button>
                      <div class="clearfix"></div>
                        <hr class="add_activity"/>
                  </div>


  <?php
  $cntval++;
  }
  ?>
          </div>

<?php
$wrk_act ++;
  }
?>





        <div class="col-sm-12 form_pad">
            <h3>Declaration of Risk Assessment</h3>
            <hr class="add_risk" />
            <div class="row form-row">
                <div class="col-sm-2"></div>
                <div class="col-sm-10">
                    <label>I hereby confirm that all information above are accurate to my best knowledge.</label>
                </div>
            </div>



            <div class="row form-below">
                <div class="col-sm-2"></div>
                <div class="col-sm-8">
                    <div class=" col-sm-8 btn-right">



                        <input class="btn btn-success draft" type="submit" value="Save as Draft" name="saveAsDraft"  >

                         <input class="btn btn-success draft" type="submit" value="Next" name="saveAsDraft" style="padding-left:30px; padding-right:30px;"  >
                         <input class="btn btn-danger" type="submit" id="cancel" value="Cancel" name="Cancel"   style="padding-left:30px; padding-right:30px;"   >


                    </div>
                </div>
            </div>

        </div>
</form>
</div>
</div>

<script type="text/javascript">
    document.getElementById("cancel").onclick = function () {
        location.href = "listwork_activity.php";
    };
</script>






<script type="text/javascript">

$('.draft').click(function(e){
  $("#toCopyDiv input").prop('required', false);
 $("#toCopyDiv select").prop('required', false);

});

$('.with_textbox').click(function(){
	if($(this).prop("checked") == false)
	{
		$(".with_textbox_value").val("");
	}
});
  //  $('#edit-submitted-first-name').prop('required', false);
function risk_control(this_value,class_value)
{
	if($(this_value).prop("checked") == true)
	{
		$("."+class_value).prop("checked",true);
	}else
	{
		$("."+class_value).prop("checked",false);
	}

}
  //  $('#edit-submitted-first-name').prop('required', false);
function get_injuery(main,thisvalue,option_id,wrk,haz)
{
  if (thisvalue === "other") {
    $(main).parent().parent().find(".other_hazard").css("display","block");
    // return;
  }
  else
    $(main).parent().parent().find(".other_hazard").css("display","none");
	$(main).parent().find(".ajax_loader").css("display","block");
	$.ajax({
		type:"POST",
		url:"get_ajax.php",
		data:{"key_value":thisvalue,wrk_act:wrk,hazard:haz},
		success:function(response){
			$(main).parent().find(".ajax_loader").css("display","none");
			$("#"+option_id).html(response);
		}
	});
}
function servity_hood(main,thisvalue,wrk,haz){
	var servity = $(main).find(':selected').attr('data-servity');
	$('#change_severity_'+wrk+'_'+haz).val(servity);
	$('.severity').trigger('change');
	$('#change_likehood_'+wrk+'_'+haz).val(servity);
	$('.likelihood').trigger('change');
}
</script>
 <?php include_once 'footer.php';?>
