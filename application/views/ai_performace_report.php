
<style>
    .modal-lg {
  width: 100%;
  height: 100%;
  margin: 0;
  padding: 0;
  z-index:10000000 !important;
}

.modal-lg-content {
  height: auto;
  width:auto;
  min-height: 100%;
  border-radius: 0;
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
.modal-open .modal {
    overflow-x: hidden !important;
    overflow-y: auto !important;
}

</style>

 <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        
    <div class = "row">
        <div class="form-group col-md-4">
          <h1 style="font-size: 17px;margin-top: 2px;">
            AI Performace Report
            </h1>
          </div> 
          
              <div class="form-group col-md-4">
                        <div class="input-group date">
                            <div class="input-group-addon">
                             <i class="fa fa-calendar"></i>
                        </div>
                        <input type="month" class="form-control pull-right" id="select_date" value="<?php echo date("Y-m") ?>">
                        </div>
                     </div>
                     
        <div class = "col-md-4">
                        <?php if($permission->ai_add== '1'){ ?>
                          <button data-toggle="modal" data-target="#add_model" class="btn btn-primary btn-sm pull-right">Add New</button>
                          <?php } ?>
                     </div>
    </div>
     
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
  </div><!-- /.content-wrapper -->
  
  
  <div class="modal fade in" id="add_model">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true" style="color:white;">×</span></button>
                <h4 class="modal-title text-center">AI Performances </h4>
            </div>
            <div class="modal-body">
            
                <div class="form-group">
                  <label>Area Incharge</label> 
                  <select class = "form-control select2" name = "area_incharge" id = "area_incharge" style = "width:100%">
                    
                      <?php if($this->session->userdata("session_role") == "AI"){ ?>
                        <option value = "<?php echo $this->session->userdata('session_id') ?>"><?php echo $this->session->userdata('session_name') ?></option>
                      <?php }else{ ?>
                      <option value = "">--Select--</option>
                      <?php foreach($area_incharge as $da) { ?>
                       <option value = "<?php echo $da->id ?>"><?php echo $da->name ?></option>
                      <?php } }?>
                  </select>
                </div>
          
                <div class = "row">
                    <div class="col-md-6">
                            <div class="form-group">
                              <label>Salary</label> 
                              <input type="text" class="form-control" id="salary" readonly>
                            </div>
                    </div>
                    
                 <div class="col-md-6">
                        <div class="form-group">
                          <label>Allowances</label> 
                          <input type="text" class="form-control" id="allowance" readonly>
                        </div>
                </div>
            </div>     
            
               <div class = "form-group">
                   <label>Month</label>
                  <input type = "month" name="add_month" id="add_month" class="form-control">
               </div>
               
                  <div class = "form-group">
                   <label>Target type</label>
                   <select class = "form-control" id="volume_type" name="volume_type">
                       <option value="">--Select--</option>
                       <option value = "Amount">Target Amount</option>
                       <option value = "Nop">Nop</option>
                   </select>
               </div>
               
            
               
            <div class = "row">
                
               <div class = "form-group col-md-6">
                    <label>Class</label>
                    <select class = "form-control" name = "class" id= "class">
                        <option value = "">--Select--</option>
                        <?php foreach($class as $da) { ?>
                           <option value = "<?php echo $da->id ?>"><?php echo $da->class ?></option>
                        <?php } ?>
                    </select>
                </div>
                
                <div class = "form-group col-md-6">
                    <label>Policy Type</label>
                    <select class = "form-control" name = "policy_type" id= "policy_type">
                        
                    </select>
                </div>
                
                <div class = "form-group col-md-4">
                  <label>0-10 Days</label>
                  <input type = "text" class="form-control" name="ten_days" id = "ten_days">
                </div>
                
                <div class = "form-group col-md-4">
                  <label>10-20 Days</label>
                  <input type = "text" class="form-control" name="twenty_days" id = "twenty_days">
                </div>
                
                <div class = "form-group col-md-4">
                  <label>20-30 Days</label>
                  <input type = "text" class="form-control" name="thirty_days" id = "thirty_days">
                </div>
                
                <input type="hidden" id="add_id">
                
           </div>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-default pull-left" id="close_mod" >Close</button>
                <button type="button" class="btn btn-sm btn-primary" id="add_btn">Submit</button>
            </div>
        </div>
    </div>
  </div>
  
  
   <div class="modal fade in" id="view_model">
    <div class="modal-dialog modal-lg">
        <div class="modal-content modal-lg-content">
            <div class="modal-header bg-primary">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true" style="color:white;">×</span></button>
                <h4 class="modal-title text-center">AI Performances Details - <span id="ai_name"></span> &nbsp;(<span id="ai_phone"></span>)</h4>
            </div>
            <div class="modal-body">
                
                <div class = "form-group">
                    <label>Select Date</label>
                    <input type = "month" name= "s_date" id="s_date" class="form-control">
                </div>
                
                 <div id="view_data"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-default pull-right" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
  </div>
  
  <div class="modal fade in"id="edit_model">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true" style="color:white;">×</span></button>
                <h4 class="modal-title text-center">AI Performances </h4>
            </div>
            <div class="modal-body">
            
                <div class="form-group">
                  <label>Area Incharge</label> 
                  <select class = "form-control select2" name="edit_area_incharge" id = "edit_area_incharge" style = "width:100%">
                    
                      <?php if($this->session->userdata("session_role") == "AI"){ ?>
                        <option value = "<?php echo $this->session->userdata('session_id') ?>"><?php echo $this->session->userdata('session_name') ?></option>
                      <?php }else{ ?>
                      <option value = "">--Select--</option>
                      <?php foreach($area_incharge as $da) { ?>
                       <option value = "<?php echo $da->id ?>"><?php echo $da->name ?></option>
                      <?php } }?>
                  </select>
                </div>
          
                <div class = "row">
                    <div class="col-md-6">
                            <div class="form-group">
                              <label>Salary</label> 
                              <input type="text" class="form-control" id="edit_salary" readonly>
                            </div>
                    </div>
                    
                 <div class="col-md-6">
                        <div class="form-group">
                          <label>Allowances</label> 
                          <input type="text" class="form-control"id="edit_allowance" readonly>
                        </div>
                </div>
            </div>     
            
               <div class = "form-group">
                   <label>Month</label>
                  <input type="date" name="edit_month"  id="edit_month" class="form-control">
               </div>
               
                  <div class = "form-group">
                   <label>Target type</label>
                   <select class = "form-control" id="edit_volume_type" name="edit_volume_type">
                       <option value="">--Select--</option>
                       <option value = "Amount">Target Amount</option>
                       <option value = "Nop">Nop</option>
                   </select>
               </div>
            <div class = "row">
               <div class = "form-group col-md-6">
                    <label>Class</label>
                    <select class = "form-control" name = "edit_class" id= "edit_class">
                        <option value = "">--Select--</option>
                        <?php foreach($class as $da) { ?>
                           <option value = "<?php echo $da->id ?>"><?php echo $da->class ?></option>
                        <?php } ?>
                    </select>
                </div>
                
                <div class = "form-group col-md-6">
                    <label>Policy Type</label>
                    <select class="form-control" name ="edit_policy_type" id="edit_policy_type">
                        
                    </select>
                </div>
                
                <div class = "form-group col-md-4">
                  <label>0-10 Days</label>
                  <input type = "text" class="form-control" name="edit_ten_days" id = "edit_ten_days">
                </div>
                
                <div class = "form-group col-md-4">
                  <label>10-20 Days</label>
                  <input type = "text" class="form-control" name="edit_twenty_days" id = "edit_twenty_days">
                </div>
                
                <div class = "form-group col-md-4">
                  <label>20-30 Days</label>
                  <input type = "text" class="form-control" name="edit_thirty_days" id = "edit_thirty_days">
                </div>
                <input type="hidden"id="edit_id">
           </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-default pull-left">Close</button>
                <button type="button" class="btn btn-sm btn-primary"id="edit_btn">Submit</button>
            </div>
        </div>
    </div>
  </div>

  
  
  
  <script>
  
      var date = $("#select_date").val();
      var area_incharge_id = "";
      
      $(document).ready(function(){
         
         $('.select2').select2();
         
         fetch_ai_performance(date);
         
         $("#class").change(function(){
            var policy_class = $("#class").val();
           
            $.ajax({
                      url : "fetch_policy_type_by_class",
                      method : "POST",
                      data : {policy_class : policy_class},
                      success:function(response)
                      {
                          $("#policy_type").html(response);
                      }
            });
             
         });
         
          $("#edit_class").change(function(){
            var policy_class = $("#edit_class").val();
            $.ajax({
                      url : "fetch_policy_type_by_class",
                      method : "POST",
                      data : {policy_class : policy_class},
                      success:function(response)
                      {
                          $("#edit_policy_type").html(response);
                      }
            });
         });
         
         $("#area_incharge").change(function(){
            
                var area_incharge = $("#area_incharge").val();
                
                $.ajax({
                          url : "fetch_area_incharge_salary",
                          method : "POST",
                          data : {ai:area_incharge},
                          success:function(response)
                          {
                              var obj = jQuery.parseJSON(response);
                              $("#salary").val(obj.salary);
                              $("#allowance").val(obj.allowance);
                          }
                });
         });
         
         $("#add_btn").click(function(){
            
            var ai = $("#area_incharge").val();
            var month = $("#add_month").val();
            var policy_class = $("#class").val();
            var policy_type = $("#policy_type").val();
            var volume_type = $("#volume_type").val();
            var ten_days = $("#ten_days").val();
            var twenty_days = $("#twenty_days").val();
            var thirty_days = $("#thirty_days").val();
            var add_id = $("#add_id").val();
            
            if(ai == "")
            {
                snackbar_show("Select Area Incharge");
            }
            else if(month == "")
            {
                snackbar_show("Select Month");
            }
            else if(policy_class == "")
            {
                snackbar_show("Select Policy Class");
            }
            else if(policy_type == "")
            {
                snackbar_show("Select Policy Type");
            }
            else if(volume_type == "")
            {
               snackbar_show("Select Volume Type"); 
            }
            else if(ten_days == "")
            {
                 snackbar_show("Enter a Value 0-10 days");
            }
            else if(twenty_days == "")
            {
                 snackbar_show("Enter a Value 10-20 days");
            }
            else if(thirty_days == "")
            {
                 snackbar_show("Enter a Value 20-30 days");
            }
            else
            {
                 $.ajax({
                             url : "add_ai_performance",
                             method : "POST",
                             data : {ai:ai,month:month,policy_class:policy_class,volume_type:volume_type,policy_type:policy_type,ten_days:ten_days,twenty_days:twenty_days,thirty_days:thirty_days,add_id:add_id},
                             beforeSend:function(){
                                 $("#add_btn").attr("disabled",true);
                             },                            
                             success:function(response)
                             {
                                $("#add_btn").attr("disabled",false);
                                  snackbar_show("AI Performance Added Successfully..");
                                    $("#class").val("");
                                    $("#policy_type").val("");
                                    $("#ten_days").val("");
                                    $("#twenty_days").val("");
                                    $("#volume_type").val("");
                                    $("#thirty_days").val("");
                             },
                      });
            
            }
         });
         
         $("#select_date").change(function(){
            var date = $("#select_date").val();
             fetch_ai_performance(date);
         });
         
         $("#s_date").change(function(){
             var date = $("#s_date").val();
             change_view_data(area_incharge_id,date);
         });
         
         $("#close_mod").click(function(){
            $("#add_model").modal("toggle");
            $("#area_incharge").val("");
            $("#area_incharge").trigger("change");
            $("#salary").val("");
            $("#allowance").val("");
            $("#add_month").val("");                
            date = $("#select_date").val();
            fetch_ai_performance(date);
         });
         
         //
         
         $("#area_incharge").change(function(){
            fetch_performance_records();
         });
         
         $("#class").change(function(){
            fetch_performance_records();
         });
         
         $("#policy_type").change(function(){
            fetch_performance_records();
         });
         
         $("#add_month").change(function(){
            fetch_performance_records();
         });
         
          $("#edit_area_incharge").change(function(){
                var area_incharge = $("#edit_area_incharge").val();
                $.ajax({
                          url : "fetch_area_incharge_salary",
                          method : "POST",
                          data : {ai:area_incharge},
                          success:function(response)
                          {
                              var obj = jQuery.parseJSON(response);
                              $("#edit_salary").val(obj.salary);
                              $("#edit_allowance").val(obj.allowance);
                          }
                });
         });
         
         
         $("#edit_btn").click(function(){
            
            var ai = $("#edit_area_incharge").val();
            var month = $("#edit_month").val();
            var policy_class = $("#edit_class").val();
            var policy_type = $("#edit_policy_type").val();
            var volume_type = $("#edit_volume_type").val();
            var ten_days = $("#edit_ten_days").val();
            var twenty_days = $("#edit_twenty_days").val();
            var thirty_days = $("#edit_thirty_days").val();
            var id = $("#edit_id").val();
            
            if(ai == "")
            {
                snackbar_show("Select Area Incharge");
            }
            else if(month == "")
            {
                snackbar_show("Select Month");
            }
            else if(policy_class == "")
            {
                snackbar_show("Select Policy Class");
            }
            else if(policy_type == "")
            {
                snackbar_show("Select Policy Type");
            }
            else if(volume_type == "")
            {
               snackbar_show("Select Volume Type"); 
            }
            else if(ten_days == "")
            {
                 snackbar_show("Enter a Value 0-10 days");
            }
            else if(twenty_days == "")
            {
                 snackbar_show("Enter a Value 10-20 days");
            }
            else if(thirty_days == "")
            {
                 snackbar_show("Enter a Value 20-30 days");
            }
            else
            {
                 $.ajax({
                             url : "edit_ai_performance",
                             method : "POST",
                             data : {ai:ai,month:month,policy_class:policy_class,volume_type:volume_type,policy_type:policy_type,ten_days:ten_days,twenty_days:twenty_days,thirty_days:thirty_days,id:id},
                             beforeSend:function(){
                                 $("#edit_btn").attr("disabled",true);
                             },                            
                             success:function(response)
                             {
                                $("#edit_btn").attr("disabled",false);
                                  snackbar_show("AI Performance Updated Successfully..");
                                    $("#edit_area_incharge").val("");
                                    $("#edit_area_incharge").trigger("change");
                                    $("#edit_class").val("");
                                    $("#edit_policy_type").val("");
                                    $("#edit_ten_days").val("");
                                    $("#edit_twenty_days").val("");
                                    $("#edit_volume_type").val("");
                                    $("#edit_thirty_days").val("");
                                    $("#edit_model").modal("toggle");
                                    $("#view_model").modal("toggle");
                             },
                      });
            
            }
             
         });
         
      });
      
      
      function fetch_ai_performance(date)
      {
            var content = "";
            content += "<div class='table-responsive'>";
            content += "<table id='table_id' class='table table-hover table-bordered'>"; 
            content += "<thead><th>S.No</th><th>Area Incharge</th><th>Month</th><th>Action</th></thead>";
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
                'url':'fetch_ai_performance',
                method : 'POST',
                data : {date:date},
              }
            });      
      }
      
      function view_data(id)
      {
          var date = $("#select_date").val();
          
          area_incharge_id = id;
          
          $.ajax({
                     url : "fetch_performance_details",
                     method : "POST",
                     data : {id:id,date:date},
                     success:function(response)
                     {
                         var obj = jQuery.parseJSON(response);
                         $("#s_date").val(obj["date"]);
                         $("#view_data").html(obj["con"]);
                         $("#ai_name").html(obj["name"]);
                          $("#ai_phone").html(obj["phone"]);
                        $("#view_model").modal("toggle");
                     }
          });
      }
      
      function change_view_data(id,date)
      {
          $("#view_data").html("loading....");
          
           $.ajax({
                     url : "fetch_performance_details",
                     method : "POST",
                     data : {id:id,date:date},
                     success:function(response)
                     {
                         var obj = jQuery.parseJSON(response);
                         $("#s_date").val(obj["date"]);
                         $("#ai_name").html(obj["name"]);
                         
                         $("#ai_phone").html(obj["phone"]);
                         
                         $("#view_data").html(obj["con"]);
                     }
          });
      }
      
      function fetch_performance_records()
      {
            var policy_type = $("#policy_type").val();
            var class_type = $("#class").val();
            var area_incharge = $("#area_incharge").val();
            var month = $("#add_month").val();
            
            if(policy_type != "" && class_type != "" && area_incharge != "" && month != "")
            {
                $.ajax({
                          url : "fetch_performance_records",
                          method : "POST",
                          data : {policy_type:policy_type,class_type:class_type,area_incharge:area_incharge,month:month},
                          success:function(response)
                          {
                              var obj = jQuery.parseJSON(response);
                              $("#ten_days").val(obj.tendays);
                              $("#twenty_days").val(obj.twenty_days);
                              $("#thirty_days").val(obj.thirty_days);
                              $("#add_id").val(obj.id);
                          }
                });
            }
          
            
      }
      
      
      function edit_data(id)
      {
          $.ajax({
                          url : "fetch_edit_performance",
                          method : "POST",
                          data : {id:id},
                          success:function(response)
                          {
                            var obj = jQuery.parseJSON(response);
                            $("#edit_class").val(obj.class);
                            
                            $.ajax({
                                      url : "fetch_edit_policy_type_by_class",
                                      method : "POST",
                                      data : {policy_class:obj.class,policy_type:obj.policy_type},
                                      success:function(response)
                                      {
                                          $("#edit_policy_type").html(response);
                                      }
                              });
                              
                              $("#edit_area_incharge").val(obj.ai_id);
                              $("#edit_volume_type").val(obj.volume_type);
                              $("#edit_area_incharge").trigger("change");
                              $("#edit_month").val(obj.month);
                              $("#edit_ten_days").val(obj.tendays);
                              $("#edit_twenty_days").val(obj.twenty_days);
                              $("#edit_thirty_days").val(obj.thirty_days);
                              $("#edit_policy_type").val(obj.policy_type);
                              $("#edit_id").val(id);
                              $("#edit_model").modal("toggle");
                          }
                });
      }
      
      
  </script>