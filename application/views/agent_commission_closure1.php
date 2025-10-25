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
      <h1 style="font-size: 17px;">
          
            <div class="row">
                  <div class="col-md-4">
                     <div class="row">
                         <div class="col-md-12">
                             Agent Commission Closure
                         </div>
                     </div>
                  </div>
                  
                  <div class="col-md-3">
                     <div class="row">
                         <div class="col-md-4">
                             <label>From Date</label>
                         </div>
                         <div class="col-md-8">
                            <input type="date" class="form-control" name="f_date" id="f_date" value="<?php echo date("Y-m-01") ?>">
                         </div>
                     </div>
                  </div>
                  
                  <div class="col-md-3">
                     <div class="row">
                         <div class="col-md-4">
                             <label>To Date</label>
                         </div>
                         <div class="col-md-8">
                            <input type="date" class="form-control" name="to_date" id="to_date" value="<?php echo date("Y-m-d") ?>">
                         </div>
                     </div>
                  </div>
                  
                  <div class="col-md-2 pull-right">
                     <div class="row">
                         <div class="col-md-4">
                             <button class="btn btn-primary" id="fix_btn">Fix Agent Commission</button>
                         </div>
                     </div>
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
   
   var policy_arr = [];
   
   var from_date = $("#f_date").val();
   var to_date = $("#to_date").val();
   
    $(document).ready(function(){
    
        fetch_policy_report(from_date,to_date);
        
        $("#f_date").change(function(){
            from_date = $("#f_date").val();
            to_date = $("#to_date").val();
             fetch_policy_report(from_date,to_date);
        });
        
        $("#to_date").change(function(){
            from_date = $("#f_date").val();
            to_date = $("#to_date").val();
            fetch_policy_report(from_date,to_date);
        });

        $("#fix_btn").click(function(){
            
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
                       
                    $.ajax({
                               url : "fix_agent_commission",
                               method : "POST",
                               data : {from_date:from_date,to_date:to_date},
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
        
    function fetch_policy_report(from_date,to_date)
    {
           $.ajax({
                     url : "fetch_policy_report",
                     method : "POST",
                     data : {from_date:from_date,to_date:to_date},
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
    
    
    
    
</script>  
  