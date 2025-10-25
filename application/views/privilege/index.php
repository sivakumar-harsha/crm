<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Privilege</h3>
                    <button class="btn btn-primary" onclick="add_privilege()">
                        + Add
                    </button>
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
<script type="text/javascript">
    var table;
    $(document).ready(function() {
        display();
    });
    
    function display()
    {
        table = $('#results').DataTable( {
           "processing": true,
           "serverSide": true,       
           "ajax": {
               "url": "<?=base_url()?>/PrivilegeController/ajaxDataTable",
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
    
    function add_privilege()
    {
        $('#model-result').empty();
        $.ajax({
           url:"<?=base_url('PrivilegeController/create')?>",
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
           url:"<?=base_url('PrivilegeController/update/')?>"+id,
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
                url:"<?=base_url('PrivilegeController/delete/')?>"+id,
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