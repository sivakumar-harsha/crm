<script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>

<style>

.form-control 
{
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

.btn {
    border-radius: 1px;
    -webkit-box-shadow: none;
    box-shadow: none;
    border: 1px solid transparent;
}



</style>

  <div class="content-wrapper">
    <section class="content-header">
     
              <?php
                if (isset($_GET["id"])) {
                    $id = $_GET["id"];
                }
              ?>
              
              <div class="row">
                  <div class="col-md-6">
                       <h4 style="font-size: 17px;margin-top:-10px;"> <input type="hidden" id="lead_id" value="<?php echo $id ?>">
                            Create New Policy - <span id="client_name"></span> </h4>
                            <input type="hidden" id="_commission_id" value=""/>
                  </div>
               
                      <?php  if (isset($_GET["sec"])) {  ?>
                      
                        <div class="col-md-6 pull-right">
                           <button class="btn btn-success pull-right" id="update_btn"> <i class="fa fa-save"></i> Update</button>
                           <span class="pull-right">&nbsp;</span>
                           <button class="btn btn-danger pull-right hidden" id="add_commision_btn"> <i class="fa fa-inr"></i> Edit Commission</button>
                        </div>
                      
                      <?php } else {
                          ?>
                     
                      
                        <div class="col-md-6 pull-right">
                           <button class="btn btn-success pull-right" id="save_btn"> <i class="fa fa-save"></i> Save</button>
                           <span class="pull-right">&nbsp;</span>
                           <button class="btn btn-primary pull-right" id="email_btn"> <i class="fa fa-envelope"></i> Email</button>
                           <span class="pull-right">&nbsp;</span>
                             <button class="btn btn-info pull-right" id="temp_save_btn"> <i class="fa fa-key"></i> Save temp</button>
                           <span class="pull-right">&nbsp;</span>
                            <button class="btn btn-danger pull-right hidden" id="add_commision_btn"> <i class="fa fa-inr"></i> Add Commission</button>
                           <span class="pull-right">&nbsp;</span>
                       </div>
                      
                      <?php } ?>
             </div>
       
    </section>

    <!-- Main content -->
    <section class="content">
        
        
    <!-- ========================= CLIENT DETAILS ========================= -->
    <div class="box collapsed-box">
        <div class="box-header with-border" style="background: #f4f4f48c">
            <h3 class="box-title" style="text-align: left; font-size: 14px">
                <i class="fa fa-user"></i> &nbsp;&nbsp;Client Details
            </h3>
            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse">
                    <i class="fa fa-minus"></i>
                </button>
            </div>
        </div>

        <div class="box-body" style="text-align: left">
            <div class="row">
                <!-- LEFT COLUMN -->
                <div class="col-md-6">

                    <!-- CLIENT TYPE -->
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4"><label>Client Type</label><span>*</span></div>
                            <div class="col-md-8">
                                <select class="form-control" name="client_type" id="client_type">
                                    <option value="">--Select--</option>
                                    <?php foreach ($client_type as $da) { ?>
                                        <option value="<?php echo $da->id ?>">
                                            <?php echo $da->client_type ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- SALUTATION -->
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4"><label>Salutation</label></div>
                            <div class="col-md-8">
                                <select class="form-control" id="salutation" name="salutation">
                                    <option value="">--Select--</option>
                                    <option value="Mr">Mr</option>
                                    <option value="Mrs">Mrs</option>
                                    <option value="Ms">Ms</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- CLIENT NAME (READ-ONLY DISPLAY FIELD) -->
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4"><label>Client Name</label><span>*</span></div>
                            <div class="col-md-8">
                                <input type="text" class="form-control" id="display_client_name" name="display_client_name" readonly />
                            </div>
                        </div>
                    </div>

                    <!-- INITIAL -->
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4"><label>Initial</label></div>
                            <div class="col-md-8">
                                <input type="text" class="form-control" id="initial" name="initial" />
                            </div>
                        </div>
                    </div>

                    <!-- FATHER / HUSBAND NAME -->
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4"><label>Father / Husband Name</label></div>
                            <div class="col-md-8">
                                <input type="text" class="form-control" id="father_husband_name" name="father_husband_name" />
                            </div>
                        </div>
                    </div>

                    <!-- DATE OF BIRTH -->
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4"><label>Date of Birth</label></div>
                            <div class="col-md-8">
                                <input type="date" class="form-control" id="dob" name="dob" />
                            </div>
                        </div>
                    </div>

                    <!-- AGE -->
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4"><label>Age</label></div>
                            <div class="col-md-8">
                                <input type="text" class="form-control" id="age" name="age" placeholder="Auto" />
                            </div>
                        </div>
                    </div>

                    <!-- MOBILE NUMBER -->
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4"><label>Mobile No</label><span>*</span></div>
                            <div class="col-md-8">
                                <div class="input-group">
                                    <div class="input-group-addon">+91</div>
                                    <input type="number" class="form-control" name="mobile_no" maxlength="10" id="mobile_no" />
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- EMAIL -->
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4"><label>Email ID</label></div>
                            <div class="col-md-8">
                                <input type="email" class="form-control" name="email_id" id="email_id" placeholder="example@gmail.com" />
                            </div>
                        </div>
                    </div>

                    <!-- ADDITIONAL CUSTOM FIELDS SECTION -->
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <label style="font-weight: bold">Additional Fields</label>
                                <div id="custom_fields_container"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- RIGHT COLUMN -->
                <div class="col-md-6">

                    <!-- COMMUNICATION ADDRESS -->
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4"><label>Communication Address</label></div>
                            <div class="col-md-8">
                                <textarea class="form-control" name="communication_address" id="communication_address" rows="3"></textarea>
                            </div>
                        </div>
                    </div>

                    <!-- PERMANENT ADDRESS -->
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4"><label>Permanent Address</label></div>
                            <div class="col-md-8">
                                <textarea class="form-control" name="permanent_address" id="permanent_address" rows="3"></textarea>
                            </div>
                        </div>
                    </div>

                    <!-- DISTRICT -->
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4"><label>District</label></div>
                            <div class="col-md-8">
                                <input type="text" class="form-control" id="district" name="district" placeholder="Enter District" />
                            </div>
                        </div>
                    </div>

                    <!-- STATE -->
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4"><label>State</label></div>
                            <div class="col-md-8">
                                <input type="text" class="form-control" id="state" name="state" value="TamilNadu" />
                            </div>
                        </div>
                    </div>

                    <!-- COUNTRY -->
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4"><label>Country</label></div>
                            <div class="col-md-8">
                                <input type="text" class="form-control" id="country" name="country" value="India" />
                            </div>
                        </div>
                    </div>

                    <!-- PIN CODE -->
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4"><label>Pin Code</label></div>
                            <div class="col-md-8">
                                <input type="text" class="form-control" id="pin_code" name="pin_code" maxlength="6" placeholder="Enter 6-digit Pin Code" />
                            </div>
                        </div>
                    </div>

                    <!-- BUTTONS -->
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4"></div>
                            <div class="col-md-8">
                                <button class="btn btn-danger btn-xs pull-right hidden" id="edit_client_btn">
                                    <i class="fa fa-pencil-square-o"></i> Edit Client Details
                                </button>
                                <button class="btn btn-success btn-xs pull-right hidden" id="update_client_btn">
                                    <i class="fa fa-save"></i> Update Client
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ========================= END CLIENT DETAILS ========================= -->
  

    <div class="box collapsed-box">
        <div class="box-header with-border" style="background:#f4f4f48c;">
            <h3 class="box-title" _msthash="26273" _msttexthash="60619" style="text-align: left;font-size:14px;"><i class="fa fa-bars" aria-hidden="true"></i> &nbsp;&nbsp;Requirement Details</h3>
            
            <div class="box-tools pull-right">
                 <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse">
                  <i class="fa fa-plus"></i></button>
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
                                    <?php foreach ($business as $da) {?>
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
                                    <?php foreach ($class as $da) { ?>
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
                                    <input type="date"  class="form-control" name="lead_generated_date" id="lead_generated_date">
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
                 
                 <?php if (!isset($_GET["id"])) { ?>
                 
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
                                        <option value="1">Hot</option>
                                        <option value="2">Warm</option>
                                        <option value="3">Cold</option>
                                    </select>
                               </div>
                        </div>
                    </div>
                    
                     <div class="form-group hidden">
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
                                   <option value="Jayantha Insurance">Jayantha Insurance</option>
                                   <option value="Others">Others</option>
                                        
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
                                <select class="form-control select2" name="agent_pos" id="agent_pos" style='width:100%'>
                                    <option value="">--select--</option>
                                    <?php foreach ($agents_pos as $da) {?>
                                      <option value="<?php echo $da->id ?>"><?php echo $da->name."  - ".$da->agent_pos_code."" ?></option>
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
                                <select class="form-control" name="assign_to_user" id="assign_to_user">
                                 <?php
                                        if ($this->session->userdata("session_role") == "admin") { ?>
                                    <?php foreach ($users as $da) {?>
                                    <option value="<?php echo $da->id ?>"><?php echo $da->username."  (".$da->email_id.")" ?></option>
                                    <?php }
                                    } ?>
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
                                    <option value="">--Select--</option>
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
                                <textarea rows="3" class="form-control" name="remarks" id="remarks"></textarea>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <div class="row">   
                            <div class="col-md-12">
                                <button class="btn btn-danger btn-xs pull-right" id="edit_req_btn"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit Requirement Details</button>
                                <button class="btn btn-success btn-xs pull-right hidden" id="update_req_btn"><i class="fa fa-save" aria-hidden="true"></i> Update Requirement Details</button>
                            </div>
                        </div>
                    </div>
                    
                </div>
                
            </div>
        </div>
    </div>

    <div class="box">
        <div class="box-header with-border" style="background:#f4f4f48c;">
            <h3 class="box-title" _msthash="26273" _msttexthash="60619" style="text-align: left;font-size:14px;"><i class="fa fa-bars" aria-hidden="true"></i> &nbsp;&nbsp; Policy Details </h3>
            <div class="box-tools pull-right">
                 <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse">
                  <i class="fa fa-minus"></i></button>
            </div>
        </div>
        <div class="box-body" _msthash="1196936" _msttexthash="1190501" style="text-align: left;">
            
            <div class="row">
                
                <div class="col-md-6">
                    <!--<div class="form-group">-->
                    <!--    <div class="row">-->
                    <!--        <div class="col-md-4">-->
                    <!--           <label>Client Ref.No</label>-->
                    <!--       </div>-->
                    <!--       <div class="col-md-8">-->
                    <!--           <input type="text" class="form-control" name="policy_client_ref_no" id="policy_client_ref_no">-->
                    <!--       </div>-->
                    <!--    </div>-->
                    <!--  </div>-->
                      
                       <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                               <label>Insurence Company</label><span>*</span>
                           </div>
                           <div class="col-md-8">
                               <select class="form-control select2" name="company" id="company">
                                    <option value="">--select--</option>
                                    <?php foreach ($company as $da) {?>
                                    <option value="<?php echo $da->id ?>"><?php echo $da->company_name; ?></option>
                                     
                                    <?php } ?>
                                </select>
                           </div>
                        </div>
                   </div>
                      
                      <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                               <label>Cover Note Number</label>
                           </div>
                           <div class="col-md-8">
                               <input type="text" class="form-control" name="policy_cover_note_no" id="policy_cover_note_no">
                           </div>
                        </div>
                    </div>
                    
                    <input type="hidden" class="form-control" id="edit_id">
                    
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                               <label>Policy Number</label><span>*</span>
                           </div>
                           <div class="col-md-8">
                               <input type="text" class="form-control" name="policy_no" id="policy_no">
                           </div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                               <label>Start Date</label><span>*</span>
                           </div>
                           <div class="col-md-8">
                               <input type="date" class="form-control" name="policy_s_date" id="policy_s_date" value="<?=$startdate?>">
                           </div>
                        </div>
                    </div>
                    
                     <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                               <label>Expiry Date</label>
                           </div>
                           <div class="col-md-8">
                               <input type="date" class="form-control" name="policy_ex_date" id="policy_ex_date" value="<?=$duedate?>">
                           </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                            <label>Days Insured</label>
                            </div>
                            <div class="col-md-8">
                            <input type="text" class="form-control" id="days_insured" readonly>
                            </div>
                        </div>
                    </div>

                </div>
                
                <div class="col-md-6">
                    <div class="form-group" id='policy_premium_div'>
                        <div class="row">
                            <div class="col-md-4">
                               <label>Premium Cover Type</label><span>*</span>
                           </div>
                           <div class="col-md-8">
                               <select class="form-control" name="policy_premium" id="policy_premium">
                                   <option value="">--Select--</option>
                                   <?php  foreach ($premium_cover_type as $da) { ?>
                                        <option value="<?php echo $da->id ?>"><?php echo $da->name ?></option>
                                   <?php } ?>
                               </select>
                           </div>
                        </div>
                    </div>
                    
                    <div class="form-group hidden">
                        <div class="row">
                            <div class="col-md-4">
                               <label>Policy Terms</label><span>*</span>
                           </div>
                           <div class="col-md-8">
                               <select class="form-control" name="policy_terms" id="policy_terms">
                                   <option value="">--select--</option>
                                   <option value="1 Yr OD + 3Yr Tp">1 Yr OD + 3Yr Tp</option>
                                   <option value="1 Yr OD + 1Yr Tp" selected>1 Yr OD + 1Yr Tp</option>
                               </select>
                           </div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                               <label>Premium Payment Frequency</label><span>*</span>
                           </div>
                           <div class="col-md-8">
                               <select class="form-control" name="payment_frequency" id="payment_frequency">
                                   <option value="">--Select--</option>
                                   <option value="Yearly">Yearly</option>
                                   <option value="6 Months">6 Months</option>
                                   <option value="3 Months">3 Months</option>
                                   <option value="Monthly">Monthly</option>
                                   <option value="Weekly">Weekly</option>
                                   <option value="Daily">Daily</option>
                               </select>
                           </div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                               <label>Next Premium Due Date</label>
                           </div>
                           <div class="col-md-8">
                               <input type="Date" class="form-control" name="next_due_date" id="next_due_date">
                           </div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                               <label>Renewable Flag</label>
                           </div>
                           <div class="col-md-8">
                               <select class="form-control" name="renewable_flag"id="renewable_flag">
                                   <option value="Yes">Yes</option>
                                   <option value="No">No</option>
                               </select>
                           </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!--2023-06-01 start//-->
            <div class="row">                
                <div class="col-md-6">                    
                    <div class="form-group hidden dts">
                        <div class="row">
                            <div class="col-md-4">
                            <label>OD Start Date</label><span>*</span>
                            </div>
                            <div class="col-md-8">
                            <input type="date" class="form-control odst" name="od_start_date" id="od_start_date">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">                
                    <div class="form-group hidden dts">
                        <div class="row">
                            <div class="col-md-4">
                                <label>OD Expiry Date</label>
                            </div>
                            <div class="col-md-8">
                                <input type="date" class="form-control oded" name="od_end_date" id="od_end_date">
                            </div>
                        </div>
                    </div>                    
                </div>                
            </div>
            <!--2023-06-01 end//-->

            <!--2023-06-01 start//-->
            <div class="row">             
                <div class="col-md-6">                
                    <div class="form-group hidden dts">
                        <div class="row">
                            <div class="col-md-4">
                                <label>TP Start Date</label><span>*</span>
                            </div>
                            <div class="col-md-8">
                                <input type="date" class="form-control tpst" name="tp_start_date" id="tp_start_date">
                            </div>
                        </div>
                    </div>                    
                </div>   
                <div class="col-md-6">                    
                    <div class="form-group hidden dts">
                        <div class="row">
                            <div class="col-md-4">
                                <label>TP Expiry Date</label>
                            </div>
                            <div class="col-md-8">
                                <input type="date" class="form-control tped" name="tp_end_date" id="tp_end_date">
                            </div>
                        </div>
                    </div>
                </div>                                
            </div>
            <!--2023-06-01 end//-->
      </div>
    </div> 
    
     
     <div class="box hidden" id='ins_person_div'>
        <div class="box-header with-border" style="background:#f4f4f48c;">
            <h3 class="box-title" _msthash="26273" _msttexthash="60619" style="text-align: left;font-size:14px;"><i class="fa fa-bars" aria-hidden="true"></i> &nbsp;&nbsp; Insured Person Details </h3>
            <div class="box-tools pull-right">
                 <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse">
                  <i class="fa fa-minus"></i></button>
            </div>
        </div>
        <div class="box-body" _msthash="1196936" _msttexthash="1190501" style="text-align: left;">
            
         
            
                <table class='table table-bordered'>
                    <tr>
                        <th>Name of the Insured Person (s)</th>
                        <th>Age (in Years)</th>
                        <th> Insured DOB</th>
                        <th>Gender</th>
                        <th>Relationship</th>
                        <th>Pre-existing Disease</th>
                        <th>Upload Declaration Form</th>
                    </tr>
                    <tbody id="insurer_details">
                        
                    </tbody>
                </table>
                
          
      </div>
    </div> 
    
    
    <div class="box hidden" id='add_ons_div'>
        <div class="box-header with-border" style="background:#f4f4f48c;">
            <h3 class="box-title" _msthash="26273" _msttexthash="60619" style="text-align: left;font-size:14px;"><i class="fa fa-bars" aria-hidden="true"></i> &nbsp;&nbsp;Health Policy Add Ons </h3>
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
                                  <label>Add Ons 1</label>
                              </div>
                               <div class="col-md-4">
                                  <input type="text" class="form-control" name="add_ons_1" id="add_ons_1" placeholder="Enter Add on name"> 
                              </div>
                              
                              <div class="col-md-4">
                                  <input type="text" class="form-control" name="add_ons_1_details" id="add_ons_1_details" placeholder="Enter Add on Details"> 
                              </div>
                          </div>
                      
                      </div>
                      
                      <div class="form-group">
                          <div class="row">
                              <div class="col-md-4">
                                  <label>Add Ons 2</label>
                              </div>
                               <div class="col-md-4">
                                  <input type="text" class="form-control" name="add_ons_2" id="add_ons_2" placeholder="Enter Add on name"> 
                              </div>
                              
                              <div class="col-md-4">
                                  <input type="text" class="form-control" name="add_ons_2_details" id="add_ons_2_details" placeholder="Enter Add on Details"> 
                              </div>
                          </div>
                      
                      </div>
                      
                      <div class="form-group">
                          <div class="row">
                              <div class="col-md-4">
                                  <label>Add Ons 3</label>
                              </div>
                               <div class="col-md-4">
                                  <input type="text" class="form-control" name="add_ons_3" id="add_ons_3" placeholder="Enter Add on name"> 
                              </div>
                              
                              <div class="col-md-4">
                                  <input type="text" class="form-control" name="add_ons_3_details" id="add_ons_3_details" placeholder="Enter Add on Details"> 
                              </div>
                          </div>
                      
                      </div>
                      
                  </div>
                  
                  <div class="col-md-6">
                      
                      <div class="form-group">
                          <div class="row">
                              <div class="col-md-4">
                                  <label>Add Ons 4</label>
                              </div>
                               <div class="col-md-4">
                                  <input type="text" class="form-control" name="add_ons_4" id="add_ons_4" placeholder="Enter Add on name"> 
                              </div>
                              
                              <div class="col-md-4">
                                  <input type="text" class="form-control" name="add_ons_4_details" id="add_ons_4_details" placeholder="Enter Add on Details"> 
                              </div>
                          </div>
                      
                      </div>
                      
                       <div class="form-group">
                          <div class="row">
                              <div class="col-md-4">
                                  <label>Add ONS 5</label>
                              </div>
                               <div class="col-md-4">
                                  <input type="text" class="form-control" name="add_ons_5" id="add_ons_5" placeholder="Enter Add on name"> 
                              </div>
                              
                              <div class="col-md-4">
                                  <input type="text" class="form-control" name="add_ons_5_details" id="add_ons_5_details" placeholder="Enter Add on Details"> 
                              </div>
                          </div>
                      
                      </div>
                      
                  </div>
                  
              </div>
                
          
      </div>
    </div> 
    
    
    <div class="box">
        <div class="box-header with-border" style="background:#f4f4f48c;">
            <h3 class="box-title" _msthash="26273" _msttexthash="60619" style="text-align: left;font-size:14px;"><i class="fa fa-money" aria-hidden="true"></i> &nbsp;&nbsp; Policy Amounts </h3>
            <div class="box-tools pull-right">
                 <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse">
                  <i class="fa fa-minus"></i></button>
            </div>
        </div>
        <div class="box-body" _msthash="1196936" _msttexthash="1190501" style="text-align: left;">
            
            <div class="row">
                  <p align='center' class='hidden' id='own_damage_title'><b>Own Damage Section</b></p>
                  <br>
                <div class="col-md-6" id='own_od_div_1'>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                               <label>Sum Insured</label><span>*</span>
                           </div>
                           <div class="col-md-8">
                               <input type="number" class="form-control" name="sum_insured" id="sum_insured">
                           </div>
                        </div>
                      </div>
                      
                      <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                               <label>Discount Percentage / Loading </label>
                           </div>
                           <div class="col-md-8">
                               <input type="number" class="form-control" name="discount_percent" id="discount_percent">
                           </div>
                        </div>
                    </div>
                    

                    
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                               <label>No Claim Bonus</label>
                           </div>
                            <div class="col-md-3">
                               <select type="number" class="form-control" name="no_claim_bonus" id="no_claim_bonus">
                                   <option value=""> Select </option>
                                   <option value="Yes"> Yes </option>
                                   <option value="No"> No </option>
                               </select>
                           </div>
                           <div class="col-md-1">
                               <label>Value</label>
                           </div>
                           <div class="col-md-4">
                               <!-- <input type="number" class="form-control" name="no_claim_bonus_val" id="no_claim_bonus_val"> -->
                               <select name="no_claim_bonus_val" id="no_claim_bonus_val" class="form-control">
                                <option value=""> Select </option>
                                <option value="20">20</option>
                                <option value="25">25</option>
                                <option value="35">35</option>
                                <option value="45">45</option>
                                <option value="50">50</option>
                                <option value="55">55</option>
                               </select>
                           </div>
                        </div>
                    </div>
                    
                     <div class="form-check">
                        <div class="row">
                            <div class="col-md-4">
                               <label>CPA</label>
                           </div>
                            <div class="form-check-input col-md-8">
                              <input type="checkbox" name="cpa" id="cpa" value= "Yes">
                           </div>
                        </div>
                    </div>
                    
                </div>
                
                <div class="col-md-6" id='own_od_div'>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                               <label>Total Own Damage Premium(A)</label>
                           </div>
                           <div class="col-md-8">
                              <input type="number" class="form-control" value="0" name="total_own_damage" id="total_own_damage">
                           </div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                               <label>Total Add On Premium(B)</label>
                           </div>
                           <div class="col-md-8">
                               <input type="number" class="form-control" name="tot_add_on_premium" id="tot_add_on_premium" onkeyup="calculate()">
                           </div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                               <label>Commission Base Premium(A+B)*</label>
                           </div>
                           <div class="col-md-8">
                               <input type="number" class="form-control" name="commisson_base_premium" id="commisson_base_premium" onkeyup="calculate()">
                           </div>
                        </div>
                    </div>
                    
                   
                </div>
            </div>
            
            <div class="row" id='liability_div'>
                <p align='center'><b>Liability Section</b></p>
                  <br>
                  <div class="col-md-6">
                      
                      <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                               <label>Basic TP</label><span>*</span>
                           </div>
                           <div class="col-md-8">
                               <input type="number" class="form-control" name="basic_tp" value="0" id="basic_tp" onkeyup="calculate()">
                           </div>
                        </div>
                      </div>
                      
                      <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                               <label>Owner Driver PA</label><span>*</span>
                           </div>
                           <div class="col-md-4">
                               <select class="form-control" name="owner_diver_pa" id="owner_driver_pa">
                                   <option value="">--Select--</option>
                                   <option value="Yes">Yes</option>
                                   <option value="No">No</option>
                               </select>
                           </div>
                           
                           <div class="col-md-4">
                               <input type="number" class="form-control" name="owner_diver_amt" id="owner_diver_amt" onkeyup="calculate()">
                           </div>
                        </div>
                      </div>
                      
                      <div class="form-group">
                          <div class="row">
                              <div class="col-md-4">
                                  <label style="font-style: italic;">No of year(Own Drv PA)</label>
                              </div>
                              <div class="col-md-8">
                                  <select class="form-control" name="no_of_year_own_drv" id="no_of_year_own_drv">
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
                               <label>Bi Fuel Kit</label>
                           </div>
                           <div class="col-md-4">
                               <select class="form-control" name="fuel_kit" id="fuel_kit">
                                   <option value="">--Select--</option>
                                   <option value="Yes">Yes</option>
                                   <option value="No">No</option>
                               </select>
                           </div>
                           
                           <div class="col-md-4">
                               <input type="number" class="form-control" name="fuel_kit_amt" id="fuel_kit_amt" onkeyup="calculate()">
                           </div>
                        </div>
                      </div>
                      
                       <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                               <label>Geograpical Area</label>
                           </div>
                           <div class="col-md-4">
                               <select class="form-control" name="geograpical" id="geograpical">
                                   <option value="">--Select--</option>
                                   <option value="Yes">Yes</option>
                                   <option value="No">No</option>
                               </select>
                           </div>
                           
                           <div class="col-md-4">
                               <input type="text" class="form-control" name="geograpical_amt" id="geograpical_amt" onkeyup="calculate()">
                           </div>
                        </div>
                      </div>
                      
                      
                  </div>
                  
                  <div class="col-md-6">
                      
                      <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                               <label>Un Named Passenger PA</label>
                           </div>
                           <div class="col-md-4">
                               <select class="form-control" name="un_named_passenger_pa" id="un_named_passenger_pa">
                                   <option value="">--Select--</option>
                                   <option value="Yes">Yes</option>
                                   <option value="No">No</option>
                               </select>
                           </div>
                           
                           <div class="col-md-4">
                               <input type="text" class="form-control" name="un_named_passenger_amt" id="un_named_passenger_amt" onkeyup="calculate()">
                           </div>
                        </div>
                      </div>
                      
                       <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                               <label style="font-style: italic;">No of seats Limit Per Person</label>
                           </div>
                           <div class="col-md-4">
                                 <input type="text" class="form-control" name="no_seats_per_person" id="no_seats_per_person">
                           </div>
                           <div class="col-md-4">
                               <input type="text" class="form-control" name="no_seats_per_person_amt" id="no_seats_per_person_amt">
                           </div>
                        </div>
                      </div>
                      
                      <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                               <label>LL to paid Drv/Emp</label>
                           </div>
                           <div class="col-md-4">
                               <select class="form-control" name="llp" id="llp">
                                   <option value="">--Select--</option>
                                   <option value="Yes">Yes</option>
                                   <option value="No">No</option>
                               </select>
                           </div>
                           
                           <div class="col-md-4">
                               <input type="text" class="form-control" name="llp_amt" id="llp_amt" onkeyup="calculate()">
                           </div>
                        </div>
                      </div>
                      
                       <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                               <label>No of Drv/Emp</label>
                           </div>
                           <div class="col-md-8">
                               <input type="text" class="form-control" name="no_drv_emp" id="no_drv_emp" onkeyup="calculate()">
                           </div>
                        </div>
                      </div>
                      
                      <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                               <label>PA Paid Drv</label><span>*</span>
                           </div>
                           <div class="col-md-4">
                               <select class="form-control" name="pa_paid_drv" id="pa_paid_drv">
                                   <option value="">--Select--</option>
                                   <option value="Yes">Yes</option>
                                   <option value="No">No</option>
                               </select>
                           </div>
                           
                           <div class="col-md-4">
                               <input type="text" class="form-control" name="pa_paid_drv_amt" id="pa_paid_drv_amt" onkeyup="calculate()">
                           </div>
                        </div>
                      </div>
                      
                      <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                               <label style="font-style: italic;">No of seats Limit Per Person</label>
                           </div>
                           <div class="col-md-4">
                                 <input type="text" class="form-control" name="no_seats_per_person1" id="no_seats_per_person1">
                           </div>
                           <div class="col-md-4">
                               <input type="text" class="form-control" name="no_seats_per_person_amt1" id="no_seats_per_person_amt1">
                           </div>
                        </div>
                      </div>
                      
                       <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                               <label>Total Liablity Premium(C)</label><span>*</span>
                           </div>
                           <div class="col-md-8">
                               <input type="text" class="form-control" name="tot_liability_premium" value="0" id="tot_liability_premium">
                           </div>
                        </div>
                      </div>
                      
                  </div>
            </div>
           
            <div class="row">
                <p align="center"><b>Total Premium</b></p>
                <br>
                <div class="col-md-6">
                    
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                                <label>Total Premium (A+B+C)</label><span>*</span>
                            </div>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="total_premium" value="0" id="total_premium">
                            </div>
                        </div>
                    </div>
                    
                     <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                                <label>GST(18%)</label><span>*</span>
                            </div>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="gst" id="gst">
                            </div>
                        </div>
                    </div>
                    
                </div>
                
                <div class="col-md-6">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                                <label>Premium With Gst</label><span>*</span>
                            </div>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="premium_gst" id="premium_gst">
                            </div>
                        </div>
                    </div>
                </div>
                
                
            </div>
            
      </div>
    </div> 
    
    
    <div class="box">
        <div class="box-header with-border" style="background:#f4f4f48c;">
            <h3 class="box-title" style="text-align: left;font-size:14px;">
                <i class="fa fa-bars" aria-hidden="true"></i> &nbsp;&nbsp; Policy Additional Details
            </h3>
            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse">
                    <i class="fa fa-minus"></i>
                </button>
            </div>
        </div>

        <div class="box-body" style="text-align: left;">
            <div class="row">

                <div class="col-md-6">

                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                                <label>Issue Date</label>
                            </div>
                            <div class="col-md-8">
                                <input type="date" class="form-control" name="policy_issue_date" id="policy_issue_date">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                                <label>Agency / Pos</label>
                            </div>
                            <div class="col-md-8">
                                <select class="form-control select2" name="policy_agency_pos" id="policy_agency_pos">
                                    <option value="">--select--</option>
                                    <?php foreach ($agents_pos as $da) { ?>
                                        <option value="<?php echo $da->id ?>">
                                            <?php echo $da->name."  (".$da->agent_pos_code.")" ?>
                                        </option>
                                    <?php } ?>
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
                                <select class="form-control" name="policy_source" id="policy_source">
                                    <option value="">--Select--</option>
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
                                <label>User</label>
                            </div>
                            <div class="col-md-8">
                                <select class="form-control" name="policy_user" id="policy_user">
                                    <option value="<?php echo $this->session->userdata('session_name')?>" selected>
                                        <?php echo $this->session->userdata('session_name')?>
                                    </option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- ✅ New Field: Previous Insurance Type (moved above Previous Policy No) -->
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                                <label>Previous Insurance Type</label>
                            </div>
                            <div class="col-md-8">
                                <select class="form-control" name="previous_insurance_type" id="previous_insurance_type">
                                    <option value="">--Select--</option>
                                    <option value="Pkg">Pkg</option>
                                    <option value="STD">STD</option>
                                    <option value="SOD">SOD</option>
                                    <option value="Bundle">Bundle</option>
                                    <option value="No Policy">No Policy</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- ✅ Existing Field: Previous Policy No -->
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                                <label>Previous Policy No</label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="previous_policy_no" id="previous_policy_no">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                                <label>Previous Insurer</label>
                            </div>
                            <div class="col-md-8">
                                <select class="form-control select2" name="previous_insurer" id="previous_insurer">
                                    <option value="">--Select--</option>
                                    <?php foreach ($company as $da) { ?>
                                        <option value="<?php echo $da->id ?>"><?php echo $da->company_name; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>


                </div>

                <div class="col-md-6">

                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                                <label>Previous Agency / Pos</label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="previous_agency_pos" id="previous_agency_pos">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                                <label>Dectable Details</label>
                            </div>
                            <div class="col-md-8">
                                <textarea class="form-control" name="dectable_details" id="dectable_details"></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                                <label>Policy Additional Informations</label>
                            </div>
                            <div class="col-md-8">
                                <textarea class="form-control" name="policy_additional_info" id="policy_additional_info"></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                                <label>Reference number</label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="reference_no" id="reference_no">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                                <label>Other Reference number</label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="other_reference_no" id="other_reference_no">
                            </div>
                        </div>
                    </div>

                    <!-- 🔄 Removed old "Previous Insurance Plan" field -->
                    
                    <div class="form-group splcom_container hidden">
                        <div class="row">
                            <div class="col-md-4">
                                <label><strong>Special Agency Commission</strong></label>
                            </div>
                            <div class="col-md-8">
                                <select class="form-control" id="is_splcommisson" name="is_splcommisson">                                  
                                    <option value="Y" selected>Applied</option>
                                    <option value="N">Ignored</option>
                                </select>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>

    
    
    <div class="box">
        <div class="box-header with-border" style="background:#f4f4f48c;">
            <h3 class="box-title" _msthash="26273" _msttexthash="60619" style="text-align: left;font-size:14px;"><i class="fa fa-bars" aria-hidden="true"></i> &nbsp;&nbsp;Payment Details </h3>
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
                               <label>Payment Type</label>
                           </div>
                           <div class="col-md-8">
                               <select class="form-control" name="payment_type" id="payment_type">
                                   <option value="">---Select---</option>
                                   <option value="Cash">Cash</option>
                                   <option value="Check">Check</option>
                                   <option value="Online">Online</option>
                                   <option value="Bank Transfer">Bank Transfer</option>
                                   <option value="NEFT">NEFT</option>
                               </select>
                           </div>
                        </div>
                      </div>
                      
                      <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                               <label>Payment Reference No / Check No</label>
                           </div>
                           <div class="col-md-8">
                              <input type="text" class="form-control" name="pay_ref_no" id="pay_ref_no">
                           </div>
                        </div>
                      </div>
                      
                      <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                               <label>Bank Name</label>
                           </div>
                           <div class="col-md-8">
                              <input type="text" class="form-control" name="bank_name" id="bank_name">
                           </div>
                        </div>
                      </div>

                      <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                               <label>Payment Receipt No</label>
                           </div>
                           <div class="col-md-8">
                              <input type="text" class="form-control" name="payment_receipt_no" id="payment_receipt_no">
                           </div>
                        </div>
                      </div>
                      
                      <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                               <label>Payment / Check Date</label>
                           </div>
                           <div class="col-md-8">
                              <input type="date" class="form-control" name="payment_check_date" id="payment_check_date">
                           </div>
                        </div>
                      </div>
                </div>
                
                <div class="col-md-6">
                    
                     <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                               <label>Payment / Check No</label>
                           </div>
                           <div class="col-md-8">
                              <input type="text" class="form-control" name="payment_and_check_no" id="payment_and_check_no">
                           </div>
                        </div>
                      </div>
                      
                       <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                               <label>Remarks</label>
                           </div>
                           <div class="col-md-8">
                              <textarea class="form-control" name="remarks_pay" id="remarks_pay" rows="3"></textarea>
                           </div>
                        </div>
                      </div>
                      
                      <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                               <label>Payment Collected Date</label>
                           </div>
                           <div class="col-md-8">
                              <input type="date" class="form-control" name="payment_collected_date" id="payment_collected_date">
                           </div>
                        </div>
                      </div>
                   </div>
                </div>
            </div> 
    </div>
    
    <div class="box" id="upload_doc">
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
                        <th>Document Name</th>
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
                    <label>Document Name</label>
                    <div class="form-group">
                          <input type = "text" class="form-control" name='document_type' id='document_type'>
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

    <?php
     if ($this->session->userdata("session_role") == "user") { ?>

     <!--   <div class="box" id="upload_doc">
            <div class="box-header with-border" style="background:#f4f4f48c;">
                <h3 class="box-title" _msthash="26273" _msttexthash="60619" style="text-align: left;font-size:14px;"><i class="fa fa-bars" aria-hidden="true"></i> &nbsp;&nbsp; Renewal By </h3>
                <div class="box-tools pull-right">
                     <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse">
                      <i class="fa fa-minus"></i></button>
                </div>
                    <div class="form-group">
                      <div class="row">   
                           <div class="col-md-2">
                               <label>Assign to User *</label>
                           </div>
                            <div class="col-md-4">
                                <select class="form-control" name="renewal_user" id="renewal_user">
                                    
                                    <?php foreach ($users as $da) {?>
                                    <option value="<?php echo $da->id ?>"><?php echo $da->username."  (".$da->email_id.")" ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                     
            </div>
             
        </div>-->
    <?php } ?>
    </section><!-- /.content -->
  </div><!-- /.content-wrapper -->
  
  
  
 <div id="email_modal" class="modal fade in" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title text-center">Send Email</h4>
      </div>
      <div class="modal-body">
          
            <div class="form-group">
                <div class="row">
                    <div class="col-md-2">
                        <label>Template</label>
                    </div>
                    <div class="col-md-10">
                        <select class="form-control" name="template_id" id="template_id">
                            <option value="">--Select--</option>
                            <?php foreach ($email_templates as $da) {?>
                              <option value="<?php echo $da->id ?>"><?php echo $da->template_name ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-8">
                    <div class="form-group">
                        <div class="col-md-4">
                            <label>From</label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" class="form-control" id="sender_email_id" name="sender_email_id" value="<?php echo $this->session->userdata('session_email_id'); ?>">
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="row">
                        <div class="col-md-4">
                            <label>Name</label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="sender_name" id="sender_name" value="<?php echo $this->session->userdata('session_name'); ?>">
                        </div>
                    </div>
                </div>
            </div>
            
            <p></p>
            
            <div class="row">
                <div class="col-md-8">
                    <div class="form-group">
                        <div class="col-md-4">
                            <label>To</label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" class="form-control" id="receiver_email_id" name="receiver_email_id">
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="row">
                        <div class="col-md-4">
                            <label>CC</label>
                        </div>
                        <div class="col-md-8">
                            <span>BC</span>
                        </div>
                    </div>
                </div>
            </div>
            
             <p></p>
            
            <div class="form-group">
                <div class="row">
                    <div class="col-md-2">
                        <label>Subject</label>
                    </div>
                    <div class="col-md-10">
                       <input type="text" class="form-control" name="email_subject" id="email_subject">
                    </div>
                </div>
            </div>
            
            <div class="form-group">
                <div class="row">
                    <div class="col-md-2">
                        <label>Message</label>
                    </div>
                    <div class="col-md-10">
                        <textarea name="email_message" id="email_message"></textarea>
                    </div>
                </div>
            </div>
            
            <div id="documents_view">
                
            </div>
            
            <p></p>
            
            <div class="form-group">
                <button type="file" class="btn btn-default btn-sm" id="upload_file"><i class="fa fa-plus" aria-hidden="true"></i> Add Uploaded File</button> 
            </div>
            
      </div>
      <div class="modal-footer">
         <button type="button" class="btn btn-primary" id="submit_btn">Submit</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

<div class="modal fade in" id="upload_doc_modal" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header bg-primary">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" style="color:#fff;">Add Uploaded Documents</h4>
        </div>
        <div class="modal-body">
            
            <table class="table table-bordered" >
                <thead>
                    <tr>
                        <th><input type="checkbox" class="form-check-input" id="check_all"></th>
                        <th class="text-align:center">Document type</th>
                        <th class="text-align:center">File Name</th>
                    </tr>
                </thead>
                <tbody  id="doc_files">
                   
                    
                </tbody>
            </table>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-primary" id="add_doc" data-dismiss="modal">Submit</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
  
  
  
<div id="add_com_modal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header" style="background-color: #dd4b39;color:#fff;">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title text-center"><i class="fa fa-inr"></i> &nbsp;
        <?=(isset($_GET['sec']) && !empty($_GET['sec'])) ? "Edit" : "Add"?> Commission
        </h4>
      </div>
      <div class="modal-body">
       
        <div class="row">
            <div class = "col-md-6">    
                <div class="card border-0">
                    <div class="form-group">
                        <label>Total Premium</label> 
                        <input type = "text" id= "tot_premium_amt" class="form-control" style='color:red;text-align:right;' disabled> 
                    </div>
                </div>
            </div>
            <div class = "col-md-6">    
                <div class="card border-0">
                    <div class="form-group">
                        <label>IRD Commission(%)</label>
                        <div class="input-group">
                            <input type="number" class="form-control" name="own_com_per" id="own_com_per">
                            <span class="input-group-addon" id="own_com_amt"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
       <!--<div class = "form-group">-->
       <!--     <label>Total Premium</label>  -->
       <!--     <input type = "text" id= "tot_premium_amt" style='color:red;text-align:right;' disabled> -->
       <!--</div> -->

        <div class = "row">
            <div class = "col-md-6">    
             <div class="card border-0">
                <div class="form-group">
                    <label>ORC Commission(%)</label>
                    <div class="input-group">
                        <input type="number" class="form-control" name="orc_com_per" id="orc_com_per">
                        <span class="input-group-addon" id="orc_com_amt"></span>
                    </div>
                </div>
              </div>
          </div>
          
            <div class = "col-md-6">
                <div class="card border-0">
                    <div class="form-group">
                    <label>Agent Commission(%)</label>
                        <div class="input-group">
                            <input type="number" class="form-control" name="agn_com" id="agn_com">
                            <span class="input-group-addon" id="agn_amount"></span>
                        </div>
                    </div>
              </div>
             </div>
               
            <div class = "col-md-6">
               <div class="card border-0">
                    <div class="form-group">
                    <label>Area Incharge(%)</label>
                        <div class="input-group">
                            <input type="number" class="form-control" name="ai_com" id="ai_com">
                            <span class="input-group-addon" id="ai_amt"></span>
                        </div>
                    </div>
              </div>
             </div>
               
            <div class = "col-md-6">
               <div class = "form-group">
                    <label>Balance</label>
                   <input type="number" class= "form-control" name="balance" id="balance">
               </div>
            </div>
         </div>
         
        <div class = "row">
             <div class = "col-md-3">
                 <div class = "form-group">
                       <label>Sub Agent 1</label>
                        <select class="form-control select2" name="sub_agn_1" id="sub_agn_1" style="width:100%">
                            <option value="">--select--</option>
                                <?php foreach ($agents_pos as $da) {?>
                                <option value="<?php echo $da->id ?>"><?php echo $da->name."  (".$da->agent_pos_code.")" ?></option>
                                 
                                <?php } ?>
                            </select>
                 </div>
                   
                </div>
                
             <div class = "col-md-3">   
                <div class="card border-0">
                        <div class="form-group">
                        <label>Sub Agent 1(%)</label>
                            <div class="input-group">
                                <input type="number" class="form-control" name="sub_agn_per" id="sub_agn_per">
                                <span class="input-group-addon" id="sub_agn_amt"></span>
                            </div>
                        </div>
                  </div>
             </div>
             
             <div class = "col-md-3">
                <div class = "form-group">
                    <label>Sub Agent 2</label>
                    <select class="form-control select2" name="sub_agn_2" id="sub_agn_2" style="width:100%">
                        <option value="">--select--</option>
                            <?php foreach ($agents_pos as $da) {?>
                            <option value="<?php echo $da->id ?>"><?php echo $da->name."  (".$da->agent_pos_code.")" ?></option>
                             
                            <?php } ?>
                        </select>
                   </div>
                </div>
                
             
             <div class = "col-md-3">   
                <div class="card border-0">
                        <div class="form-group">
                        <label>Sub Agent 2(%)</label>
                            <div class="input-group">
                                <input type="number" class="form-control" name="sub_agn_per_2" id="sub_agn_per_2">
                                <span class="input-group-addon" id="sub_agn_amt_2"></span>
                            </div>
                        </div>
                  </div>
             </div>
             
             
        </div> 
         
         
      </div>
      <div class="modal-footer">
          <button type="button" class="btn btn-primary btn-sm pull-right" id="sub_com_btn">Submit</button>
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
  


 <script>
 
   var Husband_status = "0";
   var Wife_status = "0";
   
   var Applicant_gender = "";
   
   var Daughter_1_status = "0";
   var Daughter_2_status = "0";
   var Daughter_3_status = "0";
   
   var Son_1_status = "0";
   var Son_2_status = "0";
   var Son_3_status = "0";
   
   var Father_status = "0";
   var Mother_status = "0";
 
    var class_type = "";
    var arr = [];
    
    CKEDITOR.replace('email_message' ,{height: 400});
    
    var policy_class = "";
    
    var lead_status = "0";
    
    var v_status = "0";
    var h_status = "0";

     $(document).ready(function(){
        $('.select2').select2();
        var lead_id = $("#lead_id").val();
        
        fetch_policy_documents(lead_id);
        
        $.ajax({
                 url : "get_lead_details",
                 method : "POST",
                 data : {last_inserted_id:lead_id},
                 success:function(response)
                 {
                    
                    var obj = jQuery.parseJSON(response);

                    // ✅ Disable fields (initially read-only)
                    $("#client_type, #salutation, #display_client_name, #initial, #father_husband_name, #dob, #age, #mobile_no, #email_id, #communication_address, #permanent_address, #district, #state, #country, #pin_code").attr("disabled", true);

                    // ✅ Disable rest of policy-related inputs
                    $("#bussiness_type, #policy_class, #policy_type, #lead_generated_date, #due_date, #location, #classification, #source, #agent_pos, #assign_to_user, #area_incharge, #remarks").attr("disabled", true);


                    $("#client_name").html(obj.client_name);
                    $("#policy_agency_pos").val(obj.agency_and_pos);
                    $("#policy_agency_pos").trigger("change");
                    
                    // Fill client data
                    $("#client_type").val(obj.client_type_id);
                    $("#salutation").val(obj.salutation);
                    $("#display_client_name").val(obj.client_name); // ✅ read-only client name field
                    $("#initial").val(obj.initial);
                    $("#father_husband_name").val(obj.father_husband_name);
                    $("#dob").val(obj.date_of_birth);
                    $("#age").val(obj.age);
                    $("#mobile_no").val(obj.mobile_no);
                    $("#email_id").val(obj.email);
                    $("#communication_address").val(obj.communication_address);
                    $("#permanent_address").val(obj.permanent_address);
                    $("#district").val(obj.district);
                    $("#state").val(obj.state);
                    $("#country").val(obj.country);
                    $("#pin_code").val(obj.pin_code);

                    // === LOAD CUSTOM FIELDS ===
                    $("#custom_fields_container").html("");
                    if (obj.custom_fields && obj.custom_fields !== "") {
                        try {
                            let customFields = JSON.parse(obj.custom_fields);
                            if (!Array.isArray(customFields)) {
                                customFields = Object.entries(customFields).map(([label, value]) => ({
                                    label,
                                    value,
                                }));
                            }
                            customFields.forEach(function (field, index) {
                                let label = field.label || field.key || Object.keys(field)[0];
                                let value = field.value || field[label] || "";
                                let fieldHtml = `
                                    <div class="row mb-2" id="custom_field_${index}" style="margin-top:10px;">
                                        <div class="col-md-5">
                                            <input type="text" class="form-control custom_label" name="custom_label[]" value="${label}" placeholder="Label" disabled>
                                        </div>
                                        <div class="col-md-5">
                                            <input type="text" class="form-control custom_value" name="custom_value[]" value="${value}" placeholder="Value" disabled>
                                        </div>
                                    </div>`;
                                $("#custom_fields_container").append(fieldHtml);
                            });
                        } catch (e) {
                            console.error("Error parsing custom fields JSON:", e);
                            $("#custom_fields_container").html('<p class="text-danger">Error loading custom fields</p>');
                        }
                    } else {
                        $("#custom_fields_container").html('<p class="text-muted">No additional fields</p>');
                    }

                    // ✅ Set lead-related fields (unchanged)
                    $("#bussiness_type").val(obj.business_type);
                    $("#policy_class").val(obj.class);
                    $("#classification").val(obj.classfication);
                    $("#source").val(obj.source);
                    $("#agent_pos").val(obj.agency_and_pos).trigger("change");
                    $("#location").val(obj.location);
                    $("#remarks").val(obj.remarks);
                    $("#lead_generated_date").val(obj.lead_generated_date);
                    $("#due_date").val(obj.due_date);
                    $("#lead_Status").val(obj.lead_status);

                    var policy_type_id = obj.policy_type;
                    policy_class = obj.class;

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



                     if(obj.class == "2")
                     {
                         $("#policy_premium_div").addClass("hidden");
                         $("#liability_div").addClass("hidden");
                         $("#own_od_div").addClass("hidden");
                         $("#add_commision_btn").addClass("hidden");
                         $("#own_damage_title").addClass("hidden");
                         $("#ins_person_div").removeClass("hidden");
                         $("#add_ons_div").removeClass("hidden");
                         class_type = "2";
                         fetch_health_details(lead_id);
                         
                         $.ajax({
                             url : "fetch_edit_health_details",
                             method : "POST",
                             data : {lead_id:lead_id},
                             success:function(response)
                             {
                                  var obj = jQuery.parseJSON(response);
                                    if(obj != null || obj != "")
                                    {
                                        h_status = "1";
                                    }
                             }
                     });
                     }
                     else if(obj.class == "1")
                     {
                         $("#own_damage_title").removeClass("hidden");
                         $("#ins_person_div").addClass("hidden");
                         class_type = "1";
                         $("#add_ons_div").addClass("hidden");
                         $("#add_commision_btn").addClass("hidden");
                         
                           $.ajax({
                                          url : "get_vechile_details",
                                          method : "POST",
                                          data : {id:lead_id},
                                          success:function(response)
                                          {
                                            var obj = jQuery.parseJSON(response);
                                            
                                            if(obj != null || obj != "")
                                            {
                                                 v_status = "1";
                                            }
                                          }
                                    });
                     }
                     else if(obj.class == "10")
                     {
                         $("#ins_person_div").addClass("hidden");
                         $("#add_ons_div").addClass("hidden");
                         $("#policy_premium_div").addClass("hidden");
                         $("#liability_div").addClass("hidden");
                         $("#own_od_div").addClass("hidden");
                         $("#own_damage_title").addClass("hidden");
                         $("#add_commision_btn").removeClass("hidden");
                     }

                     // ✅ Show Edit Button (important!)
		            $("#edit_client_btn").removeClass("hidden");

                }
        });
    
        $.ajax({
                 url : "get_temp_data",
                 method : "POST",
                 data : {lead_id:lead_id},
                 success:function(response)
                 {
                     var obj = jQuery.parseJSON(response);
                     
                      if(obj != null)
                      {
                            $("#edit_id").val(obj.id);
                            $("#policy_cover_note_no").val(obj.policy_cover_note_no);
                            $("#policy_no").val(obj.policy_no);
                            $("#company").val(obj.company);
                            $("#company").trigger("change");
                            $("#policy_s_date").val(obj.policy_s_date);
                            $("#policy_ex_date").val(obj.policy_ex_date);
                            $("#policy_premium").val(obj.policy_premium);
                            $("#policy_terms").val(obj.policy_terms);
                            $("#payment_frequency").val(obj.payment_frequency);
                            $("#next_due_date").val(obj.next_due_date);
                            $("#renewable_flag").val(obj.renewable_flag);
                            $("#add_ons_opted").val(obj.add_ons_opted);
                            $("#add_ons_not_opt").val(obj.add_ons_not_opt);
                            $("#sum_insured").val(obj.sum_insured);
                            $("#discount_percent").val(obj.discount_percent);
                            $("#no_claim_bonus").val(obj.no_claim_bonus);
                            $("#no_claim_bonus_val").val(obj.no_claim_bonus_val);
                            $("#total_own_damage").val(obj.total_own_damage);
                            $("#tot_add_on_premium").val(obj.tot_add_on_premium);
                            $("#commisson_base_premium").val(obj.commisson_base_premium);
                            $("#basic_tp").val(obj.basic_tp);
                            $("#owner_driver_pa").val(obj.owner_driver_pa);
                            $("#owner_diver_amt").val(obj.owner_diver_amt);
                            $("#no_of_year_own_drv").val(obj.no_of_year_own_drv);
                            $("#fuel_kit").val(obj.fuel_kit);
                            $("#fuel_kit_amt").val(obj.fuel_kit_amt);
                            $("#geograpical").val(obj.geograpical);
                            $("#geograpical_amt").val(obj.geograpical_amt);
                            $("#un_named_passenger_pa").val(obj.un_named_passenger_pa);
                            $("#un_named_passenger_amt").val(obj.un_named_passenger_amt);
                            $("#no_seats_per_person").val(obj.no_seats_per_person);
                            $("#no_seats_per_person_amt").val(obj.no_seats_per_person_amt);
                            $("#LL_paid ").val(obj.llp);
                            $("#LL_paid_amt").val(obj.llp_amt);
                            $("#no_drv_emp").val(obj.no_drv_emp);
                            if(obj.cpa == "Yes")
                            {
                                $("#cpa").prop("checked",true);
                            }
                            else
                            {
                                $("#cpa").prop("checked",false);
                            }
                            $("#pa_paid_drv").val(obj.pa_paid_drv);
                            $("#pa_paid_drv_amt").val(obj.pa_paid_drv_amt);
                            $("#no_seats_per_person1").val(obj.no_seats_per_person1);
                            $("#no_seats_per_person_amt1").val(obj.no_seats_per_person_amt1);
                            $("#tot_liability_premium").val(obj.tot_liability_premium);
                            $("#total_premium").val(obj.total_premium);
                            $("#gst").val(obj.gst);
                            $("#premium_gst").val(obj.premium_gst);
                            $("#policy_issue_date").val(obj.policy_issue_date);
                            $("#policy_agency_pos").val(obj.policy_agency_pos);
                            
                            $('#_commission_id').val(obj.commission_id); // 2023-06-08
                            $("#policy_agency_pos").trigger("change");  // 2023-06-08
                            
                            $("#policy_source").val(obj.policy_source);
                            $("#policy_user").val(obj.policy_user);
                            $("#policy_location").val(obj.policy_location);
                            $("#previous_policy_no").val(obj.previous_policy_no);
                            $("#previous_insurer").val(obj.previous_insurer);
                            $("#previous_insurer").trigger("change");
                            $("#previous_insurance_type").val(obj.previous_insurance_type);
                            $("#previous_agency_pos").val(obj.previous_agency_pos);
                            $("#previous_source").val(obj.previous_source);
                            $("#dectable_details").val(obj.dectable_details);
                            $("#policy_additional_info").val(obj.policy_additional_info);
                            $("#reference_no").val(obj.reference_no);
                            $("#other_reference_no").val(obj.other_reference_no);
                            $("#payment_type").val(obj.payment_type);
                            $("#pay_ref_no").val(obj.pay_ref_no);
                            $("#bank_name").val(obj.bank_name);
                            $("#payment_receipt_no").val(obj.payment_receipt_no);
                            $("#payment_check_date").val(obj.payment_check_date);
                            $("#payment_and_check_no").val(obj.payment_and_check_no);
                            $("#remarks").val(obj.remarks);
                            
                            // 2023-06-01 start
                            if(obj.policy_premium == "1" || obj.policy_premium == "4") {
                                $("#od_start_date").val(obj.od_start_date);
                                $("#od_end_date").val(obj.od_end_date);
                                $("#tp_start_date").val(obj.tp_start_date);
                                $("#tp_end_date").val(obj.tp_end_date);
                                $('.dts').each(function(i) {
                                    $(this).removeClass('hidden');
                                });
                            }
                            // 2023-06-01 end
                            
                            // 2023-06-08
                            $('#is_splcommisson').val(obj.applied_splcommission);
                      }
                  
                 }
        });
     
        $("#total_premium").keyup(function(){
            var total_premium1 = $("#total_premium").val();
            if(total_premium1 != "")
            {
                total_premium1 = parseFloat(total_premium1);
                var gst1 = (total_premium1 * 18) / 100;
                var tot = total_premium1 + gst1;
                $("#gst").val(gst1);
                $("#premium_gst").val(tot);
            }
            
        });
        
        $("#policy_s_date").change(function() {
            var date = $("#policy_s_date").val();
            $.ajax({
                url: "get_exp_date",
                method: "POST",
                data: { date: date },
                success: function(response) {
                    // Set expiry and next due dates
                    $("#policy_ex_date").val(response);
                    $("#next_due_date").val(response);

                    // ✅ Calculate Days Insured automatically
                    var startVal = $("#policy_s_date").val();
                    var endVal = $("#policy_ex_date").val();

                    if (startVal && endVal) {
                        var startDate = new Date(startVal);
                        var endDate = new Date(endVal);
                        if (!isNaN(startDate.getTime()) && !isNaN(endDate.getTime())) {
                            var diffTime = endDate - startDate;
                            var days = Math.ceil(diffTime / (1000 * 60 * 60 * 24)) + 1; // include both dates
                            $("#days_insured").val(days + " days");
                        } else {
                            $("#days_insured").val("");
                        }
                    }
                }
            });
        });

        // ✅ Optional: Recalculate if expiry is changed manually
        $("#policy_ex_date").change(function() {
            var startVal = $("#policy_s_date").val();
            var endVal = $("#policy_ex_date").val();
            if (startVal && endVal) {
                var startDate = new Date(startVal);
                var endDate = new Date(endVal);
                var diffTime = endDate - startDate;
                var days = Math.ceil(diffTime / (1000 * 60 * 60 * 24)) + 1;
                $("#days_insured").val(days + " days");
            }
        });

        
        $("#policy_agency_pos").change(function(){
            var agent_id = $("#policy_agency_pos").val();
            var policy_issue_date = $('#policy_issue_date').val();
            var commission_id = $('#_commission_id').val();
            if(policy_issue_date && commission_id) {
                $.ajax({
                    url : "getAgentSplCommission",
                    method : "POST",
                    data : {agent_id:agent_id, policy_issue_date: policy_issue_date, commission_id: commission_id},
                    dataType: "json",
                    success:function(response)
                    {
                        var size = Object.keys(response).length;
                        if(size > 0){
                            $('.splcom_container').removeClass('hidden');
                        } else {
                            $('.splcom_container').addClass('hidden');
                        }
                    }
                });
            }
        });
        
        $("#save_btn").click(function(){
                var lead_id = $("#lead_id").val();
             //   var renewal_user = $("#renewal_user").val();
                var policy_client_ref_no = "";//$("#policy_client_ref_no").val();
                var policy_cover_note_no = $("#policy_cover_note_no").val();
                var policy_no  = $("#policy_no").val();
                var policy_s_date = $("#policy_s_date").val();
                var policy_ex_date = $("#policy_ex_date").val();
                var policy_premium = $("#policy_premium").val();
                var policy_terms = $("#policy_terms").val();
                var payment_frequency = $("#payment_frequency").val();
                var next_due_date = $("#next_due_date").val();
                var renewable_flag = $("#renewable_flag").val();
                var add_ons_opted = "";//$("#add_ons_opted").val();
                var add_ons_not_opt =""; //$("#add_ons_not_opt").val();
                var sum_insured = $("#sum_insured").val();
                var discount_percent = $("#discount_percent").val();
                var no_claim_bonus = $("#no_claim_bonus").val();
                var cpa_val = $("#cpa").val();
                
                if($("#cpa").is(":checked"))
                {
                    var cpa = "Yes";
                }
                else
                {
                    var cpa = "No";
                }
                
                var no_claim_bonus_val = $("#no_claim_bonus_val").val();
                var total_own_damage = $("#total_own_damage").val();
                var tot_add_on_premium = $("#tot_add_on_premium").val();
                var commisson_base_premium = $("#commisson_base_premium").val();
                var basic_tp = $("#basic_tp").val();
                var owner_driver_pa = $("#owner_driver_pa").val();
                var owner_diver_amt = $("#owner_diver_amt").val();
                var no_of_year_own_drv = $("#no_of_year_own_drv").val();
                var fuel_kit = $("#fuel_kit").val();
                var fuel_kit_amt = $("#fuel_kit_amt").val();
                var geograpical = $("#geograpical").val();
                var geograpical_amt = $("#geograpical_amt").val();
                var un_named_passenger_pa = $("#un_named_passenger_pa").val();
                var un_named_passenger_amt = $("#un_named_passenger_amt").val();
                var no_seats_per_person = $("#no_seats_per_person").val();
                var no_seats_per_person_amt = $("#no_seats_per_person_amt").val();
                var llp = $("#llp").val();
                var llp_amt = $("#llp_amt").val();
                var no_drv_emp = $("#no_drv_emp").val();
                var pa_paid_drv = $("#pa_paid_drv").val();
                var pa_paid_drv_amt = $("#pa_paid_drv_amt").val();
                var no_seats_per_person1 = $("#no_seats_per_person1").val();
                var no_seats_per_person_amt1 = $("#no_seats_per_person_amt1").val();
                var tot_liability_premium = $("#tot_liability_premium").val();
                var total_premium = $("#total_premium").val();
                var gst = $("#gst").val();
                var premium_gst = $("#premium_gst").val();
                var policy_issue_date = $("#policy_issue_date").val();
                var policy_agency_pos = $("#policy_agency_pos").val();
                var policy_source = $("#policy_source").val();
                var policy_user = $("#policy_user").val();
                var policy_location =""; //$("#policy_location").val();
                var previous_policy_no = $("#previous_policy_no").val();
                var previous_insurer = $("#previous_insurer").val();
                var previous_insurance_type = $("#previous_insurance_type").val();
                var previous_agency_pos = $("#previous_agency_pos").val();
                var previous_source =""; //$("#previous_source").val();
                var dectable_details = $("#dectable_details").val();
                var policy_additional_info = $("#policy_additional_info").val();
                var reference_no = $("#reference_no").val();
                var other_reference_no = $("#other_reference_no").val();
                var company = $("#company").val();
                var policy_received = "";  
                var policy_verified = "";
                var policy_cancelled = "";
                
             
                var policy_verified_info = $("#policy_verified_info").val();
                var policy_cancelled_info = $("#policy_cancelled_info").val();
                
                var commisson_generation =""; //$("#commisson_generation").val();
                var payment_type = $("#payment_type").val();
                var pay_ref_no = $("#pay_ref_no").val();
                var bank_name = $("#bank_name").val();
                var payment_receipt_no = $("#payment_receipt_no").val();
                var payment_check_date = $("#payment_check_date").val();
                var payment_and_check_no = $("#payment_and_check_no").val();
                var remarks = $("#remarks").val();
                var payment_collected_date = $("#payment_collected_date").val();
                
                var add_ons_1 = $("#add_ons_1").val();
                var add_ons_2 = $("#add_ons_2").val();
                var add_ons_3 = $("#add_ons_3").val();
                var add_ons_4 = $("#add_ons_4").val();
                var add_ons_5 = $("#add_ons_5").val();
                var add_ons_1_details = $("#add_ons_1_details").val();
                var add_ons_2_details = $("#add_ons_2_details").val();
                var add_ons_3_details = $("#add_ons_3_details").val();
                var add_ons_4_details = $("#add_ons_4_details").val();
                var add_ons_5_details = $("#add_ons_5_details").val();
                
                if(class_type == "2")
                {
                    var disease_husband = $("#disease_husband").val();
                    var husband_file = $("#husband_file").val();
                    var disease_wife = $("#disease_wife").val();
                    
                    var wife_file = $("#wife_file").val(); 
                
                
                if(typeof(husband_file) != "undefined" && husband_file !== null)
                {
                    var husband_file = $("#husband_file").prop('files')[0]; 
                }
                else
                {
                    var husband_file = "";
                }
                
                if(typeof(wife_file) != "undefined" && wife_file !== null)
                {
                    var wife_file = $("#wife_file").prop('files')[0]; 
                }
                else
                {
                    var wife_file = "";
                }
                
                var disease_daug_1 = $("#disease_daug_1").val();
                var disease_daug_2 = $("#disease_daug_2").val();
                var disease_daug_3 = $("#disease_daug_3").val();
                var daug_1_file = $("#daug_1_file").val();
                var daug_2_file = $("#daug_2_file").val();
                var daug_3_file = $("#daug_3_file").val();
                
                if(typeof(daug_1_file) != "undefined" && daug_1_file !== null)
                {
                    var daug_1_file = $("#daug_1_file").prop('files')[0]; 
                }
                else
                {
                    var daug_1_file = "";
                }
                
                if(typeof(disease_daug_2) != "undefined" && disease_daug_2 !== null)
                {
                    var daug_2_file = $("#daug_2_file").prop('files')[0]; 
                }
                else
                {
                    var daug_2_file = "";
                }
                
                if(typeof(daug_3_file) != "undefined" && daug_3_file !== null)
                {
                    var daug_3_file = $("#daug_3_file").prop('files')[0]; 
                }
                else
                {
                    var daug_3_file = "";
                }
                
                var disease_son_1 = $("#disease_son_1").val();
                var disease_son_2 = $("#disease_son_2").val();
                var disease_son_3 = $("#disease_son_3").val();
                
                var son_1_file = $("#son_1_file").val();
                var son_2_file = $("#son_2_file").val();
                var son_3_file = $("#son_3_file").val();
                
                
                if(typeof(son_1_file) != "undefined" && son_1_file !== null)
                {
                    var son_1_file = $("#son_1_file").prop('files')[0]; 
                }
                else
                {
                    var son_1_file = "";
                }
                
                
                
                
                if(typeof(son_2_file) != "undefined" && son_2_file !== null)
                {
                    var son_2_file = $("#son_1_file").prop('files')[0]; 
                }
                else
                {
                    var son_2_file = "";
                }
                
                if(typeof(son_3_file) != "undefined" && son_3_file !== null)
                {
                    var son_3_file = $("#son_3_file").prop('files')[0]; 
                }
                else
                {
                    var son_3_file = "";
                }
                
                var disease_father = $("#disease_father").val();
                var disease_mother = $("#disease_mother").val();
                
                var father_file = $("#father_file").val();
                var mother_file = $("#mother_file").val();
                
                
                if(typeof(father_file) != "undefined" && father_file !== null)
                {
                    var father_file = $("#son_3_file").prop('files')[0]; 
                }
                else
                {
                    var father_file = "";
                }
                
                if(typeof(mother_file) != "undefined" && mother_file !== null)
                {
                    var mother_file = $("#son_3_file").prop('files')[0]; 
                }
                else
                {
                    var mother_file = "";
                }
                }
                
                // 2023-06-01 start
                var od_start_date, od_end_date, tp_start_date, tp_end_date;
                od_start_date = ($('.odst').length > 0) ? $('#od_start_date').val() : "";
                od_end_date   = ($('.oded').length > 0) ? $('#od_end_date').val() : "";
                tp_start_date = ($('.tpst').length > 0) ? $('#tp_start_date').val() : "";
                tp_end_date   = ($('.tped').length > 0) ? $('#tp_end_date').val() : "";
                // 2023-06-01 end
                
                var check = 0;
                
                if(company == "")
                {
                Swal.fire(
                      'Select Insurance Company ?',
                      'That thing is still around?',
                      'question'
                    )
                check = "1";
                }
                else if(class_type == "1" && policy_premium == "")
                {
                Swal.fire(
                      'Select Policy Premium Cover Type ?',
                      'That thing is still around?',
                      'question'
                    )
                check = "1";
                }
                else if(payment_frequency == "")
                {
                Swal.fire(
                      'Select Payment Frequency ?',
                      'That thing is still around?',
                      'question'
                    )
                check = "1";
                }
                else if(policy_s_date == "")
                {
                Swal.fire(
                      'Select Policy Start Date ?',
                      'That thing is still around?',
                      'question'
                    )
                check = "1";
                }
                else if(policy_ex_date == "")
                {
                Swal.fire(
                      'Select Policy Expiry Date ?',
                      'That thing is still around?',
                      'question'
                    )
                check = "1";
                }
                else if(sum_insured == "")
                {
                Swal.fire(
                      'Enter Sum Insured ?',
                      'That thing is still around?',
                      'question'
                    )
                check = "1";
                }
                else if(no_claim_bonus == "")
                {
                Swal.fire(
                      'Select No Claim Bonus Yes / No ?',
                      'That thing is still around?',
                      'question'
                    )
                check = "1";
                }
                else if((policy_premium == "1" || policy_premium == "2") && (basic_tp == "" || basic_tp == "0"))
                {
                Swal.fire(
                      'Enter Basic Tp Amount?',
                      'That thing is still around?',
                      'question'
                    )
                check = "1";
                }
                else if((policy_premium == "1" || policy_premium == "2") && (tot_liability_premium == "" || tot_liability_premium == "0"))
                {
                Swal.fire(
                      'Enter Total Liability Premium?',
                      'That thing is still around?',
                      'question'
                    )
                check = "1";
                }
                else if(total_premium == "" || total_premium == "0")
                {
                Swal.fire(
                      'Enter Total Premium?',
                      'That thing is still around?',
                      'question'
                    )
                check = "1";
                }
                else if(premium_gst == "" || premium_gst == "0")
                {
                    Swal.fire(
                          'Enter Premium With Gst?',
                          'That thing is still around?',
                          'question'
                        )
                    check = "1";
                }
                else if(gst == "" || gst == "0")
                {
                    Swal.fire(
                          'Enter Gst?',
                          'That thing is still around?',
                          'question'
                        )
                    check = "1";
                }
                else if(policy_issue_date == "")
                {
                    Swal.fire(
                          'Enter Policy Issue Date?',
                          'That thing is still around?',
                          'question'
                        )
                    check = "1";
                }
                else if(policy_agency_pos == "")
                {
                    Swal.fire(
                          'Policy Agency/ Pos ?',
                          'That thing is still around?',
                          'question'
                        )
                    check = "1";
                }
                else if(class_type == "2" && Husband_status == "1" && disease_husband == "")
                {
                    if(Applicant_gender == "Male")
                    {
                          Swal.fire(
                              'Select Applicatant Pre-existing Disease ?',
                              'That thing is still around?',
                              'question'
                            )
                    }
                    else
                    {
                          Swal.fire(
                              'Select Husband Pre-existing Disease ?',
                              'That thing is still around?',
                              'question'
                            )
                    }
                    check = "1";
                }
                else if(class_type == "2" && Wife_status == "1" && disease_wife == "")
                {
                    if(Applicant_gender == "Male")
                    {
                        Swal.fire(
                              'Select Wife Pre-existing Disease ?',
                              'That thing is still around?',
                              'question'
                            )
                    }
                    else
                    {
                           Swal.fire(
                              'Select Applicatant Pre-existing Disease ?',
                              'That thing is still around?',
                              'question'
                            )
                    }
                    check = "1";
                    }
                else if(class_type == "2" && Daughter_1_status == "1" && disease_daug_1 == "")
                {
                          Swal.fire(
                              'Select Daughter 1 Pre-existing Disease ?',
                              'That thing is still around?',
                              'question'
                            )
                    check = "1";
                }
                else if(class_type == "2" && Daughter_2_status == "1" && disease_daug_2 == "")
                {
                          Swal.fire(
                              'Select Daughter 2 Pre-existing Disease ?',
                              'That thing is still around?',
                              'question'
                            )
                    check = "1";
                }
                else if(class_type == "2" && Daughter_3_status == "1" && disease_daug_3 == "")
                {
                      Swal.fire(
                          'Select Daughter 3 Pre-existing Disease ?',
                          'That thing is still around?',
                          'question'
                        )
                check = "1";
                }
                else if(class_type == "2" && Son_1_status == "1" && disease_son_1 == "")
                {
                      Swal.fire(
                          'Select Son 1 Pre-existing Disease ?',
                          'That thing is still around?',
                          'question'
                        )
                check = "1";
                }
                else if(class_type == "2" && Son_2_status == "1" && disease_son_2 == "")
                {
                      Swal.fire(
                          'Select Son 2 Pre-existing Disease ?',
                          'That thing is still around?',
                          'question'
                        )
                check = "1";
                }
                else if(class_type == "2" && Son_3_status == "1" && disease_son_3 == "")
                {
                      Swal.fire(
                          'Select Son 3 Pre-existing Disease ?',
                          'That thing is still around?',
                          'question'
                        )
                check = "1";
                }
                else if(class_type == "2" && Father_status == "1" && disease_father == "")
                {
                      Swal.fire(
                          'Select Father Pre-existing Disease ?',
                          'That thing is still around?',
                          'question'
                        )
                check = "1";
                }
                else if(class_type == "2" && Mother_status == "1" && disease_mother == "")
                {
                      Swal.fire(
                          'Select Mother Pre-existing Disease ?',
                          'That thing is still around?',
                          'question'
                        )
                check = "1";
                }
                else if(class_type == "2" && Husband_status == "1" && disease_husband == "Yes" && husband_file == undefined)
                {
                if(Applicant_gender == "Male")
                {
                      Swal.fire(
                          'Upload Applicant Declaration Form ?',
                          'That thing is still around?',
                          'question'
                        )
                }
                else
                {
                      Swal.fire(
                          'Upload Husband Declaration Form ?',
                          'That thing is still around?',
                          'question'
                        )
                }
                check = "1";
                }
                else if((class_type == "2" && Wife_status == "1" && disease_wife == "Yes") && (wife_file == "" || wife_file == undefined))
                {
                if(Applicant_gender == "Female")
                {
                      Swal.fire(
                          'Upload Applicatant Declaration Form ?',
                          'That thing is still around?',
                          'question'
                        )
                }
                else
                {
                      Swal.fire(
                          'Upload Wife Declaration Form ?',
                          'That thing is still around?',
                          'question'
                        )
                }
                check = "1";
                }
                else if((class_type == "2" && Daughter_1_status == "1" && disease_daug_1 == "Yes") && (daug_1_file == "" || daug_1_file == undefined))
                {
                      Swal.fire(
                          'Upload Daughter 1 Declaration Form ?',
                          'That thing is still around?',
                          'question'
                        )
                check = "1";
                }
                else if((class_type == "2" && Daughter_2_status == "1" && disease_daug_2 == "Yes") && (daug_2_file == "" || daug_2_file ==undefined))
                {
                      Swal.fire(
                          'Upload Daughter 2 Declaration Form ?',
                          'That thing is still around?',
                          'question'
                        )
                check = "1";
                }
                else if((class_type == "2" && Daughter_3_status == "1" && disease_daug_3 == "Yes") && (daug_3_file == "" && daug_3_file == undefined))
                {
                      Swal.fire(
                          'Upload Daughter 3 Declaration Form ?',
                          'That thing is still around?',
                          'question'
                        )
                check = "1";
                }
                else if((class_type == "2" && Son_1_status == "1" && disease_son_1 == "Yes") && (son_1_file == "" || son_1_file == undefined))
                {
                      Swal.fire(
                          'Upload Son 1 Declaration Form ?',
                          'That thing is still around?',
                          'question'
                        )
                check = "1";
                }
                else if((class_type == "2" && Son_2_status == "1" && disease_son_2 == "Yes") && (son_2_file == "" || son_2_file == undefined))
                {
                      Swal.fire(
                          'Upload Son 2 Declaration Form ?',
                          'That thing is still around?',
                          'question'
                        )
                check = "1";
                }
                else if((class_type == "2" && Son_3_status == "1" && disease_son_3 == "Yes") && (son_3_file == "" || son_3_file == undefined))
                {
                      Swal.fire(
                          'Upload Son 3 Declaration Form ?',
                          'That thing is still around?',
                          'question'
                        )
                check = "1";
                }
                else if((class_type == "2" && Father_status == "1" && disease_father == "Yes") && (father_file == "" || father_file == undefined))
                {
                      Swal.fire(
                          'Upload Father Declaration Form ?',
                          'That thing is still around?',
                          'question'
                        )
                check = "1";
                }
                else if((class_type == "2" && Mother_status == "1" && disease_mother == "Yes") && (mother_file == "" || father_file == undefined))
                {
                      Swal.fire(
                          'Upload Mother Declaration Form ?',
                          'That thing is still around?',
                          'question'
                        )
                check = "1";
                }
                else if(v_status == "0" && class_type == "1")
                {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Oops...',
                            text: 'Add vechicle Details Before Save The Policy!',
                            footer: ''
                        })
                }
                else if(h_status == "0" && class_type == "2")
                {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Oops...',
                            text: 'Add Health Details Before Save The Policy!',
                            footer: ''
                        })
                }
                else 
                {
                    var formdata = new FormData();
                    formdata.append('lead_id',lead_id);
                 //   formdata.append('renewal_user',renewal_user);
                    formdata.append('policy_client_ref_no',policy_client_ref_no);
                    formdata.append('policy_cover_note_no',policy_cover_note_no);
                    formdata.append('policy_no',policy_no);
                    formdata.append('policy_s_date',policy_s_date);
                    formdata.append('policy_ex_date',policy_ex_date);
                    formdata.append('policy_premium',policy_premium);
                    formdata.append('policy_terms',policy_terms);
                    formdata.append('payment_frequency',payment_frequency);
                    formdata.append('next_due_date',next_due_date);
                    formdata.append('renewable_flag',renewable_flag);
                    formdata.append('add_ons_opted',add_ons_opted);
                    formdata.append('add_ons_not_opt',add_ons_not_opt);
                    formdata.append('sum_insured',sum_insured);
                    formdata.append('discount_percent',discount_percent);
                    formdata.append('no_claim_bonus',no_claim_bonus);
                    formdata.append('cpa',cpa);
                    formdata.append('no_claim_bonus_val',no_claim_bonus_val);
                    formdata.append('total_own_damage',total_own_damage);
                    formdata.append('tot_add_on_premium',tot_add_on_premium);
                    formdata.append('commisson_base_premium',commisson_base_premium);
                    formdata.append('basic_tp',basic_tp);
                    formdata.append('owner_driver_pa',owner_driver_pa);
                    formdata.append('owner_diver_amt',owner_diver_amt);
                    formdata.append('no_of_year_own_drv',no_of_year_own_drv);
                    formdata.append('fuel_kit',fuel_kit);
                    formdata.append('fuel_kit_amt',fuel_kit_amt);
                    formdata.append('geograpical',geograpical);
                    formdata.append('geograpical_amt',geograpical_amt);
                    formdata.append('un_named_passenger_pa',un_named_passenger_pa);
                    formdata.append('un_named_passenger_amt',un_named_passenger_amt);
                    formdata.append('no_seats_per_person',no_seats_per_person);
                    formdata.append('no_seats_per_person_amt',no_seats_per_person_amt);
                    formdata.append('company',company);
                    formdata.append('llp',llp);
                    formdata.append('llp_amt',llp_amt);
                    formdata.append('no_drv_emp',no_drv_emp);
                    formdata.append('pa_paid_drv',pa_paid_drv);
                    formdata.append('pa_paid_drv_amt',pa_paid_drv_amt);
                    formdata.append('no_seats_per_person1',no_seats_per_person1);
                    formdata.append('no_seats_per_person_amt1',no_seats_per_person_amt1);
                    formdata.append('tot_liability_premium',tot_liability_premium);
                    formdata.append('total_premium',total_premium);
                    formdata.append('gst',gst);
                    formdata.append('premium_gst',premium_gst);
                    formdata.append('policy_issue_date',policy_issue_date);
                    formdata.append('policy_agency_pos',policy_agency_pos);
                    formdata.append('policy_source',policy_source);
                    formdata.append('policy_user',policy_user);
                    formdata.append('policy_location',policy_location);
                    formdata.append('previous_policy_no',previous_policy_no);
                    formdata.append('previous_insurer',previous_insurer);
                    formdata.append('previous_insurance_type',previous_insurance_type);
                    formdata.append('previous_agency_pos',previous_agency_pos);
                    formdata.append('previous_source',previous_source);
                    formdata.append('dectable_details',dectable_details);
                    formdata.append('policy_additional_info',policy_additional_info);
                    formdata.append('reference_no',reference_no);
                    formdata.append('other_reference_no',other_reference_no);
                    formdata.append('policy_received',policy_received);
                    formdata.append('policy_verified',policy_verified);
                    formdata.append('policy_verified_info',policy_verified_info);
                    formdata.append('policy_cancelled',policy_cancelled);
                    formdata.append('policy_cancelled_info',policy_cancelled_info);
                    formdata.append('commisson_generation',commisson_generation);
                    formdata.append('payment_type',payment_type);
                    formdata.append('pay_ref_no',pay_ref_no);
                    formdata.append('bank_name',bank_name);
                    formdata.append('payment_receipt_no',payment_receipt_no);
                    formdata.append('payment_check_date',payment_check_date);
                    formdata.append('payment_and_check_no',payment_and_check_no);
                    formdata.append('remarks',remarks);
                    formdata.append('payment_collected_date',payment_collected_date);
                
                    if(class_type == "2")
                    {
                            formdata.append('disease_husband',disease_husband);
                            formdata.append('husband_file',husband_file);
                            formdata.append('disease_wife',disease_husband);
                            formdata.append('wife_file',husband_file);
                            formdata.append('disease_daug_1',disease_daug_1);
                            formdata.append('disease_daug_2',disease_daug_2);
                            formdata.append('disease_daug_3',disease_daug_3);
                            formdata.append('daug_1_file',daug_1_file);
                            formdata.append('daug_2_file',daug_2_file);
                            formdata.append('daug_3_file',daug_3_file);
                            formdata.append('disease_son_1',disease_son_1);
                            formdata.append('disease_son_2',disease_son_2);
                            formdata.append('disease_son_3',disease_son_3);
                            formdata.append('son_1_file',son_1_file);
                            formdata.append('son_2_file',son_2_file);
                            formdata.append('son_3_file',son_3_file);
                            formdata.append('disease_father',disease_father);
                            formdata.append('disease_mother',disease_mother);
                            formdata.append('father_file',father_file);
                            formdata.append('mother_file',mother_file);
                    }
                
                        formdata.append('add_ons_1',add_ons_1);
                        formdata.append('add_ons_2',add_ons_2);
                        formdata.append('add_ons_3',add_ons_3);
                        formdata.append('add_ons_4',add_ons_4);
                        formdata.append('add_ons_5',add_ons_5);
                      
                        
                        formdata.append('add_ons_1_details',add_ons_1_details);
                        formdata.append('add_ons_2_details',add_ons_2_details);
                        formdata.append('add_ons_3_details',add_ons_3_details);
                        formdata.append('add_ons_4_details',add_ons_4_details);
                        formdata.append('add_ons_5_details',add_ons_5_details);
                        
                        //2023-06-01 start
                        formdata.append('od_start_date',od_start_date);
                        formdata.append('od_end_date',od_end_date);
                        formdata.append('tp_start_date',tp_start_date);
                        formdata.append('tp_end_date',tp_end_date);
                        //2023-06-01 end
                
                $.ajax({
                            type:"POST",
                            url:"check_commission_status",
                            data:formdata,
                            processData:false,  
                            contentType:false,
                            cache:false,
                            dataType:'text',
                            beforeSend:function(){
                                    $("#save_btn").attr("disabled",true);  
                        },
                        success:function(response)
                        {
                            var obj = jQuery.parseJSON(response);
                                    
                            if (obj.status == "success" || obj.status == "success_no_slab") {
                                // 🔹 Create a fresh FormData for the final save call
                                var saveData = new FormData();

                                // Copy all fields from the original formdata
                                for (var pair of formdata.entries()) {
                                    saveData.append(pair[0], pair[1]);
                                }

                                // Add commission_id (even if blank)
                                saveData.append('commission_id', obj.commission_id ? obj.commission_id : '');
                                                        
                                    $.ajax({
                                        type:"POST",
                                        url:"save_generated_policy",
                                        data:saveData,
                                        processData:false,  
                                        contentType:false,
                                        cache:false,
                                        dataType:'text',
                                        beforeSend:function(){
                                        $("#save_btn").attr("disabled",true);  
                                        },
                                        success:function(response)
                                        {
                                            if(response.trim() == "success")
                                            {
                                                $("#save_btn").attr("disabled",false);
                                                    Swal.fire({
                                                    position: 'top-end',
                                                    icon: 'success',
                                                    title: 'Policy Has Been Generated Successfully..',
                                                    showConfirmButton: false,
                                                    timer: 1500
                                                })
                                                window.location.href="generate_policy1";
                                                notification_log(lead_id);
                                            }
                                            else
                                            {
                                                $("#save_btn").attr("disabled",false);
                                                
                                                Swal.fire({
                                                    icon: 'error',
                                                    title: 'Oops...',
                                                    text: ""+response+"",
                                                    footer: '<a href=""></a>'
                                                    })
                                                $("#save_btn").attr("disabled",false);
                                            }
                                        }     
                                    });  
                              }
                              else
                              {
                                    Swal.fire({
                                      icon: 'error',
                                      title: 'Oops...',
                                      text: ""+obj.status+"",
                                      footer: '<a href=""></a>'
                                    })
                                  $("#save_btn").attr("disabled",false); 
                              }
                        }
                });
             }
        });
        
        
        $("#update_btn").click(function(){
            
                var lead_id = $("#lead_id").val();
                var policy_client_ref_no = "";
                var policy_cover_note_no = $("#policy_cover_note_no").val();
                var policy_no  = $("#policy_no").val();
                var policy_s_date = $("#policy_s_date").val();
                var policy_ex_date = $("#policy_ex_date").val();
                var policy_premium = $("#policy_premium").val();
                var policy_terms = $("#policy_terms").val();
                var payment_frequency = $("#payment_frequency").val();
                var next_due_date = $("#next_due_date").val();
                var renewable_flag = $("#renewable_flag").val();
                var add_ons_opted = "";
                var add_ons_not_opt =""; 
                var sum_insured = $("#sum_insured").val();
                var discount_percent = $("#discount_percent").val();
                var no_claim_bonus = $("#no_claim_bonus").val();
                var no_claim_bonus_val = $("#no_claim_bonus_val").val();
                var total_own_damage = $("#total_own_damage").val();
                var tot_add_on_premium = $("#tot_add_on_premium").val();
                var commisson_base_premium = $("#commisson_base_premium").val();
                var basic_tp = $("#basic_tp").val();
                var owner_driver_pa = $("#owner_driver_pa").val();
                var owner_diver_amt = $("#owner_diver_amt").val();
                var no_of_year_own_drv = $("#no_of_year_own_drv").val();
                var fuel_kit = $("#fuel_kit").val();
                var fuel_kit_amt = $("#fuel_kit_amt").val();
                var geograpical = $("#geograpical").val();
                var geograpical_amt = $("#geograpical_amt").val();
                var un_named_passenger_pa = $("#un_named_passenger_pa").val();
                var un_named_passenger_amt = $("#un_named_passenger_amt").val();
                var no_seats_per_person = $("#no_seats_per_person").val();
                var no_seats_per_person_amt = $("#no_seats_per_person_amt").val();
                var llp = $("#llp").val();
                var llp_amt = $("#llp_amt").val();
                var no_drv_emp = $("#no_drv_emp").val();
                var pa_paid_drv = $("#pa_paid_drv").val();
                var pa_paid_drv_amt = $("#pa_paid_drv_amt").val();
                var no_seats_per_person1 = $("#no_seats_per_person1").val();
                var no_seats_per_person_amt1 = $("#no_seats_per_person_amt1").val();
                var tot_liability_premium = $("#tot_liability_premium").val();
                var total_premium = $("#total_premium").val();
                var gst = $("#gst").val();
                var premium_gst = $("#premium_gst").val();
                var policy_issue_date = $("#policy_issue_date").val();
                var policy_agency_pos = $("#policy_agency_pos").val();
                var policy_source = $("#policy_source").val();
                var policy_user = $("#policy_user").val();
                var policy_location =""; //$("#policy_location").val();
                var previous_policy_no = $("#previous_policy_no").val();
                var previous_insurer = $("#previous_insurer").val();
                var previous_insurance_type = $("#previous_insurance_type").val();
                var previous_agency_pos = $("#previous_agency_pos").val();
                var previous_source =""; //$("#previous_source").val();
                var dectable_details = $("#dectable_details").val();
                var policy_additional_info = $("#policy_additional_info").val();
                var reference_no = $("#reference_no").val();
                var other_reference_no = $("#other_reference_no").val();
                var company = $("#company").val();
                var policy_received = "";  
                var policy_verified = "";
                var policy_cancelled = "";
                
                // 2023-05-26 start
                var cpa = "No";
                if($("#cpa").is(":checked") == true)
                {
                   cpa = "Yes";    
                }
             
                var policy_verified_info = $("#policy_verified_info").val();
                var policy_cancelled_info = $("#policy_cancelled_info").val();
                
                var commisson_generation =""; //$("#commisson_generation").val();
                var payment_type = $("#payment_type").val();
                var pay_ref_no = $("#pay_ref_no").val();
                var bank_name = $("#bank_name").val();
                var payment_receipt_no = $("#payment_receipt_no").val();
                var payment_check_date = $("#payment_check_date").val();
                var payment_and_check_no = $("#payment_and_check_no").val();
                var remarks = $("#remarks").val();
                var payment_collected_date = $("#payment_collected_date").val();
                
                var add_ons_1 = $("#add_ons_1").val();
                var add_ons_2 = $("#add_ons_2").val();
                var add_ons_3 = $("#add_ons_3").val();
                var add_ons_4 = $("#add_ons_4").val();
                var add_ons_5 = $("#add_ons_5").val();
                var add_ons_1_details = $("#add_ons_1_details").val();
                var add_ons_2_details = $("#add_ons_2_details").val();
                var add_ons_3_details = $("#add_ons_3_details").val();
                var add_ons_4_details = $("#add_ons_4_details").val();
                var add_ons_5_details = $("#add_ons_5_details").val();
                
                if(class_type == "2")
                {
                    var disease_husband = $("#disease_husband").val();
                    var husband_file = $("#husband_file").val();
                    var disease_wife = $("#disease_wife").val();
                    
                    var wife_file = $("#wife_file").val(); 
                
                
                if(typeof(husband_file) != "undefined" && husband_file !== null)
                {
                    var husband_file = $("#husband_file").prop('files')[0]; 
                }
                else
                {
                    var husband_file = "";
                }
                
                if(typeof(wife_file) != "undefined" && wife_file !== null)
                {
                    var wife_file = $("#wife_file").prop('files')[0]; 
                }
                else
                {
                    var wife_file = "";
                }
                
                var disease_daug_1 = $("#disease_daug_1").val();
                var disease_daug_2 = $("#disease_daug_2").val();
                var disease_daug_3 = $("#disease_daug_3").val();
                var daug_1_file = $("#daug_1_file").val();
                var daug_2_file = $("#daug_2_file").val();
                var daug_3_file = $("#daug_3_file").val();
                
                if(typeof(daug_1_file) != "undefined" && daug_1_file !== null)
                {
                    var daug_1_file = $("#daug_1_file").prop('files')[0]; 
                }
                else
                {
                    var daug_1_file = "";
                }
                
                if(typeof(disease_daug_2) != "undefined" && disease_daug_2 !== null)
                {
                    var daug_2_file = $("#daug_2_file").prop('files')[0]; 
                }
                else
                {
                    var daug_2_file = "";
                }
                
                if(typeof(daug_3_file) != "undefined" && daug_3_file !== null)
                {
                    var daug_3_file = $("#daug_3_file").prop('files')[0]; 
                }
                else
                {
                    var daug_3_file = "";
                }
                
                var disease_son_1 = $("#disease_son_1").val();
                var disease_son_2 = $("#disease_son_2").val();
                var disease_son_3 = $("#disease_son_3").val();
                
                var son_1_file = $("#son_1_file").val();
                var son_2_file = $("#son_2_file").val();
                var son_3_file = $("#son_3_file").val();
                
                
                if(typeof(son_1_file) != "undefined" && son_1_file !== null)
                {
                    var son_1_file = $("#son_1_file").prop('files')[0]; 
                }
                else
                {
                    var son_1_file = "";
                }
                
                
                
                
                if(typeof(son_2_file) != "undefined" && son_2_file !== null)
                {
                    var son_2_file = $("#son_1_file").prop('files')[0]; 
                }
                else
                {
                    var son_2_file = "";
                }
                
                if(typeof(son_3_file) != "undefined" && son_3_file !== null)
                {
                    var son_3_file = $("#son_3_file").prop('files')[0]; 
                }
                else
                {
                    var son_3_file = "";
                }
                
                var disease_father = $("#disease_father").val();
                var disease_mother = $("#disease_mother").val();
                
                var father_file = $("#father_file").val();
                var mother_file = $("#mother_file").val();
                
                
                if(typeof(father_file) != "undefined" && father_file !== null)
                {
                    var father_file = $("#son_3_file").prop('files')[0]; 
                }
                else
                {
                    var father_file = "";
                }
                
                if(typeof(mother_file) != "undefined" && mother_file !== null)
                {
                    var mother_file = $("#son_3_file").prop('files')[0]; 
                }
                else
                {
                    var mother_file = "";
                }
                }
                
                var check = 0;
                
                if(company == "")
                {
                Swal.fire(
                      'Select Insurance Company ?',
                      'That thing is still around?',
                      'question'
                    )
                check = "1";
                }
                else if(class_type == "1" && policy_premium == "")
                {
                Swal.fire(
                      'Select Policy Premium Cover Type ?',
                      'That thing is still around?',
                      'question'
                    )
                check = "1";
                }
                else if(payment_frequency == "")
                {
                Swal.fire(
                      'Select Payment Frequency ?',
                      'That thing is still around?',
                      'question'
                    )
                check = "1";
                }
                else if(policy_s_date == "")
                {
                Swal.fire(
                      'Select Policy Start Date ?',
                      'That thing is still around?',
                      'question'
                    )
                check = "1";
                }
                else if(policy_ex_date == "")
                {
                Swal.fire(
                      'Select Policy Expiry Date ?',
                      'That thing is still around?',
                      'question'
                    )
                check = "1";
                }
                else if(sum_insured == "")
                {
                Swal.fire(
                      'Enter Sum Insured ?',
                      'That thing is still around?',
                      'question'
                    )
                check = "1";
                }
                else if(no_claim_bonus == "")
                {
                Swal.fire(
                      'Select No Claim Bonus Yes / No ?',
                      'That thing is still around?',
                      'question'
                    )
                check = "1";
                }
                else if((policy_premium == "1" || policy_premium == "2") && (basic_tp == "" || basic_tp == "0"))
                {
                Swal.fire(
                      'Enter Basic Tp Amount?',
                      'That thing is still around?',
                      'question'
                    )
                check = "1";
                }
                else if((policy_premium == "1" || policy_premium == "2") && (tot_liability_premium == "" || tot_liability_premium == "0"))
                {
                Swal.fire(
                      'Enter Total Liability Premium?',
                      'That thing is still around?',
                      'question'
                    )
                check = "1";
                }
                else if(total_premium == "" || total_premium == "0")
                {
                Swal.fire(
                      'Enter Total Premium?',
                      'That thing is still around?',
                      'question'
                    )
                check = "1";
                }
                else if(premium_gst == "" || premium_gst == "0")
                {
                    Swal.fire(
                          'Enter Premium With Gst?',
                          'That thing is still around?',
                          'question'
                        )
                    check = "1";
                }
                else if(gst == "" || gst == "0")
                {
                    Swal.fire(
                          'Enter Gst?',
                          'That thing is still around?',
                          'question'
                        )
                    check = "1";
                }
                else if(policy_issue_date == "")
                {
                    Swal.fire(
                          'Enter Policy Issue Date?',
                          'That thing is still around?',
                          'question'
                        )
                    check = "1";
                }
                else if(policy_agency_pos == "")
                {
                    Swal.fire(
                          'Policy Agency/ Pos ?',
                          'That thing is still around?',
                          'question'
                        )
                    check = "1";
                }
                else if(class_type == "2" && Husband_status == "1" && disease_husband == "")
                {
                    if(Applicant_gender == "Male")
                    {
                          Swal.fire(
                              'Select Applicatant Pre-existing Disease ?',
                              'That thing is still around?',
                              'question'
                            )
                    }
                    else
                    {
                          Swal.fire(
                              'Select Husband Pre-existing Disease ?',
                              'That thing is still around?',
                              'question'
                            )
                    }
                    check = "1";
                }
                else if(class_type == "2" && Wife_status == "1" && disease_wife == "")
                {
                    if(Applicant_gender == "Male")
                    {
                        Swal.fire(
                              'Select Wife Pre-existing Disease ?',
                              'That thing is still around?',
                              'question'
                            )
                    }
                    else
                    {
                           Swal.fire(
                              'Select Applicatant Pre-existing Disease ?',
                              'That thing is still around?',
                              'question'
                            )
                    }
                    check = "1";
                    }
                else if(class_type == "2" && Daughter_1_status == "1" && disease_daug_1 == "")
                {
                          Swal.fire(
                              'Select Daughter 1 Pre-existing Disease ?',
                              'That thing is still around?',
                              'question'
                            )
                    check = "1";
                }
                else if(class_type == "2" && Daughter_2_status == "1" && disease_daug_2 == "")
                {
                          Swal.fire(
                              'Select Daughter 2 Pre-existing Disease ?',
                              'That thing is still around?',
                              'question'
                            )
                    check = "1";
                }
                else if(class_type == "2" && Daughter_3_status == "1" && disease_daug_3 == "")
                {
                      Swal.fire(
                          'Select Daughter 3 Pre-existing Disease ?',
                          'That thing is still around?',
                          'question'
                        )
                check = "1";
                }
                else if(class_type == "2" && Son_1_status == "1" && disease_son_1 == "")
                {
                      Swal.fire(
                          'Select Son 1 Pre-existing Disease ?',
                          'That thing is still around?',
                          'question'
                        )
                check = "1";
                }
                else if(class_type == "2" && Son_2_status == "1" && disease_son_2 == "")
                {
                      Swal.fire(
                          'Select Son 2 Pre-existing Disease ?',
                          'That thing is still around?',
                          'question'
                        )
                check = "1";
                }
                else if(class_type == "2" && Son_3_status == "1" && disease_son_3 == "")
                {
                      Swal.fire(
                          'Select Son 3 Pre-existing Disease ?',
                          'That thing is still around?',
                          'question'
                        )
                check = "1";
                }
                else if(class_type == "2" && Father_status == "1" && disease_father == "")
                {
                      Swal.fire(
                          'Select Father Pre-existing Disease ?',
                          'That thing is still around?',
                          'question'
                        )
                check = "1";
                }
                else if(class_type == "2" && Mother_status == "1" && disease_mother == "")
                {
                      Swal.fire(
                          'Select Mother Pre-existing Disease ?',
                          'That thing is still around?',
                          'question'
                        )
                check = "1";
                }
                else if(class_type == "2" && Husband_status == "1" && disease_husband == "Yes" && husband_file == undefined)
                {
                if(Applicant_gender == "Male")
                {
                      Swal.fire(
                          'Upload Applicant Declaration Form ?',
                          'That thing is still around?',
                          'question'
                        )
                }
                else
                {
                      Swal.fire(
                          'Upload Husband Declaration Form ?',
                          'That thing is still around?',
                          'question'
                        )
                }
                check = "1";
                }
                else if((class_type == "2" && Wife_status == "1" && disease_wife == "Yes") && (wife_file == "" || wife_file == undefined))
                {
                if(Applicant_gender == "Female")
                {
                      Swal.fire(
                          'Upload Applicatant Declaration Form ?',
                          'That thing is still around?',
                          'question'
                        )
                }
                else
                {
                      Swal.fire(
                          'Upload Wife Declaration Form ?',
                          'That thing is still around?',
                          'question'
                        )
                }
                check = "1";
                }
                else if((class_type == "2" && Daughter_1_status == "1" && disease_daug_1 == "Yes") && (daug_1_file == "" || daug_1_file == undefined))
                {
                      Swal.fire(
                          'Upload Daughter 1 Declaration Form ?',
                          'That thing is still around?',
                          'question'
                        )
                check = "1";
                }
                else if((class_type == "2" && Daughter_2_status == "1" && disease_daug_2 == "Yes") && (daug_2_file == "" || daug_2_file ==undefined))
                {
                      Swal.fire(
                          'Upload Daughter 2 Declaration Form ?',
                          'That thing is still around?',
                          'question'
                        )
                check = "1";
                }
                else if((class_type == "2" && Daughter_3_status == "1" && disease_daug_3 == "Yes") && (daug_3_file == "" && daug_3_file == undefined))
                {
                      Swal.fire(
                          'Upload Daughter 3 Declaration Form ?',
                          'That thing is still around?',
                          'question'
                        )
                check = "1";
                }
                else if((class_type == "2" && Son_1_status == "1" && disease_son_1 == "Yes") && (son_1_file == "" || son_1_file == undefined))
                {
                      Swal.fire(
                          'Upload Son 1 Declaration Form ?',
                          'That thing is still around?',
                          'question'
                        )
                check = "1";
                }
                else if((class_type == "2" && Son_2_status == "1" && disease_son_2 == "Yes") && (son_2_file == "" || son_2_file == undefined))
                {
                      Swal.fire(
                          'Upload Son 2 Declaration Form ?',
                          'That thing is still around?',
                          'question'
                        )
                check = "1";
                }
                else if((class_type == "2" && Son_3_status == "1" && disease_son_3 == "Yes") && (son_3_file == "" || son_3_file == undefined))
                {
                      Swal.fire(
                          'Upload Son 3 Declaration Form ?',
                          'That thing is still around?',
                          'question'
                        )
                check = "1";
                }
                else if((class_type == "2" && Father_status == "1" && disease_father == "Yes") && (father_file == "" || father_file == undefined))
                {
                      Swal.fire(
                          'Upload Father Declaration Form ?',
                          'That thing is still around?',
                          'question'
                        )
                check = "1";
                }
                else if((class_type == "2" && Mother_status == "1" && disease_mother == "Yes") && (mother_file == "" || father_file == undefined))
                {
                      Swal.fire(
                          'Upload Mother Declaration Form ?',
                          'That thing is still around?',
                          'question'
                        )
                check = "1";
                }
                else if(v_status == "0" && class_type == "1")
                {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Oops...',
                            text: 'Add vechicle Details Before Save The Policy!',
                            footer: ''
                        })
                }
                else if(h_status == "0" && class_type == "2")
                {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Oops...',
                            text: 'Add Health Details Before Save The Policy!',
                            footer: ''
                        })
                }
                else 
                {
                    var formdata = new FormData();
                    formdata.append('lead_id',lead_id);
                    formdata.append('policy_client_ref_no',policy_client_ref_no);
                    formdata.append('policy_cover_note_no',policy_cover_note_no);
                    formdata.append('policy_no',policy_no);
                    formdata.append('policy_s_date',policy_s_date);
                    formdata.append('policy_ex_date',policy_ex_date);
                    formdata.append('policy_premium',policy_premium);
                    formdata.append('policy_terms',policy_terms);
                    formdata.append('payment_frequency',payment_frequency);
                    formdata.append('next_due_date',next_due_date);
                    formdata.append('renewable_flag',renewable_flag);
                    formdata.append('add_ons_opted',add_ons_opted);
                    formdata.append('add_ons_not_opt',add_ons_not_opt);
                    formdata.append('sum_insured',sum_insured);
                    formdata.append('discount_percent',discount_percent);
                    formdata.append('no_claim_bonus',no_claim_bonus);
                    formdata.append('no_claim_bonus_val',no_claim_bonus_val);
                    formdata.append('total_own_damage',total_own_damage);
                    formdata.append('tot_add_on_premium',tot_add_on_premium);
                    formdata.append('commisson_base_premium',commisson_base_premium);
                    formdata.append('basic_tp',basic_tp);
                    formdata.append('owner_driver_pa',owner_driver_pa);
                    formdata.append('owner_diver_amt',owner_diver_amt);
                    formdata.append('no_of_year_own_drv',no_of_year_own_drv);
                    formdata.append('fuel_kit',fuel_kit);
                    formdata.append('fuel_kit_amt',fuel_kit_amt);
                    formdata.append('geograpical',geograpical);
                    formdata.append('geograpical_amt',geograpical_amt);
                    formdata.append('un_named_passenger_pa',un_named_passenger_pa);
                    formdata.append('un_named_passenger_amt',un_named_passenger_amt);
                    formdata.append('no_seats_per_person',no_seats_per_person);
                    formdata.append('no_seats_per_person_amt',no_seats_per_person_amt);
                    formdata.append('company',company);
                    formdata.append('llp',llp);
                    formdata.append('llp_amt',llp_amt);
                    formdata.append('no_drv_emp',no_drv_emp);
                    formdata.append('pa_paid_drv',pa_paid_drv);
                    formdata.append('pa_paid_drv_amt',pa_paid_drv_amt);
                    formdata.append('no_seats_per_person1',no_seats_per_person1);
                    formdata.append('no_seats_per_person_amt1',no_seats_per_person_amt1);
                    formdata.append('tot_liability_premium',tot_liability_premium);
                    formdata.append('total_premium',total_premium);
                    formdata.append('gst',gst);
                    formdata.append('premium_gst',premium_gst);
                    formdata.append('policy_issue_date',policy_issue_date);
                    formdata.append('policy_agency_pos',policy_agency_pos);
                    formdata.append('policy_source',policy_source);
                    formdata.append('policy_user',policy_user);
                    formdata.append('policy_location',policy_location);
                    formdata.append('previous_policy_no',previous_policy_no);
                    formdata.append('previous_insurer',previous_insurer);
                    formdata.append('previous_insurance_type',previous_insurance_type);
                    formdata.append('previous_agency_pos',previous_agency_pos);
                    formdata.append('previous_source',previous_source);
                    formdata.append('dectable_details',dectable_details);
                    formdata.append('policy_additional_info',policy_additional_info);
                    formdata.append('reference_no',reference_no);
                    formdata.append('other_reference_no',other_reference_no);
                    formdata.append('policy_received',policy_received);
                    formdata.append('policy_verified',policy_verified);
                    formdata.append('policy_verified_info',policy_verified_info);
                    formdata.append('policy_cancelled',policy_cancelled);
                    formdata.append('policy_cancelled_info',policy_cancelled_info);
                    formdata.append('commisson_generation',commisson_generation);
                    formdata.append('payment_type',payment_type);
                    formdata.append('pay_ref_no',pay_ref_no);
                    formdata.append('bank_name',bank_name);
                    formdata.append('payment_receipt_no',payment_receipt_no);
                    formdata.append('payment_check_date',payment_check_date);
                    formdata.append('payment_and_check_no',payment_and_check_no);
                    formdata.append('remarks',remarks);
                    formdata.append('payment_collected_date',payment_collected_date);
                    
                    //2023-05-26 start
                    formdata.append('cpa',cpa);
                    
                    if(class_type == "1") {
                        // 2023-06-01 start
                        var od_start_date, od_end_date, tp_start_date, tp_end_date;
                        od_start_date = ($('.odst').length > 0) ? $('#od_start_date').val() : "";
                        od_end_date   = ($('.oded').length > 0) ? $('#od_end_date').val() : "";
                        tp_start_date = ($('.tpst').length > 0) ? $('#tp_start_date').val() : "";
                        tp_end_date   = ($('.tped').length > 0) ? $('#tp_end_date').val() : "";
                        // 2023-06-01 end
                        
                        // 2023-06-08
                        applied_splcom = ($('.splcom_container').length > 0) ? $('#is_splcommisson').val() : "";
                        
                        //2023-06-01 start
                        formdata.append('od_start_date',od_start_date);
                        formdata.append('od_end_date',od_end_date);
                        formdata.append('tp_start_date',tp_start_date);
                        formdata.append('tp_end_date',tp_end_date);
                        //2023-06-01 end
                        
                        // 2023-06-08
                        formdata.append('applied_splcom', applied_splcom);
                    }
                    if(class_type == "2")
                    {
                            formdata.append('disease_husband',disease_husband);
                            formdata.append('husband_file',husband_file);
                            formdata.append('disease_wife',disease_husband);
                            formdata.append('wife_file',husband_file);
                            formdata.append('disease_daug_1',disease_daug_1);
                            formdata.append('disease_daug_2',disease_daug_2);
                            formdata.append('disease_daug_3',disease_daug_3);
                            formdata.append('daug_1_file',daug_1_file);
                            formdata.append('daug_2_file',daug_2_file);
                            formdata.append('daug_3_file',daug_3_file);
                            formdata.append('disease_son_1',disease_son_1);
                            formdata.append('disease_son_2',disease_son_2);
                            formdata.append('disease_son_3',disease_son_3);
                            formdata.append('son_1_file',son_1_file);
                            formdata.append('son_2_file',son_2_file);
                            formdata.append('son_3_file',son_3_file);
                            formdata.append('disease_father',disease_father);
                            formdata.append('disease_mother',disease_mother);
                            formdata.append('father_file',father_file);
                            formdata.append('mother_file',mother_file);
                    }
                
                        formdata.append('add_ons_1',add_ons_1);
                        formdata.append('add_ons_2',add_ons_2);
                        formdata.append('add_ons_3',add_ons_3);
                        formdata.append('add_ons_4',add_ons_4);
                        formdata.append('add_ons_5',add_ons_5);
                      
                        
                        formdata.append('add_ons_1_details',add_ons_1_details);
                        formdata.append('add_ons_2_details',add_ons_2_details);
                        formdata.append('add_ons_3_details',add_ons_3_details);
                        formdata.append('add_ons_4_details',add_ons_4_details);
                        formdata.append('add_ons_5_details',add_ons_5_details);
                
                         $.ajax({
                                    type:"POST",
                                    url:"update_generated_policy",
                                    data:formdata,
                                    processData:false,  
                                    contentType:false,
                                    cache:false,
                                    dataType:'text',
                                    beforeSend:function(){
                                      $("#update_btn").attr("disabled",true);  
                                    },
                                    success:function(response)
                                    {
                                        $("#update_btn").attr("disabled",false);
                                            Swal.fire({
                                            position: 'top-end',
                                            icon: 'success',
                                            title: 'Policy Has Been Updated  Successfully..',
                                            showConfirmButton: false,
                                            timer: 1500
                                            })
                                            //window.location.href="generate_policy1";
                                            notification_log(lead_id);
                                    }     
                                }); 
             }
        });
        
        $("#total_own_damage").keyup(function(){
         
          var total_own_damage = $("#total_own_damage").val();
          var tot_add_on_premium = $("#tot_add_on_premium").val();
           
            if(total_own_damage !="" && tot_add_on_premium !="")
            {
               var commission = parseInt(total_own_damage) + parseInt(tot_add_on_premium);
               $("#commisson_base_premium").val(commission);
               
            }
            else if(total_own_damage != "" && tot_add_on_premium == "")
            {
                var commission = parseInt(total_own_damage) + parseInt(0);
                 $("#commisson_base_premium").val(commission);
            }
            else if(total_own_damage == "" && tot_add_on_premium != "")
            {
                 var commission = parseInt(0) + parseInt(tot_add_on_premium);
                  $("#commisson_base_premium").val(commission);
            }
            else
            {
                var commission = 0;
                 $("#commisson_base_premium").val(commission);
            }
        }); 
     
        $("#policy_no").keyup(function(){
                  myText = $("#policy_no").val();
                  var remove_space = myText.replace(/ /g,'');
                 $("#policy_no").val(remove_space);
        });
        
        $("#policy_no").change(function(){
            var policy_no = $("#policy_no").val();
            $.ajax({
                       url : "check_policy_no_already_exits",
                       method : "POST",
                       data : {policy_no:policy_no},
                       success:function(response)
                       {
                           if(response == "This Policy No Already Exits")
                           {
                              $("#save_btn").attr("disabled",true);
                              
                                Swal.fire({
                                  icon: 'error',
                                  title: 'Oops...',
                                  text: ""+response+"",
                                  footer: ''
                                })
                           }
                           else
                           {
                               $("#save_btn").attr("disabled",false);
                           }
                       }
            });
            
             
        });
     
        $("#tot_add_on_premium").keyup(function(){
           
          var total_own_damage = $("#total_own_damage").val();
          var tot_add_on_premium = $("#tot_add_on_premium").val();
        
           if(total_own_damage !="" && tot_add_on_premium !="")
            {
               var commission = parseInt(total_own_damage) + parseInt(tot_add_on_premium);
               $("#commisson_base_premium").val(commission);
               
            }
            else if(total_own_damage != "" && tot_add_on_premium == "")
            {
                var commission = parseInt(total_own_damage) + parseInt(0);
                 $("#commisson_base_premium").val(commission);
            }
            else if(total_own_damage == "" && tot_add_on_premium != "")
            {
                 var commission = parseInt(0) + parseInt(tot_add_on_premium);
                  $("#commisson_base_premium").val(commission);
            }
            else
            {
                var commission = 0;
                 $("#commisson_base_premium").val(commission);
            }
            
        });
      
        $("#document_file").change(function(){
            upload_documents();
        });
       
        $("#document_type").change(function(){
            upload_documents();
        });
       
        $("#email_btn").click(function(){
            var lead_id = $("#lead_id").val();
            $.ajax({
                   url : "get_receiver_email_id",
                   method : "POST",
                   data : {id:lead_id},
                   success:function(response)
                   {
                       var obj = jQuery.parseJSON(response);
                       $("#receiver_email_id").val(obj.email);
                       class_type = obj.class;
                       $("#email_modal").modal("toggle");
                   }
            });
        });
        
        $("#template_id").change(function(){
            var template_id = $("#template_id").val();
             var lead_id = $("#lead_id").val();
            $.ajax({
                   url : "fetch_email_content",
                   method : "POST",
                   data : {template_id:template_id,lead_id:lead_id},
                   success:function(response)
                   {
                       var obj = jQuery.parseJSON(response);
                       
                       if(class_type == "1")
                       {
                           var category = "Motor";
                           class_type = "1";
                       }
                       else if(class_type == "2")
                       {
                           var category = "Health";
                           class_type = "2";
                       }
                       else if(class_type == "3")
                       {
                           var category = "Travel";
                           class_type = "3";
                       }
                      
                       $("#email_subject").val("Policy Document Of Your "+category+" Insurance Policy No "+obj["data"].policy_no);
                       CKEDITOR.instances['email_message'].setData(obj["res"].Message);
                   }
            });
            
        });
     
        $("#upload_file").click(function(){
          var lead_id = $("#lead_id").val();
          $.ajax({
                  url : "get_uploaded_documents",
                  method : "POST",
                  data : {lead_id:lead_id},
                  success:function(response)
                  {
                       $("#upload_doc_modal").modal("show");
                      $("#doc_files").html(response);
                  }
          });
        });
       
        $("#check_all").click(function(){

           if($('#check_all').is(':checked'))
           {
               $(".check_file").prop('checked', true);
           }
           else
           {
                $(".check_file").prop('checked', false);
           }
        });
       
        $("#add_doc").click(function(){
          var document_files = $(".check_file").val();
            $("#upload_doc_modal").modal("hide");
            
            $(':checkbox:checked').each(function(i){
                     arr[i] = $(this).val();
            });
            
            for(var i=0;i<arr.length;i++)
            {
                $("#documents_view").append("<span><i class='fa fa-paperclip'>&nbsp;&nbsp;"+arr[i]+"</i></span>&nbsp;&nbsp;");
            }
            
              $(".check_file").prop('checked', false);
            $('#check_all').prop('checked', false);
            $("#email_modal").modal("show");
            
        });
       
        $("#submit_btn").click(function(){
            var lead_id = $("#lead_id").val();
            var sender_email_id = $("#sender_email_id").val();
            var sender_name = $("#sender_name").val();
            var receiver_email_id = $("#receiver_email_id").val();
            var subject = $("#email_subject").val();
            var content = CKEDITOR.instances['email_message'].getData();
            
            // var formdata = new FormData();
            // formdata.append('sender_email_id',sender_email_id);
            // formdata.append('sender_name',sender_name);
            // formdata.append('receiver_email_id',receiver_email_id);
            // formdata.append('email_subject',email_subject);
            //formdata.append('email_message',email_message);
            //formdata.append('arr',arr);
         
         $.ajax({
                 url : "send_mail",
                 method : "POST",
                  data :{
                      lead_id : lead_id,
                      sender_email_id:sender_email_id,
                      sender_name:sender_name,
                      receiver_email_id:receiver_email_id,
                      content:content,
                      arr:arr,
                      subject:subject,
                  },
                   beforeSend:function(){
                   $("#submit_btn").attr("disabled",true);  
                 },
                 success:function(response)
                 {
                      $("#submit_btn").attr("disabled",false);  
                      Swal.fire('Mail Sent SuccessFully')
                      $("#sender_email_id").val("");
                      $("#sender_name").val("");
                      $("#receiver_email_id").val("");
                      $("#email_subject").val("");
                      $("#email_modal").modal("toggle");
                      notification_log(lead_id)
                 }
            });
        });
        
        $("#commisson_base_premium").keyup(function(){
             calculate();
        });
        
        $("#temp_save_btn").click(function(){
            var lead_id = $("#lead_id").val();
            var policy_client_ref_no = "";
            var policy_cover_note_no = $("#policy_cover_note_no").val();
            var policy_no  = $("#policy_no").val();
            var policy_s_date = $("#policy_s_date").val();
            var policy_ex_date = $("#policy_ex_date").val();
            var policy_premium = $("#policy_premium").val();
            var policy_terms = $("#policy_terms").val();
            var payment_frequency = $("#payment_frequency").val();
            var next_due_date = $("#next_due_date").val();
            var renewable_flag = $("#renewable_flag").val();
            var add_ons_opted = "";
            var add_ons_not_opt ="";
            var sum_insured = $("#sum_insured").val();
            var discount_percent = $("#discount_percent").val();
            var no_claim_bonus = $("#no_claim_bonus").val();
            var no_claim_bonus_val = $("#no_claim_bonus_val").val();
            var total_own_damage = $("#total_own_damage").val();
            var tot_add_on_premium = $("#tot_add_on_premium").val();
            var commisson_base_premium = $("#commisson_base_premium").val();
            var basic_tp = $("#basic_tp").val();
            var owner_driver_pa = $("#owner_driver_pa").val();
            var owner_diver_amt = $("#owner_diver_amt").val();
            var no_of_year_own_drv = $("#no_of_year_own_drv").val();
            var fuel_kit = $("#fuel_kit").val();
            var fuel_kit_amt = $("#fuel_kit_amt").val();
            var geograpical = $("#geograpical").val();
            var geograpical_amt = $("#geograpical_amt").val();
            var un_named_passenger_pa = $("#un_named_passenger_pa").val();
            var un_named_passenger_amt = $("#un_named_passenger_amt").val();
            var no_seats_per_person = $("#no_seats_per_person").val();
            var no_seats_per_person_amt = $("#no_seats_per_person_amt").val();
            var llp = $("#llp").val();
            var llp_amt = $("#llp_amt").val();
            var no_drv_emp = $("#no_drv_emp").val();
            var pa_paid_drv = $("#pa_paid_drv").val();
            var pa_paid_drv_amt = $("#pa_paid_drv_amt").val();
            var no_seats_per_person1 = $("#no_seats_per_person1").val();
            var no_seats_per_person_amt1 = $("#no_seats_per_person_amt1").val();
            var tot_liability_premium = $("#tot_liability_premium").val();
            var total_premium = $("#total_premium").val();
            var gst = $("#gst").val();
            var premium_gst = $("#premium_gst").val();
            var policy_issue_date = $("#policy_issue_date").val();
            var policy_agency_pos = $("#policy_agency_pos").val();
            var policy_source = $("#policy_source").val();
            var policy_user = $("#policy_user").val();
            var policy_location =""; //$("#policy_location").val();
            var previous_policy_no = $("#previous_policy_no").val();
            var previous_insurer = $("#previous_insurer").val();
            var previous_insurance_type = $("#previous_insurance_type").val();
            var previous_agency_pos = $("#previous_agency_pos").val();
            var previous_source =""; //$("#previous_source").val();
            var dectable_details = $("#dectable_details").val();
            var policy_additional_info = $("#policy_additional_info").val();
            var reference_no = $("#reference_no").val();
            var other_reference_no = $("#other_reference_no").val();
            var company = $("#company").val();
            var policy_received = "";  
            var policy_verified = "";
            var policy_cancelled = "";
            var policy_verified_info = $("#policy_verified_info").val();
            var policy_cancelled_info = $("#policy_cancelled_info").val();
            var commisson_generation =""; 
            var payment_type = $("#payment_type").val();
            var pay_ref_no = $("#pay_ref_no").val();
            var bank_name = $("#bank_name").val();
            var payment_receipt_no = $("#payment_receipt_no").val();
            var payment_check_date = $("#payment_check_date").val();
            var payment_and_check_no = $("#payment_and_check_no").val();
            var remarks = $("#remarks").val();
            var payment_collected_date = $("#payment_collected_date").val();
            var edit_id = $("#edit_id").val();
            
            if($("#cpa").is(":checked") == true)
            {
               var cpa = "Yes";    
            }
            else
            {
                var cpa = "No";
            }
            
            if(class_type == "2")
            {
                    
                var disease_husband = $("#disease_husband").val();
                var husband_file = $("#husband_file").val();
                var disease_wife = $("#disease_wife").val();
                var wife_file = $("#wife_file").val(); 
                
                if(typeof(husband_file) != "undefined" && husband_file !== null)
                {
                    var husband_file = $("#husband_file").prop('files')[0]; 
                }
                else
                {
                    var husband_file = "";
                }
                
                if(typeof(wife_file) != "undefined" && wife_file !== null)
                {
                    var wife_file = $("#wife_file").prop('files')[0]; 
                }
                else
                {
                    var wife_file = "";
                }
                
                var disease_daug_1 = $("#disease_daug_1").val();
                var disease_daug_2 = $("#disease_daug_2").val();
                var disease_daug_3 = $("#disease_daug_3").val();
                var daug_1_file = $("#daug_1_file").val();
                var daug_2_file = $("#daug_2_file").val();
                var daug_3_file = $("#daug_3_file").val();
                
                if(typeof(daug_1_file) != "undefined" && daug_1_file !== null)
                {
                    var daug_1_file = $("#daug_1_file").prop('files')[0]; 
                }
                else
                {
                    var daug_1_file = "";
                }
                
                if(typeof(disease_daug_2) != "undefined" && disease_daug_2 !== null)
                {
                    var daug_2_file = $("#daug_2_file").prop('files')[0]; 
                }
                else
                {
                    var daug_2_file = "";
                }
                
                if(typeof(daug_3_file) != "undefined" && daug_3_file !== null)
                {
                    var daug_3_file = $("#daug_3_file").prop('files')[0]; 
                }
                else
                {
                    var daug_3_file = "";
                }
                
                var disease_son_1 = $("#disease_son_1").val();
                var disease_son_2 = $("#disease_son_2").val();
                var disease_son_3 = $("#disease_son_3").val();
                
                var son_1_file = $("#son_1_file").val();
                var son_2_file = $("#son_2_file").val();
                var son_3_file = $("#son_3_file").val();
                
                
                if(typeof(son_1_file) != "undefined" && son_1_file !== null)
                {
                    var son_1_file = $("#son_1_file").prop('files')[0]; 
                }
                else
                {
                    var son_1_file = "";
                }
                
                if(typeof(son_2_file) != "undefined" && son_2_file !== null)
                {
                    var son_2_file = $("#son_1_file").prop('files')[0]; 
                }
                else
                {
                    var son_2_file = "";
                }
                
                if(typeof(son_3_file) != "undefined" && son_3_file !== null)
                {
                    var son_3_file = $("#son_3_file").prop('files')[0]; 
                }
                else
                {
                    var son_3_file = "";
                }
                
                var disease_father = $("#disease_father").val();
                var disease_mother = $("#disease_mother").val();
                
                var father_file = $("#father_file").val();
                var mother_file = $("#mother_file").val();
                
                
                if(typeof(father_file) != "undefined" && father_file !== null)
                {
                    var father_file = $("#son_3_file").prop('files')[0]; 
                }
                else
                {
                    var father_file = "";
                }
                
                if(typeof(mother_file) != "undefined" && mother_file !== null)
                {
                    var mother_file = $("#son_3_file").prop('files')[0]; 
                }
                else
                {
                    var mother_file = "";
                }
                }
                // 2023-06-01 start
                var od_start_date, od_end_date, tp_start_date, tp_end_date;
                od_start_date = ($('.odst').length > 0) ? $('#od_start_date').val() : "";
                od_end_date   = ($('.oded').length > 0) ? $('#od_end_date').val() : "";
                tp_start_date = ($('.tpst').length > 0) ? $('#tp_start_date').val() : "";
                tp_end_date   = ($('.tped').length > 0) ? $('#tp_end_date').val() : "";
                // 2023-06-01 end
                var check = 0;
                
                if(company == "")
                {
                Swal.fire(
                      'Select Insurance Company ?',
                      'That thing is still around?',
                      'question'
                    )
                check = "1";
                }
                else if(class_type == "1" && policy_premium == "")
                {
                Swal.fire(
                      'Select Policy Premium Cover Type ?',
                      'That thing is still around?',
                      'question'
                    )
                check = "1";
                }
                else if(payment_frequency == "")
                {
                Swal.fire(
                      'Select Payment Frequency ?',
                      'That thing is still around?',
                      'question'
                    )
                check = "1";
                }
                else if(policy_s_date == "")
                {
                Swal.fire(
                      'Select Policy Start Date ?',
                      'That thing is still around?',
                      'question'
                    )
                check = "1";
                }
                else if(policy_ex_date == "")
                {
                Swal.fire(
                      'Select Policy Expiry Date ?',
                      'That thing is still around?',
                      'question'
                    )
                check = "1";
                }
                else if(sum_insured == "")
                {
                Swal.fire(
                      'Enter Sum Insured ?',
                      'That thing is still around?',
                      'question'
                    )
                check = "1";
                }
                else if(no_claim_bonus == "")
                {
                Swal.fire(
                      'Select No Claim Bonus Yes / No ?',
                      'That thing is still around?',
                      'question'
                    )
                check = "1";
                }
                else if((policy_premium == "1" || policy_premium == "2") && (basic_tp == "" || basic_tp == "0"))
                {
                Swal.fire(
                      'Enter Basic Tp Amount?',
                      'That thing is still around?',
                      'question'
                    )
                check = "1";
                }
                else if((policy_premium == "1" || policy_premium == "2") && (tot_liability_premium == "" || tot_liability_premium == "0"))
                {
                Swal.fire(
                      'Enter Total Liability Premium?',
                      'That thing is still around?',
                      'question'
                    )
                check = "1";
                }
                else if(total_premium == "" || total_premium == "0")
                {
                Swal.fire(
                      'Enter Total Premium?',
                      'That thing is still around?',
                      'question'
                    )
                check = "1";
                }
                else if(premium_gst == "" || premium_gst == "0")
                {
                    Swal.fire(
                          'Enter Premium With Gst?',
                          'That thing is still around?',
                          'question'
                        )
                    check = "1";
                }
                else if(gst == "" || gst == "0")
                {
                    Swal.fire(
                          'Enter Gst?',
                          'That thing is still around?',
                          'question'
                        )
                    check = "1";
                }
                else if(policy_issue_date == "")
                {
                    Swal.fire(
                          'Enter Policy Issue Date?',
                          'That thing is still around?',
                          'question'
                        )
                    check = "1";
                }
                else if(policy_agency_pos == "")
                {
                    Swal.fire(
                          'Policy Agency/ Pos ?',
                          'That thing is still around?',
                          'question'
                        )
                    check = "1";
                }
                else if(class_type == "2" && Husband_status == "1" && disease_husband == "")
                {
                    if(Applicant_gender == "Male")
                    {
                          Swal.fire(
                              'Select Applicatant Pre-existing Disease ?',
                              'That thing is still around?',
                              'question'
                            )
                    }
                    else
                    {
                          Swal.fire(
                              'Select Husband Pre-existing Disease ?',
                              'That thing is still around?',
                              'question'
                            )
                    }
                    check = "1";
                }
                else if(class_type == "2" && Wife_status == "1" && disease_wife == "")
                {
                    if(Applicant_gender == "Male")
                    {
                        Swal.fire(
                              'Select Wife Pre-existing Disease ?',
                              'That thing is still around?',
                              'question'
                            )
                    }
                    else
                    {
                           Swal.fire(
                              'Select Applicatant Pre-existing Disease ?',
                              'That thing is still around?',
                              'question'
                            )
                    }
                    check = "1";
                    }
                else if(class_type == "2" && Daughter_1_status == "1" && disease_daug_1 == "")
                {
                          Swal.fire(
                              'Select Daughter 1 Pre-existing Disease ?',
                              'That thing is still around?',
                              'question'
                            )
                    check = "1";
                }
                else if(class_type == "2" && Daughter_2_status == "1" && disease_daug_2 == "")
                {
                          Swal.fire(
                              'Select Daughter 2 Pre-existing Disease ?',
                              'That thing is still around?',
                              'question'
                            )
                    check = "1";
                }
                else if(class_type == "2" && Daughter_3_status == "1" && disease_daug_3 == "")
                {
                      Swal.fire(
                          'Select Daughter 3 Pre-existing Disease ?',
                          'That thing is still around?',
                          'question'
                        )
                check = "1";
                }
                else if(class_type == "2" && Son_1_status == "1" && disease_son_1 == "")
                {
                      Swal.fire(
                          'Select Son 1 Pre-existing Disease ?',
                          'That thing is still around?',
                          'question'
                        )
                check = "1";
                }
                else if(class_type == "2" && Son_2_status == "1" && disease_son_2 == "")
                {
                      Swal.fire(
                          'Select Son 2 Pre-existing Disease ?',
                          'That thing is still around?',
                          'question'
                        )
                check = "1";
                }
                else if(class_type == "2" && Son_3_status == "1" && disease_son_3 == "")
                {
                      Swal.fire(
                          'Select Son 3 Pre-existing Disease ?',
                          'That thing is still around?',
                          'question'
                        )
                check = "1";
                }
                else if(class_type == "2" && Father_status == "1" && disease_father == "")
                {
                      Swal.fire(
                          'Select Father Pre-existing Disease ?',
                          'That thing is still around?',
                          'question'
                        )
                check = "1";
                }
                else if(class_type == "2" && Mother_status == "1" && disease_mother == "")
                {
                      Swal.fire(
                          'Select Mother Pre-existing Disease ?',
                          'That thing is still around?',
                          'question'
                        )
                check = "1";
                }
                else if(class_type == "2" && Husband_status == "1" && disease_husband == "Yes" && husband_file == undefined)
                {
                if(Applicant_gender == "Male")
                {
                      Swal.fire(
                          'Upload Applicant Declaration Form ?',
                          'That thing is still around?',
                          'question'
                        )
                }
                else
                {
                      Swal.fire(
                          'Upload Husband Declaration Form ?',
                          'That thing is still around?',
                          'question'
                        )
                }
                check = "1";
                }
                else if((class_type == "2" && Wife_status == "1" && disease_wife == "Yes") && (wife_file == "" || wife_file == undefined))
                {
                if(Applicant_gender == "Female")
                {
                      Swal.fire(
                          'Upload Applicatant Declaration Form ?',
                          'That thing is still around?',
                          'question'
                        )
                }
                else
                {
                      Swal.fire(
                          'Upload Wife Declaration Form ?',
                          'That thing is still around?',
                          'question'
                        )
                }
                check = "1";
                }
                else if((class_type == "2" && Daughter_1_status == "1" && disease_daug_1 == "Yes") && (daug_1_file == "" || daug_1_file == undefined))
                {
                      Swal.fire(
                          'Upload Daughter 1 Declaration Form ?',
                          'That thing is still around?',
                          'question'
                        )
                check = "1";
                }
                else if((class_type == "2" && Daughter_2_status == "1" && disease_daug_2 == "Yes") && (daug_2_file == "" || daug_2_file ==undefined))
                {
                      Swal.fire(
                          'Upload Daughter 2 Declaration Form ?',
                          'That thing is still around?',
                          'question'
                        )
                check = "1";
                }
                else if((class_type == "2" && Daughter_3_status == "1" && disease_daug_3 == "Yes") && (daug_3_file == "" && daug_3_file == undefined))
                {
                      Swal.fire(
                          'Upload Daughter 3 Declaration Form ?',
                          'That thing is still around?',
                          'question'
                        )
                check = "1";
                }
                else if((class_type == "2" && Son_1_status == "1" && disease_son_1 == "Yes") && (son_1_file == "" || son_1_file == undefined))
                {
                      Swal.fire(
                          'Upload Son 1 Declaration Form ?',
                          'That thing is still around?',
                          'question'
                        )
                check = "1";
                }
                else if((class_type == "2" && Son_2_status == "1" && disease_son_2 == "Yes") && (son_2_file == "" || son_2_file == undefined))
                {
                      Swal.fire(
                          'Upload Son 2 Declaration Form ?',
                          'That thing is still around?',
                          'question'
                        )
                check = "1";
                }
                else if((class_type == "2" && Son_3_status == "1" && disease_son_3 == "Yes") && (son_3_file == "" || son_3_file == undefined))
                {
                      Swal.fire(
                          'Upload Son 3 Declaration Form ?',
                          'That thing is still around?',
                          'question'
                        )
                check = "1";
                }
                else if((class_type == "2" && Father_status == "1" && disease_father == "Yes") && (father_file == "" || father_file == undefined))
                {
                      Swal.fire(
                          'Upload Father Declaration Form ?',
                          'That thing is still around?',
                          'question'
                        )
                check = "1";
                }
                else if((class_type == "2" && Mother_status == "1" && disease_mother == "Yes") && (mother_file == "" || father_file == undefined))
                {
                      Swal.fire(
                          'Upload Mother Declaration Form ?',
                          'That thing is still around?',
                          'question'
                        )
                check = "1";
                }
                else if(v_status == "0" && class_type == "1")
                {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Oops...',
                            text: 'Add vechicle Details Before Save The Policy!',
                            footer: ''
                        })
                }
                else if(h_status == "0" && class_type == "2")
                {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Oops...',
                            text: 'Add Health Details Before Save The Policy!',
                            footer: ''
                        })
                }
                else
                {
                    var formdata = new FormData();
                    formdata.append('lead_id',lead_id);
                    formdata.append('policy_client_ref_no',policy_client_ref_no);
                    formdata.append('policy_cover_note_no',policy_cover_note_no);
                    formdata.append('policy_no',policy_no);
                    formdata.append('policy_s_date',policy_s_date);
                    formdata.append('policy_ex_date',policy_ex_date);
                    formdata.append('policy_premium',policy_premium);
                    formdata.append('policy_terms',policy_terms);
                    formdata.append('payment_frequency',payment_frequency);
                    formdata.append('next_due_date',next_due_date);
                    formdata.append('renewable_flag',renewable_flag);
                    formdata.append('add_ons_opted',add_ons_opted);
                    formdata.append('add_ons_not_opt',add_ons_not_opt);
                    formdata.append('sum_insured',sum_insured);
                    formdata.append('discount_percent',discount_percent);
                    formdata.append('no_claim_bonus',no_claim_bonus);
                     formdata.append('no_claim_bonus_val',no_claim_bonus_val);
                    formdata.append('total_own_damage',total_own_damage);
                    formdata.append('tot_add_on_premium',tot_add_on_premium);
                    formdata.append('commisson_base_premium',commisson_base_premium);
                    formdata.append('basic_tp',basic_tp);
                    formdata.append('owner_driver_pa',owner_driver_pa);
                    formdata.append('owner_diver_amt',owner_diver_amt);
                    formdata.append('no_of_year_own_drv',no_of_year_own_drv);
                    formdata.append('fuel_kit',fuel_kit);
                    formdata.append('fuel_kit_amt',fuel_kit_amt);
                    formdata.append('geograpical',geograpical);
                    formdata.append('geograpical_amt',geograpical_amt);
                    formdata.append('un_named_passenger_pa',un_named_passenger_pa);
                    formdata.append('un_named_passenger_amt',un_named_passenger_amt);
                    formdata.append('no_seats_per_person',no_seats_per_person);
                    formdata.append('no_seats_per_person_amt',no_seats_per_person_amt);
                    formdata.append('company',company);
                    formdata.append('llp',llp);
                    formdata.append('llp_amt',llp_amt);
                    formdata.append('no_drv_emp',no_drv_emp);
                    formdata.append('pa_paid_drv',pa_paid_drv);
                    formdata.append('pa_paid_drv_amt',pa_paid_drv_amt);
                    formdata.append('no_seats_per_person1',no_seats_per_person1);
                    formdata.append('no_seats_per_person_amt1',no_seats_per_person_amt1);
                    formdata.append('tot_liability_premium',tot_liability_premium);
                    formdata.append('total_premium',total_premium);
                    formdata.append('gst',gst);
                    formdata.append('premium_gst',premium_gst);
                    formdata.append('policy_issue_date',policy_issue_date);
                    formdata.append('policy_agency_pos',policy_agency_pos);
                    formdata.append('policy_source',policy_source);
                    formdata.append('policy_user',policy_user);
                    formdata.append('policy_location',policy_location);
                    formdata.append('previous_policy_no',previous_policy_no);
                    formdata.append('previous_insurer',previous_insurer);
                    formdata.append('previous_insurance_type',previous_insurance_type);
                    formdata.append('previous_agency_pos',previous_agency_pos);
                    formdata.append('previous_source',previous_source);
                    formdata.append('dectable_details',dectable_details);
                    formdata.append('policy_additional_info',policy_additional_info);
                    formdata.append('reference_no',reference_no);
                    formdata.append('other_reference_no',other_reference_no);
                    formdata.append('policy_received',policy_received);
                    formdata.append('policy_verified',policy_verified);
                    formdata.append('policy_verified_info',policy_verified_info);
                    formdata.append('policy_cancelled',policy_cancelled);
                    formdata.append('policy_cancelled_info',policy_cancelled_info);
                    formdata.append('commisson_generation',commisson_generation);
                    formdata.append('payment_type',payment_type);
                    formdata.append('pay_ref_no',pay_ref_no);
                    formdata.append('bank_name',bank_name);
                    formdata.append('payment_receipt_no',payment_receipt_no);
                    formdata.append('payment_check_date',payment_check_date);
                    formdata.append('payment_receipt_no',payment_receipt_no);
                    formdata.append('payment_and_check_no',payment_and_check_no);
                    formdata.append('remarks',remarks);
                    formdata.append('payment_collected_date',payment_collected_date);
                    formdata.append('edit_id',edit_id);
                    formdata.append('cpa',cpa);
                    
                    //2023-06-01 start
                    formdata.append('od_start_date',od_start_date);
                    formdata.append('od_end_date',od_end_date);
                    formdata.append('tp_start_date',tp_start_date);
                    formdata.append('tp_end_date',tp_end_date);
                    //2023-06-01 end
                 if(edit_id == "")
                 {
                    $.ajax({
                            type:"POST",
                            url:"temp_save_policy",
                            data:formdata,
                            processData:false,  
                            contentType:false,
                            cache:false,
                            dataType:'text',
                            beforeSend:function(){
                              $("#temp_save_btn").attr("disabled",true);  
                            },
                            success:function(response)
                            {
                                if(response == "Exits")
                                {
                                    $("#temp_save_btn").attr("disabled",false);
                                    
                                     Swal.fire({
                                            position: 'top-end',
                                            icon: 'warning',
                                            title: 'This policy no Already Exits..',
                                            showConfirmButton: false,
                                            timer: 1500
                                        })
                                }
                                else
                                {
                                    $("#temp_save_btn").attr("disabled",false);  
                                    Swal.fire({
                                                position: 'top-end',
                                                icon: 'success',
                                                title: 'Data Saved Temporary..',
                                                showConfirmButton: false,
                                                timer: 1500
                                            })
                                }
                            }
                    });
                 }
                 else
                 {
                         $.ajax({
                            type:"POST",
                            url:"update_temp_policy",
                            data:formdata,
                            processData:false,  
                            contentType:false,
                            cache:false,
                            dataType:'text',
                            beforeSend:function(){
                              $("#temp_save_btn").attr("disabled",true);  
                            },
                            success:function(response)
                            {
                                $("#temp_save_btn").attr("disabled",false);  
                                Swal.fire({
                                            position: 'top-end',
                                            icon: 'success',
                                            title: 'Data Saved Temporary..',
                                            showConfirmButton: false,
                                            timer: 1500
                                        })
                            }
                    });
                 }
                }
        });
           
        $("#agent_pos").change(function(){
            var agent_pos = $("#agent_pos").val();
            var session_role = $("#session_role").val();
            
             $.ajax({
                       url : "fetch_area_incharge_by_agent",
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
                       url : "fetch_user_by_agent",
                       method : "POST",
                       data : {agent_pos:agent_pos},
                       success:function(response)
                       {

                           $("#assign_to_user").html(response);
                       }
            });
            }
        });   
       
          // Edit Client
       
        // ================= EDIT BUTTON =================
        $("#edit_client_btn").click(function () {
            let timerInterval;
            Swal.fire({
                title: 'Loading',
                html: 'Fetch Client Data',
                timer: 1000,
                timerProgressBar: true,
                didOpen: () => Swal.showLoading(),
                willClose: () => clearInterval(timerInterval),
            });

            // Enable all except client_name
            $("#client_type, #salutation, #initial, #father_husband_name, #dob, #age, #mobile_no, #email_id, #communication_address, #permanent_address, #district, #state, #country, #pin_code, .custom_label, .custom_value").attr("disabled", false);

            // Keep client name readonly
            $("#display_client_name").attr("disabled", true).css("border-color", "#ddd");

            $("#edit_client_btn").addClass("hidden");
            $("#update_client_btn").removeClass("hidden");
        });

      
        // ================= UPDATE BUTTON =================
        $("#update_client_btn").click(function () {
            var lead_id = $("#lead_id").val();
            var client_type = $("#client_type").val();
            var salutation = $("#salutation").val();
            var initial = $("#initial").val();
            var father_husband_name = $("#father_husband_name").val();
            var dob = $("#dob").val();
            var age = $("#age").val();
            var mobile_no = $("#mobile_no").val();
            var email_id = $("#email_id").val();
            var communication_address = $("#communication_address").val();
            var permanent_address = $("#permanent_address").val();
            var district = $("#district").val();
            var state = $("#state").val();
            var country = $("#country").val();
            var pin_code = $("#pin_code").val();

            // ✅ Capture custom fields
            let customFields = {};
            $(".custom_label").each(function (i) {
                let label = $(this).val();
                let value = $(".custom_value").eq(i).val();
                if (label !== "") {
                    customFields[label] = value;
                }
            });

            if (client_type === "" || mobile_no.trim() === "") {
                Swal.fire({
                    icon: "warning",
                    title: "Missing Required Fields",
                    text: "Please fill all mandatory fields before updating.",
                });
                return;
            }

            $.ajax({
                url: "update_client_details",
                method: "POST",
                data: {
                    lead_id,
                    client_type,
                    salutation,
                    initial,
                    father_husband_name,
                    dob,
                    age,
                    mobile_no,
                    email_id,
                    communication_address,
                    permanent_address,
                    district,
                    state,
                    country,
                    pin_code,
                    custom_fields: JSON.stringify(customFields),
                },
                beforeSend: function () {
                    $("#update_client_btn").attr("disabled", true);
                },
                success: function (response) {
                    Swal.fire({
                        position: "top-end",
                        icon: "success",
                        title: "Client details updated successfully!",
                        showConfirmButton: false,
                        timer: 1500,
                    });

                    $("#update_client_btn").attr("disabled", false);
                    $("#update_client_btn").addClass("hidden");
                    $("#edit_client_btn").removeClass("hidden");

                    $("#client_type, #salutation, #display_client_name, #initial, #father_husband_name, #dob, #age, #mobile_no, #email_id, #communication_address, #permanent_address, #district, #state, #country, #pin_code, .custom_label, .custom_value").attr("disabled", true);

                    notification_log(lead_id);
                    window.location.href = "generate_policy?id=" + lead_id;
                },
                error: function () {
                    Swal.fire({
                        icon: "error",
                        title: "Update Failed",
                        text: "An error occurred while updating client details.",
                    });
                    $("#update_client_btn").attr("disabled", false);
                },
            });
        });

      
      // Edit Requirement Details
      
        $("#edit_req_btn").click(function(){
         
            $("#bussiness_type").attr("disabled",false);
            $("#policy_class").attr("disabled",false);
            $("#policy_type").attr("disabled",false);
            $("#location").attr("disabled",false);
            $("#classification").attr("disabled",false);
            $("#source").attr("disabled",false);
            $("#agent_pos").attr("disabled",false);
            $("#assign_to_user").attr("disabled",false);
            $("#area_incharge").attr("disabled",false);
            $("#remarks").attr("disabled",false);
            $("#due_date").attr("disabled",false);
            
            $("#bussiness_type").css("border-color", "#6ec3f5");
            $("#policy_class").css("border-color", "#6ec3f5");
            $("#policy_type").css("border-color", "#6ec3f5");
            $("#location").css("border-color", "#6ec3f5");
            $("#classification").css("border-color", "#6ec3f5");
            $("#source").css("border-color", "#6ec3f5");
            $("#agent_pos").attr("disabled",false);
            $("#assign_to_user").css("border-color", "#6ec3f5");
            $("#area_incharge").css("border-color", "#6ec3f5");
            $("#remarks").css("border-color", "#6ec3f5");
            $("#due_date").css("border-color", "#6ec3f5");
            
            $("#edit_req_btn").addClass("hidden");
            $("#update_req_btn").removeClass("hidden");
          
        });
      
        $("#update_req_btn").click(function(){
             var lead_id = $("#lead_id").val();
             var bussiness_type = $("#bussiness_type").val();
             var policy_class = $("#policy_class").val();
             var policy_type = $("#policy_type").val();
             var lead_generated_date = $("#lead_generated_date").val();
             var due_date = $("#due_date").val();
             var area_incharge = $("#area_incharge").val();
            
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
             var area_incharge = $("#area_incharge").val();
             var remarks = $("#remarks").val();
             
             var check = 0;
             
             if(bussiness_type == "")
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
             else
             {
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
                       area_incharge:area_incharge,
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
                    window.location.href="generate_policy?id="+lead_id;
                    notification_log(lead_id)
                 }
                 
             });
             }
          
        });  
      
        $("#add_commision_btn").click(function(){
            
            var lead_id = $("#lead_id").val();
            $.ajax({
                    url : "fetch_total_premium",
                    method : "POST",
                    data : {lead_id:lead_id},
                    success:function(response)
                    {
                        var obj = jQuery.parseJSON(response);
                        
                        if(obj.total_premium != "" && obj.total_premium != "0.00" && obj.total_premium != undefined)
                        {
                            $("#tot_premium_amt").val(obj.total_premium);
                            if(obj.own_commission_amt > 0 ){
                                percentage = getPercentage(obj.own_commission_amt ,obj.total_premium);
                                $('#own_com_amt').html(obj.own_commission_amt);
                                $("#own_com_per").val(percentage);
                            }
                            
                            // 2023-05-25 start
                            if(obj.own_commission > 0 ){
                                percentage = getPercentage(obj.own_commission ,obj.total_premium);
                                $('#orc_com_amt').html(obj.own_commission);
                                $("#orc_com_per").val(percentage);
                            }
                            
                            if(obj.agent_commission_amt > 0 ){
                                percentage = getPercentage(obj.agent_commission_amt ,obj.total_premium);
                                $('#agn_amount').html(obj.agent_commission_amt);
                                $("#agn_com").val(percentage);
                            }
                            
                            if(obj.sub_agn_amt_1 > 0 ){
                                percentage = getPercentage(obj.sub_agn_amt_1 ,obj.agent_commission_amt);
                                $('#sub_agn_amt').html(obj.sub_agn_amt_1);
                                $("#sub_agn_per").val(percentage);
                            }
                            
                            
                            if(obj.sub_agn_amt_2 > 0 ){
                                percentage = getPercentage(obj.sub_agn_amt_2 ,obj.agent_commission_amt);
                                $('#sub_agn_amt_2').html(obj.sub_agn_amt_2);
                                $("#sub_agn_per_2").val(percentage);
                            }
                            
                            if(obj.ai_com > 0 ){
                                
                                percentage = getPercentage(obj.ai_com ,obj.own_commission_amt);
                                console.log('ai amt = ' + obj.ai_com + ', total = ' + obj.total_premium+', per = ' + percentage);
                                $('#ai_amt').html(obj.ai_com);
                                $("#ai_com").val(percentage);
                            }
                            
                            $("#add_com_modal").modal("toggle");
                        }
                        else
                        {
                            snackbar_show("Add Premium Amounts");   
                        }
                        
                    }
            });  
            
            
        });
      
        $("#own_com_per").keyup(function(){
                var own_com_per = $("#own_com_per").val();
                var tot_premium_amt = $("#tot_premium_amt").val();
                var own_com_amt = (tot_premium_amt * own_com_per) / 100;
                $("#own_com_amt").html("₹ "+own_com_amt+".00");
                var sync = $("#orc_com_amt").val();
                if(sync.length > 0) {
                    $("#orc_com_per").val('');
                    $("#orc_com_amt").html('');
                }
        });
      
        $("#orc_com_per").keyup(function(){
                var orc_com_per = $("#orc_com_per").val();
                var tot_premium_amt = $("#tot_premium_amt").val();
                var orc_com_amt = ((tot_premium_amt * orc_com_per) / 100).toFixed(2);
                $("#orc_com_amt").html("₹ "+orc_com_amt);
                var sync = $("#ai_com").val();
                if(sync.length > 0) {
                    $("#ai_com").val('');
                    $("#ai_amt").html('');
                }
        });
      
        $("#agn_com").keyup(function(){
                var agn_com = $("#agn_com").val();
                var tot_premium_amt = $("#tot_premium_amt").val();
                var agn_com_amt = (tot_premium_amt * agn_com) / 100;
                $("#agn_amount").html("₹ "+agn_com_amt+".00"); 
        });
      
        $("#ai_com").keyup(function(){
                var ai_com = $("#ai_com").val();
                var own_com_per = $("#own_com_per").val();
                var tot_premium_amt = $("#tot_premium_amt").val();
                var own_com_amt = (tot_premium_amt * own_com_per) / 100;
                var ai_com_amt = (own_com_amt * ai_com) / 100;
                $("#ai_amt").html("₹ "+ai_com_amt+".00"); 
        });
   
        $("#sub_agn_per").keyup(function(){
                var sub_agn_per = $("#sub_agn_per").val();
                var agn_com = $("#agn_com").val();
                var tot_premium_amt = $("#tot_premium_amt").val();
                var agn_com_amt = (tot_premium_amt * agn_com) / 100;
                var sub_agn_amt1 = (agn_com_amt * sub_agn_per) / 100;
                $("#sub_agn_amt").html("₹ "+sub_agn_amt1+".00"); 
        });
      
        $("#sub_agn_per_2").keyup(function(){
                var sub_agn_per_2 = $("#sub_agn_per_2").val();
                var agn_com = $("#agn_com").val();
                var tot_premium_amt = $("#tot_premium_amt").val();
                var agn_com_amt = (tot_premium_amt * agn_com) / 100;
                var sub_agn_amt2 = (agn_com_amt * sub_agn_per_2) / 100;
                $("#sub_agn_amt_2").html("₹ "+sub_agn_amt2+".00"); 
        });
      
        $("#sub_com_btn").click(function(){
            
            var lead_id = $("#lead_id").val();
            var own_com_per = $("#own_com_per").val();
            var orc_com_per = $("#orc_com_per").val();
            var agn_com = $("#agn_com").val(); 
            var ai_com = $("#ai_com").val();
            var sub_agn_1 = $("#sub_agn_1").val();
            var sub_agn_per = $("#sub_agn_per").val();
            var sub_agn_2 = $("#sub_agn_2").val();
            var sub_agn_per_2 = $("#sub_agn_per_2").val();
            var policy_no = $("#policy_no").val();
            
        
                if(own_com_per == "")
                {
                    snackbar_show("Enter Own Commission Percentage");         
                }
                else if(orc_com_per == "")
                {
                    snackbar_show("Enter Orc Commission Percentage");         
                }
                else if(agn_com == "")
                {
                    snackbar_show("Enter Agent Commission Percentage");      
                }
                else if(ai_com == "")
                {
                    snackbar_show("Enter Ai Commission Percentage");     
                }
                else if(sub_agn_1 != "" && sub_agn_per == "")
                {
                    snackbar_show("Enter Sub Agent 1 Percentage");
                }
                else if(sub_agn_2 != "" && sub_agn_per_2 == "")
                {
                    snackbar_show("Enter Sub Agent 2 Percentage");
                }
                else
                {
                        var own_com_per = $("#own_com_per").val();
                        var orc_com_per = $("#orc_com_per").val();
                        var tot_premium_amt = $("#tot_premium_amt").val();
                        var own_com_amt = (tot_premium_amt * own_com_per) / 100;
                        var orc_com_amt = (tot_premium_amt * orc_com_per) / 100;
                        var agn_com_amt = (tot_premium_amt * agn_com) / 100;
                        
                        var ai_com_amt = (own_com_amt * ai_com) / 100;
                        var sub_agn_amt1  = "";
                        var sub_agn_amt2 = "";
                        
                        if(sub_agn_per != "")
                        {
                            sub_agn_amt1 = (agn_com_amt * sub_agn_per) / 100;
                        }
                        
                        if(sub_agn_per_2 != "")
                        {
                            sub_agn_amt2 = (agn_com_amt * sub_agn_per_2) / 100;
                        }

                        $.ajax({
                                    url : "add_sme_commission",
                                    method : "POST",
                                    data : {lead_id:lead_id,policy_no:policy_no,own_com_amt:own_com_amt,orc_com_amt:orc_com_amt,agn_com_amt:agn_com_amt,ai_com_amt:ai_com_amt,sub_agn_1:sub_agn_1,sub_agn_2:sub_agn_2,sub_agn_amt1:sub_agn_amt1,sub_agn_amt2:sub_agn_amt2},
                                    beforeSend:function(){
                                        $("#sub_com_btn").attr("disabled",true);
                                    },
                                    success:function(response)
                                    {
                                        $("#sub_com_btn").attr("disabled",false);
                                        
                                        if(response == "Exits")
                                        {
                                            snackbar_show("Policy Already Exits In Active Policy!");
                                            window.location.href="generate_policy1";
                                        }
                                        else
                                        {
                                            $("#add_com_modal").modal("toggle");
                                            
                                            $("#save_btn").attr("disabled",false);
                                                    Swal.fire({
                                                    position: 'top-end',
                                                    icon: 'success',
                                                    title: 'Policy Has Been Generated Successfully..',
                                                    showConfirmButton: false,
                                                    timer: 1500
                                                })
                                                window.location.href="generate_policy1";
                                                notification_log(lead_id);
                                        }
                                    }
                        });
                }
            
        });
      
      
        //2023-06-01 start
        $("#policy_premium").change(function(){
            var type = $("#policy_premium option:selected").text();
            
            if(type == "Pkg" || type == "Bundled") {
                $('.dts').each(function(i) {        
                    $(this).removeClass('hidden');
                });                
            } else {
                $('.dts').each(function(i) {
                    $(this).removeClass('hidden').addClass('hidden');
                });
            }
        }); 

        // ✅ Set today's date as default and make it readonly
        const today = new Date().toISOString().split('T')[0];
            $("#payment_collected_date")
                .val(today)       // set today's date
                .attr("readonly", true) // prevent typing
                .on("keydown mousedown", function(e) {
                    e.preventDefault(); // prevent datepicker from opening or editing
                });
      

    });
    
    function getPercentage(iAmt, pAmt) {
        percent = '';
        if(iAmt > 0 ){
            percent = (iAmt / pAmt) ;
            percent = (percent * 100).toFixed(2);
        }
        
        return percent;
    }
    
    function calculate()
    {
            var total_liablity = 0;
            var total_premium = 0;
            
            var basic_tp = $("#basic_tp").val();
       
       
           if(basic_tp != "")
           {
               total_liablity = parseInt(basic_tp)+parseInt(total_liablity);
           }
           
            var owner_diver_amt = $("#owner_diver_amt").val();
            
            if(owner_diver_amt !="")
            {
                total_liablity = parseInt(owner_diver_amt)+parseInt(total_liablity);
            }
            
            // var fuel_kit_amt = $("#fuel_kit_amt").val();
             
            // if(fuel_kit_amt !="")
            // {
            //     total_liablity = parseInt(fuel_kit_amt)+parseInt(total_liablity);
            // }
            
            // var geograpical_amt = $("#geograpical_amt").val();
            
            // if(geograpical_amt !="")
            // {
            //     total_liablity = parseInt(geograpical_amt)+parseInt(total_liablity);
            // }
                
            // var llp_amt = $("#llp_amt").val();
            
            // if(llp_amt !="")
            // {
            //     total_liablity = parseInt(llp_amt)+parseInt(total_liablity);
            // }
            // var pa_paid_drv_amt = $("#pa_paid_drv_amt").val();
            
            // if(pa_paid_drv_amt !="")
            // {
            //     total_liablity = parseInt(llp_amt)+parseInt(total_liablity);
            // }
                
           $("#tot_liability_premium").val(total_liablity);
           
            var commisson_base_premium = $("#commisson_base_premium").val();
            var tot_liability_premium = $("#tot_liability_premium").val();
            total_premium = parseInt(commisson_base_premium)+parseInt(tot_liability_premium);
            $("#total_premium").val(total_premium);
            var total_premium1 = $("#total_premium").val();
           
            if(total_premium1 != "")
            {
                total_premium1 = parseFloat(total_premium1);
                var gst1 = (total_premium1 * 18) / 100;
                var tot = total_premium1 + gst1;
                $("#gst").val(gst1);
                $("#premium_gst").val(tot);
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
      
      
    function fetch_health_details(lead_id)
    {
        $.ajax({
                    url : "fetch_edit_health_details",
                    method : "POST",
                    data : {lead_id:lead_id},
                    success:function(response)
                    {
                        var obj = jQuery.parseJSON(response);
                        
                        var html = "";
                        
                        if(obj.gender == "Male")
                        {
                            Applicant_gender =  obj.gender;
                            
                            var date    = new Date(obj.husband_dob),
                            yr      = date.getFullYear(),
                            month   = date.getMonth() < 10 ? '0' + date.getMonth() : date.getMonth(),
                            day     = date.getDate()  < 10 ? '0' + date.getDate()  : date.getDate(),
                            newDate = day + '-' + month + '-' + yr;
                            
                            Husband_status = "1";
                    
                            html += "<tr>";
                            html += "<td>"+obj.husband_name+"</td>";
                            html += "<td>"+obj.husband_age+" Y/O</td>";
                            html += "<td>"+newDate+"</td>";
                            html += "<td>"+obj.gender+"</td>";
                            html += "<td>Applicant</td>";
                            html += "<td>";
                            html += "    <select class='form-control' id='disease_husband'>";
                            html += "             <option value = ''>--Select--</option>";
                            html += "             <option value = 'None'>None</option>";
                            html += "             <option value = 'Yes'>Yes</option>";
                            html += "     </select>";
                            html += " </td>";
                            
                            html += "<td>";
                            html += "    <input type='file' class='form-control' id='husband_file'>";
                            html += "</td>";
                            html += "</tr>";
                            
                            if(obj.wife == "1")
                            {
                                var date    = new Date(obj.wife_dob),
                                yr      = date.getFullYear(),
                                month   = date.getMonth() < 10 ? '0' + date.getMonth() : date.getMonth(),
                                day     = date.getDate()  < 10 ? '0' + date.getDate()  : date.getDate(),
                                newDate = day + '-' + month + '-' + yr;
                                
                                Wife_status = "1";
                            
                                html += "<tr>";
                                html += "<td>"+obj.wife_name+"</td>";
                                html += "<td>"+obj.wife_age+" Y/O</td>";
                                html += "<td>"+newDate+"</td>";
                                html += "<td>"+obj.gender+"</td>";
                                html += "<td>Wife</td>";
                                html += "<td>";
                                html += "    <select class='form-control' id='disease_wife'>";
                                html += "             <option value = ''>--Select--</option>";
                                html += "             <option value = 'None'>None</option>";
                                html += "             <option value = 'Yes'>Yes</option>";
                                html += "     </select>";
                                html += " </td>";
                                
                                html += "<td>";
                                html += "    <input type='file' class='form-control' id='wife_file'>";
                                html += "</td>";
                                html += "</tr>";
                            }
                        }
                        else
                        {
                            Applicant_gender =  obj.gender; 
                            
                                Wife_status = "1";
                                
                                var date    = new Date(obj.wife_dob),
                                yr      = date.getFullYear(),
                                month   = date.getMonth() < 10 ? '0' + date.getMonth() : date.getMonth(),
                                day     = date.getDate()  < 10 ? '0' + date.getDate()  : date.getDate(),
                                newDate = day + '-' + month + '-' + yr;
                                
                                html += "<tr>";
                                html += "<td>"+obj.wife_name+"</td>";
                                html += "<td>"+obj.wife_age+" Y/O</td>";
                                html += "<td>"+newDate+"</td>";
                                html += "<td>"+obj.gender+"</td>";
                                html += "<td>Applicant</td>";
                                html += "<td>";
                                html += "    <select class='form-control' id='disease_wife'>";
                                html += "             <option value = ''>--Select--</option>";
                                html += "             <option value = 'None'>None</option>";
                                html += "             <option value = 'Yes'>Yes</option>";
                                html += "     </select>";
                                html += " </td>";
                                
                                html += "<td>";
                                html += "    <input type='file' class='form-control' id='wife_file'>";
                                html += "</td>";
                                html += "</tr>";
                                
                                if(obj.husband == "1")
                                {
                                    Husband_status = "1";
                                    
                                    var date    = new Date(obj.husband_dob),
                                    yr      = date.getFullYear(),
                                    month   = date.getMonth() < 10 ? '0' + date.getMonth() : date.getMonth(),
                                    day     = date.getDate()  < 10 ? '0' + date.getDate()  : date.getDate(),
                                    newDate = day + '-' + month + '-' + yr;
                                
                                
                                    html += "<tr>";
                                    html += "<td>"+obj.husband_name+"</td>";
                                    html += "<td>"+obj.husband_age+" Y/O</td>";
                                    html += "<td>"+newDate+"</td>";
                                    html += "<td>"+obj.gender+"</td>";
                                    html += "<td>Husband</td>";
                                    html += "<td>";
                                    html += "    <select class='form-control' id='disease_husband'>";
                                    html += "             <option value = ''>--Select--</option>";
                                    html += "             <option value = 'None'>None</option>";
                                    html += "             <option value = 'Yes'>Yes</option>";
                                    html += "     </select>";
                                    html += " </td>";
                                    
                                    html += "<td>";
                                    html += "    <input type='file' class='form-control' id='husband_file'>";
                                    html += "</td>";
                                    html += "</tr>";
                                }
                        }
                        
                        if(obj.duaghter == "1")
                        {
                            if(obj.daughter_name_1 != "0" && obj.daughter_name_1 != "")
                            {
                                    Daughter_1_status = "1";
                                    
                                if(obj.daughter1_age > 12)
                                    {
                                        var age_format = "Y";
                                        var age = obj.daughter1_age/12;
                                    }
                                    else
                                    {
                                        var age_format = "M";
                                        var age = obj.daughter1_age;
                                    }
                                    
                                    var date    = new Date(obj.daughter_dob_1),
                                    yr      = date.getFullYear(),
                                    month   = date.getMonth() < 10 ? '0' + date.getMonth() : date.getMonth(),
                                    day     = date.getDate()  < 10 ? '0' + date.getDate()  : date.getDate(),
                                    newDate = day + '-' + month + '-' + yr;
                                    
                                    html += "<tr>";
                                    html += "<td>"+obj.daughter_name_1+"</td>";
                                    html += "<td>"+age+" "+age_format+"/O</td>";
                                    html += "<td>"+newDate+"</td>";
                                    html += "<td>Female</td>";
                                    html += "<td>Daughter</td>";
                                    html += "<td>";
                                    html += "    <select class='form-control' id='disease_daug_1'>";
                                    html += "             <option value = ''>--Select--</option>";
                                    html += "             <option value = 'None'>None</option>";
                                    html += "             <option value = 'Yes'>Yes</option>";
                                    html += "     </select>";
                                    html += " </td>";
                                    
                                    html += "<td>";
                                    html += "    <input type='file' class='form-control' id='daug_1_file'>";
                                    html += "</td>";
                                    html += "</tr>";
                            }
                            
                            if(obj.daughter_name_2 != "0" && obj.daughter_name_2 != "")
                            {
                                Daughter_2_status = "1";
                                
                                    var date    = new Date(obj.daughter_dob_2),
                                    yr      = date.getFullYear(),
                                    month   = date.getMonth() < 10 ? '0' + date.getMonth() : date.getMonth(),
                                    day     = date.getDate()  < 10 ? '0' + date.getDate()  : date.getDate(),
                                    newDate = day + '-' + month + '-' + yr;
                                    
                                    if(obj.daughter2_age > 12)
                                    {
                                        var age_format = "Y";
                                        var age = obj.daughter2_age/12;
                                    }
                                    else
                                    {
                                        var age_format = "M";
                                        var age = obj.daughter2_age;
                                    }
                                    
                                    html += "<tr>";
                                    html += "<td>"+obj.daughter_name_2+"</td>";
                                    html += "<td>"+age+" "+age_format+"/O</td>";
                                    html += "<td>"+newDate+"</td>";
                                    html += "<td>Female</td>";
                                    html += "<td>Daughter</td>";
                                    html += "<td>";
                                    html += "    <select class='form-control' id='disease_daug_2'>";
                                    html += "             <option value = ''>--Select--</option>";
                                    html += "             <option value = 'None'>None</option>";
                                    html += "             <option value = 'Yes'>Yes</option>";
                                    html += "     </select>";
                                    html += " </td>";
                                    
                                    html += "<td>";
                                    html += "    <input type='file' class='form-control' id='daug_2_file'>";
                                    html += "</td>";
                                    html += "</tr>";
                            }
                            
                            if(obj.daughter_name_3 != "0" && obj.daughter_name_3 != "")
                            {
                                Daughter_3_status = "1";
                                    var date    = new Date(obj.daughter_dob_3),
                                    yr      = date.getFullYear(),
                                    month   = date.getMonth() < 10 ? '0' + date.getMonth() : date.getMonth(),
                                    day     = date.getDate()  < 10 ? '0' + date.getDate()  : date.getDate(),
                                    newDate = day + '-' + month + '-' + yr;
                                    
                                    if(obj.daughter3_age > 12)
                                    {
                                        var age_format = "Y";
                                        var age = obj.daughter3_age/12;
                                    }
                                    else
                                    {
                                        var age_format = "M";
                                        var age = obj.daughter3_age;
                                    }
                                    
                                    html += "<tr>";
                                    html += "<td>"+obj.daughter_name_3+"</td>";
                                    html += "<td>"+age+" "+age_format+"/O</td>";
                                    html += "<td>"+newDate+"</td>";
                                    html += "<td>Female</td>";
                                    html += "<td>Daughter</td>";
                                    html += "<td>";
                                    html += "    <select class='form-control' id='disease_daug_3'>";
                                    html += "             <option value = ''>--Select--</option>";
                                    html += "             <option value = 'None'>None</option>";
                                    html += "             <option value = 'Yes'>Yes</option>";
                                    html += "     </select>";
                                    html += " </td>";
                                    
                                    html += "<td>";
                                    html += "    <input type='file' class='form-control' id='daug_3_file'>";
                                    html += "</td>";
                                    html += "</tr>";
                            }
                        }
                        
                        
                        if(obj.son == "1")
                        {
                            if(obj.son_name_1 != "0" && obj.son_name_1 != "")
                            {
                                Son_1_status = "1";
                                
                                if(obj.son1_age > 12)
                                    {
                                        var age_format = "Y";
                                        var age = obj.son1_age/12;
                                    }
                                    else
                                    {
                                        var age_format = "M";
                                        var age = obj.son1_age;
                                    }
                                    
                                    var date    = new Date(obj.son_dob_1),
                                    yr      = date.getFullYear(),
                                    month   = date.getMonth() < 10 ? '0' + date.getMonth() : date.getMonth(),
                                    day     = date.getDate()  < 10 ? '0' + date.getDate()  : date.getDate(),
                                    newDate = day + '-' + month + '-' + yr;
                                    
                                    html += "<tr>";
                                    html += "<td>"+obj.son_name_1+"</td>";
                                    html += "<td>"+age+" "+age_format+"/O</td>";
                                    html += "<td>"+newDate+"</td>";
                                    html += "<td>Male</td>";
                                    html += "<td>Son</td>";
                                    html += "<td>";
                                    html += "    <select class='form-control' id='disease_son_1'>";
                                    html += "             <option value = ''>--Select--</option>";
                                    html += "             <option value = 'None'>None</option>";
                                    html += "             <option value = 'Yes'>Yes</option>";
                                    html += "     </select>";
                                    html += " </td>";
                                    
                                    html += "<td>";
                                    html += "    <input type='file' class='form-control' id='son_1_file'>";
                                    html += "</td>";
                                    html += "</tr>";
                            }
                            
                            if(obj.son_name_2 != "0" && obj.son_name_2 != "")
                            {
                                Son_2_status = "1";
                                
                                if(obj.son2_age > 12)
                                    {
                                        var age_format = "Y";
                                        var age = obj.son2_age/12;
                                    }
                                    else
                                    {
                                        var age_format = "M";
                                        var age = obj.son2_age;
                                    }
                                    
                                    var date    = new Date(obj.son_dob_2),
                                    yr      = date.getFullYear(),
                                    month   = date.getMonth() < 10 ? '0' + date.getMonth() : date.getMonth(),
                                    day     = date.getDate()  < 10 ? '0' + date.getDate()  : date.getDate(),
                                    newDate = day + '-' + month + '-' + yr;
                                    
                                    html += "<tr>";
                                    html += "<td>"+obj.son_name_2+"</td>";
                                    html += "<td>"+age+" "+age_format+"/O</td>";
                                    html += "<td>"+newDate+"</td>";
                                    html += "<td>Male</td>";
                                    html += "<td>Son</td>";
                                    html += "<td>";
                                    html += "    <select class='form-control' id='disease_son_2'>";
                                    html += "             <option value = ''>--Select--</option>";
                                    html += "             <option value = 'None'>None</option>";
                                    html += "             <option value = 'Yes'>Yes</option>";
                                    html += "     </select>";
                                    html += " </td>";
                                    
                                    html += "<td>";
                                    html += "    <input type='file' class='form-control' id='son_2_file'>";
                                    html += "</td>";
                                    html += "</tr>";
                            }
                            
                            if(obj.son_name_3 != "0" && obj.son_name_3 != "")
                            {
                                Son_3_status = "1";
                                
                                if(obj.son3_age > 12)
                                    {
                                        var age_format = "Y";
                                        var age = obj.son3_age/12;
                                    }
                                    else
                                    {
                                        var age_format = "M";
                                        var age = obj.son3_age;
                                    }
                                    
                                    var date    = new Date(obj.son_dob_3),
                                    yr      = date.getFullYear(),
                                    month   = date.getMonth() < 10 ? '0' + date.getMonth() : date.getMonth(),
                                    day     = date.getDate()  < 10 ? '0' + date.getDate()  : date.getDate(),
                                    newDate = day + '-' + month + '-' + yr;
                                    
                                    html += "<tr>";
                                    html += "<td>"+obj.son_name_3+"</td>";
                                    html += "<td>"+age+" "+age_format+"/O</td>";
                                    html += "<td>"+newDate+"</td>";
                                    html += "<td>Male</td>";
                                    html += "<td>Son</td>";
                                    html += "<td>";
                                    html += "    <select class='form-control' id='disease_son_3'>";
                                    html += "             <option value = ''>--Select--</option>";
                                    html += "             <option value = 'None'>None</option>";
                                    html += "             <option value = 'Yes'>Yes</option>";
                                    html += "     </select>";
                                    html += " </td>";
                                    
                                    html += "<td>";
                                    html += "    <input type='file' class='form-control' id='son_3_file'>";
                                    html += "</td>";
                                    html += "</tr>";
                            }
                        }
                        
                        
                        if(obj.father == "1")
                        {
                            if(obj.father_name != "0" && obj.father_name != "")
                            {
                                Father_status = "1";
                                
                                    var date    = new Date(obj.father_dob),
                                    yr      = date.getFullYear(),
                                    month   = date.getMonth() < 10 ? '0' + date.getMonth() : date.getMonth(),
                                    day     = date.getDate()  < 10 ? '0' + date.getDate()  : date.getDate(),
                                    newDate = day + '-' + month + '-' + yr;
                                    
                                    html += "<tr>";
                                    html += "<td>"+obj.father_name+"</td>";
                                    html += "<td>"+obj.father_age+" Y/O</td>";
                                    html += "<td>"+newDate+"</td>";
                                    html += "<td>Male</td>";
                                    html += "<td>Father</td>";
                                    html += "<td>";
                                    html += "    <select class='form-control' id='disease_father'>";
                                    html += "             <option value = ''>--Select--</option>";
                                    html += "             <option value = 'None'>None</option>";
                                    html += "             <option value = 'Yes'>Yes</option>";
                                    html += "     </select>";
                                    html += " </td>";
                                    
                                    html += "<td>";
                                    html += "    <input type='file' class='form-control' id='father_file'>";
                                    html += "</td>";
                                    html += "</tr>";
                            }
                        
                        $("#insurer_details").html(html);
                    }
                    
                        if(obj.mother == "1")
                        {
                            Mother_status = "1";
                            
                            if(obj.mother_name != "0" && obj.mother_name != "")
                            {
                                
                                    var date    = new Date(obj.mother_dob),
                                    yr      = date.getFullYear(),
                                    month   = date.getMonth() < 10 ? '0' + date.getMonth() : date.getMonth(),
                                    day     = date.getDate()  < 10 ? '0' + date.getDate()  : date.getDate(),
                                    newDate = day + '-' + month + '-' + yr;
                                    
                                    html += "<tr>";
                                    html += "<td>"+obj.mother_name+"</td>";
                                    html += "<td>"+obj.mother_age+" Y/O</td>";
                                    html += "<td>"+newDate+"</td>";
                                    html += "<td>Male</td>";
                                    html += "<td>Mother</td>";
                                    html += "<td>";
                                    html += "    <select class='form-control' id='disease_mother'>";
                                    html += "             <option value = ''>--Select--</option>";
                                    html += "             <option value = 'None'>None</option>";
                                    html += "             <option value = 'Yes'>Yes</option>";
                                    html += "     </select>";
                                    html += " </td>";
                                    
                                    html += "<td>";
                                    html += "    <input type='file' class='form-control' id='mother_file'>";
                                    html += "</td>";
                                    html += "</tr>";
                            }
                        }
                        
                        $("#insurer_details").html(html);
                    }
            });
    }
      
    function upload_documents()
    {
        var document_type = $("#document_type").val();
        var doc_file = $("#document_file").val();
        var lead_id = $("#lead_id").val();
        var files = $("#document_file").prop('files')[0];
        var formdata = new FormData();
        formdata.append('file',files);
        formdata.append('id',lead_id);
        formdata.append('document_type',document_type);
    
        if(document_type == "")
        {
                Swal.fire({
                            icon: 'warning',
                            title: 'Oops...',
                            text: 'Enter Document name!',
                            footer: ''
                    })
        }
        else if(doc_file == "")
        {
                Swal.fire({
                            icon: 'warning',
                            title: 'Oops...',
                            text: 'Select a File!',
                            footer: ''
                        })
        }
        else 
        {
            $.ajax({
                type:"POST",
                url:"upload_policy_document_files",
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
        }
    }
    
    function fetch_policy_documents(lead_id)
    {
        $.ajax({
                type:"POST",
                url:"fetch_policy_documents",
                data:{lead_id:lead_id},
                success:function(response)
                {
                    $("#table_view").html(response);
                }
          });
    }
    
 </script>