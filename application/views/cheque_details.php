 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
 <div class="row">
      <h1 style="font-size: 17px;">
       Cheque Details
      </h1>
     

          
          <div class="col-md-2">
                <div class="input-group">
                    <div class="input-group-btn">
                            <button type="button" class="btn btn-default">Cheque Status</button>
                    </div>
                        <select class="form-control" id="select_cheque_status" name="select_cheque_status">
                             <option value="1">Cheque issued</option>
                             <option value="2">Cheque Received</option>
                             <option value="3">TR Number</option>
                        </select>
                </div>
          </div>

          <div class="col-md-2">
                <div class="input-group">
                    <div class="input-group-btn">
                            <button type="button" class="btn btn-default">Cheque Number</button>
                    </div>
                       <input type="text" class="form-control" id="cheque_number">
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
  
  
  <div id="view_modal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header" style="background-color:#33b781;color:#fff;">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4>Cheque Details</h4>
      </div>
         <div id="view_data"></div>
      
             <div class="modal-footer">
                    <input type="hidden" id="view_id">
                    <button type="button" class="btn btn-sm btn-default pull-right" data-dismiss="modal">Close</button>
            </div>
    </div>

  </div>
</div>
  
  
  <script>
  
             var cheque_status = $("#select_cheque_status").val();
              var cheque_number = $("#cheque_number").val();
      
       $(document).ready(function(){
             fetch_cheque_details();
             
           
       });
       
       
        function fetch_cheque_details(cheque_status,cheque_number)
    {
      var content = "";
      content += "<div class='table-responsive'>";
      content += "<table id='table_id' class='table table-hover table-bordered'>"; 
      content += "<thead><th>S.No</th><th>Cheque No</th><th>Paid To</th><th>Amount</th><th>Action</th></thead>";
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
            'url':'fetch_chequedetails',
            'method' : "POST",
            'data': {cheque_status:cheque_status,cheque_number:cheque_number},
          }
      });      
    }
    
    
    function get_data(cheque_status,cheque_number)
    {
        cheque_status = $("#select_cheque_status").val();
        cheque_number = $("#cheque_number").val();    
        fetch_cheque_details(cheque_status,cheque_number)
    }
    
    
    function view_data(id)
     {
        
        var cheque_status = $("#select_cheque_status").val();
        
        $.ajax({
                   url : "view_cheque_deatils",
                   method : "POST",
                   data : {cheque_status:cheque_status,id:id},
                   success:function(response)
                    {
                        $("#view_modal").modal("show");
                        $("#view_data").html(response);

                    }
        });
        
    }
    
      
      
      
  </script>
 