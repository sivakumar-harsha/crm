<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<style>

.form-control {
    display: block;
    width: 100%;
    height: 29px;
    padding: 4px 11px;
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

.modal-lg {
  width: 96%;
  height: 90%;
  margin: 5;
  padding: 5;
  z-index:10000000 !important;
}

.modal-header {
    min-height: 15.43px;
    padding: 10px;
    border-bottom: 1px solid #e5e5e5;
}

.btn-default {
    background-color: #f4f4f4;
    color: #444;
    border-color: #ddd;
    padding: 3.1px;
}
.content-header {
    position: relative;
    padding: 0px 15px 0 15px;
}

.modal {
    position: absolute;
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;
    z-index: 1050;
    display: none;
    overflow: unset;
    -webkit-overflow-scrolling: touch;
    outline: 0;
}





#payout_old_log_modal
{
    position: fixed;
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;
    z-index: 1050;
    display: none;
    overflow: hidden;
    -webkit-overflow-scrolling: touch;
    outline: 0;
}

.modal-open .modal {
    overflow-x: hidden !important;
    overflow-y: auto !important;
}

.h4, h4 {
    font-size: 14px;
    color: #0988f7;
}

input[type=checkbox], input[type=radio] {
    margin: 12px 0 0;
    margin-top: 1px\9;
    line-height: normal;
}

.page {
  width: auto;
  margin: auto;
}

.hs {
    
  list-style: none;
  overflow-x: auto;
  white-space: nowrap;
  width: 100%;
  padding: 0 10% 2rem 0%;
}

.hs .item {
  display: inline-block;
  width: auto;
  text-align: left;
  margin-right: 0.75rem;
  height: 100%;
  white-space: normal;
}

 /* width */
::-webkit-scrollbar {
  width: 10px;
}

/* Track */
::-webkit-scrollbar-track {
  background: #f1f1f1;
}

/* Handle */
::-webkit-scrollbar-thumb {
  background: #888;
}

/* Handle on hover */
::-webkit-scrollbar-thumb:hover {
  background: #555;
}

.li {
  text-decoration: none;
}

.emailcontainer {
    display:none;
    color:red;
    border:solid 1px blue;
    padding:10px;
    padding-left:50px;
    padding-right:50px
}

.content-header {
    position: relative;
    padding: 8px 15px 0 15px;
}




</style>


 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        
        <div class = "row">
            <div class="col-md-2"></div>
            
                <div class = "col-md-3">
                    <div class= "form-group">
                        <input type="date" name="s_f_date" id="s_f_date" class="form-control">
                    </div>
                </div>
                
                <div class = "col-md-3">
                    <div class= "form-group">
                        <input type="date" name="s_to_date" id="s_to_date" class="form-control">
                    </div>
                </div>
                
                <div class = "col-md-2">
                    <div class= "form-group">
                        <button type = "button" class = "btn btn-info btn-sm" id = "search_btn"><i class="fa fa-search"></i>&nbsp; Search</button>
                    </div>
                </div>
                
                  <div class="col-md-2">
                       <div class= "form-group">
                         <button class="btn btn-primary btn-sm pull-right" onclick="include_rto()" ><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;Include Rto</button>
                      </div>
                    </div>
        </div>
        
    </section>
     <!-- Main content -->
   <section class="content">
      <!-- Default box -->
     <div class = "box">
        <div class="box-body">
      
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active" id="motor_li"><a href="#tab_1" data-toggle="tab" aria-expanded="true" onclick="fetch_payout_commission('1')">Motor</a></li>
                    <li class="" id="health_li"><a href="#tab_2" data-toggle="tab" aria-expanded="false" onclick="fetch_payout_commission('2')">Health</a></li>
                    <li class='pull-right'>
                         <button data-toggle="modal" data-target="#add_model" style="margin-right:5px;" class="btn btn-primary btn-sm" id="add_mod">Add New</button>
                         <button data-toggle="modal" data-target="#add_health_model" style="margin-right:5px;" class="btn btn-primary btn-sm" id="add_mod">Add Health</button>
                         <button class="btn btn-danger btn-sm pull-right" id="excel_export"  onclick='export_excel()'><i class="fa fa-file-excel-o"></i> Export Excel</button>
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
            <div class="modal-header" style='background-color: #33b781;;'>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true" style="color:white;">×</span></button>
                <h4 class="modal-title text-center" style="color:#fff;">Payout Commission</h4>
            </div>
            
            <div class="modal-body">
                
              <div class="row">
                <div class="col-md-2">
                    <div class="form-group">
                            <label>Insurer Company</label>
                            <select class="form-control select2" style="width:100%;height:100%;" name="insurer_company" id="insurer_company">
                                <option value="">--Select--</option>
                                 <?php foreach($insurer_company as $da) { ?>
                                  <option value="<?php echo $da->id ?>"><?php echo $da->company_name ?></option>
                                <?php } ?>
                            </select>
                    </div>
                </div>
                
                <div class="col-md-2">
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
                
                
                
                  <div class="col-md-1">
                      <div class="form-group">
                                    <label>IRD OD(%)</label>
                                      <input class="form-check-input temp" type="checkbox" value="Yes" id="ird_od_commission_checkbox">
                                    <input type="number" class="form-control" name="ird_od_commission" id="ird_od_commission" value="15" readonly>
                                </div>
                          </div>
                          
                             <div class="col-md-1">
                                  <div class="form-group">
                                    <label>IRD TP(%)</label>
                                     <input class="form-check-input temp" type="checkbox" value="Yes" id="ird_tp_commission_checkbox">
                                    <input type="number" class="form-control" name="ird_tp_commission" id="ird_tp_commission" value="2.5" readonly>
                                </div>
                          </div>
               
                <div class="col-md-2">
                    <div class="form-group">
                        <label>Policy Type</label>
                        <select class="form-control" name="add_policy_type" id="add_policy_type">
                            <option value="">--Select--</option>
                            <?php foreach($policy_type as $da){ ?>
                            
                            <option value="<?php echo $da->id ?>"><?php echo $da->policy_type ?></option>
                            
                            <?php } ?>
                        </select>
                    </div>
                </div>
                
                <div class="col-md-1">
                     <div class="form-group">
                        <label>From Date</label>
                        <input type="date" class="form-control" name="f_date" id="f_date">
                     </div>
                </div>
                
                <div class="col-md-1">
                    <div class="form-group">
                        <label>To Date</label>
                         <input type="date" class="form-control" name="to_date" id="to_date">
                    </div>
                </div>
                
                <div class="col-md-2"> 
                    <label>State</label>
                    <div class="form-group">
                        <select class="form-control" name="ins_state" id="ins_state">
                            <option value="">--Select--</option>
                            <option value="All">All</option>
                            <?php foreach($state as $da) { ?>
                              <option value="<?php echo $da->id ?>"><?php echo $da->name ?></option>
                            <?php } ?>
                        </select>
                     </div>
                </div>
                
            </div>
            
              <ul class="hs">
                   
              <div class = "row">  
                <!-- start 2023-08-17 //-->
                    <li class="item">
                                <div class="col-lg-3 col-md-4 col-sm-6 ">
                                <div class="card border-0" style="width: 15rem;">
                                <div class="form-group">
                                    <label>Payout Type</label>
                                        <select class="form-control temp" name="payout_type" id="payout_type">
                                            <option value="">--Select--</option>
                                            <option value="Fresh">Fresh</option>
                                            <option value="Renewal">Renewal</option>
                                        </select>
                                </div>
                            </div>
                        </div>
                    </li>
                    <!-- end 2023-08-17 //-->
                <li class="item">
                        <div class="col-lg-3 col-md-4 col-sm-6">
                            <div class="card border-0" style="width: 15rem;">
                                <div class="form-group">
                                    <label>IRD Commission(%)</label>                                                    
                                    <input class="form-check-input temp" type="checkbox" value="Yes" id="ird_commission_checkbox" onclick="setAttributes(this, 'ird_commission')">
                                    <input type="number" class="form-control" name="ird_commission" id="ird_commission"  readonly>
                                </div>
                            </div>
                        </div>
                </li>
                  <li class="item">
                            <div class="col-lg-3 col-md-4 col-sm-6 ">
                             <div class="card border-0" style="width: 15rem;">
                               <div class="form-group">
                                 <label>Type</label>
                                    <select class="form-control temp" name="add_type" id="add_type">
                                        <option value="">--Select--</option>
                                        <option value="including">including</option>
                                        <option value="Excluding">Excluding</option>
                                    </select>
                            </div>
                        </div>
                    </div>
                 </li>
                 
                 <li class="item">
                     <div class="col-lg-3 col-md-4 col-sm-6 ">
                         <div class="card border-0" style="width: 15rem;">
                            <div class="form-group">
                                <label>Premium Type</label>
                                <select class="form-control temp" name="premium_c_type" id="premium_c_type">
                                    <option value="">--Select--</option>
                                    <?php foreach($type as $da) { ?>
                                      <option value="<?php echo $da->id ?>"><?php echo $da->name ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                 </li>
            
        <li class="item">
            <div class="col-lg-3 col-md-4 col-sm-6 ">
                <div class="card border-0" style="width: 15rem;">
                    <div class="form-group">
                        <label>Make</label>
                        <select class="form-control select2 temp" name="add_make" id="add_make" multiple style="width:100%;height:100%;">
                            <option value="">--Select--</option>
                            <option value="all">All</option>
                        </select>
                        </div>
                </div>
            </div>
        </li>
            
      <li class="item">
          <div class="col-lg-3 col-md-4 col-sm-6 ">
            <div class="card border-0" style="width: 15rem;">
                <div class="form-group">
                    <label>Model</label>
                    <select class="form-control select2 temp" name="add_model_motor" id="add_model_motor" multiple style="width:100%;height:100%;">
                        <option value="">--Select--</option>
                        <option value="all">All</option>
                    </select>
                </div>
            </div>
         </div>
      </li>


    <li class="item">
      <div class="col-lg-3 col-md-4 col-sm-6 ">
        <div class="card border-0" style="width: 15rem;">
            <div class="form-group">
                <label>Varient</label>
                <select class="form-control select2 temp" name="add_varient" id="add_varient" multiple style="width:100%;height:100%;">
                    <option value="">--Select--</option>
                    <option value="all">All</option>
                </select>
            </div>
        </div>
      </div>
    </li>


     <li class="item">
          <div class="col-lg-3 col-md-4 col-sm-6 ">
            <div class="card border-0" style="width: 15rem;">
                <div class="form-group">
                    <label>Fuel Type</label>
                    <select class="form-control temp" name="add_fuel_type" id="add_fuel_type">
                        <option value="">--Select--</option>
                        <?php foreach($fuel_type as $da){  ?>
                             <option value="<?php echo $da->id ?>"><?php echo $da->fuel_type ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
          </div>
        </li>

    <li class="item">
          <div class="col-lg-3 col-md-4 col-sm-6 ">
            <div class="card border-0" style="width: 15rem;">
                <div class="form-group">
                    <label>Vechicle Classification</label>
                    <select class="form-control temp" name="ins_classification" id="ins_classification">
                        <option value="">--Select--</option>
                    </select>
                </div>
            </div>
          </div>
        </li>

    <li class="item">
          <div class="col-lg-3 col-md-4 col-sm-6 ">
            <div class="card border-0" style="width: 15rem;">
                <div class="form-group">
                    <label>RTO Category</label>
                    <select class="form-control temp" name="rto_category" id="rto_category">
                        <option value = "">--Select--</option>
                        <option value='ROTN_Exclude'>ROTN(Exclude)</option>
                         <option value='KA_Exclude'>KA(Exclude)</option>
                        <option value='Others'>Others</option>
                    </select>
                </div>
            </div>
          </div>
        </li>
    
    <li class="item">
          <div class="col-lg-3 col-md-4 col-sm-6 ">
            <div class="card border-0" style="width: 15rem;">
                    <div class="form-group">
                    <label>RTO</label>
                    <select class="form-control select2 temp" name="ins_rto" id="ins_rto" multiple data-placeholder="Select a RTO" style="width:100%">
                        <?php foreach($rto as $da) { ?>
                          <option value="<?php echo $da->rto_no ?>"><?php echo $da->rto_no." (".$da->city.")" ?></option>
                        <?php } ?>
                    </select>
                    </div>
            </div>
          </div>
        </li>
        
    <li class="item" id="vechi_div_1">
          <div class="col-lg-3 col-md-4 col-sm-6 ">
            <div class="card border-0" style="width: 15rem;">
                <div class="form-group">
                    <label>Vehicle Age(Min)</label>
                    <input type="number" class="form-control temp" name="vehicle_age_min" id="vehicle_age_min">
                </div>
            </div>
          </div>
        </li>
        
     <li class="item" id="vechi_div_2">
          <div class="col-lg-3 col-md-4 col-sm-6 ">
            <div class="card border-0" style="width: 15rem;">
                <div class="form-group">
                    <label>Vehicle Age(Max)</label>
                    <input type="number" class="form-control temp" name="vehicle_age_max" id="vehicle_age_max">
                </div>
            </div>
          </div>
        </li>
        
     <li class="item hidden" id="nop_div_1">
          <div class="col-lg-3 col-md-4 col-sm-6 ">
            <div class="card border-0" style="width: 15rem;">
                <div class="form-group">
                    <label>Number of Policy(Min)</label>
                     <input type="number" class="form-control temp" name="no_policy_min" id="no_policy_min">
                </div>
            </div>
          </div>
        </li>
        
      <li class="item hidden" id="nop_div_2">
          <div class="col-lg-3 col-md-4 col-sm-6 ">
            <div class="card border-0" style="width: 15rem;">
                <div class="form-group">
                    <label>Number of Policy(Max)</label>
                    <input type="number" class="form-control temp" name="no_policy_max" id="no_policy_max">
                </div>
            </div>
          </div>
        </li>
        
      <li class="item hidden" id="target_div_1">
              <div class="col-lg-3 col-md-4 col-sm-6 ">
                <div class="card border-0" style="width: 15rem;">
                    <div class="form-group">
                        <label>Min Value</label>
                         <input type="number" class="form-control temp" name="min_amount" id="min_amount">
                    </div>
                </div>
              </div>
          </li>
          
      <li class="item hidden" id="target_div_2">
              <div class="col-lg-3 col-md-4 col-sm-6 ">
                <div class="card border-0" style="width: 15rem;">
                    <div class="form-group">
                        <label>Max Value</label>
                        <input type="number" class="form-control temp" name="max_amount" id="max_amount">
                    </div>
                </div>
              </div>
          </li>

      <li class="item">
            <div class="col-lg-3 col-md-4 col-sm-6 ">
            <div class="card border-0" style="width: 7rem;margin-top:10px;">
                <div class="form-group">
                  <input class="form-check-input temp" type="checkbox" value="Yes" id="is_com_ncb">
                  &nbsp;<b>ON NCB</b>
                </div>
            </div>
        </div>
     </li>    
    
     <li class="item hidden ncb_div_per">
            <div class="col-lg-3 col-md-4 col-sm-6 ">
            <div class="card border-0" style="width: 15rem;">
                    <div class="form-group">
                        <label>ON NCB</label>
                            <input type="number" placeholder="Enter NCB Percentage" class="form-control temp" name="ncb_percentage" id="ncb_percentage" >
                    </div>
            </div>
        </div>
     </li>   
     
      <li class="item">
            <div class="col-lg-3 col-md-4 col-sm-6 ">
            <div class="card border-0" style="width: 7rem;margin-top:10px;">
                <div class="form-group">
                  <input class="form-check-input temp" type="checkbox" value="Yes" id="is_com_cpa">
                  &nbsp;<b>Is CPA</b>
                </div>
            </div>
        </div>
     </li>    
          
       <li class="item hidden cpa_div_per">
            <div class="col-lg-3 col-md-4 col-sm-6 ">
            <div class="card border-0" style="width: 15rem;">
                    <div class="form-group">
                        <label>With CPA</label>
                            <input type="number" placeholder="Enter CPA Percentage" class="form-control temp" name="cpa_percentage" id="cpa_percentage" >
                    </div>
            </div>
        </div>
     </li>   
          
          
      <li class="item">
              <div class="col-lg-3 col-md-4 col-sm-6 ">
                <div class="card border-0" style="width: 15rem;">
                    <div class="form-group" id='own_od_div'>
                                <label>Own OD(%)</label>
                                <input type="number" class="form-control temp" name="own_od" id="own_od" >
                      </div>
                </div>
              </div>
          </li>

      <li class="item">
          <div class="col-lg-3 col-md-4 col-sm-6 ">
            <div class="card border-0" style="width: 15rem;">
                <div class="form-group" id="own_tp_div">
                    <label>Own Tp(%)</label>
                    <input type="number" class="form-control temp" name="own_tp" id="own_tp" >
                </div>
            </div>
          </div>
      </li>
      
      <li class="item">
          <div class="col-lg-3 col-md-4 col-sm-6 ">
            <div class="card border-0" style="width: 15rem;">
                <div class="form-group">
                    <label>Own Net(%)</label>
                    <input type="number" class="form-control temp" name="on_net" id="on_net" >
                </div>
            </div>
          </div>
      </li>
      
      <li class="item">
          <div class="col-lg-3 col-md-4 col-sm-6 ">
            <div class="card border-0" style="width: 15rem;">
                <div class="form-group">
                    <label>Agent Commission Type</label>
                        <select class="form-control temp"  id="agn_com_type" name="agn_com_type">
                            <option value="">--select--</option>
                            <option value="OD">OD</option>
                            <option value="TP">TP</option>
                            <option value="ON-NET">ON-NET</option>
                            <option value="OD_AND_TP">OD_AND_TP</option>
                        </select>
                </div>
            </div>
          </div>
      </li>
      
       <li class="item">
         <div class="col-lg-3 col-md-4 col-sm-6 ">
              <div class="card border-0" style="width: 15rem;">
                    <div class="form-group">
                            <label>Agency/Pos</label>
                            <select class="form-control select2" style="width:100%;height:100%;" name="add_agency" id="add_agency" multiple>
                                <option value="">--Select--</option>
                                 <?php foreach($agents_pos as $da) { ?>
                                  <option value="<?php echo $da->id ?>"><?php echo $da->name ?></option>
                                <?php } ?>
                            </select>
                    </div>
                    </div>
                </div>
            </li>
      
      
      <li class="item">
          <div class="col-lg-3 col-md-4 col-sm-6 ">
            <div class="card border-0" style="width: 15rem;">
                <div class="form-group">
                    <label>Special Commission(%)</label>
                    <input type="number" class="form-control temp" name="special_com" id="special_com" >
                </div>
            </div>
          </div>
      </li>
      
      
      
      <li class="item hidden od_div">
          <div class="col-lg-3 col-md-4 col-sm-6 ">
            <div class="card border-0" style="width: 15rem;">
                <div class="form-group">
                        <label>A(OD%)</label>
                           <div class="input-group">
                                <input type="number" class="form-control od temp" name="a_od" id="a_od">
                                <span class="input-group-addon" id="a_od_span"></span>
                           </div>
                    </div>
            </div>
          </div>
      </li>
      
      <li class="item hidden od_div">
          <div class="col-lg-3 col-md-4 col-sm-6 ">
            <div class="card border-0" style="width: 15rem;">
               <div class="form-group">
                        <label>B(OD%)</label>
                        <div class="input-group">
                            <input type="number" class="form-control od temp" name="b_od" id="b_od" >
                            <span class="input-group-addon" id="b_od_span"></span>
                         </div>
                    </div>
            </div>
          </div>
      </li>
      
      <li class="item hidden od_div">
          <div class="col-lg-3 col-md-4 col-sm-6 ">
            <div class="card border-0" style="width: 15rem;">
               <div class="form-group">
                        <label>C(OD%)</label>
                        <div class="input-group">
                            <input type="number" class="form-control od temp" name="c_od" id="c_od" >
                             <span class="input-group-addon" id="c_od_span"></span>
                         </div>
                </div>
            </div>
          </div>
      </li>
      
      <li class="item hidden od_div">
          <div class="col-lg-3 col-md-4 col-sm-6 ">
            <div class="card border-0" style="width: 15rem;">
               <div class="form-group">
                        <label>D(OD%)</label>
                        <div class="input-group">
                            <input type="number" class="form-control od temp" name="d_od" id="d_od" >
                             <span class="input-group-addon" id="d_od_span"></span>
                         </div>
                </div>
            </div>
          </div>
      </li>
      
      
      <li class="item hidden tp_div">
          <div class="col-lg-3 col-md-4 col-sm-6 ">
            <div class="card border-0" style="width: 15rem;">
               <div class="form-group">
                        <label>A(TP%)</label>
                           <div class="input-group">
                                <input type="number" class="form-control tp temp" name="a_tp" id="a_tp" >
                                <span class="input-group-addon" id="a_tp_span"></span>
                           </div>
                    </div>
            </div>
          </div>
      </li>
      
      <li class="item hidden tp_div">
          <div class="col-lg-3 col-md-4 col-sm-6 ">
            <div class="card border-0" style="width: 15rem;">
               <div class="form-group">
                        <label>B(TP%)</label>
                        <div class="input-group">
                            <input type="number" class="form-control tp temp" name="b_tp" id="b_tp" >
                            <span class="input-group-addon" id="b_tp_span"></span>
                         </div>
                    </div>
            </div>
          </div>
      </li>
      
      <li class="item hidden tp_div">
          <div class="col-lg-3 col-md-4 col-sm-6 ">
            <div class="card border-0" style="width: 15rem;">
               <div class="form-group">
                        <label>C(TP%)</label>
                        <div class="input-group">
                            <input type="number" class="form-control tp temp" name="c_tp" id="c_tp" >
                             <span class="input-group-addon" id="c_tp_span"></span>
                         </div>
                    </div>
            </div>
          </div>
      </li>
      
      <li class="item hidden tp_div">
          <div class="col-lg-3 col-md-4 col-sm-6 ">
            <div class="card border-0" style="width: 15rem;">
               <div class="form-group">
                        <label>D(TP%)</label>
                        <div class="input-group">
                            <input type="number" class="form-control tp temp" name="d_tp" id="d_tp" >
                             <span class="input-group-addon" id="d_tp_span"></span>
                         </div>
                    </div>
            </div>
          </div>
      </li>
      
      
      <li class="item hidden net_div">
          <div class="col-lg-3 col-md-4 col-sm-6 ">
            <div class="card border-0" style="width: 15rem;">
               <div class="form-group">
                        <label>A(NET %)</label>
                           <div class="input-group">
                                <input type="number" class="form-control net temp" name="a_net" id="a_net" >
                                <span class="input-group-addon" id="a_net_span"></span>
                           </div>
                    </div>
            </div>
          </div>
      </li>
      
      <li class="item hidden net_div">
          <div class="col-lg-3 col-md-4 col-sm-6 ">
            <div class="card border-0" style="width: 15rem;">
               <div class="form-group">
                        <label>B(NET %)</label>
                        <div class="input-group">
                            <input type="number" class="form-control net temp" name="b_net" id="b_net" >
                            <span class="input-group-addon" id="b_net_span"></span>
                         </div>
                    </div>
            </div>
          </div>
      </li>
      
      <li class="item hidden net_div">
          <div class="col-lg-3 col-md-4 col-sm-6 ">
            <div class="card border-0" style="width: 15rem;">
                 <div class="form-group">
                        <label>C(NET %)</label>
                        <div class="input-group">
                            <input type="number" class="form-control net temp" name="c_net" id="c_net" >
                             <span class="input-group-addon" id="c_net_span"></span>
                         </div>
                    </div>
            </div>
          </div>
      </li>
      
      <li class="item hidden net_div">
          <div class="col-lg-3 col-md-4 col-sm-6 ">
            <div class="card border-0" style="width: 15rem;">
                 <div class="form-group">
                        <label>D(NET %)</label>
                        <div class="input-group">
                            <input type="number" class="form-control net temp" name="d_net" id="d_net" >
                             <span class="input-group-addon" id="d_net_span"></span>
                         </div>
                    </div>
            </div>
          </div>
      </li>
      
      <li class="item hidden ncb_div">
          <div class="col-lg-3 col-md-4 col-sm-6 ">
            <div class="card border-0" style="width: 15rem;">
                  <div class="form-group">
                        <label>A(NCB %)</label>
                           <div class="input-group">
                                <input type="number" class="form-control net temp" name="a_ncb" id="a_ncb" >
                                <span class="input-group-addon" id="a_ncb_span"></span>
                           </div>
                    </div>
            </div>
          </div>
      </li>
      
      <li class="item hidden ncb_div">
          <div class="col-lg-3 col-md-4 col-sm-6 ">
            <div class="card border-0" style="width: 15rem;">
                 <div class="form-group">
                        <label>B(NCB %)</label>
                        <div class="input-group">
                            <input type="number" class="form-control net temp" name="b_ncb" id="b_ncb" >
                            <span class="input-group-addon" id="b_ncb_span"></span>
                         </div>
                    </div>
            </div>
          </div>
      </li>
      
      <li class="item hidden ncb_div">
          <div class="col-lg-3 col-md-4 col-sm-6 ">
            <div class="card border-0" style="width: 15rem;">
                <div class="form-group">
                        <label>C(NCB %)</label>
                        <div class="input-group">
                            <input type="number" class="form-control net temp" name="c_ncb" id="c_ncb" >
                             <span class="input-group-addon" id="c_ncb_span"></span>
                         </div>
                    </div>
            </div>
          </div>
      </li>
      
      <li class="item hidden ncb_div">
          <div class="col-lg-3 col-md-4 col-sm-6 ">
            <div class="card border-0" style="width: 15rem;">
               <div class="form-group">
                        <label>D(NCB %)</label>
                        <div class="input-group">
                            <input type="number" class="form-control net temp" name="d_ncb" id="d_ncb" >
                             <span class="input-group-addon" id="d_ncb_span"></span>
                         </div>
                    </div>
            </div>
          </div>
      </li>
      
      
        <li class="item hidden cpa_div">
          <div class="col-lg-3 col-md-4 col-sm-6 ">
            <div class="card border-0" style="width: 15rem;">
                  <div class="form-group">
                        <label>A(CPA %)</label>
                           <div class="input-group">
                                <input type="number" class="form-control cpa temp" name="a_cpa" id="a_cpa" >
                                <span class="input-group-addon" id="a_cpa_span"></span>
                           </div>
                    </div>
            </div>
          </div>
      </li>
      
      <li class="item hidden cpa_div">
          <div class="col-lg-3 col-md-4 col-sm-6 ">
            <div class="card border-0" style="width: 15rem;">
                 <div class="form-group">
                        <label>B(CPA %)</label>
                        <div class="input-group">
                            <input type="number" class="form-control cpa temp" name="b_cpa" id="b_cpa">
                            <span class="input-group-addon" id="b_cpa_span"></span>
                         </div>
                    </div>
            </div>
          </div>
      </li>
      
      <li class="item hidden cpa_div">
          <div class="col-lg-3 col-md-4 col-sm-6 ">
            <div class="card border-0" style="width: 15rem;">
                <div class="form-group">
                        <label>C(CPA %)</label>
                        <div class="input-group">
                            <input type="number" class="form-control cpa temp" name="c_cpa" id="c_cpa">
                             <span class="input-group-addon" id="c_cpa_span"></span>
                         </div>
                    </div>
            </div>
          </div>
      </li>
      
      <li class="item hidden cpa_div">
          <div class="col-lg-3 col-md-4 col-sm-6 ">
            <div class="card border-0" style="width: 15rem;">
               <div class="form-group">
                        <label>D(CPA %)</label>
                        <div class="input-group">
                            <input type="number" class="form-control cpa temp" name="d_cpa" id="d_cpa" >
                             <span class="input-group-addon" id="d_cpa_span"></span>
                         </div>
                    </div>
            </div>
          </div>
      </li>
      
      
   </div>
 </ul>
 
    <div id="old_payouts"></div>
 
        </div> 
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-sm btn-primary" id="next_btn">Add <i class="fa fa-angle-double-right"></i></button>
                <button type="button" class="btn btn-sm btn-success" id="add_btn" disabled>Save changes</button>
            </div>
        </div>
    </div>
  </div>
  
  
   <div class="modal fade in" id="add_health_model">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header" style='background-color: #33b781;;'>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true" style="color:white;">×</span></button>
                <h4 class="modal-title text-center" style="color:#fff;">Payout Commission</h4>
            </div>
            
            <div class="modal-body">
                
              <div class="row">
                  
                <div class="col-md-2">
                    <div class="form-group">
                            <label>Insurer Company</label>
                            <select class="form-control select2" style="width:100%;height:100%;" name="h_insurer_company" id="h_insurer_company">
                                <option value="">--Select--</option>
                                 <?php foreach($insurer_company as $da) { ?>
                                  <option value="<?php echo $da->id ?>"><?php echo $da->company_name ?></option>
                                <?php } ?>
                            </select>
                    </div>
                </div>
                
                <div class="col-md-2">
                    <div class="form-group">
                        <label>Commission Type</label>
                        <select class="form-control" name="h_commission_type" id="h_commission_type">
                            <option value="">--Select--</option>
                             <?php foreach($commission_type as $da){
                                if($da->id != "2")
                                {
                             ?>
                              <option value="<?php echo $da->id ?>"><?php echo $da->type ?></option>
                             <?php }} ?>
                        </select>
                    </div>
                </div>
               
                <div class="col-md-2">
                    <div class="form-group">
                        <label>Policy Type</label>
                        <select class="form-control" name="h_add_policy_type" id="h_add_policy_type">
                            <option value="">--Select--</option>
                            <?php foreach($health_policy_type as $da){ ?>
                            
                            <option value="<?php echo $da->id ?>"><?php echo $da->policy_type ?></option>
                            
                            <?php } ?>
                        </select>
                    </div>
                </div>
                
                <div class="col-md-2">
                     <div class="form-group">
                        <label>From Date</label>
                        <input type="date" class="form-control" name="h_f_date" id="h_f_date">
                     </div>
                </div>
                
                <div class="col-md-2">
                    <div class="form-group">
                        <label>To Date</label>
                         <input type="date" class="form-control" name="h_to_date" id="h_to_date">
                    </div>
                </div>
                
                <div class="col-md-2"> 
                    <label>State</label>
                    <div class="form-group">
                        <select class="form-control" name="h_ins_state" id="h_ins_state">
                            <option value="">--Select--</option>
                            <option value="All">All</option>
                            <?php foreach($state as $da) { ?>
                              <option value="<?php echo $da->id ?>"><?php echo $da->name ?></option>
                            <?php } ?>
                        </select>
                     </div>
                </div>
                
            </div>
            
              <ul class="hs">
                   
              <div class = "row">   
<!-- 2023-05-25 start //-->              
                <li class="item">
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <div class="card border-0" style="width: 15rem;">
                            <div class="form-group">
                                <label>IRD Commission(%)</label>                                                    
                                <input class="form-check-input temp" type="checkbox" value="Yes" id="health_ird_commission_checkbox" onclick="setAttributes(this, 'health_ird_commission')">
                                <input type="number" class="form-control" name="health_ird_commission" id="health_ird_commission" value="15" readonly>
                            </div>
                        </div>
                    </div>
                </li>
<!-- 2023-05-25 end//-->  
              <li class="item">
                 <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="card border-0" style="width: 15rem;">
                      <div class="form-group">
                          <label>Business Type</label>
                            <select class="form-control" name="h_business_type" id="h_business_type">
                                <option value="">--Select--</option>
                                <?php foreach($business_type as $da) { ?>
                                  <option value="<?php echo $da->id ?>"><?php echo $da->bussiness_type ?></option>
                                <?php } ?>
                            </select>
                         </div>
                    </div>
                  </div>
              </li>
              
                <li class="item hidden" id="h_nop_div_1">
                  <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="card border-0" style="width: 15rem;">
                        <div class="form-group">
                            <label>Number of Policy(Min)</label>
                             <input type="number" class="form-control temp" name="h_no_policy_min" id="h_no_policy_min">
                        </div>
                    </div>
                  </div>
              </li>
        
                <li class="item hidden" id="h_nop_div_2">
                   <div class="col-lg-3 col-md-4 col-sm-6 ">
                        <div class="card border-0" style="width: 15rem;">
                            <div class="form-group">
                                <label>Number of Policy(Max)</label>
                                <input type="number" class="form-control temp" name="h_no_policy_max" id="h_no_policy_max">
                            </div>
                        </div>
                   </div>
              </li>
        
            <li class="item hidden" id="h_target_div_1">
                  <div class="col-lg-3 col-md-4 col-sm-6 ">
                    <div class="card border-0" style="width: 15rem;">
                        <div class="form-group">
                            <label>Min Value</label>
                             <input type="number" class="form-control temp" name="h_min_amount" id="h_min_amount">
                        </div>
                    </div>
                  </div>
              </li>
              
                <li class="item hidden" id="h_target_div_2">
                              <div class="col-lg-3 col-md-4 col-sm-6 ">
                                <div class="card border-0" style="width: 15rem;">
                                    <div class="form-group">
                                        <label>Max Value</label>
                                        <input type="number" class="form-control temp" name="h_max_amount" id="h_max_amount">
                                    </div>
                                </div>
                              </div>
                          </li>
    
                 <li class="item">
                        <div class="col-lg-3 col-md-4 col-sm-6 ">
                            <div class="card border-0" style="width: 7rem;margin-top:10px;">
                                <div class="form-group">
                                  <input class="form-check-input temp" type="checkbox" value="Yes" id="h_is_com_ncb">
                                  &nbsp;<b>ON NCB</b>
                                </div>
                            </div>
                       </div>
                 </li>    
         
                <li class="item hidden h_ncb_div_per">
                     <div class="col-lg-3 col-md-4 col-sm-6 ">
                            <div class="card border-0" style="width: 15rem;">
                                    <div class="form-group">
                                        <label>ON NCB</label>
                                            <input type="number" placeholder="Enter NCB Percentage" class="form-control temp" name="h_ncb_percentage" id="h_ncb_percentage">
                                    </div>
                            </div>
                       </div>
                </li>    
    
                <li class="item">
                      <div class="col-lg-3 col-md-4 col-sm-6 ">
                        <div class="card border-0" style="width: 15rem;">
                            <div class="form-group">
                                <label>Own Net(%)</label>
                                <input type="number" class="form-control temp" name="h_on_net" id="h_on_net" >
                            </div>
                        </div>
                      </div>
                  </li>

              <li class="item h_net_div">
                  <div class="col-lg-3 col-md-4 col-sm-6 ">
                    <div class="card border-0" style="width: 15rem;">
                       <div class="form-group">
                                <label>A(NET %)</label>
                                   <div class="input-group">
                                        <input type="number" class="form-control net temp" name="h_a_net" id="h_a_net" >
                                        <span class="input-group-addon" id="h_a_net_span"></span>
                                   </div>
                            </div>
                    </div>
                  </div>
              </li>
              
              <li class="item h_net_div">
                  <div class="col-lg-3 col-md-4 col-sm-6 ">
                    <div class="card border-0" style="width: 15rem;">
                       <div class="form-group">
                                <label>B(NET %)</label>
                                <div class="input-group">
                                    <input type="number" class="form-control net temp" name="h_b_net" id="h_b_net" >
                                    <span class="input-group-addon" id="h_b_net_span"></span>
                                 </div>
                            </div>
                    </div>
                  </div>
              </li>
              
              <li class="item h_net_div">
                  <div class="col-lg-3 col-md-4 col-sm-6 ">
                    <div class="card border-0" style="width: 15rem;">
                         <div class="form-group">
                                <label>C(NET %)</label>
                                <div class="input-group">
                                    <input type="number" class="form-control net temp" name="h_c_net" id="h_c_net" >
                                     <span class="input-group-addon" id="h_c_net_span"></span>
                                 </div>
                            </div>
                    </div>
                  </div>
              </li>
              
              <li class="item h_net_div">
                  <div class="col-lg-3 col-md-4 col-sm-6 ">
                    <div class="card border-0" style="width: 15rem;">
                         <div class="form-group">
                                <label>D(NET %)</label>
                                <div class="input-group">
                                    <input type="number" class="form-control net temp" name="h_d_net" id="h_d_net" >
                                     <span class="input-group-addon" id="h_d_net_span"></span>
                                 </div>
                            </div>
                    </div>
                  </div>
              </li>
              
              <li class="item hidden h_ncb_div">
                  <div class="col-lg-3 col-md-4 col-sm-6 ">
                    <div class="card border-0" style="width: 15rem;">
                          <div class="form-group">
                                <label>A(NCB %)</label>
                                   <div class="input-group">
                                        <input type="number" class="form-control net temp" name="h_a_ncb" id="h_a_ncb" >
                                        <span class="input-group-addon" id="h_a_ncb_span"></span>
                                   </div>
                            </div>
                    </div>
                  </div>
              </li>
              
              <li class="item hidden h_ncb_div">
                  <div class="col-lg-3 col-md-4 col-sm-6 ">
                    <div class="card border-0" style="width: 15rem;">
                         <div class="form-group">
                                <label>B(NCB %)</label>
                                <div class="input-group">
                                    <input type="number" class="form-control net temp" name="h_b_ncb" id="h_b_ncb" >
                                    <span class="input-group-addon" id="h_b_ncb_span"></span>
                                 </div>
                            </div>
                    </div>
                  </div>
              </li>
              
              <li class="item hidden h_ncb_div">
                  <div class="col-lg-3 col-md-4 col-sm-6 ">
                    <div class="card border-0" style="width: 15rem;">
                        <div class="form-group">
                                <label>C(NCB %)</label>
                                <div class="input-group">
                                    <input type="number" class="form-control net temp" name="h_c_ncb" id="h_c_ncb" >
                                     <span class="input-group-addon" id="h_c_ncb_span"></span>
                                 </div>
                            </div>
                    </div>
                  </div>
              </li>
              
              <li class="item hidden h_ncb_div">
                  <div class="col-lg-3 col-md-4 col-sm-6 ">
                    <div class="card border-0" style="width: 15rem;">
                       <div class="form-group">
                                <label>D(NCB %)</label>
                                <div class="input-group">
                                    <input type="number" class="form-control net temp" name="h_d_ncb" id="h_d_ncb" >
                                     <span class="input-group-addon" id="h_d_ncb_span"></span>
                                 </div>
                            </div>
                    </div>
                  </div>
              </li>
        </div>
    </ul>
        </div> 
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-sm btn-primary" id="h_next_btn">Add <i class="fa fa-angle-double-right"></i></button>
                <button type="button" class="btn btn-sm btn-success" id="h_add_btn" disabled>Save changes</button>
            </div>
        </div>
    </div>
  </div>
  
  
  
 <div class="modal fade in" id="edit_model">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header" style='background-color: #33b781;;'>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true" style="color:white;">×</span></button>
                <h4 class="modal-title text-center" style="color:#fff;">Edit Payout Commission</h4>
            </div>
            
            <div class="modal-body">
                <input type = "hidden" id="edit_id">
                
              <div class="row">
                <div class="col-md-2">
                    <div class="form-group">
                            <label>Insurer Company</label>
                            <select class="form-control select2" style="width:100%;height:100%;" name="edit_insurer_company" id="edit_insurer_company">
                                <option value="">--Select--</option>
                                 <?php foreach($insurer_company as $da) { ?>
                                  <option value="<?php echo $da->id ?>"><?php echo $da->company_name ?></option>
                                <?php } ?>
                            </select>
                    </div>
                </div>
                
                <div class="col-md-2">
                       <div class="form-group">
                                    <label>Commission Type</label>
                                    <select class="form-control" name="edit_commission_type" id="edit_commission_type">
                                        <option value="">--Select--</option>
                                         <?php foreach($commission_type as $da){  ?>
                                          <option value="<?php echo $da->id ?>"><?php echo $da->type ?></option>
                                         <?php } ?>
                                    </select>
                         </div>
                </div>
                
                
                <div class="col-md-2">
                    <div class="form-group">
                        <label>Policy Type</label>
                        <select class="form-control" name="edit_policy_type" id="edit_policy_type">
                            <option value="">--Select--</option>
                            <?php foreach($policy_type as $da){ ?>
                            
                            <option value="<?php echo $da->id ?>"><?php echo $da->policy_type ?></option>
                            
                            <?php } ?>
                        </select>
                    </div>
                </div>
                
                
                 <div class="col-md-1">
                      <div class="form-group">
                                    <label>IRD OD(%)</label>
                                      <input class="form-check-input temp" type="checkbox" value="Yes" id="edit_ird_od_commission_checkbox">
                                    <input type="number" class="form-control" name="edit_ird_od_commission" id="edit_ird_od_commission"  readonly>
                                </div>
                          </div>
                          
                             <div class="col-md-1">
                                  <div class="form-group">
                                    <label>IRD TP(%)</label>
                                     <input class="form-check-input temp" type="checkbox" value="Yes" id="edit_ird_tp_commission_checkbox">
                                    <input type="number" class="form-control" name="edit_ird_tp_commission" id="edit_ird_tp_commission" readonly>
                                </div>
                          </div>
               
                
                
                <div class="col-md-1">
                     <div class="form-group">
                        <label>From Date</label>
                        <input type="date" class="form-control" name="edit_f_date" id="edit_f_date">
                     </div>
                </div>
                
                <div class="col-md-1">
                    <div class="form-group">
                        <label>To Date</label>
                         <input type="date" class="form-control" name="edit_to_date" id="edit_to_date">
                    </div>
                </div>
                
                <div class="col-md-2"> 
                    <label>State</label>
                    <div class="form-group">
                        <select class="form-control" name="edit_ins_state" id="edit_ins_state">
                            <option value="">--Select--</option>
                            <option value="All">All</option>
                            <?php foreach($state as $da) { ?>
                              <option value="<?php echo $da->id ?>"><?php echo $da->name ?></option>
                            <?php } ?>
                        </select>
                     </div>
                </div>
                
            </div>
            
              <ul class="hs">
                   
              <div class = "row">  
                    <!-- start 2023-08-17 //-->
                    <li class="item">
                                <div class="col-lg-3 col-md-4 col-sm-6 ">
                                <div class="card border-0" style="width: 15rem;">
                                <div class="form-group">
                                    <label>Payout Type</label>
                                        <select class="form-control temp" name="edit_payout_type" id="edit_payout_type">
                                            <option value="">--Select--</option>
                                            <option value="Fresh">Fresh</option>
                                            <option value="Renewal">Renewal</option>
                                        </select>
                                </div>
                            </div>
                        </div>
                    </li>
                    <!-- end 2023-08-17 //-->
                    <li class="item">
                        <div class="col-lg-3 col-md-4 col-sm-6">
                            <div class="card border-0" style="width: 15rem;">
                                <div class="form-group">
                                    <label>IRD Commission(%)</label>                                                    
                                    <input class="form-check-input temp" type="checkbox" value="Yes" id="edit_ird_commission_checkbox" onclick="setAttributes(this, 'edit_ird_commission')">
                                    <input type="number" class="form-control" name="edit_ird_commission" id="edit_ird_commission" value="15" readonly>
                                </div>
                            </div>
                        </div>
                    </li>
                  <li class="item">
                            <div class="col-lg-3 col-md-4 col-sm-6 ">
                             <div class="card border-0" style="width: 15rem;">
                               <div class="form-group">
                                 <label>Type</label>
                                    <select class="form-control temp" name="edit_type" id="edit_type">
                                        <option value="">--Select--</option>
                                        <option value="including">including</option>
                                        <option value="Excluding">Excluding</option>
                                    </select>
                            </div>
                        </div>
                    </div>
                 </li>
                 
                 <li class="item">
                     <div class="col-lg-3 col-md-4 col-sm-6 ">
                         <div class="card border-0" style="width: 15rem;">
                            <div class="form-group">
                                <label>Premium Type</label>
                                <select class="form-control temp" name="edit_premium_c_type" id="edit_premium_c_type">
                                    <option value="">--Select--</option>
                                    <?php foreach($type as $da) { ?>
                                      <option value="<?php echo $da->id ?>"><?php echo $da->name ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                 </li>
            
        <li class="item">
            <div class="col-lg-3 col-md-4 col-sm-6 ">
                <div class="card border-0" style="width: 15rem;">
                    <div class="form-group">
                        <label>Make</label>
                        <select class="form-control select2 temp" name="edit_make" id="edit_make" multiple style="width:100%;height:100%;">
                            <option value="">--Select--</option>
                            <option value="all">All</option>
                        </select>
                        </div>
                </div>
            </div>
        </li>
            
      <li class="item">
          <div class="col-lg-3 col-md-4 col-sm-6 ">
            <div class="card border-0" style="width: 15rem;">
                <div class="form-group">
                    <label>Model</label>
                    <select class="form-control select2 temp" name="edit_model_motor" id="edit_model_motor" multiple style="width:100%;height:100%;">
                        <option value="">--Select--</option>
                        <option value="all">All</option>
                    </select>
                </div>
            </div>
         </div>
      </li>


    <li class="item">
      <div class="col-lg-3 col-md-4 col-sm-6 ">
        <div class="card border-0" style="width: 15rem;">
            <div class="form-group">
                <label>Varient</label>
                <select class="form-control select2 temp" name="edit_varient" id="edit_varient" multiple style="width:100%;height:100%;">
                    <option value="">--Select--</option>
                    <option value="all">All</option>
                </select>
            </div>
        </div>
      </div>
    </li>


     <li class="item">
          <div class="col-lg-3 col-md-4 col-sm-6 ">
            <div class="card border-0" style="width: 15rem;">
                <div class="form-group">
                    <label>Fuel Type</label>
                    <select class="form-control temp" name="edit_fuel_type" id="edit_fuel_type">
                        <option value="">--Select--</option>
                        <?php foreach($fuel_type as $da){  ?>
                             <option value="<?php echo $da->id ?>"><?php echo $da->fuel_type ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
          </div>
        </li>

    <li class="item">
          <div class="col-lg-3 col-md-4 col-sm-6 ">
            <div class="card border-0" style="width: 15rem;">
                <div class="form-group">
                    <label>Vechicle Classification</label>
                    <select class="form-control temp" name="edit_ins_classification" id="edit_ins_classification">
                        <option value="">--Select--</option>
                    </select>
                </div>
            </div>
          </div>
        </li>

    <li class="item">
          <div class="col-lg-3 col-md-4 col-sm-6 ">
            <div class="card border-0" style="width: 15rem;">
                <div class="form-group">
                    <label>RTO Category</label>
                    <select class="form-control temp" name="edit_rto_category" id="edit_rto_category">
                        <option value = "">--Select--</option>
                        <option value='ROTN_Exclude'>ROTN(Exclude)</option>
                        <option value='Others'>Others</option>
                    </select>
                </div>
            </div>
          </div>
        </li>
    
    <li class="item">
          <div class="col-lg-3 col-md-4 col-sm-6 ">
            <div class="card border-0" style="width: 15rem;">
                    <div class="form-group">
                    <label>RTO</label>&nbsp;<button class="btn btn-danger btn-xs" onclick=remove_all_rto()><i class="fa fa-trash"></i>&nbsp;Delete All Rto</button>
                    <select class="form-control select2 temp" name="edit_ins_rto" id="edit_ins_rto" multiple data-placeholder="Select a RTO" style="width:100%">
                        <?php foreach($rto as $da) { ?>
                          <option value="<?php echo $da->rto_no ?>"><?php echo $da->rto_no." (".$da->city.")" ?></option>
                        <?php } ?>
                    </select>
                    </div>
            </div>
          </div>
        </li>
        
    <li class="item" id="edit_vechi_div_1">
          <div class="col-lg-3 col-md-4 col-sm-6 ">
            <div class="card border-0" style="width: 15rem;">
                <div class="form-group">
                    <label>Vehicle Age(Min)</label>
                    <input type="number" class="form-control temp" name="edit_vehicle_age_min" id="edit_vehicle_age_min">
                </div>
            </div>
          </div>
        </li>
        
     <li class="item" id="edit_vechi_div_2">
          <div class="col-lg-3 col-md-4 col-sm-6 ">
            <div class="card border-0" style="width: 15rem;">
                <div class="form-group">
                    <label>Vehicle Age(Max)</label>
                    <input type="number" class="form-control temp" name="edit_vehicle_age_max" id="edit_vehicle_age_max">
                </div>
            </div>
          </div>
        </li>
        
     <li class="item hidden" id="edit_nop_div_1">
          <div class="col-lg-3 col-md-4 col-sm-6 ">
            <div class="card border-0" style="width: 15rem;">
                <div class="form-group">
                    <label>Number of Policy(Min)</label>
                     <input type="number" class="form-control temp" name="edit_no_policy_min" id="edit_no_policy_min">
                </div>
            </div>
          </div>
        </li>
        
      <li class="item hidden" id="edit_nop_div_2">
          <div class="col-lg-3 col-md-4 col-sm-6 ">
            <div class="card border-0" style="width: 15rem;">
                <div class="form-group">
                    <label>Number of Policy(Max)</label>
                    <input type="number" class="form-control temp" name="edit_no_policy_max" id="edit_no_policy_max">
                </div>
            </div>
          </div>
        </li>
        
      <li class="item hidden" id="edit_target_div_1">
              <div class="col-lg-3 col-md-4 col-sm-6 ">
                <div class="card border-0" style="width: 15rem;">
                    <div class="form-group">
                        <label>Min value</label>
                         <input type="number" class="form-control temp" name="edit_min_amount" id="edit_min_amount">
                    </div>
                </div>
              </div>
          </li>
          
      <li class="item hidden" id="edit_target_div_2">
              <div class="col-lg-3 col-md-4 col-sm-6 ">
                <div class="card border-0" style="width: 15rem;">
                    <div class="form-group">
                        <label>Max Value</label>
                        <input type="number" class="form-control temp" name="edit_max_amount" id="edit_max_amount">
                    </div>
                </div>
              </div>
          </li>

      <li class="item">
            <div class="col-lg-3 col-md-4 col-sm-6 ">
            <div class="card border-0" style="width: 7rem;margin-top:10px;">
                <div class="form-group">
                  <input class="form-check-input temp" type="checkbox" value="Yes" id="edit_is_com_ncb">
                  &nbsp;<b>ON NCB</b>
                </div>
            </div>
        </div>
     </li>    
     
     <li class="item hidden edit_ncb_div_per">
            <div class="col-lg-3 col-md-4 col-sm-6 ">
            <div class="card border-0" style="width: 15rem;">
                    <div class="form-group">
                        <label>ON NCB</label>
                            <input type="number" placeholder="Enter NCB Percentage" class="form-control temp" name="edit_ncb_percentage" id="edit_ncb_percentage" >
                    </div>
            </div>
        </div>
     </li>    
          
      <!-- 2023-07-20 start //-->
     <li class="item">
            <div class="col-lg-3 col-md-4 col-sm-6 ">
            <div class="card border-0" style="width: 7rem;margin-top:10px;">
                <div class="form-group">
                  <input class="form-check-input temp" type="checkbox" value="Yes" id="edit_is_com_cpa">
                  &nbsp;<b>Is CPA</b>
                </div>
            </div>
        </div>
     </li>    
          
       <li class="item hidden edit_cpa_div_per">
            <div class="col-lg-3 col-md-4 col-sm-6 ">
            <div class="card border-0" style="width: 15rem;">
                    <div class="form-group">
                        <label>With CPA</label>
                            <input type="number" placeholder="Enter CPA Percentage" class="form-control temp" name="edit_cpa_percentage" id="edit_cpa_percentage" >
                    </div>
            </div>
        </div>
     </li>
     <!-- 2023-07-20 end //-->        
          
      <li class="item">
              <div class="col-lg-3 col-md-4 col-sm-6 ">
                <div class="card border-0" style="width: 15rem;">
                    <div class="form-group" id='own_od_div'>
                                <label>Own OD(%)</label>
                                <input type="number" class="form-control temp" name="edit_own_od" id="edit_own_od" >
                      </div>
                </div>
              </div>
          </li>

      <li class="item">
          <div class="col-lg-3 col-md-4 col-sm-6 ">
            <div class="card border-0" style="width: 15rem;">
                <div class="form-group" id="own_tp_div">
                    <label>Own Tp(%)</label>
                    <input type="number" class="form-control temp" name="edit_own_tp" id="edit_own_tp" >
                </div>
            </div>
          </div>
      </li>
      
      <li class="item">
          <div class="col-lg-3 col-md-4 col-sm-6 ">
            <div class="card border-0" style="width: 15rem;">
                <div class="form-group">
                    <label>Own Net(%)</label>
                    <input type="number" class="form-control temp" name="edit_on_net" id="edit_on_net" >
                </div>
            </div>
          </div>
      </li>
      
      <li class="item">
          <div class="col-lg-3 col-md-4 col-sm-6 ">
            <div class="card border-0" style="width: 15rem;">
                <div class="form-group">
                    <label>Agent Commission Type</label>
                        <select class="form-control temp"  id="edit_agn_com_type" name="edit_agn_com_type">
                            <option value="">--select--</option>
                            <option value="OD">OD</option>
                            <option value="TP">TP</option>
                            <option value="ON-NET">ON-NET</option>
                            <option value="OD_AND_TP">OD_AND_TP</option>
                        </select>
                </div>
            </div>
          </div>
      </li>
      
      <li class="item">
         <div class="col-lg-3 col-md-4 col-sm-6 ">
              <div class="card border-0" style="width: 15rem;">
                    <div class="form-group">
                            <label>Agency/Pos</label>
                            <select class="form-control select2" style="width:100%;height:100%;" name="edit_agency" id="edit_agency" multiple>
                                <option value="">--Select--</option>
                                 <?php foreach($agents_pos as $da) { ?>
                                  <option value="<?php echo $da->id ?>"><?php echo $da->name ?></option>
                                <?php } ?>
                            </select>
                    </div>
                    </div>
                </div>
            </li>
      
      
      <li class="item">
          <div class="col-lg-3 col-md-4 col-sm-6 ">
            <div class="card border-0" style="width: 15rem;">
                <div class="form-group">
                    <label>Special Commission(%)</label>
                    <input type="number" class="form-control temp" name="edit_special_com" id="edit_special_com" >
                </div>
            </div>
          </div>
      </li>
      
      <li class="item hidden edit_od_div">
          <div class="col-lg-3 col-md-4 col-sm-6 ">
            <div class="card border-0" style="width: 15rem;">
                <div class="form-group">
                        <label>A(OD%)</label>
                           <div class="input-group">
                                <input type="number" class="form-control edit_od temp" name="edit_a_od" id="edit_a_od">
                                <span class="input-group-addon" id="a_od_span"></span>
                           </div>
                    </div>
            </div>
          </div>
      </li>
      
      <li class="item hidden edit_od_div">
          <div class="col-lg-3 col-md-4 col-sm-6 ">
            <div class="card border-0" style="width: 15rem;">
               <div class="form-group">
                        <label>B(OD%)</label>
                        <div class="input-group">
                            <input type="number" class="form-control edit_od temp" name="edit_b_od" id="edit_b_od" >
                            <span class="input-group-addon" id="b_od_span"></span>
                         </div>
                    </div>
            </div>
          </div>
      </li>
      
      <li class="item hidden edit_od_div">
          <div class="col-lg-3 col-md-4 col-sm-6 ">
            <div class="card border-0" style="width: 15rem;">
               <div class="form-group">
                        <label>C(OD%)</label>
                        <div class="input-group">
                            <input type="number" class="form-control edit_od temp" name="edit_c_od" id="edit_c_od" >
                             <span class="input-group-addon" id="c_od_span"></span>
                         </div>
                </div>
            </div>
          </div>
      </li>
      
      <li class="item hidden edit_od_div">
          <div class="col-lg-3 col-md-4 col-sm-6 ">
            <div class="card border-0" style="width: 15rem;">
               <div class="form-group">
                        <label>D(OD%)</label>
                        <div class="input-group">
                            <input type="number" class="form-control edit_od temp" name="edit_d_od" id="edit_d_od" >
                             <span class="input-group-addon" id="d_od_span"></span>
                         </div>
                </div>
            </div>
          </div>
      </li>
      
      
      <li class="item hidden edit_tp_div">
          <div class="col-lg-3 col-md-4 col-sm-6 ">
            <div class="card border-0" style="width: 15rem;">
               <div class="form-group">
                        <label>A(TP%)</label>
                           <div class="input-group">
                                <input type="number" class="form-control edit_tp temp" name="edit_a_tp" id="edit_a_tp" >
                                <span class="input-group-addon" id="a_tp_span"></span>
                           </div>
                    </div>
            </div>
          </div>
      </li>
      
      <li class="item hidden edit_tp_div">
          <div class="col-lg-3 col-md-4 col-sm-6 ">
            <div class="card border-0" style="width: 15rem;">
               <div class="form-group">
                        <label>B(TP%)</label>
                        <div class="input-group">
                            <input type="number" class="form-control edit_tp temp" name="edit_b_tp" id="edit_b_tp" >
                            <span class="input-group-addon" id="b_tp_span"></span>
                         </div>
                    </div>
            </div>
          </div>
      </li>
      
      <li class="item hidden edit_tp_div">
          <div class="col-lg-3 col-md-4 col-sm-6 ">
            <div class="card border-0" style="width: 15rem;">
               <div class="form-group">
                        <label>C(TP%)</label>
                        <div class="input-group">
                            <input type="number" class="form-control edit_tp temp" name="edit_c_tp" id="edit_c_tp" >
                             <span class="input-group-addon" id="c_tp_span"></span>
                         </div>
                    </div>
            </div>
          </div>
      </li>
      
      <li class="item hidden edit_tp_div">
          <div class="col-lg-3 col-md-4 col-sm-6 ">
            <div class="card border-0" style="width: 15rem;">
               <div class="form-group">
                        <label>D(TP%)</label>
                        <div class="input-group">
                            <input type="number" class="form-control edit_tp temp" name="edit_d_tp" id="edit_d_tp" >
                             <span class="input-group-addon" id="d_tp_span"></span>
                         </div>
                    </div>
            </div>
          </div>
      </li>
      
      
      <li class="item hidden edit_net_div">
          <div class="col-lg-3 col-md-4 col-sm-6 ">
            <div class="card border-0" style="width: 15rem;">
               <div class="form-group">
                        <label>A(NET %)</label>
                           <div class="input-group">
                                <input type="number" class="form-control edit_net temp" name="edit_a_net" id="edit_a_net" >
                                <span class="input-group-addon" id="a_net_span"></span>
                           </div>
                    </div>
            </div>
          </div>
      </li>
      
      <li class="item hidden edit_net_div">
          <div class="col-lg-3 col-md-4 col-sm-6 ">
            <div class="card border-0" style="width: 15rem;">
               <div class="form-group">
                        <label>B(NET %)</label>
                        <div class="input-group">
                            <input type="number" class="form-control edit_net temp" name="edit_b_net" id="edit_b_net" >
                            <span class="input-group-addon" id="b_net_span"></span>
                         </div>
                    </div>
            </div>
          </div>
      </li>
      
      <li class="item hidden edit_net_div">
          <div class="col-lg-3 col-md-4 col-sm-6 ">
            <div class="card border-0" style="width: 15rem;">
                 <div class="form-group">
                        <label>C(NET %)</label>
                        <div class="input-group">
                            <input type="number" class="form-control edit_net temp" name="edit_c_net" id="edit_c_net" >
                             <span class="input-group-addon" id="c_net_span"></span>
                         </div>
                    </div>
            </div>
          </div>
      </li>
      
      <li class="item hidden edit_net_div">
          <div class="col-lg-3 col-md-4 col-sm-6 ">
            <div class="card border-0" style="width: 15rem;">
                 <div class="form-group">
                        <label>D(NET %)</label>
                        <div class="input-group">
                            <input type="number" class="form-control edit_net temp" name="edit_d_net" id="edit_d_net" >
                             <span class="input-group-addon" id="d_net_span"></span>
                         </div>
                    </div>
            </div>
          </div>
      </li>
      
      <li class="item hidden edit_ncb_div">
          <div class="col-lg-3 col-md-4 col-sm-6 ">
            <div class="card border-0" style="width: 15rem;">
                  <div class="form-group">
                        <label>A(NCB %)</label>
                           <div class="input-group">
                                <input type="number" class="form-control edit_ncb temp" name="edit_a_ncb" id="edit_a_ncb" >
                                <span class="input-group-addon" id="a_ncb_span"></span>
                           </div>
                    </div>
            </div>
          </div>
      </li>
      
      <li class="item hidden edit_ncb_div">
          <div class="col-lg-3 col-md-4 col-sm-6 ">
            <div class="card border-0" style="width: 15rem;">
                 <div class="form-group">
                        <label>B(NCB %)</label>
                        <div class="input-group">
                            <input type="number" class="form-control edit_ncb temp" name="edit_b_ncb" id="edit_b_ncb" >
                            <span class="input-group-addon" id="b_ncb_span"></span>
                         </div>
                    </div>
            </div>
          </div>
      </li>
      
      <li class="item hidden edit_ncb_div">
          <div class="col-lg-3 col-md-4 col-sm-6 ">
            <div class="card border-0" style="width: 15rem;">
                <div class="form-group">
                        <label>C(NCB %)</label>
                        <div class="input-group">
                            <input type="number" class="form-control edit_ncb temp" name="edit_c_ncb" id="edit_c_ncb" >
                             <span class="input-group-addon" id="c_ncb_span"></span>
                         </div>
                    </div>
            </div>
          </div>
      </li>
      
      <li class="item hidden edit_ncb_div">
          <div class="col-lg-3 col-md-4 col-sm-6 ">
            <div class="card border-0" style="width: 15rem;">
               <div class="form-group">
                        <label>D(NCB %)</label>
                        <div class="input-group">
                            <input type="number" class="form-control edit_ncb temp" name="edit_d_ncb" id="edit_d_ncb" >
                             <span class="input-group-addon" id="d_ncb_span"></span>
                         </div>
                    </div>
            </div>
          </div>
      </li>
      <!-- 2023-07-20 start //-->
      <li class="item hidden edit_cpa_div">
          <div class="col-lg-3 col-md-4 col-sm-6 ">
            <div class="card border-0" style="width: 15rem;">
                  <div class="form-group">
                        <label>A(CPA %)</label>
                           <div class="input-group">
                                <input type="number" class="form-control edit_cpa temp" name="edit_a_cpa" id="edit_a_cpa" >
                                <span class="input-group-addon" id="edit_a_cpa_span"></span>
                           </div>
                    </div>
            </div>
          </div>
      </li>
      
      <li class="item hidden edit_cpa_div">
          <div class="col-lg-3 col-md-4 col-sm-6 ">
            <div class="card border-0" style="width: 15rem;">
                 <div class="form-group">
                        <label>B(CPA %)</label>
                        <div class="input-group">
                            <input type="number" class="form-control edit_cpa temp" name="edit_b_cpa" id="edit_b_cpa">
                            <span class="input-group-addon" id="edit_b_cpa_span"></span>
                         </div>
                    </div>
            </div>
          </div>
      </li>
      
      <li class="item hidden edit_cpa_div">
          <div class="col-lg-3 col-md-4 col-sm-6 ">
            <div class="card border-0" style="width: 15rem;">
                <div class="form-group">
                        <label>C(CPA %)</label>
                        <div class="input-group">
                            <input type="number" class="form-control edit_cpa temp" name="edit_c_cpa" id="edit_c_cpa">
                             <span class="input-group-addon" id="edit_c_cpa_span"></span>
                         </div>
                    </div>
            </div>
          </div>
      </li>
      
      <li class="item hidden edit_cpa_div">
          <div class="col-lg-3 col-md-4 col-sm-6 ">
            <div class="card border-0" style="width: 15rem;">
               <div class="form-group">
                        <label>D(CPA %)</label>
                        <div class="input-group">
                            <input type="number" class="form-control edit_cpa temp" name="edit_d_cpa" id="edit_d_cpa" >
                             <span class="input-group-addon" id="edit_d_cpa_span"></span>
                         </div>
                    </div>
            </div>
          </div>
      </li>
      <!-- 2023-07-20 end //-->
      
   </div>
 </ul>
        </div> 
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-default pull-left" data-dismiss="modal">Close</button>
                <span id="error_id" style='color:red;'></span>&nbsp;
                <button type="button" class="btn btn-sm btn-primary" id="edit_btn">Update</button>
                <button type="button" class="btn btn-sm btn-success" id="forward_btn">Carry Forward to Next Month</button>
            </div>
        </div>
    </div>
  </div>

  <div class="modal fade in" id="edit_health_model">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header" style='background-color: #33b781;;'>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true" style="color:white;">×</span></button>
                <h4 class="modal-title text-center" style="color:#fff;">Payout Commission</h4>
            </div>
            
            <div class="modal-body">
                <input type = "hidden" id="health_edit_id">
              <div class="row">
                  
                <div class="col-md-2">
                    <div class="form-group">
                            <label>Insurer Company</label>
                            <select class="form-control select2" style="width:100%;height:100%;" name="edit_h_insurer_company" id="edit_h_insurer_company">
                                <option value="">--Select--</option>
                                 <?php foreach($insurer_company as $da) { ?>
                                  <option value="<?php echo $da->id ?>"><?php echo $da->company_name ?></option>
                                <?php } ?>
                            </select>
                    </div>
                </div>
                
                <div class="col-md-2">
                    <div class="form-group">
                        <label>Commission Type</label>
                        <select class="form-control" name="edit_h_commission_type" id="edit_h_commission_type">
                            <option value="">--Select--</option>
                             <?php foreach($commission_type as $da){
                                if($da->id != "2")
                                {
                             ?>
                              <option value="<?php echo $da->id ?>"><?php echo $da->type ?></option>
                             <?php }} ?>
                        </select>
                    </div>
                </div>
               
                <div class="col-md-2">
                    <div class="form-group">
                        <label>Policy Type</label>
                        <select class="form-control" name="edit_h_policy_type" id="edit_h_policy_type">
                            <option value="">--Select--</option>
                            <?php foreach($health_policy_type as $da){ ?>
                            
                            <option value="<?php echo $da->id ?>"><?php echo $da->policy_type ?></option>
                            
                            <?php } ?>
                        </select>
                    </div>
                </div>
                
                <div class="col-md-2">
                     <div class="form-group">
                        <label>From Date</label>
                        <input type="date" class="form-control" name="edit_h_f_date" id="edit_h_f_date">
                     </div>
                </div>
                
                <div class="col-md-2">
                    <div class="form-group">
                        <label>To Date</label>
                         <input type="date" class="form-control" name="edit_h_to_date" id="edit_h_to_date">
                    </div>
                </div>
                
                <div class="col-md-2"> 
                    <label>State</label>
                    <div class="form-group">
                        <select class="form-control" name="edit_h_ins_state" id="edit_h_ins_state">
                            <option value="">--Select--</option>
                            <option value="All">All</option>
                            <?php foreach($state as $da) { ?>
                              <option value="<?php echo $da->id ?>"><?php echo $da->name ?></option>
                            <?php } ?>
                        </select>
                     </div>
                </div>
                
            </div>
            
              <ul class="hs">
                   
              <div class = "row">   
<!-- 2023-05-25 start //-->              
                <li class="item">
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <div class="card border-0" style="width: 15rem;">
                            <div class="form-group">
                                <label>IRD Commission(%)</label>                                                    
                                <input class="form-check-input temp" type="checkbox" value="Yes" id="edit_health_ird_commission_checkbox" onclick="setAttributes(this, 'edit_health_ird_commission')">
                                <input type="number" class="form-control" name="edit_health_ird_commission" id="edit_health_ird_commission"  readonly>
                            </div>
                        </div>
                    </div>
                </li>
<!-- 2023-05-25 end//-->               
              <li class="item">
                 <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="card border-0" style="width: 15rem;">
                      <div class="form-group">
                          <label>Business Type</label>
                            <select class="form-control" name="edit_h_business_type" id="edit_h_business_type">
                                <option value="">--Select--</option>
                                <?php foreach($business_type as $da) { ?>
                                  <option value="<?php echo $da->id ?>"><?php echo $da->bussiness_type ?></option>
                                <?php } ?>
                            </select>
                         </div>
                    </div>
                  </div>
              </li>
              
                <li class="item hidden" id="edit_h_nop_div_1">
                  <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="card border-0" style="width: 15rem;">
                        <div class="form-group">
                            <label>Number of Policy(Min)</label>
                             <input type="number" class="form-control temp" name="edit_h_no_policy_min" id="edit_h_no_policy_min">
                        </div>
                    </div>
                  </div>
              </li>
        
                <li class="item hidden" id="edit_h_nop_div_2">
                   <div class="col-lg-3 col-md-4 col-sm-6 ">
                        <div class="card border-0" style="width: 15rem;">
                            <div class="form-group">
                                <label>Number of Policy(Max)</label>
                                <input type="number" class="form-control temp" name="edit_h_no_policy_max" id="edit_h_no_policy_max">
                            </div>
                        </div>
                   </div>
              </li>
        
            <li class="item hidden" id="edit_h_target_div_1">
                  <div class="col-lg-3 col-md-4 col-sm-6 ">
                    <div class="card border-0" style="width: 15rem;">
                        <div class="form-group">
                            <label>Min Value</label>
                             <input type="number" class="form-control temp" name="edit_h_min_amount" id="edit_h_min_amount">
                        </div>
                    </div>
                  </div>
              </li>
              
                <li class="item hidden" id="edit_h_target_div_2">
                              <div class="col-lg-3 col-md-4 col-sm-6 ">
                                <div class="card border-0" style="width: 15rem;">
                                    <div class="form-group">
                                        <label>Max Value</label>
                                        <input type="number" class="form-control temp" name="edit_h_max_amount" id="edit_h_max_amount">
                                    </div>
                                </div>
                              </div>
                          </li>
    
                 <li class="item">
                        <div class="col-lg-3 col-md-4 col-sm-6 ">
                            <div class="card border-0" style="width: 7rem;margin-top:10px;">
                                <div class="form-group">
                                  <input class="form-check-input temp" type="checkbox" value="Yes" id="edit_h_is_com_ncb">
                                  &nbsp;<b>ON NCB</b>
                                </div>
                            </div>
                       </div>
                 </li>    
         
                <li class="item hidden edit_h_ncb_div_per">
                     <div class="col-lg-3 col-md-4 col-sm-6 ">
                            <div class="card border-0" style="width: 15rem;">
                                    <div class="form-group">
                                        <label>ON NCB</label>
                                            <input type="number" placeholder="Enter NCB Percentage" class="form-control temp" name="edit_h_ncb_percentage" id="edit_h_ncb_percentage">
                                    </div>
                            </div>
                       </div>
                </li>    
    
                <li class="item">
                      <div class="col-lg-3 col-md-4 col-sm-6 ">
                        <div class="card border-0" style="width: 15rem;">
                            <div class="form-group">
                                <label>Own Net(%)</label>
                                <input type="number" class="form-control temp" name="edit_h_on_net" id="edit_h_on_net" >
                            </div>
                        </div>
                      </div>
                  </li>

              <li class="item h_net_div">
                  <div class="col-lg-3 col-md-4 col-sm-6 ">
                    <div class="card border-0" style="width: 15rem;">
                       <div class="form-group">
                                <label>A(NET %)</label>
                                   <div class="input-group">
                                        <input type="number" class="form-control net temp" name="edit_h_a_net" 
                                        id="edit_h_a_net">
                                        <span class="input-group-addon" id="edit_h_a_net_span"></span>
                                   </div>
                            </div>
                      </div>
                  </div>
              </li>
              
              <li class="item h_net_div">
                  <div class="col-lg-3 col-md-4 col-sm-6 ">
                    <div class="card border-0" style="width: 15rem;">
                       <div class="form-group">
                                <label>B(NET %)</label>
                                <div class="input-group">
                                    <input type="number" class="form-control net temp" name="edit_h_b_net" id="edit_h_b_net" >
                                    <span class="input-group-addon" id="edit_h_b_net_span"></span>
                                 </div>
                            </div>
                    </div>
                  </div>
              </li>
              
              <li class="item h_net_div">
                  <div class="col-lg-3 col-md-4 col-sm-6 ">
                    <div class="card border-0" style="width: 15rem;">
                         <div class="form-group">
                                <label>C(NET %)</label>
                                <div class="input-group">
                                    <input type="number" class="form-control net temp" name="edit_h_c_net" id="edit_h_c_net" >
                                     <span class="input-group-addon" id="edit_h_c_net_span"></span>
                                 </div>
                            </div>
                    </div>
                  </div>
              </li>
              
              <li class="item h_net_div">
                  <div class="col-lg-3 col-md-4 col-sm-6 ">
                    <div class="card border-0" style="width: 15rem;">
                         <div class="form-group">
                                <label>D(NET %)</label>
                                <div class="input-group">
                                    <input type="number" class="form-control net temp" name="edit_h_d_net" id="edit_h_d_net" >
                                     <span class="input-group-addon" id="edit_h_d_net_span"></span>
                                 </div>
                            </div>
                    </div>
                  </div>
              </li>
              
              <li class="item hidden h_ncb_div">
                  <div class="col-lg-3 col-md-4 col-sm-6 ">
                    <div class="card border-0" style="width: 15rem;">
                          <div class="form-group">
                                <label>A(NCB %)</label>
                                   <div class="input-group">
                                        <input type="number" class="form-control net temp" name="edit_h_a_ncb" id="edit_h_a_ncb" >
                                        <span class="input-group-addon" id="edit_h_a_ncb_span"></span>
                                   </div>
                            </div>
                    </div>
                  </div>
              </li>
              
              <li class="item hidden h_ncb_div">
                  <div class="col-lg-3 col-md-4 col-sm-6 ">
                    <div class="card border-0" style="width: 15rem;">
                         <div class="form-group">
                                <label>B(NCB %)</label>
                                <div class="input-group">
                                    <input type="number" class="form-control net temp" name="edit_h_b_ncb" id="edit_h_b_ncb" >
                                    <span class="input-group-addon" id="edit_h_b_ncb_span"></span>
                                 </div>
                            </div>
                    </div>
                  </div>
              </li>
              
              <li class="item hidden h_ncb_div">
                  <div class="col-lg-3 col-md-4 col-sm-6 ">
                    <div class="card border-0" style="width: 15rem;">
                        <div class="form-group">
                                <label>C(NCB %)</label>
                                <div class="input-group">
                                    <input type="number" class="form-control net temp" name="edit_h_c_ncb" id="edit_h_c_ncb" >
                                     <span class="input-group-addon" id="edit_h_c_ncb_span"></span>
                                 </div>
                            </div>
                    </div>
                  </div>
              </li>
              
              <li class="item hidden h_ncb_div">
                  <div class="col-lg-3 col-md-4 col-sm-6 ">
                    <div class="card border-0" style="width: 15rem;">
                       <div class="form-group">
                                <label>D(NCB %)</label>
                                <div class="input-group">
                                    <input type="number" class="form-control net temp" name="edit_h_d_ncb" id="edit_h_d_ncb" >
                                     <span class="input-group-addon" id="edit_h_d_ncb_span"></span>
                                 </div>
                            </div>
                    </div>
                  </div>
              </li>
        </div>
    </ul>
        </div> 
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-default pull-left" data-dismiss="modal">Close</button>
                <span id="error_id" style='color:red;'></span>&nbsp;
                <button type="button" class="btn btn-sm btn-primary" id="edit_health_btn">Update</button>
                <button type="button" class="btn btn-sm btn-success" id="health_forward_btn">Carry Forward to Next Month</button>
            </div>
        </div>
    </div>
  </div>
  
<div id="payout_log_modal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title text-center" style="color:#fff;">View Payout Commission Details</h4>
      </div>
      <div class="modal-body" id="payout_log_content">
       
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>


<div id="payout_old_log_modal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title text-center" style="color:#fff;">View Payout Commission Details</h4>
      </div>
      <div class="modal-body" id="payout_old_log_content">
       
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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
        <h4 class="modal-title text-center" style="color:#fff;">Payout Log - &nbsp;<span id="payout_title"></span></h4>
      </div>
      <div class="modal-body" id="view_payout_content">
       
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>


<div id="rto_model" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title text-center" style="color:#fff;">RTO Log</h4>
      </div>
      <div class="modal-body" id="rto_content">
       
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>


<div id="motor_model" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title text-center" style="color:#fff;" id="motor_title"></h4>
      </div>
      <div class="modal-body" id="motor_content">
       
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>


<div id="agent_com_model" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title text-center" style="color:#fff;">Agent commission</h4>
      </div>
      <div class="modal-body" id="agent_com_content">
       
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>


 <div class="modal fade" id="include_rto_modal" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header bg-primary">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title text-center" style = "color:#fff;">Include Rto</h4>
        </div>
        <div class="modal-body">
            
             <div class="form-group">
                    <label>State</label>
                    <select class="form-control" name="state" id="state">
                        <option value = "">--Select--</option>
                            <?php foreach($state as $da) { ?>
                              <option value="<?php echo $da->id ?>"><?php echo $da->name ?></option>
                            <?php } ?>
                    </select>
                </div>
    
             <div class = "row">
                 <div class="form-group col-md-6">
                    <label>From Date</label>
                     <input type="date" id="add_from_date" name="from_date" class="form-control" value="<?php echo date("Y-m-01") ?>">
                </div>
                
                 <div class="form-group col-md-6">
                    <label>To Date</label>
                     <input type="date" id="add_to_date" name="to_date" class="form-control" value="<?php echo date("Y-m-t") ?>">
                </div>
             </div>
                
              <div class = "form-group">
                  <select class = "form-control" name="rto_type" id="rto_type">
                      <option value = "">--Select Rto Type--</option>
                         <option value='ROTN_Exclude'>ROTN(Exclude)</option>
                         <option value='KA_Exclude'>KA(Exclude)</option>
                        <option value='Others'>Others</option>
                  </select>
              </div>  
              
               <div class = "form-group">
                  <select class = "form-control select2" name="rto" id="rto" style="width:100%">
                      <option value = "">-- Select Rto --</option>
                         <?php foreach($rto as $da) { ?>
                          <option value="<?php echo $da->rto_no ?>"><?php echo $da->rto_no." (".$da->city.")" ?></option>
                        <?php } ?>
                  </select>
              </div>  
              
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-primary" id="inc_rto_btn">Submit</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
  
</div>

  
  
  <script>
  
    var s_f_date = $("#s_f_date").val();
    var s_to_date = $("#s_to_date").val();
    
    var selected_rto = "";
     
      $(document).ready(function(){
          
        $('.select2').select2();
        
         fetch_payout_commission("1",s_f_date,s_to_date);
      
        $("#add_policy_type").change(function(){
             
            var insurer_class = $("#insurer_class").val();
            var insurance_company = $("#insurer_company").val();
            var business_type = $("#business_type").val();
            var premium_c_type = $("#premium_c_type").val();
            var policy_type = $("#add_policy_type").val();
            
                load_old_log(insurance_company,insurer_class,business_type,premium_c_type,policy_type);
                
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
         
         
           $("#ird_od_commission_checkbox").click(function(){

             if(this.checked)
             {
                $('#ird_od_commission').prop('readonly',false);
             }
             else{
                  $('#ird_od_commission').prop('readonly',true);
             }
         });
         
         $("#ird_tp_commission_checkbox").click(function(){
             if(this.checked)
             {
                $('#ird_tp_commission').prop('readonly',false);
             }
             else{
                  $('#ird_tp_commission').prop('readonly',true);
             }
             
         });
         
         
          $("#edit_ird_od_commission_checkbox").click(function(){

             if(this.checked)
             {
                $('#edit_ird_od_commission').prop('readonly',false);
             }
             else{
                  $('#edit_ird_od_commission').prop('readonly',true);
             }
         });
         
          $("#edit_ird_tp_commission_checkbox").click(function(){

             if(this.checked)
             {
                $('#edit_ird_tp_commission').prop('readonly',false);
             }
             else{
                  $('#edit_ird_tp_commission').prop('readonly',true);
             }
         });
         
         $("#commission_type").change(function(){
             
             var commission_type = $("#commission_type").val();
             
             if(commission_type == "1")
             {
                 $("#vechi_div_1").addClass("hidden");
                 $("#vechi_div_2").addClass("hidden");
                 $("#nop_div_1").removeClass("hidden");
                 $("#nop_div_2").removeClass("hidden");
                 $("#target_div_1").addClass("hidden");
                 $("#target_div_2").addClass("hidden");
                 
                 $("#vehicle_age_min").val("");
                 $("#vehicle_age_max").val("");
                 $("#min_amount").val("");
                 $("#max_amount").val("");
                
             }
             else if(commission_type == "2")
             {
                 $("#vechi_div_1").removeClass("hidden");
                 $("#vechi_div_2").removeClass("hidden");
                 $("#nop_div_1").addClass("hidden");
                 $("#nop_div_2").addClass("hidden");
                 $("#target_div_1").addClass("hidden");
                 $("#target_div_2").addClass("hidden");
                 $("#no_policy_min").val("");
                 $("#no_policy_max").val("");
                 $("#min_amount").val("");
                 $("#max_amount").val("");
                
             }
             else if(commission_type == "3")
             {
                 $("#vechi_div_1").addClass("hidden");
                 $("#vechi_div_2").addClass("hidden");
                 $("#nop_div_1").addClass("hidden");
                 $("#nop_div_2").addClass("hidden");
                 $("#target_div_1").removeClass("hidden");
                 $("#target_div_2").removeClass("hidden");
                 
                 $("#vehicle_age_min").val("");
                 $("#vehicle_age_max").val("");
                 $("#no_policy_min").val("");
                 $("#no_policy_max").val("");
             }
         });

         $("#h_commission_type").change(function(){
             var commission_type = $("#h_commission_type").val();
             if(commission_type == "1")
             {
                 $("#h_nop_div_1").removeClass("hidden");
                 $("#h_nop_div_2").removeClass("hidden");
                 $("#h_target_div_1").addClass("hidden");
                 $("#h_target_div_2").addClass("hidden");
                 $("#h_min_amount").val("");
                 $("#h_max_amount").val("");
                
             }
             else if(commission_type == "3")
             {
                 $("#h_nop_div_1").addClass("hidden");
                 $("#h_nop_div_2").addClass("hidden");
                 $("#h_target_div_1").removeClass("hidden");
                 $("#h_target_div_2").removeClass("hidden");
                 
                 $("#h_no_policy_min").val("");
                 $("#h_no_policy_max").val("");
             }
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
                   $(".od_div").removeClass("hidden");
                   $(".net_div").addClass("hidden");
                   $(".tp_div").addClass("hidden");
                   $(".tp").val("");
                   $(".net").val("");
                }
                else if(agn_com_type == "TP")
                {
                    $(".tp_div").removeClass("hidden");
                    $(".net_div").addClass("hidden");
                    $(".od_div").addClass("hidden");
                    $(".od").val("");
                    $(".net").val("");
                }
                else if(agn_com_type == "ON-NET")
                {
                    $(".net_div").removeClass("hidden");
                    $(".od_div").addClass("hidden");
                    $(".tp_div").addClass("hidden");
                    $(".od").val("");
                    $(".tp").val("");
                }
                else if(agn_com_type == "OD_AND_TP")
                {
                    $(".od_div").removeClass("hidden");
                    $(".tp_div").removeClass("hidden");
                    $(".net_div").addClass("hidden");
                    $(".net").val("");
                }
            
           });
           
         $("#is_com_ncb").change(function(){
               
               if($("#is_com_ncb").is(":checked"))
               {
                   $(".ncb_div_per").removeClass("hidden");
                   $(".ncb_div").removeClass("hidden");
               }
               else
               {
                    $(".ncb_div_per").addClass("hidden");
                    $(".ncb_div").addClass("hidden");
                    $(".ncb_percentage").val("");
               }
                    
           });
           
         $("#h_is_com_ncb").change(function(){
               
               if($("#h_is_com_ncb").is(":checked"))
               {
                   $(".h_ncb_div_per").removeClass("hidden");
                   $(".h_ncb_div").removeClass("hidden");
               }
               else
               {
                    $(".h_ncb_div_per").addClass("hidden");
                    $(".h_ncb_div").addClass("hidden");
                    $(".h_ncb_percentage").val("");
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
             var insurer_class = "1";
             var business_type = "";
            var ird_od_commission = $("#ird_od_commission").val();
            var ird_tp_commission = $("#ird_tp_commission").val();
            
            // start 2023-08-17
            var payout_type = $("#payout_type").val();
             
             var premium_c_type = $("#premium_c_type").val();
             var policy_type  = $("#add_policy_type").val();
             var commission_type = $("#commission_type").val();
             var add_type = $("#add_type").val();
             var make = $("#add_make").val();
             var model = $("#add_model_motor").val();
             var varient = $("#add_varient").val();
             var fuel_type = $("#add_fuel_type").val();
             var ins_classification = $("#ins_classification").val();
             var ins_state = $("#ins_state").val();
             var ins_rto = $("#ins_rto").val();
             var rto_category = $("#rto_category").val();
             var vehicle_age_max = $("#vehicle_age_max").val();
             var vehicle_age_min = $("#vehicle_age_min").val();
             var min_amount = $("#min_amount").val();
             var max_amount = $("#max_amount").val();
             var f_date = $("#f_date").val();
             var to_date = $("#to_date").val();
             var add_agency = $("#add_agency").val();
             var special_com =$("#special_com").val();
             
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
             
              if($("#is_com_cpa").is(":checked"))
             {
                 var is_com_cpa = "Yes";
             }
             else
             {
                 var is_com_cpa = "No";
             }
              var cpa_percentage = $("#cpa_percentage").val();
              
             var agn_com_non_ncb = $("#agn_com_type").val();
             // nop 
             var no_policy_min = $("#no_policy_min").val();
             var no_policy_max = $("#no_policy_max").val();
             
             
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
             
             var a_cpa = $("#a_cpa").val();
             var b_cpa = $("#b_cpa").val();
             var c_cpa = $("#c_cpa").val();
             var d_cpa = $("#d_cpa").val();
             
             var ird_commission = $("#ird_commission").val();
            
             var formdata = new FormData();
             formdata.append('insurer_company',insurer_company);
             formdata.append('insurer_class',insurer_class);
             formdata.append('business_type',business_type);
             formdata.append('ird_od_commission',ird_od_commission);
             formdata.append('ird_tp_commission',ird_tp_commission);
             formdata.append('premium_c_type',premium_c_type);
             formdata.append('policy_type',policy_type);
             formdata.append('commission_type',commission_type);
             formdata.append('add_type',add_type);
             formdata.append('make',make);
             formdata.append('model',model);
             formdata.append('varient',varient);
             formdata.append('fuel_type',fuel_type);
             formdata.append('ins_classification',ins_classification);
             formdata.append('ins_state',ins_state);
             formdata.append('ins_rto',ins_rto);
             formdata.append('rto_category',rto_category);
             formdata.append('vehicle_age_min',vehicle_age_min);
             formdata.append('vehicle_age_max',vehicle_age_max);
             formdata.append('agn_com_non_ncb',agn_com_non_ncb);
             formdata.append('is_com_ncb',is_com_ncb);
             formdata.append('special_com',special_com);
             formdata.append('add_agency',add_agency);
             
             formdata.append('is_com_cpa',is_com_cpa);

            // including
            formdata.append('own_od',own_od);
            formdata.append('own_tp',own_tp);
            formdata.append('on_net',on_net);
             
            // Excluding
            formdata.append('ncb_percentage',ncb_percentage);
            formdata.append('ird_com_od',ird_com_od);
            formdata.append('ird_com_tp',ird_com_tp);
            formdata.append('cpa_percentage',cpa_percentage);
            
             
             
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
             
              // CPA
             formdata.append('a_cpa',a_cpa);
             formdata.append('b_cpa',b_cpa);
             formdata.append('c_cpa',c_cpa);
             formdata.append('d_cpa',d_cpa);
             
              // nop 
             formdata.append('no_policy_min',no_policy_min);
             formdata.append('no_policy_max',no_policy_max);
             
             // target
             formdata.append('min_amount',min_amount);
             formdata.append('max_amount',max_amount);
             formdata.append('f_date',f_date);
             formdata.append('to_date',to_date);
             
             formdata.append('ird_commission',ird_commission);
             
             // start 2023-08-17
             formdata.append('payout_type', payout_type);
             
             var check = "0";
             
            if(insurer_company == "")
            {
                snackbar_show("Select Insurer Company");
                check = "1";
            }
            else if(insurer_class == "")
            {
                snackbar_show("Select Class");
                check = "1";
            }
            else if(insurer_class == "1" && premium_c_type == "")
            {
                snackbar_show("Select policy Cover Type");
                check = "1";
            }
            else if(policy_type == "")
            {
                snackbar_show("Select Policy Type");
                check = "1";
            }
            else if(commission_type == "")
            {
                snackbar_show("Select Commission Type");
                check = "1";
            }
            else if(insurer_class == "1" && add_type == "")
            {
                snackbar_show("Select Type Including/Exculding");
                check = "1";
            }
            else if(payout_type == "") // start 2023-08-17
            {
                snackbar_show("Select Payout Type");
                check = "1";
            }
            else if(insurer_class == "1" && make == "")
            {
                snackbar_show("Select Type Make");
                check = "1";
            }
            else if(insurer_class == "1" && model == "")
            {
                snackbar_show("Select Model");
                check = "1";
            }
            else if(insurer_class == "1" && varient == "")
            {
                snackbar_show("Select Varient");
                check = "1";
            }
            else if(insurer_class == "1" && fuel_type == "")
            {
                snackbar_show("Select Fuel Type");
                check = "1";
            }
            else if(insurer_class == "1" && ins_state == "")
            {
                snackbar_show("Select State");
                check = "1";
            }
            else if(insurer_class == "1" && rto_category == "")
            {
                snackbar_show("Select RTO Category");
                check = "1";
            }
            else if(insurer_class == "1" && ins_rto == null)
            {
                snackbar_show("Select RTO");
                check = "1";
            }
            else if(insurer_class == "1" && commission_type == "2" && vehicle_age_min == "")
            {
                snackbar_show("Enter Minimum Age");
                check = "1";
            }
            else if(insurer_class == "1" && commission_type == "2" && vehicle_age_max == "")
            {
                snackbar_show("Enter Maximum Age");
                check = "1";
            }
            else if(insurer_class == "1" && commission_type == "1" && no_policy_min == "")
            {
                snackbar_show("Enter No Of Policy Minimum");
                check = "1";
            }
            else if(insurer_class == "1" && commission_type == "1" && no_policy_max == "")
            {
                 snackbar_show("Enter No Of Policy Maximum");
                check = "1";
            }
            else if(insurer_class == "1" && commission_type == "3" && min_amount == "")
            {
                 snackbar_show("Enter Minimum Target Amount");
                check = "1";
            }
            else if(insurer_class == "1" && commission_type == "3" && max_amount == "")
            {
                snackbar_show("Enter Maximum Target Amount");
                check = "1";
            }
            else if($("#is_com_ncb").is(":checked") == true && ncb_percentage == "")
            {
                snackbar_show("Enter NCB Percentage");
                check = "1";
            }
            else if(insurer_class == "1" && $("#is_com_ncb").is(":checked") == false && premium_c_type == "1" && (own_od == "" && own_tp == "" && on_net == ""))
            {
                snackbar_show("Enter Own Commission Percentage");
                check = "1";
            }
            else if(insurer_class == "1" && $("#is_com_ncb").is(":checked") == false && premium_c_type == "2" && own_tp == "")
            {
                snackbar_show("Enter Own Tp Percentage");
                check = "1";
            }
            else if(insurer_class == "1" && $("#is_com_ncb").is(":checked") == false && premium_c_type == "3" && own_od == "")
            {
                snackbar_show("Enter Own OD Percentage");
                check = "1";
            }
            else if(insurer_class == "1" && $("#is_com_ncb").is(":checked") == false && premium_c_type == "4" && (own_od == "" && own_tp == "" && on_net == ""))
            {
                snackbar_show("Enter Own Commission Percentage");
                check = "1";
            }
            else if($("#is_com_ncb").is(":checked") == true && ncb_percentage == "")
            {
                snackbar_show("Enter NCB Percentage");
                check = "1";
            }
             else if($("#is_com_ncb").is(":checked") == true && cpa_percentage == "")
            {
                snackbar_show("Enter CPA Percentage");
                check = "1";
            }
            else if(f_date == "")
            {
                snackbar_show("Enter From Date");
                check = "1";
            }
            else if(to_date == "")
            {
                snackbar_show("Enter To Date");
                check = "1";
            }
            else if(check != "1")
            {
                $.ajax({
                        url : "check_payout_entry",
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
                            
                            
                        if(response != "") 
                        {
                            
                             var obj = jQuery.parseJSON(response);
                            
                            if(obj.status != "success")
                            {
                                Swal.fire({
                                  icon: 'error',
                                  title: 'Oops...',
                                  text: ""+obj.status+"",
                                  footer: ''
                                })
                            }
                            else if(obj.status == "success")
                            {
                                if(obj.no_policy_id != "")
                                {
                                    formdata.append('no_policy_id',obj.no_of_policy_id);
                                }
                                else
                                {
                                    formdata.append('no_policy_id',"");
                                }
                                
                                if(obj.net_id != "" )
                                {
                                    formdata.append('net_id',obj.net_id);
                                }
                                else
                                {
                                    formdata.append('net_id',"");
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
                                        var obj = jQuery.parseJSON(response);
                                        
                                            Swal.fire({
                                              position: 'top-end',
                                              icon: 'success',
                                              title: 'Payout Commission Has been Added Successfully',
                                              showConfirmButton: false,
                                              timer: 1500
                                            })
                                            
                                            $("#next_btn").attr("disabled",false);
                                            $("#add_btn").attr("disabled",false);
                                            $("#ins_state").val("");
                                            $("#ins_rto").val("");
                                            $("#ins_rto").trigger("change");
                                            $(".temp").val("");
                                            $(".temp").trigger("change");
                                            $("#is_com_cpa").prop("checked",false);
                                            $("#is_com_cpa").trigger("change");
                                            $("#agn_com_type").trigger("change");
                                            $(".input-group-addon").html("");
                                            
                                            get_old_entry(insurer_company,policy_type,f_date,to_date,commission_type);
                                    }
                               });
                            }
                            
                        }   
                           
                        },
                  });
               }
         });
         
         
         $("#h_next_btn").click(function(){
             
             var insurer_company = $("#h_insurer_company").val();
             var insurer_class = "2";
             var business_type = $("#h_business_type").val();
/* 2023-05-25 start */
             var ird_commission = $("#health_ird_commission").val();
/* 2023-05-25 end */

             var premium_c_type = $("#h_premium_c_type").val();
             var policy_type  = $("#h_add_policy_type").val();
             var commission_type = $("#h_commission_type").val();
             var add_type = $("#h_add_type").val();
             var make = $("#h_add_make").val();
             var model = $("#h_add_model_motor").val();
             var varient = $("#h_add_varient").val();
             var fuel_type = $("#h_add_fuel_type").val();
             var ins_classification = $("#h_ins_classification").val();
             var ins_state = $("#h_ins_state").val();
             var ins_rto = $("#h_ins_rto").val();
             var rto_category = $("#h_rto_category").val();
             var min_amount = $("#h_min_amount").val();
             var max_amount = $("#h_max_amount").val();
             var f_date = $("#h_f_date").val();
             var to_date = $("#h_to_date").val();
             var on_net = $("#h_on_net").val();
             //
             
             // Excluding
             var ncb_percentage = $("#ncb_percentage").val();
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
             
             // nop 
             var no_policy_min = $("#h_no_policy_min").val();
             var no_policy_max = $("#h_no_policy_max").val();
             
             // NET Agent Commission
             var a_net = $("#h_a_net").val();
             var b_net = $("#h_b_net").val();
             var c_net = $("#h_c_net").val();
             var d_net = $("#h_d_net").val();
             
             // NCB
             var a_ncb = $("#h_a_ncb").val();
             var b_ncb = $("#h_b_ncb").val();
             var c_ncb = $("#h_c_ncb").val();
             var d_ncb = $("#h_d_ncb").val();
            
             var formdata = new FormData();
             formdata.append('insurer_company',insurer_company);
             formdata.append('insurer_class',insurer_class);
             formdata.append('business_type',business_type);
             formdata.append('premium_c_type',premium_c_type);
             formdata.append('policy_type',policy_type);
             formdata.append('commission_type',commission_type);
             formdata.append('ins_state',ins_state);
             formdata.append('is_com_ncb',is_com_ncb);
             formdata.append('on_net',on_net);
            // Excluding
            formdata.append('ncb_percentage',ncb_percentage);

             
           
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
             formdata.append('no_policy_min',no_policy_min);
             formdata.append('no_policy_max',no_policy_max);
             
             // target
             formdata.append('min_amount',min_amount);
             formdata.append('max_amount',max_amount);
             formdata.append('f_date',f_date);
             formdata.append('to_date',to_date);
             
/* 2023-05-25 stgart */             
             formdata.append('ird_commission', ird_commission);
/* 2023-05-25 end */

            // start 2023-08-17
            formdata.append('payout_type', "Fresh");
            
             var check = "0";
             
            if(insurer_company == "")
            {
                snackbar_show("Select Insurer Company");
                check = "1";
            }
            else if(insurer_class == "")
            {
                snackbar_show("Select Class");
                check = "1";
            }
            else if(policy_type == "")
            {
                snackbar_show("Select Policy Type");
                check = "1";
            }
            else if(commission_type == "")
            {
                snackbar_show("Select Commission Type");
                check = "1";
            }
            else if(ins_state == "")
            {
                snackbar_show("Select State");
                check = "1";
            }
            else if(insurer_class == "2" && commission_type == "1" && no_policy_min == "")
            {
                snackbar_show("Enter No Of Policy Minimum");
                check = "1";
            }
            else if(insurer_class == "2" && commission_type == "1" && no_policy_max == "")
            {
                 snackbar_show("Enter No Of Policy Maximum");
                check = "1";
            }
            else if(insurer_class == "2" && commission_type == "3" && min_amount == "")
            {
                 snackbar_show("Enter Minimum Target Amount");
                check = "1";
            }
            else if(insurer_class == "2" && commission_type == "3" && max_amount == "")
            {
                snackbar_show("Enter Maximum Target Amount");
                check = "1";
            }
            else if($("#is_com_ncb").is(":checked") == true && ncb_percentage == "")
            {
                snackbar_show("Enter NCB Percentage");
                check = "1";
            }
            else if(on_net == "")
            {
                snackbar_show("Enter On net Commission Percentage");
                check = "1";
            }
            else if($("#is_com_ncb").is(":checked") == true && ncb_percentage == "")
            {
                snackbar_show("Enter NCB Percentage");
                check = "1";
            }
            else if(f_date == "")
            {
                snackbar_show("Enter From Date");
                check = "1";
            }
            else if(to_date == "")
            {
                snackbar_show("Enter To Date");
                check = "1";
            }
            else if(ird_commission == "") /* 2023-05-25 start*/
            {
                snackbar_show("Enter ird commission");
                check = "1";
            } /* 2023-05-25 end*/
            else if(check != "1")
            {
                $.ajax({
                        url : "check_payout_entry",
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
                                Swal.fire({
                                  icon: 'error',
                                  title: 'Oops...',
                                  text: ""+obj.status+"",
                                  footer: ''
                                })
                            }
                            else if(obj.status == "success")
                            {
                                if(obj.no_policy_id != "")
                                {
                                    formdata.append('no_policy_id',obj.no_of_policy_id);
                                }
                                else
                                {
                                    formdata.append('no_policy_id',"");
                                }
                                
                                if(obj.net_id != "" )
                                {
                                    formdata.append('net_id',obj.net_id);
                                }
                                else
                                {
                                    formdata.append('net_id',"");
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
                                        var obj = jQuery.parseJSON(response);
                                        
                                            Swal.fire({
                                              position: 'top-end',
                                              icon: 'success',
                                              title: 'Payout Commission Has been Added Successfully',
                                              showConfirmButton: false,
                                              timer: 1500
                                            })
                                            
                                            $("#h_next_btn").attr("disabled",false);
                                            $("#h_add_btn").attr("disabled",false);
                                            $("#ins_state").val("");
                                            $("#ins_rto").val("");
                                            $("#ins_rto").trigger("change");
                                            $(".temp").val("");
                                            $(".temp").trigger("change");
                                            $(".input-group-addon").html("");
                                            
                                            get_old_entry(insurer_company,policy_type,f_date,to_date,commission_type);
                                    }
                               });
                            }
                        },
                  });
               }
         });
         
         
         $("#forward_btn").click(function(){
             
             var insurer_company = $("#edit_insurer_company").val();
             var insurer_class = "1";
             var business_type = "";
             var premium_c_type = $("#edit_premium_c_type").val();
             var policy_type  = $("#edit_policy_type").val();
             var commission_type = $("#edit_commission_type").val();
             var add_type = $("#edit_type").val();
             var make = $("#edit_make").val();
             var model = $("#edit_model_motor").val();
             var varient = $("#edit_varient").val();
             var fuel_type = $("#edit_fuel_type").val();
             var ins_classification = $("#edit_ins_classification").val();
             var ins_state = $("#edit_ins_state").val();
             var ins_rto = $("#edit_ins_rto").val();
             var rto_category = $("#edit_rto_category").val();
             var vehicle_age_max = $("#edit_vehicle_age_max").val();
             var vehicle_age_min = $("#edit_vehicle_age_min").val();
             var min_amount = $("#edit_min_amount").val();
             var max_amount = $("#edit_max_amount").val();
             var f_date = $("#edit_f_date").val();
             var to_date = $("#edit_to_date").val();

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
             // nop 
             var no_policy_min = $("#edit_no_policy_min").val();
             var no_policy_max = $("#edit_no_policy_max").val();
             
             
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
             formdata.append('ins_classification',ins_classification);
             formdata.append('ins_state',ins_state);
             formdata.append('ins_rto',ins_rto);
             formdata.append('rto_category',rto_category);
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
             formdata.append('no_policy_min',no_policy_min);
             formdata.append('no_policy_max',no_policy_max);
             
             // target
             formdata.append('min_amount',min_amount);
             formdata.append('max_amount',max_amount);
             formdata.append('f_date',f_date);
             formdata.append('to_date',to_date);
             
             var check = "0";
             
            if(insurer_company == "")
            {
                snackbar_show("Select Insurer Company");
                check = "1";
            }
            else if(insurer_class == "")
            {
                snackbar_show("Select Class");
                check = "1";
            }
            else if(insurer_class == "1" && premium_c_type == "")
            {
                snackbar_show("Select policy Cover Type");
                check = "1";
            }
            else if(policy_type == "")
            {
                snackbar_show("Select Policy Type");
                check = "1";
            }
            else if(commission_type == "")
            {
                snackbar_show("Select Commission Type");
                check = "1";
            }
            else if(insurer_class == "1" && add_type == "")
            {
                snackbar_show("Select Type Including/Exculding");
                check = "1";
            }
            else if(insurer_class == "1" && make == "")
            {
                snackbar_show("Select Type Make");
                check = "1";
            }
            else if(insurer_class == "1" && model == "")
            {
                snackbar_show("Select Model");
                check = "1";
            }
            else if(insurer_class == "1" && varient == "")
            {
                snackbar_show("Select Varient");
                check = "1";
            }
            else if(insurer_class == "1" && fuel_type == "")
            {
                snackbar_show("Select Fuel Type");
                check = "1";
            }
            else if(insurer_class == "1" && ins_state == "")
            {
                snackbar_show("Select State");
                check = "1";
            }
            else if(insurer_class == "1" && rto_category == "")
            {
                snackbar_show("Select RTO Category");
                check = "1";
            }
            else if(insurer_class == "1" && ins_rto == null)
            {
                snackbar_show("Select RTO");
                check = "1";
            }
            else if(insurer_class == "1" && commission_type == "2" && vehicle_age_min == "")
            {
                snackbar_show("Enter Minimum Age");
                check = "1";
            }
            else if(insurer_class == "1" && commission_type == "2" && vehicle_age_max == "")
            {
                snackbar_show("Enter Maximum Age");
                check = "1";
            }
            else if(insurer_class == "1" && commission_type == "1" && no_policy_min == "")
            {
                snackbar_show("Enter No Of Policy Minimum");
                check = "1";
            }
            else if(insurer_class == "1" && commission_type == "1" && no_policy_max == "")
            {
                 snackbar_show("Enter No Of Policy Maximum");
                check = "1";
            }
            else if(insurer_class == "1" && commission_type == "3" && min_amount == "")
            {
                 snackbar_show("Enter Minimum Target Amount");
                check = "1";
            }
            else if(insurer_class == "1" && commission_type == "3" && max_amount == "")
            {
                snackbar_show("Enter Maximum Target Amount");
                check = "1";
            }
            else if($("#is_com_ncb").is(":checked") == true && ncb_percentage == "")
            {
                snackbar_show("Enter NCB Percentage");
                check = "1";
            }
            else if(insurer_class == "1" && $("#is_com_ncb").is(":checked") == false && premium_c_type == "1" && (own_od == "" && own_tp == "" && on_net == ""))
            {
                snackbar_show("Enter Own Commission Percentage");
                check = "1";
            }
            else if(insurer_class == "1" && $("#is_com_ncb").is(":checked") == false && premium_c_type == "2" && own_tp == "")
            {
                snackbar_show("Enter Own Tp Percentage");
                check = "1";
            }
            else if(insurer_class == "1" && $("#is_com_ncb").is(":checked") == false && premium_c_type == "3" && own_od == "")
            {
                snackbar_show("Enter Own OD Percentage");
                check = "1";
            }
            else if(insurer_class == "1" && $("#is_com_ncb").is(":checked") == false && premium_c_type == "4" && (own_od == "" && own_tp == "" && on_net == ""))
            {
                snackbar_show("Enter Own Commission Percentage");
                check = "1";
            }
            else if($("#is_com_ncb").is(":checked") == true && ncb_percentage == "")
            {
                snackbar_show("Enter NCB Percentage");
                check = "1";
            }
            else if(f_date == "")
            {
                snackbar_show("Enter From Date");
                check = "1";
            }
            else if(to_date == "")
            {
                snackbar_show("Enter To Date");
                check = "1";
            }
            else if(check != "1")
            {
                $.ajax({
                        url : "check_payout_entry",
                        method : "POST",
                        data:formdata,
                        processData:false,  
                        contentType:false,
                        cache:false,
                        dataType:'text',
                        beforeSend:function(){
                            $("#forward_btn").attr("disabled",true);
                        },
                        success:function(response)
                        {
                            $("#forward_btn").attr("disabled",false);
                            
                            var obj = jQuery.parseJSON(response);
                            
                            if(obj.status != "success")
                            {
                                Swal.fire({
                                  icon: 'error',
                                  title: 'Oops...',
                                  text: ""+obj.status+"",
                                  footer: ''
                                })
                            }
                            else if(obj.status == "success")
                            {
                                if(obj.no_policy_id != "")
                                {
                                    formdata.append('no_policy_id',obj.no_of_policy_id);
                                }
                                else
                                {
                                    formdata.append('no_policy_id',"");
                                }
                                
                                if(obj.net_id != "" )
                                {
                                    formdata.append('net_id',obj.net_id);
                                }
                                else
                                {
                                    formdata.append('net_id',"");
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
                                        $("#forward_btn").attr("disabled",true);
                                    },
                                    success:function(response)
                                    {
                                        var obj = jQuery.parseJSON(response);
                                        
                                            Swal.fire({
                                              position: 'top-end',
                                              icon: 'success',
                                              title: 'Payout Commission Has been Added Successfully',
                                              showConfirmButton: false,
                                              timer: 1500
                                            })
                                            
                                            $("#forward_btn").attr("disabled",false);
                                            $("#ins_state").val("");
                                            $("#ins_rto").val("");
                                            $("#ins_rto").trigger("change");
                                            $(".temp").val("");
                                            $(".temp").trigger("change");
                                            $(".input-group-addon").html("");
                                            $("#edit_model").modal("toggle");
                                             
                                             Swal.fire({
                                                  position: 'top-end',
                                                  icon: 'success',
                                                  title: 'Payout Commission Stored Successfully',
                                                  showConfirmButton: false,
                                                  timer: 1500
                                                })
                                                fetch_payout_commission("1");
                                      }
                               });
                            }
                        },
                  });
               }
         });
         
          $("#add_btn").click(function(){
             
             Swal.fire({
                      position: 'top-end',
                      icon: 'success',
                      title: 'All Payout Commissions are Stored Successfully',
                      showConfirmButton: false,
                      timer: 1500
                    })
                    $("#ins_state").val("");
                    $("#ins_rto").val("");
                    $("#ins_rto").trigger("change");
                    $(".temp").val("");
                    $(".temp").trigger("change");
                    $(".input-group-addon").html("");
                    $(".form-control").val("");
                    $("#add_model").modal("toggle");
                    $("#old_payouts").html("");
                    fetch_payout_commission("1");
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
                 $("#edit_vechi_div_1").addClass("hidden");
                 $("#edit_vechi_div_2").addClass("hidden");
                 $("#edit_nop_div_1").removeClass("hidden");
                 $("#edit_nop_div_2").removeClass("hidden");
                 $("#edit_target_div_1").addClass("hidden");
                 $("#edit_target_div_2").addClass("hidden");
                 
                 $("#edit_vehicle_age_min").val("");
                 $("#edit_vehicle_age_max").val("");
                 $("#edit_min_amount").val("");
                 $("#edit_max_amount").val("");
                
             }
             else if(commission_type == "2")
             {
                 $("#edit_vechi_div_1").removeClass("hidden");
                 $("#edit_vechi_div_2").removeClass("hidden");
                 $("#edit_nop_div_1").addClass("hidden");
                 $("#edit_nop_div_2").addClass("hidden");
                 $("#edit_target_div_1").addClass("hidden");
                 $("#edit_target_div_2").addClass("hidden");
                 $("#edit_no_policy_min").val("");
                 $("#edit_no_policy_max").val("");
                 $("#edit_min_amount").val("");
                 $("#edit_max_amount").val("");
                
             }
             else if(commission_type == "3")
             {
                 $("#edit_vechi_div_1").addClass("hidden");
                 $("#edit_vechi_div_2").addClass("hidden");
                 $("#edit_nop_div_1").addClass("hidden");
                 $("#edit_nop_div_2").addClass("hidden");
                 $("#edit_target_div_1").removeClass("hidden");
                 $("#edit_target_div_2").removeClass("hidden");
                 
                 $("#edit_vehicle_age_min").val("");
                 $("#edit_vehicle_age_max").val("");
                 $("#edit_no_policy_min").val("");
                 $("#edit_no_policy_max").val("");
             }
         });
        
         $("#edit_is_com_ncb").change(function(){
             
              if($("#edit_is_com_ncb").is(":checked"))
               {
                   $(".edit_ncb_div_per").removeClass("hidden");
                   $(".edit_ncb_div").removeClass("hidden");
               }
               else
               {
                    $(".edit_ncb_div_per").addClass("hidden");
                    $(".edit_ncb_div").addClass("hidden");
                    $(".edit_ncb_percentage").val("");
               }
         });
         
         
         
         
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
                   $(".edit_od_div").removeClass("hidden");
                   $(".edit_net_div").addClass("hidden");
                   $(".edit_tp_div").addClass("hidden");
                   $(".edit_tp").val("");
                   $(".edit_net").val("");
                }
                else if(agn_com_type == "TP")
                {
                    $(".edit_tp_div").removeClass("hidden");
                    $(".edit_net_div").addClass("hidden");
                    $(".edit_od_div").addClass("hidden");
                    $(".edit_od").val("");
                    $(".edit_net").val("");
                }
                else if(agn_com_type == "ON-NET")
                {
                    $(".edit_net_div").removeClass("hidden");
                    $(".edit_od_div").addClass("hidden");
                    $(".edit_tp_div").addClass("hidden");
                    $(".edit_od").val("");
                    $(".edit_tp").val("");
                }
                else if(agn_com_type == "OD_AND_TP")
                {
                    $(".edit_od_div").removeClass("hidden");
                    $(".edit_tp_div").removeClass("hidden");
                    $(".edit_net_div").addClass("hidden");
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
                    
        // 2023-07-20 start
        $("#edit_a_cpa").keyup(function(){               
               var cpa_percentage = $("#edit_cpa_percentage").val();
               var a_cpa = $("#edit_a_cpa").val();
               
               if(cpa_percentage != "")
               {
                     var commission = parseFloat(a_cpa) * parseFloat(100)/cpa_percentage;
                      $("#edit_a_cpa_span").html(commission.toFixed(2) +" %");
               }
        });
           
        $("#edit_b_cpa").keyup(function(){
               
               var cpa_percentage = $("#edit_cpa_percentage").val();
               var b_cpa = $("#edit_b_cpa").val();
               if(cpa_percentage != "")
               {
                     var commission = parseFloat(b_cpa) * parseFloat(100)/cpa_percentage;
                      $("#edit_b_cpa_span").html(commission.toFixed(2) +" %");
               }
        });

        $("#edit_c_cpa").keyup(function(){
               
               var cpa_percentage = $("#edit_cpa_percentage").val();
               var c_cpa = $("#edit_c_cpa").val();
               
               if(cpa_percentage != "")
               {
                     var commission = parseFloat(c_cpa) * parseFloat(100)/cpa_percentage;
                      
                      $("#edit_c_ncb_span").html(commission.toFixed(2) +" %");
               }
        });
           
        $("#edit_d_cpa").keyup(function(){
               
               var cpa_percentage = $("#edit_cpa_percentage").val();
               var d_cpa = $("#edit_d_cpa").val();
               
               if(cpa_percentage != "")
               {
                     var commission = parseFloat(d_cpa) * parseFloat(100)/cpa_percentage;
                      
                      $("#edit_d_cpa_span").html(commission.toFixed(2) +" %");
               }
               
                
        });
        // 2023-07-20 end  
         
         $("#edit_btn").click(function(){
             
             var id = $("#edit_id").val();
             var insurer_company = $("#edit_insurer_company").val();
             var insurer_class = "1";
             var business_type =""; //$("#edit_business_type").val();
             var ird_od_commission = $("#edit_ird_od_commission").val();
             var ird_tp_commission = $("#edit_ird_tp_commission").val();
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
             var rto_category = $("#edit_rto_category").val();
             var vehicle_age_max = $("#edit_vehicle_age_max").val();
             var vehicle_age_min = $("#edit_vehicle_age_min").val();
             var min_amount = $("#edit_min_amount").val();
             var max_amount = $("#edit_max_amount").val();
             var f_date = $("#edit_f_date").val();
             var to_date = $("#edit_to_date").val();
             var add_agency = $("#edit_agency").val();
             var special_com =$("#edit_special_com").val();
             
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
             
             var ird_commission = $("#edit_ird_commission").val();
             
             // start 2023-08-17
             var payout_type = $("#edit_payout_type").val();
             
             // agent commission
             if($("#edit_is_com_ncb").is(":checked"))
             {
                 var is_com_ncb = "Yes";
             }
             else
             {
                 var is_com_ncb = "No";
             }
             // 2023-07-20 start
             if($("#edit_is_com_cpa").is(":checked"))
             {
                 var is_com_cpa = "Yes";
             }
             else
             {
                 var is_com_cpa = "No";
             }
              var cpa_percentage = $("#edit_cpa_percentage").val();
            // 2023-07-20 end
            
             var agn_com_non_ncb = $("#edit_agn_com_type").val();
             var discount = $("#edit_discount").val();
             // nop 
             var no_policy_min = $("#edit_no_policy_min").val();
             var no_policy_max = $("#edit_no_policy_max").val();
             
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
             
            // 2023-07-20 start
            // CPA
            var a_cpa = $("#edit_a_cpa").val();
            var b_cpa = $("#edit_b_cpa").val();
            var c_cpa = $("#edit_c_cpa").val();
            var d_cpa = $("#edit_d_cpa").val();             
            // 2023-07-20 end
             
             var formdata = new FormData();
             formdata.append('insurer_company',insurer_company);
             formdata.append('insurer_class',insurer_class);
             formdata.append('business_type',business_type);
             formdata.append('ird_od_commission',ird_od_commission);
             formdata.append('ird_tp_commission',ird_tp_commission);
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
             formdata.append('rto_category',rto_category);
             formdata.append('vehicle_age_min',vehicle_age_min);
             formdata.append('vehicle_age_max',vehicle_age_max);
             formdata.append('special_com',special_com);
             formdata.append('add_agency',add_agency);
             
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
             
             
            formdata.append('ird_commission',ird_commission);
            
            // 2023-07-20 start
            formdata.append('is_com_cpa',is_com_cpa);
            formdata.append('cpa_percentage',cpa_percentage);
             
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
             
            // 2023-07-20 start
            // NCB
            formdata.append('a_cpa',a_cpa);
            formdata.append('b_cpa',b_cpa);
            formdata.append('c_cpa',c_cpa);
            formdata.append('d_cpa',d_cpa);
            // 2023-07-20 end
            
              // nop 
             formdata.append('no_policy_min',no_policy_min);
             formdata.append('no_policy_max',no_policy_max);
             
             // target
             formdata.append('min_amount',min_amount);
             formdata.append('max_amount',max_amount);
             
             formdata.append('f_date',f_date);
             formdata.append('to_date',to_date);
             
             
             // start 2023-08-17
             formdata.append('payout_type',payout_type);
             
             var check = "0";
             
            if(insurer_company == "")
            {
                snackbar_show("Select Insurer Company");
                check = "1";
            }
            else if(insurer_class == "")
            {
                snackbar_show("Select Class");
                check = "1";
            }
            else if(insurer_class == "1" && premium_c_type == "")
            {
                snackbar_show("Select policy Cover Type");
                check = "1";
            }
            else if(policy_type == "")
            {
                snackbar_show("Select Policy Type");
                check = "1";
            }
            else if(commission_type == "")
            {
                snackbar_show("Select Commission Type");
                check = "1";
            }
            else if(insurer_class == "1" && add_type == "")
            {
                snackbar_show("Select Type Including/Exculding");
                check = "1";
            }
            else if(payout_type == "") // start 2023-08-17
            {
                snackbar_show("Select Payout Type");
                check = "1";
            }
            else if(insurer_class == "1" && make == "")
            {
                snackbar_show("Select Type Make");
                check = "1";
            }
            else if(insurer_class == "1" && model == "")
            {
                snackbar_show("Select Model");
                check = "1";
            }
            else if(insurer_class == "1" && varient == "")
            {
                snackbar_show("Select Varient");
                check = "1";
            }
            else if(insurer_class == "1" && fuel_type == "")
            {
                snackbar_show("Select Fuel Type");
                check = "1";
            }
            else if(insurer_class == "1" && ins_state == "")
            {
                snackbar_show("Select State");
                check = "1";
            }
            else if(insurer_class == "1" && ins_rto == null)
            {
                snackbar_show("Select RTO");
                check = "1";
            }
            else if(insurer_class == "1" && commission_type == "2" && vehicle_age_min == "")
            {
                snackbar_show("Enter Minimum Age");
                check = "1";
            }
            else if(insurer_class == "1" && commission_type == "2" && vehicle_age_max == "")
            {
                snackbar_show("Enter Maximum Age");
                check = "1";
            }
        
            else if(insurer_class == "1" && commission_type == "3" && min_amount == "")
            {
                 snackbar_show("Enter Minimum Target Amount");
                check = "1";
            }
            else if(insurer_class == "1" && commission_type == "3" && max_amount == "")
            {
                snackbar_show("Enter Maximum Target Amount");
                check = "1";
            }
            else if($("#is_com_ncb").is(":checked") == true && ncb_percentage == "")
            {
                snackbar_show("Enter NCB Percentage");
                check = "1";
            }
            else if(insurer_class == "1" && $("#is_com_ncb").is(":checked") == false && premium_c_type == "1" && (own_od == "" && own_tp == "" && on_net == ""))
            {
                snackbar_show("Enter Own Commission Percentage");
                check = "1";
            }
            else if(insurer_class == "1" && $("#is_com_ncb").is(":checked") == false && premium_c_type == "2" && own_tp == "")
            {
                snackbar_show("Enter Own Tp Percentage");
                check = "1";
            }
            else if(insurer_class == "1" && $("#is_com_ncb").is(":checked") == false && premium_c_type == "3" && own_od == "")
            {
                snackbar_show("Enter Own OD Percentage");
                check = "1";
            }
            else if(insurer_class == "1" && $("#is_com_ncb").is(":checked") == false && premium_c_type == "4" && (own_od == "" && own_tp == "" && on_net == ""))
            {
                snackbar_show("Enter Own Commission Percentage");
                check = "1";
            }
            else if($("#is_com_ncb").is(":checked") == true && ncb_percentage == "")
            {
                snackbar_show("Enter NCB Percentage");
                check = "1";
            }
            else if(check != "1")
            {
                $.ajax({
                        url : "edit_check_payout_entry",
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
                                Swal.fire({
                                  icon: 'error',
                                  title: 'Oops...',
                                  text: ""+obj.status+"",
                                  footer: ''
                                })
                            }
                            else if(obj.status == "success")
                            {
                                if(obj.no_policy_id != "")
                                {
                                    formdata.append('no_policy_id',obj.no_of_policy_id);
                                }
                                else
                                {
                                    formdata.append('no_policy_id',"");
                                }
                                
                                if(obj.net_id != "" )
                                {
                                    formdata.append('net_id',obj.net_id);
                                }
                                else
                                {
                                    formdata.append('net_id',"");
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
                                        $("#next_btn").attr("disabled",false);
                                        $("#add_btn").attr("disabled",false);
                                        $("#ins_state").val("");
                                        $("#ins_rto").val("");
                                        $("#ins_rto").trigger("change");
                                        $("#vehicle_age_min").val("");
                                        $("#vehicle_age_max").val("");
                                        $("#ncb_percentage").val("");
                                        $("#cpa_percentage").val(""); // 2023-07-20 start
                                        $("#ins_classification").val();
                                        $("#own_od").val("");
                                        $("#own_tp").val("");
                                        
                                        $("#edit_ird_commission").val("");
                                        $("#edit_payout_type").val(""); // start 2023-08-17
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
                                        $(".form-control").val("");
                                        $("#input-group-addon").html("");
                                        $("#edit_model").modal("toggle");
                                        $("#view_model").modal("show");
                                        Swal.fire(
                                          'Success',
                                          'Payout Commission Updated!',
                                          'success'
                                        )
                                        fetch_payout_commission("1");
                                    }
                            });
                            }
                        },
                  });
              }
         });

         $("#edit_h_commission_type").change(function(){
             
            var commission_type = $("#edit_h_commission_type").val();
            
             if(commission_type == "1")
             {
                 $("#edit_h_nop_div_1").removeClass("hidden");
                 $("#edit_h_nop_div_2").removeClass("hidden");
                 $("#edit_h_target_div_1").addClass("hidden");
                 $("#edit_h_target_div_2").addClass("hidden");
                 $("#edit_h_min_amount").val("");
                 $("#edit_h_max_amount").val("");
             }
             else if(commission_type == "3")
             {
                 $("#edit_h_nop_div_1").addClass("hidden");
                 $("#edit_h_nop_div_2").addClass("hidden");
                 $("#edit_h_target_div_1").removeClass("hidden");
                 $("#edit_h_target_div_2").removeClass("hidden");
                 $("#edit_h_no_policy_min").val("");
                 $("#edit_h_no_policy_max").val("");
             }
         });
        
         $("#edit_h_is_com_ncb").change(function(){
             
              if($("#edit_h_is_com_ncb").is(":checked"))
               {
                   $(".edit_h_ncb_div_per").removeClass("hidden");
                   $(".edit_h_ncb_div").removeClass("hidden");
               }
               else
               {
                    $(".edit_h_ncb_div_per").addClass("hidden");
                    $(".edit_h_ncb_div").addClass("hidden");
                    $(".edit_h_ncb_percentage").val("");
               }
         });

         $("#edit_health_btn").click(function(){
             var id = $("#health_edit_id").val();
             var insurer_company = $("#edit_h_insurer_company").val();
             var insurer_class = "2";
/* 2023-05-25 start */
             var ird_commission = $("#edit_health_ird_commission").val();
/* 2023-05-25 end */             
             var business_type =$("#edit_h_business_type").val();
             var policy_type  = $("#edit_h_policy_type").val();
             var commission_type = $("#edit_h_commission_type").val();
             var ins_state = $("#edit_h_ins_state").val();
             var min_amount = $("#edit_h_min_amount").val();
             var max_amount = $("#edit_h_max_amount").val();
             var f_date = $("#edit_h_f_date").val();
             var to_date = $("#edit_h_to_date").val();
             // Excluding
             var ncb_percentage = $("#edit_h_ncb_percentage").val();
             //
             
             // agent commission
             if($("#edit_h_is_com_ncb").is(":checked"))
             {
                 var is_com_ncb = "Yes";
             }
             else
             {
                 var is_com_ncb = "No";
             }

             //nop 
             var no_policy_min = $("#edit_h_no_policy_min").val();
             var no_policy_max = $("#edit_h_no_policy_max").val();
             
    
             // NET Agent Commission
             var  on_net= $("#edit_h_on_net").val();
             var a_net = $("#edit_h_a_net").val();
             var b_net = $("#edit_h_b_net").val();
             var c_net = $("#edit_h_c_net").val();
             var d_net = $("#edit_h_d_net").val();
             
             // NCB
             var a_ncb = $("#edit_h_a_ncb").val();
             var b_ncb = $("#edit_h_b_ncb").val();
             var c_ncb = $("#edit_h_c_ncb").val();
             var d_ncb = $("#edit_h_d_ncb").val();
             
            
             var formdata = new FormData();
             formdata.append('insurer_company',insurer_company);
             formdata.append('insurer_class',insurer_class);
             formdata.append('business_type',business_type);
             formdata.append('policy_type',policy_type);
             formdata.append('commission_type',commission_type);
             formdata.append('ins_state',ins_state);
             formdata.append('is_com_ncb',is_com_ncb);
             formdata.append('id',id);
             
            // including
            formdata.append('on_net',on_net);
             
            // Excluding
            formdata.append('ncb_percentage',ncb_percentage);

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
             formdata.append('no_policy_min',no_policy_min);
             formdata.append('no_policy_max',no_policy_max);
             
             // target
             formdata.append('min_amount',min_amount);
             formdata.append('max_amount',max_amount);
             
             formdata.append('f_date',f_date);
             formdata.append('to_date',to_date);
             
/* 2023-05-25 start */
             formdata.append('ird_commission', ird_commission);
/* 2023-05-25 end */                
             
             var check = "0";
             
            if(insurer_company == "")
            {
                snackbar_show("Select Insurer Company");
                check = "1";
            }
            else if(insurer_class == "")
            {
                snackbar_show("Select Class");
                check = "1";
            }
            else if(policy_type == "")
            {
                snackbar_show("Select Policy Type");
                check = "1";
            }
            else if(commission_type == "")
            {
                snackbar_show("Select Commission Type");
                check = "1";
            }
            else if(ins_state == "")
            {
                snackbar_show("Select State");
                check = "1";
            }
            else if(commission_type == "1" && no_policy_min == "")
            {
                snackbar_show("Enter Minimum No Policy");
                check = "1";
            }
            else if(commission_type == "1" && no_policy_max == "")
            {
                 snackbar_show("Enter Maximum No Policy");
                check = "1";
            }
            else if(commission_type == "3" && min_amount == "")
            {
                 snackbar_show("Enter Minimum Target Amount");
                check = "1";
            }
            else if(commission_type == "3" && max_amount == "")
            {
                snackbar_show("Enter Maximum Target Amount");
                check = "1";
            }
            else if($("#edit_h_is_com_ncb").is(":checked") == true && ncb_percentage == "")
            {
                snackbar_show("Enter NCB Percentage");
                check = "1";
            }
            else if(on_net == "")
            {
                snackbar_show("Enter Own Commission Percentage");
                check = "1";
            }
            else if(ird_commission == "") /* 2023-05-25 start */
            {
                snackbar_show("Enter IRD Commission Percentage");
                check = "1";
            } /* 2023-05-25 end */
            else if(check != "1")
            {
                $.ajax({
                        url : "edit_check_payout_entry",
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
                                Swal.fire({
                                  icon: 'error',
                                  title: 'Oops...',
                                  text: ""+obj.status+"",
                                  footer: ''
                                })
                            }
                            else if(obj.status == "success")
                            {
                                if(obj.no_policy_id != "")
                                {
                                    formdata.append('no_policy_id',obj.no_of_policy_id);
                                }
                                else
                                {
                                    formdata.append('no_policy_id',"");
                                }
                                
                                if(obj.net_id != "" )
                                {
                                    formdata.append('net_id',obj.net_id);
                                }
                                else
                                {
                                    formdata.append('net_id',"");
                                }
                                
                                $.ajax({
                                    url : "edit_payout_entry",
                                    method : "POST",
                                    data:formdata,
                                    processData:false,  
                                    contentType:false,
                                    cache:false,
                                    dataType:'text',
                                    success:function(response)
                                    {
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
                                        $(".form-control").val("");
                                        $("#input-group-addon").html("");
                                        $("#edit_health_model").modal("toggle");
                                        $("#view_model").modal("show");
                                        Swal.fire(
                                          'Success',
                                          'Payout Commission Updated!',
                                          'success'
                                        )
                                        fetch_payout_commission("2");
                                    }
                            });
                            }
                        },
                  });
              }
         });
         
         $("#health_forward_btn").click(function(){
             var id = $("#health_edit_id").val();
             var insurer_company = $("#edit_h_insurer_company").val();
             var insurer_class = "2";
             var business_type =$("#edit_h_business_type").val();
             var policy_type  = $("#edit_h_policy_type").val();
             var commission_type = $("#edit_h_commission_type").val();
             var ins_state = $("#edit_h_ins_state").val();
             var min_amount = $("#edit_h_min_amount").val();
             var max_amount = $("#edit_h_max_amount").val();
             var f_date = $("#edit_h_f_date").val();
             var to_date = $("#edit_h_to_date").val();
             // Excluding
             var ncb_percentage = $("#edit_h_ncb_percentage").val();
             //
             
             // agent commission
             if($("#edit_h_is_com_ncb").is(":checked"))
             {
                 var is_com_ncb = "Yes";
             }
             else
             {
                 var is_com_ncb = "No";
             }

             //nop 
             var no_policy_min = $("#edit_h_no_policy_min").val();
             var no_policy_max = $("#edit_h_no_policy_max").val();
             
    
             // NET Agent Commission
             var a_net = $("#edit_h_a_net").val();
             var b_net = $("#edit_h_b_net").val();
             var c_net = $("#edit_h_c_net").val();
             var d_net = $("#edit_h_d_net").val();
             
             // NCB
             var a_ncb = $("#edit_h_a_ncb").val();
             var b_ncb = $("#edit_h_b_ncb").val();
             var c_ncb = $("#edit_h_c_ncb").val();
             var d_ncb = $("#edit_h_d_ncb").val();
             
            
             var formdata = new FormData();
             formdata.append('insurer_company',insurer_company);
             formdata.append('insurer_class',insurer_class);
             formdata.append('business_type',business_type);
             formdata.append('policy_type',policy_type);
             formdata.append('commission_type',commission_type);
             formdata.append('ins_state',ins_state);
             formdata.append('is_com_ncb',is_com_ncb);
             formdata.append('id',id);
             
            // including
            formdata.append('on_net',on_net);
             
            // Excluding
            formdata.append('ncb_percentage',ncb_percentage);

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
             formdata.append('no_policy_min',no_policy_min);
             formdata.append('no_policy_max',no_policy_max);
             
             // target
             formdata.append('min_amount',min_amount);
             formdata.append('max_amount',max_amount);
             
             formdata.append('f_date',f_date);
             formdata.append('to_date',to_date);
             
             
             var check = "0";
             
            if(insurer_company == "")
            {
                snackbar_show("Select Insurer Company");
                check = "1";
            }
            else if(insurer_class == "")
            {
                snackbar_show("Select Class");
                check = "1";
            }
            else if(policy_type == "")
            {
                snackbar_show("Select Policy Type");
                check = "1";
            }
            else if(commission_type == "")
            {
                snackbar_show("Select Commission Type");
                check = "1";
            }
            else if(ins_state == "")
            {
                snackbar_show("Select State");
                check = "1";
            }
            else if(commission_type == "1" && no_policy_min == "")
            {
                snackbar_show("Enter Minimum No Policy");
                check = "1";
            }
            else if(commission_type == "1" && no_policy_max == "")
            {
                 snackbar_show("Enter Maximum No Policy");
                check = "1";
            }
            else if(commission_type == "3" && min_amount == "")
            {
                 snackbar_show("Enter Minimum Target Amount");
                check = "1";
            }
            else if(commission_type == "3" && max_amount == "")
            {
                snackbar_show("Enter Maximum Target Amount");
                check = "1";
            }
            else if($("#edit_h_is_com_ncb").is(":checked") == true && ncb_percentage == "")
            {
                snackbar_show("Enter NCB Percentage");
                check = "1";
            }
            else if(on_net == "")
            {
                snackbar_show("Enter Own Commission Percentage");
                check = "1";
            }
            else if(check != "1")
            {
                $.ajax({
                        url : "check_payout_entry",
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
                                Swal.fire({
                                  icon: 'error',
                                  title: 'Oops...',
                                  text: ""+obj.status+"",
                                  footer: ''
                                })
                            }
                            else if(obj.status == "success")
                            {
                                if(obj.no_policy_id != "")
                                {
                                    formdata.append('no_policy_id',obj.no_of_policy_id);
                                }
                                else
                                {
                                    formdata.append('no_policy_id',"");
                                }
                                
                                if(obj.net_id != "" )
                                {
                                    formdata.append('net_id',obj.net_id);
                                }
                                else
                                {
                                    formdata.append('net_id',"");
                                }
                                
                                $.ajax({
                                    url : "add_payout_entry",
                                    method : "POST",
                                    data:formdata,
                                    processData:false,  
                                    contentType:false,
                                    cache:false,
                                    dataType:'text',
                                    success:function(response)
                                    {
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
                                        $(".form-control").val("");
                                        $("#input-group-addon").html("");
                                        $("#edit_health_model").modal("toggle");
                                        $("#view_model").modal("show");
                                        Swal.fire(
                                          'Success',
                                          'Payout Commission Updated!',
                                          'success'
                                        )
                                        fetch_payout_commission("2");
                                    }
                            });
                            }
                        },
                  });
              }
         });
         
         
         $("#search_btn").click(function(){
             
               if($("#motor_li").hasClass("active"))
               {
                   s_f_date = $("#s_f_date").val();
                   s_to_date = $("#s_to_date").val();
                   fetch_payout_commission("1",s_f_date,s_to_date);
               }
               else
               {
                   s_f_date = $("#s_f_date").val();
                   s_to_date = $("#s_to_date").val();
                   fetch_payout_commission("2",s_f_date,s_to_date);
               }
         });
         
         
          $("#is_com_cpa").change(function(){
               
               if($("#is_com_cpa").is(":checked"))
               {
                   $(".cpa_div_per").removeClass("hidden");
                   $(".cpa_div").removeClass("hidden");
               }
               else
               {
                    $(".cpa_div_per").addClass("hidden");
                    $(".cpa_div").addClass("hidden");
                    $(".cpa_percentage").val("");
               }
                    
           });
           
        // 2023-07-20 start 
        $("#edit_is_com_cpa").change(function(){
             
              if($("#edit_is_com_cpa").is(":checked"))
               {
                   $(".edit_cpa_div_per").removeClass("hidden");
                   $(".edit_cpa_div").removeClass("hidden");
               }
               else
               {
                    $(".edit_cpa_div_per").addClass("hidden");
                    $(".edit_cpa_div").addClass("hidden");
                    $(".edit_cpa_percentage").val("");
               }
        });
           
          // inc_rto_btn
          
          $("#inc_rto_btn").click(function(){
             var state = $("#state").val();
             var f_date = $("#add_from_date").val();
             var to_date = $("#add_to_date").val();
             var rto_type = $("#rto_type").val();
             var rto = $("#rto").val();
             
             $.ajax({
                          url : "include_rtos",
                          method : "POST",
                          data : {state:state,f_date:f_date,to_date:to_date,rto_type:rto_type,rto:rto},
                          beforeSend:function(){
                              $("#inc_rto_btn").attr("disabled",true);
                          },
                          success:function(response)
                          {
                                $("#inc_rto_btn").attr("disabled",false);
                                $("#state").val("");
                                $("#add_from_date").val("");
                                $("#add_to_date").val("");
                                $("#rto_type").val("");
                                $("#rto").val("");
                                $("#rto").trigger("change");
                                $("#include_rto_modal").modal("toggle");
                                fetch_payout_commission("1",s_f_date,s_to_date);
                          }
             });
             
              
          });
          
    });
     
     
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
                        var old_model = $("#add_model_motor").val();

                        $("#add_model_motor").html("<option value='all'>All</option>");
                        
                        var obj = jQuery.parseJSON(response);
                        
                        for(var i=0;i<obj.length;i++)
                        {
                            $("#add_model_motor").append("<option value='"+obj[i].id+"'>"+obj[i].model_name+"</option>");
                        }
                        
                        $("#add_model_motor").val(old_model);
                        $("#add_model_motor").trigger("change");
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
                       var old_varient = $("#add_varient").val();
                        
                        $("#add_varient").html("<option value='all'>All</option>");
                        
                        var obj = jQuery.parseJSON(response);
                        
                        for(var i=0;i<obj.length;i++)
                        {
                            $("#add_varient").append("<option value='"+obj[i].id+"'>"+obj[i].varient_name+"</option>");
                        }
                        
                        $("#add_varient").val(old_varient); 
                        $("#add_varient").trigger("change");
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
     
     
    function fetch_payout_commission(ins_class,f_date,to_date)
    {
      var content = "";
      content += "<div class='table-responsive'>";
      content += "<table id='table_id' class='table table-hover table-bordered'>"; 
      if(ins_class == "1")
      {
           content += "<thead><th>S.No</th><th>Insurer</th><th>Premium_type</th><th>Policy_type</th><th>Type</th></thead>";
      }
      else
      {
           content += "<thead><th>S.No</th><th>Insurer</th><th>Business Type</th><th>Policy_type</th></thead>";
      }
     
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
            'url':'fetch_payout_commission_entry',
            "method":'POST',
            "data":{ins_class:ins_class,f_date:f_date,to_date:to_date},
          }
      });      
    }
    
    
    function fetch_payout_commission_health(ins_class,f_date,to_date)
    {
      var content = "";
      content += "<div class='table-responsive'>";
      content += "<table id='table_id' class='table table-hover table-bordered'>"; 
      content += "<thead><th>S.No</th><th>Insurer</th><th>Business Type</th><th>Policy Type</th><th>On NET(%)</th><th>NCB(%)</th><th>Action</th></thead>";
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
            "method":'POST',
            "data":{ins_class:ins_class,f_date:f_date,to_date:to_date},
          }
      });      
    }
  
   function delete_data(id)
    {
      if(confirm("Are you Confirm to Delete"))
      {
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
                        $("#view_model").modal("toggle");
                        fetch_payout_commission("1");
                  }
            });
      }
    }
    
    
    function export_excel()
    {
        $("#export_btn").attr("disabled",true);
        
        $.ajax({
                     url : "payout_commission_excel",
                     method : "POST",
                     success:function(response)
                     {
                          $("#export_btn").attr("disabled",false);
                         window.location.href=response;
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
    
     function edit_load_hidden_class()
     {
            var insurer_class = $("#edit_insurer_class").val();
           
            if(insurer_class == "1")
            {
               $("#edit_vehi_div").removeClass("hidden");
               $("#edit_state_hidden").removeClass("hidden");
               $("#edit_rto_hidden").removeClass("hidden");
               $("#edit_classification_hidden").removeClass("hidden");
               
                $("#edit_p_c_div").removeClass("hidden");
                $("#edit_v_type_div").removeClass("hidden");
                $("#edit_in_type_div").removeClass("hidden");
                $("#edit_p_type_div").addClass("col-md-4");
                $("#edit_p_type_div").removeClass("col-md-12");

                $("#edit_commission_type_div").removeClass("col-md-12");
                $("#edit_commission_type_div").addClass("col-md-6");
                
                $("#edit_own_od_div").removeClass("hidden");
                $("#edit_own_tp_div").removeClass("hidden");
                $("#edit_on_net_div").removeClass("col-md-12");
                $("#edit_on_net_div").addClass("col-md-4");
            }
            else if(insurer_class == "2")
            {
                $("#edit_vehi_div").addClass("hidden");
                $("#edit_state_hidden").addClass("hidden");
                $("#edit_rto_hidden").addClass("hidden");
                $("#edit_classification_hidden").addClass("hidden");
                
                
                $("#edit_p_c_div").addClass("hidden");
                $("#edit_v_type_div").addClass("hidden");
                $("#edit_in_type_div").addClass("hidden");
                $("#edit_p_type_div").removeClass("col-md-4");
                $("#edit_p_type_div").addClass("col-md-12");
                
                $("#edit_commission_type_div").removeClass("col-md-6");
                $("#edit_commission_type_div").addClass("col-md-12");
                
                $("#edit_own_od_div").addClass("hidden");
                $("#edit_own_tp_div").addClass("hidden");
                $("#edit_on_net_div").removeClass("col-md-4");
                $("#edit_on_net_div").addClass("col-md-12");
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
      
      function filter_commission_motor(insurer,policy_type,make,model,varient,rto,f_date,to_date)
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
                'url':'filter_commission_motor',
                'method' : "POST",
                'data' : {insurer:insurer,policy_type:policy_type,make:make,model:model,varient:varient,rto:rto,f_date:f_date,to_date:to_date},
              }
          });      
     }
     
  
    function remove_all_rto()
    {
        var edit_id = $("#edit_id").val();
        
        $.ajax({
               url : "remove_all_rto",
               method : "POST",
               data : {id:edit_id},
               success:function(response)
               {
                   $("#edit_ins_rto").val("");
                   $("#edit_ins_rto").trigger("change");
               }
        });
    }
    
    var last_id = [];
  
    
    function load_old_log(insurance_company,ins_class,business_type,premium_c_type,policy_type)
    {
        if(insurance_company != "" && ins_class != "" && business_type != "" && premium_c_type != "" && policy_type != "")
        {
           $.ajax({
                  url : "view_old_log",
                  method : "POST",
                  data : {insurance_company:insurance_company,ins_class:ins_class,business_type:business_type,premium_c_type:premium_c_type,policy_type:policy_type},
                  success:function(response)
                  {
                      $("#payout_old_log_content").html(response);
                      var html = "<button data-toggle='modal' data-target='#payout_old_log_modal' class='btn btn-primary btn-sm pull-left'>View Old Log</button>";
                         $("#old_log_modal_div").html(html);
                  }
        });
        }
    }
    
    
    function add_data(id)
    {
        $("#add_data_btn").attr("disabled",true);
        $.ajax({
                  url : "edit_commission_entry",
                  method : "POST",
                  data : {id:id},
                  success:function(response)
                  {
                       var obj = jQuery.parseJSON(response);
                       $("#payout_old_log_modal").modal("hide");
                       $("#add_data_btn").attr("disabled",false);
                       
                       if(obj["class"] == "1")
                       {
                           $("#add_agn_com_type").html(agn_com_motor);
                           $("#insurer_company").val(obj['res'].insurer_company);
                           $("#insurer_company").trigger("change");
                           $("#business_type").val(obj['res'].business_type);
                           $("#premium_c_type").val(obj['res'].policy_premium_type);
                           $("#commission_type").val(obj['res'].commission_type);
                           $("#commission_type").trigger("change");
                           //$("#add_v_type").val(obj['res'].vehicle_type);
                           $("#add_type").val(obj['res'].type);
                           $("#ins_classification").html(obj['classification_content']);
                           $("#ins_classification").val(obj['res'].classification);
                           $("#ins_state").val(obj['res'].state);
                           $("#ins_rto").val(obj['select_rto']);
                           $("#ins_rto").trigger("change");
                           $("#vehicle_age_min").val(obj['res'].vehicle_age_min);
                           $("#vehicle_age_max").val(obj['res'].vehicle_age_max);
                           $("#min_amount").val(obj['res'].min_val);
                           $("#max_amount").val(obj['res'].max_val);
                           $("#add_fuel_type").val(obj['res'].fuel_type);
                         if(obj['res'].is_ncb == "Yes")
                         {
                             $("#is_com_ncb").prop('checked', true);
                             $("#is_com_ncb").trigger("change");
                         }
                         else
                         {
                             $("#is_com_ncb").prop('checked', false);
                             $("#is_com_ncb").trigger("change");
                         }
                         
                        $("#ncb_percentage").val(obj['res'].ncb_percentage);
                        $("#own_od").val(obj['res'].own_od);
                        $("#own_tp").val(obj['res'].own_tp);
                        $("#on_net").val(obj['res'].on_net);
                        $("#agn_com_type").val(obj['res'].agn_com_type);
                        $("#agn_com_type").trigger("change");
                        $("#a_od").val(obj['res'].a_od);
                        $("#b_od").val(obj['res'].b_od);
                        $("#c_od").val(obj['res'].c_od);
                        $("#d_od").val(obj['res'].d_od);
                        $("#a_tp").val(obj['res'].a_tp);
                        $("#b_tp").val(obj['res'].b_tp);
                        $("#c_tp").val(obj['res'].c_tp);
                        $("#d_tp").val(obj['res'].d_tp);
                        $("#a_net").val(obj['res'].a_net);
                        $("#b_net").val(obj['res'].b_net);
                        $("#c_net").val(obj['res'].c_net);
                        $("#d_net").val(obj['res'].d_net);
                        $("#a_ncb").val(obj['res'].a_ncb);
                        $("#b_ncb").val(obj['res'].b_ncb);
                        $("#c_ncb").val(obj['res'].c_ncb);
                        $("#d_ncb").val(obj['res'].d_ncb);
                       
                        $("#add_make").html("");
                        
                        $("#add_make").html("<option value='all'>All</option>");
                        
                        for(var i=0;i<obj['make_list'].length;i++)
                        {
                            $("#add_make").append("<option value='"+obj['make_list'][i].id+"'>"+obj['make_list'][i].brand_name+"</option>");
                        }
                        
                        $("#add_model_motor").html("");
                        $("#add_model_motor").html("<option value='all'>All</option>");
                        
                        for(var i=0;i<obj['model_list'].length;i++)
                        {
                            $("#add_model_motor").append("<option value='"+obj['model_list'][i].id+"'>"+obj['model_list'][i].model_name+"</option>");
                        }
                        
                        $("#add_varient").html("");
                    
                        $("#add_varient").html("<option value='all'>All</option>");
                        
                            for(var i=0;i<obj['varient_list'].length;i++)
                            {
                                $("#add_varient").append("<option value='"+obj['varient_list'][i].id+"'>"+obj['varient_list'][i].varient_name+"</option>");
                            }
                        
                            $("#add_make").val(obj['select_make']);
                            $("#add_model_motor").val(obj['select_model']);
                            $("#add_varient").val(obj['select_varient']);
                          
                          if(obj['select_make'] == null || obj['select_make'] == "")
                          {
                            if(obj['res'].v_make == "all")
                            {
                                $("#add_make").val("all");
                            }
                            else
                            {
                                $("#add_model_motor").val("all");
                            }
                          }
                          
                          if(obj['select_model'] == null || obj['select_model'] == "")
                          {
                                if(obj['res'].v_model == "all")
                                {
                                    $("#add_model_motor").val("all");
                                }
                                else
                                {
                                    $("#add_model_motor").val("all");
                                }
                          }
                          
                          if(obj['select_varient'] == null || obj['select_varient'] == "")
                          {
                            if(obj['res'].v_varient == "all")
                            {
                                $("#add_varient").val("all");
                            }
                            else
                            {
                                $("#add_varient").val("all");
                            }
                          }
                       }
                       else if(obj["class"] == "2")
                       {

                            $("#insurer_company").val(obj["data"].insurer_company);
                            $("#insurer_company").trigger("change");
                            $("#insurer_class").val(obj["data"].class);
                            $("#insurer_class").trigger("change");
                            $.ajax({
                                         url : "fetch_policy_type_using_class",
                                         method : "POST",
                                         data : {policy_class : obj["data"].class},
                                         success:function(response)
                                         {
                                             var obj1 = jQuery.parseJSON(response);
                                             var html ="<option value=''>--select--</option>";
                                             
                                             for(var i= 0;i<obj1.length;i++)
                                             {
                                                 if(obj['data'].policy_type == obj1[i].id)
                                                 {
                                                   html +="<option value='"+obj1[i].id+"' selected>"+obj1[i].policy_type+"</option>";
                                                 }
                                                 else
                                                 {
                                                     html +="<option value='"+obj1[i].id+"'>"+obj1[i].policy_type+"</option>";
                                                 }
                                             }
                                             
                                             $("#add_policy_type").html(html);
                                         }
                             });
                            $("#commission_type").html(health_option);
                            $("#agn_com_type").html(agn_com_health);
                            $("#business_type").val(obj["data"].business_type);
                            $("#commission_type").val(obj["data"].commission_type);
                            $("#commission_type").trigger("change");
                            $("#f_date").val(obj["data"].from_date);
                            $("#to_date").val(obj["data"].to_date);
                            $("#agn_com_type").val(obj["data"].agn_com_type);
                            $("#agn_com_type").trigger("change");
                            $("#min_amount").val(obj['data'].min_val);
                            $("#max_amount").val(obj['data'].max_val);
                            $("#on_net").val(obj["data"].on_net);
                            $("#a_net").val(obj["data"].a_net);
                            $("#b_net").val(obj["data"].b_net);
                            $("#c_net").val(obj["data"].c_net);
                            $("#d_net").val(obj["data"].d_net);
                       }
                        $("#payout_old_log_modal").modal("hide");
                  }
            });
    }
    
    
    function get_old_entry(insurer_company,policy_type,f_date,to_date,commission_type)
    {
        $.ajax({
                   url : "get_old_entry",
                   method : "POST",
                   data : {insurer_company:insurer_company,policy_type:policy_type,f_date:f_date,to_date:to_date,commission_type:commission_type},
                   success:function(response)
                   {
                       $("#old_payouts").html(response);
                   }
        });
    }
    
    
    // 
    
    function load_rto(id)
    {
       $.ajax({
                   url : "load_all_rto",
                   method : "POST",
                   data : {id:id},
                   success:function(response)
                   {
                       $("#rto_content").html(response);
                       $("#rto_model").modal("toggle");
                   }
       });   
    }
    
    function load_varient(id)
    {
        var tab = "varient";
        $.ajax({
                   url : "load_motors_list",
                   method : "POST",
                   data : {id:id,tab:tab},
                   success:function(response)
                   {
                       var obj = jQuery.parseJSON(response);
                       $("#motor_content").html(obj["content"]);
                       $("#motor_title").html(obj["tab"]);
                       $("#motor_model").modal("toggle");
                   }
       });   
    }
    function load_model(id)
    {
        var tab = "Model";
        $.ajax({
                   url : "load_motors_list",
                   method : "POST",
                   data : {id:id,tab:tab},
                   success:function(response)
                   {
                       var obj = jQuery.parseJSON(response);
                       $("#motor_content").html(obj["content"]);
                       $("#motor_title").html(obj["tab"]);
                       $("#motor_model").modal("toggle");
                   }
       });   
    }
    function load_brand(id)
    {
         var tab = "Brand";
            $.ajax({
                       url : "load_motors_list",
                       method : "POST",
                       data : {id:id,tab:tab},
                       success:function(response)
                       {
                           var obj = jQuery.parseJSON(response);
                           $("#motor_content").html(obj["content"]);
                           $("#motor_title").html(obj["tab"]);
                           $("#motor_model").modal("toggle");
                       }
           });   
    }
    
    function load_agn_com(id)
    {
            $.ajax({
                       url : "load_agent_commission",
                       method : "POST",
                       data : {id:id},
                       success:function(response)
                       {
                           $("#agent_com_content").html(response);
                           $("#agent_com_model").modal("toggle");
                       }
           });   
    }
    
    
    function view_data(ins_company,p_cover,policy_type,type)
    {
        
        s_f_date = $("#s_f_date").val();
        s_to_date = $("#s_to_date").val();
        
        $.ajax({
                    url : "view_payout_commission_entry",
                    method : "POST",
                    data : {ins_company:ins_company,p_cover:p_cover,policy_type:policy_type,type:type,s_f_date:s_f_date,s_to_date:s_to_date},
                    success:function(response)
                    {
                        var obj = jQuery.parseJSON(response);
                        
                            $("#view_payout_content").html(obj["content"]);
                             $("#payout_title").html(obj["title"]);
                            $("#view_model").modal("toggle");
                    }
        });
    }
    
    function view_health_data(ins_company,policy_type,b_type)
    {
        s_f_date = $("#s_f_date").val();
        s_to_date = $("#s_to_date").val();
        
        $.ajax({
                    url : "view_health_payout_commission_entry",
                    method : "POST",
                    data : {ins_company:ins_company,policy_type:policy_type,b_type:b_type,s_f_date:s_f_date,s_to_date:s_to_date},
                    success:function(response)
                    {
                        var obj = jQuery.parseJSON(response);
                        
                            $("#view_payout_content").html(obj["content"]);
                             $("#payout_title").html(obj["title"]);
                            $("#view_model").modal("toggle");
                    }
        });
    }
    
    
    function edit_data(id)
    {
        $.ajax({
                  url : "edit_commission_entry_motor",
                  method : "POST",
                  data : {id:id},
                  success:function(response)
                  {
                       var obj = jQuery.parseJSON(response);
                       $("#edit_insurer_company").val(obj['res'].insurer_company);
                       $("#edit_insurer_company").trigger("change");
                       $("#edit_premium_c_type").val(obj['res'].policy_premium_type);
                       $("#edit_commission_type").val(obj['res'].commission_type);
                       $("#edit_commission_type").trigger("change");
                       $("#edit_policy_type").val(obj['res'].policy_type);
                       //$("#edit_v_type").val(obj['res'].vehicle_type);
                       $("#edit_type").val(obj['res'].type);
                       $("#edit_ins_classification").html(obj['classification_content']);
                       $("#edit_ins_classification").val(obj['res'].classification);
                       $("#edit_ins_state").val(obj['res'].state);
                       $("#edit_special_com").val(obj.special_com);
                       
                       
                       select_agent = obj['select_agent'];
                       
                       $("#edit_agency").val(obj['select_agent']);
                       $("#edit_agency").trigger("change");
                       
                       selected_rto = obj['select_rto'];
                       
                       $("#edit_ins_rto").val(obj['select_rto']);
                       $("#edit_ins_rto").trigger("change");
                       $("#edit_vehicle_age_min").val(obj['res'].vehicle_age_min);
                       $("#edit_vehicle_age_max").val(obj['res'].vehicle_age_max);
                        $("#edit_ird_od_commission").val(obj['res'].ird_od_commission);
                       $("#edit_ird_tp_commission").val(obj['res'].ird_tp_commission);
                       
                       $("#edit_ird_commission").val(obj['res'].ird_commission_percentage);
                       
                       $("#edit_payout_type").val(obj['res'].payout_type); // start 2023-08-17
                       
                       $("#edit_min_amount").val(obj['res'].min_val);
                       $("#edit_max_amount").val(obj['res'].max_val);
                       
                       $("#edit_no_policy_min").val(obj['res'].no_policy_min);
                       $("#edit_no_policy_max").val(obj['res'].no_policy_max);
                       
                       $("#edit_fuel_type").val(obj['res'].fuel_type);
                       $("#edit_f_date").val(obj['res'].from_date);
                       $("#edit_to_date").val(obj['res'].to_date);
                   
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
                    
                    // 2023-07-20 start
                    if(obj['res'].is_cpa == "Yes")
                     {
                         $("#edit_is_com_cpa").prop('checked', true);
                         $("#edit_is_com_cpa").trigger("change");
                     }
                     else
                     {
                         $("#edit_is_com_cpa").prop('checked', false);
                         $("#edit_is_com_cpa").trigger("change");
                     }
                     $("#edit_cpa_percentage").val(obj['res'].cpa_percentage);
                     // 2023-07-20 end
                     
                    $("#edit_own_od").val(obj['res'].own_od);
                    $("#edit_own_tp").val(obj['res'].own_tp);
                    $("#edit_on_net").val(obj['res'].on_net);
                    $("#edit_agn_com_type").val(obj['res'].agn_com_type);
                    

                    $("#edit_rto_category").val(obj['res'].rto_type);
                    
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
                    
                    // 2023-07-20 start
                    $("#edit_a_cpa").val(obj['res'].a_cpa);
                    $("#edit_b_cpa").val(obj['res'].b_cpa);
                    $("#edit_c_cpa").val(obj['res'].c_cpa);
                    $("#edit_d_cpa").val(obj['res'].d_cpa);
                    
                   
                    $("#edit_make").html("");
                    $("#edit_make").html("<option value='all'>All</option>");
                        
                        for(var i=0;i<obj['make_list'].length;i++)
                        {
                            $("#edit_make").append("<option value='"+obj['make_list'][i].id+"'>"+obj['make_list'][i].brand_name+"</option>");
                        }
                        
                        $("#edit_model_motor").html("");
                        $("#edit_model_motor").html("<option value='all'>All</option>");
                        
                        for(var i=0;i<obj['model_list'].length;i++)
                        {
                            $("#edit_model_motor").append("<option value='"+obj['model_list'][i].id+"'>"+obj['model_list'][i].model_name+"</option>");
                        }
                        
                        $("#edit_varient").html("");
                        $("#edit_varient").html("<option value='all'>All</option>");
                        
                            for(var i=0;i<obj['varient_list'].length;i++)
                            {
                                $("#edit_varient").append("<option value='"+obj['varient_list'][i].id+"'>"+obj['varient_list'][i].varient_name+"</option>");
                            }
                        
                            $("#edit_make").val(obj['select_make']);
                            $("#edit_model_motor").val(obj['select_model']);
                            $("#edit_varient").val(obj['select_varient']);
                        
                            if(obj['res'].v_make == "all")
                            {
                                $("#edit_make").val("all");
                            }
                            if(obj['res'].v_model == "all")
                            {
                                $("#edit_model_motor").val("all");
                            }
                            if(obj['res'].v_varient == "all")
                            {
                                $("#edit_varient").val("all");
                            }
                        $("#edit_id").val(id);
                        $("#view_model").modal("hide");
                        $("#edit_model").modal("show");
                        
                  }
            });
    }
    
    
     function edit_health_data(id)
    {
        $.ajax({
                  url : "edit_commission_entry_health",
                  method : "POST",
                  data : {id:id},
                  success:function(response)
                  {
                       var obj = jQuery.parseJSON(response);
                       $("#edit_h_insurer_company").val(obj.insurer_company);
                       $("#edit_h_insurer_company").trigger("change");
                       $("#edit_h_commission_type").val(obj.commission_type);
                       $("#edit_h_commission_type").trigger("change");
                       $("#edit_h_business_type").val(obj.business_type);
                       $("#edit_h_policy_type").val(obj.policy_type);
                       $("#edit_h_ins_state").val(obj.state);
                       $("#edit_h_min_amount").val(obj.min_val);
                       $("#edit_h_max_amount").val(obj.max_val);
                       $("#edit_h_no_policy_min").val(obj.no_policy_min);
                       $("#edit_h_no_policy_max").val(obj.no_policy_max);
                       $("#edit_h_f_date").val(obj.from_date);
                       $("#edit_h_to_date").val(obj.to_date);
                   
                       // 2023-05-25 start
                       $("#edit_health_ird_commission").val(obj.ird_commission_percentage);
                       
                     if(obj.is_ncb == "Yes")
                     {
                         $("#edit_h_is_com_ncb").prop('checked', true);
                         $("#edit_h_is_com_ncb").trigger("change");
                     }
                     else
                     {
                         $("#edit_h_is_com_ncb").prop('checked', false);
                         $("#edit_h_is_com_ncb").trigger("change");
                     }
                    $("#edit_h_ncb_percentage").val(obj.ncb_percentage);
                    $("#edit_h_on_net").val(obj.on_net);
                    $("#edit_h_a_net").val(obj.a_net);
                    $("#edit_h_b_net").val(obj.b_net);
                    $("#edit_h_c_net").val(obj.c_net);
                    $("#edit_h_d_net").val(obj.d_net);
                    $("#edit_h_a_ncb").val(obj.a_ncb);
                    $("#edit_h_b_ncb").val(obj.b_ncb);
                    $("#edit_h_c_ncb").val(obj.c_ncb);
                    $("#edit_h_d_ncb").val(obj.d_ncb);
                    $("#health_edit_id").val(id);
                    $("#view_model").modal("hide");
                    $("#edit_health_model").modal("show");
                  }
            });
    }
    
    
    function forward(id)
    {
        $.ajax({
             url : "forward_check_payout_entry",
             method : "POST",
             data : {id:id},
             success:function(response)
             {
                    var obj = jQuery.parseJSON(response);
                    
                    if(obj.status != "success")
                    {
                        Swal.fire({
                          icon: 'error',
                          title: 'Oops...',
                          text: ""+obj.status+"",
                          footer: ''
                        })
                    }
                    else if(obj.status == "success")
                    {
                        var formdata = new FormData();
                        
                        formdata.append('id',id);
                        
                        if(obj.no_policy_id != "")
                        {
                            formdata.append('no_policy_id',obj.no_of_policy_id);
                        }
                        else
                        {
                            formdata.append('no_policy_id',"");
                        }
                        
                        if(obj.net_id != "" )
                        {
                            formdata.append('net_id',obj.net_id);
                        }
                        else
                        {
                            formdata.append('net_id',"");
                        }
                  
                         $.ajax({
                            url : "forward_to_next_month",
                            method : "POST",
                            data:formdata,
                            processData:false,  
                            contentType:false,
                            cache:false,
                            dataType:'text',
                             success:function(response)
                             {
                                 Swal.fire({
                                    position: 'top-end',
                                    icon: 'success',
                                    title: 'Payout Commission Has been Added Successfully',
                                    showConfirmButton: false,
                                    timer: 1500
                                    })
                             }
                     });
                   }
              }
        });
    }
    
    function health_forward(id)
    {
        $.ajax({
             url : "forward_check_payout_entry",
             method : "POST",
             data : {id:id},
             success:function(response)
             {
                    var obj = jQuery.parseJSON(response);
                    
                    if(obj.status != "success")
                    {
                        Swal.fire({
                          icon: 'error',
                          title: 'Oops...',
                          text: ""+obj.status+"",
                          footer: ''
                        })
                    }
                    else if(obj.status == "success")
                    {
                        var formdata = new FormData();
                        
                        formdata.append('id',id);
                        
                        if(obj.no_policy_id != "")
                        {
                            formdata.append('no_policy_id',obj.no_of_policy_id);
                        }
                        else
                        {
                            formdata.append('no_policy_id',"");
                        }
                        
                        if(obj.net_id != "" )
                        {
                            formdata.append('net_id',obj.net_id);
                        }
                        else
                        {
                            formdata.append('net_id',"");
                        }
                  
                         $.ajax({
                            url : "forward_to_next_month",
                            method : "POST",
                            data:formdata,
                            processData:false,  
                            contentType:false,
                            cache:false,
                            dataType:'text',
                             success:function(response)
                             {
                                 Swal.fire({
                                    position: 'top-end',
                                    icon: 'success',
                                    title: 'Payout Commission Has been Added Successfully',
                                    showConfirmButton: false,
                                    timer: 1500
                                    })
                             }
                     });
                   }
              }
        });
    }
    
    
   function delete_health_data(id)
   {
      if(confirm("Are you Confirm to Delete"))
      {
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
                        $("#view_model").modal("toggle");
                        fetch_payout_commission("2");
                  }
            });
      }
   }
   
   
   function include_rto()
   {
       $("#include_rto_modal").modal("toggle");
   }
   
    function setAttributes(chk, ele) {        
        if(chk.checked) {
            $('#'+ele).prop('readonly',false);
        }else {
            $('#'+ele).prop('readonly',true);
        }
    }
   
  </script>
  