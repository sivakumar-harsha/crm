<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1 style="font-size: 17px;">
         Monthly Business Report
        <button type="button" class="btn btn-danger btn-sm pull-right" style='margin-top: -13px;' id="export_btn" onclick="export_excel()"><i class="fa fa-file-excel-o"></i> Export Excel</button>
      </h1>
      
  <style>
       
.table-responsive>.table>tbody>tr>td, .table-responsive>.table>tbody>tr>th, .table-responsive>.table>tfoot>tr>td, .table-responsive>.table>tfoot>tr>th, .table-responsive>.table>thead>tr>td, .table-responsive>.table>thead>tr>th {
    white-space: nowrap;
    font-weight: unset;
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
.select2-container .select2-selection--single {
    box-sizing: border-box;
    cursor: pointer;
    display: block;
    height: 34px;
    user-select: none;
    -webkit-user-select: none;
}
      </style>
      
      <div class="row">
          
          <div class="col-md-2">
                <div class="input-group">
                    <div class="input-group-btn">
                            <button type="button" class="btn btn-default">From</button>
                    </div>
                    <input type="text" class="form-control" id="from_limit" name="from_limit">
                </div>
          </div>
          
          <div class="col-md-2">
                <div class="input-group">
                    <div class="input-group-btn">
                            <button type="button" class="btn btn-default">To</button>
                    </div>
                    <input type="text" class="form-control" id="to_limit" name="to_limit"> 
                </div>
          </div>
          
          <div class="col-md-4">
                <div class="input-group">
                    <div class="input-group-btn">
                            <button type="button" class="btn btn-default">Report</button>
                        </div>
                        <select class = "form-control" name="report_status" id="report_status">
                            <option value = "insurer_wise">Insurance company wise</option>
                            <option value = "Area_incharge_wise">Area_incharge_wise</option>
                             <option value = "policy_class_wise">policy_class_wise</option>
                             <option value = "policy_type_wise">policy_type_wise</option>
                            <option value = "Agent_wise">Agent_wise</option>
                        </select>
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
  
      var from_limit = $("#from_limit").val()
      var to_limit = $("#to_limit").val();
      var report_status = $("#report_status").val();
  
      $(document).ready(function(){
        $('.select2').select2();
          fetch_monthly_report(from_limit,to_limit,report_status);
      });
      
      function fetch_monthly_report(from_limit,to_limit,report_status)
      {
          if(from_limit != "" && to_limit != "" && report_status != "" )
          {
                $.ajax({
                     url : "fetch_monthly_report",
                     method : "POST",
                     data : {from_limit:from_limit,to_limit:to_limit,report_status:report_status},
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
      }
     
      function get_data()
      {
            var from_limit = $("#from_limit").val()
            var to_limit = $("#to_limit").val();
            var report_status = $("#report_status").val();
            
            alert(from_limit);
            
            fetch_monthly_report(from_limit,to_limit,report_status);
      }
  </script>