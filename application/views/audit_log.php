<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>

<div class="content-wrapper">
      
    <section class="content-header">
      <h1 style=""><b>Audit Log Viewer</b></h1>
          
             <div class="row">
                  <div class="col-md-3">
                      <div class="row">
                         <div class="col-md-4">
                             <label>Table Name</label>
                         </div>
                         <div class="col-md-8">
                             <div class="form-group">
                              <select class="form-control select2" name="select_table_name" id="select_table_name"  style="width:100%">
                                <option value="">--Select--</option>
                                <!--<?php// $action = [];?>-->
                                <?php foreach($tablename as $tn){ ?>
                                
                                <!--action column check in array DISTINCT start-->
                                    <!--<?php// if(!in_array($tn->action, $actions)):?>
                                        <?php// $actions[] = $tn->action;?>
                                    <?php// endif;?>-->
                                <!--action column check in array DISTINCT end-->    
                                
                                <option value="<?php echo $tn->table_name ?>"><?php echo $tn->table_name ?></option>
                                <?php } ?>
                              </select>
                             </div>
                         </div>
                     </div>
                  </div>   
                
                 <div class="col-md-2">
                     <div class="row">
                         <div class="col-md-2">
                             <label id="lblfrom">From</label>
                         </div>
                         <div class="col-md-10">
                            <input type="date" class="form-control" name="f_date" id="f_date" value="<?php echo date("Y-m-01") ?>">
                         </div>
                     </div>
                  </div>
                  
                  <div class="col-md-2">
                     <div class="row">
                         <div class="col-md-2">
                             <label id="lblto">To</label>
                         </div>
                         <div class="col-md-10">
                            <input type="date" class="form-control" name="to_date" id="to_date" value="<?php echo date("Y-m-d") ?>">
                         </div>
                     </div>
                  </div>
                  
                  <div class="col-md-3">
                     <div class="row">
                         <div class="col-md-2">
                             <label>Action</label>
                         </div>
                         <div class="col-md-8">
                         <div class="col-md-10">
                            <select class="form-control" name="table_action" id="table_action">
                                   <option value="">All</option>
                                   <?php if(isset($actions) && !empty($actions)):?>
                                   <?php foreach($actions as $da):?>
                                   <option value="<?php echo $da->action ?>"><?php echo $da->action ?></option>
                                    <?php endforeach;?>
                                    <?php endif;?>
                               </select>
                         </div>
                         </div>
                     </div>
                  </div>
                  
        <div class="col-md-1">
           <button type="button" class = "btn btn-success btn-sm pull-right" onclick=get_data()><i class="fa fa-search" aria-hidden="true"></i>&nbsp;Search</button>
        </div>  
              
             </div>
    </section>
    
    
    <section class="content">
        <!--default box-->
        <div class="box">
            <div calss="box-body">
                <div id="table_view"></div>
            </div>
        </div>
    </section>
    
</div>

<script>
    function get_data()
    {
        var table_name = $("#select_table_name").val();
        var from_date = $("#f_date").val();
        var to_date = $("#to_date").val();
        var table_action = $("#table_action").val();
        
        fetch_audit_log_list(table_name,from_date,to_date,table_action);
    }
    
    function fetch_audit_log_list(table_name,from_date,to_date,table_action)
    {
        var select_table_name = $('#select_table_name').val();
        if(select_table_name == '') {
            Swal.fire(
              'Table Name Not Found',
              'Please select table name',
              'warning'
            );
            return ;
        }
           $.ajax({
                     url : "<?=base_url('LogCtrl/filter_audit_log_list')?>",
                     method : "POST",
                     data : {table_name:table_name,from_date:from_date,to_date:to_date,table_action:table_action,select_table_name:select_table_name},
                     beforeSend: function(){
                         $("#table_view").html("<h4 align='center'>Loading....</h4>");
                     },
                     success:function(response)
                     {
                        $("#table_view").html(response);
                        var oTable = $('#policy_list').dataTable( {
                          "bPaginate": true,
                          "iDisplayLength": 10
                        });

                     }
           });
    }
</script>