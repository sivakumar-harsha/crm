<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1 style="font-size: 17px;">
         Business Report
         <?php if($this->session->userdata('session_role') != "user" && $this->session->userdata('session_role') != "AI") { ?>
        <button type="button" class="btn btn-danger btn-sm pull-right" style='margin-top: -13px;' id="export_btn" onclick="export_excel()"><i class="fa fa-file-excel-o"></i> Export Excel</button>
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
          
          <div class="col-md-3">
                <div class="input-group">
                    <div class="input-group-btn">
                            <button type="button" class="btn btn-default">Insurer</button>
                    </div>
                        <select class="form-control select2" id="select_insurer" name="select_insurer">
                             <option value="All">All</option>
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
                             <option value="All">All</option>
                             <?php foreach($class as $da){ ?>
                             <option value="<?php echo $da->id ?>"><?php echo $da->class ?></option>
                             <?php } ?>
                        </select>
                </div>
          </div>
          
          <div class="col-md-4">
                <div class="input-group">
                    <div class="input-group-btn">
                            <button type="button" class="btn btn-default">Policy Type</button>
                    </div>
                        <select class="form-control" id="select_policy_type" name="select_policy_type">
                            <option value = "All">All</option>
                        </select>
                </div>
          </div>
          
          <div class="col-md-3">
                <div class="input-group">
                    <div class="input-group-btn">
                            <button type="button" class="btn btn-default">Agent</button>
                    </div>
                    <select class="form-control select2" id="agent">
                        <option value="All">ALL</option>
                            <?php foreach($agents as $da){ ?>
                               <option value="<?php echo $da->id ?>"><?php echo $da->name;  ?></option>
                            <?php } ?>
                    </select>
                </div>
          </div>
          
          
          <div class="col-md-3">
                <div class="input-group">
                    <div class="input-group-btn">
                            <button type="button" class="btn btn-default">Area Incharge</button>
                    </div>
                    <select class="form-control select2" id="area_incharge">
                        <option value="All">ALL</option>
                          <?php foreach($area_incharge as $da){ ?>
                             <option value="<?php echo $da->id ?>"><?php echo $da->name ?></option>
                             <?php } ?>
                    </select>
                </div>
          </div>
          
          
           <div class="col-md-3">
                <div class="input-group">
                    <div class="input-group-btn">
                            <button type="button" class="btn btn-default">User</button>
                    </div>
                    <select class="form-control select2" id="user">
                        <?php  if($userid == 1){ ?>
                        <option value="All">ALL</option> 
                        <?php } ?>
                          <?php foreach($users as $da){ ?>
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
  
  <script src="<?=base_url()?>datas/js/freeze-table.js"></script>
  <script>
  
      var ins_company = $("#select_insurer").val();
      var select_class = $("#select_class").val();
      var agent = $("#agent").val();
      var from_date = $("#from_date").val();
      var to_date = $("#to_date").val();
      var area_incharge = $("#area_incharge").val();
      var user = $("#user").val();
      var policy_type = $("#select_policy_type").val();
  
      $(document).ready(function(){
          
        $('.select2').select2();

          fetch_active_policy(ins_company,policy_type,select_class,agent,from_date,to_date,area_incharge,user);
          
          
          $("#select_insurer").change(function(){
                ins_company = $("#select_insurer").val();
                select_class = $("#select_class").val();
                agent = $("#agent").val();
                from_date = $("#from_date").val();
                to_date = $("#to_date").val();
                area_incharge = $("#area_incharge").val();
                user = $("#user").val();
                policy_type = $("#select_policy_type").val();
                //fetch_active_policy(ins_company,policy_type,select_class,agent,from_date,to_date,area_incharge,user);
          });
          
          $("#select_class").change(function(){
                ins_company = $("#select_insurer").val();
                select_class = $("#select_class").val();
                agent = $("#agent").val();
                from_date = $("#from_date").val();
                to_date = $("#to_date").val();
                area_incharge = $("#area_incharge").val();
                user = $("#user").val();
                policy_type = $("#select_policy_type").val();
                
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
               
               //fetch_active_policy(ins_company,policy_type,select_class,agent,from_date,to_date,area_incharge,user);
          });
          
          
          $("#select_policy_type").change(function(){
                ins_company = $("#select_insurer").val();
                select_class = $("#select_class").val();
                agent = $("#agent").val();
                from_date = $("#from_date").val();
                to_date = $("#to_date").val();
                area_incharge = $("#area_incharge").val();
                user = $("#user").val();
                policy_type = $("#select_policy_type").val();
                //fetch_active_policy(ins_company,policy_type,select_class,agent,from_date,to_date,area_incharge,user);
                
          });
          
          $("#agent").change(function(){
                ins_company = $("#select_insurer").val();
                select_class = $("#select_class").val();
                agent = $("#agent").val();
                from_date = $("#from_date").val();
                to_date = $("#to_date").val();
                area_incharge = $("#area_incharge").val();
                user = $("#user").val();
                policy_type = $("#select_policy_type").val();
                //fetch_active_policy(ins_company,policy_type,select_class,agent,from_date,to_date,area_incharge,user);
          });
          
          $("#from_date").change(function(){
                var date = new Date($('#from_date').val());
                var lastday = new Date(date.getFullYear(), date.getMonth() + 1, 1);
                date.setDate(date.getDate() + 30); // Set now + 30 days as the new date
                let day = date.getDate();
                let month = date.getMonth();
                month = month + 1;
                
                let year = date.getFullYear();
                
                if (day < 10) {
                    day = '0' + day;
                }
                
                if (month < 10) {
                    month = `0${month}`;
                }

                var setday = year+'-'+month+'-'+day;
                
                $("#to_date").val(setday);
                
                $("#to_date").attr('min', $('#from_date').val());
                $("#to_date").attr('max', setday);
                
                ins_company = $("#select_insurer").val();
                select_class = $("#select_class").val();
                agent = $("#agent").val();
                from_date = $("#from_date").val();
                to_date = $("#to_date").val();
                area_incharge = $("#area_incharge").val();
                user = $("#user").val();
                policy_type = $("#select_policy_type").val();
                //fetch_active_policy(ins_company,policy_type,select_class,agent,from_date,to_date,area_incharge,user);
          });
          
          $("#to_date").change(function(){
               ins_company = $("#select_insurer").val();
                select_class = $("#select_class").val();
                agent = $("#agent").val();
                from_date = $("#from_date").val();
                to_date = $("#to_date").val();
                area_incharge = $("#area_incharge").val();
                user = $("#user").val();
                policy_type = $("#select_policy_type").val();
                //fetch_active_policy(ins_company,policy_type,select_class,agent,from_date,to_date,area_incharge,user);
          });
          
          
          $("#area_incharge").change(function(){
              
               ins_company = $("#select_insurer").val();
                select_class = $("#select_class").val();
                agent = $("#agent").val();
                from_date = $("#from_date").val();
                to_date = $("#to_date").val();
                area_incharge = $("#area_incharge").val();
                user = $("#user").val();
                policy_type = $("#select_policy_type").val();
                //fetch_active_policy(ins_company,policy_type,select_class,agent,from_date,to_date,area_incharge,user);
          });
          
          
          $("#user").change(function(){
               ins_company = $("#select_insurer").val();
                select_class = $("#select_class").val();
                agent = $("#agent").val();
                from_date = $("#from_date").val();
                to_date = $("#to_date").val();
                area_incharge = $("#area_incharge").val();
                user = $("#user").val();
                policy_type = $("#select_policy_type").val();
                //fetch_active_policy(ins_company,policy_type,select_class,agent,from_date,to_date,area_incharge,user);
          });
          

      });
      
      function fetch_active_policy(ins_company,policy_type,select_class,agent,from_date,to_date,area_incharge,user)
      {
          $.ajax({
                     url : "fetch_agent_business_report",
                     method : "POST",
                     data : {ins_company:ins_company,policy_type:policy_type,select_class:select_class,agent:agent,from_date:from_date,to_date:to_date,area_incharge:area_incharge,user:user},
                     beforeSend:function()
                     {
                         $("#table_view").html("<h4 align='center'>Loading....</h4>");
                     },
                     success:function(response)
                     {
                        $("#table_view").html(response);
                        $(".table-with-scrollbar").freezeTable({
                            //'headWrapStyles': {'box-shadow': '0px 9px 10px -5px rgba(159, 159, 160, 0.8)'},
                            //'shadow': true,
                            'scrollBar': true,
                        });
                     }
          });
      }
      
      function export_excel()
      {
                ins_company = $("#select_insurer").val();
                select_class = $("#select_class").val();
                agent = $("#agent").val();
                from_date = $("#from_date").val();
                to_date = $("#to_date").val();
                area_incharge = $("#area_incharge").val();
                user = $("#user").val();
                policy_type = $("#select_policy_type").val();
                
          $.ajax({
                     url : "agent_business_report_excel",
                     method : "POST",
                     data : {ins_company:ins_company,select_class:select_class,policy_type:policy_type,agent:agent,from_date:from_date,to_date:to_date,area_incharge:area_incharge,user:user},
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
                agent = $("#agent").val();
                from_date = $("#from_date").val();
                to_date = $("#to_date").val();
                area_incharge = $("#area_incharge").val();
                user = $("#user").val();
                policy_type = $("#select_policy_type").val();
                fetch_active_policy(ins_company,policy_type,select_class,agent,from_date,to_date,area_incharge,user);
      }
  </script>