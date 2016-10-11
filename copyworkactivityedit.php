<div style="display: none" id="toCopyDiv">
      <div id="clonedInput1"  class=" col-sm-12 form_pad clonedInput repeatingSection tocopy">
      <input type="hidden" name="workactivity_a_id_1" id="workactivity_a_id_1" value="1" />
      <input type="hidden" name="hazardsCount[]" id="hazardsCount" value="1" />


        <div class="col-sm-7" id="workActivityNameCopy"><h3 class="workActivityNameCopy">Work Activity</h3></div>
		<div class="col-sm-5">
           <button class="col-sm-5 btn btn-success addWorkActivity" id="add_new_work" style="margin-top:15px;">+ Add a new work activity</button>

           <button class="col-sm-5 btn btn-danger deleteWorkActivity" style="margin-left:5px; margin-top:15px;">Remove work activity</button>
        </div>



                    <div class="col-sm-12">
                        <hr class="add_risk" />
                        <div class="col-sm-12 form-row">
                            <label class="col-sm-3" style="padding-left:0px;">Work Activity Name:</label>
                            <input class="col-sm-8" type="text" id="inputSaving" name="work_activity[]" value="" placeholder="" required>
                        </div>
                       <div class="clearfix"></div>
                       <hr class="add_activity"/>

                    </div>

                  <div class="col-sm-12 hazardSection hazardSectionCopy">



                        <div class="col-sm-6">
                          <div class="row">
                            <label class="col-sm-6">Hazard:</label>
                          <select class="col-sm-6" name="Hazard[]"  id="get_injury_dynamic" >
                            	<option value="">Choose Hazard</option>
                                <?php
								foreach($harzard as $harzard_key => $harzard_value)
								{
									echo "<option value=\"".$harzard_key."\">".$harzard_value."</option>";
								}
								?>


                            </select>
                            <div class="ajax_loader" style="display:none;position: absolute;right: 0;">
                            	<img src="ajax-loader.gif" />
                            </div>
                          </div>
                          <div class="form-row other_hazard" style="display:none">
                            <label style=" float: left;width: 100%;" >If others, please specify</label>
                            <input style="width: 82%;float: left;margin: 0px 5px 5px 0px;"  type="text" class="with_textbox_value c_t_h_1" name="HazardOther[]" value=""/>
                          </div>
                           <div class="generate_dynamic_content">
                           <select class="col-sm-6" name="InjuryAccident[]"  style="display:none;">
                          <option value="">Choose InjuryAccident</option>';
                          </select>
                           </div>
                          <div class="row">
                            <label class="col-sm-6">Severity:</label>

                            <select class="severity col-sm-6 btn btn-default" id="inputSaving" name="severity[]">
                              <option value="-">Select severity</option>
                              <option value="5">(5) Catastrophic</option>
                              <option value="4">(4) Major</option>
                              <option value="3">(3) Moderate</option>
                              <option value="2">(2) Minor</option>
                              <option value="1">(1) Negligible</option>
                            </select>


                          </div>

                          <div class="row">
                            <label class="col-sm-6">Likelihood:</label>
                            <select class="likelihood col-sm-6 btn btn-default " id="inputSaving" name="likelihood[]">
                              <option value="-">Select likelihood</option>
                              <option value="5">(5) Almost Certain</option>
                              <option value="4">(4) Frequent</option>
                              <option value="3">(3) Occasional</option>
                              <option value="2">(2) Remote</option>
                              <option value="1">(1) Rare</option>
                            </select>
                          </div>

                          <div class="row">
                            <label class="col-sm-6">Action Date:</label>
                            <select class="col-sm-2 btn btn-default" id="inputSaving" name="actionDate[]">
                               <?php for ($i=1; $i < 32; $i++)
                              {
                                # code...
                                ?>
                                  <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                <?php
                              }
                             ?>
                            </select>

                            <select class="col-sm-2 btn btn-default" id="inputSaving" name="actionMonth[]">
                              <?php for ($i=1; $i < 13; $i++)
                              {
                                # code...
                                ?>
                                  <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                <?php
                              }
                             ?>
                            </select>

                            <select class="col-sm-2 btn btn-default" id="inputSaving" name="actionYear[]">
                              <?php for ($i=2016; $i < 2025; $i++)
                              {
                                # code...
                                ?>
                                  <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                <?php
                              }
                             ?>

                            </select>

                          </div>

                        </div>






                        <div class="col-sm-6">



                          <div class="row">
                            <label class="col-sm-6">Risk Level:</label>
                            <label class="col-sm-6 riskLevel"></label>

                          </div>

                          <div class="row">
                            <label class="col-sm-6">Additional Risk Control:</label>

                            <textarea class="col-sm-6" type="text" id="inputSaving" name="additionalRiskContro[]" rows="5"></textarea>


                          </div>
                          <div class="clearfix"></div>

                          <div class="row">
                            <label class="col-sm-6">Severity:</label>

                            <select class="severitysecond col-sm-6 btn btn-default" id="inputSaving" name="severitySecond[]">
                            <option value="-">Select severity</option>
                               <option value="5">(5) Catastrophic</option>
                              <option value="4">(4) Major</option>
                              <option value="3">(3) Moderate</option>
                              <option value="2">(2) Minor</option>
                              <option value="1">(1) Negligible</option>
                            </select>


                          </div>

                          <div class="row">
                            <label class="col-sm-6">Likelihood:</label>
                            <select class="likelihoodsecond col-sm-6 btn btn-default " id="inputSaving" name="likelihoodSecond[]">
                              <option value="-">Select likelihood</option>
                              <option value="5">(5) Almost Certain</option>
                              <option value="4">(4) Frequent</option>
                              <option value="3">(3) Occasional</option>
                              <option value="2">(2) Remote</option>
                              <option value="1">(1) Rare</option>
                            </select>
                          </div>







                        </div>
                       <div class="clearfix"></div>


                       <hr class="add_activity"/>

                      <div>
                       <input type="hidden" name="hazardsActionOfficerCount[]" id="hazardsActionOfficerCount" value="1" />
<div id="clonedInput1" class="row repeatingActionOfficer">

     <div class="col-sm-6">
        <div class="row">
          <label class="col-sm-6">Action Officer:</label>
            <select name="actionOfficer[]"   class="col-sm-6 action_officers" >
                <option value="-">Select Action Officer</option>
                <option value="action_officer1">Action officer 1</option>
                <option value="action_officer2">Action officer 2</option>
                <option value="action_officer3">Action officer 3</option>
                <option value="action_officer4">Action officer 4</option>
                <option value="action_officer5">Action officer 5</option>
            </select>

         </div>
      </div>

</div>
                      </div>


                      <div class="clearfix"></div>
                      <hr class="add_activity"/>


                        <div class="clearfix"></div>


                       <div class="clearfix"></div>
                       <button class="col-sm-2 btn btn-success addHazards" id="add_new_work">+ Add hazards</button>
                       <button class="col-sm-2 btn btn-danger pull-right deleteHazards">Remove Hazards</button>
                      <div class="clearfix"></div>
                        <hr class="add_activity"/>
                  </div>
          </div>

</div>
