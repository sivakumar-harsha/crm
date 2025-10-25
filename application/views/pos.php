<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

 <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1 style="font-size: 17px;">
        Pos
        <button data-toggle="modal" data-target="#add_model" class="btn btn-primary btn-sm pull-right hidden" id="add_mod">Add New</button>
        <button style="margin-right:10px;" class="btn btn-success btn-sm pull-right" id="export_excel"><i class="fa fa-file-excel-o" aria-hidden="true"></i>&nbsp; Export Excel</button>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Default box -->
      <div class="box">
        <div class="box-body">
            
    <div class="nav-tabs-custom">
		<ul class="nav nav-tabs bg-info">
		  <li class="active" id="main_pos_li" ><a href="#tab_content" data-toggle="tab" aria-expanded="true" onclick="fetch_pos('0','')">Main Pos</a></li>
		  <li class="" id="sub_pos_li"><a href="#tab_content" data-toggle="tab" aria-expanded="false" onclick="fetch_pos('1','all')">Sub Pos</a></li>
		  
		  <li class="pull-right" >
		      <select class="form-control" name="select_pos" id="select_pos">
		        <option value="all">All</option>
		        <?php foreach($pos as $da) { ?>
		           <option value="<?php echo $da->id ?>"><?php echo $da->name." (".$da->agent_pos_code.")" ?></option>
		        <?php } ?>
		      </select>
		  </li>
		  
		</ul>
	</div>
	
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
                <h4 class="modal-title text-center">Add POS</h4>
            </div>
            
            <div class="modal-body row">
                 <div class="col-md-6">
                        <div class="form-group row">
                            <div class="col-md-5">
                                <label class="pull-right">Pos / Sub Pos <span style="color: red;">*</span> </label>
                            </div>
                            <div class="col-md-7">
                                <select class="form-control" name="add_pos_or_sub_pos" id="add_pos_or_sub_pos">
                                     <option value="Pos">Pos</option>
                                     <option value="sub_pos">Sub Pos</option>
                              </select>
                          </div>
                        </div>
                        
                        <div class="form-group row hidden" id="pos_div">
                            <div class="col-md-5">
                                <label class="pull-right">Select Main Pos <span style="color: red;">*</span></label>
                            </div>
                            <div class="col-md-7">
                                <select class="form-control select2" name="add_pos_code" id="add_pos_code" style='width:100%'>
                                    
                              </select>
                          </div>
                        </div>
                        
                         <div class="form-group row">
                               <div class="col-md-5">
                                    <label class="pull-right">Region <span id="add_reigion_error" style="color: red;">*</span></label>
                                </div>
                                <div class="col-md-7">
                                    <select class='form-control select2' name="add_region" id="add_region" style="width:100%">
                                        <option value=''>--Select--</option>
                                        <?php foreach($regions as $da){ ?>
                                             <option value="<?php echo $da->id ?>"><?php echo $da->reigion ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                      
                       <div class="form-group row">
                           <div class="col-md-5">
                                <label class="pull-right">Email id <span id="add_email_error" style="color: red;">*</span></label>
                            </div>
                            <div class="col-md-7">
                                <input type="text" class="form-control" name="add_email" id="add_email">
                                <span style="color:red;" id="email_err"></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-5">
                                <label class="pull-right">Mobile number <span id="add_reigion_error" style="color: red;">*</span></label>
                            </div>
                            <div class="col-md-7">
                                <input type="text" class="form-control" name="add_mobile" id="add_mobile">
                                <span style="color:red;" id="mobile_err"></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-5">
                                <label class="pull-right">Aadhar Card no<span id="add_card_no_error" style="color: red;">*</span></label>
                            </div>
                            <div class="col-md-7">
                                <input type="number" class="form-control" name="add_aadhar_card_no" id="add_aadhar_card_no">
                                <span style="color:red;" id="adhar_err"></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-5">
                                <label class="pull-right">Address <span id="add_reigion_error" style="color: red;">*</span></label>
                            </div>
                            <div class="col-md-7">
                                <textarea class="form-control" name="add_address" id="add_address" rows="3"></textarea>
                            </div>
                        </div>
                        
                          <div class="form-group row">
                             <div class="col-md-5">
                                <label class="pull-right">Bank A/C No <span id="add_bank_ac_no_error" style="color: red;">*</span></label>
                            </div>
                            <div class="col-md-7">
                                <input type="text" class="form-control" name="add_bank_ac_no" id="add_bank_ac_no">
                            </div>
                        </div>
                         <div class="form-group row">
                             <div class="col-md-5">
                                <label class="pull-right">IFSC Code<span id="add_bank_ifsc_error" style="color: red;">*</span></label>
                            </div>
                            <div class="col-md-7">
                                <input type="text" class="form-control" name="add_bank_ifsc" id="add_bank_ifsc">
                            </div>
                        </div>
                        <div class="form-group row">
                             <div class="col-md-5">
                                <label class="pull-right">Pan card no <span style="color: red;">*</span> </label>
                            </div>
                            <div class="col-md-7">
                                <input type="text" class="form-control" name="add_pan_no" id="add_pan_no">
                            </div>
                        </div>
                        
                         <div class="form-group row">
                             <div class="col-md-5">
                                <label class="pull-right">Commission Category<span  style="color: red;">*</span></label>
                            </div>
                            <div class="col-md-7">
                                <select class="form-control" name="c_category" id="c_category">
                                    <option value="">--Select--</option>
                                    <option value="A">A Category</option>
                                    <option value="B">B Category</option>
                                    <option value="C">C Category</option>
                                    <option value="D">D Category</option>
                                </select>
                            </div>
                        </div>
                        
                    </div>
                    <div class="col-md-6">

                        <div class="form-group row">
                            <div class="col-md-5">
                                <label class="pull-right">Pos Name <span id="add_reigion_error" style="color: red;">*</span></label>
                            </div>
                            <div class="col-md-7">
                                <input type="text" class="form-control" name="add_username" id="add_username">
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <div class="col-md-5">
                                <label class="pull-right">User <span id="add_reigion_error" style="color: red;">*</span></label>
                          </div>
                          <div class="col-md-7">
                              <select class="form-control" name="add_user" id="add_user">
                                  <option value="">Select User</option>
                                  <option value="all">All Users</option>
                                  <?php foreach($users as $da){ ?>
                                     <option value="<?php echo $da->id ?>"><?php echo $da->username."  - ". $da->email_id.""?></option>
                                  <?php } ?>
                              </select>
                          </div>
                        </div>
                        
                        
                         <div class="form-group row">
                           <div class="col-md-5">
                                <label class="pull-right">Area Incharge <span id="add_reigion_error" style="color: red;">*</span></label>
                            </div>
                            <div class="col-md-7">
                                <select class='form-control select2' name="add_ai" id="add_ai" style="width:100%">
                                    <option value=''>--Select--</option>
                                </select>
                            </div>
                        </div>
                         <div class="form-group row">
                             <div class="col-md-5">
                                <label class="pull-right">Password <span id="add_reigion_error" style="color: red;">*</span></label>
                            </div>
                            <div class="col-md-7">
                                <input type="text" class="form-control" name="add_password" id="add_password">
                            </div>
                        </div>
                        <div class="form-group row">
                             <div class="col-md-5">
                                <label class="pull-right">Date of Birth <span id="add_dob_error" style="color: red;">*</span></label>
                            </div>
                            <div class="col-md-7">
                                <input type="date" class="form-control" name="add_dob" id="add_dob">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-5">
                                <label class="pull-right">Upload Aadhar card<span id="add_aadhar_card_error" style="color: red;">*</span></label>
                            </div>
                            <div class="col-md-7">
                                <input type="file" class="form-control" id="add_aadhar_card">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-5">
                                <label class="pull-right">Office Address </label>
                            </div>
                            <div class="col-md-7">
                                <textarea class="form-control" name="add_office_address" id="add_office_address" rows="3"></textarea>
                            </div>
                        </div>
                        
                         <div class="form-group row">
                             <div class="col-md-5">
                                <label class="pull-right">Cheque Leaf<span id="add_bank_cheque_error" style="color: red;">*</span></label>
                            </div>
                            <div class="col-md-7">
                                <input type="file" class="form-control" name="add_bank_cheque" id="add_bank_cheque">
                            </div>
                        </div>
                        
                    </div>
                 
                    <div class="col-md-6">
                        <div class="form-group row">
                             <div class="col-md-5">
                                <label class="pull-right">Bank Name <span id="add_bank_name_error" style="color: red;">*</span></label>
                            </div>
                            <div class="col-md-7">
                                <input type="text" class="form-control" name="add_bank_name" id="add_bank_name">
                            </div>
                        </div>
                         <div class="form-group row">
                             <div class="col-md-5">
                                <label class="pull-right">Bank Branch <span id="add_bank_branch_error" style="color: red;">*</span></label>
                            </div>
                            <div class="col-md-7">
                                <input type="text" class="form-control" name="add_bank_branch" id="add_bank_branch">
                            </div>
                        </div>
                        
                         <div class="form-group row">
                             <div class="col-md-5">
                                <label class="pull-right">Upload Pan Card<span id="add_bank_cheque_error" style="color: red;">*</span></label>
                            </div>
                            <div class="col-md-7">
                                <input type="file" class="form-control" name="upload_pan_card" id="upload_pan_card">
                            </div>
                        </div>
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
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true" style="color:white;">×</span></button>
                <h4 class="modal-title text-center">Add POS</h4>
            </div>
            
            <div class="modal-body row">
                
                
                 <div class="col-md-6">
                     
                     
                     <div class="form-group row">
                            <div class="col-md-5">
                                <label class="pull-right">Pos / Sub Pos <span style="color: red;">*</span> </label>
                            </div>
                            <div class="col-md-7">
                                <select class="form-control" name="edit_pos_or_sub_pos" id="edit_pos_or_sub_pos">
                                     <option value="Pos">Pos</option>
                                     <option value="sub_pos">Sub Pos</option>
                              </select>
                          </div>
                        </div>
                        
                        <div class="form-group row hidden" id="edit_pos_div">
                            <div class="col-md-5">
                                <label class="pull-right">Select Main Pos <span style="color: red;">*</span></label>
                            </div>
                            <div class="col-md-7">
                                <select class="form-control select2" name="edit_pos_code" id="edit_pos_code">
                                    <option value="">--Select--</option>
                                  <?php foreach($pos as $da) { ?>
	                                  <option value="<?php echo $da->id ?>"><?php echo $da->name." (".$da->agent_pos_code.")" ?></option>
	                              <?php } ?>
                              </select>
                          </div>
                        </div>
                        
                        
                          <div class="form-group row">
                           <div class="col-md-5">
                                <label class="pull-right">Region <span id="add_reigion_error" style="color: red;">*</span></label>
                            </div>
                            <div class="col-md-7">
                                <select class='form-control select2' name="edit_region" id="edit_region" style="width:100%">
                                    <option value=''>--Select--</option>
                                    <?php foreach($regions as $da){ ?>
                                         <option value="<?php echo $da->id ?>"><?php echo $da->reigion ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                  
                       
                      
                       <div class="form-group row">
                           <div class="col-md-5">
                                <label class="pull-right">Email id <span id="edit_email_error" style="color: red;">*</span></label>
                            </div>
                            <div class="col-md-7">
                                <input type="text" class="form-control" name="edit_email" id="edit_email">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-5">
                                <label class="pull-right">Mobile number <span id="edit_reigion_error" style="color: red;">*</span></label>
                            </div>
                            <div class="col-md-7">
                                <input type="text" class="form-control" name="edit_mobile" id="edit_mobile">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-5">
                                <label class="pull-right">Aadhar Card no<span id="edit_card_no_error" style="color: red;">*</span></label>
                            </div>
                            <div class="col-md-7">
                                <input type="number" class="form-control" name="edit_aadhar_card_no" id="edit_aadhar_card_no">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-5">
                                <label class="pull-right">Address <span id="edit_reigion_error" style="color: red;">*</span></label>
                            </div>
                            <div class="col-md-7">
                                <textarea class="form-control" name="edit_address" id="edit_address" rows="3"></textarea>
                            </div>
                        </div>
                        
                         <div class="form-group row">
                             <div class="col-md-5">
                                <label class="pull-right">Bank A/C No <span id="edit_bank_ac_no_error" style="color: red;">*</span></label>
                            </div>
                            <div class="col-md-7">
                                <input type="text" class="form-control" name="edit_bank_ac_no" id="edit_bank_ac_no">
                            </div>
                        </div>
                         <div class="form-group row">
                             <div class="col-md-5">
                                <label class="pull-right">IFSC Code<span id="edit_bank_ifsc_error" style="color: red;">*</span></label>
                            </div>
                            <div class="col-md-7">
                                <input type="text" class="form-control" name="edit_bank_ifsc" id="edit_bank_ifsc">
                            </div>
                        </div>
                        <div class="form-group row">
                             <div class="col-md-5">
                                <label class="pull-right">Pan card no <span style="color: red;">*</span> </label>
                            </div>
                            <div class="col-md-7">
                                <input type="text" class="form-control" name="edit_pan_no" id="edit_pan_no">
                            </div>
                        </div>
                        
                         <div class="form-group row">
                             <div class="col-md-5">
                                <label class="pull-right">Commission Category<span  style="color: red;">*</span></label>
                            </div>
                            <div class="col-md-7">
                                <select class="form-control" name="edit_c_category" id="edit_c_category">
                                    <option value="">--Select--</option>
                                    <option value="A">A Category</option>
                                    <option value="B">B Category</option>
                                    <option value="C">C Category</option>
                                    <option value="D">D Category</option>
                                </select>
                            </div>
                        </div>
                        
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <div class="col-md-5">
                                <label class="pull-right">Pos Name <span id="edit_reigion_error" style="color: red;">*</span></label>
                            </div>
                            <div class="col-md-7">
                                <input type="text" class="form-control" name="edit_username" id="edit_username">
                            </div>
                        </div>
                        
                        
                         <div class="form-group row">
                            
                            <div class="col-md-5">
                                <label class="pull-right">User <span id="edit_reigion_error" style="color: red;">*</span></label>
                          </div>
                          <div class="col-md-7">
                              <select class="form-control" name="edit_user" id="edit_user">
                                  <option value="all">All Users</option>
                                  <?php foreach($users as $da){ ?>
                                     <option value="<?php echo $da->id ?>"><?php echo $da->username."  - ". $da->email_id.""?></option>
                                  <?php } ?>
                              </select>
                          </div>
                        </div>
                        
                         <div class="form-group row">
                           <div class="col-md-5">
                                <label class="pull-right">Area Incharge <span id="add_reigion_error" style="color: red;">*</span></label>
                            </div>
                            <div class="col-md-7">
                                <select class='form-control select2' name="edit_ai" id="edit_ai" style="width:100%">
                                    <option value=''>--Select--</option>
                                </select>
                            </div>
                        </div>
                        
                         <div class="form-group row">
                             <div class="col-md-5">
                                <label class="pull-right">Password <span id="edit_reigion_error" style="color: red;">*</span></label>
                            </div>
                            <div class="col-md-7">
                                <input type="text" class="form-control" name="edit_password" id="edit_password">
                            </div>
                        </div>
                        <div class="form-group row">
                             <div class="col-md-5">
                                <label class="pull-right">Date of Birth <span id="edit_dob_error" style="color: red;">*</span></label>
                            </div>
                            <div class="col-md-7">
                                <input type="date" class="form-control" name="edit_dob" id="edit_dob">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-5">
                                <label class="pull-right">Upload Aadhar card<span id="edit_aadhar_card_error" style="color: red;"></span></label>
                            </div>
                            <div class="col-md-7">
                                <input type="file" class="form-control" id="edit_aadhar_card">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-5">
                                <label class="pull-right">Office Address </label>
                            </div>
                            <div class="col-md-7">
                                <textarea class="form-control" name="edit_office_address" id="edit_office_address" rows="3"></textarea>
                            </div>
                        </div>
                        
                         <div class="form-group row">
                             <div class="col-md-5">
                                <label class="pull-right">Cheque Leaf<span id="edit_bank_cheque_error" style="color: red;"></span></label>
                            </div>
                            <div class="col-md-7">
                                <input type="file" class="form-control" name="edit_bank_cheque" id="edit_bank_cheque">
                            </div>
                        </div>
                        
                    </div>
                    <!--<center><h4 style="color:green;">Bank Details</h4></center>-->
                   
                    <div class="col-md-6">
                        <div class="form-group row">
                             <div class="col-md-5">
                                <label class="pull-right">Bank Name <span id="edit_bank_name_error" style="color: red;">*</span></label>
                            </div>
                            <div class="col-md-7">
                                <input type="text" class="form-control" name="edit_bank_name" id="edit_bank_name">
                            </div>
                        </div>
                         <div class="form-group row">
                             <div class="col-md-5">
                                <label class="pull-right">Bank Branch <span id="edit_bank_branch_error" style="color: red;">*</span></label>
                            </div>
                            <div class="col-md-7">
                                <input type="text" class="form-control" name="edit_bank_branch" id="edit_bank_branch">
                            </div>
                        </div>
                        
                         <div class="form-group row">
                             <div class="col-md-5">
                                <label class="pull-right">Upload Pan Card<span id="edit_bank_cheque_error" style="color: red;"></span></label>
                            </div>
                            <div class="col-md-7">
                                <input type="file" class="form-control" name="upload_pan_card" id="edit_upload_pan_card">
                            </div>
                            
                            <input type="hidden" id="edit_id">
                        </div>
                        
                    </div>
            </div>
            
            <div id="current_docs">
            </div>
            
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-sm btn-primary" id="edit_btn">Submit</button>
            </div>
        </div>
    </div>
  </div>
  
  
  
  <script>
     
     $(document).ready(function(){
         fetch_pos("0","");
         $('.select2').select2();
         check_permission();
         
         $("#add_btn").click(function(){
          var add_pos_or_sub_pos = $("#add_pos_or_sub_pos").val();
          var add_pos_code = $("#add_pos_code").val();
          var user_id = $("#add_user").val();
          var region = $("#add_region").val();
          var ai = $("#add_ai").val();
          var username = $("#add_username").val();
          var password = $("#add_password").val();
          var email = $("#add_email").val();
          var mobile = $("#add_mobile").val();   
          var address = $("#add_address").val();
          var aadhar_card_no = $("#add_aadhar_card_no").val();
          var dob = $("#add_dob").val();
          var aadhar_card = $("#add_aadhar_card").val();
          var office_address = $("#add_office_address").val();
          var bank_ac_no = $("#add_bank_ac_no").val();
          var bank_ifsc = $("#add_bank_ifsc").val();
          var pan_no = $("#add_pan_no").val();
          var bank_name = $("#add_bank_name").val();
          var bank_branch = $("#add_bank_branch").val();
          var bank_cheque = $("#add_bank_cheque").val();
          var upload_pan_card = $("#upload_pan_card").val();
          
          var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
          
          var c_category = $("#c_category").val();

          var check = 0;
          
          if(add_pos_or_sub_pos == "")
          {
              snackbar_show("Pos / sub_pos");
              check = 1;  
          }
          else if(add_pos_or_sub_pos == "sub_pos" && add_pos_code == "")
          {
                  snackbar_show("Select Main Pos");
                  check = 1;  
          }
          else if(user_id == "")
          {
            snackbar_show("Select User");
            check = 1;  
          }
          else if(region == "")
          {
            snackbar_show("Select Region");
            check = 1;  
          }
          else if(username == "")
          {
              snackbar_show("Enter Pos Name");
              check = 1; 
          }
          else if(email == "")
          {
              snackbar_show("Enter Email");
              check = 1; 
          }
          else if(email != "" && !regex.test(email))
          {
             $("#email_err").html("* Email Is Not Valid");
            snackbar_show("Enter a Valid Email Id");
          }
          
          else if(ai == "")
          {
              snackbar_show("Select Area Incharge");
              check = 1; 
          }
          
          else if(password == "")
          {
              snackbar_show("Enter Password");
              check = 1; 
          }
          else if(mobile == "")
          {
              snackbar_show("Enter mobile");
              check = 1; 
          }
          else if(mobile != "" && mobile.length != "10")
          {
               snackbar_show("Enter a valid Mobile Number");
               //$("#mobile_err").html("* Enter a valid Mobile Number");
          }
          else if(dob == "")
          {
              snackbar_show("select Date of Birth");
              check = 1; 
          }
          else if(aadhar_card_no == "")
          {
              snackbar_show("Enter Aadhar card number");
              check = 1; 
          }
          else if(aadhar_card_no != "" && aadhar_card_no.length != "12")
          {
              snackbar_show("Enter a valid Adhar Number");
             //$("#adhar_err").html("* Enter a valid Adhar Number");
          }
          else if(aadhar_card == "")
          {
              snackbar_show("Upload Aadhar card");
              check = 1; 
          }
          else if(address == "")
          {
              snackbar_show("Enter Address");
              check = 1; 
          }
        
          else if(bank_ac_no == "")
          {
              snackbar_show("Enter Bank Account Number");
              check = 1; 
          }
          else if(bank_name == "")
          {
              snackbar_show("Enter Bank Name");
              check = 1; 
          }
          else if(bank_ifsc == "")
          {
              snackbar_show("Enter Bank IFSC Code");
              check = 1; 
          }
          else if(bank_branch == "")
          {
              snackbar_show("Enter Bank Branch");
              check = 1; 
          }
          else if(pan_no === "")
          {
              snackbar_show("Enter Pan Card No");
              check = 1; 
          }
          else if(upload_pan_card === "")
          {
              snackbar_show("Upload Pan Card");
              check = 1; 
          }
          else if(bank_cheque == "")
          {
              snackbar_show("Upload Cheque Leaf");
              check = 1; 
          }
          else if(c_category == "")
          {
              snackbar_show("Select Commission Category");
              check = 1; 
          }
          else if(check != 1)
          {

            var adhar_card = $("#add_aadhar_card").prop('files')[0];
            var bank_cheque = $("#add_bank_cheque").prop('files')[0];
            var pan_card = $("#upload_pan_card").prop('files')[0]; 
             
            var formdata = new FormData();
            formdata.append('adhar_card',adhar_card);
            formdata.append('bank_cheque',bank_cheque);
            formdata.append('pan_card',pan_card);
            
            formdata.append('add_pos_or_sub_pos',add_pos_or_sub_pos);
            formdata.append('add_pos_code',add_pos_code);
            formdata.append('user_id',user_id);
            formdata.append('region',region);
            formdata.append('ai',ai);
            formdata.append('username',username);
            formdata.append('password',password);
            formdata.append('email',email);
            formdata.append('mobile',mobile);
            formdata.append('address',address);
            formdata.append('aadhar_card_no',aadhar_card_no);
            formdata.append('dob',dob);
            formdata.append('office_address',office_address);
            formdata.append('bank_ac_no',bank_ac_no);
            formdata.append('bank_ifsc',bank_ifsc);
            formdata.append('pan_no',pan_no);
            formdata.append('bank_name',bank_name);
            formdata.append('bank_branch',bank_branch);
            
            formdata.append('c_category',c_category);
            

            $.ajax({
             url : "add_pos",
             method : "POST",
            data:formdata,
            processData:false,  
            contentType:false,
            cache:false,
            dataType:'text',
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
                Swal.fire({
                      position: 'top-end',
                      icon: 'success',
                      title: 'Pos Has been Added Successfully',
                      showConfirmButton: false,
                      timer: 1500
                    })
                    
                    if(add_pos_or_sub_pos == "Pos")
                    {
                        fetch_pos("0","");
                        $("#main_pos_li").addClass("active");
                        $("#sub_pos_li").removeClass("active");
                        
                    }
                    else
                    {
                        fetch_pos("1","all");
                         $("#main_pos_li").removeClass("active");
                        $("#sub_pos_li").addClass("active");
                    }
                    
                    $("#add_btn").attr("disabled",false);   
                    $("#add_model").modal("toggle");
                    $("#add_user").val("");
                    $("#add_username").val("");
                    $("#add_password").val("");
                    $("#add_email").val("");
                    $("#add_mobile").val("");   
                    $("#add_address").val("");
                    $("#add_aadhar_card_no").val("");
                    $("#add_dob").val("");
                    $("#add_aadhar_card").val("");
                    $("#add_office_address").val("");
                    $("#add_bank_ac_no").val("");
                    $("#add_bank_ifsc").val("");
                    $("#add_pan_no").val("");
                    $("#add_bank_name").val("");
                    $("#add_bank_branch").val("");
                    $("#add_bank_cheque").val("");
                    $("#upload_pan_card").val("");
                    
                    $("#c_category").val("");
                    
                     $("#add_region").val("");
                     $("#add_region").trigger("change");
                     $("#add_ai").val("");
                     $("#add_ai").trigger("change");
                    
                    $(".form-control").val("");
                    $("#add_email_error").html("");
                    
                    
                 }
                
             }
         }); 
      }
      });
      
         $("#edit_btn").click(function(){
          
          var edit_pos_or_sub_pos = $("#edit_pos_or_sub_pos").val();
          var edit_pos_code = $("#edit_pos_code").val();   
          var user_id = $("#edit_user").val();
          var username = $("#edit_username").val();
          var password = $("#edit_password").val();
          var email = $("#edit_email").val();
          var mobile = $("#edit_mobile").val();   
          var address = $("#edit_address").val();
          var aadhar_card_no = $("#edit_aadhar_card_no").val();
          var dob = $("#edit_dob").val();
          var aadhar_card = $("#edit_aadhar_card").val();
          var office_address = $("#edit_office_address").val();
          var bank_ac_no = $("#edit_bank_ac_no").val();
          var bank_ifsc = $("#edit_bank_ifsc").val();
          var pan_no = $("#edit_pan_no").val();
          var bank_name = $("#edit_bank_name").val();
          var bank_branch = $("#edit_bank_branch").val();
          var bank_cheque = $("#edit_bank_cheque").val();
          var upload_pan_card = $("#edit_upload_pan_card").val();
          var id = $("#edit_id").val();
          
          var region = $("#edit_region").val();
          var ai =    $("#edit_ai").val();
          
          var c_category = $("#edit_c_category").val();
          
          var check = 0;
          
           var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
          
          
          if(edit_pos_or_sub_pos == "sub_pos" && edit_pos_code == "")
          {
              snackbar_show("Select Main Pos");
            check = 1; 
          }
          
          else if(region == "")
          {
            snackbar_show("Select Region");
            check = 1;  
          }
          
          else if(user_id == "")
          {
            snackbar_show("Select User");
            check = 1;  
          }

          else if(username == "")
          {
              snackbar_show("Enter Pos Name");
              check = 1; 
          }
          else if(email == "")
          {
              snackbar_show("Enter Email");
              check = 1; 
          }
          else if(email != ""  && !regex.test(email))
          {
              snackbar_show("Enter Valid Email Id");
          }
          
          else if(ai == "")
          {
            snackbar_show("Select Area Incharge");
            check = 1;  
          }
          else if(password == "")
          {
              snackbar_show("Enter Password");
              check = 1; 
          }
          else if(mobile == "")
          {
              snackbar_show("Enter mobile");
              check = 1; 
          }
          else if(mobile != "" && mobile.length != "10")
          {
              snackbar_show("Enter Valid Mobile Number");
          }
          else if(dob == "")
          {
              snackbar_show("select Date of Birth");
              check = 1; 
          }
          else if(aadhar_card_no == "")
          {
              snackbar_show("Enter Aadhar card number");
              check = 1; 
          }
          else if(aadhar_card_no != "" && aadhar_card_no.length != "12")
          {
              snackbar_show("Enter Valid Adhar Number");
          }
          else if(address == "")
          {
              snackbar_show("Enter Address");
              check = 1; 
          }
          else if(bank_ac_no == "")
          {
              snackbar_show("Enter Bank Account Number");
              check = 1; 
          }
          else if(bank_name == "")
          {
              snackbar_show("Enter Bank Name");
              check = 1; 
          }
          else if(bank_ifsc == "")
          {
              snackbar_show("Enter Bank IFSC Code");
              check = 1; 
          }
          else if(bank_ifsc != "" && bank_ifsc.length != "11")
          {
              snackbar_show("Enter a Valid IFSC Code");
              check = 1; 
          }
          else if(bank_branch == "")
          {
              snackbar_show("Enter Bank Branch");
              check = 1; 
          }
          else if(pan_no === "")
          {
              snackbar_show("Enter Pan Card No");
              check = 1; 
          }
          else if(pan_no != "" && pan_no.length != "10")
          {
              snackbar_show("Enter A Valid Pancard No");
              check = 1; 
          }
          
          else if(c_category == "")
          {
              snackbar_show("Select Commission Category");
              check = 1; 
          }
          
          else if(check != 1)
          {
              
            var adhar_card = $("#edit_aadhar_card").prop('files')[0];
            var bank_cheque = $("#edit_bank_cheque").prop('files')[0];
            var pan_card = $("#edit_upload_pan_card").prop('files')[0]; 
             
            var formdata = new FormData();
            formdata.append('id',id);
            formdata.append('adhar_card',adhar_card);
            formdata.append('bank_cheque',bank_cheque);
            formdata.append('pan_card',pan_card);
            
            
            
            formdata.append('pos_code',edit_pos_code);
            formdata.append('user_id',user_id);
            formdata.append('username',username);
            formdata.append('password',password);
            formdata.append('email',email);
            formdata.append('mobile',mobile);
            formdata.append('address',address);
            formdata.append('aadhar_card_no',aadhar_card_no);
            formdata.append('dob',dob);
            formdata.append('office_address',office_address);
            formdata.append('bank_ac_no',bank_ac_no);
            formdata.append('bank_ifsc',bank_ifsc);
            formdata.append('pan_no',pan_no);
            formdata.append('bank_name',bank_name);
            formdata.append('bank_branch',bank_branch);
            
             formdata.append('region',region);
            formdata.append('ai',ai);
            formdata.append('c_category',c_category);
            
            

            $.ajax({
             url : "edit_pos",
             method : "POST",
            data:formdata,
            processData:false,  
            contentType:false,
            cache:false,
            dataType:'text',
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
                    alert("Updated Successfully");
                    $("#edit_btn").attr("disabled",false);   
                    $("#edit_model").modal("toggle");
                    $("#edit_user").val("");
                    $("#edit_username").val("");
                    $("#edit_password").val("");
                    $("#edit_email").val("");
                    $("#edit_mobile").val("");   
                    $("#edit_address").val("");
                    $("#edit_aadhar_card_no").val("");
                    $("#edit_dob").val("");
                    $("#edit_aadhar_card").val("");
                    $("#edit_office_address").val("");
                    $("#edit_bank_ac_no").val("");
                     $("#edit_bank_ifsc").val("");
                    $("#edit_pan_no").val("");
                    $("#edit_bank_name").val("");
                    $("#edit_bank_branch").val("");
                    $("#edit_bank_cheque").val("");
                     $("#edit_upload_pan_card").val("");
                     $("#edit_region").val("");
                     
                     $("#edit_c_category").val("");
                     $("#edit_region").trigger("change");
                     $("#edit_ai").val("");
                     $("#edit_ai").trigger("change");
                     
                    if(edit_pos_or_sub_pos == "Pos")
                    {
                        fetch_pos("0","");
                        $("#main_pos_li").addClass("active");
                        $("#sub_pos_li").removeClass("active");
                        
                    }
                    else
                    {
                        fetch_pos("1","all");
                         $("#main_pos_li").removeClass("active");
                        $("#sub_pos_li").addClass("active");
                    }
                 }
                
             }
         }); 
      }
      });
      
         $("#export_excel").click(function(){
            var agent_type = "pos";
            $.ajax({
                     url : "fetch_agent_report_excel",
                     method : "POST",
                     data : {agent_type:agent_type},
                     success:function(response)
                     {
                         window.location.href=response;
                     }
            });
      });
      
        $("#add_pos_or_sub_pos").change(function(){
            var add_pos_or_sub_pos = $("#add_pos_or_sub_pos").val();
            if(add_pos_or_sub_pos == "Pos")
            {
                 $("#pos_div").addClass("hidden");
                 $("#add_pos_code").val("");
                 $('#add_pos_code').trigger("");
            }
            else
            {
                $.ajax({
                          url : "fetch_all_pos",
                          method : "POST",
                          success:function(response)
                          {
                             $("#add_pos_code").html("");
                             
                             var obj = jQuery.parseJSON(response);
                             $("#add_pos_code").html("<option value=''>--Select Main Pos--</option>");
                             for(var i= 0; i<=obj.length;i++)
                             {
                                 $("#add_pos_code").append("<option value='"+obj[i].id+"'>"+obj[i].name+"("+obj[i].agent_pos_code+")</option>");
                             }
                          }
               });
                $("#pos_div").removeClass("hidden");
            }
        });
        
        
        $("#edit_pos_or_sub_pos").change(function(){
            var edit_pos_or_sub_pos = $("#edit_pos_or_sub_pos").val();
            if(edit_pos_or_sub_pos == "Pos")
            {
                 $("#edit_pos_div").addClass("hidden");
            }
            else
            {
                $("#edit_pos_div").removeClass("hidden");
            }
        });
        
        
        
        
        $("#add_email").change(function(){
            
           var email = $("#add_email").val();
           var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
              if(!regex.test(email)) 
              {
                $("#email_err").html("* Email Is Not Valid");
                snackbar_show("Enter a Valid Email Id");
              }
              else
              {
                  $("#email_err").html("");
              }
        });
        
        $("#select_pos").change(function(){
           
           var pos = $("#select_pos").val();
           
            fetch_pos("1",pos);
        });

        $("#add_region").change(function(){
         var region = $("#add_region").val();
         $.ajax({
                      url : "fetch_area_incharge",
                      method : "POST",
                      data : {region:region},
                      success:function(response)
                      {
                          $("#add_ai").html(response);
                      }
         });
      });
      
        $("#edit_region").change(function(){
         var region = $("#edit_region").val();
         $.ajax({
                      url : "fetch_area_incharge",
                      method : "POST",
                      data : {region:region},
                      success:function(response)
                      {
                          $("#edit_ai").html(response);
                      }
         });
        });
  });
     
     
      function fetch_pos(pos_status,pos)
      {
          var content = "";
          content += "<div class='table-responsive'>";
          content += "<table id='table_id' class='table table-hover table-bordered'>"; 
          content += "<thead><th>S.No</th><th>Name</th><th>POS Code</th><th>Phone no</th><th>City</th><th>Created Date</th><th>Created User</th><th>Action</th></thead>";
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
                'url':'fetch_pos',
                 'method' : "POST",
                 'data':{pos_status:pos_status,pos:pos},
              }
          });      
      }
      
      function edit_data(id)
      {
          $.ajax({
              url : "fetch_edit_pos_data",
              method : "POST",
              data :{id:id},
              success:function(response)
              {
                var obj = jQuery.parseJSON(response);
                
                edit_area_incharge(obj.region,obj.area_incharge);
                
                if(obj.pos_status == "0")
                {
                    var pos_status = "Pos";
                    $("#edit_pos_or_sub_pos").val(pos_status);
                }
                else
                {
                     var pos_status = "sub_pos";
                     $("#edit_pos_or_sub_pos").val(pos_status);
                     $("#edit_pos_div").removeClass("hidden");
                }
                
                $("#edit_pos_code").val(obj.sub_pos_by);
                
                $("#edit_user").val(obj.user_id);
                $("#edit_username").val(obj.name);
                $("#edit_password").val(obj.password);
                $("#edit_email").val(obj.email_id);
                $("#edit_mobile").val(obj.phoneno);   
                $("#edit_dob").val(obj.dob);
                $("#edit_aadhar_card_no").val(obj.adhar_card_no);
                $("#edit_address").val(obj.address);
                $("#edit_office_address").val(obj.office_address);
                $("#edit_bank_ac_no").val(obj.bank_acc_no);
                $("#edit_bank_name").val(obj.bank_name);
                $("#edit_bank_ifsc").val(obj.ifsc_code);
                $("#edit_bank_branch").val(obj.branch);
                $("#edit_pan_no").val(obj.pan_card_no);
                
                $("#edit_region").val(obj.region);
                $("#edit_region").trigger("change");
                
                $("#edit_c_category").val(obj.commission_category);
                
                var html = "<label>&nbsp;&nbsp;&nbsp;Current Uploaded Documents :</label><div class='row'><div class='col-md-3'></div>";
                
                var adhar_file = obj.adhar_file;
                var adhar_extension = adhar_file.split(".");
                
                if(adhar_extension == "pdf" || adhar_extension == "Pdf" || adhar_extension == "PDF")
                {
                       html +="<div class='col-md-3'><a target='_blank' href='./datas/agent_pos_documents/"+obj.adhar_file+"'><i class='fa fa-file-pdf-o fa-5x'></i></a><label>&nbsp;&nbsp;Adhar Card</label></div>";
                }
                else
                {
                    html +="<div class='col-md-3'><a target='_blank' href='./datas/agent_pos_documents/"+obj.adhar_file+"'><i class='fa fa-picture-o fa-5x'></i></a><label>&nbsp;&nbsp;Adhar Card</label></div>";
                }
                
                
                var pan_card_file = obj.pan_card_file;
                var pan_card_file_extension = pan_card_file.split(".");
                
                if(pan_card_file_extension == "pdf" || pan_card_file_extension == "Pdf" || pan_card_file_extension == "PDF")
                {
                       html +="<div class='col-md-3'><a target='_blank' href='./datas/agent_pos_documents/"+obj.pan_card_file+"'><i class='fa fa-file-pdf-o fa-5x'></i></a><label>&nbsp;&nbsp;Pan Card</label></div>";
                }
                else
                {
                    html +="<div class='col-md-3'><a target='_blank' href='./datas/agent_pos_documents/"+obj.pan_card_file+"'><i class='fa fa-picture-o fa-5x'></i></a><label>&nbsp;&nbsp;Pan Card</label></div>";
                }
                
                var check_leaf = obj.check_leaf;
                var check_leaf_extension = check_leaf.split(".");
                
                if(check_leaf_extension == "pdf" || check_leaf_extension == "Pdf" || check_leaf_extension == "PDF")
                {
                       html +="<div class='col-md-3'><a target='_blank' href='./datas/agent_pos_documents/"+obj.check_leaf+"'><i class='fa fa-file-pdf-o fa-5x'></i></a><label>&nbsp;&nbsp;Check Leaf</label></div>";
                }
                else
                {
                    html +="<div class='col-md-3'><a target='_blank' href='./datas/agent_pos_documents/"+obj.check_leaf+"'><i class='fa fa-picture-o fa-5x'></i></a><label>&nbsp;&nbsp;Check Leaf</label></div>";
                }
                
                
                html + "</div>";
                  $("#current_docs").html(html);
                
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
                  url:"delete_pos",
                  data:{id:id},
                  method:"POST",
                  success:function(response){
                      alert("Deleted successfully")
                      fetch_pos();
                  },
                  error: function(code) {   
                    alert(code.statusText);
                  },
                });
              }
      }
      
      function check_permission()
      {
          $.ajax({
              url : "check_add_permission",
              success:function(response)
              {
                  var obj = jQuery.parseJSON(response);
                  if(obj.pos_add == "1")
                  {
                      $("#add_mod").removeClass("hidden");
                  }
                  else
                  {
                      $("#add_mod").addClass("hidden");
                  }
              }
          });
      }
      
      
      function edit_area_incharge(region,ai)
      {
           $.ajax({
                      url : "edit_area_incharge",
                      method : "POST",
                      data : {region:region},
                      success:function(response)
                      {
                          var obj = jQuery.parseJSON(response);
                          
                          var html = '<option value="">--select--</option>';
                          
                          if(obj.length > 0)
                          {
                              for(var i= 0;i<obj.length;i++)
                              {
                                  if(obj[i].id == ai)
                                  {
                                        html += "<option value="+obj[i].id+" selected>"+obj[i].name+"("+obj[i].phoneno+")</option>";
                                  }
                                  else
                                  {
                                      html += "<option value="+obj[i].id+">"+obj[i].name+"("+obj[i].phoneno+")</option>";
                                  }
                              }
                          }
                          
                          $("#edit_ai").html(html);
                      }
         });
      }
  </script>