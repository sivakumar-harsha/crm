<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<style>
    label{
        font-weight:normal;
        font-size:17px;
    }
</style>

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1 style="font-size: 17px;">
          Followups
        <div class="row">
            <div class="col-md-4">
                
            </div>
            <div class="col-md-4">
                <div class="row">
                    <div class="col-md-4">
                        <label>From Date</label>
                    </div>
                    <div class="col-md-8">
                      <input type="date" class="form-control" name="from_date" id="from_date" value="<?php echo date("Y-m-d") ?>">  
                    </div>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="row">
                    <div class="col-md-4">
                        <label>To Date</label>
                    </div>
                    <div class="col-md-8">
                      <input type="date" class="form-control" name="to_date" id="to_date" value="<?php echo date("Y-m-d") ?>">  
                    </div>
                </div>
            </div>
           
        </div>
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
                <h4 class="modal-title text-center" style="color:white;">Edit Follow Up</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                  <label>Follow up-Concluded</label> <span id="add_name_error" style="color: red;">*</span>
                  <select class="form-control" name="follow_up_concluded" id="follow_up_concluded">
                      <option value="">--Select--</option>
                      <option value="1">Yes</option>
                      <option value="0">No</option>
                  </select>
                </div>
                
                 <div class="form-group">
                  <label>Reason</label> <span id="add_name_error" style="color: red;">*</span>
                  <select class="form-control" name="follow_up_reason" id="follow_up_reason">
                      <option value="">--Select--</option>
                      <option value="Call not answered">Call not answered</option>
                      <option value="Invalid Phone number">Invalid Phone number</option>
                      <option value="New Follow up">New Follow up</option>
                      <option value="Phone Unreachable">Phone Unreachable</option>
                      <option value="Rescheduled">Rescheduled</option>
                  </select>
                </div>
                
                 <div class="form-group">
                  <label>Next Follow up date</label> <span id="add_name_error" style="color: red;">*</span>
                  <input type="Date" class="form-control" name="enter_next_follow_date" id="enter_next_follow_date">
                </div>
                
                <div class="form-group">
                  <label>Next Follow up Time</label> <span id="add_name_error" style="color: red;">*</span>
                  <input type="time" class="form-control" name="enter_next_follow_time" id="enter_next_follow_time">
                </div>
                
                 <div class="form-group">
                  <label>Comment</label> <span id="add_name_error" style="color: red;"></span>
                  <textarea class="form-control" name="follow_comment" id="follow_comment"></textarea>
                </div>
                
                <input type="hidden" id="edit_id">
                <input type="hidden" id="edit_lead_id">
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-primary"  id="edit_follow_up_btn">Add</button>
                <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
  </div>
  
  
  <div id="followup_log_mod" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title text-center">Follow up details</h4>
      </div>
      <div class="modal-body">
        
        <table class="table table-responsive">
            <thead>
                <th>Date</th>
                <th>Time</th>
                <th>Reason</th>
                <th>Comment</th>
            </thead>
            <tbody id="follow_up_id">
                
            </tbody>
        </table>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

<script>
  
  var from_date = $("#from_date").val();
  var to_date = $("#to_date").val();
  
  $("#from_date").change(function(){
      from_date = $("#from_date").val();
      to_date = $("#to_date").val();
      fetch_followups();
  });
  $("#to_date").change(function(){
      from_date = $("#from_date").val();
      to_date = $("#to_date").val();
      fetch_followups();
  });
  
  $(document).ready(function(){
      fetch_followups();
      check_permission();
      
       $("#edit_follow_up_btn").click(function(){
           
           var id = $("#edit_id").val();
           var lead_id = $("#edit_lead_id").val();
           var follow_up_status = $("#follow_up_concluded").val();
           var follow_up_reason = $("#follow_up_reason").val();
           var enter_next_follow_date = $("#enter_next_follow_date").val();
           var enter_next_follow_time = $("#enter_next_follow_time").val();
           var follow_comment = $("#follow_comment").val();
           
           var check = 0;
           
           if(follow_up_status == "")
           {
               check = 1;
                    Swal.fire(
                    'Select Follow Up Concluded ?',
                    '',
                    'question'
                    )
           }
           else if(follow_up_reason === "")
           {
               check = 1;
               Swal.fire(
                    'Select Reason ?',
                    '',
                    'question'
                    )
           }
           else if(enter_next_follow_date == "")
           {
               check = 1;
               
                Swal.fire(
                    'Select Next Follow Up Date ?',
                    '',
                    'question'
                    )
           }
          else if(enter_next_follow_time == "")
           {
               check = 1;
               
               Swal.fire(
                    'Select Next Follow Up Time ?',
                    '',
                    'question'
                    )
           }
           else if(check != 1)
           {
            $.ajax({
                url : "edit_follow_up_details",
                method : "POST",
                data :{id:id,lead_id:lead_id,follow_up_status:follow_up_status,follow_up_reason:follow_up_reason,enter_next_follow_date:enter_next_follow_date,enter_next_follow_time:enter_next_follow_time,follow_comment:follow_comment},
                beforeSend:function(){
                  $("#add_follow_up_btn").attr("disabled",true);  
                },
                success:function(response)
                {
                        Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'Follow up has been added successfully',
                        showConfirmButton: false,
                        timer: 1500
                        })
                    $("#edit_follow_up_btn").attr("disabled",false);  
                    $("#edit_model").modal("toggle");
                    $("#follow_up_concluded").val("");
                    $("#follow_up_reason").val("");
                    $("#enter_next_follow_date").val("");
                    $("#enter_next_follow_time").val("");
                    $("#follow_comment").val("");
                    
                    fetch_followups();
           }
           
       });
           }
       });
  });
  
    function check_permission()
      {
          $.ajax({
              url : "check_add_permission",
              success:function(response)
              {
                  var obj = jQuery.parseJSON(response);
                  if(obj.follow_edit == "1")
                  {
                      $("#edit_follow").removeClass("hidden");
                  }
                  else
                  {
                      $("#edit_follow").addClass("hidden");
                  }
                  if(obj.follow_view == "1")
                  {
                      $("#delete_follow").removeClass("hidden");
                  }
                  else
                  {
                      $("#delete_follow").addClass("hidden");
                  }
              }
          });
      }
   
    function fetch_followups()
    {
      var content = "";
      content += "<div class='table-responsive'>";
      content += "<table id='table_id' class='table table-hover table-bordered'>"; 
      content += "<thead><th>S.No</th><th>Client name</th><th>Mobile Number</th><th>Next Follow up Date</th><th>Next Follow up Time</th><th>Lead Generated Date</th><th>Reason</th><th>Due Date</th>><th>User</th><th>Action</th></thead>";
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
            'url':'fetch_all_follow_ups',
            'method' : "POST",
            'data':{from_date:from_date,to_date:to_date},
          }
      });      
    }
    
    function delete_data(id)
    {
        Swal.fire({
          title: 'Are you sure?',
          text: "You won't be able to revert this!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
          if (result.isConfirmed) {
              $.ajax({
                 url : "delete_follow_up",
                 method:"POST",
                 data : {id:id},
                 success:function(response)
                 {
                        Swal.fire(
                        'Deleted!',
                        'Your Followup has been deleted.',
                        'success'
                        ) 
                        fetch_followups();
                 }
              });
            
                }
         })
    }
    
    function edit_data(id)
    {
        $.ajax({
             url : "fetch_edit_follow_up",
             method : "POST",
             data : {id:id},
             success:function(response)
             {
                 var obj = jQuery.parseJSON(response);
                 $("#follow_up_concluded").val(obj.follow_up_status);
                 $("#follow_up_reason").val(obj.reason);
                 $("#enter_next_follow_date").val(obj.next_follow_up_date);
                 $("#enter_next_follow_time").val(obj.next_follow_up_time);
                 $("#follow_comment").val(obj.comment);
                 $("#edit_lead_id").val(obj.lead_id);
                 $("#edit_id").val(id);
                 $("#edit_model").modal("toggle");
             }
              
        });
    }
    
    function follow_up_log(id)
    {
        $.ajax({
            url : "fetch_followup_log",
            method : "POST",
            data : {id:id},
            success:function(response)
            {
                $("#follow_up_id").html(response);
                $("#followup_log_mod").modal("toggle");
            }
        });
    }
</script>