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
        
        .table>tbody>tr>th, .table>tfoot>tr>th, .table>thead>tr>th {
             font-weight: bold;
             font-size:;
        }
    </style>
    
    <section class="content-header">
      <h1 style="font-size: 17px;">
          
            <div class="row">
                  <div class="col-md-2">
                     <div class="row">
                         <div class="col-md-12">
                             Policy Billing Select
                         </div>
                     </div>
                  </div>
                </div>
                
                <div class="row">
                    <div class="col-md-2">
                        <div class="input-group">
                            <div class="input-group-btn">
                                <button type="button" class="btn btn-default">From</button>
                            </div>
                            <input type="date" class="form-control" id="f_date" name="f_date" value="<?php echo date('Y-m-01') ?>">
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
          
                    
                  

                    <div class="col-md-3">
                        <div class="input-group">
                            <div class="input-group-btn">
                                <button type="button" class="btn btn-default">Insurance Company</button>
                            </div>
                            <select class="form-control select2" id="select_insurance" name="select_insurance">
                                <option value = "">All</option>
                            </select>
                        </div>
                    </div>
                  
                    <div class="col-md-2">
                        <button type="button" class = "btn btn-success btn-sm " onclick=get_data()><i class="fa fa-search" aria-hidden="true"></i>&nbsp;Search</button>
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
  
        var from_date = $('#f_date').val();
        var to_date = $('#to_date').val();
        $(document).ready(function(){
            $('.select2').select2();
            
            //fetch_companyfix_policy(from_date,to_date);
            
            $("#f_date").change(function(){
            from_date = $("#f_date").val();
            to_date = $("#to_date").val();
            fetch_companyfix_poilicy_list(from_date,to_date);
            fetch_companyfix_policy_insurance_company(from_date,to_date);
            });
            
            $("#to_date").change(function(){
                from_date = $("#f_date").val();
                to_date = $("#to_date").val();
                fetch_companyfix_poilicy_list(from_date,to_date);
                fetch_companyfix_policy_insurance_company(from_date,to_date);
            });
         
        });
        
    function fetch_companyfix_poilicy_list(from_date,to_date)
    {
       $.ajax({
                  url :"<?=base_url('CompanyfixCtrl/fetch_companyfix_poilicy_list')?>",
                  method : "POST",
                  data : {from_date:from_date,to_date:to_date},
                  success:function(response)
                  {
                      $("#select_agents").html(response);
                  }
           })
    }
    
    function fetch_companyfix_policy_insurance_company(from_date,to_date)
    {
       $.ajax({
                  url :"<?=base_url('CompanyfixCtrl/fetch_companyfix_policy_insurance_company')?>",
                  method : "POST",
                  data : {from_date:from_date,to_date:to_date},
                  success:function(response)
                  {
                      $("#select_insurance").html(response);
                  }
           })
    }
    
    function fetch_companyfix_policy(from_date,to_date,select_insurance)
    {
        user = $("#select_user").val();
            
           $.ajax({
                     url : "fetch_companyfix_policy",
                     method : "POST",
                     data : {from_date:from_date,to_date:to_date,select_insurance:select_insurance},
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
                        // new $.fn.dataTable.FixedHeader( oTable );
                        
                        //new $.fn.dataTable.FixedHeader( table );
                     }
           });
    }
    
    function get_data()
    {
        var from_date = $("#f_date").val();
        var to_date = $("#to_date").val();
        var select_insurance = $("#select_insurance").val();
        
        fetch_companyfix_policy(from_date,to_date,select_insurance);
    }
    
    function cancel_data(id)
    {
        if(confirm("Are you Confirm This Policy Cancel"))
        {
            
            $.ajax({
                url : "<?=base_url('CompanyfixCtrl/get_companyfix_policy_data')?>",
                method : "POST",
                data : {id:id},
                success:function(response)
                {
                   Swal.fire('All Policy Cancel Successfully!', '', 'success')
                   var select_insurance = $("#select_insurance").val();
                    fetch_companyfix_policy(from_date,to_date,select_insurance);
                }
            });
        }
    }
    
    function hold_data(id)
     {
        if(confirm("Are you Confirm This Policy Hold"))
        {
            $.ajax({
                url : "<?=base_url('CompanyfixCtrl/update_companyfix_policy_hold_list')?>",
                method : "POST",
                data : {id:id},
                success:function(response)
                {
                   Swal.fire('All Policy Cancel Successfully!', '', 'success')
                    var select_insurance = $("#select_insurance").val();
                    fetch_companyfix_policy(from_date,to_date,select_insurance);
                }
            });
        }
    }
    
    $(document).ready(function() {
        $(document).on('click', '#fix_btn', function() {
            swal.fire({
                  title: 'Are You Sure Want To Fix to Billed For All Selected Policies ?',
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
                               url : "<?=base_url('CompanyfixCtrl/fix_companyfix_commission')?>",
                               method : "POST",
                               data : {from_date:from_date,to_date:to_date,company: company},
                               success:function(response)
                               {
                                   Swal.fire('All Policy Are Updated Successfully!', '', 'success')
                                    fetch_companyfix_policy(from_date,to_date,company);
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
  </script>
