

<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
<style>
      .form-control {
    display: block;
    width: 100%;
    height: 29px;
    padding: 4px 10px;
    font-size: 14px;
    line-height: 1.42857143;
    color: #555;
    background-color: #fff;
    background-image: none;
    border: 1px solid #ccc;
    border-radius: 4px;
    -webkit-box-shadow: inset 0 1px 1px rgb(0 0 0 / 8%);
    box-shadow: inset 0 1px 1px rgb(0 0 0 / 8%);
    -webkit-transition: border-color ease-in-out .15s,-webkit-box-shadow ease-in-out .15s;
    -o-transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
    transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
}
label {
    display: inline-block;
    max-width: 100%;
    margin-bottom: 5px;
    font-weight: unset;
    font-size: 14px;
}
.btn {
    border-radius: 1px;
    -webkit-box-shadow: none;
    box-shadow: none;
    border: 1px solid transparent;
}
.select2-container--default .select2-selection--multiple .select2-selection__choice {
    background-color: #337ab7 !important;
    border: 1px solid #fff;
    border-radius: 4px;
    cursor: default;
    color: #fff;
    float: left;
    margin-right: 5px;
    margin-top: 5px;
    padding: 0 5px;
}

.select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
    color: #fff !important;
    cursor: pointer;
    display: inline-block;
    font-weight: bold;
    margin-right: 2px;
}

.content-header {
    position: relative;
    padding: 15px 15px 19px 15px !important;
}

.content {
    min-height: 250px;
    padding: -1px !important;
    margin-right: auto;
    margin-left: auto;
    padding-left: 15px;
    padding-right: 15px;
}

.content-header {
    position: relative;
   padding: 15px 15px 1px 15px !important;
}
</style>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="row">
            <div class="col-md-3">
                  <h4>
                    Region
                  </h4>
             </div>
             <div class="col-md-3">
             </div>
             <div class="col-md-2">
             </div>
             <div class="col-md-3">
                 <button class="btn btn-primary btn-sm pull-right" data-toggle="modal" data-target="#add_model">Add Region</button>
             </div>
        </div>
    
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-body">
               <div class="col-md-12">
                   <div id="table_view"></div> 
               </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  
  
  <div class="modal fade in" id="add_model">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true" style="color:white;">×</span></button>
                <h4 class="modal-title text-center">Add Region</h4>
            </div>
            <div class="modal-body">
                
                 <div class="form-group">
                  <label>District</label> <span id="add_reigion_error" style="color: red;">*</span>
                  <select type="text" class="form-control select2" id="add_district" style="width:100%">
                      <option value = "">-Select--</option>
                      <?php foreach($district as $da){ ?>
                          <option value="<?php echo $da->id ?>"><?php echo $da->district ?></option>
                      <?php } ?>
                  </select>
                </div>
                
                <div class="form-group">
                  <label>Region</label> <span id="add_reigion_error" style="color: red;">*</span>
                  <input type="text" class="form-control" id="add_reigion">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-sm btn-primary" id="add_btn">Submit</button>
            </div>
        </div>
    </div>
  </div>
  
  <div class="modal fade in" id="edit_model">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true" style="color:white;">×</span></button>
                <h4 class="modal-title text-center">Edit Reigion</h4>
            </div>
            
            <input type="hidden" id="edit_id">
                        
            <div class="modal-body">
                
                <div class="form-group">
                  <label>District</label> <span id="add_reigion_error" style="color: red;">*</span>
                  <select type="text" class="form-control select2" id="edit_district" style="width:100%">
                      <option value = "">-Select--</option>
                      <?php foreach($district as $da){ ?>
                          <option value="<?php echo $da->id ?>"><?php echo $da->district ?></option>
                      <?php } ?>
                  </select>
                </div>
                
                <div class="form-group">
                  <label>Region</label> <span id="edit_reigion_error" style="color: red;">*</span>
                  <input type="text" class="form-control" id="edit_reigion">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-sm btn-primary" id="edit_btn">Submit</button>
            </div>
        </div>
    </div>
  </div>
  
  
  <script>
      $(document).ready(function(){
           $('.select2').select2();
          fetch_reigion();
         $("#add_btn").click(function(){
           var reigion = $("#add_reigion").val();
           var district = $("#add_district").val();
           
           var check =0;
           
           if(reigion == "")
           {
               check=1;
               snackbar_show("Enter Region");
           }
           else if(district == "")
           {
               check=1;
               snackbar_show("Select District");
           }
           if(check != 1)
           {
               $.ajax({
                   url : "add_reigion",
                   method : "POST",
                   data:{reigion:reigion,district:district},
                   beforeSend:function(){
                       $("#add_btn").attr("disabled",true);
                   },
                   success:function(response)
                   {
                       $("#add_reigion").val("");
                       $("#add_district").val("");
                       $("#add_btn").attr("disabled",false);
                       $("#add_model").modal("toggle");
                       fetch_reigion();
                   }
               });
           }
             
         });
         
         $("#edit_btn").click(function(){
            
            var reigion = $("#edit_reigion").val();
            var district = $("#edit_district").val();
            var id = $("#edit_id").val();
             
             var check = 0;
             
            if(reigion == "")
            {
                check = 1;
                snackbar_show("Enter Reigion");
            }
            else if(district == "")
           {
               check=1;
               snackbar_show("Select District");
           }
            if(check !=1)
            {
                $.ajax({
                     url : "edit_reigion",
                     method : "POST",
                     data : {reigion,reigion,id:id,district:district},
                     beforeSend:function(){
                         $("#edit_btn").attr("disabled",true);
                     },
                     success:function(response)
                     {
                         fetch_reigion();
                          $("#edit_btn").attr("disabled",false);
                         $("#edit_reigion").val("");
                         $("#edit_model").modal("toggle");
                     }
                });
            }
             
         });
         
      });
      
    
    function edit_data(id)
    {
        $.ajax({
               url : "fetch_edit_data",
               method : "POST",
               data : {id:id},
               success:function(response)
               {
                   var obj =jQuery.parseJSON(response);
                   $("#edit_reigion").val(obj.reigion);
                   $("#edit_district").val(obj.district_id);
                   $("#edit_district").trigger("change");
                   $("#edit_id").val(id);
                   $("#edit_model").modal("toggle");
               }
        });
    }
     
      
    function fetch_reigion()
    {
      var content = "";
      content += "<div class='table-responsive'>";
      content += "<table id='table_id' class='table table-hover table-bordered'>"; 
      content += "<thead><th>S.No</th><th>District</th><th>Reigion</th><th>Action</th></thead>";
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
            'url':'fetch_reigion',
          }
      });      
    }
  </script>