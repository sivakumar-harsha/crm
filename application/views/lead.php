<style>
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
		-webkit-transition: border-color ease-in-out 0.15s,
			-webkit-box-shadow ease-in-out 0.15s;
		-o-transition: border-color ease-in-out 0.15s, box-shadow ease-in-out 0.15s;
		transition: border-color ease-in-out 0.15s, box-shadow ease-in-out 0.15s;
	}

	.change_pet_gender {
		background-color: #12b48b !important;
		color: white !important;
	}

	.form-check-input:checked {
		background-color: #0d6efd !important;
		border-color: #0d6efd !important;
	}
	.form-check-input {
		border-color: 1px solid #d3cfc8 !important;
	}

	label {
		display: inline-block;
		max-width: 100%;
		margin-bottom: 5px;
		font-weight: unset;
		font-size: 14px;
	}

	.btn {
		border-radius: 1px;
		-webkit-box-shadow: none;
		box-shadow: none;
		border: 1px solid transparent;
	}
	.save_model {
		margin-right: -70px;
	}
	@media only screen and (max-width: 600px) {
		.save_model {
			margin-right: 0px;
		}
	}
	input[type="checkbox"],
	input[type="radio"] {
		margin: 9px 0px 0;
		margin-top: 1px\9;
		line-height: normal;
	}

	.modal-lg {
		width: 100%;
		height: 100%;
		margin: 0;
		padding: 0;
		z-index: 10000000 !important;
	}

	.no_mar_pad {
		margin-top: 0px;
		margin-bottom: 0px;
		padding-top: 8px !important;
		padding-bottom: 0px !important;
		color: #5b6379 !important;
	}

	.modal-lg-content {
		height: auto;
		width: auto;
		min-height: 100%;
		border-radius: 0;
	}

	@import url("https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap");
	* {
		margin: 0;
		padding: 0;
		box-sizing: border-box;
		font-family: "Poppins", sans-serif;
	}

	.drag-area {
		border: 2px dashed #fff;
		height: 500px;
		width: 700px;
		border-radius: 5px;
		display: flex;
		align-items: center;
		justify-content: center;
		flex-direction: column;
	}
	.drag-area.active {
		border: 2px solid #fff;
	}
	.drag-area .icon {
		font-size: 100px;
		color: #fff;
	}
	.drag-area header {
		font-size: 30px;
		font-weight: 500;
		color: #fff;
	}
	.drag-area span {
		font-size: 25px;
		font-weight: 500;
		color: #fff;
		margin: 10px 0 15px 0;
	}
	.drag-area button {
		padding: 10px 25px;
		font-size: 20px;
		font-weight: 500;
		border: none;
		outline: none;
		background: #fff;
		color: #5256ad;
		border-radius: 5px;
		cursor: pointer;
	}
	.drag-area img {
		height: 100%;
		width: 100%;
		object-fit: cover;
		border-radius: 5px;
	}

	.select2-container--default
		.select2-selection--multiple
		.select2-selection__choice {
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

	.select2-container--default
		.select2-selection--multiple
		.select2-selection__choice__remove {
		color: #fff !important;
		cursor: pointer;
		display: inline-block;
		font-weight: bold;
		margin-right: 2px;
	}

	.form-control[disabled],
	.form-control[readonly],
	fieldset[disabled] .form-control {
		background-color: #fff !important;
		opacity: 1;
	}

	.modal {
		position: fixed;
		top: 0;
		right: 0;
		bottom: 0;
		left: 0;
		z-index: 1050;
		display: none;
		overflow: auto !important;
		-webkit-overflow-scrolling: touch;
		outline: 0;
	}

	.form-check-input {
		width: 2em;
		height: 1.5em;
		background-color: #fff;
		background-repeat: no-repeat;
		border: 1px solid rgba(0, 0, 0, 0.25);
	}
	*,
	::after,
	::before {
		box-sizing: border-box;
	}

	input[type="checkbox"],
	input[type="radio"] {
		margin: 5px 0px 0 !important;
		line-height: normal;
	}

	/*  Property    */

	.change_house_type {
		background-color: #12b48b !important;
		color: white !important;
	}
	.change_owner {
		background-color: #12b48b !important;
		color: white !important;
	}
	.business_change_owner {
		background-color: #12b48b !important;
		color: white !important;
	}

	.img_style {
		height: 50px;
		width: 50px;
	}

	.form-group .row + .row {
		margin-top: 10px; /* or 15px for more space */
	}



	/* Space between each row (every 3 file inputs) */
	#vehiclePhotosModal .row > .col-md-4:nth-child(3n+1) {
		clear: both; /* ensures new row starts cleanly */
	}

	/* Add vertical gap between rows */
	#vehiclePhotosModal .col-md-4 {
		margin-bottom: 25px; /* vertical spacing between rows */
	}

	/* Optional: more aesthetic spacing and font tweaks */
	#vehiclePhotosModal label {
		display: block;
		margin-bottom: 6px;
		font-weight: 500;
	}
	#vehiclePhotosModal input[type="file"] {
		padding: 5px;
		border-radius: 6px;
	}

	/* ====== General Styling ====== */
	#vehiclePhotosModal label {
		display: block;
		margin-bottom: 6px;
		font-weight: 500;
	}

	#vehiclePhotosModal input[type="file"] {
		padding: 6px;
		border-radius: 6px;
		background: #fafafa;
		border: 1px solid #ddd;
		margin-bottom: 8px;
	}

	/* ====== Row & Column Spacing ====== */
	#vehiclePhotosModal .col-md-4 {
		margin-bottom: 25px; /* gap between rows */
	}

	/* Ensures a clean start for every new row (3 per row) */
	#vehiclePhotosModal .row > .col-md-4:nth-child(3n+1) {
		clear: both;
	}

	/* ====== Responsive Layout ====== */

	/* Tablet View (2 per row) */
	@media (max-width: 992px) {
		#vehiclePhotosModal .col-md-4 {
			flex: 0 0 50%;
			max-width: 50%;
		}
		#vehiclePhotosModal .row > .col-md-4:nth-child(2n+1) {
			clear: both;
		}
	}

	/* Mobile View (1 per row) */
	@media (max-width: 576px) {
		#vehiclePhotosModal .col-md-4 {
			flex: 0 0 100%;
			max-width: 100%;
		}
		#vehiclePhotosModal input[type="file"] {
			font-size: 13px;
			padding: 5px;
		}
	}

	/* Optional: Scrollable modal body if too tall */
	#vehiclePhotosModal .modal-body {
		max-height: 75vh;
		overflow-y: auto;
	}

	/* Default input style */
	#vehiclePhotosModal input[type="file"] {
		padding: 6px;
		border-radius: 6px;
		background: #fafafa;
		border: 1px solid #ccc;
		transition: all 0.2s ease;
	}

	/* When a file is uploaded */
	#vehiclePhotosModal input[type="file"].uploaded {
		background-color: #e6ffe6; /* light green */
		border-color: #28a745;
		color: #155724;
		box-shadow: 0 0 5px rgba(40, 167, 69, 0.4);
	}



	/* ===== Edit Vehicle Photos Modal Styles ===== */
	#editVehiclePhotosModal .col-md-4 {
		margin-bottom: 25px;
	}

	#editVehiclePhotosModal label {
		display: block;
		margin-bottom: 6px;
		font-weight: 500;
	}

	#editVehiclePhotosModal input[type="file"] {
		padding: 6px;
		border-radius: 6px;
		background: #fafafa;
		border: 1px solid #ccc;
		transition: all 0.2s ease;
	}

	#editVehiclePhotosModal input[type="file"].uploaded {
		background-color: #e6ffe6;
		border-color: #28a745;
		color: #155724;
		box-shadow: 0 0 5px rgba(40, 167, 69, 0.4);
	}

	/* Scroll if too tall */
	#editVehiclePhotosModal .modal-body {
		max-height: 75vh;
		overflow-y: auto;
	}

	/* Responsive */
	@media (max-width: 992px) {
		#editVehiclePhotosModal .col-md-4 {
			flex: 0 0 50%;
			max-width: 50%;
		}
	}
	@media (max-width: 576px) {
		#editVehiclePhotosModal .col-md-4 {
			flex: 0 0 100%;
			max-width: 100%;
		}
	}

	#editVehiclePhotosModal .col-md-4 {
		margin-bottom: 25px;
	}

	#editVehiclePhotosModal label {
		display: block;
		margin-bottom: 6px;
		font-weight: 500;
	}

	#editVehiclePhotosModal input[type="file"] {
		padding: 6px;
		border-radius: 6px;
		background: #fafafa;
		border: 1px solid #ccc;
		transition: all 0.2s ease;
	}

	#editVehiclePhotosModal input[type="file"].uploaded {
		background-color: #e6ffe6;
		border-color: #28a745;
		color: #155724;
		box-shadow: 0 0 5px rgba(40, 167, 69, 0.4);
	}

	#editVehiclePhotosModal .existing-preview {
		font-size: 13px;
		margin-top: 4px;
	}

	#editVehiclePhotosModal .modal-body {
		max-height: 75vh;
		overflow-y: auto;
	}



</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<link
	href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css"
	rel="stylesheet"
/>
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->

	<section class="content-header">
		<div class="row">
			<div class="col-md-6">
				<h4>Create New Lead</h4>
			</div>
			<div class="col-md-6 pull-right">
				<!--<button class="btn btn-danger btn-sm pull-right"><i class="fa fa-times" aria-hidden="true"></i> Cancel</button>-->
				<!-- <span class="pull-right">&nbsp;</span>-->
				<button class="btn btn-success btn-sm pull-right" id="save_btn">
					<i class="fa fa-save"></i> Save
				</button>
				<span class="pull-right">&nbsp;</span>

				<a href="leads" class="btn btn-warning btn-sm pull-right" id="back_btn"
					><i class="fa fa-backward" aria-hidden="true"></i> Back</a
				>
				<span class="pull-right">&nbsp;</span>

				<!--<button class="btn btn-success btn-sm pull-right hidden" id="update_btn"><i class="fa fa-save"></i> Save</button>-->
				<!--<span class="pull-right">&nbsp;</span>-->
				<button
					class="btn btn-primary btn-sm pull-right hidden"
					id="prospect_btn"
				>
					<i class="fa fa-diamond" aria-hidden="true"></i> Create Prospect
				</button>
				<span class="pull-right">&nbsp;</span>
				<button class="btn btn-warning btn-sm pull-right hidden" id="sms_btn">
					<i class="fa fa-envelope" aria-hidden="true"></i> Sms
				</button>
				<span class="pull-right">&nbsp;</span>

				<?php
                if (isset($_GET["id"])) {
                    $id = $_GET["id"];
                } else {
                    $id = "";
                }

                ?>

				<a
					href="#"
					class="btn btn-info btn-sm pull-right hidden"
					id="policy_btn"
					><i class="fa fa-umbrella" aria-hidden="true"></i> Generate Policy</a
				>

				<span class="pull-right">&nbsp;</span>
			</div>
		</div>
	</section>

	<?php
     $id = "";
                if (isset($_GET["id"])) {
                    $id = $_GET["id"];
                } else {?>
	<script>
		$("#last_inserted_id").val("");
	</script>
	<?php
                }
                ?>

	<input type="hidden" id="last_inserted_id" value="<?php echo $id ?>" />

	<!-- Main content -->
	<section class="content">
		</script>

		<!-- Client Details Start -->

		<div class="box">
			<div class="box-header with-border" style="background: #f4f4f48c">
				<h3 class="box-title" style="text-align: left; font-size: 14px">
					<i class="fa fa-user"></i> &nbsp;&nbsp;Client Details
				</h3>
				<div class="box-tools pull-right">
					<button type="button" class="btn btn-box-tool" data-widget="collapse">
						<i class="fa fa-minus"></i>
					</button>
				</div>
			</div>

			<div class="box-body" style="text-align: left">
				<div class="row">
					<!-- LEFT COLUMN -->
					<div class="col-md-6">
						<!-- CUSTOMER ID (Hidden in Add Mode, Visible in Edit Mode) -->
						<div
							class="form-group"
							id="customer_id_wrapper"
							style="display: none"
						>
							<div class="row">
								<div class="col-md-4">
									<label>Customer ID</label>
								</div>
								<div class="col-md-8">
									<input
										type="text"
										class="form-control"
										id="customer_id_display"
										name="customer_id_display"
										readonly
									/>
								</div>
							</div>
						</div>

						<!-- CLIENT TYPE -->
						<div class="form-group">
							<div class="row">
								<div class="col-md-4">
									<label>Client Type</label><span>*</span>
								</div>
								<div class="col-md-8">
									<select
										class="form-control"
										name="client_type"
										id="client_type"
									>
										<option value="">--Select--</option>
										<?php foreach ($client_type as $da) { ?>
										<option value="<?php echo $da->id ?>">
											<?php echo $da->client_type ?>
										</option>
										<?php } ?>
									</select>
								</div>
							</div>
						</div>

						<!-- SALUTATION -->
						<div class="form-group">
							<div class="row">
								<div class="col-md-4"><label>Salutation</label></div>
								<div class="col-md-8">
									<select
										class="form-control"
										id="salutation"
										name="salutation"
									>
										<option value="">--Select--</option>
										<option value="Mr">Mr</option>
										<option value="Mrs">Mrs</option>
										<option value="Ms">Ms</option>
									</select>
								</div>
							</div>
						</div>

						<!-- CLIENT NAME -->
						<div class="form-group">
							<div class="row">
								<div class="col-md-4">
									<label>Client Name</label><span>*</span>
								</div>
								<div class="col-md-8">
									<input
										type="text"
										class="form-control"
										maxlength="150"
										name="client_name"
										id="client_name"
										oninput="this.value=this.value.replace(/\s+/g,' ').trim();"
									/>
								</div>
							</div>
						</div>

						<!-- INITIAL -->
						<div class="form-group">
							<div class="row">
								<div class="col-md-4"><label>Initial</label></div>
								<div class="col-md-8">
									<input
										type="text"
										class="form-control"
										id="initial"
										name="initial"
									/>
								</div>
							</div>
						</div>

						<!-- FATHER / HUSBAND NAME -->
						<div class="form-group">
							<div class="row">
								<div class="col-md-4"><label>Father / Husband Name</label></div>
								<div class="col-md-8">
									<input
										type="text"
										class="form-control"
										id="father_husband_name"
										name="father_husband_name"
									/>
								</div>
							</div>
						</div>

						<!-- DATE OF BIRTH -->
						<div class="form-group">
							<div class="row">
								<div class="col-md-4"><label>Date of Birth</label></div>
								<div class="col-md-8">
									<input type="date" class="form-control" id="dob" name="dob" />
								</div>
							</div>
						</div>

						<!-- AGE -->
						<div class="form-group">
							<div class="row">
								<div class="col-md-4"><label>Age</label></div>
								<div class="col-md-8">
									<input
										type="text"
										class="form-control"
										id="age"
										name="age"
										placeholder="Auto"
									/>
								</div>
							</div>
						</div>

						<!-- MOBILE NUMBER -->
						<div class="form-group">
							<div class="row">
								<div class="col-md-4">
									<label>Mobile No</label><span>*</span>
								</div>
								<div class="col-md-8">
									<div class="input-group mb-1">
										<div class="input-group-addon">+91</div>
										<input
											type="text"
											class="form-control"
											name="mobile_no"
											id="mobile_no"
											inputmode="numeric"
											pattern="[0-9]{10}"
											maxlength="10"
											oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0,10);"
											onkeydown="return event.keyCode !== 69 && event.keyCode !== 187 && event.keyCode !== 189 && event.keyCode !== 190;"
											placeholder="Enter 10-digit mobile number"
											required
										/>
									</div>
								</div>
							</div>
						</div>

						<!-- EMAIL -->
						<div class="form-group">
							<div class="row">
								<div class="col-md-4"><label>Email ID</label></div>
								<div class="col-md-8">
									<input
										type="email"
										class="form-control"
										name="email_id"
										id="email_id"
										placeholder="example@gmail.com"
									/>
								</div>
							</div>
						</div>

						<!-- ADDITIONAL CUSTOM FIELDS SECTION -->
						<div class="form-group">
							<div class="row">
								<div class="col-md-12">
									<label style="font-weight: bold">Additional Fields</label>
									<div id="custom_fields_container"></div>
									<button
										type="button"
										id="add_custom_field"
										class="btn btn-sm btn-info mt-2"
									>
										<i class="fa fa-plus"></i> Add Custom Field
									</button>
								</div>
							</div>
						</div>
					</div>

					<!-- RIGHT COLUMN -->
					<div class="col-md-6">
						<!-- DOCUMENT SECTION -->
						<div class="form-group" id="document_section">
							<div class="row mt-2 mb-3">
								<div class="col-md-5"><label>Aadhar Card</label></div>
								<div class="col-md-7" id="aadhar_section">
									<input
										type="file"
										class="form-control doc-input"
										id="doc_aadhar"
										name="doc_aadhar"
										accept=".jpg,.jpeg,.png,.pdf"
									/>
									<a
										href="#"
										target="_blank"
										id="view_doc_aadhar"
										class="view-doc text-primary"
										style="display: none"
									>
										<i class="fa fa-eye"></i> View Aadhar
									</a>
								</div>
							</div>

							<div class="row mt-2 mb-3">
								<div class="col-md-5"><label>PAN Card</label></div>
								<div class="col-md-7" id="pan_section">
									<input
										type="file"
										class="form-control doc-input"
										id="doc_pan"
										name="doc_pan"
										accept=".jpg,.jpeg,.png,.pdf"
									/>
									<a
										href="#"
										target="_blank"
										id="view_doc_pan"
										class="view-doc text-primary"
										style="display: none"
									>
										<i class="fa fa-eye"></i> View PAN
									</a>
								</div>
							</div>

							<div class="row mt-2 mb-3">
								<div class="col-md-5"><label>Voter ID</label></div>
								<div class="col-md-7" id="voter_section">
									<input
										type="file"
										class="form-control doc-input"
										id="doc_voter"
										name="doc_voter"
										accept=".jpg,.jpeg,.png,.pdf"
									/>
									<a
										href="#"
										target="_blank"
										id="view_doc_voter"
										class="view-doc text-primary"
										style="display: none"
									>
										<i class="fa fa-eye"></i> View Voter ID
									</a>
								</div>
							</div>

							<div class="row mt-2 mb-3">
								<div class="col-md-5"><label>Driving Licence</label></div>
								<div class="col-md-7" id="dl_section">
									<input
										type="file"
										class="form-control doc-input"
										id="doc_dl"
										name="doc_dl"
										accept=".jpg,.jpeg,.png,.pdf"
									/>
									<a
										href="#"
										target="_blank"
										id="view_doc_dl"
										class="view-doc text-primary"
										style="display: none"
									>
										<i class="fa fa-eye"></i> View Licence
									</a>
								</div>
							</div>

							<div class="row mt-2 mb-3">
								<div class="col-md-5"><label>Government ID</label></div>
								<div class="col-md-7" id="govt_section">
									<input
										type="file"
										class="form-control doc-input"
										id="doc_govt"
										name="doc_govt"
										accept=".jpg,.jpeg,.png,.pdf"
									/>
									<a
										href="#"
										target="_blank"
										id="view_doc_govt"
										class="view-doc text-primary"
										style="display: none"
									>
										<i class="fa fa-eye"></i> View Govt ID
									</a>
								</div>
							</div>

							<small class="text-danger d-block mt-2"
								>At least one file must be uploaded.</small
							>
						</div>

						<!-- COMMUNICATION ADDRESS -->
						<div class="form-group">
							<div class="row">
								<div class="col-md-4"><label>Communication Address</label></div>
								<div class="col-md-8">
									<textarea
										class="form-control"
										name="communication_address"
										id="communication_address"
										rows="3"
									></textarea>
								</div>
							</div>
						</div>

						<!-- PERMANENT ADDRESS -->
						<div class="form-group">
							<div class="row">
								<div class="col-md-4">
									<label>Permanent Address</label>
								</div>
								<div class="col-md-8">
									<textarea
										class="form-control"
										name="permanent_address"
										id="permanent_address"
										rows="3"
									></textarea>
									<div class="checkbox" style="margin-top: 8px">
										<label
											style="
												padding-left: 0;
												display: inline-flex;
												align-items: center;
											"
										>
											<input
												type="checkbox"
												id="same_address"
												style="position: relative; top: 1px; margin-right: 8px"
											/>
											<span>Same as Communication</span>
										</label>
									</div>
								</div>
							</div>
						</div>

						<!-- DISTRICT -->
						<div class="form-group">
							<div class="row">
								<div class="col-md-4"><label>District</label></div>
								<div class="col-md-8">
									<input
										type="text"
										class="form-control"
										id="district"
										name="district"
										placeholder="Enter District"
									/>
								</div>
							</div>
						</div>

						<!-- STATE -->
						<div class="form-group">
							<div class="row">
								<div class="col-md-4"><label>State</label></div>
								<div class="col-md-8">
									<select
										class="form-control select2"
										name="state"
										id="state"
										style="width: 100%;"
									>
										<option value="">--Select--</option>
										<?php foreach ($state as $st) { ?>
											<option value="<?php echo $st->id; ?>">
												<?php echo $st->name; ?>
											</option>
										<?php } ?>
									</select>
								</div>
							</div>
						</div>

						<!-- COUNTRY -->
						<div class="form-group">
							<div class="row">
								<div class="col-md-4"><label>Country</label></div>
								<div class="col-md-8">
									<input
										type="text"
										class="form-control"
										id="country"
										name="country"
										value="India"
									/>
								</div>
							</div>
						</div>

						<!-- PIN CODE -->
						<div class="form-group">
							<div class="row">
								<div class="col-md-4"><label>Pin Code</label></div>
								<div class="col-md-8">
									<input
										type="text"
										class="form-control"
										id="pin_code"
										name="pin_code"
										maxlength="6"
										placeholder="Enter 6-digit Pin Code"
									/>
								</div>
							</div>
						</div>

						<div class="form-group">
							<div class="row">
								<div class="col-md-4"></div>
								<div class="col-md-8">
									<button
										class="btn btn-danger btn-xs pull-right hidden"
										id="edit_client_btn"
									>
										<i class="fa fa-pencil-square-o" aria-hidden="true"></i>
										Edit Client Details
									</button>

									<button
										class="btn btn-success btn-xs pull-right hidden"
										id="update_client_btn"
									>
										<i class="fa fa-save" aria-hidden="true"></i> Update Client
									</button>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- Client Details End -->

		<!-- Requirement Details Start -->

		<div class="box">
			<div class="box-header with-border" style="background: #f4f4f48c">
				<h3
					class="box-title"
					_msthash="26273"
					_msttexthash="60619"
					style="text-align: left; font-size: 14px"
				>
					<i class="fa fa-bars" aria-hidden="true"></i> &nbsp;&nbsp;Requirement
					Details
				</h3>

				<div class="box-tools pull-right">
					<button
						type="button"
						class="btn btn-box-tool"
						data-widget="collapse"
						data-toggle="tooltip"
						title=""
						data-original-title="Collapse"
					>
						<i class="fa fa-minus"></i>
					</button>
				</div>
			</div>

			<div
				class="box-body"
				_msthash="1196936"
				_msttexthash="1190501"
				style="text-align: left"
			>
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<div class="row">
								<div class="col-md-4">
									<label>Bussiness Type</label><span>*</span>
								</div>
								<div class="col-md-8">
									<select
										class="form-control"
										name="bussiness_type"
										id="bussiness_type"
									>
										<option value="">--select--</option>
										<?php foreach ($business as $da) {?>
										<option value="<?php echo $da->id ?>">
											<?php echo $da->bussiness_type ?>
										</option>
										<?php } ?>
									</select>
								</div>
							</div>
						</div>

						<div class="form-group">
							<div class="row">
								<div class="col-md-4"><label>Class</label><span>*</span></div>
								<div class="col-md-8">
									<select
										class="form-control"
										name="policy_class"
										id="policy_class"
									>
										<option value="">--select--</option>
										<?php foreach ($class as $da) { ?>
										<option value="<?php echo $da->id ?>">
											<?php echo $da->class ?>
										</option>
										<?php } ?>
									</select>
								</div>
							</div>
						</div>

						<div class="form-group">
							<div class="row">
								<div class="col-md-4">
									<label>Policy type</label><span>*</span>
								</div>
								<div class="col-md-8">
									<select
										class="form-control"
										name="policy_type"
										id="policy_type"
									>
										<option value="">--select--</option>
									</select>
								</div>
							</div>
						</div>

						<div class="form-group">
							<div class="row">
								<div class="col-md-4">
									<label>Lead Generated Date</label><span>*</span>
								</div>
								<div class="col-md-8">
									<input
										type="date"
										class="form-control"
										name="lead_generated_date"
										id="lead_generated_date"
									/>
								</div>
							</div>
						</div>

						<div class="form-group">
							<div class="row">
								<div class="col-md-4">
									<label>Due Date</label>
								</div>
								<div class="col-md-4">
									<input
										type="date"
										class="form-control"
										name="due_date"
										id="due_date"
									/>
								</div>

								<div class="col-md-4">
									<input
										type="checkbox"
										class="form-check-input"
										name="broken_policy"
										id="broken_policy"
									/>
									<label> Broken Policy</label>
								</div>
							</div>
						</div>

						<div class="form-group">
							<div class="row">
								<div class="col-md-4">
									<label>Location</label>
								</div>
								<div class="col-md-8">
									<input
										type="text"
										class="form-control"
										name="location"
										id="location"
									/>
								</div>
							</div>
						</div>

						<?php if (!isset($_GET["id"])) { ?>

						<div class="form-group">
							<div class="row">
								<div class="col-md-4">
									<label>Upload Old Policy</label>
								</div>
								<div class="col-md-8">
									<input
										type="file"
										class="form-control"
										name="old_policy"
										id="old_policy"
									/>
								</div>
							</div>
						</div>
						<?php } ?>
					</div>

					<div class="col-md-6">
						<div class="form-group">
							<div class="row">
								<div class="col-md-4">
									<label>Classification</label><span>*</span>
								</div>
								<div class="col-md-8">
									<select
										class="form-control"
										name="classification"
										id="classification"
									>
										<option value="">--select--</option>
										<option value="1">Hot</option>
										<option value="2">Warm</option>
										<option value="3">Cold</option>
									</select>
								</div>
							</div>
						</div>

						<div class="form-group">
							<div class="row">
								<div class="col-md-4">
									<label>Source</label>
								</div>
								<div class="col-md-8">
									<select class="form-control" name="source" id="source">
										<option value="">--select--</option>
										<option value="all">All</option>
										<option value="Website">Website</option>
										<option value="Social Media">Social Media</option>
										<option value="Adverdisment">Adverdisment</option>
										<option value="Agents_and_POS">Agents and POS</option>
										<option value="Jayantha Insurance">
											Jayantha Insurance
										</option>
										<option value="Others">Others</option>
									</select>
								</div>
							</div>
						</div>

						<div class="form-group">
							<div class="row">
								<div class="col-md-4">
									<label>Agent / Pos *</label>
								</div>
								<div class="col-md-8">
									<select
										class="form-control select2"
										name="agent_pos"
										id="agent_pos"
									>
										<option value="">--select--</option>
										<?php foreach ($agents_pos as $da) {?>
										<option value="<?php echo $da->id ?>">
											<?php echo $da->name." - ".$da->agent_pos_code."" ?>
										</option>
										<?php } ?>
									</select>
								</div>
							</div>
						</div>

						<input type="hidden" id="session_role" value="<?php echo $this->session->userdata("session_role")
						?>">

						<div class="form-group">
							<div class="row">
								<div class="col-md-4">
									<label>Assign to User *</label>
								</div>
								<div class="col-md-8">
									<select
										class="form-control"
										name="assign_to_user"
										id="assign_to_user"
									>
										<?php
                                                    if ($this->session->userdata("session_role")
										== "admin") { ?>
										<?php foreach ($users as $da) {?>
										<option value="<?php echo $da->id ?>">
											<?php echo $da->username." (".$da->email_id.")" ?>
										</option>
										<?php }
                                        } ?>
									</select>
								</div>
							</div>
						</div>

						<div class="form-group">
							<div class="row">
								<div class="col-md-4">
									<label>Area Incharge *</label>
								</div>
								<div class="col-md-8">
									<select
										class="form-control"
										name="area_incharge"
										id="area_incharge"
									>
										<option value="">--Select--</option>
									</select>
								</div>
							</div>
						</div>

						<div class="form-group">
							<div class="row">
								<div class="col-md-4">
									<label>Remarks</label>
								</div>
								<div class="col-md-8">
									<textarea
										rows="3"
										class="form-control"
										name="remarks"
										id="remarks"
									></textarea>
								</div>
							</div>
						</div>
<!-- 
						<div class="hidden" id="sme_gst_number">
							<div class="form-group">
								<div class="row">
									<div class="col-md-4">
										<label>GST Number </label>
									</div>
									<div class="col-md-8">
										<input
											type="text"
											class="form-control"
											name="gst_number"
											id="gst_number"
										/>
									</div>
								</div>
							</div>
						</div> -->

						<div class="form-group">
							<div class="row">
								<div class="col-md-12">
									<button
										class="btn btn-danger btn-xs pull-right hidden"
										id="edit_req_btn"
									>
										<i class="fa fa-pencil-square-o" aria-hidden="true"></i>
										Edit Requirement Details
									</button>
									<button
										class="btn btn-success btn-xs pull-right hidden"
										id="update_req_btn"
									>
										<i class="fa fa-save" aria-hidden="true"></i> Update
										Requirement Details
									</button>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- Requirement Details End -->

		<!-- Add Follow up Details Start -->

		<div class="box hidden" id="follow_up_hidden">
			<div class="box-header with-border" style="background: #f4f4f48c">
				<h3
					class="box-title"
					_msthash="26273"
					_msttexthash="60619"
					style="text-align: left; font-size: 14px"
				>
					<i class="fa fa-phone" aria-hidden="true"></i> &nbsp;&nbsp;Add Follow
					up Details &nbsp;&nbsp;&nbsp;
				</h3>

				<button
					class="btn btn-xs btn-info"
					data-toggle="modal"
					data-target="#add_model"
				>
					<i class="fa fa-plus" aria-hidden="true"></i> Add Follow Up
				</button>

				<div class="box-tools pull-right">
					<button
						type="button"
						class="btn btn-box-tool"
						data-widget="collapse"
						data-toggle="tooltip"
						title=""
						data-original-title="Collapse"
					>
						<i class="fa fa-minus"></i>
					</button>
				</div>
			</div>

			<div
				class="box-body"
				_msthash="1196936"
				_msttexthash="1190501"
				style="text-align: left"
			>
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<div class="row">
								<div class="col-md-4">
									<label>Next Follow up date</label>
								</div>
								<div class="col-md-8">
									<input
										type="date"
										class="form-control"
										id="next_follow_date"
										name="next_follow_date"
									/>
								</div>
							</div>
						</div>

						<div class="form-group">
							<div class="row">
								<div class="col-md-4">
									<label>Next Follow up Time</label>
								</div>
								<div class="col-md-8">
									<input
										type="time"
										class="form-control"
										id="next_follow_time"
										name="next_follow_time"
									/>
								</div>
							</div>
						</div>

						<div class="form-group">
							<div class="row">
								<div class="col-md-4">
									<label>Last Follow up Date</label>
								</div>
								<div class="col-md-8">
									<input
										type="date"
										class="form-control"
										id="last_follow_date"
										name="last_follow_date"
									/>
								</div>
							</div>
						</div>
					</div>

					<div class="col-md-6">
						<div class="form-group">
							<div class="row">
								<div class="col-md-4">
									<label>Lead Status</label>
								</div>
								<div class="col-md-8">
									<select
										class="form-control"
										name="lead_status"
										id="lead_status"
									>
										<option value="open">Open</option>
										<option value="follow_up">Follow up</option>
									</select>
								</div>
							</div>
						</div>

						<div class="form-group">
							<div class="row">
								<div class="col-md-4">
									<label>Last Status Updated Date</label>
								</div>
								<div class="col-md-8">
									<input
										type="date"
										class="form-control"
										name="last_status_update"
										id="last_status_update"
									/>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- Add Follow up Details End -->

		<!-- Nominee Details Start-->

		<div class="box hidden" id="nominee_div">
			<div class="box-header with-border" style="background: #f4f4f48c">
				<h3
					class="box-title"
					_msthash="26273"
					_msttexthash="60619"
					style="text-align: left; font-size: 14px"
				>
					<i class="fa fa-bars" aria-hidden="true"></i> &nbsp;&nbsp; Nominee
					Details
				</h3>
				<div class="box-tools pull-right">
					<button
						type="button"
						class="btn btn-box-tool"
						data-widget="collapse"
						data-toggle="tooltip"
						title=""
						data-original-title="Collapse"
					>
						<i class="fa fa-minus"></i>
					</button>
				</div>
			</div>
			<div
				class="box-body"
				_msthash="1196936"
				_msttexthash="1190501"
				style="text-align: left"
			>
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<div class="row">
								<div class="col-md-4">
									<label>Nominee Name </label><span>*</span>
								</div>
								<div class="col-md-8">
									<input
										type="text"
										class="form-control"
										name="nominee_name"
										id="nominee_name"
									/>
								</div>
							</div>
						</div>

						<div class="form-group">
							<div class="row">
								<div class="col-md-4">
									<label>Mobile Number</label><span>*</span>
								</div>
								<div class="col-md-8">
									<input
										type="text"
										class="form-control"
										name="n_mobile_no"
										id="n_mobile_no"
									/>
								</div>
							</div>
						</div>
					</div>

					<div class="col-md-6">
						<div class="form-group">
							<div class="row">
								<div class="col-md-4">
									<label>Adharcard Number</label><span>*</span>
								</div>
								<div class="col-md-8">
									<input
										type="text"
										class="form-control"
										name="adharcard_no"
										id="adharcard_no"
									/>
								</div>
							</div>
						</div>

						<div class="form-group" id="n_adhar_file">
							<div class="row">
								<div class="col-md-4">
									<label>Upload Adhar Card</label><span>*</span>
								</div>
								<div class="col-md-8">
									<input
										type="file"
										class="form-control"
										name="n_adhar_card_upload"
										id="n_adhar_card_upload"
									/>
								</div>
							</div>
						</div>

						<div id="nominee_file"></div>

						<div class="form-group">
							<button
								type="button"
								class="btn btn-info btn-xs pull-right"
								id="add_nominee_btn"
							>
								<i class="fa fa-save"></i>&nbsp;Save
							</button>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- Nominee Details End-->

		<!-- Vechicle Details start-->

		<div class="box hidden" id="vechicle_hidden">
			<div class="box-header with-border" style="background: #f4f4f48c">
				<h3
					class="box-title"
					_msthash="26273"
					_msttexthash="60619"
					style="text-align: left; font-size: 14px"
				>
					<i class="fa fa-car" aria-hidden="true"></i> &nbsp;&nbsp; Vechicle
					Details
				</h3>
				<div class="box-tools pull-right">
					<button
						type="button"
						class="btn btn-box-tool"
						data-widget="collapse"
						data-toggle="tooltip"
						title=""
						data-original-title="Collapse"
					>
						<i class="fa fa-minus"></i>
					</button>
				</div>
			</div>
			<div
				class="box-body"
				_msthash="1196936"
				_msttexthash="1190501"
				style="text-align: left"
			>
				<div class="row hidden" id="view_vechi_details">
					<div class="col-md-6">
						<div class="form-group">
							<div class="row">
								<div class="col-md-4">
									<label>Make/Model/Varient</label>
								</div>
								<div class="col-md-8">
									<input
										type="text"
										class="form-control"
										name="view_make_model"
										id="view_make_model"
										readonly
									/>
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="row">
								<div class="col-md-4">
									<label>Engine no</label>
								</div>
								<div class="col-md-8">
									<input
										type="text"
										class="form-control"
										name="view_engine_no"
										id="view_engine_no"
										readonly
									/>
								</div>
							</div>
						</div>
					</div>

					<div class="col-md-6">
						<div class="form-group">
							<div class="row">
								<div class="col-md-4">
									<label>Registration no</label>
								</div>
								<div class="col-md-8">
									<input
										type="text"
										class="form-control"
										name="view_regn_no"
										id="view_regn_no"
										readonly
									/>
								</div>
							</div>
						</div>

						<div class="form-group">
							<div class="row">
								<div class="col-md-4">
									<label>Chassis No</label>
								</div>
								<div class="col-md-8">
									<input
										type="text"
										class="form-control"
										name="view_chassis"
										id="view_chassis"
										readonly
									/>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="form-group">
					<button
						type="button"
						class="btn btn-info btn-xs pull-right hidden"
						id="edit_vechicle_btn"
					>
						<i class="fa fa-pencil" aria-hidden="true"></i> View / Edit Vechicle
					</button>
					<button class="btn btn-info btn-xs pull-right" id="add_vechi_btn">
						<i class="fa fa-plus" aria-hidden="true"></i> New Vechile
					</button>
				</div>
			</div>
		</div>

		<!-- Vechicle Details end -->

		<!-- Sme Details start -->

		<div class="box hidden sme_hidden">
			<div class="box-header with-border" style="background: #f4f4f48c">
				<h3
					class="box-title"
					_msthash="26273"
					_msttexthash="60619"
					style="text-align: left; font-size: 14px"
				>
					<i class="fa fa-building-o" aria-hidden="true"></i> &nbsp;&nbsp; SME
					Details
				</h3>
				<div class="box-tools pull-right">
					<button
						type="button"
						class="btn btn-box-tool"
						data-widget="collapse"
						data-toggle="tooltip"
						title=""
						data-original-title="Collapse"
					>
						<i class="fa fa-minus"></i>
					</button>
				</div>
			</div>
			<div
				class="box-body"
				_msthash="1196936"
				_msttexthash="1190501"
				style="text-align: left"
			>
				<button class="btn btn-info btn-xs pull-right" id="add_sme_btn">
					<i class="fa fa-plus" aria-hidden="true"></i> Add SME Details
				</button>
			</div>
		</div>

		<!-- Sme Details end -->

		<!-- Upload Quatation start -->

		<div class="box hidden sme_hidden">
			<div class="box-header with-border" style="background: #f4f4f48c">
				<h3
					class="box-title"
					_msthash="26273"
					_msttexthash="60619"
					style="text-align: left; font-size: 14px"
				>
					<i class="fa fa-upload" aria-hidden="true"></i> &nbsp;&nbsp; Upload
					Quotations
				</h3>
				<div class="box-tools pull-right">
					<button
						type="button"
						class="btn btn-box-tool"
						data-widget="collapse"
						data-toggle="tooltip"
						title=""
						data-original-title="Collapse"
					>
						<i class="fa fa-minus"></i>
					</button>
				</div>
			</div>
			<div
				class="box-body"
				_msthash="1196936"
				_msttexthash="1190501"
				style="text-align: left"
			>
				<div class="row">
					<div class="col-md-10"></div>
					<div class="col-md-2">
						<button class="btn btn-info btn-xs pull-right" id="sme_file_add">
							<i class="fa fa-plus" aria-hidden="true"></i></button
						>&nbsp;&nbsp;
						<button
							class="btn btn-danger btn-xs pull-right"
							id="sme_file_remove"
						>
							<i class="fa fa-minus" aria-hidden="true"></i></button
						>&nbsp;&nbsp;
					</div>
				</div>

				<form
					action="upload_sme_files"
					method="post"
					enctype="multipart/form-data"
				>
					<input type="hidden" name="lead_id" value="<?php echo $id ?>" />
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>File</label>
								<input
									type="file"
									class="form-control sme_file"
									name="files[]"
									id="files"
									required
								/>
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<label>File Name</label>
								<input
									type="text"
									class="form-control sme_file_type"
									name="file_name[]"
									id="file_name"
									required
								/>
							</div>
						</div>
					</div>
					<div id="view_files"></div>
					<div id="view_quotes"></div>
					<button type="submit" class="btn btn-success btn-sm pull-right">
						<i class="fa fa-save"></i> Upload
					</button>
				</form>
			</div>

			<div class="box hidden" id="health_hidden">
				<div class="box-header with-border" style="background: #f4f4f48c">
					<h3
						class="box-title"
						_msthash="26273"
						_msttexthash="60619"
						style="text-align: left; font-size: 14px"
					>
						<i class="fa fa-medkit" aria-hidden="true"></i> &nbsp;&nbsp;Health
						Details &nbsp;&nbsp;&nbsp;
					</h3>
					<div class="box-tools pull-right">
						<button
							type="button"
							class="btn btn-box-tool"
							data-widget="collapse"
							data-toggle="tooltip"
							title=""
							data-original-title="Collapse"
						>
							<i class="fa fa-minus"></i>
						</button>
					</div>
				</div>
				<div
					class="box-body"
					_msthash="1196936"
					_msttexthash="1190501"
					style="text-align: left"
				>
					<div class="row hidden" id="view_health_div">
						<div class="col-md-6">
							<div class="form-group">
								<div class="row">
									<div class="col-md-4">
										<label>Insurer Name</label>
									</div>
									<div class="col-md-8">
										<input
											type="text"
											class="form-control"
											id="health_insurer_name"
										/>
									</div>
								</div>
							</div>
							<div class="form-group">
								<div class="row">
									<div class="col-md-4">
										<label>Insurer DOB</label>
									</div>
									<div class="col-md-8">
										<input
											type="date"
											class="form-control"
											id="health_insurer_dob"
										/>
									</div>
								</div>
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<div class="row">
									<div class="col-md-4">
										<label>Age</label>
									</div>
									<div class="col-md-8">
										<input
											type="text"
											class="form-control"
											id="health_insurer_age"
										/>
									</div>
								</div>
							</div>

							<div class="form-group">
								<div class="row">
									<div class="col-md-4">
										<label>Gender</label>
									</div>
									<div class="col-md-8">
										<input
											type="text"
											class="form-control"
											id="health_insurer_gender"
										/>
									</div>
								</div>
							</div>
						</div>
					</div>

					<button
						class="btn btn-xs btn-info pull-right"
						data-toggle="modal"
						id="add_health_mod_btn"
						data-target="#add_health_model"
					>
						<i class="fa fa-plus" aria-hidden="true"></i> Add Health Details
					</button>
					<button
						class="btn btn-xs btn-info pull-right hidden"
						id="edit_health_details"
					>
						<i class="fa fa-pencil" aria-hidden="true"></i> Edit Health Details
					</button>
				</div>
			</div>

			<div class="box hidden" id="pet_hidden">
				<div class="box-header with-border" style="background: #f4f4f48c">
					<h3
						class="box-title"
						_msthash="26273"
						_msttexthash="60619"
						style="text-align: left; font-size: 14px"
					>
						<i class="fa fa-paw" aria-hidden="true"></i> &nbsp;&nbsp;Pet Details
						&nbsp;&nbsp;&nbsp;
					</h3>
					<div class="box-tools pull-right">
						<button
							type="button"
							class="btn btn-box-tool"
							data-widget="collapse"
							data-toggle="tooltip"
							title=""
							data-original-title="Collapse"
						>
							<i class="fa fa-minus"></i>
						</button>
					</div>
				</div>

				<div
					class="box-body"
					_msthash="1196936"
					_msttexthash="1190501"
					style="text-align: left"
				>
					<div class="row hidden" id="pet_div">
						<div class="col-md-6">
							<div class="form-group">
								<div class="row">
									<div class="col-md-4">
										<label>PET Name</label>
									</div>
									<div class="col-md-8">
										<input
											type="text"
											class="form-control"
											name="edit_pet_name"
											id="edit_pet_name"
											readonly
										/>
									</div>
								</div>
							</div>
							<div class="form-group">
								<div class="row">
									<div class="col-md-4">
										<label>PET Gender</label>
									</div>
									<div class="col-md-8">
										<select
											class="form-control"
											name="edit_pet_gender"
											id="edit_pet_gender"
										>
											<option value="male">Male</option>
											<option value="female">Female</option>
										</select>
									</div>
								</div>
							</div>
							<div class="form-group">
								<div class="row">
									<div class="col-md-4">
										<label>PET Age In Months</label>
									</div>
									<div class="col-md-8">
										<div class="input-group">
											<input
												type="text"
												class="form-control"
												style="text-align: right"
												id="edit_pet_age"
												readonly
											/>
											<span class="input-group-addon">Months</span>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<div class="row">
									<div class="col-md-4">
										<label>PET Height</label>
									</div>
									<div class="col-md-8">
										<div class="input-group">
											<input
												type="text"
												class="form-control"
												style="text-align: right"
												id="edit_pet_height"
												readonly
											/>
											<span class="input-group-addon">FT</span>
										</div>
									</div>
								</div>
							</div>
							<div class="form-group">
								<div class="row">
									<div class="col-md-4">
										<label>PET Weight</label>
									</div>
									<div class="col-md-8">
										<div class="input-group">
											<input
												type="text"
												class="form-control"
												style="text-align: right"
												id="edit_pet_weight"
												readonly
											/>
											<span class="input-group-addon">KG</span>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>

					<button
						class="btn btn-xs btn-info pull-right"
						id="add_pet_btn"
						data-toggle="modal"
						data-target="#add_pet_modal"
					>
						<i class="fa fa-plus" aria-hidden="true"></i> Add Pet Details
					</button>
					<button
						class="btn btn-xs btn-danger pull-right hidden"
						id="edit_pet_btn"
						data-toggle="modal"
						data-target="#edit_pet_modal"
					>
						<i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit Pet
						Details
					</button>
				</div>
			</div>

			<div class="box hidden" id="property_hidden">
				<div class="box-header with-border" style="background: #f4f4f48c">
					<h3
						class="box-title"
						_msthash="26273"
						_msttexthash="60619"
						style="text-align: left; font-size: 14px"
					>
						<i class="fa fa-home" aria-hidden="true"></i> &nbsp;&nbsp;Property
						Insurace Details &nbsp;&nbsp;&nbsp;
					</h3>
					<div class="box-tools pull-right">
						<button
							type="button"
							class="btn btn-box-tool"
							data-widget="collapse"
							data-toggle="tooltip"
							title=""
							data-original-title="Collapse"
						>
							<i class="fa fa-minus"></i>
						</button>
					</div>
				</div>

				<div
					class="box-body"
					_msthash="1196936"
					_msttexthash="1190501"
					style="text-align: left"
				>
					<div class="row hidden" id="home_pro_div">
						<div class="col-md-6">
							<div class="form-group">
								<div class="row">
									<div class="col-md-4">
										<label>house type</label>
									</div>
									<div class="col-md-8">
										<select
											class="form-control"
											name="housing_type"
											id="housing_type"
										>
											<option value="Home">Home</option>
											<option value="Housing Society">Housing Society</option>
										</select>
									</div>
								</div>
							</div>
							<div class="form-group">
								<div class="row">
									<div class="col-md-4">
										<label>Policy Tenure</label>
									</div>
									<div class="col-md-8">
										<select
											class="form-control"
											name="policy_tensure"
											id="policy_tensure"
										>
											<?php for ($i = 1;$i <= 10;$i++) {?>
											<option value="<?php echo $i ?> Year">
												<?php echo $i ?>
												Year
											</option>
											<?php } ?>
										</select>
									</div>
								</div>
							</div>
							<div class="form-group">
								<div class="row">
									<div class="col-md-4">
										<label>Property Value</label>
									</div>
									<div class="col-md-8">
										<input
											type="text"
											class="form-control"
											name="property_value"
											id="property_value"
										/>
									</div>
								</div>
							</div>
							<div class="form-group">
								<div class="row">
									<div class="col-md-4">
										<label>Interior, Furniture & Lighting</label>
									</div>
									<div class="col-md-8">
										<input
											type="text"
											class="form-control"
											name="interior_furniture"
											id="interior_furniture"
										/>
									</div>
								</div>
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<div class="row">
									<div class="col-md-4">
										<label>Tenant or Owner ?</label>
									</div>
									<div class="col-md-8">
										<select
											class="form-control"
											name="tenant_or_owner"
											id="tenant_or_owner"
										>
											<option value="Owner">Owner</option>
											<option value="Tenant">Tenant</option>
										</select>
									</div>
								</div>
							</div>
							<div class="form-group">
								<div class="row">
									<div class="col-md-4">
										<label>Age of Premises</label>
									</div>
									<div class="col-md-8">
										<select
											class="form-control"
											name="age_of_premises"
											id="age_of_premises"
										>
											<?php for ($i = 1;$i <= 29;$i++) {?>
											<option value="<?php echo $i ?> Year">
												<?php echo $i ?>
												Year
											</option>
											<?php } ?>
										</select>
									</div>
								</div>
							</div>
							<div class="form-group">
								<div class="row">
									<div class="col-md-4">
										<label>Built Up Area</label>
									</div>
									<div class="col-md-8">
										<input
											type="text"
											class="form-control"
											name="built_up_area"
											id="built_up_area"
										/>
									</div>
								</div>
							</div>
							<div class="form-group">
								<div class="row">
									<div class="col-md-4">
										<label>DG set, Air Conditioner & Machinery</label>
									</div>
									<div class="col-md-8">
										<input
											type="text"
											class="form-control"
											name="air_conditionor_amt"
											id="air_conditionor_amt"
										/>
									</div>
								</div>
							</div>
						</div>
					</div>

					<div class="row hidden" id="business_pro_div">
						<div class="col-md-6">
							<div class="form-group">
								<div class="row">
									<div class="col-md-4">
										<label>Tenant or Owner</label>
									</div>
									<div class="col-md-8">
										<select
											class="form-control"
											name="b_tenant_or_owner"
											id="b_tenant_or_owner"
										>
											<option value="Owner">Owner</option>
											<option value="Tenant">Tenant</option>
										</select>
									</div>
								</div>
							</div>

							<div class="form-group">
								<div class="row">
									<div class="col-md-4">
										<label>Your Proffession</label>
									</div>
									<div class="col-md-8">
										<input
											type="text"
											class="form-control"
											name="b_proffession"
											id="b_proffession"
										/>
									</div>
								</div>
							</div>

							<div class="form-group">
								<div class="row">
									<div class="col-md-4">
										<label>Property Value</label>
									</div>
									<div class="col-md-8">
										<input
											type="text"
											class="form-control"
											name="b_property_value"
											id="b_property_value"
										/>
									</div>
								</div>
							</div>

							<div class="form-group">
								<div class="row">
									<div class="col-md-4">
										<label>Interior, Furniture & Lighting</label>
									</div>
									<div class="col-md-8">
										<input
											type="text"
											class="form-control"
											name="b_interior_furniture"
											id="b_interior_furniture"
										/>
									</div>
								</div>
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<div class="row">
									<div class="col-md-4">
										<label>Age of Premises</label>
									</div>
									<div class="col-md-8">
										<select
											class="form-control"
											name="b_age_of_premise"
											id="b_age_of_premise"
										>
											<?php for ($i = 1;$i <= 29;$i++) {?>
											<option value="<?php echo $i ?> Year">
												<?php echo $i ?>
												Year
											</option>
											<?php } ?>
										</select>
									</div>
								</div>
							</div>
							<div class="form-group">
								<div class="row">
									<div class="col-md-4">
										<label>Built Up Area (sqt)</label>
									</div>
									<div class="col-md-8">
										<input
											type="text"
											class="form-control"
											name="b_built_up_area"
											id="b_built_up_area"
										/>
									</div>
								</div>
							</div>
							<div class="form-group">
								<div class="row">
									<div class="col-md-4">
										<label>DG set, Air Conditioner & Machinery</label>
									</div>
									<div class="col-md-8">
										<input
											type="text"
											class="form-control"
											name="b_air_conditionor_amt"
											id="b_air_conditionor_amt"
										/>
									</div>
								</div>
							</div>
						</div>
					</div>

					<button
						class="btn btn-xs btn-info pull-right"
						id="add_prop_btn"
						data-toggle="modal"
						data-target="#homeModal"
					>
						<i class="fa fa-plus" aria-hidden="true"></i> Add Home Insurance
						Details
					</button>
					<button
						class="btn btn-xs btn-info pull-right"
						id="business_prop_btn"
						data-toggle="modal"
						data-target="#businessmodal"
					>
						<i class="fa fa-plus" aria-hidden="true"></i> Add Business Insurance
						Details
					</button>
					<button
						class="btn btn-xs btn-danger pull-right hidden"
						id="edit_home_prop_btn"
					>
						<i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit Home
						Details
					</button>
					<button
						class="btn btn-xs btn-danger pull-right hidden"
						id="edit_business_prop_btn"
					>
						<i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit
						Business Details
					</button>
				</div>
			</div>

			<div class="box hidden" id="maraine_box">
				<div class="box-header with-border" style="background: #f4f4f48c">
					<h3
						class="box-title"
						_msthash="26273"
						_msttexthash="60619"
						style="text-align: left; font-size: 14px"
					>
						<i class="fa fa-ship" aria-hidden="true"></i> &nbsp;&nbsp;Maraine
						Insurance Details &nbsp;&nbsp;&nbsp;
					</h3>
					<div class="box-tools pull-right">
						<button
							type="button"
							class="btn btn-box-tool"
							data-widget="collapse"
							data-toggle="tooltip"
							title=""
							data-original-title="Collapse"
						>
							<i class="fa fa-minus"></i>
						</button>
					</div>
				</div>
				<div
					class="box-body"
					_msthash="1196936"
					_msttexthash="1190501"
					style="text-align: left"
				>
					<div class="row hidden" id="maraine_div">
						<div class="col-md-6">
							<div class="form-group">
								<label>Type of Single Transit Policy</label>
								<select
									class="form-control"
									name="m_transit_policy"
									id="m_transit_policy"
								>
									<option value="">--select--</option>
									<option value="Inland">Inland</option>
									<option value="Import">Import</option>
									<option value="Export">Export</option>
								</select>
							</div>

							<div class="form-group">
								<label>Mode of Transport</label>
								<select class="form-control" id="m_marine_transport">
									<option>Air</option>
									<option>Road</option>
									<option>Rail</option>
									<option>Courier</option>
								</select>
							</div>

							<div class="form-group">
								<label>Commodity</label>
								<select class="form-control" id="m_marine_cummodity">
									<option value="">Select Commodity</option>
									<option value="1">Auto and spares</option>
									<option value="2">Chemicals</option>
								</select>
							</div>

							<div class="form-group">
								<label>Invoice Value (In Rupees)</label>
								<div class="input-group">
									<span class="input-group-addon">₹</span>
									<input
										type="number"
										onclick="marine_calculate()"
										class="form-control"
										id="m_marine_invoice_val"
									/>
								</div>
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<label>Company Name</label>
								<input
									type="text"
									class="form-control"
									id="m_marine_company_name"
								/>
							</div>

							<div class="form-group">
								<label>City</label>
								<input
									type="text"
									class="form-control"
									id="m_marine_city_name"
								/>
							</div>

							<div class="form-group">
								<label>Sub Commodity</label>
								<select
									class="form-control"
									id="m_marine_sub_cummodity"
								></select>
							</div>

							<div class="form-group">
								<label
									>Sum Insured (in rupees)
									<span style="color: red"> * Invoice amount +10% </span></label
								>
								<div class="input-group" bis_skin_checked="1">
									<span class="input-group-addon">₹</span>
									<input
										type="number"
										class="form-control"
										id="m_marine_invoice_10per_val"
									/>
								</div>
							</div>
						</div>
					</div>

					<button
						class="btn btn-xs btn-info pull-right"
						id="add_maraine_btn"
						data-toggle="modal"
						data-target="#marainemodal"
					>
						<i class="fa fa-plus" aria-hidden="true"></i> Add Maraine Details
					</button>
					<button
						class="btn btn-xs btn-danger pull-right hidden"
						id="edit_maraine_btn"
					>
						<i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit
						Maraine Details
					</button>
				</div>
			</div>

			<div class="box hidden" id="quotation_box_hidden">
				<div class="box-header with-border" style="background: #f4f4f48c">
					<h3
						class="box-title"
						_msthash="26273"
						_msttexthash="60619"
						style="text-align: left; font-size: 14px"
					>
						<i class="fa fa-file" aria-hidden="true"></i> &nbsp;&nbsp; Quotation
						Details
					</h3>
					<div class="box-tools pull-right">
						<button
							type="button"
							class="btn btn-box-tool"
							data-widget="collapse"
							data-toggle="tooltip"
							title=""
							data-original-title="Collapse"
						>
							<i class="fa fa-minus"></i>
						</button>
					</div>
				</div>
				<div
					class="box-body"
					_msthash="1196936"
					_msttexthash="1190501"
					style="text-align: left"
				>
					<div class="table table-responsive">
						<table class="table table-bordered" width="100%">
							<thead>
								<tr>
									<th>
										<input
											type="checkbox"
											class="form-check-input"
											id="select_all_quote"
										/>
									</th>
									<th>Insurer</th>
									<th>Total Premium</th>
									<th>Issued Date</th>
									<th>Issued User</th>
									<th>Generate Quote</th>
									<th>Email Quote</th>
									<th>Sms Quote</th>
								</tr>
							</thead>
							<tbody id="quotes_view"></tbody>
						</table>
					</div>

					<div class="form-group">
						<button
							class="btn btn-info btn-xs pull-right hidden"
							id="edit_vechicle_btn"
							data-dismiss="modal"
							data-toggle="modal"
							href="#lost"
						>
							<i class="fa fa-pencil" aria-hidden="true"></i> View / Edit
							Vechicle
						</button>
						<button class="btn btn-info btn-xs pull-right" id="add_quote_btn">
							<i class="fa fa-plus" aria-hidden="true"></i>&nbsp;&nbsp;Add
						</button>
					</div>
				</div>
			</div>

			<div class="box">
				<div class="box-header with-border" style="background: #f4f4f48c">
					<h3
						class="box-title"
						_msthash="26273"
						_msttexthash="60619"
						style="text-align: left; font-size: 14px"
					>
						<i class="fa fa-bars" aria-hidden="true"></i> &nbsp;&nbsp; Recent
						Activities
					</h3>
					<div class="box-tools pull-right">
						<button
							type="button"
							class="btn btn-box-tool"
							data-widget="collapse"
							data-toggle="tooltip"
							title=""
							data-original-title="Collapse"
						>
							<i class="fa fa-minus"></i>
						</button>
					</div>
				</div>
				<div
					class="box-body"
					_msthash="1196936"
					_msttexthash="1190501"
					style="text-align: left"
				>
					<div>
						<div class="table table-responsive">
							<table class="table table-striped">
								<tbody>
									<div id="recent_activity_div"></div>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- Upload Quatation end -->

		<!-- Add Follow Up start-->

		<div class="modal fade in" id="add_model">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header bg-primary">
						<button
							type="button"
							class="close"
							data-dismiss="modal"
							aria-label="Close"
						>
							<span aria-hidden="true" style="color: white">×</span>
						</button>
						<h4 class="modal-title text-center" style="color: white">
							Add Follow Up
						</h4>
					</div>
					<div class="modal-body">
						<div class="form-group">
							<label>Follow up-Concluded</label>
							<span id="add_name_error" style="color: red">*</span>
							<select
								class="form-control"
								name="follow_up_concluded"
								id="follow_up_concluded"
							>
								<option value="">--Select--</option>
								<option value="1">Yes</option>
								<option value="0">No</option>
							</select>
						</div>

						<div class="form-group">
							<label>Reason</label>
							<span id="add_name_error" style="color: red">*</span>
							<select
								class="form-control"
								name="follow_up_reason"
								id="follow_up_reason"
							>
								<option value="">--Select--</option>
								<option value="Call not answered">Call not answered</option>
								<option value="Invalid Phone number">
									Invalid Phone number
								</option>
								<option value="New Follow up">New Follow up</option>
								<option value="Phone Unreachable">Phone Unreachable</option>
								<option value="Rescheduled">Rescheduled</option>
							</select>
						</div>

						<div class="form-group">
							<label>Next Follow up date</label>
							<span id="add_name_error" style="color: red">*</span>
							<input
								type="Date"
								class="form-control"
								name="enter_next_follow_date"
								id="enter_next_follow_date"
							/>
						</div>

						<div class="form-group">
							<label>Next Follow up Time</label>
							<span id="add_name_error" style="color: red">*</span>
							<input
								type="time"
								class="form-control"
								name="enter_next_follow_time"
								id="enter_next_follow_time"
							/>
						</div>

						<div class="form-group">
							<label>Comment</label>
							<span id="add_name_error" style="color: red"></span>
							<textarea
								class="form-control"
								name="follow_comment"
								id="follow_comment"
							></textarea>
						</div>
					</div>
					<div class="modal-footer">
						<button
							type="button"
							class="btn btn-sm btn-primary"
							id="add_follow_up_btn"
						>
							Submit
						</button>
						<button
							type="button"
							class="btn btn-sm btn-default"
							data-dismiss="modal"
						>
							Close
						</button>
					</div>
				</div>
			</div>
		</div>

		<!-- Add Follow Up end -->

		<div id="add_vechile_model" class="modal fade" role="dialog">
			<div class="modal-dialog modal-lg">
				<!-- Modal content-->
				<div class="modal-content modal-lg-content">
					<div class="modal-header" style="background: #778d9d">
						<button
							type="button"
							class="close"
							data-dismiss="modal"
							style="color: #fff"
						>
							&times;
						</button>

						<div class="row">
							<div class="col-md-6">
								<h4 class="modal-title" style="color: #fff">
									<i
										class="fa fa-car"
										style="color: #fff"
										aria-hidden="true"
									></i>
									Create New Vechile
								</h4>
							</div>
							<div class="col-md-5">
								<button
									class="btn btn-success btn-sm pull-right save_model"
									id="add_vechile_btn"
								>
									<i class="fa fa-save" aria-hidden="true"></i> Save
								</button>
							</div>
						</div>
					</div>

					<!-- Create New Vechile Start-->

					<div class="modal-body">
						<!-- ========================= GENERAL DETAILS ========================= -->
						<div class="box">
							<div class="box-header with-border" style="background: #f4f4f48c">
								<h3 class="box-title" style="text-align: left; font-size: 14px">
									<i class="fa fa-bars" aria-hidden="true"></i> &nbsp;&nbsp;
									General Details
								</h3>
								<div class="box-tools pull-right">
									<button
										type="button"
										class="btn btn-box-tool"
										data-widget="collapse"
										title="Collapse"
									>
										<i class="fa fa-minus"></i>
									</button>
								</div>
							</div>

							<div class="box-body">
								<div class="row">
									<!-- LEFT COLUMN -->
									<div class="col-md-6">
										<!-- Vehicle Type -->
										<div class="form-group">
											<div class="row">
												<div class="col-md-4">
													<label>Vehicle Type</label><span>*</span>
												</div>
												<div class="col-md-8">
													<select
														class="form-control"
														name="vechile_type"
														id="vechile_type"
														disabled
													>
														<option value="">--Select--</option>
														<?php foreach ($policy_type as $da) { ?>
														<option value="<?php echo $da->id ?>">
															<?php echo $da->policy_type ?>
														</option>
														<?php } ?>
													</select>
												</div>
											</div>
										</div>

										<!-- Make -->
										<div class="form-group">
											<div class="row">
												<div class="col-md-4">
													<label>Make</label><span>*</span>
												</div>
												<div class="col-md-8">
													<select
														class="form-control select2"
														name="vechi_make"
														id="vechi_make"
														style="width: 100%"
													>
														<option value="">--Select--</option>
													</select>
												</div>
											</div>
										</div>

										<!-- Model -->
										<div class="form-group">
											<div class="row">
												<div class="col-md-4">
													<label>Model</label><span>*</span>
												</div>
												<div class="col-md-8">
													<select
														class="form-control select2"
														name="vechi_model"
														id="vechi_model"
														style="width: 100%"
													>
														<option value="">--Select--</option>
													</select>
												</div>
											</div>
										</div>

										<!-- Variant -->
										<div class="form-group">
											<div class="row">
												<div class="col-md-4"><label>Variant</label></div>
												<div class="col-md-8">
													<select
														class="form-control select2"
														name="vechi_varient"
														id="vechi_varient"
														style="width: 100%"
													>
														<option value="">--Select--</option>
													</select>
												</div>
											</div>
										</div>

										<!-- CC -->
										<div class="form-group">
											<div class="row">
												<div class="col-md-4"><label>CC</label></div>
												<div class="col-md-8">
													<input
														type="number"
														class="form-control"
														name="vechi_cc"
														id="vechi_cc"
														inputmode="numeric"
														min="0"
														oninput="this.value = this.value.replace(/[^0-9]/g, '');"
														onkeydown="return event.keyCode !== 69 && event.keyCode !== 187 && event.keyCode !== 189 && event.keyCode !== 190;"
														placeholder="Enter CC (e.g. 100)"
														required
													/>
												</div>
											</div>
										</div>

										<!-- Year of Manufacture -->
										<div class="form-group">
											<div class="row">
												<div class="col-md-4">
													<label>Year Of Manufacture</label>
												</div>
												<div class="col-md-4">
													<select
														class="form-control"
														name="vechi_manu_month"
														id="vechi_manu_month"
													>
														<option value="">--Select--</option>
														<option value="01">Jan</option>
														<option value="02">Feb</option>
														<option value="03">Mar</option>
														<option value="04">Apr</option>
														<option value="05">May</option>
														<option value="06">Jun</option>
														<option value="07">Jul</option>
														<option value="08">Aug</option>
														<option value="09">Sep</option>
														<option value="10">Oct</option>
														<option value="11">Nov</option>
														<option value="12">Dec</option>
													</select>
												</div>
												<div class="col-md-4">
													<select
														class="form-control select2"
														id="vechi_manu_year"
														name="vechi_manu_year"
														style="width: 100%"
													>
														<option value="">--Select--</option>
														<?php for ($i = 1900; $i <= 3050; $i++) { ?>
														<option value="<?php echo $i ?>">
															<?php echo $i ?>
														</option>
														<?php } ?>
													</select>
												</div>
											</div>
										</div>

										<!-- Seating Capacity -->
										<div class="form-group">
											<div class="row">
												<div class="col-md-4">
													<label>Seating Capacity</label>
												</div>
												<div class="col-md-8">
													<input
														type="text"
														class="form-control"
														name="vechi_seating"
														id="vechi_seating"
													/>
												</div>
											</div>
										</div>

										<!-- Vehicle Classification -->
										<div class="form-group">
											<div class="row">
												<div class="col-md-4">
													<label>Vehicle Classification</label>
												</div>
												<div class="col-md-8">
													<select
														class="form-control"
														name="vechi_classfication"
														id="vechi_classfication"
													>
														<option value="">--Select--</option>
														<option value="small">Small</option>
														<option value="Hatchback">Hatchback</option>
														<option value="Midsize">Midsize</option>
														<option value="High End">High End</option>
														<option value="MPV/SUV">MPV/SUV</option>
														<option value="Commercial">Commercial</option>
													</select>
												</div>
											</div>
										</div>
									</div>

									<!-- RIGHT COLUMN -->
									<div class="col-md-6">
										<!-- Fuel Type -->
										<div class="form-group">
											<div class="row">
												<div class="col-md-4"><label>Fuel Type</label></div>
												<div class="col-md-8">
													<select
														class="form-control"
														name="vechi_fuel_type"
														id="vechi_fuel_type"
													>
														<option value="">--Select--</option>
														<?php foreach ($fuel_type as $da) {
                            								if ($da->id != "4") { ?>
														<option value="<?php echo $da->id ?>">
															<?php echo $da->fuel_type; ?>
														</option>
														<?php }
														} ?>
													</select>
												</div>
											</div>
										</div>

										<!-- GVW -->
										<div class="form-group">
											<div class="row">
												<div class="col-md-4"><label>GVW</label></div>
												<div class="col-md-8">
													<input
														type="text"
														class="form-control"
														name="vechi_gvw"
														id="vechi_gvw"
													/>
												</div>
											</div>
										</div>

										<!-- Passenger Carrying -->
										<div class="form-group">
											<div class="row">
												<div class="col-md-4">
													<label>Passenger Carrying</label>
												</div>
												<div class="col-md-8">
													<select
														class="form-control"
														name="passenger_carrying"
														id="passenger_carrying"
													></select>
												</div>
											</div>
										</div>

										<!-- Engine Number -->
										<div class="form-group">
											<div class="row">
												<div class="col-md-4">
													<label>Engine Number</label><span>*</span>
												</div>
												<div class="col-md-8">
													<input
														type="text"
														class="form-control"
														name="vechi_engine_num"
														id="vechi_engine_num"
													/>
												</div>
											</div>
										</div>

										<!-- Chassis Number -->
										<div class="form-group">
											<div class="row">
												<div class="col-md-4">
													<label>Chassis Number</label><span>*</span>
												</div>
												<div class="col-md-8">
													<input
														type="text"
														class="form-control"
														name="vechi_chassis_num"
														id="vechi_chassis_num"
													/>
												</div>
											</div>
										</div>

										<!-- Hypothecation -->
										<div class="form-group">
											<div class="row">
												<div class="col-md-4"><label>Hypothecation</label></div>
												<div class="col-md-8">
													<select name="vechi_hypothecation" id="vechi_hypothecation" class="form-control">
														<option value="">--Select--</option>
														<option value="Haier Purchase">Haier Purchase</option>
														<option value="Leese agriment">Leese agriment</option>
													</select>
												</div>
											</div>
										</div>

										<!-- Created User -->
										<div class="form-group">
											<div class="row">
												<div class="col-md-4"><label>Created User</label></div>
												<div class="col-md-8">
													<select
														class="form-control"
														name="created_user"
														id="created_user"
													>
														<option
															value="<?php echo $this->session->userdata('session_id'); ?>"
														>
															<?php echo $this->session->userdata('session_name');
															?>
														</option>
													</select>
												</div>
											</div>
										</div>

										<!-- Remarks -->
										<div class="form-group">
											<div class="row">
												<div class="col-md-4"><label>Remarks</label></div>
												<div class="col-md-8">
													<textarea
														class="form-control"
														name="vechi_remarks"
														id="vechi_remarks"
													></textarea>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!-- ========================= END GENERAL DETAILS ========================= -->

						<!-- ========================= REGISTRATION DETAILS ========================= -->
						<div class="box">
							<div class="box-header with-border" style="background: #f4f4f48c">
								<h3 class="box-title" style="text-align: left; font-size: 14px">
									<i class="fa fa-bars" aria-hidden="true"></i> &nbsp;&nbsp;
									Registration Details
								</h3>
								<div class="box-tools pull-right">
									<button
										type="button"
										class="btn btn-box-tool"
										data-widget="collapse"
										title="Collapse"
									>
										<i class="fa fa-minus"></i>
									</button>
								</div>
							</div>

							<div class="box-body" style="text-align: left">
								<div class="row">
									<!-- LEFT COLUMN -->
									<div class="col-md-6">
										<!-- Regn No -->
										<div class="form-group">
											<div class="row">
												<div class="col-md-4">
													<label>Regn No</label><span>*</span>
												</div>
												<div class="col-md-2">
													<input
														type="text"
														class="form-control"
														name="regn_no_1"
														id="regn_no_1"
														maxlength="2"
													/>
												</div>
												<div class="col-md-2">
													<input
														type="text"
														class="form-control"
														name="regn_no_2"
														id="regn_no_2"
														maxlength="2"
													/>
												</div>
												<div class="col-md-2">
													<input
														type="text"
														class="form-control"
														name="regn_no_3"
														id="regn_no_3"
														maxlength="2"
													/>
												</div>
												<div class="col-md-2">
													<input
														type="text"
														class="form-control"
														name="regn_no_4"
														id="regn_no_4"
														maxlength="4"
													/>
												</div>
											</div>
										</div>

										<!-- Regn Date -->
										<div class="form-group">
											<div class="row">
												<div class="col-md-4"><label>Regn Date</label></div>
												<div class="col-md-8">
													<input
														type="date"
														class="form-control"
														name="regn_date"
														id="regn_date"
													/>
												</div>
											</div>
										</div>

										<!-- Registration Certificate Upload -->
										<div class="form-group">
											<div class="row">
												<div class="col-md-4">
													<label>Registration Certificate</label>
												</div>
												<div class="col-md-8">
													<input
														type="file"
														class="form-control"
														id="regn_certificate"
														name="regn_certificate"
														accept="image/*,application/pdf"
													/>
													<!-- Preview area -->
													<img
														id="rc_preview"
														src=""
														alt="RC Preview"
														style="
															display: none;
															margin-top: 5px;
															max-width: 120px;
															border: 1px solid #ccc;
															border-radius: 4px;
														"
													/>
													<a
														id="rc_pdf_link"
														href="#"
														target="_blank"
														style="display: none; margin-top: 5px"
													>
														View Uploaded PDF
													</a>
												</div>
											</div>
										</div>

										<!-- RTO -->
										<div class="form-group">
											<div class="row">
												<div class="col-md-4"><label>RTO</label></div>
												<div class="col-md-8">
													<select
														class="form-control select2"
														name="rto"
														id="rto"
														style="width: 100%"
													>
														<option value="">--Select--</option>
														<?php foreach ($rto as $da) {
                                                           if (!in_array($da->id, ["1","2","3","4","5","6"])) {
														?>
														<option value="<?php echo $da->rto_no; ?>">
															<?php echo $da->rto_no." ( ".$da->city." )"; ?>
														</option>
														<?php }
                            } ?>
													</select>
												</div>
											</div>
										</div>

										<!-- Zone -->
										<div class="form-group">
											<div class="row">
												<div class="col-md-4"><label>Zone</label></div>
												<div class="col-md-8">
													<input
														type="text"
														class="form-control"
														name="zone"
														id="zone"
													/>
												</div>
											</div>
										</div>

										<!-- Additional Fields -->
										<div class="form-group">
										<div class="row">
											<div class="col-md-12">
											<label>Additional Fields</label>
											<button
												type="button"
												id="add_additional_field"
												class="btn btn-sm btn-info"
												style="margin-left: 10px"
											>
												<i class="fa fa-plus"></i> Add Field
											</button>
											</div>
										</div>

										<div id="additional_fields_container" style="margin-top: 10px"></div>
										</div>

									</div>

									<!-- RIGHT COLUMN -->
									<div class="col-md-6">
										<!-- Regn Address -->
										<div class="form-group">
											<div class="row">
												<div class="col-md-4">
													<label>Registration Address</label>
												</div>
												<div class="col-md-8">
													<textarea
														class="form-control"
														name="regn_address"
														id="regn_address"
														rows="3"
														placeholder="Enter registration address"
													></textarea>

													<!-- Copy Address Checkboxes -->
													<div style="margin-top: 8px">
														<div class="checkbox" style="margin-bottom: 5px">
															<label style="padding-left: 0; display: inline-flex; align-items: center;">
																<input
																	type="checkbox"
																	id="copy_client_comm_address"
																	style="position: relative; top: 1px; margin-right: 8px"
																/>
																<span>Same as Client Communication Address</span>
															</label>
														</div>

														<div class="checkbox">
															<label style="padding-left: 0; display: inline-flex; align-items: center;">
																<input
																	type="checkbox"
																	id="copy_client_perm_address"
																	style="position: relative; top: 1px; margin-right: 8px"
																/>
																<span>Same as Client Permanent Address</span>
															</label>
														</div>
													</div>
												</div>
											</div>
										</div>

										<!-- REGN STATE -->
										<div class="form-group">
											<div class="row">
												<div class="col-md-4"><label>State</label></div>
												<div class="col-md-8">
													<!-- hidden state name -->
													<input type="hidden" id="regn_state_name" name="regn_state_name" />

													<select class="form-control select2" name="regn_state" id="regn_state" style="width: 100%">
														<option value="">--Select--</option>
														<?php foreach ($state as $s) { ?>
															<option value="<?php echo $s->id; ?>">
																<?php echo $s->name; ?>
															</option>
														<?php } ?>
													</select>
												</div>
											</div>
										</div>

										<!-- City -->
										<div class="form-group">
											<div class="row">
												<div class="col-md-4"><label>City</label></div>
												<div class="col-md-8">
													<input
														type="text"
														class="form-control"
														name="regn_city"
														id="regn_city"
														placeholder="Enter City"
													/>
												</div>
											</div>
										</div>

										<!-- COUNTRY -->
										<div class="form-group">
											<div class="row">
												<div class="col-md-4"><label>Country</label></div>
												<div class="col-md-8">
													<input
														type="text"
														class="form-control"
														name="regn_country"
														id="regn_country"
														value="India"
														placeholder="Enter Country"
													/>
												</div>
											</div>
										</div>

										<!-- Pincode -->
										<div class="form-group">
											<div class="row">
												<div class="col-md-4"><label>Pincode</label></div>
												<div class="col-md-8">
													<input
														type="text"
														class="form-control"
														name="regn_pincode"
														id="regn_pincode"
														maxlength="6"
														placeholder="Enter 6-digit Pincode"
													/>
												</div>
											</div>
										</div>


										<!-- Vehicle Photos Upload Button -->
										<div class="form-group">
											<div class="row">
												<div class="col-md-4"></div>
												<div class="col-md-8">
													<button
														type="button"
														class="btn btn-primary"
														data-toggle="modal"
														data-target="#vehiclePhotosModal"
													>
														<i class="fa fa-camera"></i> Upload Vehicle Photos
													</button>
												</div>
											</div>
										</div>

										<!-- Vehicle Video Upload Button -->
										<div class="form-group">
											<div class="row">
												<div class="col-md-4"></div>
												<div class="col-md-8">
													<button
														type="button"
														class="btn btn-warning"
														data-toggle="modal"
														data-target="#vehicleVideoModal"
													>
														<i class="fa fa-video-camera"></i> Upload Vehicle Video
													</button>
												</div>
											</div>
										</div>

									</div>
								</div>
							</div>
						</div>
						<!-- ========================= END REGISTRATION DETAILS ========================= -->

						<!-- ========================= UPLOAD DOCUMENTS ========================= -->
						<div class="box">
							<div class="box-header with-border" style="background: #f4f4f48c">
								<h3 class="box-title" style="text-align: left; font-size: 14px">
									<i class="fa fa-upload" aria-hidden="true"></i> &nbsp;&nbsp;
									Upload Documents
								</h3>
								<div class="box-tools pull-right">
									<button
										type="button"
										class="btn btn-box-tool"
										data-widget="collapse"
										title="Collapse"
									>
										<i class="fa fa-minus"></i>
									</button>
								</div>
							</div>

							<div class="box-body">
								<table class="table table-bordered">
									<thead>
										<tr>
											<th>File Type</th>
											<th>File Name</th>
											<th>Document Type</th>
											<th>Edit</th>
											<th>Delete</th>
										</tr>
									</thead>
									<tbody id="table_view"></tbody>
								</table>

								<br />

								<div class="row">
									<div class="col-md-6">
										<label>Document Type</label>
										<div class="form-group">
											<select
												class="form-control"
												name="document_type"
												id="document_type"
											>
												<option value="">--Select--</option>
												<option value="RC Book">RC Book</option>
												<option value="Other">Other</option>
											</select>
										</div>
									</div>

									<div class="col-md-6">
										<label>Upload Document</label>
										<div class="form-group">
											<input
												type="file"
												class="form-control"
												id="document_file"
											/>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!-- ========================= END UPLOAD DOCUMENTS ========================= -->
					</div>

					<!-- Create New Vechile End -->

					<!-- Add Health Details Start-->

					<div class="modal fade in" id="add_health_model">
						<div class="modal-dialog">
							<div class="modal-content modal-lg-content">
								<div class="modal-header bg-primary">
									<button
										type="button"
										class="close"
										data-dismiss="modal"
										aria-label="Close"
									>
										<span aria-hidden="true" style="color: white">×</span>
									</button>
									<h4 class="modal-title text-center" style="color: white">
										Add Health Details
									</h4>
								</div>
								<div class="modal-body">
									<input
										type="text"
										class="hidden"
										id="created_id"
										value="<?php echo $this->session->userdata('session_id'); ?>"
									/>

									<div class="form-group">
										<label>Gender</label
										><span id="add_name_error" style="color: red">*</span>
										<select class="form-control" name="h_gender" id="h_gender">
											<option value="Male">Male</option>
											<option value="Female">Female</option>
										</select>
									</div>

									<div class="form-group">
										<label>Select members you want to insure </label
										><span id="add_name_error" style="color: red">*</span>
										<select
											placeholder="--Select--"
											class="form-control select2"
											multiple="multiple"
											name="h_family_members"
											id="h_family_members"
											style="width: 100%"
										>
											<option value="You">You</option>
											<option value="Spouse">Spouse</option>
											<option value="Daughter">Daughter</option>
											<option value="Son">Son</option>
											<option value="Father">Father</option>
											<option value="Mother">Mother</option>
										</select>
									</div>

									<div class="form-group">
										<div class="row" id="row_id">
											<!--<div class="col-md-6">-->
											<!--   <label>No of Daughter's</label>   -->
											<!--   <div class="input-group">-->
											<!--       <input type="text" class="form-control" name="num_daughters" id="num_daughters">-->
											<!--       <span class="input-group-addon"><i class="fa fa-plus"></i></span>-->
											<!--   </div>-->
											<!--</div>-->

											<!--<div class="col-md-6">-->
											<!--   <label>No of Sons's</label> -->
											<!--   <div class="input-group">-->
											<!--       <input type="text" class="form-control" name="num_sons" id="num_sons">-->
											<!--       <span class="input-group-addon"><i class="fa fa-plus"></i></span>-->
											<!--   </div>-->
											<!--</div>-->
										</div>
									</div>

									<div id="you_div" class="hidden">
										<div class="row">
											<div class="col-md-3">
												<div id="ins_div">
													<img
														src="../datas/icons/male1.png"
														style="height: 50px; width: 50px"
													/>
												</div>
												<label>You (Insurer)</label>
											</div>

											<div class="col-md-3">
												<label>Insurer Name</label>
												<input
													type="text"
													class="form-control"
													name="add_you_name"
													id="add_you_name"
												/>
											</div>

											<div class="col-md-3">
												<label>DOB</label>
												<input
													type="date"
													class="form-control"
													name="add_dob"
													id="add_dob"
												/>
											</div>

											<div class="col-md-3">
												<label>Age</label>
												<select
													class="form-control"
													name="you_age"
													id="you_age"
												>
													<option value="">Age</option>
													<?php for ($i = 18; $i <= 100; $i++) { ?>
													<option value="<?php echo $i; ?>">
														<?php echo $i; ?>
														Years
													</option>
													<?php } ?>
												</select>
											</div>
										</div>
									</div>

									<p></p>

									<div id="husband_wife_div" class="hidden">
										<div class="row">
											<div class="col-md-3">
												<div id="hus_wife_div">
													<img
														src="../datas/icons/wife.png"
														style="height: 50px; width: 50px"
													/>
												</div>
												<label>Spouse</label>
											</div>

											<div class="col-md-3">
												<label>Name</label>
												<input
													type="text"
													class="form-control"
													name="hus_wife_name"
													id="hus_wife_name"
												/>
											</div>

											<div class="col-md-3">
												<label>DOB</label>
												<input
													type="date"
													class="form-control"
													name="add_hus_wife_dob"
													id="add_hus_wife_dob"
												/>
											</div>

											<div class="col-md-3">
												<label>Age</label>
												<select
													class="form-control"
													name="hus_wife_age"
													id="hus_wife_age"
												>
													<option value="">Age</option>
													<?php for ($i = 18; $i <= 100; $i++) { ?>
													<option value="<?php echo $i; ?>">
														<?php echo $i; ?>
														Years
													</option>
													<?php } ?>
												</select>
											</div>
										</div>
									</div>
									<p></p>

									<div id="daughter_div1" class="hidden">
										<div class="row">
											<div class="col-md-3">
												<div>
													<img
														src="../datas/icons/daughter.png"
														style="height: 50px; width: 50px"
													/>
												</div>
												<label>Daughter 1</label>
											</div>

											<div class="col-md-3">
												<label>Name</label>
												<input
													type="text"
													class="form-control"
													name="add_daughter_name_1"
													id="add_daughter_name_1"
												/>
											</div>

											<div class="col-md-3">
												<label>DOB</label>
												<input
													type="date"
													class="form-control"
													name="add_daughter_dob_1"
													id="add_daughter_dob_1"
												/>
											</div>

											<div class="col-md-3">
												<label>Age</label>
												<select
													class="form-control"
													name="daughter_age_1"
													id="daughter_age_1"
												>
													<option value="">Age</option>
													<?php for ($i = 1; $i <= 11; $i++) { ?>
													<option value="<?php echo $i; ?>">
														<?php echo $i; ?>
														Months
													</option>
													<?php } ?>
													<?php for ($i = 1; $i <= 30; $i++) { ?>
													<option value="<?php echo $i * 12; ?>">
														<?php echo $i; ?>
														Years
													</option>
													<?php } ?>
												</select>
											</div>
										</div>
									</div>
									<p></p>

									<div id="daughter_div2" class="hidden">
										<div class="row">
											<div class="col-md-3">
												<div>
													<img
														src="../datas/icons/daughter.png"
														style="height: 50px; width: 50px"
													/>
												</div>
												<label>Daughter 2</label>
											</div>

											<div class="col-md-3">
												<label>Name</label>
												<input
													type="text"
													class="form-control"
													name="add_daughter_name_2"
													id="add_daughter_name_2"
												/>
											</div>

											<div class="col-md-3">
												<label>DOB</label>
												<input
													type="date"
													class="form-control"
													name="add_daughter_dob_2"
													id="add_daughter_dob_2"
												/>
											</div>
											<div class="col-md-3">
												<label>Age</label>
												<select
													class="form-control"
													name="daughter_age_2"
													id="daughter_age_2"
												>
													<option value="">Age</option>
													<?php for ($i = 1; $i <= 11; $i++) { ?>
													<option value="<?php echo $i; ?>">
														<?php echo $i; ?>
														Months
													</option>
													<?php } ?>
													<?php for ($i = 1; $i <= 30; $i++) { ?>
													<option value="<?php echo $i * 12; ?>">
														<?php echo $i; ?>
														Years
													</option>
													<?php } ?>
												</select>
											</div>
										</div>
									</div>
									<p></p>
									<div id="daughter_div3" class="hidden">
										<div class="row">
											<div class="col-md-3">
												<div>
													<img
														src="../datas/icons/daughter.png"
														style="height: 50px; width: 50px"
													/>
												</div>
												<label>Daughter 3</label>
											</div>

											<div class="col-md-3">
												<label>Name</label>
												<input
													type="text"
													class="form-control"
													name="add_daughter_dob_3"
													id="add_daughter_dob_3"
												/>
											</div>

											<div class="col-md-3">
												<label>DOB</label>
												<input
													type="date"
													class="form-control"
													name="add_daughter_name_3"
													id="add_daughter_name_3"
												/>
											</div>

											<div class="col-md-3">
												<label>Age</label>
												<select
													class="form-control"
													name="daughter_age_3"
													id="daughter_age_3"
												>
													<option value="">Age</option>
													<?php for ($i = 1; $i <= 11; $i++) { ?>
													<option value="<?php echo $i; ?>">
														<?php echo $i; ?>
														Months
													</option>
													<?php } ?>
													<?php for ($i = 1; $i <= 30; $i++) { ?>
													<option value="<?php echo $i * 12; ?>">
														<?php echo $i; ?>
														Years
													</option>
													<?php } ?>
												</select>
											</div>
										</div>
									</div>
									<p></p>
									<div id="daughter_div4" class="hidden">
										<div class="row">
											<div class="col-md-3">
												<div>
													<img
														src="../datas/icons/daughter.png"
														style="height: 50px; width: 50px"
													/>
												</div>
												<label>Daughter 4</label>
											</div>

											<div class="col-md-3">
												<label>Name</label>
												<input
													type="text"
													class="form-control"
													name="add_daughter_dob_4"
													id="add_daughter_dob_4"
												/>
											</div>

											<div class="col-md-3">
												<label>DOB</label>
												<input
													type="date"
													class="form-control"
													name="add_daughter_name_4"
													id="add_daughter_name_4"
												/>
											</div>
											<div class="col-md-6">
												<label>Age</label>
												<select
													class="form-control"
													name="daughter_age_4"
													id="daughter_age_4"
												>
													<option value="">Age</option>
													<?php for ($i = 1; $i <= 11; $i++) { ?>
													<option value="<?php echo $i; ?>">
														<?php echo $i; ?>
														Months
													</option>
													<?php } ?>
													<?php for ($i = 1; $i <= 30; $i++) { ?>
													<option value="<?php echo $i * 12; ?>">
														<?php echo $i; ?>
														Years
													</option>
													<?php } ?>
												</select>
											</div>
										</div>
									</div>
									<p></p>
									<div id="son_div1" class="hidden">
										<div class="row">
											<div class="col-md-3">
												<div>
													<img
														src="../datas/icons/son.png"
														style="height: 50px; width: 50px"
													/>
												</div>
												<label>Son 1</label>
											</div>

											<div class="col-md-3">
												<label>Name</label>
												<input
													type="text"
													class="form-control"
													name="add_son_name_1"
													id="add_son_name_1"
												/>
											</div>

											<div class="col-md-3">
												<label>DOB</label>
												<input
													type="date"
													class="form-control"
													name="add_son_dob_1"
													id="add_son_dob_1"
												/>
											</div>

											<div class="col-md-3">
												<label>Age</label>
												<select
													class="form-control"
													name="son_age_1"
													id="son_age_1"
												>
													<option value="">Age</option>
													<?php for ($i = 1; $i <= 11; $i++) { ?>
													<option value="<?php echo $i; ?>">
														<?php echo $i; ?>
														Months
													</option>
													<?php } ?>
													<?php for ($i = 1; $i <= 30; $i++) { ?>
													<option value="<?php echo $i * 12; ?>">
														<?php echo $i; ?>
														Years
													</option>
													<?php } ?>
												</select>
											</div>
										</div>
									</div>
									<p></p>
									<div id="son_div2" class="hidden">
										<div class="row">
											<div class="col-md-3">
												<div>
													<img
														src="../datas/icons/son.png"
														style="height: 50px; width: 50px"
													/>
												</div>
												<label>Son 2</label>
											</div>

											<div class="col-md-3">
												<label>Name</label>
												<input
													type="text"
													class="form-control"
													name="add_son_name_2"
													id="add_son_name_2"
												/>
											</div>

											<div class="col-md-3">
												<label>DOB</label>
												<input
													type="date"
													class="form-control"
													name="add_son_dob_2"
													id="add_son_dob_2"
												/>
											</div>
											<div class="col-md-3">
												<label>Age</label>
												<select
													class="form-control"
													name="son_age_2"
													id="son_age_2"
												>
													<option value="">Age</option>
													<?php for ($i = 1; $i <= 11; $i++) { ?>
													<option value="<?php echo $i; ?>">
														<?php echo $i; ?>
														Months
													</option>
													<?php } ?>
													<?php for ($i = 1; $i <= 30; $i++) { ?>
													<option value="<?php echo $i * 12; ?>">
														<?php echo $i; ?>
														Years
													</option>
													<?php } ?>
												</select>
											</div>
										</div>
									</div>
									<p></p>
									<div id="son_div3" class="hidden">
										<div class="row">
											<div class="col-md-3">
												<div>
													<img
														src="../datas/icons/son.png"
														style="height: 50px; width: 50px"
													/>
												</div>
												<label>Son 3</label>
											</div>

											<div class="col-md-3">
												<label>Name</label>
												<input
													type="text"
													class="form-control"
													name="add_son_name_3"
													id="add_son_name_3"
												/>
											</div>

											<div class="col-md-3">
												<label>DOB</label>
												<input
													type="date"
													class="form-control"
													name="add_son_dob_3"
													id="add_son_dob_3"
												/>
											</div>
											<div class="col-md-3">
												<label>Age</label>
												<select
													class="form-control"
													name="son_age_3"
													id="son_age_3"
												>
													<option value="">Age</option>
													<?php for ($i = 1; $i <= 11; $i++) { ?>
													<option value="<?php echo $i; ?>">
														<?php echo $i; ?>
														Months
													</option>
													<?php } ?>
													<?php for ($i = 1; $i <= 30; $i++) { ?>
													<option value="<?php echo $i * 12; ?>">
														<?php echo $i; ?>
														Years
													</option>
													<?php } ?>
												</select>
											</div>
										</div>
									</div>
									<p></p>
									<div id="son_div4" class="hidden">
										<div class="row">
											<div class="col-md-3">
												<div>
													<img
														src="../datas/icons/son.png"
														style="height: 50px; width: 50px"
													/>
												</div>
												<label>Son 4</label>
											</div>

											<div class="col-md-3">
												<label>Name</label>
												<input
													type="text"
													class="form-control"
													name="add_son_name_4"
													id="add_son_name_4"
												/>
											</div>

											<div class="col-md-3">
												<label>DOB</label>
												<input
													type="date"
													class="form-control"
													name="add_son_dob_4"
													id="add_son_dob_4"
												/>
											</div>

											<div class="col-md-3">
												<label>Age</label>
												<select
													class="form-control"
													name="son_age_4"
													id="son_age_4"
												>
													<option value="">Age</option>
													<?php for ($i = 1; $i <= 11; $i++) { ?>
													<option value="<?php echo $i; ?>">
														<?php echo $i; ?>
														Months
													</option>
													<?php } ?>
													<?php for ($i = 1; $i <= 30; $i++) { ?>
													<option value="<?php echo $i * 12; ?>">
														<?php echo $i; ?>
														Years
													</option>
													<?php } ?>
												</select>
											</div>
										</div>
									</div>
									<p></p>

									<div class="row hidden" id="father_div">
										<div class="col-md-3">
											<div>
												<img
													src="../datas/icons/grandpa.png"
													style="height: 50px; width: 50px"
												/>
											</div>
											<label>Father</label>
										</div>

										<div class="col-md-3">
											<label>Name</label>
											<input
												type="text"
												class="form-control"
												name="add_father_name"
												id="add_father_name"
											/>
										</div>

										<div class="col-md-3">
											<label>DOB</label>
											<input
												type="date"
												class="form-control"
												name="add_father_dob"
												id="add_father_dob"
											/>
										</div>

										<div class="col-md-3">
											<label>Age</label>
											<select
												class="form-control"
												name="father_age"
												id="father_age"
											>
												<option value="">Age</option>
												<?php for ($i = 18; $i <= 100; $i++) { ?>
												<option value="<?php echo $i; ?>">
													<?php echo $i; ?>
													Years
												</option>
												<?php } ?>
											</select>
										</div>
									</div>

									<p></p>

									<div class="row hidden" id="mother_div">
										<div class="col-md-3">
											<div>
												<img
													src="../datas/icons/grandma.png"
													style="height: 50px; width: 50px"
												/>
											</div>
											<label>Mother</label>
										</div>

										<div class="col-md-3">
											<label>Name</label>
											<input
												type="text"
												class="form-control"
												name="add_mother_name"
												id="add_mother_name"
											/>
										</div>

										<div class="col-md-3">
											<label>DOB</label>
											<input
												type="date"
												class="form-control"
												name="add_dob_mother"
												id="add_dob_mother"
											/>
										</div>

										<div class="col-md-3">
											<label>Age</label>
											<select
												class="form-control"
												name="mother_age"
												id="mother_age"
											>
												<option value="">Age</option>
												<?php for ($i = 18; $i <= 100; $i++) { ?>
												<option value="<?php echo $i; ?>">
													<?php echo $i; ?>
													Years
												</option>
												<?php } ?>
											</select>
										</div>
									</div>

									<div class="modal-footer">
										<button
											type="button"
											class="btn btn-sm btn-primary"
											id="add_health_btn"
										>
											Submit
										</button>
										<button
											type="button"
											class="btn btn-sm btn-default"
											data-dismiss="modal"
										>
											Close
										</button>
									</div>
								</div>
							</div>
						</div>
					</div>

					<!-- Add Health Details end-->

					<!-- Edit Health Details start-->

					<div class="modal fade in" id="edit_health_model">
						<div class="modal-dialog">
							<div class="modal-content modal-lg-content">
								<div class="modal-header bg-primary">
									<button
										type="button"
										class="close"
										data-dismiss="modal"
										aria-label="Close"
									>
										<span aria-hidden="true" style="color: white">×</span>
									</button>
									<h4 class="modal-title text-center" style="color: white">
										Edit Health Details
									</h4>
								</div>
								<div class="modal-body">
									<input
										type="text"
										class="hidden"
										id="edit_created_id"
										value="<?php echo $this->session->userdata('session_id'); ?>"
									/>

									<div class="form-group">
										<label>Gender</label
										><span id="edit_add_name_error" style="color: red">*</span>
										<select
											class="form-control"
											name="edit_h_gender"
											id="edit_h_gender"
										>
											<option value="Male">Male</option>
											<option value="Female">Female</option>
										</select>
									</div>

									<div class="form-group">
										<label>Select members you want to insure </label
										><span id="edit_add_name_error" style="color: red">*</span>
										<select
											placeholder="--Select--"
											class="form-control select2"
											multiple="multiple"
											name="edit_h_family_members"
											id="edit_h_family_members"
											style="width: 100%"
										>
											<option value="You">You</option>
											<option value="Spouse">Wife</option>
											<option value="Daughter">Daughter</option>
											<option value="Son">Son</option>
											<option value="Father">Father</option>
											<option value="Mother">Mother</option>
										</select>
									</div>

									<div class="form-group">
										<div class="row" id="edit_row_id"></div>
									</div>

									<div id="edit_you_div" class="hidden">
										<div class="row">
											<div class="col-md-3">
												<div id="ins_div">
													<img
														src="../datas/icons/male1.png"
														style="height: 50px; width: 50px"
													/>
												</div>
												<label>You (Insurer)</label>
											</div>

											<div class="col-md-3">
												<label>Insurer Name</label>
												<input
													type="text"
													class="form-control"
													name="edit_you_name"
													id="edit_you_name"
												/>
											</div>

											<div class="col-md-3">
												<label>DOB</label>
												<input
													type="date"
													class="form-control"
													name="edit_dob"
													id="edit_dob"
												/>
											</div>

											<div class="col-md-3">
												<label>Age</label>
												<select
													class="form-control"
													name="edit_you_age"
													id="edit_you_age"
												>
													<option value="">Age</option>
													<?php for ($i = 18; $i <= 100; $i++) { ?>
													<option value="<?php echo $i; ?>">
														<?php echo $i; ?>
														Years
													</option>
													<?php } ?>
												</select>
											</div>
										</div>
									</div>

									<p></p>

									<div id="edit_husband_wife_div" class="hidden">
										<div class="row">
											<div class="col-md-3">
												<div id="hus_wife_div">
													<img
														src="../datas/icons/wife.png"
														style="height: 50px; width: 50px"
													/>
												</div>
												<label>Spouse</label>
											</div>

											<div class="col-md-3">
												<label>Name</label>
												<input
													type="text"
													class="form-control"
													name="edit_hus_wife_name"
													id="edit_hus_wife_name"
												/>
											</div>

											<div class="col-md-3">
												<label>DOB</label>
												<input
													type="date"
													class="form-control"
													name="edit_hus_wife_dob"
													id="edit_hus_wife_dob"
												/>
											</div>

											<div class="col-md-3">
												<label>Age</label>
												<select
													class="form-control"
													name="edit_hus_wife_age"
													id="edit_hus_wife_age"
												>
													<option value="">Age</option>
													<?php for ($i = 18; $i <= 100; $i++) { ?>
													<option value="<?php echo $i; ?>">
														<?php echo $i; ?>
														Years
													</option>
													<?php } ?>
												</select>
											</div>
										</div>
									</div>
									<p></p>

									<div id="edit_daughter_div1" class="hidden">
										<div class="row">
											<div class="col-md-3">
												<div>
													<img
														src="../datas/icons/daughter.png"
														style="height: 50px; width: 50px"
													/>
												</div>
												<label>Daughter 1</label>
											</div>

											<div class="col-md-3">
												<label>Name</label>
												<input
													type="text"
													class="form-control"
													name="edit_daughter_name_1"
													id="edit_daughter_name_1"
												/>
											</div>

											<div class="col-md-3">
												<label>DOB</label>
												<input
													type="date"
													class="form-control"
													name="edit_daughter_dob_1"
													id="edit_daughter_dob_1"
												/>
											</div>

											<div class="col-md-3">
												<label>Age</label>
												<select
													class="form-control"
													name="edit_daughter_age_1"
													id="edit_daughter_age_1"
												>
													<option value="">Age</option>
													<?php for ($i = 1; $i <= 11; $i++) { ?>
													<option value="<?php echo $i; ?>">
														<?php echo $i; ?>
														Months
													</option>
													<?php } ?>
													<?php for ($i = 1; $i <= 30; $i++) { ?>
													<option value="<?php echo $i * 12; ?>">
														<?php echo $i; ?>
														Years
													</option>
													<?php } ?>
												</select>
											</div>
										</div>
									</div>
									<p></p>
									<div id="edit_daughter_div2" class="hidden">
										<div class="row">
											<div class="col-md-3">
												<div>
													<img
														src="../datas/icons/daughter.png"
														style="height: 50px; width: 50px"
													/>
												</div>
												<label>Daughter 2</label>
											</div>

											<div class="col-md-3">
												<label>Name</label>
												<input
													type="text"
													class="form-control"
													name="edit_daughter_name_2"
													id="edit_daughter_name_2"
												/>
											</div>

											<div class="col-md-3">
												<label>DOB</label>
												<input
													type="date"
													class="form-control"
													name="edit_daughter_dob_2"
													id="edit_daughter_dob_2"
												/>
											</div>

											<div class="col-md-3">
												<label>Age</label>
												<select
													class="form-control"
													name="edit_daughter_age_2"
													id="edit_daughter_age_2"
												>
													<option value="">Age</option>
													<?php for ($i = 1; $i <= 11; $i++) { ?>
													<option value="<?php echo $i; ?>">
														<?php echo $i; ?>
														Months
													</option>
													<?php } ?>
													<?php for ($i = 1; $i <= 30; $i++) { ?>
													<option value="<?php echo $i * 12; ?>">
														<?php echo $i; ?>
														Years
													</option>
													<?php } ?>
												</select>
											</div>
										</div>
									</div>
									<p></p>
									<div id="edit_daughter_div3" class="hidden">
										<div class="row">
											<div class="col-md-3">
												<div>
													<img
														src="../datas/icons/daughter.png"
														style="height: 50px; width: 50px"
													/>
												</div>
												<label>Daughter 3</label>
											</div>

											<div class="col-md-3">
												<label>Name</label>
												<input
													type="text"
													class="form-control"
													name="edit_daughter_dob_3"
													id="edit_daughter_dob_3"
												/>
											</div>

											<div class="col-md-3">
												<label>DOB</label>
												<input
													type="date"
													class="form-control"
													name="edit_daughter_name_3"
													id="edit_daughter_name_3"
												/>
											</div>

											<div class="col-md-3">
												<label>Age</label>
												<select
													class="form-control"
													name="edit_daughter_age_3"
													id="edit_daughter_age_3"
												>
													<option value="">Age</option>
													<?php for ($i = 1; $i <= 11; $i++) { ?>
													<option value="<?php echo $i; ?>">
														<?php echo $i; ?>
														Months
													</option>
													<?php } ?>
													<?php for ($i = 1; $i <= 30; $i++) { ?>
													<option value="<?php echo $i * 12; ?>">
														<?php echo $i; ?>
														Years
													</option>
													<?php } ?>
												</select>
											</div>
										</div>
									</div>
									<p></p>

									<div id="edit_daughter_div4" class="hidden">
										<div class="row">
											<div class="col-md-3">
												<div>
													<img
														src="../datas/icons/daughter.png"
														style="height: 50px; width: 50px"
													/>
												</div>
												<label>Daughter 4</label>
											</div>

											<div class="col-md-3">
												<label>Name</label>
												<input
													type="text"
													class="form-control"
													name="edit_daughter_name_4"
													id="edit_daughter_name_4"
												/>
											</div>

											<div class="col-md-3">
												<label>DOB</label>
												<input
													type="date"
													class="form-control"
													name="edit_daughter_dob_4"
													id="edit_daughter_dob_4"
												/>
											</div>

											<div class="col-md-6">
												<label>Age</label>
												<select
													class="form-control"
													name="edit_daughter_age_4"
													id="edit_daughter_age_4"
												>
													<option value="">Age</option>
													<?php for ($i = 1; $i <= 11; $i++) { ?>
													<option value="<?php echo $i; ?>">
														<?php echo $i; ?>
														Months
													</option>
													<?php } ?>
													<?php for ($i = 1; $i <= 30; $i++) { ?>
													<option value="<?php echo $i * 12; ?>">
														<?php echo $i; ?>
														Years
													</option>
													<?php } ?>
												</select>
											</div>
										</div>
									</div>
									<p></p>

									<div id="edit_son_div1" class="hidden">
										<div class="row">
											<div class="col-md-3">
												<div>
													<img
														src="../datas/icons/son.png"
														style="height: 50px; width: 50px"
													/>
												</div>
												<label>Son 1</label>
											</div>

											<div class="col-md-3">
												<label>Name</label>
												<input
													type="text"
													class="form-control"
													name="edit_son_name_1"
													id="edit_son_name_1"
												/>
											</div>

											<div class="col-md-3">
												<label>DOB</label>
												<input
													type="date"
													class="form-control"
													name="edit_son_dob_1"
													id="edit_son_dob_1"
												/>
											</div>

											<div class="col-md-3">
												<label>Age</label>
												<select
													class="form-control"
													name="edit_son_age_1"
													id="edit_son_age_1"
												>
													<option value="">Age</option>
													<?php for ($i = 1; $i <= 11; $i++) { ?>
													<option value="<?php echo $i; ?>">
														<?php echo $i; ?>
														Months
													</option>
													<?php } ?>
													<?php for ($i = 1; $i <= 30; $i++) { ?>
													<option value="<?php echo $i * 12; ?>">
														<?php echo $i; ?>
														Years
													</option>
													<?php } ?>
												</select>
											</div>
										</div>
									</div>

									<p></p>

									<div id="edit_son_div2" class="hidden">
										<div class="row">
											<div class="col-md-3">
												<div>
													<img
														src="../datas/icons/son.png"
														style="height: 50px; width: 50px"
													/>
												</div>
												<label>Son 2</label>
											</div>

											<div class="col-md-3">
												<label>Name</label>
												<input
													type="text"
													class="form-control"
													name="edit_son_name_2"
													id="edit_son_name_2"
												/>
											</div>

											<div class="col-md-3">
												<label>DOB</label>
												<input
													type="date"
													class="form-control"
													name="edit_son_dob_2"
													id="edit_son_dob_2"
												/>
											</div>
											<div class="col-md-3">
												<label>Age</label>
												<select
													class="form-control"
													name="edit_son_age_2"
													id="edit_son_age_2"
												>
													<option value="">Age</option>
													<?php for ($i = 1; $i <= 11; $i++) { ?>
													<option value="<?php echo $i; ?>">
														<?php echo $i; ?>
														Months
													</option>
													<?php } ?>
													<?php for ($i = 1; $i <= 30; $i++) { ?>
													<option value="<?php echo $i * 12; ?>">
														<?php echo $i; ?>
														Years
													</option>
													<?php } ?>
												</select>
											</div>
										</div>
									</div>
									<p></p>
									<div id="edit_son_div3" class="hidden">
										<div class="row">
											<div class="col-md-3">
												<div>
													<img
														src="../datas/icons/son.png"
														style="height: 50px; width: 50px"
													/>
												</div>
												<label>Son 3</label>
											</div>

											<div class="col-md-3">
												<label>Name</label>
												<input
													type="text"
													class="form-control"
													name="edit_son_name_3"
													id="edit_son_name_3"
												/>
											</div>

											<div class="col-md-3">
												<label>DOB</label>
												<input
													type="date"
													class="form-control"
													name="edit_son_dob_3"
													id="edit_son_dob_3"
												/>
											</div>

											<div class="col-md-3">
												<label>Age</label>
												<select
													class="form-control"
													name="edit_son_age_3"
													id="edit_son_age_3"
												>
													<option value="">Age</option>
													<?php for ($i = 1; $i <= 11; $i++) { ?>
													<option value="<?php echo $i; ?>">
														<?php echo $i; ?>
														Months
													</option>
													<?php } ?>
													<?php for ($i = 1; $i <= 30; $i++) { ?>
													<option value="<?php echo $i * 12; ?>">
														<?php echo $i; ?>
														Years
													</option>
													<?php } ?>
												</select>
											</div>
										</div>
									</div>
									<p></p>
									<div id="edit_son_div4" class="hidden">
										<div class="row">
											<div class="col-md-3">
												<div>
													<img
														src="../datas/icons/son.png"
														style="height: 50px; width: 50px"
													/>
												</div>
												<label>Son 4</label>
											</div>

											<div class="col-md-3">
												<label>Name</label>
												<input
													type="text"
													class="form-control"
													name="edit_son_name_4"
													id="edit_son_name_4"
												/>
											</div>

											<div class="col-md-3">
												<label>DOB</label>
												<input
													type="date"
													class="form-control"
													name="edit_son_dob_4"
													id="edit_son_dob_4"
												/>
											</div>

											<div class="col-md-3">
												<label>Age</label>
												<select
													class="form-control"
													name="edit_son_age_4"
													id="edit_son_age_4"
												>
													<option value="">Age</option>
													<?php for ($i = 1; $i <= 11; $i++) { ?>
													<option value="<?php echo $i; ?>">
														<?php echo $i; ?>
														Months
													</option>
													<?php } ?>
													<?php for ($i = 1; $i <= 30; $i++) { ?>
													<option value="<?php echo $i * 12; ?>">
														<?php echo $i; ?>
														Years
													</option>
													<?php } ?>
												</select>
											</div>
										</div>
									</div>
									<p></p>

									<div class="row hidden" id="edit_father_div">
										<div class="col-md-3">
											<div>
												<img
													src="../datas/icons/grandpa.png"
													style="height: 50px; width: 50px"
												/>
											</div>
											<label>Father</label>
										</div>

										<div class="col-md-3">
											<label>Name</label>
											<input
												type="text"
												class="form-control"
												name="edit_father_name"
												id="edit_father_name"
											/>
										</div>

										<div class="col-md-3">
											<label>DOB</label>
											<input
												type="date"
												class="form-control"
												name="edit_father_dob"
												id="edit_father_dob"
											/>
										</div>

										<div class="col-md-3">
											<label>Age</label>
											<select
												class="form-control"
												name="edit_father_age"
												id="edit_father_age"
											>
												<option value="">Age</option>
												<?php for ($i = 18; $i <= 100; $i++) { ?>
												<option value="<?php echo $i; ?>">
													<?php echo $i; ?>
													Years
												</option>
												<?php } ?>
											</select>
										</div>
									</div>
									<p></p>
									<div class="row hidden" id="edit_mother_div">
										<div class="col-md-3">
											<div>
												<img
													src="../datas/icons/grandma.png"
													style="height: 50px; width: 50px"
												/>
											</div>
											<label>Mother</label>
										</div>

										<div class="col-md-3">
											<label>Name</label>
											<input
												type="text"
												class="form-control"
												name="edit_mother_name"
												id="edit_mother_name"
											/>
										</div>

										<div class="col-md-3">
											<label>DOB</label>
											<input
												type="date"
												class="form-control"
												name="edit_dob_mother"
												id="edit_dob_mother"
											/>
										</div>

										<div class="col-md-3">
											<label>Age</label>
											<select
												class="form-control"
												name="edit_mother_age"
												id="edit_mother_age"
											>
												<option value="">Age</option>
												<?php for ($i = 18; $i <= 100; $i++) { ?>
												<option value="<?php echo $i; ?>">
													<?php echo $i; ?>
													Years
												</option>
												<?php } ?>
											</select>
										</div>
									</div>

									<div class="modal-footer">
										<button
											type="button"
											class="btn btn-sm btn-primary"
											id="edit_health_btn"
										>
											Submit
										</button>
										<button
											type="button"
											class="btn btn-sm btn-default"
											data-dismiss="modal"
										>
											Close
										</button>
									</div>
								</div>
							</div>
						</div>
					</div>

					<!-- Edit Health Details end-->

					<!-- Add pet Details start-->

					<div id="add_pet_modal" class="modal fade" role="dialog">
						<div class="modal-dialog">
							<!-- Modal content-->
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal">
										&times;
									</button>
									<h4 class="modal-title">Pet Details</h4>
								</div>
								<div class="modal-body">
									<center style="margin-bottom: 10px">
										<input
											type="button"
											class="btn btn-light change_pet_gender"
											id="pet_male_btn"
											style="border: none"
											value="Male"
										/>
										<input
											type="button"
											id="pet_female_btn"
											class="btn btn-light"
											style="border: none"
											value="Female"
										/>
									</center>

									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label>PET Name</label>
												<input type="text" class="form-control" id="pet_name" />
											</div>

											<div class="form-group">
												<label>PET Weight In KG</label><span>*</span>
												<div class="input-group">
													<input
														type="text"
														class="form-control"
														style="text-align: right"
														id="pet_weight"
													/>
													<span class="input-group-addon">KG</span>
												</div>
											</div>
										</div>

										<div class="col-md-6">
											<div class="form-group">
												<label>PET Age In Months</label><span>*</span>
												<div class="input-group">
													<input
														type="text"
														class="form-control"
														style="text-align: right"
														id="pet_age"
													/>
													<span class="input-group-addon">Months</span>
												</div>
											</div>

											<div class="form-group">
												<label>PET Height</label><span>*</span>
												<div class="input-group">
													<input
														type="text"
														class="form-control"
														style="text-align: right"
														id="pet_height"
													/>
													<span class="input-group-addon">FT</span>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-primary" id="pet_submit">
										Submit
									</button>
									<button
										type="button"
										class="btn btn-default"
										data-dismiss="modal"
									>
										Close
									</button>
								</div>
							</div>
						</div>
					</div>

					<!-- Add pet Details End-->

					<!--property -->

					<div id="homeModal" class="modal fade" role="dialog">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header mob_pad_top_bot_5px">
									<center>
										<h4 class="modal-title">Best Home Insurance</h4>
									</center>
									<button
										type="button"
										class="close"
										style="background-color: #fff; margin-top: -25px"
										data-dismiss="modal"
									>
										&times;
									</button>
								</div>

								<div class="modal-body">
									<div class="row">
										<div class="col-md-6">
											<label>What is your house type?</label><br />
											<input
												type="button"
												class="btn btn-light change_house_type"
												id="home_btn"
												style="border: none"
												value="Home"
											/>
											&nbsp;<input
												type="button"
												id="housing_society_btn"
												class="btn btn-light"
												style="border: none"
												value="Housing Society"
											/>
										</div>

										<div class="col-md-6">
											<label>Are you a tenant or Owner?</label><br />
											<input
												type="button"
												class="btn btn-light change_owner"
												id="owner_btn"
												style="border: none"
												value="Owner"
											/>
											&nbsp;<input
												type="button"
												id="tenant_btn"
												class="btn btn-light"
												style="border: none"
												value="Tenant"
											/>
										</div>
									</div>

									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label>Select Policy Tenure</label>
												<select class="form-control" id="home_policy_tenure">
													<option>1 Year</option>
													<option>2 Year</option>
													<option>3 Year</option>
													<option>4 Year</option>
													<option>5 Year</option>
													<option>6 Year</option>
													<option>7 Year</option>
													<option>8 Year</option>
													<option>9 Year</option>
													<option>10 Year</option>
												</select>
											</div>

											<div class="form-group">
												<label>Property Value</label>
												<div class="input-group">
													<div class="input-group-addon">₹</div>
													<input
														type="number"
														class="form-control"
														id="home_property_value"
													/>
												</div>
											</div>

											<div class="form-group">
												<label>Interior, Furniture & Lighting</label>
												<div class="input-group">
													<div class="input-group-addon">₹</div>
													<input
														type="number"
														class="form-control"
														id="home_infuli"
													/>
												</div>
											</div>
										</div>

										<div class="col-md-6">
											<div class="form-group">
												<label>Age of Premises</label>
												<select class="form-control" id="home_age_premises">
													<option>1 Year</option>
													<option>2 Year</option>
													<option>3 Year</option>
													<option>4 Year</option>
													<option>5 Year</option>
													<option>6 Year</option>
													<option>7 Year</option>
													<option>8 Year</option>
													<option>9 Year</option>
													<option>10 Year</option>
													<option>11 Year</option>
													<option>12 Year</option>
													<option>13 Year</option>
													<option>14 Year</option>
													<option>15 Year</option>
													<option>16 Year</option>
													<option>17 Year</option>
													<option>18 Year</option>
													<option>19 Year</option>
													<option>20 Year</option>
													<option>21 Year</option>
													<option>22 Year</option>
													<option>23 Year</option>
													<option>24 Year</option>
													<option>25 Year</option>
													<option>26 Year</option>
													<option>27 Year</option>
													<option>28 Year</option>
													<option>29 Year</option>
												</select>
											</div>

											<div class="form-group">
												<label>Built Up Area</label>
												<div class="input-group">
													<input
														type="number"
														class="form-control"
														id="home_sqft"
													/>
													<div class="input-group-addon">Sq Ft</div>
												</div>
											</div>

											<div class="form-group">
												<label>DG set, Air Conditioner & Machinery</label>
												<div class="input-group">
													<div class="input-group-addon">₹</div>
													<input
														type="number"
														class="form-control"
														id="home_dgairmac"
													/>
												</div>
											</div>
										</div>
									</div>
								</div>

								<div class="modal-footer">
									<button
										type="button"
										class="btn btn-primary"
										id="add_pro_btn"
									>
										Submit
									</button>
									<button
										type="button"
										class="btn btn-default"
										data-dismiss="modal"
									>
										Close
									</button>
								</div>
							</div>
						</div>
					</div>

					<div id="businessmodal" class="modal fade" role="dialog">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header mob_pad_top_bot_5px">
									<center>
										<h4 class="modal-title">Best Business Insurance</h4>
									</center>
									<button
										type="button"
										class="close"
										style="background-color: #fff; margin-top: -25px"
										data-dismiss="modal"
									>
										&times;
									</button>
								</div>

								<div class="modal-body">
									<div class="row">
										<div class="col-md-6">
											<label>Are you a tenant or Owner?</label><br />
											<input
												type="button"
												class="btn btn-light business_change_owner"
												id="business_owner_btn"
												style="border: none"
												value="Owner"
											/>
											&nbsp;<input
												type="button"
												id="business_tenant_btn"
												class="btn btn-light"
												style="border: none"
												value="Tenant"
											/>
										</div>
									</div>

									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label>Your Proffession</label>
												<input
													type="text"
													class="form-control"
													id="business_profession"
												/>
											</div>

											<div class="form-group">
												<label>Property Value</label>
												<div class="input-group">
													<div class="input-group-addon">₹</div>
													<input
														type="number"
														class="form-control"
														id="business_property_value"
													/>
												</div>
											</div>

											<div class="form-group">
												<label>Interior, Furniture & Lighting</label>
												<div class="input-group">
													<div class="input-group-addon">₹</div>
													<input
														type="number"
														class="form-control"
														id="business_infuli"
													/>
												</div>
											</div>
										</div>

										<div class="col-md-6">
											<div class="form-group">
												<label>Age of Premises</label>
												<select class="form-control" id="business_age_premises">
													<option>1 Year</option>
													<option>2 Year</option>
													<option>3 Year</option>
													<option>4 Year</option>
													<option>5 Year</option>
													<option>6 Year</option>
													<option>7 Year</option>
													<option>8 Year</option>
													<option>9 Year</option>
													<option>10 Year</option>
													<option>11 Year</option>
													<option>12 Year</option>
													<option>13 Year</option>
													<option>14 Year</option>
													<option>15 Year</option>
													<option>16 Year</option>
													<option>17 Year</option>
													<option>18 Year</option>
													<option>19 Year</option>
													<option>20 Year</option>
													<option>21 Year</option>
													<option>22 Year</option>
													<option>23 Year</option>
													<option>24 Year</option>
													<option>25 Year</option>
													<option>26 Year</option>
													<option>27 Year</option>
													<option>28 Year</option>
													<option>29 Year</option>
												</select>
											</div>

											<div class="form-group">
												<label>Built Up Area</label>
												<div class="input-group">
													<input
														type="number"
														class="form-control"
														id="business_sqft"
													/>
													<div class="input-group-addon">Sq Ft</div>
												</div>
											</div>

											<div class="form-group">
												<label>DG set, Air Conditioner & Machinery</label>
												<div class="input-group">
													<div class="input-group-addon">₹</div>
													<input
														type="number"
														class="form-control"
														id="business_dgairmac"
													/>
												</div>
											</div>
										</div>
									</div>
								</div>

								<div class="modal-footer">
									<button
										type="button"
										class="btn btn-primary"
										id="add_business_btn"
									>
										Submit
									</button>
									<button
										type="button"
										class="btn btn-default"
										data-dismiss="modal"
									>
										Close
									</button>
								</div>
							</div>
						</div>
					</div>

					<!-- Modal -->
					<div id="marainemodal" class="modal fade" role="dialog">
						<div class="modal-dialog">
							<!-- Modal content-->
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal">
										&times;
									</button>
									<h4 class="modal-title text-center">
										Maraine Insurance Details
									</h4>
								</div>
								<div class="modal-body">
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label>Type of Single Transit Policy</label>
												<select
													class="form-control"
													name="transit_policy"
													id="transit_policy"
												>
													<option value="">--select--</option>
													<option value="Inland">Inland</option>
													<option value="Import">Import</option>
													<option value="Export">Export</option>
												</select>
											</div>

											<div class="form-group">
												<label>Mode of Transport</label>
												<select class="form-control" id="marine_transport">
													<option>Air</option>
													<option>Road</option>
													<option>Rail</option>
													<option>Courier</option>
												</select>
											</div>

											<div class="form-group">
												<label>Commodity</label>
												<select class="form-control" id="marine_cummodity">
													<option value="">Select Commodity</option>
													<option value="1">Auto and spares</option>
													<option value="2">Chemicals</option>
												</select>
											</div>

											<div class="form-group">
												<label>Invoice Value (In Rupees)</label>
												<div class="input-group" bis_skin_checked="1">
													<span class="input-group-addon">₹</span>
													<input
														type="number"
														onclick="marine_calculate()"
														class="form-control"
														id="marine_invoice_val"
													/>
												</div>
											</div>
										</div>

										<div class="col-md-6">
											<div class="form-group">
												<label>Company Name</label>
												<input
													type="text"
													class="form-control"
													id="marine_company_name"
												/>
											</div>

											<div class="form-group">
												<label>City</label>
												<input
													type="text"
													class="form-control"
													id="marine_city_name"
												/>
											</div>

											<div class="form-group">
												<label>Sub Commodity</label>
												<select
													class="form-control"
													id="marine_sub_cummodity"
												></select>
											</div>

											<div class="form-group">
												<label
													>Sum Insured (in Rs)
													<span style="color: red">
														* Invoice amt +10%
													</span></label
												>
												<div class="input-group" bis_skin_checked="1">
													<span class="input-group-addon">₹</span>
													<input
														type="number"
														class="form-control"
														id="marine_invoice_10per_val"
													/>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="modal-footer">
									<button
										type="button"
										class="btn btn-primary"
										id="marine_submit"
									>
										Submit
									</button>
									<button
										type="button"
										class="btn btn-default"
										data-dismiss="modal"
									>
										Close
									</button>
								</div>
							</div>
						</div>
					</div>

					<!--property -->

					<!-- Modal -->
					<div id="add_quotation_model" class="modal fade" role="dialog">
						<div class="modal-dialog modal-lg">
							<!-- Modal content-->
							<div class="modal-content modal-lg-content">
								<div class="modal-header bg-primary">
									<button
										type="button"
										class="close"
										data-dismiss="modal"
										style="color: #fff"
									>
										&times;
									</button>

									<div class="row">
										<div class="col-md-6">
											<h4 class="modal-title">
												<i class="fa fa-file" aria-hidden="true"></i>
												&nbsp;&nbsp;Create Quotation
											</h4>
										</div>
										<div class="col-md-5">
											<button
												class="btn btn-success btn-sm pull-right"
												id="add_quotation"
											>
												<i class="fa fa-save" aria-hidden="true"></i> Save
											</button>
										</div>
									</div>
								</div>
								<div class="modal-body">
									<div class="box">
										<div class="box-header with-border bg-warning">
											<h3 class="box-title">
												<i class="fa fa-bars" aria-hidden="true"></i
												>&nbsp;&nbsp; Basic Information
											</h3>
											<div class="box-tools pull-right">
												<button
													type="button"
													class="btn btn-box-tool"
													data-widget="collapse"
													data-toggle="tooltip"
													title=""
													data-original-title="Collapse"
												>
													<i class="fa fa-minus"></i>
												</button>
												<button
													type="button"
													class="btn btn-box-tool"
													data-widget="remove"
													data-toggle="tooltip"
													title=""
													data-original-title="Remove"
												>
													<i class="fa fa-times"></i>
												</button>
											</div>
										</div>
										<div class="box-body">
											<div class="row">
												<div class="col-md-6">
													<div class="form-group">
														<div class="row">
															<div class="col-md-4">
																<label>Class</label>
															</div>
															<div class="col-md-8">
																<input
																	type="text"
																	class="form-control"
																	name="q_class"
																	id="q_class"
																	readonly
																/>
															</div>
														</div>
													</div>

													<div class="form-group">
														<div class="row">
															<div class="col-md-4">
																<label>Policy Type</label>
															</div>
															<div class="col-md-8">
																<input
																	type="text"
																	class="form-control"
																	name="q_policy_type"
																	id="q_policy_type"
																	readonly
																/>
															</div>
														</div>
													</div>

													<div class="form-group">
														<div class="row">
															<div class="col-md-4">
																<label>Client Name</label>
															</div>
															<div class="col-md-8">
																<input
																	type="text"
																	class="form-control"
																	name="q_client_name"
																	id="q_client_name"
																	readonly
																/>
															</div>
														</div>
													</div>

													<div class="form-group">
														<div class="row">
															<div class="col-md-4">
																<label>Old Policy number</label>
															</div>
															<div class="col-md-8">
																<input
																	type="text"
																	class="form-control"
																	name="q_old_policy_no"
																	id="q_old_policy_no"
																	readonly
																/>
															</div>
														</div>
													</div>
												</div>

												<div class="col-md-6">
													<div class="form-group">
														<div class="row">
															<div class="col-md-4">
																<label>Policy Cover Type</label>
															</div>
															<div class="col-md-8">
																<select
																	class="form-control"
																	name="q_policy_co_type"
																	id="policy_co_cover_type"
																>
																	<option value="">--Select--</option>
																	<option value="Own Damage">Own Damage</option>
																	<option value="Comprehensive">
																		Comprehensive
																	</option>
																	<option value="Third Party">
																		Third Party
																	</option>
																</select>
															</div>
														</div>
													</div>

													<div class="form-group">
														<div class="row">
															<div class="col-md-4">
																<label>Policy Term</label>
															</div>
															<div class="col-md-8">
																<select
																	class="form-control"
																	name="q_policy_term"
																	id="q_policy_term"
																>
																	<option value="">--select--</option>
																	<option value="1 Yr OD + 3Yr Tp">
																		1 Yr OD + 3Yr Tp
																	</option>
																	<option value="1 Yr OD + 1Yr Tp">
																		1 Yr OD + 1Yr Tp
																	</option>
																</select>
															</div>
														</div>
													</div>

													<div class="form-group">
														<div class="row">
															<div class="col-md-4">
																<label>Start Date</label>
															</div>
															<div class="col-md-8">
																<input type="date" class="form-control"
																name="q_policy_s_date" id="q_policy_s_date"
																value="<?php echo date("Y-m-d") ?>">
															</div>
														</div>
													</div>

													<div class="form-group">
														<div class="row">
															<div class="col-md-4">
																<label>Expiry Date</label>
															</div>
															<div class="col-md-8">
																<input
																	type="date"
																	class="form-control"
																	name="q_policy_ex_date"
																	id="q_policy_ex_date"
																	value="<?php echo date('Y-m-d', strtotime(' + 1 years')) ?>"
																/>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>

									<div class="box">
										<div class="box-header with-border bg-warning">
											<h3 class="box-title">
												<i class="fa fa-bars" aria-hidden="true"></i
												>&nbsp;&nbsp; Insurer Details
											</h3>
											<div class="box-tools pull-right">
												<button
													type="button"
													class="btn btn-box-tool"
													data-widget="collapse"
													data-toggle="tooltip"
													title=""
													data-original-title="Collapse"
												>
													<i class="fa fa-minus"></i>
												</button>
												<button
													type="button"
													class="btn btn-box-tool"
													data-widget="remove"
													data-toggle="tooltip"
													title=""
													data-original-title="Remove"
												>
													<i class="fa fa-times"></i>
												</button>
											</div>
										</div>
										<div class="box-body">
											<div class="row">
												<div class="col-md-6">
													<div class="form-group">
														<div class="row">
															<div class="col-md-4">
																<label>Insurer</label>
															</div>
															<div class="col-md-8">
																<select
																	name="q_insurer"
																	class="form-control"
																	id="q_insurer"
																>
																	<option value="">--Select--</option>
																	<option value="1">Acko General</option>
																	<option value="2">Aditya Birla Health</option>
																	<option value="3">Aegon Life</option>
																	<option value="4">Bajaj Allianz</option>
																	<option value="5">DHFL General</option>
																	<option value="6">HDFC ERGO</option>
																	<option value="7">TATA AIG</option>
																	<option value="8">Relaince General</option>
																</select>
															</div>
														</div>
													</div>
												</div>

												<div class="col-md-6">
													<div class="form-group">
														<div class="row">
															<div class="col-md-4">
																<label>Insurer Branch</label>
															</div>
															<div class="col-md-8">
																<select
																	name="q_insurer_branch"
																	class="form-control"
																	id="q_insurer_branch"
																>
																	<option value="">--Select--</option>
																</select>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>

									<div class="box">
										<div class="box-header with-border bg-warning">
											<h3 class="box-title">
												<i class="fa fa-car" aria-hidden="true"></i>&nbsp;&nbsp;
												Basic Details Of Vechicle
											</h3>
											<div class="box-tools pull-right">
												<button
													type="button"
													class="btn btn-box-tool"
													data-widget="collapse"
													data-toggle="tooltip"
													title=""
													data-original-title="Collapse"
												>
													<i class="fa fa-minus"></i>
												</button>
												<button
													type="button"
													class="btn btn-box-tool"
													data-widget="remove"
													data-toggle="tooltip"
													title=""
													data-original-title="Remove"
												>
													<i class="fa fa-times"></i>
												</button>
											</div>
										</div>
										<div class="box-body">
											<div class="row">
												<div class="col-md-6">
													<div class="form-group">
														<div class="row">
															<div class="col-md-4">
																<label>IDV</label>
															</div>
															<div class="col-md-8">
																<input
																	type="text"
																	class="form-control"
																	name="q_idv"
																	id="q_idv"
																/>
															</div>
														</div>
													</div>

													<div class="form-group">
														<div class="row">
															<div class="col-md-4">
																<label>Electrical Accessory Value</label>
															</div>
															<div class="col-md-8">
																<input
																	type="text"
																	class="form-control"
																	name="q_elec_access_value"
																	id="q_elec_access_value"
																/>
															</div>
														</div>
													</div>

													<div class="form-group">
														<div class="row">
															<div class="col-md-4">
																<label>Non Electrical Accessory Value</label>
															</div>
															<div class="col-md-8">
																<input
																	type="text"
																	class="form-control"
																	name="q_non_elec_access_value"
																	id="q_non_elec_access_value"
																/>
															</div>
														</div>
													</div>

													<div class="form-group">
														<div class="row">
															<div class="col-md-4">
																<label>LPG / CNG IDV</label>
															</div>
															<div class="col-md-4">
																<select
																	class="form-control"
																	name="q_lpg_cng"
																	id="q_lpg_cng"
																>
																	<option value="">--Select--</option>
																	<option value="Yes">Yes</option>
																	<option value="No" selected>No</option>
																</select>
															</div>
															<div class="col-md-4">
																<input
																	type="text"
																	class="form-control"
																	name="q_lpg_amount"
																	id="q_lpg_amount"
																	value="0"
																	readonly
																/>
															</div>
														</div>
													</div>

													<div class="form-group">
														<div class="row">
															<div class="col-md-4">
																<label>Sum Insured</label>
															</div>
															<div class="col-md-8">
																<input
																	type="text"
																	class="form-control"
																	name="q_sum_insured"
																	id="q_sum_insured"
																/>
															</div>
														</div>
													</div>
												</div>

												<div class="col-md-6">
													<div class="form-group">
														<div class="row">
															<div class="col-md-4">
																<label>Make / Model / Varient</label>
															</div>
															<div class="col-md-8">
																<input
																	type="text"
																	class="form-control"
																	name="q_make_model"
																	id="q_make_model"
																	readonly
																/>
															</div>
														</div>
													</div>

													<div class="form-group">
														<div class="row">
															<div class="col-md-4">
																<label>Vehicle Age</label>
															</div>
															<div class="col-md-5">
																<input
																	type="text"
																	class="form-control"
																	id="q_vechi_age"
																	name="q_vechi_age"
																	readonly
																/>
															</div>
															<div class="col-md-3">
																<button
																	class="btn btn-danger btn-xs"
																	id="edit_reg_yr"
																>
																	<i class="fa fa-pencil-square-o"></i
																	>&nbsp;&nbsp;Edit Mfg/Reg Year
																</button>
															</div>
														</div>
													</div>

													<div class="form-group">
														<div class="row">
															<div class="col-md-4">
																<label>RTO</label>
															</div>
															<div class="col-md-8">
																<select
																	class="form-control"
																	name="q_rto_code"
																	id="q_rto_code"
																>
																	<option value="">--select--</option>
																	<?php foreach ($rto as $da) {
                                        if ($da->id != "1" || $da->id != "2" ||
																	$da->id != "3" || $da->id != "4" || $da->id !=
																	"5" || $da->id != "6") { ?>
																	<option value="<?php echo $da->rto_no ?>">
																		<?php echo $da->rto_no." ( ".$da->city." )";
																		?>
																	</option>

																	<?php }
                                        } ?>
																</select>
															</div>
														</div>
													</div>

													<div class="form-group">
														<div class="row">
															<div class="col-md-4">
																<label>Zone</label>
															</div>
															<div class="col-md-8">
																<input
																	type="text"
																	class="form-control"
																	name="q_zone"
																	id="q_zone"
																/>
															</div>
														</div>
													</div>

													<div class="form-group">
														<div class="row">
															<div class="col-md-4">
																<label>Cubic Capacity</label>
															</div>
															<div class="col-md-8">
																<input
																	type="text"
																	class="form-control"
																	name="q_cubic_capactiy"
																	id="q_cubic_capactiy"
																/>
															</div>
														</div>
													</div>

													<div class="form-group">
														<div class="row">
															<div class="col-md-4">
																<label>Vechicle Classification</label>
															</div>
															<div class="col-md-8">
																<select
																	class="form-control"
																	name="q_vechi_classification"
																	id="q_vechi_classification"
																>
																	<option value="">--Select--</option>
																	<option value="small">Small</option>
																	<option value="Hatchback">Hatchback</option>
																	<option value="Midsize">Midsize</option>
																	<option value="High End">High End</option>
																	<option value="MPV/SUV">MPV/SUV</option>
																	<option value="Commercial">Commercial</option>
																</select>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>

									<div class="row">
										<div class="col-md-6">
											<div class="box">
												<div class="box-header with-border bg-warning">
													<h3 class="box-title">
														<i class="fa fa-money" aria-hidden="true"></i
														>&nbsp;&nbsp;Own Damage Premium
													</h3>
													<div class="box-tools pull-right">
														<button
															type="button"
															class="btn btn-box-tool"
															data-widget="collapse"
															data-toggle="tooltip"
															title=""
															data-original-title="Collapse"
														>
															<i class="fa fa-minus"></i>
														</button>
														<button
															type="button"
															class="btn btn-box-tool"
															data-widget="remove"
															data-toggle="tooltip"
															title=""
															data-original-title="Remove"
														>
															<i class="fa fa-times"></i>
														</button>
													</div>
												</div>
												<div class="box-body">
													<div class="form-group">
														<div class="row">
															<div class="col-md-4">
																<label>Basic OD</label>
															</div>
															<div class="col-md-4">
																<div class="input-group">
																	<input
																		type="text"
																		class="form-control"
																		style="text-align: right"
																		id="q_basic_od_percentage"
																	/>
																	<span class="input-group-addon">%</span>
																</div>
															</div>
															<div class="col-md-4">
																<input
																	type="text"
																	class="form-control"
																	style="text-align: right"
																	id="q_basic_od_amount"
																/>
															</div>
														</div>
													</div>

													<div class="form-group">
														<div class="row">
															<div class="col-md-4">
																<label>Special Discount</label>
															</div>
															<div class="col-md-4">
																<div class="input-group">
																	<input
																		type="text"
																		class="form-control"
																		style="text-align: right"
																		id="q_spl_dis_per"
																	/>
																	<span class="input-group-addon">%</span>
																</div>
															</div>
															<div class="col-md-4">
																<input
																	type="text"
																	class="form-control"
																	style="text-align: right"
																	id="q_spl_dis_amount"
																/>
															</div>
														</div>
													</div>

													<div class="form-group">
														<div class="row">
															<div class="col-md-4">
																<label>Special Loading</label>
															</div>
															<div class="col-md-4">
																<div class="input-group">
																	<input
																		type="text"
																		class="form-control"
																		style="text-align: right"
																		id="q_spl_loading_per"
																	/>
																	<span class="input-group-addon">%</span>
																</div>
															</div>
															<div class="col-md-4">
																<input
																	type="text"
																	class="form-control"
																	style="text-align: right"
																	id="q_spl_loading_amount"
																/>
															</div>
														</div>
													</div>

													<div class="form-group">
														<div class="row">
															<div class="col-md-4">
																<label>Non Basic OD</label>
															</div>
															<div class="col-md-8">
																<input
																	type="number"
																	class="form-control"
																	name="q_non_basic_od"
																	id="q_non_basic_od"
																	style="text-align: right"
																/>
															</div>
														</div>
													</div>

													<div class="form-group">
														<div class="row">
															<div class="col-md-4">
																<label>Non Electrical Accessories</label>
															</div>
															<div class="col-md-8">
																<input
																	type="number"
																	class="form-control"
																	name="q_non_elec_acc_amount"
																	id="q_non_elec_acc_amount"
																	style="text-align: right"
																/>
															</div>
														</div>
													</div>

													<div class="form-group">
														<div class="row">
															<div class="col-md-4">
																<label>Electrical Accessories</label>
															</div>
															<div class="col-md-8">
																<input
																	type="number"
																	class="form-control"
																	name="q_elec_acc_amount"
																	id="q_elec_acc_amount"
																	style="text-align: right"
																/>
															</div>
														</div>
													</div>

													<div class="form-group">
														<div class="row">
															<div class="col-md-4">
																<label>Bi-fuel Kit</label>
															</div>
															<div class="col-md-8">
																<input
																	type="number"
																	class="form-control"
																	name="q_bi_fuel_kit"
																	id="q_bi_fuel_kit"
																	style="text-align: right"
																/>
															</div>
														</div>
													</div>

													<div class="form-group">
														<div class="row">
															<div class="col-md-4">
																<label>Basic OD1</label>
															</div>
															<div class="col-md-8">
																<input
																	type="number"
																	class="form-control"
																	name="q_basic_od1"
																	id="q_basic_od1"
																	style="text-align: right"
																/>
															</div>
														</div>
													</div>

													<div class="form-group">
														<div class="row">
															<div class="col-md-4">
																<label>Geographical Area</label>
															</div>
															<div class="col-md-4">
																<select
																	class="form-control"
																	name="q_geographical_area"
																	id="q_geographical_area"
																>
																	<option value="">--Select--</option>
																	<option value="Yes">Yes</option>
																	<option value="No">No</option>
																</select>
															</div>

															<div class="col-md-4">
																<input
																	type="text"
																	class="form-control"
																	name="q_geographical_amount"
																	id="q_geographical_amount"
																/>
															</div>
														</div>
													</div>

													<div class="form-group">
														<div class="row">
															<div class="col-md-4">
																<label>Embassy Loading</label>
															</div>
															<div class="col-md-4">
																<select
																	class="form-control"
																	name="q_emp_loading"
																	id="q_emp_loading"
																>
																	<option value="">--Select--</option>
																	<option value="Yes">Yes</option>
																	<option value="No">No</option>
																</select>
															</div>

															<div class="col-md-4">
																<input
																	type="text"
																	class="form-control"
																	name="q_emp_loading_amount"
																	id="q_emp_loading_amount"
																/>
															</div>
														</div>
													</div>

													<div class="form-group">
														<div class="row">
															<div class="col-md-4">
																<label>Fiber Class Tank</label>
															</div>
															<div class="col-md-4">
																<select
																	class="form-control"
																	name="q_fiber_class_tank"
																	id="q_fiber_class_tank"
																>
																	<option value="">--Select--</option>
																	<option value="Yes">Yes</option>
																	<option value="No">No</option>
																</select>
															</div>

															<div class="col-md-4">
																<input
																	type="text"
																	class="form-control"
																	name="q_fiber_class_tank_amount"
																	id="q_fiber_class_tank_amount"
																/>
															</div>
														</div>
													</div>

													<div class="form-group">
														<div class="row">
															<div class="col-md-4">
																<label>Driving Tuitions</label>
															</div>
															<div class="col-md-4">
																<select
																	class="form-control"
																	name="q_driving_tuitions"
																	id="q_driving_tuitions"
																>
																	<option value="">--Select--</option>
																	<option value="Yes">Yes</option>
																	<option value="No">No</option>
																</select>
															</div>

															<div class="col-md-4">
																<input
																	type="text"
																	class="form-control"
																	name="q_driving_tuitions_amount"
																	id="q_driving_tuitions_amount"
																/>
															</div>
														</div>
													</div>

													<div class="form-group">
														<div class="row">
															<div class="col-md-4">
																<label>Basic OD2</label>
															</div>
															<div class="col-md-4">
																<select
																	class="form-control"
																	name="q_basic_od2"
																	id="q_basic_od2"
																>
																	<option value="">--Select--</option>
																	<option value="Yes">Yes</option>
																	<option value="No">No</option>
																</select>
															</div>

															<div class="col-md-4">
																<input
																	type="text"
																	class="form-control"
																	name="q_basic_od2_amount"
																	id="q_basic_od2_amount"
																/>
															</div>
														</div>
													</div>

													<p align="center">Discounts</p>

													<div class="form-group">
														<div class="row">
															<div class="col-md-4">
																<label>Anti Theft</label>
															</div>
															<div class="col-md-4">
																<select
																	class="form-control"
																	name="q_anti_theft"
																	id="q_anti_theft"
																>
																	<option value="">--Select--</option>
																	<option value="Yes">Yes</option>
																	<option value="No">No</option>
																</select>
															</div>

															<div class="col-md-4">
																<input
																	type="text"
																	class="form-control"
																	name="q_anti_theft_amount"
																	id="q_anti_theft_amount"
																/>
															</div>
														</div>
													</div>

													<div class="form-group">
														<div class="row">
															<div class="col-md-4">
																<label>Handicap</label>
															</div>
															<div class="col-md-4">
																<select
																	class="form-control"
																	name="q_anti_handicap"
																	id="q_anti_handicap"
																>
																	<option value="">--Select--</option>
																	<option value="Yes">Yes</option>
																	<option value="No">No</option>
																</select>
															</div>

															<div class="col-md-4">
																<input
																	type="text"
																	class="form-control"
																	name="q_anti_handicap_amount"
																	id="q_anti_handicap_amount"
																/>
															</div>
														</div>
													</div>

													<div class="form-group">
														<div class="row">
															<div class="col-md-4">
																<label>AAI</label>
															</div>
															<div class="col-md-4">
																<select
																	class="form-control"
																	name="q_aai"
																	id="q_aai"
																>
																	<option value="">--Select--</option>
																	<option value="Yes">Yes</option>
																	<option value="No">No</option>
																</select>
															</div>

															<div class="col-md-4">
																<input
																	type="text"
																	class="form-control"
																	name="q_aai_amount"
																	id="q_aai_amount"
																/>
															</div>
														</div>
													</div>

													<div class="form-group">
														<div class="row">
															<div class="col-md-4">
																<label>Voluntary Deductable</label>
															</div>
															<div class="col-md-4">
																<select
																	class="form-control"
																	name="q_voluntary_deductable"
																	id="q_voluntary_deductable"
																>
																	<option value="">--Select--</option>
																	<option value="Yes">Yes</option>
																	<option value="No">No</option>
																</select>
															</div>

															<div class="col-md-4">
																<input
																	type="text"
																	class="form-control"
																	name="q_voluntary_deductable_amount"
																	id="q_voluntary_deductable_amount"
																/>
															</div>
														</div>
													</div>

													<hr />

													<div class="form-group">
														<div class="row">
															<div class="col-md-4">
																<label>Basic OD3</label>
															</div>
															<div class="col-md-8">
																<input
																	type="text"
																	class="form-control"
																	name="q_basic_od_3"
																	id="q_basic_od_3"
																	style="text-align: right"
																/>
															</div>
														</div>
													</div>

													<div class="form-group">
														<div class="row">
															<div class="col-md-4">
																<label>NCB</label>
															</div>
															<div class="col-md-4">
																<div class="input-group">
																	<input
																		type="text"
																		class="form-control"
																		style="text-align: right"
																		id="q_ncb_percentage"
																	/>
																	<span class="input-group-addon">%</span>
																</div>
															</div>
															<div class="col-md-4">
																<input
																	type="text"
																	class="form-control"
																	style="text-align: right"
																	id="q_ncb_percentage_amount"
																/>
															</div>
														</div>
													</div>

													<div class="form-group">
														<div class="row">
															<div class="col-md-4">
																<label>Total OD Premium (A)</label>
															</div>
															<div class="col-md-8">
																<input
																	type="text"
																	class="form-control"
																	name="q_tot_od_premium"
																	id="q_tot_od_premium"
																	style="text-align: right"
																/>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>

										<div class="col-md-6">
											<div class="box">
												<div class="box-header with-border bg-warning">
													<h3 class="box-title">
														<i class="fa fa-money" aria-hidden="true"></i
														>&nbsp;&nbsp;Third Party Premium
													</h3>
													<div class="box-tools pull-right">
														<button
															type="button"
															class="btn btn-box-tool"
															data-widget="collapse"
															data-toggle="tooltip"
															title=""
															data-original-title="Collapse"
														>
															<i class="fa fa-minus"></i>
														</button>
														<button
															type="button"
															class="btn btn-box-tool"
															data-widget="remove"
															data-toggle="tooltip"
															title=""
															data-original-title="Remove"
														>
															<i class="fa fa-times"></i>
														</button>
													</div>
												</div>
												<div class="box-body">
													<div class="form-group">
														<div class="row">
															<div class="col-md-4">
																<label>Basic TP</label><span>*</span>
															</div>
															<div class="col-md-8">
																<input
																	type="number"
																	class="form-control"
																	name="q_basic_tp"
																	id="q_basic_tp"
																/>
															</div>
														</div>
													</div>

													<div class="form-group">
														<div class="row">
															<div class="col-md-4">
																<label>Bi Fuel Kit</label>
															</div>
															<div class="col-md-8">
																<input
																	type="number"
																	class="form-control"
																	name="q_fuel_kit_amt"
																	id="q_fuel_kit_amt"
																/>
															</div>
														</div>
													</div>

													<div class="form-group">
														<div class="row">
															<div class="col-md-4">
																<label>Basic TP1</label>
															</div>
															<div class="col-md-8">
																<input
																	type="number"
																	class="form-control"
																	name="q_basic_tp1"
																	id="q_basic_tp1"
																	style="text-align: right"
																/>
															</div>
														</div>
													</div>

													<div class="form-group">
														<div class="row">
															<div class="col-md-4">
																<label>Geograpical Area</label>
															</div>
															<div class="col-md-8">
																<input
																	type="text"
																	class="form-control"
																	name="q_geograpical_amt"
																	id="q_geograpical_amt"
																/>
															</div>
														</div>
													</div>

													<div class="form-group">
														<div class="row">
															<div class="col-md-4">
																<label>Owner Driver PA</label><span>*</span>
															</div>
															<div class="col-md-8">
																<input
																	type="number"
																	class="form-control"
																	name="q_owner_diver_amt"
																	id="q_owner_diver_amt"
																/>
															</div>
														</div>
													</div>

													<div class="form-group">
														<div class="row">
															<div class="col-md-4">
																<label style="font-style: italic"
																	>No of year(Own Drv PA)</label
																>
															</div>
															<div class="col-md-8">
																<select
																	class="form-control"
																	name="q_no_of_year_own_drv"
																	id="q_no_of_year_own_drv"
																>
																	<option value="">--select--</option>
																	<option value="1">1</option>
																	<option value="2">2</option>
																	<option value="3">3</option>
																	<option value="4">4</option>
																	<option value="5">5</option>
																	<option value="6">6</option>
																	<option value="7">7</option>
																</select>
															</div>
														</div>
													</div>

													<div class="form-group">
														<div class="row">
															<div class="col-md-4">
																<label>Un Named Passenger PA</label>
															</div>
															<div class="col-md-4">
																<select
																	class="form-control"
																	name="q_un_named_passenger_pa"
																	id="q_un_named_passenger_pa"
																>
																	<option value="">--Select--</option>
																	<option value="Yes">Yes</option>
																	<option value="No">No</option>
																</select>
															</div>

															<div class="col-md-4">
																<input
																	type="text"
																	class="form-control"
																	name="q_un_named_passenger_amt"
																	id="q_un_named_passenger_amt"
																/>
															</div>
														</div>
													</div>

													<div class="form-group">
														<div class="row">
															<div class="col-md-4">
																<label style="font-style: italic"
																	>No of seats Limit Per Person</label
																>
															</div>
															<div class="col-md-4">
																<input
																	type="text"
																	class="form-control"
																	name="q_no_seats_per_person"
																	id="q_no_seats_per_person"
																/>
															</div>
															<div class="col-md-4">
																<input
																	type="text"
																	class="form-control"
																	name="q_no_seats_per_person_amt"
																	id="q_no_seats_per_person_amt"
																/>
															</div>
														</div>
													</div>

													<div class="form-group">
														<div class="row">
															<div class="col-md-4">
																<label>LL to paid Drv/Emp</label>
															</div>
															<div class="col-md-4">
																<select
																	class="form-control"
																	name="q_llp"
																	id="q_llp"
																>
																	<option value="">--Select--</option>
																	<option value="Yes">Yes</option>
																	<option value="No">No</option>
																</select>
															</div>

															<div class="col-md-4">
																<input
																	type="text"
																	class="form-control"
																	name="q_llp_amt"
																	id="q_llp_amt"
																/>
															</div>
														</div>
													</div>

													<div class="form-group">
														<div class="row">
															<div class="col-md-4">
																<label>No of Drv/Emp</label>
															</div>
															<div class="col-md-8">
																<input
																	type="text"
																	class="form-control"
																	name="q_no_drv_emp"
																	id="q_no_drv_emp"
																/>
															</div>
														</div>
													</div>

													<div class="form-group">
														<div class="row">
															<div class="col-md-4">
																<label>PA Paid Drv</label><span>*</span>
															</div>
															<div class="col-md-4">
																<select
																	class="form-control"
																	name="q_pa_paid_drv"
																	id="q_pa_paid_drv"
																>
																	<option value="">--Select--</option>
																	<option value="Yes">Yes</option>
																	<option value="No">No</option>
																</select>
															</div>

															<div class="col-md-4">
																<input
																	type="text"
																	class="form-control"
																	name="q_pa_paid_drv_amt"
																	id="q_pa_paid_drv_amt"
																/>
															</div>
														</div>
													</div>

													<div class="form-group">
														<div class="row">
															<div class="col-md-4">
																<label style="font-style: italic"
																	>No of seats Limit Per Person</label
																>
															</div>
															<div class="col-md-4">
																<input
																	type="text"
																	class="form-control"
																	name="q_no_seats_per_person1"
																	id="q_no_seats_per_person1"
																/>
															</div>
															<div class="col-md-4">
																<input
																	type="text"
																	class="form-control"
																	name="q_no_seats_per_person_amt1"
																	id="q_no_seats_per_person_amt1"
																/>
															</div>
														</div>
													</div>

													<div class="form-group">
														<div class="row">
															<div class="col-md-4">
																<label>Total TP Premium (B)</label>
															</div>
															<div class="col-md-8">
																<input
																	type="text"
																	class="form-control"
																	name="q_tot_tp_premium"
																	id="q_tot_tp_premium"
																	style="text-align: right"
																/>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>

										<div class="col-md-6">
											<div class="box">
												<div class="box-header with-border bg-warning">
													<h3 class="box-title">
														<i class="fa fa-money" aria-hidden="true"></i
														>&nbsp;&nbsp;Add-On Covers Premium
													</h3>
													<div class="box-tools pull-right">
														<button
															type="button"
															class="btn btn-box-tool"
															data-widget="collapse"
															data-toggle="tooltip"
															title=""
															data-original-title="Collapse"
														>
															<i class="fa fa-minus"></i>
														</button>
														<button
															type="button"
															class="btn btn-box-tool"
															data-widget="remove"
															data-toggle="tooltip"
															title=""
															data-original-title="Remove"
														>
															<i class="fa fa-times"></i>
														</button>
													</div>
												</div>
												<div class="box-body">
													<div class="form-group">
														<div class="row">
															<div class="col-md-4">
																<label>Add-on Combo Plan</label><span>*</span>
															</div>
															<div class="col-md-8">
																<select
																	class="form-control"
																	name="q_add_on_combo_premium"
																	id="q_add_on_combo_premium"
																>
																	<option value="">--Select--</option>
																</select>
															</div>
														</div>
													</div>

													<div class="form-group">
														<div class="row">
															<div class="col-md-4">
																<label>Add On Plan Premium</label>
															</div>

															<div class="col-md-4">
																<div class="input-group">
																	<input
																		type="text"
																		class="form-control"
																		style="text-align: right"
																		id="q_add_on_plan_premium_percentage"
																	/>
																	<span class="input-group-addon">%</span>
																</div>
															</div>

															<div class="col-md-4">
																<input
																	type="number"
																	class="form-control"
																	name="q_add_on_plan_premium"
																	id="q_add_on_plan_premium"
																	style="text-align: right"
																/>
															</div>
														</div>
													</div>

													<div class="form-group">
														<div class="row">
															<div class="col-md-4">
																<label>Zero Depreciation</label>
															</div>

															<div class="col-md-1">
																<div
																	class="icheck-primary"
																	bis_skin_checked="1"
																>
																	<input
																		type="checkbox"
																		class="form-check-input"
																		id="q_zero_depreciation_check"
																		name="q_zero_depreciation_check"
																		value="Yes"
																	/>
																</div>
															</div>

															<div class="col-md-3">
																<div class="input-group">
																	<input
																		type="text"
																		class="form-control"
																		style="text-align: right"
																		id="q_zero_depreciation_percentage"
																	/>
																	<span class="input-group-addon">%</span>
																</div>
															</div>

															<div class="col-md-4">
																<input
																	type="number"
																	class="form-control"
																	name="q_zero_depreciation_amt"
																	id="q_zero_depreciation_amt"
																	style="text-align: right"
																/>
															</div>
														</div>
													</div>

													<div class="form-group">
														<div class="row">
															<div class="col-md-4">
																<label>RSA/Additional For Addons</label>
															</div>

															<div class="col-md-1">
																<div
																	class="icheck-primary"
																	bis_skin_checked="1"
																>
																	<input
																		type="checkbox"
																		class="form-check-input"
																		id="q_addtional_addons_check"
																		name="q_addtional_addons_check"
																		value="Yes"
																	/>
																</div>
															</div>

															<div class="col-md-7">
																<input
																	type="number"
																	class="form-control"
																	name="q_addtional_addons_amt"
																	id="q_addtional_addons_amt"
																	style="text-align: right"
																/>
															</div>
														</div>
													</div>

													<div class="form-group">
														<div class="row">
															<div class="col-md-4">
																<label>Consumbles</label>
															</div>

															<div class="col-md-1">
																<div
																	class="icheck-primary"
																	bis_skin_checked="1"
																>
																	<input
																		type="checkbox"
																		class="form-check-input"
																		id="q_consumbles_check"
																		name="q_consumbles_check"
																		value="Yes"
																	/>
																</div>
															</div>

															<div class="col-md-3">
																<div class="input-group">
																	<input
																		type="text"
																		class="form-control"
																		style="text-align: right"
																		id="q_consumbles_percentage"
																	/>
																	<span class="input-group-addon">%</span>
																</div>
															</div>

															<div class="col-md-4">
																<input
																	type="number"
																	class="form-control"
																	name="q_consumbles_amt"
																	id="q_consumbles_amt"
																	style="text-align: right"
																/>
															</div>
														</div>
													</div>

													<div class="form-group">
														<div class="row">
															<div class="col-md-4">
																<label>Tyre Cover</label>
															</div>

															<div class="col-md-1">
																<div
																	class="icheck-primary"
																	bis_skin_checked="1"
																>
																	<input
																		type="checkbox"
																		class="form-check-input"
																		id="q_consumbles_check"
																		name="q_tyre_cover"
																		value="Yes"
																	/>
																</div>
															</div>

															<div class="col-md-3">
																<div class="input-group">
																	<input
																		type="text"
																		class="form-control"
																		style="text-align: right"
																		id="q_tyre_cover_percentage"
																	/>
																	<span class="input-group-addon">%</span>
																</div>
															</div>

															<div class="col-md-4">
																<input
																	type="number"
																	class="form-control"
																	name="q_tyre_cover_amt"
																	id="q_tyre_cover_amt"
																	style="text-align: right"
																/>
															</div>
														</div>
													</div>

													<div class="form-group">
														<div class="row">
															<div class="col-md-4">
																<label>NCB Protection</label>
															</div>

															<div class="col-md-1">
																<div
																	class="icheck-primary"
																	bis_skin_checked="1"
																>
																	<input
																		type="checkbox"
																		class="form-check-input"
																		id="q_ncb_protection_check"
																		name="q_ncb_protection_check"
																		value="Yes"
																	/>
																</div>
															</div>

															<div class="col-md-3">
																<div class="input-group">
																	<input
																		type="text"
																		class="form-control"
																		style="text-align: right"
																		id="q_ncb_protection_percentage"
																	/>
																	<span class="input-group-addon">%</span>
																</div>
															</div>

															<div class="col-md-4">
																<input
																	type="number"
																	class="form-control"
																	name="q_ncb_protection_amt"
																	id="q_ncb_protection_amt"
																	style="text-align: right"
																/>
															</div>
														</div>
													</div>

													<div class="form-group">
														<div class="row">
															<div class="col-md-4">
																<label>Engine Protector</label>
															</div>

															<div class="col-md-1">
																<div
																	class="icheck-primary"
																	bis_skin_checked="1"
																>
																	<input
																		type="checkbox"
																		class="form-check-input"
																		id="q_engine_protector_check"
																		name="q_engine_protector_check"
																		value="Yes"
																	/>
																</div>
															</div>

															<div class="col-md-3">
																<div class="input-group">
																	<input
																		type="text"
																		class="form-control"
																		style="text-align: right"
																		id="q_engine_protector_percentage"
																	/>
																	<span class="input-group-addon">%</span>
																</div>
															</div>

															<div class="col-md-4">
																<input
																	type="number"
																	class="form-control"
																	name="q_engine_protector_amt"
																	id="q_engine_protector_amt"
																	style="text-align: right"
																/>
															</div>
														</div>
													</div>

													<div class="form-group">
														<div class="row">
															<div class="col-md-4">
																<label>Return To Invoice</label>
															</div>

															<div class="col-md-1">
																<div
																	class="icheck-primary"
																	bis_skin_checked="1"
																>
																	<input
																		type="checkbox"
																		class="form-check-input"
																		id="q_return_to_invoice_check"
																		name="q_return_to_invoice_check"
																		value="Yes"
																	/>
																</div>
															</div>

															<div class="col-md-3">
																<div class="input-group">
																	<input
																		type="text"
																		class="form-control"
																		style="text-align: right"
																		id="q_return_to_invoice_percentage"
																	/>
																	<span class="input-group-addon">%</span>
																</div>
															</div>

															<div class="col-md-4">
																<input
																	type="number"
																	class="form-control"
																	name="q_return_to_invoice_amt"
																	id="q_return_to_invoice_amt"
																	style="text-align: right"
																/>
															</div>
														</div>
													</div>

													<div class="form-group">
														<div class="row">
															<div class="col-md-4">
																<label>Key and Lock Replacement</label>
															</div>

															<div class="col-md-1">
																<div
																	class="icheck-primary"
																	bis_skin_checked="1"
																>
																	<input
																		type="checkbox"
																		class="form-check-input"
																		id="q_key_replacement_check"
																		name="q_key_replacement_check"
																		value="Yes"
																	/>
																</div>
															</div>

															<div class="col-md-3">
																<div class="input-group">
																	<input
																		type="text"
																		class="form-control"
																		style="text-align: right"
																		id="q_key_replacement_percentage"
																	/>
																	<span class="input-group-addon">%</span>
																</div>
															</div>

															<div class="col-md-4">
																<input
																	type="number"
																	class="form-control"
																	name="q_key_replacement_amt"
																	id="q_key_replacement_amt"
																	style="text-align: right"
																/>
															</div>
														</div>
													</div>

													<div class="form-group">
														<div class="row">
															<div class="col-md-4">
																<label>Daily / InConvinience Allowance</label>
															</div>

															<div class="col-md-1">
																<div
																	class="icheck-primary"
																	bis_skin_checked="1"
																>
																	<input
																		type="checkbox"
																		class="form-check-input"
																		id="q_daily_allow_check"
																		name="q_daily_allow_check"
																		value="Yes"
																	/>
																</div>
															</div>

															<div class="col-md-3">
																<div class="input-group">
																	<input
																		type="text"
																		class="form-control"
																		style="text-align: right"
																		id="q_daily_allow_percentage"
																	/>
																	<span class="input-group-addon">%</span>
																</div>
															</div>

															<div class="col-md-4">
																<input
																	type="number"
																	class="form-control"
																	name="q_daily_allow_amt"
																	id="q_daily_allow_amt"
																	style="text-align: right"
																/>
															</div>
														</div>
													</div>

													<div class="form-group">
														<div class="row">
															<div class="col-md-4">
																<label>Loss of personal Belongies</label>
															</div>

															<div class="col-md-1">
																<div
																	class="icheck-primary"
																	bis_skin_checked="1"
																>
																	<input
																		type="checkbox"
																		class="form-check-input"
																		id="q_loss_of_belong_check"
																		name="q_loss_of_belong_check"
																		value="Yes"
																	/>
																</div>
															</div>

															<div class="col-md-3">
																<div class="input-group">
																	<input
																		type="text"
																		class="form-control"
																		style="text-align: right"
																		id="q_loss_of_belong_percentage"
																	/>
																	<span class="input-group-addon">%</span>
																</div>
															</div>

															<div class="col-md-4">
																<input
																	type="number"
																	class="form-control"
																	name="q_loss_of_belong_amt"
																	id="q_loss_of_belong_amt"
																	style="text-align: right"
																/>
															</div>
														</div>
													</div>

													<div class="form-group">
														<div class="row">
															<div class="col-md-4">
																<label>Hotel & Travel Expenses</label>
															</div>

															<div class="col-md-1">
																<div
																	class="icheck-primary"
																	bis_skin_checked="1"
																>
																	<input
																		type="checkbox"
																		class="form-check-input"
																		id="q_hotel_trvl_check"
																		name="q_hotel_trvl_check"
																		value="Yes"
																	/>
																</div>
															</div>

															<div class="col-md-3">
																<div class="input-group">
																	<input
																		type="text"
																		class="form-control"
																		style="text-align: right"
																		id="q_hotel_trvl_percentage"
																	/>
																	<span class="input-group-addon">%</span>
																</div>
															</div>

															<div class="col-md-4">
																<input
																	type="number"
																	class="form-control"
																	name="q_hotel_trvl_amt"
																	id="q_hotel_trvl_amt"
																	style="text-align: right"
																/>
															</div>
														</div>
													</div>

													<div class="form-group">
														<div class="row">
															<div class="col-md-4">
																<label>Wind Shield Glass</label>
															</div>

															<div class="col-md-1">
																<div
																	class="icheck-primary"
																	bis_skin_checked="1"
																>
																	<input
																		type="checkbox"
																		class="form-check-input"
																		id="q_wind_shield_check"
																		name="q_wind_shield_check"
																		value="Yes"
																	/>
																</div>
															</div>

															<div class="col-md-3">
																<div class="input-group">
																	<input
																		type="text"
																		class="form-control"
																		style="text-align: right"
																		id="q_wind_shield_percentage"
																	/>
																	<span class="input-group-addon">%</span>
																</div>
															</div>

															<div class="col-md-4">
																<input
																	type="number"
																	class="form-control"
																	name="q_wind_shield_amt"
																	id="q_wind_shield_amt"
																	style="text-align: right"
																/>
															</div>
														</div>
													</div>

													<div class="form-group">
														<div class="row">
															<div class="col-md-4">
																<label>Baggage Insurance</label>
															</div>

															<div class="col-md-1">
																<div
																	class="icheck-primary"
																	bis_skin_checked="1"
																>
																	<input
																		type="checkbox"
																		class="form-check-input"
																		id="q_baggage_ins_check"
																		name="q_baggage_ins_check"
																		value="Yes"
																	/>
																</div>
															</div>

															<div class="col-md-3">
																<div class="input-group">
																	<input
																		type="text"
																		class="form-control"
																		style="text-align: right"
																		id="q_baggage_ins_percentage"
																	/>
																	<span class="input-group-addon">%</span>
																</div>
															</div>

															<div class="col-md-4">
																<input
																	type="number"
																	class="form-control"
																	name="q_baggage_ins_amt"
																	id="q_baggage_ins_amt"
																	style="text-align: right"
																/>
															</div>
														</div>
													</div>

													<div class="form-group">
														<div class="row">
															<div class="col-md-4">
																<label>Other Add-On Coverage</label>
															</div>

															<div class="col-md-4">
																<div class="input-group">
																	<input
																		type="text"
																		class="form-control"
																		style="text-align: right"
																		id="q_other_add_on_coverag_per"
																	/>
																	<span class="input-group-addon">%</span>
																</div>
															</div>

															<div class="col-md-4">
																<input
																	type="number"
																	class="form-control"
																	name="q_other_add_on_coverage_amt"
																	id="q_other_add_on_coverage_amt"
																	style="text-align: right"
																	value="0"
																/>
															</div>
														</div>
													</div>

													<div class="form-group">
														<div class="row">
															<div class="col-md-4">
																<label>Value Added Services</label>
															</div>
															<div class="col-md-8">
																<input
																	type="number"
																	class="form-control"
																	name="q_value_added_services"
																	id="q_value_added_services"
																	style="text-align: right"
																/>
															</div>
														</div>
													</div>

													<div class="form-group">
														<div class="row">
															<div class="col-md-4">
																<label>Net Add-on Cover Premium</label>
															</div>
															<div class="col-md-8">
																<input
																	type="number"
																	class="form-control"
																	name="q_net_addon_cover_premium"
																	id="q_net_addon_cover_premium"
																	style="text-align: right"
																	value="0"
																/>
															</div>
														</div>
													</div>

													<div class="form-group">
														<div class="row">
															<div class="col-md-4">
																<label>Add-on Discount</label>
															</div>

															<div class="col-md-4">
																<div class="input-group">
																	<input
																		type="text"
																		class="form-control"
																		style="text-align: right"
																		id="q_add_on_discount_percentage"
																	/>
																	<span class="input-group-addon">%</span>
																</div>
															</div>

															<div class="col-md-4">
																<input
																	type="number"
																	class="form-control"
																	name="q_add_on_discount_amt"
																	id="q_add_on_discount_amt"
																	style="text-align: right"
																	value="0"
																/>
															</div>
														</div>
													</div>

													<div class="form-group">
														<div class="row">
															<div class="col-md-4">
																<label>Total Add-on Cover Premium(C) </label>
															</div>

															<div class="col-md-8">
																<input
																	type="number"
																	class="form-control"
																	name="q_tot_add_on_cover_premium"
																	id="q_tot_add_on_cover_premium"
																	style="text-align: right"
																	value="0"
																/>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>

									<div class="box">
										<div class="box-header with-border bg-warning">
											<h3 class="box-title">
												<i class="fa fa-money" aria-hidden="true"></i
												>&nbsp;&nbsp;Total Premium
											</h3>
											<div class="box-tools pull-right">
												<button
													type="button"
													class="btn btn-box-tool"
													data-widget="collapse"
													data-toggle="tooltip"
													title=""
													data-original-title="Collapse"
												>
													<i class="fa fa-minus"></i>
												</button>
												<button
													type="button"
													class="btn btn-box-tool"
													data-widget="remove"
													data-toggle="tooltip"
													title=""
													data-original-title="Remove"
												>
													<i class="fa fa-times"></i>
												</button>
											</div>
										</div>
										<div class="box-body">
											<div class="row">
												<div class="col-md-6">
													<div class="form-group">
														<div class="row">
															<div class="col-md-4">
																<label>Total Premium (A+B+C)</label
																><span>*</span>
															</div>
															<div class="col-md-8">
																<input
																	type="text"
																	class="form-control"
																	name="q_total_premium"
																	id="q_total_premium"
																/>
															</div>
														</div>
													</div>

													<div class="form-group">
														<div class="row">
															<div class="col-md-4">
																<label>GST(18%)</label><span>*</span>
															</div>
															<div class="col-md-8">
																<input
																	type="text"
																	class="form-control"
																	name="q_gst"
																	id="q_gst"
																/>
															</div>
														</div>
													</div>
												</div>

												<div class="col-md-6">
													<div class="form-group">
														<div class="row">
															<div class="col-md-4">
																<label>Total Payable</label>
															</div>
															<div class="col-md-8">
																<input
																	type="text"
																	class="form-control"
																	name="q_total_payable"
																	id="q_total_payable"
																/>
															</div>
														</div>
													</div>

													<div class="form-group">
														<div class="row">
															<div class="col-md-4">
																<label>OD + Commission Base Premium</label>
															</div>
															<div class="col-md-8">
																<input
																	type="text"
																	class="form-control"
																	name="q_commission_base_premium"
																	id="q_commission_base_premium"
																	style="text-align: right"
																/>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="modal-footer">
									<button
										type="button"
										class="btn btn-default"
										data-dismiss="modal"
									>
										Close
									</button>
								</div>
							</div>
						</div>
					</div>

					<div id="sme_modal" class="modal fade" role="dialog">
						<div class="modal-dialog modal-lg">
							<div class="modal-content modal-lg-content">
								<div class="modal-header" style="background: #778d9d">
									<button type="button" class="close" data-dismiss="modal">
										&times;
									</button>
									<h4 class="modal-title" style="color: #fff">SME Details</h4>
									<button
										class="btn btn-success btn-sm pull-right"
										id="add_sme_info"
										style="margin-top: -31px; margin-right: 27px"
									>
										<i class="fa fa-save"></i> Save
									</button>
								</div>
								<div class="modal-body">
									<section class="content">
										<div class="box">
											<div
												class="box-header with-border"
												style="background: #f4f4f48c"
											>
												<h3
													class="box-title"
													_msthash="26273"
													_msttexthash="60619"
													style="text-align: left; font-size: 14px"
												>
													<i class="fa fa-user" aria-hidden="true"></i>
													&nbsp;&nbsp;SME Details
												</h3>

												<div class="box-tools pull-right">
													<button
														type="button"
														class="btn btn-box-tool"
														data-widget="collapse"
														data-toggle="tooltip"
														title=""
														data-original-title="Collapse"
													>
														<i class="fa fa-minus"></i>
													</button>
												</div>
											</div>

											<div
												class="box-body"
												_msthash="1196936"
												_msttexthash="1190501"
												style="text-align: left"
											>
												<div class="row">
													<div class="col-md-6">
														<div class="form-group">
															<div class="row">
																<div class="col-md-4">
																	<label>SME Policy</label>
																</div>
																<div class="col-md-8">
																	<select
																		class="form-control"
																		name="sme_id"
																		id="sme_id"
																	>
																		<option value="">--select--</option>
																	</select>
																</div>
															</div>
														</div>
														<div class="hidden" id="marine">
															<div class="form-group">
																<div class="row">
																	<div class="col-md-4">
																		<label>Period of Insurance</label>
																	</div>
																	<div class="col-md-4">
																		<input
																			type="date"
																			class="form-control"
																			name="from_date"
																			id="from_date"
																		/>
																	</div>

																	<div class="col-md-4">
																		<input
																			type="date"
																			class="form-control"
																			name="to_date"
																			id="to_date"
																		/>
																	</div>
																</div>
															</div>

															<div class="form-group">
																<div class="row">
																	<div class="col-md-4">
																		<label>Commodity/ Interest</label>
																	</div>
																	<div class="col-md-8">
																		<input
																			type="text"
																			class="form-control"
																			name="commodity_interest"
																			id="commodity_interest"
																			value="Industrial Oil, Furnace Oil, Fuel oil , low and High density oil,industrial mixed solvent , Base Oil , Low aromatic white spirit"
																		/>
																	</div>
																</div>
															</div>

															<div class="form-group">
																<div class="row">
																	<div class="col-md-4">
																		<label>Basis of Valuation</label>
																	</div>
																</div>
																<div class="row">
																	<div class="col-md-4">
																		<label>Import</label>
																		<textarea
																			class="form-control"
																			name="b_valuation_import"
																			id="b_valuation_import"
																			rows="3"
																		>
C&F / FOB / Exworks / CIF) + 10% + Duty at Actuals</textarea
																		>
																	</div>

																	<div class="col-md-4">
																		<label>Export</label>
																		<textarea
																			class="form-control"
																			name="b_valuation_export"
																			id="b_valuation_export"
																			rows="3"
																		>
CIF + 10%, FOB + 20%</textarea
																		>
																	</div>

																	<div class="col-md-3">
																		<label>Inland</label>
																		<textarea
																			class="form-control"
																			name="b_valuation_inland"
																			id="b_valuation_inland"
																			rows="3"
																		>
Invoice + 10% Interdepot /Interunit Transfers (Stock Transfer Note Value / InvoiceValue / Consignment Note Value) + Freight at Actuals</textarea
																		>
																	</div>
																</div>
															</div>

															<div class="form-group">
																<div class="row">
																	<div class="col-md-4">
																		<label>Annual Sales Turnover</label>
																	</div>
																	<div class="col-md-8">
																		<input
																			type="text"
																			class="form-control"
																			name="add_turnover"
																			id="add_turnover"
																		/>
																	</div>
																</div>
															</div>

															<div class="row">
																<div class="col-md-4">
																	<label style="color: #2e86c1">Sales:</label>
																</div>
															</div>

															<div class="form-group">
																<div class="row">
																	<div class="col-md-4">
																		<label>Domestic</label>
																	</div>
																	<div class="col-md-8">
																		<input
																			type="text"
																			class="form-control"
																			name="add_domestic"
																			id="add_domestic"
																		/>
																	</div>
																</div>
															</div>

															<div class="row">
																<div class="col-md-4">
																	<label style="color: #2e86c1"
																		>Purchase:</label
																	>
																</div>
															</div>

															<div class="form-group">
																<div class="row">
																	<div class="col-md-4">
																		<label>Import</label>
																	</div>
																	<div class="col-md-8">
																		<input
																			type="text"
																			class="form-control"
																			name="add_import"
																			id="add_import"
																		/>
																	</div>
																</div>
															</div>

															<div class="form-group">
																<div class="row">
																	<div class="col-md-4">
																		<label>Per Bottom Limit (Inland)</label>
																	</div>
																	<div class="col-md-8">
																		<input
																			type="text"
																			class="form-control"
																			name="bottom_inland_limit"
																			id="bottom_inland_limit"
																		/>
																	</div>
																</div>
															</div>

															<div class="form-group">
																<div class="row">
																	<div class="col-md-4">
																		<label>Per Location Limit (Inland)</label>
																	</div>
																	<div class="col-md-8">
																		<input
																			type="text"
																			class="form-control"
																			name="location_inland"
																			id="location_inland"
																		/>
																	</div>
																</div>
															</div>

															<div class="form-group">
																<div class="row">
																	<div class="col-md-4">
																		<label>Covering Clauses</label>
																	</div>
																	<div class="col-md-8">
																		<div class="row">
																			<div class="col-md-8">
																				<input
																					type="text"
																					style="margin: 5px; width: 97%"
																					id="covering_clauses"
																					class="form-control coveringclauses"
																				/>
																				<div id="add_covering_clauses"></div>
																			</div>
																			<div class="col-md-4">
																				<button
																					id="sub_covering_btn"
																					class="btn btn-info btn-sm pull-right"
																				>
																					-
																				</button>
																				<button
																					id="add_covering_btn"
																					class="btn btn-info btn-sm pull-right"
																					style="margin-right: 5px"
																				>
																					+
																				</button>
																			</div>
																		</div>
																	</div>
																</div>
															</div>

															<div class="form-group">
																<div class="row">
																	<div class="col-md-4">
																		<label>Date</label>
																	</div>
																	<div class="col-md-8">
																		<input
																			type="date"
																			class="form-control"
																			name="date"
																			id="date"
																		/>
																	</div>
																</div>
															</div>
														</div>
													</div>
													<div class="col-md-6">
														<div class="hidden" id="marine_remove">
															<div class="form-group">
																<div class="row">
																	<div class="col-md-4">
																		<label>Packing</label>
																	</div>
																	<div class="col-md-8">
																		<input
																			type="text"
																			class="form-control"
																			name="packing"
																			id="packing"
																		/>
																	</div>
																</div>
															</div>

															<div class="form-group">
																<div class="row">
																	<div class="col-md-4">
																		<label>Occupancy</label>
																	</div>
																	<div class="col-md-8">
																		<input
																			type="text"
																			class="form-control"
																			name="occupancy"
																			id="occupancy"
																		/>
																	</div>
																</div>
															</div>

															<div class="form-group">
																<div class="row">
																	<div class="col-md-4">
																		<label>Mode of Transport</label>
																	</div>
																	<div class="col-md-8">
																		<select
																			class="form-control"
																			name="transport"
																			id="transport"
																		>
																			<option value="">--Select--</option>
																			<option value="Rail">Rail</option>
																			<option value="Road">Road</option>
																			<option value="Air">Air</option>
																			<option value="Sea">Sea</option>
																		</select>
																	</div>
																</div>
															</div>

															<div class="form-group">
																<div class="row">
																	<div class="col-md-4">
																		<label>Voyage</label>
																	</div>
																</div>

																<div class="row">
																	<div class="col-md-4">
																		<label>Import</label>
																		<textarea
																			class="form-control"
																			name="voyage_import"
																			id="voyage_import"
																			rows="3"
																		>
From: Anywhere in India To: Anywhere in the World</textarea
																		>
																	</div>

																	<div class="col-md-4">
																		<label>Export</label>
																		<textarea
																			class="form-control"
																			name="voyage_export"
																			id="voyage_export"
																			rows="3"
																		>
From: Anywhere in the World To: Anywhere in India</textarea
																		>
																	</div>

																	<div class="col-md-4">
																		<label>Inland</label>
																		<textarea
																			class="form-control"
																			name="voyage_inland"
																			id="voyage_inland"
																			rows="3"
																		>
From: Anywhere in India To: Anywhere in India</textarea
																		>
																	</div>
																</div>
															</div>

															<div class="form-group">
																<div class="row">
																	<div class="col-md-4">
																		<label>Initial Sum Insured Required</label>
																	</div>
																	<div class="col-md-8">
																		<input
																			type="text"
																			class="form-control"
																			name="initial_sum_insured"
																			id="initial_sum_insured"
																		/>
																	</div>
																</div>
															</div>

															<div class="row">
																<div class="col-md-4">
																	<label style="color: #2e86c1">Insurer:</label>
																</div>
															</div>

															<div class="form-group">
																<div class="row">
																	<div class="col-md-4">
																		<label>Current Insurer</label>
																	</div>
																	<div class="col-md-8">
																		<input
																			type="text"
																			class="form-control"
																			name="current_insurer"
																			id="current_insurer"
																		/>
																	</div>
																</div>
															</div>

															<div class="row">
																<div class="col-md-4">
																	<label style="color: #2e86c1"></label>
																</div>
															</div>

															<div class="form-group">
																<div class="row">
																	<div class="col-md-4">
																		<label>Domestic</label>
																	</div>
																	<div class="col-md-8">
																		<input
																			type="text"
																			class="form-control"
																			name="purchase_domestic"
																			id="purchase_domestic"
																		/>
																	</div>
																</div>
															</div>

															<div class="form-group">
																<div class="row">
																	<div class="col-md-4">
																		<label>Per Bottom Limit (Import)</label>
																	</div>
																	<div class="col-md-8">
																		<input
																			type="text"
																			class="form-control"
																			name="bottom_import_limit"
																			id="bottom_import_limit"
																		/>
																	</div>
																</div>
															</div>

															<div class="form-group">
																<div class="row">
																	<div class="col-md-4">
																		<label>Per Location Limit (Import)</label>
																	</div>
																	<div class="col-md-8">
																		<input
																			type="text"
																			class="form-control"
																			name="location_import_limit"
																			id="location_import_limit"
																		/>
																	</div>
																</div>
															</div>

															<div class="form-group">
																<div class="row">
																	<div class="col-md-4">
																		<label>Claim History</label>
																	</div>
																	<div class="col-md-8">
																		<textarea
																			class="form-control"
																			name="claim_history"
																			id="claim_history"
																			rows="3"
																		></textarea>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>

												<div class="row hidden fire_div">
													<div class="col-md-6">
														<div class="hidden fire_div">
															<div class="form-group">
																<div class="row">
																	<div class="col-md-4">
																		<label>Period of Insurance</label>
																	</div>
																	<div class="col-md-4">
																		<input
																			type="date"
																			class="form-control"
																			name="fire_from_date"
																			id="fire_from_date"
																		/>
																	</div>

																	<div class="col-md-4">
																		<input
																			type="date"
																			class="form-control"
																			name="fire_to_date"
																			id="fire_to_date"
																		/>
																	</div>
																</div>
															</div>
															<div class="form-group">
																<div class="row">
																	<div class="col-md-4">
																		<label>Financial Institution</label>
																	</div>
																	<div class="col-md-8">
																		<input
																			type="text"
																			class="form-control"
																			name="financial_institution"
																			id="financial_institution"
																		/>
																	</div>
																</div>
															</div>
														</div>
													</div>

													<div class="col-md-6 hidden fire_div">
														<div class="form-group">
															<div class="row">
																<div class="col-md-4">
																	<label>Occupancy</label>
																</div>
																<div class="col-md-8">
																	<input
																		type="text"
																		class="form-control"
																		name="fire_occupancy"
																		id="fire_occupancy"
																	/>
																</div>
															</div>
														</div>
													</div>
												</div>

												<div class="row hidden fire_div">
													<div class="col-md-12">
														<table
															class="table table-bordered"
															style="width: 100%"
														>
															<tr>
																<td rowspan="4">Sum Insured</td>
																<td>
																	<div class="form-group">
																		<label>Particulars</label>
																		<textarea
																			class="form-control"
																			name="fire_particulars_1"
																			id="fire_particulars_1"
																		></textarea>
																	</div>
																</td>
																<td>
																	<div class="form-group">
																		<label>Fire Sum Insured (In Lacs)</label>
																		<input
																			type="text"
																			class="form-control"
																			name="fire_sum_ins_1"
																			id="fire_sum_ins_1"
																		/>
																	</div>
																</td>
																<td>
																	<div class="form-group">
																		<label>Fire Sum Insured (In Lacs)</label>
																		<input
																			type="text"
																			class="form-control"
																			name="burglary_sum_ins_1"
																			id="burglary_sum_ins_1"
																		/>
																	</div>
																</td>
															</tr>

															<tr>
																<td>
																	<div class="form-group">
																		<label>Particulars</label>
																		<textarea
																			class="form-control"
																			name="fire_particulars_2"
																			id="fire_particulars_2"
																		></textarea>
																	</div>
																</td>
																<td>
																	<div class="form-group">
																		<label>Fire Sum Insured (In Lacs)</label>
																		<input
																			type="text"
																			class="form-control"
																			name="fire_sum_ins_2"
																			id="fire_sum_ins_2"
																		/>
																	</div>
																</td>
																<td>
																	<div class="form-group">
																		<label>Fire Sum Insured (In Lacs)</label>
																		<input
																			type="text"
																			class="form-control"
																			name="burglary_sum_ins_2"
																			id="burglary_sum_ins_2"
																		/>
																	</div>
																</td>
															</tr>

															<tr>
																<td>
																	<div class="form-group">
																		<label>Particulars</label>
																		<textarea
																			class="form-control"
																			name="fire_particulars_3"
																			id="fire_particulars_3"
																		></textarea>
																	</div>
																</td>
																<td>
																	<div class="form-group">
																		<label>Fire Sum Insured (In Lacs)</label>
																		<input
																			type="text"
																			class="form-control"
																			name="fire_sum_ins_3"
																			id="fire_sum_ins_3"
																		/>
																	</div>
																</td>
																<td>
																	<div class="form-group">
																		<label>Fire Sum Insured (In Lacs)</label>
																		<input
																			type="text"
																			class="form-control"
																			name="burglary_sum_ins_3"
																			id="burglary_sum_ins_3"
																		/>
																	</div>
																</td>
															</tr>

															<tr>
																<td>
																	<div class="form-group">
																		<label>Particulars</label>
																		<textarea
																			class="form-control"
																			name="fire_particulars_4"
																			id="fire_particulars_4"
																		></textarea>
																	</div>
																</td>
																<td>
																	<div class="form-group">
																		<label>Fire Sum Insured (In Lacs)</label>
																		<input
																			type="text"
																			class="form-control"
																			name="fire_sum_ins_4"
																			id="fire_sum_ins_4"
																		/>
																	</div>
																</td>
																<td>
																	<div class="form-group">
																		<label>Fire Sum Insured (In Lacs)</label>
																		<input
																			type="text"
																			class="form-control"
																			name="burglary_sum_ins_4"
																			id="burglary_sum_ins_4"
																		/>
																	</div>
																</td>
															</tr>
														</table>
													</div>

													<div class="col-md-6">
														<div class="form-group">
															<div class="row">
																<div class="col-md-4">
																	<label
																		>Extension or Clause's Required under
																		Burglary</label
																	>
																</div>
																<div class="col-md-8">
																	<select
																		class="form-control"
																		name="clause_under_burglary"
																		id="clause_under_burglary"
																	>
																		<option value="RSMD">RSMD</option>
																		<option value="Theft Extension">
																			Theft Extension
																		</option>
																		<option value="Goods Held in Trust">
																			Goods Held in Trust
																		</option>
																	</select>
																</div>
															</div>
														</div>
														<div class="form-group">
															<div class="row">
																<div class="col-md-4">
																	<label>Expiring Insurer</label>
																</div>
																<div class="col-md-8">
																	<input
																		type="text"
																		class="form-control"
																		name="fire_expiry_insurer"
																		id="fire_expiry_insurer"
																	/>
																</div>
															</div>
														</div>
														<div class="form-group">
															<div class="row">
																<div class="col-md-4">
																	<label>Date</label>
																</div>
																<div class="col-md-8">
																	<input
																		type="date"
																		class="form-control"
																		name="fire_date"
																		id="fire_date"
																	/>
																</div>
															</div>
														</div>
													</div>

													<div class="col-md-6">
														<div class="form-group">
															<div class="row">
																<div class="col-md-4">
																	<label> Claims Experience</label>
																</div>
																<div class="col-md-8">
																	<input
																		type="text"
																		class="form-control"
																		name="claim_exprience"
																		id="claim_exprience"
																	/>
																</div>
															</div>
														</div>
														<div class="form-group">
															<div class="row">
																<div class="col-md-4">
																	<label>Information</label>
																</div>
																<div class="col-md-8">
																	<input
																		type="text"
																		class="form-control"
																		name="fire_information"
																		id="fire_information"
																	/>
																</div>
															</div>
														</div>
													</div>
												</div>

												<div class="hidden wc_div">
													<div class="row">
														<table
															class="table table-bordered"
															style="width: 100%"
														>
															<tr>
																<th colspan="4" class="text-center bg-primary">
																	Employee Details
																</th>
															</tr>
															<tr>
																<th colspan="2">Details</th>
																<th>Previous Year</th>
																<th>Current Year</th>
															</tr>
															<tr>
																<th colspan="2">Number of Employee</th>
																<th>
																	<input
																		type="text"
																		class="form-control"
																		name="pre_no_of_emp"
																		id="pre_no_of_emp"
																	/>
																</th>
																<th>
																	<input
																		type="text"
																		class="form-control"
																		name="cur_no_of_emp"
																		id="cur_no_of_emp"
																	/>
																</th>
															</tr>
														</table>
														<div class="col-md-6">
															<h4 class="text-center bg-primary">
																Claim Details
															</h4>
															<div class="form-group">
																<div class="row">
																	<div class="col-md-4">
																		<label>Claim Paid</label>
																	</div>
																	<div class="col-md-8">
																		<input
																			type="text"
																			class="form-control"
																			name="wc_claim_paid"
																			id="wc_claim_paid"
																		/>
																	</div>
																</div>
															</div>
															<div class="form-group">
																<div class="row">
																	<div class="col-md-4">
																		<label>Total Claim</label>
																	</div>
																	<div class="col-md-8">
																		<input
																			type="text"
																			class="form-control"
																			name="wc_tot_claim"
																			id="wc_tot_claim"
																		/>
																	</div>
																</div>
															</div>
															<div class="form-group">
																<div class="row">
																	<div class="col-md-4">
																		<label>Premium Paid</label>
																	</div>
																	<div class="col-md-8">
																		<input
																			type="text"
																			class="form-control"
																			name="wc_premium_paid"
																			id="wc_premium_paid"
																		/>
																	</div>
																</div>
															</div>
														</div>
														<div class="col-md-6">
															<h4 class="text-center bg-primary">&nbsp;</h4>
															<div class="form-group">
																<div class="row">
																	<div class="col-md-4">
																		<label>Outstanding Claim</label>
																	</div>
																	<div class="col-md-8">
																		<input
																			type="text"
																			class="form-control"
																			name="wc_out_claim"
																			id="wc_out_claim"
																		/>
																	</div>
																</div>
															</div>
															<div class="form-group">
																<div class="row">
																	<div class="col-md-4">
																		<label>Last Three Years Claims</label>
																	</div>
																	<div class="col-md-8">
																		<input
																			type="text"
																			class="form-control"
																			name="wc_last_claim"
																			id="wc_last_claim"
																		/>
																	</div>
																</div>
															</div>
														</div>
													</div>

													<div class="row">
														<div class="col-md-6">
															<h4 class="text-center bg-primary">
																Policy Details
															</h4>
															<div class="form-group">
																<div class="row">
																	<div class="col-md-4">
																		<label>Wages Per Employee Per Month</label>
																	</div>
																	<div class="col-md-8">
																		<input
																			type="text"
																			class="form-control"
																			name="wc_wages_per_mon"
																			id="wc_wages_per_mon"
																		/>
																	</div>
																</div>
															</div>

															<div class="form-group">
																<div class="row">
																	<div class="col-md-4">
																		<label>No of supervisor</label>
																	</div>
																	<div class="col-md-8">
																		<input
																			type="text"
																			class="form-control"
																			name="wc_no_supervisor"
																			id="wc_no_supervisor"
																		/>
																	</div>
																</div>
															</div>

															<div class="form-group">
																<div class="row">
																	<div class="col-md-4">
																		<label>No of site Engineer</label>
																	</div>
																	<div class="col-md-8">
																		<input
																			type="text"
																			class="form-control"
																			name="wc_no_site_engineer"
																			id="wc_no_site_engineer"
																		/>
																	</div>
																</div>
															</div>
														</div>

														<div class="col-md-6">
															<h4 class="text-center bg-primary">&nbsp;</h4>

															<div class="form-group">
																<div class="row">
																	<div class="col-md-4">
																		<label
																			>Salary Per supervisor Per Month</label
																		>
																	</div>
																	<div class="col-md-8">
																		<input
																			type="text"
																			class="form-control"
																			name="wc_salary_per_supervisor"
																			id="wc_salary_per_supervisor"
																		/>
																	</div>
																</div>
															</div>

															<div class="form-group">
																<div class="row">
																	<div class="col-md-4">
																		<label
																			>Salary site Engineer Per Month</label
																		>
																	</div>
																	<div class="col-md-8">
																		<input
																			type="text"
																			class="form-control"
																			name="wc_salary_engineer"
																			id="wc_salary_engineer"
																		/>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>

												<div class="gmc_div hidden">
													<div class="row">
														<div class="col-md-6">
															<h4 class="text-center bg-primary">
																Existing Policy Details
															</h4>

															<div class="form-group">
																<div class="row">
																	<div class="col-md-4">
																		<label
																			>Current Status(Fresh /Renewal )</label
																		>
																	</div>
																	<div class="col-md-8">
																		<input
																			type="text"
																			class="form-control"
																			name="gmc_current_status"
																			id="gmc_current_status"
																		/>
																	</div>
																</div>
															</div>

															<div class="form-group">
																<div class="row">
																	<div class="col-md-4">
																		<label>Current Insurer & TPA</label>
																	</div>
																	<div class="col-md-8">
																		<input
																			type="text"
																			class="form-control"
																			name="gmc_cur_ins"
																			id="gmc_cur_ins"
																		/>
																	</div>
																</div>
															</div>

															<div class="form-group">
																<div class="row">
																	<div class="col-md-4">
																		<label
																			>Premium as on date ( Including
																			Addition/Deletions )</label
																		>
																	</div>
																	<div class="col-md-8">
																		<input
																			type="text"
																			class="form-control"
																			name="gmc_premium_date"
																			id="gmc_premium_date"
																		/>
																	</div>
																</div>
															</div>

															<div class="form-group">
																<div class="row">
																	<div class="col-md-4">
																		<label
																			>Total Lives for Policy Renewal</label
																		>
																	</div>
																	<div class="col-md-8">
																		<input
																			type="text"
																			class="form-control"
																			name="gmc_renewal_tot"
																			id="gmc_renewal_tot"
																		/>
																	</div>
																</div>
															</div>
														</div>

														<div class="col-md-6">
															<h4 class="text-center bg-primary">&nbsp;</h4>

															<div class="form-group">
																<div class="row">
																	<div class="col-md-4">
																		<label>Period Of Insurance</label>
																	</div>
																	<div class="col-md-8">
																		<input
																			type="text"
																			class="form-control"
																			name="gmc_period_of_ins"
																			id="gmc_period_of_ins"
																		/>
																	</div>
																</div>
															</div>

															<div class="form-group">
																<div class="row">
																	<div class="col-md-4">
																		<label
																			>Premium At inception of Policy
																		</label>
																	</div>
																	<div class="col-md-8">
																		<input
																			type="text"
																			class="form-control"
																			name="gmc_premium_inscep"
																			id="gmc_premium_inscep"
																		/>
																	</div>
																</div>
															</div>

															<div class="form-group">
																<div class="row">
																	<div class="col-md-4">
																		<label
																			>Total Lives at Inception of Policy</label
																		>
																	</div>
																	<div class="col-md-8">
																		<input
																			type="text"
																			class="form-control"
																			name="gmc_total_lives"
																			id="gmc_total_lives"
																		/>
																	</div>
																</div>
															</div>

															<div class="form-group">
																<div class="row">
																	<div class="col-md-4">
																		<label>Incurred Claims(Settled+ O/s)</label>
																	</div>
																	<div class="col-md-8">
																		<input
																			type="text"
																			class="form-control"
																			name="gmc_incurred_claims"
																			id="gmc_incurred_claims"
																		/>
																	</div>
																</div>
															</div>
														</div>
													</div>

													<div class="row">
														<div class="col-md-6">
															<h4 class="text-center bg-primary">Benefits</h4>

															<div class="form-group">
																<div class="row">
																	<div class="col-md-4">
																		<label
																			>Sum Insured Approach
																			(Uniform/Various)</label
																		>
																	</div>
																	<div class="col-md-8">
																		<input
																			type="text"
																			class="form-control"
																			name="gmc_sum_ins_app"
																			id="gmc_sum_ins_app"
																		/>
																	</div>
																</div>
															</div>

															<div class="form-group">
																<div class="row">
																	<div class="col-md-4">
																		<label> Family Definition</label>
																	</div>
																	<div class="col-md-8">
																		<input
																			type="text"
																			class="form-control"
																			name="gmc_family_def"
																			id="gmc_family_def"
																		/>
																	</div>
																</div>
															</div>

															<div class="form-group">
																<div class="row">
																	<div class="col-md-4">
																		<label>
																			Pre-existing Diseases covered</label
																		>
																	</div>
																	<div class="col-md-8">
																		<input
																			type="text"
																			class="form-control"
																			name="gmc_pre_disease_covered"
																			id="gmc_pre_disease_covered"
																		/>
																	</div>
																</div>
															</div>

															<div class="form-group">
																<div class="row">
																	<div class="col-md-4">
																		<label
																			>1st ,2nd & 4th Year Exclusion
																			Waiver</label
																		>
																	</div>
																	<div class="col-md-8">
																		<input
																			type="text"
																			class="form-control"
																			name="gmc_exclusion_waiver_year"
																			id="gmc_exclusion_waiver_year"
																		/>
																	</div>
																</div>
															</div>

															<div class="form-group">
																<div class="row">
																	<div class="col-md-4">
																		<label>Maternity Benefit coverage</label>
																	</div>
																	<div class="col-md-8">
																		<input
																			type="text"
																			class="form-control"
																			name="gmc_maternity_coverage"
																			id="gmc_maternity_coverage"
																		/>
																	</div>
																</div>
															</div>

															<div class="form-group">
																<div class="row">
																	<div class="col-md-4">
																		<label
																			>Pre and Post Hospitalization coverage
																			limits</label
																		>
																	</div>
																	<div class="col-md-8">
																		<input
																			type="text"
																			class="form-control"
																			name="gmc_hospital_coverage"
																			id="gmc_hospital_coverage"
																		/>
																	</div>
																</div>
															</div>

															<div class="form-group">
																<div class="row">
																	<div class="col-md-4">
																		<label>ICU/ ITU Limits</label>
																	</div>
																	<div class="col-md-8">
																		<input
																			type="text"
																			class="form-control"
																			name="gmc_icu_limits"
																			id="gmc_icu_limits"
																		/>
																	</div>
																</div>
															</div>

															<div class="form-group">
																<div class="row">
																	<div class="col-md-4">
																		<label
																			>Coverage for Congenital Internal
																			Disease</label
																		>
																	</div>
																	<div class="col-md-8">
																		<input
																			type="text"
																			class="form-control"
																			name="gmc_int_desease_cover"
																			id="gmc_int_desease_cover"
																		/>
																	</div>
																</div>
															</div>

															<div class="form-group">
																<div class="row">
																	<div class="col-md-4">
																		<label>PPN Clause</label>
																	</div>
																	<div class="col-md-8">
																		<input
																			type="text"
																			class="form-control"
																			name="gmc_ppn_cause"
																			id="gmc_ppn_cause"
																		/>
																	</div>
																</div>
															</div>

															<div class="form-group">
																<div class="row">
																	<div class="col-md-4">
																		<label>Claim Submission</label>
																	</div>
																	<div class="col-md-8">
																		<input
																			type="text"
																			class="form-control"
																			name="gmc_claim_sub_mission"
																			id="gmc_claim_sub_mission"
																		/>
																	</div>
																</div>
															</div>

															<div class="form-group">
																<div class="row">
																	<div class="col-md-4">
																		<label>Lasik Surgery</label>
																	</div>
																	<div class="col-md-8">
																		<input
																			type="text"
																			class="form-control"
																			name="gmc_lasik_surgery"
																			id="gmc_lasik_surgery"
																		/>
																	</div>
																</div>
															</div>

															<div class="form-group">
																<div class="row">
																	<div class="col-md-4">
																		<label>Corporate buffer </label>
																	</div>
																	<div class="col-md-8">
																		<input
																			type="text"
																			class="form-control"
																			name="gmc_corporate_buffer"
																			id="gmc_corporate_buffer"
																		/>
																	</div>
																</div>
															</div>

															<div class="form-group">
																<div class="row">
																	<div class="col-md-4">
																		<label>Cataract Surgery</label>
																	</div>
																	<div class="col-md-8">
																		<input
																			type="text"
																			class="form-control"
																			name="gmc_cataract_surgery"
																			id="gmc_cataract_surgery"
																		/>
																	</div>
																</div>
															</div>

															<div class="form-group">
																<div class="row">
																	<div class="col-md-4">
																		<label
																			>Comorbidities treatment under covid
																			admission</label
																		>
																	</div>
																	<div class="col-md-8">
																		<input
																			type="text"
																			class="form-control"
																			name="gmc_comorbities"
																			id="gmc_comorbities"
																		/>
																	</div>
																</div>
															</div>

															<div class="form-group">
																<div class="row">
																	<div class="col-md-4">
																		<label
																			>Psychiatric Ailment /Mental
																			Illness</label
																		>
																	</div>
																	<div class="col-md-8">
																		<input
																			type="text"
																			class="form-control"
																			name="gmc_metail_illness"
																			id="gmc_metail_illness"
																		/>
																	</div>
																</div>
															</div>

															<div class="form-group">
																<div class="row">
																	<div class="col-md-4">
																		<label>Addition/Deletion</label>
																	</div>
																	<div class="col-md-8">
																		<input
																			type="text"
																			class="form-control"
																			name="gmc_addition"
																			id="gmc_addition"
																		/>
																	</div>
																</div>
															</div>

															<div class="form-group">
																<div class="row">
																	<div class="col-md-4">
																		<label
																			>Covid hospitlization coverage ( Covid
																			Hospitlizaiton expneses to be covered as
																			per policy norms )</label
																		>
																	</div>
																	<div class="col-md-8">
																		<input
																			type="text"
																			class="form-control"
																			name="gmc_covid_hospitlization"
																			id="gmc_covid_hospitlization"
																		/>
																	</div>
																</div>
															</div>

															<div class="form-group">
																<div class="row">
																	<div class="col-md-4">
																		<label>Day Care Procedures</label>
																	</div>
																	<div class="col-md-8">
																		<input
																			type="text"
																			class="form-control"
																			name="gmc_day_care"
																			id="gmc_day_care"
																		/>
																	</div>
																</div>
															</div>
														</div>

														<div class="col-md-6">
															<h4 class="text-center bg-primary">&nbsp;</h4>

															<div class="form-group">
																<div class="row">
																	<div class="col-md-4">
																		<label>Sum Insured</label>
																	</div>
																	<div class="col-md-8">
																		<input
																			type="text"
																			class="form-control"
																			name="gmc_sum_ins"
																			id="gmc_sum_ins"
																		/>
																	</div>
																</div>
															</div>

															<div class="form-group">
																<div class="row">
																	<div class="col-md-4">
																		<label
																			>Policy Type ( Family Floater / Individual
																			Sum Insured )
																		</label>
																	</div>
																	<div class="col-md-8">
																		<input
																			type="text"
																			class="form-control"
																			name="gmc_policy_type"
																			id="gmc_policy_type"
																		/>
																	</div>
																</div>
															</div>

															<div class="form-group">
																<div class="row">
																	<div class="col-md-4">
																		<label>30 Days Exclusion Waiver</label>
																	</div>
																	<div class="col-md-8">
																		<input
																			type="text"
																			class="form-control"
																			name="gmc_exclusion_wavier"
																			id="gmc_exclusion_wavier"
																		/>
																	</div>
																</div>
															</div>

															<div class="form-group">
																<div class="row">
																	<div class="col-md-4">
																		<label
																			>9 months waiting period for
																			Maternity</label
																		>
																	</div>
																	<div class="col-md-8">
																		<input
																			type="text"
																			class="form-control"
																			name="gmc_waiting_period"
																			id="gmc_waiting_period"
																		/>
																	</div>
																</div>
															</div>

															<div class="form-group">
																<div class="row">
																	<div class="col-md-4">
																		<label
																			>Child Day 1 cover within Family Floater
																			Sum Insured</label
																		>
																	</div>
																	<div class="col-md-8">
																		<input
																			type="text"
																			class="form-control"
																			name="gmc_child_day_cover"
																			id="gmc_child_day_cover"
																		/>
																	</div>
																</div>
															</div>

															<div class="form-group">
																<div class="row">
																	<div class="col-md-4">
																		<label>Room rent restriction</label>
																	</div>
																	<div class="col-md-8">
																		<input
																			type="text"
																			class="form-control"
																			name="gmc_room_rent"
																			id="gmc_room_rent"
																		/>
																	</div>
																</div>
															</div>

															<div class="form-group">
																<div class="row">
																	<div class="col-md-4">
																		<label
																			>Any Submlimits On Doctor Fees/Surgeon
																			Charges /Medicines, consumables etc</label
																		>
																	</div>
																	<div class="col-md-8">
																		<input
																			type="text"
																			class="form-control"
																			name="gmc_sub_limits"
																			id="gmc_sub_limits"
																		/>
																	</div>
																</div>
															</div>

															<div class="form-group">
																<div class="row">
																	<div class="col-md-4">
																		<label
																			>Coverage for Congenital External
																			Disease</label
																		>
																	</div>
																	<div class="col-md-8">
																		<input
																			type="text"
																			class="form-control"
																			name="gmc_ext_desease_cover"
																			id="gmc_ext_desease_cover"
																		/>
																	</div>
																</div>
															</div>

															<div class="form-group">
																<div class="row">
																	<div class="col-md-4">
																		<label>Claim Intimation</label>
																	</div>
																	<div class="col-md-8">
																		<input
																			type="text"
																			class="form-control"
																			name="gmc_claim_int"
																			id="gmc_claim_int"
																		/>
																	</div>
																</div>
															</div>

															<div class="form-group">
																<div class="row">
																	<div class="col-md-4">
																		<label
																			>Internal Capping / Co Payment / Any Sub
																			Limits</label
																		>
																	</div>
																	<div class="col-md-8">
																		<input
																			type="text"
																			class="form-control"
																			name="gmc_int_capping"
																			id="gmc_int_capping"
																		/>
																	</div>
																</div>
															</div>

															<div class="form-group">
																<div class="row">
																	<div class="col-md-4">
																		<label>Ayush treatment</label>
																	</div>
																	<div class="col-md-8">
																		<input
																			type="text"
																			class="form-control"
																			name="gmc_ayush_treatment"
																			id="gmc_ayush_treatment"
																		/>
																	</div>
																</div>
															</div>

															<div class="form-group">
																<div class="row">
																	<div class="col-md-4">
																		<label>Robotic Surgery</label>
																	</div>
																	<div class="col-md-8">
																		<input
																			type="text"
																			class="form-control"
																			name="gmc_robotic"
																			id="gmc_robotic"
																		/>
																	</div>
																</div>
															</div>

															<div class="form-group">
																<div class="row">
																	<div class="col-md-4">
																		<label>Ambulance Charges</label>
																	</div>
																	<div class="col-md-8">
																		<input
																			type="text"
																			class="form-control"
																			name="gmc_ambulance"
																			id="gmc_ambulance"
																		/>
																	</div>
																</div>
															</div>

															<div class="form-group">
																<div class="row">
																	<div class="col-md-4">
																		<label>Sinus Surgery</label>
																	</div>
																	<div class="col-md-8">
																		<input
																			type="text"
																			class="form-control"
																			name="gmc_sinus_surgery"
																			id="gmc_sinus_surgery"
																		/>
																	</div>
																</div>
															</div>

															<div class="form-group">
																<div class="row">
																	<div class="col-md-4">
																		<label
																			>Age Related Macular Degeneration</label
																		>
																	</div>
																	<div class="col-md-8">
																		<input
																			type="text"
																			class="form-control"
																			name="gmc_age_macular"
																			id="gmc_age_macular"
																		/>
																	</div>
																</div>
															</div>

															<div class="form-group">
																<div class="row">
																	<div class="col-md-4">
																		<label
																			>Hospitalization due to terrorism and
																			epidemic diseases
																		</label>
																	</div>
																	<div class="col-md-8">
																		<input
																			type="text"
																			class="form-control"
																			name="gmc_terroism_deases"
																			id="gmc_terroism_deases"
																		/>
																	</div>
																</div>
															</div>

															<div class="form-group">
																<div class="row">
																	<div class="col-md-4">
																		<label
																			>Any Other Special Condition or
																			Coverages</label
																		>
																	</div>
																	<div class="col-md-8">
																		<input
																			type="text"
																			class="form-control"
																			name="gmc_special_coverage"
																			id="gmc_special_coverage"
																		/>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</section>
								</div>
								<div class="modal-footer">
									<button
										type="button"
										class="btn btn-default"
										data-dismiss="modal"
									>
										Close
									</button>
								</div>
							</div>
						</div>
					</div>

					<script>
						var gen_policy_status = "0";

						var childrens = 0;

						var Husband = 0;
						var Wife = 0;
						var Son = 0;
						var Daughter = 0;
						var Father = 0;
						var Mother = 0;
						var Husband_age = "";
						var Wife_age = "";

						var Husband_name = "";
						var Husband_dob = "";

						var Wife_name = "";
						var Wife_dob = "";

						var pet_gender = "male";

						//property

						//Home
						var house_type = "Home";
						var owner_type = "Owner";

						// business

						var last_inserted_id = $("#last_inserted_id").val();

						var business_owner_type = "Owner";

						$(document).ready(function () {

							const DEFAULT_STATE_ID = 1; // Tamil Nadu ID

							// ✅ Only auto-select TamilNadu for *new* clients (when no lead_id)
							const lead_id = $("#last_inserted_id").val();
							if (!lead_id || lead_id === "") {
								if (!$("#state").val() || $("#state").val() === "") {
									$("#state").val(DEFAULT_STATE_ID).trigger("change");
								}
							}

							$(".select2").select2();

							$("#policy_btn").click(function () {
								if (gen_policy_status == "1") {
									window.location.href = "generate_policy?id=<?php echo $id ?>";
								} else {
									window.location.href = "generate_policy?id=<?php echo $id ?>";
								}

								//  $.ajax({
								//               url : "get_vechile_details",
								//               method : "POST",
								//               data : {id:last_inserted_id},
								//               success:function(response)
								//               {
								//                   var obj = jQuery.parseJSON(response);

								//                   if(obj != null && obj != "")
								//                     {
								//                         window.location.href="generate_policy?id=<?php echo $id ?>";
								//                     }
								//                     else
								//                     {
								//                             Swal.fire({
								//                               icon: 'error',
								//                               title: 'Oops...',
								//                               text: 'Add Vechicle Details Before Generate the Policy...!',
								//                               footer: ''
								//                             })
								//                     }
								//               }
								//         });
							});

							get_all_quotes(last_inserted_id);

							if (last_inserted_id != "") {
								fetch_quote_files(last_inserted_id);

								$.ajax({
									url: "check_this_lead_already_in_policy",
									method: "POST",
									data: { lead_id: last_inserted_id },
									success: function (response) {
										if (response == true) {
											$("#prospect_btn").addClass("hidden");
											$("#policy_btn").addClass("hidden");
											$("#edit_client_btn").addClass("hidden");
											$("#edit_req_btn").addClass("hidden");
										} else {
											//$("#prospect_btn").removeClass("hidden");
											$("#policy_btn").removeClass("hidden");
											$("#edit_client_btn").removeClass("hidden");
											$("#edit_req_btn").removeClass("hidden");
										}
									},
								});
								$("#follow_up_hidden").removeClass("hidden");
								//$("#vechicle_hidden").removeClass("hidden");
								$("#save_btn").addClass("hidden");
								//$("#sms_btn").removeClass("hidden");

								$("#client_type").attr("disabled", true);
								$("#client_name").attr("disabled", true);
								$("#salutation").attr("disabled", true);
								$("#initial").attr("disabled", true);
								$("#father_husband_name").attr("disabled", true);
								$("#communication_address").attr("disabled", true);
								$("#permanent_address").attr("disabled", true);
								$("#district").attr("disabled", true);
								$("#state").attr("disabled", true);
								$("#country").attr("disabled", true);
								$("#doc_aadhar").attr("disabled", true);
								$("#doc_pan").attr("disabled", true);
								$("#doc_voter").attr("disabled", true);
								$("#doc_dl").attr("disabled", true);
								$("#doc_govt").attr("disabled", true);
								$("#mobile_no").attr("disabled", true);
								// $("#other_contact_details").attr("disabled",true);
								// $("#landline_no").attr("disabled",true);
								$("#address").attr("disabled", true);
								$("#email_id").attr("disabled", true);
								// $("#cont_person_name").attr("disabled",true);
								// $("#cont_person_des").attr("disabled",true);
								$("#dob").attr("disabled", true);
								$("#age").attr("disabled", true);
								$("#add_custom_field").attr("disabled", true);
								// $("#area").attr("disabled",true);

								$("#bussiness_type").attr("disabled", true);
								$("#policy_class").attr("disabled", true);
								$("#policy_type").attr("disabled", true);
								$("#lead_generated_date").attr("disabled", true);
								$("#due_date").attr("disabled", true);
								$("#location").attr("disabled", true);
								$("#classification").attr("disabled", true);
								$("#source").attr("disabled", true);
								$("#agent_pos").attr("disabled", true);
								$("#assign_to_user").attr("disabled", true);
								$("#area_incharge").attr("disabled", true);
								$("#remarks").attr("disabled", true);
								$("#v_regn_no_1").attr("disabled", true);
								$("#v_regn_no_2").attr("disabled", true);
								$("#v_regn_no_3").attr("disabled", true);
								$("#v_regn_no_4").attr("disabled", true);

								$.ajax({
									url: "get_lead_details",
									method: "POST",
									data: { last_inserted_id: last_inserted_id },
									success: function (response) {
										var obj = jQuery.parseJSON(response);

										// ✅ Show Customer ID only in edit mode
										if (obj.customer_id && obj.customer_id !== "") {
											$("#customer_id_display").val(obj.customer_id);
											$("#customer_id_wrapper").show(); // 👈 make it visible
										} else {
											$("#customer_id_wrapper").hide(); // hide if not available (add mode)
										}

										// === POPULATE CLIENT FIELDS ===
										$("#client_type").val(obj.client_type_id);
										$("#salutation").val(obj.salutation);
										$("#client_name").val(obj.client_name);
										$("#initial").val(obj.initial);
										$("#father_husband_name").val(obj.father_husband_name);
										$("#dob").val(obj.date_of_birth);
										$("#age").val(obj.age);
										$("#dob").trigger("change");
										$("#mobile_no").val(obj.mobile_no);
										$("#email_id").val(obj.email);
										$("#communication_address").val(obj.communication_address);
										$("#permanent_address").val(obj.permanent_address);
										$("#district").val(obj.district);
										if (obj.state && obj.state !== "") {
											$("#state").val(obj.state).trigger("change");
										} else {
											$("#state").val(1).trigger("change");
										}
										$("#country").val(obj.country);
										$("#pin_code").val(obj.pin_code);
										$("#gst_number").val(obj.gst_number);

										// === DOCUMENT VIEW MODE (fixed selector IDs) ===
										const basePath = "datas/client_documents/"; // adjust to your folder path
										const docs = [
											"doc_aadhar",
											"doc_pan",
											"doc_voter",
											"doc_dl",
											"doc_govt",
										];

										docs.forEach(function (field) {
											const fileVal = obj[field];
											const $fileInput = $("#" + field);
											const $filePreview = $("#view_" + field); // ✅ fixed here

											if (fileVal && fileVal !== "") {
												$filePreview
													.attr("href", basePath + fileVal)
													.attr("target", "_blank")
													.html(
														'<i class="fa fa-eye"></i> View ' +
															prettifyFieldName(field)
													)
													.show();
												$fileInput.hide();
											} else {
												$filePreview.hide();
												$fileInput.show();
											}
										});

										// === LOAD CUSTOM FIELDS (same UI as Vehicle Additional Fields) ===
										$("#custom_fields_container").html(""); // clear existing fields

										if (obj.custom_fields && obj.custom_fields !== "") {
											try {
												let customFields = JSON.parse(obj.custom_fields);

												// If stored as object {label: value}
												if (!Array.isArray(customFields)) {
													customFields = Object.entries(customFields).map(([label, value]) => ({ label, value }));
												}

												// Render each separately
												customFields.forEach(function (field, index) {
													let label = field.label || field.key || Object.keys(field)[0];
													let value = field.value || field[label] || "";

													let fieldHtml = `
														<div class="row mb-2" id="custom_field_${index}" style="margin-top:10px;">
															<div class="col-md-5">
																<input type="text" class="form-control custom_label" name="custom_label[]" value="${label}" placeholder="Enter Label">
															</div>
															<div class="col-md-5">
																<input type="text" class="form-control custom_value" name="custom_value[]" value="${value}" placeholder="Enter Value">
															</div>
															<div class="col-md-2">
																<button type="button" class="btn btn-danger btn-sm remove_custom_field" data-id="${index}">
																	<i class="fa fa-trash"></i>
																</button>
															</div>
														</div>`;
													$("#custom_fields_container").append(fieldHtml);
												});
											} catch (e) {
												console.error("Error parsing custom fields JSON:", e);
												$("#custom_fields_container").html('<p class="text-danger">Error loading custom fields</p>');
											}
										} else {
											$("#custom_fields_container").html('<p class="text-muted">No additional fields</p>');
										}
										// Disable fields initially
										// $("input, select, textarea").attr("disabled", true);

										$("#bussiness_type").val(obj.business_type);
										$("#policy_class").val(obj.class);

										var policy_type_id = obj.policy_type;

										if (obj.lead_type == "0" && obj.classfication == "1") {
											var oldUrl = $("#back_btn").attr("href");
											var newUrl = oldUrl.replace("leads", "leads?tab=hot");
											$("#back_btn").attr("href", newUrl);
										}
										if (obj.lead_type == "0" && obj.classfication == "2") {
											var oldUrl = $("#back_btn").attr("href");
											var newUrl = oldUrl.replace("leads", "leads?tab=warm");
											$("#back_btn").attr("href", newUrl);
										}
										if (obj.lead_type == "0" && obj.classfication == "3") {
											var oldUrl = $("#back_btn").attr("href");
											var newUrl = oldUrl.replace("leads", "leads?tab=cold");
											$("#back_btn").attr("href", newUrl);
										}
										if (obj.lead_type == "1") {
											var oldUrl = $("#back_btn").attr("href");
											var newUrl = oldUrl.replace(
												"leads",
												"leads?tab=prospect"
											);
											$("#back_btn").attr("href", newUrl);
										}

										if (obj.class != "") {
											var policy_class = obj.class;
											$.ajax({
												url: "fetch_policy_type_using_class",
												method: "POST",
												data: { policy_class: policy_class },
												success: function (response) {
													var obj = jQuery.parseJSON(response);

													var str = "<option value=''>--Select--</option>";
													for (var j = 0; j < obj.length; j++) {
														if (policy_type_id == obj[j].id) {
															str +=
																"<option value='" +
																obj[j].id +
																"' selected>" +
																obj[j].policy_type +
																"</option>";
														} else {
															str +=
																"<option value='" +
																obj[j].id +
																"'>" +
																obj[j].policy_type +
																"</option>";
														}
													}
													$("#policy_type").html(str);
												},
											});

											if (obj.class == "1") {
												$("#vechicle_hidden").removeClass("hidden");
												$("#nominee_div").removeClass("hidden");
											} else if (obj.class == "2") {
												$("#health_hidden").removeClass("hidden");
												$("#nominee_div").removeClass("hidden");

												var lead_id = $("#last_inserted_id").val();

												$.ajax({
													url: "fetch_edit_health_details",
													method: "POST",
													data: { lead_id: lead_id },
													success: function (response) {
														var obj = jQuery.parseJSON(response);

														if (obj != null) {
															$("#view_health_div").removeClass("hidden");
															$("#edit_health_details").removeClass("hidden");
															$("#add_health_mod_btn").addClass("hidden");

															if (obj.gender == "Male") {
																$("#health_insurer_name").val(obj.husband_name);
																$("#health_insurer_age").val(obj.husband_age);
																$("#health_insurer_dob").val(obj.husband_dob);
																$("#health_insurer_gender").val("Male");
															} else {
																$("#health_insurer_name").val(obj.wife_name);
																$("#health_insurer_age").val(obj.wife_age);
																$("#health_insurer_dob").val(obj.wife_dob);
																$("#health_insurer_gender").val("Female");
															}
															gen_policy_status = "1";
														}
													},
												});
											} else if (obj.class == "4") {
												$("#property_hidden").removeClass("hidden");
												$("#nominee_div").removeClass("hidden");

												if (obj.policy_type == "22") {
													$("#add_prop_btn").removeClass("hidden");
													$("#business_prop_btn").addClass("hidden");
													var lead_id = $("#last_inserted_id").val();

													$.ajax({
														url: "get_home_details",
														method: "POST",
														data: { lead_id: lead_id },
														success: function (response) {
															$.ajax({
																url: "get_home_details",
																method: "POST",
																data: { lead_id: lead_id },
																success: function (response) {
																	var obj = jQuery.parseJSON(response);

																	if (obj != null) {
																		$("#home_pro_div").removeClass("hidden");
																		$("#business_pro_div").addClass("hidden");
																		$("#home_pro_div").removeClass("hidden");
																		$("#add_prop_btn").addClass("hidden");
																		$("#edit_home_prop_btn").removeClass(
																			"hidden"
																		);

																		$("#housing_type").val(obj.house_type);
																		$("#policy_tensure").val(
																			obj.home_policy_tenure
																		);
																		$("#property_value").val(
																			obj.home_property_value
																		);
																		$("#interior_furniture").val(
																			obj.home_interior
																		);
																		$("#tenant_or_owner").val(obj.owner_type);
																		$("#age_of_premises").val(
																			obj.home_age_premises
																		);
																		$("#built_up_area").val(obj.home_sqft);
																		$("#air_conditionor_amt").val(obj.home_ac);
																	} else {
																		$("#home_pro_div").addClass("hidden");
																	}
																},
															});
														},
													});
												} else {
													$("#add_prop_btn").addClass("hidden");
													$("#business_prop_btn").removeClass("hidden");

													var lead_id = $("#last_inserted_id").val();

													$.ajax({
														url: "get_business_details",
														method: "POST",
														data: { lead_id: lead_id },
														success: function (response) {
															var obj = jQuery.parseJSON(response);
															if (obj != null) {
																$("#business_pro_div").removeClass("hidden");
																$("#home_pro_div").addClass("hidden");
																$("#business_prop_btn").addClass("hidden");
																$("#edit_business_prop_btn").removeClass(
																	"hidden"
																);

																$("#b_tenant_or_owner").val(obj.owner_type);
																$("#b_proffession").val(obj.profession);
																$("#b_property_value").val(
																	obj.business_property_value
																);
																$("#b_age_of_premise").val(
																	obj.business_age_premises
																);
																$("#b_interior_furniture").val(
																	obj.business_interior
																);
																$("#b_built_up_area").val(obj.business_sqft);
																$("#b_air_conditionor_amt").val(
																	obj.business_ac
																);
															} else {
																$("#business_pro_div").addClass("hidden");
															}
														},
													});
												}
											} else if (obj.class == "5") {
												$("#nominee_div").removeClass("hidden");
												var lead_id = $("#last_inserted_id").val();
												$("#maraine_box").removeClass("hidden");

												$.ajax({
													url: "get_maraine_details",
													method: "POST",
													data: { lead_id: lead_id },
													success: function (response) {
														var obj = jQuery.parseJSON(response);

														if (response != "" || response != null) {
															$("#maraine_div").removeClass("hidden");
															$("#add_maraine_btn").addClass("hidden");
															$("#edit_maraine_btn").removeClass("hidden");
															$("#m_transit_policy").val(
																obj["maraine_details"].type
															);
															$("#m_marine_transport").val(
																obj["maraine_details"].transport_mode
															);
															$("#m_marine_cummodity").val(
																obj["maraine_details"].commodity
															);
															$("#m_marine_sub_cummodity").html(
																obj["sub_commodity"]
															);
															$("#m_marine_sub_cummodity").val(
																obj["maraine_details"].sub_commodity
															);
															$("#m_marine_company_name").val(
																obj["maraine_details"].company_name
															);
															$("#m_marine_city_name").val(
																obj["maraine_details"].city_name
															);
															$("#m_marine_invoice_val").val(
																obj["maraine_details"].invoice_value
															);
															$("#m_marine_invoice_10per_val").val(
																obj["maraine_details"].sum_invoice
															);
														}
													},
												});
											} else if (obj.class == "10") {
												$(".sme_hidden").removeClass("hidden");
												$("#nominee_div").addClass("hidden");
											} else if (obj.class == "16") {
												var lead_id = $("#last_inserted_id").val();
												$("#pet_hidden").removeClass("hidden");
												$("#nominee_div").removeClass("hidden");

												$.ajax({
													url: "get_pet_details",
													method: "POST",
													data: { lead_id: lead_id },
													success: function (response) {
														var obj = jQuery.parseJSON(response);
														if (response != "" || response != null) {
															$("#edit_pet_name").val(obj.name);
															$("#edit_pet_gender").val(obj.gender);
															$("#edit_pet_age").val(obj.age_in_months);
															$("#edit_pet_height").val(obj.height_in_ft);
															$("#edit_pet_weight").val(obj.weight_in_kg);

															$("#pet_div").removeClass("hidden");
															$("#add_pet_btn").addClass("hidden");
															$("#edit_pet_btn").removeClass("hidden");
														}
													},
												});
											}
										}

										$("#lead_generated_date").val(obj.lead_generated_date);
										$("#due_date").val(obj.due_date);
										$("#lead_Status").val(obj.lead_status);

										if (obj.next_follow_up_date != "") {
											$("#edit_follow_up_btn").removeClass("hidden");
										}

										$("#next_follow_date").val(obj.next_follow_up_date);

										if (
											obj.last_follow_up_date != "" &&
											obj.last_follow_up_date != "0000-00-00"
										) {
											$("#last_follow_date").val(obj.last_follow_up_date);
										} else {
											$("#last_follow_date").val(obj.next_follow_up_date);
										}

										$("#last_status_update").val(obj.follow_up_created_date);

										if (
											obj.next_follow_up_time != "" &&
											obj.next_follow_up_time != "00:00:00"
										) {
											$("#next_follow_time").val(obj.next_follow_up_time);
										} else {
											$("#next_follow_time").val("");
										}

										var broken_policy = $("#broken_policy").val(
											obj.broken_policy
										);

										if (broken_policy == "yes") {
											$("#broken_policy").prop("checked", true);
										} else {
											$("#broken_policy").prop("checked", false);
										}
										$("#location").val(obj.location);
										$("#classification").val(obj.classfication);
										$("#source").val(obj.source);
										$("#agent_pos").val(obj.agency_and_pos);
										$("#agent_pos").trigger("change");
										$("#assign_to_user").val(obj.assigned_user);
										$("#area_incharge").val(obj.area_incharge);
										$("#remarks").val(obj.remarks);

										var reg_num = obj.vechi_register_no.split("-");
										var j = 0;
										for (var i = 0; i < reg_num.length; i++) {
											j++;
											$("#v_regn_no_" + j).val(reg_num[i]);
										}
									},
								});

								$.ajax({
									url: "get_nominee_details",
									method: "POST",
									data: { lead_id: last_inserted_id },
									success: function (response) {
										var obj = jQuery.parseJSON(response);
										if (obj != null) {
											$("#add_nominee_btn").addClass("hidden");
											$("#nominee_name").val(obj.name);
											$("#adharcard_no").val(obj.adharcard_no);
											$("#n_mobile_no").val(obj.mobile_no);
											$("#n_adhar_file").addClass("hidden");
											var content =
												"<a href='./datas/nominee_documents/" +
												obj.file +
												"'  target='_blank'>View Adhar File</a>";
											$("#nominee_file").html(content);
										}
									},
								});

								$.ajax({
									url: "get_vechile_details",
									method: "POST",
									data: { id: last_inserted_id },
									success: function (response) {
										var obj = jQuery.parseJSON(response);

										if (obj != null && obj != "") {
											$("#view_vechi_details").removeClass("hidden");
											$("#edit_vechicle_btn").removeClass("hidden");
											$("#add_vechi_btn").addClass("hidden");
											$("#quotation_box_hidden").removeClass("hidden");
											$("#view_make_model").val(
												obj.brand_name +
													" " +
													obj.model_name +
													" " +
													obj.varient_name
											);
											$("#view_engine_no").val(obj.vechi_engine_num);
											$("#view_regn_no").val(obj.vechi_register_no);
											$("#view_chassis").val(obj.vechi_chassis_num);

											gen_policy_status = "1";
										} else {
											$("#edit_vechicle_btn").addClass("hidden");
											$("#add_vechi_btn").removeClass("hidden");
											$("#view_vechi_details").addClass("hidden");
										}
									},
								});

								notification_log(last_inserted_id);
							} else {
								$("#nominee_div").addClass("hidden");
							}

							$("#prospect_btn").click(function () {
								var last_inserted_id = $("#last_inserted_id").val();

								Swal.fire({
									title: "Are you sure?",
									text: "Do you want convert this Lead to Prospect ?",
									icon: "warning",
									showCancelButton: true,
									confirmButtonColor: "#3085d6",
									cancelButtonColor: "#d33",
									confirmButtonText: "Yes",
								}).then((result) => {
									if (result.isConfirmed) {
										$.ajax({
											url: "move_lead_to_prospect",
											method: "POST",
											data: { id: last_inserted_id },
											success: function (response) {
												notification_log(last_inserted_id);
												Swal.fire(
													"",
													"This Lead Has been Moved To Prospect.",
													"success"
												);
											},
										});
									}
								});
							});

							$("#vechile_type").change(function () {
								var vechile_type = $("#vechile_type").val();

								$.ajax({
									url: "fetch_make",
									method: "POST",
									data: { vechile_type: vechile_type },
									beforeSend: function () {
										$("#vechi_make").prop("disabled", true);
									},
									success: function (response) {
										var obj = jQuery.parseJSON(response);

										var str = "<option value=''>--Select--</option>";
										for (var j = 0; j < obj.length; j++) {
											str +=
												"<option value='" +
												obj[j].id +
												"'>" +
												obj[j].brand_name +
												"</option>";
										}
										$("#vechi_make").html(str);
										$("#vechi_make").prop("disabled", false);
									},
								});
							});

							$("#vechi_make").change(function () {
								var vechile_type = $("#vechile_type").val();
								var vechi_make = $("#vechi_make").val();

								$.ajax({
									url: "fetch_model",
									method: "POST",
									data: { vechile_type: vechile_type, vechi_make: vechi_make },
									beforeSend: function () {
										$("#vechi_model").prop("disabled", true);
									},
									success: function (response) {
										var obj = jQuery.parseJSON(response);

										var str = "<option value=''>--Select--</option>";
										for (var j = 0; j < obj.length; j++) {
											str +=
												"<option value='" +
												obj[j].id +
												"'>" +
												obj[j].model_name +
												"</option>";
										}
										$("#vechi_model").html(str);
										$("#vechi_model").prop("disabled", false);
									},
								});
							});

							$("#vechi_model").change(function () {
								var vechile_type = $("#vechile_type").val();
								var vechi_make = $("#vechi_make").val();
								var vechi_model = $("#vechi_model").val();

								$.ajax({
									url: "fetch_vechile_varient",
									method: "POST",
									data: {
										vechile_type: vechile_type,
										vechi_make: vechi_make,
										vechi_model: vechi_model,
									},
									beforeSend: function () {
										$("#vechi_varient").prop("disabled", true);
									},
									success: function (response) {
										var obj = jQuery.parseJSON(response);

										var str = "<option value=''>--Select--</option>";
										for (var j = 0; j < obj.length; j++) {
											if (vechile_type == 1 || vechile_type == 3) {
												var lastChar =
													obj[j].varient_name[obj[j].varient_name.length - 1];
												if (lastChar == ")") {
													str +=
														"<option value='" +
														obj[j].id +
														"'>" +
														obj[j].varient_name +
														"</option>";
												}
											} else {
												str +=
													"<option value='" +
													obj[j].id +
													"'>" +
													obj[j].varient_name +
													"</option>";
											}
										}
										$("#vechi_varient").html(str);
										$("#vechi_varient").prop("disabled", false);
									},
								});
							});

							$("#dob").change(function () {
								var dob = $("#dob").val();
								dob = new Date(dob);
								var today = new Date();
								var age = Math.floor(
									(today - dob) / (365.25 * 24 * 60 * 60 * 1000)
								);
								$("#age").val(age);
							});

							$("#add_follow_up_btn").click(function () {
								var id = $("#last_inserted_id").val();
								var follow_up_status = $("#follow_up_concluded").val();
								var follow_up_reason = $("#follow_up_reason").val();
								var enter_next_follow_date = $("#enter_next_follow_date").val();
								var enter_next_follow_time = $("#enter_next_follow_time").val();
								var follow_comment = $("#follow_comment").val();

								var check = 0;

								if (follow_up_status == "") {
									check = 1;
									Swal.fire("Select Follow Up Concluded ?", "", "question");
								} else if (follow_up_reason === "") {
									check = 1;
									Swal.fire("Select Reason ?", "", "question");
								} else if (enter_next_follow_date == "") {
									check = 1;

									Swal.fire("Select Next Follow Up Date ?", "", "question");
								} else if (enter_next_follow_time == "") {
									check = 1;

									Swal.fire("Select Next Follow Up Time ?", "", "question");
								} else if (check != 1) {
									$.ajax({
										url: "add_follow_up_details",
										method: "POST",
										data: {
											id: id,
											follow_up_status: follow_up_status,
											follow_up_reason: follow_up_reason,
											enter_next_follow_date: enter_next_follow_date,
											enter_next_follow_time: enter_next_follow_time,
											follow_comment: follow_comment,
										},
										beforeSend: function () {
											$("#add_follow_up_btn").attr("disabled", true);
										},
										success: function (response) {
											Swal.fire({
												position: "top-end",
												icon: "success",
												title: "Follow up has been added successfully",
												showConfirmButton: false,
												timer: 1500,
											});
											$("#add_follow_up_btn").attr("disabled", false);
											$("#add_model").modal("toggle");
											var obj = jQuery.parseJSON(response);
											{
												if (obj.last_follow_up_date != "") {
													$("#last_follow_date").val(obj.last_follow_up_date);
												} else {
													$("#last_follow_date").val(enter_next_follow_date);
												}
											}

											$("#prospect_btn").removeClass("hidden");
											$("#sms_btn").removeClass("hidden");
											$("#policy_btn").removeClass("hidden");

											$("#next_follow_date").val(enter_next_follow_date);
											$("#next_follow_time").val(enter_next_follow_time);
											$("#last_status_update").val(obj.last_status_update);
											notification_log(id);
										},
									});
								}
							});

							$("#reset_btn").click(function () {
								var follow_up_status = $("#follow_up_concluded").val("");
								var follow_up_reason = $("#follow_up_reason").val("");
								var enter_next_follow_date = $("#enter_next_follow_date").val(
									""
								);
								var enter_next_follow_time = $("#enter_next_follow_time").val(
									""
								);
								var follow_comment = $("#follow_comment").val("");
							});

							$("#v_regn_no_4").change(function () {
								var v_regn_no_1 = $("#v_regn_no_1").val();
								var v_regn_no_2 = $("#v_regn_no_2").val();
								var v_regn_no_3 = $("#v_regn_no_3").val();
								var v_regn_no_4 = $("#v_regn_no_4").val();
								$.ajax({
									url: "fetch_vechile_number_check",
									method: "POST",
									dataType: "json",
									data: {
										v_regn_no_1: v_regn_no_1,
										v_regn_no_2: v_regn_no_2,
										v_regn_no_3: v_regn_no_3,
										v_regn_no_4: v_regn_no_4,
									},
									success: function (response) {
										var size = Object.keys(response).length;
										if (size > 0) {
											if (response.status == "true") {
												snackbar_show(
													"Already exists the vehicle No. refer Lead ID = " +
														response.refer
												);
												$("#v_regn_no_1").val("");
												$("#v_regn_no_2").val("");
												$("#v_regn_no_3").val("");
												$("#v_regn_no_4").val("");
												$("#v_regn_no_1").focus();
												return;
											}
										}
									},
								});
							});

							$("#policy_class").change(function () {
								var policy_class = $("#policy_class").val();
								$.ajax({
									url: "fetch_policy_type_using_class",
									method: "POST",
									data: { policy_class: policy_class },
									success: function (response) {
										var obj = jQuery.parseJSON(response);

										var str = "<option value=''>--Select--</option>";
										for (var j = 0; j < obj.length; j++) {
											str +=
												"<option value='" +
												obj[j].id +
												"'>" +
												obj[j].policy_type +
												"</option>";
										}
										$("#policy_type").html(str);
									},
								});

								if (policy_class == "1") {
									$("#v_regn_no_div").removeClass("hidden");
								} else if (policy_class == "2") {
									$("#sme_gst_number").addClass("hidden");
									$("#v_regn_no_div").addClass("hidden");
								} else if (policy_class == "3") {
									$("#sme_gst_number").addClass("hidden");
									$("#v_regn_no_div").addClass("hidden");
								} else if (policy_class == "4") {
									$("#sme_gst_number").addClass("hidden");
									$("#v_regn_no_div").addClass("hidden");
								} else if (policy_class == "5") {
									$("#sme_gst_number").addClass("hidden");
									$("#v_regn_no_div").addClass("hidden");
								} else if (policy_class == "16") {
									$("#sme_gst_number").addClass("hidden");
									$("#v_regn_no_div").addClass("hidden");
								} else if (policy_class == "7") {
									$("#sme_gst_number").addClass("hidden");
									$("#v_regn_no_div").addClass("hidden");
								} else if (policy_class == "8") {
									$("#sme_gst_number").addClass("hidden");
									$("#v_regn_no_div").addClass("hidden");
								} else if (policy_class == "9") {
									$("#sme_gst_number").addClass("hidden");
									$("#v_regn_no_div").addClass("hidden");
								} else if (policy_class == "10") {
									$("#sme_gst_number").removeClass("hidden");
									$("#v_regn_no_div").addClass("hidden");
								}
							});

							$("#save_btn").click(function () {
								var client_type = $("#client_type").val();
								var salutation = $("#salutation").val();
								var client_name = $("#client_name").val();
								var initial = $("#initial").val();
								var father_husband_name = $("#father_husband_name").val();
								var dob = $("#dob").val();
								var age = $("#age").val();
								var mobile_no = $("#mobile_no").val();
								var email_id = $("#email_id").val();
								var communication_address = $("#communication_address").val();
								var permanent_address = $("#permanent_address").val();
								var district = $("#district").val();
								var state = $("#state").val();
								var country = $("#country").val();
								var pin_code = $("#pin_code").val();

								var bussiness_type = $("#bussiness_type").val();
								var policy_class = $("#policy_class").val();
								var policy_type = $("#policy_type").val();
								var lead_generated_date = $("#lead_generated_date").val();
								var due_date = $("#due_date").val();

								var v_regn_no_1 = $("#v_regn_no_1").val();
								var v_regn_no_2 = $("#v_regn_no_2").val();
								var v_regn_no_3 = $("#v_regn_no_3").val();
								var v_regn_no_4 = $("#v_regn_no_4").val();

								var v_regn_no =
									v_regn_no_1 +
									"-" +
									v_regn_no_2 +
									"-" +
									v_regn_no_3 +
									"-" +
									v_regn_no_4;

								if ($("#broken_policy").is(":checked")) {
									var broken_policy = "Yes";
								} else {
									var broken_policy = "No";
								}

								var location = $("#location").val();
								var classification = $("#classification").val();
								var source = $("#source").val();
								var agent_pos = $("#agent_pos").val();

								var assign_to_user = $("#assign_to_user").val();
								var area_incharge = $("#area_incharge").val();
								var remarks = $("#remarks").val();
								var gst_number = $("#gst_number").val();

								var check = 0;

								// ✅ Ensure at least one document uploaded
								if (!validateDocuments()) return;

								//  var files = $("#old_policy").prop('files')[0];

								var formdata = new FormData();

								// === FILE UPLOADS (5 Document Types) ===
								formdata.append("doc_aadhar", $("#doc_aadhar")[0].files[0]);
								formdata.append("doc_pan", $("#doc_pan")[0].files[0]);
								formdata.append("doc_voter", $("#doc_voter")[0].files[0]);
								formdata.append("doc_dl", $("#doc_dl")[0].files[0]);
								formdata.append("doc_govt", $("#doc_govt")[0].files[0]);
								formdata.append("file", $("#old_policy")[0].files[0]);

								formdata.append("client_type", client_type);
								formdata.append("salutation", salutation);
								formdata.append("client_name", client_name);
								formdata.append("initial", initial);
								formdata.append("father_husband_name", father_husband_name);
								formdata.append("dob", dob);
								formdata.append("age", age);
								formdata.append("mobile_no", mobile_no);
								formdata.append("email_id", email_id);
								formdata.append("communication_address", communication_address);
								formdata.append("permanent_address", permanent_address);
								formdata.append("district", district);
								formdata.append("state", state);
								formdata.append("country", country);
								formdata.append("pin_code", pin_code);

								formdata.append("bussiness_type", bussiness_type);
								formdata.append("policy_class", policy_class);
								formdata.append("policy_type", policy_type);
								formdata.append("lead_generated_date", lead_generated_date);
								formdata.append("due_date", due_date);
								formdata.append("broken_policy", broken_policy);
								formdata.append("location", location);
								formdata.append("classification", classification);
								formdata.append("source", source);
								formdata.append("agent_pos", agent_pos);
								formdata.append("assign_to_user", assign_to_user);
								formdata.append("area_incharge", area_incharge);
								formdata.append("remarks", remarks);
								formdata.append("gst_number", gst_number);
								formdata.append("v_regn_no", v_regn_no);

								var customLabels = [];
								var customValues = [];
								$(".custom_label").each(function () {
									customLabels.push($(this).val());
								});
								$(".custom_value").each(function () {
									customValues.push($(this).val());
								});

								// Append arrays properly
								for (let i = 0; i < customLabels.length; i++) {
									formdata.append("custom_label[]", customLabels[i]);
									formdata.append("custom_value[]", customValues[i]);
								}

								if (client_type == "") {
									snackbar_show("Select Client Type");
									check = 1;
								} else if (client_name == "") {
									snackbar_show("Enter Client Name");
									check = 1;
								} else if (mobile_no == "") {
									snackbar_show("Enter Mobile no");
									check = 1;
								} else if (bussiness_type == "") {
									snackbar_show("Select Business Type");
									check = 1;
								} else if (classification == "") {
									snackbar_show("Select Classification type");
									check = 1;
								} else if (policy_class == "") {
									snackbar_show("Select Class");
									check = 1;
								} else if (policy_type == "") {
									snackbar_show("Select Policy Type");
									check = 1;
								} else if (lead_generated_date == "") {
									snackbar_show("Select Lead Generated Date");
									check = 1;
								} else if (agent_pos == "" || agent_pos == null) {
									snackbar_show("Select Agents And Pos");
									check = 1;
								} else if (assign_to_user == "" || assign_to_user == null) {
									snackbar_show("Select Assign To User");
									check = 1;
								} else if (area_incharge == "" || area_incharge == null) {
									snackbar_show("Select Area Incharge");
									check = 1;
								} else if (check != 1) {
									$.ajax({
										url: "add_lead_details",
										method: "POST",
										data: formdata,
										processData: false,
										contentType: false,
										cache: false,
										dataType: "text",
										beforeSend: function () {
											$("#save_btn").attr("disabled", true);
										},
										success: function (response) {
											if (response == "Exits") {
												snackbar_show(
													"Vechicle Registration Number Already Exits"
												);
												$("#save_btn").attr("disabled", false);
											} else {
												Swal.fire({
													position: "top-end",
													icon: "success",
													title: "Lead Created Successfully",
													showConfirmButton: false,
													timer: 1500,
												});
												$("#save_btn").attr("disabled", false);
												$("#save_btn").addClass("hidden");
												$("#update_btn").removeClass("hidden");
												$("#follow_up_hidden").removeClass("hidden");
												$("#vechicle_hidden").removeClass("hidden");
												window.location.href = "leads";
											}
										},
									});
								}
							});
                             
                            // ===== Registration Certificate (RC) File Preview =====
                            $("#regn_certificate").on("change", function (event) {
                                const file = event.target.files[0];
                                if (file) {
                                    const allowed = ["image/jpeg", "image/jpg", "image/png", "application/pdf"];
                                    if (!allowed.includes(file.type)) {
                                    Swal.fire("Invalid file type!", "Please upload JPG, PNG, or PDF only.", "error");
                                    $(this).val(""); // reset input
                                    $("#rc_preview").hide();
                                    $("#rc_pdf_link").hide();
                                    return;
                                    }

                                    if (file.type === "application/pdf") {
                                    // Show PDF link instead of image preview
                                    $("#rc_preview").hide();
                                    const blobURL = URL.createObjectURL(file);
                                    $("#rc_pdf_link").attr("href", blobURL).show();
                                    } else {
                                    // Show image preview
                                    $("#rc_pdf_link").hide();
                                    const reader = new FileReader();
                                    reader.onload = function (e) {
                                        $("#rc_preview").attr("src", e.target.result).show();
                                    };
                                    reader.readAsDataURL(file);
                                    }
                                }
                            });

							$("#add_vechile_btn").click(function () {
								var id = $("#last_inserted_id").val();
								var vechile_type = "1";
								var policy_type = $("#vechile_type").val();
								var vechi_make = $("#vechi_make").val();
								var vechi_model = $("#vechi_model").val();
								var vechi_varient = $("#vechi_varient").val();
								var vechi_cc = $("#vechi_cc").val();
								var vechi_manu_month = $("#vechi_manu_month").val();
								var vechi_manu_year = $("#vechi_manu_year").val();
								var vechi_seating = $("#vechi_seating").val();
								var vechi_classfication = $("#vechi_classfication").val();
								var vechi_fuel_type = $("#vechi_fuel_type").val();
								var vechi_gvw = $("#vechi_gvw").val();
								var passenger_carrying = $("#passenger_carrying").val();
								var vechi_engine_num = $("#vechi_engine_num").val();
								var vechi_chassis_num = $("#vechi_chassis_num").val();
								var vechi_hypothecation = $("#vechi_hypothecation").val();
								var created_user = $("#created_user").val();
								var vechi_remarks = $("#vechi_remarks").val();
								var regn_no_1 = $("#regn_no_1").val();
								var regn_no_2 = $("#regn_no_2").val();
								var regn_no_3 = $("#regn_no_3").val();
								var regn_no_4 = $("#regn_no_4").val();
								var regn_date = $("#regn_date").val();
								var register_no =
									regn_no_1 +
									"-" +
									regn_no_2 +
									"-" +
									regn_no_3 +
									"-" +
									regn_no_4;
								var rto = $("#rto").val();
								var zone = $("#zone").val();
								var regn_address = $("#regn_address").val();
								// ✅ Always get the Select2-selected value
								// Get the state ID (from client dropdown) and state name (for display)
								var stateId = $("#state").val(); // from client form (ID)
								var stateName = $("#state option:selected").text().trim(); // name (optional for display)
								// If registration section has dropdown, use its value directly
								var regnStateId = $("#regn_state").val() || stateId;
								var city = $("#regn_city").val();
								var country = $("#regn_country").val();
								var pincode = $("#regn_pincode").val();
								var vechi_user_name = ""; //$("#vechi_user_name").val();
								var vechi_user_cont = ""; //$("#vechi_user_cont").val();
								var business_type = $("#bussiness_type").val();

								var check = 0;

								if (policy_type == "") {
									check = 1;
									Swal.fire("Select Vechicle Type?", "", "question");
								} else if (vechi_make == "") {
									check = 1;
									Swal.fire("Select Vechicle Make ?", "", "question");
								} else if (vechi_fuel_type == "") {
									check = 1;
									Swal.fire("Select Vechicle Fuel Type ?", "", "question");
								} else if (vechi_model == "") {
									check = 1;
									Swal.fire("Select Vechicle Model ?", "", "question");
								} else if (
									(policy_type == "1" ||
										policy_type == "2" ||
										policy_type == "3" ||
										policy_type == "4") &&
									vechi_varient == ""
								) {
									check = 1;
									Swal.fire("Select Varient ?", "", "question");
								} else if (
									(policy_type == "1" ||
										policy_type == "2" ||
										policy_type == "3") &&
									vechi_cc == ""
								) {
									check = 1;
									Swal.fire("Enter CC ?", "", "question");
								} else if (vechi_engine_num == "") {
									check = 1;
									Swal.fire("Enter Engine Number ?", "", "question");
								} else if (vechi_chassis_num == "") {
									check = 1;
									Swal.fire("Enter Chassis Number ?", "", "question");
								} else if (vechi_manu_month == "") {
									check = 1;
									Swal.fire("Select manufacure month ?", "", "question");
								} else if (vechi_manu_year == "") {
									check = 1;
									Swal.fire("Select manufacure Year ?", "", "question");
								} else if (
									(policy_type == "7" ||
										policy_type == "12" ||
										policy_type == "13" ||
										policy_type == "14" ||
										policy_type == "59" ||
										policy_type == "60" ||
										policy_type == "66") &&
									passenger_carrying == ""
								) {
									check = 1;
									Swal.fire("Enter passenger carrying ?", "", "question");
								} else if (
									(policy_type == "8" ||
										policy_type == "9" ||
										policy_type == "10" ||
										policy_type == "11" ||
										policy_type == "15" ||
										policy_type == "16" ||
										policy_type == "17" ||
										policy_type == "61") &&
									vechi_gvw == ""
								) {
									check = 1;
									Swal.fire("Enter GVW ?", "", "question");
								} else if (
									business_type != "3" &&
									(regn_no_1 == "" ||
										regn_no_2 == "" ||
										regn_no_3 == "" ||
										regn_no_4 == "")
								) {
									check = 1;
									Swal.fire("Enter Vechicle Register No ?", "", "question");
								} else if (rto == "") {
									check = 1;
									Swal.fire("Select Rto ?", "", "question");
								} else if (state == "") {
									check = 1;
									Swal.fire("Select State ?", "", "question");
								} else if (pincode && (!/^\d{6}$/.test(pincode))) {
									check = 1;
									Swal.fire("Enter a valid 6-digit Pincode", "", "question");
								} else if (check != 1) {
									var formdata = new FormData();
									formdata.append("id", id);
									formdata.append("vechile_type", vechile_type);
									formdata.append("policy_type", policy_type);
									formdata.append("vechi_make", vechi_make);
									formdata.append("vechi_model", vechi_model);
									formdata.append("vechi_varient", vechi_varient);
									formdata.append("vechi_cc", vechi_cc);
									formdata.append("vechi_manu_month", vechi_manu_month);
									formdata.append("vechi_manu_year", vechi_manu_year);
									formdata.append("vechi_seating", vechi_seating);
									formdata.append("vechi_classfication", vechi_classfication);
									formdata.append("vechi_fuel_type", vechi_fuel_type);
									formdata.append("vechi_gvw", vechi_gvw);
									formdata.append("vechi_engine_num", vechi_engine_num);
									formdata.append("passenger_carrying", passenger_carrying);
									formdata.append("vechi_chassis_num", vechi_chassis_num);
									formdata.append("vechi_hypothecation", vechi_hypothecation);
									formdata.append("created_user", created_user);
									formdata.append("vechi_remarks", vechi_remarks);
									formdata.append("register_no", register_no);
									formdata.append("regn_date", regn_date);
									formdata.append("rto", rto);
									formdata.append("zone", zone);
									formdata.append("regn_address", regn_address);
									formdata.append("regn_state", regnStateId);
									formdata.append("regn_city", city);
									formdata.append("regn_country", country);
									formdata.append("regn_pincode", pincode);
									formdata.append("vechi_user_name", vechi_user_name);
									formdata.append("vechi_user_cont", vechi_user_cont);

									// ✅ Collect Additional Fields dynamically
									var additionalLabels = [];
									var additionalValues = [];

									$("input[name='additional_label[]']").each(function () {
									additionalLabels.push($(this).val());
									});
									$("input[name='additional_value[]']").each(function () {
									additionalValues.push($(this).val());
									});

									// Convert to JSON and append
									if (additionalLabels.length > 0) {
										var additionalFields = [];
										for (let i = 0; i < additionalLabels.length; i++) {
											if (additionalLabels[i] !== "") {
											additionalFields.push({
												label: additionalLabels[i],
												value: additionalValues[i] || "",
											});
											}
										}
										formdata.append("additional_fields", JSON.stringify(additionalFields));
									}

                                    // ✅ Add this right here
                                    var regn_certificate = $("#regn_certificate")[0].files[0];
                                    if (regn_certificate) {
                                    formdata.append("regn_certificate", regn_certificate);
                                    }

									// ✅ Handle all 30 vehicle photo uploads
									var photoFields = [
										"front_view", "back_view", "left_side_view", "right_side_view", "dashboard",
										"interior_front_seats", "interior_back_seats", "engine_compartment", "boot_space",
										"tyre_front_left", "tyre_front_right", "tyre_rear_left", "tyre_rear_right",
										"number_plate_front", "number_plate_back", "roof", "windshield_front",
										"windshield_rear", "chassis_number_area", "odometer_reading", "battery_area",
										"tool_kit_area", "spare_wheel", "music_system", "ac_control_panel",
										"steering_area", "gear_console", "mirror_inside", "mirror_outside", "documents_photo"
									];

									// Append all files if selected
									photoFields.forEach(function (fieldName) {
											let input = $(`input[name='${fieldName}']`)[0];
											if (input && input.files && input.files.length > 0) {
												formdata.append(fieldName, input.files[0]);
										}
									});

									// ✅ Handle vehicle video upload (single file)
									var vehicleVideo = $("#vehicle_video")[0].files[0];
									if (vehicleVideo) {
										formdata.append("vehicle_video", vehicleVideo);
									}

									$.ajax({
										url: "add_vechile_details",
										method: "POST",
										data: formdata,
										processData: false,
										contentType: false,
										cache: false,
										dataType: "text",
										beforeSend: function (response) {
											$("#add_vechile_btn").attr("disabled", true);
										},
										success: function (response) {
											if (response == "Exits") {
												$("#add_vechile_btn").attr("disabled", false);
												snackbar_show("Vechicle Regn no Already Exits...");
											} else {
												Swal.fire({
													position: "top-end",
													icon: "success",
													title: "Vechile Details Has Been Added Successfully",
													showConfirmButton: false,
													timer: 1500,
												});
												$("#add_vechile_btn").attr("disabled", false);
												$("#add_vechile_model").modal("toggle");

												$("#edit_vechicle_btn").removeClass("hidden");
												$("#add_vechi_btn").addClass("hidden");

												$("#view_vechi_details").removeClass("hidden");

												var id = $("#last_inserted_id").val();

												gen_policy_status = "1";

												$.ajax({
													url: "get_vechile_details",
													method: "POST",
													data: { id: id },
													success: function (response) {
														var obj = jQuery.parseJSON(response);
														if (obj != null && obj != "") {
															$("#view_make_model").val(
																obj.brand_name +
																	" " +
																	obj.model_name +
																	" " +
																	obj.varient_name
															);
															$("#view_engine_no").val(obj.vechi_engine_num);
															$("#view_regn_no").val(obj.vechi_register_no);
															$("#view_chassis").val(obj.vechi_chassis_num);
														}

														$("#quotation_box_hidden").removeClass("hidden");

														notification_log(id);
													},
												});
											}
										},
									});
								}
							});
                            
							// ================== Copy Client Address to Registration Section ==================

							// Communication checkbox
							$("#copy_client_comm_address").on("change", function () {
								if ($(this).is(":checked")) {
									$("#copy_client_perm_address").prop("checked", false); // uncheck other
									copyClientToRegn("comm");
									Swal.fire({
										icon: "info",
										title: "Address Copied",
										text: "Client Communication Address copied to Registration.",
										timer: 1400,
										showConfirmButton: false,
									});
								} else {
									// clear only registration fields (leave client untouched)
									$("#regn_address, #regn_city, #regn_state, #regn_country, #regn_pincode").val("");
								}
							});

							// Permanent checkbox
							$("#copy_client_perm_address").on("change", function () {
								if ($(this).is(":checked")) {
									$("#copy_client_comm_address").prop("checked", false); // uncheck other
									copyClientToRegn("perm");
									Swal.fire({
										icon: "info",
										title: "Address Copied",
										text: "Client Permanent Address copied to Registration.",
										timer: 1400,
										showConfirmButton: false,
									});
								} else {
									$("#regn_address, #regn_city, #regn_state, #regn_country, #regn_pincode").val("");
								}
							});
							

							// ================== Vehicle Video Upload Handling ==================
							$("#vehicle_video").on("change", function (event) {
								const file = this.files[0];
								if (!file) return;

								// Preview video
								const videoUrl = URL.createObjectURL(file);
								$("#vehicle_video_preview").attr("src", videoUrl).show();

								// Optional: show confirmation
								Swal.fire({
									icon: "info",
									title: "Video Selected",
									text: "Your video will be automatically compressed before upload.",
									timer: 1500,
									showConfirmButton: false,
								});
							});


							$("#document_file").change(function () {
								var document_type = $("#document_type").val();
								var last_inserted_id = $("#last_inserted_id").val();
								var files = $("#document_file").prop("files")[0];
								var formdata = new FormData();
								formdata.append("file", files);
								formdata.append("id", last_inserted_id);
								formdata.append("document_type", document_type);

								$.ajax({
									type: "POST",
									url: "upload_document_files",
									data: formdata,
									processData: false,
									contentType: false,
									cache: false,
									dataType: "text",
									success: function (response) {
										var document_type = $("#document_type").val("");
										var files = $("#document_file").val("");
										$("#table_view").append(response);
									},
								});
							});

							// health

							$("#h_gender").change(function () {
								var gender = $("#h_gender").val();

								var html = "";

								if (gender != "Male") {
									html += "<option value='You'>You</option>";
									html += "<option value='Husband'>Husband</option>";
									html += "<option value='Daughter'>Daughter</option>";
									html += "<option value='Son'>Son</option>";
									html += "<option value='Father'>Father</option>";
									html += "<option value='Mother'>Mother</option>";

									var img = document.createElement("IMG");
									img.src = "../datas/icons/wife.png";
									$("#ins_div").html(img);
									$("#ins_div").addClass("img_style");

									var img_1 = document.createElement("IMG");
									img_1.src = "../datas/icons/male1.png";
									$("#hus_wife_div").html(img_1);
									$("#hus_wife_div").addClass("img_style");
								} else {
									html += "<option value='You'>You</option>";
									html += "<option value='Spouse'>Wife</option>";
									html += "<option value='Daughter'>Daughter</option>";
									html += "<option value='Son'>Son</option>";
									html += "<option value='Father'>Father</option>";
									html += "<option value='Mother'>Mother</option>";

									var img = document.createElement("IMG");
									img.src = "../datas/icons/male1.png";
									$("#ins_div").html(img);
									$("#ins_div").addClass("img_style");

									var img_1 = document.createElement("IMG");
									img_1.src = "../datas/icons/wife.png";
									$("#hus_wife_div").html(img_1);
									$("#hus_wife_div").addClass("img_style");
								}
								$("#h_family_members").html(html);
							});

							$("#h_family_members").change(function () {
								var h_family_members = $("#h_family_members").val();
								var You = jQuery.inArray("You", h_family_members);
								var gender = $("#h_gender").val();

								var content = "";

								if (You != "-1") {
									$("#you_div").removeClass("hidden");
								}

								var Husband = jQuery.inArray("Husband", h_family_members);
								var Wife = jQuery.inArray("Spouse", h_family_members);

								if (Wife != "-1") {
									$("#label_id").html("Wife");
									$("#husband_wife_div").removeClass("hidden");
								}

								if (Husband != "-1") {
									$("#label_id").html("Husband");
									$("#husband_wife_div").removeClass("hidden");
								}

								var Daughter = jQuery.inArray("Daughter", h_family_members);
								var Son = jQuery.inArray("Son", h_family_members);

								var Father = jQuery.inArray("Father", h_family_members);
								var Mother = jQuery.inArray("Mother", h_family_members);

								if (Father != "-1") {
									$("#father_div").removeClass("hidden");
								} else {
									$("#father_div").addClass("hidden");
								}
								if (Mother != "-1") {
									$("#mother_div").removeClass("hidden");
								} else {
									$("#mother_div").addClass("hidden");
								}

								var html = "";

								if (Daughter != "-1" && Son != "-1") {
									html += "<div class='col-md-6' id=''>";
									html += "<label>No of Daughter's</label>";
									html += "<div class='input-group'>";
									html +=
										"<span class='input-group-addon'><i class='fa fa-minus' onclick='daughters_minus()'></i></span><input type='text' class='form-control' name='num_daughters' id='num_daughters' value='1'>";
									html +=
										" <span class='input-group-addon'><i class='fa fa-plus' onclick='daughters()'></i></span>";
									html += " </div>";
									html += " </div>";

									html += "<div class='col-md-6'>";
									html += "<label>No of Sons's</label>";
									html += "<div class='input-group'>";
									html +=
										" <span class='input-group-addon'><i class='fa fa-minus' onclick='son_minus()'></i></span><input type='text' class='form-control' name='num_sons' id='num_sons' value='1'>";
									html +=
										"<span class='input-group-addon'><i class='fa fa-plus' onclick='sons()'></i></span>";
									html += "</div>";
									html += "</div>";

									childrens = 2;

									$("#daughter_div1").removeClass("hidden");
									$("#son_div1").removeClass("hidden");
								} else if (Daughter != "-1") {
									html += "<div class='col-md-12'>";
									html += "<label>No of Daughter's</label>";
									html += "<div class='input-group'>";
									html +=
										"<span class='input-group-addon'><i class='fa fa-minus' onclick='daughters_minus()'></i></span><input type='text' class='form-control' name='num_daughters' id='num_daughters' value='1'>";
									html +=
										"<span class='input-group-addon'><i class='fa fa-plus'  onclick='daughters()'></i></span>";
									html += "</div>";
									html += "</div>";
									$("#daughter_div1").removeClass("hidden");
									$("#son_div1").addClass("hidden");

									childrens = 1;
								} else if (Son != "-1") {
									html += "<div class='col-md-6'>";
									html += "<label>No of Sons's</label>";
									html += "<div class='input-group'>";
									html +=
										" <span class='input-group-addon'><i class='fa fa-minus' onclick='son_minus()'></i></span><input type='text' class='form-control' name='num_sons' id='num_sons' value='1'>";
									html +=
										"<span class='input-group-addon'><i class='fa fa-plus' onclick='sons()'></i></span>";
									html += "</div>";
									html += "</div>";
									$("#daughter_div1").addClass("hidden");
									$("#son_div1").removeClass("hidden");
									childrens = 1;
								} else {
									html += "";
								}
								$("#row_id").html(html);
							});

							$("#edit_h_family_members").change(function () {
								var h_family_members = $("#edit_h_family_members").val();
								var You = jQuery.inArray("You", h_family_members);
								var gender = $("#edit_h_gender").val();

								var content = "";

								if (You != "-1") {
									$("#edit_you_div").removeClass("hidden");
								}

								var Husband = jQuery.inArray("Husband", h_family_members);
								var Wife = jQuery.inArray("Spouse", h_family_members);

								if (Wife != "-1") {
									$("#label_id").html("Wife");
									$("#edit_husband_wife_div").removeClass("hidden");
								}

								if (Husband != "-1") {
									$("#label_id").html("Husband");
									$("#edit_husband_wife_div").removeClass("hidden");
								}

								var Daughter = jQuery.inArray("Daughter", h_family_members);
								var Son = jQuery.inArray("Son", h_family_members);

								var Father = jQuery.inArray("Father", h_family_members);
								var Mother = jQuery.inArray("Mother", h_family_members);

								if (Father != "-1") {
									$("#edit_father_div").removeClass("hidden");
								} else {
									$("#edit_father_div").addClass("hidden");
								}

								if (Mother != "-1") {
									$("#edit_mother_div").removeClass("hidden");
								} else {
									$("#edit_mother_div").addClass("hidden");
								}

								var html = "";

								if (Daughter != "-1" && Son != "-1") {
									html += "<div class='col-md-6' id=''>";
									html += "<label>No of Daughter's</label>";
									html += "<div class='input-group'>";
									html +=
										"<span class='input-group-addon'><i class='fa fa-minus' onclick='edit_daughters_minus()'></i></span><input type='text' class='form-control' name='edit_num_daughters' id='edit_num_daughters' value='1'>";
									html +=
										" <span class='input-group-addon'><i class='fa fa-plus' onclick='edit_daughters()'></i></span>";
									html += " </div>";
									html += " </div>";

									html += "<div class='col-md-6'>";
									html += "<label>No of Sons's</label>";
									html += "<div class='input-group'>";
									html +=
										" <span class='input-group-addon'><i class='fa fa-minus' onclick='edit_son_minus()'></i></span><input type='text' class='form-control' name='edit_num_sons' id='edit_num_sons' value='1'>";
									html +=
										"<span class='input-group-addon'><i class='fa fa-plus' onclick='edit_sons()'></i></span>";
									html += "</div>";
									html += "</div>";

									$("#edit_daughter_div1").removeClass("hidden");
									$("#edit_son_div1").removeClass("hidden");
								} else if (Daughter != "-1") {
									html += "<div class='col-md-12'>";
									html += "<label>No of Daughter's</label>";
									html += "<div class='input-group'>";
									html +=
										"<span class='input-group-addon'><i class='fa fa-minus' onclick='edit_daughters_minus()'></i></span><input type='text' class='form-control' name='edit_num_daughters' id='edit_num_daughters' value='1'>";
									html +=
										"<span class='input-group-addon'><i class='fa fa-plus'  onclick='edit_daughters()'></i></span>";
									html += "</div>";
									html += "</div>";
									$("#edit_daughter_div1").removeClass("hidden");
									$("#son_div1").addClass("hidden");
								} else if (Son != "-1") {
									html += "<div class='col-md-6'>";
									html += "<label>No of Sons's</label>";
									html += "<div class='input-group'>";
									html +=
										" <span class='input-group-addon'><i class='fa fa-minus' onclick='edit_son_minus()'></i></span><input type='text' class='form-control' name='edit_num_sons' id='edit_num_sons' value='1'>";
									html +=
										"<span class='input-group-addon'><i class='fa fa-plus' onclick='edit_sons()'></i></span>";
									html += "</div>";
									html += "</div>";
									$("#edit_daughter_div1").addClass("hidden");
									$("#edit_son_div1").removeClass("hidden");
								} else {
									html += "";
								}
								$("#edit_row_id").html(html);
							});

							$("#add_health_btn").click(function () {
								var lead_id = $("#last_inserted_id").val();
								var h_gender = $("#h_gender").val();
								var h_family_members = $("#h_family_members").val();
								var num_daughters = $("#num_daughters").val();
								var num_sons = $("#num_sons").val();
								var you_age = $("#you_age").val();
								var hus_wife_age = $("#hus_wife_age").val();

								var created_id = $("#created_id").val();

								if (h_gender == "Male") {
									for (var i = 0; i < h_family_members.length; i++) {
										if (h_family_members[i] == "You") {
											Husband = 1;
											Husband_name = $("#add_you_name").val();
											Husband_dob = $("#add_dob").val();
											Husband_age = $("#you_age").val();
										}

										if (h_family_members[i] == "Spouse") {
											Wife_name = $("#hus_wife_name").val();
											Wife_dob = $("#add_hus_wife_dob").val();
											Wife = 1;
											Wife_age = $("#hus_wife_age").val();
										}

										if (h_family_members[i] == "Son") {
											Son = 1;
										}

										if (h_family_members[i] == "Daughter") {
											Daughter = 1;
										}

										if (h_family_members[i] == "Father") {
											Father = 1;
										}

										if (h_family_members[i] == "Mother") {
											Mother = 1;
										}
									}
								} else if (h_gender == "Female") {
									for (var i = 0; i < h_family_members.length; i++) {
										if (h_family_members[i] == "You") {
											Wife = 1;
											Wife_age = $("#you_age").val();

											Wife_name = $("#add_you_name").val();
											Wife_dob = $("#add_dob").val();
										}

										if (h_family_members[i] == "Husband") {
											Husband = 1;

											Husband_name = $("#hus_wife_name").val();
											Husband_dob = $("#add_hus_wife_dob").val();
											Husband_age = $("#hus_wife_age").val();
										}
										if (h_family_members[i] == "Son") {
											Son = 1;
										}

										if (h_family_members[i] == "Daughter") {
											Daughter = 1;
										}

										if (h_family_members[i] == "Father") {
											Father = 1;
										}
										if (h_family_members[i] == "Mother") {
											Mother = 1;
										}
									}
								}
								var daughter_name_1 = $("#add_daughter_name_1").val();
								var daughter_name_2 = $("#add_daughter_name_2").val();
								var daughter_name_3 = $("#add_daughter_name_3").val();
								var daughter_name_4 = $("#add_daughter_name_4").val();

								var daughter_dob_1 = $("#add_daughter_dob_1").val();
								var daughter_dob_2 = $("#add_daughter_dob_2").val();
								var daughter_dob_3 = $("#add_daughter_dob_3").val();
								var daughter_dob_4 = $("#add_daughter_dob_4").val();

								var daughter_1_age = $("#daughter_age_1").val();
								var daughter_2_age = $("#daughter_age_2").val();
								var daughter_3_age = $("#daughter_age_3").val();
								var daughter_4_age = $("#daughter_age_4").val();

								var son_name_1 = $("#add_son_name_1").val();
								var son_name_2 = $("#add_son_name_2").val();
								var son_name_3 = $("#add_son_name_3").val();
								var son_name_4 = $("#add_son_name_4").val();

								var son_dob_1 = $("#add_son_dob_1").val();
								var son_dob_2 = $("#add_son_dob_2").val();
								var son_dob_3 = $("#add_son_dob_3").val();
								var son_dob_4 = $("#add_son_dob_4").val();

								var son_1_age = $("#son_age_1").val();
								var son_2_age = $("#son_age_2").val();
								var son_3_age = $("#son_age_3").val();
								var son_4_age = $("#son_age_4").val();

								var father_name = $("#add_father_name").val();
								var father_dob = $("#add_father_dob").val();
								var father_age = $("#father_age").val();

								var mother_name = $("#add_mother_name").val();
								var dob_mother = $("#add_dob_mother").val();
								var mother_age = $("#mother_age").val();

								var formdata = new FormData();

								formdata.append("created_id", created_id);
								formdata.append("lead_id", lead_id);
								formdata.append("h_gender", h_gender);
								formdata.append("Husband", Husband);
								formdata.append("Wife", Wife);

								formdata.append("Husband_name", Husband_name);
								formdata.append("Husband_dob", Husband_dob);

								formdata.append("Wife_name", Wife_name);
								formdata.append("Wife_dob", Wife_dob);

								formdata.append("Son", Son);
								formdata.append("Daughter", Daughter);
								formdata.append("Father", Father);
								formdata.append("Mother", Mother);
								formdata.append("Husband_age", Husband_age);
								formdata.append("Wife_age", Wife_age);
								formdata.append("num_daughters", num_daughters);
								formdata.append("num_sons", num_sons);

								formdata.append("son_name_1", son_name_1);
								formdata.append("son_name_2", son_name_2);
								formdata.append("son_name_3", son_name_3);
								formdata.append("son_name_4", son_name_4);

								formdata.append("son_dob_1", son_dob_1);
								formdata.append("son_dob_2", son_dob_2);
								formdata.append("son_dob_3", son_dob_3);
								formdata.append("son_dob_4", son_dob_4);

								formdata.append("son_1_age", son_1_age);
								formdata.append("son_2_age", son_2_age);
								formdata.append("son_3_age", son_3_age);
								formdata.append("son_4_age", son_4_age);

								formdata.append("daughter_name_1", daughter_name_1);
								formdata.append("daughter_name_2", daughter_name_2);
								formdata.append("daughter_name_3", daughter_name_3);
								formdata.append("daughter_name_4", daughter_name_4);

								formdata.append("daughter_dob_1", daughter_dob_1);
								formdata.append("daughter_dob_2", daughter_dob_2);
								formdata.append("daughter_dob_3", daughter_dob_3);
								formdata.append("daughter_dob_4", daughter_dob_4);

								formdata.append("daughter_1_age", daughter_1_age);
								formdata.append("daughter_2_age", daughter_2_age);
								formdata.append("daughter_3_age", daughter_3_age);
								formdata.append("daughter_4_age", daughter_4_age);

								formdata.append("father_name", father_name);
								formdata.append("father_dob", father_dob);
								formdata.append("father_age", father_age);

								formdata.append("mother_name", mother_name);
								formdata.append("dob_mother", dob_mother);
								formdata.append("mother_age", mother_age);

								var check = "0";

								if (h_gender == "") {
									Swal.fire(
										"Select Gender?",
										"That thing is still around?",
										"question"
									);
									check = "1";
								} else if (h_family_members == null || h_family_members == "") {
									Swal.fire(
										"Select Members You Want To Insure?",
										"That thing is still around?",
										"question"
									);
									check = "1";
								} else if (
									jQuery.inArray("You", h_family_members) !== -1 &&
									$("#add_you_name").val() == ""
								) {
									Swal.fire(
										"Select Insurer Name?",
										"That thing is still around?",
										"question"
									);
									check = "1";
								} else if (
									jQuery.inArray("You", h_family_members) !== -1 &&
									$("#add_dob").val() == ""
								) {
									Swal.fire(
										"Select Insurer DOB?",
										"That thing is still around?",
										"question"
									);
									check = "1";
								} else if (
									jQuery.inArray("You", h_family_members) !== -1 &&
									$("#you_age").val() == ""
								) {
									Swal.fire(
										"Select Insurer Age ?",
										"That thing is still around?",
										"question"
									);
									check = "1";
								} else if (
									h_gender == "Male" &&
									jQuery.inArray("Spouse", h_family_members) !== -1 &&
									Wife_name == ""
								) {
									Swal.fire(
										"Select Spouse Name?",
										"That thing is still around?",
										"question"
									);
									check = "1";
								} else if (
									h_gender == "Male" &&
									jQuery.inArray("Spouse", h_family_members) !== -1 &&
									Wife_dob == ""
								) {
									Swal.fire(
										"Select Spouse DOB?",
										"That thing is still around?",
										"question"
									);
									check = "1";
								} else if (
									h_gender == "Male" &&
									jQuery.inArray("Spouse", h_family_members) !== -1 &&
									Wife_age == ""
								) {
									Swal.fire(
										"Select Spouse Age?",
										"That thing is still around?",
										"question"
									);
									check = "1";
								} else if (
									h_gender == "Female" &&
									jQuery.inArray("Spouse", h_family_members) !== -1 &&
									Husband_name == ""
								) {
									Swal.fire(
										"Select Husband Name?",
										"That thing is still around?",
										"question"
									);
									check = "1";
								} else if (
									h_gender == "Female" &&
									jQuery.inArray("Spouse", h_family_members) !== -1 &&
									Husband_dob == ""
								) {
									Swal.fire(
										"Select Husband DOB?",
										"That thing is still around?",
										"question"
									);
									check = "1";
								} else if (
									h_gender == "Female" &&
									jQuery.inArray("Husband", h_family_members) !== -1 &&
									Husband_age == ""
								) {
									Swal.fire(
										"Select Husband Age?",
										"That thing is still around?",
										"question"
									);
									check = "1";
								} else if (check != "1") {
									$.ajax({
										url: "add_health_details",
										method: "POST",
										data: formdata,
										processData: false,
										contentType: false,
										cache: false,
										dataType: "text",
										beforeSend: function () {
											$("#add_health_btn").attr("disabled", true);
										},
										success: function (response) {
											$("#add_health_btn").attr("disabled", false);
											$("#add_health_model").modal("toggle");
											Swal.fire({
												position: "top-end",
												icon: "success",
												title: "Health Details Has Been Added Successfully",
												showConfirmButton: false,
												timer: 1500,
											});
											location.reload();
										},
									});
								}
							});

							// Edit Client

							$("#edit_client_btn").click(function () {
								let timerInterval;
								Swal.fire({
									title: "Loading",
									html: "Fetch Client Data",
									timer: 1000,
									timerProgressBar: true,
									didOpen: () => {
										Swal.showLoading();
										const b = Swal.getHtmlContainer().querySelector("b");
										timerInterval = setInterval(() => {
											b.textContent = Swal.getTimerLeft();
										}, 100);
									},
									willClose: () => {
										clearInterval(timerInterval);
									},
								}).then((result) => {
									/* Read more about handling dismissals below */
									if (result.dismiss === Swal.DismissReason.timer) {
										console.log("I was closed by the timer");
									}
								});

								// 🔹 Enable all form fields
								$(
									"#client_type, #client_name, #salutation, #initial, #father_husband_name, #mobile_no, #add_custom_field, #communication_address, #permanent_address, #district, #state, #country, #email_id, #dob, #age, #pin_code, #add_custom_field"
								).attr("disabled", false);

								// $("input, select, textarea").attr("disabled", false);

								// 🔹 Enable all file inputs
								$(".form-control[type='file']").attr("disabled", false).show();

								// 🔹 Hide document view links (preview) if present
								$("a[id$='_preview']").hide();

								// 🔹 Set highlight border color for editable fields
								const highlightColor = "#6ec3f5";
								$(
									"#client_type, #client_name, #salutation, #initial, #father_husband_name, #mobile_no, #add_custom_field, #communication_address, #permanent_address, #district, #state, #country, #email_id, #dob, #age, #pin_code"
								).css("border-color", highlightColor);

								// 🔹 Swap buttons
								$("#edit_client_btn").addClass("hidden");
								$("#update_client_btn").removeClass("hidden");
							});

							//   $("#update_client_btn").click(function(){

							//      var lead_id = $("#last_inserted_id").val();
							//      var client_type = $("#client_type").val();
							//      var client_name = $("#client_name").val();
							//      var salutation = $("#salutation").val();
							//      var initial = $("#initial").val();
							//      var add_custom_field = $("#add_custom_field").val();
							//      var doc_aadhar = $("#doc_aadhar").val();
							//      var doc_pan = $("#doc_pan").val();
							//      var doc_voter = $("#doc_voter").val();
							//      var doc_dl = $("#doc_dl").val();
							//      var doc_govt = $("#doc_govt").val();
							//      var communication_address = $("#communication_address").val();
							//      var permanent_address = $("#permanent_address").val();
							//      var district = $("#district").val();
							//      var state = $("#state").val();
							//      var country = $("#country").val();
							//      var mobile_no = $("#mobile_no").val();
							//     //  var other_contact_details = $("#other_contact_details").val();
							//     //  var landline_no= $("#landline_no").val();
							//     //  var address = $("#address").val();
							//      var email_id = $("#email_id").val();
							//     //  var contact_person_name =$("#cont_person_name").val();
							//     //  var contact_person_des = $("#cont_person_des").val();
							//      var dob = $("#dob").val();
							//      var age = $("#age").val();
							//      var area = $("#area").val();
							//      var pin_code = $("#pin_code").val();

							//      $.ajax({
							//             url : "update_client_details",
							//             method : "POST",
							//             data:{
							//                    lead_id : lead_id,
							//                    client_type:client_type,
							//                    client_name:client_name,
							//                    salutation:salutation,
							//                    initial:initial,
							//                    add_custom_field:add_custom_field,
							//                    doc_aadhar:doc_aadhar,
							//                    doc_pan:doc_pan,
							//                    doc_voter:doc_voter,
							//                    doc_dl:doc_dl,
							//                    doc_govt:doc_govt,
							//                    communication_address:communication_address,
							//                    permanent_address:permanent_address,
							//                    district:district,
							//                    state:state,
							//                    country:country,
							//                    mobile_no:mobile_no,
							//                 //    other_contact_details:other_contact_details,
							//                 //    landline_no:landline_no,
							//                 //    address:address,
							//                    email_id:email_id,
							//                 //    contact_person_name:contact_person_name,
							//                 //    contact_person_des:contact_person_des,
							//                    dob:dob,
							//                    age:age,
							//                    area:area,
							//                    pin_code:pin_code
							//             },
							//             beforeSend:function(){
							//                 $("#update_client_btn").attr("disabled",true);
							//             },
							//             success:function(response)
							//             {
							//                     Swal.fire({
							//                     position: 'top-end',
							//                     icon: 'success',
							//                     title: 'Client Details updated Successfully',
							//                     showConfirmButton: false,
							//                     timer: 1500
							//                     })
							//                 $("#update_client_btn").attr("disabled",false);
							//                 window.location.href="create_lead?id="+lead_id;
							//                 notification_log(lead_id)
							//             }
							//      });

							//   });

							$("#update_client_btn").click(function (e) {
								e.preventDefault();

								var lead_id = $("#last_inserted_id").val();
								if (!lead_id) {
									Swal.fire("Error", "Missing Lead ID.", "error");
									return;
								}

								// ✅ Default Tamil Nadu ID for missing state
								const DEFAULT_STATE_ID = 1;
								let selectedState = $("#state").val();
								if (!selectedState || selectedState === "") {
									$("#state").val(DEFAULT_STATE_ID).trigger("change");
								}

								// ✅ Create FormData for file + text data
								var formData = new FormData();
								formData.append("lead_id", lead_id);
								formData.append("client_type", $("#client_type").val());
								formData.append("client_name", $("#client_name").val());
								formData.append("salutation", $("#salutation").val());
								formData.append("initial", $("#initial").val());
								formData.append("father_husband_name", $("#father_husband_name").val());
								formData.append(
									"communication_address",
									$("#communication_address").val()
								);
								formData.append(
									"permanent_address",
									$("#permanent_address").val()
								);
								formData.append("district", $("#district").val());
								// ✅ Ensure we always send the state ID (not text)
								let stateValue = $("#state").find(":selected").val() || $("#state").val();
								formData.append("state", stateValue);
								formData.append("country", $("#country").val());
								formData.append("mobile_no", $("#mobile_no").val());
								formData.append("email_id", $("#email_id").val());
								formData.append("dob", $("#dob").val());
								formData.append("age", $("#age").val());
								formData.append("pin_code", $("#pin_code").val());

								// ✅ Capture dynamically added custom fields
								let customLabels = [];
								let customValues = [];

								$(".custom_label").each(function () {
									customLabels.push($(this).val());
								});
								$(".custom_value").each(function () {
									customValues.push($(this).val());
								});

								// Append arrays (same format as add_lead_details)
								for (let i = 0; i < customLabels.length; i++) {
									formData.append("custom_label[]", customLabels[i]);
									formData.append("custom_value[]", customValues[i]);
								}

								// ✅ Append files if chosen
								var fileInputs = [
									"doc_aadhar",
									"doc_pan",
									"doc_voter",
									"doc_dl",
									"doc_govt",
								];
								fileInputs.forEach(function (id) {
									var file = $("#" + id)[0].files[0];
									if (file) {
										formData.append(id, file);
									}
								});

								// ✅ Disable button during upload
								$("#update_client_btn").attr("disabled", true);

								$.ajax({
									url: "update_client_details",
									method: "POST",
									data: formData,
									processData: false, // Important for file upload
									contentType: false, // Important for FormData
									cache: false,
									success: function (response) {
										$("#update_client_btn").attr("disabled", false);

										if (response.trim() === "success") {
											Swal.fire({
												position: "top-end",
												icon: "success",
												title: "Client Details updated Successfully",
												showConfirmButton: false,
												timer: 1500,
											});

											window.location.href = "create_lead?id=" + lead_id;
											notification_log(lead_id);
										} else if (response.trim() === "unauthorized") {
											Swal.fire(
												"Session Expired",
												"Please log in again.",
												"warning"
											);
										} else {
											Swal.fire(
												"Error",
												"Update failed. Please try again.",
												"error"
											);
										}
									},
									error: function () {
										$("#update_client_btn").attr("disabled", false);
										Swal.fire(
											"Server Error",
											"Unable to update client details.",
											"error"
										);
									},
								});
							});

							// Edit Requirement Details

							$("#edit_req_btn").click(function () {
								$("#bussiness_type").attr("disabled", false);
								$("#policy_class").attr("disabled", false);
								$("#policy_type").attr("disabled", false);
								$("#location").attr("disabled", false);
								$("#classification").attr("disabled", false);
								$("#source").attr("disabled", false);
								$("#agent_pos").attr("disabled", false);
								$("#assign_to_user").attr("disabled", false);
								$("#area_incharge").attr("disabled", false);
								$("#remarks").attr("disabled", false);
								$("#due_date").attr("disabled", false);

								$("#v_regn_no_1").attr("disabled", false);
								$("#v_regn_no_2").attr("disabled", false);
								$("#v_regn_no_3").attr("disabled", false);
								$("#v_regn_no_4").attr("disabled", false);

								$("#bussiness_type").css("border-color", "#6ec3f5");
								$("#policy_class").css("border-color", "#6ec3f5");
								$("#policy_type").css("border-color", "#6ec3f5");
								$("#location").css("border-color", "#6ec3f5");
								$("#classification").css("border-color", "#6ec3f5");
								$("#source").css("border-color", "#6ec3f5");
								$("#agent_pos").attr("disabled", false);
								$("#assign_to_user").css("border-color", "#6ec3f5");
								$("#area_incharge").css("border-color", "#6ec3f5");
								$("#remarks").css("border-color", "#6ec3f5");
								$("#due_date").css("border-color", "#6ec3f5");

								$("#v_regn_no_1").css("border-color", "#6ec3f5");
								$("#v_regn_no_2").css("border-color", "#6ec3f5");
								$("#v_regn_no_3").css("border-color", "#6ec3f5");
								$("#v_regn_no_4").css("border-color", "#6ec3f5");

								$("#edit_req_btn").addClass("hidden");
								$("#update_req_btn").removeClass("hidden");
							});

							$("#update_req_btn").click(function () {
								var lead_id = $("#last_inserted_id").val();
								var bussiness_type = $("#bussiness_type").val();
								var policy_class = $("#policy_class").val();
								var policy_type = $("#policy_type").val();
								var lead_generated_date = $("#lead_generated_date").val();
								var due_date = $("#due_date").val();
								var area_incharge = $("#area_incharge").val();

								if ($("#broken_policy").is(":checked")) {
									var broken_policy = "Yes";
								} else {
									var broken_policy = "No";
								}
								var location = $("#location").val();
								var classification = $("#classification").val();
								var source = $("#source").val();
								var agent_pos = $("#agent_pos").val();
								var assign_to_user = $("#assign_to_user").val();
								var area_incharge = $("#area_incharge").val();
								var remarks = $("#remarks").val();

								var v_regn_no_1 = $("#v_regn_no_1").val();
								var v_regn_no_2 = $("#v_regn_no_2").val();
								var v_regn_no_3 = $("#v_regn_no_3").val();
								var v_regn_no_4 = $("#v_regn_no_4").val();
								var v_regn_no =
									v_regn_no_1 +
									"-" +
									v_regn_no_2 +
									"-" +
									v_regn_no_3 +
									"-" +
									v_regn_no_4;

								var check = 0;

								if (bussiness_type == "") {
									snackbar_show("Select Business Type");
									check = 1;
								} else if (classification == "") {
									snackbar_show("Select Classification type");
									check = 1;
								} else if (policy_class == "") {
									snackbar_show("Select Class");
									check = 1;
								} else if (policy_type == "") {
									snackbar_show("Select Policy Type");
									check = 1;
								} else if (lead_generated_date == "") {
									snackbar_show("Select Lead Generated Date");
									check = 1;
								} else if (agent_pos == "" || agent_pos == null) {
									snackbar_show("Select Agents And Pos");
									check = 1;
								} else if (assign_to_user == "" || assign_to_user == null) {
									snackbar_show("Select Assign To User");
									check = 1;
								} else if (area_incharge == "" || area_incharge == null) {
									snackbar_show("Select Area Incharge");
									check = 1;
								} else {
									$.ajax({
										url: "update_requirement_details",
										method: "POST",
										data: {
											lead_id: lead_id,
											bussiness_type: bussiness_type,
											policy_class: policy_class,
											policy_type: policy_type,
											lead_generated_date: lead_generated_date,
											due_date: due_date,
											broken_policy: broken_policy,
											location: location,
											classification: classification,
											source: source,
											agent_pos: agent_pos,
											assign_to_user: assign_to_user,
											area_incharge: area_incharge,
											remarks: remarks,
											v_regn_no: v_regn_no,
										},
										beforeSend: function () {
											$("#update_req_btn").attr("disabled", true);
										},
										success: function (response) {
											Swal.fire({
												position: "top-end",
												icon: "success",
												title: "Requirement Details updated Successfully",
												showConfirmButton: false,
												timer: 1500,
											});
											$("#update_req_btn").attr("disabled", false);
											window.location.href = "create_lead?id=" + lead_id;
											notification_log(lead_id);
										},
									});
								}
							});

							// Edit vechile Details //

							// update 16-05-2022

							$("#add_vechi_btn").click(function () {
								var lead_id = $("#last_inserted_id").val();
								$.ajax({
									url: "get_policy_type",
									method: "POST",
									data: { lead_id: lead_id },
									success: function (response) {
										var obj = jQuery.parseJSON(response);
										$("#vechile_type").val(obj.policy_type);

										// ✅ Reset Regn No fields for fresh input
										$("#regn_no_1, #regn_no_2, #regn_no_3, #regn_no_4").val("");
										$("#regn_no_span").html("");
										$("#add_vechile_btn").attr("disabled", false);

										// if(obj.vechi_register_no != null)
										// {
										//      var reg_num = obj.vechi_register_no.split("-");

										//      var j = 0;

										//      for(var i=0;i<reg_num.length;i++)
										//      {
										//          j++;
										//          $("#regn_no_"+j).val(reg_num[i]);
										//      }
										// }

										$("#add_vechile_model").modal("toggle");

										fetch_make(obj.policy_type);
										fetch_pcv_seating(obj.policy_type);
										// ✅ New: Fetch Seating Capacity automatically
										fetchSeatingCapacity(lead_id);
										fetchFuelType(obj.policy_type);
									},
								});
							});

							$("#add_sme_btn").click(function () {
								var lead_id = $("#last_inserted_id").val();
								$.ajax({
									url: "get_policy_type",
									method: "POST",
									data: { lead_id: lead_id },
									success: function (response) {
										var obj = jQuery.parseJSON(response);
										fetch_sme_policy(obj.policy_type);
										$("#sme_modal").modal("toggle");
									},
								});
							});

							$("#edit_vechicle_btn").click(function () {
								var lead_id = $("#last_inserted_id").val();

								$.ajax({
									url: "fetch_edit_vechicle_details",
									method: "POST",
									data: { lead_id: lead_id },
									success: function (response) {
										var obj = jQuery.parseJSON(response);
										$("#edit_vechicle_id").val(obj.id);
										$("#edit_vechile_type").val(obj.policy_type);

										$.ajax({
											url: "fetch_make",
											method: "POST",
											data: { vechile_type: obj.policy_type },
											success: function (response) {
												var object = jQuery.parseJSON(response);
												if (object.length > 0) {
													var str = "<option value=''>--Select--</option>";
													for (var j = 0; j < object.length; j++) {
														if (obj.vechi_make == object[j].id)
															str +=
																"<option value='" +
																object[j].id +
																"' selected>" +
																object[j].brand_name +
																"</option>";
														else
															str +=
																"<option value='" +
																object[j].id +
																"'>" +
																object[j].brand_name +
																"</option>";
													}
													$("#edit_vechi_make").html(str);
												}
											},
										});

										$.ajax({
											url: "fetch_model",
											method: "POST",
											data: {
												vechile_type: obj.policy_type,
												vechi_make: obj.vechi_make,
											},
											success: function (response) {
												var object = jQuery.parseJSON(response);
												if (object.length > 0) {
													var str = "<option value=''>--Select--</option>";
													for (var j = 0; j < object.length; j++) {
														if (obj.vechi_model == object[j].id)
															str +=
																"<option value='" +
																object[j].id +
																"' selected>" +
																object[j].model_name +
																"</option>";
														else
															str +=
																"<option value='" +
																object[j].id +
																"'>" +
																object[j].model_name +
																"</option>";
													}
													$("#edit_vechi_model").html(str);
												}
											},
										});

										$.ajax({
											url: "fetch_vechile_varient",
											method: "POST",
											data: {
												vechile_type: obj.policy_type,
												vechi_make: obj.vechi_make,
												vechi_model: obj.vechi_model,
											},
											success: function (response) {
												var object = jQuery.parseJSON(response);
												if (object.length > 0) {
													var str = "<option value=''>--Select--</option>";
													for (var j = 0; j < object.length; j++) {
														if (obj.vechi_varient == object[j].id)
															str +=
																"<option value='" +
																object[j].id +
																"' selected>" +
																object[j].varient_name +
																"</option>";
														else
															str +=
																"<option value='" +
																object[j].id +
																"'>" +
																object[j].varient_name +
																"</option>";
													}
													$("#edit_vechi_varient").html(str);
												}
											},
										});

										$.ajax({
											url: "fetch_edit_pcv_seating_capacity",
											method: "POST",
											data: { policy_type: obj.policy_type },
											success: function (response) {
												var object = jQuery.parseJSON(response);
												if (object.length > 0) {
													var str = "<option value=''>--Select--</option>";
													for (var j = 0; j < object.length; j++) {
														if (obj.passenger_carrying == object[j].id)
															str +=
																"<option value='" +
																object[j].id +
																"' selected>" +
																object[j].seating_capacity +
																"</option>";
														else
															str +=
																"<option value='" +
																object[j].id +
																"'>" +
																object[j].seating_capacity +
																"</option>";
													}
													$("#edit_passenger_carrying").html(str);
												}
											},
										});

										$("#edit_vechi_cc").val(obj.vechi_cc);
										$("#edit_vechi_manu_month").val(obj.vechi_manu_month);
										$("#edit_vechi_manu_year").val(obj.vechi_manu_year);
										$("#edit_vechi_manu_year").trigger("change");
										$("#edit_vechi_seating").val(obj.vechi_seating);
										$("#edit_vechi_classfication").val(obj.vechi_classfication);
										$("#edit_vechi_fuel_type").val(obj.vechi_fuel_type);
										$("#edit_vechi_gvw").val(obj.vechi_gvw);
										$("#edit_vechi_engine_num").val(obj.vechi_engine_num);
										$("#edit_vechi_chassis_num").val(obj.vechi_chassis_num);
										$("#edit_vechi_hypothecation").val(obj.vechi_hypothecation);
										$("#edit_vechi_remarks").val(obj.vechi_remarks);
										$("#edit_regn_date").val(obj.regn_date);

										var reg_num = obj.vechi_register_no.split("-");
										var j = 0;
										for (var i = 0; i < reg_num.length; i++) {
											j++;
											$("#edit_regn_no_" + j).val(reg_num[i]);
										}

										$("#edit_rto").val(obj.rto);
										$("#edit_zone").val(obj.zone);
										$("#edit_regn_address").val(obj.regn_address);
										$("#edit_state").val(obj.state || "");
										$("#edit_state").val(obj.state).trigger("change");
										$("#edit_city").val(obj.city);
										$("#edit_pincode").val(obj.pincode);
										$("#edit_vechi_user_name").val(obj.vechi_user_name);
										$("#edit_vechi_user_cont").val(obj.vechi_user_cont);

										// ✅ Populate additional fields dynamically
										$("#edit_additional_fields_container").html(""); // clear old fields
										if (obj.additional_fields && obj.additional_fields !== "") {
										try {
											let additionalFields = JSON.parse(obj.additional_fields);
											if (Array.isArray(additionalFields)) {
											additionalFields.forEach(function (field, index) {
												let fieldHtml = `
												<div class="row mb-2" id="edit_field_${index}" style="margin-top:10px;">
													<div class="col-md-5">
													<input type="text" class="form-control" name="edit_additional_label[]" value="${field.label}" placeholder="Enter Label">
													</div>
													<div class="col-md-5">
													<input type="text" class="form-control" name="edit_additional_value[]" value="${field.value}" placeholder="Enter Value">
													</div>
													<div class="col-md-2">
													<button type="button" class="btn btn-danger btn-sm remove_edit_field" data-id="${index}">
														<i class="fa fa-trash"></i>
													</button>
													</div>
												</div>`;
												$("#edit_additional_fields_container").append(fieldHtml);
											});
											}
										} catch (e) {
											console.log("Error parsing additional fields JSON:", e);
										}
										}

                                        // 🔹 Show current RC file (only text link)
                                        if (obj.regn_certificate && obj.regn_certificate !== "") {
                                            let fileUrl = "./datas/Registration_Certificate/" + obj.regn_certificate;

                                            $("#edit_rc_preview").html(`
                                                <a href="${fileUrl}" target="_blank" class="text-primary" style="text-decoration: none;">
                                                  <i class="fa fa-eye"></i>  <b>View RC</b>
                                                </a>
                                            `);
                                        } else {
                                            $("#edit_rc_preview").html("<small class='text-muted'>No RC uploaded yet</small>");
                                        }

										// 🔹 Show current Vehicle Video (if uploaded)
										if (obj.vehicle_video && obj.vehicle_video !== "") {
											let videoFile = obj.vehicle_video;
											let videoUrl = "./datas/Vehicle_Videos/" + videoFile;

											$("#existing_vehicle_video_preview").html(`
												<video width="100%" height="auto" controls style="border-radius: 6px; margin-bottom: 5px;">
													<source src="${videoUrl}" type="video/mp4">
													Your browser does not support the video tag.
												</video>
												<a href="${videoUrl}" target="_blank" class="text-primary">
													<i class="fa fa-external-link"></i> View Full Video
												</a>
											`);
										} else {
											$("#existing_vehicle_video_preview").html(`
												<small class="text-muted">No vehicle video uploaded yet</small>
											`);
										}


										$.ajax({
											url: "get_uploaded_vechicle_documents",
											method: "POST",
											data: { lead_id: lead_id },
											success: function (response) {
												$("#edit_table_view").html(response);
											},
										});

										// ✅ Populate existing photo previews inside static modal
										for (let i = 1; i <= 30; i++) {
											let file = obj["img_" + i];
											let previewContainer = $(`input[name='vehicle_photos_edit[img_${i}]']`).closest(".col-md-4");

											// Remove old preview (if re-editing)
											previewContainer.find(".existing-preview").remove();

											if (file && file !== "") {
												previewContainer.append(`
													<a href="datas/Vehicle_Photos/${file}" target="_blank"
													class="existing-preview text-primary d-block mt-1">
														<i class="fa fa-eye"></i> View
													</a>
												`);
											} else {
												previewContainer.append(`
													<small class="existing-preview text-muted d-block mt-1">
														No file uploaded
													</small>
												`);
											}
										}

										// ================== COPY CLIENT ADDRESS TO EDIT VEHICLE SECTION ==================
										$("#edit_copy_client_comm_address").off("change").on("change", function () {
										if ($(this).is(":checked")) {
											$("#edit_copy_client_perm_address").prop("checked", false); // uncheck the other

											// Get values from client form
											var commAddr = $("#communication_address").val() || "";
											var district = $("#district").val() || "";
											var clientState = $("input[name='state']").val() || $("#state").val() || "";
											var country = $("#country").val() || "India";
											var pin = $("#pin_code").val() || "";

											// Set to edit registration fields
											$("#edit_regn_address").val(commAddr);
											$("#edit_city").val(district);
											var clientStateId = $("#state").val(); // ID from main client form
											$("#edit_state").val(clientStateId).trigger("change");
											$("#edit_country").val(country);
											$("#edit_pincode").val(pin);

											Swal.fire({
											icon: "info",
											title: "Address Copied",
											text: "Client Communication Address copied to Vehicle Registration.",
											timer: 1500,
											showConfirmButton: false,
											});
										} else {
											$("#edit_regn_address, #edit_city, #edit_state, #edit_country, #edit_pincode").val("");
										}
										});

										$("#edit_copy_client_perm_address").off("change").on("change", function () {
										if ($(this).is(":checked")) {
											$("#edit_copy_client_comm_address").prop("checked", false); // uncheck the other

											var permAddr = $("#permanent_address").val() || "";
											var district = $("#district").val() || "";
											var clientState = $("input[name='state']").val() || $("#state").val() || "";
											var country = $("#country").val() || "India";
											var pin = $("#pin_code").val() || "";

											$("#edit_regn_address").val(permAddr);
											$("#edit_city").val(district);
											$("#edit_state").val(clientState).trigger("change");
											$("#edit_country").val(country);
											$("#edit_pincode").val(pin);

											Swal.fire({
											icon: "info",
											title: "Address Copied",
											text: "Client Permanent Address copied to Vehicle Registration.",
											timer: 1500,
											showConfirmButton: false,
											});
										} else {
											$("#edit_regn_address, #edit_city, #edit_state, #edit_country, #edit_pincode").val("");
										}
										});


										// ✅ show the modal now
										$("#edit_vechile_model").modal("show");
									},
								});
							});

							// ================== Edit Vehicle Photos Modal Highlight ==================
							$("#editVehiclePhotosModal").on("change", "input[type='file']", function () {
								if (this.files && this.files.length > 0) {
									$(this).addClass("uploaded");
								} else {
									$(this).removeClass("uploaded");
								}
							});

							// Reset highlight on close
							$("#editVehiclePhotosModal").on("hidden.bs.modal", function () {
								$("#editVehiclePhotosModal input[type='file']").removeClass("uploaded");
							});

							$("#edit_doc_btn").click(function () {
								var id = $("#edit_doc_id").val();
								var document_type = $("#edit_document_type").val();
								var files = $("#edit_vechi_doc").prop("files")[0];

								var check = 0;

								if (document_type === "") {
									check = 1;
									Swal.fire(
										"Select Document Type ?",
										"That thing is still around?",
										"question"
									);
								} else if (check != 1) {
									var formdata = new FormData();
									formdata.append("id", id);
									formdata.append("document_type", document_type);
									formdata.append("file", files);

									$.ajax({
										url: "edit_vehicle_documents",
										method: "POST",
										data: formdata,
										processData: false,
										contentType: false,
										cache: false,
										dataType: "text",
										beforeSend: function () {
											$("#edit_doc_btn").attr("disabled", true);
										},
										success: function (response) {
											$("#edit_doc_mod").modal("hide");
											$("#edit_document_type").val("");
											$("#edit_vechi_doc").val("");
											$("#edit_table_view").html(response);
										},
									});
								}
							});

							$("#update_vechile_btn").click(function () {
								var lead_id = $("#last_inserted_id").val();
								var id = $("#edit_vechicle_id").val();
								var vechile_type = $("#edit_vechile_type").val();
								var vechi_make = $("#edit_vechi_make").val();
								var vechi_model = $("#edit_vechi_model").val();
								var vechi_varient = $("#edit_vechi_varient").val();
								var vechi_cc = $("#edit_vechi_cc").val();
								var vechi_manu_month = $("#edit_vechi_manu_month").val();
								var vechi_manu_year = $("#edit_vechi_manu_year").val();
								var vechi_seating = $("#edit_vechi_seating").val();
								var vechi_classfication = $("#edit_vechi_classfication").val();
								var vechi_fuel_type = $("#edit_vechi_fuel_type").val();
								var vechi_gvw = $("#edit_vechi_gvw").val();
								var passenger_carrying = $("#edit_passenger_carrying").val();
								var vechi_engine_num = $("#edit_vechi_engine_num").val();
								var vechi_chassis_num = $("#edit_vechi_chassis_num").val();
								var vechi_hypothecation = $("#edit_vechi_hypothecation").val();
								var created_user = $("#edit_created_user").val();
								var vechi_remarks = $("#edit_vechi_remarks").val();
								var regn_no_1 = $("#edit_regn_no_1").val();
								var regn_no_2 = $("#edit_regn_no_2").val();
								var regn_no_3 = $("#edit_regn_no_3").val();
								var regn_no_4 = $("#edit_regn_no_4").val();
								var regn_date = $("#edit_regn_date").val();
								var register_no =
									regn_no_1 +
									"-" +
									regn_no_2 +
									"-" +
									regn_no_3 +
									"-" +
									regn_no_4;
								var rto = $("#edit_rto").val();
								var zone = $("#edit_zone").val();
								var regn_address = $("#edit_regn_address").val();
								var stateId = $("#edit_state").val() || $("#state").val(); 
								var city = $("#edit_city").val();
								var country = $("#edit_country").val() || "India";
								var pincode = $("#edit_pincode").val();
								var vechi_user_name = ""; //$("#edit_vechi_user_name").val();
								var vechi_user_cont = ""; //$("#edit_vechi_user_cont").val();

								var business_type = $("#bussiness_type").val();

								var check = 0;

								if (vechile_type == "") {
									check = 1;
									Swal.fire("Select Vechicle Type?", "", "question");
								} else if (vechi_make == "") {
									check = 1;
									Swal.fire("Select Vechicle Make ?", "", "question");
								} else if (vechi_model == "") {
									check = 1;
									Swal.fire("Select Vechicle Model ?", "", "question");
								} else if (vechi_chassis_num == "") {
									check = 1;
									Swal.fire("Enter Chassis Number ?", "", "question");
								} else if (
									(vechile_type == "1" ||
										vechile_type == "2" ||
										vechile_type == "3" ||
										vechile_type == "4") &&
									vechi_varient == ""
								) {
									check = 1;
									Swal.fire("Select Vehicle Varient ?", "", "question");
								} else if (
									(vechile_type == "1" ||
										vechile_type == "2" ||
										vechile_type == "3") &&
									vechi_cc == ""
								) {
									check = 1;
									Swal.fire("Enter CC ?", "", "question");
								} else if (vechi_manu_month == "") {
									check = 1;
									Swal.fire("Select manufacure month ?", "", "question");
								} else if (vechi_manu_year == "") {
									check = 1;
									Swal.fire("Select manufacure Year ?", "", "question");
								} else if (
									(vechile_type == "7" ||
										vechile_type == "12" ||
										vechile_type == "13" ||
										vechile_type == "14" ||
										vechile_type == "59" ||
										vechile_type == "60") &&
									passenger_carrying == ""
								) {
									check = 1;
									Swal.fire("Enter passenger carrying ?", "", "question");
								} else if (
									(vechile_type == "8" ||
										vechile_type == "9" ||
										vechile_type == "10" ||
										vechile_type == "11" ||
										vechile_type == "15" ||
										vechile_type == "16" ||
										vechile_type == "17" ||
										vechile_type == "61") &&
									vechi_gvw == ""
								) {
									check = 1;
									Swal.fire("Enter GVW ?", "", "question");
								} else if (
									business_type != "3" &&
									(regn_no_1 == "" ||
										regn_no_2 == "" ||
										regn_no_3 == "" ||
										regn_no_4 == "")
								) {
									check = 1;
									Swal.fire("Enter Vechicle Register No ?", "", "question");
								} else if (rto == "") {
									check = 1;
									Swal.fire("Select Rto ?", "", "question");
								} else if (state == "") {
									check = 1;
									Swal.fire("Select State ?", "", "question");
								} else if (pincode != "" && pincode.length != 6) {
									check = 1;
									Swal.fire("Enter a valid Pincode ?", "", "question");
								} else if (check != 1) {
									var formdata = new FormData();

                                    // ✅ Append RC file (if selected)
                                    var rc_file = $("#edit_regn_certificate")[0].files[0];
                                    if (rc_file) {
                                        formdata.append("regn_certificate", rc_file);
                                    }

									// ✅ Collect all 30 vehicle photos (if user replaced any)
									$(".vehicle-photo-edit").each(function () {
										if (this.files.length > 0) {
											let fieldKey = $(this).attr("name").match(/\[(.*?)\]/)[1]; // extract img_#
											formdata.append(fieldKey, this.files[0]);
										}
									});

									// ✅ Handle vehicle video upload (single file)
									var editVehicleVideo = $("#edit_vehicle_video")[0].files[0];
									if (editVehicleVideo) {
										formdata.append("edit_vehicle_video", editVehicleVideo);
									}

									formdata.append("id", id);
									formdata.append("vechile_type", vechile_type);
									formdata.append("vechi_make", vechi_make);
									formdata.append("vechi_model", vechi_model);
									formdata.append("vechi_varient", vechi_varient);
									formdata.append("vechi_cc", vechi_cc);
									formdata.append("vechi_manu_month", vechi_manu_month);
									formdata.append("vechi_manu_year", vechi_manu_year);
									formdata.append("vechi_seating", vechi_seating);
									formdata.append("vechi_classfication", vechi_classfication);
									formdata.append("vechi_fuel_type", vechi_fuel_type);
									formdata.append("vechi_gvw", vechi_gvw);
									formdata.append("vechi_engine_num", vechi_engine_num);
									formdata.append("passenger_carrying", passenger_carrying);
									formdata.append("vechi_chassis_num", vechi_chassis_num);
									formdata.append("vechi_hypothecation", vechi_hypothecation);
									formdata.append("created_user", created_user);
									formdata.append("vechi_remarks", vechi_remarks);
									formdata.append("register_no", register_no);
									formdata.append("regn_date", regn_date);
									formdata.append("rto", rto);
									formdata.append("zone", zone);
									formdata.append("regn_address", regn_address);
									formdata.append("state", stateId);
									formdata.append("city", city);
									formdata.append("country", country);
									formdata.append("pincode", pincode);
									formdata.append("vechi_user_name", vechi_user_name);
									formdata.append("vechi_user_cont", vechi_user_cont);

									// ✅ Collect Additional Fields dynamically (Edit Mode)
									var additionalLabels = [];
									var additionalValues = [];

									$("input[name='edit_additional_label[]']").each(function () {
									additionalLabels.push($(this).val());
									});
									$("input[name='edit_additional_value[]']").each(function () {
									additionalValues.push($(this).val());
									});

									if (additionalLabels.length > 0) {
									var additionalFields = [];
									for (let i = 0; i < additionalLabels.length; i++) {
										if (additionalLabels[i] !== "") {
										additionalFields.push({
											label: additionalLabels[i],
											value: additionalValues[i] || "",
										});
										}
									}
									formdata.append("additional_fields", JSON.stringify(additionalFields));
									}

									$.ajax({
										url: "update_vechicle_details",
										method: "POST",
										data: formdata,
										processData: false,
										contentType: false,
										cache: false,
										dataType: "text",
										beforeSend: function (response) {
											$("#update_vechile_btn").attr("disabled", true);
										},
										success: function (response) {
											if (response == "Exits") {
												snackbar_show("Vechicle Regn no Already Exits");
												$("#update_vechile_btn").attr("disabled", false);
											} else {
												$("#update_vechile_btn").attr("disabled", false);
												Swal.fire({
													position: "top-end",
													icon: "success",
													title:
														"Vechile Details Has Been Updated Successfully",
													showConfirmButton: false,
													timer: 1500,
												});
												$(".form-control").val();

												var id = $("#last_inserted_id").val();

												$.ajax({
													url: "get_vechile_details",
													method: "POST",
													data: { id: id },
													success: function (response) {
														var obj = jQuery.parseJSON(response);
														if (obj != null && obj != "") {
															$("#view_make_model").val(
																obj.brand_name +
																	" " +
																	obj.model_name +
																	" " +
																	obj.varient_name
															);
															$("#view_engine_no").val(obj.vechi_engine_num);
															$("#view_regn_no").val(obj.vechi_register_no);
															$("#view_chassis").val(obj.vechi_chassis_num);
														}
														notification_log(lead_id);
													},
												});
												$("#edit_vechile_model").modal("toggle");
											}
										},
									});
								}
							});


							$(".inputs").keyup(function () {
								$(this).val($(this).val().toUpperCase());
								if (this.value.length == this.maxLength) {
									$(this).next(".inputs").focus();
								}
								check_vehi_regn_no();
							});

							$("#edit_vechile_type").change(function () {
								var vechile_type = $("#edit_vechile_type").val();
								$.ajax({
									url: "fetch_make",
									method: "POST",
									data: { vechile_type: vechile_type },
									beforeSend: function () {
										$("#edit_vechi_make").prop("disabled", true);
									},
									success: function (response) {
										var obj = jQuery.parseJSON(response);

										var str = "<option value=''>--Select--</option>";
										for (var j = 0; j < obj.length; j++) {
											str +=
												"<option value='" +
												obj[j].id +
												"'>" +
												obj[j].brand_name +
												"</option>";
										}
										$("#edit_vechi_make").html(str);
										$("#edit_vechi_make").prop("disabled", false);
									},
								});
							});

							$("#edit_vechi_make").change(function () {
								var vechile_type = $("#edit_vechile_type").val();
								var vechi_make = $("#edit_vechi_make").val();

								$.ajax({
									url: "fetch_model",
									method: "POST",
									data: { vechile_type: vechile_type, vechi_make: vechi_make },
									beforeSend: function () {
										$("#edit_vechi_model").prop("disabled", true);
									},
									success: function (response) {
										var obj = jQuery.parseJSON(response);

										var str = "<option value=''>--Select--</option>";
										for (var j = 0; j < obj.length; j++) {
											str +=
												"<option value='" +
												obj[j].id +
												"'>" +
												obj[j].model_name +
												"</option>";
										}
										$("#edit_vechi_model").html(str);
										$("#edit_vechi_model").prop("disabled", false);
									},
								});
							});

							$("#edit_vechi_model").change(function () {
								var vechile_type = $("#edit_vechile_type").val();
								var vechi_make = $("#edit_vechi_make").val();
								var vechi_model = $("#edit_vechi_model").val();

								$.ajax({
									url: "fetch_vechile_varient",
									method: "POST",
									data: {
										vechile_type: vechile_type,
										vechi_make: vechi_make,
										vechi_model: vechi_model,
									},
									beforeSend: function () {
										$("#edit_vechi_varient").prop("disabled", true);
									},
									success: function (response) {
										var obj = jQuery.parseJSON(response);

										var str = "<option value=''>--Select--</option>";
										for (var j = 0; j < obj.length; j++) {
											str +=
												"<option value='" +
												obj[j].id +
												"'>" +
												obj[j].varient_name +
												"</option>";
										}
										$("#edit_vechi_varient").html(str);
										$("#edit_vechi_varient").prop("disabled", false);
									},
								});
							});

							// add quotation

							$("#add_quote_btn").click(function () {
								var lead_id = $("#last_inserted_id").val();

								$.ajax({
									url: "get_basic_informations",
									method: "POST",
									data: { lead_id: lead_id },
									success: function (response) {
										var obj = jQuery.parseJSON(response);
										$("#q_class").val(obj["basic_details"].class_name);
										$("#q_policy_type").val(
											obj["basic_details"].policy_type_name
										);
										$("#q_client_name").val(obj["basic_details"].client_name);
										$("#q_make_model").val(
											obj["vechi_details"].brand_name +
												" / " +
												obj["vechi_details"].model_name +
												" / " +
												obj["vechi_details"].varient_name
										);

										$("#q_rto_code").val(obj["vechi_details"].rto);
										$("#q_zone").val(obj["vechi_details"].zone);
										$("#q_vechi_classification").val(
											obj["vechi_details"].vechi_classfication
										);

										var manu_month = obj["vechi_details"].vechi_manu_month;
										var manu_year = obj["vechi_details"].vechi_manu_year;

										if (manu_month != "" && manu_year != "") {
											var vechi_age = manu_year + "-" + manu_month + "-" + "01";
											vechi_age = new Date(vechi_age);
											var today = new Date();
											var vechi_age = Math.floor(
												(today - vechi_age) / (365.25 * 24 * 60 * 60 * 1000)
											);
											$("#q_vechi_age").val(vechi_age);
										}

										$("#add_quotation_model").modal("toggle");
									},
								});
							});

							$("#q_idv").change(function () {
								var IDV = $("#q_idv").val();
								$("#q_sum_insured").val(IDV);
							});

							$("#add_quotation").click(function () {
								var lead_id = $("#last_inserted_id").val();
								var policy_co_cover_type = $("#policy_co_cover_type").val();
								var q_policy_term = $("#q_policy_term").val();
								var q_policy_s_date = $("#q_policy_s_date").val();
								var q_policy_ex_date = $("#q_policy_ex_date").val();
								var q_insurer = $("#q_insurer").val();
								var q_insurer_branch = $("#q_insurer_branch").val();
								var q_idv = $("#q_idv").val();
								var q_elec_access_value = $("#q_elec_access_value").val();
								var q_non_elec_access_value = $(
									"#q_non_elec_access_value"
								).val();
								var q_lpg_cng = $("#q_lpg_cng").val();
								var q_sum_insured = $("#q_sum_insured").val();
								var q_make_model = $("#q_make_model").val();
								var q_vechi_age = $("#q_vechi_age").val();
								var q_rto_code = $("#q_rto_code").val();
								var q_zone = $("#q_zone").val();
								var q_cubic_capactiy = $("#q_cubic_capactiy").val();
								var q_vechi_classification = $("#q_vechi_classification").val();
								var q_basic_od_percentage = $("#q_basic_od_percentage").val();
								var q_basic_od_amount = $("#q_basic_od_amount").val();
								var q_spl_dis_per = $("#q_spl_dis_per").val();
								var q_spl_dis_amount = $("#q_spl_dis_amount").val();
								var q_spl_loading_per = $("#q_spl_loading_per").val();
								var q_spl_loading_amount = $("#q_spl_loading_amount").val();
								var q_non_basic_od = $("#q_non_basic_od").val();
								var q_non_elec_acc_amount = $("#q_non_elec_acc_amount").val();

								var q_bi_fuel_kit = $("#q_bi_fuel_kit").val();
								var q_basic_od1 = $("#q_basic_od1").val();
								var q_geographical_area = $("#q_geographical_area").val();
								var q_geographical_amount = $("#q_geographical_amount").val();
								var q_emp_loading = $("#q_emp_loading").val();
								var q_emp_loading_amount = $("#q_emp_loading_amount").val();
								var q_fiber_class_tank = $("#q_fiber_class_tank").val();
								var q_fiber_class_tank_amount = $(
									"#q_fiber_class_tank_amount"
								).val();
								var q_driving_tuitions = $("#q_driving_tuitions").val();
								var q_basic_od2 = $("#q_basic_od2").val();
								var q_basic_od2_amount = $("#q_basic_od2_amount").val();

								var q_anti_theft = $("#q_anti_theft").val();
								var q_anti_theft_amount = $("#q_anti_theft_amount").val();
								var q_anti_handicap = $("#q_anti_handicap").val();
								var q_anti_handicap_amount = $("#q_anti_handicap_amount").val();
								var q_aai = $("#q_aai").val();
								var q_aai_amount = $("#q_aai_amount").val();
								var q_voluntary_deductable = $("#q_voluntary_deductable").val();
								var q_voluntary_deductable_amount = $(
									"#q_voluntary_deductable_amount"
								).val();
								var q_basic_od_3 = $("#q_basic_od_3").val();
								var q_ncb_percentage = $("#q_ncb_percentage").val();
								var q_ncb_percentage_amount = $(
									"#q_ncb_percentage_amount"
								).val();

								var q_basic_tp = $("#q_basic_tp").val();
								var q_fuel_kit_amt = $("#q_fuel_kit_amt").val();
								var q_basic_tp1 = $("#q_basic_tp1").val();
								var q_geograpical_amt = $("#q_geograpical_amt").val();
								var q_owner_diver_amt = $("#q_owner_diver_amt").val();
								var q_no_of_year_own_drv = $("#q_no_of_year_own_drv").val();
								var q_un_named_passenger_pa = $(
									"#q_un_named_passenger_pa"
								).val();
								var q_un_named_passenger_amt = $(
									"#q_un_named_passenger_amt"
								).val();
								var q_no_seats_per_person = $("#q_no_seats_per_person").val();
								var q_no_seats_per_person_amt = $(
									"#q_no_seats_per_person_amt"
								).val();

								var q_tot_od_premium = $("#q_tot_od_premium").val();

								var q_llp = $("#q_llp").val();
								var q_llp_amt = $("#q_llp_amt").val();
								var q_no_drv_emp = $("#q_no_drv_emp").val();
								var q_pa_paid_drv = $("#q_pa_paid_drv").val();
								var q_pa_paid_drv_amt = $("#q_pa_paid_drv_amt").val();
								var q_no_seats_per_person1 = $("#q_no_seats_per_person1").val();
								var q_no_seats_per_person_amt1 = $(
									"#q_no_seats_per_person_amt1"
								).val();
								var q_tot_tp_premium = $("#q_tot_tp_premium").val();

								var q_add_on_combo_premium = $("#q_add_on_combo_premium").val();
								var q_add_on_plan_premium_percentage = $(
									"#q_add_on_plan_premium_percentage"
								).val();
								var q_add_on_plan_premium_amt = $(
									"#q_add_on_plan_premium"
								).val();

								if ($("#q_zero_depreciation_check").is(":checked")) {
									var q_zero_depreciation_check = "Yes";
								} else {
									var q_zero_depreciation_check = "No";
								}

								var q_zero_depreciation_percentage = $(
									"#q_zero_depreciation_percentage"
								).val();
								var q_zero_depreciation_amt = $(
									"#q_zero_depreciation_amt"
								).val();

								if ($("#q_addtional_addons_check").is(":checked")) {
									var q_addtional_addons_check = "Yes";
								} else {
									var q_addtional_addons_check = "No";
								}
								var q_addtional_addons_amt = $("#q_addtional_addons_amt").val();

								if ($("#q_consumbles_check").is(":checked")) {
									var q_consumbles_check = "Yes";
								} else {
									var q_consumbles_check = "No";
								}

								var q_consumbles_percentage = $(
									"#q_consumbles_percentage"
								).val();
								var q_consumbles_amt = $("#q_consumbles_amt").val();
								if ($("#q_tyre_cover").is(":checked")) {
									var q_tyre_cover = "Yes";
								} else {
									var q_tyre_cover = "No";
								}
								var q_tyre_cover_percentage = $(
									"#q_tyre_cover_percentage"
								).val();
								var q_tyre_cover_amt = $("#q_tyre_cover_amt").val();

								if ($("#q_ncb_protection_check").is(":checked")) {
									var q_ncb_protection_check = "Yes";
								} else {
									var q_ncb_protection_check = "No";
								}

								var q_ncb_protection_amt = $("#q_ncb_protection_amt").val();

								if ($("#q_engine_protector_check").is(":checked")) {
									var q_engine_protector_check = "Yes";
								} else {
									var q_engine_protector_check = "No";
								}
								var q_engine_protector_percentage = $(
									"#q_engine_protector_percentage"
								).val();
								var q_engine_protector_amt = $("#q_engine_protector_amt").val();

								if ($("#q_return_to_invoice_check").is(":checked")) {
									var q_return_to_invoice_check = "Yes";
								} else {
									var q_return_to_invoice_check = "No";
								}

								var q_return_to_invoice_percentage = $(
									"#q_return_to_invoice_percentage"
								).val();
								var q_return_to_invoice_amt = $(
									"#q_return_to_invoice_amt"
								).val();

								//

								if ($("#q_key_replacement_check").is(":checked")) {
									var q_key_replacement_check = "Yes";
								} else {
									var q_key_replacement_check = "No";
								}

								var q_key_replacement_percentage = $(
									"#q_key_replacement_percentage"
								).val();
								var q_key_replacement_amt = $("#q_key_replacement_amt").val();

								if ($("#q_daily_allow_check").is(":checked")) {
									var q_daily_allow_check = "Yes";
								} else {
									var q_daily_allow_check = "No";
								}
								var q_daily_allow_percentage = $(
									"#q_daily_allow_percentage"
								).val();
								var q_daily_allow_amt = $("#q_daily_allow_amt").val();

								if ($("#q_loss_of_belong_check").is(":checked")) {
									var q_loss_of_belong_check = "Yes";
								} else {
									var q_loss_of_belong_check = "No";
								}

								var q_loss_of_belong_percentage = $(
									"#q_loss_of_belong_percentage"
								).val();
								var q_loss_of_belong_amt = $("#q_loss_of_belong_amt").val();

								if ($("#q_hotel_trvl_check").is(":checked")) {
									var q_hotel_trvl_check = "Yes";
								} else {
									var q_hotel_trvl_check = "No";
								}

								var q_hotel_trvl_percentage = $(
									"#q_hotel_trvl_percentage"
								).val();
								var q_hotel_trvl_amt = $("#q_hotel_trvl_amt").val();

								if ($("#q_wind_shield_check").is(":checked")) {
									var q_wind_shield_check = "Yes";
								} else {
									var q_wind_shield_check = "No";
								}

								var q_wind_shield_percentage = $(
									"#q_wind_shield_percentage"
								).val();
								var q_wind_shield_amt = $("#q_wind_shield_amt").val();

								if ($("#q_baggage_ins_check").is(":checked")) {
									var q_baggage_ins_check = "Yes";
								} else {
									var q_baggage_ins_check = "No";
								}

								var q_baggage_ins_percentage = $(
									"#q_baggage_ins_percentage"
								).val();
								var q_baggage_ins_amt = $("#q_baggage_ins_amt").val();

								var q_other_add_on_coverag_per = $(
									"#q_other_add_on_coverag_per"
								).val();
								var q_other_add_on_coverage_amt = $(
									"#q_other_add_on_coverage_amt"
								).val();

								var q_value_added_services = $("#q_value_added_services").val();
								var q_net_addon_cover_premium = $(
									"#q_net_addon_cover_premium"
								).val();
								var q_add_on_discount_percentage = $(
									"#q_add_on_discount_percentage"
								).val();
								var q_add_on_discount_amt = $("#q_add_on_discount_amt").val();
								var q_tot_add_on_cover_premium = $(
									"#q_tot_add_on_cover_premium"
								).val();

								var q_total_premium = $("#q_total_premium").val();
								var q_gst = $("#q_gst").val();
								var q_total_payable = $("#q_total_payable").val();
								var q_commission_base_premium = $(
									"#q_commission_base_premium"
								).val();

								var formdata = new FormData();
								formdata.append("lead_id", lead_id);
								formdata.append("policy_co_cover_type", policy_co_cover_type);
								formdata.append("q_policy_term", q_policy_term);
								formdata.append("q_policy_s_date", q_policy_s_date);
								formdata.append("q_policy_ex_date", q_policy_ex_date);
								formdata.append("q_insurer", q_insurer);
								formdata.append("q_insurer_branch", q_insurer_branch);
								formdata.append("q_idv", q_idv);
								formdata.append("q_elec_access_value", q_elec_access_value);
								formdata.append(
									"q_non_elec_access_value",
									q_non_elec_access_value
								);
								formdata.append("q_lpg_cng", q_lpg_cng);
								formdata.append("q_sum_insured", q_sum_insured);
								formdata.append("q_make_model", q_make_model);
								formdata.append("q_vechi_age", q_vechi_age);
								formdata.append("q_rto_code", q_rto_code);
								formdata.append("q_zone", q_zone);
								formdata.append("q_cubic_capactiy", q_cubic_capactiy);
								formdata.append(
									"q_vechi_classification ",
									q_vechi_classification
								);
								formdata.append("q_basic_od_percentage", q_basic_od_percentage);
								formdata.append("q_basic_od_amount", q_basic_od_amount);
								formdata.append("q_spl_dis_per", q_spl_dis_per);
								formdata.append("q_spl_dis_amount", q_spl_dis_amount);
								formdata.append("q_spl_loading_per", q_spl_loading_per);
								formdata.append("q_spl_loading_amount", q_spl_loading_amount);
								formdata.append("q_non_basic_od", q_non_basic_od);
								formdata.append("q_non_elec_acc_amount", q_non_elec_acc_amount);
								formdata.append("q_bi_fuel_kit", q_bi_fuel_kit);
								formdata.append("q_basic_od1", q_basic_od1);
								formdata.append("q_geographical_area", q_geographical_area);
								formdata.append("q_geographical_amount", q_geographical_amount);
								formdata.append("q_emp_loading", q_emp_loading);
								formdata.append("q_emp_loading_amount", q_emp_loading_amount);
								formdata.append("q_fiber_class_tank", q_fiber_class_tank);
								formdata.append(
									"q_fiber_class_tank_amount",
									q_fiber_class_tank_amount
								);
								formdata.append("q_driving_tuitions", q_driving_tuitions);
								formdata.append(
									"q_driving_tuitions_amount",
									q_driving_tuitions_amount
								);
								formdata.append("q_basic_od2", q_basic_od2);
								formdata.append("q_basic_od2_amount", q_basic_od2_amount);
								formdata.append("q_anti_theft", q_anti_theft);
								formdata.append("q_anti_theft_amount", q_anti_theft_amount);
								formdata.append("q_anti_handicap", q_anti_handicap);
								formdata.append(
									"q_anti_handicap_amount",
									q_anti_handicap_amount
								);
								formdata.append("q_aai", q_aai);
								formdata.append("q_aai_amount", q_aai_amount);
								formdata.append(
									"q_voluntary_deductable",
									q_voluntary_deductable
								);
								formdata.append(
									"q_voluntary_deductable_amount",
									q_voluntary_deductable_amount
								);
								formdata.append("q_basic_od_3", q_basic_od_3);
								formdata.append("q_ncb_percentage", q_ncb_percentage);
								formdata.append(
									"q_ncb_percentage_amount",
									q_ncb_percentage_amount
								);
								formdata.append("q_basic_tp", q_basic_tp);
								formdata.append("q_fuel_kit_amt", q_fuel_kit_amt);
								formdata.append("q_basic_tp1", q_basic_tp1);
								formdata.append("q_geograpical_amt", q_geograpical_amt);
								formdata.append("q_owner_diver_amt", q_owner_diver_amt);
								formdata.append("q_no_of_year_own_drv", q_no_of_year_own_drv);
								formdata.append(
									"q_un_named_passenger_pa",
									q_un_named_passenger_pa
								);
								formdata.append(
									"q_un_named_passenger_amt",
									q_un_named_passenger_amt
								);
								formdata.append("q_no_seats_per_person", q_no_seats_per_person);
								formdata.append(
									"q_no_seats_per_person_amt",
									q_no_seats_per_person_amt
								);
								formdata.append("q_tot_od_premium", q_tot_od_premium);
								formdata.append("q_llp", q_llp);
								formdata.append("q_llp_amt", q_llp_amt);
								formdata.append("q_no_drv_emp", q_no_drv_emp);
								formdata.append("q_pa_paid_drv", q_pa_paid_drv);
								formdata.append("q_pa_paid_drv_amt", q_pa_paid_drv_amt);
								formdata.append(
									"q_no_seats_per_person1",
									q_no_seats_per_person1
								);
								formdata.append(
									"q_no_seats_per_person_amt1",
									q_no_seats_per_person_amt1
								);
								formdata.append("q_tot_tp_premium", q_tot_tp_premium);
								formdata.append(
									"q_add_on_combo_premium",
									q_add_on_combo_premium
								);
								formdata.append(
									"q_add_on_plan_premium_percentage",
									q_add_on_plan_premium_percentage
								);
								formdata.append(
									"q_add_on_plan_premium_amt",
									q_add_on_plan_premium_amt
								);
								formdata.append(
									"q_zero_depreciation_check",
									q_zero_depreciation_check
								);
								formdata.append(
									"q_zero_depreciation_percentage",
									q_zero_depreciation_percentage
								);
								formdata.append(
									"q_zero_depreciation_amt",
									q_zero_depreciation_amt
								);
								formdata.append(
									"q_addtional_addons_check",
									q_addtional_addons_check
								);
								formdata.append(
									"q_addtional_addons_amt",
									q_addtional_addons_amt
								);
								formdata.append("q_consumbles_check", q_consumbles_check);
								formdata.append(
									"q_consumbles_percentage",
									q_consumbles_percentage
								);
								formdata.append("q_consumbles_amt", q_consumbles_amt);
								formdata.append("q_tyre_cover", q_tyre_cover);
								formdata.append(
									"q_tyre_cover_percentage",
									q_tyre_cover_percentage
								);
								formdata.append("q_tyre_cover_amt", q_tyre_cover_amt);
								formdata.append(
									"q_ncb_protection_check",
									q_ncb_protection_check
								);
								formdata.append("q_ncb_protection_amt", q_ncb_protection_amt);
								formdata.append(
									"q_engine_protector_check",
									q_engine_protector_check
								);
								formdata.append(
									"q_engine_protector_percentage",
									q_engine_protector_percentage
								);
								formdata.append(
									"q_engine_protector_amt",
									q_engine_protector_amt
								);
								formdata.append(
									"q_return_to_invoice_check",
									q_return_to_invoice_check
								);
								formdata.append(
									"q_return_to_invoice_percentage",
									q_return_to_invoice_percentage
								);
								formdata.append(
									"q_return_to_invoice_amt",
									q_return_to_invoice_amt
								);

								formdata.append(
									"q_key_replacement_check",
									q_key_replacement_check
								);
								formdata.append(
									"q_key_replacement_percentage",
									q_key_replacement_percentage
								);
								formdata.append("q_key_replacement_amt", q_key_replacement_amt);
								formdata.append("q_daily_allow_check", q_daily_allow_check);
								formdata.append(
									"q_daily_allow_percentage",
									q_daily_allow_percentage
								);
								formdata.append("q_daily_allow_amt", q_daily_allow_amt);
								formdata.append(
									"q_loss_of_belong_check",
									q_loss_of_belong_check
								);
								formdata.append(
									"q_loss_of_belong_percentage",
									q_loss_of_belong_percentage
								);
								formdata.append("q_loss_of_belong_amt", q_loss_of_belong_amt);
								formdata.append("q_hotel_trvl_check", q_hotel_trvl_check);
								formdata.append(
									"q_hotel_trvl_percentage",
									q_hotel_trvl_percentage
								);
								formdata.append("q_hotel_trvl_amt", q_hotel_trvl_amt);
								formdata.append("q_wind_shield_check", q_wind_shield_check);
								formdata.append(
									"q_wind_shield_percentage",
									q_wind_shield_percentage
								);
								formdata.append("q_wind_shield_amt", q_wind_shield_amt);
								formdata.append("q_baggage_ins_check", q_baggage_ins_check);
								formdata.append(
									"q_baggage_ins_percentage",
									q_baggage_ins_percentage
								);
								formdata.append("q_baggage_ins_amt", q_baggage_ins_amt);
								formdata.append(
									"q_other_add_on_coverag_per",
									q_other_add_on_coverag_per
								);
								formdata.append(
									"q_other_add_on_coverage_amt",
									q_other_add_on_coverage_amt
								);
								formdata.append(
									"q_value_added_services",
									q_value_added_services
								);
								formdata.append(
									"q_net_addon_cover_premium",
									q_net_addon_cover_premium
								);
								formdata.append(
									"q_add_on_discount_percentage",
									q_add_on_discount_percentage
								);
								formdata.append("q_add_on_discount_amt", q_add_on_discount_amt);
								formdata.append(
									"q_tot_add_on_cover_premium",
									q_tot_add_on_cover_premium
								);
								formdata.append("q_total_premium", q_total_premium);
								formdata.append("q_gst", q_gst);
								formdata.append("q_total_payable", q_total_payable);
								formdata.append(
									"q_commission_base_premium",
									q_commission_base_premium
								);

								$.ajax({
									url: "add_quotations",
									method: "POST",
									data: formdata,
									processData: false,
									contentType: false,
									cache: false,
									dataType: "text",
									beforeSend: function () {
										$("#add_quotation").attr("disabled", true);
									},
									success: function (response) {
										Swal.fire({
											position: "top-end",
											icon: "success",
											title: "Your Quotation Saved Successfully",
											showConfirmButton: false,
											timer: 1500,
										});
										$("#add_quotation").attr("disabled", false);
										$(".form-control").val("");
										$("#add_quotation_model").modal("toggle");
										get_all_quotes(last_inserted_id);
									},
								});
							});

							$("#pet_male_btn").click(function () {
								pet_female_to_male();
							});

							$("#pet_female_btn").click(function () {
								pet_male_to_female();
							});

							$("#pet_submit").click(function () {
								var lead_id = $("#last_inserted_id").val();

								var pet_age = $("#pet_age").val();
								var pet_weight = $("#pet_weight").val();
								var pet_name = $("#pet_name").val();
								var pet_height = $("#pet_height").val();

								$.ajax({
									url: "add_pet_details",
									method: "POST",
									data: {
										lead_id: lead_id,
										pet_gender: pet_gender,
										pet_name: pet_name,
										pet_age: pet_age,
										pet_weight: pet_weight,
										pet_height: pet_height,
									},
									beforeSend: function () {
										$("#pet_submit").attr("disabled", true);
									},
									success: function (response) {
										$("#pet_submit").attr("disabled", false);
										$(".form-control").val("");
										$("#add_pet_modal").modal("toggle");

										Swal.fire({
											position: "top-end",
											icon: "success",
											title: "Pet Details Saved Successfully",
											showConfirmButton: false,
											timer: 1500,
										});

										$("#pet_div").removeClass("hidden");

										var obj = jQuery.parseJSON(response);

										$("#edit_pet_name").val(obj.name);
										$("#edit_pet_gender").val(obj.gender);
										$("#edit_pet_age").val(obj.age_in_months);
										$("#edit_pet_height").val(obj.height_in_ft);
										$("#edit_pet_weight").val(obj.weight_in_kg);

										$("#add_pet_btn").addClass("hidden");
										$("#edit_pet_btn").removeClass("hidden");
									},
								});
							});

							// Property

							$("#home_btn").click(function () {
								house_society_to_home();
							});

							$("#housing_society_btn").click(function () {
								home_to_house_society();
							});

							$("#owner_btn").click(function () {
								tenant_to_owner();
							});

							$("#tenant_btn").click(function () {
								owner_to_tenant();
							});

							// Home property Button

							$("#add_pro_btn").click(function () {
								var lead_id = $("#last_inserted_id").val();
								var home_policy_tenure = $("#home_policy_tenure").val();
								var home_age_premises = $("#home_age_premises").val();
								var home_property_value = $("#home_property_value").val();
								var home_sqft = $("#home_sqft").val();
								var home_infuli = $("#home_infuli").val();
								var home_dgairmac = $("#home_dgairmac").val();

								if (home_policy_tenure == "") {
									snackbar_show("Select Policy Tenure");
								} else if (home_age_premises == "") {
									snackbar_show("Select Home Age Premises");
								} else if (home_property_value == "") {
									snackbar_show("Enter Home Value");
								} else if (home_sqft == "") {
									snackbar_show("Enter Home Square Feet");
								} else if (home_infuli == "") {
									snackbar_show("Enter Interior furniture lighting Value");
								} else if (home_dgairmac == "") {
									snackbar_show("Enter A/C, DG set Machinery value");
								} else {
									$.ajax({
										url: "add_home_property",
										data: {
											lead_id: lead_id,
											house_type: house_type,
											owner_type: owner_type,
											home_policy_tenure: home_policy_tenure,
											home_age_premises: home_age_premises,
											home_property_value: home_property_value,
											home_sqft: home_sqft,
											home_infuli: home_infuli,
											home_dgairmac: home_dgairmac,
										},
										method: "POST",
										beforeSend: function () {
											$("#add_pro_btn").attr("disabled", true);
										},
										success: function (response) {
											$("#add_pro_btn").attr("disabled", false);
											$("#homeModal").modal("toggle");
											Swal.fire({
												position: "top-end",
												icon: "success",
												title: "Your Home Insurace Details Saved Successfully",
												showConfirmButton: false,
												timer: 1500,
											});

											var obj = jQuery.parseJSON(response);
											if (obj != null) {
												$("#home_pro_div").removeClass("hidden");
												$("#business_pro_div").addClass("hidden");
												$("#home_pro_div").removeClass("hidden");
												$("#add_prop_btn").addClass("hidden");
												$("#edit_home_prop_btn").removeClass("hidden");

												$("#housing_type").val(obj.house_type);
												$("#policy_tensure").val(obj.home_policy_tenure);
												$("#property_value").val(obj.home_property_value);
												$("#interior_furniture").val(obj.home_interior);
												$("#tenant_or_owner").val(obj.owner_type);
												$("#age_of_premises").val(obj.home_age_premises);
												$("#built_up_area").val(obj.home_sqft);
												$("#air_conditionor_amt").val(obj.home_ac);
											}
										},
										error: function (code) {
											alert(code.statusText);
										},
									});
								}
							});

							// Business property

							$("#business_owner_btn").click(function () {
								business_tenant_to_owner();
							});

							$("#business_tenant_btn").click(function () {
								business_owner_to_tenant();
							});

							$("#add_business_btn").click(function () {
								var lead_id = $("#last_inserted_id").val();
								var business_profession = $("#business_profession").val();
								var business_age_premises = $("#business_age_premises").val();
								var business_property_value = $(
									"#business_property_value"
								).val();
								var business_sqft = $("#business_sqft").val();
								var business_infuli = $("#business_infuli").val();
								var business_dgairmac = $("#business_dgairmac").val();

								var check = 0;

								if (business_profession == "") {
									check = 1;
									Swal.fire("Select Profession ?", "", "question");
								} else if (business_age_premises == "") {
									check = 1;
									Swal.fire("Age of Premises ?", "", "question");
								} else if (business_property_value == "") {
									check = 1;
									Swal.fire("Enter Property Value ?", "", "question");
								} else if (business_sqft == "") {
									check = 1;
									Swal.fire("Enter Built Up Area ?", "", "question");
								} else if (business_infuli == "") {
									check = 1;
									Swal.fire(
										"Enter Interior, Furniture & Lighting ?",
										"",
										"question"
									);
								} else if (business_dgairmac == "") {
									check = 1;
									Swal.fire(
										"Enter DG set, Air Conditioner & Machinery ?",
										"",
										"question"
									);
								} else if (check != 1) {
									$.ajax({
										url: "add_business_details",
										method: "POST",
										data: {
											lead_id: lead_id,
											business_owner_type: business_owner_type,
											business_profession: business_profession,
											business_age_premises: business_age_premises,
											business_property_value: business_property_value,
											business_sqft: business_sqft,
											business_infuli: business_infuli,
											business_dgairmac: business_dgairmac,
										},
										beforeSend: function () {
											$("#add_business_btn").attr("disabled", true);
										},
										success: function (response) {
											$("#add_business_btn").attr("disabled", false);
											$("#businessmodal").modal("toggle");
											Swal.fire({
												position: "top-end",
												icon: "success",
												title:
													"Your Bussiness Insurace Details Saved Successfully",
												showConfirmButton: false,
												timer: 1500,
											});

											$(".form-control").val("");

											$("#business_pro_div").removeClass("hidden");
											$("#home_pro_div").addClass("hidden");

											var obj = jQuery.parseJSON(response);

											$("#b_tenant_or_owner").val(obj.owner_type);
											$("#b_proffession").val(obj.profession);
											$("#b_property_value").val(obj.business_property_value);
											$("#b_age_of_premise").val(obj.business_age_premises);
											$("#b_interior_furniture").val(obj.business_interior);
											$("#b_built_up_area").val(obj.business_sqft);
											$("#b_air_conditionor_amt").val(obj.business_ac);
											$("#business_prop_btn").addClass("hidden");
											$("#edit_business_prop_btn").removeClass("hidden");
										},
										error: function (code) {
											alert(code.statusText);
										},
									});
								}
							});

							$("#marine_cummodity").change(function () {
								var commodity = $("#marine_cummodity").val();
								$.ajax({
									url: "commodity_change_load_sub_commodity",
									method: "Post",
									data: {
										commodity: commodity,
									},
									success: function (response) {
										$("#marine_sub_cummodity").html(response);
									},
									error: function (code) {
										alert(code.statusText);
									},
								});
							});

							//Marine

							$("#marine_submit").click(function () {
								var lead_id = $("#last_inserted_id").val();
								var marine_type = $("#transit_policy").val();
								var marine_company_name = $("#marine_company_name").val();
								var marine_city_name = $("#marine_city_name").val();
								var marine_transport = $("#marine_transport").val();
								var marine_cummodity = $("#marine_cummodity").val();
								var marine_sub_cummodity = $("#marine_sub_cummodity").val();
								var marine_invoice_val = $("#marine_invoice_val").val();
								var marine_invoice_10per_val = $(
									"#marine_invoice_10per_val"
								).val();
								if (marine_company_name == "") {
									snackbar_show("Enter Company Name");
								} else if (marine_city_name == "") {
									snackbar_show("Enter City Name");
								} else if (marine_transport == "") {
									snackbar_show("Select Mode of Transport");
								} else if (marine_cummodity == "") {
									snackbar_show("Select Commodity");
								} else if (marine_sub_cummodity == "") {
									snackbar_show("Select Sub Commodity");
								} else if (marine_invoice_val == "") {
									snackbar_show("Enter Invoice Value");
								} else {
									$.ajax({
										url: "marine_submit",
										method: "POST",
										data: {
											lead_id: lead_id,
											marine_company_name: marine_company_name,
											marine_city_name: marine_city_name,
											marine_transport: marine_transport,
											marine_cummodity: marine_cummodity,
											marine_sub_cummodity: marine_sub_cummodity,
											marine_invoice_val: marine_invoice_val,
											marine_invoice_10per_val: marine_invoice_10per_val,
											marine_type: marine_type,
										},
										beforeSend: function () {
											$("#marine_submit").attr("disabled", true);
										},
										success: function (response) {
											$("#marainemodal").modal("toggle");
											$(".form-control").val("");
											Swal.fire({
												position: "top-end",
												icon: "success",
												title: "Maraine Details Saved Successfully",
												showConfirmButton: false,
												timer: 1500,
											});

											$("#maraine_div").removeClass("hidden");

											$("#add_maraine_btn").addClass("hidden");
											$("#edit_maraine_btn").removeClass("hidden");

											var obj = jQuery.parseJSON(response);
											$("#m_transit_policy").val(obj["maraine_details"].type);
											$("#m_marine_transport").val(
												obj["maraine_details"].transport_mode
											);
											$("#m_marine_cummodity").val(
												obj["maraine_details"].commodity
											);
											$("#m_marine_sub_cummodity").html(obj["sub_commodity"]);
											$("#m_marine_sub_cummodity").val(
												obj["maraine_details"].sub_commodity
											);
											$("#m_marine_company_name").val(
												obj["maraine_details"].company_name
											);
											$("#m_marine_city_name").val(
												obj["maraine_details"].city_name
											);
											$("#m_marine_invoice_val").val(
												obj["maraine_details"].invoice_value
											);
											$("#m_marine_invoice_10per_val").val(
												obj["maraine_details"].sum_invoice
											);
										},
										error: function (code) {
											alert(code.statusText);
										},
									});
								}
							});

							$("#add_nominee_btn").click(function () {
								var lead_id = $("#last_inserted_id").val();
								var nominee_name = $("#nominee_name").val();
								var adharcard_no = $("#adharcard_no").val();
								var n_mobile_no = $("#n_mobile_no").val();
								var adhar_card_upload = $("#n_adhar_card_upload").val();
								var n_adhar_card_upload = $("#n_adhar_card_upload").prop(
									"files"
								)[0];
								if (nominee_name == "") {
									snackbar_show("Enter Nominee Name");
								} else if (adharcard_no == "") {
									snackbar_show("Enter a Adhar Card Number");
								} else if (n_mobile_no == "") {
									snackbar_show("Enter a Nominee mobile No");
								} else if (adhar_card_upload == "") {
									snackbar_show("Upload Nominee AdharCard");
								} else {
									var formdata = new FormData();
									formdata.append("lead_id", lead_id);
									formdata.append("nominee_name", nominee_name);
									formdata.append("adharcard_no", adharcard_no);
									formdata.append("n_mobile_no", n_mobile_no);
									formdata.append("n_adhar_card_upload", n_adhar_card_upload);

									$.ajax({
										type: "POST",
										url: "add_nominee_details",
										data: formdata,
										processData: false,
										contentType: false,
										cache: false,
										dataType: "text",
										beforeSend: function () {
											$("#add_nominee_btn").attr("disabled", true);
										},
										success: function (response) {
											$("#add_nominee_btn").attr("disabled", false);
											Swal.fire({
												position: "top-end",
												icon: "success",
												title: "Nominee Details Added Successfully",
												showConfirmButton: false,
												timer: 1500,
											});
											window.location.href = "create_lead?id=" + lead_id;
										},
									});
								}
							});

							$("#agent_pos").change(function () {
								var agent_pos = $("#agent_pos").val();
								var session_role = $("#session_role").val();

								$.ajax({
									url: "fetch_area_incharge_by_agent",
									method: "POST",
									data: { agent_pos: agent_pos },
									success: function (response) {
										var obj = jQuery.parseJSON(response);

										var html = "";

										if (obj != null) {
											html =
												"<option value='" +
												obj.id +
												"'>" +
												obj.name +
												"  -( " +
												obj.phoneno +
												" )</option>";
										}
										$("#area_incharge").html(html);
									},
								});

								if (session_role == "AI" || session_role == "user") {
									$.ajax({
										url: "fetch_user_by_agent",
										method: "POST",
										data: { agent_pos: agent_pos },
										success: function (response) {
											$("#assign_to_user").html(response);
										},
									});
								}
							});

							// Edit

							$("#edit_health_details").click(function () {
								var lead_id = $("#last_inserted_id").val();
								$.ajax({
									url: "fetch_edit_health_details",
									method: "POST",
									data: { lead_id: lead_id },
									success: function (response) {
										var obj = jQuery.parseJSON(response);

										if (obj != null) {
											$("#edit_h_gender").val(obj.gender);

											var members = [];

											if (obj.husband == "1") {
												members.push("You");
												$("#edit_you_div").removeClass("hidden");
												$("#edit_you_name").val(obj.husband_name);
												$("#edit_dob").val(obj.husband_dob);
												$("#edit_you_age").val(obj.husband_age);
											}
											if (obj.wife == "1") {
												members.push("Spouse");
												$("#edit_husband_wife_div").removeClass("hidden");
												$("#edit_hus_wife_name").val(obj.wife_name);
												$("#edit_hus_wife_dob").val(obj.wife_dob);
												$("#edit_hus_wife_age").val(obj.wife_age);
											}

											if (obj.son == "1") {
												members.push("Son");

												if (parseInt(obj.son_count) == 4) {
													$("#edit_son_div1").removeClass("hidden");
													$("#edit_son_div2").removeClass("hidden");
													$("#edit_son_div3").removeClass("hidden");
													$("#edit_son_div4").removeClass("hidden");

													$("#edit_son_name_1").val(obj.son_name_1);
													$("#edit_son_name_2").val(obj.son_name_2);
													$("#edit_son_name_3").val(obj.son_name_3);
													$("#edit_son_name_4").val(obj.son_name_4);

													$("#edit_son_dob_1").val(obj.son_dob_1);
													$("#edit_son_dob_2").val(obj.son_dob_2);
													$("#edit_son_dob_3").val(obj.son_dob_3);
													$("#edit_son_dob_4").val(obj.son_dob_4);

													"#edit_son_age_1".val(obj.son1_age);
													$("#edit_son_age_2").val(obj.son2_age);
													$("#edit_son_age_3").val(obj.son3_age);
													$("#edit_son_age_4").val(obj.son4_age);
												} else if (parseInt(obj.son_count) == 3) {
													$("#edit_son_div1").removeClass("hidden");
													$("#edit_son_div2").removeClass("hidden");
													$("#edit_son_div3").removeClass("hidden");
													$("#edit_son_div4").addClass("hidden");

													$("#edit_son_name_1").val(obj.son_name_1);
													$("#edit_son_name_2").val(obj.son_name_2);
													$("#edit_son_name_3").val(obj.son_name_3);

													$("#edit_son_dob_1").val(obj.son_dob_1);
													$("#edit_son_dob_2").val(obj.son_dob_2);
													$("#edit_son_dob_3").val(obj.son_dob_3);

													$("#edit_son_age_1").val(obj.son1_age);
													$("#edit_son_age_2").val(obj.son2_age);
													$("#edit_son_age_3").val(obj.son3_age);
												} else if (parseInt(obj.son_count) == 2) {
													$("#edit_son_div1").removeClass("hidden");
													$("#edit_son_div2").removeClass("hidden");
													$("#edit_son_div3").addClass("hidden");
													$("#edit_son_div4").addClass("hidden");
													$("#edit_son_name_1").val(obj.son_name_1);
													$("#edit_son_name_2").val(obj.son_name_2);
													$("#edit_son_dob_1").val(obj.son_dob_1);
													$("#edit_son_dob_2").val(obj.son_dob_2);
													$("#edit_son_age_1").val(obj.son1_age);
													$("#edit_son_age_2").val(obj.son2_age);
												} else if (parseInt(obj.son_count) == 1) {
													$("#edit_son_name_1").val(obj.son_name_1);
													$("#edit_son_dob_1").val(obj.son_dob_1);
													$("#edit_son_div1").removeClass("hidden");
													$("#edit_son_div2").addClass("hidden");
													$("#edit_son_div3").addClass("hidden");
													$("#edit_son_div4").addClass("hidden");
													$("#edit_son_age_1").val(obj.son1_age);
												}
											}
											if (obj.duaghter == "1") {
												members.push("Daughter");

												if (parseInt(obj.duaghter_count) == 4) {
													$("#edit_daughter_div1").removeClass("hidden");
													$("#edit_daughter_div2").removeClass("hidden");
													$("#edit_daughter_div3").removeClass("hidden");
													$("#edit_daughter_div4").removeClass("hidden");

													$("#edit_daughter_name_1").val(obj.daughter_name_1);
													$("#edit_daughter_name_2").val(obj.daughter_name_2);
													$("#edit_daughter_name_3").val(obj.daughter_name_3);
													$("#edit_daughter_name_4").val(obj.daughter_name_4);

													$("#edit_daughter_dob_1").val(obj.daughter_dob_1);
													$("#edit_daughter_dob_2").val(obj.daughter_dob_2);
													$("#edit_daughter_dob_3").val(obj.daughter_dob_3);
													$("#edit_daughter_dob_4").val(obj.daughter_dob_4);

													$("#edit_daughter_age_1").val(obj.daughter1_age);
													$("#edit_daughter_age_2").val(obj.daughter2_age);
													$("#edit_daughter_age_3").val(obj.daughter3_age);
													$("#edit_daughter_age_4").val(obj.daughter4_age);
												} else if (parseInt(obj.duaghter_count) == 3) {
													$("#edit_daughter_div1").removeClass("hidden");
													$("#edit_daughter_div2").removeClass("hidden");
													$("#edit_daughter_div3").removeClass("hidden");
													$("#edit_daughter_div4").addClass("hidden");

													$("#edit_daughter_name_1").val(obj.daughter_name_1);
													$("#edit_daughter_name_2").val(obj.daughter_name_2);
													$("#edit_daughter_name_3").val(obj.daughter_name_3);

													$("#edit_daughter_dob_1").val(obj.daughter_dob_1);
													$("#edit_daughter_dob_2").val(obj.daughter_dob_2);
													$("#edit_daughter_dob_3").val(obj.daughter_dob_3);

													$("#edit_daughter_age_1").val(obj.daughter1_age);
													$("#edit_daughter_age_2").val(obj.daughter2_age);
													$("#edit_daughter_age_3").val(obj.daughter3_age);
												} else if (parseInt(obj.duaghter_count) == 2) {
													$("#edit_daughter_div1").removeClass("hidden");
													$("#edit_daughter_div2").removeClass("hidden");
													$("#edit_daughter_div3").addClass("hidden");
													$("#edit_daughter_div4").addClass("hidden");

													$("#edit_daughter_name_1").val(obj.daughter_name_1);
													$("#edit_daughter_name_2").val(obj.daughter_name_2);

													$("#edit_daughter_dob_1").val(obj.daughter_dob_1);
													$("#edit_daughter_dob_2").val(obj.daughter_dob_2);

													$("#edit_daughter_age_1").val(obj.daughter1_age);
													$("#edit_daughter_age_2").val(obj.daughter2_age);
												} else if (parseInt(obj.duaghter_count) == 1) {
													$("#edit_daughter_name_1").val(obj.daughter_name_1);
													$("#edit_daughter_dob_1").val(obj.daughter_dob_1);
													$("#edit_daughter_div1").removeClass("hidden");
													$("#edit_daughter_div2").addClass("hidden");
													$("#edit_daughter_div3").addClass("hidden");
													$("#edit_daughter_div4").addClass("hidden");
													$("#edit_daughter_age_1").val(obj.daughter1_age);
												}
											}
											if (obj.father == "1") {
												members.push("Father");
												$("#edit_father_div").removeClass("hidden");
												$("#edit_father_age").val(obj.father_age);
											}
											if (obj.mother == "1") {
												members.push("Mother");
												$("#edit_mother_div").removeClass("hidden");
												$("#edit_mother_age").val(obj.mother_age);
											}

											$("#edit_h_family_members").val(members);
											$("#edit_h_family_members").trigger("change");
											$("#edit_num_sons").val(obj.son_count);
											$("#edit_num_daughters").val(obj.duaghter_count);
											$("#edit_health_model").modal("toggle");
										}
									},
								});
							});

							$("#edit_health_btn").click(function () {
								var lead_id = $("#last_inserted_id").val();
								var h_gender = $("#edit_h_gender").val();
								var h_family_members = $("#edit_h_family_members").val();
								var num_daughters = $("#edit_num_daughters").val();
								var num_sons = $("#edit_num_sons").val();
								var you_age = $("#edit_you_age").val();
								var hus_wife_age = $("#edit_hus_wife_age").val();
								var created_id = $("#edit_created_id").val();

								if (h_gender == "Male") {
									for (var i = 0; i < h_family_members.length; i++) {
										if (h_family_members[i] == "You") {
											Husband = 1;
											Husband_age = $("#edit_you_age").val();

											Husband_name = $("#edit_you_name").val();
											Husband_dob = $("#edit_dob").val();
										}
										if (h_family_members[i] == "Spouse") {
											Wife = 1;
											Wife_age = $("#edit_hus_wife_age").val();

											Wife_name = $("#edit_hus_wife_name").val();
											Wife_dob = $("#edit_hus_wife_dob").val();
										}
										if (h_family_members[i] == "Son") {
											Son = 1;
										}
										if (h_family_members[i] == "Daughter") {
											Daughter = 1;
										}

										if (h_family_members[i] == "Father") {
											Father = 1;
										}
										if (h_family_members[i] == "Mother") {
											Mother = 1;
										}
									}
								} else if (h_gender == "Female") {
									for (var i = 0; i < h_family_members.length; i++) {
										if (h_family_members[i] == "You") {
											Wife = 1;
											Wife_age = $("#edit_you_age").val();
											Wife_name = $("#edit_you_name").val();
											Wife_dob = $("#edit_you_dob").val();
										}

										if (h_family_members[i] == "Husband") {
											Husband = 1;
											Husband_age = $("#edit_hus_wife_age").val();
											Husband_name = $("#edit_hus_wife_name").val();
											Husband_dob = $("#edit_hus_wife_dob").val();
										}

										if (h_family_members[i] == "Son") {
											Son = 1;
										}

										if (h_family_members[i] == "Daughter") {
											Daughter = 1;
										}

										if (h_family_members[i] == "Father") {
											Father = 1;
										}
										if (h_family_members[i] == "Mother") {
											Mother = 1;
										}
									}
								}

								var num_daughters = $("#edit_num_daughters").val();
								var num_sons = $("#edit_num_sons").val();

								var daughter_name_1 = $("#edit_daughter_name_1").val();
								var daughter_name_2 = $("#edit_daughter_name_2").val();
								var daughter_name_3 = $("#edit_daughter_name_3").val();
								var daughter_name_4 = $("#edit_daughter_name_4").val();

								var daughter_dob_1 = $("#edit_daughter_dob_1").val();
								var daughter_dob_2 = $("#edit_daughter_dob_2").val();
								var daughter_dob_3 = $("#edit_daughter_dob_3").val();
								var daughter_dob_4 = $("#edit_daughter_dob_4").val();

								var daughter_1_age = $("#edit_daughter_age_1").val();
								var daughter_2_age = $("#edit_daughter_age_2").val();
								var daughter_3_age = $("#edit_daughter_age_3").val();
								var daughter_4_age = $("#edit_daughter_age_4").val();

								var son_name_1 = $("#edit_son_name_1").val();
								var son_name_2 = $("#edit_son_name_2").val();
								var son_name_3 = $("#edit_son_name_3").val();
								var son_name_4 = $("#edit_son_name_4").val();

								var son_dob_1 = $("#edit_son_dob_1").val();
								var son_dob_2 = $("#edit_son_dob_2").val();
								var son_dob_3 = $("#edit_son_dob_3").val();
								var son_dob_4 = $("#edit_son_dob_4").val();

								var son_1_age = $("#edit_son_age_1").val();
								var son_2_age = $("#edit_son_age_2").val();
								var son_3_age = $("#edit_son_age_3").val();
								var son_4_age = $("#edit_son_age_4").val();

								var father_name = $("#edit_father_name").val();
								var father_dob = $("#edit_father_dob").val();
								var father_age = $("#edit_father_age").val();

								var mother_name = $("#edit_mother_name").val();
								var dob_mother = $("#edit_dob_mother").val();
								var mother_age = $("#edit_mother_age").val();

								var formdata = new FormData();

								formdata.append("lead_id", lead_id);
								formdata.append("h_gender", h_gender);
								formdata.append("Husband", Husband);
								formdata.append("Wife", Wife);

								formdata.append("Husband_name", Husband_name);
								formdata.append("Husband_dob", Husband_dob);
								formdata.append("Wife_name", Wife_name);
								formdata.append("Wife_dob", Wife_dob);

								formdata.append("Son", Son);
								formdata.append("Daughter", Daughter);
								formdata.append("Father", Father);
								formdata.append("Mother", Mother);
								formdata.append("Husband_age", Husband_age);
								formdata.append("Wife_age", Wife_age);
								formdata.append("num_daughters", num_daughters);
								formdata.append("num_sons", num_sons);

								formdata.append("son_name_1", son_name_1);
								formdata.append("son_name_2", son_name_2);
								formdata.append("son_name_3", son_name_3);
								formdata.append("son_name_4", son_name_4);

								formdata.append("son_dob_1", son_dob_1);
								formdata.append("son_dob_2", son_dob_2);
								formdata.append("son_dob_3", son_dob_3);
								formdata.append("son_dob_4", son_dob_4);

								formdata.append("son_1_age", son_1_age);
								formdata.append("son_2_age", son_2_age);
								formdata.append("son_3_age", son_3_age);
								formdata.append("son_4_age", son_4_age);

								formdata.append("daughter_name_1", daughter_name_1);
								formdata.append("daughter_name_2", daughter_name_2);
								formdata.append("daughter_name_3", daughter_name_3);
								formdata.append("daughter_name_4", daughter_name_4);

								formdata.append("daughter_dob_1", daughter_dob_1);
								formdata.append("daughter_dob_2", daughter_dob_2);
								formdata.append("daughter_dob_3", daughter_dob_3);
								formdata.append("daughter_dob_4", daughter_dob_4);

								formdata.append("daughter_1_age", daughter_1_age);
								formdata.append("daughter_2_age", daughter_2_age);
								formdata.append("daughter_3_age", daughter_3_age);
								formdata.append("daughter_4_age", daughter_4_age);

								formdata.append("father_name", father_name);
								formdata.append("father_dob", father_dob);
								formdata.append("father_age", father_age);

								formdata.append("mother_name", mother_name);
								formdata.append("dob_mother", dob_mother);
								formdata.append("mother_age", mother_age);

								$.ajax({
									url: "edit_health_details",
									method: "POST",
									data: formdata,
									processData: false,
									contentType: false,
									cache: false,
									dataType: "text",
									beforeSend: function () {
										$("#edit_health_btn").attr("disabled", true);
									},
									success: function (response) {
										$("#edit_health_btn").attr("disabled", false);
										$("#edit_health_model").modal("toggle");
										Swal.fire({
											position: "top-end",
											icon: "success",
											title: "Health Details Has Been Updated Successfully",
											showConfirmButton: false,
											timer: 1500,
										});
										location.reload();
									},
								});
							});

							// dob

							$("#add_dob").change(function () {
								var dob = $("#add_dob").val();
								dob = new Date(dob);
								var today = new Date();
								var age = Math.floor(
									(today - dob) / (365.25 * 24 * 60 * 60 * 1000)
								);
								$("#you_age").val(age);
							});

							$("#add_hus_wife_dob").change(function () {
								var dob = $("#add_hus_wife_dob").val();
								dob = new Date(dob);
								var today = new Date();
								var age = Math.floor(
									(today - dob) / (365.25 * 24 * 60 * 60 * 1000)
								);
								$("#hus_wife_age").val(age);
							});

							$("#add_daughter_dob_1").change(function () {
								var dob = $("#add_daughter_dob_1").val();
								dob = new Date(dob);
								var today = new Date();

								var currentMonth = new Date().getMonth() + 1;
								var dob_month = dob.getMonth() + 1;

								var currentYear = new Date().getFullYear();
								var dobYear = dob.getFullYear();

								if (currentYear > dobYear) {
									var year = currentYear - dobYear;
									var add_year = year * 12;

									if (parseInt(add_year) > parseInt(12)) {
										var age_year = Math.floor(
											(today - dob) / (365.25 * 24 * 60 * 60 * 1000)
										);
										var age = age_year * 12;
									} else {
										var age = add_year + Math.floor(currentMonth - dob_month);
									}
								} else {
									var age = Math.floor(currentMonth - dob_month);
								}
								$("#daughter_age_1").val(age);
							});

							$("#add_daughter_dob_2").change(function () {
								var dob = $("#add_daughter_dob_2").val();
								dob = new Date(dob);
								var today = new Date();

								var currentMonth = new Date().getMonth() + 1;
								var dob_month = dob.getMonth() + 1;

								var currentYear = new Date().getFullYear();
								var dobYear = dob.getFullYear();

								if (currentYear > dobYear) {
									var year = currentYear - dobYear;
									var add_year = year * 12;

									if (parseInt(add_year) > parseInt(12)) {
										var age_year = Math.floor(
											(today - dob) / (365.25 * 24 * 60 * 60 * 1000)
										);
										var age = age_year * 12;
									} else {
										var age = add_year + Math.floor(currentMonth - dob_month);
									}
								} else {
									var age = Math.floor(currentMonth - dob_month);
								}
								$("#daughter_age_2").val(age);
							});

							$("#add_daughter_dob_3").change(function () {
								var dob = $("#add_daughter_dob_3").val();
								dob = new Date(dob);
								var today = new Date();

								var currentMonth = new Date().getMonth() + 1;
								var dob_month = dob.getMonth() + 1;

								var currentYear = new Date().getFullYear();
								var dobYear = dob.getFullYear();

								if (currentYear > dobYear) {
									var year = currentYear - dobYear;
									var add_year = year * 12;

									if (parseInt(add_year) > parseInt(12)) {
										var age_year = Math.floor(
											(today - dob) / (365.25 * 24 * 60 * 60 * 1000)
										);
										var age = age_year * 12;
									} else {
										var age = add_year + Math.floor(currentMonth - dob_month);
									}
								} else {
									var age = Math.floor(currentMonth - dob_month);
								}
								$("#daughter_age_3").val(age);
							});

							$("#add_son_dob_1").change(function () {
								var dob = $("#add_son_dob_1").val();
								dob = new Date(dob);
								var today = new Date();

								var currentMonth = new Date().getMonth() + 1;
								var dob_month = dob.getMonth() + 1;

								var currentYear = new Date().getFullYear();
								var dobYear = dob.getFullYear();

								if (currentYear > dobYear) {
									var year = currentYear - dobYear;
									var add_year = year * 12;

									if (parseInt(add_year) > parseInt(12)) {
										var age_year = Math.floor(
											(today - dob) / (365.25 * 24 * 60 * 60 * 1000)
										);
										var age = age_year * 12;
									} else {
										var age = add_year + Math.floor(currentMonth - dob_month);
									}
								} else {
									var age = Math.floor(currentMonth - dob_month);
								}
								$("#son_age_1").val(age);
							});

							$("#add_son_dob_2").change(function () {
								var dob = $("#add_son_dob_2").val();
								dob = new Date(dob);
								var today = new Date();

								var currentMonth = new Date().getMonth() + 1;
								var dob_month = dob.getMonth() + 1;

								var currentYear = new Date().getFullYear();
								var dobYear = dob.getFullYear();

								if (currentYear > dobYear) {
									var year = currentYear - dobYear;
									var add_year = year * 12;

									if (parseInt(add_year) > parseInt(12)) {
										var age_year = Math.floor(
											(today - dob) / (365.25 * 24 * 60 * 60 * 1000)
										);
										var age = age_year * 12;
									} else {
										var age = add_year + Math.floor(currentMonth - dob_month);
									}
								} else {
									var age = Math.floor(currentMonth - dob_month);
								}
								$("#son_age_2").val(age);
							});

							$("#add_son_dob_3").change(function () {
								var dob = $("#add_son_dob_3").val();
								dob = new Date(dob);
								var today = new Date();

								var currentMonth = new Date().getMonth() + 1;
								var dob_month = dob.getMonth() + 1;

								var currentYear = new Date().getFullYear();
								var dobYear = dob.getFullYear();

								if (currentYear > dobYear) {
									var year = currentYear - dobYear;
									var add_year = year * 12;

									if (parseInt(add_year) > parseInt(12)) {
										var age_year = Math.floor(
											(today - dob) / (365.25 * 24 * 60 * 60 * 1000)
										);
										var age = age_year * 12;
									} else {
										var age = add_year + Math.floor(currentMonth - dob_month);
									}
								} else {
									var age = Math.floor(currentMonth - dob_month);
								}
								$("#son_age_3").val(age);
							});

							// edit_dob

							$("#edit_dob").change(function () {
								var dob = $("#edit_dob").val();
								dob = new Date(dob);
								var today = new Date();
								var age = Math.floor(
									(today - dob) / (365.25 * 24 * 60 * 60 * 1000)
								);
								$("#edit_you_age").val(age);
							});

							$("#edit_hus_wife_dob").change(function () {
								var dob = $("#edit_hus_wife_dob").val();
								dob = new Date(dob);
								var today = new Date();
								var age = Math.floor(
									(today - dob) / (365.25 * 24 * 60 * 60 * 1000)
								);
								$("#edit_hus_wife_age").val(age);
							});

							$("#edit_daughter_dob_1").change(function () {
								var dob = $("#edit_daughter_dob_1").val();
								dob = new Date(dob);
								var today = new Date();

								var currentMonth = new Date().getMonth() + 1;
								var dob_month = dob.getMonth() + 1;

								var currentYear = new Date().getFullYear();
								var dobYear = dob.getFullYear();

								if (currentYear > dobYear) {
									var year = currentYear - dobYear;
									var add_year = year * 12;

									if (parseInt(add_year) > parseInt(12)) {
										var age_year = Math.floor(
											(today - dob) / (365.25 * 24 * 60 * 60 * 1000)
										);
										var age = age_year * 12;
									} else {
										var age = add_year + Math.floor(currentMonth - dob_month);
									}
								} else {
									var age = Math.floor(currentMonth - dob_month);
								}
								$("#edit_daughter_age_1").val(age);
							});

							$("#edit_daughter_dob_2").change(function () {
								var dob = $("#edit_daughter_dob_2").val();
								dob = new Date(dob);
								var today = new Date();

								var currentMonth = new Date().getMonth() + 1;
								var dob_month = dob.getMonth() + 1;

								var currentYear = new Date().getFullYear();
								var dobYear = dob.getFullYear();

								if (currentYear > dobYear) {
									var year = currentYear - dobYear;
									var add_year = year * 12;

									if (parseInt(add_year) > parseInt(12)) {
										var age_year = Math.floor(
											(today - dob) / (365.25 * 24 * 60 * 60 * 1000)
										);
										var age = age_year * 12;
									} else {
										var age = add_year + Math.floor(currentMonth - dob_month);
									}
								} else {
									var age = Math.floor(currentMonth - dob_month);
								}
								$("#edit_daughter_age_2").val(age);
							});

							$("#edit_daughter_dob_3").change(function () {
								var dob = $("#edit_daughter_dob_3").val();
								dob = new Date(dob);
								var today = new Date();

								var currentMonth = new Date().getMonth() + 1;
								var dob_month = dob.getMonth() + 1;

								var currentYear = new Date().getFullYear();
								var dobYear = dob.getFullYear();

								if (currentYear > dobYear) {
									var year = currentYear - dobYear;
									var add_year = year * 12;

									if (parseInt(add_year) > parseInt(12)) {
										var age_year = Math.floor(
											(today - dob) / (365.25 * 24 * 60 * 60 * 1000)
										);
										var age = age_year * 12;
									} else {
										var age = add_year + Math.floor(currentMonth - dob_month);
									}
								} else {
									var age = Math.floor(currentMonth - dob_month);
								}
								$("#edit_daughter_age_3").val(age);
							});

							$("#edit_son_dob_1").change(function () {
								var dob = $("#edit_son_dob_1").val();
								dob = new Date(dob);
								var today = new Date();

								var currentMonth = new Date().getMonth() + 1;
								var dob_month = dob.getMonth() + 1;

								var currentYear = new Date().getFullYear();
								var dobYear = dob.getFullYear();

								if (currentYear > dobYear) {
									var year = currentYear - dobYear;
									var add_year = year * 12;

									if (parseInt(add_year) > parseInt(12)) {
										var age_year = Math.floor(
											(today - dob) / (365.25 * 24 * 60 * 60 * 1000)
										);
										var age = age_year * 12;
									} else {
										var age = add_year + Math.floor(currentMonth - dob_month);
									}
								} else {
									var age = Math.floor(currentMonth - dob_month);
								}
								$("#edit_son_age_1").val(age);
							});

							$("#edit_son_dob_2").change(function () {
								var dob = $("#edit_son_dob_2").val();
								dob = new Date(dob);
								var today = new Date();

								var currentMonth = new Date().getMonth() + 1;
								var dob_month = dob.getMonth() + 1;

								var currentYear = new Date().getFullYear();
								var dobYear = dob.getFullYear();

								if (currentYear > dobYear) {
									var year = currentYear - dobYear;
									var add_year = year * 12;

									if (parseInt(add_year) > parseInt(12)) {
										var age_year = Math.floor(
											(today - dob) / (365.25 * 24 * 60 * 60 * 1000)
										);
										var age = age_year * 12;
									} else {
										var age = add_year + Math.floor(currentMonth - dob_month);
									}
								} else {
									var age = Math.floor(currentMonth - dob_month);
								}
								$("#edit_son_age_2").val(age);
							});

							$("#edit_son_dob_3").change(function () {
								var dob = $("#edit_son_dob_3").val();
								dob = new Date(dob);
								var today = new Date();

								var currentMonth = new Date().getMonth() + 1;
								var dob_month = dob.getMonth() + 1;

								var currentYear = new Date().getFullYear();
								var dobYear = dob.getFullYear();

								if (currentYear > dobYear) {
									var year = currentYear - dobYear;
									var add_year = year * 12;

									if (parseInt(add_year) > parseInt(12)) {
										var age_year = Math.floor(
											(today - dob) / (365.25 * 24 * 60 * 60 * 1000)
										);
										var age = age_year * 12;
									} else {
										var age = add_year + Math.floor(currentMonth - dob_month);
									}
								} else {
									var age = Math.floor(currentMonth - dob_month);
								}
								$("#edit_son_age_3").val(age);
							});

							$("#sme_id").change(function () {
								var smepolicy = $("#sme_id").val();

								if (smepolicy == 74) {
									$("#marine_remove").removeClass("hidden");
									$("#marine").removeClass("hidden");
								} else if (smepolicy == 78) {
									$("#marine").addClass("hidden");
									$("#marine_remove").addClass("hidden");
									$(".fire_div").removeClass("hidden");
									$(".fire_div").removeClass("hidden");
								} else if (smepolicy == 77) {
									$("#marine").addClass("hidden");
									$("#marine_remove").addClass("hidden");
									$(".fire_div").addClass("hidden");
									$(".fire_div").addClass("hidden");
									$(".wc_div").removeClass("hidden");
								} else if (smepolicy == "75") {
									$("#marine").addClass("hidden");
									$("#marine_remove").addClass("hidden");
									$(".fire_div").addClass("hidden");
									$(".fire_div").addClass("hidden");
									$(".wc_div").addClass("hidden");
									$(".gmc_div").removeClass("hidden");
								} else if (smepolicy == 5) {
									$("#marine").addClass("hidden");
									$("#marine_remove").addClass("hidden");
									$("#marine_Details_remove").addClass("hidden");
									$("#marine_Details").addClass("hidden");
									$("#sum_insured_lacs").addClass("hidden");
									$("#sum_insured_rs").addClass("hidden");
									$("#employee_policy").removeClass("hidden");
									$("#employee_policy_month").removeClass("hidden");
									$("#building_property").addClass("hidden");
									$("#building_property_floors").addClass("hidden");
								} else if (smepolicy == 6) {
									$("#marine").addClass("hidden");
									$("#marine_remove").addClass("hidden");
									$("#marine_Details_remove").addClass("hidden");
									$("#marine_Details").addClass("hidden");
									$("#sum_insured_lacs").addClass("hidden");
									$("#sum_insured_rs").addClass("hidden");
									$("#employee_policy").addClass("hidden");
									$("#employee_policy_month").addClass("hidden");
									$("#building_property").removeClass("hidden");
									$("#building_property_floors").removeClass("hidden");
								}
							});

							$("#add_sme_info").click(function () {
								var lead_id = $("#last_inserted_id").val();
								var smepolicy = $("#sme_id").val();

								// Fire
								var ins_period_from = $("#from_date").val();
								var ins_period_todate = $("#to_date").val();
								var occupancy = $("#occupancy").val();
								var commodity = $("#commodity_interest").val();
								var transport = $("#transport").val();
								var b_valuation_import = $("#b_valuation_import").val();
								var b_valuation_export = $("#b_valuation_export").val();
								var b_valuation_inland = $("#b_valuation_inland").val();
								var packing = $("#packing").val();
								var voyage_export = $("#voyage_export").val();
								var voyage_import = $("#voyage_import").val();
								var voyage_inland = $("#voyage_inland").val();
								var turnover = $("#add_turnover").val();
								var initial_sum_insured = $("#initial_sum_insured").val();
								var sales_domestic = $("#add_domestic").val();
								var purchase_import = $("#add_import").val();
								var purchase_domestic = $("#purchase_domestic").val();
								var bottomlimit = $("#bottom_inland_limit").val();
								var locationimport = $("#location_inland").val();
								var bottom_import_limit = $("#bottom_import_limit").val();
								var location_import_limit = $("#location_import_limit").val();
								var currentinsurer = $("#current_insurer").val();
								var claim_history = $("#claim_history").val();
								var date = $("#date").val();
								var packing = $("#packing").val();
								var voyage_export = $("#voyage_export").val();
								var voyage_import = $("#voyage_import").val();
								var voyage_inland = $("#voyage_inland").val();
								var turnover = $("#add_turnover").val();
								var initial_sum_insured = $("#initial_sum_insured").val();

								// Fire
								var fire_from_date = $("#fire_from_date").val();
								var fire_to_date = $("#fire_to_date").val();
								var fire_occupancy = $("#fire_occupancy").val();
								var commodity = $("#commodity_interest").val();
								var financial_institution = $("#financial_institution").val();
								var fire_particulars_1 = $("#fire_particulars_1").val();
								var fire_sum_ins_1 = $("#fire_sum_ins_1").val();
								var burglary_sum_ins_1 = $("#burglary_sum_ins_1").val();
								var fire_particulars_2 = $("#fire_particulars_2").val();
								var fire_sum_ins_2 = $("#fire_sum_ins_2").val();
								var burglary_sum_ins_2 = $("#burglary_sum_ins_2").val();
								var fire_particulars_3 = $("#fire_particulars_3").val();
								var fire_sum_ins_3 = $("#fire_sum_ins_3").val();
								var burglary_sum_ins_3 = $("#burglary_sum_ins_3").val();
								var fire_particulars_4 = $("#fire_particulars_4").val();
								var fire_sum_ins_4 = $("#fire_sum_ins_4").val();
								var burglary_sum_ins_4 = $("#burglary_sum_ins_4").val();
								var clause_under_burglary = $("#clause_under_burglary").val();
								var fire_expiry_insurer = $("#fire_expiry_insurer").val();
								var fire_date = $("#fire_date").val();

								// workman compension

								var pre_no_of_emp = $("#pre_no_of_emp").val();
								var cur_no_of_emp = $("#cur_no_of_emp").val();
								var wc_claim_paid = $("#wc_claim_paid").val();
								var pre_no_of_emp = $("#pre_no_of_emp").val();
								var wc_tot_claim = $("#wc_tot_claim").val();
								var wc_premium_paid = $("#wc_premium_paid").val();
								var wc_out_claim = $("#wc_out_claim").val();
								var wc_last_claim = $("#wc_last_claim").val();
								var wc_wages_per_mon = $("#wc_wages_per_mon").val();
								var wc_no_supervisor = $("#wc_no_supervisor").val();
								var wc_no_site_engineer = $("#wc_no_site_engineer").val();
								var wc_salary_per_supervisor = $(
									"#wc_salary_per_supervisor"
								).val();
								var wc_salary_engineer = $("#wc_salary_engineer").val();

								var coveringclauses = [];
								var formdata = new FormData();

								$(".coveringclauses").each(function () {
									formdata.append("coveringclauses[]", this.value);
								});

								// GMC

								var gmc_current_status = $("#gmc_current_status").val();
								var gmc_cur_ins = $("#gmc_cur_ins").val();
								var gmc_premium_date = $("#gmc_premium_date").val();
								var gmc_renewal_tot = $("#gmc_renewal_tot").val();
								var gmc_period_of_ins = $("#gmc_period_of_ins").val();
								var gmc_premium_inscep = $("#gmc_premium_inscep").val();
								var gmc_total_lives = $("#gmc_total_lives").val();
								var gmc_incurred_claims = $("#gmc_incurred_claims").val();
								var gmc_sum_ins_app = $("#gmc_sum_ins_app").val();
								var gmc_family_def = $("#gmc_family_def").val();
								var gmc_exclusion_waiver_year = $(
									"#gmc_exclusion_waiver_year"
								).val();
								var gmc_maternity_coverage = $("#gmc_maternity_coverage").val();
								var gmc_hospital_coverage = $("#gmc_hospital_coverage").val();
								var gmc_icu_limits = $("#gmc_icu_limits").val();
								var gmc_int_desease_cover = $("#gmc_int_desease_cover").val();
								var gmc_ppn_cause = $("#gmc_ppn_cause").val();
								var gmc_claim_sub_mission = $("#gmc_claim_sub_mission").val();
								var gmc_lasik_surgery = $("#gmc_lasik_surgery").val();
								var gmc_corporate_buffer = $("#gmc_corporate_buffer").val();
								var gmc_cataract_surgery = $("#gmc_cataract_surgery").val();
								var gmc_comorbities = $("#gmc_comorbities").val();
								var gmc_metail_illness = $("#gmc_metail_illness").val();
								var gmc_addition = $("#gmc_addition").val();
								var gmc_current_status = $("#gmc_current_status").val();
								var gmc_covid_hospitlization = $(
									"#gmc_covid_hospitlization"
								).val();
								var gmc_day_care = $("#gmc_day_care").val();
								var gmc_sum_ins = $("#gmc_sum_ins").val();
								var gmc_policy_type = $("#gmc_policy_type").val();
								var gmc_exclusion_wavier = $("#gmc_exclusion_wavier").val();
								var gmc_child_day_cover = $("#gmc_child_day_cover").val();
								var gmc_room_rent = $("#gmc_room_rent").val();
								var gmc_sub_limits = $("#gmc_sub_limits").val();
								var gmc_ext_desease_cover = $("#gmc_ext_desease_cover").val();
								var gmc_claim_int = $("#gmc_claim_int").val();
								var gmc_int_capping = $("#gmc_int_capping").val();
								var gmc_ayush_treatment = $("#gmc_ayush_treatment").val();
								var gmc_robotic = $("#gmc_robotic").val();
								var gmc_ambulance = $("#gmc_ambulance").val();
								var gmc_sinus_surgery = $("#gmc_sinus_surgery").val();
								var gmc_age_macular = $("#gmc_age_macular").val();
								var gmc_terroism_deases = $("#gmc_terroism_deases").val();
								var gmc_special_coverage = $("#gmc_special_coverage").val();

								formdata.append("lead_id", lead_id);
								formdata.append("smepolicy", smepolicy);

								if (smepolicy == "74") {
									formdata.append("ins_period_from", ins_period_from);
									formdata.append("ins_period_todate", ins_period_todate);
									formdata.append("occupancy", occupancy);
									formdata.append("commodity", commodity);
									formdata.append("transport", transport);
									formdata.append("packing", packing);
									formdata.append("b_valuation_import", b_valuation_import);
									formdata.append("b_valuation_export", b_valuation_export);
									formdata.append("b_valuation_inland", b_valuation_inland);
									formdata.append("voyage_export", voyage_export);
									formdata.append("voyage_import", voyage_import);
									formdata.append("voyage_inland", voyage_inland);
									formdata.append("turnover", turnover);
									formdata.append("initial_sum_insured", initial_sum_insured);
									formdata.append("sales_domestic", sales_domestic);
									formdata.append("purchase_import", purchase_import);
									formdata.append("purchase_domestic", purchase_domestic);
									formdata.append("bottomlimit", bottomlimit);
									formdata.append("locationimport", locationimport);
									formdata.append("bottom_import_limit", bottom_import_limit);
									formdata.append(
										"location_import_limit",
										location_import_limit
									);
									formdata.append("current_insurer", current_insurer);
									formdata.append("claim_history", claim_history);
									formdata.append("date", date);
								} else if (smepolicy == "78") {
									formdata.append("fire_from_date", fire_from_date);
									formdata.append("fire_to_date", fire_to_date);
									formdata.append("fire_occupancy", fire_occupancy);
									formdata.append(
										"financial_institution",
										financial_institution
									);
									formdata.append("fire_particulars_1", fire_particulars_1);
									formdata.append("fire_sum_ins_1", fire_sum_ins_1);
									formdata.append("burglary_sum_ins_1", burglary_sum_ins_1);
									formdata.append("fire_particulars_2", fire_particulars_2);
									formdata.append("fire_sum_ins_2", fire_sum_ins_2);
									formdata.append("burglary_sum_ins_2", burglary_sum_ins_2);
									formdata.append("fire_particulars_3", fire_particulars_3);
									formdata.append("fire_sum_ins_3", fire_sum_ins_3);
									formdata.append("burglary_sum_ins_3", burglary_sum_ins_3);
									formdata.append("fire_particulars_4", fire_particulars_4);
									formdata.append("fire_sum_ins_4", fire_sum_ins_4);
									formdata.append("burglary_sum_ins_4", burglary_sum_ins_4);
									formdata.append(
										"clause_under_burglary",
										clause_under_burglary
									);
									formdata.append("fire_expiry_insurer", fire_expiry_insurer);
									formdata.append("fire_date", fire_date);
								} else if (smepolicy == "77") {
									formdata.append("pre_no_of_emp", pre_no_of_emp);
									formdata.append("cur_no_of_emp", cur_no_of_emp);
									formdata.append("wc_claim_paid", wc_claim_paid);
									formdata.append("pre_no_of_emp", pre_no_of_emp);
									formdata.append("wc_tot_claim", wc_tot_claim);
									formdata.append("wc_premium_paid", wc_premium_paid);
									formdata.append("wc_out_claim", wc_out_claim);
									formdata.append("wc_last_claim", wc_last_claim);
									formdata.append("wc_wages_per_mon", wc_wages_per_mon);
									formdata.append("wc_no_supervisor", wc_no_supervisor);
									formdata.append("wc_no_site_engineer", wc_no_site_engineer);
									formdata.append(
										"wc_salary_per_supervisor",
										wc_salary_per_supervisor
									);

									formdata.append("wc_salary_engineer", wc_salary_engineer);
								} else if (smepolicy == "75") {
									formdata.append("gmc_current_status", gmc_current_status);
									formdata.append("gmc_cur_ins", gmc_cur_ins);
									formdata.append("gmc_premium_date", gmc_premium_date);
									formdata.append("gmc_renewal_tot", gmc_renewal_tot);
									formdata.append("gmc_period_of_ins", gmc_period_of_ins);
									formdata.append("gmc_premium_inscep", gmc_premium_inscep);
									formdata.append("gmc_total_lives", gmc_total_lives);
									formdata.append("gmc_incurred_claims", gmc_incurred_claims);
									formdata.append("gmc_sum_ins_app", gmc_sum_ins_app);
									formdata.append("gmc_family_def", gmc_family_def);
									formdata.append(
										"gmc_exclusion_waiver_year",
										gmc_exclusion_waiver_year
									);
									formdata.append(
										"gmc_maternity_coverage",
										gmc_maternity_coverage
									);
									formdata.append(
										"gmc_hospital_coverage",
										gmc_hospital_coverage
									);
									formdata.append("gmc_icu_limits", gmc_icu_limits);
									formdata.append(
										"gmc_int_desease_cover",
										gmc_int_desease_cover
									);
									formdata.append("gmc_ppn_cause", gmc_ppn_cause);
									formdata.append(
										"gmc_claim_sub_mission",
										gmc_claim_sub_mission
									);
									formdata.append("gmc_lasik_surgery", gmc_lasik_surgery);
									formdata.append("gmc_corporate_buffer", gmc_corporate_buffer);
									formdata.append("gmc_cataract_surgery", gmc_cataract_surgery);
									formdata.append("gmc_comorbities", gmc_comorbities);
									formdata.append("gmc_metail_illness", gmc_metail_illness);
									formdata.append("gmc_addition", gmc_addition);
									formdata.append("gmc_current_status", gmc_current_status);
									formdata.append(
										"gmc_covid_hospitlization",
										gmc_covid_hospitlization
									);
									formdata.append("gmc_day_care", gmc_day_care);
									formdata.append("gmc_sum_ins", gmc_sum_ins);
									formdata.append("gmc_policy_type", gmc_policy_type);
									formdata.append("gmc_exclusion_wavier", gmc_exclusion_wavier);
									formdata.append("gmc_child_day_cover", gmc_child_day_cover);
									formdata.append("gmc_room_rent", gmc_room_rent);
									formdata.append("gmc_sub_limits", gmc_sub_limits);
									formdata.append(
										"gmc_ext_desease_cover",
										gmc_ext_desease_cover
									);
									formdata.append("gmc_claim_int", gmc_claim_int);
									formdata.append("gmc_int_capping", gmc_int_capping);
									formdata.append("gmc_ayush_treatment", gmc_ayush_treatment);
									formdata.append("gmc_robotic", gmc_robotic);
									formdata.append("gmc_ambulance", gmc_ambulance);
									formdata.append("gmc_sinus_surgery", gmc_sinus_surgery);
									formdata.append("gmc_age_macular", gmc_age_macular);
									formdata.append("gmc_terroism_deases", gmc_terroism_deases);
									formdata.append("gmc_special_coverage", gmc_special_coverage);
								}

								$.ajax({
									url: "save_sme_details",
									data: formdata,
									method: "POST",
									processData: false,
									contentType: false,
									cache: false,
									dataType: "text",
									beforeSend: function () {
										$("#add_sme_info").attr("disabled", true);
									},
									success: function (response) {
										$(".form_control").val("");
										$("#add_sme_info").attr("disabled", false);
										$("#sme_modal").modal("toggle");
										Swal.fire({
											position: "top-end",
											icon: "success",
											title: "SME Details Has Been Saved Successfully",
											showConfirmButton: false,
											timer: 1500,
										});
										location.reload();
									},
									error: function (code) {
										alert(code.statusText);
									},
								});
							});

							$("#sme_file_add").click(function () {
								var content = "";
								content += '<div class = "row">';
								content += '      <div class = "col-md-6">';
								content += '          <div class = "form-group">';
								content += "              <label>File</label>";
								content +=
									'              <input type = "file" class="form-control sme_file" name="files[]" required>';
								content += "          </div>";
								content += "      </div>";

								content += '       <div class = "col-md-6">';
								content += '          <div class = "form-group">';
								content += "              <label>File Name</label>";
								content +=
									'              <input type = "text" class="form-control sme_file_type" name="file_name[]" required>';
								content += "          </div>";
								content += "      </div>";
								content += "  </div>";

								$("#view_files").append(content);
							});

							$("#sme_file_remove").click(function () {
								$("#view_files").children().last().remove();
							});

                            $("#sme_file_upload").click(function () {
								var lead_id = $("#last_inserted_id").val();
								var formdata = new FormData();
								var ins = 0;

								$(".sme_file_type").each(function () {
									ins = ins + 1;
									formdata.append("file_types[]", $(this).val());
								});

								for (var x = 0; x < ins; x++) {
									formdata.append("files[]", $(".sme_file").prop("files")[x]);
								}

								formdata.append("lead_id", lead_id);
								$.ajax({
									url: "upload_sme_files",
									data: formdata,
									method: "POST",
									processData: false,
									contentType: false,
									cache: false,
									dataType: "text",
									beforeSend: function () {
										$("#sme_file_upload").attr("disabled", true);
									},
									success: function (response) {
										$("#sme_file_upload").attr("disabled", false);
										Swal.fire({
											position: "top-end",
											icon: "success",
											title: "SME Files Has Been Uploaded Successfully",
											showConfirmButton: false,
											timer: 1500,
										});
										//location.reload();
									},
								});
							});

                            // 🔹 Auto convert Regn No fields to uppercase on change or typing
                            $("#regn_no_1, #regn_no_2, #regn_no_3, #regn_no_4").on("input change", function () {
                                this.value = this.value.toUpperCase();
                            });

                            $(document).on("click", ".remove-field", function () {
                                $(this).closest(".custom-field-row").remove();
                            });

						});

						function daughters() {
							var no_daughters = $("#num_daughters").val();
							childrens = childrens + 1;

							if (parseInt(childrens) <= 3) {
								no_daughters = parseInt(no_daughters) + parseInt(1);
								$("#num_daughters").val(no_daughters);

								if (parseInt(no_daughters) == 4) {
									$("#daughter_div1").removeClass("hidden");
									$("#daughter_div2").removeClass("hidden");
									$("#daughter_div3").removeClass("hidden");
									$("#daughter_div4").removeClass("hidden");
								} else if (parseInt(no_daughters) == 3) {
									$("#daughter_div1").removeClass("hidden");
									$("#daughter_div2").removeClass("hidden");
									$("#daughter_div3").removeClass("hidden");
									$("#daughter_div4").addClass("hidden");
								} else if (parseInt(no_daughters) == 2) {
									$("#daughter_div1").removeClass("hidden");
									$("#daughter_div2").removeClass("hidden");
									$("#daughter_div3").addClass("hidden");
									$("#daughter_div4").addClass("hidden");
								} else if (parseInt(no_daughters) == 1) {
									$("#daughter_div1").removeClass("hidden");
									$("#daughter_div2").addClass("hidden");
									$("#daughter_div3").addClass("hidden");
									$("#daughter_div4").addClass("hidden");
								} else if (parseInt(no_daughters) > 4) {
									Swal.fire(
										"Maximum Number Of Daughter Count Is 4 , You can't Give More Than 4"
									);
									$("#num_daughters").val("1");
									$("#daughter_div2").addClass("hidden");
									$("#daughter_div3").addClass("hidden");
									$("#daughter_div4").addClass("hidden");
								}
							} else {
								Swal.fire({
									icon: "error",
									title: "Oops...",
									text: "You Can't Add More than Three Childrens!",
									footer: "",
								});
							}
						}

						function daughters_minus() {
							var no_daughters = $("#num_daughters").val();
							childrens = childrens - 1;

							if (parseInt(childrens) <= 3) {
								no_daughters = parseInt(no_daughters) - parseInt(1);
								$("#num_daughters").val(no_daughters);

								if (parseInt(no_daughters) == 4) {
									$("#daughter_div1").removeClass("hidden");
									$("#daughter_div2").removeClass("hidden");
									$("#daughter_div3").removeClass("hidden");
									$("#daughter_div4").removeClass("hidden");
								} else if (parseInt(no_daughters) == 3) {
									$("#daughter_div1").removeClass("hidden");
									$("#daughter_div2").removeClass("hidden");
									$("#daughter_div3").removeClass("hidden");
									$("#daughter_div4").addClass("hidden");
								} else if (parseInt(no_daughters) == 2) {
									$("#daughter_div1").removeClass("hidden");
									$("#daughter_div2").removeClass("hidden");
									$("#daughter_div3").addClass("hidden");
									$("#daughter_div4").addClass("hidden");
								} else if (parseInt(no_daughters) == 1) {
									$("#daughter_div1").removeClass("hidden");
									$("#daughter_div2").addClass("hidden");
									$("#daughter_div3").addClass("hidden");
									$("#daughter_div4").addClass("hidden");
								} else if (parseInt(no_daughters) == 0) {
									$("#daughter_div1").addClass("hidden");
									$("#daughter_div2").addClass("hidden");
									$("#daughter_div3").addClass("hidden");
									$("#daughter_div4").addClass("hidden");

									var h_family_members = $("#h_family_members").val();
									var remove_Item = "Daughter";

									h_family_members = $.grep(h_family_members, function (value) {
										return value != remove_Item;
									});
									$("#h_family_members").val(h_family_members);
									$("#h_family_members").trigger("change");
								} else if (parseInt(no_daughters) > 4) {
									Swal.fire(
										"Maximum Number Of Daughter Count Is 4 , You can't Give More Than 4"
									);
									$("#num_daughters").val("1");
									$("#daughter_div2").addClass("hidden");
									$("#daughter_div3").addClass("hidden");
									$("#daughter_div4").addClass("hidden");
								}
							} else {
								Swal.fire({
									icon: "error",
									title: "Oops...",
									text: "You Can't Add More than Three Childrens!",
									footer: "",
								});
							}
						}

						function son_minus() {
							var no_sons = $("#num_sons").val();
							childrens = childrens - 1;
							var content = "";

							if (parseInt(childrens) <= 3) {
								no_sons = parseInt(no_sons) - parseInt(1);
								$("#num_sons").val(no_sons);

								if (parseInt(no_sons) == 4) {
									$("#son_div1").removeClass("hidden");
									$("#son_div2").removeClass("hidden");
									$("#son_div3").removeClass("hidden");
									$("#son_div4").removeClass("hidden");
								} else if (parseInt(no_sons) == 3) {
									$("#son_div1").removeClass("hidden");
									$("#son_div2").removeClass("hidden");
									$("#son_div3").removeClass("hidden");
									$("#son_div4").addClass("hidden");
								} else if (parseInt(no_sons) == 2) {
									$("#son_div1").removeClass("hidden");
									$("#son_div2").removeClass("hidden");
									$("#son_div3").addClass("hidden");
									$("#son_div4").addClass("hidden");
								} else if (parseInt(no_sons) == 1) {
									$("#son_div1").removeClass("hidden");
									$("#son_div2").addClass("hidden");
									$("#son_div3").addClass("hidden");
									$("#son_div4").addClass("hidden");
								} else if (parseInt(no_sons) == 0) {
									$("#son_div1").addClass("hidden");
									$("#son_div2").addClass("hidden");
									$("#son_div3").addClass("hidden");
									$("#son_div4").addClass("hidden");

									var h_family_members = $("#h_family_members").val();
									var remove_Item = "Son";

									h_family_members = $.grep(h_family_members, function (value) {
										return value != remove_Item;
									});
									$("#h_family_members").val(h_family_members);
									$("#h_family_members").trigger("change");
								} else if (parseInt(no_sons) > 4) {
									Swal.fire(
										"Maximum Number Of Son Count Is 4 , You can't Give More Than 4"
									);
									$("#num_sons").val("1");
									$("#son_div2").addClass("hidden");
									$("#son_div3").addClass("hidden");
									$("#son_div4").addClass("hidden");
								}
							} else {
								Swal.fire({
									icon: "error",
									title: "Oops...",
									text: "You Can't Add More than Three Childrens!",
									footer: "",
								});
							}
						}

						function sons() {
							var no_sons = $("#num_sons").val();
							childrens = childrens + 1;
							var content = "";

							if (parseInt(childrens) <= 3) {
								no_sons = parseInt(no_sons) + parseInt(1);
								$("#num_sons").val(no_sons);

								if (parseInt(no_sons) == 4) {
									$("#son_div1").removeClass("hidden");
									$("#son_div2").removeClass("hidden");
									$("#son_div3").removeClass("hidden");
									$("#son_div4").removeClass("hidden");
								} else if (parseInt(no_sons) == 3) {
									$("#son_div1").removeClass("hidden");
									$("#son_div2").removeClass("hidden");
									$("#son_div3").removeClass("hidden");
									$("#son_div4").addClass("hidden");
								} else if (parseInt(no_sons) == 2) {
									$("#son_div1").removeClass("hidden");
									$("#son_div2").removeClass("hidden");
									$("#son_div3").addClass("hidden");
									$("#son_div4").addClass("hidden");
								} else if (parseInt(no_sons) == 1) {
									$("#son_div1").removeClass("hidden");
									$("#son_div2").addClass("hidden");
									$("#son_div3").addClass("hidden");
									$("#son_div4").addClass("hidden");
								} else if (parseInt(no_sons) > 4) {
									Swal.fire(
										"Maximum Number Of Son Count Is 4 , You can't Give More Than 4"
									);
									$("#num_sons").val("1");
									$("#son_div2").addClass("hidden");
									$("#son_div3").addClass("hidden");
									$("#son_div4").addClass("hidden");
								}
							} else {
								Swal.fire({
									icon: "error",
									title: "Oops...",
									text: "You Can't Add More than Three Childrens!",
									footer: "",
								});
							}
						}

						function edit_vechi_data(id) {
							$.ajax({
								url: "get_vechicle_uploaded_file_by_id",
								method: "POST",
								data: { id: id },
								success: function (response) {
									var obj = jQuery.parseJSON(response);
									$("#edit_doc_id").val(obj.id);
									$("#edit_document_type").val(obj.document_type);
									$("#edit_doc_mod").modal("toggle");
								},
							});
						}

						function delete_vechi_data(id) {
							if (confirm("Are you Confirm to Delete")) {
								$.ajax({
									url: "delete_vechicle_documents",
									data: { id: id },
									method: "POST",
									success: function (response) {
										$("#edit_table_view").html(response);
										Swal.fire(
											"Deleted!",
											"The Document Has been Deleted successfully!",
											"success"
										);
									},
									error: function (code) {
										alert(code.statusText);
									},
								});
							}
						}

						function notification_log(id) {
							$.ajax({
								url: "get_recent_activities",
								method: "POST",
								data: { lead_id: id },
								success: function (response) {
									$("#recent_activity_div").html(response);
								},
							});
						}

						function get_all_quotes(id) {
							$.ajax({
								url: "get_all_quotes",
								method: "POST",
								data: { lead_id: id },
								success: function (response) {
									$("#quotes_view").html(response);
								},
							});
						}

						function pet_female_to_male() {
							pet_gender = "male";
							$("#pet_male_btn").addClass("change_pet_gender");
							$("#pet_female_btn").removeClass("change_pet_gender");
						}

						function pet_male_to_female() {
							pet_gender = "female";
							$("#pet_male_btn").removeClass("change_pet_gender");
							$("#pet_female_btn").addClass("change_pet_gender");
						}

						// Property //

						function home_to_house_society() {
							house_type = "Home";
							$("#housing_society_btn").addClass("change_house_type");
							$("#home_btn").removeClass("change_house_type");
						}

						function house_society_to_home() {
							house_type = "Housing Society";
							$("#housing_society_btn").removeClass("change_house_type");
							$("#home_btn").addClass("change_house_type");
						}

						function owner_to_tenant() {
							owner_type = "Tenant";
							$("#tenant_btn").addClass("change_owner");
							$("#owner_btn").removeClass("change_owner");
						}

						function tenant_to_owner() {
							owner_type = "Owner";
							$("#tenant_btn").removeClass("change_owner");
							$("#owner_btn").addClass("change_owner");
						}

						//Business
						function business_owner_to_tenant() {
							business_owner_type = "Tenant";
							$("#business_tenant_btn").addClass("business_change_owner");
							$("#business_owner_btn").removeClass("business_change_owner");
						}

						function business_tenant_to_owner() {
							business_owner_type = "Owner";
							$("#business_tenant_btn").removeClass("business_change_owner");
							$("#business_owner_btn").addClass("business_change_owner");
						}

						// maraine //

						function marine_calculate() {
							var marine_invoice = $("#marine_invoice_val").val();
							if (marine_invoice != "") {
								var ten_per = (marine_invoice * 10) / 100;
								var total = parseFloat(marine_invoice) + parseFloat(ten_per);
								$("#marine_invoice_10per_val").val(total);
							} else {
								$("#marine_invoice_10per_val").val("");
							}
						}

						// update

						function fetch_make(vechile_type) {
							var vechile_type = $("#vechile_type").val();
							$.ajax({
								url: "fetch_make",
								method: "POST",
								data: { vechile_type: vechile_type },
								beforeSend: function () {
									$("#vechi_make").prop("disabled", true);
								},
								success: function (response) {
									var obj = jQuery.parseJSON(response);

									var str = "<option value=''>--Select--</option>";
									for (var j = 0; j < obj.length; j++) {
										str +=
											"<option value='" +
											obj[j].id +
											"'>" +
											obj[j].brand_name +
											"</option>";
									}
									$("#vechi_make").html(str);
									$("#vechi_make").prop("disabled", false);
								},
							});
						}

						function fetch_pcv_seating(vechile_type) {
							$.ajax({
								url: "fetch_pcv_seating_capacity",
								method: "POST",
								data: { policy_type: vechile_type },
								success: function (response) {
									$("#passenger_carrying").html(response);
								},
							});
						}

						function check_vehi_regn_no() {
							var regn_no_1 = $("#regn_no_1").val();
							var regn_no_2 = $("#regn_no_2").val();
							var regn_no_3 = $("#regn_no_3").val();
							var regn_no_4 = $("#regn_no_4").val();

							var regn_no =
								regn_no_1 + "-" + regn_no_2 + "-" + regn_no_3 + "-" + regn_no_4;

							if (
								regn_no_1 != "" &&
								regn_no_2 != "" &&
								regn_no_3 != "" &&
								regn_no_4 != "" &&
								regn_no_4.length == "4"
							) {
								$.ajax({
									url: "check_vehi_regn_no",
									method: "POST",
									data: { regn_no: regn_no },
									success: function (response) {
										if (response == "Exits") {
											snackbar_show("Regn No Already Exits");
											$("#regn_no_span").html("Regn No Already Exits");
											$("#add_vechile_btn").attr("disabled", true);
										} else {
											$("#regn_no_span").html("");
											$("#add_vechile_btn").attr("disabled", false);
										}
									},
								});
							}
						}

						function edit_daughters() {
							var no_daughters = $("#edit_num_daughters").val();
							var no_sons = $("#edit_num_sons").val();
							childrens = parseInt(no_daughters) + parseInt(no_sons);

							if (parseInt(childrens) <= 3) {
								no_daughters = parseInt(no_daughters) + parseInt(1);
								$("#edit_num_daughters").val(no_daughters);

								if (parseInt(no_daughters) == 4) {
									$("#edit_daughter_div1").removeClass("hidden");
									$("#edit_daughter_div2").removeClass("hidden");
									$("#edit_daughter_div3").removeClass("hidden");
									$("#edit_daughter_div4").removeClass("hidden");
								} else if (parseInt(no_daughters) == 3) {
									$("#edit_daughter_div1").removeClass("hidden");
									$("#edit_daughter_div2").removeClass("hidden");
									$("#edit_daughter_div3").removeClass("hidden");
									$("#edit_daughter_div4").addClass("hidden");
								} else if (parseInt(no_daughters) == 2) {
									$("#edit_daughter_div1").removeClass("hidden");
									$("#edit_daughter_div2").removeClass("hidden");
									$("#edit_daughter_div3").addClass("hidden");
									$("#edit_daughter_div4").addClass("hidden");
								} else if (parseInt(no_daughters) == 1) {
									$("#edit_daughter_div1").removeClass("hidden");
									$("#edit_daughter_div2").addClass("hidden");
									$("#edit_daughter_div3").addClass("hidden");
									$("#edit_daughter_div4").addClass("hidden");
								} else if (parseInt(no_daughters) > 4) {
									Swal.fire(
										"Maximum Number Of Daughter Count Is 4 , You can't Give More Than 4"
									);
									$("#edit_num_daughters").val("1");
									$("#edit_daughter_div2").addClass("hidden");
									$("#edit_daughter_div3").addClass("hidden");
									$("#edit_daughter_div4").addClass("hidden");
								}
							} else {
								Swal.fire({
									icon: "error",
									title: "Oops...",
									text: "You Can't Add More than Three Childrens!",
									footer: "",
								});
							}
						}

						function edit_daughters_minus() {
							var no_daughters = $("#edit_num_daughters").val();

							if (parseInt(childrens) <= 3) {
								no_daughters = parseInt(no_daughters) - parseInt(1);
								$("#edit_num_daughters").val(no_daughters);

								if (parseInt(no_daughters) == 4) {
									$("#edit_daughter_div1").removeClass("hidden");
									$("#edit_daughter_div2").removeClass("hidden");
									$("#edit_daughter_div3").removeClass("hidden");
									$("#edit_daughter_div4").removeClass("hidden");
								} else if (parseInt(no_daughters) == 3) {
									$("#edit_daughter_div1").removeClass("hidden");
									$("#edit_daughter_div2").removeClass("hidden");
									$("#edit_daughter_div3").removeClass("hidden");
									$("#edit_daughter_div4").addClass("hidden");
								} else if (parseInt(no_daughters) == 2) {
									$("#edit_daughter_div1").removeClass("hidden");
									$("#edit_daughter_div2").removeClass("hidden");
									$("#edit_daughter_div3").addClass("hidden");
									$("#edit_daughter_div4").addClass("hidden");
								} else if (parseInt(no_daughters) == 1) {
									$("#edit_daughter_div1").removeClass("hidden");
									$("#edit_daughter_div2").addClass("hidden");
									$("#edit_daughter_div3").addClass("hidden");
									$("#edit_daughter_div4").addClass("hidden");
								} else if (parseInt(no_daughters) == 0) {
									$("#edit_daughter_div1").addClass("hidden");
									$("#edit_daughter_div2").addClass("hidden");
									$("#edit_daughter_div3").addClass("hidden");
									$("#edit_daughter_div4").addClass("hidden");

									var h_family_members = $("#edit_h_family_members").val();
									var remove_Item = "Daughter";

									h_family_members = $.grep(h_family_members, function (value) {
										return value != remove_Item;
									});
									var sons_count = $("#edit_num_sons").val();
									$("#edit_h_family_members").val(h_family_members);
									$("#edit_h_family_members").trigger("change");
									$("#edit_num_sons").val(sons_count);
								} else if (parseInt(no_daughters) > 4) {
									Swal.fire(
										"Maximum Number Of Daughter Count Is 4 , You can't Give More Than 4"
									);
									$("#edit_num_daughters").val("1");
									$("#edit_daughter_div2").addClass("hidden");
									$("#edit_daughter_div3").addClass("hidden");
									$("#edit_daughter_div4").addClass("hidden");
								}
							} else {
								Swal.fire({
									icon: "error",
									title: "Oops...",
									text: "You Can't Add More than Three Childrens!",
									footer: "",
								});
							}
						}

						function edit_son_minus() {
							var no_sons = $("#edit_num_sons").val();
							childrens = childrens - 1;
							var content = "";

							if (parseInt(childrens) <= 3) {
								no_sons = parseInt(no_sons) - parseInt(1);
								$("#edit_num_sons").val(no_sons);

								if (parseInt(no_sons) == 4) {
									$("#edit_son_div1").removeClass("hidden");
									$("#edit_son_div2").removeClass("hidden");
									$("#edit_son_div3").removeClass("hidden");
									$("#edit_son_div4").removeClass("hidden");
								} else if (parseInt(no_sons) == 3) {
									$("#edit_son_div1").removeClass("hidden");
									$("#edit_son_div2").removeClass("hidden");
									$("#edit_son_div3").removeClass("hidden");
									$("#edit_son_div4").addClass("hidden");
								} else if (parseInt(no_sons) == 2) {
									$("#edit_son_div1").removeClass("hidden");
									$("#edit_son_div2").removeClass("hidden");
									$("#edit_son_div3").addClass("hidden");
									$("#edit_son_div4").addClass("hidden");
								} else if (parseInt(no_sons) == 1) {
									$("#edit_son_div1").removeClass("hidden");
									$("#edit_son_div2").addClass("hidden");
									$("#edit_son_div3").addClass("hidden");
									$("#edit_son_div4").addClass("hidden");
								} else if (parseInt(no_sons) == 0) {
									$("#edit_son_div1").addClass("hidden");
									$("#edit_son_div2").addClass("hidden");
									$("#edit_son_div3").addClass("hidden");
									$("#edit_son_div4").addClass("hidden");

									var h_family_members = $("#edit_h_family_members").val();
									var remove_Item = "Son";

									h_family_members = $.grep(h_family_members, function (value) {
										return value != remove_Item;
									});
									var daughters_count = $("#edit_num_daughters").val();
									$("#edit_h_family_members").val(h_family_members);
									$("#edit_h_family_members").trigger("change");
									$("#edit_num_daughters").val(daughters_count);
								} else if (parseInt(no_sons) > 4) {
									Swal.fire(
										"Maximum Number Of Son Count Is 4 , You can't Give More Than 4"
									);
									$("#edit_num_sons").val("1");
									$("#edit_son_div2").addClass("hidden");
									$("#edit_son_div3").addClass("hidden");
									$("#edit_son_div4").addClass("hidden");
								}
							} else {
								Swal.fire({
									icon: "error",
									title: "Oops...",
									text: "You Can't Add More than Three Childrens!",
									footer: "",
								});
							}
						}

						function edit_sons() {
							var no_daughters = $("#edit_num_daughters").val();
							var no_sons = $("#edit_num_sons").val();
							childrens = parseInt(no_daughters) + parseInt(no_sons);
							var content = "";

							if (parseInt(childrens) <= 3) {
								no_sons = parseInt(no_sons) + parseInt(1);
								$("#edit_num_sons").val(no_sons);

								if (parseInt(no_sons) == 4) {
									$("#edit_son_div1").removeClass("hidden");
									$("#edit_son_div2").removeClass("hidden");
									$("#edit_son_div3").removeClass("hidden");
									$("#edit_son_div4").removeClass("hidden");
								} else if (parseInt(no_sons) == 3) {
									$("#edit_son_div1").removeClass("hidden");
									$("#edit_son_div2").removeClass("hidden");
									$("#edit_son_div3").removeClass("hidden");
									$("#edit_son_div4").addClass("hidden");
								} else if (parseInt(no_sons) == 2) {
									$("#edit_son_div1").removeClass("hidden");
									$("#edit_son_div2").removeClass("hidden");
									$("#edit_son_div3").addClass("hidden");
									$("#edit_son_div4").addClass("hidden");
								} else if (parseInt(no_sons) == 1) {
									$("#edit_son_div1").removeClass("hidden");
									$("#edit_son_div2").addClass("hidden");
									$("#edit_son_div3").addClass("hidden");
									$("#edit_son_div4").addClass("hidden");
								} else if (parseInt(no_sons) > 4) {
									Swal.fire(
										"Maximum Number Of Son Count Is 4 , You can't Give More Than 4"
									);
									$("#edit_num_sons").val("1");
									$("#edit_son_div2").addClass("hidden");
									$("#edit_son_div3").addClass("hidden");
									$("#edit_son_div4").addClass("hidden");
								}
							} else {
								Swal.fire({
									icon: "error",
									title: "Oops...",
									text: "You Can't Add More than Three Childrens!",
									footer: "",
								});
							}
						}

						function fetch_sme_policy(policy_type) {
							$.ajax({
								url: "fetch_sme_policy_details",
								method: "POST",
								beforeSend: function () {
									$("#sme_id").prop("disabled", true);
								},
								success: function (response) {
									var obj = jQuery.parseJSON(response);
									var str = "<option value=''>--Select--</option>";

									for (var j = 0; j < obj.length; j++) {
										if (policy_type == obj[j].id) {
											str +=
												"<option value='" +
												obj[j].id +
												"' selected>" +
												obj[j].policy_type +
												"</option>";
										} else {
											str +=
												"<option value='" +
												obj[j].id +
												"'>" +
												obj[j].policy_type +
												"</option>";
										}
									}
									$("#sme_id").html(str);
									$("#sme_id").prop("disabled", true);
									$("#sme_id").trigger("change");
								},
							});
						}

						function fetch_quote_files(lead_id) {
							$.ajax({
								url: "fetch_quote_files",
								method: "POST",
								data: { lead_id: lead_id },
								success: function (response) {
									$("#view_quotes").html(response);
								},
							});
						}

						// === Helper functions ===
						function prettifyFieldName(field) {
							switch (field) {
								case "doc_aadhar":
									return "Aadhar";
								case "doc_pan":
									return "PAN";
								case "doc_voter":
									return "Voter ID";
								case "doc_dl":
									return "Driving Licence";
								case "doc_govt":
									return "Govt ID";
								default:
									return "Document";
							}
						}

						function appendCustomField(label, value) {
							let html = `
                                    <div class="row mb-2 custom-field-row">
                                    <div class="col-md-5">
                                        <input type="text" class="form-control custom_label" value="${label}" readonly>
                                    </div>
                                    <div class="col-md-5">
                                        <input type="text" class="form-control custom_value" value="${value}" readonly>
                                    </div>
                                    </div>`;
							$("#custom_fields_container").append(html);
						}

						// ✅ Validate at least one document upload
						function validateDocuments() {
							const docs = [
								"#doc_aadhar",
								"#doc_pan",
								"#doc_voter",
								"#doc_dl",
								"#doc_govt",
							];
							const uploaded = docs.some((sel) => $(sel)[0].files.length > 0);
							if (!uploaded) {
								Swal.fire({
									icon: "warning",
									title: "Missing Document",
									text: "Please upload at least one identification document before saving.",
									confirmButtonColor: "#3085d6",
								});
								return false;
							}
							return true;
						}
					    
                        // ✅ New function to fetch seating capacity related to policy_type
                        function fetchSeatingCapacity(lead_id) {
                            $.ajax({
                                url: "get_seating_capacity",
                                method: "POST",
                                data: { lead_id: lead_id },
                                success: function (res) {
                                    var data = JSON.parse(res);

                                    if (data.length > 0) {
                                        // ✅ Set the first (or only) seating capacity value directly into the input
                                        $("#vechi_seating").val(data[0].seating_capacity);
                                    } else {
                                        $("#vechi_seating").val("");
                                    }
                                },
                                error: function (xhr, status, error) {
                                    console.error("Error fetching seating capacity:", error);
                                },
                            });
                        }
                        
						// Helper: copy values from client -> registration
						function copyClientToRegn(source) {
							// source: "comm" or "perm"
							var addr = "";
							if (source === "comm") {
								addr = $("#communication_address").val() || "";
							} else {
								addr = $("#permanent_address").val() || "";
							}

							// client-side fields (existing IDs in your client form)
							var district = $("#district").val() || "";
							var clientStateId = $("#state").val() || "";
							var clientStateName = $("#state option:selected").text().trim() || "";   
							var clientCountry = $("#country").val() || "India"; // client country input (original)
							var clientPin = $("#pin_code").val() || "";

							// Set into registration inputs (new IDs)
							$("#regn_address").val(addr);
							$("#regn_city").val(district);
							$("#regn_country").val(clientCountry);
							$("#regn_pincode").val(clientPin);
							$("#regn_state").val(clientStateId).trigger("change");
							// Also store the text (state name) in hidden field
							$("#regn_state_name").val(clientStateName);

						}

						// =============================
						// Auto-select RTO based on Regn No parts (1–4)
						// =============================
						function autoSelectRTO() {
							var part1 = $('#regn_no_1').val().toUpperCase().trim(); // e.g., TN
							var part2 = $('#regn_no_2').val().toUpperCase().trim(); // e.g., 45
							var part3 = $('#regn_no_3').val().toUpperCase().trim();
							var part4 = $('#regn_no_4').val().toUpperCase().trim();

							var prefix2 = part1 + part2;   // TN45
							var prefix3 = part1 + part2 + part3;
							var full = part1 + part2 + part3 + part4;

							let bestMatch = ""; // will store the best found RTO

							if (part1.length >= 2) {
								$('#rto option').each(function () {
									var rtoValue = $(this).val().toUpperCase();

									// Highest priority: TN45 -> then TN -> fallback none
									if (rtoValue.startsWith(prefix2)) {
										bestMatch = $(this).val();
										return false; // exact match found, stop immediately
									} 
									// else if (!bestMatch && rtoValue.startsWith(part1)) {
									// 	// store TN match, but keep looking in case we find TN45 later
									// 	bestMatch = $(this).val();
									// }
								});

								if (bestMatch) {
									$('#rto').val(bestMatch).trigger('change');
								} else {
									$('#rto').val('').trigger('change');
								}
							} else {
								$('#rto').val('').trigger('change');
							}
						}

						// Trigger on keyup or change for any of the 4 fields
						$('#regn_no_1, #regn_no_2, #regn_no_3, #regn_no_4').on('keyup change', autoSelectRTO);

						// ✅ Function to fetch Fuel Type based on Vehicle Type
						function fetchFuelType(vehicle_type_id) {
							$.ajax({
								url: "get_fuel_type_by_vehicle",
								method: "POST",
								data: { vehicle_type_id: vehicle_type_id },
								success: function (res) {
									var data = JSON.parse(res);
									var $fuelDropdown = $("#vechi_fuel_type");

									// ✅ Reset selection
									$fuelDropdown.val("");

									// ✅ If backend returns a matching fuel_type_id, just select it in the existing dropdown
									if (data.length > 0) {
										// Assuming your API returns one or more fuel types; we take the first match
										var matchedFuelId = data[0].id;

										// ✅ Set selected option (from the full list)
										$fuelDropdown.val(matchedFuelId).trigger("change");
									}
								},
								error: function (xhr, status, error) {
									console.error("Error fetching fuel type:", error);
								},
							});
						}


                    </script>

					<!-- JS SECTION -->
					<script>
						$(document).ready(function () {
							// ✅ Auto-copy address
							$("#same_address").change(function () {
								if ($(this).is(":checked")) {
								$("#permanent_address").val($("#communication_address").val());
								} else {
								$("#permanent_address").val("");
								}
							});

							// ✅ Auto-calculate AGE from DOB
							$("#dob").on("change", function () {
								const dob = $(this).val();
								if (dob) {
								const birthDate = new Date(dob);
								const today = new Date();
								let age = today.getFullYear() - birthDate.getFullYear();
								const monthDiff = today.getMonth() - birthDate.getMonth();
								if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birthDate.getDate())) {
									age--;
								}
								$("#age").val(age);
								} else {
								$("#age").val("");
								}
							});

							// ✅ Auto-set Due Date = Lead Generated Date + 1 year - 1 day
							$("#lead_generated_date").on("change", function () {
								const leadDate = $(this).val();
								if (leadDate) {
								const leadDateObj = new Date(leadDate);

								// Add 1 year
								leadDateObj.setFullYear(leadDateObj.getFullYear() + 1);

								// Subtract 1 day
								leadDateObj.setTime(leadDateObj.getTime() - 86400000);

								// Format to yyyy-mm-dd
								const yyyy = leadDateObj.getFullYear();
								const mm = String(leadDateObj.getMonth() + 1).padStart(2, "0");
								const dd = String(leadDateObj.getDate()).padStart(2, "0");

								$("#due_date").val(`${yyyy}-${mm}-${dd}`);
								} else {
								$("#due_date").val("");
								}
							});

							// ✅ Add custom fields dynamically (Client Details)
							let customFieldCount = 0;
							$("#add_custom_field").click(function () {
								customFieldCount++;
								let html = `
								<div class="row mb-2" id="custom_field_${customFieldCount}">
									<div class="col-md-5">
									<input type="text" class="form-control custom_label" name="custom_label[]" placeholder="Enter Label">
									</div>
									<div class="col-md-5">
									<input type="text" class="form-control custom_value" name="custom_value[]" placeholder="Enter Value">
									</div>
									<div class="col-md-2">
									<button type="button" class="btn btn-danger btn-sm remove_custom_field" data-id="${customFieldCount}">
										<i class="fa fa-times"></i>
									</button>
									</div>
								</div>`;
								$("#custom_fields_container").append(html);
							});

							// ✅ Remove custom field
							$(document).on("click", ".remove_custom_field", function () {
								let id = $(this).data("id");
								$("#custom_field_" + id).remove();
							});

							// ✅ Add additional fields dynamically (Registration Details)
							let fieldCount = 0;
							$("#add_additional_field").on("click", function () {
								fieldCount++;
								let fieldHtml = `
								<div class="row additional-field" id="field_${fieldCount}" style="margin-top:10px;">
									<div class="col-md-5">
									<input
										type="text"
										class="form-control"
										name="additional_label[]"
										placeholder="Enter Label"
									/>
									</div>
									<div class="col-md-5">
									<input
										type="text"
										class="form-control"
										name="additional_value[]"
										placeholder="Enter Value"
									/>
									</div>
									<div class="col-md-2">
									<button
										type="button"
										class="btn btn-sm btn-danger remove_field"
										data-id="${fieldCount}"
									>
										<i class="fa fa-trash"></i>
									</button>
									</div>
								</div>`;
								$("#additional_fields_container").append(fieldHtml);
							});

							// ✅ Remove additional field
							$(document).on("click", ".remove_field", function () {
								let id = $(this).data("id");
								$("#field_" + id).remove();
							});

							// ✅ Add new additional field dynamically in edit modal
							let editFieldCount = 100; // arbitrary start index
							$("#edit_additional_field_btn").on("click", function () {
							editFieldCount++;
							let fieldHtml = `
								<div class="row mb-2" id="edit_field_${editFieldCount}" style="margin-top:10px;">
								<div class="col-md-5">
									<input type="text" class="form-control" name="edit_additional_label[]" placeholder="Enter Label">
								</div>
								<div class="col-md-5">
									<input type="text" class="form-control" name="edit_additional_value[]" placeholder="Enter Value">
								</div>
								<div class="col-md-2">
									<button type="button" class="btn btn-danger btn-sm remove_edit_field" data-id="${editFieldCount}">
									<i class="fa fa-trash"></i>
									</button>
								</div>
								</div>`;
							$("#edit_additional_fields_container").append(fieldHtml);
							});

							// ✅ Remove field row
							$(document).on("click", ".remove_edit_field", function () {
							let id = $(this).data("id");
							$("#edit_field_" + id).remove();
							});

							// Handle Save button click (optional photo upload)
							$("#saveVehiclePhotos").click(function () {
							let files = $(".vehicle-photo").map(function () {
								return this.files[0] ? this.files[0].name : null;
							}).get();

							let uploadedCount = files.filter((x) => x !== null).length;

							if (uploadedCount > 0) {
								Swal.fire({
								icon: "success",
								title: "Photos Selected",
								text: `${uploadedCount} photo(s) ready for upload.`,
								timer: 1500,
								showConfirmButton: false,
								});
							}

							// ✅ Just close the modal, don’t block form submit
							$("#vehiclePhotosModal").modal("hide");
							});

							// Detect file selection and apply visual feedback
							$("#vehiclePhotosModal input[type='file']").on("change", function () {
								if (this.files && this.files.length > 0) {
									// ✅ Mark as uploaded
									$(this).addClass("uploaded");
								} else {
									// ❌ No file selected (reset)
									$(this).removeClass("uploaded");
								}
							});

							// Optional: reset styles when modal closes
							$("#vehiclePhotosModal").on("hidden.bs.modal", function () {
								$("#vehiclePhotosModal input[type='file']").removeClass("uploaded");
							});

							// ================== Edit Vehicle Video Modal ==================
							$("#edit_vehicle_video").on("change", function () {
								const file = this.files[0];
								if (!file) return;

								const videoUrl = URL.createObjectURL(file);
								$("#edit_vehicle_video_preview").attr("src", videoUrl).show();

								Swal.fire({
									icon: "info",
									title: "Video Selected",
									text: "Your video will be compressed automatically on save.",
									timer: 1500,
									showConfirmButton: false,
								});
							});

							// Reset on close
							$("#editVehicleVideoModal").on("hidden.bs.modal", function () {
								$("#edit_vehicle_video_preview").attr("src", "").hide();
							});

					    });

                </script>



				</div>
			</div>
		</div>


		<script>
			$(document).ready(function(){
				// Pass PHP permissions to JS
				let userPermissions = <?php echo json_encode($perm_map ?? []); ?>;

				$.each(userPermissions, function(field, perm){
					let $field = $(`[name='${field}']`);

					// 🟢 Handle "Additional Custom Fields" (not real input)
					if (field === 'custom_field_dynamic') {
						if (perm.view == 0) {
							$("#custom_fields_container").closest('.form-group').hide();
						} else if (perm.edit == 0) {
							$("#add_custom_field").prop('disabled', true);
						}
						return; // skip to next
					}

					// 🟢 For all normal form fields
					if ($field.length) {
						// Hide entire group if no view permission
						if (perm.view == 0) {
							$field.closest('.form-group').hide();
						}

						// Disable input if edit permission is off
						else if (perm.edit == 0) {
							// For select2 dropdowns
							if ($field.hasClass('select2')) {
								$field.prop('disabled', true);
								$field.trigger('change.select2');
							} else {
								$field.prop('readonly', true);
								$field.prop('disabled', true);
							}
						}
					}
				});
			});
		</script>


	</section>
</div>

<!-- ========================= Vehicle Edit Modal ========================= -->

<div id="edit_vechile_model" class="modal fade" role="dialog">
	<div class="modal-dialog modal-lg">
		<!-- Modal content-->
		<div class="modal-content modal-lg-content">
			<div class="modal-header" style="background: #778d9d">
				<button
					type="button"
					class="close"
					data-dismiss="modal"
					style="color: #fff"
				>
					&times;
				</button>

				<div class="row">
					<div class="col-md-6">
						<h4 class="modal-title" style="color: #fff">
							<i class="fa fa-car" style="color: #fff" aria-hidden="true"></i>
							&nbsp;Edit Vechile Details
						</h4>
					</div>
					<div class="col-md-5">
						<button
							class="btn btn-success btn-sm pull-right save_model"
							id="update_vechile_btn"
						>
							<i class="fa fa-save" aria-hidden="true"></i> Update
						</button>
					</div>
				</div>
			</div>
			<div class="modal-body">
				<div class="box">
					<div class="box-header with-border" style="background: #f4f4f48c">
						<h3
							class="box-title"
							_msthash="26273"
							_msttexthash="60619"
							style="text-align: left; font-size: 14px"
						>
							<i class="fa fa-bars" aria-hidden="true"></i>
							&nbsp;&nbsp; General Details
						</h3>
						<div class="box-tools pull-right">
							<button
								type="button"
								class="btn btn-box-tool"
								data-widget="collapse"
								data-toggle="tooltip"
								title=""
								data-original-title="Collapse"
							>
								<i class="fa fa-minus"></i>
							</button>
						</div>
					</div>
					<div class="box-body" _msthash="1196936" _msttexthash="1190501">
						<div class="row">
							<input type="hidden" id="edit_vechicle_id" />

							<div class="col-md-6">
								<div class="form-group">
									<div class="row">
										<div class="col-md-4">
											<label>Vechile Type</label><span>*</span>
										</div>
										<div class="col-md-8">
											<select
												class="form-control"
												name="edit_vechile_type"
												id="edit_vechile_type"
												disabled
											>
												<option value="">--Select--</option>
												<?php foreach ($policy_type as $da) {?>
												<option value="<?php echo $da->id ?>">
													<?php echo $da->policy_type ?>
												</option>
												<?php } ?>
											</select>
										</div>
									</div>
								</div>

								<div class="form-group">
									<div class="row">
										<div class="col-md-4">
											<label>Make</label><span>*</span>
										</div>
										<div class="col-md-8">
											<select
												class="form-control select2"
												name="edit_vechi_make"
												id="edit_vechi_make"
												style="width: 100%"
											>
												<option value="">--Select--</option>
											</select>
										</div>
									</div>
								</div>

								<div class="form-group">
									<div class="row">
										<div class="col-md-4">
											<label>Model</label><span>*</span>
										</div>
										<div class="col-md-8">
											<select
												class="form-control select2"
												name="edit_vechi_model"
												id="edit_vechi_model"
												style="width: 100%"
											>
												<option value="">--Select--</option>
											</select>
										</div>
									</div>
								</div>

								<div class="form-group">
									<div class="row">
										<div class="col-md-4">
											<label>Varient</label>
										</div>
										<div class="col-md-8">
											<select
												class="form-control select2"
												name="edit_vechi_varient"
												id="edit_vechi_varient"
												style="width: 100%"
											>
												<option value="">--Select--</option>
											</select>
										</div>
									</div>
								</div>
								<div class="form-group">
									<div class="row">
										<div class="col-md-4">
											<label>CC</label>
										</div>
										<div class="col-md-8">
											<input
												type="text"
												class="form-control"
												name="edit_vechi_cc"
												id="edit_vechi_cc"
												inputmode="numeric"
												min="0"
												oninput="this.value = this.value.replace(/[^0-9]/g, '');"
												onkeydown="return event.keyCode !== 69 && event.keyCode !== 187 && event.keyCode !== 189 && event.keyCode !== 190;"
												placeholder="Enter CC (e.g. 100)"
												required
											/>
										</div>
									</div>
								</div>
								<div class="form-group">
									<div class="row">
										<div class="col-md-4">
											<label>Year Of Manufature</label>
										</div>
										<div class="col-md-4">
											<select
												class="form-control"
												name="edit_vechi_manu_month"
												id="edit_vechi_manu_month"
											>
												<option value="">--Select--</option>
												<option value="01">Jan</option>
												<option value="02">Feb</option>
												<option value="03">Mar</option>
												<option value="04">Apr</option>
												<option value="05">May</option>
												<option value="06">Jun</option>
												<option value="07">Jul</option>
												<option value="08">Augt</option>
												<option value="09">Sep</option>
												<option value="10">Oct</option>
												<option value="11">Nov</option>
												<option value="12">Dec</option>
											</select>
										</div>
										<div class="col-md-4">
											<select
												class="form-control select2"
												name="edit_vechi_manu_year"
												id="edit_vechi_manu_year"
												style="width: 100%"
												placeholder="Manufacture Year"
											>
												<?php for ($i = 1900;$i <= 3050 ;$i++) {?>
												<option value="<?php echo $i ?>">
													<?php echo $i ?>
												</option>
												<?php } ?>
											</select>
										</div>
									</div>
								</div>

								<div class="form-group">
									<div class="row">
										<div class="col-md-4">
											<label>Seating Capacity</label>
										</div>
										<div class="col-md-8">
											<input
												type="text"
												class="form-control"
												name="edit_vechi_seating"
												id="edit_vechi_seating"
											/>
										</div>
									</div>
								</div>

								<div class="form-group">
									<div class="row">
										<div class="col-md-4">
											<label>Vechile Classfication</label>
										</div>
										<div class="col-md-8">
											<select
												class="form-control"
												name="edit_vechi_classfication"
												id="edit_vechi_classfication"
											>
												<option value="">--Select--</option>
												<option value="small">Small</option>
												<option value="Hatchback">Hatchback</option>
												<option value="Midsize">Midsize</option>
												<option value="High End">High End</option>
												<option value="MPV/SUV">MPV/SUV</option>
												<option value="Commercial">Commercial</option>
											</select>
										</div>
									</div>
								</div>
							</div>

							<div class="col-md-6">
								<div class="form-group">
									<div class="row">
										<div class="col-md-4">
											<label>Fuel Type</label>
										</div>
										<div class="col-md-8">
											<select
												class="form-control"
												name="edit_vechi_fuel_type"
												id="edit_vechi_fuel_type"
											>
												<option value="">--select--</option>
												<?php foreach ($fuel_type as $da) {
                                         if ($da->id != "4") {?>
												<option value="<?php echo $da->id ?>">
													<?php echo $da->fuel_type; ?>
												</option>
												<?php }
                                         } ?>
											</select>
										</div>
									</div>
								</div>

								<div class="form-group">
									<div class="row">
										<div class="col-md-4">
											<label>GVW</label>
										</div>
										<div class="col-md-8">
											<input
												type="text"
												class="form-control"
												name="edit_vechi_gvw"
												id="edit_vechi_gvw"
											/>
										</div>
									</div>
								</div>

								<div class="form-group">
									<div class="row">
										<div class="col-md-4">
											<label>Passenger Carrying </label>
										</div>
										<div class="col-md-8">
											<select
												class="form-control"
												name="edit_passenger_carrying"
												id="edit_passenger_carrying"
											></select>
										</div>
									</div>
								</div>

								<div class="form-group">
									<div class="row">
										<div class="col-md-4">
											<label>Engine Number </label>
										</div>
										<div class="col-md-8">
											<input
												type="text"
												class="form-control"
												name="edit_vechi_engine_num"
												id="edit_vechi_engine_num"
											/>
										</div>
									</div>
								</div>

								<div class="form-group">
									<div class="row">
										<div class="col-md-4">
											<label>Chassis Number </label><span>*</span>
										</div>
										<div class="col-md-8">
											<input
												type="text"
												class="form-control"
												name="edit_vechi_chassis_num"
												id="edit_vechi_chassis_num"
											/>
										</div>
									</div>
								</div>

								<div class="form-group">
									<div class="row">
										<div class="col-md-4">
											<label>Hypothecation </label>
										</div>
										<div class="col-md-8">
											<select name="edit_vechi_hypothecation" id="edit_vechi_hypothecation" class="form-control">
												<option value="">--select--</option>
												<option value="Haier Purchase">Haier Purchase</option>
												<option value="Leese agriment">Leese agriment</option>
											</select>	
										</div>
									</div>
								</div>

								<div class="form-group">
									<div class="row">
										<div class="col-md-4">
											<label>Agency/Pos </label>
										</div>
										<div class="col-md-8">
											<select
												class="form-control"
												name="edit_created_user"
												id="edit_created_user"
											>
												<option
													value="<?php echo $this->session->userdata('session_id'); ?>"
												>
													<?php echo $this->session->userdata('session_name');?>
												</option>
											</select>
										</div>
									</div>
								</div>

								<div class="form-group">
									<div class="row">
										<div class="col-md-4">
											<label>Remarks </label>
										</div>
										<div class="col-md-8">
											<textarea
												type="text"
												class="form-control"
												name="edit_vechi_remarks"
												id="edit_vechi_remarks"
											></textarea>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="box">
					<div class="box-header with-border" style="background: #f4f4f48c">
						<h3
							class="box-title"
							_msthash="26273"
							_msttexthash="60619"
							style="text-align: left; font-size: 14px"
						>
							<i class="fa fa-bars" aria-hidden="true"></i>
							&nbsp;&nbsp; Registration Details
						</h3>
						<div class="box-tools pull-right">
							<button
								type="button"
								class="btn btn-box-tool"
								data-widget="collapse"
								data-toggle="tooltip"
								title=""
								data-original-title="Collapse"
							>
								<i class="fa fa-minus"></i>
							</button>
						</div>
					</div>
					<div
						class="box-body"
						_msthash="1196936"
						_msttexthash="1190501"
						style="text-align: left"
					>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<div class="row">
										<div class="col-md-4">
											<label>Regn no</label><span> *</span>
										</div>

										<div class="col-md-2">
											<input
												type="text"
												class="form-control"
												name="edit_regn_no_1"
												id="edit_regn_no_1"
											/>
										</div>
										<div class="col-md-2">
											<input
												type="text"
												class="form-control"
												name="edit_regn_no_2"
												id="edit_regn_no_2"
											/>
										</div>
										<div class="col-md-2">
											<input
												type="text"
												class="form-control"
												name="edit_regn_no_3"
												id="edit_regn_no_3"
											/>
										</div>
										<div class="col-md-2">
											<input
												type="text"
												class="form-control"
												name="edit_regn_no_4"
												id="edit_regn_no_4"
											/>
										</div>
									</div>
								</div>

								<div class="form-group">
									<div class="row">
										<div class="col-md-4">
											<label>Regn Date</label>
										</div>
										<div class="col-md-8">
											<input
												type="Date"
												class="form-control"
												name="edit_regn_date"
												id="edit_regn_date"
											/>
										</div>
									</div>
								</div>

                                <div class="form-group ">
                                  <div class="row">
                                    <div class="col-md-4">
                                        <label>Registration Certificate</label>
                                    </div>
                                    <div class="col-md-8">   
                                        <input type="file" id="edit_regn_certificate" name="regn_certificate" class="form-control">
                                        <div id="edit_rc_preview" class="mt-2"></div>
                                    </div>
                                  </div>
                                </div>


								<div class="form-group">
									<div class="row">
										<div class="col-md-4">
											<label>RTO</label>
										</div>
										<div class="col-md-8">
											<select
												class="form-control"
												name="edit_rto"
												id="edit_rto"
											>
												<option value="">--select--</option>
												<?php foreach ($rto as $da) {
                                        if ($da->id != "1" || $da->id != "2" ||
												$da->id != "3" || $da->id != "4" || $da->id != "5" ||
												$da->id != "6") { ?>
												<option value="<?php echo $da->rto_no ?>">
													<?php echo $da->rto_no." ( ".$da->city." )"; ?>
												</option>

												<?php }
                                        } ?>
											</select>
										</div>
									</div>
								</div>

								<div class="form-group">
									<div class="row">
										<div class="col-md-4">
											<label>Zone</label>
										</div>
										<div class="col-md-8">
											<input
												type="text"
												class="form-control"
												name="edit_zone"
												id="edit_zone"
											/>
										</div>
									</div>
								</div>
                                
								<!-- ✅ Additional Fields -->
								<div class="form-group">
								<div class="row">
									<div class="col-md-12">
									<label>Additional Fields</label>
									<button
										type="button"
										id="edit_additional_field_btn"
										class="btn btn-sm btn-primary"
										style="margin-left: 10px"
									>
										<i class="fa fa-plus"></i> Add Field
									</button>
									</div>
								</div>

								<div id="edit_additional_fields_container" style="margin-top: 10px"></div>
								</div>

							</div>

							<div class="col-md-6">
								<div class="form-group">
									<div class="row">
										<div class="col-md-4">
										<label>Registration Address</label>
										</div>
										<div class="col-md-8">
											<textarea
												class="form-control"
												name="edit_regn_address"
												id="edit_regn_address"
												rows="3"
												placeholder="Enter registration address"
											></textarea>

											<!-- Copy Address Checkboxes -->
											<div style="margin-top: 8px">
												<div class="checkbox" style="margin-bottom: 5px">
												<label style="padding-left: 0; display: inline-flex; align-items: center;">
													<input
													type="checkbox"
													id="edit_copy_client_comm_address"
													style="position: relative; top: 1px; margin-right: 8px"
													/>
													<span>Same as Client Communication Address</span>
												</label>
												</div>

												<div class="checkbox">
												<label style="padding-left: 0; display: inline-flex; align-items: center;">
													<input
													type="checkbox"
													id="edit_copy_client_perm_address"
													style="position: relative; top: 1px; margin-right: 8px"
													/>
													<span>Same as Client Permanent Address</span>
												</label>
												</div>
											</div>
										</div>
									</div>
								</div>

								
								<div class="form-group">
									<div class="row">
										<div class="col-md-4">
											<label>City</label>
										</div>
										<div class="col-md-8">
											<input
												type="text"
												class="form-control"
												name="edit_city"
												id="edit_city"
											/>
										</div>
									</div>
								</div>

								<div class="form-group">
									<div class="row">
										<div class="col-md-4">
											<label>State</label>
										</div>
										<div class="col-md-8">
											<select
												class="form-control select2"
												name="edit_state"
												id="edit_state"
												style="width: 100%"
											>
												<option value="">--Select--</option>
												<?php foreach ($state as $s) { ?>
													<option value="<?php echo $s->id; ?>">
														<?php echo $s->name; ?>
													</option>
												<?php } ?>
											</select>
										</div>
									</div>
								</div>


								<div class="form-group">
									<div class="row">
										<div class="col-md-4"><label>Country</label></div>
										<div class="col-md-8">
										<input
											type="text"
											class="form-control"
											name="edit_country"
											id="edit_country"
											value="India"
											placeholder="Enter Country"
										/>
										</div>
									</div>
								</div>


								<div class="form-group">
									<div class="row">
										<div class="col-md-4">
											<label>Pincode</label>
										</div>
										<div class="col-md-8">
											<input
												type="text"
												class="form-control"
												name="edit_pincode"
												id="edit_pincode"
											/>
										</div>
									</div>
								</div>

								<div class="form-group">
									<div class="row">
										<div class="col-md-4"></div>
										<div class="col-md-8">
											<button
												type="button"
												class="btn btn-primary"
												data-toggle="modal"
												data-target="#editVehiclePhotosModal"
											>
												<i class="fa fa-camera"></i> Update Vehicle Photos
											</button>
										</div>
									</div>
								</div>

								<!-- Vehicle Video Upload Button -->
								<div class="form-group">
									<div class="row">
										<div class="col-md-4"></div>
										<div class="col-md-8">
											<button
												type="button"
												class="btn btn-warning"
												data-toggle="modal"
												data-target="#editVehicleVideoModal"
											>
												<i class="fa fa-video-camera"></i> Update Vehicle Video
											</button>
										</div>
									</div>
								</div>

							</div>
						</div>
					</div>
				</div>

				<div class="box">
					<div class="box-header with-border" style="background: #f4f4f48c">
						<h3
							class="box-title"
							_msthash="26273"
							_msttexthash="60619"
							style="text-align: left; font-size: 14px"
						>
							<i class="fa fa-upload" aria-hidden="true"></i>
							&nbsp;&nbsp; Upload Documents
						</h3>
						<div class="box-tools pull-right">
							<button
								type="button"
								class="btn btn-box-tool"
								data-widget="collapse"
								data-toggle="tooltip"
								title=""
								data-original-title="Collapse"
							>
								<i class="fa fa-minus"></i>
							</button>
						</div>
					</div>
					<div class="box-body" _msthash="1196936" _msttexthash="1190501">
						<table class="table table-bordered">
							<thead>
								<tr>
									<th>File type</th>
									<th>File name</th>
									<th>Document Type</th>
									<th>Edit</th>
									<th>Delete</th>
								</tr>
							</thead>
							<tbody id="edit_table_view"></tbody>
						</table>
					</div>
				</div>

			</div>
		</div>
	</div>
</div>

<!-- ========================= End Vehicle Edit Modal ========================= -->

<div class="modal fade in" id="edit_doc_mod">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header bg-primary">
				<button
					type="button"
					class="close"
					data-dismiss="modal"
					aria-label="Close"
				>
					<span aria-hidden="true" style="color: white">×</span>
				</button>
				<h4 class="modal-title text-center">Edit Vehicle Document</h4>
			</div>
			<div class="modal-body">
				<div class="form-group">
					<label>Document Type</label>
					<span id="edit_doc_error" style="color: red">*</span>
					<select
						class="form-control"
						name="edit_document_type"
						id="edit_document_type"
					>
						<option value="">--Select--</option>
						<option value="RC Book">RC Book</option>
						<option value="Licence">Licence</option>
						<option value="Others">Others</option>
					</select>
				</div>

				<div class="form-group">
					<label>Choosen file</label>
					<input
						type="file"
						name="edit_vechi_doc"
						id="edit_vechi_doc"
						class="form-control"
					/>
				</div>

				<input type="hidden" id="edit_doc_id" />
			</div>
			<div class="modal-footer">
				<button
					type="button"
					class="btn btn-sm btn-default pull-left"
					data-dismiss="modal"
				>
					Close
				</button>
				<button type="button" class="btn btn-sm btn-primary" id="edit_doc_btn">
					Submit
				</button>
			</div>
		</div>
	</div>
</div>

<!-- ========================= Add Vehicle Photos Upload Modal ========================= -->
<div class="modal fade" id="vehiclePhotosModal" tabindex="-1" role="dialog" aria-labelledby="vehiclePhotosLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header" style="background: #f4f4f48c">
				<h4 class="modal-title" id="vehiclePhotosLabel">
					<i class="fa fa-camera"></i> Upload Vehicle Photos
				</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>

			<div class="modal-body">
				<div class="container-fluid">
					<div class="row">
						
						<!-- 1–10 -->
						<div class="col-md-4 mb-4">
							<label>1. FRONT VIEW</label>
							<input type="file" class="form-control" name="front_view" accept="image/*">
						</div>
						<div class="col-md-4 mb-4">
							<label>2. BACK VIEW</label>
							<input type="file" class="form-control" name="back_view" accept="image/*">
						</div>
						<div class="col-md-4 mb-4">
							<label>3. LEFT SIDE VIEW</label>
							<input type="file" class="form-control" name="left_side_view" accept="image/*">
						</div>
						<div class="col-md-4 mb-4">
							<label>4. RIGHT SIDE VIEW</label>
							<input type="file" class="form-control" name="right_side_view" accept="image/*">
						</div>
						<div class="col-md-4 mb-4">
							<label>5. ODOMETER</label>
							<input type="file" class="form-control" name="dashboard" accept="image/*">
						</div>
						<div class="col-md-4 mb-4">
							<label>6. CHASSIS NUMBER</label>
							<input type="file" class="form-control" name="interior_front_seats" accept="image/*">
						</div>
						<div class="col-md-4 mb-4">
							<label>7. WIND SHIELD </label>
							<input type="file" class="form-control" name="interior_back_seats" accept="image/*">
						</div>
						<div class="col-md-4 mb-4">
							<label>8. ENGINE </label>
							<input type="file" class="form-control" name="engine_compartment" accept="image/*">
						</div>
						<div class="col-md-4 mb-4">
							<label>9. ENGINE NUMBER</label>
							<input type="file" class="form-control" name="boot_space" accept="image/*">
						</div>
						<div class="col-md-4 mb-4">
							<label>10. HOURS READING</label>
							<input type="file" class="form-control" name="tyre_front_left" accept="image/*">
						</div>

						<!-- 11–20 -->
						<div class="col-md-4 mb-4">
							<label>11. Tyre Front Right</label>
							<input type="file" class="form-control" name="tyre_front_right" accept="image/*">
						</div>
						<div class="col-md-4 mb-4">
							<label>12. Tyre Rear Left</label>
							<input type="file" class="form-control" name="tyre_rear_left" accept="image/*">
						</div>
						<div class="col-md-4 mb-4">
							<label>13. Tyre Rear Right</label>
							<input type="file" class="form-control" name="tyre_rear_right" accept="image/*">
						</div>
						<div class="col-md-4 mb-4">
							<label>14. Number Plate Front</label>
							<input type="file" class="form-control" name="number_plate_front" accept="image/*">
						</div>
						<div class="col-md-4 mb-4">
							<label>15. Number Plate Back</label>
							<input type="file" class="form-control" name="number_plate_back" accept="image/*">
						</div>
						<div class="col-md-4 mb-4">
							<label>16. Roof</label>
							<input type="file" class="form-control" name="roof" accept="image/*">
						</div>
						<div class="col-md-4 mb-4">
							<label>17. Windshield Front</label>
							<input type="file" class="form-control" name="windshield_front" accept="image/*">
						</div>
						<div class="col-md-4 mb-4">
							<label>18. Windshield Rear</label>
							<input type="file" class="form-control" name="windshield_rear" accept="image/*">
						</div>
						<div class="col-md-4 mb-4">
							<label>19. Chassis Number Area</label>
							<input type="file" class="form-control" name="chassis_number_area" accept="image/*">
						</div>
						<div class="col-md-4 mb-4">
							<label>20. Odometer Reading</label>
							<input type="file" class="form-control" name="odometer_reading" accept="image/*">
						</div>

						<!-- 21–30 -->
						<div class="col-md-4 mb-4">
							<label>21. Battery Area</label>
							<input type="file" class="form-control" name="battery_area" accept="image/*">
						</div>
						<div class="col-md-4 mb-4">
							<label>22. Tool Kit Area</label>
							<input type="file" class="form-control" name="tool_kit_area" accept="image/*">
						</div>
						<div class="col-md-4 mb-4">
							<label>23. Spare Wheel</label>
							<input type="file" class="form-control" name="spare_wheel" accept="image/*">
						</div>
						<div class="col-md-4 mb-4">
							<label>24. Music System</label>
							<input type="file" class="form-control" name="music_system" accept="image/*">
						</div>
						<div class="col-md-4 mb-4">
							<label>25. AC Control Panel</label>
							<input type="file" class="form-control" name="ac_control_panel" accept="image/*">
						</div>
						<div class="col-md-4 mb-4">
							<label>26. Steering Area</label>
							<input type="file" class="form-control" name="steering_area" accept="image/*">
						</div>
						<div class="col-md-4 mb-4">
							<label>27. Gear Console</label>
							<input type="file" class="form-control" name="gear_console" accept="image/*">
						</div>
						<div class="col-md-4 mb-4">
							<label>28. Mirror Inside</label>
							<input type="file" class="form-control" name="mirror_inside" accept="image/*">
						</div>
						<div class="col-md-4 mb-4">
							<label>29. Mirror Outside</label>
							<input type="file" class="form-control" name="mirror_outside" accept="image/*">
						</div>
						<div class="col-md-4 mb-4">
							<label>30. Documents Photo</label>
							<input type="file" class="form-control" name="documents_photo" accept="image/*">
						</div>

					</div>
				</div>
			</div>

			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-success" id="saveVehiclePhotos">
					<i class="fa fa-save"></i> Save Photos
				</button>
			</div>
		</div>
	</div>
</div>
<!-- ========================= End Vehicle Photos Modal ========================= -->

<!-- ========================= Edit Vehicle Photos Upload Modal ========================= -->
<div class="modal fade" id="editVehiclePhotosModal" tabindex="-1" role="dialog" aria-labelledby="editVehiclePhotosLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header" style="background: #f4f4f48c">
				<h4 class="modal-title" id="editVehiclePhotosLabel">
					<i class="fa fa-camera"></i> Update Vehicle Photos
				</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>

			<div class="modal-body">
				<div class="container-fluid">
					<div class="row">

						<!-- 1–10 -->
						<div class="col-md-4 mb-4">
							<label>1. FRONT VIEW</label>
							<input type="file" class="form-control vehicle-photo-edit" name="vehicle_photos_edit[img_1]" accept="image/*">
						</div>
						<div class="col-md-4 mb-4">
							<label>2. BACK VIEW</label>
							<input type="file" class="form-control vehicle-photo-edit" name="vehicle_photos_edit[img_2]" accept="image/*">
						</div>
						<div class="col-md-4 mb-4">
							<label>3. LEFT SIDE VIEW</label>
							<input type="file" class="form-control vehicle-photo-edit" name="vehicle_photos_edit[img_3]" accept="image/*">
						</div>
						<div class="col-md-4 mb-4">
							<label>4. RIGHT SIDE VIEW</label>
							<input type="file" class="form-control vehicle-photo-edit" name="vehicle_photos_edit[img_4]" accept="image/*">
						</div>
						<div class="col-md-4 mb-4">
							<label>5. ODOMETER</label>
							<input type="file" class="form-control vehicle-photo-edit" name="vehicle_photos_edit[img_5]" accept="image/*">
						</div>
						<div class="col-md-4 mb-4">
							<label>6. CHASSIS NUMBER</label>
							<input type="file" class="form-control vehicle-photo-edit" name="vehicle_photos_edit[img_6]" accept="image/*">
						</div>
						<div class="col-md-4 mb-4">
							<label>7. WIND SHIELD</label>
							<input type="file" class="form-control vehicle-photo-edit" name="vehicle_photos_edit[img_7]" accept="image/*">
						</div>
						<div class="col-md-4 mb-4">
							<label>8. ENGINE</label>
							<input type="file" class="form-control vehicle-photo-edit" name="vehicle_photos_edit[img_8]" accept="image/*">
						</div>
						<div class="col-md-4 mb-4">
							<label>9. ENGINE NUMBER</label>
							<input type="file" class="form-control vehicle-photo-edit" name="vehicle_photos_edit[img_9]" accept="image/*">
						</div>
						<div class="col-md-4 mb-4">
							<label>10. HOURS READING</label>
							<input type="file" class="form-control vehicle-photo-edit" name="vehicle_photos_edit[img_10]" accept="image/*">
						</div>

						<!-- 11–20 -->
						<div class="col-md-4 mb-4">
							<label>11. Tyre Front Right</label>
							<input type="file" class="form-control vehicle-photo-edit" name="vehicle_photos_edit[img_11]" accept="image/*">
						</div>
						<div class="col-md-4 mb-4">
							<label>12. Tyre Rear Left</label>
							<input type="file" class="form-control vehicle-photo-edit" name="vehicle_photos_edit[img_12]" accept="image/*">
						</div>
						<div class="col-md-4 mb-4">
							<label>13. Tyre Rear Right</label>
							<input type="file" class="form-control vehicle-photo-edit" name="vehicle_photos_edit[img_13]" accept="image/*">
						</div>
						<div class="col-md-4 mb-4">
							<label>14. Number Plate Front</label>
							<input type="file" class="form-control vehicle-photo-edit" name="vehicle_photos_edit[img_14]" accept="image/*">
						</div>
						<div class="col-md-4 mb-4">
							<label>15. Number Plate Back</label>
							<input type="file" class="form-control vehicle-photo-edit" name="vehicle_photos_edit[img_15]" accept="image/*">
						</div>
						<div class="col-md-4 mb-4">
							<label>16. Roof</label>
							<input type="file" class="form-control vehicle-photo-edit" name="vehicle_photos_edit[img_16]" accept="image/*">
						</div>
						<div class="col-md-4 mb-4">
							<label>17. Windshield Front</label>
							<input type="file" class="form-control vehicle-photo-edit" name="vehicle_photos_edit[img_17]" accept="image/*">
						</div>
						<div class="col-md-4 mb-4">
							<label>18. Windshield Rear</label>
							<input type="file" class="form-control vehicle-photo-edit" name="vehicle_photos_edit[img_18]" accept="image/*">
						</div>
						<div class="col-md-4 mb-4">
							<label>19. Chassis Number Area</label>
							<input type="file" class="form-control vehicle-photo-edit" name="vehicle_photos_edit[img_19]" accept="image/*">
						</div>
						<div class="col-md-4 mb-4">
							<label>20. Odometer Reading</label>
							<input type="file" class="form-control vehicle-photo-edit" name="vehicle_photos_edit[img_20]" accept="image/*">
						</div>

						<!-- 21–30 -->
						<div class="col-md-4 mb-4">
							<label>21. Battery Area</label>
							<input type="file" class="form-control vehicle-photo-edit" name="vehicle_photos_edit[img_21]" accept="image/*">
						</div>
						<div class="col-md-4 mb-4">
							<label>22. Tool Kit Area</label>
							<input type="file" class="form-control vehicle-photo-edit" name="vehicle_photos_edit[img_22]" accept="image/*">
						</div>
						<div class="col-md-4 mb-4">
							<label>23. Spare Wheel</label>
							<input type="file" class="form-control vehicle-photo-edit" name="vehicle_photos_edit[img_23]" accept="image/*">
						</div>
						<div class="col-md-4 mb-4">
							<label>24. Music System</label>
							<input type="file" class="form-control vehicle-photo-edit" name="vehicle_photos_edit[img_24]" accept="image/*">
						</div>
						<div class="col-md-4 mb-4">
							<label>25. AC Control Panel</label>
							<input type="file" class="form-control vehicle-photo-edit" name="vehicle_photos_edit[img_25]" accept="image/*">
						</div>
						<div class="col-md-4 mb-4">
							<label>26. Steering Area</label>
							<input type="file" class="form-control vehicle-photo-edit" name="vehicle_photos_edit[img_26]" accept="image/*">
						</div>
						<div class="col-md-4 mb-4">
							<label>27. Gear Console</label>
							<input type="file" class="form-control vehicle-photo-edit" name="vehicle_photos_edit[img_27]" accept="image/*">
						</div>
						<div class="col-md-4 mb-4">
							<label>28. Mirror Inside</label>
							<input type="file" class="form-control vehicle-photo-edit" name="vehicle_photos_edit[img_28]" accept="image/*">
						</div>
						<div class="col-md-4 mb-4">
							<label>29. Mirror Outside</label>
							<input type="file" class="form-control vehicle-photo-edit" name="vehicle_photos_edit[img_29]" accept="image/*">
						</div>
						<div class="col-md-4 mb-4">
							<label>30. Documents Photo</label>
							<input type="file" class="form-control vehicle-photo-edit" name="vehicle_photos_edit[img_30]" accept="image/*">
						</div>

					</div>
				</div>
			</div>

			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>
<!-- ========================= End Edit Vehicle Photos Upload Modal ========================= -->

<!-- =========================Add Vehicle Video Upload Modal ========================= -->
<div
	class="modal fade"
	id="vehicleVideoModal"
	tabindex="-1"
	role="dialog"
	aria-labelledby="vehicleVideoLabel"
	aria-hidden="true"
>
	<div class="modal-dialog modal-md" role="document">
		<div class="modal-content">
			<div class="modal-header" style="background: #f4f4f48c">
				<h4 class="modal-title" id="vehicleVideoLabel">
					<i class="fa fa-video-camera"></i> Upload Vehicle Video
				</h4>
				<button
					type="button"
					class="close"
					data-dismiss="modal"
					aria-label="Close"
				>
					<span aria-hidden="true">&times;</span>
				</button>
			</div>

			<div class="modal-body">
				<div class="form-group">
					<label>Select Vehicle Walkaround Video</label>
					<input
						type="file"
						class="form-control"
						name="vehicle_video"
						id="vehicle_video"
						accept="video/mp4,video/avi,video/mov,video/x-m4v,video/*"
					/>
					<small class="text-muted d-block mt-2">
						Max size 200MB | Formats: MP4, AVI, MOV
					</small>
					<!-- Preview -->
					<video
						id="vehicle_video_preview"
						controls
						style="display: none; margin-top: 10px; width: 100%; border-radius: 6px"
					></video>
				</div>
			</div>

			<div class="modal-footer">
				<button
					type="button"
					class="btn btn-secondary"
					data-dismiss="modal"
				>
					Close
				</button>
			</div>
		</div>
	</div>
</div>
<!-- ========================= End Add Vehicle Video Upload Modal ========================= -->

<!-- ========================= Edit Vehicle Video Modal ========================= -->
<div
	class="modal fade"
	id="editVehicleVideoModal"
	tabindex="-1"
	role="dialog"
	aria-labelledby="editVehicleVideoLabel"
	aria-hidden="true"
    >
	<div class="modal-dialog modal-md" role="document">
		<div class="modal-content">
			<div class="modal-header" style="background: #f4f4f48c">
				<h4 class="modal-title" id="editVehicleVideoLabel">
					<i class="fa fa-video-camera"></i> Update Vehicle Video
				</h4>
				<button
					type="button"
					class="close"
					data-dismiss="modal"
					aria-label="Close"
				>
					<span aria-hidden="true">&times;</span>
				</button>
			</div>

			<div class="modal-body">
				<div class="form-group">
					<label>Replace Vehicle Video</label>
					<input
						type="file"
						class="form-control"
						name="edit_vehicle_video"
						id="edit_vehicle_video"
						accept="video/mp4,video/avi,video/mov,video/x-m4v,video/*"
					/>
					<small class="text-muted d-block mt-2">
						Max size 200MB | Formats: MP4, AVI, MOV
					</small>

					<!-- Existing video preview -->
					<div id="existing_vehicle_video_preview" style="margin-top: 10px"></div>

					<!-- New video preview -->
					<video
						id="edit_vehicle_video_preview"
						controls
						style="display: none; margin-top: 10px; width: 100%; border-radius: 6px"
					></video>
				</div>
			</div>

			<div class="modal-footer">
				<button
					type="button"
					class="btn btn-secondary"
					data-dismiss="modal"
				>
					Close
				</button>
			</div>
		</div>
	</div>
</div>
<!-- ========================= End Edit Vehicle Video Modal ========================= -->







