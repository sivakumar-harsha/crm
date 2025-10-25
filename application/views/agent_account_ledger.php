<style>
.select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
color: #fff !important;
cursor: pointer;
display: inline-block;
font-weight: bold;
margin-right: 2px;
}
</style>
 
 
 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1 style="font-size: 17px;">
      Agent Account Ledger
      </h1> 
    </section>
    
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
     <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>


    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-body">
            
          <div class= "row">
                <div class = "form-group col-md-6">
                  <label>Main Ledger</label>
                  <select class = "form-control select2" name = "acc_head" id="acc_head" style="width:100%">
                      <option value = "">--select Account Head--</option>
                      <?php foreach($account_head as $da)  { ?>
                      <option value = "<?php echo $da->vchaccid ?>"><?php echo $da->vchaccname ?></option>
                      <?php } ?>
                  </select>
               </div>
               
             <div class = "form-group col-md-6">
                  <label>Sub Category</label>
                  <input type="text" class="form-control inputs" name="sub_leder" id="sub_leder">
              </div>
              
                <div class = "form-group col-md-6">
                  <label>Ledger Type </label><br>
                    <input class="form-check-input" type="radio" name="ledger_type" id="all_insuran" value="2">&nbsp;All Agent &nbsp;
                    <input class="form-check-input" type="radio" name="ledger_type" id="one_insurance_ledger" value="1">&nbsp;This One Agent &nbsp;
              </div>
              
               <div class = "form-group col-md-6">
                  <label>AGENT</label>
                    <select class="form-control select2" name="select_agents" id="select_agents"  style="width:100%">
                       <option value="all" selected>All Agents</option>
                    </select>
               </div>
               
               
               <div class="form-grou col-md-6">
                      <label>Type</label>
                      <select class="form-control" name="s_type" id="s_type" style="width:100%">
                          <option value="">--Select--</option>
                          <option value = "1">Credit</option>
                          <option value = "2">Debit</option>
                          <option value = "3">Both</option>
                      </select>
                  </div>
              
              
                <button type="button" class="btn btn-sm btn-primary pull-left" id="save_btn">Save</button>&nbsp;
                <button type="button" class="btn btn-sm btn-default">Clear</button> 
              </div>                
         </div>
        </div>
      </div>
               
     <script>
         
$(document).ready(function(){
    
      load_all_agents_list();
        
        $('.select2').select2();
        
        
         $(".inputs").keyup(function () {
           $(this).val($(this).val().toUpperCase()); 
            if (this.value.length == this.maxLength) {
              $(this).next('.inputs').focus();
            }
        });
        
        
        
         $("#save_btn").click(function(){
             
            var acc_head = $("#acc_head").val();
            var sub_leder = $("#sub_leder").val();
            var ledger_type = $("input[name='ledger_type']:checked").val();
            var select_agents = $("#select_agents").val();
            var s_type = $("#s_type").val();
            
           
            
            if(acc_head == "")
             {
                 snackbar_show("Select Account Head");
             }
             else if(sub_leder == "")
             {
                 snackbar_show("Add Sub Leder");
             }
             else if(ledger_type == "")
             {
                 snackbar_show("Select Ledger Type");
             }
              else
             {
                   $.ajax({
                            url : "add_agent_ledger",
                            method : "POST",
                            data : {acc_head:acc_head,sub_leder:sub_leder,ledger_type:ledger_type,select_agents:select_agents,s_type:s_type},
                            beforeSend:function(){
                               $("#save_btn").attr("disabled",true);
                            },
                            success:function(resposne)
                            {
                                $("#acc_head").val("");
                                $("#sub_leder").val("");
                                $("#ledger_type").val("");
                                $("#insur_company").val("");
                                $("#s_type").val();
                                $("#save_btn").attr("disabled",false);
                                snackbar_show("Add Insurance Company Created Successfully");
                            }
                    });
             }
          });
        
});


 function load_all_agents_list()
    {
        $.ajax({
                 url : "fetch_all_agents_list",
                 method : "POST",
                 success:function(response)
                 {
                     var obj = jQuery.parseJSON(response);
                     
                     for(var i= 0;i<obj.length;i++)
                     {
                         $("#select_agents").append("<option value='"+obj[i].id+"'>"+obj[i].name+" - "+obj[i].agent_pos_code+"</option>");
                     }
                     
                 }
        });
    }


     </script>           
               