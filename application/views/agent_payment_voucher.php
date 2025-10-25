 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1 style="font-size: 17px;">
        Agent Payment
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
                  <label>Date</label>
                  <input type = "date" class="form-control" name="date" id="date" value="<?php echo date("Y-m-d") ?>">
               </div>
               
               <div class = "form-group col-md-6">
                  <label>Account Head</label>
                  <select class = "form-control select2" id="account_head" name="account_head" style='width:100%'>
                      <option value = "">--Select--</option>
                        <?php foreach($agent_id as $da){ ?>
                           <option value = "<?php echo $da->accid ?>"><?php echo $da->sr_no ?></option>
                          <?php } ?>
                  </select>
              </div>
              
              <div class = "form-group col-md-6">
                  <label>Sub Category</label>
                  <select class="form-control" name="sub_category" id="sub_category">
                      <option value = "">--Select--</option>
                       <?php foreach($sub_category as $da){ ?>
                           <option value = "<?php echo $da->accid ?>"><?php echo $da->vchparentid ?></option>
                          <?php } ?>
                  </select>
              </div>
              
              
                         <div class = "form-group col-md-6">
                  <label>Amount</label>
                  <input type="number" class="form-control" name ="amount" id="amount">
              </div>
              
              
              <div class = "form-group col-md-6">
                  <label>Naration</label>
                  <textarea class="form-control" name = "narration" id="narration" rows="4"></textarea>
              </div>
              
          
               <div class = "form-group col-md-6">
                  <label>Payment Mode</label><br>
                    <input class="form-check-input" type="radio" name="pay_mode" id="pay_mode_cheque" value="Cheque">&nbsp;Cheque &nbsp;
                    <input class="form-check-input" type="radio" name="pay_mode" id="pay_mode_cash" value="Cash">&nbsp;Cash &nbsp;
                    <input class="form-check-input" type="radio" name="pay_mode" id="pay_mode_transfer" value="Transfer">&nbsp;Transfer
              </div>
              
                <div class = "form-group col-md-6 hidden" id="cash_relase_div">
                  <label>Cash Release</label><br>
                    <input class="form-check-input" type="radio" name="cash_release" id="cash_release_1" value="Petty_Cash">&nbsp;Petty Cash &nbsp;
                    <input class="form-check-input" type="radio" name="cash_release" id="cash_release_2" value="Main_Cash">&nbsp;Main Cash &nbsp;
              </div>
              
               <div class = "form-group col-md-6 hidden" id="bank_div">
                  <label>Bank</label>
                  <input type="text" class = "form-control" name="bank" id="bank">
               </div>
             
               <div class = "form-group col-md-6 hidden" id="branch_div">
                      <label>Branch</label>
                      <input type="text" class = "form-control" name="bank_branch" id="bank_branch">
                </div>
                
                <div class = "form-group col-md-6 hidden" id="cheque_div">
                      <label>Cheque No</label>
                      <input type="text" class = "form-control" name="cheque_no" id="cheque_no">
                </div>
                
                <div class = "form-group col-md-6 hidden" id="trans_div">
                      <label>Transaction No</label>
                      <input type="text" class = "form-control" name="transaction_no" id="transaction_no">
                </div>
                
                 <div class = "form-group col-md-6">
                      <label>Transaction Date</label>
                      <input type="date" class = "form-control" name="trans_date" id="trans_date">
                </div>

                  <div class="col-md-3">
                     <div class="form-check">
                       <input class="form-check-input" type="checkbox" value="yes" id="print_receipt">
                         <label class="form-check-label">Print Receipt</label>
                     </div>
                  </div>
                   <button type="button" class="btn btn-sm btn-primary pull-left" id="save_btn">Save</button>&nbsp;
                    <button type="button" class="btn btn-sm btn-default">Clear</button> 
               </div>                
         </div>
           
            
          
        </div><!-- /.box-body -->        
      </div><!-- /.box -->

    </section><!-- /.content -->
  </div><!-- /.content-wrapper -->
  