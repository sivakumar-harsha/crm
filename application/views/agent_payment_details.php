 <!-- Content Wrapper. Contains page content -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>

  <style>
      .form-control {
    display: block;
    width: 100%;
    height: 30px;
    padding: 6px 12px;
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
  

 
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
    <div class="row">
        <div class="col-md-2">
             <h1 style="font-size: 17px;margin-top: -5px;">Agent Payment Details</h1>
        </div>
        <div class="col-md-3">
            <div class="input-group">
            <span class="input-group-addon">Agents</span>
                <select class="form-control select2" name="select_agents" id="select_agents">
                    <option value="All">All</option>
                    <?php foreach($agents as $da){?>
                     <option value="<?php echo $da->id ?>"><?php echo $da->name."  (".$da->agent_pos_code.")" ?></option>    
                 <?php 
                    }
                  ?>
                </select>
        </div>
        </div>
        <div class="col-md-3">
             <div class="input-group">
                <span class="input-group-addon">Policy No</span>
                  <input type="text" class="form-control" placeholder="Search By Policy Number" id="policy_no">
            </div>
        </div>
        <div class="col-md-3">
             <div class="input-group">
                <span class="input-group-addon">Voucher No</span>
                  <input type="text" class="form-control" placeholder="Search By Voucher Number" id="voucher_no">
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
  
   <div class="modal fade in" id="view_model">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true" style="color:white;">×</span></button>
                <h4 class="modal-title text-center">Payment Details</h4>
            </div>
            <div class="modal-body">
                <div id="payment_details"></div>
            </div>
        </div>
    </div>
  </div>
  


<script>
    var agents = $("#select_agents").val();
    var voucher_no = $("#voucher_no").val();
    var policy_no = $("#policy_no").val();
  
  $(document).ready(function(){
       $('.select2').select2();
       
       $("#select_agents").change(function(){
            agents = $("#select_agents").val();
            policy_no = $("#policy_no").val();
            voucher_no = $("#voucher_no").val();
           fetch_agent_payment_details(agents,policy_no,voucher_no);
       });
       
       $("#policy_no").change(function(){
            agents = $("#select_agents").val();
            voucher_no = $("#voucher_no").val();
            policy_no = $("#policy_no").val();
           fetch_agent_payment_details(agents,policy_no,voucher_no);
       });
       
       $("#voucher_no").change(function(){
            agents = $("#select_agents").val();
            voucher_no = $("#voucher_no").val();
            policy_no = $("#policy_no").val();
           fetch_agent_payment_details(agents,policy_no,voucher_no);
       });
       
       fetch_agent_payment_details(agents,policy_no,voucher_no);     
  });

    function fetch_agent_payment_details(agents,policy_no,voucher_no)
    {
      var content = "";
      content += "<div class='table-responsive'>";
      content += "<table id='table_id' class='table table-hover table-bordered'>"; 
      content += "<thead><th>S.No</th><th>Agent Name</th><th>Agent Code</th><th>Trans. Date</th><th>Trans. Mode</th><th>Tot Agn Commission</th> <th>TDS</th><th>Trans. Created By</th></thead>";
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
            'url':'fetch_agent_payment_details',
            'method' : "POST",
            'data'   : {agents:agents,policy_no:policy_no,voucher_no:voucher_no},
          }
      });      
    }
    
    
    function view_data(id)
    {
        $.ajax({
                  url : "agent_vocher_payment_details",
                  method : "POST",
                  data : {id:id},
                  success:function(response)
                  {
                      $("#view_model").modal("toggle");
                      $("#payment_details").html(response);
                  }
        });
    }
    
    function view_vocher(vocher_no)
    {
      window.open("agent_vocher_print?vocher_no="+vocher_no,"blank");
    }
</script>
