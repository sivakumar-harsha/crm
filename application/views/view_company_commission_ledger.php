<style>
 
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

  label {
    display: inline-block;
    max-width: 100%;
    margin-bottom: 5px;
    font-weight: unset;
    font-size: 14px;
}

@media (min-width: 992px) {
    .col-md-2 {
        width: 14.66666667%;
        padding-left:10px; padding-right: 10px;
    }
}

    </style>

 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
    
    
    <section class="content-header">
      <div class = "row" style="background:whitesmoke;border:1px solid gray">          
      <input type = "hidden" class="form-control" id="lead_id" name="lead_id">
          
          <div class = "col-md-3" style="border-right: 1px solid gray">
              <div class = "form-group">
                  <label><h3>Own Commission Ledger</h3><span class="pull-right">(Jayantha View)</span></label>                  
              </div>
          </div>
          <div class = "col-md-2">
              <div class = "form-group">
                  <label>From Date</label>
                  <input type = "date" class="form-control" id="from_date" name="from_date" value="<?=$startdate?>">  
              </div>
          </div>
          
          <div class = "col-md-2">
          <label>To Date</label>
              <div class = "form-group">                  
                  <input type = "date" class="form-control" id="to_date" name="to_date" value="<?=$enddate?>">           
                  
              </div>
              
          </div>
          
          <div class = "col-md-2">
            <label>Company</label>
              <div class = "form-group">                  
                  <select class = "form-control select2" name = "company_id" id="company_id" style="width:100%">                      
                      <option value = "">All</option>
                      <?php foreach($companyName as $row)  { ?>
                      <option value = "<?php echo $row->id ?>"><?php echo $row->company_name ?></option>
                      <?php } ?>
                  </select>                  
              </div>
          </div>

          <div class = "col-md-3">
                <label>Methods</label>
                <div class = "form-group">                  
                  <select class = "form-control select2" name = "methods" id="methods" style="width:65%;display:inline-block;">
                      <option value = "account_post_data">Account Post Date Wise</option>
                      <option value = "policy_issue_data">Policy Issue Date Wise</option>
                  </select>
                  &nbsp;&nbsp;
                  <button class = "btn btn-success btn-sm" id="search_btn"><i class="fa fa-search" aria-hidden="true"></i> Search</button>
                </div>
            </div>
                        
            
      </div>
      
    </section>

<style>
    tbody tr:nth-child(odd) {
        background-color1: #c9c7c7;
    }
</style>
    
    <div id="table_view"></div>
   
  </div>
  
  
  
  <script>
  
    
    $(document).ready(function(){
        
        $('.select2').select2();
        
        // acc_ledger(acc_head,acc_sub_category,f_date,to_date,lead_id)
                  
          
         $("#search_btn").click(function(){
                company_id = $("#company_id").val();                
                fromdate = $("#from_date").val();
                todate = $("#to_date").val();
                lead_id = $("#lead_id").val();
                agent_ledger(company_id,fromdate,todate,lead_id);
         });
    });
    
    
    
    
      function agent_ledger(company_id,fromdate,todate)
      {
            var methods = $('#methods').val();
            $.ajax({
              url:"fetch_view_company_ledger",
              data:{company_id:company_id,fromdate:fromdate,todate:todate, methods: methods},
              method:"POST",
              beforeSend:function(){
                  $("#table_view").html("<section class='content' style='background-color:white'>Loading...</section>");
              },
              success:function(response){
                $("#table_view").html(response);
              },
              error: function(code) {
                alert(code.statusText);
              },
            });
        }
        
   /*function export_excel(cc_head,acc_sub_category,f_date,to_date,lead_id)
   {
        $.ajax({
              url:"export_view_accounts_ledger_excel",
              data:{acc_head:acc_head,acc_sub_category:acc_sub_category,f_date:f_date,to_date:to_date,lead_id:lead_id},
              method:"POST",
              beforeSend:function()
                 {
                     $("#export_btn").attr("disabled",true);
                 },
                 success:function(response)
                 {
                     $("#export_btn").attr("disabled",false);
                     window.location.href=response;
                 }
            }); 
    }*/
        
        
        
 </script>