 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1 style="font-size: 17px;">
        Payout grid
        <button data-toggle="modal" data-target="#add_model" class="btn btn-primary btn-sm pull-right">Add New</button>
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
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true" style="color:white;">×</span></button>
                <h4 class="modal-title text-center">Payout grid</h4>
            </div>
            <div class="modal-body">
        
            <div class="row">
                <div class="col-md-6">
                        <div class="form-group">
                            <label>Select Class</label>
                              <select class="form-control" name="add_class" id="add_class">
                                <option value="">--Select--</option>
                                 <?php foreach($class as $da) { if($da->id == "1" || $da->id == "2")
                                 {?>
                                  <option value="<?php echo $da->id ?>"><?php echo $da->class ?></option>
                                <?php } } ?>
                             </select>
                        </div>
                </div>
                
                <div class="col-md-6">
                    <div class="form-group">
                         <label>Policy Type</label>
                            <select class="form-control" name="add_policy_type" id="add_policy_type">
                                <option value="">--Select--</option>
                                <?php foreach($policy_type as $da) { ?>
                                  <option value="<?php echo $da->id ?>"><?php echo $da->policy_type ?></option>
                                <?php } ?>
                           </select>
                    </div>
                </div>
                </div>
                
                <div class="row">
                   <div class="col-md-12">
                    <div class="form-group">
                        <label>RTO Regions</label>
                        <select class="form-control" name="add_rto_reigions" id="add_rto_reigions">
                            <option value="">--Select--</option>
                            <option value="Andrapradesh">Andrapradesh</option>
                            <option value="Hyderabad">Hyderabad</option>
                            <option value="Telangana">Telangana</option>
                            <option value="Bangalore">Bangalore</option>
                            <option value="Karnataka">Karnataka</option>
                            <option value="Chennai">Chennai</option>
                            <option value="Coimbatore">Coimbatore</option>
                            <option value="Tamilnadu">Tamilnadu</option>
                        </select>
                    </div>
                </div>
                </div>
            
                <div class="row">
                    <div class="col-md-12">
                    <div class="form-group">
                        <label>Commission Percentage</label>
                         <input type="number" id="add_c_percentage" id="add_c_percentage" class="form-control">
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
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true" style="color:white;">×</span></button>
                <h4 class="modal-title text-center">Payout grid</h4>
            </div>
            <div class="modal-body">
        
            <div class="row">
                <div class="col-md-6">
                        <div class="form-group">
                            <label>Select Class</label>
                              <select class="form-control" name="edit_class" id="edit_class">
                                <option value="">--Select--</option>
                                 <?php foreach($class as $da) { if($da->id == "1" || $da->id == "2")
                                 {?>
                                  <option value="<?php echo $da->id ?>"><?php echo $da->class ?></option>
                                <?php } } ?>
                             </select>
                        </div>
                </div>
                
                <div class="col-md-6">
                    <div class="form-group">
                         <label>Policy Type</label>
                            <select class="form-control" name="edit_policy_type" id="edit_policy_type">
                                <option value="">--Select--</option>
                                <?php foreach($policy_type as $da) { ?>
                                  <option value="<?php echo $da->id ?>"><?php echo $da->policy_type ?></option>
                                <?php } ?>
                           </select>
                    </div>
                </div>
                </div>
                
                <input type="hidden" id="edit_id">
                
                <div class="row">
                   <div class="col-md-12">
                    <div class="form-group">
                        <label>RTO Regions</label>
                        <select class="form-control" name="edit_rto_reigions" id="edit_rto_reigions">
                            <option value="">--Select--</option>
                            <option value="Andrapradesh">Andrapradesh</option>
                            <option value="Hyderabad">Hyderabad</option>
                            <option value="Hyderabad">Telangana</option>
                            <option value="Bangalore">Bangalore</option>
                            <option value="Karnataka">Karnataka</option>
                            <option value="Chennai">Chennai</option>
                            <option value="Coimbatore">Coimbatore</option>
                            <option value="Tamilnadu">Tamilnadu</option>
                        </select>
                    </div>
                </div>
            </div>
            
                <div class="row">
                    <div class="col-md-12">
                    <div class="form-group">
                        <label>Commission Percentage</label>
                         <input type="number" id="edit_c_percentage" id="edit_c_percentage" class="form-control">
                    </div>
                </div>
          </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-sm btn-primary" id="edit_btn">Submit</button>
            </div>
        </div>
    </div>
  </div>

  <script>
    $(document).ready(function(){
        
       fetch_payout_grid();

      $("#add_btn").click(function(){

        var ins_class = $("#add_class").val();
        var policy_type = $("#add_policy_type").val();
        var rto_reigions = $("#add_rto_reigions").val();
        var c_percentage = $("#add_c_percentage").val();

        $("#add_name_error").html("*");

        var error_check = 0;

        if(ins_class === "")
        {
          snackbar_show("Select Insurer Class");
          error_check = 1;
        }
        else if(policy_type == "")
        {
            snackbar_show("Select Policy Type");
             error_check = 1;
        }
        else if(rto_reigions == "")
        {
            snackbar_show("Select Rto Reigions");
             error_check = 1;
        }
        else if(c_percentage == "")
        {
            snackbar_show("Select Commission Percentage");
             error_check = 1;
        }
        if(error_check != 1)
        {
          $.ajax({
            url:"add_payout_grid",
            data:{ins_class:ins_class,policy_type:policy_type,rto_reigions:rto_reigions,c_percentage:c_percentage},
            method:"POST",
            beforeSend:function(){
                $("#add_btn").attr("disabled",true);
            },
            success:function(response){
                // alert(response);
                fetch_payout_grid();
                $("#add_name").val("");
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
        var id = $("#edit_id").val();  
        var ins_class = $("#edit_class").val();
        var policy_type = $("#edit_policy_type").val();
        var rto_reigions = $("#edit_rto_reigions").val();
        var c_percentage = $("#edit_c_percentage").val();

        $("#edit_name_error").html("*");

        var error_check = 0;

        if(ins_class === "")
        {
          snackbar_show("Select Insurer Class");
          error_check = 1;
        }
        else if(policy_type == "")
        {
            snackbar_show("Select Policy Type");
             error_check = 1;
        }
        else if(rto_reigions == "")
        {
            snackbar_show("Select Rto Reigions");
             error_check = 1;
        }
        else if(c_percentage == "")
        {
            snackbar_show("Select Commission Percentage");
             error_check = 1;
        }
        if(error_check != 1)
        {
          $.ajax({
            url:"edit_payout_grid",
            data:{id:id,ins_class:ins_class,policy_type:policy_type,rto_reigions:rto_reigions,c_percentage:c_percentage},
            method:"POST",
            beforeSend:function(){
                $("#edit_btn").attr("disabled",true);
            },
            success:function(response){
                fetch_payout_grid();
                $("#edit_class").val("");
				$("#edit_policy_type").val("");
				$("#edit_rto_reigions").val("");
				$("#edit_c_percentage").val("");
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
    function fetch_payout_grid()
    {
      var content = "";
      content += "<div class='table-responsive'>";
      content += "<table id='table_id' class='table table-hover table-bordered'>"; 
      content += "<thead><th>S.No</th><th>Class</th><th>Policy Type</th><th>Rto Reigions</th><th>Commission(%)</th><th>Action</th></thead>";
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
            'url':'fetch_payout_grid',
          }
      });      
    }
    function edit_data(id)
    {
      $.ajax({
        url:"fetch_edit_payout_grid",
        data:{id:id},
        method:"POST",
        success:function(response){
          var obj = jQuery.parseJSON(response);
          $("#edit_class").val(obj.class);
          $("#edit_policy_type").val(obj.policy_type);
          $("#edit_rto_reigions").val(obj.rto_reigions);
          $("#edit_c_percentage").val(obj.commission);
          $("#edit_model").modal("show");
          $("#edit_id").val(id);
        },
        error: function(code) {   
            alert(code.statusText);
        },
      });
      
    }

    function delete_data(id)
    {
      if(confirm("Are you Confirm to Delete"))
      {
        $.ajax({
          url:"delete_category",
          data:{id:id},
          method:"POST",
          success:function(response){
            fetch_payout_grid();
          },
          error: function(code) {   
            alert(code.statusText);
          },
        });
      }
    }
  </script>