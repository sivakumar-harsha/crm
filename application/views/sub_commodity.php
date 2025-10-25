<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1 style="font-size: 17px;">
        Marine Sub Commodity
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
    <div class="modal-dialog  modal-sm">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true" style="color:white;">×</span></button>
                <h4 class="modal-title text-center">Sub Commodity</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                  <label>Brand</label> <span id="add_branch_error" style="color: red;">*</span>
                  <div class='row'>
                    <div class="col-sm-8">
                  <select class="form-control" id="add_brand">
                      <option value = ""> Select Commodity </option>
                      <?php foreach($commodity as $b) { ?>
                      <option value="<?php echo $b->id; ?>"> <?php echo $b->name; ?> </option>
                      <?php } ?>
                  </select>
                  </div>
                  <div class="col-sm-4">
                  </div>
                  </div>
                </div>
                <div class="form-group">
                  <label>Model Name</label> <span id="add_name_error" style="color: red;">*</span>
                  <div class='row'>
                    <div class="col-sm-8">
                        <div id="model_add_div">
                            <input type="text" style="margin:5px;" class="form-control" id="add_name">
                        </div>
                        <div id="model_add_div1">
                            
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
                          <?php foreach($commodity as $b) { ?>
                          <option value="<?php echo $b->id ?>"> <?php echo $b->name ?> </option>
                          <?php } ?>
                      </select>
                  </div>
                  <div class="col-sm-4">
                  </div>
                  </div>
                </div>
                <div class="form-group">
                  <label>Model Name</label> <span id="edit_name_error" style="color: red;">*</span>
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
      fetch_sub_commodity_model();
      
      $('#add_file_btn').click(function(){
          var add = '';
          add += '<input type="text" style="margin:5px;" class="form-control add_model">';
           $("#model_add_div1").append(add);
      });
      $('#sub_file_btn').click(function(){
			  $('#model_add_div1').children().last().remove();
	   });
      $("#add_btn").click(function(){

        var name = $("#add_name").val();
        var commodity = $("#add_brand").val();
        $("#add_name_error").html("*");
        if(commodity === "")
        {
          snackbar_show("Select Commodity");
        }
        else if(name === "")
        {
          snackbar_show("Enter Sub Commodity Name");
        }
        else
        {
           var name1 = [];
            $(".add_model").each(function() {
                if( this.value != "")
                {
                    name1.push(this.value);
                }
            });
          $.ajax({
            url:"add_marine_sub_commodity",
            data:{name:name,
                commodity:commodity,
                name1:name1,
            },
            method:"POST",
            beforeSend:function(){
                $("#add_btn").attr("disabled",true);
            },
            success:function(response){
                // alert(response);
                fetch_sub_commodity_model();
                $("#add_name").val("");
                $("#add_brand").val("");
                $('#model_add_div1').children().remove();
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
        var commodity = $("#edit_brand").val();
        var id = $("#edit_id").val();

        $("#edit_name_error").html("*");
        
        if(commodity === "")
        {
            snackbar_show("Select Commodity");
        }
        else if(name === "")
        {
            snackbar_show("Enter Sub Commodity Name");
        }
        else
        {
          $.ajax({
            url:"edit_marine_sub_commodity",
            data:{name:name,id:id,commodity:commodity},
            method:"POST",
            beforeSend:function(){
                $("#edit_btn").attr("disabled",true);
            },
            success:function(response){
                // alert(response);
                fetch_sub_commodity_model();
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
    function fetch_sub_commodity_model()
    {
      var content = "";
      content += "<div class='table-responsive'>";
      content += "<table id='table_id' class='table table-hover table-bordered'>"; 
      content += "<thead><th>S.No</th><th>Brand</th><th>Model</th><th>Action</th></thead>";
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
            'url':'fetch_marine_sub_commodity',
          }
      });      
    }
    function edit_data(id)
    {
      $.ajax({
        url:"fetch_edit_marine_sub_commodity",
        data:{id:id},
        method:"POST",
        success:function(response){
          // alert(response);
          var obj = jQuery.parseJSON(response);
          $("#edit_name").val(obj.name);
          $("#edit_heading").html("Edit "+obj.name);
          $("#edit_brand").val(obj.commodity_id);
          $('#edit_brand').trigger('change');
          $("#edit_model").modal("show");
          $("#edit_id").val(id);
        },
        error: function(code) {   
            alert(code.statusText);
        },
      });
      
    }

    
  </script>