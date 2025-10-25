<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1 style="font-size: 17px;">
        Upload Temp Data
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-body">
        
        <form action = "upload_data" method="POST" enctype="multipart/form-data">
           <div class="form-group">
              <label>File</label>
              <input type = "file" name="excel_file" id="excel_file" class="form-control">
          </div>
           <div class="form-group">
              <button type = "submit" class ="btn btn-sm btn-primary">Submit</button>
          </div>
         </form>
        </div>       
      </div>

    </section>
  </div>
