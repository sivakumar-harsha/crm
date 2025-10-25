<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    
    <style>
        label {
            font-weight:unset !important;
        }
        
         .table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
            padding: 8px;
            line-height: 1.42857143;
            font-weight: unset;
            vertical-align: top;
            border-top: 1px solid #ddd;
        }
    </style>
    
    <section class="content-header">
      <div class="box">
                    <div class="box-header with-border">
                         <h4>Agent Commission Closure</h4>
                        <div class="box-tools pull-right">
                             <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse">
                              <i class="fa fa-minus"></i></button>
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="form-group col-md-2">
                                <label for="inputState">From</label>
                                <input type="date" class="form-control" name="f_date" id="f_date" value="<?php echo date("Y-m-01") ?>">
                            </div>
                            <div class="form-group col-md-2">
                                <label for="inputState">To</label>
                               <input type="date" class="form-control" name="to_date" id="to_date" value="<?php echo date("Y-m-d") ?>">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="inputState">Company</label>
                                <select class="form-control select2" id="select_insurance" name="select_insurance">
                                    <option value = "">All</option>
                                </select>
                            </div>
                            <div class="form-group col-md-2">
                                <label for="inputState">Class</label>
                                <select class="form-control select2" id="select_class" name="select_class">
                                    <option value = "3">Both</option>
                                    <option value = "1">Motor</option>
                                    <option value = "2">Health</option>
                                </select>
                            </div>
                            
                            
                            <div class="form-group col-md-2">
                                <label for="inputState">Agent</label>
                                <select class="form-control select2" id="select_agents" name="select_agents">
                                    <option value = "">All</option>
                                </select>
                            </div>
                            <div class="form-group col-md-2">
                                <label for="inputState">User</label>
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
                            <div class="form-group col-md-1">
                                <label for="inputState">&nbsp;</label>
                                 <button type="button" class = "btn btn-success" onclick="get_data()"><i class="fa fa-search" aria-hidden="true"></i>&nbsp;Search</button>
                            </div>
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
  
  
<script src="https://cdn.datatables.net/fixedheader/2.0.6/js/FixedHeader.js"></script>
<script>
   
   var policy_arr = [];
   
   var from_date = $("#f_date").val();
   var to_date = $("#to_date").val();
   
    $(document).ready(function(){
        
         $('.select2').select2();
    
        fetch_policy_report(from_date,to_date);
        
        $("#f_date").change(function(){
            from_date = $("#f_date").val();
            to_date = $("#to_date").val();
            fetch_agent_poilicy_list(from_date,to_date);
            fetch_agent_policy_insurance_company(from_date,to_date);
             //fetch_policy_report(from_date,to_date);
        });
        
        $("#to_date").change(function(){
            from_date = $("#f_date").val();
            to_date = $("#to_date").val();
            fetch_agent_poilicy_list(from_date,to_date);
            fetch_agent_policy_insurance_company(from_date,to_date);
            //fetch_policy_report(from_date,to_date);
        });
        
        $(document).on('click', '#fix_btn', function() {
            
            swal.fire({
                  title: 'Are You Sure Want To Fix The Commission For All Selected Policies ?',
                  showDenyButton: true,
                  showCancelButton: true,
                  confirmButtonText: 'Yes',
                  denyButtonText: `No`,
                }).then((result) => {
                  if (result.isConfirmed) {
                      
                      from_date = $("#f_date").val()
                      to_date = $("#to_date").val();
                      agent = $("#select_agents").val();
                      user = $("#select_user").val();
                      company = $("#select_insurance").val();
                       
                    $.ajax({
                               url : "fix_agent_commission",
                               method : "POST",
                               data : {from_date:from_date,to_date:to_date, agent: agent, company: company, user: user},
                               success:function(response)
                               {
                                   Swal.fire('All Policy Commissions Are Updated Successfully!', '', 'success')
                                    fetch_policy_report(from_date,to_date);
                               }
                    });
                  } 
                  else if (result.isDenied) 
                  {
                    Swal.fire('Changes are not saved', '', 'info')
                  }
                })
        })

        $("#fix_btn1").click(function(){
            
            swal.fire({
                  title: 'Are You Sure Want To Fix The Commission For All Selected Policies ?',
                  showDenyButton: true,
                  showCancelButton: true,
                  confirmButtonText: 'Yes',
                  denyButtonText: `No`,
                }).then((result) => {
                  if (result.isConfirmed) {
                      
                      from_date = $("#f_date").val()
                      to_date = $("#to_date").val();
                      agent = $("#select_agents").val();
                      user = $("#select_user").val();
                      company = $("#select_insurance").val();
                       
                    $.ajax({
                               url : "fix_agent_commission",
                               method : "POST",
                               data : {from_date:from_date,to_date:to_date, agent: agent, company: company, user: user},
                               success:function(response)
                               {
                                   Swal.fire('All Policy Commissions Are Updated Successfully!', '', 'success')
                                    fetch_policy_report(from_date,to_date);
                               }
                    });
                  } 
                  else if (result.isDenied) 
                  {
                    Swal.fire('Changes are not saved', '', 'info')
                  }
                })
            
        });
        
    });
    
    
 function fetch_agent_poilicy_list(from_date,to_date)
   {

       $.ajax({
                  url :"fetch_agent_poilicy_list",
                  method : "POST",
                  data : {from_date:from_date,to_date:to_date},
                  success:function(response)
                  {
                      $("#select_agents").html(response);
                      
                  }
           
           })
   }
   
   
   function fetch_agent_policy_insurance_company(from_date,to_date)
 {

       $.ajax({
                  url :"fetch_agent_policy_insurance_company",
                  method : "POST",
                  data : {from_date:from_date,to_date:to_date},
                  success:function(response)
                  {
                      $("#select_insurance").html(response);
                      
                  }
           
           })
   }
    
    function select_all()
    {
        if($(".select_all").is(":checked"))
        { 
            $(".check").prop("checked",true);
        }
        else
        {
            $(".check").prop("checked",false);
        }
    }
        
    function fetch_policy_report(from_date,to_date,select_agents,select_insurance,select_class)
    {
        //alert(from_date+ "  to date"+to_date+"    select_agents"+select_agents+"          select_insurance"+select_insurance);
        
        user = $("#select_user").val();
           $.ajax({
                     url : "fetch_policy_report",
                     method : "POST",
                     data : {from_date:from_date,to_date:to_date,select_agents:select_agents,select_insurance:select_insurance, user:user,select_class:select_class},
                     beforeSend:function()
                     {
                         $("#table_view").html("<h4 align='center'>Loading....</h4>");
                     },
                     success:function(response)
                     {
                        $("#table_view").html(response);
                        // var oTable = $('#policy_list').dataTable( {
                        //     "bPaginate": false
                        // } );
                        //new $.fn.dataTable.FixedHeader( oTable );
                        
                        //new $.fn.dataTable.FixedHeader( table );
                     }
           });
    }
    
    function get_data()
    {
        var select_agents = $("#select_agents").val();
        var from_date = $("#f_date").val();
        var to_date = $("#to_date").val();
        var select_insurance = $("#select_insurance").val();
        var select_class = $("#select_class").val();
        //alert(from_date+ "  to date"+to_date+"    select_agents"+select_agents+"          select_insurance"+select_insurance+"    select_class"+ select_class);
        fetch_policy_report(from_date,to_date,select_agents,select_insurance,select_class);
    }
    
    
    function cancel_data(id)
    {
        if(confirm("Are you Confirm This Policy Cancel"))
        {
        $.ajax({
                     url : "get_policy_data",
                     method : "POST",
                     data : {id:id},
                     success:function(response)
                        {
                           Swal.fire('All Policy Cancel Successfully!', '', 'success')
                            fetch_policy_report(from_date,to_date);
                        }
                     
           });
    }
    
    }
    
    function hold_data(id)
     {
        if(confirm("Are you Confirm This Policy Hold"))
        {
        $.ajax({
                     url : "update_policy_hold_list",
                     method : "POST",
                     data : {id:id},
                     success:function(response)
                        {
                           Swal.fire('All Policy Cancel Successfully!', '', 'success')
                            fetch_policy_report(from_date,to_date);
                        }
                     
           });
    }
    
    }
    
    
   
</script>  
  