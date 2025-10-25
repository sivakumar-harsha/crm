  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
   
    
    <style>
        .form-group {
    margin-bottom: 2px;
        }
    
   .nav-tabs-custom {
    margin-bottom: 6px !important;
    background: #fff;
    box-shadow: 0 1px 1px rgb(0 0 0 / 10%);
    border-radius: 3px;
}

.nav-tabs-custom>.nav-tabs {
    margin: 0;
    border-bottom-color: #f4f4f4;
    border-top-right-radius: 3px;
    border-top-left-radius: 3px;
    height: 44px !important;
}

.nav>li>a {
    position: relative;
    display: block;
}

.content {
    min-height: 250px;
    padding: 5px !important;
    margin-right: auto;
    margin-left: auto;
    padding-left: 15px;
    padding-right: 15px;
}

table.dataTable thead th, table.dataTable thead td {
    padding: 10px 18px;
    border-bottom: 1px solid #111;
    font-weight:unset !important;
}

label {
    display: inline-block;
    max-width: 100%;
    margin-bottom: 5px;
    font-weight: unset !important;
}


    </style>

    <!-- Main content -->
  <section class="content">
    <div class="nav-tabs-custom">
		<ul class="nav nav-tabs bg-info">
		  <?php if($permission->cust_view == "1") { ?>
		  <li class="active" id="customer_tab"><a href="#tab_content" data-toggle="tab" aria-expanded="false" onclick="fetch_customers('2','1')">Customers</a></li>
		  <?php } ?>
		  <?php if($permission->renewals_view == "1") { ?>
		  
		  <li class="" id="renewals_tab"><a href="#tab_content" data-toggle="tab" aria-expanded="false" onclick="fetch_renewals('2','7 days')">Renewals</a></li>
		  
		  <?php } ?>
		  
		  <li class="pull-right" id="class_tab">
		       <select class="form-control" name="filter_category" id="filter_category">
                <option value="1">Motor</option>
                <option value="2">Health</option>
                <option value="3">Travel</option>
            </select>
		  </li>
		  
		  <li class="pull-right" id="date_tab">
		       <select class="form-control" name="date_category" id="date_category">
                <option value="Overdue">Overdue</option>
                <option value="7 days" selected>7 days</option>
                <option value="8-15 days">8-15 days</option>
                <option value="16-30 days">16-30 days</option>
                <option value="31-45 days">31-45 days</option>
            </select>
		  </li>

		</ul>
	</div>

      <!-- Default box -->
      <div class="box">
        <div class="box-body">
          <div id="table_view"></div>
        </div><!-- /.box-body -->        
      </div><!-- /.box -->

    </section><!-- /.content -->
  </div><!-- /.content-wrapper -->
  
  
  <!-- Modal -->
<div id="view_modal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"></h4>
      </div>
      <div class="modal-body">
          
          <h4 style="color:red"><u>Personal Information</u></h4>
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
            
            
            <div id="v_info"></div>
            <div id="v_docs"></div>
            
            <div id="policy_info"></div>
            
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
  
<script>  
 
 var lead_type = 2;
 var class_type = 1;
 
 var due_date = "7 days";

 $(document).ready(function(){
     
     fetch_customers(lead_type,class_type);
     
      $("#date_tab").addClass("hidden");
      $("#class_tab").removeClass("hidden");

      $("#filter_category").change(function(){
          filter_category = $("#filter_category").val();
          if($('#customer_tab').hasClass('active'))
          {
               fetch_customers(2,filter_category);
          }
      });
      
      $("#date_category").change(function(){
           due_date = $("#date_category").val();
          fetch_renewals(2,due_date);
      });
  });
  
 
   function fetch_customers(lead_type,class_type)
    {
      $("#date_tab").addClass("hidden");
      $("#class_tab").removeClass("hidden");
     
      var content = "";
      content += "<div class='table-responsive'>";
      content += "<table id='table_id' class='table table-hover table-bordered'>"; 
      content += "<thead><th>S.No</th><th>Cus Name</th><th>Mobile No</th><th>Class</th><th>Policy Type</th><th>Policy No</th><th>Policy Premium</th><th>Policy Exp Date</th><th>Action</th></thead>";
      content += "<tbody></tbody>";
      content += "</table>";
      content += "</div>";
      
      $("#table_view").html(content);

      $("#table_id").DataTable({
		        "processing": true,
		        "serverSide": true,
		        "ordering": false,
		        "pageLength": 25,
		        "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
		        "ajax":{
		            'type': 'POST',
		            'url':'fetch_customers',
		            'data':{
	                	lead_type: lead_type,
	                	class_type:class_type,
	                
	                },
	              // 'success': function(response) {
                // Check the response from the server and alert it
               // alert("Response: " + JSON.stringify(response));
           // },
		        }
       });
    }
    
    
    function renewal(id)
    {
        window.location.href="renewal?id="+id+"&status='renewal'";
    }
    
    function fetch_renewals(lead_type,due_date)
    {
     $("#date_tab").removeClass("hidden");
     $("#class_tab").addClass("hidden");
      
      var content = "";
      content += "<div class='table-responsive'>";
      content += "<table id='table_id' class='table table-hover table-bordered'>"; 
      content += "<thead><th>S.No</th><th>Cus Name</th><th>Mobile No</th><th>Class</th><th>Policy Type</th><th>Policy No</th><th>Policy Premium</th><th>Policy Exp Date</th><th>Action</th></thead>";
      content += "<tbody></tbody>";
      content += "</table>";
      content += "</div>";
      
      $("#table_view").html(content);

      $("#table_id").DataTable({
		        "processing": true,
		        "serverSide": true,
		        "ordering": false,
		        "pageLength": 25,
		        "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
		        "ajax":{
		            'type': 'POST',
		            'url':'fetch_renewals',
		            'data':{
	                	lead_type: lead_type,
	                	due_date:due_date,
	                
	                },
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
                       
                        $(".modal-title").html(obj["p_info"].client_name + " - Lead Details");
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
                            var html ='<h4 style="color:red"><u>vechicle Information</u></h4>';
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
                       
                       $("#view_modal").modal("toggle");
                   }
        });
    }
    
    </script>