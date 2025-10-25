 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1 style="font-size: 17px;">
        Create Claim
      </h1>
    </section>
    

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

.form-control[disabled], .form-control[readonly], fieldset[disabled] .form-control {
    background-color: #fff;
    opacity: 1;
}
 </style>

   
    <!-- Main content -->
    <section class="content">
      <!-- Default box -->
      <div class="box">
        <div class="box-body">
            
               <div class="form-group">
                <div class="row">
                     <div class="col-md-12">
                      <button type="button" class="btn btn-success pull-right" id="submit_btn"><i class="fa fa-save"></i> Submit</button>
                      <button type="button" class="btn btn-warning pull-right hidden" id="updata_btn"><i class="fa fa-save"></i> Updata</button>
                    </div>
                </div>
            </div>
            
                        <div class="nav-tabs-custom">
                            <ul class="nav nav-tabs">
                                <li class="active" id="motor_li"><a href="#tab_1" id="tab_1" data-toggle="tab" aria-expanded="true" class="allusers" onclick="fetch_claim_motor()" >Motor</a></li>
                                <!--<li class="" id="health_li"><a href="#tab_2" data-toggle="tab" aria-expanded="false" onclick="fetch_generate_policy_health()">New Profile</a></li>-->
                                <li class="" id="health_li"><a href="#tab_2" id="tab_2" data-toggle="tab" aria-expanded="false" class="paidusers" onclick="fetch_claim_health()">Health</a></li>
                                <li class="" id="sme_li"><a href="#tab_3" id="tab_3" data-toggle="tab" aria-expanded="false" class="unpaidusers" onclick="fetch_claim_sme()">SME</a></li>
                            </ul>
                        </div>
                        
        <form id = "myform">    
            <div class="row" id="create_claim">
                <div class="col-md-6">
                    
                    <input type="text" class="hidden" id="claim_id" name="claim_id" value="<?=(isset($claimdata->id) && !empty($claimdata->id) ? $claimdata->id : "")?>">
                  <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                                <label>Policy Number</label>
                            </div>
                             <div class="col-md-8">
                               <input type="text" placeholder="Enter Your Policy Number" class="form-control" name="add_policy_no" id="add_policy_no" <?=(isset($claimdata->policy_no) && !empty($claimdata->policy_no) ? "readonly" : "")?> value="<?=(isset($claimdata->policy_no) && !empty($claimdata->policy_no) ? $claimdata->policy_no : "")?>">
                            </div>
                        </div>
                    </div>
                    
                    
                      <div class="form-group" id="v_regn_no_div">
                            <div class="row">
                                <div class="col-md-4">
                                    <label>Regn no</label>
                                </div>
                                
                                <?php 
                                    if( isset( $claimdata->vechi_register_no ) && !empty( $claimdata->vechi_register_no ) ) {
                                        $vechi_register_no = explode("-", $claimdata->vechi_register_no);
                                    }
                                ?>
                                
                                <div class="col-md-2 inputs">
                                    <input type="text" class="form-control inputs" style="text-transform:uppercase" name="v_regn_no_1" id="v_regn_no_1" maxlength="2" 
                                    value="<?=(isset($vechi_register_no[0]) && !empty($vechi_register_no[0])) ? $vechi_register_no[0] : ""?>">
                                </div>
                                <div class="col-md-2 inputs">
                                    <input type="text" class="form-control inputs" name="v_regn_no_2" id="v_regn_no_2" maxlength="2" value="<?=(isset($vechi_register_no[1]) && !empty($vechi_register_no[1])) ? $vechi_register_no[1] : ""?>">
                                </div>
                                <div class="col-md-2 inputs">
                                    <input type="text" class="form-control inputs" style="text-transform:uppercase" name="v_regn_no_3" id="v_regn_no_3" maxlength="2" value="<?=(isset($vechi_register_no[2]) && !empty($vechi_register_no[2])) ? $vechi_register_no[2] : ""?>">
                                </div>
                                <div class="col-md-2 inputs">
                                    <input type="text" class="form-control inputs" name="v_regn_no_4" id="v_regn_no_4" maxlength="4" value="<?=(isset($vechi_register_no[3]) && !empty($vechi_register_no[3])) ? $vechi_register_no[3] : ""?>">
                                </div>
                            </div>
                        </div>
                        
                       
                      <div class="form-group hidden" id="aadher_number_div">
                           <div class="row">
                            <div class="col-md-4">
                                <label>Aadher Number</label>
                            </div>
                             <div class="col-md-8">
                               <input type="text" class="form-control" name="aadher_number" id="aadher_number">
                            </div>
                        </div>
                      </div> 
                      
                       <div class="form-group hidden" id="gst_number_div">
                           <div class="row">
                            <div class="col-md-4">
                                <label>GST Number</label>
                            </div>
                             <div class="col-md-8">
                               <input type="text" class="form-control" name="gst_number" id="gst_number">
                            </div>
                        </div>
                      </div>    
                        
                    
                    
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                                <label>Agency/Pos</label>
                            </div>
                             <div class="col-md-8">
                               <select class="form-control select2" name="add_agency_pos" id="add_agency_pos" >
                                   <option value="">--Select--</option>
                                   <?php foreach($agents_pos as $da){ ?>
                                     <option value="<?php echo $da->id ?>" <?=(isset($claimdata->agent_pos) && $claimdata->agent_pos == $da->id) ? "selected" : ""?>><?php echo $da->name ?></option>
                                   <?php } ?>
                               </select>
                            </div>
                        </div>
                    </div>
                    
                    
                       <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                                <label>Area Incharge</label>
                            </div>
                             <div class="col-md-8">
                              <select class="form-control select2" required  name="select_areaincharge" id="select_areaincharge" style="width:100%">
                                <option value="">-Select Area incharge-</option>
                                 
                                 <?php if($this->session->userdata("session_role") == "AI") { ?>
                                   <option value="<?php echo $this->session->userdata('session_id') ?>"><?php echo $this->session->userdata('session_name') ?></option>
                                 <?php }else{ ?>
                                 
                                    <?php foreach($name as $da){ ?>
                                    <option value="<?php echo $da->id ?>" <?=(isset($claimdata->ai_id) && $claimdata->ai_id == $da->id) ? "selected" : ""?>><?php echo $da->name ?></option>
                                                    <?php } }?>
                              </select>
                            </div>
                        </div>
                    </div>
                    
                    
                     <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                                <label>Mobile No</label>
                            </div>
                             <div class="col-md-8">
                               <input type="text" class="form-control" name="add_mobile_no" id="add_mobile_no" readonly <?=(isset($claimdata->agent_pos) && !empty($claimdata->agent_pos) ? "readonly" : "")?> value="<?=(isset($claimdata->policy_no) && !empty($claimdata->policy_no) ? $claimdata->policy_no : "")?>">
                            </div>
                        </div>
                    </div>
                   
                     <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                                <label>Business Type</label>
                            </div>
                             <div class="col-md-8">
                               <input type="text" class="form-control" name="add_business_type" id="add_business_type" readonly <?=(isset($claimdata->phone_number) && !empty($claimdata->phone_number) ? "readonly" : "")?> value="<?=(isset($claimdata->phone_number) && !empty($claimdata->phone_number) ? $claimdata->phone_number : "")?>">
                            </div>
                        </div>
                    </div>
                    
                        <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                                <label>Estimated Loss</label>
                            </div>
                             <div class="col-md-8">
                               <input type="number" class="form-control" id="add_estimated_loss" name="add_estimated_loss" value="<?=(isset($claimdata->estimated_loss) && !empty($claimdata->estimated_loss) ? $claimdata->estimated_loss : "")?>">
                            </div>
                        </div>
                    </div>
                    
                     <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                                <label>Date Of Loss</label>
                            </div>
                             <div class="col-md-8">
                               <input type="date" class="form-control" id="add_date_of_loss" name="add_date_of_loss">
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

        </form>    
            
                </div>
                
                <div class="col-md-6">
                    
                    <input type="hidden" id="lead_id">
                    <input type="hidden" id="client_id">
                    
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                                <label>Client Name</label>
                            </div>
                             <div class="col-md-8">
                               <input type="text" class="form-control" name="add_client_name" id="add_client_name" readonly <?=(isset($claimdata->clientname) && !empty($claimdata->clientname) ? "readonly" : "")?> value="<?=(isset($claimdata->clientname) && !empty($claimdata->clientname) ? $claimdata->clientname : "")?>">
                            </div>
                        </div>
                    </div>
                    
                      <div class="form-group">
                      <div class="row">   
                           <div class="col-md-4">
                               <label>Assign to User </label>
                           </div>
                            <div class="col-md-8">
                                <select class="form-control" name="assign_to_user" id="assign_to_user">
                                <option value="">Select</option>
                                 <?php
                                    if($this->session->userdata("session_role") == "admin")
                                    { ?>
                                    <?php foreach($users as $da){?>
                                    <option value="<?php echo $da->id ?>" <?=(isset($claimdata->user_id) && $claimdata->user_id == $da->id) ? "selected" : ""?>><?php echo $da->username."  (".$da->email_id.")" ?></option>
                                    <?php }} ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    
                     <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                                <label>Address</label>
                            </div>
                             <div class="col-md-8">
                               <textarea type="text" class="form-control" name="add_address" id="add_address" rows="2" readonly>  <?=(isset($claimdata->address) && !empty($claimdata->address) ? $claimdata->address : "")?></textarea>
                            </div>
                        </div>
                    </div>
                    

                    
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                                <label>Claim Processing Status</label>
                            </div>
                             <div class="col-md-8">
                               <select class="form-control" name="add_pro_status" id="add_pro_status">
                                   <option value="">--Select--</option>
                                   <option value="New Intimation">New Intimation</option>
                                   <option value="Processing">Processing</option>
                                   <option value="Payment Received">Payment Received</option>
                               </select>
                            </div>
                        </div>
                    </div>
                    
                          <div class="form-group" id="make_model_div">
                        <div class="row">
                            <div class="col-md-4">
                                <label>Make/Model/Varient</label>
                            </div>
                             <div class="col-md-8">
                               <input type="text" class="form-control" name="add_make_model" id="add_make_model" readonly <?=(isset($claimdata->make_model) && !empty($claimdata->make_model) ? "readonly" : "")?> value="<?=(isset($claimdata->make_model) && !empty($claimdata->make_model) ? $claimdata->make_model : "")?>">
                            </div>
                        </div>
                    </div>
                    
                    
                   
                     <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                                <label>Claim Receipt Date</label>
                            </div>
                             <div class="col-md-8">
                               <input type="date" class="form-control" name="add_re_date" id="add_re_date" value="<?php echo date("Y-m-d") ?>">
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                    <div class="row">   
                       <div class="col-md-4">
                            <label>Document Submit</label>
                       </div>
                         <div class="col-md-8">
                             <input type="checkbox" class="form-check-input"  name="claim_report" id="claim_report" >
                              <label> Claim Repory</label>
                              <input type="checkbox" class="form-check-input"   name="fir_copy" id="fir_copy" >
                              <label>FIR Copy</label>
                              <input type="checkbox" class="form-check-input"   name="surveyor_report" id="surveyor_report" >
                             <label>Surveyor report</label>
                         </div>
                    </div>
                </div>
                
                
                <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                                <label>Claim Reference No</label>
                            </div>
                             <div class="col-md-8">
                               <input type="text" class="form-control" name="reference_no" id="reference_no"  value="<?=(isset($claimdata->claim_ref_no) && !empty($claimdata->claim_ref_no) ? $claimdata->claim_ref_no : "")?>">
                            </div>
                        </div>
                    </div>
                
                    
                </div>
                
            </div>
            
          </form>
       
      </div><!-- /.box -->
      
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
      
      
    </section><!-- /.content -->
  </div><!-- /.content-wrapper -->
  
  
  <script>
  
  var content = "";
  
  
  
    $(document).ready(function(){
        

          
          $('.select2').select2();
          
           $('#remove_upload_btn').click(function(){
              $('#multi_images').children().last().remove();
        });
        
    
          
        
          $("#add_policy_no").change(function(){
              var policy_no = $("#add_policy_no").val();
               $.ajax({
                            url : "fetch_client_details_by_policy_no",
                            method : "POST",
                            data : {policy_no:policy_no},
                            success:function(response)
                            {
                                 var obj = jQuery.parseJSON(response);
                                 console.log(obj["basic_details"].class);
                                 console.log(obj["vechi_details"].vechi_register_no);
                                 if(obj["basic_details"].class = "1")
                                 {
                                     if(obj["basic_details"].vechi_register_no){
                                         var v_regn_number = (obj["basic_details"].vechi_register_no).split("-");
                                        $("#v_regn_no_1").val(v_regn_number[0]);
                                        $("#v_regn_no_2").val(v_regn_number[1]);
                                        $("#v_regn_no_3").val(v_regn_number[2]);
                                        $("#v_regn_no_4").val(v_regn_number[3]);
                                     }
                                     
                                     var size = Object.keys(obj["vechi_details"]).length;
                                     if(size > 0){
                                          
                                        
                                        $("#add_make_model").val(obj["vechi_details"].brand_name+" "+" "+obj["vechi_details"].model_name+" "+obj["vechi_details"].varient_name);
                                     }
                                     

                                 }
                             
                                 
                                 $("#add_client_name").val(obj["basic_details"].client_name);
                                 $("#add_mobile_no").val(obj["basic_details"].mobile_no);
                                 $("#add_business_type").val(obj["basic_details"].bussiness_type);
                                 
                                 $("#lead_id").val(obj["basic_details"].lead_id);
                                 $("#client_id").val(obj["basic_details"].id);
                                 
                                 $("#add_address").val(obj["basic_details"].address);
                                 
                                 
                            }
                  });
          });
          
          
          
           $("#v_regn_no_4").change(function(){
              var v_regn_no_1 = $("#v_regn_no_1").val();
              var v_regn_no_2 = $("#v_regn_no_2").val();
              var v_regn_no_3 = $("#v_regn_no_3").val();
              var v_regn_no_4 = $("#v_regn_no_4").val();
               $.ajax({
                            url : "fetch_client_details_by_regn_no",
                            method : "POST",
                            data : {v_regn_no_1:v_regn_no_1,v_regn_no_2:v_regn_no_2,v_regn_no_3:v_regn_no_3,v_regn_no_4:v_regn_no_4},
                            success:function(response)
                            {
                                 var obj = jQuery.parseJSON(response);
                                 $("#add_policy_no").val(obj["basic_details"].policy_no);
                                 $("#add_client_name").val(obj["basic_details"].client_name);
                                 $("#add_mobile_no").val(obj["basic_details"].mobile_no);
                                 $("#add_business_type").val(obj["basic_details"].bussiness_type);
                                 
                                 $("#lead_id").val(obj["basic_details"].lead_id);
                                 $("#client_id").val(obj["basic_details"].id);
                                 
                                 $("#add_address").val(obj["basic_details"].address);
                                 $("#add_make_model").val(obj["vechi_details"].brand_name+" "+" "+obj["vechi_details"].model_name+" "+obj["vechi_details"].varient_name);
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
          
           $("#submit_btn").click(function(){
            
            var claim_id = $("#claim_id").val();
            var add_client_name = $("#add_client_name").val();
            var add_policy_no = $("#add_policy_no").val();
            var add_re_date = $("#add_re_date").val();
            var add_estimated_loss = $("#add_estimated_loss").val();
            var add_agency_pos = $("#add_agency_pos").val();
            var add_date_of_loss = $("#add_date_of_loss").val();
            var select_areaincharge = $("#select_areaincharge").val();
            var assign_to_user = $("#assign_to_user").val();
            var reference_no = $("#reference_no").val();
            var mobile_no = $("#add_mobile_no").val();
            var add_address = $("#add_address").val();
            //var drv_license = $("#add_driving_license").val(); 
            // var spot_img = $("#add_files").val();
            var lead_id = $("#lead_id").val();
            var client_id = $("#client_id").val();
            //var add_rc_book = $("#add_rc_book").prop('files')[0];
            //var add_driving_license = $("#add_driving_license").prop('files')[0];
            
            var v_regn_no_1 = $("#v_regn_no_1").val();
            var v_regn_no_2 = $("#v_regn_no_2").val();
            var v_regn_no_3 = $("#v_regn_no_3").val();
            var v_regn_no_4 = $("#v_regn_no_4").val();
            
            var v_regn_no = v_regn_no_1+"-"+v_regn_no_2+"-"+v_regn_no_3+"-"+v_regn_no_4;
            
            var aadher_number = $("#aadher_number").val();
            var gst_number = $("#gst_number").val();
            var make_model = $("#add_make_model").val();
            var remarks = $("#remarks").val();
            
            
            
            
            
            if($('#claim_report').is(":checked"))
             {
                 var claim_report = "Yes";
             }
             else
             {
                 var claim_report = "No";
             }
             
             if($('#fir_copy').is(":checked"))
             {
                 var fir_copy = "Yes";
             }
             else
             {
                 var fir_copy = "No";
             }
            
             if($('#surveyor_report').is(":checked"))
             {
                 var surveyor_report = "Yes";
             }
             else
             {
                 var surveyor_report = "No";
             }
            
           // var add_spot_video = $("#add_spot_video").prop('files')[0];
            var add_pro_status = $("#add_pro_status").val();
    
            var check = 0;
            
            if(add_re_date == "")
            {
                    Swal.fire(
                      'Select Claim Receipt Date ?',
                      'That thing is still around?',
                      'question'
                    )
                    check = 1;
            }
            // else if(add_estimated_loss == "")
            // {
            //      Swal.fire(
            //           'Enter Estimated Loss ?',
            //           'That thing is still around?',
            //           'question'
            //         )
            //         check = 1;
            // }
            else if(add_date_of_loss == "")
            {
                 Swal.fire(
                      'Enter Date Of Loss?',
                      'That thing is still around?',
                      'question'
                    )
                    check = 1;
            }
            // else if(drv_license == "")
            // {
            //      Swal.fire(
            //           'Select Driving Licence ?',
            //           'That thing is still around?',
            //           'question'
            //         )
            //         check = 1;
            // }
            
            // else if(spot_img == "")
            // {
            //      Swal.fire(
            //           'Select Spot Photos ?',
            //           'That thing is still around?',
            //           'question'
            //         )
            //         check = 1;
            // }
            
            else if(add_pro_status == "")
            {
                 Swal.fire(
                      'Select Claim Processing Status ?',
                      'That thing is still around?',
                      'question'
                    )
                    check = 1;
            }
            else if(check != 1)
            {
                 var formdata = new FormData();
                var inputs = $('input[type="file"]');
                inputs.each(function(index){
                   alert($(this).prop("name", "newFileName"+index+"[]"));
                   
                   formdata.append('files[]',$(this).prop("gallert"));
                   
                   alert($(this).prop("name"));
                   
                   
                });

                formdata.append('lead_id',lead_id);
                formdata.append('client_id',client_id);
                formdata.append('client_name',add_client_name);
                formdata.append('policy_no',add_policy_no);
                formdata.append('re_date',add_re_date);
                formdata.append('estimated_loss',add_estimated_loss);
                formdata.append('date_of_loss',add_date_of_loss);
                formdata.append('agency_pos',add_agency_pos);
                formdata.append('select_areaincharge',select_areaincharge);
                formdata.append('assign_to_user',assign_to_user);
                formdata.append('mobile_no',mobile_no);
                formdata.append('add_address',add_address);
                //formdata.append('rc_book',add_rc_book);
                //formdata.append('driving_license',add_driving_license);
               // formdata.append('spot_video',add_spot_video);
                formdata.append('pro_status',add_pro_status);
                formdata.append('reference_no',reference_no);
                formdata.append('claim_report',claim_report);
                formdata.append('fir_copy',fir_copy);
                formdata.append('surveyor_report',surveyor_report);
                formdata.append('v_regn_no',v_regn_no);
                formdata.append("aadher_number",aadher_number);
                formdata.append("gst_number",gst_number);
                formdata.append("make_model",make_model);
                formdata.append("claim_id",claim_id);
                formdata.append("remarks",remarks);
                
                
                 $.ajax({
                        url : "add_claim_details",
                        method : "POST",
                        data:formdata,
                        processData:false,  
                        contentType:false,
                        cache:false,
                        dataType:'text',
                        beforeSend:function(){
                            $("#submit_btn").attr("disabled",true);
                        },
                        success:function(response)
                        {
                            $("#submit_btn").attr("disabled",false);
                            Swal.fire({
                              position: 'top-end',
                              icon: 'success',
                              title: 'New Claim Added Successfully',
                              showConfirmButton: false,
                              timer: 1500
                            })
                            $(".form-control").val("");
                            $("#add_agency_pos").select2("val", "");
                        }
             });
            }
          });
          
          
          
          
          
      $("#document_file").change(function(){
            upload_documents();
       });
       
        $("#document_type").change(function(){
            upload_documents();
       });
          
         
      });
      
      
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
                url:"upload_claim_document_files",
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
    
    function fetch_claim_motor()
    {
       $("#v_regn_no_div").removeClass("hidden");
       $("#aadher_number_div").addClass("hidden");
       $("#gst_number_div").addClass("hidden");
       $("#make_model_div").removeClass("hidden");
       
    }
    
    function fetch_claim_health()
    {
        $("#v_regn_no_div").addClass("hidden");
        $("#aadher_number_div").removeClass("hidden");
        $("#gst_number_div").addClass("hidden");
        $("#make_model_div").addClass("hidden");
    }
    
    
    function fetch_claim_sme()
    {
        $("#v_regn_no_div").addClass("hidden");
        $("#aadher_number_div").addClass("hidden");
        $("#gst_number_div").removeClass("hidden");
        $("#make_model_div").addClass("hidden");
    }
    

  
  </script>
  
  
  
  