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
          Insurance Invoice Generation
           </h1>
           
           
          <div class="row">
                  <div class="col-md-3">
                      <div class="row">
                         <div class="col-md-4">
                             <label>Insurance Company</label>
                         </div>
                         <div class="col-md-8">
                             <div class="form-group">
                               <select class="form-control select2" name="select_insurance" id="select_insurance"  style="width:100%">
                              </select>
                             </div>
                         </div>
                     </div>
                  </div>   
                  
                  <div class="col-md-2">
                     <div class="rows">
                         <div class="col-md-4">
                             <label>Generate Type</label>
                         </div>
                         <div class="col-md-4">
                            <select name="policy_gen_from" id="policy_gen_from" >
                                <option value="">Select</option>
                                <option value="policy_s_date">
                                    Policy Start Wise
                                </option>
                                <option value="policy_issue_date">
                                    Policy Issue Wise
                                </option>
                            </select>
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
                  
                  
                  <div class="col-md-2">
                      <div class="row">
                          <div class="col-md-2">
                          <label>Class</label>
                          </div>
                           <div class="col-md-10">
                           <select class="form-control" name="policy_class" id="policy_class">
                                    <option value="">--select--</option>
                                    <?php foreach($class as $da){ ?>
                                      <option value="<?php echo $da->id ?>"><?php echo $da->class ?></option>
                                    <?php } ?>
                                </select>
                            </div>    
                      </div>
                  </div>
                  
                  
        <div class="col-md-1">
           <button type="button" class = "btn btn-success btn-sm pull-right" onclick=get_data()><i class="fa fa-search" aria-hidden="true"></i>&nbsp;Search</button>
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
   
   var policy_arr = [];
   
    $(document).ready(function(){
        
         $('.select2').select2();
        var from_date = "";
        var to_date = "";
        //fetch_insurance_commision(from_date,to_date);
        load_all_insurances_list();
        
        $("#select_insurance").change(function(){
            
            if(select_insurance != "")
            {
                var select_insurance = $("#select_insurance").val();
               // fetch_insurance_commision(from_date,to_date,select_insurance);
            }
        });
        
        $("#policy_gen_from").change(function(){
            
            var type = $(this).val();
            if(type == "") {
                alert("Select Generate Type");
                return ;
            }
            
            if(type == "policy_s_date") {
                $('#lblfrom').html('Start From');
                $('#lblto').html('Start To');
            } else {
                $('#lblfrom').html('Issue From');
                $('#lblto').html('Issue To');
            }
            
        });
        
        $("#f_date").change(function(){
           var select_insurance = $("#select_insurance").val();
           var from_date = $("#f_date").val();
           var to_date = $("#to_date").val();
           // fetch_insurance_commision(from_date,to_date,select_insurance);
        });
        
        $("#to_date").change(function(){
           var select_insurance = $("#select_insurance").val();
           var from_date = $("#f_date").val();
           var to_date = $("#to_date").val();
           // fetch_insurance_commision(from_date,to_date,select_insurance);
        });
    });
    
     
  function get_data()
  {
        var select_insurance = $("#select_insurance").val();
        var from_date = $("#f_date").val();
        var to_date = $("#to_date").val();
        var policy_class = $("#policy_class").val();
        fetch_insurance_commision(from_date,to_date,select_insurance,policy_class);
  }

    function fetch_insurance_commision(from_date,to_date,select_insurance,policy_class)
    {
        var policy_gen_from = $('#policy_gen_from').val();
        if(policy_gen_from == '') {
            alert("Select Generate Type");
            return ;
        }
        
           $.ajax({
                     url : "single_insurance_policies",
                     method : "POST",
                     data : {from_date:from_date,to_date:to_date,insurance:select_insurance,policy_class:policy_class,policy_gen_from:policy_gen_from},
                     beforeSend: function(){
                         $("#table_view").html('Loading...');
                     },
                     success:function(response)
                     {
                         $("#table_view").html(response);
                     }
           });
    }
    
    

    function vocher()
    {
        var select_insurance = $("#select_insurance").val();
        var from_date = $("#f_date").val();
        var to_date = $("#to_date").val();
        var policy_class = $("#policy_class").val();
        
        var policy_arr = [];
    
        

        $(".pt").each(function(ind){
            var key = $(this).attr('data-value');
            policy_arr[key] = $(this).val();
            var object = {}; 
            object[key] = $(this).val();
            policy_arr.push(object);
            // console.log(key + ' = ' + policy_arr[key]);
            
        }); 
        

        console.log(policy_arr);
        console.log(typeof(policy_arr));
        // var custom_police_name = $("input[name='custom_policy_name[]']").map(function(){return $(this).val();}).get();
          
        // alert(custom_police_name);
        // console.log(custom_police_name);
    
        var policy_gen_from = $('#policy_gen_from').val();
        if(policy_gen_from == '') {
            alert("Select Generate Type");
            return ;
        }
               $.ajax({ 
                     url : "save_insurance_policy",
                     method : "POST",
                     data : {from_date:from_date,to_date:to_date,insurance:select_insurance,policy_class:policy_class,policy_arr:policy_arr,policy_gen_from:policy_gen_from},
                     beforeSend:function(){
                       $("#vocher_gen_btn").attr("disabled",true);  
                     },
                     success:function(response)
                     {
                         var obj = jQuery.parseJSON(response);
                         {
                             $("#vocher_gen_btn").attr("disabled",false);
                         
                         voucher_number = obj.arr;    
                            
                            if(obj.status == "success")
                            {
                                  $("#select_insurance").trigger("change");
                                            Swal.fire(
                                              'Voucher Generated Successfully !',
                                              '',
                                              'success'
                                            )
                              window.open("company_vocher_orc_pdf?voucher_no="+voucher_number,"blank");
                              
                            }
                            else
                            {
                                  Swal.fire({
                                      icon: 'error',
                                      title: 'Oops...',
                                      text: "Insurance Ledger Not Available",
                                      footer: ''
                                    })
                            }
                         }
                         
                     }
                  });
            
    }
    
 
    function load_all_insurances_list()
    {
        $.ajax({
                 url : "load_all_insurances_list",
                 method : "POST",
                 success:function(response)
                 {
                     var obj = jQuery.parseJSON(response);
                     
                     for(var i= 0;i<obj.length;i++)
                     {
                         $("#select_insurance").append("<option value='"+obj[i].id+"'>"+obj[i].company_name+"</option>");
                     }
                     
                     $("#select_insurance").trigger("change");
                 }
        });
    }
    
    
</script>  
  