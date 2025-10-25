<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <style>
        label 
        {
            font-weight:unset !important;
        }
         .table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
            padding: 8px;
            line-height: 1.42857143;
            font-weight: unset;
            vertical-align: top;
            border-top: 1px solid #ddd;
        }
                
        .btn {
            border-radius: 8px;
            -webkit-box-shadow: none;
            box-shadow: none;
            border: 1px solid transparent;
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
        
    </style>
    
    <section class="content-header">
      <h1 style="font-size: 17px;">
          
            <div class="row">
                  <div class="col-md-3">
                     <div class="row">
                         <div class="col-md-12">
                               Agent Commission Report
                         </div>
                     </div>
                  </div>
                  
                 <div class="col-md-3">
                      <div class="row">
                         <div class="col-md-6">
                             <label>Select Agents</label>
                         </div>
                         <div class="col-md-6">
                             <div class="form-group">
                               <select class="form-control select2" name="select_agents" id="select_agents"  style="width:100%">
                                   <option value="all" selected>All Agents</option>
                              </select>
                             </div>
                         </div>
                     </div>
                  </div>   

                  <div class="col-md-2">
                     <div class="row">
                         <div class="col-md-4">
                             <label>From</label>
                         </div>
                         <div class="col-md-8">
                            <input type="date" class="form-control" name="f_date" id="f_date" value="<?php echo date("Y-m-01") ?>">
                         </div>
                     </div>
                  </div>
                  
                  <div class="col-md-2">
                     <div class="row">
                         <div class="col-md-4">
                             <label>To</label>
                         </div>
                         <div class="col-md-8">
                            <input type="date" class="form-control" name="to_date" id="to_date" value="<?php echo date("Y-m-d") ?>">
                         </div>
                     </div>
                  </div>
                  
                  <div class="col-md-2">
                     <div class="row">
                         <div class="col-md-12">
                             
                              <?php if($this->session->userdata('session_role') != "user" && $this->session->userdata('session_role') != "AI") { ?>
                            <button class="btn btn-danger" onclick=export_excel()><i class="fa fa-file-pdf-o"></i>&nbsp;Export</button>
                            
                            <?php }
            
            
                       ?>
                         </div>
                     </div>
                  </div>
                  
              </div>
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
  
  
<script>
   
   var policy_arr = [];
   
   var from_date = $("#f_date").val();
   var to_date = $("#to_date").val();
   
    $(document).ready(function(){
         $('.select2').select2();
         
        fetch_agent_commision(from_date,to_date);
        
        load_all_agents_list();
        
        $("#select_agents").change(function(){
            
            if(select_agents != "")
            {
            select_agents = $("#select_agents").val();
            from_date = $("#f_date").val();
            to_date = $("#to_date").val();
            fetch_agent_commision(from_date,to_date,select_agents);
            }
        });
        
        $("#f_date").change(function(){
            select_agents = $("#select_agents").val();
            from_date = $("#f_date").val();
            to_date = $("#to_date").val();
             fetch_agent_commision(from_date,to_date,select_agents);
        });
        
        $("#to_date").change(function(){
            select_agents = $("#select_agents").val();
            from_date = $("#f_date").val();
            to_date = $("#to_date").val();
             fetch_agent_commision(from_date,to_date,select_agents);
        });
    });

    function fetch_agent_commision(from_date,to_date,select_agents)
    {
           $.ajax({
                     url : "fetch_agent_commision_report",
                     method : "POST",
                     data : {from_date:from_date,to_date:to_date,agents:select_agents},
                     success:function(response)
                     {
                         $("#table_view").html(response);
                     }
           });
    }
    
    function export_excel()
    {
        select_agents = $("#select_agents").val();
        from_date = $("#f_date").val();
        to_date = $("#to_date").val();
           $.ajax({
                     url : "fetch_agent_commision_report_excel",
                     method : "POST",
                     data : {from_date:from_date,to_date:to_date,agents:select_agents},
                     success:function(response)
                     {
                         window.location.href=response;
                     }
           });
    }
    
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
                     
                     $("#select_agents").trigger("change");
                 }
        });
    }
</script>  
  