<?php session_start();
include 'header.php';
if(empty($_SESSION['email']))
{
	header("location:login.php");
}
?>
 
      <div class="container" style="border:2px solid black;">
      
      
            <h3>Risk Register Summary</h3>
            
            
            <a href="riskmange.php">  <button class="button_new_risk"><strong>+ Add A Risk Assessment</strong></button></a>
          
            
            
           <div class="upper_data">
           <label class="out_1"> Outstanding (10)</label>
           <label class="out_2"> Draft (2) </label>
           <label class="out_3"> Approved (4) </label>
           <label class="out_4"> Archived (10) </label>
           </div>
      
        <div class="table-responsive"> 
      <div class="bs-example">
    <table id="tblContact"  class="table table-bordered table table-striped">
  
        <thead>
          <tr>Company: ABC Aircon Pte Ltd</tr>
                    <tr>
                <th class="heading">Ref No.</th>
                <th  class="heading">Risk Location</th>
                <th  class="heading">Risk Process</th>
                <th  class="heading">Approval Date</th>
                
                <th class="heading">Next Review Date</th>
                <th class="heading">RA Leader & Designation</th>
                <th class="heading">Status</th>
                
            </tr>
        </thead>
        <tbody id="myTable">
            <tr>
                <td >1</td>
                <td>Retail Store</td>
                <td>Working at Height</td>
                <td>2-Dec-15</td>
                <td>2-Dec-18</td>
                <td>Michael OngJames Tan</td>
                <td class="awating">Awaiting Approval</td>
                
            </tr>
            <tr>
                <td>2</td>
                <td>Retail Store</td>
                <td>Manual Handling</td>
                <td>3-Dec-15</td>
                <td>3-Dec-18</td>
                <td>Michael OngJames TanKris Tan</td>
                <td class="awating">Awaiting Approval</td>
            </tr>
            <tr>
                <td>3</td>
                <td>HQ Office</td>
                <td>Office Work</td>
                <td>4-Dec-15</td>
                <td>4-Dec-18</td>
                <td>Lisa Lee</td>
                <td class="awating">Awaiting Approval</td>
            </tr>
              <tr>
                <td>4</td>
                <td>Warehouse</td>
                <td>Carrying of Goods</td>
                <td>5-Dec-15</td>
                <td>5-Dec-18</td>
                <td>James Tan</td>
                <td class="awating">Awaiting Approval</td>
            </tr>
              <tr>
                <td>5</td>
                <td>Warehouse</td>
                <td>Packing of Goods</td>
                <td>5-Dec-15</td>
                <td>5-Dec-18</td>
                <td>James Tan</td>
                <td class="awating">Awaiting Approval</td>
            </tr>
              <tr>
                <td>6</td>
                <td>Warehouse</td>
                <td>Operating of Fork Lift</td>
                <td>5-Dec-15</td>
                <td>5-Dec-18</td>
                <td>Mike WongJames Tan</td>
                <td class="awating">Awaiting Approval</td>
            </tr>
              <tr>
                <td>7</td>
                <td>Warehouse</td>
                <td>Grinding Operation</td>
                <td>5-Dec-15</td>
                <td>5-Dec-18</td>
                <td>James Tan</td>
                <td class="awating">Awaiting Approval</td>
            </tr>
            <div />
        </tbody>
    </table>

      </div>
      
        <div class="col-md-12 text-center">
      <ul class="pagination pagination-lg pager" id="myPager"></ul>
      </div>
      
      </div>
           
         <?php
		 include 'footer.php';
		 ?>