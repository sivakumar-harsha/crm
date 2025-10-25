 <style>
 
   .form-control {
    display: block;
    width: 100%;
    height: 29px;
    padding: 4px 10px;
    font-size: 14px;
    line-height: 1.42857143;
    color: #555;
    background-color: #fff;
    background-image: none;
    border: 1px solid #ccc;
    border-radius: 4px;
    -webkit-box-shadow: inset 0 1px 1px rgb(0 0 0 / 8%);
    box-shadow: inset 0 1px 1px rgb(0 0 0 / 8%);
    -webkit-transition: border-color ease-in-out .15s,-webkit-box-shadow ease-in-out .15s;
    -o-transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
    transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
}

 .change_pet_gender
    {
        background-color: #12b48b !important;
        color: white !important;
    }

.form-check-input:checked {
    background-color: #0d6efd !important;
    border-color: #0d6efd !important;
}
.form-check-input{
    border-color: 1px solid #D3CFC8 !important;
}

label {
    display: inline-block;
    max-width: 100%;
    margin-bottom: 5px;
    font-weight: unset;
    font-size: 14px;
}

.btn {
    border-radius: 1px;
    -webkit-box-shadow: none;
    box-shadow: none;
    border: 1px solid transparent;
}
.save_model{
    margin-right:-70px;
}
@media only screen and (max-width: 600px) {
  .save_model {
     margin-right:0px;
  }
}
input[type=checkbox], input[type=radio] {
    margin: 9px 0px 0;
    margin-top: 1px\9;
    line-height: normal;
}

.modal-lg {
  width: 100%;
  height: 100%;
  margin: 0;
  padding: 0;
  z-index:10000000 !important;
}

.no_mar_pad {
    margin-top: 0px;
    margin-bottom: 0px;
    padding-top: 8px !important;
    padding-bottom: 0px !important;
    color :#5b6379 !important;
}

.modal-lg-content {
  height: auto;
  width:auto;
  min-height: 100%;
  border-radius: 0;
}

@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap');
*{
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: "Poppins", sans-serif;
}

 .drag-area{
  border: 2px dashed #fff;
  height: 500px;
  width: 700px;
  border-radius: 5px;
  display: flex;
  align-items: center;
  justify-content: center;
  flex-direction: column;
}
.drag-area.active{
  border: 2px solid #fff;
}
.drag-area .icon{
  font-size: 100px;
  color: #fff;
}
.drag-area header{
  font-size: 30px;
  font-weight: 500;
  color: #fff;
}
.drag-area span{
  font-size: 25px;
  font-weight: 500;
  color: #fff;
  margin: 10px 0 15px 0;
}
.drag-area button{
  padding: 10px 25px;
  font-size: 20px;
  font-weight: 500;
  border: none;
  outline: none;
  background: #fff;
  color: #5256ad;
  border-radius: 5px;
  cursor: pointer;
}
.drag-area img{
  height: 100%;
  width: 100%;
  object-fit: cover;
  border-radius: 5px;
}

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

.form-control[disabled], .form-control[readonly], fieldset[disabled] .form-control {
    background-color: #fff !important;
    opacity: 1;
}

.modal {
    position: fixed;
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;
    z-index: 1050;
    display: none;
    overflow: auto !important;
    -webkit-overflow-scrolling: touch;
    outline: 0;
}

.form-check-input {
    width: 2em;
    height: 1.5em;
    background-color: #fff;
    background-repeat: no-repeat;
    border: 1px solid rgba(0,0,0,.25);
}
*, ::after, ::before {
    box-sizing: border-box;
}

input[type=checkbox], input[type=radio] {
    margin: 5px 0px 0 !important;
    line-height: normal;
}

/*  Property    */
  
  .change_house_type
    {
        background-color: #12b48b !important;
        color: white !important;
    }
    .change_owner
    {
        background-color: #12b48b !important;
        color: white !important;
    }
    .business_change_owner
    {
        background-color: #12b48b !important;
        color: white !important;
    }
    
    .img_style{
        height:50px;
        width:50px;
    }
     
    </style>
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    
     <section class="content-header">
       <div class="row">
           <div class="col-md-6">
               <h4>Lead(Min.dtls)</h4>
           </div>
            <div class="col-md-6 pull-right">
                    <button class="btn btn-success btn-sm pull-right" id="save_btn"><i class="fa fa-save"></i> Save</button>
            </div>
       </div>
    </section>
    
    
        <!-- Main content -->
    <section class="content">
        
    <div class="box">
        <div class="box-header with-border" style="background:#f4f4f48c;">
            <h3 class="box-title" _msthash="26273" _msttexthash="60619" style="text-align: left;font-size:14px;"><i class="fa fa-user" aria-hidden="true"></i> &nbsp;&nbsp;Client Details</h3>
            
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
                                <label>Client Name</label><span>*</span>
                           </div>
                           <div class="col-md-8">
                                <input type="text" class="form-control" name="client_name" id="client_name">
                           </div>
                         </div>
                    </div>
                    
                    
                    <div class="form-group">
                        <div class="row">   
                           <div class="col-md-4">
                                <label>Mobile No</label><span>*</span>
                           </div>
                           <div class="col-md-8">
                                <div class="input-group">
                                    <div class="input-group-addon">+91</div>
                                
                                  <input type="number" class="form-control" name="mobile_no" maxlength="10" minlength="10" size="10" id="mobile_no">
                              </div>
                            </div>
                         </div>
                    </div>
                    
                    
                      <div class="form-group">
                            <div class="row">   
                               <div class="col-md-4">
                                     <label>Address</label>
                               </div>
                               <div class="col-md-8">
                                   <textarea class="form-control" name="address" id="address" rows="3"></textarea>
                               </div>
                             </div>
                     </div>
              
                
                 <div class="form-group">
                    <div class="row">   
                       <div class="col-md-4">
                            <label>Due Date</label>
                       </div>
                       <div class="col-md-4">
                           <input type="date" class="form-control" name="due_date" id="due_date">
                       </div>
                       
                       <div class="col-md-4">
                           <input type="checkbox" class="form-check-input"  name="broken_policy" id="broken_policy">
                           <label> Broken Policy</label>
                       </div>
                       
                     </div>
                </div>
            
                <div class="form-group">
                        <div class="row">   
                           <div class="col-md-4">
                               <label>Remarks</label>
                           </div>
                            <div class="col-md-8">
                                <textarea rows="3" class="form-control" name="remarks" id="remarks"></textarea>
                            </div>
                        </div>
                    </div>
                    
                    </div>
                
                <div class="col-md-6">
                    
                     <div class="form-group" id="v_regn_no_div">
                            <div class="row">
                                <div class="col-md-4">
                                    <label>Regn no</label>*<span id='regn_no_span' style='color:red'> </span>
                                </div>
                                
                                <div class="col-md-2 inputs">
                                    <input type="text" class="form-control inputs" name="v_regn_no_1" id="v_regn_no_1" maxlength="2">
                                </div>
                                <div class="col-md-2 inputs">
                                    <input type="text" class="form-control inputs" name="v_regn_no_2" id="v_regn_no_2" maxlength="2">
                                </div>
                                <div class="col-md-2 inputs">
                                    <input type="text" class="form-control inputs" name="v_regn_no_3" id="v_regn_no_3" maxlength="2">
                                </div>
                                <div class="col-md-2 inputs">
                                    <input type="text" class="form-control inputs" name="v_regn_no_4" id="v_regn_no_4" maxlength="4">
                                </div>
                            </div>
                        </div>
                        
                <div class="form-group">
                      <div class="row">   
                           <div class="col-md-4">
                               <label>Agent / Pos *</label>
                           </div>
                            <div class="col-md-8">
                                <select class="form-control select2" name="agent_pos" id="agent_pos" >
                                    <option value="">--select--</option>
                                    <?php foreach($agents_pos as $da){?>
                                      <option value="<?php echo $da->id ?>"><?php echo $da->name."  - ".$da->agent_pos_code."" ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                        
                                 <input type="hidden" id="session_role" value="<?php echo $this->session->userdata("session_role") ?>">
                    
                     <div class="form-group">
                      <div class="row">   
                           <div class="col-md-4">
                               <label>Assign to User *</label>
                           </div>
                            <div class="col-md-8">
                                <select class="form-control select2" name="assign_to_user" id="assign_to_user">
                                 <?php
                                    if($this->session->userdata("session_role") == "admin")
                                    { ?>
                                    <?php foreach($users as $da){?>
                                    <option value="<?php echo $da->id ?>"><?php echo $da->username."  (".$da->email_id.")" ?></option>
                                    <?php }} ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    
                    <div class="form-group">
                      <div class="row">   
                           <div class="col-md-4">
                               <label>Area Incharge *</label>
                           </div>
                            <div class="col-md-8">
                                <select class="form-control" name="area_incharge" id="area_incharge">
                                    <option value="">--Select--</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    
                       <div class="form-group">
                        <div class="row">   
                           <div class="col-md-4">
                                <label>Class</label><span>*</span>
                           </div>
                           <div class="col-md-8">
                                <select class="form-control" name="policy_class" id="policy_class">
                                    <option value="">--select--</option>
                                    <?php foreach($class as $da){ ?>
                                      <option value="<?php echo $da->id ?>"><?php echo $da->class ?></option>
                                    <?php } ?>
                                </select>
                           </div>
                         </div>
                    </div>
                  
                     <div class="form-group">
                        <div class="row">   
                           <div class="col-md-4">
                                <label>Policy type</label><span>*</span>
                           </div>
                           <div class="col-md-8">
                                <select class="form-control" name="policy_type" id="policy_type">
                                    <option value="">--select--</option>
                                </select>
                           </div>
                         </div>
                    </div>
                    
        </div>
        </div>
    </section>
    
    
      <script>
        $(document).ready(function(){
         
         $('.select2').select2();
         
         
          $(".inputs").keyup(function () {
           $(this).val($(this).val().toUpperCase()); 
            if (this.value.length == this.maxLength) {
              $(this).next('.inputs').focus();
            }
        });
         
       
          $("#v_regn_no_4").change(function(){
            var v_regn_no_1 = $("#v_regn_no_1").val();
            var v_regn_no_2 = $("#v_regn_no_2").val();
            var v_regn_no_3 = $("#v_regn_no_3").val();
            var v_regn_no_4 = $("#v_regn_no_4").val();
                     $.ajax({
                            url : "fetch_vechile_number_check",
                            method : "POST",
                            data : {v_regn_no_1:v_regn_no_1,v_regn_no_2:v_regn_no_2,v_regn_no_3:v_regn_no_3,v_regn_no_4:v_regn_no_4},
                            success:function(response)
                            {
                                if(response == "true")
                                {
                                    snackbar_show("Already exists the vehicle No.");
                                    $("#v_regn_no_1").val("");
                                    $("#v_regn_no_2").val("");
                                    $("#v_regn_no_3").val("");
                                    $("#v_regn_no_4").val("");
                                    $("#v_regn_no_1").focus();
                                    return;
                                }
                                
                            }
                         });
                 });
                 
                 
    $("#policy_class").change(function(){
           var policy_class = $("#policy_class").val();
           $.ajax({
                url : "fetch_policy_type_using_class",
                method : "POST",
                data:{policy_class:policy_class},
                success:function(response)
                { 
                    var obj = jQuery.parseJSON(response);
                    
                    var str = "<option value=''>--Select--</option>";
                    for(var j=0;j<obj.length;j++)
                    {
                        str += "<option value='"+obj[j].id+"'>"+obj[j].policy_type+"</option>";
                    }
                    $("#policy_type").html(str);
                }
           });
    });
           
         
         
    $("#agent_pos").change(function(){
            var agent_pos = $("#agent_pos").val();
            var session_role = $("#session_role").val();
            
             $.ajax({
                       url : "fetch_area_incharge_by_agent",
                       method : "POST",
                       data : {agent_pos:agent_pos},
                       success:function(response)
                       {
                           var obj = jQuery.parseJSON(response);
                           
                           var html = "";
                           
                           if(obj != null)
                           {
                               html ="<option value='"+obj.id+"'>"+obj.name+"  -( "+obj.phoneno+" )</option>"
                           }
                           $("#area_incharge").html(html);
                       }
            });
            
            if(session_role == "AI" || session_role == "user")
            {
                $.ajax({
                       url : "fetch_user_by_agent",
                       method : "POST",
                       data : {agent_pos:agent_pos},
                       success:function(response)
                       {

                           $("#assign_to_user").html(response);
                       }
            });
            }
        });
        
         $("#save_btn").click(function(){
             
             var client_name = $("#client_name").val();
             var mobile_no = $("#mobile_no").val(); 
             var address = $("#address").val();
             var due_date = $("#due_date").val();
             var broken_policy = $("#broken_policy").val();
             var remarks = $("#remarks").val();
             
            var v_regn_no_1 = $("#v_regn_no_1").val();
            var v_regn_no_2 = $("#v_regn_no_2").val();
            var v_regn_no_3 = $("#v_regn_no_3").val();
            var v_regn_no_4 = $("#v_regn_no_4").val();

            var v_regn_no = v_regn_no_1+"-"+v_regn_no_2+"-"+v_regn_no_3+"-"+v_regn_no_4;
            
            var agent_pos = $("#agent_pos").val();
            var assign_to_user = $("#assign_to_user").val();
            var area_incharge = $("#area_incharge").val();
            var policy_class = $("#policy_class").val();
            var policy_type = $("#policy_type").val();
            
            
            var formdata = new FormData();
            formdata.append("client_name",client_name);
            formdata.append("mobile_no",mobile_no);
            formdata.append("address",address);
            formdata.append("policy_class",policy_class);
            formdata.append("policy_type",policy_type);
            formdata.append("agent_pos",agent_pos);
            formdata.append("due_date",due_date);
            formdata.append("assign_to_user",assign_to_user);
            formdata.append("area_incharge",area_incharge);
            formdata.append("remarks",remarks);
            formdata.append("v_regn_no",v_regn_no);
            
            if(client_name == "")
             {
                 snackbar_show("Select Client Type");
                 check = 1;
             }
             else if(mobile_no == "")
             {
                 snackbar_show("Enter Client Name");
                 check = 1;
             }  
             else if(policy_class == "")
             {
                 snackbar_show("Select Class");
                 check = 1;
             }
             else if(policy_type == "")
             {
                 snackbar_show("Select Policy Type");
                 check = 1;
             }
              else if(agent_pos == "" || agent_pos == null)
             {
                 snackbar_show("Select Agents And Pos");
                 check = 1;
             }
             else if(assign_to_user == "" || assign_to_user == null)
             {
                 snackbar_show("Select Assign To User");
                 check = 1;
             }
             else if(area_incharge == "" || area_incharge == null)
             {
                 snackbar_show("Select Area Incharge");
                 check = 1;
             }
             else 
             {
                 $.ajax({
                        url : "add_temp_leads",
                        method : "POST",
                        data:formdata,
                        processData:false,  
                        contentType:false,
                        cache:false,
                        dataType:'text',
                        beforeSend:function(){
                        $("#save_btn").attr("disabled",true);
                      },
                      success:function(response){
                            if(response == "Exits")
                            {
                                snackbar_show("Vechicle Registration Number Already Exits");
                                $("#save_btn").attr("disabled",false);
                            }
                            else
                            {
                                 Swal.fire({
                                    position: 'top-end',
                                    icon: 'success',
                                    title: 'Lead Created Successfully',
                                    showConfirmButton: false,
                                    timer: 1500
                                    });
                                  $("#save_btn").attr("disabled",false);
                                  //$("#save_btn").addClass("hidden");
                                 // window.location.href="leads";
                            }
                       },
                 });
             }
             
             
          });  
             
         });
        

         
         </script>
                    
                    