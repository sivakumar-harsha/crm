<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Insurance Invoice Revisied</h3>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="row">
                                <div class="col-md-4">
                                    <label>Insurance Company</label>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <select class="form-control select2" name="company_id" id="company_id"  style="width:100%" onchange="getMonth()">
                                            <?php if( isset( $companylist ) && !empty( $companylist ) ):?>
                                                <?php foreach( $companylist as $company_id => $company_name ):?>
                                                    <option value="<?=$company_id?>"><?=$company_name?></option>
                                                <?php endforeach;?>
                                             <?php endif;?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="row">
                                <div class="col-md-4">
                                    <label>Month</label>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <select class="form-control select2" name="invoice_id" id="invoice_id"  style="width:100%" onchange="getInvRev()">
                                            <option value="">Select </option>
                                            
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                           
                        
                        <div class="col-md-3">
                             <div class="rows">
                                 <div class="col-md-4">
                                     <label>Invoice No</label>
                                 </div>
                                 <div class="col-md-8">
                                    <select class="form-control select2" name="invoice_rev_id" id="invoice_rev_id" style="width:100%">
                                        <option value="">Select</option>
                                        
                                    </select>
                                 </div>
                             </div>
                          </div>
            
                        <div class="col-md-3">
                           <button type="button" class = "btn btn-success btn-sm pull-right" onclick="getInvoiceDetails()"><i class="fa fa-search" aria-hidden="true"></i>&nbsp;Search</button>
                        </div>  
                    </div>
                    
                    <div id="result"></div>
                    
                </div>
            </div>
        </div>
    </div>
    
</div>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
<script type="text/javascript">
    var table;
    $(document).ready(function() {
        //display();
        
        $('.select2').select2();
        
        $(document).on('click', '.confirm-del-btn', function(e){
            e.preventDefault();                
            var id = $(this).val();                
            swal({
				title: "Are you sure you want to delete this record(s)?",
				text: "Delete Confirmation!",                    
                icon: "warning",
                buttons: {
					cancel: true,
					confirm: {
						text: "Yes, Delete it!",
						value: true,
						visible: true,
						className: "",
						closeModal: false
					}           
				},
                dangerMode: true,
            })
            .then((willDelete) => {
            if (willDelete) 
            {
                $.ajax({
                    // url: "PermissionController/delete/"+id,
                    url:"<?=base_url('delete_permission/')?>"+id,
                    dataType: "json",
                    success: function (response) {
                        console.log(response);
                        swal({
                            title: response.status,
                            text: response.status_text,
                            icon: response.status_icon,
                            buttons: "Done",                               
                        })
                        .then((ok) => {
                            if(response.status == true){
                                table.ajax.reload();
                            }
                            
                            snackbar_show(response.msg);
                            
                        });
                    }
                });                    
            } else {
                //swal("Your user role data is safe!");
            }
            });
        });
    });
    
    function display()
    {
        table = $('#results').DataTable( {
           "processing": true,
           "serverSide": true,     
           "order": [],
           "ajax": {
            //   "url": "<?=base_url()?>/PermissionController/getLists",
               "url": "<?=base_url()?>list_permissions",
               "type": "POST",
               "data": function ( d ) {
                   // Pass filter criteria as POST parameters
                    d.search = $('input[type=search]').val();
                    d.privilege_name = $('#privilege_name').val();
                    d.action = "draw_table";
               }
           },
           "columnDefs": [{ 
                "targets": [0],
                "orderable": false
            }]
       } );
    
       $('#search').on( 'keyup', function () {
           table.ajax.reload();
       } );
       
       $('#privilege_name').change(function(){
          table.draw();
        });
    }
    
    
    function getMonth()
    {
        
        $('#invoice_id').find('option').remove();
        var company_id = $('#company_id').val();
        $.ajax({
           url:"<?=base_url('InvoiceController/getinvoicebycompany')?>",
           data: {company_id: company_id},
           dataType: "json",
           success:function(response){
               console.log(response)
               var tag = $('#invoice_id');
               var size = Object.keys(response).length;
               console.log(size);
               tag.append('<option value="">Select</option>')
               if (size > 0){
                   $.each(response, function(ind, data){
                       console.log(ind + ' - ' + data);
                       tag.append('<option value="'+data.id+'">'+data.month+'</option>')
                   });
               }
           },
           error:function(code){
             alert(code.statusText);  
           },
        });
    }
    
    function getInvRev() {
        $('#invoice_rev_id').find('option').remove();
        var invoice_id = $('#invoice_id').val();
        if(invoice_id) {
            $.ajax({
               url:"<?=base_url('InvoiceController/getRevisionbyinv')?>",
               dataType: "json",
               data: {invoice_id: invoice_id},
               success:function(response){
                   var tag = $('#invoice_rev_id');
                   var size = Object.keys(response).length;
                   tag.append('<option value="">Select</option>')
                   if (size > 0){
                       $.each(response, function(ind, data){
                           tag.append('<option value="'+data.id+'">'+data.invno+'/R'+data.revno+'</option>')
                       });
                   }
               },
               error:function(code){
                 alert(code.statusText);  
               },
            });
        }
        
    }
    
    function getInvoiceDetails()
    {
        var invoice_rev_id = $('#invoice_rev_id').val();
        if(invoice_rev_id == '') {
            alert("Select Invoice Number");
            return ;
        }
        $.ajax({
            url:"<?=base_url('InvoiceController/getInvoiceDetails')?>",
            method : "GET",
            data: {invoice_rev_id: invoice_rev_id},
            beforeSend: function(){
                $("#result").html('Loading...');
            },
            success:function(response)
            {
                $("#result").html(response);
            }
        });
    }
    
    function invoice_revisied()
    {
        var invoice_rev_id = $('#invoice_rev_id').val();
        if(invoice_rev_id) {
            var status = confirm("Are you sure Do You want Revisied Invoice?");
            if(status){
                $.ajax({
                    url:"<?=base_url('InvoiceController/invoiceRevisied')?>",
                    dataType: "json",
                    data: {invoice_rev_id: invoice_rev_id},
                    success:function(response){
                        snackbar_show(response.msg);
                    },
                    error:function(code){
                        alert(code.statusText);  
                    },
                });
            }
        }
        
    }
</script>