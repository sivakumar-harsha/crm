  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1 style="font-size: 17px;">
        PCV Seating
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
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true" style="color:white;">×</span></button>
                <h4 class="modal-title text-center">PCV SEATING</h4>
            </div>
            <div class="modal-body">
                
                
                <div class="form-group">
                  <label>Select policy Type</label> <span id="add_seating_error" style="color: red;">*</span>
                  <select class="form-control select2" style="width:100%;height:100%;" id="add_policy_type">
                      <option value="">--Select--</option>
                      <?php foreach($policy_type as $da){ ?>
                         <option value="<?php echo $da->id ?>"><?php echo $da->policy_type ?></option>
                      <?php } ?>
                  </select>
                </div>
                
                <div class="form-group">
                  <label>Seating</label> <span id="add_seating_error" style="color: red;">*</span>
                  <input type="text" class="form-control" id="add_seating">
                </div>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-sm btn-primary" id="add_btn">Submit</button>
            </div>
        </div>
    </div>
  </div>

  <script>
    $(document).ready(function(){
        
      fetch_seating();

      $("#add_btn").click(function(){
        
        var policy_type = $("#add_policy_type").val();
        var seating = $("#add_seating").val();

        $("#add_seating_error").html("*");

        var error_check = 0;
        
        if(policy_type === "")
        {
            snackbar_show("Select Policy Type");
        }
        else if(seating === "")
        {
          snackbar_show("Enter Seating Capactity");
        }
        else
        {
          $.ajax({
            url:"add_pcv_seating",
            data:{policy_type:policy_type,seating:seating},
            method:"POST",
            beforeSend:function(){
                $("#add_btn").attr("disabled",true);
            },
            success:function(response){
                fetch_seating();
                $("#add_seating").val("");
                 $("#add_policy_type").val("");
                $("#add_btn").attr("disabled",false);
                $("#add_model").modal("hide");
            },
            error: function(code) {   
                alert(code.statusText);
            },
          });
        }
      });

    });
    
    function fetch_seating()
    {
      var content = "";
      content += "<div class='table-responsive'>";
      content += "<table id='table_id' class='table table-hover table-bordered'>"; 
      content += "<thead><th>S.No</th><th>Policy Type</th><th>Seating</th><th>Action</th></thead>";
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
            'url':'fetch_pcv_seating',
          }
      });      
    }
   

   
  </script>