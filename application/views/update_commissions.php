  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1 style="font-size: 17px;">
        Update Active Policy Commissions
        <button data-toggle="modal" data-target="#add_model" class="btn btn-primary btn-sm pull-right">Add New</button>
        
          <div class = "row">
            <div class="col-md-2"></div>
            
                <div class = "col-md-3">
                    <div class= "form-group">
                        <input type="date" name="s_f_date" id="s_f_date" class="form-control">
                    </div>
                </div>
                
                <div class = "col-md-3">
                    <div class= "form-group">
                        <input type="date" name="s_to_date" id="s_to_date" class="form-control">
                    </div>
                </div>
                
                <div class = "col-md-2">
                    <div class= "form-group">
                        <button type="button" class="btn btn-info btn-sm" id="search_btn"><i class="fa fa-save"></i>&nbsp; Submit</button>
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
        
        $("#search_btn").click(function(){
           
           var f_date = $("#s_f_date").val();
           var to_date = $("#s_to_date").val();
           
           $.ajax({
                          url : "update_commissions",
                          method : "POST",
                          data : {f_date:f_date,to_date:to_date},
                          beforeSend:function(){
                            $("#search_btn").attr("disabled",true);  
                          },
                          success:function(response)
                          {
                              $("#search_btn").attr("disabled",false);  
                              $("#table_view").html(response);
                          }
           });
            
        });
         
     });
 </script>