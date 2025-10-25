<?php
class BundelMod extends CI_Model {
    
    function __construct(){
        parent::__construct();
        $this->load->dbforge();
    }
    
    public function fetch_list_of_insurance_company()
    {
        $this->db->DISTINCT();
        $this->db->select('*');
        $this->db->order_by('company_name','ASC');
        return $this->db->get('list_of_insurance_company')->result();
    }
    public function fetch_list_of_class()
    {
        $this->db->select('*');
        $this->db->order_by('class','ASC');
        return $this->db->get('list_of_class')->result();
    }
    public function fetch_list_of_policy_type()
    {
        $this->db->select('*');
        $this->db->order_by('policy_type','ASC');
        return $this->db->get('list_of_policy_type')->result();
    }
    
    public function fetch_bundel_master()
    {
        $this->db->select('bm.*, ic.company_name as ic_company_name, cl.class as cl_class, pt.policy_type as pt_policy_type');
        $this->db->from("bundel_master bm");
        $this->db->join('list_of_insurance_company ic','ic.id = bm.insurance_company_id','left');
        $this->db->join('list_of_class cl','cl.id = bm.class_id','left');
        $this->db->join('list_of_policy_type pt','pt.id = bm.policy_type_id','left');
        $this->db->order_by('bm.id', 'desc');
        $res = $this->db->get();
        return $res->result();
    }
    public function add_bundel_master($data)
  	{
  		if($this->db->insert("bundel_master",$data)){
  		    return true;
  		}
  		
  		return false;
  	}
  	public function edit_bundel_master($id, $data)
    {
        $this->db->where("id", $id);
        
        if ($this->db->update("bundel_master", $data)) {
            return true;
        }
            return false;
    }
    public function fetch_edit_bundel_master($id)
  	{
  	    $this->db->where("id",$id);
  	    return $this->db->get("bundel_master")->row();
  	}
  	public function update_bundel_master_status($data,$id)
	{
	    $this->db->where("id",$id);
	    if ($this->db->update("bundel_master",$data)) {
	        return true;
	    }
            return false;
	}
	
	public function getPolicyType($policytype_id)
	{
	    if( $policytype_id > 0)
	        $this->db->where('policy_class', $policytype_id);
	    return $this->db->get('list_of_policy_type')->result();
	}

}