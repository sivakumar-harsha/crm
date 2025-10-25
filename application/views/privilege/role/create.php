<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Create Role</h3>
                    <a href="<?=base_url('roles')?>" class="btn btn-primary pull-right"> Back
                    </a>
                </div>
                <div class="box-body">
                    <form name="role_permission_form" id="role_permission_form" action="<?=base_url('store_role')?>" method="POST" data-parsley-validate="">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Name</label> 
                                    <span id="name_error"></span>
                                    <input 
                                        type="text" 
                                        class="form-control" 
                                        id="role_name"
                                        name="role_name"
                                        required
                                        value=""
                                    />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <?php if( isset( $groups ) && !empty( $groups ) ):?>
                                <?php foreach( $groups as $group ):?>
                                    <div class="col-md-4">
                                        <h4>
                                            <?=$group['name']?> &nbsp; &nbsp;
                                            <input type="checkbox" id="chk_<?=$group['name']?>" name="chk_<?=$group['name']?>" class="chk_<?=$group['name']?>" onclick="selectAll(this.checked, '<?=$group['name']?>')"></h4>
                                        <?php if( isset( $permissions[$group['name']] ) && !empty( $permissions[$group['name']] ) ):?>
                                            
                                            <?php foreach( $permissions[$group['name']] as $permission ):?>
                                                <div class="form-group form-check">
                                                    <input type="checkbox" class="form-check-input checkbox-<?=$group['name']?>" name="permission[]" id="permission_<?=$permission['id']?>" value="<?=$permission['id']?>" onclick="childselect('<?=$group['name']?>')">
                                                    <label class="form-check-label" for="permission_<?=$permission['id']?>"> <?=$permission['name']?></label>
                                                </div>
                                            <?php endforeach;?>
                                        <?php endif;?>
                                    </div>
                                <?php endforeach;?>
                            <?php endif;?>
                            
                        </div>
                        <div class="row pull-right">
                            <div class="col-md-12 " >
                                <button 
                                    type="submit" 
                                    class="btn btn-sm btn-primary"
                                >
                                    <?=(isset($result['id']) && !empty($result['id'])) ? "Update": "Create";?>
                                </button>
                        </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    
    
</div>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/guillaumepotier/Parsley.js@2.9.2/src/parsley.css">
  <script type="text/javascript" src="https://cdn.jsdelivr.net/gh/guillaumepotier/Parsley.js@2.9.2/dist/parsley.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <script>
    function selectAll(val, ele) {
        if(val){
            $('.checkbox-'+ele).each(function(){
                this.checked = true;
            });
        }else{
             $('.checkbox-'+ele).each(function(){
                this.checked = false;
            });
        }
    }
    
    function childselect(ele)
    {
        if($('.checkbox-'+ele+':checked').length == $('.checkbox-'+ele).length){
            $('#chk_'+ele).prop('checked',true);
        }else{
            $('#chk_'+ele).prop('checked',false);
        }
    }
    
    $(document).ready(function(){
        
        $('#role_permission_form').on('submit', function(e){
           e.preventDefault();
            if( $(this).parsley().isValid() ){
                var $form = $(e.target);
               
                $.ajax({
                    url: $form.attr('action'),
                    type: "POST",
                    data: $form.serialize(),
                    dataType: "json",
                    success: function(response){
                        console.log(response);
                        console.log(typeof(response));
                        if(response.status == true){
        				    setTimeout(function() {
        						swal({
        							title: "Success",
        							text: response.msg,
        							icon: "success",
        							Button: "Done"
        						})
        						.then((ok) => {
        							if(response.redirect_url)
        								window.location = response.redirect_url
        						});
        					}, 500);
            			} else if(response.status == "false") {
            			    swal("Unable to updated objects");
            			}
                    }
                });
            }
        });
    });
  </script>