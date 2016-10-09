<?php session_start(); include_once 'header.php';

if(!$_SESSION['adminid'])
{
    ?><script type="text/javascript">window.location.assign("index.php")</script>
    <?php
}
$harzard = array(
	"w_h_l_3m"	=> "Hazard -Working at height (less than 3m)",
	"w_h_m_3m"	=> "Working at height (more than 3m)",
	"p_h_s_o"	=> "Physical hazards (sharp objects)",
	"c_h"		=> "Chemical hazards",
	"f_o"		=> "Falling objects",
	"e_h"		=> "Electrical hazard",
	"e_r_h"		=> "Ergonomic hazards",
	"s_t_f_h"	=> "Slip,trip fall",
	"c_s_h" 	=> "Confined space",
	"f_h"		=> "Fire Hazard",
	"g_h"		=> "Gas Hazard",
  "b_w" => "Bad Weather",
  "w_u_q_t" => "Working/unloading with traffic",
  "r_d" => "Reckless driving",
  "h_l_b_m_h" => "Heavy load by manual handling",
  "m_o_u_g" => "material on uneven ground (collapsing)",
  "w_a_h_b" => "Working at height (using boomlift)",
  "w_a_h_s" => "Working at height (using sisscor lift)",
  "w_a_h_sf" => "Working at height (using scaffold)",
  "p_p_f_l_o" => "Poor planning for lfting operation",
  "f_p" => "Flying particles"
);
?>
  <style type="text/css">
    body { padding: 10px;}
    .clonedInput { padding: 10px; border-radius: 5px; background-color: #def;}



    .red
    {
      color: red;
      font-size: 17px;
      font-weight: bolder;
    }
    .green
    {
      color: green;
      font-size: 17px;
      font-weight: bolder;
    }
    .yellow
    {
      color: yellow;
      font-size: 17px;
      font-weight: bolder;
    }

	.ui-datepicker-header ui-widget-header ui-helper-clearfix ui-corner-all
	{
		width:327;
	}

  </style>
<script type='text/javascript'>//<![CDATA[
$(window).load(function(){
// Add a new repeating section
var attrs = ['for', 'id', 'value', 'select'];
function resetAttributeNames(section) {
    var tags = section.find('input, label'), idx = section.index();
    tags.each(function() {
      var $this = $(this);
      $.each(attrs, function(i, attr) {
        var attr_val = $this.attr(attr);
        if (attr_val) {
            $this.attr(attr, attr_val.replace(/_\d+$/, '_'+(idx + 1)));



        }

      })


    })
}

function resetHazaradsAttributeNames(section) {
    var tags = section.find('input, label'), idx = section.index();
    tags.each(function() {
      var $this = $(this);
      $.each(attrs, function(i, attr) {
        var attr_val = $this.attr(attr);
        if (attr_val) {
            $this.attr(attr, attr_val.replace(/_\d+$/, '_'+(idx + 1)));



        }
      })


    })
}

$('.addMember').click(function(e){
        e.preventDefault();
        var MemberCount = $('#RA_MemberCount').val();
        if(MemberCount >= 5)
        {
           alert("You can't add more than 5 RA Member");
            return;
        }

        var toRepeatingGroup = $('.repeatingMember').first();
        var lastRepeatingGroup = $('.repeatingMember').last();
        var cloned = toRepeatingGroup.clone(true);
        cloned.insertAfter(lastRepeatingGroup);


        resetAttributeNames(cloned);



        var newMemberCount = parseInt(MemberCount) +1;
        $('#RA_MemberCount').val(newMemberCount);

    });


    $('.deleteMember').click(function(e){
        e.preventDefault();
        var current_fight = $(this).parent('div');
        var other_fights = current_fight.siblings('.repeatingMember');
        if (other_fights.length === 0) {
            alert("You should atleast have one RA Member");
            return;
        }
        current_fight.slideUp('slow', function() {
            current_fight.remove();
            var MemberCount = $('#RA_MemberCount').val();
            var newMemberCount = parseInt(MemberCount) -1;
            $('#RA_MemberCount').val(newMemberCount);
            // reset fight indexes
            other_fights.each(function() {
               resetAttributeNames($(this));
            })

        })



    });



$('.addWorkActivity').click(function(e){
        e.preventDefault();
        var toRepeatingGroup = $('.tocopy').first();
        var lastRepeatingGroup = $('.repeatingSection').last();
        var cloned = toRepeatingGroup.clone(true);
		var workactivityCount = $('#workactivityCount').val();
        var newworkactivityCount = parseInt(workactivityCount) +1;
        $('#workactivityCount').val(newworkactivityCount);

		var nextHzardsCounts =1;
	   cloned.find(".generate_dynamic_content").html("<div id=\"dynamic_data_control_injuery_"+newworkactivityCount+"_"+nextHzardsCounts+"\"></div>") ;
	   cloned.find("#get_injury_dynamic").attr("onchange","get_injuery(this,this.value,'dynamic_data_control_injuery_"+newworkactivityCount+"_"+nextHzardsCounts+"',"+newworkactivityCount+","+nextHzardsCounts+");");
	   cloned.find(".severity").removeAttr("id");
	   cloned.find(".severity").attr('id',"change_severity_"+newworkactivityCount+"_"+nextHzardsCounts);

	    cloned.find(".likelihood").removeAttr("id");
	   cloned.find(".likelihood").attr('id',"change_likehood_"+newworkactivityCount+"_"+nextHzardsCounts);


	    cloned.find(".head_title").html("Work Activity "+newworkactivityCount);
	    cloned.insertAfter(lastRepeatingGroup);

        resetAttributeNames(cloned);



    });



$('.addHazards').click(function(e){
        e.preventDefault();

        var currentHazardCounts = $(this).parent().parent().find('#hazardsCount').val();
        var nextHzardsCounts = parseInt(currentHazardCounts) + 1;
        $(this).parent().parent().find('#hazardsCount').val(nextHzardsCounts);

        var workactivityCount = $('#workactivityCount').val();



        var lastRepeatingGroup = $('.hazardSectionCopy').first();
        var cloned = lastRepeatingGroup.clone(true)
	 cloned.find(".generate_dynamic_content").html("<div id=\"dynamic_data_control_injuery_"+workactivityCount+"_"+nextHzardsCounts+"\"></div>") ;
	    cloned.find("#get_injury_dynamic").attr("onchange","get_injuery(this,this.value,'dynamic_data_control_injuery_"+workactivityCount+"_"+nextHzardsCounts+"',"+workactivityCount+","+nextHzardsCounts+");");
		 cloned.find(".severity").removeAttr("id");
	   cloned.find(".severity").attr('id',"change_severity_"+workactivityCount+"_"+nextHzardsCounts);

	    cloned.find(".likelihood").removeAttr("id");
	   cloned.find(".likelihood").attr('id',"change_likehood_"+workactivityCount+"_"+nextHzardsCounts);

        cloned.insertAfter($(this).parent('div'));
        resetHazaradsAttributeNames(cloned)
    });

$('.addActionMember').click(function(e){
        e.preventDefault();

        var currentHazardsActionOfficerCount = $(this).parent().parent().find('#hazardsActionOfficerCount').val();

        if(currentHazardsActionOfficerCount >= 5)
        {
           alert("You can't add more than 5 Action Officers");
            return;
        }

        var nextHazardsActionOfficerCount = parseInt(currentHazardsActionOfficerCount) + 1;
        $(this).parent().parent().find('#hazardsActionOfficerCount').val(nextHazardsActionOfficerCount);




        var lastRepeatingGroup = $('.repeatingActionOfficer').last();
        var cloned = lastRepeatingGroup.clone(true)


        cloned.insertAfter($(this).parent('div'));
        resetHazaradsAttributeNames(cloned)
    });

$('.deleteActonOfficer').click(function(e){
        e.preventDefault();
        var current_fight = $(this).parent('div');
        var other_fights = current_fight.siblings('.repeatingActionOfficer');
        if (other_fights.length === 0) {
            alert("You should atleast have one Action officer Member");
            return;
        }
        current_fight.slideUp('slow', function() {
              var currentHazardsActionOfficerCount = $(this).parent().parent().find('#hazardsActionOfficerCount').val();
             var nextHazardsActionOfficerCount = parseInt(currentHazardsActionOfficerCount) - 1;
            $(this).parent().parent().find('#hazardsActionOfficerCount').val(nextHazardsActionOfficerCount);
            current_fight.remove();


            // reset fight indexes
            other_fights.each(function() {
               resetAttributeNames($(this));
            })

        })



    });

// Delete a repeating section
$('.deleteWorkActivity').click(function(e){
        e.preventDefault();
        var current_fight = $(this).parent('div');
        var other_fights = current_fight.siblings('.repeatingSection');
        if (other_fights.length === 0) {
            alert("You should atleast have one workactivity");
            return;
        }
        current_fight.slideUp('slow', function() {
            current_fight.remove();

            // reset fight indexes
            other_fights.each(function() {
               resetAttributeNames($(this));
            })

        })
        var workactivityCount = $('#workactivityCount').val();
        var newworkactivityCount = parseInt(workactivityCount) -1;
        $('#workactivityCount').val(newworkactivityCount);


    });








// Delete a repeating section
$('.deleteHazards').click(function(e){
        e.preventDefault();

        var current_fight = $(this).parent('div');
        var other_fights = current_fight.siblings('.hazardSection');
        if (other_fights.length === 0) {
            alert("You should atleast have one hazards");
            return;
        }
        current_fight.slideUp('slow', function() {
            current_fight.remove();

            // reset fight indexes
            other_fights.each(function() {
               resetAttributeNames($(this));
            })

        })

        var currentHazardCounts = $(this).parent().parent().find('#hazardsCount').val();
        var nextHzardsCounts = parseInt(currentHazardCounts) - 1;
        $(this).parent().parent().find('#hazardsCount').val(nextHzardsCounts);


    });




$(".date").datepicker();

//likelihood chnage
$('.likelihood').on('change', function()
{
  var likelihood = parseInt(this.value);
      var severity  =  parseInt($(this).parent().siblings().find('.severity').val());
      var riskValue = likelihood * severity;


     if(riskValue > 0 && riskValue < 4)
     {
        var htmlRisk = '<span class="green">Low Risk</span>';

     }
     else if(riskValue > 3 && riskValue < 13)
     {
        var htmlRisk = '<span class="yellow">Medium Risk</span>';
     }
     else if(riskValue > 13 && riskValue < 26)
     {
        var htmlRisk = '<span class="red">High Risk - Additional Risk Control is required below</span>';
     }
     else
     {
        var htmlRisk = '';
     }

 //alert(htmlRisk+$(this).parent().parent().siblings().find('.riskLevel').html());



 $(this).parent().parent().siblings().find('.riskLevel').empty().append(htmlRisk);


});


$('.severity').on('change', function()
{
	   // or $(this).val()
	  var severity = parseInt(this.value);
	  var likelihood  =  parseInt($(this).parent().siblings().find('.likelihood').val());
	  var riskValue = likelihood * severity;


	 if(riskValue > 0 && riskValue < 4)
	 {
	    var htmlRisk = '<span class="green">Low Risk</span>';

	 }
	 else if(riskValue > 3 && riskValue < 13)
	 {
	 	var htmlRisk = '<span class="yellow">Medium Risk</span>';
	 }
	 else if(riskValue > 13 && riskValue < 26)
	 {
	 	var htmlRisk = '<span class="red">High Risk - Additional Risk Control is required below</span>';
	 }
	 else
	 {
	 	var htmlRisk = '';
	 }


 //alert(htmlRisk+$(this).parent().parent().siblings().find('.riskLevel').html());



 $(this).parent().parent().siblings().find('.riskLevel').empty().append(htmlRisk);

});

 $(document).on("click",'.add_others',function(e){
	var work_activity = $(this).attr('data-wrk');
	var hazards = $(this).attr('data-haz');
	var add_others = $('#add_others_'+work_activity+'_'+hazards+'>input').length +1;
	$('#add_others_'+work_activity+'_'+hazards).append('<label style=" float: left;width: 100%;" class="c_t_'+add_others+'">If others, please specify</label><input style="width: 82%;float: left;margin: 0px 5px 5px 0px;"  type="text" class="with_textbox_value c_t_'+add_others+'" name="ExistingRiskControl['+work_activity+']['+hazards+'][c_t_'+add_others+']" value=""/><a style=" float:left;" href="javascript:void(0)" class="btn btn-danger c_t_'+add_others+' remove_other_data" data-id ="add_others_'+work_activity+'_'+hazards+'" data-remove="c_t_'+add_others+'"> Remove</a> <br />');
	});

$(document).on("click",".remove_other_data",function(e){
	var data_remove = $(this).attr("data-remove");
	var data_id = $(this).attr("data-id");
	$("#"+data_id+" ."+data_remove).remove();

});



/*$('.date').each(function(e){

  attrName = $(this).attr("id");
alert(attrName);
    $(this).datepicker();
});*/


});//]]>

</script>



<div class="container" style="border:2px solid black;">

<form method="post" action="riskmange.php" class="inlineForm" enctype="multipart/form-data" >


  <input type="hidden" name="RA_MemberCount" id="RA_MemberCount" value="1" />
   <input type="hidden" name="workactivityCount" id="workactivityCount" value="1" />


      <div class="col-sm-12 form_pad">
                <h3>Add a New Risk Assessment</h3>
                <hr class="add_risk">
                <div class="col-sm-12 form-row">
                            <div class="col-sm-6">
                              <label class="col-sm-4">RA Leader:</label>
                              <label class="col-sm-8"><?php echo $_SESSION['name']; ?></label>
                            </div>
                </div>

                <div class="col-sm-12 form-row">
                          <div class="col-sm-6">

                            <label class="col-sm-4">Company:</label>
                            <label class="col-sm-8">Armada Aluminum Renovation Construction Pte Ltd</label>
                          </div>

                          <div class="col-sm-6">

                            <label class="col-sm-4">Reference No:</label>
                            <label class="col-sm-8">0000 (Ref. No. will be auto generated when saved.)</label>

                          </div>
                </div>


                <div class="col-sm-12 form-row">
                          <div class="col-sm-6">

                            <label class="col-sm-4">Risk Location:</label>
                            <label class="col-sm-8">
                              <input name="location" class="span4" type="text" id="inputSaving" placeholder="" required></label>
                          </div>

                          <div class="col-sm-6">

                            <label class="col-sm-4">Creation Date:</label>
                            <label class="col-sm-8">
                               <input name="creationDate" class="span4 date" type="text" id="creationDate" placeholder="" required></label>


                            </label>

                          </div>
                </div>


                <div class="col-sm-12 form-row">
                            <div class="col-sm-6">
                              <label class="col-sm-4">Risk Process:</label>
                              <label class="col-sm-8">
                                <input name="process" class="span4" type="text" id="inputSaving" placeholder="" required>
                              </label>
                            </div>
                            <div class="col-sm-6">
                              <label class="col-sm-4 compulsary">Expiry Date:</label>
                              <select  name="expiry_date">
                                <option value="1" selected>1</option>
                                <option value="2" >2</option>
                                <option value="3" >3</option>
                              </select>
                              <span>year(s)</span>
                            </div>

                </div>
                <div class="col-sm-12"> <hr class="add_activity"></div>


               <div class="col-sm-12 form-row">

                  <button class="col-sm-2 btn btn-primary addMember" id="add_new_member">
                    +Add RA Member</button>

               </div>

                <div class="clear-fix"></div>



                <div id="clonedInput1" class=" col-sm-12 form-row clonedInput repeatingMember">

                    <div class="col-sm-6">
                        <label class="col-sm-4">RA Members:</label>
                        <label class="col-sm-8">
                        <?php /*?><input  name="RA_Member[]" class="span4" type="text" id="inputSaving" placeholder=""><?php */?>
                        <select name="RA_Member[]" class="span4" id="inputSaving" required>
                         <option value="">-- Select RA members --</option>
                        <option value="name1">W. K. Chan</option>
                        <option value="name2">Liang Kan Fat</option>

                        </select>
                        </label>
                    </div>
                    <button class="col-sm-1 btn btn-danger deleteMember">Remove</button>

              </div>






<div class="col-sm-12"> <hr class="add_risk"></div>

<div style="display:none" id="toCopyDiv">
      <div id="clonedInput1"  class=" col-sm-12 form_pad clonedInput repeatingSection tocopy">

              <div class="col-sm-7"><h3 class="head_title">Work Activity 2 </h3></div>

                   <button class="col-sm-2 btn btn-success addWorkActivity" id="add_new_work">+ Add a new work activity</button>

                   <input type="hidden" name="workactivity_a_id_1" id="workactivity_a_id_1" value="1" />
                   <input type="hidden" name="hazardsCount[]" id="hazardsCount" value="1" />




                  <button class="col-sm-2 btn btn-danger  deleteWorkActivity " style="margin-left:5px;">Remove work action</button>


                    <div class="col-sm-12">
                        <hr class="add_risk" />
                        <div class="col-sm-6 form-row">
                            <label class="col-sm-6">Work Activity Name:</label>
                            <input class="col-sm-6" type="text" id="inputSaving" name="work_activity[]" value="<?php echo $name;?>" placeholder="" required>
                        </div>
                       <div class="clearfix"></div>
                       <hr class="add_activity"/>

                    </div>

                  <div class="col-sm-12 hazardSection hazardSectionCopy">



                        <div class="col-sm-6 form-row">
                          <div class="form-row">
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
                          <div class="generate_dynamic_content">
                          <select class="col-sm-6" name="InjuryAccident[]" >
                          <option value="">Choose InjuryAccident</option>';
                          </select>
                          </div>

                          <div class="form-row">
                            <label class="col-sm-6">Severity:</label>

                            <select class="severity col-sm-6 btn btn-default  " id="change_severity" name="severity[]">
                              <option value="-">Select severity</option>
                              <option value="5">(5) Catastrophic</option>
                              <option value="4">(4) Major</option>
                              <option value="3">(3) Moderate</option>
                              <option value="2">(2) Minor</option>
                              <option value="1">(1) Negligible</option>
                            </select>


                          </div>

                          <div class="form-row">
                            <label class="col-sm-6">Likelihood:</label>
                            <select class="likelihood col-sm-6 btn btn-default " id="change_likehood" name="likelihood[]">
                              <option value="-">Select likelihood</option>
                              <option value="5">(5) Almost Certain</option>
                              <option value="4">(4) Frequent</option>
                              <option value="3">(3) Occasional</option>
                              <option value="2">(2) Remote</option>
                              <option value="1">(1) Rare</option>
                            </select>
                          </div>

                          <div class="form-row">
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






                        <div class="col-sm-6 form-row">



                          <div class="form-row">
                            <label class="col-sm-4">Risk Level:</label>
                            <label class="col-sm-8 riskLevel"></label>

                          </div>

                          <div class="form-row">
                            <label class="col-sm-6">Additional Risk Control:</label>

                            <textarea class="col-sm-6" type="text" id="inputSaving" name="additionalRiskContro[]" style="height:65px;"></textarea>


                          </div>
                          <div class="clearfix"></div>

                          <div class="form-row">
                            <label class="col-sm-6">Severity:</label>

                            <select class="severitysecond col-sm-6 btn btn-default  " id="inputSaving" name="severitySecond[]">
                            <option value="-">Select severity</option>
                               <option value="5">(5) Catastrophic</option>
                              <option value="4">(4) Major</option>
                              <option value="3">(3) Moderate</option>
                              <option value="2">(2) Minor</option>
                              <option value="1">(1) Negligible</option>
                            </select>


                          </div>

                          <div class="form-row">
                            <label class="col-sm-6">Likelihood:</label>
                            <select class="likelihoodsecond col-sm-6 btn btn-default  " id="inputSaving" name="likelihoodSecond[]">
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



                       <div class="col-sm-12 form-row">
                             <input type="hidden" name="hazardsActionOfficerCount[]" id="hazardsActionOfficerCount" value="1" />
                                <div class="row col-sm-12 form-row">

                                    <button class="col-sm-2 btn btn-primary addActionMember" id="add_new_member">+Action Officer</button>
                                </div>
                                <div id="clonedInput1" class="row repeatingActionOfficer">

                                    <div class="col-sm-6">

                                        <label class="col-sm-6">Action Officer:</label>
                                          <select name="actionOfficer[]"   class="col-sm-6" >
                                            <option value="-">Select Action Officer</option>
                                            <option value="name1">W. K. Chan</option>
                                            <option value="name2">Liang Kan Fat</option>
                                        </select>
                                    </div>
                                     <button class="col-sm-1 btn btn-danger deleteActonOfficer" style="margin-left:20px;">Remove</button>
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

          <div id="clonedInput1" class=" col-sm-12 form_pad clonedInput repeatingSection">

              <div class="col-sm-7"><h3>Work Activity 1</h3></div>

                   <button class="col-sm-2 btn btn-success addWorkActivity" id="add_new_work">+ Add a new work activity</button>

                   <input type="hidden" name="workactivity_a_id_1" id="workactivity_a_id_1" value="" />
                   <input type="hidden" name="hazardsCount[]" id="hazardsCount" value="1" />




                  <button class="col-sm-2 btn btn-danger deleteWorkActivity" style="margin-left: 5px;">Remove work activity</button>


                    <div class="col-sm-12">
                        <hr class="add_risk" />
                        <div class="col-sm-6 form-row">
                            <label class="col-sm-6" >Work Activity Name:</label>
                            <input class="col-sm-6" type="text" id="inputSaving" name="work_activity[]" value="" placeholder="" required>
                        </div>
                       <div class="clearfix"></div>
                       <hr class="add_activity"/>

                    </div>

                  <div class="col-sm-12 hazardSection">



                        <div class="col-sm-6 form-row">
                          <div class="form-row">
                            <label class="col-sm-6">Hazard:</label>
                            <select class="col-sm-6" name="Hazard[]"  onchange="get_injuery(this,this.value,'dynamic_data_control_injuery_1_1',1,1);">
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
                        <div id="dynamic_data_control_injuery_1_1">

                       	</div>

                          <div class="form-row">
                            <label class="col-sm-6">Severity:</label>

                            <select class="severity col-sm-6 btn btn-default" id="change_severity_1_1" name="severity[]">
                              <option value="-">Select severity</option>
                              <option value="5">(5) Catastrophic</option>
                              <option value="4">(4) Major</option>
                              <option value="3">(3) Moderate</option>
                              <option value="2">(2) Minor</option>
                              <option value="1">(1) Negligible</option>
                            </select>


                          </div>

                          <div class="form-row">
                            <label class="col-sm-6">Likelihood:</label>
                            <select class="likelihood col-sm-6 btn btn-default  " id="change_likehood_1_1" name="likelihood[]">
                              <option value="-">Select likelihood</option>
                              <option value="5">(5) Almost Certain</option>
                              <option value="4">(4) Frequent</option>
                              <option value="3">(3) Occasional</option>
                              <option value="2">(2) Remote</option>
                              <option value="1">(1) Rare</option>
                            </select>
                          </div>

                          <div class="form-row">
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


                        <div class="col-sm-6 form-row">



                          <div class="form-row">
                            <label class="col-sm-4">Risk Level:</label>
                            <label class="col-sm-8 riskLevel"></label>
                          </div>

                          <div class="form-row">
                            <label class="col-sm-6">Additional Risk Control:</label>

                            <textarea class="col-sm-6" type="text" id="inputSaving" name="additionalRiskContro[]" style="height:65px;"></textarea>


                          </div>
                          <div class="clearfix"></div>

                          <div class="form-row">
                            <label class="col-sm-6">Severity:</label>

                            <select class="severitysecond col-sm-6 btn btn-default " id="inputSaving" name="severitySecond[]">
                              <option value="-">Select severity</option>
                              <option value="5">(5) Catastrophic</option>
                              <option value="4">(4) Major</option>
                              <option value="3">(3) Moderate</option>
                              <option value="2">(2) Minor</option>
                              <option value="1">(1) Negligible</option>
                            </select>


                          </div>

                          <div class="form-row">
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


                            <div class="col-sm-12 form-row">
                             <input type="hidden" name="hazardsActionOfficerCount[]" id="hazardsActionOfficerCount" value="1" />
                                <div class="row col-sm-12 form-row">

                                    <button class="col-sm-2 btn btn-primary addActionMember" id="add_new_member">+Action Officer</button>
                                </div>
                                <div id="clonedInput1" class="row repeatingActionOfficer">

                                    <div class="col-sm-6">

                                        <label class="col-sm-6">Action Officer:</label>
                                        <select name="actionOfficer[]"   class="col-sm-6" >
                                            <option value="-">Select Action Officer</option>
                                            <option value="name1">W. K. Chan</option>
                                            <option value="name2">Liang Kan Fat</option>
                                        </select>
                                    </div>
                                    <button class="col-sm-1 btn btn-danger deleteActonOfficer" style="margin-left:20px;">Remove</button>
                                </div>
                            </div>





                      <div class="clearfix"></div>
                      <hr class="add_activity"/>


                        <div class="clearfix"></div>
                       <button class="col-sm-2 btn btn-success addHazards" id="add_new_work">+ Add hazards</button>
                       <button class="col-sm-2 btn btn-danger pull-right deleteHazards">Remove Hazards</button>
                      <div class="clearfix"></div>
                        <hr class="add_activity"/>
                  </div>
          </div>

        <div class="col-sm-12 form_pad">
            <h3>Declaration of Risk Assessment</h3>
            <hr class="add_risk" />
            <div class="row form-row">
                <div class="col-sm-2"></div>
                <div class="col-sm-10">
                    <label>I hereby confirm that all information above are accurate to my best knowledge.</label>
                </div>
            </div>



            <div class="row form-below">
                <div class="col-sm-2"></div>
                <div class="col-sm-8">
                    <div class=" col-sm-8 btn-right">



                        <input class="btn btn-success draft" type="submit" value="Save as Draft" name="saveAsDraft"  >

                         <input class="btn btn-success draft" type="submit" value="Next" name="saveAsDraft" style="padding-left:30px; padding-right:30px;"  >
                         <input class="btn btn-danger" type="submit" id="cancel" value="Cancel" name="Cancel"   style="padding-left:30px; padding-right:30px;"   >




                    </div>
                </div>
            </div>

        </div>




    </form>
</div>



<script type="text/javascript">
    document.getElementById("cancel").onclick = function () {
        location.href = "listwork_activity.php";
    };
</script>




<script type="text/javascript">

$('.draft').click(function(e){
  $("#toCopyDiv input").prop('required', false);
  $("#toCopyDiv select").prop('required', false);


});
function risk_control(this_value,class_value)
{
	if($(this_value).prop("checked") == true)
	{
		$("."+class_value).prop("checked",true);
	}else
	{
		$("."+class_value).prop("checked",false);
	}

}
  //  $('#edit-submitted-first-name').prop('required', false);
function get_injuery(main,thisvalue,option_id,wrk,haz)
{
	$(main).parent().find(".ajax_loader").css("display","block");
	$.ajax({
		type:"POST",
		url:"get_ajax.php",
		data:{"key_value":thisvalue,wrk_act:wrk,hazard:haz},
		success:function(response){
			$(main).parent().find(".ajax_loader").css("display","none");
			$("#"+option_id).html(response);
		}
	});
}
function servity_hood(main,thisvalue,wrk,haz){
	var servity = $(main).find(':selected').attr('data-servity');
	$('#change_severity_'+wrk+'_'+haz).val(servity);
	$('.severity').trigger('change');
	$('#change_likehood_'+wrk+'_'+haz).val(servity);
	$('.likelihood').trigger('change');
}

</script>
 <?php include_once 'footer.php';?>
