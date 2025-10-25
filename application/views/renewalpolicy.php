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
    
    .img_style{
        height:50px;
        width:50px;
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
            <!--<button class="btn btn-danger btn-sm pull-right"><i class="fa fa-times" aria-hidden="true"></i> Cancel</button>-->
            <!-- <span class="pull-right">&nbsp;</span>-->
            <button class="btn btn-success btn-sm pull-right" id="save_btn"><i class="fa fa-save"></i> Save</button>
            <span class="pull-right">&nbsp;</span>
            <a href='renewallead' class="btn btn-warning btn-sm pull-right" id="back_btn"><i class="fa fa-backward" aria-hidden="true"></i> Back</a>
            <span class="pull-right">&nbsp;</span>
            <!--<button class="btn btn-success btn-sm pull-right hidden" id="update_btn"><i class="fa fa-save"></i> Save</button>-->
            <!--<span class="pull-right">&nbsp;</span>-->
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
            <a href="#" class="btn btn-info btn-sm pull-right hidden" id="policy_btn"><i class="fa fa-umbrella" aria-hidden="true"></i> Generate Policy</a>
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
   <input type="hidden" id="ref_lead_id" name="ref_lead_id" value="<?php echo $lead_id ?>">
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
                           <input type="hidden" id="client_id" name="client_id" value="<?=$result->client_id?>"/>
                        </div>
                        <div class="col-md-8">
                           <select class="form-control" name="client_type" id="client_type">
                              <option value="">--Select--</option>
                              <?php foreach($client_type as $da){ ?>
                              <?php $selected = ($da->id == $result->client_type_id) ? "selected" : "";?>
                              <option value="<?php echo $da->id ?>" <?=$selected?>><?php echo $da->client_type ?></option>
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
                           <label><?=$result->client_name?></label>
                           <input type="hidden" class="form-control" name="client_name" id="client_name" value="<?=$result->client_name?>">
                        </div>
                     </div>
                  </div>
                  <div class="form-group">
                     <div class="row">
                        <div class="col-md-4">
                           <label>Mobile No</label><span>*</span>
                        </div>
                        <div class="col-md-8">
                           <div class="input-group">
                              <div class="input-group-addon">+91</div>
                              <input type="number" class="form-control" name="mobile_no" maxlength="10" minlength="10" size="10" id="mobile_no" value="<?=$result->mobile_no?>">
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="form-group">
                     <div class="row">
                        <div class="col-md-4">
                           <label>Other contact Details</label>
                        </div>
                        <div class="col-md-8">
                           <input type="text" class="form-control" name="other_contact_details" id="other_contact_details" value="<?=$result->other_contact_details?>">
                        </div>
                     </div>
                  </div>
                  <div class="form-group">
                     <div class="row">
                        <div class="col-md-4">
                           <label>Landline no</label>
                        </div>
                        <div class="col-md-8">
                           <input type="text" class="form-control" name="landline_no" id="landline_no" value="<?=$result->landline_no?>">
                        </div>
                     </div>
                  </div>
                  <div class="form-group">
                     <div class="row">
                        <div class="col-md-4">
                           <label>Address</label>
                        </div>
                        <div class="col-md-8">
                           <textarea class="form-control" name="address" id="address" rows="3"><?=$result->address?></textarea>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-md-6">
                  <?php $regno = explode("-", $result->vechi_register_no);?>
                  <div class="form-group" id="v_regn_no_div">
                     <div class="row">
                        <div class="col-md-4">
                           <label>Regn no</label>*<span id='regn_no_span' style='color:red'> </span>
                        </div>
                        <div class="col-md-8 inputs">
                           <label><?=$result->vechi_register_no?></label>
                        </div>
                        <div class="col-md-2 inputs hidden">                                    
                           <input type="text" class="form-control inputs" name="v_regn_no_1" id="v_regn_no_1" maxlength="2" value="<?=(isset($regno[0]) ? $regno[0] : "")?>">
                        </div>
                        <div class="col-md-2 inputs hidden">
                           <input type="text" class="form-control inputs" name="v_regn_no_2" id="v_regn_no_2" maxlength="2" value="<?=(isset($regno[1]) ? $regno[1] : "")?>">
                        </div>
                        <div class="col-md-2 inputs hidden">
                           <input type="text" class="form-control inputs" name="v_regn_no_3" id="v_regn_no_3" maxlength="2" value="<?=(isset($regno[2]) ? $regno[2] : "")?>">
                        </div>
                        <div class="col-md-2 inputs hidden">
                           <input type="text" class="form-control inputs" name="v_regn_no_4" id="v_regn_no_4" maxlength="4" value="<?=(isset($regno[3]) ? $regno[3] : "")?>">
                        </div>
                     </div>
                  </div>
                  <div class="form-group">
                     <div class="row">
                        <div class="col-md-4">
                           <label>Email Id</label>
                        </div>
                        <div class="col-md-8">
                           <input type="email" class="form-control" name="email_id" id="email_id" value="<?=$result->email?>">
                        </div>
                     </div>
                  </div>
                  <div class="form-group">
                     <div class="row">
                        <div class="col-md-4">
                           <label>Advisor Name</label>
                        </div>
                        <div class="col-md-8">
                           <input type="text" class="form-control" name="cont_person_name" id="cont_person_name" value="<?=$result->contact_person_name?>">
                        </div>
                     </div>
                  </div>
                  <div class="form-group">
                     <div class="row">
                        <div class="col-md-4">
                           <label>Advisor Designation</label>
                        </div>
                        <div class="col-md-8">
                           <input type="text" class="form-control" name="cont_person_des" id="cont_person_des" value="<?=$result->contact_person_designation?>">
                        </div>
                     </div>
                  </div>
                  <div class="form-group">
                     <div class="row">
                        <div class="col-md-4">
                           <label>Date of Birth</label>
                        </div>
                        <div class="col-md-8">
                           <input type="date" class="form-control" name="dob" id="dob" value="<?=$result->date_of_birth?>">
                        </div>
                     </div>
                  </div>
                  <div class="form-group">
                     <div class="row">
                        <div class="col-md-4">
                           <label>Age</label>
                        </div>
                        <div class="col-md-8">
                           <input type="text" class="form-control" name="age" id="age" value="<?=$result->age?>">
                        </div>
                     </div>
                  </div>
                  <div class="form-group">
                     <div class="row">
                        <div class="col-md-4">
                           <label>Area</label>
                        </div>
                        <div class="col-md-8">
                           <input type="text" class="form-control" name="area" id="area" value="<?=$result->area?>">
                        </div>
                     </div>
                  </div>
                  <div class="form-group">
                     <div class="row">
                        <div class="col-md-4">
                           <label>Pin Code</label>
                        </div>
                        <div class="col-md-8">
                           <input type="text" class="form-control" placeholder="Enter 6 Digit" name="pincode" maxlength="6" size="6" id="pin_code">
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
                              <?php $selected = ($da->id == $result->business_type) ? "selected" : ""?>
                              <option value="<?php echo $da->id ?>" <?=$selected?>><?php echo $da->bussiness_type ?></option>
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
                              <?php $selected = ($da->id == $result->class) ? "selected" : ""?>
                              <option value="<?php echo $da->id ?>" <?=$selected?>><?php echo $da->class ?></option>
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
                              <?php foreach($policytypelist as $da){ ?>
                              <?php $selected = ($da->id == $result->policy_type) ? "selected" : ""?>
                              <option value="<?php echo $da->id ?>" <?=$selected?>><?php echo $da->policy_type ?></option>
                              <?php } ?>
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
                           <input type="date"  class="form-control" name="lead_generated_date" id="lead_generated_date" value="<?=$startdate?>">
                        </div>
                     </div>
                  </div>
                  <div class="form-group">
                     <div class="row">
                        <div class="col-md-4">
                           <label>Due Date</label>
                        </div>
                        <div class="col-md-4">
                           <input type="date" class="form-control" name="due_date" id="due_date" value="<?=$duedate?>">
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
                           <input type="text" class="form-control" name="location" id="location" value="<?=$result->location?>">
                        </div>
                     </div>
                  </div>
                  <?php if(!isset($_GET["id"])){ ?>
                  <div class="form-group">
                     <div class="row">
                        <div class="col-md-4">
                           <label>Upload Old Policy</label>
                        </div>
                        <div class="col-md-8">
                           <input type="file" class="form-control" name="old_policy" id="old_policy">
                        </div>
                     </div>
                  </div>
                  <?php } ?>
               </div>
               <div class="col-md-6">
                  <div class="form-group">
                     <div class="row">
                        <div class="col-md-4">
                           <label>Classification</label><span>*</span>
                        </div>
                        <div class="col-md-8">
                           <select class="form-control" name="classification" id="classification">
                              <option value="">--select--</option>
                              <option value="1" <?=("1" == $result->classfication) ? "selected" : ""?>>Hot</option>
                              <option value="2" <?=("2" == $result->classfication) ? "selected" : ""?>>Warm</option>
                              <option value="3" <?=("3" == $result->classfication) ? "selected" : ""?>>Cold</option>
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
                           <?php 
                              $sourecelist = [
                                  'all'                => 'All', 
                                  'Website'            => 'Website', 
                                  'Social Media'       => 'Social Media', 
                                  'Adverdisment'       => 'Adverdisment', 
                                  'Agents_and_POS'     => 'Agents and POS', 
                                  'Jayantha Insurance' => 'Jayantha Insurance', 
                                  'Others'             => 'Others'
                              ];
                              ?>
                           <select class="form-control" name="source" id="source">
                              <option value="">--select--</option>
                              <?php foreach($sourecelist as $key => $value):?>
                              <?php $selected = ($key == $result->source) ? "selected" : "";?>
                              <option value="<?=$key?>" <?=$selected?>><?=$value?></option>
                              <?php endforeach;?>                                                                           
                           </select>
                        </div>
                     </div>
                  </div>
                  <!--<div class="form-group">-->
                  <!--     <div class="row">   -->
                  <!--          <div class="col-md-4">-->
                  <!--              <label>Region *</label>-->
                  <!--          </div>-->
                  <!--           <div class="col-md-8">-->
                  <!--               <select class="form-control select2" name="region" id="region" >-->
                  <!--                   <option value="">--select--</option>-->
                  <!--               </select>-->
                  <!--           </div>-->
                  <!--       </div>-->
                  <!--   </div>-->
                  <div class="form-group">
                     <div class="row">
                        <div class="col-md-4">
                           <label>Agent / Pos *</label>
                        </div>
                        <div class="col-md-8">
                           <select class="form-control select2" name="agent_pos" id="agent_pos" >
                              <option value="">--select--</option>
                              <?php foreach($agents_pos as $da){?>
                              <?php $selected = ($da->id == $result->agency_and_pos) ? "selected" : ""?>
                              <option value="<?php echo $da->id ?>" <?=$selected?>><?php echo $da->name."  - ".$da->agent_pos_code."" ?></option>
                              <?php } ?>
                           </select>
                        </div>
                     </div>
                  </div>
                  <input type="hidden" id="session_role" value="<?php echo $this->session->userdata("session_role") ?>">
                  <div class="form-group">
                     <div class="row">
                        <div class="col-md-4">
                           <label>Assign to User *</label>
                        </div>
                        <div class="col-md-8">
                            <?php
                            $usr = "";
                            if(in_array($this->session->userdata("session_id"), $users)) {
                              $usr = "true";
                            }
                            ?>
                           <select class="form-control" name="assign_to_user" id="assign_to_user">
                            <?php if(isset($users) && !empty($users)) { ?>
                                <?php foreach($users as $da){?>
                                    <?php $selected = ($da->id == $result->assigned_user) ? "selected" : ""?>
                                    <?php if($this->session->userdata("session_role") == "admin"):?>
                                        <option value="<?php echo $da->id ?>" <?=$selected?>><?php echo $da->username."  (".$da->email_id.")" ?></option>
                                    <?php else:?>
                                        <?php if($da->id == $result->assigned_user):?>
                                           <option value="<?php echo $da->id ?>" selected><?php echo $da->username."  (".$da->email_id.")" ?></option>
                                        
                                        <?php endif; ?>
                                    <?php endif; ?>
                                <?php } ?>
                            <?php } ?>
                           </select>
                        </div>
                     </div>
                  </div>
                  <div class="form-group">
                     <div class="row">
                        <div class="col-md-4">
                           <label>Area Incharge *</label>
                        </div>
                        <div class="col-md-8">
                           <select class="form-control" name="area_incharge" id="area_incharge">
                              <!-- <option value="">--Select--</option> -->
                              <?php if(isset($areainchargelist) && !empty($areainchargelist)):?>
                              <?php foreach($areainchargelist as $usr):?>                                            
                              <?php $selected = ($usr->id == $result->area_incharge) ? "selected" : ""?>                                            
                              <option value="<?=$usr->id?>" <?=$selected?>><?=$usr->name." - ".$usr->phoneno?></option>
                              <?php endforeach;?>
                              <?php endif;?>
                           </select>
                        </div>
                     </div>
                  </div>
                  <div class="form-group">
                     <div class="row">
                        <div class="col-md-4">
                           <label>Lead Status</label>
                        </div>
                        <div class="col-md-8">
                           <select class="form-control" name="lead_status" id="lead_status">
                                 <option value="open">Open</option>
                                 <option value="follow_up">Follow up</option>
                                 <option value="lost">Lost</option>                                 
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
                           <textarea rows="3" class="form-control" name="remarks" id="remarks"><?=$result->remarks?></textarea>
                        </div>
                     </div>
                  </div>
                  <div class="hidden" id="sme_gst_number" >
                     <div class="form-group">
                        <div class="row">
                           <div class="col-md-4">
                              <label>GST Number </label>
                           </div>
                           <div class="col-md-8">
                              <input type="text" class="form-control" name="gst_number" id="gst_number">
                           </div>
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
                 
                <!-- <button class="btn btn-xs btn-info" data-toggle="modal" data-target="#add_model"><i class="fa fa-plus" aria-hidden="true"></i> Add Follow Up</button> -->
                 
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
                               <label>Follow up-Concluded</label> <span id="add_name_error" style="color: red;">*</span>
                            </div>
                            <div class="col-md-8">
                               <select class="form-control" name="follow_up_concluded" id="follow_up_concluded">
                                  <option value="">--Select--</option>
                                  <option value="1">Yes</option>
                                  <option value="0">No</option>
                               </select>
                            </div>
                         </div>
                      </div>
                      <div class="form-group">
                         <div class="row">   
                            <div class="col-md-4">
                                  <label>Next Follow up date</label>
                            </div>
                            <div class="col-md-8">
                                  <input type="date" class="form-control" id="enter_next_follow_date" name="enter_next_follow_date">
                            </div>
                            </div>
                      </div>
                   </div>
                      
                   <div class="col-md-6">
                      <div class="form-group">
                         <div class="row">   
                            <div class="col-md-4">
                            <label>Reason</label> <span id="add_name_error" style="color: red;">*</span>
                            </div>
                            <div class="col-md-8">
                            <select class="form-control" name="follow_up_reason" id="follow_up_reason">
                               <option value="">--Select--</option>
                               <option value="Call not answered">Call not answered</option>
                               <option value="Invalid Phone number">Invalid Phone number</option>
                               <option value="New Follow up">New Follow up</option>
                               <option value="Phone Unreachable">Phone Unreachable</option>
                               <option value="Rescheduled">Rescheduled</option>
                            </select>
                            </div>
                            </div>
                      </div>
                      <div class="form-group">
                         <div class="row">   
                            <div class="col-md-4">
                                  <label>Next Follow up Time</label>
                            </div>
                            <div class="col-md-8">
                                  <input type="time" class="form-control" id="enter_next_follow_time" name="enter_next_follow_time">
                            </div>
                            </div>
                      </div>
                   </div>
                   
                   <div class="col-md-12">
                      <div class="form-group">
                         <label>Comment</label> <span id="add_name_error" style="color: red;"></span>
                         <textarea class="form-control" name="follow_comment" id="follow_comment"></textarea>
                      </div>
                   </div>
                </div>
            </div>
        </div> 
	</section>
   <!-- /.content -->
</div>
<!-- /.content-wrapper -->
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
                                 <select class="form-control" name="vechile_type" id="vechile_type" disabled>
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
                                 <label>Year Of Manufacture</label>
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
                                 <select class="form-control select2" id="vechi_manu_year" name="vechi_manu_year" style='width:100%'>
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
                                 <select class="form-control" name="vechi_fuel_type" id="vechi_fuel_type" >
                                    <option value="">--select--</option>
                                    <?php foreach($fuel_type as $da){ if($da->id != "4"){?>
                                    <option value="<?php echo $da->id ?>"><?php echo $da->fuel_type; ?></option>
                                    <?php }} ?>
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
                                 <select class="form-control" name="passenger_carrying" id="passenger_carrying">
                                 </select>
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
                                 <label>Regn no</label>*<span id='regn_no_span' style='color:red'> </span>
                              </div>
                              <div class="col-md-2 inputs">
                                 <input type="text" class="form-control inputs" name="regn_no_1" id="regn_no_1" maxlength="2">
                              </div>
                              <div class="col-md-2 inputs">
                                 <input type="text" class="form-control inputs" name="regn_no_2" id="regn_no_2" maxlength="2">
                              </div>
                              <div class="col-md-2 inputs">
                                 <input type="text" class="form-control inputs" name="regn_no_3" id="regn_no_3" maxlength="2">
                              </div>
                              <div class="col-md-2 inputs">
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
                                 <select class="form-control select2" name="rto" id="rto" style="width:100%">
                                    <option value="">--select--</option>
                                    <?php foreach($rto as $da){
                                       if($da->id != "1" && $da->id != "2" && $da->id != "3" && $da->id != "4" && $da->id != "5" && $da->id != "6")
                                       {
                                       ?>
                                    <option value="<?php echo $da->rto_no ?>"><?php echo $da->rto_no." ( ".$da->city." )"; ?></option>
                                    <?php }} ?>
                                 </select>
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
                                    <?php foreach($state as $da){?>
                                    <option value="<?php echo $da->id ?>"><?php echo $da->name; ?></option>
                                    <?php } ?>
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
            <!--  <div class="box">-->
            <!--    <div class="box-header with-border" style="background:#f4f4f48c;">-->
            <!--        <h3 class="box-title" _msthash="26273" _msttexthash="60619" style="text-align: left;font-size:14px;"><i class="fa fa-bars" aria-hidden="true"></i> &nbsp;&nbsp; Personal Details </h3>-->
            <!--        <div class="box-tools pull-right">-->
            <!--             <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse">-->
            <!--              <i class="fa fa-minus"></i></button>-->
            <!--        </div>-->
            <!--    </div>-->
            <!--    <div class="box-body" _msthash="1196936" _msttexthash="1190501" >-->
            <!--       <div class="form-group">-->
            <!--           <div class="row">-->
            <!--               <div class="col-md-6">-->
            <!--                   <div class="form-group">-->
            <!--                       <div class="row">-->
            <!--                           <div class="col-md-4">-->
            <!--                               <label>Vechicle Username</label>-->
            <!--                           </div>-->
            <!--                           <div class="col-md-8">-->
            <!--                               <input type="text" class="form-control" name="vechi_user_name" id="vechi_user_name">-->
            <!--                           </div>-->
            <!--                       </div>-->
            <!--                   </div>-->
            <!--               </div>-->
            <!--               <div class="col-md-6">-->
            <!--                   <div class="form-group">-->
            <!--                       <div class="row">-->
            <!--                           <div class="col-md-4">-->
            <!--                               <label>Vechicle User Contact Details</label>-->
            <!--                           </div>-->
            <!--                           <div class="col-md-8">-->
            <!--                               <input type="text" class="form-control" name="vechi_user_cont" id="vechi_user_cont">-->
            <!--                           </div>-->
            <!--                       </div>-->
            <!--                   </div>-->
            <!--               </div>-->
            <!--           </div>-->
            <!--       </div>-->
            <!--  </div>-->
            <!--</div> -->
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
                  <option value="Spouse">Spouse</option>
                  <option value="Daughter">Daughter</option>
                  <option value="Son">Son</option>
                  <option value="Father">Father</option>
                  <option value="Mother">Mother</option>
               </select>
            </div>
            <div class="form-group">
               <div class="row" id="row_id">
                  <!--<div class="col-md-6">-->
                  <!--   <label>No of Daughter's</label>   -->
                  <!--   <div class="input-group">-->
                  <!--       <input type="text" class="form-control" name="num_daughters" id="num_daughters">-->
                  <!--       <span class="input-group-addon"><i class="fa fa-plus"></i></span>-->
                  <!--   </div>-->
                  <!--</div>-->
                  <!--<div class="col-md-6">-->
                  <!--   <label>No of Sons's</label> -->
                  <!--   <div class="input-group">-->
                  <!--       <input type="text" class="form-control" name="num_sons" id="num_sons">-->
                  <!--       <span class="input-group-addon"><i class="fa fa-plus"></i></span>-->
                  <!--   </div>-->
                  <!--</div>-->
               </div>
            </div>
            <div id="you_div" class="hidden">
               <div class='row'>
                  <div class='col-md-3'>
                     <div id="ins_div"><img src='../datas/icons/male1.png' style='height:50px;width:50px;'></div>
                     <label>You (Insurer)</label>
                  </div>
                  <div class='col-md-3'>   
                     <label>Insurer Name</label>
                     <input type='text' class="form-control" name="add_you_name" id="add_you_name" >
                  </div>
                  <div class='col-md-3'> 
                     <label>DOB</label>
                     <input type='date' class="form-control" name="add_dob" id="add_dob">
                  </div>
                  <div class='col-md-3'>
                     <label>Age</label>
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
                  <div class='col-md-3'>
                     <div id="hus_wife_div"><img src='../datas/icons/wife.png' style='height:50px;width:50px;'></div>
                     <label>Spouse</label>
                  </div>
                  <div class='col-md-3'>   
                     <label>Name</label>
                     <input type='text' class="form-control" name="hus_wife_name" id="hus_wife_name" >
                  </div>
                  <div class='col-md-3'> 
                     <label>DOB</label>
                     <input type='date' class="form-control" name="add_hus_wife_dob" id="add_hus_wife_dob">
                  </div>
                  <div class='col-md-3'>
                     <label>Age</label>
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
                  <div class='col-md-3'>
                     <div><img src="../datas/icons/daughter.png" style="height:50px;width:50px;"></div>
                     <label>Daughter 1</label>
                  </div>
                  <div class='col-md-3'>   
                     <label>Name</label>
                     <input type='text' class="form-control" name="add_daughter_name_1" id="add_daughter_name_1" >
                  </div>
                  <div class='col-md-3'> 
                     <label>DOB</label>
                     <input type='date' class="form-control" name="add_daughter_dob_1" id="add_daughter_dob_1">
                  </div>
                  <div class='col-md-3'>
                     <label>Age</label>
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
                  <div class='col-md-3'>
                     <div><img src="../datas/icons/daughter.png" style="height:50px;width:50px;"></div>
                     <label>Daughter 2</label>
                  </div>
                  <div class='col-md-3'>   
                     <label>Name</label>
                     <input type='text' class="form-control" name="add_daughter_name_2" id="add_daughter_name_2" >
                  </div>
                  <div class='col-md-3'> 
                     <label>DOB</label>
                     <input type='date' class="form-control" name="add_daughter_dob_2" id="add_daughter_dob_2">
                  </div>
                  <div class='col-md-3'>
                     <label>Age</label>
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
                  <div class='col-md-3'>
                     <div><img src="../datas/icons/daughter.png" style="height:50px;width:50px;"></div>
                     <label>Daughter 3</label>
                  </div>
                  <div class='col-md-3'>   
                     <label>Name</label>
                     <input type='text' class="form-control" name="add_daughter_dob_3" id="add_daughter_dob_3" >
                  </div>
                  <div class='col-md-3'> 
                     <label>DOB</label>
                     <input type='date' class="form-control" name="add_daughter_name_3" id="add_daughter_name_3">
                  </div>
                  <div class='col-md-3'>
                     <label>Age</label>
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
                  <div class='col-md-3'>
                     <div><img src="../datas/icons/daughter.png" style="height:50px;width:50px;"></div>
                     <label>Daughter 4</label>
                  </div>
                  <div class='col-md-3'>   
                     <label>Name</label>
                     <input type='text' class="form-control" name="add_daughter_dob_4" id="add_daughter_dob_4" >
                  </div>
                  <div class='col-md-3'> 
                     <label>DOB</label>
                     <input type='date' class="form-control" name="add_daughter_name_4" id="add_daughter_name_4">
                  </div>
                  <div class='col-md-6'>
                     <label>Age</label>
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
                  <div class='col-md-3'>
                     <div><img src="../datas/icons/son.png" style="height:50px;width:50px;"></div>
                     <label>Son 1</label>
                  </div>
                  <div class='col-md-3'>   
                     <label>Name</label>
                     <input type='text' class="form-control" name="add_son_name_1" id="add_son_name_1">
                  </div>
                  <div class='col-md-3'> 
                     <label>DOB</label>
                     <input type='date' class="form-control" name="add_son_dob_1" id="add_son_dob_1">
                  </div>
                  <div class='col-md-3'>
                     <label>Age</label>
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
                  <div class='col-md-3'>
                     <div><img src="../datas/icons/son.png" style="height:50px;width:50px;"></div>
                     <label>Son 2</label>
                  </div>
                  <div class='col-md-3'>   
                     <label>Name</label>
                     <input type='text' class="form-control" name="add_son_name_2" id="add_son_name_2">
                  </div>
                  <div class='col-md-3'> 
                     <label>DOB</label>
                     <input type='date' class="form-control" name="add_son_dob_2" id="add_son_dob_2">
                  </div>
                  <div class='col-md-3'>
                     <label>Age</label>
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
                  <div class='col-md-3'>
                     <div><img src="../datas/icons/son.png" style="height:50px;width:50px;"></div>
                     <label>Son 3</label>
                  </div>
                  <div class='col-md-3'>   
                     <label>Name</label>
                     <input type='text' class="form-control" name="add_son_name_3" id="add_son_name_3">
                  </div>
                  <div class='col-md-3'> 
                     <label>DOB</label>
                     <input type='date' class="form-control" name="add_son_dob_3" id="add_son_dob_3">
                  </div>
                  <div class='col-md-3'>
                     <label>Age</label>
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
                  <div class='col-md-3'>
                     <div><img src="../datas/icons/son.png" style="height:50px;width:50px;"></div>
                     <label>Son 4</label>
                  </div>
                  <div class='col-md-3'>   
                     <label>Name</label>
                     <input type='text' class="form-control" name="add_son_name_4" id="add_son_name_4">
                  </div>
                  <div class='col-md-3'> 
                     <label>DOB</label>
                     <input type='date' class="form-control" name="add_son_dob_4" id="add_son_dob_4">
                  </div>
                  <div class='col-md-3'>
                     <label>Age</label>
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
               <div class='col-md-3'>
                  <div><img src="../datas/icons/grandpa.png" style="height:50px;width:50px;"></div>
                  <label>Father</label>
               </div>
               <div class='col-md-3'>   
                  <label>Name</label>
                  <input type='text' class="form-control" name="add_father_name" id="add_father_name">
               </div>
               <div class='col-md-3'> 
                  <label>DOB</label>
                  <input type='date' class="form-control" name="add_father_dob" id="add_father_dob">
               </div>
               <div class='col-md-3'>
                  <label>Age</label> 
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
               <div class='col-md-3'>
                  <div><img src="../datas/icons/grandma.png" style="height:50px;width:50px;"></div>
                  <label>Mother</label>
               </div>
               <div class='col-md-3'>   
                  <label>Name</label>
                  <input type='text' class="form-control" name="add_mother_name" id="add_mother_name">
               </div>
               <div class='col-md-3'> 
                  <label>DOB</label>
                  <input type='date' class="form-control" name="add_dob_mother" id="add_dob_mother">
               </div>
               <div class='col-md-3'>
                  <label>Age</label> 
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
<div class="modal fade in" id="edit_health_model">
   <div class="modal-dialog">
      <div class="modal-content modal-lg-content">
         <div class="modal-header bg-primary">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true" style="color:white;">×</span></button>
            <h4 class="modal-title text-center" style="color:white;">Edit Health Details</h4>
         </div>
         <div class="modal-body">
            <input type="text" class="hidden" id="edit_created_id" value="<?php echo $this->session->userdata('session_id'); ?>">  
            <div class="form-group">
               <label>Gender</label><span id="edit_add_name_error" style="color: red;">*</span>
               <select class="form-control" name="edit_h_gender" id="edit_h_gender">
                  <option value="Male">Male</option>
                  <option value="Female">Female</option>
               </select>
            </div>
            <div class="form-group">
               <label>Select members you want to insure </label><span id="edit_add_name_error" style="color: red;">*</span>
               <select placeholder="--Select--" class="form-control select2" multiple="multiple" name="edit_h_family_members" id="edit_h_family_members" style="width:100%;">
                  <option value="You">You</option>
                  <option value="Spouse">Wife</option>
                  <option value="Daughter">Daughter</option>
                  <option value="Son">Son</option>
                  <option value="Father">Father</option>
                  <option value="Mother">Mother</option>
               </select>
            </div>
            <div class="form-group">
               <div class="row" id="edit_row_id">
               </div>
            </div>
            <div id="edit_you_div" class="hidden">
               <div class='row'>
                  <div class='col-md-3'>
                     <div id="ins_div"><img src='../datas/icons/male1.png' style='height:50px;width:50px;'></div>
                     <label>You (Insurer)</label>
                  </div>
                  <div class='col-md-3'>   
                     <label>Insurer Name</label>
                     <input type='text' class="form-control" name="edit_you_name" id="edit_you_name" >
                  </div>
                  <div class='col-md-3'> 
                     <label>DOB</label>
                     <input type='date' class="form-control" name="edit_dob" id="edit_dob">
                  </div>
                  <div class='col-md-3'>
                     <label>Age</label>
                     <select class='form-control' name='edit_you_age' id='edit_you_age'>
                        <option value=''>Age</option>
                        <?php for($i = 18; $i <= 100; $i++){ ?>
                        <option value="<?php echo $i; ?>"><?php echo $i; ?> Years</option>
                        <?php } ?>
                     </select>
                  </div>
               </div>
            </div>
            <p></p>
            <div id="edit_husband_wife_div" class="hidden">
               <div class='row'>
                  <div class='col-md-3'>
                     <div id="hus_wife_div"><img src='../datas/icons/wife.png' style='height:50px;width:50px;'></div>
                     <label>Spouse</label>
                  </div>
                  <div class='col-md-3'>   
                     <label>Name</label>
                     <input type='text' class="form-control" name="edit_hus_wife_name" id="edit_hus_wife_name" >
                  </div>
                  <div class='col-md-3'> 
                     <label>DOB</label>
                     <input type='date' class="form-control" name="edit_hus_wife_dob" id="edit_hus_wife_dob">
                  </div>
                  <div class='col-md-3'>
                     <label>Age</label>
                     <select class='form-control' name='edit_hus_wife_age' id='edit_hus_wife_age'>
                        <option value=''>Age</option>
                        <?php for($i = 18; $i <= 100; $i++){ ?>
                        <option value="<?php echo $i; ?>"><?php echo $i; ?> Years</option>
                        <?php } ?>
                     </select>
                  </div>
               </div>
            </div>
            <p></p>
            <div id="edit_daughter_div1" class="hidden">
               <div class="row">
                  <div class='col-md-3'>
                     <div><img src="../datas/icons/daughter.png" style="height:50px;width:50px;"></div>
                     <label>Daughter 1</label>
                  </div>
                  <div class='col-md-3'>   
                     <label>Name</label>
                     <input type='text' class="form-control" name="edit_daughter_name_1" id="edit_daughter_name_1" >
                  </div>
                  <div class='col-md-3'> 
                     <label>DOB</label>
                     <input type='date' class="form-control" name="edit_daughter_dob_1" id="edit_daughter_dob_1">
                  </div>
                  <div class='col-md-3'>
                     <label>Age</label>
                     <select class='form-control' name='edit_daughter_age_1' id='edit_daughter_age_1'>
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
            <div id="edit_daughter_div2" class="hidden">
               <div class="row">
                  <div class='col-md-3'>
                     <div><img src="../datas/icons/daughter.png" style="height:50px;width:50px;"></div>
                     <label>Daughter 2</label>
                  </div>
                  <div class='col-md-3'>   
                     <label>Name</label>
                     <input type='text' class="form-control" name="edit_daughter_name_2" id="edit_daughter_name_2" >
                  </div>
                  <div class='col-md-3'> 
                     <label>DOB</label>
                     <input type='date' class="form-control" name="edit_daughter_dob_2" id="edit_daughter_dob_2">
                  </div>
                  <div class='col-md-3'>
                     <label>Age</label>
                     <select class='form-control' name='edit_daughter_age_2' id='edit_daughter_age_2'>
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
            <div id="edit_daughter_div3" class="hidden">
               <div class="row">
                  <div class='col-md-3'>
                     <div><img src="../datas/icons/daughter.png" style="height:50px;width:50px;"></div>
                     <label>Daughter 3</label>
                  </div>
                  <div class='col-md-3'>   
                     <label>Name</label>
                     <input type='text' class="form-control" name="edit_daughter_dob_3" id="edit_daughter_dob_3" >
                  </div>
                  <div class='col-md-3'> 
                     <label>DOB</label>
                     <input type='date' class="form-control" name="edit_daughter_name_3" id="edit_daughter_name_3">
                  </div>
                  <div class='col-md-3'>
                     <label>Age</label>
                     <select class='form-control' name='edit_daughter_age_3' id='edit_daughter_age_3'>
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
            <div id="edit_daughter_div4" class="hidden">
               <div class="row">
                  <div class='col-md-3'>
                     <div><img src="../datas/icons/daughter.png" style="height:50px;width:50px;"></div>
                     <label>Daughter 4</label>
                  </div>
                  <div class='col-md-3'>   
                     <label>Name</label>
                     <input type='text' class="form-control" name="edit_daughter_name_4" id="edit_daughter_name_4" >
                  </div>
                  <div class='col-md-3'> 
                     <label>DOB</label>
                     <input type='date' class="form-control" name="edit_daughter_dob_4" id="edit_daughter_dob_4">
                  </div>
                  <div class='col-md-6'>
                     <label>Age</label>
                     <select class='form-control' name='edit_daughter_age_4' id='edit_daughter_age_4'>
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
            <div id="edit_son_div1" class="hidden">
               <div class="row">
                  <div class='col-md-3'>
                     <div><img src="../datas/icons/son.png" style="height:50px;width:50px;"></div>
                     <label>Son 1</label>
                  </div>
                  <div class='col-md-3'>   
                     <label>Name</label>
                     <input type='text' class="form-control" name="edit_son_name_1" id="edit_son_name_1">
                  </div>
                  <div class='col-md-3'> 
                     <label>DOB</label>
                     <input type='date' class="form-control" name="edit_son_dob_1" id="edit_son_dob_1">
                  </div>
                  <div class='col-md-3'>
                     <label>Age</label>
                     <select class='form-control' name='edit_son_age_1' id='edit_son_age_1'>
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
            <div id='edit_son_div2' class="hidden">
               <div class="row">
                  <div class='col-md-3'>
                     <div><img src="../datas/icons/son.png" style="height:50px;width:50px;"></div>
                     <label>Son 2</label>
                  </div>
                  <div class='col-md-3'>   
                     <label>Name</label>
                     <input type='text' class="form-control" name="edit_son_name_2" id="edit_son_name_2">
                  </div>
                  <div class='col-md-3'> 
                     <label>DOB</label>
                     <input type='date' class="form-control" name="edit_son_dob_2" id="edit_son_dob_2">
                  </div>
                  <div class='col-md-3'>
                     <label>Age</label>
                     <select class='form-control' name='edit_son_age_2' id='edit_son_age_2'>
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
            <div id="edit_son_div3" class="hidden">
               <div class="row">
                  <div class='col-md-3'>
                     <div><img src="../datas/icons/son.png" style="height:50px;width:50px;"></div>
                     <label>Son 3</label>
                  </div>
                  <div class='col-md-3'>   
                     <label>Name</label>
                     <input type='text' class="form-control" name="edit_son_name_3" id="edit_son_name_3">
                  </div>
                  <div class='col-md-3'> 
                     <label>DOB</label>
                     <input type='date' class="form-control" name="edit_son_dob_3" id="edit_son_dob_3">
                  </div>
                  <div class='col-md-3'>
                     <label>Age</label>
                     <select class='form-control' name='edit_son_age_3' id='edit_son_age_3'>
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
            <div id="edit_son_div4" class="hidden">
               <div class="row">
                  <div class='col-md-3'>
                     <div><img src="../datas/icons/son.png" style="height:50px;width:50px;"></div>
                     <label>Son 4</label>
                  </div>
                  <div class='col-md-3'>   
                     <label>Name</label>
                     <input type='text' class="form-control" name="edit_son_name_4" id="edit_son_name_4">
                  </div>
                  <div class='col-md-3'> 
                     <label>DOB</label>
                     <input type='date' class="form-control" name="edit_son_dob_4" id="edit_son_dob_4">
                  </div>
                  <div class='col-md-3'>
                     <label>Age</label>
                     <select class='form-control' name='edit_son_age_4' id='edit_son_age_4'>
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
            <div class='row hidden'  id='edit_father_div'>
               <div class='col-md-3'>
                  <div><img src="../datas/icons/grandpa.png" style="height:50px;width:50px;"></div>
                  <label>Father</label>
               </div>
               <div class='col-md-3'>   
                  <label>Name</label>
                  <input type='text' class="form-control" name="edit_father_name" id="edit_father_name">
               </div>
               <div class='col-md-3'> 
                  <label>DOB</label>
                  <input type='date' class="form-control" name="edit_father_dob" id="edit_father_dob">
               </div>
               <div class='col-md-3'>
                  <label>Age</label> 
                  <select class='form-control' name='edit_father_age' id='edit_father_age'>
                     <option value=''>Age</option>
                     <?php for($i = 18; $i <= 100; $i++){ ?>
                     <option value="<?php echo $i; ?>"><?php echo $i; ?> Years</option>
                     <?php } ?>
                  </select>
               </div>
            </div>
            <p></p>
            <div class='row hidden' id="edit_mother_div">
               <div class='col-md-3'>
                  <div><img src="../datas/icons/grandma.png" style="height:50px;width:50px;"></div>
                  <label>Mother</label>
               </div>
               <div class='col-md-3'>   
                  <label>Name</label>
                  <input type='text' class="form-control" name="edit_mother_name" id="edit_mother_name">
               </div>
               <div class='col-md-3'> 
                  <label>DOB</label>
                  <input type='date' class="form-control" name="edit_dob_mother" id="edit_dob_mother">
               </div>
               <div class='col-md-3'>
                  <label>Age</label> 
                  <select class='form-control' name='edit_mother_age' id='edit_mother_age'>
                     <option value=''>Age</option>
                     <?php for($i = 18; $i <= 100; $i++){ ?>
                     <option value="<?php echo $i; ?>"><?php echo $i; ?> Years</option>
                     <?php } ?>
                  </select>
               </div>
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-sm btn-primary"  id="edit_health_btn">Submit</button>
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
               <input type="button" id="pet_female_btn" class="btn btn-light" style="border: none;" value="Female">
            </center>
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
            <center>
               <h4 class="modal-title">Best Home Insurance</h4>
            </center>
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
                        <?php for($nos = 1; $nos <= 10; $nos++):?>
                        <option <?=(( $nos == $horesult->home_policy_tenure) ? "selected" : "")?>><?=$nos?> Year</option>
                        <?php endfor;?>                						    
                     </select>
                  </div>
                  <div class="form-group">
                     <label>Property Value</label>  
                     <div class="input-group">
                        <div class="input-group-addon">₹ </div>
                        <input type="number" class="form-control" id="home_property_value" value="<?=$horesult->home_property_value?>">
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
                        <?php for($nos = 1; $nos <= 29; $nos++):?>
                        <option <?=(( $nos == $horesult->home_age_premises) ? "selected" : "")?>><?=$nos?> Year</option>
                        <?php endfor;?>                    				    
                     </select>
                  </div>
                  <div class="form-group">
                     <label>Built Up Area</label>
                     <div class="input-group">
                        <input type="number" class="form-control" id="home_sqft" value="<?=$horesult->home_sqft?>">
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
            <center>
               <h4 class="modal-title">Best Business Insurance</h4>
            </center>
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
                        <input type="number" class="form-control" id="business_sqft" value="">
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
                        <input type="number" onclick="marine_calculate()" class="form-control" id="marine_invoice_val">
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
                                 <select class="form-control" name="edit_vechile_type" id="edit_vechile_type" disabled>
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
                                 <select class="form-control select2" name="edit_vechi_manu_year" id="edit_vechi_manu_year" style='width:100%' placeholder="Manufacture Year">
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
                                    <option value="">--select--</option>
                                    <?php foreach($fuel_type as $da){ if($da->id != "4"){?>
                                    <option value="<?php echo $da->id ?>"><?php echo $da->fuel_type; ?></option>
                                    <?php }} ?>
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
                                 <select class="form-control" name="edit_passenger_carrying" id="edit_passenger_carrying">
                                 </select>
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
                                 <select class="form-control" name="edit_rto" id="edit_rto">
                                    <option value="">--select--</option>
                                    <?php foreach($rto as $da){
                                       if($da->id != "1" || $da->id != "2" || $da->id != "3" || $da->id != "4" || $da->id != "5" || $da->id != "6")
                                       {
                                       ?>
                                    <option value="<?php echo $da->rto_no ?>"><?php echo $da->rto_no." ( ".$da->city." )"; ?></option>
                                    <?php }} ?>
                                 </select>
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
                                    <?php foreach($state as $da){?>
                                    <option value="<?php echo $da->id ?>"><?php echo $da->name; ?></option>
                                    <?php } ?>
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
            <!--  <div class="box">-->
            <!--    <div class="box-header with-border" style="background:#f4f4f48c;">-->
            <!--        <h3 class="box-title" _msthash="26273" _msttexthash="60619" style="text-align: left;font-size:14px;"><i class="fa fa-bars" aria-hidden="true"></i> &nbsp;&nbsp; Personal Details </h3>-->
            <!--        <div class="box-tools pull-right">-->
            <!--             <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse">-->
            <!--              <i class="fa fa-minus"></i></button>-->
            <!--        </div>-->
            <!--    </div>-->
            <!--    <div class="box-body" _msthash="1196936" _msttexthash="1190501" >-->
            <!--       <div class="form-group">-->
            <!--           <div class="row">-->
            <!--               <div class="col-md-6">-->
            <!--                   <div class="form-group">-->
            <!--                       <div class="row">-->
            <!--                           <div class="col-md-4">-->
            <!--                               <label>Vechicle Username</label>-->
            <!--                           </div>-->
            <!--                           <div class="col-md-8">-->
            <!--                               <input type="text" class="form-control" name="edit_vechi_user_name" id="edit_vechi_user_name">-->
            <!--                           </div>-->
            <!--                       </div>-->
            <!--                   </div>-->
            <!--               </div>-->
            <!--               <div class="col-md-6">-->
            <!--                   <div class="form-group">-->
            <!--                       <div class="row">-->
            <!--                           <div class="col-md-4">-->
            <!--                               <label>Vechicle User Contact Details</label>-->
            <!--                           </div>-->
            <!--                           <div class="col-md-8">-->
            <!--                               <input type="text" class="form-control" name="edit_vechi_user_cont" id="edit_vechi_user_cont">-->
            <!--                           </div>-->
            <!--                       </div>-->
            <!--                   </div>-->
            <!--               </div>-->
            <!--           </div>-->
            <!--       </div>-->
            <!--  </div>-->
            <!--</div> -->
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
                     &nbsp;&nbsp;Create Quotation
                  </h4>
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
                                 <label>RTO</label>
                              </div>
                              <div class="col-md-8">
                                 <select class="form-control" name="q_rto_code" id="q_rto_code">
                                    <option value="">--select--</option>
                                    <?php foreach($rto as $da){
                                       if($da->id != "1" || $da->id != "2" || $da->id != "3" || $da->id != "4" || $da->id != "5" || $da->id != "6")
                                       {
                                       ?>
                                    <option value="<?php echo $da->rto_no ?>"><?php echo $da->rto_no." ( ".$da->city." )"; ?></option>
                                    <?php }} ?>
                                 </select>
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
<div id="sme_modal" class="modal fade" role="dialog">
   <div class="modal-dialog  modal-lg">
      <div class="modal-content modal-lg-content">
         <div class="modal-header" style="background:#778d9d;">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title" style="color:#fff;">SME Details</h4>
            <button class="btn btn-success btn-sm pull-right" id="add_sme_info" style='margin-top: -31px;margin-right: 27px;'><i class="fa fa-save"></i> Save</button>
         </div>
         <div class="modal-body">
            <section class="content">
               <div class="box">
                  <div class="box-header with-border" style="background:#f4f4f48c;">
                     <h3 class="box-title" _msthash="26273" _msttexthash="60619" style="text-align: left;font-size:14px;"><i class="fa fa-user" aria-hidden="true"></i> &nbsp;&nbsp;SME Details</h3>
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
                                    <label>SME Policy</label>
                                 </div>
                                 <div class="col-md-8">
                                    <select class="form-control" name="sme_id" id="sme_id">
                                       <option value="">--select--</option>
                                    </select>
                                 </div>
                              </div>
                           </div>
                           <div class ="hidden" id="marine">
                              <div class="form-group">
                                 <div class="row">
                                    <div class="col-md-4">
                                       <label>Period of Insurance</label>
                                    </div>
                                    <div class="col-md-4">
                                       <input type="date" class="form-control" name="from_date" id="from_date">
                                    </div>
                                    <div class="col-md-4">
                                       <input type="date" class="form-control" name="to_date" id="to_date">
                                    </div>
                                 </div>
                              </div>
                              <div class="form-group">
                                 <div class="row">
                                    <div class="col-md-4">
                                       <label>Commodity/ Interest</label>
                                    </div>
                                    <div class="col-md-8">
                                       <input type="text" class="form-control" name="commodity_interest" id="commodity_interest" value = "Industrial Oil, Furnace Oil, Fuel oil , low and High density oil,industrial mixed solvent , Base Oil , Low aromatic white spirit">
                                    </div>
                                 </div>
                              </div>
                              <div class="form-group">
                                 <div class="row">
                                    <div class="col-md-4">
                                       <label>Basis of Valuation</label>
                                    </div>
                                 </div>
                                 <div class ="row">
                                    <div class="col-md-4">
                                       <label>Import</label>
                                       <textarea class="form-control" name="b_valuation_import" id="b_valuation_import" rows="3" >C&F / FOB / Exworks / CIF) + 10% + Duty at Actuals</textarea>
                                    </div>
                                    <div class="col-md-4">
                                       <label>Export</label>
                                       <textarea class="form-control" name="b_valuation_export" id="b_valuation_export" rows="3"  >CIF + 10%, FOB + 20%</textarea>
                                    </div>
                                    <div class="col-md-3">
                                       <label>Inland</label>
                                       <textarea  class="form-control" name="b_valuation_inland" id="b_valuation_inland" rows="3" >Invoice + 10% Interdepot /Interunit Transfers (Stock Transfer Note Value / InvoiceValue / Consignment Note Value) + Freight at Actuals</textarea>
                                    </div>
                                 </div>
                              </div>
                              <div class="form-group">
                                 <div class="row">
                                    <div class="col-md-4">
                                       <label>Annual Sales Turnover</label>
                                    </div>
                                    <div class="col-md-8">
                                       <input type="text" class="form-control" name="add_turnover" id="add_turnover">
                                    </div>
                                 </div>
                              </div>
                              <div class="row">
                                 <div class="col-md-4">
                                    <label style ="color:#2E86C1;" >Sales:</label>
                                 </div>
                              </div>
                              <div class="form-group">
                                 <div class="row">
                                    <div class="col-md-4">
                                       <label>Domestic</label>
                                    </div>
                                    <div class="col-md-8">
                                       <input type="text" class="form-control" name="add_domestic" id="add_domestic">
                                    </div>
                                 </div>
                              </div>
                              <div class="row">
                                 <div class="col-md-4">
                                    <label style ="color:#2E86C1;">Purchase:</label>
                                 </div>
                              </div>
                              <div class="form-group">
                                 <div class="row">
                                    <div class="col-md-4">
                                       <label>Import</label>
                                    </div>
                                    <div class="col-md-8">
                                       <input type="text" class="form-control" name="add_import" id="add_import">
                                    </div>
                                 </div>
                              </div>
                              <div class="form-group">
                                 <div class="row">
                                    <div class="col-md-4">
                                       <label>Per Bottom Limit (Inland)</label>
                                    </div>
                                    <div class="col-md-8">
                                       <input type="text" class="form-control" name="bottom_inland_limit" id="bottom_inland_limit">
                                    </div>
                                 </div>
                              </div>
                              <div class="form-group">
                                 <div class="row">
                                    <div class="col-md-4">
                                       <label>Per Location Limit (Inland)</label>
                                    </div>
                                    <div class="col-md-8">
                                       <input type="text" class="form-control" name="location_inland" id="location_inland">
                                    </div>
                                 </div>
                              </div>
                              <div class="form-group">
                                 <div class="row">
                                    <div class="col-md-4">
                                       <label>Covering Clauses</label>
                                    </div>
                                    <div class="col-md-8">
                                       <div class='row'>
                                          <div class="col-md-8">
                                             <input type="text" style="margin:5px; width:97%;" id="covering_clauses" class="form-control coveringclauses">
                                             <div id="add_covering_clauses">
                                             </div>
                                          </div>
                                          <div class="col-md-4">
                                             <button id="sub_covering_btn" class="btn btn-info btn-sm pull-right"> - </button>
                                             <button id="add_covering_btn" class="btn btn-info btn-sm pull-right" style="margin-right:5px;"> + </button>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <div class="form-group">
                                 <div class="row">
                                    <div class="col-md-4">
                                       <label>Date</label>
                                    </div>
                                    <div class="col-md-8">
                                       <input type="date" class="form-control" name="date" id="date">
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="hidden" id="marine_remove">
                              <div class="form-group">
                                 <div class="row">
                                    <div class="col-md-4">
                                       <label>Packing</label>
                                    </div>
                                    <div class="col-md-8">
                                       <input type="text" class="form-control" name="packing" id="packing">
                                    </div>
                                 </div>
                              </div>
                              <div class="form-group">
                                 <div class="row">
                                    <div class="col-md-4">
                                       <label>Occupancy</label>
                                    </div>
                                    <div class="col-md-8">
                                       <input type="text" class="form-control" name="occupancy" id="occupancy">
                                    </div>
                                 </div>
                              </div>
                              <div class="form-group">
                                 <div class="row">
                                    <div class="col-md-4">
                                       <label>Mode of Transport</label>
                                    </div>
                                    <div class="col-md-8">
                                       <select class = "form-control" name="transport" id="transport">
                                          <option value = "">--Select--</option>
                                          <option value = "Rail">Rail</option>
                                          <option value = "Road">Road</option>
                                          <option value = "Air">Air</option>
                                          <option value = "Sea">Sea</option>
                                       </select>
                                    </div>
                                 </div>
                              </div>
                              <div class="form-group">
                                 <div class="row">
                                    <div class="col-md-4">
                                       <label>Voyage</label>
                                    </div>
                                 </div>
                                 <div class ="row">
                                    <div class="col-md-4">
                                       <label>Import</label>
                                       <textarea class="form-control" name="voyage_import" id="voyage_import" rows="3">From: Anywhere in India To: Anywhere in the World</textarea>
                                    </div>
                                    <div class="col-md-4">
                                       <label>Export</label>
                                       <textarea class="form-control" name="voyage_export" id="voyage_export" rows="3">From: Anywhere in the World To: Anywhere in India</textarea>
                                    </div>
                                    <div class="col-md-4">
                                       <label>Inland</label>
                                       <textarea class="form-control" name="voyage_inland" id="voyage_inland" rows="3">From: Anywhere in India To: Anywhere in India</textarea>
                                    </div>
                                 </div>
                              </div>
                              <div class="form-group">
                                 <div class="row">
                                    <div class="col-md-4">
                                       <label>Initial Sum Insured Required</label>
                                    </div>
                                    <div class="col-md-8">
                                       <input type="text" class="form-control" name="initial_sum_insured" id="initial_sum_insured">
                                    </div>
                                 </div>
                              </div>
                              <div class="row">
                                 <div class="col-md-4">
                                    <label style ="color:#2E86C1;">Insurer:</label>
                                 </div>
                              </div>
                              <div class="form-group">
                                 <div class="row">
                                    <div class="col-md-4">
                                       <label>Current Insurer</label>
                                    </div>
                                    <div class="col-md-8">
                                       <input type="text" class="form-control" name="current_insurer" id="current_insurer">
                                    </div>
                                 </div>
                              </div>
                              <div class="row">
                                 <div class="col-md-4">
                                    <label style ="color:#2E86C1;"></label>
                                 </div>
                              </div>
                              <div class="form-group">
                                 <div class="row">
                                    <div class="col-md-4">
                                       <label>Domestic</label>
                                    </div>
                                    <div class="col-md-8">
                                       <input type="text" class="form-control" name="purchase_domestic" id="purchase_domestic">
                                    </div>
                                 </div>
                              </div>
                              <div class="form-group">
                                 <div class="row">
                                    <div class="col-md-4">
                                       <label>Per Bottom Limit (Import)</label>
                                    </div>
                                    <div class="col-md-8">
                                       <input type="text" class="form-control" name="bottom_import_limit" id="bottom_import_limit">
                                    </div>
                                 </div>
                              </div>
                              <div class="form-group">
                                 <div class="row">
                                    <div class="col-md-4">
                                       <label>Per Location Limit (Import)</label>
                                    </div>
                                    <div class="col-md-8">
                                       <input type="text" class="form-control" name="location_import_limit" id="location_import_limit">
                                    </div>
                                 </div>
                              </div>
                              <div class="form-group">
                                 <div class="row">
                                    <div class="col-md-4">
                                       <label>Claim History</label>
                                    </div>
                                    <div class="col-md-8">
                                       <textarea class="form-control" name="claim_history" id="claim_history" rows="3"></textarea>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class = "row hidden fire_div">
                        <div class ="col-md-6">
                           <div class="hidden fire_div">
                              <div class="form-group">
                                 <div class="row">
                                    <div class="col-md-4">
                                       <label>Period of Insurance</label>
                                    </div>
                                    <div class="col-md-4">
                                       <input type="date" class="form-control" name="fire_from_date" id="fire_from_date">
                                    </div>
                                    <div class="col-md-4">
                                       <input type="date" class="form-control" name="fire_to_date" id="fire_to_date">
                                    </div>
                                 </div>
                              </div>
                              <div class="form-group">
                                 <div class="row">
                                    <div class="col-md-4">
                                       <label>Financial Institution</label>
                                    </div>
                                    <div class="col-md-8">
                                       <input type="text" class="form-control" name="financial_institution" id="financial_institution">
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class = "col-md-6 hidden fire_div">
                           <div class="form-group">
                              <div class="row">
                                 <div class="col-md-4">
                                    <label>Occupancy</label>
                                 </div>
                                 <div class="col-md-8">
                                    <input type="text" class="form-control" name="fire_occupancy" id="fire_occupancy">
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class = "row hidden fire_div">
                        <div class = "col-md-12">
                           <table class = "table table-bordered" style="width:100%">
                              <tr>
                                 <td rowspan="4">Sum Insured</td>
                                 <td>
                                    <div class="form-group">
                                       <label>Particulars</label>
                                       <textarea class="form-control" name="fire_particulars_1" id="fire_particulars_1"></textarea>
                                    </div>
                                 </td>
                                 <td>
                                    <div class="form-group">
                                       <label>Fire Sum Insured (In Lacs)</label>
                                       <input type="text" class="form-control" name="fire_sum_ins_1" id="fire_sum_ins_1">
                                    </div>
                                 </td>
                                 <td>
                                    <div class="form-group">
                                       <label>Fire Sum Insured (In Lacs)</label>
                                       <input type="text" class="form-control" name="burglary_sum_ins_1" id="burglary_sum_ins_1">
                                    </div>
                                 </td>
                              </tr>
                              <tr>
                                 <td>
                                    <div class="form-group">
                                       <label>Particulars</label>
                                       <textarea class="form-control" name="fire_particulars_2" id="fire_particulars_2"></textarea>
                                    </div>
                                 </td>
                                 <td>
                                    <div class="form-group">
                                       <label>Fire Sum Insured (In Lacs)</label>
                                       <input type="text" class="form-control" name="fire_sum_ins_2" id="fire_sum_ins_2">
                                    </div>
                                 </td>
                                 <td>
                                    <div class="form-group">
                                       <label>Fire Sum Insured (In Lacs)</label>
                                       <input type="text" class="form-control" name="burglary_sum_ins_2" id="burglary_sum_ins_2">
                                    </div>
                                 </td>
                              </tr>
                              <tr>
                                 <td>
                                    <div class="form-group">
                                       <label>Particulars</label>
                                       <textarea class="form-control" name="fire_particulars_3" id="fire_particulars_3"></textarea>
                                    </div>
                                 </td>
                                 <td>
                                    <div class="form-group">
                                       <label>Fire Sum Insured (In Lacs)</label>
                                       <input type="text" class="form-control" name="fire_sum_ins_3" id="fire_sum_ins_3">
                                    </div>
                                 </td>
                                 <td>
                                    <div class="form-group">
                                       <label>Fire Sum Insured (In Lacs)</label>
                                       <input type="text" class="form-control" name="burglary_sum_ins_3" id="burglary_sum_ins_3">
                                    </div>
                                 </td>
                              </tr>
                              <tr>
                                 <td>
                                    <div class="form-group">
                                       <label>Particulars</label>
                                       <textarea class="form-control" name="fire_particulars_4" id="fire_particulars_4"></textarea>
                                    </div>
                                 </td>
                                 <td>
                                    <div class="form-group">
                                       <label>Fire Sum Insured (In Lacs)</label>
                                       <input type="text" class="form-control" name="fire_sum_ins_4" id="fire_sum_ins_4">
                                    </div>
                                 </td>
                                 <td>
                                    <div class="form-group">
                                       <label>Fire Sum Insured (In Lacs)</label>
                                       <input type="text" class="form-control" name="burglary_sum_ins_4" id="burglary_sum_ins_4">
                                    </div>
                                 </td>
                              </tr>
                           </table>
                        </div>
                        <div class = "col-md-6">
                           <div class="form-group">
                              <div class="row">
                                 <div class="col-md-4">
                                    <label>Extension or Clause's Required under Burglary</label>
                                 </div>
                                 <div class="col-md-8">
                                    <select class = "form-control" name="clause_under_burglary" id="clause_under_burglary">
                                       <option value = "RSMD">RSMD</option>
                                       <option value = "Theft Extension">Theft Extension</option>
                                       <option value = "Goods Held in Trust">Goods Held in Trust</option>
                                    </select>
                                 </div>
                              </div>
                           </div>
                           <div class="form-group">
                              <div class="row">
                                 <div class="col-md-4">
                                    <label>Expiring Insurer</label>
                                 </div>
                                 <div class="col-md-8">
                                    <input type = "text" class = "form-control" name ="fire_expiry_insurer" id="fire_expiry_insurer">
                                 </div>
                              </div>
                           </div>
                           <div class="form-group">
                              <div class="row">
                                 <div class="col-md-4">
                                    <label>Date</label>
                                 </div>
                                 <div class="col-md-8">
                                    <input type = "date" class = "form-control" name ="fire_date" id="fire_date">
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class = "col-md-6">
                           <div class="form-group">
                              <div class="row">
                                 <div class="col-md-4">
                                    <label> Claims Experience</label>
                                 </div>
                                 <div class="col-md-8">
                                    <input type = "text" class = "form-control" name ="claim_exprience" id="claim_exprience">
                                 </div>
                              </div>
                           </div>
                           <div class="form-group">
                              <div class="row">
                                 <div class="col-md-4">
                                    <label>Information</label>
                                 </div>
                                 <div class="col-md-8">
                                    <input type = "text" class = "form-control" name ="fire_information" id="fire_information">
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class = "hidden wc_div">
                        <div class = "row">
                           <table class = "table table-bordered" style="width:100%">
                              <tr>
                                 <th colspan='4' class='text-center bg-primary'>Employee Details</th>
                              </tr>
                              <tr>
                                 <th colspan='2'>Details</th>
                                 <th>Previous Year</th>
                                 <th>Current Year</th>
                              </tr>
                              <tr>
                                 <th colspan='2'>Number of Employee</th>
                                 <th><input type="text" class="form-control" name="pre_no_of_emp" id="pre_no_of_emp"></th>
                                 <th><input type="text" class="form-control" name="cur_no_of_emp" id="cur_no_of_emp"></th>
                              </tr>
                           </table>
                           <div class = "col-md-6">
                              <h4 class ="text-center bg-primary">Claim Details</h4>
                              <div class="form-group">
                                 <div class="row">
                                    <div class="col-md-4">
                                       <label>Claim Paid</label>
                                    </div>
                                    <div class="col-md-8">
                                       <input type="text" class="form-control" name="wc_claim_paid" id="wc_claim_paid">
                                    </div>
                                 </div>
                              </div>
                              <div class="form-group">
                                 <div class="row">
                                    <div class="col-md-4">
                                       <label>Total Claim</label>
                                    </div>
                                    <div class="col-md-8">
                                       <input type="text" class="form-control" name="wc_tot_claim" id="wc_tot_claim">
                                    </div>
                                 </div>
                              </div>
                              <div class="form-group">
                                 <div class="row">
                                    <div class="col-md-4">
                                       <label>Premium Paid</label>
                                    </div>
                                    <div class="col-md-8">
                                       <input type="text" class="form-control" name="wc_premium_paid" id="wc_premium_paid">
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class = "col-md-6">
                              <h4 class ="text-center bg-primary">&nbsp;</h4>
                              <div class="form-group">
                                 <div class="row">
                                    <div class="col-md-4">
                                       <label>Outstanding Claim</label>
                                    </div>
                                    <div class="col-md-8">
                                       <input type="text" class="form-control" name="wc_out_claim" id="wc_out_claim">
                                    </div>
                                 </div>
                              </div>
                              <div class="form-group">
                                 <div class="row">
                                    <div class="col-md-4">
                                       <label>Last Three Years Claims</label>
                                    </div>
                                    <div class="col-md-8">
                                       <input type="text" class="form-control" name="wc_last_claim" id="wc_last_claim">
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class = "row">
                           <div class = "col-md-6">
                              <h4 class ="text-center bg-primary">Policy Details</h4>
                              <div class="form-group">
                                 <div class="row">
                                    <div class="col-md-4">
                                       <label>Wages Per Employee Per Month</label>
                                    </div>
                                    <div class="col-md-8">
                                       <input type="text" class="form-control" name="wc_wages_per_mon" id="wc_wages_per_mon">
                                    </div>
                                 </div>
                              </div>
                              <div class="form-group">
                                 <div class="row">
                                    <div class="col-md-4">
                                       <label>No of supervisor</label>
                                    </div>
                                    <div class="col-md-8">
                                       <input type="text" class="form-control" name="wc_no_supervisor" id="wc_no_supervisor">
                                    </div>
                                 </div>
                              </div>
                              <div class="form-group">
                                 <div class="row">
                                    <div class="col-md-4">
                                       <label>No of site Engineer</label>
                                    </div>
                                    <div class="col-md-8">
                                       <input type="text" class="form-control" name="wc_no_site_engineer" id="wc_no_site_engineer">
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class = "col-md-6">
                              <h4 class ="text-center bg-primary">&nbsp;</h4>
                              <div class="form-group">
                                 <div class="row">
                                    <div class="col-md-4">
                                       <label>Salary Per supervisor Per Month</label>
                                    </div>
                                    <div class="col-md-8">
                                       <input type="text" class="form-control" name="wc_salary_per_supervisor" id="wc_salary_per_supervisor">
                                    </div>
                                 </div>
                              </div>
                              <div class="form-group">
                                 <div class="row">
                                    <div class="col-md-4">
                                       <label>Salary site Engineer Per Month</label>
                                    </div>
                                    <div class="col-md-8">
                                       <input type="text" class="form-control" name="wc_salary_engineer" id="wc_salary_engineer">
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="gmc_div hidden">
                        <div class = "row">
                           <div class = "col-md-6">
                              <h4 class ="text-center bg-primary">Existing Policy Details</h4>
                              <div class="form-group">
                                 <div class="row">
                                    <div class="col-md-4">
                                       <label>Current Status(Fresh /Renewal )</label>
                                    </div>
                                    <div class="col-md-8">
                                       <input type="text" class="form-control" name="gmc_current_status" id="gmc_current_status">
                                    </div>
                                 </div>
                              </div>
                              <div class="form-group">
                                 <div class="row">
                                    <div class="col-md-4">
                                       <label>Current Insurer & TPA</label>
                                    </div>
                                    <div class="col-md-8">
                                       <input type="text" class="form-control" name="gmc_cur_ins" id="gmc_cur_ins">
                                    </div>
                                 </div>
                              </div>
                              <div class="form-group">
                                 <div class="row">
                                    <div class="col-md-4">
                                       <label>Premium as on date ( Including Addition/Deletions )</label>
                                    </div>
                                    <div class="col-md-8">
                                       <input type="text" class="form-control" name="gmc_premium_date" id="gmc_premium_date">
                                    </div>
                                 </div>
                              </div>
                              <div class="form-group">
                                 <div class="row">
                                    <div class="col-md-4">
                                       <label>Total Lives for Policy Renewal</label>
                                    </div>
                                    <div class="col-md-8">
                                       <input type="text" class="form-control" name="gmc_renewal_tot" id="gmc_renewal_tot">
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class = "col-md-6">
                              <h4 class ="text-center bg-primary">&nbsp;</h4>
                              <div class="form-group">
                                 <div class="row">
                                    <div class="col-md-4">
                                       <label>Period Of Insurance</label>
                                    </div>
                                    <div class="col-md-8">
                                       <input type="text" class="form-control" name="gmc_period_of_ins" id="gmc_period_of_ins">
                                    </div>
                                 </div>
                              </div>
                              <div class="form-group">
                                 <div class="row">
                                    <div class="col-md-4">
                                       <label>Premium At inception of Policy </label>
                                    </div>
                                    <div class="col-md-8">
                                       <input type="text" class="form-control" name="gmc_premium_inscep" id="gmc_premium_inscep">
                                    </div>
                                 </div>
                              </div>
                              <div class="form-group">
                                 <div class="row">
                                    <div class="col-md-4">
                                       <label>Total Lives at Inception of Policy</label>
                                    </div>
                                    <div class="col-md-8">
                                       <input type="text" class="form-control" name="gmc_total_lives" id="gmc_total_lives">
                                    </div>
                                 </div>
                              </div>
                              <div class="form-group">
                                 <div class="row">
                                    <div class="col-md-4">
                                       <label>Incurred Claims(Settled+ O/s)</label>
                                    </div>
                                    <div class="col-md-8">
                                       <input type="text" class="form-control" name="gmc_incurred_claims" id="gmc_incurred_claims">
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class = "row">
                           <div class = "col-md-6">
                              <h4 class ="text-center bg-primary">Benefits</h4>
                              <div class="form-group">
                                 <div class="row">
                                    <div class="col-md-4">
                                       <label>Sum Insured Approach (Uniform/Various)</label>
                                    </div>
                                    <div class="col-md-8">
                                       <input type="text" class="form-control" name="gmc_sum_ins_app" id="gmc_sum_ins_app">
                                    </div>
                                 </div>
                              </div>
                              <div class="form-group">
                                 <div class="row">
                                    <div class="col-md-4">
                                       <label> Family Definition</label>
                                    </div>
                                    <div class="col-md-8">
                                       <input type="text" class="form-control" name="gmc_family_def" id="gmc_family_def">
                                    </div>
                                 </div>
                              </div>
                              <div class="form-group">
                                 <div class="row">
                                    <div class="col-md-4">
                                       <label> Pre-existing Diseases covered</label>
                                    </div>
                                    <div class="col-md-8">
                                       <input type="text" class="form-control" name="gmc_pre_disease_covered" id="gmc_pre_disease_covered">
                                    </div>
                                 </div>
                              </div>
                              <div class="form-group">
                                 <div class="row">
                                    <div class="col-md-4">
                                       <label>1st ,2nd & 4th Year Exclusion Waiver</label>
                                    </div>
                                    <div class="col-md-8">
                                       <input type="text" class="form-control" name="gmc_exclusion_waiver_year" id="gmc_exclusion_waiver_year">
                                    </div>
                                 </div>
                              </div>
                              <div class="form-group">
                                 <div class="row">
                                    <div class="col-md-4">
                                       <label>Maternity Benefit coverage</label>
                                    </div>
                                    <div class="col-md-8">
                                       <input type="text" class="form-control" name="gmc_maternity_coverage" id="gmc_maternity_coverage">
                                    </div>
                                 </div>
                              </div>
                              <div class="form-group">
                                 <div class="row">
                                    <div class="col-md-4">
                                       <label>Pre and Post Hospitalization coverage limits</label>
                                    </div>
                                    <div class="col-md-8">
                                       <input type="text" class="form-control" name="gmc_hospital_coverage" id="gmc_hospital_coverage">
                                    </div>
                                 </div>
                              </div>
                              <div class="form-group">
                                 <div class="row">
                                    <div class="col-md-4">
                                       <label>ICU/ ITU Limits</label>
                                    </div>
                                    <div class="col-md-8">
                                       <input type="text" class="form-control" name="gmc_icu_limits" id="gmc_icu_limits">
                                    </div>
                                 </div>
                              </div>
                              <div class="form-group">
                                 <div class="row">
                                    <div class="col-md-4">
                                       <label>Coverage for Congenital Internal Disease</label>
                                    </div>
                                    <div class="col-md-8">
                                       <input type="text" class="form-control" name="gmc_int_desease_cover" id="gmc_int_desease_cover">
                                    </div>
                                 </div>
                              </div>
                              <div class="form-group">
                                 <div class="row">
                                    <div class="col-md-4">
                                       <label>PPN Clause</label>
                                    </div>
                                    <div class="col-md-8">
                                       <input type="text" class="form-control" name="gmc_ppn_cause" id="gmc_ppn_cause">
                                    </div>
                                 </div>
                              </div>
                              <div class="form-group">
                                 <div class="row">
                                    <div class="col-md-4">
                                       <label>Claim Submission</label>
                                    </div>
                                    <div class="col-md-8">
                                       <input type="text" class="form-control" name="gmc_claim_sub_mission" id="gmc_claim_sub_mission">
                                    </div>
                                 </div>
                              </div>
                              <div class="form-group">
                                 <div class="row">
                                    <div class="col-md-4">
                                       <label>Lasik Surgery</label>
                                    </div>
                                    <div class="col-md-8">
                                       <input type="text" class="form-control" name="gmc_lasik_surgery" id="gmc_lasik_surgery">
                                    </div>
                                 </div>
                              </div>
                              <div class="form-group">
                                 <div class="row">
                                    <div class="col-md-4">
                                       <label>Corporate buffer </label>
                                    </div>
                                    <div class="col-md-8">
                                       <input type="text" class="form-control" name="gmc_corporate_buffer" id="gmc_corporate_buffer">
                                    </div>
                                 </div>
                              </div>
                              <div class="form-group">
                                 <div class="row">
                                    <div class="col-md-4">
                                       <label>Cataract Surgery</label>
                                    </div>
                                    <div class="col-md-8">
                                       <input type="text" class="form-control" name="gmc_cataract_surgery" id="gmc_cataract_surgery">
                                    </div>
                                 </div>
                              </div>
                              <div class="form-group">
                                 <div class="row">
                                    <div class="col-md-4">
                                       <label>Comorbidities treatment under covid admission</label>
                                    </div>
                                    <div class="col-md-8">
                                       <input type="text" class="form-control" name="gmc_comorbities" id="gmc_comorbities">
                                    </div>
                                 </div>
                              </div>
                              <div class="form-group">
                                 <div class="row">
                                    <div class="col-md-4">
                                       <label>Psychiatric Ailment /Mental Illness</label>
                                    </div>
                                    <div class="col-md-8">
                                       <input type="text" class="form-control" name="gmc_metail_illness" id="gmc_metail_illness">
                                    </div>
                                 </div>
                              </div>
                              <div class="form-group">
                                 <div class="row">
                                    <div class="col-md-4">
                                       <label>Addition/Deletion</label>
                                    </div>
                                    <div class="col-md-8">
                                       <input type="text" class="form-control" name="gmc_addition" id="gmc_addition">
                                    </div>
                                 </div>
                              </div>
                              <div class="form-group">
                                 <div class="row">
                                    <div class="col-md-4">
                                       <label>Covid hospitlization coverage ( Covid Hospitlizaiton expneses to be covered as per policy norms )</label>
                                    </div>
                                    <div class="col-md-8">
                                       <input type="text" class="form-control" name="gmc_covid_hospitlization" id="gmc_covid_hospitlization">
                                    </div>
                                 </div>
                              </div>
                              <div class="form-group">
                                 <div class="row">
                                    <div class="col-md-4">
                                       <label>Day Care Procedures</label>
                                    </div>
                                    <div class="col-md-8">
                                       <input type="text" class="form-control" name="gmc_day_care" id="gmc_day_care">
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class = "col-md-6">
                              <h4 class ="text-center bg-primary">&nbsp;</h4>
                              <div class="form-group">
                                 <div class="row">
                                    <div class="col-md-4">
                                       <label>Sum Insured</label>
                                    </div>
                                    <div class="col-md-8">
                                       <input type="text" class="form-control" name="gmc_sum_ins" id="gmc_sum_ins">
                                    </div>
                                 </div>
                              </div>
                              <div class="form-group">
                                 <div class="row">
                                    <div class="col-md-4">
                                       <label>Policy Type ( Family Floater / Individual Sum Insured ) </label>
                                    </div>
                                    <div class="col-md-8">
                                       <input type="text" class="form-control" name="gmc_policy_type" id="gmc_policy_type">
                                    </div>
                                 </div>
                              </div>
                              <div class="form-group">
                                 <div class="row">
                                    <div class="col-md-4">
                                       <label>30 Days Exclusion Waiver</label>
                                    </div>
                                    <div class="col-md-8">
                                       <input type="text" class="form-control" name="gmc_exclusion_wavier" id="gmc_exclusion_wavier">
                                    </div>
                                 </div>
                              </div>
                              <div class="form-group">
                                 <div class="row">
                                    <div class="col-md-4">
                                       <label>9 months waiting period for Maternity</label>
                                    </div>
                                    <div class="col-md-8">
                                       <input type="text" class="form-control" name="gmc_waiting_period" id="gmc_waiting_period">
                                    </div>
                                 </div>
                              </div>
                              <div class="form-group">
                                 <div class="row">
                                    <div class="col-md-4">
                                       <label>Child Day 1 cover within Family Floater Sum Insured</label>
                                    </div>
                                    <div class="col-md-8">
                                       <input type="text" class="form-control" name="gmc_child_day_cover" id="gmc_child_day_cover">
                                    </div>
                                 </div>
                              </div>
                              <div class="form-group">
                                 <div class="row">
                                    <div class="col-md-4">
                                       <label>Room rent restriction</label>
                                    </div>
                                    <div class="col-md-8">
                                       <input type="text" class="form-control" name="gmc_room_rent" id="gmc_room_rent">
                                    </div>
                                 </div>
                              </div>
                              <div class="form-group">
                                 <div class="row">
                                    <div class="col-md-4">
                                       <label>Any Submlimits On Doctor Fees/Surgeon Charges /Medicines, consumables etc</label>
                                    </div>
                                    <div class="col-md-8">
                                       <input type="text" class="form-control" name="gmc_sub_limits" id="gmc_sub_limits">
                                    </div>
                                 </div>
                              </div>
                              <div class="form-group">
                                 <div class="row">
                                    <div class="col-md-4">
                                       <label>Coverage for Congenital External Disease</label>
                                    </div>
                                    <div class="col-md-8">
                                       <input type="text" class="form-control" name="gmc_ext_desease_cover" id="gmc_ext_desease_cover">
                                    </div>
                                 </div>
                              </div>
                              <div class="form-group">
                                 <div class="row">
                                    <div class="col-md-4">
                                       <label>Claim Intimation</label>
                                    </div>
                                    <div class="col-md-8">
                                       <input type="text" class="form-control" name="gmc_claim_int" id="gmc_claim_int">
                                    </div>
                                 </div>
                              </div>
                              <div class="form-group">
                                 <div class="row">
                                    <div class="col-md-4">
                                       <label>Internal Capping / Co Payment / Any Sub Limits</label>
                                    </div>
                                    <div class="col-md-8">
                                       <input type="text" class="form-control" name="gmc_int_capping" id="gmc_int_capping">
                                    </div>
                                 </div>
                              </div>
                              <div class="form-group">
                                 <div class="row">
                                    <div class="col-md-4">
                                       <label>Ayush treatment</label>
                                    </div>
                                    <div class="col-md-8">
                                       <input type="text" class="form-control" name="gmc_ayush_treatment" id="gmc_ayush_treatment">
                                    </div>
                                 </div>
                              </div>
                              <div class="form-group">
                                 <div class="row">
                                    <div class="col-md-4">
                                       <label>Robotic Surgery</label>
                                    </div>
                                    <div class="col-md-8">
                                       <input type="text" class="form-control" name="gmc_robotic" id="gmc_robotic">
                                    </div>
                                 </div>
                              </div>
                              <div class="form-group">
                                 <div class="row">
                                    <div class="col-md-4">
                                       <label>Ambulance Charges</label>
                                    </div>
                                    <div class="col-md-8">
                                       <input type="text" class="form-control" name="gmc_ambulance" id="gmc_ambulance">
                                    </div>
                                 </div>
                              </div>
                              <div class="form-group">
                                 <div class="row">
                                    <div class="col-md-4">
                                       <label>Sinus Surgery</label>
                                    </div>
                                    <div class="col-md-8">
                                       <input type="text" class="form-control" name="gmc_sinus_surgery" id="gmc_sinus_surgery">
                                    </div>
                                 </div>
                              </div>
                              <div class="form-group">
                                 <div class="row">
                                    <div class="col-md-4">
                                       <label>Age Related Macular Degeneration</label>
                                    </div>
                                    <div class="col-md-8">
                                       <input type="text" class="form-control" name="gmc_age_macular" id="gmc_age_macular">
                                    </div>
                                 </div>
                              </div>
                              <div class="form-group">
                                 <div class="row">
                                    <div class="col-md-4">
                                       <label>Hospitalization due to terrorism and epidemic diseases </label>
                                    </div>
                                    <div class="col-md-8">
                                       <input type="text" class="form-control" name="gmc_terroism_deases" id="gmc_terroism_deases">
                                    </div>
                                 </div>
                              </div>
                              <div class="form-group">
                                 <div class="row">
                                    <div class="col-md-4">
                                       <label>Any Other Special Condition or Coverages</label>
                                    </div>
                                    <div class="col-md-8">
                                       <input type="text" class="form-control" name="gmc_special_coverage" id="gmc_special_coverage">
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </section>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
         </div>
      </div>
   </div>
</div>

 
<script>
  
var leadid = '<?=$lead_id?>';
    
var duedate = '<?=$duedate?>';
    
$(document).ready(function() {
    $('#agent_pos').trigger('change');

    $('#lead_status').change(function() {
      var value = $(this).val();
      if(value == "lost" || value == "follow_up") {
         $('#due_date').val('');
         if(value == "follow_up")
            $("#follow_up_hidden").removeClass("hidden");
         else 
            $("#follow_up_hidden").addClass("hidden");
      } else {
         $('#due_date').val(duedate);
         $("#follow_up_hidden").addClass("hidden");
      }
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
        var pin_code  = $("#pin_code").val();
        var lead_status  = $("#lead_status").val();
        
        var bussiness_type = $("#bussiness_type").val();
        var policy_class = $("#policy_class").val();
        var policy_type = $("#policy_type").val();
        var lead_generated_date = $("#lead_generated_date").val();
        var due_date = $("#due_date").val();
        
        var v_regn_no_1 = $("#v_regn_no_1").val();
        var v_regn_no_2 = $("#v_regn_no_2").val();
        var v_regn_no_3 = $("#v_regn_no_3").val();
        var v_regn_no_4 = $("#v_regn_no_4").val();
        
        var v_regn_no = v_regn_no_1+"-"+v_regn_no_2+"-"+v_regn_no_3+"-"+v_regn_no_4;
        var broken_policy = "No";

        if($('#broken_policy').is(":checked"))
        {
            var broken_policy = "Yes";
        }                          
        var location = $("#location").val();
        var classification = $("#classification").val();
        var source = $("#source").val();
        var agent_pos = $("#agent_pos").val();

        var assign_to_user = $("#assign_to_user").val();
        var area_incharge = $("#area_incharge").val();
        var remarks = $("#remarks").val();
        var gst_number = $("#gst_number").val();

        var client_id = $("#client_id").val();
        var ref_lead_id = $("#ref_lead_id").val();
        

        var follow_up_status = $("#follow_up_concluded").val();
        var follow_up_reason = $("#follow_up_reason").val();
        var enter_next_follow_date = $("#enter_next_follow_date").val();
        var enter_next_follow_time = $("#enter_next_follow_time").val();
        var follow_comment = $("#follow_comment").val();
         
        var check = 0;
             
             
        var files = $("#old_policy").prop('files')[0];
        var formdata = new FormData();
        formdata.append("file",files);
        formdata.append("client_type",client_type);
        formdata.append("client_name",client_name);
        formdata.append("mobile_no",mobile_no);
        formdata.append("other_contact_details",other_contact_details);
        formdata.append("landline_no",landline_no);
        formdata.append("address",address);
        formdata.append("email_id",email_id);
        formdata.append("contact_person_name",contact_person_name);
        formdata.append("contact_person_des",contact_person_des);
        formdata.append("dob",dob);
        formdata.append("age",age);
        formdata.append("area",area);
        formdata.append("pin_code",pin_code);
        formdata.append("bussiness_type",bussiness_type);
        formdata.append("policy_class",policy_class);
        formdata.append("policy_type",policy_type);
        formdata.append("lead_generated_date",lead_generated_date);
        formdata.append("due_date",due_date);
        formdata.append("broken_policy",broken_policy);
        formdata.append("location",location);
        formdata.append("classification",classification);
        formdata.append("source",source);
        formdata.append("agent_pos",agent_pos);
        formdata.append("assign_to_user",assign_to_user);
        formdata.append("area_incharge",area_incharge);
        formdata.append("remarks",remarks);
        formdata.append("gst_number",gst_number);
        formdata.append("v_regn_no",v_regn_no);
        formdata.append("client_id",client_id);
        formdata.append("ref_lead_id",ref_lead_id);
        formdata.append("lead_status",lead_status);
          
        formdata.append("follow_up_status",follow_up_status);
        formdata.append("follow_up_reason",follow_up_reason);
        formdata.append("enter_next_follow_date",enter_next_follow_date);
        formdata.append("enter_next_follow_time",enter_next_follow_time);
        formdata.append("follow_comment",follow_comment);
        
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
        else if(classification == "")
        {
            snackbar_show("Select Classification type");
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
        else if(agent_pos == "" || agent_pos == null)
        {
            snackbar_show("Select Agents And Pos");
            check = 1;
        }
        else if(assign_to_user == "" || assign_to_user == null)
        {
            snackbar_show("Select Assign To User");
            check = 1;
        }
        else if(area_incharge == "" || area_incharge == null)
        {
            snackbar_show("Select Area Incharge");
            check = 1;
        }
        else if(lead_status == "lost" && (remarks == "" || $.trim(remarks).length < 3))
        {
            snackbar_show("Enter the Remarks");
            check = 1;
        }
        else if(lead_status == "follow_up" && follow_up_status == "" )
        {
            snackbar_show("Select the Follow up-Concluded");
            check = 1;
        }
        else if(lead_status == "follow_up" && follow_up_reason == "" )
        {
            snackbar_show("Select the Reason");
            check = 1;
        }
        else if(lead_status == "follow_up" && enter_next_follow_date == "" )
        {
            snackbar_show("Enter the Next Follow up date");
            check = 1;
        }
        else if(lead_status == "follow_up" && enter_next_follow_time == "" )
        {
            snackbar_show("Next Follow up Time");
            check = 1;
        }
        else if(lead_status == "follow_up" && follow_comment == "" )
        {
            snackbar_show("Enter the Comment");
            check = 1;
        }
        else if(check != 1)
        {
            $.ajax({
                url : "<?=base_url('Renewalcontrol/save')?>",
                method : "POST",
                data:formdata,
                processData:false,  
                contentType:false,
                cache:false,
                dataType:'json',
                beforeSend:function(){
                $("#save_btn").attr("disabled",true);
                },
                success:function(response){
                    console.log(response);
                    
                    if(response.status == "Exits")
                    {
                        snackbar_show("Vechicle Registration Number Already Exits");
                        $("#save_btn").attr("disabled",false);
                    }
                    else
                    {
                            Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'Lead Created Successfully',
                            showConfirmButton: false,
                            timer: 1500
                            });
                            $("#save_btn").attr("disabled",false);
                            // $("#save_btn").addClass("hidden");
                            // $("#update_btn").removeClass("hidden");
                            // $("#follow_up_hidden").removeClass("hidden");
                            // $("#vechicle_hidden").removeClass("hidden");
                            if(response.lead_status == "open")
                                window.location.href = "<?=base_url()?>create_lead?id="+response.lead_id;
                            else 
                                window.location.href = "<?=base_url()?>renewallead";
                    }
                },
            });
        }
            
            
    });  

    $("#agent_pos").change(function(){
        var agent_pos = $("#agent_pos").val();
        var session_role = $("#session_role").val();
            
        $.ajax({
            url : "<?=base_url('fetch_area_incharge_by_agent')?>",
            method : "POST",
            data : {agent_pos:agent_pos},
            success:function(response)
            {
                var obj = jQuery.parseJSON(response);
                
                var html = "";
                
                if(obj != null)
                {
                    html ="<option value='"+obj.id+"'>"+obj.name+"  -( "+obj.phoneno+" )</option>"
                }
                $("#area_incharge").html(html);
            }
        });
            
        if(session_role == "AI" || session_role == "user")
        {
            $.ajax({
                    url : "<?=base_url('fetch_user_by_agent')?>",
                    method : "POST",
                    data : {agent_pos:agent_pos},
                    success:function(response)
                    {
                        $("#assign_to_user").html(response);
                    }
            });
        }
    });

    $("#add_dob").change(function(){            
        var dob = $("#add_dob").val();
        dob = new Date(dob);
        var today = new Date();
        var age = Math.floor((today-dob) / (365.25 * 24 * 60 * 60 * 1000));
        $('#you_age').val(age);
    });

    $("#policy_class").change(function(){
        var policy_class = $("#policy_class").val();
        $.ajax({
            url : "<?=base_url('fetch_policy_type_using_class')?>",
            method : "POST",
            data:{policy_class:policy_class},
            success:function(response)
            { 
                var obj = jQuery.parseJSON(response);
                console.log(obj);
                var str = "<option value=''>--Select--</option>";
                for(var j=0;j<obj.length;j++)
                {
                    str += "<option value='"+obj[j].id+"'>"+obj[j].policy_type+"</option>";
                }
                $("#policy_type").html(str);
            }
        });
           
        if(policy_class == "1")
        {
            $("#v_regn_no_div").removeClass("hidden");            
        }
        else if(policy_class == "2")
        {
            $("#sme_gst_number").addClass("hidden");
            $("#v_regn_no_div").addClass("hidden");
        }
        else if(policy_class == "3")
        {
            $("#sme_gst_number").addClass("hidden");
            $("#v_regn_no_div").addClass("hidden");
        }
        else if(policy_class == "4")
        {
            $("#sme_gst_number").addClass("hidden");
            $("#v_regn_no_div").addClass("hidden");
        }
        else if(policy_class == "5")
        {
            $("#sme_gst_number").addClass("hidden");
            $("#v_regn_no_div").addClass("hidden");
        }
        else if(policy_class == "16")
        {
            $("#sme_gst_number").addClass("hidden");
            $("#v_regn_no_div").addClass("hidden");
        }
        else if(policy_class == "7")
        {
            $("#sme_gst_number").addClass("hidden");
            $("#v_regn_no_div").addClass("hidden");
        }
        else if(policy_class == "8")
        {
            $("#sme_gst_number").addClass("hidden");
            $("#v_regn_no_div").addClass("hidden");
        }
        else if(policy_class == "9")
        {
            $("#sme_gst_number").addClass("hidden");
            $("#v_regn_no_div").addClass("hidden");
        }
        else if(policy_class == "10")
        {
            $("#sme_gst_number").removeClass("hidden");
            $("#v_regn_no_div").addClass("hidden");
        }                    
    });

    
});




</script>
 