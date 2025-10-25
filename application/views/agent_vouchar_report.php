<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <style>
        label 
        {
            font-weight:unset !important;
        }
         .table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
            padding: 8px;
            line-height: 1.42857143;
            font-weight: unset;
            vertical-align: top;
            border-top: 1px solid #ddd;
        }
                
        .btn {
            border-radius: 8px;
            -webkit-box-shadow: none;
            box-shadow: none;
            border: 1px solid transparent;
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
        
    </style>
    
    <section class="content-header">
        <h1 style="font-size: 17px;">
            <div class="row">
                <div class="col-md-12">
                    Agent Vouchar Report
                </div>
            </div>
        </h1>
        
        <div class="row">
                <div class="col-md-2">
                	<div class="form-group">
                		<label for="fromdate" class="col-xs-3 control-label">From Date</label>
                		<div class="col-xs-9">		
                			<input type="date" name="fromdate" id="fromdate" class="form-control" value="<?=(isset($voucharinfo->from_date) && !empty($voucharinfo->from_date)) ? $voucharinfo->from_date : null?>"/>
                		</div>
                	</div>
                </div>
                
                <div class="col-md-2">
                	<div class="form-group">
                		<label for="todate" class="col-xs-3 control-label">To Date</label>
                		<div class="col-xs-9">		
                			<input type="date" name="todate" id="todate" class="form-control" value="<?=(isset($voucharinfo->to_date) && !empty($voucharinfo->to_date)) ? $voucharinfo->to_date : null?>"/>
                		</div>
                	</div>
                </div>
                
                <div class="col-md-4">
                	<div class="form-group">
                		<label for="select_agents" class="col-xs-4 control-label">Select Agents</label>
                		<div class="col-xs-8">		
                			<select class="form-control select2" name="select_agents" id="select_agents"  style="width:100%"> <!--onchange="fetch_agent_vouchar_report()"//-->
                	               <option value="" selected>All Agents</option>
                	               <?php if( isset( $agentvoucharlist ) && !empty( $agentvoucharlist ) ):?>
                	                    <?php foreach( $agentvoucharlist as $row ):?>
                	                        <option value="<?=$row->id?>"><?=$row->name?> - <?=$row->agent_pos_code?></option>
                	                    <?php endforeach;?>
                	               <?php endif;?>
                          	</select>
                		</div>
                	</div>
                </div>
                
                <div class="col-md-3">
                	<div class="form-group">
                		<label for="select_user" class="col-xs-3 control-label">Users</label>
                		<div class="col-xs-9">		
                			<select class="form-control select2" id="select_user" name="select_user">
                                <option value = "">All</option>
                                <?php if(isset($userslist) && !empty( $userslist) ):?>
                                    <?php foreach($userslist as $user):?>
                                        <option value="<?=$user->id?>">
                                            <?=$user->username?>
                                        </option>
                                    <?php endforeach;?>
                                <?php endif;?>
                            </select>
                		</div>
                	</div>
                </div>
                
                <div class="col-md-1">
            		<div class="col-xs-12">
            			<button class="btn btn-danger" onclick=fetch_agent_vouchar_report()><i class="fa fa-search"></i>&nbsp;Search</button>
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
   
   var policy_arr = [];
   
   //var autoload = '<?=( isset( $voucharinfo->from_date ) && !empty( $voucharinfo->from_date) ) ? "true" : "false"?>';
   
   var autoload = '<?=( isset( $_GET['autoload'] ) && !empty( $_GET['autoload'] ) ) ? "true" : "false"?>';
   
    $(document).ready(function(){
        
        
        // console.log(autoload)
        if( autoload == "true") {
            fetch_agent_vouchar_report();
        }
        $('.select2').select2();
        
        
        $("#todate").change(function(){
            getAgent();
        });
        
        
    });

    function fetch_agent_vouchar_report()
    {
        agent_id = $("#select_agents").val();
        fromdate = $("#fromdate").val();
        todate   = $("#todate").val();
        user     = $("#select_user").val();
        
        if(fromdate && todate){
            $.ajax({
                     url : "fetch_agent_vouchar_report",
                     method : "POST",
                     data : {fromdate:fromdate,todate:todate, agents:agent_id, user: user},
                     beforeSend: function(){
                         $("#table_view").html('Loading...')
                     },
                     success:function(response)
                     {
                         $("#table_view").html(response);
                     }
            });
        }
    }
    
    function export_excel()
    {
        select_agents   = $("#select_agents").val();
        from_date       = $("#fromdate").val();
        to_date         = $("#todate").val();
        
        $.ajax({
            url : "export_agent_vouchar_excel",
            method : "POST",
            data : {from_date:from_date,to_date:to_date,agents:select_agents},
            success:function(response)
            {
                window.location.href=response;
            }
        });
    }
    
    function exportpdf(vocher_no, vocher_date, agent, org)
    {
        var url = "agent_vocher_pdf";
        
        if(org == "1"){
            url = "agent_vocher_pdf";
        }else if(org == "2"){
            url = "agent_vocher_orc_pdf";
        }
        
        var policy_arr = [];
        select_agents = $("#select_agents").val();
        month = $("#month").val();
        
        $(".check_"+agent).each(function(){
            policy_arr.push($(this).val()); 
        }); 
          
        $.ajax({
            url : url,
            method : "GET",
            dataType: "json",
            data : {month:month,agents:agent,policy_arr:policy_arr,vocher_no:vocher_no, v_date: vocher_date},
            success:function(response)
            {
                var size = Object.keys(response).length;
                console.log(response);
                if(size > 0){
                    if(response.status == "true") {
                        window.open(response.file ,"blank");
                    }
                }
                
             //window.location.href=response;
            }
        });
    }
    
    function getAgent()
    {
        fromdate = $("#fromdate").val();
        todate = $("#todate").val();
        
        if(fromdate && todate) {
            $("#select_agents").find('option').remove();
            $.ajax({
                 url : "getVoucharAgents",
                 method : "POST",
                 data:{fromdate:fromdate, todate: todate},
                 dataType: "json",
                 success:function(response)
                 {
                     var obj = response;//jQuery.parseJSON(response);
                     var size = Object.keys(obj).length;
                     if(size > 0){
                         $("#select_agents").append("<option value=''>All</option>")
                         for(var i= 0;i<obj.length;i++)
                         {
                             $("#select_agents").append("<option value='"+obj[i].id+"'>"+obj[i].name+" - "+obj[i].agent_pos_code+"</option>");
                         }
                         
                         $("#select_agents").trigger("change");
                     } else {
                         $("#table_view").html('')
                     }
                 }
            });
        }
        
    }
    

</script>  
  