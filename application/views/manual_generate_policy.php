<script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
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

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
     
              <?php 
                if(isset($_GET["id"]))
                {
                    $id = $_GET["id"];
                }
                else
                {
                    $id = "";
                }
              ?>
              
              <div class="row">
                  <div class="col-md-6">
                       <h4 style="font-size: 17px;margin-top:-10px;"> <input type="hidden" id="lead_id" value="<?php echo $id ?>">
                            Create New Policy </h4>
                  </div>
               
               <div class="col-md-6 pull-right">
                   <button class="btn btn-success pull-right" id="save_btn"> <i class="fa fa-save"></i> Save</button>
               </div>
             </div>
       
    </section>

    <!-- Main content -->
    <section class="content">

    <div class="box">
        <div class="box-header with-border" style="background:#f4f4f48c;">
            <h3 class="box-title" _msthash="26273" _msttexthash="60619" style="text-align: left;font-size:14px;"><i class="fa fa-bars" aria-hidden="true"></i> &nbsp;&nbsp; Client Details </h3>
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
                                <div class="input-group">
                                    <div class="input-group-addon">+91</div>
                                
                                  <input type="text" class="form-control" name="mobile_no" maxlength="10" minlength="10" size="10" id="mobile_no">
                                
                              </div>
                              
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
                                       <option value="Agents_and_POS">Agents Or POS</option>
                                    <option value="Website">Website</option>
                                   <option value="Social Media">Social Media</option>
                                   <option value="Adverdisment">Adverdisment</option>
                                   <option value="Others">Others</option>
                                        
                                    </select>
                               </div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <div class="row">   
                           <div class="col-md-4">
                                <label>Pin Code</label><span>*</span>
                           </div>
                           <div class="col-md-8">
                                <input type="text" class="form-control" placeholder="Enter 6 Digit" name="pincode" id="pin_code" maxlength="6">
                           </div>
                         </div>
                    </div>
                    
                    
                </div>
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
                                    <?php if($da->id == 1 || $da->id == 2){ ?>
                                      <option value="<?php echo $da->id ?>"><?php echo $da->class ?></option>
                                    <?php } } ?>
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
                               <label>Agent / Pos</label>
                           </div>
                            <div class="col-md-8">
                                <select class="form-control select2" name="agent_pos" id="agent_pos">
                                    <option value="">--select--</option>
                                    <?php foreach($agents_pos as $da){?>
                                    <option value="<?php echo $da->id ?>"><?php echo $da->name."  (".$da->agent_pos_code.")" ?></option>
                                     
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
      </div>
</div>




<!--vechicle Details start -->

     <div class="box">
        <div class="box-header with-border" style="background:#f4f4f48c;">
            <h3 class="box-title" _msthash="26273" _msttexthash="60619" style="text-align: left;font-size:14px;"><i class="fa fa-bars" aria-hidden="true"></i> &nbsp;&nbsp; Vechicle Details </h3>
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
                               <label>Fuel Type</label>
                           </div>
                           <div class="col-md-8">
                              <select class="form-control" name="fuel_type" id="fuel_type">
                                    <option value="">--select--</option>
                                    <?php foreach($fuel_type as $da){?>
                                    <option value="<?php echo $da->id ?>"><?php echo $da->fuel_type; ?></option>
                                     
                                    <?php } ?>
                                </select>
                           </div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                               <label>Select State</label>
                           </div>
                           <div class="col-md-8">
                              <select onchange="commission_type_load()" class="form-control select2" name="agent_pos" id="state">
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
                                <label>GVW </label>
                            </div>
                        <div class="col-md-8">
                             <input type="text" class="form-control" name="v_gvw" id="v_gvw">
                        </div>
                        </div>
                    </div>      
                     
                    
              </div>
              
              <div class="col-md-6">
                  
                  
                  
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
                                <label>Year Of Manufature</label>
                            </div>
                        <div class="col-md-4">
                             <select class="form-control" name="vechi_manu_month" id="vechi_manuf_month">
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
                            <select class="form-control select2" id="vechi_manu_year" name="vechi_manu_year">
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
                                <label>Engine Number </label>
                            </div>
                        <div class="col-md-8">
                             <input type="text" class="form-control" name="vechi_engine_numb" id="vechi_engine_numb">
                        </div>
                        </div>
                    </div>  
                    
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                                <label>RTO</label><span>*</span>
                            </div>
                            <div class="col-md-8">
                                <select class="form-control select2" name="rto" id="rto">
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
                  
              </div>
          </div>
      </div>
    </div> 


<!--vechile Details End-->





    <div class="box">
        <div class="box-header with-border" style="background:#f4f4f48c;">
            <h3 class="box-title" _msthash="26273" _msttexthash="60619" style="text-align: left;font-size:14px;"><i class="fa fa-bars" aria-hidden="true"></i> &nbsp;&nbsp; Nominee Details </h3>
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
                               <label>Nominee Name </label><span>*</span>
                           </div>
                           <div class="col-md-8">
                               <input type="text" class="form-control" name="nominee_name" id="nominee_name">
                           </div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                               <label>Mobile Number</label><span>*</span>
                           </div>
                           <div class="col-md-8">
                               <input type="text" class="form-control" name="n_mobile_no" id="n_mobile_no">
                           </div>
                        </div>
                    </div>
                    
                </div>
                
                <div class="col-md-6">
                  
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                               <label>Adharcard Number</label><span>*</span>
                           </div>
                           <div class="col-md-8">
                               <input type="text" class="form-control" name="adharcard_no" id="adharcard_no">
                           </div>
                        </div>
                    </div>
        
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                               <label>Upload Adhar Card</label><span>*</span>
                           </div>
                           <div class="col-md-8">
                               <input type="file" class="form-control" name="n_adhar_card_upload" id="n_adhar_card_upload">
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
                    
                 <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                               <label>Insurence Company</label><span>*</span>
                           </div>
                           <div class="col-md-8">
                               <select onchange="commission_type_load()" class="form-control select2" name="company" id="company">
                                    <option value="">--select--</option>
                                    <?php foreach($company as $da){?>
                                    <option value="<?php echo $da->id ?>"><?php echo $da->company_name; ?></option>
                                     
                                    <?php } ?>
                                </select>
                           </div>
                        </div>
                   </div>
                    
                    
                    
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
                               <input type="date" class="form-control" name="policy_s_date" id="policy_s_date" value="<?php echo  date("Y-m-d") ?>">
                           </div>
                        </div>
                    </div>
                    
                     <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                               <label>Expiry Date</label>
                           </div>
                           <div class="col-md-8">
                               <input type="date" class="form-control" name="policy_ex_date" id="policy_ex_date">
                           </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                               <label>Premium Cover Type</label><span>*</span>
                           </div>
                           <div class="col-md-8">
                               <select class="form-control" name="policy_premium" id="policy_premium">
                                   <option value="">--Select--</option>
                                   <?php foreach($premium_cover_type as $da){?>
                                    <option value="<?php echo $da->id; ?>"><?php echo $da->name; ?></option>
                                    <?php } ?>
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
                                   <option value="Yearly">Yearly</option>
                               </select>
                           </div>
                        </div>
                    </div>
                    
                     <div class="form-group hidden" id="ncb_div">
                        <div class="row">
                            <div class="col-md-4">
                               <label>No Claim Bonus</label><span>*</span>
                           </div>
                           <div class="col-md-8">
                               <select class="form-control" name="ncb" id="ncb">
                                   <option value="">--Select--</option>
                                   <option value="Yes">Yes</option>
                                   <option value="No">No</option>
                               </select>
                           </div>
                        </div>
                    </div>
        
                <div class="form-group" id="vehicle_age_div">
                        <div class="row">
                            <div class="col-md-4">
                               <label>Vehicle Age</label><span>*</span>
                           </div>
                           <div class="col-md-8">
                               <input type="number" class="form-control" name="age" id="age">
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
            
            <div class="row" id="tp_and_od_div">
                <div class="col-md-6">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                               <label>Total Own Damage Premium</label>
                           </div>
                           <div class="col-md-8">
                              <input type="number" class="form-control" value="0" onkeyup="calculate_net_premium()" name="total_own_damage" id="total_own_damage">
                           </div>
                        </div>
                    </div>
                   
                </div>
                
                <div class="col-md-6">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                               <label>Total Third Party Premium</label>
                           </div>
                           <div class="col-md-8">
                              <input type="number" class="form-control"  onkeyup="calculate_net_premium()" value="0"  name="total_third_party" id="basic_tp">
                           </div>
                        </div>
                    </div>
                   
                </div>
                
                
            </div>
            
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                               <label>Sum Insured</label><span>*</span>
                           </div>
                           <div class="col-md-8">
                               <input type="number" value="0" class="form-control" name="sum_insured" id="sum_insured">
                           </div>
                        </div>
                      </div>
                
                </div>
                <div class="col-md-4">
                    
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                                <label>Net Premium</label><span>*</span>
                            </div>
                            <div class="col-md-8">
                                <input type="text" value="0" class="form-control" name="total_premium" id="total_premium">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                         <div class="form-group">
                            <div class="row">
                                <div class="col-md-4">
                                    <label>GST(18%)</label><span>*</span>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" value="0" class="form-control" name="gst" id="gst" disabled>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
            
      </div>
    </div> 
    
    <!--<div class="box">-->
    <!--    <div class="box-header with-border" style="background:#f4f4f48c;">-->
    <!--        <h3 class="box-title" _msthash="26273" _msttexthash="60619" style="text-align: left;font-size:14px;"><i class="fa fa-money" aria-hidden="true"></i> &nbsp;&nbsp; Commission Details </h3>-->
    <!--        <div class="box-tools pull-right">-->
    <!--             <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse">-->
    <!--              <i class="fa fa-minus"></i></button>-->
    <!--        </div>-->
    <!--    </div>-->
    <!--    <div class="box-body" _msthash="1196936" _msttexthash="1190501" style="text-align: left;">-->
            
    <!--        <div class="row">-->
    <!--            <div class="col-md-6">-->
    <!--                <div class="form-group">-->
    <!--                    <div class="row">-->
    <!--                        <div class="col-md-4">-->
    <!--                           <label>Insurence Company</label><span>*</span>-->
    <!--                       </div>-->
    <!--                       <div class="col-md-8">-->
    <!--                           <select onchange="commission_type_load()" class="form-control select2" name="company" id="company">-->
    <!--                                <option value="">--select--</option>-->
    <!--                                <?php foreach($company as $da){?>-->
    <!--                                <option value="<?php echo $da->id ?>"><?php echo $da->company_name; ?></option>-->
                                     
    <!--                                <?php } ?>-->
    <!--                            </select>-->
    <!--                       </div>-->
    <!--                    </div>-->
    <!--                  </div>-->
                
    <!--            </div>-->
                
    <!--            <div class="col-md-6" id="state_div">-->
    <!--                <div class="form-group">-->
    <!--                    <div class="row">-->
    <!--                        <div class="col-md-4">-->
    <!--                           <label>Select State</label>-->
    <!--                       </div>-->
    <!--                       <div class="col-md-8">-->
    <!--                          <select onchange="commission_type_load()" class="form-control select2" name="agent_pos" id="state">-->
    <!--                                <option value="">--select--</option>-->
    <!--                                <?php foreach($state as $da){?>-->
    <!--                                <option value="<?php echo $da->id ?>"><?php echo $da->name; ?></option>-->
                                     
    <!--                                <?php } ?>-->
    <!--                            </select>-->
    <!--                       </div>-->
    <!--                    </div>-->
    <!--                </div>-->
                   
    <!--            </div>-->
    <!--        </div>-->
            
    <!--        <div class="row" id="rto_and_ct_div">-->
                
    <!--            <div class="col-md-6">-->
                    
    <!--                <div class="form-group">-->
    <!--                    <div class="row">-->
    <!--                        <div class="col-md-4">-->
    <!--                            <label>RTO</label><span>*</span>-->
    <!--                        </div>-->
    <!--                        <div class="col-md-8">-->
    <!--                            <select onchange="commission_type_load()" class="form-control select2" name="rto" id="rto">-->
    <!--                                <option value="">--select--</option>-->
    <!--                                <?php foreach($rto as $da){?>-->
    <!--                                <option value="<?php echo $da->rto_no ?>"><?php echo $da->rto_no." ( ".$da->city." )"; ?></option>-->
                                     
    <!--                                <?php } ?>-->
    <!--                            </select>-->
    <!--                            </div>-->
    <!--                        </div>-->
    <!--                    </div>-->
                        
    <!--                </div>-->
                    
    <!--            <div class="col-md-6">-->
    <!--                     <div class="form-group">-->
    <!--                        <div class="row">-->
    <!--                            <div class="col-md-4">-->
    <!--                                <label>Commission Type</label><span>*</span>-->
    <!--                            </div>-->
    <!--                            <div class="col-md-8">-->
    <!--                                 <select onchange="commission_category_load()" class="form-control select2" name="commission_type" id="commission_type">-->
                                         
    <!--                                 </select>-->
    <!--                            </div>-->
    <!--                        </div>-->
    <!--                    </div>-->
    <!--                </div>-->
    <!--            </div>  -->
    <!--        <div class="row" id="cc_and_vc_div">-->
    <!--            <div class="col-md-6">-->
                    
    <!--                <div class="form-group">-->
    <!--                    <div class="row">-->
    <!--                        <div class="col-md-4">-->
    <!--                            <label>Commission Category</label><span>*</span>-->
    <!--                        </div>-->
    <!--                        <div class="col-md-8">-->
    <!--                            <select onchange="vehicle_classification_load()" class="form-control select2" name="rto" id="category">-->
    <!--                                <option value="">--select--</option>-->
    <!--                            </select>-->
    <!--                            </div>-->
    <!--                        </div>-->
    <!--                    </div>-->
    <!--                </div>-->
    <!--            <div class="col-md-6">-->
    <!--                     <div class="form-group">-->
    <!--                        <div class="row">-->
    <!--                            <div class="col-md-4">-->
    <!--                                <label>Vehicle Classification</label><span>*</span>-->
    <!--                            </div>-->
    <!--                            <div class="col-md-8">-->
    <!--                                 <select class="form-control select2" name="vehicle_classification" id="vehicle_classification">-->
                                         
    <!--                                 </select>-->
    <!--                            </div>-->
    <!--                        </div>-->
    <!--                    </div>-->
    <!--                </div>-->
    <!--            </div>      -->
    <!--        </div>-->
            
    <!--  </div>-->
    
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
                        <!--<th>Edit</th>-->
                        <!--<th>Delete</th>-->
                    </tr>
                </thead>
                <tbody id="table_view">
                </tbody>
            </table>
            <br>
            <div class="row">
                <div class="col-md-12">
                    <label>Upload Document</label>
                    <div class="form-group">
                          <input type="file" multiple="multiple" class="form-control" id="document_file" name="document_file[]">
                    </div>
                </div>
            </div>
    </div> 
    </div>

    </section><!-- /.content -->
  </div><!-- /.content-wrapper -->
  
 

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


 <script>
    var lead_id = $("#lead_id").val();
    var class_type = "";
    var arr = [];

    function vehicle_classification_load()
    {
        var state = $("#state").val();
        var company =$("#company").val();
        var rto = $("#rto").val();
        var policy_class = $("#policy_class").val();
        var bussiness_type = $("#bussiness_type").val();
        var policy_premium = $("#policy_premium").val();
        var commission_type = $("#commission_type").val();
        var age = $("#age").val();
        var category = $("#category").val();
        if(state != "" && company != "" && rto != "" && commission_type != "" && policy_class != "" && bussiness_type != "" && policy_premium != "")
        {
          $.ajax({
                url : "vehicle_classification_load",
                method : "POST",
                data:{
                    state:state,
                    company:company,
                    rto:rto,
                    policy_class:policy_class,
                    bussiness_type:bussiness_type,
                    policy_premium:policy_premium,
                    age:age,
                    category:category,
                },
                success:function(response)
                { 
                    var obj = jQuery.parseJSON(response);
                    if(obj.length > 1)
                    {
                        var str = "<option value=''>--Select--</option>";
                    }
                    else
                    {
                        var str = "";
                    }
                    for(var j=0;j<obj.length;j++)
                    {
                        str += "<option value='"+obj[j].id+"'>"+obj[j].motor_gvw+"</option>";
                    }
                    $("#vehicle_classification").html(str);
                }
          });
        }
    }
    
    function commission_category_load()
    {
         $("#category").html("");
        var state = $("#state").val();
        var company =$("#company").val();
        var rto = $("#rto").val();
        var policy_class = $("#policy_class").val();
        var bussiness_type = $("#bussiness_type").val();
        var policy_premium = $("#policy_premium").val();
        var commission_type = $("#commission_type").val();
        var age = $("#age").val();
        if(state != "" && company != "" && rto != "" && commission_type != "" && policy_class != "" && bussiness_type != "" && policy_premium != "")
        {
          $.ajax({
                url : "commission_category_load",
                method : "POST",
                data:{
                    state:state,
                    company:company,
                    rto:rto,
                    policy_class:policy_class,
                    bussiness_type:bussiness_type,
                    policy_premium:policy_premium,
                    age:age,
                },
                success:function(response)
                { 
                    var obj = jQuery.parseJSON(response);
                    if(obj.length > 1)
                    {
                        var str = "<option value=''>--Select--</option>";
                    }
                    else
                    {
                        var str = "";
                    }
                    for(var j=0;j<obj.length;j++)
                    {
                        str += "<option value='"+obj[j].id+"'>"+obj[j].motor_category+"</option>";
                    }
                    $("#category").html(str);
                    if(obj.length == 1)
                    {
                        vehicle_classification_load();
                    }
                }
          });
        }
    }
    
    function commission_type_load()
    { 
        $("#commission_type").html("");
        var state = $("#state").val();
        var company =$("#company").val();
        var rto = $("#rto").val();
        var policy_class = $("#policy_class").val();
        var bussiness_type = $("#bussiness_type").val();
        var policy_premium = $("#policy_premium").val();
        
        if(bussiness_type == "")
        {
            alert("Select Business Type");
        }
        else if(policy_class == "")
        {
            alert("Select Class");
        }
        else if(policy_premium == "")
        {
            alert("Select policy Premium Type");
        }
        else if(company == "")
        {
            alert("Select Insurance Company");
        }
        else if(state == "")
        {
            alert("Select State");
        }
        else if(rto == "")
        {
            alert("Select RTO");
        }
        else(state != "" && company != "" && rto != "" && policy_class != "" && bussiness_type != "" && policy_premium != "")
        {
          
          $.ajax({
                url : "commission_type_load",
                method : "POST",
                data:{
                    state:state,
                    company:company,
                    rto:rto,
                    policy_class:policy_class,
                    bussiness_type:bussiness_type,
                    policy_premium:policy_premium,
                },
                success:function(response)
                { 
                    var obj = jQuery.parseJSON(response);
                    if(obj.length > 1)
                    {
                        var str = "<option value=''>--Select--</option>";
                    }
                    else
                    {
                        var str = "";
                    }
                    for(var j=0;j<obj.length;j++)
                    {
                        str += "<option value='"+obj[j].id+"'>"+obj[j].type+"</option>";
                    }
                    $("#commission_type").html(str);
                    if(obj.length == 1)
                    {
                        commission_category_load();
                    }
                }
          });
        }
    }
    function fetch_health_insurance_company() 
   {
       var policy_premium = $("#policy_premium").val();
        var policy_class = $("#policy_class").val();
        if(policy_class == 2 && policy_premium == 1)
        { 
            $.ajax({
                url : "fetch_health_commission_company",
                method : "POST",
               data:{policy_premium:policy_premium},
               success:function(response)
               {
                   $("#company").html(response);
               },
               error:function(code)
               {
                    alert(code.statusText);   
               }
            });
        }
   }
   function calculate_net_premium()
   {
       var tp = $("#basic_tp").val();
       var od = $("#total_own_damage").val();
       if(tp != "" && od != "")
       {
           $("#total_premium").val(parseFloat(tp)+parseFloat(od));
           calculate_gst();
       }
       
   }
   function calculate_gst()
   {
        var total_premium =  $("#total_premium").val();
          if(total_premium != "")
          {
              $("#gst").val((total_premium * 18) / 100);
          }
          else
          {
              $("#gst").val("");
          }    
   }
   
     $(document).ready(function(){
         $('.select2').select2();
        
       
       $("#total_premium").keyup(function(){
          calculate_gst();
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
               if(policy_class == 1)
               {
                    $("#vehicle_age_div").removeClass("hidden");
                   $("#tp_and_od_div").removeClass("hidden");
                   $("#state_div").removeClass("hidden");
                   $("#rto_and_ct_div").removeClass("hidden");
                   $("#cc_and_vc_div").removeClass("hidden");
                   //$("#company").html(company_option);
               }
               else if(policy_class == 2)
               {
                   $("#vehicle_age_div").addClass("hidden");
                   $("#tp_and_od_div").addClass("hidden");
                   $("#state_div").addClass("hidden");
                   $("#rto_and_ct_div").addClass("hidden");
                   $("#cc_and_vc_div").addClass("hidden");
                   $("#policy_premium").val(1);
                   fetch_health_insurance_company();
               }
        });
        
        $("#vechi_manu_year").change(function(){
           cal_age();
        });
        
        $("#vechi_manuf_month").change(function(){
            cal_age();
        });
        
        $("#policy_premium").change(function(){
            fetch_health_insurance_company();
        });
        
        $("#save_btn").click(function(){
            
            var policy_client_ref_no = "";  
            var policy_cover_note_no = "";
            var policy_agency_pos = $("#agent_pos").val();
            var policy_source = $("#source").val();
            var client_type = $("#client_type").val();
            var client_name = $("#client_name").val();
            var mobile_no = $("#mobile_no").val();
            var bussiness_type = $("#bussiness_type").val();
            var policy_class = $("#policy_class").val();
            var policy_type = $("#policy_type").val();
            var pin = $("#pin_code").val();
            var premium_c_type = $("#premium_c_type").val();
            var business_type = $("#business_type").val();
           
            var policy_no  = $("#policy_no").val();
            var policy_s_date = $("#policy_s_date").val();
            var policy_ex_date = $("#policy_ex_date").val();
            var policy_premium = $("#policy_premium").val();
            var policy_terms = "";
            var payment_frequency = $("#payment_frequency").val();
            var next_due_date = $("#next_due_date").val();
            var renewable_flag = "";
            var add_ons_opted = "";
            var add_ons_not_opt = "";
            var sum_insured = $("#sum_insured").val();
            var discount_percent = "";
            var no_claim_bonus = "";
            var total_own_damage = $("#total_own_damage").val();
            var tot_add_on_premium = "";
            var commisson_base_premium = "";
            var basic_tp = $("#basic_tp").val();
            var owner_driver_pa = "";
            var owner_diver_amt = "";
            var no_of_year_own_drv = "";
            var fuel_kit = "";
            var fuel_kit_amt = "";
            var geograpical = "";
            var geograpical_amt = "";
            var un_named_passenger_pa = "";
            var un_named_passenger_amt = "";
            var no_seats_per_person = "";
            var no_seats_per_person_amt = "";
            var llp = "";
            var llp_amt = "";
            var no_drv_emp = "";
            var pa_paid_drv = "";
            var pa_paid_drv_amt = "";
            var no_seats_per_person1 = "";
            var no_seats_per_person_amt1 = "";
            var tot_liability_premium = "";
            var total_premium = $("#total_premium").val();
            var gst = $("#gst").val();
            var premium_gst = "";
            var policy_issue_date = $("#policy_issue_date").val();
            var policy_user = "";
            var policy_location = "";
            var previous_policy_no = "";
            var previous_insurer = "";
            var previous_insurance_plan = "";
            var previous_agency_pos = "";
            var previous_source = "";
            var dectable_details = "";
            var policy_additional_info = "";
            var reference_no = "";
            var other_reference_no = "";
            var policy_verified = "";
            var policy_verified_info = "";
            var policy_cancelled_info = "";
            var policy_cancelled = "";
            var policy_received = "";
            var commisson_generation = "";
            var payment_type = "";
            var pay_ref_no = "";
            var bank_name = "";
            var payment_check_date = "";
            var payment_and_check_no = "";
            var remarks = "";
            var payment_collected_date = "";
            
            var ncb = $("#ncb").val();
           
            
            var state = $("#state").val();
            var company =$("#company").val();
            var rto = $("#rto").val();
            var commission_type = $("#commission_type").val();
            var age = $("#age").val();
            var category = $("#category").val();
            var vehicle_classification = $("#vehicle_classification").val();
            var fuel_type = $("#fuel_type").val();

            //vechicle details start
            //var vechicle_type = $("#policy_type").val();
            var make = $("#vechi_make").val();
            var model = $("#vechi_model").val();
            var Varient = $("#vechi_varient").val();
            var cc = $("#vechi_cc").val();
            var v_gvw = $("#v_gvw").val();
            
            var regn_no_1 = $("#regn_no_1").val();
            var regn_no_2 = $("#regn_no_2").val();
            var regn_no_3 = $("#regn_no_2").val();
            var regn_no_4 = $("#regn_no_4").val();
            var register_no = regn_no_1+"-"+ regn_no_2 +"-"+ regn_no_3 +"-"+regn_no_4;
            var year_of_manu = $("#vechi_manuf_month").val();
            var engine_num = $("#vechi_engine_numb").val();
            
            // vechicle details End
           
            // nominee details 
            var nominee_name = $("#nominee_name").val();
            var adharcard_no = $("#adharcard_no").val();
            var n_mobile_no = $("#n_mobile_no").val();
             var n_adhar_card_upload = $("#n_adhar_card_upload").prop('files')[0];
            
            if(client_type == "")
            {
                snackbar_show("Select Client Type"); 
            }
            else if(bussiness_type == "")
            {
               snackbar_show("Select Bussiness Type");   
            }
            else if(client_name == "")
            {
               snackbar_show("Enter Client Name");   
            }
            else if(policy_class == "")
            {
                snackbar_show("Select Policy Class");
            }
            else if(mobile_no == "")
            {
                snackbar_show("Enter Mobile Number");
            }
            else if(policy_type == "")
            {
                 snackbar_show("Select Policy Type");
            }
            else if(policy_source == "")
            {
                 snackbar_show("Select Policy Source");
            }
            else if(policy_agency_pos == "")
            {
                 snackbar_show("Select Agent Or Pos");
            }
            else if(policy_no == "")
            {
                 snackbar_show("Enter Policy Number");
            }
            else if(policy_s_date == "")
            {
                 snackbar_show("Select Policy Start Date");
            }
            else if(policy_ex_date == "")
            {
                 snackbar_show("Select Policy Expiry Date");
            }
            else if(policy_premium == "")
            {
                 snackbar_show("Select Policy Cover Type");
            }
            else if(payment_frequency == "")
            {
                 snackbar_show("Select Payment Frequently");
            }
            else if(age == "" && policy_class == 1)
            {
                 snackbar_show("Enter Vehicle Age");
            }
            else if(total_own_damage == "" && policy_class == 1)
            {
                 snackbar_show("Enter Total Own Damage Value");
            }
            else if(basic_tp == "" && policy_class == 1)
            {
                 snackbar_show("Enter Third Party Value");
            }
            else if(sum_insured == "")
            {
                 snackbar_show("Enter Sum Insured Value");
            }
            else if(total_premium == "")
            {
                 snackbar_show("Enter Total Premium");
            }
            else if(company == "")
            {
                 snackbar_show("Select Insurance Company");
            }
            else if(rto == "" && policy_class == 1)
            {
                 snackbar_show("Select RTO");
            }
            else if(commission_type == "" && policy_class == 1)
            {
                 snackbar_show("Select Commission Type");
            }
            else if(category == "" && policy_class == 1)
            {
                 snackbar_show("Select Commission Category");
            }
            else if(vehicle_classification == "" && policy_class == 1)
            {
                 snackbar_show("Select Vehicle Classification");
            }
            else
            {
                var formdata = new FormData();
                formdata.append('lead_id',lead_id);
                
                var ins = document.getElementById('document_file').files.length;
                
                for(var x = 0;x<ins;x++) 
                {
                formdata.append("files[]", document.getElementById('document_file').files[x]);
                }
                
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
                formdata.append('previous_insurance_plan',previous_insurance_plan);
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
                formdata.append('payment_check_date',payment_check_date);
                formdata.append('payment_and_check_no',payment_and_check_no);
                formdata.append('remarks',remarks);
                formdata.append('payment_collected_date',payment_collected_date);
                formdata.append('fuel_type',fuel_type);
                formdata.append('ncb',ncb);
                
                
                formdata.append('client_type',client_type);
                formdata.append('client_name',client_name);
                formdata.append('mobile_no',mobile_no);
                formdata.append('pin_code',pin);
                formdata.append('bussiness_type',bussiness_type);
                formdata.append('policy_class',policy_class);
                formdata.append('policy_type',policy_type);
                
                formdata.append('state',state);
                formdata.append('company',company);
                formdata.append('rto',rto);
                formdata.append('commission_type',commission_type);
                formdata.append('age',age);
                formdata.append('category',category);//
                formdata.append('vehicle_classification',vehicle_classification);
                
                //formdata.append('vechile_type',vechicle_type);
                formdata.append('vechi_make',make);
                formdata.append('vechi_model',model);
                formdata.append('vechi_varient',Varient);
                formdata.append('vechi_cc',cc);
                formdata.append('vechi_register_no',register_no);
                formdata.append('vechi_manu_year',year_of_manu);
                formdata.append('vechi_engine_num',engine_num);
                formdata.append('v_gvw',v_gvw);
                
                // nominee details //
                
                formdata.append('nominee_name',nominee_name);
                formdata.append('adharcard_no',adharcard_no);
                formdata.append('n_mobile_no',n_mobile_no);
                formdata.append('n_adhar_card_upload',n_adhar_card_upload);
                
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
                              
                              if(obj.status == "success")
                              {
                                 formdata.append('commission_id',obj.id);
                                $.ajax({
                                    type:"POST",
                                    url:"save_manual_generated_policy",
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
                                });  
                              }
                              else
                              {
                                  alert("Commission Slab Not Exits");
                                  $("#save_btn").attr("disabled",false); 
                              }
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
        
     
       
        $("#upload_file").click(function(){
          //var lead_id = $("#lead_id").val();
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
       
    
       
       $("#submit_btn").click(function(){
        //var lead_id = $("#lead_id").val();
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
      
        // vechile addd start
       $("#policy_type").change(function(){
            var vechile_type = $("#policy_type").val();
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
            
            var vechile_type = $("#policy_type").val();
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
            
            var vechile_type = $("#policy_type").val();
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
        // vechicle add End
        
        $("#policy_s_date").change(function(){
           var policy_s_date = $("#policy_s_date").val();
        });
        
        
        $("#bussiness_type").change(function(){
            var bussiness_type = $("#bussiness_type").val();
            if(bussiness_type == "1" || bussiness_type == "2")
            {
                $("#ncb_div").removeClass("hidden");
            }
            else
            {
                $("#ncb_div").addClass("hidden");
                $("#ncb").val("");
            }
        });
    });
    
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
                total_liablity = parseInt(owner_diver_amt)+parseInt(owner_diver_amt);
            }
            
            var fuel_kit_amt = $("#fuel_kit_amt").val();
             
            if(fuel_kit_amt !="")
            {
                total_liablity = parseInt(fuel_kit_amt)+parseInt(total_liablity);
            }
            
            var geograpical_amt = $("#geograpical_amt").val();
            
            if(geograpical_amt !="")
            {
                total_liablity = parseInt(geograpical_amt)+parseInt(total_liablity);
            }
                
            var llp_amt = $("#llp_amt").val();
            
            if(llp_amt !="")
            {
                total_liablity = parseInt(llp_amt)+parseInt(total_liablity);
            }
            var pa_paid_drv_amt = $("#pa_paid_drv_amt").val();
            
            if(pa_paid_drv_amt !="")
            {
                total_liablity = parseInt(llp_amt)+parseInt(total_liablity);
            }
                
           $("#tot_liability_premium").val(total_liablity);
           
            var commisson_base_premium = $("#commisson_base_premium").val();
            var tot_liability_premium = $("#tot_liability_premium").val();
            total_premium = parseInt(commisson_base_premium)+parseInt(tot_liability_premium);
           $("#total_premium").val(total_premium);
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
      
      function cal_age()
      {
          var vechi_manuf_month = $("#vechi_manuf_month").val();
           var vechi_manu_year = $("#vechi_manu_year").val();
           
           if(vechi_manuf_month != "" && vechi_manu_year != "")
           {
               var date = vechi_manu_year+"-"+vechi_manuf_month+"-01";
                date = new Date(date);
                var today = new Date();
                var age = Math.floor((today-date) / (365.25 * 24 * 60 * 60 * 1000));
                $('#age').val(age);
           }
      }
      

 </script>
 
 
 <!--<script>-->
     
 <!--    $(document).ready(function(){-->
 <!--       $("#policy_s_date").change(function(){-->
            
 <!--           alert("test");-->
            
 <!--            var currentYear = (new Date).getFullYear();-->
             
 <!--            $("#policy_ex_date").change( (new Date).getFullYear() );-->
             
            <!--//  $('#policy_ex_date').data("DateTimePicker").date(date);-->
            
 <!--       });-->
         
 <!--    });-->
     
     
     
 <!--</script>-->
 
 <!--$(document).ready(function(){-->
 <!--         $('#policy_s_date').on('dp.change', function(){-->
 <!--       //   console.log(e.date);-->
        
 <!--       //   var year  = new Date(e.date).getFullYear();-->
 <!--       //   var month = new Date(e.date).getMonth();-->
 <!--       //   var day   = new Date(e.date).getDate();-->
 <!--          var date  = new Date(year + 1, month, day);-->
 <!--          $('#policy_ex_date').data("DateTimePicker").date(date);-->
           
 <!--        });-->
         
 <!--    });-->
 
 