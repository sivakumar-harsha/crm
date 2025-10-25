<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<style>
   
.select2-container .select2-selection--single {
    box-sizing: border-box;
    cursor: pointer;
    display: block;
    height: 34px;
    user-select: none;
    -webkit-user-select: none;
}
</style>

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1 style="font-size: 17px;">
        Agent Advance
        <button data-toggle="modal" data-target="#add_model" class="btn btn-primary btn-sm pull-right">Add Advance</button>
        <p></p>
       
        
      </h1>
       <div class="row">
            <div class="col-md-3">
                <div class="input-group">
                    <div class="input-group-btn">
                        <button type="button" class="btn btn-default">Month</button>
                    </div>
                       <select class="form-control" id="select_month" id="select_month">
                           <option value="" disabled="">Select Month</option>
                            <option <?php if(date("m") == "01"){echo "selected";} ?>  value="01">January</option>
                            <option <?php if(date("m") == "02"){echo "selected";} ?>  value="02">February</option>
                            <option <?php if(date("m") == "03"){echo "selected";} ?>  value="03">March</option>
                            <option <?php if(date("m") == "04"){echo "selected";} ?>  value="04">April</option>
                            <option <?php if(date("m") == "05"){echo "selected";} ?>  value="05">May</option>
                            <option <?php if(date("m") == "06"){echo "selected";} ?>  value="06">June</option>
                            <option <?php if(date("m") == "07"){echo "selected";} ?>  value="07">July</option>
                            <option <?php if(date("m") == "08"){echo "selected";} ?>  value="08">August</option>
                            <option <?php if(date("m") == "09"){echo "selected";} ?>  value="09">September</option>
                            <option <?php if(date("m") == "10"){echo "selected";} ?>  value="10">October</option>
                            <option <?php if(date("m") == "11"){echo "selected";} ?>  value="11">November</option>
                            <option <?php if(date("m") == "12"){echo "selected";} ?>  value="12">December</option>
                       </select>
                </div>
            </div>
            
            
             <div class="col-md-3">
                <div class="input-group">
                    <div class="input-group-btn">
                        <button type="button" class="btn btn-default">Year</button>
                    </div>
                       <select class="form-control" id="select_year" id="select_year">
                           <option value="" disabled="">Select Year</option>
                            <?php
                                for($y=(date("Y") - 5); $y <= (date("Y") + 1); $y++)
                                {
                                    if($y == date("Y"))
                                    {
                                        echo "<option selected>".$y."</option>";
                                    }
                                    else
                                    {
                                        echo "<option>".$y."</option>";
                                    }
                                }
                                ?>
                       </select>
                </div>
            </div>
         
            <div class="col-md-3">
                <div class="input-group">
                    <div class="input-group-btn">
                        <button type="button" class="btn btn-default">Agent</button>
                    </div>
                       <select class="form-control select2" id="select_agent" name="select_agent">
                           <option value="All">All</option>
                       </select>
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

  <div class="modal fade in" id="add_model">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true" style="color:white;">×</span></button>
                <h4 class="modal-title text-center">Add Advance Amount</h4>
            </div>
            <div class="modal-body">
                
                <div class="form-group">
                  <label>Agents</label> 
                      <select class="form-control select2" id="add_agents" name="add_agents" style="width:100%">
                          <option value="">--Select--</option>
                      </select>
                </div>
        

                <div class="form-group">
                  <label>Amount</label> 
                      <input type="number" class="form-control" id="add_amount" name="add_amount">
                </div>
                
                <div class="form-group">
                  <label>Date</label> 
                      <input type="date" class="form-control" id="add_date" name="add_date" value="<?php echo date("Y-m-d"); ?>">
                </div>
                
                 <div class="form-group">
                  <label>Reason</label> 
                      <input type="text" class="form-control" id="add_reason" name="add_reason">
                </div>
                
                <div class="form-group">
                  <label>Payment Mode</label> 
                      <select class="form-control" id="add_payment_mode" name="add_payment_mode">
                          <option value="">Payment mode</option>
                          <option value="Transaction">Transaction</option>
                          <option value="Cheque">Cheque</option>
                          <option value="Cash">Cash</option>
                      </select>
                </div>
                
                <div class="form-group hidden" id="tran_div">
                    <input type="text" class="form-control" id="transaction_no" name="transaction_no" placeholder="Transaction no">
                </div>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-sm btn-primary" id="add_btn">Submit</button>
            </div>
        </div>
    </div>
  </div>

  <script>
   
   var month = $("#select_month").val();
   var year = $("#select_year").val();
   var agent = $("#select_agent").val();
  
    $(document).ready(function(){
      $('.select2').select2();   
      
            month = $("#select_month").val();
            year = $("#select_year").val();
            agent = $("#select_agent").val();
            
            fetch_agent_advance(month,year,agent);
            load_agents();
      
      $("#add_payment_mode").change(function(){
          var payment_mode = $("#add_payment_mode").val();
          if(payment_mode == "Cheque" || payment_mode == "Transaction")
          {
              $("#tran_div").removeClass("hidden");
          }
          else
          {
              $("#tran_div").addClass("hidden");
          }
      });
      
      $("#add_btn").click(function(){
        var agents = $("#add_agents").val();
        var amount = $("#add_amount").val();
        var date = $("#add_date").val();
        var payment_mode = $("#add_payment_mode").val();
        var transaction_no = $("#transaction_no").val();
        var reason = $("#add_reason").val();
        
        var check = 0;

        if(agents === "")
        {
         check = 1;
         snackbar_show("Select Agent");
        }
        else if(amount == "")
        {
         check = 1;
         snackbar_show("Enter Amount");
        }
        else if(date == "")
        {
         check = 1;
         snackbar_show("Select Date");
        }
        else if(payment_mode == "")
        {
         check = 1;
         snackbar_show("Enter Payment Mode");
        }
        else if(payment_mode == "Bank" && transaction_no == "")
        {
         check = 1;
         snackbar_show("Enter Transaction no ");
        }
        if(check != 1)
        {
          $.ajax({
            url:"add_advance_amount",
            data:{agents:agents,amount:amount,date:date,payment_mode:payment_mode,transaction_no:transaction_no,reason:reason},
            method:"POST",
            beforeSend:function(){
                $("#add_btn").attr("disabled",true);
            },
            success:function(response){
                $("#add_btn").attr("disabled",false);
                fetch_agent_advance(month,year,agent);
                
                    Swal.fire(
                      'Advance payment Added Successfully !',
                      '',
                      'success'
                    )
                
                $("#add_amount").val("");
                $("#add_date").val("");
                $("#add_payment_mode").val("");
                $("#transaction_no").val("");
                $("#add_reason").val("");
                $("#add_agents").val("");
                $("#add_agents").trigger("change");
                $("#add_model").modal("hide");
            },
            error: function(code) {   
                alert(code.statusText);
            },
          });
        }
      });
      
      $("#select_agent").change(function(){
          
            month = $("#select_month").val();
            year = $("#select_year").val();
            agent = $("#select_agent").val();
          fetch_agent_advance(month,year,agent)
      });

   

    });
    
    function fetch_agent_advance(month,year,agent)
    {
      var content = "";
      content += "<div class='table-responsive'>";
      content += "<table id='table_id' class='table table-hover table-bordered'>"; 
      content += "<thead><th>S.No</th><th>Date</th><th>Agent Name</th><th>Agent Code</th><th>Reason</th><th>Amount</th></thead>";
      content += "<tbody></tbody>";
      content += "</table>";
      content += "</div>";
      
      $("#table_view").html(content);

      $("#table_id").DataTable({
          "processing": true,
          "serverSide": false,
          "ordering": false,
          "pageLength": 25,
          "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
          "ajax":{
            'url':'fetch_agent_advance',
            'method':'POST',
            'data':{month:month,year:year,agent:agent},
          }
      });      
    }
    
   
    
    function load_agents()
    {
        $.ajax({
                 url : "fetch_load_agents",
                 method : "POST",
                 success:function(response)
                 {
                     var obj = jQuery.parseJSON(response);
                     for(var i = 0;i<obj.length;i++)
                     {
                         $("#add_agents").append("<option value="+obj[i].id+">"+obj[i].name+" ("+obj[i].agent_pos_code+")</option>");
                         
                         $("#select_agent").append("<option value="+obj[i].id+">"+obj[i].name+" ("+obj[i].agent_pos_code+")</option>");
                     }
                 }
        });
    }
    
  </script>
