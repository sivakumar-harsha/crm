<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1 style="font-size: 17px;">
        Pets Breed
        <button data-toggle="modal" data-target="#add_model" class="btn btn-primary btn-sm pull-right hidden" id="add_mod">Add Pet</button>
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
                <h4 class="modal-title text-center">Pets Breed</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                  <label>Pet Name</label> <span id="add_pet_error" style="color: red;">*</span>
                  <input type="text" class="form-control" id="add_pet">
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
                  <label>Pets Breed</label> <span id="edit_pet_error" style="color: red;">*</span>
                  <input type="text" class="form-control" id="edit_pet">
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
      fetch_pets_breed();
      
      check_permission();
        
      $("#add_btn").click(function(){

        var pet_name = $("#add_pet").val();
        $("#add_pet_error").html("*");

        if(pet_name === "")
        {
            snackbar_show("Enter pet Name");
        }
        else
        {
            var formdata = new FormData();
            formdata.append('pet_name',pet_name);
          $.ajax({
            url:"add_pets_breed",
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
                fetch_pets_breed();
                $("#add_pet").val("");
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

        var pet_name = $("#edit_pet").val();
        var id = $("#edit_id").val();
        $("#edit_pet_error").html("*");
        $("#edit_icon_error").html("*");

        if(pet_name === "")
        {
            snackbar_show("Enter Pet Name");
        }
        else
        {
            var formdata = new FormData();
            formdata.append('pet_name',pet_name);
            formdata.append('id',id);
          $.ajax({
            url:"edit_pets_breed",
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
                fetch_pets_breed();
                $("#edit_pet").val("");
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
    function fetch_pets_breed()
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
            'url':'fetch_pets_breed',
          }
      });      
    }
    function edit_data(id)
    {
      $.ajax({
        url:"fetch_edit_pets_breed",
        data:{id:id},
        method:"POST",
        success:function(response){
          // alert(response);
          var obj = jQuery.parseJSON(response);
          $("#edit_pet").val(obj.pet_name);
          $("#edit_heading").html("Edit "+obj.pet_name);
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