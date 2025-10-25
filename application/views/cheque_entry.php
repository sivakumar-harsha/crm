<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <h1 style="font-size: 17px;"> 
         Cheque Entry Details
      </h1>
   </section>
   <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
   <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
   <section class="content">
      <!-- Default box -->
      <div class="box">
         <div class="box-body">    
            <div class="row">
                <div class = "form-group col-md-6">
                  <label>Cheque Number</label>
                  <!-- <input type="text" class="form-control" name="cheque_number" id="cheque_number"> -->
                  <select id="cheque_number" name ="cheque_number" class="form-control select2" required style="width:100%">
                     <option value="">Select</option>
                     <?php foreach($receiptlist as $row){ ?>
                     <option value="<?php echo $row->cheque_no ?>"><?php echo $row->receipt_no .' / CHQ. '. $row->cheque_no ?></option>
                     <?php } ?>
                  </select>
               </div>
               <div class = "form-group col-md-6">
                  <label> Date</label>
                  <input type = "date" class="form-control" name="date" id="date"  readonly value="<?php /*echo date("Y-m-d")*/ ?>">
               </div>

               <div class = "form-group col-md-6">
                  <label>Bank Name</label>          
                  <input type = "text" class="form-control" name="bank_name" readonly id="bank_name" value="">                         
               </div>

               <div class="from-group col-md-6">
                  <label>Amount </label>
                  <input type="text" class="form-control" name="add_amount" readonly id="add_amount">
               </div>
               
            </div>        
            <div class= "row">
                                                            
               <!-- <div class = "form-group col-md-6">
                  <label>Balance Amount</label>
                  <input type="number" class="form-control" name ="balance_amount" id="balance_amount">
                  </div> -->
               <div class = "form-group col-md-6">
                  <label>Deposite Date</label>
                  <input type="date" class = "form-control" name="depostite_date" id="depostite_date">
               </div>
               <div class = "form-group col-md-6">
                  <label>Status</label>
                  <select class="form-control" name="cheque_status" id="cheque_status">
                     <option></option>
                     <option value="Passed">Cheque Passed</option>
                     <option value="Bounced">Cheque Bounced</option>
                     <option value="Cancelled">Cheque Cancelled</option>
                  </select>
               </div>
               <div class = "form-group col-md-6">
                  <label>Clear Date</label>
                  <input type="date" class = "form-control" name="clear_date" id="clear_date">
               </div>
               <div class = "form-group col-md-6">
                  <label>Remarks</label>
                  <textarea class = "form-control" name="remarks" id="remarks"></textarea>
               </div>
               <div class="col-md-6 btns" >
                      <!-- 
                  <div class="form-check ">
                    <input class="form-check-input" type="checkbox" value="yes" id="print_receipt">
                      <label class="form-check-label">Print Receipt</label>
                  </div>
                  //-->
                  <div >
                    <button type="button" class="btn btn-sm btn-primary" id="save_btn">Update</button>&nbsp;
                    <button type="button" class="btn btn-sm btn-default">Clear</button> 
                  </div>
                </div> 
               
            </div>
         </div>
      </div>
      <!-- /.box-body -->        
</div>
<!-- /.box -->
</section><!-- /.content -->
</div><!-- /.content-wrapper -->
<script>
  function resetFields(txt)
  {
    if(txt == "Y") {      
      $("#cheque_number").val(null).trigger("change");
    }
    $("#bank_name").val("");
    $("#date").val("");
    $("#clear_date").val("");
    $("#depostite_date").val("");
    $('#add_amount').val("");
    $('#cheque_status').val("");
    $('#remarks').val('');


  }
   $(document).ready(function(){
    $('.select2').select2();
   
      $('#cheque_number').change(function() {
            var cheque_number = this.value;
            $('.btns').show();
            resetFields("");
            if(cheque_number){
                  $.ajax({
                     url:"received_cheque_Info",
                     dataType: "json",
                     data:{
                        cheque_number:cheque_number
                     },
                     
                     success:function(response){                           
                         var size = Object.keys(response).length;
                         
                         if(size > 0){
                             $('#date').val(response[0].transdate);
                             $('#bank_name').val(response[0].bank_name);
                             $('#add_amount').val(response[0].amount);
                             $('#depostite_date').val(response[0].depostdate);
                             $('#clear_date').val(response[0].clrdate);
                             $('#remarks').val(response[0].remarks);
                             $('#cheque_status').val(response[0].cheque_status);

                            
                             
                             if(response[0].cheque_status != null) {
                              $('.btns').hide();
                             } else {
                              $('.btns').show();
                             }
                         }
                     },
                     error:function(code){
                       snackbar_show(code.statusText);  
                     },
                  });
            }
        })
              
      $("#save_btn").click(function(){
          
          var cheque_number = $("#cheque_number").val();
          var date = $("#date").val();
          var bank_name = $("#bank_name").val();
          var add_amount = $("#add_amount").val();
          //var balance_amount = $("#balance_amount").val();
          var depostite_date = $("#depostite_date").val();
          var clear_date = $("#clear_date").val();
          var status = $("#cheque_status").val();
          var remarks = $('#remarks').val();
          
           if(cheque_number == "")
           {
               snackbar_show("Enter Cheque Number");
           }
           else if(bank_name == "")
           {
               snackbar_show("Enter Bank Name");
           }
           else if(add_amount == "")
           {
               snackbar_show("Enter Amount");
           }             
           else if(depostite_date == "")
           {
               snackbar_show("Enter Depostite Date");
           }
           else if(clear_date == "")
           {
               snackbar_show("Enter Clear Date");
           }
           else if(status == "")
           {
               snackbar_show("Select Status");
           }             
          else 
          {
          $.ajax({
          url:"update_cheque_entry",
          method:"POST",
          data : {
                   cheque_number:cheque_number,                    
                   status:status,
                   clear_date:clear_date,
                   depostite_date:depostite_date,
                   remarks: remarks,
                 },
          beforeSend:function(){
             $("#save_btn").attr("disabled",true);
          },
          success:function(response){
              resetFields("Y");
              $("#save_btn").attr("disabled",false);
              snackbar_show("Cheque Entry Updated Successfully");
            //   if(print_receipt == "Yes")
            //   {
            //       //window.open("print_general_receipt?gr_no="+resposne+"", "_blank");
            //   }
          },
          error: function(code) {   
              alert(code.statusText);
          },
   
    });
           
           
      }
      
   });
   });
              
    
</script>