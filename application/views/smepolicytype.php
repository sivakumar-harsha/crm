<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1 style="font-size: 17px;">
        SME POLICY
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
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true" style="color:white;">×</span></button>
                <h4 class="modal-title text-center">SME Policy Type</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                  <label>Policy Name</label> <span id="add_policy_error" style="color: red;">*</span>
                  <input type="text" class="form-control" id="add_smepolicy">
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
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true" style="color:white;">×</span></button>
                <h4 class="modal-title text-center">SME Policy Type</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                  <label>Policy Name</label> <span id="edit_policy_error" style="color: red;">*</span>
                  <input type="text" class="form-control" id="edit_smepolicy">
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
      fetch_policy();

      $("#add_btn").click(function(){

        var smepolicy = $("#add_smepolicy").val();

        $("#add_policy_error").html("*");

        var error_check = 0;

        if(smepolicy === "")
        {
          $("#add_policy_error").html("* Required");
          error_check = 1;
        }

        if(error_check != 1)
        {
          $.ajax({
            url:"add_policy",
            data:{smepolicy:smepolicy},
            method:"POST",
            beforeSend:function(){
                $("#add_btn").attr("disabled",true);
            },
            success:function(response){
                // alert(response);
                fetch_policy();
                $("#add_smepolicy").val("");
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

        var smepolicy = $("#edit_smepolicy").val();
        var id = $("#edit_id").val();

        $("#edit_name_error").html("*");

        var error_check = 0;

        if(smepolicy === "")
        {
          $("#edit_policy_error").html("* Required");
          error_check = 1;
        }

        if(error_check != 1)
        {
          $.ajax({
            url:"edit_sempolicy",
            data:{smepolicy:smepolicy,id:id},
            method:"POST",
            beforeSend:function(){
                $("#edit_btn").attr("disabled",true);
            },
            success:function(response){
                // alert(response);
                fetch_policy();
                $("#edit_smepolicy").val("");
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
   function fetch_policy()
    {
      var content = "";
      content += "<div class='table-responsive'>";
      content += "<table id='table_id' class='table table-hover table-bordered'>"; 
      content += "<thead><th>S.No</th><th>Name</th><th>Action</th></thead>";
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
            'url':'fetch_policy',
          }
      });      
    }
    
    function edit_data(id)
    {
      $.ajax({
        url:"fetch_edit_smepolicy",
        data:{id:id},
        method:"POST",
        success:function(response){
          // alert(response);
          var obj = jQuery.parseJSON(response);
          $("#edit_smepolicy").val(obj.smepolicy);
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
          url:"delete_policy",
          data:{id:id},
          method:"POST",
          success:function(response){
            //alert(response);
            fetch_policy();
          },
          error: function(code) {   
            alert(code.statusText);
          },
        });
      }
    }
  </script>
