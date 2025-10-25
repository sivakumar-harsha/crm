 <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="row">
                <div class="col-md-2">
                     <h1 style="font-size: 17px;margin-top: -5px;">Agent Voucher Pending </h1>
                </div>
                
                <div class="col-md-3">
                        <div class="input-group">
                            <span class="input-group-addon">Agents</span>
                                <select class="form-control select2" name="select_agents" id="select_agents">
                                    <option value="all">All</option>
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
                        <span class="input-group-addon">From Date</span>
                          <input type="date" class="form-control" id="f_date">
                    </div>
                </div>
                
                <div class="col-md-3">
                     <div class="input-group">
                        <span class="input-group-addon">To Date</span>
                          <input type="date" class="form-control" id="to_date">
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
  
    var agent = "all";
    var f_date = "";
    var to_date = "";
  
     $(document).ready(function(){
          $('.select2').select2();
        fetch_voucher_pending_list(agent,f_date,to_date);
    
        $("#select_agents").change(function(){
            agent = $("#select_agents").val();
            f_date = $("#f_date").val();
            to_date = $("#to_date").val();
            fetch_voucher_pending_list(agent,f_date,to_date);
        });
        
        $("#f_date").change(function(){
            agent = $("#select_agents").val();
            f_date = $("#f_date").val();
            to_date = $("#to_date").val();
            fetch_voucher_pending_list(agent,f_date,to_date);
        });
        
        $("#to_date").change(function(){
            agent = $("#select_agents").val();
            f_date = $("#f_date").val();
            to_date = $("#to_date").val();
            fetch_voucher_pending_list(agent,f_date,to_date);
        });
        
     });
    
    function fetch_voucher_pending_list(agent,f_date,to_date)
    {
      var content = "";
      content += "<div class='table-responsive'>";
      content += "<table id='table_id' class='table table-hover table-bordered'>"; 
      content += "<thead><th>S.No</th><th>Agn_code</th><th>Voucher_no</th><th>Date</th><th>Total Agent Com</th><th>Tds</th><th>Net Amount</th></thead>";
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
            'url':'fetch_agent_voucher_pending',
            'method' : "POST",
            'data' : {agent:agent,f_date:f_date,to_date:to_date},
          }
      });      
    }
  </script>