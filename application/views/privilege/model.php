	
    <div class="modal fade in" id="scrollmodal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                </div>
                <form name="privilege_form" id="privilege_form" action="<?=base_url('PrivilegeController/store')?>" method="POST" data-parsley-validate="">
                    <input type="hidden" id="id" name="id" value="<?=(isset($result['id']) && !empty($result['id'])) ? $result['id'] : "";?>"/>
                    <div class="modal-body">
                            <div class="form-group">
                                <label>Name</label> 
                                <span id="edit_name_error"></span>
                                <input 
                                    type="text" 
                                    class="form-control" 
                                    id="privilege_name"
                                    name="privilege_name"
                                    required
                                    value="<?=(isset($result['name']) && !empty($result['name'])) ? $result['name'] : "";?>"
                                />
                            </div>
                    </div>
                    <div class="modal-footer">
                        <div class="col-md-12 pull-right" >
                            
                       
                            <button 
                                type="submit" 
                                class="btn btn-sm btn-primary"
                            >
                                <?=(isset($result['id']) && !empty($result['id'])) ? "Update": "Create";?>
                            </button>
                            
                            <button type="button" class="btn btn-sm btn-danger " data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/guillaumepotier/Parsley.js@2.9.2/src/parsley.css">
  <script type="text/javascript" src="https://cdn.jsdelivr.net/gh/guillaumepotier/Parsley.js@2.9.2/dist/parsley.js"></script>

  <script>
    $(document).ready(function(){
        $('#scrollmodal').modal('show');
        $('#privilege_form').on('submit', function(e){
           e.preventDefault();
            if( $(this).parsley().isValid() ){
                // var formData = new FormData(this);
                var $form = $(e.target);
                // console.log($form.serialize());
               
                $.ajax({
                    url: $form.attr('action'),
                    type: "POST",
                    data: $form.serialize(),
                    dataType: "json",
                    success: function(response){
                        if(response.status == true){
                            if(response.method == 'create') {
                                $("#privilege_form").trigger("reset");
                                table.ajax.reload();
                            } else if(response.method == 'update'){
                                window.location.reload();
                            }
                            snackbar_show(response.msg);
                        }
                    }
                });
            }
        });
    });
  </script>