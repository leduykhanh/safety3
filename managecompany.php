<?php
 include_once 'header.php';
 include_once 'config.php';
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
            
          
      <h3 style="text-align:center">Manage Company</h3>
        <div class="table-responsive"> 
      <div class="bs-example">
       <div class="align_right"> <a href="addcompany.php">  <button class="button_new_risk"><strong>+ Add A COMPANY</strong></button></a></div>
          
    <table id="dttbl"  class="table table-bordered table table-striped">
   
        <thead>
          
                    <tr>
                   
                    <?php
                    if(isset($_GET['sort']))
                   {
                 if ($_GET['sort'] == 'ASC')
                {
                ?>
                <th  class="heading"><a href="managecompany.php?sort=desc">Company Name</a></th>
                <?php
                }
               
                elseif($_GET['sort']=='desc')
                {
                ?><th  class="heading"><a href="managecompany.php?sort=ASC">Company Name</a></th><?php
                }
                 }
                 else
                 {
                  ?><th  class="heading"><a href="managecompany.php?sort=desc">Company Name</a></th>
                  <?php
                 } 
             ?>
               
                
                <th  class="heading">Company Description</th>
                <th class="heading">Company Status</th>
                <th class="heading">Edit/Delete</th>
                  <th class="heading">Report</th>
                
           			</tr>
        </thead>
        <tbody id="myTable">
        
       
		<?php 
        if(isset($_GET['sort']))
        {
     $sel_user = "SELECT * from company where status= '1'";
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
		 $sel_user="SELECT * from company where status= '1'";
	 }
				 $run_user=mysqli_query($con, $sel_user);
		
			while($data=mysqli_fetch_array( $run_user))
			
      {
		    ?>
        
        
            <tr>
              
                  <td><?php echo $data['name']; ?></td>
                   <td><?php echo $data['description']; ?></td>
                  <td><?php echo $data['status']; ?></td>
                  
                  <td ><a href="editcompany.php?company_id=<?php echo $data['company_id']; ?>"><img src="images/action_edit.gif" width="25" height="25" /> 
                  
                <a href="javascript:delete_id(<?php echo $data['company_id']; ?>)"><img src="images/action_delete.gif"></a></td>
                  
             <td><a href="companyreport.php?id=<?php echo $data['company_id'];?>">Generate Report</a></td>
              <?php   

} /*while loop of search end*/

?>
 

                
            </tr>
           
            <div />
        </tbody>
    </table>

      </div>
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