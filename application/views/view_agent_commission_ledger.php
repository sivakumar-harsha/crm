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
    </style>

 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
    <section class="content-header">
        
      <div class = "row" style="background:whitesmoke;border:1px solid gray;padding:unset;margin:unset">  

            <input type = "hidden" class="form-control" id="lead_id" name="lead_id">
          
          
          <div class = "col-md-3" style="border-right: 1px solid gray">
              <div class = "form-group">
                  <label><h3><?=($subtitle == "Jayantha") ? "Agent Commission Ledger" : "Agent Ledger"?></h3><span class="pull-right">(<?=$subtitle?> View)</span></label>                  
              </div>
          </div>

          <div class = "col-md-2">
              <div class = "form-group">
                  <label>From Date</label>
                  <input type = "date" class="form-control" id="f_date" name="f_date" value="<?=$startdate?>">  
              </div>
          </div>
          
          <div class = "col-md-2">
          <label>To Date</label>
              <div class = "form-group">                  
                  <input type = "date" class="form-control" id="to_date" name="to_date" value="<?=$enddate?>">                                               
              </div>
              
          </div>
          <div class = "col-md-4">
                <label>Agent</label>
              <div class = "form-group">                  
                  <select class = "form-control select2" name = "agent_id" id="agent_id"  style="width:80%;display:inline-block;">                      
                      <option value = "">All</option>
                      <?php foreach($data as $da)  { ?>
                      <option value = "<?php echo $da->id ?>"><?php echo $da->name.' ('.$da->agent_pos_code.')' ?></option>
                      <?php } ?>
                  </select>
                  &nbsp;&nbsp;
                  <button class = "btn btn-success btn-sm" id="search_btn"><i class="fa fa-search" aria-hidden="true"></i> Search</button>         
              </div>
          </div>
          
          <!-- <div class = "col-md-2">
              <div class = "form-group">
                  <label>Lead Id</label>
                  <input type = "text" class="form-control" id="lead_id" name="lead_id">  
              </div>
          </div> -->
          
           <!-- <div class = "col-md-2">
              <div class = "form-group">       
              <label for="inputState">&nbsp;</label>           
                <button class = "btn btn-success btn-sm pull-right" id="search_btn"><i class="fa fa-search" aria-hidden="true"></i> Search</button>
            </div>
            
          </div> -->
          
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
  
    var subtitle='<?=$subtitle?>';

    $(document).ready(function(){
        
        $('.select2').select2();
        
        // acc_ledger(acc_head,acc_sub_category,f_date,to_date,lead_id)
                  
          
         $("#search_btn").click(function(){
                agent_id = $("#agent_id").val();                
                fromdate = $("#f_date").val();
                todate = $("#to_date").val();
                lead_id = $("#lead_id").val();
                agent_ledger(agent_id,fromdate,todate,lead_id);
         });
    });
    
    
    
    
      function agent_ledger(agent_id,fromdate,todate,lead_id)
      {
            var url = "fetch_view_agent_ledger";
            if(subtitle == 'Agent') {
                url = "fetch_agent_ledger_view";
            } 
            $.ajax({
              url: url,
              data:{agent_id:agent_id,fromdate:fromdate,todate:todate,lead_id:lead_id},
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