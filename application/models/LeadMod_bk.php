<?php  
class LeadMod extends CI_Model  
{  
  	function __construct()  
  	{ 
    	parent::__construct();  
    	$this->load->dbforge();
  	}
  	public function fetch_health_commission_company($policy_premium)
  	{
  	    $this->db->select("list_of_insurance_company.id,list_of_insurance_company.company_name");
  	    $this->db->where("class",2);
  	    $this->db->where("policy_premium_type",$policy_premium);
  	    $this->db->join("list_of_insurance_company","payout_commission.insurer_company = list_of_insurance_company.id");
  	    return $this->db->get("payout_commission")->result();
  	}
  	
  	public function fetch_health_commission_type($policy_premium,$company)
  	{
  	    $this->db->where("class",2);
  	    $this->db->where("policy_premium_type",$policy_premium);
  	    $this->db->where("insurer_company",$company);
  	    return $this->db->get("payout_commission")->row();
  	}
  	
  	public function fetch_state()
  	{
  	    return $this->db->get("list_of_commision_state")->result();
  	}
  	
  	public function fetch_business_type_name($id)
  	{
  	    $this->db->where("id",$id);
  	    $res = $this->db->get("type_of_bussiness")->row();
  	    if($res != "")
  	    {
  	        return $res->bussiness_type;
  	    }
  	    else
  	    {
  	        return "";    
  	    }
  	}
  	public function fetch_class_name($id)
  	{
  	    $this->db->where("id",$id);
  	    $res = $this->db->get("list_of_class")->row();
  	    if($res != "")
  	    {
  	        return $res->class;
  	    }
  	    else
  	    {
  	        return "";    
  	    }
  	} 
  	public function fetch_policy_type_name($id)
  	{
  	     $this->db->where("id",$id);
  	    $res = $this->db->get("list_of_policy_type")->row();
  	    if($res != "")
  	    {
  	        return $res->policy_type;
  	    }
  	    else
  	    {
  	        return "";    
  	    }
  	} 
  	public function fetch_policy_premium_name($id)
  	{
  	      $this->db->where("id",$id);
  	    $res = $this->db->get("list_of_premium_cover_type")->row();
  	    if($res != "")
  	    {
  	        return $res->name;
  	    }
  	    else
  	    {
  	        return "";    
  	    }
  	}
  	public function fetch_agent_category($id)
  	{
  	    $this->db->where("id",$id);
  	    return $this->db->get("list_of_pos_and_agents")->row();
  	}
  	public function fetch_agent_status($tot_amount)
  	{
  	    $this->db->where("from_amt<=",$tot_amount);
  	    $this->db->where("to_amt>=",$tot_amount);
  	    $res = $this->db->get("commission_paid_category")->row();
  	    if($res != "")
  	    {
  	        return $res->category;
  	    }
  	    else
  	    {
  	        return "";    
  	    }
  	}
  	
 	public function make_generate_policy($session_id)
	{
      	$this->db->select("list_of_leads.id as c_lead_id,policy_info.own_commission,policy_info.agent_commission,policy_info.id,policy_info.own_commission_amt,policy_info.agent_commission_amt,policy_info.tot_liability_premium,policy_info.no_claim_bonus,policy_info.commission_id,policy_info.policy_agency_pos,list_of_leads.business_type,policy_info.policy_premium,list_of_leads.class,policy_info.company,policy_info.gst,policy_info.policy_s_date,policy_info.policy_ex_date,list_of_premium_cover_type.name as policy_premium_name,type_of_bussiness.bussiness_type as business_name,list_of_class.class as class_name,list_of_policy_type.policy_type,policy_info.total_own_damage,policy_info.basic_tp,policy_info.total_premium,policy_info.policy_no,list_of_clients.client_name,list_of_clients.mobile_no,list_of_pos_and_agents.agent_pos_code,list_of_insurance_company.company_name,list_of_insurance_company.short_name as ins_short_name");
      	$this->db->join("list_of_leads","policy_info.lead_id = list_of_leads.id");
  	    $this->db->join("list_of_clients","list_of_leads.client_id = list_of_clients.id");
  	    $this->db->join("list_of_pos_and_agents","policy_info.policy_agency_pos = list_of_pos_and_agents.id");
  	    $this->db->join("list_of_insurance_company","policy_info.company = list_of_insurance_company.id");
  	    $this->db->join("type_of_bussiness","list_of_leads.business_type = type_of_bussiness.id");
  	    $this->db->join("list_of_class","list_of_leads.class = list_of_class.id");
  	    $this->db->join("list_of_policy_type","list_of_leads.policy_type = list_of_policy_type.id");
  	    $this->db->join("list_of_premium_cover_type","policy_info.policy_premium = list_of_premium_cover_type.id",'left');
  	    
      	if(isset($_POST['search']['value']) && $_POST['search']['value'] != "")
      	{
    		$this->db->where("(list_of_leads.id LIKE '%".$_POST['search']['value']."%' OR client_name LIKE '%".$_POST['search']['value']."%' OR mobile_no LIKE '%".$_POST['search']['value']."%' OR agent_pos_code LIKE '%".$_POST['search']['value']."%' OR policy_no LIKE '%".$_POST['search']['value']."%' OR list_of_insurance_company.company_name LIKE '%".$_POST['search']['value']."%' OR type_of_bussiness.bussiness_type LIKE '%".$_POST['search']['value']."%' OR list_of_class.class LIKE '%".$_POST['search']['value']."%' OR list_of_policy_type.policy_type LIKE '%".$_POST['search']['value']."%' OR list_of_premium_cover_type.name LIKE '%".$_POST['search']['value']."%')", NULL, FALSE);	    
      	}
      	if($this->session->userdata("session_role") == "user")
      	{
      	    $this->db->where("list_of_leads.assigned_user", $this->session->userdata("session_id"));
      	}
      	else if($this->session->userdata("session_role") == "AI")
      	{
      	    $this->db->where("list_of_leads.area_incharge", $this->session->userdata("session_id"));
      	}
      	$this->db->where("list_of_leads.class","1");
	}
	
	
	public function fetch_generate_policy($session_id)
  	{
  	    $this->make_generate_policy($session_id);
  	    if($_POST['length'] != -1)
      	{
        	$this->db->limit($_POST['length'],$_POST['start']);
      	}
  	    return $this->db->get("policy_info")->result();
  	}
  	
  	public function get_filtered_generate_policy_count($session_id)
	{
      	$this->make_generate_policy($session_id);
      	$res = $this->db->get("policy_info");
      	return $res->num_rows();
	}
	
	public function get_all_generate_policy_count($session_id)
	{
      	$this->db->select("*");
      	$this->db->join("list_of_leads","policy_info.lead_id = list_of_leads.id");
  	    $this->db->join("list_of_clients","list_of_leads.client_id = list_of_clients.id");
  	    $this->db->join("list_of_pos_and_agents","policy_info.policy_agency_pos = list_of_pos_and_agents.id");
  	    $this->db->join("list_of_insurance_company","policy_info.company = list_of_insurance_company.id");
  	    $this->db->join("type_of_bussiness","list_of_leads.business_type = type_of_bussiness.id");
  	    $this->db->join("list_of_class","list_of_leads.class = list_of_class.id");
  	    $this->db->join("list_of_policy_type","list_of_leads.policy_type = list_of_policy_type.id");
  	    $this->db->join("list_of_premium_cover_type","policy_info.policy_premium = list_of_premium_cover_type.id");
  	    
  	   	if($this->session->userdata("session_role") == "user")
      	{
      	    $this->db->where("list_of_leads.assigned_user", $this->session->userdata("session_id"));
      	}
      	else if($this->session->userdata("session_role") == "AI")
      	{
      	    $this->db->where("list_of_leads.area_incharge", $this->session->userdata("session_id"));
      	}
      	$this->db->where("list_of_leads.class","1");
      	return $this->db->get('policy_info')->num_rows();
	}
	
	
	
	
	public function make_generate_policy_health($session_id)
	{
      	$this->db->select("list_of_leads.id as c_lead_id,policy_info.id,policy_info.lead_id,policy_info.own_commission_amt,policy_info.agent_commission_amt,policy_info.tot_liability_premium,policy_info.no_claim_bonus,policy_info.commission_id,policy_info.policy_agency_pos,list_of_leads.business_type,policy_info.policy_premium,list_of_leads.class,policy_info.company,policy_info.gst,policy_info.policy_s_date,policy_info.policy_ex_date,type_of_bussiness.bussiness_type as business_name,list_of_class.class as class_name,list_of_policy_type.policy_type,policy_info.total_own_damage,policy_info.basic_tp,policy_info.total_premium,policy_info.policy_no,list_of_clients.client_name,list_of_clients.mobile_no,list_of_pos_and_agents.agent_pos_code,list_of_insurance_company.company_name,list_of_insurance_company.short_name as ins_short_name");
      	$this->db->join("list_of_leads","policy_info.lead_id = list_of_leads.id");
  	    $this->db->join("list_of_clients","list_of_leads.client_id = list_of_clients.id");
  	    $this->db->join("list_of_pos_and_agents","policy_info.policy_agency_pos = list_of_pos_and_agents.id");
  	    $this->db->join("list_of_insurance_company","policy_info.company = list_of_insurance_company.id");
  	    $this->db->join("type_of_bussiness","list_of_leads.business_type = type_of_bussiness.id");
  	    $this->db->join("list_of_class","list_of_leads.class = list_of_class.id");
  	    $this->db->join("list_of_policy_type","list_of_leads.policy_type = list_of_policy_type.id");
  	    
  	    $this->db->where("list_of_leads.class", "2");
  	    
      	if(isset($_POST['search']['value']) && $_POST['search']['value'] != "")
      	{
    		$this->db->where("(list_of_leads.id LIKE '%".$_POST['search']['value']."%' OR client_name LIKE '%".$_POST['search']['value']."%' OR mobile_no LIKE '%".$_POST['search']['value']."%' OR agent_pos_code LIKE '%".$_POST['search']['value']."%' OR policy_no LIKE '%".$_POST['search']['value']."%' OR list_of_insurance_company.company_name LIKE '%".$_POST['search']['value']."%' OR type_of_bussiness.bussiness_type LIKE '%".$_POST['search']['value']."%' OR list_of_class.class LIKE '%".$_POST['search']['value']."%' OR list_of_policy_type.policy_type LIKE '%".$_POST['search']['value']."%')", NULL, FALSE);	    
      	}
        if($this->session->userdata("session_role") == "user")
      	{
      	    $this->db->where("list_of_leads.assigned_user", $this->session->userdata("session_id"));
      	}
      	else if($this->session->userdata("session_role") == "AI")
      	{
      	    $this->db->where("list_of_leads.area_incharge", $this->session->userdata("session_id"));
      	}
	}
  	public function fetch_generate_policy_health($session_id)
  	{
  	    $this->make_generate_policy_health($session_id);
  	    if($_POST['length'] != -1)
      	{
        	$this->db->limit($_POST['length'],$_POST['start']);
      	}
  	    return $this->db->get("policy_info")->result();
  	}
  	
  	public function filter_gen_policy_count_health($session_id)
	{
      	$this->make_generate_policy_health($session_id);
      	
      	$res = $this->db->get("policy_info");
      	return $res->num_rows();
	}
	public function get_all_generate_policy_count_health($session_id)
	{
      	$this->db->select("*");
      	$this->db->join("list_of_leads","policy_info.lead_id = list_of_leads.id");
  	    $this->db->join("list_of_clients","list_of_leads.client_id = list_of_clients.id");
  	    $this->db->join("list_of_pos_and_agents","policy_info.policy_agency_pos = list_of_pos_and_agents.id");
  	    $this->db->join("list_of_insurance_company","policy_info.company = list_of_insurance_company.id");
  	    $this->db->join("type_of_bussiness","list_of_leads.business_type = type_of_bussiness.id");
  	    $this->db->join("list_of_class","list_of_leads.class = list_of_class.id");
  	    $this->db->join("list_of_policy_type","list_of_leads.policy_type = list_of_policy_type.id");
  	    if($this->session->userdata("session_role") == "user")
      	{
      	    $this->db->where("list_of_leads.assigned_user", $this->session->userdata("session_id"));
      	}
      	else if($this->session->userdata("session_role") == "AI")
      	{
      	    $this->db->where("list_of_leads.area_incharge", $this->session->userdata("session_id"));
      	}
      	//$this->db->where("status", $status);
      	$this->db->where("list_of_leads.class", "2");
      	return $this->db->get('policy_info')->num_rows();
	}
	
	
	
	
  	public function fetch_commission_type($id)
  	{
  	     $this->db->where("id",$id);
  	    return $this->db->get("commission_type")->row();
  	}
  	public function fetch_rto()
  	{
  	    return $this->db->get("list_of_rto")->result();
  	}
  	public function fetch_premium_cover_type()
  	{
  	    return $this->db->get("list_of_premium_cover_type")->result();
  	}
  	public function fetch_company()
  	{
  	    return $this->db->get("list_of_insurance_company")->result();
  	}
  	public function commission_type_load($state,$company,$policy_class,$bussiness_type,$policy_premium,$rto)
  	{
  	    $rto_arr = [];
  	    $rto_arr[] = "all";
  	    $rto_arr[] = $rto;
  	    
  	     $sub_str = substr($rto,0,2);
  	    
  	    if($sub_str == "TN")
  	    {
  	        $rto_arr[] = "All TN";
  	    }
  	    
  	    $this->db->select("payout_commission.commission_type");
  	    $this->db->where("state",$state);
  	    $this->db->where("insurer_company",$company);
  	    $this->db->where("class",$policy_class);
  	    $this->db->where("business_type",$bussiness_type);
  	    $this->db->where("policy_premium_type",$policy_premium);
  	    $this->db->where_in('commission_rto_log.rto', $rto_arr);
  	    $this->db->join("commission_rto_log","payout_commission.id = commission_rto_log.commission_id");
  	    return $this->db->get("payout_commission")->result();
  	}
  	public function commission_category_load($state,$company,$policy_class,$bussiness_type,$policy_premium,$rto)
  	{
  	    $rto_arr = [];
  	    $rto_arr[] = "all";
  	    $rto_arr[] = $rto;
  	    
  	     $sub_str = substr($rto,0,2);
  	    
  	    if($sub_str == "TN")
  	    {
  	        $rto_arr[] = "All TN";
  	    }
  	    
  	    $this->db->select("payout_commission.commission_type,payout_commission.irdi_commission,payout_commission.category,payout_commission.vehicle_age_min,payout_commission.vehicle_age_max");
  	    $this->db->where("state",$state);
  	    $this->db->where("insurer_company",$company);
  	    $this->db->where("class",$policy_class);
  	    $this->db->where("business_type",$bussiness_type);
  	    $this->db->where("policy_premium_type",$policy_premium);
  	    $this->db->where_in('commission_rto_log.rto', $rto_arr);
  	    $this->db->join("commission_rto_log","payout_commission.id = commission_rto_log.commission_id");
  	    return $this->db->get("payout_commission")->result();
  	}
  	public function fetch_commission_category($id)
  	{
  	     $this->db->where("id",$id);
  	    return $this->db->get("commission_motor_category")->row();
  	}
  	public function vehicle_classification_load($state,$company,$policy_class,$bussiness_type,$policy_premium,$rto,$category)
  	{
  	    $rto_arr = [];
  	    $rto_arr[] = "all";
  	    $rto_arr[] = $rto;
  	    
  	     $sub_str = substr($rto,0,2);
  	    
  	    if($sub_str == "TN")
  	    {
  	        $rto_arr[] = "All TN";
  	    }
  	    
  	    $this->db->select("payout_commission.commission_type,payout_commission.irdi_commission,payout_commission.product,payout_commission.vehicle_age_min,payout_commission.vehicle_age_max");
  	    $this->db->where("state",$state);
  	    $this->db->where("insurer_company",$company);
  	    $this->db->where("class",$policy_class);
  	    $this->db->where("business_type",$bussiness_type);
  	    $this->db->where("category",$category);
  	    $this->db->where("policy_premium_type",$policy_premium);
  	    $this->db->where_in('commission_rto_log.rto', $rto_arr);
  	    $this->db->join("commission_rto_log","payout_commission.id = commission_rto_log.commission_id");
  	    return $this->db->get("payout_commission")->result();
  	}
  	public function fetch_commission_type_id($state,$company,$policy_class,$bussiness_type,$policy_premium,$rto,$category,$vehicle_classification)
  	{
  	    $rto_arr = [];
  	    $rto_arr[] = "all";
  	    $rto_arr[] = $rto;
  	    
  	    $sub_str = substr($rto,0,2);
  	    
  	    if($sub_str == "TN")
  	    {
  	        $rto_arr[] = "All TN";
  	    }
  	    $this->db->select("payout_commission.id,payout_commission.on_net,payout_commission.irdi_commission,payout_commission.own_od,payout_commission.own_tp,payout_commission.bronze_category,payout_commission.silver_category,payout_commission.gold_category");
  	    $this->db->where("state",$state);
  	    $this->db->where("insurer_company",$company);
  	    $this->db->where("class",$policy_class);
  	    $this->db->where("business_type",$bussiness_type);
  	    $this->db->where("category",$category);
  	    $this->db->where("policy_premium_type",$policy_premium);
  	    $this->db->where("product",$vehicle_classification);
  	    $this->db->where_in('commission_rto_log.rto', $rto_arr);
  	    $this->db->join("commission_rto_log","payout_commission.id = commission_rto_log.commission_id");
  	    return $this->db->get("payout_commission")->row();
  	}
  	
  	public function fetch_policy_info($id)
  	{
  	    $this->db->where("id",$id);
  	    return $this->db->get("company_payout_commission")->row();
  	}
  	
  	public function fetch_commission_product($id)
  	{
  	    $this->db->where("id",$id);
  	    return $this->db->get("commission_motor_gvw")->row();
  	}
  	public function fetch_users()
  	{
  	    $this->db->where("role !=","admin");
  	    $this->db->where("role !=","ai");
  	    $this->db->order_by('name', 'ASC');
  	    return $this->db->get("admin_login")->result();
  	}
  	
  	public function fetch_ai()
  	{
  	    $this->db->where("role !=","admin");
  	    $this->db->where("role !=","user");
  	    return $this->db->get("admin_login")->result();
  	}
  	
  	public function fetch_users_by_user($id)
  	{
  	    $this->db->where("id",$id);
  	    $this->db->where("role !=","admin");
  	    return $this->db->get("admin_login")->result();
  	}
  	public function fetch_agents_pos()
  	{
  	    return $this->db->get("list_of_pos_and_agents")->result();
  	}
  	
  	public function fetch_agents_pos_by_userid($id)
  	{
  	    $this->db->where("user_id",$id);
  	    return $this->db->get("list_of_pos_and_agents")->result();
  	}
  	
  	public function fetch_agents_pos_by_area_incharge($id)
  	{
  	    $this->db->where("area_incharge",$id);
  	    return $this->db->get("list_of_pos_and_agents")->result();
  	}
  	
  	public function fetch_client_type()
  	{
  	    return $this->db->get("type_of_clients")->result();
  	}
  	public function fetch_business_type()
  	{
  	    return $this->db->get("type_of_bussiness")->result();
  	}
  	
  	public function fetch_list_of_class()
  	{
  	    return $this->db->get("list_of_class")->result();
  	}
  	
  	public function fetch_list_of_policy_type_motor()
  	{
  	    $this->db->where("policy_class","1");
  	    return $this->db->get("list_of_policy_type")->result();
  	}
  	
  	public function add_client_details($data)
  	{
  	    $this->db->insert("list_of_clients",$data);
  	    $insert_id = $this->db->insert_id();
        return  $insert_id;
  	}
  	
  	
  	public function add_vechicle_detail($vechi_info)
  	{
  	    $this->db->insert("vechile_details",$vechi_info);
  	}
  	
  	
  	public function add_lead_details($data)
  	{
  	    $this->db->insert("list_of_leads",$data);
  	    $insert_id = $this->db->insert_id();
        return  $insert_id;
  	}
  	
  	public function get_lead_details($id)
  	{
  	    $this->db->select("list_of_leads.*,list_of_clients.client_type_id,list_of_clients.client_name,list_of_clients.mobile_no,list_of_clients.other_contact_details,list_of_clients.landline_no,list_of_clients.address,list_of_clients.email,list_of_clients.contact_person_name,list_of_clients.contact_person_designation,list_of_clients.date_of_birth,list_of_clients.age,list_of_clients.area,vechile_details.vechi_register_no,list_of_clients.pin_code");
  	    $this->db->from("list_of_leads");
  	    $this->db->join("list_of_clients","list_of_leads.client_id = list_of_clients.id");
  	     $this->db->join("vechile_details","vechile_details.lead_id = list_of_leads.id",'left');
  	    $this->db->where("list_of_leads.id",$id);
  	    return $this->db->get()->row();
  	}
  	public function add_follow_up_details($data)
  	{
  	   if($this->db->insert("follow_up_details",$data)){
  	       return true;
  	   }
  	   
  	   return false;
  	}
  	
  	public function check_follow_up_already_exits($id)
  	{
  	    $this->db->select("*");
  	    $this->db->from("follow_up_details");
  	    $this->db->where("lead_id",$id);
  	    $this->db->limit("1");
  	    $this->db->order_by("id","DESC");
        return $this->db->get()->result();
  	}
  	public function update_follow_up_details($data_lead,$id)
  	{
  	    $this->db->where("id",$id);
  	    if($this->db->update("list_of_leads",$data_lead)){
  	        return true;
  	    }
  	    
  	    return false;
  	}
  	
  	public function fetch_policy_type_using_class($class)
  	{
  	    $this->db->where("status !=",'1');
  	    $this->db->where("policy_class",$class);
  	    
  	    return $this->db->get("list_of_policy_type")->result();
  	}
  	
  	public function fetch_make_car()
  	{
  	    return $this->db->get("list_of_car_brand")->result();
  	}
  	
  	public function fetch_make_bike()
  	{
  	    return $this->db->get("list_of_bike_brand")->result();
  	}
  	
  	public function fetch_e_two_wheeler()
  	{
  	    return $this->db->get("list_of_e_two_wheeler_brand")->result();
  	}
  	
  	public function fetch_pc_make($vechile_type)
  	{
  	    $this->db->where("policy_type",$vechile_type);
  	    return $this->db->get("list_of_pc_vehicle_brand")->result();
  	}
  	
  	public function fetch_gc_make($vechile_type)
  	{
  	    $this->db->where("policy_type",$vechile_type);
  	    $this->db->where("status","0");
  	    return $this->db->get("list_of_gc_vehicle_brand")->result();
  	}
  	public function fetch_misc_make()
  	{
  	    return $this->db->get("list_of_misc_vehicle_brand")->result();
  	}
  	
  	public function fetch_scooter_make()
  	{
  	    return $this->db->get("list_of_scooter_brand")->result();
  	}
  	
  	public function fetch_ambulance_make()
  	{
  	    return $this->db->get("list_of_ambulance_brand")->result();
  	}
  	
  	
  	
  	public function fetch_car_model($vechi_make)
  	{
  	   $this->db->where("brand_id",$vechi_make);
  	    return $this->db->get("list_of_car_model")->result();
  	}
  	
  	public function fetch_bike_model($vechi_make)
  	{
  	    $this->db->where("brand_id",$vechi_make);
  	    $this->db->where("status",'0');
  	    return $this->db->get("list_of_bike_model")->result();
  	}
  	
  	public function fetch_e_two_wheeler_model($vechi_make)
  	{
  	    $this->db->where("brand_id",$vechi_make);
  	    return $this->db->get("list_of_e_two_wheeler_model")->result();
  	}
  	
  	public function fetch_pc_model($vechile_type,$vechi_make)
  	{
  	    $this->db->where("policy_type",$vechile_type);
  	    $this->db->where("brand_id",$vechi_make);
  	    return $this->db->get("list_of_pc_vehicle_model")->result();
  	}
  	public function fetch_gc_model($vechile_type,$vechi_make)
  	{
  	    $this->db->where("policy_type",$vechile_type);
  	    $this->db->where("brand_id",$vechi_make);
  	    $this->db->where("status","0");
  	    return $this->db->get("list_of_gc_vehicle_model")->result();
  	}
  	public function fetch_misc_model($vechi_make)
  	{
  	    $this->db->where("brand_id",$vechi_make);
  	    return $this->db->get("list_of_misc_vehicle_model")->result();
  	}
  	public function fetch_scooter_model($vechi_make)
  	{
  	    $this->db->where("brand_id",$vechi_make);
  	    $this->db->where("status","0");
  	    return $this->db->get("list_of_scooter_model")->result();
  	}
  	
  	public function fetch_ambulance_model($vechi_make)
  	{
  	    $this->db->where("brand_id",$vechi_make);
  	    $this->db->where("status","0");
  	    return $this->db->get("list_of_ambulance_model")->result();
  	}
  	
  	
  	
  	
  	public function fetch_car_varient($vechi_make,$vechi_model)
  	{
  	    $this->db->where("brand_id",$vechi_make);
  	    $this->db->where("model_id",$vechi_model);
  	    
  	    return $this->db->get("list_of_car_varient")->result();
  	}
  	
  	public function fetch_bike_varient($vechi_make,$vechi_model)
  	{
  	    $this->db->where("brand_id",$vechi_make);
  	    $this->db->where("model_id",$vechi_model);
  	    $this->db->where("status","0");
  	    return $this->db->get("list_of_bike_varient")->result();
  	}
  	
  	public function fetch_e_two_wheeler_varient($vechi_make,$vechi_model)
  	{
  	     $this->db->where("brand_id",$vechi_make);
  	    $this->db->where("model_id",$vechi_model);
  	    return $this->db->get("list_of_e_two_wheeler_varient")->result();
  	}
  	
  	public function fetch_pc_varient($vechile_type,$vechi_make,$vechi_model)
  	{
  	    $this->db->where("policy_type",$vechile_type);
  	     $this->db->where("brand_id",$vechi_make);
  	    $this->db->where("model_id",$vechi_model);
  	    return $this->db->get("list_of_pc_vehicle_varient")->result();
  	}
  	
  	public function fetch_gc_varient($vechile_type,$vechi_make,$vechi_model)
  	{
  	    $this->db->where("policy_type",$vechile_type);
  	    $this->db->where("brand_id",$vechi_make);
  	     $this->db->where("brand_id",$vechi_make);
  	    $this->db->where("model_id",$vechi_model);
  	    $this->db->where("status","0");
  	    return $this->db->get("list_of_gc_vehicle_varient")->result();
  	}
  	
  	public function fetch_misc_varient($vechi_make,$vechi_model)
  	{
  	     $this->db->where("brand_id",$vechi_make);
  	    $this->db->where("model_id",$vechi_model);
  	    return $this->db->get("list_of_misc_vehicle_varient")->result();
  	}
  	
  	public function fetch_scooter_varient($vechi_make,$vechi_model)
  	{
  	     $this->db->where("brand_id",$vechi_make);
  	    $this->db->where("model_id",$vechi_model);
  	    $this->db->where("status","0");
  	    return $this->db->get("list_of_scooter_varient")->result();
  	}
  	
  	public function fetch_ambulance_varient($vechi_make,$vechi_model)
  	{
  	    $this->db->where("brand_id",$vechi_make);
  	    $this->db->where("model_id",$vechi_model);
  	    return $this->db->get("list_of_ambulance_varient")->result();
  	}
  	
  	// add vechile details //
  	
  	public function add_vechicle_details($data)
  	{
  	    if($this->db->insert("vechile_details",$data)){
  	        return true;
  	    }
  	    
  	    return false;
  	}
  	
  	
  public function check_this_lead_id_already_exits($id)
  {
       $this->db->where("lead_id",$id);
       return $this->db->get("vechile_details")->num_rows();
  }
  
  	public function get_car_details($id)
  	{
  	     $this->db->select("vechile_details.*,list_of_car_brand.brand_name,list_of_car_model.model_name,list_of_car_varient.varient_name");
  	     $this->db->from("vechile_details");
  	     $this->db->join("list_of_car_brand","vechile_details.vechi_make = list_of_car_brand.id");
  	     $this->db->join("list_of_car_model","vechile_details.vechi_model = list_of_car_model.id");
  	     $this->db->join("list_of_car_varient","vechile_details.vechi_varient = list_of_car_varient.id",'left');
  	     $this->db->where("lead_id",$id);
  	     return $this->db->get()->row();
  	}
  	
  	public function get_bike_details($id)
  	{
  	     $this->db->select("vechile_details.*,list_of_bike_brand.brand_name,list_of_bike_model.model_name,list_of_bike_varient.varient_name");
  	    $this->db->from("vechile_details");
  	    $this->db->join("list_of_bike_brand","vechile_details.vechi_make = list_of_bike_brand.id");
  	    $this->db->join("list_of_bike_model","vechile_details.vechi_model = list_of_bike_model.id");
  	    $this->db->join("list_of_bike_varient","vechile_details.vechi_varient = list_of_bike_varient.id",'left');
  	     $this->db->where("lead_id",$id);
  	     return $this->db->get()->row();
  	}
  	
  	public function get_pc_details($id,$vechile_type)
  	{
  	     $this->db->select("vechile_details.*,list_of_pc_vehicle_brand.brand_name,list_of_pc_vehicle_model.model_name,list_of_pc_vehicle_varient.varient_name");
  	    $this->db->from("vechile_details");
  	    $this->db->join("list_of_pc_vehicle_brand","vechile_details.vechi_make = list_of_pc_vehicle_brand.id");
  	    $this->db->join("list_of_pc_vehicle_model","vechile_details.vechi_model = list_of_pc_vehicle_model.id");
  	    $this->db->join("list_of_pc_vehicle_varient","vechile_details.vechi_varient = list_of_pc_vehicle_varient.id",'left');
  	     $this->db->where("list_of_pc_vehicle_model.policy_type",$vechile_type);
  	     $this->db->where("lead_id",$id);
  	     return $this->db->get()->row();
  	}
  	
  	public function get_gc_details($id,$vechile_type)
  	{
  	    $this->db->select("vechile_details.*,list_of_gc_vehicle_brand.brand_name,list_of_gc_vehicle_model.model_name,list_of_gc_vehicle_varient.varient_name");
  	    $this->db->from("vechile_details");
  	    $this->db->join("list_of_gc_vehicle_brand","vechile_details.vechi_make = list_of_gc_vehicle_brand.id");
  	    $this->db->join("list_of_gc_vehicle_model","vechile_details.vechi_model = list_of_gc_vehicle_model.id");
  	    $this->db->join("list_of_gc_vehicle_varient","vechile_details.vechi_varient = list_of_gc_vehicle_varient.id",'left');
  	    $this->db->where("list_of_gc_vehicle_model.policy_type",$vechile_type);
  	    $this->db->where("lead_id",$id);
  	     return $this->db->get()->row();
  	}
  	
  	public function fetch_make_misc($id)
  	{
  	     $this->db->select("vechile_details.*,list_of_misc_vehicle_brand.brand_name,list_of_misc_vehicle_model.model_name,list_of_misc_vehicle_varient.varient_name");
  	    $this->db->from("vechile_details");
  	    $this->db->join("list_of_misc_vehicle_brand","vechile_details.vechi_make = list_of_misc_vehicle_brand.id");
  	    $this->db->join("list_of_misc_vehicle_model","vechile_details.vechi_model = list_of_misc_vehicle_model.id");
  	    $this->db->join("list_of_misc_vehicle_varient","vechile_details.vechi_varient = list_of_misc_vehicle_varient.id");
  	     $this->db->where("lead_id",$id);
  	     return $this->db->get()->row();
  	}
  	
  	public function fetch_make_scooter($id)
  	{
  	    $this->db->select("vechile_details.*,list_of_scooter_brand.brand_name,list_of_scooter_model.model_name,list_of_scooter_varient.varient_name");
  	    $this->db->from("vechile_details");
  	    $this->db->join("list_of_scooter_brand","vechile_details.vechi_make = list_of_scooter_brand.id");
  	    $this->db->join("list_of_scooter_model","vechile_details.vechi_model = list_of_scooter_model.id");
  	    $this->db->join("list_of_scooter_varient","vechile_details.vechi_varient = list_of_scooter_varient.id");
  	    $this->db->where("lead_id",$id);
  	    
  	     return $this->db->get()->row();
  	}
  	
  	public function fetch_make_ambulance($id)
  	{
  	    $this->db->select("vechile_details.*,list_of_ambulance_brand.brand_name,list_of_ambulance_model.model_name,list_of_ambulance_varient.varient_name");
  	    $this->db->from("vechile_details");
  	    $this->db->join("list_of_ambulance_brand","vechile_details.vechi_make = list_of_ambulance_brand.id");
  	    $this->db->join("list_of_ambulance_model","vechile_details.vechi_model = list_of_ambulance_model.id");
  	    $this->db->join("list_of_ambulance_varient","vechile_details.vechi_varient = list_of_ambulance_varient.id");
  	    $this->db->where("lead_id",$id);
  	     return $this->db->get()->row();
  	}
  	
  	
  	public function get_vechile_type($id)
  	{
  	    $this->db->where("lead_id",$id);
  	    return $this->db->get("vechile_details")->row();
  	}
  	
  	public function upload_document_files($data)
  	{
  	    $this->db->insert("vechicle_documents",$data);
  	    $insert_id = $this->db->insert_id();
  	    
        $this->db->where("id",$insert_id);
        return $this->db->get("vechicle_documents")->row();
  	}
  	
  	public function move_lead_to_prospect($id,$data)
  	{
  	    $this->db->where("id",$id);
  	    if($this->db->update("list_of_leads",$data)){
  	        return true;
  	    }
  	    
  	    return false;
  	}
  	
  	public function move_to_lead($id,$data)
  	{
  	    $this->db->where("id",$id);
  	    if($this->db->update("list_of_leads",$data)){
  	        return true;
  	    }
  	    
  	    return false;
  	}
  	
  	
  	
  	public function fetch_all_leads($lead_type,$classification,$category,$bulk_status,$order_category,$search,$search_vechicle)
  	{
  	    $this->fetch_all_leads_query($lead_type,$classification,$category,$bulk_status,$order_category,$search);
  	    
  //	    if($_POST['length'] != -1)
  //    	{
   //     	$this->db->limit($_POST['length'],$_POST['start']);
    //  	}
      	$this->db->join("list_of_clients","list_of_leads.client_id = list_of_clients.id");
  	    $this->db->join("type_of_bussiness","list_of_leads.business_type = type_of_bussiness.id");
  	    $this->db->join("list_of_class","list_of_leads.class = list_of_class.id");
  	    $this->db->join("list_of_policy_type","list_of_leads.policy_type = list_of_policy_type.id");
  	    $this->db->join("admin_login","list_of_leads.assigned_user = admin_login.id",'left');
  	    //$this->db->where("list_of_leads.due_date >=",date("Y-m-d"));
  	    
  	      if( isset( $search_vechicle ) && !empty( $search_vechicle ) ) {
  	        $this->db->where("list_of_leads.id in (select lead_id from vechile_details where lower(vechi_register_no) like '%".strtolower($search_vechicle)."%')", NULL, false);
  	    }
  	    
  	 /*   if($this->session->userdata('session_role') == "user")
  	    {
  	        $this->db->where("list_of_leads.assigned_user",$this->session->userdata('session_id'));
  	    }
  	    */
  	   if($this->session->userdata('session_role') == "user")
  	    {
  	        $this->db->where("list_of_leads.lead_created_id",$this->session->userdata('session_id'));
  	    }
  	   
  	    if($this->session->userdata('session_role') == "AI")
  	    {
  	        $this->db->where("list_of_leads.area_incharge",$this->session->userdata('session_id'));
  	    }
  	    if($order_category == "upcoming")
  	    {
  	        $this->db->order_by("list_of_leads.due_date","asc");
  	    }
  	    else
  	    {
  	        $this->db->order_by("list_of_leads.id","desc");
  	    }
  	    
  	    return $this->db->get("list_of_leads")->result();
  	}
  	
  	public function fetch_all_leads_query($lead_type,$classification,$category,$bulk_status,$order_category,$search)
  	{
      	    $this->db->select("list_of_leads.*,list_of_clients.client_name,list_of_clients.mobile_no,list_of_clients.other_contact_details,list_of_clients.landline_no,list_of_clients.address,list_of_clients.contact_person_name,list_of_clients.date_of_birth,list_of_clients.age,list_of_clients.area,type_of_bussiness.bussiness_type as b_type,list_of_class.class as lclass,list_of_policy_type.policy_type as p_type");
      	 
            if(isset($_POST['search']['value']) && $_POST['search']['value'] != "")
            {
               $this->db->where("(list_of_clients.client_name LIKE '%".$_POST['search']['value']."%' OR list_of_clients.mobile_no LIKE '%".$_POST['search']['value']."%' OR list_of_clients.other_contact_details LIKE '%".$_POST['search']['value']."%' OR list_of_clients.landline_no LIKE '%".$_POST['search']['value']."%'  OR list_of_clients.date_of_birth LIKE '%".$_POST['search']['value']."%' OR list_of_clients.age LIKE '%".$_POST['search']['value']."%' OR list_of_clients.area LIKE '%".$_POST['search']['value']."%'  OR list_of_leads.location LIKE '%".$_POST['search']['value']."%' OR list_of_leads.lead_generated_date LIKE '%".$_POST['search']['value']."%' OR list_of_clients.address LIKE '%".$_POST['search']['value']."%' OR list_of_clients.email LIKE '%".$_POST['search']['value']."%' OR type_of_bussiness.bussiness_type LIKE '%".$_POST['search']['value']."%' OR list_of_clients.contact_person_name LIKE '%".$_POST['search']['value']."%' OR list_of_policy_type.policy_type LIKE '%".$_POST['search']['value']."%'  OR list_of_class.class LIKE '%".$_POST['search']['value']."%' OR list_of_clients.contact_person_designation LIKE '%".$_POST['search']['value']."%')", NULL, FALSE);	    
            }
            
            if($search == "")
            {
                
                $this->db->where("list_of_leads.bulk_upload", $bulk_status);
                $this->db->where("list_of_leads.lead_type", $lead_type);
                $this->db->where("list_of_leads.classfication", $classification);
                
                if($category != "all")
                {
                  $this->db->where("list_of_leads.class",$category);
                }
                if($order_category == "overdue")
                {
                  $where = "(list_of_leads.due_date < '" . date('Y-m-d') . "' AND list_of_leads.due_date != 0000-00-00)";


                  $this->db->where($where);
                }
                else if($order_category == "no_due_date")
                {
                  $this->db->where("list_of_leads.due_date",0000-00-00);
                }
                else
                {
                    if($category != "all")
                    {
                      $this->db->where("list_of_leads.class",$category);
                    }
                      $date = date("Y-m-d", strtotime(date("Y-m-d", strtotime(date("Y-m-d"))) . " + 30 days"));
                      $this->db->where("list_of_leads.due_date >=", date("Y-m-d"));
                      $this->db->where("list_of_leads.due_date <=", $date);
                      
                       $this->db->where("list_of_leads.due_date !=", 0000-00-00);
                }
              }
            else
            {
                 $this->db->where("(list_of_clients.client_name LIKE '%".$search."%' OR list_of_clients.mobile_no LIKE '%".$search."%' OR list_of_clients.other_contact_details LIKE '%".$search."%' OR list_of_clients.landline_no LIKE '%".$search."%'  OR list_of_clients.date_of_birth LIKE '%".$search."%' OR list_of_clients.age LIKE '%".$search."%' OR list_of_clients.area LIKE '%".$search."%'  OR list_of_leads.location LIKE '%".$search."%' OR list_of_leads.lead_generated_date LIKE '%".$search."%' OR list_of_clients.address LIKE '%".$search."%' OR list_of_clients.email LIKE '%".$search."%' OR type_of_bussiness.bussiness_type LIKE '%".$search."%' OR list_of_clients.contact_person_name LIKE '%".$search."%' OR list_of_policy_type.policy_type LIKE '%".$search."%'  OR list_of_class.class LIKE '%".$search."%' OR list_of_clients.contact_person_designation LIKE '%".$search."%')", NULL, FALSE);	          	
                 $this->db->where("list_of_leads.lead_status !=","completed");
            }
            
            $this->db->where("list_of_leads.policy_status !=","1");
            $this->db->where("list_of_leads.lead_type !=","2");
  	}
  	
  	
  	public function get_filtered_datas_count($lead_type,$classification,$category,$bulk_status,$order_category,$search)
	{
      	$this->fetch_all_leads_query($lead_type,$classification,$category,$bulk_status,$order_category,$search);
      	
      	$this->db->join("list_of_clients","list_of_leads.client_id = list_of_clients.id");
  	    $this->db->join("type_of_bussiness","list_of_leads.business_type = type_of_bussiness.id");
  	    $this->db->join("list_of_class","list_of_leads.class = list_of_class.id");
  	    $this->db->join("list_of_policy_type","list_of_leads.policy_type = list_of_policy_type.id");
  	  
  	    if($this->session->userdata('session_role') == "user")
  	    {
  	        $this->db->where("list_of_leads.assigned_user",$this->session->userdata('session_id'));
  	    }
  	    
  	    if($this->session->userdata('session_role') == "AI")
  	    {
  	        $this->db->where("list_of_leads.area_incharge",$this->session->userdata('session_id'));
  	    }
  	    
        if($order_category == "upcoming")
        {
          $this->db->order_by("list_of_leads.due_date","asc");
        }
        else
        {
          $this->db->order_by("list_of_leads.id","desc");
        }
        
      	$res = $this->db->get("list_of_leads");
      	return $res->num_rows();
	}
	
	public function get_all_datas_count($lead_type,$classification,$category,$bulk_status,$order_category,$search)
	{
       $this->db->select("list_of_leads.id");
       $this->db->join("list_of_clients","list_of_leads.client_id = list_of_clients.id");
  	   $this->db->join("type_of_bussiness","list_of_leads.business_type = type_of_bussiness.id");
        $this->db->where("list_of_leads.lead_type",$lead_type);
        $this->db->where("list_of_leads.classfication", $classification);
        $this->db->where("list_of_leads.bulk_upload", $bulk_status);
        
        if($order_category == "overdue")
        {
          $where = '(list_of_leads.due_date <"'.date("Y-m-d").'" and list_of_leads.due_date != 0000-00-00)';
          $this->db->where($where);
        }
        else if($order_category == "no_due_date")
        {
          $this->db->where("list_of_leads.due_date",0000-00-00);
        }
        else
        {
             $date = date("Y-m-d", strtotime(date("Y-m-d", strtotime(date("Y-m-d"))) . " + 30 days"));
              $this->db->where("list_of_leads.due_date >=", date("Y-m-d"));
              $this->db->where("list_of_leads.due_date <=", $date);
              $this->db->where("list_of_leads.due_date !=", 0000-00-00);
        }
        
        if($category != "all")
        {
          $this->db->where("list_of_leads.class",$category);
        }
        
        if($order_category == "upcoming")
        {
          $this->db->order_by("list_of_leads.due_date","asc");
        }
        else
        {
          $this->db->order_by("list_of_leads.id","desc");
        }
        $this->db->where("list_of_leads.policy_status !=","1");
        $this->db->where("list_of_leads.lead_status !=","completed");
        
        if($this->session->userdata('session_role') == "user")
        {
          $this->db->where("list_of_leads.assigned_user",$this->session->userdata('session_id'));
        }
        
        if($this->session->userdata('session_role') == "AI")
        {
          $this->db->where("list_of_leads.area_incharge",$this->session->userdata('session_id'));
        }
        
        $this->db->where("list_of_leads.policy_status !=","1");
        $this->db->where("list_of_leads.lead_status !=","completed");
  	    
      	return $this->db->get("list_of_leads")->num_rows();
	}
	
	public function fetch_all_follow_ups($from_date,$to_date)
	{
	    $this->db->select("follow_up_details.*,list_of_clients.id as lid,list_of_clients.client_name,list_of_clients.mobile_no,list_of_leads.lead_generated_date,(select policy_ex_date from temp_policy_info where temp_policy_info.lead_id = list_of_leads.parent_lead_id ) as due_date,
		(select name from admin_login a where a.id = follow_up_details.updated_by) as followup_user");
	    $this->db->from("follow_up_details");
	    $this->db->join("list_of_leads","follow_up_details.lead_id=list_of_leads.id");
	    $this->db->join("list_of_clients","list_of_leads.client_id=list_of_clients.id");
	    $this->db->where("follow_up_details.next_follow_up_date >=",$from_date);
	    $this->db->where("follow_up_details.next_follow_up_date <=",$to_date);
	    return $this->db->get()->result();
	}
	
	public function delete_follow_up($id)
	{
	    $this->db->where("id",$id);
	    if($this->db->delete("follow_up_details")){
	        return true;
	    }
	    
	    return false;
	}
	
	public function fetch_edit_follow_up($id)
	{
	     $this->db->where("id",$id);
	     return $this->db->get("follow_up_details")->row();
	}
	public function edit_follow_up_details($data,$id)
	{
	      $this->db->where("id",$id);
	     if($this->db->update("follow_up_details",$data)){
	         return true;
	     }
	     
	     return false;
	}
	
	public function move_classification($id,$data)
	{
	      $this->db->where("id",$id);
	     if($this->db->update("list_of_leads",$data)){
	         return true;
	     }
	     
	     return false;
	}
	
	public function upload_policy_document_files($data)
	{
	    $this->db->insert("policy_documents",$data);
  	    $insert_id = $this->db->insert_id();
        $this->db->where("id",$insert_id);
        return $this->db->get("policy_documents")->row();
	}
	
   public function fetch_policy_doc_files($id)
	{
        $this->db->where("lead_id",$id);
        return $this->db->get("policy_documents")->result();
	}
	
	public function save_generated_policy($data)
	{
	    $this->db->insert("policy_info",$data);
	    return true;
	}
	
	public function add_health_details($data)
	{
	    $this->db->insert("health_details",$data);
	    return true;
	}
	
	public function get_receiver_email_id($lead_id)
	{
	    $this->db->where("id",$lead_id);
	    return $this->db->get("list_of_leads")->row();
	}
	
	public function get_receiver_email_by_id($id)
	{
	    $this->db->where("id",$id);
	    return $this->db->get("list_of_clients")->row();
	}
	
	public function fetch_email_templates()
	{
	    return $this->db->get("email_templates")->result();
	}
	
	public function fetch_email_content($template_id)
	{
	    $this->db->where("id",$template_id);
	    return $this->db->get("email_templates")->row();
	}
	
	public function get_policy_details($lead_id)
	{
	    $this->db->select('*,(select class from list_of_leads l where policy_info.lead_id = l.id) as class');
	    $this->db->where("lead_id",$lead_id);
	    return $this->db->get("policy_info")->row();
	}
	
	public function get_commission_details($id)
	{
	    $this->db->where("id",$id);
	    return $this->db->get("company_payout_commission")->row();
	}
	
	
	
	
	public function get_vechile_documents($lead_id)
	{
	    $this->db->where("lead_id",$lead_id);
	    return $this->db->get("vechicle_documents")->result();
	}
	
	public function get_policy_documents($lead_id)
	{
	    $this->db->where("lead_id",$lead_id);
	    return $this->db->get("policy_documents")->result();
	}
	
	public function fetch_all_followups($lead_id)
	{
	    $this->db->where("lead_id",$lead_id);
	    return $this->db->get("follow_up_details")->result();
	}
	
	// customers //
	
	public function fetch_all_customers($lead_type,$class)
  	{
  	    $this->fetch_all_customers_query($lead_type,$class);
  	    
  	    if($_POST['length'] != -1)
      	{
        	$this->db->limit($_POST['length'],$_POST['start']);
      	}
      	
        $this->db->join("list_of_clients","list_of_leads.client_id = list_of_clients.id");
  	    $this->db->join("type_of_bussiness","list_of_leads.business_type = type_of_bussiness.id");
  	    $this->db->join("list_of_class","list_of_leads.class = list_of_class.id");
  	    $this->db->join("list_of_policy_type","list_of_leads.policy_type = list_of_policy_type.id");
  	    $this->db->join("policy_info","list_of_leads.id = policy_info.lead_id");
  	     $this->db->join("list_of_premium_cover_type","policy_info.policy_premium = list_of_premium_cover_type.id");
  	    $this->db->order_by("list_of_leads.id","DESC");
  	    return $this->db->get("list_of_leads")->result();
  	}
  	
  	public function fetch_all_customers_query($lead_type,$class)
  	{
  	   $this->db->select("list_of_leads.*,list_of_clients.client_name,list_of_clients.mobile_no,list_of_clients.other_contact_details,list_of_clients.landline_no,list_of_clients.address,list_of_clients.contact_person_name,list_of_clients.date_of_birth,list_of_clients.age,list_of_clients.area,type_of_bussiness.bussiness_type as b_type,list_of_class.class as lclass,list_of_policy_type.policy_type as p_type,policy_info.policy_no,policy_info.policy_ex_date,policy_info.policy_premium,policy_info.policy_terms,list_of_premium_cover_type.name as pre_name");
  	   if(isset($_POST['search']['value']) && $_POST['search']['value'] != "")
      	{
    		$this->db->where("(list_of_clients.client_name LIKE '%".$_POST['search']['value']."%' OR list_of_clients.mobile_no LIKE '%".$_POST['search']['value']."%' OR list_of_clients.other_contact_details LIKE '%".$_POST['search']['value']."%' OR list_of_clients.landline_no LIKE '%".$_POST['search']['value']."%'  OR list_of_clients.date_of_birth LIKE '%".$_POST['search']['value']."%' OR list_of_clients.age LIKE '%".$_POST['search']['value']."%' OR list_of_clients.area LIKE '%".$_POST['search']['value']."%'  OR list_of_leads.location LIKE '%".$_POST['search']['value']."%' OR list_of_leads.lead_generated_date LIKE '%".$_POST['search']['value']."%' OR list_of_clients.address LIKE '%".$_POST['search']['value']."%' OR list_of_clients.email LIKE '%".$_POST['search']['value']."%' OR type_of_bussiness.bussiness_type LIKE '%".$_POST['search']['value']."%' OR list_of_clients.contact_person_name LIKE '%".$_POST['search']['value']."%' OR list_of_policy_type.policy_type LIKE '%".$_POST['search']['value']."%'  OR list_of_class.class LIKE '%".$_POST['search']['value']."%' OR list_of_clients.contact_person_designation LIKE '%".$_POST['search']['value']."%' OR policy_info.policy_no LIKE '%".$_POST['search']['value']."%' OR policy_info.policy_premium LIKE '%".$_POST['search']['value']."%' OR policy_info.policy_ex_date LIKE '%".$_POST['search']['value']."%')", NULL, FALSE);	    
      	}
  	    $this->db->where("list_of_leads.lead_type", $lead_type);
  	    $this->db->where("list_of_leads.class",$class);
  	    
  	   if($this->session->userdata("session_role") == "user")
     	{
      	 //   $this->db->where("list_of_leads.assigned_user", $this->session->userdata("session_id"));
      	}
      	else if($this->session->userdata("session_role") == "AI")
      	{
      	    $this->db->where("list_of_leads.area_incharge", $this->session->userdata("session_id"));
      	}
  	}
  	
  	public function get_customer_filtered_datas_count($lead_type,$class)
	{
      	$this->fetch_all_customers_query($lead_type,$class);
      	$this->db->join("list_of_clients","list_of_leads.client_id = list_of_clients.id");
  	    $this->db->join("type_of_bussiness","list_of_leads.business_type = type_of_bussiness.id");
  	    $this->db->join("list_of_class","list_of_leads.class = list_of_class.id");
  	    $this->db->join("list_of_policy_type","list_of_leads.policy_type = list_of_policy_type.id");
  	    $this->db->join("policy_info","list_of_leads.id = policy_info.lead_id");
  	   $this->db->join("list_of_premium_cover_type","policy_info.policy_premium = list_of_premium_cover_type.id");
  	    $this->db->order_by("list_of_leads.id","DESC");
      	$res = $this->db->get("list_of_leads");
      	return $res->num_rows();
	}
	
	public function get_all_customer_datas_count($lead_type,$class)
	{
      	$this->db->select("list_of_leads.id");
      	$this->db->join("list_of_clients","list_of_leads.client_id = list_of_clients.id");
  	    $this->db->join("type_of_bussiness","list_of_leads.business_type = type_of_bussiness.id");
  	    $this->db->join("policy_info","list_of_leads.id = policy_info.lead_id");
  	    $this->db->join("list_of_premium_cover_type","policy_info.policy_premium = list_of_premium_cover_type.id");
  	    $this->db->where("list_of_leads.lead_type",$lead_type);
  	    $this->db->where("list_of_leads.class", $class);
  	    if($this->session->userdata("session_role") == "user")
      	{
      	    $this->db->where("list_of_leads.assigned_user", $this->session->userdata("session_id"));
      	}
      	else if($this->session->userdata("session_role") == "AI")
      	{
      	    $this->db->where("list_of_leads.area_incharge", $this->session->userdata("session_id"));
      	}
  	    $this->db->order_by("list_of_leads.id","DESC");
      	return $this->db->get("list_of_leads")->num_rows();
	}
	// Renewals

   public function fetch_renewals($lead_type,$user_id,$from_date,$to_date)
  	{
  	    $this->fetch_renewals_query($lead_type,$user_id,$from_date,$to_date);
  	    
  	    if($_POST['length'] != -1)
      	{
        	$this->db->limit($_POST['length'],$_POST['start']);
      	}
      	 $this->db->join("list_of_clients","list_of_leads.client_id = list_of_clients.id");
  	    $this->db->join("type_of_bussiness","list_of_leads.business_type = type_of_bussiness.id");
  	    $this->db->join("list_of_class","list_of_leads.class = list_of_class.id");
  	    $this->db->join("list_of_policy_type","list_of_leads.policy_type = list_of_policy_type.id");
  	    $this->db->join("policy_info","list_of_leads.id = policy_info.lead_id");
  	     $this->db->join("list_of_premium_cover_type","policy_info.policy_premium = list_of_premium_cover_type.id");
  	    return $this->db->get("list_of_leads")->result();
  	}
  	
  	public function fetch_renewals_query($lead_type,$user_id,$from_date,$to_date)
  	{
  	 $this->db->select("list_of_leads.*,list_of_clients.client_name,list_of_clients.mobile_no,list_of_clients.other_contact_details,list_of_clients.landline_no,list_of_clients.address,list_of_clients.contact_person_name,list_of_clients.date_of_birth,list_of_clients.age,list_of_clients.area,type_of_bussiness.bussiness_type as b_type,list_of_class.class as lclass,list_of_policy_type.policy_type as p_type,policy_info.policy_no,policy_info.policy_ex_date,policy_info.policy_premium,policy_info.policy_terms,list_of_premium_cover_type.name as pre_name");
  	 
  	   if(isset($_POST['search']['value']) && $_POST['search']['value'] != "")
      	{
    		$this->db->where("(list_of_clients.client_name LIKE '%".$_POST['search']['value']."%' OR list_of_clients.mobile_no LIKE '%".$_POST['search']['value']."%' OR list_of_clients.other_contact_details LIKE '%".$_POST['search']['value']."%' OR list_of_clients.landline_no LIKE '%".$_POST['search']['value']."%'  OR list_of_clients.date_of_birth LIKE '%".$_POST['search']['value']."%' OR list_of_clients.age LIKE '%".$_POST['search']['value']."%' OR list_of_clients.area LIKE '%".$_POST['search']['value']."%' OR list_of_leads.location LIKE '%".$_POST['search']['value']."%' OR list_of_leads.lead_generated_date LIKE '%".$_POST['search']['value']."%' OR list_of_clients.address LIKE '%".$_POST['search']['value']."%' OR list_of_clients.email LIKE '%".$_POST['search']['value']."%' OR type_of_bussiness.bussiness_type LIKE '%".$_POST['search']['value']."%' OR list_of_clients.contact_person_name LIKE '%".$_POST['search']['value']."%' OR list_of_policy_type.policy_type LIKE '%".$_POST['search']['value']."%'  OR list_of_class.class LIKE '%".$_POST['search']['value']."%' OR list_of_clients.contact_person_designation LIKE '%".$_POST['search']['value']."%' OR policy_info.policy_no LIKE '%".$_POST['search']['value']."%' OR policy_info.policy_premium LIKE '%".$_POST['search']['value']."%' OR policy_info.policy_ex_date LIKE '%".$_POST['search']['value']."%')", NULL, FALSE);	    
      	}
  	    $this->db->where("list_of_leads.lead_type", $lead_type);
  	     
	    if($user_id != 1)
        {
            $this->db->where("list_of_leads.assigned_user",$user_id);
        }
        if($from_date != "all")
        {
            $this->db->where("policy_info.policy_ex_date >=", $from_date);
        }
        if($to_date != "all")
        {
            $this->db->where("policy_info.policy_ex_date <=", $to_date);
            $this->db->where("policy_info.policy_ex_date !=", 0000-00-00);
        }
        $this->db->where("policy_info.status !=","1");
  	}
  	
  	public function get_all_renewal_datas_count($lead_type,$user_id,$from_date,$to_date)
	{
      	$this->db->select("list_of_leads.id");
      		$this->db->join("list_of_clients","list_of_leads.client_id = list_of_clients.id");
  	    $this->db->join("type_of_bussiness","list_of_leads.business_type = type_of_bussiness.id");
  	    $this->db->join("policy_info","list_of_leads.id = policy_info.lead_id");
  	    $this->db->join("list_of_premium_cover_type","policy_info.policy_premium = list_of_premium_cover_type.id");
  	    
  	    $this->db->where("list_of_leads.lead_type", $lead_type);
	    if($user_id != 1)
        {
            $this->db->where("list_of_leads.assigned_user",$user_id);
        }
        if($from_date != "all")
        {
            $this->db->where("policy_info.policy_ex_date >=", $from_date);
        }
        if($to_date != "all")
        {
            $this->db->where("policy_info.policy_ex_date <=", $to_date);
            $this->db->where("policy_info.policy_ex_date !=", 0000-00-00);
        }
        $this->db->where("policy_info.status !=","1");
      	return $this->db->get("list_of_leads")->num_rows();
	}
	
  public function get_renewal_filtered_datas_count($lead_type,$user_id,$from_date,$to_date)
	{
      	$this->fetch_renewals_query($lead_type,$user_id,$from_date,$to_date);
      	
      	$this->db->join("list_of_clients","list_of_leads.client_id = list_of_clients.id");
  	    $this->db->join("type_of_bussiness","list_of_leads.business_type = type_of_bussiness.id");
  	    $this->db->join("list_of_class","list_of_leads.class = list_of_class.id");
  	    $this->db->join("list_of_policy_type","list_of_leads.policy_type = list_of_policy_type.id");
  	    $this->db->join("policy_info","list_of_leads.id = policy_info.lead_id");
  	     $this->db->join("list_of_premium_cover_type","policy_info.policy_premium = list_of_premium_cover_type.id");
      	$res = $this->db->get("list_of_leads");
      	return $res->num_rows();
	}
	
	public function update_lead_type_status($data_1,$id)
	{
	    $this->db->where("id",$id);
	    if($this->db->update("list_of_leads",$data_1)){
	        return true;
	    }
	    
	    return false;
	}
	
	public function fetch_client_id_by_lead_id($lead_id)
	{
	    $this->db->where("id",$lead_id);
	    $res = $this->db->get("list_of_leads")->row();
	    
	    if($res != "")
	    {
	        return $res->client_id;
	    }
	    else
	    {
	        return "";
	    }
	}
	
	public function update_client_details($client_id,$data)
	{
	    $this->db->where("id",$client_id);
	    if($this->db->update("list_of_clients",$data)){
	        return true;
	    }
	    
	    return false;
	}
	public function update_requirement_details($arr,$lead_id)
	{
	    $this->db->where("id",$lead_id);
	    $this->db->update("list_of_leads",$arr);
	    return true;
	}
	
	public function fetch_edit_vechicle_details($lead_id)
	{
	    $this->db->where("lead_id",$lead_id);
	    return $this->db->get("vechile_details")->row();
	}
	
	public function get_vechicle_uploaded_documents($lead_id)
	{
	    $this->db->where("lead_id",$lead_id);
	    return $this->db->get("vechicle_documents")->result();
	}
	
	public function get_vechicle_uploaded_file_by_id($id)
	{
	    $this->db->where("id",$id);
	    return $this->db->get("vechicle_documents")->row();
	}
	
	public function update_vechicle_documents($data,$id)
	{
	     $this->db->where("id",$id);
	     $this->db->update("vechicle_documents",$data);
	     
	     $this->db->where("id",$id);
	    return $this->db->get("vechicle_documents")->row();
	}
	
	public function delete_vechicle_documents($id)
	{
	     $this->db->where("id",$id);
	     $this->db->delete("vechicle_documents");
	     
	    $this->db->where("id",$id);
	    return $this->db->get("vechicle_documents")->row();
	}
	
	public function update_vechicle_details_1($data,$id)
	{
	     $this->db->where("lead_id",$id);
	     if($this->db->update("vechile_details",$data)) {
	        return true;    
	     }
	     
	     return false;
	}
	
	public function update_vechicle_details($data,$id)
	{
	     $this->db->where("id",$id);
	     if( $this->db->update("vechile_details",$data) ) {
	        return true;
	     }
	     
	     return false;
	}
	
	public function add_activity_log($data)
	{
	    if($this->db->insert("notification_log",$data)){
	        return true;
	    }
	    
	    return false;
	}
	
	public function get_recent_activities($lead_id)
	{
	    $this->db->where("lead_id",$lead_id);
	    $this->db->order_by("id", "desc");
	    $this->db->limit("5");
	    return $this->db->get("notification_log")->result();
	}
	
	public function get_follow_up_details($lead_id)
	{
	    $this->db->where("lead_id",$lead_id);
	    $this->db->order_by("id","desc");
	    return $this->db->get("follow_up_details")->row();
	}
	
	public function fetch_vechicle_lead_id($id)
	{
	     $this->db->where("id",$id);
	     return $this->db->get("vechile_details")->row();
	}
	
	// quotations
	
	public function get_basic_informations($lead_id)
	{
	    $this->db->select("list_of_leads .*,list_of_clients.client_name,list_of_class.class as class_name,list_of_policy_type.policy_type as policy_type_name");
	    $this->db->from("list_of_leads");
	    $this->db->join("list_of_clients","list_of_leads.client_id = list_of_clients.id");
	    $this->db->join("list_of_class","list_of_leads.class = list_of_class.id");
	    $this->db->join("list_of_policy_type","list_of_leads.policy_type = list_of_policy_type.id");
	    $this->db->where("list_of_leads.id",$lead_id);
	    return $this->db->get()->row();
	    
	}
    public function add_quotations($data)
    {
        $this->db->insert("quotations",$data);
        return true;
    }
    
    public function get_all_quotes($lead_id)
    {
        $this->db->select("quotations.*,list_of_leads.class,list_of_leads.policy_type");
        $this->db->from("quotations");
        $this->db->join("list_of_leads","quotations.lead_id = list_of_leads.id");
        $this->db->where("quotations.lead_id",$lead_id);
        return $this->db->get()->result();
    }
    
    public function fetch_single_company_settings($company_id)
    {
        $this->db->where("id",$company_id);
        return $this->db->get("company_settings")->row();
    }
    
    public function get_single_quote_details($id)
    {
         $this->db->where("id",$id);
        return $this->db->get("quotations")->row();
    }
    
    public function get_user_details($id)
    {
        $this->db->where("id",$id);
        return $this->db->get("admin_login")->row();
    }
    
    // Pet Details 
    
    public function get_policy_type_by_lead_id($lead_id)
    {
        $this->db->where("id",$lead_id);
        return $this->db->get("list_of_leads")->row();
    }
    
    public function add_pet_details($data)
    {
        $this->db->insert("pet_details",$data);
        $insert_id = $this->db->insert_id();
        return  $insert_id;
    }
    
    public function get_pet_details($id)
    {
        $this->db->where("id",$id);
        return $this->db->get("pet_details")->row();
    }
    
    public function get_pet_details_by_lead_id($lead_id)
    {
        $this->db->where("lead_id",$lead_id);
        return $this->db->get("pet_details")->row();
    }
    
    public function add_home_details($data)
    {
        $this->db->insert("home_details",$data);
        $insert_id = $this->db->insert_id();
        return  $insert_id;
    }
    
    public function add_business_details($data)
    {
        $this->db->insert("business_details",$data);
        $insert_id = $this->db->insert_id();
        return  $insert_id;
    }
    
    public function get_business_details($id)
    {
        $this->db->where("id",$id);
        return $this->db->get("business_details")->row();
    }
    
    public function get_business_details_by_lead_id($lead_id)
    {
        $this->db->where("lead_id",$lead_id);
        return $this->db->get("business_details")->row();
    }
    
    public function get_home_details_by_lead_id($lead_id)
    {
        $this->db->where("lead_id",$lead_id);
        return $this->db->get("home_details")->row();
    }
    
    public function fetch_list_of_policy_type()
    {
        return $this->db->get("list_of_class")->result();
    }
    
    public function get_home_details($id)
    {
        $this->db->where("id",$id);
        return $this->db->get("home_details")->row();
    }
    // maraine 
    public function commodity_change_load_sub_commodity($commodity)
  	{
  	    $this->db->where("commodity_id",$commodity);
  	    return $this->db->get("list_of_marine_sub_commodity")->result();
  	}
  	
  	public function add_marine_details($data)
  	{
  	    $this->db->insert("marine_details",$data);
  	    $insert_id = $this->db->insert_id();
        return  $insert_id;
  	}
  	
  	public function get_maraine_details($id)
  	{
  	    $this->db->select("marine_details.*,list_of_marine_commodity.name as maraine_commodity,list_of_marine_sub_commodity.name as m_sub_commodity");
  	    $this->db->from("marine_details");
  	    $this->db->join("list_of_marine_commodity","marine_details.commodity = list_of_marine_commodity.id");
  	    $this->db->join("list_of_marine_sub_commodity","marine_details.sub_commodity = list_of_marine_sub_commodity.id");
  	    $this->db->where("marine_details.id",$id);
  	    return $this->db->get()->row();
  	}
  	
  	public function get_maraine_details_by_lead_id($lead_id)
  	{
  	     $this->db->select("marine_details.*,list_of_marine_commodity.name as maraine_commodity,list_of_marine_sub_commodity.name as m_sub_commodity");
  	    $this->db->from("marine_details");
  	    $this->db->join("list_of_marine_commodity","marine_details.commodity = list_of_marine_commodity.id");
  	    $this->db->join("list_of_marine_sub_commodity","marine_details.sub_commodity = list_of_marine_sub_commodity.id");
  	    $this->db->where("marine_details.lead_id",$lead_id);
  	    return $this->db->get()->row();
  	}
  	
  	// nominee 
  	
  	public function add_nominee_details($nominee_details)
  	{
  	    if($this->db->insert("nominee_details",$nominee_details)){
  	        return true;
  	    }
  	    
  	    return false;
  	}
  	
  	public function get_policy_type($lead_id)
  	{
  	   $this->db->select("list_of_leads.*,vechile_details.vechi_register_no");
        $this->db->from("list_of_leads");
        $this->db->join("vechile_details","vechile_details.lead_id = list_of_leads.id",'left');
        $this->db->where("list_of_leads.id",$lead_id);
        return $this->db->get()->row();
  	}
  	
  	// renewal 
  	
  	public function get_client_details_by_lead_id($lead_id)
  	{
  	    $this->db->select("list_of_leads.*,list_of_clients.client_type_id,list_of_clients.client_name,list_of_clients.mobile_no,list_of_clients.other_contact_details,list_of_clients.landline_no,list_of_clients.address,list_of_clients.email,list_of_clients.contact_person_name,list_of_clients.contact_person_designation,list_of_clients.date_of_birth,list_of_clients.age,list_of_clients.area");
  	    $this->db->from("list_of_leads");
  	    $this->db->join("list_of_clients","list_of_leads.client_id =list_of_clients.id");
  	    $this->db->where("list_of_leads.id",$lead_id);
  	    return $this->db->get()->row();
  	}
  	
  
  	
  	public function add_motor_details($lead_id,$data_1,$date)
  	{
  	    $this->db->query('INSERT INTO vechile_details(lead_id,vechile_type,policy_type,vechi_make,vechi_model,vechi_varient,vechi_cc,vechi_manu_month,vechi_manu_year,vechi_seating,vechi_classfication,vechi_fuel_type,vechi_gvw,passenger_carrying,vechi_engine_num,vechi_chassis_num,vechi_hypothecation,created_by,vechi_remarks,regn_date,vechi_register_no,rto,zone,regn_address,state,city,pincode,vechi_user_name,vechi_user_cont,created_at)
                     SELECT '.$data_1.',vechile_type,policy_type,vechi_make,vechi_model,vechi_varient,vechi_cc,vechi_manu_month,vechi_manu_year,vechi_seating,vechi_classfication,vechi_fuel_type,vechi_gvw,passenger_carrying,vechi_engine_num,vechi_chassis_num,vechi_hypothecation,'.$this->session->userdata('session_id').',vechi_remarks,regn_date,vechi_register_no,rto,zone,regn_address,state,city,pincode,vechi_user_name,vechi_user_cont,'.$date.' from vechile_details Where lead_id = '.$lead_id.'');
  	}
  	
  	
  	public function add_renew_maraine_details($lead_id,$data_1,$date)
  	{
  	    $this->db->query('INSERT INTO health_details (husband,wife,father,mother,son,duaghter,father_age,mother_age,husband_age,wife_age,son_count,duaghter_count,son1_age,son2_age,son3_age,son4_age,daughter1_age,daughter2_age,daughter3_age,daughter4_age,gender,lead_id,created_at,created_by)
                     SELECT health_details from health_details husband,wife,father,mother,son,duaghter,father_age,mother_age,husband_age,wife_age,son_count,duaghter_count,son1_age,son2_age,son3_age,son4_age,daughter1_age,daughter2_age,daughter3_age,daughter4_age,gender,'.$data_1.','.$date.','.$this->session->userdata("session_id").' Where lead_id = '.$lead_id.'');
  	}
  	
  	public function update_renewal_status($re_status,$lead_id)
  	{
  	    $this->db->where("lead_id",$lead_id);
  	    $this->db->update("policy_info",$re_status);
  	    return true;
  	}
  	
  	public function view_lead_details($lead_id)
  	{
  	    $this->db->select("list_of_leads.*,list_of_clients.mobile_no,list_of_clients.client_type_id,list_of_clients.client_name,list_of_clients.mobile_no,list_of_clients.other_contact_details,list_of_clients.landline_no,list_of_clients.address,list_of_clients.email,list_of_clients.contact_person_name,list_of_clients.contact_person_designation,list_of_clients.date_of_birth,list_of_clients.age,list_of_clients.area");
  	    $this->db->from("list_of_leads");
  	    $this->db->join("list_of_clients","list_of_leads.client_id =list_of_clients.id");
  	    $this->db->where("list_of_leads.id",$lead_id);
  	    return $this->db->get()->row();
  	}
  	
  	public function get_vechicle_details($lead_id)
  	{
  	    $this->db->where("lead_id",$lead_id);
  	    return $this->db->get("vechile_details")->row();
  	}
  	
  	public function get_leads_id($client_id)
  	{
  	     $this->db->where("client_id",$client_id);
  	    return $this->db->get("list_of_leads")->result();
  	}
  	
  	
  	public function get_policy_informations($id)
  	{
  	    $this->db->select("policy_info.id,policy_info.sum_insured,policy_info.policy_agency_pos,list_of_leads.business_type,policy_info.policy_premium,list_of_leads.class,policy_info.company,policy_info.gst,policy_info.policy_s_date,policy_info.policy_ex_date,list_of_premium_cover_type.name as policy_premium_name,type_of_bussiness.bussiness_type as business_name,list_of_class.class as class_name,list_of_policy_type.policy_type,policy_info.total_own_damage,policy_info.basic_tp,policy_info.total_premium,policy_info.policy_no,list_of_clients.client_name,list_of_clients.mobile_no,list_of_pos_and_agents.agent_pos_code,list_of_insurance_company.company_name");
      	$this->db->join("list_of_leads","policy_info.lead_id = list_of_leads.id");
  	    $this->db->join("list_of_clients","list_of_leads.client_id = list_of_clients.id");
  	    $this->db->join("list_of_pos_and_agents","policy_info.policy_agency_pos = list_of_pos_and_agents.id");
  	    $this->db->join("list_of_insurance_company","policy_info.company = list_of_insurance_company.id");
  	    $this->db->join("type_of_bussiness","list_of_leads.business_type = type_of_bussiness.id");
  	    $this->db->join("list_of_class","list_of_leads.class = list_of_class.id");
  	    $this->db->join("list_of_policy_type","list_of_leads.policy_type = list_of_policy_type.id");
  	    $this->db->join("list_of_premium_cover_type","policy_info.policy_premium = list_of_premium_cover_type.id");
  	    $this->db->where("policy_info.lead_id",$id);
  	    return $this->db->get("policy_info")->result();
  	}
  	
  	public function check_commission_exits($company,$policy_class,$bussiness_type,$policy_premium,$commission_type,$policy_type,$ins_state)
  	{
  	    $this->db->where("policy_premium_type",$policy_premium);
  	    $this->db->where("class",$policy_class);
  	    $this->db->where("business_type",$bussiness_type);
  	    $this->db->where("policy_type",$policy_type);
  	    $this->db->where("state",$ins_state);
  	    //$this->db->where("fuel_type",$fuel_type);
  	    //$this->db->where("classification",$ins_classification);
  	    return $this->db->get("company_payout_commission")->result();
  	    
  	}
  	
  	public function check_make_already_exits($commission_id,$policy_type,$make)
  	{
  	    if($commission_id != null)
  	    {
      	    $this->db->where_in("commission_id",$commission_id);
      	    $this->db->where("policy_type",$policy_type);
      	    $this->db->where("make",$make);
      	    return $this->db->get("com_make_log")->result();
  	    }
  	    else
  	    {
  	        return array();
  	    }
  	    
  	}
  	
  	public function check_model_already_exits($commission_id,$policy_type,$make,$model)
  	{
  	    if($commission_id != null)
  	    {
      	    $this->db->where_in("commission_id",$commission_id);
      	    $this->db->where("policy_type",$policy_type);
          	$this->db->where("make_id",$make);
          	$this->db->where("model_id",$model);
      	    return $this->db->get("com_model_log")->result();
  	    }
  	    else
  	    {
  	        return array();
  	    }
  	}
  	
  	public function check_varient_already_exits($commission_id,$policy_type,$make,$model,$varient)
  	{
  	    if($commission_id != null)
  	    {
      	    $this->db->where_in("commission_id",$commission_id);
      	    $this->db->where("make_id",$make);
      	    $this->db->where("model_id",$model);
      	    $this->db->where("varient_id",$varient);
      	    $this->db->where("policy_type",$policy_type);
      	    return $this->db->get("com_varient_log")->result();
  	    }
  	    else
  	    {
  	        return array();
  	    }
  	}
  	
  	public function check_rto_already_exits($commission_id,$ins_rto)
  	{
  	    $this->db->where_in("commission_id",$commission_id);
  	    $this->db->where("rto",$ins_rto);
  	    return $this->db->get("commission_rto_log")->row();
  	}
  	
  	public function check_vechi_age_already_exits($company,$policy_premium,$policy_class,$bussiness_type,$policy_type,$state,$fuel_type)
  	{
  	    $this->db->where("insurer_company",$company);
  	    $this->db->where("policy_premium_type",$policy_premium);
  	    $this->db->where("class",$policy_class);
  	    $this->db->where("business_type",$bussiness_type);
  	    $this->db->where("policy_type",$policy_type);
  	    $this->db->where("state",$state);
  	    //$this->db->where("fuel_type",$fuel_type);
  	    return $this->db->get("company_payout_commission")->result();
  	}
  	
  	public function get_classification($id,$policy_type)
  	{
  	    $this->db->where("id",$id);
  	    $this->db->where("motor_category_id",$policy_type);
  	    return $this->db->get("commission_motor_gvw")->row();
  	}
  	
  	public function fetch_fuel_type()
  	{
  	    return $this->db->get("list_of_car_fuel_type")->result();
  	}
  	
  	public function add_policy_documents($data)
  	{
  	    if($this->db->insert("policy_documents",$data)) {
  	        return true;
  	    }
  	    
  	    return false;
  	}
  	
  	public function check_this_nop_already_exits($insurer_company,$premium_c_type,$insurer_class,$business_type,$policy_type,$ins_state,$policy_issue_date)
  	{
  	    $this->db->where("insurer_company",$insurer_company);
  	    $this->db->where("policy_premium_type",$premium_c_type);
  	    $this->db->where("class",$insurer_class);
  	    $this->db->where("business_type",$business_type);
  	    $this->db->where("policy_type",$policy_type);
  	    $this->db->where("state",$ins_state);
  	    $this->db->where("from_date <=",$policy_issue_date);
  	    $this->db->where("to_date >=",$policy_issue_date);
  	    return $this->db->get("company_payout_commission")->result();
  	}
  	
  	public function check_make_all_already_exits($commission_id,$policy_type)
   {
       if($commission_id != null)
       {
       $this->db->where_in("id",$commission_id);
       $this->db->where("policy_type",$policy_type);
       $this->db->where("v_make","all");
       return $this->db->get("company_payout_commission")->result();
       
       
       }
       else
       {
           return array();
       }
   }
   
   public function check_model_all_already_exits($commission_id,$policy_type)
   {
       if($commission_id != null)
       {
           $this->db->where_in("id",$commission_id);
           $this->db->where("policy_type",$policy_type);
           $this->db->where("v_model","all");
           return $this->db->get("company_payout_commission")->result();
       }
       else
       {
           return array();
       }
       
   }
   
   public function check_varient_all_already_exits($commission_id,$policy_type)
   {
       if($commission_id != null)
       {
           $this->db->where_in("id",$commission_id);
           $this->db->where("policy_type",$policy_type);
           $this->db->where("v_varient","all");
           return $this->db->get("company_payout_commission")->result();
       }
       else
       {
           return array();
       }
   }
   
   public function fetch_all_direct_renewals($from_date,$to_date)
   {
        $this->db->select("list_of_leads.*,list_of_clients.client_name,list_of_clients.mobile_no,list_of_clients.other_contact_details,list_of_clients.landline_no,list_of_clients.address,list_of_clients.contact_person_name,list_of_clients.date_of_birth,list_of_clients.age,list_of_clients.area,type_of_bussiness.bussiness_type as b_type,list_of_class.class as lclass,list_of_policy_type.policy_type as p_type");
       	$this->db->join("list_of_clients","list_of_leads.client_id = list_of_clients.id");
  	    $this->db->join("type_of_bussiness","list_of_leads.business_type = type_of_bussiness.id");
  	    $this->db->join("list_of_class","list_of_leads.class = list_of_class.id");
  	    $this->db->join("list_of_policy_type","list_of_leads.policy_type = list_of_policy_type.id");
  	    
  	    if($from_date != "all")
  	    {
  	        //$this->db->where("list_of_leads.due_date >=",$from_date);
  	    }
  	    if($to_date != "all")
  	    {
  	        //$this->db->where("list_of_leads.due_date <=",$to_date);
  	    }
  	     $this->db->where("list_of_leads.due_date >=", date("Y-m-d"));
        $this->db->where("list_of_leads.due_date !=", 0000-00-00);
  	    $this->db->order_by('list_of_leads.due_date','Asc');
  	    //$this->db->order_by("list_of_leads.id","DESC");
  	    $this->db->where("list_of_leads.lead_type !=","2");
  	    $this->db->where("list_of_leads.policy_status !=","1");
  	    return $this->db->get("list_of_leads")->result();
   }
   
   public function get_nominee_details($lead_id)
   {
       $this->db->where("lead_id",$lead_id);
       return $this->db->get("nominee_details")->row();
   }
   
   public function get_premium_c_type()
   {
       return $this->db->get("list_of_premium_cover_type")->result();
   }
   
   
   public function get_lead_info($id)
   {
       $this->db->select("vechile_details.*,list_of_leads.business_type,list_of_leads.class,list_of_leads.policy_type,list_of_leads.parent_lead_id");
       $this->db->from("vechile_details");
       $this->db->join("list_of_leads","list_of_leads.id = vechile_details.lead_id");
       $this->db->where("list_of_leads.id",$id);
       return $this->db->get()->row();
       
   }
  
   public function get_class_type($lead_id)
   {
       $this->db->where("id",$lead_id);
       return $this->db->get("list_of_leads")->row();
   }
   
   public function get_seating($v_seating,$policy_type,$id)
   {
       $this->db->where("id",$id);
       $this->db->where("policy_type",$policy_type);
       $this->db->where("classification",$v_seating);
       return $this->db->get("company_payout_commission")->result();
   }
   
   public function get_agent_name($id)
   {
       $this->db->where("id",$id);
       return $this->db->get("list_of_pos_and_agents")->row();
   }
   public function get_user_name($id)
   {
       $this->db->where("id",$id);
       return $this->db->get("admin_login")->row();
   }
   
   public function get_pcv_seating($policy_type)
   {
       $this->db->where("policy_type",$policy_type);
       return $this->db->get("pcv_seating")->result();
   }
   
   public function check_seating($v_seating,$policy_type,$commission_id)
   {
       if($commission_id != null)
       {
           $this->db->where_in("id",$commission_id);
           $this->db->where("policy_type",$policy_type);
           $this->db->where("classification",$v_seating);
           return $this->db->get("company_payout_commission")->result();
       }
       else 
       {
           return array();
       }
   }
   
   public function fetch_area_incharge_by_agent($agent_pos)
   {
       $this->db->select("admin_login.*,list_of_pos_and_agents.region");
       $this->db->from("admin_login");
       $this->db->join("list_of_pos_and_agents","list_of_pos_and_agents.area_incharge = admin_login.id");
       $this->db->where("list_of_pos_and_agents.id",$agent_pos);
       return $this->db->get()->row();
   }
   
   public function check_policy_no_already_exits($policy_no)
   {
       $this->db->where("policy_no",$policy_no);
       return $this->db->get("policy_info")->row();
   }
   
    public function insert_temp_data($data)
   {
       if($this->db->insert("temp_policy_info",$data)){
           return true;
       }
       
       return false;
   }
   
   public function get_temp_policy_data($lead_id)
   {
       $this->db->where("lead_id",$lead_id);
       return $this->db->get("temp_policy_info")->row();
   }
   
   public function get_policy_data($lead_id)
   {
       $this->db->where("lead_id",$lead_id);
       return $this->db->get("policy_info")->row();
   }
   
   public function get_health_details($lead_id)
   {
       $this->db->where("lead_id",$lead_id);
       return $this->db->get("health_details")->row();
   }
   
   	public function update_health_details($data,$lead_id)
	{
	    $this->db->where("lead_id",$lead_id);
	    $this->db->update("health_details",$data);
	    return true;
	}
	
	public function check_this_lead_already_in_policy($lead_id)
	{
	    $this->db->where("lead_id",$lead_id);
	    return $this->db->get("policy_info")->num_rows();
	}
	
	public function update_health_policy_details($data,$lead_id)
	{
	    $this->db->where("lead_id",$lead_id);
	    if( $this->db->update("health_details",$data) ) {
	        return true;
	    }
	    
	    return false;
	}
	
	 public function get_area_incharge($id)
   {
        $this->db->where("id",$id);
       return $this->db->get("admin_login")->row();
   }
   
   public function check_vehi_regn_no($regn_no)
   {
       $this->db->where("vechi_register_no",$regn_no);
       return $this->db->get("vechile_details")->num_rows();
   }
   
   public function fetch_user_by_agent($agent_pos)
   {
         $this->db->where("id",$agent_pos);
       return $this->db->get("list_of_pos_and_agents")->row();
   }
   
   public function get_user_by_id($id)
   {
       $this->db->where("id",$id);
       return $this->db->get("admin_login")->row();
   }
   
   public function fetch_region()
   {
       return $this->db->get("list_of_reigion")->result();
   }
   
   public function fetch_region_by_area_incharge($id)
   {
       $this->db->select("list_of_reigion.*");
       $this->db->from("list_of_reigion");
       $this->db->join("ai_regions","ai_regions.region_id = list_of_reigion.id");
       $this->db->where("ai_regions.ai_id",$id);
       return $this->db->get()->result();
   }
   
   public function fetch_agent_region($agent_pos)
   {
        $this->db->where("id",$agent_pos);
       return $this->db->get("list_of_pos_and_agents")->row();
   }
   
   //
   public function get_duplicate_records()
   {
       $this->db->select("id,lead_id,policy_no");
       $this->db->order_by("id", "desc");
       $this->db->where("policy_no !=","");
       //$this->db->where("com_trigger_status !=","1");
       return $this->db->get("temp_policy_info")->result();
   }
   
   public function delete_duplicates($id)
   {
       $this->db->where("id",$id);
       $this->db->delete("temp_policy_info");
       return true;
   }
   
   public function get_gen_policy_leads_not_completed()
   {
       $this->db->select("list_of_leads.*,temp_policy_info.lead_id");
       $this->db->from("list_of_leads");
       $this->db->join("temp_policy_info","temp_policy_info.lead_id = list_of_leads.id");
       $this->db->where("list_of_leads.lead_status !=","completed");
       return $this->db->get()->result();
   }
   
   public function update_policy_status($data,$id)
   {
       $this->db->where("id",$id);
       $this->db->update("list_of_leads",$data);
       return true;
   }
   
   public function update_quote_status($id,$data)
   {
       $this->db->where("id",$id);
       $this->db->update("list_of_leads",$data);
       return true;
   }
   
   public function update_temp_data($data,$id)
   {
       $this->db->where("id",$id);
       $this->db->update("temp_policy_info",$data);
       return true;
   }
   
    public function update_generated_policy($data,$id)
   {
       $this->db->where("lead_id",$id);
       if($this->db->update("policy_info",$data)){
           return true;
       }
       
       return false;
       
   }
   
   public function get_unassigned_ai_leads()
   {
       $this->db->where("agency_and_pos !=","");
       $this->db->where("area_incharge","");
       return $this->db->get("list_of_leads")->result();
   }
   
   public function get_area_incharge_1($id)
   {
       $this->db->where("id",$id);
       return $this->db->get("list_of_pos_and_agents")->row();
   }
   
   public function update_area_incharge_in_leads($data,$id)
   {
       $this->db->where("id",$id);
       $this->db->update("list_of_leads",$data);
       return true;
   }
   
   public function add_vechicle_regn_no($v_info)
   {
       if($this->db->insert("vechile_details",$v_info)){
           return true;
       }
       
       return false;
   }
   
   public function update_vechicle_regn_no($data,$lead_id)
   {
       $this->db->where("lead_id",$lead_id);
       if($this->db->update("vechile_details",$data)){
           return true;
       }
       
       return false;
   }
   
   public function update_temp_data_by_lead_id($data,$lead_id)
   {
       $this->db->where("lead_id",$lead_id);
       if($this->db->update("temp_policy_info",$data)){
           return true;
       }
       
       return false;
       
   }
   
   public function check_lead_id_already_exits($lead_id)
   {
       $this->db->where("lead_id",$lead_id);
       return $this->db->get("temp_policy_info")->num_rows();
   }
   
   
   // Business Complete motor
   
   
   	public function fetch_business_query()
	{
        $this->db->select("list_of_leads.*,temp_policy_info.*,list_of_clients.client_name,list_of_clients.mobile_no,list_of_clients.other_contact_details,list_of_clients.landline_no,list_of_clients.address,list_of_clients.contact_person_name,list_of_clients.date_of_birth,list_of_clients.age,list_of_clients.area,type_of_bussiness.bussiness_type as b_type,list_of_class.class as lclass,list_of_policy_type.policy_type as p_type");
        
        if(isset($_POST['search']['value']) && $_POST['search']['value'] != "")
        {
            $this->db->where("(temp_policy_info.policy_no LIKE '%".$_POST['search']['value']."%' OR list_of_clients.client_name LIKE '%".$_POST['search']['value']."%' OR list_of_clients.mobile_no LIKE '%".$_POST['search']['value']."%' OR list_of_clients.other_contact_details LIKE '%".$_POST['search']['value']."%' OR list_of_clients.landline_no LIKE '%".$_POST['search']['value']."%'  OR list_of_clients.date_of_birth LIKE '%".$_POST['search']['value']."%' OR list_of_clients.age LIKE '%".$_POST['search']['value']."%' OR list_of_clients.area LIKE '%".$_POST['search']['value']."%'  OR list_of_leads.location LIKE '%".$_POST['search']['value']."%' OR list_of_leads.lead_generated_date LIKE '%".$_POST['search']['value']."%' OR list_of_clients.address LIKE '%".$_POST['search']['value']."%' OR list_of_clients.email LIKE '%".$_POST['search']['value']."%' OR type_of_bussiness.bussiness_type LIKE '%".$_POST['search']['value']."%' OR list_of_clients.contact_person_name LIKE '%".$_POST['search']['value']."%' OR list_of_policy_type.policy_type LIKE '%".$_POST['search']['value']."%'  OR list_of_class.class LIKE '%".$_POST['search']['value']."%' OR list_of_clients.contact_person_designation LIKE '%".$_POST['search']['value']."%')", NULL, FALSE);	    
        }
        //$this->db->where("list_of_leads.policy_status","1");
        $this->db->where("list_of_leads.lead_type !=","2");
      	    
	}
	
  	public function fetch_business_complete()
  	{
  	    $this->fetch_business_query();
  	    
  	    if($_POST['length'] != -1)
      	{
        	$this->db->limit($_POST['length'],$_POST['start']);
      	}
      	$this->db->join("list_of_clients","list_of_leads.client_id = list_of_clients.id");
  	    $this->db->join("type_of_bussiness","list_of_leads.business_type = type_of_bussiness.id");
  	    $this->db->join("list_of_class","list_of_leads.class = list_of_class.id");
  	    $this->db->join("list_of_policy_type","list_of_leads.policy_type = list_of_policy_type.id");
  	    $this->db->join("admin_login","list_of_leads.assigned_user = admin_login.id",'left');
  	    $this->db->join("temp_policy_info","temp_policy_info.lead_id = list_of_leads.id");

  	    if($this->session->userdata('session_role') == "user")
  	    {
  	        $this->db->where("list_of_leads.assigned_user",$this->session->userdata('session_id'));
  	    }
  	    
  	    if($this->session->userdata('session_role') == "AI")
  	    {
  	        $this->db->where("list_of_leads.area_incharge",$this->session->userdata('session_id'));
  	    }
  	    return $this->db->get("list_of_leads")->result();
  	}
  	
  	public function get_filtered_business_complete_count()
	{
      	$this->fetch_business_query();
      	$this->db->join("list_of_clients","list_of_leads.client_id = list_of_clients.id");
  	    $this->db->join("type_of_bussiness","list_of_leads.business_type = type_of_bussiness.id");
  	    $this->db->join("list_of_class","list_of_leads.class = list_of_class.id");
  	    $this->db->join("list_of_policy_type","list_of_leads.policy_type = list_of_policy_type.id");
  	    $this->db->join("temp_policy_info","temp_policy_info.lead_id = list_of_leads.id");
  	  
  	    if($this->session->userdata('session_role') == "user")
  	    {
  	        $this->db->where("list_of_leads.assigned_user",$this->session->userdata('session_id'));
  	    }
  	    
  	    if($this->session->userdata('session_role') == "AI")
  	    {
  	        $this->db->where("list_of_leads.area_incharge",$this->session->userdata('session_id'));
  	    }
      	$res = $this->db->get("list_of_leads");
      	return $res->num_rows();
	}
	public function get_all_business_complete_count()
	{
       $this->db->select("list_of_leads.id");
       $this->db->join("list_of_clients","list_of_leads.client_id = list_of_clients.id");
  	   $this->db->join("type_of_bussiness","list_of_leads.business_type = type_of_bussiness.id");
  	   $this->db->join("temp_policy_info","temp_policy_info.lead_id = list_of_leads.id");
       //$this->db->where("list_of_leads.policy_status","1");
       $this->db->where("list_of_leads.lead_type !=","2");

  	    if($this->session->userdata('session_role') == "user")
  	    {
  	        $this->db->where("list_of_leads.assigned_user",$this->session->userdata('session_id'));
  	    }

  	    if($this->session->userdata('session_role') == "AI")
  	    {
  	        $this->db->where("list_of_leads.area_incharge",$this->session->userdata('session_id'));
  	    }
      	return $this->db->get("list_of_leads")->num_rows();
	}
	
	
	public function get_temp_policy_informations($id)
  	{
  	    $this->db->select("temp_policy_info.id,temp_policy_info.sum_insured,temp_policy_info.policy_agency_pos,list_of_leads.business_type,temp_policy_info.policy_premium,list_of_leads.class,temp_policy_info.company,temp_policy_info.gst,temp_policy_info.policy_s_date,temp_policy_info.policy_ex_date,list_of_premium_cover_type.name as policy_premium_name,type_of_bussiness.bussiness_type as business_name,list_of_class.class as class_name,list_of_policy_type.policy_type,temp_policy_info.total_own_damage,temp_policy_info.basic_tp,temp_policy_info.total_premium,temp_policy_info.policy_no,list_of_clients.client_name,list_of_clients.mobile_no,list_of_pos_and_agents.agent_pos_code,list_of_insurance_company.company_name");
      	$this->db->join("list_of_leads","temp_policy_info.lead_id = list_of_leads.id");
  	    $this->db->join("list_of_clients","list_of_leads.client_id = list_of_clients.id");
  	    $this->db->join("list_of_pos_and_agents","temp_policy_info.policy_agency_pos = list_of_pos_and_agents.id");
  	    $this->db->join("list_of_insurance_company","temp_policy_info.company = list_of_insurance_company.id");
  	    $this->db->join("type_of_bussiness","list_of_leads.business_type = type_of_bussiness.id");
  	    $this->db->join("list_of_class","list_of_leads.class = list_of_class.id");
  	    $this->db->join("list_of_policy_type","list_of_leads.policy_type = list_of_policy_type.id");
  	    $this->db->join("list_of_premium_cover_type","temp_policy_info.policy_premium = list_of_premium_cover_type.id",'left');
  	    $this->db->where("temp_policy_info.lead_id",$id);
  	    return $this->db->get("temp_policy_info")->result();
  	}
  	
  
  	
  	public function check_this_lead_already_in_policy_info($lead_id)
  	{
  	    $this->db->where("lead_id",$lead_id);
  	    return $this->db->get("policy_info")->num_rows();
  	}
  	
  	public function check_this_policy_already_exits_in_temp($policy_no)
  	{
  	    $this->db->where("policy_no",$policy_no);
  	    return $this->db->get("temp_policy_info")->num_rows();
  	}
  	
  	public function check_this_policy_already_exits($policy_no)
  	{
  	    $this->db->where("policy_no",$policy_no);
  	    return $this->db->get("policy_info")->num_rows();
  	}
  	
  	public function get_client_id($lead_id)
  	{
  	    $this->db->where("id",$lead_id);
  	    return $this->db->get("list_of_leads")->row();
  	}
  	
  
  	public function delete_duplicate_clients($id)
  	{
  	      $this->db->where("id",$id);
	    $this->db->delete("list_of_clients");
  	}
  	
  	public function delete_duplicate_leads($id)
  	{
  	     $this->db->where("id",$id);
	    $this->db->delete("list_of_leads");
  	}
  	
  	public function check_policy_this_no_already_exits($policy_no)
    {
       $this->db->where("policy_no",$policy_no);
       $res = $this->db->get("policy_info")->num_rows();
       if($res > 0)
       {
           return true;
       }
       else
       {
           return false;
       }
   }
   
   public function check_lead_id_already_exits_in_policy($lead_id)
   {
       $this->db->where("lead_id",$lead_id);
       $res =  $this->db->get("policy_info")->num_rows();
       if($res > 0)
       {
           return true;
       }
       else
       {
           return false;
       }
   }
   	public function fetch_areaincharge()
  	{
  	     $this->db->where("role","AI");
  	    return $this->db->get("admin_login")->result();
  	}
  	
  	public function fetch_sme_policy_details($sme_id)
  	{
  	     $this->db->where("policy_class","10");
  	    return $this->db->get("list_of_policy_type")->result();
  	}
  	// Sme
  	public function add_sme_maraine_details($data)
  	{
  	    $this->db->insert("sme_marine_details",$data);
  	    return $this->db->insert_id();
  	}
  	
  	public function add_sme_fire_and_burgulary($data)
  	{
  	    $this->db->insert("sme_fire_and_burgulary",$data);
  	    return $this->db->insert_id();
  	}
  public function add_workman_compensation_details($data)
    {
        $this->db->insert("sme_workman_compensation",$data);
        return true;
    }
    
    public function add_gmc_details($data)
    {
         $this->db->insert("sme_gmc_details",$data);
         return true;
    }
    
    public function add_sme_files($data)
    {
        $this->db->insert("sme_quote_files",$data);
        return true;
    }
    
    public function fetch_quote_files($lead_id)
    {
        $this->db->where("lead_id",$lead_id);
        return $this->db->get("sme_quote_files")->result();
    }
    
     
    public function fetch_vechi_regn_no_already_exits($v_regn_no)
    {
        $this->db->where("vechi_register_no",$v_regn_no);
        return $this->db->get("vechile_details")->num_rows();
        
    } 
    
    public function check_regn_no_exits_by_lead_id($v_regn_no,$id)
    {
         $this->db->where("vechi_register_no",$v_regn_no);
        $this->db->where("lead_id !=",$id);
        $this->db->where("lead_id not in (select parent_lead_id from list_of_leads where id = {$id})", NULL);
        return $this->db->get("vechile_details")->num_rows();
    }
    
    public function check_regn_no_exits($v_regn_no,$id)
    {
        $this->db->where("vechi_register_no",$v_regn_no);
        $this->db->where("id !=",$id);
        $this->db->where("lead_id not in (select parent_lead_id from list_of_leads l,vechile_details v where l.id = v.lead_id and v.id = {$id})",NULL);
        return $this->db->get("vechile_details")->num_rows();
    } 
    
    
    
    
    public function get_total_premium($lead_id)
    {
        $this->db->where("lead_id",$lead_id);
        return $this->db->get("temp_policy_info")->row();
    }
    
    public function save_policy_data($lead_id)
  	{
  	       $this->db->query('INSERT INTO policy_info(lead_id,policy_client_ref_no,insurer,policy_cover_note_no,policy_no,policy_s_date,policy_ex_date,policy_premium,policy_terms,payment_frequency,next_due_date,renewable_flag,add_ons_opted,add_ons_not_opt,lead_type,sum_insured,discount_percent,no_claim_bonus,no_claim_bonus_val,total_own_damage,tot_add_on_premium,commisson_base_premium,basic_tp,owner_driver_pa,owner_diver_amt,no_of_year_own_drv,fuel_kit,fuel_kit_amt,geograpical,geograpical_amt,un_named_passenger_pa,un_named_passenger_amt,no_seats_per_person,no_seats_per_person_amt,LL_paid,LL_paid_amt,no_drv_emp,pa_paid_drv,pa_paid_drv_amt,no_seats_per_person1,no_seats_per_person_amt1,tot_liability_premium,total_premium,agent_commission_amt,own_commission_amt,com_add_com,agn_add_com,gst,premium_gst,policy_issue_date,policy_agency_pos,policy_source,policy_user,policy_location,previous_policy_no,previous_insurer,previous_insurance_plan,previous_agency_pos,previous_source,dectable_details,policy_additional_info,reference_no,other_reference_no,policy_received,policy_verified,policy_verified_info,policy_cancelled,policy_cancelled_info,commisson_generation,state,company,rto,commission_type,age,category,vehicle_classification,commission_id,com_trigger_status,com_trigger_date,payment_type,pay_ref_no,bank_name,payment_check_date,payment_and_check_no,remarks,payment_collected_date,status)
                     SELECT lead_id,policy_client_ref_no,insurer,policy_cover_note_no,policy_no,policy_s_date,policy_ex_date,policy_premium,policy_terms,payment_frequency,next_due_date,renewable_flag,add_ons_opted,add_ons_not_opt,lead_type,sum_insured,discount_percent,no_claim_bonus,no_claim_bonus_val,total_own_damage,tot_add_on_premium,commisson_base_premium,basic_tp,owner_driver_pa,owner_diver_amt,no_of_year_own_drv,fuel_kit,fuel_kit_amt,geograpical,geograpical_amt,un_named_passenger_pa,un_named_passenger_amt,no_seats_per_person,no_seats_per_person_amt,LL_paid,LL_paid_amt,no_drv_emp,pa_paid_drv,pa_paid_drv_amt,no_seats_per_person1,no_seats_per_person_amt1,tot_liability_premium,total_premium,agent_commission_amt,own_commission_amt,com_add_com,agn_add_com,gst,premium_gst,policy_issue_date,policy_agency_pos,policy_source,policy_user,policy_location,previous_policy_no,previous_insurer,previous_insurance_plan,previous_agency_pos,previous_source,dectable_details,policy_additional_info,reference_no,other_reference_no,policy_received,policy_verified,policy_verified_info,policy_cancelled,policy_cancelled_info,commisson_generation,state,company,rto,commission_type,age,category,vehicle_classification,commission_id,com_trigger_status,com_trigger_date,payment_type,pay_ref_no,bank_name,payment_check_date,payment_and_check_no,remarks,payment_collected_date,status from temp_policy_info Where lead_id = '.$lead_id.'');
                     return true;
  	}
  	
  	public function update_sme_commission($data,$lead_id)
  	{
  	    $this->db->where("lead_id",$lead_id);
  	    $this->db->update("policy_info",$data);
  	    return true;
  	}
    
    //SME
  	public function make_generate_policy_sme($session_id)
	{
      	$this->db->select("list_of_leads.id as c_lead_id,policy_info.id,policy_info.own_commission_amt,policy_info.agent_commission_amt,policy_info.tot_liability_premium,policy_info.no_claim_bonus,policy_info.commission_id,policy_info.policy_agency_pos,list_of_leads.business_type,policy_info.policy_premium,list_of_leads.class,policy_info.company,policy_info.gst,policy_info.policy_s_date,policy_info.policy_ex_date,list_of_premium_cover_type.name as policy_premium_name,type_of_bussiness.bussiness_type as business_name,list_of_class.class as class_name,list_of_policy_type.policy_type,policy_info.total_own_damage,policy_info.basic_tp,policy_info.total_premium,policy_info.policy_no,policy_info.ai_com,policy_info.sub_agn_1,policy_info.sub_agn_2,policy_info.sub_agn_amt_1,policy_info.sub_agn_amt_2,list_of_clients.client_name,list_of_clients.mobile_no,list_of_pos_and_agents.agent_pos_code,list_of_insurance_company.company_name,list_of_insurance_company.short_name as ins_short_name");
      	$this->db->join("list_of_leads","policy_info.lead_id = list_of_leads.id");
  	    $this->db->join("list_of_clients","list_of_leads.client_id = list_of_clients.id");
  	    $this->db->join("list_of_pos_and_agents","policy_info.policy_agency_pos = list_of_pos_and_agents.id");
  	    $this->db->join("list_of_insurance_company","policy_info.company = list_of_insurance_company.id");
  	    $this->db->join("type_of_bussiness","list_of_leads.business_type = type_of_bussiness.id");
  	    $this->db->join("list_of_class","list_of_leads.class = list_of_class.id");
  	    $this->db->join("list_of_policy_type","list_of_leads.policy_type = list_of_policy_type.id");
  	    $this->db->join("list_of_premium_cover_type","policy_info.policy_premium = list_of_premium_cover_type.id",'left');
  	    
      	if(isset($_POST['search']['value']) && $_POST['search']['value'] != "")
      	{
    		$this->db->where("(client_name LIKE '%".$_POST['search']['value']."%' OR mobile_no LIKE '%".$_POST['search']['value']."%' OR agent_pos_code LIKE '%".$_POST['search']['value']."%' OR policy_no LIKE '%".$_POST['search']['value']."%' OR list_of_insurance_company.company_name LIKE '%".$_POST['search']['value']."%' OR type_of_bussiness.bussiness_type LIKE '%".$_POST['search']['value']."%' OR list_of_class.class LIKE '%".$_POST['search']['value']."%' OR list_of_policy_type.policy_type LIKE '%".$_POST['search']['value']."%' OR list_of_premium_cover_type.name LIKE '%".$_POST['search']['value']."%')", NULL, FALSE);	    
      	}
      	if($this->session->userdata("session_role") == "user")
      	{
      	    $this->db->where("list_of_leads.assigned_user", $this->session->userdata("session_id"));
      	}
      	else if($this->session->userdata("session_role") == "AI")
      	{
      	    $this->db->where("list_of_leads.area_incharge", $this->session->userdata("session_id"));
      	}
      	$this->db->where("list_of_leads.class","10");
	}
	
  	public function fetch_generate_policy_sme($session_id)
  	{
  	    $this->make_generate_policy_sme($session_id);
  	    if($_POST['length'] != -1)
      	{
        	$this->db->limit($_POST['length'],$_POST['start']);
      	}
  	    return $this->db->get("policy_info")->result();
  	}
  	
  	public function get_filtered_generate_policy_count_sme($session_id)
	{
      	$this->make_generate_policy_sme($session_id);
      	$res = $this->db->get("policy_info");
      	return $res->num_rows();
	}
	
	public function get_all_generate_policy_count_sme($session_id)
	{
      	$this->db->select("*");
      	$this->db->join("list_of_leads","policy_info.lead_id = list_of_leads.id");
  	    $this->db->join("list_of_clients","list_of_leads.client_id = list_of_clients.id");
  	    $this->db->join("list_of_pos_and_agents","policy_info.policy_agency_pos = list_of_pos_and_agents.id");
  	    $this->db->join("list_of_insurance_company","policy_info.company = list_of_insurance_company.id");
  	    $this->db->join("type_of_bussiness","list_of_leads.business_type = type_of_bussiness.id");
  	    $this->db->join("list_of_class","list_of_leads.class = list_of_class.id");
  	    $this->db->join("list_of_policy_type","list_of_leads.policy_type = list_of_policy_type.id");
  	    $this->db->join("list_of_premium_cover_type","policy_info.policy_premium = list_of_premium_cover_type.id");
  	    
  	   	if($this->session->userdata("session_role") == "user")
      	{
      	    $this->db->where("list_of_leads.assigned_user", $this->session->userdata("session_id"));
      	}
      	else if($this->session->userdata("session_role") == "AI")
      	{
      	    $this->db->where("list_of_leads.area_incharge", $this->session->userdata("session_id"));
      	}
      	$this->db->where("list_of_leads.class","10");
      	return $this->db->get('policy_info')->num_rows();
	}
    
   
    
    public function check_ac_policy_no_already_exits($policy_no)
    {
        $this->db->where("sub_id",$policy_no);
        return $this->db->get("acc_commission_ledger")->num_rows();
    }
    
    public function check_ac_policy_no_already_exits_orc($policy_no)
    {
        $this->db->where("sub_id",$policy_no);
        return $this->db->get("acc_commission_ledger_orc")->num_rows();
    }
    
     public function check_agn_policy_no_already_exits($policy_no)
    {
         $this->db->where("note","Own commission Debit");
        $this->db->or_where("note","Agent commission Credit");
        $this->db->where("sub_id",$policy_no);
        return $this->db->get("acc_commission_ledger")->num_rows();
    }
    
    public function check_agn_policy_no_already_exits_orc($policy_no)
    {
        $this->db->where("note","Own commission Debit");
        $this->db->or_where("note","Agent commission Credit");
        $this->db->where("sub_id",$policy_no);
        return $this->db->get("acc_commission_ledger_orc")->num_rows();
    }
    
    public function add_acc_own_commission($data)
    {
        if($this->db->insert("acc_commission_ledger",$data)){
            return true;
        }
        
        return false;
    }
    
    public function add_acc_own_commission_orc($data)
    {
        if($this->db->insert("acc_commission_ledger_orc",$data)){
            return true;
        }
        
        return false;
    }
    
    public function check_sr_no_already_exits($new_sr_no)
    {
        $this->db->where("sr_no",$new_sr_no);
  		$num = $this->db->get("acc_commission_ledger")->num_rows();
  		if($num > 0)
  		{
  		    return true;
  		}
  		else
  		{
  		    return false;
  		}
    }
    
    public function fetch_insurance_company_ledger_main($id)
    {
        $this->db->where("insurer_id",$id);
  		return $this->db->get("account_tree")->row();
    }
    
    public function fetch_insurance_company_ledger_orc($id)
    {
        $this->db->where("insurer_id",$id);
  		return $this->db->get("account_tree_orc")->row();
    }
    
    
    public function get_all_policy_details()
    {
        $this->db->limit("50");
        $this->db->where("commission_id !=","");
        $this->db->where("own_commission_amt !=","");
  		return $this->db->get("policy_info")->result();
    }
    
    public function fetch_policy_informations($lead_id)
    {
        $this->db->where("lead_id",$lead_id);
        return $this->db->get("temp_policy_info")->row();
    }
    
    public function check_spl_commission_for_agent($com_id,$agent_id)
    {
        $this->db->where("commission_id",$com_id);
        $this->db->where("agent_id",$agent_id);
        return $this->db->get("agent_special_com")->row();
    }
    
    public function add_due_date($id,$data)
    {
       $this->db->where("id",$id);
       if($this->db->update("list_of_leads",$data)){
           return true;
       }
       
       return false;
    }
    
  	public function fetch_vechile_number_check($v_regn_number)
	{
	   $this->db->where("vechi_register_no",$v_regn_number);
	   return $this->db->get("vechile_details")->row();
	}
	
		public function add_client_details_temp_lead($data)
	{
	    $this->db->insert("list_of_clients",$data);
	    return $this->db->insert_id();
	    
	}
	
	public function add_temp_lead_details($data)
	{
	   $this->db->insert("list_of_leads",$data);
	   return $this->db->insert_id();
	}
	
	public function add_temp_vechicle_regn_no($data)
	{
	   $this->db->insert("vechile_details",$data);
	   return $this->db->insert_id();
	}
	
	public function fetch_temp_lead($lead_type,$classification,$search,$search_vechicle)
  	{
  	    $this->fetch_temp_leads_query($lead_type,$classification,$search);
  	    
  	    if(isset($_POST['length']) && $_POST['length'] != -1)
      	{
        	$this->db->limit($_POST['length'],$_POST['start']);
      	}
      	$this->db->join("list_of_clients","list_of_leads.client_id = list_of_clients.id");
  	    $this->db->join("type_of_bussiness","list_of_leads.business_type = type_of_bussiness.id","left");
  	    $this->db->join("list_of_class","list_of_leads.class = list_of_class.id");
  	    $this->db->join("list_of_policy_type","list_of_leads.policy_type = list_of_policy_type.id");
  	    $this->db->join("admin_login","list_of_leads.assigned_user = admin_login.id",'left');
  	    
  	    //$this->db->where("list_of_leads.due_date >=",date("Y-m-d"));
  	    
  	    if( isset( $search_vechicle ) && !empty( $search_vechicle ) ) {
  	        $this->db->where("list_of_leads.id in (select lead_id from vechile_details where lower(vechi_register_no) like '%".strtolower($search_vechicle)."%')", NULL, false);
  	    }
  	    
  	    if($this->session->userdata('session_role') == "user")
  	    {
  	        $this->db->where("list_of_leads.assigned_user",$this->session->userdata('session_id'));
  	    }
  	    
  	    if($this->session->userdata('session_role') == "AI")
  	    {
  	        $this->db->where("list_of_leads.area_incharge",$this->session->userdata('session_id'));
  	    }
  	  
  	        $this->db->order_by("list_of_leads.due_date","DESC");
  	    
  	    return $this->db->get("list_of_leads")->result();
  	}
  	
  	
  		public function fetch_temp_leads_query($lead_type,$classification,$search)
  	{
      	    $this->db->select("list_of_leads.*,list_of_clients.client_name,list_of_clients.mobile_no,list_of_clients.other_contact_details,list_of_clients.landline_no,list_of_clients.address,list_of_clients.contact_person_name,list_of_clients.area,type_of_bussiness.bussiness_type as b_type,list_of_class.class as lclass,list_of_policy_type.policy_type as p_type");
      	 
            if(isset($_POST['search']['value']) && $_POST['search']['value'] != "")
            {
               $this->db->where("(list_of_clients.client_name LIKE '%".$_POST['search']['value']."%' OR list_of_clients.mobile_no LIKE '%".$_POST['search']['value']."%' OR list_of_clients.other_contact_details LIKE '%".$_POST['search']['value']."%' OR list_of_clients.landline_no LIKE '%".$_POST['search']['value']."%'  OR list_of_clients.date_of_birth LIKE '%".$_POST['search']['value']."%' OR list_of_clients.age LIKE '%".$_POST['search']['value']."%' OR list_of_clients.area LIKE '%".$_POST['search']['value']."%'  OR list_of_leads.location LIKE '%".$_POST['search']['value']."%' OR list_of_leads.lead_generated_date LIKE '%".$_POST['search']['value']."%' OR list_of_clients.address LIKE '%".$_POST['search']['value']."%' OR list_of_clients.email LIKE '%".$_POST['search']['value']."%' OR type_of_bussiness.bussiness_type LIKE '%".$_POST['search']['value']."%' OR list_of_clients.contact_person_name LIKE '%".$_POST['search']['value']."%' OR list_of_policy_type.policy_type LIKE '%".$_POST['search']['value']."%'  OR list_of_class.class LIKE '%".$_POST['search']['value']."%' OR list_of_clients.contact_person_designation LIKE '%".$_POST['search']['value']."%')", NULL, FALSE);	    
            }
            
            if($search == "")
            {
                $this->db->where("list_of_leads.lead_type", $lead_type);

          
                 $this->db->where("(list_of_clients.client_name LIKE '%".$search."%' OR list_of_clients.mobile_no LIKE '%".$search."%' OR list_of_clients.other_contact_details LIKE '%".$search."%' OR list_of_clients.landline_no LIKE '%".$search."%'  OR list_of_clients.date_of_birth LIKE '%".$search."%' OR list_of_clients.age LIKE '%".$search."%' OR list_of_clients.area LIKE '%".$search."%'  OR list_of_leads.location LIKE '%".$search."%' OR list_of_leads.lead_generated_date LIKE '%".$search."%' OR list_of_clients.address LIKE '%".$search."%' OR list_of_clients.email LIKE '%".$search."%' OR type_of_bussiness.bussiness_type LIKE '%".$search."%' OR list_of_clients.contact_person_name LIKE '%".$search."%' OR list_of_policy_type.policy_type LIKE '%".$search."%'  OR list_of_class.class LIKE '%".$search."%' OR list_of_clients.contact_person_designation LIKE '%".$search."%')", NULL, FALSE);	          	
                 $this->db->where("list_of_leads.lead_status !=","completed");
                 $this->db->where("list_of_leads.temp_status  !=","0");
                 $this->db->where("list_of_leads.temp_status","1");
            }
            
  	}
	
	public function get_policy_details_by_commission($commission_id, $fromdate, $todate)
	{
	    $this->db->where("commission_id",$commission_id);
	    $this->db->where("policy_issue_date between '".$fromdate."' and '".$todate."'");
	    return $this->db->get("policy_info")->result();
	    
	}
	
	public function spl_commission_for_agent($com_id,$agent_id, $policy_issue_date)
    {
        $this->db->where_in("commission_id",$com_id);
        $this->db->where("agent_id",$agent_id);
        $this->db->where("'{$policy_issue_date}' between from_date and to_date",NULL);
       
        return $this->db->get("agent_special_com")->row();
    }
	
	public function IsBilledPolicy($lead_id) {
        $this->db->where("lead_id",$lead_id);
        $this->db->where("vocher_status","0");
  	    return $this->db->get("policy_info")->num_rows();
    }
    
    public function IsCompanyBilledPolicy($lead_id) {
        $this->db->where("lead_id",$lead_id);
        $this->db->where("company_vocher_status","0");
  	    return $this->db->get("policy_info")->num_rows();
    }
    
    public function getAllUsers()
  	{
  	    $this->db->where("status",'active');
  	    $this->db->where("role !=","admin");
  	    $this->db->order_by('name', 'ASC');
  	    return $this->db->get("admin_login")->result();
  	}
  	
  	public function getMaxSRNo($type)
    {        	        
        $data = [];
        $sql = "select 
					COALESCE(max(cast(replace(SUBSTRING_INDEX(sr_no, '/', 2), '".$type."/', '') as unsigned)),0)+1 as new_sr_no
				from 
					acc_commission_ledger 
				where 
					left(sr_no,2) = '".$type."'";
       
        $Q = $this->db->query($sql);
        
        if( $Q->num_rows() > 0 ){
            $data = $Q->row_array();
        }
        $Q->free_result();
        return (isset($data['new_sr_no']) && !empty($data['new_sr_no'])) ? $data['new_sr_no'] : null;
    }
    
    public function getVechicleInfo($id)
  	{
  	    $this->db->where("lead_id",$id);
  	    return $this->db->get("vechile_details")->row_array();
  	}
  	
  	public function getRenewalLeadDetails($id)
  	{
  	    $this->db->select("list_of_leads.*,list_of_clients.client_type_id,list_of_clients.client_name,list_of_clients.mobile_no,list_of_clients.other_contact_details,list_of_clients.landline_no,list_of_clients.address,list_of_clients.email,list_of_clients.contact_person_name,list_of_clients.contact_person_designation,list_of_clients.date_of_birth,list_of_clients.age,list_of_clients.area,vechile_details.vechi_register_no,temp_policy_info.policy_ex_date");
  	    $this->db->from("list_of_leads");
  	    $this->db->join("list_of_clients","list_of_leads.client_id = list_of_clients.id");
  	    $this->db->join("vechile_details","vechile_details.lead_id = list_of_leads.id",'left');
  	    $this->db->join("temp_policy_info","temp_policy_info.lead_id = list_of_leads.id",'left');
  	    $this->db->where("list_of_leads.id",$id);
		// $this->db->group_start();
		// $this->db->where('policy_ex_date >=', date("Y-m-d"));
		// $this->db->where('policy_ex_date <=', date('Y-m-d', strtotime(date('Y-m-d').'+1 months')));
		// $this->db->or_where('policy_ex_date <', date("Y-m-d"));
		// $this->db->group_end();
  	    return $this->db->get()->row();
  	}
  	
  	public function IsRenewaledLead($id)
  	{
  	    $this->db->select("list_of_leads.*");
  	    $this->db->from("list_of_leads");
  	    $this->db->where("list_of_leads.parent_lead_id",$id);
  	    return $this->db->get()->row();
  	}
  	
  	public function get_policy_expirydate($lead_id)
	{
		$this->db->select('parent_lead_id, (select policy_ex_date from policy_info where lead_id = parent_lead_id) as policy_ex_date');		
		$this->db->where("id",$lead_id);
		return $this->db->get("list_of_leads")->row();
	}

	// 2023-06-01 start
	public function getVechicleAge($lead_id, $date){		
		$this->db->select("(date_format(date('".$date."'),'%Y') - vechi_manu_year) as age");
		$this->db->where("lead_id", $lead_id);
		return $this->db->get("vechile_details")->row();
	}
    
    public function getSplCommissionByAgent($commission_id, $agent_id, $policy_issue_date)
    {        
        $this->db->where("commission_id",$commission_id);
        $this->db->where("agent_id",$agent_id);
        $this->db->where("special_com != ''",NULL);
        $this->db->where("'{$policy_issue_date}' between from_date and to_date",NULL);
       
        return $this->db->get("agent_special_com")->row();
    }
    
    // start 2023-08-17
	public function check_renewal_commission($com_id, $type)
    {
		$this->db->where_in("id",$com_id);        
        $this->db->where("payout_type", $type);
               
        return $this->db->get("company_payout_commission")->row();
    }	
}