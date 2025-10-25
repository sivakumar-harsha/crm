<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
        <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
    <!-- Content Header (Page header) -->
    <section class="content-header">
        
          <div class="row">
            <div class="col-md-3">
                  <h1 style="font-size: 17px;margin-top:0px;">
                         Passengers carrying Vehicle Brand
                  </h1>
            </div>
            <div class="col-md-4">
                <select class="form-control select2" name="select_p_type" id="select_p_type">
                    <?php foreach($policy_type as $da){ ?>
                     <option value="<?php echo $da->id ?>"><?php echo $da->policy_type ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="col-md-5">
                <button data-toggle="modal" data-target="#add_model" class="btn btn-primary btn-sm pull-right" id="add_mod">Add New</button>
            </div>
        </div>
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

    </style>

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
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true" style="color:white;">×</span></button>
                <h4 class="modal-title text-center">Passengers carrying Vehicle Brand</h4>
            </div>
            <div class="modal-body">
            
            
              <div class="form-group">
                  <label>Select policy Type</label> <span id="add_name_error" style="color: red;">*</span>
                  <select class="form-control select2" multiple style="width:100%;height:100%;" id="add_policy_type">
                      <option value="">--Select--</option>
                      <?php foreach($policy_type as $da){ ?>
                         <option value="<?php echo $da->id ?>"><?php echo $da->policy_type ?></option>
                      <?php } ?>
                  </select>
                </div>
                
            <div class="form-group">
                  <label>Brand Name</label> <span id="add_name_error" style="color: red;">*</span>
                  <input type="text" class="form-control" id="add_name">
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
                  <label>Name</label> <span id="edit_name_error" style="color: red;">*</span>
                  <input type="text" class="form-control" id="edit_name">
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
  
  var policy_type = $("#select_p_type").val();
  
    $(document).ready(function(){
      fetch_brand(policy_type);
      
         $('.select2').select2();
         
         check_permission();
        
      $("#add_btn").click(function(){

        var name = $("#add_name").val();
        var policy_type = $("#add_policy_type").val();
        
        $("#add_name_error").html("*");
        
        if(policy_type == "")
        {
            snackbar_show("Select Policy Type");
        }
        else if(name === "")
        {
            snackbar_show("Enter Brand Name");
        }
        else
        {
            var formdata = new FormData();
            formdata.append('name',name);
            formdata.append('policy_type',policy_type);
          $.ajax({
            url:"add_pc_brand",
            data:formdata,
            processData:false,  
		    contentType:false,
		    cache:false,
		    dataType:'text',
            type:"POST",
            beforeSend:function(){
                $("#add_btn").attr("disabled",true);
            },
            success:function(response){
                // alert(response);
                fetch_brand(policy_type);
                $("#add_name").val("");
                $("#add_policy_type").val("");
                $("#add_policy_type").trigger("change");
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
        var id = $("#edit_id").val();
        $("#edit_name_error").html("*");
        $("#edit_icon_error").html("*");

        if(name === "")
        {
            snackbar_show("Enter Brand Name");
        }
        else
        {
            var formdata = new FormData();
            formdata.append('name',name);
            formdata.append('id',id);
          $.ajax({
            url:"edit_pc_brand",
            data:formdata,
            processData:false,  
		    contentType:false,
		    cache:false,
		    dataType:'text',
            method:"POST",
            beforeSend:function(){
                $("#edit_btn").attr("disabled",true);
            },
            success:function(response){
                // alert(response);
                fetch_brand(policy_type);
                $("#edit_name").val("");
                $("#edit_icon").val(null);
                $("#edit_icon_view").attr("src","");
                $("#edit_btn").attr("disabled",false);
                $("#edit_model").modal("hide");
            },
            error: function(code) {   
                alert(code.statusText);
            },
          });
        }
      });
      
      $("#select_p_type").change(function(){
          policy_type = $("#select_p_type").val();
          fetch_brand(policy_type);
      });

    });
    function fetch_brand(policy_type)
    {
      var content = "";
      content += "<div class='table-responsive'>";
      content += "<table id='table_id' class='table table-hover table-bordered'>"; 
      content += "<thead><th>S.No</th><th>Policy Type</th><th>Name</th><th>Action</th></thead>";
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
            'url':'fetch_pc_brand',
             'method' : "POST",
             'data' : {policy_type:policy_type},
          }
      });      
    }
    function edit_data(id)
    {
      $.ajax({
        url:"fetch_edit_pc_brand",
        data:{id:id},
        method:"POST",
        success:function(response){
          // alert(response);
          var obj = jQuery.parseJSON(response);
          $("#edit_name").val(obj.brand_name);
          $("#edit_heading").html("Edit "+obj.brand_name);
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
  </script>
