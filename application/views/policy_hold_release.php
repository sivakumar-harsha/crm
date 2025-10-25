<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    
    
    <section class="content-header">
      <div class = "row" style="background:whitesmoke;border:1px solid gray;padding:unset;margin:unset">  

            <input type = "hidden" class="form-control" id="lead_id" name="lead_id">
          
          
          <div class = "col-md-3" style="border-right: 1px solid gray">
              <div class = "form-group">
                  <label><h3>Policy Hold / Cancel Release</h3></label>                  
              </div>
          </div>

          <div class = "col-md-2">
              <label>Month</label>
              <div class = "form-group">                  
                  <select class = "form-control select2" name = "month" id="month"  style="width:80%;display:inline-block;">                      
                      <option value = "">All</option>
                      <?php foreach($monthlist as $month_key => $month_name)  { ?>
                      <option value = "<?php echo $month_key ?>"><?php echo $month_name ?></option>
                      <?php } ?>
                  </select>
              </div>
          </div>                   
          <div class = "col-md-4">
                <label>Company</label>
              <div class = "form-group">                  
                  <select class = "form-control select2" name = "company_id" id="company_id"  style="width:80%;display:inline-block;">                      
                      <option value = "">All</option>
                      <?php foreach($companylist as $company)  { ?>
                      <option value = "<?php echo $company->id ?>"><?php echo $company->company_name ?></option>
                      <?php } ?>
                  </select>
                  &nbsp;&nbsp;
                  <button class = "btn btn-success btn-sm" id="search_btn" onclick="getHoldorCancelPolicyList()"><i class="fa fa-search" aria-hidden="true"></i> Search</button>         
              </div>
          </div>                              
      </div>
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
  
  
  <script>
  
      $(document).ready(function(){
          
          getHoldorCancelPolicyList();
          
      });
  
   function getHoldorCancelPolicyList()
   {
            var month       = $('#month').val();
            var company_id  = $('#company_id').val();
            
           $.ajax({
                     url : "<?=base_url('CompanyfixCtrl/getHoldorCancelPolicyList')?>",
                     method : "POST",
                     data: {
                        month: month, company_id: company_id
                     },
                     beforeSend:function()
                     {
                         $("#table_view").html("<h4 align='center'>Loading....</h4>");
                     },
                     success:function(response)
                     {
                         $("#table_view").html(response);
                     }
           });
    }
    
    function recover_data(id)
    {
        if(confirm("Are you Confirm Recover This Policy "))
        {
        $.ajax({
                     url : "change_policy_status",
                     method : "POST",
                     data : {id:id},
                     success:function(response)
                        {
                           Swal.fire('Policy Recover Successfully!', '', 'success')
                            getHoldorCancelPolicyList();
                        }
                     
           });
    }
    
    }
      
      
      
  </script>