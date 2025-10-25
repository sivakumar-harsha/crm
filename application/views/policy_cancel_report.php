<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    
    
    <section class="content-header">
      <h1 style="font-size: 17px;">
          
            <div class="row">
                  <div class="col-md-3">
                     <div class="row">
                         <div class="col-md-12">
                             Policy Cancel Report
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
  
      $(document).ready(function(){
          
          fetch_policy_cancel_report();
          
      });
  
   function fetch_policy_cancel_report()
   {
           $.ajax({
                     url : "fetch_policy_cancel_report",
                     method : "POST",
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
    
    function recover_data(id)
    {
        if(confirm("Are you Confirm Recover This Policy "))
        {
        $.ajax({
                     url : "updata_policy_recover",
                     method : "POST",
                     data : {id:id},
                     success:function(response)
                        {
                           Swal.fire('All Policy Recover Successfully!', '', 'success')
                            fetch_policy_cancel_report();
                        }
                     
           });
    }
    
    }
      
      
      
  </script>