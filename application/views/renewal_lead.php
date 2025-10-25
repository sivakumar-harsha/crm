<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
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

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <form name="allocate_leads_user" id="allocate_leads_user" action="<?=base_url('Renewalcontrol/store')?>" method="post" data-parsley-validate="">              
        <section class="content-header">
            <div class="row">
                <div class="col-md-3">
                     <h4>&nbsp;&nbsp;Renewal Leads</h4>
                 </div>                 
                <div class="col-md-2">
                    <select class="form-control" id="month" name='month' onchange="fetch_renewallead()">
                      <option value = "">All</option>
                      <?php foreach($monthlist as $month_key => $month_name)  { ?>
                      <option value = "<?php echo $month_key ?>"><?php echo $month_name ?></option>
                      <?php } ?>
                    </select>
                 </div>
                 
                <?php if($swap):?>
                    <div class="col-md-2">
                        
                        <select class="form-control select2" name="user_id" id="user_id" style="width:100%" required data-parsley-errors-container="#name_error">
                          <option value = "">--Select--</option>
                          <?php foreach($userslist as $user_id => $user_name)  { ?>
                          <option value = "<?php echo $user_id ?>"><?php echo $user_name ?></option>
                          <?php } ?>
                        </select>
                        <span id="name_error"></span>
                     </div>
    
                    <div class="col-md-4">
                        <?php if(isset($permission) && $permission->lead_renewals_action == "1") { ?>
                        <button type="submit" class="btn btn-sm btn-primary" id="submit">Assign</button>
                        <!--<button type="button" class="btn btn-primary btn-sm" onclick="change_data(1)" id='report_btn'><i class="fa fa-file-pdf-o" aria-hidden="true"></i> &nbsp;Assign Lead into User</button>-->
                        <?php } ?>
                     </div>
                <?php endif;?>      
                
                <div class="col-md-3 pull-right">
                  <button type="button" class="btn btn-danger btn-sm pull-right" style='margin-top: -8px;' id="export_btn" onclick="export_excel()"><i class="fa fa-file-excel-o"></i> Export Excel</button>
                 </div>
            </div>
            
          <!--<h1 style="font-size: 17px;">-->
          <!-- Renewal Leads-->
          <!--  <button type="button" class="btn btn-danger btn-sm pull-right" style='margin-top: -8px;' id="export_btn" onclick="export_excel()"><i class="fa fa-file-excel-o"></i> Export Excel</button>-->
    
           
          <!--</h1>-->
        </section>
    
        <!-- Main content -->
        <section class="content">
    
          <!-- Default box -->
          <div class="box">
            <div class="box-body">
              <div id="table_view"></div>
            </div><!-- /.box-body -->        
          </div><!-- /.box -->
    
        </section><!-- /.content -->
    </form>
  </div><!-- /.content-wrapper -->


<div id="view_modal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header" style="background-color:#33b781;color:#fff;">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"></h4>
        </div>
        <div class="modal-body">
            
          <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                  <li class="active"><a href="#v_tab_1" data-toggle="tab" aria-expanded="true" style="background-color:#3c8dbc;color:#fff;padding: 8px;border-color: #fff;">Personal Info</a></li>
                  <li class=""><a href="#v_tab_2" data-toggle="tab" aria-expanded="false" style="background-color:#3c8dbc;color:#fff;padding: 8px;border-color: #fff;"><span id="second_tab">vehicle Informations</span></a></li>
                  <li><a href="#v_tab_3" data-toggle="tab" style="background-color:#3c8dbc;color:#fff;padding: 8px;border-color: #fff;">Policy Info</a></li>
                </ul>
                <div class="tab-content">
                    
                      <div class="tab-pane active" id="v_tab_1">
                          <div class="row">
                              <div class="col-md-6">
                                  <div class="form-group">
                                      <div class="row">   
                                        <div class="col-md-4">
                                              <label>Client Name</label><span></span>
                                        </div>
                                        <div class="col-md-8">
                                              <p name="client_name" id="client_name"></p>
                                        </div>
                                      </div>
                                  </div>
                                  
                                  <div class="form-group">
                                      <div class="row">   
                                        <div class="col-md-4">
                                              <label>Mobile No</label><span></span>
                                        </div>
                                        <div class="col-md-8">
                                              <p name="mobile_no" id="mobile_no"></p>
                                        </div>
                                      </div>
                                  </div>
                            
                              <div class="form-group">
                                  <div class="row">   
                                    <div class="col-md-4">
                                          <label>Landline no</label>
                                    </div>
                                    <div class="col-md-8">
                                        <p  name="landline_no" id="landline_no"></p>
                                    </div>
                                  </div>
                              </div>
                                  
                                  <div class="form-group">
                                          <div class="row">   
                                            <div class="col-md-4">
                                                  <label>Address</label>
                                            </div>
                                            <div class="col-md-8">
                                                <p name="address" id="address" rows="2"></p>
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
                                                <p  name="email_id" id="email_id"></p>
                                            </div>
                                      </div>
                                  </div>
                                  
                                  <div class="form-group">
                                    <div class="row">   
                                        <div class="col-md-4">
                                            <label>Date of Birth</label>
                                        </div>
                                          <div class="col-md-8">
                                              <p name="dob" id="dob"></p>
                                          </div>
                                      </div>
                                  </div>
                                  
                                  <div class="form-group">
                                      <div class="row">   
                                        <div class="col-md-4">
                                            <label>Age</label>
                                        </div>
                                          <div class="col-md-8">
                                              <p name="age" id="age"></p>
                                          </div>
                                      </div>
                                  </div>
                                  
                                  <div class="form-group">
                                      <div class="row">   
                                        <div class="col-md-4">
                                              <label>Area</label>
                                        </div>
                                          <div class="col-md-8">
                                              <p name="area" id="area"></p>
                                          </div>
                                      </div>
                                  </div>
                                
                              </div>
                              
                          </div>
                      </div>
                      
                      <div class="tab-pane" id="v_tab_2">
                          <div id="v_info"></div>
                          <div id="v_docs"></div>
                      </div>
                      
                      <div class="tab-pane" id="v_tab_3">
                              <div id="policy_info"></div>
                              <div id="policy_docs"></div>
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

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/guillaumepotier/Parsley.js@2.9.2/src/parsley.css">
  <script type="text/javascript" src="https://cdn.jsdelivr.net/gh/guillaumepotier/Parsley.js@2.9.2/dist/parsley.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <script>
    $(document).ready(function(){
    //   fetch_renewallead();

        $('.select2').select2();

      $('#allocate_leads_user').on('submit', function(e){
          e.preventDefault();
          if( $(this).parsley().isValid() ){
              var $form = $(e.target);
               
               $.ajax({
                   url: $form.attr('action'),
                   type: "POST",
                   data: $form.serialize(),
                   dataType: "json",
                   success: function(response){
                       console.log(response);
                       console.log(typeof(response));
                       if(response.status == true){
                          setTimeout(function() {
                          swal({
                            title: "Success",
                            text: response.msg,
                            icon: "success",
                            Button: "Done"
                          })
                          .then((ok) => {
                            if(response.redirect_url)
                              window.location = response.redirect_url
                          });
                        }, 500);
                 } else if(response.status == "false") {
                     swal("Unable to updated objects");
                 }
                   }
               });
          }
      });

    });
    function fetch_renewallead()
    {
        var month = $('#month').val();
      var content = "";
      content += "<div class='table-responsive'>";
      content += "<table id='table_id' class='table table-hover table-bordered'>"; 
      //content += "<thead><th>S.No</th><th>Name</th><th>Lead ID</th><th>ph.no</th><th>businesstype</th><th>policytype</th><th>class</th><th>due date</th><th>Policy Start Date</th><th>Policy Issue Date</th><th>Action</th><thead>";
      content += "<thead><th><input type='checkbox' id='selall' name='selall' onclick='selectAll(this.checked)' ></th><th>S.No</th><th>Name</th><th>Lead ID</th><th>ph.no</th><th>businesstype</th><th>policytype</th><th>class</th><th>User</th><th>due date</th><th>Policy Start Date</th><th>Policy Issue Date</th><th>Action</th><thead>";
      content += "<tbody></tbody>";
      content += "</table>";
      content += "</div>";
      
      $("#table_view").html(content);

      $("#table_id").DataTable({
          "processing": true,
          "serverSide": false,
          "ordering": false,
          "pageLength": 25,
          "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
          "ajax":{
            //'url':'fetch_renewallead',
            'url':'fetch_renewallead?month='+month, 
          }
      });  
     
    }
    
    function selectAll(val) {
      if(val){
          $('.checkbox').each(function(){
              this.checked = true;
          });
      }else{
            $('.checkbox').each(function(){
              this.checked = false;
          });
      }
  }
   function export_excel()
   {
        $.ajax({
                     url : "fetch_renewal_export_excel",
                
                     beforeSend:function()
                     {
                         
                         $("#export_btn").attr("disabled",true);
                     },
                     success:function(response)
                     {
                         $("#export_btn").attr("disabled",false);
                         window.location.href=response;
                     }
          });
   }
   
    function view_data(id)
  {
        $.ajax({
                   url : "view_lead_details",
                   method : "POST",
                   data : {id:id},
                   success:function(response)
                   {
                       var obj = jQuery.parseJSON(response);
                       
                       $("#v_info").html("");
                       $("#v_docs").html("");
                       $("#policy_info").html("");  
                       $("#policy_docs").html("");  
                       
                        $(".modal-title").html(obj["p_info"].client_name + " - Customer Details");
                        $("#client_name").html(obj["p_info"].client_name);
                        $("#mobile_no").html(obj["p_info"].mobile_no);
                        $("#other_contact_details").html(obj["p_info"].other_contact_details);
                        $("#landline_no").html(obj["p_info"].landline_no);
                        $("#address").html(obj["p_info"].address);
                        $("#email_id").html(obj["p_info"].email);
                        $("#cont_person_name").html(obj["p_info"].contact_person_name);
                        $("#cont_person_des").html(obj["p_info"].contact_person_designation);
                        $("#dob").html(obj["p_info"].date_of_birth);
                        $("#age").html(obj["p_info"].age);
                        $("#area").html(obj["p_info"].area);
                        
                        if(obj["v_info"] != "")
                        {
                            var html = "";
                            html +='<div class="row">';
                            html +='<div class="col-md-6">';
                            html +='<div class="form-group">';
                            html +='<div class="row">';
                            html +='<div class="col-md-4">';
                            html +='<label>Make/Model/Varient</label>';
                            html +='</div>';
                            html +='<div class="col-md-8">';
                            html +='<p name="view_make_model" id="view_make_model" >'+obj["v_info"].brand_name+" /"+obj["v_info"].model_name+"/ "+obj["v_info"].varient_name+'</p>';
                            html +='</div>';
                            html +='</div>';
                            html +='</div>';
                            html +='<div class="form-group">';
                            html +='<div class="row">';
                            html +='<div class="col-md-4">';
                            html +='<label>Engine no</label>';
                            html +='</div>';
                            html +='<div class="col-md-8">';
                            html +='<p name="view_engine_no" id="view_engine_no" >'+obj["v_info"].vechi_engine_num+'</p>';
                            html +='</div>';
                            html +='</div>';
                            html +='</div>';
                            html +='</div>';
                            
                            html +='<div class="col-md-6">';
                            html +='<div class="form-group">';
                            html +='<div class="row">';
                            html +='<div class="col-md-4">';
                            html +='<label>Registration no</label>';
                            html +='</div>';
                            html +='<div class="col-md-8">';
                            html +='<p name="view_regn_no" id="view_regn_no" >'+obj["v_info"].vechi_register_no+'</p>';
                            html +='</div>';
                            html +='</div>';
                            html +='</div>';
                            
                            html +='<div class="form-group">';
                            html +='<div class="row">';
                            html +='<div class="col-md-4">';
                            html +='<label>Chassis No</label>';
                            html +='</div>';
                            html +='<div class="col-md-8">';
                            html +='<p name="view_chassis" id="view_chassis" >'+obj["v_info"].vechi_chassis_num+'</p>';
                            html +='</div>';
                            html +='</div>';
                            html +='</div>';
                            html +='</div>';
                            html +='</div>';
                            
                            $("#v_info").html(html);
                            $("#v_docs").html(obj["docs"]);
                        }
                        
                        if(obj["policy_info"] != "")
                        {
                            $("#policy_info").html(obj["policy_info"]);
                        }
                        
                        if(obj["policy_docs"] != "")
                        {
                          $("#policy_docs").html(obj["policy_docs"]);  
                        }
                        
                        if(obj["sme_quote"] != "")
                        {
                             $("#second_tab").html("");
                             $("#second_tab").html("Policy Quotes");
                             $("#v_info").html(obj["sme_quote"]);
                        }
                       
                       $("#view_modal").modal("toggle");
                   }
        });
  }
 
  </script>