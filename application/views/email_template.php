<script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1 style="font-size: 17px;">
        Email
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
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true" style="color:white;">×</span></button>
                <h4 class="modal-title text-center">New Email Template</h4>
            </div>
            <div class="modal-body">
                
                <div class="form-group">
                  <label>Template Title</label> <span id="add_title_error" style="color: red;">*</span>
                  <input type="text" class="form-control" id="add_title">
                </div>
                
                 <div class="form-group">
                  <label>Email Subject</label> <span id="add_title_error" style="color: red;">*</span>
                  <input type="text" class="form-control" id="add_subject">
                </div>
                
                 <div class="form-group">
                  <label>Message</label> <span id="add_title_error" style="color: red;">*</span>
                  <textarea name="add_message" id="add_message"></textarea>
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
                <h4 class="modal-title text-center">New Email Template</h4>
            </div>
            <div class="modal-body">
                
                <div class="form-group">
                  <label>Template Title</label> <span id="edit_title_error" style="color: red;">*</span>
                  <input type="text" class="form-control" id="edit_title">
                </div>
                
                 <div class="form-group">
                  <label>Email Subject</label> <span id="edit_title_error" style="color: red;">*</span>
                  <input type="text" class="form-control" id="edit_subject">
                </div>
                
                 <div class="form-group">
                  <label>Message</label> <span id="edit_title_error" style="color: red;">*</span>
                  <textarea name="edit_message" id="edit_message"></textarea>
                </div>
                <input type="hidden" id="edit_id"> 
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-sm btn-primary" id="edit_btn">Submit</button>
            </div>
        </div>
    </div>
  </div>
  
  <script type="text/javascript">
		CKEDITOR.replace('add_message');
		CKEDITOR.replace('edit_message');
		
		  
	$(document).ready(function(){
	    
     fetch_email_templates();
     
     check_permission();
     
     
      $("#add_btn").click(function(){
          
        var title = $("#add_title").val();
        var subject = $("#add_subject").val();
        var message = CKEDITOR.instances.add_message.getData();
        var error_check = 0;
        
        if(title === "")
        {
          error_check = 1;
            Swal.fire(
            'Enter Email Title?',
            'That thing is still around?',
            'question'
            )
        }
        else if(subject === "")
        {
            error_check = 1;
            Swal.fire(
            'The Subject?',
            'That thing is still around?',
            'question'
            )
        }
        else if(message === "")
        {
            error_check = 1;
            Swal.fire(
            'Enter Message?',
            'That thing is still around?',
            'question'
            )
        }
        else if(error_check != 1)
        {
          $.ajax({
            url:"add_email_template",
            data:{title:title,subject:subject,message:message},
            method:"POST",
            beforeSend:function(){
                $("#add_btn").attr("disabled",true);
            },
            success:function(response){
                fetch_email_templates();
                
                    const Toast = Swal.mixin({
                      toast: true,
                      position: 'top-end',
                      showConfirmButton: false,
                      timer: 3000,
                      timerProgressBar: true,
                      didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                      }
                    })
                    
                    Toast.fire({
                      icon: 'success',
                      title: 'Template Saved SuccessFully'
                    })
                $("#add_title").val("");
                $("#add_subject").val("");
                $("#add_message").val("");
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
          
        var id = $("#edit_id").val(); 
        
        var title = $("#edit_title").val();
        var subject = $("#edit_subject").val();
        var message = CKEDITOR.instances.edit_message.getData();
        var error_check = 0;
        
        if(title === "")
        {
          error_check = 1;
            Swal.fire(
            'Enter Email Title?',
            'That thing is still around?',
            'question'
            )
        }
        else if(subject === "")
        {
            error_check = 1;
            Swal.fire(
            'The Subject?',
            'That thing is still around?',
            'question'
            )
        }
        else if(message === "")
        {
            error_check = 1;
            Swal.fire(
            'Enter Message?',
            'That thing is still around?',
            'question'
            )
        }
        else if(error_check != 1)
        {
          $.ajax({
            url:"edit_email_template",
            data:{id:id,title:title,subject:subject,message:message},
            method:"POST",
            beforeSend:function(){
                $("#edit_btn").attr("disabled",true);
            },
            success:function(response){
                fetch_email_templates();
                
                    const Toast = Swal.mixin({
                      toast: true,
                      position: 'top-end',
                      showConfirmButton: false,
                      timer: 3000,
                      timerProgressBar: true,
                      didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                      }
                    })
                    
                    Toast.fire({
                      icon: 'success',
                      title: 'Template Saved SuccessFully'
                    })
                $("#edit_title").val("");
                $("#edit_subject").val("");
                $("#edit_message").val("");
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
	
	function fetch_email_templates()
    {
      var content = "";
      content += "<div class='table-responsive'>";
      content += "<table id='table_id' class='table table-hover table-bordered'>"; 
      content += "<thead><th>S.No</th><th>Title</th><th>Subject</th><th>Message</th><th>Action Records</th></thead>";
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
            'url':'fetch_email_templates',
          }
      });      
    }
    
     function edit_data(id)
    {
      $.ajax({
        url:"fetch_edit_email_templates",
        data:{id:id},
        method:"POST",
        success:function(response){
          var obj = jQuery.parseJSON(response);
          $("#edit_title").val(obj.template_name);
          $("#edit_subject").val(obj.subject);
          CKEDITOR.instances['edit_message'].setData(obj.Message);
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
          url:"delete_email_template",
          data:{id:id},
          method:"POST",
          success:function(response){
            fetch_email_templates();
                    const Toast = Swal.mixin({
                      toast: true,
                      position: 'top-end',
                      showConfirmButton: false,
                      timer: 3000,
                      timerProgressBar: true,
                      didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                      }
                    })
                    
                    Toast.fire({
                      icon: 'success',
                      title: 'Template Deleted SuccessFully'
                    })
          },
          error: function(code) {   
            alert(code.statusText);
          },
        });
      }
    }
    
    function send_email(id)
    {
            Swal.fire({
              title: 'Are you sure Want Send This Mail To All Customers ?',
              text: "",
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Yes'
            }).then((result) => {
              if (result.isConfirmed) {
                 $.ajax({
                    url : "send_mail_to_all_customers",
                    data : {id:id},
                    method : "POST",
                    success:function(response)
                    {
                     const Toast = Swal.mixin({
                      toast: true,
                      position: 'top-end',
                      showConfirmButton: false,
                      timer: 3000,
                      timerProgressBar: true,
                      didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                      }
                    })
                    
                    Toast.fire({
                      icon: 'success',
                      title: 'All Mails Sent SuccessFully'
                    })
                    }
                 });
              }
            })
    }
    
    
    function check_permission()
      {
          $.ajax({
              url : "check_add_permission",
              success:function(response)
              {
                  var obj = jQuery.parseJSON(response);
                  
                  if(obj.email_add == "1")
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