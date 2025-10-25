<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Role List</h3>
                    <a href="<?=base_url('create_role')?>" class="btn btn-primary"> + ADD 
                    </a>
                </div>
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="results">
                            <thead>
                                <tr>
                                    <th>Sl.No</th>
                                    <th>Role</th>
                                    <th>Permission</th>
                                    <th>User</th>
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
    
    
    
</div>

<div id="model-result"></div>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
<style>
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
</style>  
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
                    // url:"<?=base_url('RoleController/delete/')?>"+id,
                    url:"<?=base_url('delete_role/')?>"+id,
                    dataType: "json",
                    success: function (response) {
                        swal({
                            title: response.status,
                            text: response.msg,
                            icon: response.status_icon,
                            buttons: "Done",                               
                        })
                        .then((ok) => {
                            if(response.status == true){
                                table.ajax.reload();
                            }
                            
                            // snackbar_show(response.msg);
                            
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
           "ajax": {
            //   "url": "<?=base_url()?>/RoleController/getLists",
               "url": "<?=base_url('list_roles')?>",
               "type": "POST",
               "data": function ( d ) {
                   // Pass filter criteria as POST parameters
                   d.search = $('input[type=search]').val();
                   d.action = "draw_table";
               }
           }
       } );
    
       $('#search').on( 'keyup', function () {
           table.ajax.reload();
       } );
    }
    
    function assign_role(role_id)
    {
        $('#model-result').empty();
        $.ajax({
           url:"<?=base_url('assign_role/')?>"+role_id,
           success:function(response){
               $('#model-result').html(response);
           },
           error:function(code){
             alert(code.statusText);  
           },
        });
    }
</script>