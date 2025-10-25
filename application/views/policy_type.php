 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1 style="font-size: 17px;">
        Policy Type
        <button data-toggle="modal" data-target="#add_model" class="btn btn-primary btn-sm pull-right hidden" id="add_mod">Add New</button>
      </h1>
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
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true" style="color:white;">×</span></button>
                <h4 class="modal-title text-center">Add Policy Type</h4>
            </div>
            <div class="modal-body">
                
                <div class="form-group">
                  <label>Class</label> <span id="add_policy_type_error" style="color: red;">*</span>
                  <select class="form-control" name="policy_class" id="policy_class">
                      <option value="">-- Select--</option>
                      <?php foreach($class as $da){?>
                       <option value="<?php echo $da->id ?>"><?php echo $da->class ?></option>
                      <?php } ?>
                  </select>
                </div>
                
                <div class="form-group">
                  <label>Policy Type</label> <span id="add_policy_type_error" style="color: red;">*</span>
                  <input type="text" class="form-control" id="add_policy_type">
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
                <h4 class="modal-title text-center">Edit Category</h4>
            </div>
            <div class="modal-body">
                
                <div class="form-group">
                  <label>Class</label> <span id="add_policy_type_error" style="color: red;">*</span>
                  <select class="form-control" name="edit_policy_class" id="edit_policy_class">
                      <option value="">-- Select--</option>
                      <?php foreach($class as $da){?>
                       <option value="<?php echo $da->id ?>"><?php echo $da->class ?></option>
                      <?php } ?>
                  </select>
                </div>
                
                <div class="form-group">
                  <label>Policy Type</label> <span id="edit_policy_type_error" style="color: red;">*</span>
                  <input type="text" class="form-control" id="edit_policy_type">
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
    $(document).ready(function(){
      fetch_client();
      check_permission();

      $("#add_btn").click(function(){

        var policy_type = $("#add_policy_type").val();
        
        var policy_class = $("#policy_class").val();

        $("#add_policy_type_error").html("*");
        
        var error_check = 0;

        if(policy_class === "")
        {
          snackbar_show("Add Policy Class");
          error_check = 1;
        }
        
        else if(policy_type === "")
        {
          snackbar_show("Add Policy Type");
          error_check = 1;
        }

        else if(error_check != 1)
        {
          $.ajax({
            url:"add_policy_type",
            data:{policy_class:policy_class,policy_type:policy_type},
            method:"POST",
            beforeSend:function(){
                $("#add_btn").attr("disabled",true);
            },
            success:function(response){
                // alert(response);
                fetch_client();
                $("#add_policy_type").val("");
                $("#policy_class").val("");
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

        var policy_type = $("#edit_policy_type").val();
        var policy_class = $("#edit_policy_class").val();
        var id = $("#edit_id").val();

        $("#edit_policy_type_error").html("*");

        var error_check = 0;
        
        if(policy_class === "")
        {
          snackbar_show("Select Policy Class");
          error_check = 1;
        }
      
        else if(policy_type === "")
        {
          snackbar_show("Enter Policy Type");
          error_check = 1;
        }

        if(error_check != 1)
        {
          $.ajax({
            url:"edit_policy_type",
            data:{policy_class:policy_class,policy_type:policy_type,id:id},
            method:"POST",
            beforeSend:function(){
                $("#edit_btn").attr("disabled",true);
            },
            success:function(response){
                // alert(response);
                fetch_client();
                $("#edit_policy_type").val("");
                $("#edit_btn").attr("disabled",false);
                $("#edit_model").modal("hide");
            },
            error: function(code) {   
                alert(code.statusText);
            },
          });
        }
      });

    });
    function fetch_client()
    {
      var content = "";
      content += "<div class='table-responsive'>";
      content += "<table id='table_id' class='table table-hover table-bordered'>"; 
      content += "<thead><th>S.No</th><th>Policy Class</th><th>Policy Type</th><th>Action</th></thead>";
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
            'url':'fetch_policy_type',
          }
      });      
    }
    function edit_data(id)
    {
      $.ajax({
        url:"fetch_edit_policy_type",
        data:{id:id},
        method:"POST",
        success:function(response){
          // alert(response);
          var obj = jQuery.parseJSON(response);
          $("#edit_policy_class").val(obj.policy_class);
          $("#edit_policy_type").val(obj.policy_type);
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