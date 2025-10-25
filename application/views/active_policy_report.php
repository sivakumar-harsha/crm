 <style>
       
.table-responsive>.table>tbody>tr>td, .table-responsive>.table>tbody>tr>th, .table-responsive>.table>tfoot>tr>td, .table-responsive>.table>tfoot>tr>th, .table-responsive>.table>thead>tr>td, .table-responsive>.table>thead>tr>th {
    white-space: nowrap;
    font-weight: unset;
}
      </style>
 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1 style="font-size: 17px;">
        Active Policy Report
        
    <?php if($this->session->userdata('session_role') != "user" && $this->session->userdata('session_role') != "AI") { ?>
        <button type="button" class="btn btn-danger btn-sm pull-right" style='margin-top: -8px;' id="export_btn" onclick="export_excel()"><i class="fa fa-file-excel-o"></i> Export Excel</button>
        <?php }
            
            
            ?>
            
      </h1>
     
      
      
      <div class="row">
          
          <div class="col-md-2">
                <div class="input-group">
                    <div class="input-group-btn">
                            <button type="button" class="btn btn-default">Insurer</button>
                    </div>
                        <select class="form-control" id="select_insurer" name="select_insurer">
                             <option value="all">All</option>
                                 <?php foreach($ins_company as $da) { ?>
                                    <option value="<?php echo $da->id ?>"><?php echo $da->company_name ?></option>
                                 <?php } ?>
                        </select>
                </div>
          </div>

          <div class="col-md-2">
                <div class="input-group">
                    <div class="input-group-btn">
                            <button type="button" class="btn btn-default">Class</button>
                    </div>
                        <select class="form-control" id="select_class" name="select_class">
                             <option value="all">All</option>
                             <?php foreach($class as $da){ ?>
                             <option value="<?php echo $da->id ?>"><?php echo $da->class ?></option>
                             <?php } ?>
                        </select>
                </div>
          </div>
          
          <div class="col-md-2">
                <div class="input-group">
                    <div class="input-group-btn">
                            <button type="button" class="btn btn-default">Policy Cover</button>
                    </div>
                        <select class="form-control" id="select_c_type" name="select_c_type">
                             <option value="all">All</option>
                                <?php foreach($cover as $da){ ?>
                                 <option value="<?php echo $da->id ?>"><?php echo $da->name ?></option>
                                 <?php } ?>
                        </select>
                </div>
          </div>
          
          <div class="col-md-2">
                <div class="input-group">
                    <div class="input-group-btn">
                            <button type="button" class="btn btn-default">From</button>
                    </div>
                    <input type="date" class="form-control" id="from_date" name="from_date" value="<?php echo date('Y-m-01') ?>">
                </div>
          </div>
          
          <div class="col-md-2">
                <div class="input-group">
                    <div class="input-group-btn">
                            <button type="button" class="btn btn-default">To Date</button>
                    </div>
                    <input type="date" class="form-control" id="to_date" name="to_date" value="<?php echo date('Y-m-t') ?>"> 
                </div>
          </div>
          
           <div class="col-md-2">
               <button type="button" class = "btn btn-success btn-sm pull-right" onclick=get_data()><i class="fa fa-search" aria-hidden="true"></i>&nbsp;Search</button>
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
  
      var ins_company = $("#select_insurer").val();
      var select_class = $("#select_class").val();
      var select_c_type = $("#select_c_type").val();
      var from_date = $("#from_date").val();
      var to_date = $("#to_date").val();
  
      $(document).ready(function(){
          fetch_active_policy(ins_company,select_class,select_c_type,from_date,to_date);
          
          
          $("#select_insurer").change(function(){
                ins_company = $("#select_insurer").val();
                select_class = $("#select_class").val();
                select_c_type = $("#select_c_type").val();
                from_date = $("#from_date").val();
                to_date = $("#to_date").val();
                //fetch_active_policy(ins_company,select_class,select_c_type,from_date,to_date);
          });
          
          $("#select_class").change(function(){
                ins_company = $("#select_insurer").val();
                select_class = $("#select_class").val();
                select_c_type = $("#select_c_type").val();
                from_date = $("#from_date").val();
                to_date = $("#to_date").val();
                //fetch_active_policy(ins_company,select_class,select_c_type,from_date,to_date);
          });
          
          $("#select_c_type").change(function(){
                ins_company = $("#select_insurer").val();
                select_class = $("#select_class").val();
                select_c_type = $("#select_c_type").val();
                from_date = $("#from_date").val();
                to_date = $("#to_date").val();
                //fetch_active_policy(ins_company,select_class,select_c_type,from_date,to_date);
          });
          
          $("#from_date").change(function(){
                ins_company = $("#select_insurer").val();
                select_class = $("#select_class").val();
                select_c_type = $("#select_c_type").val();
                from_date = $("#from_date").val();
                to_date = $("#to_date").val();
                //fetch_active_policy(ins_company,select_class,select_c_type,from_date,to_date);
          });
          
          $("#to_date").change(function(){
              ins_company = $("#select_insurer").val();
                select_class = $("#select_class").val();
                select_c_type = $("#select_c_type").val();
                from_date = $("#from_date").val();
                to_date = $("#to_date").val();
                //fetch_active_policy(ins_company,select_class,select_c_type,from_date,to_date);
          });
          
      });
      
      function fetch_active_policy(ins_company,select_class,select_c_type,from_date,to_date)
      {
          $.ajax({
                     url : "fetch_active_policy_report",
                     method : "POST",
                     data : {ins_company:ins_company,select_class:select_class,select_c_type:select_c_type,from_date:from_date,to_date:to_date},
                     beforeSend:function()
                     {
                         $("#table_view").html("<h4 align='center'>Loading....</h4>");
                     },
                     success:function(response)
                     {
                         $("#table_view").html(response);
                     }
          });
      }
      
      function export_excel()
      {
          $.ajax({
                     url : "fetch_active_policy_report_excel",
                     method : "POST",
                     data : {ins_company:ins_company,select_class:select_class,select_c_type:select_c_type,from_date:from_date,to_date:to_date},
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
      
      
    function get_data()
      {
               ins_company = $("#select_insurer").val();
                select_class = $("#select_class").val();
                select_c_type = $("#select_c_type").val();
                from_date = $("#from_date").val();
                to_date = $("#to_date").val();
                fetch_active_policy(ins_company,select_class,select_c_type,from_date,to_date);
      }
  </script>