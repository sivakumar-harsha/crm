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
        Fixed Deposit Voucher
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
                  <label>Cash Balance</label>
                  <input type="text" class="form-control" name="cash_bal" id="cash_bal" disabled style="text-align:right;">
               </div>
               
                <div class = "form-group col-md-6">
                  <label>Date</label>
                  <input type = "date" class="form-control" name="date" id="date" value="<?php echo date("Y-m-d") ?>">
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
              </div>
              
        
            <div class = "form-group col-md-6">
                  <label>Amount</label>
                  <input type="number" class="form-control amount" name ="amount" id="amount">
              </div>
              
              
              <div class = "form-group col-md-6">
                  <label>Naration</label>
                  <textarea class="form-control" name = "narration" id="narration" rows="4"></textarea>
              </div>
              
          
               <div class = "form-group col-md-6">
                  <label>Payment Mode</label><br>
                    <input class="form-check-input" type="radio" name="pay_mode" id="pay_mode_cheque" value="Cheque">&nbsp;Cheque &nbsp;
                    <input class="form-check-input" type="radio" name="pay_mode" id="pay_mode_cash" value="Cash">&nbsp;Cash &nbsp;
                    <input class="form-check-input" type="radio" name="pay_mode" id="pay_mode_transfer" value="Transfer">&nbsp;Transfer
              </div>
              
                <div class = "form-group col-md-6 hidden" id="cash_relase_div">
                  <label>Cash Release</label><br>
                    <input class="form-check-input" type="radio" name="cash_release" id="cash_release_1" value="Petty_Cash">&nbsp;Petty Cash &nbsp;
                    <input class="form-check-input" type="radio" name="cash_release" id="cash_release_2" value="Main_Cash">&nbsp;Main Cash &nbsp;
              </div>
              
               <div class = "form-group col-md-6 hidden" id="bank_div">
                  <label>Bank</label>                  
                  <select class = "form-control select2" id="bank" name="bank" style='width:100%'>
                      <option value = "">--Select Bank--</option>
                        <?php foreach($account_number as $da){ ?>
                           <option value = "<?php echo $da->id ?>"><?php echo $da->bank_name . '('. $da->account_number.')'; ?></option>
                          <?php } ?>
                  </select>
               </div>
             
               <div class = "form-group col-md-6 hidden" id="branch_div">
                      <label>Branch</label>
                      <input type="text" class = "form-control" name="bank_branch" id="bank_branch">
                </div>
                
                <div class = "form-group col-md-6 hidden" id="cheque_div">
                      <label>Cheque No</label>
                       <select class = "form-control select2" id="cheque_no" name="cheque_no" style='width:100%'>
                      <option value = "">--Select--</option>
                        <?php foreach($cheque_number as $da){ ?>
                           <option value = "<?php echo $da->id ?>"><?php echo $da->vchcheque_character_no ?></option>
                          <?php } ?>
                  </select>
                </div>
                
                <div class = "form-group col-md-6 hidden" id="trans_div">
                      <label>Transaction No</label>
                      <input type="text" class = "form-control" name="transaction_no" id="transaction_no">
                </div>
                
                 <div class = "form-group col-md-6">
                      <label>Transaction Date</label>
                      <input type="date" class = "form-control" name="trans_date" id="trans_date">
                </div>

                  <div class="col-md-3">
                     <div class="form-check">
                       <input class="form-check-input" type="checkbox" value="yes" id="print_receipt">
                         <label class="form-check-label">Print Receipt</label>
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

          $("#bank").change(function(){                          
                $('#cheque_no').find('option').remove();
              
                var bank_id = $("#bank").val();                
                $.ajax({
                  url : "get_cheque_by_bank",
                  method : "POST",
                  data : {bank_id:bank_id},
                  success:function(response)
                  {
                      $("#cheque_no").html(response);
                  }
                });
          });
          
          fetch_cash_balance();
          
          $("#save_btn").click(function(){
             var account_head = $("#account_head").val();
             var sub_category = $("#sub_category").val();
             var amount = $("#amount").val();
             var date = $("#date").val();
             var narration = $("#narration").val();
             var paymode = $("input[name='pay_mode']:checked").val();
             var cash_release = $("input[name='cash_release']:checked").val();
             var bank = $("#bank").val();
             var bank_branch = $('#bank_branch').val();
             var cheque_no = $("#cheque_no").val();
             var transaction_no = $("#transaction_no").val();
             var trans_date = $("#trans_date").val();
             var print_receipt =  $('#print_receipt').is(':checked');
             
             if(account_head == "")
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
             else if(paymode == "")
             {
                 snackbar_show("Select Paymode");
             }
               else if((paymode == "Transfer" || paymode == "Cheque") && bank == "")
             {
                 snackbar_show("Select Bank");
             }
             else if((paymode == "Transfer" || paymode == "Cheque") && bank_branch == "")
             {
                 snackbar_show("Select Bank Branch");
             }
             else if(paymode == "Transfer" && transaction_no == "")
             {
                 snackbar_show("Select transaction no");
             }
             else if(paymode == "Cheque" && cheque_no == "")
             {
                 snackbar_show("Enter Cheque no");
             }
             else if(trans_date == "")
             {
                 snackbar_show("Select Transaction Date");
             }
             else
             {
                   $.ajax({
                            url : "add_fixed_deposit",
                            method : "POST",
                            data : {account_head:account_head,sub_category:sub_category,paymode:paymode,cash_release:cash_release,amount:amount,date:date,narration:narration,paymode:paymode,bank:bank,bank_branch:bank_branch,cheque_no:cheque_no,transaction_no:transaction_no,trans_date:trans_date},
                            beforeSend:function(){
                               $("#save_btn").attr("disabled",true);
                            },
                            success:function(resposne)
                            {
                                $("#save_btn").attr("disabled",false);
                                snackbar_show("Main Cash Payment Voucher Created Successfully");
                                if(print_receipt == "Yes")
                                {
                                    window.open("print_general_receipt?gr_no="+resposne+"", "_blank");
                                } else {
                                    window.location.reload();
                                }
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
