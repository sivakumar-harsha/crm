<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/** @property CI_Email $email */

class LeadCtrl extends CI_Controller {

    public $pm;
    public $rm;
    public $cm;
    public $mm;
    public $lm;
    public $rolepermissionModel;
    public $auth;
    public $audit;
    public $cookie;
    public $url;
    public $db;
    public $database;
    public $session;
    public $Role_permission_model;
    public $audit_model;
    public $userroleModel;
    public $upload;
    public $image_lib;


	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->model('Configmod','cm');
		$this->load->model('LeadMod','lm');
		$this->load->model('MasterMod','mm');
		$this->load->model('PayoutMod','pm');
		$this->load->library('session');
		$this->load->library('audit');
		$this->load->helper('url');
		$this->load->helper('cookie');
        $this->load->helper('compression');
	}
	
	public function create_lead()
	{
	    
	    if( !( $this->session->has_userdata('logged_in') ) ){
            redirect('login', 'refresh');
        }
        
	   // if(!$this->auth->can_access('Create Leads')){
	   //     redirect('access_denied', 'refresh');
	   // }
	    
	    if($this->session->has_userdata('logged_in') && $this->session->userdata('session_role') == "admin") 
    	{    		
		   	$pro_data["project_info"] = $this->mm->fetch_project_info();
		   	$data["users"] = $this->lm->fetch_users();
		   	$data["ai"] = $this->lm->fetch_ai();
		   	$data["agents_pos"] = $this->lm->fetch_agents_pos();
		   	$data["policy_type"] = $this->lm->fetch_list_of_policy_type_motor();
		   	$data["client_type"] = $this->lm->fetch_client_type();
		   	$data["business"] = $this->lm->fetch_business_type();
		   	$data["class"] = $this->lm->fetch_list_of_class();
		   	$data["fuel_type"] = $this->lm->fetch_fuel_type();
		   	$data["rto"] = $this->lm->fetch_rto();
		   	$data["state"] = $this->lm->fetch_state();
		   	$data["region"] = $this->lm->fetch_region();
    		$this->load->view('header',$pro_data);
    		$this->load->view('lead',$data);
    		$this->load->view('footer',$pro_data);
	    }
	    else if($this->session->has_userdata('logged_in') && ($this->session->userdata('session_role') == "user" || $this->session->userdata('session_role') == "AI"))
	    {
	        $pro_data["project_info"] = $this->mm->fetch_project_info();
	        
	        $data["users"] = $this->cm->fetch_user_by_session_id($this->session->userdata('session_id'));
	        $check_user_i = $this->cm->fetch_user_permissions($this->session->userdata('session_id'));
	       
	        if($this->session->userdata("session_role") == "user")
	        {
	           $data["agents_pos"] = $this->lm->fetch_agents_pos();
	           
	           $data["region"] = $this->lm->fetch_region();
	        }
	        else if($this->session->userdata("session_role") == "AI")
	        {
	            $data["agents_pos"] = $this->lm->fetch_agents_pos_by_area_incharge($this->session->userdata("session_id"));
	            $data["region"] = $this->lm->fetch_region_by_area_incharge($this->session->userdata("session_id"));
	        }
	        if($check_user_i->masters_add == "1")
	        {
	        $data["users"] = $this->lm->fetch_users();
	        $data["ai"] = $this->lm->fetch_ai();
	        $data["client_type"] = $this->lm->fetch_client_type();
	        $data["business"] = $this->lm->fetch_business_type();
	        $data["class"] = $this->lm->fetch_list_of_class();
	        $data["policy_type"] = $this->lm->fetch_list_of_policy_type_motor();
	        $data["fuel_type"] = $this->lm->fetch_fuel_type();
	        $data["rto"] = $this->lm->fetch_rto();
	        $data["state"] = $this->lm->fetch_state();
    		$this->load->view('header',$pro_data);
    		$this->load->view('lead',$data);
    		$this->load->view('footer',$pro_data);
	        }
	        else
	        {
	             echo "<script>alert('Permission Denied');window.location.href='home';</script>";
    	          //redirect("home");
	        }
	    }
	    else
	    {
	    	redirect("login");
	    }
	    
	}
	
	
	// public function add_lead_details()
	// {
	//     if($this->session->has_userdata('logged_in'))
	//     {
	//         $client_type = $this->input->post("client_type");
	//         $client_name = $this->input->post("client_name");
	//         $mobile_no = $this->input->post("mobile_no");
	//         $other_contact_details = $this->input->post("other_contact_details");
	//         $landline_no = $this->input->post("landline_no");
	//         $address = $this->input->post("address");
	//         $email_id = $this->input->post("email_id");
	//         $contact_person_name = $this->input->post("contact_person_name");
	//         $contact_person_des = $this->input->post("contact_person_des");
	//         $dob = $this->input->post("dob");
	//         $age = $this->input->post("age");
	//         $area = $this->input->post("area");
	//         $pin = $this->input->post("pin_code");
	        
	//         $bussiness_type = $this->input->post("bussiness_type");
	//         $class = $this->input->post("policy_class");
	//         $policy_type = $this->input->post("policy_type");
	//         $lead_generated_date =  $this->input->post("lead_generated_date");
	//         $due_date =  $this->input->post("due_date");
	//         $broken_policy =  $this->input->post("broken_policy");
	//         $location=  $this->input->post("location");
	//         $classification =  $this->input->post("classification");
	//         $source =  $this->input->post("source");
	//         $agent_pos = $this->input->post("agent_pos");
	//         $assign_to_user =  $this->input->post("assign_to_user");
	//         $area_incharge = $this->input->post("area_incharge");
	//         $gst_number = $this->input->post("gst_number");
	        
	//         $v_regn_no = $this->input->post("v_regn_no");
	        
	//         $region = $this->lm->fetch_agent_region($agent_pos);
	        
	//         $region_id = "";
	        
	//         if($region != null)
	//         {
	//             $region_id = $region->region;
	//         }
	        
	//         $remarks = $this->input->post("remarks");
	//         $lead_created_by = $this->session->userdata('session_name');
	        
	//         $file = $this->input->post("files");
	        
	//         $created_date = date("Y-m-d H:i:sa");
	//         $updated_date = date("Y-m-d H:i:sa");
	        
	//         $res_1 = $this->lm->fetch_vechi_regn_no_already_exits($v_regn_no);
	        
	//         if($class == "1" && $v_regn_no !="" && $res_1 > 1)
	//         {
	//             echo "Exits";
	//         }
	//         else
	//         {
	//             $data = array( 
    //     	             "client_type_id" =>$client_type,
    //     	             "client_name" =>$client_name,
    //     	             "mobile_no" =>$mobile_no,
    //     	             "other_contact_details"=>$other_contact_details,
    //     	             "landline_no" => $landline_no,
    //     	             "address" =>$address,
    //     	             "email" =>$email_id,
    //     	             "contact_person_name" =>$contact_person_name,
    //     	             "contact_person_designation"=>$contact_person_des,
    //     	             "gst_number" =>$gst_number,
    //     	             "date_of_birth" => $dob,
    //     	             "age" =>$age,
    //     	             "area" =>$area,
    //     	             "pin_code" =>$pin,
    // 	             );
	             
	//               $res = $this->lm->add_client_details($data);
	//               if( $res ) {
    // 		            $this->audit->log('list_of_clients', 'INSERT', null, null, $data);
    // 		        }
	             
    //                 if(isset($_FILES))
    //                 {
    //                 	$config['upload_path'] = './datas/old_policy_document/';
    //                 	$config['allowed_types'] = '*';
                    	
    //                 	$this->load->library('upload',$config);
    //                 	$this->upload->initialize($config);
    //                 	if(!$this->upload->do_upload('file'))
    //                 	{
    //                 		$file = '';
    //                 	}
    //                 	else
    //                 	{
    //                 		$file = $this->upload->data('file_name');
    //                 	}
    //                 }
            
    //                  if($res != "")
    //                  {
    //                      $arr = array( 
    //                      "client_id" =>$res,
    //                      "business_type" =>$bussiness_type,
    //                      "class"=>$class,
    //                      "policy_type" => $policy_type,
    //                      "lead_generated_date" => $lead_generated_date,
    //                      "due_date" =>$due_date,
    //                      "broken_policy" => $broken_policy,
    //                      "location" =>$location,
    //                      "classfication" =>$classification,
    //                      "source"=>$source,
    //                      "lead_status"=>"open",
    //                      "agency_and_pos" => $agent_pos,
    //                      "assigned_user" => $assign_to_user,
    //                      "area_incharge" =>$area_incharge,
    //                       "region_id" =>$region_id,
    //                      "remarks" =>$remarks,
    //                      "lead_created_by" =>$lead_created_by,
    //                      "old_policy_document" =>$file,
    //                      "lead_created_id" =>$this->session->userdata('session_id'),
    //                      "created_date"=>$created_date,
    //                      "updated_date"=>$updated_date
    //                      );
                         
    //                      $data_1 = $this->lm->add_lead_details($arr);
    //                      if( $data_1 ) {
    //     		            $this->audit->log('list_of_leads', 'INSERT', null, null, $arr);
    //     		        }
    //                  }
            
    //                  if($class == "1")
    //                  {
    //                     $v_info = array("lead_id"=>$data_1,"vechi_register_no" =>$v_regn_no);
    //                     $add_v_info = $this->lm->add_vechicle_regn_no($v_info);   
    //                     if( $add_v_info ) {
    //     		            $this->audit->log('vechile_details', 'INSERT', null, null, $v_info);
    //     		        }
    //                  }
    //                 $activity_log = array("lead_id"=>$data_1,"action"=>"Created <b>New Lead</b>","action_type"=>"new_lead_creation","created_by"=>$lead_created_by,"time"=>$created_date);
    //                 $add_activity = $this->lm->add_activity_log($activity_log);
    //                 if( $add_activity ) {
    // 		            $this->audit->log('notification_log', 'INSERT', null, null, $activity_log);
    // 		        }
    //                 echo $data_1;
	//         }
	//     }
	// }

    public function add_lead_details()
    {
        if ($this->session->has_userdata('logged_in')) {

            // === CLIENT INFO ===
            $client_type          = $this->input->post("client_type");
            $salutation           = $this->input->post("salutation");
            $client_name          = $this->input->post("client_name");
            $initial              = $this->input->post("initial");
            $father_husband_name  = $this->input->post("father_husband_name");
            $dob                  = $this->input->post("dob");
            $age                  = $this->input->post("age");
            $mobile_no            = $this->input->post("mobile_no");
            $communication_address = $this->input->post("communication_address");
            $permanent_address    = $this->input->post("permanent_address");
            $district             = $this->input->post("district");
            $state                = $this->input->post("state");
            $country              = $this->input->post("country");
            $pin                  = $this->input->post("pin_code");
            $email_id             = $this->input->post("email_id");

            // === POLICY / LEAD DETAILS ===
            $bussiness_type       = $this->input->post("bussiness_type");
            $class                = $this->input->post("policy_class");
            $policy_type          = $this->input->post("policy_type");
            $lead_generated_date  = $this->input->post("lead_generated_date");
            $due_date             = $this->input->post("due_date");
            $broken_policy        = $this->input->post("broken_policy");
            $location             = $this->input->post("location");
            $classification       = $this->input->post("classification");
            $source               = $this->input->post("source");
            $agent_pos            = $this->input->post("agent_pos");
            $assign_to_user       = $this->input->post("assign_to_user");
            $area_incharge        = $this->input->post("area_incharge");
            $remarks              = $this->input->post("remarks");
            $v_regn_no            = $this->input->post("v_regn_no");

            $lead_created_by = $this->session->userdata('session_name');
            $created_date    = date("Y-m-d H:i:s");
            $updated_date    = date("Y-m-d H:i:s");

            // === REGION LOGIC ===
            $region = $this->lm->fetch_agent_region($agent_pos);
            $region_id = ($region != null) ? $region->region : "";

            // === DOCUMENT UPLOAD HANDLER ===
            $upload_dir = FCPATH . 'datas/client_documents/'; // ✅ Use absolute path
            if (!is_dir($upload_dir)) {
                mkdir($upload_dir, 0777, true);
            }
            if (!is_writable($upload_dir)) {
                chmod($upload_dir, 0777);
            }

            $this->load->library(['upload', 'image_lib']);

            $doc_fields = ['doc_aadhar', 'doc_pan', 'doc_voter', 'doc_dl', 'doc_govt'];
            $uploaded_docs = [];

            foreach ($doc_fields as $field) {
                if (!empty($_FILES[$field]['name'])) {

                    // ✅ Fresh config for each file
                    $file_name = time() . '_' . preg_replace('/\s+/', '_', $_FILES[$field]['name']);
                    $config = [
                        'upload_path'   => $upload_dir,
                        'allowed_types' => 'jpg|jpeg|png|pdf',
                        'max_size'      => 20480, // 20MB
                        'file_name'     => $file_name,
                        'overwrite'     => FALSE,
                    ];

                    $this->upload->initialize($config);

                    if ($this->upload->do_upload($field)) {
                        $uploadData = $this->upload->data();
                        $file_path  = $uploadData['full_path'];
                        $file_name  = $uploadData['file_name'];
                        $file_ext   = strtolower($uploadData['file_ext']);

                        // ✅ COMPRESS IMAGES (.jpg, .jpeg, .png) TO UNDER 500 KB
                        if (in_array($file_ext, ['.jpg', '.jpeg', '.png'])) {
                            $max_file_size_kb = 500;
                            $current_kb = $uploadData['file_size'];

                            if ($current_kb > $max_file_size_kb) {
                                // Call helper
                                compress_image($file_path, $file_path, 70);
                            }
                        }

                        // ✅ COMPRESS PDF FILES (Ghostscript)
                        else if ($file_ext === '.pdf') {
                            $max_file_size_kb = 1024;
                            $current_kb = $uploadData['file_size'];

                            if ($current_kb > $max_file_size_kb) {
                                $compressed_pdf = $upload_dir . 'compressed_' . $file_name;
                                if (compress_pdf($file_path, $compressed_pdf)) {
                                    if (file_exists($compressed_pdf)) {
                                        unlink($file_path);
                                        rename($compressed_pdf, $file_path);
                                    }
                                } else {
                                    log_message('error', 'PDF compression skipped or failed for ' . $file_path);
                                }
                            }
                        }

                        // ✅ Store only file name
                        $uploaded_docs[$field] = $file_name;

                    } else {
                        log_message('error', "Upload failed for {$field}: " . $this->upload->display_errors());
                        $uploaded_docs[$field] = '';
                    }
                } else {
                    $uploaded_docs[$field] = '';
                }
            }

            // === DYNAMIC CUSTOM FIELDS (Proper JSON structure) ===
            $custom_labels = $this->input->post('custom_label');
            $custom_values = $this->input->post('custom_value');

            $custom_fields = [];

            if (is_array($custom_labels) && is_array($custom_values)) {
                for ($i = 0; $i < count($custom_labels); $i++) {
                    $label = trim($custom_labels[$i]);
                    $value = isset($custom_values[$i]) ? trim($custom_values[$i]) : '';

                    // Only save if label is not empty
                    if ($label !== '') {
                        $custom_fields[$label] = $value;
                    }
                }
            }

            // Convert to clean JSON
            $custom_fields_json = (!empty($custom_fields)) ? json_encode($custom_fields, JSON_UNESCAPED_UNICODE) : null;

            // ✅ Auto-generate Customer ID based on name
            $customer_id = $this->lm->generate_customer_id($client_name);

            // === CLIENT DATA INSERT ===
            $data = [
                "customer_id"          => $customer_id,
                "client_type_id"        => $client_type,
                "salutation"            => $salutation,
                "client_name"           => $client_name,
                "initial"               => $initial,
                "father_husband_name"   => $father_husband_name,
                "mobile_no"             => $mobile_no,
                "communication_address" => $communication_address,
                "permanent_address"     => $permanent_address,
                "district"              => $district,
                "state"                 => $state,
                "country"               => $country,
                "email"                 => $email_id,
                "date_of_birth"         => $dob,
                "age"                   => $age,
                "pin_code"              => $pin,
                "doc_aadhar"            => $uploaded_docs['doc_aadhar'],
                "doc_pan"               => $uploaded_docs['doc_pan'],
                "doc_voter"             => $uploaded_docs['doc_voter'],
                "doc_dl"                => $uploaded_docs['doc_dl'],
                "doc_govt"              => $uploaded_docs['doc_govt'],
                "custom_fields"         => $custom_fields_json,
                "created_date"          => $created_date,
                "updated_date"          => $updated_date
            ];

            $res = $this->lm->add_client_details($data);
            if ($res) {
                $this->audit->log('list_of_clients', 'INSERT', null, null, $data);
            }

            // === OLD POLICY DOCUMENT UPLOAD ===
            $file = '';
            $old_policy_dir = FCPATH . 'datas' . DIRECTORY_SEPARATOR . 'old_policy_document' . DIRECTORY_SEPARATOR;
            if (!is_dir($old_policy_dir)) mkdir($old_policy_dir, 0777, true);

            if (!empty($_FILES['file']['name'])) {
                $file_name = time() . '_' . preg_replace('/\s+/', '_', $_FILES['file']['name']);
                $config_old = [
                    'upload_path'   => $old_policy_dir,
                    'allowed_types' => 'jpg|jpeg|png|pdf|doc|docx',
                    'max_size'      => 20480, // 20 MB
                    'file_name'     => $file_name,
                    'overwrite'     => FALSE
                ];

                $this->upload->initialize($config_old);
                if ($this->upload->do_upload('file')) {
                    $uploadData = $this->upload->data();
                    $file = $uploadData['file_name'];
                } else {
                    log_message('error', 'Old Policy Upload Error: ' . $this->upload->display_errors());
                }
            }


            // === LEAD DATA INSERT ===
            if ($res != "") {
                $arr = [
                    "client_id"           => $res,
                    "business_type"       => $bussiness_type,
                    "class"               => $class,
                    "policy_type"         => $policy_type,
                    "lead_generated_date" => $lead_generated_date,
                    "due_date"            => $due_date,
                    "broken_policy"       => $broken_policy,
                    "location"            => $location,
                    "classfication"       => $classification,
                    "source"              => $source,
                    "lead_status"         => "open",
                    "agency_and_pos"      => $agent_pos,
                    "assigned_user"       => $assign_to_user,
                    "area_incharge"       => $area_incharge,
                    "region_id"           => $region_id,
                    "remarks"             => $remarks,
                    "lead_created_by"     => $lead_created_by,
                    "old_policy_document" => $file,
                    "lead_created_id"     => $this->session->userdata('session_id'),
                    "created_date"        => $created_date,
                    "updated_date"        => $updated_date
                ];

                $data_1 = $this->lm->add_lead_details($arr);
                if ($data_1) {
                    $this->audit->log('list_of_leads', 'INSERT', null, null, $arr);
                }
            }

            // === VEHICLE INFO ===
            if ($class == "1" && !empty($data_1)) {
                $v_info = ["lead_id" => $data_1, "vechi_register_no" => $v_regn_no];
                $add_v_info = $this->lm->add_vechicle_regn_no($v_info);
                if ($add_v_info) {
                    $this->audit->log('vechile_details', 'INSERT', null, null, $v_info);
                }
            }

            // === ACTIVITY LOG ===
            $activity_log = [
                "lead_id"     => $data_1,
                "action"      => "Created <b>New Lead</b>",
                "action_type" => "new_lead_creation",
                "created_by"  => $lead_created_by,
                "time"        => $created_date
            ];

            $add_activity = $this->lm->add_activity_log($activity_log);
            if ($add_activity) {
                $this->audit->log('notification_log', 'INSERT', null, null, $activity_log);
            }

            echo $data_1;
        }
    }


 
	    public function get_lead_details()
	    {
    	    if($this->session->has_userdata('logged_in'))
    	    {
    	        $id = $this->input->post("last_inserted_id");
    	        $res = $this->lm->get_lead_details($id);
    	        echo json_encode($res);
    	    }
	    }
	    
	    public function add_follow_up_details()
	    {
    	    if($this->session->has_userdata('logged_in'))
    	    {
    	        $id = $this->input->post("id");
    	        $follow_up_status = $this->input->post("follow_up_status");
    	        $follow_up_reason = $this->input->post("follow_up_reason");
    	        $next_follow_date = $this->input->post("enter_next_follow_date");
    	        $enter_next_follow_time = $this->input->post("enter_next_follow_time");
    	        $follow_comment =$this->input->post("follow_comment");
    	        $follow_up_created_date = date("Y-m-d");
    	         
    	        $check = $this->lm->check_follow_up_already_exits($id);
    	      
    	        if($check !="" && $check != NULL)
    	        {
    	            foreach($check as $da)
    	            {
    	                
    	                $data_lead = array("next_follow_up_date"=>$next_follow_date,"last_follow_up_date" =>$da->next_follow_up_date,"follow_up_reason"=>$follow_up_reason,"follow_up_created_date"=>$follow_up_created_date,"next_follow_up_time" => $enter_next_follow_time,"lead_status" =>"followup");
    	                $old_data = $this->lm->get_lead_details($id);
    	                $res = $this->lm->update_follow_up_details($data_lead,$id);
    	                if( $res ) {
    	                    $this->audit->log('list_of_leads', 'UPDATE', null, $old_data, $data_lead);
    	                }
    	            }
    	        }
    	        else
    	        {
    	             $data_lead = array("next_follow_up_date"=>$next_follow_date,"follow_up_reason"=>$follow_up_reason,"follow_up_created_date"=>$follow_up_created_date,"next_follow_up_time" => $enter_next_follow_time,"lead_status" =>"followup");
    	             $old_data = $this->lm->get_lead_details($id);
    	             $res = $this->lm->update_follow_up_details($data_lead,$id);
    	             if( $res ) {
	                    $this->audit->log('list_of_leads', 'UPDATE', null, $old_data, $data_lead);
	                }
    	        }
    	        
    	        $data = array("lead_id"=>$id,"follow_up_status"=>$follow_up_status,"next_follow_up_date"=>$next_follow_date,"next_follow_up_time" =>$enter_next_follow_time,"reason"=>$follow_up_reason,"comment" =>$follow_comment,"follow_up_created_date"=>$follow_up_created_date);
    	        $res = $this->lm->add_follow_up_details($data);
    	        if( $res ) {
                    $this->audit->log('follow_up_details', 'INSERT', null, null, $data);
                }
    	       if($check !="" && $check != NULL)
    	        {
        	        foreach($check as $da)
        	        {
        	            $update_data = array("last_follow_up_date" =>$da->next_follow_up_date,"last_status_update" =>$da->follow_up_created_date);
        	            echo json_encode($update_data);
        	        }
    	        }
    	        else
    	        {
    	            $update_data = array("last_follow_up_date" =>"","last_status_update" =>date("Y-m-d"));
        	       echo json_encode($update_data);
    	        }
    	        
    	        $activity_log = array(
                                "lead_id"=>$id,
                                "action"=>"created followup with reason  : <b><i>".$follow_up_reason."</i></b>. New Followup Set to <b>".date_format(date_create($next_follow_date),"d-m-Y")." ".date("h:i:s a",strtotime($enter_next_follow_time))."</b>",
                                "action_type"=>"Follow_up",
                                "created_by"=>$this->session->userdata('session_name'),
                                "time"=>date("Y-m-d H:i:sa"));
                $add_activity = $this->lm->add_activity_log($activity_log);
                if( $add_activity ) {
                    $this->audit->log('notification_log', 'INSERT', null, null, $activity_log);
                }
    	    }
	    }
	    
	    public function fetch_policy_type_using_class()
	    {
	        if($this->session->has_userdata('logged_in'))
    	    {
    	        $policy_class = $this->input->post("policy_class");
    	        $res = $this->lm->fetch_policy_type_using_class($policy_class);
    	        echo json_encode($res);
    	    }
	    }
	    
	    public function fetch_make()
	    {
	        if($this->session->has_userdata('logged_in'))
    	    {
    	        $vechile_type = $this->input->post("vechile_type");
    	        
    	        $res=array();
    	         
    	        if($vechile_type == "1" || $vechile_type == "3" || $vechile_type == "68")
    	        {
    	            $res = $this->lm->fetch_make_car();
    	        }
    	        else if($vechile_type == "2")
    	        {
    	            $res = $this->lm->fetch_make_bike();
    	        }
    	        else if($vechile_type == "4")
    	        {
    	            $res = $this->lm->fetch_e_two_wheeler();
    	        }
    	        else if($vechile_type == "7" || $vechile_type == "12" || $vechile_type == "13" || $vechile_type == "14" || $vechile_type == "59" || $vechile_type == "60" || $vechile_type == "65" || $vechile_type == "66" || $vechile_type == "69" || $vechile_type == "70")
    	        {
    	            $res = $this->lm->fetch_pc_make($vechile_type);
    	        }
    	        else if($vechile_type == "8" || $vechile_type == "9" || $vechile_type == "10" || $vechile_type == "15" || $vechile_type == "16" || $vechile_type == "61")
    	        {
    	            $res = $this->lm->fetch_gc_make($vechile_type);
    	        }
    	        else if($vechile_type == "20")
    	        {
    	            $res = $this->lm->fetch_misc_make();
    	        }
    	        else if($vechile_type == "55")
    	        {
    	            $res = $this->lm->fetch_scooter_make();
    	        }
    	        else if($vechile_type == "18")
    	        {
    	            $res = $this->lm->fetch_ambulance_make();
    	        }
    	        echo json_encode($res);
    	    }
	    }
	    
	    public function fetch_model()
	    {
	        if($this->session->has_userdata('logged_in'))
    	    {
    	        $vechile_type = $this->input->post("vechile_type");
    	        $vechi_make = $this->input->post("vechi_make");
    	        
    	        $res = array();
    	        
    	        if($vechile_type == "1" || $vechile_type == "3" || $vechile_type == "68")
    	        {
    	            $res = $this->lm->fetch_car_model($vechi_make);
    	        }
    	        else if($vechile_type == "2")
    	        {
    	            $res = $this->lm->fetch_bike_model($vechi_make);
    	        }
    	        else if($vechile_type == "4")
    	        {
    	            $res = $this->lm->fetch_e_two_wheeler_model($vechi_make);
    	        }
    	        else if($vechile_type == "7" || $vechile_type == "12" || $vechile_type == "13" || $vechile_type == "14" || $vechile_type == "59" || $vechile_type == "60" || $vechile_type == "65" || $vechile_type == "66" || $vechile_type == "69" || $vechile_type == "70")
    	        {
    	            $res = $this->lm->fetch_pc_model($vechile_type,$vechi_make);
    	        }
    	        else if($vechile_type == "8" || $vechile_type == "9" || $vechile_type == "10" || $vechile_type == "15" || $vechile_type == "16" || $vechile_type == "61")
    	        {
    	            $res = $this->lm->fetch_gc_model($vechile_type,$vechi_make);
    	        }
    	        else if($vechile_type == "20")
    	        {
    	            $res = $this->lm->fetch_misc_model($vechi_make);
    	        }
    	        else if($vechile_type == "55")
    	        {
    	            $res = $this->lm->fetch_scooter_model($vechi_make);
    	        }
    	        else if($vechile_type == "18")
    	        {
    	            $res = $this->lm->fetch_ambulance_model($vechi_make);
    	        }
    	        echo json_encode($res);
    	    }
	    }
	    
	    public function fetch_vechile_varient()
	    {
	       if($this->session->has_userdata('logged_in'))
    	    {
    	        $vechile_type = $this->input->post("vechile_type");
    	        $vechi_make = $this->input->post("vechi_make");
    	        $vechi_model = $this->input->post("vechi_model");
    	        
    	        $res = array();
    	        
    	        if($vechile_type == "1" || $vechile_type == "3" || $vechile_type == "68")
    	        {
    	            $res = $this->lm->fetch_car_varient($vechi_make,$vechi_model);
    	        }
    	        else if($vechile_type == "2")
    	        {
    	            $res = $this->lm->fetch_bike_varient($vechi_make,$vechi_model);
    	        }
    	        else if($vechile_type == "4")
    	        {
    	            $res = $this->lm->fetch_e_two_wheeler_varient($vechi_make,$vechi_model);
    	        }
    	        else if($vechile_type == "7" || $vechile_type == "12" || $vechile_type == "13" || $vechile_type == "14" || $vechile_type == "59" || $vechile_type == "60" || $vechile_type == "65" || $vechile_type == "66" || $vechile_type == "69" || $vechile_type == "70")
    	        {
    	            $res = $this->lm->fetch_pc_varient($vechile_type,$vechi_make,$vechi_model);
    	        }
    	        else if($vechile_type == "8" || $vechile_type == "9" || $vechile_type == "10" || $vechile_type == "15" || $vechile_type == "16" || $vechile_type == "61")
    	        {
    	            $res = $this->lm->fetch_gc_varient($vechile_type,$vechi_make,$vechi_model);
    	        }
    	        else if($vechile_type == "20")
    	        {
    	            $res = $this->lm->fetch_misc_varient($vechi_make,$vechi_model);
    	        }
    	        else if($vechile_type == "55")
    	        {
    	            $res = $this->lm->fetch_scooter_varient($vechi_make,$vechi_model);
    	        }
    	        else if($vechile_type == "18")
    	        {
    	              $res = $this->lm->fetch_ambulance_varient($vechi_make,$vechi_model); 
    	        }
    	        echo json_encode($res);
    	    }
	    }
	    
	    
	    public function add_vechile_details()
        {
            if (!$this->session->has_userdata('logged_in')) {
                return;
            }

            $id = $this->input->post("id");
            $vechile_type = $this->input->post("vechile_type");
            $policy_type = $this->input->post("policy_type");
            $vechi_make = $this->input->post("vechi_make");
            $vechi_model = $this->input->post("vechi_model");
            $vechi_varient = $this->input->post("vechi_varient");
            $vechi_cc = $this->input->post("vechi_cc");
            $vechi_manu_month = $this->input->post("vechi_manu_month");
            $vechi_manu_year = $this->input->post("vechi_manu_year");
            $vechi_seating = $this->input->post("vechi_seating");
            $vechi_classfication = $this->input->post("vechi_classfication");
            $vechi_fuel_type = $this->input->post("vechi_fuel_type");
            $vechi_gvw = $this->input->post("vechi_gvw");
            $passenger_carrying = $this->input->post("passenger_carrying");
            $vechi_engine_num = $this->input->post("vechi_engine_num");
            $vechi_chassis_num = $this->input->post("vechi_chassis_num");
            $vechi_hypothecation = $this->input->post("vechi_hypothecation");
            $created_user = $this->input->post("created_user");
            $vechi_remarks = $this->input->post("vechi_remarks");
            $regn_date = $this->input->post("regn_date");
            $register_no = $this->input->post("register_no"); 
            $rto = $this->input->post("rto");
            $zone = $this->input->post("zone");
            $regn_address = $this->input->post("regn_address");
            $state = $this->input->post("state");
            $city = $this->input->post("city");
            $pincode = $this->input->post("pincode");
            $vechi_user_name = $this->input->post("vechi_user_name");
            $vechi_user_cont = $this->input->post("vechi_user_cont");
            $date = date("Y-m-d");

            // === Handle RC file upload ===
            $regn_certificate = "";
            if (isset($_FILES['regn_certificate']) && $_FILES['regn_certificate']['name'] != '') {
                $config['upload_path'] = './datas/Registration_Certificate/';
                $config['allowed_types'] = 'jpg|jpeg|png|pdf';
                $config['file_name'] = time() . '_' . preg_replace('/\s+/', '_', $_FILES['regn_certificate']['name']);
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                
                if ($this->upload->do_upload('regn_certificate')) {
                    $upload_data = $this->upload->data();
                    $regn_certificate = $upload_data['file_name'];
                    $file_path = $upload_data['full_path'];

                    // === Compress large images ===
                    if (in_array(strtolower($upload_data['file_ext']), ['.jpg', '.jpeg', '.png']) && $upload_data['file_size'] > 500) {
                        compress_image($file_path, $file_path, 70);
                    }

                    // === Compress large PDFs ===
                    if (strtolower($upload_data['file_ext']) === '.pdf' && $upload_data['file_size'] > 1024) {
                        $compressed_pdf = rtrim($config['upload_path'], '/') . '/compressed_' . $upload_data['file_name'];
                        if (compress_pdf($file_path, $compressed_pdf) && file_exists($compressed_pdf)) {
                            unlink($file_path);
                            rename($compressed_pdf, $file_path);
                        }
                    }

                    log_message('info', "✅ RC uploaded: {$regn_certificate}");
                }
            }

            // === Handle 30 Vehicle Photo Uploads ===
            $photo_fields = [
                "front_view", "back_view", "left_side_view", "right_side_view", "dashboard",
                "interior_front_seats", "interior_back_seats", "engine_compartment", "boot_space",
                "tyre_front_left", "tyre_front_right", "tyre_rear_left", "tyre_rear_right",
                "number_plate_front", "number_plate_back", "roof", "windshield_front",
                "windshield_rear", "chassis_number_area", "odometer_reading", "battery_area",
                "tool_kit_area", "spare_wheel", "music_system", "ac_control_panel",
                "steering_area", "gear_console", "mirror_inside", "mirror_outside", "documents_photo"
            ];

            $upload_path = './datas/Vehicle_Photos/';
            if (!file_exists($upload_path)) mkdir($upload_path, 0777, true);
            $this->load->library('upload');

            $uploaded_images = [];
            $index = 1;
            foreach ($photo_fields as $field) {
                if (isset($_FILES[$field]) && $_FILES[$field]['name'] != '') {
                    $file_name = time() . '_' . preg_replace('/\s+/', '_', $_FILES[$field]['name']);
                    $config = [
                        'upload_path'   => $upload_path,
                        'allowed_types' => 'jpg|jpeg|png',
                        'file_name'     => $file_name,
                        'max_size'      => 20480 // 20MB
                    ];
                    $this->upload->initialize($config);

                    if ($this->upload->do_upload($field)) {
                        $upload_data = $this->upload->data();
                        $file_path = $upload_data['full_path'];
                        $ext = strtolower($upload_data['file_ext']);
                        $size_kb = $upload_data['file_size'];

                        // Compress if >500KB
                        if (in_array($ext, ['.jpg', '.jpeg', '.png']) && $size_kb > 500) {
                            compress_image($file_path, $file_path, 70);
                            clearstatcache(true, $file_path);
                            $size_kb = round(filesize($file_path) / 1024, 2);
                        }

                        $uploaded_images["img_" . $index] = $upload_data['file_name'];
                        log_message('info', "✅ Vehicle Photo img_{$index} uploaded: {$upload_data['file_name']} ({$size_kb} KB)");
                    } else {
                        log_message('error', "❌ Failed to upload {$field}: " . $this->upload->display_errors());
                    }
                }
                $index++;
            }

            // === Check for duplicate registration number ===
            $res_1 = $this->lm->check_regn_no_exits_by_lead_id($register_no, $id);

            if ($res_1 >= 1) {
                echo "Exits";
                return;
            }

            // === Build main insert data ===
            $data = [
                "lead_id" => $id,
                "vechile_type" => $vechile_type,
                "policy_type" => $policy_type,
                "vechi_make" => $vechi_make,
                "vechi_model" => $vechi_model,
                "vechi_varient" => $vechi_varient,
                "vechi_cc" => $vechi_cc,
                "vechi_manu_month" => $vechi_manu_month,
                "vechi_manu_year" => $vechi_manu_year,
                "vechi_seating" => $vechi_seating,
                "vechi_classfication" => $vechi_classfication,
                "vechi_fuel_type" => $vechi_fuel_type,
                "vechi_gvw" => $vechi_gvw,
                "passenger_carrying" => $passenger_carrying,
                "vechi_engine_num" => $vechi_engine_num,
                "vechi_chassis_num" => $vechi_chassis_num,
                "vechi_hypothecation" => $vechi_hypothecation,
                "created_by" => $created_user,
                "vechi_remarks" => $vechi_remarks,
                "regn_date" => $regn_date,
                "vechi_register_no" => $register_no,
                "rto" => $rto,
                "zone" => $zone,
                "regn_address" => $regn_address,
                "state" => $state,
                "city" => $city,
                "pincode" => $pincode,
                "vechi_user_name" => $vechi_user_name,
                "vechi_user_cont" => $vechi_user_cont,
                "created_at" => $date,
                "regn_certificate" => $regn_certificate
            ];

            // === Merge uploaded image columns ===
            foreach ($uploaded_images as $column => $filename) {
                $data[$column] = $filename;
            }

            // === Handle Additional Fields ===
            $additionalFieldsJson = $this->input->post('additional_fields');
            if (!empty($additionalFieldsJson) && json_decode($additionalFieldsJson, true)) {
                $data["additional_fields"] = $additionalFieldsJson;
            }

            // === Insert or Update ===
            $check_lead_id = $this->lm->check_this_lead_id_already_exits($id);
            if ($check_lead_id > 0) {
                $old_data = $this->lm->fetch_edit_vechicle_details($id);
                $res = $this->lm->update_vechicle_details_1($data, $id);
                if ($res) $this->audit->log('vechile_details', 'UPDATE', null, $old_data, $data);
            } else {
                $res = $this->lm->add_vechicle_details($data);
                if ($res) $this->audit->log('vechile_details', 'INSERT', null, null, $data);
            }

            // === Activity Log ===
            $activity_log = [
                "lead_id" => $id,
                "action" => "<i><b>New Vehicle</b></i> Details Added",
                "action_type" => "add_vechicle",
                "created_by" => $this->session->userdata('session_name'),
                "time" => date("Y-m-d H:i:s")
            ];
            $add_activity = $this->lm->add_activity_log($activity_log);
            if ($add_activity) {
                $this->audit->log('notification_log', 'INSERT', null, null, $activity_log);
            }

            echo "success";
        }


	    public function get_exp_date()
	    {
	        $date = $this->input->post("date");
	        $newDate = date("Y-m-d", strtotime(date("Y-m-d", strtotime($date)) . " + 1 year"));
	        echo date("Y-m-d", strtotime(date("Y-m-d", strtotime($newDate)) . " - 1 day"));
	    }
	    
	    public function get_vechile_details()
	    {
	        if($this->session->has_userdata('logged_in'))
    	    {
    	        $id = $this->input->post("id");
    	        
    	        $vehi_type = $this->lm->get_vechile_type($id);
    	        
    	        $res = array();
    	       
    	        if($vehi_type != null)
    	        {
    	            if($vehi_type->policy_type == "1" || $vehi_type->policy_type == "68")
    	            {
    	                $res = $this->lm->get_car_details($id);  
        	        }
        	        else if($vehi_type->policy_type == "2")
        	        {
        	            $res = $this->lm->get_bike_details($id);  
        	        }
        	        else if($vehi_type->policy_type == "3")
        	        {
        	            $res = $this->lm->get_car_details($id);  
        	        }
        	        else if($vehi_type->policy_type == "4")
        	        {
        	            $res = $this->lm->get_bike_details($id);  
        	        }
                	else if($vehi_type->policy_type == "7" || $vehi_type->policy_type == "12" || $vehi_type->policy_type == "13" || $vehi_type->policy_type == "14" || $vehi_type->policy_type == "59" || $vehi_type->policy_type == "60" || $vehi_type->policy_type == "65" || $vehi_type->policy_type == "66" || $vehi_type->policy_type == "69" ||$vehi_type->policy_type == "70")
                    {
                            $res = $this->lm->get_pc_details($id,$vehi_type->policy_type);
                    }
                    else if($vehi_type->policy_type == "8" || $vehi_type->policy_type == "9" || $vehi_type->policy_type == "10" || $vehi_type->policy_type == "15" || $vehi_type->policy_type == "16" || $vehi_type->policy_type == "61")
                    {
                            $res = $this->lm->get_gc_details($id,$vehi_type->policy_type);
                    }
                    else if($vehi_type->policy_type == "20")
                    {
                            $res = $this->lm->fetch_make_misc($id);
                    }
                    else if($vehi_type->policy_type == "55")
                    {
                        $res = $this->lm->fetch_make_scooter($id);
                    }
                    else if($vehi_type->policy_type == "18")
                    {
                        $res = $this->lm->fetch_make_ambulance($id);
                    }
    	        }
    	        
    	        echo json_encode($res);
    	    }
	    }
	    
	    
	 public function upload_document_files()
	 {
	      if($this->session->has_userdata('logged_in'))
    	    {
        	   $id = $this->input->post("id");
        	   $document_type = $this->input->post("document_type");
        	    if(isset($_FILES))
        		{
        			$config['upload_path'] = './datas/documents/';
        			$config['allowed_types'] = '*';
        			
        			$this->load->library('upload',$config);
        			$this->upload->initialize($config);
        			if(!$this->upload->do_upload('file'))
        			{
        				$file = '';
        				$file_path = "";
        			}
        			else
        			{
        				$file_path = base_url().'datas/documents/'.$this->upload->data('file_name');
        				$file = $this->upload->data('file_name');
        			}
        		}
        		
        		$data = array("lead_id" =>$id,"document_type"=>$document_type,"document_file" =>$file);
        		$res = $this->lm->upload_document_files($data);
        		
        		$html = "";
        		$html .="<tr>
        		           <td><a href='./datas/documents/".$res->document_file."'><i class='fa fa-file'></i></a></td>
        		           <td>".$res->document_file."</td>
        		           <td>".$res->document_type."</td>
        		           <td><i class='fa fa-edit' onclick=edit_data(".$res->id.")></i></td>
        		           <td><i class='fa fa-trash' onclick=delete_data(".$res->id.")></i></td>
        		         </tr>";
        		 echo $html;
    	    }	 
	 }
	 
	 public function move_lead_to_prospect()
	 {
	      if($this->session->has_userdata('logged_in'))
    	    {
        	     $id = $this->input->post("id");
        	     $data = array("lead_type" =>'1');
        	     $old_data = $this->lm->get_receiver_email_id($id);
        	     $res = $this->lm->move_lead_to_prospect($id,$data);
        	     if($res){
	                 $this->audit->log('list_of_leads', 'UPDATE', null, $old_data, $data);
	             }
        	     
        	     $activity_log = array("lead_id"=>$id,"action"=>"Generated <b><i>Prospect</b></i>","action_type"=>"prospect","created_by"=>$this->session->userdata('session_name'),"time"=>date("Y-m-d H:i:s"));
                 $add_activity = $this->lm->add_activity_log($activity_log);
                 if( $add_activity ) {
                    $this->audit->log('notification_log', 'INSERT', null, null, $activity_log);
                 }
    	    }
	 }
	 
	 public function move_classification()
	 {
	      if($this->session->has_userdata('logged_in'))
    	    {
        	     $id = $this->input->post("id");
        	     $classfication = $this->input->post("val");
        	     if($classfication == 4)
        	     {
        	         $lead_data = $this->lm->get_receiver_email_id($id);
        	         $due_date = "";
        	         if($lead_data != null)
        	         {
        	            $due_date = $lead_data->due_date;
        	            if($due_date != "0000-00-00")
        	            {
        	                $due_date = date("Y-m-d", strtotime(date("Y-m-d", strtotime($due_date)) . " + 1 year"));
        	                $data = array("lead_status" => "lost","due_date" => $due_date);
        	                $res = $this->lm->move_classification($id,$data);   
        	                if($res){
            	                 $this->audit->log('list_of_leads', 'UPDATE', null, $lead_data, $data);
            	             }
        	            }
        	         }
        	     }
        	     else
        	     {
        	         $lead_data = $this->lm->get_receiver_email_id($id);
    	            $data = array("classfication" =>$classfication);
    	            $res = $this->lm->move_classification($id,$data);  
    	            if($res){
    	                 $this->audit->log('list_of_leads', 'UPDATE', null, $lead_data, $data);
    	             }
        	     }
    	    }
	 }
	 
	 public function move_to_lead()
	 {
	     if($this->session->has_userdata('logged_in'))
    	    {
        	     $id = $this->input->post("id");
        	     $data = array("lead_type" =>'0');
        	     $lead_data = $this->lm->get_receiver_email_id($id);
        	     $res = $this->lm->move_to_lead($id,$data);
        	     if($res){
    	            $this->audit->log('list_of_leads', 'UPDATE', null, $lead_data, $data);
    	         }
    	    }
	 }
	 
	 // Admin // 
	 
	 public function leads()
	 {
	     if( !( $this->session->has_userdata('logged_in') ) ){
            redirect('login', 'refresh');
        }
        
	   // if(!$this->auth->can_access('List Leads')){
	   //     redirect('access_denied', 'refresh');
	   // }
	    
	     if($this->session->has_userdata('logged_in') && $this->session->userdata('session_role') == "admin") 
    	{    		
		   	$pro_data["project_info"] = $this->mm->fetch_project_info();
		   	$data["users"] = $this->lm->fetch_users();
		   	$data["client_type"] = $this->lm->fetch_client_type();
		   	$data["business"] = $this->lm->fetch_business_type();
		   	$data["class"] = $this->lm->fetch_list_of_class();
		   	$data["policy_type"] = $this->lm->fetch_list_of_policy_type_motor();
    		$this->load->view('header',$pro_data);
    		$this->load->view('view_all_leads',$data);
    		$this->load->view('footer',$pro_data);
	    }
	    else if($this->session->has_userdata('logged_in') && ($this->session->userdata('session_role') == "user" || $this->session->userdata('session_role') == "AI"))
	    {
	         $data["users"] = $this->cm->fetch_user_by_session_id($this->session->userdata('session_id'));
	        $check_user_i = $this->cm->fetch_user_permissions($this->session->userdata('session_id'));
	        
	        if($check_user_i->masters_view == "1")
	        {
	        $pro_data["project_info"] = $this->mm->fetch_project_info();
	        $data["users"] = $this->lm->fetch_users();
	        $data["client_type"] = $this->lm->fetch_client_type();
	        $data["business"] = $this->lm->fetch_business_type();
	        $data["class"] = $this->lm->fetch_list_of_class();
	        $data["policy_type"] = $this->lm->fetch_list_of_policy_type_motor();
    		$this->load->view('header',$pro_data);
    		$this->load->view('view_all_leads',$data);
    		$this->load->view('footer',$pro_data);
	        }
	        else
	        {
	             echo "<script>alert('Permission Denied');window.location.href='home';</script>";
    	          //redirect("home");
	        }
	    }
	    else
	    {
	    	redirect("login");
	    }
	 }
	 
	 public function fetch_all_leads()
	 {
	     if($this->session->has_userdata('logged_in'))
    	 {
    	     $draw = intval($this->input->post("draw"));
    	     
    	     $lead_type = $this->input->post("lead_type");
    	     $classification = $this->input->post("classification");
    	     $category = $this->input->post("category");
    	     $bulk_status = $this->input->post("bulk_status");
    	     $order_category = $this->input->post("order_category");
    	     $search = $this->input->post("text");
    	     $search_vechicle = $this->input->post("search_vechicle");
    	     
    	     $res = $this->lm->fetch_all_leads($lead_type,$classification,$category,$bulk_status,$order_category,$search,$search_vechicle);
    	     
             
    	     $arr = [];
    	     
    	     $a = $_POST['start'];
/*    	     
    	     $res1 = array();
    	     $res2 = array();
    	     $res3 = array();
    	     $res4 = array();
    	     
    	     foreach($res as $da)
    	     {
    	         if($da->due_date >= date("Y-m-d"))
    	         {
    	             $res1[] = $da;
    	         }
    	         else if($da->due_date == "0000-00-00")
    	         {
    	             $res4[] = $da;
    	         }
    	         else
    	         {
    	             $res2[] = $da;
    	         }
    	     }
    	     rsort($res2);
    	     foreach($res1 as $da)
    	     {
    	         $res3[] = $da;
    	     }
    	     foreach($res2 as $da)
    	     {
    	         $res3[] = $da;
    	     }
    	     foreach($res4 as $da)
    	     {
    	         $res3[] = $da;
    	     }
    	     
    	 function sortByduedate($a, $b){
    	     $t1 = strtotime($a->due_date);
    	     $t2 = strtotime($b->due_date);
    	     return $t2 - $t1;
    	 }
    	 if($order_category != "upcoming") {
    	     usort($res3, 'sortByduedate');
    	 }
    	 
*/    	 

        $res1 = $res2 = $res3 = $res4 = [];

        // Separate the entries based on due_date conditions
        foreach ($res as $da) {
            if ($da->due_date >= date("Y-m-d")) {
                $res1[] = $da;
            } elseif ($da->due_date == "0000-00-00") {
                $res4[] = $da;
            } else {
                $res2[] = $da;
            }
        }
        
        // Sort past due dates in descending order
        rsort($res2);
        
        // Combine all results into $res3 in the required order
        $res3 = array_merge($res1, $res2, $res4);
        
        // Function to sort by due_date in descending order
        function sortByDueDate($a, $b) {
            return strtotime($b->due_date) - strtotime($a->due_date);
        }
        
        // Apply sorting to $res3 if order_category is not "upcoming"
        if ($order_category != "upcoming") {
            usort($res3, 'sortByDueDate');
        }

         foreach($res3 as $da)
         {
    	         $a++;
    	         
    	   $action = "<a href='create_lead?id=".$da->id."' class='btn btn-warning btn-xs'><i class='fa fa-eye'></i></a>
    	           <button onclick=due_date_extern(".$da->id.") class='btn btn-info btn-xs'><i class='fa fa-calendar'></i></button>";
    
    	   
        	 if($da->lead_type == '0' && $da->classfication == '1' && $da->policy_status == '0')
        	 {
        	     $action .= "&nbsp;<button onclick=move_prospect(".$da->id.") class='btn btn-primary btn-xs'><i class='fa fa-diamond'></i> Prospect</button>";
        	     
        	     $action .= "&nbsp;<button onclick=move_classfication(".$da->id.") class='btn btn-danger btn-xs'><i class='fa fa-arrows'></i> Move</button>";
        	 }
        	 else if($da->lead_type == '1' && $da->classfication == '1' && $da->policy_status == '0')
        	 {
        	     $action .= "&nbsp;<button onclick=move_to_lead(".$da->id.") class='btn btn-danger btn-xs'><i class='fa fa-arrows'></i> Lead</button>";
                
                 if($da->quote_status == '0')
                 {
                    $action .= "&nbsp;<button onclick=send_quote(".$da->id.",'".$da->lclass."')  class='btn btn-success btn-xs'><i class='fa fa-whatsapp'></i> Quote</button>";
                 }
                 else
                 {
                     $action .= "&nbsp;<button onclick=send_quote(".$da->id.",'".$da->lclass."')  class='btn btn-info btn-xs'><i class='fa fa-check'></i>Quote sent</button>";
                 }
                 
                 if($da->due_date != "0000-00-00")
        	     {
        	        $action .= "&nbsp;<button onclick=move_to_nextyear(".$da->id.") class='btn btn-primary btn-xs'><i class='fa fa-step-forward'></i></button>";   
        	     }
        	 }
        	 else if($da->policy_status == '1')
        	 {
        	     $action .= "&nbsp;<a href='generate_policy?id=".$da->id."' class='btn btn-primary btn-xs'><i class='fa fa-file'></i> Save policy</a>";
        	 }
        	 else
        	 {
        	     $action .= "&nbsp;<button onclick=move_classfication(".$da->id.") class='btn btn-danger btn-xs'><i class='fa fa-arrows'></i> Move</button>";
        	     if($da->due_date != "0000-00-00")
        	     {
        	        $action .= "&nbsp;<button onclick=move_to_nextyear(".$da->id.") class='btn btn-primary btn-xs'><i class='fa fa-step-forward'></i></button>";   
        	     }
        	 }
        	 
        	 $agn_name = "";
        	 $usr_name = "";
        	 
        	  $date = "No Due Date";
        	 
        	 if($da->due_date != "0000-00-00")
        	 {
        	    $date = date_format(date_create($da->due_date),"d-m-Y"); 
        	 }
        	 
        	 if($da->agency_and_pos != "all")
        	 {
        	     if($da->agency_and_pos != "")
        	     {
            	     $get_agent_name = $this->lm->get_agent_name($da->agency_and_pos);
            	     $agn_name = $get_agent_name->name;
        	     }
        	     else
        	     {
        	         $agn_name = "";
        	     }
        	 }
        	 else
        	 {
        	     $agn_name = "";
        	 }
        	 
        	 if($da->assigned_user != "all")
        	 {
        	     if($da->assigned_user != "")
        	     {
            	     $get_user = $this->lm->get_user_name($da->assigned_user);
            	     
            	     if($get_user != "")
            	     {
            	       $usr_name = $get_user->name;
            	     }
            	     else
            	     {
            	         $usr_name = "";
            	     }
        	     }
        	     else
        	     {
        	         $usr_name = "";
        	     }
        	 }
        	 else
        	 {
        	     $usr_name = "";
        	 }
        	 
    	    if($da->area_incharge != "all")
            {
                if($da->area_incharge != "")
                {
                     $ai = $this->lm->get_area_incharge($da->area_incharge);
                     
                     if($ai != null)
                     {
                       $ai = $ai->name;
                     }
                     else
                     {
                         $ai = "";
                     }
                }
                else
                {
                        $ai = "";
                }
            }
            else
            {
                 $ai = "";
            } 
        
          $client_name = "<a href='#' onclick=view_data(".$da->id.")>".$da->client_name."</a>";
            $arr[] =array(
                           $a,
                           $client_name,
                           $da->mobile_no,
                           $da->lclass,
                           $da->p_type,
                           $da->b_type,
                           $da->area,
                           $agn_name,
                           $usr_name,
                           $ai,
                           $date,
                           $action,
                        );
            }
    	   $result = array(
            			"draw"=> $draw,
    				    "recordsTotal"=> $this->lm->get_all_datas_count($lead_type,$classification,$category,$bulk_status,$order_category,$search),
    				    "recordsFiltered"=> $this->lm->get_filtered_datas_count($lead_type,$classification,$category,$bulk_status,$order_category,$search),
    				    "data"=>$arr,
    				);
             echo json_encode($result);
    	 }
	 }
	 
  public function followups()
  {
        if( !( $this->session->has_userdata('logged_in') ) ){
            redirect('login', 'refresh');
        }
        
        // if(!$this->auth->can_access('List Follow Ups')){
        //     redirect('access_denied', 'refresh');
        // }
        
      if($this->session->has_userdata('logged_in') && $this->session->userdata('session_role') == "admin") 
    	{    		
		   	$pro_data["project_info"] = $this->mm->fetch_project_info();
		   	$data["users"] = $this->lm->fetch_users();
		   	$data["client_type"] = $this->lm->fetch_client_type();
		   	$data["business"] = $this->lm->fetch_business_type();
		   	$data["class"] = $this->lm->fetch_list_of_policy_type();
    		$this->load->view('header',$pro_data);
    		$this->load->view('followups',$data);
    		$this->load->view('footer',$pro_data);
	    }
	    else if($this->session->has_userdata('logged_in') && ($this->session->userdata('session_role') == "user" || $this->session->userdata('session_role') == "AI"))
	    {
	         $data["users"] = $this->cm->fetch_user_by_session_id($this->session->userdata('session_id'));
	        $check_user_i = $this->cm->fetch_user_permissions($this->session->userdata('session_id'));
	        
	        if($check_user_i->follow_view == "1")
	        {
    	      
	        $pro_data["project_info"] = $this->mm->fetch_project_info();
	        $data["users"] = $this->lm->fetch_users();
	        $data["client_type"] = $this->lm->fetch_client_type();
	        $data["business"] = $this->lm->fetch_business_type();
	        $data["class"] = $this->lm->fetch_list_of_policy_type();
    		$this->load->view('header',$pro_data);
    		$this->load->view('followups',$data);
    		$this->load->view('footer',$pro_data);
	        }
	        else
	        {
	             echo "<script>alert('Permission Denied');window.location.href='home';</script>";
    	          //redirect("home");
	        }
	    }
	    else
	    {
	    	redirect("login");
	    }
  }
  
  public function fetch_all_follow_ups()
  {
       if($this->session->has_userdata('logged_in'))
       {
           $draw = intval($this->input->post("draw")); 
           
           $from_date = $this->input->post("from_date");
           $to_date = $this->input->post("to_date");
           
           $res = $this->lm->fetch_all_follow_ups($from_date,$to_date);
           
           $arr = [];
           $a = 0 ;
        
        foreach($res as $da)
        {
        	$a++;

            $action = "<button id='edit_follow' class='btn btn-info btn-xs' onclick=edit_data(".$da->id.")><i class='fa fa-edit'></i></button> 
                      <a class='btn btn-warning btn-xs' title='".$da->lead_id."' onclick=follow_up_log(".$da->lead_id.")><i class='fa fa-eye'></i></a> 
            		 <button id='delete_follow' class='btn btn-danger btn-xs' onclick=delete_data(".$da->id.")><i class='fa fa-trash-o'></i></button>";
            
            $arr[] = array(
                $a,
                $da->client_name,
                $da->mobile_no,
                date_format(date_create($da->next_follow_up_date),"d-m-Y"),
                date_format(date_create($da->next_follow_up_time),"h:i:sa"),
                date_format(date_create($da->lead_generated_date),"d-m-Y"),
                $da->reason,
                (isset($da->due_date) && !empty($da->due_date)) ? date_format(date_create($da->due_date),"d-m-Y") : "",
                $da->followup_user,
                $action,
            );
        }

        $result = array(
        			"draw"=> $draw,
				    "recordsTotal"=>count($res),
				    "recordsFiltered"=> count($res),
				    "data"=>$arr,
				);
        echo json_encode($result);
		
       }
  }
  
  public function delete_follow_up()
  {
      if($this->session->has_userdata('logged_in'))
       {
           $id = $this->input->post("id");
           $old_data = $this->lm->fetch_edit_follow_up($id);
           $res = $this->lm->delete_follow_up($id);
           if($res){
                 $this->audit->log('follow_up_details', 'DELETE', null, $old_data, null);
            }
       }
  }
  
  public function fetch_edit_follow_up()
  {
       if($this->session->has_userdata('logged_in'))
       {
           $id = $this->input->post("id");
           $res = $this->lm->fetch_edit_follow_up($id);
           echo json_encode($res);
       }
  }
  
   public function edit_follow_up_details()
    {
        if ($this->session->has_userdata('logged_in')) {
            $id = $this->input->post("id");
            $lead_id = $this->input->post("lead_id");
            $follow_up_status = $this->input->post("follow_up_status");
            $follow_up_reason = $this->input->post("follow_up_reason");
            $next_follow_date = $this->input->post("enter_next_follow_date");
            $enter_next_follow_time = $this->input->post("enter_next_follow_time");
            $follow_comment = $this->input->post("follow_comment");
            $follow_up_updated_date = date("Y-m-d"); // current date

            $arr = array("next_follow_up_date" => $next_follow_date);
            $lead_data = $this->lm->get_receiver_email_id($lead_id);
            $update = $this->lm->update_follow_up_details($arr, $lead_id);
            if ($update) {
                $this->audit->log('list_of_leads', 'UPDATE', null, $lead_data, $arr);
            }

            // ✅ Use updated_date or define created_date explicitly
            $data = array(
                "follow_up_status" => $follow_up_status,
                "next_follow_up_date" => $next_follow_date,
                "next_follow_up_time" => $enter_next_follow_time,
                "reason" => $follow_up_reason,
                "comment" => $follow_comment,
                "follow_up_created_date" => $follow_up_updated_date, // ✅ fixed
                "updated_by" => $this->session->userdata('session_id')
            );

            $old_data = $this->lm->fetch_edit_follow_up($id);
            $res = $this->lm->edit_follow_up_details($data, $id);
            if ($res) {
                $this->audit->log('list_of_leads', 'UPDATE', null, $old_data, $data);
            }
        }
    }

   
  // Generate policy //
  
  public function generate_policy()
  {
        if( !( $this->session->has_userdata('logged_in') ) ){
            redirect('login', 'refresh');
        }
        
        // if(!$this->auth->can_access('Create Policy')){
        //     redirect('access_denied', 'refresh');
        // }
        $startdate = $duedate = "";
        if( isset( $_GET['id'] ) && !empty( $_GET['id'] ) ){
            $leadinfo = $this->lm->get_policy_expirydate($_GET['id']);
            if(isset($leadinfo->parent_lead_id) && !empty($leadinfo->parent_lead_id)) {
                $exdate = $leadinfo->policy_ex_date;
                $edate  = new DateTime($exdate);
                $today  = new DateTime();
                
                $startdate = $today->format('Y-m-d');
                if( $edate->format('Y-m-d') > $today->format('Y-m-d')){
                    $edate->add(new DateInterval('P1D'));
                    $startdate = $edate->format('Y-m-d');
                }

                $date = new DateTime($startdate);
                $date->add(new DateInterval('P1Y'));
                $date->sub(new DateInterval('P1D'));
                $duedate = $date->format('Y-m-d');
            }
            // if(!$this->auth->can_access('Update Policy')){
            //     redirect('access_denied', 'refresh');
            // }
        }
    
        if($this->session->has_userdata('logged_in') && $this->session->userdata('session_role') == "admin") 
    	{    		
		   	$pro_data["project_info"]   = $this->mm->fetch_project_info();
		   	$data["users"]              = $this->lm->fetch_users();
		   	$data["client_type"]        = $this->lm->fetch_client_type();
		   	$data["business"]           = $this->lm->fetch_business_type();
		   	$data["class"]              = $this->lm->fetch_list_of_policy_type();
		   	$data["email_templates"]    = $this->lm->fetch_email_templates();
		   	$data["company"]            = $this->lm->fetch_company();
		   	$data["state"]              = $this->lm->fetch_state();
		   	$data["premium_cover_type"] = $this->lm->fetch_premium_cover_type();
	   		$data["rto"]                = $this->lm->fetch_rto();
		   	$data["agents_pos"]         = $this->lm->fetch_agents_pos();
		   	
		   	$data["startdate"]          = $startdate;
            $data["duedate"]            = $duedate;


    		$this->load->view('header',$pro_data);
    		$this->load->view('create_policy',$data);
    		$this->load->view('footer',$pro_data);
	    }
	    else if($this->session->has_userdata('logged_in') && ($this->session->userdata('session_role') == "user" || $this->session->userdata('session_role') == "AI"))
	    {
	        $pro_data["project_info"]       = $this->mm->fetch_project_info();
	        $data["users"]                  = $this->lm->fetch_users();
	        $data["client_type"]            = $this->lm->fetch_client_type();
	        $data["business"]               = $this->lm->fetch_business_type();
	        $data["class"]                  = $this->lm->fetch_list_of_policy_type();
	        $data["company"]                = $this->lm->fetch_company();
		   	$data["state"]                  = $this->lm->fetch_state();
		   	$data["premium_cover_type"]     = $this->lm->fetch_premium_cover_type();
	   		$data["rto"]                    = $this->lm->fetch_rto();
	        $data["agents_pos"]             = $this->lm->fetch_agents_pos();
	        
	        $data["startdate"]              = $startdate;
            $data["duedate"]                = $duedate;

    		$this->load->view('header',$pro_data);
    		$this->load->view('create_policy',$data);
    		$this->load->view('footer',$pro_data);
	    }
	    else
	    {
	    	redirect("login");
	    }
  }
  
      public function upload_policy_document_files()
      {
          if($this->session->has_userdata('logged_in'))
        	    {
            	   $id = $this->input->post("id");
            	   $document_type = $this->input->post("document_type");
            	   
            	    if(isset($_FILES))
            		{
            			$config['upload_path'] = './datas/documents/';
            			$config['allowed_types'] = '*';
            			
            			$this->load->library('upload',$config);
            			$this->upload->initialize($config);
            			if(!$this->upload->do_upload('file'))
            			{
            				$file = '';
            				$file_path = "";
            			}
            			else
            			{
            				$file_path = base_url().'datas/documents/'.$this->upload->data('file_name');
            				$file = $this->upload->data('file_name');
            			}
            		}
            		
            		$data = array("lead_id" =>$id,"document_type"=>$document_type,"document" =>$file);
            		
            		$res = $this->lm->upload_policy_document_files($data);
            		
            		$html = "";
            		$html .="<tr>
            		           <td><a href='./datas/documents/".$res->document."'><i class='fa fa-file'></i></a></td>
            		           <td>".$res->document."</td>
            		           <td>".$res->document_type."</td>
            		           <td><i class='fa fa-edit' onclick=edit_data(".$res->id.")></i></td>
            		           <td><i class='fa fa-trash' onclick=delete_data(".$res->id.")></i></td>
            		         </tr>";
            		 echo $html;
        	    }	 
        	    
      }  
      
      public function fetch_policy_documents()
      {
         if($this->session->has_userdata('logged_in'))
    	 {
    	        
    	       $id = $this->input->post("lead_id");
    	       $res = $this->lm->fetch_policy_doc_files($id); 
    	       $html = "";
    	       
    	       foreach($res as $da)
    	       {
        		$html .="<tr>
        		           <td><a href='./datas/documents/".$da->document."'><i class='fa fa-file'></i></a></td>
        		           <td>".$da->document."</td>
        		           <td>".$da->document_type."</td>
        		           <td><i class='fa fa-edit' onclick=edit_data(".$da->id.")></i></td>
        		           <td><i class='fa fa-trash' onclick=delete_data(".$da->id.")></i></td>
        		         </tr>";
    	       }
    	  }
    	    
    	    echo $html;
      }
  
        public function save_generated_policy()
        {
            if($this->session->has_userdata('logged_in'))
            {
                //$renewal_by = $this->input->post("renewal_by");
                $policy_no = $this->input->post("policy_no");
                $policy_source = $this->input->post("policy_source");
                $lead_created_by = $this->session->userdata('session_name');
                $category = $this->session->userdata('category');
                $ncb = $this->input->post("ncb"); 
                $total_premium = $this->input->post("total_premium");
                $lead_id = $this->input->post("lead_id");
                $policy_premium= $this->input->post("policy_premium");
                $commission_id = $this->input->post("commission_id");
                $policy_agency_pos = $this->input->post("policy_agency_pos");
                $company = $this->input->post("company");
                $no_claim_bonus = $this->input->post("no_claim_bonus");
                $class_type = $this->lm->get_class_type($lead_id);
                $agent_commission = 0;
                $company_com = 0;
                $jayantha_commission = 0;
                $jayantha_agent_commission = 0;
                $add_ons_1  = $this->input->post("add_ons_1");
                $add_ons_2  = $this->input->post("add_ons_2");
                $add_ons_3  = $this->input->post("add_ons_3");
                $add_ons_4  = $this->input->post("add_ons_4");
                $add_ons_5  = $this->input->post("add_ons_5");
                $add_ons_1_details  = $this->input->post("add_ons_1_details");
                $add_ons_2_details  = $this->input->post("add_ons_2_details");
                $add_ons_3_details  = $this->input->post("add_ons_3_details");
                $add_ons_4_details  = $this->input->post("add_ons_4_details");
                $add_ons_5_details  = $this->input->post("add_ons_5_details");
                $own_damage = $this->input->post("total_own_damage");
                $tp = $this->input->post("tot_liability_premium");
                $cpa = $this->input->post("cpa");
                
                $commission_type = "";
                $status = "0";
       
                  if($class_type->class == "1")
                  {
                        $get_lead_info = $this->lm->get_lead_info($lead_id);
                        $bussiness_type = $get_lead_info->business_type;
                        $policy_class = $get_lead_info->class;
                        $policy_type =  $get_lead_info->policy_type;
                        $fuel_type = $get_lead_info->vechi_fuel_type;
                        $cc  = $get_lead_info->vechi_cc;
                        $v_gvw = $get_lead_info->vechi_gvw;
                        $make = $get_lead_info->vechi_make;
                        $model = $get_lead_info->vechi_model;
                        $Varient = $get_lead_info->vechi_varient;
                  }
                  else if($class_type->class == "2")
                  {
                       $bussiness_type = $class_type->business_type;
                       $policy_class = $class_type->class;
                       $policy_type =  $class_type->policy_type;
                       $state = "";
                       $age ="";
                       $rto = "";
                       
                        $disease_husband= $this->input->post("disease_husband");
                        $husband_file= $this->input->post("husband_file");
                        $disease_wife= $this->input->post("disease_husband");
                        $wife_file= $this->input->post("husband_file");
                        $daughter_count = $this->input->post("daughter_count");
                        $son_count = $this->input->post("son_count");
                        $disease_daug_1= $this->input->post("disease_daug_1");
                        $disease_daug_2= $this->input->post("disease_daug_2");
                        $disease_daug_3= $this->input->post("disease_daug_3");
                        $daug_1_file= $this->input->post("daug_1_file");
                        $daug_2_file= $this->input->post("daug_2_file");
                        $daug_2_file= $this->input->post("daug_2_file");
                        $disease_son_1= $this->input->post("disease_son_1");
                        $disease_son_2= $this->input->post("disease_son_2");
                        $disease_son_3= $this->input->post("disease_son_3");
                        $son_1_file= $this->input->post("son_1_file");
                        $son_2_file= $this->input->post("son_2_file");
                        $son_3_file= $this->input->post("son_3_file");
                        $disease_father= $this->input->post("disease_father");
                        $disease_mother= $this->input->post("disease_mother");
                        $father_file= $this->input->post("father_file");
                        $mother_file= $this->input->post("mother_file");
                  }
                  $res = $this->lm->fetch_policy_info($commission_id);
                $agn_commission_type = $res->agn_com_type ;
                
                $ird_od_commission = (isset($res->ird_od_commission) && ($res->ird_od_commission) > 0) ? $res->ird_od_commission : 0;
        		$ird_tp_commission = (isset($res->ird_tp_commission) && ($res->ird_tp_commission) > 0) ? $res->ird_tp_commission : 0;
        		
                if($agn_commission_type != "TP")
                {
                    $jayantha_commission = ($own_damage * $ird_od_commission)/100;
                    $jayantha_agent_commission = ($own_damage * $ird_od_commission)/100;
                }
                if($agn_commission_type != "OD")
        		{
        			$jayantha_commission = (float)$jayantha_commission + (($tp * $ird_tp_commission)/100);   
        		}
        		
        		if($agn_commission_type == "OD_AND_TP")
        		{
        		    $a = ($own_damage * $ird_od_commission)/100;
        			$b = (float)$jayantha_commission + (($tp * $ird_tp_commission)/100);   
        			$jayantha_commission=$a+$b;
        		}
        		
                    if($class_type->class == "1")
                    {
                        $res = $this->lm->fetch_policy_info($commission_id);
                        $commission_type = $res->commission_type;
                        
                        if($res != null && $res->commission_type == "2" || $res->commission_type == "3" || $res->commission_type == "1")
                        {
                            $spl_com = $this->lm->check_spl_commission_for_agent($commission_id,$policy_agency_pos); 
                                 
                                if($res->is_ncb == "Yes" && $no_claim_bonus == "Yes")
                                {
                                          $status = "1";
                                          $company_com = $total_premium * ($res->ncb_percentage)/100;
                                          $agent_status = $this->lm->fetch_agent_category($policy_agency_pos);
                                     
                                           if($spl_com != null || $spl_com != "")
                                           {
                                               
                                                  if($res->agn_com_type == "OD")
                                                  {
                                                      $agent_commission = ($own_damage * $spl_com->special_com)/100;
                                                  }
                                                  else if($res->agn_com_type == "TP")
                                                  {
                                                       $agent_commission = ($tp * $spl_com->special_com)/100;
                                                  }
                                                  else if($res->agn_com_type == "ON-NET")
                                                  {
                                                      $agent_commission = ($total_premium * $spl_com->special_com)/100;
                                                  }
                                                  else if($res->agn_com_type == "OD_AND_TP")
                                                  {
                                                      $agent_commission = ($total_premium * $spl_com->special_com)/100;
                                                  }
                                           }
                                           else
                                           {
                                              if($agent_status->commission_category == "A")
                                              {
                                                  $agent_commission = ($total_premium * $res->a_ncb)/100;
                                              }
                                              else if($agent_status->commission_category == "B")
                                              {
                                                    $agent_commission = ($total_premium * $res->b_ncb)/100;
                                              }
                                              else if($agent_status->commission_category == "C")
                                              {
                                                    $agent_commission = ($total_premium * $res->c_ncb)/100;
                                              }
                                              else if($agent_status->commission_category == "D")
                                              {
                                                 $agent_commission = ($total_premium * $res->d_ncb)/100;
                                              }
                                           }
                                }
                                else
                                {
                                    
                                    if($res->on_net != "0")
                                    {
                                        $own_od = "";
                                        $own_tp = "";
                                        $company_com = $total_premium * ($res->on_net)/100;
                                        $on_net = $company_com;
                                    }
                                    else if($res->own_od != "0" && $res->own_tp != "0")
                                    {
                                        $own_od = $own_damage * ($res->own_od)/100;
                                        $own_tp = $tp * ($res->own_tp)/100;
                                        $company_com = $own_od+$own_tp;
                                        $on_net = "";
                                    }
                                    else if($res->own_od != "0")
                                    {
                                        $on_net = ""; 
                                        $own_tp = "";
                                        $company_com = $own_damage * ($res->own_od)/100;
                                        $own_od = $company_com;
                                    }
                                    else if($res->own_tp != "0")
                                    {
                                        $own_od = ""; 
                                        $on_net = "";
                                        $company_com = $tp * ($res->own_tp)/100;
                                        $own_tp = $company_com;
                                    }
                                
                                    if($spl_com != null || $spl_com != "")
                                    {
                                        
                                              if($res->agn_com_type == "OD")
                                              {
                                                  $agent_commission = ($own_damage * $spl_com->special_com)/100;
                                              }
                                              else if($res->agn_com_type == "TP")
                                              {
                                                   $agent_commission = ($tp * $spl_com->special_com)/100;
                                              }
                                              else if($res->agn_com_type == "ON-NET")
                                              {
                                                  $agent_commission = ($total_premium * $spl_com->special_com)/100;
                                              }
                                              else if($res->agn_com_type == "OD_AND_TP")
                                              {
                                                  $agent_commission = ($total_premium * $spl_com->special_com)/100;
                                              }
                                       }
                                    else
                                    {
                                          $agent_status = $this->lm->fetch_agent_category($policy_agency_pos);
                                          
                                          if($res->agn_com_type == "OD")
                                          {
                                              if($agent_status->commission_category == "A")
                                              {
                                                  $agent_commission = ($own_damage * $res->a_od)/100;
                                              }
                                              else if($agent_status->commission_category == "B")
                                              {
                                                  $agent_commission = ($own_damage * $res->b_od)/100;
                                              }
                                              else if($agent_status->commission_category == "C")
                                              {
                                                 echo $agent_commission = ($own_damage * $res->c_od)/100;
                                              }
                                              else if($agent_status->commission_category == "D")
                                              {
                                                  $agent_commission = ($own_damage * $res->d_od)/100;
                                              }
                                          }
                                          else if($res->agn_com_type == "TP")
                                          {
                                              if($agent_status->commission_category == "A")
                                              {
                                                  $agent_commission = ($tp * $res->a_tp)/100;
                                              }
                                              else if($agent_status->commission_category == "B")
                                              {
                                                  $agent_commission = ($tp * $res->b_tp)/100;
                                              }
                                              else if($agent_status->commission_category == "C")
                                              {
                                                  $agent_commission = ($tp * $res->c_tp)/100;
                                              }
                                              else if($agent_status->commission_category == "D")
                                              {
                                                  $agent_commission = ($tp * $res->d_tp)/100;
                                              }
                                          }
                                          else if($res->agn_com_type == "ON-NET")
                                          {
                                              if($agent_status->commission_category == "A")
                                              {
                                                  $agent_commission = ($total_premium * $res->a_net)/100;
                                              }
                                              else if($agent_status->commission_category == "B")
                                              {
                                                  $agent_commission = ($total_premium * $res->b_net)/100;
                                              }
                                              else if($agent_status->commission_category == "C")
                                              {
                                                  $agent_commission = ($total_premium * $res->c_net)/100;
                                              }
                                              else if($agent_status->commission_category == "D")
                                              {
                                                  $agent_commission = ($total_premium * $res->d_net)/100;
                                              }
                                          }
                                          else if($res->agn_com_type == "OD_AND_TP")
                                          {
                                              if($agent_status->commission_category == "A")
                                              {
                                                  $agent_od = ($own_damage * $res->a_od)/100;
                                                  $agent_tp = ($tp * $res->a_tp)/100;
                                                  $agent_commission = $agent_od+$agent_tp;
                                              }
                                              else if($agent_status->commission_category == "B")
                                              {
                                                  $agent_od = ($own_damage * $res->b_od)/100;
                                                  $agent_tp = ($tp * $res->b_tp)/100;
                                                  $agent_commission = $agent_od+$agent_tp;
                                              }
                                              else if($agent_status->commission_category == "C")
                                              {
                                                  $agent_od = ($own_damage * $res->c_od)/100;
                                                  $agent_tp = ($tp * $res->c_tp)/100;
                                                  $agent_commission = $agent_od+$agent_tp;
                                              }
                                              else if($agent_status->commission_category == "D")
                                              {
                                                  $agent_od = ($own_damage * $res->d_od)/100;
                                                  $agent_tp = ($tp * $res->d_tp)/100;
                                                  $agent_commission = $agent_od+$agent_tp;
                                              }
                                         }
                                       }
                                }
                        }
                    }
                    else
                    {
                        $res = $this->lm->fetch_policy_info($commission_id);
                        $commission_type = $res->commission_type;
                    
                        if($res != null && $res->commission_type == "3" || $res->commission_type == "1")
                        {
                                if($res->is_ncb == "Yes" && $no_claim_bonus == "Yes")
                                {
                                          $company_com = $total_premium * ($res->ncb_percentage)/100;
                                          $agent_status = $this->lm->fetch_agent_category($policy_agency_pos);
                                     
                                          if($agent_status->commission_category == "A")
                                          {
                                              $agent_commission = ($total_premium * $res->a_ncb)/100;
                                          }
                                          else if($agent_status->commission_category == "B")
                                          {
                                                $agent_commission = ($total_premium * $res->b_ncb)/100;
                                          }
                                          else if($agent_status->commission_category == "C")
                                          {
                                                $agent_commission = ($total_premium * $res->c_ncb)/100;
                                          }
                                          else if($agent_status->commission_category == "D")
                                          {
                                                $agent_commission = ($total_premium * $res->d_ncb)/100;
                                          }
                                }
                                else 
                                {
                                    if($res->on_net != "0")
                                    {
                                        $own_od = "";
                                        $own_tp = "";
                                        $company_com = $total_premium * ($res->on_net)/100;
                                        $on_net = $company_com;
                                    }
                                    
                                     $agent_status = $this->lm->fetch_agent_category($policy_agency_pos);
                                     
                                          if($agent_status->commission_category == "A")
                                          {
                                              $agent_commission = ($total_premium * $res->a_net)/100;
                                          }
                                          else if($agent_status->commission_category == "B")
                                          {
                                              $agent_commission = ($total_premium * $res->b_net)/100;
                                          }
                                          else if($agent_status->commission_category == "C")
                                          {
                                              $agent_commission = ($total_premium * $res->c_net)/100;
                                          }
                                          else if($agent_status->commission_category == "D")
                                          {
                                              $agent_commission = ($total_premium * $res->d_net)/100;
                                          }
                                }
                        }
                    }
                    if($company_com <= $jayantha_commission)
                    {
                        $jayantha_commission = $company_com;
                        $company_com = 0;
                    }
                    else
                    {
                         $company_com = $company_com - $jayantha_commission;
                    }
                    
                     if($agent_commission <= $jayantha_agent_commission)
                    {
                           $jayantha_agent_commission = $agent_commission;
                           $agent_commission = 0;
                           // $jayantha_agent_commission;
                    }
                    else
                    {
                        $agent_commission = $agent_commission - $jayantha_agent_commission;
                    }
                        
                        // for jayantha and  unicorn commission combine - 19.05.2025
                          $jayantha_agent_commission= $jayantha_agent_commission+$agent_commission;
                          $agent_commission=0;
                    
                    
                  
        	        $data = array(
                        "lead_id" =>$this->input->post("lead_id"),
                   //     "renewal_user" =>$this->input->post("renewal_user"),
                        "policy_client_ref_no"=> $this->input->post("policy_client_ref_no"),
                        "policy_cover_note_no"=> $this->input->post("policy_cover_note_no"),
                        "policy_no"=> $this->input->post("policy_no"),
                        "policy_s_date"=> $this->input->post("policy_s_date"),
                        "policy_ex_date"=> $this->input->post("policy_ex_date"),
                        "policy_premium"=> $this->input->post("policy_premium"),
                        "policy_terms"=> $this->input->post("policy_terms"),
                        "payment_frequency"=> $this->input->post("payment_frequency"),
                        "next_due_date"=> $this->input->post("next_due_date"),
                        "renewable_flag"=> $this->input->post("renewable_flag"),
                        "add_ons_opted"=> $this->input->post("add_ons_opted"),
                        "add_ons_not_opt" =>$this->input->post("add_ons_not_opt"),
                        "lead_type" =>"2",
                        "sum_insured"=> $this->input->post("sum_insured"),
                        "discount_percent"=> $this->input->post("discount_percent"),
                        "no_claim_bonus"=> $this->input->post("no_claim_bonus"),
                        "no_claim_bonus_val"=> $this->input->post("no_claim_bonus_val"),
                        "cpa"=> $this->input->post("cpa"),
                        "total_own_damage"=> $this->input->post("total_own_damage"),
                        "tot_add_on_premium"=> $this->input->post("tot_add_on_premium"),
                        "commisson_base_premium"=> $this->input->post("commisson_base_premium"),
                        "basic_tp"=> $this->input->post("basic_tp"),
                        "owner_driver_pa"=> $this->input->post("owner_driver_pa"),
                        "owner_diver_amt"=> $this->input->post("owner_diver_amt"),
                        "no_of_year_own_drv"=> $this->input->post("no_of_year_own_drv"),
                        "fuel_kit"=> $this->input->post("fuel_kit"),
                        "fuel_kit_amt"=> $this->input->post("fuel_kit_amt"),
                        "geograpical"=> $this->input->post("geograpical"),
                        "geograpical_amt"=> $this->input->post("geograpical_amt"),
                        "un_named_passenger_pa"=> $this->input->post("un_named_passenger_pa"),
                        "un_named_passenger_amt"=> $this->input->post("un_named_passenger_amt"),
                        "no_seats_per_person"=> $this->input->post("no_seats_per_person"),
                        "no_seats_per_person_amt"=> $this->input->post("no_seats_per_person_amt"),
                        "LL_paid "=> $this->input->post("llp"),
                        "LL_paid_amt"=> $this->input->post("llp_amt"),
                        "no_drv_emp"=> $this->input->post("no_drv_emp"),
                        "pa_paid_drv"=> $this->input->post("pa_paid_drv"),
                        "pa_paid_drv_amt"=> $this->input->post("pa_paid_drv_amt"),
                        "no_seats_per_person1"=> $this->input->post("no_seats_per_person1"),
                        "no_seats_per_person_amt1"=> $this->input->post("no_seats_per_person_amt1"),
                        "tot_liability_premium"=> $this->input->post("tot_liability_premium"),
                        "total_premium"=> $this->input->post("total_premium"),
                        "gst"=> $this->input->post("gst"),
                        "premium_gst"=> $this->input->post("premium_gst"),
                        "policy_issue_date"=> $this->input->post("policy_issue_date"),
                        "policy_agency_pos"=> $this->input->post("policy_agency_pos"),
                        "policy_source"=> $this->input->post("policy_source"),
                        "policy_user"=> $this->input->post("policy_user"),
                        "policy_location"=> $this->input->post("policy_location"),
                        "previous_policy_no"=> $this->input->post("previous_policy_no"),
                        "previous_insurer"=> $this->input->post("previous_insurer"),
                        "previous_insurance_plan"=> $this->input->post("previous_insurance_plan"),
                        "previous_agency_pos"=> $this->input->post("previous_agency_pos"),
                        "previous_source"=> $this->input->post("previous_source"),
                        "dectable_details"=> $this->input->post("dectable_details"),
                        "policy_additional_info"=> $this->input->post("policy_additional_info"),
                        "reference_no"=> $this->input->post("reference_no"),
                        "other_reference_no"=> $this->input->post("other_reference_no"),
                        "policy_received"=> $this->input->post("policy_received"),
                        "policy_verified"=> $this->input->post("policy_verified"),
                        "policy_verified_info"=> $this->input->post("policy_verified_info"),
                        "policy_cancelled"=> $this->input->post("policy_cancelled"),
                        "policy_cancelled_info"=> $this->input->post("policy_cancelled_info"),
                        "commisson_generation"=> $this->input->post("commisson_generation"),
                        "payment_type"=> $this->input->post("payment_type"),
                        "pay_ref_no"=> $this->input->post("pay_ref_no"),
                        "bank_name"=> $this->input->post("bank_name"),
                        "payment_check_date"=> $this->input->post("payment_check_date"),
                        "payment_and_check_no"=> $this->input->post("payment_and_check_no"),
                        "remarks"=> $this->input->post("remarks"),
                        //"payment_collected_date"=> $this->input->post("payment_collected_date"),
                        "add_ons_1" =>$add_ons_1,
                        "add_ons_2" =>$add_ons_2,
                        "add_ons_3" =>$add_ons_3,
                        "add_ons_4" =>$add_ons_4,
                        "add_ons_5" =>$add_ons_5,
                        "add_ons_1_details" =>$add_ons_1_details,
                        "add_ons_2_details" =>$add_ons_2_details,
                        "add_ons_3_details" =>$add_ons_3_details,
                        "add_ons_4_details" =>$add_ons_4_details,
                        "add_ons_5_details" =>$add_ons_5_details,
                        "commission_id" =>$commission_id,
                        "company"=> $this->input->post("company"),
                        "commission_type"=> ((isset($commission_type) && !empty($commission_type)) ? $commission_type : 0),
                        "agent_commission_amt"=> $jayantha_agent_commission,
                        "own_commission_amt"=> $jayantha_commission,
                        "agent_commission"=> $agent_commission,
                        "own_commission"=> $company_com,
                        //"remarks"=> $this->input->post("remarks"),
                        "created_by"=> $this->session->userdata('session_id'),
                        "created_at"=> date("Y-m-d H:i:s"),
                        "com_trigger_status" => "1",
                        "com_trigger_date" =>date("Y-m-d"),
                        "calc_com_status" =>"1",
                        );
                        
                    // 2023-06-01 start
                    if($class_type->class == "1") {
                        if(in_array($this->input->post('policy_premium'), ['1', '4'])) { 
                            $data['od_start_date']  = $this->input->post('od_start_date');
                            $data['od_end_date']    = $this->input->post('od_end_date');
                            $data['tp_start_date']  = $this->input->post('tp_start_date');
                            $data['tp_end_date']    = $this->input->post('tp_end_date');
                        }
                    }
                    // 2023-06-01 end
                        
                    if($class_type->class == "2")
                    {
                            if(isset($_FILES))
                    		{
                    			$config['upload_path'] = './datas/Health_declaration/';
                    			$config['allowed_types'] = '*';
                    			
                    			$this->load->library('upload',$config);
                    			$this->upload->initialize($config);
                    			if(!$this->upload->do_upload('husband_file'))
                    			{
                    				$husband_file = "";
                    			}
                    			else
                    			{
                    				$husband_file = $this->upload->data('file_name');
                    			}
                    		} 
                    		
                    		if(isset($_FILES))
                    		{
                    			$config['upload_path'] = './datas/Health_declaration/';
                    			$config['allowed_types'] = '*';
                    			
                    			$this->load->library('upload',$config);
                    			$this->upload->initialize($config);
                    			if(!$this->upload->do_upload('wife_file'))
                    			{
                    				$wife_file = "";
                    			}
                    			else
                    			{
                    				$wife_file = $this->upload->data('file_name');
                    			}
                    		} 
                    		
                    		
                            if(isset($_FILES))
                            {
                                $config['upload_path'] = './datas/Health_declaration/';
                                $config['allowed_types'] = '*';
                                
                                $this->load->library('upload',$config);
                                $this->upload->initialize($config);
                                if(!$this->upload->do_upload('father_file'))
                                {
                                        $father_file = "";
                                }
                                else
                                {
                                        $father_file = $this->upload->data('file_name');
                                }
                            } 
                            
                            if(isset($_FILES))
                            {
                                $config['upload_path'] = './datas/Health_declaration/';
                                $config['allowed_types'] = '*';
                                
                                $this->load->library('upload',$config);
                                $this->upload->initialize($config);
                                
                                if(!$this->upload->do_upload('mother_file'))
                                {
                                    $mother_file = "";
                                }
                                else
                                {
                                    $mother_file = $this->upload->data('file_name');
                                }
                            } 
                            
                           
                            if(isset($_FILES))
                            {
                                $config['upload_path'] = './datas/Health_declaration/';
                                $config['allowed_types'] = '*';
                                
                                $this->load->library('upload',$config);
                                $this->upload->initialize($config);
                                
                                if(!$this->upload->do_upload('daug_1_file'))
                                {
                                    $daug_1_file = "";
                                }
                                else
                                {
                                    $daug_1_file = $this->upload->data('file_name');
                                }
                            }
                            
                            if(isset($_FILES))
                            {
                                $config['upload_path'] = './datas/Health_declaration/';
                                $config['allowed_types'] = '*';
                                
                                $this->load->library('upload',$config);
                                $this->upload->initialize($config);
                                
                                if(!$this->upload->do_upload('daug_2_file'))
                                {
                                    $daug_2_file = "";
                                }
                                else
                                {
                                    $daug_2_file = $this->upload->data('file_name');
                                }
                            }
                            
                            if(isset($_FILES))
                            {
                                $config['upload_path'] = './datas/Health_declaration/';
                                $config['allowed_types'] = '*';
                                
                                $this->load->library('upload',$config);
                                $this->upload->initialize($config);
                                
                                if(!$this->upload->do_upload('daug_3_file'))
                                {
                                    $daug_3_file = "";
                                }
                                else
                                {
                                    $daug_3_file = $this->upload->data('file_name');
                                }
                            }
                            
                            if(isset($_FILES))
                            {
                                $config['upload_path'] = './datas/Health_declaration/';
                                $config['allowed_types'] = '*';
                                
                                $this->load->library('upload',$config);
                                $this->upload->initialize($config);
                                
                                if(!$this->upload->do_upload('son_1_file'))
                                {
                                    $son_1_file = "";
                                }
                                else
                                {
                                    $son_1_file = $this->upload->data('file_name');
                                }
                            }
                            
                            if(isset($_FILES))
                            {
                                $config['upload_path'] = './datas/Health_declaration/';
                                $config['allowed_types'] = '*';
                                
                                $this->load->library('upload',$config);
                                $this->upload->initialize($config);
                                
                                if(!$this->upload->do_upload('son_2_file'))
                                {
                                    $son_2_file = "";
                                }
                                else
                                {
                                    $son_2_file = $this->upload->data('file_name');
                                }
                            }
                            
                            if(isset($_FILES))
                            {
                                $config['upload_path'] = './datas/Health_declaration/';
                                $config['allowed_types'] = '*';
                                
                                $this->load->library('upload',$config);
                                $this->upload->initialize($config);
                                
                                if(!$this->upload->do_upload('son_3_file'))
                                {
                                    $son_3_file = "";
                                }
                                else
                                {
                                    $son_3_file = $this->upload->data('file_name');
                                }
                            }
                             $id = $this->input->post("lead_id");
                        
                       $health_details = array(
                            "disease_husband" => ($disease_husband == "undefined") ? ""  : $disease_husband,
                            "husband_file" => ($husband_file == "undefined") ? ""  : $husband_file,
                            "disease_wife" =>($disease_wife == "undefined") ? ""  : $disease_wife,
                            "wife_file" =>($wife_file == "undefined") ? ""  : $wife_file,
                            "disease_daug_1" =>($disease_daug_1 == "undefined") ? ""  : $disease_daug_1,
                            "disease_daug_2" =>($disease_daug_2 == "undefined") ? ""  : $disease_daug_2 ,
                            "disease_daug_3" =>($disease_daug_3 == "undefined") ? ""  : $disease_daug_3,
                            "daug_1_file" =>($daug_1_file == "undefined") ? ""  : $daug_1_file,
                            "daug_2_file" =>($daug_2_file == "undefined") ? ""  : $daug_2_file,
                            "daug_3_file" =>($daug_3_file == "undefined") ? ""  : $daug_3_file,
                            "disease_son_1" =>($disease_son_1 == "undefined") ? ""  : $disease_son_1,
                            "disease_son_2" =>($disease_son_2 == "undefined") ? ""  : $disease_son_2,
                            "disease_son_3" =>($disease_son_3 == "undefined") ? ""  : $disease_son_3,
                            "son_1_file" =>($son_1_file == "undefined") ? ""  : $son_1_file,
                            "son_2_file" =>($son_2_file == "undefined") ? ""  : $son_2_file,
                            "son_3_file" =>($son_3_file == "undefined") ? ""  : $son_3_file ,
                            "disease_father" =>($disease_father == "undefined") ? ""  : $disease_father,
                            "disease_mother" =>($disease_mother == "undefined") ? ""  : $disease_mother,
                            "father_file" =>($father_file == "undefined") ? ""  : $father_file,
                            "mother_file" =>($mother_file == "undefined") ? ""  : $mother_file,
                        );
                        
                        //$res = $this->lm->update_health_policy_details($health_details,$id);
                        
                        $_health = $this->lm->get_health_details($id);
                            
                        $res = $this->lm->update_health_policy_details($health_details,$id);
                        
                        if( $res ){
            		        $this->audit->log('health_details', 'UPDATE', null, $_health, $health_details);
            		    }
                    }
                    
                    if(!$this->lm->check_policy_this_no_already_exits($policy_no))
                    {
                        if(!$this->lm->check_lead_id_already_exits_in_policy($lead_id))
                        {
                            $res = $this->lm->save_generated_policy($data);
                            if( $res ){
            	                $this->audit->log('policy_info', 'INSERT', null, null, $data);
            	            }
                            if($res)
                            {
                                
                                $id = $this->input->post("lead_id");
                                $lead_data = $this->lm->get_receiver_email_id($id);
                                $arr = array("lead_type" =>"2","lead_status"=>"completed");
                                $data_1 = $this->lm->update_lead_type_status($arr,$id);
                                if($data_1){
                	                 $this->audit->log('list_of_leads', 'UPDATE', null, $lead_data, $arr);
                	            }
                                $this->acc_own_commission_ledg($id);
                                $this->acc_agn_commission_ledg($id);
                                
                            }
                            $activity_log = array("lead_id"=>$id,"action"=>"New Policy Generated","action_type"=>"generate_policy","created_by"=>$this->session->userdata('session_name'),"time"=>date("Y-m-d H:i:s"));
                            $add_activity = $this->lm->add_activity_log($activity_log);
                            if( $add_activity ){
            	                 $this->audit->log('notification_log', 'INSERT', null, null, $activity_log);
            	             }
                            echo "success";
                        }
                        else
                        {
                             echo "Lead Id Already Exits";
                        }
                    }
                    else
                    {
                        echo "Policy No Already Exits";
                    }
           }
    }
    
     public function update_generated_policy()
        {
            if($this->session->has_userdata('logged_in'))
            {
                $policy_no = $this->input->post("policy_no");
                $policy_source = $this->input->post("policy_source");
                $lead_created_by = $this->session->userdata('session_name');
                $category = $this->session->userdata('category');
                $ncb = $this->input->post("ncb"); 
                $total_premium = $this->input->post("total_premium");
                $lead_id = $this->input->post("lead_id");
                $policy_premium= $this->input->post("policy_premium");
                $commission_id = $this->input->post("commission_id");
                $policy_agency_pos = $this->input->post("policy_agency_pos");
                $company = $this->input->post("company");
                
                //2023-05-26 start
                $cpa = $this->input->post("cpa");
                
                $class_type = $this->lm->get_class_type($lead_id);
                
                 
                $add_ons_1  = $this->input->post("add_ons_1");
                $add_ons_2  = $this->input->post("add_ons_2");
                $add_ons_3  = $this->input->post("add_ons_3");
                $add_ons_4  = $this->input->post("add_ons_4");
                $add_ons_5  = $this->input->post("add_ons_5");
                $add_ons_1_details  = $this->input->post("add_ons_1_details");
                $add_ons_2_details  = $this->input->post("add_ons_2_details");
                $add_ons_3_details  = $this->input->post("add_ons_3_details");
                $add_ons_4_details  = $this->input->post("add_ons_4_details");
                $add_ons_5_details  = $this->input->post("add_ons_5_details");
                $own_damage = $this->input->post("total_own_damage");
                $tp = $this->input->post("tot_liability_premium");
                    
                    
        	      $data = array(
            	        "company" => $company,
            	        "policy_client_ref_no"=> $this->input->post("policy_client_ref_no"),
                        "policy_cover_note_no"=> $this->input->post("policy_cover_note_no"),
                        "policy_no"=> $this->input->post("policy_no"),
                        "policy_s_date"=> $this->input->post("policy_s_date"),
                        "policy_ex_date"=> $this->input->post("policy_ex_date"),
                        "policy_premium"=> $this->input->post("policy_premium"),
                        "policy_terms"=> $this->input->post("policy_terms"),
                        "payment_frequency"=> $this->input->post("payment_frequency"),
                        "next_due_date"=> $this->input->post("next_due_date"),
                        "renewable_flag"=> $this->input->post("renewable_flag"),
                        "add_ons_opted"=> $this->input->post("add_ons_opted"),
                        "add_ons_not_opt" =>$this->input->post("add_ons_not_opt"),
                        "lead_type" =>"2",
                        "sum_insured"=> $this->input->post("sum_insured"),
                        "discount_percent"=> $this->input->post("discount_percent"),
                        "no_claim_bonus"=> $this->input->post("no_claim_bonus"),
                        "no_claim_bonus_val"=> $this->input->post("no_claim_bonus_val"),
                        "cpa"=> $this->input->post("cpa"), //2023-05-26 start
                        "total_own_damage"=> $this->input->post("total_own_damage"),
                        "tot_add_on_premium"=> $this->input->post("tot_add_on_premium"),
                        "commisson_base_premium"=> $this->input->post("commisson_base_premium"),
                        "basic_tp"=> $this->input->post("basic_tp"),
                        "owner_driver_pa"=> $this->input->post("owner_driver_pa"),
                        "owner_diver_amt"=> $this->input->post("owner_diver_amt"),
                        "no_of_year_own_drv"=> $this->input->post("no_of_year_own_drv"),
                        "fuel_kit"=> $this->input->post("fuel_kit"),
                        "fuel_kit_amt"=> $this->input->post("fuel_kit_amt"),
                        "geograpical"=> $this->input->post("geograpical"),
                        "geograpical_amt"=> $this->input->post("geograpical_amt"),
                        "un_named_passenger_pa"=> $this->input->post("un_named_passenger_pa"),
                        "un_named_passenger_amt"=> $this->input->post("un_named_passenger_amt"),
                        "no_seats_per_person"=> $this->input->post("no_seats_per_person"),
                        "no_seats_per_person_amt"=> $this->input->post("no_seats_per_person_amt"),
                        "LL_paid "=> $this->input->post("llp"),
                        "LL_paid_amt"=> $this->input->post("llp_amt"),
                        "no_drv_emp"=> $this->input->post("no_drv_emp"),
                        "pa_paid_drv"=> $this->input->post("pa_paid_drv"),
                        "pa_paid_drv_amt"=> $this->input->post("pa_paid_drv_amt"),
                        "no_seats_per_person1"=> $this->input->post("no_seats_per_person1"),
                        "no_seats_per_person_amt1"=> $this->input->post("no_seats_per_person_amt1"),
                        "tot_liability_premium"=> $this->input->post("tot_liability_premium"),
                        "total_premium"=> $this->input->post("total_premium"),
                        "gst"=> $this->input->post("gst"),
                        "premium_gst"=> $this->input->post("premium_gst"),
                        "policy_issue_date"=> $this->input->post("policy_issue_date"),
                        "policy_agency_pos"=> $this->input->post("policy_agency_pos"),
                        "policy_source"=> $this->input->post("policy_source"),
                        "policy_user"=> $this->input->post("policy_user"),
                        "policy_location"=> $this->input->post("policy_location"),
                        "previous_policy_no"=> $this->input->post("previous_policy_no"),
                        "previous_insurer"=> $this->input->post("previous_insurer"),
                        "previous_insurance_plan"=> $this->input->post("previous_insurance_plan"),
                        "previous_agency_pos"=> $this->input->post("previous_agency_pos"),
                        "previous_source"=> $this->input->post("previous_source"),
                        "dectable_details"=> $this->input->post("dectable_details"),
                        "policy_additional_info"=> $this->input->post("policy_additional_info"),
                        "reference_no"=> $this->input->post("reference_no"),
                        "other_reference_no"=> $this->input->post("other_reference_no"),
                        "policy_received"=> $this->input->post("policy_received"),
                        "policy_verified"=> $this->input->post("policy_verified"),
                        "policy_verified_info"=> $this->input->post("policy_verified_info"),
                        "policy_cancelled"=> $this->input->post("policy_cancelled"),
                        "policy_cancelled_info"=> $this->input->post("policy_cancelled_info"),
                        "commisson_generation"=> $this->input->post("commisson_generation"),
                        "payment_type"=> $this->input->post("payment_type"),
                        "pay_ref_no"=> $this->input->post("pay_ref_no"),
                        "bank_name"=> $this->input->post("bank_name"),
                        "payment_check_date"=> $this->input->post("payment_check_date"),
                        "payment_and_check_no"=> $this->input->post("payment_and_check_no"),
                        "remarks"=> $this->input->post("remarks"),
                       "add_ons_1" =>$add_ons_1,
                       "add_ons_2" =>$add_ons_2,
                       "add_ons_3" =>$add_ons_3,
                       "add_ons_4" =>$add_ons_4,
                       "add_ons_5" =>$add_ons_5,
                       "add_ons_1_details" =>$add_ons_1_details,
                       "add_ons_2_details" =>$add_ons_2_details,
                       "add_ons_3_details" =>$add_ons_3_details,
                       "add_ons_4_details" =>$add_ons_4_details,
                       "add_ons_5_details" =>$add_ons_5_details,
                       "updated_by"=> $this->session->userdata('session_id'),
                       "updated_at"=> date("Y-m-d H:i:s"),
                    );
                    
                    // 2023-06-01 start
                    if($class_type->class == "1") {
                        if(in_array($this->input->post('policy_premium'), ['1', '4'])) { 
                            $data['od_start_date']  = $this->input->post('od_start_date');
                            $data['od_end_date']    = $this->input->post('od_end_date');
                            $data['tp_start_date']  = $this->input->post('tp_start_date');
                            $data['tp_end_date']    = $this->input->post('tp_end_date');
                        }
                        
                        // 2023-06-08
                        $data['applied_splcommission'] = ($this->input->post('applied_splcom') == "null") ? NULL : $this->input->post('applied_splcom');
                    }
                    // 2023-06-01 end

                    
                    if($class_type->class == "2")
                    {
                        
                            $disease_husband = $this->input->post("disease_husband");
                            $disease_wife    = $this->input->post("disease_wife");
                            $disease_daug_1  = $this->input->post("disease_daug_1");
                            $disease_daug_2  = $this->input->post("disease_daug_2");
                            $disease_daug_3  = $this->input->post("disease_daug_3");
                            $disease_son_1   = $this->input->post("disease_son_1");
                            $disease_son_2   = $this->input->post("disease_son_2");
                            $disease_son_3   = $this->input->post("disease_son_3");
                            $disease_father  = $this->input->post("disease_father");
                            $disease_mother  = $this->input->post("disease_mother");

                            if(isset($_FILES))
                    		{
                    			$config['upload_path'] = './datas/Health_declaration/';
                    			$config['allowed_types'] = '*';
                    			
                    			$this->load->library('upload',$config);
                    			$this->upload->initialize($config);
                    			if(!$this->upload->do_upload('husband_file'))
                    			{
                    				$husband_file = "";
                    			}
                    			else
                    			{
                    				$husband_file = $this->upload->data('file_name');
                    			}
                    		} 
                    		
                    		if(isset($_FILES))
                    		{
                    			$config['upload_path'] = './datas/Health_declaration/';
                    			$config['allowed_types'] = '*';
                    			
                    			$this->load->library('upload',$config);
                    			$this->upload->initialize($config);
                    			if(!$this->upload->do_upload('wife_file'))
                    			{
                    				$wife_file = "";
                    			}
                    			else
                    			{
                    				$wife_file = $this->upload->data('file_name');
                    			}
                    		} 
                    		
                    		
                            if(isset($_FILES))
                            {
                                $config['upload_path'] = './datas/Health_declaration/';
                                $config['allowed_types'] = '*';
                                
                                $this->load->library('upload',$config);
                                $this->upload->initialize($config);
                                if(!$this->upload->do_upload('father_file'))
                                {
                                        $father_file = "";
                                }
                                else
                                {
                                        $father_file = $this->upload->data('file_name');
                                }
                            } 
                            
                            if(isset($_FILES))
                            {
                                $config['upload_path'] = './datas/Health_declaration/';
                                $config['allowed_types'] = '*';
                                
                                $this->load->library('upload',$config);
                                $this->upload->initialize($config);
                                
                                if(!$this->upload->do_upload('mother_file'))
                                {
                                    $mother_file = "";
                                }
                                else
                                {
                                    $mother_file = $this->upload->data('file_name');
                                }
                            } 
                            
                           
                            if(isset($_FILES))
                            {
                                $config['upload_path'] = './datas/Health_declaration/';
                                $config['allowed_types'] = '*';
                                
                                $this->load->library('upload',$config);
                                $this->upload->initialize($config);
                                
                                if(!$this->upload->do_upload('daug_1_file'))
                                {
                                    $daug_1_file = "";
                                }
                                else
                                {
                                    $daug_1_file = $this->upload->data('file_name');
                                }
                            }
                            
                            if(isset($_FILES))
                            {
                                $config['upload_path'] = './datas/Health_declaration/';
                                $config['allowed_types'] = '*';
                                
                                $this->load->library('upload',$config);
                                $this->upload->initialize($config);
                                
                                if(!$this->upload->do_upload('daug_2_file'))
                                {
                                    $daug_2_file = "";
                                }
                                else
                                {
                                    $daug_2_file = $this->upload->data('file_name');
                                }
                            }
                            
                            if(isset($_FILES))
                            {
                                $config['upload_path'] = './datas/Health_declaration/';
                                $config['allowed_types'] = '*';
                                
                                $this->load->library('upload',$config);
                                $this->upload->initialize($config);
                                
                                if(!$this->upload->do_upload('daug_3_file'))
                                {
                                    $daug_3_file = "";
                                }
                                else
                                {
                                    $daug_3_file = $this->upload->data('file_name');
                                }
                            }
                            
                            if(isset($_FILES))
                            {
                                $config['upload_path'] = './datas/Health_declaration/';
                                $config['allowed_types'] = '*';
                                
                                $this->load->library('upload',$config);
                                $this->upload->initialize($config);
                                
                                if(!$this->upload->do_upload('son_1_file'))
                                {
                                    $son_1_file = "";
                                }
                                else
                                {
                                    $son_1_file = $this->upload->data('file_name');
                                }
                            }
                            
                            if(isset($_FILES))
                            {
                                $config['upload_path'] = './datas/Health_declaration/';
                                $config['allowed_types'] = '*';
                                
                                $this->load->library('upload',$config);
                                $this->upload->initialize($config);
                                
                                if(!$this->upload->do_upload('son_2_file'))
                                {
                                    $son_2_file = "";
                                }
                                else
                                {
                                    $son_2_file = $this->upload->data('file_name');
                                }
                            }
                            
                            if(isset($_FILES))
                            {
                                $config['upload_path'] = './datas/Health_declaration/';
                                $config['allowed_types'] = '*';
                                
                                $this->load->library('upload',$config);
                                $this->upload->initialize($config);
                                
                                if(!$this->upload->do_upload('son_3_file'))
                                {
                                    $son_3_file = "";
                                }
                                else
                                {
                                    $son_3_file = $this->upload->data('file_name');
                                }
                            }
                            
                            $id = $this->input->post("lead_id");
                            
                            $health_details = array(
                            "disease_husband" => ($disease_husband == "undefined") ? ""  : $disease_husband,
                            "husband_file" => ($husband_file == "undefined") ? ""  : $husband_file,
                            "disease_wife" =>($disease_wife == "undefined") ? ""  : $disease_wife,
                            "wife_file" =>($wife_file == "undefined") ? ""  : $wife_file,
                            "disease_daug_1" =>($disease_daug_1 == "undefined") ? ""  : $disease_daug_1,
                            "disease_daug_2" =>($disease_daug_2 == "undefined") ? ""  : $disease_daug_2 ,
                            "disease_daug_3" =>($disease_daug_3 == "undefined") ? ""  : $disease_daug_3,
                            "daug_1_file" =>($daug_1_file == "undefined") ? ""  : $daug_1_file,
                            "daug_2_file" =>($daug_2_file == "undefined") ? ""  : $daug_2_file,
                            "daug_3_file" =>($daug_3_file == "undefined") ? ""  : $daug_3_file,
                            "disease_son_1" =>($disease_son_1 == "undefined") ? ""  : $disease_son_1,
                            "disease_son_2" =>($disease_son_2 == "undefined") ? ""  : $disease_son_2,
                            "disease_son_3" =>($disease_son_3 == "undefined") ? ""  : $disease_son_3,
                            "son_1_file" =>($son_1_file == "undefined") ? ""  : $son_1_file,
                            "son_2_file" =>($son_2_file == "undefined") ? ""  : $son_2_file,
                            "son_3_file" =>($son_3_file == "undefined") ? ""  : $son_3_file ,
                            "disease_father" =>($disease_father == "undefined") ? ""  : $disease_father,
                            "disease_mother" =>($disease_mother == "undefined") ? ""  : $disease_mother,
                            "father_file" =>($father_file == "undefined") ? ""  : $father_file,
                            "mother_file" =>($mother_file == "undefined") ? ""  : $mother_file,
                            );
                            //$res = $this->lm->update_health_policy_details($health_details,$id);
							
							$_health = $this->lm->get_health_details($lead_id);
                            
                            $res = $this->lm->update_health_policy_details($health_details,$id);
                            
                            if( $res ){
                		        $this->audit->log('health_details', 'UPDATE', null, $_health, $health_details);
                		    }
                    }
					
					$_policies = $this->lm->get_policy_details($lead_id);
                    
                    $sync = "false";
                    if(isset($_policies->policy_issue_date) && !empty($_policies->policy_issue_date)){
                        $_date = new DateTime($_policies->policy_issue_date);
                        $_chkdate = new DateTime('2023-03-01');
                        if($_date >= $_chkdate)
                            $sync = "true";
                    }
                    
                    if( isset( $_policies->vocher_status ) && ( $_policies->vocher_status == "0" ) && $sync == "true" ){ // 
                        $commission_datas = $this->getCommissonByLead(); //$this->find_commission_id();
                        
                        if( isset( $commission_datas['commission_id'] ) && !empty( $commission_datas['commission_id'] ) ) {
                            $data['commission_id'] = $commission_datas['commission_id'];
                        }
                    }
					
					$res = $this->lm->update_generated_policy($data,$lead_id);
					
					if( $res ){
        		        $this->audit->log('policy_info', 'UPDATE', null, $_policies, $data);
        		        
        		        $activity_log = array("lead_id"=>$lead_id,"action"=>"Policy Updated","action_type"=>"Policy Updated","created_by"=>$this->session->userdata('session_name'),"time"=>date("Y-m-d H:i:s"));
                        $add_activity = $this->lm->add_activity_log($activity_log);
                         
                        if( $add_activity ){
            		       $this->audit->log('notification_log', 'INSERT', null, null, $activity_log);
            		    }
            		    
            		    if(  $sync == "true"){ //isset( $_policies->vocher_status ) && ( $_policies->vocher_status == "0" ) &&
            		        var_dump($sync);
            		        $this->update_commission_by_policy($lead_id);
            		    }            		                		            		  
        		    }
					/*
					$res = $this->lm->update_generated_policy($data,$lead_id);	
                    
                     $activity_log = array("lead_id"=>$lead_id,"action"=>"Policy Updated","action_type"=>"Policy Updated","created_by"=>$this->session->userdata('session_name'),"time"=>date("Y-m-d H:i:s"));
                     $add_activity = $this->lm->add_activity_log($activity_log);
					*/
                     echo "success";
        }
    }
    
    public function add_health_details()
    {
      if($this->session->has_userdata('logged_in'))
       {
        $created_id=$this->input->post("created_id");
         $lead_id=$this->input->post("lead_id");
         $h_gender=$this->input->post("h_gender");
          $Husband=$this->input->post("Husband");
          $Wife=$this->input->post("Wife");
          $Son=$this->input->post("Son");
          $Daughter=$this->input->post("Daughter");
          $Father=$this->input->post("Father");
          $Mother=$this->input->post("Mother");
          $Husband_age=$this->input->post("Husband_age");
          $Wife_age=$this->input->post("Wife_age");
          $num_daughters=$this->input->post("num_daughters");
          $num_sons=$this->input->post("num_sons");
           $son_1_age=$this->input->post("son_1_age");
           $son_2_age=$this->input->post("son_2_age");
           $son_3_age=$this->input->post("son_3_age");
           $son_4_age=$this->input->post("son_4_age");
           $daughter_1_age=$this->input->post("daughter_1_age");
           $daughter_2_age=$this->input->post("daughter_2_age");
           $daughter_3_age=$this->input->post("daughter_3_age");
           $daughter_4_age=$this->input->post("daughter_4_age");
          $father_age=$this->input->post("father_age");
          $mother_age=$this->input->post("mother_age");
          $date = date("Y-m-d"); 
          
           $son_name_1=$this->input->post("son_name_1");
           $son_name_2=$this->input->post("son_name_2");
           $son_name_3=$this->input->post("son_name_3");
           $son_name_4=$this->input->post("son_name_4");
           
           $son_dob_1=$this->input->post("son_dob_1");
           $son_dob_2=$this->input->post("son_dob_2");
           $son_dob_3=$this->input->post("son_dob_3");
           $son_dob_4=$this->input->post("son_dob_4");
           
           
           $daughter_name_1=$this->input->post("daughter_name_1");
           $daughter_name_2=$this->input->post("daughter_name_2");
           $daughter_name_3=$this->input->post("daughter_name_3");
           $daughter_name_4=$this->input->post("daughter_name_4");
           
           $daughter_dob_1=$this->input->post("daughter_dob_1");
           $daughter_dob_2=$this->input->post("daughter_dob_2");
           $daughter_dob_3=$this->input->post("daughter_dob_3");
           $daughter_dob_4=$this->input->post("daughter_dob_4");
           
           
           $Husband_name = $this->input->post("Husband_name");
           $Husband_dob = $this->input->post("Husband_dob");
           $Wife_name = $this->input->post("Wife_name");
           $Wife_dob = $this->input->post("Wife_dob");
           
           $father_name = $this->input->post("father_name");
           $father_dob = $this->input->post("father_dob");
           $mother_name = $this->input->post("mother_name");
           $dob_mother = $this->input->post("dob_mother");
           
          
        
            
            $data = array(
                "husband"=>$Husband,
                "wife"=>$Wife,"father"=>$Father,
                "mother"=>$Mother,"son"=>$Son,
                "duaghter"=>$Daughter,
                "father_age" =>$father_age,
                "mother_age"=>$mother_age,
                "husband_age"=>$Husband_age,
                "wife_age"=>$Wife_age,
                "son_count"=>$num_sons,
                "duaghter_count"=>$num_daughters,
                "son1_age"=>$son_1_age,
                "son2_age"=>$son_2_age,
                "son3_age"=>$son_3_age,
                "son4_age"=>$son_4_age,
                "daughter1_age"=>$daughter_1_age,
                "daughter2_age"=>$daughter_2_age,
                "daughter3_age"=>$daughter_3_age,
                "daughter4_age"=>$daughter_4_age,
                "gender"=>$h_gender,
                "daughter_name_1" => $daughter_name_1,
               "daughter_name_2" => $daughter_name_2,
               "daughter_name_3" => $daughter_name_3,
               "daughter_name_4" => $daughter_name_4,
               "daughter_dob_1" => $daughter_dob_1,
               "daughter_dob_2" => $daughter_dob_2,
               "daughter_dob_3" => $daughter_dob_3,
               "daughter_dob_4" => $daughter_dob_4,
                "son_name_1" =>$son_name_1,
                "son_name_2" =>$son_name_2,
                "son_name_3" =>$son_name_3,
                "son_name_4" =>$son_name_4,
                "son_dob_1" =>$son_dob_1,
                "son_dob_2" =>$son_dob_2,
                "son_dob_3" =>$son_dob_3,
                "son_dob_4" =>$son_dob_4,
                "father_name" =>$father_name,
                "father_dob" =>$father_dob,
                "mother_name" =>$mother_name,
                "mother_dob" =>$dob_mother,
                "husband_name" =>$Husband_name,
                "husband_dob" =>$Husband_dob,
                "wife_name" =>$Wife_name,
                "wife_dob" =>$Wife_dob,
                "lead_id"=>$lead_id,
                "created_at"=>$date,
                "created_by"=>$created_id
                );
            
            $res = $this->lm->add_health_details($data);
            if( $res ){
		        $this->audit->log('health_details', 'INSERT', null, null, $data);
		    }
                		    
        }
    }
    
    public function get_receiver_email_id()
    {
        if($this->session->has_userdata('logged_in'))
        {
            $lead_id = $this->input->post("id");
            $res = $this->lm->get_receiver_email_id($lead_id);
            $data = $this->lm->get_receiver_email_by_id($res->client_id);
            echo json_encode($data);
        }
    }
    
    public function fetch_email_content()
    {
        if($this->session->has_userdata('logged_in'))
        {
            $template_id = $this->input->post("template_id");
            $lead_id = $this->input->post("lead_id");
            
            $res = $this->lm->fetch_email_content($template_id);
            $data = $this->lm->get_policy_details($lead_id);
            
            $arr = array("res"=>$res,"data"=>$data);
            echo json_encode($arr);
        }
    }
    
    public function get_uploaded_documents()
    {
        if($this->session->has_userdata('logged_in'))
        {
            $lead_id = $this->input->post("lead_id");
            
            $res = $this->lm->get_vechile_documents($lead_id);
            
            $data = $this->lm->get_policy_documents($lead_id);
            
            $html ="";
            
            foreach($res as $da)
            {
                 $html .="<tr>
                      <td><input type='checkbox' name='document_file' class='form-check-input check_file' value='".$da->document_file."'></td>
                      <td>".$da->document_type."</td>
                      <td>".$da->document_file."</td>
                     </tr>";
            }
            
            foreach($data as $da)
            {
                $html .="<tr>
                      <td><input type='checkbox' name='document_file' class='form-check-input check_file'  value='".$da->document."'></td>
                      <td>".$da->document_type."</td>
                      <td>".$da->document."</td>
                     </tr>";
            }
            
            echo $html;
        }
    }
    
    public function send_mail()
    {
        if($this->session->has_userdata('logged_in'))
        {
          $lead_id = $this->input->post("lead_id");
          $sender_email_id=$this->input->post("sender_email_id");
          $sender_name=$this->input->post("sender_name");
          $receiver_email_id=$this->input->post("receiver_email_id");
          $email_subject="Policy Document"; //$this->input->post("subject");
          $email_message = $this->input->post("content");
          $arr=$this->input->post("arr");
          
            $this->load->library('email');
        
        	$this->email->from("$sender_email_id", "$sender_name");
        	$this->email->to("$receiver_email_id");
        	
        	for($i=0;$i<count($arr);$i++)
        	{
        	    $this->email->attach('./datas/documents/'.$arr[$i]);
        	}
        	$this->email->set_mailtype("html");
        	$this->email->subject("$email_subject");
        	$this->email->message("$email_message");
        	$this->email->send();
        	
    		$activity_log = array("lead_id"=>$lead_id,"action"=>"Send Policy Email","action_type"=>"policy_email","created_by"=>$this->session->userdata('session_name'),"time"=>date("Y-m-d h:i:sa"));
            $add_activity = $this->lm->add_activity_log($activity_log);
        }
    }
    
    public function fetch_followup_log()
    {
        if($this->session->has_userdata('logged_in'))
        {
            $id = $this->input->post("id");
            $res = $this->lm->fetch_all_followups($id);
            
            $html = "";
            
            foreach($res as $da)
            {
                $html .="<tr>
                             <td>".date_format(date_create($da->next_follow_up_date),"d-m-Y")."</td>
                             <td>".date_format(date_create($da->next_follow_up_time),"h:i:sa")."</td>
                             <td>".$da->reason."</td>
                             <td>".$da->comment."</td>
                       </tr>";
            }
            
            echo $html;
        }
    }
    
   
    // Manual Generate policy //
  
  public function manual_generate_policy()
  {
        if($this->session->has_userdata('logged_in') && $this->session->userdata('session_role') == "admin") 
    	{    		
		   	$pro_data["project_info"] = $this->mm->fetch_project_info();
		   	$data["users"] = $this->lm->fetch_users();
		   	$data["client_type"] = $this->lm->fetch_client_type();
		   	$data["fuel_type"] = $this->lm->fetch_fuel_type();
		   	$data["business"] = $this->lm->fetch_business_type();
		   	$data["class"] = $this->lm->fetch_list_of_policy_type();
		   	$data["agents_pos"] = $this->lm->fetch_agents_pos();
		   	$data["policy_type"] = $this->lm->fetch_list_of_policy_type_motor();
		   	$data["email_templates"] = $this->lm->fetch_email_templates();
		   	$data["company"] = $this->lm->fetch_company();
		   	$data["state"] = $this->lm->fetch_state();
		   	$data["premium_cover_type"] = $this->lm->fetch_premium_cover_type();
	   		$data["rto"] = $this->lm->fetch_rto();
    		$this->load->view('header',$pro_data);
    		$this->load->view('manual_generate_policy',$data);
    		$this->load->view('footer',$pro_data);
	    }
	    else if($this->session->has_userdata('logged_in') && ($this->session->userdata('session_role') == "user" || $this->session->userdata('session_role') == "AI"))
	    {
	         $check_user_i = $this->mm->fetch_user_permissions($this->session->userdata('session_id'));
	         
	        if($check_user_i->policy_view == "1")
	        {
    	        $pro_data["project_info"] = $this->mm->fetch_project_info();
    	        $data["users"] = $this->lm->fetch_users();
    	        $data["client_type"] = $this->lm->fetch_client_type();
    	        $data["business"] = $this->lm->fetch_business_type();
    	        $data["class"] = $this->lm->fetch_list_of_policy_type();
    	        $data["agents_pos"] = $this->lm->fetch_agents_pos();
    		   	$data["policy_type"] = $this->lm->fetch_list_of_policy_type_motor();
    		   	$data["email_templates"] = $this->lm->fetch_email_templates();
    		   	$data["company"] = $this->lm->fetch_company();
    		   	$data["state"] = $this->lm->fetch_state();
    		   	$data["fuel_type"] = $this->lm->fetch_fuel_type();
    		   	$data["premium_cover_type"] = $this->lm->fetch_premium_cover_type();
    		   	$data["rto"] = $this->lm->fetch_rto();
        		$this->load->view('header',$pro_data);
        		$this->load->view('manual_generate_policy',$data);
        		$this->load->view('footer',$pro_data);
	        }
	        else
	        {
	            echo "<script>alert('Permission Denied');window.location.href='home';</script>";
	        }
	    }
	    else
	    {
	    	redirect("login");
	    }
    }
    
    public function manual_upload_policy_document_files()
      {
          if($this->session->has_userdata('logged_in'))
          {
    	      $check_user_i = $this->mm->fetch_user_permissions($this->session->userdata('session_id'));
    	         
    	        if($check_user_i->policy_add == "1")
    	        {
                	   $id = $this->input->post("id");
                	   $document_type = $this->input->post("document_type");
                	   
                	    if(isset($_FILES))
                		{
                			$config['upload_path'] = './datas/documents/';
                			$config['allowed_types'] = '*';
                			
                			$this->load->library('upload',$config);
                			$this->upload->initialize($config);
                			if(!$this->upload->do_upload('file'))
                			{
                				$file = '';
                				$file_path = "";
                			}
                			else
                			{
                				$file_path = base_url().'datas/documents/'.$this->upload->data('file_name');
                				$file = $this->upload->data('file_name');
                			}
                		}
                		
                		
                		
                		if($id == "")
                		{
                		    $data1 = array("lead_status" => "cancelled");
                		    $id = $this->lm->add_lead_details($data1);
                		}
                		$data = array("lead_id" =>$id,"document_type"=>$document_type,"document" =>$file);
                		
                		$res = $this->lm->upload_policy_document_files($data);
                		
                		$html = "";
            
                $html .="<tr>
                		           <td><a href='./datas/documents/".$res->document."'><i class='fa fa-file'></i></a></td>
                		           <td>".$res->document."</td>
                		           <td>".$res->document_type."</td>
                		         </tr>";
                		 echo json_encode(array("html" => $html,"id" => $id));
            	    }
        	    else
        	    {
        	        echo "<script>alert('Permission Denied');window.location.href='home';</script>";
        	    }
       }
     }
    
      public function save_manual_generated_policy()
        {
             if($this->session->has_userdata('logged_in'))
            {
                
              $check_user_i = $this->mm->fetch_user_permissions($this->session->userdata('session_id'));
    	        if($check_user_i->policy_add == "1")
    	        {   
                   $policy_no = $this->input->post("policy_no");
                   $client_type = $this->input->post("client_type");
                   $client_name = $this->input->post("client_name");
                   $mobile_no = $this->input->post("mobile_no");
                   $pin = $this->input->post("pin_code");
                   $policy_source = $this->input->post("policy_source");
                   $bussiness_type = $this->input->post("bussiness_type");
                   $policy_class = $this->input->post("policy_class");
                   $policy_type = $this->input->post("policy_type");
                   $policy_agency_pos = $this->input->post("policy_agency_pos");
                   $lead_created_by = $this->session->userdata('session_name');
                   
                   $state = $this->input->post("state");
                   $company = $this->input->post("company");
                   $rto = $this->input->post("rto");
                   $commission_type = $this->input->post("commission_type");
                   $age = $this->input->post("age");
                   $category = $this->session->userdata('category');
                   $vehicle_classification = $this->input->post("vehicle_classification");
                   $lead_id = $this->input->post("lead_id");
                   $nominee_name = $this->input->post("nominee_name");
                   $adharcard_no = $this->input->post("adharcard_no");
                   $n_mobile_no = $this->input->post("n_mobile_no");
                   $n_adhar_card_upload = $this->input->post("n_adhar_card_upload");
                   
                   $make = $this->input->post("vechi_make");
                   $model = $this->input->post("vechi_model");
                   $Varient = $this->input->post("vechi_varient");
                   $cc  = $this->input->post("vechi_cc");
                   $v_gvw = $this->input->post("v_gvw");
                   $register_no = $this->input->post("vechi_register_no");
                   $year_of_manu = $this->input->post("vechi_manu_year");
                   $engine_num = $this->input->post("vechi_engine_num");
                   $commission_id = $this->input->post("commission_id");
                   $fuel_type = $this->input->post("fuel_type");
                   $ncb = $this->input->post("ncb"); 
                   $total_premium = $this->input->post("total_premium");
                   
              
                   
                   $agent_commission = 0;
                   $company_com = 0;
                   
                   if($commission_id != "")
                   {
                       if($policy_class == 1)
                        {
                            $res = $this->lm->fetch_policy_info($commission_id);
                            
                            if($res != null && $res->commission_type == "2")
                            {
                                if($res->commission_type == "2" && $res->type == "Excluding")
                                {
                                    if($res->is_ncb == "Yes" && $this->input->post("no_claim_bonus") == "Yes")
                                    {
                                        $company_com = $total_premium * ($res->ncb_percentage)/100;
                                        
                                         $agent_status = $this->lm->fetch_agent_category($policy_agency_pos);
                                         
                                               if($agent_status->commission_category == "A")
                                               {
                                                   $agent_commission = ($company_com * $res->a_ncb)/100;
                                               }
                                               else if($agent_status->commission_category == "B")
                                               {
                                                    $agent_commission = ($company_com * $res->a_ncb)/100;
                                               }
                                               else if($agent_status->commission_category == "C")
                                               {
                                                    $agent_commission = ($company_com * $res->a_ncb)/100;
                                               }
                                               else if($agent_status->commission_category == "D")
                                               {
                                                    $agent_commission = ($company_com * $res->a_ncb)/100;
                                               }
                                    }
                                    else if($res->is_ncb == "Yes" && $this->input->post("no_claim_bonus") == "No" || $this->input->post("no_claim_bonus") == "")
                                    {
                                        $irda_od = $total_premium * ($res->irda_od)/100;
                                        $irda_tp = $total_premium * ($res->irda_tp)/100;
                                        $company_com = $irda_od + $irda_tp;
                                        $agent_status = $this->lm->fetch_agent_category($policy_agency_pos);
                                        
                                       if($res->agn_com_type == "OD")
                                       {
                                           if($agent_status->commission_category == "A")
                                           {
                                               $agent_commission = ($irda_od * $res->a_od)/100;
                                           }
                                           else if($agent_status->commission_category == "B")
                                           {
                                               $agent_commission = ($irda_od * $res->b_od)/100;
                                           }
                                           else if($agent_status->commission_category == "C")
                                           {
                                               $agent_commission = ($irda_od * $res->c_od)/100;
                                           }
                                           else if($agent_status->commission_category == "D")
                                           {
                                               $agent_commission = ($irda_od * $res->d_od)/100;
                                           }
                                       }
                                       else if($res->agn_com_type == "TP")
                                       {
                                           if($agent_status->commission_category == "A")
                                           {
                                               $agent_commission = ($irda_tp * $res->a_tp)/100;
                                           }
                                           else if($agent_status->commission_category == "B")
                                           {
                                               $agent_commission = ($irda_tp * $res->b_tp)/100;
                                           }
                                           else if($agent_status->commission_category == "C")
                                           {
                                               $agent_commission = ($irda_tp * $res->c_tp)/100;
                                           }
                                           else if($agent_status->commission_category == "D")
                                           {
                                               $agent_commission = ($irda_tp * $res->d_tp)/100;
                                           }
                                       }
                              }
                              
                                      if($res->on_net != "0")
                                        {
                                            $own_od = "";
                                            $own_tp = "";
                                            $company_com = $total_premium * ($res->on_net)/100;
                                            $on_net = $company_com;
                                        }
                                        else if($res->own_od != "" && $res->own_tp != "")
                                        {
                                            $own_od = $total_premium * ($res->own_od)/100;
                                            $own_tp = $total_premium * ($res->own_tp)/100;
                                            $company_com = $own_od+$own_tp;
                                            $on_net = "";
                                        }
                                        else if($res->own_od != "")
                                        {
                                            $on_net = ""; 
                                            $own_tp = "";
                                            $company_com = $total_premium * ($res->own_od)/100;
                                            $own_od = $company_com;
                                        }
                                        else if($res->own_tp != "")
                                        {
                                            $own_od = ""; 
                                            $on_net = "";
                                            $company_com = $total_premium * ($res->own_tp)/100;
                                            $own_tp = $company_com;
                                        }
                         }
                                else if($res->commission_type == "2" && $res->type == "including")
                                {
                                        if($res->on_net != "")
                                        {
                                            $own_od = "";
                                            $own_tp = "";
                                            $company_com = $total_premium * ($res->on_net)/100;
                                            $on_net = $company_com;
                                        }
                                        else if($res->own_od != "" && $res->own_tp != "")
                                        {
                                            $own_od = $total_premium * ($res->own_od)/100;
                                            $own_tp = $total_premium * ($res->own_tp)/100;
                                            $company_com = $own_od+$own_tp;
                                            $on_net = "";
                                        }
                                        else if($res->own_od != "")
                                        {
                                            $on_net = ""; 
                                            $own_tp = "";
                                            $company_com = $total_premium * ($res->own_od)/100;
                                            $own_od = $company_com;
                                        }
                                        else if($res->own_tp != "")
                                        {
                                            $own_od = ""; 
                                            $on_net = "";
                                            $company_com = $total_premium * ($res->own_tp)/100;
                                            $own_tp = $company_com;
                                        }
                                }       
                                        $agent_status = $this->lm->fetch_agent_category($policy_agency_pos);
                                   
                                   if($res->agn_com_type == "OD")
                                   {
                                       if($agent_status->commission_category == "A")
                                       {
                                           $agent_commission = ($own_od * $res->a_od)/100;
                                       }
                                       else if($agent_status->commission_category == "B")
                                       {
                                           $agent_commission = ($own_od * $res->b_od)/100;
                                       }
                                       else if($agent_status->commission_category == "C")
                                       {
                                           $agent_commission = ($own_od * $res->c_od)/100;
                                       }
                                       else if($agent_status->commission_category == "D")
                                       {
                                           $agent_commission = ($own_od * $res->d_od)/100;
                                       }
                                   }
                                   else if($res->agn_com_type == "TP")
                                   {
                                       if($agent_status->commission_category == "A")
                                       {
                                           $agent_commission = ($own_tp * $res->a_tp)/100;
                                       }
                                       else if($agent_status->commission_category == "B")
                                       {
                                           $agent_commission = ($own_tp * $res->b_tp)/100;
                                       }
                                       else if($agent_status->commission_category == "C")
                                       {
                                           $agent_commission = ($own_tp * $res->c_tp)/100;
                                       }
                                       else if($agent_status->commission_category == "D")
                                       {
                                           $agent_commission = ($own_tp * $res->d_tp)/100;
                                       }
                                   }
                                       
                                   else if($res->agn_com_type == "ON-NET")
                                   {
                                       if($agent_status->commission_category == "A")
                                       {
                                           $agent_commission = ($on_net * $res->a_net)/100;
                                       }
                                       else if($agent_status->commission_category == "B")
                                       {
                                           $agent_commission = ($on_net * $res->b_net)/100;
                                       }
                                       else if($agent_status->commission_category == "C")
                                       {
                                           $agent_commission = ($on_net * $res->c_net)/100;
                                       }
                                       else if($agent_status->commission_category == "D")
                                       {
                                           $agent_commission = ($on_net * $res->d_net)/100;
                                       }
                                   }
                                       
                                   else if($res->agn_com_type == "OD_AND_TP")
                                   {
                                       if($agent_status->commission_category == "A")
                                       {
                                           $agent_od = ($own_od * $res->a_od)/100;
                                           $agent_tp = ($own_tp * $res->a_tp)/100;
                                           $agent_commission = $agent_od+$agent_tp;
                                       }
                                       else if($agent_status->commission_category == "B")
                                       {
                                           $agent_od = ($own_od * $res->b_od)/100;
                                           $agent_tp = ($own_tp * $res->a_tp)/100;
                                           $agent_commission = $agent_od+$agent_tp;
                                       }
                                       else if($agent_status->commission_category == "C")
                                       {
                                           $agent_od = ($own_od * $res->c_od)/100;
                                           $agent_tp = ($own_tp * $res->a_tp)/100;
                                           $agent_commission = $agent_od+$agent_tp;
                                       }
                                       else if($agent_status->commission_category == "D")
                                       {
                                           $agent_od = ($own_od * $res->d_od)/100;
                                           $agent_tp = ($own_tp * $res->a_tp)/100;
                                           $agent_commission = $agent_od+$agent_tp;
                                       }
                                 }
                              
                           }
                           else
                           {
                               $res = $this->lm->fetch_policy_info($commission_id);
                            
                            if($res != null)
                            {
                                if($res->commission_type == "1" && $res->type == "Excluding")
                                {
                                    if($res->is_ncb == "Yes" && $this->input->post("no_claim_bonus") == "Yes")
                                    {
                                        $company_com = $total_premium * ($res->ncb_percentage)/100;
                                        
                                         $agent_status = $this->lm->fetch_agent_category($policy_agency_pos);
                                         
                                               if($agent_status->commission_category == "A")
                                               {
                                                   $agent_commission = ($company_com * $res->a_ncb)/100;
                                               }
                                               else if($agent_status->commission_category == "B")
                                               {
                                                    $agent_commission = ($company_com * $res->a_ncb)/100;
                                               }
                                               else if($agent_status->commission_category == "C")
                                               {
                                                    $agent_commission = ($company_com * $res->a_ncb)/100;
                                               }
                                               else if($agent_status->commission_category == "D")
                                               {
                                                    $agent_commission = ($company_com * $res->a_ncb)/100;
                                               }
                                    }
                                    else if($res->is_ncb == "Yes" && $this->input->post("no_claim_bonus") == "No" || $this->input->post("no_claim_bonus") == "")
                                    {
                                        $irda_od = $total_premium * ($res->irda_od)/100;
                                        $irda_tp = $total_premium * ($res->irda_tp)/100;
                                        $company_com = $irda_od + $irda_tp;
                                        $agent_status = $this->lm->fetch_agent_category($policy_agency_pos);
                                        
                                       if($res->agn_com_type == "OD")
                                       {
                                           if($agent_status->commission_category == "A")
                                           {
                                               $agent_commission = ($irda_od * $res->a_od)/100;
                                           }
                                           else if($agent_status->commission_category == "B")
                                           {
                                               $agent_commission = ($irda_od * $res->b_od)/100;
                                           }
                                           else if($agent_status->commission_category == "C")
                                           {
                                               $agent_commission = ($irda_od * $res->c_od)/100;
                                           }
                                           else if($agent_status->commission_category == "D")
                                           {
                                               $agent_commission = ($irda_od * $res->d_od)/100;
                                           }
                                       }
                                       else if($res->agn_com_type == "TP")
                                       {
                                           if($agent_status->commission_category == "A")
                                           {
                                               $agent_commission = ($irda_tp * $res->a_tp)/100;
                                           }
                                           else if($agent_status->commission_category == "B")
                                           {
                                               $agent_commission = ($irda_tp * $res->b_tp)/100;
                                           }
                                           else if($agent_status->commission_category == "C")
                                           {
                                               $agent_commission = ($irda_tp * $res->c_tp)/100;
                                           }
                                           else if($agent_status->commission_category == "D")
                                           {
                                               $agent_commission = ($irda_tp * $res->d_tp)/100;
                                           }
                                       }
                              }
                         }
                        else if($res->commission_type == "1" && $res->type == "including")
                        {
                                if($res->on_net != "")
                                {
                                    $own_od = "";
                                    $own_tp = "";
                                    $company_com = $total_premium * ($res->on_net)/100;
                                    $on_net = $company_com;
                                }
                                else if($res->own_od != "" && $res->own_tp != "")
                                {
                                    $own_od = $total_premium * ($res->own_od)/100;
                                    $own_tp = $total_premium * ($res->own_tp)/100;
                                    $company_com = $own_od+$own_tp;
                                    $on_net = "";
                                }
                                else if($res->own_od != "")
                                {
                                    $on_net = ""; 
                                    $own_tp = "";
                                    $company_com = $total_premium * ($res->own_od)/100;
                                    $own_od = $company_com;
                                }
                                else if($res->own_tp != "")
                                {
                                    $own_od = ""; 
                                    $on_net = "";
                                    $company_com = $total_premium * ($res->own_tp)/100;
                                    $own_tp = $company_com;
                                }
                                
                                $agent_status = $this->lm->fetch_agent_category($policy_agency_pos);
                           
                           if($res->agn_com_type == "OD")
                           {
                               if($agent_status->commission_category == "A")
                               {
                                   $agent_commission = ($own_od * $res->a_od)/100;
                               }
                               else if($agent_status->commission_category == "B")
                               {
                                   $agent_commission = ($own_od * $res->b_od)/100;
                               }
                               else if($agent_status->commission_category == "C")
                               {
                                   $agent_commission = ($own_od * $res->c_od)/100;
                               }
                               else if($agent_status->commission_category == "D")
                               {
                                   $agent_commission = ($own_od * $res->d_od)/100;
                               }
                           }
                           else if($res->agn_com_type == "TP")
                           {
                               if($agent_status->commission_category == "A")
                               {
                                   $agent_commission = ($own_tp * $res->a_tp)/100;
                               }
                               else if($agent_status->commission_category == "B")
                               {
                                   $agent_commission = ($own_tp * $res->b_tp)/100;
                               }
                               else if($agent_status->commission_category == "C")
                               {
                                   $agent_commission = ($own_tp * $res->c_tp)/100;
                               }
                               else if($agent_status->commission_category == "D")
                               {
                                   $agent_commission = ($own_tp * $res->d_tp)/100;
                               }
                           }
                               
                           else if($res->agn_com_type == "ON-NET")
                           {
                               if($agent_status->commission_category == "A")
                               {
                                   $agent_commission = ($on_net * $res->a_net)/100;
                               }
                               else if($agent_status->commission_category == "B")
                               {
                                   $agent_commission = ($on_net * $res->b_net)/100;
                               }
                               else if($agent_status->commission_category == "C")
                               {
                                   $agent_commission = ($on_net * $res->c_net)/100;
                               }
                               else if($agent_status->commission_category == "D")
                               {
                                   $agent_commission = ($on_net * $res->d_net)/100;
                               }
                           }
                               
                           else if($res->agn_com_type == "OD_AND_TP")
                           {
                               if($agent_status->commission_category == "A")
                               {
                                   $agent_od = ($own_od * $res->a_od)/100;
                                   $agent_tp = ($own_tp * $res->a_tp)/100;
                                   $agent_commission = $agent_od+$agent_tp;
                               }
                               else if($agent_status->commission_category == "B")
                               {
                                   $agent_od = ($own_od * $res->b_od)/100;
                                   $agent_tp = ($own_tp * $res->a_tp)/100;
                                   $agent_commission = $agent_od+$agent_tp;
                               }
                               else if($agent_status->commission_category == "C")
                               {
                                   $agent_od = ($own_od * $res->c_od)/100;
                                   $agent_tp = ($own_tp * $res->a_tp)/100;
                                   $agent_commission = $agent_od+$agent_tp;
                               }
                               else if($agent_status->commission_category == "D")
                               {
                                   $agent_od = ($own_od * $res->d_od)/100;
                                   $agent_tp = ($own_tp * $res->a_tp)/100;
                                   $agent_commission = $agent_od+$agent_tp;
                               }
                         }
                      }
                   }
                   }
                }
                   }
                   
                    $data = array( 
    	             "client_type_id" =>$client_type,
    	             "client_name" =>$client_name,
    	             "mobile_no" =>$mobile_no,
    	             "pin_code" => $pin,
    	             );
    	             $res = $this->lm->add_client_details($data);
    	             if( $res ){
    	                 $this->audit->log('list_of_clients', 'INSERT', null, null, $data);
    	             }
    	             if($res != "")
    	             {
        	             $arr = array( 
        	             "client_id" =>$res,
        	             "business_type" =>$bussiness_type,
        	             "class"=>$policy_class,
        	             "policy_type" => $policy_type,
        	             "lead_generated_date" => date("Y-m-d"),
        	             "source"=>$policy_source,
        	             "lead_status"=>"completed",
        	             "agency_and_pos" => $policy_agency_pos,
        	             "lead_created_by" =>$lead_created_by,
        	             "created_date"=>date("Y-m-d"),
        	             "updated_date"=>date("Y-m-d"));
        	             
        	             if($lead_id == "")
        	             {
        	                 $lead_id = $this->lm->add_lead_details($arr);
        	                 if( $lead_id ) {
            		            $this->audit->log('list_of_leads', 'INSERT', null, null, $arr);
            		         }
        	             }
        	             else
        	             {
        	                $old_data = $this->lm->get_lead_details($lead_id);
        	                $res = $this->lm->update_follow_up_details($arr,$lead_id);
        	                if( $res ) {
        	                    $this->audit->log('list_of_leads', 'UPDATE', null, $old_data, $arr);
        	                }
        	                 
        	             }
        	             
    	             }
    	             
                     $activity_log = array("lead_id"=>$lead_id,"action"=>"Created <b>New Lead</b>","action_type"=>"new_lead_creation","created_by"=>$lead_created_by,"time"=>date("Y-m-d"));
                     
                     $add_activity = $this->lm->add_activity_log($activity_log);
                     if( $add_activity ) {
    		            $this->audit->log('notification_log', 'INSERT', null, null, $activity_log);
    		         }    

                    //  add vechicle details start             
                 
                     $vechi_info = array( 
                                          "lead_id" =>$lead_id,
                                          "vechile_type" =>"1",
                                          "policy_type" => $policy_type,
                                          "vechi_make" => $make,
                                          "vechi_model" => $model,
                                          "vechi_varient" => $Varient,
                                          "vechi_cc" => $cc,
                                          "vechi_gvw" =>$v_gvw,
                                          "vechi_register_no" => $register_no,
                                          "vechi_manu_year" => $year_of_manu,
                                          "vechi_engine_num" => $engine_num,
                                          "vechi_fuel_type"=>$fuel_type,
                                          "rto" =>$rto,
                                          "state" =>$state,
                                        );
                                           
                                $res = $this->lm->add_vechicle_detail($vechi_info);  
                                if( $res ) {
                                    $this->audit->log('vechile_details', 'INSERT', null, null, $vechi_info);
                                }
                             //  add vechicle details start 
                                       
                 
            	  $data = array(
            	        "lead_id" =>$lead_id,
            	        "policy_client_ref_no"=> $this->input->post("policy_client_ref_no"),
                        "policy_cover_note_no"=> $this->input->post("policy_cover_note_no"),
                        "policy_no"=> $this->input->post("policy_no"),
                        "policy_s_date"=> $this->input->post("policy_s_date"),
                        "policy_ex_date"=> $this->input->post("policy_ex_date"),
                        "policy_premium"=> $this->input->post("policy_premium"),
                        "policy_terms"=> $this->input->post("policy_terms"),
                        "payment_frequency"=> $this->input->post("payment_frequency"),
                        "next_due_date"=> $this->input->post("next_due_date"),
                        "renewable_flag"=> $this->input->post("renewable_flag"),
                        "add_ons_opted"=> $this->input->post("add_ons_opted"),
                        "add_ons_not_opt" =>$this->input->post("add_ons_not_opt"),
                        "lead_type" =>"2",
                        "agent_commission_amt" => $agent_commission,
                        "own_commission_amt" => $company_com,
                        "sum_insured"=> $this->input->post("sum_insured"),
                        "discount_percent"=> $this->input->post("discount_percent"),
                        "no_claim_bonus"=> $this->input->post("no_claim_bonus"),
                        "total_own_damage"=> $this->input->post("total_own_damage"),
                        "tot_add_on_premium"=> $this->input->post("tot_add_on_premium"),
                        "commisson_base_premium"=> $this->input->post("commisson_base_premium"),
                        "basic_tp"=> $this->input->post("basic_tp"),
                        "owner_driver_pa"=> $this->input->post("owner_driver_pa"),
                        "owner_diver_amt"=> $this->input->post("owner_diver_amt"),
                        "no_of_year_own_drv"=> $this->input->post("no_of_year_own_drv"),
                        "fuel_kit"=> $this->input->post("fuel_kit"),
                        "fuel_kit_amt"=> $this->input->post("fuel_kit_amt"),
                        "geograpical"=> $this->input->post("geograpical"),
                        "geograpical_amt"=> $this->input->post("geograpical_amt"),
                        "un_named_passenger_pa"=> $this->input->post("un_named_passenger_pa"),
                        "un_named_passenger_amt"=> $this->input->post("un_named_passenger_amt"),
                        "no_seats_per_person"=> $this->input->post("no_seats_per_person"),
                        "no_seats_per_person_amt"=> $this->input->post("no_seats_per_person_amt"),
                        "LL_paid "=> $this->input->post("llp"),
                        "LL_paid_amt"=> $this->input->post("llp_amt"),
                        "no_drv_emp"=> $this->input->post("no_drv_emp"),
                        "pa_paid_drv"=> $this->input->post("pa_paid_drv"),
                        "pa_paid_drv_amt"=> $this->input->post("pa_paid_drv_amt"),
                        "no_seats_per_person1"=> $this->input->post("no_seats_per_person1"),
                        "no_seats_per_person_amt1"=> $this->input->post("no_seats_per_person_amt1"),
                        "tot_liability_premium"=> $this->input->post("tot_liability_premium"),
                        "total_premium"=> $this->input->post("total_premium"),
                        "gst"=> $this->input->post("gst"),
                        "premium_gst"=> $this->input->post("premium_gst"),
                        "policy_issue_date"=> $this->input->post("policy_issue_date"),
                        "policy_agency_pos"=> $this->input->post("policy_agency_pos"),
                        "policy_source"=> $this->input->post("policy_source"),
                        "policy_user"=> $this->input->post("policy_user"),
                        "policy_location"=> $this->input->post("policy_location"),
                        "previous_policy_no"=> $this->input->post("previous_policy_no"),
                        "previous_insurer"=> $this->input->post("previous_insurer"),
                        "previous_insurance_plan"=> $this->input->post("previous_insurance_plan"),
                        "previous_agency_pos"=> $this->input->post("previous_agency_pos"),
                        "previous_source"=> $this->input->post("previous_source"),
                        "dectable_details"=> $this->input->post("dectable_details"),
                        "policy_additional_info"=> $this->input->post("policy_additional_info"),
                        "reference_no"=> $this->input->post("reference_no"),
                        "other_reference_no"=> $this->input->post("other_reference_no"),
                        "policy_received"=> $this->input->post("policy_received"),
                        "policy_verified"=> $this->input->post("policy_verified"),
                        "policy_verified_info"=> $this->input->post("policy_verified_info"),
                        "policy_cancelled"=> $this->input->post("policy_cancelled"),
                        "policy_cancelled_info"=> $this->input->post("policy_cancelled_info"),
                        "commisson_generation"=> $this->input->post("commisson_generation"),
                        "payment_type"=> $this->input->post("payment_type"),
                        "pay_ref_no"=> $this->input->post("pay_ref_no"),
                        "bank_name"=> $this->input->post("bank_name"),
                        "payment_check_date"=> $this->input->post("payment_check_date"),
                        "payment_and_check_no"=> $this->input->post("payment_and_check_no"),
                        "state"=> $this->input->post("state"),
                        "commission_id" =>$commission_id,
                        "company"=> $this->input->post("company"),
                        "rto"=> $this->input->post("rto"),
                        "commission_type"=> $this->input->post("commission_type"),
                        "age"=> $this->input->post("age"),
                        "no_claim_bonus" =>$ncb,
                        "remarks"=> $this->input->post("remarks"),
                        "created_by"=> $this->session->userdata('session_id'),
                        "created_at"=> date("Y-m-d H:i:s"),
                        //"payment_collected_date"=> $this->input->post("payment_collected_date")
                        );
                        
                        $res = $this->lm->save_generated_policy($data);
                        if( $res ){
        	                $this->audit->log('policy_info', 'INSERT', null, null, $data);
        	            }
                        if($res)
                        {
                            $id = $lead_id;
                            $arr = array(
                                "lead_type" =>"2",
                                 "lead_status"=>"completed",
                            );
                            // ✅ Get existing data for audit log before update
                            $lead_data = $this->lm->get_lead_details($id);
                            $data_1 = $this->lm->update_lead_type_status($arr,$id);
                            if($data_1){
            	                $this->audit->log('list_of_leads', 'UPDATE', null, $lead_data, $arr);
            	            }
                        }
                     
                    $activity_log = array("lead_id"=>$id,"action"=>"New Policy Generated","action_type"=>"generate_policy","created_by"=>$this->session->userdata('session_name'),"time"=>date("Y-m-d H:i:s"));
                    
                    
              $countfiles = count($_FILES['files']['name']);
              for($i=0;$i<$countfiles;$i++)
              {
                    if(!empty($_FILES['files']['name'][$i])){
                      $_FILES['file']['name'] = $_FILES['files']['name'][$i];
                      $_FILES['file']['type'] = $_FILES['files']['type'][$i];
                      $_FILES['file']['tmp_name'] = $_FILES['files']['tmp_name'][$i];
                      $_FILES['file']['error'] = $_FILES['files']['error'][$i];
                      $_FILES['file']['size'] = $_FILES['files']['size'][$i];
             
                      $config['upload_path'] = './datas/spot_photos/'; 
                      $config['allowed_types'] = '*';
                      $config['file_name'] = $_FILES['files']['name'][$i];
              
                      $this->load->library('upload',$config); 
                      $arr = array('msg' => 'something went wrong', 'success' => false);
                      
                      if($this->upload->do_upload('file'))
                      {
                       $data = $this->upload->data(); 
                       $data = array("lead_id"=>$id,"document_type"=>"Policy","document"=>$data['file_name'],"uploaded_date"=>date("Y-m-d H:i:s"));
                       $res = $this->lm->add_policy_documents($data);
                       if( $res ){
        	            $this->audit->log('policy_documents', 'INSERT', null, null, $data);
        	           }
                      }
                    }
                  }
                     
                    if(isset($_FILES))
            		{
            			$config['upload_path'] = './datas/nominee_documents/';
            			$config['allowed_types'] = '*';
            			
            			$this->load->library('upload',$config);
            			$this->upload->initialize($config);
            			if(!$this->upload->do_upload('n_adhar_card_upload'))
            			{
            				$file = '';
            			}
            			else
            			{
            				$file = $this->upload->data('file_name');
            			}
            		}
    	
                    $nominee_details = array("lead_id"=>$id,"name" =>$nominee_name,"adharcard_no"=>$adharcard_no,"mobile_no"=>$n_mobile_no,"file"=>$file,"created_by"=>$this->session->userdata('session_id'),"created_date"=>date("Y-m-d H:i:s"));
                    $add_nominee_details = $this->lm->add_nominee_details($nominee_details);
                    if( $add_nominee_details ) {
    		            $this->audit->log('nominee_details', 'INSERT', null, null, $nominee_details);
    		        }
    		        
                    $add_activity = $this->lm->add_activity_log($activity_log);
                    if( $add_activity ) {
    		            $this->audit->log('notification_log', 'INSERT', null, null, $activity_log);
    		         }
                    echo "success";
    	        }
    	        else
    	        {
    	            echo "<script>alert('Permission Denied');window.location.href='home';</script>";
    	        }
        }
    }
    
    public function commission_type_load()
    {
        if($this->session->has_userdata('logged_in'))
        {
            $state = $this->input->post("state");
            $company = $this->input->post("company");
            $rto = $this->input->post("rto");
            $policy_class = $this->input->post("policy_class");
            $bussiness_type = $this->input->post("bussiness_type");
            $policy_premium = $this->input->post("policy_premium");
            
            $commission_type = [];
            $res = $this->lm->commission_type_load($state,$company,$policy_class,$bussiness_type,$policy_premium,$rto);
            
            $arr = [];
            
            foreach($res as $r)
            {
                $is_exist = false;
                foreach($commission_type as $ct)
                {
                    if($ct->id == $r->commission_type)
                    {
                          $is_exist = true;  
                    }
                } 
                if(!$is_exist)
                {
                    $commission_type [] = $this->lm->fetch_commission_type($r->commission_type);
                }
            }
            
            echo json_encode($commission_type);
        }
    }
    
     public function fetch_health_commission_company()
    {
         if($this->session->has_userdata('logged_in'))
        {
            $policy_premium = $this->input->post("policy_premium");
            $res = $this->lm->fetch_health_commission_company($policy_premium);
            $option = "";
            $temp = "";
            $commission_type = [];
            $count = 0;
            foreach($res as $r)
            {
                 $is_exist = false;
                 foreach($commission_type as $ct)
                {
                    if($ct->id == $r->commission_type)
                    {
                          $is_exist = true;  
                    }
                } 
                if(!$is_exist)
                {
                    $count++;
                    $temp .= "<option value='".$r->id."'>".$r->company_name."</option>";
                }
                $commission_type[] = $r->id;
            }
            if($count != 1)
            {
                $option .= "<option value=''>Select Insurance Company</option>";
            }
            echo $option.$temp;
        }
    }
    
    
    public function commission_category_load()
    {
        if($this->session->has_userdata('logged_in'))
        {
            $state = $this->input->post("state");
            $company = $this->input->post("company");
            $rto = $this->input->post("rto");
            $policy_class = $this->input->post("policy_class");
            $bussiness_type = $this->input->post("bussiness_type");
            $policy_premium = $this->input->post("policy_premium");
            $age = $this->input->post("age");
            $commission_type = [];
            $res = $this->lm->commission_category_load($state,$company,$policy_class,$bussiness_type,$policy_premium,$rto);
            $arr = [];
            foreach($res as $r)
            {
                $is_exist = false;
                foreach($commission_type as $ct)
                {
                    if($ct->id == $r->category)
                    {
                          $is_exist = true;  
                    }
                }
                if($r->commission_type == 2)
                {
                    if(!$is_exist && $r->vehicle_age_min <= $age && $r->vehicle_age_max >= $age)
                    {
                        $commission_type [] = $this->lm->fetch_commission_category($r->category);
                    }
                }
                else
                {
                    if(!$is_exist)
                    {
                        $commission_type [] = $this->lm->fetch_commission_category($r->category);
                    }
                }
            }
            
            echo json_encode($commission_type);
        }
    }
    
    public function vehicle_classification_load()
    {
        if($this->session->has_userdata('logged_in'))
        {
            $state = $this->input->post("state");
            $company = $this->input->post("company");
            $rto = $this->input->post("rto");
            $policy_class = $this->input->post("policy_class");
            $bussiness_type = $this->input->post("bussiness_type");
            $policy_premium = $this->input->post("policy_premium");
            $age = $this->input->post("age");
            $category = $this->input->post("category");
            $commission_type = [];
            $res = $this->lm->vehicle_classification_load($state,$company,$policy_class,$bussiness_type,$policy_premium,$rto,$category);
            $arr = [];
            foreach($res as $r)
            {
                $is_exist = false;
                foreach($commission_type as $ct)
                {
                    if($ct->id == $r->product)
                    {
                          $is_exist = true;  
                    }
                }
                if($r->commission_type == 2)
                {
                    if(!$is_exist && $r->vehicle_age_min <= $age && $r->vehicle_age_max >= $age)
                    {
                        $commission_type [] = $this->lm->fetch_commission_product($r->product);
                    }
                }
                else
                {
                    if(!$is_exist)
                    {
                        $commission_type [] = $this->lm->fetch_commission_product($r->product);
                    }
                }
            }
            
            echo json_encode($commission_type);
        }
    }
    public function generate_policy1()
    {
        if( !( $this->session->has_userdata('logged_in') ) ){
            redirect('login', 'refresh');
        }
        
        // if(!$this->auth->can_access('List Policy')){
        //     redirect('access_denied', 'refresh');
        // }
        
        if($this->session->has_userdata('logged_in') && $this->session->userdata('session_role') == "admin") 
    	{    		
		   	$pro_data["project_info"] = $this->mm->fetch_project_info();
		   	$data["users"] = $this->lm->fetch_users();
		   	$data["client_type"] = $this->lm->fetch_client_type();
		   	$data["business"] = $this->lm->fetch_business_type();
		   	$data["class"] = $this->lm->fetch_list_of_policy_type();
    		$this->load->view('header',$pro_data);
    		$this->load->view('generate_policy',$data);
    		$this->load->view('footer',$pro_data);
	    }
	    else if($this->session->has_userdata('logged_in') && ($this->session->userdata('session_role') == "user" || $this->session->userdata('session_role') == "AI"))
	    {
	        $check_user_i = $this->mm->fetch_user_permissions($this->session->userdata('session_id'));
	        
	        if($check_user_i->policy_add == "1")
	        {
    	        $session_id = $this->session->userdata('session_id');
    	        $pro_data["project_info"] = $this->mm->fetch_project_info();
    	        $data["users"] = $this->lm->fetch_users_by_user($session_id);
    	        $data["client_type"] = $this->lm->fetch_client_type();
    	        $data["business"] = $this->lm->fetch_business_type();
    	        $data["class"] = $this->lm->fetch_list_of_policy_type();
        		$this->load->view('header',$pro_data);
        		$this->load->view('generate_policy',$data);
        		$this->load->view('footer',$pro_data);
	        }
	        else
	        {
	            echo "<script>alert('Permission Denied');window.location.href='home';</script>";
	        }
	    }
	    else
	    {
	    	redirect("login");
	    }
    }
    
    public function fetch_generate_policy()
    {
       $draw = intval($this->input->post("draw"));
	   $res = array();
       $session_id = 0;
       
		if($this->session->has_userdata('logged_in')) 
    	{
    	    $check_user_i = $this->mm->fetch_user_permissions($this->session->userdata('session_id'));

            	    if($this->session->userdata('session_role') == "user")
            	    {
            	        $session_id = $this->session->userdata('session_id');
            	        $res = $this->lm->fetch_generate_policy($session_id);
            	    }
            	    else
            	    {
        			    $res = $this->lm->fetch_generate_policy($session_id);
            	    }

		}
		
		$own_od = "";
		$own_tp = "";
		$on_net = "";
	
		
    		$arr = [];
            $a = $_POST['start'];
        
            foreach($res as $da)
            {
            	$a++;
          
          
              $action = "";
              
               if($this->session->userdata("session_role") == "admin")
               {
                 $action = "<a class='btn btn-info btn-xs' href='generate_policy?id=".$da->c_lead_id."&&sec=ap'><i class='fa fa-pencil-square-o'></i> </a>";
               }
            	
            	$client_name = "<a href='#' onclick=view_data(".$da->c_lead_id.")>".$da->client_name."</a>";
            	$own_com = 0;
            	$agn_com = 0;
                if($this->session->userdata("session_company_type") == "unicorn")
                {
                    $own_com = $da->own_commission;
                    $agn_com = $da->agent_commission;
                }
                else
                {
                    $own_com = $da->own_commission_amt;
                    $agn_com = $da->agent_commission_amt;
                }
                $arr[] = array(
                    $a,
                    $client_name,
                    $da->mobile_no,
                    $da->agent_pos_code,
                    $da->policy_no,
                    $da->company_name,
                    "<span class='pull-right'>".number_format($da->total_own_damage,2)."</span>",
                    "<span class='pull-right'>".number_format($da->tot_liability_premium,2)."</span>",
                    "<span class='pull-right'>".number_format($da->total_premium,2)."</span>",
                    "<span class='pull-right'>".number_format($da->gst,2)."</span>",
                    // "<span class='pull-right'>".number_format($own_com,2)."</span>",
                    // "<span class='pull-right'>".number_format($agn_com,2)."</span>",
                    $da->business_name,
                    $da->class_name,
                    $da->policy_type,
                    date("d-m-Y",strtotime($da->policy_s_date)),
                    date("d-m-Y",strtotime($da->policy_ex_date)),
                    $da->policy_premium_name,
                    $action
                );
            }
    
            $result = array(
            			"draw"=> $draw,
    				    "recordsTotal"=> $this->lm->get_all_generate_policy_count($session_id),
    				    "recordsFiltered"=> $this->lm->get_filtered_generate_policy_count($session_id),
    				    "data"=>$arr,
    				);
            echo json_encode($result);

    }
    
    
    public function fetch_generate_policy_health()
    {
        $draw = intval($this->input->post("draw"));
	   $res = array();
       $session_id = 0;
       
		if($this->session->has_userdata('logged_in')) 
    	{
    	    $check_user_i = $this->mm->fetch_user_permissions($this->session->userdata('session_id'));

            	    if($this->session->userdata('session_role') == "user")
            	    {
            	        $session_id = $this->session->userdata('session_id');
            	        $res = $this->lm->fetch_generate_policy_health($session_id);
            	    }
            	    else
            	    {
        			    $res = $this->lm->fetch_generate_policy_health($session_id);
            	    }

             	
		}
		
		$own_od = "";
		$own_tp = "";
		$on_net = "";
	
		
    		$arr = [];
            $a = $_POST['start'];
        
            foreach($res as $da)
            {
            	$a++;
            	$client_name = "<a href='#' onclick=view_data(".$da->c_lead_id.")>".$da->client_name."</a>";

                $arr[] = array(
                    $a,
                    $client_name,
                    $da->mobile_no,
                    $da->agent_pos_code,
                    $da->policy_no,
                    $da->company_name,
                    "<span class='pull-right'>".number_format($da->total_premium,2)."</span>",
                    "<span class='pull-right'>".number_format($da->gst,2)."</span>",
                    "<span class='pull-right'>".number_format($da->own_commission_amt,2)."</span>",
                    "<span class='pull-right'>".number_format($da->agent_commission_amt,2)."</span>",
                    $da->business_name,
                    $da->class_name,
                    $da->policy_type,
                    date("d-m-Y",strtotime($da->policy_s_date)),
                    date("d-m-Y",strtotime($da->policy_ex_date)),
                );
            }
    
            $result = array(
            			"draw"=> $draw,
    				    "recordsTotal"=> $this->lm->get_all_generate_policy_count_health($session_id),
    				    "recordsFiltered"=> $this->lm->filter_gen_policy_count_health($session_id),
    				    "data"=>$arr,
    				);
            echo json_encode($result);
    }
    
    
    public function fetch_generate_policy_sme()
    {
        $draw = intval($this->input->post("draw"));
        $res = array();
        $session_id = 0;
       
            if($this->session->has_userdata('logged_in')) 
            {
                $check_user_i = $this->mm->fetch_user_permissions($this->session->userdata('session_id'));
            
                if($this->session->userdata('session_role') == "user")
                {
                    $session_id = $this->session->userdata('session_id');
                    
                    $res = $this->lm->fetch_generate_policy_sme($session_id);
                }
                else
                {
            	    $res = $this->lm->fetch_generate_policy_sme($session_id);
                }
            
            }
		
            $own_od = "";
            $own_tp = "";
            $on_net = "";
          
            $arr = [];
            $a = $_POST['start'];
            
            foreach($res as $da)
            {
            	$a++;
            	
            	$sub_agn_1 = $this->lm->get_agent_name($da->sub_agn_1);
            	$sub_agn_2 = $this->lm->get_agent_name($da->sub_agn_2);
            	
            	if($sub_agn_1 != "" || $sub_agn_1 != null)
            	{
            	    $agn_1_name = $sub_agn_1->name;
            	}
            	else 
            	{
            	    $agn_1_name = "";
            	}
            	
            	if($sub_agn_2 != "" || $sub_agn_2 != null)
            	{
            	    $agn_2_name = $sub_agn_2->name;
            	}
            	else 
            	{
            	    $agn_2_name = "";
            	}
            	
            	$client_name = "<a href='#' onclick=view_data(".$da->c_lead_id.")>".$da->client_name."</a>";

                $arr[] = array(
                    $a,
                    $client_name,
                    $da->mobile_no,
                    $da->agent_pos_code,
                    $da->policy_no,
                    $da->company_name,
                    "<span class='pull-right'>".number_format($da->total_premium,2)."</span>",
                    "<span class='pull-right'>".number_format($da->gst,2)."</span>",
                    "<span class='pull-right'>".number_format($da->own_commission_amt,2)."</span>",
                    "<span class='pull-right'>".number_format($da->agent_commission_amt,2)."</span>",
                    "<span class='pull-right'>".number_format($da->ai_com,2)."</span>",
                    $agn_1_name,
                    "<span class='pull-right'>".number_format($da->sub_agn_amt_1,2)."</span>",
                    $agn_2_name,
                    "<span class='pull-right'>".number_format($da->sub_agn_amt_2,2)."</span>",
                    $da->business_name,
                    $da->class_name,
                    $da->policy_type,
                    date("d-m-Y",strtotime($da->policy_s_date)),
                    date("d-m-Y",strtotime($da->policy_ex_date)),
                );
            }
    
            $result = array(
            			"draw"=> $draw,
    				    "recordsTotal"=> $this->lm->get_all_generate_policy_count_sme($session_id),
    				    "recordsFiltered"=> $this->lm->get_filtered_generate_policy_count_sme($session_id),
    				    "data"=>$arr,
    				);
            echo json_encode($result);
    }
    
    // customers //
    
    public function customers()
    {
        if( !( $this->session->has_userdata('logged_in') ) ){
            redirect('login', 'refresh');
        }
        
        // if(!$this->auth->can_access('List Customer')){
        //     redirect('access_denied', 'refresh');
        // }
        
        if($this->session->has_userdata('logged_in') && $this->session->userdata('session_role') == "admin") 
    	{    	
    	    $data["permission"] = $this->mm->fetch_user_permissions($this->session->userdata('session_id'));  
		   	$pro_data["project_info"] = $this->mm->fetch_project_info();
		   	$data["users"] = $this->lm->fetch_users();
		   	$data["client_type"] = $this->lm->fetch_client_type();
		   	$data["business"] = $this->lm->fetch_business_type();
		   	$data["class"] = $this->lm->fetch_list_of_policy_type();
    		$this->load->view('header',$pro_data);
    		$this->load->view('customers',$data);
    		$this->load->view('footer',$pro_data);
	    }
	    else if($this->session->has_userdata('logged_in') && ($this->session->userdata('session_role') == "user" || $this->session->userdata('session_role') == "AI"))
	    {
	        
	      $data["permission"]=$check_user_i = $this->mm->fetch_user_permissions($this->session->userdata('session_id'));  
	       if($check_user_i->cust_view == "1")
	        {
	        $pro_data["project_info"] = $this->mm->fetch_project_info();
	        $data["users"] = $this->lm->fetch_users();
	        $data["client_type"] = $this->lm->fetch_client_type();
	        $data["business"] = $this->lm->fetch_business_type();
	        $data["class"] = $this->lm->fetch_list_of_policy_type();
    		$this->load->view('header',$pro_data);
    		$this->load->view('customers',$data);
    		$this->load->view('footer',$pro_data);
	        }
	        else
	        {
	             echo "<script>alert('Permission Denied');window.location.href='home';</script>";
    	          //redirect("home");
	        }
	    }
	    else
	    {
	    	redirect("login");
	    }
    }
    
    public function fetch_customers()
    {
        if($this->session->has_userdata('logged_in'))
    	 {
    	     $draw = intval($this->input->post("draw"));
    	     
    	     $lead_type = $this->input->post("lead_type");
    	     $class = $this->input->post("class_type");
    	     $a = $_POST['start'];
    	     $res = $this->lm->fetch_all_customers($lead_type,$class);
    	     $arr = [];
    	     
             foreach($res as $da)
             {
                    $a++;
                    
                    $action = "<a href='create_lead?id=".$da->id."' class='btn btn-warning btn-xs'><i class='fa fa-eye'></i></a>";
                    
                    
                    $client_name = "<a href='#' onclick=view_data(".$da->id.")>".$da->client_name."</a>";
                    
                    $arr[] =array(
                           $a,
                           $client_name,
                           $da->mobile_no,
                           $da->lclass,
                           $da->p_type,
                           $da->policy_no,
                           $da->pre_name,
                           date_format(date_create($da->policy_ex_date),"d-m-Y"),
                           $action,
                        );
                }
                
    	        $result = array(
            			"draw"=> $draw,
    				    "recordsTotal"=> $this->lm->get_all_customer_datas_count($lead_type,$class),
    				    "recordsFiltered"=> $this->lm->get_customer_filtered_datas_count($lead_type,$class),
    				    "data"=>$arr,
    				);
            echo json_encode($result);
    	 }
    }
    
    public function fetch_renewals()
    {
         if($this->session->has_userdata('logged_in'))
    	 {
            	    $draw = intval($this->input->post("draw"));
        		    $due_date = $this->input->post("due_date");
        		    $lead_type = $this->input->post("lead_type");
            	     
                    if($due_date == "Overdue")
            		{
            		     $from_date = "all";
                         $to_date = date("Y-m-d",strtotime("-1 days"));
            		}
            		else if($due_date == "7 days")
            		{
            		     $from_date = date("Y-m-d");
                         $to_date = date('Y-m-d',strtotime("7 days"));
            		}
            		else if($due_date == "8-15 days")
            		{
            		    $from_date = date('Y-m-d',strtotime("8 days"));
                        $to_date = date('Y-m-d',strtotime("15 days"));
            		}
            		else if($due_date == "16-30 days")
            		{
            		    $from_date = date('Y-m-d',strtotime("16 days"));
                        $to_date = date('Y-m-d',strtotime("30 days"));
            		}
            		else if($due_date == "31-45 days")
            		{
            		     $from_date = date('Y-m-d',strtotime("31 days"));
                         $to_date = date('Y-m-d',strtotime("45 days"));
            		}
            		
            		if($this->session->has_userdata('session_role') == "user")
            	    {
            	        $user_id = $this->session->userdata('session_id');
            	    }
            	    
        			$res = $this->lm->fetch_renewals($lead_type,$user_id,$from_date,$to_date);
        			
        			$arr = [];
                    $a = 0 ;
                    
                  $a = $_POST['start'];
                
                foreach($res as $da)
                {
                	$a++;
        
                    $action = "<a onclick=renewal(".$da->id.") class='btn btn-success btn-xs'><i class='fa fa-refresh'></i>  Renew Now</a>";
            	    
            	    
            	     $client_name = "<a href='#' onclick=view_data(".$da->id.")>".$da->client_name."</a>";
            	 
                    $arr[] = array(
                                   $a,
                                   $client_name,
                                   $da->mobile_no,
                                   $da->lclass,
                                   $da->p_type,
                                   $da->policy_no,
                                   $da->pre_name,
                                   date_format(date_create($da->policy_ex_date),"d-m-Y"),
                                   $action,
                                );
                }
        
                $result = array(
                			"draw"=> $draw,
        				     "recordsTotal"=> $this->lm->get_all_renewal_datas_count($lead_type,$user_id,$from_date,$to_date),
            				"recordsFiltered"=> $this->lm->get_renewal_filtered_datas_count($lead_type,$user_id,$from_date,$to_date),
        				    "data"=>$arr,
        				);
                echo json_encode($result);
        	
            	 }
    }
    
    // UPDATE //
    
    // public function update_client_details()
    // {
    //      if($this->session->has_userdata('logged_in'))
    // 	 {
    // 	    $lead_id = $this->input->post("lead_id");
    // 	    $client_type = $this->input->post("client_type");
	//         $client_name = $this->input->post("client_name");
	//         $salutation = $this->input->post("salutation");
    //         $mobile_no = $this->input->post("mobile_no");
    //         $initial = $this->input->post("initial");
    //         $add_custom_field = $this->input->post("add_custom_field");
    //         $doc_aadhar = $this->input->post("doc_aadhar");
    //         $doc_pan = $this->input->post("doc_pan");
    //         $doc_voter = $this->input->post("doc_voter");
    //         $doc_dl = $this->input->post("doc_dl");
    //         $doc_govt = $this->input->post("doc_govt");
    //         $communication_address = $this->input->post("communication_address");
    //         $permanent_address = $this->input->post("permanent_address");
    //         $district = $this->input->post("district");
    //         $state = $this->input->post("state");
    //         $country = $this->input->post("country");
	//         // $other_contact_details = $this->input->post("other_contact_details");
	//         // $landline_no = $this->input->post("landline_no");
	//         // $address = $this->input->post("address");
	//         $email_id = $this->input->post("email_id");
	//         // $contact_person_name = $this->input->post("contact_person_name");
	//         // $contact_person_des = $this->input->post("contact_person_des");
	//         $dob = $this->input->post("dob");
	//         $age = $this->input->post("age");
	//         $area = $this->input->post("area");
	//         $pin_code = $this->input->post("pin_code");
	        
	//         $client_id = $this->lm->fetch_client_id_by_lead_id($lead_id);
	       
    // 	       $data = array( 
	//              "client_type_id" =>$client_type,
	//              "client_name" =>$client_name,
	//              "salutation" =>$salutation,
    //              "initial" =>$initial,
    //              "add_custom_field" =>$add_custom_field,
    //              "doc_aadhar" =>$doc_aadhar,
    //              "doc_pan" =>$doc_pan,
    //              "doc_voter" =>$doc_voter,
    //              "doc_dl" =>$doc_dl,
    //              "doc_govt" =>$doc_govt,
    //              "communication_address" =>$communication_address,
    //              "permanent_address" =>$permanent_address,
    //              "district" =>$district,
    //              "state" =>$state,
    //              "country" =>$country,
    //              "mobile_no" =>$mobile_no,
	//             //  "other_contact_details"=>$other_contact_details,
	//             //  "landline_no" => $landline_no,
	//             //  "address" =>$address,
	//              "email" =>$email_id,
	//             //  "contact_person_name" =>$contact_person_name,
	//             //  "contact_person_designation"=>$contact_person_des,
	//              "date_of_birth" => $dob,
	//              "age" =>$age,
	//              "area" =>$area,
	//              "pin_code" =>$pin_code,
	//              );
	             
	//            $old_data = $this->lm->get_receiver_email_by_id($client_id);
	           
	//            $res = $this->lm->update_client_details($client_id,$data);
    //             if($res){
	//                  $this->audit->log('list_of_clients', 'UPDATE', null, $old_data, $data);
	//              }
	             
    //         	$activity_log = array("lead_id"=>$lead_id,"action"=>"Client Details Updated","action_type"=>"client_update","created_by"=>$this->session->userdata('session_name'),"time"=>date("Y-m-d h:i:sa"));
    //             $add_activity = $this->lm->add_activity_log($activity_log);
    //             if( $add_activity ){
	//                  $this->audit->log('notification_log', 'INSERT', null, null, $activity_log);
	//              }
	//            echo "success";   
    // 	 }
    // }

    public function update_client_details()
    {
        if ($this->session->has_userdata('logged_in')) 
        {
            $lead_id             = $this->input->post("lead_id");
            $client_type         = $this->input->post("client_type");
            $client_name         = $this->input->post("client_name");
            $salutation          = $this->input->post("salutation");
            $mobile_no           = $this->input->post("mobile_no");
            $initial             = $this->input->post("initial");
            $custom_fields_input = $this->input->post("custom_fields");
            $communication_address = $this->input->post("communication_address");
            $permanent_address   = $this->input->post("permanent_address");
            $district            = $this->input->post("district");
            $state               = $this->input->post("state");
            $country             = $this->input->post("country");
            $email_id            = $this->input->post("email_id");
            $dob                 = $this->input->post("dob");
            $age                 = $this->input->post("age");
            $pin_code            = $this->input->post("pin_code");

            // ✅ Fetch client ID based on lead
            $client_id = $this->lm->fetch_client_id_by_lead_id($lead_id);
            if (empty($client_id)) {
                echo "error";
                return;
            }

            // ✅ Fetch existing client data for old file paths
            $old_data = $this->lm->get_receiver_email_by_id($client_id);

            // === DOCUMENT UPLOAD HANDLER (Same as add_lead_details) ===
            $upload_dir = './datas/client_documents/';
            if (!is_dir($upload_dir)) {
                mkdir($upload_dir, 0777, true);
            }

            $config['upload_path']   = $upload_dir;
            $config['allowed_types'] = 'jpg|jpeg|png|pdf';
            $config['max_size']      = 5120;
            $this->load->library('upload', $config);

            $doc_fields = ['doc_aadhar', 'doc_pan', 'doc_voter', 'doc_dl', 'doc_govt'];
            $uploaded_docs = [];

            foreach ($doc_fields as $field) {
                if (isset($_FILES[$field]) && $_FILES[$field]['name'] != '') {
                    $this->upload->initialize($config);
                    if ($this->upload->do_upload($field)) {
                        $uploaded_docs[$field] = $this->upload->data('file_name');
                    } else {
                        $uploaded_docs[$field] = isset($old_data->$field) ? $old_data->$field : '';
                    }
                } else {
                    // retain old file if no new upload
                    $uploaded_docs[$field] = isset($old_data->$field) ? $old_data->$field : '';
                }
            }

            // === DYNAMIC CUSTOM FIELDS (JSON) — same as add function ===
            $custom_labels = $this->input->post("custom_label");
            $custom_values = $this->input->post("custom_value");

            $custom_fields = [];

           // Case 1: coming as array (normal form)
            if (is_array($custom_labels) && is_array($custom_values)) {
                for ($i = 0; $i < count($custom_labels); $i++) {
                    $label = trim($custom_labels[$i]);
                    $value = trim($custom_values[$i]);
                    if ($label !== "") {
                        $custom_fields[$label] = $value;
                    }
                }
            }

            $custom_fields_json = !empty($custom_fields)
                ? json_encode($custom_fields)
                : (isset($old_data->custom_fields) ? $old_data->custom_fields : null);


            // ✅ Prepare update data
            $data = array(
                "client_type_id"         => $client_type,
                "client_name"            => $client_name,
                "salutation"             => $salutation,
                "initial"                => $initial,
                "custom_fields"          => $custom_fields_json,
                "doc_aadhar"             => $uploaded_docs['doc_aadhar'],
                "doc_pan"                => $uploaded_docs['doc_pan'],
                "doc_voter"              => $uploaded_docs['doc_voter'],
                "doc_dl"                 => $uploaded_docs['doc_dl'],
                "doc_govt"               => $uploaded_docs['doc_govt'],
                "communication_address"  => $communication_address,
                "permanent_address"      => $permanent_address,
                "district"               => $district,
                "state"                  => $state,
                "country"                => $country,
                "mobile_no"              => $mobile_no,
                "email"                  => $email_id,
                "date_of_birth"          => $dob,
                "age"                    => $age,
                "pin_code"               => $pin_code,
                "updated_date"           => date("Y-m-d H:i:s")
            );

            // ✅ Perform update
            $res = $this->lm->update_client_details($client_id, $data);

            if ($res) {
                // ✅ Log client update
                $this->audit->log('list_of_clients', 'UPDATE', null, $old_data, $data);

                // ✅ Add activity log
                $activity_log = array(
                    "lead_id"     => $lead_id,
                    "action"      => "Client Details Updated",
                    "action_type" => "client_update",
                    "created_by"  => $this->session->userdata('session_name'),
                    "time"        => date("Y-m-d h:i:sa")
                );

                $add_activity = $this->lm->add_activity_log($activity_log);
                if ($add_activity) {
                    $this->audit->log('notification_log', 'INSERT', null, null, $activity_log);
                }

                echo "success";
            } else {
                echo "error";
            }
        } 
        else {
            echo "unauthorized";
        }
    }


    
    public function update_requirement_details()
    {
        if($this->session->has_userdata('logged_in'))
    	 {
    	    $lead_id = $this->input->post("lead_id");
    	    $bussiness_type = $this->input->post("bussiness_type");
	        $class = $this->input->post("policy_class");
	        $policy_type = $this->input->post("policy_type");
	        $lead_generated_date =  $this->input->post("lead_generated_date");
	        $due_date =  $this->input->post("due_date");
	        $broken_policy =  $this->input->post("broken_policy");
	        $location=  $this->input->post("location");
	        $classification =  $this->input->post("classification");
	        $source =  $this->input->post("source");
	        $agent_pos = $this->input->post("agent_pos");
	        $assign_to_user =  $this->input->post("assign_to_user");
	        $area_incharge  = $this->input->post("area_incharge");
	        $v_regn_no = $this->input->post("v_regn_no");
	        $region = $this->lm->fetch_agent_region($agent_pos);
	        
	        $region_id = "";
	        
	        if($region != null)
	        {
	            $region_id = $region->region;
	        }
	        
	        
	        $remarks = $this->input->post("remarks");
	        $updated_date = date("Y-m-d h:i:s");
	        
    	    $arr = array( 
    	        
    	             "business_type" =>$bussiness_type,
    	             "class"=>$class,
    	             "policy_type" => $policy_type,
    	             "lead_generated_date" => $lead_generated_date,
    	             "due_date" =>$due_date,
    	             "broken_policy" => $broken_policy,
    	             "location" =>$location,
    	             "classfication" =>$classification,
    	             "source"=>$source,
    	             "lead_status"=>"open",
    	             "agency_and_pos" => $agent_pos,
    	             "assigned_user" => $assign_to_user,
    	             "area_incharge" =>$area_incharge,
    	             "region_id" =>$region_id,
    	             "remarks" =>$remarks,
    	             "updated_date"=>$updated_date);
					 
					 $_leads = $this->lm->get_lead_details($lead_id);
					 
    	             $data = $this->lm->update_requirement_details($arr,$lead_id);
					 
					 
					 if( $data ) {
	                    $_policies = $this->lm->get_policy_details($lead_id);
	                    $sync = "false";
	                    if(isset($_policies->policy_issue_date) && !empty($_policies->policy_issue_date)){
	                        $_date = new DateTime($_policies->policy_issue_date);
	                        $_chkdate = new DateTime('2023-03-01');
	                        if($_date >= $_chkdate)
	                            $sync = "true";
	                    }
	                    
	                    $pdata = ['policy_agency_pos' => $agent_pos];
	                    
	                    if( isset( $_policies->vocher_status ) && ( $_policies->vocher_status == "0" ) && $sync == "true"){
                            $commission_datas = $this->getCommissonByLead($lead_id); //$this->find_commission_id();
                            if( isset( $commission_datas['commission_id'] ) && !empty( $commission_datas['commission_id'] ) ) {
                                $pdata['commission_id'] = $commission_datas['commission_id'];
                            }
                        }
	                    
	                    if( $this->lm->update_generated_policy($pdata, $lead_id) ) {
	                        if(  $sync == "true"){ //isset( $_policies->vocher_status ) && ( $_policies->vocher_status == "0" ) &&
	                            $this->update_commission_by_policy($lead_id);
	                        }
	                        
	                        $this->audit->log('list_of_leads', 'UPDATE', null, $_leads, $arr);
        	                $this->audit->log('policy_info', 'UPDATE', null, $_policies, $pdata);
	                    }
        	         }
    	             if($class == "1")
    	             {
						$_vechicles = $this->lm->get_vechicle_details($lead_id);
    	                $v_info = array("vechi_register_no" =>$v_regn_no);
                        $update_v_info = $this->lm->update_vechicle_regn_no($v_info,$lead_id);  
						$this->audit->log('vechile_details', 'UPDATE', null, $_vechicles, $v_info);
    	             }
    	             
    	             	$activity_log = array("lead_id"=>$lead_id,"action"=>"Requirement Details Updated","action_type"=>"requirement_details_update","created_by"=>$this->session->userdata('session_name'),"time"=>date("Y-m-d h:i:sa"));
                        $add_activity = $this->lm->add_activity_log($activity_log);
    	             echo "success";
	             }
    }
    	 
    	 // Edit Vechicle Details // 
    	 
    	 public function fetch_edit_vechicle_details()
    	 {
        	 if($this->session->has_userdata('logged_in'))
        	 {
        	     $lead_id = $this->input->post("lead_id");
        	     $res = $this->lm->fetch_edit_vechicle_details($lead_id);
        	     echo json_encode($res);
        	 }
    	 }
    	 
    	 public function get_vechicle_make()
    	 {
    	     if($this->session->has_userdata('logged_in'))
        	 {
        	     
        	 }
    	 }
    	 
        public function get_uploaded_vechicle_documents()
        {
            if($this->session->has_userdata('logged_in'))
            {
                $lead_id = $this->input->post("lead_id");
                $res = $this->lm->get_vechicle_uploaded_documents($lead_id);
                
                $html = "";
                foreach($res as $da)
                {
        		$html .="<tr>
        		           <td><a target='_blank' href='./datas/documents/".$da->document_file."'><i class='fa fa-file'></i></a></td>
        		           <td>".$da->document_file."</td>
        		           <td>".$da->document_type."</td>
        		           <td><a class='fa fa-edit fa-2x' onclick=edit_vechi_data(".$da->id.")></a></td>
        		           <td><a class='fa fa-trash fa-2x' style='color:red;' onclick=delete_vechi_data(".$da->id.")></a></td>
        		         </tr>";
                }
                echo $html;
            }
        }
        
        public function get_vechicle_uploaded_file_by_id()
        {
            if($this->session->has_userdata('logged_in'))
            {
                 $id = $this->input->post("id");
                $res = $this->lm->get_vechicle_uploaded_file_by_id($id);
                echo json_encode($res);
            }
        }
        
        public function edit_vehicle_documents()
        {
            if($this->session->has_userdata('logged_in'))
            {
                $id = $this->input->post("id");
                $document_type = $this->input->post("document_type");
                
                       if(isset($_FILES))
                		{
                			$config['upload_path'] = './datas/documents/';
                			$config['allowed_types'] = '*';
                			
                			$this->load->library('upload',$config);
                			$this->upload->initialize($config);
                			if(!$this->upload->do_upload('file'))
                			{
                			   $date = date("Y-m-d H:i:s"); 
                			   $data = array("document_type" =>$document_type,"updated_time" =>$date);
                			}
                			else
                			{
                			    $res = $this->lm->get_vechicle_uploaded_file_by_id($id);  
			                    $old_file = $res->document_file;
                               unlink("./datas/documents/".$old_file);
                			   $file = $this->upload->data('file_name');
                			   $date = date("Y-m-d H:i:s"); 
                			   $data = array("document_type" =>$document_type,"document_file"=>$file,"updated_time" =>$date);
                			}
                			
                			$old_data = $this->lm->get_vechicle_uploaded_file_by_id($id);
                			
                			$res = $this->lm->update_vechicle_documents($data,$id);
                			if($res){
            	                 $this->audit->log('vechicle_documents', 'UPDATE', null, $old_data, $data);
            	             }
                			
                			$get_docs = $this->lm->get_vechicle_uploaded_documents($res->lead_id);
                			
                			$html = "";
                			
                            foreach($get_docs as $da)
                                {
                                $html .="<tr>
                                <td><a target='_blank' href='./datas/documents/".$da->document_file."'><i class='fa fa-file'></i></a></td>
                                <td>".$da->document_file."</td>
                                <td>".$da->document_type."</td>
                                <td><a class='fa fa-edit fa-2x' onclick=edit_vechi_data(".$da->id.")></a></td>
                                <td><a class='fa fa-trash fa-2x' style='color:red;' onclick=delete_vechi_data(".$da->id.")></a></td>
                                </tr>";
                            }
                            echo $html;
                		}
            }
        }
        
        public function delete_vechicle_documents($id)
        {
            if($this->session->has_userdata('logged_in'))
            {
                $id = $this->input->post("id");
                $res = $this->lm->get_vechicle_uploaded_file_by_id($id);  
			    $old_file = $res->document_file;
			    
			    unlink("./datas/documents/".$old_file);
			    
			    $old_data = $this->lm->get_vechicle_uploaded_file_by_id($id);
			    $data = $this->lm->delete_vechicle_documents($id);
                if($data){
                    $this->audit->log('vechicle_documents', 'DELETE', null, $old_data, null);
                }
			    if($data->lead_id !="")
			    {
			        $get_docs = $this->lm->get_vechicle_uploaded_documents($data->lead_id);
			        
                    $html = "";

			        foreach($get_docs as $da)
                    {
                    $html .="<tr>
                    <td><a target='_blank' href='./datas/documents/".$da->document_file."'><i class='fa fa-file'></i></a></td>
                    <td>".$da->document_file."</td>
                    <td>".$da->document_type."</td>
                    <td><a class='fa fa-edit fa-2x' onclick=edit_vechi_data(".$da->id.")></a></td>
                    <td><a class='fa fa-trash fa-2x' style='color:red;' onclick=delete_vechi_data(".$da->id.")></a></td>
                    </tr>";
                    }
                      echo $html;
			    }
			    else
			    {
			         $html = "";
			    }
            }
        }
        
        public function update_vechicle_details()
        {
            if ($this->session->has_userdata('logged_in')) 
            {
                $id = $this->input->post("id");
                $vechile_type = $this->input->post("vechile_type");
                $vechi_make = $this->input->post("vechi_make");
                $vechi_model = $this->input->post("vechi_model");
                $vechi_varient = $this->input->post("vechi_varient");
                $vechi_cc = $this->input->post("vechi_cc");
                $vechi_manu_month = $this->input->post("vechi_manu_month");
                $vechi_manu_year = $this->input->post("vechi_manu_year");
                $vechi_seating = $this->input->post("vechi_seating");
                $vechi_classfication = $this->input->post("vechi_classfication");
                $vechi_fuel_type = $this->input->post("vechi_fuel_type");
                $vechi_gvw = $this->input->post("vechi_gvw");
                $passenger_carrying = $this->input->post("passenger_carrying");
                $vechi_engine_num = $this->input->post("vechi_engine_num");
                $vechi_chassis_num = $this->input->post("vechi_chassis_num");
                $vechi_hypothecation = $this->input->post("vechi_hypothecation");
                $vechi_agency_pos = $this->input->post("vechi_agency_pos");
                $vechi_remarks = $this->input->post("vechi_remarks");
                $regn_date = $this->input->post("regn_date");
                $register_no = $this->input->post("register_no");
                $rto = $this->input->post("rto");
                $zone = $this->input->post("zone");
                $regn_address = $this->input->post("regn_address");
                $state = $this->input->post("state");
                $city = $this->input->post("city");
                $pincode = $this->input->post("pincode");
                $vechi_user_name = $this->input->post("vechi_user_name");
                $vechi_user_cont = $this->input->post("vechi_user_cont");
                $date = date("Y-m-d H:i:s");

                // ✅ Handle Additional Fields
                $additionalFieldsJson = $this->input->post('additional_fields');
                if (!empty($additionalFieldsJson)) {
                    // Validate JSON
                    $decoded = json_decode($additionalFieldsJson, true);
                    if (json_last_error() === JSON_ERROR_NONE && !empty($decoded)) {
                        $additionalFields = $additionalFieldsJson;
                    } else {
                        $additionalFields = null;
                    }
                } else {
                    $additionalFields = null;
                }

                // ✅ Check for duplicate register number
                $res_1 = $this->lm->check_regn_no_exits($register_no, $id);

                if ($res_1 < 1) 
                {
                    $data = array(
                        "vechile_type" => $vechile_type,
                        "vechi_make" => $vechi_make,
                        "vechi_model" => $vechi_model,
                        "vechi_varient" => $vechi_varient,
                        "vechi_cc" => $vechi_cc,
                        "vechi_manu_month" => $vechi_manu_month,
                        "vechi_manu_year" => $vechi_manu_year,
                        "vechi_seating" => $vechi_seating,
                        "vechi_classfication" => $vechi_classfication,
                        "vechi_fuel_type" => $vechi_fuel_type,
                        "vechi_gvw" => $vechi_gvw,
                        "passenger_carrying" => $passenger_carrying,
                        "vechi_engine_num" => $vechi_engine_num,
                        "vechi_chassis_num" => $vechi_chassis_num,
                        "vechi_hypothecation" => $vechi_hypothecation,
                        "created_by" => $vechi_agency_pos,
                        "vechi_remarks" => $vechi_remarks,
                        "regn_date" => $regn_date,
                        "vechi_register_no" => $register_no,
                        "rto" => $rto,
                        "zone" => $zone,
                        "regn_address" => $regn_address,
                        "state" => $state,
                        "city" => $city,
                        "pincode" => $pincode,
                        "vechi_user_name" => $vechi_user_name,
                        "vechi_user_cont" => $vechi_user_cont,
                        "updated_at" => $date
                    );

                    // ✅ Append Additional Fields if present
                    if (!empty($additionalFields)) {
                        $data['additional_fields'] = $additionalFields;
                    }

                    // ✅ Handle Registration Certificate upload
                    if (isset($_FILES['regn_certificate']) && $_FILES['regn_certificate']['name'] != '') {
                        $config['upload_path'] = './datas/Registration_Certificate/';
                        $config['allowed_types'] = 'jpg|jpeg|png|pdf';
                        $config['file_name'] = time() . '_' . $_FILES['regn_certificate']['name'];

                        $this->load->library('upload', $config);
                        $this->upload->initialize($config);

                        if ($this->upload->do_upload('regn_certificate')) {
                            $upload_data = $this->upload->data();
                            $file_path = $upload_data['full_path'];
                            $file_ext = strtolower($upload_data['file_ext']);
                            $regn_certificate = $upload_data['file_name'];

                            // ✅ Step 1: Compress image if large
                            if (in_array($file_ext, ['.jpg', '.jpeg', '.png'])) {
                                $max_file_size_kb = 500; // compress if > 500 KB
                                $current_size_kb = $upload_data['file_size'];

                                if ($current_size_kb > $max_file_size_kb) {
                                    compress_image($file_path, $file_path, 70); // resize + reduce quality
                                }
                            }

                            // ✅ Step 2: Compress PDF if large
                            if ($file_ext === '.pdf') {
                                $max_file_size_kb = 1024; // compress if > 1 MB
                                $current_size_kb = $upload_data['file_size'];

                                if ($current_size_kb > $max_file_size_kb) {
                                    $compressed_pdf = $config['upload_path'] . 'compressed_' . $upload_data['file_name'];
                                    compress_pdf($file_path, $compressed_pdf);
                                    rename($compressed_pdf, $file_path);
                                }
                            }

                            // ✅ Step 3: Delete old RC file if exists
                            $old_file = $this->lm->get_old_regn_certificate($id);
                            if (!empty($old_file->regn_certificate)) {
                                $old_path = './datas/Registration_Certificate/' . $old_file->regn_certificate;
                                if (file_exists($old_path) && is_file($old_path)) {
                                    unlink($old_path);
                                }
                            }

                            // ✅ Step 4: Store new file info
                            $final_size_kb = round(filesize($file_path) / 1024, 2);
                            $data['regn_certificate'] = $regn_certificate;
                            $data['regn_file_size_kb'] = $final_size_kb;

                            log_message('info', "Compressed & Updated RC File: {$regn_certificate} ({$final_size_kb} KB)");
                        }
                    }

                    // ✅ Handle Vehicle Photo Uploads (img_1 → img_30)
                    for ($i = 1; $i <= 30; $i++) {
                        $field_name = 'img_' . $i;
                        if (isset($_FILES[$field_name]) && $_FILES[$field_name]['name'] != '') {
                            $config['upload_path'] = './datas/Vehicle_Photos/';
                            $config['allowed_types'] = 'jpg|jpeg|png';
                            $config['file_name'] = time() . '_' . $_FILES[$field_name]['name'];

                            $this->load->library('upload', $config);
                            $this->upload->initialize($config);

                            if ($this->upload->do_upload($field_name)) {
                                $upload_data = $this->upload->data();
                                $file_path = $upload_data['full_path'];
                                $file_ext = strtolower($upload_data['file_ext']);

                                // ✅ Compress large images
                                $max_file_size_kb = 500; // compress if > 500 KB
                                $current_size_kb = $upload_data['file_size'];
                                if ($current_size_kb > $max_file_size_kb) {
                                    compress_image($file_path, $file_path, 70);
                                }

                                // ✅ Delete old file if exists
                                $old_file = $this->lm->get_old_vehicle_photo($id, $field_name);
                                if (!empty($old_file->$field_name)) {
                                    $old_path = './datas/Vehicle_Photos/' . $old_file->$field_name;
                                    if (file_exists($old_path) && is_file($old_path)) {
                                        unlink($old_path);
                                    }
                                }

                                // ✅ Store new photo name
                                $data[$field_name] = $upload_data['file_name'];
                            }
                        }
                    }

                    // ✅ Update Vehicle Details
                    $old_data = $this->lm->fetch_edit_vechicle_details($id);
                    $res = $this->lm->update_vechicle_details($data, $id);

                    if ($res) {
                        // Audit Log
                        $this->audit->log('vechile_details', 'UPDATE', null, $old_data, $data);

                        // Add activity log
                        $arr = $this->lm->fetch_vechicle_lead_id($id);
                        $activity_log = array(
                            "lead_id" => $arr->lead_id,
                            "action" => "<b>Vehicle Details Updated</b>",
                            "action_type" => "vechicle_update",
                            "created_by" => $this->session->userdata('session_name'),
                            "time" => date("Y-m-d H:i:s")
                        );
                        $this->lm->add_activity_log($activity_log);
                        $this->audit->log('notification_log', 'INSERT', null, null, $activity_log);

                        echo "success";
                    }
                } 
                else 
                {
                    echo "Exits";
                }
            }
        }

        
        public function get_recent_activities()
        {
            if($this->session->has_userdata('logged_in'))
    	    {
    	        $lead_id = $this->input->post("lead_id");
    	        $res = $this->lm->get_recent_activities($lead_id);
    	       
    	        $html = "";
    	        
    	        foreach($res as $da)
    	        {
    	            if($da->action_type == "new_lead_creation")
    	            {
    	                $icon = "fa fa-bullseye";
    	                $html .=" <tr>
                        <td class = 'no_mar_pad'><i class='".$icon."' style='padding-right:10px;'></i><a href='leads'>
                        <span style='color:#444'><b>".$da->created_by."</b> ".$da->action."</span>
                                    <span style='color:#444'> at ".date("h:i:s a", strtotime($da->time))."</span></a></td>
                                </tr><p></p>";
    	            }
    	            else if($da->action_type == "Follow_up")
    	            {
    	                $icon = "fa fa-clock-o";
    	              
    	                $html .=" <tr>
                                    <td class='no_mar_pad'><i class='".$icon."' style='padding-right:10px;'></i><a href='followups'>
                                     <span style='color:#444'><b>".$da->created_by."</b> ".$da->action." </span></a></td>
                                </tr><p></p>";
    	            }
    	            else if($da->action_type == "client_update")
    	            {
    	                 $icon = "fa fa-bullseye";
    	              
    	                $html .=" <tr>
                                    <td class='no_mar_pad'><i class='".$icon."' style='padding-right:10px;'></i><a href='leads'>
                                     <span style='color:#444'><b>".$da->created_by."</b> ".$da->action." </span>
                                     <span style='color:#444'> at ".date("d-m-Y h:i:s a", strtotime($da->time))."</span></a></td>
                                </tr><p></p>";
    	            }
    	            else if($da->action_type == "requirement_details_update")
    	            {
    	                 $icon = "fa fa-bullseye";
    	              
    	                $html .=" <tr>
                                    <td class='no_mar_pad'><i class='".$icon."' style='padding-right:10px;'></i><a href='leads'>
                                     <span style='color:#444'><b>".$da->created_by."</b> ".$da->action." </span>
                                     <span style='color:#444'> at ".date("d-m-Y h:i:s a", strtotime($da->time))."</span></a></td>
                                </tr><p></p>";
    	            }
    	            else if($da->action_type == "vechicle_update")
    	            {
    	                $icon = "fa fa-car";
    	              
    	                $html .=" <tr>
                                    <td class='no_mar_pad'><i class='".$icon."' style='padding-right:10px;'></i><a href='leads'>
                                     <span style='color:#444'><b>".$da->created_by."</b> ".$da->action." </span>
                                     <span style='color:#444'> at ".date("d-m-Y h:i:s a", strtotime($da->time))."</span></a></td>
                                </tr><p></p>";
    	            }
    	            else if($da->action_type =="add_vechicle")
    	            {
    	                $icon = "fa fa-car";
    	              
    	                $html .=" <tr>
                                    <td class='no_mar_pad'><i class='".$icon."' style='padding-right:10px;'></i><a href='leads'>
                                     <span style='color:#444'><b>".$da->created_by."</b> ".$da->action." </span>
                                     <span style='color:#444'> at ".date("d-m-Y h:i:s a", strtotime($da->time))."</span></a></td>
                                </tr><p></p>";
    	            }
    	            else if($da->action_type =="prospect")
    	            {
    	                $icon = "fa fa-diamond";
    	              
    	                $html .=" <tr>
                                    <td class='no_mar_pad'><i class='".$icon."' style='padding-right:10px;'></i><a href='leads'>
                                     <span style='color:#444'><b>".$da->created_by."</b> ".$da->action." </span>
                                     <span style='color:#444'> at ".date("d-m-Y h:i:s a", strtotime($da->time))."</span></a></td>
                                </tr><p></p>";
    	            }
    	            else if($da->action_type =="generate_policy")
    	            {
    	                 $icon = "fa fa-file-text";
    	              
    	                $html .=" <tr>
                                    <td class='no_mar_pad'><i class='".$icon."' style='padding-right:10px;'></i><a href='leads'>
                                     <span style='color:#444'><b>".$da->created_by."</b> ".$da->action." </span>
                                     <span style='color:#444'> at ".date("d-m-Y h:i:s a", strtotime($da->time))."</span></a></td>
                                </tr><p></p>";
    	            }
    	            else if($da->action_type =="policy_email")
    	            {
    	                 $icon = "fa fa-envelope";
    	              
    	                $html .=" <tr>
                                    <td class='no_mar_pad'><i class='".$icon."' style='padding-right:10px;'></i><a href='leads'>
                                     <span style='color:#444'><b>".$da->created_by."</b> ".$da->action." </span>
                                     <span style='color:#444'> at ".date("d-m-Y h:i:s a", strtotime($da->time))."</span></a></td>
                                </tr><p></p>";
    	            }
    	        }
    	        echo $html;
    	    }
        }
        
        // create quotation //
        
        public function get_basic_informations()
        {
            if($this->session->has_userdata('logged_in'))
    	    {
    	        $lead_id = $this->input->post("lead_id");
    	        $res = $this->lm->get_basic_informations($lead_id);
    	        
    	        if($res != "")
    	        {
    	            $policy_type = $res->policy_type;
    	            
    	            if($policy_type == "1")
    	            {
    	                  $data = $this->lm->get_car_details($lead_id);  
    	            }
    	            else if($policy_type == "2")
    	            {
    	                  $data = $this->lm->get_bike_details($lead_id); 
    	            }
    	            else if($policy_type == "3")
    	            {
    	                  $data = $this->lm->get_car_details($lead_id);  
    	            }
    	            else if($policy_type == "4")
    	            {
    	                  $data = $this->lm->get_bike_details($lead_id); 
    	            }
    	        }
    	        echo json_encode(array("basic_details"=>$res,"vechi_details"=>$data));
    	    }
        }
        
        public function add_quotations()
        {
            if($this->session->has_userdata('logged_in'))
    	    {
    	    $data = array(
    	    "lead_id" => $this->input->post("lead_id"),
    	    "policy_co_cover_type" => $this->input->post("policy_co_cover_type"),
            "policy_term"=>$this->input->post("q_policy_term"),
            "policy_s_date"=>$this->input->post("q_policy_s_date"),
            "policy_ex_date"=>$this->input->post("q_policy_ex_date"),
            "insurer"=>$this->input->post("q_insurer"),
            "insurer_branch"=>$this->input->post("q_insurer_branch"),
            "idv"=>$this->input->post("q_idv"),
            "elec_access_value"=>$this->input->post("q_elec_access_value"),
            "non_elec_access_value"=>$this->input->post("q_non_elec_access_value"),
            "lpg_cng"=>$this->input->post("q_lpg_cng"), 
            "sum_insured"=>$this->input->post("q_sum_insured"),
            "make_model"=>$this->input->post("q_make_model"),
            "vechi_age"=>$this->input->post("q_vechi_age"),
            "rto_code"=>$this->input->post("q_rto_code"),
            "zone"=>$this->input->post("q_zone"),
            "cubic_capactiy"=>$this->input->post("q_cubic_capactiy"),
            "vechi_classification"=> $this->input->post("q_vechi_classification"),
			"basic_od_percentage"=>$this->input->post("q_basic_od_percentage"),
            "basic_od_amount"=>$this->input->post("q_basic_od_amount"),
            "spl_dis_per"=>$this->input->post("q_spl_dis_per"),
            "spl_dis_amount"=>$this->input->post("q_spl_dis_amount"),
            "spl_loading_per"=>$this->input->post("q_spl_loading_per"),
            "spl_loading_amount"=>$this->input->post("q_spl_loading_amount"),
            "non_basic_od"=>$this->input->post("q_non_basic_od"),
            "non_elec_acc_amount"=>$this->input->post("q_non_elec_acc_amount"),
            "bi_fuel_kit"=>$this->input->post("q_bi_fuel_kit"),
            "basic_od1"=>$this->input->post("q_basic_od1"),
            "geographical_area"=>$this->input->post("q_geographical_area"),
            "geographical_amount"=>$this->input->post("q_geographical_amount"),
            "emp_loading"=>$this->input->post("q_emp_loading"), 
            "emp_loading_amount"=>$this->input->post("q_emp_loading_amount"),
            "fiber_class_tank"=>$this->input->post("q_fiber_class_tank"), 
            "fiber_class_tank_amount"=>$this->input->post("q_fiber_class_tank_amount"),
            "driving_tuitions"=>$this->input->post("q_driving_tuitions"), 
            "driving_tuitions_amount"=>$this->input->post("q_driving_tuitions_amount"), 
            "basic_od2"=>$this->input->post("q_basic_od2"),
            "basic_od2_amount"=>$this->input->post("q_basic_od2_amount"),
			"anti_theft"=>$this->input->post("q_anti_theft"),
            "anti_theft_amount"=>$this->input->post("q_anti_theft_amount"),
            "anti_handicap"=>$this->input->post("q_anti_handicap"),
            "anti_handicap_amount"=>$this->input->post("q_anti_handicap_amount"),
            "aai"=>$this->input->post("q_aai"),
            "aai_amount"=>$this->input->post("q_aai_amount"),
            "voluntary_deductable"=>$this->input->post("q_voluntary_deductable"),
            "voluntary_deductable_amount"=>$this->input->post("q_voluntary_deductable_amount"),
            "basic_od_3"=>$this->input->post("q_basic_od_3"),
            "ncb_percentage"=>$this->input->post("q_ncb_percentage"),
            "ncb_percentage_amount"=>$this->input->post("q_ncb_percentage_amount"),
            "basic_tp"=>$this->input->post("q_basic_tp"),
            "fuel_kit_amt"=>$this->input->post("q_fuel_kit_amt"),
            "basic_tp1"=>$this->input->post("q_basic_tp1"),
            "geograpical_amt"=>$this->input->post("q_geograpical_amt"),
            "owner_diver_amt"=>$this->input->post("q_owner_diver_amt"),
            "no_of_year_own_drv"=>$this->input->post("q_no_of_year_own_drv"),
            "un_named_passenger_pa"=>$this->input->post("q_un_named_passenger_pa"),
            "un_named_passenger_amt"=>$this->input->post("q_un_named_passenger_amt"),
            "no_seats_per_person"=>$this->input->post("q_no_seats_per_person"),
            "no_seats_per_person_amt"=>$this->input->post("q_no_seats_per_person_amt"),
            "total_od_premium"=>$this->input->post("q_tot_od_premium"),
            "llp"=>$this->input->post("q_llp"),
            "llp_amt"=>$this->input->post("q_llp_amt"),
            "no_drv_emp"=>$this->input->post("q_no_drv_emp"),
            "pa_paid_drv"=>$this->input->post("q_pa_paid_drv"),
            "pa_paid_drv_amt"=>$this->input->post("q_pa_paid_drv_amt"),
            "no_seats_per_person1"=>$this->input->post("q_no_seats_per_person1"),
            "no_seats_per_person_amt1"=>$this->input->post("q_no_seats_per_person_amt1"),
            "tot_tp_premium"=>$this->input->post("q_tot_tp_premium"),
			"q_add_on_combo_premium"=>$this->input->post("q_add_on_combo_premium"),
            "q_add_on_plan_premium_percentage"=>$this->input->post("q_add_on_plan_premium_percentage"),
            "q_add_on_plan_premium_amt" =>$this->input->post("q_add_on_plan_premium_amt"),
            "q_zero_depreciation_check"=>$this->input->post("q_zero_depreciation_check"),
            "q_zero_depreciation_percentage"=>$this->input->post("q_zero_depreciation_percentage"),
            "q_zero_depreciation_amt"=>$this->input->post("q_zero_depreciation_amt"),
            "q_addtional_addons_check"=>$this->input->post("q_addtional_addons_check"),
            "q_addtional_addons_amt"=>$this->input->post("q_addtional_addons_amt"),
            "q_consumbles_check"=>$this->input->post("q_consumbles_check"),
            "q_consumbles_percentage"=>$this->input->post("q_consumbles_percentage"),
            "q_consumbles_amt"=>$this->input->post("q_consumbles_amt"),
            "q_tyre_cover"=>$this->input->post("q_tyre_cover"),
            "q_tyre_cover_percentage"=>$this->input->post("q_tyre_cover_percentage"),
            "q_tyre_cover_amt"=>$this->input->post("q_tyre_cover_amt"),
            "q_ncb_protection_check"=>$this->input->post("q_ncb_protection_check"),
            "q_ncb_protection_amt"=>$this->input->post("q_ncb_protection_amt"),
            "q_engine_protector_check"=>$this->input->post("q_engine_protector_check"),
            "q_engine_protector_percentage"=>$this->input->post("q_engine_protector_percentage"),
            "q_engine_protector_amt" => $this->input->post("q_engine_protector_amt"),
            "q_return_to_invoice_check"=>$this->input->post("q_return_to_invoice_check"),
            "q_return_to_invoice_percentage"=>$this->input->post("q_return_to_invoice_percentage"),
            "q_return_to_invoice_amt"=>$this->input->post("q_return_to_invoice_amt"),
            "key_replacement_check" => $this->input->post("q_key_replacement_check"),
			"key_replacement_percentage" => $this->input->post("q_key_replacement_percentage"),
			"key_replacement_amt" => $this->input->post("q_key_replacement_amt"),
			"daily_allow_check" => $this->input->post("q_daily_allow_check"), 
			"daily_allow_percentage" => $this->input->post("q_daily_allow_percentage"),
			"daily_allow_amt" => $this->input->post("q_daily_allow_amt"),
			"loss_of_belong_check" => $this->input->post("q_loss_of_belong_check"), 
			"loss_of_belong_percentage" => $this->input->post("q_loss_of_belong_percentage"),
			"loss_of_belong_amt" => $this->input->post("q_loss_of_belong_amt"),
			"hotel_trvl_check" => $this->input->post("q_hotel_trvl_check"),
			"hotel_trvl_percentage" => $this->input->post("q_hotel_trvl_percentage"),
			"hotel_trvl_amt" => $this->input->post("q_hotel_trvl_amt"),
			"wind_shield_check" => $this->input->post("q_wind_shield_check"), 
			"wind_shield_percentage" => $this->input->post("q_wind_shield_percentage"),
			"wind_shield_amt" => $this->input->post("q_wind_shield_amt"),
			"baggage_ins_check" => $this->input->post("q_baggage_ins_check"), 
			"baggage_ins_percentage" => $this->input->post("q_baggage_ins_percentage"),
			"baggage_ins_amt" => $this->input->post("q_baggage_ins_amt"),
			"other_add_on_coverag_per" => $this->input->post("q_other_add_on_coverag_per"),
			"other_add_on_coverage_amt" => $this->input->post("q_other_add_on_coverage_amt"),
			"value_added_services" => $this->input->post("q_value_added_services"),
			"net_addon_cover_premium" => $this->input->post("q_net_addon_cover_premium"),
			"add_on_discount_percentage" => $this->input->post("q_add_on_discount_percentage"),
			"add_on_discount_amt" => $this->input->post("q_add_on_discount_amt"),
			"tot_add_on_cover_premium" => $this->input->post("q_tot_add_on_cover_premium"),
			"total_premium" => $this->input->post("q_total_premium"),
			"gst" => $this->input->post("q_gst"),
			"total_payable" => $this->input->post("q_total_payable"),
			"commission_base_premium" => $this->input->post("q_commission_base_premium"),
			"created_user" => $this->session->userdata('session_name'),
			"created_date" => date("Y-m-d H:i:s")
            );
            
            $res = $this->lm->add_quotations($data);
            if( $res ){
                $this->audit->log('quotations', 'INSERT', null, null, $data);
            }
    	    
    	    }
        }
      
       
        public function get_all_quotes()
        {
            if($this->session->has_userdata('logged_in'))
    	    {
    	        $lead_id = $this->input->post("lead_id");
    	        
    	        $html = "";

                if($lead_id) {
                    $res =$this->lm->get_all_quotes($lead_id);
                    if(isset($res) && !empty($res)) {
        	            foreach($res as $da)
            	        {
            	           if($da->insurer == "1")
            	           {
            	               $da->insurer = "TATA AIG";
            	           }
            	           else
            	           {
            	               $da->insurer = "RELAINCE GENERAL";
            	           }
            	           $html .="<tr>
            	                     <td><input type='checkbox' class='form-check-input select_checkbox'></td>
            	                     <td>".$da->insurer."</td>
            	                     <td>".$da->total_premium."</td>
            	                     <td>".date_format(date_create($da->policy_s_date),"d-m-Y")."</td>
            	                     <td>".$da->created_user."</td>
            	                     <td><a href='generate_quotation?id=".$da->id."&lead_id=".$da->lead_id."' target='_blank'><i class='fa fa-file-text-o'></i></a></td>
            	                     <td><i class='fa fa-envelope'></i></td>
            	                     <td><i class='fa fa-comment'></i></td>
            	               </tr>";
            	        }
                    }
                }
                
    	        echo $html;
    	    }
        }
       
         
       public function generate_quotation()
       {
           if($this->session->has_userdata('logged_in'))
    	    {
    	        $id = $this->input->get("id");
    	        $lead_id = $this->input->get("lead_id");
    	        
    	        $company_id = 1;
    	        
	            $company_info = $this->lm->fetch_single_company_settings($company_id);
    	        $res = $this->lm->get_basic_informations($lead_id);
    	        $usr_details = $this->lm->get_user_details($this->session->userdata('session_id'));
    	        $quote_details =$this->lm->get_single_quote_details($id);
    	        
    	        $data = "";
    	        
    	        if($res != "")
    	        {
    	            $policy_type = $res->policy_type;
    	            
    	            if($policy_type == "1")
    	            {
    	                  $data = $this->lm->get_car_details($lead_id);  
    	            }
    	            else if($policy_type == "2")
    	            {
    	                  $data = $this->lm->get_bike_details($lead_id); 
    	            }
    	            else if($policy_type == "3")
    	            {
    	                  $data = $this->lm->get_car_details($lead_id);  
    	            }
    	            else if($policy_type == "4")
    	            {
    	                  $data = $this->lm->get_bike_details($lead_id); 
    	            }
    	        }
    	        
    	        $manu_date = "01-".$data->vechi_manu_month."-".$data->vechi_manu_year;
    	        
    	          if($quote_details->insurer == "1")
    	           {
    	               $quote_details->insurer = "TATA AIG";
    	           }
    	           else
    	           {
    	               $quote_details->insurer = "RELAINCE GENERAL";
    	           }
    	        
    	        $content = "<!DOCTYPE html>
                        <html>
                        <head>
                            <title>Generate Quotation : ".$res->client_name." </title>
                            <style>
                                *{
                                    padding:1px;
                                    margin:0px;
                                    font-family: 'Courier';
                                    font-size:12px;
                                }
                            </style>
                        </head>
                        <body style='border:1px solid #aaa;padding:10px;margin: 8px;'>
                        
                      <center><p style='font-size:20px;padding-top:0px;'>Quotation Worksheet For Motor Insurance</p></center>
                       
                       <p style='padding:3px;'><b>Dear, Mr.".$res->client_name."</b></p>
                       
                      <table style='width:100%;padding:20px 2px;padding-top:5px;'>
                                <tr>
                                    <td style='background-color:#dff0d8;padding:5px;width:20%;text-align: left;'>Make & Model</td>
                                    <td style='background-color:#dff0d8;padding:5px;width:20%;text-align: left;'>Registration No</td>
                                    <td style='background-color:#dff0d8;padding:5px;width:20%;text-align: left;'>MFG Year</td>
                                    <td style='background-color:#dff0d8;padding:5px;width:20%;text-align: left;'>Cubic Capacity</td>
                                    <td style='background-color:#dff0d8;padding:5px;width:20%;text-align: left;'>Expiry Date</td>
                                </tr>
                                
                                <tr>
                                    <td style='padding:5px;'>
                                        <p>".$data->brand_name." ".$data->model_name." ".$data->vechi_fuel_type."</p>
                                    </td>
                                     <td style='padding:5px;'>
                                        <p>".$data->vechi_register_no."</p>
                                    </td>
                                    <td style='padding:5px;'>
                                       <p> ".date('M',strtotime($manu_date))." ".date('Y',strtotime($manu_date))."</p>
                                    </td>
                                     <td style='padding:5px;'>
                                       <p>".$quote_details->cubic_capactiy."</p>
                                    </td>
                                    <td style='padding:5px;'>
                                       <p>".date_format(date_create($quote_details->policy_ex_date),"d-m-Y")."</p>
                                    </td>
                                </tr>
                                
                                <tr>
                                    <td style='background-color:#dff0d8;padding:5px;width:20%;text-align: left;'>Registration Date</td>
                                    <td style='background-color:#dff0d8;padding:5px;width:20%;text-align: left;'>Engine No</td>
                                    <td style='background-color:#dff0d8;padding:5px;width:20%;text-align: left;'>Chassis No</td>
                                    <td style='background-color:#dff0d8;padding:5px;width:20%;text-align: left;'>Seating Capacity</td>
                                    <td style='background-color:#dff0d8;padding:5px;width:20%;text-align: left;'>Hypothecation</td>
                                </tr>
                                
                                 <tr>
                                    <td style='padding:5px;'>
                                        <p>".date_format(date_create($data->regn_date),"d-m-Y")."</p>
                                    </td>
                                     <td style='padding:5px;'>
                                        <p>".$data->vechi_engine_num."</p>
                                    </td>
                                    <td style='padding:5px;'>
                                       <p> ".$data->vechi_chassis_num."</p>
                                    </td>
                                     <td style='padding:5px;'>
                                       <p>".$data->vechi_seating."</p>
                                    </td>
                                    <td style='padding:5px;'>
                                       <p>".$data->vechi_hypothecation."</p>
                                    </td>
                                </tr>
                      </table>
                     
                      <table style='width:100%;border-spacing: 0px;border-collapse: collapse;margin-top: -17px; !important' border='1'>
                                <tr>
                                    <td style='background-color:#094;width:40%;padding:5px;text-align: left;'> </td>
                                    <td style='background-color:#094;width:60%;color:#fff;padding:5px;text-align: left;'><p><b>".$quote_details->insurer." &nbsp; (".$quote_details->policy_term.")</b><p>
                                 </tr>
                                 
                                  <tr>
                                     <td style='padding:3px;text-align: left;background-color:#dff0d8;'>Insured Declared Value (IDV)</td>
                                     <td style='padding:3px;text-align: right;'></td>
                                 </tr>
                                 
                                 <tr>
                                     <td style='padding:3px;text-align: left;'>IDV</td>
                                     <td style='padding:3px;text-align: right;'>?".$quote_details->idv."</td>
                                 </tr>
                                 
                                 <tr>
                                     <td style='padding:3px;text-align: left;background-color:#dff0d8;'>Own Damage Premium</td>
                                     <td style='padding:3px;text-align: right;'></td>
                                 </tr>";
                                 
                                 if($quote_details->basic_od_amount != "")
                                 {
                                     $basic_own_damage_premium = "?".number_format($quote_details->basic_od_amount,2);
                                 }
                                 else
                                 {
                                     $basic_own_damage_premium = "-";
                                 }
                                 
                                 if($quote_details->total_od_premium != "")
                                 {
                                     $tot_od_premium = "?".number_format($quote_details->total_od_premium,2);
                                 }
                                 else
                                 {
                                     $tot_od_premium = "-";
                                 }
                                 
                                 if($quote_details->basic_tp != "")
                                 {
                                     $basic_tp_premium = "?".number_format($quote_details->basic_tp,2);
                                 }
                                 else
                                 {
                                     $basic_tp_premium = "-";
                                 }
                                 
                                 if($quote_details->owner_diver_amt != "")
                                 {
                                     $owner_driver_pa_cover = "?".number_format($quote_details->owner_diver_amt,2);
                                 }
                                 else
                                 {
                                     $owner_driver_pa_cover = "-";
                                 }
                                 
                                 if($quote_details->un_named_passenger_amt != "")
                                 {
                                     $un_named_passenger_pa_cover = "?".number_format($quote_details->un_named_passenger_amt,2);
                                 }
                                 else
                                 {
                                     $un_named_passenger_pa_cover = "-";
                                 }
                                 
                                 if($quote_details->llp_amt != "")
                                 {
                                     $llp_amt = "?".number_format($quote_details->llp_amt,2);
                                 }
                                 else
                                 {
                                     $llp_amt = "-";
                                 }
                                 
                                  if($quote_details->tot_tp_premium != "")
                                 {
                                     $tot_tp_premium = "?".number_format($quote_details->tot_tp_premium,2);
                                 }
                                 else
                                 {
                                     $tot_tp_premium = "-";
                                 }
                                 
                                 
                                 $net_premium = $quote_details->total_od_premium+$quote_details->tot_tp_premium;
                                 $gst_net_premium = $net_premium*18/100;
                                 $tot_policy_premium = $net_premium + $gst_net_premium;
                                 
                                 
                               $content .= "<tr>
                                     <td style='padding:3px;text-align: left;'>Basic Own Damage Premium</td>
                                     <td style='padding:3px;text-align: right;'>".$basic_own_damage_premium."</td>
                                 </tr>
                                  <tr>
                                     <td style='padding:3px;text-align: left;'>No claim Bonus</td>
                                     <td style='padding:3px;text-align: right;'>-</td>
                                 </tr>
                                 
                                  <tr>
                                     <td style='padding:3px;text-align: left;background-color:#094;color:#fff;'><b>Total Own Damage Premium (A)</b></td>
                                     <td style='padding:3px;text-align: right;background-color:#094;color:#fff;'><b>".$tot_od_premium."</b></td>
                                 </tr>
                                 
                                 <tr>
                                     <td style='padding:3px;text-align: left;background-color:#dff0d8;'><b>Third Party Premium</b></td>
                                     <td style='padding:3px;text-align: right;'></td>
                                 </tr>
                                 
                                  <tr>
                                     <td style='padding:3px;text-align: left;'>Basic Third Party Premium</td>
                                     <td style='padding:3px;text-align: right;'>".$basic_tp_premium."</td>
                                 </tr>
                                 
                                 <tr>
                                     <td style='padding:3px;text-align: left;'>Owner Driver PA Cover</td>
                                     <td style='padding:3px;text-align: right;'>".$owner_driver_pa_cover."</td>
                                 </tr>
                                 
                                 <tr>
                                     <td style='padding:3px;text-align: left;'>Unnamed Passenger PA Cover</td>
                                     <td style='padding:3px;text-align: right;'>".$un_named_passenger_pa_cover."</td>
                                 </tr>
                                 
                                 <tr>
                                     <td style='padding:3px;text-align: left;'>Legal Libility To Be Paid Drv / Emp</td>
                                     <td style='padding:3px;text-align: right;'>".$llp_amt."</td>
                                 </tr>
                                 
                                  <tr>
                                     <td style='padding:3px;text-align: left;background-color:#094;color:#fff;'><b>Total Third Party Premium (B)</b></td>
                                     <td style='padding:3px;text-align: right;background-color:#094;color:#fff;'><b>".$tot_tp_premium."</b></td>
                                 </tr>
                                 
                                 <tr>
                                     <td style='padding:3px;text-align: left;'>Net Premium (A+B)</td>
                                     <td style='padding:3px;text-align: right;'>?".number_format($net_premium,2)."</td>
                                 </tr>
                                 
                                  <tr>
                                     <td style='padding:3px;text-align: left;'>Gst (18%)</td>
                                     <td style='padding:3px;text-align: right;'>?".number_format($gst_net_premium,2)."</td>
                                 </tr>
                                 
                                 <tr>
                                     <td style='padding:3px;text-align: left;background-color:#094;color:#fff;'><b>".$quote_details->policy_co_cover_type." Policy premium</b></td>
                                     <td style='padding:3px;text-align: right;background-color:#094;color:#fff;'><b>?".number_format($tot_policy_premium,2)."</b></td>
                                 </tr>
                                 
                                 <tr>
                                     <td style='padding:3px;text-align: left;background-color:#dff0d8;'><b>Add On Covers premium</b></td>
                                     <td style='padding:3px;text-align: right;'></td>
                                 </tr>
                                 
                                  <tr>
                                     <td style='padding:3px;text-align: left;'>Add On Plan</td>
                                     <td style='padding:3px;text-align: center;'>".$quote_details->q_add_on_combo_premium."</td>
                                  </tr>";
                                  
                                  if($quote_details->q_add_on_plan_premium_amt != "")
                                  {
                                      $add_on_plan_premium = "?".number_format($quote_details->q_add_on_plan_premium_amt,2);
                                  }
                                  else
                                  {
                                      $add_on_plan_premium = "-";
                                  }
                                  
                                  if($quote_details->q_zero_depreciation_amt != "")
                                  {
                                       $zero_depreciation_amt = "?".number_format($quote_details->q_zero_depreciation_amt,2);
                                  }
                                  else
                                  {
                                      $zero_depreciation_amt = "-";
                                  }
                                  
                                  if($quote_details->q_addtional_addons_amt != "")
                                  {
                                       $q_addtional_addons_amt = "?".number_format($quote_details->q_addtional_addons_amt,2);
                                  }
                                  else
                                  {
                                      $q_addtional_addons_amt = "-";
                                  }
                                  
                                  if($quote_details->q_consumbles_amt != "")
                                  {
                                       $q_consumbles_amt = "?".number_format($quote_details->q_consumbles_amt,2);
                                  }
                                  else
                                  {
                                      $q_consumbles_amt = "-";
                                  }
                                  
                                  if($quote_details->q_tyre_cover_amt != "")
                                  {
                                       $q_tyre_cover_amt = "?".number_format($quote_details->q_tyre_cover_amt,2);
                                  }
                                  else
                                  {
                                      $q_tyre_cover_amt = "-";
                                  }
                                  
                                  if($quote_details->q_ncb_protection_amt != "")
                                  {
                                       $q_ncb_protection_amt = "?".number_format($quote_details->q_ncb_protection_amt,2);
                                  }
                                  else
                                  {
                                      $q_ncb_protection_amt = "-";
                                  }
                                  
                                  if($quote_details->q_engine_protector_amt != "")
                                  {
                                       $q_engine_protector_amt = "?".number_format($quote_details->q_engine_protector_amt,2);
                                  }
                                  else
                                  {
                                      $q_engine_protector_amt = "-";
                                  }
                                  
                                   if($quote_details->q_return_to_invoice_amt != "")
                                  {
                                       $q_return_to_invoice_amt = "?".number_format($quote_details->q_return_to_invoice_amt,2);
                                  }
                                  else
                                  {
                                      $q_return_to_invoice_amt = "-";
                                  }
                                  
                                  if($quote_details->key_replacement_amt != "")
                                  {
                                       $key_replacement_amt = "?".number_format($quote_details->key_replacement_amt,2);
                                  }
                                  else
                                  {
                                      $key_replacement_amt = "-";
                                  }
                                  
                                  if($quote_details->daily_allow_amt != "")
                                  {
                                       $daily_allow_amt = "?".number_format($quote_details->daily_allow_amt,2);
                                  }
                                  else
                                  {
                                      $daily_allow_amt = "-";
                                  }
                                  
                                  if($quote_details->loss_of_belong_amt != "")
                                  {
                                       $loss_of_belong_amt = "?".number_format($quote_details->loss_of_belong_amt,2);
                                  }
                                  else
                                  {
                                      $loss_of_belong_amt = "-";
                                  }
                                  
                                   if($quote_details->hotel_trvl_amt != "")
                                  {
                                       $hotel_trvl_amt = "?".number_format($quote_details->hotel_trvl_amt,2);
                                  }
                                  else
                                  {
                                      $hotel_trvl_amt = "-";
                                  }
                                  
                                  
                                  if($quote_details->wind_shield_amt != "")
                                  {
                                       $wind_shield_amt = "?".number_format($quote_details->wind_shield_amt,2);
                                  }
                                  else
                                  {
                                      $wind_shield_amt = "-";
                                  }
                                  
                                $content .="<tr>
                                     <td style='padding:3px;text-align: left;'>Add On Plan Premium</td>
                                     <td style='padding:3px;text-align: right;'>".$add_on_plan_premium."</td>
                                  </tr>
                                 </table>";
                                  
                             $content .="<table style='width:100%;border-spacing:0px;border-collapse:collapse;!important' border='1'>
                                <tr>
                                    <td style='background-color:#dff0d8;width:40%;padding:5px;text-align: left;'><b>Add On Plan Details</b> </td>
                                    <td style='background-color:#dff0d8;width:20%;padding:5px;text-align: center;'></td>
                                    <td style='background-color:#dff0d8;width:40%;padding:5px;text-align: center;'></td>
                                 </tr>
                                 
                                 <tr>
                                     <td style='padding:3px;text-align: left;'>Zero Depreciation</td>
                                     <td style='padding:3px;text-align: center;'>".$quote_details->q_zero_depreciation_check." </td>
                                     <td style='padding:3px;text-align: right;'>".$zero_depreciation_amt."  </td>
                                </tr>
                                
                                 <tr>
                                     <td style='padding:3px;text-align: left;'>RSA/Additional For Addons</td>
                                     <td style='padding:3px;text-align: center;'>".$quote_details->q_addtional_addons_check." </td>
                                     <td style='padding:3px;text-align: right;'>".$q_addtional_addons_amt."  </td>
                                </tr>
                                
                                 <tr>
                                     <td style='padding:3px;text-align: left;'>Consumbles</td>
                                     <td style='padding:3px;text-align: center;'>".$quote_details->q_consumbles_check." </td>
                                     <td style='padding:3px;text-align: right;'>".$q_consumbles_amt."  </td>
                                </tr>
                                
                                 <tr>
                                     <td style='padding:3px;text-align: left;'>Tyre Cover</td>
                                     <td style='padding:3px;text-align: center;'>".$quote_details->q_tyre_cover." </td>
                                     <td style='padding:3px;text-align: right;'>".$q_tyre_cover_amt."  </td>
                                </tr>
                                
                                <tr>
                                     <td style='padding:3px;text-align: left;'>NCB Protection</td>
                                     <td style='padding:3px;text-align: center;'>".$quote_details->q_ncb_protection_check." </td>
                                     <td style='padding:3px;text-align: right;'>".$q_ncb_protection_amt."  </td>
                                </tr>
                                
                                 <tr>
                                     <td style='padding:3px;text-align: left;'>Engine Protector</td>
                                     <td style='padding:3px;text-align: center;'>".$quote_details->q_engine_protector_check." </td>
                                     <td style='padding:3px;text-align: right;'>".$q_engine_protector_amt."  </td>
                                </tr>
                                
                                <tr>
                                     <td style='padding:3px;text-align: left;'>Return To Invoice</td>
                                     <td style='padding:3px;text-align: center;'>".$quote_details->q_return_to_invoice_check." </td>
                                     <td style='padding:3px;text-align: right;'>".$q_return_to_invoice_amt."  </td>
                                </tr>
                                
                                <tr>
                                     <td style='padding:3px;text-align: left;'>Key And Lock Replacement</td>
                                     <td style='padding:3px;text-align: center;'>".$quote_details->key_replacement_check." </td>
                                     <td style='padding:3px;text-align: right;'>".$key_replacement_amt."  </td>
                                </tr>
                                
                                 <tr>
                                     <td style='padding:3px;text-align: left;'>Daily/Inconvinience Allowance</td>
                                     <td style='padding:3px;text-align: center;'>".$quote_details->daily_allow_check." </td>
                                     <td style='padding:3px;text-align: right;'>".$daily_allow_amt."  </td>
                                </tr>
                                
                                 <tr>
                                     <td style='padding:3px;text-align: left;'>Loss of Personal Blonggies</td>
                                     <td style='padding:3px;text-align: center;'>".$quote_details->loss_of_belong_check." </td>
                                     <td style='padding:3px;text-align: right;'>".$loss_of_belong_amt."  </td>
                                </tr>
                                
                                 <tr>
                                     <td style='padding:3px;text-align: left;'>Loss of Hotel & Travel Expenses</td>
                                     <td style='padding:3px;text-align: center;'>".$quote_details->hotel_trvl_check." </td>
                                     <td style='padding:3px;text-align: right;'>".$hotel_trvl_amt."  </td>
                                </tr>
                                
                                <tr>
                                     <td style='padding:3px;text-align: left;'>Repair Glass Fiber Plastic </td>
                                     <td style='padding:3px;text-align: center;'>".$quote_details->wind_shield_check." </td>
                                     <td style='padding:3px;text-align: right;'>".$wind_shield_amt."  </td>
                                </tr>
                                
                                <tr>
                                     <td style='padding:3px;text-align: left;'>Zero Depreciation Allowed / Year </td>
                                     <td style='padding:3px;text-align: center;' colspan='2'>2</td>
                                </tr>
                                
                                 <tr>
                                     <td style='padding:3px;text-align: left;'><b>Total Add On Cover Premium (C) </b></td>
                                     <td style='padding:3px;text-align: right;' colspan='2'>?".number_format($quote_details->tot_add_on_cover_premium,2)." </td>
                                </tr>
                                
                                <tr>
                                     <td style='padding:3px;text-align: left;background-color:#094;color:#fff;'><b>Total Premium (A+B+C) </b></td>
                                     <td style='padding:3px;text-align: right;background-color:#094;color:#fff;' colspan='2'><b>?".$quote_details->total_premium."</b></td>
                                </tr>
                                
                                <tr>
                                     <td style='padding:3px;text-align: left;'>GST (18%)</td>
                                     <td style='padding:3px;text-align: right;' colspan='2'>?".$quote_details->gst." </td>
                                </tr>
                                
                                <tr>
                                     <td style='padding:3px;text-align: left;background-color:#094;color:#fff;'><b>Total Premium Payable</b></td>
                                     <td style='padding:3px;text-align: right;background-color:#094;color:#fff;' colspan='2'><b>?".$quote_details->total_payable."</b></td>
                                </tr>
                                 </table>";
    	                      $content .="<p style='padding:3px;'><b>Warm Regards,</b></p>
    	                      <p style='padding:3px;'>".$this->session->userdata('session_name')."</p>
    	                      <p style='padding:3px;'>Jayantha Insurance</p>
    	                      <p style='padding:3px;'>".$usr_details->phoneno.".</p>
    	                      <br>
    	                      <p style='padding:3px;text-align:center;'><i>".$company_info->address."</i></p>";
    	        //echo $content;
            	    $this->load->library('pdf');
                	$this->pdf->loadHtml($content);
                	$this->pdf->render();
                	$this->pdf->stream("Quotation".$id.".pdf", array("Attachment" => false));
    	    }
       }
       
       public function add_pet_details()
       {
            if($this->session->has_userdata('logged_in'))
    	    {
    	        $lead_id = $this->input->post("lead_id");
    	        $pet_gender = $this->input->post("pet_gender");
    	        $pet_name = $this->input->post("pet_name");
    	        $pet_age = $this->input->post("pet_age");
    	        $pet_height = $this->input->post("pet_height");
    	        $pet_weight = $this->input->post("pet_weight");
    	        
    	        $get_policy_type= $this->lm->get_policy_type_by_lead_id($lead_id);
    	       
    	       $data = array(  
    	                       "lead_id" => $lead_id,
                    	       "policy_type"=>$get_policy_type->policy_type,
                    	       "gender"=>$pet_gender,
                    	       "name"=>$pet_name,
                    	       "age_in_months"=>$pet_age,
                    	       "height_in_ft"=>$pet_height,
                    	       "weight_in_kg" =>$pet_weight,
                    	       "created_by"=>$this->session->userdata('session_id'),
    	       ); 
    	       
    	       $res = $this->lm->add_pet_details($data);
    	       if( $res ){
	                 $this->audit->log('pet_details', 'INSERT', null, null, $data);
	             }
    	       $array = $this->lm->get_pet_details($res);
    	       echo json_encode($array);
    	       
    	    }
       }
       
       public function get_pet_details()
       {
           if($this->session->has_userdata('logged_in'))
    	    {
    	        $lead_id = $this->input->post("lead_id");
    	        $array = $this->lm->get_pet_details_by_lead_id($lead_id);
    	        echo json_encode($array);
    	    }
       }
       
    public function add_home_property()
	{
	    if($this->session->has_userdata('logged_in'))
    	    {
    	        $lead_id = $this->input->post("lead_id");
        	     $house_type = $this->input->post("house_type");
        	     $owner_type = $this->input->post("owner_type");
        	     $home_policy_tenure = $this->input->post("home_policy_tenure");
        	     $home_age_premises = $this->input->post("home_age_premises");
        	     $home_name = $this->input->post("home_name");
        	     $home_mobile = $this->input->post("home_mobile");
        	     $home_property_value = $this->input->post("home_property_value");
        	     $home_sqft = $this->input->post("home_sqft");
        	     $home_infuli = $this->input->post("home_infuli");
        	     $home_dgairmac = $this->input->post("home_dgairmac");
        	   
        	     $get_policy_type= $this->lm->get_policy_type_by_lead_id($lead_id);
        	     
        	   $data = array(
        	       "lead_id" => $lead_id,
        	       "policy_type" => $get_policy_type->policy_type,
        	       "house_type" => $house_type,
        	       "owner_type" => $owner_type,
        	       "home_policy_tenure" => $home_policy_tenure,
        	       "home_age_premises" => $home_age_premises,
        	       "home_property_value" => $home_property_value,
        	       "home_sqft" => $home_sqft,
        	       "home_interior" => $home_infuli,
        	       "home_ac" => $home_dgairmac,
        	       "created_by" =>$this->session->userdata('session_id'),
        	       "created_at" => date("Y-m-d H:i:s"),
        	       );
        	       
        	   $res = $this->lm->add_home_details($data);
        	   if( $res ){
	                 $this->audit->log('home_details', 'INSERT', null, null, $data);
	             }
        	   $get_home_details = $this->lm->get_home_details($res);
        	   echo json_encode($get_home_details);
                
    	    }
	}
	
	public function add_business_details()
	{
	    if($this->session->has_userdata('logged_in'))
    	 {
    	 $lead_id = $this->input->post("lead_id");
	     $business_profession = $this->input->post("business_profession");
	     $business_owner_type = $this->input->post("business_owner_type");
	     $business_age_premises = $this->input->post("business_age_premises");
	     $business_property_value = $this->input->post("business_property_value");
	     $business_sqft = $this->input->post("business_sqft");
	     $business_infuli = $this->input->post("business_infuli");
	     $business_dgairmac = $this->input->post("business_dgairmac");
	   
	     $get_policy_type= $this->lm->get_policy_type_by_lead_id($lead_id);
	     
        	   $data = array(
        	       "lead_id" => $lead_id,
        	       "owner_type" =>$business_owner_type,
        	       "policy_type" => $get_policy_type->policy_type,
        	       "profession" => $business_profession,
        	       "business_age_premises" => $business_age_premises,
        	       "business_property_value" => $business_property_value,
        	       "business_sqft" => $business_sqft,
        	       "business_interior" => $business_infuli,
        	       "business_ac" => $business_dgairmac,
        	       "created_by" => $this->session->userdata('session_id'),
        	       "created_at" => date("Y-m-d H:i:s"),
        	       );
        	       
	            $res = $this->lm->add_business_details($data);
	            if( $res ){
	                 $this->audit->log('business_details', 'INSERT', null, null, $data);
	             }
	            $array = $this->lm->get_business_details($res);
	            
	            echo json_encode($array);
    	 }
	}
	
	public function get_business_details()
	{
	    if($this->session->has_userdata('logged_in'))
    	 {
    	     $lead_id = $this->input->post("lead_id");
    	     $res = $this->lm->get_business_details_by_lead_id($lead_id);
    	     echo json_encode($res);
    	 }
	}
	
	public function get_home_details()
	{
	     if($this->session->has_userdata('logged_in'))
    	 {
    	      $lead_id = $this->input->post("lead_id");
    	      $res = $this->lm->get_home_details_by_lead_id($lead_id);
    	      echo json_encode($res);
    	 }
	}
	
	public function commodity_change_load_sub_commodity()
	{
	     if($this->session->has_userdata('logged_in'))
    	 {
        	    $commodity = $this->input->post("commodity");
        	    $res = $this->lm->commodity_change_load_sub_commodity($commodity);
        	    $option = "<option value=''>Select Sub Commodity</option>";
        	    foreach($res as $r)
        	    {
        	        $option.="<option value='".$r->id."'>".$r->name."</option>";
        	    }
        	    echo $option;
        	}
	}
	
	public function marine_submit()
	{
	     if($this->session->has_userdata('logged_in'))
    	 {
    	         $lead_id = $this->input->post("lead_id");
        	     $marine_company_name = $this->input->post("marine_company_name");
        	     $marine_city_name = $this->input->post("marine_city_name");
        	     $marine_transport = $this->input->post("marine_transport");
        	     $marine_cummodity = $this->input->post("marine_cummodity");
        	     $marine_sub_cummodity = $this->input->post("marine_sub_cummodity");
        	     $marine_invoice_val = $this->input->post("marine_invoice_val");
        	     $marine_invoice_10per_val = $this->input->post("marine_invoice_10per_val");
        	     $marine_type = $this->input->post("marine_type");
        	    
        	   $arr = array(
        	       "lead_id" => $lead_id,
        	       "company_name" => $marine_company_name,
        	       "city_name" => $marine_city_name,
        	       "policy_type" => 24,
        	       "transport_mode" => $marine_transport,
        	       "commodity" => $marine_cummodity,
        	       "sub_commodity" => $marine_sub_cummodity,
        	       "invoice_value" => $marine_invoice_val,
        	       "sum_invoice" => $marine_invoice_10per_val,
        	       "type" => $marine_type,
        	       "created_by" => $this->session->userdata('session_id'),
        	       "created_at" => date("Y-m-d H:i:s"),
        	       );
        	       
        	   $res = $this->lm->add_marine_details($arr);
        	   if( $res ){
	                 $this->audit->log('marine_details', 'INSERT', null, null, $arr);
	             }
        	   $get_maraine_details = $this->lm->get_maraine_details($res);
        	   $commodity = $get_maraine_details->commodity;
        	   $sub_commodity = $this->lm->commodity_change_load_sub_commodity($commodity);
        	   $option = "";
        	    
        	    foreach($sub_commodity as $r)
        	    {
        	        $option.="<option value='".$r->id."'>".$r->name."</option>";
        	    }
        	   $datas =  array("maraine_details"=>$get_maraine_details,"sub_commodity" =>$option);
        	   echo json_encode($datas);
              
    	 }
	}
	
	public function get_maraine_details()
	{
	    if($this->session->has_userdata('logged_in'))
    	 {
    	       $lead_id = $this->input->post("lead_id");
    	       $get_maraine_details = $this->lm->get_maraine_details_by_lead_id($lead_id);
        	   $commodity = $get_maraine_details->commodity;
        	   $sub_commodity = $this->lm->commodity_change_load_sub_commodity($commodity);
        	   
        	   $option = "";
        	    
        	    foreach($sub_commodity as $r)
        	    {
        	        $option.="<option value='".$r->id."'>".$r->name."</option>";
        	    }
        	   $datas =  array("maraine_details"=>$get_maraine_details,"sub_commodity" =>$option);
        	   echo json_encode($datas);
    	 }
	}
	
	// policy 
	
	public function get_policy_type()
	{
	    if($this->session->has_userdata('logged_in'))
    	 {
    	     $lead_id = $this->input->post("lead_id");
    	     $res = $this->lm->get_policy_type($lead_id);
    	     echo json_encode($res);
    	 }
	}

    public function get_seating_capacity()
    {
        if ($this->session->has_userdata('logged_in')) {

            $lead_id = $this->input->post("lead_id");

            // ✅ 1. Get policy_type ID from list_of_leads
            $lead = $this->db->select('policy_type')
                            ->from('list_of_leads')
                            ->where('id', $lead_id)
                            ->get()
                            ->row();

            if ($lead && !empty($lead->policy_type)) {

                // ✅ 2. Fetch seating capacities from pcv_seating using that policy_type ID
                $result = $this->db->select('ps.id, ps.seating_capacity, lp.policy_type AS policy_name')
                                ->from('pcv_seating ps')
                                ->join('list_of_policy_type lp', 'lp.id = ps.policy_type', 'left')
                                ->where('ps.policy_type', $lead->policy_type)
                                ->get()
                                ->result();

                echo json_encode($result);
            } else {
                echo json_encode([]);
            }
        }
    }


	
	
	// Renewal //
	
	public function renewal()
	{
	    if($this->session->has_userdata('logged_in') && $this->session->userdata('session_role') == "admin") 
    	{    		
		   	$pro_data["project_info"] = $this->mm->fetch_project_info();
		   	$data["users"] = $this->lm->fetch_users();
		   	$data["agents_pos"] = $this->lm->fetch_agents_pos();
		   	$data["policy_type"] = $this->lm->fetch_list_of_policy_type_motor();
		   	$data["client_type"] = $this->lm->fetch_client_type();
		   	$data["business"] = $this->lm->fetch_business_type();
		   	$data["class"] = $this->lm->fetch_list_of_class();
		   	
    		$this->load->view('header',$pro_data);
    		$this->load->view('renewal',$data);
    		$this->load->view('footer',$pro_data);
	    }
	    else if($this->session->has_userdata('logged_in') && ($this->session->userdata('session_role') == "user" || $this->session->userdata('session_role') == "AI"))
	    {
	        $pro_data["project_info"] = $this->mm->fetch_project_info();
	        $data["agents_pos"] = $this->lm->fetch_agents_pos();
	        $data["users"] = $this->lm->fetch_users();
	        $data["client_type"] = $this->lm->fetch_client_type();
	        $data["business"] = $this->lm->fetch_business_type();
	        $data["class"] = $this->lm->fetch_list_of_class();
	        $data["policy_type"] = $this->lm->fetch_list_of_policy_type_motor();
    		$this->load->view('header',$pro_data);
    		$this->load->view('renewal',$data);
    		$this->load->view('footer',$pro_data);
	    }
	    else
	    {
	    	redirect("login");
	    }
	}
	
	
	public function get_client_details_by_lead_id()
	{
	    if($this->session->has_userdata('logged_in')) 
    	{
    	    $lead_id = $this->input->post("lead_id");
    	    $res = $this->lm->get_client_details_by_lead_id($lead_id);
    	    echo json_encode($res);
    	}
	}
	
	public function add_renewal_lead_details()
	{
	    if($this->session->has_userdata('logged_in')) 
    	{
    	    $lead_id = $this->input->post("lead_id");
    	    $get_client_id = $this->lm->get_client_id($lead_id);
	        $bussiness_type = $this->input->post("bussiness_type");
	        $class = $this->input->post("policy_class");
	        $policy_type = $this->input->post("policy_type");
	        $lead_generated_date =  $this->input->post("lead_generated_date");
	        $due_date =  $this->input->post("due_date");
	        $broken_policy =  $this->input->post("broken_policy");
	        $location=  $this->input->post("location");
	        $classification =  $this->input->post("classification");
	        $source =  $this->input->post("source");
	        $agent_pos = $this->input->post("agent_pos");
	        $assign_to_user =  $this->input->post("assign_to_user");
	        $remarks = $this->input->post("remarks");
	        $lead_created_by = $this->session->userdata('session_name');
	        $created_date = date("Y-m-d H:i:sa");
	        $updated_date = date("Y-m-d H:i:sa");
	        
	        $client_id = $get_client_id->client_id;
	        
	        $arr = array( 
    	             "client_id" =>$client_id,
    	             "business_type" =>$bussiness_type,
    	             "class"=>$class,
    	             "policy_type" => $policy_type,
    	             "lead_generated_date" => $lead_generated_date,
    	             "due_date" =>$due_date,
    	             "broken_policy" => $broken_policy,
    	             "location" =>$location,
    	             "classfication" =>$classification,
    	             "source"=>$source,
    	             "lead_status"=>"open",
    	             "agency_and_pos" => $agent_pos,
    	             "assigned_user" => $assign_to_user,
    	             "remarks" =>$remarks,
    	             "lead_created_by" =>$lead_created_by,
    	             "created_date"=>$created_date,
    	             "updated_date"=>$updated_date
    	             );
    	     $data_1 = $this->lm->add_lead_details($arr);
    	     if( $data_1 ) {
	            $this->audit->log('list_of_leads', 'INSERT', null, null, $arr);
	         }
    	     $date = date("Y-m-d");
    	     
    	     if($class == "1")
    	     {
    	         $res = $this->lm->add_motor_details($lead_id,$data_1,$date);
    	     }
    	     else if($class == "2")
    	     {
    	         $res = $this->lm->add_renew_health_details($lead_id,$data_1,$date);
    	     }
    	     else if($class == "4")
    	     {
    	         if($policy_type == "22")
    	         {
    	             $res = $this->lm->add_renew_health_details($lead_id,$data_1,$date);
    	         }
    	         else
    	         {
    	             $res = $this->lm->add_renew_business_details($lead_id,$data_1,$date);
    	         }
    	         
    	     }
    	     else if($class == "5")
    	     {
    	         $res = $this->lm->add_renew_maraine_details($lead_id,$data_1,$date);
    	     }
    	     else if($class == "4")
    	     {
    	         
    	     }
    	     
    	    $re_status = array("status"=>"1");
    	     
    	    $old_data = $this->lm->get_policy_data($lead_id);
    	    $renewal_status = $this->lm->update_renewal_status($re_status,$lead_id);
    	     if($renewal_status){
                 $this->audit->log('policy_info', 'UPDATE', null, $old_data, $re_status);
             }
    	   echo "success";
    	}
	}
	
	
	// lead details 
	
	public function view_lead_details()
	{
	    if($this->session->has_userdata('logged_in')) 
    	{
    	    $lead_id = $this->input->post("id");
    	    $res = $this->lm->view_lead_details($lead_id);
    	    $data = $this->lm->get_vechicle_details($lead_id);
    	    $client_id = $res->client_id;
    	    $get_leads_id = $this->lm->get_leads_id($client_id);
    	    
    	    
            $html = "";
            $content_1 = "";
            $v_info = [];
            

            if($data != null)
            {
                if($data->policy_type == "1" || $data->policy_type == "3")
                {
                  $v_info = $this->lm->get_car_details($lead_id);  
                }
                else if($data->policy_type == "2" || $data->policy_type == "4")
                {
                    $v_info = $this->lm->get_bike_details($lead_id);  
                }
                else if($data->policy_type == "7" || $data->policy_type == "12" || $data->policy_type == "13" || $data->policy_type == "14" || $data->policy_type == "59" || $data->policy_type == "60" || $data->policy_type == "65" || $data->policy_type == "66" || $data->policy_type == "68" || $data->policy_type == "69" || $data->policy_type == "70")
                {
                	$v_info = $this->lm->get_pc_details($lead_id,$data->policy_type);
                }
                else if($data->policy_type == "8" || $data->policy_type == "9" || $data->policy_type == "10" || $data->policy_type == "15" || $data->policy_type == "16" || $data->policy_type == "61")
                {
                	$v_info = $this->lm->get_gc_details($lead_id,$data->policy_type);
                }
                else if($data->policy_type == "20")
                {
                	$v_info = $this->lm->fetch_make_misc($lead_id);
                }
                else if($data->policy_type == "55")
                {
                	$v_info = $this->lm->fetch_make_scooter($lead_id);
                }
                else if($data->policy_type == "18")
                {
                    $v_info = $this->lm->fetch_make_ambulance($lead_id);
                }
            }
            
            if($res->class == "1")
            {
                $html .="<h4 style='color:#2196f3;font-family: system-ui;'><u>Vehicle Documents</u></h4><div class='row'>";
            
                foreach($get_leads_id as $da)
                {
                      $documents = $this->lm->get_vechile_documents($da->id);
                      
                      foreach($documents as $doc)
                      {
                          $html .= "<div class='col-md-3'><div class='form-group'><a href='./datas/documents/".$doc->document_file."' target='_blank'><i class='fa fa-file-pdf-o' style='font-size:48px;color:red'></i></a></div></div>";
                      }
                }
                $html .="</div>";
            }
            else if($res->class == "10")
            {
                $content_1 .="<h4 style='color:#2196f3;font-family: system-ui;'><u>Policy Quotations</u></h4><div class='row'>";
                
                foreach($get_leads_id as $da)
                {
                      $documents = $this->lm->fetch_quote_files($da->id);
                      
                      foreach($documents as $doc)
                      {
                          $content_1 .= "<div class='col-md-3'><div class='form-group'><a href='./datas/documents/".$doc->file."' target='_blank'><i class='fa fa-file-pdf-o' style='font-size:48px;color:red'></i></a></div><span>&nbsp;".$doc->file_name."</span></div>";
                      }
                }
                
                $content_1 .="</div>";
            }
            
            $content = "";
            
            
            if($res->lead_type == "2")
            {
                $policy_info = $this->lm->get_policy_informations($lead_id);
            }
            else
            {
                $policy_info = $this->lm->get_temp_policy_informations($lead_id);
            }
            
            
            $content .="<div class='row'>";
            
            foreach($policy_info as $p)
            {
                $content .="<h4 style='color:#2196f3;font-family: system-ui;margin-left:15px;'><u>Policy Details - ".$p->business_name." </u></h4><div class='col-md-6'>
                             <div class='row'>
                                   <div class='col-md-4'>
                                    <label>Policy No  </label>
                                    </div>
                                    <div class='col-md-1'> :
                                    </div>
                                   <div class='col-md-7'>
                                       <p>".$p->policy_no."</p>
                                   </div>
                                 </div>
                               </div>
                               
            	               <div class='col-md-6'>
                	               <div class='row'>
                                       <div class='col-md-4'>
            	                          <label>Insurer Name</label>
            	                        </div>
            	                        <div class='col-md-1'> :</div>
                                   <div class='col-md-7'>
                                    <p>".$p->company_name."</p>
                                  </div>
                                 </div>
                               </div>
                               
                               <div class='col-md-6'>
                	               <div class='row'>
                                       <div class='col-md-4'>
                                          <label>Business Type</label>
                                      </div>
            	                        <div class='col-md-1'> :</div>
                	                   <div class='col-md-7'>
            	                          <p>".$p->business_name."</p>
            	                      </div>
                                 </div>
                               </div>
                               
                               
                               <div class='col-md-6'>
                	               <div class='row'>
                                       <div class='col-md-4'>
                                          <label>Premium Cover</label>
                                      </div>
            	                        <div class='col-md-1'> :</div>
                	                   <div class='col-md-7'>
            	                          <p>".$p->policy_premium_name."</p>
            	                      </div>
                                 </div>
                             </div>
                    
                               <div class='col-md-6'>
                	               <div class='row'>
                                       <div class='col-md-4'>
                                         <label>Class</label>
                                        </div>
                                         <div class='col-md-1'> :</div>
            	                    <div class='col-md-7'>
                                    <p>".$p->class_name."</p>
                                   </div>
                                 </div>
                               </div>
                               
                              <div class='col-md-6'>
                	               <div class='row'>
                                       <div class='col-md-4'>
                                            <label>Policy Type</label>
                                       </div>
                                      <div class='col-md-1'> :</div>
            	                    <div class='col-md-7'>
                                       <p>".$p->policy_type."</p>
                                    </div>
                                 </div>
                               </div>
                               
                               
                               <div class='col-md-6'>
                	               <div class='row'>
                                       <div class='col-md-4'>
                                          <label>Policy Start Date</label>
                                         </div>
                                     <div class='col-md-1'> :</div>
            	                       <div class='col-md-7'>
                                         <p>".date_format(date_create($p->policy_s_date),"d-M-Y")."</p>
                                  </div>
                                 </div>
                               </div>
                               
                               <div class='col-md-6'>
                	               <div class='row'>
                                       <div class='col-md-4'>
                                          <label>Policy Exp Date</label>
                                         </div>
                                     <div class='col-md-1'> :</div>
            	                       <div class='col-md-7'>
                                         <p>".date_format(date_create($p->policy_ex_date),"d-M-Y")."</p>
                                  </div>
                                 </div>
                               </div>
                               
                                <div class='col-md-6'>
                	               <div class='row'>
                                       <div class='col-md-4'>
                                          <label>Sum Insured</label>
                                         </div>
                                     <div class='col-md-1'> :</div>
            	                       <div class='col-md-7'>
                                         <p>".number_format($p->sum_insured,2)."</p>
                                  </div>
                                 </div>
                               </div>";
                               
                                  if($res->class == "1")
            	                   {
                    	                   $content .="<div class='col-md-6'>
                                	               <div class='row'>
                        	                           <div class='col-md-4'>
                        	                              <label>Total Own Damage</label>
                        	                             </div>
                        	                         <div class='col-md-1'> :</div>
                                	                   <div class='col-md-7'>
                            	                        <p>".number_format($p->total_own_damage,2)."</p>
                            	                       </div>
                        	                     </div>
                    	                       </div>
                    	                       
                    	                            
                    	                    <div class='col-md-6'>
                            	               <div class='row'>
                    	                           <div class='col-md-4'>
                    	                              <label>Total Tp</label>
                    	                           </div>
                    	                        <div class='col-md-1'> :</div>
                        	                       <div class='col-md-7'>
                    	                        <p>".number_format($p->basic_tp,2)."</p>
                    	                       </div>
                    	                     </div>
                	                       </div>";
            	                       }
                               
                    $content .=" <div class='col-md-6'>
                	               <div class='row'>
                                       <div class='col-md-4'>
                                           <label>Net Premium </label>
                                        </div>
                                    <div class='col-md-1'> :</div>
            	                       <div class='col-md-7'>
                                    <p>".number_format($p->total_premium,2)."</p>
                                  </div>
                                 </div>
                               </div>
                               
                               <div class='col-md-6'>
                	               <div class='row'>
                                     <div class='col-md-4'>
                                         <label>GST</label>
                                    </div>
                                    <div class='col-md-1'> :</div>
            	                       <div class='col-md-7'>
                                    <p>".number_format($p->gst,2)."</p>
                                   </div>
                                 </div>
                               </div>
                               
                               <div class='col-md-6'>
                	               <div class='row'>
                                     <div class='col-md-4'>
                                         <label>Agent/ Pos Code </label>
                                    </div>
                                    <div class='col-md-1'> :</div>
            	                       <div class='col-md-7'>
                                    <p>".$p->agent_pos_code."</p>
                                   </div>
                                 </div>
                               </div>
                               <hr/>";
            }
            
             $content .="</div>";
             
            $policy_docs ="<h4 style='color:#2196f3;font-family: system-ui;'><u>Policy Documents</u></h4>";
            
            $policy_docs .="<div class='row'>";
            
                  $documents = $this->lm->get_policy_documents($lead_id);
                  
                  foreach($documents as $doc)
                  {
                      $policy_docs .= "<div class='col-md-3'><div class='form-group'><a href='./datas/documents/".$doc->document."' target='_blank'><i class='fa fa-file-pdf-o' style='font-size:48px;color:red'></i></a></div></div>";
                  }
            $policy_docs .="</div>";
            echo json_encode(array("p_info"=>$res,"v_info" =>$v_info,"docs"=>$html,"sme_quote" =>$content_1,"policy_info"=>$content,"policy_docs" =>$policy_docs));
    	}
	}
	
	
	  public function check_commission_status()
      {
            if($this->session->has_userdata('logged_in')) 
        	{
        	    $check_user_i = $this->mm->fetch_user_permissions($this->session->userdata('session_id'));
        	     
        	    if($check_user_i->policy_add == "1")
    	        {   
                    $policy_no = $this->input->post("policy_no");
                    $policy_source = $this->input->post("policy_source");
                    $policy_issue_date = $this->input->post("policy_issue_date");
                    $lead_created_by = $this->session->userdata('session_name');
                    $policy_premium= $this->input->post("policy_premium");
                    $policy_agency_pos = $this->input->post("policy_agency_pos");
                    $company = $this->input->post("company");
                    $total_premium =$this->input->post("total_premium");
                    $lead_id = $this->input->post("lead_id");
                    
                    $rto = "";
                    $age = "";
                    $lead_id = $this->input->post("lead_id");
                    $class_type = $this->lm->get_class_type($lead_id);
                    
                    $from_date_1 = $policy_issue_date;//date_format(date_create($policy_issue_date),"01-m-Y");
                    $to_date_1 = date_format(date_create($from_date_1),"t-m-Y");
                            
                   
                   if($class_type->class == "1")
                   {
                            $get_lead_info = $this->lm->get_lead_info($lead_id);
                            $bussiness_type = $get_lead_info->business_type;
                            $policy_class = $get_lead_info->class;
                            $policy_type =  $get_lead_info->policy_type;
                            $state = $get_lead_info->state;
                            $rto = $get_lead_info->rto;
                            $regndate =$get_lead_info->regn_date;
                            $today = date("Y-m-d");
                            $diff = date_diff(date_create($regndate), date_create($today));
                            
                            //$age = $diff->format('%y');
                            $_vechage = $this->lm->getVechicleAge($lead_id, $policy_issue_date);
                            $age = $_vechage->age;
                            
                            $fuel_type = $get_lead_info->vechi_fuel_type;
                            $cc  = $get_lead_info->vechi_cc;
                            $v_gvw = $get_lead_info->vechi_gvw;
                            $v_seating = $get_lead_info->passenger_carrying;
                            $make = $get_lead_info->vechi_make;
                            $model = $get_lead_info->vechi_model;
                            $Varient = $get_lead_info->vechi_varient;
                            
                           
                            $commission_id = [];
                            
                            $status = "0";
                            $make_status = "0";
                            $model_status = "0";
                            $varient_status = "0";
                            $rto_status = "0";
                            $gvw_status = "0";
                            $fuel_status = "0";
                            $state_status = "0";
                            $fuel_type_status = "0";
                            
                            $data1 = array("status" =>"Commission Slab Not Exits","commission_id"=>"");
                            
                            $check = $this->cm->check_commission($company,$policy_premium,$policy_class,$bussiness_type,$policy_type,$state,$from_date_1,$to_date_1);
                 
                           
                             
                            foreach($check as $da)
                            {
                                if($da->commission_type == "2")
                                {
                                    foreach($check as $da)
                                	{
                                            $temp_min = $da->vehicle_age_min;
                                            $temp_max = $da->vehicle_age_max;
                                            $g_status = "0";
                                            $fuel_status = "0";
                            		    
                                    	    if($temp_min <= $age && $temp_max >= $age)
                                    		{
                                    			$g_status = "1";
                                    		}
                                    		
                                            if($fuel_type == "1")
                                            {
                                            	if($da->fuel_type == "4" || $da->fuel_type == "5" || $da->fuel_type == "1" || $da->fuel_type == "6")
                                            	{
                                            	    $fuel_status = "1";
                                            	}
                                            }
                                            if($fuel_type == "2")
                                            {
                                                if($da->fuel_type == "5" || $da->fuel_type == "2" || $da->fuel_type == "6")
                                            	{
                                            	    $fuel_status = "1";
                                            	}
                                            }
                                            if($fuel_type == "5")
                                            {
                                                if($da->fuel_type == "5" || $da->fuel_type == "1" || $da->fuel_type == "2" || $da->fuel_type == "6")
                                            	{
                                            	    $fuel_status = "1";
                                            	}
                                            }
                                            if($fuel_type == "6")
                                            {
                                                if($da->fuel_type == "1" || $da->fuel_type == "2" || $da->fuel_type == "3" || $da->fuel_type == "4" || $da->fuel_type == "5" || $da->fuel_type == "6")
                                            	{
                                            	    $fuel_status = "1";
                                            	}
                                            }
                                            if($fuel_type == "7")
                                            {
                                                if($da->fuel_type == "7" || $da->fuel_type == "6")
                                            	{
                                            	    $fuel_status = "1";
                                            	}
                                            }
                                		 
                                		 
                                			if($g_status == "1" && $fuel_status == "1")
                                			{
                                			    $commission_id[] = $da->id;
                                			    $status = "1";
                                                $fuel_type_status = "1";
                                			}
                            	      }
                            	      

                                    if($status == "1")
                                    {
                                        $check_state = $this->cm->check_state_by_commission_id(array_unique($commission_id));
                                    
                                        $commission_id = [];
                                        
                                        foreach($check_state as $da)
                                        {
                                            if($da->state == $state)
                                            {
                                                 $commission_id[] = $da->id;
                                                 $state_status = "1";
                                            }
                                            else if($da->state == "All")
                                            {
                                                $commission_id[] = $da->id;
                                                $state_status = "1";
                                            }
                                       }
                                       

                                         if($state_status == "1")
                                         {
                                            $classification = $this->cm->check_classification_by_commission_id(array_unique($commission_id));
                                            
                                            $temp_commission_id = [];
                                            $temp_commission_id = $commission_id;
                                            $commission_id = [];
                                           
                                            foreach($classification as $cl)
                                            {
                                                
                                                if($policy_type == "7" || $policy_type == "12" || $policy_type == "13" || $policy_type == "14" || $policy_type == "59" || $policy_type == "60" || $policy_type == "65" || $policy_type == "66" || $policy_type == "67" || $policy_type == "68" || $policy_type == "69" || $policy_type == "70")
                                                {
                                                    if($cl->classification != "")
                                                    {
                                                       $classification = $this->cm->check_seating($v_seating,$policy_type,$temp_commission_id);
                                                      
                                                        if(count($classification) > 0)
                                                        {
                                                            $gvw_status = "1";
                                                            foreach($classification as $da)
                                                            {
                                                                $commission_id[] = $cl->id;
                                                                $gvw_status = "1";
                                                            }
                                                        }
                                                    }
                                                    else
                                                    {
                                                        $commission_id = $temp_commission_id;
                                                        $gvw_status = "1";
                                                    }
                                                }
                                                else if($policy_type == "1" || $policy_type == "2" || $policy_type == "3" || $policy_type == "4" || $policy_type == "55")
                                                {
                                                    if($cl->classification != "")
                                                    {
                                                        $classification = $this->lm->get_classification($cl->classification,$policy_type);
                                                     
                                                        if($classification != null || $classification != "")
                                                        {
                                                             $temp_min = $classification->from_gvw_cc;
                                                             $temp_max = $classification->to_gvw_cc;

                                                             if(($cc >= $temp_min && $cc <= $temp_max))
                                                             {
                                                                 $commission_id[] = $cl->id;
                                                                 $gvw_status = "1";
                                                             }
                                                        }
                                                    }
                                                    else
                                                    {
                                                        $gvw_status = "1";
                                                        $commission_id = $temp_commission_id;
                                                    }
                                                }
                                                else
                                                {
                                                    if($cl->classification != "")
                                                    {
                                                        $classification = $this->lm->get_classification($cl->classification,$policy_type);
                                                        
                                                      
                                                        if($classification != null)
                                                        {
                                                            $temp_min = $classification->from_gvw_cc;
                                                            $temp_max = $classification->to_gvw_cc;

                                                            if($v_gvw >= $temp_min && $v_gvw <= $temp_max)
                                                            {

                                                                $gvw_status = "1";
                                                                $commission_id[] = $cl->id;
                                                                
                                                            }
                                                        }
                                                    }
                                                    else
                                                    {
                                                        $gvw_status = "1";
                                                        $commission_id = $temp_commission_id;
                                                    }
                                                }
                                            }
                                            
                                           $check_make_1 = $this->cm->check_make_already_exits(array_unique($commission_id),$policy_type,$make);
                                            
                                            if(count($check_make_1) > 0)
                                            {
                                                    if(count($check_make_1) > 0)
                                                    {
                                                        $commission_id = [];
                                                        
                                                        foreach($check_make_1 as $da)
                                                        {
                                                             $commission_id[] = $da->commission_id;
                                                        }
                                                        $status = "1";
                                                        $make_status = "1";
                                                    }
                                                    else
                                                    {
                                                        $make_status = "0";
                                                    }
                                            }
                                            else
                                            {
                                                $check_make = $this->lm->check_make_all_already_exits(array_unique($commission_id),$policy_type);
                                                
                                                if(count($check_make) > 0)
                                                {
                                                    $commission_id = [];
                                                    
                                                    foreach($check_make as $da)
                                                    {
                                                      $commission_id[] = $da->id;
                                                    }
                                                    
                                                    $status = "1";
                                                    $make_status = "1";
                                                }
                                            }

                                            $check_model_1 = $this->lm->check_model_already_exits(array_unique($commission_id),$policy_type,$make,$model);
                                             
                                            if(count($check_model_1) > 0)
                                            {
                                                $commission_id = [];
                                                
                                                foreach($check_model_1 as $da)
                                                {
                                                   $commission_id[] = $da->commission_id;
                                                }
                                                
                                                $status = "1";
                                                $model_status = "1";
                                            }
                                            else
                                            {
                                                $check_model = $this->pm->check_model_all_already_exits(array_unique($commission_id),$policy_type);
                                                if(count($check_model) > 0)
                                                {
                                                        $commission_id = [];
                                                        foreach($check_model as $da)
                                                        {
                                                             $commission_id[] = $da->id;
                                                        }
                                                     $status = "1";
                                                     $model_status = "1";
                                                }
                                            }
                                            
                                            if($make_status == "1" && $model_status == "1")
                                            {
                                                $check_varient_1 = $this->cm->check_varient_already_exits(array_unique($commission_id),$policy_type,$make,$model,$Varient);
                                               
                                                if(count($check_varient_1) > 0) 
                                                {
                                                    $commission_id = [];
                                                    foreach($check_varient_1 as $da)
                                                    {
                                                      $commission_id[] = $da->commission_id;
                                                    }
                                                    $status = "1";
                                                    $varient_status = "1";
                                                }
                                                else
                                                {
                                                    $check_varient = $this->pm->check_varient_all_already_exits(array_unique($commission_id),$policy_type);
                                                    if(count($check_varient) > 0)
                                                    {
                                                        $commission_id = [];
                                                        
                                                        foreach($check_varient as $da)
                                                        {
                                                             $commission_id[] = $da->id;
                                                        }
                                                         $status = "1";
                                            	         $varient_status = "1";
                                                    }
                                                }
                                            }
                                            

                                            if($status == "1" && $state_status == "1" && $fuel_type_status == "1" && $gvw_status == "1" && $make_status == "1" && $model_status == "1" && $varient_status == "1")
                                            {
                                                 $check_rto = $this->cm->check_rto_already_exits_2(array_unique($commission_id),$rto);
                                                 
                                        
                                                  
                                                    if(count($check_rto) > 0)
                                                    {
                                                        foreach($check_rto as $rt)
                                                        {
                                                            $com_id = $rt->commission_id;
                                                        }
                                                      
                                                        if(!$this->cm->check_policy_already_exits($lead_id))
                                                        {
                                                            if(!$this->cm->check_policy_no_already_exits($policy_no))
                                                            {
                                                                 $data1 = array("status" =>"success" ,"commission_id"=>$com_id);
                                                            }
                                                            else
                                                            {
                                                                $data1 = array("status" =>"Policy Already Exits","commission_id"=>"");
                                                            }
                                                        }
                                                        else
                                                        {
                                                            $data1 = array("status" =>"Policy Already Exits","commission_id"=>"");
                                                        }
                                                    }
                                                    else
                                                    {
                                                        $data1 = array("status" =>"RTO Mismatched","commission_id"=>"");
                                                    }
                                             }
                                            else if($state_status == "0")
                                            {
                                                $data1 = array("status" =>"State Mismacthed","commission_id"=>"");
                                            }
                                            else if($fuel_type_status == "0")
                                            {
                                                $data1 = array("status" =>"Fuel Type Mismacthed","commission_id"=>"");
                                            }
                                            else if($gvw_status == "0")
                                            {
                                                $data1 = array("status" =>"Classification Mismatched","commission_id"=>"");
                                            }
                                            else if($make_status == "0")
                                            {
                                                 $data1 = array("status" =>"Make Mismactched","commission_id"=>"");
                                            }
                                            else if($model_status == "0")
                                            {
                                                 $data1 = array("status" =>"Model Mismactched","commission_id"=>"");
                                            }
                                            else if($varient_status == "0")
                                            {
                                                 $data1 = array("status" =>"Varient Mismactched","commission_id"=>"");
                                            }
                                        }
                                         else
                                         {
                                             $data1 = array("status" =>"State Mismacthed","commission_id"=>"");
                                         }
                                     }
                                    else
                                    {
                                         $data1 = array("status" =>"Insurance company or Slab or Fuel Type Mismacthed","commission_id"=>"");
                                     }
                                 }
                                else if($da->commission_type == "1")
                                {
                                    $g_status = "0";
                                    $fuel_status = "0";
                                    
                                    foreach($check as $da)
                                	{
                                        $temp_min = $da->no_policy_min;
                                        $temp_max = $da->no_policy_max;
                                        

                                        if($temp_min <= 1 && $temp_max >= 1)
                                        {
                                             $g_status = "1";
                                             $commission_id[] = $da->id;
                                        }

                                        
                                        if($fuel_type == "1")
                                        {
                                        	if($da->fuel_type == "4" || $da->fuel_type == "5" || $da->fuel_type == "1" || $da->fuel_type == "6")
                                        	{
                                        	    $fuel_status = "1";
                                        	}
                                        }
                                        

                                        if($fuel_type == "2")
                                        {
                                            if($da->fuel_type == "5" || $da->fuel_type == "2" || $da->fuel_type == "6")
                                        	{
                                        	    $fuel_status = "1";
                                        	}
                                        }
                                        
                                        if($fuel_type == "5")
                                        {
                                            if($da->fuel_type == "5" || $da->fuel_type == "1" || $da->fuel_type == "2" || $da->fuel_type == "6")
                                        	{
                                        	    $fuel_status = "1";
                                        	}
                                        }
                                        
                                        if($fuel_type == "6")
                                        {
                                            if($da->fuel_type == "1" || $da->fuel_type == "2" || $da->fuel_type == "3" || $da->fuel_type == "4" || $da->fuel_type == "5" || $da->fuel_type == "6")
                                        	{
                                        	    $fuel_status = "1";
                                        	}
                                        }
                                        
                                        if($fuel_type == "7")
                                        {
                                            if($da->fuel_type == "7" || $da->fuel_type == "6")
                                        	{
                                        	    $fuel_status = "1";
                                        	}
                                        }
                            		   
                            			if($g_status == "1" && $fuel_status == "1")
                            			{
                            			    $commission_id[] = $da->id;
                            			    $status = "1";
                                            $fuel_type_status = "1";
                            			}
                                	}
                                	
                              
                                	

                                    if($status == "1")
                                    {
                                        $check_state = $this->cm->check_state_by_commission_id(array_unique($commission_id));
                                        
                                        $commission_id = [];
                                        
                                        foreach($check_state as $da)
                                        {
                                            if($da->state == $state)
                                            {
                                                 $commission_id[] = $da->id;
                                                 $state_status = "1";
                                            }
                                            else if($da->state == "All")
                                            {
                                                $commission_id[] = $da->id;
                                                $state_status = "1";
                                            }
                                        }
                                        
                                        if($state_status == "1")
                                        {
                                            $classification = $this->cm->check_classification_by_commission_id(array_unique($commission_id));
                                            $temp_commission_id = [];
                                            $temp_commission_id = $commission_id;
                                            $commission_id = [];
                                        
                                            foreach($classification as $cl)
                                            {
                                                if($policy_type == "7" || $policy_type == "12" || $policy_type == "13" || $policy_type == "14" || $policy_type == "59" || $policy_type == "60" || $policy_type == "65" || $policy_type == "66" || $policy_type == "67" || $policy_type == "68" || $policy_type == "69" || $policy_type == "70")
                                                {
                                                    if($cl->classification != "")
                                                    {
                                                       $classification = $this->cm->check_seating($v_seating,$policy_type,$temp_commission_id);
                                                       
                                                        if(count($classification) > 0)
                                                        {
                                                            $gvw_status = "1";
                                                            
                                                            foreach($classification as $da)
                                                            {
                                                                $commission_id[] = $cl->id;
                                                                $gvw_status = "1";
                                                            }
                                                        }
                                                    }
                                                    else
                                                    {
                                                        $commission_id = $temp_commission_id;
                                                        $gvw_status = "1";
                                                    }
                                                }
                                                else if($policy_type == "1" || $policy_type == "2" || $policy_type == "3" || $policy_type == "4" || $policy_type == "55")
                                                {
                                                    if($cl->classification != "")
                                                    {
                                                        $classification = $this->lm->get_classification($cl->classification,$policy_type);
                                                     
                                                        if($classification != null)
                                                        {
                                                             $temp_min = $classification->from_gvw_cc;
                                                             $temp_max = $classification->to_gvw_cc;
                                                             
                                                             if(($cc >= $temp_min && $cc <= $temp_max))
                                                             {
                                                                 $commission_id[] = $cl->id;
                                                                 $gvw_status = "1";
                                                             }
                                                        }
                                                    }
                                                    else
                                                    {
                                                        $gvw_status = "1";
                                                        $commission_id = $temp_commission_id;
                                                    }
                                                }
                                                else
                                                {
                                                    if($cl->classification != "")
                                                    {
                                                        $classification = $this->lm->get_classification($cl->classification,$policy_type);
                                                      
                                                        if($classification != null)
                                                        {
                                                            $temp_min = $classification->from_gvw_cc;
                                                            $temp_max = $classification->to_gvw_cc;
                                                            
                                                            if($v_gvw >= $temp_min && $v_gvw <= $temp_max)
                                                            {
                                                                $gvw_status = "1";
                                                                $commission_id[] = $cl->id;
                                                            }
                                                        }
                                                    }
                                                    else
                                                    {
                                                        $gvw_status = "1";
                                                        $commission_id = $temp_commission_id;
                                                    }
                                                }
                                            }
                                        
                                            $check_make_1 = $this->cm->check_make_already_exits(array_unique($commission_id),$policy_type,$make);
                                            
                                            if(count($check_make_1) > 0)
                                            {
                                                    if(count($check_make_1) > 0)
                                                    {
                                                        $commission_id = [];
                                                        
                                                        foreach($check_make_1 as $da)
                                                        {
                                                             $commission_id[] = $da->commission_id;
                                                        }
                                                        $status = "1";
                                                        $make_status = "1";
                                                    }
                                                    else
                                                    {
                                                        $make_status = "0";
                                                    }
                                            }
                                            else
                                            {
                                                $check_make = $this->lm->check_make_all_already_exits(array_unique($commission_id),$policy_type);
                                                
                                                if(count($check_make) > 0)
                                                {
                                                    $commission_id = [];
                                                    
                                                    foreach($check_make as $da)
                                                    {
                                                      $commission_id[] = $da->id;
                                                    }
                                                    
                                                    $status = "1";
                                                    $make_status = "1";
                                                }
                                            }

                                            $check_model_1 = $this->lm->check_model_already_exits(array_unique($commission_id),$policy_type,$make,$model);
                                             
                                            if(count($check_model_1) > 0)
                                            {
                                                $commission_id = [];
                                                
                                                foreach($check_model_1 as $da)
                                                {
                                                   $commission_id[] = $da->commission_id;
                                                }
                                                
                                                $status = "1";
                                                $model_status = "1";
                                            }
                                            else
                                            {
                                                $check_model = $this->pm->check_model_all_already_exits(array_unique($commission_id),$policy_type);
                                                if(count($check_model) > 0)
                                                {
                                                        $commission_id = [];
                                                        foreach($check_model as $da)
                                                        {
                                                             $commission_id[] = $da->id;
                                                        }
                                                     $status = "1";
                                                     $model_status = "1";
                                                }
                                            }
                                            
                                            if($make_status == "1" && $model_status == "1")
                                            {
                                                $check_varient_1 = $this->cm->check_varient_already_exits(array_unique($commission_id),$policy_type,$make,$model,$Varient);
                                               
                                                if(count($check_varient_1) > 0) 
                                                {
                                                    $commission_id = [];
                                                    foreach($check_varient_1 as $da)
                                                    {
                                                      $commission_id[] = $da->commission_id;
                                                    }
                                                    $status = "1";
                                                    $varient_status = "1";
                                                }
                                                else
                                                {
                                                    $check_varient = $this->pm->check_varient_all_already_exits(array_unique($commission_id),$policy_type);
                                                    if(count($check_varient) > 0)
                                                    {
                                                        $commission_id = [];
                                                        
                                                        foreach($check_varient as $da)
                                                        {
                                                             $commission_id[] = $da->id;
                                                        }
                                                         $status = "1";
                                            	         $varient_status = "1";
                                                    }
                                                }
                                            }
                                
                                            if($status == "1" && $state_status == "1" && $fuel_type_status == "1" && $gvw_status == "1" && $make_status == "1" && $model_status == "1" && $varient_status == "1")
                                            {
                                                 $check_rto = $this->cm->check_rto_already_exits_2(array_unique($commission_id),$rto);
                                                 
                                                    if(count($check_rto) > 0)
                                                    {
                                                        foreach($check_rto as $rt)
                                                        {
                                                            $com_id = $rt->commission_id;
                                                        }
                                                        if(!$this->cm->check_policy_already_exits($lead_id))
                                                        {
                                                            if(!$this->cm->check_policy_no_already_exits($policy_no))
                                                            {
                                                                 $data1 = array("status" =>"success" ,"commission_id"=>$com_id);
                                                            }
                                                            else
                                                            {
                                                                $data1 = array("status" =>"Policy no Already Exits" ,"commission_id"=>$com_id);
                                                            }
                                                        }
                                                        else
                                                        {
                                                            $data1 = array("status" =>"LeadID Already Exits","commission_id"=>"");
                                                        }
                                                    }
                                             }
                                            else if($fuel_type_status == "0")
                                            {
                                              $data1 = array("status" =>"Fuel Type Mismacthed","commission_id"=>"");
                                            }
                                            else if($gvw_status == "0")
                                            {
                                              $data1 = array("status" =>"Classification Mismatched","commission_id"=>"");
                                            }
                                            else if($make_status == "0")
                                            {
                                              $data1 = array("status" =>"Make Mismactched","commission_id"=>"");
                                            }
                                            else if($model_status == "0")
                                            {
                                              $data1 = array("status" =>"Model Mismactched","commission_id"=>"");
                                            }
                                            else if($varient_status == "0")
                                            {
                                              $data1 = array("status" =>"Varient Mismactched","commission_id"=>"");
                                            }
                                        }
                                        else
                                        {
                                             $data1 = array("status" =>"State Mismacthed","commission_id"=>"");
                                        }
                                     }
                                    else 
                                    {
                                      $data1 = array("status" =>"Insurance company or Slab1 Mismacthed","commission_id"=>"");
                                    }
                                }
                                else if($da->commission_type == "3")
                                {
                                    $g_status = "0";
                                    $fuel_status = "0";
                                    
                                    foreach($check as $da)
                                	{
                                        $temp_min = $da->min_val;
                                        $temp_max = $da->max_val;
                                        
                                        if($temp_min <= $total_premium && $temp_max >= $total_premium)
                                        {
                                             $g_status = "1";
                                             $commission_id[] = $da->id;
                                        }
                                        
                                        if($fuel_type == "1")
                                        {
                                        	if($da->fuel_type == "4" || $da->fuel_type == "5" || $da->fuel_type == "1" || $da->fuel_type == "6")
                                        	{
                                        	    $fuel_status = "1";
                                        	}
                                        }
                                        if($fuel_type == "2")
                                        {
                                            if($da->fuel_type == "5" || $da->fuel_type == "2" || $da->fuel_type == "6")
                                        	{
                                        	    $fuel_status = "1";
                                        	}
                                        }
                                        if($fuel_type == "5")
                                        {
                                            if($da->fuel_type == "5" || $da->fuel_type == "1" || $da->fuel_type == "2" || $da->fuel_type == "6")
                                        	{
                                        	    $fuel_status = "1";
                                        	}
                                        }
                                        if($fuel_type == "6")
                                        {
                                            if($da->fuel_type == "1" || $da->fuel_type == "2" || $da->fuel_type == "3" || $da->fuel_type == "4" || $da->fuel_type == "5" || $da->fuel_type == "6")
                                        	{
                                        	    $fuel_status = "1";
                                        	}
                                        }
                                        if($fuel_type == "7")
                                        {
                                            if($da->fuel_type == "7" || $da->fuel_type == "6")
                                        	{
                                        	    $fuel_status = "1";
                                        	}
                                        }
                            		   
                            			if($g_status == "1" && $fuel_status == "1")
                            			{
                            			    $commission_id[] = $da->id;
                            			    $status = "1";
                                            $fuel_type_status = "1";
                                          
                            			}
                                	}
                                	
                                    if($status == "1")
                                    {
                                        $check_state = $this->cm->check_state_by_commission_id(array_unique($commission_id));
                                        $commission_id = [];
                                        
                                        foreach($check_state as $da)
                                        {
                                            if($da->state == $state)
                                            {
                                                 $commission_id[] = $da->id;
                                                 $state_status = "1";
                                            }
                                            else if($da->state == "All")
                                            {
                                                $commission_id[] = $da->id;
                                                $state_status = "1";
                                            }
                                        }
                                        
                                        if($state_status == "1")
                                        {
                                            $classification = $this->cm->check_classification_by_commission_id(array_unique($commission_id));
                                            $temp_commission_id = [];
                                            $temp_commission_id = $commission_id;
                                        
                                             $commission_id = [];
                                        
                                            foreach($classification as $cl)
                                            {
                                                if($policy_type == "7" || $policy_type == "12" || $policy_type == "13" || $policy_type == "14" || $policy_type == "59" || $policy_type == "60" || $policy_type == "65" || $policy_type == "66" || $policy_type == "67" || $policy_type == "68" || $policy_type == "69" || $policy_type == "70")
                                                {
                                                    if($cl->classification != "")
                                                    {
                                                       $classification = $this->cm->check_seating($v_seating,$policy_type,$temp_commission_id);
                                                       
                                                        if(count($classification) > 0)
                                                        {
                                                            $gvw_status = "1";
                                                            
                                                            foreach($classification as $da)
                                                            {
                                                                $commission_id[] = $cl->id;
                                                                $gvw_status = "1";
                                                            }
                                                        }
                                                    }
                                                    else
                                                    {
                                                        $commission_id = $temp_commission_id;
                                                        $gvw_status = "1";
                                                    }
                                                }
                                                else if($policy_type == "1" || $policy_type == "2" || $policy_type == "3" || $policy_type == "4" || $policy_type == "55")
                                                {
                                                    if($cl->classification != "")
                                                    {
                                                        $classification = $this->lm->get_classification($cl->classification,$policy_type);
                                                     
                                                        if($classification != null)
                                                        {
                                                             $temp_min = $classification->from_gvw_cc;
                                                             $temp_max = $classification->to_gvw_cc;
                                                             
                                                             if(($cc >= $temp_min && $cc <= $temp_max))
                                                             {
                                                                 $commission_id[] = $cl->id;
                                                                 $gvw_status = "1";
                                                             }
                                                        }
                                                    }
                                                    else
                                                    {
                                                        $gvw_status = "1";
                                                        $commission_id = $temp_commission_id;
                                                    }
                                                }
                                                else
                                                {
                                                    if($cl->classification != "")
                                                    {
                                                        $classification = $this->lm->get_classification($cl->classification,$policy_type);
                                                      
                                                        if($classification != null)
                                                        {
                                                            $temp_min = $classification->from_gvw_cc;
                                                            $temp_max = $classification->to_gvw_cc;
                                                            
                                                            if($v_gvw >= $temp_min && $v_gvw <= $temp_max)
                                                            {
                                                                $gvw_status = "1";
                                                                $commission_id[] = $cl->id;
                                                            }
                                                        }
                                                    }
                                                    else
                                                    {
                                                        $gvw_status = "1";
                                                        $commission_id = $temp_commission_id;
                                                    }
                                                }
                                            }
                                        
                                             $check_make_1 = $this->cm->check_make_already_exits(array_unique($commission_id),$policy_type,$make);
                                            
                                            if(count($check_make_1) > 0)
                                            {
                                                    if(count($check_make_1) > 0)
                                                    {
                                                        $commission_id = [];
                                                        
                                                        foreach($check_make_1 as $da)
                                                        {
                                                             $commission_id[] = $da->commission_id;
                                                        }
                                                        $status = "1";
                                                        $make_status = "1";
                                                    }
                                                    else
                                                    {
                                                        $make_status = "0";
                                                    }
                                            }
                                            else
                                            {
                                                $check_make = $this->lm->check_make_all_already_exits(array_unique($commission_id),$policy_type);
                                                
                                                if(count($check_make) > 0)
                                                {
                                                    $commission_id = [];
                                                    
                                                    foreach($check_make as $da)
                                                    {
                                                      $commission_id[] = $da->id;
                                                    }
                                                    
                                                    $status = "1";
                                                    $make_status = "1";
                                                }
                                            }

                                            $check_model_1 = $this->lm->check_model_already_exits(array_unique($commission_id),$policy_type,$make,$model);
                                             
                                            if(count($check_model_1) > 0)
                                            {
                                                $commission_id = [];
                                                
                                                foreach($check_model_1 as $da)
                                                {
                                                   $commission_id[] = $da->commission_id;
                                                }
                                                
                                                $status = "1";
                                                $model_status = "1";
                                            }
                                            else
                                            {
                                                $check_model = $this->pm->check_model_all_already_exits(array_unique($commission_id),$policy_type);
                                                if(count($check_model) > 0)
                                                {
                                                        $commission_id = [];
                                                        foreach($check_model as $da)
                                                        {
                                                             $commission_id[] = $da->id;
                                                        }
                                                     $status = "1";
                                                     $model_status = "1";
                                                }
                                            }
                                            
                                            if($make_status == "1" && $model_status == "1")
                                            {
                                                $check_varient_1 = $this->cm->check_varient_already_exits(array_unique($commission_id),$policy_type,$make,$model,$Varient);
                                               
                                                if(count($check_varient_1) > 0) 
                                                {
                                                    $commission_id = [];
                                                    foreach($check_varient_1 as $da)
                                                    {
                                                      $commission_id[] = $da->commission_id;
                                                    }
                                                    $status = "1";
                                                    $varient_status = "1";
                                                }
                                                else
                                                {
                                                    $check_varient = $this->pm->check_varient_all_already_exits(array_unique($commission_id),$policy_type);
                                                    if(count($check_varient) > 0)
                                                    {
                                                        $commission_id = [];
                                                        
                                                        foreach($check_varient as $da)
                                                        {
                                                             $commission_id[] = $da->id;
                                                        }
                                                         $status = "1";
                                            	         $varient_status = "1";
                                                    }
                                                }
                                            }
                                            
                                            if($status == "1" && $state_status == "1" && $fuel_type_status == "1" && $gvw_status == "1" && $make_status == "1" && $model_status == "1" && $varient_status == "1")
                                            {
                                                 $check_rto = $this->cm->check_rto_already_exits_2(array_unique($commission_id),$rto);
                                                 
                                                    if(count($check_rto) > 0)
                                                    {
                                                        foreach($check_rto as $rt)
                                                        {
                                                            $com_id = $rt->commission_id;
                                                        }
                                                        
                                                        if(!$this->cm->check_policy_already_exits($lead_id))
                                                        {
                                                            if(!$this->cm->check_policy_no_already_exits($policy_no))
                                                            {
                                                                 $data1 = array("status" =>"success" ,"commission_id"=>$com_id);
                                                            }
                                                        }
                                                        else
                                                        {
                                                            $data1 = array("status" =>"Policy Already Exits","commission_id"=>"");
                                                        }
                                                    }
                                             }
                                            else if($fuel_type_status == "0")
                                            {
                                              $data1 = array("status" =>"Fuel Type Mismacthed","commission_id"=>"");
                                            }
                                            else if($gvw_status == "0")
                                            {
                                              $data1 = array("status" =>"Classification Mismatched","commission_id"=>"");
                                            }
                                            else if($make_status == "0")
                                            {
                                              $data1 = array("status" =>"Make Mismactched","commission_id"=>"");
                                            }
                                            else if($model_status == "0")
                                            {
                                              $data1 = array("status" =>"Model Mismactched","commission_id"=>"");
                                            }
                                            else if($varient_status == "0")
                                            {
                                              $data1 = array("status" =>"Varient Mismactched","commission_id"=>"");
                                            }
                                        }
                                        else
                                        {
                                            $data1 = array("status" =>"State Mismacthed","commission_id"=>"");
                                        }
                                     }
                                    else
                                    {
                                       $data1 = array("status" =>"Insurace Company or Slab Mismacthed","commission_id"=>"");
                                    }
                                }
                            }
                           echo json_encode($data1);
                   }
                   else if($class_type->class == "2")
                   {
                           $bussiness_type = $class_type->business_type;
                           $policy_class = $class_type->class;
                           $policy_type =  $class_type->policy_type;
                           $state = "All";
                           
                            $data1 = array("status" =>"Commission Slab Not Exits","commission_id"=>"");
                           
                           $check = $this->cm->check_health_commission($company,$policy_premium,$policy_class,$bussiness_type,$policy_type,$state,$from_date_1,$to_date_1);
                           
                            foreach($check as $da)
                            {
                                if($da->commission_type == "1")
                                {
                                    foreach($check as $da)
                                	{
                                        $temp_min = $da->no_policy_min;
                                        $temp_max = $da->no_policy_max;
                                        
                                        if($temp_min <= 1 && $temp_max >= 1)
                                        {
                                             $status = "1";
                                             $commission_id[] = $da->id;
                                        }
                                	}
                                	
                                	if($status == "1")
                                	{
                                	     if($da->state != "All")
                                	     {
                                	         $res = $this->cm->check_health_state($commission_id);
                                	         $commission_id = [];
                                	         
                                    	     foreach($res as $da)
                                    	     {
                                    	           $commission_id[] = $da->id;
                                    	           $c_id = $da->id;
                                    	     }
                                	     }
                                	     $data1 = array("status" =>"success","commission_id"=>$c_id);
                                	}
                                	else
                                	{
                                	     $data1 = array("status" =>"Slab Not Exits","commission_id"=>"");
                                	}
                                }
                                else if($da->commission_type == "3")
                                {
                                    foreach($check as $da)
                                	{
                                        $temp_min = $da->min_val;
                                        $temp_max = $da->max_val;
                                        
                                        if($temp_min <= $total_premium && $temp_max >= $total_premium)
                                        {
                                             $status = "1";
                                             $commission_id[] = $da->id;
                                        }
                                	}
                                	
                                	if($status == "1")
                                	{
                                	     if($da->state != "All")
                                	     {
                                	         $res = $this->cm->check_health_state($commission_id);
                                	         $commission_id = [];
                                	         
                                    	     foreach($res as $da)
                                    	     {
                                    	           $commission_id[] = $da->id;
                                    	           $c_id = $da->id;
                                    	     }
                                    	     $data1 = array("commission_id"=>$c_id,"status" => "success");
                                	     }
                                	     else
                                	     {
                                	         $data1 = array("commission_id"=>"","status" => "success");
                                	     }
                                	}
                                }
                            }
                             echo json_encode($data1);
                      }
               
                 }
        	}
       }
       
  //direct renewals 
       
  public function direct_renewals()
  {
      if($this->session->has_userdata('logged_in') && $this->session->userdata('session_role') == "admin") 
    	{    		
		   	$pro_data["project_info"] = $this->mm->fetch_project_info();
		   	$data["users"] = $this->lm->fetch_users();
		   	$data["client_type"] = $this->lm->fetch_client_type();
		   	$data["business"] = $this->lm->fetch_business_type();
		   	$data["class"] = $this->lm->fetch_list_of_policy_type();
    		$this->load->view('header',$pro_data);
    		$this->load->view('direct_renewals',$data);
    		$this->load->view('footer',$pro_data);
	    }
	    else if($this->session->has_userdata('logged_in') && ($this->session->userdata('session_role') == "user" || $this->session->userdata('session_role') == "AI"))
	    {
	        $pro_data["project_info"] = $this->mm->fetch_project_info();
	        $data["users"] = $this->lm->fetch_users();
	        $data["client_type"] = $this->lm->fetch_client_type();
	        $data["business"] = $this->lm->fetch_business_type();
	        $data["class"] = $this->lm->fetch_list_of_policy_type();
    		$this->load->view('header',$pro_data);
    		$this->load->view('direct_renewals',$data);
    		$this->load->view('footer',$pro_data);
	    }
	    else
	    {
	    	redirect("login");
	    }
  }
  
  public function fetch_direct_renewals()
  {
       if($this->session->has_userdata('logged_in')) 
       { 
           $draw = intval($this->input->post("draw"));
           
           $from_date = $this->input->post("from_date");
           $to_date = $this->input->post("to_date");
           
    	   $res = $this->lm->fetch_all_direct_renewals($from_date,$to_date);
    	   
    	   $a=0;
    	   $arr = [];
    	  
    	 foreach($res as $da)
    	 {
    	   $a++;
    	   $action = "<a href='create_lead?id=".$da->id."' class='btn btn-warning btn-xs'><i class='fa fa-eye'></i></a>";
            $arr[] =array(
                           $a,
                           $da->client_name,
                           $da->mobile_no,
                           $da->lclass,
                           $da->p_type,
                           $da->b_type,
                           $da->area,
                           $da->Model,
                           $da->sub_model,
                           date_format(date_create($da->due_date),"d-m-Y"),
                           $action,
                        );
            }
    	        $result = array(
            			"draw"=> $draw,
    				    "recordsTotal"=>count($res) ,
    				    "recordsFiltered"=> count($res),
    				    "data"=>$arr,
    				);
          echo json_encode($result);
       }
   }
   
   public function direct_renewals_excel()
   {
      if($this->session->has_userdata('logged_in')) 
      { 
           $from_date = $this->input->post("from_date");
           $to_date = $this->input->post("to_date");
           
    	   $res = $this->lm->fetch_all_direct_renewals($from_date,$to_date);
    	   
    	    $this->load->library('Excel');
    	    $from_date = $this->input->post("from_date");
    	    $to_date = $this->input->post("to_date");
    	    $agent_list = $this->input->post("agents");
    	    
        	$objPHPExcel = new PHPExcel();
            $objPHPExcel->setActiveSheetIndex(0);
            $rowCount = 4;
            $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(10);
            $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
            $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
            $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(15);
            $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(15);
            $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(15);
            $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(15);
            $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(15);
            $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(15);
            $objPHPExcel->getActiveSheet()->getRowDimension('2')->setRowHeight(15);
            $objPHPExcel->getActiveSheet()->SetCellValue('D2', 'Direct Renewals Report');
            
           $objPHPExcel->getActiveSheet()->getStyle('D2')->applyFromArray( 
           array(
                    'fill' => array(
                        'type' => PHPExcel_Style_Fill::FILL_SOLID,
                        'color' => array('rgb' => 'F50A1B')
                    ),
                    'alignment' => array(
                        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                    ),
                    'font'  => array(
                        'bold'  => true,
                        'color' => array('rgb' => 'FFFFFF'),
                        'size'  => 13,
                    ),
                )
            );
            
            $objPHPExcel->getActiveSheet()->getStyle('3')->applyFromArray(
                array(
                    
                    'font'  => array(
                        'bold'  => true,
                        'color' => array('rgb' => '000000'),
                        'size'  => 13,
                    ),
                )
            );
          
            $objPHPExcel->getActiveSheet()->getRowDimension('3')->setRowHeight(20);
            $objPHPExcel->getActiveSheet()->SetCellValue('I3', 'Excel Date : ');
            $objPHPExcel->getActiveSheet()->SetCellValue('J3', date("d-m-Y"));
            $objPHPExcel->getActiveSheet()->getRowDimension('4')->setRowHeight(20);
            $objPHPExcel->getActiveSheet()->getStyle('4')->applyFromArray(
                array(
                    'fill' => array(
                        'type' => PHPExcel_Style_Fill::FILL_SOLID,
                        'color' => array('rgb' => '31406b')
                    ),
                    'alignment' => array(
                        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                    ),
                    'font'  => array(
                        'bold'  => true,
                        'color' => array('rgb' => 'FFFFFF'),
                        'size'  => 13,
                    ),
                )
            );
            
            $objPHPExcel->getActiveSheet()->SetCellValue('A4', 'S.No');
            $objPHPExcel->getActiveSheet()->SetCellValue('B4', 'Client name	');
            $objPHPExcel->getActiveSheet()->SetCellValue('C4', 'Mobile Number');
            $objPHPExcel->getActiveSheet()->SetCellValue('D4', 'Class');
            $objPHPExcel->getActiveSheet()->SetCellValue('E4', 'Policy Type');
            $objPHPExcel->getActiveSheet()->SetCellValue('F4', 'Business type');
            $objPHPExcel->getActiveSheet()->SetCellValue('G4', 'Area');
            $objPHPExcel->getActiveSheet()->SetCellValue('H4', 'Due Date');
            $row_count = 5;

    	    $a=0;
    	    
    	    foreach($res as $da)
    	    {
    	       $a++;
                $objPHPExcel->getActiveSheet()->SetCellValue('A'.$row_count , $a);
                $objPHPExcel->getActiveSheet()->SetCellValue('B'.$row_count , $da->client_name);
                $objPHPExcel->getActiveSheet()->SetCellValue('C'.$row_count , $da->mobile_no);
                $objPHPExcel->getActiveSheet()->SetCellValue('D'.$row_count , $da->lclass);
                $objPHPExcel->getActiveSheet()->SetCellValue('E'.$row_count , $da->p_type);
                $objPHPExcel->getActiveSheet()->SetCellValue('F'.$row_count , $da->b_type);
                $objPHPExcel->getActiveSheet()->SetCellValue('G'.$row_count , $da->area);
                $objPHPExcel->getActiveSheet()->SetCellValue('H'.$row_count , date_format(date_create($da->due_date),"d-m-Y"));
                $objPHPExcel->getActiveSheet()->getRowDimension($row_count)->setRowHeight(20);
                $row_count++;
    	    }
    	     $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
            $objWriter->save('./datas/reports/direct_renewals_report.xlsx');
            echo base_url()."/datas/reports/direct_renewals_report.xlsx";
      }
   }
   
   public function add_nominee_details()
   {
      if($this->session->has_userdata('logged_in')) 
      { 
           $lead_id = $this->input->post("lead_id");
           $nominee_name = $this->input->post("nominee_name");
           $adharcard_no = $this->input->post("adharcard_no");
           $n_mobile_no = $this->input->post("n_mobile_no");
           $n_adhar_card_upload = $this->input->post("n_adhar_card_upload");
           
            $lead_id = 38538;
           $nominee_name = "hjhkj";
           $adharcard_no = 23423423;
           $n_mobile_no = 23423434;
           $n_adhar_card_upload = $this->input->post("n_adhar_card_upload");
           
            if (isset($_FILES['n_adhar_card_upload'])) {
                $config['upload_path'] = './datas/nominee_documents/';
                $config['allowed_types'] = '*';
                $config['max_size'] = 2048;
                $config['encrypt_name'] = TRUE; 
            
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
            
                if (!$this->upload->do_upload('n_adhar_card_upload')) {
                    $error = $this->upload->display_errors(); 
                    $file = '';
                } else {
                    $file = $this->upload->data('file_name');
                }
            } 

          $nominee_details = array(
              "lead_id"=>$lead_id,
              "name" =>$nominee_name,
              "adharcard_no"=>$adharcard_no,
              "mobile_no"=>$n_mobile_no,
              "file"=>$file,
              "created_by"=>$this->session->userdata('session_id'),
              "created_date"=>date("Y-m-d H:i:s"));
            $add_nominee_details = $this->lm->add_nominee_details($nominee_details);
            if( $add_nominee_details ) {
                $this->audit->log('nominee_details', 'INSERT', null, null, $nominee_details);
            }
          echo "success";
      }
   }
   
   public function get_nominee_details()
   {
      if($this->session->has_userdata('logged_in')) 
      {
          $lead_id = $this->input->post("lead_id");
          $res= $this->lm->get_nominee_details($lead_id);
          echo json_encode($res);
      }
   }
   
   public function fetch_pcv_seating_capacity()
   {
      if($this->session->has_userdata('logged_in')) 
      {
          $policy_type = $this->input->post("policy_type");
          $res = $this->lm->get_pcv_seating($policy_type);
          $option = "<option value=''>--Select--</option>";
          foreach($res as $da)
          {
             $option .="<option value=".$da->id.">".$da->seating_capacity." Seater</option>";
          }
          echo $option;
      }
   }
   
   public function fetch_edit_pcv_seating_capacity()
   {
      if($this->session->has_userdata('logged_in')) 
      {
          $policy_type = $this->input->post("policy_type");
          $res = $this->lm->get_pcv_seating($policy_type);
          echo json_encode($res);
      }
   }
   
   
   public function fetch_area_incharge_by_agent()
   {
      if($this->session->has_userdata('logged_in')) 
      {
          $agent_pos = $this->input->post("agent_pos");
          $res = $this->lm->fetch_area_incharge_by_agent($agent_pos);
          echo json_encode($res);
      }
   }
   
   
    public function check_policy_no_already_exits()
   {
      if($this->session->has_userdata('logged_in')) 
      {
          $check = [];
          $policy_no = $this->input->post("policy_no");
          $check = $this->lm->check_policy_no_already_exits($policy_no);
          
          if(count((array)$check) > 0)
          {
              $status = "This Policy No Already Exits";
          }
          else
          {
              $status = "Not_exits";
          }
          echo $status;
      }
   }
   
        public function temp_save_policy()
        {
          if($this->session->has_userdata('logged_in')) 
          {
             $lead_id = $this->input->post("lead_id");
             $policy_no = $this->input->post("policy_no");
             
              $data = array(
            	        "lead_id" =>$this->input->post("lead_id"),
            	        "policy_client_ref_no"=> $this->input->post("policy_client_ref_no"),
                        "policy_cover_note_no"=> $this->input->post("policy_cover_note_no"),
                        "policy_no"=> $this->input->post("policy_no"),
                        "policy_s_date"=> $this->input->post("policy_s_date"),
                        "policy_ex_date"=> $this->input->post("policy_ex_date"),
                        "policy_premium"=> $this->input->post("policy_premium"),
                        "policy_terms"=> $this->input->post("policy_terms"),
                        "payment_frequency"=> $this->input->post("payment_frequency"),
                        "next_due_date"=> $this->input->post("next_due_date"),
                        "renewable_flag"=> $this->input->post("renewable_flag"),
                        "add_ons_opted"=> $this->input->post("add_ons_opted"),
                        "add_ons_not_opt" =>$this->input->post("add_ons_not_opt"),
                        "lead_type" =>"2",
                        "sum_insured"=> $this->input->post("sum_insured"),
                        "discount_percent"=> $this->input->post("discount_percent"),
                        "no_claim_bonus"=> $this->input->post("no_claim_bonus"),
                        "no_claim_bonus_val"=> $this->input->post("no_claim_bonus_val"),
                        "cpa"=> $this->input->post("cpa"),
                        "total_own_damage"=> $this->input->post("total_own_damage"),
                        "tot_add_on_premium"=> $this->input->post("tot_add_on_premium"),
                        "commisson_base_premium"=> $this->input->post("commisson_base_premium"),
                        "basic_tp"=> $this->input->post("basic_tp"),
                        "owner_driver_pa"=> $this->input->post("owner_driver_pa"),
                        "owner_diver_amt"=> $this->input->post("owner_diver_amt"),
                        "no_of_year_own_drv"=> $this->input->post("no_of_year_own_drv"),
                        "fuel_kit"=> $this->input->post("fuel_kit"),
                        "fuel_kit_amt"=> $this->input->post("fuel_kit_amt"),
                        "geograpical"=> $this->input->post("geograpical"),
                        "geograpical_amt"=> $this->input->post("geograpical_amt"),
                        "un_named_passenger_pa"=> $this->input->post("un_named_passenger_pa"),
                        "un_named_passenger_amt"=> $this->input->post("un_named_passenger_amt"),
                        "no_seats_per_person"=> $this->input->post("no_seats_per_person"),
                        "no_seats_per_person_amt"=> $this->input->post("no_seats_per_person_amt"),
                        "LL_paid "=> $this->input->post("llp"),
                        "LL_paid_amt"=> $this->input->post("llp_amt"),
                        "no_drv_emp"=> $this->input->post("no_drv_emp"),
                        "pa_paid_drv"=> $this->input->post("pa_paid_drv"),
                        "pa_paid_drv_amt"=> $this->input->post("pa_paid_drv_amt"),
                        "no_seats_per_person1"=> $this->input->post("no_seats_per_person1"),
                        "no_seats_per_person_amt1"=> $this->input->post("no_seats_per_person_amt1"),
                        "tot_liability_premium"=> $this->input->post("tot_liability_premium"),
                        "total_premium"=> $this->input->post("total_premium"),
                        "gst"=> $this->input->post("gst"),
                        "premium_gst"=> $this->input->post("premium_gst"),
                        "policy_issue_date"=> $this->input->post("policy_issue_date"),
                        "policy_agency_pos"=> $this->input->post("policy_agency_pos"),
                        "policy_source"=> $this->input->post("policy_source"),
                        "policy_user"=> $this->input->post("policy_user"),
                        "policy_location"=> $this->input->post("policy_location"),
                        "previous_policy_no"=> $this->input->post("previous_policy_no"),
                        "previous_insurer"=> $this->input->post("previous_insurer"),
                        "previous_insurance_plan"=> $this->input->post("previous_insurance_plan"),
                        "previous_agency_pos"=> $this->input->post("previous_agency_pos"),
                        "previous_source"=> $this->input->post("previous_source"),
                        "dectable_details"=> $this->input->post("dectable_details"),
                        "policy_additional_info"=> $this->input->post("policy_additional_info"),
                        "reference_no"=> $this->input->post("reference_no"),
                        "other_reference_no"=> $this->input->post("other_reference_no"),
                        "policy_received"=> $this->input->post("policy_received"),
                        "policy_verified"=> $this->input->post("policy_verified"),
                        "policy_verified_info"=> $this->input->post("policy_verified_info"),
                        "policy_cancelled"=> $this->input->post("policy_cancelled"),
                        "policy_cancelled_info"=> $this->input->post("policy_cancelled_info"),
                        "commisson_generation"=> $this->input->post("commisson_generation"),
                        "payment_type"=> $this->input->post("payment_type"),
                        "pay_ref_no"=> $this->input->post("pay_ref_no"),
                        "bank_name"=> $this->input->post("bank_name"),
                        "payment_check_date"=> $this->input->post("payment_check_date"),
                        "payment_and_check_no"=> $this->input->post("payment_and_check_no"),
                        "remarks"=> $this->input->post("remarks"),
                        "company"=> $this->input->post("company"),
                        "created_by"=> $this->session->userdata('session_id'),
                        "created_at"=> date("Y-m-d H:i:s"),
                        );
                        
                // 2023-06-01 start
                if(in_array($this->input->post('policy_premium'), ['1', '4'])){
                   // PKG, BUNDle Policy Premium
                    if($this->input->post("od_start_date")){
                        $data['od_start_date'] = $this->input->post("od_start_date");                    
                    }
                    if($this->input->post("od_end_date")){
                        $data['od_end_date'] = $this->input->post("od_end_date");                    
                    }
                    if($this->input->post("tp_start_date")){
                        $data['tp_start_date'] = $this->input->post("tp_start_date");                    
                    }
                    if($this->input->post("tp_end_date")){
                        $data['tp_end_date'] = $this->input->post("tp_end_date");                    
                    }
                }
                
                //2023-06-01 end
                
                if(!$this->lm->check_this_policy_already_exits_in_temp($policy_no))
                {
                    if(!$this->lm->check_this_policy_already_exits($policy_no))
                    {
                        $check = $this->lm->check_lead_id_already_exits($lead_id);
                        
                        if($check > 0)
                        {
                            $old_data = $this->lm->get_total_premium($lead_id);
                            $temp_data = $this->lm->update_temp_data_by_lead_id($data,$lead_id);
                            if($temp_data){
            	                $this->audit->log('temp_policy_info', 'UPDATE', null, $old_data, $data);
            	            }
                        }
                        else
                        {
                              $temp_data = $this->lm->insert_temp_data($data);
                              if( $temp_data ){
            	                 $this->audit->log('temp_policy_info', 'INSERT', null, null, $data);
            	              }
                        }
                        $data_1 = array("policy_status" =>"1");
                        $old_lead_data = $this->lm->get_receiver_email_id($lead_id);
                        $update = $this->lm->update_policy_status($data_1,$lead_id);
                        if($update){
        	                $this->audit->log('list_of_leads', 'UPDATE', null, $old_lead_data, $data_1);
        	            }
                    }
                    else
                    {
                        echo "Exits";
                    }
                }
                else
                {
                    echo "Exits";
                }
            }
       }
        
        public function get_temp_data()
        {
             if($this->session->has_userdata('logged_in')) 
             {
                 $lead_id = $this->input->post("lead_id");
                 
                 $check = $this->lm->check_this_lead_already_in_policy_info($lead_id);
                 
                 if($check > 0)
                 {
                     $res = $this->lm->get_policy_data($lead_id);
                 }
                 else
                 {                                     
                    $res = $this->lm->get_temp_policy_data($lead_id);
                 }
                 
                 echo json_encode($res);
             }
        }
        
        public function fetch_edit_health_details()
        {
            if($this->session->has_userdata('logged_in')) 
             {
                 $lead_id = $this->input->post("lead_id");
                 $res = $this->lm->get_health_details($lead_id);
                 echo json_encode($res);
             }
        }
        
        
   public function edit_health_details()
    {
      if($this->session->has_userdata('logged_in'))
       {
            $lead_id=$this->input->post("lead_id");
            $h_gender=$this->input->post("h_gender");
            $Husband=$this->input->post("Husband");
            $Wife=$this->input->post("Wife");
            $Son=$this->input->post("Son");
            $Daughter=$this->input->post("Daughter");
            $Father=$this->input->post("Father");
            $Mother=$this->input->post("Mother");
            $Husband_age=$this->input->post("Husband_age");
            $Wife_age=$this->input->post("Wife_age");
            $num_daughters=$this->input->post("num_daughters");
            $num_sons=$this->input->post("num_sons");
            $son_1_age=$this->input->post("son_1_age");
           $son_2_age=$this->input->post("son_2_age");
           $son_3_age=$this->input->post("son_3_age");
           $son_4_age=$this->input->post("son_4_age");
           $daughter_1_age=$this->input->post("daughter_1_age");
           $daughter_2_age=$this->input->post("daughter_2_age");
           $daughter_3_age=$this->input->post("daughter_3_age");
           $daughter_4_age=$this->input->post("daughter_4_age");
          $father_age=$this->input->post("father_age");
          $mother_age=$this->input->post("mother_age");
          $date = date("Y-m-d"); 
          
           $son_name_1=$this->input->post("son_name_1");
           $son_name_2=$this->input->post("son_name_2");
           $son_name_3=$this->input->post("son_name_3");
           $son_name_4=$this->input->post("son_name_4");
           
           $son_dob_1=$this->input->post("son_dob_1");
           $son_dob_2=$this->input->post("son_dob_2");
           $son_dob_3=$this->input->post("son_dob_3");
           $son_dob_4=$this->input->post("son_dob_4");
           
           
           $daughter_name_1=$this->input->post("daughter_name_1");
           $daughter_name_2=$this->input->post("daughter_name_2");
           $daughter_name_3=$this->input->post("daughter_name_3");
           $daughter_name_4=$this->input->post("daughter_name_4");
           
           $daughter_dob_1=$this->input->post("daughter_dob_1");
           $daughter_dob_2=$this->input->post("daughter_dob_2");
           $daughter_dob_3=$this->input->post("daughter_dob_3");
           $daughter_dob_4=$this->input->post("daughter_dob_4");
           
           
           $Husband_name = $this->input->post("Husband_name");
           $Husband_dob = $this->input->post("Husband_dob");
           $Wife_name = $this->input->post("Wife_name");
           $Wife_dob = $this->input->post("Wife_dob");
           
           $father_name = $this->input->post("father_name");
           $father_dob = $this->input->post("father_dob");
           $mother_name = $this->input->post("mother_name");
           $dob_mother = $this->input->post("dob_mother");
           
            $date = date("Y-m-d H:i:s"); 
        
            $data = array(
                        "husband"=>$Husband,
                        "wife"=>$Wife,"father"=>$Father,
                        "mother"=>$Mother,"son"=>$Son,
                        "duaghter"=>$Daughter,
                        "father_age" =>$father_age,
                        "mother_age"=>$mother_age,
                        "husband_age"=>$Husband_age,
                        "wife_age"=>$Wife_age,
                        "son_count"=>$num_sons,
                        "duaghter_count"=>$num_daughters,
                        "son1_age"=>$son_1_age,
                        "son2_age"=>$son_2_age,
                        "son3_age"=>$son_3_age,
                        "son4_age"=>$son_4_age,
                        "daughter1_age"=>$daughter_1_age,
                        "daughter2_age"=>$daughter_2_age,
                        "daughter3_age"=>$daughter_3_age,
                        "daughter4_age"=>$daughter_4_age,
                        "gender"=>$h_gender,
                        "daughter_name_1" => $daughter_name_1,
                        "daughter_name_2" => $daughter_name_2,
                        "daughter_name_3" => $daughter_name_3,
                        "daughter_name_4" => $daughter_name_4,
                        "daughter_dob_1" => $daughter_dob_1,
                        "daughter_dob_2" => $daughter_dob_2,
                        "daughter_dob_3" => $daughter_dob_3,
                        "daughter_dob_4" => $daughter_dob_4,
                        "son_name_1" =>$son_name_1,
                        "son_name_2" =>$son_name_2,
                        "son_name_3" =>$son_name_3,
                        "son_name_4" =>$son_name_4,
                        "son_dob_1" =>$son_dob_1,
                        "son_dob_2" =>$son_dob_2,
                        "son_dob_3" =>$son_dob_3,
                        "son_dob_4" =>$son_dob_4,
                        "father_name" =>$father_name,
                        "father_dob" =>$father_dob,
                        "mother_name" =>$mother_name,
                        "mother_dob" =>$dob_mother,
                        "husband_name" =>$Husband_name,
                        "husband_dob" =>$Husband_dob,
                        "wife_name" =>$Wife_name,
                        "wife_dob" =>$Wife_dob,
                        "lead_id"=>$lead_id,
                        "updated_at"=>$date,
                        "updated_by"=>$this->session->userdata("session_id"),
                   );
         
                $_health = $this->lm->get_health_details($lead_id);
                                
                $res = $this->lm->update_health_details($data,$lead_id);
                
                if( $res ){
    		        $this->audit->log('health_details', 'UPDATE', null, $_health, $data);
    		    }
            
            }
    }
    
    public function check_this_lead_already_in_policy()
    {
       if($this->session->has_userdata('logged_in'))
       {
           $lead_id = $this->input->post("lead_id");
           $res = $this->lm->check_this_lead_already_in_policy($lead_id);
           
           if($res > 0)
           {
               echo true;
           }
           else
           {
               echo false;
           }
           
       }
    }
    
    public function check_vehi_regn_no()
    {
       if($this->session->has_userdata('logged_in'))
       {
           $regn_no = $this->input->post("regn_no");
           $res = $this->lm->check_vehi_regn_no($regn_no);
           if($res > 0)
           {
               echo "Exits";
           }
           else 
           {
               echo "No";
           }
       }
    }
    
    public function fetch_user_by_agent()
    {
       if($this->session->has_userdata('logged_in'))
       {
           $agent_pos = $this->input->post("agent_pos");
           
           $res = $this->lm->fetch_user_by_agent($agent_pos);
           
           $html = "";
           
           if($res != "")
           {
               $users = $this->lm->get_user_by_id($res->user_id);
               
               $html .="<option value='".$users->id."'>".$users->name."(".$users->email_id.")"."</option>";
           }
           
           echo $html;
       }
    }
    
    public function remove_duplicates()
    {
        if($this->session->has_userdata('logged_in'))
       {
           $res = $this->lm->get_duplicate_records();

           $arr = array();
           
           foreach($res as $da)
           {
               if(in_array($da->lead_id,$arr))
               {
                   $old_data = $this->lm->get_total_premium($da->lead_id);
                   $delete = $this->lm->delete_duplicates($da->id);
                   if($delete){
	                 $this->audit->log('temp_policy_info', 'DELETE', null, $old_data, null);
	                 $old_data = null;
	               }
               }
               else
               {
                  $arr[] = $da->lead_id;  
               }
               
           }
           
           echo "success";
       }
    }
    
    
    public function update_generate_policy_status()
    {
        if($this->session->has_userdata('logged_in'))
       {
           $res = $this->lm->get_gen_policy_leads_not_completed();
           
           foreach($res as $da)
           {
               $data = array("policy_status" =>"1");
               $old_data = $this->lm->get_receiver_email_id($da->id);
               
               $update = $this->lm->update_policy_status($data,$da->id);
                if($update){
                    $this->audit->log('list_of_leads', 'UPDATE', null, $old_data, $data);
                }
           }
           echo "success";
       }
    }
    
   public function update_quote_status()
    {
       if($this->session->has_userdata('logged_in'))
       {
            $id = $this->input->post("lead_id");
            $data = array("quote_status" =>"1");
           
            $old_data = $this->lm->get_receiver_email_id($id);
               
            $res = $this->lm->update_quote_status($id,$data);
            if($res){
                $this->audit->log('company_payout_grid', 'UPDATE', null, $old_data, $data);
            }
           echo "success";
       }
    }
    
    
    public function update_temp_policy()
    {
       if($this->session->has_userdata('logged_in'))
       {
           $id = $this->input->post("edit_id");
           $lead_id = $this->input->post("lead_id");
           $data = array(
        	        "lead_id" =>$this->input->post("lead_id"),
        	        "policy_client_ref_no"=> $this->input->post("policy_client_ref_no"),
                    "policy_cover_note_no"=> $this->input->post("policy_cover_note_no"),
                    "policy_no"=> $this->input->post("policy_no"),
                    "policy_s_date"=> $this->input->post("policy_s_date"),
                    "policy_ex_date"=> $this->input->post("policy_ex_date"),
                    "policy_premium"=> $this->input->post("policy_premium"),
                    "policy_terms"=> $this->input->post("policy_terms"),
                    "payment_frequency"=> $this->input->post("payment_frequency"),
                    "next_due_date"=> $this->input->post("next_due_date"),
                    "renewable_flag"=> $this->input->post("renewable_flag"),
                    "add_ons_opted"=> $this->input->post("add_ons_opted"),
                    "add_ons_not_opt" =>$this->input->post("add_ons_not_opt"),
                    "lead_type" =>"2",
                    "sum_insured"=> $this->input->post("sum_insured"),
                    "discount_percent"=> $this->input->post("discount_percent"),
                    "no_claim_bonus"=> $this->input->post("no_claim_bonus"),
                    "no_claim_bonus_val"=> $this->input->post("no_claim_bonus_val"),
                    "cpa"=> $this->input->post("cpa"),
                    "total_own_damage"=> $this->input->post("total_own_damage"),
                    "tot_add_on_premium"=> $this->input->post("tot_add_on_premium"),
                    "commisson_base_premium"=> $this->input->post("commisson_base_premium"),
                    "basic_tp"=> $this->input->post("basic_tp"),
                    "owner_driver_pa"=> $this->input->post("owner_driver_pa"),
                    "owner_diver_amt"=> $this->input->post("owner_diver_amt"),
                    "no_of_year_own_drv"=> $this->input->post("no_of_year_own_drv"),
                    "fuel_kit"=> $this->input->post("fuel_kit"),
                    "fuel_kit_amt"=> $this->input->post("fuel_kit_amt"),
                    "geograpical"=> $this->input->post("geograpical"),
                    "geograpical_amt"=> $this->input->post("geograpical_amt"),
                    "un_named_passenger_pa"=> $this->input->post("un_named_passenger_pa"),
                    "un_named_passenger_amt"=> $this->input->post("un_named_passenger_amt"),
                    "no_seats_per_person"=> $this->input->post("no_seats_per_person"),
                    "no_seats_per_person_amt"=> $this->input->post("no_seats_per_person_amt"),
                    "LL_paid "=> $this->input->post("llp"),
                    "LL_paid_amt"=> $this->input->post("llp_amt"),
                    "no_drv_emp"=> $this->input->post("no_drv_emp"),
                    "pa_paid_drv"=> $this->input->post("pa_paid_drv"),
                    "pa_paid_drv_amt"=> $this->input->post("pa_paid_drv_amt"),
                    "no_seats_per_person1"=> $this->input->post("no_seats_per_person1"),
                    "no_seats_per_person_amt1"=> $this->input->post("no_seats_per_person_amt1"),
                    "tot_liability_premium"=> $this->input->post("tot_liability_premium"),
                    "total_premium"=> $this->input->post("total_premium"),
                    "gst"=> $this->input->post("gst"),
                    "premium_gst"=> $this->input->post("premium_gst"),
                    "policy_issue_date"=> $this->input->post("policy_issue_date"),
                    "policy_agency_pos"=> $this->input->post("policy_agency_pos"),
                    "policy_source"=> $this->input->post("policy_source"),
                    "policy_user"=> $this->input->post("policy_user"),
                    "policy_location"=> $this->input->post("policy_location"),
                    "previous_policy_no"=> $this->input->post("previous_policy_no"),
                    "previous_insurer"=> $this->input->post("previous_insurer"),
                    "previous_insurance_plan"=> $this->input->post("previous_insurance_plan"),
                    "previous_agency_pos"=> $this->input->post("previous_agency_pos"),
                    "previous_source"=> $this->input->post("previous_source"),
                    "dectable_details"=> $this->input->post("dectable_details"),
                    "policy_additional_info"=> $this->input->post("policy_additional_info"),
                    "reference_no"=> $this->input->post("reference_no"),
                    "other_reference_no"=> $this->input->post("other_reference_no"),
                    "policy_received"=> $this->input->post("policy_received"),
                    "policy_verified"=> $this->input->post("policy_verified"),
                    "policy_verified_info"=> $this->input->post("policy_verified_info"),
                    "policy_cancelled"=> $this->input->post("policy_cancelled"),
                    "policy_cancelled_info"=> $this->input->post("policy_cancelled_info"),
                    "commisson_generation"=> $this->input->post("commisson_generation"),
                    "payment_type"=> $this->input->post("payment_type"),
                    "pay_ref_no"=> $this->input->post("pay_ref_no"),
                    "bank_name"=> $this->input->post("bank_name"),
                    "payment_check_date"=> $this->input->post("payment_check_date"),
                    "payment_and_check_no"=> $this->input->post("payment_and_check_no"),
                    "remarks"=> $this->input->post("remarks"),
                    "company"=> $this->input->post("company"),
                    "created_by"=> $this->session->userdata('session_id'),
                    "created_at"=> date("Y-m-d H:i:s"),
                    );
                  
                    // 2023-06-01 start
                    //PKG, BUNDLE check
                    if(in_array($this->input->post('policy_premium'), ['1', '4'])) { 
                        if($this->input->post("od_start_date")){
                            $data['od_start_date'] = $this->input->post("od_start_date");                    
                        }
                        if($this->input->post("od_end_date")){
                            $data['od_end_date'] = $this->input->post("od_end_date");                    
                        }
                        if($this->input->post("tp_start_date")){
                            $data['tp_start_date'] = $this->input->post("tp_start_date");                    
                        }
                        if($this->input->post("tp_end_date")){
                            $data['tp_end_date'] = $this->input->post("tp_end_date");                    
                        }
                    }                    
                    //2023-06-01 end
                  
                    $old_data = $this->lm->get_temp_policy_informations($id);
                    $temp_data = $this->lm->update_temp_data($data,$id);
                    if($temp_data){
    	                $this->audit->log('temp_policy_info', 'UPDATE', null, $old_data, $data);
    	            }
            	            
            	   
                    $data_1 = array("policy_status" =>"1");
                    $old_data = $this->lm->get_receiver_email_id($lead_id);
                    
                    $update = $this->lm->update_policy_status($data_1,$lead_id);
                    if($update){
                        $this->audit->log('list_of_leads', 'UPDATE', null, $old_data, $data_1);
                    }
                 
       }
    }
    
    public function get_un_assigned_ai_leads()
    {
      if($this->session->has_userdata('logged_in'))
       {
           $res = $this->lm->get_unassigned_ai_leads();
           
           foreach($res as $da)
           {
               $area_incharge = $this->lm->get_area_incharge_1($da->agency_and_pos);
               
              if($area_incharge != "")  
              {
                    $data = array("area_incharge" =>$area_incharge->area_incharge);
                    $old_data = $this->lm->get_receiver_email_id($da->id);    
                    $update = $this->lm->update_area_incharge_in_leads($data,$da->id);
                    if($update){
                        $this->audit->log('list_of_leads', 'UPDATE', null, $old_data, $data);
                    } 
              }
           }
           
           echo "success";
       }
    }
    
    // business complete
    
    
     public function business_complete()
    {
        
        if( !( $this->session->has_userdata('logged_in') ) ){
            redirect('login', 'refresh');
        }
        
        // if(!$this->auth->can_access('Business Complete')){
        //     redirect('access_denied', 'refresh');
        // }
        
        if($this->session->has_userdata('logged_in') && $this->session->userdata('session_role') == "admin") 
    	{    
    	   
		   	$pro_data["project_info"] = $this->mm->fetch_project_info();
		   	$data["users"] = $this->lm->fetch_users();
		   	$data["client_type"] = $this->lm->fetch_client_type();
		   	$data["business"] = $this->lm->fetch_business_type();
		   	$data["class"] = $this->lm->fetch_list_of_policy_type();
    		$this->load->view('header',$pro_data);
    		$this->load->view('business_complete',$data);
    		$this->load->view('footer',$pro_data);
	        
	    }
	    else if($this->session->has_userdata('logged_in') && ($this->session->userdata('session_role') == "user" || $this->session->userdata('session_role') == "AI"))
	    {
	        $check_user_i = $this->mm->fetch_user_permissions($this->session->userdata('session_id'));
	        
	        if($check_user_i->policy_view == "1")
	        {
    	        $session_id = $this->session->userdata('session_id');
    	        $pro_data["project_info"] = $this->mm->fetch_project_info();
    	        $data["users"] = $this->lm->fetch_users_by_user($session_id);
    	        $data["client_type"] = $this->lm->fetch_client_type();
    	        $data["business"] = $this->lm->fetch_business_type();
    	        $data["class"] = $this->lm->fetch_list_of_policy_type();
        		$this->load->view('header',$pro_data);
        		$this->load->view('business_complete',$data);
        		$this->load->view('footer',$pro_data);
	        }
	        else
	        {
	            echo "<script>alert('Permission Denied');window.location.href='home';</script>";
	        }
	    }
	    else
	    {
	    	redirect("login");
	    }
    }
    
   public function fetch_business_complete()
   {
      	if($this->session->has_userdata('logged_in')) 
    	{
            $draw = intval($this->input->post("draw"));
            
            $res = $this->lm->fetch_business_complete();
          
            $arr = [];
            $a = $_POST['start'];
            
            
            $usr_name = "";
            $agn_name = "";
            $ai = "";
            
            foreach($res as $da)
            {
                $a++;
                
               $client_name = "<a href='#' onclick=view_data(".$da->lead_id.")>".$da->client_name."</a>";

                 if($da->policy_agency_pos != "all")
            	 {
            	     if($da->policy_agency_pos != "")
            	     {
                	     $get_agent_name = $this->lm->get_agent_name($da->policy_agency_pos);
                	     $agn_name = $get_agent_name->name;
            	     }
            	     else
            	     {
            	         $agn_name = "";
            	     }
            	 }
            	 else
            	 {
            	     $agn_name = "";
            	 }
            	 
            	 if($da->assigned_user != "all")
            	 {
            	     if($da->assigned_user != "")
            	     {
                	     $get_user = $this->lm->get_user_name($da->assigned_user);
                	     
                	     if($usr_name != "")
                	     {
                	       $usr_name = $get_user->name;
                	     }
                	     else
                	     {
                	         $usr_name = "";
                	     }
            	     }
            	     else
            	     {
            	         $usr_name = "";
            	     }
            	 }
            	 else
            	 {
            	     $usr_name = "";
            	 }
            	 
        	    if($da->area_incharge != "all")
                {
                    if($da->area_incharge != "")
                    {
                         $ai = $this->lm->get_area_incharge($da->area_incharge);
                         
                         if($ai != null)
                         {
                           $ai = $ai->name;
                         }
                         else
                         {
                             $ai = "";
                         }
                    }
                    else
                    {
                            $ai = "";
                    }
                }
                else
                {
                     $ai = "";
                } 
                
                $action = "<a href='generate_policy?id=".$da->lead_id."' class='btn btn-primary btn-xs'><i class='fa fa-file'></i> Save policy</a>";
                
                $arr[] = array(
                           $a,
                           $client_name,
                           $da->mobile_no,
                           $da->lclass,
                           $da->p_type,
                           $da->b_type,
                           $da->policy_no,
                          "<span class='pull-right'>".number_format($da->total_own_damage,2)."</span>",
                         "<span class='pull-right'>".number_format($da->tot_liability_premium,2)."</span>",
                            "<span class='pull-right'>".number_format($da->total_premium,2)."</span>",
                         "<span class='pull-right'>".number_format($da->gst,2)."</span>",
                          $date = date_format(date_create($da->policy_issue_date),"d-m-Y"),
                           $agn_name,
                           $usr_name,
                           $ai,
                           $action,
                   );
            }
            
            $result = array(
            "draw"=> $draw,
            "recordsTotal"=> $this->lm->get_filtered_business_complete_count(),
            "recordsFiltered"=> $this->lm->get_all_business_complete_count(),
            "data"=>$arr,
            );
            echo json_encode($result);
    	}
   }
   
   	public function view_business_complete_details()
	{
	    if($this->session->has_userdata('logged_in')) 
    	{
    	    $lead_id = $this->input->post("id");
    	    $res = $this->lm->view_lead_details($lead_id);
    	    $data = $this->lm->get_vechicle_details($lead_id);
    	    $client_id = $res->client_id;
    	    $get_leads_id = $this->lm->get_leads_id($client_id);
    	    
    	    
    	    $html = "";
    	    $content_1 = "";
    	    
    	    $v_info = [];
    	    
        	    if($data != null)
        	    {
        	        if($data->policy_type == "1" && $data->policy_type == "3")
        	        {
        	          $v_info = $this->lm->get_car_details($lead_id);  
        	        }
        	        else if($data->policy_type == "2" && $data->policy_type == "4")
        	        {
        	            $v_info = $this->lm->get_bike_details($lead_id);  
        	        }
                    else if($data->policy_type == "7" || $data->policy_type == "12" || $data->policy_type == "13" || $data->policy_type == "14" || $data->policy_type == "59" || $data->policy_type == "60" || $data->policy_type == "65" || $data->policy_type == "66" || $data->policy_type == "68" || $data->policy_type == "69" || $data->policy_type == "70")
                	{
                		$v_info = $this->lm->get_pc_details($lead_id,$data->policy_type);
                	}
                	else if($data->policy_type == "8" || $data->policy_type == "9" || $data->policy_type == "10" || $data->policy_type == "15" || $data->policy_type == "16" || $data->policy_type == "61")
                	{
                		$v_info = $this->lm->get_gc_details($lead_id,$data->policy_type);
                	}
                	else if($data->policy_type == "20")
                	{
                		$v_info = $this->lm->fetch_make_misc($lead_id);
                	}
                	else if($data->policy_type == "55")
                	{
                		$v_info = $this->lm->fetch_make_scooter($lead_id);
                	}
        	    }
    	    
    	         if($res->class == "1")
        	     {
        	        $html .="<h4 style='color:#2196f3;font-family: system-ui;'><u>Vehicle Documents</u></h4><div class='row'>";
        	        
        	        foreach($get_leads_id as $da)
        	        {
        	              $documents = $this->lm->get_vechile_documents($da->id);
        	              
        	              foreach($documents as $doc)
        	              {
        	                  $html .= "<div class='col-md-3'><div class='form-group'><a href='./datas/documents/".$doc->document_file."' target='_blank'><i class='fa fa-file-pdf-o' style='font-size:48px;color:red'></i></a></div></div>";
        	              }
        	        }
        	        $html .="</div>";
        	     }
        	     else if($res->class == "10")
        	     {
        	        $content_1 .="<h4 style='color:#2196f3;font-family: system-ui;'><u>Policy Quotations</u></h4><div class='row'>";
        	       
        	        foreach($get_leads_id as $da)
        	        {
        	              $documents = $this->lm->fetch_quote_files($da->id);
        	              
        	              foreach($documents as $doc)
        	              {
        	                  $content_1 .= "<div class='col-md-3'><div class='form-group'><a href='./datas/documents/".$doc->file."' target='_blank'><i class='fa fa-file-pdf-o' style='font-size:48px;color:red'></i></a></div><span>&nbsp;".$doc->file_name."</span></div>";
        	              }
        	        }
        	        
        	        $content_1 .="</div>";
        	     }
    	  
    	        $content = "";
    	        $policy_info = $this->lm->get_temp_policy_informations($lead_id);
    	        
    	           $content .="<div class='row'>";
    	        
        	        foreach($policy_info as $p)
        	        {
        	            $content .="<h4 style='color:#2196f3;font-family: system-ui;margin-left:15px;'><u>Policy Details - ".$p->business_name." </u></h4><div class='col-md-6'>
        	                         <div class='row'>
            	                           <div class='col-md-4'>
                	                        <label>Policy No  </label>
                	                        </div>
                	                        <div class='col-md-1'> :
                	                        </div>
                	                       <div class='col-md-7'>
                	                           <p>".$p->policy_no."</p>
                	                       </div>
                	                     </div>
            	                       </div>
            	                       
                    	               <div class='col-md-6'>
                        	               <div class='row'>
                	                           <div class='col-md-4'>
                    	                          <label>Insurer Name</label>
                    	                        </div>
                    	                        <div class='col-md-1'> :</div>
                	                       <div class='col-md-7'>
                	                        <p>".$p->company_name."</p>
                	                      </div>
                	                     </div>
            	                       </div>
            	                       
                	                   <div class='col-md-6'>
                        	               <div class='row'>
                	                           <div class='col-md-4'>
                	                              <label>Business Type</label>
                	                          </div>
                    	                        <div class='col-md-1'> :</div>
                        	                   <div class='col-md-7'>
                    	                          <p>".$p->business_name."</p>
                    	                      </div>
                	                     </div>
            	                       </div>
            	                       
            	                       
            	                       <div class='col-md-6'>
                        	               <div class='row'>
                	                           <div class='col-md-4'>
                	                              <label>Premium Cover</label>
                	                          </div>
                    	                        <div class='col-md-1'> :</div>
                        	                   <div class='col-md-7'>
                    	                          <p>".$p->policy_premium_name."</p>
                    	                      </div>
                	                     </div>
            	                     </div>
            	            
                	                   <div class='col-md-6'>
                        	               <div class='row'>
                	                           <div class='col-md-4'>
                	                             <label>Class</label>
                	                            </div>
                	                             <div class='col-md-1'> :</div>
                    	                    <div class='col-md-7'>
                	                        <p>".$p->class_name."</p>
                	                       </div>
                	                     </div>
            	                       </div>
                	                   
                	                  <div class='col-md-6'>
                        	               <div class='row'>
                	                           <div class='col-md-4'>
                	                                <label>Policy Type</label>
                	                           </div>
                	                          <div class='col-md-1'> :</div>
                    	                    <div class='col-md-7'>
                	                           <p>".$p->policy_type."</p>
                	                        </div>
                	                     </div>
            	                       </div>
            	                       
            	                       
            	                       <div class='col-md-6'>
                        	               <div class='row'>
                	                           <div class='col-md-4'>
                	                              <label>Policy Start Date</label>
                	                             </div>
                	                         <div class='col-md-1'> :</div>
                    	                       <div class='col-md-7'>
                	                             <p>".date_format(date_create($p->policy_s_date),"d-M-Y")."</p>
                	                      </div>
                	                     </div>
            	                       </div>
            	                       
            	                       <div class='col-md-6'>
                        	               <div class='row'>
                	                           <div class='col-md-4'>
                	                              <label>Policy Exp Date</label>
                	                             </div>
                	                         <div class='col-md-1'> :</div>
                    	                       <div class='col-md-7'>
                	                             <p>".date_format(date_create($p->policy_ex_date),"d-M-Y")."</p>
                	                      </div>
                	                     </div>
            	                       </div>
                	                   
                	                    <div class='col-md-6'>
                        	               <div class='row'>
                	                           <div class='col-md-4'>
                	                              <label>Sum Insured</label>
                	                             </div>
                	                         <div class='col-md-1'> :</div>
                    	                       <div class='col-md-7'>
                	                             <p>".number_format($p->sum_insured,2)."</p>
                	                      </div>
                	                     </div>
            	                       </div>";
            	                       
            	                       
            	                       if($res->class == "1")
            	                       {
                    	                   $content .="<div class='col-md-6'>
                                	               <div class='row'>
                        	                           <div class='col-md-4'>
                        	                              <label>Total Own Damage</label>
                        	                             </div>
                        	                         <div class='col-md-1'> :</div>
                                	                   <div class='col-md-7'>
                            	                        <p>".number_format($p->total_own_damage,2)."</p>
                            	                       </div>
                        	                     </div>
                    	                       </div>
                    	                       
                    	                            
                    	                    <div class='col-md-6'>
                            	               <div class='row'>
                    	                           <div class='col-md-4'>
                    	                              <label>Total Tp</label>
                    	                           </div>
                    	                        <div class='col-md-1'> :</div>
                        	                       <div class='col-md-7'>
                    	                        <p>".number_format($p->basic_tp,2)."</p>
                    	                       </div>
                    	                     </div>
                	                       </div>";
            	                       }
            	                  
                	                 $content .="<div class='col-md-6'>
                        	               <div class='row'>
                	                           <div class='col-md-4'>
                	                               <label>Net Premium </label>
                	                            </div>
                	                        <div class='col-md-1'> :</div>
                    	                       <div class='col-md-7'>
                	                        <p>".number_format($p->total_premium,2)."</p>
                	                      </div>
                	                     </div>
            	                       </div>
            	                       
                	                   <div class='col-md-6'>
                        	               <div class='row'>
                	                         <div class='col-md-4'>
                	                             <label>GST</label>
                	                        </div>
                	                        <div class='col-md-1'> :</div>
                    	                       <div class='col-md-7'>
                	                        <p>".number_format($p->gst,2)."</p>
                	                       </div>
                	                     </div>
            	                       </div>
            	                       
            	                       <div class='col-md-6'>
                        	               <div class='row'>
                	                         <div class='col-md-4'>
                	                             <label>Agent/ Pos Code </label>
                	                        </div>
                	                        <div class='col-md-1'> :</div>
                    	                       <div class='col-md-7'>
                	                        <p>".$p->agent_pos_code."</p>
                	                       </div>
                	                     </div>
            	                       </div>
            	                       <hr/>";
        	        }
        	        
        	         $content .="</div>";
        	         
        	        $policy_docs ="<h4 style='color:#2196f3;font-family: system-ui;'><u>Policy Documents</u></h4>";
        	        
        	        $policy_docs .="<div class='row'>";
        	        
            	          $documents = $this->lm->get_policy_documents($lead_id);
        	              
        	              foreach($documents as $doc)
        	              {
        	                  $policy_docs .= "<div class='col-md-3'><div class='form-group'><a href='./datas/documents/".$doc->document."' target='_blank'><i class='fa fa-file-pdf-o' style='font-size:48px;color:red'></i></a></div></div>";
        	              }
        	        $policy_docs .="</div>";
    	           echo json_encode(array("p_info"=>$res,"v_info" =>$v_info,"docs"=>$html,"sme_quote" =>$content_1,"policy_info"=>$content,"policy_docs" =>$policy_docs));
    	}
	}
	
	
     	public function fetch_sme_policy_details()
	    {
	        if($this->session->has_userdata('logged_in'))
    	    {
    	        $sme_id = $this->input->post("sme_id");
    	        $res = $this->lm->fetch_sme_policy_details($sme_id);
    	        echo json_encode($res);
    	    }
	    }
	    
	    
	public function save_sme_details()
	{
		if($this->session->has_userdata('logged_in')) 
    	{   
    	    $smepolicy = $this->input->post("smepolicy");
    	    $lead_id = $this->input->post("lead_id");
    	    $ins_period_from =$this->input->post("ins_period_from");
    		$ins_period_todate = $this->input->post("ins_period_todate");
    		$occupancy =$this->input->post("occupancy");
    		$commodity =$this->input->post("commodity");
    		$transport =$this->input->post("transport");
    		$packing =$this->input->post("packing");
    		$b_valuation_import =$this->input->post("b_valuation_import");
    		$b_valuation_inland =$this->input->post("b_valuation_inland");
    		$voyage_export =$this->input->post("voyage_export");
    		$voyage_import =$this->input->post("voyage_import");
    		$voyage_inland =$this->input->post("voyage_inland");
    		$turnover =$this->input->post("turnover");
    		$initial_sum_insured =$this->input->post("initial_sum_insured");
    		$sales_domestic =$this->input->post("sales_domestic");
    		$purchase_import =$this->input->post("purchase_import");
    		$purchase_domestic =$this->input->post("purchase_domestic");
    		$bottomlimit =$this->input->post("bottomlimit");
    		$locationimport =$this->input->post("locationimport");
    		$bottom_import_limit =$this->input->post("bottom_import_limit");
    		$location_import_limit =$this->input->post("location_import_limit");
    		$current_insurer =$this->input->post("current_insurer");
    		$claim_history =$this->input->post("claim_history");
    		$date =$this->input->post("date");
    		
    		$fire_from_date =$this->input->post("fire_from_date");
    		$fire_to_date =$this->input->post("fire_to_date");
    		$fire_occupancy =$this->input->post("fire_occupancy");
    		$commodity =$this->input->post("commodity");
    		$financial_institution =$this->input->post("financial_institution");
    		$fire_particulars_1 =$this->input->post("fire_particulars_1");
    		$fire_sum_ins_1 =$this->input->post("fire_sum_ins_1");
    		$burglary_sum_ins_1 =$this->input->post("burglary_sum_ins_1");
    		$fire_particulars_2 =$this->input->post("fire_particulars_2");
    		$fire_sum_ins_2 =$this->input->post("fire_sum_ins_2");
    		$burglary_sum_ins_2 =$this->input->post("burglary_sum_ins_2");
    		$fire_particulars_3 =$this->input->post("fire_particulars_3");
    		$fire_sum_ins_3 =$this->input->post("fire_sum_ins_3");
    		$burglary_sum_ins_3 =$this->input->post("burglary_sum_ins_3");
    		$fire_particulars_4 =$this->input->post("fire_particulars_4");
    		$fire_sum_ins_4 =$this->input->post("fire_sum_ins_4");
    		$burglary_sum_ins_4 =$this->input->post("burglary_sum_ins_4");
    		$clause_under_burglary =$this->input->post("clause_under_burglary");
    		$fire_expiry_insurer =$this->input->post("fire_expiry_insurer");
    		$fire_date =$this->input->post("fire_date");
    		
    		//wc compensation
    		$pre_no_of_emp = $this->input->post("pre_no_of_emp");
            $cur_no_of_emp = $this->input->post("cur_no_of_emp");
            $wc_claim_paid = $this->input->post("wc_claim_paid");
            $wc_tot_claim = $this->input->post("wc_tot_claim");
            $wc_premium_paid = $this->input->post("wc_premium_paid");
            $wc_out_claim = $this->input->post("wc_out_claim");
            $wc_last_claim = $this->input->post("wc_last_claim");
            $wc_wages_per_mon = $this->input->post("wc_wages_per_mon");
            $wc_no_supervisor = $this->input->post("wc_no_supervisor");
            $wc_no_site_engineer = $this->input->post("wc_no_site_engineer");
            $wc_salary_per_supervisor = $this->input->post("wc_salary_per_supervisor");
            $wc_salary_engineer = $this->input->post("wc_salary_engineer");
            
            //GMC
            
            $gmc_current_status = $this->input->post("gmc_current_status");
        	$gmc_cur_ins = $this->input->post("gmc_cur_ins");
        	$gmc_premium_date = $this->input->post("gmc_premium_date");
        	$gmc_renewal_tot = $this->input->post("gmc_renewal_tot");
        	$gmc_period_of_ins = $this->input->post("gmc_period_of_ins");
        	$gmc_premium_inscep = $this->input->post("gmc_premium_inscep");
        	$gmc_total_lives = $this->input->post("gmc_total_lives");
        	$gmc_incurred_claims = $this->input->post("gmc_incurred_claims");
        	$gmc_sum_ins_app = $this->input->post("gmc_sum_ins_app");
        	$gmc_family_def = $this->input->post("gmc_family_def");
        	$gmc_exclusion_waiver_year = $this->input->post("gmc_exclusion_waiver_year");
        	$gmc_maternity_coverage = $this->input->post("gmc_maternity_coverage");
        	$gmc_hospital_coverage = $this->input->post("gmc_hospital_coverage");
        	$gmc_icu_limits = $this->input->post("gmc_icu_limits");
        	$gmc_int_desease_cover = $this->input->post("gmc_int_desease_cover");
        	$gmc_ppn_cause = $this->input->post("gmc_ppn_cause");
        	$gmc_claim_sub_mission = $this->input->post("gmc_claim_sub_mission");
        	$gmc_lasik_surgery = $this->input->post("gmc_lasik_surgery");
        	$gmc_corporate_buffer = $this->input->post("gmc_corporate_buffer");
        	$gmc_cataract_surgery = $this->input->post("gmc_cataract_surgery");
        	$gmc_comorbities = $this->input->post("gmc_comorbities");
        	$gmc_metail_illness = $this->input->post("gmc_metail_illness");
        	$gmc_addition = $this->input->post("gmc_addition");
        	$gmc_current_status = $this->input->post("gmc_current_status");
        	$gmc_covid_hospitlization = $this->input->post("gmc_covid_hospitlization");
        	$gmc_day_care = $this->input->post("gmc_day_care");
        	$gmc_sum_ins = $this->input->post("gmc_sum_ins");
        	$gmc_policy_type = $this->input->post("gmc_policy_type");
        	$gmc_exclusion_wavier = $this->input->post("gmc_exclusion_wavier");
        	$gmc_child_day_cover = $this->input->post("gmc_child_day_cover");
        	$gmc_room_rent = $this->input->post("gmc_room_rent");
        	$gmc_sub_limits = $this->input->post("gmc_sub_limits");
        	$gmc_ext_desease_cover = $this->input->post("gmc_ext_desease_cover");
        	$gmc_claim_int = $this->input->post("gmc_claim_int");
        	$gmc_int_capping = $this->input->post("gmc_int_capping");
        	$gmc_ayush_treatment = $this->input->post("gmc_ayush_treatment");
        	$gmc_robotic = $this->input->post("gmc_robotic");
        	$gmc_ambulance = $this->input->post("gmc_ambulance");
        	$gmc_sinus_surgery = $this->input->post("gmc_sinus_surgery");
        	$gmc_age_macular = $this->input->post("gmc_age_macular");
        	$gmc_terroism_deases = $this->input->post("gmc_terroism_deases");
        	$gmc_special_coverage = $this->input->post("gmc_special_coverage");
            
           
    
        	if($smepolicy == "74")
        	{ 	
        		$data = array(
        		              "sme_id" => $smepolicy,
        		              "lead_id" =>$lead_id,
        		              "ins_period_from"=>$ins_period_from,
        		              "ins_period_todate"=>$ins_period_todate, 
        		              "occupancy" => $occupancy,
        		              "commodity" =>$commodity, 
        		              "transport" =>$transport,
        		              "packing" =>$packing,
        		              "b_valuation_import"=>$b_valuation_import,
        		              "b_valuation_inland"=>$b_valuation_inland,
        		              "transport"=>$transport,
        		              "voyage_export"=>$voyage_export,
        		              "voyage_import"=>$voyage_import,
        		              "voyage_inland"=>$voyage_inland,
        		              "turnover"=>$turnover,
        		              "initial_sum_insured"=>$initial_sum_insured,
        		              "sales_domestic" =>$sales_domestic,
        		              "purchase_import" =>$purchase_import,
        		              "bottomlimit"=>$bottomlimit,
        		              "bottom_import_limit"=>$bottom_import_limit,
        		              "location_import_limit"=>$location_import_limit,
        		              "locationimport" =>$locationimport,
        		              "current_insurer"=>$current_insurer,
        		              "claim_history" => $claim_history,
        		              "date" => $date);
        		              
        	    	$res =$this->lm->add_sme_maraine_details($data);
        	    	if( $res ){
    	                $this->audit->log('sme_marine_details', 'INSERT', null, null, $data);
    	            }
        	    	
        	}
        	else if($smepolicy == "78")
        	{ 
        	     $data =array(
                		        "sme_id" => $smepolicy,
                		        "lead_id" =>$lead_id,
                		        "fire_from_date" =>$fire_from_date,
                		        "fire_to_date" =>$fire_to_date,
                		        "fire_occupancy" =>$fire_occupancy,
                		        "financial_institution" =>$financial_institution,
                		        "fire_particulars_1" =>$fire_particulars_1,
                		        "burglary_sum_ins_1" =>$burglary_sum_ins_1,
                		        "fire_particulars_2" =>$fire_particulars_2,
                		        "fire_sum_ins_2" => $fire_sum_ins_2,
                		        "burglary_sum_ins_3" => $burglary_sum_ins_3,
                		        "fire_particulars_3" => $fire_particulars_3,
                		        "fire_sum_ins_3" => $fire_sum_ins_3,
                		        "burglary_sum_ins_3"=>$burglary_sum_ins_3,
                		        "fire_particulars_4" =>$fire_particulars_4,
                		        "fire_sum_ins_4" =>$fire_sum_ins_4,
                		        "burglary_sum_ins_4" =>$burglary_sum_ins_4,
                		        "clause_under_burglary"=>$clause_under_burglary,
                		        "fire_expiry_insurer" =>$fire_expiry_insurer,
                		        "fire_date" =>$fire_date
                		             );
                		      $res = $this->lm->add_sme_fire_and_burgulary($data);
                		      if( $res ){
            	                 $this->audit->log('sme_fire_and_burgulary', 'INSERT', null, null, $data);
            	              }
                		      
        	}
	        else if($smepolicy == "77")
	        {
	            $data = array(
	                           "sme_id" =>$smepolicy,
	                           "lead_id" =>$lead_id,
	                           "pre_no_of_employee" =>$pre_no_of_emp,
	                           "cur_no_of_employee" =>$cur_no_of_emp,
	                           "claim_paid" =>$wc_claim_paid,
	                           "outstanding_claim" =>$wc_out_claim,
	                           "total_claim" =>$wc_tot_claim,
	                           "last_three_yrs_claim" =>$wc_premium_paid,
	                           "premium_paid" =>$wc_premium_paid,
	                           "wages_per_emp" =>$wc_wages_per_mon,
	                           "salary_per_supervisor" =>$wc_salary_per_supervisor,
	                           "no_of_engineer" =>$wc_no_site_engineer,
	                           "salary_site_engineer" =>$wc_salary_engineer,
	                           "created_by" =>$this->session->userdata("session_id"),
	                           "created_date" =>date("Y-m-d H:i:s"));
	                           
	            $res = $this->lm->add_workman_compensation_details($data);
	            if( $res ){
	                 $this->audit->log('sme_workman_compensation', 'INSERT', null, null, $data);
	             }
	        }
	        else if($smepolicy == "75")
	        {
               $data = array(
                 "sme_id" => $smepolicy,
        		 "lead_id" =>$lead_id,
                "gmc_current_status" =>$gmc_current_status,
                "gmc_cur_ins" =>$gmc_cur_ins,
                "gmc_premium_date" =>$gmc_premium_date,
                "gmc_renewal_tot" =>$gmc_renewal_tot,
                "gmc_period_of_ins" =>$gmc_period_of_ins,
                "gmc_premium_inscep" =>$gmc_premium_inscep,
                "gmc_total_lives" =>$gmc_total_lives,
                "gmc_incurred_claims" =>$gmc_incurred_claims,
                "gmc_sum_ins_app" =>$gmc_sum_ins_app,
                "gmc_family_def" =>$gmc_family_def,
                "gmc_exclusion_waiver_year" =>$gmc_exclusion_waiver_year,
                "gmc_maternity_coverage" =>$gmc_maternity_coverage,
                "gmc_hospital_coverage" =>$gmc_hospital_coverage,
                "gmc_icu_limits" =>$gmc_icu_limits,
                "gmc_int_desease_cover" =>$gmc_int_desease_cover,
                "gmc_ppn_cause" =>$gmc_ppn_cause,
                "gmc_claim_sub_mission" =>$gmc_claim_sub_mission,
                "gmc_lasik_surgery" =>$gmc_lasik_surgery,
                "gmc_corporate_buffer" =>$gmc_corporate_buffer,
                "gmc_cataract_surgery" =>$gmc_cataract_surgery,
                "gmc_comorbities" =>$gmc_comorbities,
                "gmc_metail_illness" =>$gmc_metail_illness,
                "gmc_addition" =>$gmc_addition,
                "gmc_current_status" =>$gmc_current_status,
                "gmc_covid_hospitlization" =>$gmc_covid_hospitlization,
                "gmc_day_care" =>$gmc_day_care,
                "gmc_sum_ins" =>$gmc_sum_ins,
                "gmc_policy_type" =>$gmc_policy_type,
                "gmc_exclusion_wavier" =>$gmc_exclusion_wavier,
                "gmc_child_day_cover" =>$gmc_child_day_cover,
                "gmc_room_rent" =>$gmc_room_rent,
                "gmc_sub_limits" =>$gmc_sub_limits,
                "gmc_ext_desease_cover" =>$gmc_ext_desease_cover,
                "gmc_claim_int" =>$gmc_claim_int,
                "gmc_int_capping" =>$gmc_int_capping,
                "gmc_ayush_treatment" =>$gmc_ayush_treatment,
                "gmc_robotic" =>$gmc_robotic,
                "gmc_ambulance" =>$gmc_ambulance,
                "gmc_sinus_surgery" =>$gmc_sinus_surgery,
                "gmc_age_macular" =>$gmc_age_macular,
                "gmc_terroism_deases" =>$gmc_terroism_deases,
                "gmc_special_coverage" =>$gmc_special_coverage,
                "created_date" =>date("Y-m-d H:i:s"),
                "created_by" =>$this->session->userdata("session_id"),
                );
                
              $res = $this->lm->add_gmc_details($data);
              if( $res ){
                 $this->audit->log('sme_gmc_details', 'INSERT', null, null, $data);
              }
	        }
		    echo "success";
	   }
	   
	}
	   public function upload_sme_files()
	   {
    	   if($this->session->has_userdata('logged_in')) 
        	{ 
                    $file_type = $this->input->post("file_name");
                    $count = count($_FILES['files']['name']);
                    $lead_id = $this->input->post("lead_id");
                    $data = array();
                    for($i=0;$i<$count;$i++)
                    {
                          if(!empty($_FILES['files']['name'][$i]))
                          {
                                $_FILES['file']['name'] = $_FILES['files']['name'][$i];
                                $_FILES['file']['type'] = $_FILES['files']['type'][$i];
                                $_FILES['file']['tmp_name'] = $_FILES['files']['tmp_name'][$i];
                                $_FILES['file']['size'] = $_FILES['files']['size'][$i];
                                $config['upload_path'] = './datas/sme_quotes/'; 
                                $config['allowed_types'] = '*';
                                $config['file_name'] = $_FILES['files']['name'][$i];
                                
                                $this->load->library('upload',$config); 
                                
                                if($this->upload->do_upload('file'))
                                {
                                    $uploadData = $this->upload->data();
                                    $filename = $uploadData['file_name'];
                                    $data0 = array("lead_id" =>$lead_id,"file" =>$filename,"file_name" =>$file_type[$i]);
                                    $res0 = $this->lm->add_sme_files($data0);
                                    if( $res0 ){
                    	                $this->audit->log('sme_quote_files', 'INSERT', null, null, $data0);
                    	            }
                                }
                           }
                    }
                
                echo "<script>alert('File Uploaded Successfully');window.location.href='create_lead?id=$lead_id'</script>";
        	}
	   }
	   
	   
	   public function fetch_quote_files()
	   {
	        if($this->session->has_userdata('logged_in')) 
        	{
        	    $lead_id = $this->input->post("lead_id");
        	    
        	    $res = $this->lm->fetch_quote_files($lead_id);
        	    
        	    $content = "";
        	    
        	    $content .= "<div class='row'>";
        	    
        	    foreach($res as $da)
        	    {
        	         $content .= "<div class='col-md-4'>
        	                       <div class = 'form-group'>
        	                         <a href= './datas/sme_quotes/".$da->file."' target='_blank'>&nbsp;&nbsp;<i class='fa fa-file fa-4x'></i><span>&nbsp;&nbsp;".$da->file_name."</span></a>
        	                      </div></div>";
        	    }
        	    
        	    $content .= "</div>";
        	    
        	    echo $content;
        	}
	   }
	   
	   public function fetch_total_premium()
	   {
	        if($this->session->has_userdata('logged_in')) 
        	{
        	    $lead_id = $this->input->post("lead_id");
        	   $res = $this->lm->get_policy_details($lead_id);
        	    if(empty($res)){
        	        $res = $this->lm->get_total_premium($lead_id);
        	    }
        	    echo json_encode($res);
        	}
	   }
	   
	  public function add_sme_commission()
	  {
            if($this->session->has_userdata('logged_in')) 
            {
                $request        = $this->input->post();
                $own_com_amt    = $this->input->post("own_com_amt");
                $orc_com_amt    = $this->input->post("orc_com_amt");
                $agn_com_amt    = $this->input->post("agn_com_amt");
                $ai_com_amt     = $this->input->post("ai_com_amt");
                $sub_agn_1      = $this->input->post("sub_agn_1");
                $sub_agn_2      = $this->input->post("sub_agn_2");
                $sub_agn_amt1   = $this->input->post("sub_agn_amt1");
                $sub_agn_amt2   = $this->input->post("sub_agn_amt2");
                $lead_id        = $this->input->post("lead_id");
                $policy_no      = $this->input->post("policy_no");
               
                    if(!$this->lm->check_this_policy_already_exits($policy_no))
                    {
                                $check = $this->lm->check_lead_id_already_exits_in_policy($lead_id);
                                
                                if($check > 0)
                                {
                                    echo "Exits";
                                    $data0 = array("lead_type" =>"2","lead_status" =>"completed");
                                    $old_data = $this->lm->get_receiver_email_id($lead_id);
                                    $res0 = $this->lm->update_policy_status($data0,$lead_id);
                                    if($res0){
                                        $this->audit->log('list_of_leads', 'UPDATE', null, $old_data, $data0);
                                    }
                                }
                                else
                                {
                                    $res = $this->lm->save_policy_data($lead_id);
                                    
                                    $data0 = array("lead_type" =>"2","lead_status" =>"completed");
                                    $old_data = $this->lm->get_receiver_email_id($lead_id);
                                    $res0 = $this->lm->update_policy_status($data0,$lead_id);
                                    if($res0){
                                        $this->audit->log('list_of_leads', 'UPDATE', null, $old_data, $data0);
                                    }
                                    if($res)
                                    {
                                        $data = array(
                                                     "own_commission_amt" =>$own_com_amt,
                                                     "own_commission" =>$orc_com_amt,
                                                     "agent_commission_amt" =>$agn_com_amt,
                                                     "ai_com" =>$ai_com_amt,
                                                     "sub_agn_1" =>$sub_agn_1,
                                                     "sub_agn_2" =>$sub_agn_2,
                                                     "sub_agn_amt_1" =>$sub_agn_amt1,
                                                     "sub_agn_amt_2" =>$sub_agn_amt2,
                                                 );
                                         $_policies = $this->lm->get_policy_details($lead_id);
                                         $res = $this->lm->update_sme_commission($data,$lead_id);
                                         if($res){
                        	                 $this->audit->log('policy_info', 'UPDATE', null, $_policies, $data);
                        	             }
                        	             $this->acc_own_commission_ledg($lead_id);
                                         $this->acc_agn_commission_ledg($lead_id);
                                         echo "success";
                                    }
                                }
                    }
                    else
                    {
                        // echo "Exits";
                        $check = $this->lm->check_ac_policy_no_already_exits($policy_no);
                        $check0 = $this->lm->check_ac_policy_no_already_exits_orc($policy_no);
                        if($check < 1) {
                            $this->acc_own_commission_ledg($lead_id);    
                            $this->acc_agn_commission_ledg($lead_id);                
                        }
                        echo $this->update_sme_commission($request);
                        
                    }
            }
	  }
	  
    function update_sme_commission($request) {
        $status = "Exits";
        if( isset( $request ) && !empty( $request ) ){
            extract($request);
            
            //$check = $this->lm->IsBilledPolicy($lead_id);
            $data = [];
            $check_agn = $this->lm->IsBilledPolicy($lead_id);
            if($check_agn) {
                $data['agent_commission_amt'] = $agn_com_amt;
                $data['ai_com']                 = $ai_com_amt;
                $data['sub_agn_1']              = $sub_agn_1;
                $data['sub_agn_2']              = $sub_agn_2;
                $data['sub_agn_amt_1']          = $sub_agn_amt1;
                $data['sub_agn_amt_2']          = $sub_agn_amt2;
            }

            $check_com = $this->lm->IsCompanyBilledPolicy($lead_id);
            if($check_com) {
                $data['own_commission_amt'] = $own_com_amt;
                $data['own_commission']     = $orc_com_amt;
            }
                        
            if($data) {
                /*$data = array(
                    "own_commission_amt" =>$own_com_amt,
                    "agent_commission_amt" =>$agn_com_amt,
                    "ai_com" =>$ai_com_amt,
                    "sub_agn_1" =>$sub_agn_1,
                    "sub_agn_2" =>$sub_agn_2,
                    "sub_agn_amt_1" =>$sub_agn_amt1,
                    "sub_agn_amt_2" =>$sub_agn_amt2,
                    "commission_status" => "1"
                );*/
                
                $data['commission_status'] = 1;
                $_policies = $this->lm->get_policy_details($lead_id);
                $res = $this->lm->update_sme_commission($data,$lead_id);
                if($res){
	                 $this->audit->log('policy_info', 'UPDATE', null, $_policies, $data);
	                 if( $check_agn) {
                        // Jantha Agent Commission                                                
                        //Credit
                        $agc_credit = array(
                            'credit'=>$agn_com_amt,
                        );
                        
                        $agc_credit_data = $this->cm->getAccountsByLead($lead_id, 'Agent commission Credit', 'acc_commission_ledger');
                    
                        $agc_credit_res = $this->cm->accouts_update($agc_credit,'jayantha',$lead_id,'Agent commission Credit');
                        
                        if( $agc_credit_res ) {
                            $this->audit->log('acc_commission_ledger', 'UPDATE', null, $agc_credit_data, $agc_credit);
                        }
                        
                        //Debit
                        $agc_debit = array(
                            'debit'=>$agn_com_amt,
                        );
                        $agc_debit_data = $this->cm->getAccountsByLead($lead_id, 'Own commission Debit', 'acc_commission_ledger');
                    
                        $agc_credit_res = $this->cm->accouts_update($agc_debit,'jayantha',$lead_id,'Own commission Debit');
                        
                        if( $agc_credit_res ) {
                            $this->audit->log('acc_commission_ledger', 'UPDATE', null, $agc_debit_data, $agc_debit);
                        }
                        
                        // Unicorn Agent Commission
                        //Credit
                        $agc_credit = array(
                            'credit'=>0,
                        );
                        
                        $oagc_credit_data = $this->cm->getAccountsByLead($lead_id, 'Agent commission Credit', 'acc_commission_ledger_orc');
                    
                        $oagc_credit_res = $this->cm->accouts_update($agc_credit,'unicorn',$lead_id,'Agent commission Credit');
                        
                        if( $agc_credit_res ) {
                            $this->audit->log('acc_commission_ledger_orc', 'UPDATE', null, $oagc_credit_data, $agc_credit);
                        }
                        
                        //Debit
                        $agc_debit = array(
                            'debit'=>0,
                        );
                        
                        $oagc_debit_data = $this->cm->getAccountsByLead($lead_id, 'Own commission Debit', 'acc_commission_ledger_orc');
                    
                        $oagc_debit_res = $this->cm->accouts_update($agc_debit,'unicorn',$lead_id,'Own commission Debit');
                        
                        if( $oagc_debit_res ) {
                            $this->audit->log('acc_commission_ledger_orc', 'UPDATE', null, $oagc_debit_data, $agc_debit);
                        }
                    }
                    
                    if($check_com) {
                        // Jantha Own Commission
                        // Credit
                        $com_credit = array(
                            'credit'=>$own_com_amt,
                        );
                        
                        $com_credit_data = $this->cm->getAccountsByLead($lead_id, 'Own commission Credit', 'acc_commission_ledger');
                    
                        $com_credit_res = $this->cm->accouts_update($com_credit,'jayantha',$lead_id,'Own commission Credit');
                        
                        if( $com_credit_res ) {
                            $this->audit->log('acc_commission_ledger', 'UPDATE', null, $com_credit_data, $com_credit);
                        }
                        
                        
                        // Unicorn Own Commission
                        // Credit
                        $com_credit = array(
                            'credit'=>$orc_com_amt,
                        );
                        $ocom_credit_data = $this->cm->getAccountsByLead($lead_id, 'Own commission Credit', 'acc_commission_ledger_orc');
                    
                        $ocom_credit_res = $this->cm->accouts_update($com_credit,'unicorn',$lead_id,'Own commission Credit');
                        
                        if( $ocom_credit_res ) {
                            $this->audit->log('acc_commission_ledger_orc', 'UPDATE', null, $ocom_credit_data, $com_credit);
                        }
                        
                    }
	             }
                $status = "success";
            }
        }
        
        return $status;
    }
	  
	  // acc own commission
	  
	  public function acc_own_commission_ledg($lead_id)
	  {
           if($this->session->has_userdata('logged_in')) 
           {
                    $res = $this->lm->get_policy_details($lead_id);
                    $own_com_id = "acc21";
                    $own_com = 0;
                    $total_irda = 0;
                    $total_orc = 0;
                           
                    $date = date("Y-m-d H:i:s");
                    $year = date('y');
                    $month = date('m');
                    
                    if($month < 4)
                    {
                        $year = $year-1;
                    }
                    /*
                    $x = 0;
                    
                    do 
                    {
                        $x++;
                        $new_sr_no = "OC/".$x."/".$year;
                    } 
                    while($this->lm->check_sr_no_already_exits($new_sr_no));
                    */
                    $sr_no = $this->lm->getMaxSRNo('OC');
                    $new_sr_no =  "OC/{$sr_no}/".$year;
                       
                    $res0 = $this->lm->get_commission_details($res->commission_id);
                    
                    if($res0 != "" || $res0 != null)
                    {
                        $irda_od_percentage = (isset($res0->ird_od_commission) && ($res0->ird_od_commission) > 0) ? $res0->ird_od_commission : 0;
        		        $irda_tp_percentage = (isset($res0->ird_tp_commission) && ($res0->ird_tp_commission) > 0) ? $res0->ird_tp_commission : 0;    
        		        
                       if($res0->own_od == "0.00" && $res0->own_tp == "0.00" && $res0->on_net != "0.00")
                       {
                        //   $irda_od_percentage = 15;
                        //   $irda_tp_percentage = 2.5;
                           $od = $res->total_own_damage;
                           $tp = $res->tot_liability_premium;
                           $irda_od = $res->total_own_damage * $irda_od_percentage/100;
                           $irda_tp = $res->tot_liability_premium * $irda_tp_percentage/100;
                           $total_irda = $irda_od + $irda_tp;
                           $total_orc = $res->own_commission_amt + $res->own_commission - $total_irda;
                       }
                       else if($res0->own_od != "0.00" && $res0->own_tp != "0.00" && $res0->on_net == "0.00")
                       {
                        //   $irda_od_percentage = 15;
                        //   $irda_tp_percentage = 2.5;
                           $od = $res->total_own_damage;
                           $tp = $res->tot_liability_premium;
                           $irda_od = $res->total_own_damage * $irda_od_percentage/100;
                           $irda_tp = $res->tot_liability_premium * $irda_tp_percentage/100;
                           $total_irda = $irda_od + $irda_tp;
                           $total_orc = $res->own_commission_amt + $res->own_commission - $total_irda;
                       }
                       else if($res0->own_od != "0.00" && $res0->own_tp == "0.00" && $res0->on_net == "0.00")
                       {
                        //   $irda_od_percentage = 15;
                           $od = $res->total_own_damage;
                           $irda_od = $res->total_own_damage * $irda_od_percentage/100;
                           $total_irda = $irda_od;
                           $total_orc = $res->own_commission_amt + $res->own_commission - $total_irda;
                       }
                       else if($res0->own_od == "0.00" && $res0->own_tp != "0.00" && $res0->on_net == "0.00")
                       {
                        //   $irda_tp_percentage = 2.5;
                           $tp = $res->tot_liability_premium;
                           $irda_tp = $res->tot_liability_premium * $irda_tp_percentage/100;
                           $total_irda = $irda_tp;
                           $total_orc = $res->own_commission_amt + $res->own_commission - $total_irda;
                       }
                     
                       
                    }
                    
                    if($res->class == "10") { // sme policy
                        $total_irda = $res->own_commission_amt;
                        $total_orc  = $res->own_commission;
                    }
                    
                    if($res != "" || $res != null)
                    {
                       $check = $this->lm->check_ac_policy_no_already_exits($res->policy_no);
                       $check0 = $this->lm->check_ac_policy_no_already_exits_orc($res->policy_no);
                       
                       $ins_ledger = $this->lm->fetch_insurance_company_ledger_main($res->company);
                       $ins_ledger_orc = $this->lm->fetch_insurance_company_ledger_orc($res->company);
                    
                       if($check < 1)
                       {
                            $data_irda = array(
                                "sr_no" =>$new_sr_no,
                                "credit"=>floor($total_irda),
                                "cr_parent_id" =>$own_com_id,
                                "dr_parent_id" =>$ins_ledger->vchaccid,
                                "tds" =>0,
                                "lead_id"=>$lead_id,
                                "sub_id" =>$res->policy_no,
                                "insurer_id" =>$res->company,
                                "note" =>"Own commission Credit",
                                "datetime" =>date("Y-m-d H:i:s")
                                );
                            $res0 = $this->lm->add_acc_own_commission($data_irda);
                            if( $res0 ){
            	                 $this->audit->log('acc_commission_ledger', 'INSERT', null, null, $data_irda);
            	             }
                       }  
                       
                       if($check0 < 1)
                       {
                            $data_orc = array(
                                    "sr_no" =>$new_sr_no,
                                    "credit"=>floor($total_orc),
                                    "cr_parent_id" =>$own_com_id,
                                    "dr_parent_id" =>$ins_ledger_orc->vchaccid,
                                    "tds" =>0,
                                    "lead_id"=>$lead_id,
                                    "sub_id" =>$res->policy_no,
                                    "insurer_id" =>$res->company,
                                    "note" =>"Own commission Credit",
                                    "datetime" =>date("Y-m-d H:i:s")
                                    );
                            $res1 = $this->lm->add_acc_own_commission_orc($data_orc);
                            if( $res1 ){
            	                 $this->audit->log('acc_commission_ledger_orc', 'INSERT', null, null, $data_orc);
            	             }
                       }
                    }
                }
	  }
	  
	  public function acc_agn_commission_ledg($lead_id)
	  {
	      if($this->session->has_userdata('logged_in')) 
          {    
                    $res = $this->lm->get_policy_details($lead_id);
                    $own_com_id = "acc21";
                    $agn_com_id = "acc42";
                    $total_irda = 0;
                    $total_orc = 0;
                    $tds = 0;
                    
                    $date = date("Y-m-d H:i:s");
                    $year = date('y');
                    $month = date('m');
                    
                    if($month < 4)
                    {
                        $year = $year-1;
                    }
                    /*
                    $x = 0;
                    do 
                    {
                        $x++;
                        $new_sr_no = "AC/".$x."/".$year;
                    } 
                    while($this->lm->check_sr_no_already_exits($new_sr_no));
                    */
                    
                    $sr_no = $this->lm->getMaxSRNo('AC');
                    $new_sr_no =  "AC/{$sr_no}/".$year;
                    
                    $res0 = $this->lm->get_commission_details($res->commission_id);
                    $agn_category = $this->lm->fetch_agent_category($res->policy_agency_pos);
                
                    if($res0 != "" || $res0 != null)
                    {
                        $irda_od_percentage = (isset($res0->ird_od_commission) && ($res0->ird_od_commission) > 0) ? $res0->ird_od_commission : 0;
                        $irda_tp_percentage = (isset($res0->ird_tp_commission) && ($res0->ird_tp_commission) > 0) ? $res0->ird_tp_commission : 0;    
        		            
                        if($res0->agn_com_type == "ON-NET")
                        {
                        //   $irda_od_percentage = 15;
                           $od = $res->total_own_damage;
                           $tp = $res->tot_liability_premium;
                           $total_irda = $res->total_own_damage * $irda_od_percentage/100;
                           $total_orc = $res->agent_commission_amt + $res->agent_commission - $total_irda;
                        }
                        else if($res0->agn_com_type == "OD_AND_TP")
                        {
                        //   $irda_od_percentage = 15;
                           $od = $res->total_own_damage;
                           $tp = $res->tot_liability_premium;
                           $total_irda = $res->total_own_damage * $irda_od_percentage/100;
                           $total_orc = $res->agent_commission_amt + $res->agent_commission - $total_irda;
                        }
                        else if($res0->agn_com_type == "OD")
                        {
                        //   $irda_od_percentage = 12;
                           $od = $res->total_own_damage;
                           $irda_od = $res->total_own_damage * $irda_od_percentage/100;
                           $total_irda = $irda_od;
                           $total_orc = $res->agent_commission_amt + $res->agent_commission - $total_irda;
                        }
                        else if($res0->agn_com_type == "TP")
                        {
                           $total_irda = 0;
                           $total_orc = 0;
                        }
                    }
                    
                    if($res->class == "10") { // sme policy
                        $total_irda = $res->agent_commission_amt;
                        $total_orc  = $res->agent_commission;
                    }
                      
                    if($res != "" || $res != null)
                    {
                        $data_irda1 =   array(
                            "sr_no" =>$new_sr_no,
                            "debit"=>$total_irda,
                            "cr_parent_id" =>$agn_com_id,
                            "dr_parent_id" =>$own_com_id,
                            "tds" =>$tds,
                            "sub_id" =>$res->policy_agency_pos,
                            "lead_id"=>$lead_id,
                            "note" =>"Own commission Debit",
                            "datetime" =>date("Y-m-d H:i:s")
                        );
                            
                        $res0 = $this->lm->add_acc_own_commission($data_irda1);
                        if( $res0 ){
                            $this->audit->log('acc_commission_ledger', 'INSERT', null, null, $data_irda1);
                        }
            	             
                        $data_irda2 =   array(
                            "sr_no" =>$new_sr_no,
                            "credit"=>$total_irda,
                            "cr_parent_id" =>$agn_com_id,
                            "dr_parent_id" =>$own_com_id,
                            "tds" =>$tds,
                            "sub_id" =>$res->policy_agency_pos,
                            "lead_id"=>$lead_id,
                            "note" =>"Agent commission Credit",
                            "datetime" =>date("Y-m-d H:i:s")
                        );
                                    
                        $res1 = $this->lm->add_acc_own_commission($data_irda2);
                        if( $res1 ){
	                        $this->audit->log('acc_commission_ledger', 'INSERT', null, null, $data_irda2);
    	                }
            	             
                            
                        $data_orc1 =   array(
                            "sr_no" =>$new_sr_no,
                            "debit"=>$total_orc,
                            "cr_parent_id" =>$agn_com_id,
                            "dr_parent_id" =>$own_com_id,
                            "tds" =>$tds,
                            "sub_id" =>$res->policy_agency_pos,
                            "lead_id"=>$lead_id,
                            "note" =>"Own commission Debit",
                            "datetime" =>date("Y-m-d H:i:s")
                        );
                        $res0 = $this->lm->add_acc_own_commission_orc($data_orc1);
                        if( $res0 ){
                            $this->audit->log('acc_commission_ledger_orc', 'INSERT', null, null, $data_orc1);
                        }
            	             
                        $data_orc2 =   array(
                            "sr_no" =>$new_sr_no,
                            "credit"=>$total_orc,
                            "cr_parent_id" =>$agn_com_id,
                            "dr_parent_id" =>$own_com_id,
                            "tds" =>$tds,
                            "sub_id" =>$res->policy_agency_pos,
                            "lead_id"=>$lead_id,
                            "note" =>"Agent commission Credit",
                            "datetime" =>date("Y-m-d H:i:s")
                        );
                        $res1 = $this->lm->add_acc_own_commission_orc($data_orc2);
                        if( $res1 ){
                            $this->audit->log('acc_commission_ledger_orc', 'INSERT', null, null, $data_orc2);
                        }
                        
                    }
                      
                }
	  }
	  
	  
	   public function test_check_commission_status()
      {
            if($this->session->has_userdata('logged_in')) 
        	{
        	        $lead_id = $this->input->get("id");
        	        $data = $this->lm->fetch_policy_informations($lead_id);     
                    $policy_no = $data->policy_no;
                    $policy_issue_date = $data->policy_issue_date;
                    $policy_agency_pos = $data->policy_agency_pos;
                    $company = $data->company;
                    $policy_premium = $data->policy_premium;
                    $total_premium = $data->total_premium;
                    
                    $rto = "";
                    $age = "";
                    
                    $class_type = $this->lm->get_class_type($lead_id);
                    $from_date_1 = date_format(date_create($policy_issue_date),"01-m-Y");
                    $to_date_1 = date_format(date_create($from_date_1),"t-m-Y");

                       if($class_type->class == "1")
                       {
                                $get_lead_info = $this->lm->get_lead_info($lead_id);
                                $bussiness_type = $get_lead_info->business_type;
                                $policy_class = $get_lead_info->class;
                                $policy_type =  $get_lead_info->policy_type;
                                $state = $get_lead_info->state;
                                $rto = $get_lead_info->rto;
                                $regndate =$get_lead_info->regn_date;
                                $today = date("Y-m-d");
                                $diff = date_diff(date_create($regndate), date_create($today));
                                
                                //$age = $diff->format('%y');
                                $_vechage = $this->lm->getVechicleAge($lead_id, $policy_issue_date);
                                $age = $_vechage->age;
                                
                                $fuel_type = $get_lead_info->vechi_fuel_type;
                                $cc  = $get_lead_info->vechi_cc;
                                $v_gvw = $get_lead_info->vechi_gvw;
                                $v_seating = $get_lead_info->passenger_carrying;
                                $make = $get_lead_info->vechi_make;
                                $model = $get_lead_info->vechi_model;
                                $Varient = $get_lead_info->vechi_varient;
                                
                               
                                $commission_id = [];
                                
                                $status = "0";
                                $make_status = "0";
                                $model_status = "0";
                                $varient_status = "0";
                                $rto_status = "0";
                                $gvw_status = "0";
                                $fuel_status = "0";
                                $state_status = "0";
                                $fuel_type_status = "0";
                                
                                $data1 = array("status" =>"Commission Slab Not Exits","commission_id"=>"");
                                
                                $check = $this->cm->check_commission($company,$policy_premium,$policy_class,$bussiness_type,$policy_type,$state,$from_date_1,$to_date_1);
                                 
                                foreach($check as $da)
                                {
                                    if($da->commission_type == "2")
                                    {
                                        foreach($check as $da)
                                    	{
                                                $temp_min = $da->vehicle_age_min;
                                                $temp_max = $da->vehicle_age_max;
                                                $g_status = "0";
                                                $fuel_status = "0";
                                		    
                                        	    if($temp_min <= $age && $temp_max >= $age)
                                        		{
                                        			$g_status = "1";
                                        		}
                                        		
                                                if($fuel_type == "1")
                                                {
                                                	if($da->fuel_type == "4" || $da->fuel_type == "5" || $da->fuel_type == "1" || $da->fuel_type == "6")
                                                	{
                                                	    $fuel_status = "1";
                                                	}
                                                }
                                                if($fuel_type == "2")
                                                {
                                                    if($da->fuel_type == "5" || $da->fuel_type == "2" || $da->fuel_type == "6")
                                                	{
                                                	    $fuel_status = "1";
                                                	}
                                                }
                                                if($fuel_type == "5")
                                                {
                                                    if($da->fuel_type == "5" || $da->fuel_type == "1" || $da->fuel_type == "2" || $da->fuel_type == "6")
                                                	{
                                                	    $fuel_status = "1";
                                                	}
                                                }
                                                if($fuel_type == "6")
                                                {
                                                    if($da->fuel_type == "1" || $da->fuel_type == "2" || $da->fuel_type == "3" || $da->fuel_type == "4" || $da->fuel_type == "5" || $da->fuel_type == "6")
                                                	{
                                                	    $fuel_status = "1";
                                                	}
                                                }
                                                if($fuel_type == "7")
                                                {
                                                    if($da->fuel_type == "7" || $da->fuel_type == "6")
                                                	{
                                                	    $fuel_status = "1";
                                                	}
                                                }
                                    		   
                                    			if($g_status == "1" && $fuel_status == "1")
                                    			{
                                    			    $commission_id[] = $da->id;
                                    			    $status = "1";
                                                    $fuel_type_status = "1";
                                    			}
                                	      }
                                	    
                                        if($status == "1")
                                        {
                                            $check_state = $this->cm->check_state_by_commission_id(array_unique($commission_id));
                                            $commission_id = [];
                                            
                                            foreach($check_state as $da)
                                            {
                                                if($da->state == $state)
                                                {
                                                     $commission_id[] = $da->id;
                                                     $state_status = "1";
                                                }
                                                else if($da->state == "All")
                                                {
                                                    $commission_id[] = $da->id;
                                                    $state_status = "1";
                                                }
                                           }
                                           
    
                                             if($state_status == "1")
                                             {
                                                $classification = $this->cm->check_classification_by_commission_id(array_unique($commission_id));
                                                
                                                $temp_commission_id = [];
                                                $temp_commission_id = $commission_id;
                                                $commission_id = [];
                                               
                                                foreach($classification as $cl)
                                                {
                                                    if($policy_type == "7" || $policy_type == "12" || $policy_type == "13" || $policy_type == "14" || $policy_type == "59" || $policy_type == "60" || $policy_type == "65" || $policy_type == "66" || $policy_type == "67" || $policy_type == "68" || $policy_type == "69" || $policy_type == "70")
                                                    {
                                                        if($cl->classification != "")
                                                        {
                                                           $classification = $this->cm->check_seating($v_seating,$policy_type,$temp_commission_id);
                                                          
                                                            if(count($classification) > 0)
                                                            {
                                                                $gvw_status = "1";
                                                                foreach($classification as $da)
                                                                {
                                                                    $commission_id[] = $cl->id;
                                                                    $gvw_status = "1";
                                                                }
                                                            }
                                                        }
                                                        else
                                                        {
                                                            $commission_id = $temp_commission_id;
                                                            $gvw_status = "1";
                                                        }
                                                    }
                                                    else if($policy_type == "1" || $policy_type == "2" || $policy_type == "3" || $policy_type == "4" || $policy_type == "55")
                                                    {
                                                        if($cl->classification != "")
                                                        {
                                                            $classification = $this->lm->get_classification($cl->classification,$policy_type);
                                                         
                                                            if($classification != null || $classification != "")
                                                            {
                                                                 $temp_min = $classification->from_gvw_cc;
                                                                 $temp_max = $classification->to_gvw_cc;
    
                                                                 if(($cc >= $temp_min && $cc <= $temp_max))
                                                                 {
                                                                     $commission_id[] = $cl->id;
                                                                     $gvw_status = "1";
                                                                 }
                                                            }
                                                        }
                                                        else
                                                        {
                                                            $gvw_status = "1";
                                                            $commission_id = $temp_commission_id;
                                                        }
                                                    }
                                                    else
                                                    {
                                                        if($cl->classification != "")
                                                        {
                                                            $classification = $this->lm->get_classification($cl->classification,$policy_type);
                                                          
                                                            if($classification != null)
                                                            {
                                                                $temp_min = $classification->from_gvw_cc;
                                                                $temp_max = $classification->to_gvw_cc;
                                                                
                                                                if($v_gvw >= $temp_min && $v_gvw <= $temp_max)
                                                                {
                                                                    $gvw_status = "1";
                                                                    $commission_id[] = $cl->id;
                                                                }
                                                            }
                                                        }
                                                        else
                                                        {
                                                            $gvw_status = "1";
                                                            $commission_id = $temp_commission_id;
                                                        }
                                                    }
                                                }
                                                
                                               $check_make_1 = $this->cm->check_make_already_exits(array_unique($commission_id),$policy_type,$make);
                                                
                                                if(count($check_make_1) > 0)
                                                {
                                                        if(count($check_make_1) > 0)
                                                        {
                                                            $commission_id = [];
                                                            
                                                            foreach($check_make_1 as $da)
                                                            {
                                                                 $commission_id[] = $da->commission_id;
                                                            }
                                                            $status = "1";
                                                            $make_status = "1";
                                                        }
                                                        else
                                                        {
                                                            $make_status = "0";
                                                        }
                                                }
                                                else
                                                {
                                                    $check_make = $this->lm->check_make_all_already_exits(array_unique($commission_id),$policy_type);
                                                    
                                                    if(count($check_make) > 0)
                                                    {
                                                        $commission_id = [];
                                                        
                                                        foreach($check_make as $da)
                                                        {
                                                          $commission_id[] = $da->id;
                                                        }
                                                        
                                                        $status = "1";
                                                        $make_status = "1";
                                                    }
                                                }
    
                                                $check_model_1 = $this->lm->check_model_already_exits(array_unique($commission_id),$policy_type,$make,$model);
                                                 
                                                if(count($check_model_1) > 0)
                                                {
                                                    $commission_id = [];
                                                    
                                                    foreach($check_model_1 as $da)
                                                    {
                                                       $commission_id[] = $da->commission_id;
                                                    }
                                                    
                                                    $status = "1";
                                                    $model_status = "1";
                                                }
                                                else
                                                {
                                                    $check_model = $this->pm->check_model_all_already_exits(array_unique($commission_id),$policy_type);
                                                    if(count($check_model) > 0)
                                                    {
                                                            $commission_id = [];
                                                            foreach($check_model as $da)
                                                            {
                                                                 $commission_id[] = $da->id;
                                                            }
                                                         $status = "1";
                                                         $model_status = "1";
                                                    }
                                                }
                                                
                                                if($make_status == "1" && $model_status == "1")
                                                {
                                                    $check_varient_1 = $this->cm->check_varient_already_exits(array_unique($commission_id),$policy_type,$make,$model,$Varient);
                                                   
                                                    if(count($check_varient_1) > 0) 
                                                    {
                                                        $commission_id = [];
                                                        foreach($check_varient_1 as $da)
                                                        {
                                                          $commission_id[] = $da->commission_id;
                                                        }
                                                        $status = "1";
                                                        $varient_status = "1";
                                                    }
                                                    else
                                                    {
                                                        $check_varient = $this->pm->check_varient_all_already_exits(array_unique($commission_id),$policy_type);
                                                        if(count($check_varient) > 0)
                                                        {
                                                            $commission_id = [];
                                                            
                                                            foreach($check_varient as $da)
                                                            {
                                                                 $commission_id[] = $da->id;
                                                            }
                                                             $status = "1";
                                                	         $varient_status = "1";
                                                        }
                                                    }
                                                }
                                       
                                                if($status == "1" && $state_status == "1" && $fuel_type_status == "1" && $gvw_status == "1" && $make_status == "1" && $model_status == "1" && $varient_status == "1")
                                                {
                                                     $check_rto = $this->cm->check_rto_already_exits_2(array_unique($commission_id),$rto);
                                                     
                                                        if(count($check_rto) > 0)
                                                        {
                                                            foreach($check_rto as $rt)
                                                            {
                                                                $com_id = $rt->commission_id;
                                                            }
                                                          
                                                            if(!$this->cm->check_policy_already_exits($lead_id))
                                                            {
                                                                if(!$this->cm->check_policy_no_already_exits($policy_no))
                                                                {
                                                                     $data1 = array("status" =>"success" ,"commission_id"=>$com_id);
                                                                }
                                                                else
                                                                {
                                                                     $data1 = array("status" =>"Policy No Already Exits" ,"commission_id"=>$com_id);
                                                                }
                                                            }
                                                            else
                                                            {
                                                                $data1 = array("status" =>"Lead Id Already Exits","commission_id"=>"");
                                                            }
                                                        }
                                                        else
                                                        {
                                                            $data1 = array("status" =>"RTO Mismatched","commission_id"=>"");
                                                        }
                                                 }
                                                else if($state_status == "0")
                                                {
                                                    $data1 = array("status" =>"State Mismacthed","commission_id"=>"");
                                                }
                                                else if($fuel_type_status == "0")
                                                {
                                                    $data1 = array("status" =>"Fuel Type Mismacthed","commission_id"=>"");
                                                }
                                                else if($gvw_status == "0")
                                                {
                                                    $data1 = array("status" =>"Classification Mismatched","commission_id"=>"");
                                                }
                                                else if($make_status == "0")
                                                {
                                                     $data1 = array("status" =>"Make Mismactched","commission_id"=>"");
                                                }
                                                else if($model_status == "0")
                                                {
                                                     $data1 = array("status" =>"Model Mismactched","commission_id"=>"");
                                                }
                                                else if($varient_status == "0")
                                                {
                                                     $data1 = array("status" =>"Varient Mismactched","commission_id"=>"");
                                                }
                                            }
                                             else
                                             {
                                                 $data1 = array("status" =>"State Mismacthed","commission_id"=>"");
                                             }
                                         }
                                        else
                                        {
                                             $data1 = array("status" =>"Insurance company or Slab or Fuel Type Mismacthed","commission_id"=>"");
                                         }
                                     }
                                    else if($da->commission_type == "1")
                                    {
                                        $g_status = "0";
                                        $fuel_status = "0";
                                        
                                        foreach($check as $da)
                                    	{
                                            $temp_min = $da->no_policy_min;
                                            $temp_max = $da->no_policy_max;
                                            
    
                                            if($temp_min <= 1 && $temp_max >= 1)
                                            {
                                                 $g_status = "1";
                                                 $commission_id[] = $da->id;
                                            }
                                            
                                            if($fuel_type == "1")
                                            {
                                            	if($da->fuel_type == "4" || $da->fuel_type == "5" || $da->fuel_type == "1" || $da->fuel_type == "6")
                                            	{
                                            	    $fuel_status = "1";
                                            	}
                                            }
                                            
                                            if($fuel_type == "2")
                                            {
                                                if($da->fuel_type == "5" || $da->fuel_type == "2" || $da->fuel_type == "6")
                                            	{
                                            	    $fuel_status = "1";
                                            	}
                                            }
                                            
                                            if($fuel_type == "5")
                                            {
                                                if($da->fuel_type == "5" || $da->fuel_type == "1" || $da->fuel_type == "2" || $da->fuel_type == "6")
                                            	{
                                            	    $fuel_status = "1";
                                            	}
                                            }
                                            
                                            if($fuel_type == "6")
                                            {
                                                if($da->fuel_type == "1" || $da->fuel_type == "2" || $da->fuel_type == "3" || $da->fuel_type == "4" || $da->fuel_type == "5" || $da->fuel_type == "6")
                                            	{
                                            	    $fuel_status = "1";
                                            	}
                                            }
                                            
                                            if($fuel_type == "7")
                                            {
                                                if($da->fuel_type == "7" || $da->fuel_type == "6")
                                            	{
                                            	    $fuel_status = "1";
                                            	}
                                            }
                                		   
                                			if($g_status == "1" && $fuel_status == "1")
                                			{
                                			    $commission_id[] = $da->id;
                                			    $status = "1";
                                                $fuel_type_status = "1";
                                			}
                                    	}
                                    	
                                        if($status == "1")
                                        {
                                            $check_state = $this->cm->check_state_by_commission_id(array_unique($commission_id));
                                            
                                            $commission_id = [];
                                            
                                            foreach($check_state as $da)
                                            {
                                                if($da->state == $state)
                                                {
                                                     $commission_id[] = $da->id;
                                                     $state_status = "1";
                                                }
                                                else if($da->state == "All")
                                                {
                                                    $commission_id[] = $da->id;
                                                    $state_status = "1";
                                                }
                                            }
                                            
                                            if($state_status == "1")
                                            {
                                                $classification = $this->cm->check_classification_by_commission_id(array_unique($commission_id));
                                                $temp_commission_id = [];
                                                $temp_commission_id = $commission_id;
                                                $commission_id = [];
                                            
                                                foreach($classification as $cl)
                                                {
                                                    if($policy_type == "7" || $policy_type == "12" || $policy_type == "13" || $policy_type == "14" || $policy_type == "59" || $policy_type == "60" || $policy_type == "65" || $policy_type == "66" || $policy_type == "67" || $policy_type == "68" || $policy_type == "69" || $policy_type == "70")
                                                    {
                                                        if($cl->classification != "")
                                                        {
                                                           $classification = $this->cm->check_seating($v_seating,$policy_type,$temp_commission_id);
                                                           
                                                            if(count($classification) > 0)
                                                            {
                                                                $gvw_status = "1";
                                                                
                                                                foreach($classification as $da)
                                                                {
                                                                    $commission_id[] = $cl->id;
                                                                    $gvw_status = "1";
                                                                }
                                                            }
                                                        }
                                                        else
                                                        {
                                                            $commission_id = $temp_commission_id;
                                                            $gvw_status = "1";
                                                        }
                                                    }
                                                    else if($policy_type == "1" || $policy_type == "2" || $policy_type == "3" || $policy_type == "4" || $policy_type == "55")
                                                    {
                                                        if($cl->classification != "")
                                                        {
                                                            $classification = $this->lm->get_classification($cl->classification,$policy_type);
                                                         
                                                            if($classification != null)
                                                            {
                                                                 $temp_min = $classification->from_gvw_cc;
                                                                 $temp_max = $classification->to_gvw_cc;
                                                                 
                                                                 if(($cc >= $temp_min && $cc <= $temp_max))
                                                                 {
                                                                     $commission_id[] = $cl->id;
                                                                     $gvw_status = "1";
                                                                 }
                                                            }
                                                        }
                                                        else
                                                        {
                                                            $gvw_status = "1";
                                                            $commission_id = $temp_commission_id;
                                                        }
                                                    }
                                                    else
                                                    {
                                                        if($cl->classification != "")
                                                        {
                                                            $classification = $this->lm->get_classification($cl->classification,$policy_type);
                                                          
                                                            if($classification != null)
                                                            {
                                                                $temp_min = $classification->from_gvw_cc;
                                                                $temp_max = $classification->to_gvw_cc;
                                                                
                                                                if($v_gvw >= $temp_min && $v_gvw <= $temp_max)
                                                                {
                                                                    $gvw_status = "1";
                                                                    $commission_id[] = $cl->id;
                                                                }
                                                            }
                                                        }
                                                        else
                                                        {
                                                            $gvw_status = "1";
                                                            $commission_id = $temp_commission_id;
                                                        }
                                                    }
                                                }
                                            
                                                $check_make_1 = $this->cm->check_make_already_exits(array_unique($commission_id),$policy_type,$make);
                                                
                                                if(count($check_make_1) > 0)
                                                {
                                                        if(count($check_make_1) > 0)
                                                        {
                                                            $commission_id = [];
                                                            
                                                            foreach($check_make_1 as $da)
                                                            {
                                                                 $commission_id[] = $da->commission_id;
                                                            }
                                                            $status = "1";
                                                            $make_status = "1";
                                                        }
                                                        else
                                                        {
                                                            $make_status = "0";
                                                        }
                                                }
                                                else
                                                {
                                                    $check_make = $this->lm->check_make_all_already_exits(array_unique($commission_id),$policy_type);
                                                    
                                                    if(count($check_make) > 0)
                                                    {
                                                        $commission_id = [];
                                                        
                                                        foreach($check_make as $da)
                                                        {
                                                          $commission_id[] = $da->id;
                                                        }
                                                        
                                                        $status = "1";
                                                        $make_status = "1";
                                                    }
                                                }
    
                                                $check_model_1 = $this->lm->check_model_already_exits(array_unique($commission_id),$policy_type,$make,$model);
                                                 
                                                if(count($check_model_1) > 0)
                                                {
                                                    $commission_id = [];
                                                    
                                                    foreach($check_model_1 as $da)
                                                    {
                                                       $commission_id[] = $da->commission_id;
                                                    }
                                                    
                                                    $status = "1";
                                                    $model_status = "1";
                                                }
                                                else
                                                {
                                                    $check_model = $this->pm->check_model_all_already_exits(array_unique($commission_id),$policy_type);
                                                    if(count($check_model) > 0)
                                                    {
                                                            $commission_id = [];
                                                            foreach($check_model as $da)
                                                            {
                                                                 $commission_id[] = $da->id;
                                                            }
                                                         $status = "1";
                                                         $model_status = "1";
                                                    }
                                                }
                                                
                                                if($make_status == "1" && $model_status == "1")
                                                {
                                                    $check_varient_1 = $this->cm->check_varient_already_exits(array_unique($commission_id),$policy_type,$make,$model,$Varient);
                                                   
                                                    if(count($check_varient_1) > 0) 
                                                    {
                                                        $commission_id = [];
                                                        foreach($check_varient_1 as $da)
                                                        {
                                                          $commission_id[] = $da->commission_id;
                                                        }
                                                        $status = "1";
                                                        $varient_status = "1";
                                                    }
                                                    else
                                                    {
                                                        $check_varient = $this->pm->check_varient_all_already_exits(array_unique($commission_id),$policy_type);
                                                        if(count($check_varient) > 0)
                                                        {
                                                            $commission_id = [];
                                                            
                                                            foreach($check_varient as $da)
                                                            {
                                                                 $commission_id[] = $da->id;
                                                            }
                                                             $status = "1";
                                                	         $varient_status = "1";
                                                        }
                                                    }
                                                }
                                    
                                                if($status == "1" && $state_status == "1" && $fuel_type_status == "1" && $gvw_status == "1" && $make_status == "1" && $model_status == "1" && $varient_status == "1")
                                                {
                                                     $check_rto = $this->cm->check_rto_already_exits_2(array_unique($commission_id),$rto);
                                                     
                                                        if(count($check_rto) > 0)
                                                        {
                                                            foreach($check_rto as $rt)
                                                            {
                                                                $com_id = $rt->commission_id;
                                                            }
                                                            if(!$this->cm->check_policy_already_exits($lead_id))
                                                            {
                                                                if(!$this->cm->check_policy_no_already_exits($policy_no))
                                                                {
                                                                     $data1 = array("status" =>"success" ,"commission_id"=>$com_id);
                                                                }
                                                            }
                                                            else
                                                            {
                                                                $data1 = array("status" =>"Policy Already Exits","commission_id"=>"");
                                                            }
                                                        }
                                                 }
                                                else if($fuel_type_status == "0")
                                                {
                                                  $data1 = array("status" =>"Fuel Type Mismacthed","commission_id"=>"");
                                                }
                                                else if($gvw_status == "0")
                                                {
                                                  $data1 = array("status" =>"Classification Mismatched","commission_id"=>"");
                                                }
                                                else if($make_status == "0")
                                                {
                                                  $data1 = array("status" =>"Make Mismactched","commission_id"=>"");
                                                }
                                                else if($model_status == "0")
                                                {
                                                  $data1 = array("status" =>"Model Mismactched","commission_id"=>"");
                                                }
                                                else if($varient_status == "0")
                                                {
                                                  $data1 = array("status" =>"Varient Mismactched","commission_id"=>"");
                                                }
                                            }
                                            else
                                            {
                                                 $data1 = array("status" =>"State Mismacthed","commission_id"=>"");
                                            }
                                         }
                                        else 
                                        {
                                          $data1 = array("status" =>"Insurance company or Slab Mismacthed","commission_id"=>"");
                                        }
                                    }
                                    else if($da->commission_type == "3")
                                    {
                                        $g_status = "0";
                                        $fuel_status = "0";
                                        
                                        foreach($check as $da)
                                    	{
                                            $temp_min = $da->min_val;
                                            $temp_max = $da->max_val;
                                            
                                            if($temp_min <= $total_premium && $temp_max >= $total_premium)
                                            {
                                                 $g_status = "1";
                                                 $commission_id[] = $da->id;
                                            }
                                            
                                            if($fuel_type == "1")
                                            {
                                            	if($da->fuel_type == "4" || $da->fuel_type == "5" || $da->fuel_type == "1" || $da->fuel_type == "6")
                                            	{
                                            	    $fuel_status = "1";
                                            	}
                                            }
                                            if($fuel_type == "2")
                                            {
                                                if($da->fuel_type == "5" || $da->fuel_type == "2" || $da->fuel_type == "6")
                                            	{
                                            	    $fuel_status = "1";
                                            	}
                                            }
                                            if($fuel_type == "5")
                                            {
                                                if($da->fuel_type == "5" || $da->fuel_type == "1" || $da->fuel_type == "2" || $da->fuel_type == "6")
                                            	{
                                            	    $fuel_status = "1";
                                            	}
                                            }
                                            if($fuel_type == "6")
                                            {
                                                if($da->fuel_type == "1" || $da->fuel_type == "2" || $da->fuel_type == "3" || $da->fuel_type == "4" || $da->fuel_type == "5" || $da->fuel_type == "6")
                                            	{
                                            	    $fuel_status = "1";
                                            	}
                                            }
                                            if($fuel_type == "7")
                                            {
                                                if($da->fuel_type == "7" || $da->fuel_type == "6")
                                            	{
                                            	    $fuel_status = "1";
                                            	}
                                            }
                                		   
                                			if($g_status == "1" && $fuel_status == "1")
                                			{
                                			    $commission_id[] = $da->id;
                                			    $status = "1";
                                                $fuel_type_status = "1";
                                              
                                			}
                                    	}
                                    	
                                        if($status == "1")
                                        {
                                            $check_state = $this->cm->check_state_by_commission_id(array_unique($commission_id));
                                            $commission_id = [];
                                            
                                            foreach($check_state as $da)
                                            {
                                                if($da->state == $state)
                                                {
                                                     $commission_id[] = $da->id;
                                                     $state_status = "1";
                                                }
                                                else if($da->state == "All")
                                                {
                                                    $commission_id[] = $da->id;
                                                    $state_status = "1";
                                                }
                                            }
                                            
                                            if($state_status == "1")
                                            {
                                                $classification = $this->cm->check_classification_by_commission_id(array_unique($commission_id));
                                                $temp_commission_id = [];
                                                $temp_commission_id = $commission_id;
                                            
                                                 $commission_id = [];
                                            
                                                foreach($classification as $cl)
                                                {
                                                    if($policy_type == "7" || $policy_type == "12" || $policy_type == "13" || $policy_type == "14" || $policy_type == "59" || $policy_type == "60" || $policy_type == "65" || $policy_type == "66" || $policy_type == "67" || $policy_type == "68" || $policy_type == "69" || $policy_type == "70")
                                                    {
                                                        if($cl->classification != "")
                                                        {
                                                           $classification = $this->cm->check_seating($v_seating,$policy_type,$temp_commission_id);
                                                           
                                                            if(count($classification) > 0)
                                                            {
                                                                $gvw_status = "1";
                                                                
                                                                foreach($classification as $da)
                                                                {
                                                                    $commission_id[] = $cl->id;
                                                                    $gvw_status = "1";
                                                                }
                                                            }
                                                        }
                                                        else
                                                        {
                                                            $commission_id = $temp_commission_id;
                                                            $gvw_status = "1";
                                                        }
                                                    }
                                                    else if($policy_type == "1" || $policy_type == "2" || $policy_type == "3" || $policy_type == "4" || $policy_type == "55")
                                                    {
                                                        if($cl->classification != "")
                                                        {
                                                            $classification = $this->lm->get_classification($cl->classification,$policy_type);
                                                         
                                                            if($classification != null)
                                                            {
                                                                 $temp_min = $classification->from_gvw_cc;
                                                                 $temp_max = $classification->to_gvw_cc;
                                                                 
                                                                 if(($cc >= $temp_min && $cc <= $temp_max))
                                                                 {
                                                                     $commission_id[] = $cl->id;
                                                                     $gvw_status = "1";
                                                                 }
                                                            }
                                                        }
                                                        else
                                                        {
                                                            $gvw_status = "1";
                                                            $commission_id = $temp_commission_id;
                                                        }
                                                    }
                                                    else
                                                    {
                                                        if($cl->classification != "")
                                                        {
                                                            $classification = $this->lm->get_classification($cl->classification,$policy_type);
                                                          
                                                            if($classification != null)
                                                            {
                                                                $temp_min = $classification->from_gvw_cc;
                                                                $temp_max = $classification->to_gvw_cc;
                                                                
                                                                if($v_gvw >= $temp_min && $v_gvw <= $temp_max)
                                                                {
                                                                    $gvw_status = "1";
                                                                    $commission_id[] = $cl->id;
                                                                }
                                                            }
                                                        }
                                                        else
                                                        {
                                                            $gvw_status = "1";
                                                            $commission_id = $temp_commission_id;
                                                        }
                                                    }
                                                }
                                            
                                                 $check_make_1 = $this->cm->check_make_already_exits(array_unique($commission_id),$policy_type,$make);
                                                
                                                if(count($check_make_1) > 0)
                                                {
                                                        if(count($check_make_1) > 0)
                                                        {
                                                            $commission_id = [];
                                                            
                                                            foreach($check_make_1 as $da)
                                                            {
                                                                 $commission_id[] = $da->commission_id;
                                                            }
                                                            $status = "1";
                                                            $make_status = "1";
                                                        }
                                                        else
                                                        {
                                                            $make_status = "0";
                                                        }
                                                }
                                                else
                                                {
                                                    $check_make = $this->lm->check_make_all_already_exits(array_unique($commission_id),$policy_type);
                                                    
                                                    if(count($check_make) > 0)
                                                    {
                                                        $commission_id = [];
                                                        
                                                        foreach($check_make as $da)
                                                        {
                                                          $commission_id[] = $da->id;
                                                        }
                                                        
                                                        $status = "1";
                                                        $make_status = "1";
                                                    }
                                                }
    
                                                $check_model_1 = $this->lm->check_model_already_exits(array_unique($commission_id),$policy_type,$make,$model);
                                                 
                                                if(count($check_model_1) > 0)
                                                {
                                                    $commission_id = [];
                                                    
                                                    foreach($check_model_1 as $da)
                                                    {
                                                       $commission_id[] = $da->commission_id;
                                                    }
                                                    
                                                    $status = "1";
                                                    $model_status = "1";
                                                }
                                                else
                                                {
                                                    $check_model = $this->pm->check_model_all_already_exits(array_unique($commission_id),$policy_type);
                                                    if(count($check_model) > 0)
                                                    {
                                                            $commission_id = [];
                                                            foreach($check_model as $da)
                                                            {
                                                                 $commission_id[] = $da->id;
                                                            }
                                                         $status = "1";
                                                         $model_status = "1";
                                                    }
                                                }
                                                
                                                if($make_status == "1" && $model_status == "1")
                                                {
                                                    $check_varient_1 = $this->cm->check_varient_already_exits(array_unique($commission_id),$policy_type,$make,$model,$Varient);
                                                   
                                                    if(count($check_varient_1) > 0) 
                                                    {
                                                        $commission_id = [];
                                                        foreach($check_varient_1 as $da)
                                                        {
                                                          $commission_id[] = $da->commission_id;
                                                        }
                                                        $status = "1";
                                                        $varient_status = "1";
                                                    }
                                                    else
                                                    {
                                                        $check_varient = $this->pm->check_varient_all_already_exits(array_unique($commission_id),$policy_type);
                                                        if(count($check_varient) > 0)
                                                        {
                                                            $commission_id = [];
                                                            
                                                            foreach($check_varient as $da)
                                                            {
                                                                 $commission_id[] = $da->id;
                                                            }
                                                             $status = "1";
                                                	         $varient_status = "1";
                                                        }
                                                    }
                                                }
                                                
                                                if($status == "1" && $state_status == "1" && $fuel_type_status == "1" && $gvw_status == "1" && $make_status == "1" && $model_status == "1" && $varient_status == "1")
                                                {
                                                     $check_rto = $this->cm->check_rto_already_exits_2(array_unique($commission_id),$rto);
                                                     
                                                        if(count($check_rto) > 0)
                                                        {
                                                            foreach($check_rto as $rt)
                                                            {
                                                                $com_id = $rt->commission_id;
                                                            }
                                                            
                                                            if(!$this->cm->check_policy_already_exits($lead_id))
                                                            {
                                                                if(!$this->cm->check_policy_no_already_exits($policy_no))
                                                                {
                                                                     $data1 = array("status" =>"success" ,"commission_id"=>$com_id);
                                                                }
                                                            }
                                                            else
                                                            {
                                                                $data1 = array("status" =>"Policy Already Exits","commission_id"=>"");
                                                            }
                                                        }
                                                 }
                                                else if($fuel_type_status == "0")
                                                {
                                                  $data1 = array("status" =>"Fuel Type Mismacthed","commission_id"=>"");
                                                }
                                                else if($gvw_status == "0")
                                                {
                                                  $data1 = array("status" =>"Classification Mismatched","commission_id"=>"");
                                                }
                                                else if($make_status == "0")
                                                {
                                                  $data1 = array("status" =>"Make Mismactched","commission_id"=>"");
                                                }
                                                else if($model_status == "0")
                                                {
                                                  $data1 = array("status" =>"Model Mismactched","commission_id"=>"");
                                                }
                                                else if($varient_status == "0")
                                                {
                                                  $data1 = array("status" =>"Varient Mismactched","commission_id"=>"");
                                                }
                                            }
                                            else
                                            {
                                                $data1 = array("status" =>"State Mismacthed","commission_id"=>"");
                                            }
                                         }
                                        else
                                        {
                                           $data1 = array("status" =>"Insurace Company or Slab Mismacthed","commission_id"=>"");
                                        }
                                    }
                                }
                               echo json_encode($data1);
                       }
                       else if($class_type->class == "2")
                       {
                               $bussiness_type = $class_type->business_type;
                               $policy_class = $class_type->class;
                               $policy_type =  $class_type->policy_type;
                               $state = "All";
                               
                                $data1 = array("status" =>"Commission Slab Not Exits","commission_id"=>"");
                               
                               $check = $this->cm->check_health_commission($company,$policy_premium,$policy_class,$bussiness_type,$policy_type,$state,$from_date_1,$to_date_1);
                               
                                foreach($check as $da)
                                {
                                    if($da->commission_type == "1")
                                    {
                                        foreach($check as $da)
                                    	{
                                            $temp_min = $da->no_policy_min;
                                            $temp_max = $da->no_policy_max;
                                            
                                            if($temp_min <= 1 && $temp_max >= 1)
                                            {
                                                 $status = "1";
                                                 $commission_id[] = $da->id;
                                            }
                                    	}
                                    	
                                    	if($status == "1")
                                    	{
                                    	     if($da->state != "All")
                                    	     {
                                    	         $res = $this->cm->check_health_state($commission_id);
                                    	         $commission_id = [];
                                    	         
                                        	     foreach($res as $da)
                                        	     {
                                        	           $commission_id[] = $da->id;
                                        	           $c_id = $da->id;
                                        	     }
                                    	     }
                                    	     $data1 = array("status" =>"success","commission_id"=>$c_id);
                                    	}
                                    	else
                                    	{
                                    	     $data1 = array("status" =>"Slab Not Exits","commission_id"=>"");
                                    	}
                                    }
                                    else if($da->commission_type == "3")
                                    {
                                        foreach($check as $da)
                                    	{
                                            $temp_min = $da->min_val;
                                            $temp_max = $da->max_val;
                                            
                                            if($temp_min <= $total_premium && $temp_max >= $total_premium)
                                            {
                                                 $status = "1";
                                                 $commission_id[] = $da->id;
                                            }
                                    	}
                                    	
                                    	if($status == "1")
                                    	{
                                    	     if($da->state != "All")
                                    	     {
                                    	         $res = $this->cm->check_health_state($commission_id);
                                    	         $commission_id = [];
                                    	         
                                        	     foreach($res as $da)
                                        	     {
                                        	           $commission_id[] = $da->id;
                                        	           $c_id = $da->id;
                                        	     }
                                        	     $data1 = array("commission_id"=>$c_id,"status" => "success");
                                    	     }
                                    	     else
                                    	     {
                                    	         $data1 = array("commission_id"=>"","status" => "success");
                                    	     }
                                    	}
                                    }
                                }
                                 echo json_encode($data1);
                          }
                       else
                       {
                           $data1 = array("commission_id"=>"","status" => "SME Policy");
                           echo json_encode($data1);
                       }
                 }
        	
       }
       
       

     public function add_lead_files()
        {
            if($this->session->has_userdata('logged_in'))
            {
                $id = $this->input->post("id");
                $document_type = $this->input->post("document_type");
                
               
                       if(isset($_FILES))
                		{
                			$config['upload_path'] = './datas/documents/';
                			$config['allowed_types'] = '*';
                			
                			$this->load->library('upload',$config);
                			$this->upload->initialize($config);
                			if(!$this->upload->do_upload('file'))
                			{
                			   $date = date("Y-m-d H:i:s"); 
                			   $data = array("lead_id" =>$id,
                			             "document_type" =>$document_type,"updated_time" =>$date);
                			}
                			else
                			{
			                   
                			   $file = $this->upload->data('file_name');
                			   $date = date("Y-m-d H:i:s"); 
                			   $data = array( 
                			                 "lead_id" =>$id,
                			                "document_type" =>$document_type,"document_file"=>$file,"updated_time" =>$date);
                			}
                			
                		$res = $this->lm->add_lead_files($data);
                			
                		}
                		 echo "success";
            }
        }
        
    public function add_due_date() 
    {
          if($this->session->has_userdata('logged_in'))
            {
            $duedate = $this->input->post("duedate");
            $id = $this->input->post("id");
                
                
            $data = array("due_date" => $duedate);
            $lead_data = $this->lm->get_receiver_email_id($id);
    		$res = $this->lm->add_due_date($id, $data);
            if($res){
                 $this->audit->log('list_of_leads', 'UPDATE', null, $lead_data, $data);
             }
    		echo "Success";
    	}
	}
	
	public function fetch_vechile_number_check()
	{
	    if($this->session->has_userdata('logged_in'))
            {
                $v_regn_no_1 = $this->input->post("v_regn_no_1");
                $v_regn_no_2 = $this->input->post("v_regn_no_2");
                $v_regn_no_3 = $this->input->post("v_regn_no_3");
                $v_regn_no_4 = $this->input->post("v_regn_no_4");
                
                $v_regn_number= $v_regn_no_1.'-'.$v_regn_no_2.'-'.$v_regn_no_3.'-'.$v_regn_no_4;
                
                $res = $this->lm->fetch_vechile_number_check($v_regn_number);
                
                if($res)
                {
                    $response = ['status' => 'true', 'refer' => $res->lead_id];
                    echo json_encode($response);
                    //echo "true";
                    die();
                }

         	}
            $response = ['status' => 'false'];
            echo json_encode($response);
            //echo "false";
            die();
	}
	
	
	public function temp_lead()
	{
	    if( !( $this->session->has_userdata('logged_in') ) ){
            redirect('login', 'refresh');
        }
        
        // if(!$this->auth->can_access('List Temp Lead')) {
        //     redirect('access_denied', 'refresh');
        // }
        
	  if($this->session->has_userdata('logged_in'))
       {
           
            $pro_data["project_info"] = $this->mm->fetch_project_info();
            $data["users"] = $this->lm->fetch_users();
		   	$data["ai"] = $this->lm->fetch_ai();
		   	$data["agents_pos"] = $this->lm->fetch_agents_pos();
		   	$data["business"] = $this->lm->fetch_business_type();
		   	$data["class"] = $this->lm->fetch_list_of_class();
            $this->load->view("header",$pro_data);
            $this->load->view("temp_lead",$data);
            $this->load->view("footer",$pro_data);
      }
      else
      {
          redirect("login");
      }
   }
   
   public function add_temp_leads()
   {
         if($this->session->has_userdata('logged_in'))
        {
            $client_name = $this->input->post("client_name");
            $mobile_no = $this->input->post("mobile_no");
            $address = $this->input->post("address");
            $class = $this->input->post("policy_class");
            $policy_type = $this->input->post("policy_type");
            $due_date =  $this->input->post("due_date");
            $v_regn_no = $this->input->post("v_regn_no");
            $agent_pos = $this->input->post("agent_pos");
            $assign_to_user =  $this->input->post("assign_to_user");
            $area_incharge = $this->input->post("area_incharge");
            $remarks = $this->input->post("remarks");
            $lead_status = "open";
            
            $created_date = date("Y-m-d H:i:sa");
	        $updated_date = date("Y-m-d H:i:sa");
	        
	        $temp_status = "1";
            
            
            $data = array ("client_name" =>$client_name,
        	             "mobile_no" =>$mobile_no,
        	             "address" =>$address);

            $insert_id = $this->lm->add_client_details_temp_lead($data);
            if( $insert_id ){
	                 $this->audit->log('list_of_clients', 'INSERT', null, null, $data);
	             }
             
             
             $arr = array (
                                "client_id" =>$insert_id,
                                "lead_status" => "open",
                                "class"=>$class,
                                "policy_type" => $policy_type,
                                "due_date" =>$due_date,
                                "agency_and_pos" => $agent_pos,
                                "assigned_user" => $assign_to_user,
                                "area_incharge" =>$area_incharge,
                                "remarks" =>$remarks,
                                "temp_status" =>$temp_status,
                                "lead_created_id" =>$this->session->userdata('session_id'),
                                "created_date"=>$created_date,
                                "updated_date"=>$updated_date
                         );
                         
             $data_1 = $this->lm->add_temp_lead_details($arr); 
             if( $data_1 ){
	                 $this->audit->log('list_of_leads', 'INSERT', null, null, $arr);
	             }
         if($class == "1")
                {
                $v_info = array("lead_id"=>$data_1,"vechi_register_no" =>$v_regn_no,"policy_type" => $policy_type);
                $add_v_info = $this->lm->add_temp_vechicle_regn_no($v_info);   
                if( $add_v_info ){
	                 $this->audit->log('vechile_details', 'INSERT', null, null, $v_info);
	             }
                }
           
           
            echo "success";
        }

   }
   
   public function fetch_temp_lead()
    {
	     if($this->session->has_userdata('logged_in'))
    	 {
    	     $draw = intval($this->input->post("draw"));
    	     
    	     $lead_type = $this->input->post("lead_type");
    	     $classification = $this->input->post("classification");
    	     $search = $this->input->post("text");
    	     $search_vechicle = $this->input->post("search_vechicle");
    	     
    	     $res = $this->lm->fetch_temp_lead($lead_type,$classification,$search,$search_vechicle);

    	     $arr = [];
    	      
    	     $a = (isset($_POST['start'])) ? $_POST['start'] : 0;
    	     
    	     $res1 = array();
    	     $res2 = array();
    	     $res3 = array();
    	     $res4 = array();
    	     
    	     foreach($res as $da)
    	     {
    	         if($da->due_date >= date("Y-m-d"))
    	         {
    	             $res1[] = $da;
    	         }
    	         else if($da->due_date == "0000-00-00")
    	         {
    	             $res4[] = $da;
    	         }
    	         else
    	         {
    	             $res2[] = $da;
    	         }
    	     }
    	     rsort($res2);
    	     foreach($res1 as $da)
    	     {
    	         $res3[] = $da;
    	     }
    	     foreach($res2 as $da)
    	     {
    	         $res3[] = $da;
    	     }
    	     foreach($res4 as $da)
    	     {
    	         $res3[] = $da;
    	     }
    	     
    	 function sortByduedate($a, $b){
    	     $t1 = strtotime($a->due_date);
    	     $t2 = strtotime($b->due_date);
    	     return $t2 - $t1;
    	 }
         foreach($res3 as $da)
         {
    	         $a++;
    	         
    	   $action = "<a href='create_lead?id=".$da->id."' class='btn btn-warning btn-xs'><i class='fa fa-eye'></i></a>
    	           <button onclick=due_date_extern(".$da->id.") class='btn btn-info btn-xs'><i class='fa fa-calendar'></i></button>";
    
    	   
        	 if($da->lead_type == '0' && $da->classfication == '1' && $da->policy_status == '0')
        	 {
        	     $action .= "&nbsp;<button onclick=move_prospect(".$da->id.") class='btn btn-primary btn-xs'><i class='fa fa-diamond'></i> Prospect</button>";
        	     
        	     $action .= "&nbsp;<button onclick=move_classfication(".$da->id.") class='btn btn-danger btn-xs'><i class='fa fa-arrows'></i> Move</button>";
        	 }
        	 else if($da->lead_type == '1' && $da->classfication == '1' && $da->policy_status == '0')
        	 {
        	     $action .= "&nbsp;<button onclick=move_to_lead(".$da->id.") class='btn btn-danger btn-xs'><i class='fa fa-arrows'></i> Lead</button>";
                
                 if($da->quote_status == '0')
                 {
                    $action .= "&nbsp;<button onclick=send_quote(".$da->id.",'".$da->lclass."')  class='btn btn-success btn-xs'><i class='fa fa-whatsapp'></i> Quote</button>";
                 }
                 else
                 {
                     $action .= "&nbsp;<button onclick=send_quote(".$da->id.",'".$da->lclass."')  class='btn btn-info btn-xs'><i class='fa fa-check'></i>Quote sent</button>";
                 }
                 
                 if($da->due_date != "0000-00-00")
        	     {
        	        $action .= "&nbsp;<button onclick=move_to_nextyear(".$da->id.") class='btn btn-primary btn-xs'><i class='fa fa-step-forward'></i></button>";   
        	     }
        	 }
        	 else if($da->policy_status == '1')
        	 {
        	     $action .= "&nbsp;<a href='generate_policy?id=".$da->id."' class='btn btn-primary btn-xs'><i class='fa fa-file'></i> Save policy</a>";
        	 }
        	 else
        	 {
        	     $action .= "&nbsp;<button onclick=move_classfication(".$da->id.") class='btn btn-danger btn-xs'><i class='fa fa-arrows'></i> Move</button>";
        	     if($da->due_date != "0000-00-00")
        	     {
        	        $action .= "&nbsp;<button onclick=move_to_nextyear(".$da->id.") class='btn btn-primary btn-xs'><i class='fa fa-step-forward'></i></button>";   
        	     }
        	 }
        	 
        	 $agn_name = "";
        	 $usr_name = "";
        	 
        	  $date = "No Due Date";
        	 
        	 if($da->due_date != "0000-00-00")
        	 {
        	    $date = date_format(date_create($da->due_date),"d-m-Y"); 
        	 }
        	 
        	 if($da->agency_and_pos != "all")
        	 {
        	     if($da->agency_and_pos != "")
        	     {
            	     $get_agent_name = $this->lm->get_agent_name($da->agency_and_pos);
            	     $agn_name = $get_agent_name->name;
        	     }
        	     else
        	     {
        	         $agn_name = "";
        	     }
        	 }
        	 else
        	 {
        	     $agn_name = "";
        	 }
        	 
        	 if($da->assigned_user != "all")
        	 {
        	     if($da->assigned_user != "")
        	     {
            	     $get_user = $this->lm->get_user_name($da->assigned_user);
            	     
            	     if($get_user != "")
            	     {
            	       $usr_name = $get_user->name;
            	     }
            	     else
            	     {
            	         $usr_name = "";
            	     }
        	     }
        	     else
        	     {
        	         $usr_name = "";
        	     }
        	 }
        	 else
        	 {
        	     $usr_name = "";
        	 }
        	 
    	    if($da->area_incharge != "all")
            {
                if($da->area_incharge != "")
                {
                     $ai = $this->lm->get_area_incharge($da->area_incharge);
                     
                     if($ai != null)
                     {
                       $ai = $ai->name;
                     }
                     else
                     {
                         $ai = "";
                     }
                }
                else
                {
                        $ai = "";
                }
            }
            else
            {
                 $ai = "";
            } 
        
          $client_name = "<a href='#' onclick=view_data(".$da->id.")>".$da->client_name."</a>";
            $arr[] =array(
                           $a,
                           $client_name,
                           $da->mobile_no,
                           $da->lclass,
                           $da->p_type,
                           $da->b_type,
                           $da->area,
                           $agn_name,
                           $usr_name,
                           $ai,
                           $date,
                           $action,
                        );
            }
    	   $result = array(
            			"draw"=> $draw,
				    "recordsTotal"=>count($res),
				    "recordsFiltered"=> count($res),
				    "data"=>$arr,
    				);
             echo json_encode($result);
    	 }

    }

	public function getCommissonByLead( $leadid = '')
    {
        if($this->session->has_userdata('logged_in')) 
    	{
    	    /*
            $policy_no = $this->input->post("policy_no");
            $policy_source = $this->input->post("policy_source");
            $policy_issue_date = $this->input->post("policy_issue_date");
            $lead_created_by = $this->session->userdata('session_name');
            $policy_premium= $this->input->post("policy_premium");
            $policy_agency_pos = $this->input->post("policy_agency_pos");
            $company = $this->input->post("company");
            $total_premium =$this->input->post("total_premium");
            $lead_id = $this->input->post("lead_id");
            */    
            
            if( $leadid ) {
    	        $policy_info = $this->lm->get_policy_details($leadid);
    	    }
    	    
            $policy_no = ( isset( $policy_info->policy_no ) && !empty ( $policy_info->policy_no ) ) ? $policy_info->policy_no : $this->input->post("policy_no");
            $policy_source = ( isset( $policy_info->policy_source ) && !empty ( $policy_info->policy_source ) ) ? $policy_info->policy_source : $this->input->post("policy_source");
            $policy_issue_date = ( isset( $policy_info->policy_issue_date ) && !empty ( $policy_info->policy_issue_date ) ) ? $policy_info->policy_issue_date : $this->input->post("policy_issue_date");
            $lead_created_by = $this->session->userdata('session_name');
            $policy_premium= ( isset( $policy_info->policy_premium ) && !empty ( $policy_info->policy_premium ) ) ? $policy_info->policy_premium : $this->input->post("policy_premium");
            $policy_agency_pos = ( isset( $policy_info->policy_agency_pos ) && !empty ( $policy_info->policy_agency_pos ) ) ? $policy_info->policy_agency_pos : $this->input->post("policy_agency_pos");
            $company = ( isset( $policy_info->company ) && !empty ( $policy_info->company ) ) ? $policy_info->company : $this->input->post("company");
            $total_premium = ( isset( $policy_info->total_premium ) && !empty ( $policy_info->total_premium ) ) ? $policy_info->total_premium : $this->input->post("total_premium");
            $lead_id = ( isset( $policy_info->lead_id ) && !empty ( $policy_info->lead_id ) ) ? $policy_info->lead_id : $this->input->post("lead_id");
            
            $rto = "";
            $age = "";
            // $lead_id = $this->input->post("lead_id");
            $class_type = $this->lm->get_class_type($lead_id);
                
            $from_date_1 = $policy_issue_date;//date_format(date_create($policy_issue_date),"01-m-Y");
            $to_date_1 = date_format(date_create($from_date_1),"t-m-Y");
                        
                        
            
            $data1 = [];                        
            if($class_type->class == "1")
            {
                $get_lead_info = $this->lm->get_lead_info($lead_id);
                $bussiness_type = $get_lead_info->business_type;
                $policy_class = $get_lead_info->class;
                $policy_type =  $get_lead_info->policy_type;
                $state = $get_lead_info->state;
                $rto = $get_lead_info->rto;
                $regndate =$get_lead_info->regn_date;
                $today = date("Y-m-d");
                $diff = date_diff(date_create($regndate), date_create($today));
                
                //$age = $diff->format('%y');
                $_vechage = $this->lm->getVechicleAge($lead_id, $policy_issue_date);
                $age = $_vechage->age;
                
                $fuel_type = $get_lead_info->vechi_fuel_type;
                $cc  = $get_lead_info->vechi_cc;
                $v_gvw = $get_lead_info->vechi_gvw;
                $v_seating = $get_lead_info->passenger_carrying;
                $make = $get_lead_info->vechi_make;
                $model = $get_lead_info->vechi_model;
                $Varient = $get_lead_info->vechi_varient;
                    
                // start 2023-08-17
                $renewal_lead = $get_lead_info->parent_lead_id;
                   
                $commission_id = [];
                
                $status = "0";
                $make_status = "0";
                $model_status = "0";
                $varient_status = "0";
                $rto_status = "0";
                $gvw_status = "0";
                $fuel_status = "0";
                $state_status = "0";
                $fuel_type_status = "0";
                    
                $data1 = array("status" =>"Commission Slab Not Exits","commission_id"=>"");
                
                $fuelTypes = [
                    '1' => ['1', '4', '5', '6'],
                    '2' => ['2', '5', '6'],
                    '5' => ['1', '2', '5', '6'],
                    '6' => ['1', '2', '3', '4', '5', '6'],
                    '7' => ['6', '7']
                ];
                
                $commissions = $this->cm->check_commission($company,$policy_premium,$policy_class,$bussiness_type,$policy_type,$state,$from_date_1,$to_date_1);
                
                var_dump($regndate.'-'.$age);
                if( isset( $commissions ) && !empty( $commissions ) ) {
                    foreach( $commissions as $commission ) {
                        $commissionlist[$commission->commission_type][] = $commission;
                        $commissionids[$commission->commission_type][] = $commission->id;
                        
                        $g_status = "0";
                        $fuel_status = "0";
                        if( $commission->commission_type == "2") {
                            $temp_min = $commission->vehicle_age_min;
                            $temp_max = $commission->vehicle_age_max;
                            
                    	    if($temp_min <= $age && $temp_max >= $age){
                    			$g_status = "1";
                    		}
                        } else if($commission->commission_type == "1") {
                            $temp_min = $commission->no_policy_min;
                            $temp_max = $commission->no_policy_max;
                            
                            if($temp_min <= 1 && $temp_max >= 1) {
                                 $g_status = "1";
                            }
                        } else if($commission->commission_type == "3") {
                            $temp_min = $commission->min_val;
                            $temp_max = $commission->max_val;
                            
                            if($temp_min <= $total_premium && $temp_max >= $total_premium) {
                                 $g_status = "1";
                            }
                        }
                        
                        $fuel_status = (in_array($commission->fuel_type, $fuelTypes[$fuel_type])) ? "1" : "0"; 
                        
                        if($g_status == "1" && $fuel_status == "1"){
            			    $commission_id[] = $commission->id;
            			    $status = "1";
                            $fuel_type_status = "1";
            			}
                    }
                }
                var_dump($commission_id);
                
                if( isset( $status ) && $status == "1") {
                    $check_state = $this->cm->check_state_by_commission_id($commission_id);
                    
                    $commission_id = [];
                    
                    foreach($check_state as $da)
                    {
                        if( in_array($da->state, [$state, 'All']) ){
                            $commission_id[] = $da->id;
                            $state_status = "1";
                        }
                    }
                }
                
                if( isset( $state_status ) && $state_status == "1") {
                    $classification = $this->cm->check_classification_by_commission_id(array_unique($commission_id));
                    
                    $commission_id =[];
                    if( isset( $classification ) && !empty( $classification ) ){
                        foreach( $classification as $ci ) {
                            $gvw_status = "1";
                            if( $ci->classification ){
                                if(in_array($policy_type, ['7','12','13','14','59', '60', '65', '66', '67', '68', '69', '70'])){
                                    $classic = $this->cm->check_seating(
                                        $v_seating,
                                        $policy_type,
                                        $commission_id
                                    );
                                    if( isset( $classic ) && !empty( $classic ) )
                                    {
                                        foreach($classic as $cl) {
                                            $commission_id[] = $cl->id;
                                        }
                                    }
                                } else if(in_array($policy_type, ['1', '2', '3', '4', '55'])){
                                    $classic = $this->lm->get_classification($ci->classification,$policy_type);
                                     
                                    if( isset( $classic ) && !empty( $classic ) ) {
                                         $temp_min = $classic->from_gvw_cc;
                                         $temp_max = $classic->to_gvw_cc;
    
                                         if(($cc >= $temp_min && $cc <= $temp_max))
                                         {
                                             $commission_id[] = $ci->id;
                                             $gvw_status = "1";
                                         }
                                    }
                                } else {
                                    $classic = $this->lm->get_classification($ci->classification,$policy_type);
                                    
                                    if( isset( $classic ) && !empty( $classic ) ) {
                                        $temp_min = $classic->from_gvw_cc;
                                        $temp_max = $classic->to_gvw_cc;
                                        
                                        if($v_gvw >= $temp_min && $v_gvw <= $temp_max)
                                        {
                                            $gvw_status = "1";
                                            $commission_id[] = $ci->id;
                                        }
                                    }
                                }
                            } else {
                                $commission_id[] = $ci->id;
                            }
                        }
                    }
                    
                    
                    $check_make_1 = $this->cm->check_make_already_exits($commission_id,$policy_type,$make);
                    
                    if( isset( $check_make_1 ) && !empty( $check_make_1 ) ) {
                        $commission_id = [];
                        foreach($check_make_1 as $mrow){
                            $commission_id[] = $mrow->commission_id;
                        }
                        $status = "1";
                        $make_status = "1";
                    } else {
                        $check_make = $this->lm->check_make_all_already_exits(array_unique($commission_id),$policy_type);
                       
                        if( isset( $check_make ) && !empty( $check_make ) ) {
                            $commission_id = [];
                            foreach($check_make as $mrow) {
                              $commission_id[] = $mrow->id;
                            }
                            $status = "1";
                            $make_status = "1";
                        }
                    }
                    
                    $check_model_1 = $this->lm->check_model_already_exits(array_unique($commission_id),$policy_type,$make,$model);
                    
                    if( isset( $check_model_1 ) && !empty( $check_model_1 ) ) {
                        $commission_id = [];
                        foreach($check_model_1 as $mlrow){
                           $commission_id[] = $mlrow->commission_id;
                        }
                        $status = "1";
                        $model_status = "1";
                    } else {
                        $check_model = $this->pm->check_model_all_already_exits(array_unique($commission_id),$policy_type);
                        if( isset( $check_model ) && !empty( $check_model ) ){
                            $commission_id = [];
                            foreach($check_model as $mlrow) {
                                 $commission_id[] = $mlrow->id;
                            }
                            $status = "1";
                            $model_status = "1";
                        }
                    }
                    
                    if(isset( $make_status ) && $make_status == "1" && isset( $model_status ) && $model_status == "1") {
                        $check_varient_1 = $this->cm->check_varient_already_exits(array_unique($commission_id),$policy_type,$make,$model,$Varient);
                        
                        if( isset( $check_varient_1 ) && !empty( $check_varient_1 ) ) {
                            $commission_id = [];
                            foreach($check_varient_1 as $vrow) {
                              $commission_id[] = $vrow->commission_id;
                            }
                            $status = "1";
                            $varient_status = "1";
                        } else {
                            $check_varient = $this->pm->check_varient_all_already_exits(array_unique($commission_id),$policy_type);
                            if( isset( $check_varient ) && !empty( $check_varient ) ) {
                                $commission_id = [];
                                foreach($check_varient as $vrow) {
                                     $commission_id[] = $vrow->id;
                                }
                                $status = "1";
                    	        $varient_status = "1";
                            }
                        }
                    }
                    
                    if($status == "1" && $state_status == "1" && $fuel_type_status == "1" && $gvw_status == "1" && $make_status == "1" && $model_status == "1" && $varient_status == "1")
                    {
                        var_dump($commission_id);
                        $check_rto = $this->cm->check_rto_already_exits_2(array_unique($commission_id),$rto);
                        $scommission_id = [];
                        if( isset( $check_rto ) && !empty( $check_rto ) ) {
                            foreach($check_rto as $rt)
                            {
                                $com_id = $rt->commission_id;
                                $scommission_id[] = $rt->commission_id;
                            }
                            
                            // start 2023-08-17
                            if($renewal_lead){
                                $chk_renewal_com = $this->lm->check_renewal_commission($scommission_id, 'Renewal');     
                                echo $this->db->last_query();
                                $com_id = (isset($chk_renewal_com->id) && !empty( $chk_renewal_com->id ) ) ? $chk_renewal_com->id : $com_id;
                            } else {
                                $chk_renewal_com = $this->lm->check_renewal_commission($scommission_id, 'Fresh');     
                                $com_id = (isset($chk_renewal_com->id) && !empty( $chk_renewal_com->id ) ) ? $chk_renewal_com->id : $com_id;
                            }
                            
                            $chk_spl_com = $this->lm->spl_commission_for_agent($scommission_id,$policy_agency_pos, $policy_issue_date); 
                            
                            if( isset( $chk_spl_com ) && !empty( $chk_spl_com ) ) {
                                $com_id = (isset($chk_spl_com->commission_id) && !empty( $chk_spl_com->commission_id ) ) ? $chk_spl_com->commission_id : $com_id;
                            }
                            
                            $data1 = array("status" =>"success" ,"commission_id"=>$com_id);
                            
                            if( isset( $policy_info->vocher_status ) && ( $policy_info->vocher_status == "1" ) && 
                                ($policy_info->company_vocher_status == "0" ) && $com_id != $policy_info->commission_id)
                            { 
                                $data1['old_commission_id'] = $policy_info->commission_id;
                            }
                            
                            /*if(!$this->cm->check_policy_already_exits($lead_id))
                            {
                                echo '<pre>e';print_r($com_id);print'</pre>';
                                if(!$this->cm->check_policy_no_already_exits($policy_no))
                                {
                                    echo $this->db->last_query();
                                     
                                }
                            }*/
                        }
                     }
                }
                
                echo '<pre>';print_r($data1);print'</pre>';
                return $data1;
                
            } else if($class_type->class == "2"){
                $bussiness_type = $class_type->business_type;
                $policy_class = $class_type->class;
                $policy_type =  $class_type->policy_type;
                $state = "All";
                   
                $data1 = array("status" =>"Commission Slab Not Exits","commission_id"=>"");
                   
                $commissions = $this->cm->check_health_commission($company,$policy_premium,$policy_class,$bussiness_type,$policy_type,$state,$from_date_1,$to_date_1);
                var_dump($this->db->last_query());
                if( isset( $commissions ) && !empty( $commissions ) ) {
                    foreach( $commissions as $commission ) {
                        $commissionlist[$commission->commission_type][] = $commission;
                        $commissionids[$commission->commission_type][] = $commission->id;
                        
                        var_dump("ctype = " . $commission->commission_type);
                        
                        if($commission->commission_type == "1") {
                            $temp_min = $commission->no_policy_min;
                            $temp_max = $commission->no_policy_max;
                            
                            if($temp_min <= 1 && $temp_max >= 1) {
                                 $status = "1";
                            }
                        } else if($commission->commission_type == "3") {
                            $temp_min = $commission->min_val;
                            $temp_max = $commission->max_val;
                            var_dump( "total = ".$total_premium . ", min = ".$temp_min. ", max = ".$temp_max);
                            if($temp_min <= $total_premium && $temp_max >= $total_premium) {
                                 $status = "1";
                            }
                        }
                        
                        if($status == "1"){
            			    $commission_id[] = $commission->id;
            			}
                    }
                }
                var_dump($commission_id);
                if(!empty($commission_id))
                {
                    $res = $this->cm->check_health_state($commission_id);
                    $commission_id = [];
                    $c_id = "";

                    if(!empty($res)){
                        foreach($res as $da)
                        {
                            if($da->state != "All") {  // ✅ check inside the loop, not before it
                                $commission_id[] = $da->id;
                                $c_id = $da->id;
                            }
                        }
                    }

                    if(!empty($commission_id)){
                        $data1 = array("status" => "success", "commission_id" => $c_id);
                    }
                }

                 $data1 = array("status" =>"success","commission_id"=>$c_id);
                // if( isset( $policy_info->vocher_status ) && ( $policy_info->vocher_status == "1" ) && 
                //     isset( $policy_info->company_vocher_status ) && ($policy_info->company_vocher_status == "0" ) )
                // { 
                //     $data1['old_commission_id'] = $policy_info->commission_id;
                // }
                
                return $data1;
              }
    	}
   }
   
   
    public function find_commission_id($leadid = '')
    {
        if($this->session->has_userdata('logged_in')) 
    	{
    	    if( $leadid ) {
    	        $policy_info = $this->lm->get_policy_details($leadid);
    	    }
            $policy_no = ( isset( $policy_info->policy_no ) && !empty ( $policy_info->policy_no ) ) ? $policy_info->policy_no : $this->input->post("policy_no");
            $policy_source = ( isset( $policy_info->policy_source ) && !empty ( $policy_info->policy_source ) ) ? $policy_info->policy_source : $this->input->post("policy_source");
            $policy_issue_date = ( isset( $policy_info->policy_issue_date ) && !empty ( $policy_info->policy_issue_date ) ) ? $policy_info->policy_issue_date : $this->input->post("policy_issue_date");
            $lead_created_by = $this->session->userdata('session_name');
            $policy_premium= ( isset( $policy_info->policy_premium ) && !empty ( $policy_info->policy_premium ) ) ? $policy_info->policy_premium : $this->input->post("policy_premium");
            $policy_agency_pos = ( isset( $policy_info->policy_agency_pos ) && !empty ( $policy_info->policy_agency_pos ) ) ? $policy_info->policy_agency_pos : $this->input->post("policy_agency_pos");
            $company = ( isset( $policy_info->company ) && !empty ( $policy_info->company ) ) ? $policy_info->company : $this->input->post("company");
            $total_premium = ( isset( $policy_info->total_premium ) && !empty ( $policy_info->total_premium ) ) ? $policy_info->total_premium : $this->input->post("total_premium");
            $lead_id = ( isset( $policy_info->lead_id ) && !empty ( $policy_info->lead_id ) ) ? $policy_info->lead_id : $this->input->post("lead_id");
            
            $rto = "";
            $age = "";
           // $lead_id = $this->input->post("lead_id");
            $class_type = $this->lm->get_class_type($lead_id);
            
            $from_date_1 = $policy_issue_date;//date_format(date_create($policy_issue_date),"01-m-Y");
            $to_date_1 = date_format(date_create($from_date_1),"t-m-Y");
                    
           
           if($class_type->class == "1")
           {
                    $get_lead_info = $this->lm->get_lead_info($lead_id);
                    $bussiness_type = $get_lead_info->business_type;
                    $policy_class = $get_lead_info->class;
                    $policy_type =  $get_lead_info->policy_type;
                    $state = $get_lead_info->state;
                    $rto = $get_lead_info->rto;
                    $regndate =$get_lead_info->regn_date;
                    $today = date("Y-m-d");
                    $diff = date_diff(date_create($regndate), date_create($today));
                    
                    //$age = $diff->format('%y');
                    $_vechage = $this->lm->getVechicleAge($lead_id, $policy_issue_date);
                    $age = $_vechage->age;
                    
                    $fuel_type = $get_lead_info->vechi_fuel_type;
                    $cc  = $get_lead_info->vechi_cc;
                    $v_gvw = $get_lead_info->vechi_gvw;
                    $v_seating = $get_lead_info->passenger_carrying;
                    $make = $get_lead_info->vechi_make;
                    $model = $get_lead_info->vechi_model;
                    $Varient = $get_lead_info->vechi_varient;
                    
                   
                    $commission_id = [];
                    
                    $status = "0";
                    $make_status = "0";
                    $model_status = "0";
                    $varient_status = "0";
                    $rto_status = "0";
                    $gvw_status = "0";
                    $fuel_status = "0";
                    $state_status = "0";
                    $fuel_type_status = "0";
                    
                    $data1 = array("status" =>"Commission Slab Not Exits","commission_id"=>"");
                    
                    $check = $this->cm->check_commission($company,$policy_premium,$policy_class,$bussiness_type,$policy_type,$state,$from_date_1,$to_date_1);
    
                   
                     
                    foreach($check as $da)
                    {
                        if($da->commission_type == "2")
                        {
                            foreach($check as $da)
                        	{
                                    $temp_min = $da->vehicle_age_min;
                                    $temp_max = $da->vehicle_age_max;
                                    $g_status = "0";
                                    $fuel_status = "0";
                    		    
                            	    if($temp_min <= $age && $temp_max >= $age)
                            		{
                            			$g_status = "1";
                            		}
                            		
                                    if($fuel_type == "1")
                                    {
                                    	if($da->fuel_type == "4" || $da->fuel_type == "5" || $da->fuel_type == "1" || $da->fuel_type == "6")
                                    	{
                                    	    $fuel_status = "1";
                                    	}
                                    }
                                    if($fuel_type == "2")
                                    {
                                        if($da->fuel_type == "5" || $da->fuel_type == "2" || $da->fuel_type == "6")
                                    	{
                                    	    $fuel_status = "1";
                                    	}
                                    }
                                    if($fuel_type == "5")
                                    {
                                        if($da->fuel_type == "5" || $da->fuel_type == "1" || $da->fuel_type == "2" || $da->fuel_type == "6")
                                    	{
                                    	    $fuel_status = "1";
                                    	}
                                    }
                                    if($fuel_type == "6")
                                    {
                                        if($da->fuel_type == "1" || $da->fuel_type == "2" || $da->fuel_type == "3" || $da->fuel_type == "4" || $da->fuel_type == "5" || $da->fuel_type == "6")
                                    	{
                                    	    $fuel_status = "1";
                                    	}
                                    }
                                    if($fuel_type == "7")
                                    {
                                        if($da->fuel_type == "7" || $da->fuel_type == "6")
                                    	{
                                    	    $fuel_status = "1";
                                    	}
                                    }
                        		 
                        		 
                        			if($g_status == "1" && $fuel_status == "1")
                        			{
                        			    $commission_id[] = $da->id;
                        			    $status = "1";
                                        $fuel_type_status = "1";
                        			}
                    	      }
                    	      
    
                            if($status == "1")
                            {
                                $check_state = $this->cm->check_state_by_commission_id(array_unique($commission_id));
                                $commission_id = [];
                                
                                foreach($check_state as $da)
                                {
                                    if($da->state == $state)
                                    {
                                         $commission_id[] = $da->id;
                                         $state_status = "1";
                                    }
                                    else if($da->state == "All")
                                    {
                                        $commission_id[] = $da->id;
                                        $state_status = "1";
                                    }
                               }
                               
    
                                 if($state_status == "1")
                                 {
                                    $classification = $this->cm->check_classification_by_commission_id(array_unique($commission_id));
                                    
                                    $temp_commission_id = [];
                                    $temp_commission_id = $commission_id;
                                    $commission_id = [];
                                   
                                    foreach($classification as $cl)
                                    {
                                        if($policy_type == "7" || $policy_type == "12" || $policy_type == "13" || $policy_type == "14" || $policy_type == "59" || $policy_type == "60" || $policy_type == "65" || $policy_type == "66" || $policy_type == "67" || $policy_type == "68" || $policy_type == "69" || $policy_type == "70")
                                        {
                                            if($cl->classification != "")
                                            {
                                               $classification = $this->cm->check_seating($v_seating,$policy_type,$temp_commission_id);
                                              
                                                if(count($classification) > 0)
                                                {
                                                    $gvw_status = "1";
                                                    foreach($classification as $da)
                                                    {
                                                        $commission_id[] = $cl->id;
                                                        $gvw_status = "1";
                                                    }
                                                }
                                            }
                                            else
                                            {
                                                $commission_id = $temp_commission_id;
                                                $gvw_status = "1";
                                            }
                                        }
                                        else if($policy_type == "1" || $policy_type == "2" || $policy_type == "3" || $policy_type == "4" || $policy_type == "55")
                                        {
                                            if($cl->classification != "")
                                            {
                                                $classification = $this->lm->get_classification($cl->classification,$policy_type);
                                             
                                                if($classification != null || $classification != "")
                                                {
                                                     $temp_min = $classification->from_gvw_cc;
                                                     $temp_max = $classification->to_gvw_cc;
    
                                                     if(($cc >= $temp_min && $cc <= $temp_max))
                                                     {
                                                         $commission_id[] = $cl->id;
                                                         $gvw_status = "1";
                                                     }
                                                }
                                            }
                                            else
                                            {
                                                $gvw_status = "1";
                                                $commission_id = $temp_commission_id;
                                            }
                                        }
                                        else
                                        {
                                            if($cl->classification != "")
                                            {
                                                $classification = $this->lm->get_classification($cl->classification,$policy_type);
                                              
                                                if($classification != null)
                                                {
                                                    $temp_min = $classification->from_gvw_cc;
                                                    $temp_max = $classification->to_gvw_cc;
                                                    
                                                    if($v_gvw >= $temp_min && $v_gvw <= $temp_max)
                                                    {
                                                        $gvw_status = "1";
                                                        $commission_id[] = $cl->id;
                                                    }
                                                }
                                            }
                                            else
                                            {
                                                $gvw_status = "1";
                                                $commission_id = $temp_commission_id;
                                            }
                                        }
                                    }
                                    
                                   $check_make_1 = $this->cm->check_make_already_exits(array_unique($commission_id),$policy_type,$make);
                                    
                                    if(count($check_make_1) > 0)
                                    {
                                            if(count($check_make_1) > 0)
                                            {
                                                $commission_id = [];
                                                
                                                foreach($check_make_1 as $da)
                                                {
                                                     $commission_id[] = $da->commission_id;
                                                }
                                                $status = "1";
                                                $make_status = "1";
                                            }
                                            else
                                            {
                                                $make_status = "0";
                                            }
                                    }
                                    else
                                    {
                                        $check_make = $this->lm->check_make_all_already_exits(array_unique($commission_id),$policy_type);
                                        
                                        if(count($check_make) > 0)
                                        {
                                            $commission_id = [];
                                            
                                            foreach($check_make as $da)
                                            {
                                              $commission_id[] = $da->id;
                                            }
                                            
                                            $status = "1";
                                            $make_status = "1";
                                        }
                                    }
    
                                    $check_model_1 = $this->lm->check_model_already_exits(array_unique($commission_id),$policy_type,$make,$model);
                                     
                                    if(count($check_model_1) > 0)
                                    {
                                        $commission_id = [];
                                        
                                        foreach($check_model_1 as $da)
                                        {
                                           $commission_id[] = $da->commission_id;
                                        }
                                        
                                        $status = "1";
                                        $model_status = "1";
                                    }
                                    else
                                    {
                                        $check_model = $this->pm->check_model_all_already_exits(array_unique($commission_id),$policy_type);
                                        if(count($check_model) > 0)
                                        {
                                                $commission_id = [];
                                                foreach($check_model as $da)
                                                {
                                                     $commission_id[] = $da->id;
                                                }
                                             $status = "1";
                                             $model_status = "1";
                                        }
                                    }
                                    
                                    if($make_status == "1" && $model_status == "1")
                                    {
                                        $check_varient_1 = $this->cm->check_varient_already_exits(array_unique($commission_id),$policy_type,$make,$model,$Varient);
                                       
                                        if(count($check_varient_1) > 0) 
                                        {
                                            $commission_id = [];
                                            foreach($check_varient_1 as $da)
                                            {
                                              $commission_id[] = $da->commission_id;
                                            }
                                            $status = "1";
                                            $varient_status = "1";
                                        }
                                        else
                                        {
                                            $check_varient = $this->pm->check_varient_all_already_exits(array_unique($commission_id),$policy_type);
                                            if(count($check_varient) > 0)
                                            {
                                                $commission_id = [];
                                                
                                                foreach($check_varient as $da)
                                                {
                                                     $commission_id[] = $da->id;
                                                }
                                                 $status = "1";
                                    	         $varient_status = "1";
                                            }
                                        }
                                    }
                                    
    
                                    if($status == "1" && $state_status == "1" && $fuel_type_status == "1" && $gvw_status == "1" && $make_status == "1" && $model_status == "1" && $varient_status == "1")
                                    {
                                         $check_rto = $this->cm->check_rto_already_exits_2(array_unique($commission_id),$rto);
                                          
                                            if(count($check_rto) > 0)
                                            {
                                                foreach($check_rto as $rt)
                                                {
                                                    $com_id = $rt->commission_id;
                                                }
                                              
                                                if(!$this->cm->check_policy_already_exits($lead_id))
                                                {
                                                    if(!$this->cm->check_policy_no_already_exits($policy_no))
                                                    {
                                                         $data1 = array("status" =>"success" ,"commission_id"=>$com_id);
                                                    }
                                                }
                                                else
                                                {
                                                    $data1 = array("status" =>"Policy Already Exits","commission_id"=>"");
                                                }
                                            }
                                            else
                                            {
                                                $data1 = array("status" =>"RTO Mismatched","commission_id"=>"");
                                            }
                                     }
                                    else if($state_status == "0")
                                    {
                                        $data1 = array("status" =>"State Mismacthed","commission_id"=>"");
                                    }
                                    else if($fuel_type_status == "0")
                                    {
                                        $data1 = array("status" =>"Fuel Type Mismacthed","commission_id"=>"");
                                    }
                                    else if($gvw_status == "0")
                                    {
                                        $data1 = array("status" =>"Classification Mismatched","commission_id"=>"");
                                    }
                                    else if($make_status == "0")
                                    {
                                         $data1 = array("status" =>"Make Mismactched","commission_id"=>"");
                                    }
                                    else if($model_status == "0")
                                    {
                                         $data1 = array("status" =>"Model Mismactched","commission_id"=>"");
                                    }
                                    else if($varient_status == "0")
                                    {
                                         $data1 = array("status" =>"Varient Mismactched","commission_id"=>"");
                                    }
                                }
                                 else
                                 {
                                     $data1 = array("status" =>"State Mismacthed","commission_id"=>"");
                                 }
                             }
                            else
                            {
                                 $data1 = array("status" =>"Insurance company or Slab or Fuel Type Mismacthed","commission_id"=>"");
                             }
                         }
                        else if($da->commission_type == "1")
                        {
                            $g_status = "0";
                            $fuel_status = "0";
                            
                            foreach($check as $da)
                        	{
                                $temp_min = $da->no_policy_min;
                                $temp_max = $da->no_policy_max;
                                
    
                                if($temp_min <= 1 && $temp_max >= 1)
                                {
                                     $g_status = "1";
                                     $commission_id[] = $da->id;
                                }
    
                                
                                if($fuel_type == "1")
                                {
                                	if($da->fuel_type == "4" || $da->fuel_type == "5" || $da->fuel_type == "1" || $da->fuel_type == "6")
                                	{
                                	    $fuel_status = "1";
                                	}
                                }
                                
    
                                if($fuel_type == "2")
                                {
                                    if($da->fuel_type == "5" || $da->fuel_type == "2" || $da->fuel_type == "6")
                                	{
                                	    $fuel_status = "1";
                                	}
                                }
                                
                                if($fuel_type == "5")
                                {
                                    if($da->fuel_type == "5" || $da->fuel_type == "1" || $da->fuel_type == "2" || $da->fuel_type == "6")
                                	{
                                	    $fuel_status = "1";
                                	}
                                }
                                
                                if($fuel_type == "6")
                                {
                                    if($da->fuel_type == "1" || $da->fuel_type == "2" || $da->fuel_type == "3" || $da->fuel_type == "4" || $da->fuel_type == "5" || $da->fuel_type == "6")
                                	{
                                	    $fuel_status = "1";
                                	}
                                }
                                
                                if($fuel_type == "7")
                                {
                                    if($da->fuel_type == "7" || $da->fuel_type == "6")
                                	{
                                	    $fuel_status = "1";
                                	}
                                }
                    		   
                    			if($g_status == "1" && $fuel_status == "1")
                    			{
                    			    $commission_id[] = $da->id;
                    			    $status = "1";
                                    $fuel_type_status = "1";
                    			}
                        	}
                        	
                      
                        	
    
                            if($status == "1")
                            {
                                $check_state = $this->cm->check_state_by_commission_id(array_unique($commission_id));
                                
                                $commission_id = [];
                                
                                foreach($check_state as $da)
                                {
                                    if($da->state == $state)
                                    {
                                         $commission_id[] = $da->id;
                                         $state_status = "1";
                                    }
                                    else if($da->state == "All")
                                    {
                                        $commission_id[] = $da->id;
                                        $state_status = "1";
                                    }
                                }
                                
                                if($state_status == "1")
                                {
                                    $classification = $this->cm->check_classification_by_commission_id(array_unique($commission_id));
                                    $temp_commission_id = [];
                                    $temp_commission_id = $commission_id;
                                    $commission_id = [];
                                
                                    foreach($classification as $cl)
                                    {
                                        if($policy_type == "7" || $policy_type == "12" || $policy_type == "13" || $policy_type == "14" || $policy_type == "59" || $policy_type == "60" || $policy_type == "65" || $policy_type == "66" || $policy_type == "67" || $policy_type == "68" || $policy_type == "69" || $policy_type == "70")
                                        {
                                            if($cl->classification != "")
                                            {
                                               $classification = $this->cm->check_seating($v_seating,$policy_type,$temp_commission_id);
                                               
                                                if(count($classification) > 0)
                                                {
                                                    $gvw_status = "1";
                                                    
                                                    foreach($classification as $da)
                                                    {
                                                        $commission_id[] = $cl->id;
                                                        $gvw_status = "1";
                                                    }
                                                }
                                            }
                                            else
                                            {
                                                $commission_id = $temp_commission_id;
                                                $gvw_status = "1";
                                            }
                                        }
                                        else if($policy_type == "1" || $policy_type == "2" || $policy_type == "3" || $policy_type == "4" || $policy_type == "55")
                                        {
                                            if($cl->classification != "")
                                            {
                                                $classification = $this->lm->get_classification($cl->classification,$policy_type);
                                             
                                                if($classification != null)
                                                {
                                                     $temp_min = $classification->from_gvw_cc;
                                                     $temp_max = $classification->to_gvw_cc;
                                                     
                                                     if(($cc >= $temp_min && $cc <= $temp_max))
                                                     {
                                                         $commission_id[] = $cl->id;
                                                         $gvw_status = "1";
                                                     }
                                                }
                                            }
                                            else
                                            {
                                                $gvw_status = "1";
                                                $commission_id = $temp_commission_id;
                                            }
                                        }
                                        else
                                        {
                                            if($cl->classification != "")
                                            {
                                                $classification = $this->lm->get_classification($cl->classification,$policy_type);
                                              
                                                if($classification != null)
                                                {
                                                    $temp_min = $classification->from_gvw_cc;
                                                    $temp_max = $classification->to_gvw_cc;
                                                    
                                                    if($v_gvw >= $temp_min && $v_gvw <= $temp_max)
                                                    {
                                                        $gvw_status = "1";
                                                        $commission_id[] = $cl->id;
                                                    }
                                                }
                                            }
                                            else
                                            {
                                                $gvw_status = "1";
                                                $commission_id = $temp_commission_id;
                                            }
                                        }
                                    }
                                
                                    $check_make_1 = $this->cm->check_make_already_exits(array_unique($commission_id),$policy_type,$make);
                                    
                                    if(count($check_make_1) > 0)
                                    {
                                            if(count($check_make_1) > 0)
                                            {
                                                $commission_id = [];
                                                
                                                foreach($check_make_1 as $da)
                                                {
                                                     $commission_id[] = $da->commission_id;
                                                }
                                                $status = "1";
                                                $make_status = "1";
                                            }
                                            else
                                            {
                                                $make_status = "0";
                                            }
                                    }
                                    else
                                    {
                                        $check_make = $this->lm->check_make_all_already_exits(array_unique($commission_id),$policy_type);
                                        
                                        if(count($check_make) > 0)
                                        {
                                            $commission_id = [];
                                            
                                            foreach($check_make as $da)
                                            {
                                              $commission_id[] = $da->id;
                                            }
                                            
                                            $status = "1";
                                            $make_status = "1";
                                        }
                                    }
    
                                    $check_model_1 = $this->lm->check_model_already_exits(array_unique($commission_id),$policy_type,$make,$model);
                                     
                                    if(count($check_model_1) > 0)
                                    {
                                        $commission_id = [];
                                        
                                        foreach($check_model_1 as $da)
                                        {
                                           $commission_id[] = $da->commission_id;
                                        }
                                        
                                        $status = "1";
                                        $model_status = "1";
                                    }
                                    else
                                    {
                                        $check_model = $this->pm->check_model_all_already_exits(array_unique($commission_id),$policy_type);
                                        if(count($check_model) > 0)
                                        {
                                                $commission_id = [];
                                                foreach($check_model as $da)
                                                {
                                                     $commission_id[] = $da->id;
                                                }
                                             $status = "1";
                                             $model_status = "1";
                                        }
                                    }
                                    
                                    if($make_status == "1" && $model_status == "1")
                                    {
                                        $check_varient_1 = $this->cm->check_varient_already_exits(array_unique($commission_id),$policy_type,$make,$model,$Varient);
                                       
                                        if(count($check_varient_1) > 0) 
                                        {
                                            $commission_id = [];
                                            foreach($check_varient_1 as $da)
                                            {
                                              $commission_id[] = $da->commission_id;
                                            }
                                            $status = "1";
                                            $varient_status = "1";
                                        }
                                        else
                                        {
                                            $check_varient = $this->pm->check_varient_all_already_exits(array_unique($commission_id),$policy_type);
                                            if(count($check_varient) > 0)
                                            {
                                                $commission_id = [];
                                                
                                                foreach($check_varient as $da)
                                                {
                                                     $commission_id[] = $da->id;
                                                }
                                                 $status = "1";
                                    	         $varient_status = "1";
                                            }
                                        }
                                    }
                        
                                    if($status == "1" && $state_status == "1" && $fuel_type_status == "1" && $gvw_status == "1" && $make_status == "1" && $model_status == "1" && $varient_status == "1")
                                    {
                                         $check_rto = $this->cm->check_rto_already_exits_2(array_unique($commission_id),$rto);
                                         
                                            if(count($check_rto) > 0)
                                            {
                                                foreach($check_rto as $rt)
                                                {
                                                    $com_id = $rt->commission_id;
                                                }
                                                if(!$this->cm->check_policy_already_exits($lead_id))
                                                {
                                                    if(!$this->cm->check_policy_no_already_exits($policy_no))
                                                    {
                                                         $data1 = array("status" =>"success" ,"commission_id"=>$com_id);
                                                    }
                                                    else
                                                    {
                                                        $data1 = array("status" =>"Policy no Already Exits" ,"commission_id"=>$com_id);
                                                    }
                                                }
                                                else
                                                {
                                                    $data1 = array("status" =>"LeadID Already Exits","commission_id"=>"");
                                                }
                                            }
                                     }
                                    else if($fuel_type_status == "0")
                                    {
                                      $data1 = array("status" =>"Fuel Type Mismacthed","commission_id"=>"");
                                    }
                                    else if($gvw_status == "0")
                                    {
                                      $data1 = array("status" =>"Classification Mismatched","commission_id"=>"");
                                    }
                                    else if($make_status == "0")
                                    {
                                      $data1 = array("status" =>"Make Mismactched","commission_id"=>"");
                                    }
                                    else if($model_status == "0")
                                    {
                                      $data1 = array("status" =>"Model Mismactched","commission_id"=>"");
                                    }
                                    else if($varient_status == "0")
                                    {
                                      $data1 = array("status" =>"Varient Mismactched","commission_id"=>"");
                                    }
                                }
                                else
                                {
                                     $data1 = array("status" =>"State Mismacthed","commission_id"=>"");
                                }
                             }
                            else 
                            {
                              $data1 = array("status" =>"Insurance company or Slab1 Mismacthed","commission_id"=>"");
                            }
                        }
                        else if($da->commission_type == "3")
                        {
                            $g_status = "0";
                            $fuel_status = "0";
                            
                            foreach($check as $da)
                        	{
                                $temp_min = $da->min_val;
                                $temp_max = $da->max_val;
                                
                                if($temp_min <= $total_premium && $temp_max >= $total_premium)
                                {
                                     $g_status = "1";
                                     $commission_id[] = $da->id;
                                }
                                
                                if($fuel_type == "1")
                                {
                                	if($da->fuel_type == "4" || $da->fuel_type == "5" || $da->fuel_type == "1" || $da->fuel_type == "6")
                                	{
                                	    $fuel_status = "1";
                                	}
                                }
                                if($fuel_type == "2")
                                {
                                    if($da->fuel_type == "5" || $da->fuel_type == "2" || $da->fuel_type == "6")
                                	{
                                	    $fuel_status = "1";
                                	}
                                }
                                if($fuel_type == "5")
                                {
                                    if($da->fuel_type == "5" || $da->fuel_type == "1" || $da->fuel_type == "2" || $da->fuel_type == "6")
                                	{
                                	    $fuel_status = "1";
                                	}
                                }
                                if($fuel_type == "6")
                                {
                                    if($da->fuel_type == "1" || $da->fuel_type == "2" || $da->fuel_type == "3" || $da->fuel_type == "4" || $da->fuel_type == "5" || $da->fuel_type == "6")
                                	{
                                	    $fuel_status = "1";
                                	}
                                }
                                if($fuel_type == "7")
                                {
                                    if($da->fuel_type == "7" || $da->fuel_type == "6")
                                	{
                                	    $fuel_status = "1";
                                	}
                                }
                    		   
                    			if($g_status == "1" && $fuel_status == "1")
                    			{
                    			    $commission_id[] = $da->id;
                    			    $status = "1";
                                    $fuel_type_status = "1";
                                  
                    			}
                        	}
                        	
                            if($status == "1")
                            {
                                $check_state = $this->cm->check_state_by_commission_id(array_unique($commission_id));
                                $commission_id = [];
                                
                                foreach($check_state as $da)
                                {
                                    if($da->state == $state)
                                    {
                                         $commission_id[] = $da->id;
                                         $state_status = "1";
                                    }
                                    else if($da->state == "All")
                                    {
                                        $commission_id[] = $da->id;
                                        $state_status = "1";
                                    }
                                }
                                
                                if($state_status == "1")
                                {
                                    $classification = $this->cm->check_classification_by_commission_id(array_unique($commission_id));
                                    $temp_commission_id = [];
                                    $temp_commission_id = $commission_id;
                                
                                     $commission_id = [];
                                
                                    foreach($classification as $cl)
                                    {
                                        if($policy_type == "7" || $policy_type == "12" || $policy_type == "13" || $policy_type == "14" || $policy_type == "59" || $policy_type == "60" || $policy_type == "65" || $policy_type == "66" || $policy_type == "67" || $policy_type == "68" || $policy_type == "69" || $policy_type == "70")
                                        {
                                            if($cl->classification != "")
                                            {
                                               $classification = $this->cm->check_seating($v_seating,$policy_type,$temp_commission_id);
                                               
                                                if(count($classification) > 0)
                                                {
                                                    $gvw_status = "1";
                                                    
                                                    foreach($classification as $da)
                                                    {
                                                        $commission_id[] = $cl->id;
                                                        $gvw_status = "1";
                                                    }
                                                }
                                            }
                                            else
                                            {
                                                $commission_id = $temp_commission_id;
                                                $gvw_status = "1";
                                            }
                                        }
                                        else if($policy_type == "1" || $policy_type == "2" || $policy_type == "3" || $policy_type == "4" || $policy_type == "55")
                                        {
                                            if($cl->classification != "")
                                            {
                                                $classification = $this->lm->get_classification($cl->classification,$policy_type);
                                             
                                                if($classification != null)
                                                {
                                                     $temp_min = $classification->from_gvw_cc;
                                                     $temp_max = $classification->to_gvw_cc;
                                                     
                                                     if(($cc >= $temp_min && $cc <= $temp_max))
                                                     {
                                                         $commission_id[] = $cl->id;
                                                         $gvw_status = "1";
                                                     }
                                                }
                                            }
                                            else
                                            {
                                                $gvw_status = "1";
                                                $commission_id = $temp_commission_id;
                                            }
                                        }
                                        else
                                        {
                                            if($cl->classification != "")
                                            {
                                                $classification = $this->lm->get_classification($cl->classification,$policy_type);
                                              
                                                if($classification != null)
                                                {
                                                    $temp_min = $classification->from_gvw_cc;
                                                    $temp_max = $classification->to_gvw_cc;
                                                    
                                                    if($v_gvw >= $temp_min && $v_gvw <= $temp_max)
                                                    {
                                                        $gvw_status = "1";
                                                        $commission_id[] = $cl->id;
                                                    }
                                                }
                                            }
                                            else
                                            {
                                                $gvw_status = "1";
                                                $commission_id = $temp_commission_id;
                                            }
                                        }
                                    }
                                
                                     $check_make_1 = $this->cm->check_make_already_exits(array_unique($commission_id),$policy_type,$make);
                                    
                                    if(count($check_make_1) > 0)
                                    {
                                            if(count($check_make_1) > 0)
                                            {
                                                $commission_id = [];
                                                
                                                foreach($check_make_1 as $da)
                                                {
                                                     $commission_id[] = $da->commission_id;
                                                }
                                                $status = "1";
                                                $make_status = "1";
                                            }
                                            else
                                            {
                                                $make_status = "0";
                                            }
                                    }
                                    else
                                    {
                                        $check_make = $this->lm->check_make_all_already_exits(array_unique($commission_id),$policy_type);
                                        
                                        if(count($check_make) > 0)
                                        {
                                            $commission_id = [];
                                            
                                            foreach($check_make as $da)
                                            {
                                              $commission_id[] = $da->id;
                                            }
                                            
                                            $status = "1";
                                            $make_status = "1";
                                        }
                                    }
    
                                    $check_model_1 = $this->lm->check_model_already_exits(array_unique($commission_id),$policy_type,$make,$model);
                                     
                                    if(count($check_model_1) > 0)
                                    {
                                        $commission_id = [];
                                        
                                        foreach($check_model_1 as $da)
                                        {
                                           $commission_id[] = $da->commission_id;
                                        }
                                        
                                        $status = "1";
                                        $model_status = "1";
                                    }
                                    else
                                    {
                                        $check_model = $this->pm->check_model_all_already_exits(array_unique($commission_id),$policy_type);
                                        if(count($check_model) > 0)
                                        {
                                                $commission_id = [];
                                                foreach($check_model as $da)
                                                {
                                                     $commission_id[] = $da->id;
                                                }
                                             $status = "1";
                                             $model_status = "1";
                                        }
                                    }
                                    
                                    if($make_status == "1" && $model_status == "1")
                                    {
                                        $check_varient_1 = $this->cm->check_varient_already_exits(array_unique($commission_id),$policy_type,$make,$model,$Varient);
                                       
                                        if(count($check_varient_1) > 0) 
                                        {
                                            $commission_id = [];
                                            foreach($check_varient_1 as $da)
                                            {
                                              $commission_id[] = $da->commission_id;
                                            }
                                            $status = "1";
                                            $varient_status = "1";
                                        }
                                        else
                                        {
                                            $check_varient = $this->pm->check_varient_all_already_exits(array_unique($commission_id),$policy_type);
                                            if(count($check_varient) > 0)
                                            {
                                                $commission_id = [];
                                                
                                                foreach($check_varient as $da)
                                                {
                                                     $commission_id[] = $da->id;
                                                }
                                                 $status = "1";
                                    	         $varient_status = "1";
                                            }
                                        }
                                    }
                                    
                                    if($status == "1" && $state_status == "1" && $fuel_type_status == "1" && $gvw_status == "1" && $make_status == "1" && $model_status == "1" && $varient_status == "1")
                                    {
                                         $check_rto = $this->cm->check_rto_already_exits_2(array_unique($commission_id),$rto);
                                         
                                            if(count($check_rto) > 0)
                                            {
                                                foreach($check_rto as $rt)
                                                {
                                                    $com_id = $rt->commission_id;
                                                }
                                                
                                                if(!$this->cm->check_policy_already_exits($lead_id))
                                                {
                                                    if(!$this->cm->check_policy_no_already_exits($policy_no))
                                                    {
                                                         $data1 = array("status" =>"success" ,"commission_id"=>$com_id);
                                                    }
                                                }
                                                else
                                                {
                                                    $data1 = array("status" =>"Policy Already Exits","commission_id"=>"");
                                                }
                                            }
                                     }
                                    else if($fuel_type_status == "0")
                                    {
                                      $data1 = array("status" =>"Fuel Type Mismacthed","commission_id"=>"");
                                    }
                                    else if($gvw_status == "0")
                                    {
                                      $data1 = array("status" =>"Classification Mismatched","commission_id"=>"");
                                    }
                                    else if($make_status == "0")
                                    {
                                      $data1 = array("status" =>"Make Mismactched","commission_id"=>"");
                                    }
                                    else if($model_status == "0")
                                    {
                                      $data1 = array("status" =>"Model Mismactched","commission_id"=>"");
                                    }
                                    else if($varient_status == "0")
                                    {
                                      $data1 = array("status" =>"Varient Mismactched","commission_id"=>"");
                                    }
                                }
                                else
                                {
                                    $data1 = array("status" =>"State Mismacthed","commission_id"=>"");
                                }
                             }
                            else
                            {
                               $data1 = array("status" =>"Insurace Company or Slab Mismacthed","commission_id"=>"");
                            }
                        }
                    }
                   return $data1;
           }
           else if($class_type->class == "2")
           {
                   $bussiness_type = $class_type->business_type;
                   $policy_class = $class_type->class;
                   $policy_type =  $class_type->policy_type;
                   $state = "All";
                   
                    $data1 = array("status" =>"Commission Slab Not Exits","commission_id"=>"");
                   
                   $check = $this->cm->check_health_commission($company,$policy_premium,$policy_class,$bussiness_type,$policy_type,$state,$from_date_1,$to_date_1);
                   
                    foreach($check as $da)
                    {
                        if($da->commission_type == "1")
                        {
                            foreach($check as $da)
                        	{
                                $temp_min = $da->no_policy_min;
                                $temp_max = $da->no_policy_max;
                                
                                if($temp_min <= 1 && $temp_max >= 1)
                                {
                                     $status = "1";
                                     $commission_id[] = $da->id;
                                }
                        	}
                        	
                        	if($status == "1")
                        	{
                        	     if($da->state != "All")
                        	     {
                        	         $res = $this->cm->check_health_state($commission_id);
                        	         $commission_id = [];
                        	         
                            	     foreach($res as $da)
                            	     {
                            	           $commission_id[] = $da->id;
                            	           $c_id = $da->id;
                            	     }
                        	     }
                        	     $data1 = array("status" =>"success","commission_id"=>$c_id);
                        	}
                        	else
                        	{
                        	     $data1 = array("status" =>"Slab Not Exits","commission_id"=>"");
                        	}
                        }
                        else if($da->commission_type == "3")
                        {
                            foreach($check as $da)
                        	{
                                $temp_min = $da->min_val;
                                $temp_max = $da->max_val;
                                
                                if($temp_min <= $total_premium && $temp_max >= $total_premium)
                                {
                                     $status = "1";
                                     $commission_id[] = $da->id;
                                }
                        	}
                        	
                        	if($status == "1")
                        	{
                        	     if($da->state != "All")
                        	     {
                        	         $res = $this->cm->check_health_state($commission_id);
                        	         $commission_id = [];
                        	         
                            	     foreach($res as $da)
                            	     {
                            	           $commission_id[] = $da->id;
                            	           $c_id = $da->id;
                            	     }
                            	     $data1 = array("commission_id"=>$c_id,"status" => "success");
                        	     }
                        	     else
                        	     {
                        	         $data1 = array("commission_id"=>"","status" => "success");
                        	     }
                        	}
                        }
                    }
                     return $data1;
              }
           
             
    	}
    }

	function update_commission_by_policy($lead_id) {
        
        if( isset( $lead_id ) && !empty( $lead_id ) )
        {
            
            //$result = $this->cm->get_active_policy_details_fortc($fromdate = '', $todate = '', $lead_id, $agent_id = '', $insure_id = '');
            $result = $this->cm->getActivePolicyDetailsFortc($fromdate = '', $todate = '', $lead_id, $agent_id = '', $insure_id = '');
            
            if( empty( $result[0] ) ){
                return ;
            }
            
            $policy = $result[0];
            
        //  $check_rto = $this->cm->check_rto_already_exits_2(array_unique($commission_id),$rto);
         
        	if( isset( $policy ) && !empty( $policy ) )
        	{
        		/*foreach($check_rto as $rt)
        		{
        			$com_id = $rt->commission_id;
        		}*/
        		/*$data1 = array("commission_id"=>$policy->commission_id,"com_trigger_status" => "1","com_trigger_date" =>date("Y-m-d"));
        		$update = $this->cm->update_commissions($data1,$re->id);*/
        		
        // 		$commission_id = $com_id;
        
                
                $total_premium = $policy->total_premium;
        		$own_damage = $policy->total_own_damage;
        		$no_claim_bonus = $policy->no_claim_bonus;
        		$tp = $policy->tot_liability_premium;
        		$cpa = $policy->cpa; // 2023-05-26 start
        		$applied_splcom = empty($policy->applied_splcommission) ? "Y" : $policy->applied_splcommission; // 2023-06-08
        		
        		$res123 = $this->lm->fetch_policy_info($policy->commission_id);
        		$agn_commission_type = $res123->agn_com_type ;
        		
        		$ird_od_commission = (isset($res123->ird_od_commission) && ($res123->ird_od_commission) > 0) ? $res123->ird_od_commission : 0;
        		$ird_tp_commission = (isset($res123->ird_tp_commission) && ($res123->ird_tp_commission) > 0) ? $res123->ird_tp_commission : 0;
        		
        		// 2023-06-01 start
                $vehicleAge = $this->lm->getVechicleAge($policy->lead_id, $policy->policy_s_date);
                
        		var_dump("d = ".$res123->ird_od_commission.", dt = ".$res123->ird_tp_commission);
        		var_dump("ird_od_commission = ".$ird_od_commission.", ird_tp_commission = ".$ird_tp_commission);
        		$_agn_comm_type = "";
        		if($res123->on_net != "0")
        		    $_agn_comm_type = "ON-NET";
				else if($res123->own_od != "0" && $res123->own_tp != "0")
				    $_agn_comm_type = "OD_AND_TP";
				else if($res123->own_od != "0")
					$_agn_comm_type = "OD";
				else if($res123->own_tp != "0")
				    $_agn_comm_type = "TP";
				    
        		$jayantha_commission = $jayantha_agent_commission = 0;
        		if( isset( $policy->class ) && !empty( $policy->class ) && $policy->class == "1" ) {
            		if($_agn_comm_type != "TP")
            		{
            			$jayantha_commission = ($own_damage * $ird_od_commission)/100;
            			$jayantha_agent_commission = ($own_damage * $ird_od_commission)/100;
            		}
            		
            		var_dump("OD = ".$jayantha_commission);
            		if($_agn_comm_type != "OD")
            		{
            			$jayantha_commission = $jayantha_commission + (($tp * $ird_tp_commission)/100);   
            		}
            		
            		if($_agn_comm_type == "OD_AND_TP")
            		{
            		    $a = ($own_damage * $ird_od_commission)/100;
            			$b = $jayantha_commission + (($tp * $ird_tp_commission)/100);   
            			$jayantha_commission=$a+$b;
            		}
            		
            		
            		if($_agn_comm_type == "ON-NET" && empty($ird_od_commission) && empty($ird_tp_commission))
                    {
                        $ird_commission = (isset($res123->ird_commission_percentage) && ($res123->ird_commission_percentage) > 0) ? $res123->ird_commission_percentage : $res123->on_net;;
                        $jayantha_commission = ($total_premium * $ird_commission)/100;
                        $jayantha_agent_commission = ($total_premium * $ird_commission)/100;   
                    }
        		}
        
        		var_dump("TP = " . $jayantha_commission);
        		$res = $this->lm->fetch_policy_info($policy->commission_id);
        		$commission_type = $res->commission_type;
        		
        		if( isset( $policy->class ) && !empty( $policy->class ) && $policy->class == "2" ) {
        		    if( isset( $agn_commission_type ) && $agn_commission_type == '' ) {
        		        $res->agn_com_type = $agn_commission_type = "ON-NET";
        		    }
        		    
        		    $ird_commission = (isset($res123->ird_commission_percentage) && ($res123->ird_commission_percentage) > 0) ? $res123->ird_commission_percentage : $res123->on_net;
                    $jayantha_commission = ($total_premium * $ird_commission)/100;
                    $jayantha_agent_commission = ($total_premium * $ird_commission)/100;
        		}
        		
        		//$spl_com = $this->lm->check_spl_commission_for_agent($policy->commission_id,$policy->policy_agency_pos); 
                // 2023-06-08
                $spl_com = [];
                if($applied_splcom == "Y")
        		    $spl_com = $this->lm->check_spl_commission_for_agent($policy->commission_id,$policy->policy_agency_pos); 
        		    
        		if( isset( $res ) && !empty($res) && (in_array($res->commission_type, ['1','2','3'])) )
        		{
                    $comtypes = [
                        'OD'        => $own_damage,
                        'TP'        => $tp,
                        'ON-NET'    => $total_premium,
                        'OD_AND_TP' => $total_premium
                    ];
                    $ncategories = [
                        'A' => $res->a_ncb,
                        'B' => $res->b_ncb,
                        'C' => $res->c_ncb,
                        'D' => $res->d_ncb
                    ];
                    
                    // 2023-05-26 start
                    $cpacategories = [
                        'A' => $res->a_cpa,
                        'B' => $res->b_cpa,
                        'C' => $res->c_cpa,
                        'D' => $res->d_cpa
                    ];
                    
                    $commission_categories = [
                        'OD' => [
                            'A' => $res->a_od,
                            'B' => $res->b_od,
                            'C' => $res->c_od,
                            'D' => $res->d_od,
                        ],
                        'TP' => [
                            'A' => $res->a_tp,
                            'B' => $res->b_tp,
                            'C' => $res->c_tp,
                            'D' => $res->d_tp,
                        ],
                        'ON-NET' => [
                            'A' => $res->a_net,
                            'B' => $res->b_net,
                            'C' => $res->c_net,
                            'D' => $res->d_net,
                        ],
                        /*
                        'OD_AND_TP' => [
                            'A' => [$res->a_od, $res->a_tp],
                            'B' => [$res->b_od, $res->a_tp],
                            'C' => [$res->c_od, $res->a_tp],
                            'D' => [$res->d_od, $res->a_tp],
                        ],*/
                    ];
                    
                    $agent_status = $this->lm->fetch_agent_category($policy->policy_agency_pos);
                    //echo '<pre>';print_r($agent_status);print'</pre>';
        				if($res->is_ncb == "Yes" && $no_claim_bonus == "Yes")
        				{
        					$status = "1";
        					$company_com = $total_premium * ($res->ncb_percentage)/100;
        					
        					   if( isset( $spl_com ) && !empty( $spl_com ) )
        					   {
        					       if( isset( $comtypes[$res->agn_com_type] ) && !empty( $comtypes[$res->agn_com_type] ) )
        					       {
        					           //$agent_commission = ($comtypes[$res->agn_com_type] * $spl_com->special_com)/100;
        					           // 2023-06-01 start
                                        if($res->agn_com_type == "TP") {
                                            if($vehicleAge->age > 3 ) {
                                                $agent_commission = ($comtypes[$res->agn_com_type] * $spl_com->special_com)/100;
                                            }
                                        } else {
                                            $agent_commission = ($comtypes[$res->agn_com_type] * $spl_com->special_com)/100;
                                        }     
        					       }
        					   }
        					   else
        					   {
                                    if( isset( $ncategories[$agent_status->commission_category] ) && !empty( $ncategories[$agent_status->commission_category] ) )
                                    {
                                        $agent_commission = ($total_premium * $ncategories[$agent_status->commission_category])/100;
                                    }
        					   }
        				}
        				else if($res->is_cpa == "Yes" && $cpa == "Yes") { // 2023-05-26 start
        					$status = "1";
        					$company_com = $total_premium * ($res->cpa_percentage)/100;
        					
        					   if( isset( $spl_com ) && !empty( $spl_com ) )
        					   {
        					       if( isset( $comtypes[$res->agn_com_type] ) && !empty( $comtypes[$res->agn_com_type] ) )
        					       {
        					           //$agent_commission = ($comtypes[$res->agn_com_type] * $spl_com->special_com)/100;
        					           // 2023-06-01 start
                                        if($res->agn_com_type == "TP") {
                                            if($vehicleAge->age > 3 ) {
                                                $agent_commission = ($comtypes[$res->agn_com_type] * $spl_com->special_com)/100;
                                            }
                                        } else {
                                            $agent_commission = ($comtypes[$res->agn_com_type] * $spl_com->special_com)/100;
                                        }
        					       }
        					   }
        					   else
        					   {
                                    if( isset( $cpacategories[$agent_status->commission_category] ) && !empty( $cpacategories[$agent_status->commission_category] ) )
                                    {
                                        $agent_commission = ($total_premium * $cpacategories[$agent_status->commission_category])/100;
                                    }
        					   }
        					   
        				}
        				else
        				{
        					if($res->on_net != "0")
        					{
        						$own_od = "";
        						$own_tp = "";
        						$company_com = $total_premium * ($res->on_net)/100;
        						$on_net = $company_com;
        					}
        					else if($res->own_od != "0" && $res->own_tp != "0")
        					{
        						$own_od = $own_damage * ($res->own_od)/100;
        						var_dump("own_od = ". $own_od . ", own_damage = ".$own_damage );
        						$own_tp = $tp * ($res->own_tp)/100;
        						var_dump("own_tp = ". $own_tp . ", own_tp = ".$tp );
        						$company_com = $own_od+$own_tp;
        						$on_net = "";
        					}
        					else if($res->own_od != "0")
        					{
        						$on_net = ""; 
        						$own_tp = "";
        						$company_com = $own_damage * ($res->own_od)/100;
        						$own_od = $company_com;
        					}
        					else if($res->own_tp != "0")
        					{
        						$own_od = ""; 
        						$on_net = "";
        						$company_com = $tp * ($res->own_tp)/100;
        						$own_tp = $company_com;
        					}
        				
        				   if( isset( $spl_com ) && !empty( $spl_com ) )
        				   {
        				       if( isset( $comtypes[$res->agn_com_type] ) && !empty( $comtypes[$res->agn_com_type] ) )
    					       {
    					           //$agent_commission = ($comtypes[$res->agn_com_type] * $spl_com->special_com)/100;
    					           // 2023-06-01 start
                                    if($res->agn_com_type == "TP") {
                                        if($vehicleAge->age > 3 ) {
                                            $agent_commission = ($comtypes[$res->agn_com_type] * $spl_com->special_com)/100;
                                        }
                                    } else {
                                        $agent_commission = ($comtypes[$res->agn_com_type] * $spl_com->special_com)/100;
                                    }
    					       }
        				   }
        				   else
        				   {
    						      if(isset($commission_categories[$res->agn_com_type][$agent_status->commission_category]) && !empty($commission_categories[$res->agn_com_type][$agent_status->commission_category])) {
    						          
    						          $percent = $commission_categories[$res->agn_com_type][$agent_status->commission_category];
    						          
    						          //$agent_commission = ($comtypes[$res->agn_com_type] * $percent)/100;
    						          // 2023-06-01 start
                                        if($res->agn_com_type == "TP") {
                                            if($vehicleAge->age > 3 ) {
                                                $agent_commission = ($comtypes[$res->agn_com_type] * $percent)/100;
                                            }
                                        } else {
                                            $agent_commission = ($comtypes[$res->agn_com_type] * $percent)/100;
                                        }
    						          
    						      }
        						  else if($res->agn_com_type == "OD_AND_TP")
        						  {
        							  if($agent_status->commission_category == "A")
        							  {
        								  $agent_od = ($own_damage * $res->a_od)/100;
        								//$agent_tp = ($tp * $res->a_tp)/100;
        								// 2023-06-01 start
                                          $agent_tp = 0;
                                          if($vehicleAge->age > 3 )
        								    $agent_tp = ($tp * $res->a_tp)/100;
        								    
        								  $agent_commission = $agent_od+$agent_tp;
        							  }
        							  else if($agent_status->commission_category == "B")
        							  {
        								  $agent_od = ($own_damage * $res->b_od)/100;
        								//   $agent_tp = ($tp * $res->b_tp)/100;
        								// 2023-06-01 start
                                          $agent_tp = 0;
                                          if($vehicleAge->age > 3 )
                                            $agent_tp = ($tp * $res->b_tp)/100;
                                            
        								  $agent_commission = $agent_od+$agent_tp;
        							  }
        							  else if($agent_status->commission_category == "C")
        							  {
        								  $agent_od = ($own_damage * $res->c_od)/100;
        								//   $agent_tp = ($tp * $res->c_tp)/100;
        								// 2023-06-01 start
                                          $agent_tp = 0;
                                          if($vehicleAge->age > 3 )
                                            $agent_tp = ($tp * $res->c_tp)/100;
                                            
        								  $agent_commission = $agent_od+$agent_tp;
        							  }
        							  else if($agent_status->commission_category == "D")
        							  {
        								  $agent_od = ($own_damage * $res->d_od)/100;
        								//   $agent_tp = ($tp * $res->d_tp)/100;
        								// 2023-06-01 start
                                          $agent_tp = 0;
                                          if($vehicleAge->age > 3 )
                                            $agent_tp = ($tp * $res->d_tp)/100;
        								  $agent_commission = $agent_od+$agent_tp;
        								  var_dump("agent_commission = " .$agent_commission);
        							  }
        						 }
        				   }
        			 }
        			
        				if( isset( $policy->class ) && !empty( $policy->class ) && in_array($policy->class, ['1', '2'])  ) {
        				    var_dump("company_com = " . $company_com . ", jayantha_commission = ".$jayantha_commission);
                            if((float)$company_com <= (float)$jayantha_commission)
            				{
            					$jayantha_commission = $company_com;
            					$company_com = 0;
            				}
            				else
            				{
            					 $company_com = (float)$company_com - (float)$jayantha_commission;
            				}
            				var_dump("agent_commission = " . $agent_commission . ", jayantha_agent_commission = ".$jayantha_agent_commission);
            				if((float)$agent_commission <= (float)$jayantha_agent_commission)
            				{
            					   $jayantha_agent_commission = $agent_commission;
            					   $agent_commission = 0;
            				}
            				else
            				{
            				    
            					$agent_commission = (float)$agent_commission - (float)$jayantha_agent_commission;
            				}
            				
                        } elseif( isset( $policy->class ) && !empty( $policy->class ) && $policy->class == "-2" ) {
                            $jayantha_commission = $company_com;
        					$jayantha_agent_commission = $agent_commission;
    					    $agent_commission = $company_com = 0;
                        }
        				
        				  // for jayantha and unicorn combine - 19.05.2025
						 $jayantha_agent_commission=$jayantha_agent_commission+$agent_commission;
						 $agent_commission=0;
        				
        				$_policies = $this->lm->get_policy_details($lead_id);
        				
        				$data12 = array("agent_commission"=> $agent_commission,
        								"agent_commission_amt"=> $jayantha_agent_commission,
        								"own_commission_amt"=> $jayantha_commission,
        								"own_commission"=> $company_com,
        								"calc_com_status" =>"1");
        								
        				// New 
        				$data = []; $agn_status = $comp_status = "N";
        				if($policy->vocher_status == '0'){
        				    $data = [
        				        'agent_commission_amt'  => $jayantha_agent_commission, 
        				        'agent_commission'      => $agent_commission
        				    ];
        				    $agn_status = "Y";
        				}
        				if($policy->company_vocher_status == '0') {
        				    $data['own_commission_amt'] = $jayantha_commission;
        				    $data['own_commission']     = $company_com;
        				    $comp_status                = 'Y';
        				}
        				echo '<pre>';print_r($data);print'</pre>';
        				
        				if( isset( $data ) && !empty( $data ) ) {
        				    $data['calc_com_status'] = '1';
        				    $update = $this->cm->update_commissions_by_lead_id($data,$lead_id);
        				    if( $update ) {
                	            $this->audit->log('policy_info', 'UPDATE', null, $_policies, $data);
                	        }
        				}
        				
        				if( $agn_status == "Y") {
        				    // Jantha Agent Commission
        				    
        				    //Credit
        				    $agc_credit = array(
            					'credit'=>$jayantha_agent_commission,
            				);
            				
            				$agc_credit_data = $this->cm->getAccountsByLead($lead_id, 'Agent commission Credit', 'acc_commission_ledger');
        				
            				$agc_credit_res = $this->cm->accouts_update($agc_credit,'jayantha',$lead_id,'Agent commission Credit');
            				
            				if( $agc_credit_res ) {
                	            $this->audit->log('acc_commission_ledger', 'UPDATE', null, $agc_credit_data, $agc_credit);
                	        }
                	        
                	        //Debit
                	        $agc_debit = array(
            					'debit'=>$jayantha_agent_commission,
            				);
            	            $agc_debit_data = $this->cm->getAccountsByLead($lead_id, 'Own commission Debit', 'acc_commission_ledger');
            	        
                	        $agc_credit_res = $this->cm->accouts_update($agc_debit,'jayantha',$lead_id,'Own commission Debit');
                	        
                	        if( $agc_credit_res ) {
                	            $this->audit->log('acc_commission_ledger', 'UPDATE', null, $agc_debit_data, $agc_debit);
                	        }
                	        
                	        // Unicorn Agent Commission
                	        //Credit
                	        $agc_credit = array(
            					'credit'=>$agent_commission,
            				);
            				
            				$oagc_credit_data = $this->cm->getAccountsByLead($lead_id, 'Agent commission Credit', 'acc_commission_ledger_orc');
        				
            				$oagc_credit_res = $this->cm->accouts_update($agc_credit,'unicorn',$lead_id,'Agent commission Credit');
            				
            				if( $agc_credit_res ) {
                	            $this->audit->log('acc_commission_ledger_orc', 'UPDATE', null, $oagc_credit_data, $agc_credit);
                	        }
                	        
                	        //Debit
                	        $agc_debit = array(
            					'debit'=>$agent_commission,
            				);
            				
            				$oagc_debit_data = $this->cm->getAccountsByLead($lead_id, 'Own commission Debit', 'acc_commission_ledger_orc');
            	        
            				$oagc_debit_res = $this->cm->accouts_update($agc_debit,'unicorn',$lead_id,'Own commission Debit');
            				
            				if( $oagc_debit_res ) {
                	            $this->audit->log('acc_commission_ledger_orc', 'UPDATE', null, $oagc_debit_data, $agc_debit);
                	        }
        				}
        				
        				if($comp_status == "Y") {
        				    // Jantha Own Commission
        				    // Credit
        				    $com_credit = array(
            					'credit'=>$jayantha_commission,
            				);
            				
            				$com_credit_data = $this->cm->getAccountsByLead($lead_id, 'Own commission Credit', 'acc_commission_ledger');
            	        
                	        $com_credit_res = $this->cm->accouts_update($com_credit,'jayantha',$lead_id,'Own commission Credit');
                	        
                	        if( $com_credit_res ) {
                	            $this->audit->log('acc_commission_ledger', 'UPDATE', null, $com_credit_data, $com_credit);
                	        }
                	        
                	        
                	        // Unicorn Own Commission
                	        // Credit
                	        $com_credit = array(
            					'credit'=>$company_com,
            				);
                	        $ocom_credit_data = $this->cm->getAccountsByLead($lead_id, 'Own commission Credit', 'acc_commission_ledger_orc');
        				
            				$ocom_credit_res = $this->cm->accouts_update($com_credit,'unicorn',$lead_id,'Own commission Credit');
            				
            				if( $ocom_credit_res ) {
                	            $this->audit->log('acc_commission_ledger_orc', 'UPDATE', null, $ocom_credit_data, $com_credit);
                	        }
                	        
        				}
/*        				
        				$update = $this->cm->update_commissions_by_lead_id($data,$lead_id);
        				if( $update ) {
            	            $this->audit->log('policy_info', 'UPDATE', null, $_policies, $data);
            	        }
        				$agc_credit = array(
        					'credit'=>$jayantha_agent_commission,
        				);
        				$agc_debit = array(
        					'debit'=>$jayantha_agent_commission,
        				);
        				$com_credit = array(
        					'credit'=>$jayantha_commission,
        				);
        				
        				
        				$agc_credit_data = $this->cm->getAccountsByLead($lead_id, 'Agent commission Credit', 'acc_commission_ledger');
        				
        				$agc_credit_res = $this->cm->accouts_update($agc_credit,'jayantha',$lead_id,'Agent commission Credit');
        				
        				if( $agc_credit_res ) {
            	            $this->audit->log('acc_commission_ledger', 'UPDATE', null, $agc_credit_data, $agc_credit);
            	        }
            	        
            	        $agc_debit_data = $this->cm->getAccountsByLead($lead_id, 'Own commission Debit', 'acc_commission_ledger');
            	        
            	        $agc_credit_res = $this->cm->accouts_update($agc_debit,'jayantha',$lead_id,'Own commission Debit');
            	        
            	        if( $agc_credit_res ) {
            	            $this->audit->log('acc_commission_ledger', 'UPDATE', null, $agc_debit_data, $agc_debit);
            	        }
            	        
            	        $com_credit_data = $this->cm->getAccountsByLead($lead_id, 'Own commission Credit', 'acc_commission_ledger');
            	        
            	        $com_credit_res = $this->cm->accouts_update($com_credit,'jayantha',$lead_id,'Own commission Credit');
            	        
            	        if( $com_credit_res ) {
            	            $this->audit->log('acc_commission_ledger', 'UPDATE', null, $com_credit_data, $com_credit);
            	        }
        				
        				$agc_credit = array(
        					'credit'=>$agent_commission,
        				);
        				$agc_debit = array(
        					'debit'=>$agent_commission,
        				);
        				$com_credit = array(
        					'credit'=>$company_com,
        				);
        				        			        				
        				$oagc_credit_data = $this->cm->getAccountsByLead($lead_id, 'Agent commission Credit', 'acc_commission_ledger_orc');
        				
        				$oagc_credit_res = $this->cm->accouts_update($agc_credit,'unicorn',$lead_id,'Agent commission Credit');
        				
        				if( $agc_credit_res ) {
            	            $this->audit->log('acc_commission_ledger_orc', 'UPDATE', null, $oagc_credit_data, $agc_credit);
            	        }
            	        
            	        $oagc_debit_data = $this->cm->getAccountsByLead($lead_id, 'Own commission Debit', 'acc_commission_ledger_orc');
            	        
        				$oagc_debit_res = $this->cm->accouts_update($agc_debit,'unicorn',$lead_id,'Own commission Debit');
        				
        				if( $oagc_debit_res ) {
            	            $this->audit->log('acc_commission_ledger_orc', 'UPDATE', null, $oagc_debit_data, $agc_debit);
            	        }
        				
        				$ocom_credit_data = $this->cm->getAccountsByLead($lead_id, 'Own commission Credit', 'acc_commission_ledger_orc');
        				
        				$ocom_credit_res = $this->cm->accouts_update($com_credit,'unicorn',$lead_id,'Own commission Credit');
        				
        				if( $ocom_credit_res ) {
            	            $this->audit->log('acc_commission_ledger_orc', 'UPDATE', null, $ocom_credit_data, $com_credit);
            	        }
        				
*/        				
        				return;
        		}
        			
        		
        	}
        }
    }
    
    
    function getAgentSplCommission() {
        $output             = [];
        $agent_id           = $this->input->post('agent_id');
        $policy_issue_date  = $this->input->post('policy_issue_date');
        $commission_id      = $this->input->post('commission_id');
        
        if($agent_id && $policy_issue_date) {
            $rows = $this->lm->getSplCommissionByAgent($commission_id, $agent_id, $policy_issue_date);
            if(isset($rows) && !empty($rows)) {
                $output = ['commission_id' => $rows->id, 'commission_percent' => $rows->special_com];
            }
        }

        echo json_encode($output);
    }

}
