<?php
 include_once 'config.php';
 include 'header.php'
 ?>

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
            
            <h3 style="text-align:center">Manage Location</h3>
      
        <div class="table-responsive"> 
      <div class="bs-example">
            <div class="align_right"> <a href="addlocation.php">  <button class="button_new_risk"><strong>+ Add Location</strong></button></a></div>
    <table id="dttbl"  class="table table-bordered table table-striped">
   
        <thead>
          
                    <tr>
                <th class="heading">Location ID</th>
               
                <?php
                    if(isset($_GET['sort']))
                   {
                 if ($_GET['sort'] == 'ASC')
                {
                ?>
                <th  class="heading"><a href="managelocation.php?sort=desc">Company Name</a></th>
                <?php
                }
               
                elseif($_GET['sort']=='desc')
                {
                ?><th  class="heading"><a href="managelocation.php?sort=ASC">Company Name</a></th><?php
                }
                 }
                 else
                 {
                  ?><th  class="heading"><a href="managelocation.php?sort=desc">Company Name</a></th>
                  <?php
                 } 
             ?>
               
           
           
           
           
           
              <?php
                    if(isset($_GET['sort']))
                   {
                 if ($_GET['sort'] == 'ASC')
                {
                ?>
                <th  class="heading"><a href="managelocation.php?sort=desc">Location Name</a></th>
                <?php
                }
               
                elseif($_GET['sort']=='desc')
                {
                ?><th  class="heading"><a href="managelocation.php?sort=ASC">Location Name</a></th><?php
                }
                 }
                 else
                 {
                  ?><th  class="heading"><a href="managelocation.php?sort=desc">Location Name</a></th>
                  <?php
                 } 
             ?>    
               
                	
                <th  class="heading">Location Description</th>
                <th class="heading">Location Status</th>
                <th class="heading">Edit/Delete</th>
                
                
           			</tr>
        </thead>
        <tbody id="myTable">
        
        
          
		<?php 
        if(isset($_GET['sort']))
        {
     $sel_user = "SELECT * from location where status= '1'";
     if ($_GET['sort'] == 'ASC')
     {
    $sel_user .= " ORDER BY name ASC";
	
    }
  elseif($_GET['sort'] == 'desc')
   {
    $sel_user .= " ORDER BY name DESC";
	
   
     }
     }
     else
     {
       
		 $sel_user="SELECT * from  location where status= '1'";
	 }
				 $run_user=mysqli_query($con, $sel_user);
		
			while($data=mysqli_fetch_array( $run_user))
			
      {
		   $id= $data['company_id'];
		    ?>
        
        
            <tr>
               <td><?php echo $data['location_id']; ?></td>
                  <?php 
                 
                 $sel_user2="SELECT name from company where company_id=$id";
               
                 $run_user2=mysqli_query($con, $sel_user2);

                 $check_user2 = mysqli_num_rows($run_user2);
                 if($check_user2>0){
                  while($row2 = mysqli_fetch_assoc($run_user2)) { 
                    $name=$row2['name'];
               ?>

        <td ><?php echo $name;?></td>  
        <?php 
      }
      }
	  ?>
                  <td><?php echo $data['name']; ?></td>
                   <td><?php echo $data['description']; ?></td>
                  <td><?php echo $data['status']; ?></td>
                  
                  <td ><a href="editlocation.php?company_id=<?php echo $data['company_id']; ?>"><img src="images/action_edit.gif" width="25" height="25" />
                  
                <a href="javascript:delete_id(<?php echo $data['company_id']; ?>)"><img src="images/action_delete.gif"></a></td>
                  
             
              <?php   

} /*while loop of search end*/

?>


                
            </tr>
           
            <div />
        </tbody>
    </table>

      </div>
      
      
                           
                    <div class="col-lg-12">
                    
                    

                    <div class="form-group">
                <?php 
$sel_user = "SELECT * FROM location"; 
$run_user=mysqli_query($con, $sel_user); //run the query
?>    
 <div class="col-md-12 text-center">
      <ul class="pagination pagination-lg pager" id="myPager"></ul>
      </div>
      
      </div>
 
 <script src="js/jquery-1.10.2.js"></script>
    <script src="js/bootstrap.js"></script>

 <script type="text/javascript" language="javascript" src="js1/jquery.js"></script>
<script type="text/javascript" language="javascript" src="js1/jquery.dataTables.js"></script>
<script type="text/javascript" charset="utf-8">
  $(document).ready(function() {
    oTable = $('#dttbl').dataTable({
      "bJQueryUI": true,
      "sPaginationType": "full_numbers",
      "bSort": false,
      'iDisplayLength': 100,
      "sDom": '<"topdtb"ft"dzr"p>rt<"topdtb"lip><"clear">'
    });
  } );
</script> 
<style type="text/css" title="currentStyle">

      @import "css1/demo_page.css";
      @import "css1/demo_table_jui.css";
      @import "css1/jquery-ui-1.8.4.custom.css";
</style>
      
      
        <script
 language="JavaScript" type="text/javascript">
 function delete_id(id)
 {
 if (confirm("Are you sure you want to delete"))
 {
 window.location.href = 'delete.php?company_id=' + id;
 }
 }
</script>
           
  <?php
  include 'footer.php';
  ?>