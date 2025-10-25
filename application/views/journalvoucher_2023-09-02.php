<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    
     <section class="content-header">
       <div class="row">
           <div class="col-md-6">
               <h4> Journal Voucher</h4>
           </div>
            </div>
    </section>
    
      <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
     <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
    

<section class="content">
        
    <div class="box">
        <div class="box-header with-border" style="background:#f4f4f48c;">
            
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
                   <label >Acc Head</label>
                       </div>
                <div class="col-md-8">
                  <select class = "form-control select2" id="account_head" name="account_head" style='width:100%'>
                      <option value = "">--Select--</option>
                        <?php foreach($account_head as $da){ ?>
                           <option value = "<?php echo $da->vchaccid ?>"><?php echo $da->vchaccname ?></option>
                          <?php } ?>
                  </select>
                </div>
            </div>
        </div>
        
          <div class="form-group">
                   <div class="row"> 
                      <div class="col-md-4">
                   <label >Sub Category</label><span id="add_subcategory_error" style="color: red;">*</span>
                       </div>
                       <div class="col-md-8">
                     <select class = "form-control select2" name ="sub_category" id="sub_category">
                      <option value = "">--Select Sub Category--</option>
                   </select>
                </div>
            </div>
        </div>
        
          <div class="form-group">
                <div class="row">   
                    <div class="col-md-4">
                         <label>Debit</label><span id="add_debit_error" style="color: red;">*</span>
                    </div>
              <div class="col-md-8">
            <input type="text" class="form-control" name="other_contact_details" id="add_debit">
             </div>
          </div>
        </div>
        
         <div class="form-group">
                <div class="row">   
                    <div class="col-md-4">
                         <label>Credit</label><span id="add_credit_error" style="color: red;">*</span>
                    </div>
              <div class="col-md-8">
            <input type="text" class="form-control" name="other_contact_details" id="add_credit">
             </div>
          </div>
        </div>
    </div>
    
         <div class="col-md-6">
                     <div class="form-group">
                          <div class="row">   
                               <div class="col-md-4">
                                    <label>TDS Amount</label><span id="add_category_error" style="color: red;">*</span>
                               </div>
                               <div class="col-md-8">
                                   <input type="text" class="form-control"  id="add_amount">
                               </div>
                        </div>
                    </div>
                </div>
                
         <div class="d-md-flex justify-content-start align-items-center mb-4 py-2">
        
                  <h8 class="col-md-6 mb-4"> Advices: <span id="add_advices_error" style="color: red;">*</span> </h8>

                  <div class="form-group form-check-inline col-md-6" >
                <div class="col-md-8">
                    <input  type="radio" name="inlineRadioOptions"  value="debit" />
                    <label class="form-check-label" id="debit" >Debit</label>
       
                

       
                    <input  type="radio" name="inlineRadioOptions"  value="credit" />
                    <label class="form-check-label" id="credit" >Credit</label>
                   
           

                  
                    <input   type="radio" name="inlineRadioOptions"  id="otherGender"  value="printrecepit" />
                    <label class="form-check-label" for="printrecepit">Print Recepit</label>
                    </div>
                  

                </div>
            </div>
         
     
    <div class="col-md-6">
         <div class="form-group ">
             <div class="row">
               <div class="col-md-4">
                  <label>Remark</label><span id="add_remark_error" style="color: red;">*</span>
                 </div>
             <div class="col-md-8"> 
                <textarea rows="3" class="form-control" name="remarks" id="add_remark"></textarea>
            </div>
        </div>
     </div>
</div>

     <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-primary" id="add_btn">Submit</button>
            </div>
        
    
    
      </div>
   </div>
  </div>
 
     
    </section><!-- /.content -->
  </div><!-- /.content-wrapper -->
        
  <script>
  
    $(document).ready(function(){
        
         $('.select2').select2();
        
        
          $("#account_head").change(function(){
                var account_head = $("#account_head").val();

                 $.ajax({
                            url : "fetch_particulars_by_account_head",
                            method : "POST",
                            data : {account_head:account_head},
                            success:function(response)
                            {
                                $("#sub_category").html(response);
                            }
                 });
          });
      
      $("#add_btn").click(function(){
          
          var acchead =$("#account_head").val();
          var subcategory =$("#sub_category").val();
          var debit =$("#add_debit").val();
          var credit =$("#add_credit").val();
          var tdsamount =$("#add_amount").val();
          var remark =$("#add_remark").val();
          var advices = $("input[name='inlineRadioOptions']:checked").val();
          
        $("#add_acchead_error").html("*");
        $("#add_subcategory_error").html("*");
        $("#add_category_error").html("*");
        $("#add_advices_error").html("*");
        $("#add_remark_error").html("*");
        
        
         var error_check = 0;

        if(acchead === "")
        {
          $("#add_acchead_error").html("* Required");
          error_check = 1;
        }
        else if(subcategory === "")
        {
          $("#add_subcategory_error").html("* Required");
          error_check = 1;
        }
         else if(remark === "")
        {
          $("#add_remark_error").html("* Required");
           error_check = 1;
        }
        
        
        if(error_check != 1)
        {
          $.ajax({
            url:"add_journalvoucher",
            data:{acchead:acchead,
                  subcategory:subcategory,
                  debit:debit,
                  credit:credit,
                  tdsamount:tdsamount,
                  remark:remark,
                  advices:advices,
                 },
            method:"POST",
            beforeSend:function(){
                $("#add_btn").attr("disabled",true);
            },
            success:function(response){
                // alert(response);
                $("#account_head").val("");
                $("#sub_category").val("");
                $("#add_debit").val("");
                $("#add_credit").val("");
                $("#add_amount").val("");
                $("#add_remark").val("");
                $("#add_btn").attr("disabled",false);
                $("#add_model").modal("hide");
            },
            error: function(code) {   
                alert(code.statusText);
            },
          });
        }
      });
    });
    </script>   

                    
              