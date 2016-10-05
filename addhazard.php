<?php
include_once 'config.php';
if(isset($_GET['id']))
{
    if($_GET['id']=="")
    {
        header('Location:listwork_activity.php');

    }
}


else if(isset($_GET['eid']))
{
    if($_GET['eid']=="")
    {
        header('Location:listwork_activity.php');

    }
}
?>

<?php include_once 'header.php';?>

<?php if(isset($_GET['id']))
{
    $id= $_GET['id'];


     $sql = "SELECT name FROM workactivity where work_id=$id";
     $result = mysqli_query($con, $sql);
     $num_row= mysqli_num_rows($result);
     if($num_row>0){
     while($row = mysqli_fetch_assoc($result)) {
     $name=$row['name'];
    
     }
}
}

else
$name="";
?>

<!--Inserting data into database-->
<?php

if(isset($_POST['save_draft']))

{
  
    $work_id=$id;
    $hazard_count=count($_POST['hazard']);
  
for ($i=0; $i<=$hazard_count; $i++) { 

$sql = "INSERT INTO hazard (work_id, name, security,accident,likehood,risk_control,risk_label,risk_additional,action_officer,action_date,status)
VALUES ($work_id, '".$_POST['hazard'][$i]."', '".$_POST['security'][$i]."','".$_POST['accident'][$i]."','".$_POST['likehood'][$i]."','".$_POST['risk_control'][$i]."','".$_POST['risk_label'][$i]."','".$_POST['risk_control_additional'][$i]."','".$_POST['action_officer'][$i]."','".$_POST['action_date'][$i]."',0)";
$insert_record=mysqli_query($con, $sql);
}
if($insert_record)
{
  $msg_success= "Record added Successfully";
}
else
{
 $msg_erorr= "Error in data insertion";
}
}
?>

 <form method="post">
 <div class="container" style="border:2px solid black;">
 <!--Updating Hazard-->
  <?php if(isset($_GET['eid']))
   {
    $eid= $_GET['eid'];


     $sql = "SELECT * FROM hazard where hazard_id=$eid";
     $result = mysqli_query($con, $sql);
     $num_row= mysqli_num_rows($result);
     if($num_row>0){
     while($row = mysqli_fetch_assoc($result)) {
     $hname=$row['name'];
     $security=$row['security'];
     $likehood=$row['likehood'];
     $accidents=$row['accident'];
     $risk_label=$row['risk_label'];
     $risk_control=$row['risk_control'];
     $risk_additional=$row['risk_additional'];
    $action_officer=$row['action_officer'];
    $action_date=$row['action_date'];
     }

}

}
 
else
{
$hname="";
$security="";
$risk_control="";
$accidents="";
$risk_label="";
$likehood="";
$risk_additional="";
$action_officer="";
$action_date="";

}
?>



 <?php
   if(isset($_POST['update']))
   {
    $eid=$_GET['eid'];
    $hname=$_POST['hazard'][0];
    $security=$_POST['security'][0];
    $accident=$_POST['accident'][0];
    $likehood=$_POST['likehood'][0];
    $risk_control=$_POST['risk_control'][0];
    $risk_label=$_POST['risk_label'][0];
    $risk_additional=$_POST['risk_control_additional'][0];
    $action_officer=$_POST['action_officer'][0];
    $action_date=$_POST['action_date'][0];

    $sql = "UPDATE hazard SET name='$hname',security='$security',accident='$accident',likehood='$likehood',risk_control='$risk_control',risk_label='$risk_label',risk_additional='$risk_additional',action_officer='$action_officer',action_date='$action_date' WHERE hazard_id=$eid";
    

if (mysqli_query($con, $sql)) {
   $msg_success= "Record updated successfully";
} else {
   $msg_erorr= "Error updating record: " . mysqli_error($con);
}
}
?>

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
     
           

    <div class="col-sm-12 form_pad" id="">
    <div class="align_right"><a href="riskmange.php"><button type="button" class="button_new_work"><strong>+ Add New Workactivity</strong></button></a></div>
           <?php if(isset($name)){?>
           <h3 style="text-align:center"><?php echo $name;?></h3>
           <?php
           }
          ?> 
           <?php if(isset($hname)){?>
           <h3 style="text-align:center"><?php echo $hname;?></h3>
            <?php
           }
           ?>
   
      
            <hr class="add_risk" />

            <div class="row form-row">
            <div class="col-sm-2"><label>1) Hazard:</label></div>
            <div class="col-sm-4">
           <input class="span5" type="text" id="inputSaving" name="hazard[]" value="<?php echo $hname;?>" placeholder="" required>
            </div>

            <div class="col-sm-2"><label>Severity:</label></div>
            <div class="col-sm-4">
           <select class="" name="security[]" required>
           <option value="">Select one</option>
            <option value="Severity1"<?php if($security=="Severity1") echo 'selected="selected"'; ?>>Severity1</option>
             <option value="Severity2"<?php if($security=="Severity2") echo 'selected="selected"'; ?>>Severity2</option>
              <option value="Severity3"<?php if($security=="Severity3") echo 'selected="selected"'; ?>>Severity3</option>
           </select>
            </div>
       
            </div>

            <div class="row form-row">
            <div class="col-sm-3"><label>Possible Injury / Accident:</label></div>
            <div class="col-sm-3">
           <input class="span4" type="text" name="accident[]" id="inputSaving" value=" <?php echo $accidents;?>" placeholder="" required>
            </div>

            <div class="col-sm-2"><label>Likelihood:</label></div>
            <div class="col-sm-4">
           <select class="" name="likehood[]" required>
           <option value="">Select One</option>
           <option value="likehood1" <?php if($likehood=="likehood1") echo 'selected="selected"'; ?>>likehood1</option>
           <option value="likehood2" <?php if($likehood=="likehood2") echo 'selected="selected"'; ?>>likehood2</option>
           <option value="likehood3" <?php if($likehood=="likehood3") echo 'selected="selected"'; ?>>likehood3</option>
           <option value="likehood4"  <?php if($likehood=="likehood4") echo 'selected="selected"'; ?>>likehood4</option>
           </select>
            </div>

            </div>

             <div class="row form-row">
            <div class="col-sm-3"><label>Existing Risk Control:</label></div>
            <div class="col-sm-3">
           <textarea style="height:150px;width: 93%; " name="risk_control[]" required><?php  echo $risk_control;?></textarea>
            </div>
             
            <div class="col-sm-2"><label>Risk Level:</label></div>
            <div class="col-sm-4">
           <select class="" name="risk_label[]" required>
           <option value="">Select One</option>
           <option value="Risk label1" <?php if($risk_label=="Risk label1") echo 'selected="selected"'; ?>>Risk label1</option>
           <option value="Risk label2" <?php if($risk_label=="Risk label2") echo 'selected="selected"'; ?>>Risk label2</option>
           <option value="Risk Label3" <?php if($risk_label=="Risk label3") echo 'selected="selected"'; ?>>Risk Label3</option>
           <option value="Risk label4" <?php if($risk_label=="Risk label4") echo 'selected="selected"'; ?>>Risk label4</option>
           </select>
            </div>

            <div class="" style="float: right;margin-right: 201px;">
             <div class="row form-row">
            <div class="col-sm-5"><label>Additional Risk Control</label></div>
            <div class="col-sm-6">
  
          <textarea style="width: 100%; " name="risk_control_additional[]"><?php echo $risk_additional;?></textarea>
            </div>
            </div>
             <div class="row form-row">
            <div class="col-sm-5"><label>Action Officer:</label></div>
            <div class="col-sm-6">
          <input class="" type="text" name="action_officer[]" id="inputSaving" placeholder="" value="<?php echo $action_officer;?>">
            </div>
            </div>

             <script>

           $(document).ready(function(){

           $("#actiondate").datepicker({dateFormat: 'yy.mm.dd',

             minDate: 0

             });

            });

     </script>
             <div class="row form-row">
            <div class="col-sm-5"><label>Action Date:</label></div>
            <div class="col-sm-6">
          <input class="" type="text" id="actiondate" name="action_date[]" placeholder="" required value="<?php echo $action_date;?>">
            </div>
            </div>
            </div>

            </div>
            <?php if(isset($_GET['eid']))
         {
            ?>
             <button class="button" name="update"><strong>Update</strong></button>
             <?php
         }
         else
            {
                ?>
           
            <a class="add-new-work" id="add_new_hazard">+ Add a new hazard</a>
          

           
            <hr> 
            <div id="hazard"></div>
                    
             </div>

           <div class="col-sm-12 form_pad" id="add_new_activity" style="display:none;"></div>
            <div class="row form-below">
            <div class="col-sm-2"></div>
            <div class="col-sm-8">
            <div class=" col-sm-8 btn-right">

        
           <button class="button" name="save_draft"><strong>Save as Draft</strong></button><button class="button_cancel"><strong>Cancel</strong></button><button class="button_next"><strong>Next</strong></button><?php
       }
       ?>
          
            </div>
             
            </div>
            </div>

    </div>
    </div>
    </form>
    
   

      <script type = "text/javascript" language = "javascript">
         $(document).ready(function() {
             var counter2 = 1;
            $("#add_new_hazard").click(function () {
                counter2++;
                if(counter2<4)
                {

                 $append_haz_div='<div class="row form-row"><div class="col-sm-2"><label>'+ counter2+')Hazard:</label></div><div class="col-sm-4"><input class="span5" type="text" id="inputSaving" name=hazard[] placeholder=""></div><div class="col-sm-2"><label>Severity:</label></div><div class="col-sm-4"><select class="" name="security[]"><option>Select One</option></select></div></div><div class="row form-row"><div class="col-sm-3"><label>Possible Injury / Accident:</label></div><div class="col-sm-3"><input class="span4" name="accident[]" type="text" id="inputSaving" placeholder=""></div><div class="col-sm-2"><label>Likelihood:</label></div><div class="col-sm-4"><select class="" name="likehood[]"><option>Select One</option></select></div></div><div class="row form-row"><div class="col-sm-3"><label>Existing Risk Control:</label></div><div class="col-sm-3"><textarea style="height:150px;width: 93%;" name="risk_control[]"></textarea></div><div class="col-sm-2"><label>Risk Level:</label></div><div class="col-sm-4"><select class="" name="risk_label[]"><option>Select One</option></select></div><div class="" style="float: right;margin-right: 201px;"><div class="row form-row"><div class="col-sm-5"><label>Additional Risk Control</label></div><div class="col-sm-6"><textarea style="width: 100%; " name="risk_control_additional[]"></textarea></div></div><div class="row form-row"><div class="col-sm-5"><label>Action Officer:</label></div><div class="col-sm-6"><input class="" type="text" id="inputSaving" placeholder="" name="action_officer[]"></div></div><div class="row form-row"><div class="col-sm-5"><label>Action Date:</label></div><div class="col-sm-6"><input class="" name="action_date[]" type="text" id="actiondate" placeholder="" required></div></div></div></div><hr></div>';
               $("#hazard").append($append_haz_div);
                } });
         });
      </script>
    
   
    

    <?php include_once 'footer.php';?>
   