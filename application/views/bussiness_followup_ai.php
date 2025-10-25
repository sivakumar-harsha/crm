<!-- Content Wrapper. Contains page content -->
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
table.dataTable thead th, table.dataTable thead td {
    padding: 1px 1px !important;
}
table.dataTable tbody th, table.dataTable tbody td {
    padding: 1px 1px !important;
}
.dataTables_wrapper .dataTables_filter input {
    padding: 0px !important;
}
.dataTables_wrapper .dataTables_length select {
    padding: 0px !important;
}
.dataTables_wrapper .dataTables_paginate .paginate_button {
    padding: 0em 0em !important;
}
</style>

  <div class="content-wrapper">
      
    <section class="content-header">
      <h1 style="font-size: 17px;">
        Bussiness Followup
        <div class="pull-right" style="margin-left:5px;margin-right:5px;">
            <select class="select2" style="width:300px;" id="area_incharge_select">
                <option value = "">Select Area Incharge</option>
                <?php foreach($area_incharge as $ai){ ?>
                <option value = "<?php echo $ai->id; ?>"><?php echo $ai->name; ?></option>
                <?php } ?>
            </select>   
        </div>
      
      </h1>
    </section>

    <section class="content">
          <div class="box collapsed-box">
             <div class="box-header with-border">
                <h3 class="box-title">Area Incharge Info</h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse">
                    <i class="fa fa-plus"></i></button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="" data-original-title="Remove">
                    <i class="fa fa-times"></i></button>
                </div>
            </div>
            
            <div class="box-body" style="">
                 <div class="row">
                    <div class="col-sm-3">
                        <label>Name </label> &nbsp;<span id="area_incharge_name"></span>
                    </div>
                    <div class="col-sm-4">
                        <label>Region</label> &nbsp;<span id="area_incharge_region"></span>
                    </div>
                    <div class="col-sm-3">
                        <label>Phone</label> &nbsp;<span id="area_incharge_phone"></span>
                    </div>
                 </div>
                 <br>
                 <div class="row">
                     <div class="col-sm-5">
                        <div class="row">
                            <div class="col-sm-2"> 
                                <label>Address</label>
                            </div>
                            <div class="col-sm-10">
                                &nbsp;<span id="agent_address" style="padding:5px;"></span>  
                            </div>
                        </div>
                    </div>
                    
                      <div class="col-sm-3">
                        <div class="row">
                            <div class="col-sm-6">
                                <label>Prefer Time to Call</label>
                            </div>
                            <div class="col-sm-6">
                                <input type="text" placeholder="9:00 AM - 5:00 PM" class="form-control" id="area_incharge_ptc">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <label>FOE</label>  &nbsp;<span id="area_incharge_foe"></span>
                    </div>
                    
                 </div>
             </div>
         </div>
         
          <div class="box collapsed-box">
             <div class="box-header with-border">
                  <h3 class="box-title">Agents</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse">
                    <i class="fa fa-plus"></i></button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="" data-original-title="Remove">
                    <i class="fa fa-times"></i></button>
                    </div>
            </div>
            <div class="box-body" style="">
                <div class="row">
                    <div class="col-sm-12">
                        <label>Agents</label> <span id="area_incharge_agents"></span>
                    </div>
                 </div>
            </div>
        </div>
        
          <div class="box collapsed-box">
                <div class="box-header with-border">
                <h3 class="box-title">Business Log</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse">
                   <i class="fa fa-plus"></i></button>
                <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="" data-original-title="Remove">
                <i class="fa fa-times"></i></button>
                </div>
            </div>
                <div class="box-body" style="">
                      <div class="table-responsive" id="table_format_data"></div> 
                </div>
            </div>
         
          <div class="box collapsed-box">
                <div class="box-header with-border">
                <h3 class="box-title">Old Chats</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse">
                   <i class="fa fa-plus"></i></button>
                <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="" data-original-title="Remove">
                <i class="fa fa-times"></i></button>
                </div>
            </div>
                <div class="box-body" style="">
                       <div class="direct-chat-messages" style="height:500px;" id="old_chat_data">
                </div>
            </div> 
        </div>
        
         <div class="box">
            <div class="box-body">
                <div class="row">
                    <div class="col-md-12 padd_left_right">
                                <div class="box box-info" style="max-height: 500px;">
                                <div class="box-header with-border">
                                    <h3 class="box-title">Lead</h3>
                                <div class="box-tools pull-right">
                                    <label id="prospect_due_select_label">Due date</label>
                                    <select id="prospect_due_date_select">
                                        <option value="All">All</option>
                                        <option value="Overdue">Overdue</option>
                                        <option value="7 days" selected>7 days</option>
                                        <option value="8-15 days">8-15 days</option>
                                        <option value="16-30 days">16-30 days</option>
                                        <option value="31-45 days">31-45 days</option>
                                    </select>
                                    <a href="leads" class="btn btn-xs btn-info"><i class="fa fa-eye"></i>
                                View details</a>
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                </button>
                                </div>
                                </div>
                                <div class="box-body">
                                <div id="prospect_datatable" style="padding:5px;" >
                                </div>
                                </div>
                                </div>
                   </div>
            
                       <div class="col-md-12 padd_left_right">
                <div class="box box-info" style="max-height: 500px;">
                    <div class="box-header with-border">
                        <h3 class="box-title">Active Policy</h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="box-body">
                         <div id="customer_table_view" style="padding:5px;"></div>
                    </div>
                </div>
            </div>
            
                 </div>
            </div>
      </div>

        <div class="box collapsed-box">
             <div class="box-header with-border">
                    <h3 class="box-title">Business Compelete</h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse">
                       <i class="fa fa-plus" onclick='fetch_business_complete()'></i></button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="" data-original-title="Remove">
                    <i class="fa fa-times"></i></button>
                    </div>
                </div>
                 <div class="box-body">
                         <div id="bc_table_view" style="padding:5px;"></div>
                    </div>
            </div>
            
            
        <div class="box collapsed-box">
             <div class="box-header with-border">
                    <h3 class="box-title">Renewals</h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse">
                       <i class="fa fa-plus" onclick='fetch_renewals()'></i></button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="" data-original-title="Remove">
                    <i class="fa fa-times"></i></button>
                    </div>
                </div>
                 <div class="box-body">
                         <div id="renewals_table_view" style="padding:5px;"></div>
                    </div>
            </div>
            
        
        
      
        <div class="box collapsed-box">
             <div class="box-header with-border">
                    <h3 class="box-title">Chat Box & Commitment</h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse">
                       <i class="fa fa-plus"></i></button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="" data-original-title="Remove">
                    <i class="fa fa-times"></i></button>
                    </div>
                </div>
                
                <div class="box-body" style="">
                        <div class="row">
                          <?php 
                          
                          if($this->session->has_userdata('logged_in') && $this->session->userdata('session_role') == "AI")
                          { 
                              $remark_name = "Remark"; 
                          
                          ?>
                         <div class="col-sm-6 hidden">
                              <?php 
                          }
                          else
                          { 
                            $remark_name = "Call Remark"; ?>
                                <div class="col-sm-6">
                          <?php 
                          }
                          ?>
                                  <div class="form-group">
                                <label>Call Answer</label> <span id="add_icon_error" style="color: red;">*</span>
                                <select class="form-control" id="call_answer">
                                    <option value="">Select</option>
                                    <option>Answer</option>
                                    <option>Not Answer</option>
                                    <option>Unreachable</option>
                                    <option>ReShedule</option>
                                    <option>Incoming Call</option>
                                    <option>Incoming Message</option>
                                </select>
                            </div>    
                              </div>
                          
                          
                          <div class="col-sm-6 hidden" id = "area_incharge_reshedule_div">
                             <div class="form-group">
                                <label>Reshedule Date and Time</label>
                                <div class="row">
                                    <div class="col-sm-6">
                                      <input type="date" class="form-control" id="area_incharge_r_date">  
                                    </div>
                                    <div class="col-sm-6">
                                      <input type="time" class="form-control" id="area_incharge_r_time">  
                                    </div>
                                </div>
                            </div> 
                          </div>
                      </div>
                    <div class="form-group">
                        <label><?php echo $remark_name; ?></label>
                        <textarea class="form-control" id="area_incharge_remarks"></textarea>
                    </div>
        
                    <div class="box box-danger collapsed-box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Commitment</h3>
                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="box-body">
                            <label>Motor</label>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>No of Policy</label>
                                        <input type="number" class="form-control" id="motor_area_incharge_nop">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Remarks</label>
                                        <textarea class="form-control" id="motor_area_incharge_remarks"></textarea>
                                    </div>
                                </div>
                            </div>
                            <label>Health</label>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>No of Policy</label>
                                        <input type="number" class="form-control" id="health_area_incharge_nop">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Remarks</label>
                                        <textarea class="form-control" id="health_area_incharge_remarks"></textarea>
                                    </div>
                                </div>
                            </div>
                      
                            <label>SME</label>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>No of Policy</label>
                                        <input type="number" class="form-control" id="sme_area_incharge_nop">
                                    </div>
                                </div>
                                <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Remarks</label>
                                        <textarea class="form-control" id="sme_area_incharge_remarks"></textarea>
                                    </div>
                                </div>
                            </div>
                            
                    <div class="row">
                <div class="col-md-10 mb-4">
                     <div class="form-outline">
                         <label>Upload files</label><span style="color:red;" id="add_upload_error">*</span>
                      <input type="file" id="add_upload" class="form-control" accept="resume/*">
                    </div>
                </div>
                </div>
                            
                        </div>
                    </div>
                    
                    <button type="button" class="btn btn-sm btn-primary" id="add_btn">Submit</button>
                    </div>
                </div>
            </div>
      
    </section>
  </div>

<!-- Modal -->
<div id="view_modal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"></h4>
      </div>
      <div class="modal-body">
          
          <h4 style="color:red"><u>Personal Information</u></h4>
           <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <div class="row">   
                           <div class="col-md-4">
                                <label>Client Name</label><span></span>
                           </div>
                           <div class="col-md-8">
                                <p name="client_name" id="client_name"></p>
                           </div>
                         </div>
                    </div>
                    
                    <div class="form-group">
                        <div class="row">   
                           <div class="col-md-4">
                                <label>Mobile No</label><span></span>
                           </div>
                           <div class="col-md-8">
                                <p name="mobile_no" id="mobile_no"></p>
                           </div>
                         </div>
                    </div>
               
                <div class="form-group">
                    <div class="row">   
                       <div class="col-md-4">
                            <label>Landline no</label>
                       </div>
                       <div class="col-md-8">
                           <p  name="landline_no" id="landline_no"></p>
                       </div>
                     </div>
                </div>
                    
                     <div class="form-group">
                            <div class="row">   
                               <div class="col-md-4">
                                     <label>Address</label>
                               </div>
                               <div class="col-md-8">
                                   <p name="address" id="address" rows="2"></p>
                               </div>
                             </div>
                     </div>
                </div>
                
                <div class="col-md-6">
                    
                     <div class="form-group">
                          <div class="row">   
                               <div class="col-md-4">
                                    <label>Email Id</label>
                               </div>
                               <div class="col-md-8">
                                   <p  name="email_id" id="email_id"></p>
                               </div>
                        </div>
                    </div>
                     <div class="form-group">
                      <div class="row">   
                           <div class="col-md-4">
                               <label>Date of Birth</label>
                           </div>
                            <div class="col-md-8">
                                <p name="dob" id="dob"></p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <div class="row">   
                           <div class="col-md-4">
                               <label>Age</label>
                           </div>
                            <div class="col-md-8">
                                <p name="age" id="age"></p>
                            </div>
                        </div>
                    </div>
                    
                     <div class="form-group">
                         <div class="row">   
                           <div class="col-md-4">
                                <label>Area</label>
                           </div>
                            <div class="col-md-8">
                                <p name="area" id="area"></p>
                            </div>
                        </div>
                    </div>
                  
                </div>
                
            </div>
            
            
            <div id="v_info"></div>
            <div id="v_docs"></div>
            
            <div id="policy_info"></div>
            
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>


<!-- Modal -->
<div id="agn_modal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Agent Business - <span id="agninfo" style='color:red;font-size:12px;'></span></h4>
      </div>
      <div class="modal-body">
        <div id="agn_business"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

  <script>
  var area_incharge = "";
  <?php 
  if(isset($_GET['id']))
  {?>
  area_incharge = <?php echo $_GET['id']; ?>;
  $("#area_incharge_select").val(area_incharge);
   area_incharge_change_function();
   fetch_lead();
   fetch_customers();
     <?php 
  } 
  ?>
    $(document).ready(function(){
     $('.select2').select2();
     $("#call_answer").change(function(){
         var call_answer = $("#call_answer").val();
         if(call_answer == "ReShedule")
         {
             $("#area_incharge_reshedule_div").removeClass("hidden");
         }
         else
         {
             $("#area_incharge_reshedule_div").addClass("hidden");
         }
     });
     $("#area_incharge_select").change(function(){
         area_incharge_change_function();
         fetch_lead();
         fetch_customers();
         });
      $("#prospect_due_date_select").change(function(){
            fetch_lead();  
      });
      $("#add_btn").click(function(){
          
        var call_answer = $("#call_answer").val();
        var area_incharge_r_date = $("#area_incharge_r_date").val();
        var area_incharge_r_time = $("#area_incharge_r_time").val();
        var area_incharge_remarks = $("#area_incharge_remarks").val();
        var motor_area_incharge_nop = $("#motor_area_incharge_nop").val();
        var motor_area_incharge_remarks = $("#motor_area_incharge_remarks").val();
        var health_area_incharge_nop = $("#health_area_incharge_nop").val();
        var health_area_incharge_remarks = $("#health_area_incharge_remarks").val();
        var sme_area_incharge_nop = $("#sme_area_incharge_nop").val();
        var sme_area_incharge_remarks = $("#sme_area_incharge_remarks").val();
        var area_incharge_ptc = $("#area_incharge_ptc").val();
        <?php if($this->session->has_userdata('logged_in') && $this->session->userdata('session_role') == "AI"){ ?>
                if(area_incharge_remarks == "")
                {
                    snackbar_show("Enter Remarks");
                }
                else
                {
                    
                     var files = $("#add_upload").prop('files')[0];
                      var formdata = new FormData();
                      
                formdata.append("call_answer",call_answer);
                formdata.append("area_incharge_r_date",area_incharge_r_date);
                formdata.append("area_incharge_r_time",area_incharge_r_time);
                formdata.append("area_incharge_remarks",area_incharge_remarks);
                formdata.append("motor_area_incharge_nop",motor_area_incharge_nop);
                formdata.append("motor_area_incharge_remarks",motor_area_incharge_remarks);
                formdata.append("health_area_incharge_nop",health_area_incharge_nop);
                formdata.append("health_area_incharge_remarks",health_area_incharge_remarks);
                formdata.append("sme_area_incharge_nop",sme_area_incharge_nop);
                formdata.append("sme_area_incharge_remarks",sme_area_incharge_remarks);
                formdata.append("area_incharge",area_incharge);
                formdata.append("area_incharge_ptc",area_incharge_ptc);
                formdata.append("file",files);
                      

                
                  $.ajax({
                    url:"add_area_incharge_Business_followup",
                   data: formdata,
                    type:"POST",
                    processData:false,  
                    contentType:false,
                     cache:false,
                     dataType:'text',
                    beforeSend:function(){
                        $("#add_btn").attr("disabled",true);
                    },
                    success:function(response){
                        // alert(response);
                         $("#add_btn").attr("disabled",false);
                         location.reload();
                    },
                    error: function(code) {   
                        alert(code.statusText);
                    },
                  });
                }
          <?php }else{ ?>
                if(call_answer == "")
                {
                    snackbar_show("Select Call Answer");
                }
                else if(call_answer == "ReShedule" && area_incharge_r_date == "")
                {
                     snackbar_show("Select Reshedule Date");
                }
                else if(call_answer == "ReShedule" && area_incharge_r_time == "")
                {
                     snackbar_show("Select Reshedule Time");
                }
                else
                {
                    
                         var files = $("#add_upload").prop('files')[0];
                      var formdata = new FormData();
                      
                formdata.append("call_answer",call_answer);
                formdata.append("area_incharge_r_date",area_incharge_r_date);
                formdata.append("area_incharge_r_time",area_incharge_r_time);
                formdata.append("area_incharge_remarks",area_incharge_remarks);
                formdata.append("motor_area_incharge_nop",motor_area_incharge_nop);
                formdata.append("motor_area_incharge_remarks",motor_area_incharge_remarks);
                formdata.append("health_area_incharge_nop",health_area_incharge_nop);
                formdata.append("health_area_incharge_remarks",health_area_incharge_remarks);
                formdata.append("sme_area_incharge_nop",sme_area_incharge_nop);
                formdata.append("sme_area_incharge_remarks",sme_area_incharge_remarks);
                formdata.append("area_incharge",area_incharge);
                formdata.append("area_incharge_ptc",area_incharge_ptc);
                formdata.append("file",files);
                      
                    
                  $.ajax({
                    url:"add_area_incharge_Business_followup",
                   data: formdata,
                    type:"POST",
                      processData:false,  
                    contentType:false,
                     cache:false,
                     dataType:'text',
                    beforeSend:function(){
                        $("#add_btn").attr("disabled",true);
                    },
                    success:function(response){
                        // alert(response);
                         $("#add_btn").attr("disabled",false);
                         location.reload();
                    },
                    error: function(code) {   
                        alert(code.statusText);
                    },
                  });
                }
          <?php } ?>
         
      });

    });
   function area_incharge_change_function()
   {
        area_incharge = $("#area_incharge_select").val();
         if(area_incharge != "")
         {
             $.ajax({
                url:"fetch_area_incharge_bussiness_follow_data",
                data:{area_incharge:area_incharge},
                method:"POST",
                success:function(response){
                  // alert(response);
                  var obj = jQuery.parseJSON(response);
                  $("#area_incharge_name").html(obj['area_incharge_data'].name);
                  $("#area_incharge_phone").html(obj['area_incharge_data'].phoneno);
                  $("#agent_address").html(obj['area_incharge_data'].address);
                  $("#area_incharge_ptc").val(obj['area_incharge_data'].preferred_time_to_call);
                  $("#area_incharge_region").html(obj['region']);
                  $("#area_incharge_foe").html(obj['foe']);
                  $("#area_incharge_agents").html(obj['agent']);
                  $("#table_format_data").html(obj['html']);
                  $("#old_chat_data").html(obj['old_chat']);
                  $("#add_model").modal("show");
                },
                error: function(code) {   
                    alert(code.statusText);
                },
              });
         }    
   }
   
    function fetch_lead()
   {
       area_incharge = $("#area_incharge_select").val();
       var prospect_due_date = $("#prospect_due_date_select").val();
        var content = "";
              content += "<div class='table-responsive'>";
              content += "<table id='table_id' class='table table-hover table-bordered'>"; 
              content += "<thead><th>S.No</th><th>Class</th><th>Customer name</th><th>Cus Phone</th><th>Due date</th><th>Status</th></thead>";
              content += "<tbody></tbody>";
              content += "</table>";
              content += "</div>";
              
              $("#prospect_datatable").html(content);
        
              $("#table_id").DataTable({
                    scrollY:        '45vh',
                    scrollCollapse: true,
                  "processing": true,
                  "serverSide": false,
                  "ordering": false,
                  "pageLength": 10,
                  "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
                  "ajax":{
                    'url':'fetch_area_incharge_lead_dashboard_followup',
                    'method':"POST",
                    'data':{
                        prospect_due_date:prospect_due_date,
                        area_incharge:area_incharge,
                            },
                  }
              });   
   }
   
   function fetch_customers()
    {
     area_incharge = $("#area_incharge_select").val();
      var content = "";
      content += "<div class='table-responsive'>";
      content += "<table id='table_id1' class='table table-hover table-bordered'>"; 
      content += "<thead><th>S.No</th><th>Cus Name</th><th>Mobile No</th><th>Class</th><th>Policy Type</th><th>Policy No</th><th>Policy Premium</th><th>Policy Exp Date</th><th>Action</th></thead>";
      content += "<tbody></tbody>";
      content += "</table>";
      content += "</div>";
      
      $("#customer_table_view").html(content);

      $("#table_id1").DataTable({
                scrollY:'45vh',
                scrollCollapse: true,
		        "processing": true,
		        "serverSide": true,
		        "ordering": false,
		        "pageLength": 10,
		        "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
		        "ajax":{
		            'type': 'POST',
		            'url':'fetch_customer_with_area_incharge',
		            'data':{
	                	area_incharge: area_incharge,
	                
	                },
		        }
       });
    }
    
    
    function fetch_renewals()
    {
     area_incharge = $("#area_incharge_select").val();
      var content = "";
      content += "<div class='table-responsive'>";
      content += "<table id='table_id5' class='table table-hover table-bordered'>"; 
      content += "<thead><th>S.No</th><th>Cus Name</th><th>Mobile No</th><th>Class</th><th>Policy Type</th><th>Policy No</th><th>Policy Premium</th><th>Policy Exp Date</th><th>Action</th></thead>";
      content += "<tbody></tbody>";
      content += "</table>";
      content += "</div>";
      
      $("#renewals_table_view").html(content);

      $("#table_id5").DataTable({
                scrollY:'45vh',
                scrollCollapse: true,
		        "processing": true,
		        "serverSide": true,
		        "ordering": false,
		        "pageLength": 10,
		        "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
		        "ajax":{
		            'type': 'POST',
		            'url':'fetch_renewals_with_area_incharge',
		            'data':{
	                	area_incharge: area_incharge,
	                
	                },
		        }
       });
    }
    
    
    function fetch_business_complete()
    {
      $("#bc_table_view").html("<p>Loading.....</p>"); 
      area_incharge = $("#area_incharge_select").val();
      
      var content = "";
      content += "<div class='table-responsive'>";
      content += "<table id='table_id3' class='table table-hover table-bordered'>"; 
      content += "<thead><th>S.No</th><th>Cus Name</th><th>Mobile No</th><th>Class</th><th>Policy Type</th><th>Policy No</th><th>Policy Premium</th><th>Policy Exp Date</th><th>Action</th></thead>";
      content += "<tbody></tbody>";
      content += "</table>";
      content += "</div>";
      
      $("#bc_table_view").html(content);

      $("#table_id3").DataTable({
                scrollY:'45vh',
                scrollCollapse: true,
		        "processing": true,
		        "serverSide": true,
		        "ordering": false,
		        "pageLength": 10,
		        "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
		        "ajax":{
		            'type': 'POST',
		            'url':'fetch_bc_with_area_incharge',
		            'data':{
	                	area_incharge: area_incharge,
	                
	                },
		        }
       });
    }
   
   
   
   
   
   function view_data(id)
    {
        $.ajax({
                   url : "view_lead_details",
                   method : "POST",
                   data : {id:id},
                   success:function(response)
                   {
                       var obj = jQuery.parseJSON(response);
                       
                        $(".modal-title").html(obj["p_info"].client_name + " - Lead Details");
                        $("#client_name").html(obj["p_info"].client_name);
                        $("#mobile_no").html(obj["p_info"].mobile_no);
                        $("#other_contact_details").html(obj["p_info"].other_contact_details);
                        $("#landline_no").html(obj["p_info"].landline_no);
                        $("#address").html(obj["p_info"].address);
                        $("#email_id").html(obj["p_info"].email);
                        $("#cont_person_name").html(obj["p_info"].contact_person_name);
                        $("#cont_person_des").html(obj["p_info"].contact_person_designation);
                        $("#dob").html(obj["p_info"].date_of_birth);
                        $("#age").html(obj["p_info"].age);
                        $("#area").html(obj["p_info"].area);
                        
                        if(obj["v_info"] != "")
                        {
                            var html ='<h4 style="color:red"><u>vechicle Information</u></h4>';
                            html +='<div class="row">';
                            html +='<div class="col-md-6">';
                            html +='<div class="form-group">';
                            html +='<div class="row">';
                            html +='<div class="col-md-4">';
                            html +='<label>Make/Model/Varient</label>';
                            html +='</div>';
                            html +='<div class="col-md-8">';
                            html +='<p name="view_make_model" id="view_make_model" >'+obj["v_info"].brand_name+" /"+obj["v_info"].model_name+"/ "+obj["v_info"].varient_name+'</p>';
                            html +='</div>';
                            html +='</div>';
                            html +='</div>';
                            html +='<div class="form-group">';
                            html +='<div class="row">';
                            html +='<div class="col-md-4">';
                            html +='<label>Engine no</label>';
                            html +='</div>';
                            html +='<div class="col-md-8">';
                            html +='<p name="view_engine_no" id="view_engine_no" >'+obj["v_info"].vechi_engine_num+'</p>';
                            html +='</div>';
                            html +='</div>';
                            html +='</div>';
                            html +='</div>';
                            
                            html +='<div class="col-md-6">';
                            html +='<div class="form-group">';
                            html +='<div class="row">';
                            html +='<div class="col-md-4">';
                            html +='<label>Registration no</label>';
                            html +='</div>';
                            html +='<div class="col-md-8">';
                            html +='<p name="view_regn_no" id="view_regn_no" >'+obj["v_info"].vechi_register_no+'</p>';
                            html +='</div>';
                            html +='</div>';
                            html +='</div>';
                            
                            html +='<div class="form-group">';
                            html +='<div class="row">';
                            html +='<div class="col-md-4">';
                            html +='<label>Chassis No</label>';
                            html +='</div>';
                            html +='<div class="col-md-8">';
                            html +='<p name="view_chassis" id="view_chassis" >'+obj["v_info"].vechi_chassis_num+'</p>';
                            html +='</div>';
                            html +='</div>';
                            html +='</div>';
                            html +='</div>';
                            html +='</div>';
                            
                            $("#v_info").html(html);
                            $("#v_docs").html(obj["docs"]);
                        }
                        
                        if(obj["policy_info"] != "")
                        {
                            $("#policy_info").html(obj["policy_info"]);
                        }
                       
                       $("#view_modal").modal("toggle");
                   }
        });
    }
    
    
    function agent_business(id)
    {
        $.ajax({
                 url : "fetch_agent_business_details",
                 method : "POST",
                 data :{id:id},
                 success:function(response)
                 {
                     var obj = jQuery.parseJSON(response);
                     $("#agn_business").html(obj["content"]);
                     $("#agninfo").html(obj["AgnDetails"]["name"]+" - "+obj["AgnDetails"]["agent_pos_code"]+"("+obj["AgnDetails"]["phoneno"]+") -"+obj["AgnDetails"]["regionname"]);
                     $("#agn_modal").modal("toggle");
                 }
                 
        });
    }
  
  </script>
