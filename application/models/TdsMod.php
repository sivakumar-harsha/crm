<?php  
class TdsMod extends CI_Model  
{  
  	function __construct()  
  	{ 
    	parent::__construct();  
    	$this->load->dbforge();
  	}
  	
  	
  	public function fetch_poilicy_class_list($policy_class)
  	{
  	    $this->db->where("policy_class",$policy_class);
  	    return $this->db->get("list_of_policy_type")->result();
  	}
  	
  	public function add_tds_amount($data)
  	{
  	    $this->db->insert("tds_amount_entry",$data);
  	}
  	
  	public function fetch_tds_amount_list($from_date,$to_date)
  	{
  	    
  	    
  	    $this->db->join("list_of_insurance_company","tds_amount_entry.insurer_company = list_of_insurance_company.id");
  	     $this->db->join("list_of_policy_type","tds_amount_entry.policy_type = list_of_policy_type.id");
  	      $this->db->join("list_of_class","tds_amount_entry.policy_class = list_of_class.id");
  	    if($from_date != "")
  	    {
  	      $this->db->where("fromdate >=",$from_date);
  	    }
  	    if($to_date != "")
  	    {
  	      $this->db->where("todate <=",$to_date);
  	    }
  	    
  	      return $this->db->get("tds_amount_entry")->result();
  	}
  	
  	public function edit_tds_amount($data,$id)
  	{
  	    $this->db->where("id",$id);
  	    $this->db->update("tds_amount_entry",$data);
  	}
  	
  	public function fetch_edit_tds_amount($id)
  	{
  	     $this->db->where("id",$id);
  	     return $this->db->get("tds_amount_entry")->row();
  	}
  	
  	
  	
}