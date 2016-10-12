<?php
include_once 'constant.php';
$output = "";
if($_POST){

	$key_value  = $_POST["key_value"];
	$work_activity = $_POST["wrk_act"];
	$hazard = $_POST["hazard"];

	$e_r_c = $existing_risk_control[$key_value];

	$output .='  <div class="form-row ">
                            <label class="col-sm-6">Possible Injury / Accident:</label>
                            <select class="col-sm-6" name="InjuryAccident[]" onchange="servity_hood(this,this.value,'.$work_activity.','.$hazard.');" >
                            	<option value="">Choose InjuryAccident</option>';
								if($key_value !=""){
									foreach($injury as $key_get_injuery => $value_get_injuery)
									{
										$output .= "<option data-servity=\"".$severity[$key_get_injuery]."\" value=\"".$key_get_injuery."\">".$value_get_injuery."</option>";
									}
								}

                           $output .= '</select>
													 <div id="add_others_injury_'.$work_activity.'_'.$hazard.'"></div>
													 <input type="hidden" name="hazardsOthersInjuryCount[]" id="hazardsOthersInjuryCount" value="1" />
													 <div class="row"><input type="button" class="col-sm-3 btn btn-primary add_others_injury" data-wrk ="'.$work_activity.'" data-haz ="'.$hazard.'" value="Add others"  /></div>
													 </div>
													 ';
						   if($key_value !=""){
						   $output .='<div class="form-row row">
                            <label class="col-sm-6">Existing Risk Control:</label>';
								 			if($key_value ==="other"){
												$output .=' <div class="col-sm-6">
																		<textarea class="col-sm-12" type="text" id="inputSaving" name="ExistingRiskControl['.$work_activity.']['.$hazard.']" rows="5"></textarea>
																		</div>
																	';
											}
											else{
                              $output .=' <div class="col-sm-12">
                                   <div class="checkbox">
                                        <label><input type="checkbox" name="ExistingRiskControl['.$work_activity.']['.$hazard.'][[]" value="select_all" onclick="risk_control(this,\'risk_control_'.$work_activity.'_'.$hazard.'\');">Select All</label>
                                    </div> ';

												 foreach($e_r_c as $key_get_e_r_c  => $value_get_e_r_c)
												{
													$output .= '<div class="checkbox">
				                                        <label><input type="checkbox" class="risk_control_'.$work_activity.'_'.$hazard.'" name="ExistingRiskControl['.$work_activity.']['.$hazard.'][]"  value="'.$key_get_e_r_c.'">'.$value_get_e_r_c.'</label>
				                                    </div>   ';
												}


				                                $output.='<div class="checkbox">
				                                        <label>If others, please specify<input type="text"  class="with_textbox_value" name="ExistingRiskControl['.$work_activity.']['.$hazard.'][c_t]" value=""/>

														</label>

				                                    </div>
													    <div id="add_others_'.$work_activity.'_'.$hazard.'"></div>
													 <input type="button" class="col-sm-3 btn btn-primary add_others" data-wrk ="'.$work_activity.'" data-haz ="'.$hazard.'" value="Add others"  />
				                            </div>';
														}
                          $output .='</div>  ';
	}




}
echo $output;
