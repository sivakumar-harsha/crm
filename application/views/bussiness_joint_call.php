<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
<style>
      .form-control {
    display: block;
    width: 100%;
    height: 29px;
    padding: 4px 10px;
    font-size: 14px;
    line-height: 1.42857143;
    color: #555;
    background-color: #fff;
    background-image: none;
    border: 1px solid #ccc;
    border-radius: 4px;
    -webkit-box-shadow: inset 0 1px 1px rgb(0 0 0 / 8%);
    box-shadow: inset 0 1px 1px rgb(0 0 0 / 8%);
    -webkit-transition: border-color ease-in-out .15s,-webkit-box-shadow ease-in-out .15s;
    -o-transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
    transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
}
label {
    display: inline-block;
    max-width: 100%;
    margin-bottom: 5px;
    font-weight: unset;
    font-size: 14px;
}
.btn {
    border-radius: 1px;
    -webkit-box-shadow: none;
    box-shadow: none;
    border: 1px solid transparent;
}
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

.content-header {
    position: relative;
    padding: 15px 15px 19px 15px !important;
}

.content {
    min-height: 250px;
    padding: -1px !important;
    margin-right: auto;
    margin-left: auto;
    padding-left: 15px;
    padding-right: 15px;
}

.content-header {
    position: relative;
   padding: 15px 15px 1px 15px !important;
}
</style>

  <div class="content-wrapper">
      
    <section class="content-header">
        
           <div class = "row">
                    <div class ="col-md-2">
                        <div class="form-group">
                             <select id="select_region" name ="select_region" class="form-control select2" required style="width:100%">
                                 <option value="">--select Region--</option>
                                 <?php foreach($region as $da){?>
                                    <option value="<?php echo $da->reigion ?>"><?php echo $da->reigion ?></option>
                                            <?php } ?>
                             </select>
                         </div>
                    </div> 
                    
                    <div class ="col-md-2">
                    <div class="form-group ">
                            <select class="form-control select2" required  name="select_areaincharge" id="select_areaincharge" style="width:100%">
                                <option value="">-Select Area incharge-</option>
                                 
                                 <?php if($this->session->userdata("session_role") == "AI") { ?>
                                   <option value="<?php echo $this->session->userdata('session_id') ?>"><?php echo $this->session->userdata('session_name') ?></option>
                                 <?php }else{ ?>
                                 
                                    <?php foreach($name as $da){ ?>
                                    <option value="<?php echo $da->id ?>"><?php echo $da->name ?></option>
                                                    <?php } }?>
                              </select>
                    </div> 
                </div>     
                
                    <div class="form-group col-md-2">
                             <input type = "date" class="form-control" name="from_date" id="from_date" placeholder="From date" value="<?php echo date('Y-m-01') ?>">
                      </div>
                      
                    <div class="form-group col-md-2">
                             <input type = "date" class="form-control" name="to_date" id="to_date" placeholder="TO date" value="<?php echo date('Y-m-t') ?>">
                    </div>
                    
                    <div class="form-group col-md-2">
                             <input type = "text" class="form-control" name="s_mobile_no" id="s_mobile_no" placeholder="Mobile No">
                      </div>
                      
                    <div class="form-group col-md-1">
                         <input type ="text" class="form-control" name="s_insurer" id="s_insurer" placeholder="Insurer">
                  </div>
                  
                   <div class="form-group col-md-1">
                      <button class="btn btn-primary btn-sm pull-right" id="search_btn" > <i class="fa fa-search"></i></button>
                   </div>
             </div> 
     
               
                  <button data-toggle="modal" data-target="#add_model" class="btn btn-primary btn-sm">Add New</button>
                  <button data-toggle="modal" data-target="#exiting_model" class="btn btn-danger btn-sm"> <i class="fa fa-male"></i> Exiting</button>
                  
                   <button data-toggle="modal" data-target="#ex_agn_model" class="btn btn-info btn-sm"> <i class="fa fa-male"></i> Exiting Agent</button>
                   
                    <button data-toggle="modal" data-target="#existing_dealers" class="btn btn-info btn-sm"> <i class="fa fa-male"></i> Exiting Dealers</button>
                    
                      <button data-toggle="modal" data-target="#DealerMod" class="btn btn-success btn-sm"> <i class="fa fa-male"></i> Add Dealers</button>
               
    </section>
  
    <section class="content">
      <div class="box">
         <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li class="active" id="businesscall_id"><a href="#tab_1" data-toggle="tab" aria-expanded="true" onclick="fetch_bussinesscall()">Bussiness calls</a></li>
             
                <li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false" onclick="fetch_leavepermission()">leave Status</a></li>
                
                <li class="pull-right">
                   <button data-toggle="modal" data-target="#add_leavemodel" class="btn btn-info btn-sm pull-right">Add Leave</button>
                </li>
                
                <li class="pull-right"> 
                <?php if($this->session->userdata('session_role') != "user" && $this->session->userdata('session_role') != "AI") { ?>
                    <button class = "btn btn-danger btn-sm pull-right" onclick=export_excel()><i class="fa fa-file-excel-o" aria-hidden="true"></i>
                    Export</button>
                     <?php }
                 ?>
                </li> 
              
            </ul>
        </div>
        <div class="box-body">
          <div id="table_view"></div>
        </div>   
      </div>
    </section>
  </div>
  
      <div class="modal fade in" id="add_model">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" style="color:white;">×</span></button>
                    <h4 class="modal-title text-center">New Bussiness call Details</h4>
                </div>
                
           <form action ="add_bussinesscalldetails"  method ="POST" enctype='multipart/form-data'>
    
            <div class="modal-body">
                
            <div class="form-group">
              <label>Date</label> 
                <input type="datetime-local" class ="form-control" name="entry_date" id="entry_date" required>
            </div>
          
          <div class="row">
                <div class="form-group col-md-4">
                     <label>Area Incharge </label>
                        <select class="form-control select2" name="areaincharge" id="area_incharge" style="width:100%" required>
                            <option value="">--Select--</option>
                             <?php if($this->session->userdata("session_role") == "AI") { ?>
                               <option value="<?php echo $this->session->userdata('session_id') ?>"><?php echo $this->session->userdata('session_name') ?></option>
                              <?php }else{ ?>
                                <?php foreach($name as $da){ ?>
                                <option value="<?php echo $da->id ?>"><?php echo $da->name ?></option>
                                                <?php } }?>
                          </select>
                </div>   
        
                <div class="form-group col-md-4">
                  <label>Name of the insurer</label>
                   <input type="text" class="form-control" required  id="add_insurance" name ="insurer">
                </div>
                
          <div class="form-group col-md-4">
                  <label>Region</label>
                      <select id="add_region" name ="region" class="form-control select2" required style="width:100%">
                         <option value="">--select--</option>
                         <?php foreach($region as $da){?>
                            <option value="<?php echo $da->reigion ?>"><?php echo $da->reigion ?></option>
                                    <?php } ?>
                     </select>
                 </div>
           </div>
           
           
            <div class="form-group">
                        <label>User </label>
                        <select class="form-control select2" required  name="add_user" id="add_user" style="width:100%">
                            <option value="">--Select--</option>
                            
                            <?php if($this->session->userdata("session_role") == "user") { ?>
                            <option value="<?php echo $this->session->userdata('session_id') ?>"><?php echo $this->session->userdata('session_name') ?></option>
                            <?php }else{ ?>
                            
                            <?php foreach($users as $da){ ?>
                            <option value="<?php echo $da->id ?>"><?php echo $da->name ?></option>
                                        <?php } }?>
                            </select>
                    </div> 
    
            <div class="row">

               <!--<div class="form-group col-md-4">
                    <label>Business Location</label>
                    <input type="text" class="form-control" required name= "businesslocation"  id="add_business_location">
                </div>-->
                
               <!--<div class="form-group col-md-4">
                  <label>location</label> 
                 <input type="text" class="form-control" required  id="add_location" name= "location">
                </div>-->
            </div>
            
            <div class="row">
                <!--<div class="form-group col-md-6">-->
                <!--    <label>Business Activity</label> -->
                <!--    <input type="text" class="form-control" id="add_activice" name="activice" > -->
                <!--</div>-->
            
            <div class="form-group col-md-12">
              <label>Address</label> 
             <textarea type="text" class="form-control" id="add_address" name="address" rows="3" required></textarea>
            </div>
            </div>
            
           <!-- <div class="row">-->
            <!--    <div class="form-group col-md-6">-->
            <!--     <label>Pin code</label> -->
            <!--     <input type="text" class="form-control" id="add_pin" name="pin" required>-->
            <!--</div>-->
            
            <!-- <div class="form-group col-md-6">-->
            <!--  <label>followup date</label> -->
            <!--  <input type="datetime-local" class="form-control" id="followup_date" name="date" required>-->
            <!--</div>-->
           <!--</div>-->
            
            <div class = "row">
                 <div class = "col-md-6">
                     <div class = "form-group">
                         <label>Upload Flie</label> 
                           <button type="button" id="remove_upload_btn" class= "btn btn-danger btn-xs pull-right"><i class="fa fa-minus fa-1x"></i></button>&nbsp;
                           <button type="button" id="add_upload_btn" class= "btn btn-primary btn-xs pull-right"><i class="fa fa-plus fa-1x"></i></button>&nbsp;
                           <input type="file" name="gallery_image[]" class="form-control" multiple="">
                     </div>
                 </div>       
                 
                 <div class = "col-md-6">
                      <div class = "form-group">
                         <label>File Type</label>
                           <input type="text" name="file_type[]" class="form-control">
                     </div>
                 </div>
            </div>
            
              <div id="multi_images"></div>
            
            <div class="form-group">
                 <button type="button" id="removebtn" class= "btn btn-danger btn-xs pull-right">Remove</button>&nbsp;&nbsp;
                 <button type="button" id="addcontactdetails" class= "btn btn-primary btn-xs pull-right">Add More</button>
            </div>
            
            <div class="row">
                <div class="form-group col-md-6">
                  <label>Type of policy</label> 
                  <select name ="policy[]" id="add_policy_type" class="form-control" required >
                    <option value="">--select--</option>
                    <?php foreach($class as $da){ ?>
                    <option value="<?php echo $da->id ?>"><?php echo $da->class ?></option>
                    <?php } ?>
                </select>
            </div>
            
            <div class="form-group col-md-6">
             <label>Contact Person/position </label> 
             <input  name="contactperson[]" type="text" class="form-control" required  id="add_contactperson">
            </div>
            </div>
            
            <div class="row"> 
                <div class="form-group col-md-6">
                    <label>Email Id </label> 
                     <input name="contactemail[]" type="text" class="form-control" required  id="add_contactemail">
                </div>
            
                <div class="form-group col-md-6">
                    <label>Contact Number </label>
                     <input name="contactnumber[]" type="text" class="form-control" required  id="add_contactnumber">
                </div>
            </div>
            <div id="textbox"></div>
            
                
                <div class="form-group" id="v_regn_no_div">
                <div class="row">
                        <div class="col-md-4">
                            <label>Regn no</label>*<span id='regn_no_span' style='color:red'> </span>
                        </div>
                        
                        <div class="col-md-2 inputs">
                            <input type="text" class="form-control inputs" name="v_regn_no_1" id="v_regn_no_1" maxlength="2">
                        </div>
                        <div class="col-md-2 inputs">
                            <input type="text" class="form-control inputs" name="v_regn_no_2" id="v_regn_no_2" maxlength="2">
                        </div>
                        <div class="col-md-2 inputs">
                            <input type="text" class="form-control inputs" name="v_regn_no_3" id="v_regn_no_3" maxlength="2">
                        </div>
                        <div class="col-md-2 inputs">
                            <input type="text" class="form-control inputs" name="v_regn_no_4" id="v_regn_no_4" maxlength="4">
                        </div>
                    </div>
                </div>

            
            <div class="form-group ">
              <label>Remark</label> 
                <textarea rows="3" class="form-control" required  name="remark" id="add_remark"></textarea>
            </div>
            </div>
             <div class="modal-footer">
               <button type="button" class="btn btn-sm btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-sm btn-primary">Submit</button>
                </div>
                
              </form>
            </div>
        </div>
      </div>
    
      <div class="modal fade in" id="exiting_model">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" style="color:white;">×</span></button>
                    <h4 class="modal-title text-center">Existing Bussiness call Details</h4>
                </div>
                
           <form action ="add_ex_business"  method ="POST" enctype='multipart/form-data'>
    
              <div class="modal-body"> 
                
                <div class="form-group">
                    <label>Date</label> 
                    <input type="datetime-local" class ="form-control" name="ex_entry_date" id="ex_entry_date" value="<?php echo date("Y-m-d H:i") ?>">
                </div>
                
                <div class="row">
                    
                    
                     <div class="form-group col-md-4">
                        <label>User </label>
                        <select class="form-control select2" required  name="edit_bussiness_user" id="edit_bussiness_user" style="width:100%">
                            <option value="">--Select--</option>
                            
                            <?php if($this->session->userdata("session_role") == "user" && $this->session->userdata('session_role') != "admin" ) { ?>
                            <option value="<?php echo $this->session->userdata('session_id') ?>"><?php echo $this->session->userdata('session_name') ?></option>
                            <?php }else{ ?>
                            
                            <?php foreach($users as $da){ ?>
                            <option value="<?php echo $da->id ?>"><?php echo $da->name ?></option>
                                        <?php } }?>
                            </select>
                    </div>   
                    
                    <div class="form-group col-md-4">
                        <label>Area Incharge </label>
                        <select class="form-control select2" required  name="ex_areaincharge" id="ex_area_incharge" style="width:100%">
                            <option value="">--Select--</option>
                            
                            <?php if($this->session->userdata("session_role") == "AI") { ?>
                            <option value="<?php echo $this->session->userdata('session_id') ?>"><?php echo $this->session->userdata('session_name') ?></option>
                            <?php }else{ ?>
                            
                            <?php foreach($name as $da){ ?>
                            <option value="<?php echo $da->id ?>"><?php echo $da->name ?></option>
                                        <?php } }?>
                            </select>
                    </div>   
                    
                    <div class="form-group col-md-4">
                        <label>Name of the insurer</label>
                        <select class = "form-control select2" id="ex_insurance" name ="ex_insurance" style="width:100%" required>
                            <option value = "">--Select--</option>
                        </select>
                    </div>
                </div>
                
             <div id= "ex_view_data"></div>
                
                <div class = "row">
                    <div class = "col-md-6">
                        <div class = "form-group">
                            <label>Upload Flie</label> 
                                <button type="button" id="ag_remove_upload_btn" class= "btn btn-danger btn-xs pull-right"><i class="fa fa-minus fa-1x"></i></button>&nbsp;
                                <button type="button" id="ag_upload_btn" class= "btn btn-primary btn-xs pull-right"><i class="fa fa-plus fa-1x"></i></button>&nbsp;
                                <input type="file" name="ex_gallery_image[]" class="form-control" multiple="">
                      </div>
                    </div>       
                    <div class = "col-md-6">
                        <div class = "form-group">
                            <label>File Type</label>
                            <input type="text" name="ex_file_type[]" class="form-control">
                        </div>
                    </div>
                </div>
                
                <div id="ex_multi_images"></div>
         
                <div class="form-group">
                    <button type="button" id="ag_removebtn" class= "btn btn-danger btn-xs pull-right">Remove</button>&nbsp;&nbsp;
                    <button type="button" id="ag_addcontactdetails" class= "btn btn-primary btn-xs pull-right">Add Contacts</button>
                </div>
                
                <div id="ex_textbox"></div>
                
                <div class="form-group ">
                    <label>Remark</label> 
                    <textarea rows="3" class="form-control" required  name="ex_remark" id="ex_remark"></textarea>
                </div>
            </div>
            
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-default pull-left" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-sm btn-primary">Submit</button>
                </div>
                
              </form>
            </div>
        </div>
      </div>
      
      
      <div class="modal fade in" id="existing_dealers">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" style="color:white;">×</span></button>
                    <h4 class="modal-title text-center">Existing Dealers</h4>
                </div>
                
            <form action ="add_dealer_followup"  method ="POST" enctype='multipart/form-data'>
        
              <div class="modal-body">
                
                <div class="form-group">
                    <label>Date</label> 
                    <input type="datetime-local" class ="form-control" name="dealers_date" id="dealers_date" value="<?php echo date("Y-m-d H:i") ?>">
                </div>
                
                <div class="form-group">
                  <label>Region</label>
                      <select id="d_region" name ="d_region" class="form-control select2" required style="width:100%">
                         <option value="">--select--</option>
                         <?php foreach($region as $da){?>
                            <option value="<?php echo $da->reigion ?>"><?php echo $da->reigion ?></option>
                                    <?php } ?>
                     </select>
                 </div>
              
                <div class="row">
                    <div class="form-group col-md-4">
                        <label>User </label>
                        <select class="form-control select2" required  name="edit_user" id="edit_user" style="width:100%">
                            <option value="">--Select--</option>
                            
                            <?php if($this->session->userdata("session_role") == "user") { ?>
                            <option value="<?php echo $this->session->userdata('session_id') ?>"><?php echo $this->session->userdata('session_name') ?></option>
                            <?php }else{ ?>
                            
                            <?php foreach($users as $da){ ?>
                            <option value="<?php echo $da->id ?>"><?php echo $da->name ?></option>
                                        <?php } }?>
                            </select>
                    </div> 
                    
                    
                    <div class="form-group col-md-4">
                        <label>Area Incharge </label>
                        <select class="form-control select2" name="d_area_incharge" id="d_area_incharge" style="width:100%" required>
                            <option value="">--Select--</option>
                            
                            <?php if($this->session->userdata("session_role") == "AI") 
                            { ?>
                            <option value="<?php echo $this->session->userdata('session_id') ?>"><?php echo $this->session->userdata('session_name') ?></option>
                            <?php }
                            else
                            {
                            ?>
                            <?php foreach($name as $da){ ?>
                            <option value="<?php echo $da->id ?>"><?php echo $da->name ?></option>
                                        <?php } }?>
                            </select>
                    </div>   
                    
                    <div class="form-group col-md-4">
                        <label>Name of the Dealers</label>
                            <select class="form-control select2" name="dealers_name" id="dealers_name" style="width:100%" required>
                            <option value="">--Select--</option>
                            <?php foreach($dealers as $da){ ?>
                            <option value="<?php echo $da->id ?>"><?php echo $da->dealer_name."(".$da->region.")" ?></option>
                                        <?php } ?>
                            </select>
                        </select>
                    </div>
                    
                </div>

                <div class="form-group ">
                    <label>Remark</label> 
                    <textarea rows="3" class="form-control" required  name="d_remark" id="d_remark"></textarea>
                </div>
            </div>
            
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-default pull-left" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-sm btn-primary">Submit</button>
                </div>
                
              </form>
            </div>
        </div>
      </div>
      
     
      
      <div class="modal fade in" id="ex_agn_model">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" style="color:white;">×</span></button>
                    <h4 class="modal-title text-center">Existing Agent</h4>
                </div>
                
           <form action ="add_agn_business"  method ="POST" enctype='multipart/form-data'>
    
              <div class="modal-body">
                
                <div class="form-group">
                    <label>Date</label> 
                    <input type="datetime-local" class ="form-control" name="ag_entry_date" id="ag_entry_date" value="<?php echo date("Y-m-d H:i") ?>">
                </div>
                
                <div class="form-group">
                  <label>Region</label>
                      <select id="ag_region" name ="ag_region" class="form-control select2" required style="width:100%">
                         <option value="">--select--</option>
                         <?php foreach($region as $da){?>
                            <option value="<?php echo $da->reigion ?>"><?php echo $da->reigion ?></option>
                                    <?php } ?>
                     </select>
                 </div>
                
                <div class="row">
                    <div class="form-group col-md-4">
                        <label>User </label>
                        <select class="form-control select2" required  name="edit_agent_user" id="edit_agent_user" style="width:100%">
                            <option value="">--Select--</option>
                            
                            <?php if($this->session->userdata("session_role") == "user" && $this->session->userdata('session_role') != "admin" ) { ?>
                            <option value="<?php echo $this->session->userdata('session_id') ?>"><?php echo $this->session->userdata('session_name') ?></option>
                            <?php }else{ ?>
                            
                            <?php foreach($users as $da){ ?>
                            <option value="<?php echo $da->id ?>"><?php echo $da->name ?></option>
                                        <?php } }?>
                            </select>
                    </div> 
                    
                    
                    <div class="form-group col-md-4">
                        <label>Area Incharge </label>
                        <select class="form-control select2" required  name="ag_areaincharge" id="ag_area_incharge" style="width:100%">
                            <option value="">--Select--</option>
                            
                            <?php if($this->session->userdata("session_role") == "AI") { ?>
                            <option value="<?php echo $this->session->userdata('session_id') ?>"><?php echo $this->session->userdata('session_name') ?></option>
                            <?php }else{ ?>
                            
                            <?php foreach($name as $da){ ?>
                            <option value="<?php echo $da->id ?>"><?php echo $da->name ?></option>
                                        <?php } }?>
                            </select>
                    </div>   
                    
                    <div class="form-group col-md-4">
                        <label>Name of the Agent</label>
                        <select class = "form-control select2" id="ag_agent" name ="ag_agent" style="width:100%" required>
                            
                        </select>
                    </div>
                </div>
              
                <div class="form-group ">
                    <label>Remark</label> 
                    <textarea rows="3" class="form-control" required  name="ex_remark" id="ex_remark"></textarea>
                </div>
                
            </div>
            
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-default pull-left" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-sm btn-primary">Submit</button>
                </div>
                
              </form>
            </div>
        </div>
      </div>
     
      <div class="modal fade in" id="edit_model">
        <div class="modal-dialog modal-lg">
          <form action ="edit_joine_call"  method ="POST" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" style="color:white;">×</span></button>
                    <h4 class="modal-title text-center">Edit Bussiness call Details</h4>
                </div>
                
                 <div class="modal-body">
                     
                     <div class="form-group ">
                      <label>Date</label> 
                        <input type="datetime-local" class ="form-control" name="edit_entry_date" id="edit_entry_date">
                    </div>
                     
                <div class="row">
                
                     <div class="form-group col-md-4">
                     <label>Area Incharge </label>
                      <select class="form-control select2" required  name="edit_areaincharge" id="edit_areaincharge" style="width:100%">
                        <option value="">--Select--</option>
                          
                         <?php if($this->session->userdata("session_role") == "AI") { ?>
                           <option value="<?php echo $this->session->userdata('session_id') ?>"><?php echo $this->session->userdata('session_name') ?></option>
                         <?php }else{ ?>
                         
                            <?php foreach($name as $da){ ?>
                            <option value="<?php echo $da->id ?>"><?php echo $da->name ?></option>
                                            <?php } }?>
                      </select>
                   </div>  
                   
                     <div class="form-group col-md-4">
                          <label>Name of the insurer</label> 
                         <input type="text" class="form-control" required name="edit_insurer"  id="edit_insurance">
                      </div>
                      
                    <div class="form-group col-md-4">
                          <label>Region</label>
                              <select id="edit_region" name ="edit_region" class="form-control select2" required style="width:100%">
                                 <option value="">--select--</option>
                                 <?php foreach($region as $da){?>
                                    <option value="<?php echo $da->reigion ?>"><?php echo $da->reigion ?></option>
                                            <?php } ?>
                             </select>
                         </div>
                 </div>
                 

             <div class="row">
                 <div class="form-group col-md-12">
                      <label>Address</label> 
                     <textarea type="text" class="form-control" name="edit_address" id="edit_address" rows="3"></textarea>
                </div>
             </div>

              <div class = "row">
                <div class="form-group col-md-6">
                    <button type="button" id="remove_edit_upload_btn" class= "btn btn-danger btn-xs pull-right"><i class="fa fa-minus fa-1x"></i></button>&nbsp;
                    <button type="button" id="edit_upload_btn" class= "btn btn-primary btn-xs pull-right"><i class="fa fa-plus fa-1x"></i></button>&nbsp;
                    <label>Upload Flie</label>
                    <input type="file" name="edit_gallery_image[]" class="form-control" multiple="">
                </div>
            
               <div class="form-group col-md-6">
                    <label>File Type</label>
                    <input type="text" name="edit_file_type[]" class="form-control">
                </div>
              </div>
              
              <div id = "edit_multi_images"></div>
              
           
             
              <div class="form-group">
                 <button type="button" id="edit_removebtn" class= "btn btn-danger btn-xs pull-right">Remove</button>&nbsp;&nbsp;
                 <button type="button" id="editcontactdetails" class= "btn btn-primary btn-xs pull-right">Add More</button>
            </div>
            
             <div id="edit_textbox"></div>
             
             <div class="form-group">
                      <label>Remark</label> 
                    <textarea rows="3" class="form-control" required  name="edit_remark" name = "edit_policy" id="edit_remark"></textarea>
                </div>
                
          
                
            <div id="edit_files"></div>
            
            </div>
                <div class="modal-footer">
                    <input type="hidden" id="edit_id" name="edit_id">
                    <button type="button" class="btn btn-sm btn-default pull-left" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-sm btn-primary">Submit</button>
                </div>
            </div>
            </form>
        </div>
    </div>
    
      <div class="modal fade in" id="view_model">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" style="color:white;">×</span></button>
                    <h4 class="modal-title text-center">Business Call Contact Details</h4>
                </div>
                <div class="modal-body">
                     <div id="view_data"></div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="view_id">
                    <button type="button" class="btn btn-sm btn-default pull-left" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
      </div> 
      
      <div class="modal fade in" id="add_leavemodel">
        <div class="modal-dialog modal-ml">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" style="color:white;">×</span></button>
                    <h4 class="modal-title text-center">Business Call Contact Details</h4>
                </div>
                <div class="modal-body">
             <div class="row">
                 <div class="form-group col-md-6">
                    <label>Area Incharge </label>
                     <select class="form-control select2" required  name="leave_areaincharge" id="leave_areaincharge" style="width:100%">
                        <option value="">--Select--</option>
                          
                         <?php if($this->session->userdata("session_role") == "AI") { ?>
                           <option value="<?php echo $this->session->userdata('session_id') ?>"><?php echo $this->session->userdata('session_name') ?></option>
                         <?php }else{ ?>
                         
                            <?php foreach($name as $da){ ?>
                            <option value="<?php echo $da->name ?>"><?php echo $da->name ?></option>
                                            <?php } }?>
                      </select>
                   </div>
                   
                   
              <div class="form-group col-md-6">
                <label>leave permission</label>
                   <select class = "form-control" name="leave_permission" id="leave_permission">
                        <option value = "">--Select--</option>
                        <option value = "Leave">Leave</option>
                        <option value = "Permission">Permission</option>
                    </select>
                </div>
                
                </div>
                   
           <div class="row">  
            <div class="form-group col-md-6">
                <label>From Date</label> 
                <input type="datetime-local" class ="form-control" name="leavefrom_date" id="leavefrom_date">
            </div>
             
             
              <div class="form-group col-md-6">
                <label>To Date</label> 
                <input type="datetime-local" class ="form-control" name="leaveto_date" id="leaveto_date">
            </div>
            
            </div> 
        </div>
        
           <div class="modal-footer">
               <button type="button" class="btn btn-sm btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="submit" id="leave_btu" class="btn btn-sm btn-primary">Submit</button>
                </div>
            </div>
        </div>
      </div>
      
      <div class="modal fade in" id="view_report_modal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" style="color:white;">×</span></button>
                    <h4 class="modal-title text-center">AI Daywise Report</h4>
                </div>
                <div class="modal-body">
                    
                 
                 <div class = "row">
                      <div class = "form-group col-md-4">
                           <label>From Date</label>
                           <input type = "date" class = "form-control" name = "r_f_date" id="r_f_date">
                     </div>
                     
                     <div class = "form-group col-md-4">
                           <label>To Date</label>
                           <input type = "date" class = "form-control" name = "r_to_date" id="r_to_date">
                     </div>
                     
                     <input type="hidden" id="ai_id">
                     
                     <div class = "form-group col-md-4">
                         <br>
                         <button class = "btn btn-danger btn-sm" onclick = "excel_report()"><i class="fa fa-file-excel-o" aria-hidden="true"></i> Export</button>
                     </div>
                 </div>
                  
                    
                     <div id="view_report"></div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="view_id">
                    <button type="button" class="btn btn-sm btn-default pull-left" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
      </div> 
      
      
      <div class="modal fade in" id="DealerMod">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" style="color:white;">×</span></button>
                    <h4 class="modal-title text-center">Add Dealers</h4>
                </div>
       
                <div class="modal-body">
                 <div class = "row">
                     <div class="form-group col-md-4">
                          <label>Region</label>
                              <select id="dealers_region" name ="dealers_region" class="form-control select2" required style="width:100%">
                                 <option value="">--select--</option>
                                 <?php foreach($region as $da){?>
                                    <option value="<?php echo $da->reigion ?>"><?php echo $da->reigion ?></option>
                                            <?php } ?>
                             </select>
                         </div>
                         
                     <div class="form-group col-md-4">
                          <label>Policy Class</label>
                          <select id="d_policy_class" name ="d_policy_class" class="form-control select2" required style="width:100%">
                             <option value="">--select--</option>
                             <?php foreach($class as $da){?>
                                <option value="<?php echo $da->class ?>"><?php echo $da->class ?></option>
                                        <?php } ?>
                         </select>
                     </div>
                     
                      <div class="form-group col-md-4">
                          <label>Policy Type</label>
                          <input type="text" id="d_p_type" name ="d_p_type" class="form-control" placeholder= "Eg(Bike ,Car,Misc-D)">
                     </div>
                 </div>
           
                <div class = "row">
                    <div class="form-group col-md-4">
                        <label>Brand</label> 
                        <input type="text" class="form-control" id="d_brand" name="d_brand"> 
                    </div>
                    
                    <div class="form-group col-md-4">
                        <label>Dealer Name</label> 
                        <input type="text" class="form-control" id="dealer_name" name="activice"> 
                    </div>
                    
                    <div class="form-group col-md-4">
                        <label>Mobile No</label> 
                        <input type="text" class="form-control" id="dealer_mobile_no" name="dealer_mobile_no"> 
                    </div>
                </div>
                  
                <div class = "row">
                    <div class="form-group col-md-6">
                         <label>Email Id</label> 
                         <input type="email" class="form-control" id="d_email" name="d_email" >
                    </div>
                    
                    <div class="form-group col-md-6">
                          <label>Address</label> 
                          <textarea type="text" class="form-control" id="d_address" name="d_address" rows="3" required></textarea>
                      </div>
               </div>
                
                
                <div class="form-group">
                      <label>Remark</label> 
                        <textarea rows="3" class="form-control" required  name="add_remark1" id="add_remark1"></textarea>
                    </div>
            </div>
            
            
                 <div class="modal-footer">
                   <button type="button" class="btn btn-sm btn-default pull-left" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-sm btn-primary" id="add_btn">Submit</button>
                </div>
            </div>
        </div>
      </div>
    
 <script>
 
    $(document).ready(function(){
        
        $('.select2').select2();
        fetch_bussinesscall();
        
        fetch_exiting_clients();
        
        
     $("#search_btn").click(function(){
        fetch_bussinesscall();
        var region = $("#select_region").val();
        var fromdate =$("#from_date").val();
        var todate =$("#to_date").val();
        var mobile_no = $("#s_mobile_no").val();
        var insurer = $("#s_insurer").val();
        var areaincharge =$("#select_areaincharge").val();
    
          $.ajax({
                url : "fetch_bussinesscall",
                    method : "POST",
                      data:{region:region,fromdate:fromdate,todate:todate,mobile_no:mobile_no,insurer:insurer,areaincharge:areaincharge},
                      method:"POST",
                 success:function(response){
                $("#absent_students_list").html(response);
            },
            error: function(code) {
                alert(code.statusText);
            },
        });
    });
   
     $("#addcontactdetails").click(function(){
         
           var content = "";
            content += '<h4>Add contact </h4>';
            content += '<div class="row"> ';
            content += '<div class="form-group col-md-6">';
            content += ' <label>Type of policy</label>';
            content += '<select name ="policy[]" id="add_policy_type" class="form-control" required >'; 
            content += '<option value="">--select--</option>'; 
            content += '<?php foreach($class as $da){ ?>';
            content += '<option value="<?php echo $da->id ?>"><?php echo $da->class ?></option>';
            content += ' <?php } ?>';
            content += '</select>';
            content += ' </div>';
      
            content  +='<div class="form-group col-md-6">';
            content  +='<label>Contact Person/position </label>';
            content  +='<input name="contactperson[]" type="text" class="form-control" required  id="add_contactperson">';
            content += ' </div>';
            content +=' <div class="form-group col-md-6">';
            content +=' <label>Email Id </label>';
            content += ' <input name="contactemail[]" type="text" class="form-control" required  id="add_contactemail">';
            content += '</div>';
            content += '<div class="form-group col-md-6">';
            content += '<label>Contact Number </label>';
            content +='<input name="contactnumber[]" type="text" class="form-control" required  id="add_contactnumber">';
            content += '</div>';
            content += '</div>';
            
            $("#textbox").append(content);
            
         });
         
     $("#editcontactdetails").click(function(){ 
             
           var content = "";
            content += '<h4>Add contact </h4>';
            content += '<div class="row"> ';
            content += '<div class="form-group col-md-6">';
            content += ' <label>Type of policy</label>';
            content += '<select name ="edit_policy[]" class="form-control" required >'; 
            content += '<option value="">--select--</option>'; 
            content += '<?php foreach($class as $da){ ?>';
            content += '<option value="<?php echo $da->id ?>"><?php echo $da->class ?></option>';
            content += ' <?php } ?>';
            content += '</select>';
            content += ' </div>';
      
            content  +='<div class="form-group col-md-6">';
            content  +='<label>Contact Person/position </label>';
            content  +='<input name="edit_contactperson[]" type="text" class="form-control" required>';
            content += ' </div>';
            content +=' <div class="form-group col-md-6">';
            content +=' <label>Email Id </label>';
            content += ' <input name="edit_contactemail[]" type="text" class="form-control" required>';
            content += '</div>';
            content += '<div class="form-group col-md-6">';
            content += '<label>Contact Number </label>';
            content +='<input name="edit_contactnumber[]" type="text" class="form-control" required>';
            content += '</div>';
            content += '</div>';
            
            $("#edit_textbox").append(content);
            
         });
    
        $('#removebtn').click(function(){
           $('#textbox').children().last().remove();
        });
             
     $('#edit_removebtn').click(function(){
        	  $('#edit_textbox').children().last().remove();
         });
    
        $('#add_upload_btn').click(function(){
                var content = "<div class ='row'>";
                content += '<div class="form-group col-md-6">';
                content += ' <label>Upload File</label>';
                content += '<input type="file" name ="gallery_image[]" class="form-control" required>'; 
                content += ' </div>';
          
                content  +='<div class="form-group col-md-6">';
                content  +='<label>File type </label>';
                content  +='<input name="file_type[]" type="text" class="form-control" required >';
                content += ' </div>';
                 content += ' </div>';
                 $("#multi_images").append(content);
            });
                 
        $('#remove_upload_btn').click(function(){
              $('#multi_images').children().last().remove();
        });
          
        $('#edit_upload_btn').click(function(){
                var content = "<div class ='row'>";
                content += '<div class="form-group col-md-6">';
                content += ' <label>Upload File</label>';
                content += '<input type="file" name ="edit_gallery_image[]" class="form-control" required>'; 
                content += ' </div>';
          
                content  +='<div class="form-group col-md-6">';
                content  +='<label>File type </label>';
                content  +='<input name="edit_file_type[]" type="text" class="form-control" required>';
                content += ' </div>';
                 content += ' </div>';
                 $("#edit_multi_images").append(content);
         });
                 
        $('#remove_edit_upload_btn').click(function(){
              $('#edit_multi_images').children().last().remove();
        });
        
        
        $("#leave_btu").click(function(){
        var leaveai = $("#leave_areaincharge").val();
        var leavepermission = $("#leave_permission").val();
        var leavefrom_date = $("#leavefrom_date").val();
        var leaveto_date = $("#leaveto_date").val();
        
        
         $.ajax({
            url:"add_leave_permission",
            data:{leaveai:leaveai,leavepermission:leavepermission,leavefrom_date:leavefrom_date,leaveto_date:leaveto_date},
            method:"POST",
            beforeSend:function(){
                $("#add_btn").attr("disabled",true);
            },
            success:function(response){
                fetch_leavepermission();
                $("#leave_areaincharge").val("");
                $("#leave_permission").val("");
                $("#leavefrom_date").val("");
                $("#leaveto_date").val("");
                $("#add_btn").attr("disabled",false);
                $("#add_model").modal("hide");
                $("#add_leavemodel").modal("toggle");
            },
            error: function(code) {   
                alert(code.statusText);
            },
          });
      });
        
        $("#add_insurance").change(function(){
           var insurer = $("#add_insurance").val();
           $.ajax({
                       url : "fetch_insurer_details",
                       method : "POST",
                       data : {insurer:insurer},
                       success:function(response)
                       {
                           var obj = jQuery.parseJSON(response);
                            $("#add_region").val(obj.region);
                            $("#add_region").trigger("change");
                            // $("#add_business_location").val(obj.businesslocation);
                           // $("#add_location").val(obj.location);
                            $("#add_activice").val(obj.activice);
                            $("#add_address").val(obj.address);
                            $("#add_pin").val(obj.pin);
                            $("#followup_date").val(obj.date);
                       }
           });
            
        });
        
        $("#ex_insurance").change(function(){
             var id = $("#ex_insurance").val();
           
           $.ajax({
                       url : "fetch_view_joinecall",
                       method : "POST",
                       data : {id:id},
                       success:function(response)
                       {
                         $("#ex_view_data").html(response);
                       }
           });
        });
        
        $('#add_upload_btn').click(function(){
                var content = "<div class ='row'>";
                content += '<div class="form-group col-md-6">';
                content += ' <label>Upload File</label>';
                content += '<input type="file" name ="gallery_image[]" class="form-control" required>'; 
                content += ' </div>';
          
                content  +='<div class="form-group col-md-6">';
                content  +='<label>File type </label>';
                content  +='<input name="file_type[]" type="text" class="form-control" required >';
                content += ' </div>';
                 content += ' </div>';
                 $("#multi_images").append(content);
            });
            
        $('#ag_upload_btn').click(function(){
                var content = "<div class ='row'>";
                content += '<div class="form-group col-md-6">';
                content += ' <label>Upload File</label>';
                content += '<input type="file" name ="ex_gallery_image[]" class="form-control" required>'; 
                content += ' </div>';
          
                content  +='<div class="form-group col-md-6">';
                content  +='<label>File type </label>';
                content  +='<input name="ex_file_type[]" type="text" class="form-control" required >';
                content += ' </div>';
                 content += ' </div>';
                 $("#ex_multi_images").append(content);
            });
            
        $("#ag_remove_upload_btn").click(function(){
                $('#ex_multi_images').children().last().remove();
            });
            
        $("#ag_addcontactdetails").click(function(){
           var content = "";
            content += '<h4>Add contact </h4>';
            content += '<div class="row"> ';
            content += '<div class="form-group col-md-6">';
            content += ' <label>Type of policy</label>';
            content += '<select name ="ag_policy[]" id="ex_policy" class="form-control" required >'; 
            content += '<option value="">--select--</option>'; 
            content += '<?php foreach($class as $da){ ?>';
            content += '<option value="<?php echo $da->id ?>"><?php echo $da->class ?></option>';
            content += ' <?php } ?>';
            content += '</select>';
            content += ' </div>';
      
            content  +='<div class="form-group col-md-6">';
            content  +='<label>Contact Person/position </label>';
            content  +='<input name="ag_contactperson[]" type="text" class="form-control" required>';
            content += ' </div>';
            content +=' <div class="form-group col-md-6">';
            content +=' <label> Email Id</label>';
            content += ' <input name="ex_contactemail[]" type="text" class="form-control" required  id="add_contactemail">';
            content += '</div>';
            content += '<div class="form-group col-md-6">';
            content += '<label>Contact Number </label>';
            content +='<input name="ex_contactnumber[]" type="text" class="form-control" required  id="add_contactnumber">';
            content += '</div>';
            content += '</div>';
            
            $("#ex_textbox").append(content);
            
         });
        
        $('#ag_removebtn').click(function(){
        	  $('#ex_textbox').children().last().remove();
         });
         
        $("#ex_area_incharge").change(function(){
            var area_incharge = $("#ex_area_incharge").val();
             fetch_exiting_clients(area_incharge);
         });
        
        $("#r_f_date").change(function(){
            var ai = $("#ai_id").val();
            var f_date = $("#r_to_date").val();
            var to_date = $("#r_to_date").val();
            
            if(f_date != "" && to_date != "")
            {
               report(ai);
            }
        });
        
        $("#r_to_date").change(function(){
            var ai = $("#ai_id").val();
            var f_date = $("#r_to_date").val();
            var to_date = $("#r_to_date").val();
            
            if(f_date != "" && to_date != "")
            {
               report(ai);
            }
        });
        
       $(".inputs").keyup(function () {
           $(this).val($(this).val().toUpperCase()); 
            if(this.value.length == this.maxLength) 
            {
              $(this).next('.inputs').focus();
            }
            check_vehi_regn_no();
        });
        
       $("#ag_area_incharge").change(function(){
           
         var ai = $("#ag_area_incharge").val();
          fetch_agents(ai);
       });
       
       
           $("#add_btn").click(function(){
              var regions = $("#dealers_region").val();
              var p_type = $("#d_p_type").val();
              var p_class = $("#d_policy_class").val();
              var brand = $("#d_brand").val();
              var dealer_name = $("#dealer_name").val();
              var dealer_mobile_no = $("#dealer_mobile_no").val();
              var email = $("#d_email").val();
              var address = $("#d_address").val();
              var remark = $("#add_remark1").val();
              
          
              var contact_person = [];
             $(".contact_person").each(function(){
                contact_person.push($(this).val());  
              }); 
              var contact_email = [];
              $(".contact_email").each(function(){
                    contact_email.push($(this).val());  
              }); 
              var contact_no= [];
              $(".contact_no").each(function(){
                    contact_no.push($(this).val());  
              });
             
              if(regions == "")
              {
                  alert("Select Region");
              }
              else if(p_class == "")
              {
                  alert("Select Policy Class");
              }
              else if(p_type == "")
              {
                  alert("Enter Policy Type");
              }
              else if(dealer_name == "")
              {
                  alert("Enter Dealer Name");
              }
              else if(brand == "")
              {
                   alert("Enter Brand Name");
              }
              else if(address == "")
              {
                  alert("Enter a Address");
              }
              else 
              {
                  $.ajax({
                            url : "add_dealer_details",
                            method : "POST",
                            data : {regions:regions,p_class:p_class,p_type:p_type,brand:brand,dealer_name:dealer_name,dealer_mobile_no:dealer_mobile_no,email:email,address:address,remark:remark,contact_person:contact_person,contact_email:contact_email,contact_no:contact_no},
                            beforeSend:function(response){
                                $("#add_btn").attr("disabled",true);
                            },
                            success:function(response)
                            {
                                $("#add_btn").attr("disabled",false);
                                alert("Dealer Details Stored Successfully..");
                                $("#DealerMod").modal("toggle");
                                fetch_bussinesscall();
                            }
                  });
              }
     
        });
       
 }); 
      
     function fetch_bussinesscall()
     {
        var region = $("#select_region").val();
        var mobile_no = $("#s_mobile_no").val();
        var insurer = $("#s_insurer").val();
        var fromdate =$("#from_date").val();
        var todate =$("#to_date").val();
        var areaincharge =$("#select_areaincharge").val();
        
      var content = "";
      content += "<div class='table-responsive'>";
      content += "<table id='table_id' class='table table-hover table-bordered'>"; 
      content += "<thead><th>S.No</th><th>Insurer</th><th>AI</th><th>Region</th><th>Address</th><th>Remarks</th><th>Created Date</th><th>Action_Record</th></thead>";
      content += "<tbody></tbody>";
      content += "</table>";
      content += "</div>";
      
      $("#table_view").html(content);

      $("#table_id").DataTable({
          "processing": true,
          "serverSide": false,
          "ordering": false,
          "pageLength": 10,
          "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
          "ajax":{
            'url':'fetch_bussinesscall',
             method : "POST",
             data:{region:region,mobile_no:mobile_no,insurer:insurer,fromdate:fromdate,todate:todate,areaincharge:areaincharge},
          }
      });      
    }
    
     function fetch_leavepermission()
     {
     var content = "";
      content += "<div class='table-responsive'>";
      content += "<table id='table_id' class='table table-hover table-bordered'>"; 
      content += "<thead><th>S.No</th><th>Area Incharge</th><th>Permission Status</th><th>From Date</th><th>To Date</th><th>Action_Record</th></thead>";
      content += "<tbody></tbody>";
      content += "</table>";
      content += "</div>";
      
      $("#table_view").html(content);

      $("#table_id").DataTable({
          "processing": true,
          "serverSide": false,
          "ordering": false,
          "pageLength": 10,
          "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
          "ajax":{
            'url':'fetch_leavepermission',
           }
      });      
    }
    
    function edit_data(id)
    {
      $.ajax({
        url:"fetch_edit_joinecall",
        data:{id:id},
        method:"POST",
        success:function(response){
          var obj = jQuery.parseJSON(response);
          var content = "";
          
          $("#edit_areaincharge").val(obj["b_info"].areaincharge);
          
         $("#edit_areaincharge").trigger("change");
          
          $("#edit_insurance").val(obj["b_info"].insurer);
          $("#edit_region").val(obj["b_info"].region);
          $("#edit_region").trigger("change");
          $("#edit_business_type").val(obj["b_info"].region);
          //$("#edit_business_location").val(obj["b_info"].businesslocation);
          //$("#edit_location").val(obj["b_info"].location);
          $("#edit_activice").val(obj["b_info"].activice);
          $("#edit_address").val(obj["b_info"].address);
          $("#edit_pin").val(obj["b_info"].pin);
          $("#edit_remark").val(obj["b_info"].remark);
          $("#edit_followup_date").val(obj["b_info"].date);
          $("#edit_entry_date").val(obj["b_info"].entry_date);
          

          for(var i= 0;i<obj["c_details"].length;i++)
          {
            content += '<h4>Add contact </h4>';
            content += '<div class="row"> ';
            content += '<div class="form-group col-md-6">';
            content += ' <label>Type of policy</label>';
            content += '<select name ="edit_policy[]" class="form-control" required >'; 
            content += '<option value="">--select--</option>'; 
            content += '<?php foreach($class as $da){ ?>';
            content += '<option value="<?php echo $da->id ?>"><?php echo $da->class ?></option>';
            content += '<?php } ?>'
            content += '</select>';
            content += ' </div>';
      
            content  +='<div class="form-group col-md-6">';
            content  +='<label>Contact Person /position</label>';
            content  +='<input name="edit_contactperson[]" type="text" class="form-control" required  value='+obj["c_details"][i].contactperson+' value='+obj["c_details"][i].contactposition+'>';
            content += ' </div>';
            content +=' <div class="form-group col-md-6">';
            content +=' <label> Email Id </label>';
            content += ' <input name="edit_contactemail[]" type="text" class="form-control" required  value='+obj["c_details"][i].contactemail+'>';
            content += '</div>';
            content += '<div class="form-group col-md-6">';
            content += '<label>Contact Number </label>';
            content +='<input name="edit_contactnumber[]" type="text" class="form-control" required  value='+obj["c_details"][i].contactnumber+'>';
            content += '</div>';
            content += '</div>';
          }
          $("#edit_textbox").append(content);
          
          $("#edit_files").html(obj["files"]);
          
          $("#edit_model").modal("show");
          $("#edit_id").val(id);
          
        },
        error: function(code) {   
            alert(code.statusText);
        },
      });
      
    }
  
    function view_data(id)
    {
      $.ajax({
        url:"fetch_view_joinecall",
        data:{id:id},
        method:"POST",
        success:function(response){
          // alert(response);
          $("#view_data").html(response);
          $("#view_model").modal("show");
        },
        error: function(code) {   
            alert(code.statusText);
        },
      });
      
    }
    
    function delete_data(id)
    {
      if(confirm("Are you Confirm to Delete"))
      {
        $.ajax({
          url:"delete_joinecall",
          data:{id:id},
          method:"POST",
          success:function(response){
            //alert(response);
            fetch_bussinesscall();
          },
          error: function(code) {   
            alert(code.statusText);
          },
        });
      }
    }
    
    
    function delete_file(id)
    {
          if(confirm("Are you Confirm to Delete"))
          {
            $.ajax({
              url:"delete_files",
              data:{id:id},
              method:"POST",
              success:function(response){
                  $("#edit_model").modal("toggle");
                fetch_bussinesscall();
              },
              error: function(code) {   
                alert(code.statusText);
              },
            });
      }
    }
    
    function export_excel()
    {
        fetch_bussinesscall();
        var region = $("#select_region").val();
        var fromdate =$("#from_date").val();
        var todate =$("#to_date").val();
        var mobile_no = $("#s_mobile_no").val();
        var insurer = $("#s_insurer").val();
        var areaincharge =$("#select_areaincharge").val();
        
          $.ajax({
                      url : "export_excel_business_calls",
                      method : "POST",
                      data:{region:region,fromdate:fromdate,todate:todate,mobile_no:mobile_no,insurer:insurer,areaincharge:areaincharge},
                      success:function(response)
                      {
                          window.open(response, "_blank");
                      }
          });        
    }
    
    function fetch_exiting_clients()
    {
        $.ajax({
                  url : "fetch_exiting_clients",
                  method : "POST",
                  success:function(response)
                  {
                      $("#ex_insurance").html(response);
                  }
        });
    }
    
    function excel_report()
    {   
        var ai = $("#ai_id").val();
        var f_date = $("#r_f_date").val();
        var to_date = $("#r_to_date").val();
        
         $.ajax({
              url : "ai_daily_report_excel",
              method : "POST",
              data : {ai:ai,f_date:f_date,to_date:to_date},
              success:function(response)
              {
                  window.location.href=response;
              }
              
        });
    }
    
    function report(ai)
    {
        var f_date = $("#r_f_date").val();
        var to_date = $("#r_to_date").val();
        $.ajax({
                  url : "fetch_ai_daily_report",
                  method : "POST",
                  data : {ai:ai,f_date:f_date,to_date:to_date},
                  success:function(response)
                  {
                      $("#ai_id").val(ai);
                      $("#view_report").html(response);

                       if($('#view_report_modal').is(':visible'))
                       {
                           
                       }
                       else
                       {
                           $("#view_report_modal").modal("toggle");
                       }
                  }
        });
    }
    
    
    function check_vehi_regn_no()
    {
      
        var regn_no_1 = $("#regn_no_1").val();
        var regn_no_2 = $("#regn_no_2").val();
        var regn_no_3 = $("#regn_no_3").val();
        var regn_no_4 = $("#regn_no_4").val();
        
        var regn_no = regn_no_1+"-"+regn_no_2+"-"+regn_no_3+"-"+regn_no_4;
      
      if(regn_no_1 != "" && regn_no_2 != "" && regn_no_3 != "" && regn_no_4 != "" && regn_no_4.length == "4")
      {  
        $.ajax({
                    url : "check_vehi_regn_no",
                    method : "POST",
                    data : {regn_no:regn_no},
                    success:function(response)
                    {
                        if(response == "Exits")
                        {
                             snackbar_show("Regn No Already Exits");
                             $("#regn_no_span").html("Regn No Already Exits");
                            $("#add_vechile_btn").attr("disabled",true);
                        }
                        else 
                        {
                            $("#regn_no_span").html("");
                            $("#add_vechile_btn").attr("disabled",false);
                        }
                    }
        });
      }
    }
    
    function fetch_agents(ai)
    {
        $.ajax({
                  url : "fetch_agents",
                  method : "POST",
                  data : {ai:ai},
                  success:function(response)
                  {
                       $("#ag_agent").html(response);
                  }
        });
    }
      
     </script>  