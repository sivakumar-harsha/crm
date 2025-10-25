<!-- Content Wrapper. Contains page content -->
<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1 style="font-size: 17px;">
        Active Policy Details
      </h1>
    </section>
    
    
    <style>
        table.dataTable thead th, table.dataTable thead td {
    padding: 10px 10px 4px !important;
    border-bottom: 1px solid #111 !important;
    font-weight: unset !important;
}
.modal-body {
    position: relative;
    padding: 4px;
    padding-left: 14px;
}
    </style>
    
    <section class="content">
      <div class="box">
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
            <li class="active" id="motor_li"><a href="#tab_1" data-toggle="tab" aria-expanded="true" onclick="fetch_generate_policy_motor()">Motor</a></li>
            <li class="" id="health_li"><a href="#tab_2" data-toggle="tab" aria-expanded="false" onclick="fetch_generate_policy_health()">Health</a></li>
             <li class="" id="sme_li"><a href="#tab_3" data-toggle="tab" aria-expanded="false" onclick="fetch_generate_policy_sme()">SME</a></li>
            </ul>
        </div>
    
        <div class="box-body">
          <div id="table_view"></div>
        </div><!-- /.box-body -->        
      </div><!-- /.box -->

    </section><!-- /.content -->
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




  <script>
    $(document).ready(function(){
               fetch_generate_policy_motor();
               $('a.toggle-vis').on( 'click', function (e) {
                e.preventDefault();
         
                // Get the column API object
                var column = table.column( $(this).attr('data-column') );
         
                // Toggle the visibility
                column.visible( ! column.visible() );
            });
    });
    
    function fetch_generate_policy_motor()
    {
      var content = "";
      content += "<div class='table-responsive'>";
      content += "<table id='table_id' class='table table-hover table-bordered'>"; 
      content += "<thead><th>S.No</th><th>Customer</th><th>Mobile</th><th>Code</th><th>P No</th><th>Insurer</th><th>OD</th><th>TP</th><th>Net</th><th>GST</th><th>B Type</th><th>Class</th><th>Pol Type</th><th>S Date</th><th>E Date</th><th>Cover</th><th>Action_record</th></thead>";
      content += "<tbody></tbody>";
      content += "</table>";
      content += "</div>";
      
      $("#table_view").html(content);

      var table = $("#table_id").DataTable({
          "processing": true,
          "serverSide": true,
          "ordering": false,
          "pageLength": 10,
          "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
          "ajax":{
            'type': 'POST',
            'url':'fetch_generate_policy',
          }
      });
     $('a.toggle-vis').on('click',function (e) {
        e.preventDefault();
        var column = table.column( $(this).attr('data-column') );
        column.visible( ! column.visible());
    });
    }
    
    function fetch_generate_policy_health()
    {
      var content = "";
      content += "<div class='table-responsive'>";
      content += "<table id='table_id' class='table table-hover table-bordered'>"; 
      content += "<thead><th>S.No</th><th>Customer</th><th>Mobile</th><th>Code</th><th>P No</th><th>Insurer</th><th>Net</th><th>GST</th><th>OC</th><th>AC</th><th>B Type</th><th>Class</th><th>Pol Type</th><th>S Date</th><th>E Date</th></thead>";
      content += "<tbody></tbody>";
      content += "</table>";
      content += "</div>";
      
      $("#table_view").html(content);

       var table = $("#table_id").DataTable({
          "processing": true,
          "serverSide": true,
          "ordering": false,
          "pageLength": 10,
          "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
          "ajax":{
            'type': 'POST',
            'url':'fetch_generate_policy_health',
          }
      });
    }
    
    
     function fetch_generate_policy_sme()
    {
      var content = "";
      content += "<div class='table-responsive'>";
      content += "<table id='table_id' class='table table-hover table-bordered'>"; 
      content += "<thead><th>S.No</th><th>Customer</th><th>Mobile</th><th>Code</th><th>P No</th><th>Insurer</th><th>Net</th><th>GST</th><th>OC</th><th>AC</th><th>AI_Incentive</th><th>Sub_Agent_1</th><th>Sub_Agent1_Com</th><th>Sub_Agent_2</th><th>Sub_Agent2_Com</th><th>B Type</th><th>Class</th><th>Pol Type</th><th>S Date</th><th>E Date</th></thead>";
      content += "<tbody></tbody>";
      content += "</table>";
      content += "</div>";
      
      $("#table_view").html(content);

       var table = $("#table_id").DataTable({
          "processing": true,
          "serverSide": true,
          "ordering": false,
          "pageLength": 10,
          "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
          "ajax":{
            'type': 'POST',
            'url':'fetch_generate_policy_sme',
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