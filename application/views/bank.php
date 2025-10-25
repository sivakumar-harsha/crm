<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1 style="font-size: 17px;">
        Bank
        <button data-toggle="modal" data-target="#add_model" class="btn btn-primary btn-sm pull-right">Add Bank</button>
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
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" style="color:white;">×</span></button>
                    <h4 class="modal-title text-center">Add Bank</h4>
                </div>
       
                <div class="modal-body">
                 <div class = "row">
                     <div class="form-group col-md-4">
                        <label>Bank Name</label>
                        <input type="text" class="form-control" id="add_bank" name="add_bank"> 
                    </div>
                         
                     <div class="form-group col-md-4">
                              <label>Bank Branch</label>
                              <input type="text" id="bank_branch" name ="bank_branch" class="form-control" >
                     </div>
                     
                      <div class="form-group col-md-4">
                         <label>Bank A/C No</label>
                        <input type="text" class="form-control" id="account_number" name="account_number">
                     </div>
                 </div>
           
                <div class = "row">
                    <div class="form-group col-md-4">
                       <label>IFSC Code</label>
                          <input type="text" id="ifsc_code" name ="ifsc_code" class="form-control" >
                    </div>
                    
                    <div class="form-group col-md-4">
                        <label> Door No </label> 
                        <input type="text" class="form-control" id="door_no" name="door_no"> 
                    </div>
                    
                    <div class="form-group col-md-4">
                        <label> Streat/ village</label> 
                        <input type="text" class="form-control" id="streat_village" name="streat_village"> 
                    </div>
                </div>
                  
                <div class = "row">
                     <div class="form-group col-md-6">
                        <label>ACC Opening date</label> 
                      <input type="date" class="form-control" id="acc_open_date" name="acc_open_date">
                    </div>
                    
                     <div class="form-group col-md-6">
                        <label>Accout Name</label> 
                      <input type="text" class="form-control" id="accout_name" name="accout_name">
                    </div>
               </div>
                
                  <div class="row">
                    <div class="form-group col-md-6">
                       <label> Over Draft limit</label>
                       <input type="number" class="form-control" id="over_draft_limit" name="over_draft_limit">
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
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" style="color:white;">×</span></button>
                    <h4 class="modal-title text-center">Edit Bank</h4>
                </div>
       
                <div class="modal-body">
                    <div class = "row">
                     <div class="form-group col-md-4">
                          <label>Bank Branch</label>
                              <input type="text" id="edit_bank_branch" name ="edit_bank_branch" class="form-control" >
                     </div>
        
               
                     <div class="form-group col-md-4">
                          <label>Bank Name</label>
                              <input type="text" class="form-control" id="edit_bank" name="edit_bank"> 
                         </div>
                         
                      <div class="form-group col-md-4">
                          <label>Bank A/C No</label>
                              <input type="text" class="form-control" id="edit_account_number" name="account_number"> 
                         </div>
                    </div>     
                         
                   <div class="row">      
                     <div class="form-group col-md-4">
                          <label>IFSC Code</label>
                          <input type="text" id="edit_ifsc_code" name ="edit_ifsc_code" class="form-control" >
                     </div>
                     
                      <div class="form-group col-md-4">
                        <label> Door No </label> 
                        <input type="text" class="form-control" id="edit_door_no" name="edit_door_no"> 
                    </div>
                    
                    <div class="form-group col-md-4">
                        <label> Streat/ village</label> 
                        <input type="text" class="form-control" id="edit_streat_village" name="edit_streat_village"> 
                    </div>
                  </div>
                  
                <div class = "row">
                     <div class="form-group col-md-6">
                        <label>ACC Opening date</label> 
                      <input type="date" class="form-control" id="edit_acc_open_date" name="acc_open_date">
                    </div>
                    
                     <div class="form-group col-md-6">
                        <label>Accout Name</label> 
                      <input type="text" class="form-control" id="edit_accout_name" name="accout_name">
                    </div>
               </div>
               
                  <div class="row">
                    <div class="form-group col-md-6">
                       <label> Over Draft limit</label>
                       <input type="number" class="form-control" id="edit_over_draft_limit" name="edit_over_draft_limit">
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
        fetch_bank();
        
        
  $("#add_btn").click(function(){
      
      var bank_branch = $("#bank_branch").val();
      var add_bank = $("#add_bank").val()
      var account_number = $("#account_number").val();
      var ifsc_code = $("#ifsc_code").val();
      var door_no = $("#door_no").val();
      var streat_village = $("#streat_village").val();
      var acc_open_date = $("#acc_open_date").val();
      var accout_name = $("#accout_name").val();
      var over_draft_limit = $("#over_draft_limit").val();
      
             if(bank_branch == "")
              {
                  snackbar_show("Enter Bank Branch ");
              }
              else if(add_bank == "")
              {
                  snackbar_show("Enter bank");
              }
              else if(account_number == "")
              {
                  snackbar_show("Enter Account Number");
              }
              else if(ifsc_code == "")
              {
                  snackbar_show("Enter IFSC CODE");
              }
              else if(door_no == "")
              {
                  snackbar_show("Enter Door NO");
              }
              else if(acc_open_date  == "")
              {
                  snackber_show("Enter ACCOUNT OPEN Date");
                  
              }
              else if(accout_name == "")
              {
                  snackber_show("Enter Accout Name");
              }
              else if(over_draft_limit == "")
              {
                  snackber_show("Enter Over Draft Limit");
              }
               
              
              else
                {
                  $.ajax({
                            url : "add_bank_details",
                            method : "POST",
                            data : {bank_branch:bank_branch,
                                    add_bank:add_bank,
                                    account_number:account_number,
                                    ifsc_code:ifsc_code,
                                    door_no:door_no,
                                    streat_village:streat_village,
                                    acc_open_date:acc_open_date,
                                    accout_name:accout_name,
                                    over_draft_limit:over_draft_limit
                                    
                            },
                            beforeSend:function(response){
                                $("#add_btn").attr("disabled",true);
                            },
                            success:function(response)
                            {
                                $("#add_btn").attr("disabled",false);
                                snackbar_show("Bank Details Stored Successfully..");
                                $("#add_model").modal("toggle");
                                fetch_bank();
                            }
                  });
              }
     
        });
        
        
    $("#edit_btn").click(function(){
      
      var bank_branch = $("#edit_bank_branch").val();
      var add_bank = $("#edit_bank").val()
      var account_number = $("#edit_account_number").val();
      var ifsc_code = $("#edit_ifsc_code").val();
      var door_no = $("#edit_door_no").val();
      var streat_village = $("#edit_streat_village").val();
      var acc_open_date = $("#edit_acc_open_date").val();
      var accout_name = $("#edit_accout_name").val();
      var over_draft_limit = $("#edit_over_draft_limit").val();
      var id = $("#edit_id").val();
      
             if(bank_branch == "")
              {
                  snackbar_show("Enter Bank Branch ");
              }
              else if(add_bank == "")
              {
                  snackbar_show("Enter bank");
              }
              else if(account_number == "")
              {
                  snackbar_show("Enter Account Number");
              }
              else if(ifsc_code == "")
              {
                  snackbar_show("Enter IFSC CODE");
              }
               else 
              {
                  $.ajax({
                            url : "edit_Bank_details",
                            method : "POST",
                            data : {id:id,
                                    bank_branch:bank_branch,
                                    add_bank:add_bank,
                                    account_number:account_number,
                                    ifsc_code:ifsc_code,
                                    door_no:door_no,
                                    streat_village:streat_village,
                                    acc_open_date:acc_open_date,
                                    accout_name:accout_name,
                                    over_draft_limit:over_draft_limit
                                 },
                            beforeSend:function(response){
                                $("#edit_btn").attr("disabled",true);
                            },
                            success:function(response)
                            {
                                $("#edit_btn").attr("disabled",false);
                                snackbar_show("Bank Details Stored Successfully..");
                                $("#edit_model").modal("toggle");
                                fetch_bank();
                            }
                  });
              }
       });
              
    
});

    function fetch_bank()
    {
      var content = "";
      content += "<div class='table-responsive'>";
      content += "<table id='table_id' class='table table-hover table-bordered'>"; 
      content += "<thead><th>S.No</th><th>Bank Branch</th><th>Bank Name</th><th>Account Number</th><th>Ifsc Code</th><th>Action</th></thead>";
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
            'url':'fetch_bank',
          }
      });      
    }
    
    
     function edit_data(id)
    {
      $.ajax({
        url:"fetch_edit_bank_dateils",
        data:{id:id},
        method:"POST",
        success:function(response){
          // alert(response);
          var obj = jQuery.parseJSON(response);
          $("#edit_bank_branch").val(obj.bank_branch);
          $("#edit_bank").val(obj.bank_name);
          $("#edit_account_number").val(obj.account_number);
          $("#edit_ifsc_code").val(obj.ifsc_code);
          $("#edit_door_no").val(obj.door_no);
          $("#edit_streat_village").val(obj.streat_village);
          $("#edit_acc_open_date").val(obj.acc_open_date);
          $("#edit_accout_name").val(obj.accout_name);
          $("#edit_over_draft_limit").val(obj.over_draft_limit);
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
          url:"delete_bank_details",
          data:{id:id},
          method:"POST",
          success:function(response){
            //alert(response);

            fetch_bank();
          },
          error: function(code) {   
            alert(code.statusText);
          },
        });
      }
    }
    
    
</script>

      
      