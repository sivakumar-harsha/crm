   
 
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

 .change_pet_gender
    {
        background-color: #12b48b !important;
        color: white !important;
    }

.form-check-input:checked {
    background-color: #0d6efd !important;
    border-color: #0d6efd !important;
}
.form-check-input{
    border-color: 1px solid #D3CFC8 !important;
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
.save_model{
    margin-right:-70px;
}
@media only screen and (max-width: 600px) {
  .save_model {
     margin-right:0px;
  }
}
input[type=checkbox], input[type=radio] {
    margin: 9px 0px 0;
    margin-top: 1px\9;
    line-height: normal;
}

.modal-lg {
  width: 100%;
  height: 100%;
  margin: 0;
  padding: 0;
  z-index:10000000 !important;
}

.no_mar_pad {
    margin-top: 0px;
    margin-bottom: 0px;
    padding-top: 8px !important;
    padding-bottom: 0px !important;
    color :#5b6379 !important;
}

.modal-lg-content {
  height: auto;
  width:auto;
  min-height: 100%;
  border-radius: 0;
}

@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap');
*{
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: "Poppins", sans-serif;
}

 .drag-area{
  border: 2px dashed #fff;
  height: 500px;
  width: 700px;
  border-radius: 5px;
  display: flex;
  align-items: center;
  justify-content: center;
  flex-direction: column;
}
.drag-area.active{
  border: 2px solid #fff;
}
.drag-area .icon{
  font-size: 100px;
  color: #fff;
}
.drag-area header{
  font-size: 30px;
  font-weight: 500;
  color: #fff;
}
.drag-area span{
  font-size: 25px;
  font-weight: 500;
  color: #fff;
  margin: 10px 0 15px 0;
}
.drag-area button{
  padding: 10px 25px;
  font-size: 20px;
  font-weight: 500;
  border: none;
  outline: none;
  background: #fff;
  color: #5256ad;
  border-radius: 5px;
  cursor: pointer;
}
.drag-area img{
  height: 100%;
  width: 100%;
  object-fit: cover;
  border-radius: 5px;
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

.form-control[disabled], .form-control[readonly], fieldset[disabled] .form-control {
    background-color: #fff !important;
    opacity: 1;
}

.modal {
    position: fixed;
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;
    z-index: 1050;
    display: none;
    overflow: auto !important;
    -webkit-overflow-scrolling: touch;
    outline: 0;
}

.form-check-input {
    width: 2em;
    height: 1.5em;
    background-color: #fff;
    background-repeat: no-repeat;
    border: 1px solid rgba(0,0,0,.25);
}
*, ::after, ::before {
    box-sizing: border-box;
}

input[type=checkbox], input[type=radio] {
    margin: 5px 0px 0 !important;
    line-height: normal;
}

/*  Property    */
  
  .change_house_type
    {
        background-color: #12b48b !important;
        color: white !important;
    }
    .change_owner
    {
        background-color: #12b48b !important;
        color: white !important;
    }
    .business_change_owner
    {
        background-color: #12b48b !important;
        color: white !important;
    }
     
    </style>
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    
     <section class="content-header">
       <div class="row">
           <div class="col-md-6">
               <h4>Create New Lead</h4>
           </div>
            <div class="col-md-6 pull-right">
                
               <button class="btn btn-danger btn-sm pull-right"><i class="fa fa-times" aria-hidden="true"></i> Cancel</button>
                <span class="pull-right">&nbsp;</span>
                <button class="btn btn-success btn-sm pull-right" id="save_btn"><i class="fa fa-save"></i> Save</button>
                <span class="pull-right">&nbsp;</span>
                <button class="btn btn-success btn-sm pull-right hidden" id="update_btn"><i class="fa fa-save"></i> Save</button>
                <span class="pull-right">&nbsp;</span>
                <button class="btn btn-primary btn-sm pull-right hidden" id="prospect_btn"><i class="fa fa-diamond" aria-hidden="true"></i> Create Prospect</button>
                <span class="pull-right">&nbsp;</span>
                <button class="btn btn-warning btn-sm pull-right hidden" id="sms_btn"><i class="fa fa-envelope" aria-hidden="true"></i> Sms</button>
                <span class="pull-right">&nbsp;</span>
                
                <?php 
                
                if(isset($_GET["id"]))
                {
                    $id = $_GET["id"];
                }
                else
                {
                    $id="";
                }
                
                ?>
                
                <a href="generate_policy?id=<?php echo $id ?>" class="btn btn-primary btn-sm pull-right hidden" id="policy_btn"><i class="fa fa-umbrella" aria-hidden="true"></i> Generate Policy</a>
                
                <span class="pull-right">&nbsp;</span>
            </div>
       </div>
    </section>
    
    <?php 
        $id="";
     if(isset($_GET["id"]))
     {
         $id = $_GET["id"];
     }
     else
     {?>
       <script>
         $("#last_inserted_id").val("");
       </script>
     <?php
     }
    ?>
    
    <input type="hidden" id="last_inserted_id" value="<?php echo $id ?>">
   
    <!-- Main content -->
    <section class="content">
        
    <div class="box">
        <div class="box-header with-border" style="background:#f4f4f48c;">
            <h3 class="box-title" _msthash="26273" _msttexthash="60619" style="text-align: left;font-size:14px;"><i class="fa fa-user" aria-hidden="true"></i> &nbsp;&nbsp;Client Details</h3>
            
            <div class="box-tools pull-right">
                 <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse">
                  <i class="fa fa-minus"></i></button>
            </div>
        </div>
        
        <div class="box-body" _msthash="1196936" _msttexthash="1190501" style="text-align: left;">
            <div class="row">
                <div class="col-md-6">
                    
                    <div class="form-group">
                        <div class="row">   
                           <div class="col-md-4">
                                <label>Client Type</label><span>*</span>
                           </div>
                           <div class="col-md-8">
                                <select class="form-control" name="client_type" id="client_type">
                                    <option value="">--Select--</option>
                                    <?php foreach($client_type as $da){ ?>
                                    <option value="<?php echo $da->id ?>"><?php echo $da->client_type ?></option>
                                    <?php } ?>
                                </select>
                           </div>
                         </div>
                    </div>
                    
                    <div class="form-group">
                        <div class="row">   
                           <div class="col-md-4">
                                <label>Client Name</label><span>*</span>
                           </div>
                           <div class="col-md-8">
                                <input type="text" class="form-control" name="client_name" id="client_name">
                           </div>
                         </div>
                    </div>
                    
                    <div class="form-group">
                        <div class="row">   
                           <div class="col-md-4">
                                <label>Mobile No</label><span>*</span>
                           </div>
                           <div class="col-md-8">
                                <input type="text" class="form-control" name="mobile_no" id="mobile_no">
                           </div>
                         </div>
                    </div>
                    
                <div class="form-group">
                            <div class="row">   
                               <div class="col-md-4">
                                    <label>Other contact Details</label>
                               </div>
                               <div class="col-md-8">
                                    <input type="text" class="form-control" name="other_contact_details" id="other_contact_details">
                               </div>
                             </div>
                   </div>
                    
                <div class="form-group">
                    <div class="row">   
                       <div class="col-md-4">
                            <label>Landline no</label>
                       </div>
                       <div class="col-md-8">
                           <input type="text" class="form-control" name="landline_no" id="landline_no">
                       </div>
                     </div>
                </div>
                    
                     <div class="form-group">
                            <div class="row">   
                               <div class="col-md-4">
                                     <label>Address</label>
                               </div>
                               <div class="col-md-8">
                                   <textarea class="form-control" name="address" id="address" rows="2"></textarea>
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
                                   <input type="email" class="form-control" name="email_id" id="email_id">
                               </div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                         <div class="row">   
                               <div class="col-md-4">
                                     <label>Advisor Name</label>
                               </div>
                               <div class="col-md-8">
                                   <input type="text" class="form-control" name="cont_person_name" id="cont_person_name">
                               </div>
                        </div>
                    </div>
                    
                     <div class="form-group">
                         <div class="row">   
                               <div class="col-md-4">
                                     <label>Advisor Designation</label>
                               </div>
                               <div class="col-md-8">
                                   <input type="text" class="form-control" name="cont_person_des" id="cont_person_des">
                               </div>
                        </div>
                    </div>
                    
                     <div class="form-group">
                      <div class="row">   
                           <div class="col-md-4">
                               <label>Date of Birth</label>
                           </div>
                            <div class="col-md-8">
                                <input type="date" class="form-control" name="dob" id="dob">
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <div class="row">   
                           <div class="col-md-4">
                               <label>Age</label>
                           </div>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="age" id="age">
                            </div>
                        </div>
                    </div>
                    
                     <div class="form-group">
                         <div class="row">   
                           <div class="col-md-4">
                                <label>Area</label>
                           </div>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="area" id="area">
                            </div>
                        </div>
                    </div>
                    
                    
                    <div class="form-group">
                         <div class="row">   
                           <div class="col-md-4">
                                
                           </div>
                            <div class="col-md-8">
                              
                              <button class="btn btn-danger btn-xs pull-right hidden" id="edit_client_btn"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit Client Details</button>
                              
                              <button class="btn btn-success btn-xs pull-right hidden" id="update_client_btn"><i class="fa fa-save" aria-hidden="true"></i> Update Client</button>
                              
                            </div>
                        </div>
                    </div>
                    
                    
                </div>
                
            </div>
        </div>
    </div>
  
  
    <div class="box">
        <div class="box-header with-border" style="background:#f4f4f48c;">
            <h3 class="box-title" _msthash="26273" _msttexthash="60619" style="text-align: left;font-size:14px;"><i class="fa fa-bars" aria-hidden="true"></i> &nbsp;&nbsp;Requirement Details</h3>
            
            <div class="box-tools pull-right">
                 <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse">
                  <i class="fa fa-minus"></i></button>
            </div>
        </div>
        
        <div class="box-body" _msthash="1196936" _msttexthash="1190501" style="text-align: left;">
            <div class="row">
                <div class="col-md-6">
                    
                    <div class="form-group">
                        <div class="row">   
                           <div class="col-md-4">
                                <label>Bussiness Type</label><span>*</span>
                           </div>
                           <div class="col-md-8">
                                <select class="form-control" name="bussiness_type" id="bussiness_type">
                                    <option value="">--select--</option>
                                    <?php foreach($business as $da){?>
                                    <option value="<?php echo $da->id ?>"><?php echo $da->bussiness_type ?></option>
                                    <?php } ?>
                                </select>
                           </div>
                         </div>
                    </div>
                    
                    <div class="form-group">
                        <div class="row">   
                           <div class="col-md-4">
                                <label>Class</label><span>*</span>
                           </div>
                           <div class="col-md-8">
                                <select class="form-control" name="policy_class" id="policy_class">
                                    <option value="">--select--</option>
                                    <?php foreach($class as $da){ ?>
                                      <option value="<?php echo $da->id ?>"><?php echo $da->class ?></option>
                                    <?php } ?>
                                </select>
                           </div>
                         </div>
                    </div>
                  
                     <div class="form-group">
                        <div class="row">   
                           <div class="col-md-4">
                                <label>Policy type</label><span>*</span>
                           </div>
                           <div class="col-md-8">
                                <select class="form-control" name="policy_type" id="policy_type">
                                    <option value="">--select--</option>
                                </select>
                           </div>
                         </div>
                    </div>
                    
                <div class="form-group">
                            <div class="row">   
                               <div class="col-md-4">
                                    <label>Lead Generated Date</label><span>*</span>
                               </div>
                               <div class="col-md-8">
                                    <input type="date"  class="form-control" name="lead_generated_date" id="lead_generated_date" value="<?php echo date("Y-m-d") ?>">
                               </div>
                             </div>
                   </div>
                    
                <div class="form-group">
                    <div class="row">   
                       <div class="col-md-4">
                            <label>Due Date</label>
                       </div>
                       <div class="col-md-4">
                           <input type="date" class="form-control" name="due_date" id="due_date">
                       </div>
                       
                       <div class="col-md-4">
                           <input type="checkbox" class="form-check-input"  name="broken_policy" id="broken_policy">
                           <label> Broken Policy</label>
                       </div>
                       
                     </div>
                </div>
                    
                     <div class="form-group">
                            <div class="row">   
                               <div class="col-md-4">
                                     <label>Location</label>
                               </div>
                               <div class="col-md-8">
                                   <input type="text" class="form-control" name="location" id="location">
                               </div>
                             </div>
                     </div>
                </div>
                
                <div class="col-md-6">
                    
                     <div class="form-group">
                          <div class="row">   
                               <div class="col-md-4">
                                    <label>Classification</label>
                               </div>
                               <div class="col-md-8">
                                     <select class="form-control" name="classification" id="classification">
                                        <option value="">--select--</option>
                                        <option value="1">Hot</option>
                                        <option value="2">Warm</option>
                                        <option value="3">Cool</option>
                                    </select>
                               </div>
                        </div>
                    </div>
                    
                     <div class="form-group">
                         <div class="row">   
                               <div class="col-md-4">
                                     <label>Source</label>
                               </div>
                               <div class="col-md-8">
                                   <select class="form-control" name="source" id="source">
                                        <option value="">--select--</option>
                                   <option value="all">All</option>
                                    <option value="Website">Website</option>
                                   <option value="Social Media">Social Media</option>
                                   <option value="Adverdisment">Adverdisment</option>
                                   <option value="Agents_and_POS">Agents and POS</option>
                                   <option value="Others">Others</option>
                                        
                                    </select>
                               </div>
                        </div>
                    </div>
                    
                    
                    <div class="form-group">
                      <div class="row">   
                           <div class="col-md-4">
                               <label>Agent / Pos</label>
                           </div>
                            <div class="col-md-8">
                                <select class="form-control select2" name="agent_pos" id="agent_pos">
                                    <option value="">--select--</option>
                                    <?php foreach($agents_pos as $da){?>
                                    <option value="<?php echo $da->id ?>"><?php echo $da->name."  (".$da->email_id.")" ?></option>
                                     
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    
                     <div class="form-group">
                      <div class="row">   
                           <div class="col-md-4">
                               <label>Assign to User</label>
                           </div>
                            <div class="col-md-8">
                                <select class="form-control" name="assign_to_user" id="assign_to_user">
                                    <option value="all">All users</option>
                                    <?php foreach($users as $da){?>
                                    <option value="<?php echo $da->id ?>"><?php echo $da->username."  (".$da->email_id.")" ?></option>
                                     
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <div class="row">   
                           <div class="col-md-4">
                               <label>Remarks</label>
                           </div>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="remarks" id="remarks">
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <div class="row">   
                            <div class="col-md-12">
                                <button class="btn btn-danger btn-xs pull-right hidden" id="edit_req_btn"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit Requirement Details</button>
                                <button class="btn btn-success btn-xs pull-right hidden" id="update_req_btn"><i class="fa fa-save" aria-hidden="true"></i> Update Requirement Details</button>
                            </div>
                        </div>
                    </div>
                    
                </div>
                
            </div>
        </div>
    </div>
    
    
   
    <div class="box hidden" id="follow_up_hidden">
        <div class="box-header with-border" style="background:#f4f4f48c;">
            <h3 class="box-title" _msthash="26273" _msttexthash="60619" style="text-align: left;font-size:14px;"><i class="fa fa-phone" aria-hidden="true"></i> &nbsp;&nbsp;Add Follow up Details &nbsp;&nbsp;&nbsp;</h3>
              
              <button class="btn btn-xs btn-info" data-toggle="modal" data-target="#add_model"><i class="fa fa-plus" aria-hidden="true"></i> Add Follow Up</button>
              
            <div class="box-tools pull-right">
                 <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse">
                  <i class="fa fa-minus"></i></button>
                  
               
                
            </div>
        </div>
        
        
        
        <div class="box-body" _msthash="1196936" _msttexthash="1190501" style="text-align: left;">
            <div class="row">
                <div class="col-md-6">
                    
                    <div class="form-group">
                        <div class="row">   
                           <div class="col-md-4">
                                <label>Next Follow up date</label>
                           </div>
                           <div class="col-md-8">
                               <input type="date" class="form-control" id="next_follow_date" name="next_follow_date">
                           </div>
                         </div>
                    </div>
                    
                    <div class="form-group">
                        <div class="row">   
                           <div class="col-md-4">
                                <label>Next Follow up Time</label>
                           </div>
                           <div class="col-md-8">
                               <input type="time" class="form-control" id="next_follow_time" name="next_follow_time">
                           </div>
                         </div>
                    </div>
                    
                 <div class="form-group">
                        <div class="row">   
                           <div class="col-md-4">
                                <label>Last Follow up Date</label>
                           </div>
                           <div class="col-md-8">
                               <input type="date" class="form-control" id="last_follow_date" name="last_follow_date">
                           </div>
                         </div>
                    </div>
            </div>
            
            
             <div class="col-md-6">
                     <div class="form-group">
                          <div class="row">   
                               <div class="col-md-4">
                                    <label>Lead Status</label>
                               </div>
                               <div class="col-md-8">
                                     <select class="form-control" name="lead_status" id="lead_status">
                                        <option value="open">Open</option>
                                        <option value="follow_up">Follow up</option>
                                    </select>
                               </div>
                        </div>
                    </div>
                    
                     <div class="form-group">
                          <div class="row">   
                               <div class="col-md-4">
                                    <label>Last Status Updated Date</label>
                               </div>
                               <div class="col-md-8">
                                     <input type="date" class="form-control" name="last_status_update" id="last_status_update">
                               </div>
                        </div>
                    </div>
               
                    
                </div>
                
                
          </div>
      </div>
    </div> 
    
    <div class="box hidden" id="vechicle_hidden">
        <div class="box-header with-border" style="background:#f4f4f48c;">
            <h3 class="box-title" _msthash="26273" _msttexthash="60619" style="text-align: left;font-size:14px;"><i class="fa fa-car" aria-hidden="true"></i> &nbsp;&nbsp; Vechicle Details </h3>
            <div class="box-tools pull-right">
                 <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse">
                  <i class="fa fa-minus"></i></button>
            </div>
            
        </div>
        <div class="box-body" _msthash="1196936" _msttexthash="1190501" style="text-align: left;">
            
            <div class="row hidden" id="view_vechi_details">
                
                <div class="col-md-6">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                               <label>Make/Model/Varient</label>
                           </div>
                           <div class="col-md-8">
                               <input type="text" class="form-control" name="view_make_model" id="view_make_model" readonly>
                           </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                               <label>Engine no</label>
                           </div>
                           <div class="col-md-8">
                               <input type="text" class="form-control" name="view_engine_no" id="view_engine_no" readonly>
                           </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                               <label>Registration no</label>
                           </div>
                           <div class="col-md-8">
                               <input type="text" class="form-control" name="view_regn_no" id="view_regn_no" readonly>
                           </div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                               <label>Chassis No</label>
                           </div>
                           <div class="col-md-8">
                               <input type="text" class="form-control" name="view_chassis" id="view_chassis" readonly>
                           </div>
                        </div>
                    </div>
                    
                </div>
                
            </div>
            
           <div class="form-group">
               <button class="btn btn-info btn-xs pull-right hidden" id="edit_vechicle_btn" data-dismiss="modal" data-toggle="modal" href="#lost"><i class="fa fa-pencil" aria-hidden="true"></i> View / Edit Vechicle </button>
               <button class="btn btn-info btn-xs pull-right" id="add_vechi_btn" data-toggle="modal" data-target="#add_vechile_model"><i class="fa fa-plus" aria-hidden="true"></i> New Vechile</button>
           </div>
      </div>
    </div> 

    <div class="box hidden" id="health_hidden">
        <div class="box-header with-border" style="background:#f4f4f48c;">
            <h3 class="box-title" _msthash="26273" _msttexthash="60619" style="text-align: left;font-size:14px;"><i class="fa fa-medkit" aria-hidden="true"></i> &nbsp;&nbsp;Health Details &nbsp;&nbsp;&nbsp;</h3>
            <div class="box-tools pull-right">
                 <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse">
                  <i class="fa fa-minus"></i></button>
            </div>
        </div>
        
        <div class="box-body" _msthash="1196936" _msttexthash="1190501" style="text-align: left;">
            
            <button class="btn btn-xs btn-info pull-right" data-toggle="modal" data-target="#add_health_model"><i class="fa fa-plus" aria-hidden="true"></i> Add Health Details</button>
        </div>
    </div> 

    <div class="box hidden" id="pet_hidden">
        <div class="box-header with-border" style="background:#f4f4f48c;">
            <h3 class="box-title" _msthash="26273" _msttexthash="60619" style="text-align: left;font-size:14px;"><i class="fa fa-paw" aria-hidden="true"></i> &nbsp;&nbsp;Pet Details &nbsp;&nbsp;&nbsp;</h3>
            <div class="box-tools pull-right">
                 <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse">
                  <i class="fa fa-minus"></i></button>
            </div>
        </div>
        
        <div class="box-body" _msthash="1196936" _msttexthash="1190501" style="text-align: left;">
            
            <div class="row hidden" id="pet_div">
                <div class="col-md-6">
                    <div class="form-group">
                     <div class="row">
                        <div class="col-md-4">
                            <label>PET Name</label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="edit_pet_name" id="edit_pet_name" readonly>
                            </div>
                        </div>
                  </div>   
                    <div class="form-group">    
                         <div class="row">
                            <div class="col-md-4">
                                <label>PET Gender</label>
                                </div>
                                <div class="col-md-8">
                                   <select class="form-control" name="edit_pet_gender" id="edit_pet_gender">
                                       <option value="male">Male</option>
                                       <option value="female">Female</option>
                                   </select>
                                </div>
                        </div>
                     </div> 
                    <div class="form-group">
                         <div class="row">
                            <div class="col-md-4">
                                  <label>PET Age In Months</label>
                                </div>
                                <div class="col-md-8">
                                        <div class="input-group">
                                               <input type="text" class="form-control" style="text-align:right;" id="edit_pet_age" readonly>
                                               <span class="input-group-addon">Months</span>
                                         </div>
                                </div>
                            </div>
                     </div>
                </div>
                 <div class="col-md-6">
                   <div class="form-group">
                         <div class="row">
                            <div class="col-md-4">
                                 <label>PET Height</label>
                                </div>
                                <div class="col-md-8">
                                        <div class="input-group">
                                                <input type="text" class="form-control" style="text-align:right;" id="edit_pet_height" readonly>
                                                <span class="input-group-addon">FT</span>
                                        </div>
                                </div>
                            </div>
                      </div> 
                   <div class="form-group">
                         <div class="row">
                            <div class="col-md-4">
                                 <label>PET Weight</label>
                                </div>
                                <div class="col-md-8">
                                        <div class="input-group">
                                                <input type="text" class="form-control" style="text-align:right;" id="edit_pet_weight" readonly>
                                                <span class="input-group-addon">KG</span>
                                        </div>
                                </div>
                            </div>
                      </div> 
                </div>
            </div>
                
            <button class="btn btn-xs btn-info pull-right" id="add_pet_btn" data-toggle="modal" data-target="#add_pet_modal"><i class="fa fa-plus" aria-hidden="true"></i> Add Pet Details</button>
            <button class="btn btn-xs btn-danger pull-right hidden" id="edit_pet_btn" data-toggle="modal" data-target="#edit_pet_modal"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit Pet Details</button>
            </div>
            
           
        </div>
        
     <div class="box hidden" id="property_hidden">
        <div class="box-header with-border" style="background:#f4f4f48c;">
            <h3 class="box-title" _msthash="26273" _msttexthash="60619" style="text-align: left;font-size:14px;"><i class="fa fa-home" aria-hidden="true"></i> &nbsp;&nbsp;Property Insurace Details &nbsp;&nbsp;&nbsp;</h3>
            <div class="box-tools pull-right">
                 <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse">
                  <i class="fa fa-minus"></i></button>
            </div>
        </div>
        
        <div class="box-body" _msthash="1196936" _msttexthash="1190501" style="text-align: left;">
            
            <div class="row hidden" id="home_pro_div">
                <div class="col-md-6">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                                <label>house type</label>
                            </div>
                            <div class="col-md-8">
                                <select class="form-control" name="housing_type" id="housing_type">
                                    <option value="Home">Home</option>
                                    <option value="Housing Society">Housing Society</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                                <label>Policy Tenure</label>
                            </div>
                            <div class="col-md-8">
                                <select class="form-control" name="policy_tensure" id="policy_tensure">
                                   <?php for($i = 1;$i<=10;$i++){?>
                                     <option value="<?php echo $i ?> Year"><?php echo $i ?> Year</option>
                                   <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                                <label>Property Value</label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="property_value" id="property_value">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                                <label>Interior, Furniture & Lighting</label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="interior_furniture" id="interior_furniture">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                                <label>Tenant or Owner ?</label>
                            </div>
                            <div class="col-md-8">
                                <select class="form-control" name="tenant_or_owner" id="tenant_or_owner">
                                    <option value="Owner">Owner</option>
                                    <option value="Tenant">Tenant</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                                <label>Age of Premises</label>
                            </div>
                            <div class="col-md-8">
                                <select class="form-control" name="age_of_premises" id="age_of_premises">
                                   <?php for($i = 1;$i<=29;$i++){?>
                                     <option value="<?php echo $i ?> Year"><?php echo $i ?> Year</option>
                                   <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                                <label>Built Up Area</label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="built_up_area" id="built_up_area">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                                <label>DG set, Air Conditioner & Machinery</label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="air_conditionor_amt" id="air_conditionor_amt">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="row hidden" id="business_pro_div">
                
                <div class="col-md-6">
                     <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                                <label>Tenant or Owner</label>
                            </div>
                            <div class="col-md-8">
                                <select class="form-control" name="b_tenant_or_owner" id="b_tenant_or_owner">
                                    <option value="Owner">Owner</option>
                                    <option value="Tenant">Tenant</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                                <label>Your Proffession</label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="b_proffession" id="b_proffession">
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                                <label>Property Value</label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="b_property_value" id="b_property_value">
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                                <label>Interior, Furniture & Lighting</label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="b_interior_furniture" id="b_interior_furniture">
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                                <label>Age of Premises</label>
                            </div>
                            <div class="col-md-8">
                                <select class="form-control" name="b_age_of_premise" id="b_age_of_premise">
                                   <?php for($i = 1;$i<=29;$i++){?>
                                     <option value="<?php echo $i ?> Year"><?php echo $i ?> Year</option>
                                   <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                                <label>Built Up Area (sqt)</label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="b_built_up_area" id="b_built_up_area">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                                <label>DG set, Air Conditioner & Machinery</label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="b_air_conditionor_amt" id="b_air_conditionor_amt">
                            </div>
                        </div>
                    </div>
                </div>
                
                
            </div>
            
            
            <button class="btn btn-xs btn-info pull-right" id="add_prop_btn" data-toggle="modal" data-target="#homeModal"><i class="fa fa-plus" aria-hidden="true"></i> Add Home Insurance Details</button>
            <button class="btn btn-xs btn-info pull-right" id="business_prop_btn" data-toggle="modal" data-target="#businessmodal"><i class="fa fa-plus" aria-hidden="true"></i> Add Business Insurance Details</button>
            <button class="btn btn-xs btn-danger pull-right hidden" id="edit_home_prop_btn"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit Home Details</button>
            <button class="btn btn-xs btn-danger pull-right hidden" id="edit_business_prop_btn"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit Business Details</button>
            
            </div>
        </div>
        
      <div class="box hidden" id="maraine_box">
        <div class="box-header with-border" style="background:#f4f4f48c;">
            <h3 class="box-title" _msthash="26273" _msttexthash="60619" style="text-align: left;font-size:14px;"><i class="fa fa-ship" aria-hidden="true"></i> &nbsp;&nbsp;Maraine Insurance Details &nbsp;&nbsp;&nbsp;</h3>
            <div class="box-tools pull-right">
                 <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse">
                  <i class="fa fa-minus"></i></button>
            </div>
        </div>
        <div class="box-body" _msthash="1196936" _msttexthash="1190501" style="text-align: left;">
            
            
            <div class="row hidden" id="maraine_div">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Type of Single Transit Policy</label>
                     <select class="form-control" name="m_transit_policy" id="m_transit_policy">
                         <option value="">--select--</option>
                         <option value="Inland">Inland</option>
                         <option value="Import">Import</option>
                         <option value="Export">Export</option>
                     </select>
                </div>
                
                <div class="form-group">
                    <label>Mode of Transport</label>
                       <select class="form-control" id="m_marine_transport">
        						    <option>Air</option>
        						    <option>Road</option>
        						    <option>Rail</option>
        						    <option>Courier</option>
        			   </select>
                </div>
                
                <div class="form-group">
                    <label>Commodity</label>
                        <select class="form-control" id="m_marine_cummodity">
                            <option value="">Select Commodity</option>
                            <option value="1">Auto and spares</option>
                            <option value="2">Chemicals</option>
        				</select>
                </div>
                
                <div class="form-group">
                    <label>Invoice Value (In Rupees)</label>
                        <div class="input-group">
                            <span class="input-group-addon">₹</span>
                              <input type="number" onkeyup="marine_calculate()" class="form-control" id="m_marine_invoice_val">
                         </div>
                </div>
                
            </div>
            
            <div class="col-md-6">
                
                <div class="form-group">
                    <label>Company Name</label>
                    <input type="text" class="form-control" id="m_marine_company_name">
                </div>
                
                <div class="form-group">
                    <label>City</label>
                    <input type="text" class="form-control" id="m_marine_city_name">
                </div>
                
                 <div class="form-group">
                    <label>Sub Commodity</label>
                    <select class="form-control" id="m_marine_sub_cummodity">
                    </select>
                </div>
                
                

                  <div class="form-group">
                    <label>Sum Insured (in rupees) <span style="color:red"> * Invoice amount +10% </span></label>
                        <div class="input-group" bis_skin_checked="1">
                            <span class="input-group-addon">₹</span>
                              <input type="number" class="form-control" id="m_marine_invoice_10per_val">
                         </div>
                </div>
            
            </div>
        </div>
        
            <button class="btn btn-xs btn-info pull-right" id="add_maraine_btn" data-toggle="modal" data-target="#marainemodal"><i class="fa fa-plus" aria-hidden="true"></i> Add Maraine Details</button>
            <button class="btn btn-xs btn-danger pull-right hidden" id="edit_maraine_btn"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit Maraine Details</button>
            
        </div>
    </div>

     <div class="box hidden" id="quotation_box_hidden">
        <div class="box-header with-border" style="background:#f4f4f48c;">
            <h3 class="box-title" _msthash="26273" _msttexthash="60619" style="text-align: left;font-size:14px;"><i class="fa fa-file" aria-hidden="true"></i> &nbsp;&nbsp; Quotation Details </h3>
            <div class="box-tools pull-right">
                 <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse">
                  <i class="fa fa-minus"></i></button>
            </div>
            
        </div>
        <div class="box-body" _msthash="1196936" _msttexthash="1190501" style="text-align: left;">
            
            <div class="table table-responsive">
                <table class="table table-bordered" width="100%">
                    <thead>
                        <tr>
                            <th><input type="checkbox" class="form-check-input" id="select_all_quote"></th>
                            <th>Insurer</th>
                            <th>Total Premium</th>
                            <th>Issued Date</th>
                            <th>Issued User</th>
                            <th>Generate Quote</th>
                            <th>Email Quote</th>
                            <th>Sms Quote</th>
                        </tr>
                    </thead>
                        <tbody id="quotes_view">
                         
                        </tbody>
                </table>
            </div>
            
            
           <div class="form-group">
               <button class="btn btn-info btn-xs pull-right hidden" id="edit_vechicle_btn" data-dismiss="modal" data-toggle="modal" href="#lost"><i class="fa fa-pencil" aria-hidden="true"></i> View / Edit Vechicle </button>
               <button class="btn btn-info btn-xs pull-right" id="add_quote_btn"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;&nbsp;Add</button>
           </div>
      </div>
    </div> 
    
     <div class="box">
        <div class="box-header with-border" style="background:#f4f4f48c;">
            <h3 class="box-title" _msthash="26273" _msttexthash="60619" style="text-align: left;font-size:14px;"><i class="fa fa-bars" aria-hidden="true"></i> &nbsp;&nbsp; Recent Activities </h3>
            <div class="box-tools pull-right">
                 <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse">
                  <i class="fa fa-minus"></i></button>
            </div>
        </div>
        <div class="box-body" _msthash="1196936" _msttexthash="1190501" style="text-align: left;">
            
           <div>
                        <div class="table table-responsive">
                        <table class="table table-striped">
                                <tbody>
                                  <div id="recent_activity_div"></div>
                                </tbody>
                        </table>
                       </div>
            </div>

      </div>
    </div> 
    
    

    </section><!-- /.content -->
  </div><!-- /.content-wrapper -->
  
 <div class="modal fade in" id="add_model">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true" style="color:white;">×</span></button>
                <h4 class="modal-title text-center" style="color:white;">Add Follow Up</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                  <label>Follow up-Concluded</label> <span id="add_name_error" style="color: red;">*</span>
                  <select class="form-control" name="follow_up_concluded" id="follow_up_concluded">
                      <option value="">--Select--</option>
                      <option value="1">Yes</option>
                      <option value="0">No</option>
                  </select>
                </div>
                
                 <div class="form-group">
                  <label>Reason</label> <span id="add_name_error" style="color: red;">*</span>
                  <select class="form-control" name="follow_up_reason" id="follow_up_reason">
                      <option value="">--Select--</option>
                      <option value="Call not answered">Call not answered</option>
                      <option value="Invalid Phone number">Invalid Phone number</option>
                      <option value="New Follow up">New Follow up</option>
                      <option value="Phone Unreachable">Phone Unreachable</option>
                      <option value="Rescheduled">Rescheduled</option>
                  </select>
                </div>
                
                 <div class="form-group">
                  <label>Next Follow up date</label> <span id="add_name_error" style="color: red;">*</span>
                  <input type="Date" class="form-control" name="enter_next_follow_date" id="enter_next_follow_date">
                </div>
                
                <div class="form-group">
                  <label>Next Follow up Time</label> <span id="add_name_error" style="color: red;">*</span>
                  <input type="time" class="form-control" name="enter_next_follow_time" id="enter_next_follow_time">
                </div>
                
                 <div class="form-group">
                  <label>Comment</label> <span id="add_name_error" style="color: red;"></span>
                  <textarea class="form-control" name="follow_comment" id="follow_comment"></textarea>
                </div>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-primary"  id="add_follow_up_btn">Submit</button>
                <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
  </div>
  
 <div id="add_vechile_model" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content modal-lg-content">
      <div class="modal-header" style="background:#778d9d;">
        <button type="button" class="close" data-dismiss="modal" style="color:#fff;">&times;</button>
        
        <div class="row">
            <div class="col-md-6">
                <h4 class="modal-title" style="color:#fff;"><i class="fa fa-car" style="color:#fff;" aria-hidden="true"></i>  Create New Vechile</h4>
            </div>
              <div class="col-md-5"> 
                <button class="btn btn-success btn-sm pull-right save_model" id="add_vechile_btn"><i class="fa fa-save" aria-hidden="true"></i> Save</button> 
              </div>
          </div>
        
      </div>
      <div class="modal-body">
          
          
      <div class="box">
        <div class="box-header with-border" style="background:#f4f4f48c;">
            <h3 class="box-title" _msthash="26273" _msttexthash="60619" style="text-align: left;font-size:14px;"><i class="fa fa-bars" aria-hidden="true"></i> &nbsp;&nbsp; General Details </h3>
            <div class="box-tools pull-right">
                 <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse">
                  <i class="fa fa-minus"></i></button>
            </div>
        </div>
        <div class="box-body" _msthash="1196936" _msttexthash="1190501">
          
          <div class="row">
              
              <div class="col-md-6">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                                <label>Vechile Type</label><span>*</span>
                            </div>
                        <div class="col-md-8">
                            <select class="form-control" name="vechile_type" id="vechile_type">
                              <option value="">--Select--</option>
                              <?php foreach($policy_type as $da) {?>
                                  <option value="<?php echo $da->id ?>"><?php echo $da->policy_type  ?></option>
                             <?php } ?>
                              
                            </select>
                        </div>
                        </div>
                    </div>  
                    
                  <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                                <label>Make</label><span>*</span>
                            </div>
                        <div class="col-md-8">
                            <select class="form-control select2" name="vechi_make" id="vechi_make" style="width:100%;">
                              <option value="">--Select--</option>
                            </select>
                        </div>
                         </div>
                    </div>  
                    
                    
                    
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                                <label>Model</label><span>*</span>
                            </div>
                        <div class="col-md-8">
                            <select class="form-control select2" name="vechi_model" id="vechi_model" style="width:100%;">
                              <option value="">--Select--</option>
                            </select>
                        </div>
                       </div>
                    </div>  
                    
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                                <label>Varient</label>
                            </div>
                        <div class="col-md-8">
                            <select class="form-control select2" name="vechi_varient" id="vechi_varient" style="width:100%;">
                              <option value="">--Select--</option>
                            </select>
                        </div>
                        </div>
                    </div>  
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                                <label>CC</label>
                            </div>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="vechi_cc" id="vechi_cc">
                        </div>
                        </div>
                    </div>  
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                                <label>Year Of Manufature</label>
                            </div>
                        <div class="col-md-4">
                             <select class="form-control" name="vechi_manu_month" id="vechi_manu_month">
                                    <option value="">--Select--</option>
                                    <option value='01'>Jan</option>
                                    <option value='02'>Feb</option>
                                    <option value='03'>Mar</option>
                                    <option value='04'>Apr</option>
                                    <option value='05'>May</option>
                                    <option value='06'>Jun</option>
                                    <option value='07'>Jul</option>
                                    <option value='08'>Augt</option>
                                    <option value='09'>Sep</option>
                                    <option value='10'>Oct</option>
                                    <option value='11'>Nov</option>
                                    <option value='12'>Dec</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <select class="form-control" id="vechi_manu_year" name="vechi_manu_year">
                                <option value="">--Select--</option>
                                <?php for($i = 1900;$i<= 3050 ;$i++)
                                {?>
                                    <option value="<?php echo $i ?>"><?php echo $i ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        </div>
                    </div> 
                     <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                                <label>Seating Capacity</label>
                            </div>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="vechi_seating" id="vechi_seating">
                        </div>
                        </div>
                    </div>  
                    
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                                <label>Vechile Classfication</label>
                            </div>
                        <div class="col-md-8">
                             <select class="form-control" name="vechi_classfication" id="vechi_classfication">
                              <option value="">--Select--</option>
                              <option value="small">Small</option>
                              <option value="Hatchback">Hatchback</option>
                              <option value="Midsize">Midsize</option>
                              <option value="High End">High End</option>
                              <option value="MPV/SUV">MPV/SUV</option>
                              <option value="Commercial">Commercial</option>
                            </select>
                        </div>
                       </div>
                    </div>  
              </div>
              
              <div class="col-md-6">
                  
                  <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                                <label>Fuel Type</label>
                            </div>
                        <div class="col-md-8">
                             <select class="form-control" name="vechi_fuel_type" id="vechi_fuel_type">
                              <option value="">--Select--</option>
                              <option value="Petrol">Petrol</option>
                              <option value="Diesel">Diesel</option>
                              <option value="CNG">CNG</option>
                              <option value="LPG">LPG</option>
                              <option value="Electric">Electric</option>
                              <option value="Petrol & CNG">Petrol & CNG</option>
                              <option value="Petrol & LPG">Petrol & LPG</option>
                            </select>
                        </div>
                        </div>
                    </div>  
             
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                                <label>GVW</label>
                            </div>
                        <div class="col-md-8">
                             <input type="text" class="form-control" name="vechi_gvw" id="vechi_gvw">
                        </div>
                        </div>
                    </div>  

                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                                <label>Passenger Carrying </label>
                            </div>
                        <div class="col-md-8">
                             <input type="text" class="form-control" name="passenger_carrying" id="passenger_carrying">
                        </div>
                        </div>
                    </div>  
                    
                      <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                                <label>Engine Number </label>
                            </div>
                        <div class="col-md-8">
                             <input type="text" class="form-control" name="vechi_engine_num" id="vechi_engine_num">
                        </div>
                        </div>
                    </div>  
                    
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                                <label>Chassis Number </label><span>*</span>
                            </div>
                        <div class="col-md-8">
                             <input type="text" class="form-control" name="vechi_chassis_num" id="vechi_chassis_num">
                        </div>
                        </div>
                    </div>  
                    
                     <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                                <label>Hypothecation </label>
                            </div>
                        <div class="col-md-8">
                             <input type="text" class="form-control" name="vechi_hypothecation" id="vechi_hypothecation">
                        </div>
                        </div>
                    </div>  
                    
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                                <label>Created User </label>
                            </div>
                        <div class="col-md-8">
                             <select class="form-control" name="created_user" id="created_user">
                                    <option value="<?php echo $this->session->userdata('session_id'); ?>"><?php echo $this->session->userdata('session_name');?></option>
                            </select>
                        </div>
                        </div>
                    </div>  
                    
                     <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                                <label>Remarks </label>
                            </div>
                        <div class="col-md-8">
                             <textarea type="text" class="form-control" name="vechi_remarks" id="vechi_remarks"></textarea>
                        </div>
                        </div>
                    </div>  
              </div>
          </div>
      </div>
    </div> 
    
      <div class="box">
            <div class="box-header with-border" style="background:#f4f4f48c;">
                <h3 class="box-title" _msthash="26273" _msttexthash="60619" style="text-align: left;font-size:14px;"><i class="fa fa-bars" aria-hidden="true"></i> &nbsp;&nbsp; Registration Details </h3>
                <div class="box-tools pull-right">
                     <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse">
                      <i class="fa fa-minus"></i></button>
                </div>
            </div>
            <div class="box-body" _msthash="1196936" _msttexthash="1190501" style="text-align: left;">
                
               <div class="row">
                   <div class="col-md-6">
                       
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4">
                                    <label>Regn no</label><span> *</span>
                                </div>
                                
                                <div class="col-md-2">
                                    <input type="text" class="form-control inputs" name="regn_no_1" id="regn_no_1" maxlength="2">
                                </div>
                                <div class="col-md-2">
                                    <input type="text" class="form-control inputs" name="regn_no_2" id="regn_no_2" maxlength="2">
                                </div>
                                <div class="col-md-2">
                                    <input type="text" class="form-control inputs" name="regn_no_3" id="regn_no_3" maxlength="2">
                                </div>
                                <div class="col-md-2">
                                    <input type="text" class="form-control inputs" name="regn_no_4" id="regn_no_4" maxlength="4">
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4">
                                    <label>Regn Date</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="Date" class="form-control" name="regn_date" id="regn_date">
                                </div>
                                </div>
                        </div>
                        
                        <div class="form-group">
                          <div class="row">
                            <div class="col-md-4">
                                <label>RTO</label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="rto" id="rto">
                            </div>
                            </div>
                        </div>
                        
                         <div class="form-group">
                          <div class="row">
                            <div class="col-md-4">
                                <label>Zone</label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="zone" id="zone">
                            </div>
                            </div>
                        </div>
                </div>
                <div class="col-md-6">
                     <div class="form-group">
                    <div class="row">
                        <div class="col-md-4">
                            <label>Regn Address</label>
                        </div>
                        <div class="col-md-8">
                            <textarea class="form-control" name="regn_address" id="regn_address"></textarea>
                        </div>
                    </div>
                    </div>
                    
                    <div class="form-group">
                      <div class="row">
                        <div class="col-md-4">
                            <label>State</label>
                        </div>
                        <div class="col-md-8">
                            <select class="form-control select2" name="state" id="state" style="width:100%;">
                            <option value="">--select--</option>
                            <option value="Tamil Nadu">Tamil Nadu</option>
                            <option value="Andhra Pradesh">Andhra Pradesh</option>
                            <option value="Andaman and Nicobar Islands">Andaman and Nicobar Islands</option>
                            <option value="Arunachal Pradesh">Arunachal Pradesh</option>
                            <option value="Assam">Assam</option>
                            <option value="Bihar">Bihar</option>
                            <option value="Chandigarh">Chandigarh</option>
                            <option value="Chhattisgarh">Chhattisgarh</option>
                            <option value="Dadar and Nagar Haveli">Dadar and Nagar Haveli</option>
                            <option value="Daman and Diu">Daman and Diu</option>
                            <option value="Delhi">Delhi</option>
                            <option value="Lakshadweep">Lakshadweep</option>
                            <option value="Puducherry">Puducherry</option>
                            <option value="Goa">Goa</option>
                            <option value="Gujarat">Gujarat</option>
                            <option value="Haryana">Haryana</option>
                            <option value="Himachal Pradesh">Himachal Pradesh</option>
                            <option value="Jammu and Kashmir">Jammu and Kashmir</option>
                            <option value="Jharkhand">Jharkhand</option>
                            <option value="Karnataka">Karnataka</option>
                            <option value="Kerala">Kerala</option>
                            <option value="Madhya Pradesh">Madhya Pradesh</option>
                            <option value="Maharashtra">Maharashtra</option>
                            <option value="Manipur">Manipur</option>
                            <option value="Meghalaya">Meghalaya</option>
                            <option value="Mizoram">Mizoram</option>
                            <option value="Nagaland">Nagaland</option>
                            <option value="Odisha">Odisha</option>
                            <option value="Punjab">Punjab</option>
                            <option value="Rajasthan">Rajasthan</option>
                            <option value="Sikkim">Sikkim</option>
                            <option value="Telangana">Telangana</option>
                            <option value="Tripura">Tripura</option>
                            <option value="Uttar Pradesh">Uttar Pradesh</option>
                            <option value="Uttarakhand">Uttarakhand</option>
                            <option value="West Bengal">West Bengal</option>
                            </select>
                        </div>
                    </div>
                </div>
                
                
                 <div class="form-group">
                    <div class="row">
                        <div class="col-md-4">
                            <label>City</label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="city" id="city">
                        </div>
                    </div>
                    </div>
                    
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-4">
                            <label>Pincode</label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="pincode" id="pincode">
                        </div>
                    </div>
                </div>
                </div>
              </div>
          </div>
        </div> 

      <div class="box">
        <div class="box-header with-border" style="background:#f4f4f48c;">
            <h3 class="box-title" _msthash="26273" _msttexthash="60619" style="text-align: left;font-size:14px;"><i class="fa fa-bars" aria-hidden="true"></i> &nbsp;&nbsp; Personal Details </h3>
            <div class="box-tools pull-right">
                 <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse">
                  <i class="fa fa-minus"></i></button>
            </div>
        </div>
        <div class="box-body" _msthash="1196936" _msttexthash="1190501" >
           <div class="form-group">
               
               <div class="row">
                   <div class="col-md-6">
                       <div class="form-group">
                           <div class="row">
                               <div class="col-md-4">
                                   <label>Vechicle Username</label>
                               </div>
                               <div class="col-md-8">
                                   <input type="text" class="form-control" name="vechi_user_name" id="vechi_user_name">
                               </div>
                           </div>
                       </div>
                   </div>
                   <div class="col-md-6">
                       <div class="form-group">
                           <div class="row">
                               <div class="col-md-4">
                                   <label>Vechicle User Contact Details</label>
                               </div>
                               <div class="col-md-8">
                                   <input type="text" class="form-control" name="vechi_user_cont" id="vechi_user_cont">
                               </div>
                           </div>
                       </div>
                   </div>
                   
               </div>
           </div>
      </div>
    </div> 
    
       <div class="box">
        <div class="box-header with-border" style="background:#f4f4f48c;">
            <h3 class="box-title" _msthash="26273" _msttexthash="60619" style="text-align: left;font-size:14px;"><i class="fa fa-upload" aria-hidden="true"></i> &nbsp;&nbsp; Upload Documents </h3>
            <div class="box-tools pull-right">
                 <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse">
                  <i class="fa fa-minus"></i></button>
            </div>
        </div>
        <div class="box-body" _msthash="1196936" _msttexthash="1190501" >
            
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>File type</th>
                        <th>File name</th>
                        <th>Document Type</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody id="table_view">
                </tbody>
            </table>
            <br>
            <div class="row">
                <div class="col-md-6">
                    <label>Document type</label>
                    <div class="form-group">
                          <select class="form-control" name='document_type' id='document_type'>
                                <option value=''>--Select--</option>
                                <option value='RC Book'>RC Book</option>
                                <option value='Other'>Other</option>
                                </option>
                          </select>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <label>Upload Document</label>
                    <div class="form-group">
                          <input type="file" class="form-control" id="document_file">
                    </div>
                </div>
            </div>
    </div> 
    

     </div>
    </div>

  </div>
</div>
</div>

 <div class="modal fade in" id="add_health_model">
    <div class="modal-dialog">
        <div class="modal-content modal-lg-content">
            <div class="modal-header bg-primary">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true" style="color:white;">×</span></button>
                <h4 class="modal-title text-center" style="color:white;">Add Health Details</h4>
            </div>
            <div class="modal-body">
                
              <input type="text" class="hidden" id="created_id" value="<?php echo $this->session->userdata('session_id'); ?>">  
                
                <div class="form-group">
                    <label>Gender</label><span id="add_name_error" style="color: red;">*</span>
                    <select class="form-control" name="h_gender" id="h_gender">
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                </div>
                
                 <div class="form-group">
                    <label>Select members you want to insure </label><span id="add_name_error" style="color: red;">*</span>
                        <select placeholder="--Select--" class="form-control select2" multiple="multiple" name="h_family_members" id="h_family_members" style="width:100%;">
                            <option value="You">You</option>
                            <option value="Wife">Wife</option>
                            <option value="Daughter">Daughter</option>
                            <option value="Son">Son</option>
                            <option value="Father">Father</option>
                            <option value="Mother">Mother</option>
                        </select>
                </div>
                    
                <div class="form-group">
                    <div class="row" id="row_id">
                        
                        <div class="col-md-6">
                            <label>No of Daughter's</label>
                            <input type="text" class="form-control" name="num_daughters" id="num_daughters">
                        </div>
                        
                         <div class="col-md-6">
                            <label>No of Sons's</label>
                            <input type="text" class="form-control" name="num_sons" id="num_sons">
                        </div>
                        
                    </div>
                </div>
                
                <div id="you_div" class="hidden">
                  <div class='row'>
                    <div class='col-md-6'>      
                      <label>You</label>
                    </div>
                    <div class='col-md-6'> 
                        <select class='form-control' name='you_age' id='you_age'>
                        <option value=''>Age</option>
                        <?php for($i = 18; $i <= 100; $i++){ ?>
			                <option value="<?php echo $i; ?>"><?php echo $i; ?> Years</option>
			              <?php } ?>
                        </select>
                    </div>
                </div>
              </div>
              
              <p></p>
                
            <div id="husband_wife_div" class="hidden">
                    <div class='row'>
                        <div class='col-md-6'>     
                           <label id="label_id">Wife</label>
                        </div> 
                        <div class='col-md-6'> 
                            <select class='form-control' name='hus_wife_age' id='hus_wife_age'>
                            <option value=''>Age</option>
                             <?php for($i = 18; $i <= 100; $i++){ ?>
			                <option value="<?php echo $i; ?>"><?php echo $i; ?> Years</option>
			                <?php } ?>
                            </select> 
                        </div> 
                     </div>
                </div>
                <p></p>
                
             <div id="daughter_div1" class="hidden">
                  <div class="row">
                      <div class='col-md-6'>      
                        <label>Daughter 1</label>
                    </div> 
                    <div class='col-md-6'>
                        <select class='form-control' name='daughter_age_1' id='daughter_age_1'>
                        <option value=''>Age</option>
                         <?php for($i = 1; $i <= 11; $i++){ ?>
		                <option value="<?php echo $i; ?>"><?php echo $i; ?> Months</option>
		                <?php } ?>
		                <?php for($i = 1; $i <= 30; $i++){ ?>
		                <option value="<?php echo $i*12; ?>"><?php echo $i; ?> Years</option>
		                <?php } ?>
                        </select> 
                    </div> 
                </div>
              </div> 
             <p></p>
              <div id="daughter_div2" class="hidden">
                  <div class="row">
                      <div class='col-md-6'>      
                        <label>Daughter 2</label>
                    </div> 
                    <div class='col-md-6'>
                        <select class='form-control' name='daughter_age_2' id='daughter_age_2'>
                        <option value=''>Age</option>
                         <?php for($i = 1; $i <= 11; $i++){ ?>
		                <option value="<?php echo $i; ?>"><?php echo $i; ?> Months</option>
		                <?php } ?>
		                <?php for($i = 1; $i <= 30; $i++){ ?>
		                <option value="<?php echo $i*12; ?>"><?php echo $i; ?> Years</option>
		                <?php } ?>
                        </select> 
                    </div> 
                </div>
              </div> 
              <p></p>
              <div id="daughter_div3" class="hidden">
                  <div class="row">
                      <div class='col-md-6'>      
                        <label>Daughter 3</label>
                    </div> 
                    <div class='col-md-6'>
                        <select class='form-control' name='daughter_age_3' id='daughter_age_3'>
                        <option value=''>Age</option>
                         <?php for($i = 1; $i <= 11; $i++){ ?>
		                <option value="<?php echo $i; ?>"><?php echo $i; ?> Months</option>
		                <?php } ?>
		                <?php for($i = 1; $i <= 30; $i++){ ?>
		                <option value="<?php echo $i*12; ?>"><?php echo $i; ?> Years</option>
		                <?php } ?>
                        </select> 
                    </div> 
                </div>
              </div> 
              <p></p>
              <div id="daughter_div4" class="hidden">
                  <div class="row">
                      <div class='col-md-6'>      
                        <label>Daughter 4</label>
                    </div> 
                    <div class='col-md-6'>
                        <select class='form-control' name='daughter_age_4' id='daughter_age_4'>
                        <option value=''>Age</option>
                        <?php for($i = 1; $i <= 11; $i++){ ?>
		                <option value="<?php echo $i; ?>"><?php echo $i; ?> Months</option>
		                <?php } ?>
		                <?php for($i = 1; $i <= 30; $i++){ ?>
		                <option value="<?php echo $i*12; ?>"><?php echo $i; ?> Years</option>
		                <?php } ?>
                        </select> 
                    </div> 
                </div>
              </div>
              <p></p>
              <div id="son_div1" class="hidden">
                    <div class="row">
                      <div class='col-md-6'>      
                        <label>Son 1</label>
                    </div> 
                    <div class='col-md-6'>
                        <select class='form-control' name='son_age_1' id='son_age_1'>
                        <option value=''>Age</option>
                        <?php for($i = 1; $i <= 11; $i++){ ?>
		                <option value="<?php echo $i; ?>"><?php echo $i; ?> Months</option>
		                <?php } ?>
		                <?php for($i = 1; $i <= 30; $i++){ ?>
		                <option value="<?php echo $i*12; ?>"><?php echo $i; ?> Years</option>
		                <?php } ?>
                        </select> 
                    </div> 
                </div>
                </div>
              <p></p>
              <div id="son_div2" class="hidden">
                    <div class="row">
                      <div class='col-md-6'>      
                        <label>Son 2</label>
                    </div> 
                    <div class='col-md-6'>
                        <select class='form-control' name='son_age_2' id='son_age_2'>
                        <option value=''>Age</option>
                         <?php for($i = 1; $i <= 11; $i++){ ?>
		                <option value="<?php echo $i; ?>"><?php echo $i; ?> Months</option>
		                <?php } ?>
		                <?php for($i = 1; $i <= 30; $i++){ ?>
		                <option value="<?php echo $i*12; ?>"><?php echo $i; ?> Years</option>
		                <?php } ?>
                        </select> 
                    </div> 
                </div>
                </div>
              <p></p>
              <div id="son_div3" class="hidden">
                    <div class="row">
                      <div class='col-md-6'>      
                        <label>Son 3</label>
                    </div> 
                    <div class='col-md-6'>
                        <select class='form-control' name='son_age_3' id='son_age_3'>
                        <option value=''>Age</option>
                         <?php for($i = 1; $i <= 11; $i++){ ?>
		                <option value="<?php echo $i; ?>"><?php echo $i; ?> Months</option>
		                <?php } ?>
		                <?php for($i = 1; $i <= 30; $i++){ ?>
		                <option value="<?php echo $i*12; ?>"><?php echo $i; ?> Years</option>
		                <?php } ?>
                        </select> 
                    </div> 
                </div>
              </div>
              <p></p>
              <div id="son_div4" class="hidden">
                    <div class="row">
                      <div class='col-md-6'>      
                        <label>Son 4</label>
                    </div> 
                    <div class='col-md-6'>
                        <select class='form-control' name='son_age_4' id='son_age_4'>
                        <option value=''>Age</option>
                         <?php for($i = 1; $i <= 11; $i++){ ?>
		                <option value="<?php echo $i; ?>"><?php echo $i; ?> Months</option>
		                <?php } ?>
		                <?php for($i = 1; $i <= 30; $i++){ ?>
		                <option value="<?php echo $i*12; ?>"><?php echo $i; ?> Years</option>
		                <?php } ?>
                        </select> 
                    </div> 
                </div>
              </div>
              <p></p> 
                
                 <div class='row hidden'  id="father_div">
						<div class='col-md-6'>      
						<label>Father</label>
                    </div> 
                    <div class='col-md-6'> 
						<select class='form-control' name='father_age' id='father_age'>
						<option value=''>Age</option> 
						<?php for($i = 18; $i <= 100; $i++){ ?>
    	                <option value="<?php echo $i; ?>"><?php echo $i; ?> Years</option>
    	                <?php } ?>
						</select> 
                    </div> 
                    </div>
                 <p></p>
                 <div class='row hidden' id="mother_div">
                    <div class='col-md-6'>      
							<label>Mother</label>
                    </div> 
                    <div class='col-md-6'> 
						<select class='form-control' name='mother_age' id='mother_age'>
						<option value=''>Age</option> 
						<?php for($i = 18; $i <= 100; $i++){ ?>
    	                <option value="<?php echo $i; ?>"><?php echo $i; ?> Years</option>
    	                <?php } ?>
                    </select> 
                     </div> 
                    </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-primary"  id="add_health_btn">Submit</button>
                <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
  </div>
  </div>
  
 <div id="add_pet_modal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Pet Details</h4>
      </div>
      <div class="modal-body">
          
        <center style="margin-bottom:10px;">
		   <input type="button" class="btn btn-light change_pet_gender" id="pet_male_btn" style="border: none;" value="Male">
		   <input type="button" id="pet_female_btn" class="btn btn-light" style="border: none;" value="Female"></center>
    	   
    	    <div class="row">
    	        <div class="col-md-6">
    	            
    	           <div class="form-group">
                         <label>PET Name</label>
    			        <input type="text" class="form-control" id="pet_name">
    		        </div> 
    	            
                  <div class="form-group">
                      <label>PET Weight In KG</label><span>*</span>
                       <div class="input-group">
                        <input type="text" class="form-control" style="text-align:right;" id="pet_weight">
                        <span class="input-group-addon">KG</span>
                     </div>
                  </div> 
                  
                </div>

    	        <div class="col-md-6">
    	            
    	             <div class="form-group"> 
                     <label>PET Age In Months</label><span>*</span>
                    <div class="input-group">
                               <input type="text" class="form-control" style="text-align:right;" id="pet_age">
                               <span class="input-group-addon">Months</span>
                         </div>
                    </div>
                    
    		        <div class="form-group">
    		            <label>PET Height</label><span>*</span>
        		          <div class="input-group">
                            <input type="text" class="form-control" style="text-align:right;" id="pet_height">
                            <span class="input-group-addon">FT</span>
                         </div>
    		        </div>
    		        
    	        </div>
    	    </div>
      </div>
      <div class="modal-footer">
         <button type="button" class="btn btn-primary" id="pet_submit">Submit</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

 <!--property -->
 
 <div id="homeModal" class="modal fade" role="dialog">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header mob_pad_top_bot_5px">
                <center><h4 class="modal-title">Best Home Insurance</h4></center>
                <button type="button" class="close" style="background-color: #fff;margin-top: -25px;" data-dismiss="modal">&times;</button>
              </div>
              
              <div class="modal-body">
                  
                    <div class="row">
                              <div class="col-md-6">
                                <label>What is your house type?</label><br>
            			        <input type="button"  class="btn btn-light change_house_type" id="home_btn" style="border: none;" value="Home">
            			        &nbsp;<input type="button" id="housing_society_btn"  class="btn btn-light" style="border: none;" value="Housing Society">
                            </div> 
        
                         
                            <div class="col-md-6">
                                <label>Are you a tenant or Owner?</label><br>
            			        <input type="button"  class="btn btn-light change_owner" id="owner_btn" style="border: none;" value="Owner">
            			        &nbsp;<input type="button"  id="tenant_btn" class="btn btn-light" style="border: none;" value="Tenant">
                            </div>
            </div> 
                    
                    <div class="row">
                            <div class="col-md-6">
                                
                                 <div class="form-group">
                                        <label>Select Policy Tenure</label>
                						<select class="form-control" id="home_policy_tenure">
                						    <option>1 Year</option>
                						    <option>2 Year</option>
                						    <option>3 Year</option>
                						    <option>4 Year</option>
                						    <option>5 Year</option>
                						    <option>6 Year</option>
                						    <option>7 Year</option>
                						    <option>8 Year</option>
                						    <option>9 Year</option>
                						    <option>10 Year</option>
                						</select>
                					</div>
                			
                            	  <div class="form-group">
                    				         <label>Property Value</label>  
                                                <div class="input-group">
                                                    <div class="input-group-addon">₹ </div>
                                                    <input type="number" class="form-control" id="home_property_value">
                            					</div>
                    				 </div>
                    				 
                    			 <div class="form-group">
                                            <label>Interior, Furniture & Lighting</label>
                                            <div class="input-group">
                                                <div class="input-group-addon">
                                                    ₹ 
                                                </div>
                                                <input type="number"  class="form-control" id="home_infuli">
                    					    </div>
                                       </div>
                                       
             </div>
                                    
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Age of Premises</label>
                    				<select class="form-control" id="home_age_premises">
                    				    <option>1 Year</option>
                    				    <option>2 Year</option>
                    				    <option>3 Year</option>
                    				    <option>4 Year</option>
                    				    <option>5 Year</option>
                    				    <option>6 Year</option>
                    				    <option>7 Year</option>
                    				    <option>8 Year</option>
                    				    <option>9 Year</option>
                    				    <option>10 Year</option>
                    				    <option>11 Year</option>
                    				    <option>12 Year</option>
                    				    <option>13 Year</option>
                    				    <option>14 Year</option>
                    				    <option>15 Year</option>
                    				    <option>16 Year</option>
                    				    <option>17 Year</option>
                    				    <option>18 Year</option>
                    				    <option>19 Year</option>
                    				    <option>20 Year</option>
                    				    <option>21 Year</option>
                    				    <option>22 Year</option>
                    				    <option>23 Year</option>
                    				    <option>24 Year</option>
                    				    <option>25 Year</option>
                    				    <option>26 Year</option>
                    				    <option>27 Year</option>
                    				    <option>28 Year</option>
                    				    <option>29 Year</option>
                    				</select>
                			    </div>
                				
                                 <div class="form-group">
                                            <label>Built Up Area</label>
                                            <div class="input-group">
                        						<input type="number" class="form-control" id="home_sqft">
                        						<div class="input-group-addon">
                                                  Sq Ft
                                                </div>
                        					</div>
                                  </div>
                                 
                                <div class="form-group">
                                            <label>DG set, Air Conditioner & Machinery</label>
                                             <div class="input-group">
                                                 <div class="input-group-addon">
                                                    ₹ 
                                                </div>
                                                <input type="number"  class="form-control" id="home_dgairmac">
                                            </div>
                                </div>
            </div>
                    </div>
                    
              </div>
              
             <div class="modal-footer">
                 <button type="button" class="btn btn-primary" id="add_pro_btn">Submit</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              </div>
              
            </div>
          </div>
        </div>
        
 <div id="businessmodal" class="modal fade" role="dialog">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header mob_pad_top_bot_5px">
                <center><h4 class="modal-title">Best Business Insurance</h4></center>
                <button type="button" class="close" style="background-color: #fff;margin-top: -25px;" data-dismiss="modal">&times;</button>
              </div>
              
              <div class="modal-body">
                  
                    <div class="row">
                            <div class="col-md-6">
                                <label>Are you a tenant or Owner?</label><br>
            			        <input type="button"  class="btn btn-light business_change_owner" id="business_owner_btn" style="border: none;" value="Owner">
            			        &nbsp;<input type="button"  id="business_tenant_btn" class="btn btn-light" style="border: none;" value="Tenant">
                            </div>
                    </div> 
                    
                    <div class="row">
                        
                            <div class="col-md-6">
                                 <div class="form-group">
                                        <label>Your Proffession</label>
                						<input type="text" class="form-control" id="business_profession">
                					</div>
                			
                            	  <div class="form-group">
                    				         <label>Property Value</label>  
                                                <div class="input-group">
                                                    <div class="input-group-addon">₹ </div>
                                                    <input type="number" class="form-control" id="business_property_value">
                            					</div>
                    				 </div>
                    				 
                    			 <div class="form-group">
                                            <label>Interior, Furniture & Lighting</label>
                                            <div class="input-group">
                                                <div class="input-group-addon">
                                                    ₹ 
                                                </div>
                                                <input type="number"  class="form-control" id="business_infuli">
                    					    </div>
                                       </div>
                           </div>
                                    
                            <div class="col-md-6">
                                
                                <div class="form-group">
                                    <label>Age of Premises</label>
                    				<select class="form-control" id="business_age_premises">
                    				    <option>1 Year</option>
                    				    <option>2 Year</option>
                    				    <option>3 Year</option>
                    				    <option>4 Year</option>
                    				    <option>5 Year</option>
                    				    <option>6 Year</option>
                    				    <option>7 Year</option>
                    				    <option>8 Year</option>
                    				    <option>9 Year</option>
                    				    <option>10 Year</option>
                    				    <option>11 Year</option>
                    				    <option>12 Year</option>
                    				    <option>13 Year</option>
                    				    <option>14 Year</option>
                    				    <option>15 Year</option>
                    				    <option>16 Year</option>
                    				    <option>17 Year</option>
                    				    <option>18 Year</option>
                    				    <option>19 Year</option>
                    				    <option>20 Year</option>
                    				    <option>21 Year</option>
                    				    <option>22 Year</option>
                    				    <option>23 Year</option>
                    				    <option>24 Year</option>
                    				    <option>25 Year</option>
                    				    <option>26 Year</option>
                    				    <option>27 Year</option>
                    				    <option>28 Year</option>
                    				    <option>29 Year</option>
                    				</select>
                			    </div>
                				
                                 <div class="form-group">
                                            <label>Built Up Area</label>
                                            <div class="input-group">
                        						<input type="number" class="form-control" id="business_sqft">
                        						<div class="input-group-addon">
                                                  Sq Ft
                                                </div>
                        					</div>
                                  </div>
                                 
                                 <div class="form-group">
                                            <label>DG set, Air Conditioner & Machinery</label>
                                             <div class="input-group">
                                                 <div class="input-group-addon">
                                                    ₹ 
                                                </div>
                                                <input type="number"  class="form-control" id="business_dgairmac">
                                            </div>
                                </div>
                         </div>
                    </div>
              </div>
              
             <div class="modal-footer">
                 <button type="button" class="btn btn-primary" id="add_business_btn">Submit</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
             </div>
             
            </div>
          </div>
        </div>
        
        
 <!-- Modal -->
<div id="marainemodal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title text-center">Maraine Insurance Details</h4>
      </div>
      <div class="modal-body">
        
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Type of Single Transit Policy</label>
                     <select class="form-control" name="transit_policy" id="transit_policy">
                         <option value="">--select--</option>
                         <option value="Inland">Inland</option>
                         <option value="Import">Import</option>
                         <option value="Export">Export</option>
                     </select>
                </div>
                
                <div class="form-group">
                    <label>Mode of Transport</label>
                       <select class="form-control" id="marine_transport">
        						    <option>Air</option>
        						    <option>Road</option>
        						    <option>Rail</option>
        						    <option>Courier</option>
        			   </select>
                </div>
                
                <div class="form-group">
                    <label>Commodity</label>
                        <select class="form-control" id="marine_cummodity">
                            <option value="">Select Commodity</option>
                            <option value="1">Auto and spares</option>
                            <option value="2">Chemicals</option>
        				</select>
                </div>
                
              
                
                 <div class="form-group">
                    <label>Invoice Value (In Rupees)</label>
                        <div class="input-group" bis_skin_checked="1">
                            <span class="input-group-addon">₹</span>
                              <input type="number" onkeyup="marine_calculate()" class="form-control" id="marine_invoice_val">
                         </div>
                </div>
                
            </div>
            
            <div class="col-md-6">
                
                <div class="form-group">
                    <label>Company Name</label>
                    <input type="text" class="form-control" id="marine_company_name">
                </div>
                
                <div class="form-group">
                    <label>City</label>
                    <input type="text" class="form-control" id="marine_city_name">
                </div>
                
                  <div class="form-group">
                    <label>Sub Commodity</label>
                    <select class="form-control" id="marine_sub_cummodity">
                    </select>
                </div>
                
                 <div class="form-group">
                    <label>Sum Insured (in Rs) <span style="color:red"> * Invoice amt +10% </span></label>
                        <div class="input-group" bis_skin_checked="1">
                            <span class="input-group-addon">₹</span>
                              <input type="number" class="form-control" id="marine_invoice_10per_val">
                         </div>
                </div>
                
            </div>
        </div>
        
      

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="marine_submit">Submit</button>  
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
        
 <!--property -->

 <div id="edit_vechile_model" class="modal fade" role="dialog" >
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content modal-lg-content">
      <div class="modal-header" style="background:#778d9d;">
        <button type="button" class="close" data-dismiss="modal" style="color:#fff;">&times;</button>
        
        <div class="row">
            <div class="col-md-6">
                <h4 class="modal-title" style="color:#fff;"><i class="fa fa-car" style="color:#fff;" aria-hidden="true"></i> &nbsp;Edit Vechile Details</h4>
            </div>
              <div class="col-md-5"> 
                <button class="btn btn-success btn-sm pull-right save_model" id="update_vechile_btn"><i class="fa fa-save" aria-hidden="true"></i> Update</button> 
              </div>
          </div>
        
      </div>
      <div class="modal-body">
          
          
      <div class="box">
        <div class="box-header with-border" style="background:#f4f4f48c;">
            <h3 class="box-title" _msthash="26273" _msttexthash="60619" style="text-align: left;font-size:14px;"><i class="fa fa-bars" aria-hidden="true"></i> &nbsp;&nbsp; General Details </h3>
            <div class="box-tools pull-right">
                 <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse">
                  <i class="fa fa-minus"></i></button>
            </div>
        </div>
        <div class="box-body" _msthash="1196936" _msttexthash="1190501">
          
          <div class="row">
              <input type="hidden" id="edit_vechicle_id">
              
              <div class="col-md-6">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                                <label>Vechile Type</label><span>*</span>
                            </div>
                        <div class="col-md-8">
                            <select class="form-control" name="edit_vechile_type" id="edit_vechile_type">
                              <option value="">--Select--</option>
                              <?php foreach($class as $da) {?>
                                  <option value="<?php echo $da->id ?>"><?php echo $da->class  ?></option>
                             <?php } ?>
                              
                            </select>
                        </div>
                        </div>
                    </div>  
                    
                  <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                                <label>Make</label><span>*</span>
                            </div>
                        <div class="col-md-8">
                            <select class="form-control select2" name="edit_vechi_make" id="edit_vechi_make" style="width:100%;">
                              <option value="">--Select--</option>
                            </select>
                        </div>
                         </div>
                    </div>  
                    
                    
                    
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                                <label>Model</label><span>*</span>
                            </div>
                        <div class="col-md-8">
                            <select class="form-control select2" name="edit_vechi_model" id="edit_vechi_model" style="width:100%;">
                              <option value="">--Select--</option>
                            </select>
                        </div>
                       </div>
                    </div>  
                    
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                                <label>Varient</label>
                            </div>
                        <div class="col-md-8">
                            <select class="form-control select2" name="edit_vechi_varient" id="edit_vechi_varient" style="width:100%;">
                              <option value="">--Select--</option>
                            </select>
                        </div>
                        </div>
                    </div>  
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                                <label>CC</label>
                            </div>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="edit_vechi_cc" id="edit_vechi_cc">
                        </div>
                        </div>
                    </div>  
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                                <label>Year Of Manufature</label>
                            </div>
                        <div class="col-md-4">
                             <select class="form-control" name="edit_vechi_manu_month" id="edit_vechi_manu_month">
                                    <option value="">--Select--</option>
                                    <option value='01'>Jan</option>
                                    <option value='02'>Feb</option>
                                    <option value='03'>Mar</option>
                                    <option value='04'>Apr</option>
                                    <option value='05'>May</option>
                                    <option value='06'>Jun</option>
                                    <option value='07'>Jul</option>
                                    <option value='08'>Augt</option>
                                    <option value='09'>Sep</option>
                                    <option value='10'>Oct</option>
                                    <option value='11'>Nov</option>
                                    <option value='12'>Dec</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                              <input type="text" class="form-control" name="edit_vechi_manu_year" id="edit_vechi_manu_year" placeholder="Manufacture Year">
                        </div>
                        </div>
                    </div> 
                     <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                                <label>Seating Capacity</label>
                            </div>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="edit_vechi_seating" id="edit_vechi_seating">
                        </div>
                        </div>
                    </div>  
                    
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                                <label>Vechile Classfication</label>
                            </div>
                        <div class="col-md-8">
                             <select class="form-control" name="edit_vechi_classfication" id="edit_vechi_classfication">
                              <option value="">--Select--</option>
                              <option value="small">Small</option>
                              <option value="Hatchback">Hatchback</option>
                              <option value="Midsize">Midsize</option>
                              <option value="High End">High End</option>
                              <option value="MPV/SUV">MPV/SUV</option>
                              <option value="Commercial">Commercial</option>
                            </select>
                        </div>
                       </div>
                    </div>  
              </div>
              
              <div class="col-md-6">
                  
                  <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                                <label>Fuel Type</label>
                            </div>
                        <div class="col-md-8">
                             <select class="form-control" name="edit_vechi_fuel_type" id="edit_vechi_fuel_type">
                              <option value="">--Select--</option>
                              <option value="Petrol">Petrol</option>
                              <option value="Diesel">Diesel</option>
                              <option value="CNG">CNG</option>
                              <option value="LPG">LPG</option>
                              <option value="Electric">Electric</option>
                              <option value="Petrol & CNG">Petrol & CNG</option>
                              <option value="Petrol & LPG">Petrol & LPG</option>
                            </select>
                        </div>
                        </div>
                    </div>  
             
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                                <label>GVW</label>
                            </div>
                        <div class="col-md-8">
                             <input type="text" class="form-control" name="edit_vechi_gvw" id="edit_vechi_gvw">
                        </div>
                        </div>
                    </div>  

                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                                <label>Passenger Carrying </label>
                            </div>
                        <div class="col-md-8">
                             <input type="text" class="form-control" name="edit_passenger_carrying" id="edit_passenger_carrying">
                        </div>
                        </div>
                    </div>  
                    
                      <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                                <label>Engine Number </label>
                            </div>
                        <div class="col-md-8">
                             <input type="text" class="form-control" name="edit_vechi_engine_num" id="edit_vechi_engine_num">
                        </div>
                        </div>
                    </div>  
                    
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                                <label>Chassis Number </label><span>*</span>
                            </div>
                        <div class="col-md-8">
                             <input type="text" class="form-control" name="edit_vechi_chassis_num" id="edit_vechi_chassis_num">
                        </div>
                        </div>
                    </div>  
                    
                     <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                                <label>Hypothecation </label>
                            </div>
                        <div class="col-md-8">
                             <input type="text" class="form-control" name="edit_vechi_hypothecation" id="edit_vechi_hypothecation">
                        </div>
                        </div>
                    </div>  
                    
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                                <label>Agency/Pos </label>
                            </div>
                        <div class="col-md-8">
                             <select class="form-control" name="edit_created_user" id="edit_created_user">
                                    <option value="<?php echo $this->session->userdata('session_id'); ?>"><?php echo $this->session->userdata('session_name');?></option>
                            </select>
                        </div>
                        </div>
                    </div>  
                    
                     <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                                <label>Remarks </label>
                            </div>
                        <div class="col-md-8">
                             <textarea type="text" class="form-control" name="edit_vechi_remarks" id="edit_vechi_remarks"></textarea>
                        </div>
                        </div>
                    </div>  
              </div>
          </div>
      </div>
    </div> 
    
      <div class="box">
            <div class="box-header with-border" style="background:#f4f4f48c;">
                <h3 class="box-title" _msthash="26273" _msttexthash="60619" style="text-align: left;font-size:14px;"><i class="fa fa-bars" aria-hidden="true"></i> &nbsp;&nbsp; Registration Details </h3>
                <div class="box-tools pull-right">
                     <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse">
                      <i class="fa fa-minus"></i></button>
                </div>
            </div>
            <div class="box-body" _msthash="1196936" _msttexthash="1190501" style="text-align: left;">
                
               <div class="row">
                   <div class="col-md-6">
                       
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4">
                                    <label>Regn no</label><span> *</span>
                                </div>
                                
                                <div class="col-md-2">
                                    <input type="text" class="form-control" name="edit_regn_no_1" id="edit_regn_no_1">
                                </div>
                                <div class="col-md-2">
                                    <input type="text" class="form-control" name="edit_regn_no_2" id="edit_regn_no_2">
                                </div>
                                <div class="col-md-2">
                                    <input type="text" class="form-control" name="edit_regn_no_3" id="edit_regn_no_3">
                                </div>
                                <div class="col-md-2">
                                    <input type="text" class="form-control" name="edit_regn_no_4" id="edit_regn_no_4">
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4">
                                    <label>Regn Date</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="Date" class="form-control" name="edit_regn_date" id="edit_regn_date">
                                </div>
                                </div>
                        </div>
                        
                        <div class="form-group">
                          <div class="row">
                            <div class="col-md-4">
                                <label>RTO</label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="edit_rto" id="edit_rto">
                            </div>
                            </div>
                        </div>
                        
                         <div class="form-group">
                          <div class="row">
                            <div class="col-md-4">
                                <label>Zone</label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="edit_zone" id="edit_zone">
                            </div>
                            </div>
                        </div>
                </div>
                <div class="col-md-6">
                     <div class="form-group">
                    <div class="row">
                        <div class="col-md-4">
                            <label>Regn Address</label>
                        </div>
                        <div class="col-md-8">
                            <textarea class="form-control" name="edit_regn_address" id="edit_regn_address"></textarea>
                        </div>
                    </div>
                    </div>
                    
                    <div class="form-group">
                      <div class="row">
                        <div class="col-md-4">
                            <label>State</label>
                        </div>
                        <div class="col-md-8">
                            <select class="form-control select2" name="edit_state" id="edit_state" style="width:100%;">
                            <option value="">--select--</option>
                            <option value="Tamil Nadu">Tamil Nadu</option>
                            <option value="Andhra Pradesh">Andhra Pradesh</option>
                            <option value="Andaman and Nicobar Islands">Andaman and Nicobar Islands</option>
                            <option value="Arunachal Pradesh">Arunachal Pradesh</option>
                            <option value="Assam">Assam</option>
                            <option value="Bihar">Bihar</option>
                            <option value="Chandigarh">Chandigarh</option>
                            <option value="Chhattisgarh">Chhattisgarh</option>
                            <option value="Dadar and Nagar Haveli">Dadar and Nagar Haveli</option>
                            <option value="Daman and Diu">Daman and Diu</option>
                            <option value="Delhi">Delhi</option>
                            <option value="Lakshadweep">Lakshadweep</option>
                            <option value="Puducherry">Puducherry</option>
                            <option value="Goa">Goa</option>
                            <option value="Gujarat">Gujarat</option>
                            <option value="Haryana">Haryana</option>
                            <option value="Himachal Pradesh">Himachal Pradesh</option>
                            <option value="Jammu and Kashmir">Jammu and Kashmir</option>
                            <option value="Jharkhand">Jharkhand</option>
                            <option value="Karnataka">Karnataka</option>
                            <option value="Kerala">Kerala</option>
                            <option value="Madhya Pradesh">Madhya Pradesh</option>
                            <option value="Maharashtra">Maharashtra</option>
                            <option value="Manipur">Manipur</option>
                            <option value="Meghalaya">Meghalaya</option>
                            <option value="Mizoram">Mizoram</option>
                            <option value="Nagaland">Nagaland</option>
                            <option value="Odisha">Odisha</option>
                            <option value="Punjab">Punjab</option>
                            <option value="Rajasthan">Rajasthan</option>
                            <option value="Sikkim">Sikkim</option>
                            <option value="Telangana">Telangana</option>
                            <option value="Tripura">Tripura</option>
                            <option value="Uttar Pradesh">Uttar Pradesh</option>
                            <option value="Uttarakhand">Uttarakhand</option>
                            <option value="West Bengal">West Bengal</option>
                            </select>
                        </div>
                    </div>
                </div>
                
                
                 <div class="form-group">
                    <div class="row">
                        <div class="col-md-4">
                            <label>City</label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="edit_city" id="edit_city">
                        </div>
                    </div>
                    </div>
                    
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-4">
                            <label>Pincode</label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="edit_pincode" id="edit_pincode">
                        </div>
                    </div>
                </div>
                </div>
              </div>
          </div>
        </div> 

      <div class="box">
        <div class="box-header with-border" style="background:#f4f4f48c;">
            <h3 class="box-title" _msthash="26273" _msttexthash="60619" style="text-align: left;font-size:14px;"><i class="fa fa-bars" aria-hidden="true"></i> &nbsp;&nbsp; Personal Details </h3>
            <div class="box-tools pull-right">
                 <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse">
                  <i class="fa fa-minus"></i></button>
            </div>
        </div>
        <div class="box-body" _msthash="1196936" _msttexthash="1190501" >
           <div class="form-group">
               
               <div class="row">
                   <div class="col-md-6">
                       <div class="form-group">
                           <div class="row">
                               <div class="col-md-4">
                                   <label>Vechicle Username</label>
                               </div>
                               <div class="col-md-8">
                                   <input type="text" class="form-control" name="edit_vechi_user_name" id="edit_vechi_user_name">
                               </div>
                           </div>
                       </div>
                   </div>
                   <div class="col-md-6">
                       <div class="form-group">
                           <div class="row">
                               <div class="col-md-4">
                                   <label>Vechicle User Contact Details</label>
                               </div>
                               <div class="col-md-8">
                                   <input type="text" class="form-control" name="edit_vechi_user_cont" id="edit_vechi_user_cont">
                               </div>
                           </div>
                       </div>
                   </div>
                   
               </div>
           </div>
      </div>
    </div> 
    
       <div class="box">
        <div class="box-header with-border" style="background:#f4f4f48c;">
            <h3 class="box-title" _msthash="26273" _msttexthash="60619" style="text-align: left;font-size:14px;"><i class="fa fa-upload" aria-hidden="true"></i> &nbsp;&nbsp; Upload Documents </h3>
            <div class="box-tools pull-right">
                 <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse">
                  <i class="fa fa-minus"></i></button>
            </div>
        </div>
        <div class="box-body" _msthash="1196936" _msttexthash="1190501" >
            
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>File type</th>
                        <th>File name</th>
                        <th>Document Type</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody id="edit_table_view">
                </tbody>
            </table>
    </div> 
    

     </div>
    </div>

  </div>
</div>
</div>

 <div class="modal fade in" id="edit_doc_mod">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true" style="color:white;">×</span></button>
                <h4 class="modal-title text-center">Edit Vehicle Document</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                  <label>Document Type</label> <span id="edit_doc_error" style="color: red;">*</span>
                  <select class="form-control" name="edit_document_type" id="edit_document_type">
                          <option value="">--Select--</option>
                          <option value="RC Book">RC Book</option>
                          <option value="Licence">Licence</option>
                          <option value="Others">Others</option>
                  </select>
                </div>
                
                <div class="form-group">
                  <label>Choosen file</label> 
                   <input type="file" name="edit_vechi_doc" id="edit_vechi_doc" class="form-control">
            </div>
            
            <input type="hidden" id="edit_doc_id">
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-sm btn-primary" id="edit_doc_btn">Submit</button>
            </div>
        </div>
    </div>
  </div>


  <!-- Modal -->
  <div id="add_quotation_model" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content modal-lg-content">
      <div class="modal-header bg-primary">
        <button type="button" class="close" data-dismiss="modal" style="color:#fff;">&times;</button>
        
        <div class="row">
            <div class="col-md-6">
                <h4 class="modal-title"><i class="fa fa-file" aria-hidden="true"></i>
             &nbsp;&nbsp;Create Quotation</h4>
            </div>
              <div class="col-md-5"> 
                <button class="btn btn-success btn-sm pull-right" id="add_quotation"><i class="fa fa-save" aria-hidden="true"></i> Save</button> 
              </div>
          </div>
          
        
      </div>
      <div class="modal-body">
          
        <div class="box">
           <div class="box-header with-border bg-warning">
             <h3 class="box-title"><i class="fa fa-bars" aria-hidden="true"></i>&nbsp;&nbsp; Basic Information</h3>
              <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse">
               <i class="fa fa-minus"></i></button>
               <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="" data-original-title="Remove">
               <i class="fa fa-times"></i></button>
            </div>
        </div>
        <div class="box-body">
            <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-4">
                            <label>Class</label>
                        </div>
                        <div class="col-md-8">
                             <input type="text" class="form-control" name="q_class" id="q_class" readonly>
                        </div>
                    </div>
                </div>
                
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-4">
                            <label>Policy Type</label>
                        </div>
                        <div class="col-md-8">
                             <input type="text" class="form-control" name="q_policy_type" id="q_policy_type" readonly>
                        </div>
                    </div>
                </div>
                
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-4">
                            <label>Client Name</label>
                        </div>
                        <div class="col-md-8">
                             <input type="text" class="form-control" name="q_client_name" id="q_client_name" readonly>
                        </div>
                    </div>
                </div>
                
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-4">
                            <label>Old Policy number</label>
                        </div>
                        <div class="col-md-8">
                             <input type="text" class="form-control" name="q_old_policy_no" id="q_old_policy_no" readonly>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6">
                
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-4">
                            <label>Policy Cover Type</label>
                        </div>
                        <div class="col-md-8">
                            <select class="form-control" name="q_policy_co_type" id="policy_co_cover_type">
                                  <option value="">--Select--</option>
                                  <option value="Own Damage">Own Damage</option>
                                   <option value="Comprehensive">Comprehensive</option>
                                   <option value="Third Party">Third Party</option>
                            </select>
                        </div>
                    </div>
                </div>
                
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-4">
                            <label>Policy Term</label>
                        </div>
                        <div class="col-md-8">
                            <select class="form-control" name="q_policy_term" id="q_policy_term">
                                   <option value="">--select--</option>
                                   <option value="1 Yr OD + 3Yr Tp">1 Yr OD + 3Yr Tp</option>
                                   <option value="1 Yr OD + 1Yr Tp">1 Yr OD + 1Yr Tp</option>
                            </select>
                        </div>
                    </div>
                </div>
                
                 <div class="form-group">
                    <div class="row">
                        <div class="col-md-4">
                            <label>Start Date</label>
                        </div>
                        <div class="col-md-8">
                            <input type="date" class="form-control" name="q_policy_s_date" id="q_policy_s_date" value="<?php echo date("Y-m-d") ?>">
                        </div>
                    </div>
                </div>
                
                 <div class="form-group">
                    <div class="row">
                        <div class="col-md-4">
                            <label>Expiry Date</label>
                        </div>
                        <div class="col-md-8">
                            <input type="date" class="form-control" name="q_policy_ex_date" id="q_policy_ex_date" value="<?php echo date('Y-m-d', strtotime(' + 1 years')) ?>">
                        </div>
                    </div>
                </div>
                
                
            </div>
        </div>
        </div>
    </div>
    
       <div class="box">
           <div class="box-header with-border bg-warning">
             <h3 class="box-title"><i class="fa fa-bars" aria-hidden="true"></i>&nbsp;&nbsp; Insurer Details</h3>
              <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse">
               <i class="fa fa-minus"></i></button>
               <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="" data-original-title="Remove">
               <i class="fa fa-times"></i></button>
            </div>
        </div>
        <div class="box-body">
            <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-4">
                            <label>Insurer</label>
                        </div>
                        <div class="col-md-8">
                             <select name="q_insurer" class="form-control" id="q_insurer">
                                 <option value="">--Select--</option>
                                 <option value="1">Acko General</option>
                                 <option value="2">Aditya Birla Health</option>
                                 <option value="3">Aegon Life</option>
                                 <option value="4">Bajaj Allianz</option>
                                 <option value="5">DHFL General</option>
                                 <option value="6">HDFC ERGO</option>
                                 <option value="7">TATA AIG</option>
                                 <option value="8">Relaince General</option>
                             </select>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6">
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-4">
                            <label>Insurer Branch</label>
                        </div>
                        <div class="col-md-8">
                             <select name="q_insurer_branch" class="form-control" id="q_insurer_branch">
                                 <option value="">--Select--</option>
                             </select>
                        </div>
                    </div>
                </div>
            </div>
            
          </div>
       </div>
   </div>
   
       <div class="box">
           <div class="box-header with-border bg-warning">
             <h3 class="box-title"><i class="fa fa-car" aria-hidden="true"></i>&nbsp;&nbsp; Basic Details Of Vechicle</h3>
              <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse">
               <i class="fa fa-minus"></i></button>
               <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="" data-original-title="Remove">
               <i class="fa fa-times"></i></button>
            </div>
        </div>
        <div class="box-body">
            <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-4">
                            <label>IDV</label>
                        </div>
                        <div class="col-md-8">
                             <input type="text" class="form-control" name="q_idv" id="q_idv">
                        </div>
                    </div>
                </div>
                
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-4">
                            <label>Electrical Accessory Value</label>
                        </div>
                        <div class="col-md-8">
                             <input type="text" class="form-control" name="q_elec_access_value" id="q_elec_access_value">
                        </div>
                    </div>
                </div>
                
                 <div class="form-group">
                    <div class="row">
                        <div class="col-md-4">
                            <label>Non Electrical Accessory Value</label>
                        </div>
                        <div class="col-md-8">
                             <input type="text" class="form-control" name="q_non_elec_access_value" id="q_non_elec_access_value">
                        </div>
                    </div>
                </div>
                
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-4">
                            <label>LPG / CNG IDV</label>
                        </div>
                        <div class="col-md-4">
                             <select class="form-control" name="q_lpg_cng" id="q_lpg_cng">
                                <option value="">--Select--</option>
                                <option value="Yes">Yes</option>
                                <option value="No" selected>No</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <input type="text" class="form-control" name="q_lpg_amount" id="q_lpg_amount" value="0" readonly>
                        </div>
                    </div>
                </div>
                
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-4">
                            <label>Sum Insured</label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="q_sum_insured" id="q_sum_insured">
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6">
                
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-4">
                            <label>Make / Model / Varient</label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="q_make_model" id="q_make_model" readonly>
                        </div>
                    </div>
                </div>
                
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-4">
                            <label>Vehicle Age</label>
                        </div>
                        <div class="col-md-5">
                          <input type="text" class="form-control" id="q_vechi_age" name="q_vechi_age" readonly>
                        </div>
                        <div class="col-md-3">
                          <button class="btn btn-danger btn-xs" id="edit_reg_yr"><i class="fa fa-pencil-square-o"></i>&nbsp;&nbsp;Edit Mfg/Reg Year</button>
                        </div>
                    </div>
                </div>
                
                 <div class="form-group">
                    <div class="row">
                        <div class="col-md-4">
                            <label>RTO Code</label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="q_rto_code" id="q_rto_code">
                        </div>
                    </div>
                </div>
                
                 <div class="form-group">
                    <div class="row">
                        <div class="col-md-4">
                            <label>Zone</label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="q_zone" id="q_zone">
                        </div>
                    </div>
                </div>
                
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-4">
                            <label>Cubic Capacity</label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="q_cubic_capactiy" id="q_cubic_capactiy">
                        </div>
                    </div>
                </div>
                
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-4">
                            <label>Vechicle Classification</label>
                        </div>
                        <div class="col-md-8">
                            <select class="form-control" name="q_vechi_classification" id="q_vechi_classification">
                               <option value="">--Select--</option>
                              <option value="small">Small</option>
                              <option value="Hatchback">Hatchback</option>
                              <option value="Midsize">Midsize</option>
                              <option value="High End">High End</option>
                              <option value="MPV/SUV">MPV/SUV</option>
                              <option value="Commercial">Commercial</option>
                            </select>
                        </div>
                    </div>
                </div>
                
                
            </div>
        </div>
        </div>
    </div>
    
       <div class="row">
         <div class="col-md-6">
               <div class="box">
                   <div class="box-header with-border bg-warning">
                     <h3 class="box-title"><i class="fa fa-money" aria-hidden="true"></i>&nbsp;&nbsp;Own Damage Premium</h3>
                      <div class="box-tools pull-right">
                          <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse">
                           <i class="fa fa-minus"></i></button>
                           <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="" data-original-title="Remove">
                           <i class="fa fa-times"></i></button>
                    </div>
                </div>
            <div class="box-body">
                
                <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                                <label>Basic OD</label>
                            </div>
                            <div class="col-md-4">
                                <div class="input-group">
                                    <input type="text" class="form-control" style="text-align:right;" id="q_basic_od_percentage">
                                    <span class="input-group-addon">%</span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                    <input type="text" class="form-control" style="text-align:right;" id="q_basic_od_amount">
                                </div>
                            </div>
                        </div>
                        
                <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                                <label>Special Discount</label>
                            </div>
                            <div class="col-md-4">
                                <div class="input-group">
                                    <input type="text" class="form-control" style="text-align:right;" id="q_spl_dis_per">
                                    <span class="input-group-addon">%</span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                    <input type="text" class="form-control" style="text-align:right;" id="q_spl_dis_amount">
                                </div>
                            </div>
                        </div>
                        
                <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                                <label>Special Loading</label>
                            </div>
                            <div class="col-md-4">
                                <div class="input-group">
                                    <input type="text" class="form-control" style="text-align:right;" id="q_spl_loading_per">
                                    <span class="input-group-addon">%</span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                    <input type="text" class="form-control" style="text-align:right;" id="q_spl_loading_amount">
                                </div>
                            </div>
                        </div>
                   
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-4">
                            <label>Non Basic OD</label>
                        </div>
                        <div class="col-md-8">
                            <input type="number" class="form-control" name="q_non_basic_od" id="q_non_basic_od" style="text-align:right;">
                        </div>
                    </div>
                 </div>     
                
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-4">
                            <label>Non Electrical Accessories</label>
                        </div>
                        <div class="col-md-8">
                            <input type="number" class="form-control" name="q_non_elec_acc_amount" id="q_non_elec_acc_amount" style="text-align:right;">
                        </div>
                    </div>
                </div>
                
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-4">
                            <label>Electrical Accessories</label>
                        </div>
                        <div class="col-md-8">
                            <input type="number" class="form-control" name="q_elec_acc_amount" id="q_elec_acc_amount" style="text-align:right;">
                        </div>
                    </div>
                </div>
                
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-4">
                            <label>Bi-fuel Kit</label>
                        </div>
                        <div class="col-md-8">
                            <input type="number" class="form-control" name="q_bi_fuel_kit" id="q_bi_fuel_kit" style="text-align:right;">
                        </div>
                    </div>
                </div>
                
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-4">
                            <label>Basic OD1</label>
                        </div>
                        <div class="col-md-8">
                            <input type="number" class="form-control" name="q_basic_od1" id="q_basic_od1" style="text-align:right;">
                        </div>
                    </div>
                </div>
                
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-4">
                            <label>Geographical Area</label>
                        </div>
                        <div class="col-md-4">
                            <select class="form-control" name="q_geographical_area" id="q_geographical_area">
                                <option value="">--Select--</option>
                                <option value="Yes">Yes</option>
                                <option value="No">No</option>
                            </select>
                        </div>
                        
                        <div class="col-md-4">
                            <input type="text" class="form-control" name="q_geographical_amount" id="q_geographical_amount">
                        </div>
                        
                        
                    </div>
                </div>
                
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-4">
                            <label>Embassy Loading</label>
                        </div>
                        <div class="col-md-4">
                            <select class="form-control" name="q_emp_loading" id="q_emp_loading">
                                <option value="">--Select--</option>
                                <option value="Yes">Yes</option>
                                <option value="No">No</option>
                            </select>
                        </div>
                        
                        <div class="col-md-4">
                            <input type="text" class="form-control" name="q_emp_loading_amount" id="q_emp_loading_amount">
                        </div>
                        
                        
                    </div>
                </div>
                
                 <div class="form-group">
                    <div class="row">
                        <div class="col-md-4">
                            <label>Fiber Class Tank</label>
                        </div>
                        <div class="col-md-4">
                            <select class="form-control" name="q_fiber_class_tank" id="q_fiber_class_tank">
                                <option value="">--Select--</option>
                                <option value="Yes">Yes</option>
                                <option value="No">No</option>
                            </select>
                        </div>
                        
                        <div class="col-md-4">
                            <input type="text" class="form-control" name="q_fiber_class_tank_amount" id="q_fiber_class_tank_amount">
                        </div>
                        
                        
                    </div>
                </div>
                
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-4">
                            <label>Driving Tuitions</label>
                        </div>
                        <div class="col-md-4">
                            <select class="form-control" name="q_driving_tuitions" id="q_driving_tuitions">
                                <option value="">--Select--</option>
                                <option value="Yes">Yes</option>
                                <option value="No">No</option>
                            </select>
                        </div>
                        
                        <div class="col-md-4">
                            <input type="text" class="form-control" name="q_driving_tuitions_amount" id="q_driving_tuitions_amount">
                        </div>
                    </div>
                </div>
                
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-4">
                            <label>Basic OD2</label>
                        </div>
                        <div class="col-md-4">
                            <select class="form-control" name="q_basic_od2" id="q_basic_od2">
                                <option value="">--Select--</option>
                                <option value="Yes">Yes</option>
                                <option value="No">No</option>
                            </select>
                        </div>
                        
                        <div class="col-md-4">
                            <input type="text" class="form-control" name="q_basic_od2_amount" id="q_basic_od2_amount">
                        </div>
                    </div>
                </div>
                
                <p align="center">Discounts</p>
                
                 <div class="form-group">
                    <div class="row">
                        <div class="col-md-4">
                            <label>Anti Theft</label>
                        </div>
                         <div class="col-md-4">
                            <select class="form-control" name="q_anti_theft" id="q_anti_theft">
                                <option value="">--Select--</option>
                                <option value="Yes">Yes</option>
                                <option value="No">No</option>
                            </select>
                        </div>
                        
                        <div class="col-md-4">
                            <input type="text" class="form-control" name="q_anti_theft_amount" id="q_anti_theft_amount">
                        </div>
                    </div>
                </div>
                
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-4">
                            <label>Handicap</label>
                        </div>
                         <div class="col-md-4">
                            <select class="form-control" name="q_anti_handicap" id="q_anti_handicap">
                                <option value="">--Select--</option>
                                <option value="Yes">Yes</option>
                                <option value="No">No</option>
                            </select>
                        </div>
                        
                        <div class="col-md-4">
                            <input type="text" class="form-control" name="q_anti_handicap_amount" id="q_anti_handicap_amount">
                        </div>
                    </div>
                </div>
                
                 <div class="form-group">
                    <div class="row">
                        <div class="col-md-4">
                            <label>AAI</label>
                        </div>
                         <div class="col-md-4">
                            <select class="form-control" name="q_aai" id="q_aai">
                                <option value="">--Select--</option>
                                <option value="Yes">Yes</option>
                                <option value="No">No</option>
                            </select>
                        </div>
                        
                        <div class="col-md-4">
                            <input type="text" class="form-control" name="q_aai_amount" id="q_aai_amount">
                        </div>
                    </div>
                </div>
                
                 <div class="form-group">
                    <div class="row">
                        <div class="col-md-4">
                            <label>Voluntary Deductable</label>
                        </div>
                         <div class="col-md-4">
                            <select class="form-control" name="q_voluntary_deductable" id="q_voluntary_deductable">
                                <option value="">--Select--</option>
                                <option value="Yes">Yes</option>
                                <option value="No">No</option>
                            </select>
                        </div>
                        
                        <div class="col-md-4">
                            <input type="text" class="form-control" name="q_voluntary_deductable_amount" id="q_voluntary_deductable_amount">
                        </div>
                    </div>
                </div>
                
                <hr/>
                
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-4">
                            <label>Basic OD3</label>
                        </div>
                         <div class="col-md-8">
                            <input type="text" class="form-control" name="q_basic_od_3" id="q_basic_od_3" style="text-align:right;">
                        </div>
                    </div>
                </div>
                
                <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                                <label>NCB</label>
                            </div>
                            <div class="col-md-4">
                                <div class="input-group">
                                    <input type="text" class="form-control" style="text-align:right;" id="q_ncb_percentage">
                                    <span class="input-group-addon">%</span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                    <input type="text" class="form-control" style="text-align:right;" id="q_ncb_percentage_amount">
                                </div>
                            </div>
                        </div>
                        
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-4">
                            <label>Total OD Premium (A)</label>
                        </div>
                         <div class="col-md-8">
                            <input type="text" class="form-control" name="q_tot_od_premium" id="q_tot_od_premium" style="text-align:right;">
                        </div>
                    </div>
                </div>
               
        </div>
             </div>
         </div>
         
         <div class="col-md-6">
             <div class="box">
                   <div class="box-header with-border bg-warning">
                     <h3 class="box-title"><i class="fa fa-money" aria-hidden="true"></i>&nbsp;&nbsp;Third Party Premium</h3>
                      <div class="box-tools pull-right">
                          <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse">
                           <i class="fa fa-minus"></i></button>
                           <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="" data-original-title="Remove">
                           <i class="fa fa-times"></i></button>
                    </div>
                </div>
              <div class="box-body">
                  
                      <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                               <label>Basic TP</label><span>*</span>
                           </div>
                           <div class="col-md-8">
                               <input type="number" class="form-control" name="q_basic_tp" id="q_basic_tp">
                           </div>
                        </div>
                      </div>
                      
                      <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                               <label>Bi Fuel Kit</label>
                           </div>
                           <div class="col-md-8">
                               <input type="number" class="form-control" name="q_fuel_kit_amt" id="q_fuel_kit_amt">
                           </div>
                        </div>
                      </div>
                      
                      <div class="form-group">
                    <div class="row">
                        <div class="col-md-4">
                            <label>Basic TP1</label>
                        </div>
                        <div class="col-md-8">
                            <input type="number" class="form-control" name="q_basic_tp1" id="q_basic_tp1" style="text-align:right;">
                        </div>
                    </div>
                </div>
                      
                      <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                               <label>Geograpical Area</label>
                           </div>
                           <div class="col-md-8">
                               <input type="text" class="form-control" name="q_geograpical_amt" id="q_geograpical_amt">
                           </div>
                        </div>
                      </div>
                      
                       <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                               <label>Owner Driver PA</label><span>*</span>
                           </div>
                           <div class="col-md-8">
                               <input type="number" class="form-control" name="q_owner_diver_amt" id="q_owner_diver_amt">
                           </div>
                        </div>
                      </div>
                      
                      <div class="form-group">
                          <div class="row">
                              <div class="col-md-4">
                                  <label style="font-style: italic;">No of year(Own Drv PA)</label>
                              </div>
                              <div class="col-md-8">
                                  <select class="form-control" name="q_no_of_year_own_drv" id="q_no_of_year_own_drv">
                                    <option value="">--select--</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                  </select>
                              </div>
                          </div>
                      </div>
                      
                      <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                               <label>Un Named Passenger PA</label>
                           </div>
                           <div class="col-md-4">
                               <select class="form-control" name="q_un_named_passenger_pa" id="q_un_named_passenger_pa">
                                   <option value="">--Select--</option>
                                   <option value="Yes">Yes</option>
                                   <option value="No">No</option>
                               </select>
                           </div>
                           
                           <div class="col-md-4">
                               <input type="text" class="form-control" name="q_un_named_passenger_amt" id="q_un_named_passenger_amt">
                           </div>
                        </div>
                      </div>
                      
                       <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                               <label style="font-style: italic;">No of seats Limit Per Person</label>
                           </div>
                           <div class="col-md-4">
                                 <input type="text" class="form-control" name="q_no_seats_per_person" id="q_no_seats_per_person">
                           </div>
                           <div class="col-md-4">
                               <input type="text" class="form-control" name="q_no_seats_per_person_amt" id="q_no_seats_per_person_amt">
                           </div>
                        </div>
                      </div>
                      
                      <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                               <label>LL to paid Drv/Emp</label>
                           </div>
                           <div class="col-md-4">
                               <select class="form-control" name="q_llp" id="q_llp">
                                   <option value="">--Select--</option>
                                   <option value="Yes">Yes</option>
                                   <option value="No">No</option>
                               </select>
                           </div>
                           
                           <div class="col-md-4">
                               <input type="text" class="form-control" name="q_llp_amt" id="q_llp_amt">
                           </div>
                        </div>
                      </div>
                      
                       <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                               <label>No of Drv/Emp</label>
                           </div>
                           <div class="col-md-8">
                               <input type="text" class="form-control" name="q_no_drv_emp" id="q_no_drv_emp">
                           </div>
                        </div>
                      </div>
                      
                      <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                               <label>PA Paid Drv</label><span>*</span>
                           </div>
                           <div class="col-md-4">
                               <select class="form-control" name="q_pa_paid_drv" id="q_pa_paid_drv">
                                   <option value="">--Select--</option>
                                   <option value="Yes">Yes</option>
                                   <option value="No">No</option>
                               </select>
                           </div>
                           
                           <div class="col-md-4">
                               <input type="text" class="form-control" name="q_pa_paid_drv_amt" id="q_pa_paid_drv_amt">
                           </div>
                        </div>
                      </div>
                      
                       <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                               <label style="font-style: italic;">No of seats Limit Per Person</label>
                           </div>
                           <div class="col-md-4">
                                 <input type="text" class="form-control" name="q_no_seats_per_person1" id="q_no_seats_per_person1">
                           </div>
                           <div class="col-md-4">
                               <input type="text" class="form-control" name="q_no_seats_per_person_amt1" id="q_no_seats_per_person_amt1">
                           </div>
                        </div>
                      </div>
                      
                       <div class="form-group">
                    <div class="row">
                        <div class="col-md-4">
                            <label>Total TP Premium (B)</label>
                        </div>
                         <div class="col-md-8">
                            <input type="text" class="form-control" name="q_tot_tp_premium" id="q_tot_tp_premium" style="text-align:right;">
                        </div>
                    </div>
                </div>
               </div>
             </div>
         </div>
         
         <div class="col-md-6">
             <div class="box">
                   <div class="box-header with-border bg-warning">
                     <h3 class="box-title"><i class="fa fa-money" aria-hidden="true"></i>&nbsp;&nbsp;Add-On Covers Premium</h3>
                      <div class="box-tools pull-right">
                          <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse">
                           <i class="fa fa-minus"></i></button>
                           <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="" data-original-title="Remove">
                           <i class="fa fa-times"></i></button>
                    </div>
                </div>
              <div class="box-body">
                  
                      <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                               <label>Add-on Combo Plan</label><span>*</span>
                           </div>
                           <div class="col-md-8">
                               <select class="form-control" name="q_add_on_combo_premium" id="q_add_on_combo_premium">
                                   <option value="">--Select--</option>
                               </select>
                           </div>
                        </div>
                      </div>
                      
                      <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                               <label>Add On Plan Premium</label>
                           </div>
                           
                            <div class="col-md-4">
                               <div class="input-group">
                                    <input type="text" class="form-control" style="text-align:right;" id="q_add_on_plan_premium_percentage">
                                    <span class="input-group-addon">%</span>
                                </div>
                           </div>
                           
                           <div class="col-md-4">
                               <input type="number" class="form-control" name="q_add_on_plan_premium" id="q_add_on_plan_premium" style="text-align:right;">
                           </div>
                           
                        </div>
                      </div>
                      
                      <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                               <label>Zero Depreciation</label>
                           </div>
                            
                            <div class="col-md-1">
                                <div class="icheck-primary" bis_skin_checked="1">
                                    <input type="checkbox" class="form-check-input" id="q_zero_depreciation_check" name="q_zero_depreciation_check" value="Yes">
                               </div>
                           </div>
                           
                            <div class="col-md-3">
                               <div class="input-group">
                                    <input type="text" class="form-control" style="text-align:right;" id="q_zero_depreciation_percentage">
                                    <span class="input-group-addon">%</span>
                                </div>
                            </div>
                           
                           <div class="col-md-4">
                               <input type="number" class="form-control" name="q_zero_depreciation_amt" id="q_zero_depreciation_amt" style="text-align:right;">
                           </div>
                           
                        </div>
                      </div>
                      
                      <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                               <label>RSA/Additional For Addons</label>
                           </div>
                            
                            <div class="col-md-1">
                                <div class="icheck-primary" bis_skin_checked="1">
                                    <input type="checkbox" class="form-check-input" id="q_addtional_addons_check" name="q_addtional_addons_check" value="Yes">
                               </div>
                           </div>
                           
                           <div class="col-md-7">
                               <input type="number" class="form-control" name="q_addtional_addons_amt" id="q_addtional_addons_amt" style="text-align:right;">
                           </div>
                           
                        </div>
                      </div>
                      
                      <div class="form-group">
                                <div class="row">
                                    <div class="col-md-4">
                                       <label>Consumbles</label>
                                   </div>
                                    
                                    <div class="col-md-1">
                                        <div class="icheck-primary" bis_skin_checked="1">
                                            <input type="checkbox" class="form-check-input" id="q_consumbles_check" name="q_consumbles_check" value="Yes">
                                       </div>
                                   </div>
                                 
                                    <div class="col-md-3">
                                       <div class="input-group">
                                            <input type="text" class="form-control" style="text-align:right;" id="q_consumbles_percentage">
                                            <span class="input-group-addon">%</span>
                                        </div>
                                    </div>
                                    
                                     <div class="col-md-4">
                                         <input type="number" class="form-control" name="q_consumbles_amt" id="q_consumbles_amt" style="text-align:right;">
                                    </div>
                                </div>
                              </div>
                              
                      <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                               <label>Tyre Cover</label>
                           </div>
                            
                            <div class="col-md-1">
                                <div class="icheck-primary" bis_skin_checked="1">
                                    <input type="checkbox" class="form-check-input" id="q_consumbles_check" name="q_tyre_cover" value="Yes">
                               </div>
                           </div>
                         
                            <div class="col-md-3">
                               <div class="input-group">
                                    <input type="text" class="form-control" style="text-align:right;" id="q_tyre_cover_percentage">
                                    <span class="input-group-addon">%</span>
                                </div>
                            </div>
                            
                             <div class="col-md-4">
                                 <input type="number" class="form-control" name="q_tyre_cover_amt" id="q_tyre_cover_amt" style="text-align:right;">
                            </div>
                        </div>
                      </div>
                      
                      <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                               <label>NCB Protection</label>
                           </div>
                            
                            <div class="col-md-1">
                                <div class="icheck-primary" bis_skin_checked="1">
                                    <input type="checkbox" class="form-check-input" id="q_ncb_protection_check" name="q_ncb_protection_check" value="Yes">
                               </div>
                           </div>
                         
                            <div class="col-md-3">
                               <div class="input-group">
                                    <input type="text" class="form-control" style="text-align:right;" id="q_ncb_protection_percentage">
                                    <span class="input-group-addon">%</span>
                                </div>
                            </div>
                            
                             <div class="col-md-4">
                                 <input type="number" class="form-control" name="q_ncb_protection_amt" id="q_ncb_protection_amt" style="text-align:right;">
                            </div>
                        </div>
                      </div>
                      
                      <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                               <label>Engine Protector</label>
                           </div>
                            
                            <div class="col-md-1">
                                <div class="icheck-primary" bis_skin_checked="1">
                                    <input type="checkbox" class="form-check-input" id="q_engine_protector_check" name="q_engine_protector_check" value="Yes">
                               </div>
                           </div>
                         
                            <div class="col-md-3">
                               <div class="input-group">
                                    <input type="text" class="form-control" style="text-align:right;" id="q_engine_protector_percentage">
                                    <span class="input-group-addon">%</span>
                                </div>
                            </div>
                            
                             <div class="col-md-4">
                                 <input type="number" class="form-control" name="q_engine_protector_amt" id="q_engine_protector_amt" style="text-align:right;">
                            </div>
                        </div>
                      </div>
                      
                      <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                               <label>Return To Invoice</label>
                           </div>
                            
                            <div class="col-md-1">
                                <div class="icheck-primary" bis_skin_checked="1">
                                    <input type="checkbox" class="form-check-input" id="q_return_to_invoice_check" name="q_return_to_invoice_check" value="Yes">
                               </div>
                           </div>
                         
                            <div class="col-md-3">
                               <div class="input-group">
                                    <input type="text" class="form-control" style="text-align:right;" id="q_return_to_invoice_percentage">
                                    <span class="input-group-addon">%</span>
                                </div>
                            </div>
                            
                             <div class="col-md-4">
                                 <input type="number" class="form-control" name="q_return_to_invoice_amt" id="q_return_to_invoice_amt" style="text-align:right;">
                            </div>
                        </div>
                      </div>
                      
                      <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                               <label>Key and Lock Replacement</label>
                           </div>
                            
                            <div class="col-md-1">
                                <div class="icheck-primary" bis_skin_checked="1">
                                    <input type="checkbox" class="form-check-input" id="q_key_replacement_check" name="q_key_replacement_check" value="Yes">
                               </div>
                           </div>
                         
                            <div class="col-md-3">
                               <div class="input-group">
                                    <input type="text" class="form-control" style="text-align:right;" id="q_key_replacement_percentage">
                                    <span class="input-group-addon">%</span>
                                </div>
                            </div>
                            
                             <div class="col-md-4">
                                 <input type="number" class="form-control" name="q_key_replacement_amt" id="q_key_replacement_amt" style="text-align:right;">
                            </div>
                        </div>
                      </div>

                      <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                               <label>Daily / InConvinience Allowance</label>
                           </div>
                            
                            <div class="col-md-1">
                                <div class="icheck-primary" bis_skin_checked="1">
                                    <input type="checkbox" class="form-check-input" id="q_daily_allow_check" name="q_daily_allow_check" value="Yes">
                               </div>
                           </div>
                         
                            <div class="col-md-3">
                               <div class="input-group">
                                    <input type="text" class="form-control" style="text-align:right;" id="q_daily_allow_percentage">
                                    <span class="input-group-addon">%</span>
                                </div>
                            </div>
                            
                             <div class="col-md-4">
                                 <input type="number" class="form-control" name="q_daily_allow_amt" id="q_daily_allow_amt" style="text-align:right;">
                            </div>
                        </div>
                      </div>
                      
                      <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                               <label>Loss of personal Belongies</label>
                           </div>
                            
                            <div class="col-md-1">
                                <div class="icheck-primary" bis_skin_checked="1">
                                    <input type="checkbox" class="form-check-input" id="q_loss_of_belong_check" name="q_loss_of_belong_check" value="Yes">
                               </div>
                           </div>
                         
                            <div class="col-md-3">
                               <div class="input-group">
                                    <input type="text" class="form-control" style="text-align:right;" id="q_loss_of_belong_percentage">
                                    <span class="input-group-addon">%</span>
                                </div>
                            </div>
                            
                             <div class="col-md-4">
                                 <input type="number" class="form-control" name="q_loss_of_belong_amt" id="q_loss_of_belong_amt" style="text-align:right;">
                            </div>
                        </div>
                      </div>
                      
                      <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                               <label>Hotel & Travel Expenses</label>
                           </div>
                            
                            <div class="col-md-1">
                                <div class="icheck-primary" bis_skin_checked="1">
                                    <input type="checkbox" class="form-check-input" id="q_hotel_trvl_check" name="q_hotel_trvl_check" value="Yes">
                               </div>
                           </div>
                         
                            <div class="col-md-3">
                               <div class="input-group">
                                    <input type="text" class="form-control" style="text-align:right;" id="q_hotel_trvl_percentage">
                                    <span class="input-group-addon">%</span>
                                </div>
                            </div>
                            
                             <div class="col-md-4">
                                 <input type="number" class="form-control" name="q_hotel_trvl_amt" id="q_hotel_trvl_amt" style="text-align:right;">
                            </div>
                        </div>
                      </div>
                      
                      <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                               <label>Wind Shield Glass</label>
                           </div>
                            
                            <div class="col-md-1">
                                <div class="icheck-primary" bis_skin_checked="1">
                                    <input type="checkbox" class="form-check-input" id="q_wind_shield_check" name="q_wind_shield_check" value="Yes">
                               </div>
                           </div>
                         
                            <div class="col-md-3">
                               <div class="input-group">
                                    <input type="text" class="form-control" style="text-align:right;" id="q_wind_shield_percentage">
                                    <span class="input-group-addon">%</span>
                                </div>
                            </div>
                            
                             <div class="col-md-4">
                                 <input type="number" class="form-control" name="q_wind_shield_amt" id="q_wind_shield_amt" style="text-align:right;">
                            </div>
                        </div>
                      </div>
                      
                      <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                               <label>Baggage Insurance</label>
                           </div>
                            
                            <div class="col-md-1">
                                <div class="icheck-primary" bis_skin_checked="1">
                                    <input type="checkbox" class="form-check-input" id="q_baggage_ins_check" name="q_baggage_ins_check" value="Yes">
                               </div>
                           </div>
                         
                            <div class="col-md-3">
                               <div class="input-group">
                                    <input type="text" class="form-control" style="text-align:right;" id="q_baggage_ins_percentage">
                                    <span class="input-group-addon">%</span>
                                </div>
                            </div>
                            
                             <div class="col-md-4">
                                 <input type="number" class="form-control" name="q_baggage_ins_amt" id="q_baggage_ins_amt" style="text-align:right;">
                            </div>
                        </div>
                      </div>
                      
                      <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                               <label>Other Add-On Coverage</label>
                           </div>
                           
                            <div class="col-md-4">
                               <div class="input-group">
                                    <input type="text" class="form-control" style="text-align:right;" id="q_other_add_on_coverag_per">
                                    <span class="input-group-addon">%</span>
                                </div>
                           </div>
                           
                           <div class="col-md-4">
                               <input type="number" class="form-control" name="q_other_add_on_coverage_amt" id="q_other_add_on_coverage_amt" style="text-align:right;" value="0">
                           </div>
                           
                        </div>
                      </div>
                      
                      <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                               <label>Value Added Services</label>
                           </div>
                           <div class="col-md-8">
                               <input type="number" class="form-control" name="q_value_added_services" id="q_value_added_services" style="text-align:right;">
                           </div>
                        </div>
                      </div>
                      
                      <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                               <label>Net Add-on Cover Premium</label>
                           </div>
                           <div class="col-md-8">
                               <input type="number" class="form-control" name="q_net_addon_cover_premium" id="q_net_addon_cover_premium" style="text-align:right;" value="0">
                           </div>
                        </div>
                      </div>
                      
                      <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                               <label>Add-on Discount</label>
                           </div>
                           
                            <div class="col-md-4">
                               <div class="input-group">
                                    <input type="text" class="form-control" style="text-align:right;" id="q_add_on_discount_percentage">
                                    <span class="input-group-addon">%</span>
                                </div>
                           </div>
                           
                           <div class="col-md-4">
                               <input type="number" class="form-control" name="q_add_on_discount_amt" id="q_add_on_discount_amt" style="text-align:right;" value="0">
                           </div>
                           
                        </div>
                      </div>
                      
                      <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                               <label>Total Add-on Cover Premium(C) </label>
                           </div>
                           
                           <div class="col-md-8">
                               <input type="number" class="form-control" name="q_tot_add_on_cover_premium" id="q_tot_add_on_cover_premium" style="text-align:right;" value="0">
                           </div>
                           
                        </div>
                      </div>
               </div>
             </div>
         </div>
        
     </div>

      <div class="box">
                   <div class="box-header with-border bg-warning">
                     <h3 class="box-title"><i class="fa fa-money" aria-hidden="true"></i>&nbsp;&nbsp;Total Premium</h3>
                      <div class="box-tools pull-right">
                          <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse">
                           <i class="fa fa-minus"></i></button>
                           <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="" data-original-title="Remove">
                           <i class="fa fa-times"></i></button>
                    </div>
                </div>
              <div class="box-body">
                  
              <div class="row">
                  <div class="col-md-6">
                      <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                                <label>Total Premium (A+B+C)</label><span>*</span>
                            </div>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="q_total_premium" id="q_total_premium">
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                                <label>GST(18%)</label><span>*</span>
                            </div>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="q_gst" id="q_gst">
                            </div>
                        </div>
                    </div>
                  </div>
                  
                  <div class="col-md-6">
                      
                      <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                                <label>Total Payable</label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="q_total_payable" id="q_total_payable">
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                                <label>OD + Commission Base Premium</label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="q_commission_base_premium" id="q_commission_base_premium" style="text-align:right;">
                            </div>
                        </div>
                    </div>
                    
                    
                  </div>
                  
              </div>    
                 
                  
                    
                    
                 
               </div>
             </div>
             
             
      
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

  
  

   
  
  
  <script>
  
  	var Husband = 0;
  	var Wife =0;
  	var Son = 0;
  	var Daughter = 0;
  	var Father = 0;
  	var Mother = 0;
	var Husband_age = "";
	var Wife_age = "";
	
	var pet_gender = "male";
	
	//property
	
	//Home
	var house_type = 'Home';
	var owner_type = 'Owner';
	// business 
	
	var business_owner_type = 'Owner';
	
      $(document).ready(function(){
          
          $('.select2').select2();
        
        var last_inserted_id = $("#last_inserted_id").val();
        
        get_all_quotes(last_inserted_id)
        
          if(last_inserted_id != "")
          {
                        $("#follow_up_hidden").removeClass("hidden");
                        //$("#vechicle_hidden").removeClass("hidden");
                        $("#prospect_btn").removeClass("hidden");
                        $("#sms_btn").removeClass("hidden");
                        $("#policy_btn").removeClass("hidden");
                        $("#edit_client_btn").removeClass("hidden");
                        $("#edit_req_btn").removeClass("hidden");
                        
                        
                        $("#client_type").attr("disabled",true);
                        $("#client_name").attr("disabled",true);
                        $("#mobile_no").attr("disabled",true);
                        $("#other_contact_details").attr("disabled",true);
                         $("#landline_no").attr("disabled",true);
                        $("#address").attr("disabled",true);
                        $("#email_id").attr("disabled",true);
                        $("#cont_person_name").attr("disabled",true);
                        $("#cont_person_des").attr("disabled",true);
                        $("#dob").attr("disabled",true);
                        $("#age").attr("disabled",true);
                        $("#area").attr("disabled",true);
                        
                        $("#bussiness_type").attr("disabled",true);
                        $("#policy_class").attr("disabled",true);
                        $("#policy_type").attr("disabled",true);
                        $("#lead_generated_date").attr("disabled",true);
                        $("#due_date").attr("disabled",true);
                        $("#location").attr("disabled",true);
                        $("#classification").attr("disabled",true);
                        $("#source").attr("disabled",true);
                        $("#agent_pos").attr("disabled",true);
                        $("#assign_to_user").attr("disabled",true);
                        $("#remarks").attr("disabled",true);
                       
                        $.ajax({
                            url : "get_lead_details",
                            method:"POST",
                            data:{last_inserted_id:last_inserted_id},
                            success:function(response)
                            {
                                var obj = jQuery.parseJSON(response);
                                $("#client_type").val(obj.client_type_id);
                                $("#client_name").val(obj.client_name);
                                $("#mobile_no").val(obj.mobile_no);
                                $("#other_contact_details").val(obj.other_contact_details);
                                $("#landline_no").val(obj.landline_no);
                                $("#address").val(obj.address);
                                $("#email_id").val(obj.email);
                                $("#cont_person_name").val(obj.contact_person_name);
                                $("#cont_person_des").val(obj.contact_person_designation);
                                $("#dob").val(obj.date_of_birth);
                                $("#age").val(obj.age);
                                $("#area").val(obj.area);
                                $("#bussiness_type").val(obj.business_type);
                                $("#policy_class").val(obj.class);
                                
                                 var policy_type_id = obj.policy_type;
                                 
                                if(obj.class != "")
                                {
                                    var policy_class = obj.class;
                                       $.ajax({
                                            url : "fetch_policy_type_using_class",
                                            method : "POST",
                                            data:{policy_class:policy_class},
                                            success:function(response)
                                            { 
                                                var obj = jQuery.parseJSON(response);
                                                
                                                var str = "<option value=''>--Select--</option>";
                                                for(var j=0;j<obj.length;j++)
                                                {
                                                    if(policy_type_id == obj[j].id)
                                                    {
                                                    str += "<option value='"+obj[j].id+"' selected>"+obj[j].policy_type+"</option>";
                                                    }
                                                    else
                                                    {
                                                        str += "<option value='"+obj[j].id+"'>"+obj[j].policy_type+"</option>";
                                                    }
                                                }
                                                $("#policy_type").html(str);
                                            }
                                       });

                                       if(obj.class == "1")
                                       {
                                           $("#vechicle_hidden").removeClass("hidden");
                                       }
                                       else if(obj.class == "2")
                                       {
                                           $("#health_hidden").removeClass("hidden");
                                       }
                                       else if(obj.class == "4")
                                       {
                                            $("#property_hidden").removeClass("hidden");
                                            
                                           if(obj.policy_type == "22")
                                           {
                                               $("#add_prop_btn").removeClass("hidden");
                                               $("#business_prop_btn").addClass("hidden");
                                               var lead_id = $("#last_inserted_id").val();
                                               
                                               $.ajax({
                                                     url : "get_home_details",
                                                     method : "POST",
                                                     data : {lead_id : lead_id},
                                                     success:function(response)
                                                     {
                                                            $.ajax({
                                                                 url : "get_home_details",
                                                                 method : "POST",
                                                                 data : {lead_id:lead_id},
                                                                 success:function(response)
                                                                 {
                                                                      var obj = jQuery.parseJSON(response);
                                                                      
                                                                      if(obj != null)
                                                                      {
                                                                          $("#home_pro_div").removeClass("hidden");
                                                                          $("#business_pro_div").addClass("hidden");
                                                                          $("#home_pro_div").removeClass("hidden");
                                                                          $("#add_prop_btn").addClass("hidden");
                                                                          $("#edit_home_prop_btn").removeClass("hidden");
                                                                          
                                                                          $("#housing_type").val(obj.house_type);
                                                                          $("#policy_tensure").val(obj.home_policy_tenure);
                                                                          $("#property_value").val(obj.home_property_value);
                                                                          $("#interior_furniture").val(obj.home_interior);
                                                                          $("#tenant_or_owner").val(obj.owner_type);
                                                                          $("#age_of_premises").val(obj.home_age_premises);
                                                                          $("#built_up_area").val(obj.home_sqft);
                                                                          $("#air_conditionor_amt").val(obj.home_ac);
                                                                      }
                                                                      else
                                                                      {
                                                                           $("#home_pro_div").addClass("hidden");
                                                                      }
                                                                 }
                                                           });
                                                     }
                                               });
                                               
                                           }
                                           else
                                           {
                                               $("#add_prop_btn").addClass("hidden");
                                               $("#business_prop_btn").removeClass("hidden");
                                               
                                               var lead_id = $("#last_inserted_id").val();
                                                
                                               $.ajax({
                                                     url : "get_business_details",
                                                     method : "POST",
                                                     data : {lead_id:lead_id},
                                                     success:function(response)
                                                     {
                                                          var obj = jQuery.parseJSON(response);
                                                          if(obj != null)
                                                          {
                                                              $("#business_pro_div").removeClass("hidden");
                                                              $("#home_pro_div").addClass("hidden");
                                                              $("#business_prop_btn").addClass("hidden");
                                                              $("#edit_business_prop_btn").removeClass("hidden");
                                                              
                                                              $("#b_tenant_or_owner").val(obj.owner_type);
                                                              $("#b_proffession").val(obj.profession);
                                                              $("#b_property_value").val(obj.business_property_value);
                                                              $("#b_age_of_premise").val(obj.business_age_premises);
                                                              $("#b_interior_furniture").val(obj.business_interior);
                                                              $("#b_built_up_area").val(obj.business_sqft);
                                                              $("#b_air_conditionor_amt").val(obj.business_ac);
                                                          }
                                                          else
                                                          {
                                                               $("#business_pro_div").addClass("hidden");
                                                          }
                                                     }
                                               });
                                           }
                                       }
                                       else if(obj.class == "5")
                                       {
                                           var lead_id = $("#last_inserted_id").val();
                                            $("#maraine_box").removeClass("hidden");
                                        
                                        $.ajax({
                                                   url : "get_maraine_details",
                                                   method : "POST",
                                                   data : {lead_id:lead_id},
                                                   success:function(response)
                                                   {
                                                        var obj = jQuery.parseJSON(response);
                                                        
                                                        if(response != "" || response != null)
                                                        {
                                                            $("#maraine_div").removeClass("hidden");
                                                            $("#add_maraine_btn").addClass("hidden");
                                                            $("#edit_maraine_btn").removeClass("hidden");
                                                            $("#m_transit_policy").val(obj["maraine_details"].type);
                                                            $("#m_marine_transport").val(obj["maraine_details"].transport_mode);
                                                            $("#m_marine_cummodity").val(obj["maraine_details"].commodity);
                                                            $("#m_marine_sub_cummodity").html(obj["sub_commodity"]);
                                                            $("#m_marine_sub_cummodity").val(obj["maraine_details"].sub_commodity);
                                                            $("#m_marine_company_name").val(obj["maraine_details"].company_name);
                                                            $("#m_marine_city_name").val(obj["maraine_details"].city_name);
                                                            $("#m_marine_invoice_val").val(obj["maraine_details"].invoice_value);
                                                            $("#m_marine_invoice_10per_val").val(obj["maraine_details"].sum_invoice);
                                                        }
                                                   }
                                            });
                                       }
                                       else if(obj.class == "16")
                                       {
                                          var lead_id = $("#last_inserted_id").val();
                                          $("#pet_hidden").removeClass("hidden");
                                           
                                           $.ajax({
                                                     url : "get_pet_details",
                                                     method : "POST",
                                                     data : {lead_id: lead_id},
                                                     success:function(response)
                                                     {
                                                         var obj = jQuery.parseJSON(response); 
                                                           if(response != "" || response != null)
                                                           {
                                                            $("#edit_pet_name").val(obj.name);
                                                            $("#edit_pet_gender").val(obj.gender);
                                                            $("#edit_pet_age").val(obj.age_in_months);
                                                            $("#edit_pet_height").val(obj.height_in_ft);
                                                            $("#edit_pet_weight").val(obj.weight_in_kg);
                                                            
                                                            $("#pet_div").removeClass("hidden");
                                                            $("#add_pet_btn").addClass("hidden");
                                                            $("#edit_pet_btn").removeClass("hidden");
                                                           }
                                                     }
                                             });
                                       }
                                }
                                
                                $("#lead_generated_date").val(obj.lead_generated_date);
                                $("#due_date").val(obj.due_date);
                                $("#lead_Status").val(obj.lead_status);
                                
                                if(obj.next_follow_up_date != "")
                                {
                                    $("#edit_follow_up_btn").removeClass("hidden");
                                }
                                
                                $("#next_follow_date").val(obj.next_follow_up_date);
                                
                                if(obj.last_follow_up_date != "" && obj.last_follow_up_date != "0000-00-00")
                                {
                                   $("#last_follow_date").val(obj.last_follow_up_date);
                                }
                                else 
                                {
                                   
                                    $("#last_follow_date").val(obj.next_follow_up_date);
                                }
                                
                                $("#last_status_update").val(obj.follow_up_created_date);
                                
                                if(obj.next_follow_up_time != "" && obj.next_follow_up_time != "00:00:00")
                                {
                                   $("#next_follow_time").val(obj.next_follow_up_time); 
                                }
                                else
                                {
                                    $("#next_follow_time").val(""); 
                                }
                              
                               var  broken_policy = $('#broken_policy').val(obj.broken_policy);
                                  
                               if(broken_policy == "yes")   
                                {
                                    $("#broken_policy").prop("checked",true);
                                }
                                else
                                {
                                    $("#broken_policy").prop("checked",false);
                                }
                                 $("#location").val(obj.location);
                                 $("#classification").val(obj.classfication);
                                 $("#source").val(obj.source);
                                 $("#agent_pos").val(obj.agency_and_pos);
                                 $('#agent_pos').trigger('change');
                                 $("#assign_to_user").val(obj.assigned_user);
                                 $("#remarks").val(obj.remarks);
                            }
                        });
                        
                        $.ajax({
                               url : "get_vechile_details",
                               method : "POST",
                               data : {id:last_inserted_id},
                               success:function(response)
                               {
                                  var obj = jQuery.parseJSON(response);
                                  
                                   if(response != null || response != "")
                                    {
                                      
                                        $("#view_vechi_details").removeClass("hidden");  
                                        $("#edit_vechicle_btn").removeClass("hidden");
                                        $("#add_vechi_btn").addClass("hidden");
                                        $("#quotation_box_hidden").removeClass("hidden");
                                        $("#view_make_model").val(obj.brand_name+" "+obj.model_name+" "+obj.varient_name);
                                        $("#view_engine_no").val(obj.vechi_engine_num);
                                        $("#view_regn_no").val(obj.register_no);
                                        $("#view_chassis").val(obj.vechi_chassis_num);
                                    }
                                    else
                                    {
                                        $("#edit_vechicle_btn").addClass("hidden");
                                        $("#add_vechi_btn").removeClass("hidden");
                                        $("#view_vechi_details").addClass("hidden");
                                    }
                               }
                        });
                        
                       notification_log(last_inserted_id)
                    }

      $("#prospect_btn").click(function(){
          
            var last_inserted_id = $("#last_inserted_id").val();
            
            Swal.fire({
              title: 'Are you sure?',
              text: "Do you want convert this Lead to Prospect ?",
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Yes'
            }).then((result) => {
              if (result.isConfirmed) {
                  $.ajax({
                          url : "move_lead_to_prospect",
                          method : "POST",
                          data : {id:last_inserted_id},
                          success:function(response)
                          {
                               notification_log(last_inserted_id)
                                Swal.fire(
                                  '',
                                  'This Lead Has been Moved To Prospect.',
                                  'success'
                                )
                          }
                        });  
                  }
            })
      });
    
       $("#vechile_type").change(function(){
            var vechile_type = $("#vechile_type").val();
            $.ajax({
                    url : "fetch_make",
                    method : "POST",
                    data :{vechile_type:vechile_type},
                    beforeSend:function()
                    {
                        $("#vechi_make").prop("disabled",true);
                    },
                    success:function(response)
                    {
                         var obj = jQuery.parseJSON(response);
                           
                        var str = "<option value=''>--Select--</option>";
                        for(var j=0;j<obj.length;j++)
                        {
                            str += "<option value='"+obj[j].id+"'>"+obj[j].brand_name+"</option>";
                        }
                        $("#vechi_make").html(str);
                        $("#vechi_make").prop("disabled",false);
                    }
            });
             
       });  
       
       $("#vechi_make").change(function(){
            
            var vechile_type = $("#vechile_type").val();
            var vechi_make = $("#vechi_make").val();
            
            $.ajax({
                    url : "fetch_model",
                    method : "POST",
                    data :{vechile_type:vechile_type,vechi_make:vechi_make},
                    beforeSend:function()
                    {
                        $("#vechi_model").prop("disabled",true);
                    },
                    success:function(response)
                    {
                         var obj = jQuery.parseJSON(response);
                           
                        var str = "<option value=''>--Select--</option>";
                        for(var j=0;j<obj.length;j++)
                        {
                            str += "<option value='"+obj[j].id+"'>"+obj[j].model_name+"</option>";
                        }
                        $("#vechi_model").html(str);
                        $("#vechi_model").prop("disabled",false);
                    }
            });
             
       }); 

       $("#vechi_model").change(function(){
            
            var vechile_type = $("#vechile_type").val();
            var vechi_make = $("#vechi_make").val();
            var vechi_model = $("#vechi_model").val();
            
            $.ajax({
                    url : "fetch_vechile_varient",
                    method : "POST",
                    data :{vechile_type:vechile_type,vechi_make:vechi_make,vechi_model:vechi_model},
                    beforeSend:function()
                    {
                        $("#vechi_varient").prop("disabled",true);
                    },
                    success:function(response)
                    {
                         var obj = jQuery.parseJSON(response);
                           
                        var str = "<option value=''>--Select--</option>";
                        for(var j=0;j<obj.length;j++)
                        {
                            str += "<option value='"+obj[j].id+"'>"+obj[j].varient_name+"</option>";
                        }
                        $("#vechi_varient").html(str);
                        $("#vechi_varient").prop("disabled",false);
                    }
            });
             
       }); 
        
       $("#dob").change(function(){
                var dob = $("#dob").val();
                dob = new Date(dob);
                var today = new Date();
                var age = Math.floor((today-dob) / (365.25 * 24 * 60 * 60 * 1000));
                $('#age').val(age);
       });
       
       $("#add_follow_up_btn").click(function(){
           
           var id = $("#last_inserted_id").val();
           var follow_up_status = $("#follow_up_concluded").val();
           var follow_up_reason = $("#follow_up_reason").val();
           var enter_next_follow_date = $("#enter_next_follow_date").val();
           var enter_next_follow_time = $("#enter_next_follow_time").val();
           var follow_comment = $("#follow_comment").val();
           
           var check = 0;
           
           if(follow_up_status == "")
           {
               check = 1;
                    Swal.fire(
                    'Select Follow Up Concluded ?',
                    '',
                    'question'
                    )
           }
           else if(follow_up_reason === "")
           {
               check = 1;
               Swal.fire(
                    'Select Reason ?',
                    '',
                    'question'
                    )
           }
           else if(enter_next_follow_date == "")
           {
               check = 1;
               
                Swal.fire(
                    'Select Next Follow Up Date ?',
                    '',
                    'question'
                    )
           }
          else if(enter_next_follow_time == "")
           {
               check = 1;
               
               Swal.fire(
                    'Select Next Follow Up Time ?',
                    '',
                    'question'
                    )
           }
           else if(check != 1)
           {
            $.ajax({
                url : "add_follow_up_details",
                method : "POST",
                data :{id:id,follow_up_status:follow_up_status,follow_up_reason:follow_up_reason,enter_next_follow_date:enter_next_follow_date,enter_next_follow_time:enter_next_follow_time,follow_comment:follow_comment},
                beforeSend:function(){
                  $("#add_follow_up_btn").attr("disabled",true);  
                },
                success:function(response)
                {
                        Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'Follow up has been added successfully',
                        showConfirmButton: false,
                        timer: 1500
                        })
                    $("#add_follow_up_btn").attr("disabled",false);  
                    $("#add_model").modal("toggle");
                    var obj = jQuery.parseJSON(response)
                    {
                        if(obj.last_follow_up_date != "")
                        {
                        $("#last_follow_date").val(obj.last_follow_up_date);
                        }
                        else
                        {
                            $("#last_follow_date").val(enter_next_follow_date);
                        }
                    }
                    
                    $("#prospect_btn").removeClass("hidden");
                    $("#sms_btn").removeClass("hidden");
                    $("#policy_btn").removeClass("hidden");
                    
                     $("#next_follow_date").val(enter_next_follow_date);
                     $("#next_follow_time").val(enter_next_follow_time);
                     $("#last_status_update").val(obj.last_status_update);
                     notification_log(id)
                }
            })
            
           }
           
       });
       
      $("#reset_btn").click(function(){
           var follow_up_status = $("#follow_up_concluded").val("");
           var follow_up_reason = $("#follow_up_reason").val("");
           var enter_next_follow_date = $("#enter_next_follow_date").val("");
           var enter_next_follow_time = $("#enter_next_follow_time").val("");
           var follow_comment = $("#follow_comment").val("");
       });
       
      $("#policy_class").change(function(){
           var policy_class = $("#policy_class").val();
           $.ajax({
                url : "fetch_policy_type_using_class",
                method : "POST",
                data:{policy_class:policy_class},
                success:function(response)
                { 
                    var obj = jQuery.parseJSON(response);
                    
                    var str = "<option value=''>--Select--</option>";
                    for(var j=0;j<obj.length;j++)
                    {
                        str += "<option value='"+obj[j].id+"'>"+obj[j].policy_type+"</option>";
                    }
                    $("#policy_type").html(str);
                }
           });
           
           
       });
      
      $("#save_btn").click(function(){
             var client_type = $("#client_type").val();
             var client_name = $("#client_name").val();
             var mobile_no = $("#mobile_no").val();
             var other_contact_details = $("#other_contact_details").val();
             var landline_no= $("#landline_no").val();
             var address = $("#address").val();
             var email_id = $("#email_id").val();
             var contact_person_name =$("#cont_person_name").val();
             var contact_person_des = $("#cont_person_des").val();
             var dob = $("#dob").val();
             var age = $("#age").val();
             var area = $("#area").val();
             
             var bussiness_type = $("#bussiness_type").val();
             var policy_class = $("#policy_class").val();
             var policy_type = $("#policy_type").val();
             var lead_generated_date = $("#lead_generated_date").val();
             var due_date = $("#due_date").val();
            
             if($('#broken_policy').is(":checked"))
             {
                 var broken_policy = "Yes";
             }
             else
             {
                 var broken_policy = "No";
             }
             var location = $("#location").val();
             var classification = $("#classification").val();
             var source = $("#source").val();
             var agent_pos = $("#agent_pos").val();

             var assign_to_user = $("#assign_to_user").val();
             var remarks = $("#remarks").val();
            
             var check = 0;
             
             if(client_type == "")
             {
                 snackbar_show("Select Client Type");
                 check = 1;
             }
             else if(client_name == "")
             {
                 snackbar_show("Enter Client Name");
                 check = 1;
             }
             else if(mobile_no == "")
             {
                 snackbar_show("Enter Mobile no");
                 check = 1;
             }
             else if(bussiness_type == "")
             {
                 snackbar_show("Select Business Type");
                 check = 1;
             }
             else if(policy_class == "")
             {
                 snackbar_show("Select Class");
                 check = 1;
             }
             else if(policy_type == "")
             {
                 snackbar_show("Select Policy Type");
                 check = 1;
             }
             else if(lead_generated_date == "")
             {
                 snackbar_show("Select Lead Generated Date");
                 check = 1;
             }
             else if(check != 1)
             {
                 $.ajax({
                      url : "add_lead_details",
                      method : "POST",
                      data : {
                       client_type:client_type,
                       client_name:client_name,
                       mobile_no:mobile_no,
                       other_contact_details:other_contact_details,
                       landline_no:landline_no,
                       address:address,
                       email_id:email_id,
                       contact_person_name:contact_person_name,
                       contact_person_des:contact_person_des,
                       dob:dob,
                       age:age,
                       area:area,
                       bussiness_type:bussiness_type,
                       policy_class:policy_class,
                       policy_type:policy_type,
                       lead_generated_date:lead_generated_date,
                       due_date:due_date,
                       broken_policy:broken_policy,
                       location:location,
                       classification:classification,
                       source:source,
                       agent_pos:agent_pos,
                       assign_to_user:assign_to_user,
                       remarks:remarks
                      },
                      beforeSend:function(){
                          $("#save_btn").attr("disabled",true);
                      },
                      success:function(response){
                            Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'Lead Created Successfully',
                            showConfirmButton: false,
                            timer: 1500
                            });
                          $("#save_btn").attr("disabled",false);
                          
                          $("#save_btn").addClass("hidden");
                          $("#update_btn").removeClass("hidden");
                          $("#follow_up_hidden").removeClass("hidden");
                          $("#vechicle_hidden").removeClass("hidden");
                          window.location.href="leads";
                       },
                 });
             }
             
             
          });  
    
      $("#add_vechile_btn").click(function(){
           
          var id = $("#last_inserted_id").val();
          var vechile_type = "1";
          var policy_type = $("#vechile_type").val();
          var vechi_make = $("#vechi_make").val();
          var vechi_model = $("#vechi_model").val();
          var vechi_varient = $("#vechi_varient").val();
          var vechi_cc = $("#vechi_cc").val();
          var vechi_manu_month = $("#vechi_manu_month").val();
          var vechi_manu_year = $("#vechi_manu_year").val();
          var vechi_seating = $("#vechi_seating").val();
          var vechi_classfication = $("#vechi_classfication").val();
          var vechi_fuel_type = $("#vechi_fuel_type").val();
          var vechi_gvw = $("#vechi_gvw").val();
          var passenger_carrying = $("#passenger_carrying").val();
          var vechi_engine_num = $("#vechi_engine_num").val();
          var vechi_chassis_num = $("#vechi_chassis_num").val();
          var vechi_hypothecation = $("#vechi_hypothecation").val();
          var created_user = $("#created_user").val();
          var vechi_remarks = $("#vechi_remarks").val();
          var regn_no_1 = $("#regn_no_1").val();
          var regn_no_2 = $("#regn_no_2").val();
          var regn_no_3 = $("#regn_no_3").val();
          var regn_no_4 = $("#regn_no_4").val();
          var regn_date = $("#regn_date").val();
          var register_no = regn_no_1+"-"+ regn_no_2 +"-"+ regn_no_3 +"-"+regn_no_4; 
          var rto = $("#rto").val();
          var zone = $("#zone").val();
          var regn_address = $("#regn_address").val();
          var state = $("#state").val();
          var city = $("#city").val();
          var pincode = $("#pincode").val();
          var vechi_user_name = $("#vechi_user_name").val();
          var vechi_user_cont = $("#vechi_user_cont").val();
          
          var check = 0;
          
          if(policy_type == "")
          {
              check =1;
              Swal.fire(
                    'Select Vechicle Type?',
                    '',
                    'question'
                    )
          }
          else if(vechi_make == "")
          {
              check =1;
              Swal.fire(
                    'Select Vechicle Make ?',
                    '',
                    'question'
                    )
          }
          else if(vechi_model == "")
          {
              check =1;
              Swal.fire(
                    'Select Vechicle Model ?',
                    '',
                    'question'
                    )
          }
          else if(vechi_chassis_num == "")
          {
              check =1;
              Swal.fire(
                    'Enter Chassis Number ?',
                    '',
                    'question'
                    )
          }
          else if(pincode != "" && pincode.length != 6)
          {
                  check =1;
                   Swal.fire(
                        'Enter a valid Pincode ?',
                        '',
                        'question'
                        )
          }
          else if(check != 1)
          {
            var formdata = new FormData();
            formdata.append('id',id);
            formdata.append('vechile_type',vechile_type);
            formdata.append("policy_type",policy_type);
            formdata.append('vechi_make',vechi_make);
            formdata.append('vechi_model',vechi_model);
            formdata.append('vechi_varient',vechi_varient);
            formdata.append('vechi_cc',vechi_cc);
            formdata.append('vechi_manu_month',vechi_manu_month);
            formdata.append('vechi_manu_year',vechi_manu_year);
            formdata.append('vechi_seating',vechi_seating);
            formdata.append('vechi_classfication',vechi_classfication); 
            formdata.append('vechi_fuel_type',vechi_fuel_type);
            formdata.append('vechi_gvw',vechi_gvw);
            formdata.append('vechi_engine_num',vechi_engine_num);
            formdata.append('passenger_carrying',passenger_carrying);
            formdata.append('vechi_chassis_num',vechi_chassis_num);
            formdata.append('vechi_hypothecation',vechi_hypothecation);
            formdata.append('created_user',created_user);
            formdata.append('vechi_remarks',vechi_remarks);
            formdata.append('register_no',register_no);
            formdata.append('regn_date',regn_date);
            formdata.append('rto',rto);
            formdata.append('zone',zone);
            formdata.append('regn_address',regn_address);
            formdata.append('state',state);
            formdata.append('city',city);
            formdata.append('pincode',pincode);
            formdata.append('vechi_user_name',vechi_user_name);
            formdata.append('vechi_user_cont',vechi_user_cont);
            
            $.ajax({
                url : "add_vechile_details",
                method : "POST",
                data:formdata,
                processData:false,  
                contentType:false,
                cache:false,
                dataType:'text',
                beforeSend:function(response)
                {
                    $('#add_vechile_btn').attr("disabled",true);
                },
                success:function(response)
                {
                      Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'Vechile Details Has Been Added Successfully',
                        showConfirmButton: false,
                        timer: 1500
                        })
                    $("#add_vechile_btn").attr("disabled",false);  
                    $("#add_vechile_model").modal("toggle");
                    
                      $("#edit_vechicle_btn").removeClass("hidden");
                      $("#add_vechi_btn").addClass("hidden");
                    
                     $("#view_vechi_details").removeClass("hidden"); 
                     
                   var id = $("#last_inserted_id").val();
                   
                        $.ajax({
                           url : "get_vechile_details",
                           method : "POST",
                           data : {id:id},
                           success:function(response)
                           {
                                var obj = jQuery.parseJSON(response);
                                if(response != null || response != "")
                                {
                                    $("#view_make_model").val(obj.brand_name+" "+obj.model_name+" "+obj.varient_name);
                                    $("#view_engine_no").val(obj.vechi_engine_num);
                                    $("#view_regn_no").val(obj.vechi_register_no);
                                    $("#view_chassis").val(obj.vechi_chassis_num);
                                }
                                
                                $("#quotation_box_hidden").removeClass("hidden");
                                
                                notification_log(id)
                           }
                        });
                }
            });
            
          }
       });
       
      $("#document_file").change(function(){
           var document_type = $("#document_type").val();
           var last_inserted_id = $("#last_inserted_id").val();
           var files = $("#document_file").prop('files')[0];
           var formdata = new FormData();
           formdata.append('file',files);
           formdata.append('id',last_inserted_id);
           formdata.append('document_type',document_type);
           
          $.ajax({
                type:"POST",
                url:"upload_document_files",
                data:formdata,
                processData:false,  
                contentType:false,
                cache:false,
                dataType:'text',
                success:function(response)
                {
                    var document_type = $("#document_type").val("");
                    var files = $("#document_file").val("");
                    $("#table_view").append(response);
           
                }
          });
            
       });
       
       // health
       
      $("#h_gender").change(function(){
            
            var gender = $("#h_gender").val();
            
            var html = "";
            
            if(gender != "Male")
            {
                html +="<option value='You'>You</option>";
                html +="<option value='Husband'>Husband</option>";
                html +="<option value='Daughter'>Daughter</option>";
                html +="<option value='Son'>Son</option>";
                html +="<option value='Father'>Father</option>";
                html +="<option value='Mother'>Mother</option>";
            }
            else
            {
                html +="<option value='You'>You</option>";
                html +="<option value='Wife'>Wife</option>";
                html +="<option value='Daughter'>Daughter</option>";
                html +="<option value='Son'>Son</option>";
                html +="<option value='Father'>Father</option>";
                html +="<option value='Mother'>Mother</option>";
            }
            $("#h_family_members").html(html);
             
       });
      
      $("#h_family_members").change(function(){
          
           var h_family_members = $("#h_family_members").val();
           var You = jQuery.inArray('You', h_family_members); 
           var gender = $("#h_gender").val();
           
           var content = "";
          
           if(You !="-1")
           {
                $("#you_div").removeClass("hidden");
           }
           
           var Husband = jQuery.inArray('Husband', h_family_members);
           var Wife = jQuery.inArray('Wife', h_family_members); 
         
           
           if(Wife !="-1")
           {
                $("#label_id").html("Wife");
                $("#husband_wife_div").removeClass("hidden");
           }
           
           if(Husband !="-1")
           {
                $("#label_id").html("Husband");
                $("#husband_wife_div").removeClass("hidden");
           }

           var Daughter = jQuery.inArray('Daughter', h_family_members); 
           var Son = jQuery.inArray('Son', h_family_members); 
           
           var Father = jQuery.inArray('Father', h_family_members); 
           var Mother = jQuery.inArray('Mother', h_family_members);
           
              if(Father != "-1")
               {
                $("#father_div").removeClass("hidden");
               }
               else
               {
                   $("#father_div").addClass("hidden");
               }
             if(Mother != "-1")
               {
                   $("#mother_div").removeClass("hidden");
               }
               else
               {
                   $("#mother_div").addClass("hidden");
               }
               
           var html ="";
           
           if(Daughter != '-1' && Son != "-1")
           {
                html += "<div class='col-md-6'><label>No of Daughter's</label>";
                html += "<input type='text' class='form-control' name='num_daughters' id='num_daughters' onkeyup='daughters()' value='1'>";
                html += "</div>";
                html += "<div class='col-md-6'>";
                html += "<label>No of Sons's</label>";
                html += "<input type='text' class='form-control' name='num_sons' onkeyup='sons()' id='num_sons' value='1'>";
                html += "</div>";
                
                $("#daughter_div1").removeClass("hidden");
                $("#son_div1").removeClass("hidden");
           }
           else if(Daughter != '-1')
           {
                html += "<div class='col-md-12'><label>No of Daughter's</label>";
                html += "<input type='text' class='form-control' name='num_daughters' onkeyup='daughters()' id='num_daughters' value='1'>";
                html += "</div>";
                $("#daughter_div1").removeClass("hidden");
                $("#son_div1").addClass("hidden");
           }
           else if(Son != '-1')
           {
                html += "<div class='col-md-12'>";
                html += "<label>No of Sons's</label>";
                html += "<input type='text' class='form-control' name='num_sons' id='num_sons' onkeyup='sons()' value='1'>";
                html += "</div>";
                $("#daughter_div1").addClass("hidden");
                $("#son_div1").removeClass("hidden");
           }
           else
           {
               html +="";
           }
           $("#row_id").html(html);
           
        });
       
      $("#add_health_btn").click(function(){
           var lead_id = $("#last_inserted_id").val();
           var h_gender = $("#h_gender").val();
           var h_family_members = $("#h_family_members").val();
           var num_daughters = $("#num_daughters").val();
           var num_sons = $("#num_sons").val();
           var you_age = $("#you_age").val();
           var hus_wife_age = $("#hus_wife_age").val();
           
           var created_id = $("#created_id").val();
          
           if(h_gender == "Male")
           {
               for(var i=0;i<h_family_members.length;i++)
               {
                   if(h_family_members[i] =="You")
                   {
                       Husband = 1;
                       Husband_age = $("#you_age").val();
                   }

                   if(h_family_members[i] == "Wife")
                   {
                       Wife = 1;
                       Wife_age = $("#hus_wife_age").val();
                   }
                   
                   
                   if(h_family_members[i] == "Son")
                   {
                       Son = 1;
                   }
                   
                   
                   if(h_family_members[i] == "Daughter")
                   {
                      Daughter = 1; 
                   }
                 
                   
                   if(h_family_members[i] == "Father")
                   {
                       Father = 1;
                   }
                 
                   if(h_family_members[i] == "Mother")
                   {
                       Mother = 1;
                   }
               }
           }
           else if(h_gender == "Female")
           {
               
             for(var i=0;i<h_family_members.length;i++)
               {
                  if(h_family_members[i] == "You")
                   {
                       Wife = 1;
                       Wife_age = $("#you_age").val();
                   }
                 
                   if(h_family_members[i] == "Husband")
                   {
                       Husband = 1;
                       Husband_age = $("#hus_wife_age").val();
                   }
                 
                   if(h_family_members[i] == "Son")
                   {
                       Son = 1;
                   }

                   if(h_family_members[i] == "Daughter")
                   {
                      Daughter = 1; 
                   }
                  
                   if(h_family_members[i] == "Father")
                   {
                       Father = 1;
                   }
                   if(h_family_members[i] == "Mother")
                   {
                       Mother = 1;
                   }
               }
                
               
           }
          
           var son_1_age = $("#son_age_1").val();
           var son_2_age = $("#son_age_2").val();
           var son_3_age = $("#son_age_3").val();
           var son_4_age = $("#son_age_4").val();
           var daughter_1_age = $("#daughter_age_1").val();
           var daughter_2_age = $("#daughter_age_2").val();
           var daughter_3_age = $("#daughter_age_3").val();
           var daughter_4_age = $("#daughter_age_4").val();
           var father_age = $("#father_age").val();
           var mother_age = $("#mother_age").val();
           
          var formdata = new FormData();
          
          formdata.append('created_id',created_id);
          formdata.append('lead_id',lead_id);
          formdata.append('h_gender',h_gender);
          formdata.append('Husband',Husband);
          formdata.append('Wife',Wife);
          formdata.append('Son',Son);
          formdata.append('Daughter',Daughter);
          formdata.append('Father',Father);
          formdata.append('Mother',Mother);
          formdata.append('Husband_age',Husband_age);
          formdata.append('Wife_age',Wife_age);
            formdata.append('num_daughters',num_daughters);
            formdata.append('num_sons',num_sons);
            formdata.append("son_1_age",son_1_age);
            formdata.append("son_2_age",son_2_age);
            formdata.append("son_3_age",son_3_age);
            formdata.append("son_4_age",son_4_age);
            formdata.append("daughter_1_age",daughter_1_age);
            formdata.append("daughter_2_age",daughter_2_age);
            formdata.append("daughter_3_age",daughter_3_age);
            formdata.append("daughter_4_age",daughter_4_age);
            formdata.append('father_age',father_age);
            formdata.append('mother_age',mother_age);
            
            $.ajax({
                    url : "add_health_details",
                    method : "POST",
                    data:formdata,
                    processData:false,  
                    contentType:false,
                    cache:false,
                    dataType:'text',
                beforeSend:function(){
                    $("#add_health_btn").attr("disabled",true);
                },
                success:function(response){
                          $("#add_health_btn").attr("disabled",false);
                          $("#add_health_model").modal("toggle");
                            Swal.fire({
                              position: 'top-end',
                              icon: 'success',
                              title: 'Health Details Has Been Added Successfully',
                              showConfirmButton: false,
                              timer: 1500
                            })
                            location.reload();
                }
                    
            });
       }); 
       
       // Edit Client
       
      $("#edit_client_btn").click(function(){
          
           let timerInterval
                Swal.fire({
                  title: 'Loading',
                  html: 'Fetch Client Data',
                  timer: 1000,
                  timerProgressBar: true,
                  didOpen: () => {
                    Swal.showLoading()
                    const b = Swal.getHtmlContainer().querySelector('b')
                    timerInterval = setInterval(() => {
                      b.textContent = Swal.getTimerLeft()
                    }, 100)
                  },
                  willClose: () => {
                    clearInterval(timerInterval)
                  }
                }).then((result) => {
                  /* Read more about handling dismissals below */
                  if (result.dismiss === Swal.DismissReason.timer) {
                    console.log('I was closed by the timer')
                  }
                })
           
            $("#client_type").attr("disabled",false);
            $("#client_name").attr("disabled",false);
            $("#mobile_no").attr("disabled",false);
            $("#other_contact_details").attr("disabled",false);
            $("#landline_no").attr("disabled",false);
            $("#address").attr("disabled",false);
            $("#email_id").attr("disabled",false);
            $("#cont_person_name").attr("disabled",false);
            $("#cont_person_des").attr("disabled",false);
            $("#dob").attr("disabled",false);
            $("#age").attr("disabled",false);
            $("#area").attr("disabled",false);
            
            $("#client_type").css("border-color", "#6ec3f5");
            $("#client_name").css("border-color", "#6ec3f5");
            $("#mobile_no").css("border-color", "#6ec3f5");
            $("#other_contact_details").css("border-color", "#6ec3f5");
            $("#landline_no").css("border-color", "#6ec3f5");
            $("#address").css("border-color", "#6ec3f5");
            $("#email_id").css("border-color", "#6ec3f5");
            $("#cont_person_name").css("border-color", "#6ec3f5");
            $("#cont_person_des").css("border-color", "#6ec3f5");
            $("#dob").css("border-color", "#6ec3f5");
            $("#age").css("border-color", "#6ec3f5");
            $("#area").css("border-color", "#6ec3f5");
            
            $("#edit_client_btn").addClass("hidden");
            $("#update_client_btn").removeClass("hidden");
            
      });
      
      $("#update_client_btn").click(function(){
          
         var lead_id = $("#last_inserted_id").val();
         var client_type = $("#client_type").val();
         var client_name = $("#client_name").val();
         var mobile_no = $("#mobile_no").val();
         var other_contact_details = $("#other_contact_details").val();
         var landline_no= $("#landline_no").val();
         var address = $("#address").val();
         var email_id = $("#email_id").val();
         var contact_person_name =$("#cont_person_name").val();
         var contact_person_des = $("#cont_person_des").val();
         var dob = $("#dob").val();
         var age = $("#age").val();
         var area = $("#area").val();
         
         $.ajax({
                url : "update_client_details",
                method : "POST",
                data:{
                       lead_id : lead_id,
                       client_type:client_type,
                       client_name:client_name,
                       mobile_no:mobile_no,
                       other_contact_details:other_contact_details,
                       landline_no:landline_no,
                       address:address,
                       email_id:email_id,
                       contact_person_name:contact_person_name,
                       contact_person_des:contact_person_des,
                       dob:dob,
                       age:age,
                       area:area,
                },
                beforeSend:function(){
                    $("#update_client_btn").attr("disabled",true);
                },
                success:function(response)
                {
                        Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'Client Details updated Successfully',
                        showConfirmButton: false,
                        timer: 1500
                        })
                    $("#update_client_btn").attr("disabled",false);
                    window.location.href="create_lead?id="+lead_id;
                    notification_log(lead_id)
                }
         });
         
      });
      
      // Edit Requirement Details
      
      $("#edit_req_btn").click(function(){
          
          let timerInterval
                Swal.fire({
                  title: 'Loading',
                  html: 'Fetch Requirement Details',
                  timer: 1000,
                  timerProgressBar: true,
                  didOpen: () => {
                    Swal.showLoading()
                    const b = Swal.getHtmlContainer().querySelector('b')
                    timerInterval = setInterval(() => {
                      b.textContent = Swal.getTimerLeft()
                    }, 100)
                  },
                  willClose: () => {
                    clearInterval(timerInterval)
                  }
                }).then((result) => {
                  /* Read more about handling dismissals below */
                  if (result.dismiss === Swal.DismissReason.timer) {
                    console.log('I was closed by the timer')
                  }
                })
          
            $("#bussiness_type").attr("disabled",false);
            $("#policy_class").attr("disabled",false);
            $("#policy_type").attr("disabled",false);
            $("#location").attr("disabled",false);
            $("#classification").attr("disabled",false);
            $("#source").attr("disabled",false);
            $("#agent_pos").attr("disabled",false);
            $("#assign_to_user").attr("disabled",false);
            $("#remarks").attr("disabled",false);
            
            $("#bussiness_type").css("border-color", "#6ec3f5");
            $("#policy_class").css("border-color", "#6ec3f5");
            $("#policy_type").css("border-color", "#6ec3f5");
            $("#location").css("border-color", "#6ec3f5");
            $("#classification").css("border-color", "#6ec3f5");
            $("#source").css("border-color", "#6ec3f5");
            $("#agent_pos").attr("disabled",false);
            $("#assign_to_user").css("border-color", "#6ec3f5");
            $("#remarks").css("border-color", "#6ec3f5");
            $("#edit_req_btn").addClass("hidden");
            $("#update_req_btn").removeClass("hidden");
          
        });
      
      $("#update_req_btn").click(function(){
             var lead_id = $("#last_inserted_id").val();
             var bussiness_type = $("#bussiness_type").val();
             var policy_class = $("#policy_class").val();
             var policy_type = $("#policy_type").val();
             var lead_generated_date = $("#lead_generated_date").val();
             var due_date = $("#due_date").val();
            
             if($('#broken_policy').is(":checked"))
             {
                 var broken_policy = "Yes";
             }
             else
             {
                 var broken_policy = "No";
             }
             var location = $("#location").val();
             var classification = $("#classification").val();
             var source = $("#source").val();
             var agent_pos = $("#agent_pos").val();
             var assign_to_user = $("#assign_to_user").val();
             var remarks = $("#remarks").val();
             
             $.ajax({
                 url : "update_requirement_details",
                 method : "POST",
                 data :{
                       lead_id : lead_id,
                       bussiness_type:bussiness_type,
                       policy_class:policy_class,
                       policy_type:policy_type,
                       lead_generated_date:lead_generated_date,
                       due_date:due_date,
                       broken_policy:broken_policy,
                       location:location,
                       classification:classification,
                       source:source,
                       agent_pos:agent_pos,
                       assign_to_user:assign_to_user,
                       remarks:remarks},
                 beforeSend:function()
                 {
                     $("#update_req_btn").attr("disabled",true);
                 },
                 success:function(response)
                 {
                     
                      Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'Requirement Details updated Successfully',
                        showConfirmButton: false,
                        timer: 1500
                        })
                    $("#update_req_btn").attr("disabled",false);
                    window.location.href="create_lead?id="+lead_id;
                    notification_log(lead_id)
                 }
                 
             });
          
      });  
      
      // Edit vechile Details //
      
      $("#edit_vechicle_btn").click(function(){
         
         var lead_id = $("#last_inserted_id").val();
         
         $.ajax({
                 url : "fetch_edit_vechicle_details",
                 method : "POST",
                 data : {lead_id:lead_id},
                 success:function(response)
                 {
                    var obj = jQuery.parseJSON(response);
                    $("#edit_vechicle_id").val(obj.id);
                    $("#edit_vechile_type").val(obj.vechile_type);
                    
                    $.ajax({
                            url : "fetch_make",
                            method : "POST",
                            data :{vechile_type:obj.vechile_type},
                            success:function(response)
                            {
                              var object = jQuery.parseJSON(response);
                              
                                if(object.length > 0)
                                {
                                    var str = "<option value=''>--Select--</option>";
                                    
                                    for(var j=0;j<object.length;j++)
                                    {
                                        if(obj.vechi_make == object[j].id)
                                        {
                                            str += "<option value='"+object[j].id+"' selected>"+object[j].brand_name+"</option>";
                                        }
                                        else
                                        {
                                             str += "<option value='"+object[j].id+"'>"+object[j].brand_name+"</option>";
                                        }
                                    }
                                    $("#edit_vechi_make").html(str);
                                }
                            }
                    });
                    
                    
                    $("#edit_vechi_make").val(obj.vechi_make);
                    $("#edit_vechi_make").trigger('change');
                    
                     $.ajax({
                            url : "fetch_model",
                            method : "POST",
                            data :{vechile_type:obj.vechile_type,vechi_make:obj.vechi_make},
                            
                            success:function(response)
                            {
                              var object = jQuery.parseJSON(response);
                              
                                if(object.length > 0)
                                {
                                    var str = "<option value=''>--Select--</option>";
                                    
                                    for(var j=0;j<object.length;j++)
                                    {
                                        if(obj.vechi_model == object[j].id)
                                        {
                                            str += "<option value='"+object[j].id+"' selected>"+object[j].model_name+"</option>";
                                        }
                                        else
                                        {
                                             str += "<option value='"+object[j].id+"'>"+object[j].model_name+"</option>";
                                        }
                                    }
                                    $("#edit_vechi_model").html(str);
                                }
                            }
                    });
                    
                    $("#edit_vechi_model").val(obj.vechi_model);
                    $("#edit_vechi_model").trigger('change');
                    
                     $.ajax({
                            url : "fetch_vechile_varient",
                            method : "POST",
                            data :{vechile_type:obj.vechile_type,vechi_make:obj.vechi_make,vechi_model:obj.vechi_model},
                            
                            success:function(response)
                            {
                              var object = jQuery.parseJSON(response);
                              
                                if(object.length > 0)
                                {
                                    var str = "<option value=''>--Select--</option>";
                                    
                                    for(var j=0;j<object.length;j++)
                                    {
                                        if(obj.vechi_varient == object[j].id)
                                        {
                                            str += "<option value='"+object[j].id+"' selected>"+object[j].varient_name+"</option>";
                                        }
                                        else
                                        {
                                             str += "<option value='"+object[j].id+"'>"+object[j].varient_name+"</option>";
                                        }
                                    }
                                    $("#edit_vechi_varient").html(str);
                                }
                            }
                    });
                    
                    $("#edit_vechi_varient").val(obj.vechi_varient);
                    $("#edit_vechi_varient").trigger('change');
                    
                    $("#edit_vechi_cc").val(obj.vechi_cc);
                    $("#edit_vechi_manu_month").val(obj.vechi_manu_month);
                    $("#edit_vechi_manu_year").val(obj.vechi_manu_year);
                    $("#edit_vechi_seating").val(obj.vechi_seating);
                    $("#edit_vechi_classfication").val(obj.vechi_classfication);
                    $("#edit_vechi_fuel_type").val(obj.vechi_fuel_type);
                    $("#edit_vechi_gvw").val(obj.vechi_gvw);
                    $("#edit_passenger_carrying").val(obj.passenger_carrying);
                    $("#edit_vechi_engine_num").val(obj.vechi_engine_num);
                    $("#edit_vechi_chassis_num").val(obj.vechi_chassis_num);
                    $("#edit_vechi_hypothecation").val(obj.vechi_hypothecation);
                    $("#edit_vechi_remarks").val(obj.vechi_remarks);
                    $("#edit_regn_date").val(obj.regn_date);
                    
                     var reg_num = obj.vechi_register_no.split("-");
                     var j = 0;
                     
                     for(var i=0;i<reg_num.length;i++)
                     {
                         j++;
                         $("#edit_regn_no_"+j).val(reg_num[i]);
                     }
                    
                    
                    $("#edit_rto").val(obj.rto);
                    $("#edit_zone").val(obj.zone);
                    $("#edit_regn_address").val(obj.regn_address);
                    $("#edit_state").val(obj.state);
                    $('#edit_state').trigger('change');
                    $("#edit_city").val(obj.city);
                    $("#edit_pincode").val(obj.pincode);
                    $("#edit_vechi_user_name").val(obj.vechi_user_name);
                    $("#edit_vechi_user_cont").val(obj.vechi_user_cont);
                    
                    $.ajax({
                        url : "get_uploaded_vechicle_documents",
                        method : "POST",
                        data : {lead_id:lead_id},
                        success:function(response)
                        {
                           $("#edit_table_view").html(response);
                        }
                    });
                    $("#edit_vechile_model").modal("toggle");
                 }
         });
          
      });
      
      $("#edit_doc_btn").click(function(){
           
            var id = $("#edit_doc_id").val();
            var document_type = $("#edit_document_type").val();
            var files = $("#edit_vechi_doc").prop('files')[0];
            
            var check = 0 ;
            
            if(document_type === "")
            {
                check = 1;
                    Swal.fire(
                    'Select Document Type ?',
                    'That thing is still around?',
                    'question'
                    )
            }
            else if(check != 1)
            {
                var formdata = new FormData();
                formdata.append('id',id);
                formdata.append('document_type',document_type);
                formdata.append('file',files);
                
                $.ajax({
                        url : "edit_vehicle_documents",
                        method : "POST",
                        data:formdata,
                        processData:false,  
                        contentType:false,
                        cache:false,
                        dataType:'text',
                        beforeSend:function()
                        {
                        $("#edit_doc_btn").attr("disabled",true);
                        },
                        success:function(response)
                        {
                            $("#edit_doc_mod").modal("hide");
                            $("#edit_document_type").val("");
                            $("#edit_vechi_doc").val("");
                            $("#edit_table_view").html(response);
                            
                        }
                 });
            }
       });
       
      $("#update_vechile_btn").click(function(){
           
          var lead_id = $("#last_inserted_id").val();
          var  id = $("#edit_vechicle_id").val();
          var vechile_type = $("#edit_vechile_type").val();
          var vechi_make = $("#edit_vechi_make").val();
          var vechi_model = $("#edit_vechi_model").val();
          var vechi_varient = $("#edit_vechi_varient").val();
          var vechi_cc = $("#edit_vechi_cc").val();
          var vechi_manu_month = $("#edit_vechi_manu_month").val();
          var vechi_manu_year = $("#edit_vechi_manu_year").val();
          var vechi_seating = $("#edit_vechi_seating").val();
          var vechi_classfication = $("#edit_vechi_classfication").val();
          var vechi_fuel_type = $("#edit_vechi_fuel_type").val();
          var vechi_gvw = $("#edit_vechi_gvw").val();
          var passenger_carrying = $("#edit_passenger_carrying").val();
          var vechi_engine_num = $("#edit_vechi_engine_num").val();
          var vechi_chassis_num = $("#edit_vechi_chassis_num").val();
          var vechi_hypothecation = $("#edit_vechi_hypothecation").val();
          var created_user = $("#edit_created_user").val();
          var vechi_remarks = $("#edit_vechi_remarks").val();
          var regn_no_1 = $("#edit_regn_no_1").val();
          var regn_no_2 = $("#edit_regn_no_2").val();
          var regn_no_3 = $("#edit_regn_no_3").val();
          var regn_no_4 = $("#edit_regn_no_4").val();
          var regn_date = $("#edit_regn_date").val();
          var register_no = regn_no_1+"-"+ regn_no_2 +"-"+ regn_no_3 +"-"+regn_no_4; 
          var rto = $("#edit_rto").val();
          var zone = $("#edit_zone").val();
          var regn_address = $("#edit_regn_address").val();
          var state = $("#edit_state").val();
          var city = $("#edit_city").val();
          var pincode = $("#edit_pincode").val();
          var vechi_user_name = $("#edit_vechi_user_name").val();
          var vechi_user_cont = $("#edit_vechi_user_cont").val();
          
          var check = 0;
          
          if(vechile_type == "")
          {
              check =1;
              Swal.fire(
                    'Select Vechicle Type?',
                    '',
                    'question'
                    )
          }
          else if(vechi_make == "")
          {
              check =1;
              Swal.fire(
                    'Select Vechicle Make ?',
                    '',
                    'question'
                    )
          }
          else if(vechi_model == "")
          {
              check =1;
              Swal.fire(
                    'Select Vechicle Model ?',
                    '',
                    'question'
                    )
          }
          else if(vechi_chassis_num == "")
          {
              check =1;
              Swal.fire(
                    'Enter Chassis Number ?',
                    '',
                    'question'
                    )
          }
          else if(pincode != "" && pincode.length != 6)
          {
                  check =1;
                   Swal.fire(
                        'Enter a valid Pincode ?',
                        '',
                        'question'
                        )
          }
          else if(check != 1)
          {
            var formdata = new FormData();
            formdata.append('id',id);
            formdata.append('vechile_type',vechile_type);
            formdata.append('vechi_make',vechi_make);
            formdata.append('vechi_model',vechi_model);
            formdata.append('vechi_varient',vechi_varient);
            formdata.append('vechi_cc',vechi_cc);
            formdata.append('vechi_manu_month',vechi_manu_month);
            formdata.append('vechi_manu_year',vechi_manu_year);
            formdata.append('vechi_seating',vechi_seating);
            formdata.append('vechi_classfication',vechi_classfication); 
            formdata.append('vechi_fuel_type',vechi_fuel_type);
            formdata.append('vechi_gvw',vechi_gvw);
            formdata.append('vechi_engine_num',vechi_engine_num);
            formdata.append('passenger_carrying',passenger_carrying);
            formdata.append('vechi_chassis_num',vechi_chassis_num);
            formdata.append('vechi_hypothecation',vechi_hypothecation);
            formdata.append('created_user',created_user);
            formdata.append('vechi_remarks',vechi_remarks);
            formdata.append('register_no',register_no);
            formdata.append('regn_date',regn_date);
            formdata.append('rto',rto);
            formdata.append('zone',zone);
            formdata.append('regn_address',regn_address);
            formdata.append('state',state);
            formdata.append('city',city);
            formdata.append('pincode',pincode);
            formdata.append('vechi_user_name',vechi_user_name);
            formdata.append('vechi_user_cont',vechi_user_cont);
            
            $.ajax({
                url : "update_vechicle_details",
                method : "POST",
                data:formdata,
                processData:false,  
                contentType:false,
                cache:false,
                dataType:'text',
                beforeSend:function(response)
                {
                    $('#update_vechile_btn').attr("disabled",true);
                },
                success:function(response)
                {
                    $('#update_vechile_btn').attr("disabled",false);
                      Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'Vechile Details Has Been Updated Successfully',
                        showConfirmButton: false,
                        timer: 1500
                        })
                    $(".form-control").val();    
                    
                     var id = $("#last_inserted_id").val();
                   
                        $.ajax({
                           url : "get_vechile_details",
                           method : "POST",
                           data : {id:id},
                           success:function(response)
                           {
                                var obj = jQuery.parseJSON(response);
                                if(response != null || response != "")
                                {
                                    $("#view_make_model").val(obj.brand_name+" "+obj.model_name+" "+obj.varient_name);
                                    $("#view_engine_no").val(obj.vechi_engine_num);
                                    $("#view_regn_no").val(obj.vechi_register_no);
                                    $("#view_chassis").val(obj.vechi_chassis_num);
                                }
                                notification_log(lead_id)
                           }
                        });
                    $("#edit_vechile_model").modal("toggle");
                }
            });
          }
       });
       
       $(".inputs").keyup(function () {
            if (this.value.length == this.maxLength) {
              $(this).next('.inputs').focus();
            }
        });
       
       $("#edit_vechile_type").change(function(){
            var vechile_type = $("#edit_vechile_type").val();
            $.ajax({
                    url : "fetch_make",
                    method : "POST",
                    data :{vechile_type:vechile_type},
                    beforeSend:function()
                    {
                        $("#edit_vechi_make").prop("disabled",true);
                    },
                    success:function(response)
                    {
                         var obj = jQuery.parseJSON(response);
                           
                        var str = "<option value=''>--Select--</option>";
                        for(var j=0;j<obj.length;j++)
                        {
                            str += "<option value='"+obj[j].id+"'>"+obj[j].brand_name+"</option>";
                        }
                        $("#edit_vechi_make").html(str);
                        $("#edit_vechi_make").prop("disabled",false);
                    }
            });
             
       });  
       
       $("#edit_vechi_make").change(function(){
            
            var vechile_type = $("#edit_vechile_type").val();
            var vechi_make = $("#edit_vechi_make").val();
            
            $.ajax({
                    url : "fetch_model",
                    method : "POST",
                    data :{vechile_type:vechile_type,vechi_make:vechi_make},
                    beforeSend:function()
                    {
                        $("#edit_vechi_model").prop("disabled",true);
                    },
                    success:function(response)
                    {
                        var obj = jQuery.parseJSON(response);
                           
                        var str = "<option value=''>--Select--</option>";
                        for(var j=0;j<obj.length;j++)
                        {
                            str += "<option value='"+obj[j].id+"'>"+obj[j].model_name+"</option>";
                        }
                        $("#edit_vechi_model").html(str);
                        $("#edit_vechi_model").prop("disabled",false);
                    }
            });
             
       }); 

       $("#edit_vechi_model").change(function(){
            
            var vechile_type = $("#edit_vechile_type").val();
            var vechi_make = $("#edit_vechi_make").val();
            var vechi_model = $("#edit_vechi_model").val();
            
            $.ajax({
                    url : "fetch_vechile_varient",
                    method : "POST",
                    data :{vechile_type:vechile_type,vechi_make:vechi_make,vechi_model:vechi_model},
                    beforeSend:function()
                    {
                        $("#edit_vechi_varient").prop("disabled",true);
                    },
                    success:function(response)
                    {
                         var obj = jQuery.parseJSON(response);
                           
                        var str = "<option value=''>--Select--</option>";
                        for(var j=0;j<obj.length;j++)
                        {
                            str += "<option value='"+obj[j].id+"'>"+obj[j].varient_name+"</option>";
                        }
                        $("#edit_vechi_varient").html(str);
                        $("#edit_vechi_varient").prop("disabled",false);
                    }
            });
             
       });
       
       // add quotation
       
       $("#add_quote_btn").click(function(){ 
          var lead_id = $("#last_inserted_id").val();
          
          $.ajax({
                 url : "get_basic_informations",
                 method : "POST",
                 data : {lead_id:lead_id},
                 success:function(response)
                 {
                     var obj = jQuery.parseJSON(response);
                     $("#q_class").val(obj["basic_details"].class_name);
                     $("#q_policy_type").val(obj["basic_details"].policy_type_name);
                     $("#q_client_name").val(obj["basic_details"].client_name);
                     $("#q_make_model").val(obj["vechi_details"].brand_name+" / "+obj["vechi_details"].model_name+" / "+obj["vechi_details"].varient_name);
                     
                     $("#q_rto_code").val(obj["vechi_details"].rto);
                     $("#q_zone").val(obj["vechi_details"].zone);
                     $("#q_vechi_classification").val(obj["vechi_details"].vechi_classfication);
                     
                     var manu_month = obj["vechi_details"].vechi_manu_month;
                     var manu_year = obj["vechi_details"].vechi_manu_year;
                     
                     if(manu_month != "" && manu_year != "")
                     {
                        var vechi_age = manu_year+"-"+manu_month+"-"+"01";
                        vechi_age = new Date(vechi_age);
                        var today = new Date();
                        var vechi_age = Math.floor((today-vechi_age) / (365.25 * 24 * 60 * 60 * 1000));
                        $('#q_vechi_age').val(vechi_age);
                     }
                     
                     $("#add_quotation_model").modal("toggle");
                 }
          });
       });
       
       $("#q_idv").change(function(){
           var IDV = $("#q_idv").val();
           $("#q_sum_insured").val(IDV);  
       });
       
       $("#add_quotation").click(function(){
            var lead_id = $("#last_inserted_id").val();
            var policy_co_cover_type = $("#policy_co_cover_type").val();
            var q_policy_term = $("#q_policy_term").val();
            var q_policy_s_date = $("#q_policy_s_date").val();
            var q_policy_ex_date = $("#q_policy_ex_date").val();
            var q_insurer = $("#q_insurer").val();
            var q_insurer_branch = $("#q_insurer_branch").val();
            var q_idv = $("#q_idv").val();
            var q_elec_access_value = $("#q_elec_access_value").val();
            var q_non_elec_access_value = $("#q_non_elec_access_value").val();
            var q_lpg_cng = $('#q_lpg_cng').val();
            var q_sum_insured = $("#q_sum_insured").val();
            var q_make_model = $("#q_make_model").val();
            var q_vechi_age = $("#q_vechi_age").val();
            var q_rto_code = $("#q_rto_code").val();
            var q_zone = $("#q_zone").val();
            var q_cubic_capactiy = $("#q_cubic_capactiy").val();
            var q_vechi_classification  = $("#q_vechi_classification").val();
            var q_basic_od_percentage = $("#q_basic_od_percentage").val();
            var q_basic_od_amount = $("#q_basic_od_amount").val();
            var q_spl_dis_per = $("#q_spl_dis_per").val();
            var q_spl_dis_amount = $("#q_spl_dis_amount").val();
            var q_spl_loading_per = $("#q_spl_loading_per").val();
            var q_spl_loading_amount = $("#q_spl_loading_amount").val();
            var q_non_basic_od = $("#q_non_basic_od").val();
            var q_non_elec_acc_amount = $("#q_non_elec_acc_amount").val();
            
            var q_bi_fuel_kit = $("#q_bi_fuel_kit").val();
            var q_basic_od1 = $("#q_basic_od1").val();
            var q_geographical_area = $("#q_geographical_area").val();
            var q_geographical_amount = $("#q_geographical_amount").val();
            var q_emp_loading =  $("#q_emp_loading").val();
            var q_emp_loading_amount = $("#q_emp_loading_amount").val();
            var q_fiber_class_tank = $("#q_fiber_class_tank").val();
            var q_fiber_class_tank_amount = $("#q_fiber_class_tank_amount").val();
            var q_driving_tuitions = $("#q_driving_tuitions").val();
            var q_basic_od2 = $("#q_basic_od2").val();
            var q_basic_od2_amount = $("#q_basic_od2_amount").val();
            
            var q_anti_theft = $("#q_anti_theft").val();
            var q_anti_theft_amount = $("#q_anti_theft_amount").val();
            var q_anti_handicap = $("#q_anti_handicap").val();
            var q_anti_handicap_amount = $("#q_anti_handicap_amount").val();
            var q_aai = $("#q_aai").val();
            var q_aai_amount = $("#q_aai_amount").val();
            var q_voluntary_deductable = $("#q_voluntary_deductable").val();
            var q_voluntary_deductable_amount = $("#q_voluntary_deductable_amount").val();
            var q_basic_od_3 = $("#q_basic_od_3").val();
            var q_ncb_percentage = $("#q_ncb_percentage").val();
            var q_ncb_percentage_amount = $("#q_ncb_percentage_amount").val();
            
            var q_basic_tp = $("#q_basic_tp").val();
            var q_fuel_kit_amt = $("#q_fuel_kit_amt").val();
            var q_basic_tp1 = $("#q_basic_tp1").val();
            var q_geograpical_amt = $("#q_geograpical_amt").val();
            var q_owner_diver_amt = $("#q_owner_diver_amt").val();
            var q_no_of_year_own_drv = $("#q_no_of_year_own_drv").val();
            var q_un_named_passenger_pa = $("#q_un_named_passenger_pa").val();
            var q_un_named_passenger_amt = $("#q_un_named_passenger_amt").val();
            var q_no_seats_per_person = $("#q_no_seats_per_person").val();
            var q_no_seats_per_person_amt = $("#q_no_seats_per_person_amt").val();
            
            var q_tot_od_premium = $("#q_tot_od_premium").val();
            
            var q_llp = $("#q_llp").val();
            var q_llp_amt = $("#q_llp_amt").val();
            var q_no_drv_emp = $("#q_no_drv_emp").val();
            var q_pa_paid_drv = $("#q_pa_paid_drv").val();
            var q_pa_paid_drv_amt = $("#q_pa_paid_drv_amt").val();
            var q_no_seats_per_person1 = $("#q_no_seats_per_person1").val();
            var q_no_seats_per_person_amt1 = $("#q_no_seats_per_person_amt1").val();
            var q_tot_tp_premium = $("#q_tot_tp_premium").val();
            
            
            var q_add_on_combo_premium = $("#q_add_on_combo_premium").val();
            var q_add_on_plan_premium_percentage = $("#q_add_on_plan_premium_percentage").val();
            var q_add_on_plan_premium_amt = $("#q_add_on_plan_premium").val();
            
            
            if($("#q_zero_depreciation_check").is(":checked"))
            {
                var q_zero_depreciation_check = "Yes";
            }
            else
            {
                 var q_zero_depreciation_check = "No";
            }
            
            var q_zero_depreciation_percentage = $("#q_zero_depreciation_percentage").val();
            var q_zero_depreciation_amt = $("#q_zero_depreciation_amt").val();
            
            if($("#q_addtional_addons_check").is(":checked"))
            {
                var q_addtional_addons_check = "Yes";
            }
            else
            {
                var q_addtional_addons_check = "No";
            }
            var q_addtional_addons_amt = $("#q_addtional_addons_amt").val();
            
            if($("#q_consumbles_check").is(":checked"))
            {
                var q_consumbles_check = "Yes";
            }
            else
            {
                 var q_consumbles_check = "No";
            }
            
            var q_consumbles_percentage = $("#q_consumbles_percentage").val();
            var q_consumbles_amt = $("#q_consumbles_amt").val();
            if($("#q_tyre_cover").is(":checked"))
            {
                var q_tyre_cover = "Yes";
            }
            else
            {
                var q_tyre_cover = "No";
            }
            var q_tyre_cover_percentage = $("#q_tyre_cover_percentage").val();
            var q_tyre_cover_amt = $("#q_tyre_cover_amt").val();
            
            if($("#q_ncb_protection_check").is(":checked"))
            {
                var q_ncb_protection_check = "Yes";
            }
            else
            {
                var q_ncb_protection_check = "No";
            }
            
            var q_ncb_protection_amt = $("#q_ncb_protection_amt").val();
            
            if($("#q_engine_protector_check").is(":checked"))
            {
                var q_engine_protector_check = "Yes";
            }
            else
            {
                var q_engine_protector_check= "No";
            }
            var q_engine_protector_percentage = $("#q_engine_protector_percentage").val();
            var q_engine_protector_amt = $("#q_engine_protector_amt").val();
            
            
            
            if($("#q_return_to_invoice_check").is(":checked"))
            {
                var q_return_to_invoice_check = "Yes";
            }
            else
            {
                var q_return_to_invoice_check = "No";
            }
            
            var q_return_to_invoice_percentage = $("#q_return_to_invoice_percentage").val();
            var q_return_to_invoice_amt = $("#q_return_to_invoice_amt").val();
            
            // 
            
            if($("#q_key_replacement_check").is(":checked"))
            {
                var q_key_replacement_check = "Yes";
            }
            else
            {
                var q_key_replacement_check = "No";
            }
            
            var q_key_replacement_percentage = $("#q_key_replacement_percentage").val();
            var q_key_replacement_amt = $("#q_key_replacement_amt").val();
            
            if($("#q_daily_allow_check").is(":checked"))
            {
                var q_daily_allow_check = "Yes";
            }
            else
            {
                var q_daily_allow_check = "No";
            }
            var q_daily_allow_percentage = $("#q_daily_allow_percentage").val();
            var q_daily_allow_amt = $("#q_daily_allow_amt").val();
            
            
            if($("#q_loss_of_belong_check").is(":checked"))
            {
                var q_loss_of_belong_check = "Yes";
            }
            else
            {
                var q_loss_of_belong_check = "No";
            }
            
            var q_loss_of_belong_percentage = $("#q_loss_of_belong_percentage").val();
            var q_loss_of_belong_amt = $("#q_loss_of_belong_amt").val();
            
            if($("#q_hotel_trvl_check").is(":checked"))
            {
                var q_hotel_trvl_check = "Yes";
            }
            else
            {
                var q_hotel_trvl_check = "No";
            }
            
            var q_hotel_trvl_percentage = $("#q_hotel_trvl_percentage").val();
            var q_hotel_trvl_amt = $("#q_hotel_trvl_amt").val();
            
            if($("#q_wind_shield_check").is(":checked"))
            {
                var q_wind_shield_check = "Yes";
            }
            else
            {
                var q_wind_shield_check = "No";
            }
            
            var q_wind_shield_percentage = $("#q_wind_shield_percentage").val();
            var q_wind_shield_amt = $("#q_wind_shield_amt").val();
            
            if($("#q_baggage_ins_check").is(":checked"))
            {
                var q_baggage_ins_check = "Yes";
            }
            else
            {
                var q_baggage_ins_check = "No";
            }
            
            var q_baggage_ins_percentage = $("#q_baggage_ins_percentage").val();
            var q_baggage_ins_amt = $("#q_baggage_ins_amt").val();
            
            var q_other_add_on_coverag_per = $("#q_other_add_on_coverag_per").val();
            var q_other_add_on_coverage_amt = $("#q_other_add_on_coverage_amt").val();
            
            var q_value_added_services = $("#q_value_added_services").val();
            var q_net_addon_cover_premium = $("#q_net_addon_cover_premium").val();
            var q_add_on_discount_percentage = $("#q_add_on_discount_percentage").val();
            var q_add_on_discount_amt = $("#q_add_on_discount_amt").val();
            var q_tot_add_on_cover_premium = $("#q_tot_add_on_cover_premium").val();
            
            
            var q_total_premium = $("#q_total_premium").val();
            var q_gst = $("#q_gst").val();
            var q_total_payable = $("#q_total_payable").val();
            var q_commission_base_premium = $("#q_commission_base_premium").val();
            
            
            var formdata = new FormData();
            formdata.append("lead_id",lead_id);
            formdata.append("policy_co_cover_type",policy_co_cover_type);
            formdata.append("q_policy_term",q_policy_term);
            formdata.append("q_policy_s_date",q_policy_s_date);
            formdata.append("q_policy_ex_date",q_policy_ex_date);
            formdata.append("q_insurer",q_insurer);
            formdata.append("q_insurer_branch",q_insurer_branch);
            formdata.append("q_idv",q_idv);
            formdata.append("q_elec_access_value",q_elec_access_value);
            formdata.append("q_non_elec_access_value",q_non_elec_access_value);
            formdata.append("q_lpg_cng",q_lpg_cng); 
            formdata.append("q_sum_insured",q_sum_insured);
            formdata.append("q_make_model",q_make_model);
            formdata.append("q_vechi_age",q_vechi_age);
            formdata.append("q_rto_code",q_rto_code);
            formdata.append("q_zone",q_zone);
            formdata.append("q_cubic_capactiy",q_cubic_capactiy);
            formdata.append("q_vechi_classification ",q_vechi_classification);
			formdata.append("q_basic_od_percentage",q_basic_od_percentage);
            formdata.append("q_basic_od_amount",q_basic_od_amount);
            formdata.append("q_spl_dis_per",q_spl_dis_per);
            formdata.append("q_spl_dis_amount",q_spl_dis_amount);
            formdata.append("q_spl_loading_per",q_spl_loading_per);
            formdata.append("q_spl_loading_amount",q_spl_loading_amount);
            formdata.append("q_non_basic_od",q_non_basic_od);
            formdata.append("q_non_elec_acc_amount",q_non_elec_acc_amount);
            formdata.append("q_bi_fuel_kit",q_bi_fuel_kit);
            formdata.append("q_basic_od1",q_basic_od1);
            formdata.append("q_geographical_area",q_geographical_area);
            formdata.append("q_geographical_amount",q_geographical_amount);
            formdata.append("q_emp_loading",q_emp_loading); 
            formdata.append("q_emp_loading_amount",q_emp_loading_amount);
            formdata.append("q_fiber_class_tank",q_fiber_class_tank); 
            formdata.append("q_fiber_class_tank_amount",q_fiber_class_tank_amount);
            formdata.append("q_driving_tuitions",q_driving_tuitions); 
            formdata.append("q_driving_tuitions_amount",q_driving_tuitions_amount); 
            formdata.append("q_basic_od2",q_basic_od2);
            formdata.append("q_basic_od2_amount",q_basic_od2_amount);
			formdata.append("q_anti_theft",q_anti_theft);
            formdata.append("q_anti_theft_amount",q_anti_theft_amount);
            formdata.append("q_anti_handicap",q_anti_handicap);
            formdata.append("q_anti_handicap_amount",q_anti_handicap_amount);
            formdata.append("q_aai",q_aai);
            formdata.append("q_aai_amount",q_aai_amount);
            formdata.append("q_voluntary_deductable",q_voluntary_deductable);
            formdata.append("q_voluntary_deductable_amount",q_voluntary_deductable_amount);
            formdata.append("q_basic_od_3",q_basic_od_3);
            formdata.append("q_ncb_percentage",q_ncb_percentage);
            formdata.append("q_ncb_percentage_amount",q_ncb_percentage_amount);
            formdata.append("q_basic_tp",q_basic_tp);
            formdata.append("q_fuel_kit_amt",q_fuel_kit_amt);
            formdata.append("q_basic_tp1",q_basic_tp1);
            formdata.append("q_geograpical_amt",q_geograpical_amt);
            formdata.append("q_owner_diver_amt",q_owner_diver_amt);
            formdata.append("q_no_of_year_own_drv",q_no_of_year_own_drv);
            formdata.append("q_un_named_passenger_pa",q_un_named_passenger_pa);
            formdata.append("q_un_named_passenger_amt",q_un_named_passenger_amt);
            formdata.append("q_no_seats_per_person",q_no_seats_per_person);
            formdata.append("q_no_seats_per_person_amt",q_no_seats_per_person_amt);
            formdata.append("q_tot_od_premium",q_tot_od_premium);
            formdata.append("q_llp",q_llp);
            formdata.append("q_llp_amt",q_llp_amt);
            formdata.append("q_no_drv_emp",q_no_drv_emp);
            formdata.append("q_pa_paid_drv",q_pa_paid_drv);
            formdata.append("q_pa_paid_drv_amt",q_pa_paid_drv_amt);
            formdata.append("q_no_seats_per_person1",q_no_seats_per_person1);
            formdata.append("q_no_seats_per_person_amt1",q_no_seats_per_person_amt1);
            formdata.append("q_tot_tp_premium",q_tot_tp_premium);
			formdata.append("q_add_on_combo_premium",q_add_on_combo_premium);
            formdata.append("q_add_on_plan_premium_percentage",q_add_on_plan_premium_percentage);
            formdata.append("q_add_on_plan_premium_amt",q_add_on_plan_premium_amt);
            formdata.append("q_zero_depreciation_check",q_zero_depreciation_check);
            formdata.append("q_zero_depreciation_percentage",q_zero_depreciation_percentage);
            formdata.append("q_zero_depreciation_amt",q_zero_depreciation_amt);
            formdata.append("q_addtional_addons_check",q_addtional_addons_check);
            formdata.append("q_addtional_addons_amt",q_addtional_addons_amt);
            formdata.append("q_consumbles_check",q_consumbles_check);
            formdata.append("q_consumbles_percentage",q_consumbles_percentage);
            formdata.append("q_consumbles_amt",q_consumbles_amt);
            formdata.append("q_tyre_cover",q_tyre_cover);
            formdata.append("q_tyre_cover_percentage",q_tyre_cover_percentage);
            formdata.append("q_tyre_cover_amt",q_tyre_cover_amt);
            formdata.append("q_ncb_protection_check",q_ncb_protection_check);
            formdata.append("q_ncb_protection_amt",q_ncb_protection_amt);
            formdata.append("q_engine_protector_check",q_engine_protector_check);
            formdata.append("q_engine_protector_percentage",q_engine_protector_percentage);
            formdata.append("q_engine_protector_amt",q_engine_protector_amt);
            formdata.append("q_return_to_invoice_check",q_return_to_invoice_check);
            formdata.append("q_return_to_invoice_percentage",q_return_to_invoice_percentage);
            formdata.append("q_return_to_invoice_amt",q_return_to_invoice_amt);
            
            
            formdata.append("q_key_replacement_check",q_key_replacement_check);
			formdata.append("q_key_replacement_percentage",q_key_replacement_percentage);
			formdata.append("q_key_replacement_amt",q_key_replacement_amt);
			formdata.append("q_daily_allow_check",q_daily_allow_check); 
			formdata.append("q_daily_allow_percentage",q_daily_allow_percentage);
			formdata.append("q_daily_allow_amt",q_daily_allow_amt);
			formdata.append("q_loss_of_belong_check",q_loss_of_belong_check); 
			formdata.append("q_loss_of_belong_percentage",q_loss_of_belong_percentage);
			formdata.append("q_loss_of_belong_amt",q_loss_of_belong_amt);
			formdata.append("q_hotel_trvl_check",q_hotel_trvl_check);
			formdata.append("q_hotel_trvl_percentage",q_hotel_trvl_percentage);
			formdata.append("q_hotel_trvl_amt",q_hotel_trvl_amt);
			formdata.append("q_wind_shield_check",q_wind_shield_check); 
			formdata.append("q_wind_shield_percentage",q_wind_shield_percentage);
			formdata.append("q_wind_shield_amt",q_wind_shield_amt);
			formdata.append("q_baggage_ins_check",q_baggage_ins_check); 
			formdata.append("q_baggage_ins_percentage",q_baggage_ins_percentage);
			formdata.append("q_baggage_ins_amt",q_baggage_ins_amt);
			formdata.append("q_other_add_on_coverag_per",q_other_add_on_coverag_per);
			formdata.append("q_other_add_on_coverage_amt",q_other_add_on_coverage_amt);
			formdata.append("q_value_added_services",q_value_added_services);
			formdata.append("q_net_addon_cover_premium",q_net_addon_cover_premium);
			formdata.append("q_add_on_discount_percentage",q_add_on_discount_percentage);
			formdata.append("q_add_on_discount_amt",q_add_on_discount_amt);
			formdata.append("q_tot_add_on_cover_premium",q_tot_add_on_cover_premium);
			formdata.append("q_total_premium",q_total_premium);
			formdata.append("q_gst",q_gst);
			formdata.append("q_total_payable",q_total_payable);
			formdata.append("q_commission_base_premium",q_commission_base_premium);
			
            $.ajax({
                        url : "add_quotations",
                        method : "POST",
                        data:formdata,
                        processData:false,  
                        contentType:false,
                        cache:false,
                        dataType:'text',
                        beforeSend:function(){
                            $("#add_quotation").attr("disabled",true);
                        },
                        success:function(response)
                        {
                            
                                    Swal.fire({
                                    position: 'top-end',
                                    icon: 'success',
                                    title: 'Your Quotation Saved Successfully',
                                    showConfirmButton: false,
                                    timer: 1500
                                    })
                            $("#add_quotation").attr("disabled",false);
                            $(".form-control").val("");
                             $("#add_quotation_model").modal("toggle");
                             get_all_quotes(last_inserted_id)
                        }
            });
       });
       
       
        $("#pet_male_btn").click(function()
        {
            pet_female_to_male();
        });
        
         $("#pet_female_btn").click(function()
         {
            pet_male_to_female();
        });

        $("#pet_submit").click(function(){
            
            var lead_id = $("#last_inserted_id").val();
            
            var pet_age = $("#pet_age").val();
            var pet_weight = $("#pet_weight").val();
            var pet_name = $("#pet_name").val();
            var pet_height = $("#pet_height").val();
            
            $.ajax({
                    url : "add_pet_details",
                    method : "POST",
                    data : {lead_id:lead_id,pet_gender:pet_gender,pet_name:pet_name,pet_age:pet_age,pet_weight:pet_weight,pet_height:pet_height},
                    beforeSend:function()
                    {
                        $("#pet_submit").attr("disabled",true);
                    },
                    success:function(response)
                    {
                        $("#pet_submit").attr("disabled",false);
                        $(".form-control").val("");
                        $("#add_pet_modal").modal("toggle");
                        
                      Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'Pet Details Saved Successfully',
                        showConfirmButton: false,
                        timer: 1500
                        })
                        
                          $("#pet_div").removeClass("hidden");
                          
                       var obj = jQuery.parseJSON(response); 
                       
                        $("#edit_pet_name").val(obj.name);
                        $("#edit_pet_gender").val(obj.gender);
                        $("#edit_pet_age").val(obj.age_in_months);
                        $("#edit_pet_height").val(obj.height_in_ft);
                        $("#edit_pet_weight").val(obj.weight_in_kg);
                       
                        $("#add_pet_btn").addClass("hidden");
                        $("#edit_pet_btn").removeClass("hidden");
                    }
            });
            
             
        });
        
        // Property
        
        $("#home_btn").click(function()
        {
            house_society_to_home();
        });
        
         $("#housing_society_btn").click(function()
         {
            home_to_house_society();
        });
        
        $("#owner_btn").click(function()
        {
            tenant_to_owner();
        });
        
         $("#tenant_btn").click(function()
         {
            owner_to_tenant();
        });
        
        // Home property Button
        
        $("#add_pro_btn").click(function()
       {
           var lead_id = $("#last_inserted_id").val();
           var home_policy_tenure = $("#home_policy_tenure").val();
           var home_age_premises = $("#home_age_premises").val();
           var home_property_value = $("#home_property_value").val();
           var home_sqft = $("#home_sqft").val();
           var home_infuli = $("#home_infuli").val();
           var home_dgairmac = $("#home_dgairmac").val();
           
           if(home_policy_tenure == "")
           {
               snackbar_home_model("Select Policy Tenure");
           }
           else if(home_age_premises == "")
           {
                snackbar_home_model("Select Home Age Premises");
           }
           else if(home_property_value == "")
           {
                snackbar_home_model("Enter Home Value");
           }
           else if(home_sqft == "")
           {
                snackbar_home_model("Enter Home Square Feet");
           }
           else if(home_infuli == "")
           {
                snackbar_home_model("Enter Interior furniture lighting Value");
           }
           else if(home_dgairmac == "")
           {
                snackbar_home_model("Enter A/C, DG set Machinery value");
           }
           else
           {
               $.ajax({
                    url:"add_home_property",
                    data:{
                        lead_id : lead_id,
                        house_type:house_type,
                        owner_type:owner_type,
                        home_policy_tenure:home_policy_tenure,
                        home_age_premises:home_age_premises,
                        home_property_value:home_property_value,
                        home_sqft:home_sqft,
                        home_infuli:home_infuli,
                        home_dgairmac:home_dgairmac,
                    },
                    method:"POST",
                    beforeSend:function(){
                        $("#add_pro_btn").attr("disabled",true);
                    },
                    success:function(response){
                        $("#add_pro_btn").attr("disabled",false);
                        $("#homeModal").modal("toggle");
                         Swal.fire({
                                    position: 'top-end',
                                    icon: 'success',
                                    title: 'Your Home Insurace Details Saved Successfully',
                                    showConfirmButton: false,
                                    timer: 1500
                                    })
                                   
                                var obj = jQuery.parseJSON(response);
                                   if(obj != null)
                                      {
                                          $("#home_pro_div").removeClass("hidden");
                                          $("#business_pro_div").addClass("hidden");
                                          $("#home_pro_div").removeClass("hidden");
                                          $("#add_prop_btn").addClass("hidden");
                                          $("#edit_home_prop_btn").removeClass("hidden");
                                          
                                          $("#housing_type").val(obj.house_type);
                                          $("#policy_tensure").val(obj.home_policy_tenure);
                                          $("#property_value").val(obj.home_property_value);
                                          $("#interior_furniture").val(obj.home_interior);
                                          $("#tenant_or_owner").val(obj.owner_type);
                                          $("#age_of_premises").val(obj.home_age_premises);
                                          $("#built_up_area").val(obj.home_sqft);
                                          $("#air_conditionor_amt").val(obj.home_ac);
                                      }               

                    },
                    error:function(code){
                      alert(code.statusText);  
                    },
                }); 
           }
       });
       
       // Business property
       
        $("#business_owner_btn").click(function()
        {
            business_tenant_to_owner();
        });
        
         $("#business_tenant_btn").click(function()
         {
            business_owner_to_tenant();
        });
        
        
      $("#add_business_btn").click(function()
       {
           var lead_id = $("#last_inserted_id").val();
           var business_profession = $("#business_profession").val();
           var business_age_premises = $("#business_age_premises").val();
           var business_property_value = $("#business_property_value").val();
           var business_sqft = $("#business_sqft").val();
           var business_infuli = $("#business_infuli").val();
           var business_dgairmac = $("#business_dgairmac").val();
           

           var check = 0;
           
           if(business_profession == "")
           {
               check =1;
              Swal.fire(
                    'Select Profession ?',
                    '',
                    'question'
                    )
           }
           else if(business_age_premises == "")
           {
                check =1;
              Swal.fire(
                    'Age of Premises ?',
                    '',
                    'question'
                    )
           }
           else if(business_property_value == "")
           {
                check =1;
              Swal.fire(
                    'Enter Property Value ?',
                    '',
                    'question'
                    )
           }
           else if(business_sqft == "")
           {
                check =1;
              Swal.fire(
                    'Enter Built Up Area ?',
                    '',
                    'question'
                    )
           }
           else if(business_infuli == "")
           {
                check =1;
              Swal.fire(
                    'Enter Interior, Furniture & Lighting ?',
                    '',
                    'question'
                    )
           }
           else if(business_dgairmac == "")
           {
                check =1;
              Swal.fire(
                    'Enter DG set, Air Conditioner & Machinery ?',
                    '',
                    'question'
                    )
           }
           else if(check != 1)
           {
               $.ajax({
                    url:"add_business_details",
                    method:"POST",
                    data:{
                        lead_id : lead_id,
                        business_owner_type:business_owner_type,
                        business_profession:business_profession,
                        business_age_premises:business_age_premises,
                        business_property_value:business_property_value,
                        business_sqft:business_sqft,
                        business_infuli:business_infuli,
                        business_dgairmac:business_dgairmac,
                    },
                    beforeSend:function(){
                    $("#add_business_btn").attr("disabled",true);
                },
                    success:function(response){
                        $("#add_business_btn").attr("disabled",false);
                        $("#businessmodal").modal("toggle");
                        Swal.fire({
                                    position: 'top-end',
                                    icon: 'success',
                                    title: 'Your Bussiness Insurace Details Saved Successfully',
                                    showConfirmButton: false,
                                    timer: 1500
                                    })

                         $(".form-control").val("");
                        
                          $("#business_pro_div").removeClass("hidden");
                          $("#home_pro_div").addClass("hidden");
                          
                          var obj = jQuery.parseJSON(response);
                          
                          $("#b_tenant_or_owner").val(obj.owner_type);
                          $("#b_proffession").val(obj.profession);
                          $("#b_property_value").val(obj.business_property_value);
                          $("#b_age_of_premise").val(obj.business_age_premises);
                          $("#b_interior_furniture").val(obj.business_interior);
                          $("#b_built_up_area").val(obj.business_sqft);
                          $("#b_air_conditionor_amt").val(obj.business_ac);
                          $("#business_prop_btn").addClass("hidden");
                          $("#edit_business_prop_btn").removeClass("hidden");
                    },
                    error:function(code){
                      alert(code.statusText);  
                    },
                }); 
           }
       });
       
       $("#marine_cummodity").change(function(){
            var commodity = $("#marine_cummodity").val();
            $.ajax({
               url:"commodity_change_load_sub_commodity",
               method:"Post",
               data:{
                   commodity:commodity,
               },
               success:function(response){
                   $("#marine_sub_cummodity").html(response);
               },
               error:function(code){
                   alert(code.statusText);
               }
            });
       });
       
        //Marine
        
        $("#marine_submit").click(function(){
            var lead_id = $("#last_inserted_id").val();
            var marine_type = $("#transit_policy").val();
            var marine_company_name = $("#marine_company_name").val();
            var marine_city_name = $("#marine_city_name").val();
            var marine_transport = $("#marine_transport").val();
            var marine_cummodity = $("#marine_cummodity").val();
            var marine_sub_cummodity = $("#marine_sub_cummodity").val();
            var marine_invoice_val = $("#marine_invoice_val").val();
            var marine_invoice_10per_val = $("#marine_invoice_10per_val").val();
            if(marine_company_name == "")
            {
                snackbar_show("Enter Company Name");
            }
            else if(marine_city_name == "")
            {
                snackbar_show("Enter City Name");
            }
            else if(marine_transport == "")
            {
                snackbar_show("Select Mode of Transport");
            }
            else if(marine_cummodity == "")
            {
                snackbar_show("Select Commodity");
            }
            else if(marine_sub_cummodity == "")
            {
                snackbar_show("Select Sub Commodity");
            }
            else if(marine_invoice_val == "")
            {
                snackbar_show("Enter Invoice Value");
            }
            else
            {
                $.ajax({
                    url:"marine_submit",
                    method:"POST",
                    data:{
                        lead_id : lead_id,
                        marine_company_name:marine_company_name,
                        marine_city_name:marine_city_name,
                        marine_transport:marine_transport,
                        marine_cummodity:marine_cummodity,
                        marine_sub_cummodity:marine_sub_cummodity,
                        marine_invoice_val:marine_invoice_val,
                        marine_invoice_10per_val:marine_invoice_10per_val,
                        marine_type:marine_type,
                    },
                    beforeSend:function()
                   {
                       $("#marine_submit").attr("disabled",true);
                   },
                   success:function(response){
                       $("#marainemodal").modal("toggle");
                        $(".form-control").val("");
                        Swal.fire({
                              position: 'top-end',
                              icon: 'success',
                              title: 'Maraine Details Saved Successfully',
                              showConfirmButton: false,
                              timer: 1500
                            })
                            
                            $("#maraine_div").removeClass("hidden");
                            
                            $("#add_maraine_btn").addClass("hidden");
                            $("#edit_maraine_btn").removeClass("hidden");
                       
                            var obj = jQuery.parseJSON(response);
                            $("#m_transit_policy").val(obj["maraine_details"].type);
                            $("#m_marine_transport").val(obj["maraine_details"].transport_mode);
                            $("#m_marine_cummodity").val(obj["maraine_details"].commodity);
                            $("#m_marine_sub_cummodity").html(obj["sub_commodity"]);
                            $("#m_marine_sub_cummodity").val(obj["maraine_details"].sub_commodity);
                            $("#m_marine_company_name").val(obj["maraine_details"].company_name);
                            $("#m_marine_city_name").val(obj["maraine_details"].city_name);
                            $("#m_marine_invoice_val").val(obj["maraine_details"].invoice_value);
                            $("#m_marine_invoice_10per_val").val(obj["maraine_details"].sum_invoice);
                  },
                   error:function(code){
                       alert(code.statusText);
                   }
                });
            }
        });
     });
      
      function daughters()
      {
           var no_daughters = $("#num_daughters").val();
           
           if(parseInt(no_daughters) == 4)
           {
               $("#daughter_div1").removeClass("hidden");
               $("#daughter_div2").removeClass("hidden");
               $("#daughter_div3").removeClass("hidden");
               $("#daughter_div4").removeClass("hidden");
           }
           else if(parseInt(no_daughters) == 3)
           {
               $("#daughter_div1").removeClass("hidden");
               $("#daughter_div2").removeClass("hidden");
               $("#daughter_div3").removeClass("hidden");
               $("#daughter_div4").addClass("hidden");
           }
           else if(parseInt(no_daughters) == 2)
           {
               $("#daughter_div1").removeClass("hidden");
               $("#daughter_div2").removeClass("hidden");
               $("#daughter_div3").addClass("hidden");
               $("#daughter_div4").addClass("hidden");
           }
           else if(parseInt(no_daughters) == 1)
           {
               $("#daughter_div1").removeClass("hidden");
               $("#daughter_div2").addClass("hidden");
               $("#daughter_div3").addClass("hidden");
               $("#daughter_div4").addClass("hidden");
           }
           else if(parseInt(no_daughters) > 4)
           {
               Swal.fire("Maximum Number Of Daughter Count Is 4 , You can't Give More Than 4");
               $("#num_daughters").val("1");
               $("#daughter_div2").addClass("hidden");
               $("#daughter_div3").addClass("hidden");
               $("#daughter_div4").addClass("hidden");
           }
      }
      
      function sons()
      {
           var no_sons = $("#num_sons").val();
           var content = "";
           
           if(parseInt(no_sons) == 4)
           {
               $("#son_div1").removeClass("hidden");
               $("#son_div2").removeClass("hidden");
               $("#son_div3").removeClass("hidden");
               $("#son_div4").removeClass("hidden");
           }
           else if(parseInt(no_sons) == 3)
           {
               $("#son_div1").removeClass("hidden");
               $("#son_div2").removeClass("hidden");
               $("#son_div3").removeClass("hidden");
               $("#son_div4").addClass("hidden");
           }
           else if(parseInt(no_sons) == 2)
           {
               $("#son_div1").removeClass("hidden");
               $("#son_div2").removeClass("hidden");
               $("#son_div3").addClass("hidden");
               $("#son_div4").addClass("hidden");
           }
           else if(parseInt(no_sons) == 1)
           {
               $("#son_div1").removeClass("hidden");
               $("#son_div2").addClass("hidden");
               $("#son_div3").addClass("hidden");
               $("#son_div4").addClass("hidden");
           }
           else if(parseInt(no_sons) > 4)
           {
               Swal.fire("Maximum Number Of Son Count Is 4 , You can't Give More Than 4");
               $("#num_sons").val("1");
               $("#son_div2").addClass("hidden");
               $("#son_div3").addClass("hidden");
               $("#son_div4").addClass("hidden");
           }
      }
      
      function edit_vechi_data(id)
      {
          $.ajax({
                   url : "get_vechicle_uploaded_file_by_id",
                   method : "POST",
                   data:{id:id},
                   success:function(response)
                   {
                       var obj = jQuery.parseJSON(response)
                       $("#edit_doc_id").val(obj.id);
                       $("#edit_document_type").val(obj.document_type);
                       $("#edit_doc_mod").modal("toggle");
                   }
          });
      }
      
      function delete_vechi_data(id)
      {
            if(confirm("Are you Confirm to Delete"))
              {
                $.ajax({
                  url:"delete_vechicle_documents",
                  data:{id:id},
                  method:"POST",
                  success:function(response){
                        $("#edit_table_view").html(response);
                            Swal.fire(
                            'Deleted!',
                            'The Document Has been Deleted successfully!',
                            'success'
                            )
                  },
                  error: function(code) {   
                    alert(code.statusText);
                  },
                });
              }
      }
      
      function notification_log(id)
      {
            $.ajax({
                        url : "get_recent_activities",
                        method : "POST",
                        data : {lead_id:id},
                        success:function(response)
                        {
                        $("#recent_activity_div").html(response);
                        }
                });
      }
      
      function get_all_quotes(id)
      {
          $.ajax({
                url : "get_all_quotes",
                method : "POST",
                data : {lead_id:id},
                success:function(response)
                {
                    $("#quotes_view").html(response);
                }
          });
      }
      
      
    function pet_female_to_male()
    {
        pet_gender = "male";
        $("#pet_male_btn").addClass("change_pet_gender");
        $("#pet_female_btn").removeClass("change_pet_gender");
    }
    
    function pet_male_to_female()
    {
        pet_gender = "female";
        $("#pet_male_btn").removeClass("change_pet_gender");
        $("#pet_female_btn").addClass("change_pet_gender");
    }
    
    // Property //
    
    function home_to_house_society()
    {
        house_type = "Home";
        $("#housing_society_btn").addClass("change_house_type");
        $("#home_btn").removeClass("change_house_type");
    }
    
    function house_society_to_home()
    {
        house_type = "Housing Society";
        $("#housing_society_btn").removeClass("change_house_type");
        $("#home_btn").addClass("change_house_type");
    }
    
    function owner_to_tenant()
    {
        owner_type = "Tenant";
        $("#tenant_btn").addClass("change_owner");
        $("#owner_btn").removeClass("change_owner");
    }
    
    function tenant_to_owner()
    {
        owner_type = "Owner";
        $("#tenant_btn").removeClass("change_owner");
        $("#owner_btn").addClass("change_owner");
    }
    
     //Business
    function business_owner_to_tenant()
    {
        business_owner_type = "Tenant";
        $("#business_tenant_btn").addClass("business_change_owner");
        $("#business_owner_btn").removeClass("business_change_owner");
    }
    
    function business_tenant_to_owner()
    {
        business_owner_type = "Owner";
        $("#business_tenant_btn").removeClass("business_change_owner");
        $("#business_owner_btn").addClass("business_change_owner");
    }
    
    // maraine //
    
        function marine_calculate()
        {
            var marine_invoice = $("#marine_invoice_val").val();
            if(marine_invoice != "")
            {
                var ten_per = (marine_invoice * 10) / 100;
                var total = parseFloat(marine_invoice) + parseFloat(ten_per);
                $("#marine_invoice_10per_val").val(total);
            }
            else
            {
                $("#marine_invoice_10per_val").val("");
            }
        }
    
      
  </script>
        

        
        
 
  
  

   
  
  
 