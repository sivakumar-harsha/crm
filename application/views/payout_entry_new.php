<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<style>
    .form-control {
    display: block;
    width: 100%;
    height: 29px;
    padding: 4px 11px;
    x: ;
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
    font-size:16px;
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

.h4, h4 {
    font-size: 18px;
    color: #0988f7;
}
</style>

 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1 style="font-size: 17px;">
        Payout Commission
        <button data-toggle="modal" data-target="#add_model" style="margin-right:50px;" class="btn btn-primary btn-sm" id="add_mod">Add New</button>
        <button class="btn btn-danger btn-sm pull-right hidden" id="excel_export" onclick='export_excel()'><i class="fa fa-file-excel-o"></i> Export Excel</button>
      </h1>
    </section>
    
    
     <!-- Main content -->
    <section class="content">
      <!-- Default box -->
      <div class="box">
        <div class="box-body">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                <li class="active" id="motor_li"><a href="#tab_1" data-toggle="tab" aria-expanded="true" onclick="fetch_payout_commission_motor()">Motor</a></li>
                <li class="" id="health_li"><a href="#tab_2" data-toggle="tab" aria-expanded="false" onclick="fetch_payout_commission_health()">Health</a></li>
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
                <h4 class="modal-title text-center" style="color:#fff;">Payout Commission</h4>
            </div>
            <div class="modal-body">
                
                        <div class="form-group">
                            <label>Insurer Company</label>
                            <select class="form-control select2" style="width:100%;height:100%;" name="insurer_company" id="insurer_company">
                                <option value="">--Select--</option>
                                 <?php foreach($insurer_company as $da) { ?>
                                  <option value="<?php echo $da->id ?>"><?php echo $da->company_name ?></option>
                                <?php } ?>
                            </select>
                        </div>
                     
                     <div class="row">
                         <div class="col-md-6">
                                <div class="form-group">
                                    <label>Class</label>
                                    <select class="form-control" name="insurer_class" id="insurer_class">
                                        <option value="">--Select--</option>
                                         <?php foreach($class as $da) { if($da->id == "1" || $da->id == "2")
                                         {?>
                                          <option value="<?php echo $da->id ?>"><?php echo $da->class ?></option>
                                        <?php } } ?>
                                    </select>
                                </div>
                         </div>
                         <div class="col-md-6">
                                <div class="form-group">
                                    <label>Business Type</label>
                                    <select class="form-control" name="business_type" id="business_type">
                                        <option value="">--Select--</option>
                                         <?php foreach($business_type as $da) { ?>
                                          <option value="<?php echo $da->id ?>"><?php echo $da->bussiness_type ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                         </div>
                     </div>
                        
                    
                    <div class="row">
                    
                      <div class="col-md-6">
                          <div class="form-group">
                            <label>Premium Type</label>
                            <select class="form-control" name="premium_c_type" id="premium_c_type">
                                <option value="">--Select--</option>
                                <?php foreach($type as $da) { ?>
                                  <option value="<?php echo $da->id ?>"><?php echo $da->name ?></option>
                                <?php } ?>
                            </select>
                        </div>
                      </div>
                        
                       <div class="col-md-6">
                                <div class="form-group">
                                    <label>Commission Type</label>
                                    <select class="form-control" name="commission_type" id="commission_type">
                                        <option value="">--Select--</option>
                                         <?php foreach($commission_type as $da){  ?>
                                          <option value="<?php echo $da->id ?>"><?php echo $da->type ?></option>
                                         <?php } ?>
                                    </select>
                                </div>
                       </div> 
                      </div>
                     
                     <div class="row hidden" id="vehi_div">
                         <div class="col-md-4">
                                <div class="form-group">
                                    <label>Policy Type</label>
                                    <select class="form-control" name="add_policy_type" id="add_policy_type">
                                        <option value="">--Select--</option>
                                        <?php foreach($policy_type as $da) { ?>
                                          <option value="<?php echo $da->id ?>"><?php echo $da->policy_type ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                         </div>
                         
                         <div class="col-md-2">
                                <div class="form-group">
                                    <label>Vechicle Type</label>
                                    <select class="form-control" name="add_v_type" id="add_v_type">
                                        <option value="">--Select--</option>
                                        <option value="New">New</option>
                                        <option value="old">Old</option>
                                        <option value="Either">Either</option>
                                    </select>
                                </div>
                         </div>

                         <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Type</label>
                                        <select class="form-control" name="add_type" id="add_type">
                                            <option value="">--Select--</option>
                                            <option value="including">including</option>
                                            <option value="Excluding">Excluding</option>
                                        </select>
                                    </div>
                         </div>
                         
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Make</label>
                                <select class="form-control select2" name="add_make" id="add_make" multiple style="width:100%;height:100%;">
                                    <option value="">--Select--</option>
                                    <option value="all">All</option>
                                </select>
                            </div>
                        </div>
                         
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Model</label>
                                <select class="form-control select2" name="add_model_motor" id="add_model_motor" multiple style="width:100%;height:100%;">
                                    <option value="">--Select--</option>
                                    <option value="all">All</option>
                                </select>
                            </div>
                        </div>
                         
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Varient</label>
                                <select class="form-control select2" name="add_varient" id="add_varient" multiple style="width:100%;height:100%;">
                                    <option value="">--Select--</option>
                                    <option value="all">All</option>
                                </select>
                            </div>
                        </div>
                         
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Fuel Type</label>
                                <select class="form-control" name="add_fuel_type" id="add_fuel_type">
                                    <option value="">--Select--</option>
                                    <?php foreach($fuel_type as $da){  ?>
                                         <option value="<?php echo $da->id ?>"><?php echo $da->fuel_type ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                     </div> 
                     
                    <div class="row">
                        <div class="col-md-4 hidden" id="classification_hidden">
                                    <div class="form-group">
                                        <label>Vechicle Classification</label>
                                        <select class="form-control" name="ins_classification" id="ins_classification">
                                            <option value="">--Select--</option>
                                        </select>
                                    </div>
                         </div>
                        
                           <div class="col-md-4 hidden" id="state_hidden">
                                    <div class="form-group">
                                        <label>State</label>
                                        <select class="form-control" name="ins_state" id="ins_state">
                                            <option value="">--Select--</option>
                                            <?php foreach($state as $da) { ?>
                                              <option value="<?php echo $da->id ?>"><?php echo $da->name ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                           </div>
                           
                           
                           <div class="col-md-4 hidden" id="rto_hidden">
                               <div class="form-group">
                                        <label>RTO</label>
                                        <select class="form-control select2" name="ins_rto" id="ins_rto" multiple data-placeholder="Select a RTO" style="width:100%">
                                            <?php foreach($rto as $da) { ?>
                                              <option value="<?php echo $da->rto_no ?>"><?php echo $da->rto_no." (".$da->city.")" ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                           </div>
                           
                           <div class="col-md-4 hidden" id="no_of_policy_hidden">
                               <div class="form-group">
                                    <label>No of Policy</label>
                                    <input type="number" class="form-control" name="no_of_policy" id="no_of_policy">
                                </div>
                           </div>
                       </div>
                     
                    <div class="row hidden" id="vehi_age_div">
                        <div class="col-md-6">
                                  <div class="form-group">
                                    <label>Vehicle Age(Min)</label>
                                    <input type="number" class="form-control" name="vehicle_age_min" id="vehicle_age_min">
                                </div>
                          </div>
                          
                           <div class="col-md-6">
                                  <div class="form-group">
                                    <label>Vehicle Age(Max)</label>
                                    <input type="number" class="form-control" name="vehicle_age_max" id="vehicle_age_max">
                                </div>
                          </div>
                    </div>
                    
                     <div class="row hidden" id="no_policy_div">
                         
                         <div class="col-md-6">
                                  <div class="form-group">
                                    <label>Select Condition</label>
                                    <select class="form-control" name="add_condition" id="add_condition">
                                        <option value="">--Select--</option>
                                        <option value="greater_than_equal_to">Greater Than Equal To</option>
                                        <option value="less_than_equal_to">Less Than Equal To</option>
                                    </select>
                                </div>
                          </div>
                           <div class="col-md-6">
                                  <div class="form-group">
                                    <label>Number of Policy</label>
                                    <input type="number" class="form-control" name="no_policy" id="no_policy">
                                </div>
                          </div>
                    </div>
                    
                    
                    <div class="row hidden" id="target_amt_div">
                        <div class="col-md-6">
                                  <div class="form-group">
                                    <label>Minimum Amount</label>
                                    <input type="number" class="form-control" name="min_amount" id="min_amount">
                                </div>
                          </div>
                          
                           <div class="col-md-6">
                                  <div class="form-group">
                                    <label>Maximum Amount</label>
                                    <input type="number" class="form-control" name="max_amount" id="max_amount">
                                </div>
                          </div>
                    </div>
                       
                       
                    <div class="row hidden" id="min_max_hidden">
                        <div class="col-md-6">
                            <label>Min value</label>
                            <input type="text" class="form-control" id="min_val" name="min_val">
                        </div>
                        <div class="col-md-6">
                            <label>Max value</label>
                            <input type="text" class="form-control" id="max_val" name="max_val">
                        </div>
                    </div>
                   
                   <hr>
                   
                   <h4 class='text-center'><b>Company Commission</b></h4>
                   
                   <div class="row">
                       <div class="col-md-3">
                            <br>
                                <div class="form-check">
                                      <input class="form-check-input" type="checkbox" value="Yes" id="is_com_ncb">
                                      &nbsp;<b>ON NCB</b>
                                 </div>
                        </div>
                        
                        <div class="col-md-3 hidden">
                            <br>
                                <div class="form-check">
                                      <input class="form-check-input" type="checkbox" value="Yes" id="is_irda">
                                      &nbsp;<b>IRDA</b>
                                 </div>
                        </div>
                        
                        <div class="col-md-4 hidden" id="ncb_div_per">
                                <div class="form-group">
                                    <label>ON NCB</label>
                                        <input type="number" placeholder="Enter NCB Percentage" class="form-control" name="ncb_percentage" id="ncb_percentage" >
                                </div>
                          </div>
                   </div>
                   
                    <div class="row hidden" id="ird_div">
                         <div class="col-md-6">
                                <div class="form-group">
                                    <label>IRDA TP (%)</label>
                                        <input type="number" class="form-control" name="ird_com_tp" id="ird_com_tp"  readonly>
                                </div>
                          </div>
                          
                          <div class="col-md-6">
                                <div class="form-group">
                                    <label>IRDA OD (%)</label>
                                        <input type="number" class="form-control" name="ird_com_od" id="ird_com_od"  readonly>
                                </div>
                          </div>
                    </div>
                    
                    <div class="row" id="inc_div">
                        
                          <div class="col-md-4">
                                  <div class="form-group">
                                    <label>Own OD(%)</label>
                                    <input type="number" class="form-control" name="own_od" id="own_od" >
                                </div>
                          </div>
                          
                          <div class="col-md-4">
                                  <div class="form-group" id="own_tp_div">
                                    <label>Own Tp(%)</label>
                                    <input type="number" class="form-control" name="own_tp" id="own_tp" >
                                </div>
                          </div>

                          <div class="col-md-4">
                                <div class="form-group">
                                    <label>Own Net(%)</label>
                                        <input type="number" class="form-control" name="on_net" id="on_net" >
                                </div>
                          </div>
                    </div>
                    
                    <hr>
                    
                    <h4 class='text-center'><b>Agent Commission<b></h4>
                    
                    <div class="row">
                        <div class="col-md-6">
                                <div class="form-group">
                                    <label>Agent Commission Type</label>
                                        <select class="form-control"  id="agn_com_type" name="agn_com_type">
                                            <option value="">--select--</option>
                                            <option value="OD">OD</option>
                                            <option value="TP">TP</option>
                                            <option value="ON-NET">ON-NET</option>
                                            <option value="OD_AND_TP">OD_AND_TP</option>
                                        </select>
                                </div>
                        </div>
                        
                        <div class="col-md-6">
                                <div class="form-group">
                                    <label>Discount (%)</label>
                                        <input type="text" class="form-control" name="discount" id="discount">
                                </div>
                        </div>
                        
                    </div>
                    
                    <hr>

                    <div class="row hidden" id="od_div">
                        <div class="col-md-3">
                              <div class="form-group">
                                    <label>A(OD%)</label>
                                       <div class="input-group">
                                            <input type="number" class="form-control od" name="a_od" id="a_od">
                                            <span class="input-group-addon" id="a_od_span"></span>
                                       </div>
                                </div>
                          </div>
                          
                          <div class="col-md-3">
                              <div class="form-group">
                                    <label>B(OD%)</label>
                                    <div class="input-group">
                                        <input type="number" class="form-control od" name="b_od" id="b_od" >
                                        <span class="input-group-addon" id="b_od_span"></span>
                                     </div>
                                </div>
                            </div>   
                            
                          <div class="col-md-3">
                                <div class="form-group">
                                    <label>C(OD%)</label>
                                    <div class="input-group">
                                        <input type="number" class="form-control od" name="c_od" id="c_od" >
                                         <span class="input-group-addon" id="c_od_span"></span>
                                     </div>
                                </div>
                          </div>
                          
                           <div class="col-md-3">
                                <div class="form-group">
                                    <label>D(OD%)</label>
                                    <div class="input-group">
                                        <input type="number" class="form-control od" name="d_od" id="d_od" >
                                         <span class="input-group-addon" id="d_od_span"></span>
                                     </div>
                                </div>
                          </div>
                          
                    </div>
                    
                    <div class="row hidden" id="tp_div">
                        <div class="col-md-3">
                              <div class="form-group">
                                    <label>A(TP%)</label>
                                       <div class="input-group">
                                            <input type="number" class="form-control tp" name="a_tp" id="a_tp" >
                                            <span class="input-group-addon" id="a_tp_span"></span>
                                       </div>
                                </div>
                          </div>
                          
                          <div class="col-md-3">
                              <div class="form-group">
                                    <label>B(TP%)</label>
                                    <div class="input-group">
                                        <input type="number" class="form-control tp" name="b_tp" id="b_tp" >
                                        <span class="input-group-addon" id="b_tp_span"></span>
                                     </div>
                                </div>
                            </div>   
                            
                          <div class="col-md-3">
                                <div class="form-group">
                                    <label>C(TP%)</label>
                                    <div class="input-group">
                                        <input type="number" class="form-control tp" name="c_tp" id="c_tp" >
                                         <span class="input-group-addon" id="c_tp_span"></span>
                                     </div>
                                </div>
                          </div>
                          
                          <div class="col-md-3">
                                <div class="form-group">
                                    <label>D(TP%)</label>
                                    <div class="input-group">
                                        <input type="number" class="form-control tp" name="d_tp" id="d_tp" >
                                         <span class="input-group-addon" id="d_tp_span"></span>
                                     </div>
                                </div>
                          </div>
                          
                    </div>
                    
                    <div class="row hidden" id="net_div">
                        <div class="col-md-3">
                              <div class="form-group">
                                    <label>A(NET %)</label>
                                       <div class="input-group">
                                            <input type="number" class="form-control net" name="a_net" id="a_net" >
                                            <span class="input-group-addon" id="a_net_span"></span>
                                       </div>
                                </div>
                          </div>
                          
                          <div class="col-md-3">
                              <div class="form-group">
                                    <label>B(NET %)</label>
                                    <div class="input-group">
                                        <input type="number" class="form-control net" name="b_net" id="b_net" >
                                        <span class="input-group-addon" id="b_net_span"></span>
                                     </div>
                                </div>
                            </div>   
                            
                          <div class="col-md-3">
                                <div class="form-group">
                                    <label>C(NET %)</label>
                                    <div class="input-group">
                                        <input type="number" class="form-control net" name="c_net" id="c_net" >
                                         <span class="input-group-addon" id="c_net_span"></span>
                                     </div>
                                </div>
                          </div>
                          
                           <div class="col-md-3">
                                <div class="form-group">
                                    <label>D(NET %)</label>
                                    <div class="input-group">
                                        <input type="number" class="form-control net" name="d_net" id="d_net" >
                                         <span class="input-group-addon" id="d_net_span"></span>
                                     </div>
                                </div>
                          </div>
                    </div>
                    
                    <div class="row hidden" id="ncb_div">
                        <div class="col-md-3">
                              <div class="form-group">
                                    <label>A(NCB %)</label>
                                       <div class="input-group">
                                            <input type="number" class="form-control net" name="a_ncb" id="a_ncb" >
                                            <span class="input-group-addon" id="a_ncb_span"></span>
                                       </div>
                                </div>
                          </div>
                          
                          <div class="col-md-3">
                              <div class="form-group">
                                    <label>B(NCB %)</label>
                                    <div class="input-group">
                                        <input type="number" class="form-control net" name="b_ncb" id="b_ncb" >
                                        <span class="input-group-addon" id="b_ncb_span"></span>
                                     </div>
                                </div>
                            </div>   
                            
                          <div class="col-md-3">
                                <div class="form-group">
                                    <label>C(NCB %)</label>
                                    <div class="input-group">
                                        <input type="number" class="form-control net" name="c_ncb" id="c_ncb" >
                                         <span class="input-group-addon" id="c_ncb_span"></span>
                                     </div>
                                </div>
                          </div>
                          
                           <div class="col-md-3">
                                <div class="form-group">
                                    <label>D(NCB %)</label>
                                    <div class="input-group">
                                        <input type="number" class="form-control net" name="d_ncb" id="d_ncb" >
                                         <span class="input-group-addon" id="d_ncb_span"></span>
                                     </div>
                                </div>
                          </div>
                    </div>
                    
                    <div class="form-group">
                        <span id="err_span" style="color:red;"></span>
                    </div>
                </div> 
                
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-sm btn-primary" id="next_btn">Next <i class="fa fa-angle-double-right"></i></button>
                <button type="button" class="btn btn-sm btn-success" id="add_btn" disabled>Save changes</button>
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
                <h4 class="modal-title text-center" style="color:#fff;">Payout Commission</h4>
            </div>
            <div class="modal-body">
                
                        <div class="form-group">
                            <label>Insurer Company</label>
                            <select class="form-control select2" style="width:100%;height:100%;" name="insurer_company" id="edit_insurer_company">
                                <option value="">--Select--</option>
                                 <?php foreach($insurer_company as $da) { ?>
                                  <option value="<?php echo $da->id ?>"><?php echo $da->company_name ?></option>
                                <?php } ?>
                            </select>
                        </div>
                     
                     <div class="row">
                         <div class="col-md-6">
                                <div class="form-group">
                                    <label>Class</label>
                                    <select class="form-control" name="insurer_class" id="edit_insurer_class">
                                        <option value="">--Select--</option>
                                         <?php foreach($class as $da) { if($da->id == "1" || $da->id == "2")
                                         {?>
                                          <option value="<?php echo $da->id ?>"><?php echo $da->class ?></option>
                                        <?php } } ?>
                                    </select>
                                </div>
                         </div>
                         <div class="col-md-6">
                                <div class="form-group">
                                    <label>Business Type</label>
                                    <select class="form-control" name="business_type" id="edit_business_type">
                                        <option value="">--Select--</option>
                                         <?php foreach($business_type as $da) { ?>
                                          <option value="<?php echo $da->id ?>"><?php echo $da->bussiness_type ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                         </div>
                     </div>
                        
                    
                    <div class="row">
                    
                      <div class="col-md-6">
                          <div class="form-group">
                            <label>Premium Type</label>
                            <select class="form-control" name="premium_c_type" id="edit_premium_c_type">
                                <option value="">--Select--</option>
                                <?php foreach($type as $da) { ?>
                                  <option value="<?php echo $da->id ?>"><?php echo $da->name ?></option>
                                <?php } ?>
                            </select>
                        </div>
                      </div>
                        
                       <div class="col-md-6">
                                <div class="form-group">
                                    <label>Commission Type</label>
                                    <select class="form-control" name="commission_type" id="edit_commission_type">
                                        <option value="">--Select--</option>
                                         <?php foreach($commission_type as $da){  ?>
                                          <option value="<?php echo $da->id ?>"><?php echo $da->type ?></option>
                                         <?php } ?>
                                    </select>
                                </div>
                       </div> 
                      </div>
                     
                     <div class="row hidden" id="edit_vehi_div">
                         <div class="col-md-4">
                                <div class="form-group">
                                    <label>Policy Type</label>
                                    <select class="form-control" name="add_policy_type" id="edit_policy_type">
                                        <option value="">--Select--</option>
                                        <?php foreach($policy_type as $da) { ?>
                                          <option value="<?php echo $da->id ?>"><?php echo $da->policy_type ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                         </div>
                         
                         <div class="col-md-2">
                                <div class="form-group">
                                    <label>Vechicle Type</label>
                                    <select class="form-control" name="add_v_type" id="edit_v_type">
                                        <option value="">--Select--</option>
                                        <option value="New">New</option>
                                        <option value="old">Old</option>
                                        <option value="Either">Either</option>
                                    </select>
                                </div>
                         </div>

                         <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Type</label>
                                        <select class="form-control" name="add_type" id="edit_type">
                                            <option value="">--Select--</option>
                                            <option value="including">including</option>
                                            <option value="Excluding">Excluding</option>
                                        </select>
                                    </div>
                         </div>
                         
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Make</label>
                                <select class="form-control select2" name="add_make" id="edit_make" multiple style="width:100%;height:100%;">
                                    <option value="">--Select--</option>
                                    <option value="all">All</option>
                                </select>
                            </div>
                        </div>
                         
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Model</label>
                                <select class="form-control select2" name="add_model_motor" id="edit_model_motor" multiple style="width:100%;height:100%;">
                                    <option value="">--Select--</option>
                                    <option value="all">All</option>
                                </select>
                            </div>
                        </div>
                         
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Varient</label>
                                <select class="form-control select2" name="add_varient" id="edit_varient" multiple style="width:100%;height:100%;">
                                    <option value="">--Select--</option>
                                    <option value="all">All</option>
                                </select>
                            </div>
                        </div>
                         
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Fuel Type</label>
                                <select class="form-control" name="add_fuel_type" id="edit_fuel_type">
                                    <option value="">--Select--</option>
                                    <?php foreach($fuel_type as $da){  ?>
                                         <option value="<?php echo $da->id ?>"><?php echo $da->fuel_type ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                     </div> 
                     
                    <div class="row">
                        <div class="col-md-4 hidden" id="edit_classification_hidden">
                                    <div class="form-group">
                                        <label>Vechicle Classification</label>
                                        <select class="form-control" name="ins_classification" id="edit_ins_classification">
                                            <option value="">--Select--</option>
                                        </select>
                                    </div>
                         </div>
                        
                           <div class="col-md-4 hidden" id="edit_state_hidden">
                                    <div class="form-group">
                                        <label>State</label>
                                        <select class="form-control" name="ins_state" id="edit_ins_state">
                                            <option value="">--Select--</option>
                                            <?php foreach($state as $da) { ?>
                                              <option value="<?php echo $da->id ?>"><?php echo $da->name ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                           </div>
                           
                           
                           <div class="col-md-4 hidden" id="edit_rto_hidden">
                               <div class="form-group">
                                        <label>RTO</label>
                                        <select class="form-control select2" name="ins_rto" id="edit_ins_rto" multiple data-placeholder="Select a RTO" style="width:100%">
                                            <?php foreach($rto as $da) { ?>
                                              <option value="<?php echo $da->rto_no ?>"><?php echo $da->rto_no." (".$da->city.")" ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                           </div>
                           
                           <div class="col-md-4 hidden" id="edit_no_of_policy_hidden">
                               <div class="form-group">
                                    <label>No of Policy</label>
                                    <input type="number" class="form-control" name="no_of_policy" id="edit_no_of_policy">
                                </div>
                           </div>
                       </div>
                     
                    <div class="row hidden" id="edit_vehi_age_div">
                        <div class="col-md-6">
                                  <div class="form-group">
                                    <label>Vehicle Age(Min)</label>
                                    <input type="number" class="form-control" name="vehicle_age_min" id="edit_vehicle_age_min">
                                </div>
                          </div>
                          
                           <div class="col-md-6">
                                  <div class="form-group">
                                    <label>Vehicle Age(Max)</label>
                                    <input type="number" class="form-control" name="vehicle_age_max" id="edit_vehicle_age_max">
                                </div>
                          </div>
                    </div>
                    
                     <div class="row hidden" id="no_policy_div">
                         
                         <div class="col-md-6">
                                  <div class="form-group">
                                    <label>Select Condition</label>
                                    <select class="form-control" name="add_condition" id="edit_condition">
                                        <option value="">--Select--</option>
                                        <option value="greater_than_equal_to">Greater Than Equal To</option>
                                        <option value="less_than_equal_to">Less Than Equal To</option>
                                    </select>
                                </div>
                          </div>
                           <div class="col-md-6">
                                  <div class="form-group">
                                    <label>Number of Policy</label>
                                    <input type="number" class="form-control" name="no_policy" id="edit_no_policy">
                                </div>
                          </div>
                    </div>
                    
                    
                    <div class="row hidden" id="edit_target_amt_div">
                        <div class="col-md-6">
                                  <div class="form-group">
                                    <label>Minimum Amount</label>
                                    <input type="number" class="form-control" name="min_amount" id="edit_min_amount">
                                </div>
                          </div>
                          
                           <div class="col-md-6">
                                  <div class="form-group">
                                    <label>Maximum Amount</label>
                                    <input type="number" class="form-control" name="max_amount" id="edit_max_amount">
                                </div>
                          </div>
                    </div>
                       
                       <input class="hidden" type="text" id="edit_id">
                       
                    <div class="row hidden" id="edit_min_max_hidden">
                        <div class="col-md-6">
                            <label>Min value</label>
                            <input type="text" class="form-control" id="edit_min_val" name="edit_min_val">
                        </div>
                        <div class="col-md-6">
                            <label>Max value</label>
                            <input type="text" class="form-control" id="edit_max_val" name="edit_max_val">
                        </div>
                    </div>
                   
                   <hr>
                   
                   <h4 class='text-center'><b>Company Commission</b></h4>
                   
                   <div class="row">
                       <div class="col-md-3">
                            <br>
                                <div class="form-check">
                                      <input class="form-check-input" type="checkbox" value="Yes" id="edit_is_com_ncb">
                                      &nbsp;<b>ON NCB</b>
                                 </div>
                        </div>
                        
                        <div class="col-md-3 hidden">
                            <br>
                                <div class="form-check">
                                      <input class="form-check-input" type="checkbox" value="Yes" id="edit_is_irda">
                                      &nbsp;<b>IRDA</b>
                                 </div>
                        </div>
                        
                        <div class="col-md-4 hidden" id="edit_ncb_div_per">
                                <div class="form-group">
                                    <label>ON NCB</label>
                                        <input type="number" placeholder="Enter NCB Percentage" class="form-control" name="edit_ncb_percentage" id="edit_ncb_percentage" >
                                </div>
                          </div>
                   </div>
                   
                    <div class="row hidden" id="edit_ird_div">
                         <div class="col-md-6">
                                <div class="form-group">
                                    <label>IRDA TP (%)</label>
                                        <input type="number" class="form-control" name="ird_com_tp" id="edit_ird_com_tp"  readonly>
                                </div>
                          </div>
                          
                          <div class="col-md-6">
                                <div class="form-group">
                                    <label>IRDA OD (%)</label>
                                        <input type="number" class="form-control" name="ird_com_od" id="edit_ird_com_od"  readonly>
                                </div>
                          </div>
                    </div>
                    
                    <div class="row" id="inc_div">
                        
                          <div class="col-md-4">
                                  <div class="form-group">
                                    <label>Own OD(%)</label>
                                    <input type="number" class="form-control" name="own_od" id="edit_own_od" >
                                </div>
                          </div>
                          
                          <div class="col-md-4">
                                  <div class="form-group" id="edit_own_tp_div">
                                    <label>Own Tp(%)</label>
                                    <input type="number" class="form-control" name="own_tp" id="edit_own_tp" >
                                </div>
                          </div>

                          <div class="col-md-4">
                                <div class="form-group">
                                    <label>Own Net(%)</label>
                                        <input type="number" class="form-control" name="on_net" id="edit_on_net" >
                                </div>
                          </div>
                    </div>
                    
                    <hr>
                    
                    <h4 class='text-center'><b>Agent Commission<b></h4>
                    
                    <div class="row">
                        <div class="col-md-6">
                                <div class="form-group">
                                    <label>Agent Commission Type</label>
                                        <select class="form-control"  id="edit_agn_com_type" name="edit_agn_com_type">
                                            <option value="">--select--</option>
                                            <option value="OD">OD</option>
                                            <option value="TP">TP</option>
                                            <option value="ON-NET">ON-NET</option>
                                            <option value="OD_AND_TP">OD_AND_TP</option>
                                        </select>
                                </div>
                        </div>
                        
                        <div class="col-md-6">
                                <div class="form-group">
                                    <label>Discount (%)</label>
                                        <input type="text" class="form-control" name="discount" id="edit_discount">
                                </div>
                        </div>
                        
                    </div>
                    
                    <hr>

                    <div class="row hidden" id="edit_od_div">
                        <div class="col-md-3">
                              <div class="form-group">
                                    <label>A(OD%)</label>
                                       <div class="input-group">
                                            <input type="number" class="form-control edit_od" name="a_od" id="edit_a_od">
                                            <span class="input-group-addon" id="edit_a_od_span"></span>
                                       </div>
                                </div>
                          </div>
                          
                          <div class="col-md-3">
                              <div class="form-group">
                                    <label>B(OD%)</label>
                                    <div class="input-group">
                                        <input type="number" class="form-control edit_od" name="b_od" id="edit_b_od" >
                                        <span class="input-group-addon" id="edit_b_od_span"></span>
                                     </div>
                                </div>
                            </div>   
                            
                          <div class="col-md-3">
                                <div class="form-group">
                                    <label>C(OD%)</label>
                                    <div class="input-group">
                                        <input type="number" class="form-control edit_od" name="c_od" id="edit_c_od" >
                                         <span class="input-group-addon" id="edit_c_od_span"></span>
                                     </div>
                                </div>
                          </div>
                          
                           <div class="col-md-3">
                                <div class="form-group">
                                    <label>D(OD%)</label>
                                    <div class="input-group">
                                        <input type="number" class="form-control edit_od" name="d_od" id="edit_d_od" >
                                         <span class="input-group-addon" id="edit_d_od_span"></span>
                                     </div>
                                </div>
                          </div>
                          
                    </div>
                    
                    <div class="row hidden" id="edit_tp_div">
                        <div class="col-md-3">
                              <div class="form-group">
                                    <label>A(TP%)</label>
                                       <div class="input-group">
                                            <input type="number" class="form-control edit_tp" name="a_tp" id="edit_a_tp" >
                                            <span class="input-group-addon" id="edit_a_tp_span"></span>
                                       </div>
                                </div>
                          </div>
                          
                          <div class="col-md-3">
                              <div class="form-group">
                                    <label>B(TP%)</label>
                                    <div class="input-group">
                                        <input type="number" class="form-control edit_tp" name="b_tp" id="edit_b_tp" >
                                        <span class="input-group-addon" id="edit_b_tp_span"></span>
                                     </div>
                                </div>
                            </div>   
                            
                          <div class="col-md-3">
                                <div class="form-group">
                                    <label>C(TP%)</label>
                                    <div class="input-group">
                                        <input type="number" class="form-control edit_tp" name="c_tp" id="edit_c_tp" >
                                         <span class="input-group-addon" id="edit_c_tp_span"></span>
                                     </div>
                                </div>
                          </div>
                          
                          <div class="col-md-3">
                                <div class="form-group">
                                    <label>D(TP%)</label>
                                    <div class="input-group">
                                        <input type="number" class="form-control edit_tp" name="d_tp" id="edit_d_tp" >
                                         <span class="input-group-addon" id="edit_d_tp_span"></span>
                                     </div>
                                </div>
                          </div>
                          
                    </div>
                    
                    <div class="row hidden" id="edit_net_div">
                        <div class="col-md-3">
                              <div class="form-group">
                                    <label>A(NET %)</label>
                                       <div class="input-group">
                                            <input type="number" class="form-control edit_net" name="a_net" id="edit_a_net" >
                                            <span class="input-group-addon" id="edit_a_net_span"></span>
                                       </div>
                                </div>
                          </div>
                          
                          <div class="col-md-3">
                              <div class="form-group">
                                    <label>B(NET %)</label>
                                    <div class="input-group">
                                        <input type="number" class="form-control edit_net" name="b_net" id="edit_b_net" >
                                        <span class="input-group-addon" id="edit_b_net_span"></span>
                                     </div>
                                </div>
                            </div>   
                            
                          <div class="col-md-3">
                                <div class="form-group">
                                    <label>C(NET %)</label>
                                    <div class="input-group">
                                        <input type="number" class="form-control edit_net" name="c_net" id="edit_c_net" >
                                         <span class="input-group-addon" id="edit_c_net_span"></span>
                                     </div>
                                </div>
                          </div>
                          
                           <div class="col-md-3">
                                <div class="form-group">
                                    <label>D(NET %)</label>
                                    <div class="input-group">
                                        <input type="number" class="form-control edit_net" name="d_net" id="edit_d_net" >
                                         <span class="input-group-addon" id="edit_d_net_span"></span>
                                     </div>
                                </div>
                          </div>
                    </div>
                    
                    <div class="row hidden" id="edit_ncb_div">
                        <div class="col-md-3">
                              <div class="form-group">
                                    <label>A(NCB %)</label>
                                       <div class="input-group">
                                            <input type="number" class="form-control edit_net" name="a_ncb" id="edit_a_ncb" >
                                            <span class="input-group-addon" id="edit_a_ncb_span"></span>
                                       </div>
                                </div>
                          </div>
                          
                          <div class="col-md-3">
                              <div class="form-group">
                                    <label>B(NCB %)</label>
                                    <div class="input-group">
                                        <input type="number" class="form-control edit_net" name="b_ncb" id="edit_b_ncb" >
                                        <span class="input-group-addon" id="edit_b_ncb_span"></span>
                                     </div>
                                </div>
                            </div>   
                            
                          <div class="col-md-3">
                                <div class="form-group">
                                    <label>C(NCB %)</label>
                                    <div class="input-group">
                                        <input type="number" class="form-control edit_net" name="c_ncb" id="edit_c_ncb" >
                                         <span class="input-group-addon" id="edit_c_ncb_span"></span>
                                     </div>
                                </div>
                          </div>
                          
                           <div class="col-md-3">
                                <div class="form-group">
                                    <label>D(NCB %)</label>
                                    <div class="input-group">
                                        <input type="number" class="form-control edit_net" name="d_ncb" id="edit_d_ncb" >
                                         <span class="input-group-addon" id="edit_d_ncb_span"></span>
                                     </div>
                                </div>
                          </div>
                    </div>
                    
                    <div class="form-group">
                        <span id="err_span" style="color:red;"></span>
                    </div>
                </div> 
                
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-sm btn-primary" id="edit_btn">Save changes <i class="fa fa-angle-double-right"></i></button>
            </div>
        </div>
    </div>
  </div>
  
  <div id="view_model" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title text-center" style="color:#fff;">View Payout Commission Details</h4>
      </div>
      <div class="modal-body" id="view_payout_content">
       
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

  
  
  <script>
      
      $(document).ready(function(){
         $('.select2').select2();
         
         fetch_payout_commission_motor();
         
         $("#insurer_class").change(function(){
             var insurer_class = $("#insurer_class").val();
             
             if(insurer_class == "1")
             {
                 fetch_motor_list();
             }
             else if(insurer_class == "2")
             {
                 
             }
         });
         
         $("#add_policy_type").change(function(){
            
            var insurer_class = $("#insurer_class").val();
            
                if(insurer_class != "")
                {
                    fetch_make();
                    fetch_classification();
                }
                else
                {
                    alert("Select Class");
                }
             
         });
         

         
         $("#add_make").change(function(){
            fetch_model(); 
         });
         
         $("#add_model_motor").change(function(){
             fetch_varient();
         });
         
         $("#commission_type").change(function(){
             
             var commission_type = $("#commission_type").val();
             
             if(commission_type == "1")
             {
                 $("#vehi_age_div").addClass("hidden");
                 $("#no_policy_div").removeClass("hidden");
                 $("#target_amt_div").addClass("hidden");
                 $("#vehicle_age_min").val("");
                 $("#vehicle_age_max").val("");
                 $("#min_amount").val("");
                 $("#max_amount").val("");
             }
             else if(commission_type == "2")
             {
                 $("#vehi_age_div").removeClass("hidden");
                 $("#no_policy_div").addClass("hidden");
                 $("#target_amt_div").addClass("hidden");
                 $("#condition").val("");
                 $("#no_policy").val("");
                 $("#min_amount").val("");
                 $("#max_amount").val("");
             }
             else if(commission_type == "3")
             {
                 $("#vehi_age_div").addClass("hidden");
                 $("#no_policy_div").addClass("hidden");
                 $("#target_amt_div").removeClass("hidden");
                 $("#vehicle_age_min").val("");
                 $("#vehicle_age_max").val("");
                 $("#condition").val("");
                 $("#no_policy").val("");
             }
         });
        
         $("#is_com_ncb").change(function(){
              
              
              if($("#is_com_ncb").is(":checked"))
              {
                  $("#ird_div").removeClass("hidden");
                  $("#inc_div").addClass("hidden");
                  $("#ird_com_tp").val("2.5");
                  $("#ird_com_od").val("15");
              }
              else 
              {
                  $("#ird_div").addClass("hidden");
                  $("#inc_div").removeClass("hidden");
                  $("#ird_com_tp").val("0");
                  $("#ird_com_od").val("0");
              }
         });
         
        //  $("#add_fuel_type").change(function(){
        //       $("#ird_div").removeClass("hidden");
        //       $("#ird_com_tp").val("2.5");
        //       $("#ird_com_od").val("15");
        //  });
             
         $("#add_btn").click(function(){
                alert("All Payout Commissions are Stored Successfully"); 
                $(".form-control").val("");
                $("#input-group-addon").html("");
                $("#add_model").modal("toggle");
                fetch_payout_commission_motor();
             });
             
         $("#a_od").keyup(function(){
               var add_type = $("#add_type").val();
               var ird_com_od = $("#ird_com_od").val();
               var own_od = $("#own_od").val();
               var a_od = $("#a_od").val();
               
               if(add_type == "Excluding")
               {
                    $("#a_od_span").html("");
                         if(ird_com_od != "")
                          {
                              var commission = parseFloat(a_od) * parseFloat(100)/ird_com_od;
                              
                              $("#a_od_span").html(commission.toFixed(2) +" %");
                              
                          }
               }
               else
               {
                   $("#a_od_span").html("");
                      if(own_od != "")
                      {
                          var commission = parseFloat(a_od) * parseFloat(100)/own_od;
                          
                          $("#a_od_span").html(commission.toFixed(2) +" %");
                          
                      }
               }
            });
            
         $("#b_od").keyup(function(){
               var add_type = $("#add_type").val();
               
               var ird_com_od = $("#ird_com_od").val();
               var own_od = $("#own_od").val();
               var b_od = $("#b_od").val();
               
               if(add_type == "Excluding")
               {
                    $("#b_od_span").html("");
                         if(ird_com_od != "")
                          {
                              var commission = parseFloat(b_od) * parseFloat(100)/ird_com_od;
                              $("#b_od_span").html(commission.toFixed(2) +" %");
                          }
               }
               else
               {
                   $("#b_od_span").html("");
                      if(own_od != "")
                      {
                          var commission = parseFloat(b_od) * parseFloat(100)/own_od;
                          
                          $("#b_od_span").html(commission.toFixed(2) +" %");
                          
                      }
               }
               
                
            });
            
         $("#c_od").keyup(function(){
               var add_type = $("#add_type").val();
               
               var ird_com_od = $("#ird_com_od").val();
               var own_od = $("#own_od").val();
               var c_od = $("#c_od").val();
               
               if(add_type == "Excluding")
               {
                    $("#c_od_span").html("");
                         if(ird_com_od != "")
                          {
                              var commission = parseFloat(c_od) * parseFloat(100)/ird_com_od;
                              $("#c_od_span").html(commission.toFixed(2) +" %");
                          }
               }
               else
               {
                   $("#c_od_span").html("");
                      if(own_od != "")
                      {
                          var commission = parseFloat(c_od) * parseFloat(100)/own_od;
                          
                          $("#c_od_span").html(commission.toFixed(2) +" %");
                          
                      }
               }
               
                
            });
            
         $("#d_od").keyup(function(){
               var add_type = $("#add_type").val();
               
               var ird_com_od = $("#ird_com_od").val();
               var own_od = $("#own_od").val();
               var d_od = $("#d_od").val();
               
               if(add_type == "Excluding")
               {
                    $("#d_od_span").html("");
                         if(ird_com_od != "")
                          {
                              var commission = parseFloat(d_od) * parseFloat(100)/ird_com_od;
                              $("#c_od_span").html(commission.toFixed(2) +" %");
                          }
               }
               else
               {
                   $("#d_od_span").html("");
                      if(own_od != "")
                      {
                          var commission = parseFloat(d_od) * parseFloat(100)/own_od;
                          
                          $("#d_od_span").html(commission.toFixed(2) +" %");
                          
                      }
               }
               
                
            });
          
         $("#a_tp").keyup(function(){
               var add_type = $("#add_type").val();
               
               var ird_com_tp = $("#ird_com_tp").val();
               var own_tp = $("#own_tp").val();
               var a_tp = $("#a_tp").val();
               
               if(add_type == "Excluding")
               {
                    $("#a_tp_span").html("");
                    
                         if(ird_com_tp != "")
                          {
                              var commission = parseFloat(a_tp) * parseFloat(100)/ird_com_tp;
                              
                              $("#a_tp_span").html(commission.toFixed(2) +" %");
                              
                          }
               }
               else
               {
                   $("#a_tp_span").html("");
                      if(own_tp != "")
                      {
                          var commission = parseFloat(a_tp) * parseFloat(100)/own_tp;
                          
                          $("#a_tp_span").html(commission.toFixed(2) +" %");
                          
                      }
               }
               
                
            });
            
         $("#b_tp").keyup(function(){
               var add_type = $("#add_type").val();
               
               var ird_com_tp = $("#ird_com_tp").val();
               var own_tp = $("#own_tp").val();
               var b_tp = $("#b_tp").val();
               
               if(add_type == "Excluding")
               {
                    $("#b_tp_span").html("");
                         if(ird_com_tp != "")
                          {
                              var commission = parseFloat(b_tp) * parseFloat(100)/ird_com_tp;
                              $("#b_tp_span").html(commission.toFixed(2) +" %");
                          }
               }
               else
               {
                   $("#b_tp_span").html("");
                      if(own_tp != "")
                      {
                          var commission = parseFloat(b_tp) * parseFloat(100)/own_tp;
                          
                          $("#b_tp_span").html(commission.toFixed(2) +" %");
                          
                      }
               }
               
                
            });
            
         $("#c_tp").keyup(function(){
                 
               var add_type = $("#add_type").val();
               var ird_com_tp = $("#ird_com_tp").val();
               var own_tp = $("#own_tp").val();
               var c_tp = $("#c_tp").val();
               
               if(add_type == "Excluding")
               {
                    $("#c_tp_span").html("");
                         if(ird_com_tp != "")
                          {
                              var commission = parseFloat(c_tp) * parseFloat(100)/ird_com_tp;
                              $("#c_tp_span").html(commission.toFixed(2) +" %");
                          }
               }
               else
               {
                   $("#c_tp_span").html("");
                      if(own_tp != "")
                      {
                          var commission = parseFloat(c_tp) * parseFloat(100)/own_tp;
                          
                          $("#c_tp_span").html(commission.toFixed(2) +" %");
                      }
                }
            });
           
         $("#d_tp").keyup(function(){
               var add_type = $("#add_type").val();
               
               var ird_com_tp = $("#ird_com_tp").val();
               var own_tp = $("#own_tp").val();
               var d_tp = $("#d_tp").val();
               
               if(add_type == "Excluding")
               {
                    $("#d_tp_span").html("");
                         if(ird_com_od != "")
                          {
                              var commission = parseFloat(d_tp) * parseFloat(100)/ird_com_tp;
                              $("#d_tp_span").html(commission.toFixed(2) +" %");
                          }
               }
               else
               {
                   $("#d_tp_span").html("");
                      if(own_od != "")
                      {
                          var commission = parseFloat(d_tp) * parseFloat(100)/own_tp;
                          
                          $("#d_tp_span").html(commission.toFixed(2) +" %");
                          
                      }
               }
            });
    
         $("#a_net").keyup(function(){
               var add_type = $("#add_type").val();
    
               var on_net = $("#on_net").val();
               var a_net = $("#a_net").val();
               
               $("#a_net_span").html("");
               
                  if(on_net != "")
                  {
                      var commission = parseFloat(a_net) * parseFloat(100)/on_net;
                      
                      $("#a_net_span").html(commission.toFixed(2) +" %");
                      
                  }
            });
            
         $("#b_net").keyup(function(){
               var add_type = $("#add_type").val();
    
               var on_net = $("#on_net").val();
               var b_net = $("#b_net").val();
               
               $("#b_net_span").html("");
               
                  if(on_net != "")
                  {
                      var commission = parseFloat(b_net) * parseFloat(100)/on_net;
                      
                      $("#b_net_span").html(commission.toFixed(2) +" %");
                      
                  }
            });
            
         $("#c_net").keyup(function(){
               var add_type = $("#add_type").val();
    
               var on_net = $("#on_net").val();
               var c_net = $("#c_net").val();
               
               $("#c_net_span").html("");
               
                  if(on_net != "")
                  {
                      var commission = parseFloat(c_net) * parseFloat(100)/on_net;
                      
                      $("#c_net_span").html(commission.toFixed(2) +" %");
                      
                  }
            });
            
         $("#d_net").keyup(function(){
               var add_type = $("#add_type").val();
    
               var on_net = $("#on_net").val();
               var d_net = $("#d_net").val();
               
               $("#d_net_span").html("");
               
                  if(on_net != "")
                  {
                      var commission = parseFloat(d_net) * parseFloat(100)/on_net;
                      
                      $("#d_net_span").html(commission.toFixed(2) +" %");
                      
                  }
            });
    
         $("#agn_com_type").change(function(){
                
              var agn_com_type = $("#agn_com_type").val();
               
                if(agn_com_type == "OD")
                {
                   $("#od_div").removeClass("hidden");
                   $("#net_div").addClass("hidden");
                   $("#tp_div").addClass("hidden");
                   $(".tp").val("");
                   $(".net").val("");
                }
                else if(agn_com_type == "TP")
                {
                    $("#tp_div").removeClass("hidden");
                    $("#net_div").addClass("hidden");
                    $("#od_div").addClass("hidden");
                    $(".od").val("");
                    $(".net").val("");
                }
                else if(agn_com_type == "ON-NET")
                {
                    $("#net_div").removeClass("hidden");
                    $("#od_div").addClass("hidden");
                    $("#tp_div").addClass("hidden");
                    $(".od").val("");
                    $(".tp").val("");
                }
                else if(agn_com_type == "OD_AND_TP")
                {
                    $("#od_div").removeClass("hidden");
                    $("#tp_div").removeClass("hidden");
                    $("#net_div").addClass("hidden");
                    $(".net").val("");
                }
           });
           
         $("#is_com_ncb").change(function(){
               
               if($("#is_com_ncb").is(":checked"))
               {
                   $("#ncb_div_per").removeClass("hidden");
                   $("#ncb_div").removeClass("hidden");
               }
               else
               {
                    $("#ncb_div_per").addClass("hidden");
                    $("#ncb_div").addClass("hidden");
                    $("#ncb_percentage").val("");
               }
                    
           });
           
         $("#a_ncb").keyup(function(){
               
               var ncb_percentage = $("#ncb_percentage").val();
               var a_ncb = $("#a_ncb").val();
               
               if(ncb_percentage != "")
               {
                     var commission = parseFloat(a_ncb) * parseFloat(100)/ncb_percentage;
                      
                      $("#a_ncb_span").html(commission.toFixed(2) +" %");
               }
               
                
           });
           
          $("#b_ncb").keyup(function(){
               
               var ncb_percentage = $("#ncb_percentage").val();
               var b_ncb = $("#b_ncb").val();
               
               if(ncb_percentage != "")
               {
                     var commission = parseFloat(b_ncb) * parseFloat(100)/ncb_percentage;
                      
                      $("#b_ncb_span").html(commission.toFixed(2) +" %");
               }
               
                
           });
           
           
            $("#c_ncb").keyup(function(){
               
               var ncb_percentage = $("#ncb_percentage").val();
               var c_ncb = $("#c_ncb").val();
               
               if(ncb_percentage != "")
               {
                     var commission = parseFloat(c_ncb) * parseFloat(100)/ncb_percentage;
                      
                      $("#c_ncb_span").html(commission.toFixed(2) +" %");
               }
               
                
           });
           
            $("#d_ncb").keyup(function(){
               
               var ncb_percentage = $("#ncb_percentage").val();
               var d_ncb = $("#d_ncb").val();
               
               if(ncb_percentage != "")
               {
                     var commission = parseFloat(d_ncb) * parseFloat(100)/ncb_percentage;
                      
                      $("#d_ncb_span").html(commission.toFixed(2) +" %");
               }
               
                
           });
           
           
           $("#next_btn").click(function(){
             
             var insurer_company = $("#insurer_company").val();
             var insurer_class = $("#insurer_class").val();
             var business_type = $("#business_type").val();
             var premium_c_type = $("#premium_c_type").val();
             var policy_type  = $("#add_policy_type").val();
             var commission_type = $("#commission_type").val();
             var add_type = $("#add_type").val();
             var make = $("#add_make").val();
             var model = $("#add_model_motor").val();
             var varient = $("#add_varient").val();
             var fuel_type = $("#add_fuel_type").val();
             var v_type = $("#add_v_type").val();
             
             var ins_classification = $("#ins_classification").val();
             var ins_state = $("#ins_state").val();
             var ins_rto = $("#ins_rto").val();
             var vehicle_age_max = $("#vehicle_age_max").val();
             var vehicle_age_min = $("#vehicle_age_min").val();
             
             var min_amount = $("#min_amount").val();
             var max_amount = $("#max_amount").val();
             
             // including
             var own_od = $("#own_od").val();
             var own_tp = $("#own_tp").val();
             var on_net = $("#on_net").val();
             //
             
             // Excluding
             var ncb_percentage = $("#ncb_percentage").val();
             var ird_com_od = $("#ird_com_od").val();
             var ird_com_tp = $("#ird_com_tp").val();
             //
             
             // agent commission
             
             if($("#is_com_ncb").is(":checked"))
             {
                 var is_com_ncb = "Yes";
             }
             else
             {
                 var is_com_ncb = "No";
             }
             
             var agn_com_non_ncb = $("#agn_com_type").val();
             var discount = $("#discount").val();
             
             
             // nop 
             
             var condition = $("#add_condition").val();
             var no_policy = $("#no_policy").val();
             
             
             //Own Damage Agent Commission 
             var a_od = $("#a_od").val();
             var b_od = $("#b_od").val();
             var c_od = $("#c_od").val();
             var d_od = $("#d_od").val();
             // Tp Agent Commission
             
             var a_tp = $("#a_tp").val();
             var b_tp = $("#b_tp").val();
             var c_tp = $("#c_tp").val();
             var d_tp = $("#d_tp").val();
             
             // NET Agent Commission
             var a_net = $("#a_net").val();
             var b_net = $("#b_net").val();
             var c_net = $("#c_net").val();
             var d_net = $("#d_net").val();
             
             // NCB
             var a_ncb = $("#a_ncb").val();
             var b_ncb = $("#b_ncb").val();
             var c_ncb = $("#c_ncb").val();
             var d_ncb = $("#d_ncb").val();
            
             var formdata = new FormData();
             formdata.append('insurer_company',insurer_company);
             formdata.append('insurer_class',insurer_class);
             formdata.append('business_type',business_type);
             formdata.append('premium_c_type',premium_c_type);
             formdata.append('policy_type',policy_type);
             formdata.append('commission_type',commission_type);
             formdata.append('add_type',add_type);
             formdata.append('make',make);
             formdata.append('model',model);
             formdata.append('varient',varient);
             formdata.append('fuel_type',fuel_type);
             formdata.append('v_type',v_type);
             formdata.append('ins_classification',ins_classification);
             formdata.append('ins_state',ins_state);
             formdata.append('ins_rto',ins_rto);
             formdata.append('vehicle_age_min',vehicle_age_min);
             formdata.append('vehicle_age_max',vehicle_age_max);
             
             formdata.append('agn_com_non_ncb',agn_com_non_ncb);
             formdata.append('is_com_ncb',is_com_ncb);
             
             
            // including
            formdata.append('own_od',own_od);
            formdata.append('own_tp',own_tp);
            formdata.append('on_net',on_net);
             
            // Excluding
            formdata.append('ncb_percentage',ncb_percentage);
            formdata.append('ird_com_od',ird_com_od);
            formdata.append('ird_com_tp',ird_com_tp);
             
             
             // OD Agent Commission
             formdata.append('a_od',a_od);
             formdata.append('b_od',b_od);
             formdata.append('c_od',c_od);
             formdata.append('d_od',d_od);
             // Tp Agent Commission
             
             formdata.append('a_tp',a_tp);
             formdata.append('b_tp',b_tp);
             formdata.append('c_tp',c_tp);
             formdata.append('d_tp',d_tp);
             
             // NET Agent Commission
             formdata.append('a_net',a_net);
             formdata.append('b_net',b_net);
             formdata.append('c_net',c_net);
             formdata.append('d_net',d_net);
             
             // NCB
             formdata.append('a_ncb',a_ncb);
             formdata.append('b_ncb',b_ncb);
             formdata.append('c_ncb',c_ncb);
             formdata.append('d_ncb',d_ncb);
             
              // nop 
             formdata.append('condition',condition);
             formdata.append('no_policy',no_policy);
             
             // target
             formdata.append('min_amount',min_amount);
             formdata.append('max_amount',max_amount);
             
             
             $.ajax({
                        url : "check_payout_entry_already_exits",
                        method : "POST",
                        data:formdata,
                        processData:false,  
                        contentType:false,
                        cache:false,
                        dataType:'text',
                        beforeSend:function(){
                            $("#next_btn").attr("disabled",true);
                        },
                        success:function(response)
                        {
                            $("#next_btn").attr("disabled",false);
                            
                            var obj = jQuery.parseJSON(response);
                            
                            if(obj.status != "success")
                            {
                                alert(obj.status);
                            }
                            else if(obj.status == "success")
                            {
                                if(obj.no_policy_id != "")
                                {
                                    formdata.append('no_policy_id',obj.no_policy_id);
                                }
                                else
                                {
                                    formdata.append('no_policy_id',"");
                                }
                                
                                  $.ajax({
                                    url : "add_payout_entry",
                                    method : "POST",
                                    data:formdata,
                                    processData:false,  
                                    contentType:false,
                                    cache:false,
                                    dataType:'text',
                                    beforeSend:function(){
                                        $("#next_btn").attr("disabled",true);
                                    },
                                    success:function(response)
                                    {
                                        alert("success");
                                        $("#next_btn").attr("disabled",false);
                                        $("#add_btn").attr("disabled",false);
                                        $("#ins_state").val("");
                                        $("#ins_rto").val("");
                                        $("#ins_rto").trigger("change");
                                        $("#vehicle_age_min").val("");
                                        $("#vehicle_age_max").val("");
                                        $("#ncb_percentage").val("");
                                        $("#ins_classification").val();
                                        $("#own_od").val("");
                                        $("#own_tp").val("");
                                        $("#on_net").val("");
                                        $("#agn_com_type").val("");
                                        $("#discount").val("");
                                        $("#a_od").val("");
                                        $("#b_od").val("");
                                        $("#c_od").val("");
                                        $("#d_od").val("");
                                        $("#a_tp").val("");
                                        $("#b_tp").val("");
                                        $("#c_tp").val("");
                                        $("#d_tp").val("");
                                        $("#a_net").val("");
                                        $("#b_net").val("");
                                        $("#c_net").val("");
                                        $("#d_net").val("");
                                        $("#a_ncb").val("");
                                        $("#b_ncb").val("");
                                        $("#c_ncb").val("");
                                        $("#d_ncb").val("");
                                        $(".input-group-addon").html("");
                                    }
                            });
                            }
                        },
             });
         });
         
         //Edit
         $("#edit_policy_type").change(function(){
            
            var insurer_class = $("#edit_insurer_class").val();
            
                if(insurer_class != "")
                {
                    edit_fetch_make();
                    edit_fetch_classification();
                }
                else
                {
                    alert("Select Class");
                }
         });
          $("#edit_make").change(function(){
            edit_fetch_model(); 
         });
         
         $("#edit_model_motor").change(function(){
             edit_fetch_varient();
         });
         
         
         $("#edit_commission_type").change(function(){
             
             var commission_type = $("#edit_commission_type").val();
             
             if(commission_type == "1")
             {
                 $("#edit_vehi_age_div").addClass("hidden");
                 $("#edit_no_policy_div").removeClass("hidden");
                 $("#edit_target_amt_div").addClass("hidden");
                 $("#edit_vehicle_age_min").val("");
                 $("#edit_vehicle_age_max").val("");
                 $("#edit_min_amount").val("");
                 $("#edit_max_amount").val("");
             }
             else if(commission_type == "2")
             {
                 $("#edit_vehi_age_div").removeClass("hidden");
                 $("#edit_no_policy_div").addClass("hidden");
                 $("#edit_target_amt_div").addClass("hidden");
                 $("#edit_condition").val("");
                 $("#edit_no_policy").val("");
                 $("#edit_min_amount").val("");
                 $("#edit_max_amount").val("");
             }
             else if(commission_type == "3")
             {
                 $("#edit_vehi_age_div").addClass("hidden");
                 $("#edit_no_policy_div").addClass("hidden");
                 $("#edit_target_amt_div").removeClass("hidden");
                 $("#edit_vehicle_age_min").val("");
                 $("#edit_vehicle_age_max").val("");
                 $("#edit_condition").val("");
                 $("#edit_no_policy").val("");
             }
         });
        
         $("#edit_is_com_ncb").change(function(){
              
              
              if($("#edit_is_com_ncb").is(":checked"))
              {
                  $("#edit_ird_div").removeClass("hidden");
                  $("#edit_inc_div").addClass("hidden");
                  $("#edit_ird_com_tp").val("2.5");
                  $("#edit_ird_com_od").val("15");
              }
              else 
              {
                  $("#edit_ird_div").addClass("hidden");
                  $("#edit_inc_div").removeClass("hidden");
                  $("#edit_ird_com_tp").val("0");
                  $("#edit_ird_com_od").val("0");
              }
         });
         
        //  $("#add_fuel_type").change(function(){
        //       $("#ird_div").removeClass("hidden");
        //       $("#ird_com_tp").val("2.5");
        //       $("#ird_com_od").val("15");
        //  });
             
             
         $("#edit_a_od").keyup(function(){
               var add_type = $("#edit_type").val();
               var ird_com_od = $("#edit_ird_com_od").val();
               var own_od = $("#edit_own_od").val();
               var a_od = $("#edit_a_od").val();
               
               if(add_type == "Excluding")
               {
                    $("#edit_a_od_span").html("");
                     if(ird_com_od != "")
                      {
                          var commission = parseFloat(a_od) * parseFloat(100)/ird_com_od;
                          $("#edit_a_od_span").html(commission.toFixed(2) +" %");
                      }
               }
               else
               {
                   $("#edit_a_od_span").html("");
                      if(own_od != "")
                      {
                          var commission = parseFloat(a_od) * parseFloat(100)/own_od;
                          
                          $("#edit_a_od_span").html(commission.toFixed(2) +" %");
                          
                      }
               }
            });
            
         $("#edit_b_od").keyup(function(){
               var add_type = $("#edit_type").val();
               
               var ird_com_od = $("#edit_ird_com_od").val();
               var own_od = $("#edit_own_od").val();
               var b_od = $("#edit_b_od").val();
               
               if(add_type == "Excluding")
               {
                    $("#edit_b_od_span").html("");
                         if(ird_com_od != "")
                          {
                              var commission = parseFloat(b_od) * parseFloat(100)/ird_com_od;
                              $("#edit_b_od_span").html(commission.toFixed(2) +" %");
                          }
               }
               else
               {
                   $("#edit_b_od_span").html("");
                      if(own_od != "")
                      {
                          var commission = parseFloat(b_od) * parseFloat(100)/own_od;
                          
                          $("#edit_b_od_span").html(commission.toFixed(2) +" %");
                          
                      }
               }
               
                
            });
            
         $("#edit_c_od").keyup(function(){
               var add_type = $("#edit_type").val();
               
               var ird_com_od = $("#edit_ird_com_od").val();
               var own_od = $("#edit_own_od").val();
               var c_od = $("#edit_c_od").val();
               
               if(add_type == "Excluding")
               {
                    $("#edit_c_od_span").html("");
                         if(ird_com_od != "")
                          {
                              var commission = parseFloat(c_od) * parseFloat(100)/ird_com_od;
                              $("#edit_c_od_span").html(commission.toFixed(2) +" %");
                          }
               }
               else
               {
                   $("#edit_c_od_span").html("");
                      if(own_od != "")
                      {
                          var commission = parseFloat(c_od) * parseFloat(100)/own_od;
                          $("#edit_c_od_span").html(commission.toFixed(2) +" %");
                      }
               }
               
                
            });
            
         $("#edit_d_od").keyup(function(){
               var add_type = $("#edit_type").val();
               
               var ird_com_od = $("#edit_ird_com_od").val();
               var own_od = $("#edit_own_od").val();
               var d_od = $("#edit_d_od").val();
               
               if(add_type == "Excluding")
               {
                    $("#edit_d_od_span").html("");
                         if(ird_com_od != "")
                          {
                              var commission = parseFloat(d_od) * parseFloat(100)/ird_com_od;
                              $("#edit_c_od_span").html(commission.toFixed(2) +" %");
                          }
               }
               else
               {
                   $("#edit_d_od_span").html("");
                      if(own_od != "")
                      {
                          var commission = parseFloat(d_od) * parseFloat(100)/own_od;
                          
                          $("#edit_d_od_span").html(commission.toFixed(2) +" %");
                          
                      }
               }
               
                
            });
          
         $("#edit_a_tp").keyup(function(){
               var add_type = $("#edit_type").val();
               
               var ird_com_tp = $("#edit_ird_com_tp").val();
               var own_tp = $("#edit_own_tp").val();
               var a_tp = $("#edit_a_tp").val();
               
               if(add_type == "Excluding")
               {
                    $("#edit_a_tp_span").html("");
                    
                         if(ird_com_tp != "")
                          {
                              var commission = parseFloat(a_tp) * parseFloat(100)/ird_com_tp;
                              
                              $("#edit_a_tp_span").html(commission.toFixed(2) +" %");
                              
                          }
               }
               else
               {
                   $("#edit_a_tp_span").html("");
                      if(own_tp != "")
                      {
                          var commission = parseFloat(a_tp) * parseFloat(100)/own_tp;
                          
                          $("#edit_a_tp_span").html(commission.toFixed(2) +" %");
                          
                      }
               }
               
                
            });
            
         $("#b_tp").keyup(function(){
               var add_type = $("#edit_type").val();
               
               var ird_com_tp = $("#edit_ird_com_tp").val();
               var own_tp = $("#edit_own_tp").val();
               var b_tp = $("#edit_b_tp").val();
               
               if(add_type == "Excluding")
               {
                    $("#edit_b_tp_span").html("");
                         if(ird_com_tp != "")
                          {
                              var commission = parseFloat(b_tp) * parseFloat(100)/ird_com_tp;
                              $("#edit_b_tp_span").html(commission.toFixed(2) +" %");
                          }
               }
               else
               {
                   $("#edit_b_tp_span").html("");
                      if(own_tp != "")
                      {
                          var commission = parseFloat(b_tp) * parseFloat(100)/own_tp;
                          
                          $("#edit_b_tp_span").html(commission.toFixed(2) +" %");
                          
                      }
               }
               
                
            });
            
         $("#edit_c_tp").keyup(function(){
                 
               var add_type = $("#edit_type").val();
               var ird_com_tp = $("#edit_ird_com_tp").val();
               var own_tp = $("#edit_own_tp").val();
               var c_tp = $("#edit_c_tp").val();
               
               if(add_type == "Excluding")
               {
                    $("#edit_c_tp_span").html("");
                         if(ird_com_tp != "")
                          {
                              var commission = parseFloat(c_tp) * parseFloat(100)/ird_com_tp;
                              $("#edit_c_tp_span").html(commission.toFixed(2) +" %");
                          }
               }
               else
               {
                   $("#edit_c_tp_span").html("");
                      if(own_tp != "")
                      {
                          var commission = parseFloat(c_tp) * parseFloat(100)/own_tp;
                          
                          $("#edit_c_tp_span").html(commission.toFixed(2) +" %");
                      }
                }
            });
           
         $("#edit_d_tp").keyup(function(){
               var add_type = $("#edit_type").val();
               
               var ird_com_tp = $("#edit_ird_com_tp").val();
               var own_tp = $("#edit_own_tp").val();
               var d_tp = $("#edit_d_tp").val();
               
               if(add_type == "Excluding")
               {
                    $("#edit_d_tp_span").html("");
                         if(ird_com_od != "")
                          {
                              var commission = parseFloat(d_tp) * parseFloat(100)/ird_com_tp;
                              $("#edit_d_tp_span").html(commission.toFixed(2) +" %");
                          }
               }
               else
               {
                   $("#edit_d_tp_span").html("");
                      if(own_od != "")
                      {
                          var commission = parseFloat(d_tp) * parseFloat(100)/own_tp;
                          
                          $("#edit_d_tp_span").html(commission.toFixed(2) +" %");
                          
                      }
               }
            });
    
         $("#edit_a_net").keyup(function(){
               var add_type = $("#edit_type").val();
    
               var on_net = $("#edit_on_net").val();
               var a_net = $("#edit_a_net").val();
               
               $("#edit_a_net_span").html("");
               
                  if(on_net != "")
                  {
                      var commission = parseFloat(a_net) * parseFloat(100)/on_net;
                      
                      $("#edit_a_net_span").html(commission.toFixed(2) +" %");
                      
                  }
            });
            
         $("#edit_b_net").keyup(function(){
               var add_type = $("#edit_type").val();
    
               var on_net = $("#edit_on_net").val();
               var b_net = $("#edit_b_net").val();
               
               $("#edit_b_net_span").html("");
               
                  if(on_net != "")
                  {
                      var commission = parseFloat(b_net) * parseFloat(100)/on_net;
                      
                      $("#edit_b_net_span").html(commission.toFixed(2) +" %");
                      
                  }
            });
            
         $("#edit_c_net").keyup(function(){
               var add_type = $("#edit_type").val();
    
               var on_net = $("#edit_on_net").val();
               var c_net = $("#edit_c_net").val();
               
               $("#edit_c_net_span").html("");
               
                  if(on_net != "")
                  {
                      var commission = parseFloat(c_net) * parseFloat(100)/on_net;
                      
                      $("#edit_c_net_span").html(commission.toFixed(2) +" %");
                      
                  }
            });
            
         $("#edit_d_net").keyup(function(){
               var add_type = $("#edit_type").val();
    
               var on_net = $("#edit_on_net").val();
               var d_net = $("#edit_d_net").val();
               
               $("#edit_d_net_span").html("");
               
                  if(on_net != "")
                  {
                      var commission = parseFloat(d_net) * parseFloat(100)/on_net;
                      
                      $("#edit_d_net_span").html(commission.toFixed(2) +" %");
                      
                  }
            });
    
         $("#edit_agn_com_type").change(function(){
                
              var agn_com_type = $("#edit_agn_com_type").val();
               
                if(agn_com_type == "OD")
                {
                   $("#edit_od_div").removeClass("hidden");
                   $("#edit_net_div").addClass("hidden");
                   $("#edit_tp_div").addClass("hidden");
                   $(".edit_tp").val("");
                   $(".edit_net").val("");
                }
                else if(agn_com_type == "TP")
                {
                    $("#edit_tp_div").removeClass("hidden");
                    $("#edit_net_div").addClass("hidden");
                    $("#edit_od_div").addClass("hidden");
                    $(".edit_od").val("");
                    $(".edit_net").val("");
                }
                else if(agn_com_type == "ON-NET")
                {
                    $("#edit_net_div").removeClass("hidden");
                    $("#edit_od_div").addClass("hidden");
                    $("#edit_tp_div").addClass("hidden");
                    $(".edit_od").val("");
                    $(".edit_tp").val("");
                }
                else if(agn_com_type == "OD_AND_TP")
                {
                    $("#edit_od_div").removeClass("hidden");
                    $("#edit_tp_div").removeClass("hidden");
                    $("#edit_net_div").addClass("hidden");
                    $(".edit_net").val("");
                }
           });
           
         $("#edit_is_com_ncb").change(function(){
               if($("#edit_is_com_ncb").is(":checked"))
               {
                   $("#edit_ncb_div_per").removeClass("hidden");
                   $("#edit_ncb_div").removeClass("hidden");
               }
               else
               {
                    $("#edit_ncb_div_per").addClass("hidden");
                    $("#edit_ncb_div").addClass("hidden");
                    $("#edit_ncb_percentage").val("");
               }
           });
           
         $("#edit_a_ncb").keyup(function(){
               
               var ncb_percentage = $("#edit_ncb_percentage").val();
               var a_ncb = $("#edit_a_ncb").val();
               
               if(ncb_percentage != "")
               {
                     var commission = parseFloat(a_ncb) * parseFloat(100)/ncb_percentage;
                      $("#edit_a_ncb_span").html(commission.toFixed(2) +" %");
               }
           });
           
          $("#edit_b_ncb").keyup(function(){
               
               var ncb_percentage = $("#edit_ncb_percentage").val();
               var b_ncb = $("#edit_b_ncb").val();
               if(ncb_percentage != "")
               {
                     var commission = parseFloat(b_ncb) * parseFloat(100)/ncb_percentage;
                      $("#edit_b_ncb_span").html(commission.toFixed(2) +" %");
               }
           });
           
           
            $("#edit_c_ncb").keyup(function(){
               
               var ncb_percentage = $("#edit_ncb_percentage").val();
               var c_ncb = $("#edit_c_ncb").val();
               
               if(ncb_percentage != "")
               {
                     var commission = parseFloat(c_ncb) * parseFloat(100)/ncb_percentage;
                      
                      $("#edit_c_ncb_span").html(commission.toFixed(2) +" %");
               }
           });
           
            $("#edit_d_ncb").keyup(function(){
               
               var ncb_percentage = $("#edit_ncb_percentage").val();
               var d_ncb = $("#edit_d_ncb").val();
               
               if(ncb_percentage != "")
               {
                     var commission = parseFloat(d_ncb) * parseFloat(100)/ncb_percentage;
                      
                      $("#edit_d_ncb_span").html(commission.toFixed(2) +" %");
               }
               
                
           });
           $("#edit_insurer_class").change(function(){
             var insurer_class = $("#edit_insurer_class").val();
             
             if(insurer_class == "1")
             {
                 edit_fetch_motor_list();
             }
             else if(insurer_class == "2")
             {
                 
             }
         });
           $("#edit_btn").click(function(){
             
             var id = $("#edit_id").val();
             var insurer_company = $("#edit_insurer_company").val();
             var insurer_class = $("#edit_insurer_class").val();
             var business_type = $("#edit_business_type").val();
             var premium_c_type = $("#edit_premium_c_type").val();
             var policy_type  = $("#edit_policy_type").val();
             var commission_type = $("#edit_commission_type").val();
             var add_type = $("#edit_type").val();
             var make = $("#edit_make").val();
             var model = $("#edit_model_motor").val();
             var varient = $("#edit_varient").val();
             var fuel_type = $("#edit_fuel_type").val();
             var v_type = $("#edit_v_type").val();
             
             var ins_classification = $("#edit_ins_classification").val();
             var ins_state = $("#edit_ins_state").val();
             var ins_rto = $("#edit_ins_rto").val();
             var vehicle_age_max = $("#edit_vehicle_age_max").val();
             var vehicle_age_min = $("#edit_vehicle_age_min").val();
             
             var min_amount = $("#edit_min_amount").val();
             var max_amount = $("#edit_max_amount").val();
             
             // including
             var own_od = $("#edit_own_od").val();
             var own_tp = $("#edit_own_tp").val();
             var on_net = $("#edit_on_net").val();
             //
             
             // Excluding
             var ncb_percentage = $("#edit_ncb_percentage").val();
             var ird_com_od = $("#edit_ird_com_od").val();
             var ird_com_tp = $("#edit_ird_com_tp").val();
             //
             
             // agent commission
             
             if($("#edit_is_com_ncb").is(":checked"))
             {
                 var is_com_ncb = "Yes";
             }
             else
             {
                 var is_com_ncb = "No";
             }
             
             var agn_com_non_ncb = $("#edit_agn_com_type").val();
             var discount = $("#edit_discount").val();
             
             
             // nop 
             
             var condition = $("#edit_condition").val();
             var no_policy = $("#edit_no_policy").val();
             
             
             //Own Damage Agent Commission 
             var a_od = $("#edit_a_od").val();
             var b_od = $("#edit_b_od").val();
             var c_od = $("#edit_c_od").val();
             var d_od = $("#edit_d_od").val();
             // Tp Agent Commission
             
             var a_tp = $("#edit_a_tp").val();
             var b_tp = $("#edit_b_tp").val();
             var c_tp = $("#edit_c_tp").val();
             var d_tp = $("#edit_d_tp").val();
             
             // NET Agent Commission
             var a_net = $("#edit_a_net").val();
             var b_net = $("#edit_b_net").val();
             var c_net = $("#edit_c_net").val();
             var d_net = $("#edit_d_net").val();
             
             // NCB
             var a_ncb = $("#edit_a_ncb").val();
             var b_ncb = $("#edit_b_ncb").val();
             var c_ncb = $("#edit_c_ncb").val();
             var d_ncb = $("#edit_d_ncb").val();
            
             var formdata = new FormData();
             formdata.append('insurer_company',insurer_company);
             formdata.append('insurer_class',insurer_class);
             formdata.append('business_type',business_type);
             formdata.append('premium_c_type',premium_c_type);
             formdata.append('policy_type',policy_type);
             formdata.append('commission_type',commission_type);
             formdata.append('add_type',add_type);
             formdata.append('make',make);
             formdata.append('model',model);
             formdata.append('varient',varient);
             formdata.append('fuel_type',fuel_type);
             formdata.append('v_type',v_type);
             formdata.append('ins_classification',ins_classification);
             formdata.append('ins_state',ins_state);
             formdata.append('ins_rto',ins_rto);
             formdata.append('vehicle_age_min',vehicle_age_min);
             formdata.append('vehicle_age_max',vehicle_age_max);
             
             formdata.append('agn_com_non_ncb',agn_com_non_ncb);
             formdata.append('is_com_ncb',is_com_ncb);
             formdata.append('id',id);
             
            // including
            formdata.append('own_od',own_od);
            formdata.append('own_tp',own_tp);
            formdata.append('on_net',on_net);
             
            // Excluding
            formdata.append('ncb_percentage',ncb_percentage);
            formdata.append('ird_com_od',ird_com_od);
            formdata.append('ird_com_tp',ird_com_tp);
             
             
             // OD Agent Commission
             formdata.append('a_od',a_od);
             formdata.append('b_od',b_od);
             formdata.append('c_od',c_od);
             formdata.append('d_od',d_od);
             // Tp Agent Commission
             
             formdata.append('a_tp',a_tp);
             formdata.append('b_tp',b_tp);
             formdata.append('c_tp',c_tp);
             formdata.append('d_tp',d_tp);
             
             // NET Agent Commission
             formdata.append('a_net',a_net);
             formdata.append('b_net',b_net);
             formdata.append('c_net',c_net);
             formdata.append('d_net',d_net);
             
             // NCB
             formdata.append('a_ncb',a_ncb);
             formdata.append('b_ncb',b_ncb);
             formdata.append('c_ncb',c_ncb);
             formdata.append('d_ncb',d_ncb);
             
              // nop 
             formdata.append('condition',condition);
             formdata.append('no_policy',no_policy);
             
             // target
             formdata.append('min_amount',min_amount);
             formdata.append('max_amount',max_amount);
             
             
             $.ajax({
                        url : "edit_check_vechi_age_already_exits",
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
                            $("#edit_btn").attr("disabled",false);
                            
                            var obj = jQuery.parseJSON(response);
                            
                            if(obj.status != "success")
                            {
                                alert(obj.status);
                            }
                            else if(obj.status == "success")
                            {
                                if(obj.no_policy_id != "")
                                {
                                    formdata.append('no_policy_id',obj.no_policy_id);
                                }
                                else
                                {
                                    formdata.append('no_policy_id',"");
                                }
                                
                                  $.ajax({
                                    url : "edit_payout_entry",
                                    method : "POST",
                                    data:formdata,
                                    processData:false,  
                                    contentType:false,
                                    cache:false,
                                    dataType:'text',
                                    beforeSend:function(){
                                        $("#next_btn").attr("disabled",true);
                                    },
                                    success:function(response)
                                    {
                                        alert("success");
                                        $("#next_btn").attr("disabled",false);
                                        $("#add_btn").attr("disabled",false);
                                        $("#ins_state").val("");
                                        $("#ins_rto").val("");
                                        $("#ins_rto").trigger("change");
                                        $("#vehicle_age_min").val("");
                                        $("#vehicle_age_max").val("");
                                        $("#ncb_percentage").val("");
                                        $("#ins_classification").val();
                                        $("#own_od").val("");
                                        $("#own_tp").val("");
                                        $("#on_net").val("");
                                        $("#agn_com_type").val("");
                                        $("#discount").val("");
                                        $("#a_od").val("");
                                        $("#b_od").val("");
                                        $("#c_od").val("");
                                        $("#d_od").val("");
                                        $("#a_tp").val("");
                                        $("#b_tp").val("");
                                        $("#c_tp").val("");
                                        $("#d_tp").val("");
                                        $("#a_net").val("");
                                        $("#b_net").val("");
                                        $("#c_net").val("");
                                        $("#d_net").val("");
                                        $("#a_ncb").val("");
                                        $("#b_ncb").val("");
                                        $("#c_ncb").val("");
                                        $("#d_ncb").val("");
                                        $(".input-group-addon").html("");
                                        alert("Payout Commissions are Updated Successfully"); 
                                        $(".form-control").val("");
                                        $("#input-group-addon").html("");
                                        $("#edit_model").modal("toggle");
                                        fetch_payout_commission_motor();
                                    }
                            });
                            }
                        },
             });
         });
    });
      
      function fetch_motor_list()
      {
            var insurer_class = $("#insurer_class").val();
           
            if(insurer_class == "1")
            {
               $("#vehi_div").removeClass("hidden");
               $("#state_hidden").removeClass("hidden");
               $("#rto_hidden").removeClass("hidden");
               $("#classification_hidden").removeClass("hidden");
            }
            else if(insurer_class == "2")
            {
                $("#vehi_div").addClass("hidden");
                $("#state_hidden").addClass("hidden");
                $("#rto_hidden").addClass("hidden");
                $("#classification_hidden").addClass("hidden");
            }
      }
      
      function fetch_make()
      {
          var policy_type = $("#add_policy_type").val();
          
          $.ajax({
                    url : "fetch_make_arr",
                    method : "POST",
                    data : {vechile_type:policy_type},
                    success:function(response)
                    {
                        var obj = jQuery.parseJSON(response);
                        
                         $("#add_make").html("<option value='all'>All</option>");
                        
                        for(var i=0;i<obj.length;i++)
                        {
                            $("#add_make").append("<option value='"+obj[i].id+"'>"+obj[i].brand_name+"</option>");
                        }
                    }
          });
      }
      
      function fetch_model()
      {
          var policy_type = $("#add_policy_type").val();
          var make = $("#add_make").val();
          
          $.ajax({
                    url : "fetch_model_arr",
                    method : "POST",
                    data : {vechile_type:policy_type,vechi_make:make},
                    success:function(response)
                    {
                        $("#add_model_motor").html("");
                        $("#add_model_motor").trigger("change");
                        
                        
                        $("#add_model_motor").html("<option value='all'>All</option>");
                        
                        var obj = jQuery.parseJSON(response);
                        
                        for(var i=0;i<obj.length;i++)
                        {
                            $("#add_model_motor").append("<option value='"+obj[i].id+"'>"+obj[i].model_name+"</option>");
                        }
                    }
          });
      }
      
      function fetch_varient()
      {
          var policy_type = $("#add_policy_type").val();
          var make = $("#add_make").val();
          var model = $("#add_model_motor").val();
          
          $.ajax({
                    url : "fetch_vechile_varient_arr",
                    method : "POST",
                    data : {vechile_type:policy_type,vechi_make:make,vechi_model:model},
                    success:function(response)
                    {
                        $("#add_varient").html("");
                        $("#add_varient").trigger("change");
                        
                        $("#add_varient").html("<option value='all'>All</option>");
                        
                        var obj = jQuery.parseJSON(response);
                        
                        for(var i=0;i<obj.length;i++)
                        {
                            $("#add_varient").append("<option value='"+obj[i].id+"'>"+obj[i].varient_name+"</option>");
                        }
                    }
          });
      }
      
     function fetch_classification()
     {
         var policy_type = $("#add_policy_type").val();
         
         $.ajax({
                   url : "fetch_classification",
                   method : "POST",
                   data : {policy_type:policy_type},
                   success:function(response)
                   {
                       $("#ins_classification").html(response);
                   }
         });
         
     }
     
     
    function fetch_payout_commission_motor()
    {
      var content = "";
      content += "<div class='table-responsive'>";
      content += "<table id='table_id' class='table table-hover table-bordered'>"; 
      content += "<thead><th>S.No</th><th>Insurer</th><th>Premium Type</th><th>Vehi Classification</th><th>GVW</th><th>State</th><th>Type</th><th>OD(%)</th><th>TP(%)</th><th>On NET(%)</th><th>IRDA OD(%)</th><th>IRDA TP(%)</th><th>NCB(%)</th><th>Action</th></thead>";
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
            'url':'fetch_payout_entry',
          }
      });      
    }
    
    function view_data(id)
    {
        $.ajax({
                    url : "view_payout_commission_details",
                    method : "POST",
                    data : {id:id},
                    success:function(response)
                    {
                            $("#view_payout_content").html(response);
                            $("#view_model").modal("toggle");
                    }
        });
    }
    
   
   function delete_data(id)
    {
      if(confirm("Are you Confirm to Delete"))
      {
            alert(id);
            $.ajax({
                  url : "delete_commission_entry",
                  method : "POST",
                  data : {id:id},
                  success:function(response)
                  {
                        Swal.fire(
                          'Payout Entry Deleted Successfully!',
                          'You clicked the button!',
                          'success'
                        )
                        
                        fetch_payout_commission_motor();
                  }
            });
      }
    }
    
    function edit_data(id)
    {
        $.ajax({
                  url : "edit_commission_entry",
                  method : "POST",
                  data : {id:id},
                  success:function(response)
                  {
                       var obj = jQuery.parseJSON(response);
                       $("#edit_id").val(obj['res'].id);
                       $("#edit_insurer_company").val(obj['res'].insurer_company);
                       $("#edit_insurer_company").trigger("change");
                       $("#edit_insurer_class").val(obj['res'].class);
                       $("#edit_business_type").val(obj['res'].business_type);
                       $("#edit_premium_c_type").val(obj['res'].policy_premium_type);
                       $("#edit_commission_type").val(obj['res'].commission_type);
                       $("#edit_commission_type").trigger("change");
                       $("#edit_policy_type").val(obj['res'].policy_type);
                       $("#edit_v_type").val(obj['res'].vehicle_type);
                       $("#edit_type").val(obj['res'].type);
                       $("#edit_ins_classification").html(obj['classification_content']);
                       $("#edit_ins_classification").val(obj['res'].classification);
                       $("#edit_ins_state").val(obj['res'].state);
                       $("#edit_ins_rto").val(obj['select_rto']);
                       $("#edit_ins_rto").trigger("change");
                       $("#edit_no_of_policy").val(obj['res'].no_of_policy);
                       $("#edit_vehicle_age_min").val(obj['res'].vehicle_age_min);
                       $("#edit_vehicle_age_max").val(obj['res'].vehicle_age_max);
                       $("#edit_condition").val(obj['res'].condition_type);
                       $("#edit_no_policy").val(obj['res'].no_of_policy_id);
                       $("#edit_min_val").val(obj['res'].min_val);
                       $("#edit_max_val").val(obj['res'].max_val);
                       $("#edit_fuel_type").val(obj['res'].fuel_type);
                         if(obj['res'].is_ncb == "Yes")
                         {
                             $("#edit_is_com_ncb").prop('checked', true);
                             $("#edit_is_com_ncb").trigger("change");
                         }
                         else
                         {
                              $("#edit_is_com_ncb").prop('checked', false);
                             $("#edit_is_com_ncb").trigger("change");
                         }
                         $("#edit_ncb_percentage").val(obj['res'].ncb_percentage);
                         $("#edit_own_od").val(obj['res'].own_od);
                         $("#edit_own_tp").val(obj['res'].own_tp);
                         $("#edit_on_net").val(obj['res'].on_net);
                        $("#edit_agn_com_type").val(obj['res'].agn_com_type);
                        $("#edit_agn_com_type").trigger("change");
                        $("#edit_a_od").val(obj['res'].a_od);
                        $("#edit_b_od").val(obj['res'].b_od);
                        $("#edit_c_od").val(obj['res'].c_od);
                        $("#edit_d_od").val(obj['res'].d_od);
                        $("#edit_a_tp").val(obj['res'].a_tp);
                        $("#edit_b_tp").val(obj['res'].b_tp);
                        $("#edit_c_tp").val(obj['res'].c_tp);
                        $("#edit_d_tp").val(obj['res'].d_tp);
                        $("#edit_a_net").val(obj['res'].a_net);
                        $("#edit_b_net").val(obj['res'].b_net);
                        $("#edit_c_net").val(obj['res'].c_net);
                        $("#edit_d_net").val(obj['res'].d_net);
                        $("#edit_a_ncb").val(obj['res'].a_ncb);
                        $("#edit_b_ncb").val(obj['res'].b_ncb);
                        $("#edit_c_ncb").val(obj['res'].c_ncb);
                        $("#edit_d_ncb").val(obj['res'].d_ncb);
                        $("#edit_insurer_class").trigger("change");
                        if(obj['res'].class == 1)
                        {
                            $("#edit_make").html("");
                            //$("#edit_make").trigger("change");
                             $("#edit_make").html("<option value='all'>All</option>");
                            for(var i=0;i<obj['make_list'].length;i++)
                            {
                                $("#edit_make").append("<option value='"+obj['make_list'][i].id+"'>"+obj['make_list'][i].brand_name+"</option>");
                            }
                            $("#edit_model_motor").html("");
                            //$("#edit_model_motor").trigger("change");
                             $("#edit_model_motor").html("<option value='all'>All</option>");
                            for(var i=0;i<obj['model_list'].length;i++)
                            {
                                $("#edit_model_motor").append("<option value='"+obj['model_list'][i].id+"'>"+obj['model_list'][i].model_name+"</option>");
                            }
                            
                             $("#edit_varient").html("");
                            //$("#edit_varient").trigger("change");
                            $("#edit_varient").html("<option value='all'>All</option>");
                            for(var i=0;i<obj['varient_list'].length;i++)
                            {
                                $("#edit_varient").append("<option value='"+obj['varient_list'][i].id+"'>"+obj['varient_list'][i].varient_name+"</option>");
                            }
                            
                            $("#edit_make").val(obj['select_make']);
                            $("#edit_model_motor").val(obj['select_model']);
                            $("#edit_varient").val(obj['select_varient']);
                        }
                        //$("#edit_discount").val("");
                        $("#edit_model").modal("show");
                        //fetch_payout_commission_motor();
                  }
            });
    }
    
    function edit_fetch_make()
      {
          var policy_type = $("#edit_policy_type").val();
          $.ajax({
                    url : "fetch_make_arr",
                    method : "POST",
                    data : {vechile_type:policy_type},
                    success:function(response)
                    {
                        var obj = jQuery.parseJSON(response);
                        
                         $("#edit_make").html("<option value='all'>All</option>");
                        
                        for(var i=0;i<obj.length;i++)
                        {
                            $("#edit_make").append("<option value='"+obj[i].id+"'>"+obj[i].brand_name+"</option>");
                        }
                    }
          });
      }
      function edit_fetch_classification()
     {
         var policy_type = $("#edit_policy_type").val();
         
         $.ajax({
                   url : "fetch_classification",
                   method : "POST",
                   data : {policy_type:policy_type},
                   success:function(response)
                   {
                       $("#edit_ins_classification").html(response);
                   }
         });
         
     }
     function edit_fetch_motor_list()
      {
            var insurer_class = $("#edit_insurer_class").val();
           
            if(insurer_class == "1")
            {
               $("#edit_vehi_div").removeClass("hidden");
               $("#edit_state_hidden").removeClass("hidden");
               $("#edit_rto_hidden").removeClass("hidden");
               $("#edit_classification_hidden").removeClass("hidden");
            }
            else if(insurer_class == "2")
            {
                $("#edit_vehi_div").addClass("hidden");
                $("#edit_state_hidden").addClass("hidden");
                $("#edit_rto_hidden").addClass("hidden");
                $("#edit_classification_hidden").addClass("hidden");
            }
      }
      function edit_fetch_model()
      {
          var policy_type = $("#edit_policy_type").val();
          var make = $("#edit_make").val();
          
          $.ajax({
                    url : "fetch_model_arr",
                    method : "POST",
                    data : {vechile_type:policy_type,vechi_make:make},
                    success:function(response)
                    {
                        $("#edit_model_motor").html("");
                        $("#edit_model_motor").trigger("change");
                        
                        
                        $("#edit_model_motor").html("<option value='all'>All</option>");
                        
                        var obj = jQuery.parseJSON(response);
                        
                        for(var i=0;i<obj.length;i++)
                        {
                            $("#edit_model_motor").append("<option value='"+obj[i].id+"'>"+obj[i].model_name+"</option>");
                        }
                    }
          });
      }
      
      function edit_fetch_varient()
      {
          var policy_type = $("#edit_policy_type").val();
          var make = $("#edit_make").val();
          var model = $("#edit_model_motor").val();
          
          $.ajax({
                    url : "fetch_vechile_varient_arr",
                    method : "POST",
                    data : {vechile_type:policy_type,vechi_make:make,vechi_model:model},
                    success:function(response)
                    {
                        $("#edit_varient").html("");
                        $("#edit_varient").trigger("change");
                        
                        $("#edit_varient").html("<option value='all'>All</option>");
                        
                        var obj = jQuery.parseJSON(response);
                        
                        for(var i=0;i<obj.length;i++)
                        {
                            $("#edit_varient").append("<option value='"+obj[i].id+"'>"+obj[i].varient_name+"</option>");
                        }
                    }
          });
      }
  </script>
  
 
  