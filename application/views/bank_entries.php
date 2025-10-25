<style>
   /* 2023-08-12 */
    .amount {
      text-align: right;
    }
  </style>
 
 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1 style="font-size: 17px;">
        Direct Debit / Credit in Bank Statement
      </h1> 
    </section>
    
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
     <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>


    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-body">
            
         <div class= "row">
                <div class = "form-group col-md-6">
                  <label>Voucher No.</label>
                  <input type="text" class="form-control" name="voucher_no" id="voucher_no" value="1/23">
               </div>
               
                <div class = "form-group col-md-6">
                  <label>Date</label>
                  <input type = "date" class="form-control" name="date" id="date" value="<?php echo date("Y-m-d") ?>">
               </div>

               <div class = "form-group col-md-6">
                    <label>Accountable</label><br>
                    <input class="form-check-input" type="radio" name="dr_cr" id="dr_cr_1" value="DR">&nbsp;<label for="dr_cr_1">Debit</label> &nbsp;
                    <input class="form-check-input" type="radio" name="dr_cr" id="dr_cr_2" value="CR">&nbsp;<label for="dr_cr_2">Credit</label> &nbsp;
                </div>

               <div class = "form-group col-md-6">
                  <label>Bank</label>                  
                  <select class = "form-control select2" id="bank" name="bank" style='width:100%'>
                      <option value = "">--Select Bank--</option>
                        <?php foreach($account_number as $da){ ?>
                           <option value = "<?php echo $da->id ?>"><?php echo $da->bank_name . '('. $da->account_number.')'; ?></option>
                          <?php } ?>
                  </select>
               </div>

              <div class = "form-group col-md-6">
                  <label>Account Head</label>
                  <select class = "form-control select2" id="account_head" name="account_head" style='width:100%'>
                      <option value = "">--Select--</option>
                        <?php foreach($account_head as $da){ ?>
                           <option value = "<?php echo $da->vchaccid ?>"><?php echo $da->vchaccname ?></option>
                          <?php } ?>
                  </select>
              </div>
              

                <div class = "form-group col-md-6">
                  <label>Sub Category</label>
                  <select class = "form-control select2" name ="sub_category" id="sub_category">
                      <option value = "">--Select Sub Category--</option>
                  </select>
              </div>
              
              
        
            <div class = "form-group col-md-6">
                  <label>Amount</label>
                  <input type="number" class="form-control amount" name ="amount" id="amount">
              </div>
              
              
              <div class = "form-group col-md-6">
                  <label>Naration</label>
                  <textarea class="form-control" name = "narration" id="narration" rows="4"></textarea>
              </div>
              
                                        

                  <div class="col-md-3">
                     <div class="form-check">
                       <input class="form-check-input" type="checkbox" value="yes" id="print_receipt">
                         <label for="print_receipt" class="form-check-label">Print Receipt</label>
                     </div>
                  </div>
                   <button type="button" class="btn btn-sm btn-primary pull-left" id="save_btn">Save</button>&nbsp;
                    <button type="button" class="btn btn-sm btn-default">Clear</button> 
               </div>                
         </div>
           
            
          
        </div><!-- /.box-body -->        
      </div><!-- /.box -->

    </section><!-- /.content -->
  </div><!-- /.content-wrapper -->
  
  
  <script>
      
      $(document).ready(function(){
         
          $('.select2').select2();
          
          
        //   $("#account_head").change(function(){
       
        //         var account_head = $("#account_head").val();
                 
        //          $.ajax({
        //                     url : "get_particulars_by_account_head",
        //                     method : "POST",
        //                     data : {account_head:account_head},
        //                     success:function(response)
        //                     {
        //                         $("#sub_category").html(response);
        //                     }
        //          });
              
        //   });
          
          
          
           $("#account_head").change(function(){
                var account_head = $("#account_head").val();

                 $.ajax({
                            url : "get_particulars_by_account_head",
                            method : "POST",
                            data : {account_head:account_head},
                            success:function(response)
                            {
                                $("#sub_category").html(response);
                            }
                 });
          });

          
          
          $("#save_btn").click(function(){
             var account_head = $("#account_head").val();
             var sub_category = $("#sub_category").val();
             var amount = $("#amount").val();
             var date = $("#date").val();
             var narration = $("#narration").val();             
             var dr_cr = $("input[name='dr_cr']:checked").val();
             var bank = $("#bank").val();             
             var voucher_no = $("#voucher_no").val();             
             var print_receipt =  $('#print_receipt').is(':checked');
             
             if(dr_cr == "" || typeof dr_cr === 'undefined')
             {
                 snackbar_show("Select Debit or Credit");
             }
             else if(bank == "")
             {
                 snackbar_show("Select Bank");
             }
             else if(account_head == "")
             {
                 snackbar_show("Select Account Head");
             }
             else if(date == "")
             {
                 snackbar_show("Select Date");
             }
             else if(sub_category == "")
             {
                 snackbar_show("Select sub_category");
             }
             else if(narration == "")
             {
                 snackbar_show("Enter Narration");
             }
             
             
             else if(voucher_no == "")
             {
                 snackbar_show("Enter the Voucher No.");
             }             
             else
             {
                   $.ajax({
                            url : "add_bank_entries",
                            method : "POST",
                            data : {
                                account_head:account_head,
                                sub_category:sub_category,
                                dr_cr:dr_cr,                                
                                amount:amount,
                                date:date,
                                narration:narration,
                                bank:bank,
                                voucher_no:voucher_no,                                
                            },
                            beforeSend:function(){
                               $("#save_btn").attr("disabled",true);
                            },
                            success:function(resposne)
                            {
                                $("#save_btn").attr("disabled",false);
                                snackbar_show("Direct Bank Voucher Created Successfully");
                                if(print_receipt == "Yes")
                                {
                                    window.open("print_general_receipt?gr_no="+resposne+"", "_blank");
                                }

                                window.location.href = 'bank_entries';
                            }
                    });
             }
          });
        
          
          

          
          $("input[name='pay_mode'").change(function(){
                var paymode = $("input[name='pay_mode']:checked").val();
                
                 if(paymode == "Cash")
                 {
                     $("#bank_div").addClass("hidden");
                     $("#branch_div").addClass("hidden");
                     $("#cheque_div").addClass("hidden");
                     $("#trans_div").addClass("hidden");
                     $("#cash_relase_div").removeClass("hidden");
                 }
                 else if(paymode == "Cheque")
                 {
                     $("#bank_div").removeClass("hidden");
                     $("#branch_div").removeClass("hidden");
                     $("#cheque_div").removeClass("hidden");
                     $("#trans_div").addClass("hidden");
                     $("#cash_relase_div").addClass("hidden");
                     $("input[name='cash_release']").prop("checked", false);
                 }
                 else if(paymode == "Transfer")
                 {
                     $("#bank_div").removeClass("hidden");
                     $("#branch_div").removeClass("hidden");
                     $("#cheque_div").addClass("hidden");
                     $("#trans_div").removeClass("hidden");
                     $("#cash_relase_div").addClass("hidden");
                     $("input[name='cash_release']").prop("checked", false);
                 }
          });
      });
      
      function fetch_cash_balance()      
      {
          $.ajax({
                  url : "fetch_cash_balance",
                  success:function(response)
                  {
                      var obj = jQuery.parseJSON(response);
                      $("#cash_bal").val(obj.numaccbalance);
                  }
          });
      }

      function fetch_cheque_bank()      
      {
          $.ajax({
                  url : "fetch_cash_balance",
                  success:function(response)
                  {
                      var obj = jQuery.parseJSON(response);
                      $("#cash_bal").val(obj.numaccbalance);
                  }
          });
      }
  </script>
