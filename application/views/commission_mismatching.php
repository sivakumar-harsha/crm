 <!-- Content Wrapper. Contains page content -->
  
  <style>
      label {
    display: inline-block;
    max-width: 100%;
    margin-bottom: 5px;
    font-weight: unset !important;
}
  </style>

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1 style="font-size: 17px;">
        Commission Mismatching List
        
         <div class="row">
             <div class="col-md-3">
             </div>
             <div class="col-md-3">
                 <div class="form-group"> 
                 <label>From Date</label>
                     <input type="date" class="form-control" name="from_date" id="from_date" value ="<?php echo date("Y-m-01") ?>">
                 </div>
             </div>
              <div class="col-md-3">
                 <div class="form-group">
                     <label>To Date</label>
                     <input type="date" class="form-control" name="to_date" id="to_date" value ="<?php echo date("Y-m-t")  ?>">
                 </div>
             </div>
              <div class="col-md-3">
                  <br>
                 <button class="btn btn-primary" id="sub_btn">Submit</button>
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
    
      var from_date = $("#from_date").val();
       var to_date  = $("#to_date").val();
             
     $(document).ready(function(){
         fetch_mismatch_list(from_date,to_date);
         
         $("#sub_btn").click(function(){
             var from_date = $("#from_date").val();
             var to_date  = $("#to_date").val();
             fetch_mismatch_list(from_date,to_date);
         });
         
    });
        
       
   
    function fetch_mismatch_list(from_date,to_date)
    {
                var content = "";
                content += "<div class='table-responsive'>";
                content += "<table id='table_id' class='table table-hover table-bordered'>"; 
                content += "<thead><th>S.no</th><th>Reason</th><th>Lead id</th><th>Ins Company</th><th>Policy Type</th><th>Rto / CC / GVW</th></thead>";
                content += "<tbody></tbody>";
                content += "</table>";
                content += "</div>";
                $("#table_view").html(content);
                         
                $("#table_id").DataTable({
        		       "processing": true,
        		        "serverSide": true,
        		        "ordering": false,
        		        "pageLength": 10,
        		        "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
        		        "ajax":{
        		            'type': 'POST',
        		            'url':'fetch_mismatch_list',
        		            'data':{
        	                	from_date:from_date,
        	                	to_date:to_date,
        	                },
        		        }
               });
    }
    </script>