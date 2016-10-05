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

<?php include_once 'headerreport.php' ;?>

     
     
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

      
      
      
     
    <table id="dttbl"  class="table table-bordered table table-striped">
  
        <thead>                             
        
             <tr>
              <th  class="heading">Work Activity Name</th>
                <th  class="heading">Name</th>

               <th class="heading">Security</th>
                <th class="heading">Accident</th>
                <th class="heading">Likehood</th>
                <th class="heading">Risk Control</th>
                <th class="heading">Risk Label</th>
                <th class="heading">Risk Additional</th>
                <th class="heading">Action Officer</th>
                <th class="heading">Action Date</th>
                <th class="heading">Status</th>
              
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
     $sql = "SELECT * FROM hazard where work_id=$id";

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
        
        </tr>

        <?php
        }
        }
        ?>
            <div/>
        </tbody>
    </table>

      </div>
      <div style="text-align:center;">
  
   <span class="print">print</span>
</div>
  



<style type="text/css" title="currentStyle">

      @import "css1/demo_page.css";
      @import "css1/demo_table_jui.css";
      @import "css1/jquery-ui-1.8.4.custom.css";
</style>


<?php include_once 'footer.php';?>