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
                <div class="col-md-12">
                    <h4>Company Payment Receivable</h4>
                </div>
            </div>
        </section>
        <section class="content">
            <form name="invoice_receipt_form" id="invoice_receipt_form" action="<?=base_url('InvoiceController/store')?>">
                <input type="hidden" name="id" id="id" value=""/>
                <div class="box">
                    <div class="box-header with-border" style="background:#f4f4f48c;">
                        <div class="box-tools pull-right">
                             <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse">
                              <i class="fa fa-minus"></i></button>
                        </div>
                    </div>
                    
                    <div class="box-body" _msthash="1196936" _msttexthash="1190501" style="text-align: left;">
                        
                            <div class="form-row">
                                <div class="form-group col-md-3">
                                    <label for="inputEmail4">Company</label>
                                    <select class="form-control select2" name="company_id" id="company_id"  style="width:100%" onchange="getInvRev()">
                                        <option value="">Select</option>
                                        <?php if( isset( $companylist ) && !empty( $companylist ) ):?>
                                            <?php foreach( $companylist as $company_id => $company_name ):?>
                                                <option value="<?=$company_id?>"><?=$company_name?></option>
                                            <?php endforeach;?>
                                         <?php endif;?>
                                    </select>
                                </div>
                                <div class="form-group col-md-3">
                                  <label for="inputState">Invoice No</label>
                                  <select id="invoice_rev_id" name="invoice_rev_id" class="form-control" onchange="getInvDate()">
                                  </select>
                                </div>
                                <div class="form-group col-md-3">
                                  <label for="inputZip">Invoice Date</label>
                                  <input type="text" class="form-control" readonly id="invoice_date" name="invoice_date">
                                </div>
                                <div class="form-group col-md-3">
                                  <label for="inputZip">Invoice Amount</label>
                                  <input type="text" class="form-control" readonly id="invoice_amount" name="invoice_amount">
                                </div>
                            </div>
                        
                    </div>
                </div>
                
                <div class="box">
                    <div class="box-header with-border" style="background:#f4f4f48c;">
                        <div class="box-tools pull-right">
                             <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse">
                              <i class="fa fa-minus"></i></button>
                        </div>
                    </div>
                    
                    <div class="box-body" _msthash="1196936" _msttexthash="1190501" style="text-align: left;">
                        
                        <div class="row">
                            <div class='col-md-6'>
                                <div class="row">
                                    <div class="col-md-4">
                                        <label>Transaction Mode</label>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <select class="form-control" name="trans_mode" id="trans_mode">
                                                <option value="">--select--</option>
                                                <option value = "Bank">Bank</option>
                                                <option value = "Cheque">Cheque</option>
                                                <option value = "Cash">Cash</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                              
                            <div class='col-md-6'>
                                <div class="row">
                                    <div class='col-md-4'>
                                        <label>Date</label>
                                    </div>
                                    <div class='col-md-6'>
                                        <div class="form-group">
                                            <input type="date" class="form-control" id="receipt_date" name="receipt_date" value="<?=$receipt_date?>">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row hidden" id="bank_details_div">
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
                         
                        <div class="row hidden" id='trans_no_div'>
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
                                         <label>Trans Date</label>
                                     </div>
                                     <div class='col-md-6'>
                                         <div class="form-group">
                                             <input type="date" class="form-control" id="trans_date" name="trans_date">
                                         </div>
                                     </div>
                                </div>
                            </div>
                        
                        </div>
                         
                        <div class="row hidden" id="cheque_div">
                            <div class='col-md-4'>
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
                              <div class='col-md-4'>
                                 <div class="row">
                                     <div class='col-md-4'>
                                         <label>Cheque Date</label>
                                     </div>
                                     <div class='col-md-6'>
                                         <div class="form-group">
                                             <input type="date" class="form-control" id="cheque_date" name="cheque_date">
                                         </div>
                                     </div>
                                </div>
                           </div>
                           <div class='col-md-4'>
                                 <div class="row">
                                     <div class='col-md-4'>
                                         <label>Clearance Date</label>
                                     </div>
                                     <div class='col-md-6'>
                                         <div class="form-group">
                                             <input type="date" class="form-control" id="clearance_date" name="clearance_date">
                                         </div>
                                     </div>
                                </div>
                           </div>
                           
                        </div>
                        
                        <div class="row">
                            <div class='col-md-6'>
                                <div class="row">
                                    <div class='col-md-4'>
                                        <label>Amount</label>
                                    </div>
                                    <div class='col-md-6'>
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="receipt_amount" name="receipt_amount" value="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class='col-md-6'>
                                <div class="row">
                                    <div class='col-md-4'>
                                        <label>Balance</label>
                                    </div>
                                    <div class='col-md-6'>
                                        <div class="form-group">
                                            <input type="number" class="form-control" id="balance_amount" name="balance_amount" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <?php if($org_id == "1"):?>
                                <div class = "col-md-6">    
                                    <div class="row">
                                        <div class='col-md-4'>
                                            <label>TDS (%)</label>
                                        </div>
                                        <div class='col-md-6'>
                                            <div class="form-group">                                        
                                                <div class="input-group">
                                                    <input type="number" class="form-control" name="tds_per" id="tds_per">
                                                    <input type="hidden" name="tds_amt" id="tds_amt">
                                                    <span class="input-group-addon" id="lbl_tds_amt"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endif;?>

                            <?php if($org_id == "2"):?>
                                <div class = "col-md-6">    
                                    <div class="row">
                                        <div class='col-md-4'>
                                            <label>CGST (%)</label>
                                        </div>
                                        <div class='col-md-6'>
                                            <div class="form-group">                                        
                                                <div class="input-group">
                                                    <input type="number" class="form-control" name="cgst_per" id="cgst_per">
                                                    <input type="hidden" name="cgst_amt" id="cgst_amt">
                                                    <span class="input-group-addon" id="lbl_cgst_amt"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class = "col-md-6">    
                                    <div class="row">
                                        <div class='col-md-4'>
                                            <label>SGST (%)</label>
                                        </div>
                                        <div class='col-md-6'>
                                            <div class="form-group">                                        
                                                <div class="input-group">
                                                    <input type="number" class="form-control" name="sgst_per" id="sgst_per">
                                                    <input type="hidden" name="sgst_amt" id="sgst_amt">
                                                    <span class="input-group-addon" id="lbl_sgst_amt"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class = "col-md-6">    
                                    <div class="row">
                                        <div class='col-md-4'>
                                            <label>IGST (%)</label>
                                        </div>
                                        <div class='col-md-6'>
                                            <div class="form-group">                                        
                                                <div class="input-group">
                                                    <input type="number" class="form-control" name="igst_per" id="igst_per">
                                                    <input type="hidden" name="igst_amt" id="igst_amt">
                                                    <span class="input-group-addon" id="lbl_igst_amt"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endif;?>

                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="inputEmail4">Narration</label>
                                    <textarea class="form-control" id="remarks" name="remarks" rows="3"></textarea>
                                </div>
                            </div>
                        </div>
                            
                        <button class="btn btn-primary pull-right" id="sub_btns" type="submit" >Submit</button>
                         
                    </div>
                </div>
            </form>
        </section>
    </div>
   
<script>
   

    $(document).ready(function(){
         $('.select2').select2();
         
        var select_agents = $("#select_agents").val();
        //fetch_agent_voucher(select_agents);
        
        //load_all_agents_list();
        
        $("#select_agents").change(function(){
            
            if(select_agents != "")
            {
                var select_agents = $("#select_agents").val();
                fetch_agent_voucher(select_agents);
                fetch_advance_amount(select_agents);
            }
            
        });

        $("#tds_per").keyup(function(){
            var tds_per = $("#tds_per").val();
            var receipt_amount = $("#receipt_amount").val();
            calcamount(receipt_amount, tds_per, "tds_amt");                    
        });

        $("#cgst_per").keyup(function(){
            var cgst_per = $("#cgst_per").val();
            var receipt_amount = $("#receipt_amount").val();
            calcamount(receipt_amount, cgst_per, "cgst_amt");            
        });

        $("#sgst_per").keyup(function(){
            var sgst_per = $("#sgst_per").val();
            var receipt_amount = $("#receipt_amount").val();
            calcamount(receipt_amount, sgst_per, "sgst_amt");            
        });

        $("#igst_per").keyup(function(){
            var igst_per = $("#igst_per").val();
            var receipt_amount = $("#receipt_amount").val();
            calcamount(receipt_amount, igst_per, "igst_amt");            
        });
        
        $('#invoice_receipt_form').on('submit', function(e){
            e.preventDefault();
            var status = "true";
            
            var trans_mode = $("#trans_mode").val();
            
            if($("#company_id").val() == ""){
                snackbar_show("Select a Company");
                status = "false";
            } else if($("#invoice_rev_id").val() == ""){
                snackbar_show("Select a Invoice No.");
                status = "false";
            } else if(trans_mode == ""){
                snackbar_show("Select a Transaction Mode.");
                status = "false";
            } else if((trans_mode != "") && (trans_mode == "Bank" || trans_mode == "Cheque") ){
                if($("#bank_name").val() == ""){
                    snackbar_show("Enter the Bank Name.");
                    status = "false";
                } else if($("#account_no").val() == ""){
                    snackbar_show("Enter the Account No.");
                    status = "false";
                } else if($("#ifsc_code").val() == ""){
                    snackbar_show("Enter the IFSC Code");
                    status = "false";
                } else if($("#bank_branch").val() == ""){
                    snackbar_show("Enter the Bank Branch");
                    status = "false";
                } else if(trans_mode == "Bank") {
                    if($("#transaction_no").val() == ""){
                        snackbar_show("Enter the Transaction No.");
                        status = "false";
                    }else if($("#trans_date").val() == ""){
                        snackbar_show("Enter the Transaction Date.");
                        status = "false";
                    }
                } else if(trans_mode == "Cheque") {
                    if($("#cheque_no").val() == ""){
                        snackbar_show("Enter the Cheque No.");
                        status = "false";
                    }else if($("#cheque_date").val() == ""){
                        snackbar_show("Enter the Cheque Date.");
                        status = "false";
                    }
                }
            } else if($("#receipt_amount").val() == ""){
                snackbar_show("Enter the Amount.");
                status = "false";
            }
            
            if(status == "true" && $("#receipt_amount").val() == ""){
                snackbar_show("Enter the Amount.");
                status = "false";
            }
            
            if(status == "true"){
                var $form = $(e.target);
               
                $.ajax({
                    url: $form.attr('action'),
                    type: "POST",
                    data: $form.serialize(),
                    dataType: "json",
                    success: function(response){
                        if(response.status == true){
                            //window.location.reload();
                            $("#invoice_receipt_form").trigger("reset");
                            $('#lbl_tds_amt').html('');
                            $('#lbl_cgst_amt').html('');
                            $('#lbl_sgst_amt').html('');
                            $('#lbl_igst_amt').html('');
                            snackbar_show(response.msg);
                        }
                    }
                });
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
            if($('#company_id').val() == '') {
                alert("Select Company");
                $("select#trans_mode").val(''); 
                return;
            }
            
            if($('#invoice_id').val() == '') {
                alert("Select Invoice");
                $("select#trans_mode").val(''); 
                return;
            }
            
            var trans_mode = $("#trans_mode").val();
            
            var company_id = $("#company_id").val();
            
            if((trans_mode == "Bank" || trans_mode == "Cheque") && company_id != "")
            {
                $("#bank_details_div").removeClass("hidden");
                
                if(trans_mode == "Cheque" && company_id != "")
                {
                    $("#cheque_div").removeClass("hidden");
                    $("#trans_no_div").addClass("hidden");
                }
                else
                {
                    $("#trans_no_div").removeClass("hidden");
                    $("#cheque_div").addClass("hidden");
                }
            }
            else if(trans_mode == "Cash" && company_id != "")
            {
                $("#trans_no_div").addClass("hidden");
                $("#bank_details_div").addClass("hidden");
                $("#cheque_div").addClass("hidden");
            }
      });
        
        
        $("#receipt_amount").keyup(function(){
            var receipt_amount  = $(this).val();
            var invoice_amount  = $("#invoice_amount").val();
            var balance         = parseFloat(invoice_amount) - parseFloat(receipt_amount);
            console.log(receipt_amount);
            $("#balance_amount").val(balance.toFixed(2));
        });
  });

    function calcamount(amount, percent, ele) {        
        var output = 0;
        if(amount > 0) {            
            output = (amount * percent) / 100;            
        }        
        $("#lbl_"+ele).html("₹ "+output+".00");
        $("#"+ele).val(output);      
    }

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
    
    function getInvRev() {
        $('#invoice_rev_id').find('option').remove();
        var company_id = $('#company_id').val();
        if(company_id) {
            $.ajax({
               url:"<?=base_url('InvoiceController/getInvoiceByCompanies')?>",
               dataType: "json",
               data: {company_id: company_id},
               success:function(response){
                   var tag = $('#invoice_rev_id');
                   var size = Object.keys(response).length;
                   tag.append('<option value="">Select</option>')
                   if (size > 0){
                       $.each(response, function(ind, data){
                           tag.append('<option value="'+data.invoice_id+'">'+data.invno+'/R'+data.revno+'</option>')
                       });
                   }
               },
               error:function(code){
                 alert(code.statusText);  
               },
            });
        }
    }
    
    function getInvDate() {
        $('#invoice_date').val('');
        var invoice_rev_id = $('#invoice_rev_id').val();
        
        if(invoice_rev_id) {
            $.ajax({
               url:"<?=base_url('InvoiceController/getInvDateByInvoice')?>",
               dataType: "json",
               data: {invoice_rev_id: invoice_rev_id},
               success:function(response){
                   var size = Object.keys(response).length;
                   if (size > 0){
                       $('#invoice_date').val(response.revdate);
                       $('#invoice_amount').val(response.total_amount);
                   }
               },
               error:function(code){
                 alert(code.statusText);  
               },
            });
        }
        
    }
</script>  
  