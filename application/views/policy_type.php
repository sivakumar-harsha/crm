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

                <!-- Fuel Type dropdown (hidden by default) -->
                <div class="form-group" id="fuel_type_container" style="display:none;">
                  <label>Fuel Type</label>
                  <select class="form-control" id="fuel_type_dropdown">
                      <option value="">-- Select Fuel Type --</option>
                  </select>
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

                <div class="form-group" id="edit_fuel_type_container" style="display:none;">
                  <label>Fuel Type</label>
                  <select class="form-control" id="edit_fuel_type_dropdown" name="edit_fuel_type">
                    <option value="">-- Select Fuel Type --</option>
                    <?php foreach($fuel_types as $fuel) { ?>
                      <option value="<?php echo $fuel->id; ?>"><?php echo $fuel->fuel_type; ?></option>
                    <?php } ?>
                  </select>
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

         // ✅ define safely — check if dropdown exists or visible
          var fuel_type = $("#fuel_type_dropdown").length && $("#fuel_type_container").is(":visible")
              ? $("#fuel_type_dropdown").val()
              : "";

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
            data:{policy_class:policy_class,policy_type:policy_type,fuel_type: fuel_type },
            method:"POST",
            beforeSend:function(){
                $("#add_btn").attr("disabled",true);
            },
            success:function(response){
                // alert(response);
                fetch_client();
                $("#add_policy_type").val("");
                $("#policy_class").val("");
                $("#fuel_type_dropdown").val("");
                $("#fuel_type_container").hide();
                $("#add_btn").attr("disabled", false);
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

        var fuel_type = $("#edit_fuel_type_dropdown").is(":visible")
          ? $("#edit_fuel_type_dropdown").val()
          : "";

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
            data:{policy_class:policy_class,policy_type:policy_type,fuel_type: fuel_type,id:id},
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


      // When Policy Class changes
      $("#policy_class").change(function() {
          var selectedClass = $("#policy_class option:selected").text().trim();

          if (selectedClass.toLowerCase() === "motor") {
              // Show fuel type container
              $("#fuel_type_container").show();

              // Fetch fuel types via AJAX
              $.ajax({
                  url: "fetch_car_fuel_types",
                  method: "GET",
                  dataType: "json",
                  success: function(response) {
                      var options = '<option value="">-- Select Fuel Type --</option>';
                      $.each(response, function(index, item) {
                          options += `<option value="${item.id}">${item.fuel_type}</option>`;
                      });
                      $("#fuel_type_dropdown").html(options);
                  },
                  error: function(xhr) {
                      console.error("Error loading fuel types:", xhr.statusText);
                  }
              });
          } else {
              // Hide dropdown for other classes
              $("#fuel_type_container").hide();
              $("#fuel_type_dropdown").html('<option value="">-- Select Fuel Type --</option>');
          }
      });


    });
    function fetch_client()
    {
      var content = "";
      content += "<div class='table-responsive'>";
      content += "<table id='table_id' class='table table-hover table-bordered'>"; 
      content += "<thead><th>S.No</th><th>Policy Class</th><th>Policy Type</th><th>Fuel Type</th><th>Action</th></thead>";
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

            // ✅ Show fuel type dropdown only if class is 'Motor'
            if (obj.class_name && obj.class_name.toLowerCase() === "motor") {
              $("#edit_fuel_type_container").show();
              $("#edit_fuel_type_dropdown").val(obj.fuel_type_id);
            } else {
              $("#edit_fuel_type_container").hide();
              $("#edit_fuel_type_dropdown").val("");
            }
            
            $("#edit_model").modal("show");

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