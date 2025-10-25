<!-- Content Wrapper. Contains page content -->
<?php 
	$default_jvlist = '';
	for($i =0; $i<3; $i++):
		$default_jvlist = "<tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>";
	endfor;
	$today = new DateTime();
?>
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
								<form name="jv_frm" id="jv_frm">
									<div class="col-md-6">
											
											<div class="form-row">
													<div class="form-group col-md-6">
															<label >Acc Head</label><span id="add_acchead_error" style="color: red;">*</span>
															<select class = "form-control select2" id="account_head" name="account_head" style='width:100%'>
																	<option value = "">--Select--</option>
																	<?php foreach($account_head as $da){ ?>
																	<option value = "<?php echo $da->vchaccid ?>"><?php echo $da->vchaccname ?></option>
																	<?php } ?>
															</select>
													</div>
													<div class="form-group col-md-6">
														<label >Sub Category</label><span id="add_subcategory_error" style="color: red;">*</span>
														<select class = "form-control select2" name ="sub_category" id="sub_category">
																	<option value = "">--Select Sub Category--</option>
															</select>
													</div>											                           
											</div>
																		
											
											<div class="form-row">
												<div class="form-group col-md-12">
													<span id="amount_error" style="color: red;"></span>
												</div>
											</div>
											<div class="form-row">											
													<div class="form-group col-md-4">
															<label for="inputEmail4">Debit</label>
															<input type="number" class="form-control dr_counter" name="other_contact_details" id="add_debit">
													</div>
													<div class="form-group col-md-4">
														<label for="inputState">Credit</label>
														<input type="number" class="form-control cr_counter" name="other_contact_details" id="add_credit">
													</div>
													<div class="form-group col-md-4">
														<label for="inputZip">TDS</label>
														<input type="text" class="form-control"  id="add_tds">
													</div>                                
											</div>

											<div class="form-row">
													<div class="form-group col-md-4">
															<label for="inputEmail4">Advices</label>
															<br/>
															<!-- <label class="form-check-label" id="debit" >
															<input  type="checkbox" name="inlineRadioOptions"  value="debit" /> 
															Debit</label>&nbsp;
															<label class="form-check-label" id="credit" >
															<input  type="checkbox" name="inlineRadioOptions"  value="credit" /> 
															Credit</label> &nbsp; -->
															<label class="form-check-label" for="printrecepit">
															<input   type="checkbox" name="inlineRadioOptions"  id="printrecepit"  value="printrecepit" />
															Print Recepit</label>
													</div>

													<div class="form-group col-md-4">
														<label for="inputZip">Date</label>
														<input type="text" class="form-control" readonly  id="add_date" value="<?=$today->format('Y-m-d')?>">
													</div>
																											
											</div>

											<div class="form-row">
												<div class="form-group col-md-6">
													<button type="button" class="btn btn-sm btn-primary" id="add_btn">Add</button>
												</div>
											</div>
											
									</div>								
								</form>
								<form name="jv_entries" id="jv_entries" action="add_journalvoucher">
									<div class="col-md-6">
										
											<table class="table">
												<thead>
													<tr>
														<th>#</th>
														<th>Account Head</th>
														<th>Sub Category</th>
														<th>Debit</th>
														<th>Credit</th>
														<th>TDS</th>
														<th></th>
													</tr>
												</thead>
												<tbody id="jvlist">
													
												</tbody>
												<tfoot>
													<tr>
														<th colspan="3"></th>
														<th>Debit : <span id="lbl_dr"></span></th>
														<th>Credit : <span id="lbl_cr"></span></th>
													</tr>
												</tfoot>
											</table>
																					
									</div>
																	
									<div class="col-md-6">
											<div class="form-group col-md-12">
												<label>Remark</label><span id="add_remarks_error" style="color: red;">*</span>
												<textarea rows="3" class="form-control" name="remarks" id="add_remarks"></textarea>
											</div>
									</div>

									<div class="modal-footer">                  
											<button type="submit" class="btn btn-sm btn-primary" id="save_btn">Submit</button>
											<button type="button" class="btn btn-sm btn-secondary" id="add_clr">Cancel</button>
									</div>
								</form>
							</div>
						
         </div>
      </div>
   </section>
   <!-- /.content -->
</div>
<!-- /.content-wrapper -->
        
  <script>
  
		function resetJV() {
			$("#jv_frm")[0].reset();
			$("#account_head").val(null).trigger("change");
			$("#sub_category").val(null).trigger("change");
			$("#amount_error").html("");
			$('#total_dr').val(0) ;
			$('#total_cr').val(0) ;

			$('#lbl_cr').html('') ;
			$('#lbl_cr').html('') ;
		}

		function getSelectedText(ele) {
			var selectedData = $("#"+ele).select2("data");
			var selectedText = selectedData.map(function(option) {
						return option.text;
			}).join(", ");

			return selectedText;
		}

		function Sum(selector) {
			var sum = 0;
            
			// Iterate through each input element with class "input-number"
			$("."+selector).each(function() {
					var value = parseFloat($(this).val()); // Convert value to a number
					if (!isNaN(value)) {
							sum += value;
					}
			});

			return sum;
		}

		function Counter(selector) {
			var count = 0;
			if($("."+selector).length > 0) {				
				$("."+selector).each(function() {
						var value = parseFloat($(this).val()); // Convert value to a number
						if (!isNaN(value)) {
							count += 1;
						}
				});
			}
			return count;
		}

		function showinfo() {
			var drAmt = Sum('dr_amt');
			var crAmt = Sum('cr_amt');
			
			$('#lbl_dr').html(drAmt);
			$('#lbl_cr').html(crAmt);
		}

    $(document).ready(function(){
        
         $('.select2').select2();
        
         $('#add_debit').keyup(function(){
            var credit = $('#add_credit').val();
            if(credit != ""){
              $(this).val('');
            }
         });

         $('#add_credit').keyup(function(){
            var debit = $('#add_debit').val();
            
            if(debit != ""){
              $(this).val('');
            }
         })
        
          $("#account_head").change(function(){
                var account_head = $("#account_head").val();

                 $.ajax({
                            url : "fetch_particulars_by_account_head",
                            method : "POST",
                            data : {account_head:account_head, forms: "JV"},
                            success:function(response)
                            {
                                $("#sub_category").html(response);
                            }
                 });
          });

			$('#add_clr').click(function() {
				$('#jvlist').html('<?=$default_jvlist?>');
				resetJV();
			});

			lineNo = 1;
			var drCnt = []; var crCnt = [];
			$('#add_btn').click(function() {
					var acchead =$("#account_head").val();
					var subcategory =$("#sub_category").val();
					var debit =$("#add_debit").val();
					var credit =$("#add_credit").val();
					var tds =$("#add_tds").val();

					var accheadtxt = getSelectedText('account_head');
					var subcategorytxt = getSelectedText('sub_category');

					$("#add_acchead_error").html("*");
        			$("#add_subcategory_error").html("*");
        
        
        
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
        } else if(debit === "" && credit === ""){
					$("#amount_error").html("Debit or Credit Required");
          error_check = 1;
				}

				var found = false;
            
				$(".subhead").each(function() {
						if ($(this).val() === subcategory) {
								found = true;
								return false; // Exit the loop early
						}
				});

				found = check_duplicate_jv();
				
				if (found) {
						error_check = 1;
						alert("Account Head Already Selected.");
				}
        
				drCnt[0] = Counter('dr_counter');
				crCnt[0] = Counter('cr_counter');
				

				if(drCnt[0] > 0 && crCnt[0] <= 1) {
					//alert("Debitor = " + drCnt[0] + ", "+ crCnt[0]);
				} else if(crCnt > 0 && drCnt <= 1){
					//alert("Creditor = " + drCnt[0] + ", "+ crCnt[0]);
				} else {
					alert("One Debit, Multiple Credits. or One Credit, Multiple Debits entries is Allowed");
					error_check = 1;
				}
				
				var advices = (debit === "") ? "Credit" : "Debit";
				var drAmt = Sum('dr_amt');
				var crAmt = Sum('cr_amt');				
				crAmt = (advices == "Credit") ? parseFloat(crAmt) + parseFloat(credit) : crAmt;
				drAmt = (advices == "Debit") ? parseFloat(drAmt) + parseFloat(debit) : drAmt;
				if( drAmt > 0 && crAmt > 0) {
					if(drAmt != crAmt){						
						if(confirm("Debit & Credit Totals are not Same. Any others entries available to continue otherwise change the " + advices +" amount")) {
							
						} else {
							error_check = 1;
						}						
					}											
				}
                
					if(error_check != 1)
					{
						var tbl = '<tr><td>'+lineNo+'</td>';
								tbl = tbl + '<td><input type="hidden" name="acchead[]" value="'+acchead+'">'+accheadtxt+'</td>';
								tbl = tbl + '<td><input type="hidden" class="subhead" name="subcategory[]" value="'+subcategory+'">'+subcategorytxt+'</td>';
								tbl = tbl + '<td><input type="hidden" class="dr_amt dr_counter" name="debit[]" value="'+debit+'">'+debit+'</td>';
								tbl = tbl + '<td><input type="hidden" class="cr_amt cr_counter" name="credit[]" value="'+credit+'">'+credit+'</td>';
								tbl = tbl + '<td><input type="hidden" name="tdsamount[]" value="'+tds+'"><input type="hidden" name="advices[]" value="'+advices+'">'+tds+'</td>';
								tbl = tbl + '<td><button type="button" class="btnDelete">Remove</button></td></tr>';

						$('#jvlist').append(tbl);
                        resetJV();
						showinfo();


						lineNo++;
						
					}
			});

			$("#jvlist").on('click', '.btnDelete', function () {
					$(this).closest('tr').remove();
					showinfo();
			});

			$('#jv_entries').on('submit', function(e){
				e.preventDefault();
				var drAmt = Sum('dr_amt');
				var crAmt = Sum('cr_amt');

				var found = true;
				
				$(".subhead").each(function() {
					if ($(this).val() === "") {
						found = false;
						return false; // Exit the loop early
					}
				});

				if(!found || $(".subhead").length == 0){
					alert("No Records for Saving")
					return false;
				}
					

				

				var remarks = $("#add_remarks").val();
				var error_check = 0;

				if(remarks === "")
				{
					$("#add_remarks_error").html("* Required");
					error_check = 1;
				}

				

				if(drAmt == crAmt && error_check == 0 && found == true){
					// var formData = new FormData(this);
					var $form = $(e.target);
					// console.log($form.serialize());
				
					$.ajax({
						url: $form.attr('action'),
						type: "POST",
						data: $form.serialize(),
						dataType: "json",
						success: function(response){
								if(response.status == true){
									$("#jv_entries").trigger("reset");
									$('#jvlist').html('<?=$default_jvlist?>');
									$('#lbl_cr').html('') ;
									$('#lbl_dr').html('') ;
									snackbar_show(response.msg);
								}
						}
					});
													
				} else {
					if(drAmt != crAmt)
						alert("Debit & Credit Totals are not Same")

					if(!found)
						alert("No Records for Saving")

					return;
				}
			});
			
      $("#save_btn1").click(function(){
          
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

	function check_duplicate_jv() {
		var subcategory =$("#sub_category").val();
		var date = $("#add_date").val();
		
		var status = null;
		$.ajax({
			url: "check_duplicate_entry_jv",
			type: "POST",
			async: false,
			data: {subaccount: subcategory, date: date},
			dataType: "json",
			success: function(response){
				status = response.status;
			}
		});
		
		return status;
	}
    </script>   

                    
              