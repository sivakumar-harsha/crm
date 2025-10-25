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
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1 style="font-size: 17px;">
        Bussiness Followup
        <div class="pull-right" style="margin-left:5px;margin-right:5px;">
            <select class="select2" style="width:300px;" id="agent_select">
                <option value = "">Select Agent</option>
                <?php foreach($agents as $ag){ ?>
                <option value = "<?php echo $ag->id; ?>"><?php echo $ag->name." ( ".$ag->agent_pos_code." )"; ?></option>
                <?php } ?>
            </select>
        </div>
        <!--<div class="pull-right" style="margin-left:5px;margin-right:5px;">-->
        <!--    <select class="select2" style="width:300px;" id="agent_pos">-->
        <!--        <option value = "">Select POS</option>-->
        <!--         <?php foreach($pos as $pg){ ?>-->
        <!--        <option value = "<?php echo $pg->id; ?>"><?php echo $pg->name." ( ".$pg->agent_pos_code." )"; ?></option>-->
        <!--        <?php } ?>-->
        <!--    </select>-->
        <!--</div>-->
        <!--<div class="pull-right" style="margin-left:5px;margin-right:5px;">-->
        <!--    <select class="select2" style="width:300px;" id="area_incharge_select">-->
        <!--        <option value = "">Select Area Incharge</option>-->
        <!--        <?php foreach($area_incharge as $ai){ ?>-->
        <!--        <option value = "<?php echo $ai->id; ?>"><?php echo $ai->name; ?></option>-->
        <!--        <?php } ?>-->
        <!--    </select>   -->
        <!--</div>-->
        <!--<button data-toggle="modal" data-target="#add_model" class="btn btn-primary btn-sm pull-right hidden" id="add_mod">Add New</button>-->
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-body">
          <div class="row">
                    <div class="col-sm-2">
                        <label>Name</label> <span id="agent_name"></span>
                    </div>
                    <div class="col-sm-2">
                        <label>Agent Code</label> <span id="agent_code"></span>
                    </div>
                    <div class="col-sm-2">
                        <label>Phone</label> <span id="agent_phone"></span>
                    </div>
                    <div class="col-sm-6">
                        <div class="row">
                            <div class="col-sm-1"> 
                                <label>Address</label>
                            </div>
                            <div class="col-sm-11">
                                <span id="agent_address" style="padding:5px;"></span>  
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <div class="row">
                            <div class="col-sm-4">
                                <label>Prefer Time to Call</label>
                            </div>
                            <div class="col-sm-8">
                                <input type="text" placeholder="9:00 AM - 5:00 PM" class="form-control" id="agent_ptc">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <label>FOE</label> <span id="agent_user"></span>
                    </div>
                    <div class="col-sm-2">
                        <label>Region</label> <span id="agent_region"></span>
                    </div>
                    <div class="col-sm-2">
                        <label>Area Incharge</label> <span id="agent_ai"></span>
                    </div>
                    <div class="col-sm-2">
                        <label>AI Phone</label> <span id="agent_ai_phone"></span>
                    </div>
                </div>
                <div class="table-responsive" id="table_format_data"></div>
                  <div class="row">
                      <div class="col-sm-6">
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
                      <div class="col-sm-6 hidden" id = "agent_reshedule_div">
                         <div class="form-group">
                            <label>Reshedule Date and Time</label>
                            <div class="row">
                                <div class="col-sm-6">
                                  <input type="date" class="form-control" id="agent_r_date">  
                                </div>
                                <div class="col-sm-6">
                                  <input type="time" class="form-control" id="agent_r_time">  
                                </div>
                            </div>
                        </div> 
                      </div>
                  </div>
                <div class="form-group">
                    <label>Call Remarks</label>
                    <textarea class="form-control" id="agent_remarks"></textarea>
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
                                    <input type="number" class="form-control" id="motor_agent_nop">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Remarks</label>
                                    <textarea class="form-control" id="motor_agent_remarks"></textarea>
                                </div>
                            </div>
                        </div>
                        <label>Health</label>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>No of Policy</label>
                                    <input type="number" class="form-control" id="health_agent_nop">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Remarks</label>
                                    <textarea class="form-control" id="health_agent_remarks"></textarea>
                                </div>
                            </div>
                        </div>
                  
                        <label>SME</label>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>No of Policy</label>
                                    <input type="number" class="form-control" id="sme_agent_nop">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Remarks</label>
                                    <textarea class="form-control" id="sme_agent_remarks"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
        </div><!-- /.box-body -->
        <button type="button" class="btn btn-sm btn-primary" id="add_btn">Submit</button>
        
        <!--Old Chat-->
        <div class="row">
        <div class="col-md-12">
        <div class="box box-warning collapsed-box direct-chat direct-chat-warning">
        <div class="box-header with-border">
        <h3 class="box-title">Old Chat</h3>
        <div class="box-tools pull-right">
        <!--<span data-toggle="tooltip" title="3 New Messages" class="badge bg-yellow">3</span>-->
        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
        </button>
        <!--<button type="button" class="btn btn-box-tool" data-toggle="tooltip" title="Contacts" data-widget="chat-pane-toggle">-->
        <!--<i class="fa fa-comments"></i></button>-->
        <!--<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>-->
        </button>
        </div>
        </div>
        
        <div class="box-body">
        
        <div class="direct-chat-messages" style="height:500px;" id="old_chat_data">
        
        <!--<div class="direct-chat-msg">-->
        <!--<div class="direct-chat-info clearfix">-->
        <!--<span class="direct-chat-name pull-left">Alexander Pierce</span>-->
        <!--<span class="direct-chat-timestamp pull-right">23 Jan 2:00 pm</span>-->
        <!--</div>-->
        
        <!--<img class="direct-chat-img" src="dist/img/user1-128x128.jpg" alt="message user image">-->
        
        <!--<div class="direct-chat-text">-->
        <!--Is this template really for free? That's unbelievable!-->
        <!--</div>-->
        
        <!--</div>-->
        
        
        <!--<div class="direct-chat-msg right">-->
        <!--<div class="direct-chat-info clearfix">-->
        <!--<span class="direct-chat-name pull-right">Sarah Bullock</span>-->
        <!--<span class="direct-chat-timestamp pull-left">23 Jan 2:05 pm</span>-->
        <!--</div>-->
        
        <!--<img class="direct-chat-img" src="dist/img/user3-128x128.jpg" alt="message user image">-->
        
        <!--<div class="direct-chat-text">-->
        <!--You better believe it!-->
        <!--</div>-->
        
        <!--</div>-->
        
        
        
        
        
        <!--<div class="direct-chat-contacts">-->
        <!--<ul class="contacts-list">-->
        <!--<li>-->
        <!--<a href="#">-->
        <!--<img class="contacts-list-img" src="dist/img/user1-128x128.jpg" alt="User Image">-->
        <!--<div class="contacts-list-info">-->
        <!--<span class="contacts-list-name">-->
        <!--Count Dracula-->
        <!--<small class="contacts-list-date pull-right">2/28/2015</small>-->
        <!--</span>-->
        <!--<span class="contacts-list-msg">How have you been? I was...</span>-->
        <!--</div>-->
        
        <!--</a>-->
        <!--</li>-->
        
        <!--<li>-->
        <!--<a href="#">-->
        <!--<img class="contacts-list-img" src="dist/img/user7-128x128.jpg" alt="User Image">-->
        <!--<div class="contacts-list-info">-->
        <!--<span class="contacts-list-name">-->
        <!--Sarah Doe-->
        <!--<small class="contacts-list-date pull-right">2/23/2015</small>-->
        <!--</span>-->
        <!--<span class="contacts-list-msg">I will be waiting for...</span>-->
        <!--</div>-->
        
        <!--</a>-->
        <!--</li>-->
        
        <!--<li>-->
        <!--<a href="#">-->
        <!--<img class="contacts-list-img" src="dist/img/user3-128x128.jpg" alt="User Image">-->
        <!--<div class="contacts-list-info">-->
        <!--<span class="contacts-list-name">-->
        <!--Nadia Jolie-->
        <!--<small class="contacts-list-date pull-right">2/20/2015</small>-->
        <!--</span>-->
        <!--<span class="contacts-list-msg">I'll call you back at...</span>-->
        <!--</div>-->
        
        <!--</a>-->
        <!--</li>-->
        
        <!--<li>-->
        <!--<a href="#">-->
        <!--<img class="contacts-list-img" src="dist/img/user5-128x128.jpg" alt="User Image">-->
        <!--<div class="contacts-list-info">-->
        <!--<span class="contacts-list-name">-->
        <!--Nora S. Vans-->
        <!--<small class="contacts-list-date pull-right">2/10/2015</small>-->
        <!--</span>-->
        <!--<span class="contacts-list-msg">Where is your new...</span>-->
        <!-- </div>-->
        
        <!--</a>-->
        <!--</li>-->
        
        <!--<li>-->
        <!--<a href="#">-->
        <!--<img class="contacts-list-img" src="dist/img/user6-128x128.jpg" alt="User Image">-->
        <!--<div class="contacts-list-info">-->
        <!--<span class="contacts-list-name">-->
        <!--John K.-->
        <!--<small class="contacts-list-date pull-right">1/27/2015</small>-->
        <!--</span>-->
        <!--<span class="contacts-list-msg">Can I take a look at...</span>-->
        <!--</div>-->
        
        <!--</a>-->
        <!--</li>-->
        
        <!--<li>-->
        <!--<a href="#">-->
        <!--<img class="contacts-list-img" src="dist/img/user8-128x128.jpg" alt="User Image">-->
        <!--<div class="contacts-list-info">-->
        <!--<span class="contacts-list-name">-->
        <!--Kenneth M.-->
        <!--<small class="contacts-list-date pull-right">1/4/2015</small>-->
        <!--</span>-->
        <!--<span class="contacts-list-msg">Never mind I found...</span>-->
        <!--</div>-->
        
        <!--</a>-->
        <!--</li>-->
        
        <!--</ul>-->
        
        <!--</div>-->
        
        </div>
        
        <!--<div class="box-footer">-->
        <!--<form action="#" method="post">-->
        <!--<div class="input-group">-->
        <!--<input type="text" name="message" placeholder="Type Message ..." class="form-control">-->
        <!--<span class="input-group-btn">-->
        <!--<button type="button" class="btn btn-warning btn-flat">Send</button>-->
        <!--</span>-->
        <!--</div>-->
        <!--</form>-->
        <!--</div>-->

</div>
</div>
</div>
 <!--Old Chat-->
 
    <div class="col-md-12 padd_left_right">
                        <div class="box box-info" style="max-height: 500px;">
                        <div class="box-header with-border">
                             <h3 class="box-title">Lead</h3>
                        <div class="box-tools pull-right">
                            <label id="prospect_due_select_label">Due date</label>
                            <select id="prospect_due_date_select">
                                <option value="All" selected>All</option>
                                <option value="Overdue">Overdue</option>
                                <option value="7 days">7 days</option>
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
                 <h3 class="box-title">Customer</h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="box-body">
                 <div id="cusomer_table_view" style="padding:5px;"></div>
            </div>
        </div>
    </div>
    </div>
</div>
   
        
      </div><!-- /.box-body -->

    </section><!-- /.content -->
  </div><!-- /.box -->

 
  </div><!-- /.content-wrapper -->

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

  <script>
  var agent = "";
  <?php 
  if(isset($_GET['id']))
  {?>
  agent = <?php echo $_GET['id']; ?>;
  $("#agent_select").val(agent);
   agent_change_function();
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
             $("#agent_reshedule_div").removeClass("hidden");
         }
         else
         {
             $("#agent_reshedule_div").addClass("hidden");
         }
     });
     $("#agent_select").change(function(){
         agent_change_function();
         fetch_lead();
         fetch_customers();
         });
      $("#prospect_due_date_select").change(function(){
            fetch_lead();  
      });
      $("#add_btn").click(function(){
        var call_answer = $("#call_answer").val();
        var agent_r_date = $("#agent_r_date").val();
        var agent_r_time = $("#agent_r_time").val();
        var agent_remarks = $("#agent_remarks").val();
        var motor_agent_nop = $("#motor_agent_nop").val();
        var motor_agent_remarks = $("#motor_agent_remarks").val();
        var health_agent_nop = $("#health_agent_nop").val();
        var health_agent_remarks = $("#health_agent_remarks").val();
        var sme_agent_nop = $("#sme_agent_nop").val();
        var sme_agent_remarks = $("#sme_agent_remarks").val();
        var agent_ptc = $("#agent_ptc").val();
        
         if(call_answer == "")
        {
            snackbar_show("Select Call Answer");
        }
        else if(call_answer == "ReShedule" && agent_r_date == "")
        {
             snackbar_show("Select Reshedule Date");
        }
        else if(call_answer == "ReShedule" && agent_r_time == "")
        {
             snackbar_show("Select Reshedule Time");
        }
        else
        {
            
          $.ajax({
            url:"add_agent_Business_followup",
           data:{
               call_answer:call_answer,
               agent_r_date:agent_r_date,
               agent_r_time:agent_r_time,
               agent_remarks:agent_remarks,
               motor_agent_nop:motor_agent_nop,
               motor_agent_remarks:motor_agent_remarks,
               health_agent_nop:health_agent_nop,
               health_agent_remarks:health_agent_remarks,
               sme_agent_nop:sme_agent_nop,
               sme_agent_remarks:sme_agent_remarks,
               agent:agent,
               agent_ptc:agent_ptc,
           },
            type:"POST",
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
      });

    });
   function agent_change_function()
   {
        agent = $("#agent_select").val();
         if(agent != "")
         {
             $.ajax({
                url:"fetch_agent_bussiness_follow_data",
                data:{agent:agent},
                method:"POST",
                success:function(response){
                  // alert(response);
                  var obj = jQuery.parseJSON(response);
                  $("#agent_name").html(obj['agent_data'].name);
                  $("#agent_phone").html(obj['agent_data'].phoneno);
                  $("#agent_address").html(obj['agent_data'].address);
                  $("#agent_code").html(obj['agent_data'].agent_pos_code);
                  $("#agent_ptc").val(obj['agent_data'].preferred_time_to_call);
                  $("#agent_user").html(obj['user_name']);
                  $("#agent_region").html(obj['region']);
                  $("#agent_ai").html(obj['ai_name']);
                  $("#agent_ai_phone").html(obj['ai_phone']);
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
       agent = $("#agent_select").val();
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
                    'url':'fetch_agent_lead_dashboard_followup',
                    'method':"POST",
                    'data':{
                        prospect_due_date:prospect_due_date,
                        agent:agent,
                            },
                  }
              });   
   }
   
   function fetch_customers()
    {
     agent = $("#agent_select").val();
      var content = "";
      content += "<div class='table-responsive'>";
      content += "<table id='table_id1' class='table table-hover table-bordered'>"; 
      content += "<thead><th>S.No</th><th>Cus Name</th><th>Mobile No</th><th>Class</th><th>Policy Type</th><th>Policy No</th><th>Policy Premium</th><th>Policy Exp Date</th><th>Action</th></thead>";
      content += "<tbody></tbody>";
      content += "</table>";
      content += "</div>";
      
      $("#cusomer_table_view").html(content);

      $("#table_id1").DataTable({
                scrollY:'45vh',
                scrollCollapse: true,
		        "processing": true,
		        "serverSide": true,
		        "ordering": false,
		        "pageLength": 25,
		        "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
		        "ajax":{
		            'type': 'POST',
		            'url':'fetch_customer_with_agent',
		            'data':{
	                	agent: agent,
	                
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
  
  </script>
