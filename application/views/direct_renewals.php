<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<style>
    label{
        font-weight:normal;
        font-size:17px;
    }
</style>

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
    
        <div class="row">
            <div class="col-md-2">
                <p style="font-size: 16px;">Direct Renewals</p>
            </div>
             <div class="col-md-6">
                
            </div>
            <!--<div class="col-md-3">-->
            <!--      <div class="form-group">-->
            <!--            <div class="input-group">-->
            <!--                <div class="input-group-addon">-->
            <!--                    From Date-->
            <!--            </div>-->
            <!--                     <input type="date" class="form-control" name="from_date" id="from_date" value="<?php echo date("Y-m-d") ?>">  -->
            <!--        </div>-->
            <!--      </div>-->
            <!--</div>-->
            <!--<div class="col-md-3">-->
            <!--       <div class="form-group">-->
            <!--            <div class="input-group">-->
            <!--                <div class="input-group-addon">-->
            <!--                    To Date-->
            <!--            </div>-->
            <!--                     <input type="date" class="form-control" name="to_date" id="to_date" value="<?php echo date("Y-m-d") ?>">  -->
            <!--        </div>-->
            <!--      </div>-->
            <!--</div>-->
            <div class="col-md-3">
                   <button class="btn btn-danger pull-right" style="padding: 4px 12px;" onclick='export_excel()'><i class="fa fa-file-excel-o"></i>&nbsp;Export Excel</button>
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
  
  var from_date = $("#from_date").val();
  var to_date = $("#to_date").val();
  
  $("#from_date").change(function(){
      from_date = $("#from_date").val();
      to_date = $("#to_date").val();
      fetch_all_renewals(from_date,to_date);
  });
  $("#to_date").change(function(){
      from_date = $("#from_date").val();
      to_date = $("#to_date").val();
      fetch_all_renewals(from_date,to_date);
  });
  
  $(document).ready(function(){
      fetch_all_renewals(from_date,to_date);
  });
   
    function fetch_all_renewals(from_date,to_date)
    {
          var content = "";
          content += "<div class='table-responsive'>";
          content += "<table id='table_id' class='table table-hover table-bordered'>"; 
          content += "<thead><th>S.No</th><th>Client name</th><th>Mobile Number</th><th>Class</th><th>Policy Type</th><th>Business type</th><th>Area</th><th>Model</th><th>Sub Model</th><th>Due Date</th><th>Action</th></thead>";
          content += "<tbody></tbody>";
          content += "</table>";
          content += "</div>";
          
          $("#table_view").html(content);
    
           $("#table_id").DataTable({
    		        "processing": true,
    		        "serverSide": false,
    		        "ordering": false,
    		        "pageLength": 10,
    		        "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
    		        "ajax":{
    		            'type': 'POST',
    		            'url':'fetch_direct_renewals',
    		            'data':{
    	                	from_date: from_date,
    	                	to_date:to_date,
    	                },
    		        }
	       });
        }
        
    function export_excel()
    {
        $.ajax({
                    url : "direct_renewals_excel",
                    method : "POST",
                    data : {from_date:from_date,to_date:to_date},
                    success:function(response)
                    {
                        window.location.href=response;
                    }
        });
    }
</script>