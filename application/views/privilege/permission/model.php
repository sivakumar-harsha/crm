	
    <div class="modal fade in" id="scrollmodal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                </div>
                <form name="permission_form" id="permission_form" action="<?=base_url('PermissionController/store')?>" method="POST" data-parsley-validate="">
                    <input type="hidden" id="id" name="id" value="<?=(isset($result['id']) && !empty($result['id'])) ? $result['id'] : "";?>"/>
                    <div class="modal-body">
                            <div class="form-group">
                                <label>Group Name</label> 
                                <span id="group_name_error"></span>
                                <select name="group_id" id="group_id" class="form-control" required>
                                    <option value="">Select</option>
                                    <?php if(isset( $grouplist ) && !empty( $grouplist ) ):?>
                                        <?php foreach( $grouplist as $group ):?>
                                            <?php $selected = (isset( $result['permission_group_id']) && !empty($result['permission_group_id']) && $result['permission_group_id'] == $group['id']) ? "selected" : ""?>
                                            <option value="<?=$group['id']?>" <?=$selected?>>
                                                <?=$group['name']?>
                                            </option>
                                        <?php endforeach;?>
                                    <?php endif;?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Name</label> 
                                <span id="name_error"></span>
                                <input 
                                    type="text" 
                                    class="form-control" 
                                    id="permission_name"
                                    name="permission_name"
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
        $('#permission_form').on('submit', function(e){
           e.preventDefault();
            if( $(this).parsley().isValid() ){
                var $form = $(e.target);
               
                $.ajax({
                    url: $form.attr('action'),
                    type: "POST",
                    data: $form.serialize(),
                    dataType: "json",
                    success: function(response){
                        if(response.status == true){
                            if(response.method == 'create') {
                                $("#permission_form").trigger("reset");
                                $('#permission_form').parsley().reset();
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