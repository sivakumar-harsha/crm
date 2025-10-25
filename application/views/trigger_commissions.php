 <!-- Content Wrapper. Contains page content -->
  
  <style>
      label{
    display: inline-block;
    max-width: 100%;
    margin-bottom: 5px;
    font-weight: unset !important;
}
  </style>

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1 style="font-size: 17px;">
          
          Trigger Commissions
          
         <div class="row">
             <div class="col-md-2">
                 <div class="form-group"> 
                 <label>From Date</label>
                     <input type="date" class="form-control" name="from_date" id="from_date" value ="<?php echo date("Y-m-01") ?>">
                 </div>
             </div>
              <div class="col-md-2">
                 <div class="form-group">
                     <label>To Date</label>
                     <input type="date" class="form-control" name="to_date" id="to_date" value ="<?php echo date("Y-m-t")  ?>">
                 </div>
             </div>
             <div class="col-md-2">
                 <div class="form-group">
                     <label>Insurance Company</label>
                     <select class="form-control" name="lead" id="insurance_id">
                         <option value="">Select Insurance</option>
                         <?php foreach($insurance as $ins){ ?>
                         <option value="<?php echo $ins->id ?>"><?php echo $ins->company_name ?></option>
                         <?php } ?>
                     </select>
                 </div>
             </div>
             <div class="col-md-2">
                 <div class="form-group">
                     <label>Agent</label>
                     <select class="form-control" name="lead" id="agent_id">
                         <option value="">Select Agent</option>
                         <?php foreach($agent as $ag){ ?>
                         <option value="<?php echo $ag->id ?>"><?php echo $ag->name ?></option>
                         <?php } ?>
                     </select>
                 </div>
             </div>
             <div class="col-md-2">
                 <div class="form-group">
                     <label>Lead</label>
                     <input type="number" class="form-control" name="lead" id="lead_id" value ="">
                 </div>
             </div>
             
              <div class="col-md-2">
                 <div class="form-group">
                     <br>
                     <button class="btn btn-primary" id="sub_btn">Trigger Commission</button>
                 </div>
             </div>
             
         </div>
      </h1>
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
    
  
     $(document).ready(function(){

         $("#sub_btn").click(function(){
             var from_date = $("#from_date").val();
             var to_date  = $("#to_date").val();
              var lead_id = $("#lead_id").val();
             var agent_id  = $("#agent_id").val();
             var insurance_id  = $("#insurance_id").val();
             trigger_commission_amounts(from_date,to_date,lead_id,agent_id,insurance_id);
         });
    });
        
       
   
    function trigger_commission_amounts(from_date,to_date,lead_id,agent_id,insurance_id)
    {
        $.ajax({
                 url : "trigger_commission_amounts",
                 method : "POST",
                 data : {
                     from_date:from_date,
                     to_date:to_date,
                     lead_id:lead_id,
                     agent_id:agent_id,
                     insurance_id:insurance_id,
                 },
                 beforeSend:function(){
                   $("#table_view").html("<h4 align='center'>Loading....</h4>");
                 },
                 success:function(response)
                 {
                     $.ajax({
                             url : "calculate_commissions",
                             method : "POST",
                             success:function(response)
                             {
                                 $("#table_view").html("<h4 align='center'>success....</h4>");
                             }
                     });
                 }
        });
    }
    </script>