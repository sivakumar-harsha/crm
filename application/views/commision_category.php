<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1 style="font-size: 17px;">
        Commision Category
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
  
  
  <div class="modal fade in" id="edit_model">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true" style="color:white;">×</span></button>
                <h4 class="modal-title text-center">Edit Category</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                  <label>Category_name</label> <span id="edit_category_error" style="color: red;">*</span>
                  <input type="text" class="form-control" id="edit_category">
                </div>
                
              <div class="row">
                 
                 <div class="col-md-6">
                        <div class="form-group">
                          <label>Min Amount</label> <span id="edit_category_error" style="color: red;">*</span>
                          <input type="number" class="form-control" id="edit_frm_amt">
                        </div>
                 </div>
                
                <div class="col-md-6">
                        <div class="form-group">
                          <label>Max Amount</label> <span id="edit_category_error" style="color: red;">*</span>
                          <input type="number" class="form-control" id="edit_to_amt">
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
        
      fetch_commission_category();

      $("#edit_btn").click(function(){

        var category_name = $("#edit_category").val();
        var min_amt = $("#edit_frm_amt").val();
        var max_amt = $("#edit_to_amt").val();
        
        var id = $("#edit_id").val();

        $("#edit_category_error").html("*");

        var error_check = 0;

        if(category_name === "")
        {
            error_check = 1;
                      Swal.fire(
              'Enter Category Name ?',
              'That thing is still around?',
              'question'
            )
        }
        else if(min_amt === "")
        {
            error_check = 1;
            Swal.fire(
              'Enter Minimum Amount ?',
              'That thing is still around?',
              'question'
            )
        }
        else if(max_amt === "")
        {
            Swal.fire(
              'Enter Maximum Amount ?',
              'That thing is still around?',
              'question'
            )
             error_check = 1;
        }

        else if(error_check != 1)
        {
          $.ajax({
            url:"edit_commission_category",
            data:{category_name:category_name,min_amt:min_amt,max_amt:max_amt,id:id},
            method:"POST",
            beforeSend:function(){
                $("#edit_btn").attr("disabled",true);
            },
            success:function(response){
                
                if(response == "Success")
                {
                    fetch_commission_category();
                    $("#edit_category").val("");
                    $("#edit_btn").attr("disabled",false);
                    $("#edit_model").modal("hide");
                    $(".form-control").val("");
                }
                else if(response == "Matched")
                {
                     $("#edit_btn").attr("disabled",false);
                       Swal.fire({
                                  icon: 'error',
                                  title: 'Oops...',
                                  text: 'The Slab Range Already Exits!',
                                  footer: ''
                                })
                }
            },
            error: function(code) {   
                alert(code.statusText);
            },
          });
        }
      });

    });
    function fetch_commission_category()
    {
      var content = "";
      content += "<div class='table-responsive'>";
      content += "<table id='table_id' class='table table-hover table-bordered'>"; 
      content += "<thead><th>S.No</th><th>Category</th><th>From Amt</th><th>To Amt</th><th>Action</th></thead>";
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
            'url':'fetch_commission_category',
          }
      });      
    }
    function edit_data(id)
    {
      $.ajax({
        url:"fetch_commission_edit_category",
        data:{id:id},
        method:"POST",
        success:function(response){
          // alert(response);
          var obj = jQuery.parseJSON(response);
          $("#edit_category").val(obj.category);
          $("#edit_frm_amt").val(obj.from_amt);
          $("#edit_to_amt").val(obj.to_amt);
          $("#edit_model").modal("show");
          $("#edit_id").val(id);
        },
        error: function(code) {   
            alert(code.statusText);
        },
      });
      
    }

   
  </script>
