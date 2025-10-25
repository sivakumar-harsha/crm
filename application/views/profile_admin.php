<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
     <section class="content-header">
       <div class="row">
           <div class="col-md-6">
               <h4> Login Details </h4>
           </div>
            <div class="col-md-6 pull-right">
                
               <button class="btn btn-danger btn-sm pull-right"><i class="fa fa-times" aria-hidden="true"></i> Cancel</button>
                <span class="pull-right">&nbsp;</span>
                <button class="btn btn-success btn-sm pull-right" id="save_btn"><i class="fa fa-save"></i> Save</button>
                <span class="pull-right">&nbsp;</span>
                
                
                <span class="pull-right">&nbsp;</span>
            </div>
       </div>
    </section>
    
   <!--admin log in deatils  form-->
   
    <!-- Main content -->
    <section class="content">
        
    <div class="box" id="remove_class">
        <div class="box-header with-border" style="background:#f4f4f48c;">
            <h3 class="box-title" _msthash="26273" _msttexthash="60619" style="text-align: left;font-size:14px;"><i class="fa fa-user" aria-hidden="true"></i> &nbsp;&nbsp;Admin Login Details</h3>
            
            <div class="box-tools pull-right">
                 <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse">
                  <i class="fa fa-minus"></i></button>
            </div>
        </div>
        
        <div class="box-body" _msthash="1196936" _msttexthash="1190501" style="text-align: left;">
            <div class="row">
                <div class="col-md-6">
                    
                    <div class="form-group">
                        <div class="row">   
                           <div class="col-md-4">
                                <label>Name</label><span>*</span>
                           </div>
                           <div class="col-md-8">
                                <input type="text" class="form-control" disabled name="name" id="name" value="<?php echo $admin_info->name ?>">
                           </div>
                         </div>
                    </div>
                    
                    <div class="form-group">
                        <div class="row">   
                           <div class="col-md-4">
                                <label>Email</label><span>*</span>
                           </div>
                           <div class="col-md-8">
                                <input type="text" class="form-control" name="email" id="email" value="<?php echo $admin_info->email_id ?>">
                           </div>
                         </div>
                    </div>
                    
                <div class="form-group">
                            <div class="row">   
                               <div class="col-md-4">
                                    <label>Password</label>
                               </div>
                               <div class="col-md-8">
                                    <input type="text" class="form-control" disabled name="password"  id="password" value="<?php echo $admin_info->password ?>">
                               </div>
                             </div>
                   </div>
                    
                
                     
                </div>
                
                
                <div class="col-md-6">
                    
                    <div class="form-group">
                        <div class="form-group">
                            <div class="row">   
                               <div class="col-md-4">
                                     <label>Phone Number</label>
                               </div>
                               <div class="col-md-8">
                                   <input type="text" class="form-control" disabled name="phone" id="phone" value="<?php echo $admin_info->phoneno ?>">
                               </div>
                             </div>
                     </div>
                     
                      <div class="form-group">
                         <div class="row">   
                               <div class="col-md-4">
                                     <label>Address</label>
                               </div>
                               <div class="col-md-8">
                                   <textarea class="form-control" name="address" id="address" rows="2" ><?php echo $admin_info->address ?></textarea>
                               </div>
                               
                        </div>
                    </div>
                    
                </div>
                    
                    <input type="hidden" id="profile_id" name="id" value="<?php echo $admin_info->id ?>" >
                    

                </div>
                
            </div>
        </div>
    </div>
  

    </section><!-- /.content -->
    
    
    <!--company settings form start-->
    <?php if(isset($company_info)){ ?>   
       <section class="content">
        
    <div class="box" id="add_class">
        <div class="box-header with-border" style="background:#f4f4f48c;">
            <h3 class="box-title" _msthash="26273" _msttexthash="60619" style="text-align: left;font-size:14px;"><i class="fa fa-user" aria-hidden="true"></i> &nbsp;&nbsp;Company Settings</h3>
            
            <div class="box-tools pull-right">
                 <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse">
                  <i class="fa fa-minus"></i></button>
            </div> 
        </div>
        
        <div class="box-body" _msthash="1196936" _msttexthash="1190501" style="text-align: left;">
            <div class="row">
                <div class="col-md-6">
                    
                    <div class="form-group">
                        <div class="row">   
                           <div class="col-md-4">
                                <label>Name</label><span>*</span>
                           </div>
                           <div class="col-md-8">
                                <input type="text" class="form-control"  name="c_name" id="c_name" value="<?php echo $company_info->name ?>">
                           </div>
                         </div>
                    </div>
                    
                    <div class="form-group">
                        <div class="row">   
                           <div class="col-md-4">
                                <label>City</label><span>*</span>
                           </div>
                           <div class="col-md-8">
                                <input type="text" class="form-control" name="c_city" id="c_city" value="<?php echo $company_info->city ?>">
                           </div>
                         </div>
                    </div>
                    
                <div class="form-group">
                            <div class="row">   
                               <div class="col-md-4">
                                    <label>Address</label>
                               </div>
                               <div class="col-md-8">
                                    <input type="text" class="form-control" name="c_address"  id="c_address" value="<?php echo $company_info->address ?>">
                               </div>
                             </div>
                   </div>
                   
                   
                   <div class="form-group">
                            <div class="row">   
                               <div class="col-md-4">
                                    <label>Phone Number</label>
                               </div>
                               <div class="col-md-8">
                                    <input type="text" class="form-control" name="c_phone"  id="c_phone" value="<?php echo $company_info->phone ?>">
                               </div>
                             </div>
                   </div>
                   

                </div>
                
                
                <div class="col-md-6">
                    
                     
                    
                    <div class="form-group">
                         <div class="form-group">
                            <div class="row">   
                               <div class="col-md-4">
                                    <label>Additional Phone No</label>
                               </div>
                               <div class="col-md-8">
                                    <input type="text" class="form-control" name="add_phone"  id="add_phone" value="<?php echo $company_info->additional_mobile ?>">
                               </div>
                             </div>
                   </div>
                   
                    <div class="form-group">
                            <div class="row">   
                               <div class="col-md-4">
                                    <label>Email</label>
                               </div>
                               <div class="col-md-8">
                                    <input type="text" class="form-control" name="c_email"  id="c_email" value="<?php echo $company_info->email ?>">
                               </div>
                             </div>
                   </div>
                   
                   
                   <div class="form-group">
                            <div class="row">   
                               <div class="col-md-4">
                                    <label>Gst No</label>
                               </div>
                               <div class="col-md-8">
                                    <input type="text" class="form-control" name="gst"  id="gst_no" value="<?php echo $company_info->gst_no ?>">
                               </div>
                             </div>
                   </div>
                   
                   
                   <!-- <div class="form-group">
                            <div class="row">   
                               <div class="col-md-4">
                                    <label>UPI Link</label>
                               </div>
                               <div class="col-md-8">
                                    <input type="text" class="form-control" name="upi"  id="upi" value="<?php echo $company_info->upi_link ?>">
                               </div>
                             </div>
                   </div>-->

                    <input type="hidden" id="company_id" name="id" value="<?php echo $company_info->id ?>" >
                    

                </div>
                
            </div>
        </div>
    </div>
  
    </section><!-- /.content -->
    <?php } ?>
    
    
    
    
    
  </div><!-- /.content-wrapper 
  
  
  
       <!--profile Admin update start-->
<script>
    $(document).ready(function(){
      
      $("#save_btn").click(function(){
         
          var id = $("#profile_id").val();
          var name = $("#name").val();
          var email  = $("#email").val();
          var password = $("#password").val();
          var phone = $("#phone").val();
          var address = $("#address").val();
          
          var c_name = $("#c_name").val();
          
          var c_city = $("#c_city").val();
          
          var c_address = $("#c_address").val();
          
          var c_phone = $("#c_phone").val();
          
          var add_phone = $("#add_phone").val();
          
          var c_email = $("#c_email").val();
          
          var gst = $("#gst_no").val();
          
          var upi = $("#upi").val();
          
          
          $.ajax({
              
              url:"add_profile_admin",
              data:{
                      id:id,
                      name:name,
                      email_id:email,
                      password:password,
                      phoneno:phone,
                      address:address,
                      c_name:c_name,
                      city:c_city,
                      c_address:c_address,
                      phone:c_phone,
                      additional_mobile:add_phone,
                      email:c_email,
                      gst_no:gst,
                      upi_link:upi
                      
                     },
                        method:"post",
                     
                     success:function(response)
                     {
                          Swal.fire({
                          position: 'top-end',
                          icon: 'success',
                          title: 'Your work has been saved',
                          showConfirmButton: false,
                          timer: 1500
                          
                        })
                            alert("response");
                           
                            location.reload();
                     }
             
               });
          
          });
      
    });
</script>
      
      
      
    
      
 
  
  
  
  
