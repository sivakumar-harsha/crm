	
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1 style="font-size: 17px;">
      Failure Leads
              <button type="button" class="btn btn-danger btn-sm pull-right" style='margin-top: -8px;' id="export_btn" onclick="export_excel()"><i class="fa fa-file-excel-o"></i> Export Excel</button>

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
      fetch_failurelead();

  

    });
    function fetch_failurelead()
    {
      var content = "";
      content += "<div class='table-responsive'>";
      content += "<table id='table_id' class='table table-hover table-bordered'>"; 
      content += "<thead><th>S.No</th><th>Name</th><th>ph.no</th><th>businesstype</th><th>class</th><th>policytype</th><th>ex.date</th><thead>";
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
            'url':'fetch_failurelead',
          }
      });      
    }
   function export_excel()
   {
        $.ajax({
                     url : "fetch_export_excel",
                
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
  </script>