<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>


 <style>
    
        label 
        {
            font-weight:unset !important;
        }
      
                
        .btn {
            border-radius: 8px;
            -webkit-box-shadow: none;
            box-shadow: none;
            border: 1px solid transparent;
        }
                
        .select2-container--default .select2-selection--multiple .select2-selection__choice {
            background-color: #337ab7 !important;
            border: 1px solid #fff;
            border-radius: 4px;
            cursor: default;
            color: #fff;
            float: left;
            margin-right: 5px;
            margin-top: 5px;
            padding: 0 5px;
        }
        
        .select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
            color: #fff !important;
            cursor: pointer;
            display: inline-block;
            font-weight: bold;
            margin-right: 2px;
        }
        
     
        
        
           .form-control {
    display: block;
    width: 100%;
    height: 29px;
    padding: 4px 10px;
    font-size: 14px;
    line-height: 1.42857143;
    color: #555;
    background-color: #fff;
    background-image: none;
    border: 1px solid #ccc;
    border-radius: 4px;
    -webkit-box-shadow: inset 0 1px 1px rgb(0 0 0 / 8%);
    box-shadow: inset 0 1px 1px rgb(0 0 0 / 8%);
    -webkit-transition: border-color ease-in-out .15s,-webkit-box-shadow ease-in-out .15s;
    -o-transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
    transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
}
    </style>

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
            <div class="row">
                  <div class="col-md-2">
                     <div class="row">
                         <div class="col-md-12">
                               Agent Voucher Payment
                         </div>
                     </div>
                  </div>
                  
                 <div class="col-md-6">
                      <div class="row">
                         <div class="col-md-2">
                             <label>Select Agent</label>
                         </div>
                         <div class="col-md-6">
                             <div class="form-group">
                               <select class="form-control select2" name="select_agents" id="select_agents"  style="width:100%">
                              </select>
                             </div>
                         </div>
                     </div>
                  </div>   

                 
              </div>
    </section>

     
     
        <section class="content">
            
            <div class="box">
                <div class="box-header with-border" style="background:#f4f4f48c;">
                    <h3 class="box-title" _msthash="26273" _msttexthash="60619" style="text-align: left;font-size:14px;"><i class="fa fa-money" aria-hidden="true"></i> &nbsp;&nbsp;Agent Vouchers</h3>
                    
                    <div class="box-tools pull-right">
                         <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse">
                          <i class="fa fa-minus"></i></button>
                    </div>
                </div>
                
                <div class="box-body" _msthash="1196936" _msttexthash="1190501" style="text-align: left;">
                           <div id="table_view"></div>
                </div>
            </div>
            
            <div class="box">
                <div class="box-header with-border" style="background:#f4f4f48c;">
                    <h3 class="box-title" _msthash="26273" _msttexthash="60619" style="text-align: left;font-size:14px;"><i class="fa fa-bank" aria-hidden="true"></i> &nbsp;&nbsp;Agent Payment Details</h3>
                    
                    <div class="box-tools pull-right">
                         <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse">
                          <i class="fa fa-minus"></i></button>
                    </div>
                </div>
                
                <div class="box-body" _msthash="1196936" _msttexthash="1190501" style="text-align: left;">
                    
                     <div class="row">
                          <div class="col-md-2">
                              <label>Transaction Mode</label>
                          </div>
                          <div class="col-md-3">
                             <div class="form-group">
                                   <select class="form-control" name="trans_mode" id="trans_mode">
                                      <option value="">--select--</option>
                                      <option value = "BANK">BANK</option>
                                      <option value = "cheque">cheque</option>
                                      <option value = "Cash">Cash</option>
                                  </select>
                             </div>
                          </div>
                      </div>
                   
                     <div class="row" id="bank_details_div">
                         
                          <div class ="col-md-6">
                             <div class="row">
                                 <div class="col-md-4">
                                     <label>Bank</label>
                                 </div>
                                 <div class="col-md-6">
                                  <div class="form-group">
                                     <input type="text" class="form-control" name="bank_name" id="bank_name">
                                    </div>
                                 </div>
                             </div>
                         </div>
                         
                          <div class="col-md-6">
                             <div class="row">
                                 <div class="col-md-4">
                                     <label>Account No</label>
                                 </div>
                                 <div class="col-md-6">
                                      <div class="form-group">
                                            <input type="text" class="form-control" id="account_no" name="account_no">
                                        </div>
                                 </div>
                            </div>
                       </div>
                       
                          <div class="col-md-6">
                             <div class="row">
                                 <div class="col-md-4">
                                     <label>IFSC Code</label>
                                 </div>
                                 <div class="col-md-6">
                                     <div class="form-group">
                                         <input type="text" class="form-control" name="ifsc_code" id="ifsc_code">
                                      </div>
                                 </div>
                             </div>
                        </div>
                             
                          <div class="col-md-6">
                             <div class="row">
                                 <div class="col-md-4">
                                     <label>Bank Branch</label>
                                 </div>
                                 <div class="col-md-6">
                                     <div class="form-group">
                                            <input type="text" class="form-control" id="bank_branch" name="bank_branch">
                                     </div>
                                 </div>
                            </div>
                          </div>
                     </div>
                     
                      <div class="row" id='trans_no_div'>
                          <div class='col-md-6'>
                             <div class="row">
                                 <div class='col-md-4'>
                                     <label>Transaction No</label>
                                 </div>
                                 <div class='col-md-6'>
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="transaction_no" name="transaction_no">
                                        </div>
                                 </div>
                            </div>
                       </div>
                       
                          <div class='col-md-6'>
                             <div class="row">
                                 <div class='col-md-4'>
                                     <label>Cheque No</label>
                                 </div>
                                 <div class='col-md-6'>
                                   
                                   <div class="form-group">
                                     <input class="form-control" type="text" id="cheque_no" name="cheque_no">
                                    </div>
                                 </div>
                             </div>
                          </div>
                     </div>
                     
                      <div class="row">
                          
                       <div class='col-md-6'>
                             <div class="row">
                                 <div class='col-md-4'>
                                     <label>Total Amount</label>
                                 </div>
                                 <div class='col-md-6'>
                                     <div class="form-group">
                                         <input type="text" class="form-control" id="total_amount" name="total_amount" readonly>
                                     </div>
                                 </div>
                            </div>
                       </div>
                   
                       <div class='col-md-6'>
                             <div class="row">
                                 <div class='col-md-4'>
                                     <label>Advance Balance</label>
                                 </div>
                                 <div class='col-md-6'>
                                     <div class="form-group">
                                         <input type="number" class="form-control" id="adv_balance" name="adv_balance" readonly>
                                     </div>
                                 </div>
                            </div>
                       </div>
                       
                       <div class='col-md-6'>
                             <div class="row">
                                 <div class='col-md-4'>
                                     <label>Payout Type</label>
                                 </div>
                                 <div class='col-md-6'>
                                     <div class="form-group">
                                         <select class="form-control" name="adv_type" id="adv_type">
                                             <option value="">--Select--</option>
                                             <option value="Extra_payout">Extra Payout</option> 
                                             <option value="Advance_adjustment">Advance Adjustment</option> 
                                         </select>
                                     </div>
                                 </div>
                            </div>
                       </div>
                       
                        <div class='col-md-6 hidden' id="adv_adjustment_div">
                             <div class="row">
                                 <div class='col-md-4'>
                                     <label>Advance Adjustment</label>
                                 </div>
                                 <div class='col-md-6'>
                                     <div class="form-group">
                                         <input type="number" class="form-control" id="adv_adjust" name="adv_adjust" value='0'>
                                     </div>
                                 </div>
                            </div>
                       </div>
                       
                       <div class='col-md-6 hidden' id='extra_div'>
                             <div class="row">
                                 <div class='col-md-4'>
                                     <label>Extra Payout</label>
                                 </div>
                                 <div class='col-md-6'>
                                     <div class="form-group">
                                         <input type="number" class="form-control" id="extra_payout" name="extra_payout" value='0'>
                                     </div>
                                 </div>
                            </div>
                       </div>
                       
                        <div class='col-md-6'>
                             <div class="row">
                                 <div class='col-md-4'>
                                     <label>Paid Amount</label>
                                 </div>
                                 <div class='col-md-6'>
                                     <div class="form-group">
                                         <input type="text" class="form-control" id="paid_amount" name="paid_amount" readonly> 
                                     </div>
                                 </div>
                            </div>
                       </div>
                       
                         <div class='col-md-6'>
                             <div class="row">
                                 <div class='col-md-4'>
                                     <label>cheque Date / Trans Date</label>
                                 </div>
                                 <div class='col-md-6'>
                                     <div class="form-group">
                                         <input type="date" class="form-control" id="trans_date" name="trans_date">
                                     </div>
                                 </div>
                            </div>
                       </div>
                       
                        <div class='col-md-6'>
                             <div class="row">
                                 <div class='col-md-4'>
                                     <label>Remarks</label>
                                 </div>
                                 <div class='col-md-6'>
                                     <div class="form-group">
                                         <textarea class="form-control" id="remarks" name="remarks" rows="3"></textarea>
                                     </div>
                                 </div>
                            </div>
                         </div>
                       
                      </div>
                       <button class="btn btn-primary pull-right" id="sub_btn">Submit</button>
                     
                </div>
            </div>
            
         </section>
   </div>
<script>
   

    $(document).ready(function(){
         $('.select2').select2();
         
        var select_agents = $("#select_agents").val();
        fetch_agent_voucher(select_agents);
        
        load_all_agents_list();
        
        $("#select_agents").change(function(){
            
            if(select_agents != "")
            {
                var select_agents = $("#select_agents").val();
                fetch_agent_voucher(select_agents);
                fetch_advance_amount(select_agents);
            }
            
        });
      
        $("#sub_btn").click(function(){
            
            var agent = $("#select_agents").val();
            
            var vocher_arr = []; 
            
            $(".check").each(function(){
                
                if($(this).is(":checked"))
                {
                    vocher_arr.push($(this).val());
                }
                
            }); 
         
            var trans_mode = $("#trans_mode").val();
            var bank_name = $("#bank_name").val();
            var account_no = $("#account_no").val();
            var ifsc_code = $("#ifsc_code").val();
            var bank_branch = $("#bank_branch").val();
            var cheque_no = $("#cheque_no").val();
            var transaction_no = $('#transaction_no').val();
            var trans_date = $("#trans_date").val();
            var remarks = $("#remarks").val();
            
            var paid_amount = $("#paid_amount").val();
            var extra_pay = $("#extra_payout").val();
            var adv_adjust = $("#adv_adjust").val();
            var adv_type = $("#adv_type").val();
            
            if(agent == "")
            {
                snackbar_show("Select a Agent");
            }
            else if(vocher_arr == null || vocher_arr == "")
            {
                snackbar_show("Select a voucher");
            }
            else if(trans_mode == "")
            {
                snackbar_show("Select Transaction Mode");
            }
            else if((trans_mode == "BANK" || trans_mode == "cheque") && bank_name == "")
            {
                snackbar_show("Enter A Bank Name");
            }
            else if((trans_mode == "BANK" || trans_mode == "cheque") && account_no == "")
            {
                snackbar_show("Enter A Account No");
            }
            else if((trans_mode == "BANK" || trans_mode == "cheque") && ifsc_code == "")
            {
                snackbar_show("Enter A IFSC code");
            }
            else if(trans_mode == "BANK" && transaction_no == "")
            {
                snackbar_show("Enter A Transaction no");
            }
            else if(trans_mode == "cheque" && cheque_no == "")
            {
                snackbar_show("Enter A cheque no");
            }
            else if((trans_mode == "BANK" || trans_mode == "cheque") && trans_date == "")
            {
                snackbar_show("Enter A Transaction Date");
            }
            else if(trans_date == "")
            {
                snackbar_show("Enter A Transaction Date");
            }
            else 
            {
               $.ajax({
                      url : "add_agn_payment_entry",
                      method : "POST",
                      data : {vocher_arr:vocher_arr,adv_type:adv_type,extra_pay:extra_pay,adv_adjust:adv_adjust,paid_amount:paid_amount,trans_mode:trans_mode,bank_name:bank_name,account_no:account_no,cheque_no:cheque_no,ifsc_code:ifsc_code,bank_branch:bank_branch,cheque_no:cheque_no,transaction_no:transaction_no,trans_date:trans_date,remarks:remarks,agent:agent},
                      beforeSend:function(){
                          $("#sub_btn").attr("disabled",true);
                      },
                      success:function(response)
                      {
                          $("#sub_btn").attr("disabled",false);
                            Swal.fire(
                              'Payment Entry Added Successfully',
                              '',
                              'success'
                            )
                            location.reload();
                      }
            });
            }
        });
        
        
        $("#trans_mode").change(function(){
            
            var trans_mode = $("#trans_mode").val();
            
            var agents = $("#select_agents").val();
            
          if((trans_mode == "BANK" || trans_mode == "cheque") && agents != "")
          {
                $.ajax({
                         url : "get_agent_bank_details",
                         method : "POST",
                         data : {agents:agents},
                         success:function(response)
                         {
                             var obj = jQuery.parseJSON(response);
                             $("#bank_name").val(obj.bank_name);
                             $("#account_no").val(obj.bank_acc_no);
                             $("#ifsc_code").val(obj.ifsc_code);
                             $("#bank_branch").val(obj.branch);
                         }
                         
                 });
                 
                if(trans_mode == "cheque" && agents != "")
                  {
                      $("#trans_no_div").removeClass("hidden");
                      $("#bank_details_div").removeClass("hidden");
                  }
                  else
                  {
                        $("#trans_no_div").removeClass("hidden");
                        $("#bank_details_div").removeClass("hidden");
                  }
          }
          else if(trans_mode == "Cash" && agents != "")
          {
              $("#trans_no_div").addClass("hidden");
              $("#bank_details_div").addClass("hidden");
          }
      });
        
        
        $("#adv_adjust").keyup(function(){
            
            var total_amount = $("#total_amount").val();
            var adv_adjust = $("#adv_adjust").val();
            
            if(parseInt(adv_adjust) > (total_amount))
            {
                Swal.fire({
                  icon: 'warning',
                  title: 'Oops...',
                  text: "You Can't Adjust Amount More Than A Total Amount !",
                  footer: ''
                })
                $("#adv_adjust").val(0);
                $("#paid_amount").val(total_amount);
            }
            else
            {
                var paid_amount = parseInt(total_amount)-parseInt(adv_adjust);
                $("#paid_amount").val(paid_amount+".00");
            }
        });
        
        $("#extra_payout").keyup(function(){
            var total_amount = $("#total_amount").val();
            var extra_pay = $("#extra_payout").val();
            var paid_amount = parseInt(total_amount)+parseInt(extra_pay);
            $("#paid_amount").val(paid_amount+".00");
        });
        
        
        $("#adv_type").change(function(){
            
           var adv_type = $("#adv_type").val();
           
            if(adv_type == "Extra_payout")
            {
                $("#extra_div").removeClass("hidden");
                $("#adv_adjustment_div").addClass("hidden");
                $("#adv_adjust").val(0);
                $("#extra_payout").trigger("keyup");
            }
            else
            {
                $("#extra_div").addClass("hidden");
                $("#adv_adjustment_div").removeClass("hidden");
                $("#extra_payout").val(0);
                $("#adv_adjust").trigger("keyup");
            }
        });
        
      
  });

    function fetch_agent_voucher(select_agents)
    {
           $.ajax({
                     url : "fetch_agent_voucher",
                     method : "POST",
                     data : {agents:select_agents},
                     success:function(response)
                     {
                         $("#table_view").html(response);
                     }
           });
    }
    
    function select_all()
    {
        if($("#select_all").is(":checked"))
        { 
            $(".check").prop("checked",true);
        }
        else
        {
            $(".check").prop("checked",false);
        }
        
        var vocher_arr = []; 
        
        $(".check").each(function(){
            if($(this).is(":checked"))
            {
                vocher_arr.push($(this).val());
            }
        }); 
        
        $.ajax({
                url : "get_voucher_total",
                method : "POST",
                data : {vocher_arr : vocher_arr},
                success:function(response)
                {
                   $("#selected_total").html(response+".00");
                   $("#total_amount").val(response+".00");
                   $("#paid_amount").val(response+".00");
                }
            });
        
    }

    function vocher()
    {
        var agent = select_agents = $("#select_agents").val();
        $.ajax({
                 url : "generate_vocher",
                 method : "POST",
                 data : {policy_arr:policy_arr},
                 success:function(response)
                 {
                     var obj = jQuery.parseJSON(response);
                     {
                         $("#vocher_gen_btn").attr("disabled",false);
                                    Swal.fire(
                                      'Voucher Generated Successfully !',
                                      '',
                                      'success'
                                    )
                         location.reload();
                         window.open("agent_vocher_pdf?policy_arr="+policy_arr+"&agent="+agent+"&vocher_no="+obj.vocher_no+"&v_date="+obj.vocher_date,"blank");
                     }
                     
                 }
        });
    }
    
    function load_all_agents_list()
    {
        $.ajax({
                 url : "fetch_all_agents_list",
                 method : "POST",
                 success:function(response)
                 {
                     var obj = jQuery.parseJSON(response);
                     
                     for(var i= 0;i<obj.length;i++)
                     {
                         $("#select_agents").append("<option value='"+obj[i].id+"'>"+obj[i].name+" - "+obj[i].agent_pos_code+"</option>");
                     }
                     
                     $("#select_agents").trigger("change");
                 }
        });
    }
    
    function calc()
    {
        var vocher_arr = []; 
        
        $(".check").each(function(){
            if($(this).is(":checked"))
            {
                vocher_arr.push($(this).val());
            }
        }); 
        
        $.ajax({
                url : "get_voucher_total",
                method : "POST",
                data : {vocher_arr : vocher_arr},
                success:function(response)
                {
                $("#selected_total").html(response+".00");
                $("#total_amount").val(response+".00");
                $("#paid_amount").val(response+".00");
                }
            });
    }
    
    
    function fetch_advance_amount(agents)
    {
            $.ajax({
                 url : "fetch_adv_amount_by_agn_id",
                 method : "POST",
                 data : {agents:agents},
                 success:function(response)
                 {
                     var obj = jQuery.parseJSON(response);
                     $("#adv_balance").val(obj.adv_balance);
                 }
            });
    }
</script>  
  