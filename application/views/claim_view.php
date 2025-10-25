<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1 style="font-size: 17px;">
        Claim
       <!-- <button data-toggle="modal" data-target="#add_model" class="btn btn-primary btn-sm pull-right">Add New</button> -->
        <a href="<?= base_url('/claim') ?>" class="btn btn-primary btn-sm pull-right">Add New</a>

      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="box">
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
            <li class="active" id="motor_li"><a href="#tab_1" data-toggle="tab" aria-expanded="true" onclick="fetch_claims()">Claims</a></li>
            <li class="" id="health_li"><a href="#tab_2" data-toggle="tab" aria-expanded="false" onclick="fetch_complete_claim()">Complete</a></li>
            </ul>
        </div>
    
     

      <!-- Default box -->
        <div class="box-body">
          <div id="table_view"></div>
        </div><!-- /.box-body -->        
      </div><!-- /.box -->

    </section><!-- /.content -->
  </div><!-- /.content-wrapper -->
  
  
  <div class="modal fade in" id="status_modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true" style="color:white;">×</span></button>
                <h4 class="modal-title text-center"> Claim Follow Up</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="form-group col-md-6">
                  <label> Follow Up Date</label> <span id="add_date_error" style="color: red;">*</span>
                  <input type="datetime-local" class="form-control" id="add_date">
                </div>   
                    
                    
                <div class="form-group col-md-6">
                  <label>Contact Person</label> <span id="add_name_error" style="color: red;">*</span>
                  <input type="text" class="form-control" id="contact_person">
              </div>
             </div>
             <div class="row">
                 
                  <div class="form-group col-md-6">
                  <label>Contact designation</label> <span id="add_contactdetails_error" style="color: red;">*</span>
                  <input type="text" class="form-control" id="contact_details">
              </div>
                 
               <div class="form-group col-md-6">
                  <label>Mobile No</label> <span id="add_mobileno_error" style="color: red;">*</span>
                   <input type="number" class="form-control" name="mobile_no" maxlength="10" minlength="10" size="10" id="mobile_no">
              </div>
              </div>
               <div class="form-group">
                  <label>Remarks</label> <span id="add_remarks_error" style="color: red;">*</span>
                    <textarea type="text" class="form-control" name="remarks" id="remarks" rows="2"></textarea>
                </div>
              
              
              
             </div>
             
               <div class="modal-footer" id="status_id">
                <button type="button" class="btn btn-sm btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-sm btn-primary" id="add_btn">Submit</button>
            </div>
        </div>
    </div>
  </div>
  
   <div class="modal fade in" id="view_report_modal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" style="color:white;">×</span></button>
                    <h4 class="modal-title text-center">Follow Up Details</h4>
                </div>
                <div class="modal-body">
                    
                     <div id="view_report"></div>

                 </div>
           <div class="modal-footer">
                    <input type="hidden" id="view_id">
                    <button type="button" class="btn btn-sm btn-default pull-left" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
      </div> 
  
  
  <div class="modal fade in" id="view_policy_info_modal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" style="color:white;">×</span></button>
                    <h4 class="modal-title text-center">Policy Info</h4>
                </div>
                <div class="modal-body">
                    
                     <div id="view_policy_info"></div>

                 </div>
           <div class="modal-footer">
                    <input type="hidden" id="policy_info_id">
                    <button type="button" class="btn btn-sm btn-default pull-left" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
      </div> 
  
  
    <script>
       $(document).ready(function(){
      fetch_claims();
      check_permission();
      
      
      $("#add_btn").click(function(){
               
               var contact_person = $("#contact_person").val();
               var contact_details =$("#contact_details").val();
               var mobile_no = $("#mobile_no").val();
               var remarks = $("#remarks").val();
               var date = $("#add_date").val();
               var id =$("#status_id").val();
               
               
            $.ajax({
            url:"add_claim_report",
            data:{
                contact_person:contact_person,
                contact_details:contact_details,
                mobile_no:mobile_no,
                remarks:remarks,
                date:date,
                id:id
                   },
            method:"POST",
            beforeSend:function(){
                $("#add_btn").attr("disabled",true);
            },
            success:function(response){
                $("#contact_person").val("");
                $("#contact_details").val("");
                $("#mobile_no").val("");
                $("#remarks").val("");
                $("#date").val("");
                $("#add_btn").attr("disabled",false);
                $("#status_modal").modal("hide");
            },
            error: function(code) {   
                alert(code.statusText);
            },
          });
      });
    
    });
    
    function check_permission()
      {
          $.ajax({
              url : "check_add_permission",
              success:function(response)
              {
                  var obj = jQuery.parseJSON(response);
                 
                  if(obj.claim_edit === "0")
                  {
                      $("#cliam_plus").removeClass("hidden");
                      $("#cliam_com").removeClass("hidden");
                      $("#cliam_info").removeClass("hidden");
                      $("#cliam_edit").removeClass("hidden");
                  }
                  else
                  {
                      $("#cliam_plus").addClass("hidden");
                      $("#cliam_com").addClass("hidden");
                      $("#cliam_info").addClass("hidden");
                      $("#cliam_edit").addClass("hidden");
                      
                  }
              }
          });
      }
    
    
    function fetch_claims()
      {
         var status =  "0"; 
          
          var content = "";
          content += "<div class='table-responsive'>";
          content += "<table id='table_id' class='table table-hover table-bordered'>"; 
          content += "<thead><th>S.No</th><th>ClientName</th><th>PolicyNo</th><th>ClaimReferenceNo</th><th>DocumentReceiptDate</th><th>EstimatedLoss</th><th>DateofLoss</th><th>DoucmentSubmitted</th><th>User</th><th>Action</th></thead>";
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
                'url':'fetch_claims',
                'data':{status:status},
                'method':"POST",
              }
          });      
      }
     
     
     function fetch_complete_claim()
      {
          var status =  "1";
          
          var content = "";
          content += "<div class='table-responsive'>";
          content += "<table id='table_id' class='table table-hover table-bordered'>"; 
          content += "<thead><th>S.No</th><th>ClientName</th><th>PolicyNo</th><th>ClaimReferenceNo</th><th>DocumentReceiptDate</th><th>EstimatedLoss</th><th>DateofLoss</th><th>User</th><th>Status</th></thead>";
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
                'url':'fetch_complete_claim',
                'data':{status:status},
                'method':"POST",
                
              }
          });      
      }
     
      function claim_data(id)
      {
     
          $("#status_modal").modal("show");
          $("#status_id").val(id);
      } 
      
      
      
     function view_data(id, lead_id)
    {
        
        $.ajax({
                  url : "fetch_claim_contact_details",
                  method : "POST",
                  data : {id:id},
                  success:function(response)
                  {
                      $("#view_id").val(id);
                      $("#view_report").html(response);

                       if($('#view_report_modal').is(':visible'))
                       {
                           
                       }
                       else
                       {
                           $("#view_report_modal").modal("toggle");
                       }
                  }
        });
    }
    
    function complete_data(id)
    {
            $.ajax({
            url:"add_complete_claim",
            method:"POST",
            data:{id:id},
             success:function(response){
           alert("Successfully Claim complete");
              }
      });
}

   function policy_info_data(id,lead_id)
    {
        
        $.ajax({
                  url : "fetch_policy_info_details",
                  method : "POST",
                  data : {id:id,lead_id:lead_id},
                  success:function(response)
                  {
                      $("#policy_info_id").val(id);
                      $("#view_policy_info").html(response);

                       if($('#view_policy_info_modal').is(':visible'))
                       {
                           
                       }
                       else
                       {
                           $("#view_policy_info_modal").modal("toggle");
                       }
                  }
        });
    }
    
  
 
       
    </script>
