<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1 style="font-size: 17px;">
        Premium Cover Type
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
                <h4 class="modal-title text-center">Create Premium Cover Type</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                  <label>Type Name</label> <span id="add_name_error" style="color: red;">*</span>
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
    $(document).ready(function(){
      fetch_pct();
      check_permission();
        
      $("#add_btn").click(function(){

        var name = $("#add_name").val();
        $("#add_name_error").html("*");

        if(name === "")
        {
            snackbar_show("Enter Brand Name");
        }
        else
        {
            var formdata = new FormData();
            formdata.append('name',name);
          $.ajax({
            url:"add_premium_cover_type",
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
                fetch_pct();
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
            url:"edit_premium_cover_type",
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
                fetch_pct();
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

    });
    function fetch_pct()
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
          "pageLength": 10,
          "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
          "ajax":{
            'url':'fetch_premium_cover_type',
          }
      });      
    }
    function edit_data(id)
    {
      $.ajax({
        url:"fetch_edit_premium_cover_type",
        data:{id:id},
        method:"POST",
        success:function(response){
          // alert(response);
          var obj = jQuery.parseJSON(response);
          $("#edit_name").val(obj.name);
          $("#edit_heading").html("Edit "+obj.name);
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