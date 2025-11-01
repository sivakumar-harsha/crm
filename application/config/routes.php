<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'Main';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route["upload"] = "Home/index";

$route["home"] = "Main/home";
//print_r("hi"); 
$route["login"] = "Main/login";
$route["login_submit"] = "Main/login_submit";
$route["forgot_password"] = "Main/forgot_password";
$route["forgot_password_submit"] = "Main/forgot_password_submit";
$route["forgot_password_otp"] = "Main/forgot_password_otp";
$route["otp_submit"] = "Main/otp_submit";
$route["reset_password"] = "Main/reset_password";
$route["reset_password_submit"] = "Main/reset_password_submit";
$route["changepassword"] = "Main/changepassword";
$route["update_new_password"] = "Main/update_new_password";
$route["prospect_summary_with_date"] = "Main/prospect_summary_with_date";
$route["agent_view"] = "Main/agent_view";
$route["get_agent_full_details"] = "Main/get_agent_full_details";
$route["logout"] = "Main/logout";
$route["agent_pos_load_more"] = "Main/agent_pos_load_more";
$route["staff_load_more"] = "Main/staff_load_more";
$route["staff_dashboard"] = "Main/staff_dashboard";
$route["staff_view"] = "Main/staff_view";
$route["fetch_all_follow_ups_dashboard_staff"] = "Main/fetch_all_follow_ups_dashboard_staff";
$route["get_staff_full_details"] = "Main/get_staff_full_details";
$route["ai_dashboard"] = "Main/ai_dashboard";
$route["ai_load_more"] = "Main/ai_load_more";
$route["ai_view"] = "Main/ai_view";//
$route["fetch_all_leads_dashboard_ai"] = "Main/fetch_all_leads_dashboard_ai";
$route["fetch_all_follow_ups_dashboard_ai"] = "Main/fetch_all_follow_ups_dashboard_ai";

//Master
$route["lead_summary_with_date"] = "Main/lead_summary_with_date";
$route["fetch_prospect_dashboard"] = "Main/fetch_prospect_dashboard";
$route["agent_pos_dashboard"] = "Main/agent_pos_dashboard";

$route["renewals_info_dashboard"] = "Main/renewals_info_dashboard"; //kgk

$route["fetch_all_leads_dashboard"] = "Main/fetch_all_leads_dashboard";
$route["fetch_all_follow_ups_dashboard"] = "Main/fetch_all_follow_ups_dashboard";
$route["fetch_all_leads_dashboard_staff"] = "Main/fetch_all_leads_dashboard_staff";
$route["get_staff_full_details"] = "Main/get_staff_full_details";
$route["database_cache_clear"] = "Main/database_cache_clear";

//Bussiness Followup
$route["bussiness_followup"] = "Main/bussiness_followup";
$route["fetch_agent_bussiness_follow_data"] = "Main/fetch_agent_bussiness_follow_data";
$route["add_agent_Business_followup"] = "Main/add_agent_Business_followup";
$route["fetch_agent_lead_dashboard_followup"] = "Main/fetch_agent_lead_dashboard_followup";
$route["fetch_customer_with_agent"] = "Main/fetch_customer_with_agent";

$route["bussiness_followup_ai"] = "Main/bussiness_followup_ai";
$route["fetch_area_incharge_bussiness_follow_data"] = "Main/fetch_area_incharge_bussiness_follow_data";
$route["add_area_incharge_Business_followup"] = "Main/add_area_incharge_Business_followup";
$route["fetch_area_incharge_lead_dashboard_followup"] = "Main/fetch_area_incharge_lead_dashboard_followup";
$route["fetch_customer_with_area_incharge"] = "Main/fetch_customer_with_area_incharge";
//profile agent start
$route["profile_agent"] = "Main/profile_agent";
//profile agent end
//Brand
$route["brand"] = "MasterCtrl/brand";
$route["fetch_brand"] = "MasterCtrl/fetch_brand";
$route["add_brand"] = "MasterCtrl/add_brand";
$route["fetch_edit_brand"] = "MasterCtrl/fetch_edit_brand";
$route["edit_brand"] = "MasterCtrl/edit_brand";
$route["delete_brand"] = "MasterCtrl/delete_brand";


//Model

$route["model"] = "MasterCtrl/model";

// test
$route["model1"] = "MasterCtrl/model1";
$route["add_model1"] = "MasterCtrl/add_model1";
$route["edit_model1"] = "MasterCtrl/edit_model1";
// test end

$route["fetch_car_model"] = "MasterCtrl/fetch_car_model";
$route["add_model"] = "MasterCtrl/add_model";
$route["fetch_edit_model"] = "MasterCtrl/fetch_edit_model";
$route["edit_model"] = "MasterCtrl/edit_model";
$route["delete_model"] = "MasterCtrl/delete_model";
$route["get_brand_logo"] = "MasterCtrl/get_brand_logo";


//Fuel Type

$route["fuel_type"] = "MasterCtrl/fuel_type";
$route["fetch_fuel_type"] = "MasterCtrl/fetch_fuel_type";
$route["add_fuel_type"] = "MasterCtrl/add_fuel_type";
$route["fetch_edit_fuel_type"] = "MasterCtrl/fetch_edit_fuel_type";
$route["edit_fuel_type"] = "MasterCtrl/edit_fuel_type";
$route["delete_fuel_type"] = "MasterCtrl/delete_fuel_type";

//Varient

$route["varient"] = "MasterCtrl/varient";
$route["fetch_varient"] = "MasterCtrl/fetch_varient";
$route["add_varient"] = "MasterCtrl/add_varient";
$route["fetch_edit_varient"] = "MasterCtrl/fetch_edit_varient";
$route["edit_varient"] = "MasterCtrl/edit_varient";
$route["delete_varient"] = "MasterCtrl/delete_varient";
$route["get_model_list"] = "MasterCtrl/get_model_list";


//gc vehicle

//gc Brand
$route["gc_brand"] = "MasterCtrl/gc_brand";
$route["fetch_gc_brand"] = "MasterCtrl/fetch_gc_brand";
$route["add_gc_brand"] = "MasterCtrl/add_gc_brand";
$route["fetch_edit_gc_brand"] = "MasterCtrl/fetch_edit_gc_brand";
$route["edit_gc_brand"] = "MasterCtrl/edit_gc_brand";
$route["delete_gc_brand"] = "MasterCtrl/delete_gc_brand";
$route["fetch_brand_by_policy_id"] = "MasterCtrl/fetch_brand_by_policy_id";


// gc Model

$route["gc_model"] = "MasterCtrl/gc_model";
$route["fetch_gc_model"] = "MasterCtrl/fetch_gc_model";
$route["add_gc_model"] = "MasterCtrl/add_gc_model";
$route["fetch_edit_gc_model"] = "MasterCtrl/fetch_edit_gc_model";
$route["edit_gc_model"] = "MasterCtrl/edit_gc_model";
$route["delete_gc_model"] = "MasterCtrl/delete_gc_model";

// gc Varient

$route["gc_varient"] = "MasterCtrl/gc_varient";
$route["fetch_gc_varient"] = "MasterCtrl/fetch_gc_varient";
$route["add_gc_varient"] = "MasterCtrl/add_gc_varient";
$route["fetch_edit_gc_varient"] = "MasterCtrl/fetch_edit_gc_varient";
$route["edit_gc_varient"] = "MasterCtrl/edit_gc_varient";
$route["delete_gc_varient"] = "MasterCtrl/delete_gc_varient";
$route["get_gc_model_list"] = "MasterCtrl/get_gc_model_list";


//pc vehicle

//pc Brand
$route["pc_brand"] = "MasterCtrl/pc_brand";
$route["fetch_pc_brand"] = "MasterCtrl/fetch_pc_brand";
$route["add_pc_brand"] = "MasterCtrl/add_pc_brand";
$route["fetch_edit_pc_brand"] = "MasterCtrl/fetch_edit_pc_brand";
$route["edit_pc_brand"] = "MasterCtrl/edit_pc_brand";
$route["delete_pc_brand"] = "MasterCtrl/delete_pc_brand";


// pc Model

$route["pc_model"] = "MasterCtrl/pc_model";
$route["fetch_pc_model"] = "MasterCtrl/fetch_pc_model";
$route["add_pc_model"] = "MasterCtrl/add_pc_model";
$route["fetch_edit_pc_model"] = "MasterCtrl/fetch_edit_pc_model";
$route["edit_pc_model"] = "MasterCtrl/edit_pc_model";
$route["delete_pc_model"] = "MasterCtrl/delete_pc_model";

// pc Varient

$route["pc_varient"] = "MasterCtrl/pc_varient";
$route["fetch_pc_varient"] = "MasterCtrl/fetch_pc_varient";
$route["add_pc_varient"] = "MasterCtrl/add_pc_varient";
$route["fetch_edit_pc_varient"] = "MasterCtrl/fetch_edit_pc_varient";
$route["edit_pc_varient"] = "MasterCtrl/edit_pc_varient";
$route["delete_pc_varient"] = "MasterCtrl/delete_pc_varient";
$route["get_pc_model_list"] = "MasterCtrl/get_pc_model_list";


//misc vehicle

//misc Brand
$route["misc_brand"] = "MasterCtrl/misc_brand";
$route["fetch_misc_brand"] = "MasterCtrl/fetch_misc_brand";
$route["add_misc_brand"] = "MasterCtrl/add_misc_brand";
$route["fetch_edit_misc_brand"] = "MasterCtrl/fetch_edit_misc_brand";
$route["edit_misc_brand"] = "MasterCtrl/edit_misc_brand";
$route["delete_misc_brand"] = "MasterCtrl/delete_misc_brand";


// misc Model

$route["misc_model"] = "MasterCtrl/misc_model";
$route["fetch_misc_model"] = "MasterCtrl/fetch_misc_model";
$route["add_misc_model"] = "MasterCtrl/add_misc_model";
$route["fetch_edit_misc_model"] = "MasterCtrl/fetch_edit_misc_model";
$route["edit_misc_model"] = "MasterCtrl/edit_misc_model";
$route["delete_misc_model"] = "MasterCtrl/delete_misc_model";

// misc Varient

$route["misc_varient"] = "MasterCtrl/misc_varient";
$route["fetch_misc_varient"] = "MasterCtrl/fetch_misc_varient";
$route["add_misc_varient"] = "MasterCtrl/add_misc_varient";
$route["fetch_edit_misc_varient"] = "MasterCtrl/fetch_edit_misc_varient";
$route["edit_misc_varient"] = "MasterCtrl/edit_misc_varient";
$route["delete_misc_varient"] = "MasterCtrl/delete_misc_varient";
$route["get_misc_model_list"] = "MasterCtrl/get_misc_model_list";


//Marine commodity
$route["commodity"] = "MasterCtrl/commodity";
$route["fetch_marine_commodity"] = "MasterCtrl/fetch_marine_commodity";
$route["add_marine_commodity"] = "MasterCtrl/add_marine_commodity";
$route["fetch_edit_marine_commodity"] = "MasterCtrl/fetch_edit_marine_commodity";
$route["edit_marine_commodity"] = "MasterCtrl/edit_marine_commodity";

// Marine commodity

$route["sub_commodity"] = "MasterCtrl/sub_commodity";
$route["fetch_marine_sub_commodity"] = "MasterCtrl/fetch_marine_sub_commodity";
$route["add_marine_sub_commodity"] = "MasterCtrl/add_marine_sub_commodity";
$route["fetch_edit_marine_sub_commodity"] = "MasterCtrl/fetch_edit_marine_sub_commodity";
$route["edit_marine_sub_commodity"] = "MasterCtrl/edit_marine_sub_commodity";

//Bike Brand

$route["bike_brand"] = "MasterCtrl/bike_brand";
$route["fetch_bike_brand"] = "MasterCtrl/fetch_bike_brand";
$route["add_bike_brand"] = "MasterCtrl/add_bike_brand";
$route["fetch_edit_bike_brand"] = "MasterCtrl/fetch_edit_bike_brand";
$route["edit_bike_brand"] = "MasterCtrl/edit_bike_brand";
$route["delete_bike_brand"] = "MasterCtrl/delete_bike_brand";


//pct
$route["premium_cover_type"] = "Main/premium_cover_type";
$route["fetch_premium_cover_type"] = "Main/fetch_premium_cover_type";
$route["add_premium_cover_type"] = "Main/add_premium_cover_type";
$route["fetch_edit_premium_cover_type"] = "Main/fetch_edit_premium_cover_type";
$route["edit_premium_cover_type"] = "Main/edit_premium_cover_type";
$route["delete_premium_cover_type"] = "Main/delete_premium_cover_type";

 //commission state
$route["commission_state"] = "Main/commission_state";
$route["fetch_commission_state"] = "Main/fetch_commission_state";
$route["add_commission_state"] = "Main/add_commission_state";
$route["fetch_edit_commission_state"] = "Main/fetch_edit_commission_state";
$route["edit_commission_state"] = "Main/edit_commission_state";
$route["delete_commission_state"] = "Main/delete_commission_state";


//
$route["motor_category"] = "ConfigCtrl/motor_category";
$route["add_motor_category"] = "ConfigCtrl/add_motor_category";
$route["fetch_motor_category"] = "ConfigCtrl/fetch_motor_category";

//Bike Model

$route["bike_model"] = "MasterCtrl/bike_model";
$route["fetch_bike_model"] = "MasterCtrl/fetch_bike_model";
$route["add_bike_model"] = "MasterCtrl/add_bike_model";
$route["fetch_edit_bike_model"] = "MasterCtrl/fetch_edit_bike_model";
$route["edit_bike_model"] = "MasterCtrl/edit_bike_model";
$route["delete_bike_model"] = "MasterCtrl/delete_bike_model";
$route["get_bike_brand_logo"] = "MasterCtrl/get_bike_brand_logo";

//Varient

$route["bike_varient"] = "MasterCtrl/bike_varient";
$route["fetch_bike_varient"] = "MasterCtrl/fetch_bike_varient";
$route["add_bike_varient"] = "MasterCtrl/add_bike_varient";
$route["fetch_edit_bike_varient"] = "MasterCtrl/fetch_edit_bike_varient";
$route["edit_bike_varient"] = "MasterCtrl/edit_bike_varient";
$route["delete_bike_varient"] = "MasterCtrl/delete_bike_varient";
$route["get_bike_model_list"] = "MasterCtrl/get_bike_model_list";
$route["fetch_brand_by_policy_id_pcv"] = "MasterCtrl/fetch_brand_by_policy_id_pcv";


// configctrl //

$route["reigion"] = "ConfigCtrl/reigion";
$route["add_reigion"] = "ConfigCtrl/add_reigion";
$route["fetch_reigion"] = "ConfigCtrl/fetch_reigion";
$route["fetch_edit_data"] = "ConfigCtrl/fetch_edit_data";
$route["edit_reigion"] = "ConfigCtrl/edit_reigion";

// users //
$route["create_users"] = "ConfigCtrl/create_users";
$route["add_users"] = "ConfigCtrl/add_users";
$route["fetch_users"] = "ConfigCtrl/fetch_users";
$route["get_ai_data"] = "ConfigCtrl/get_ai_data";
$route["fetch_edit_users_data"] = "ConfigCtrl/fetch_edit_users_data";
$route["edit_users"] = "ConfigCtrl/edit_users";
$route["delete_users"] = "ConfigCtrl/delete_users";


// pos //
$route["create_pos"] = "ConfigCtrl/create_pos";
$route["fetch_pos"] = "ConfigCtrl/fetch_pos";
$route["add_pos"] = "ConfigCtrl/add_pos";
$route["fetch_edit_pos_data"] = "ConfigCtrl/fetch_edit_pos_data";
$route["edit_pos"] = "ConfigCtrl/edit_pos";
$route["delete_pos"] = "ConfigCtrl/delete_pos";
//

// Agents //
$route["create_agent"] = "ConfigCtrl/create_agent";
$route["fetch_agent"] = "ConfigCtrl/fetch_agent";
$route["add_agent"] = "ConfigCtrl/add_agent";
$route["fetch_edit_agent_data"] = "ConfigCtrl/fetch_edit_agent_data";
$route["edit_agent"] = "ConfigCtrl/edit_agent";
$route["delete_agent"] = "ConfigCtrl/delete_agent";

// client type master //
$route["client_type"] = "ConfigCtrl/client_type";
$route["fetch_client_type"] = "ConfigCtrl/fetch_client_type";
$route["add_client_type"] = "ConfigCtrl/add_client_type";
$route["fetch_edit_client_type"] = "ConfigCtrl/fetch_edit_client_type";
$route["edit_client_type"] = "ConfigCtrl/edit_client_type";
$route["delete_client_type"] = "ConfigCtrl/delete_client_type";

// Bussiness type master //
$route["bussiness_type"] = "ConfigCtrl/bussiness_type";
$route["fetch_bussiness_type"] = "ConfigCtrl/fetch_bussiness_type";
$route["add_bussiness_type"] = "ConfigCtrl/add_bussiness_type";
$route["fetch_edit_bussiness_type"] = "ConfigCtrl/fetch_edit_bussiness_type";
$route["edit_bussiness_type"] = "ConfigCtrl/edit_bussiness_type";
$route["delete_bussiness_type"] = "ConfigCtrl/delete_bussiness_type";

// policy type master //

$route["policy_type"] = "ConfigCtrl/policy_type";
$route["fetch_policy_type"] = "ConfigCtrl/fetch_policy_type";
$route["fetch_car_fuel_types"] = "ConfigCtrl/fetch_car_fuel_types";
$route["add_policy_type"] = "ConfigCtrl/add_policy_type";
$route["fetch_edit_policy_type"] = "ConfigCtrl/fetch_edit_policy_type";
$route["edit_policy_type"] = "ConfigCtrl/edit_policy_type";


// lead creation //

$route["create_lead"] = "LeadCtrl/create_lead";
$route["add_lead_details"] = "LeadCtrl/add_lead_details";
$route["get_lead_details"] = "LeadCtrl/get_lead_details";
$route["add_follow_up_details"] = "LeadCtrl/add_follow_up_details";
$route["fetch_policy_type_using_class"] = "LeadCtrl/fetch_policy_type_using_class";
$route["get_fuel_type_by_vehicle"] = "LeadCtrl/get_fuel_type_by_vehicle";

//
$route["fetch_make"] = "LeadCtrl/fetch_make";
$route["fetch_model"] = "LeadCtrl/fetch_model";
$route["fetch_vechile_varient"] = "LeadCtrl/fetch_vechile_varient";
$route["get_exp_date"] = "LeadCtrl/get_exp_date";


//Manual generate policy
$route["manual_generate_policy"] = "LeadCtrl/manual_generate_policy";
$route["save_manual_generated_policy"] = "LeadCtrl/save_manual_generated_policy";
$route["commission_type_load"] = "LeadCtrl/commission_type_load";
$route["commission_category_load"] = "LeadCtrl/commission_category_load";
$route["vehicle_classification_load"] = "LeadCtrl/vehicle_classification_load";
$route["fetch_generate_policy"] = "LeadCtrl/fetch_generate_policy";//
$route["fetch_generate_policy_health"] = "LeadCtrl/fetch_generate_policy_health";//
$route["generate_policy1"] = "LeadCtrl/generate_policy1";
$route["manual_upload_policy_document_files"] = "LeadCtrl/manual_upload_policy_document_files";
$route["fetch_health_commission_company"] = "LeadCtrl/fetch_health_commission_company";

// prospect lead //

$route["move_lead_to_prospect"] = "LeadCtrl/move_lead_to_prospect";
$route["move_to_lead"] = "LeadCtrl/move_to_lead";
$route["move_classification"] = "LeadCtrl/move_classification";

// view all leads //
$route["leads"] = "LeadCtrl/leads";
$route["fetch_all_leads"] = "LeadCtrl/fetch_all_leads";

// Follow ups //
$route["followups"] = "LeadCtrl/followups";
$route["fetch_all_follow_ups"] = "LeadCtrl/fetch_all_follow_ups";
$route["fetch_edit_follow_up"] = "LeadCtrl/fetch_edit_follow_up";
$route["edit_follow_up_details"] = "LeadCtrl/edit_follow_up_details";
$route["delete_follow_up"] = "LeadCtrl/delete_follow_up";

// Add vechile Details //

$route["add_vechile_details"] = "LeadCtrl/add_vechile_details";
$route["get_vechile_details"] = "LeadCtrl/get_vechile_details";
$route["upload_document_files"] = "LeadCtrl/upload_document_files";

//Generate Policy //

$route["generate_policy"] = "LeadCtrl/generate_policy";
$route["upload_policy_document_files"] = "LeadCtrl/upload_policy_document_files";

$route["save_generated_policy"] = "LeadCtrl/save_generated_policy";


// Health 
$route["add_health_details"] = "LeadCtrl/add_health_details";

// email
$route["get_receiver_email_id"] = "LeadCtrl/get_receiver_email_id";
$route["fetch_email_content"] = "LeadCtrl/fetch_email_content";
$route["get_uploaded_documents"] = "LeadCtrl/get_uploaded_documents";
$route["send_mail"] = "LeadCtrl/send_mail";


// follow up log
$route["get_receiver_email_id"] = "LeadCtrl/get_receiver_email_id";

$route["fetch_followup_log"] = "LeadCtrl/fetch_followup_log";



// customers //
$route["customers"] = "LeadCtrl/customers";
$route["fetch_customers"] = "LeadCtrl/fetch_customers";

// Renewals //
$route["fetch_renewals"] = "LeadCtrl/fetch_renewals";

// Email Master //
$route["email_template"] = "ConfigCtrl/email_template";
$route["add_email_template"] = "ConfigCtrl/add_email_template";
$route["fetch_email_templates"] = "ConfigCtrl/fetch_email_templates";
$route["fetch_edit_email_templates"] = "ConfigCtrl/fetch_edit_email_templates";
$route["edit_email_template"] = "ConfigCtrl/edit_email_template";
$route["delete_email_template"] = "ConfigCtrl/delete_email_template";
$route["send_mail_to_all_customers"] = "ConfigCtrl/send_mail_to_all_customers";

// UPDATE 

$route["update_client_details"] = "LeadCtrl/update_client_details";
$route["update_requirement_details"] = "LeadCtrl/update_requirement_details";

// Edit vechicle Details 
$route["fetch_edit_vechicle_details"] = "LeadCtrl/fetch_edit_vechicle_details";
$route["get_seating_capacity"] = "LeadCtrl/get_seating_capacity";
$route["get_uploaded_vechicle_documents"] = "LeadCtrl/get_uploaded_vechicle_documents";
$route["get_vechicle_uploaded_file_by_id"] = "LeadCtrl/get_vechicle_uploaded_file_by_id";
$route["edit_vehicle_documents"] = "LeadCtrl/edit_vehicle_documents";
$route["delete_vechicle_documents"] = "LeadCtrl/delete_vechicle_documents";
$route["update_vechicle_details"] = "LeadCtrl/update_vechicle_details";
$route["fetch_vehicle_photos"] = "LeadCtrl/fetch_vehicle_photos";
$route["update_vehicle_photos"] = "LeadCtrl/update_vehicle_photos";

// Notification //
$route["get_recent_activities"] = "LeadCtrl/get_recent_activities";


// quotation 
$route["get_basic_informations"] = "LeadCtrl/get_basic_informations";

$route["add_quotations"] = "LeadCtrl/add_quotations";
$route["get_all_quotes"] = "LeadCtrl/get_all_quotes";
$route["generate_quotation"] = "LeadCtrl/generate_quotation";


$route["fetch_vechile_number_check"] = "LeadCtrl/fetch_vechile_number_check";


// Master Ctrl

// pets breed start

$route["pet_breed"] = "MasterCtrl/pet_breed";
$route["fetch_pets_breed"] = "MasterCtrl/fetch_pets_breed";
$route["add_pets_breed"] = "MasterCtrl/add_pets_breed";
$route["fetch_edit_pets_breed"] = "MasterCtrl/fetch_edit_pets_breed";
$route["edit_pets_breed"] = "MasterCtrl/edit_pets_breed";
// pets breed end

// company name start

$route["insurance_company"] = "MasterCtrl/insurance_company";
$route["fetch_company"] = "MasterCtrl/fetch_company";
$route["add_company_name"] = "MasterCtrl/add_company_name";
$route["fetch_edit_company"] = "MasterCtrl/fetch_edit_company";
$route["edit_company_name"] = "MasterCtrl/edit_company_name";
$route["create_insurance_company_ledger"] = "MasterCtrl/create_insurance_company_ledger";


// company name end

// motor end//


// bank name start

$route["bank_name"] = "MasterCtrl/bank_name";

$route["fetch_bank_name"] = "MasterCtrl/fetch_bank_name";

$route["add_bank_name"] = "MasterCtrl/add_bank_name";

$route["fetch_edit_bank_name"] = "MasterCtrl/fetch_edit_bank_name";

$route["edit_bank_name"] = "MasterCtrl/edit_bank_name";



// bank name end


// Claims //
$route["claim"] = "ClaimCtrl/claim";
$route["fetch_policy_no"] = "ClaimCtrl/fetch_policy_no";
$route["fetch_client_details_by_policy_no"] = "ClaimCtrl/fetch_client_details_by_policy_no";
$route["add_claim_details"] = "ClaimCtrl/add_claim_details";
$route["fetch_claims"] = "ClaimCtrl/fetch_claims";
$route["add_claim_report"] = "ClaimCtrl/add_claim_report";
$route["claim_view"] = "ClaimCtrl/claim_view";
$route["claim_follow_up"] ="ClaimCtrl/claim_follow_up";
$route["fetch_claim_dateils"] = "ClaimCtrl/fetch_claim_dateils";
$route["fetch_claim_contact_details"] ="ClaimCtrl/fetch_claim_contact_details";
$route["advanced_search"] = "ClaimCtrl/advanced_search";
$route["fetch_client_details_by_regn_no"] = "ClaimCtrl/fetch_client_details_by_regn_no";
$route["fetch_policy_info_details"] = "ClaimCtrl/fetch_policy_info_details";
$route["fetch_edit_claim_data"] = "ClaimCtrl/fetch_edit_claim_data";
 

// pet details

$route["add_pet_details"] = "LeadCtrl/add_pet_details";
$route["get_pet_details"] = "LeadCtrl/get_pet_details";


// property
$route["add_home_property"] = "LeadCtrl/add_home_property";
$route["add_business_details"] = "LeadCtrl/add_business_details";
$route["get_business_details"] = "LeadCtrl/get_business_details";
$route["commodity_change_load_sub_commodity"] = "LeadCtrl/commodity_change_load_sub_commodity";
$route["get_home_details"] = "LeadCtrl/get_home_details";


// maraine 
$route["marine_submit"] = "LeadCtrl/marine_submit";
$route["get_maraine_details"] = "LeadCtrl/get_maraine_details";



// master //
$route["motor_category"] = "ConfigCtrl/motor_category";
$route["add_motor_category"] = "ConfigCtrl/add_motor_category";
$route["fetch_motor_category"] = "ConfigCtrl/fetch_motor_category";
$route["fetch_edit_motor_category"] = "ConfigCtrl/fetch_edit_motor_category";
$route["edit_motor_category"] = "ConfigCtrl/edit_motor_category";

// GVW 
$route["motor_gvw"] = "ConfigCtrl/motor_gvw";
$route["fetch_motor_gvw"] = "ConfigCtrl/fetch_motor_gvw";
$route["add_motor_gvw"] = "ConfigCtrl/add_motor_gvw";
$route["fetch_edit_motor_gvw"] = "ConfigCtrl/fetch_edit_motor_gvw";
$route["edit_motor_gvw"] = "ConfigCtrl/edit_motor_gvw";
$route["delete_motor_sub_category"] = "ConfigCtrl/delete_motor_sub_category";


// commission category 
$route["commission_category"] = "ConfigCtrl/commission_category";
$route["fetch_commission_category"] = "ConfigCtrl/fetch_commission_category";
$route["fetch_commission_edit_category"] = "ConfigCtrl/fetch_commission_edit_category";
$route["edit_commission_category"] = "ConfigCtrl/edit_commission_category";


// payout commission 

$route["payout_commission"] = "ConfigCtrl/payout_commission";
$route["fetch_load_sub_category"] = "ConfigCtrl/fetch_load_sub_category";
$route["add_payout_commission"] = "ConfigCtrl/add_payout_commission";
$route["fetch_payout_commission"] = "ConfigCtrl/fetch_payout_commission";
$route["fetch_payout_commission_health"] = "ConfigCtrl/fetch_payout_commission_health";

$route["fetch_payout_commission_search"] = "ConfigCtrl/fetch_payout_commission_search";
$route["fetch_commission_details"] = "ConfigCtrl/fetch_commission_details";
$route["fetch_edit_commission_details"] = "ConfigCtrl/fetch_edit_commission_details";
$route["fetch_sub_category_list"] = "ConfigCtrl/fetch_sub_category_list";
$route["edit_payout_commission"] = "ConfigCtrl/edit_payout_commission";
$route["fetch_rto_list"] = "ConfigCtrl/fetch_rto_list";
$route["delete_commission_list"] = "ConfigCtrl/delete_commission_list";

$route["export_payout_commission"] = "ConfigCtrl/export_payout_commission";


// pos subcode //
$route["fetch_all_pos"] = "ConfigCtrl/fetch_all_pos";

// user privillages 

$route["add_user_permissions"] = "ConfigCtrl/add_user_permissions";
$route["fetch_user_permissions"] = "ConfigCtrl/fetch_user_permissions";
$route["check_add_permission"] = "ConfigCtrl/check_add_permission";
$route["check_add_permission_1"] = "MasterCtrl/check_add_permission_1";


// Bulk Lead Upload //

$route["upload_excel_data"] = "ReportCtrl/upload_excel_data";
$route["excell_data_file_get"] = "ReportCtrl/excell_data_file_get";
$route["fetch_agent_report_excel"] = "ReportCtrl/fetch_agent_report_excel";

// edit vechi
$route["get_policy_type"] = "LeadCtrl/get_policy_type";
// renewal 
$route["renewal"] = "LeadCtrl/renewal";
$route["get_client_details_by_lead_id"] = "LeadCtrl/get_client_details_by_lead_id";
$route["add_renewal_lead_details"] = "LeadCtrl/add_renewal_lead_details";

// view 
$route["view_lead_details"] = "LeadCtrl/view_lead_details";

// profile admin start 
$route["profile_admin"] = "ProfileCtrl/profile_admin";
$route["add_profile_admin"] = "ProfileCtrl/add_profile_admin";
// rto
$route["fetch_rto_list_new"] = "ConfigCtrl/fetch_rto_list_new";


// Fix Agent Commission 

$route["agent_commission_closure"] = "ReportCtrl/agent_commission_closure";
$route["fetch_policy_report"] = "ReportCtrl/fetch_policy_report";
$route["fix_agent_commission"] = "ReportCtrl/fix_agent_commission";
$route["agent_commission_report"] = "ReportCtrl/agent_commission_report";
$route["fetch_all_agents_list"] = "ReportCtrl/fetch_all_agents_list";
$route["fetch_agent_commision_report"] = "ReportCtrl/fetch_agent_commision_report";
$route["fetch_agent_commision_report_excel"] = "ReportCtrl/fetch_agent_commision_report_excel";

//Invoice
$route["insurance_invoice_generation"] = "ReportCtrl/insurance_invoice_generation";
$route["load_all_insurances_list"] = "ReportCtrl/load_all_insurances_list";
$route["single_insurance_policies"] = "ReportCtrl/single_insurance_policies";
$route["insurance_commision_vocher_pdf"] = "ReportCtrl/insurance_commision_vocher_pdf";
$route["save_insurance_policy"] = "ReportCtrl/save_insurance_policy";
$route["company_vocher_pdf"] = "ReportCtrl/company_invoice_pdf"; //"ReportCtrl/company_vocher_pdf";
$route["company_vocher_orc_pdf"] = "ReportCtrl/company_vocher_orc_pdf";

// Invoice Report as on 2023-04-12
$route["company_invoice_report"] = "ReportCtrl/company_invoice_report";
$route["fetch_company_invoice_report"] = "ReportCtrl/fetch_company_invoice_report";


// Vocher

$route["agent_vocher_generation"] = "ReportCtrl/agent_vocher_generation";
$route["single_agent_policies"] = "ReportCtrl/single_agent_policies";
$route["generate_vocher"] = "ReportCtrl/generate_vocher";
$route["agent_vocher_pdf"] = "ReportCtrl/agent_vocher_pdf";
$route["agent_vocher_orc_pdf"] = "ReportCtrl/agent_vocher_orc_pdf";

$route["agent_voucher_payment"] = "ReportCtrl/agent_voucher_payment";
$route["fetch_agent_voucher"] = "ReportCtrl/fetch_agent_voucher";
$route["get_voucher_total"] = "ReportCtrl/get_voucher_total";
$route["fetch_agent_advance_list"] = "ReportCtrl/fetch_agent_advance_list";
$route["fetch_adv_amount_by_agn_id"] = "ReportCtrl/fetch_advance_amount_by_agent_id";
$route["add_agn_payment_entry"] = "ReportCtrl/add_agn_payment_entry";
$route["company_vocher_excel"] = "ReportCtrl/company_vocher_excel";


// advance
$route["agent_advance"] = "AdvanceCtrl/agent_advance";
$route["fetch_load_agents"] = "AdvanceCtrl/fetch_load_agents";
$route["add_advance_amount"] = "AdvanceCtrl/add_advance_amount";
$route["fetch_agent_advance"] = "AdvanceCtrl/fetch_agent_advance";



$route["cheque_details"] = "ChequeCtrl/cheque_details";
$route["fetch_cheque_details"] = "ChequeCtrl/fetch_cheque_details";

//active policy Report

$route["active_policy_report"] = "ReportCtrl/active_policy_report";
$route["fetch_policy_type_1"] = "ReportCtrl/fetch_policy_type_1";
$route["fetch_active_policy_report"] = "ReportCtrl/fetch_active_policy_report";
$route["fetch_active_policy_report_excel"] = "ReportCtrl/fetch_active_policy_report_excel";

// payout entry
$route["payout_entry"] = "PayoutCtrl/payout_entry";
$route["fetch_make_arr"] = "PayoutCtrl/fetch_make_arr";
$route["fetch_model_arr"] = "PayoutCtrl/fetch_model_arr";
$route["fetch_vechile_varient_arr"] = "PayoutCtrl/fetch_vechile_varient_arr";
$route["add_payout_entry"] = "PayoutCtrl/add_payout_entry";

$route["check_payout_entry_already_exits"] = "PayoutCtrl/check_payout_entry_already_exits";
$route["fetch_classification"] = "PayoutCtrl/fetch_classification";
$route["fetch_payout_entry"] = "PayoutCtrl/fetch_payout_entry";
$route["view_payout_commission_details"] = "PayoutCtrl/view_payout_commission_details";
$route["check_commission_status"] = "LeadCtrl/check_commission_status";

//Scooter Brand
$route["scooter_brand"] = "ConfigCtrl/scooter_brand";
$route["fetch_scooter_brand"] = "ConfigCtrl/fetch_scooter_brand";
$route["add_scooter_brand"] = "ConfigCtrl/add_scooter_brand";
$route["fetch_edit_scooter_brand"] = "ConfigCtrl/fetch_edit_scooter_brand";
$route["edit_scooter_brand"] = "ConfigCtrl/edit_scooter_brand";
$route["delete_scooter_brand"] = "ConfigCtrl/delete_scooter_brand";
$route["get_scooter_brand_logo"] = "ConfigCtrl/get_scooter_brand_logo";

//Scooter Model
$route["scooter_model"] = "ConfigCtrl/scooter_model";
$route["fetch_scooter_model"] = "ConfigCtrl/fetch_scooter_model";
$route["add_scooter_model"] = "ConfigCtrl/add_scooter_model";
$route["fetch_edit_scooter_model"] = "ConfigCtrl/fetch_edit_scooter_model";
$route["edit_scooter_model"] = "ConfigCtrl/edit_scooter_model";
$route["delete_scooter_model"] = "ConfigCtrl/delete_scooter_model";
$route["get_bike_brand_logo"] = "ConfigCtrl/get_bike_brand_logo";

// scooter varient
$route["get_scooter_model_list"] = "ConfigCtrl/get_scooter_model_list";
$route["scooter_varient"] = "ConfigCtrl/scooter_varient";
$route["fetch_scooter_varient"] = "ConfigCtrl/fetch_scooter_varient";
$route["add_scooter_varient"] = "ConfigCtrl/add_scooter_varient";
$route["fetch_edit_scooter_varient"] = "ConfigCtrl/fetch_edit_scooter_varient";
$route["edit_scooter_varient"] = "ConfigCtrl/edit_scooter_varient";
$route["delete_scooter_varient"] = "ConfigCtrl/delete_scooter_varient";
$route["get_bike_model_list"] = "ConfigCtrl/get_bike_model_list";

//E TWO WHEELER Brand
$route["electric_two_wheeler_brand"] = "ConfigCtrl/electric_two_wheeler_brand";
$route["fetch_electric_two_wheeler_brand"] = "ConfigCtrl/fetch_electric_two_wheeler_brand";
$route["add_electric_two_wheeler_brand"] = "ConfigCtrl/add_electric_two_wheeler_brand";
$route["fetch_edit_electric_two_wheeler_brand"] = "ConfigCtrl/fetch_edit_electric_two_wheeler_brand";
$route["edit_electric_two_wheeler_brand"] = "ConfigCtrl/edit_electric_two_wheeler_brand";
$route["delete_electric_two_wheeler_brand"] = "ConfigCtrl/delete_electric_two_wheeler_brand";
$route["get_electric_two_wheeler_brand_logo"] = "ConfigCtrl/get_electric_two_wheeler_brand_logo";

//E TWO WHEELER Model
$route["electric_two_wheeler_model"] = "ConfigCtrl/electric_two_wheeler_model";
$route["fetch_electric_two_wheeler_model"] = "ConfigCtrl/fetch_electric_two_wheeler_model";
$route["add_electric_two_wheeler_model"] = "ConfigCtrl/add_electric_two_wheeler_model";
$route["fetch_edit_electric_two_wheeler_model"] = "ConfigCtrl/fetch_edit_electric_two_wheeler_model";
$route["edit_electric_two_wheeler_model"] = "ConfigCtrl/edit_electric_two_wheeler_model";
$route["delete_electric_two_wheeler_model"] = "ConfigCtrl/delete_electric_two_wheeler_model";
$route["get_bike_brand_logo"] = "ConfigCtrl/get_bike_brand_logo";

// E TWO WHEELER varient

$route["get_electric_two_wheeler_model_list"] = "ConfigCtrl/get_electric_two_wheeler_model_list";
$route["electric_two_wheeler_varient"] = "ConfigCtrl/electric_two_wheeler_varient";
$route["fetch_electric_two_wheeler_varient"] = "ConfigCtrl/fetch_electric_two_wheeler_varient";
$route["add_electric_two_wheeler_varient"] = "ConfigCtrl/add_electric_two_wheeler_varient";
$route["fetch_edit_electric_two_wheeler_varient"] = "ConfigCtrl/fetch_edit_electric_two_wheeler_varient";
$route["edit_electric_two_wheeler_varient"] = "ConfigCtrl/edit_electric_two_wheeler_varient";
$route["delete_electric_two_wheeler_varient"] = "ConfigCtrl/delete_electric_two_wheeler_varient";
$route["get_bike_model_list"] = "ConfigCtrl/get_bike_model_list";

$route["delete_commission_entry"] = "PayoutCtrl/delete_commission_entry";


//Ranjith Work
$route["payout_entry1"] = "Main/payout_entry1";
$route["edit_commission_entry"] = "PayoutCtrl/edit_commission_entry";
$route["edit_check_payout_entry"] = "PayoutCtrl/edit_check_payout_entry";
$route["edit_payout_entry"] = "PayoutCtrl/edit_payout_entry";//
$route["manual_generate_policy_new"] = "Main/manual_generate_policy_new";
$route["check_commission_status_new"] = "Main/check_commission_status_new";
$route["save_manual_generated_policy_new"] = "Main/save_manual_generated_policy_new";

// Excel

$route["payout_commission_excel"] = "PayoutCtrl/payout_commission_excel";

// Direct Renewals 

$route["direct_renewals"] = "LeadCtrl/direct_renewals";
$route["fetch_direct_renewals"] = "LeadCtrl/fetch_direct_renewals";
$route["direct_renewals_excel"] = "LeadCtrl/direct_renewals_excel";

// nominee details
$route["add_nominee_details"] = "LeadCtrl/add_nominee_details";
$route["get_nominee_details"] = "LeadCtrl/get_nominee_details";
$route["check_policy_commission_status"] = "LeadCtrl/save_generated_policy";

// pcv seating

$route["pcv_seating"] = "MasterCtrl/pcv_seating";
$route["fetch_pcv_seating"] = "MasterCtrl/fetch_pcv_seating";
$route["add_pcv_seating"] = "MasterCtrl/add_pcv_seating";
// grid

$route["payout_grid"] = "PayoutCtrl/payout_grid";
$route["add_payout_grid"] = "PayoutCtrl/add_payout_grid";
$route["fetch_payout_grid"] = "PayoutCtrl/fetch_payout_grid";
$route["fetch_edit_payout_grid"] = "PayoutCtrl/fetch_edit_payout_grid";
$route["edit_payout_grid"] = "PayoutCtrl/edit_payout_grid";

// pcv seating

$route["fetch_pcv_seating_capacity"] = "LeadCtrl/fetch_pcv_seating_capacity";
$route["get_bike_model_list"] = "MasterCtrl/get_bike_model_list";
$route["fetch_edit_pcv_seating_capacity"] = "LeadCtrl/fetch_edit_pcv_seating_capacity";
$route["fetch_area_incharge"] = "ConfigCtrl/fetch_area_incharge";
$route["edit_area_incharge"] = "ConfigCtrl/edit_area_incharge";

$route["get_swap_ai_data"] = "ConfigCtrl/get_swap_ai_data";

$route["swap_ai_data"] = "ConfigCtrl/swap_ai_data";


$route["fetch_area_incharge_by_agent"] = "LeadCtrl/fetch_area_incharge_by_agent";

// Temp data

$route["check_policy_no_already_exits"] = "LeadCtrl/check_policy_no_already_exits";
$route["get_temp_data"] = "LeadCtrl/get_temp_data";
$route["temp_save_policy"] = "LeadCtrl/temp_save_policy";

// Business Complete

$route["business_complete"] = "LeadCtrl/business_complete";
$route["fetch_business_complete"] = "LeadCtrl/fetch_business_complete";
$route["view_business_complete_details"] = "LeadCtrl/view_business_complete_details";
$route["add_lead_files"] = "LeadCtrl/add_lead_files";




// Invoice
$route["invoice"] = "InvoiceCtrl/invoice";
$route["get_all_policies"] = "InvoiceCtrl/get_all_policies";
$route["get_invoice"] = "InvoiceCtrl/get_invoice";

// filter
$route["filter_commission_motor"] = "PayoutCtrl/filter_commission_motor";

// Health
$route["fetch_edit_health_details"] = "LeadCtrl/fetch_edit_health_details";
$route["edit_health_details"] = "LeadCtrl/edit_health_details";
$route["check_this_lead_already_in_policy"] = "LeadCtrl/check_this_lead_already_in_policy";
$route["fetch_all_completed_policy"] = "Main/fetch_all_completed_policy";

// excel lead
$route["download_leads_excel"] = "ReportCtrl/download_leads_excel";

$route["district"] = "MasterCtrl/district";
$route["fetch_district"] = "MasterCtrl/fetch_district";
$route["add_district"] = "MasterCtrl/add_district";
$route["fetch_edit_district"] = "MasterCtrl/fetch_edit_district";
$route["edit_district"] = "MasterCtrl/edit_district";
$route["update_quote_status"] = "LeadCtrl/update_quote_status";
$route["check_vehi_regn_no"] = "LeadCtrl/check_vehi_regn_no";
$route["fetch_users_by_region"] = "ConfigCtrl/fetch_users_by_region";
$route["fetch_user_by_agent"] = "LeadCtrl/fetch_user_by_agent";

// remove all rto 
$route["remove_all_rto"] = "PayoutCtrl/remove_all_rto";
// update
$route["update_temp_policy"] = "LeadCtrl/update_temp_policy";
$route["get_agent_bank_details"] = "ReportCtrl/get_agent_bank_details";
$route["agent_payment_details"] = "ReportCtrl/agent_payment_details";
$route["fetch_agent_payment_details"] = "ReportCtrl/fetch_agent_payment_details";
$route["agent_vocher_payment_details"] = "ReportCtrl/agent_vocher_payment_details";
$route["agent_vocher_print"] = "ReportCtrl/agent_vocher_print";
$route["get_commission_details_by_id"] = "PayoutCtrl/get_commission_details_by_id";


// Agent Business Report
$route["agent_business_report"] = "ReportCtrl/agent_business_report";
$route["fetch_agent_business_report"] = "ReportCtrl/fetch_agent_business_report";
$route["agent_business_report_excel"] = "ReportCtrl/agent_business_report_excel";

// old log
$route["view_old_log"] = "PayoutCtrl/view_old_log";
$route["get_old_entry"] = "PayoutCtrl/get_old_entry";


// Rto View

$route["load_all_rto"] = "PayoutCtrl/load_all_rto";
$route["load_motors_list"] = "PayoutCtrl/load_motors_list";
$route["load_agent_commission"] = "PayoutCtrl/load_agent_commission";

// New

$route["fetch_payout_commission_entry"] = "PayoutCtrl/fetch_payout_commission_entry";
$route["view_payout_commission_entry"] = "PayoutCtrl/view_payout_commission_entry";
$route["edit_commission_entry_motor"] = "PayoutCtrl/edit_commission_entry_motor";
$route["check_payout_entry"] = "PayoutCtrl/check_payout_entry";
$route["careapi"] = "MasterCtrl/careapi";

// Reports 

$route["policy_failure_report"] = "ReportCtrl/policy_failure_report";
$route["fetch_policy_failure_report"] = "ReportCtrl/fetch_policy_failure_report";
$route["fetch_policy_failure_report_excel"] = "ReportCtrl/fetch_policy_failure_report_excel";

//

$route["get_foe"] = "ConfigCtrl/get_foe";
$route["change_foe_active_records"] = "ConfigCtrl/change_foe_active_records";
$route["policy_renewal_report"] = "ReportCtrl/policy_renewal_report";
$route["fetch_agent_business_details"] = "Main/fetch_agent_business_details";
$route["fetch_bc_with_area_incharge"] = "Main/fetch_bc_with_area_incharge";
$route["fetch_renewals_with_area_incharge"] = "Main/fetch_renewals_with_area_incharge";
$route["forward_check_payout_entry"] = "PayoutCtrl/forward_check_payout_entry";
$route["forward_to_next_month"] = "PayoutCtrl/forward_to_next_month";
$route["update_generated_policy"] = "LeadCtrl/update_generated_policy";

$route["change_ai_active_records"] = "ConfigCtrl/change_ai_active_records";

$route["fetch_mismatch_list"] = "ConfigCtrl/fetch_mismatch_list";
$route["mismatching_list"] = "ConfigCtrl/mismatching_list";


$route["trigger_commissions"] = "ConfigCtrl/trigger_commissions";
$route["trigger_commission_amounts"] = "ConfigCtrl/trigger_commission_amounts";
$route["calculate_commissions"] = "ConfigCtrl/calculate_commissions";


// Voucher Pending

$route["agent_voucher_pending"] = "ReportCtrl/agent_voucher_pending";
$route["fetch_agent_voucher_pending"] = "ReportCtrl/fetch_agent_voucher_pending";
$route["view_health_payout_commission_entry"] = "PayoutCtrl/view_health_payout_commission_entry";
$route["edit_commission_entry_health"] = "PayoutCtrl/edit_commission_entry_health";

// Accounts
$route["Accounttree"] = "AccountsCtrl/Accounttree";
$route["fetch_main_ledgers"] = "AccountsCtrl/fetch_main_ledgers";
$route["fetch_all_sub_ledgers"] = "AccountsCtrl/fetch_all_sub_ledgers";
$route["add_sub_ledger"] = "AccountsCtrl/add_sub_ledger";
$route["add_multi_sub_ledger"] = "AccountsCtrl/add_multi_sub_ledger";
$route["fetch_accounts_tree"] = "AccountsCtrl/fetch_accounts_tree";
$route["get_child_account_tree"] = "AccountsCtrl/get_child_account_tree";
$route["feo_report"] = "ReportCtrl/feo_report";

//
$route["general_receipt"] = "AccountsCtrl/general_receipt";

$route["getAccountInfo"] = "AccountsCtrl/getAccountInfo";


$route["jointcall"] = "MasterCtrl/joinecall";
$route["fetch_bussinesscall"] = "MasterCtrl/fetch_bussinesscall";
$route["fetch_edit_joinecall"] = "MasterCtrl/fetch_edit_joinecall";
$route["edit_joine_call"]="MasterCtrl/edit_joine_call";


$route["add_bussinesscalldetails"] = "MasterCtrl/add_bussinesscalldetails";
$route["delete_joinecall"]="MasterCtrl/delete_joinecall";
$route["fetch_view_joinecall"]="MasterCtrl/fetch_view_joinecall";
$route["delete_files"]="MasterCtrl/delete_files";



//journalvoucher//
$route["journalvoucher"]="MasterCtrl/journalvoucher";
$route["add_journalvoucher"]="MasterCtrl/add_journalvoucher";
$route["fetch_particulars_by_account_head"] = "MasterCtrl/fetch_particulars_by_account_head";

$route["bankstatement"]="MasterCtrl/bankstatement";




$route["get_sub_ledgers_by_accid"] = "AccountsCtrl/get_sub_ledgers_by_accid";
$route["add_general_receipt"] = "AccountsCtrl/add_general_receipt";
$route["print_general_receipt"] = "AccountsCtrl/print_general_receipt";
$route["main_cash_voucher"] = "AccountsCtrl/main_cash_voucher";
$route["get_particulars_by_account_head"] = "AccountsCtrl/get_particulars_by_account_head";
$route["add_mv_receipt"] = "AccountsCtrl/add_mv_receipt";
$route["fetch_cash_balance"] = "AccountsCtrl/fetch_cash_balance";
//renewal lead
$route["renewallead"]="Renewalcontrol/renewallead";
$route["fetch_renewallead"]="Renewalcontrol/fetch_renewallead";

//renewal breakup by kgk on 2023-02-13
$route["renewal_details/(:any)"]="Renewalcontrol/DueRenewals/$1";

//failue_leads
$route["failurelead"]="Renewalcontrol/failurelead";
$route["fetch_failurelead"]="Renewalcontrol/fetch_failurelead";
$route["fetch_export_excel"]="Renewalcontrol/fetch_export_excel";
$route["fetch_renewal_export_excel"]="Renewalcontrol/fetch_renewal_export_excel";
//
$route["include_rtos"]="PayoutCtrl/include_rtos";
//AI Performance Report
$route["ai_performance_report"]="MasterCtrl/ai_performance_report";
$route["fetch_policy_type_by_class"]="MasterCtrl/fetch_policy_type_by_class";
$route["fetch_area_incharge_salary"]="MasterCtrl/fetch_area_incharge_salary";
$route["add_ai_performance"]="MasterCtrl/add_ai_performance";
$route["fetch_ai_performance"]="MasterCtrl/fetch_ai_performance";
$route["fetch_performance_details"]="MasterCtrl/fetch_performance_details";
//
$route["export_excel_business_calls"]="MasterCtrl/export_excel_business_calls";
$route["fetch_performance_records"]="MasterCtrl/fetch_performance_records";
$route["fetch_insurer_details"] ="MasterCtrl/fetch_insurer_details";
$route["add_leave_permission"] = "MasterCtrl/add_leave_permission";
$route["fetch_leavepermission"]="MasterCtrl/fetch_leavepermission";


//smedetails//
$route["smedetails"] ="ProfileCtrl/smedetails";
$route["add_smedetails"] = "ProfileCtrl/add_smedetails";


//sme policy//
$route["smepolicytype"] ="ProfileCtrl/smepolicytype";
$route["fetch_policy"] ="ProfileCtrl/fetch_policy";
$route["add_policy"] ="ProfileCtrl/add_policy";
$route["fetch_edit_smepolicy"] ="ProfileCtrl/fetch_edit_smepolicy";
$route["edit_sempolicy"] ="ProfileCtrl/edit_sempolicy";
$route["delete_policy"] ="ProfileCtrl/delete_policy";


// Extra commission
$route["extra_payout"] = "PayoutCtrl/extra_payout";
$route["add_extra_com_details"] = "PayoutCtrl/add_extra_com_details";
$route["fetch_extra_commission"] = "PayoutCtrl/fetch_extra_commission";
$route["fetch_agent_extra_com_details"] = "PayoutCtrl/fetch_agent_extra_com_details";

$route["extra_commission_calc"] = "ConfigCtrl/extra_commission_calc";
$route["fetch_sme_policy_details"] = "LeadCtrl/fetch_sme_policy_details";
$route["save_sme_details"] = "LeadCtrl/save_sme_details";
$route["upload_sme_files"] = "LeadCtrl/upload_sme_files";

$route["fetch_quote_files"] = "LeadCtrl/fetch_quote_files";
$route["fetch_policy_documents"] = "LeadCtrl/fetch_policy_documents";
$route["fetch_edit_performance"] = "MasterCtrl/fetch_edit_performance";
$route["fetch_edit_policy_type_by_class"] = "MasterCtrl/fetch_edit_policy_type_by_class";
$route["edit_ai_performance"] = "MasterCtrl/edit_ai_performance";

$route["fetch_exiting_clients"] = "MasterCtrl/fetch_exiting_clients";
$route["add_ex_business"] = "MasterCtrl/add_ex_business";
$route["fetch_ai_daily_report"] = "MasterCtrl/fetch_ai_daily_report";
$route["ai_daily_report_excel"] = "MasterCtrl/ai_daily_report_excel";
$route["fetch_total_premium"] = "LeadCtrl/fetch_total_premium";
$route["add_sme_commission"] = "LeadCtrl/add_sme_commission";
$route["fetch_generate_policy_sme"] = "LeadCtrl/fetch_generate_policy_sme";

$route["acc_own_commission"] = "AccountsCtrl/acc_own_commission";
$route["acc_agn_commission"] = "AccountsCtrl/acc_agn_commission";

$route["acc_own_commission_ledg"] = "LeadCtrl/acc_own_commission_ledg";
$route["acc_agn_commission_ledg"] = "LeadCtrl/acc_agn_commission_ledg";


$route["view_accounts_ledger"] = "AccountsCtrl/view_accounts_ledger";
$route["fetch_view_accounts_ledger"] = "AccountsCtrl/fetch_view_accounts_ledger";
$route["export_view_accounts_ledger_excel"] = "AccountsCtrl/export_view_accounts_ledger_excel";

$route["view_agent_ledger"] = "AccountsCtrl/view_agent_ledger";
$route["fetch_view_agent_ledger"] = "AccountsCtrl/fetch_view_agent_ledger";
$route["export_view_agent_ledger_excel"] = "AccountsCtrl/export_view_agent_ledger_excel";

$route["view_company_ledger"] = "AccountsCtrl/view_company_ledger";
$route["fetch_view_company_ledger"] = "AccountsCtrl/fetch_view_company_ledger";
$route["export_view_company_ledger_excel"] = "AccountsCtrl/export_view_company_ledger_excel";

$route["agent_ledger_view"] = "AccountsCtrl/agent_ledger_view";
$route["fetch_agent_ledger_view"] = "AccountsCtrl/fetch_agent_ledger_view";
$route["export_agent_ledger_view_excel"] = "AccountsCtrl/export_agent_ledger_view_excel";

//Dealers
$route["dealers"] = "ConfigCtrl/dealers";
$route["add_dealer_details"] = "ConfigCtrl/add_dealer_details";
$route["fetch_dealers"] = "ConfigCtrl/fetch_dealers";
$route["fetch_dealers_contact_info"] = "ConfigCtrl/fetch_dealers_contact_info";
$route["export_dealers"] = "ConfigCtrl/export_dealers";
$route["fetch_edit_dealers"] = "ConfigCtrl/fetch_edit_dealers";
$route["edit_dealer_details"] = "ConfigCtrl/edit_dealer_details";
$route["monthly_report"] = "ReportCtrl/monthly_report";
$route["fetch_monthly_report"] = "ReportCtrl/fetch_monthly_report";

// Business Call
$route["add_dealer_followup"]="MasterCtrl/add_dealer_followup";
$route["fetch_agents"]="MasterCtrl/fetch_agents";
$route["add_agn_business"]="MasterCtrl/add_agn_business";

// Accounts
$route["fetch_main_sub_ledgers"]="AccountsCtrl/fetch_main_sub_ledgers";
$route["agent_com_ledger"]="AccountsCtrl/agent_com_ledger";
$route["insurance_com_ledger"]="AccountsCtrl/insurance_com_ledger";


// search
$route["search_report"]="ClaimCtrl/search_report";


// Ambulance Brand

$route["ambulance_brand"]="MasterCtrl/ambulance_brand";
$route["fetch_ambulance_brand"] = "MasterCtrl/fetch_ambulance_brand";
$route["add_ambulance_brand"] = "MasterCtrl/add_ambulance_brand";
$route["fetch_edit_ambulance_brand"] = "MasterCtrl/fetch_edit_ambulance_brand";
$route["edit_ambulance_brand"] = "MasterCtrl/edit_ambulance_brand";
$route["delete_ambulance_brand"] = "MasterCtrl/delete_ambulance_brand";


//Ambulance Model

$route["ambulance_model"] = "MasterCtrl/ambulance_model";

// test
$route["ambulance_model1"] = "MasterCtrl/ambulance_model1";
$route["add_ambulance_model1"] = "MasterCtrl/add_ambulance_model1";
$route["edit_ambulance_model1"] = "MasterCtrl/edit_ambulance_model1";
// test end

$route["fetch_ambulance_model"] = "MasterCtrl/fetch_ambulance_model";
$route["add_ambulance_model"] = "MasterCtrl/add_ambulance_model";
$route["fetch_edit_ambulance_model"] = "MasterCtrl/fetch_edit_ambulance_model";
$route["edit_ambulance_model"] = "MasterCtrl/edit_ambulance_model";
$route["delete_ambulance_model"] = "MasterCtrl/delete_ambulance_model";
$route["get_ambulance_logo"] = "MasterCtrl/get_ambulance_logo";


//Ambulance Fuel Type

$route["ambulance_fuel_type"] = "MasterCtrl/ambulance_fuel_type";
$route["fetch_ambulance_fuel_type"] = "MasterCtrl/fetch_ambulance_fuel_type";
$route["add_ambulance_fuel_type"] = "MasterCtrl/add_ambulance_fuel_type";
$route["fetch_edit_ambulance_fuel_type"] = "MasterCtrl/fetch_edit_ambulance_fuel_type";
$route["edit_ambulance_fuel_type"] = "MasterCtrl/edit_ambulance_fuel_type";
$route["delete_ambulance_fuel_type"] = "MasterCtrl/delete_ambulance_fuel_type";


//Ambulance Varient

$route["ambulance_varient"] = "MasterCtrl/ambulance_varient";
$route["fetch_ambulance_varient"] = "MasterCtrl/fetch_ambulance_varient";
$route["add_ambulance_varient"] = "MasterCtrl/add_ambulance_varient";
$route["fetch_edit_ambulance_varient"] = "MasterCtrl/fetch_edit_ambulance_varient";
$route["edit_ambulance_varient"] = "MasterCtrl/edit_ambulance_varient";
$route["delete_ambulance_varient"] = "MasterCtrl/delete_ambulance_varient";
$route["fetch_ambulance_model"] = "MasterCtrl/fetch_ambulance_model";



// Upload Active Policy to temp Data

$route["upload_temp_data"] = "ConfigCtrl/upload_temp_data";
$route["upload_data"] = "ConfigCtrl/upload_data";



//complete claim

$route["add_complete_claim"] = "ClaimCtrl/add_complete_claim";
$route["fetch_complete_claim"] = "ClaimCtrl/fetch_complete_claim";
$route["upload_claim_document_files"] = "ClaimCtrl/upload_claim_document_files";

//
$route["test_check_commission_status"] = "LeadCtrl/test_check_commission_status";
$route["update_active_policy_com"] = "ConfigCtrl/update_active_policy_com";
$route["update_commissions"] = "ConfigCtrl/update_commissions";
$route["existing_insurance_com_ledger"] = "MasterCtrl/existing_insurance_com_ledger";

$route["create_agent_ledger"] = "ConfigCtrl/create_agent_ledger";
$route["agent_payment_voucher"] ="AccountsCtrl/agent_payment_voucher";



//school

$route["Institution"] = "ConfigCtrl/schools";
$route["add_school_details"] = "ConfigCtrl/add_school_details";
$route["fetch_schools"] = "ConfigCtrl/fetch_schools";
$route["edit_school_details"] ="ConfigCtrl/edit_school_details";
$route["fetch_school_contact_info"] = "ConfigCtrl/fetch_school_contact_info";
$route["fetch_edit_school"] = "ConfigCtrl/fetch_edit_school";
$route["export_schools"] = "ConfigCtrl/export_schools";

$route["school_documents_remove"] = "ConfigCtrl/school_documents_remove";
$route["school_document_download/(:num)"] = "ConfigCtrl/download/$1";

$route["add_due_date"] = "LeadCtrl/add_due_date";
$route["bank"] = "AccountsCtrl/bank";
$route["add_bank_details"] = "AccountsCtrl/add_bank_details";
$route["fetch_bank"] = "AccountsCtrl/fetch_bank";
$route["fetch_edit_bank_dateils"] = "AccountsCtrl/fetch_edit_bank_dateils";
$route["edit_Bank_details"] = "AccountsCtrl/edit_Bank_details";
$route["delete_bank_details"] ="AccountsCtrl/delete_bank_details";
$route["add_agent_receipt"] = "AccountsCtrl/add_agent_receipt";


// cheque book//
$route["cheque_book"] = "AdvanceCtrl/cheque_book";
$route["delete_cheque_details"] = "AdvanceCtrl/delete_cheque_details";
$route["fetch_bank_details"] = "AdvanceCtrl/fetch_bank_details";
$route["add_cheque_book_details"] = "AdvanceCtrl/add_cheque_book_details";
$route["fetch_cheque_details"] = "AdvanceCtrl/fetch_cheque_details";
$route["fetch_edit_cheque_details"] = "AdvanceCtrl/fetch_edit_cheque_details";
$route["edit_cheque_book_details"] = "AdvanceCtrl/edit_cheque_book_details";
$route["generate_cheque_book"] = "AdvanceCtrl/generate_cheque_book";
$route["fetch_book_entry_details"] = "AdvanceCtrl/fetch_book_entry_details";
$route["fetch_using_cheque_details"] = "AdvanceCtrl/fetch_using_cheque_details";
$route["add_cheque_status"] = "AdvanceCtrl/add_cheque_status";
$route["cheque_entry"] = "AdvanceCtrl/cheque_entry";
$route["add_cheque_entry"] = "AdvanceCtrl/add_cheque_entry";
$route["update_cheque_entry"] = "AdvanceCtrl/update_cheque_entry";
$route["received_cheque_Info"] = "AdvanceCtrl/received_cheque_Info";

$route["fetch_agent_poilicy_list"] = "ReportCtrl/fetch_agent_poilicy_list";
$route["fetch_all_policy_list"] = "ReportCtrl/fetch_all_policy_list";
$route["get_policy_data"] = "ReportCtrl/get_policy_data";
$route["update_policy_hold_list"] = "ReportCtrl/update_policy_hold_list";
$route["policy_cancel_report"] = "ReportCtrl/policy_cancel_report";
$route["fetch_policy_cancel_report"] = "ReportCtrl/fetch_policy_cancel_report";
$route["updata_policy_recover"] = "ReportCtrl/updata_policy_recover";
$route["fetch_agent_policy_insurance_company"] = "ReportCtrl/fetch_agent_policy_insurance_company";


//create ledger//
$route["create_commission_ledger"] = "AccountsCtrl/create_commission_ledger";
$route["add_insur_company_ledger"] = "AccountsCtrl/add_insur_company_ledger";
$route["agent_account_ledger"] = "AccountsCtrl/agent_account_ledger";
$route["fetch_all_agents"] = "AccountsCtrl/fetch_all_agents";
$route["add_agent_ledger"] = "AccountsCtrl/add_agent_ledger";

$route["fetch_temp_lead"] = "LeadCrtl/fetch_temp_lead";


//Permission Group
$route["privileges"]              = "PrivilegeController/index";
$route["list_privileges"]         = "PrivilegeController/getLists";
$route["create_privilege"]        = "PrivilegeController/create";
$route["store_privilege"]         = "PrivilegeController/store";
$route["update_privilege/(:num)"] = "PrivilegeController/update/$1";
$route["delete_privilege/(:num)"] = "PrivilegeController/delete/$1";

//Permission
$route["permissions"]              = "PermissionController/index";
$route["list_permissions"]         = "PermissionController/getLists";
$route["create_permission"]        = "PermissionController/create";
$route["store_permission"]         = "PermissionController/store";
$route["update_permission/(:num)"] = "PermissionController/update/$1";
$route["delete_permission/(:num)"] = "PermissionController/delete/$1";

//Role
$route["roles"]              = "RoleController/index";
$route["list_roles"]         = "RoleController/getLists";
$route["create_role"]        = "RoleController/create";
$route["store_role"]         = "RoleController/store";
$route["update_role/(:num)"] = "RoleController/update/$1";
$route["delete_role/(:num)"] = "RoleController/delete/$1";
$route["assign_role/(:num)"] = "RoleController/assign_role/$1";

//Access Denied
$route["access_denied"]      = "RestrictController/index";


// Temp Lead//
$route["temp_lead"] = "LeadCtrl/temp_lead";
$route["add_temp_leads"] = "LeadCtrl/add_temp_leads";
$route["fetch_temp_lead"] = "LeadCtrl/fetch_temp_lead";


//Agent Vouchar Report
$route["agent_vouchar_report"] = "ReportCtrl/agent_vouchar_report";
$route["fetch_voucher_agents_list"] = "ReportCtrl/fetch_voucher_agents_list";
$route["getVoucharAgents"] = "ReportCtrl/getVoucharAgents";

$route["fetch_agent_vouchar_report"] = "ReportCtrl/fetch_agent_vouchar_report";
$route["company_vocher_excel"] = "ReportCtrl/company_vocher_excel";
$route["company_vocher_orc_excel"] = "ReportCtrl/company_vocher_orc_excel";
$route["export_agent_vouchar_excel"] = "ReportCtrl/export_agent_vouchar_excel";


//acc_commission_leger_tiger

$route["acc_commission_leger_tiger"] = "ConfigCtrl/acc_commission_leger_tiger";
$route["get_active_policy_commission_leg"] = "ConfigCtrl/get_active_policy_commission_leg";


// tds_entry

$route["tds_entry"] = "TdsCtrl/tds_entry";
$route["fetch_poilicy_class_list"] = "TdsCtrl/fetch_poilicy_class_list";
$route["fetch_tds_amount_list"] = "TdsCtrl/fetch_tds_amount_list";
$route["add_tds_amount"] = "TdsCtrl/add_tds_amount";
$route["edit_tds_amount"] = "TdsCtrl/edit_tds_amount";
$route["fetch_edit_tds_amount"] = "TdsCtrl/fetch_edit_tds_amount";


// Bank Commission Amount Entry//


$route["agent_bank_transact_entry"] = "AccountsCtrl/agent_bank_transact_entry";
$route["excell_data_file_upload"] = "AccountsCtrl/excell_data_file_upload";
$route["fetch_bank_agent_commission_statement"] = "AccountsCtrl/fetch_bank_agent_commission_statement";
$route["get_vocher_bank_commission_amount"] = "AccountsCtrl/get_vocher_bank_commission_amount";


//companyfix start
$route["policy-billing-select"] = "CompanyfixCtrl/companyfix";
$route["fetch_companyfix_policy"] = "CompanyfixCtrl/fetch_companyfix_policy";
$route["fetch_companyfix_policy"] = "CompanyfixCtrl/fetch_companyfix_policy";
$route["fix_companyfix_commission"] = "ReportCtrl/fix_companyfix_commission";

$route["policy-bill-hold-release"]  = "CompanyfixCtrl/holdrelease";
$route["change_policy_status"]      = "CompanyfixCtrl/change_policy_status";

//companyfix end

// Company Invoice Amount Receivable
$route["invoice_payment_receivable"] = "InvoiceController/PaymentReceivable";

//audit log start
$route["audit_log"] = "LogCtrl/audit_log";
//audit log end


//bundel master start
$route["bundel_master"] = "BundelCtrl/bundel_master";
//bundel master end

// renewal policy list
$route["renewalpolicy"] = "Renewalcontrol/renewalpolicy";

//
$route["getAgentSplCommission"] = "LeadCtrl/getAgentSplCommission";

// 2023-08-12
$route["get_cheque_by_bank"] = "AccountsCtrl/get_cheque_by_bank";

//2023-08-12
$route["bank_entries"] = "AccountsCtrl/bank_entries";
$route["add_bank_entries"] = "AccountsCtrl/add_bank_entries";

//2023-08-12
$route["bank_deposit"] = "AccountsCtrl/bank_deposit";
$route["add_bank_deposit"] = "AccountsCtrl/add_bank_deposit";

//2023-08-12
$route["tds_entries"] = "AccountsCtrl/tds_entries";
$route["add_tds_entries"] = "AccountsCtrl/add_tds_entries";

//2023-08-12
$route["fixed_deposit"] = "AccountsCtrl/fixed_deposit";
$route["add_fixed_deposit"] = "AccountsCtrl/add_fixed_deposit";

//2023-08-12
$route["cheque_issued"] = "AccountsCtrl/cheque_issued";
$route["fetch_cheque_issued"] = "AccountsCtrl/fetch_cheque_issued";

// Trial Balance
$route["trialbalance"] = "AccountsCtrl/trialbalance";
$route["fetch_trialbalance"] = "AccountsCtrl/fetch_trialbalance";
$route["profitlose"] = "AccountsCtrl/export_profitlose";
$route["balancesheet"] = "AccountsCtrl/export_balancesheet";


//journalvoucher//
$route["journalvoucher"]="MasterCtrl/journalvoucher";
$route["add_journalvoucher"]="MasterCtrl/add_journalvoucher";
$route["fetch_particulars_by_account_head"] = "MasterCtrl/fetch_particulars_by_account_head";

// 2023-08-12
$route["jvlist"]="AccountsCtrl/jvlist";
$route["fetch_jvlist"]="AccountsCtrl/fetch_jvlist";

// 2023-08-12
$route["fetch_apply_forms"] = "AccountsCtrl/fetch_apply_forms";
$route["edit_ledger_forms"] = "AccountsCtrl/edit_ledger_forms";

// 2023-09-07
$route["cheque_details"] = "ChequeCtrl/cheque_details";
$route["fetch_chequedetails"] = "ChequeCtrl/fetch_chequedetails";
$route["view_cheque_deatils"] = "ChequeCtrl/view_cheque_deatils"; 
$route["fetch_cheque_info_data"] = "AdvanceCtrl/fetch_cheque_info_data";

// 2023-09-07
$route["check_duplicate_entry_jv"] = "MasterCtrl/check_duplicate_entry_jv";


// Day Book
$route["daybook"] = "AccountsCtrl/daybook";
$route["fetch_daybook"] = "AccountsCtrl/fetch_daybook";
$route["export_daybook"] = "AccountsCtrl/export_daybook";


// Trial Balance
$route["trialbalance"] = "AccountsCtrl/trialbalance";
$route["fetch_trialbalance"] = "AccountsCtrl/fetch_trialbalance";
$route["profitlose"] = "AccountsCtrl/export_profitlose";
$route["balancesheet"] = "AccountsCtrl/export_balancesheet";