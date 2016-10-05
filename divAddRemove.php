<?php include_once 'header.php';?>
  

  

  <style type="text/css">
    body { padding: 10px;}

.clonedInput { padding: 10px; border-radius: 5px; background-color: #def; margin-bottom: 10px; }

.clonedInput div { margin: 5px; }
  </style>

  <title>jQuery - Clone html and increment id of some elements by mjaric</title>

  
    




<script type='text/javascript'>//<![CDATA[
$(window).load(function(){
var regex = /^(.+?)(\d+)$/i;
var cloneIndex = $(".clonedInput").length;

function clone(){
    $(this).parents(".clonedInput").clone()
        .appendTo(".cosf1")
        .attr("id", "clonedInput" +  cloneIndex)
        .find("*")
        .each(function() {
            var id = this.id || "";
            var match = id.match(regex) || [];
            if (match.length == 3) {
                this.id = match[1] + (cloneIndex);
            }
        })
        .on('click', 'button.clone', clone)
        .on('click', 'button.remove', remove);
    cloneIndex++;
}
function remove(){
    $(this).parents(".clonedInput").remove();
}
$("button.clone").on("click", clone);

$("button.remove").on("click", remove);
});//]]> 

</script>




<div>

   <form>

        <div class="col-sm-12 form_pad">
                <h3>Add a New Risk Assessment</h3>
                <hr class="add_risk">
                <div class="col-sm-12 form-row">
                            <div class="col-sm-6">
                              <label class="col-sm-4">Staff Name:</label>
                              <label class="col-sm-8">Michael Ong</label>
                            </div>
                </div>

                <div class="col-sm-12 form-row">
                          <div class="col-sm-6">

                            <label class="col-sm-4">Company:</label>
                            <label class="col-sm-8">ABC Aircon Pte Ltd</label>
                          </div>

                          <div class="col-sm-6">

                            <label class="col-sm-4">Reference No:</label>
                            <label class="col-sm-8">0001</label>

                          </div>                                           
                </div>
                        

                <div class="col-sm-12 form-row">
                          <div class="col-sm-6">

                            <label class="col-sm-4">Loaction:</label>
                            <label class="col-sm-8"><input class="span4" type="text" id="inputSaving" placeholder=""></label>
                          </div>

                          <div class="col-sm-6">

                            <label class="col-sm-4">Creation Date:</label>
                            <label class="col-sm-8">5-Dec-15</label>

                          </div>                                           
                </div>


                <div class="col-sm-12 form-row">
                            <div class="col-sm-6">
                              <label class="col-sm-4">Risk Process:</label>
                              <label class="col-sm-8">
                                <input class="span4" type="text" id="inputSaving" placeholder="">
                              </label>
                            </div>
                </div>

        </div>

    
    <div class="cosf">    
        <div id="clonedInput1" class=" col-sm-12 form_pad clonedInput">
                    <div class="col-sm-12">
                       <div class="col-sm-8"><h3>Work Activity 1</h3></div>
                       
                       <div class="col-sm-4">
                          <button class="btn btn-success clone" id="add_new_work">+ Add a new work activity</button> 
                          <button class="btn btn-danger pull-right remove">Remove</button>
                       </div>

                    </div>

                    <div class="col-sm-12 form-below form_margin">
                        <hr class="add_risk" />
                        <div class="col-sm-6 form-row">
                            <label class="col-sm-4">Work Activity Name:</label>
                            <input class="col-sm-8" type="text" id="inputSaving" name="work_activity[]" value="<?php echo $name;?> " placeholder="" required>
                        </div>
                               
                    </div>
                    <hr class="add_activity"/>
        </div>
    </div>  

    <div class="cosf1">
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
                    <button class="button" name="save_draft"><strong>Save as Draft</strong></button><button class="button_cancel"><strong>Cancel</strong></button><button class="button_next"><strong>Next</strong></button>
                </div>
            </div>
        </div>
            
        </div>

</div>
 </form> 
  
 <?php include_once 'footer.php';?>