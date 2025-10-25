<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1 style="font-size: 17px;">
        Bundel Master
        <?php if($this->auth->can_access('Create Bundel Master')):?>
            <button data-toggle="modal" data-target="#add_model" class="btn btn-primary btn-sm pull-right" id="add_mod">Add New</button>
        <?php endif;?>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-body">
          <div id="table_view"></div>
        </div><!-- /.box-body -->        
      </div><!-- /.box -->

    </section><!-- /.content -->
  </div><!-- /.content-wrapper -->



<div class="modal fade in" id="add_model">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true" style="color:white;">×</span></button>
                <h4 class="modal-title text-center">Add Bundel Master</h4>
            </div>
            <div class="modal-body">
                
                <div class="form-group">
                  <label>Insurance Company</label> <span id="add_insurance_company_error" style="color: red;">*</span>
                    <select class="form-control" id="add_insurance_company">
                        <option value="">Select</option>
                        <option value="-1">All</option>
                        <?php if(isset($insurance_company) && !empty($insurance_company)):?>
                            <?php foreach($insurance_company as $da):?>
                              <option value="<?php echo $da->id ?>">
                                  <?php echo $da->company_name ?></option>
                            <?php endforeach;?>
                        <?php endif;?>
                    </select>
                </div>
                
                <div class="form-group">
                  <label>Class</label> <span id="add_class_error" style="color: red;">*</span>
                    <select class="form-control" id="add_class" onchange="loadPolicyType(this.value,'add_policy_type', '')" >
                        <option value="">Select</option>
                        <option value="-1">All</option>
                        <?php if(isset($class) && !empty($class)):?>
                            <?php foreach($class as $da):?>
                              <option value="<?php echo $da->id ?>">
                                  <?php echo $da->class ?></option>
                            <?php endforeach;?>
                        <?php endif;?>
                    </select>
                </div>
                
                <div class="form-group">
                  <label>Policy Type</label> <span id="add_policy_type_error" style="color: red;">*</span>
                    <select class="form-control" id="add_policy_type" >
                        <!--<option value="">Select</option>
                        <?php// if(isset($policy_type) && !empty($policy_type)):?>
                            <?php// foreach($policy_type as $da):?>
                              <option value="<?php// echo $da->id ?>">
                                  <?php// echo $da->policy_type ?></option>
                            <?php// endforeach;?>
                        <?php// endif;?>-->
                        <option value="" selected="selected"> Select </option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label>OD Year</label> <span id="add_od_year_error" style="color: red;">*</span>
                    <input type="tel" class="form-control" id="add_od_year" maxlength="10" pattern="[0-9]{10}" oninput="this.value = this.value.replace(/[^0-9]/g, '');" />
                </div>
                
                <div class="form-group">
                    <label>TP Year</label> <span id="add_tp_year_error" style="color: red;">*</span>
                    <input type="tel" class="form-control" id="add_tp_year" maxlength="10" pattern="[0-9]{10}" oninput="this.value = this.value.replace(/[^0-9]/g, '');" />
                </div>
                
                <div class="form-group">
                    <label>Bundel Name</label> <span id="add_bundel_name_error" style="color: red;">*</span>
                    <input type="text" class="form-control" id="add_bundel_name" />
                </div>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-sm btn-primary" id="add_btn">Submit</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div> 


<div class="modal fade in" id="edit_model">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true" style="color:white;">×</span></button>
                <h4 class="modal-title text-center" id="edit_heading">Edit Bundel Master</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                  <label>Insurance Company</label> <span id="edit_insurance_company_error" style="color: red;">*</span>
                    <select class="form-control" id="edit_insurance_company">
                        <option>Select</option>
                        <option value="-1">All</option>
                        <?php if(isset($insurance_company) && !empty($insurance_company)):?>
                            <?php foreach($insurance_company as $da):?>
                              <option value="<?php echo $da->id ?>">
                                  <?php echo $da->company_name ?></option>
                            <?php endforeach;?>
                        <?php endif;?>
                    </select>
                </div>
                
                <div class="form-group">
                  <label>Class</label> <span id="edit_class_error" style="color: red;">*</span>
                    <select class="form-control" id="edit_class" onchange="loadPolicyType(this.value,'edit_policy_type', '')">
                        <option>Select</option>
                        <option value="-1">All</option>
                        <?php if(isset($class) && !empty($class)):?>
                            <?php foreach($class as $da):?>
                              <option value="<?php echo $da->id ?>">
                                  <?php echo $da->class ?></option>
                            <?php endforeach;?>
                        <?php endif;?>
                    </select>
                </div>
                
                <div class="form-group">
                  <label>Policy Type</label> <span id="edit_policy_type_error" style="color: red;">*</span>
                    <select class="form-control" id="edit_policy_type">
                        <!--<option>Select</option>
                        <?php// if(isset($policy_type) && !empty($policy_type)):?>
                            <?php// foreach($policy_type as $da):?>
                              <option value="<?php// echo $da->id ?>">
                                  <?php// echo $da->policy_type ?></option>
                            <?php// endforeach;?>
                        <?php// endif;?>-->
                        <option value="" selected="selected"> Select </option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label>OD Year</label> <span id="edit_od_year_error" style="color: red;">*</span>
                    <input type="tel" class="form-control" id="edit_od_year" maxlength="10" pattern="[0-9]{10}" oninput="this.value = this.value.replace(/[^0-9]/g, '');" />
                </div>
                
                <div class="form-group">
                    <label>TP Year</label> <span id="edit_tp_year_error" style="color: red;">*</span>
                    <input type="tel" class="form-control" id="edit_tp_year" maxlength="10" pattern="[0-9]{10}" oninput="this.value = this.value.replace(/[^0-9]/g, '');" />
                </div>
                
                <div class="form-group">
                    <label>Bundel Name</label> <span id="edit_bundel_name_error" style="color: red;">*</span>
                    <input type="text" class="form-control" id="edit_bundel_name" />
                </div>
                
            </div>
            <div class="modal-footer">
                <input type="hidden" id="edit_id">
                <button type="button" class="btn btn-sm btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-sm btn-primary" id="edit_btn">Submit</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div> 


<link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.min.css'></link>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.all.min.js"></script>
  <script>
    $(document).ready(function(){
      fetch_bundel_master();
      
      //check_permission();
        
      $("#add_btn").click(function(){

        var insurance_company_id = $("#add_insurance_company").val();
        var class_id = $("#add_class").val();
        var policy_type_id = $("#add_policy_type").val();
        var bundel_name = $("#add_bundel_name").val();
        var od_year = $("#add_od_year").val();
        var tp_year = $("#add_tp_year").val();
        
        $("#add_insurance_company_error").html("*");
        $("#add_class_error").html("*");
        $("#add_policy_type_error").html("*");
        $("#add_bundel_name_error").html("*");
        $("#add_od_year_error").html("*");
        $("#add_tp_year_error").html("*");
        console.log(insurance_company_id);
        
        var error_check = 0;
        if(insurance_company_id === "")
        {
            $("#add_insurance_company_error").html("* Required");
            error_check = 1;
        }
        if(class_id === "")
        {
            $("#add_class_error").html("* Required");
            error_check = 1;
        }
        if(policy_type_id === "")
        {
            $("#add_policy_type_error").html("* Required");
            error_check = 1;
        }
        if(bundel_name === "")
        {
            $("#add_bundel_name_error").html("* Required");
            error_check = 1;
        }
        if(od_year === "")
        {
            $("#add_od_year_error").html("* Required");
            error_check = 1;
        }
        if(tp_year === "")
        {
            $("#add_tp_year_error").html("* Required");
            error_check = 1;
        }
        if(error_check != 1)
		{
            var formdata = new FormData();
            formdata.append('insurance_company_id',insurance_company_id);
            formdata.append('class_id',class_id);
            formdata.append('policy_type_id',policy_type_id);
            formdata.append('bundel_name',bundel_name);
            formdata.append('od_year',od_year);
            formdata.append('tp_year',tp_year);
            $.ajax({
                url:"<?=base_url('BundelCtrl/add_bundel_master')?>",
                data:formdata,
                processData:false,  
        	    contentType:false,
        	    cache:false,
        	    dataType:'json',
                type:"POST",
                beforeSend:function(){
                    $("#add_btn").attr("disabled",true);
                },
                success:function(result){
                    // alert(response);
                    if (result.success == true) {
                        setTimeout(function() {
                            swal({  
                              title: "Successfuly Insert datas.",  
                              text: "Click!",  
                              icon: "success",  
                              button: "oh yes!",  
                            }).then((ok) => {
                                window.location.reload();
                            });
                        }, 500);
                    }
              
                    fetch_bundel_master();
                    $("#add_insurance_company").val("");
                    $("#add_class").val("");
                    $("#add_policy_type").val("");
                    $("#add_bundel_name").val("");
                    $("#add_od_year").val("");
                    $("#add_tp_year").val("");
                    $("#add_btn").attr("disabled",false);
                    $("#add_model").modal("hide");
                },
                error: function(code) {   
                    alert(code.statusText);
                },
            });
        }
      });

      $("#edit_btn").click(function(){

        var insurance_company_id = $("#edit_insurance_company").val();
        var class_id = $("#edit_class").val();
        var policy_type_id = $("#edit_policy_type").val();
        var bundel_name = $("#edit_bundel_name").val();
        var od_year = $("#edit_od_year").val();
        var tp_year = $("#edit_tp_year").val();
        var id = $("#edit_id").val();
        
        $("#edit_insurance_company_error").html("*");
        $("#edit_class_error").html("*");
        $("#edit_policy_type_error").html("*");
        $("#edit_bundel_name_error").html("*");
        $("#edit_od_year_error").html("*");
        $("#edit_tp_year_error").html("*");
        
        var error_check = 0;
        if(insurance_company_id === "")
        {
            $("#edit_insurance_company_error").html("* Required");
            error_check = 1;
        }
        if(class_id === "")
        {
            $("#edit_class_error").html("* Required");
            error_check = 1;
        }
        if(policy_type_id === "")
        {
            $("#edit_policy_type_error").html("* Required");
            error_check = 1;
        }
        if(bundel_name === "")
        {
            $("#edit_bundel_name_error").html("* Required");
            error_check = 1;
        }
        if(od_year === "")
        {
            $("#edit_od_year_error").html("* Required");
            error_check = 1;
        }
        if(tp_year === "")
        {
            $("#edit_tp_year_error").html("* Required");
            error_check = 1;
        }
        if(error_check != 1)
		{
            var formdata = new FormData();
            formdata.append('insurance_company_id',insurance_company_id);
            formdata.append('class_id',class_id);
            formdata.append('policy_type_id',policy_type_id);
            formdata.append('bundel_name',bundel_name);
            formdata.append('od_year',od_year);
            formdata.append('tp_year',tp_year);
            formdata.append('id',id);
          $.ajax({
            url:"<?=base_url('BundelCtrl/edit_bundel_master')?>",
            data:formdata,
            processData:false,  
		    contentType:false,
		    cache:false,
		    dataType:'json',
            method:"POST",
            beforeSend:function(){
                $("#edit_btn").attr("disabled",true);
            },
            success: function(result) {
            // alert('hi');
            if (result.success == true) {
                setTimeout(function() {
                    swal({
                        title: result.status,
                        text: result.status_text,
                        icon: result.status_icon,
                        button: "Done"
                    }).then((ok) => {
                        window.location.reload();
                    });
                }, 500);
            }
        
                fetch_bundel_master();
                $("#edit_insurance_company").val("");
                $("#edit_class").val("");
                $("#edit_policy_type").val("");
                $("#edit_bundel_name").val("");
                $("#edit_od_year").val("");
                $("#edit_tp_year").val("");
                $("#edit_btn").attr("disabled",false);
                $("#edit_model").modal("hide");
            },
            error: function(code) {   
                alert(code.statusText);
            },
          });
        }
      });

    });
    function fetch_bundel_master()
    {
      var content = "";
      content += "<div class='table-responsive'>";
      content += "<table id='table_id' class='table table-hover table-bordered'>"; 
      content += "<thead><th>S.No</th><th>Insurance Company</th><th>Class</th><th>Policy Type</th><th>Bundel Name</th><th>OD Year</th><th>TP Year</th> <th>Action</th></thead>";
      content += "<tbody></tbody>";
      content += "</table>";
      content += "</div>";
      
      $("#table_view").html(content);

      $("#table_id").DataTable({
          "processing": true,
          "serverSide": false,
          "ordering": false,
          "pageLength": 10,
          "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
          "ajax":{
            'url':"<?=base_url('BundelCtrl/fetch_bundel_master')?>",
          }
      });      
    }
    function edit_data(id)
    {
      $.ajax({
        url:"<?=base_url('BundelCtrl/fetch_edit_bundel_master')?>",
        data:{id:id},
        method:"POST",
        success:function(response){
          // alert(response);
          var obj = jQuery.parseJSON(response);
          $("#edit_insurance_company").val(obj.insurance_company_id);
          $("#edit_class").val(obj.class_id);
          
          loadPolicyType(obj.class_id, 'edit_policy_type', obj.policy_type_id);
          //$("#edit_policy_type").val(obj.policy_type_id);
          
          $("#edit_bundel_name").val(obj.bundel_name);
          $("#edit_od_year").val(obj.od_year);
          $("#edit_tp_year").val(obj.tp_year);
          $("#edit_heading").html("Edit Bundel Master");
          $("#edit_model").modal("show");
          $("#edit_id").val(id);
        },
        error: function(code) {   
            alert(code.statusText);
        },
      });
      
    }
    
    function deactive(id, status)
    {
        var status_txt = (status == "Y") ? "Active" : "Deactive";
        var confirmationMessage = "Are you sure you want to " + status_txt + "?";
        if (confirm(confirmationMessage)) 
        {
    		$.ajax({
                url:"<?=base_url('BundelCtrl/deactivate_bundel_master')?>",
                data:{id:id, status: status},
                method:"POST",
                dataType:'json',
                success:function(result){
                   // alert('hi');
                    if (result.success == true) {
                        setTimeout(function() {
                            swal({
                                title: result.status,
                                text: result.status_text,
                                icon: result.status_icon,
                                button: "Done"
                            }).then((ok) => {
                                window.location.reload();
                            });
                        }, 500);
                    }
                    fetch_bundel_master();
                },
                error:function(e,a,b){
                  alert("Error : "+e+a+b);
                },
            });
    	}
    }
    
    function loadPolicyType(policytype_id, ele, selectid)
    {
        //var caste_id = $('#caste_id').val();
        //alert(selectid);
        if(add_class != ""){            
            var tag = $('#'+ele);
            tag.find('option').remove();
            $.ajax({
                url: "<?=base_url('BundelCtrl/getPolicyType')?>",
                type: "GET",
                data: {
                    policytype_id: policytype_id            
                },                
                dataType: "json",
                success: function (response) {
                    var size = Object.keys(response).length;
                    tag.append('<option value="">Select</option>');
                    //default set value -1 'ALL' start
                    selected = (policytype_id == '-1') ? "selected" : "";
                    tag.append('<option value="-1" '+selected+'>ALL</option>');
                    //default set value -1 'ALL' end
                    if(size > 0) {
                        $.each(response, function(ind, data) {
                            var selected = "";
                            if(selectid != '') {
                                selected = (data.id == selectid) ? "selected" : "";
                            }
                            
                            tag.append('<option value="'+data.id+'" '+selected+'>'+data.policy_type+'</option>');
                        })
                    }
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    alert("Error Fetch!", "Please try again", "error");
                }
            });
        }
    }
  </script>