<!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1 style="font-size: 17px;">
        User Privillages
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
  
  <div class="modal fade in" id="add_model">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true" style="color:white;">×</span></button>
                <h4 class="modal-title text-center">User Privileges</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    
                    <div class="col-md-6">
                             <div class="form-group">
                                <label>Select Role</label>
                                <select class="form-control" name="role" id="role">
                                  <option value="Users">Users</option>
                                  <option value="POS">POS</option>
                                  <option value="Agent">Agent</option>
                                </select>
                            </div>
                    </div>
                    
                    <div class="col-md-6">
                             <div class="form-group">
                                <label>Select Users</label>
                                <select class="form-control" name="role" id="role">
                                  <option value="">--Select--</option>
                                
                                </select>
                            </div>
                    </div>
                    
                </div>
             
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-sm btn-primary" id="add_btn">Submit</button>
            </div>
        </div>
    </div>
  </div>
