 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <section class="content-header">
      <h1 style="font-size: 17px;">
        Motor Category
        <button data-toggle="modal" data-target="#add_model" class="btn btn-primary btn-sm pull-right hidden" id="add_mod">Add</button>
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
                <h4 class="modal-title text-center">Motor Category</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                  <label>Motor Category</label> <span id="add_motor_category_error" style="color: red;">*</span>
                  <input type="text" class="form-control" id="add_motor_category">
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
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true" style="color:white;">×</span></button>
                <h4 class="modal-title text-center">Edit Motor Category</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                  <label>Motor Category</label> <span id="edit_name_error" style="color: red;">*</span>
                  <input type="text" class="form-control" id="edit_motor_category">
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
      fetch_motor_category();
      check_permission();
      
      $("#add_btn").click(function(){

        var motor_category = $("#add_motor_category").val();

        var error_check = 0;

        if(motor_category === "")
        {
          error_check = 1;
                      Swal.fire(
              'Select Motor Category ?',
              'That thing is still around?',
              'question'
            )
        }

        if(error_check != 1)
        {
          $.ajax({
            url:"add_motor_category",
            data:{motor_category:motor_category},
            method:"POST",
            beforeSend:function(){
                $("#add_btn").attr("disabled",true);
            },
            success:function(response){
                $("#add_motor_category").val("");
                $("#add_btn").attr("disabled",false);
                $("#add_model").modal("hide");
                fetch_motor_category();
            },
            error: function(code) {   
                alert(code.statusText);
            },
          });
        }
      });
      $("#edit_btn").click(function(){

        var motor_category = $("#edit_motor_category").val();
        var id = $("#edit_id").val();

        $("#edit_name_error").html("*");

        var error_check = 0;

        if(motor_category === "")
        {
                     Swal.fire(
              'Enter Motor Category ?',
              'That thing is still around?',
              'question'
            )
          error_check = 1;
        }
        if(error_check != 1)
        {
          $.ajax({
            url:"edit_motor_category",
            data:{motor_category:motor_category,id:id},
            method:"POST",
            beforeSend:function(){
                $("#edit_btn").attr("disabled",true);
            },
            success:function(response){
                fetch_motor_category();
                $("#edit_motor_category").val("");
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
    
    
    function fetch_motor_category()
    {
      var content = "";
      content += "<div class='table-responsive'>";
      content += "<table id='table_id' class='table table-hover table-bordered'>"; 
      content += "<thead><th>S.No</th><th>Motor Category</th><th>Action</th></thead>";
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
            'url':'fetch_motor_category',
          }
      });      
    }
    
    function edit_data(id)
    {
      $.ajax({
        url:"fetch_edit_motor_category",
        data:{id:id},
        method:"POST",
        success:function(response){
          var obj = jQuery.parseJSON(response);
          $("#edit_motor_category").val(obj.motor_category);
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

