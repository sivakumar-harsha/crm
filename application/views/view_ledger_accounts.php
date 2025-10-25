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
@media (min-width: 992px) {}
    .col-md-3 {
        width: 32%;
        padding-left:5px; padding-right: 5px;
    }
}
    </style>

 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
    <?php $today = new DateTime();?>
    <section class="content-header">
      <div class = "row">
          <div class = "col-md-2">
              <div class = "form-group">
                  <label>Accounts Head</label>
                  <select class = "form-control select2" name = "acc_head" id="acc_head" style="width:100%">
                      <option value = "">--select Account Head--</option>
                      <?php foreach($data as $da)  { ?>
                      <option value = "<?php echo $da->vchaccid ?>"><?php echo $da->vchaccname ?></option>
                      <?php } ?>
                  </select>
              </div>
          </div>
          
          <div class = "col-md-2">
              <div class = "form-group">
                  <label>Sub Category</label>
                  <select class = "form-control select2" name = "acc_sub_category" id="acc_sub_category">
                      <option value = "">--Select Sub Category--</option>
                  </select>
              </div>
          </div>
          
          <div class = "col-md-2">
              <label>From Date</label>
              <div class = "form-group">
                  <input type = "date" class="form-control" id="f_date" name="f_date" value="<?=$today->format('Y-m-01')?>" >  
              </div>
          </div>
          
          <div class = "col-md-2">
              <div class = "form-group">
                  <label>To Date</label>
                  <input type = "date" class="form-control" id="to_date" name="to_date" value="<?=$today->format('Y-m-d')?>">  
              </div>
          </div>
          
          <div class = "col-md-1" style="padding-left:10px; padding-right: 10px;">
              <div class = "form-group">
                  <label>Lead Id</label>
                  <input type = "text" class="form-control" id="lead_id" name="lead_id">  
              </div>
          </div>
          
            <div class = "col-md-3">
                <label>Methods</label>
                <div class = "form-group">                  
                  <select class = "form-control select2" name = "methods" id="methods" style="width:55%;display:inline-block;">
                      <option value = "account_post_data">Account Post Date Wise</option>
                      <option value = "policy_issue_data">Policy Issue Date Wise</option>
                  </select>
                  &nbsp;&nbsp;
                  <button class = "btn btn-success btn-sm" id="search_btn"><i class="fa fa-search" aria-hidden="true"></i> Search</button>
                  &nbsp;
                  <button type="button" class="btn btn-danger btn-sm pull-right"  id="export_btn" onclick="export_excel()"><i class="fa fa-file-excel-o"></i> Export Excel</button>
                </div>
            </div>
            
            <!--<div class = "col-md-2">-->
            <!--    <div class = "form-group">-->
            <!--      <br>-->
            <!--      <button type="button" class="btn btn-danger btn-sm pull-right"  id="export_btn" onclick="export_excel()"><i class="fa fa-file-excel-o"></i> Export Excel</button>-->

            <!--        <button class = "btn btn-success btn-sm pull-right" id="search_btn"><i class="fa fa-search" aria-hidden="true"></i> Search</button>-->
            <!--    </div>-->
            <!--</div>-->
          
      </div>
      
    </section>

    <section class="content">
      <div class="box">
        <div class="box-body">
          <div id="table_view"></div>
        </div>       
      </div>
    </section>
  </div>
  
  
  
  <script>
  
    var acc_head = $("#acc_head").val();
    var acc_sub_category = $("#acc_sub_category").val();
    var f_date = $("#f_date").val();
    var to_date = $("#to_date").val();
    var lead_id = $("#lead_id").val();
  
    $(document).ready(function(){
        
        $('.select2').select2();
        
         acc_ledger(acc_head,acc_sub_category,f_date,to_date,lead_id)
         
         $("#acc_head").change(function(){
                var account_head = $("#acc_head").val();
                
                 $.ajax({
                            url : "get_sub_ledgers_by_accid",
                            method : "POST",
                            data : {account_head:account_head},
                            success:function(response)
                            {
                                $("#acc_sub_category").html(response);
                            }
                 });
          });
          
         $("#search_btn").click(function(){
              acc_head = $("#acc_head").val();
              acc_sub_category = $("#acc_sub_category").val();
              f_date = $("#f_date").val();
              to_date = $("#to_date").val();
              lead_id = $("#lead_id").val();
              acc_ledger(acc_head,acc_sub_category,f_date,to_date,lead_id)
         });
    });
    
    
    
    
      function acc_ledger(acc_head,acc_sub_category,f_date,to_date,lead_id)
      {
          var methods = $('#methods').val();
            $.ajax({
              url:"fetch_view_accounts_ledger",
              data:{acc_head:acc_head,acc_sub_category:acc_sub_category,f_date:f_date,to_date:to_date,lead_id:lead_id, methods: methods},
              method:"POST",
              beforeSend:function() {
                  $("#table_view").html('Loading...');
              },
              success:function(response){
                $("#table_view").html(response);
              },
              error: function(code) {   
                alert(code.statusText);
              },
            });
        }
        
   function export_excel(cc_head,acc_sub_category,f_date,to_date,lead_id)
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
    }
        
        
        
 </script>