<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Permission</h3>
                    <?php if($this->auth->can_access("Create Permission")):?>
                        <button class="btn btn-primary" onclick="add_permission()">
                            + Add
                        </button>
                    <?php else:?>
                        <button class="btn btn-primary" onclick="swal('Permission Denied. Sorry, you do not have permission to access this page')">
                            + Add
                        </button>
                    <?php endif;?>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                    <label>Group Name</label> 
                                    <select name="privilege_name" id="privilege_name" class="form-control">
                                        <option value="">Select </option>
                                        <?php if( isset( $privilegelist ) && !empty( $privilegelist ) ):?>
                                            <?php foreach( $privilegelist as $group ):?>
                                                <option value="<?=$group['id']?>"><?=$group['name']?></option>
                                            <?php endforeach;?>
                                         <?php endif;?>
                                    </select>
                                </div>
                        </div>
                    </div>
                    
                    <div class="table-responsive">
                        <table class="table table-bordered" id="results">
                            <thead>
                                <tr>
                                    <th>Sl.No</th>
                                    <th>Privilege Group</th>
                                    <th>Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div id="model-result"></div>
    
</div>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script type="text/javascript">
    var table;
    $(document).ready(function() {
        display();
        
        $(document).on('click', '.confirm-del-btn', function(e){
            e.preventDefault();                
            var id = $(this).val();                
            swal({
				title: "Are you sure you want to delete this record(s)?",
				text: "Delete Confirmation!",                    
                icon: "warning",
                buttons: {
					cancel: true,
					confirm: {
						text: "Yes, Delete it!",
						value: true,
						visible: true,
						className: "",
						closeModal: false
					}           
				},
                dangerMode: true,
            })
            .then((willDelete) => {
            if (willDelete) 
            {
                $.ajax({
                    // url: "PermissionController/delete/"+id,
                    url:"<?=base_url('delete_permission/')?>"+id,
                    dataType: "json",
                    success: function (response) {
                        console.log(response);
                        swal({
                            title: response.status,
                            text: response.status_text,
                            icon: response.status_icon,
                            buttons: "Done",                               
                        })
                        .then((ok) => {
                            if(response.status == true){
                                table.ajax.reload();
                            }
                            
                            snackbar_show(response.msg);
                            
                        });
                    }
                });                    
            } else {
                //swal("Your user role data is safe!");
            }
            });
        });
    });
    
    function display()
    {
        table = $('#results').DataTable( {
           "processing": true,
           "serverSide": true,     
           "order": [],
           "ajax": {
            //   "url": "<?=base_url()?>/PermissionController/getLists",
               "url": "<?=base_url()?>list_permissions",
               "type": "POST",
               "data": function ( d ) {
                   // Pass filter criteria as POST parameters
                    d.search = $('input[type=search]').val();
                    d.privilege_name = $('#privilege_name').val();
                    d.action = "draw_table";
               }
           },
           "columnDefs": [{ 
                "targets": [0],
                "orderable": false
            }]
       } );
    
       $('#search').on( 'keyup', function () {
           table.ajax.reload();
       } );
       
       $('#privilege_name').change(function(){
          table.draw();
        });
    }
    
    function add_permission()
    {
        $('#model-result').empty();
        $.ajax({
        //   url:"<?=base_url('PermissionController/create')?>",
           url:"<?=base_url('create_permission')?>",
           success:function(response){
               $('#model-result').html(response);
           },
           error:function(code){
             alert(code.statusText);  
           },
        });
    }
    
    function edit_permission(id)
    {
        $('#model-result').empty();
        $.ajax({
        //   url:"<?=base_url('PermissionController/update/')?>"+id,
           url:"<?=base_url('update_permission/')?>"+id,
           success:function(response){
               $('#model-result').html(response);
           },
           error:function(code){
             alert(code.statusText);  
           },
        });
    }
    
    function delete_permission(id)
    {
        var status = confirm("Do You Want Delete this Permission");
        if(status){
            $.ajax({
                // url:"<?=base_url('PermissionController/delete/')?>"+id,
                url:"<?=base_url('delete_permission/')?>"+id,
                dataType: "json",
                success:function(response){
                    if(response.status == true){
                        table.ajax.reload();
                    }
                    
                    snackbar_show(response.msg);
                },
                error:function(code){
                    alert(code.statusText);  
                },
            });
        }
    }
</script>