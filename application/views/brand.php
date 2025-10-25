<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1 style="font-size: 17px;">
        Car Brand
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
                <h4 class="modal-title text-center">Create Car Brand</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                  <label>Brand Name</label> <span id="add_name_error" style="color: red;">*</span>
                  <input type="text" class="form-control" id="add_name">
                </div>
                <div class="form-group">
                  <label>Icon</label> <span id="add_icon_error" style="color: red;">*</span>
                  <input type="file" class="form-control" id="add_icon"  width='100' height='100'>
                    <img src="" id="add_icon_view" >
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
                <div class="form-group">
                  <label>Icon</label> <span id="edit_icon_error" style="color: red;">*</span>
                  <input type="file" class="form-control" id="edit_icon">
                    <img src="" id="edit_icon_view"  width='100' height='100'>
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
      fetch_brand();
      
      check_permission();
      
      
        $('#add_icon').change(function check(input) {  
			var selectedValue = $(this).val(); 
			var fileExtension = ['jpeg', 'jpg', 'png', 'gif', 'bmp'];
			if($.inArray(selectedValue.split('.').pop().toLowerCase(), fileExtension) == -1)
			{
				$('#add_icon').val(""); 
				$('#add_icon_view').attr('src' , ""); 
				$('#add_icon_view').attr('width' , "0");
				$('#add_icon_view').attr('height' , "0");
			}
			else
			{
				var selected_file = $('#add_icon').get(0).files[0];
				selected_file = window.URL.createObjectURL(selected_file);
				$('#add_icon_view').attr('src' , selected_file);
				$('#add_icon_view').attr('width' , "100");
				$('#add_icon_view').attr('height' , "100");
		    }
        });
        $('#edit_icon').change(function check(input) {  
			var selectedValue = $(this).val(); 
			var fileExtension = ['jpeg', 'jpg', 'png', 'gif', 'bmp'];
			if($.inArray(selectedValue.split('.').pop().toLowerCase(), fileExtension) == -1)
			{
				$('#edit_icon').val(""); 
				$('#edit_icon_view').attr('src' , ""); 
			}
			else
			{
				var selected_file = $('#edit_icon').get(0).files[0];
				selected_file = window.URL.createObjectURL(selected_file);
				$('#edit_icon_view').attr('src' , selected_file);
		    }
        });
        
      $("#add_btn").click(function(){

        var name = $("#add_name").val();
        var icon = $("#add_icon").prop('files')[0];
        $("#add_name_error").html("*");
        $("#add_icon_error").html("*");
      //  alert(icon);

        if(name === "")
        {
            snackbar_show("Enter Brand Name");
        }
        else if(icon == null)
        {
             snackbar_show("Choose Icon");
        }
        else
        {
            var formdata = new FormData();
            formdata.append('name',name);
            formdata.append('icon',icon);
          $.ajax({
            url:"add_brand",
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
                fetch_brand();
                $("#add_name").val("");
                $("#add_icon").val(null);
                $("#add_icon_view").attr("src","");
                $('#add_icon_view').attr('width' , "0");
				$('#add_icon_view').attr('height' , "0");
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
         var icon = $("#edit_icon").prop('files')[0];
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
            formdata.append('icon',icon);
            formdata.append('id',id);
          $.ajax({
            url:"edit_brand",
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
                fetch_brand();
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
    function fetch_brand()
    {
      var content = "";
      content += "<div class='table-responsive'>";
      content += "<table id='table_id' class='table table-hover table-bordered'>"; 
      content += "<thead><th>S.No</th><th>Name</th><th>Icon</th><th>Action</th></thead>";
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
            'url':'fetch_brand',
          }
      });      
    }
    function edit_data(id)
    {
      $.ajax({
        url:"fetch_edit_brand",
        data:{id:id},
        method:"POST",
        success:function(response){
          // alert(response);
          var obj = jQuery.parseJSON(response);
          $("#edit_name").val(obj.brand_name);
          $("#edit_heading").html("Edit "+obj.brand_name);
          $("#edit_icon_view").attr("src",obj.icon);
          $("#edit_model").modal("show");
          $("#edit_id").val(id);
        },
        error: function(code) {   
            alert(code.statusText);
        },
      });
      
    }

    // function delete_data(id)
    // {
    //   if(confirm("Are you Confirm to Delete"))
    //   {
    //     $.ajax({
    //       url:"delete_category",
    //       data:{id:id},
    //       method:"POST",
    //       success:function(response){
    //         // alert(response);

    //         fetch_brand();
    //       },
    //       error: function(code) {   
    //         alert(code.statusText);
    //       },
    //     });
    //   }
    //}
    
    function check_permission()
      {
          $.ajax({
              url : "check_add_permission_1",
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
