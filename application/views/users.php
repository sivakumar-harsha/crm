<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>


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

<div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-3">
                     <h4>&nbsp;&nbsp;FOE(FRONT OFFICE EXECUTIVE)</h4>
                 </div>
                 <div class="col-md-2">
                    <input type="date" class="form-control" id="select_date">
                 </div>
                  <div class="col-md-2">
                    <select class="form-control" id="select_order_by" name='select_order_by'>
                        <option value=''>--Select order by--</option>
                        <option value ='date'>Order By time</option>
                        <option value= 'foe'>Order By Foe</option>
                    </select>
                 </div>
                 
                  <div class="col-md-2">
                    <button type="button" class="btn btn-danger btn-sm" id='report_btn'><i class="fa fa-file-pdf-o" aria-hidden="true"></i> &nbsp;Foe Report</button>
                 </div>
                 
                 <div class="col-md-3 pull-right">
                    <button type="button" class="btn btn-primary btn-sm pull-right" data-toggle="modal" data-target="#add_model">Add FOE / AI</button>
                 </div>
         </div>
          <div class="box">
              
            <ul class="nav nav-tabs">
                <li class="active"><a onclick='fetch_users("user")' data-toggle="tab">FOE</a></li>
                <li><a href="#tab_2" onclick='fetch_users("AI")' data-toggle="tab">Area Incharge</a></li>
            </ul>
            
            <div class="box-body">
                   <div id="table_view"></div> 
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
    </section>
    <!-- /.content -->
  </div>
  
  
  
  
  
  <div class="modal fade in" id="add_model">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true" style="color:white;">×</span></button>
                <h4 class="modal-title text-center">ADD FOE / AI</h4>
            </div>
            
            <div class="modal-body">
              
                <div class="form-group">
                  <label>Role</label> <span id="add_reigion_error" style="color: red;">*</span>
                  <select class="form-control" name="select_position" id="select_position">
                      <option value="user">FOE(Front Office Executive)</option>
                      <option value="AI">Area Incharge</option>
                  </select>
                </div>
                
            <div class="form-group" id="district_div">
                  <label>District</label> <span id="edit_reigion_error" style="color: red;">*</span>
                  <select class="form-control select2" name="add_district" id="add_district" style="width:100%" multiple>
                      <option value="">Select District</option>
                      <option value="All">All</option>
                      <?php foreach($district as $da){ ?>
                         <option value="<?php echo $da->id ?>"><?php echo $da->district ?></option>
                      <?php } ?>
                  </select>
                </div>
               
                 <div class="form-group hidden" id="region_div">
                  <label>Region</label> <span id="edit_reigion_error" style="color: red;">*</span>
                  <select class="form-control select2" name="add_region" id="add_region" style="width:100%" multiple>
                      <option value="">Select Region</option>
                      <?php foreach($reigions as $da){ ?>
                         <option value="<?php echo $da->id ?>"><?php echo $da->reigion ?></option>
                      <?php } ?>
                  </select>
                </div>
                
                <div class="form-group">
                    <label>Name</label><span id="add_reigion_error" style="color: red;">*</span>
                    <input type="text" class="form-control" name="add_username" id="add_username">
                </div>
                
                 <div class="form-group">
                    <label>Email id</label><span id="add_email_error" style="color: red;">*</span>
                    <input type="text" class="form-control" name="add_email" id="add_email">
                </div>
                
                 <div class="form-group">
                    <label>Password</label><span id="add_reigion_error" style="color: red;">*</span>
                    <input type="text" class="form-control" name="add_password" id="add_password">
                </div>
                
                <div class="form-group">
                    <label>Mobile number</label><span id="add_reigion_error" style="color: red;">*</span>
                    <input type="text" class="form-control" name="add_mobile" id="add_mobile">
                </div>
                
                 <div class="form-group">
                    <label>Address</label>
                    <textarea class="form-control" name="add_address" id="add_address" rows="3"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-sm btn-primary" id="add_btn">Submit</button>
            </div>
        </div>
    </div>
  </div>
  
     <div class="modal fade in" id="edit_model">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true" style="color:white;">×</span></button>
                <h4 class="modal-title text-center">Edit FOE / AI</h4>
            </div>
            
            <div class="modal-body">
            
                <div class="form-group">
                  <label>Role</label> <span id="add_reigion_error" style="color: red;">*</span>
                  <select class="form-control" name="edit_role" id="edit_role">
                      <option value="user">FOE(Front Office Executive)</option>
                      <option value="AI">Area Incharge</option>
                  </select>
                </div>
                
              <div class="form-group" id="edit_district_div">
                  <label>District</label> <span id="edit_reigion_error" style="color: red;">*</span>
                  <select class="form-control select2" name="edit_district" id="edit_district" style="width:100%" multiple>
                      <option value="">Select District</option>
                      <option value="All">All</option>
                      <?php foreach($district as $da){ ?>
                         <option value="<?php echo $da->id ?>"><?php echo $da->district ?></option>
                      <?php } ?>
                  </select>
                </div>
                
                
                <div class="form-group" id="s_district_div">
                  <label>Secondary District</label> <span id="edit_reigion_error" style="color: red;">*</span>
                  <select class="form-control select2" name="edit_s_district" id="edit_s_district" style="width:100%" multiple>
                      <option value="">Select District</option>
                      <?php foreach($district as $da){ ?>
                         <option value="<?php echo $da->id ?>"><?php echo $da->district ?></option>
                      <?php } ?>
                  </select>
                </div>
                
               <div class="form-group hidden" id="edit_region_div">
                  <label>Region</label> <span id="edit_reigion_error" style="color: red;">*</span>
                  <select class="form-control select2" name="edit_region" id="edit_region" style="width:100%" multiple>
                      <option value="">Select Region</option>
                      <?php foreach($reigions as $da){ ?>
                         <option value="<?php echo $da->id ?>"><?php echo $da->reigion ?></option>
                      <?php } ?>
                  </select>
                </div>
               
                <div class="form-group">
                    <label>Name</label><span id="edit_reigion_error" style="color: red;">*</span>
                    <input type="text" class="form-control" name="edit_username" id="edit_username">
                </div>
                
                 <div class="form-group">
                    <label>Email id</label><span id="edit_email_error" style="color: red;">*</span>
                    <input type="text" class="form-control" name="edit_email" id="edit_email">
                </div>
                
                 <div class="form-group">
                    <label>Password</label><span id="edit_reigion_error" style="color: red;">*</span>
                    <input type="text" class="form-control" name="edit_password" id="edit_password">
                </div>
                
                <div class="form-group">
                    <label>Mobile number</label><span id="edit_reigion_error" style="color: red;">*</span>
                    <input type="text" class="form-control" name="edit_mobile" id="edit_mobile">
                </div>
                
                <input type="hidden" id="edit_id">
                
                 <div class="form-group">
                    <label>Address</label>
                    <textarea class="form-control" name="edit_address" id="edit_address" rows="3"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-sm btn-primary" id="edit_btn">Submit</button>
            </div>
        </div>
    </div>
  </div>
  
     <div class="modal fade" id="user_mod" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">User Permissions</h4>
        </div>
        <div class="modal-body">
          
          <div class="form-group">
               <input class="form-check-input check" type="checkbox" value="Yes" id="select_all">
                    &nbsp;Select All
          </div>
          
          
          <input type="hidden" id="permission_id"> 
          
          <div class="row">
              <div class = "col-md-5">
                <label>POS  </label>
              </div>
              
              <div class="col-md-1">
                  <p>:</p>
              </div>
              
              <div class="col-md-2">
                  <input class="form-check-input check" type="checkbox" value="1" id="pos_add">&nbsp;Add
              </div>
              
              <div class="col-md-2">
                  <input class="form-check-input check" type="checkbox" value="1" id="pos_edit">&nbsp;Edit
              </div>
              
              <div class="col-md-2">
                  <input class="form-check-input check" type="checkbox" value="1" id="pos_view">&nbsp;View
              </div>
              
          </div>
          
          <div class="row">
              <div class = "col-md-5">
                <label>Agent </label>
              </div>
              
              <div class="col-md-1">
                  <p>:</p>
              </div>
              
              <div class="col-md-2">
                  <input class="form-check-input check" type="checkbox" value="1" id="agent_add">&nbsp;Add
              </div>
              
              <div class="col-md-2">
                  <input class="form-check-input check" type="checkbox" value="1" id="agent_edit">&nbsp;Edit
              </div>
              
              <div class="col-md-2">
                  <input class="form-check-input check" type="checkbox" value="1" id="agent_view">&nbsp;View
              </div>
              
          </div>
          
          <div class="row">
              <div class = "col-md-5">
                <label>Lead </label>
              </div>
              
              <div class="col-md-1">
                  <p>:</p>
              </div>
              
              <div class="col-md-2">
                  <input class="form-check-input check" type="checkbox" value="1" id="masters_add">&nbsp;Add
              </div>
              
            <!--  <div class="col-md-2">
                  <input class="form-check-input check" type="checkbox" value="1" id="masters_edit">&nbsp;Edit
              </div>
              -->
              <div class="col-md-2">
                  <input class="form-check-input check" type="checkbox" value="1" id="masters_view">&nbsp;View
              </div>
              
              
          </div>
          <div class="row">
              <div class = "col-md-5">
                <label> Renewals Lead</label>
              </div>
              
              <div class="col-md-1">
                  <p>:</p>
              </div>
              
              <div class="col-md-3">
                  <input class="form-check-input check" type="checkbox" value="1" id="lead_renewals_view">&nbsp;view
              </div>
              <div class="col-md-3">
                  <input class="form-check-input check" type="checkbox" value="1" id="lead_renewals_action">&nbsp;Assign
              </div>
          </div>

          <div class="row">
              <div class = "col-md-5">
                <label>Follow Ups  </label>
              </div>
              
              <div class="col-md-1">
                  <p>:</p>
              </div>
              
            <!--    <div class="col-md-2">
                  <input class="form-check-input check" type="checkbox" value="1" id="follow_add">&nbsp;Add
              </div>
              
            <div class="col-md-2">
                  <input class="form-check-input check" type="checkbox" value="1" id="follow_edit">&nbsp;Edit
              </div>-->
              
              <div class="col-md-2">
                  <input class="form-check-input check" type="checkbox" value="1" id="follow_view">&nbsp;View
              </div>
              
          </div>
          <div class="row">
              <div class = "col-md-5">
                <label>Customers</label>
              </div>
              
              <div class="col-md-1">
                  <p>:</p>
              </div>
              
          <!--    <div class="col-md-2">
                  <input class="form-check-input check" type="checkbox" value="1" id="cust_add">&nbsp;Add
              </div>
              
              <div class="col-md-2">
                  <input class="form-check-input check" type="checkbox" value="1" id="cust_edit">&nbsp;Edit
              </div>
              -->
              <div class="col-md-2">
                  <input class="form-check-input check" type="checkbox" value="1" id="cust_view">&nbsp;View
              </div>
              
          </div>
           <div class="row">
              <div class = "col-md-5">
                <label> Renewals </label>
              </div>
              
              <div class="col-md-1">
                  <p>:</p>
              </div>
              
              <div class="col-md-3">
                  <input class="form-check-input check" type="checkbox" value="1" id="renewals_view">&nbsp;view
              </div>
          </div>

       <!--   <div class="row">
              <div class = "col-md-5">
                <label>Policy</label>
              </div>
              
              <div class="col-md-1">
                  <p>:</p>
              </div>
              
              <div class="col-md-2">
                  <input class="form-check-input check" type="checkbox" value="1" id="business_add">&nbsp;Business Complete
              </div>
              
              <div class="col-md-2">
                  <input class="form-check-input check" type="checkbox" value="1" id="business_edit">&nbsp;Active Policy
              </div>
              
              <div class="col-md-2">
                  <input class="form-check-input check" type="checkbox" value="1" id="business_view">&nbsp;View
              </div>
              
          </div>-->

          <div class="row">
              <div class = "col-md-5">
                <label>AI Performance</label>
              </div>
              
              <div class="col-md-1">
                  <p>:</p>
              </div>
              
              <div class="col-md-2">
                  <input class="form-check-input check" type="checkbox" value="1" id="ai_add">&nbsp;Add
              </div>
              
            <!--  <div class="col-md-2">
                  <input class="form-check-input check" type="checkbox" value="1" id="ai_edit">&nbsp;Edit
              </div>
              -->
              <div class="col-md-2">
                  <input class="form-check-input check" type="checkbox" value="1" id="ai_view">&nbsp;View
              </div>
              
          </div>

          <div class="row">
              <div class = "col-md-5">
                <label>Claim </label>
              </div>
              
              <div class="col-md-1">
                  <p>:</p>
              </div>
              
              <div class="col-md-2">
                  <input class="form-check-input check" type="checkbox" value="1" id="claim_add">&nbsp;Add
              </div>
              
          <!--    <div class="col-md-2">
                  <input class="form-check-input check" type="checkbox" value="1" id="claim_edit">&nbsp;Action
              </div>
              -->
              <div class="col-md-2">
                  <input class="form-check-input check" type="checkbox" value="1" id="claim_view">&nbsp;View
              </div>
              
          </div>

          
          
          <div class="row">
              <div class = "col-md-5">
                <label>Policy </label>
              </div>
              
              <div class="col-md-1">
                  <p>:</p>
              </div>
              
              <div class="col-md-3">
                  <input class="form-check-input check" type="checkbox" value="1" id="policy_view">&nbsp;Business Complete
              </div>
              
               <div class="col-md-3">
                  <input class="form-check-input check" type="checkbox" value="1" id="policy_add">&nbsp;Active Policy
              </div>
              
          </div>
          
         
          <div class="row">
              <div class = "col-md-5">
                <label> Failure Leads </label>
              </div>
              
              <div class="col-md-1">
                  <p>:</p>
              </div>
              
              <div class="col-md-3">
                  <input class="form-check-input check" type="checkbox" value="1" id="fail_view">&nbsp;view
              </div>
          </div>
          
          <?php if($this->session->userdata('session_company_type') == "unicorn"){ ?>
          <div class="row" id="unicon_div">
              <div class = "col-md-5">
                <label> Unicorn </label>
              </div>
              
              <div class="col-md-1">
                  <p>:</p>
              </div>
              
              <div class="col-md-3">
                  <input class="form-check-input check" type="checkbox" value="0" id="unicon_access">&nbsp;Access
              </div>
          </div>
        <?php } ?>
        </div>
        <div class="modal-footer">
            
          <button type="button" class="btn btn-primary" id="add_permission_btn">Submit</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
  
  
     <div class="modal fade in" id="change_modal">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true" style="color:white;">×</span></button>
                <h4 class="modal-title text-center">New Category</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                  <label>Assign New FOE</label> <span id="add_name_error" style="color: red;">*</span>
                     <select class="form-control" name="select_foe" id="select_foe">
                     </select>
                </div>
                
                <input type="hidden" id="current_foe_id">
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-sm btn-primary" id="change_btn">Submit</button>
            </div>
        </div>
    </div>
  </div>
  

  <div class="modal fade in" id="change_ai_modal">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true" style="color:white;">×</span></button>
                <h4 class="modal-title text-center">Change AI</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                  <label>Assign New AI</label> <span id="add_name_error" style="color: red;">*</span>
                     <select class="form-control select2" style="width:100%" name="select_ai" id="select_ai">
                     </select>
                </div>
                
                <input type="hidden" id="current_ai_id">
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-sm btn-primary" id="change_btn_ai">Submit</button>
            </div>
        </div>
    </div>
  </div>
  
  
  <div class="modal fade in" id="swap_ai_modal">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true" style="color:white;">×</span></button>
                <h4 class="modal-title text-center">Swapping Ai Data</h4>
            </div>
            <div class="modal-body">
                
                <div class="form-group">
                  <label>From AI</label> <span id="add_name_error" style="color: red;">*</span>
                     <select class="form-control" name="select_first_ai" id="select_first_ai">
                     </select>
                </div>
                
                <div class="form-group">
                  <label>To AI</label> <span id="add_name_error" style="color: red;">*</span>
                     <select class="form-control select2" style="width:100%" name="select_to_ai" id="select_to_ai">
                     </select>
                </div>
                
                <input type="hidden" id="swap_ai_id">
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-sm btn-primary" id="swap_ai_btn">Submit</button>
            </div>
        </div>
    </div>
  </div>
  
<script>
    
    
  var role = 'user';
     
     $(document).ready(function(){

          $('.select2').select2();
         fetch_users(role);
         
         $("#add_btn").click(function(){
          var district = $("#add_district").val();
          var region = $("#add_region").val();
          var position = $("#select_position").val(); 
          var username = $("#add_username").val();
          var password = $("#add_password").val();
          var email = $("#add_email").val();
          var mobile = $("#add_mobile").val();   
          var address = $("#add_address").val();
          
          var check = 0;

          if(position == "")
          {
              snackbar_show("Select Role");
            check = 1;  
          }
          else if(position == "user" && district == "")
          {
              snackbar_show("Select District");
              check = 1;
          }
          else if(position == "AI" && region == "")
          {
              snackbar_show("Select Region");
              check = 1;
          }
          else if(username == "")
          {
              snackbar_show("Enter a Name");
              check = 1; 
          }
          else if(password == "")
          {
              snackbar_show("Enter a Password");
              check = 1; 
          }
          else if(email == "")
          {
              snackbar_show("Enter a Email");
              check = 1; 
          }
          else if(mobile == "")
          {
              snackbar_show("Enter a mobile Number");
              check = 1; 
          }
          else if(check != 1)
          {
            
            if(position == "user")
            {
                region = "";
            }
            else if(position == "AI")
            {
                district = "";
            }
              
            $.ajax({
             url : "add_users",
             method : "POST",
             data :{username:username,region:region,district:district,position:position,password:password,email:email,mobile:mobile,address:address},
             beforeSend:function(){
                 $("#add_btn").attr("disabled",true);
             },
             success:function(response)
             {
                 if(response =="Exits")
                 {
                     $("#add_btn").attr("disabled",false);
                     $("#add_email_error").html("* This email already exits.");
                 }
                 else
                 {
                    $("#add_btn").attr("disabled",false);   
                    $("#add_model").modal("toggle");
                    $("#select_reigion").val("");
                    $("#add_email_error").html("");
                    $("#add_reigion").val("");
                    $("#add_username").val("");
                    $("#add_password").val("");
                    $("#add_email").val("");
                    $("#add_mobile").val("");   
                    $("#add_address").val("");
                    fetch_users(role);
                 }
                
             }
         }); 
      }
      });
      
         $("#edit_btn").click(function(){
          var id = $("#edit_id").val();
          var district = $("#edit_district").val();
          var region = $("#edit_region").val();
          var role = $("#edit_role").val();
          var username = $("#edit_username").val();
          var password = $("#edit_password").val();
          var email = $("#edit_email").val();
          var mobile = $("#edit_mobile").val();   
          var address = $("#edit_address").val();
          
          var s_district = $("#edit_s_district").val();
          
          var check = 0;
          
          if(role == "")
          {
            snackbar_show("Select Role");
            check = 1; 
          }
           else if(role == "user" && district == "")
          {
              snackbar_show("Select District");
              check = 1;
          }
          else if(role == "AI" && region == "")
          {
              snackbar_show("Select Region");
              check = 1;
          }
          else if(username == "")
          {
              snackbar_show("Enter Username");
              check = 1; 
          }
          else if(password == "")
          {
              snackbar_show("Enter Password");
              check = 1; 
          }
          else if(email == "")
          {
              snackbar_show("Enter Email");
              check = 1; 
          }
          else if(mobile == "")
          {
              snackbar_show("Enter mobile");
              check = 1; 
          }
          else if(check != 1)
          {
              
            if(role == "user")
            {
                region = "";
            }
            else if(role == "AI")
            {
                district = "";
            }
            $.ajax({
             url : "edit_users",
             method : "POST",
             data :{id:id,username:username,district:district,s_district:s_district,region:region,role:role,password:password,email:email,mobile:mobile,address:address},
             beforeSend:function(){
                 $("#edit_btn").attr("disabled",true);
             },
             success:function(response)
             {
                 if(response =="Exits")
                 {
                     $("#edit_btn").attr("disabled",false);
                     $("#edit_email_error").html("* This email already exits.");
                 }
                 else
                 {
                        $("#edit_role").val("");
                        $("#edit_btn").attr("disabled",false);   
                        $("#edit_model").modal("toggle");
                        $("#edit_email_error").html("");
                        $("#edit_reigion").val("");
                        $("#edit_username").val("");
                        $("#edit_password").val("");
                        $("#edit_email").val("");
                        $("#edit_mobile").val("");   
                        $("#edit_address").val("");
                        fetch_users(role);
                 }
                
             }
         }); 
      }
      });
      
         $("#add_permission_btn").click(function(){
        
        
         var user_id = $("#permission_id").val();
         var pos_add  = ($("#pos_add").prop("checked"))?"1":"0";
         var pos_edit  = ($("#pos_edit").prop("checked"))?"1":"0";
         var pos_view  = ($("#pos_view").prop("checked"))?"1":"0";
         var agent_add  = ($("#agent_add").prop("checked"))?"1":"0";
         var agent_edit  = ($("#agent_edit").prop("checked"))?"1":"0";
         var agent_view  = ($("#agent_view").prop("checked"))?"1":"0";
         var masters_add  = ($("#masters_add").prop("checked"))?"1":"0";
         var masters_edit  = ($("#masters_edit").prop("checked"))?"1":"0";
         var masters_view  = ($("#masters_view").prop("checked"))?"1":"0";
         var email_add  = ($("#email_add").prop("checked"))?"1":"0";
         var email_edit  = ($("#email_edit").prop("checked"))?"1":"0";
         var email_view  = ($("#email_view").prop("checked"))?"1":"0";
         var policy_add  = ($("#policy_add").prop("checked"))?"1":"0";
         var policy_view  = ($("#policy_view").prop("checked"))?"1":"0";
         var renewals_view  = ($("#renewals_view").prop("checked"))?"1":"0";
         var unicon_access  = ($("#unicon_access").prop("checked"))?"1":"0";
         
         
         //
         var lead_renewals_view  = ($("#lead_renewals_view").prop("checked"))?"1":"0";
         var lead_renewals_action  = ($("#lead_renewals_action").prop("checked"))?"1":"0";
         var follow_add  = ($("#follow_add").prop("checked"))?"1":"0";
         var follow_edit  = ($("#follow_edit").prop("checked"))?"1":"0";
         var follow_view  = ($("#follow_view").prop("checked"))?"1":"0";
         var cust_add  = ($("#cust_add").prop("checked"))?"1":"0";
         var cust_edit  = ($("#cust_edit").prop("checked"))?"1":"0";
         var cust_view  = ($("#cust_view").prop("checked"))?"1":"0";
         var business_add  = ($("#business_add").prop("checked"))?"1":"0";
         var business_edit  = ($("#business_edit").prop("checked"))?"1":"0";
         var business_view  = ($("#business_view").prop("checked"))?"1":"0";
         var ai_add  = ($("#ai_add").prop("checked"))?"1":"0";
         var ai_edit  = ($("#ai_edit").prop("checked"))?"1":"0";
         var ai_view  = ($("#ai_view").prop("checked"))?"1":"0";
         var claim_add  = ($("#claim_add").prop("checked"))?"1":"0";
         var claim_edit  = ($("#claim_edit").prop("checked"))?"1":"0";
         var claim_view  = ($("#claim_view").prop("checked"))?"1":"0";
         var fail_view  = ($("#fail_view").prop("checked"))?"1":"0";
         //
         $.ajax({
                    url : "add_user_permissions",
                    method : "POST",
                    data : {user_id: user_id,
                            pos_add: pos_add,
                            pos_edit: pos_edit,
                            pos_view: pos_view,
                            agent_add: agent_add,
                            agent_edit: agent_edit,
                            agent_view: agent_view,
                            masters_add: masters_add,
                            masters_edit: masters_edit,
                            masters_view: masters_view,
                            email_add: email_add,
                            email_edit: email_edit,
                            email_view: email_view,
                            policy_add: policy_add,
                            policy_view: policy_view,
                            renewals_view: renewals_view,
                            unicon_access: unicon_access,
                            lead_renewals_view: lead_renewals_view,
                            lead_renewals_action: lead_renewals_action,
                            follow_add: follow_add,
                            follow_edit: follow_edit,
                            follow_view: follow_view,
                            cust_add: cust_add,
                            cust_edit: cust_edit,
                            cust_view: cust_view,
                            business_add: business_add,
                            business_edit: business_edit,
                            business_view: business_view,
                            ai_add: ai_add,
                            ai_edit: ai_edit,
                            ai_view: ai_view,
                            claim_add: claim_add,
                            claim_edit: claim_edit,
                            claim_view: claim_view,
                            fail_view:fail_view
                    },
                    
                    beforeSend:function(){
                        $("#add_permission_btn").attr("disabled",true);
                    },
                    success:function(response)
                    {    
                        $("#add_permission_btn").attr("disabled",false);
                        $(".form-check-input").prop("checked",false);
                        $("#user_mod").modal("toggle");
                        
                           Swal.fire(
                              'Good job!',
                              'User Permissions Added Successfully !',
                              'success'
                            )
                        
                    }
         });
    });
         
         
          $("#select_all").click(function(){
              
                  if($("#select_all").prop("checked") == true)
                  {
                       $(".check").prop('checked', true);
                  }
                  else
                  {
                      $(".check").prop('checked', false);
                  }
             });
             
             
          $("#select_position").change(function(){
              
                  var position = $("#select_position").val();
                 
                 if(position == "user")
                 {
                     $("#region_div").addClass("hidden");
                     $("#district_div").removeClass("hidden");
                     $("#add_region").val("");
                 }
                 else if(position = "AI")
                 {
                     $("#region_div").removeClass("hidden");
                     $("#district_div").addClass("hidden");
                      $("#add_district").val("");
                 }
                 
                 
             });
             
             
            $("#edit_role").change(function(){
               
                var role = $("#edit_role").val();
                 alert(role);
                 if(role == "user")
                 {
                     $("#edit_region_div").addClass("hidden");
                     $("#edit_district_div").removeClass("hidden");
                     $("#edit_region").val("");
                 }
                 else if(role = "AI")
                 {
                     $("#edit_region_div").removeClass("hidden");
                     $("#edit_district_div").addClass("hidden");
                      $("#edit_district").val("");
                 }
             });
             
             
            $("#change_btn").click(function(){
               
               var select_foe = $("#select_foe").val();
               var current_foe_id = $("#current_foe_id").val();
               
               $.ajax({
                         url : "change_foe_active_records",
                         method : "POST",
                         data : {select_foe:select_foe,current_foe_id:current_foe_id},
                         beforeSend: function(){
                             $("#change_btn").attr("disabled",true);
                         },
                         success:function(response)
                         {
                             snackbar_show("Data Changed Successfully");
                             $("#change_btn").attr("disabled",false);
                             $("#change_modal").modal("toggle");  
                             fetch_users(role);
                         }
               });
               
               
               
                
            }); 
            
             $("#change_btn_ai").click(function(){
               
                   var select_ai = $("#select_ai").val();
                   var current_ai_id = $("#current_ai_id").val();
                   
                   $.ajax({
                             url : "change_ai_active_records",
                             method : "POST",
                             data : {select_ai:select_ai,current_ai_id:current_ai_id},
                             beforeSend: function(){
                                 $("#change_btn_ai").attr("disabled",true);
                             },
                             success:function(response)
                             {
                                 snackbar_show("Data Changed Successfully");
                                 $("#change_btn_ai").attr("disabled",false);
                                 $("#change_ai_modal").modal("toggle");  
                                 fetch_users(role);
                             }
                   });
            }); 
            
            
            $("#swap_ai_btn").click(function(){
                var swap_ai_1 = $("#swap_ai_id").val();
                var swap_ai_2 = $("#select_to_ai").val();
                
                  $.ajax({
                             url : "swap_ai_data",
                             method : "POST",
                             data : {swap_ai_1:swap_ai_1,swap_ai_2:swap_ai_2},
                             beforeSend: function(){
                                 $("#swap_ai_btn").attr("disabled",true);
                             },
                             success:function(response)
                             {
                                 snackbar_show("Data Changed Successfully");
                                 $("#swap_ai_btn").attr("disabled",false);
                                 $("#swap_ai_modal").modal("toggle");  
                                 fetch_users(role);
                             }
                   });
            });
            
            $("#report_btn").click(function(){
                
                var select_date = $("#select_date").val();
                var select_order_by = $("#select_order_by").val();
                
                if(select_date == "")
                {
                    snackbar_show("Select Date");
                }
                else if(select_order_by == "")
                {
                    snackbar_show("Select Order By");
                }
                else 
                {
                    window.open("feo_report?date="+select_date+"&order_by="+select_order_by);
                }
                 
            });
     
     });
      
      
      function fetch_users(role)
      {
          if(role == "user")
          {
              var th = "District";
          }
          else if(role == "AI")
          {
              var th = "Region";
          }
          var content = "";
          content += "<div class='table-responsive'>";
          content += "<table id='table_id' class='table table-hover table-bordered'>"; 
          content += "<thead><th>S.No</th><th>"+th+"</th><th>Username</th><th>Password</th><th>Email id</th><th>Phone no</th><th>Action_Records(Buttons)</th></thead>";
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
                'url':'fetch_users',
                'method' : 'POST',
                'data':{role:role},
              }
          });      
      }
      
      function edit_data(id)
      {
          $.ajax({
              url : "fetch_edit_users_data",
              method : "POST",
              data :{id:id},
              success:function(response)
              {
                var obj = jQuery.parseJSON(response);
                $("#edit_reigion").val(obj["u_data"].reigion_id);
                $("#edit_role").val(obj["u_data"].role);

                if(obj["u_data"].role == "user")
                {
                     $("#edit_region_div").addClass("hidden");
                     $("#edit_district_div").removeClass("hidden");
                     $("#edit_district").val(obj["data"]);
                     $("#edit_district").trigger("change");
                     $("#s_district_div").removeClass("hidden");
                     $("#edit_s_district").val(obj["s_district"]);
                     $("#edit_s_district").trigger("change");
                     
                }
                else if(obj["u_data"].role == "AI")
                {
                     $("#edit_region_div").removeClass("hidden");
                     $("#edit_district_div").addClass("hidden");
                     $("#edit_region").val(obj["data"]);
                     $("#edit_region").trigger("change");
                     $("#s_district_div").addClass("hidden");
                }
                $("#edit_username").val(obj["u_data"].username);
                $("#edit_password").val(obj["u_data"].password);
                $("#edit_email").val(obj["u_data"].email_id);
                $("#edit_mobile").val(obj["u_data"].phoneno);   
                $("#edit_address").val(obj["u_data"].address);
                $("#edit_id").val(id);
                $("#edit_model").modal("toggle");
              }
          });
      }
      
      function delete_data(id)
      {
            if(confirm("Are you Confirm to Delete"))
              {
                $.ajax({
                  url:"delete_users",
                  data:{id:id},
                  method:"POST",
                  success:function(response){
                      alert("Deleted successfully")
                      fetch_users(role);
                  },
                  error: function(code) {   
                    alert(code.statusText);
                  },
                });
              }
      }
      
      
      function permission(id)
      {
          $.ajax({
                     url : "fetch_user_permissions",
                     method : "POST",
                     data : {id:id},
                     success:function(response)
                     {
                        
                         var obj = jQuery.parseJSON(response);
                      //   alert(obj.fail_view);
                         if(obj.pos_add == "1")
                         {
                              $("#pos_add").prop("checked",true);
                         }
                         else
                         {
                              $("#pos_add").prop("checked",false);
                         }
                         
                         if(obj.pos_edit == "1")
                         {
                              $("#pos_edit").prop("checked",true);
                         }
                         else
                         {
                              $("#pos_edit").prop("checked",false);
                         }
                         
                         if(obj.pos_view == "1")
                         {
                              $("#pos_view").prop("checked",true);
                         }
                         else
                         {
                              $("#pos_view").prop("checked",false);
                         }
                         
                         if(obj.agent_add == "1")
                         {
                              $("#agent_add").prop("checked",true);
                         }
                         else
                         {
                              $("#agent_add").prop("checked",false);
                         }
                         
                         if(obj.agent_edit == "1")
                         {
                              $("#agent_edit").prop("checked",true);
                         }
                         else
                         {
                              $("#agent_edit").prop("checked",false);
                         }
                         
                         if(obj.agent_view == "1")
                         {
                              $("#agent_view").prop("checked",true);
                         }
                         else
                         {
                              $("#agent_view").prop("checked",false);
                         }
                         
                         
                         if(obj.masters_add == "1")
                         {
                              $("#masters_add").prop("checked",true);
                         }
                         else
                         {
                              $("#masters_add").prop("checked",false);
                         }
                         
                         
                         if(obj.masters_edit == "1")
                         {
                              $("#masters_edit").prop("checked",true);
                         }
                         else
                         {
                              $("#masters_edit").prop("checked",false);
                         }
                         
                         
                         if(obj.masters_view == "1")
                         {
                              $("#masters_view").prop("checked",true);
                         }
                         else
                         {
                              $("#masters_view").prop("checked",false);
                         }
                         
                         
                         if(obj.email_add == "1")
                         {
                              $("#email_add").prop("checked",true);
                         }
                         else
                         {
                              $("#email_add").prop("checked",false);
                         }
                         
                         if(obj.email_edit == "1")
                         {
                              $("#email_edit").prop("checked",true);
                         }
                         else
                         {
                              $("#email_edit").prop("checked",false);
                         }
                         
                         if(obj.email_view == "1")
                         {
                              $("#email_view").prop("checked",true);
                         }
                         else
                         {
                              $("#email_view").prop("checked",false);
                         }
                         
                         
                         if(obj.policy_add == "1")
                         {
                              $("#policy_add").prop("checked",true);
                         }
                         else
                         {
                              $("#policy_add").prop("checked",false);
                         }
                         
                         if(obj.policy_view == "1")
                         {
                              $("#policy_view").prop("checked",true);
                         }
                         else
                         {
                              $("#policy_view").prop("checked",false);
                         }

                         if(obj.renewals_view == "1")
                         {
                              $("#renewals_view").prop("checked",true);
                         }
                         else
                         {
                              $("#renewals_view").prop("checked",false);
                         }
                         if(obj.role == "user")
                         {
                             $("#unicon_div").removeClass('hidden');
                             if(obj.unicon_access == "1")
                             {
                                  $("#unicon_access").prop("checked",true);
                             }
                             else
                             {
                                  $("#unicon_access").prop("checked",false);
                             }
                         }
                         else
                         {
                              $("#unicon_div").addClass('hidden');
                         }
                         
                         
                         ///
                         if(obj.lead_renewals_view == "1")
                         {
                              $("#lead_renewals_view").prop("checked",true);
                         }
                         else
                         {
                              $("#lead_renewals_view").prop("checked",false);
                         }
                         
                         if(obj.lead_renewals_action == "1")
                         {
                              $("#lead_renewals_action").prop("checked",true);
                         }
                         else
                         {
                              $("#lead_renewals_action").prop("checked",false);
                         }
                         
                         if(obj.follow_add == "1")
                         {
                              $("#follow_add").prop("checked",true);
                         }
                         else
                         {
                              $("#follow_add").prop("checked",false);
                         }
                         
                         
                         if(obj.follow_edit == "1")
                         {
                              $("#follow_edit").prop("checked",true);
                         }
                         else
                         {
                              $("#follow_edit").prop("checked",false);
                         }
                         
                         if(obj.follow_view == "1")
                         {
                              $("#follow_view").prop("checked",true);
                         }
                         else
                         {
                              $("#follow_view").prop("checked",false);
                         }

                         if(obj.cust_add == "1")
                         {
                              $("#cust_add").prop("checked",true);
                         }
                         else
                         {
                              $("#cust_add").prop("checked",false);
                         }
                         if(obj.cust_edit == "1")
                         {
                              $("#cust_edit").prop("checked",true);
                         }
                         else
                         {
                              $("#cust_edit").prop("checked",false);
                         }
                         
                         if(obj.cust_view == "1")
                         {
                              $("#cust_view").prop("checked",true);
                         }
                         else
                         {
                              $("#cust_view").prop("checked",false);
                         }
                         
                         if(obj.business_add == "1")
                         {
                              $("#business_add").prop("checked",true);
                         }
                         else
                         {
                              $("#business_add").prop("checked",false);
                         }
                         
                         
                         if(obj.business_edit == "1")
                         {
                              $("#business_edit").prop("checked",true);
                         }
                         else
                         {
                              $("#business_edit").prop("checked",false);
                         }
                         
                         if(obj.business_view == "1")
                         {
                              $("#business_view").prop("checked",true);
                         }
                         else
                         {
                              $("#business_view").prop("checked",false);
                         }

                         if(obj.ai_add == "1")
                         {
                              $("#ai_add").prop("checked",true);
                         }
                         else
                         {
                              $("#ai_add").prop("checked",false);
                         }
                         
                          if(obj.ai_edit == "1")
                         {
                              $("#ai_edit").prop("checked",true);
                         }
                         else
                         {
                              $("#ai_edit").prop("checked",false);
                         }
                         
                         if(obj.ai_view == "1")
                         {
                              $("#ai_view").prop("checked",true);
                         }
                         else
                         {
                              $("#ai_view").prop("checked",false);
                         }
                         
                         if(obj.claim_add == "1")
                         {
                              $("#claim_add").prop("checked",true);
                         }
                         else
                         {
                              $("#claim_add").prop("checked",false);
                         }
                         
                         
                         if(obj.claim_edit == "1")
                         {
                              $("#claim_edit").prop("checked",true);
                         }
                         else
                         {
                              $("#claim_edit").prop("checked",false);
                         }
                         
                         if(obj.claim_view == "1")
                         {
                              $("#claim_view").prop("checked",true);
                         }
                         else
                         {
                              $("#claim_view").prop("checked",false);
                         }

                         if(obj.policy_add == "1")
                         {
                              $("#policy_add").prop("checked",true);
                         }
                         else
                         {
                              $("#policy_add").prop("checked",false);
                         }
                         if(obj.policy_view == "1")
                         {
                              $("#policy_view").prop("checked",true);
                         }
                         else
                         {
                              $("#policy_view").prop("checked",false);
                         }
                         
                         if(obj.fail_view == "1")
                         {
                              $("#fail_view").prop("checked",true);
                         }
                         else
                         {
                              $("#fail_view").prop("checked",false);
                         }
                         
                         if(obj.business_add == "1")
                         {
                              $("#business_add").prop("checked",true);
                         }
                         else
                         {
                              $("#business_add").prop("checked",false);
                         }
                         
                         
                         if(obj.business_edit == "1")
                         {
                              $("#business_edit").prop("checked",true);
                         }
                         else
                         {
                              $("#business_edit").prop("checked",false);
                         }
                         
                         if(obj.business_view == "1")
                         {
                              $("#business_view").prop("checked",true);
                         }
                         else
                         {
                              $("#business_view").prop("checked",false);
                         }

                         if(obj.ai_add == "1")
                         {
                              $("#ai_add").prop("checked",true);
                         }
                         else
                         {
                              $("#ai_add").prop("checked",false);
                         }
                         ///
                         
                         
                         
                         $("#permission_id").val(id);
                         $("#user_mod").modal("toggle");
                     }
          });
      }
      
      function change_data(id)
      {
          if(confirm("Are you Confirm to Change Active Datas to Another FOE"))
          {
              $.ajax({
                         url : "get_foe",
                         method : "POST",
                         data : {id:id},
                         success:function(response)
                         {
                            $("#select_foe").html(response);
                            $("#current_foe_id").val(id);
                            $("#change_modal").modal("toggle");     
                         }
              });
          }
      }
      
      function change_ai_data(id)
      {
          if(confirm("Are you Confirm to Change Active Datas to Another AI"))
          {
              $.ajax({
                         url : "get_ai_data",
                         method : "POST",
                         data : {id:id},
                         success:function(response)
                         {
                            $("#select_ai").html(response);
                            $("#current_ai_id").val(id);
                            $("#change_ai_modal").modal("toggle");     
                         }
              });
          }
      }
      
      
      function swap_data(id)
      {
          if(confirm("Are you Confirm to Swaping Data"))
          {
               $.ajax({
                         url : "get_swap_ai_data",
                         method : "POST",
                         data : {id:id},
                         success:function(response)
                         {
                             var obj = jQuery.parseJSON(response);
                            $("#select_to_ai").html(obj["other_ai"]);
                            $("#select_first_ai").html(obj["current_ai"]);
                            $("#swap_ai_id").val(id);
                            $("#swap_ai_modal").modal("toggle");     
                         }
              });
          }
      }

    
    
</script>
  
