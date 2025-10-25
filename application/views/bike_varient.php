<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1 style="font-size: 17px;">
        Bike Varient
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
    <div class="modal-dialog  modal-sm">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true" style="color:white;">×</span></button>
                <h4 class="modal-title text-center">Create Bike Varient</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                  <label>Brand</label> <span id="add_branch_error" style="color: red;">*</span>
                  <div class='row'>
                    <div class="col-sm-8">
                      <select class="form-control" id="add_brand">
                          <option value = ""> Select Brand </option>
                          <?php foreach($brand as $b) { ?>
                          <option value="<?php echo $b->id ?>"> <?php echo $b->brand_name ?> </option>
                          <?php } ?>
                      </select>
                  </div>
                  <div class="col-sm-4">
                  <img src="" id="add_icon_view" >
                  </div>
                  </div>
                </div>
                <div class="form-group">
                  <label>Model</label> <span id="add_branch_error" style="color: red;">*</span>
                  <div class='row'>
                    <div class="col-sm-8">
                      <select class="form-control" id="add_model_dropdown">
                      </select>
                  </div>
                  
                  </div>
                </div>
                <div class="form-group">
                  <label>Varient Name</label> <span id="add_name_error" style="color: red;">*</span>
                  <div class='row'>
                    <div class="col-sm-8">
                        <div id="varient_add_div">
                            <input type="text" style="margin:5px;" class="form-control" id="add_name">
                        </div>
                        <div id="varient_add_div1">
                            
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <button id="sub_file_btn" class="btn btn-info btn-sm pull-right"> - </button>
                        <button id="add_file_btn" class="btn btn-info btn-sm pull-right" style="margin-right:5px;"> + </button>
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
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true" style="color:white;">×</span></button>
                <h4 class="modal-title text-center" id="edit_heading"></h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                  <label>Brand</label> <span id="edit_name_error" style="color: red;">*</span>
                  <div class='row'>
                    <div class="col-sm-8">
                      <select class="form-control" id="edit_brand">
                          <option value = ""> Select Brand </option>
                          <?php foreach($brand as $b) { ?>
                          <option value="<?php echo $b->id ?>"> <?php echo $b->brand_name ?> </option>
                          <?php } ?>
                      </select>
                  </div>
                  <div class="col-sm-4">
                    <img src="" id="edit_icon_view" >
                  </div>
                  </div>
                </div>
                 <div class="form-group">
                  <label>Model</label> <span id="edit_branch_error" style="color: red;">*</span>
                  <div class='row'>
                    <div class="col-sm-8">
                      <select class="form-control" id="edit_model_dropdown">
                      </select>
                  </div>
                  </div>
                </div>
                <div class="form-group">
                  <label>Varient Name</label> <span id="edit_name_error" style="color: red;">*</span>
                  <div class='row'>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="edit_name">
                    </div>
                  </div>
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
      fetch_varient();
      check_permission();
      $('#add_brand').change(function(){
          var brand = $('#add_brand').val();
          $.ajax({
            url:"get_bike_brand_logo",
            data:{brand:brand},
            method:"POST",
            success:function(response){
                $("#add_icon_view").attr("src",response);
                $("#add_icon_view").attr("height",50);
                $("#add_icon_view").attr("width",50);
            },
            error: function(code) {   
                alert(code.statusText);
            },
          });
          $.ajax({
            url:"get_bike_model_list",
            data:{brand:brand},
            method:"POST",
            success:function(response){
                $("#add_model_dropdown").html(response);
            },
            error: function(code) {   
                alert(code.statusText);
            },
          });
      });
      $('#edit_brand').change(function(){
          var brand = $('#edit_brand').val();
          $.ajax({
            url:"get_bike_brand_logo",
            data:{brand:brand},
            method:"POST",
            success:function(response){
                $("#edit_icon_view").attr("src",response);
                $("#edit_icon_view").attr("height",50);
                $("#edit_icon_view").attr("width",50);
            },
            error: function(code) {   
                alert(code.statusText);
            },
          });
           $.ajax({
            url:"get_bike_model_list",
            data:{brand:brand},
            method:"POST", 
            success:function(response){
                $("#edit_model_dropdown").html(response);
            },
            error: function(code) {   
                alert(code.statusText);
            },
          });
      });
      $('#add_file_btn').click(function(){
          var add = '';
          add += '<input type="text" style="margin:5px;" class="form-control add_varient">';
           $("#varient_add_div1").append(add);
      });
      $('#sub_file_btn').click(function(){
			  $('#varient_add_div1').children().last().remove();
	   });
      $("#add_btn").click(function(){

        var name = $("#add_name").val();
        var brand = $("#add_brand").val();
         var model = $("#add_model_dropdown").val();
        $("#add_name_error").html("*");
        if(brand === "")
        {
          snackbar_show("Select Brand");
        }
        else if(model === "")
        {
          snackbar_show("Select Model");
        }
        else if(name === "")
        {
          snackbar_show("Enter Varient Name");
        }
        else
        {
           var name1 = [];
            $(".add_varient").each(function() {
                if( this.value != "")
                {
                    name1.push(this.value);
                }
            });
          $.ajax({
            url:"add_bike_varient",
            data:{name:name,
                brand:brand,
                name1:name1,
                model:model,
            },
            method:"POST",
            beforeSend:function(){
                $("#add_btn").attr("disabled",true);
            },
            success:function(response){
                // alert(response);
                fetch_varient();
                $("#add_name").val("");
                $("#add_brand").val("");
                $("#add_model_dropdown").val("");
                 $('#varient_add_div1').children().remove();
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
        var brand = $("#edit_brand").val();
        var model = $("#edit_model_dropdown").val();
        var id = $("#edit_id").val();

        $("#edit_name_error").html("*");
        
        if(brand === "")
        {
            snackbar_show("Select Brand");
        }
        else if(model === "")
        {
            snackbar_show("Select Model");
        }
        else if(name === "")
        {
            snackbar_show("Enter Varient Name");
        }
        else
        {
          $.ajax({
            url:"edit_bike_varient",
            data:{name:name,
                id:id,
                brand:brand,
                model:model,
            },
            method:"POST",
            beforeSend:function(){
                $("#edit_btn").attr("disabled",true);
            },
            success:function(response){
                // alert(response);
                fetch_varient();
                $("#edit_name").val("");
                $("#edit_brand").val("");
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
    function fetch_varient()
    {
      var content = "";
      content += "<div class='table-responsive'>";
      content += "<table id='table_id' class='table table-hover table-bordered'>"; 
      content += "<thead><th>S.No</th><th>Brand</th><th>Model</th><th>Varient</th><th>Action</th></thead>";
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
            'url':'fetch_bike_varient',
          }
      });      
    }
    function edit_data(id)
    {
      $.ajax({
        url:"fetch_edit_bike_varient",
        data:{id:id},
        method:"POST",
        success:function(response){
          // alert(response);
          var obj = jQuery.parseJSON(response);
          $("#edit_name").val(obj["res"].varient_name);
          $("#edit_heading").html("Edit "+obj["res"].varient_name);
          $("#edit_brand").val(obj["res"].brand_id);
           $("#edit_icon_view").attr("src",obj["icon"]);
            $("#edit_icon_view").attr("height",50);
            $("#edit_icon_view").attr("width",50);
           $("#edit_model_dropdown").html(obj["model_option"]);
          $("#edit_model_dropdown").val(obj["res"].model_id);
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
            // alert(response);

            fetch_varient();
          },
          error: function(code) {   
            alert(code.statusText);
          },
        });
      }
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