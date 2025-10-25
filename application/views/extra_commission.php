<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>


<style>
    .select2-container--default .select2-selection--multiple .select2-selection__choice {
    background-color: #337ab7 !important;
    border: 1px solid #fff;
    border-radius: 4px;
    cursor: default;
    color: #fff;
    float: left;
    margin-right: 5px;
    margin-top: 5px;
    padding: 0 5px;
}
.select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
    color: #fff !important;
    cursor: pointer;
    display: inline-block;
    font-weight: bold;
    margin-right: 2px;
}

</style>

 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1 style="font-size: 17px;">
        Extra Commission Payout
        <button data-toggle="modal" data-target="#add_model" class="btn btn-primary btn-sm pull-right">Add New</button>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-body">
          <div id="table_view"></div>
        </div><!-- /.box-body -->        
      </div><!-- /.box -->

    </section><!-- /.content -->
  </div><!-- /.content-wrapper -->
  
  
   <div class="modal fade in" id="add_model">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true" style="color:white;">×</span></button>
                <h4 class="modal-title text-center">Extra Commission</h4>
            </div>
            <div class="modal-body">
          
            <div class="form-group">
                  <label>Insurance company</label> <span id="add_name_error" style="color: red;">*</span>
                 <select class="form-control select2" name="add_insurer" id="add_insurer" style="width:100%">
                 <option value="">--Select--</option>
                 <?php foreach($insurer_company as $da){ ?>
                    <option value="<?php echo $da->id ?>"><?php echo $da->company_name ?></option>
                <?php } ?>
                </select>
            </div>
                    
             <div class = "row">
                 <div class = "col-md-6">
                    <div class="form-group">
                          <label>Select Agent</label> <span id="add_name_error" style="color: red;">*</span>
                         <select class="form-control select2" name="add_agent" id="add_agent" style="width:100%">
                         <option value="">--Select--</option>
                         <?php foreach($agents as $da){ ?>
                            <option value="<?php echo $da->id ?>"><?php echo $da->name.  "  (".$da->agent_pos_code.")" ?></option>
                        <?php } ?>
                        </select>
                    </div>
                 </div>
                 
                  <div class = "col-md-6">
                    <div class="form-group">
                          <label>Select Month</label> <span id="add_name_error" style="color: red;">*</span>
                          <input type="month" class="form-control" id="add_month" name="add_month">
                    </div>
                 </div>
             </div>
                
                
                <div class = "row">
                    <div class = "col-md-6">
                        <div class="form-group">
                            <label>Policy Type</label>
                            <select class="form-control select2" name="add_policy_type" id="add_policy_type" style="width:100%">
                                <option value="">--Select--</option>
                                <?php foreach($policy_type as $da){ ?>
                                   <option value="<?php echo $da->id ?>"><?php echo $da->policy_type ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class = "col-md-6">
                        <div class="form-group">
                            <label>Policy Cover Type</label>
                            <select class="form-control select2" style="width:100%" name="add_policy_cover_type" id="add_policy_cover_type">
                                <?php foreach($cover as $da){ ?>
                                   <option value="<?php echo $da->id ?>"><?php echo $da->name ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                </div>
                  
                <div class = "row">
                    <div class = "col-md-4">
                        <div class="form-group">
                            <label>Target</label>
                            <select class="form-control" name="add_target" id="add_target">
                                  <option value = "">--Select--</option>
                                  <option value = "Nop">Nop</option>
                                  <option value = "Amount">Amount</option>
                            </select>
                        </div>
                    </div>
                    
                     <div class="form-group col-md-4">
                        <label>Target value</label>
                           <input type = "text" class = "form-control" name="add_target_val" id="add_target_val">
                    </div>
                
                    <div class = "col-md-4">
                    <div class="form-group">
                        <label>Extra Commission(%)</label>
                           <input type = "text" class = "form-control" name="add_extra_com" id="add_extra_com">
                    </div>
                </div>
                </div>  
                
                <div class="form-group">
                    <label>Remarks</label>
                    <textarea class = "form-control" name = "add_remarks" id="add_remarks" rows="4"></textarea>
                </div>
            </div>
            
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-sm btn-primary" id="add_btn">Submit</button>
            </div>
        </div>
    </div>
  </div>
  
  <div class="modal fade in" id="view_model">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true" style="color:white;">×</span></button>
                <h4 class="modal-title text-center">View Commission Details </h4>
            </div>
            <div class="modal-body">
                 <div id = "view_data"></div>
            </div>
            
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-default pull-right" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
  </div>
  
  <script>
       $(document).ready(function(){
           
            $('.select2').select2();
            fetch_commission();
            
            $("#add_btn").click(function(){
                var insurer = $("#add_insurer").val();
                var agent = $("#add_agent").val();
                var month = $("#add_month").val();
                var policy_type = $("#add_policy_type").val();
                var policy_c_type = $("#add_policy_cover_type").val();
                var target = $("#add_target").val();
                var target_value = $("#add_target_val").val();
                var com_per = $("#add_extra_com").val();
                var remarks = $("#add_remarks").val();
                
                if(insurer == "")
                {
                    snackbar_show("Select Insurer");
                }
                else if(agent == "")
                {
                    snackbar_show("Select Agent");
                }
                else if(month == "")
                {
                    snackbar_show("Select Month");
                }
                else if(policy_type == "")
                {
                    snackbar_show("Select Policy Type");
                }
                else if(policy_c_type == "")
                {
                    snackbar_show("Select Policy Cover Type");
                }
                else if(target == "")
                {
                    snackbar_show("Select Target Type");
                }
                else if(target_value == "")
                {
                    snackbar_show("Enter Target Value");
                }
                else if(com_per === "")
                {
                    snackbar_show("Enter Commission Percentage");
                }
                else if(remarks == "")
                {
                    snackbar_show("Enter Remarks");
                }
                else
                {
                    $.ajax({
                            url : "add_extra_com_details",
                            method : "POST",
                            data : {insurer:insurer,agent:agent,month:month,policy_type:policy_type,policy_c_type:policy_c_type,com_per:com_per,target:target,target_value:target_value,remarks:remarks},
                            beforeSend:function(){
                              $("#add_btn").attr("disabled",true);  
                            },
                            success:function(response)
                            {
                                $("#add_btn").attr("disabled",false); 
                                
                                if(response =="success")
                                {
                                    $("#insurer").val("");
                                    $("#insurer").trigger("change");
                                    $("#add_agent").val("");
                                    $("#add_agent").trigger("change");
                                    $("#add_month").val("");
                                    $("#add_policy_type").val("");
                                    $("#add_policy_type").trigger("change");
                                    $("#add_policy_cover_type").val("");
                                    $("#add_policy_cover_type").trigger("change");
                                    $("#add_target").val("");
                                    $("#add_extra_com").val("");
                                    $("#add_target_val").val("");
                                    $("#add_remarks").val("");
                                    snackbar_show("success");
                                    $("#add_model").modal("toggle");
                                    fetch_commission();
                                }
                                else
                                {
                                   snackbar_show("Extra Commission Already Exits for this Agent...");
                                }
                            }
                    });
                }
                
            });
       });
       
       
       
    function fetch_commission()
    {
      var content = "";
      content += "<div class='table-responsive'>";
      content += "<table id='table_id' class='table table-hover table-bordered'>"; 
      content += "<thead><th>S.No</th><th>Agent Name</th><th>Insurer</th><th>Month</th><th>Target Type</th><th>Target</th><th>Created By</th><th>Created Date</th></thead>";
      content += "<tbody></tbody>";
      content += "</table>";
      content += "</div>";
      
      $("#table_view").html(content);

      $("#table_id").DataTable({
          "processing": true,
          "serverSide": false,
          "ordering": false,
          "pageLength": 25,
          "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
          "ajax":{
            'url':'fetch_extra_commission',
          }
      });      
    }
    
    function view_data(id)
    {
        $.ajax({
                  url : "fetch_agent_extra_com_details",
                  method : "POST",
                  data : {id:id},
                  success:function(response)
                  {
                      $("#view_model").modal("toggle");
                      $("#view_data").html(response);
                  }
                  
        });       
    }
  </script>
  
          
      
        