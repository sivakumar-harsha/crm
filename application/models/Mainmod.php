<?php  
class Mainmod extends CI_Model  
{  
  	function __construct()  
  	{ 
    	parent::__construct();  
    	$this->load->dbforge();
  	}
    public function database_cache_clear()
    {
        $this->db->cache_delete_all();
    }
    public function fetch_region_with_id($id)
    {
        $this->db->where("id", $id);
        $res = $this->db->get("list_of_reigion")->row();
        if($res != null)
        {
            return $res->reigion;
        }
        else
        {
            return "";    
        }
    }
    public function get_ai_regions($ai)
    {
        $this->db->where("ai_id", $ai);
        return $this->db->get("ai_regions")->result();
    }
    public function fetch_agents_row($agent)
    {
        $this->db->where("id", $agent);
        return $this->db->get("list_of_pos_and_agents")->row();
    }
    public function fetch_agents($user_id)
    {
        if($user_id != 1)
        {
            $this->db->where("user_id", $user_id);
        }
        $this->db->where("role", "agent");
        return $this->db->get("list_of_pos_and_agents")->result();
    }
    public function fetch_pos($user_id)
    {
        if($user_id != 1)
        {
            $this->db->where("user_id", $user_id);
        }
        $this->db->where("role", "pos");
        return $this->db->get("list_of_pos_and_agents")->result();
    }
    public function get_foe_with_regions($dis)
    {
        $this->db->where_in("district_id", $dis);
        return $this->db->get("user_district")->result();
    }
    public function get_district_with_regions($reg)
    {
        $this->db->where_in("id", $reg);
        return $this->db->get("list_of_reigion")->result();
    }
    public function fetch_area_incharge($region)
    {
        if($region != "admin")
        {
            $this->db->where("reigion_id", $region);
        }
        $this->db->where("role", "AI");
        $this->db->where("status","active");
        return $this->db->get("admin_login")->result();
    }
    public function fetch_region_using_user_id($user_id)
    {
        $this->db->where("id", $user_id);
        $res = $this->db->get("user_district")->row();
        if($res != null)
        {
           return $res->reigion_id;
        }
        else
        {
            return "";
        }
    }
    public function fetch_agents_user_name($user_id)
    {
        $this->db->where("id", $user_id);
        $this->db->where("status","active");
        $res = $this->db->get("admin_login")->row();
        if($res != null)
        {
           return $res->name;
        }
        else
        {
            return "";
        }
    }
    public function fetch_agents_ai_row($ai)
    {
         $this->db->where("id", $ai);
         $this->db->where("status","active");
        $res = $this->db->get("admin_login")->row();
    }
  	public function fetch_project_info()
  	{
  		return $this->db->get("project_info")->row();
  	}
  	public function fetch_total_policy($class_id,$from_date,$to_date,$agent)
  	{
  	    $this->db->where("list_of_leads.class", $class_id);
  	    $this->db->where("list_of_leads.agency_and_pos", $agent);
  	    
  	    if($from_date != "all")
        {
            $this->db->where("policy_info.policy_issue_date >=", $from_date);
        }
        if($to_date != "all")
        {
            $this->db->where("policy_info.policy_issue_date <=", $to_date);
        }
        
  	    $this->db->join("list_of_leads","list_of_leads.id = policy_info.lead_id");
  		return $this->db->get("policy_info")->result();
  	}
  	public function fetch_single_admin_login($email_id)
  	{
  		$this->db->where("email_id", $email_id);
  		$this->db->where("status","active");
  		return $this->db->get("admin_login")->row();
  	}
  	public function create_opt_log($data)
  	{
  	    $this->db->insert("admin_otp", $data);
  	}
  	public function check_otp($otp,$fp_email)
  	{
  	    $this->db->where("otp",$otp);
  	    $this->db->where("email_id",$fp_email);
        $res = $this->db->get("admin_otp");
        return $res->result();
  	}
  	public function update_password($data,$fp_email)
  	{
  	    $this->db->where("email_id",$fp_email);
  	    $this->db->update("admin_login",$data);
  	}
  	
  	public function fetch_today_followup_dashboard($user_id)
  	{
  	    $this->db->select("follow_up_details.next_follow_up_time,follow_up_details.reason,list_of_clients.client_name,list_of_leads.classfication,list_of_leads.lead_type");
  	    if($user_id != 1)
  	    {
  	        $this->db->where("list_of_leads.assigned_user",$user_id);
  	    }
  	    $this->db->where("list_of_leads.lead_status","followup");
  	    $this->db->where("follow_up_details.next_follow_up_date",date("Y-m-d"));
  	    $this->db->join("list_of_leads","list_of_leads.id = follow_up_details.lead_id");
  	    $this->db->join("list_of_clients","list_of_leads.client_id = list_of_clients.id");
  	    return $this->db->get("follow_up_details")->result();
  	}
    
    public function fetch_open_lead_count_dashboard($type,$user_id)
    {
        if($this->session->userdata("session_role") == "user")
  	    {
  	        $this->db->where("assigned_user",$user_id);
  	    }
  	    else if($this->session->userdata("session_role") == "AI")
  	    {
  	        $this->db->where("list_of_leads.area_incharge",$this->session->userdata("session_id"));
  	    }
  	    $this->db->where("due_date >=",date("Y-m-d"));
  	    $this->db->where("due_date <=", date('Y-m-d', strtotime("+30 days")));
        $this->db->where("lead_type !=",1);
        $this->db->where("policy_status !=","1");
        $this->db->where("lead_type !=","2");
        $this->db->where("lead_status",$type);
        return $this->db->get("list_of_leads")->num_rows();
    }
    
    public function fetch_open_new_lead_count_dashboard($type,$user_id)
    {
        if($this->session->userdata("session_role") == "user")
  	    {
  	        $this->db->where("assigned_user",$user_id);
  	    }
  	    else if($this->session->userdata("session_role") == "AI")
  	    {
  	        $this->db->where("list_of_leads.area_incharge",$this->session->userdata("session_id"));
  	    }
  	  //  $this->db->where("due_date","0000-00-00");
        $this->db->where("lead_type !=","1");
        $this->db->where("policy_status !=","1");
        $this->db->where("lead_type !=","2");
        $this->db->where("lead_status",$type);
        return $this->db->get("list_of_leads")->num_rows();
    }
    
    public function fetch_open_prospect_count_dashboard($type,$user_id)
    {
       if($this->session->userdata("session_role") == "user")
  	    {
  	        $this->db->where("assigned_user",$user_id);
  	    }
  	    else if($this->session->userdata("session_role") == "AI")
  	    {
  	        $this->db->where("area_incharge",$this->session->userdata("session_id"));
  	    }
        $this->db->where("business_type !=",1);
         $this->db->where("lead_type",1);
        $this->db->where("lead_status",$type);
         $this->db->where("list_of_leads.policy_status !=","1");
         $this->db->where("list_of_leads.lead_status !=","completed");
        return $this->db->get("list_of_leads")->num_rows();
    }
    
    public function fetch_open_prospect_renewal_count_dashboard($type,$user_id)
    {
        if($this->session->userdata("session_role") == "user")
  	    {
  	        $this->db->where("assigned_user",$user_id);
  	    }
  	    else if($this->session->userdata("session_role") == "AI")
  	    {
  	        $this->db->where("area_incharge",$this->session->userdata("session_id"));
  	    }
        $this->db->where("business_type",1);
        $this->db->where("lead_type",1);
        $this->db->where("lead_status",$type);
        $this->db->where("list_of_leads.policy_status !=","1");
        $this->db->where("list_of_leads.lead_status !=","completed");
        return $this->db->get("list_of_leads")->num_rows();
    }
    
    public function fetch_hot_count_dashboard($type,$from_date,$to_date,$user_id)
    {
        if($this->session->userdata("session_role") == "user")
  	    {
  	        $this->db->where("assigned_user",$user_id);
  	    }
  	    else if($this->session->userdata("session_role") == "AI")
  	    {
  	        $this->db->where("area_incharge",$this->session->userdata("session_id"));
  	    }
        if($from_date != "all" && $from_date != "Noduedate")
        {
            $this->db->where("due_date >=", $from_date);
        }
        if($to_date != "all" && $to_date != "Noduedate")
        {
            $this->db->where("due_date <=", $to_date);
        }
        
        if($from_date == "Noduedate" && $to_date == "Noduedate")
        {
             $this->db->where("due_date", "0000-00-00");
        }
         $this->db->where("lead_type",0);
         $this->db->where("classfication",1);
         $this->db->where("lead_status",$type);
         $this->db->where("list_of_leads.policy_status !=","1");
         $this->db->where("list_of_leads.lead_status !=","completed");
        return $this->db->get("list_of_leads")->num_rows();
    }
    
    public function fetch_hot_followup_count_dashboard($from_date,$to_date,$user_id)
    {
        if($user_id != 1)
  	    {
  	        $this->db->where("assigned_user",$user_id);
  	    }
         if($from_date != "all")
        {
            $this->db->where("due_date >=", $from_date);
        }
        if($to_date != "all")
        {
            $this->db->where("due_date <=", $to_date);
        }
        $this->db->where("classfication",1);
        $this->db->where("lead_status",$type);
        return $this->db->get("list_of_leads")->num_rows();
    }
    
    public function fetch_warm_count_dashboard($type,$from_date,$to_date,$user_id)
    {
        if($this->session->userdata("session_role") == "user")
  	    {
  	        $this->db->where("assigned_user",$user_id);
  	    }
  	    else if($this->session->userdata("session_role") == "AI")
  	    {
  	        $this->db->where("area_incharge",$this->session->userdata("session_id"));
  	    }
        if($from_date != "all" && $from_date != "Noduedate")
        {
            $this->db->where("created_date >=", $from_date);
        }
        if($to_date != "all" && $to_date != "Noduedate")
        {
            $this->db->where("created_date <=", $to_date);
        }
        if($from_date == "Noduedate" && $to_date == "Noduedate")
        {
             $this->db->where("due_date", "0000-00-00");
        }
         $this->db->where("lead_type",0);
        $this->db->where("classfication",2);
        $this->db->where("lead_status",$type);
         $this->db->where("list_of_leads.policy_status !=","1");
         $this->db->where("list_of_leads.lead_status !=","completed");
        return $this->db->get("list_of_leads")->num_rows();
    }
    
    public function fetch_cold_count_dashboard($type,$from_date,$to_date,$user_id)
    {
        if($this->session->userdata("session_role") == "user")
  	    {
  	        $this->db->where("assigned_user",$user_id);
  	    }
  	    else if($this->session->userdata("session_role") == "AI")
  	    {
  	        $this->db->where("area_incharge",$this->session->userdata("session_id"));
  	    }
        if($from_date != "all" && $from_date != "Noduedate")
        {
            $this->db->where("due_date >=", $from_date);
        }
        if($to_date != "all" && $to_date == "Noduedate")
        {
            $this->db->where("created_date <=", $to_date);
        }
        if($from_date == "Noduedate" && $to_date == "Noduedate")
        {
             $this->db->where("due_date", "0000-00-00");
        }
         $this->db->where("lead_type",0);
        $this->db->where("classfication",3);
        $this->db->where("lead_status",$type);
        $this->db->where("list_of_leads.policy_status !=","1");
        $this->db->where("list_of_leads.lead_status !=","completed");
        return $this->db->get("list_of_leads")->num_rows();
    }
    
    public function fetch_prospect_count_dashboard($type,$from_date,$to_date,$user_id)
    {
        if($this->session->userdata("session_role") == "user")
  	    {
  	        $this->db->where("assigned_user",$user_id);
  	    }
  	    else if($this->session->userdata("session_role") == "AI")
  	    {
  	        $this->db->where("area_incharge",$this->session->userdata("session_id"));
  	    }
        if($from_date != "all" && $from_date != "Noduedate")
        {
            $this->db->where("due_date >=", $from_date);
        }
        if($to_date != "all" && $to_date != "Noduedate")
        {
            $this->db->where("due_date <=", $to_date);
        }
        if($from_date == "Noduedate" && $to_date == "Noduedate")
        {
             $this->db->where("due_date", "0000-00-00");
        }
        $this->db->where("lead_type",1);
        $this->db->where("lead_status",$type);
        $this->db->where("list_of_leads.policy_status !=","1");
        $this->db->where("list_of_leads.lead_status !=","completed");
        return $this->db->get("list_of_leads")->num_rows();
    }
    
    public function fetch_completed_count_dashboard($from_date,$to_date,$user_id)
    {
        $this->db->select("policy_info.lead_id");
        $this->db->join("list_of_leads","policy_info.lead_id = list_of_leads.id");
        $this->db->join("list_of_clients","list_of_leads.client_id = list_of_clients.id");
        $this->db->join("list_of_pos_and_agents","policy_info.policy_agency_pos = list_of_pos_and_agents.id");
        $this->db->join("list_of_insurance_company","policy_info.company = list_of_insurance_company.id");
        $this->db->join("type_of_bussiness","list_of_leads.business_type = type_of_bussiness.id");
        $this->db->join("list_of_class","list_of_leads.class = list_of_class.id");
        $this->db->join("admin_login","admin_login.id = list_of_leads.area_incharge",'left');
        $this->db->join("list_of_policy_type","list_of_leads.policy_type = list_of_policy_type.id");
        $this->db->join("list_of_premium_cover_type","policy_info.policy_premium = list_of_premium_cover_type.id",'left');
        
        if($this->session->userdata("session_role") == "user")
        {
          $this->db->where("assigned_user",$user_id);
        }
        else if($this->session->userdata("session_role") == "AI")
        {
          $this->db->where("list_of_leads.area_incharge",$this->session->userdata("session_id"));
        }
        if($from_date != "all" && $from_date != "Noduedate")
        {
            $this->db->where("policy_info.policy_issue_date >=", $from_date);
        }
        if($to_date != "all" && $to_date == "Noduedate")
        {
           $this->db->where("policy_info.policy_issue_date <=", $to_date);
        }
        return $this->db->get("policy_info")->num_rows();

    }
    
    public function fetch_business_completed_count($from_date,$to_date,$user_id)
    {
        $this->db->select("temp_policy_info.lead_id");
      	$this->db->join("list_of_leads","temp_policy_info.lead_id = list_of_leads.id");
  	    $this->db->join("list_of_clients","list_of_leads.client_id = list_of_clients.id");
  	    $this->db->join("list_of_pos_and_agents","temp_policy_info.policy_agency_pos = list_of_pos_and_agents.id");
  	    $this->db->join("list_of_insurance_company","temp_policy_info.company = list_of_insurance_company.id");
  	    $this->db->join("type_of_bussiness","list_of_leads.business_type = type_of_bussiness.id");
  	    $this->db->join("list_of_class","list_of_leads.class = list_of_class.id");
  	    $this->db->join("list_of_policy_type","list_of_leads.policy_type = list_of_policy_type.id");
  	    $this->db->join("list_of_premium_cover_type","temp_policy_info.policy_premium = list_of_premium_cover_type.id",'left');
  	    $this->db->join("admin_login","admin_login.id = list_of_leads.area_incharge","left");
  	    $this->db->order_by("temp_policy_info.policy_issue_date","Asc");
  	    
  	    if($this->session->userdata("session_role") == "user")
  	    {
  	        $this->db->where("assigned_user",$user_id);
  	    }
  	    else if($this->session->userdata("session_role") == "AI")
  	    {
  	        $this->db->where("list_of_leads.area_incharge",$this->session->userdata("session_id"));
  	    }
        if($from_date != "all" && $from_date != "Noduedate")
        {
            $this->db->where("temp_policy_info.policy_issue_date >=", $from_date);
        }
        if($to_date != "all" && $to_date == "Noduedate")
        {
            $this->db->where("temp_policy_info.policy_issue_date <=", $to_date);
        }
  	    $this->db->where("list_of_leads.lead_type !=","2");
  	    return $this->db->get("temp_policy_info")->num_rows();
    }
    
    //prospect summary
    
    public function fetch_prospect_open_count_dashboard($type,$user_id,$from_date,$to_date)
    {
        if($this->session->userdata("session_role") == "user")
  	    {
  	        $this->db->where("assigned_user",$user_id);
  	    }
  	    else if($this->session->userdata("session_role") == "AI")
  	    {
  	        $this->db->where("area_incharge",$this->session->userdata("session_id"));
  	    }
        if($from_date != "all")
        {
            $this->db->where("created_date >=", $from_date);
        }
        if($to_date != "all")
        {
            $this->db->where("created_date <=", $to_date);
        }
        $this->db->where("business_type",$type);
        $this->db->where("lead_status","open");
        $this->db->where("lead_type",1);
        return $this->db->get("list_of_leads")->num_rows();
    }
    
    public function fetch_prospect_followup_count_dashboard($type,$user_id,$from_date,$to_date)
    {
        if($this->session->userdata("session_role") == "user")
  	    {
  	        $this->db->where("assigned_user",$user_id);
  	    }
  	    else if($this->session->userdata("session_role") == "AI")
  	    {
  	        $this->db->where("area_incharge",$this->session->userdata("session_id"));
  	    }
        if($from_date != "all")
        {
            $this->db->where("list_of_leads.next_follow_up_date >=", $from_date);
        }
        if($to_date != "all")
        {
            $this->db->where("list_of_leads.next_follow_up_date <=", $to_date);
        }
        $this->db->where("list_of_leads.business_type",$type);
        $this->db->where("lead_status","followup");
        $this->db->where("list_of_leads.lead_type",1);
        //$this->db->join("follow_up_details","follow_up_details.lead_id = list_of_leads.id");
        return $this->db->get("list_of_leads")->num_rows();
    }
    
    public function fetch_prospect_complete_count_dashboard($type,$user_id,$from_date,$to_date)
    {
        $this->db->select("policy_info.id");
      	$this->db->join("list_of_leads","policy_info.lead_id = list_of_leads.id");
  	    $this->db->join("list_of_clients","list_of_leads.client_id = list_of_clients.id");
  	    $this->db->join("list_of_pos_and_agents","policy_info.policy_agency_pos = list_of_pos_and_agents.id");
  	    $this->db->join("list_of_insurance_company","policy_info.company = list_of_insurance_company.id");
  	    $this->db->join("type_of_bussiness","list_of_leads.business_type = type_of_bussiness.id");
  	    $this->db->join("list_of_class","list_of_leads.class = list_of_class.id");
  	     $this->db->join("admin_login","admin_login.id = list_of_leads.area_incharge",'left');
  	    $this->db->join("list_of_policy_type","list_of_leads.policy_type = list_of_policy_type.id");
  	    $this->db->join("list_of_premium_cover_type","policy_info.policy_premium = list_of_premium_cover_type.id",'left');
  	    
  	   if($this->session->userdata("session_role") == "user")
  	    {
  	        $this->db->where("list_of_leads.assigned_user",$user_id);
  	    }
  	    else if($this->session->userdata("session_role") == "AI")
  	    {
  	        $this->db->where("policy_info.area_incharge",$this->session->userdata("session_id"));
  	    }
        if($from_date != "all")
        {
            $this->db->where("policy_info.policy_issue_date >=", $from_date);
        }
        if($to_date != "all")
        {
            $this->db->where("policy_info.policy_issue_date <=", $to_date);
        }
        
        $this->db->where("list_of_leads.business_type",$type);
        $this->db->where("list_of_leads.lead_type","2");
  	    return $this->db->get("policy_info")->num_rows();
    }
    
    public function fetch_prospect_lost_count_dashboard($type,$user_id,$from_date,$to_date)
    {
        if($this->session->userdata("session_role") == "user")
  	    {
  	        $this->db->where("assigned_user",$user_id);
  	    }
  	    else if($this->session->userdata("session_role") == "AI")
  	    {
  	        $this->db->where("area_incharge",$this->session->userdata("session_id"));
  	    }
        if($from_date != "all")
        {
            $this->db->where("list_of_leads.created_date >=", $from_date);
        }
        if($to_date != "all")
        {
            $this->db->where("list_of_leads.created_date <=", $to_date);
        }
        $this->db->where("list_of_leads.business_type",$type);
        $this->db->where("lead_status","lost");
        $this->db->where("list_of_leads.lead_type",1);
        //$this->db->join("follow_up_details","follow_up_details.lead_id = list_of_leads.id");
        return $this->db->get("list_of_leads")->num_rows();
    }
    
    public function fetch_active_policy_count_dashboard($user_id)
    {
        if($this->session->userdata("session_role") == "user")
  	    {
  	        $this->db->where("list_of_leads.assigned_user",$user_id);
  	    }
  	    else if($this->session->userdata("session_role") == "AI")
  	    {
  	        $this->db->where("list_of_leads.area_incharge",$this->session->userdata("session_id"));
  	    }
     
        $this->db->join("list_of_leads","list_of_leads.id = policy_info.lead_id");
         return $this->db->get("policy_info")->num_rows();
    }
    
    public function fetch_prospect_policy_count_dashboard($type,$user_id,$from_date,$to_date)
    {
  	    $this->db->select("temp_policy_info.id");
      	$this->db->join("list_of_leads","temp_policy_info.lead_id = list_of_leads.id");
  	    $this->db->join("list_of_clients","list_of_leads.client_id = list_of_clients.id");
  	    $this->db->join("list_of_pos_and_agents","temp_policy_info.policy_agency_pos = list_of_pos_and_agents.id");
  	    $this->db->join("list_of_insurance_company","temp_policy_info.company = list_of_insurance_company.id");
  	    $this->db->join("type_of_bussiness","list_of_leads.business_type = type_of_bussiness.id");
  	    $this->db->join("list_of_class","list_of_leads.class = list_of_class.id");
  	    $this->db->join("list_of_policy_type","list_of_leads.policy_type = list_of_policy_type.id");
  	    $this->db->join("list_of_premium_cover_type","temp_policy_info.policy_premium = list_of_premium_cover_type.id",'left');
  	    
  	    if($this->session->userdata("session_role") == "user")
  	    {
  	        $this->db->where("list_of_leads.assigned_user",$user_id);
  	    }
  	    else if($this->session->userdata("session_role") == "AI")
  	    {
  	        $this->db->where("list_of_leads.area_incharge",$this->session->userdata("session_id"));
  	    }

        if($from_date != "all")
        {
            $this->db->where("temp_policy_info.policy_issue_date >=", $from_date);
        }
        if($to_date != "all")
        {
            $this->db->where("temp_policy_info.policy_issue_date <=", $to_date);
        }
        $this->db->where("list_of_leads.business_type",$type);
  	    //$this->db->where("list_of_leads.policy_status","1");
  	    $this->db->where("list_of_leads.lead_type !=","2");
  	    return $this->db->get("temp_policy_info")->num_rows();
    }
    
    
     public function fetch_policy_quote_count_dashboard($type,$user_id,$from_date,$to_date)
    {
         if($this->session->userdata("session_role") == "user")
  	    {
  	        $this->db->where("list_of_leads.assigned_user",$user_id);
  	    }
  	    else if($this->session->userdata("session_role") == "AI")
  	    {
  	        $this->db->where("list_of_leads.area_incharge",$this->session->userdata("session_id"));
  	    }
        if($from_date != "all")
        {
            $this->db->where("list_of_leads.created_date >=", $from_date);
        }
        if($to_date != "all")
        {
            $this->db->where("list_of_leads.created_date <=", $to_date);
        }
        $this->db->where("list_of_leads.business_type",$type);
         
         $this->db->where("list_of_leads.quote_status","1");
         $this->db->where("list_of_leads.policy_status !=","1");
         $this->db->where("list_of_leads.lead_status !=","completed");
         return $this->db->get("list_of_leads")->num_rows();
    }
    
  	public function make_blogs_query()
	{
      $this->db->select('bl.*,bl.id as bl_id,lg.name as lg_name, tp.name as tp_name');
      $this->db->from("blog as bl");
      $this->db->join("language as lg","lg.id = bl.language");
      $this->db->join("topic as tp","tp.id = bl.topic");
      if(isset($_GET['search']['value']))
      {
          $this->db->like("bl.title_of_blog",$_GET['search']['value']);
          $this->db->or_like("lg.name",$_GET['search']['value']);
          $this->db->or_like("tp.name",$_GET['search']['value']);
      }
	}
	  
	public function fetch_blogs()
	{
      $this->make_blogs_query();
      if($_GET['length'] != -1)
      {
          $this->db->limit($_GET['length'],$_GET['start']);
      }
      $query = $this->db->get();
      return $query->result();
	}
	public function get_filtered_blogs()
	{
      $this->make_blogs_query();
      $res = $this->db->get();
      return $res->num_rows();
	}
	public function get_all_blogs()
	{
      $this->db->select("*");
      $this->db->from('blog');
      return $this->db->get()->num_rows();
	}
	public function get_client_name($id)
	{
	    $this->db->where("id",$id);
	    $res = $this->db->get("list_of_clients")->row();
	    if($res != null)
	    {
	        return $res->client_name;
	    }
	    else
	    {
	        return "";
	    }
	}
	public function get_agent_with_ai($area_incharge)
	{
	     $this->db->where("area_incharge",$area_incharge);
	    return $this->db->get("list_of_pos_and_agents")->result();
	}
	public function get_user_name($id)
	{
	    if($id == "all" || $id == "" || $id == "1")
	    {
	        return "All";
	    }
	    else
	    {
	        $this->db->where("id",$id);
	        $this->db->where("status","active");
	        $res = $this->db->get("admin_login")->row();
    	    if($res != null)
    	    {
    	        return $res->name;
    	    }
    	    else
    	    {
    	        return "All";
    	    }
	    }
	}
    public function fetch_prospect_dashboard($user_id,$from_date,$to_date)
    {
        if($this->session->userdata("session_role") == "user")
        {
            $this->db->where("assigned_user",$user_id);
        }
        else if($this->session->userdata("session_role") == "AI")
        {
             $this->db->where("area_incharge",$this->session->userdata("session_id"));
        }
        
        if($from_date != "all")
        {
            $this->db->where("due_date >=", $from_date);
        }
        
        if($to_date != "all")
        {
            $this->db->where("due_date <=", $to_date);
            $this->db->where("due_date !=", "0000-00-00");
        }
        return $this->db->get("list_of_leads")->result();
    }	
    public function fetch_class_name($id)
    {
        $this->db->where("id",$id);
        $res = $this->db->get("list_of_class")->row();
        if($res != null)
        {
            return $res->class;
        }
        else
        {
            return "";
        }
    }
    public function fetch_vehicle_number($id)
    {
        $this->db->where("lead_id",$id);
        $res = $this->db->get("vechile_details")->row();
        if($res != null)
        {
            return $res->vechi_register_no;
        }
        else
        {
            return "";
        }
    }
    public function load_staff($user_id)
    {
        $this->db->select("admin_login.id,admin_login.name");
        if($user_id != 1)
        {
            $this->db->where("admin_login.id",$user_id);
        }
        $this->db->where("admin_login.role","user");
        $this->db->where("admin_login.status","active");
        $this->db->group_by('admin_login.id');
        $this->db->join("list_of_leads","list_of_leads.assigned_user = admin_login.id");
        $res = $this->db->get("admin_login")->result();
        return $res;
    }
    public function load_ai($ai_id)
    {
        $this->db->select("admin_login.id,admin_login.name");
        $this->db->where("admin_login.role","AI");
        $this->db->where("admin_login.status","active");
        if($ai_id != "")
        {
            $this->db->where("admin_login.id",$ai_id);
        }
        $this->db->group_by('admin_login.id');
        $this->db->join("list_of_leads","list_of_leads.area_incharge = admin_login.id");
        $res = $this->db->get("admin_login")->result();
        return $res;
    }
    public function get_area_incharge($region_id)
    {
        if($region_id != null)
        {
            $this->db->select("admin_login.*");
            $this->db->from("admin_login");
            $this->db->join("ai_regions","ai_regions.ai_id = admin_login.id");
            $this->db->join("list_of_leads","list_of_leads.area_incharge = admin_login.id");
            $this->db->where_in("ai_regions.region_id",$region_id);
            $this->db->group_by('admin_login.id');
            return $this->db->get()->result();
        }
        else
        {
            return array();
        }
    }
    public function ai_open_count($id,$from_date,$to_date)
    {
        $this->db->where("area_incharge",$id);
        $this->db->where("lead_status","open");
        
        if($from_date != "all" && $from_date != "Noduedate")
        {
            $this->db->where("due_date >=", $from_date);
        }
        if($to_date != "all" && $to_date != "Noduedate")
        {
            $this->db->where("due_date <=", $to_date);
        }
        if($from_date == "Noduedate" && $from_date == "Noduedate")
        {
            $this->db->where("due_date", "0000-00-00");
        }
         $this->db->where("list_of_leads.policy_status !=","1");
         $this->db->where("list_of_leads.lead_status !=","completed");
        return $this->db->get("list_of_leads")->num_rows();
    }
    public function ai_followup_count($id,$from_date,$to_date)
    {
        $this->db->where("list_of_leads.area_incharge",$id);
        $this->db->where("lead_status","followup");
        
        if($from_date != "all" && $from_date != "Noduedate")
        {
            $this->db->where("list_of_leads.next_follow_up_date >=", $from_date);
        }
        if($to_date != "all" && $to_date != "Noduedate")
        {
            $this->db->where("list_of_leads.next_follow_up_date <=", $to_date);
        }
        $this->db->where("list_of_leads.policy_status !=","1");
        $this->db->where("list_of_leads.lead_status !=","completed");
         return $this->db->get("list_of_leads")->num_rows();
    }
    
    
    public function ai_completed_count($id,$from_date,$to_date)
    {
         $this->db->select("policy_info.id");
      	$this->db->join("list_of_leads","policy_info.lead_id = list_of_leads.id");
  	    $this->db->join("list_of_clients","list_of_leads.client_id = list_of_clients.id");
  	    $this->db->join("list_of_pos_and_agents","policy_info.policy_agency_pos = list_of_pos_and_agents.id");
  	    $this->db->join("list_of_insurance_company","policy_info.company = list_of_insurance_company.id");
  	    $this->db->join("type_of_bussiness","list_of_leads.business_type = type_of_bussiness.id");
  	    $this->db->join("list_of_class","list_of_leads.class = list_of_class.id");
  	     $this->db->join("admin_login","admin_login.id = list_of_leads.area_incharge",'left');
  	    $this->db->join("list_of_policy_type","list_of_leads.policy_type = list_of_policy_type.id");
  	    $this->db->join("list_of_premium_cover_type","policy_info.policy_premium = list_of_premium_cover_type.id",'left');
  	    
  	    if($from_date != "all" && $from_date != "Noduedate")
        {
          $this->db->where("policy_info.policy_issue_date >=",$from_date);
        }
        if($to_date != "all" && $to_date != "Noduedate")
        {
          $this->db->where("policy_info.policy_issue_date <=",$to_date);
        }
  	    //$this->db->where("policy_info.policy_ex_date >",date("Y-m-d"));
  	    $this->db->where("list_of_leads.area_incharge",$id);
  	    $this->db->order_by("policy_info.policy_issue_date","Asc");
  	    return $this->db->get("policy_info")->num_rows();
    }
    
    public function ai_business_completed_count($id,$from_date,$to_date)
    {
        $this->db->select("temp_policy_info.id");
      	$this->db->join("list_of_leads","temp_policy_info.lead_id = list_of_leads.id");
  	    $this->db->join("list_of_clients","list_of_leads.client_id = list_of_clients.id");
  	    $this->db->join("list_of_pos_and_agents","temp_policy_info.policy_agency_pos = list_of_pos_and_agents.id");
  	    $this->db->join("list_of_insurance_company","temp_policy_info.company = list_of_insurance_company.id");
  	    $this->db->join("type_of_bussiness","list_of_leads.business_type = type_of_bussiness.id");
  	    $this->db->join("list_of_class","list_of_leads.class = list_of_class.id");
  	    $this->db->join("list_of_policy_type","list_of_leads.policy_type = list_of_policy_type.id");
  	    $this->db->join("list_of_premium_cover_type","temp_policy_info.policy_premium = list_of_premium_cover_type.id",'left');
  	   
  	    if($from_date != "all" && $from_date != "Noduedate")
        {
  	       $this->db->where("temp_policy_info.policy_issue_date >=",$from_date);
        }
        if($to_date != "all" && $to_date != "Noduedate")
        {
  	       $this->db->where("temp_policy_info.policy_issue_date <=",$to_date);
        }
  	    //$this->db->where("list_of_leads.policy_status","1");
  	    $this->db->where("list_of_leads.lead_type !=","2");
  	    $this->db->where("list_of_leads.area_incharge",$id);
  	    return $this->db->get("temp_policy_info")->num_rows();
    }
    
    
    public function ai_lost_count($id,$from_date,$to_date)
    {
        $this->db->where("area_incharge",$id);
         $this->db->where("lead_status","lost");
         if($from_date != "all" && $from_date != "Noduedate")
        {
            $this->db->where("created_date >=", $from_date);
        }
        if($to_date != "all" && $to_date != "Noduedate")
        {
            $this->db->where("created_date <=", $to_date);
        }
         return $this->db->get("list_of_leads")->num_rows();
    }
    public function load_agent_pos($type,$user_id)
    {
        $this->db->select("list_of_pos_and_agents.id,list_of_pos_and_agents.name");
        $this->db->where("list_of_pos_and_agents.role",$type);
        
        if($this->session->userdata("session_role") == "user")
        {
            $this->db->where("list_of_pos_and_agents.user_id",$user_id);
        }
        else if($this->session->userdata("session_role") == "AI")
        {
            $this->db->where("list_of_pos_and_agents.area_incharge",$this->session->userdata("session_id"));
        }
        $this->db->where("list_of_pos_and_agents.status","active");
         $this->db->group_by('list_of_pos_and_agents.id');
         $this->db->join("list_of_leads","list_of_leads.agency_and_pos = list_of_pos_and_agents.id");
        return $this->db->get("list_of_pos_and_agents")->result();
    }
    public function agent_open_count($id,$from_date,$to_date)
    {
        $this->db->where("agency_and_pos",$id);
        $this->db->where("lead_status","open");
        
        if($from_date != "all" && $from_date != "Noduedate")
        {
            $this->db->where("due_date >=", $from_date);
        }
        if($to_date != "all" && $to_date != "Noduedate")
        {
            $this->db->where("due_date <=", $to_date);
        }
        
        if($from_date == "Noduedate" && $to_date != "Noduedate")
        {
            $this->db->where("due_date", "0000-00-00");
        }
         $this->db->where("list_of_leads.policy_status !=","1");
         $this->db->where("list_of_leads.lead_status !=","completed");
        return $this->db->get("list_of_leads")->num_rows();
    }
    public function staff_open_count($id,$from_date,$to_date)
    {
        $this->db->where("assigned_user",$id);
        $this->db->where("lead_status","open");
        
        if($from_date != "all" && $from_date != "Noduedate")
        {
            $this->db->where("due_date >=", $from_date);
        }
        if($to_date != "all" && $to_date != "Noduedate")
        {
            $this->db->where("due_date <=", $to_date);
        }
        if($from_date == "Noduedate" && $to_date == "Noduedate")
        {
            $this->db->where("due_date", "0000-00-00");
        }
         $this->db->where("list_of_leads.policy_status !=","1");
         $this->db->where("list_of_leads.lead_status !=","completed");
        return $this->db->get("list_of_leads")->num_rows();
    }
    public function staff_followup_count($id,$from_date,$to_date)
    {
        $this->db->where("list_of_leads.assigned_user",$id);
        $this->db->where("lead_status","followup");
        
         if($from_date != "all" && $from_date != "Noduedate")
        {
            $this->db->where("list_of_leads.next_follow_up_date >=", $from_date);
        }
        if($to_date != "all" && $to_date != "Noduedate")
        {
            $this->db->where("list_of_leads.next_follow_up_date <=", $to_date);
        }
       
        $this->db->where("list_of_leads.policy_status !=","1");
         $this->db->where("list_of_leads.lead_status !=","completed");
         return $this->db->get("list_of_leads")->num_rows();
    }
    public function agent_followup_count($id,$from_date,$to_date)
    {
        $this->db->where("list_of_leads.agency_and_pos",$id);
          $this->db->where("lead_status","followup");
          
          if($from_date != "all" && $from_date != "Noduedate")
        {
            $this->db->where("list_of_leads.next_follow_up_date >=", $from_date);
        }
        if($to_date != "all" && $from_date != "Noduedate")
        {
            $this->db->where("list_of_leads.next_follow_up_date <=", $to_date);
        }
        $this->db->where("list_of_leads.policy_status !=","1");
          $this->db->where("list_of_leads.lead_status !=","completed");
         return $this->db->get("list_of_leads")->num_rows();
    }
    
    public function agent_completed_count($id,$from_date,$to_date)
    {
         $this->db->where("agency_and_pos",$id);
         $this->db->where("lead_status","completed");
         
        if($from_date != "all" && $from_date != "Noduedate")
        {
            $this->db->where("created_date >=", $from_date);
        }
        if($to_date != "all" && $to_date != "Noduedate")
        {
            $this->db->where("created_date <=", $to_date);
        }
         return $this->db->get("list_of_leads")->num_rows();
    }
    
    public function agent_business_completed_count($id,$from_date,$to_date)
    {
         $this->db->where("agency_and_pos",$id);

        if($from_date != "all" && $from_date != "Noduedate")
        {
            $this->db->where("created_date >=", $from_date);
        }
        if($to_date != "all" && $to_date != "Noduedate")
        {
            $this->db->where("created_date <=", $to_date);
        }
        $this->db->where("lead_status !=","completed");
        $this->db->where("policy_status","1");
         return $this->db->get("list_of_leads")->num_rows();
    }
    
    public function staff_completed_count($id,$from_date,$to_date)
    {
        $this->db->select("policy_info.id");
      	$this->db->join("list_of_leads","policy_info.lead_id = list_of_leads.id");
  	    $this->db->join("list_of_clients","list_of_leads.client_id = list_of_clients.id");
  	    $this->db->join("list_of_pos_and_agents","policy_info.policy_agency_pos = list_of_pos_and_agents.id");
  	    $this->db->join("list_of_insurance_company","policy_info.company = list_of_insurance_company.id");
  	    $this->db->join("type_of_bussiness","list_of_leads.business_type = type_of_bussiness.id");
  	    $this->db->join("list_of_class","list_of_leads.class = list_of_class.id");
  	     $this->db->join("admin_login","admin_login.id = list_of_leads.area_incharge","left");
  	    $this->db->join("list_of_policy_type","list_of_leads.policy_type = list_of_policy_type.id");
  	    $this->db->join("list_of_premium_cover_type","policy_info.policy_premium = list_of_premium_cover_type.id",'left');
  	    $this->db->where("list_of_leads.assigned_user",$id);
        $this->db->where("list_of_leads.lead_type","2");
        if($from_date != "all" && $from_date != "Noduedate")
        {
           $this->db->where("policy_info.policy_issue_date >=", $from_date);
        }
        if($to_date != "all" && $to_date != "Noduedate")
        {
           $this->db->where("policy_info.policy_issue_date <=", $to_date);
        }
  	    return $this->db->get("policy_info")->num_rows();
    }
    
    
   public function staff_business_completed_count($id,$from_date,$to_date)
    {
        $this->db->select("temp_policy_info.id");
      	$this->db->join("list_of_leads","temp_policy_info.lead_id = list_of_leads.id");
  	    $this->db->join("list_of_clients","list_of_leads.client_id = list_of_clients.id");
  	    $this->db->join("list_of_pos_and_agents","temp_policy_info.policy_agency_pos = list_of_pos_and_agents.id");
  	    $this->db->join("list_of_insurance_company","temp_policy_info.company = list_of_insurance_company.id");
  	    $this->db->join("type_of_bussiness","list_of_leads.business_type = type_of_bussiness.id");
  	    $this->db->join("list_of_class","list_of_leads.class = list_of_class.id");
  	    $this->db->join("list_of_policy_type","list_of_leads.policy_type = list_of_policy_type.id");
  	    $this->db->join("list_of_premium_cover_type","temp_policy_info.policy_premium = list_of_premium_cover_type.id",'left');
  	    $this->db->join("admin_login","admin_login.id = list_of_leads.area_incharge","left");
  	    $this->db->order_by("temp_policy_info.policy_issue_date","Asc");
  	    $this->db->where("list_of_leads.lead_type !=","2");
  	    $this->db->where("list_of_leads.assigned_user",$id);
        if($from_date != "all" && $from_date != "Noduedate")
        {
            $this->db->where("temp_policy_info.policy_issue_date >=", $from_date);
        }
        if($to_date != "all" && $to_date != "Noduedate")
        {
            $this->db->where("temp_policy_info.policy_issue_date <=", $to_date);
        }
  	    
  	    return $this->db->get("temp_policy_info")->num_rows();
    }
    
    public function fetch_agent_tot_policy($id)
    {
         $this->db->where("agency_and_pos",$id);
         $this->db->where("lead_status","completed");
         return $this->db->get("list_of_leads")->num_rows();
    }
    public function fetch_other_agent_tot_policy($id)
    {
         $this->db->where("agency_and_pos !=",$id);
         $this->db->where("lead_status","completed");
         return $this->db->get("list_of_leads")->num_rows();
    }
    public function agent_completed_with_class_count($id,$from_date,$to_date,$class)
    {
         $this->db->where("agency_and_pos",$id);
         $this->db->where("lead_status","completed");
         if($from_date != "all")
        {
            $this->db->where("created_date >=", $from_date);
        }
        if($to_date != "all")
        {
            $this->db->where("created_date <=", $to_date);
        }
        if($class != "all")
        {
            $this->db->where("class", $class);
        }
         return $this->db->get("list_of_leads")->num_rows();
    }
    public function agent_lead_with_class_count($id,$from_date,$to_date,$class)
    {
        $this->db->where("agency_and_pos",$id);
        $this->db->where("lead_status !=","completed");
        $this->db->where("lead_status !=","lost");
        if($from_date != "all")
        {
            $this->db->where("created_date >=", $from_date);
        }
        if($to_date != "all")
        {
            $this->db->where("created_date <=", $to_date);
        }
        if($class != "all")
        {
            $this->db->where("class", $class);
        }
        return $this->db->get("list_of_leads")->num_rows();
    }
    public function agent_lost_with_class_count($id,$from_date,$to_date,$class)
    {
        $this->db->where("agency_and_pos",$id);
       
        if($from_date != "all")
        {
            $this->db->where("created_date >=", $from_date);
        }
        if($to_date != "all")
        {
            $this->db->where("created_date <=", $to_date);
        }
        if($class != "all")
        {
            $this->db->where("class", $class);
        }
         $this->db->where("lead_status","lost");
        return $this->db->get("list_of_leads")->num_rows();
    }
    public function agent_lost_count($id,$from_date,$to_date)
    {
        $this->db->where("agency_and_pos",$id);
         $this->db->where("lead_status","lost");
         if($from_date != "all")
        {
            $this->db->where("created_date >=", $from_date);
        }
        if($to_date != "all")
        {
            $this->db->where("created_date <=", $to_date);
        }
         return $this->db->get("list_of_leads")->num_rows();
    }
    public function staff_lost_count($id,$from_date,$to_date)
    {
        $this->db->where("assigned_user",$id);
         $this->db->where("lead_status","lost");
         if($from_date != "all")
        {
            $this->db->where("created_date >=", $from_date);
        }
        if($to_date != "all")
        {
            $this->db->where("created_date <=", $to_date);
        }
         return $this->db->get("list_of_leads")->num_rows();
    }
    public function fetch_agent_list($user_id)
    {
        $this->db->where("role","agent");
        $this->db->where("status","active");
        if($user_id != 1)
        {
            $this->db->where("user_id",$user_id);
        }
        return $this->db->get("list_of_pos_and_agents")->result();
    }
     public function fetch_staff_list($user_id)
    {
        $this->db->where("role","user");
        $this->db->where("status","active");
        if($user_id != 1)
        {
            $this->db->where("id",$user_id);
        }
        return $this->db->get("admin_login")->result();
    }
    public function fetch_ai_list()
    {
        $this->db->where("role","AI");
        $this->db->where("status","active");
        return $this->db->get("admin_login")->result();
    }
    public function fetch_class_list()
    {
        return $this->db->get("list_of_class")->result();
    }
    public function fetch_agent_name($id)
    {
        $this->db->where("id",$id);
        $res = $this->db->get("list_of_pos_and_agents")->row();
        if($res != null)
        {
           return $res->name; 
        }
        else
        {
            return "";
        }
    }
    //pct
    public function fetch_premium_cover_type()
  	{
  		return $this->db->get("list_of_premium_cover_type")->result();
  	}
  	public function add_premium_cover_type($data)
  	{
  		if($this->db->insert("list_of_premium_cover_type",$data)){
  		    return true;
  		}
  		
  		return false;
  	}
  	public function fetch_edit_premium_cover_type($id)
  	{
  		$this->db->where("id",$id);
  		return $this->db->get("list_of_premium_cover_type")->row();
  	}
  	public function edit_premium_cover_type($id, $data)
  	{
  		$this->db->where("id",$id);
  		if($this->db->update("list_of_premium_cover_type",$data)){
  		    return true;
  		}
  		
  		return false;
  	}
  	//commission state
  	public function fetch_commission_state()
  	{
  		return $this->db->get("list_of_commision_state")->result();
  	}
  	public function add_commission_state($data)
  	{
  		if($this->db->insert("list_of_commision_state",$data)){
  		    return true;
  		}
  		
  		return false;
  	}
  	public function fetch_edit_commission_state($id)
  	{
  		$this->db->where("id",$id);
  		return $this->db->get("list_of_commision_state")->row();
  	}
  	public function edit_commission_state($id, $data)
  	{
  		$this->db->where("id",$id);
  		if($this->db->update("list_of_commision_state",$data)){
  		    return true;
  		}
  		
  		return false;
  	}
  	
   public function fetch_user_permissions($id)
  	{
  	    $this->db->where("user_id",$id);
  	    return $this->db->get("user_privileges")->row();
  	}
  	public function edit_commission_entry($id)
  	{
  	     $this->db->where("id",$id);
  	    return $this->db->get("company_payout_commission")->row();
  	}
  	public function fetch_commission_make_log($id,$policy_type)
  	{
  	    $this->db->where("commission_id",$id);
  	    $this->db->where("policy_type",$policy_type);
  	    return $this->db->get("com_make_log")->result();
  	}
  	public function fetch_commission_model_log($id,$policy_type)
  	{
  	    $this->db->where("commission_id",$id);
  	    $this->db->where("policy_type",$policy_type);
  	    return $this->db->get("com_model_log")->result();
  	}
  	public function fetch_commission_varient_log($id,$policy_type)
  	{
  	    $this->db->where("commission_id",$id);
  	    $this->db->where("policy_type",$policy_type);
  	    return $this->db->get("com_varient_log")->result();
  	}
  	public function fetch_select_rto_using_commission_id($id)
  	{
  	     $this->db->where("commission_id",$id);
  	    return $this->db->get("commission_rto_log")->result();
  	}
  	public function edit_check_vechi_age_already_exits($insurer_company,$premium_c_type,$insurer_class,$business_type,$policy_type,$ins_state,$fuel_type,$ins_classification,$id)
  	{
  	    $this->db->where("insurer_company",$insurer_company);
  	    $this->db->where("policy_premium_type",$premium_c_type);
  	    $this->db->where("class",$insurer_class);
  	    $this->db->where("business_type",$business_type);
  	    $this->db->where("policy_type",$policy_type);
  	    $this->db->where("state",$ins_state);
  	    $this->db->where("fuel_type",$fuel_type);
  	    $this->db->where("id!=",$id);
  	    //$this->db->where("classification",$ins_classification);
  	    return $this->db->get("company_payout_commission")->result();
  	}
  	public function edit_payout_commission($data,$id)
  	{
      	$this->db->where("id",$id);
  		$this->db->update("company_payout_commission",$data);
  	}
  	public function delete_company_commission_make_list($id)
  	{
  	     $this->db->where("commission_id",$id);
         $this->db->delete("com_make_log");
  	}
  	public function delete_company_commission_model_list($id)
  	{
  	    $this->db->where("commission_id",$id);
        $this->db->delete("com_model_log");
  	}
  	public function delete_company_commission_varient_list($id)
  	{
  	    $this->db->where("commission_id",$id);
        $this->db->delete("com_varient_log");
  	}
  	public function delete_company_rto_log($id)
  	{
  	     $this->db->where("commission_id",$id);
        $this->db->delete("commission_rto_log");
  	}
    //open lead
    
    public function fetch_all_leads_dashboard($id,$order_category)
  	{
  	    $this->fetch_all_leads_query($id,$order_category);
  	    
  	    if($_POST['length'] != -1)
      	{
        	$this->db->limit($_POST['length'],$_POST['start']);
      	}
      	$this->db->join("list_of_clients","list_of_leads.client_id = list_of_clients.id");
  	    $this->db->join("type_of_bussiness","list_of_leads.business_type = type_of_bussiness.id");
  	    $this->db->join("list_of_class","list_of_leads.class = list_of_class.id");
  	    $this->db->join("list_of_policy_type","list_of_leads.policy_type = list_of_policy_type.id");
  	    $this->db->join("admin_login","list_of_leads.assigned_user = admin_login.id",'left');
  	    //$this->db->where("list_of_leads.due_date >=",date("Y-m-d"));
  	    //$this->db->order_by("list_of_leads.due_date","asc");
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
  	
  	public function fetch_all_leads_query($id,$order_category)
  	{
  	 $this->db->select("list_of_leads.*,list_of_clients.client_name,list_of_clients.mobile_no,list_of_clients.other_contact_details,list_of_clients.landline_no,list_of_clients.address,list_of_clients.contact_person_name,list_of_clients.date_of_birth,list_of_clients.age,list_of_clients.area,type_of_bussiness.bussiness_type as b_type,list_of_class.class as lclass,list_of_policy_type.policy_type as p_type");
  	   if(isset($_POST['search']['value']) && $_POST['search']['value'] != "")
      	{
    		$this->db->where("(list_of_clients.client_name LIKE '%".$_POST['search']['value']."%' OR list_of_clients.mobile_no LIKE '%".$_POST['search']['value']."%' OR list_of_clients.other_contact_details LIKE '%".$_POST['search']['value']."%' OR list_of_clients.landline_no LIKE '%".$_POST['search']['value']."%'  OR list_of_clients.date_of_birth LIKE '%".$_POST['search']['value']."%' OR list_of_clients.age LIKE '%".$_POST['search']['value']."%' OR list_of_clients.area LIKE '%".$_POST['search']['value']."%'  OR list_of_leads.location LIKE '%".$_POST['search']['value']."%' OR list_of_leads.lead_generated_date LIKE '%".$_POST['search']['value']."%' OR list_of_clients.address LIKE '%".$_POST['search']['value']."%' OR list_of_clients.email LIKE '%".$_POST['search']['value']."%' OR type_of_bussiness.bussiness_type LIKE '%".$_POST['search']['value']."%' OR list_of_clients.contact_person_name LIKE '%".$_POST['search']['value']."%' OR list_of_policy_type.policy_type LIKE '%".$_POST['search']['value']."%'  OR list_of_class.class LIKE '%".$_POST['search']['value']."%' OR list_of_clients.contact_person_designation LIKE '%".$_POST['search']['value']."%')", NULL, FALSE);	    
      	}
  	    $this->db->where("list_of_leads.agency_and_pos", $id);
  	    $this->db->where("list_of_leads.lead_status", "open");
  	    if($order_category == "overdue")
  	    {
  	        $where = '(list_of_leads.due_date<"'.date("Y-m-d").'" and list_of_leads.due_date != "0000-00-00")';
  	        $this->db->where($where);
  	        //$this->db->where("list_of_leads.due_date <",date("Y-m-d"));
  	    }
  	    else if($order_category == "no_due_date")
  	    {
  	        $this->db->where("list_of_leads.due_date","0000-00-00");
  	    }
  	    else
  	    {
  	        $where = '(list_of_leads.due_date>="'.date("Y-m-d").'" and list_of_leads.due_date != "0000-00-00")';
  	        $this->db->where($where);
  	    }
  	}
  	
  	public function get_filtered_datas_count($id,$order_category)
	{
      	$this->fetch_all_leads_query($id,$order_category);
      	$this->db->join("list_of_clients","list_of_leads.client_id = list_of_clients.id");
  	    $this->db->join("type_of_bussiness","list_of_leads.business_type = type_of_bussiness.id");
  	    $this->db->join("list_of_class","list_of_leads.class = list_of_class.id");
  	    $this->db->join("list_of_policy_type","list_of_leads.policy_type = list_of_policy_type.id");
  	    //$this->db->where("list_of_leads.due_date >=",date("Y-m-d"));
  	    //$this->db->order_by("list_of_leads.due_date","asc");
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
	
	public function get_all_datas_count($id,$order_category)
	{
       $this->db->select("list_of_leads.id");
       $this->db->join("list_of_clients","list_of_leads.client_id = list_of_clients.id");
  	   $this->db->join("type_of_bussiness","list_of_leads.business_type = type_of_bussiness.id");
  	   $this->db->where("list_of_leads.agency_and_pos", $id);
  	    $this->db->where("list_of_leads.lead_status", "open");
  	    //$this->db->where("list_of_leads.due_date >=",date("Y-m-d"));
  	    //$this->db->order_by("list_of_leads.due_date","asc");
  	    if($order_category == "overdue")
  	    {
  	        $where = '(list_of_leads.due_date<"'.date("Y-m-d").'" and list_of_leads.due_date != "0000-00-00")';
  	        $this->db->where($where);
  	        //$this->db->where("list_of_leads.due_date <",date("Y-m-d"));
  	    }
  	    else if($order_category == "no_due_date")
  	    {
  	        $this->db->where("list_of_leads.due_date","0000-00-00");
  	    }
  	    else
  	    {
  	        $where = '(list_of_leads.due_date>="'.date("Y-m-d").'" and list_of_leads.due_date != "0000-00-00")';
  	        $this->db->where($where);
  	    }
  	    if($order_category == "upcoming")
  	    {
  	        $this->db->order_by("list_of_leads.due_date","asc");
  	    }
  	    else
  	    {
  	        $this->db->order_by("list_of_leads.id","desc");
  	    }
      	return $this->db->get("list_of_leads")->num_rows();
	}
    
   
    
    public function fetch_all_follow_ups_dashboard($id)
	{
	    $this->db->select("follow_up_details.*,list_of_clients.id as lid,list_of_clients.client_name,list_of_clients.mobile_no,list_of_leads.lead_generated_date");
	    $this->db->from("follow_up_details");
	    $this->db->join("list_of_leads","follow_up_details.lead_id=list_of_leads.id");
	     $this->db->join("list_of_clients","list_of_leads.client_id=list_of_clients.id");
	      $this->db->where("list_of_leads.agency_and_pos", $id);
	    //$this->db->where("follow_up_details.next_follow_up_date >=",$from_date);
	    //$this->db->where("follow_up_details.next_follow_up_date <=",$to_date);
	    return $this->db->get()->result();
	}
	
	public function fetch_all_leads_dashboard_ai($id,$order_category)
  	{
  	    $this->fetch_all_leads_query_ai($id,$order_category);
  	    if($_POST['length'] != -1)
      	{
        	$this->db->limit($_POST['length'],$_POST['start']);
      	}
      	$this->db->join("list_of_clients","list_of_leads.client_id = list_of_clients.id");
  	    $this->db->join("type_of_bussiness","list_of_leads.business_type = type_of_bussiness.id");
  	    $this->db->join("list_of_class","list_of_leads.class = list_of_class.id");
  	    $this->db->join("list_of_policy_type","list_of_leads.policy_type = list_of_policy_type.id");
  	    $this->db->join("admin_login","list_of_leads.area_incharge = admin_login.id",'left');
  	    //$this->db->where("list_of_leads.due_date >=",date("Y-m-d"));
  	    //$this->db->order_by("list_of_leads.due_date","asc");
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
	
	public function fetch_all_leads_query_ai($id,$order_category)
  	{
  	 $this->db->select("list_of_leads.*,list_of_clients.client_name,list_of_clients.mobile_no,list_of_clients.other_contact_details,list_of_clients.landline_no,list_of_clients.address,list_of_clients.contact_person_name,list_of_clients.date_of_birth,list_of_clients.age,list_of_clients.area,type_of_bussiness.bussiness_type as b_type,list_of_class.class as lclass,list_of_policy_type.policy_type as p_type");
  	   if(isset($_POST['search']['value']) && $_POST['search']['value'] != "")
      	{
    		$this->db->where("(list_of_clients.client_name LIKE '%".$_POST['search']['value']."%' OR list_of_clients.mobile_no LIKE '%".$_POST['search']['value']."%' OR list_of_clients.other_contact_details LIKE '%".$_POST['search']['value']."%' OR list_of_clients.landline_no LIKE '%".$_POST['search']['value']."%'  OR list_of_clients.date_of_birth LIKE '%".$_POST['search']['value']."%' OR list_of_clients.age LIKE '%".$_POST['search']['value']."%' OR list_of_clients.area LIKE '%".$_POST['search']['value']."%'  OR list_of_leads.location LIKE '%".$_POST['search']['value']."%' OR list_of_leads.lead_generated_date LIKE '%".$_POST['search']['value']."%' OR list_of_clients.address LIKE '%".$_POST['search']['value']."%' OR list_of_clients.email LIKE '%".$_POST['search']['value']."%' OR type_of_bussiness.bussiness_type LIKE '%".$_POST['search']['value']."%' OR list_of_clients.contact_person_name LIKE '%".$_POST['search']['value']."%' OR list_of_policy_type.policy_type LIKE '%".$_POST['search']['value']."%'  OR list_of_class.class LIKE '%".$_POST['search']['value']."%' OR list_of_clients.contact_person_designation LIKE '%".$_POST['search']['value']."%')", NULL, FALSE);	    
      	}
  	    $this->db->where("list_of_leads.area_incharge", $id);
  	    $this->db->where("list_of_leads.lead_status", "open");
  	    if($order_category == "overdue")
  	    {
  	        $where = '(list_of_leads.due_date<"'.date("Y-m-d").'" and list_of_leads.due_date != "0000-00-00")';
  	        $this->db->where($where);
  	        //$this->db->where("list_of_leads.due_date <",date("Y-m-d"));
  	    }
  	    else if($order_category == "no_due_date")
  	    {
  	        $this->db->where("list_of_leads.due_date","0000-00-00");
  	    }
  	    else
  	    {
  	        $where = '(list_of_leads.due_date>="'.date("Y-m-d").'" and list_of_leads.due_date != "0000-00-00")';
  	        $this->db->where($where);
  	    }
  	}
  	
  	public function get_filtered_datas_count_ai($id,$order_category)
	{
      	$this->fetch_all_leads_query_ai($id,$order_category);
      	$this->db->join("list_of_clients","list_of_leads.client_id = list_of_clients.id");
  	    $this->db->join("type_of_bussiness","list_of_leads.business_type = type_of_bussiness.id");
  	    $this->db->join("list_of_class","list_of_leads.class = list_of_class.id");
  	    $this->db->join("list_of_policy_type","list_of_leads.policy_type = list_of_policy_type.id");
  	    $this->db->join("admin_login","list_of_leads.area_incharge = admin_login.id",'left');
  	    //$this->db->where("list_of_leads.due_date >=",date("Y-m-d"));
  	    //$this->db->order_by("list_of_leads.due_date","asc");
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
	
	public function get_all_datas_count_ai($id,$order_category)
	{
       $this->db->select("list_of_leads.id");
       $this->db->join("list_of_clients","list_of_leads.client_id = list_of_clients.id");
  	   $this->db->join("type_of_bussiness","list_of_leads.business_type = type_of_bussiness.id");
  	   $this->db->join("admin_login","list_of_leads.area_incharge = admin_login.id",'left');
  	   $this->db->where("list_of_leads.area_incharge", $id);
  	    $this->db->where("list_of_leads.lead_status", "open");
  	    if($order_category == "overdue")
  	    {
  	        $where = '(list_of_leads.due_date<"'.date("Y-m-d").'" and list_of_leads.due_date != "0000-00-00")';
  	        $this->db->where($where);
  	        //$this->db->where("list_of_leads.due_date <",date("Y-m-d"));
  	    }
  	    else if($order_category == "no_due_date")
  	    {
  	        $this->db->where("list_of_leads.due_date","0000-00-00");
  	    }
  	    else
  	    {
  	        $where = '(list_of_leads.due_date>="'.date("Y-m-d").'" and list_of_leads.due_date != "0000-00-00")';
  	        $this->db->where($where);
  	    }
  	    //$this->db->where("list_of_leads.due_date >=",date("Y-m-d"));
  	    //$this->db->order_by("list_of_leads.due_date","asc");
  	    if($order_category == "upcoming")
  	    {
  	        $this->db->order_by("list_of_leads.due_date","asc");
  	    }
  	    else
  	    {
  	        $this->db->order_by("list_of_leads.id","desc");
  	    }
      	return $this->db->get("list_of_leads")->num_rows();
	}
	
	//staff
	public function fetch_all_leads_dashboard_staff($id,$order_category)
  	{
  	    $this->fetch_all_leads_query_staff($id,$order_category);
  	    if($_POST['length'] != -1)
      	{
        	$this->db->limit($_POST['length'],$_POST['start']);
      	}
      	$this->db->join("list_of_clients","list_of_leads.client_id = list_of_clients.id");
  	    $this->db->join("type_of_bussiness","list_of_leads.business_type = type_of_bussiness.id");
  	    $this->db->join("list_of_class","list_of_leads.class = list_of_class.id");
  	    $this->db->join("list_of_policy_type","list_of_leads.policy_type = list_of_policy_type.id");
  	    $this->db->join("admin_login","list_of_leads.assigned_user = admin_login.id",'left');
  	    //$this->db->where("list_of_leads.due_date >=",date("Y-m-d"));
  	    //$this->db->order_by("list_of_leads.due_date","asc");
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
  	
  	public function fetch_all_leads_query_staff($id,$order_category)
  	{
  	 $this->db->select("list_of_leads.*,list_of_clients.client_name,list_of_clients.mobile_no,list_of_clients.other_contact_details,list_of_clients.landline_no,list_of_clients.address,list_of_clients.contact_person_name,list_of_clients.date_of_birth,list_of_clients.age,list_of_clients.area,type_of_bussiness.bussiness_type as b_type,list_of_class.class as lclass,list_of_policy_type.policy_type as p_type");
  	   if(isset($_POST['search']['value']) && $_POST['search']['value'] != "")
      	{
    		$this->db->where("(list_of_clients.client_name LIKE '%".$_POST['search']['value']."%' OR list_of_clients.mobile_no LIKE '%".$_POST['search']['value']."%' OR list_of_clients.other_contact_details LIKE '%".$_POST['search']['value']."%' OR list_of_clients.landline_no LIKE '%".$_POST['search']['value']."%'  OR list_of_clients.date_of_birth LIKE '%".$_POST['search']['value']."%' OR list_of_clients.age LIKE '%".$_POST['search']['value']."%' OR list_of_clients.area LIKE '%".$_POST['search']['value']."%'  OR list_of_leads.location LIKE '%".$_POST['search']['value']."%' OR list_of_leads.lead_generated_date LIKE '%".$_POST['search']['value']."%' OR list_of_clients.address LIKE '%".$_POST['search']['value']."%' OR list_of_clients.email LIKE '%".$_POST['search']['value']."%' OR type_of_bussiness.bussiness_type LIKE '%".$_POST['search']['value']."%' OR list_of_clients.contact_person_name LIKE '%".$_POST['search']['value']."%' OR list_of_policy_type.policy_type LIKE '%".$_POST['search']['value']."%'  OR list_of_class.class LIKE '%".$_POST['search']['value']."%' OR list_of_clients.contact_person_designation LIKE '%".$_POST['search']['value']."%')", NULL, FALSE);	    
      	}
  	    $this->db->where("list_of_leads.assigned_user", $id);
  	    $this->db->where("list_of_leads.lead_status", "open");
  	    $this->db->where("list_of_leads.lead_type !=", "2");
  	    $this->db->where("list_of_leads.policy_status !=", "1");

  	    if($order_category == "overdue")
  	    {
  	        $where = '(list_of_leads.due_date<"'.date("Y-m-d").'" and list_of_leads.due_date != "0000-00-00")';
  	        $this->db->where($where);
  	        //$this->db->where("list_of_leads.due_date <",date("Y-m-d"));
  	    }
  	    else if($order_category == "no_due_date")
  	    {
  	        $this->db->where("list_of_leads.due_date","0000-00-00");
  	    }
  	    else
  	    {
  	        $where = '(list_of_leads.due_date>="'.date("Y-m-d").'" and list_of_leads.due_date != "0000-00-00")';
  	        $this->db->where($where);
  	    }
  	}
  	
  	public function get_filtered_datas_count_staff($id,$order_category)
	{
      	$this->fetch_all_leads_query_staff($id,$order_category);
      	$this->db->join("list_of_clients","list_of_leads.client_id = list_of_clients.id");
  	    $this->db->join("type_of_bussiness","list_of_leads.business_type = type_of_bussiness.id");
  	    $this->db->join("list_of_class","list_of_leads.class = list_of_class.id");
  	    $this->db->join("list_of_policy_type","list_of_leads.policy_type = list_of_policy_type.id");
  	    //$this->db->where("list_of_leads.due_date >=",date("Y-m-d"));
  	    //$this->db->order_by("list_of_leads.due_date","asc");
  	    if($order_category == "upcoming")
  	    {
  	        $this->db->order_by("list_of_leads.due_date","asc");
  	    }
  	    else
  	    {
  	        $this->db->order_by("list_of_leads.id","desc");
  	    }
  	    $this->db->where("list_of_leads.lead_type !=", "2");
  	    $this->db->where("list_of_leads.policy_status !=", "1");
      	$res = $this->db->get("list_of_leads");
      	return $res->num_rows();
	}
	
	public function get_all_datas_count_staff($id,$order_category)
	{
       $this->db->select("list_of_leads.id");
       $this->db->join("list_of_clients","list_of_leads.client_id = list_of_clients.id");
  	   $this->db->join("type_of_bussiness","list_of_leads.business_type = type_of_bussiness.id");
  	   $this->db->where("list_of_leads.assigned_user", $id);
  	    $this->db->where("list_of_leads.lead_status", "open");
  	    if($order_category == "overdue")
  	    {
  	        $where = '(list_of_leads.due_date<"'.date("Y-m-d").'" and list_of_leads.due_date != "0000-00-00")';
  	        $this->db->where($where);
  	        //$this->db->where("list_of_leads.due_date <",date("Y-m-d"));
  	    }
  	    else if($order_category == "no_due_date")
  	    {
  	        $this->db->where("list_of_leads.due_date","0000-00-00");
  	    }
  	    else
  	    {
  	        $where = '(list_of_leads.due_date>="'.date("Y-m-d").'" and list_of_leads.due_date != "0000-00-00")';
  	        $this->db->where($where);
  	    }
  	    //$this->db->where("list_of_leads.due_date >=",date("Y-m-d"));
  	    //$this->db->order_by("list_of_leads.due_date","asc");
  	    if($order_category == "upcoming")
  	    {
  	        $this->db->order_by("list_of_leads.due_date","asc");
  	    }
  	    else
  	    {
  	        $this->db->order_by("list_of_leads.id","desc");
  	    }
  	    $this->db->where("list_of_leads.lead_type !=", "2");
  	    $this->db->where("list_of_leads.policy_status !=", "1");
      	return $this->db->get("list_of_leads")->num_rows();
	}
    
    public function fetch_all_follow_ups_dashboard_staff($id)
    {
        $this->db->select("follow_up_details.*,list_of_clients.id as lid,list_of_clients.client_name,list_of_clients.mobile_no,list_of_leads.lead_generated_date");
	    $this->db->from("follow_up_details");
	    $this->db->join("list_of_leads","follow_up_details.lead_id=list_of_leads.id");
	     $this->db->join("list_of_clients","list_of_leads.client_id=list_of_clients.id");
	      $this->db->where("list_of_leads.assigned_user", $id);
	    //$this->db->where("follow_up_details.next_follow_up_date >=",$from_date);
	    //$this->db->where("follow_up_details.next_follow_up_date <=",$to_date);
	    return $this->db->get()->result();
    }
    
    public function fetch_all_follow_ups_dashboard_ai($id)
    {
        $this->db->select("follow_up_details.*,list_of_clients.id as lid,list_of_clients.client_name,list_of_clients.mobile_no,list_of_leads.lead_generated_date");
	    $this->db->from("follow_up_details");
	    $this->db->join("list_of_leads","follow_up_details.lead_id=list_of_leads.id");
	     $this->db->join("list_of_clients","list_of_leads.client_id=list_of_clients.id");
	      $this->db->where("list_of_leads.area_incharge", $id);
	    //$this->db->where("follow_up_details.next_follow_up_date >=",$from_date);
	    //$this->db->where("follow_up_details.next_follow_up_date <=",$to_date);
	    return $this->db->get()->result();
    }
    
    //staff graph
    public function staff_completed_with_class_count($id,$from_date,$to_date,$class)
    {
         $this->db->where("assigned_user",$id);
         $this->db->where("lead_status","completed");
         if($from_date != "all")
        {
            $this->db->where("created_date >=", $from_date);
        }
        if($to_date != "all")
        {
            $this->db->where("created_date <=", $to_date);
        }
        if($class != "all")
        {
            $this->db->where("class", $class);
        }
         return $this->db->get("list_of_leads")->num_rows();
    }
  	public function staff_lead_with_class_count($id,$from_date,$to_date,$class)
    {
        $this->db->where("assigned_user",$id);
        $this->db->where("lead_status !=","completed");
        $this->db->where("lead_status !=","lost");
        if($from_date != "all")
        {
            $this->db->where("created_date >=", $from_date);
        }
        if($to_date != "all")
        {
            $this->db->where("created_date <=", $to_date);
        }
        if($class != "all")
        {
            $this->db->where("class", $class);
        }
        return $this->db->get("list_of_leads")->num_rows();
    }
     public function staff_lost_with_class_count($id,$from_date,$to_date,$class)
    {
        $this->db->where("assigned_user",$id);
       
        if($from_date != "all")
        {
            $this->db->where("created_date >=", $from_date);
        }
        if($to_date != "all")
        {
            $this->db->where("created_date <=", $to_date);
        }
        if($class != "all")
        {
            $this->db->where("class", $class);
        }
         $this->db->where("lead_status","lost");
        return $this->db->get("list_of_leads")->num_rows();
    }
    public function fetch_staff_name($id)
    {
        $this->db->where("id",$id);
        $this->db->where("status","active");
        $res = $this->db->get("admin_login")->row();
        if($res != null)
        {
           return $res->name; 
        }
        else
        {
            return "";
        }
    }
    public function fetch_staff_tot_policy($id)
    {
         $this->db->where("assigned_user",$id);
         $this->db->where("lead_status","completed");
         return $this->db->get("list_of_leads")->num_rows();
    }
    public function fetch_other_staff_tot_policy($id)
    {
         $this->db->where("assigned_user !=",$id);
         $this->db->where("lead_status","completed");
         return $this->db->get("list_of_leads")->num_rows();
    }
    public function add_bussiness_followup($data)
    {
         $this->db->insert("list_website_followup", $data);
    }
    public function agent_pos_update($agent,$data)
    {
        $this->db->where("id",$agent);
        $this->db->update("list_of_pos_and_agents",$data);
    }
    public function fetch_agent_old_chat_data($agent)
    {
         $this->db->where("agent_id",$agent);
          $this->db->order_by("id","desc");
         return $this->db->get("list_website_followup")->result();
    }
    public function fetch_agent_lead_dashboard_followup($from_date,$to_date,$agent)
    {
        $this->db->where("agency_and_pos",$agent);
        if($from_date != "all")
        {
            $this->db->where("due_date >=", $from_date);
        }
        if($to_date != "all")
        {
            $this->db->where("due_date <=", $to_date);
            $this->db->where("due_date !=", "0000-00-00");
        }
        $this->db->where("lead_status !=", "completed");
        $this->db->where("lead_status !=", "lost");
        return $this->db->get("list_of_leads")->result();
    }
    public function get_client_phone($id)
    {
        $this->db->where("id",$id);
	    $res = $this->db->get("list_of_clients")->row();
	    if($res != null)
	    {
	        return $res->mobile_no;
	    }
	    else
	    {
	        return "";
	    }
    }
    public function fetch_customer_with_agent($agent)
  	{
  	    $this->fetch_all_customers_query($agent);
  	    
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
  	
  	public function fetch_all_customers_query($agent)
  	{
  	 $this->db->select("list_of_leads.*,list_of_clients.client_name,list_of_clients.mobile_no,list_of_clients.other_contact_details,list_of_clients.landline_no,list_of_clients.address,list_of_clients.contact_person_name,list_of_clients.date_of_birth,list_of_clients.age,list_of_clients.area,type_of_bussiness.bussiness_type as b_type,list_of_class.class as lclass,list_of_policy_type.policy_type as p_type,policy_info.policy_no,policy_info.policy_ex_date,policy_info.policy_premium,policy_info.policy_terms,list_of_premium_cover_type.name as pre_name");
  	   if(isset($_POST['search']['value']) && $_POST['search']['value'] != "")
      	{
    		$this->db->where("(list_of_clients.client_name LIKE '%".$_POST['search']['value']."%' OR list_of_clients.mobile_no LIKE '%".$_POST['search']['value']."%' OR list_of_clients.other_contact_details LIKE '%".$_POST['search']['value']."%' OR list_of_clients.landline_no LIKE '%".$_POST['search']['value']."%'  OR list_of_clients.date_of_birth LIKE '%".$_POST['search']['value']."%' OR list_of_clients.age LIKE '%".$_POST['search']['value']."%' OR list_of_clients.area LIKE '%".$_POST['search']['value']."%'  OR list_of_leads.location LIKE '%".$_POST['search']['value']."%' OR list_of_leads.lead_generated_date LIKE '%".$_POST['search']['value']."%' OR list_of_clients.address LIKE '%".$_POST['search']['value']."%' OR list_of_clients.email LIKE '%".$_POST['search']['value']."%' OR type_of_bussiness.bussiness_type LIKE '%".$_POST['search']['value']."%' OR list_of_clients.contact_person_name LIKE '%".$_POST['search']['value']."%' OR list_of_policy_type.policy_type LIKE '%".$_POST['search']['value']."%'  OR list_of_class.class LIKE '%".$_POST['search']['value']."%' OR list_of_clients.contact_person_designation LIKE '%".$_POST['search']['value']."%' OR policy_info.policy_no LIKE '%".$_POST['search']['value']."%' OR policy_info.policy_premium LIKE '%".$_POST['search']['value']."%' OR policy_info.policy_ex_date LIKE '%".$_POST['search']['value']."%')", NULL, FALSE);	    
      	}
  	    $this->db->where("list_of_leads.lead_type", 2);
  	    $this->db->where("list_of_leads.agency_and_pos",$agent);
  	}
  	
  	public function get_customer_filtered_datas_count($agent)
	{
      	$this->fetch_all_customers_query($agent);
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
	
	public function get_all_customer_datas_count($agent)
	{
      	$this->db->select("list_of_leads.id");
      	$this->db->join("list_of_clients","list_of_leads.client_id = list_of_clients.id");
  	    $this->db->join("type_of_bussiness","list_of_leads.business_type = type_of_bussiness.id");
  	    $this->db->join("policy_info","list_of_leads.id = policy_info.lead_id");
  	    $this->db->join("list_of_premium_cover_type","policy_info.policy_premium = list_of_premium_cover_type.id");
  	    $this->db->where("list_of_leads.lead_type", 2);
  	    $this->db->where("list_of_leads.agency_and_pos", $agent);
  	    $this->db->order_by("list_of_leads.id","DESC");
      	return $this->db->get("list_of_leads")->num_rows();
	}
	
	 public function make_generate_policy($from_date,$to_date,$ai)
	{
      	$this->db->select("list_of_leads.id as c_lead_id,policy_info.id,policy_info.own_commission_amt,policy_info.agent_commission_amt,policy_info.tot_liability_premium,policy_info.no_claim_bonus,policy_info.commission_id,policy_info.policy_agency_pos,list_of_leads.business_type,policy_info.policy_premium,list_of_leads.class,policy_info.rto,policy_info.vehicle_classification,policy_info.category,policy_info.company,policy_info.state,policy_info.gst,policy_info.policy_s_date,policy_info.policy_ex_date,list_of_premium_cover_type.name as policy_premium_name,type_of_bussiness.bussiness_type as business_name,list_of_class.class as class_name,list_of_policy_type.policy_type,policy_info.total_own_damage,policy_info.basic_tp,policy_info.total_premium,policy_info.policy_no,list_of_clients.client_name,list_of_clients.mobile_no,list_of_pos_and_agents.agent_pos_code,list_of_insurance_company.company_name,list_of_insurance_company.short_name as ins_short_name,list_of_pos_and_agents.area_incharge");
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
    		$this->db->where("(client_name LIKE '%".$_POST['search']['value']."%' OR mobile_no LIKE '%".$_POST['search']['value']."%' OR agent_pos_code LIKE '%".$_POST['search']['value']."%' OR policy_no LIKE '%".$_POST['search']['value']."%' OR company_name LIKE '%".$_POST['search']['value']."%' OR type_of_bussiness.bussiness_type LIKE '%".$_POST['search']['value']."%' OR list_of_class.class LIKE '%".$_POST['search']['value']."%' OR list_of_policy_type.policy_type LIKE '%".$_POST['search']['value']."%' OR list_of_premium_cover_type.name LIKE '%".$_POST['search']['value']."%')", NULL, FALSE);	    
      	}
      	if($from_date != "all")
      	{
      	    $this->db->where("policy_issue_date >=",$from_date);
      	    $this->db->where("policy_issue_date <=",$to_date);
      	}
      	$this->db->where("list_of_pos_and_agents.area_incharge",$ai);
	}
  	public function fetch_generate_policy($from_date,$to_date,$ai)
  	{
  	    $this->make_generate_policy($from_date,$to_date,$ai);
  	    if($_POST['length'] != -1)
      	{
        	$this->db->limit($_POST['length'],$_POST['start']);
      	}
  	    return $this->db->get("policy_info")->result();
  	}
  	
  	public function get_filtered_generate_policy_count($from_date,$to_date,$ai)
	{
      	$this->make_generate_policy($from_date,$to_date,$ai);
      	$res = $this->db->get("policy_info");
      	return $res->num_rows();
	}
	public function get_all_generate_policy_count($from_date,$to_date,$ai)
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
  	    if($from_date != "all")
      	{
      	    $this->db->where("policy_issue_date >=",$from_date);
      	    $this->db->where("policy_issue_date <=",$to_date);
      	}
      	$this->db->where("list_of_pos_and_agents.area_incharge",$ai);
      	return $this->db->get('policy_info')->num_rows();
	}
	public function fetch_area_incharge_row($area_incharge)
    {
        $this->db->where("id", $area_incharge);
        $this->db->where("status","active");
        return $this->db->get("admin_login")->row();
    }
    public function fetch_area_incharge_user_name($region_id)
    {
        $this->db->where("reigion_id", $region_id);
        $this->db->where("role", "user");
        $this->db->where("status","active");
        $res = $this->db->get("admin_login")->row();
        if($res != null)
        {
           return $res->name;
        }
        else
        {
            return "";
        }
    }
    public function fetch_total_policy_ai($class_id,$from_date,$to_date,$ai)
  	{
  		$this->db->select("policy_info.*,");
      	$this->db->join("list_of_leads","policy_info.lead_id = list_of_leads.id");
  	    $this->db->join("list_of_clients","list_of_leads.client_id = list_of_clients.id");
  	    $this->db->join("list_of_pos_and_agents","policy_info.policy_agency_pos = list_of_pos_and_agents.id");
  	    $this->db->join("list_of_insurance_company","policy_info.company = list_of_insurance_company.id");
  	    $this->db->join("type_of_bussiness","list_of_leads.business_type = type_of_bussiness.id");
  	    $this->db->join("list_of_class","list_of_leads.class = list_of_class.id");
  	     $this->db->join("admin_login","admin_login.id = list_of_leads.area_incharge",'left');
  	    $this->db->join("list_of_policy_type","list_of_leads.policy_type = list_of_policy_type.id");
  	    $this->db->join("list_of_premium_cover_type","policy_info.policy_premium = list_of_premium_cover_type.id",'left');
  	    $this->db->where("list_of_leads.class", $class_id);
  	    $this->db->where("list_of_leads.area_incharge", $ai);
  	    
  	    if($from_date != "all")
        {
            $this->db->where("policy_info.policy_issue_date >=", $from_date);
        }
        if($to_date != "all")
        {
            $this->db->where("policy_info.policy_issue_date <=", $to_date);
        }
        $this->db->where("list_of_leads.lead_type","2");
  	    return $this->db->get("policy_info")->result();
  	}
  	
   public function fetch_total_business_complete_ai($class_id,$from_date,$to_date,$ai)
   {
         $this->db->select("temp_policy_info.*,");
      	$this->db->join("list_of_leads","temp_policy_info.lead_id = list_of_leads.id");
  	    $this->db->join("list_of_clients","list_of_leads.client_id = list_of_clients.id");
  	    $this->db->join("list_of_pos_and_agents","temp_policy_info.policy_agency_pos = list_of_pos_and_agents.id");
  	    $this->db->join("list_of_insurance_company","temp_policy_info.company = list_of_insurance_company.id");
  	    $this->db->join("type_of_bussiness","list_of_leads.business_type = type_of_bussiness.id");
  	    $this->db->join("list_of_class","list_of_leads.class = list_of_class.id");
  	    $this->db->join("list_of_policy_type","list_of_leads.policy_type = list_of_policy_type.id");
  	    $this->db->join("list_of_premium_cover_type","temp_policy_info.policy_premium = list_of_premium_cover_type.id",'left');
        $this->db->where("list_of_leads.area_incharge",$ai);
        $this->db->where("list_of_leads.class", $class_id);
        $this->db->where("temp_policy_info.policy_issue_date >=",$from_date);
        $this->db->where("temp_policy_info.policy_issue_date <=",$to_date);
        $this->db->where("list_of_leads.lead_type !=","2");
        //$this->db->where("list_of_leads.policy_status","1");
        return $this->db->get("temp_policy_info")->result();
   }
        
  	public function fetch_ai_old_chat_data($area_incharge)
    {
         $this->db->where("area_incharge_id",$area_incharge);
          $this->db->order_by("id","desc");
         return $this->db->get("list_website_followup")->result();
    }
    public function fetch_login_name($id)
    {
         $this->db->where("id", $id);
         $this->db->where("status","active");
        $res = $this->db->get("admin_login")->row();
        if($res != null)
        {
           return $res->name;
        }
        else
        {
            return "";
        }
    }
    public function ai_update($agent,$data)
    {
        $this->db->where("id",$agent);
        
        $this->db->update("admin_login",$data);
    }
    public function fetch_area_incharge_lead_dashboard_followup($from_date,$to_date,$area_incharge)
    {
        $this->db->where("area_incharge",$area_incharge);
        
        if($from_date != "all")
        {
            $this->db->where("due_date >=", $from_date);
        }
        if($to_date != "all")
        {
            $this->db->where("due_date <=", $to_date);
            $this->db->where("due_date !=", "0000-00-00");
        }
        $this->db->order_by("due_date","Asc");
        $this->db->where("lead_status !=", "completed");
        $this->db->where("lead_status !=", "lost");
        return $this->db->get("list_of_leads")->result();
    }
    
    
    public function fetch_customer_with_area_incharge($area_incharge)
  	{
  	    $this->fetch_all_customers_query_ai($area_incharge);
  	    
  	    if($_POST['length'] != -1)
      	{
        	$this->db->limit($_POST['length'],$_POST['start']);
      	}
      	
        $this->db->join("list_of_clients","list_of_leads.client_id = list_of_clients.id");
  	    $this->db->join("type_of_bussiness","list_of_leads.business_type = type_of_bussiness.id");
  	    $this->db->join("list_of_class","list_of_leads.class = list_of_class.id");
  	    $this->db->join("list_of_policy_type","list_of_leads.policy_type = list_of_policy_type.id");
  	    $this->db->join("policy_info","list_of_leads.id = policy_info.lead_id");
  	    $this->db->join("list_of_premium_cover_type","policy_info.policy_premium = list_of_premium_cover_type.id",'left');
  	    return $this->db->get("list_of_leads")->result();
  	}
  	
  	public function fetch_all_customers_query_ai($area_incharge)
  	{
  	 $this->db->select("list_of_leads.*,list_of_clients.client_name,list_of_clients.mobile_no,list_of_clients.other_contact_details,list_of_clients.landline_no,list_of_clients.address,list_of_clients.contact_person_name,list_of_clients.date_of_birth,list_of_clients.age,list_of_clients.area,type_of_bussiness.bussiness_type as b_type,list_of_class.class as lclass,list_of_policy_type.policy_type as p_type,policy_info.policy_no,policy_info.policy_ex_date,policy_info.policy_premium,policy_info.policy_terms,list_of_premium_cover_type.name as pre_name");
  	   if(isset($_POST['search']['value']) && $_POST['search']['value'] != "")
      	{
    		$this->db->where("(list_of_clients.client_name LIKE '%".$_POST['search']['value']."%' OR list_of_clients.mobile_no LIKE '%".$_POST['search']['value']."%' OR list_of_clients.other_contact_details LIKE '%".$_POST['search']['value']."%' OR list_of_clients.landline_no LIKE '%".$_POST['search']['value']."%'  OR list_of_clients.date_of_birth LIKE '%".$_POST['search']['value']."%' OR list_of_clients.age LIKE '%".$_POST['search']['value']."%' OR list_of_clients.area LIKE '%".$_POST['search']['value']."%'  OR list_of_leads.location LIKE '%".$_POST['search']['value']."%' OR list_of_leads.lead_generated_date LIKE '%".$_POST['search']['value']."%' OR list_of_clients.address LIKE '%".$_POST['search']['value']."%' OR list_of_clients.email LIKE '%".$_POST['search']['value']."%' OR type_of_bussiness.bussiness_type LIKE '%".$_POST['search']['value']."%' OR list_of_clients.contact_person_name LIKE '%".$_POST['search']['value']."%' OR list_of_policy_type.policy_type LIKE '%".$_POST['search']['value']."%'  OR list_of_class.class LIKE '%".$_POST['search']['value']."%' OR list_of_clients.contact_person_designation LIKE '%".$_POST['search']['value']."%' OR policy_info.policy_no LIKE '%".$_POST['search']['value']."%' OR policy_info.policy_premium LIKE '%".$_POST['search']['value']."%' OR policy_info.policy_ex_date LIKE '%".$_POST['search']['value']."%')", NULL, FALSE);	    
      	}
      	 $this->db->where("policy_info.policy_ex_date >",date("Y-m-d"));
      	 $this->db->order_by("policy_info.policy_ex_date","Asc"); 
  	    //$this->db->order_by("list_of_leads.id","DESC");
  	    $this->db->where("list_of_leads.lead_type", 2);
  	    $this->db->where("list_of_leads.area_incharge",$area_incharge);
  	}
  	
  	public function get_customer_filtered_datas_count_ai($area_incharge)
	{
      	$this->fetch_all_customers_query_ai($area_incharge);
      	$this->db->join("list_of_clients","list_of_leads.client_id = list_of_clients.id");
  	    $this->db->join("type_of_bussiness","list_of_leads.business_type = type_of_bussiness.id");
  	    $this->db->join("list_of_class","list_of_leads.class = list_of_class.id");
  	    $this->db->join("list_of_policy_type","list_of_leads.policy_type = list_of_policy_type.id");
  	    $this->db->join("policy_info","list_of_leads.id = policy_info.lead_id");
  	   $this->db->join("list_of_premium_cover_type","policy_info.policy_premium = list_of_premium_cover_type.id",'left');
      	$res = $this->db->get("list_of_leads");
      	return $res->num_rows();
	}
	
	public function get_all_customer_datas_count_ai($area_incharge)
	{
      	$this->db->select("list_of_leads.id");
      	$this->db->join("list_of_clients","list_of_leads.client_id = list_of_clients.id");
  	    $this->db->join("type_of_bussiness","list_of_leads.business_type = type_of_bussiness.id");
  	    $this->db->join("policy_info","list_of_leads.id = policy_info.lead_id");
  	    $this->db->join("list_of_premium_cover_type","policy_info.policy_premium = list_of_premium_cover_type.id",'left');
  	    $this->db->where("policy_info.policy_ex_date >",date("Y-m-d"));
  	    $this->db->where("list_of_leads.lead_type",2);
  	    $this->db->where("list_of_leads.area_incharge", $area_incharge);
  	    $this->db->order_by("list_of_leads.id","DESC");
      	return $this->db->get("list_of_leads")->num_rows();
	}
	
	// bc
	
	public function fetch_bc_with_area_incharge($area_incharge)
  	{
  	    $this->fetch_all_bc_query_ai($area_incharge);
  	    
  	    if($_POST['length'] != -1)
      	{
        	$this->db->limit($_POST['length'],$_POST['start']);
      	}
      	
        $this->db->join("list_of_clients","list_of_leads.client_id = list_of_clients.id");
  	    $this->db->join("type_of_bussiness","list_of_leads.business_type = type_of_bussiness.id");
  	    $this->db->join("list_of_class","list_of_leads.class = list_of_class.id");
  	    $this->db->join("list_of_policy_type","list_of_leads.policy_type = list_of_policy_type.id");
  	    $this->db->join("temp_policy_info","list_of_leads.id = temp_policy_info.lead_id");
  	    $this->db->join("list_of_premium_cover_type","temp_policy_info.policy_premium = list_of_premium_cover_type.id",'left');
  	    $this->db->order_by("list_of_leads.id","DESC");
  	    return $this->db->get("list_of_leads")->result();
  	}
  	
  	public function fetch_all_bc_query_ai($area_incharge)
  	{
  	 $this->db->select("list_of_leads.*,list_of_clients.client_name,list_of_clients.mobile_no,list_of_clients.other_contact_details,list_of_clients.landline_no,list_of_clients.address,list_of_clients.contact_person_name,list_of_clients.date_of_birth,list_of_clients.age,list_of_clients.area,type_of_bussiness.bussiness_type as b_type,list_of_class.class as lclass,list_of_policy_type.policy_type as p_type,temp_policy_info.policy_no,temp_policy_info.policy_ex_date,temp_policy_info.policy_premium,temp_policy_info.policy_terms,list_of_premium_cover_type.name as pre_name");
  	   if(isset($_POST['search']['value']) && $_POST['search']['value'] != "")
      	{
    		$this->db->where("(list_of_clients.client_name LIKE '%".$_POST['search']['value']."%' OR list_of_clients.mobile_no LIKE '%".$_POST['search']['value']."%' OR list_of_clients.other_contact_details LIKE '%".$_POST['search']['value']."%' OR list_of_clients.landline_no LIKE '%".$_POST['search']['value']."%'  OR list_of_clients.date_of_birth LIKE '%".$_POST['search']['value']."%' OR list_of_clients.age LIKE '%".$_POST['search']['value']."%' OR list_of_clients.area LIKE '%".$_POST['search']['value']."%'  OR list_of_leads.location LIKE '%".$_POST['search']['value']."%' OR list_of_leads.lead_generated_date LIKE '%".$_POST['search']['value']."%' OR list_of_clients.address LIKE '%".$_POST['search']['value']."%' OR list_of_clients.email LIKE '%".$_POST['search']['value']."%' OR type_of_bussiness.bussiness_type LIKE '%".$_POST['search']['value']."%' OR list_of_clients.contact_person_name LIKE '%".$_POST['search']['value']."%' OR list_of_policy_type.policy_type LIKE '%".$_POST['search']['value']."%'  OR list_of_class.class LIKE '%".$_POST['search']['value']."%' OR list_of_clients.contact_person_designation LIKE '%".$_POST['search']['value']."%' OR temp_policy_info.policy_no LIKE '%".$_POST['search']['value']."%' OR temp_policy_info.policy_premium LIKE '%".$_POST['search']['value']."%' OR temp_policy_info.policy_ex_date LIKE '%".$_POST['search']['value']."%')", NULL, FALSE);	    
      	}
  	    $this->db->where("list_of_leads.area_incharge",$area_incharge);
  	    //$this->db->where("list_of_leads.policy_status","1");
		$this->db->where("list_of_leads.lead_type !=","2");
		$this->db->order_by("temp_policy_info.policy_ex_date","Asc");
		//$this->db->order_by("temp_policy_info.id","DESC");
		$this->db->where("temp_policy_info.policy_ex_date >",date("Y-m-d"));
  	}
  	
  	public function get_bc_filtered_datas_count_ai($area_incharge)
	{
      	$this->fetch_all_bc_query_ai($area_incharge);
      	$this->db->join("list_of_clients","list_of_leads.client_id = list_of_clients.id");
  	    $this->db->join("type_of_bussiness","list_of_leads.business_type = type_of_bussiness.id");
  	    $this->db->join("list_of_class","list_of_leads.class = list_of_class.id");
  	    $this->db->join("list_of_policy_type","list_of_leads.policy_type = list_of_policy_type.id");
  	    $this->db->join("temp_policy_info","list_of_leads.id = temp_policy_info.lead_id");
  	   $this->db->join("list_of_premium_cover_type","temp_policy_info.policy_premium = list_of_premium_cover_type.id",'left');
      	$res = $this->db->get("list_of_leads");
      	return $res->num_rows();
	}
	
	public function get_all_bc_datas_count_ai($area_incharge)
	{
      	$this->db->select("list_of_leads.id");
      	$this->db->join("list_of_clients","list_of_leads.client_id = list_of_clients.id");
  	    $this->db->join("type_of_bussiness","list_of_leads.business_type = type_of_bussiness.id");
  	    $this->db->join("temp_policy_info","list_of_leads.id = temp_policy_info.lead_id");
  	    $this->db->join("list_of_premium_cover_type","temp_policy_info.policy_premium = list_of_premium_cover_type.id",'left');
  	     //$this->db->where("list_of_leads.policy_status","1");
  	    $this->db->where("list_of_leads.lead_type !=",2);
  	    $this->db->where("list_of_leads.area_incharge", $area_incharge);
  	    $this->db->where("temp_policy_info.policy_ex_date >",date("Y-m-d"));
      	return $this->db->get("list_of_leads")->num_rows();
	}
	
	// Renewals
	
	
	public function fetch_renewals_with_area_incharge($area_incharge)
  	{
  	    $this->fetch_all_renewals_query_ai($area_incharge);
  	    
  	    if($_POST['length'] != -1)
      	{
        	$this->db->limit($_POST['length'],$_POST['start']);
      	}
      	
        $this->db->join("list_of_clients","list_of_leads.client_id = list_of_clients.id");
  	    $this->db->join("type_of_bussiness","list_of_leads.business_type = type_of_bussiness.id");
  	    $this->db->join("list_of_class","list_of_leads.class = list_of_class.id");
  	    $this->db->join("list_of_policy_type","list_of_leads.policy_type = list_of_policy_type.id");
  	    $this->db->join("policy_info","list_of_leads.id = policy_info.lead_id");
  	     $this->db->join("list_of_premium_cover_type","policy_info.policy_premium = list_of_premium_cover_type.id",'left');
  	    return $this->db->get("list_of_leads")->result();
  	}
  	
  	public function fetch_all_renewals_query_ai($area_incharge)
  	{
  	 $this->db->select("list_of_leads.*,list_of_clients.client_name,list_of_clients.mobile_no,list_of_clients.other_contact_details,list_of_clients.landline_no,list_of_clients.address,list_of_clients.contact_person_name,list_of_clients.date_of_birth,list_of_clients.age,list_of_clients.area,type_of_bussiness.bussiness_type as b_type,list_of_class.class as lclass,list_of_policy_type.policy_type as p_type,policy_info.policy_no,policy_info.policy_ex_date,policy_info.policy_premium,policy_info.policy_terms,list_of_premium_cover_type.name as pre_name");
  	   if(isset($_POST['search']['value']) && $_POST['search']['value'] != "")
      	{
    		$this->db->where("(list_of_clients.client_name LIKE '%".$_POST['search']['value']."%' OR list_of_clients.mobile_no LIKE '%".$_POST['search']['value']."%' OR list_of_clients.other_contact_details LIKE '%".$_POST['search']['value']."%' OR list_of_clients.landline_no LIKE '%".$_POST['search']['value']."%'  OR list_of_clients.date_of_birth LIKE '%".$_POST['search']['value']."%' OR list_of_clients.age LIKE '%".$_POST['search']['value']."%' OR list_of_clients.area LIKE '%".$_POST['search']['value']."%'  OR list_of_leads.location LIKE '%".$_POST['search']['value']."%' OR list_of_leads.lead_generated_date LIKE '%".$_POST['search']['value']."%' OR list_of_clients.address LIKE '%".$_POST['search']['value']."%' OR list_of_clients.email LIKE '%".$_POST['search']['value']."%' OR type_of_bussiness.bussiness_type LIKE '%".$_POST['search']['value']."%' OR list_of_clients.contact_person_name LIKE '%".$_POST['search']['value']."%' OR list_of_policy_type.policy_type LIKE '%".$_POST['search']['value']."%'  OR list_of_class.class LIKE '%".$_POST['search']['value']."%' OR list_of_clients.contact_person_designation LIKE '%".$_POST['search']['value']."%' OR policy_info.policy_no LIKE '%".$_POST['search']['value']."%' OR policy_info.policy_premium LIKE '%".$_POST['search']['value']."%' OR policy_info.policy_ex_date LIKE '%".$_POST['search']['value']."%')", NULL, FALSE);	    
      	}
      	 $this->db->where("policy_info.policy_ex_date <",date("Y-m-d"));
  	    $this->db->order_by("policy_info.policy_ex_date","ASC");
  	    $this->db->where("list_of_leads.lead_type", 2);
  	    $this->db->where("list_of_leads.area_incharge",$area_incharge);
  	}
  	
  	public function get_renewals_filtered_datas_count_ai($area_incharge)
	{
      	$this->fetch_all_renewals_query_ai($area_incharge);
      	$this->db->join("list_of_clients","list_of_leads.client_id = list_of_clients.id");
  	    $this->db->join("type_of_bussiness","list_of_leads.business_type = type_of_bussiness.id");
  	    $this->db->join("list_of_class","list_of_leads.class = list_of_class.id");
  	    $this->db->join("list_of_policy_type","list_of_leads.policy_type = list_of_policy_type.id");
  	    $this->db->join("policy_info","list_of_leads.id = policy_info.lead_id");
  	   $this->db->join("list_of_premium_cover_type","policy_info.policy_premium = list_of_premium_cover_type.id",'left');
      	$res = $this->db->get("list_of_leads");
      	return $res->num_rows();
	}
	
	public function get_all_renewals_datas_count_ai($area_incharge)
	{
      	$this->db->select("list_of_leads.id");
      	$this->db->join("list_of_clients","list_of_leads.client_id = list_of_clients.id");
  	    $this->db->join("type_of_bussiness","list_of_leads.business_type = type_of_bussiness.id");
  	    $this->db->join("policy_info","list_of_leads.id = policy_info.lead_id");
  	    $this->db->join("list_of_premium_cover_type","policy_info.policy_premium = list_of_premium_cover_type.id",'left');
  	    $this->db->where("policy_info.policy_ex_date >",date("Y-m-d"));
  	    $this->db->where("list_of_leads.lead_type",2);
  	    $this->db->where("list_of_leads.area_incharge", $area_incharge);
  	    $this->db->order_by("list_of_leads.id","DESC");
      	return $this->db->get("list_of_leads")->num_rows();
	}
	
	 
	
	
	//
	public function fetch_area_incharge_ai($user_id)
    {
        $this->db->where("id", $user_id);
        $this->db->where("role", "AI");
        $this->db->where("status","active");
        return $this->db->get("admin_login")->result();
    }
    
    public function get_user_district($id)
    {
        $this->db->where("user_id",$id);
        return $this->db->get("user_district")->result();
    }
    
    public function get_region_id_by_district_id($district_id)
    {
        if($district_id != null)
        {
            $this->db->where_in("district_id",$district_id);
            return $this->db->get("list_of_reigion")->result();
        }
        else
        {
            return array();
        }
    }
    
    //
    
    public function agent_business_completed_count_1($id)
    {
        $this->db->select("temp_policy_info.id");
      	$this->db->join("list_of_leads","temp_policy_info.lead_id = list_of_leads.id");
  	    $this->db->join("list_of_clients","list_of_leads.client_id = list_of_clients.id");
  	    $this->db->join("list_of_pos_and_agents","temp_policy_info.policy_agency_pos = list_of_pos_and_agents.id");
  	    $this->db->join("list_of_insurance_company","temp_policy_info.company = list_of_insurance_company.id");
  	    $this->db->join("type_of_bussiness","list_of_leads.business_type = type_of_bussiness.id");
  	    $this->db->join("list_of_class","list_of_leads.class = list_of_class.id");
  	    $this->db->join("list_of_policy_type","list_of_leads.policy_type = list_of_policy_type.id");
  	    $this->db->join("list_of_premium_cover_type","temp_policy_info.policy_premium = list_of_premium_cover_type.id",'left');
  	     $this->db->where("temp_policy_info.policy_agency_pos",$id);
        $this->db->where("temp_policy_info.policy_issue_date >=",date("Y-m-01"));
        $this->db->where("temp_policy_info.policy_issue_date <=",date("Y-m-t"));
        $this->db->where("list_of_leads.lead_type !=","2");
        //$this->db->where("list_of_leads.policy_status","1");
        return $this->db->get("temp_policy_info")->num_rows();
    }
    
    public function agent_active_policy_count($id)
    {
        $this->db->select("policy_info.id");
      	$this->db->join("list_of_leads","policy_info.lead_id = list_of_leads.id");
  	    $this->db->join("list_of_clients","list_of_leads.client_id = list_of_clients.id");
  	    $this->db->join("list_of_pos_and_agents","policy_info.policy_agency_pos = list_of_pos_and_agents.id");
  	    $this->db->join("list_of_insurance_company","policy_info.company = list_of_insurance_company.id");
  	    $this->db->join("type_of_bussiness","list_of_leads.business_type = type_of_bussiness.id");
  	    $this->db->join("list_of_class","list_of_leads.class = list_of_class.id");
  	     $this->db->join("admin_login","admin_login.id = list_of_leads.area_incharge",'left');
  	    $this->db->join("list_of_policy_type","list_of_leads.policy_type = list_of_policy_type.id");
  	    $this->db->join("list_of_premium_cover_type","policy_info.policy_premium = list_of_premium_cover_type.id",'left');
  	    $this->db->where("policy_info.policy_agency_pos",$id);
        $this->db->where("policy_info.policy_issue_date >=",date("Y-m-01"));
        $this->db->where("policy_info.policy_issue_date <=",date("Y-m-t"));
        $this->db->where("list_of_leads.lead_type","2");
  	    $this->db->order_by("policy_info.policy_issue_date","Asc");
  	    return $this->db->get("policy_info")->num_rows();
    }
    
    public function get_bc_tot_no_policy($id,$month,$month_end,$class)
    {
        $this->db->select();
        $this->db->from("temp_policy_info");
        $this->db->join("list_of_leads","list_of_leads.id = temp_policy_info.lead_id");
        
        $this->db->where("temp_policy_info.policy_agency_pos",$id);
        $this->db->where("temp_policy_info.policy_issue_date >=",$month);
        $this->db->where("temp_policy_info.policy_issue_date <=",$month_end);
        $this->db->where("list_of_leads.lead_status !=","completed");
        //$this->db->where("list_of_leads.policy_status","1");
        $this->db->where("list_of_leads.class",$class);
        return $this->db->get()->num_rows();
    }
    
    public function get_active_tot_no_policy($id,$month,$month_end,$class)
    {
        $this->db->select();
        $this->db->from("policy_info");
        $this->db->join("list_of_leads","list_of_leads.id = policy_info.lead_id");
        $this->db->where("policy_info.policy_agency_pos",$id);
        $this->db->where("policy_info.policy_issue_date >=",$month);
        $this->db->where("policy_info.policy_issue_date <=",$month_end);
        $this->db->where("list_of_leads.lead_status","completed");
        $this->db->where("list_of_leads.class",$class);
        return $this->db->get()->num_rows();
    }
    
    
     public function get_bc_tot_policy_sum($id,$month,$month_end)
    {
        $this->db->select_sum("total_premium");
        $this->db->from("temp_policy_info");
        $this->db->join("list_of_leads","list_of_leads.id = temp_policy_info.lead_id");
        $this->db->where("temp_policy_info.policy_agency_pos",$id);
        $this->db->where("temp_policy_info.policy_issue_date >=",$month);
        $this->db->where("temp_policy_info.policy_issue_date <=",$month_end);
        $this->db->where("list_of_leads.lead_status !=","completed");
        //$this->db->where("list_of_leads.policy_status","1");
         $result =  $this->db->get()->row();
        return $result->total_premium;
    }
    
    public function get_active_tot_sum_policy($id,$month,$month_end)
    {
        $this->db->select_sum("total_premium");
        $this->db->from("policy_info");
        $this->db->join("list_of_leads","list_of_leads.id = policy_info.lead_id");
        $this->db->where("policy_info.policy_agency_pos",$id);
        $this->db->where("policy_info.policy_issue_date >=",$month);
        $this->db->where("policy_info.policy_issue_date <=",$month_end);
        $this->db->where("list_of_leads.lead_status","completed");
        $result =  $this->db->get()->row();
        return $result->total_premium;
    }
    
    public function get_agent_details($id)
    {
        $this->db->select("list_of_pos_and_agents.*,list_of_reigion.reigion as regionname");
        $this->db->from("list_of_pos_and_agents");
        $this->db->join("list_of_reigion","list_of_reigion.id = list_of_pos_and_agents.region");
        $this->db->where("list_of_pos_and_agents.id",$id);
        return $this->db->get()->row();
    }
    
    
    //2023-02-06 by kgk
    public function ai_status_dashboard($user_id, $from_date, $to_date, $offset, $limit = 10)
	{
		$sql = "Select * from(
					Select 
						A.*,
						coalesce(B.ai_open_count,0) as ai_open_count,
						coalesce(C.ai_followup_count,0) as ai_followup_count,
						coalesce(D.ai_completed_count,0) as ai_completed_count,
						coalesce(E.ai_business_completed_count,0) as ai_business_completed_count,
						coalesce(F.ai_lost_count,0) as ai_lost_count
					from
					(
						SELECT 
							distinct id, name 
						FROM 
							admin_login
						where 
							id in (".implode(",", $user_id).")";
				$sql .= ")A
					left join 
					(
						select 
							count(*) as ai_open_count,area_incharge 
						from 
							list_of_leads 
						where 
							`lead_status` = 'open' AND `policy_status` != '1'";
						if($from_date != "all" && $from_date != "Noduedate")
						{
							$sql .= " and  due_date >= '".$from_date."'";
						}
						if($to_date != "all" && $to_date != "Noduedate")
						{
							$sql .= " and due_date <= '".$to_date."'";								
						}							
						if($from_date == "Noduedate" && $to_date != "Noduedate")
						{
							$sql .= " and due_date <= '0000-00-00'";									
						}						
				$sql .= " group by area_incharge
					)B on (A.id = B.area_incharge)
					left join 
					(
						select 
							count(*) as ai_followup_count,area_incharge 
						from 
							list_of_leads 
						where 
							`lead_status` = 'followup' AND `policy_status` != '1' ";
							if($from_date != "all" && $from_date != "Noduedate")
							{
								$sql .= " and list_of_leads.next_follow_up_date >= '".$from_date."'";
							}
							if($to_date != "all" && $from_date != "Noduedate")
							{
								$sql .= " and list_of_leads.next_follow_up_date <= '".$to_date."'";
							}
				$sql .= " group by area_incharge
					)C on (A.id = C.area_incharge)
					left join 
					(
						select 
							count(distinct p.id) as ai_completed_count,l.area_incharge 
						from 
							policy_info p, list_of_leads l, list_of_clients c,
							list_of_pos_and_agents ps, list_of_insurance_company ic,
							type_of_bussiness b,list_of_class lc, 
							list_of_policy_type pt, list_of_premium_cover_type pc
						where 
							p.lead_id = l.id and l.client_id = c.id and 
							p.policy_agency_pos = ps.id and p.company = ic.id and
							l.business_type = b.id and l.class = lc.id and 
							l.policy_type = pt.id";
							
							if($from_date != "all" && $from_date != "Noduedate")
							{
								$sql .= " and p.policy_issue_date >= '".$from_date."'";
							}
							if($to_date != "all" && $to_date != "Noduedate")
							{
								$sql .= " and p.policy_issue_date <= '".$to_date."'";
							}
				$sql .= " group by l.area_incharge
					)D on (A.id = D.area_incharge)
					left join 
					(
						select 
							count(*) as ai_business_completed_count,l.area_incharge 
						from 
							temp_policy_info p, list_of_leads l, list_of_clients c,
							list_of_pos_and_agents ps, list_of_insurance_company ic,
							type_of_bussiness b,list_of_class lc, 
							list_of_policy_type pt, list_of_premium_cover_type pc 
						where
							p.lead_id = l.id and l.client_id = c.id and 
							p.policy_agency_pos = ps.id and p.company = ic.id and
							l.business_type = b.id and l.class = lc.id and 
							l.policy_type = pt.id and l.lead_type != '2'";
							if($from_date != "all" && $from_date != "Noduedate")
							{
								$sql .= " and p.policy_issue_date >= '".$from_date."'";
							}
							if($to_date != "all" && $to_date != "Noduedate")
							{
								$sql .= " and p.policy_issue_date <= '".$to_date."'";
							}
				$sql .= " group by l.area_incharge
					)E on (A.id = E.area_incharge)
					left join 
					(
						select 
							count(*) as ai_lost_count,area_incharge 
						from 
							list_of_leads 
						where 
							`lead_status` = 'lost' ";
							if($from_date != "all")
							{
								$sql .= " and created_date >= '".$from_date."'";
							}
							if($to_date != "all")
							{
								$sql .= " and created_date <= '".$to_date."'";
							}
				$sql .= " group by area_incharge
					)F on (A.id = F.area_incharge)
				)A order by ai_open_count desc limit {$offset}, {$limit} ";
		
		return $this->db->query($sql)->result();
		
	}
    
    // 2023-02-04 by kgk
    public function agent_status_dashboard($type, $user_id, $from_date, $to_date, $offset, $limit = 10)
	{
		$sql = "Select * from(
					Select 
						A.*,
						coalesce(B.agent_open_count,0) as agent_open_count,
						coalesce(C.agent_followup_count,0) as agent_followup_count,
						coalesce(D.agent_completed_count,0) as agent_completed_count,
						coalesce(E.agent_business_completed_count,0) as agent_business_completed_count,
						coalesce(F.agent_lost_count,0) as agent_lost_count
					from
					(
						SELECT 
							distinct a.id, a.name 
						FROM 
							list_of_pos_and_agents a, list_of_leads b 
						where 
							a.id = b.agency_and_pos and a.role = '".$type."' and a.status = 'active'";
													       
							if($this->session->userdata("session_role") == "user")
							{
								$sql .= " and a.user_id = '".$user_id."'";
							}
							else if($this->session->userdata("session_role") == "AI")
							{
								$sql .= " and a.area_incharge = '".$this->session->userdata("session_id")."'";
							}							
				$sql .= ")A
					left join 
					(
						select 
							count(*) as agent_open_count,agency_and_pos 
						from 
							list_of_leads 
						where 
							`lead_status` = 'open' AND `list_of_leads`.`policy_status` != '1' AND `list_of_leads`.`lead_status` != 'completed' ";
						if($from_date != "all" && $from_date != "Noduedate")
						{
							$sql .= " and  due_date >= '".$from_date."'";
						}
						if($to_date != "all" && $to_date != "Noduedate")
						{
							$sql .= " and due_date <= '".$to_date."'";								
						}							
						if($from_date == "Noduedate" && $to_date != "Noduedate")
						{
							$sql .= " and due_date <= '0000-00-00'";									
						}						
				$sql .= " group by agency_and_pos
					)B on (A.id = B.agency_and_pos)
					left join 
					(
						select 
							count(*) as agent_followup_count,agency_and_pos 
						from 
							list_of_leads 
						where 
							`lead_status` = 'followup' AND `list_of_leads`.`policy_status` != '1' AND `list_of_leads`.`lead_status` != 'completed' ";
							if($from_date != "all" && $from_date != "Noduedate")
							{
								$sql .= " and list_of_leads.next_follow_up_date >= '".$from_date."'";
							}
							if($to_date != "all" && $from_date != "Noduedate")
							{
								$sql .= " and list_of_leads.next_follow_up_date <= '".$to_date."'";
							}
				$sql .= " group by agency_and_pos
					)C on (A.id = C.agency_and_pos)
					left join 
					(
						select 
							count(*) as agent_completed_count,agency_and_pos 
						from 
							list_of_leads 
						where 
							`lead_status` = 'completed'";
							if($from_date != "all" && $from_date != "Noduedate")
							{
								$sql .= " and created_date >= '".$from_date."'";
							}
							if($to_date != "all" && $to_date != "Noduedate")
							{
								$sql .= " and created_date <= '".$to_date."'";
							}
				$sql .= " group by agency_and_pos
					)D on (A.id = D.agency_and_pos)
					left join 
					(
						select 
							count(*) as agent_business_completed_count,agency_and_pos 
						from 
							list_of_leads where `lead_status` != 'completed' and policy_status = '1'";
							if($from_date != "all" && $from_date != "Noduedate")
							{
								$sql .= " and created_date >= '".$from_date."'";
							}
							if($to_date != "all" && $to_date != "Noduedate")
							{
								$sql .= " and created_date <= '".$to_date."'";
							}
				$sql .= " group by agency_and_pos
					)E on (A.id = E.agency_and_pos)
					left join 
					(
						select 
							count(*) as agent_lost_count,agency_and_pos 
						from 
							list_of_leads 
						where 
							`lead_status` = 'lost' ";
							if($from_date != "all")
							{
								$sql .= " and created_date >= '".$from_date."'";
							}
							if($to_date != "all")
							{
								$sql .= " and created_date <= '".$to_date."'";
							}
				$sql .= " group by agency_and_pos
					)F on (A.id = F.agency_and_pos)
				)A order by agent_open_count desc limit {$offset}, {$limit} ";
		
		return $this->db->query($sql)->result();
		
	}
	
	// renewals info count by ageny 
	public function renewals_status_dashboard($type, $user_id, $from_date, $to_date, $offset, $limit = 10)
	{
		$sql = "Select * from(
					Select 
						A.*,
						coalesce(B.renewals_count,0) as renewals_count						
					from
					(
						SELECT 
							distinct a.id, a.name 
						FROM 
							list_of_pos_and_agents a, list_of_leads b 
						where 
							a.id = b.agency_and_pos and a.role = '".$type."' and a.status = 'active'";
													       
							if($this->session->userdata("session_role") == "user")
							{
								$sql .= " and a.user_id = '".$user_id."'";
							}
							else if($this->session->userdata("session_role") == "AI")
							{
								$sql .= " and a.area_incharge = '".$this->session->userdata("session_id")."'";
							}							
				$sql .= ")A
					left join 
					(
						select 
							count(*) as renewals_count,agency_and_pos 
						from 
							list_of_leads 
						where 
							lead_type != '2' and policy_status != '1' and 
							due_date between '".$from_date."' and '".$to_date."'  
						group by agency_and_pos
					)B on (A.id = B.agency_and_pos) 
				)A Where coalesce(renewals_count,0) > 0 order by renewals_count desc limit {$offset}, {$limit}";
					
		
		return $this->db->query($sql)->result();
		
	}
	
	// renewals info count by duedate
	public function getRenewalsCountByDuedate($user_id, $from_date, $to_date, $searchCol, $searchVal)
	{
/*	    
	    $sql = "select 
					count(*) as renewals_count,due_date , lead_status
				from 
					list_of_leads 
				where 
					lead_type != '2' and policy_status != '1' and 
					lead_status in ('open', 'lost') and due_date != '0000-00-00' and
					due_date between '".$from_date."' and '".$to_date."'  
					and id in (
					    SELECT 
							distinct b.id
						FROM 
							list_of_pos_and_agents a, list_of_leads b 
						where 
							a.id = b.agency_and_pos and a.status = 'active'";
													       
							if($this->session->userdata("session_role") == "user")
							{
								$sql .= " and a.user_id = '".$user_id."'";
							}
							else if($this->session->userdata("session_role") == "AI")
							{
								$sql .= " and a.area_incharge = '".$this->session->userdata("session_id")."'";
							}
		$sql .= "   )
		        group by due_date,lead_status";
		        
		        
		$sql .= " union all ";
		
		$sql .= "select 
					count(*) as renewals_count,created_date, 'new' as lead_status 
				from 
					list_of_leads 
				where 
					lead_type != '2' and policy_status != '1' and
					due_date = '0000-00-00' and
					created_date between '".$from_date."' and '".$to_date."'  
					and id in (
					    SELECT 
							distinct b.id
						FROM 
							list_of_pos_and_agents a, list_of_leads b 
						where 
							a.id = b.agency_and_pos and a.status = 'active'";
													       
							if($this->session->userdata("session_role") == "user")
							{
								$sql .= " and a.user_id = '".$user_id."'";
							}
							else if($this->session->userdata("session_role") == "AI")
							{
								$sql .= " and a.area_incharge = '".$this->session->userdata("session_id")."'";
							}
		$sql .= "   )
		        group by created_date";
*/		

        $sql = "Select 
					* 
				from(
					select 
						count(l.id) as count,policy_ex_date as date, c.class, 'due' as type 
					from 
						policy_info p, list_of_leads l,list_of_class c 
					where 
						p.lead_id = l.id and l.class = c.id and 
						p.policy_ex_date between '".$from_date."' and '".$to_date."'  
						and l.id in (
							SELECT 
								distinct b.id
							FROM 
								list_of_pos_and_agents a, list_of_leads b 
							where 
								a.id = b.agency_and_pos and a.status = 'active'";
															   
								if($this->session->userdata("session_role") == "user")
								{
									$sql .= " and a.user_id = '".$user_id."'";
								}
								else if($this->session->userdata("session_role") == "AI")
								{
									$sql .= " and a.area_incharge = '".$this->session->userdata("session_id")."'";
								}
			$sql .= "   ) ";
			if( $searchCol == "agents_pos" ){
			    $sql .= " and l.agency_and_pos = ".$searchVal;
			}elseif( $searchCol == "users" ){
			    $sql .= " and l.assigned_user = ".$searchVal;
			}elseif( $searchCol == "ai" ){
			    $sql .= " and l.area_incharge = ".$searchVal;
			}
			$sql .= " group by policy_ex_date, c.class";
						
			$sql .= " union all ";

			$sql .= "select 
						count(l.id) as count, due_date as date,c.class, 'lost' as type 
					from 
						list_of_leads l,list_of_class c 
					where 
						l.class = c.id and lead_status = 'lost' and 
						due_date between '".$from_date."' and '".$to_date."'
						and l.id in (
							SELECT 
								distinct b.id
							FROM 
								list_of_pos_and_agents a, list_of_leads b 
							where 
								a.id = b.agency_and_pos and a.status = 'active'";
															   
								if($this->session->userdata("session_role") == "user")
								{
									$sql .= " and a.user_id = '".$user_id."'";
								}
								else if($this->session->userdata("session_role") == "AI")
								{
									$sql .= " and a.area_incharge = '".$this->session->userdata("session_id")."'";
								}
								
						
			$sql .= "   ) ";
			if( $searchCol == "agents_pos" ){
			    $sql .= " and l.agency_and_pos = ".$searchVal;
			}elseif( $searchCol == "users" ){
			    $sql .= " and l.assigned_user = ".$searchVal;
			}elseif( $searchCol == "ai" ){
			    $sql .= " and l.area_incharge = ".$searchVal;
			}
			$sql .= " group by due_date, c.class";		
			

			$sql .= " union all ";

			$sql .= "select 
						count(l.id) as count, date(created_date) as date,c.class, 'new' as type 
					from 
						list_of_leads l,list_of_class c 
					where 
						l.class = c.id and lead_status = 'open' and lead_type != '2' and 
						date(created_date) between '".$from_date."' and '".$to_date."' 
						and l.id in (
							SELECT 
								distinct b.id
							FROM 
								list_of_pos_and_agents a, list_of_leads b 
							where 
								a.id = b.agency_and_pos and a.status = 'active'";
															   
								if($this->session->userdata("session_role") == "user")
								{
									$sql .= " and a.user_id = '".$user_id."'";
								}
								else if($this->session->userdata("session_role") == "AI")
								{
									$sql .= " and a.area_incharge = '".$this->session->userdata("session_id")."'";
								}
								
            $sql .= "   ) ";
			if( $searchCol == "agents_pos" ){
			    $sql .= " and l.agency_and_pos = ".$searchVal;
			}elseif( $searchCol == "users" ){
			    $sql .= " and l.assigned_user = ".$searchVal;
			}elseif( $searchCol == "ai" ){
			    $sql .= " and l.area_incharge = ".$searchVal;
			}
			$sql .= " group by date(created_date), c.class
			     )A order by date";									
			     
			
					
		 return $this->db->query($sql)->result();
	
	}
	
	// renewals details by duedate by kgk on 2023-02-13
	public function getRenewalsDetailsByDuedate($user_id, $from_date, $to_date, $type, $class,$searchCol, $searchVal)
	{
/*	    
	    $sql = "select 
	                l.*, client_name,mobile_no,area,pt.policy_type as policy_type_name,
	                t.bussiness_type
	            from 
	                list_of_leads l, list_of_clients c, list_of_policy_type pt,
	                type_of_bussiness t
	            where 
	                l.client_id = c.id and l.policy_type = pt.id and 
	                l.business_type = t.id and 
	                lead_type != '2' and policy_status != '1' and 
					lead_status in ('open', 'lost') and 
	                due_date between '".$from_date."' and '".$to_date."'";
	    $sql .= " union all ";
	    
	    $sql .= "select 
	                l.*, client_name,mobile_no,area,'' as policy_type_name,
	                '' as bussiness_type
	            from 
	                list_of_leads l, list_of_clients c
	            where 
	                l.client_id = c.id and 
	                lead_type != '2' and policy_status != '1' and 
					due_date = '0000-00-00' and 
	                created_date between '".$from_date."' and '".$to_date."'";
*/		

        $sql = "Select 
					* 
				From (
					select 
						client_name,mobile_no,area,pt.policy_type as policy_type_name,
						t.bussiness_type,policy_no,policy_ex_date as date, c.class, 'due' as type,a.user_id,a.area_incharge  
					from 
						policy_info p, list_of_leads l,list_of_class c,list_of_clients cl,list_of_policy_type pt, type_of_bussiness t,list_of_pos_and_agents a  
					where 	
						p.lead_id = l.id and l.class = c.id and l.client_id = cl.id and l.policy_type = pt.id and l.business_type = t.id and a.id = l.agency_and_pos and
						p.policy_ex_date between '".$from_date."' and '".$to_date."' ";
						
			if( $searchCol == "agents_pos" ){
			    $sql .= " and l.agency_and_pos = ".$searchVal;
			}elseif( $searchCol == "users" ){
			    $sql .= " and l.assigned_user = ".$searchVal;
			}elseif( $searchCol == "ai" ){
			    $sql .= " and l.area_incharge = ".$searchVal;
			}

			$sql .= " union all ";

			$sql .= "select 
						client_name,mobile_no,area,pt.policy_type as policy_type_name,
						t.bussiness_type,(select policy_no from policy_info where lead_id = l.id) as policy_no, due_date as date,c.class, 'lost' as type,a.user_id,a.area_incharge
						
					from 
						list_of_leads l,list_of_class c ,list_of_clients cl,list_of_policy_type pt, type_of_bussiness t,list_of_pos_and_agents a
					where 
						l.class = c.id and l.client_id = cl.id and l.policy_type = pt.id and l.business_type = t.id and lead_status = 'lost' and a.id = l.agency_and_pos and
						due_date between '".$from_date."' and '".$to_date."' ";

            if( $searchCol == "agents_pos" ){
			    $sql .= " and l.agency_and_pos = ".$searchVal;
			}elseif( $searchCol == "users" ){
			    $sql .= " and l.assigned_user = ".$searchVal;
			}elseif( $searchCol == "ai" ){
			    $sql .= " and l.area_incharge = ".$searchVal;
			}
			$sql .= " union all ";

			$sql .= "select 
						client_name,mobile_no,area,pt.policy_type as policy_type_name,
						t.bussiness_type, null as policy_no,date(l.created_date) as date,c.class, 'new' as type,a.user_id,a.area_incharge  
					from 
						list_of_leads l,list_of_class c,list_of_clients cl,list_of_policy_type pt, type_of_bussiness t,list_of_pos_and_agents a 
					where 
						l.class = c.id and lead_status = 'open' and lead_type != '2' and l.client_id = cl.id and l.policy_type = pt.id and l.business_type = t.id and a.id = l.agency_and_pos and
						date(l.created_date) between '".$from_date."' and '".$to_date."' ";
		if( $searchCol == "agents_pos" ){
		    $sql .= " and l.agency_and_pos = ".$searchVal;
		}elseif( $searchCol == "users" ){
		    $sql .= " and l.assigned_user = ".$searchVal;
		}elseif( $searchCol == "ai" ){
		    $sql .= " and l.area_incharge = ".$searchVal;
		}

		$sql .= " )A where 1 = 1";

		if( $type ) {
			$sql .= " and type = '".$type."'";
		}

		if( $class ) {
			$sql .= " and class = '".$class."'";
		}
		
		if($this->session->userdata("session_role") == "user")
		{
			$sql .= " and user_id = '".$user_id."'";
		}
		else if($this->session->userdata("session_role") == "AI")
		{
			$sql .= " and area_incharge = '".$this->session->userdata("session_id")."'";
		}

		$sql .= " order by date";
		return $this->db->query($sql)->result();
		
	}
}