<?php  
class InvoiceMod extends CI_Model  
{  
  	function __construct()  
  	{ 
    	parent::__construct();  
    	$this->load->dbforge();
  	}
  	
  	
  	public function get_insurance_company_list()
   {
       return $this->db->get("list_of_insurance_company")->result();
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
   
   public function get_policy_cover_type()
   {
       return $this->db->get("list_of_premium_cover_type")->result();
   }
  	
  public function get_all_policies($ins_company,$select_class,$select_c_type,$from_date,$to_date)
  { 
        $this->db->select("policy_info.id,policy_info.com_add_com,policy_info.agn_add_com,policy_info.own_commission_amt,policy_info.agent_commission_amt,policy_info.commission_status,policy_info.policy_agency_pos,list_of_leads.business_type,policy_info.policy_premium,list_of_leads.class,policy_info.rto,policy_info.vehicle_classification,policy_info.category,policy_info.company,policy_info.state,policy_info.gst,policy_info.policy_s_date,policy_info.policy_ex_date,list_of_premium_cover_type.name as policy_premium_name,type_of_bussiness.bussiness_type as business_name,list_of_class.class as class_name,list_of_policy_type.policy_type,policy_info.total_own_damage,policy_info.basic_tp,policy_info.total_premium,policy_info.policy_no,list_of_clients.client_name,list_of_clients.mobile_no,list_of_pos_and_agents.agent_pos_code,list_of_insurance_company.company_name,list_of_insurance_company.short_name as ins_short_name");
      	$this->db->join("list_of_leads","policy_info.lead_id = list_of_leads.id");
  	    $this->db->join("list_of_clients","list_of_leads.client_id = list_of_clients.id");
  	    $this->db->join("list_of_pos_and_agents","policy_info.policy_agency_pos = list_of_pos_and_agents.id");
  	    $this->db->join("list_of_insurance_company","policy_info.company = list_of_insurance_company.id");
  	    $this->db->join("type_of_bussiness","list_of_leads.business_type = type_of_bussiness.id");
  	    $this->db->join("list_of_class","list_of_leads.class = list_of_class.id");
  	    $this->db->join("list_of_policy_type","list_of_leads.policy_type = list_of_policy_type.id");
  	    $this->db->join("list_of_premium_cover_type","policy_info.policy_premium = list_of_premium_cover_type.id");
  	    
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
  	        $this->db->where("policy_info.created_date >=",$from_date);
  	    }
  	   if($to_date != "all")
  	    {
  	        $this->db->where("policy_info.created_date <=",$to_date);
  	    }
  	    
  	    $this->db->where("policy_info.policy_ex_date >",date("Y-m-d"));
  	    return $this->db->get("policy_info")->result();
   }
   
    public function fetch_single_company_settings($company_id)
    {
        $this->db->where("id",$company_id);
        return $this->db->get("company_settings")->row();
    }
}