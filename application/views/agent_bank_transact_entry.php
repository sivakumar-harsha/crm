<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>


 <style>
    
        label 
        {
            font-weight:unset !important;
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
    </style>
    
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="row">
            <div class="col-md-3">
                  <h4>
                   Agent Commission Transaction Clearance
                  </h4>
             </div>
             <div class="col-md-3">
             </div>
             <div class="col-md-2">
             </div>
             <div class="col-md-3">
                 
                 <a href="<?=base_url('/datas/bank_agent_commission_amount/bank_agent_commission_amount_sample_excel.xlsx')?>" class="btn btn-primary btn-sm pull-right" >Sample download</a>
                 <span class="pull-right">&nbsp;</span>
                 <button class="btn btn-primary btn-sm pull-right" data-toggle="modal" data-target="#add_model">Upload</button>
                 
             </div>
        </div>
    
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-body">
               <div class="col-md-12">
                    <form name="agn_commission_payment" id="agn_commission_payment" action="<?=base_url('AccountsCtrl/store')?>" method="post" data-parsley-validate="">
                        <div id="table_view"></div> 
                    </form>
               </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  
  
  <div class="modal fade in" id="add_model">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true" style="color:white;">×</span></button>
                <h4 class="modal-title text-center">Agent Commission Transaction Clearance</h4>
            </div>
            <div class="modal-body">
                   
            <div class="form-group">
            <label>Upload Statement</label><span style="color:red;" id="add_statement_error">*</span>
            <input type="file" name="add_bank_statement" id="add_bank_statement" class="form-control" >
          </div>
        </div>
        
           <div class="modal-footer">
              <button type="button" class="btn btn-sm btn-default pull-left" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-sm btn-primary" id="add_btn">Submit</button>
            </div>
        </div>
    </div>
  </div>
  
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/guillaumepotier/Parsley.js@2.9.2/src/parsley.css">
  <script type="text/javascript" src="https://cdn.jsdelivr.net/gh/guillaumepotier/Parsley.js@2.9.2/dist/parsley.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <script>
  
    $(document).ready(function(){

      fetch_bank_agent_commission_statement();
    
     $("#add_btn").click(function(){
         
         
         var bank_statement = $("#add_bank_statement").val();
        
         
          $("#add_statement_error").html("*");
        
          
             var error_check = 0;

        if(bank_statement === "")
        {
          $("#add_statement_error").html("* Required");
          error_check = 1;
        }
    
        
        
         if (error_check != 1)
        {
    
            var files = $("#add_bank_statement").prop('files')[0];
            var formdata = new FormData();
            
            formdata.append("excel_file",files);
            
            
             $.ajax({
            url:"excell_data_file_upload",
            method:"POST",
            data:formdata,
             method:"POST",
             processData:false,  
             contentType:false,
             cache:false,
             dataType:'text',
            beforeSend:function(){
                $("#add_btn").attr("disabled",true);
            },
            success:function(response){
                // alert(response);
                if(response != "")
                {
                 Swal.fire(response+" This Voucher Alread Exit")
                }
                else{
                fetch_bank_agent_commission_statement();
                $("#add_btn").attr("disabled",false);
                alert("Data Uploaded Successfully");
                }
                $("#add_model").modal("hide");
              },
            error: function(code) {   
                alert(code.statusText);
            },
          });
        }
      });
    });
    
    
     function fetch_bank_agent_commission_statement()
    {
            $.ajax({
                     url : "fetch_bank_agent_commission_statement",
                     method : "POST",
                     beforeSend: function(){
                         $("#table_view").html('Loading...')
                     },
                     success:function(response)
                     {
                         $("#table_view").html(response);
                     }
            });
   }
   
   
  function calc()
    {
        var vocher_arr = []; 
        var total = 0;
        $(".check").each(function(){
            if($(this).is(":checked"))
            {
                total = total + parseFloat($(this).attr('data-amt'));
                vocher_arr.push($(this).val());
            }
        }); 
        $("#selected_total").html(total+".00");

        // $.ajax({
        //         url : "get_vocher_bank_commission_amount",
        //         method : "POST",
        //         data : {vocher_arr : vocher_arr},
        //         success:function(response)
        //         {
        //         $("#selected_total").html(response+".00");
        //         }
        //     });

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
        
        var vocher_arr = [];  
        
        $(".check").each(function(){
            if($(this).is(":checked"))
            {
                vocher_arr.push($(this).val());
            }
        }); 
        
        

        
        $.ajax({
                url : "get_vocher_bank_commission_amount",
                method : "POST",
                data : {vocher_arr : vocher_arr},
                success:function(response)
                {
                   $("#selected_total").html(response+".00");
                   
                }
            });
        
    }
    
    $(document).on('click', '#select_all', function(){            
        select_all();
    });

    $(document).ready(function() {
                
        $('#agn_commission_payment').on('submit', function(e){
            e.preventDefault();
            if( $(this).parsley().isValid() ){
                var $form = $(e.target);
                
                $.ajax({
                    url: $form.attr('action'),
                    type: "POST",
                    data: $form.serialize(),
                    dataType: "json",
                    success: function(response){                       
                        if(response.status == true){
                            setTimeout(function() {
                            swal({
                            title: "Success",
                            text: response.msg,
                            icon: "success",
                            Button: "Done"
                            })
                            .then((ok) => {
                            //if(response.redirect_url)
                                //window.location = response.redirect_url
                            });
                        }, 500);
                    } else if(response.status == "false") {
                        swal("Unable to updated objects");
                    }
                    }
                });
            }
        });        
    });
    
    </script>

