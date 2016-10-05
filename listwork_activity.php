<?php
session_start();
 include_once 'header.php';
 include_once 'config.php';
?>
<style type="text/css">
  .topdtb
  {
    display: none;
  }

  .container {
    width: 1170px;
    
}

</style>
<?php 

 if(isset($_SESSION['adminid'])=="")
 {
 
 ?><script type="text/javascript">window.location.assign('index.php');</script>
 <?php

 }

 if(isset($_GET['riskid']) && isset($_GET['updateStatus']) && isset($_GET['updateStatusSubmit']))
 {
     
$today = date('Y-m-d H:i:s');

$afterSevenYears = date('Y-m-d H:i:s', strtotime('+3 years'));



      $updateSql = "UPDATE  `riskassessment` SET  `status` =  '$_GET[updateStatus]',`approveDate` =  '$today',`revisionDate` =  '$afterSevenYears',`approveBy` =  '$_SESSION[adminid]',`approverEmail` =  '".$_SESSION['useremail']."' WHERE  `id` =$_GET[riskid]";
   



       if(mysqli_query($con, $updateSql))
       {
        $messageUpdate = 'Data Updated Successfuly ';
        ?>
        <script type="text/javascript">window.location.assign('listwork_activity.php?message=<?php echo $messageUpdate;?>');</script>
        <?php

      }
      

 }
 else
 {
   $messageUpdate = '';
 }
?>
  
              <?php
                //get count 
              //0 outstanding 1 for draft 2 approved 3 archive
                    $sqlOutStanding = "SELECT * FROM riskassessment where status = 0";
                    $resultlOutStanding = mysqli_query($con, $sqlOutStanding);
                    $outStandingRow= mysqli_num_rows($resultlOutStanding);
                    
                    $sqlDraft = "SELECT * FROM riskassessment where status = 1";
                    $resultlDraft = mysqli_query($con, $sqlDraft);
                    $draftRow= mysqli_num_rows($resultlDraft);

                    $sqlApprove = "SELECT * FROM riskassessment where status = 2";
                    $resultlApprove = mysqli_query($con, $sqlApprove);
                    $OutApprove= mysqli_num_rows($resultlApprove);


                    $sqlArchived = "SELECT * FROM riskassessment where status = 3";
                    $resultlArchived = mysqli_query($con, $sqlArchived);
                    $OutArchived= mysqli_num_rows($resultlArchived);

              ?>
   <div class="container">
   
   <div class="row" style="padding-bottom: 10px;">
   			<div class="col-sm-6" style="text-align:left; padding:0px"><strong>Risk Register Summary</strong></div>
  			<div class="col-sm-6 pull-right" style="text-align:right; padding:0px">	
 				<a href="divAddRemoveSubmit.php">
              <button class="btn btn-success">
                <strong>+ Add New Risk Assessment</strong>
              </button>
            </a>
            </div>
    </div>
   
   
   <div class="claer-fix"></div>
    
    <div class="row"  style="padding-bottom: 10px;">
    		<div class="col-sm-5" style="text-align:left; padding:0px"><strong>QE Safety Consultancy Pte Ltd</strong></div>
            <div class="col-sm-7" style="padding:0px; text-align:right;"> 

                          <?php
                          if(isset($_GET['status']))

                          {
                            $status=$_GET['status'];
                          }

                          if($status==0){
							  
                            ?><a href="listwork_activity.php?status=0"><u><b>Outstanding (<?php echo $outStandingRow;?>)</b></u> </a>&nbsp;<strong>|</strong>&nbsp;
                            
                            <?php
                          }
                          else
                          {
                          ?>
                          <a href="listwork_activity.php?status=0">Outstanding (<?php echo $outStandingRow;?>) </a>&nbsp;<strong>|</strong>&nbsp;
                          <?php } ?>
                          
                          
                          
                             <?php
                          if(isset($_GET['status']))

                          {
                            $status=$_GET['status'];
                          }

                          if($status==1){
                            ?>

                          
                          <a href="listwork_activity.php?status=1"><u><b> Draft (<?php echo $draftRow;?>)</b></u> </a> &nbsp;<strong>|</strong>&nbsp;
                             <?php
                          }
                          else
                          {
                          ?>
                             <a href="listwork_activity.php?status=1"> Draft (<?php echo $draftRow;?>) </a> &nbsp;<strong>|</strong>&nbsp;
                             
                        <?php } ?>  
                        
                        
                              <?php
                          if(isset($_GET['status']))

                          {
                            $status=$_GET['status'];
                          }

                          if($status==2){
                            ?>
 
                          
                          
                          <a href="listwork_activity.php?status=2"><u><b> Approved (<?php echo $OutApprove;?>)</b></u> </a>&nbsp; <strong>|</strong>&nbsp;
                             <?php
                          }
                          else
                          {
                          ?>
                          <a href="listwork_activity.php?status=2"> Approved (<?php echo $OutApprove;?>) </a>&nbsp; <strong>|</strong>&nbsp;
                             <?php } ?>  
                             
                                    <?php
                          if(isset($_GET['status']))

                          {
                            $status=$_GET['status'];
                          }

                          if($status==3){
                            ?>
 
                          
                          
                      
                          
                          <a href="listwork_activity.php?status=3"><u><b> Archived (<?php echo $OutArchived;?>)</b></u></a>    <strong>|</strong>&nbsp;
                             <?php
                          }
                          else
                          {
                          ?>
                          
                          
                          
                          
                             <a href="listwork_activity.php?status=3"> Archived (<?php echo $OutArchived;?>)</a>    <strong>|</strong>&nbsp;
                               <?php } ?> 
                             
                             
              </div>
              
              <div class="claer-fix"></div>
    </div>
    
    
   <div class="row">
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
      


          <div class="table-responsive"> 
            <?php
            if(isset($_GET['message']) && $_GET['message'] != '')
            {
              ?>
                <div class="alert alert-success">
                      <strong>Updated!</strong> Data updated succesfully.
                    </div>
              <?php
            }
            ?>
             <?php
            if(isset($_GET['copydata']) && $_GET['copydata'] != '')
            {
              ?>
                <div class="alert alert-success">
                      <strong>Copied!</strong> Data copied succesfully.
                    </div>
              <?php
            }
            ?>
            

              <!--sorting data--> 
  
    <table id="dttbl"  class="table table-bordered table table-striped" style="table-layout: fixed;
    width: 100%;">
  
        <thead style="background-color: #D7EBF9;">
       
             <tr>
               <th  class="heading" style="width:6% !important">
                        Ref No
                    </th>
                 <th  class="heading" style="width:10% !important">
                      Risk Location
                  </th>
                <th  class="heading"  style="width:12% !important">
                      Process
                  </th>
                  <th  class="heading" style="width:11% !important">
                      Approval Date
                  </th>
                  <th  class="heading" style="width:13% !important">
                      Next Review Date
                <th class="heading" style="width:9% !important">RA Leader</th>
                  <th  class="heading" style="width:12% !important">
             		 Approving Mngr
            	</th>
               <th>       Status
                   
                  </th>
                
                
            </tr>
        </thead>
        <tbody id="myTable">
        <?php 
        if(isset($_GET['sort']))
        {
            
             if ($_GET['sort'] == 'ASC' && $_GET['field'] !='')
             {
                $order = " ORDER BY $_GET[field] ASC";
            }
            elseif($_GET['sort'] == 'desc' && $_GET['field'] !='')
              {
                $order= " ORDER BY $_GET[field] DESC";
              }
              else
              {
                $order= " ORDER BY id ASC";
              }

            

        }
        else
            {
              $order = " ORDER BY id ASC";
            }

        if(isset($_GET['status']) && $_GET['status'] !='')
        {
            if(isset($_GET['id']) && $_GET['id'] !='')
            {
              $whereStatus = " WHERE  status = $_GET[status] AND id= $_GET[id]";   
            }
            else
            { 
              $whereStatus = " WHERE  status = $_GET[status]";
            }  
        }
        else
        {
            $whereStatus = " WHERE  status = 0";
        }


        $sql = "SELECT * FROM riskassessment $whereStatus $order";
        $result = mysqli_query($con, $sql);
        $num_row= mysqli_num_rows($result);
       if($num_row>0)
       {
               while($row = mysqli_fetch_assoc($result)) 
               {

             ?> 
                     <tr>
                        <td ><?php echo $row['id'];?></td>
                        <td ><?php echo $row['location'];?></td>
                        <td ><?php echo wordwrap($row['process'], 25, "\n", 1);?></td>
                        <td ><?php if($row['approveDate'] =='0000-00-00 00:00:00')
                        {
                          echo '';
                        }
                        else
                        {
                          echo $date = date('d-m-Y', strtotime($row['approveDate']));
                        }
                        ?></td>
                        <td > 
                       <?php if($row['approveDate'] =='0000-00-00 00:00:00')
                        {
                          echo '';
                        }
                        else
                        {
                      
					   
					   echo $creationDate =  date('d-m-Y', strtotime('+3 years', strtotime($row['approveDate'])));
						}
                        ?></td>
                         
                        <td ><?php 
                                 $sqlUser = "SELECT * FROM staff_login where id = $row[createdBy]";
                                $resultlUser = mysqli_fetch_assoc(mysqli_query($con, $sqlUser));
                                if($resultlUser)
                                {
                                  echo '<p><strong>'.$resultlUser['name'].'</strong></p>';
                                }  
                                






                        ?></td>
                        <td >
                          <?php
                          //get all the signee

                                 $sqlUser = "SELECT * FROM signing where riskid = $row[id]";
                                $exelUser = mysqli_query($con, $sqlUser);
                                while($resultSignee = mysqli_fetch_assoc($exelUser))
                                {
                                    //if aprroved by same email than strong
                                    if($row['approverEmail'] == $resultSignee['email'])
                                    {
                                        if($resultSignee['name'] != '')
                                        { 

                                         echo '<p><span class="glyphicon glyphicon-ok"></span> <strong>';
                                         echo $resultSignee['name'];
                                        
                                         //get designation 
                                          //$sqlUser = "SELECT * FROM staff_login where email = '$resultSignee[email]'";
                                          //$resultlUser = mysqli_fetch_assoc(mysqli_query($con, $sqlUser));

                                          //echo $resultlUser['designation'].'</strong></p>';
                                        }

                                    }
                                    else
                                    { 
                                        if($resultSignee['name'] != '')
                                        {
                                         echo '<p><strong>'.$resultSignee['name'].'</p>';
                                        // echo " , ";
                                         //get designation 
                                         // $sqlUser = "SELECT * FROM staff_login where email = '$resultSignee[email]'";
                                         // $resultlUser = mysqli_fetch_assoc(mysqli_query($con, $sqlUser));

                                          //echo $resultlUser['designation'].'</p>';
                                        }
                                    }

                                }
                          ?>


                        </td>
                        <td><?php 
                                if($row['status'] == 0)
                                {
                                //check whether he is authorized or not
                                
                                 $sqlSigning = "SELECT * FROM signing where riskid = $row[id] AND email = '".$_SESSION['useremail']."'";
                                $exeSigning = mysqli_query($con, $sqlSigning);
                                $resultlSigning = mysqli_fetch_assoc($exeSigning);
                                
                                $signingCount = mysqli_num_rows($exeSigning);  
                                if($signingCount > 0)
                                {
                                  $disabled = '';
                                }
                                else
                                {
                                  $disabled = 'disabled="disabled"';
                                }
                                  
                                  ?>
                                  <form id="updateFormId<?php echo $row['id'];?>" name="updateForm<?php echo $row['id'];?>" action="listwork_activity.php" method="get" >
                                      <input name="riskid" value="<?php echo $row['id'];?>" type="hidden">

                                       <input name="updateStatus" value="2" type="hidden">

                                     
                                       
                                       <input <?php echo $disabled;?> type="submit" name="updateStatusSubmit" value="Click to approve" class="btn btn-danger btn-sx"> 
                                        
                                    

                                  
                                  
                                 &nbsp;<a href="divAddRemoveSubmitEdit.php?riskid=<?php echo $row['id'];?>" style="text-decoration: none"><input  type="button" name="updateStatusSubmit" value="Edit" class="btn btn-warning btn-sx" style="width:15%"></a>
                                  
                                  &nbsp;<a href="companyreport.php?riskid=<?php echo $row['id'];?>" style="text-decoration: none"><input  type="button" name="updateStatusSubmit" value="View" class="btn btn-warning btn-sx"  style="width:15%" ></a>

  &nbsp;<a href="copydata.php?riskid=<?php echo $row['id'];?>&status=0&message=document sents successfully" style="text-decoration: none">
 <input  type="button" name="updateStatusSubmit" value="Copy" class="btn btn-warning btn-sx"  style="width:15%" onclick="return confirm('Are you sure,you want to copy?')" ></a>


                                  </form>
                                  <?php
								  
                                }

                                if($row['status'] == 1)
                                {
                                  echo "<a href=\"divAddRemoveSubmitEdit.php?riskid=$row[id]\"><span class=\"btn btn-warning btn-sx cws \">Draft</span></a>";
								  echo "<a href=\"copydata.php?riskid=$row[id]\"><span class=\"btn btn-warning btn-sm btn_new \" style=\"width: 30%;padding-bottom: 2px;padding-top: 2px;font-size: inherit;\">copy</span></a>";
                                }

                                if($row['status'] == 2)
                                {
                                  echo "<span class=\"btn btn-success btn-sm\">Approved</span>";
                                  echo "<a href=\"divAddRemoveSubmitEdit.php?riskid=$row[id]\"><span class=\"btn btn-warning btn-sm  btn_new\">Edit</span></a>";
								  echo "<a href=\"companyreport.php?riskid=$row[id]\"><span class=\"btn btn-warning btn-sm btn_new \">View</span></a>";
								   echo "<a href=\"copydata.php?riskid=$row[id]\"><span class=\"btn btn-warning btn-sm btn_new \">copy</span></a>";
                                }

                                if($row['status'] == 3)
                                {
                                  echo "<span class=\"btn btn-primary btn-sx \">Archived</span>";
                                  echo "<a href=\"divAddRemoveSubmitEdit.php?riskid=$row[id]\"><span class=\"btn btn-warning btn-sx btn_new \">Edit</span></a>";
								  echo "<a href=\"companyreport.php?riskid=$row[id]\"><span class=\"btn btn-warning btn-sm btn_new \">View</span></a>";
								  echo "<a href=\"copydata.php?riskid=$row[id]\"><span class=\"btn btn-warning btn-sm btn_new \">copy</span></a>";
                                }

                        ?></td>
                    </tr>

                <?php
                } // end of while
        }
        ?>
           

        </tbody>
    </table>

      </div>
      </div>
      </div>
 

 
<script>
language="JavaScript" type="text/javascript">
 function $row['id']
 {
 if (confirm("Are you sure you want to copy data"))
 {
 window.location.href = 'copydata.php?riskid=<?php echo $row['id'];?>';
 }
 }
</script>


<script
 language="JavaScript" type="text/javascript">
 function delete_id(id)
 {
 if (confirm("Are you sure you want to delete"))
 {
 window.location.href = 'delete.php?id=' + id;
 }
 }
</script>

<?php include_once 'footer.php'; ?>