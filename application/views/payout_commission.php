<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1 style="font-size: 17px;">
        Payout Commission
        <button data-toggle="modal" data-target="#add_model" style="margin-right:50px;" class="btn btn-primary btn-sm hidden" id="add_mod">Add New</button>
        <button class="btn btn-danger btn-sm pull-right hidden" id="excel_export" onclick='export_excel()'><i class="fa fa-file-excel-o"></i> Export Excel</button>
      </h1>
    </section>
        
        <div class="box hidden">
            <div class="box-header with-border">
             <h3 class="box-title">Payout Commission</h3>
             <button data-toggle="modal" data-target="#add_model" style="margin-right:50px;" class="btn btn-primary btn-sm pull-right">Add New</button>
             <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse">
                <i class="fa fa-minus"></i></button>
                <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="" data-original-title="Remove">
                <i class="fa fa-times"></i></button>
            </div>
            </div>
            <div class="box-body" style="">
                
                <div class="row">
                    <div class="col-md-3">
                        <select class="form-control select2" style="width:100%" name="select_insurer" id="select_insurer">
                            <option value="">--Select insurer--</option>
                             <?php foreach($insurer_company as $da) { ?>
                                  <option value="<?php echo $da->id ?>"><?php echo $da->company_name ?></option>
                                <?php } ?>
                        </select>
                    </div>
                    
                     <div class="col-md-2">
                        <select class="form-control" style="width:100%" name="select_premium_type" id="select_premium_type">
                            <option value="">--Select Premium Type--</option>
                             <?php foreach($type as $da) { ?>
                                  <option value="<?php echo $da->id ?>"><?php echo $da->name ?></option>
                                <?php } ?>
                        </select>
                    </div>
                    
                    <div class="col-md-2">
                        <select class="form-control" style="width:100%" name="select_business_type" id="select_business_type">
                            <option value="">--Select Business Type--</option>
                             <?php foreach($business_type as $da) { ?>
                              <option value="<?php echo $da->id ?>"><?php echo $da->bussiness_type ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    
                    <div class="col-md-2">
                        <select class="form-control" style="width:100%" name="select_commission_type" id="select_commission_type">
                            <option value="">--Select Commission Type--</option>
                             <?php foreach($commission_type as $da){ ?>
                                          <option value="<?php echo $da->id ?>"><?php echo $da->type ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    
                     <div class="col-md-2">
                        <button class="btn btn-primary" id="search_btn" ><i class="fa fa-search" aria-hidden="true"></i>&nbsp;Search</button>
                    </div>

                </div>
                
          </div>
        </div>

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
            </div>
          <div id="table_view"></div>
        </div><!-- /.box-body -->        
      </div><!-- /.box -->

    </section><!-- /.content -->
  </div><!-- /.content-wrapper -->
  
  <style>
  
  
  
  
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

  </style>
  
  
   <div class="modal fade in" id="add_model">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true" style="color:white;">×</span></button>
                <h4 class="modal-title text-center">Payout Commission</h4>
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
                                    <select class="form-control" name="insurer_business_type" id="insurer_business_type">
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
                            <select class="form-control" name="ins_type" id="ins_type">
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
                         <div class="col-md-6">
                                <div class="form-group">
                                    <label>Category</label>
                                    <select class="form-control" name="ins_category" id="ins_category">
                                        <option value="">--Select--</option>
                                        <?php foreach($category as $da) { ?>
                                          <option value="<?php echo $da->id ?>"><?php echo $da->motor_category ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                         </div>
                         
                         <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Vechicle Classification</label>
                                        <select class="form-control" name="ins_product" id="ins_product">
                                            <option value="">--Select--</option>
                                        </select>
                                    </div>
                         </div>
                     </div> 
                     
                    <div class="row">
                           <div class="col-md-2 hidden" id="state_hidden">
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
                           
                           <div class="col-md-4 hidden" id="no_of_policy_hidden">
                               <div class="form-group">
                                    <label>No of Policy</label>
                                    <input type="number" class="form-control" name="no_of_policy" id="no_of_policy">
                                </div>
                           </div>
                           
                           <div class="col-md-2 hidden" id="vehi_age_min_hidden">
                                  <div class="form-group">
                                    <label>Vehicle Age(Min)</label>
                                    <input type="number" class="form-control" name="vehicle_age_min" id="vehicle_age_min">
                                </div>
                          </div>
                          
                           <div class="col-md-2 hidden" id="vehi_age_max_hidden">
                                  <div class="form-group">
                                    <label>Vehicle Age(Max)</label>
                                    <input type="number" class="form-control" name="vehicle_age_max" id="vehicle_age_max">
                                </div>
                          </div>
                           
                           <div class="col-md-6 hidden" id="rto_hidden">
                               <div class="form-group">
                                        <label>RTO</label>
                                        <select class="form-control select2" name="ins_rto" id="ins_rto" multiple data-placeholder="Select a RTO" style="width:100%">
                                            <?php foreach($rto as $da) { ?>
                                              <option value="<?php echo $da->rto_no ?>"><?php echo $da->rto_no." (".$da->city.")" ?></option>
                                            <?php } ?>
                                        </select>
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
                    
                    <br>
                    
                    <div class="row">
                        
                        <div class="col-md-2">
                                  <div class="form-group">
                                    <label>Discount(%)</label>
                                    <input type="number" class="form-control" name="discount" id="discount" value="0">
                                </div>
                          </div>
                          
                          <div class="col-md-1" id="own_od_div">
                                  <div class="form-group">
                                    <label>OD(%)</label>
                                    <input type="number" class="form-control" name="own_od" id="own_od" value="0">
                                </div>
                          </div>
                          
                          <div class="col-md-1">
                                  <div class="form-group" id="own_tp_div">
                                    <label>Tp(%)</label>
                                    <input type="number" class="form-control" name="own_tp" id="own_tp" value="0">
                                </div>
                          </div>
                           
                          
                          <div class="col-md-2">
                                <div class="form-group">
                                    <label>ON Net(%)</label>
                                        <input type="number" class="form-control" name="on_net" id="on_net" value="0">
                                </div>
                          </div>
                          
                          <div class="col-md-2">
                              <div class="form-group">
                                    <label>Gold(%)</label>
                                       <div class="input-group">
                                            <input type="number" class="form-control" name="gold_category" id="gold_category">
                                            <span class="input-group-addon" id="g_span"></span>
                                       </div>
                                </div>
                          </div>
                          
                          <div class="col-md-2">
                              <div class="form-group">
                                    <label>Silver(%)</label>
                                    <div class="input-group">
                                        <input type="number" class="form-control" name="silver_category" id="silver_category">
                                        <span class="input-group-addon" id="s_span"></span>
                                     </div>
                                </div>
                            </div>   
                            
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Bronze(%)</label>
                                    <div class="input-group">
                                        <input type="number" class="form-control" name="bronze_category" id="bronze_category">
                                         <span class="input-group-addon" id="b_span"></span>
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
  
  
   <div id="view_model" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">View Payout Commission Details</h4>
      </div>
      <div class="modal-body" id="view_payout_content">
       
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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
                <h4 class="modal-title text-center">Edit Payout Commission</h4>
            </div>
            <div class="modal-body">
                
                        <div class="form-group">
                            <label>Insurer Company</label>
                            <select class="form-control" name="edit_insurer_company" id="edit_insurer_company">
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
                                    <select class="form-control" name="edit_insurer_class" id="edit_insurer_class">
                                        <option value="">--Select--</option>
                                         <?php foreach($class as $da) {  ?>
                                          <option value="<?php echo $da->id ?>"><?php echo $da->class ?></option>
                                        <?php }  ?>
                                    </select>
                                </div>
                         </div>
                         <div class="col-md-6">
                                <div class="form-group">
                                    <label>Business Type</label>
                                    <select class="form-control" name="edit_insurer_business_type" id="edit_insurer_business_type">
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
                            <select class="form-control" name="edit_ins_type" id="edit_ins_type">
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
                                    <select class="form-control" name="edit_commission_type" id="edit_commission_type">
                                        <option value="">--Select--</option>
                                         <?php foreach($commission_type as $da){  ?>
                                          <option value="<?php echo $da->id ?>"><?php echo $da->type ?></option>
                                         <?php } ?>
                                    </select>
                                </div>
                       </div> 
                      </div>
                     
                     <div class="row hidden" id="edit_vehi_div">
                         <div class="col-md-6">
                                <div class="form-group">
                                    <label>Category</label>
                                    <select class="form-control" name="edit_ins_category" id="edit_ins_category">
                                        <option value="">--Select--</option>
                                        <?php foreach($category as $da) { ?>
                                          <option value="<?php echo $da->id ?>"><?php echo $da->motor_category ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                         </div>
                         
                         <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Vechicle Classification</label>
                                        <select class="form-control" name="edit_ins_product" id="edit_ins_product">
                                            <option value="">--Select--</option>
                                        </select>
                                    </div>
                         </div>
                     </div> 
                     
                    <div class="row">
                           <div class="col-md-2 hidden" id="edit_state_hidden">
                                    <div class="form-group">
                                        <label>State</label>
                                        <select class="form-control" name="edit_ins_state" id="edit_ins_state">
                                            <option value="">--Select--</option>
                                            <?php foreach($state as $da) { ?>
                                              <option value="<?php echo $da->id ?>"><?php echo $da->name ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                           </div>
                           
                           <div class="col-md-4 hidden" id="edit_no_of_policy_hidden">
                               <div class="form-group">
                                    <label>No of Policy</label>
                                    <input type="number" class="form-control" name="edit_no_of_policy" id="edit_no_of_policy">
                                </div>
                           </div>
                           
                           <div class="col-md-2 hidden" id="edit_vehi_age_min_hidden">
                                  <div class="form-group">
                                    <label>Vehicle Age(Min)</label>
                                    <input type="number" class="form-control" name="edit_vehicle_age_min" id="edit_vehicle_age_min">
                                </div>
                          </div>
                          
                           <div class="col-md-2 hidden" id="edit_vehi_age_max_hidden">
                                  <div class="form-group">
                                    <label>Vehicle Age(Max)</label>
                                    <input type="number" class="form-control" name="edit_vehicle_age_max" id="edit_vehicle_age_max">
                                </div>
                          </div>
                           
                           <div class="col-md-6 hidden" id="edit_rto_hidden">
                               <div class="form-group">
                                        <label>RTO</label>
                                        <select class="form-control select2" name="edit_ins_rto" id="edit_ins_rto" multiple data-placeholder="Select a RTO" style="width:100%">
                                            <option value="">--Select--</option>
                                            <?php foreach($rto as $da) { ?>
                                              <option value="<?php echo $da->rto_no ?>"><?php echo $da->rto_no." (".$da->city.")" ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                           </div>
                       </div>
                       
                       
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
                    
                    <br>
                    
                    <div class="row">
                        <div class="col-md-2">
                                  <div class="form-group">
                                    <label>Discount(%)</label>
                                    <input type="number" class="form-control" name="edit_discount" id="edit_discount">
                                </div>
                           </div>
                           
                           <div class="col-md-1">
                                  <div class="form-group">
                                    <label>OD(%)</label>
                                    <input type="number" class="form-control" name="edit_own_od" id="edit_own_od">
                                </div>
                           </div>
                           
                           <div class="col-md-1">
                                  <div class="form-group">
                                    <label>Tp(%)</label>
                                    <input type="number" class="form-control" name="edit_own_tp" id="edit_own_tp">
                                </div>
                           </div>
                          
                          <div class="col-md-2">
                                <div class="form-group">
                                    <label>ON Net(%)</label>
                                        <input type="number" class="form-control" name="edit_on_net" id="edit_on_net">
                                </div>
                          </div>
                          
                          <div class="col-md-2">
                              <div class="form-group">
                                    <label>Gold(%)</label>
                                        <input type="number" class="form-control" name="edit_gold_category" id="edit_gold_category">
                                </div>
                          </div>
                          
                          <div class="col-md-2">
                              <div class="form-group">
                                    <label>Silver(%)</label>
                                        <input type="number" class="form-control" name="edit_silver_category" id="edit_silver_category">
                                </div>
                            </div>   
                            
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Bronze(%)</label>
                                        <input type="number" class="form-control" name="edit_bronze_category" id="edit_bronze_category">
                                </div>
                          </div>
                    </div>
                    
                    <input type="hidden" id="edit_id">
                    
                    <div class="form-group">
                        <span id="edit_err_span" style="color:red;"></span>
                    </div>
                    
                    
                </div>   
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-sm btn-primary" id="edit_btn"> Update</button>
            </div>
        </div>
    </div>
  </div>
  
  
  
  <script>
  
  var old_rto = [];

    $(document).ready(function(){
         $('.select2').select2();
         check_permission();
         var content = "";
         
         fetch_payout_commission_motor();
         
          $('#ins_category').change(function(){
             var ins_category = $("#ins_category").val();
             $.ajax({
                      url : "fetch_load_sub_category",
                      method : "POST",
                      data : {ins_category : ins_category},
                      success:function(response)
                      {
                         $("#ins_product").html("");
                         
                         var obj = jQuery.parseJSON(response);
                         for(var i = 0 ; i<obj.length; i++)
                         {
                             $("#ins_product").append("<option value="+obj[i].id+">"+obj[i].motor_gvw+"</option>");
                         }
                      }
             });
         });
         
          $("#insurer_class").change(function(){
               
               var insurer_class = $("#insurer_class").val();
               
               if(insurer_class == "1")
               {
                   $("#hidden_1").removeClass("hidden");
                   $("#hidden_2").removeClass("hidden");
                    $("#hidden_3").addClass("hidden");
                     $("#hidden_4").removeClass("hidden");
                     
                     $("#own_od_div").removeClass("hidden");
                   $("#own_tp_div").removeClass("hidden");
               }
               else if(insurer_class == "2")
               {
                   $("#hidden_1").addClass("hidden");
                   $("#hidden_2").removeClass("hidden");
                   $("#hidden_3").removeClass("hidden");
                   $("#hidden_4").addClass("hidden");
                   
                   $("#own_od_div").addClass("hidden");
                   $("#own_tp_div").addClass("hidden");
               }
         });
         
            $("#next_btn").click(function(){
              
             var insurer_company = $("#insurer_company").val();
             var ins_type = $("#ins_type").val();
             var insurer_class = $("#insurer_class").val();
             var business_type = $("#insurer_business_type").val();
             var commission_type = $("#commission_type").val();
             var ins_category = $("#ins_category").val();
             var ins_product = $('#ins_product').val();
             var ins_state = $("#ins_state").val();
             var ins_rto = $("#ins_rto").val();
             var vehicle_age_max = $("#vehicle_age_max").val();
             var vehicle_age_min = $("#vehicle_age_min").val();
             var discount = $("#discount").val();
             var own_od = $("#own_od").val();
             var own_tp = $("#own_tp").val();
             var on_net = $("#on_net").val();
             var gold_category = $("#gold_category").val();
             var silver_category = $("#silver_category").val();
             var bronze_category = $("#bronze_category").val();
             
             
             // target amount 
             
             var min_val = $("#min_val").val();
             var max_val = $("#max_val").val();
             
             // no policy 
             
             var no_of_policy = $("#no_of_policy").val();
            
             var check = 0;
             
            if(insurer_company == "")
            {
                check = 1;
                    Swal.fire(
                      'Select Insurer',
                      'That thing is still around?',
                      'question'
                    )
            }
            
            else if(insurer_class == "")
            {
                check = 1;
                    Swal.fire(
                      'Select Class',
                      'That thing is still around?',
                      'question'
                    )
            }
            else if(business_type == "")
            {
                check = 1;
                    Swal.fire(
                      'Select Business Type ?',
                      'That thing is still around?',
                      'question'
                    )
            }
            else if(ins_type == "")
            {
                check = 1;
                
                    Swal.fire(
                      'Select Premium Type ?',
                      'That thing is still around?',
                      'question'
                    )
            }
            
            else if(commission_type == "")
            {
                check = 1;
                
                    Swal.fire(
                      'Select Commission Type ?',
                      'That thing is still around?',
                      'question'
                    )
            }
            
            else if(insurer_class !="" && insurer_class == "1" && ins_category == "")
            {
                check = 1;
                Swal.fire(
                      'Select Category ?',
                      'That thing is still around?',
                      'question'
                    )
            }
            
            else if(insurer_class == "1" && ins_category !="" && ins_product == "")
            {
                check = 1;
                Swal.fire(
                      'Select Vechicle Classification ?',
                      'That thing is still around?',
                      'question'
                    )
            }
            
            else if(insurer_class == "1" && ins_state == "")
            {
                check = 1;
                Swal.fire(
                      'Select State ?',
                      'That thing is still around?',
                      'question'
                    )
            }

            else if(insurer_class == "1" && commission_type == "2" && vehicle_age_min == "")
            {
                check = 1;
                Swal.fire(
                      'Select Vehicle Min Age ?',
                      'That thing is still around?',
                      'question'
                    )
            }
            
            else if(insurer_class == "1" && commission_type == "2" && vehicle_age_max == "")
            {
                check = 1;
                Swal.fire(
                      'Select Vehicle Max Age ?',
                      'That thing is still around?',
                      'question'
                    )
            }
            
            else if(insurer_class == "1" && ins_rto == "" || ins_rto == null)
            {
                check = 1;
                Swal.fire(
                      'Select RTO?',
                      'That thing is still around?',
                      'question'
                    )
            }
            
            else if(on_net == "")
            {
                check = 1;
                Swal.fire(
                      'Enter a ON NET Percentage ?',
                      'That thing is still around?',
                      'question'
                    )
            }
            else if(gold_category == "")
            {
                check = 1;
                Swal.fire(
                      'Enter Gold Percentage ?',
                      'That thing is still around?',
                      'question'
                    )
            }
            else if(gold_category != "" && parseInt(gold_category) >= 91)
            {
                $("#err_span").html("");
                check = 1;
                $("#err_span").html(" * Alert : You can't Able to Add Commission More Than 90 % On Gold Category");
            }
            else if(silver_category == "")
            {
                check = 1;
                Swal.fire(
                      'The Silver Percentage ?',
                      'That thing is still around?',
                      'question'
                    )
            }
            
            else if(silver_category != "" && parseInt(silver_category) >= 91)
            {
                 $("#err_span").html("");
                check = 1;
                $("#err_span").html(" * Alert : You can't Able to Add Commission More Than 90 % On Sliver Category");
            }
            
            else if(bronze_category == "")
            {
                check = 1;
                Swal.fire(
                      'The Bronze Percentage ?',
                      'That thing is still around?',
                      'question'
                    )
            }
            
            else if(bronze_category != "" && parseInt(bronze_category) >= 91)
            {
                $("#err_span").html("");
                check = 1;
                $("#err_span").html(" * Alert : You can't Able to Add Commission More Than 90 % On Bronze Category");
            }
            
            else if(check != 1)
            {
                $("#err_span").html("");
                $.ajax({
                          url : "add_payout_commission",
                          method : "POST",
                          data:{
                          insurer_company:insurer_company,
                          policy_premium_type:ins_type,
                          insurer_class :insurer_class,
                          business_type:business_type,
                          commission_type:commission_type,
                          ins_rto : ins_rto,
                          vehicle_age_min:vehicle_age_min,
                          discount : discount,
                          category:ins_category,
                          product:ins_product,
                          state:ins_state,
                          vehicle_age_max:vehicle_age_max,
                          vehicle_age_max : vehicle_age_max,
                          own_od:own_od,
                          own_tp:own_tp,
                          on_net:on_net,
                          gold_category:gold_category,
                          silver_category:silver_category,
                          bronze_category:bronze_category,
                          min_val : min_val,
                          max_val : max_val,
                          no_of_policy : no_of_policy,
                          old_rto:old_rto,
                          },
                          beforeSend:function()
                          {
                              $("#next_btn").attr("disabled",true);
                          },
                          success:function(response)
                          {
                            if(response == "exits")
                              {
                                  $("#next_btn").attr("disabled",false);
                                  
                                    Swal.fire({
                                              icon: 'error',
                                              title: 'Oops...',
                                              text: 'This Type Of Commission Slab Already Exits',
                                              footer: '<a href=""></a>'
                                    })
                              }
                              else
                              {
                                var obj = jQuery.parseJSON(response);
                                {
                                    fetch_rto_list();
                                    
                                    for(var i =0;i<ins_rto.length;i++)
                                    {
                                         old_rto.push(ins_rto[i]);
                                    }
                                    
                                      if(obj.class == "1")
                                      {
                                          if(ins_rto[1] != "")
                                          {
                                              var rto_1 = ins_rto[1];
                                          }
                                          else
                                          {
                                              var rto_1 = "";
                                          }
                                             var content1 = "";
                                             content1 +="<tr>";
                                             content1 +="<td>"+obj.c_state+"</td>";
                                             content1 +="<td>"+ins_rto[0]+","+rto_1+"..</td>";
                                           
                                           if(obj.commission_type == "1")
                                           {
                                             content1 +="<td>"+obj.no_of_policy+"</td>";
                                             content1 +="<td>"+obj.vehicle_age_min+"</td>";
                                             content1 +="<td>"+obj.vehicle_age_max+"</td>";
                                           }
                                           else if(obj.commission_type == "2")
                                           {
                                             content1 +="<td>"+obj.no_of_policy+"</td>";
                                             content1 +="<td>"+obj.vehicle_age_min+"</td>";
                                             content1 +="<td>"+obj.vehicle_age_max+"</td>";
                                           }
                                           else if(obj.commission_type == "3")
                                           {
                                               content1 +="<td>"+obj.no_of_policy+"</td>";
                                               content1 +="<td>"+obj.min_val+"</td>";
                                               content1 +="<td>"+obj.max_val+"</td>";
                                           }
                                             content1 +="<td>"+obj.discount+"</td>";
                                             content1 +="<td>"+obj.own_od+"</td>";
                                             content1 +="<td>"+obj.own_tp+"</td>";
                                             content1 +="<td>"+obj.on_net+"</td>";
                                             content1 +="<td>"+obj.gold_category+"</td>";
                                             content1 +="<td>"+obj.silver_category+"</td>";
                                             content1 +="<td>"+obj.bronze_category+"</td>";
                                             content1 +="</tr>";
                                             
                                         $("#motor_content_view").removeClass("hidden");
                                         $("#motor_table_content").append(content1);
                                      }
                                      else if(obj.class == "2")
                                      {
                                             var content1 = "";
                                             content1 +="<tr>";
                                             if(obj.commission_type == "1")
                                             {
                                             content1 +="<td>"+obj.no_of_policy+"</td>";
                                             }
                                             else if(obj.commission_type == "3")
                                             {
                                                 content1 +="<td>"+obj.min_val+" - "+obj.max_val+"</td>";
                                             }
                                             content1 +="<td>"+obj.discount+"</td>";
                                             content1 +="<td>"+obj.on_net+"</td>";
                                             content1 +="<td>"+obj.gold_category+"</td>";
                                             content1 +="<td>"+obj.silver_category+"</td>";
                                             content1 +="<td>"+obj.bronze_category+"</td>";
                                             content1 +="</tr>";
                                             
                                         $("#health_content_view").removeClass("hidden");
                                         $("#health_table_content").append(content1);
                                      }
                                }
                                 
                                 
                                $("#next_btn").attr("disabled",false);
                                 $("#add_btn").attr("disabled",false);
                                          
                                          Swal.fire(
                                          'Payouts commission has been Added Successfully !',
                                          '',
                                          'success'
                                         )
                                          $("#ins_state").val("");
                                          $("#vehicle_age_min").val("");
                                          $("#vehicle_age_max").val("");
                                          $("#ins_rto").val("");
                                          $("#ins_rto").trigger("change");
                                          $("#discount").val("");
                                          $("#own_od").val("");
                                          $("#own_tp").val("");
                                          $("#on_net").val("");
                                          $("#gold_category").val("");
                                          $("#silver_category").val("");
                                          $("#bronze_category").val("");
                                          $("#min_val").val("");
                                          $("#max_val").val("");
                                          $("#g_span").html("");
                                          $("#s_span").html("");
                                          $("#b_span").html("");
                                          
                              }
                         }
                 });
              }
         });
       
        $("#add_btn").click(function(){
             
            $("#add_model").modal("toggle");
                var insurer_class = $("#insurer_class").val();
                Swal.fire(
                'All Payouts has been Added Successfully !',
                '',
                'success'
                )
                if(insurer_class == "1")
                {
                    fetch_payout_commission_motor();
                    $("#motor_li").addClass("active");
                    $("#health_li").removeClass("active");
                }
                else if(insurer_class == "2")
                {
                    fetch_payout_commission_health();
                    $("#motor_li").removeClass("active");
                    $("#health_li").addClass("active");
                }
            
            $("#insurer_company").val("");
            $("#insurer_company").trigger("change");
            $("#add_make").val("");
            $("#add_make").trigger("change");
            $("#add_model_motor").val("");
            $("#add_model_motor").trigger("change");
            $("#add_varient").val("");
            $("#add_varient").trigger("change");
            
            $(".form-control").val("");
            $("#g_span").html("");
            $("#s_span").html("");
            $("#b_span").html("");
            $("#add_btn").attr("disabled",true);
            $("#insurer_company").val("");
            $("#insurer_company").trigger("change");
            $("#motor_content_view").addClass("hidden");
            $("#motor_table_content").html("");
            $("#health_content_view").addClass("hidden");
            $("#health_table_content").html("");
        });
        
        $("#insurer_class").change(function(){
             
             $("#ins_category").val("");
             $("#ins_product").val("");
             
             var insurer_class = $("#insurer_class").val();
             
             if(insurer_class == "1")
             {
                 $("#vehi_div").removeClass("hidden");
                 load_hidden_classes();
             }
             else if(insurer_class == "2")
             {
                 $("#vehi_div").addClass("hidden");
                 load_hidden_classes();
             }
              
         });
         
        $("#commission_type").change(function(){
             load_hidden_classes();
         });
         
        $("#search_btn").click(function(){
            
            var select_insurer = $("#select_insurer").val();
            var select_premium_type = $("#select_premium_type").val();
            var select_business_type = $("#select_business_type").val();
            var select_commission_type = $("#select_commission_type").val();
            
            fetch_payout_commission_motor_search(select_insurer,select_premium_type,select_business_type,select_commission_type);
             
         });
         
        $("#edit_btn").click(function(){
             var edit_id  = $("#edit_id").val();
             var insurer_company = $("#edit_insurer_company").val();
             var ins_type = $("#edit_ins_type").val();
             var insurer_class = $("#edit_insurer_class").val();
             var business_type = $("#edit_insurer_business_type").val();
             var commission_type = $("#edit_commission_type").val();
             var ins_category = $("#edit_ins_category").val();
             var ins_product = $('#edit_ins_product').val();
             var ins_state = $("#edit_ins_state").val();
             var ins_rto = $("#edit_ins_rto").val();
             var vehicle_age_max = $("#edit_vehicle_age_max").val();
             var vehicle_age_min = $("#edit_vehicle_age_min").val();
             var discount = $("#edit_discount").val();
             var own_od = $("#edit_own_od").val();
             var own_tp = $("#edit_own_tp").val();
             var on_net = $("#edit_on_net").val();
             var gold_category = $("#edit_gold_category").val();
             var silver_category = $("#edit_silver_category").val();
             var bronze_category = $("#edit_bronze_category").val();
             // target amount 
             var min_val = $("#edit_min_val").val();
             var max_val = $("#edit_max_val").val();
             // no policy 
             var no_of_policy = $("#edit_no_of_policy").val();
             
             var check = 0;
             
            if(insurer_company == "")
            {
                check = 1;
                    Swal.fire(
                      'Select Insurer',
                      'That thing is still around?',
                      'question'
                    )
            }
            
            else if(insurer_class == "")
            {
                check = 1;
                    Swal.fire(
                      'Select Class',
                      'That thing is still around?',
                      'question'
                    )
            }
            else if(business_type == "")
            {
                check = 1;
                    Swal.fire(
                      'Select Business Type ?',
                      'That thing is still around?',
                      'question'
                    )
            }
            else if(ins_type == "")
            {
                check = 1;
                
                    Swal.fire(
                      'Select Premium Type ?',
                      'That thing is still around?',
                      'question'
                    )
            }
            
            else if(commission_type == "")
            {
                check = 1;
                
                    Swal.fire(
                      'Select Commission Type ?',
                      'That thing is still around?',
                      'question'
                    )
            }
            
            else if(insurer_class !="" && insurer_class == "1" && ins_category == "")
            {
                check = 1;
                Swal.fire(
                      'Select Category ?',
                      'That thing is still around?',
                      'question'
                    )
            }
            
            else if(insurer_class == "1" && ins_category !="" && ins_product == "")
            {
                check = 1;
                Swal.fire(
                      'Select Vechicle Classification ?',
                      'That thing is still around?',
                      'question'
                    )
            }
            
            else if(insurer_class == "1" && ins_state == "")
            {
                check = 1;
                Swal.fire(
                      'Select State ?',
                      'That thing is still around?',
                      'question'
                    )
            }

            else if(insurer_class == "1" && commission_type == "2" && vehicle_age_min == "")
            {
                check = 1;
                Swal.fire(
                      'Select Vehicle Min Age ?',
                      'That thing is still around?',
                      'question'
                    )
            }
            
            else if(insurer_class == "1" && commission_type == "2" && vehicle_age_max == "")
            {
                check = 1;
                Swal.fire(
                      'Select Vehicle Max Age ?',
                      'That thing is still around?',
                      'question'
                    )
            }
            
            else if(insurer_class == "1" && ins_rto == "")
            {
                check = 1;
                Swal.fire(
                      'Select RTO?',
                      'That thing is still around?',
                      'question'
                    )
            }
            
            else if(on_net == "")
            {
                check = 1;
                Swal.fire(
                      'Enter a On Net Percentage ?',
                      'That thing is still around?',
                      'question'
                    )
            }
            else if(gold_category == "")
            {
                check = 1;
                Swal.fire(
                      'Enter Gold Percentage ?',
                      'That thing is still around?',
                      'question'
                    )
            }
            else if(gold_category != "" && parseInt(gold_category) >= 91)
            {
                $("#edit_err_span").html("");
                check = 1;
                $("#edit_err_span").html(" * Alert : You can't Able to Add Commission More Than 90 % On Gold Category");
            }
            else if(silver_category == "")
            {
                check = 1;
                Swal.fire(
                      'The Silver Percentage ?',
                      'That thing is still around?',
                      'question'
                    )
            }
            
            else if(silver_category != "" && parseInt(silver_category) >= 91)
            {
                 $("#edit_err_span").html("");
                check = 1;
                $("#edit_err_span").html(" * Alert : You can't Able to Add Commission More Than 90 % On Sliver Category");
            }
            
            else if(bronze_category == "")
            {
                check = 1;
                Swal.fire(
                      'The Bronze Percentage ?',
                      'That thing is still around?',
                      'question'
                    )
            }
            
            else if(bronze_category != "" && parseInt(bronze_category) >= 91)
            {
                $("#err_span").html("");
                check = 1;
                $("#edit_err_span").html(" * Alert : You can't Able to Add Commission More Than 90 % On Bronze Category");
            }
            
            else if(check != 1)
            {
                $("#edit_err_span").html("");
                
                $.ajax({
                          url : "edit_payout_commission",
                          method : "POST",
                          data:{
                          id : edit_id,
                          insurer_company:insurer_company,
                          policy_premium_type:ins_type,
                          insurer_class :insurer_class,
                          business_type:business_type,
                          commission_type:commission_type,
                          ins_rto : ins_rto,
                          vehicle_age_min:vehicle_age_min,
                          discount : discount,
                          category:ins_category,
                          product:ins_product,
                          state:ins_state,
                          vehicle_age_max:vehicle_age_max,
                          vehicle_age_max : vehicle_age_max,
                          own_od : own_od,
                          own_tp:own_tp,
                          on_net:on_net,
                          gold_category:gold_category,
                          silver_category:silver_category,
                          bronze_category:bronze_category,
                          min_val : min_val,
                          max_val : max_val,
                          no_of_policy : no_of_policy,
                          },
                          beforeSend:function()
                          {
                              $("#edit_btn").attr("disabled",true);
                          },
                          success:function(response)
                          {
                            if(response == "exits")
                              {
                                  $("#edit_btn").attr("disabled",false);
                                  
                                    Swal.fire({
                                              icon: 'error',
                                              title: 'Oops...',
                                              text: 'This Type Of Commission Slab Already Exits',
                                              footer: '<a href=""></a>'
                                    })
                              }
                              else
                              {
                                  $("#edit_btn").attr("disabled",false);
                                  $("#edit_model").modal("toggle");
                                  $(".form-control").val("");
                                  
                                  if(insurer_class == "1")
                                  {
                                      fetch_payout_commission_motor();
                                  }
                                  else if(insurer_class == "2")
                                  {
                                      fetch_payout_commission_motor();
                                  }
                                  
                                    Swal.fire({
                                          position: 'top-end',
                                          icon: 'success',
                                          title: 'Updated Successfully..',
                                          showConfirmButton: false,
                                          timer: 1500
                                        })
                                  
                              }
                         }
                 });
              }
         });
         
        $("#gold_category").keyup(function(){
          
              $("#g_span").html("");
              var on_net = $("#on_net").val();
              var gold_category = $("#gold_category").val();
              
              if(on_net != "")
              {
                  var commission = parseInt(on_net) * parseInt(gold_category)/100;
                  $("#g_span").html(commission +" %");
              }
        });

        $("#silver_category").keyup(function(){
          $("#s_span").html("");
          var on_net = $("#on_net").val();
          var silver_category = $("#silver_category").val();
          if(on_net != "")
          {
              var commission = parseInt(on_net) * parseInt(silver_category)/100;
              
              $("#s_span").html(commission +" %");
              
          }
 });
 
        $("#bronze_category").keyup(function(){
            $("#b_span").html("");
            var on_net = $("#on_net").val();
            var bronze_category = $("#bronze_category").val();
            if(on_net != "")
            {
                var commission = parseInt(on_net) * parseInt(bronze_category)/100;
                $("#b_span").html(commission +" %");
            }
        });
        
      });
    
    function fetch_payout_commission_motor()
    {
      var content = "";
      content += "<div class='table-responsive'>";
      content += "<table id='table_id' class='table table-hover table-bordered'>"; 
      content += "<thead><th>S.No</th><th>Insurer</th><th>Premium Type</th><th>Vehi Classification</th><th>State</th><th>OD</th><th>TP</th><th>On NET</th><th>Gold</th><th>Silver</th><th>Bronze</th><th>Action</th></thead>";
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
            'url':'fetch_payout_commission',
          }
      });      
    }
    
    function fetch_payout_commission_health()
    {
       var content = "";
      content += "<div class='table-responsive'>";
      content += "<table id='table_id' class='table table-hover table-bordered'>"; 
      content += "<thead><th>S.No</th><th>Insurer</th><th>Premium Type</th><th>Commission Type</th><th>Min Value</th><th>Max Value</th><th>No of Policy</th><th>Own Commission</th><th>Gold</th><th>Silver</th><th>Bronze</th><th>Action</th></thead>";
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
            'url':'fetch_payout_commission_health',
          }
      });      
    }
    
    function load_hidden_classes()
    {
        $("#min_val").val("");
        $("#max_val").val("");
        $("#ins_state").val("");
        $("#ins_rto").val("");
        $("#ins_rto").trigger("change");
        $("#no_of_policy").val("");
        $("#vehicle_age_min").val("");
        $("#vehicle_age_max").val("");
        
             var commission_type = $("#commission_type").val();
             var insurer_class = $("#insurer_class").val();
         
         if(insurer_class != "")
         {
             if(commission_type == "1")
             {
               if(insurer_class == "1")
               {
                   $("#no_of_policy_hidden").removeClass("hidden");
                   $("#rto_hidden").removeClass("hidden");
                   $("#state_hidden").removeClass("hidden");
                   $("#vehi_age_min_hidden").addClass("hidden");
                   $("#vehi_age_max_hidden").addClass("hidden");
                   $("#min_max_hidden").addClass("hidden");
                   $("#rto_hidden").removeClass("hidden");
               }
               else if(insurer_class == "2")
               {
                   $("#no_of_policy_hidden").removeClass("hidden");
                   $("#rto_hidden").addClass("hidden");
                   $("#state_hidden").addClass("hidden");
                   $("#vehi_age_min_hidden").addClass("hidden");
                   $("#vehi_age_max_hidden").addClass("hidden");
                   $("#min_max_hidden").addClass("hidden");
                   $("#rto_hidden").addClass("hidden");
               }
             }
             else if(commission_type == "2")
             {
                if(insurer_class == "1")
                   {
                       $("#vehi_age_min_hidden").removeClass("hidden");
                       $("#vehi_age_max_hidden").removeClass("hidden");
                       $("#rto_hidden").removeClass("hidden");
                       $("#state_hidden").removeClass("hidden");
                       $("#no_of_policy_hidden").addClass("hidden");
                       $("#min_max_hidden").addClass("hidden");
                       $("#rto_hidden").removeClass("hidden");
                   }
             }
             else if(commission_type == "3")
             {
                  if(insurer_class == "1")
                   {
                       $("#min_max_hidden").removeClass("hidden");
                       $("#rto_hidden").removeClass("hidden");
                       $("#state_hidden").removeClass("hidden");
                       $("#no_of_policy_hidden").addClass("hidden");
                       $("#vehi_age_min_hidden").addClass("hidden");
                       $("#vehi_age_max_hidden").addClass("hidden");
                       $("#rto_hidden").addClass("hidden");
                   }
                   else if(insurer_class == "2")
                   {
                       $("#min_max_hidden").removeClass("hidden");
                       $("#rto_hidden").addClass("hidden");
                       $("#state_hidden").addClass("hidden");
                       $("#no_of_policy_hidden").addClass("hidden");
                       $("#vehi_age_min_hidden").addClass("hidden");
                       $("#vehi_age_max_hidden").addClass("hidden");
                   }
             }
         }
         else
         {
             $("#commission_type").val("");
             Swal.fire(
                      'Select Insurer Class',
                      'That thing is still around?',
                      'question'
                    )
         }
    }
   
    function fetch_payout_commission_motor_search(select_insurer,select_premium_type,select_business_type,select_commission_type)
    {
      var content = "";
      content += "<div class='table-responsive'>";
      content += "<table id='table_id' class='table table-hover table-bordered'>"; 
      content += "<thead><th>S.No</th><th>Insurer</th><th>Premium Type</th><th>Vehi Classification</th><th>State</th><th>Own Commission</th><th>Gold</th><th>Silver</th><th>Bronze</th><th>Action</th></thead>";
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
            'url':'fetch_payout_commission_search',
            'method' : "POST",
            'data' : {insurer:select_insurer,premium_type:select_premium_type,business_type:select_business_type,commission_type:select_commission_type},
          }
      });      
    }
    
    
    function view_data(id)
    {
        $.ajax({
                url : "fetch_commission_details",
                method : "POST",
                data : {id:id},
                success:function(response)
                {
                    $("#view_payout_content").html(response);
                    $("#view_model").modal("toggle");
                }
        });
    }
    
    function edit_data(id)
    {
        $.ajax({
                url : "fetch_edit_commission_details",
                method : "POST",
                data : {id:id},
                success:function(response)
                {
                   var obj = jQuery.parseJSON(response);
                   
                    if(obj["c_details"].class != "")
                     {
                         if(obj["c_details"].commission_type == "1")
                         {
                               if(obj["c_details"].class == "1")
                               {
                                   $("#edit_vehi_div").removeClass("hidden");
                                   
                                   $("#edit_no_of_policy_hidden").removeClass("hidden");
                                   $("#edit_rto_hidden").removeClass("hidden");
                                   $("#edit_state_hidden").removeClass("hidden");
                                   $("#edit_vehi_age_min_hidden").addClass("hidden");
                                   $("#edit_vehi_age_max_hidden").addClass("hidden");
                                   $("#edit_min_max_hidden").addClass("hidden");
                               }
                           else if(obj["c_details"].class == "2")
                           {
                                $("#edit_vehi_div").addClass("hidden");
                                
                               $("#edit_no_of_policy_hidden").removeClass("hidden");
                               $("#edit_rto_hidden").addClass("hidden");
                               $("#edit_state_hidden").addClass("hidden");
                               $("#edit_vehi_age_min_hidden").addClass("hidden");
                               $("#edit_vehi_age_max_hidden").addClass("hidden");
                               $("#edit_min_max_hidden").addClass("hidden");
                           }
                         }
                         else if(obj["c_details"].commission_type == "2")
                         {
                            if(obj["c_details"].class == "1")
                               {
                                   $("#edit_vehi_div").removeClass("hidden");
                                   
                                   $("#edit_vehi_age_min_hidden").removeClass("hidden");
                                   $("#edit_vehi_age_max_hidden").removeClass("hidden");
                                   $("#edit_rto_hidden").removeClass("hidden");
                                   $("#edit_state_hidden").removeClass("hidden");
                                   $("#edit_no_of_policy_hidden").addClass("hidden");
                                   $("#edit_min_max_hidden").addClass("hidden");
                               }
                         }
                         else if(obj["c_details"].commission_type == "3")
                         {
                              if(obj["c_details"].class == "1")
                               {
                                   $("#edit_vehi_div").removeClass("hidden");
                                   
                                   $("#edit_min_max_hidden").removeClass("hidden");
                                   $("#edit_rto_hidden").removeClass("hidden");
                                   $("#edit_state_hidden").removeClass("hidden");
                                   $("#edit_no_of_policy_hidden").addClass("hidden");
                                   $("#edit_vehi_age_min_hidden").addClass("hidden");
                                   $("#edit_vehi_age_max_hidden").addClass("hidden");
                               }
                               else if(obj["c_details"].class == "2")
                               {
                                   $("#edit_vehi_div").addClass("hidden");
                                   $("#edit_min_max_hidden").removeClass("hidden");
                                   $("#edit_rto_hidden").addClass("hidden");
                                   $("#edit_state_hidden").addClass("hidden");
                                   $("#edit_no_of_policy_hidden").addClass("hidden");
                                   $("#edit_vehi_age_min_hidden").addClass("hidden");
                                   $("#edit_vehi_age_max_hidden").addClass("hidden");
                               }
                         }
                     }
                     
                     if(obj["c_details"].class == "1")
                     {
                         load_sub_category(obj["c_details"].category,obj["c_details"].product);
                     }
                     
                     if(obj["c_details"].class == "1")
                     {
                         load_rto_list(obj["c_details"].id);
                     }
                   
                   $("#edit_insurer_company").val(obj["c_details"].insurer_company);
                   $("#edit_insurer_class").val(obj["c_details"].class);
                   $("#edit_insurer_business_type").val(obj["c_details"].business_type);
                   $("#edit_ins_type").val(obj["c_details"].policy_premium_type);
                   $("#edit_commission_type").val(obj["c_details"].commission_type);
                   
                   $("#edit_no_of_policy").val(obj["c_details"].no_of_policy);
                   
                   $("#edit_min_val").val(obj["c_details"].min_val);
                   $("#edit_max_val").val(obj["c_details"].max_val);
                   
                   $("#edit_vehicle_age_min").val(obj["c_details"].vehicle_age_min);
                   $("#edit_vehicle_age_max").val(obj["c_details"].vehicle_age_max);
                   
                   
                   if(obj["c_details"].class == "1")
                   {
                       $("#edit_ins_category").val(obj["c_details"].category);
                       $("#edit_ins_product").val(obj["c_details"].product);
                       $("#edit_ins_state").val(obj["c_details"].state);
                   }
                   
                   $("#edit_discount").val(obj["c_details"].discount);
                   $("#edit_own_od").val(obj["c_details"].own_od);
                   $("#edit_own_tp").val(obj["c_details"].own_tp);
                   $("#edit_on_net").val(obj["c_details"].on_net);
                   $("#edit_gold_category").val(obj["c_details"].gold_category);
                   $("#edit_silver_category").val(obj["c_details"].silver_category);
                   $("#edit_bronze_category").val(obj["c_details"].bronze_category);
                   
                   $("#edit_id").val(obj["c_details"].id);
                   
                   $("#edit_model").modal("toggle");
                }
        });
    }
    
    function load_sub_category(id,classification)
    {
        $.ajax({
                 url : "fetch_sub_category_list",
                 method : "POST",
                 data : {id:id},
                 success:function(response)
                 {
                     $("#edit_ins_product").html("");
                     
                     var obj = jQuery.parseJSON(response);
                     
                     for(var i=0;i<obj.length;i++)
                     {
                         if(classification == obj[i].id)
                         {
                            $("#edit_ins_product").append("<option value="+obj[i].id+" selected>"+obj[i].motor_gvw+"</option>");
                         }
                         else
                         {
                             $("#edit_ins_product").append("<option value="+obj[i].id+">"+obj[i].motor_gvw+"</option>");
                         }
                     }
                 }
        });
    }
    
    function load_rto_list(id)
    {
        $.ajax({
                 url : "fetch_rto_list",
                 method : "POST",
                 data : {id:id},
                 success:function(response)
                 {
                     var obj = jQuery.parseJSON(response);
                     $("#edit_ins_rto").val(obj);
                     $("#edit_ins_rto").trigger("change");
                 }
        });
    }
    
    
    
    function delete_data(id)
    {
        if(confirm("Are you Confirm to Delete"))
          {
                $.ajax({
                        url : "delete_commission_list",
                        method : "POST",
                        data : {id:id},
                        success:function(response)
                        {
                            fetch_payout_commission_motor();
                            
                                Swal.fire(
                                      'Good job!',
                                      'Payout Commission Deleted Successfully !',
                                      'success'
                                    )
                        }
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
                  
                  if(obj.masters_add == "1")
                  {
                      $("#add_mod").removeClass("hidden");
                      $("#excel_export").removeClass("hidden");
                  }
                  else
                  {
                      $("#add_mod").addClass("hidden");
                      $("#excel_export").addClass("hidden");
                  }
              }
          });
      }
    
    
    function fetch_rto_list()
    {
        $.ajax({
                url : "fetch_rto_list_new",
                success:function(response)
                {
                    $("#ins_rto").html("");
                    $("#ins_rto").append(response);
                    $("#ins_rto").trigger("change");
                }
        });
    }
    
    function export_excel()
    {
        $.ajax({
                  url : "export_payout_commission",
                  method : "POST",
                  success:function(response)
                  {
                       window.location.href=response;
                  }
        });
    }
  </script>