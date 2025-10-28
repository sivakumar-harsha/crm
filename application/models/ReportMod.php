<?php  
class ReportMod extends CI_Model  
{  
  	function __construct()  
  	{ 
    	parent::__construct();  
    	$this->load->dbforge();
  	}

    public function add_clients_data($data)
    {
        $this->db->insert("list_of_clients",$data);
        $insert_id = $this->db->insert_id();
        return  $insert_id;
    }
    
    public function add_lead_details($arr)
    {
         $this->db->insert("list_of_leads",$arr);
    }
    
    public function fetch_agent_using_type($agent_type)
    {
        $this->db->select("list_of_pos_and_agents.*,admin_login.name as ai_name,list_of_reigion.reigion as region_name");
         $this->db->from("list_of_pos_and_agents");
         $this->db->join("admin_login","admin_login.id = list_of_pos_and_agents.area_incharge");
         $this->db->join("list_of_reigion","list_of_reigion.id = list_of_pos_and_agents.region");
         $this->db->where("list_of_pos_and_agents.role",$agent_type);
  	    return $this->db->get()->result();
    }
    
    // commission 
    
    public function fetch_generate_policy($from_date,$to_date,$select_agents,$select_insurance, $user = '')
	{
	    $this->db->distinct(); 
      	$this->db->select("policy_info.id,policy_info.lead_id,company_payout_commission.id as com_id,company_payout_commission.no_of_policy_id,policy_info.agent_commission_amt,policy_info.agent_commission,policy_info.own_commission_amt,policy_info.own_commission,policy_info.agent_commission_amt,policy_info.policy_agency_pos,list_of_leads.business_type,policy_info.policy_premium,list_of_leads.class,policy_info.company,policy_info.gst,policy_info.policy_s_date,policy_info.policy_ex_date,list_of_premium_cover_type.name as policy_premium_name,type_of_bussiness.bussiness_type as business_name,list_of_class.class as class_name,list_of_policy_type.policy_type,policy_info.total_own_damage,policy_info.tot_liability_premium,policy_info.basic_tp,policy_info.total_premium,policy_info.policy_no,list_of_clients.client_name,list_of_clients.mobile_no,list_of_pos_and_agents.agent_pos_code,list_of_insurance_company.company_name,company_payout_commission.commission_type,company_payout_commission.net_premium_id, admin_login.name as user");
      	$this->db->join("list_of_leads","policy_info.lead_id = list_of_leads.id");
  	    $this->db->join("list_of_clients","list_of_leads.client_id = list_of_clients.id");
  	    $this->db->join("list_of_pos_and_agents","policy_info.policy_agency_pos = list_of_pos_and_agents.id");
  	    $this->db->join("list_of_insurance_company","policy_info.company = list_of_insurance_company.id");
  	    $this->db->join("type_of_bussiness","list_of_leads.business_type = type_of_bussiness.id");
  	    $this->db->join("list_of_class","list_of_leads.class = list_of_class.id");
  	    $this->db->join("list_of_policy_type","list_of_leads.policy_type = list_of_policy_type.id");
  	    $this->db->join("list_of_premium_cover_type","policy_info.policy_premium = list_of_premium_cover_type.id",'left');
  	    $this->db->join("company_payout_commission","company_payout_commission.id = policy_info.commission_id", 'left');
  	    
  	    $this->db->join("admin_login","admin_login.id = list_of_leads.assigned_user");
  	    
      	$this->db->where("policy_info.commission_status !=","1");
    //   	$this->db->where("policy_info.cancel_policy_status","0");
        $this->db->where_not_in("policy_info.cancel_policy_status",["1", "2"]);
      	$this->db->where("list_of_leads.lead_type","2");
      	//$this->db->where("policy_info.policy_no","32760519202200");
      	$this->db->where("policy_info.policy_issue_date >=",$from_date);
      	$this->db->where("policy_info.policy_issue_date <=",$to_date);
      	
      	if($select_agents != "")
      	{
      	$this->db->where("policy_info.policy_agency_pos",$select_agents);
      	}
      	
      	if($select_insurance != "")
      	{
      	$this->db->where("policy_info.company",$select_insurance);
      	}
      	
      	if($user)
      	    $this->db->where("list_of_leads.assigned_user", $user);
      	    
      	return $this->db->get("policy_info")->result();
	}
	
	public function fetch_generate_policy_class($from_date, $to_date, $select_agents, $select_insurance, $select_class, $user = '')
    {
        $this->db->distinct(); 
        $this->db->select("policy_info.id,policy_info.lead_id,company_payout_commission.id as com_id,company_payout_commission.no_of_policy_id,policy_info.agent_commission_amt,policy_info.agent_commission,policy_info.own_commission_amt,policy_info.own_commission,policy_info.agent_commission_amt,policy_info.policy_agency_pos,list_of_leads.business_type,policy_info.policy_premium,list_of_leads.class,policy_info.company,policy_info.gst,policy_info.policy_s_date,policy_info.policy_ex_date,list_of_premium_cover_type.name as policy_premium_name,type_of_bussiness.bussiness_type as business_name,list_of_class.class as class_name,list_of_policy_type.policy_type,policy_info.total_own_damage,policy_info.tot_liability_premium,policy_info.basic_tp,policy_info.total_premium,policy_info.policy_no,list_of_clients.client_name,list_of_clients.mobile_no,list_of_pos_and_agents.agent_pos_code,list_of_insurance_company.company_name,company_payout_commission.commission_type,company_payout_commission.net_premium_id, admin_login.name as user");

        $this->db->join("list_of_leads", "policy_info.lead_id = list_of_leads.id");
        $this->db->join("list_of_clients", "list_of_leads.client_id = list_of_clients.id");
        $this->db->join("list_of_pos_and_agents", "policy_info.policy_agency_pos = list_of_pos_and_agents.id");
        $this->db->join("list_of_insurance_company", "policy_info.company = list_of_insurance_company.id");
        $this->db->join("type_of_bussiness", "list_of_leads.business_type = type_of_bussiness.id");
        $this->db->join("list_of_class", "list_of_leads.class = list_of_class.id");
        $this->db->join("list_of_policy_type", "list_of_leads.policy_type = list_of_policy_type.id");
        $this->db->join("list_of_premium_cover_type", "policy_info.policy_premium = list_of_premium_cover_type.id", 'left');
        $this->db->join("company_payout_commission", "company_payout_commission.id = policy_info.commission_id", 'left');
        $this->db->join("admin_login", "admin_login.id = list_of_leads.assigned_user");

        $this->db->where("policy_info.commission_status !=", "1");
        $this->db->where_not_in("policy_info.cancel_policy_status", ["1", "2"]);
        $this->db->where("list_of_leads.lead_type", "2");
        $this->db->where("policy_info.policy_issue_date >=", $from_date);
        $this->db->where("policy_info.policy_issue_date <=", $to_date);

        if ($select_class != "" && $select_class != 3) {
            $this->db->where("list_of_leads.class", $select_class);
        }

        if ($select_agents != "") {
            $this->db->where("policy_info.policy_agency_pos", $select_agents);
        }

        if ($select_insurance != "") {
            $this->db->where("policy_info.company", $select_insurance);
        }

        if ($user) {
            $this->db->where("list_of_leads.assigned_user", $user);
        }

        return $this->db->get("policy_info")->result();
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
  	    $this->db->select("payout_commission.id,payout_commission.commission_type,payout_commission.on_net,payout_commission.irdi_commission,payout_commission.own_od,payout_commission.own_tp,payout_commission.bronze_category,payout_commission.silver_category,payout_commission.gold_category");
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
  	
  	public function fetch_ledger_orc($id,$type)
  	{
  	     $this->db->where("lead_id",$id);
  	     $this->db->where($type,"acc21");
          return $this->db->get("acc_commission_ledger_orc")->row();
  	}
  	public function insert_ledger_data($data)
  	{
  	    $this->db->insert("acc_commission_ledger_orc",$data);
  	}
  	public function fetch_agent_tot_amount_policy($id)
  	{
  	    $this->db->where("policy_agency_pos",$id);
  	    $res = $this->db->get("policy_info")->result();
  	    
  	    $total = 0;
  	    
  	    foreach($res as $r)
  	    {
  	        $total = $total + $r->total_premium;
  	    }
  	    return $total;
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
  	
  	public function fetch_health_commission_type($policy_premium,$company)
  	{
  	    $this->db->where("class",2);
  	    $this->db->where("policy_premium_type",$policy_premium);
  	    $this->db->where("insurer_company",$company);
  	    return $this->db->get("payout_commission")->row();
  	}
  	
  	
  	// fix commission
  	
  	
  	public function fetch_generate_policy_by_id($policy_arr)
	{
      	$this->db->select("policy_info.id,policy_info.policy_agency_pos,list_of_leads.business_type,policy_info.policy_premium,list_of_leads.class,policy_info.company,policy_info.gst,policy_info.policy_s_date,policy_info.policy_ex_date,list_of_premium_cover_type.name as policy_premium_name,type_of_bussiness.bussiness_type as business_name,list_of_class.class as class_name,list_of_policy_type.policy_type,policy_info.total_own_damage,policy_info.basic_tp,policy_info.total_premium,policy_info.policy_no,policy_info.commission_id,list_of_clients.client_name,list_of_clients.mobile_no,list_of_pos_and_agents.agent_pos_code,list_of_insurance_company.company_name,company_payout_commission.commission_type");
      	$this->db->join("list_of_leads","policy_info.lead_id = list_of_leads.id");
  	    $this->db->join("list_of_clients","list_of_leads.client_id = list_of_clients.id");
  	    $this->db->join("list_of_pos_and_agents","policy_info.policy_agency_pos = list_of_pos_and_agents.id");
  	    $this->db->join("list_of_insurance_company","policy_info.company = list_of_insurance_company.id");
  	    $this->db->join("type_of_bussiness","list_of_leads.business_type = type_of_bussiness.id");
  	    $this->db->join("list_of_class","list_of_leads.class = list_of_class.id");
  	    $this->db->join("list_of_policy_type","list_of_leads.policy_type = list_of_policy_type.id");
  	    $this->db->join("list_of_premium_cover_type","policy_info.policy_premium = list_of_premium_cover_type.id");
  	    $this->db->join("company_payout_commission","company_payout_commission.id = policy_info.commission_id");
      	$this->db->where("policy_info.commission_status !=","1");
      	$this->db->where_in("policy_info.id",$policy_arr);
      	return $this->db->get("policy_info")->result();
	}
	
   public function update_agent_commission($data,$id)
   {
       $this->db->where("id",$id);
       $this->db->update("policy_info",$data);
   }    
   
   public function fetch_all_agents_list()
   {
       return $this->db->select('id,name,agent_pos_code')->order_by('trim(name)', 'asc')->get("list_of_pos_and_agents")->result();
   }
   
   public function fetch_all_insurances_list()
   {
       return $this->db->get("list_of_insurance_company")->result();
   }
   
   public function fetch_agent_commission_report($from_date,$to_date,$agent_id)
   {
        $this->db->select("policy_info.id,policy_info.policy_agency_pos,list_of_leads.business_type,policy_info.policy_premium,list_of_leads.class,policy_info.company,policy_info.gst,policy_info.policy_s_date,policy_info.policy_ex_date,list_of_premium_cover_type.name as policy_premium_name,policy_info.commission_id,type_of_bussiness.bussiness_type as business_name,list_of_class.class as class_name,list_of_policy_type.policy_type,policy_info.total_own_damage,policy_info.basic_tp,policy_info.total_premium,policy_info.policy_no,list_of_clients.client_name,list_of_clients.mobile_no,list_of_pos_and_agents.agent_pos_code,list_of_insurance_company.company_name,company_payout_commission.commission_type,company_payout_commission.net_premium_id");
      	$this->db->join("list_of_leads","policy_info.lead_id = list_of_leads.id");
  	    $this->db->join("list_of_clients","list_of_leads.client_id = list_of_clients.id");
  	    $this->db->join("list_of_pos_and_agents","policy_info.policy_agency_pos = list_of_pos_and_agents.id");
  	    $this->db->join("list_of_insurance_company","policy_info.company = list_of_insurance_company.id");
  	    $this->db->join("type_of_bussiness","list_of_leads.business_type = type_of_bussiness.id");
  	    $this->db->join("list_of_class","list_of_leads.class = list_of_class.id");
  	    $this->db->join("list_of_policy_type","list_of_leads.policy_type = list_of_policy_type.id");
  	    $this->db->join("list_of_premium_cover_type","policy_info.policy_premium = list_of_premium_cover_type.id");
  	      $this->db->join("company_payout_commission","company_payout_commission.id = policy_info.commission_id");
      	$this->db->where("policy_info.commission_status","1");
      	$this->db->where("policy_info.created_date >=",$from_date);
      	$this->db->where("policy_info.created_date <=",$to_date);
      	$this->db->where("policy_info.policy_agency_pos",$agent_id);
      	return $this->db->get("policy_info")->result();
   }
   
   public function get_agent_code($from_date,$to_date)
   {
       $this->db->select("policy_info.*,list_of_pos_and_agents.agent_pos_code");
       $this->db->from("policy_info");
       $this->db->join("list_of_pos_and_agents","policy_info.policy_agency_pos = list_of_pos_and_agents.id");
       $this->db->group_by('policy_info.policy_agency_pos'); 
       $this->db->where("policy_info.commission_status","1");
       $this->db->where("policy_info.created_date >=",$from_date);
       $this->db->where("policy_info.created_date <=",$to_date);
       return $this->db->get()->result();
   }
   
   public function get_single_agent_code($agent_id)
   {
       $this->db->where("id",$agent_id);
       return $this->db->get("list_of_pos_and_agents")->row();
   }
   
   
   // vocher 
   
   public function fetch_single_agent_commission_report($from_date,$to_date,$agent_id)
   { 
       $this->db->select("policy_info.id,policy_info.agent_commission_amt,policy_info.agn_add_com,policy_info.policy_agency_pos,list_of_leads.business_type,policy_info.policy_premium,list_of_leads.class,policy_info.company,policy_info.gst,policy_info.policy_s_date,policy_info.policy_ex_date,list_of_premium_cover_type.name as policy_premium_name,type_of_bussiness.bussiness_type as business_name,list_of_class.class as class_name,list_of_policy_type.policy_type,policy_info.total_own_damage,policy_info.basic_tp,policy_info.total_premium,policy_info.policy_no,list_of_clients.client_name,list_of_clients.mobile_no,list_of_pos_and_agents.agent_pos_code,list_of_insurance_company.company_name");
      	$this->db->join("list_of_leads","policy_info.lead_id = list_of_leads.id");
  	    $this->db->join("list_of_clients","list_of_leads.client_id = list_of_clients.id");
  	    $this->db->join("list_of_pos_and_agents","policy_info.policy_agency_pos = list_of_pos_and_agents.id");
  	    $this->db->join("list_of_insurance_company","policy_info.company = list_of_insurance_company.id");
  	    $this->db->join("type_of_bussiness","list_of_leads.business_type = type_of_bussiness.id");
  	    $this->db->join("list_of_class","list_of_leads.class = list_of_class.id");
  	    $this->db->join("list_of_policy_type","list_of_leads.policy_type = list_of_policy_type.id");
  	    $this->db->join("list_of_premium_cover_type","policy_info.policy_premium = list_of_premium_cover_type.id",'left');
      //	$this->db->where("policy_info.commission_status","1");
      	$this->db->where("policy_info.vocher_status","0");
      	
      	if($from_date !="")
      	{
          	$this->db->where("policy_info.policy_issue_date >=",$from_date);
      	    $this->db->where("policy_info.policy_issue_date <=",$to_date);
      	}
      	
      	$this->db->where("policy_info.policy_agency_pos",$agent_id);
      	return $this->db->get("policy_info")->result();
   }
   
   
     public function fetch_single_agent_commission_report_orc($from_date,$to_date,$agent_id)
   {
       $this->db->select("policy_info.id,policy_info.agn_add_com,policy_info.agent_commission,policy_info.additional_commission,policy_info.policy_agency_pos,list_of_leads.business_type,policy_info.policy_premium,list_of_leads.class,policy_info.company,policy_info.gst,policy_info.policy_s_date,policy_info.policy_ex_date,list_of_premium_cover_type.name as policy_premium_name,type_of_bussiness.bussiness_type as business_name,list_of_class.class as class_name,list_of_policy_type.policy_type,policy_info.total_own_damage,policy_info.basic_tp,policy_info.total_premium,policy_info.policy_no,list_of_clients.client_name,list_of_clients.mobile_no,list_of_pos_and_agents.agent_pos_code,list_of_insurance_company.company_name");
      	$this->db->join("list_of_leads","policy_info.lead_id = list_of_leads.id");
  	    $this->db->join("list_of_clients","list_of_leads.client_id = list_of_clients.id");
  	    $this->db->join("list_of_pos_and_agents","policy_info.policy_agency_pos = list_of_pos_and_agents.id");
  	    $this->db->join("list_of_insurance_company","policy_info.company = list_of_insurance_company.id");
  	    $this->db->join("type_of_bussiness","list_of_leads.business_type = type_of_bussiness.id");
  	    $this->db->join("list_of_class","list_of_leads.class = list_of_class.id");
  	    $this->db->join("list_of_policy_type","list_of_leads.policy_type = list_of_policy_type.id");
  	    $this->db->join("list_of_premium_cover_type","policy_info.policy_premium = list_of_premium_cover_type.id",'left');
      	//$this->db->where("policy_info.commission_status","1");
      	$this->db->where("policy_info.vocher_status","0");
      	
      	if($from_date !="")
      	{
          	$this->db->where("policy_info.policy_issue_date >=",$from_date);
      	    $this->db->where("policy_info.policy_issue_date <=",$to_date);
      	}
      	
      	$this->db->where("policy_info.policy_agency_pos",$agent_id);
      	return $this->db->get("policy_info")->result();
   }
   
   public function randomcheck($randomString)
   {
       $this->db->where("vocher_no",$randomString);
       $query=$this->db->get("policy_info")->num_rows();
       
       if($query > 0)
        {
            return false;
        }
        else
        {
            return true;
        }
   }
   
   public function update_vocher_details($data,$id)
   {
       $this->db->where("id",$id);
       $this->db->update("policy_info",$data);
       
       $this->db->where("id",$id);
       return $this->db->get("policy_info")->row();
   }
   
   public function _update_vocher_details($data,$id)
   {
    //   $this->db->where("id",$id);
    //   $this->db->update("policy_info",$data);
       
       $this->db->where("id",$id);
       return $this->db->get("policy_info")->row();
   }
   
   public function getPolicyByID($id)
   {
       $this->db->where("id",$id);
       return $this->db->get("policy_info")->row();
   }
   
   // company details 
   
   public function get_company_details()
   {
       return $this->db->get("company_settings")->row();
   }
   
   public function fetch_agent_vocher($policy_id)
   {
        $this->db->select("policy_info.id,policy_info.policy_issue_date,policy_info.agent_commission_amt,policy_info.agn_add_com,policy_info.created_at,policy_info.policy_agency_pos,list_of_leads.business_type,policy_info.policy_premium,list_of_leads.class,policy_info.company,policy_info.gst,policy_info.policy_s_date,policy_info.policy_ex_date,list_of_premium_cover_type.name as policy_premium_name,type_of_bussiness.bussiness_type as business_name,list_of_class.class as class_name,list_of_policy_type.policy_type,policy_info.total_own_damage,policy_info.basic_tp,policy_info.total_premium,policy_info.policy_no,list_of_clients.client_name,list_of_clients.mobile_no,list_of_pos_and_agents.agent_pos_code,list_of_insurance_company.company_name");
      	$this->db->join("list_of_leads","policy_info.lead_id = list_of_leads.id");
  	    $this->db->join("list_of_clients","list_of_leads.client_id = list_of_clients.id");
  	    $this->db->join("list_of_pos_and_agents","policy_info.policy_agency_pos = list_of_pos_and_agents.id");
  	    $this->db->join("list_of_insurance_company","policy_info.company = list_of_insurance_company.id");
  	    $this->db->join("type_of_bussiness","list_of_leads.business_type = type_of_bussiness.id");
  	    $this->db->join("list_of_class","list_of_leads.class = list_of_class.id");
  	    $this->db->join("list_of_policy_type","list_of_leads.policy_type = list_of_policy_type.id");
  	    $this->db->join("list_of_premium_cover_type","policy_info.policy_premium = list_of_premium_cover_type.id",'left');
      	$this->db->where("policy_info.commission_status","1");
      	$this->db->where("list_of_leads.lead_type","2");
      	$this->db->where("policy_info.vocher_status","1");
      	$this->db->where("policy_info.id",$policy_id);
      	return $this->db->get("policy_info")->result();
   }
   
   public function get_vocher_no()
   {
      return $this->db->get("vocher_series")->num_rows();
   }
   
   
   public function vocher_no_already_exits($new_vocher_no)
   {
        $this->db->where("vocher_no",$new_vocher_no);
  		$num = $this->db->get("vocher_series")->num_rows();
  		
  		if($num > 0)
  		{
  		    return true;
  		}
  		else
  		{
  		    $data = array(
  		        "vocher_no" => $new_vocher_no,
  		        );
  		    $this->db->insert("vocher_series",$data);
  		    return false;
        }
   }
   
   public function add_agent_voucher_details($data)
   {
       $this->db->insert("agent_voucher_details",$data);
   }
   
   public function add_agent_voucher_details_orc($data)
   {
       $this->db->insert("agent_voucher_details_orc",$data);
   }
   
   public function getCompanyByInvoice() {
       $sql = "select * from list_of_insurance_company where id in (select distinct trim(insurer_id) from insurance_voucher_datails) order by trim(company_name) asc";
       
       $Q = $this->db->query($sql);
       return $Q->result();
       
   }
   public function getMaxAgentVouchar()
   {
       $sql = "select from_date, to_date from agent_voucher_details where id in (select max(id) from agent_voucher_details)";
       
       $Q = $this->db->query($sql);
       return $Q->row();
   }
   
   public function getAgentByVouchar($from_date, $to_date)
   {
    //   return $this->db->select('a.id, a.name,a.agent_pos_code,b.voucher_no')->from('list_of_pos_and_agents a')->where('b.agent_id = a.id')->get("agent_voucher_details b")->result();
       
       $sql = "select id, name, agent_pos_code from list_of_pos_and_agents where 
                id in (select agent_id from agent_voucher_details where 
                from_date >= '".$from_date."' and to_date <= '".$to_date."') order by name asc";
       
       $Q = $this->db->query($sql);
       return $Q->result();
   }
   
   public function update_tds_log($data)
   {
       $this->db->insert("tds_log",$data);
   }
   
   // agent voucher
   
   public function fetch_bank_list()
   {
       return $this->db->get("list_of_bank_name")->result();
   }
   
//   public function fetch_agent_vocher_orc($agents)
//     {
//         $this->db->select("SUM(agent_commission) AS ac,policy_info.Vocher_no,policy_info.vocher_date,policy_info.policy_agency_pos");
//       	$this->db->where("policy_info.commission_status","1");
//       	$this->db->where("policy_info.pay_status","0");
//       	$this->db->where("policy_info.vocher_status","1");
//       	$this->db->group_by("policy_info.vocher_no");
      	
//       	if($agents != "all")
//       	{
//       	    $this->db->where("policy_info.policy_agency_pos",$agents);
//       	}
      	
//       	return $this->db->get("policy_info")->result();
//   }
   
   
   public function fetch_agent_vocher_orc($policy_id)
   {
        $this->db->select("policy_info.id,policy_info.policy_issue_date,policy_info.agent_commission,policy_info.created_at,policy_info.policy_agency_pos,list_of_leads.business_type,policy_info.policy_premium,list_of_leads.class,policy_info.company,policy_info.gst,policy_info.policy_s_date,policy_info.policy_ex_date,list_of_premium_cover_type.name as policy_premium_name,type_of_bussiness.bussiness_type as business_name,list_of_class.class as class_name,list_of_policy_type.policy_type,policy_info.total_own_damage,policy_info.basic_tp,policy_info.total_premium,policy_info.policy_no,list_of_clients.client_name,list_of_clients.mobile_no,list_of_pos_and_agents.agent_pos_code,list_of_insurance_company.company_name");
      	$this->db->join("list_of_leads","policy_info.lead_id = list_of_leads.id");
  	    $this->db->join("list_of_clients","list_of_leads.client_id = list_of_clients.id");
  	    $this->db->join("list_of_pos_and_agents","policy_info.policy_agency_pos = list_of_pos_and_agents.id");
  	    $this->db->join("list_of_insurance_company","policy_info.company = list_of_insurance_company.id");
  	    $this->db->join("type_of_bussiness","list_of_leads.business_type = type_of_bussiness.id");
  	    $this->db->join("list_of_class","list_of_leads.class = list_of_class.id");
  	    $this->db->join("list_of_policy_type","list_of_leads.policy_type = list_of_policy_type.id");
  	    $this->db->join("list_of_premium_cover_type","policy_info.policy_premium = list_of_premium_cover_type.id",'left');
      	$this->db->where("policy_info.commission_status","1");
      	$this->db->where("list_of_leads.lead_type","2");
      	$this->db->where("policy_info.vocher_status","1");
      	$this->db->where("policy_info.id",$policy_id);
      	return $this->db->get("policy_info")->result();
   }
   
   
   public function fetch_agent_vouchers($agents)
   {
        $this->db->select("SUM(agent_commission_amt) AS ac,SUM(agn_add_com) As add_com,policy_info.Vocher_no,policy_info.vocher_date,policy_info.policy_agency_pos");
      	$this->db->where("policy_info.commission_status","1");
      	$this->db->where("policy_info.pay_status","0");
      	$this->db->where("policy_info.vocher_status","1");
      	$this->db->group_by("policy_info.vocher_no");
      	
      	if($agents != "all")
      	{
      	    $this->db->where("policy_info.policy_agency_pos",$agents);
      	}
      	
      	return $this->db->get("policy_info")->result();
   }
   
   public function fetch_agent_vouchers_list($agents,$f_date,$to_date)
   {
        $this->db->select("SUM(agent_commission_amt) AS ac,SUM(tds) AS tc,SUM(agn_add_com) As add_com,policy_info.Vocher_no,policy_info.vocher_date,policy_info.policy_agency_pos");
      	$this->db->where("policy_info.commission_status","1");
      	$this->db->where("policy_info.pay_status","0");
      	$this->db->where("policy_info.vocher_status","1");
      	$this->db->group_by("policy_info.vocher_no,policy_info.vocher_date,policy_info.policy_agency_pos");
      
      	if($agents != "all")
      	{
      	    $this->db->where("policy_info.policy_agency_pos",$agents);
      	}
      	if($f_date != "" &&  $to_date != "")
      	{
      	    $this->db->where("policy_info.vocher_date >=",$f_date);
      	    $this->db->where("policy_info.vocher_date <=",$to_date);
      	}
      	
      	return $this->db->get("policy_info")->result();
      //	return $this->db->get_compiled_select("policy_info");
   }
   
   
   public function fetch_agent_advance_list()
   {
       $this->db->select("agent_pos_advance.*,list_of_pos_and_agents.name as agn_name,list_of_pos_and_agents.agent_pos_code");
       $this->db->from("agent_pos_advance");
       $this->db->join("list_of_pos_and_agents","agent_pos_advance.agent_id = list_of_pos_and_agents.id");
       $this->db->group_by('agent_pos_advance.agent_id'); 
       return $this->db->get()->result();
   }
   
   public function fetch_advance_debit_amount_by_agent_id($agent_id)
   {
       $this->db->select("SUM(amount)AS debit_tot");
       $this->db->from("agent_pos_advance");
       $this->db->where("agent_id",$agent_id);
       $this->db->where("type","debit");
       return $this->db->get()->row();
   }
   public function fetch_advance_credit_amount_by_agent_id($agent_id)
   {
       $this->db->select("SUM(amount)AS credit_tot");
       $this->db->from("agent_pos_advance");
       $this->db->where("agent_id",$agent_id);
       $this->db->where("type","credit");
       return $this->db->get()->row();
   }
   
   public function get_voucher_total($voucher_no)
   {
       $this->db->select("agent_commission_amt as ac,agn_add_com as agn_add_com_amt");
       $this->db->from("policy_info");
       $this->db->where_in("vocher_no",$voucher_no);
       	$this->db->where("policy_info.commission_status","1");
      	$this->db->where("policy_info.pay_status","0");
      	$this->db->where("policy_info.vocher_status","1");
       return $this->db->get()->result();
   }
   
   
   public function get_voucher_total_1($voucher_no)
   {
       if($voucher_no != null || $voucher_no != "")
       {
          $this->db->select("total_commission as ac");
           $this->db->from("agent_voucher_details");
           $this->db->where_in("voucher_no",$voucher_no);
           return $this->db->get()->result();
       }
       else
       {
           return array();
       }
       
   }
   
  public function get_agent_id($vocher_no)
  {
        $this->db->select("policy_agency_pos,agent_commission_amt as ac,agn_add_com as agn_add_com_amt");
        $this->db->from("policy_info");
        $this->db->where_in("vocher_no",$vocher_no);
       	$this->db->where("policy_info.commission_status","1");
      	$this->db->where("policy_info.pay_status","0");
        $this->db->where("policy_info.vocher_status","1");
       return $this->db->get()->result();
  }
   
   public function add_agn_payment_entry($data)
   {
       $this->db->insert("agent_payment_details",$data);
       $insert_id = $this->db->insert_id();
       return $insert_id;
   }
   
   public function update_pay_status($data,$vocher_no)
   {
       $this->db->where("vocher_no",$vocher_no);
       $this->db->update("policy_info",$data);
   }
   
   
   public function get_policy_cover_type()
   {
       return $this->db->get("list_of_premium_cover_type")->result();
   }
   
   // active policy report
   
   public function fetch_active_policy_report($ins_company,$select_class,$select_c_type,$from_date,$to_date)
   { 
        $this->db->select("policy_info.id,policy_info.policy_issue_date,policy_info.tot_liability_premium,policy_info.com_add_com,policy_info.agn_add_com,policy_info.own_commission_amt,policy_info.agent_commission_amt,policy_info.own_commission,policy_info.agent_commission,policy_info.commission_status,policy_info.policy_agency_pos,list_of_leads.business_type,policy_info.policy_premium,list_of_leads.class,policy_info.company,policy_info.gst,policy_info.policy_s_date,policy_info.policy_ex_date,list_of_premium_cover_type.name as policy_premium_name,type_of_bussiness.bussiness_type as business_name,list_of_class.class as class_name,list_of_policy_type.policy_type,policy_info.total_own_damage,policy_info.basic_tp,policy_info.total_premium,policy_info.policy_no,list_of_clients.client_name,list_of_clients.mobile_no,list_of_pos_and_agents.agent_pos_code,list_of_pos_and_agents.name as agn_name,list_of_insurance_company.company_name,list_of_insurance_company.short_name as ins_short_name,admin_login.name as ai_name,Is.name as assigned_user");
      	$this->db->join("list_of_leads","policy_info.lead_id = list_of_leads.id");
  	    $this->db->join("list_of_clients","list_of_leads.client_id = list_of_clients.id");
  	    $this->db->join("list_of_pos_and_agents","policy_info.policy_agency_pos = list_of_pos_and_agents.id");
  	    $this->db->join("list_of_insurance_company","policy_info.company = list_of_insurance_company.id");
  	    $this->db->join("type_of_bussiness","list_of_leads.business_type = type_of_bussiness.id");
  	    $this->db->join("list_of_class","list_of_leads.class = list_of_class.id");
  	    $this->db->join("admin_login","admin_login.id = list_of_leads.area_incharge",'left');
  	    $this->db->join("admin_login Is","Is.id = list_of_leads.assigned_user",'left');
  	    $this->db->join("list_of_policy_type","list_of_leads.policy_type = list_of_policy_type.id");
  	    $this->db->join("list_of_premium_cover_type","policy_info.policy_premium = list_of_premium_cover_type.id","left");
  	    
  	    if($this->session->userdata("session_role") == "AI")
  	    {
  	        $this->db->where("list_of_leads.area_incharge",$this->session->userdata("session_id"));
  	    }
  	 else if($this->session->userdata("session_role") == "user")
  	    {
  	        $this->db->where("list_of_leads.assigned_user",$this->session->userdata("session_id"));
  	        $this->db->where("policy_info.policy_user",$this->session->userdata("session_id"));
  	    }
  	    if($ins_company != "all")
  	    {
  	        $this->db->where("policy_info.company",$ins_company);
  	    }
  	    if($select_class != "all")
  	    {
  	        $this->db->where("list_of_leads.class",$select_class);
  	    }
  	    if($select_c_type != "all")
  	    {
  	        $this->db->where("policy_info.policy_premium",$select_c_type);
  	    }
  	    if($from_date != "all")
  	    {
  	        $this->db->where("policy_info.policy_issue_date >=",$from_date);
  	    }
  	    if($to_date != "all")
  	    {
  	        $this->db->where("policy_info.policy_issue_date <=",$to_date);
  	    }
  	    $this->db->where("list_of_leads.lead_type","2");
  	    $this->db->where("policy_info.cancel_policy_status","0");
  	    //$this->db->where("policy_info.policy_ex_date >",date("Y-m-d"));
  	    return $this->db->get("policy_info")->result();
   }
   
   //Invoice
   public function get_insurance_company_list()
   {
       return $this->db->get("list_of_insurance_company")->result();
   }
   
  
   public function get_insurance_company($insurance)
   {
    $this->db->where("id",$insurance);
    return $this->db->get("list_of_insurance_company")->row();
   }
   
    public function get_single_insurance_company($insurance)
   {
       $this->db->where("insurer_id",$insurance);
       return $this->db->get("account_tree")->row();
   }
   
   // comment by kgk on 2023-05-09
   public function _fetch_single_insurance_company_invoice($code,$from_date,$to_date,$policy_class, $policy_gen_from)
   {
    $this->db->select("acc_commission_ledger.id,list_of_policy_type.policy_type,acc_commission_ledger.credit,policy_info.lead_id");   
    $this->db->where("dr_parent_id",$code); 
    $this->db->where("is_invoice_generated",'0'); 
    
    if($policy_class)
        $this->db->where("list_of_leads.class",$policy_class);
        
  	$this->db->where("policy_info.{$policy_gen_from} >=",$from_date);
    $this->db->where("policy_info.{$policy_gen_from} <=",$to_date);
    $this->db->join("list_of_leads","acc_commission_ledger.lead_id = list_of_leads.id");
    $this->db->join("list_of_policy_type","list_of_leads.policy_type = list_of_policy_type.id");
    $this->db->join("policy_info","acc_commission_ledger.lead_id = policy_info.lead_id");
    $this->db->join("account_tree","acc_commission_ledger.dr_parent_id = account_tree.vchaccid");
    
    $this->db->where("policy_info.company_vocher_status","0");
    return $this->db->get("acc_commission_ledger")->result();
   }
   
   public function fetch_single_insurance_company_invoice($code,$from_date,$to_date,$policy_class, $policy_gen_from, $insurance = '', $status = '')
   {
    $this->db->select("acc_commission_ledger.id,list_of_policy_type.policy_type,acc_commission_ledger.credit,policy_info.lead_id");   
    $this->db->where("dr_parent_id",$code); 
    $this->db->where("is_invoice_generated",'0');
    
    if($policy_class)
        $this->db->where("list_of_leads.class",$policy_class);
    
  	$this->db->where("policy_info.{$policy_gen_from} >=",$from_date);
    $this->db->where("policy_info.{$policy_gen_from} <=",$to_date);
    
    $this->db->join("list_of_leads","acc_commission_ledger.lead_id = list_of_leads.id");
    $this->db->join("list_of_policy_type","list_of_leads.policy_type = list_of_policy_type.id");
    $this->db->join("policy_info","acc_commission_ledger.lead_id = policy_info.lead_id");
    $this->db->join("account_tree","acc_commission_ledger.dr_parent_id = account_tree.vchaccid");
    
    $this->db->where("policy_info.company_vocher_status","0");
    $this->db->where("policy_info.invoice_prepared","Y");
    
    //$status = "N";
    if($status == "N") {
        $this->db->where("policy_info.lead_id not in (select lead_id from insurance_voucher_datails where invoice_revision_id in (select max(ir.id) from invoice_revision ir, invoice i where i.id and ir.invoice_id and i.fromdate = '{$from_date}' and i.todate = '{$to_date}' and i.insurance_company_id = '{$insurance}'))", NULL, FALSE);
    }
    return $this->db->get("acc_commission_ledger")->result();
   }
   
   // comment by kgk on 2023-05-09
  public function _fetch_single_insurance_company_invoice_acc($code,$from_date,$to_date,$policy_class,$policy_gen_from) 
  {
     $this->db->select("acc_commission_ledger_orc.id,list_of_policy_type.policy_type,acc_commission_ledger_orc.credit,policy_info.lead_id");   
    $this->db->where("dr_parent_id",$code); 
    $this->db->where("is_invoice_generated",'0'); 
    
    if($policy_class)
        $this->db->where("list_of_leads.class",$policy_class);
        
  	$this->db->where("policy_info.{$policy_gen_from} >=",$from_date); 
    $this->db->where("policy_info.{$policy_gen_from} <=",$to_date);
    $this->db->join("list_of_leads","acc_commission_ledger_orc.lead_id = list_of_leads.id");
    $this->db->join("list_of_policy_type","list_of_leads.policy_type = list_of_policy_type.id");
    $this->db->join("policy_info","acc_commission_ledger_orc.lead_id = policy_info.lead_id");
    $this->db->join("account_tree","acc_commission_ledger_orc.dr_parent_id = account_tree.vchaccid");
    $this->db->where("policy_info.company_vocher_status","0");
    return $this->db->get("acc_commission_ledger_orc")->result();
  }
  
  public function fetch_single_insurance_company_invoice_acc($code,$from_date,$to_date,$policy_class,$policy_gen_from, $insurance = '', $status = '') 
  {
     $this->db->select("acc_commission_ledger_orc.id,list_of_policy_type.policy_type,acc_commission_ledger_orc.credit,policy_info.lead_id");   
    $this->db->where("dr_parent_id",$code); 
    $this->db->where("is_invoice_generated",'0'); 
    
    if($policy_class)
        $this->db->where("list_of_leads.class",$policy_class);
    
  	$this->db->where("policy_info.{$policy_gen_from} >=",$from_date); 
    $this->db->where("policy_info.{$policy_gen_from} <=",$to_date);
    
    $this->db->join("list_of_leads","acc_commission_ledger_orc.lead_id = list_of_leads.id");
    $this->db->join("list_of_policy_type","list_of_leads.policy_type = list_of_policy_type.id");
    $this->db->join("policy_info","acc_commission_ledger_orc.lead_id = policy_info.lead_id");
    $this->db->join("account_tree","acc_commission_ledger_orc.dr_parent_id = account_tree.vchaccid");
    $this->db->where("policy_info.company_vocher_status","0");
    $this->db->where("policy_info.invoice_prepared","Y");
    if($status == "N") {
        $this->db->where("policy_info.lead_id not in (select lead_id from insurance_voucher_datails_orc where invoice_orc_revision_id in (select max(ir.id) from invoice_orc_revision ir, invoice_orc i where i.id and ir.invoice_orc_id and i.fromdate = '{$from_date}' and i.todate = '{$to_date}' and i.insurance_company_id = '{$insurance}'))", NULL, FALSE);
    }
    return $this->db->get("acc_commission_ledger_orc")->result();
  }
     
  	public function fetch_list_of_class()
  	{
  	    return $this->db->get("list_of_class")->result();
  	}      
   
   public function get_class_list()
   {
       return $this->db->get("list_of_class")->result();
   }
   
   public function get_policy_type($class)
   {
       $this->db->where("policy_class",$class);
       $this->db->where("status !=","1");
       return $this->db->get("list_of_policy_type")->result();
   }
   
   public function get_net_premium_id($net_id)
   {
        $this->db->where("net_premium_id",$net_id);
        return $this->db->get("company_payout_commission")->result();
   }
   
   public function get_policy_id($total_premium,$net_premium_id)
   {
       $this->db->where("net_premium_id",$net_premium_id);
        $this->db->where("min_val <=",$total_premium);
       $this->db->where("max_val >=",$total_premium);
        return $this->db->get("company_payout_commission")->row();
   }
   
   public function get_total_premium($id)
   {
       $this->db->where("company_payout_commission.net_premium_id",$id);
       $this->db->join("company_payout_commission","policy_info.commission_id = company_payout_commission.id");
       return $this->db->get("policy_info")->result();
   }
   
   public function getTotalPremium($id)
   {
       $this->db->where("company_payout_commission.id",$id);
       $this->db->join("company_payout_commission","policy_info.commission_id = company_payout_commission.id");
       return $this->db->get("policy_info")->result();
   }
   
   public function fetch_commission_id($from_date,$to_date)
   {
        $this->db->where("from_date >=",$from_date);
        $this->db->where("to_date >=",$to_date);
        return $this->db->get("company_payout_commission")->result();
   }
   
   public function fetch_agent_category($id)
  	{
  	    $this->db->where("id",$id);
  	    return $this->db->get("list_of_pos_and_agents")->row();
  	}
   
   public function update_additional_commissions($id,$data)
   {
       $this->db->where("id",$id);
       $this->db->update("policy_info",$data);
       return true;
   }
   
   //nop
   public function get_no_of_policy_id($net_id)
   {
        $this->db->where("no_of_policy_id",$net_id);
        return $this->db->get("company_payout_commission")->result();
   }
   
   public function get_total_policy($id)
   {
       $this->db->where("commission_id",$id);
       return $this->db->get("policy_info")->result();
   }
   
   public function fetch_all_leads($order_category)
   {
        $this->db->select("list_of_leads.*,vechile_details.vechi_register_no,list_of_clients.client_name,list_of_clients.mobile_no,list_of_clients.other_contact_details,list_of_clients.landline_no,list_of_clients.address,list_of_clients.contact_person_name,list_of_clients.date_of_birth,list_of_clients.age,list_of_clients.area,type_of_bussiness.bussiness_type as b_type,list_of_class.class as lclass,list_of_policy_type.policy_type as p_type");
       	$this->db->join("list_of_clients","list_of_leads.client_id = list_of_clients.id");
  	    $this->db->join("type_of_bussiness","list_of_leads.business_type = type_of_bussiness.id");
  	    $this->db->join("list_of_class","list_of_leads.class = list_of_class.id");
  	    $this->db->join("list_of_policy_type","list_of_leads.policy_type = list_of_policy_type.id");
  	    $this->db->join("vechile_details","vechile_details.lead_id = list_of_leads.id",'left');
  	    
  	    if($order_category == "upcoming")
  	    {
  	        $this->db->where("list_of_leads.due_date >=",date("Y-m-d"));
  	        $this->db->where("list_of_leads.due_date !=","0000-00-00");
  	        $this->db->order_by("list_of_leads.due_date","asc");
  	    }
  	    else if($order_category == "overdue")
  	    {
  	        $this->db->where("list_of_leads.due_date <",date("Y-m-d"));
  	        $this->db->where("list_of_leads.due_date !=","0000-00-00");
  	        $this->db->order_by("list_of_leads.due_date","desc");
  	    }
  	    else
  	    {
  	        $this->db->where("list_of_leads.due_date","0000-00-00");
  	        $this->db->order_by("list_of_leads.id","desc");
  	    }
  	    
  	    $this->db->where("lead_type !=","2");
  	    return $this->db->get("list_of_leads")->result();
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
   
   public function get_area_incharge($id)
   {
        $this->db->where("id",$id);
        return $this->db->get("admin_login")->row();
   }
   
   public function get_agent_bank_details($agent)
   {
       $this->db->where("id",$agent);
       return $this->db->get("list_of_pos_and_agents")->row();
   }
  
   public function add_agent_vocher_payment($data_1)
   {
       $this->db->insert("agent_vocher_payment",$data_1);
   }
   
 /*  public function fetch_agent_payment_details($agent,$policy_no,$voucher_no)
   {
       $this->db->select("agent_payment_details.*,agent_vocher_payment.vocher_no,list_of_pos_and_agents.name,list_of_pos_and_agents.agent_pos_code,admin_login.name as created_by");
       $this->db->from("agent_payment_details");
       $this->db->join("agent_vocher_payment","agent_payment_details.id = agent_vocher_payment.payment_id");
       $this->db->join("list_of_pos_and_agents","list_of_pos_and_agents.id = agent_payment_details.agent_id");
       $this->db->group_by('agent_vocher_payment.payment_id'); 
       $this->db->join("admin_login","admin_login.id = agent_payment_details.created_by");
       $this->db->join("policy_info","policy_info.vocher_no = agent_vocher_payment.vocher_no");
       
       if($agent != "All")
       {
         $this->db->where("agent_payment_details.agent_id",$agent);
       }
       if($policy_no != "")
       {
           $this->db->where("policy_info.policy_no",$policy_no);
       }
       if($voucher_no != "")
       {
           $this->db->where("agent_vocher_payment.vocher_no",$voucher_no);
       }
       $this->db->order_by('transaction_date','Desc');
       return $this->db->get()->result();
   }
   */
   
   public function fetch_agent_payment_details($agent, $policy_no, $voucher_no)
{
    $this->db->select("
        agent_payment_details.id,
        agent_payment_details.transaction_date,
        agent_payment_details.type,
        agent_payment_details.agent_commission,
        agent_payment_details.tds,
        agent_vocher_payment.vocher_no,
        list_of_pos_and_agents.name,
        list_of_pos_and_agents.agent_pos_code,
        admin_login.name as created_by
    ");
    $this->db->from("agent_payment_details");
    $this->db->join("agent_vocher_payment", "agent_payment_details.id = agent_vocher_payment.payment_id");
    $this->db->join("list_of_pos_and_agents", "list_of_pos_and_agents.id = agent_payment_details.agent_id");
    $this->db->join("admin_login", "admin_login.id = agent_payment_details.created_by");
    $this->db->join("policy_info", "policy_info.vocher_no = agent_vocher_payment.vocher_no");

    if ($agent != "All") {
        $this->db->where("agent_payment_details.agent_id", $agent);
    }
    if ($policy_no != "") {
        $this->db->where("policy_info.policy_no", $policy_no);
    }
    if ($voucher_no != "") {
        $this->db->where("agent_vocher_payment.vocher_no", $voucher_no);
    }

    // Adjust GROUP BY clause to include all selected columns
    $this->db->group_by([
        "agent_payment_details.id",
        "agent_payment_details.transaction_date",
        "agent_payment_details.type",
        "agent_payment_details.agent_commission",
        "agent_payment_details.tds",
        "agent_vocher_payment.vocher_no",
        "list_of_pos_and_agents.name",
        "list_of_pos_and_agents.agent_pos_code",
        "admin_login.name"
    ]);

    $this->db->order_by('agent_payment_details.transaction_date', 'DESC');
    return $this->db->get()->result();
}

   
   public function fetch_agents_list()
   {
       return $this->db->get("list_of_pos_and_agents")->result();
   }
   
   public function fetch_area_incharge_list()
   {
       $this->db->where("role","AI");
       return $this->db->get("admin_login")->result();
   }
   
   public function fetch_users_list($userid = '')
   {
       $this->db->where("role","user");
       if($userid) $this->db->where('id', $userid);
       return $this->db->get("admin_login")->result();
   }
   
   public function get_agent_vocher_details($id)
   {
       $this->db->select("agent_payment_details.*,list_of_pos_and_agents.name,list_of_pos_and_agents.agent_pos_code,admin_login.name as area_incharge,list_of_pos_and_agents.region,list_of_pos_and_agents.region");
       $this->db->from("agent_payment_details");
       $this->db->join("list_of_pos_and_agents","list_of_pos_and_agents.id = agent_payment_details.agent_id");
       $this->db->join("admin_login","admin_login.id = list_of_pos_and_agents.area_incharge");
       $this->db->where("agent_payment_details.id",$id);
       return $this->db->get()->row();
   }
   
   public function get_region($region_id)
   {
       $this->db->where("id",$region_id);
       return $this->db->get("list_of_reigion")->row();
   }
   
   public function get_voucher_no_by_payment_id($id)
   {
       $this->db->where("payment_id",$id);
       return $this->db->get("agent_vocher_payment")->result();
   }
   
   public function get_voucher_total_amount($voucher_no)
   {
       if($voucher_no != null)
       {
            $this->db->select("vocher_no,SUM(agent_commission_amt) as ac,SUM(agn_add_com) as agn_add_com_amt,SUM(tds) as tc");
            $this->db->from("policy_info");
            $this->db->where_in("vocher_no",$voucher_no);
            $this->db->where("policy_info.commission_status","1");
            $this->db->where("policy_info.pay_status","1");
            $this->db->where("policy_info.vocher_status","1");
            $this->db->group_by('vocher_no'); 
            return $this->db->get()->result();
       }
       else
       {
           return array();
       }
   }
   
   public function fetch_agent_voucher_details($vocher_no)
   {
        $this->db->select("policy_info.id,policy_info.agent_commission_amt,policy_info.agn_add_com,policy_info.created_at,policy_info.policy_agency_pos,list_of_leads.business_type,policy_info.policy_premium,list_of_leads.class,policy_info.company,policy_info.gst,policy_info.policy_s_date,policy_info.policy_ex_date,list_of_premium_cover_type.name as policy_premium_name,type_of_bussiness.bussiness_type as business_name,list_of_class.class as class_name,list_of_policy_type.policy_type,policy_info.total_own_damage,policy_info.basic_tp,policy_info.total_premium,policy_info.policy_no,list_of_clients.client_name,list_of_clients.mobile_no,list_of_pos_and_agents.agent_pos_code,list_of_insurance_company.company_name");
      	$this->db->join("list_of_leads","policy_info.lead_id = list_of_leads.id");
  	    $this->db->join("list_of_clients","list_of_leads.client_id = list_of_clients.id");
  	    $this->db->join("list_of_pos_and_agents","policy_info.policy_agency_pos = list_of_pos_and_agents.id");
  	    $this->db->join("list_of_insurance_company","policy_info.company = list_of_insurance_company.id");
  	    $this->db->join("type_of_bussiness","list_of_leads.business_type = type_of_bussiness.id");
  	    $this->db->join("list_of_class","list_of_leads.class = list_of_class.id");
  	    $this->db->join("list_of_policy_type","list_of_leads.policy_type = list_of_policy_type.id");
  	    $this->db->join("list_of_premium_cover_type","policy_info.policy_premium = list_of_premium_cover_type.id",'left');
      	$this->db->where("policy_info.commission_status","1");
      	$this->db->where("policy_info.vocher_status","1");
      	//$this->db->where("policy_info.pay_status","1");
      	$this->db->where("policy_info.vocher_no",$vocher_no);
      	return $this->db->get("policy_info")->result();
   }
   
   public function get_agent_details_by_vocher_no($vocher_no)
   {
       $this->db->where("vocher_no",$vocher_no);
       return $this->db->get("policy_info")->row();
   }
   
   public function add_advance_amount($data)
  	{
  	    $this->db->insert("agent_pos_advance",$data);
  	}
  	
  public function fetch_business_complete_report($ins_company,$select_class,$policy_type,$agent,$from_date,$to_date,$area_incharge,$user)
   { 
        $this->db->select("policy_info.id,policy_info.tot_liability_premium,policy_info.own_commission,policy_info.agent_commission,policy_info.lead_id,policy_info.policy_issue_date,policy_info.com_add_com,policy_info.agn_add_com,policy_info.own_commission_amt,policy_info.agent_commission_amt,policy_info.commission_status,policy_info.policy_agency_pos,list_of_leads.business_type,policy_info.policy_premium,list_of_leads.class,list_of_leads.assigned_user,policy_info.company,policy_info.gst,policy_info.policy_s_date,policy_info.policy_ex_date,list_of_premium_cover_type.name as policy_premium_name,type_of_bussiness.bussiness_type as business_name,list_of_class.class as class_name,list_of_policy_type.policy_type,policy_info.total_own_damage,policy_info.basic_tp,policy_info.total_premium,policy_info.policy_no,list_of_clients.client_name,list_of_clients.mobile_no,list_of_pos_and_agents.agent_pos_code,list_of_pos_and_agents.name as agn_name,list_of_insurance_company.company_name,list_of_insurance_company.short_name as ins_short_name,admin_login.name as ai_name,vechile_details.vechi_cc,vechile_details.vechi_gvw,vechile_details.vechi_register_no,list_of_policy_type.policy_type as p_type");
      	$this->db->join("list_of_leads","policy_info.lead_id = list_of_leads.id");
  	    $this->db->join("list_of_clients","list_of_leads.client_id = list_of_clients.id");
  	    $this->db->join("list_of_pos_and_agents","policy_info.policy_agency_pos = list_of_pos_and_agents.id");
  	    $this->db->join("list_of_insurance_company","policy_info.company = list_of_insurance_company.id");
  	    $this->db->join("type_of_bussiness","list_of_leads.business_type = type_of_bussiness.id");
  	    $this->db->join("list_of_class","list_of_leads.class = list_of_class.id");
  	     $this->db->join("admin_login","admin_login.id = list_of_leads.area_incharge",'left');
  	    $this->db->join("list_of_policy_type","list_of_leads.policy_type = list_of_policy_type.id");
  	    $this->db->join("list_of_premium_cover_type","policy_info.policy_premium = list_of_premium_cover_type.id",'left');
  	    $this->db->join("vechile_details","vechile_details.lead_id = list_of_leads.id",'left');
        if($this->session->userdata("session_role") == "AI")
        {
        	$this->db->where("list_of_leads.area_incharge",$this->session->userdata("session_id"));
        }

  	    if($ins_company != "All")
  	    {
  	        $this->db->where("policy_info.company",$ins_company);
  	    }
  	    if($select_class != "All")
  	    {
  	        $this->db->where("list_of_leads.class",$select_class);
  	    }
  	    if($policy_type != "All")
  	    {
  	        $this->db->where("list_of_leads.policy_type",$policy_type);
  	    }
  	    if($from_date != "All" || $from_date != "")
  	    {
  	        $this->db->where("policy_info.policy_issue_date >=",$from_date);
  	    }
  	    if($to_date != "All" || $to_date != "")
  	    {
  	       $this->db->where("policy_info.policy_issue_date <=",$to_date);
  	    }
  	    if($agent != "All")
  	    {
  	      $this->db->where("policy_info.policy_agency_pos",$agent);
  	    }
  	    if($area_incharge != "All")
  	    {
  	         $this->db->where("list_of_leads.area_incharge",$area_incharge);
  	    }
  	    if($user != "All")
  	    {
  	         $this->db->where("list_of_leads.assigned_user",$user);
  	    }
  	    //$this->db->where("policy_info.policy_ex_date >",date("Y-m-d"));
  	    $this->db->order_by("policy_info.policy_issue_date","Asc");
  	    $this->db->where("list_of_leads.lead_type","2");
  	    return $this->db->get("policy_info")->result();
   }
  	
   public function fetch_generate_policy_report($ins_company,$select_class,$policy_type,$agent,$from_date,$to_date,$area_incharge,$user)
   { 
        $this->db->select("temp_policy_info.id,temp_policy_info.tot_liability_premium,temp_policy_info.lead_id,temp_policy_info.policy_issue_date,temp_policy_info.com_add_com,temp_policy_info.agn_add_com,temp_policy_info.own_commission_amt,temp_policy_info.agent_commission_amt,temp_policy_info.own_commission,temp_policy_info.agent_commission,temp_policy_info.commission_status,temp_policy_info.policy_agency_pos,list_of_leads.business_type,temp_policy_info.policy_premium,list_of_leads.class,list_of_leads.assigned_user,temp_policy_info.company,temp_policy_info.gst,temp_policy_info.policy_s_date,temp_policy_info.policy_ex_date,list_of_premium_cover_type.name as policy_premium_name,type_of_bussiness.bussiness_type as business_name,list_of_class.class as class_name,list_of_policy_type.policy_type,temp_policy_info.total_own_damage,temp_policy_info.basic_tp,temp_policy_info.total_premium,temp_policy_info.policy_no,list_of_clients.client_name,list_of_clients.mobile_no,list_of_pos_and_agents.agent_pos_code,list_of_pos_and_agents.name as agn_name,list_of_insurance_company.company_name,list_of_insurance_company.short_name as ins_short_name,admin_login.name as ai_name,vechile_details.vechi_cc,vechile_details.vechi_gvw,vechile_details.vechi_register_no,list_of_policy_type.policy_type as p_type");
      	$this->db->join("list_of_leads","temp_policy_info.lead_id = list_of_leads.id");
  	    $this->db->join("list_of_clients","list_of_leads.client_id = list_of_clients.id");
  	    $this->db->join("list_of_pos_and_agents","temp_policy_info.policy_agency_pos = list_of_pos_and_agents.id");
  	    $this->db->join("list_of_insurance_company","temp_policy_info.company = list_of_insurance_company.id");
  	    $this->db->join("type_of_bussiness","list_of_leads.business_type = type_of_bussiness.id");
  	    $this->db->join("list_of_class","list_of_leads.class = list_of_class.id");
  	    $this->db->join("list_of_policy_type","list_of_leads.policy_type = list_of_policy_type.id");
  	    $this->db->join("list_of_premium_cover_type","temp_policy_info.policy_premium = list_of_premium_cover_type.id",'left');
  	    
  	    $this->db->join("admin_login","admin_login.id = list_of_leads.area_incharge",'left');
  	    $this->db->join("vechile_details","vechile_details.lead_id = list_of_leads.id",'left');

  	     if($this->session->userdata("session_role") == "AI")
        {
        	$this->db->where("list_of_leads.area_incharge",$this->session->userdata("session_id"));
        }
  	    if($ins_company != "All")
  	    {
  	        $this->db->where("temp_policy_info.company",$ins_company);
  	    }
  	    if($select_class != "All")
  	    {
  	        $this->db->where("list_of_leads.class",$select_class);
  	    }
  	    if($policy_type != "All")
  	    {
  	        $this->db->where("list_of_leads.policy_type",$policy_type);
  	    }
  	    if($from_date != "All")
  	    {
  	        $this->db->where("temp_policy_info.policy_issue_date >=",$from_date);
  	    }
  	    if($to_date != "All")
  	    {
  	        $this->db->where("temp_policy_info.policy_issue_date <=",$to_date);
  	    }
  	    if($agent != "All")
  	    {
  	      $this->db->where("temp_policy_info.policy_agency_pos",$agent);
  	    }
  	    if($area_incharge != "All")
  	    {
  	         $this->db->where("list_of_leads.area_incharge",$area_incharge);
  	    }
  	    if($user != "All")
  	    {
  	         $this->db->where("list_of_leads.assigned_user",$user);
  	    }
  	    $this->db->order_by("temp_policy_info.policy_issue_date","Asc");
  	    //$this->db->where("list_of_leads.policy_status","1");
  	    $this->db->where("list_of_leads.lead_type !=","2");
  	    return $this->db->get("temp_policy_info")->result();
   }
   
 
  public function fetch_policy_failure_report($select_class,$policy_type,$from_date,$to_date,$foe)
   {
        $this->db->select("list_of_leads.*,vechile_details.vechi_register_no,list_of_clients.client_name,list_of_clients.mobile_no,list_of_clients.other_contact_details,list_of_clients.landline_no,list_of_clients.address,list_of_clients.contact_person_name,list_of_clients.date_of_birth,list_of_clients.age,list_of_clients.area,type_of_bussiness.bussiness_type as b_type,list_of_class.class as lclass,list_of_policy_type.policy_type as p_type,admin_login.username as cname");
       	$this->db->join("list_of_clients","list_of_leads.client_id = list_of_clients.id");
  	    $this->db->join("type_of_bussiness","list_of_leads.business_type = type_of_bussiness.id");
  	    $this->db->join("list_of_class","list_of_leads.class = list_of_class.id");
  	    $this->db->join("list_of_policy_type","list_of_leads.policy_type = list_of_policy_type.id");
  	    $this->db->join("vechile_details","vechile_details.lead_id = list_of_leads.id",'left');
  	    $this->db->join("admin_login","list_of_leads.area_incharge = admin_login.id",'left');
  	    $this->db->where("list_of_leads.due_date >=",$from_date);
  	    $this->db->where("list_of_leads.due_date <=",$to_date);
  	   
  	    if($select_class != "all")
  	    {
  	        $this->db->where("list_of_leads.class",$select_class);
  	    }
  	    if($policy_type != "all")
  	    {
  	        $this->db->where("list_of_leads.policy_type",$policy_type);
  	    }
  	    if($foe != "All")
  	    {
  	        $this->db->where("list_of_leads.assigned_user",$foe);
  	    }
  	    
  	    
  	    $this->db->where("policy_status !=","1");
  	    $this->db->where("lead_type !=","2");
  	    $this->db->order_by("list_of_leads.due_date","Asc");
  	    return $this->db->get("list_of_leads")->result();
   }
  
   public function policy_renewal_report()
   {
       $this->db->select("list_of_leads.*,vechile_details.vechi_register_no,list_of_clients.client_name,list_of_clients.mobile_no,list_of_clients.other_contact_details,list_of_clients.landline_no,list_of_clients.address,list_of_clients.contact_person_name,list_of_clients.date_of_birth,list_of_clients.age,list_of_clients.area,type_of_bussiness.bussiness_type as b_type,list_of_class.class as lclass,list_of_policy_type.policy_type as p_type");
       	$this->db->join("list_of_clients","list_of_leads.client_id = list_of_clients.id");
  	    $this->db->join("type_of_bussiness","list_of_leads.business_type = type_of_bussiness.id");
  	    $this->db->join("list_of_class","list_of_leads.class = list_of_class.id");
  	    $this->db->join("list_of_policy_type","list_of_leads.policy_type = list_of_policy_type.id");
  	    $this->db->join("vechile_details","vechile_details.lead_id = list_of_leads.id",'left');
  	    $this->db->where("list_of_leads.due_date >=",$from_date);
  	    $this->db->where("list_of_leads.due_date <=",$to_date);
  	    $this->db->where("policy_status !=","1");
  	    $this->db->where("lead_type !=","2");
  	    $this->db->order_by("list_of_leads.due_date","Asc");
  	    return $this->db->get("list_of_leads")->result();
   }
   
   public function get_tds_percentage()
   {
       return $this->db->get("tds")->row();
   }
   
   public function get_tds_amount($vocher_no)
   {
       $this->db->where("vocher_no",$vocher_no);
       return $this->db->get("tds_log")->row();
       
   }
   
   public function get_total_tds_amount($vocher_arr)
   {
        $this->db->select_sum('tds_amount');
        $this->db->where_in("vocher_no",$vocher_arr);
        $result = $this->db->get('tds_log')->row();  
        return $result->tds_amount;
   }
   
   public function get_foe_details($foe_id)
   {
       $this->db->where("id",$foe_id);
       return $this->db->get("admin_login")->row();
   }
   
   public function get_foe_reports($foe_id,$date,$order_by)
   {
       $this->db->select("list_website_followup.*,admin_login.name as ai_name,list_of_pos_and_agents.name as agent_name,list_of_pos_and_agents.agent_pos_code");
       $this->db->from("list_website_followup");
       $this->db->join("list_of_pos_and_agents","list_website_followup.agent_id =list_of_pos_and_agents.id",'left');
       $this->db->join("admin_login","list_website_followup.area_incharge_id =admin_login.id",'left');
       
       if($foe_id != "all")
       {
           $this->db->where("list_website_followup.created_id",$foe_id);
       }
       
       if($order_by == "date")
       {
           $this->db->order_by("list_website_followup.created_at","Asc");
       }
       else 
       {
           $this->db->order_by("list_website_followup.created_id","Asc");
       }
       
       $this->db->where("date(list_website_followup.created_at)",$date);
       return $this->db->get()->result();
   }
   
   public function get_ledger_acc($code)
   {
       $this->db->where("agent_id",$code);
       return $this->db->get("account_tree")->row();
   }
   
   public function get_agent_code_by_id($agent_id)
   {
       $this->db->where("id",$agent_id);
       return $this->db->get("list_of_pos_and_agents")->row();
   }
   
   public function add_agent_commission($data)
   {
       if($this->db->insert("agent_commission",$data)){
           return true;
       }
       
       return false;
   }
   
   public function add_agent_commission_orc($data)
   {
       if($this->db->insert("agent_commission_orc",$data)){
           return true;
       }
       
       return false;
   }
   
   public function get_total_credit_amount($agent_id)
   {
       $this->db->where("agent_id",$agent_id);
       $this->db->select('SUM(credit) as credit_tot');
       return $this->db->get("agent_commission")->row();
   }
   
   public function get_total_debit_amount($agent_id)
   {
        $this->db->select('SUM(debit) as debit_tot');
        $this->db->where("agent_id",$agent_id);
       return $this->db->get("agent_commission")->row();
   }
   
   public function update_ledger($data,$acc_name)
   {
       $this->db->where("account_id",$acc_name);
       $this->db->update("account_tree",$data);
   }
   
   // 
   
   public function get_tds_amount_by_voucher_no($voucher_no,$agents)
   {
       $this->db->where("vocher_no",$voucher_no);
       $this->db->where("agent_id",$agents);
       return $this->db->get("tds_log")->row();
   }
 
   public function get_tds_accvarcharid($agent_id)
   {
       $this->db->where("account_name",$agent_id);
       $this->db->where("accvarcharid","acc0226");
       return $this->db->get("account_tree")->row();
   }
   
   public function get_agent_tds_credit_amount($agent_id)
   {
        $this->db->select('SUM(tds_amount) as credit_tot');
       $this->db->where("agent_id",$agent_id);
       return $this->db->get("tds_log")->row();
   }
   
   public function get_agent_tds_debit_amount($agent_id)
   {
        $this->db->where("agent_id",$agent_id);
       $this->db->select('SUM(debit) as debit_tot');
       return $this->db->get("tds_log")->row();
   }
   
   public function update_tds_ledger($data,$acc_name)
   {
       $this->db->where("account_id",$acc_name);
       $this->db->update("account_tree",$data);
   }
   
   //
   
   public function get_total_tds_credit_amount()
   {
        $this->db->select('SUM(tds_amount) as total_credit_amt');
       return $this->db->get("tds_log")->row();
   }
   
   public function get_total_tds_debit_amount()
   {
       $this->db->select('SUM(debit) as total_debit_amt');
       return $this->db->get("tds_log")->row();
   }
   
   public function add_acc_own_commission($accarr)
   {
       $this->db->insert("acc_commission_ledger",$accarr);
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
    
    //
   public function business_complete_records($from_limit,$to_limit,$report_status)
   { 
        $this->db->distinct("company");
        $this->db->join("list_of_leads","policy_info.lead_id = list_of_leads.id");
        
  	    if($from_limit != "All" || $from_limit != "")
  	    {
  	        $this->db->where("policy_info.policy_issue_date >=",$from_limit);
  	    }
  	    if($to_limit != "All" || $to_limit != "")
  	    {
  	       $this->db->where("policy_info.policy_issue_date <=",$to_limit);
  	    }
  	    if($report_status == "insurer_wise")
  	    {
  	        $this->db->group_by("policy_info.company");
  	    }
  	    $this->db->order_by("policy_info.policy_issue_date","Asc");
  	    $this->db->where("list_of_leads.lead_type","2");
  	    return $this->db->get("policy_info")->result();
   }
   
   public function generate_policy_records($from_limit,$to_limit,$report_status)
   { 
        $this->db->select("company");
  	    $this->db->join("list_of_leads","temp_policy_info.lead_id = list_of_leads.id");
  	    if($from_limit != "")
  	    {
  	        $this->db->where("temp_policy_info.policy_issue_date >=",$to_limit);
  	    }
  	    if($to_limit != "")
  	    {
  	        $this->db->where("temp_policy_info.policy_issue_date <=",$to_limit);
  	    }
  	    if($report_status == "insurer_wise")
  	    {
  	        $this->db->group_by("temp_policy_info.company");
  	    }
  	    $this->db->where("list_of_leads.lead_type !=","2");
  	    return $this->db->get("temp_policy_info")->result();
   }
  	
   public function fetch_sum_business_complete_report($from_limit,$to_limit,$report_status,$key_id)
   { 
        $this->db->select("sum(total_premium) as tot_premium");
        $this->db->join("list_of_leads","policy_info.lead_id = list_of_leads.id");
        $this->db->join("list_of_pos_and_agents","policy_info.policy_agency_pos = list_of_pos_and_agents.id");
        $this->db->join("list_of_insurance_company","policy_info.company = list_of_insurance_company.id");
        $this->db->join("list_of_class","list_of_leads.class = list_of_class.id");
        $this->db->join("admin_login","admin_login.id = list_of_leads.area_incharge",'left');
        $this->db->join("list_of_policy_type","list_of_leads.policy_type = list_of_policy_type.id");
        
  	    if($from_limit != "All" || $from_limit != "")
  	    {
  	        $this->db->where("policy_info.policy_issue_date >=",$from_limit);
  	    }
  	    if($to_limit != "All" || $to_limit != "")
  	    {
  	       $this->db->where("policy_info.policy_issue_date <=",$to_limit);
  	    }
  	    if($report_status == "insurer_wise")
  	    {
  	        $this->db->where("policy_info.company",$key_id);
  	    }
  	    else if($report_status == "Area_incharge_wise")
  	    {
  	        $this->db->where("list_of_leads.area_incharge",$key_id);
  	    }
  	    else if($report_status == "policy_class_wise")
  	    {
  	        $this->db->where("list_of_leads.class",$key_id);
  	    }
  	    $this->db->order_by("policy_info.policy_issue_date","Asc");
  	    $this->db->where("list_of_leads.lead_type","2");
  	    return $this->db->get("policy_info")->row();
   }
  	
   public function fetch_sum_generate_policy_report($from_limit,$to_limit,$report_status,$key_id)
   { 
        $this->db->select("sum(total_premium) as tot_premium");
      	$this->db->join("list_of_leads","temp_policy_info.lead_id = list_of_leads.id");
  	    $this->db->join("list_of_pos_and_agents","temp_policy_info.policy_agency_pos = list_of_pos_and_agents.id");
  	    $this->db->join("list_of_insurance_company","temp_policy_info.company = list_of_insurance_company.id");
  	    $this->db->join("list_of_class","list_of_leads.class = list_of_class.id");
  	    $this->db->join("list_of_policy_type","list_of_leads.policy_type = list_of_policy_type.id");
  	    $this->db->join("admin_login","admin_login.id = list_of_leads.area_incharge",'left');
  	
  	    if($from_limit != "All" || $from_limit != "")
  	    {
  	        $this->db->where("temp_policy_info.policy_issue_date >=",$from_limit);
  	    }
  	    if($to_limit != "All" || $to_limit != "")
  	    {
  	       $this->db->where("temp_policy_info.policy_issue_date <=",$to_limit);
  	    }
  	    if($report_status == "insurer_wise")
  	    {
  	        $this->db->where("temp_policy_info.company",$key_id);
  	    }
  	    else if($report_status == "Area_incharge_wise")
  	    {
  	        $this->db->where("list_of_leads.area_incharge",$key_id);
  	    }
  	    $this->db->order_by("temp_policy_info.policy_issue_date","Asc");
  	    $this->db->where("list_of_leads.lead_type !=","2");
  	    return $this->db->get("temp_policy_info")->row();
   }
   
   
   public function fetch_all_insurance_companies()
   {
       return $this->db->get("list_of_insurance_company")->result();
   }
   
   public function fetch_all_area_incharge()
   {
       $this->db->where("role","AI");
       return $this->db->get("admin_login")->result();
   }
   
   public function fetch_all_class()
   {
       return $this->db->get("list_of_class")->result();
   }
   
  public function vocher_number_already_exit($new_vocher_no)
   {
        $this->db->where("vocher_no",$new_vocher_no);
  		$number = $this->db->get("insurance_vocher_series")->num_rows();
  		
  		if($number > 0)
  		{
  		    return true;
  		}
  		else
  		{
  		    $data = array(
  		        "vocher_no" => $new_vocher_no,
  		        );
  		    $this->db->insert("insurance_vocher_series",$data);
  		    return false;
        }
   }
   
   
   public function vocher_unicorn_no_already_exit($unicorn_vocher_no)
   {
       $this->db->where("vocher_no",$unicorn_vocher_no);
       $number = $this->db->get("insurance_vocher_series")->num_rows();
       
       if($number > 0)
       {
  		    return true;
       }
       else
       {
          $data = array(
                         "vocher_no" =>$unicorn_vocher_no);
            $this->db->insert("insurance_vocher_series",$data);
            return false;
       }
   }
   
   public function add_insurance_voucher_details($data)
   {
      $this->db->insert_batch("insurance_voucher_datails",$data); 
   } 
   
   public function add_insurance_voucher_details_orc($data1)  
   { 
       $this->db->insert_batch("insurance_voucher_datails_orc",$data1);
   } 
   
   public function get_voucher_details($vocher_no)
   {
       $this->db->select('sum(own_commission) as amount, polic_type, insurer_id,count(voucher_no) as noof');
       $this->db->where("voucher_no",$vocher_no);
       $this->db->group_by("polic_type");
       $this->db->group_by("insurer_id");
       return $this->db->get("insurance_voucher_datails")->result();
   }
   
  public function get_voucher_orc_details($vocher_no) 
  {
        $this->db->select('sum(own_commission) as amount, polic_type, insurer_id,count(voucher_no) as noof');
        $this->db->where("voucher_no",$vocher_no);
        $this->db->group_by("polic_type");
        $this->db->group_by("insurer_id");
        return $this->db->get("insurance_voucher_datails_orc")->result();  
  }
  
  public function get_voucher_details_report($vocher_no)
  {
        $this->db->select("insurance_voucher_datails.*,list_of_policy_type.policy_type,policy_info.policy_no,vechile_details.vechi_register_no");
        $this->db->join("policy_info","policy_info.lead_id = insurance_voucher_datails.lead_id ");
        $this->db->join("list_of_leads","list_of_leads.id = policy_info.lead_id");
        
        $this->db->join("list_of_policy_type","list_of_leads.policy_type = list_of_policy_type.id");
  	    $this->db->join("vechile_details","vechile_details.lead_id = list_of_leads.id",'left');
        $this->db->where("voucher_no",$vocher_no);
        return $this->db->get("insurance_voucher_datails")->result();  

  }
  
  
  public function get_voucher_orc_details_report($vocher_no)
  {
        $this->db->select("insurance_voucher_datails.*,list_of_policy_type.policy_type,policy_info.policy_no,vechile_details.vechi_register_no");
        $this->db->join("policy_info","policy_info.lead_id = insurance_voucher_datails.lead_id ");
        $this->db->join("list_of_leads","list_of_leads.id = policy_info.lead_id");
        
        $this->db->join("list_of_policy_type","list_of_leads.policy_type = list_of_policy_type.id");
  	    $this->db->join("vechile_details","vechile_details.lead_id = list_of_leads.id",'left');
        $this->db->where("voucher_no",$vocher_no);
        return $this->db->get("insurance_voucher_datails_orc")->result();  

  }
  
  public function add_insur_commission_status($data)
  {
       $this->db->insert("policy_info",$data);
  }
  
  public function fetch_agent_poilicy_list($from_date,$to_date)
  {
      
        $this->db->distinct("trim(list_of_pos_and_agents.name) as name,list_of_pos_and_agents.agent_pos_code,list_of_pos_and_agents.id");
        $this->db->select("list_of_pos_and_agents.name,list_of_pos_and_agents.agent_pos_code,list_of_pos_and_agents.id");
        $this->db->join("policy_info","policy_info.policy_agency_pos = list_of_pos_and_agents.id");
        $this->db->where("policy_info.policy_issue_date >=",$from_date);
        $this->db->where("policy_info.policy_issue_date <=",$to_date);
        $this->db->where("policy_info.commission_status","1");
        $this->db->where("policy_info.vocher_status","0");
        $this->db->order_by('trim(list_of_pos_and_agents.name)', 'asc');
        return $this->db->get("list_of_pos_and_agents")->result();
  }
  
  public function fetch_agentlist($from_date,$to_date)
  {
      
        $this->db->distinct("trim(list_of_pos_and_agents.name) as name,list_of_pos_and_agents.agent_pos_code,list_of_pos_and_agents.id");
        $this->db->select("list_of_pos_and_agents.name,list_of_pos_and_agents.agent_pos_code,list_of_pos_and_agents.id");
        $this->db->join("policy_info","policy_info.policy_agency_pos = list_of_pos_and_agents.id");
        $this->db->where("policy_info.policy_issue_date >=",$from_date);
        $this->db->where("policy_info.policy_issue_date <=",$to_date);
        //$this->db->where("policy_info.commission_status","1");
        $this->db->where("policy_info.vocher_status","0");
        $this->db->order_by('trim(list_of_pos_and_agents.name)', 'asc');
        return $this->db->get("list_of_pos_and_agents")->result();
  }
  
    public function fetch_all_policy_list($from_date,$to_date)
   { 
       $this->db->select("policy_info.id,policy_info.agent_commission_amt,policy_info.agn_add_com,policy_info.policy_agency_pos,list_of_leads.business_type,policy_info.policy_premium,list_of_leads.class,policy_info.company,policy_info.gst,policy_info.policy_s_date,policy_info.policy_ex_date,list_of_premium_cover_type.name as policy_premium_name,type_of_bussiness.bussiness_type as business_name,list_of_class.class as class_name,list_of_policy_type.policy_type,policy_info.total_own_damage,policy_info.basic_tp,policy_info.total_premium,policy_info.policy_no,list_of_clients.client_name,list_of_clients.mobile_no,list_of_pos_and_agents.agent_pos_code,list_of_insurance_company.company_name");
      	$this->db->join("list_of_leads","policy_info.lead_id = list_of_leads.id");
  	    $this->db->join("list_of_clients","list_of_leads.client_id = list_of_clients.id");
  	    $this->db->join("list_of_pos_and_agents","policy_info.policy_agency_pos = list_of_pos_and_agents.id");
  	    $this->db->join("list_of_insurance_company","policy_info.company = list_of_insurance_company.id");
  	    $this->db->join("type_of_bussiness","list_of_leads.business_type = type_of_bussiness.id");
  	    $this->db->join("list_of_class","list_of_leads.class = list_of_class.id");
  	    $this->db->join("list_of_policy_type","list_of_leads.policy_type = list_of_policy_type.id");
  	    $this->db->join("list_of_premium_cover_type","policy_info.policy_premium = list_of_premium_cover_type.id",'left');
  	    $this->db->where("policy_info.cancel_policy_status","0");
      	$this->db->where("policy_info.commission_status","0");
      	$this->db->where("policy_info.vocher_status","0");
      	
      	if($from_date !="")
      	{
          	$this->db->where("policy_info.policy_issue_date >=",$from_date);
      	    $this->db->where("policy_info.policy_issue_date <=",$to_date);
      	}
      	return $this->db->get("policy_info")->result();
   }
   
   
   public function fetch_all_policy_list_orc($from_date,$to_date)
   {
       $this->db->select("policy_info.id,policy_info.agn_add_com,policy_info.agent_commission,policy_info.additional_commission,policy_info.policy_agency_pos,list_of_leads.business_type,policy_info.policy_premium,list_of_leads.class,policy_info.company,policy_info.gst,policy_info.policy_s_date,policy_info.policy_ex_date,list_of_premium_cover_type.name as policy_premium_name,type_of_bussiness.bussiness_type as business_name,list_of_class.class as class_name,list_of_policy_type.policy_type,policy_info.total_own_damage,policy_info.basic_tp,policy_info.total_premium,policy_info.policy_no,list_of_clients.client_name,list_of_clients.mobile_no,list_of_pos_and_agents.agent_pos_code,list_of_insurance_company.company_name");
      	$this->db->join("list_of_leads","policy_info.lead_id = list_of_leads.id");
  	    $this->db->join("list_of_clients","list_of_leads.client_id = list_of_clients.id");
  	    $this->db->join("list_of_pos_and_agents","policy_info.policy_agency_pos = list_of_pos_and_agents.id");
  	    $this->db->join("list_of_insurance_company","policy_info.company = list_of_insurance_company.id");
  	    $this->db->join("type_of_bussiness","list_of_leads.business_type = type_of_bussiness.id");
  	    $this->db->join("list_of_class","list_of_leads.class = list_of_class.id");
  	    $this->db->join("list_of_policy_type","list_of_leads.policy_type = list_of_policy_type.id");
  	    $this->db->join("list_of_premium_cover_type","policy_info.policy_premium = list_of_premium_cover_type.id",'left');
      	$this->db->where("policy_info.commission_status","0");
      	$this->db->where("policy_info.vocher_status","0");
      	
      	if($from_date !="")
      	{
          	$this->db->where("policy_info.policy_issue_date >=",$from_date);
      	    $this->db->where("policy_info.policy_issue_date <=",$to_date);
      	}
      	
      	return $this->db->get("policy_info")->result();
   }
   
   
   public function update_cancel_policy_status($data,$cancel_id)
   {
       $this->db->where("id",$cancel_id);
       $this->db->update("policy_info",$data);
   }
   
   public function update_policy_hold_list($data,$hold_id)
   {
       $this->db->where("id",$hold_id);
       $this->db->update("policy_info",$data);
   }
   
   public function fetch_policy_cancel_report()
	{
      	$this->db->select("policy_info.id,policy_info.lead_id,company_payout_commission.id as com_id,company_payout_commission.no_of_policy_id,policy_info.agent_commission_amt,policy_info.agent_commission,policy_info.own_commission_amt,policy_info.own_commission,policy_info.agent_commission_amt,policy_info.policy_agency_pos,list_of_leads.business_type,policy_info.policy_premium,list_of_leads.class,policy_info.company,policy_info.gst,policy_info.policy_s_date,policy_info.policy_ex_date,list_of_premium_cover_type.name as policy_premium_name,type_of_bussiness.bussiness_type as business_name,list_of_class.class as class_name,list_of_policy_type.policy_type,policy_info.total_own_damage,policy_info.tot_liability_premium,policy_info.basic_tp,policy_info.total_premium,policy_info.policy_no,list_of_clients.client_name,list_of_clients.mobile_no,list_of_pos_and_agents.agent_pos_code,list_of_insurance_company.company_name,company_payout_commission.commission_type,company_payout_commission.net_premium_id");
      	$this->db->join("list_of_leads","policy_info.lead_id = list_of_leads.id");
  	    $this->db->join("list_of_clients","list_of_leads.client_id = list_of_clients.id");
  	    $this->db->join("list_of_pos_and_agents","policy_info.policy_agency_pos = list_of_pos_and_agents.id");
  	    $this->db->join("list_of_insurance_company","policy_info.company = list_of_insurance_company.id");
  	    $this->db->join("type_of_bussiness","list_of_leads.business_type = type_of_bussiness.id");
  	    $this->db->join("list_of_class","list_of_leads.class = list_of_class.id");
  	    $this->db->join("list_of_policy_type","list_of_leads.policy_type = list_of_policy_type.id");
  	    $this->db->join("list_of_premium_cover_type","policy_info.policy_premium = list_of_premium_cover_type.id",'left');
  	    $this->db->join("company_payout_commission","company_payout_commission.id = policy_info.commission_id", 'left');
  	    
      	//$this->db->where("policy_info.commission_status !=","1");
      	$this->db->where_in("policy_info.cancel_policy_status",["1","2"]);
      	$this->db->where("list_of_leads.lead_type","2");
      	return $this->db->get("policy_info")->result();
	}
	
	public function updata_policy_recover($data,$id)
	{
        $this->db->where("id",$id);
        $this->db->update("policy_info",$data);  
	}
	
	public function fetch_agent_policy_insurance_company($from_date,$to_date)
    {
        $this->db->distinct("list_of_insurance_company.company_name,list_of_insurance_company.id");
        $this->db->select("list_of_insurance_company.company_name,list_of_insurance_company.id");
        $this->db->join("policy_info","policy_info.company = list_of_insurance_company.id");
        $this->db->where("policy_info.policy_s_date >=",$from_date);
        $this->db->where("policy_info.policy_s_date <=",$to_date);
        //$this->db->where("policy_info.commission_status","1");
        $this->db->where("policy_info.vocher_status","0");
        return $this->db->get("list_of_insurance_company")->result();
    }

  
    public function getAgentCommission($from_date, $to_date, $agent_id = '', $company = '', $user = '') 
    {
        $this->db->select("policy_info.id,policy_info.agent_commission_amt,policy_info.agn_add_com,policy_info.agent_commission,policy_info.additional_commission,policy_info.policy_agency_pos,list_of_leads.business_type,policy_info.policy_premium,list_of_leads.class,policy_info.company,policy_info.gst,policy_info.policy_s_date,policy_info.policy_ex_date,list_of_premium_cover_type.name as policy_premium_name,type_of_bussiness.bussiness_type as business_name,list_of_class.class as class_name,list_of_policy_type.policy_type,policy_info.total_own_damage,policy_info.basic_tp,policy_info.total_premium,policy_info.policy_no,list_of_clients.client_name,list_of_clients.mobile_no,list_of_pos_and_agents.agent_pos_code,list_of_pos_and_agents.name as agent_name,list_of_insurance_company.company_name,agent_special_com.special_com,policy_info.applied_splcommission");
        $this->db->join("list_of_leads","policy_info.lead_id = list_of_leads.id");
        $this->db->join("list_of_clients","list_of_leads.client_id = list_of_clients.id");
        $this->db->join("list_of_pos_and_agents","policy_info.policy_agency_pos = list_of_pos_and_agents.id");
        $this->db->join("list_of_insurance_company","policy_info.company = list_of_insurance_company.id");
        $this->db->join("type_of_bussiness","list_of_leads.business_type = type_of_bussiness.id");
        $this->db->join("list_of_class","list_of_leads.class = list_of_class.id");
        $this->db->join("list_of_policy_type","list_of_leads.policy_type = list_of_policy_type.id");
        $this->db->join("list_of_premium_cover_type","policy_info.policy_premium = list_of_premium_cover_type.id",'left');
        // 2023-06-10
        $this->db->join("agent_special_com", "policy_info.commission_id = agent_special_com.commission_id and policy_info.policy_agency_pos = agent_special_com.agent_id and date(policy_info.policy_issue_date) between agent_special_com.from_date and agent_special_com.to_date", 'left');
        
        $this->db->where("policy_info.commission_status","1");
        $this->db->where("policy_info.vocher_status","0");
        $this->db->where_in("policy_info.cancel_policy_status",["0", "3", "4"]);

        if($from_date && $to_date){
            $this->db->where("policy_info.policy_issue_date >=",$from_date);
            $this->db->where("policy_info.policy_issue_date <=",$to_date);
        }
        
        if($agent_id)
            $this->db->where("policy_info.policy_agency_pos",$agent_id);
            
        if($company)
      	    $this->db->where("policy_info.company",$company);
      	
        if($user)
      	    $this->db->where("list_of_leads.assigned_user", $user);
            
        return $this->db->get("policy_info")->result();
    }
   
   
   
   
   public function getAgentVoucharByPolicy($policyIDs)
   {
       
       if(!is_array($policyIDs)){
           $policyIDs = [$policyIDs];
       }
       
        $this->db->select("policy_info.id,policy_info.policy_issue_date,policy_info.agent_commission_amt,policy_info.agn_add_com,policy_info.agent_commission,policy_info.additional_commission,policy_info.created_at,policy_info.policy_agency_pos,list_of_leads.business_type,policy_info.policy_premium,list_of_leads.class,policy_info.company,policy_info.gst,policy_info.policy_s_date,policy_info.policy_ex_date,list_of_premium_cover_type.name as policy_premium_name,type_of_bussiness.bussiness_type as business_name,list_of_class.class as class_name,list_of_policy_type.policy_type,policy_info.total_own_damage,policy_info.basic_tp,policy_info.total_premium,policy_info.policy_no,list_of_clients.client_name,list_of_clients.mobile_no,list_of_pos_and_agents.agent_pos_code,list_of_insurance_company.company_name");
      	$this->db->join("list_of_leads","policy_info.lead_id = list_of_leads.id");
  	    $this->db->join("list_of_clients","list_of_leads.client_id = list_of_clients.id");
  	    $this->db->join("list_of_pos_and_agents","policy_info.policy_agency_pos = list_of_pos_and_agents.id");
  	    $this->db->join("list_of_insurance_company","policy_info.company = list_of_insurance_company.id");
  	    $this->db->join("type_of_bussiness","list_of_leads.business_type = type_of_bussiness.id");
  	    $this->db->join("list_of_class","list_of_leads.class = list_of_class.id");
  	    $this->db->join("list_of_policy_type","list_of_leads.policy_type = list_of_policy_type.id");
  	    $this->db->join("list_of_premium_cover_type","policy_info.policy_premium = list_of_premium_cover_type.id",'left');
      	$this->db->where("policy_info.commission_status","1");
      	$this->db->where("list_of_leads.lead_type","2");
      	$this->db->where("policy_info.vocher_status","0");
      	
      	$this->db->where_in("policy_info.id",$policyIDs);
      	return $this->db->get("policy_info")->result();
   }
   
   
   public function getAgentVouchar($from_date, $to_date, $agent_id = '', $user = '') 
    {
        $this->db->select("policy_info.id,policy_info.agent_commission_amt,policy_info.agn_add_com,policy_info.agent_commission,policy_info.additional_commission,policy_info.policy_agency_pos,list_of_leads.business_type,policy_info.policy_premium,list_of_leads.class,policy_info.company,policy_info.gst,policy_info.policy_s_date,policy_info.policy_ex_date,list_of_premium_cover_type.name as policy_premium_name,type_of_bussiness.bussiness_type as business_name,list_of_class.class as class_name,list_of_policy_type.policy_type,policy_info.total_own_damage,policy_info.basic_tp,policy_info.total_premium,policy_info.policy_no,list_of_clients.client_name,list_of_clients.mobile_no,list_of_pos_and_agents.agent_pos_code,list_of_pos_and_agents.name as agent_name,list_of_insurance_company.company_name, agent_voucher_details.total_commission, agent_voucher_details.agent_id,policy_info.vocher_date, policy_info.vocher_no");
        //$this->db->from('agent_voucher_details');
        $this->db->join("agent_voucher_details","agent_voucher_details.voucher_no = policy_info.vocher_no");
        $this->db->join("list_of_leads","policy_info.lead_id = list_of_leads.id");
        $this->db->join("list_of_clients","list_of_leads.client_id = list_of_clients.id");
        $this->db->join("list_of_pos_and_agents","policy_info.policy_agency_pos = list_of_pos_and_agents.id");
        $this->db->join("list_of_insurance_company","policy_info.company = list_of_insurance_company.id");
        $this->db->join("type_of_bussiness","list_of_leads.business_type = type_of_bussiness.id");
        $this->db->join("list_of_class","list_of_leads.class = list_of_class.id");
        $this->db->join("list_of_policy_type","list_of_leads.policy_type = list_of_policy_type.id");
        $this->db->join("list_of_premium_cover_type","policy_info.policy_premium = list_of_premium_cover_type.id",'left');
        
        $this->db->where("policy_info.commission_status","1");
        $this->db->where("policy_info.vocher_status","1");
        
        $this->db->where("agent_voucher_details.agent_id = list_of_pos_and_agents.id");
        
        $this->db->where("policy_info.policy_issue_date between agent_voucher_details.from_date and agent_voucher_details.to_date", NULL);

        if($from_date && $to_date){
            $this->db->where("agent_voucher_details.from_date >=",$from_date);
            $this->db->where("agent_voucher_details.to_date <=",$to_date);
        }
        
        if($agent_id)
            $this->db->where("agent_voucher_details.agent_id",$agent_id);
            
        if($user)
      	    $this->db->where("list_of_leads.assigned_user", $user);
            
        $this->db->order_by('list_of_pos_and_agents.id, policy_info.policy_issue_date', 'ASC');
        return $this->db->get("policy_info")->result();
    }
    
    
//     public function _fetch_business_complete_report($ins_company,$select_class,$policy_type,$agent,$from_date,$to_date,$area_incharge,$user)
//   { 
//       //set_time_limit(1500);
//       $start = $from_date;
//       $end =  $to_date;
//       //(select special_com from agent_special_com where commission_id = cpc.id and agent_id = list_of_pos_and_agents.id and policy_info.policy_issue_date between from_date and to_date) as agent_special_commission,
      
//         $this->db->select("policy_info.id,policy_info.tot_liability_premium,policy_info.own_commission,policy_info.agent_commission,policy_info.lead_id,policy_info.policy_issue_date,policy_info.policy_s_date,policy_info.com_add_com,policy_info.agn_add_com,policy_info.own_commission_amt,policy_info.agent_commission_amt,policy_info.commission_status,policy_info.policy_agency_pos,list_of_leads.business_type,policy_info.policy_premium,list_of_leads.class,list_of_leads.assigned_user,policy_info.company,policy_info.gst,policy_info.policy_s_date,policy_info.policy_ex_date,list_of_premium_cover_type.name as policy_premium_name,type_of_bussiness.bussiness_type as business_name,list_of_class.class as class_name,list_of_policy_type.policy_type,policy_info.total_own_damage,policy_info.basic_tp,policy_info.total_premium,policy_info.policy_no,list_of_clients.client_name,list_of_clients.mobile_no,list_of_pos_and_agents.agent_pos_code,list_of_pos_and_agents.name as agn_name,list_of_insurance_company.company_name,list_of_insurance_company.short_name as ins_short_name,admin_login.name as ai_name,vechile_details.vechi_cc,vechile_details.vechi_gvw,vechile_details.vechi_register_no,list_of_policy_type.policy_type as p_type,
//             policy_info.no_claim_bonus, 
//         	cpc.id as commissionid,
//         	case 
//         	    when cpc.class = '1' then cpc.agn_com_type
//         	    when cpc.class = '2' then 'ON-NET.'
//         	End as agn_com_type,
//         	list_of_pos_and_agents.commission_category,
//         	(select special_com from agent_special_com where commission_id = cpc.id and agent_id = list_of_pos_and_agents.id and policy_info.policy_issue_date between from_date and to_date) as agent_special_commission,
//         	case 
//         		When cpc.is_ncb = 'Yes' and no_claim_bonus = 'Yes' then 
//         			(select special_com from agent_special_com where commission_id = cpc.id and agent_id = 	list_of_pos_and_agents.id and policy_info.policy_issue_date between from_date and to_date)		
//         		When cpc.is_cpa = 'Yes' and cpa = 'Yes' then 
//         			case when list_of_pos_and_agents.commission_category = 'A' then a_cpa
// 						when list_of_pos_and_agents.commission_category = 'B' then b_cpa
// 						when list_of_pos_and_agents.commission_category = 'C' then c_cpa
// 						when list_of_pos_and_agents.commission_category = 'D' then d_cpa
// 					end
//         		ELSE
//         			case 
//         				when cpc.agn_com_type = 'OD' then 
//         					case when list_of_pos_and_agents.commission_category = 'A' then a_od
//         						when list_of_pos_and_agents.commission_category = 'B' then b_od
//         						when list_of_pos_and_agents.commission_category = 'C' then c_od
//         						when list_of_pos_and_agents.commission_category = 'D' then d_od
//         					end
//         				when cpc.agn_com_type = 'TP' then 
//         					case when list_of_pos_and_agents.commission_category = 'A' then a_tp
//         						when list_of_pos_and_agents.commission_category = 'B' then b_tp
//         						when list_of_pos_and_agents.commission_category = 'C' then c_tp
//         						when list_of_pos_and_agents.commission_category = 'D' then d_tp
//         					end
//         				when cpc.agn_com_type = 'ON-NET' then 
//         					case when list_of_pos_and_agents.commission_category = 'A' then a_net
//         						when list_of_pos_and_agents.commission_category = 'B' then b_net
//         						when list_of_pos_and_agents.commission_category = 'C' then c_net
//         						when list_of_pos_and_agents.commission_category = 'D' then d_net
//         					end
        					
//         				when cpc.agn_com_type = 'OD_AND_TP' then 
//         					case when list_of_pos_and_agents.commission_category = 'A' then a_od + a_tp
//         						when list_of_pos_and_agents.commission_category = 'B' then b_od + b_tp
//         						when list_of_pos_and_agents.commission_category = 'C' then c_od + c_tp
//         						when list_of_pos_and_agents.commission_category = 'D' then d_od + d_tp
//         					end	
//         				when ((cpc.agn_com_type = '') or (cpc.agn_com_type is null)) then 
//         					case when list_of_pos_and_agents.commission_category = 'A' then a_net
//         						when list_of_pos_and_agents.commission_category = 'B' then b_net
//         						when list_of_pos_and_agents.commission_category = 'C' then c_net
//         						when list_of_pos_and_agents.commission_category = 'D' then d_net
//         					end	
//         			end
//         	End as agent_commission_percent,
        	
//         	case 
//         		When cpc.is_ncb = 'Yes' and no_claim_bonus = 'Yes' then 
//         			cpc.ncb_percentage	
//         		When cpc.is_cpa = 'Yes' and cpa = 'Yes' then 
//         		    cpc.cpa_percentage
//         		ELSE
//         			case 
//         				when cpc.agn_com_type = 'OD' then own_od				
//         				when cpc.agn_com_type = 'TP' then own_tp				
//         				when cpc.agn_com_type = 'ON-NET' then on_net
//         				when cpc.agn_com_type = 'OD_AND_TP' then own_od + own_tp
//         				when ((cpc.agn_com_type = '') or (cpc.agn_com_type is null)) then on_net
//         			end
//         	End as company_percent,commission_status, policy_info.vocher_status,insur_commission_status,company_vocher_status
//         	,invoice_prepared,cancel_policy_status,
//         	ivd.invoice_revision_id,
// 	        (select status from invoice _i, invoice_revision _ir where _i.id = _ir.invoice_id and _ir.id = ivd.invoice_revision_id) as invoice_status,
// 	        agr.voucher_no,invr.id as receipt_id,date_format(policy_info.policy_s_date, '%Y') - vechi_manu_year as age,regn_date, policy_info.old_commission_id,cpc.is_cpa as cpa,policy_info.commission_id");
//       	$this->db->join("list_of_leads","policy_info.lead_id = list_of_leads.id");
//   	    $this->db->join("list_of_clients","list_of_leads.client_id = list_of_clients.id");
//   	    $this->db->join("list_of_pos_and_agents","policy_info.policy_agency_pos = list_of_pos_and_agents.id");
//   	    $this->db->join("list_of_insurance_company","policy_info.company = list_of_insurance_company.id");
//   	    $this->db->join("type_of_bussiness","list_of_leads.business_type = type_of_bussiness.id");
//   	    $this->db->join("list_of_class","list_of_leads.class = list_of_class.id");
//   	     $this->db->join("admin_login","admin_login.id = list_of_leads.area_incharge",'left');
//   	    $this->db->join("list_of_policy_type","list_of_leads.policy_type = list_of_policy_type.id");
//   	    $this->db->join("list_of_premium_cover_type","policy_info.policy_premium = list_of_premium_cover_type.id",'left');
//   	    $this->db->join("vechile_details","vechile_details.lead_id = list_of_leads.id",'left');
  	    
//   	    $this->db->join("company_payout_commission cpc","policy_info.commission_id = cpc.id",'left');
  	    
  	    
//   	    $this->db->join("agent_commission_transaction agr","policy_info.vocher_no = agr.voucher_no",'left');
//   	    $this->db->join("insurance_voucher_datails  ivd","(policy_info.lead_id = ivd.lead_id and ivd.id in (select max(id) from insurance_voucher_datails _ivd where _ivd.lead_id = ivd.lead_id))",'left');
//   	    $this->db->join("invoice_receipts  invr","ivd.invoice_revision_id = invr.invoice_revision_id",'left');
  	    
//   	    $this->db->where("policy_info.policy_issue_date between '{$start}' and '{$end}' ",NULL);
  	    
//         if($this->session->userdata("session_role") == "AI")
//         {
//         	$this->db->where("list_of_leads.area_incharge",$this->session->userdata("session_id"));
//         }

//   	    if($ins_company != "All")
//   	    {
//   	        $this->db->where("policy_info.company",$ins_company);
//   	    }
//   	    if($select_class != "All")
//   	    {
//   	        $this->db->where("list_of_leads.class",$select_class);
//   	    }
//   	    if($policy_type != "All")
//   	    {
//   	        $this->db->where("list_of_leads.policy_type",$policy_type);
//   	    }
//   	 //   if($from_date != "All" || $from_date != "")
//   	 //   {
  	        
//   	 //       $this->db->where("policy_info.policy_issue_date >=",$from_date);
//   	 //   }
//   	 //   if($to_date != "All" || $to_date != "")
//   	 //   {
  	        
//   	 //      $this->db->where("policy_info.policy_issue_date <=",$to_date);
//   	 //   }
  	    
  	    
//   	    if($agent != "All")
//   	    {
//   	      $this->db->where("policy_info.policy_agency_pos",$agent);
//   	    }
//   	    if($area_incharge != "All")
//   	    {
//   	         $this->db->where("list_of_leads.area_incharge",$area_incharge);
//   	    }
//   	    if($user != "All")
//   	    {
//   	         $this->db->where("list_of_leads.assigned_user",$user);
//   	    }
  	    
//   	    //$this->db->where("policy_info.policy_ex_date >",date("Y-m-d"));
//   	    $this->db->order_by("policy_info.policy_issue_date","Asc");
//   	    $this->db->where("list_of_leads.lead_type","2");
//   	    return $this->db->get("policy_info")->result();
//   }
   
//     public function _fetch_generate_policy_report($ins_company,$select_class,$policy_type,$agent,$from_date,$to_date,$area_incharge,$user)
//     { 
//         //set_time_limit(1500);
//         $start = $from_date;
//         $end = $to_date;
        
//         $this->db->select("temp_policy_info.id,temp_policy_info.tot_liability_premium,temp_policy_info.lead_id,temp_policy_info.policy_issue_date,temp_policy_info.policy_s_date,temp_policy_info.com_add_com,temp_policy_info.agn_add_com,temp_policy_info.own_commission_amt,temp_policy_info.agent_commission_amt,temp_policy_info.own_commission,temp_policy_info.agent_commission,temp_policy_info.commission_status,temp_policy_info.policy_agency_pos,list_of_leads.business_type,temp_policy_info.policy_premium,list_of_leads.class,list_of_leads.assigned_user,temp_policy_info.company,temp_policy_info.gst,temp_policy_info.policy_s_date,temp_policy_info.policy_ex_date,list_of_premium_cover_type.name as policy_premium_name,type_of_bussiness.bussiness_type as business_name,list_of_class.class as class_name,list_of_policy_type.policy_type,temp_policy_info.total_own_damage,temp_policy_info.basic_tp,temp_policy_info.total_premium,temp_policy_info.policy_no,list_of_clients.client_name,list_of_clients.mobile_no,list_of_pos_and_agents.agent_pos_code,list_of_pos_and_agents.name as agn_name,list_of_insurance_company.company_name,list_of_insurance_company.short_name as ins_short_name,admin_login.name as ai_name,vechile_details.vechi_cc,vechile_details.vechi_gvw,vechile_details.vechi_register_no,list_of_policy_type.policy_type as p_type,
//             temp_policy_info.no_claim_bonus, 
//         	cpc.id as commissionid,
//         	case 
//         	    when cpc.class = '1' then cpc.agn_com_type
//         	    when cpc.class = '2' then 'ON-NET.'
//         	End as agn_com_type,
//         	list_of_pos_and_agents.commission_category,
//         	case 
//         		When cpc.is_ncb = 'Yes' and no_claim_bonus = 'Yes' then 
//         			(select special_com from agent_special_com where commission_id = cpc.id and agent_id = 	list_of_pos_and_agents.id and from_date >= temp_policy_info.policy_issue_date and to_date <= temp_policy_info.policy_issue_date)		
//         		ELSE
//         			case 
//         				when cpc.agn_com_type = 'OD' then 
//         					case when list_of_pos_and_agents.commission_category = 'A' then a_od
//         						when list_of_pos_and_agents.commission_category = 'B' then b_od
//         						when list_of_pos_and_agents.commission_category = 'C' then c_od
//         						when list_of_pos_and_agents.commission_category = 'D' then d_od
//         					end
//         				when cpc.agn_com_type = 'TP' then 
//         					case when list_of_pos_and_agents.commission_category = 'A' then a_tp
//         						when list_of_pos_and_agents.commission_category = 'B' then b_tp
//         						when list_of_pos_and_agents.commission_category = 'C' then c_tp
//         						when list_of_pos_and_agents.commission_category = 'D' then d_tp
//         					end
//         				when cpc.agn_com_type = 'ON-NET' then 
//         					case when list_of_pos_and_agents.commission_category = 'A' then a_net
//         						when list_of_pos_and_agents.commission_category = 'B' then b_net
//         						when list_of_pos_and_agents.commission_category = 'C' then c_net
//         						when list_of_pos_and_agents.commission_category = 'D' then d_net
//         					end
        					
//         				when cpc.agn_com_type = 'OD_AND_TP' then 
//         					case when list_of_pos_and_agents.commission_category = 'A' then a_od + a_tp
//         						when list_of_pos_and_agents.commission_category = 'B' then b_od + b_tp
//         						when list_of_pos_and_agents.commission_category = 'C' then c_od + c_tp
//         						when list_of_pos_and_agents.commission_category = 'D' then d_od + d_tp
//         					end	
//         				when ((cpc.agn_com_type = '') or (cpc.agn_com_type is null)) then 
//         					case when list_of_pos_and_agents.commission_category = 'A' then a_net
//         						when list_of_pos_and_agents.commission_category = 'B' then b_net
//         						when list_of_pos_and_agents.commission_category = 'C' then c_net
//         						when list_of_pos_and_agents.commission_category = 'D' then d_net
//         					end	
//         			end
//         	End as agent_commission_percent,
        	
//         	case 
//         		When cpc.is_ncb = 'Yes' and no_claim_bonus = 'Yes' then 
//         			cpc.ncb_percentage	
//         		ELSE
//         			case 
//         				when cpc.agn_com_type = 'OD' then own_od				
//         				when cpc.agn_com_type = 'TP' then own_tp				
//         				when cpc.agn_com_type = 'ON-NET' then on_net
//         				when cpc.agn_com_type = 'OD_AND_TP' then own_od + own_tp
//         				when ((cpc.agn_com_type = '') or (cpc.agn_com_type is null)) then on_net
//         			end
//         	End as company_percent,date_format(temp_policy_info.policy_s_date, '%Y') - vechi_manu_year as age");
        	
//       	$this->db->join("list_of_leads","temp_policy_info.lead_id = list_of_leads.id");
//   	    $this->db->join("list_of_clients","list_of_leads.client_id = list_of_clients.id");
//   	    $this->db->join("list_of_pos_and_agents","temp_policy_info.policy_agency_pos = list_of_pos_and_agents.id");
//   	    $this->db->join("list_of_insurance_company","temp_policy_info.company = list_of_insurance_company.id");
//   	    $this->db->join("type_of_bussiness","list_of_leads.business_type = type_of_bussiness.id");
//   	    $this->db->join("list_of_class","list_of_leads.class = list_of_class.id");
//   	    $this->db->join("list_of_policy_type","list_of_leads.policy_type = list_of_policy_type.id");
//   	    $this->db->join("list_of_premium_cover_type","temp_policy_info.policy_premium = list_of_premium_cover_type.id",'left');
  	    
//   	    $this->db->join("admin_login","admin_login.id = list_of_leads.area_incharge",'left');
//   	    $this->db->join("vechile_details","vechile_details.lead_id = list_of_leads.id",'left');
  	    
//   	    $this->db->join("company_payout_commission cpc","temp_policy_info.commission_id = cpc.id",'left');

//         $this->db->where("temp_policy_info.policy_issue_date between '{$start}' and '{$end}' ",NULL);
        
//   	    if($this->session->userdata("session_role") == "AI")
//         {
//         	$this->db->where("list_of_leads.area_incharge",$this->session->userdata("session_id"));
//         }
//   	    if($ins_company != "All")
//   	    {
//   	        $this->db->where("temp_policy_info.company",$ins_company);
//   	    }
//   	    if($select_class != "All")
//   	    {
//   	        $this->db->where("list_of_leads.class",$select_class);
//   	    }
//   	    if($policy_type != "All")
//   	    {
//   	        $this->db->where("list_of_leads.policy_type",$policy_type);
//   	    }
//   	 //   if($from_date != "All")
//   	 //   {
//   	 //       $this->db->where("temp_policy_info.policy_issue_date >=",$from_date);
//   	 //   }
//   	 //   if($to_date != "All")
//   	 //   {
//   	 //       $this->db->where("temp_policy_info.policy_issue_date <=",$to_date);
//   	 //   }
//   	    if($agent != "All")
//   	    {
//   	      $this->db->where("temp_policy_info.policy_agency_pos",$agent);
//   	    }
//   	    if($area_incharge != "All")
//   	    {
//   	         $this->db->where("list_of_leads.area_incharge",$area_incharge);
//   	    }
//   	    if($user != "All")
//   	    {
//   	         $this->db->where("list_of_leads.assigned_user",$user);
//   	    }
//   	    $this->db->order_by("temp_policy_info.policy_issue_date","Asc");
//   	    //$this->db->where("list_of_leads.policy_status","1");
//   	    $this->db->where("list_of_leads.lead_type !=","2");
//   	    return $this->db->get("temp_policy_info")->result();
//   }


  public function _fetch_business_complete_report($ins_company,$select_class,$policy_type,$agent,$from_date,$to_date,$area_incharge,$user)
   { 
       //set_time_limit(1500);
       $start = $from_date;
       $end =  $to_date;
       //(select special_com from agent_special_com where commission_id = cpc.id and agent_id = list_of_pos_and_agents.id and policy_info.policy_issue_date between from_date and to_date) as agent_special_commission,
      
        $this->db->select("policy_info.id,policy_info.tot_liability_premium,policy_info.own_commission,policy_info.agent_commission,policy_info.lead_id,policy_info.policy_issue_date,policy_info.policy_s_date,policy_info.com_add_com,policy_info.agn_add_com,policy_info.own_commission_amt,policy_info.agent_commission_amt,policy_info.commission_status,policy_info.policy_agency_pos,list_of_leads.business_type,policy_info.policy_premium,list_of_leads.class,list_of_leads.assigned_user,policy_info.company,policy_info.gst,policy_info.policy_s_date,policy_info.policy_ex_date,list_of_premium_cover_type.name as policy_premium_name,type_of_bussiness.bussiness_type as business_name,list_of_class.class as class_name,list_of_policy_type.policy_type,policy_info.total_own_damage,policy_info.basic_tp,policy_info.total_premium,policy_info.policy_no,list_of_clients.client_name,list_of_clients.mobile_no,list_of_pos_and_agents.agent_pos_code,list_of_pos_and_agents.name as agn_name,list_of_insurance_company.company_name,list_of_insurance_company.short_name as ins_short_name,admin_login.name as ai_name,vechile_details.vechi_cc,vechile_details.vechi_gvw,vechile_details.vechi_register_no,list_of_policy_type.policy_type as p_type,
            policy_info.no_claim_bonus, 
        	cpc.id as commissionid,
        	case 
        	    when cpc.class = '1' then cpc.agn_com_type
        	    when cpc.class = '2' then 'ON-NET.'
        	End as agn_com_type,
        	list_of_pos_and_agents.commission_category,
        	(select special_com from agent_special_com where commission_id = cpc.id and agent_id = list_of_pos_and_agents.id and policy_info.policy_issue_date between from_date and to_date) as agent_special_commission,
        	case 
        		When cpc.is_ncb = 'Yes' and no_claim_bonus = 'Yes' then 
        			(select special_com from agent_special_com where commission_id = cpc.id and agent_id = 	list_of_pos_and_agents.id and policy_info.policy_issue_date between from_date and to_date)		
        		When cpc.is_cpa = 'Yes' and cpa = 'Yes' then 
        			case when list_of_pos_and_agents.commission_category = 'A' then a_cpa
						when list_of_pos_and_agents.commission_category = 'B' then b_cpa
						when list_of_pos_and_agents.commission_category = 'C' then c_cpa
						when list_of_pos_and_agents.commission_category = 'D' then d_cpa
					end
        		ELSE
        			case 
        				when cpc.agn_com_type = 'OD' then 
        					case when list_of_pos_and_agents.commission_category = 'A' then a_od
        						when list_of_pos_and_agents.commission_category = 'B' then b_od
        						when list_of_pos_and_agents.commission_category = 'C' then c_od
        						when list_of_pos_and_agents.commission_category = 'D' then d_od
        					end
        				when cpc.agn_com_type = 'TP' then 
        					case when list_of_pos_and_agents.commission_category = 'A' then a_tp
        						when list_of_pos_and_agents.commission_category = 'B' then b_tp
        						when list_of_pos_and_agents.commission_category = 'C' then c_tp
        						when list_of_pos_and_agents.commission_category = 'D' then d_tp
        					end
        				when cpc.agn_com_type = 'ON-NET' then 
        					case when list_of_pos_and_agents.commission_category = 'A' then a_net
        						when list_of_pos_and_agents.commission_category = 'B' then b_net
        						when list_of_pos_and_agents.commission_category = 'C' then c_net
        						when list_of_pos_and_agents.commission_category = 'D' then d_net
        					end
        					
        				when cpc.agn_com_type = 'OD_AND_TP' then 
        					case when list_of_pos_and_agents.commission_category = 'A' then a_od + a_tp
        						when list_of_pos_and_agents.commission_category = 'B' then b_od + b_tp
        						when list_of_pos_and_agents.commission_category = 'C' then c_od + c_tp
        						when list_of_pos_and_agents.commission_category = 'D' then d_od + d_tp
        					end	
        				when ((cpc.agn_com_type = '') or (cpc.agn_com_type is null)) then 
        					case when list_of_pos_and_agents.commission_category = 'A' then a_net
        						when list_of_pos_and_agents.commission_category = 'B' then b_net
        						when list_of_pos_and_agents.commission_category = 'C' then c_net
        						when list_of_pos_and_agents.commission_category = 'D' then d_net
        					end	
        			end
        	End as agent_commission_percent,
        	
        	case 
        		When cpc.is_ncb = 'Yes' and no_claim_bonus = 'Yes' then 
        			cpc.ncb_percentage	
        		When cpc.is_cpa = 'Yes' and cpa = 'Yes' then 
        		    cpc.cpa_percentage
        		ELSE
        			case 
        				when cpc.agn_com_type = 'OD' then own_od				
        				when cpc.agn_com_type = 'TP' then own_tp				
        				when cpc.agn_com_type = 'ON-NET' then on_net
        				when cpc.agn_com_type = 'OD_AND_TP' then own_od + own_tp
        				when ((cpc.agn_com_type = '') or (cpc.agn_com_type is null)) then on_net
        			end
        	End as company_percent,commission_status, policy_info.vocher_status,insur_commission_status,company_vocher_status
        	,invoice_prepared,cancel_policy_status,
        	ivd.invoice_revision_id,
	        (select status from invoice _i, invoice_revision _ir where _i.id = _ir.invoice_id and _ir.id = ivd.invoice_revision_id) as invoice_status,
	        agr.voucher_no,invr.id as receipt_id,date_format(policy_info.policy_s_date, '%Y') - vechi_manu_year as age,regn_date, policy_info.old_commission_id,cpc.is_cpa as cpa,policy_info.commission_id");
      	$this->db->join("list_of_leads","policy_info.lead_id = list_of_leads.id");
  	    $this->db->join("list_of_clients","list_of_leads.client_id = list_of_clients.id");
  	    $this->db->join("list_of_pos_and_agents","policy_info.policy_agency_pos = list_of_pos_and_agents.id");
  	    $this->db->join("list_of_insurance_company","policy_info.company = list_of_insurance_company.id");
  	    $this->db->join("type_of_bussiness","list_of_leads.business_type = type_of_bussiness.id");
  	    $this->db->join("list_of_class","list_of_leads.class = list_of_class.id");
  	     $this->db->join("admin_login","admin_login.id = list_of_leads.area_incharge",'left');
  	    $this->db->join("list_of_policy_type","list_of_leads.policy_type = list_of_policy_type.id");
  	    $this->db->join("list_of_premium_cover_type","policy_info.policy_premium = list_of_premium_cover_type.id",'left');
  	    $this->db->join("vechile_details","vechile_details.lead_id = list_of_leads.id",'left');
  	    
  	    $this->db->join("company_payout_commission cpc","policy_info.commission_id = cpc.id",'left');
  	    
  	    
  	    $this->db->join("agent_commission_transaction agr","policy_info.vocher_no = agr.voucher_no",'left');
  	    $this->db->join("insurance_voucher_datails  ivd","(policy_info.lead_id = ivd.lead_id and ivd.id in (select max(id) from insurance_voucher_datails _ivd where _ivd.lead_id = ivd.lead_id))",'left');
  	    $this->db->join("invoice_receipts  invr","ivd.invoice_revision_id = invr.invoice_revision_id",'left');
  	    
  	    $this->db->where("policy_info.policy_issue_date between '{$start}' and '{$end}' ",NULL);
  	    
        if($this->session->userdata("session_role") == "AI")
        {
        	$this->db->where("list_of_leads.area_incharge",$this->session->userdata("session_id"));
        }

  	    if($ins_company != "All")
  	    {
  	        $this->db->where("policy_info.company",$ins_company);
  	    }
  	    if($select_class != "All")
  	    {
  	        $this->db->where("list_of_leads.class",$select_class);
  	    }
  	    if($policy_type != "All")
  	    {
  	        $this->db->where("list_of_leads.policy_type",$policy_type);
  	    }
  	 //   if($from_date != "All" || $from_date != "")
  	 //   {
  	        
  	 //       $this->db->where("policy_info.policy_issue_date >=",$from_date);
  	 //   }
  	 //   if($to_date != "All" || $to_date != "")
  	 //   {
  	        
  	 //      $this->db->where("policy_info.policy_issue_date <=",$to_date);
  	 //   }
  	    
  	    
  	    if($agent != "All")
  	    {
  	      $this->db->where("policy_info.policy_agency_pos",$agent);
  	    }
  	    if($area_incharge != "All")
  	    {
  	         $this->db->where("list_of_leads.area_incharge",$area_incharge);
  	    }
  	    if($user != "All")
  	    {
  	         $this->db->where("list_of_leads.assigned_user",$user);
  	    }
  	    
  	    //$this->db->where("policy_info.policy_ex_date >",date("Y-m-d"));
  	    $this->db->order_by("policy_info.policy_issue_date","Asc");
  	    $this->db->where("list_of_leads.lead_type","2");
  	    return $this->db->get("policy_info")->result();
   }
   
   
    public function _fetch_generate_policy_report($ins_company,$select_class,$policy_type,$agent,$from_date,$to_date,$area_incharge,$user)
    { 
        //set_time_limit(1500);
        $start = $from_date;
        $end = $to_date;
        
        $this->db->select("temp_policy_info.id,temp_policy_info.tot_liability_premium,temp_policy_info.lead_id,temp_policy_info.policy_issue_date,temp_policy_info.policy_s_date,temp_policy_info.com_add_com,temp_policy_info.agn_add_com,temp_policy_info.own_commission_amt,temp_policy_info.agent_commission_amt,temp_policy_info.own_commission,temp_policy_info.agent_commission,temp_policy_info.commission_status,temp_policy_info.policy_agency_pos,list_of_leads.business_type,temp_policy_info.policy_premium,list_of_leads.class,list_of_leads.assigned_user,temp_policy_info.company,temp_policy_info.gst,temp_policy_info.policy_s_date,temp_policy_info.policy_ex_date,list_of_premium_cover_type.name as policy_premium_name,type_of_bussiness.bussiness_type as business_name,list_of_class.class as class_name,list_of_policy_type.policy_type,temp_policy_info.total_own_damage,temp_policy_info.basic_tp,temp_policy_info.total_premium,temp_policy_info.policy_no,list_of_clients.client_name,list_of_clients.mobile_no,list_of_pos_and_agents.agent_pos_code,list_of_pos_and_agents.name as agn_name,list_of_insurance_company.company_name,list_of_insurance_company.short_name as ins_short_name,admin_login.name as ai_name,vechile_details.vechi_cc,vechile_details.vechi_gvw,vechile_details.vechi_register_no,list_of_policy_type.policy_type as p_type,
            temp_policy_info.no_claim_bonus, 
        	cpc.id as commissionid,
        	case 
        	    when cpc.class = '1' then cpc.agn_com_type
        	    when cpc.class = '2' then 'ON-NET.'
        	End as agn_com_type,
        	list_of_pos_and_agents.commission_category,
        	case 
        		When cpc.is_ncb = 'Yes' and no_claim_bonus = 'Yes' then 
        			(select special_com from agent_special_com where commission_id = cpc.id and agent_id = 	list_of_pos_and_agents.id and from_date >= temp_policy_info.policy_issue_date and to_date <= temp_policy_info.policy_issue_date)		
        		ELSE
        			case 
        				when cpc.agn_com_type = 'OD' then 
        					case when list_of_pos_and_agents.commission_category = 'A' then a_od
        						when list_of_pos_and_agents.commission_category = 'B' then b_od
        						when list_of_pos_and_agents.commission_category = 'C' then c_od
        						when list_of_pos_and_agents.commission_category = 'D' then d_od
        					end
        				when cpc.agn_com_type = 'TP' then 
        					case when list_of_pos_and_agents.commission_category = 'A' then a_tp
        						when list_of_pos_and_agents.commission_category = 'B' then b_tp
        						when list_of_pos_and_agents.commission_category = 'C' then c_tp
        						when list_of_pos_and_agents.commission_category = 'D' then d_tp
        					end
        				when cpc.agn_com_type = 'ON-NET' then 
        					case when list_of_pos_and_agents.commission_category = 'A' then a_net
        						when list_of_pos_and_agents.commission_category = 'B' then b_net
        						when list_of_pos_and_agents.commission_category = 'C' then c_net
        						when list_of_pos_and_agents.commission_category = 'D' then d_net
        					end
        					
        				when cpc.agn_com_type = 'OD_AND_TP' then 
        					case when list_of_pos_and_agents.commission_category = 'A' then a_od + a_tp
        						when list_of_pos_and_agents.commission_category = 'B' then b_od + b_tp
        						when list_of_pos_and_agents.commission_category = 'C' then c_od + c_tp
        						when list_of_pos_and_agents.commission_category = 'D' then d_od + d_tp
        					end	
        				when ((cpc.agn_com_type = '') or (cpc.agn_com_type is null)) then 
        					case when list_of_pos_and_agents.commission_category = 'A' then a_net
        						when list_of_pos_and_agents.commission_category = 'B' then b_net
        						when list_of_pos_and_agents.commission_category = 'C' then c_net
        						when list_of_pos_and_agents.commission_category = 'D' then d_net
        					end	
        			end
        	End as agent_commission_percent,
        	
        	case 
        		When cpc.is_ncb = 'Yes' and no_claim_bonus = 'Yes' then 
        			cpc.ncb_percentage	
        		ELSE
        			case 
        				when cpc.agn_com_type = 'OD' then own_od				
        				when cpc.agn_com_type = 'TP' then own_tp				
        				when cpc.agn_com_type = 'ON-NET' then on_net
        				when cpc.agn_com_type = 'OD_AND_TP' then own_od + own_tp
        				when ((cpc.agn_com_type = '') or (cpc.agn_com_type is null)) then on_net
        			end
        	End as company_percent,date_format(temp_policy_info.policy_s_date, '%Y') - vechi_manu_year as age");
        	
      	$this->db->join("list_of_leads","temp_policy_info.lead_id = list_of_leads.id");
  	    $this->db->join("list_of_clients","list_of_leads.client_id = list_of_clients.id");
  	    $this->db->join("list_of_pos_and_agents","temp_policy_info.policy_agency_pos = list_of_pos_and_agents.id");
  	    $this->db->join("list_of_insurance_company","temp_policy_info.company = list_of_insurance_company.id");
  	    $this->db->join("type_of_bussiness","list_of_leads.business_type = type_of_bussiness.id");
  	    $this->db->join("list_of_class","list_of_leads.class = list_of_class.id");
  	    $this->db->join("list_of_policy_type","list_of_leads.policy_type = list_of_policy_type.id");
  	    $this->db->join("list_of_premium_cover_type","temp_policy_info.policy_premium = list_of_premium_cover_type.id",'left');
  	    
  	    $this->db->join("admin_login","admin_login.id = list_of_leads.area_incharge",'left');
  	    $this->db->join("vechile_details","vechile_details.lead_id = list_of_leads.id",'left');
  	    
  	    $this->db->join("company_payout_commission cpc","temp_policy_info.commission_id = cpc.id",'left');

        $this->db->where("temp_policy_info.policy_issue_date between '{$start}' and '{$end}' ",NULL);
        
  	    if($this->session->userdata("session_role") == "AI")
        {
        	$this->db->where("list_of_leads.area_incharge",$this->session->userdata("session_id"));
        }
  	    if($ins_company != "All")
  	    {
  	        $this->db->where("temp_policy_info.company",$ins_company);
  	    }
  	    if($select_class != "All")
  	    {
  	        $this->db->where("list_of_leads.class",$select_class);
  	    }
  	    if($policy_type != "All")
  	    {
  	        $this->db->where("list_of_leads.policy_type",$policy_type);
  	    }
  	 //   if($from_date != "All")
  	 //   {
  	 //       $this->db->where("temp_policy_info.policy_issue_date >=",$from_date);
  	 //   }
  	 //   if($to_date != "All")
  	 //   {
  	 //       $this->db->where("temp_policy_info.policy_issue_date <=",$to_date);
  	 //   }
  	    if($agent != "All")
  	    {
  	      $this->db->where("temp_policy_info.policy_agency_pos",$agent);
  	    }
  	    if($area_incharge != "All")
  	    {
  	         $this->db->where("list_of_leads.area_incharge",$area_incharge);
  	    }
  	    if($user != "All")
  	    {
  	         $this->db->where("list_of_leads.assigned_user",$user);
  	    }
  	    $this->db->order_by("temp_policy_info.policy_issue_date","Asc");
  	    //$this->db->where("list_of_leads.policy_status","1");
  	    $this->db->where("list_of_leads.lead_type !=","2");
  	    return $this->db->get("temp_policy_info")->result();
   }
   


   
    public function get_policy_by_voucharno($vouchar)
    {
        $this->db->select('id');
        $this->db->where("vocher_no",$vouchar);
        return $this->db->get("policy_info")->result();
        
    }
    
    public function update_company_vocher_status($lead_id,$lead_update)
    {
        $this->db->where_in("lead_id",$lead_id);
      $this->db->update("policy_info",$lead_update);  
        
    }
    
    public function getCompanyinvoice($company,$fromdate,$todate,$policyclass, $org, $vouchar = '', $invoice_rev_id = '')
    {
        $table = ($org == 1) ? "insurance_voucher_datails" : "insurance_voucher_datails_orc";
        
        $column = ($org == 1) ? "inv.invoice_revision_id" : "inv.invoice_orc_revision_id";
        
        
        $this->db->select("inv.voucher_no as invvouchar, inv.insurer_id, inv.lead_id, inv.polic_type, inv.own_commission, inv.created_at, (select distinct company_name from list_of_insurance_company c where c.id = inv.insurer_id) as company_name, p.policy_no,p.id,p.policy_issue_date,p.tot_liability_premium,p.com_add_com,p.agn_add_com,p.own_commission_amt,p.agent_commission_amt,p.own_commission as pown_commission,p.agent_commission,p.commission_status,p.policy_agency_pos,l.business_type,p.policy_premium,l.class,p.company,p.gst,p.policy_s_date,p.policy_ex_date,pc.name as policy_premium_name,tb.bussiness_type as business_name,lc.class as class_name,pt.policy_type,p.total_own_damage,p.basic_tp,p.total_premium,p.policy_no,c.client_name,c.mobile_no,a.agent_pos_code,a.name as agn_name,co.company_name,co.short_name as ins_short_name,al.name as ai_name,Is.name as assigned_user,p.lead_id,v.vechi_cc,v.vechi_gvw,v.vechi_register_no,pt.policy_type as p_type,p.no_claim_bonus, cpc.id as commissionid,
        	case 
        	    when cpc.class = '1' then cpc.agn_com_type
        	    when cpc.class = '2' then 'ON-NET.'
        	End as agn_com_type,
        	a.commission_category,
        	case 
        		When cpc.is_ncb = 'Yes' and no_claim_bonus = 'Yes' then 
        			(select special_com from agent_special_com where commission_id = cpc.id and agent_id = 	a.id and from_date >= p.policy_issue_date and to_date <= p.policy_issue_date)		
        		ELSE
        			case 
        				when cpc.agn_com_type = 'OD' then 
        					case when a.commission_category = 'A' then a_od
        						when a.commission_category = 'B' then b_od
        						when a.commission_category = 'C' then c_od
        						when a.commission_category = 'D' then d_od
        					end
        				when cpc.agn_com_type = 'TP' then 
        					case when a.commission_category = 'A' then a_tp
        						when a.commission_category = 'B' then b_tp
        						when a.commission_category = 'C' then c_tp
        						when a.commission_category = 'D' then d_tp
        					end
        				when cpc.agn_com_type = 'ON-NET' then 
        					case when a.commission_category = 'A' then a_net
        						when a.commission_category = 'B' then b_net
        						when a.commission_category = 'C' then c_net
        						when a.commission_category = 'D' then d_net
        					end
        					
        				when cpc.agn_com_type = 'OD_AND_TP' then 
        					case when a.commission_category = 'A' then a_od + a_tp
        						when a.commission_category = 'B' then b_od + b_tp
        						when a.commission_category = 'C' then c_od + c_tp
        						when a.commission_category = 'D' then d_od + d_tp
        					end	
        				when ((cpc.agn_com_type = '') or (cpc.agn_com_type is null)) then 
        					case when a.commission_category = 'A' then a_net
        						when a.commission_category = 'B' then b_net
        						when a.commission_category = 'C' then c_net
        						when a.commission_category = 'D' then d_net
        					end	
        			end
        	End as agent_commission_percent,
        	
        	case 
        		When cpc.is_ncb = 'Yes' and no_claim_bonus = 'Yes' then 
        			cpc.ncb_percentage	
        		ELSE
        			case 
        				when cpc.agn_com_type = 'OD' then own_od				
        				when cpc.agn_com_type = 'TP' then own_tp				
        				when cpc.agn_com_type = 'ON-NET' then on_net
        				when cpc.agn_com_type = 'OD_AND_TP' then own_od + own_tp
        				when ((cpc.agn_com_type = '') or (cpc.agn_com_type is null)) then on_net
        			end
        	End as company_percent, {$column} as invoice_revision_id");
        
        
        $this->db->join("policy_info p","p.lead_id = inv.lead_id",'left');
        $this->db->join("list_of_leads l","p.lead_id = l.id");
  	    $this->db->join("list_of_clients c","l.client_id = c.id");
  	    $this->db->join("list_of_pos_and_agents a","p.policy_agency_pos = a.id");
  	    $this->db->join("list_of_insurance_company co","p.company = co.id");
  	    $this->db->join("type_of_bussiness tb","l.business_type = tb.id");
  	    $this->db->join("list_of_class lc","l.class = lc.id");
  	    $this->db->join("admin_login al","al.id = l.area_incharge",'left');
  	    $this->db->join("admin_login Is","Is.id = l.assigned_user",'left');
  	    $this->db->join("list_of_policy_type pt","l.policy_type = pt.id");
  	    $this->db->join("list_of_premium_cover_type pc","p.policy_premium = pc.id","left");	
  	    
  	    $this->db->join("vechile_details v","v.lead_id = l.id",'left');
  	    
  	    $this->db->join("company_payout_commission cpc","p.commission_id = cpc.id",'left');
  	    
        if( $fromdate && $todate ){
            $this->db->where("inv.fromdate between '$fromdate' and '$todate'",NULL);
            $this->db->where("inv.todate between '$fromdate' and '$todate'",NULL);    
        }
        
        if($company)
            $this->db->where("inv.insurer_id",$company);
            
        if($vouchar)
            $this->db->where("inv.voucher_no",$vouchar);
            
        if($invoice_rev_id) {
            if($org == 1)
                $this->db->where("inv.invoice_revision_id",$invoice_rev_id);
            else
                $this->db->where("inv.invoice_orc_revision_id",$invoice_rev_id);
        }
        return $this->db->get("{$table} inv")->result();
    }
    
    public function fetch_commission_status_update($from_date,$to_date)
    {
         $this->db->where("policy_info.policy_s_date >=",$from_date);
        $this->db->where("policy_info.policy_s_date <=",$to_date);
        return $this->db->get("policy_info")->result();
    }
    
     public function update_excel_status($data)
    {
         $this->db->insert("agent_vocher_excel_report",$data);
    }
    
    public function fetch_excel_status($from_date,$to_date, $agent, $org)
    {   
        $this->db->where("date(from_date) >=",$from_date);
        $this->db->where("date(to_date) <=",$to_date);
        $this->db->where("agent_id = ",(($agent) ? $agent : 0));
        $this->db->where("org_id = ",$org);
        
        $this->db->where("excel_report_status","1");
        return $this->db->get("agent_vocher_excel_report")->row();
    }
    
    public function getUserList() {
        $this->db->select('id, username');
        $this->db->where('role', 'user');
        $this->db->order_by('trim(username)', 'asc');
        return $this->db->get("admin_login")->result();
    }
    
     public function get_agent_commission_bank_details($from_date,$to_date,$agents, $table)
    {
        $field = ($table == "agent_voucher_details") ? "total_commission" : "commission_amt";
        
         $this->db->select("SUM(av.{$field}) as amount,agn.name,agn.agent_pos_code,agn.bank_acc_no,agn.bank_name,agn.ifsc_code,agn.branch,agn.pan_card_no,sum(av.tds_amt) as tds_amt, sum(av.netpay) as netpay, av.voucher_no");
         $this->db->join("list_of_pos_and_agents agn","av.agent_id = agn.id");
         $this->db->where("av.from_date >=",$from_date);
         $this->db->where("av.to_date <=",$to_date);
         if($agents != "")
         {
         $this->db->where("av.agent_id",$agents);
         }
         $this->db->group_by('agn.name,agn.agent_pos_code,agn.bank_acc_no,agn.bank_name,agn.ifsc_code,agn.branch,agn.pan_card_no,av.voucher_no');
         return $this->db->get("{$table} av")->result();
    }
    
    public function getTDSPercentage($options)
    {
    	if( isset( $options['fromdate'] ) && !empty( $options['fromdate'] ) ){
    		$this->db->where('fromdate >= ', $options['fromdate']);
    	}
    	if( isset( $options['todate'] ) && !empty( $options['todate'] ) ){
    		$this->db->where('todate <= ', $options['todate']);
    	}
    	if( isset( $options['company'] ) && !empty( $options['company'] ) ){
    		$this->db->where('insurer_company', $options['company']);
    	}
    	return $this->db->get("tds_amount_entry")->row();
    }
    
   
}