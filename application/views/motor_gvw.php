 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <section class="content-header">
      <h1 style="font-size: 17px;">
        Motor Products
        <button data-toggle="modal" data-target="#add_model" class="btn btn-primary btn-sm pull-right hidden" id="add_mod">Add</button>
      </h1>
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
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true" style="color:white;">×</span></button>
                <h4 class="modal-title text-center">Add Motor Products</h4>
            </div>
            <div class="modal-body">
                
                <div class="form-group">
                  <label>Motor Category</label> <span id="add_motor_category_error" style="color: red;">*</span>
                  <select class="form-control select2" name="add_motor_category" id="add_motor_category" multiple style="width:100%">
                      <option value="">--Select--</option>
                      <?php foreach($policy_type as $da){?>
                       <option value="<?php echo $da->id ?>"><?php echo $da->policy_type ?></option>
                      <?php } ?>
                  </select>
                </div>
                
                <div class="form-group">
                  <label>FROM</label> <span id="add_motor_gvw_error" style="color: red;">*</span>
                  <input type="text" class="form-control" id="add_fr_gvw">
                </div>
                
                 <div class="form-group">
                  <label>To</label> <span id="add_motor_gvw_error" style="color: red;">*</span>
                  <input type="text" class="form-control" id="add_to_gvw">
                </div>
                
                 <div class="form-group">
                  <label>GVW/Cc</label> <span id="add_motor_gvw_error" style="color: red;">*</span>
                  <select type="text" class="form-control" id="classification">
                      <option value="">--Select--</option>
                      <option value="T">GVW</option>
                      <option value="CC">CC</option>
                      <option value="Seater">Seater</option>
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
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true" style="color:white;">×</span></button>
                <h4 class="modal-title text-center">Edit Motor Products</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                  <label>Motor Category</label> <span id="edit_name_error" style="color: red;">*</span>
                   <select class="form-control" name="edit_motor_category" id="edit_motor_category">
                      <option value="">--Select--</option>
                      <?php foreach($policy_type as $da){?>
                       <option value="<?php echo $da->id ?>"><?php echo $da->policy_type ?></option>
                      <?php } ?>
                  </select>
                </div>
                
                <div class="form-group">
                  <label>FROM</label> <span id="edit_motor_gvw_error" style="color: red;">*</span>
                  <input type="text" class="form-control" id="edit_fr_gvw">
                </div>
                
                 <div class="form-group">
                  <label>To</label> <span id="edit_motor_gvw_error" style="color: red;">*</span>
                  <input type="text" class="form-control" id="edit_to_gvw">
                </div>
                
                 <div class="form-group">
                  <label>GVW/Cc</label> <span id="edit_motor_gvw_error" style="color: red;">*</span>
                  <select type="text" class="form-control" id="edit_classification">
                      <option value="">--Select--</option>
                      <option value="T">GVW</option>
                      <option value="CC">CC</option>
                      <option value="Seater">Seater</option>
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
    
    $('.select2').select2();
    
      fetch_motor_gvw();
      
      check_permission();
      
      $("#add_btn").click(function(){

        var motor_category = $("#add_motor_category").val();
        var add_fr_gvw = $("#add_fr_gvw").val();
        var add_to_gvw = $("#add_to_gvw").val();
        var classification = $("#classification").val();
        
        
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
        else if(add_fr_gvw === "")
        {
             error_check = 1;
            Swal.fire(
              'Enter FROM?',
              'That thing is still around?',
              'question'
            )
        }
        
        else if(add_to_gvw === "")
        {
             error_check = 1;
            Swal.fire(
              'Enter To?',
              'That thing is still around?',
              'question'
            )
        }
        
        else if(classification === "")
        {
             error_check = 1;
            Swal.fire(
              'Select Classification ?',
              'That thing is still around?',
              'question'
            )
        }

       else if(error_check != 1)
        {
          $.ajax({
            url:"add_motor_gvw",
            data:{motor_category:motor_category,add_fr_gvw:add_fr_gvw,add_to_gvw:add_to_gvw,classification:classification},
            method:"POST",
            beforeSend:function(){
                $("#add_btn").attr("disabled",true);
            },
            success:function(response){
                $("#add_motor_category").val("");
                $("#add_motor_category").trigger("change");
                $("#add_fr_gvw").val("");
                $("#add_to_gvw").val("");
                $("#classification").val("");
                $("#add_btn").attr("disabled",false);
                $("#add_model").modal("hide");
                $(".form-control").val();
                fetch_motor_gvw();
            },
            error: function(code) {   
                alert(code.statusText);
            },
          });
        }
      });
      
      $("#edit_btn").click(function(){

        var motor_category = $("#edit_motor_category").val();
        var edit_fr_gvw = $("#edit_fr_gvw").val();
        var edit_to_gvw = $("#edit_to_gvw").val();
        var edit_classification = $("#edit_classification").val();
        
        
        var id = $("#edit_id").val();

        $("#edit_name_error").html("*");

        var error_check = 0;

        if(motor_category === "")
        {
                     Swal.fire(
              'Select Motor Category ?',
              'That thing is still around?',
              'question'
            )
          error_check = 1;
        }
       else if(edit_fr_gvw === "")
        {
             error_check = 1;
            Swal.fire(
              'Enter FROM?',
              'That thing is still around?',
              'question'
            )
        }
        
        else if(edit_to_gvw === "")
        {
             error_check = 1;
            Swal.fire(
              'Enter To?',
              'That thing is still around?',
              'question'
            )
        }
        
        else if(edit_classification === "")
        {
             error_check = 1;
            Swal.fire(
              'Select Classification ?',
              'That thing is still around?',
              'question'
            )
        }
        else if(error_check != 1)
        {
          $.ajax({
            url:"edit_motor_gvw",
            data:{motor_category:motor_category,edit_fr_gvw:edit_fr_gvw,edit_to_gvw:edit_to_gvw,edit_classification:edit_classification,id:id},
            method:"POST",
            beforeSend:function(){
                $("#edit_btn").attr("disabled",true);
            },
            success:function(response){
                fetch_motor_gvw();
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
    
    
    function fetch_motor_gvw()
    {
      var content = "";
      content += "<div class='table-responsive'>";
      content += "<table id='table_id' class='table table-hover table-bordered'>"; 
      content += "<thead><th>S.No</th><th>Motor Category</th><th>Classification</th><th>Action</th></thead>";
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
            'url':'fetch_motor_gvw',
          }
      });      
    }
    
    function edit_data(id)
    {
      $.ajax({
        url:"fetch_edit_motor_gvw",
        data:{id:id},
        method:"POST",
        success:function(response){
          var obj = jQuery.parseJSON(response);
          $("#edit_motor_category").val(obj.motor_category_id);
          $("#edit_fr_gvw").val(obj.from_gvw_cc);
          $("#edit_to_gvw").val(obj.to_gvw_cc);
          $("#edit_classification").val(obj.classification);
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
      
      function delete_data(id)
      {
      if(confirm("Are you Confirm to Delete"))
      {
         $.ajax({
              url:"delete_motor_sub_category",
              data:{id:id},
              method:"POST",
              success:function(response){
                // alert(response);
                fetch_motor_gvw();
              },
              error: function(code) {   
                alert(code.statusText);
              },
            });
      }
          }
      
</script>
