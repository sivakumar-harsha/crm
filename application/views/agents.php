<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1 style="font-size: 17px;">
        Agent
        <button data-toggle="modal" data-target="#add_model" class="btn btn-primary btn-sm pull-right hidden" id="add_mod">Add New</button>
        <button style="margin-right:10px;" class="btn btn-success btn-sm pull-right" id="export_excel"><i class="fa fa-file-excel-o" aria-hidden="true"></i>&nbsp; Export Excel</button>
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
  <input type="hidden" id="session_role" value="<?php echo $this->session->userdata("session_role") ?>">
  
  <div class="modal fade in" id="add_model">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true" style="color:white;">×</span></button>
                <h4 class="modal-title text-center">Add Agent</h4>
            </div>
            
            <div class="modal-body row">
                
                 <div class="col-md-6">
                       <div class="form-group row">
                            <div class="col-md-5">
                                <label class="pull-right">Agent Name <span id="add_reigion_error" style="color: red;">*</span></label>
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
                              <select class="form-control select2" name="add_user" id="add_user" style="width:100%">
                                  <option value="">Select User</option>
                                  <!--<option value="all">All User</option>-->
                                  <?php foreach($users as $da){ ?>
                                     <option value="<?php echo $da->id ?>"><?php echo $da->username."  - ". $da->email_id.""?></option>
                                  <?php } ?>
                              </select>
                          </div>
                        </div>
                       
                       <div class="form-group row">
                           <div class="col-md-5">
                                <label class="pull-right">Email id</label>
                            </div>
                            <div class="col-md-7">
                                <input type="text" class="form-control" name="add_email" id="add_email">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-5">
                                <label class="pull-right">Mobile number <span id="add_reigion_error" style="color: red;">*</span></label>
                            </div>
                            <div class="col-md-7">
                                <input type="text" class="form-control" name="add_mobile" id="add_mobile">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-5">
                                <label class="pull-right">Aadhar Card no<span id="add_card_no_error" style="color: red;">*</span></label>
                            </div>
                            <div class="col-md-7">
                                <input type="number" class="form-control" name="add_aadhar_card_no" id="add_aadhar_card_no">
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
                                <label class="pull-right">Cheque Leaf<span id="add_bank_cheque_error" style="color: red;">*</span></label>
                            </div>
                            <div class="col-md-7">
                                <input type="file" class="form-control" name="add_bank_cheque" id="add_bank_cheque">
                            </div>
                        </div>
                        
                          <h4 style="color:green;">Bank Details 1</h4>
                     
                        
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
                    
                        
                          <h4 style="color:green;">Bank Details 2</h4>
                     
                        
                          <div class="form-group row">
                             <div class="col-md-5">
                                <label class="pull-right">Bank Name <span id="add_bank_name_error2" style="color: red;">*</span></label>
                            </div>
                            <div class="col-md-7">
                                <input type="text" class="form-control" name="add_bank_name2" id="add_bank_name2">
                            </div>
                        </div>
                        
                         <div class="form-group row">
                             <div class="col-md-5">
                                <label class="pull-right">Bank Branch <span id="add_bank_branch_error2" style="color: red;">*</span></label>
                            </div>
                            <div class="col-md-7">
                                <input type="text" class="form-control" name="add_bank_branch2" id="add_bank_branch2">
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
                        
                         <div class="form-group row">
                             <div class="col-md-5">
                                <label class="pull-right">Upload Agent Photo<span id="add_bank_cheque_error" style="color: red;">*</span></label>
                            </div>
                            <div class="col-md-7">
                                <input type="file" class="form-control" name="upload_agent_photo" id="upload_agent_photo">
                            </div>
                        </div>
                        
                        
                        
                    <div class= "hidden" id="special_category">
                        
                    <div class="row">   
                     <div class="col-md-6">
                       <div class="form-group">
                                <label class="pull-left">from<span id="add_dob_error" style="color: red;">*</span></label>
                                <input type="date" class="form-control" name="add_from_date" id="add_from_date">
                            </div>
                        </div>  
                        <div class="col-md-6">
                        <div class="form-group">
                                <label class="pull-left">To<span id="add_dob_error" style="color: red;">*</span></label>
                                <input type="date" class="form-control" name="add_to_date" id="add_to_date">
                            </div>
                        </div>  
                        </div>
                      </div> 
                        
                        
                        
                    </div>
                    <div class="col-md-6">
                        
                         <div class="form-group row">
                           <div class="col-md-5">
                                <label class="pull-right">Region <span id="add_reigion_error" style="color: red;">*</span></label>
                            </div>
                            <div class="col-md-7">
                                
                                <select class='form-control select2' name="add_region" id="add_region" style="width:100%">
                                 <option value=''>--Select--</option>
                                 <?php if($this->session->userdata("session_role") == "admin"){
                                    
                                    foreach($regions as $da){ ?>
                                         <option value="<?php echo $da->id ?>"><?php echo $da->reigion ?></option>
                                    <?php } 
                                 }
                                 else if($this->session->userdata("session_role") == "user")
                                 { 
                                 foreach($regions_user as $da){ ?>
                                         <option value="<?php echo $da->r_id ?>"><?php echo $da->region_name ?></option>
                                    <?php } 
                                 }
                                 else if($this->session->userdata("session_role") == "AI")
                                 {
                                     foreach($regions_ai as $da){ ?>
                                         <option value="<?php echo $da->id ?>"><?php echo $da->reigion ?></option>
                                    <?php } 
                                 }
                                ?>
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
                                    <?php if($this->session->userdata("session_role") == "AI"){?>
                                    <option value='<?php echo $this->session->userdata("session_id") ?>' selected><?php echo $this->session->userdata("session_name") ?></option>
                                   <?php }
                                 
                                   ?>
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
                                <label class="pull-right">Upload Aadhar card 1<span id="add_aadhar_card_error" style="color: red;">*</span></label>
                            </div>
                            <div class="col-md-7">
                                <input type="file" class="form-control" id="add_aadhar_card">
                            </div>
                        </div>
                        
                        <!--upload Adhar card back start-->
                        <div class="form-group row">
                            <div class="col-md-5">
                                <label class="pull-right">Upload Aadhar card 2<span id="add_aadhar_card_back_error" style="color: red;">*</span></label>
                            </div>
                            <div class="col-md-7">
                                <input type="file" class="form-control" id="add_aadhar_card_back">
                            </div>
                        </div>
                        
                        <!--upload Adhar card back start-->
                        
                        <div class="form-group row">
                            <div class="col-md-5">
                                <label class="pull-right">Office Address </label>
                            </div>
                            <div class="col-md-7">
                                <textarea class="form-control" name="add_office_address" id="add_office_address" rows="3"></textarea>
                            </div>
                        </div>
                  
                    </div>
                    
             
                    
                    <div class="col-md-6">
                        
                        <br>
                        
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
                        <br><br>
                        <div class="form-group row">
                             <div class="col-md-5">
                                <label class="pull-right">Bank A/C No 2<span id="add_bank_ac_no_error2" style="color: red;">*</span></label>
                            </div>
                            <div class="col-md-7">
                                <input type="text" class="form-control" name="add_bank_ac_no2" id="add_bank_ac_no2">
                            </div>
                        </div>
                        
                        <div class="form-group row">
                             <div class="col-md-5">
                                <label class="pull-right">IFSC Code<span id="add_bank_ifsc_error2" style="color: red;">*</span></label>
                            </div>
                            <div class="col-md-7">
                                <input type="text" class="form-control" name="add_bank_ifsc2" id="add_bank_ifsc2">
                            </div>
                        </div>
                      
                        <div class="form-group row">
                             <div class="col-md-5">
                                <label class="pull-right">Pan card no<span  style="color: red;">*</span></label>
                            </div>
                            <div class="col-md-7">
                                <input type="text" class="form-control" name="add_pan_no" id="add_pan_no">
                            </div>
                        </div>
                        
                        <div class="form-group row">
                             <div class="col-md-5">
                                <label class="pull-right">Upload Office Photo<span id="add_bank_cheque_error" style="color: red;">*</span></label>
                            </div>
                            <div class="col-md-7">
                                <input type="file" class="form-control" name="upload_office_photo" id="upload_office_photo">
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
                                    <option value="Special category">Special Category</option>
                                </select>
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
                <h4 class="modal-title text-center">Add Agent</h4>
            </div>
            
            <div class="modal-body row">
                
                 <div class="col-md-6">
                     
                       <div class="form-group row">
                            <div class="col-md-5">
                                <label class="pull-right">Agent Name <span id="edit_reigion_error" style="color: red;">*</span></label>
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
                                  <option value="">Select User</option>
                                  <!--<option value="all">All User</option>-->
                                  <?php foreach($users as $da){ ?>
                                     <option value="<?php echo $da->id ?>"><?php echo $da->username."  - ". $da->email_id.""?></option>
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
                        
                        <h4 style='color:green'>Bank Details 1</h4>
                        
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
                        
                        <h4 style='color:green'>Bank Details 2</h4>
                        
                         <div class="form-group row">
                             <div class="col-md-5">
                                <label class="pull-right">Bank A/C No <span id="edit_bank_ac_no_error" style="color: red;">*</span></label>
                            </div>
                            <div class="col-md-7">
                                <input type="text" class="form-control" name="edit_bank_ac_no2" id="edit_bank_ac_no2">
                            </div>
                        </div>
                        
                         <div class="form-group row">
                             <div class="col-md-5">
                                <label class="pull-right">IFSC Code<span id="edit_bank_ifsc_error" style="color: red;">*</span></label>
                            </div>
                            <div class="col-md-7">
                                <input type="text" class="form-control" name="edit_bank_ifs2c" id="edit_bank_ifsc2">
                            </div>
                        </div>
                        
                        
                         <div class="form-group row">
                             <div class="col-md-5">
                                <label class="pull-right">Upload Agent Photo<span id="add_bank_cheque_error" style="color: red;">*</span></label>
                            </div>
                            <div class="col-md-7">
                                <input type="file" class="form-control" name="edit_upload_agent_photo" id="edit_upload_agent_photo">
                            </div>
                        </div>
                        
                        
                        <div class="form-group row">
                             <div class="col-md-5">
                                <label class="pull-right">Pan card no<span  style="color: red;">*</span></label>
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
                                    <option value="Special category">Special Category</option>
                                
                                </select>
                            </div>
                        </div>
                        
                        
                        
            <div class= "hidden" id="special_category_from">
                
                        <div class="form-group row">
                             <div class="col-md-5">
                                <label class="pull-right">from<span  style="color: red;">*</span></label>
                            </div>
                            <div class="col-md-7">
                                <input type="date" class="form-control" name="edit_from_date" id="edit_from_date">
                            </div>
                        </div>
                 
                </div> 
                
                        
                    </div>
                    <div class="col-md-6">
                        
                        <div class="form-group row">
                           <div class="col-md-5">
                                <label class="pull-right">Region <span id="add_reigion_error" style="color: red;">*</span></label>
                            </div>
                            <div class="col-md-7">
                                <select class='form-control select2' name="edit_region" id="edit_region" style="width:100%">
                                    <option value=''>--Select--</option>
                                    <?php if($this->session->userdata("session_role") == "admin"){
                                    
                                    foreach($regions as $da){ ?>
                                         <option value="<?php echo $da->id ?>"><?php echo $da->reigion ?></option>
                                    <?php } 
                                 }
                                 else if($this->session->userdata("session_role") == "user")
                                 { 
                                 foreach($regions_user as $da){ ?>
                                         <option value="<?php echo $da->r_id ?>"><?php echo $da->region_name ?></option>
                                    <?php } 
                                 }
                                 else if($this->session->userdata("session_role") == "AI")
                                 {
                                     foreach($regions_ai as $da){ ?>
                                         <option value="<?php echo $da->id ?>"><?php echo $da->reigion ?></option>
                                    <?php } 
                                 }
                                ?>
                                </select>
                            </div>
                        </div>
                        
                         <div class="form-group row">
                           <div class="col-md-5">
                                <label class="pull-right">Area Incharge <span id="add_reigion_error" style="color: red;">*</span></label>
                            </div>
                            <div class="col-md-7">
                                <select class='form-control select2' name="edit_ai_1" id="edit_ai_1" style="width:100%">
                                    <option value=''>--Select--</option>
                                     <?php if($this->session->userdata("session_role") == "AI"){?>
                                         <option value='<?php echo $this->session->userdata("session_id") ?>' selected><?php echo $this->session->userdata("session_name") ?></option>
                                   <?php }
                                   ?>
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
                        
                        <!-- edit upload Aathar card back-->
                        <div class="form-group row">
                            <div class="col-md-5">
                                <label class="pull-right">Upload Aadhar card Back<span id="edit_aadhar_card_back_error" style="color: red;"></span></label>
                            </div>
                            <div class="col-md-7">
                                <input type="file" class="form-control" id="edit_aadhar_card_back">
                            </div>
                        </div>
                        
                        <!-- edit upload Aathar card back-->
                        
                        
                        
                        <div class="form-group row">
                            <div class="col-md-5">
                                <label class="pull-right">Office Address </label>
                            </div>
                            <div class="col-md-7">
                                <textarea class="form-control" name="edit_office_address" id="edit_office_address" rows="3"></textarea>
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
                    </div>
                    
                    
                    <div class="col-md-6">
                        <div class="form-group row">
                            <br>
                             <div class="col-md-5">
                                <label class="pull-right">Bank Name 2<span id="edit_bank_name_error" style="color: red;">*</span></label>
                            </div>
                            <div class="col-md-7">
                                <input type="text" class="form-control" name="edit_bank_name2" id="edit_bank_name2">
                            </div>
                        </div>
                         <div class="form-group row">
                             <div class="col-md-5">
                                <label class="pull-right">Bank Branch 2<span id="edit_bank_branch_error" style="color: red;">*</span></label>
                            </div>
                            <div class="col-md-7">
                                <input type="text" class="form-control" name="edit_bank_branch2" id="edit_bank_branch2">
                            </div>
                        </div>
                        
                    
                        
                        
                         <div class="form-group row">
                             <div class="col-md-5">
                                <label class="pull-right">Upload Office Photo<span id="add_bank_cheque_error" style="color: red;">*</span></label>
                            </div>
                            <div class="col-md-7">
                                <input type="file" class="form-control" name="edit_upload_office_photo" id="edit_upload_office_photo">
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
                        
                        
                         <div class="form-group row">
                             <div class="col-md-5">
                                <label class="pull-right">Cheque Leaf<span id="edit_bank_cheque_error" style="color: red;"></span></label>
                            </div>
                            <div class="col-md-7">
                                <input type="file" class="form-control" name="edit_bank_cheque" id="edit_bank_cheque">
                            </div>
                        </div>
                        
                        
                    <div class= "hidden" id="special_category_to">
                
                        <div class="form-group row">
                             <div class="col-md-5">
                                <label class="pull-right">To<span  style="color: red;">*</span></label>
                            </div>
                            <div class="col-md-7">
                                <input type="date" class="form-control" name="edit_to_date" id="edit_to_date">
                            </div>
                        </div>
                 
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
     var change_status = false;
     
     $(document).ready(function(){
         
         
         change_status = false;
         
          $('.select2').select2();
          
          $("#c_category").change(function(){
		    
         var c_category = $("#c_category").val();
        
         if(c_category ==  'A')
         {
              $("#special_category").addClass("hidden");
         }
        else if(c_category == 'B')
         {
            $("#special_category").addClass("hidden");
         }
         else if(c_category == 'C')
         {
            $("#special_category").addClass("hidden");
         }
         else if(c_category == 'D')
         {
            $("#special_category").addClass("hidden");
         }
         else if(c_category == 'Special category')
         {
            $("#special_category").removeClass("hidden");
            $("#add_from_date").val('');
            $("#add_to_date").val('');
         }
          
        });
        
        
         $("#edit_c_category").change(function(){
		    
         var c_category = $("#edit_c_category").val();
        
         if(c_category ==  'A')
         {
              $("#special_category_from").addClass("hidden");
              $("#special_category_to").addClass("hidden");
         }
        else if(c_category == 'B')
         {
            $("#special_category_from").addClass("hidden");
            $("#special_category_to").addClass("hidden");
         }
         else if(c_category == 'C')
         {
            $("#special_category_from").addClass("hidden");
            $("#special_category_to").addClass("hidden");
         }
         else if(c_category == 'D')
         {
            $("#special_category_from").addClass("hidden");
            $("#special_category_to").addClass("hidden");
         }
         else if(c_category == 'Special category')
         {
            $("#special_category_from").removeClass("hidden");
            $("#special_category_to").removeClass("hidden");
            $("#edit_from_date").val('');
            $("#edit_to_date").val('');
         }
          
        });
          
         
         fetch_agent();
         check_permission();
         $("#add_btn").click(function(){
          
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
         //   aadhar card back 
          var aadhar_card_back = $("#add_aadhar_card_back").val();
        //   aadhar card back 
          var office_address = $("#add_office_address").val();
          var bank_ac_no = $("#add_bank_ac_no").val();
          var bank_ifsc = $("#add_bank_ifsc").val();
          var pan_no = $("#add_pan_no").val();
          var bank_name = $("#add_bank_name").val();
          var bank_branch = $("#add_bank_branch").val();
          var bank_cheque = $("#add_bank_cheque").val();
          var upload_pan_card = $("#upload_pan_card").val();
          var c_category = $("#c_category").val();
          
          var bank_name2 = $("#add_bank_name2").val();
          var bank_branch2 = $("#add_bank_branch2").val();
          var bank_ac_no2 = $("#add_bank_ac_no2").val();
          var bank_ifsc2 = $("#add_bank_ifsc2").val();
          var agent_photo = $("#upload_agent_photo").val();
          var office_photo = $("#upload_office_photo").val();
          var add_from_date = $("#add_from_date").val();
          var add_to_date = $("#add_to_date").val();
          
       
          var check = 0;
          
          if(user_id == "")
          {
            snackbar_show("Select User");
            check = 1;  
          }
          else if(c_category == "Special category" && ((add_from_date == "") || (add_to_date == ""))){
                snackbar_show("Select From and To date");
                check = 1; 
          }
          else if(check != 1)
          {
            var adhar_card = $("#add_aadhar_card").prop('files')[0];
            // aadhar card back
            var aadhar_card_back = $("#add_aadhar_card_back").prop('files')[0];
            // aadhar card back
            var bank_cheque = $("#add_bank_cheque").prop('files')[0];
            var pan_card = $("#upload_pan_card").prop('files')[0]; 
             
            var formdata = new FormData();
            formdata.append('adhar_card',adhar_card);
            // aadhar card back
            formdata.append('aadhar_card_back',aadhar_card_back);
            // aadhar card back
            formdata.append('bank_cheque',bank_cheque);
            formdata.append('pan_card',pan_card);
            
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
            formdata.append('bank_name',bank_name);
            formdata.append('bank_branch',bank_branch);
            
            formdata.append('bank_ac_no2',bank_ac_no2);
            formdata.append('bank_ifsc2',bank_ifsc2);
            formdata.append('bank_name2',bank_name2);
            formdata.append('bank_branch2',bank_branch2);
           
            var upload_agent_photo = $("#upload_agent_photo").prop('files')[0];
            var upload_office_photo = $("#upload_office_photo").prop('files')[0]; 
            formdata.append('upload_agent_photo',upload_agent_photo);
            formdata.append('upload_office_photo',upload_office_photo);
            formdata.append('pan_no',pan_no);
            formdata.append('c_category',c_category);
            formdata.append('add_from_date',add_from_date);
            formdata.append('add_to_date',add_to_date);
            


            $.ajax({
             url : "add_agent",
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
                     alert("This email already exits");
                     $("#add_email_error").html("* This email already exits.");
                 }
                 else
                 {
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
                    
                    $("#add_aadhar_card_back").val("");
                    
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
                     //alert("success");
                     //fetch_agent();
                 }
                
             }
         }); 
      }
      });
      $("#export_excel").click(function(){
            var agent_type = "agent";
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
      
         $("#edit_btn").click(function(){
             
          var user_id = $("#edit_user").val();
          var username = $("#edit_username").val();
          var password = $("#edit_password").val();
          var email = $("#edit_email").val();
          var mobile = $("#edit_mobile").val();   
          var address = $("#edit_address").val();
          var aadhar_card_no = $("#edit_aadhar_card_no").val();
          var dob = $("#edit_dob").val();
          var aadhar_card = $("#edit_aadhar_card").val();
          
         //   aadhar card back 
          var aadhar_card_back = $("#edit_aadhar_card_back").val();
        //   aadhar card back 
          
          var office_address = $("#edit_office_address").val();
          var bank_ac_no = $("#edit_bank_ac_no").val();
          var bank_ifsc = $("#edit_bank_ifsc").val();
          var pan_no = $("#edit_pan_no").val();
          var bank_name = $("#edit_bank_name").val();
          var bank_branch = $("#edit_bank_branch").val();
          var bank_cheque = $("#edit_bank_cheque").val();
          var upload_pan_card = $("#edit_upload_pan_card").val();
          var region = $("#edit_region").val();
          var ai = $("#edit_ai_1").val();
          
          var c_category = $("#edit_c_category").val();
          
          var bank_name2 = $("#edit_bank_name2").val();
          var bank_branch2 = $("#edit_bank_branch2").val();
          var bank_ac_no2 = $("#edit_bank_ac_no2").val();
          var bank_ifsc2 = $("#edit_bank_ifsc2").val();
          var agent_photo = $("#edit_upload_agent_photo").val();
          var office_photo = $("#edit_upload_office_photo").val();
          var edit_from_date = $("#edit_from_date").val();
          var edit_to_date = $("#edit_to_date").val();
          
    
          var id = $("#edit_id").val();
          
          var check = 0;
          
          if(user_id == "")
          {
            snackbar_show("Select User");
            check = 1;  
          }
           if(region == "")
          {
            snackbar_show("Select Region");
            check = 1;  
          }
           if(ai == "")
          {
            snackbar_show("Select Area Incharge");
            check = 1;  
          }
          else if(username == "")
          {
              snackbar_show("Enter Agent Name");
              check = 1; 
          }
          else if(email == "")
          {
              snackbar_show("Enter Email");
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
               snackbar_show("Enter a valid 10 Digit Mobile Number");
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
               snackbar_show("Enter a Valid 12 Digit Aadhar Card Number");
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
               snackbar_show("Enter a Valid 11 Digit IFSC ");
          }
          else if(bank_branch == "")
          {
              snackbar_show("Enter Bank Branch");
              check = 1; 
          }
          
          else if(bank_ac_no2 == "")
          {
              snackbar_show("Enter Bank Account Number2");
              check = 1; 
          }
          else if(bank_name2 == "")
          {
              snackbar_show("Enter Bank Name2");
              check = 1; 
          }
          else if(bank_ifsc2 == "")
          {
              snackbar_show("Enter Bank IFSC Code2");
              check = 1; 
          }
          else if(bank_ifsc2 != "" && bank_ifsc2.length != "11")
          {
               snackbar_show("Enter a Valid 11 Digit IFSC ");
          }
          else if(bank_branch2 == "")
          {
              snackbar_show("Enter Bank Branch2");
              check = 1; 
          }
          else if(pan_no === "")
          {
              snackbar_show("Enter Pan Card No");
              check = 1; 
          }
          
          else if(pan_no != "" && pan_no.length != "10")
          {
               snackbar_show("Enter a valid 10 Digit Pan Number");
          }
          else if(c_category == "")
          {
               snackbar_show("Select Commission Category");
          }
          else if(c_category == "Special category" && ((edit_from_date == "") || (edit_to_date == ""))){
                snackbar_show("Select From and To date");
                check = 1; 
          }
          else if(check != 1)
          {
              
            var adhar_card = $("#edit_aadhar_card").prop('files')[0];
            
            var aadhar_card_back = $("#edit_aadhar_card_back").prop('files')[0];
            
            var bank_cheque = $("#edit_bank_cheque").prop('files')[0];
            var pan_card = $("#edit_upload_pan_card").prop('files')[0]; 
             
            var formdata = new FormData();
            formdata.append('id',id);
            formdata.append('adhar_card',adhar_card);
            formdata.append('aadhar_card_back',aadhar_card_back);
            formdata.append('bank_cheque',bank_cheque);
            formdata.append('pan_card',pan_card);
            
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
            
            formdata.append('bank_ac_no2',bank_ac_no2);
            formdata.append('bank_ifsc2',bank_ifsc2);
            formdata.append('bank_name2',bank_name2);
            formdata.append('bank_branch2',bank_branch2);
           
            var upload_agent_photo = $("#edit_upload_agent_photo").prop('files')[0];
            var upload_office_photo = $("#edit_upload_office_photo").prop('files')[0]; 
            formdata.append('upload_agent_photo',upload_agent_photo);
            formdata.append('upload_office_photo',upload_office_photo);
            
            formdata.append('c_category',c_category);
            formdata.append('edit_from_date',edit_from_date);
            formdata.append('edit_to_date',edit_to_date);
            
           
            
            $.ajax({
             url : "edit_agent",
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
                     alert("* This email already Exits ");
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
                    
                    //edit aadhar card back 
                    $("#edit_aadhar_card_back").val("");
                    //edit aadhar card back
                    
                    $("#edit_office_address").val("");
                    $("#edit_bank_ac_no").val("");
                     $("#edit_bank_ifsc").val("");
                    $("#edit_pan_no").val("");
                    $("#edit_bank_name").val("");
                    $("#edit_bank_branch").val("");
                    $("#edit_bank_cheque").val("");
                     $("#edit_upload_pan_card").val("");
                     $("#edit_c_category").val("");
                     $("#edit_region").val("");
                     $("#edit_region").trigger("change");
                     $("#edit_ai_1").val("");
                    $("#edit_ai_1").trigger("change");
                     
                    fetch_agent();
                 }
                
             }
         }); 
      }
      });
      
      $("#add_region").change(function(){
          
         var region = $("#add_region").val();
         var session_role = $("#session_role").val();
         
        if(session_role == "admin" || session_role == "user")
        {
             $.ajax({
                          url : "fetch_area_incharge",
                          method : "POST",
                          data : {region:region},
                          success:function(response)
                          {
                              $("#add_ai").html(response);
                          }
             });
        }
        if(session_role == "admin")
        {
             $.ajax({
                          url : "fetch_users_by_region",
                          method : "POST",
                          data : {region:region},
                          success:function(response)
                          {
                              $("#add_user").html(response);
                          }
             });
        }
      });
      
      $("#edit_region").change(function(){
         var region = $("#edit_region").val();
         var session_role = $("#session_role").val();
       
            if(session_role == "admin" || session_role == "user")
            {   
                 if(change_status != true)
                 {
                     $.ajax({
                                  url : "fetch_area_incharge",
                                  method : "POST",
                                  data : {region:region},
                                  success:function(response)
                                  {
                                      $("#edit_ai_1").html(response);
                                  }
                     });
                 }
                 else
                 {
                     change_status = false;
                 }
            }
            if(session_role == "admin")
            {
                $.ajax({
                              url : "fetch_users_by_region",
                              method : "POST",
                              data : {region:region},
                              success:function(response)
                              {
                                  $("#edit_user").html(response);
                              }
                 });
            }
        });
        
       
        });
      
      
      function fetch_agent()
      {
          var content = "";
          content += "<div class='table-responsive'>";
          content += "<table id='table_id' class='table table-hover table-bordered'>"; 
          content += "<thead><th>S.No</th><th>Name</th><th>Agent Code</th><th>Phone no</th><th>Region</th><th>AI</th><th>Created Date</th><th>FOE</th><th>Action</th></thead>";
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
                'url':'fetch_agent',
              }
          });      
      }
      
      function edit_data(id)
      {
          $.ajax({
              url : "fetch_edit_agent_data",
              method : "POST",
              data :{id:id},
              success:function(response)
              {
                var obj = jQuery.parseJSON(response);
                
                 change_status = true;
                
                 $("#edit_region").val(obj.region);
                 $("#edit_region").trigger("change");
                
                edit_area_incharge(obj.region,obj.area_incharge);
                
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
                
                 $("#edit_bank_ac_no2").val(obj.bank_ac_no2);
                $("#edit_bank_name2").val(obj.bank_name2);
                $("#edit_bank_ifsc2").val(obj.bank_ifsc2);
                $("#edit_bank_branch2").val(obj.bank_branch2);
                
                $("#edit_pan_no").val(obj.pan_card_no);
               
                
                $("#edit_c_category").val(obj.commission_category);
                
                if(obj.commission_category == "Special category") {
                    $("#special_category_from").removeClass("hidden");
                    $("#special_category_to").removeClass("hidden");
                }
                
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
                
                  html +="<div class='col-md-3'></div>";
                
                   html +="<div class='col-md-3'><a target='_blank' href='./datas/agent_photo/"+obj.agent_photo+"'><i class='fa fa-picture-o fa-5x'></i></a><label>&nbsp;&nbsp;Agent Photo</label></div>";
                   
                    
                   html +="<div class='col-md-3'><a target='_blank' href='./datas/office_photo/"+obj.office_photo+"'><i class='fa fa fa-picture-o fa-5x'></i></a><label>&nbsp;&nbsp;Office Photo</label></div>";
                
                
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
                  url:"delete_agent",
                  data:{id:id},
                  method:"POST",
                  success:function(response){
                      alert("Deleted successfully")
                      fetch_agent();
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
                  
                  if(obj.agent_add == "1")
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
         var session_role = $("#session_role").val();
        if(session_role == "admin" || session_role == "user")
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
                          
                          $("#edit_ai_1").html(html);
                          $("#edit_ai_1").trigger("change");
                      }
         });
        }
      }

    
      
      
      
      
      
  </script>