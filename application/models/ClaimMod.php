<?php  
class ClaimMod extends CI_Model  
{  
  	function __construct()  
  	{ 
    	parent::__construct();  
    	$this->load->dbforge();
  	}
  	
  	public function fetch_all_customers()
  	{
  	    $this->db->select("list_of_clients.*,list_of_leads.id as lead_id");
  	    $this->db->from("list_of_clients");
  	    $this->db->join("list_of_leads","list_of_clients.id = list_of_leads.client_id");
  	    $this->db->join("policy_info","list_of_leads.id = policy_info.lead_id");
  	    $this->db->where("list_of_leads.lead_type=",2);
  	    $this->db->where("policy_info.policy_ex_date >=",date("Y-m-d"));
  	    return $this->db->get()->result();
  	}
  	
  	public function list_of_pos_and_agents()
  	{
  	    return $this->db->get("list_of_pos_and_agents")->result();
  	}
  	
  	public function fetch_policy_no($lead_id)
  	{
  	    $this->db->where("lead_id",$lead_id);
  	    return $this->db->get("policy_info")->row();
  	}
  	
  	public function fetch_client_details_by_policy_no($policy_no)
  	{
  	    $this->db->select("list_of_clients.*,list_of_leads.id as lead_id,vechile_details.policy_type,vechile_details.vechile_type,type_of_bussiness.bussiness_type,vechile_details.vechi_register_no,list_of_leads.class");
  	    $this->db->from("list_of_clients");
  	    $this->db->join("list_of_leads","list_of_clients.id = list_of_leads.client_id");
  	   $this->db->join("type_of_bussiness","list_of_leads.business_type = type_of_bussiness.id");
  	   $this->db->join("vechile_details","list_of_leads.id = vechile_details.lead_id","left");
  	    $this->db->join("policy_info","list_of_leads.id = policy_info.lead_id");
  	    $this->db->where("list_of_leads.lead_type=",2);
  	    $this->db->where("policy_info.policy_ex_date >=",date("Y-m-d"));
  	    $this->db->where("policy_info.policy_no",$policy_no);
  	    return $this->db->get()->row();
  	}
  	
  	public function fetch_client_details_by_regn_no($v_regn_number)
  	{
    $this->db->select("list_of_clients.*,list_of_leads.id as lead_id,vechile_details.policy_type,vechile_details.vechile_type,type_of_bussiness.bussiness_type,vechile_details.vechi_register_no,policy_info.policy_no");
    $this->db->from("list_of_clients");
    $this->db->join("list_of_leads","list_of_clients.id = list_of_leads.client_id");
    $this->db->join("type_of_bussiness","list_of_leads.business_type = type_of_bussiness.id");
    $this->db->join("vechile_details","list_of_leads.id = vechile_details.lead_id");
    $this->db->join("policy_info","list_of_leads.id = policy_info.lead_id");
    $this->db->where("list_of_leads.lead_type=",2);
    $this->db->where("policy_info.policy_ex_date >=",date("Y-m-d"));
    $this->db->where("vechile_details.vechi_register_no",$v_regn_number);
    return $this->db->get()->row();
  	
  	}
  	
  	
  	public function insert_spot_photos($data)
  	{
  	    $this->db->insert("spot_photos",$data);
  	}
  	
  	public function add_claim_details($datas)
  	{
  	    $this->db->insert("claim_list",$datas);
  	    return $this->db->insert_id();
  	}
  	
  	public function fetch_claims($status)
  	{
  	    $this->db->select("claim_list.*,list_of_pos_and_agents.name as agent_name,admin_login.name as user_name");
  	    $this->db->from("claim_list");
  	    
  	     if($status != "")
  	    {
  	        $this->db->where("claim_list.status",$status);
  	    }
  	    $this->db->join("admin_login","claim_list.created_by = admin_login.id","left");
  	    $this->db->join("list_of_pos_and_agents","claim_list.agent_pos = list_of_pos_and_agents.id","left");
  	    $this->db->order_by("id","desc");
  	    return $this->db->get()->result();
  	}
  	public function add_claim_report($data_2)
  	{
  	    $this->db->insert("claim_track",$data_2);
  	}
  	public function fetch_claim_dateils($client_id)
  	{
  	   $this->db->select("claim_track.*,claim_list.client_name as sname");
  	   $this->db->from("claim_track");
  	   $this->db->join("claim_list","claim_track.client_id = claim_list.client_id");// by kgk on 2023-02-13 claim_list.id to client_id
  	   $this->db->order_by("id","desc");
  	   $this->db->where("claim_track.client_id",$client_id);
  	   return $this->db->get()->result();
  	}
  	
  	public function fetch_claims_details($client_id)
  	{
  	   $this->db->select("claim_list.*,list_of_clients.client_name as sname, list_of_clients.mobile_no as cmobile,list_of_clients.address as naddress ");
  	   $this->db->from("claim_list");
  	   $this->db->join("list_of_clients","claim_list.client_id = list_of_clients.id");
  	    $this->db->where("claim_list.client_id",$client_id);
  	   return $this->db->get()->row();  
  	}
  	
  	
  	// Advance Search Client
  	
  	public function fetch_client_details_search($client_name,$policy_no,$vechicle_no)
  	{
  	    $this->db->select("list_of_clients.*,list_of_leads.id as lead_id,vechile_details.rto,vechile_details.vechi_register_no,list_of_insurance_company.company_name");
  	    $this->db->from("list_of_clients");
  	    $this->db->join("list_of_leads","list_of_clients.id = list_of_leads.client_id");
  	    $this->db->join("vechile_details","list_of_leads.id = vechile_details.lead_id",'left');
  	    $this->db->join("policy_info","list_of_leads.id = policy_info.lead_id",'left');
  	    $this->db->join("list_of_insurance_company","policy_info.company = list_of_insurance_company.id",'left');
  	   
  	    if($client_name != "")
  	    {
  	        $this->db->where("list_of_clients.client_name",$client_name);
  	    }
  	    if($policy_no != "")
  	    {
  	        $this->db->where('policy_info.policy_no',$policy_no); 
  	    }
  	    if($vechicle_no != "")
  	    {
  	         $this->db->where('vechile_details.vechi_register_no',$vechicle_no); 
  	    }
  	    $this->db->where("list_of_leads.lead_type","2");
  	    return $this->db->get()->result();
  	}
  	
  public function fetch_agent_details($agent_name,$agent_code,$agent_mobile)
   {
        if($agent_name != "")
  	    {
  	        $this->db->where("list_of_pos_and_agents.name",$client_name);
  	    }
  	    if($agent_code != "")
  	    {
  	        $this->db->where("list_of_pos_and_agents.agent_pos_code",$agent_code);
  	    }
  	    if($agent_mobile != "")
  	    {
  	        $this->db->where("list_of_pos_and_agents.phoneno",$agent_mobile);
  	    }
        
      return $this->db->get("list_of_pos_and_agents")->result();
   } 
  	
  public function fetch_ai_details($ai_name,$ai_mobile_no,$ai_email)
  {
        if($ai_name != "")
  	    {
  	        $this->db->where("admin_login.name",$ai_name);
  	    }
  	    if($ai_mobile_no != "")
  	    {
  	        $this->db->where("admin_login.phoneno",$ai_mobile_no);
  	    }
  	    if($ai_email != "")
  	    {
  	        $this->db->where("admin_login.email_id",$ai_email);
  	    }
        
      return $this->db->get("admin_login")->result();
  }
  
   	public function fetch_areaincharge()
  	{
  	     $this->db->where("role","AI");
  	    return $this->db->get("admin_login")->result();
  	}
  	
  	public function add_complete_claim($id,$data)
   {
       $this->db->where("id",$id);
        $this->db->update("claim_list",$data);
    }
    
    public function fetch_complete_claim($status)
  	{
  	    $this->db->select("claim_list.*,list_of_pos_and_agents.name as agent_name,admin_login.name as user_name");
  	    $this->db->from("claim_list");
  	    
  	    if($status != "")
  	    {
  	        $this->db->where("claim_list.status",$status);
  	    }
  	    
  	    $this->db->join("admin_login","claim_list.created_by = admin_login.id");
  	    $this->db->join("list_of_pos_and_agents","claim_list.agent_pos = list_of_pos_and_agents.id");
  	    $this->db->order_by("id","desc");
  	    return $this->db->get()->result();
    	}
    	
    	
 public function upload_claim_document_files($data)
	{
	    $this->db->insert("claim_documents",$data);
  	    $insert_id = $this->db->insert_id();
        $this->db->where("id",$insert_id);
        return $this->db->get("claim_documents")->row();
	}
   public function fetch_claim_documents($lead_id)
    {
        $this->db->where("lead_id",$lead_id);
        return $this->db->get("claim_documents")->result();
    }
  public function fetch_policy_details_info($lead_id)    
  {
      $this->db->where("lead_id",$lead_id);
      return $this->db->get("policy_documents")->row();
  }    
  
  public function fetch_edit_claim_data($id) 
  {
      
      $this->db->select("claim_list.*,list_of_clients.client_name as clientname");
      $this->db->where("claim_list.id",$id);
      $this->db->join("list_of_pos_and_agents","claim_list.agent_pos = list_of_pos_and_agents.id");
  	  $this->db->join("admin_login","claim_list.ai_id = admin_login.id");
  	  $this->db->join("list_of_clients","claim_list.client_id = list_of_clients.id");
      return $this->db->get("claim_list")->row();
  }


 public function update_claim_details($data, $claim_id)
 {
      $this->db->where("id",$claim_id);
      $this->db->update("claim_list",$data);
 }
 
    public function fetch_policy_info($lead_id)
   	{
   	    
   	  $this->db->select("list_of_leads.*,list_of_clients.client_name,list_of_clients.mobile_no,list_of_clients.address,list_of_clients.area,vechile_details.rto,vechile_details.vechi_register_no,list_of_insurance_company.company_name,policy_info.policy_s_date,policy_info.policy_ex_date");
   	 
   	    $this->db->join("policy_info","list_of_leads.id = policy_info.lead_id",'left');
   	    $this->db->join("list_of_insurance_company","policy_info.company = list_of_insurance_company.id");
   	   $this->db->join("vechile_details","list_of_leads.id = vechile_details.lead_id",'left');
   	   $this->db->join("list_of_clients","list_of_leads.client_id = list_of_clients.id");
  	   $this->db->where("list_of_leads.id",$lead_id);
  	   return $this->db->get("list_of_leads")->row();  
  	}
	
  	
}