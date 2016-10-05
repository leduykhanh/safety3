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
    margin-bottom: 20px;
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
      <h3>Risk Register Summary</h3>
      <br>
      

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

             <a href="divAddRemoveSubmit.php">
              <button class="btn btn-success">
                <strong>+ Add New Risk Assessment</strong>
              </button>
            </a>
          <br>
          <br>
          
            
            
          
             
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
              <div class="col-sm-12" style="padding:0px">
             
                <div class="col-sm-7" style="padding:0px"><strong>QE Safety Consultancy Pte Ltd</strong></div>
                <div class="col-sm-5" style="padding:0px"> 
                  <a href="listwork_activity.php?status=0"><strong>Outstanding (<?php echo $outStandingRow;?>)</strong> </a>&nbsp;<strong>|</strong>&nbsp;
                  <a href="listwork_activity.php?status=1"> <strong>Draft (<?php echo $draftRow;?>)</strong> </a> &nbsp;<strong>|</strong>&nbsp;
                  <a href="listwork_activity.php?status=2"> <strong>Approved (<?php echo $OutApprove;?>)</strong> </a>&nbsp;<strong>|</strong>&nbsp;<a href="listwork_activity.php?status=3"><strong> Archived (<?php echo $OutArchived;?>) </strong></a>
                </div>
             </div>










     

              <!--sorting data--> 
  
    <table id="dttbl"  class="table table-bordered table table-striped">
  
        <thead>
       
             <tr>
               <th  class="heading">
                        Ref No.
                    </th>
                 <th  class="heading">
                      Risk Location.
                  </th>
                <th  class="heading">
                      Process.
                  </th>
                  <th  class="heading">
                      Approval Date.
                  </th>
                  <th  class="heading">
                      Next Review Date.
                <th class="heading">RA Leader</th>
                  <th  class="heading">
             		 Approving Manager.
            	</th>
               <th>       Status.
                   
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
                        <td ><?php echo $row['process'];?></td>
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
                        <td ><?php 
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
                                  <form id="updateFormId<?php echo $row['id'];?>" name="updateForm<?php echo $row['id'];?>" action="listwork_activity.php" method="get" style="display: none;">
                                      <input name="riskid" value="<?php echo $row['id'];?>" type="hidden">

                                      <div class="form-group">
                                       
                                      <div style="display:none">
                                        <label for="sel1">Update Status:</label>
                                        <select class="form-control" id="sel1" name="updateStatus" <?php echo $disabled;?>>
                                          <option value="2">Approved</option>
                                          <option value="3">Archived</option>

                                        </select>
                                        <br />
                                      </div>  


                                        <input <?php echo $disabled;?> type="submit" name="updateStatusSubmit" value="Approve" class="btn btn-success btn-sx"> 
                                        
                                      </div>

                                  </form>
                                  <span class="btn btn-danger btn-sx" style="display:initial;" onclick="myFunction('updateFormId<?php echo $row['id'];?>')" >Awaiting Approval</span>&nbsp;&nbsp;<a href="divAddRemoveSubmitEdit.php?riskid=<?php echo $row['id'];?>"><input  type="button" name="updateStatusSubmit" value="View / Edit" class="btn btn-warning btn-sx" style="display:initial;" ></a>
                                  <?php
                                }

                                if($row['status'] == 1)
                                {
                                  echo "<a href=\"divAddRemoveSubmitEdit.php?riskid=$row[id]\"><span class=\"btn btn-warning btn-sm cws \">Draft</span></a>";
                                }

                                if($row['status'] == 2)
                                {
                                  echo "<span class=\"btn btn-success btn-sm\">Approved</span>";
                                  echo "<a href=\"divAddRemoveSubmitEdit.php?riskid=$row[id]\"><span class=\"btn btn-warning btn-sm \">View / Edit</span></a>";
                                }

                                if($row['status'] == 3)
                                {
                                  echo "<span class=\"btn btn-primary btn-sm \">Archived</span>";
                                  echo "<a href=\"divAddRemoveSubmitEdit.php?riskid=$row[id]\"><span class=\"btn btn-warning btn-sm \">View / Edit</span></a>";
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

    function myFunction(formid)
    {
      
      $('#'+formid).toggle("slow");
    } 

 


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
 window.location.href = 'delete.php?id=' + id;
 }
 }
</script>

<?php include_once 'footer.php'; ?>