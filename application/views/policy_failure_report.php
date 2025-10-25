<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
     <h1 style="font-size: 17px;">
                      Policy Failure Report
                      <?php if($this->session->userdata('session_role') != "user" && $this->session->userdata('session_role') != "AI") { ?>
                    <button type="button" class="btn btn-danger btn-sm pull-right" style='margin-top: -8px;' id="export_btn" onclick="export_excel()"><i class="fa fa-file-excel-o"></i> Export Excel</button>
                     <?php }
            
                   ?>
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
                            <button type="button" class="btn btn-default">Policy Type</button>
                    </div>
                        <select class="form-control" id="select_policy_type" name="select_policy_type">
                             <option value="all">All</option>
                                 <option value="">--Select Policy Type--</option>
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
                    <input type="date" class="form-control" id="to_date" name="to_date" value="<?php echo date('Y-m-d', strtotime('-1 day', strtotime(date("Y-m-d")))) ?>"> 
                </div>
          </div>
          
         
           <div class="col-md-2">
                <div class="input-group">
                    <div class="input-group-btn">
                            <button type="button" class="btn btn-default">User</button>
                    </div>
                    <select class="form-control select2" id="select_foe">
                        <option value="All">ALL</option>
                          <?php foreach($users as $da){ ?>
                             <option value="<?php echo $da->id ?>"><?php echo $da->name ?></option>
                             <?php } ?>
                    </select>
                </div>
          </div>
          
          
          <div class="col-md-2">
               <button type="button" class = "btn btn-success btn-sm pull-right" onclick=get_data()><i class="fa fa-search" aria-hidden="true"></i>&nbsp;Search</button>
          </div>
          
      </div>
      
      
    </section>
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
        var select_class = $("#select_class").val();
        var policy_type = $("#select_policy_type").val();
        var from_date = $("#from_date").val();
        var to_date = $("#to_date").val();
        var foe = $("#select_foe").val();
      
  
      $(document).ready(function(){
          
        $('.select2').select2();

          fetch_policy_failure_report(select_class,policy_type,from_date,to_date,foe);
          
     
          $("#select_class").change(function(){
                ins_company = $("#select_insurer").val();
                select_class = $("#select_class").val();
                policy_type = $("#select_policy_type").val();
                from_date = $("#from_date").val();
                to_date = $("#to_date").val();
                foe = $("#select_foe").val();
                
                
                $.ajax({
                            url : "fetch_policy_type_using_class",
                            method : "POST",
                            data : {policy_class:select_class},
                            success:function(response)
                            {
                                var obj = jQuery.parseJSON(response);
                                var content = "<option value = 'All'>All</option>";
                                for(var i = 0;i<obj.length;i++)
                                {
                                   content += "<option value="+obj[i].id+">"+obj[i].policy_type+"</option>";
                                }
                                $("#select_policy_type").html(content);
                            }
               });
               
                //fetch_policy_failure_report(select_class,policy_type,from_date,to_date,foe);
          });
          
          $("#select_policy_type").change(function(){
                ins_company = $("#select_insurer").val();
                select_class = $("#select_class").val();
                policy_type = $("#select_policy_type").val();
                from_date = $("#from_date").val();
                to_date = $("#to_date").val();
                foe = $("#select_foe").val();

                //fetch_policy_failure_report(select_class,policy_type,from_date,to_date,foe);
          });
          
          $("#from_date").change(function(){
                ins_company = $("#select_insurer").val();
                select_class = $("#select_class").val();
                policy_type = $("#select_policy_type").val();
                from_date = $("#from_date").val();
                to_date = $("#to_date").val();
                foe = $("#select_foe").val();
                //fetch_policy_failure_report(select_class,policy_type,from_date,to_date,foe);
          });
          
          $("#to_date").change(function(){
                ins_company = $("#select_insurer").val();
                select_class = $("#select_class").val();
                policy_type = $("#select_policy_type").val();
                from_date = $("#from_date").val();
                to_date = $("#to_date").val();
                foe = $("#select_foe").val();
                //fetch_policy_failure_report(select_class,policy_type,from_date,to_date,foe);
          });
          
          $("#select_foe").change(function(){
                ins_company = $("#select_insurer").val();
                select_class = $("#select_class").val();
                policy_type = $("#select_policy_type").val();
                from_date = $("#from_date").val();
                to_date = $("#to_date").val();
                foe = $("#select_foe").val();
              // fetch_policy_failure_report(select_class,policy_type,from_date,to_date,foe);
          });
          
          $("#search_lead").change(function(){
              ins_company = $("#select_insurer").val();
                select_class = $("#select_class").val();
                policy_type = $("#select_policy_type").val();
                from_date = $("#from_date").val();
                to_date = $("#to_date").val();
                foe = $("#select_foe").val();
                //fetch_policy_failure_report(select_class,policy_type,from_date,to_date,foe);
              
          });
      
      
      $("#vehicle_regn").change(function(){
               ins_company = $("#select_insurer").val();
                select_class = $("#select_class").val();
                policy_type = $("#select_policy_type").val();
                from_date = $("#from_date").val();
                to_date = $("#to_date").val();
                foe = $("#select_foe").val();
               //fetch_policy_failure_report(select_class,policy_type,from_date,to_date,foe);
          
      });
      
        
      });
      
      function fetch_policy_failure_report(select_class,policy_type,from_date,to_date,foe)
      {
          $.ajax({
                     url : "fetch_policy_failure_report",
                     method : "POST",
                     data : {select_class:select_class,policy_type:policy_type,from_date:from_date,to_date:to_date,foe:foe},
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
            ins_company = $("#select_insurer").val();
            select_class = $("#select_class").val();
            policy_type = $("#select_policy_type").val();
            from_date = $("#from_date").val();
            to_date = $("#to_date").val();
            foe = $("#select_foe").val();
            
            
          $.ajax({
                     url : "fetch_policy_failure_report_excel",
                     method : "POST",
                     data : {select_class:select_class,policy_type:policy_type,from_date:from_date,to_date:to_date,foe:foe},
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
        policy_type = $("#select_policy_type").val();
        from_date = $("#from_date").val();
        to_date = $("#to_date").val();
        foe = $("#select_foe").val();
        fetch_policy_failure_report(select_class,policy_type,from_date,to_date,foe);
      }
  </script>