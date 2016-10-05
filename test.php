
    <!doctype html>
    <html>
    <head>
    <meta charset="utf-8">
    <title>Risk Management</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" integrity="sha256-7s5uDGW3AHqw6xtJmNNtr+OBRJUlgkNJEo78P4b0yRw= sha512-nNo+yCHEyn0smMxSswnf/OnX6/KwJuZTlNZBjauKhTK0c+zT+q5JOCx0UFhXQ6rJR9jg6Es8gPuD2uZcYDLqSw==" crossorigin="anonymous">

    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha256-3dkvEK0WLHRJ7/Csr0BZjAWxERc5WH7bdeUya2aXxdU= sha512-+L4yy6FRcDGbXJ9mPG8MT/3UCDzwR9gPeyFNMCtInsol++5m3bk2bXWKdZjvybmohrAsn3Ua5x8gfLnbE1YkOg==" crossorigin="anonymous">

    <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
    <link rel="stylesheet" type="text/css" href="css1/jquery-ui-1.8.4.custom.css">  


    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/styles.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script type="text/javascript" language="javascript" src="js1/jquery.dataTables.js"></script>
    <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha256-KXn5puMvxCw+dAYznun+drMdG1IFl3agK0p/pqT9KAo= sha512-2e8qq0ETcfWRI4HJBzQiA3UoyFk6tbNyG+qSaIBZLyW9Xf3sWZHN/lxe9fTh1U45DpPf07yj94KsUHHWe4Yk1A==" crossorigin="anonymous"></script>
   
   <style type="text/css">
 
body {
    font-family: Calibri, Candara, Segoe, 'Segoe UI', Optima, Arial, sans-serif;
    font-size: 18px;
}
   </style>
   

   </head>

<body>
    <div class="container">
        <div class="row">
        <div class="col-sm-2">
        <div class="logo"><a href="index.php"><img src="images/risklogo.png"/></a></div>
        </div>
        <div class="col-sm-10">
        <span class="logout">
       	<a href="logout.php"><strong> Log Out</strong></a>
        </span>
        </div>
        </div>
       
       
         
       </div><style type="text/css">
  .topdtb
  {
    display: none;
  }

  .container {
    width: 1170px;
    
}

</style>
  
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

                          <a href="listwork_activity.php?status=0"><u><b>Outstanding (84)</b></u> </a>&nbsp;<strong>|</strong>&nbsp;
                            
                                                      
                          
                          
                                                          <a href="listwork_activity.php?status=1"> Draft (1) </a> &nbsp;<strong>|</strong>&nbsp;
                             
                          
                        
                        
                                                        <a href="listwork_activity.php?status=2"> Approved (14) </a>&nbsp; <strong>|</strong>&nbsp;
                               
                             
                                                              
                          
                          
                          
                             <a href="listwork_activity.php?status=3"> Archived (0)</a>    <strong>|</strong>&nbsp;
                                
                             
                             
              </div>
              
              <div class="claer-fix"></div>
    </div>
    
    
   <div class="row">
            


          <div class="table-responsive"> 
                            <div class="alert alert-success">
                      <strong>Updated!</strong> Data updated succesfully.
                    </div>
              
             
          
          
            
            
          
           
              









     

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
         
                     <tr>
                        <td >99</td>
                        <td >dfbdfb</td>
                        <td >dfbdfb</td>
                        <td ></td>
                        <td > 
                       </td>
                         
                        <td ><p><strong>Rajesh kumar</strong></p></td>
                        <td >
                          <p><strong>Julius Lim</p>

                        </td>
                        <td>                                  <form id="updateFormId99" name="updateForm99" action="listwork_activity.php" method="get" >
                                      <input name="riskid" value="99" type="hidden">

                                       <input name="updateStatus" value="2" type="hidden">

                                     
                                       
                                       <input disabled="disabled" type="submit" name="updateStatusSubmit" value="Click to approve" class="btn btn-danger btn-sx"> 
                                        
                                    

                                  
                                  
                                 &nbsp;<a href="divAddRemoveSubmitEdit.php?riskid=99" style="text-decoration: none"><input  type="button" name="updateStatusSubmit" value="Edit" class="btn btn-warning btn-sx" style="width:15%"></a>
                                  
                                  &nbsp;<a href="companyreport.php?riskid=99" style="text-decoration: none"><input  type="button" name="updateStatusSubmit" value="View" class="btn btn-warning btn-sx"  style="width:15%" ></a>

  &nbsp;<a href="copydata.php?riskid=99" style="text-decoration: none">
 <input  type="button" name="updateStatusSubmit" value="Copy" class="btn btn-warning btn-sx"  style="width:15%" onclick="return confirm('Are you sure,you want to delete?')" ></a>


                                  </form>
                                  </td>
                    </tr>

                           

        </tbody>
    </table>

      </div>
      </div>
      </div>
 

 



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

</body>
    </html>
    