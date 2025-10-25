<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1 style="font-size: 17px;">
        Cheque Book
        <button data-toggle="modal" data-target="#add_model" class="btn btn-primary btn-sm pull-right">Add</button>
      </h1>
    </section>

    <!-- Main content -->
     <section class="content">
      <div class="box">
         <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li class="active" id="businesscall_id"><a href="#tab_1" data-toggle="tab" aria-expanded="true" onclick="fetch_cheque_details()">Cheque Book Entry</a></li>
             
                <li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false" onclick="fetch_book_entry_details()">Cheque Status</a></li>
                 
                  <!--<li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false" onclick="fetch_using_cheque_details()">Using Cheque</a></li>-->
              
            </ul>
        </div>
        <div class="box-body">
          <div id="table_view"></div>
        </div>   
      </div>
    </section>
  </div><!-- /.content-wrapper -->
  
  
  
   <div class="modal fade in" id="add_model">
        <div class="modal-dialog ">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" style="color:white;">×</span></button>
                    <h4 class="modal-title text-center">Add Cheque</h4>
                </div>
                 <div class="modal-body">
                     
                       <div class="form-group">
                              <label>Date</label>
                              <input type="date" id="add_date" name ="add_date" class="form-control" >
                     </div>
                     <div class = "row">
                     
                     <div class="form-group col-md-6">
                        <label>Bank list</label>
                       <select id="select_bank" name ="select_bank" class="form-control select2" required style="width:100%">
                                 <option value="">--select Bank--</option>
                                 <?php foreach($bank_name as $da){?>
                                    <option value="<?php echo $da->id ?>"><?php echo $da->bank_name ?></option>
                                            <?php } ?>
                             </select>
                    </div>
                    
                     <div class="form-group col-md-6">
                              <label>Book ID</label>
                              <input type="text" id="book_id" name ="book_id" class="form-control" >
                     </div>
                 </div>
                 

                 <div class="row">
                       <div class="form-group col-md-6">
                              <label>Bank</label>
                              <input type="text" id="add_bank2" name ="add_bank2" class="form-control" >
                     </div>
                     
                       <div class="form-group col-md-6">
                              <label>Location</label>
                              <input type="text" id="add_location" name ="add_location" class="form-control" >
                     </div>
                 </div>
                 
                 <div class="row">
                     <div class="form-group col-md-6">
                         <label>Account Number</label>
                         <input type="text" id="account_number" name="account_number" class="form-control">
                     </div>
                     
                 </div>
                 
                 
                  <div class="form-group">
                      <label>No Of Cheque</label>
                      <input type="text" id="no_of_cheque" name ="no_of_cheque" class="form-control" >
                  </div>
                 
                 
                 <div>
                      <label style="color:#DC143C">Cheque No :</label>
                 </div>
                 
                 <div class="row">
                       <div class="form-group col-md-6">
                              <label>From</label>
                              <input type="text" id="cheque_from_date" name ="cheque_from_date" class="form-control" >
                     </div>
                     
                     
                     <div class="form-group col-md-6">
                              <label>To</label>
                              <input type="text" id="cheque_to_date" name ="cheque_to_date" class="form-control" >
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
        <div class="modal-dialog ">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" style="color:white;">×</span></button>
                    <h4 class="modal-title text-center">Add Cheque</h4>
                </div>
                 <div class="modal-body">
                     
                       <div class="form-group">
                              <label>Date</label>
                              <input type="date" id="edit_date" name ="edit_date" class="form-control" >
                     </div>
                     <div class = "row">
                     
                     <div class="form-group col-md-6">
                        <label>Bank list</label>
                       <select id="edit_select_bank" name ="edit_select_bank" class="form-control select2" required style="width:100%">
                                 <option value="">--select Bank--</option>
                                 <?php foreach($bank_name as $da){?>
                                    <option value="<?php echo $da->id ?>"><?php echo $da->bank_name ?></option>
                                            <?php } ?>
                             </select>
                    </div>
                    
                     <div class="form-group col-md-6">
                              <label>Book ID</label>
                              <input type="text" id="edit_book_id" name ="edit_book_id" class="form-control" >
                     </div>
                 </div>
                 

                 <div class="row">
                       <div class="form-group col-md-6">
                              <label>Bank</label>
                              <input type="text" id="edit_bank2" name ="edit_bank2" class="form-control" >
                     </div>
                     
                       <div class="form-group col-md-6">
                              <label>Location</label>
                              <input type="text" id="edit_location" name ="edit_location" class="form-control" >
                     </div>
                 </div>
                 
                 <div class="row">
                     <div class="form-group col-md-6">
                         <label>Account Number</label>
                         <input type="text" id="edit_account_number" name="edit_account_number" class="form-control">
                     </div>
                     
                 </div>
                 
                 
                  <div class="form-group">
                      <label>No fo cheque</label>
                      <input type="text" id="edit_no_of_cheque" name ="edit_no_of_cheque" class="form-control" >
                  </div>
                 
                 
                 <div>
                      <label style="color:#DC143C">Cheque No :</label>
                 </div>
                 
                 <div class="row">
                       <div class="form-group col-md-6">
                              <label>From</label>
                              <input type="text" id="edit_cheque_from_date" name ="edit_cheque_from_date" class="form-control" >
                     </div>
                     
                     
                     <div class="form-group col-md-6">
                              <label>To</label>
                              <input type="text" id="edit_cheque_to_date" name ="edit_cheque_to_date" class="form-control" >
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
      
      
      
       <div class="modal fade in" id="status_modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true" style="color:white;">×</span></button>
                <h4 class="modal-title text-center" id="cheque_name"></h4>
            </div>
            <div class="modal-body">
             <div class="row">
                 <div class="form-group col-md-6">
                  <label>Bank Details</label>
                  <input type="text" class="form-control" id="Bank_name_cheque" disabled>
                </div>
                
                <div class="form-group col-md-6">
                  <label>Using voucher </label> 
                  <input type="text" class="form-control" id="using_voucher" disabled>
                </div>
          </div>          
                
                <div class="form-group">
                  <label>Cheque Using Date</label> 
                  <input type="date" class="form-control" id="cheque_using_date" disabled>
                </div>

                <div class="form-group">
                  <label>Cheque Date</label> <span id="add_chequedate_error" style="color: red;">*</span>
                  <input type="date" class="form-control" id="cheque_date">
                </div>
                
                 <div class="form-group">
                    <div class="row">   
                       <div class="col-md-4">
                            <label>Cheque Status</label>
                       </div>
                         <div class="col-md-8">
                             <input type="radio" class="form-check-input" value="Cheque Passed" name="cheque_status" id="cheque_passed" >
                              <label> Cheque Passed</label>
                              <input type="radio" class="form-check-input" value="Cheque Returned"  name="cheque_status" id="cheque_returned" >
                              <label>Cheque Returned</label>
                              <input type="radio" class="form-check-input"  value="Cheque Cancalled"  name="cheque_status" id="cheque_cancalled" >
                             <label>Cheque Cancalled</label>
                         </div>
                    </div>
                </div>
                
                
                <div class="form-group hidden" id="cheque_reason_div">
                  <label>Cheque Returned Reason</label> <span id="add_interview_error" style="color: red;">*</span>
                   <textarea type="text" class="form-control" name="Returned_reason" id="Returned_reason" rows="2"></textarea>
                </div>
 
           </div>
           
            <div class="modal-footer"id="status_id">
                <button type="button" class="btn btn-sm btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-sm btn-primary" id="status_btn">Submit</button>
            </div>
        </div>
    </div>
  </div>
      
      
      
      
      <script>
          
     $(document).ready(function(){
         fetch_cheque_details();
       
         $("#cheque_from_date").keyup(function() {
             var noof = parseFloat($('#no_of_cheque').val()) - 1;
             var val = parseFloat($(this).val());
             $('#cheque_to_date').val((noof + val));
         })
         
          $("#edit_cheque_from_date").keyup(function() {
             var noof = parseFloat($('#edit_no_of_cheque').val()) - 1;
             var val = parseFloat($(this).val());
             $('#edit_cheque_to_date').val((noof + val));
         })
         
         $("input[name='cheque_status']").click(function() {
             var status = $('input:radio[name=cheque_status]:checked').val();
             if(status == "Cheque Passed"){
                $("#cheque_reason_div").addClass("hidden");
             } else if(status == 'Cheque Returned') {
                $("#cheque_reason_div").removeClass("hidden");
            }else if(status== 'Cheque Cancalled') {
                $("#cheque_reason_div").addClass("hidden");
            }
         });
         
       

         $("#select_bank").change(function(){
              var select_bank = $("#select_bank").val();
              

                 $.ajax({
                            url : "fetch_bank_details",
                            method : "POST",
                            data : {select_bank:select_bank},
                            dataType : "json",
                            success:function(response)
                            {
                                var obj = response;//jQuery.parseJSON(response);
                                
                                console.log(obj);
                                $("#add_bank2").val(obj.bankinfo[0].bank_name);
                                $("#add_location").val(obj.bankinfo[0].bank_branch);
                                $("#account_number").val(obj.bankinfo[0].account_number);
                                },
                          });
                });
                
          $("#edit_select_bank").change(function(){
              var select_bank = $("#edit_select_bank").val();
              

                 $.ajax({
                            url : "fetch_bank_details",
                            method : "POST",
                            data : {select_bank:select_bank},
                            dataType : "json",
                            success:function(response)
                            {
                                var obj = response;//jQuery.parseJSON(response);
                                
                                console.log(obj);
                                $("#edit_bank2").val(obj[0].bank_name);
                                $("#edit_location").val(obj[0].bank_branch);
                                $("#edit_account_number").val(obj[0].account_number);
                                },
                          });
                });            
                
        
         $("#add_btn").click(function(){
             
             var select_bank = $("#select_bank").val();
             var date = $("#add_date").val();
             var book_id = $("#book_id").val();
             var location = $("#add_location").val();
             var bank = $("#add_bank2").val();
             var account_number = $("#account_number").val();
             var no_of_cheque = $("#no_of_cheque").val();
             var cheque_from_date = $("#cheque_from_date").val();
             var cheque_to_date = $("#cheque_to_date").val();
             
             
             if(select_bank == "")
              {
                  snackbar_show(" Select of Bank");
              }
              else if(date == "")
              {
                  snackbar_show("Enter Date");
              }
              else if(book_id == "")
              {
                  snackber_show("Enter Bank ID");
              }
             else if(location == "")
              {
                  snackber_show("Enter Location");
              }
             else if(bank == "")
              {
                  snackber_show("Enter Bank");
              }
             else if(no_of_cheque == "")
              {
                  snackber_show("Enter NO Of Cheque");
              }
             else if(cheque_from_date == "")
              {
                  snackber_show("Enter From Date");
              }
            else if(cheque_to_date == "")
              {
                  snackber_show("Enter To Date");
              }
              
            else
                {
                  $.ajax({
                            url : "add_cheque_book_details",
                            method : "POST",
                            data : {
                                    select_bank:select_bank,
                                    date:date,
                                    book_id:book_id,
                                    location:location,
                                    bank:bank,
                                    account_number:account_number,
                                    no_of_cheque:no_of_cheque,
                                    cheque_from_date:cheque_from_date,
                                    cheque_to_date:cheque_to_date
                            },
                            beforeSend:function(response){
                                $("#add_btn").attr("disabled",true);
                            },
                            success:function(response)
                            {
                                $("#add_btn").attr("disabled",false);
                                snackbar_show("CHEQUE Details Stored Successfully..");
                                $("#add_model").modal("toggle");
                                fetch_cheque_details();
                            }
                  });
              }
            
        });
        


       $("#edit_btn").click(function(){
             
             var select_bank = $("#edit_select_bank").val();
             var date = $("#edit_date").val();
             var book_id = $("#edit_book_id").val();
             var location = $("#edit_location").val();
             var bank = $("#edit_bank2").val();
             var account_number = $("#edit_account_number").val();
             var no_of_cheque = $("#edit_no_of_cheque").val();
             var cheque_from_date = $("#edit_cheque_from_date").val();
             var cheque_to_date = $("#edit_cheque_to_date").val();
             var id = $("#edit_id").val();
             
             
             if(select_bank == "")
              {
                  snackbar_show(" Select of Bank");
              }
              else if(date == "")
              {
                  snackbar_show("Enter Date");
              }
              else if(book_id == "")
              {
                  snackber_show("Enter Bank ID");
              }
             else if(location == "")
              {
                  snackber_show("Enter Location");
              }
             else if(bank == "")
              {
                  snackber_show("Enter Bank");
              }
             else if(no_of_cheque == "")
              {
                  snackber_show("Enter NO Of Cheque");
              }
             else if(cheque_from_date == "")
              {
                  snackber_show("Enter From Date");
              }
            else if(cheque_to_date == "")
              {
                  snackber_show("Enter To Date");
              }
              
            else
                {
                  $.ajax({
                            url : "edit_cheque_book_details",
                            method : "POST",
                            data : {
                                    select_bank:select_bank,
                                    date:date,
                                    book_id:book_id,
                                    location:location,
                                    bank:bank,
                                    account_number:account_number,
                                    no_of_cheque:no_of_cheque,
                                    cheque_from_date:cheque_from_date,
                                    cheque_to_date:cheque_to_date,
                                    id:id,
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
        
        
          $("#status_btn").click(function(){
              
                  
                   var cheque_date = $("#cheque_date").val();
                   var cheque_status = $("input[name='cheque_status']").val();
                   var Returned_reason = $("#Returned_reason").val();
                   var id  = $("#status_id").val();
                   
            if(cheque_date == "")
              {
                  snackbar_show(" Select of Date");
              }
            else if(cheque_status == "")
              {
                  snackber_show("Select of Cheque Status")
              }
              else
                {
              
                $.ajax({
            url:"add_cheque_status",
            method:"POST",
            data:{cheque_date:cheque_date,cheque_status:cheque_status,Returned_reason:Returned_reason,id:id},
             beforeSend:function(){
                $("#status_btn").attr("disabled",true);
            },
             success:function(response){
                // alert(response);
                fetch_book_entry_details();
                $("#cheque_date").val("");
                $("#cheque_status").val("");
               $("#status_btn").attr("disabled",false);
                $("#status_modal").modal("hide");

            }
            
            });
                }
              
              
          });
        
        
        
     });
     

      function fetch_cheque_details()
    {
      var content = "";
      content += "<div class='table-responsive'>";
      content += "<table id='table_id' class='table table-hover table-bordered'>"; 
      content += "<thead><th>S.No</th><th> Book Date</th><th>Bank Name</th><th>No Of Cheque</th><th>From</th><th>To</th><th>Action</th></thead>";
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
            'url':'fetch_cheque_details',
          }
      });      
    }
    
    
    
    
     function fetch_book_entry_details()
    {
      var content = "";
      content += "<div class='table-responsive'>";
      content += "<table id='table_id' class='table table-hover table-bordered'>"; 
      content += "<thead><th>S.No</th><th>Bank Name</th><th>Cheque Number</th><th>Status</th><th>Using</th><th>Cheque Status</th><th>Remarks</th><th>Action</th></thead>";
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
            'url':'fetch_book_entry_details',
          }
      });      
    }
    
    
  function fetch_using_cheque_details()
    {
      var content = "";
      content += "<div class='table-responsive'>";
      content += "<table id='table_id' class='table table-hover table-bordered'>"; 
      content += "<thead><th>S.No</th><th>Bank Name</th><th>Cheque Number</th><th>Amount</th><th>Using</th><th>Status</th></thead>";
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
            'url':'fetch_using_cheque_details',
          }
      });      
    }
  

    
  function edit_data(id)
   {
      $.ajax({
        url:"fetch_edit_cheque_details",
        data:{id:id},
        method:"POST",
        success:function(response){
          // alert(response);
          var obj = jQuery.parseJSON(response);
          $("#edit_date").val(obj.data);
          $("#edit_select_bank").val(obj.bank_id);
          $("#edit_book_id").val(obj.book_id);
          $("#edit_bank2").val(obj.bank);
          $("#edit_location").val(obj.location);
          $("#edit_account_number").val(obj.account_number);
          $("#edit_no_of_cheque").val(obj.no_of_cheque);
          $("#edit_cheque_from_date").val(obj.cheque_from_date);
          $("#edit_cheque_to_date").val(obj.cheque_to_date);
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
          url:"delete_cheque_details",
          data:{id:id},
          method:"POST",
          success:function(response){
      //      alert(response);

            fetch_cheque_details();
          },
          error: function(code) {   
            alert(code.statusText);
          },
        });
      }
    }
        
   function generate_cheque_data(id)
   {
       if(confirm("Are you Confirm to Generate Cheque"))
      {
         $.ajax({
          url:"generate_cheque_book",
          data:{id:id},
          method:"POST",
          success:function(response){
            //alert(response);

            fetch_cheque_details();
          },
          error: function(code) {   
            alert(code.statusText);
          },
        });
      }
   }
   
   function cheque_info_data(id)
   {
       
       $.ajax({
        url:"fetch_cheque_info_data",
        data:{id:id},
        method:"POST",
        success:function(response){
          // alert(response);
          var obj = jQuery.parseJSON(response);
          $("#cheque_name").html("Cheque Details -"+obj.vchcheque_character_no);
          $("#Bank_name_cheque").val(obj.bank_name +" / " +obj.account_number);
          $("#using_voucher").val(obj.usingacc);
          $("#cheque_using_date").val(obj.cheque_using_date);
          $("#cheque_date").val(obj.cheque_date);
          $("#status_modal").modal("show");
          $("#status_id").val(id);
        },
        error: function(code) {   
            alert(code.statusText);
        },
      });
      
    }
      
         
      </script>