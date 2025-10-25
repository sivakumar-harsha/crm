<?php
class CompanyfixMod extends CI_Model {
    
    function __construct()
    {
        parent::__construct();
        $this->load->dbforge();
    }
    
    public function fetch_generate_companyfix_policy($from_date,$to_date,$select_insurance)
	{
      	$this->db->select("policy_info.id,policy_info.lead_id,company_payout_commission.id as com_id,company_payout_commission.no_of_policy_id,policy_info.agent_commission_amt,policy_info.agent_commission,policy_info.own_commission_amt,policy_info.own_commission,policy_info.agent_commission_amt,policy_info.policy_agency_pos,list_of_leads.business_type,policy_info.policy_premium,list_of_leads.class,policy_info.company,policy_info.gst,policy_info.policy_s_date,policy_info.policy_ex_date,list_of_premium_cover_type.name as policy_premium_name,type_of_bussiness.bussiness_type as business_name,list_of_class.class as class_name,list_of_policy_type.policy_type,policy_info.total_own_damage,policy_info.tot_liability_premium,policy_info.basic_tp,policy_info.total_premium,policy_info.policy_no,policy_info.company_vocher_status,policy_info.invoice_prepared,list_of_clients.client_name,list_of_clients.mobile_no,list_of_pos_and_agents.agent_pos_code,list_of_insurance_company.company_name,company_payout_commission.commission_type,company_payout_commission.net_premium_id, admin_login.name as user");
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
  	    
      	//$this->db->where("policy_info.commission_status =","1");
      	$this->db->where_not_in("policy_info.cancel_policy_status",["3", "4"]);
      	$this->db->where("list_of_leads.lead_type","2");
      	$this->db->where("policy_info.company_vocher_status","0");
      	$this->db->where("policy_info.invoice_prepared !=","Y");
      	//$this->db->where("policy_info.policy_no","32760519202200");
      	$this->db->where("policy_info.policy_issue_date >=",$from_date);
      	$this->db->where("policy_info.policy_issue_date <=",$to_date);
      	
      	/*if($select_agents != "")
      	{
      	$this->db->where("policy_info.policy_agency_pos",$select_agents);
      	}*/
      	
      	if($select_insurance != "")
      	{
      	$this->db->where("policy_info.company",$select_insurance);
      	}
      	/*
      	if($user)
      	    $this->db->where("list_of_leads.assigned_user", $user);*/
      	    
      	return $this->db->get("policy_info")->result();
	}
	
	public function fetch_companyfix_poilicy_list($from_date,$to_date)
    {
        $this->db->distinct("trim(list_of_pos_and_agents.name) as name,list_of_pos_and_agents.agent_pos_code,list_of_pos_and_agents.id");
        $this->db->select("list_of_pos_and_agents.name,list_of_pos_and_agents.agent_pos_code,list_of_pos_and_agents.id");
        $this->db->join("policy_info","policy_info.policy_agency_pos = list_of_pos_and_agents.id");
        $this->db->where("policy_info.policy_s_date >=",$from_date);
        $this->db->where("policy_info.policy_s_date <=",$to_date);
        $this->db->where("policy_info.vocher_status","0");
        $this->db->order_by('trim(list_of_pos_and_agents.name)', 'asc');
        return $this->db->get("list_of_pos_and_agents")->result();
    }
    
    public function fetch_companyfix_policy_insurance_company($from_date,$to_date)
    {
        $this->db->distinct("list_of_insurance_company.company_name,list_of_insurance_company.id");
        $this->db->select("list_of_insurance_company.company_name,list_of_insurance_company.id");
        $this->db->join("policy_info","policy_info.company = list_of_insurance_company.id");
        $this->db->where("policy_info.policy_s_date >=",$from_date);
        $this->db->where("policy_info.policy_s_date <=",$to_date);
        $this->db->where("policy_info.commission_status","1");
        //$this->db->where("policy_info.vocher_status","0");
        return $this->db->get("list_of_insurance_company")->result();
    }
    
    public function update_cancel_companyfix_policy_status($data,$cancel_id)
    {
       $this->db->where("id",$cancel_id);
       $this->db->update("policy_info",$data);
    }
    
    public function update_companyfix_policy_hold_list($data,$hold_id)
    {
       $this->db->where("id",$hold_id);
       $this->db->update("policy_info",$data);
    }
    
    public function companyfix_invoice_report($data, $id)
    {
        $this->db->where("id",$id);
        $this->db->update("policy_info",$data);
    }
    
    public function companylist() {
		$this->db->select("company_name,id");
		return $this->db->get("list_of_insurance_company")->result();
	}
    
    public function get_hold_or_cancel_policy($month, $company_id)
	{
      	$this->db->select("policy_info.id,policy_info.lead_id,company_payout_commission.id as com_id,company_payout_commission.no_of_policy_id,policy_info.agent_commission_amt,policy_info.agent_commission,policy_info.own_commission_amt,policy_info.own_commission,policy_info.agent_commission_amt,policy_info.policy_agency_pos,list_of_leads.business_type,policy_info.policy_premium,list_of_leads.class,policy_info.company,policy_info.gst,policy_info.policy_s_date,policy_info.policy_ex_date,list_of_premium_cover_type.name as policy_premium_name,type_of_bussiness.bussiness_type as business_name,list_of_class.class as class_name,list_of_policy_type.policy_type,policy_info.total_own_damage,policy_info.tot_liability_premium,policy_info.basic_tp,policy_info.total_premium,policy_info.policy_no,list_of_clients.client_name,list_of_clients.mobile_no,list_of_pos_and_agents.agent_pos_code,list_of_insurance_company.company_name,company_payout_commission.commission_type,company_payout_commission.net_premium_id, policy_info.cancel_policy_status");
      	$this->db->join("list_of_leads","policy_info.lead_id = list_of_leads.id");
  	    $this->db->join("list_of_clients","list_of_leads.client_id = list_of_clients.id");
  	    $this->db->join("list_of_pos_and_agents","policy_info.policy_agency_pos = list_of_pos_and_agents.id");
  	    $this->db->join("list_of_insurance_company","policy_info.company = list_of_insurance_company.id");
  	    $this->db->join("type_of_bussiness","list_of_leads.business_type = type_of_bussiness.id");
  	    $this->db->join("list_of_class","list_of_leads.class = list_of_class.id");
  	    $this->db->join("list_of_policy_type","list_of_leads.policy_type = list_of_policy_type.id");
  	    $this->db->join("list_of_premium_cover_type","policy_info.policy_premium = list_of_premium_cover_type.id",'left');
  	    $this->db->join("company_payout_commission","company_payout_commission.id = policy_info.commission_id", 'left');
  	    
  	    if($month) {
			$this->db->where("date(policy_info.policy_issue_date) between {$month}",null);
		}

		if($company_id) {
			$this->db->where("policy_info.company",$company_id);
		}
		
      	//$this->db->where("policy_info.commission_status !=","1");
      	$this->db->where_in("policy_info.cancel_policy_status",["3","4"]);
      	$this->db->where("list_of_leads.lead_type","2");
      	return $this->db->get("policy_info")->result();
	}
    
	
	
}