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
        Dealers
        <button data-toggle="modal" data-target="#add_model" class="btn btn-primary btn-sm pull-right" style="margin-top: -12px !important;">Add New</button>
        <button onclick="export_excel()" class="btn btn-danger btn-sm pull-right" style="margin-top: -12px !important;"><i class="fa fa-file-excel-o"></i>&nbsp;Export</button>
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
                             <input type = "text" class="form-control" name="select_brand" id="select_brand" placeholder="Brand Name">
                      </div>
                      
                    <div class="form-group col-md-2">
                             <input type = "text" class="form-control" name="select_policy_type" id="select_policy_type" placeholder="Policy Type">
                    </div>
                    
                    <div class="form-group col-md-2">
                             <input type = "text" class="form-control" name="s_mobile_no" id="s_mobile_no" placeholder="Mobile No">
                      </div>
                      
                    <div class="form-group col-md-2">
                         <input type ="text" class="form-control" name="s_dealer_name" id="s_dealer_name" placeholder="Dealer Name">
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
                    <h4 class="modal-title text-center">Add Dealers</h4>
                </div>
       
                <div class="modal-body">
        
                 <div class = "row">
                     <div class="form-group col-md-4">
                          <label>Region</label>
                              <select id="add_region" name ="add_region" class="form-control select2" required style="width:100%">
                                 <option value="">--select--</option>
                                 <?php foreach($region as $da){?>
                                    <option value="<?php echo $da->reigion ?>"><?php echo $da->reigion ?></option>
                                            <?php } ?>
                             </select>
                         </div>
                         
                     <div class="form-group col-md-4">
                          <label>Policy Class</label>
                          <select id="add_policy_class" name ="add_policy_class" class="form-control select2" required style="width:100%">
                             <option value="">--select--</option>
                             <?php foreach($class as $da){?>
                                <option value="<?php echo $da->class ?>"><?php echo $da->class ?></option>
                                        <?php } ?>
                         </select>
                     </div>
                     
                      <div class="form-group col-md-4">
                          <label>Policy Type</label>
                          <input type="text" id="add_p_type" name ="add_p_type" class="form-control select2" placeholder= "Eg(Bike ,Car,Misc-D)">
                     </div>
                 </div>
                
                
                
                <div class = "row">
                    <div class="form-group col-md-4">
                        <label>Brand</label> 
                        <input type="text" class="form-control" id="add_brand" name="add_brand"> 
                    </div>
                    
                    <div class="form-group col-md-4">
                        <label>Dealer Name</label> 
                        <input type="text" class="form-control" id="dealer_name" name="activice"> 
                    </div>
                    
                    <div class="form-group col-md-4">
                        <label>Mobile No</label> 
                        <input type="text" class="form-control" id="dealer_mobile_no" name="dealer_mobile_no"> 
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
                
                <div class="form-group">
                     <button type="button" id="removebtn" class= "btn btn-danger btn-xs pull-right">Remove</button>
                     <button type="button" id="add_contacts" class= "btn btn-primary btn-xs pull-right">Add More</button>
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
                    <h4 class="modal-title text-center">Dealers Contact Info</h4>
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
                    <h4 class="modal-title text-center">Add Dealers</h4>
                </div>
       
                <div class="modal-body">
				
				<input type = "hidden" id="edit_id">
        
                 <div class = "row">
                     <div class="form-group col-md-4">
                          <label>Region</label>
                              <select id="edit_region" name ="edit_region" class="form-control select2" required style="width:100%">
                                 <option value="">--select--</option>
                                 <?php foreach($region as $da){?>
                                    <option value="<?php echo $da->reigion ?>"><?php echo $da->reigion ?></option>
                                            <?php } ?>
                             </select>
                         </div>
                         
                     <div class="form-group col-md-4">
                          <label>Policy Class</label>
                          <select id="edit_policy_class" name ="edit_policy_class" class="form-control select2" required style="width:100%">
                             <option value="">--select--</option>
                             <?php foreach($class as $da){?>
                                <option value="<?php echo $da->class ?>"><?php echo $da->class ?></option>
                                        <?php } ?>
                         </select>
                     </div>
                     
                      <div class="form-group col-md-4">
                          <label>Policy Type</label>
                          <input type="text" id="edit_p_type" name ="edit_p_type" class="form-control select2" placeholder= "Eg(Bike ,Car,Misc-D)">
                     </div>
                 </div>
                
                
                
                <div class = "row">
                    <div class="form-group col-md-4">
                        <label>Brand</label> 
                        <input type="text" class="form-control" id="edit_brand" name="edit_brand"> 
                    </div>
                    
                    <div class="form-group col-md-4">
                        <label>Dealer Name</label> 
                        <input type="text" class="form-control" id="edit_dealer_name" name="edit_dealer_name"> 
                    </div>
                    
                    <div class="form-group col-md-4">
                        <label>Mobile No</label> 
                        <input type="text" class="form-control" id="edit_dealer_mobile_no" name="edit_dealer_mobile_no"> 
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
      

<script>

    var region = $("#select_region").val();
    var brand =$("#select_brand").val();
    var policy_type =$("#select_policy_type").val();
    var mobile_no = $("#s_mobile_no").val();
    var dealer_name = $("#s_dealer_name").val();
        
        
   $(document).ready(function(){
       fetch_dealers();

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
      
       $("#add_btn").click(function(){
              var regions = $("#add_region").val();
              var p_type = $("#add_p_type").val();
              var p_class = $("#add_policy_class").val();
              var brand = $("#add_brand").val();
              var dealer_name = $("#dealer_name").val();
              var dealer_mobile_no = $("#dealer_mobile_no").val();
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
              else if(p_class == "")
              {
                  snackbar_show("Select Policy Class");
              }
              else if(p_type == "")
              {
                  snackbar_show("Enter Policy Type");
              }
              else if(dealer_name == "")
              {
                  snackbar_show("Enter Dealer Name");
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
                  $.ajax({
                            url : "add_dealer_details",
                            method : "POST",
                            data : {regions:regions,p_class:p_class,p_type:p_type,brand:brand,dealer_name:dealer_name,dealer_mobile_no:dealer_mobile_no,email:email,address:address,remark:remark,contact_person:contact_person,contact_email:contact_email,contact_no:contact_no},
                            beforeSend:function(response){
                                $("#add_btn").attr("disabled",true);
                            },
                            success:function(response)
                            {
                                $("#add_btn").attr("disabled",false);
                                snackbar_show("Dealer Details Stored Successfully..");
                                $("#add_model").modal("toggle");
                                fetch_dealers();
                            }
                  });
              }
     
        });
        
       $("#search_btn").click(function(){
           fetch_dealers();
       });
       
       $("#edit_btn").click(function(){
              
              var id = $("#edit_id").val();
              var regions = $("#edit_region").val();
              var p_type = $("#edit_p_type").val();
              var p_class = $("#edit_policy_class").val();
              var brand = $("#edit_brand").val();
              var dealer_name = $("#edit_dealer_name").val();
              var dealer_mobile_no = $("#edit_dealer_mobile_no").val();
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
              else if(dealer_name == "")
              {
                  snackbar_show("Enter Dealer Name");
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
                  $.ajax({
                            url : "edit_dealer_details",
                            method : "POST",
                            data : {id:id,regions:regions,p_class:p_class,p_type:p_type,brand:brand,dealer_name:dealer_name,dealer_mobile_no:dealer_mobile_no,email:email,address:address,remark:remark,contact_person:contact_person,contact_email:contact_email,contact_no:contact_no},
                            beforeSend:function(response){
                                $("#edit_btn").attr("disabled",true);
                            },
                            success:function(response)
                            {
                                $("#edit_btn").attr("disabled",false);
                                snackbar_show("Dealer Details Stored Successfully..");
                                $("#edit_model").modal("toggle");
                                fetch_dealers();
                            }
                  });
              }
       });
        
   });
       
    
    function fetch_dealers()
    {
        region = $("#select_region").val();
        brand =$("#select_brand").val();
        policy_type =$("#select_policy_type").val();
        mobile_no = $("#s_mobile_no").val();
        dealer_name = $("#s_dealer_name").val();
        
        var content = "";
        content += "<div class='table-responsive'>";
        content += "<table id='table_id' class='table table-hover table-bordered'>"; 
        content += "<thead><th>S.No</th><th>Region</th><th>Dealer Name</th><th>Mobile No</th><th>Brand</th><th>Policy_class</th><th>Policy_Type</th><th>Address</th><th>Action</th></thead>";
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
            'url':'fetch_dealers',
             method : 'POST',
             data : {region:region,brand:brand,policy_type:policy_type,mobile_no:mobile_no,dealer_name:dealer_name},
            
          }
      });      
    }
    
    
    function view_data(id)
    {
      $.ajax({
        url:"fetch_dealers_contact_info",
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
        dealer_name = $("#s_dealer_name").val();
      
          $.ajax({
                url : "export_dealers",
                method : "POST",
                data : {region:region,brand:brand,policy_type:policy_type,mobile_no:mobile_no,dealer_name:dealer_name},
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
                url:"fetch_edit_dealers",
                data:{id:id},
                method:"POST",
                success:function(response){
                  var obj = jQuery.parseJSON(response);
                  $("#edit_region").val(obj["basic"].region);
                  $("#edit_policy_class").val(obj["basic"].p_class);
                  $("#edit_p_type").val(obj["basic"].p_type);
                  $("#edit_brand").val(obj["basic"].brand);
                  $("#edit_dealer_name").val(obj["basic"].dealer_name);
                  $("#edit_email").val(obj["basic"].email);
                  $("#edit_dealer_mobile_no").val(obj["basic"].mobile);
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
                  
                  
                  $("#edit_model").modal("show");
                  $("#edit_id").val(id);
                },
                error: function(code) {   
                    alert(code.statusText);
                },
              });
    }
        
        
</script>