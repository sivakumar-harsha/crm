<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <div class="content-wrapper">

    <style>
    
        label 
        {
            font-weight:unset !important;
        }
         .table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
            padding: 8px;
            line-height: 1.42857143;
            font-weight: unset;
            vertical-align: top;
            border-top: 1px solid #ddd;
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
        
    </style>
    
    <section class="content-header">
      <h1 style="font-size: 17px;">
         
           </h1>
            <div class="box">
                <div class="box-header with-border">
                     <h4>Company Invoice Report</h4>
                    <div class="box-tools pull-right">
                         <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse">
                          <i class="fa fa-minus"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    <div class="row">
                <div class="form-group col-md-3">
                    <label for="inputState">Company</label>
                    <select class="form-control select2" name="select_insurance" id="select_insurance"  style="width:100%" onchange="getInvRev()">
                       <?php if(isset($companylist) && !empty($companylist)):?>
                            <option value-"-1">Select</option>
                            <?php foreach($companylist as $company):?>
                                <option value="<?=$company->id?>">
                                    <?=$company->company_name?>
                                </option>
                            <?php endforeach;?>
                       <?php endif;?>
                    </select>
                </div>
                <div class="form-group col-md-2">
                    <label for="inputState">From</label>
                    <input type="date" class="form-control" name="f_date" id="f_date" value="<?php echo date("Y-m-01") ?>">
                </div>
                <div class="form-group col-md-2">
                    <label for="inputState">To</label>
                   <input type="date" class="form-control" name="to_date" id="to_date" value="<?php echo date("Y-m-d") ?>">
                </div>
                <div class="form-group col-md-2">
                    <label for="inputState">Invoice No</label>
                    <select id="invoice_rev_id" name="invoice_rev_id" class="form-control">
                    </select>
                </div>
                <div class="form-group col-md-2">
                    <label for="inputState">Class</label>
                    <select class="form-control" name="policy_class" id="policy_class">
                        <option value="">--select--</option>
                        <?php foreach($classlist as $da){ ?>
                          <option value="<?php echo $da->id ?>"><?php echo $da->class ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group col-md-1">
                    <label for="inputState">&nbsp;</label>
                     <button type="button" class = "btn btn-success" onclick="get_data()"><i class="fa fa-search" aria-hidden="true"></i>&nbsp;Search</button>
                </div>
                
            </div>
                </div>
            </div>

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
  
  
<script>
   
   var policy_arr = [];
   
    $(document).ready(function(){
        
         $('.select2').select2();
         
        /*
        var from_date = "";
        var to_date = "";
        //fetch_insurance_commision(from_date,to_date);
        //load_all_insurances_list();
        
        $("#select_insurance").change(function(){
            
            if(select_insurance != "")
            {
                var select_insurance = $("#select_insurance").val();
               // fetch_insurance_commision(from_date,to_date,select_insurance);
            }
        });
        
        $("#f_date").change(function(){
           var select_insurance = $("#select_insurance").val();
           var from_date = $("#f_date").val();
           var to_date = $("#to_date").val();
           // fetch_insurance_commision(from_date,to_date,select_insurance);
        });
        
        $("#to_date").change(function(){
           var select_insurance = $("#select_insurance").val();
           var from_date = $("#f_date").val();
           var to_date = $("#to_date").val();
           // fetch_insurance_commision(from_date,to_date,select_insurance);
        });
        */
    });
    
     
    function get_data()
    {
        var company = $("#select_insurance").val();
        var fromdate = $("#f_date").val();
        var todate = $("#to_date").val();
        var policy_class = $("#policy_class").val();
        var invoice_rev_id = $("#invoice_rev_id").val();
        
        if(fromdate == '' || todate == '' || company == 'Select') {
            alert('Select any company');
            return;
        }
    
        $.ajax({
            url : "fetch_company_invoice_report",
            method : "POST",
            data : {from_date:fromdate,to_date:todate,insurance:company,policy_class:policy_class,invoice_rev_id: invoice_rev_id},
            beforeSend: function() {
                $("#table_view").html("Loading...");
            },
            success:function(response)
            {
                $("#table_view").html(response);
                $('#tbl_invoice').DataTable({
                    "bPaginate": false,
                     //"aaSorting": [[ 1, "asc" ]]
                });
            }
        });
    }

    function exportpdf(vocher_no, org)
    {
        var url = "company_vocher_pdf";
        
        if(org == "1"){
            url = "company_vocher_pdf";
        }else if(org == "2"){
            url = "company_vocher_orc_pdf";
            url = "company_vocher_pdf";
        }
        
        /*var policy_arr = [];
        select_agents = $("#select_agents").val();
        month = $("#month").val();
        
        $(".check_"+agent).each(function(){
            policy_arr.push($(this).val()); 
        });*/ 
          
        $.ajax({
            url : url,
            method : "GET",
            dataType: "json",
            // data : {month:month,agents:agent,policy_arr:policy_arr,vocher_no:vocher_no, v_date: vocher_date},
            data: {voucher_no: vocher_no, org: org},
            success:function(response)
            {
                var size = Object.keys(response).length;
                console.log(response);
                if(size > 0){
                    if(response.status == "true") {
                        window.open(response.file ,"blank");
                    }
                }
                
             //window.location.href=response;
            }
        });
    }
    
    function exportexcel(vocher_no, org)
    {
        var url = "company_vocher_excel";
        
        if(org == "1"){
            url = "company_vocher_excel";
        }else if(org == "2"){
            url = "company_vocher_orc_excel";
        }
        
        /*var policy_arr = [];
        select_agents = $("#select_agents").val();
        month = $("#month").val();
        
        $(".check_"+agent).each(function(){
            policy_arr.push($(this).val()); 
        });*/ 
          
        $.ajax({
            url : url,
            method : "GET",
            dataType: "json",
            // data : {month:month,agents:agent,policy_arr:policy_arr,vocher_no:vocher_no, v_date: vocher_date},
            data: {voucher_no: vocher_no, org: org},
            success:function(response)
            {
                var size = Object.keys(response).length;
                console.log(response);
                if(size > 0){
                    if(response.status == "true") {
                        window.open(response.file ,"blank");
                    }
                }
                
             //window.location.href=response;
            }
        });
    }
    
    function fetch_insurance_commision(fromdate,todate,company,policy_class)
    {
        $.ajax({
            url : "fetch_company_invoice_report",
            method : "POST",
            data : {from_date:fromdate,to_date:todate,insurance:company,policy_class:policy_class},
            beforeSend: function() {
                $("#table_view").html("Loading...");
            },
            success:function(response)
            {
                $("#table_view").html(response);
            }
        });
    }
    
    

    function vocher()
    {
        var select_insurance = $("#select_insurance").val();
        var from_date = $("#f_date").val();
        var to_date = $("#to_date").val();
        var policy_class = $("#policy_class").val();
        
        var policy_arr = [];
    
        

        $(".pt").each(function(ind){
            var key = $(this).attr('data-value');
            policy_arr[key] = $(this).val();
            var object = {}; 
            object[key] = $(this).val();
            policy_arr.push(object);
            // console.log(key + ' = ' + policy_arr[key]);
            
        }); 
        

        console.log(policy_arr);
        console.log(typeof(policy_arr));
        // var custom_police_name = $("input[name='custom_policy_name[]']").map(function(){return $(this).val();}).get();
          
        // alert(custom_police_name);
        // console.log(custom_police_name);
    
               $.ajax({ 
                     url : "save_insurance_policy",
                     method : "POST",
                     data : {from_date:from_date,to_date:to_date,insurance:select_insurance,policy_class:policy_class,policy_arr:policy_arr},
                     beforeSend:function(){
                       $("#vocher_gen_btn").attr("disabled",true);  
                     },
                     success:function(response)
                     {
                         var obj = jQuery.parseJSON(response);
                         {
                             $("#vocher_gen_btn").attr("disabled",false);
                         
                         voucher_number = obj.arr;    
                         
                         uni_vouchar_no = obj.uni;
                            
                            if(obj.status == "success")
                            {
                                  $("#select_insurance").trigger("change");
                                            Swal.fire(
                                              'Voucher Generated Successfully !',
                                              '',
                                              'success'
                                            )
                              window.open("company_vocher_pdf?voucher_no="+voucher_number,"blank");
                              
                              window.open("company_vocher_orc_pdf?voucher_no="+uni_vouchar_no,"blank");
                              
                            }
                            else
                            {
                                  Swal.fire({
                                      icon: 'error',
                                      title: 'Oops...',
                                      text: "Insurance Ledger Not Available",
                                      footer: ''
                                    })
                            }
                         }
                         
                     }
                  });
            
    }
    
 
    function load_all_insurances_list()
    {
        $.ajax({
                 url : "load_all_insurances_list",
                 method : "POST",
                 success:function(response)
                 {
                     var obj = jQuery.parseJSON(response);
                     
                     for(var i= 0;i<obj.length;i++)
                     {
                         $("#select_insurance").append("<option value='"+obj[i].id+"'>"+obj[i].company_name+"</option>");
                     }
                     
                     $("#select_insurance").trigger("change");
                 }
        });
    }
    
    function getInvRev() {
        $('#invoice_rev_id').find('option').remove();
        var company_id = $('#select_insurance').val();
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
    
</script>  
  