<?php

$dashboard = "";

$example = "";
$menu1 = "";
$menu2 = "";
$brand = "";
$master = "";
$model = "";
$fuel_type = "";
$varient = "";

if($this->uri->segment(1) == "home")
{
    $dashboard = "active";
}
if($this->uri->segment(1) == "menu1")
{
    $example = "active";
    $menu1 = "active";
}
if($this->uri->segment(1) == "menu2")
{
    $example = "active";
    $menu2 = "active";
}
if($this->uri->segment(1) == "brand")
{
    $brand = "active";
    $master = "active";
}
if($this->uri->segment(1) == "fuel_type")
{
    $fuel_type = "active";
    $master = "active";
}
if($this->uri->segment(1) == "model")
{
    $model = "active";
    $master = "active";
}
if($this->uri->segment(1) == "varient")
{
    $varient = "active";
    $master = "active";
}
?>
      <!-- Left side column. contains the sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
          <div class="user-panel">
            <div class="pull-left image">
              <img src="./datas/images/userimg.jpg" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
              <p><?php echo $this->session->userdata('session_name'); ?></p>
              <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
          </div>
          
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
            
            <li class="<?php echo $dashboard; ?>"><a href="home"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
            
            

            <!-- 
            <li class="treeview <?php echo $example; ?>">
              <a href="#">
                <i class="fa fa-folder"></i> <span>Examples</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li class="<?php echo $menu1; ?>"><a href="#"><i class="fa fa-circle-o"></i> Menu 1</a></li>
                <li class="<?php echo $menu2; ?>"><a href="#"><i class="fa fa-circle-o"></i> Menu 2</a></li>
              </ul>
            </li> -->
            
              
            <li class="treeview <?php echo $master; ?>">
              <a href="#">
                <i class="fa fa-car"></i> <span> Car Master </span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li class="<?php echo $brand; ?>"><a href="brand"><i class="fa fa-circle-o"></i> Brand </a></li>
                <li class="<?php echo $model; ?>"><a href="model"><i class="fa fa-circle-o"></i> Model </a></li>
                <li class="<?php echo $fuel_type; ?>"><a href="fuel_type"><i class="fa fa-circle-o"></i> Fuel Types </a></li>
                <li class="<?php echo $varient; ?>"><a href="varient"><i class="fa fa-circle-o"></i> Varient </a></li>
              </ul>
            </li> 
            
            <li class=" treeview">
              <a href="#">
                <i class="fa fa-sliders"></i>
                <span>Settings</span>
                  <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="  treeview-menu">
                <li><a data-toggle="modal" data-target="#per_chg_pass"><i class="fa fa-circle-o"></i> Change Password</a></li>
              </ul>
            </li>
            
            <li><a href="<?php echo site_url('logout');?>"><i class="fa fa-sign-out"></i> <span>Logout<span></a></li>
            
            <!-- User Account: style can be found in dropdown.less -->
            <li class="dropdown user user-menu">
                        <ul class="dropdown-menu">
                           <!--User image -->
                          <li class="user-header">
                            <img src="./datas/images/userimg.jpg" class="img-circle" alt="User Image">
                            <p>
                              <?php echo $this->session->userdata('session_name'); ?>
                              <small><?php echo $this->session->userdata('session_role'); ?></small>
                            </p>
                          </li>                  
                          <!-- Menu Footer-->
                          <li class="user-footer">
                            <div class="pull-left">
                              <a href="#" class="btn btn-default btn-flat">Profile</a>
                            </div>
                            <div class="pull-right">
                              <a href="logout" class="btn btn-default btn-flat">Sign out</a>
                            </div>
                          </li>
                        </ul>
                      </li>
            
            
            
        
            
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>
      
      
       
 <!-- Permission for Changing Password Modal start -->
  
 <div class="modal fade in" id="per_chg_pass">
    <div class="modal-dialog">
        <div class="modal-content">
             <div class="modal-header bg-primary">
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true" style="color:white;">×</span></button>
                <h4 class="modal-title text-center">Changing New Password</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                  <label>Current Password : </label>
                  <input type="password" class="form-control" placeholder="Current Password ..." id="current_password" name="current_password">
                  <span id="per_chg_pass_error" style="color:red"></span>
                </div>
            </div>        
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <input type="submit" id="per_chg_pass_submit" value="Change" class="btn btn-primary"> <!-- call function permission_change_password_in_agent() -->
           </div>
        </div>
    <!-- /.modal-content -->
    </div>
  <!-- /.modal-dialog -->
</div>

<!-- Permission for Changing Password Modal end -->

  <!-- Changing New Password Modal start -->
  
 <div class="modal fade in" id="new_chg_pass">
    <div class="modal-dialog">
        <div class="modal-content">
             <div class="modal-header bg-primary">
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true" style="color:white;">×</span></button>
                <h4 class="modal-title text-center">Changing New Password</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                  <label>New Password : </label>
                  <input type="password" class="form-control" placeholder="New Password ..." id="new_password" name="new_password">
                  <span id="new_chg_pass_error1" style="color:red"></span>
                </div>
                <div class="form-group">
                  <label>Confirm Password : </label>
                  <input type="password" class="form-control" placeholder="Confirm Password ..." id="confirm_password" name="confirm_password">
                  <span id="new_chg_pass_error2" style="color:red"></span>
                </div>
            </div>        
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <input type="submit" id="new_chg_pass_submit" value="Change" class="btn btn-primary"> <!-- call function change_password() -->
           </div>
        </div>
    <!-- /.modal-content -->
    </div>
  <!-- /.modal-dialog -->
</div>

<!-- Changing New Password modal end -->

  <!-- Success Modal  -->
  
 <div class="modal fade in" id="success">
    <div class="modal-dialog">
        <div class="modal-content">
             <div class="modal-header bg-primary">
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true" style="color:white;">×</span></button>
                <h4 class="modal-title text-center">Password Status</h4>
            </div>
            <div class="modal-body">
                <h2 style="color:green;">Password has been changed successfully.</h2>
            </div>        
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Close</button>
           </div>
        </div>
    <!-- /.modal-content -->
    </div>
  <!-- /.modal-dialog -->
</div>

<!-- Changing New Password end -->

<script>
    $(document).ready(function(){
        $("#per_chg_pass_submit").click(function(){
            var current_password = $("#current_password").val();
            if(current_password == '')
            {
                $("#per_chg_pass_error").html("Enter a Current Password");
            }
            else
            {
                $.ajax({
                    url:'changepassword',
                    type:'POST',
                    data:{current_password:current_password},
                    success:function(response){
                        // alert(response);
                        if(response == 'success'){
                            $("#new_chg_pass").modal('show');
                            $("#per_chg_pass").modal('hide');
                        }
                        else if(response == 'failed'){
                            $("#per_chg_pass_error").html("Does Not Match Current Password");
                        }
                        else
                        {
                            location.reload();
                        }
                    },
                    error:function(e){
                        $("#per_chg_pass_error").html(e);
                    }
                    
                });
            }
            
        });
        $("#new_chg_pass_submit").click(function(){
            var new_password = $("#new_password").val();
            var confirm_password = $("#confirm_password").val();
            if(new_password == '')
            {
                $("#new_chg_pass_error1").html('Enter a New Password');
                $("#new_chg_pass_error2").html('');
            }
            else if(new_password.length < 8)
            {
               $("#new_chg_pass_error1").html('New Password length is Week'); 
                $("#new_chg_pass_error2").html('');
            }
            else if(confirm_password == '')
            {
                $("#new_chg_pass_error2").html('Enter a New Password');
                $("#new_chg_pass_error1").html('');
            }
            else if(new_password != confirm_password)
            {
                $("#new_chg_pass_error2").html('Mismatch Password');
            }
            else
            {
                $("#new_chg_pass_error1").html('');
                $("#new_chg_pass_error2").html('');
                $.ajax({
                    url:'update_new_password',
                    type:'POST',
                    data:{password:new_password},
                    success:function(response){
                        location.reload();
                    },
                    error:function(e){
                        $("#new_chg_pass_error2").html(e);
                    }
                    
                });
            }
        });
    });
</script>