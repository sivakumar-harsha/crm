 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1 style="font-size: 17px;">
        Upload Bulk Leads
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-body">
         
      <div class="row">
          
          <div class="col-md-4">
              
            <form action="<?php echo site_url('excell_data_file_get'); ?>" method="POST" enctype="multipart/form-data" >
                <div class="form-group">
                     <label>Upload Excel</label>
                     <input type="file" class="form-control" name="upload_file" id="upload_file">
                 </div>
                 
                 <button type="submit" class="btn btn-primary" id="sub_btn">Upload</button>
                 </form>
          </div>
          
          <div class="col-md-4">
          </div>
          
      </div>
      
      <div id="table_view"></div>
         
         
        </div><!-- /.box-body -->        
      </div><!-- /.box -->

    </section><!-- /.content -->
  </div><!-- /.content-wrapper -->
  
  
  <script>
  
     
  </script>