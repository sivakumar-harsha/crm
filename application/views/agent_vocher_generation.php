<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <div class="content-wrapper">

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
                               Agent voucher Generation
                         </div>
                     </div>
                  </div>
                </div>  
                  
                <div class="row">

                    <div class="col-md-2">
                <div class="input-group">
                    <div class="input-group-btn">
                            <button type="button" class="btn btn-default">From</button>
                    </div>
                    <input type="date" class="form-control" id="f_date" name="f_date" value="<?php echo date('Y-m-01') ?>">
                </div>
          </div>
                  
                  <div class="col-md-2">
                <div class="input-group">
                    <div class="input-group-btn">
                            <button type="button" class="btn btn-default">To Date</button>
                    </div>
                    <input type="date" class="form-control" id="to_date" name="to_date" value="<?php echo date('Y-m-t') ?>"> 
                </div>
          </div>
                  
                  
                <div class="col-md-3">
                <div class="input-group">
                    <div class="input-group-btn">
                            <button type="button" class="btn btn-default">Select Agents</button>
                    </div>
                        <select class="form-control select2" id="select_agents" name="select_agents">
                            <option value = "">All</option>
                        </select>
                </div>
          </div>
                  
            <input type="hidden" id="select_user" name="select_user" value=""/>
            
            <!--<div class="col-md-3">
                <div class="input-group">
                    <div class="input-group-btn">
                        <button type="button" class="btn btn-default">
                            Users
                        </button>
                    </div>
                    <select class="form-control select2" id="select_user1" name="select_user1">
                        <option value = "">All</option>
                        <?php //if(isset($userslist) && !empty( $userslist) ):?>
                            <?php //foreach($userslist as $user):?>
                                <option value="<?//$user->id?>">
                                    <?//$user->username?>
                                </option>
                            <?php //endforeach;?>
                        <?php //endif;?>
                    </select>
                </div>
            </div>-->

            <div class="col-md-3">
                <div class="input-group">
                    <div class="input-group-btn">
                            <button type="button" class="btn btn-default">Insurance Company</button>
                    </div>
                        <select class="form-control select2" id="select_insurance" name="select_insurance">
                            <option value = "">All</option>
                        </select>
                </div>
          </div>
                  
                  
            <div class="col-md-1">
               <button type="button" class = "btn btn-success btn-sm pull-right" onclick=get_data()><i class="fa fa-search" aria-hidden="true"></i>&nbsp;Search</button>
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
  
  <?php
    $company = "jayantha";
    if($this->session->userdata('session_company_type') == "unicorn"){
        $company = "unicorn";
    }
  ?>
  
<script>
   
   var policy_arr = [];
   var company = '<?=$company?>';
   
    $(document).ready(function(){
        
         $('.select2').select2();
        var from_date =  $("#f_date").val();
        var to_date = $("#to_date").val();
        //fetch_agent_commision(from_date,to_date);
        //load_all_agents_list();
        
        // $("#select_agents").change(function(){
            
        //     if(select_agents != "")
        //     {
        //         var select_agents = $("#select_agents").val();
        //         //fetch_agent_commision(from_date,to_date,select_agents);
        //     }
        // });
        
        /*
        $("#f_date").change(function(){
           var from_date = $("#f_date").val();
           var to_date = $("#to_date").val();
            fetch_agent_poilicy_list(from_date,to_date);
            fetch_all_policy_list(from_date,to_date);
            fetch_agent_policy_insurance_company(from_date,to_date);
        });
        */
        
        $("#to_date").change(function(){
           var from_date = $("#f_date").val();
           var to_date = $("#to_date").val();
            fetch_agent_poilicy_list(from_date,to_date);
            //fetch_all_policy_list(from_date,to_date);
            fetch_agent_policy_insurance_company(from_date,to_date);
        });
        
        
    });

    function fetch_agent_commision(from_date,to_date,select_agents)
    {
           $.ajax({
                     url : "single_agent_policies",
                     method : "POST",
                     data : {from_date:from_date,to_date:to_date,agents:select_agents},
                     success:function(response)
                     {
                         $("#table_view").html(response);
                     }
           });
    }
    
    function fetch_all_policy_list(from_date,to_date)
    {
        var agent = $("#select_agents").val();
        var company = $("#select_insurance").val();
        var user = $("#select_user").val();
        
        $.ajax({
            url : "fetch_all_policy_list",
            method : "POST",
            data : {
                from_date:from_date,to_date:to_date,agent:agent, company: company, user: user
            },
            beforeSend:function(){
                $("#table_view").html("Loading...");  
            },
            success:function(response)
            {
                $("#table_view").html(response);
                $('#policy_list').DataTable({
                    "bPaginate": false,
                    //  "aaSorting": []
                });
            }
        });
    }
    
   function fetch_agent_poilicy_list(from_date,to_date)
   {
       $.ajax({
                  url :"fetch_agent_poilicy_list",
                  method : "POST",
                  data : {from_date:from_date,to_date:to_date},
                  success:function(response)
                  {
                      $("#select_agents").html(response);
                      
                  }
                 
           
           })
   }
   
    function fetch_agent_policy_insurance_company(from_date,to_date)
 {

       $.ajax({
                  url :"fetch_agent_policy_insurance_company",
                  method : "POST",
                  data : {from_date:from_date,to_date:to_date},
                  success:function(response)
                  {
                      $("#select_insurance").html(response);
                      
                  }
           
           })
   }
    
    function select_all()
    {
        if($("#select_all").is(":checked"))
        { 
            $(".check").prop("checked",true);
        }
        else
        {
            $(".check").prop("checked",false);
        }
    }
    
    
    function vocher()
    {
        var policy_arr = [];
        
        var from_date =  $("#f_date").val();
        var to_date = $("#to_date").val();
        
         $(".check").each(function(){
            policy_arr.push($(this).val()); 
            // if($(this).is(":checked"))
            // {
            //     policy_arr.push($(this).val());  
            // }
          }); 
        
            var agent = $("#select_agents").val();
            
            if(policy_arr == null || policy_arr == "")
            {
                snackbar_show("Select the voucher ?");
            }
            else
            {
               $.ajax({
                     url : "generate_vocher",
                     method : "POST",
                     data : {policy_arr:policy_arr,agent:agent, from_date: from_date, to_date: to_date},
                     
                     beforeSend:function(){
                       $("#vocher_gen_btn").attr("disabled",true);  
                     },
                     success:function(response)
                     {
                         var obj = jQuery.parseJSON(response);
                         
                         if(obj)
                         {
                             $("#vocher_gen_btn").attr("disabled",false);
                            
                            if(obj.status == "success")
                            {
                                  $("#select_agents").trigger("change");
                                            Swal.fire(
                                              'Voucher Generated Successfully !',
                                              '',
                                              'success'
                                            )
                                            
                                 window.location.href = 'agent_vouchar_report';
/*                               
                            if( company == "jayantha" ) {
                              window.open("agent_vocher_pdf?policy_arr="+policy_arr+"&agent="+agent+"&vocher_no="+obj["arr"].vocher_no+"&v_date="+obj["arr"].vocher_date,"blank");
                            } else {
                                window.open("agent_vocher_orc_pdf?policy_arr="+policy_arr+"&agent="+agent+"&vocher_no="+obj["arr"].vocher_no+"&v_date="+obj["arr"].vocher_date,"blank");
                            }
                              window.location='general_receipt';  
*/                              
                            }
                            else
                            {
                                  Swal.fire({
                                      icon: 'error',
                                      title: 'Oops...',
                                      text: "Agent Ledger Not Available",
                                      footer: ''
                                    })
                            }
                         }
                         
                     }
                  });
            }
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
    
    
    function get_data()
    {
        var select_agents = $("#select_agents").val();
        var from_date = $("#f_date").val();
        var to_date = $("#to_date").val();
        
        fetch_all_policy_list(from_date,to_date);
        
        //fetch_agent_commision(from_date,to_date,select_agents);
    }
    
</script>  
  