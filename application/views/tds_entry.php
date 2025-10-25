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
.btn {
    border-radius: 1px;
    -webkit-box-shadow: none;
    box-shadow: none;
    border: 1px solid transparent;
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

.content-header {
    position: relative;
    padding: 15px 15px 19px 15px !important;
}

.content {
    min-height: 250px;
    padding: -1px !important;
    margin-right: auto;
    margin-left: auto;
    padding-left: 15px;
    padding-right: 15px;
}

.content-header {
    position: relative;
   padding: 15px 15px 1px 15px !important;
}



    
    /*.select2-container--default .select2-selection--single {
      width: 540px !important;
      
    }*/
    
    /*.select2-container--default .select2-selection--single .select2-selection__rendered {
        line-height: 50px !important;
    }*/

</style>

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
                
                <div class = "col-md-2">
                    <div class= "form-group">
                         <button data-toggle="modal" data-target="#add_model" class="btn btn-primary btn-sm pull-right">Add TDS</button>
                    </div>
                </div>
                
        </div>
        
    </section>
    
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
                <h4 class="modal-title text-center">Add TDS</h4>
            </div>
            <div class="modal-body">
                
                 <div class="form-group">
                  <label>Insurer Company</label> <span id="insurer_company_error" style="color: red;">*</span>
                  <select type="text" class="form-control select2" id="insurer_company" style="width:100%">
                       <option value="0">All</option>
                      <?php foreach($insurer_company as $da){ ?>
                          <option value="<?php echo $da->id ?>"><?php echo $da->company_name ?></option>
                      <?php } ?>
                  </select>
                </div>
                
                
                 <div class="form-group">
                  <label> Class</label> <span id="policy_class_error" style="color: red;">*</span>
                  <select type="text" class="form-control select2" id="policy_class" style="width:100%">
                       <option value="0">All</option>
                      <?php foreach($class as $da){ ?>
                          <option value="<?php echo $da->id ?>"><?php echo $da->class ?></option>
                      <?php } ?>
                  </select>
                </div>
                
                 
                 <div class="form-group">
                  <label>Policy Type</label> <span id="policy_type_error" style="color: red;">*</span>
               <select class="form-control select2" name="policy_type" id="policy_type" style="width:100%">
                     <option value="0">All</option>
                 </select>
                </div>
                
              
               <div class="row">
                <div class="col-md-6">
                <div class="form-group">
                  <label> Jayantha TDS(%)</label> <span id="add_jayantha_tds_error" style="color: red;">*</span>
                  <input type="number" class="form-control" id="jayantha_tds">
                </div>
                </div>
                
                <div class="col-md-6">
                 <div class="form-group">
                  <label> Unicorn TDS(%)</label> <span id="add_unicorn_tds_error" style="color: red;">*</span>
                  <input type="number" class="form-control" id="unicorn_tds">
                </div>
                </div>
                </div>
               
                  <div class="row">
                <div class="col-md-6">
                <div class="form-group">
                  <label>From Date</label> <span id="add_from_error" style="color: red;">*</span>
                  <input type="date" class="form-control" id="add_fromdate">
                </div>
                </div>
             
                  <div class="col-md-6">
                 <div class="form-group">
                  <label>To Date</label> <span id="add_to_error" style="color: red;">*</span>
                  <input type="date" class="form-control" id="add_todate">
                </div>
                 </div>
                  </div>
             
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-sm btn-primary" id="add_btn">Submit</button>
            </div>
        </div>
    </div>
  </div>
  
  
  <div class="modal fade in" id="edit_model">
    <div class="modal-dialog">
        <div class="modal-content col-md-12">
            <div class="modal-header bg-primary">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true" style="color:white;">×</span></button>
                <h4 class="modal-title text-center">Edit TDS</h4>
            </div>
            <div class="modal-body">
                
                 <div class="form-group">
                  <label>Insurer Company</label> <span id="insurer_company_error" style="color: red;">*</span>
                  <select type="text" class="form-control select2" id="edit_insurer_company" style="width:100%">
                       <option value="0">All</option>
                      <?php foreach($insurer_company as $da){ ?>
                          <option value="<?php echo $da->id ?>"><?php echo $da->company_name ?></option>
                      <?php } ?>
                  </select>
                </div>
                
                
                 <div class="form-group">
                  <label> Class</label> <span id="edit_policy_class_error" style="color: red;">*</span>
                  <select type="text" class="form-control select2" id="edit_policy_class" style="width:100%">
                       <option value="0">All</option>
                      <?php foreach($class as $da){ ?>
                          <option value="<?php echo $da->id ?>"><?php echo $da->class ?></option>
                      <?php } ?>
                  </select>
                </div>
                
                 
                 <div class="form-group">
                  <label>Policy Type</label> <span id="edit_policy_type_error" style="color: red;">*</span>
                    <select class="form-control select2" name="edit_policy_type" id="edit_policy_type" style="width:100%">
                      <option value="0">All</option>
                    </select>
                </div>
                
              
               <div class="row">
                <div class="col-md-6">
                <div class="form-group">
                  <label> Jayantha TDS(%)</label> <span id="edit_jayantha_tds_error" style="color: red;">*</span>
                  <input type="number" class="form-control" id="edit_jayantha_tds">
                </div>
                </div>
                

                <div class="col-md-6">
                 <div class="form-group">
                  <label> Unicorn TDS(%)</label> <span id="add_unicorn_tds_error" style="color: red;">*</span>
                  <input type="number" class="form-control" id="edit_unicorn_tds">
                </div>
                </div>
                </div>
               
                  <div class="row">
                <div class="col-md-6">
                <div class="form-group">
                  <label>From Date</label> <span id="edit_from_error" style="color: red;">*</span>
                  <input type="date" class="form-control" id="edit_fromdate">
                </div>
                </div>
             
                  <div class="col-md-6">
                 <div class="form-group">
                  <label>To Date</label> <span id="edit_to_error" style="color: red;">*</span>
                  <input type="date" class="form-control" id="edit_todate">
                </div>
                 </div>
                  </div>
             
            </div>
            <div class="modal-footer" id="edit_id">
                <button type="button" class="btn btn-sm btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-sm btn-primary" id="edit_btn">Submit</button>
            </div>
        </div>
    </div>
  </div>
  
  
  <script>
      $(document).ready(function(){
          
          $('.select2').select2();
          
          fetch_tds_amount_list();
          
          
          $("#policy_class").change(function(){
              
             var policy_class = $("#policy_class").val();
           fetch_poilicy_class_list(policy_class) 
           
           });
           
           
         $("#edit_policy_class").change(function(){  
           var policy_class = $("#edit_policy_class").val();
           fetch_poilicy_class_list(policy_class) 
         });   
           
           
        $("#add_btn").click(function(){

        var insurer_company = $("#insurer_company").val();
        var policy_class = $("#policy_class").val();
        var policy_type = $("#policy_type").val();
        var jayantha_tds = $("#jayantha_tds").val();
        var unicorn_tds = $("#unicorn_tds").val();
        var fromdate = $("#add_fromdate").val();
        var todate  = $("#add_todate").val();
           
           var check =0;
           
           if(insurer_company == "")
           {
               check=1;
               snackbar_show("Select Insurer Company");
           }
           else if(policy_class == "")
           {
               check=1;
               snackbar_show("Select Class");
           }
           else if(policy_type == "")
           {
               check=1;
               snackbar_show("Select Policy Type");
           }
           else if(jayantha_tds == "")
           {
               
              check=1;
              snackbar_show("Enter Jayantha TDS")
           }
           else if(unicorn_tds == "")
           {
               check=1;
               snackber_show("Enter Unicorn TDS");
           }
           else if(fromdate == "")
           {
               check=1;
               snackber_show("Select From Date");
           }
           else if(todate == "")
           {
               check=1;
               snackber-show("Select To Date");
           }
           if(check != 1)
           {
               $.ajax({
                   url : "add_tds_amount",
                   method : "POST",
                   data:{
                          insurer_company:insurer_company,
                          policy_class:policy_class,
                          policy_type:policy_type,
                          jayantha_tds:jayantha_tds,
                          unicorn_tds:unicorn_tds,
                          fromdate:fromdate,
                          todate:todate
                   },
                   beforeSend:function(){
                       $("#add_btn").attr("disabled",true);
                   },
                   success:function(response)
                   {
                       $("#insurer_company").val("");
                       $("#policy_class").val("");
                       $("#policy_type").val("");
                       $("#jayantha_tds").val("");
                       $("#unicorn_tds").val("");
                       $("#fromdate").val("");
                       $("#todate").val("");
                       $("#add_btn").attr("disabled",false);
                       $("#add_model").modal("toggle");
                       fetch_tds_amount_list();
                   }
               });
           }
             
         }); 
         
         
         
          $("#edit_btn").click(function(){
        
        var id = $("#edit_id").val();
        var insurer_company = $("#edit_insurer_company").val();
        var policy_class = $("#edit_policy_class").val();
        var policy_type = $("#edit_policy_type").val();
        var jayantha_tds = $("#edit_jayantha_tds").val();
        var unicorn_tds = $("#edit_unicorn_tds").val();
        var fromdate = $("#edit_fromdate").val();
        var todate  = $("#edit_todate").val();
           
           var check =0;
           
           if(insurer_company == "")
           {
               check=1;
               snackbar_show("Select Insurer Company");
           }
           else if(policy_class == "")
           {
               check=1;
               snackbar_show("Select Class");
           }
           else if(policy_type == "")
           {
               check=1;
               snackbar_show("Select Policy Type");
           }
           else if(jayantha_tds == "")
           {
               
              check=1;
              snackbar_show("Enter Jayantha TDS")
           }
           else if(unicorn_tds == "")
           {
               check=1;
               snackber_show("Enter Unicorn TDS");
           }
           else if(fromdate == "")
           {
               check=1;
               snackber_show("Select From Date");
           }
           else if(todate == "")
           {
               check=1;
               snackber-show("Select To Date");
           }
           if(check != 1)
           {
               $.ajax({
                   url : "edit_tds_amount",
                   method : "POST",
                   data:{
                          insurer_company:insurer_company,
                          policy_class:policy_class,
                          policy_type:policy_type,
                          jayantha_tds:jayantha_tds,
                          unicorn_tds:unicorn_tds,
                          fromdate:fromdate,
                          todate:todate,
                          id:id
                   },
                   beforeSend:function(){
                       $("#add_btn").attr("disabled",true);
                   },
                   success:function(response)
                   {
                       $("#insurer_company").val("");
                       $("#policy_class").val("");
                       $("#policy_type").val("");
                       $("#jayantha_tds").val("");
                       $("#unicorn_tds").val("");
                       $("#fromdate").val("");
                       $("#todate").val("");
                       $("#edit_btn").attr("disabled",false);
                       $("#edit_model").modal("toggle");
                       fetch_tds_amount_list();
                   }
               });
           }
             
         });  
           
        
      });
      
      
         $("#search_btn").click(function(){
             
                   s_f_date = $("#s_f_date").val();
                   s_to_date = $("#s_to_date").val();
                   fetch_tds_amount_list(s_f_date,s_to_date);
        
         });
      
      
      function fetch_tds_amount_list(f_date,to_date)
    {
      var content = "";
      content += "<div class='table-responsive'>";
      content += "<table id='table_id' class='table table-hover table-bordered'>"; 
      content += "<thead><th>S.No</th><th>Insurer Company</th><th>Class</th><th>Plicy Type</th><th>Jayantha TDS</th><th>Unicorn TDS</th><th>From Date</th><th>To Date</th><th>Action</th></thead>";
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
            'url':'fetch_tds_amount_list',
             'method' : "POST",
             'data' : {f_date:f_date,to_date:to_date},
          }
      });      
    }
      
      
      
      function fetch_poilicy_class_list(policy_class)
      {
          
            $.ajax({
                  url :"fetch_poilicy_class_list",
                  method : "POST",
                  data : {policy_class:policy_class},
                  success:function(response)
                  {
                      $("#policy_type").html(response);
                      $("#edit_policy_type").html(response);
                      
                  }
           
           })
          
          
      }
      
      
      function edit_data(id)
     {
      $.ajax({
        url:"fetch_edit_tds_amount",
        data:{id:id},
        method:"POST",
        success:function(response){
          // alert(response);
          var obj = jQuery.parseJSON(response);
          $("#edit_insurer_company").val(obj.insurer_company);
          $("#edit_policy_class").val(obj.policy_class);
          $("#edit_policy_class").trigger("change");
          $("#edit_policy_type").val(obj.policy_type);
          $("#edit_jayantha_tds").val(obj.jayantha_tds);
          $("#edit_unicorn_tds").val(obj.unicorn_tds);
          $("#edit_fromdate").val(obj.fromdate);
          $("#edit_todate").val(obj.todate);
          $("#edit_model").modal("show");
          $("#edit_id").val(id);
          
         
        },
        error: function(code) {   
            alert(code.statusText);
        },
      });
      
    }
      
      
  </script>