<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
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
      </style>
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1 style="font-size: 17px;">
        Renewal <span id="tit_cus_name"></span>
        <button class="btn btn-success pull-right" style='margin-top:-10px;' id="save_btn"><i class='fa fa-save'></i> Save</button>
      </h1>
    </section>
    
    
    <?php 
    
    if(isset($_GET["id"]))
    {
      $id = $_GET["id"];
    }
    else
     {?>
       <script>
         $("#lead_id").val("");
       </script>
     <?php
     }
    ?>
    
    <input type="hidden" id="lead_id" value="<?php echo $_GET["id"] ?>">
    
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
                                                <option value="3">Cold</option>
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
                                           <option value="Jayantha Insurance">Jayantha Insurance</option>
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
                                            <option value="<?php echo $da->id ?>"><?php echo $da->name."  - ".$da->agent_pos_code."" ?></option>
                                             
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
               <!--<button class="btn btn-info btn-xs pull-right hidden" id="edit_vechicle_btn" data-dismiss="modal" data-toggle="modal" href="#lost"><i class="fa fa-pencil" aria-hidden="true"></i> View / Edit Vechicle </button>-->
               <button class="btn btn-info btn-xs pull-right" id="add_vechi_btn"><i class="fa fa-plus" aria-hidden="true"></i> New Vechile</button>
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
         
    </section><!-- /.content -->
  </div><!-- /.content-wrapper -->


<script>

  var lead_id = $("#lead_id").val();

    $(document).ready(function(){
        
        $.ajax({
                  url : "get_client_details_by_lead_id",
                  method : "POST",
                  data : {lead_id:lead_id},
                  success:function(response)
                  {
                    var obj = jQuery.parseJSON(response);
                    
                    $("#tit_cus_name").html(" -"+obj.client_name+" ( " +obj.mobile_no+" )");
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
                    $("#bussiness_type").val("1");
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
                               
                                 var lead_id = $("#lead_id").val();

                               $("#vechicle_hidden").removeClass("hidden");
                                    $.ajax({
                                           url : "get_vechile_details",
                                           method : "POST",
                                           data : {id:lead_id},
                                           success:function(response)
                                           {
                                              var obj = jQuery.parseJSON(response);
                                              
                                               if(response != null || response != "")
                                                {
                                                    $("#view_vechi_details").removeClass("hidden");  
                                                    //$("#edit_vechicle_btn").removeClass("hidden");
                                                    $("#add_vechi_btn").addClass("hidden");
                                                    $("#quotation_box_hidden").removeClass("hidden");
                                                    $("#view_make_model").val(obj.brand_name+" "+obj.model_name+" "+obj.varient_name);
                                                    $("#view_engine_no").val(obj.vechi_engine_num);
                                                    $("#view_regn_no").val(obj.vechi_register_no);
                                                    $("#view_chassis").val(obj.vechi_chassis_num);
                                                }
                                                else
                                                {
                                                    //$("#edit_vechicle_btn").addClass("hidden");
                                                    $("#add_vechi_btn").removeClass("hidden");
                                                    $("#view_vechi_details").addClass("hidden");
                                                }
                                           }
                              });
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
                                   var lead_id = $("#lead_id").val();
                                   
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
                                   
                                   var lead_id = $("#lead_id").val();
                                    
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
                               var lead_id = $("#lead_id").val();
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
                              var lead_id = $("#lead_id").val();
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
        
        $("#save_btn").click(function(){
             var lead_id = $("#lead_id").val();  
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
                     url : "add_renewal_lead_details",
                     method : "POST",
                     data : {lead_id:lead_id,bussiness_type:bussiness_type,policy_class:policy_class,policy_type:policy_type,lead_generated_date:lead_generated_date,due_date:due_date,broken_policy:broken_policy,location:location,classification:classification,source:source,agent_pos:agent_pos,assign_to_user:assign_to_user,remarks:remarks},
                     beforeSend:function(){
                         $("#save_btn").attr("disabled",true);  
                     },
                     success:function(response)
                     {
                         $("#save_btn").attr("disabled",false);  
                                     Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                title: 'Renewal Details Are Stored Successfully',
                                showConfirmButton: false,
                                timer: 1500
                                })
                        window.location.href = "leads";
                     }
             });
                   
        });    
            
            
       });
       
     
                  
</script>
