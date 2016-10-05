<?php
include_once 'config.php';
session_start();
if(!$_GET['id'])
{
	header('Location:listwork_activity.php');
}

 if(isset($_SESSION['adminid'])=="")
 {
 
 ?><script type="text/javascript">window.location.assign('login.php');</script>
 <?php

 }

if(isset($_GET['id']))
	$id= $_GET['id'];

?>

<?php include_once 'header.php' ;?>

     
      <div class="container" style="border:2px solid black;">
      <?php if(isset($_GET['msg_error']))
      {?>
      <h3 style="color:red">Error In data Deletion</h3>
      <?php
      }
      if(isset($_GET['msg_delete']))
      {
        ?><h3 style="color:green">Data Deleted Sucessfully</h3>
    <?php
      }
      ?>
      <!--Getting work activity Name-->
     <?php 
     $sql = "SELECT name FROM workactivity where work_id=$id";
     $result = mysqli_query($con, $sql);
     $num_row= mysqli_num_rows($result);
     if($num_row>0){
     while($row = mysqli_fetch_assoc($result)) {
     ?> 
      <h3 style="text-align:center"><?php echo $row['name'];?></h3><?php 
      }
      }
      ?>

      
          <div class="table-responsive"> 
      <div class="bs-example">
      <div class="align_right"><a href="addhazard.php?id=<?php echo $id;?>"><button class="button_new_risk"><strong>+ Add New Hazard</strong></button></a></div>
    <table id="dttbl"  class="table table-bordered table table-striped">
  
        <thead>                             
        
             <tr>
              <th  class="heading">Work Activity Name</th>

               
                 <?php
                   if(isset($_GET['sort']))
                   {
                 if ($_GET['sort'] == 'ASC')
                {
                ?>
                <th  class="heading"><a href="hazard.php?id=<?php echo $id;?>&sort=desc">Name</a></th>
                <?php
                }
               
                elseif($_GET['sort']=='desc')
                {
                ?><th  class="heading"><a href="hazard.php?id=<?php echo $id;?>&sort=ASC">Name</a></th><?php
                }
                 }
                 else
                 {
                  ?><th  class="heading"><a href="hazard.php?id=<?php echo $id;?>&sort=desc">Work Activity</a></th>
                  <?php
                 } 
             ?>
                <th class="heading">Security</th>
                <th class="heading">Accident</th>
                <th class="heading">Likehood</th>
                <th class="heading">Risk Control</th>
                <th class="heading">Risk Label</th>
                <th class="heading">Risk Additional</th>
                <th class="heading">Action Officer</th>
                <th class="heading">Action Date</th>
                <th class="heading">Status</th>
                <th class="heading">Edit/Delete</th>
            </tr>
        </thead>

         <?php 
     $sql = "SELECT name FROM workactivity where work_id=$id";
     $result = mysqli_query($con, $sql);
     $num_row= mysqli_num_rows($result);
     if($num_row>0){
   while($row2= mysqli_fetch_assoc($result)){
   
    $name=$row2['name'];
    }
    }
    ?> 
        <tbody id="myTable">
        <?php 

         if(isset($_GET['sort']))
        {
     $sql = "SELECT * FROM hazard where work_id=$id";
     if ($_GET['sort'] == 'ASC')
     {
    $sql .= " ORDER BY name ASC";
    }
  elseif($_GET['sort'] == 'desc')
   {
    $sql .= " ORDER BY name DESC";
   
     }
     }
     else
     {

     $sql = "SELECT * FROM hazard where work_id=$id";
   }
     $result = mysqli_query($con, $sql);
     $num_row= mysqli_num_rows($result);
     if($num_row>0){
     while($row = mysqli_fetch_assoc($result)) {
     ?> 
     <tr>
       <td ><div class="cont"><?php echo $name;?></div></td>
        <td ><div class="cont"><?php echo $row['name'];?></div></td>
        <td ><div class="cont"><?php echo $row['security'];?></div></td>
        <td ><div class="cont"><?php echo $row['accident'];?></div></td>
        <td ><div class="cont"><?php echo $row['likehood'];?></div></td>
        <td ><div class="cont"><?php echo $row['risk_control'];?></div></td>
        <td ><div class="cont"><?php echo $row['risk_label'];?></td></div>
        <td ><div class="cont"><?php echo $row['risk_additional'];?></td></div>
        <td ><div class="cont"><?php echo $row['action_officer'];?></td></div>
        <td ><div class="cont"><?php echo $row['action_date'];?></td></div>
        <td ><div class="cont"><?php echo $row['status'];?></td></div>
        <td ><div class="cont"><a href="addhazard.php?eid=<?php echo $row['hazard_id'];?>"><img src="images/action_edit.gif"></a><a href="javascript:delete_id(<?php echo $row['hazard_id']; ?>)"><img src="images/action_delete.gif"></a></td></div>
        </tr>

        <?php
        }
        }
        ?>
            <div/>
        </tbody>
    </table>

      </div>
      
      
      </div>
   <script
 language="JavaScript" type="text/javascript">
 function delete_id(id)
 {
 if (confirm("Are you sure you want to delete"))
 {
 window.location.href = 'delete.php?hazardid=' + id;
 }
 }
</script>

<!--Script for pagination-->

<script type="text/javascript" language="javascript" src="js1/jquery.dataTables.js"></script>
<script type="text/javascript" charset="utf-8">
  $(document).ready(function() {
    oTable = $('#dttbl').dataTable({
      "bJQueryUI": true,
      "sPaginationType": "full_numbers",
      "bSort": false,
      'iDisplayLength': 10,
      "sDom": '<"topdtb"ft"dzr"p>rt<"topdtb"lip><"clear">'
    });
  } );
</script> 
<style type="text/css" title="currentStyle">

      @import "css1/demo_page.css";
      @import "css1/demo_table_jui.css";
      @import "css1/jquery-ui-1.8.4.custom.css";
</style>


<?php include_once 'footer.php';?>