 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1 style="font-size: 17px;">
        Claim Report
        <button data-toggle="modal" data-target="#add_model" class="btn btn-primary btn-sm pull-right">Add New</button>
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
      fetch_claim_dateils();
    
    });
    

       function fetch_claim_dateils()
      {
          var content = "";
          content += "<div class='table-responsive'>";
          content += "<table id='table_id' class='table table-hover table-bordered'>"; 
          content += "<thead><th>S.No</th><th>ClientName</th><th>Contact Person</th><th>Contact Designation</th><th>Mobile No</th><th>Remarks</th><th>Date</th></thead>";
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
                'url':'fetch_claim_dateils',
              }
          });      
      }
      
      
      function view_data(id)
      {
        $.ajax({
                   url : "fetch_claim_contact_details",
                   method : "POST",
                   data : {id:id},
                   success:function(response)
                   {
                    var obj = jQuery.parseJSON(response);
                       
      
       
    </script>