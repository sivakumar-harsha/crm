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
<div class="content-wrapper">
    <section class="content-header">
      <h1 style="font-size: 17px;">
        Institution
        <button data-toggle="modal" data-target="#add_model" class="btn btn-primary btn-sm pull-right" style="margin-top: -12px !important;">Add New</button>
        <span class="pull-right">&nbsp;</span>
        <button onclick="export_excel()" class="btn btn-danger btn-sm pull-right" style="margin-top: -12px !important;"><i class="fa fa-file-excel-o"></i>&nbsp;Export</button>
        <span class="pull-right">&nbsp;</span>
        <button data-toggle="modal" data-target="#excel_model" class="btn btn-success btn-sm pull-right" style="margin-top: -12px !important;"> <i class="fa fa-file-excel-o"></i>&nbsp;Import</button>
      </h1>
              <div class = "row">
                    <div class ="col-md-2">
                        <div class="form-group">
                             <select id="select_region" name ="select_region" class="form-control select2" required style="width:100%">
                                 <option value="">--select Region--</option>
                                 <?php foreach($region as $da){?>
                                    <option value="<?php echo $da->reigion ?>"><?php echo $da->reigion ?></option>
                                            <?php } ?>
                             </select>
                         </div>
                    </div> 

        <div class="form-group col-md-2">
            <select id="select_brand" name="select_brand" class="form-control select2" style="width:100%"> 
                <option value="">----Select Institution----</option>
                <option value="engineering college">Engineering College</option>
                <option value="art and science college">Art And Science College</option>
                <option value="medical college">Medical College</option>
                <option value="school">School </option>
                <option value="hospital">Hospital </option>
                <option value="industry">Industry </option>
    </select>
</div>
                      
                    <!--<div class="form-group col-md-2">-->
                    <!--         <input type = "text" class="form-control" name="select_policy_type" id="select_policy_type" placeholder="Policy Type">-->
                    <!--</div>-->
                    
                    <div class="form-group col-md-2">
                             <input type = "text" class="form-control" name="s_mobile_no" id="s_mobile_no" placeholder="Mobile No">
                      </div>
                      
                    <div class="form-group col-md-2">
                         <input type ="text" class="form-control" name="s_school_name" id="s_school_name" placeholder="Institution Name">
                  </div>
                  
                   <div class="form-group col-md-1">
                      <button class="btn btn-success btn-sm pull-right" id="search_btn" > <i class="fa fa-search"></i></button>
                   </div>
                   
             </div> 

    </section>

    <section class="content">
      <div class="box">
        <div class="box-body">
          <div id="table_view"></div>
        </div>   
      </div>
    </section>
  </div>
  
  <div class="modal fade in" id="add_model">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" style="color:white;">×</span></button>
                    <h4 class="modal-title text-center">Add Institution</h4>
                </div>
       
                <div class="modal-body">
        
                 <div class = "row">
                     <div class="form-group col-md-6">
                          <label>Region</label>
                              <select id="add_region" name ="add_region" class="form-control select2" style="width:100%">
                                 <option value="" >--select--</option>
                                 <?php foreach($region as $da){?>
                                    <option value="<?php echo $da->reigion ?>"><?php echo $da->reigion ?></option>
                                            <?php } ?>
                             </select>
                         </div>
                         
                         
                         
                    <div class="form-group col-md-6">
                        <label>Institution Type</label> 
                        <select id="add_brand" name="add_brand" class="form-control select2" style="width:100%"> 
                        <option value="">----Select----</option>
                        <option value="art and science college">Art And Science College</option>
                        <option value="engineering college">Engineering College</option>
                        <option value="medical college">Medical College</option>
                        <option value="school">School </option>
                        <option value="hospital">Hospital </option>
                        <option value="industry">Industry </option>
                      </select>
                    </div>

                     <!--<div class="form-group col-md-4">-->
                     <!--     <label>Policy Class</label>-->
                     <!--     <select id="add_policy_class" name ="add_policy_class" class="form-control select2" required style="width:100%">-->
                     <!--        <option value="">--select--</option>-->
                     <!--        <?php foreach($class as $da){?>-->
                     <!--           <option value="<?php echo $da->class ?>"><?php echo $da->class ?></option>-->
                     <!--                   <?php } ?>-->
                     <!--    </select>-->
                     <!--</div>-->
                     
                     <!-- <div class="form-group col-md-4">-->
                     <!--     <label>Policy Type</label>-->
                     <!--     <input type="text" id="add_p_type" name ="add_p_type" class="form-control select2" placeholder= "Eg(Bike ,Car,Misc-D)">-->
                     <!--</div>-->
                 </div>
                
                
                
                <div class = "row">

                    <div class="form-group col-md-6">
                        <label>Institution Name</label> 
                        <input type="text" class="form-control" id="school_name" name="activice"> 
                    </div>
                    
                    <div class="form-group col-md-6">
                        <label>Mobile No</label> 
                        <input type="text" class="form-control" id="school_mobile_no" name="school_mobile_no"> 
                    </div>
                </div>
                  
                <div class = "row">
                    <div class="form-group col-md-6">
                         <label>Email Id</label> 
                         <input type="email" class="form-control" id="add_email" name="add_email" >
                    </div>
                    
                    <div class="form-group col-md-6">
                          <label>Address</label> 
                          <textarea type="text" class="form-control" id="add_address" name="address" rows="3" required></textarea>
                      </div>
               </div>
               
               
            <div class = "row">
                 <div class = "col-md-6">
                     <div class = "form-group">
                         <label>Upload Flie</label> 
                           <button type="button" id="remove_upload_btn" class= "btn btn-danger btn-xs pull-right"><i class="fa fa-minus fa-1x"></i></button>&nbsp;
                           <button type="button" id="add_upload_btn" class= "btn btn-primary btn-xs pull-right"><i class="fa fa-plus fa-1x"></i></button>&nbsp;
                           <input type="file" name="gallery_image[]" class="form-control gallery_image" multiple="">
                     </div>
                 </div>       
                 
                 <div class = "col-md-6">
                      <div class = "form-group">
                         <label>File Type</label>
                           <input type="text" name="file_type[]" class="form-control file_type">
                     </div>
                 </div>
            </div>
            
              <div id="multi_images"></div>
                
                <div class="form-group">
                     <button type="button" id="removebtn" class= "btn btn-danger btn-xs pull-right">Remove</button>
                     <button type="button" id="add_contacts" class= "btn btn-primary btn-xs pull-right">Add Contact</button>
                </div>
             
                <div id="textbox"></div>
                
                <div class="form-group">
                      <label>Remark</label> 
                        <textarea rows="3" class="form-control" required  name="remark" id="add_remark"></textarea>
                    </div>
            </div>
            
                 <div class="modal-footer">
                   <button type="button" class="btn btn-sm btn-default pull-left" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-sm btn-primary" id="add_btn">Submit</button>
                </div>
            </div>
        </div>
      </div>
      
  <div class="modal fade in" id="view_model">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" style="color:white;">×</span></button>
                    <h4 class="modal-title text-center">Institution Contact Info</h4>
                </div>
                <div class="modal-body">
                     <div id="view_data"></div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="view_id">
                    <button type="button" class="btn btn-sm btn-default pull-left" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
      </div> 
      
   <div class="modal fade in" id="edit_model">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" style="color:white;">×</span></button>
                    <h4 class="modal-title text-center">Edit Institution</h4>
                </div>
       
                <div class="modal-body">
				
				<input type = "hidden" id="edit_id">
        
                 <div class = "row">
                     <div class="form-group col-md-6">
                          <label>Region</label>
                              <select id="edit_region" name ="edit_region" class="form-control select2" required style="width:100%">
                                 <option value="">--select--</option>
                                 <?php foreach($region as $da){?>
                                    <option value="<?php echo $da->reigion ?>"><?php echo $da->reigion ?></option>
                                            <?php } ?>
                             </select>
                         </div>
                         
                     <!--<div class="form-group col-md-4">-->
                     <!--     <label>Policy Class</label>-->
                     <!--     <select id="edit_policy_class" name ="edit_policy_class" class="form-control select2" required style="width:100%">-->
                     <!--        <option value="">--select--</option>-->
                     <!--        <?php foreach($class as $da){?>-->
                     <!--           <option value="<?php echo $da->class ?>"><?php echo $da->class ?></option>-->
                     <!--                   <?php } ?>-->
                     <!--    </select>-->
                     <!--</div>-->
                     
                     <!-- <div class="form-group col-md-4">-->
                     <!--     <label>Policy Type</label>-->
                     <!--     <input type="text" id="edit_p_type" name ="edit_p_type" class="form-control select2" placeholder= "Eg(Bike ,Car,Misc-D)">-->
                     <!--</div>-->
                     
                        <div class="form-group col-md-6">
                        <label>Institution Type</label> 
                        <select id="edit_brand" name="edit_brand" class="form-control select2" style="width:100%"> 
                        <option value="">----Select----</option>
                    <option value="engineering college">Engineering College</option>
                    <option value="art and science college">Art And Science College</option>
                    <option value="medical college">Medical College</option>
                    <option value="school">School </option>
                    <option value="hospital">Hospital </option>
                    <option value="industry">Industry </option>
                      </select>
                        
                    </div>
                     
                 </div>
                
                
                
                <div class = "row">
                 
                    
                    <div class="form-group col-md-6">
                        <label>Institution Name</label> 
                        <input type="text" class="form-control" id="edit_school_name" name="edit_school_name"> 
                    </div>
                    
                    <div class="form-group col-md-6">
                        <label>Mobile No</label> 
                        <input type="text" class="form-control" id="edit_school_mobile_no" name="edit_school_mobile_no"> 
                    </div>
                </div>
                  
                <div class = "row">
                    <div class="form-group col-md-6">
                         <label>Email Id</label> 
                         <input type="email" class="form-control" id="edit_email" name="edit_email" >
                    </div>
                    
                    <div class="form-group col-md-6">
                          <label>Address</label> 
                          <textarea type="text" class="form-control" id="edit_address" name="edit_address" rows="3" required></textarea>
                      </div>
               </div>
               
                <div class = "row">
                    <div id="attachments"></div>
                    
                    <div class = "col-md-6">
                        <div class = "form-group">
                            <label>Upload Flie</label> 
                            <button type="button" id="remove_edit_upload_btn" class= "btn btn-danger btn-xs pull-right"><i class="fa fa-minus fa-1x"></i></button>&nbsp;
                            <button type="button" id="edit_upload_btn" class= "btn btn-primary btn-xs pull-right"><i class="fa fa-plus fa-1x"></i></button>&nbsp;
                        </div>
                    </div>       
                </div>
            
                <div id="edit_multi_images"></div>
               
                
                <div class="form-group">
                     <button type="button" id="edit_removebtn" class= "btn btn-danger btn-xs pull-right">Remove</button>
                     <button type="button" id="edit_contacts" class= "btn btn-primary btn-xs pull-right">Add More</button>
                </div>
             
                <div id="edit_textbox"></div>
                
                
                
                <div class="form-group">
                      <label>Remark</label> 
                        <textarea rows="3" class="form-control" required  name="edit_remark" id="edit_remark"></textarea>
                    </div>
            </div>
            
                 <div class="modal-footer">
                   <button type="button" class="btn btn-sm btn-default pull-left" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-sm btn-primary" id="edit_btn">Submit</button>
                </div>
            </div>
        </div>
      </div>
      
<!-- Import Excel model start -->
    <div class="modal fade in" id="excel_model">
        <div class="modal-dialog modal-lg">
          
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" style="color:white;">×</span></button>
                    <h4 class="modal-title text-center">Import Excel</h4>
                </div>
        <form method="post" id="import_form" enctype="multipart/form-data">
        <div class="modal-body bg-success">
          <div class = "conteiner">
            <div class = "row">
                 <div class = "col-md-6">
                     <div class = "form-group">
                         <label>Upload Flie</label> 
                           <!-- <button type="button" id="remove_upload_btn" class= "btn btn-danger btn-xs pull-right"><i class="fa fa-minus fa-1x"></i></button>&nbsp;
                           <button type="button" id="add_upload_btn" class= "btn btn-primary btn-xs pull-right"><i class="fa fa-plus fa-1x"></i></button>&nbsp;
                           <input type="file" name="gallery_image[]" class="form-control gallery_image" multiple=""> -->
                           <!--<input type="file" name="import_excel" id="import_excel"   required>-->
                           <input type="file" name="file" id="file" class="form-control" accept=".xls, .xlsx" />
                     </div>
                 </div>   
                 
                 <div id="result"></div>
            </div>
          </div>
        </div>
            
                 <div class="modal-footer">
                   <button type="button" class="btn btn-sm btn-default pull-left" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-sm btn-success" name="import" id="import" value="Import" >Import</button>
                </div>
                </form>
              </div>
            </div>
      </div>
 <!-- Import Excel model end -->   
 
<script> 

    var region = $("#select_region").val();
    var brand =$("#select_brand").val();
    var policy_type =$("#select_policy_type").val();
    var mobile_no = $("#s_mobile_no").val();
    var school_name = $("#s_school_name").val();
        
        
   $(document).ready(function(){
        $('.select2').select2();
       fetch_schools();
       
       
          $('#add_upload_btn').click(function(){
                var content = "<div class ='row'>";
                content += '<div class="form-group col-md-6">';
                content += ' <label>Upload File</label>';
                content += '<input type="file" name ="gallery_image[]" class="form-control gallery_image" required>'; 
                content += ' </div>';
          
                content  +='<div class="form-group col-md-6">';
                content  +='<label>File type </label>';
                content  +='<input name="file_type[]" type="text" class="form-control file_type" required >';
                content += ' </div>';
                 content += ' </div>';
                 $("#multi_images").append(content);
            });
            
            $('#remove_upload_btn').click(function(){
              $('#multi_images').children().last().remove();
        });
       

       $("#add_contacts").click(function(){
           var content = "";
            content += '<h4>Add contact </h4>';
            content += '<div class="row"> ';
            content  +='<div class="form-group col-md-4">';
            content  +='<label>Contact Person/position </label>';
            content  +='<input name="add_contact_person" type="text" class="form-control contact_person" required  id="add_contact_person">';
            content += ' </div>';
            content +=' <div class="form-group col-md-4">';
            content +=' <label>Email Id </label>';
            content += ' <input name="add_contact_email" type="text" class="form-control contact_email" required  id="add_contact_email">';
            content += '</div>';
            content += '<div class="form-group col-md-4">';
            content += '<label>Contact Number </label>';
            content +='<input name="add_contact_no" type="text" class="form-control contact_no" required  id="add_contact_no">';
            content += '</div>';
            content += '</div>';
            $("#textbox").append(content);
         });
         
       $('#removebtn').click(function(){
        	  $('#textbox').children().last().remove();
         });
       
       $("#edit_contacts").click(function(){
                var content = "";
                content += '<h4>Add contact </h4>';
                content += '<div class="row"> ';
                content  +='<div class="form-group col-md-4">';
                content  +='<label>Contact Person/position </label>';
                content  +='<input name="edit_contact_person" type="text" class="form-control edit_contact_person" required>';
                content += ' </div>';
                content +=' <div class="form-group col-md-4">';
                content +=' <label>Email Id </label>';
                content += ' <input name="edit_contact_email" type="text" class="form-control  edit_contact_email" required>';
                content += '</div>';
                content += '<div class="form-group col-md-4">';
                content += '<label>Contact Number </label>';
                content +='<input name="edit_contact_no" type="text" class="form-control  edit_contact_no" required>';
                content += '</div>';
                content += '</div>';
                $("#edit_textbox").append(content);
         });
         
       $('#edit_removebtn').click(function(){
        	  $('#edit_textbox').children().last().remove();
       });
       
       function uploadform()
       {
            var content = "<div class ='row'>";
                content += '<div class="form-group col-md-6">';
                content += ' <label>Upload File</label>';
                content += '<input type="file" name ="edit_gallery_image[]" class="form-control edit_gallery_image" required>'; 
                content += ' </div>';
          
                content  +='<div class="form-group col-md-6">';
                content  +='<label>File type </label>';
                content  +='<input name="edit_file_type[]" type="text" class="form-control edit_file_type" required >';
                content += ' </div>';
                content += ' </div>';
                 
            return content;
       }
       
        $('#edit_upload_btn').click(function(){
            var content = uploadform();
            $("#edit_multi_images").append(content);
        });
            
        $('#remove_edit_upload_btn').click(function(){
            $('#edit_multi_images').children().last().remove();
        });
      
       $("#add_btn").click(function(){
            var regions = $("#add_region").val();
           // var p_type = $("#add_p_type").val();
            // var p_class = $("#add_policy_class").val();
            var brand = $("#add_brand").val();
            var school_name = $("#school_name").val();
            var school_mobile_no = $("#school_mobile_no").val();
            var email = $("#add_email").val();
            var address = $("#add_address").val();
            var remark = $("#add_remark").val();
            
            var contact_person = [];
            $(".contact_person").each(function(){
                contact_person.push($(this).val());  
            }); 
            var contact_email = [];
            $(".contact_email").each(function(){
                contact_email.push($(this).val());  
            }); 
            var contact_no= [];
            $(".contact_no").each(function(){
                contact_no.push($(this).val());  
            });
              
            if(regions == "")
            {
              snackbar_show("Select Region");
            }
            // else if(p_class == "")
            // {
            //   snackbar_show("Select Policy Class");
            // }
            // else if(p_type == "")
            // {
            //   snackbar_show("Enter Policy Type");
            // }
            else if(school_name == "")
            {
              snackbar_show("Enter School Name");
            }
            else if(brand == "")
            {
               snackbar_show("Enter Brand Name");
            }
            else if(address == "")
            {
              snackbar_show("Enter a Address");
            }
            if (snackbar_show != 1)
            {
                var cont =$(".gallery_image").length;
                var formdata = new FormData();
                var attachments = $("input[name='gallery_image[]'");
                var attachments_title = $("input[name='file_type[]'");
                if(cont > 0){
                    for(i = 0; i < cont; i++){
                        formdata.append("files_"+i,attachments[i].files[0]);
                        formdata.append("ftitle_"+i,attachments_title[i].value);
                    }
                }
                
                formdata.append("imgcount",cont);
                formdata.append("regions",regions);
                // formdata.append("p_class",p_class);
                // formdata.append("p_type",p_type);
                formdata.append("school_name",school_name);
                formdata.append("school_mobile_no",school_mobile_no);
                formdata.append("brand",brand)
                formdata.append("address",address);
                formdata.append("email",email);
                formdata.append("remark",remark);
                formdata.append("contact_person",contact_person);
                formdata.append("contact_email",contact_email);
                formdata.append("contact_no",contact_no);
              
              
                $.ajax({
                    url : "add_school_details",
                    method : "POST",
                    data:formdata,
                    method:"POST",
                    processData:false,  
                    contentType:false,
                    cache:false,
                    dataType:'text',
                    beforeSend:function(response){
                        $("#add_btn").attr("disabled",true);
                    },
                    success:function(response)
                    {
                        $("#add_btn").attr("disabled",false);
                        snackbar_show("Institution Details Stored Successfully..");
                        $("#add_model").modal("toggle");
                        fetch_schools();
                    }
                });
            }
        });
        
       $("#search_btn").click(function(){
           fetch_schools();
       });
       
       $("#edit_btn").click(function(){
              
              var id = $("#edit_id").val();
              var regions = $("#edit_region").val();
              var p_type = $("#edit_p_type").val();
              var p_class = $("#edit_policy_class").val();
              var brand = $("#edit_brand").val();
              var school_name = $("#edit_school_name").val();
              var school_mobile_no = $("#edit_school_mobile_no").val();
              var email = $("#edit_email").val();
              var address = $("#edit_address").val();
              var remark = $("#edit_remark").val();
              var contact_person = [];
              
             $(".edit_contact_person").each(function(){
                contact_person.push($(this).val());  
              }); 
              
              var contact_email = [];
              
              $(".edit_contact_email").each(function(){
                    contact_email.push($(this).val());  
              }); 
              
              var contact_no= [];
              
              $(".edit_contact_no").each(function(){
                    contact_no.push($(this).val());  
              });
              
              if(regions == "")
              {
                  snackbar_show("Select Region");
              }
              else if(p_class == "")
              {
                  snackbar_show("Select Policy Class");
              }
              else if(p_type == "")
              {
                  snackbar_show("Enter Policy Type");
              }
              else if(school_name == "")
              {
                  snackbar_show("Enter School Name");
              }
              else if(brand == "")
              {
                   snackbar_show("Enter Brand Name");
              }
              else if(address == "")
              {
                  snackbar_show("Enter a Address");
              }
              else 
              {
                    var cont = $(".edit_gallery_image").length;
                    var formdata = new FormData();
                    var attachments = $("input[name='edit_gallery_image[]'");
                    var attachments_title = $("input[name='edit_file_type[]'");
                    if(cont > 0){
                        for(i = 0; i < cont; i++){
                            formdata.append("files_"+i,attachments[i].files[0]);
                            formdata.append("ftitle_"+i,attachments_title[i].value);
                        }
                    }
                    formdata.append("imgcount",cont);
                    formdata.append("id",id);
                    formdata.append("regions",regions);
                    formdata.append("p_class",p_class);
                    formdata.append("p_type",p_type);
                    formdata.append("brand",brand);
                    formdata.append("school_name",school_name);
                    formdata.append("school_mobile_no",school_mobile_no);
                    formdata.append("email",email);
                    formdata.append("address",address);
                    formdata.append("remark",remark);
                    formdata.append("contact_person",contact_person);
                    formdata.append("contact_email",contact_email);
                    formdata.append("contact_no",contact_no);
                  $.ajax({
                            url : "edit_school_details",
                            data:formdata,
                            method:"POST",
                            processData:false,  
                            contentType:false,
                            cache:false,
                            dataType:'text',
                            beforeSend:function(response){
                                $("#add_btn").attr("disabled",true);
                            },
                            success:function(response)
                            {
                                $("#edit_btn").attr("disabled",false);
                                snackbar_show("Institution Details Stored Successfully..");
                                $("#edit_model").modal("toggle");
                                fetch_schools();
                            }
                  });
              }
       });
        
   });
       
    
    function fetch_schools()
    {
        region = $("#select_region").val();
        brand =$("#select_brand").val();
        policy_type =$("#select_policy_type").val();
        mobile_no = $("#s_mobile_no").val();
        school_name = $("#s_school_name").val();
        
        var content = "";
        content += "<div class='table-responsive'>";
        content += "<table id='table_id' class='table table-hover table-bordered'>"; 
        content += "<thead><th>S.No</th><th>Region</th><th>Institution Name</th><th>Mobile No</th><th>Policy_class</th><th>Address</th><th>Action</th></thead>";
        content += "<tbody></tbody>";
        content += "</table>";
        content += "</div>";
      
      $("#table_view").html(content);

      $("#table_id").DataTable({
          "processing": true,
          "serverSide": false,
          "ordering": false,
          "pageLength": 25,
          "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
          "ajax":{
            'url':'fetch_schools',
             method : 'POST',
             data : {region:region,brand:brand,policy_type:policy_type,mobile_no:mobile_no,school_name:school_name},
            
          }
      });      
    }
    
    
    function view_data(id)
    {
      $.ajax({
        url:"fetch_school_contact_info",
        data:{id:id},
        method:"POST",
        success:function(response){
          $("#view_data").html(response);
          $("#view_model").modal("show");
        },
        error: function(code) {   
            alert(code.statusText);
        },
      });
      
    }
    
    function export_excel()
    {   
        region = $("#select_region").val();
        brand =$("#select_brand").val();
        policy_type =$("#select_policy_type").val();
        mobile_no = $("#s_mobile_no").val();
        school_name = $("#s_school_name").val();
      
          $.ajax({
                url : "export_schools",
                method : "POST",
                data : {region:region,brand:brand,policy_type:policy_type,mobile_no:mobile_no,school_name:school_name},
                 success:function(response)
                 {
                      window.location.href=response;
                 },
            error: function(code) {
                alert(code.statusText);
            },
        });
    }
    
    
    function edit_data(id)
    {
            $.ajax({
                url:"fetch_edit_school",
                data:{id:id},
                method:"POST",
                success:function(response){
                  var obj = jQuery.parseJSON(response);
                  $("#edit_region").val(obj["basic"].region);
                  $("#edit_policy_class").val(obj["basic"].p_class);
                  $("#edit_p_type").val(obj["basic"].p_type);
                  $("#edit_brand").val(obj["basic"].brand);
                  $("#edit_school_name").val(obj["basic"].school_name);
                  $("#edit_email").val(obj["basic"].email);
                  $("#edit_school_mobile_no").val(obj["basic"].mobile);
                  $("#edit_address").val(obj["basic"].address);
                  $("#edit_remark").val(obj["basic"].remark);
                  
                  $("#edit_textbox").html("");
                  
                  var content = "";
                  
                  if(obj["contact_info"] != null)
                  {
                        for(var i = 0;i<obj["contact_info"].length;i++)
                        {
                            content += '<h4>Add contact </h4>';
                            content += '<div class="row"> ';
                            content  +='<div class="form-group col-md-4">';
                            content  +='<label>Contact Person/position </label>';
                            content  +='<input name="edit_contact_person" type="text" class="form-control edit_contact_person" required  id="edit_contact_person" value='+obj["contact_info"][i].contact_person+'>';
                            content += ' </div>';
                            content +=' <div class="form-group col-md-4">';
                            content +=' <label>Email Id </label>';
                            content += ' <input name="edit_contact_email" type="text" class="form-control edit_contact_email" required  id="edit_contact_email" value='+obj["contact_info"][i].c_email+'>';
                            content += '</div>';
                            content += '<div class="form-group col-md-4">';
                            content += '<label>Contact Number </label>';
                            content +='<input name="edit_contact_no" type="text" class="form-control edit_contact_no" required  id="edit_contact_no" value='+obj["contact_info"][i].contact_no+'>';
                            content += '</div>';
                            content += '</div>';
                        }
                       $("#edit_textbox").append(content);
                  }
                  
                  var size = Object.keys(obj["documents"]).length;
                  
                  if(size > 0){
                      var documents = '<ul>';
                      $.each(obj["documents"], function(ind, data){
                          console.log(data.file_type);
                          documents += '<li id="documents_'+data.id+'">'+data.file_type+' &nbsp;';
                          documents += '<a href="javascript:documents_remove('+data.id+');" class="" onclick="return confirm(\'Are You Sure Delete Documents?\')"><i class="fa fa-remove txt-danger"></i></a>';
                          documents += '</li>';
                      });
                      documents += '</ul>';
                      $("#edit_multi_images").append(documents);
                  }
                  
                  $("#edit_model").modal("show");
                  $("#edit_id").val(id);
                },
                error: function(code) {   
                    alert(code.statusText);
                },
              });
    }
    
    function documents_remove(id)
    {
        if(id){
            $.ajax({
                url : "school_documents_remove",
                method : "POST",
                dataType: "json",
                data : {
                    id: id
                },
                success:function(response)
                {
                    var size = Object.keys(response).length;
                    if(size > 0){
                        if( response.status == 'true'){
                            console.log($('#documents_'+id));
                            $('#documents_'+id).remove();
                        }
                            
                    }
                      
                },
                error: function(code) {
                    alert(code.statusText);
                },
            });
        }
        
    }
        
 //import excel start   
    $(document).ready(function(){
    	$('#import_form').on('submit', function(event){
    		event.preventDefault();
    		$.ajax({
    			url:"<?php echo base_url('ConfigCtrl/import_excel'); ?>",
    			method:"POST",
    			data:new FormData(this),
    			contentType:false,
    			cache:false,
    			processData:false,
    			beforeSend: function() {
    			  $('#result').html('loading...');
    			},
    			success:function(data){
    				$('#file').val('');
    				//load_data();
    				$('#result').html(data);
    				$('#tbl_schools').dataTable();
    				
    				//alert(data);
    			}
    		})
    	});
    	
    //model colose reload window
    	$('#excel_model').on('hidden.bs.modal', function() {
    	    window.location.reload();
    	});
    
    });
//import excel end          
        
</script>