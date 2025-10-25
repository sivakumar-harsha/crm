<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Privilege</h3>
                    <?php if($this->auth->can_access('Create Privilege')):?>
                        <button class="btn btn-primary" onclick="add_privilege()">
                            + Add
                        </button>
                    <?php else:?>
                        <button class="btn btn-primary" onclick="swal('Permission Denied. Sorry, you do not have permission to access this page')">
                            + Add
                        </button>
                    <?php endif;?>
                </div>
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="results">
                            <thead>
                                <tr>
                                    <th>Sl.No</th>
                                    <th>Privilege Name</th>
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
        <?php if($this->auth->can_access('List Privilege')):?>
            display();
        <?php endif;?>
        
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
                        // url: "PrivilegeController/delete/"+id,
                        url:"<?=base_url('delete_privilege/')?>"+id,
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
               //"url": "<?=base_url()?>/PrivilegeController/getLists",
               "url": "<?=base_url()?>list_privileges",
               "type": "POST",
               "data": function ( d ) {
                   // Pass filter criteria as POST parameters
                   d.search = $('input[type=search]').val();
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
    }
    
    function add_privilege()
    {
        $('#model-result').empty();
        $.ajax({
        //   url:"<?=base_url('PrivilegeController/create')?>",
           url:"<?=base_url('create_privilege')?>",
           success:function(response){
               $('#model-result').html(response);
           },
           error:function(code){
             alert(code.statusText);  
           },
        });
    }
    
    function edit_privilege(id)
    {
        $('#model-result').empty();
        $.ajax({
        //   url:"<?=base_url('PrivilegeController/update/')?>"+id,
           url:"<?=base_url('update_privilege/')?>"+id,
           success:function(response){
               $('#model-result').html(response);
           },
           error:function(code){
             alert(code.statusText);  
           },
        });
    }
    
    function delete_privilege(id)
    {
        var status = confirm("Do You Want Delete this Privileges");
        if(status){
            $.ajax({
                // url:"<?=base_url('PrivilegeController/delete/')?>"+id,
                url:"<?=base_url('delete_privilege/')?>"+id,
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