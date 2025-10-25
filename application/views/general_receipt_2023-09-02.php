 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1 style="font-size: 17px;"> 
        General Receipt <!--Main Cash Payment Voucher-->
      </h1>
    </section>
    
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
     <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>


    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-body">
       <div class="modal-body">
           
           <div class="row">
               <div class = "form-group col-md-6">
                  <label>Account Head</label>
                  <select class = "form-control select2" id="account_head" name="account_head" style='width:100%'>
                      <option value = "">--Select--</option>
                        <?php foreach($agentpayment_no as $da){ ?>
                           <option value = "<?php echo $da->sr_no ?>"><?php echo $da->name."(".$da->sr_no.")" ?></option>
                          <?php } ?>
                  </select>
              </div>
              
               <div class = "form-group col-md-6">
                  <label>Date</label>
                  <input type = "date" class="form-control" name="date" id="date" value="<?php echo date("Y-m-d") ?>">
               </div>
              
              
           </div>
           
            <div class="row">
            <div class = "form-group col-md-6">
                  <label>Bank Name</label>
                  <select class = "form-control select2" id="account_number" name="account_number" style='width:100%'>
                      <option value = "">--Select Bank--</option>
                        <?php foreach($account_number as $da){ ?>
                           <option value = "<?php echo $da->id ?>"><?php echo $da->bank_name . '('. $da->account_number.')'; ?></option>
                          <?php } ?>
                  </select>
              </div>
      
          
          
           <div class = "form-group col-md-6">
                  <label>Agent Bank</label>
                  <input type="text" class="form-control" name="agent_account_number" id="agent_account_number" disabled style="text-align:left;">
              </div>
          </div>
          
          <div class="row">
            <div class = "form-group col-md-6">
                  <label>Cash Balance</label>
                  <input type="text" class="form-control" name="cash_bal" id="cash_bal" disabled style="text-align:right;">
            </div>
            
            <div class = "form-group col-md-6">
                  <label>Amount</label>
                  <input type="number" class="form-control" name ="amount" id="amount">
            </div>
        </div>
            
         <div class="row">
             <div class = "form-group col-md-6">
                  <label>Payment Mode</label><br>
                    <input class="form-check-input" type="radio" name="pay_mode" id="pay_mode_cheque" value="Cheque">&nbsp;Cheque &nbsp;
                    <input class="form-check-input" type="radio" name="pay_mode" id="pay_mode_cash" value="Cash">&nbsp;Cash &nbsp;
                    <input class="form-check-input" type="radio" name="pay_mode" id="pay_mode_transfer" value="Transfer">&nbsp;Transfer
              </div>
              
            </div>  

              
                       <div class = "form-group col-md-6 hidden" id="cash_relase_div">
                  <label>Cash Release</label><br>
                    <input class="form-check-input" type="radio" name="cash_release" id="cash_release_1" value="Petty_Cash">&nbsp;Petty Cash &nbsp;
                    <input class="form-check-input" type="radio" name="cash_release" id="cash_release_2" value="Main_Cash">&nbsp;Main Cash &nbsp;
              </div>
              
               <div class = "form-group col-md-6 hidden" id="bank_div">
                  <label>Bank</label>
                    <select id="bank" name ="bank" class="form-control select2" required style="width:100%">
                                 <option value="">--select Bank--</option>
                                 <?php foreach($bank_name as $da){?>
                                    <option value="<?php echo $da->id ?>"><?php echo $da->bank_name ?></option>
                                            <?php } ?>
                             </select>
                   </div>
             
               <div class = "form-group col-md-6 hidden" id="branch_div">
                      <label>Branch</label>
                      <input type="text" class = "form-control" name="bank_branch" id="bank_branch">
                </div>
                
                <div class = "form-group col-md-6 hidden" id="cheque_div">
                      <label>Cheque No</label>
                      <select  class = "form-control" name="cheque_no" id="cheque_no"></select>
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
    </div>
</div>
         
    <script>
        
      $(document).ready(function(){
          
          
          $("#amount").keyup(function(){
              var amount = parseFloat(this.value);
              var bal = parseFloat($('#cash_bal').val());
              
              if(bal == 0){
                  this.value = "";
                  return;
              }
                
              
              if(bal > 0)
              {
                 if(bal < amount)
                 {
                     alert("less then of amount");
                     this.value = "";
                     return;
                 }
              }
              
          });
          

          
          
          $('#account_head').change(function() {
              var account_id = this.value;
              
              if(account_id){
                    $.ajax({
                       url:"getAccountInfo",
                       dataType: "json",
                       data:{
                           account_id:account_id
                       },
                       
                       success:function(response){
                           
                           var size = Object.keys(response).length;
                           if(size > 0){
                               $('#cash_bal').val(response.bal);
                               $('#agent_account_number').val(response.bank_name+"("+response.bank_acc_no+")");
                               
                           }
                       },
                       error:function(code){
                         snackbar_show(code.statusText);  
                       },
                    });
              }
          })
          
          $("#bank").change(function(){
              var select_bank = $("#bank").val();
              

                 $.ajax({
                            url : "fetch_bank_details",
                            method : "POST",
                            data : {select_bank:select_bank},
                            dataType : "json",
                            success:function(response)
                            {
                                //console.log(response['cheque']);
                                var size = Object.keys(response['cheque']).length;
                                //console.log(size);
                                var tag = $('#cheque_no');
                                tag.find('option').remove();
                                if( size > 0 ) {
                                    $.each(response['cheque'], function(index, data) {
                                       tag.append('<option value="'+data.id+'">'+data.vchcheque_character_no+'</option>')
                                    });
                                }
                                var obj = response;//jQuery.parseJSON(response);
                                
                                
                                //console.log(obj);
                                $("#bank_branch").val(obj.bankinfo[0].bank_branch);
                                },
                          });
                }); 
                
         
          
     $("#save_btn").click(function(){
        var account_head = $("#account_head").val();
        var accnumber = $("#account_number").val();
        var agent_account_number = $("#agent_account_number").val();
        var cash_bal =$("#cash_bal").val();
        var amount =$("#amount").val();
        var paymode = $("input[name='pay_mode']:checked").val();
        var cash_release = $("input[name='cash_release']:checked").val();
        var date = $("#date").val();
        var bank = $("#bank").val();
        var bank_branch = $('#bank_branch').val();
        var cheque_no = $("#cheque_no").val();
        var transaction_no = $("#transaction_no").val();
        var transaction_date =$("#transaction_date").val();
        var trans_date =$("#trans_date").val();
        
        
        
           if(accnumber == "")
             {
                 snackbar_show("Select Account Number");
             }
             else if(account_head == "")
             {
                 snackbar_show("Select Agent ID");
             }
             else if(agent_account_number == "")
             {
                 snackbar_show("Select Agent Account Number");
             }
             else if(amount == "")
             {
                 snackbar_show("Select amount");
             }
              else if(paymode == "")
             {
                 snackbar_show("Select Paymode");
             }
               else if((paymode == "Transfer" || paymode == "Cheque") && bank == "")
             {
                 snackbar_show("Select Bank");
             }
             else if(paymode == "Transfer" && transaction_no == "")
             {
                 snackbar_show("Select transaction no");
             }
             else if(paymode == "Cheque" && cheque_no == "")
             {
                 snackbar_show("Enter Cheque no");
             }
             else if(date == "")
             {
                 snackbar_show("Select  Date");
             }
             else if(transaction_date == "")
             {
                 snackbar_show("Select Transaction Date");
             }
             else
             {
                   $.ajax({
                            url : "add_agent_receipt",
                            method : "POST",
                            data : {accnumber:accnumber,agent_account_number:agent_account_number,paymode:paymode,cash_bal:cash_bal,amount:amount,date:date,cheque_no:cheque_no,transaction_no:transaction_no,transaction_date:transaction_date,bank:bank,bank_branch:bank_branch,cash_release:cash_release,trans_date:trans_date,account_head:account_head},
                            beforeSend:function(){
                               $("#save_btn").attr("disabled",true);
                            },
                            success:function(resposne)
                            {
                                $("#save_btn").attr("disabled",false);
                                snackbar_show("Agent Cash Payment Voucher Created Successfully");
                                if(print_receipt == "Yes")
                                {
                                    //window.open("print_general_receipt?gr_no="+resposne+"", "_blank");
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
      
      
      function get_agent_account_details(account_id)
      {
           $.ajax({
                            url : "get_agent_account_details",
                            dataType: "json",
                            data : {account_id:account_id},
                            success:function(response){
                               $('#agent_account_number').val(response.bal);
                          var size = Object.keys(response).length;
                           if(size > 0){
                               $('#cash_bal').val(response.bal);
                               get_agent_account_details(account_id);
                               
                           }
                             
                            },
           });
          
      }
      

    </script>       
         
         