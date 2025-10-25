<?php  
class ProfileMod extends CI_Model  
{  
  	function __construct()  
  	{ 
    	parent::__construct();  
    	$this->load->dbforge();
  	}
  	
  	public function fetch_project_info()
  	{
  		return $this->db->get("project_info")->row();
  	}


    // 	Profile Agent Get_data Start
	
	public function fetch_admin_info($session_id)
	{
	     $this->db->where("id",$session_id);
	     return $this->db->get("admin_login")->row();
	}
	
	public function fetch_company_info($session_id)
	{
	     $this->db->where("id",$session_id);
	     return $this->db->get(" company_settings")->row();
	}
	
    // 	Profile Agent Get_data End
    
    // profile agent update data Start	
	
	public function add_profile_admin($data,$id)
	{
	    $this->db->where("id",$id);
	    $this->db->update("admin_login",$data);
	}
         
      
	public function fetch_policy_type_using_class($class=10)
  	{
  	    $this->db->where("status !=",'1');
  	    $this->db->where("policy_class",$class);
  	    
  	    return $this->db->get("list_of_policy_type")->result();
  	}
     public function add_company_setting($data1,$id)
	{
	    $this->db->where("id",$id);
	    $this->db->update("company_settings",$data1);
	}
	public function add_smedetails($data)
    {
        $this->db->insert("sme_marine_details",$data);
        return $this->db->insert_id();
    }
  	public function add_smedetails_coveringclauses($data1)
  	{
  	  $this->db->insert("smedetails_coveringclauses",$data1);
  	}
  	public function add_smedetails_marine($data3)
  	{
  	  $this->db->insert("smedetails_marine",$data3);
  	}
  	public function add_smedetails_fire_suminsured($data2)
  	{
  	  $this->db->insert("sme_fire_and_burgulary",$data2);
  	}
    public function add_smedetails_workpolicy($data4)
  	{
  	  $this->db->insert("smedetails_workpolicy",$data4);
  	  return $this->db->insert_id();
  	}
  	public function add_smedetails_clausesattched($data5)
  	{
  	  $this->db->insert("smedetails_workpolicy_clausesattched",$data5);
  	}
  	public function fetch_policy()
    {
    return $this->db->get("smepolicy_type")->result();
    }
  	
  	public function add_policy($data)
    {
        $this->db->insert("smepolicy_type",$data);
    }
    
    public function fetch_edit_smepolicy($id)
    {
        $this->db->where("id",$id);
        return $this->db->get("smepolicy_type")->row();
    }
    public function edit_sempolicy($id, $data)
    {
        $this->db->where("id",$id);
        $this->db->update("smepolicy_type",$data);
    }
    public function delete_policy($id)
    {
        $this->db->where("id",$id);
        $this->db->delete("smepolicy_type");
    }
    
   public function fetch_smepolicy()
    {
        return $this->db->get("smepolicy_type")->result();
    }
  	public function add_smedatails_bilding_policy($data3)
  	{
  	  $this->db->insert("sem_building_property_policy",$data3);
  	}  
         
    // profile admin update data End
}