
  <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        
        <div class="row">
            <div class="col-md-3">
                  <h1 style="font-size: 17px;margin-top:0px;">
                         Passengers Carrying Vehicle Model
                  </h1>
            </div>
            <div class="col-md-2">
                <select class="form-control select2" name="select_p_type" id="select_p_type">
                    <option value=''>--Select Policy Type--</option>
                    <?php foreach($policy_type as $da){ ?>
                     <option value="<?php echo $da->id ?>"><?php echo $da->policy_type ?></option>
                    <?php } ?>
                </select>
            </div>
             <div class="col-md-2">
                <select class="form-control select2" name="select_pc_brand" id="select_pc_brand">
                </select>
            </div>
            <div class="col-md-5">
                <button data-toggle="modal" data-target="#add_model" class="btn btn-primary btn-sm pull-right" id="add_mod">Add New</button>
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
    <div class="modal-dialog  modal-sm">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true" style="color:white;">×</span></button>
                <h4 class="modal-title text-center">Create Passengers Carrying Vehicle Model</h4>
            </div>
            <div class="modal-body">
                
                
                 <div class="form-group">
                  <label>Select policy Type</label> <span id="add_name_error" style="color: red;">*</span>
                  <select class="form-control select2" style="width:100%;height:100%;" id="add_policy_type">
                      <option value="">--Select--</option>
                      <?php foreach($policy_type as $da){ ?>
                         <option value="<?php echo $da->id ?>"><?php echo $da->policy_type ?></option>
                      <?php } ?>
                  </select>
                </div>
                
                <div class="form-group">
                  <label>Brand</label> <span id="add_branch_error" style="color: red;">*</span>
                  <div class='row'>
                    <div class="col-sm-8">
                  <select class="form-control" id="add_brand">
                  </select>
                  </div>
                  <div class="col-sm-4">
                  </div>
                  </div>
                </div>
                <div class="form-group">
                  <label>Model Name</label> <span id="add_name_error" style="color: red;">*</span>
                  <div class='row'>
                    <div class="col-sm-8">
                        <div id="model_add_div">
                            <input type="text" style="margin:5px;" class="form-control" id="add_name">
                        </div>
                        <div id="model_add_div1">
                            
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <button id="sub_file_btn" class="btn btn-info btn-sm pull-right"> - </button>
                        <button id="add_file_btn" class="btn btn-info btn-sm pull-right" style="margin-right:5px;"> + </button>
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
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true" style="color:white;">×</span></button>
                <h4 class="modal-title text-center" id="edit_heading"></h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                  <label>Brand</label> <span id="edit_name_error" style="color: red;">*</span>
                  <div class='row'>
                    <div class="col-sm-8">
                      <select class="form-control" id="edit_brand">
                          <option value = ""> Select Brand </option>
                          <?php foreach($brand as $b) { ?>
                          <option value="<?php echo $b->id ?>"> <?php echo $b->brand_name ?> </option>
                          <?php } ?>
                      </select>
                  </div>
                  <div class="col-sm-4">
                  </div>
                  </div>
                </div>
                <div class="form-group">
                  <label>Model Name</label> <span id="edit_name_error" style="color: red;">*</span>
                  <div class='row'>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="edit_name">
                    </div>
                  </div>
                </div>
            </div>
            <div class="modal-footer">
                <input type="hidden" id="edit_id">
                <button type="button" class="btn btn-sm btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-sm btn-primary" id="edit_btn">Submit</button>
            </div>
        </div>
    </div>
  </div> 
  
  

  <script>
  
  var s_policy_type = $("#select_p_type").val();
    var s_pc_brand = $("#select_pc_brand").val();
    
    $(document).ready(function(){
        
         $('.select2').select2();
         
      fetch_model();
      check_permission();
      
      $('#add_file_btn').click(function(){
          var add = '';
          add += '<input type="text" style="margin:5px;" class="form-control add_model">';
           $("#model_add_div1").append(add);
      });
      $('#sub_file_btn').click(function(){
			  $('#model_add_div1').children().last().remove();
	   });
      $("#add_btn").click(function(){

        var name = $("#add_name").val();
        var brand = $("#add_brand").val();
        var policy_type = $("#add_policy_type").val();
        
        $("#add_name_error").html("*");
        
        if(policy_type == "")
        {
            snackbar_show("Select Policy Type");
        }
        else if(brand === "")
        {
          snackbar_show("Select Brand");
        }
        else if(name === "")
        {
          snackbar_show("Enter Model Name");
        }
        else
        {
           var name1 = [];
            $(".add_model").each(function() {
                if( this.value != "")
                {
                    name1.push(this.value);
                }
            });
          $.ajax({
            url:"add_pc_model",
            data:{
                policy_type : policy_type,
                name:name,
                brand:brand,
                name1:name1,
            },
            method:"POST",
            beforeSend:function(){
                $("#add_btn").attr("disabled",true);
            },
            success:function(response){
                // alert(response);
                fetch_model();
                $("#add_name").val("");
                $("#add_brand").val("");
                $("#add_policy_type").val("");
                $('#model_add_div1').children().remove();
                $("#add_btn").attr("disabled",false);
                $("#add_model").modal("hide");
            },
            error: function(code) {   
                alert(code.statusText);
            },
          });
        }
      });

      $("#edit_btn").click(function(){

        var name = $("#edit_name").val();
        var brand = $("#edit_brand").val();
        var id = $("#edit_id").val();

        $("#edit_name_error").html("*");
        
        if(brand === "")
        {
            snackbar_show("Select Brand");
        }
        else if(name === "")
        {
            snackbar_show("Enter Model Name");
        }
        else
        {
          $.ajax({
            url:"edit_pc_model",
            data:{name:name,id:id,brand:brand},
            method:"POST",
            beforeSend:function(){
                $("#edit_btn").attr("disabled",true);
            },
            success:function(response){
                // alert(response);
                fetch_model();
                $("#edit_name").val("");
                $("#edit_brand").val("");
                $("#edit_btn").attr("disabled",false);
                $("#edit_model").modal("hide");
            },
            error: function(code) {   
                alert(code.statusText);
            },
          });
        }
      });
      
      
       $("#add_policy_type").change(function(){
          
          var policy_type = $("#add_policy_type").val();
          
          $.ajax({
                   url : "fetch_brand_by_policy_id_pcv",
                   method : "POST",
                   data : {policy_type : policy_type},
                   success:function(response)
                   {
                       $("#add_brand").html(response);
                   }
          });
      });
      
      
       $("#select_p_type").change(function(){
         var p_type = $("#select_p_type").val();
         var s_pc_brand = $("#select_pc_brand").val();
         fetch_pc_brand(p_type);
         fetch_model(p_type,s_pc_brand);
      });
      
      $("#select_pc_brand").change(function(){
         var p_type = $("#select_p_type").val();
         var s_pc_brand = $("#select_pc_brand").val();
         fetch_model(p_type,s_pc_brand);
      });



    });
    function fetch_model(p_type,s_pc_brand)
    {
      var content = "";
      content += "<div class='table-responsive'>";
      content += "<table id='table_id' class='table table-hover table-bordered'>"; 
      content += "<thead><th>S.No</th><th>Policy Type</th><th>Brand</th><th>Model</th><th>Action</th></thead>";
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
            'url':'fetch_pc_model',
            'method' : "POST",
            'data' : {policy_type:p_type,s_pc_brand:s_pc_brand},
          }
      });      
    }
    
      function edit_data(id)
      {
          $.ajax({
            url:"fetch_edit_pc_model",
            data:{id:id},
            method:"POST",
            success:function(response){
              // alert(response);
              var obj = jQuery.parseJSON(response);
              $("#edit_name").val(obj.model_name);
              $("#edit_heading").html("Edit "+obj.model_name);
              $("#edit_brand").val(obj.brand_id);
              $('#edit_brand').trigger('change');
              $("#edit_model").modal("show");
              $("#edit_id").val(id);
            },
            error: function(code) {   
                alert(code.statusText);
            },
          });
          
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
                  }
                  else
                  {
                      $("#add_mod").addClass("hidden");
                  }
              }
          });
      }
      
      function fetch_pc_brand(policy_type)
      {
          $.ajax({
                   url : "fetch_brand_by_policy_id_pcv",
                   method : "POST",
                   data : {policy_type : policy_type},
                   success:function(response)
                   {
                       $("#select_pc_brand").html(response);
                       $("#select_pc_brand").trigger("change");
                   }
          });
      }

  </script>