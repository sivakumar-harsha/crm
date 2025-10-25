	
    <div class="modal fade in" id="scrollmodal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                </div>
                <form name="assign_role_form" id="assign_role_form" action="<?=base_url('RoleController/saveuserrole')?>" method="POST" data-parsley-validate="">
                    <input type="hidden" id="role_id" name="role_id" value="<?=(isset($roles['id']) && !empty($roles['id'])) ? $roles['id'] : "";?>"/>
                    <div class="modal-body">
                            <div class="form-group">
                                <label>Role Name</label> 
                                <span id="name_error"></span>
                                <input 
                                    type="text" 
                                    class="form-control" 
                                    disabled
                                    value="<?=(isset($roles['name']) && !empty($roles['name'])) ? $roles['name'] : "";?>"
                                />
                            </div>
                            <div class="form-group">
                                <label>User Name</label> 
                                <span id="user_name_error"></span>
                                <select name="user_id[]" id="user_id" class="form-control select2" required multiple style="width:100%">
                                    <option value="">Select</option>
                                    <?php if(isset( $userslist ) && !empty( $userslist ) ):?>
                                        <?php foreach( $userslist as $user ):?>
                                            <?php $selected = (isset($roleusers) && !empty($roleusers) && in_array($user->id, $roleusers) ) ? "selected" : ""?>
                                            <option value="<?=$user->id?>" <?=$selected?>>
                                                <?=$user->username?>
                                            </option>
                                        <?php endforeach;?>
                                    <?php endif;?>
                                </select>
                            </div>
                            
                    </div>
                    <div class="modal-footer">
                        <div class="col-md-12 pull-right" >
                            <button 
                                type="submit" 
                                class="btn btn-sm btn-primary"
                            >
                                Assign User
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
        $('.select2').select2();
        $('#scrollmodal').modal('show');
        $('#assign_role_form').on('submit', function(e){
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
                            window.location.reload();
                        }
                    }
                });
            }
        });
    });
  </script>