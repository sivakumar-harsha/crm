<?php  
class MasterMod extends CI_Model  
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
  	public function fetch_brand()
  	{
  	    //$this->db->cache_on();
  		$res = $this->db->get("list_of_car_brand")->result();
  		//$this->db->cache_off();
  		return $res;
  	}
  	public function add_brand($data)
  	{
  		$this->db->insert("list_of_car_brand",$data);
  		//$this->db->cache_delete("fetch_brand","index"); 
  	}
  	public function fetch_edit_brand($id)
  	{
  	    //$this->db->cache_delete("fetch_edit_brand","index");
  	    //$this->db->cache_delete_all();
  		$this->db->where("id",$id);
  		return $this->db->get("list_of_car_brand")->row();
  	}
  	public function edit_brand($id, $data)
  	{
  		$this->db->where("id",$id);
  		$this->db->update("list_of_car_brand",$data);
  		//$this->db->cache_delete("fetch_brand","index"); 
  	}
  	public function delete_brand($id)
  	{
  		$this->db->where("id",$id);
  		$this->db->delete("list_of_car_brand");
  		//$this->db->cache_delete("fetch_brand","index"); 
  	}
  	
  	//Model
  	
  	public function fetch_model()
  	{
  	    $this->db->select("list_of_car_model.id,list_of_car_model.model_name,list_of_car_brand.brand_name,list_of_car_model.file");
  	    $this->db->join("list_of_car_brand","list_of_car_brand.id = list_of_car_model.brand_id");
  		$res = $this->db->get("list_of_car_model")->result();
  		return $res;
  	}
  	
  
  	public function add_model($data)
  	{
  		$this->db->insert("list_of_car_model",$data);
  	}
  	public function fetch_edit_model($id)
  	{
  		$this->db->where("id",$id);
  		return $this->db->get("list_of_car_model")->row();
  	}
  	public function edit_model($id, $data)
  	{
  		$this->db->where("id",$id);
  		$this->db->update("list_of_car_model",$data);
  	}
  	public function delete_model($id)
  	{
  		$this->db->where("id",$id);
  		$this->db->delete("list_of_car_model");
  	}
  	
  	//fuel_type
  	

  	public function fetch_fuel_type()
  	{
  		return $this->db->get("list_of_car_fuel_type")->result();
  	}
  	public function add_fuel_type($data)
  	{
  		$this->db->insert("list_of_car_fuel_type",$data);
  	}
  	public function fetch_edit_fuel_type($id)
  	{
  		$this->db->where("id",$id);
  		return $this->db->get("list_of_car_fuel_type")->row();
  	}
  	public function edit_fuel_type($id, $data)
  	{
  		$this->db->where("id",$id);
  		$this->db->update("list_of_car_fuel_type",$data);
  	}
  	public function delete_fuel_type($id)
  	{
  		$this->db->where("id",$id);
  		$this->db->delete("list_of_car_fuel_type");
  	}
  	
  	//Varient
  	
  	public function fetch_varient()
  	{
  	    $this->db->select("list_of_car_varient.id,list_of_car_varient.varient_name,list_of_car_brand.brand_name,list_of_car_model.model_name,list_of_car_fuel_type.fuel_type");
  	    $this->db->join("list_of_car_brand","list_of_car_brand.id = list_of_car_varient.brand_id");
  	    $this->db->join("list_of_car_model","list_of_car_model.id = list_of_car_varient.model_id");
  	    $this->db->join("list_of_car_fuel_type","list_of_car_fuel_type.id = list_of_car_varient.fuel_id");
  		return $this->db->get("list_of_car_varient")->result();
  	}
  	public function add_varient($data)
  	{
  		$this->db->insert("list_of_car_varient",$data);
  	}
  	public function fetch_edit_varient($id)
  	{
  		$this->db->where("id",$id);
  		return $this->db->get("list_of_car_varient")->row();
  	}
  	public function edit_varient($id, $data)
  	{
  		$this->db->where("id",$id);
  		$this->db->update("list_of_car_varient",$data);
  	}
  	public function delete_varient($id)
  	{
  		$this->db->where("id",$id);
  		$this->db->delete("list_of_car_varient");
  	}
  	public function get_model_list($id)
  	{
  	    $this->db->where("brand_id",$id);
  		return $this->db->get("list_of_car_model")->result();
  	}
  	
  	//gc Brand
  	
  	
  	public function fetch_gc_brand_list()
  	{
  	    $this->db->select("list_of_gc_vehicle_brand.*,list_of_policy_type.policy_type as p_type");
  	    $this->db->from("list_of_gc_vehicle_brand");
  	    $this->db->join("list_of_policy_type","list_of_policy_type.id = list_of_gc_vehicle_brand.policy_type");
  	    $this->db->where("list_of_gc_vehicle_brand.status","0");
  		return $this->db->get()->result();
  	}
  	
  	public function fetch_gc_brand($policy_type)
  	{
  	    $this->db->select("list_of_gc_vehicle_brand.*,list_of_policy_type.policy_type as p_type");
  	    $this->db->from("list_of_gc_vehicle_brand");
  	    $this->db->join("list_of_policy_type","list_of_policy_type.id = list_of_gc_vehicle_brand.policy_type");
  	    if($policy_type != "")
  	    {
  	        $this->db->where("list_of_gc_vehicle_brand.policy_type",$policy_type);
  	    }
  		return $this->db->get()->result();
  	}
  	public function add_gc_brand($data)
  	{
  		$this->db->insert("list_of_gc_vehicle_brand",$data);
  	}
  	public function fetch_edit_gc_brand($id)
  	{
  		$this->db->where("id",$id);
  		return $this->db->get("list_of_gc_vehicle_brand")->row();
  	}
  	public function edit_gc_brand($id, $data)
  	{
  		$this->db->where("id",$id);
  		$this->db->update("list_of_gc_vehicle_brand",$data);
  	}
  	
  	public function fetch_gc_model($policy_type,$s_gc_brand)
  	{
  	    $this->db->select("list_of_gc_vehicle_model.id,list_of_policy_type.policy_type as p_type,list_of_gc_vehicle_model.model_name,list_of_gc_vehicle_brand.brand_name");
  	    $this->db->join("list_of_policy_type","list_of_policy_type.id = list_of_gc_vehicle_model.policy_type");
  	    $this->db->join("list_of_gc_vehicle_brand","list_of_gc_vehicle_brand.id = list_of_gc_vehicle_model.brand_id");
  	    
  	    if($policy_type != "")
  	    {
  	        $this->db->where("list_of_gc_vehicle_model.policy_type",$policy_type);
  	    }
  	    if($s_gc_brand != "")
  	    {
  	        $this->db->where("list_of_gc_vehicle_model.brand_id",$s_gc_brand);
  	    }
  		return $this->db->get("list_of_gc_vehicle_model")->result();
  	}
  	
  
  	public function add_gc_model($data)
  	{
  		$this->db->insert("list_of_gc_vehicle_model",$data);
  	}
  	public function fetch_edit_gc_model($id)
  	{
  		$this->db->where("id",$id);
  		return $this->db->get("list_of_gc_vehicle_model")->row();
  	}
  	public function edit_gc_model($id, $data)
  	{
  		$this->db->where("id",$id);
  		$this->db->update("list_of_gc_vehicle_model",$data);
  	}
    
    
    public function fetch_gc_varient($s_policy_type,$s_gc_brand,$s_gc_model)
  	{
  	    $this->db->select("list_of_gc_vehicle_varient.id,list_of_gc_vehicle_varient.varient_name,list_of_gc_vehicle_brand.brand_name,list_of_gc_vehicle_model.model_name,list_of_car_fuel_type.fuel_type,list_of_policy_type.policy_type as p_type");
  	    $this->db->join("list_of_policy_type","list_of_policy_type.id = list_of_gc_vehicle_varient.policy_type");
  	    $this->db->join("list_of_gc_vehicle_brand","list_of_gc_vehicle_brand.id = list_of_gc_vehicle_varient.brand_id");
  	    $this->db->join("list_of_gc_vehicle_model","list_of_gc_vehicle_model.id = list_of_gc_vehicle_varient.model_id");
  	    $this->db->join("list_of_car_fuel_type","list_of_car_fuel_type.id = list_of_gc_vehicle_varient.fuel_id");
  	    
  	    if($s_policy_type != "")
  	    {
  	        $this->db->where("list_of_gc_vehicle_varient.policy_type",$s_policy_type);
  	    }
  	    
  	    if($s_gc_brand != "")
  	    {
  	        $this->db->where("list_of_gc_vehicle_varient.brand_id",$s_gc_brand);
  	    }
  	    
  	    if($s_gc_model != "")
  	    {
  	        $this->db->where("list_of_gc_vehicle_varient.model_id",$s_gc_model);
  	    }
  	    
  		return $this->db->get("list_of_gc_vehicle_varient")->result();
  	}
  	public function add_gc_varient($data)
  	{
  		$this->db->insert("list_of_gc_vehicle_varient",$data);
  	}
  	public function fetch_edit_gc_varient($id)
  	{
  		$this->db->where("id",$id);
  		return $this->db->get("list_of_gc_vehicle_varient")->row();
  	}
  	public function edit_gc_varient($id, $data)
  	{
  		$this->db->where("id",$id);
  		$this->db->update("list_of_gc_vehicle_varient",$data);
  	}
  	public function get_gc_model_list_option($id)
  	{
  	    $this->db->where("brand_id",$id);
  		return $this->db->get("list_of_gc_vehicle_model")->result();
  	}
  	
  	public function get_gc_model_list($id)
  	{
  	    $this->db->where("brand_id",$id);
  		return $this->db->get("list_of_gc_vehicle_model")->result();
  	}
  	
  	//marine commodity
  	public function fetch_marine_commodity()
  	{
  		return $this->db->get("list_of_marine_commodity")->result();
  	}
  	public function add_marine_commodity($data)
  	{
  		$this->db->insert("list_of_marine_commodity",$data);
  	}
  	public function fetch_edit_marine_commodity($id)
  	{
  		$this->db->where("id",$id);
  		return $this->db->get("list_of_marine_commodity")->row();
  	}
  	public function edit_marine_commodity($id, $data)
  	{
  		$this->db->where("id",$id);
  		$this->db->update("list_of_marine_commodity",$data);
  	}
  	
  	// sub commodity
  	
  	public function fetch_marine_sub_commodity()
  	{
  	    $this->db->select("list_of_marine_sub_commodity.id,list_of_marine_sub_commodity.name,list_of_marine_commodity.name as commodity_name");
  	    $this->db->join("list_of_marine_commodity","list_of_marine_commodity.id = list_of_marine_sub_commodity.commodity_id");
  		return $this->db->get("list_of_marine_sub_commodity")->result();
  	}
  	
  
  	public function add_marine_sub_commodity($data)
  	{
  		$this->db->insert("list_of_marine_sub_commodity",$data);
  	}
  	public function fetch_edit_marine_sub_commodity($id)
  	{
  		$this->db->where("id",$id);
  		return $this->db->get("list_of_marine_sub_commodity")->row();
  	}
  	public function edit_marine_sub_commodity($id, $data)
  	{
  		$this->db->where("id",$id);
  		$this->db->update("list_of_marine_sub_commodity",$data);
  	}
  	
  	//pc Brand
  	
  	
  	public function fetch_pc_brand_list()
  	{
  	    $this->db->select("list_of_pc_vehicle_brand.*,list_of_policy_type.policy_type as p_type");
  	    $this->db->from("list_of_pc_vehicle_brand");
  	    $this->db->join("list_of_policy_type","list_of_policy_type.id = list_of_pc_vehicle_brand.policy_type");
  		return $this->db->get()->result();
  	}
  	
  	public function fetch_pc_brand($policy_type)
  	{
  	     $this->db->select("list_of_pc_vehicle_brand.*,list_of_policy_type.policy_type as p_type");
  	    $this->db->from("list_of_pc_vehicle_brand");
  	    $this->db->join("list_of_policy_type","list_of_policy_type.id = list_of_pc_vehicle_brand.policy_type");
  	    
  	    if($policy_type != "")
  	    {
  	          $this->db->where("list_of_pc_vehicle_brand.policy_type",$policy_type);
  	    }
  	    
  		return $this->db->get()->result();
  	}
  	public function add_pc_brand($data)
  	{
  		$this->db->insert("list_of_pc_vehicle_brand",$data);
  	}
  	public function fetch_edit_pc_brand($id)
  	{
  		$this->db->where("id",$id);
  		return $this->db->get("list_of_pc_vehicle_brand")->row();
  	}
  	public function edit_pc_brand($id, $data)
  	{
  		$this->db->where("id",$id);
  		$this->db->update("list_of_pc_vehicle_brand",$data);
  	}
  	
  	public function fetch_pc_model($policy_type,$s_pc_brand)
  	{
  	    $this->db->select("list_of_pc_vehicle_model.id,list_of_pc_vehicle_model.model_name,list_of_pc_vehicle_brand.brand_name,list_of_policy_type.policy_type as p_type");
  	    $this->db->join("list_of_policy_type","list_of_policy_type.id = list_of_pc_vehicle_model.policy_type");
  	    $this->db->join("list_of_pc_vehicle_brand","list_of_pc_vehicle_brand.id = list_of_pc_vehicle_model.brand_id");
  	   
  	    if($policy_type != "")
  	    {
  	        $this->db->where("list_of_pc_vehicle_model.policy_type",$policy_type);
  	    }
  	    if($s_pc_brand != "")
  	    {
  	        $this->db->where("list_of_pc_vehicle_model.brand_id",$s_pc_brand);
  	    }
  		return $this->db->get("list_of_pc_vehicle_model")->result();
  	}
  	
  
  	public function add_pc_model($data)
  	{
  		$this->db->insert("list_of_pc_vehicle_model",$data);
  	}
  	public function fetch_edit_pc_model($id)
  	{
  		$this->db->where("id",$id);
  		return $this->db->get("list_of_pc_vehicle_model")->row();
  	}
  	public function edit_pc_model($id, $data)
  	{
  		$this->db->where("id",$id);
  		$this->db->update("list_of_pc_vehicle_model",$data);
  	}
    
  	public function fetch_pc_varient($policy_type,$s_pc_brand,$s_pc_model)
  	{
  	    $this->db->select("list_of_pc_vehicle_varient.id,list_of_pc_vehicle_varient.varient_name,list_of_pc_vehicle_brand.brand_name,list_of_pc_vehicle_model.model_name,list_of_car_fuel_type.fuel_type,list_of_policy_type.policy_type as p_type");
  	    $this->db->join("list_of_policy_type","list_of_policy_type.id = list_of_pc_vehicle_varient.policy_type");
  	    $this->db->join("list_of_pc_vehicle_brand","list_of_pc_vehicle_brand.id = list_of_pc_vehicle_varient.brand_id");
  	    $this->db->join("list_of_pc_vehicle_model","list_of_pc_vehicle_model.id = list_of_pc_vehicle_varient.model_id");
  	    $this->db->join("list_of_car_fuel_type","list_of_car_fuel_type.id = list_of_pc_vehicle_varient.fuel_id");
  	   
  	    if($policy_type != "")
  	    {
  	        $this->db->where("list_of_pc_vehicle_varient.policy_type",$policy_type);
  	    }
  	    if($s_pc_brand != "")
  	    {
  	         $this->db->where("list_of_pc_vehicle_varient.brand_id",$s_pc_brand);
  	    }
  	    if($s_pc_model != "")
  	    {
  	         $this->db->where("list_of_pc_vehicle_varient.model_id",$s_pc_model);
  	    }
  	    
  		return $this->db->get("list_of_pc_vehicle_varient")->result();
  	}
  	public function add_pc_varient($data)
  	{
  		$this->db->insert("list_of_pc_vehicle_varient",$data);
  	}
  	public function fetch_edit_pc_varient($id)
  	{
  		$this->db->where("id",$id);
  		return $this->db->get("list_of_pc_vehicle_varient")->row();
  	}
  	public function edit_pc_varient($id, $data)
  	{
  		$this->db->where("id",$id);
  		$this->db->update("list_of_pc_vehicle_varient",$data);
  	}
  	public function get_pc_model_list_option($id)
  	{
  	    $this->db->where("brand_id",$id);
  		return $this->db->get("list_of_pc_vehicle_model")->result();
  	}
  	
  	public function get_pc_model_list($id)
  	{
  	    $this->db->where("brand_id",$id);
  		return $this->db->get("list_of_pc_vehicle_model")->result();
  	}
  	
  	//Misc Brand
  	
  	public function fetch_misc_brand()
  	{
  		return $this->db->get("list_of_misc_vehicle_brand")->result();
  	}
  	public function add_misc_brand($data)
  	{
  		$this->db->insert("list_of_misc_vehicle_brand",$data);
  	}
  	public function fetch_edit_misc_brand($id)
  	{
  		$this->db->where("id",$id);
  		return $this->db->get("list_of_misc_vehicle_brand")->row();
  	}
  	public function edit_misc_brand($id, $data)
  	{
  		$this->db->where("id",$id);
  		$this->db->update("list_of_misc_vehicle_brand",$data);
  	}
  	public function fetch_misc_model()
  	{
  	    $this->db->select("list_of_misc_vehicle_model.id,list_of_misc_vehicle_model.model_name,list_of_misc_vehicle_brand.brand_name");
  	    $this->db->join("list_of_misc_vehicle_brand","list_of_misc_vehicle_brand.id = list_of_misc_vehicle_model.brand_id");
  		return $this->db->get("list_of_misc_vehicle_model")->result();
  	}
  	public function add_misc_model($data)
  	{
  		$this->db->insert("list_of_misc_vehicle_model",$data);
  	}
  	public function fetch_edit_misc_model($id)
  	{
  		$this->db->where("id",$id);
  		return $this->db->get("list_of_misc_vehicle_model")->row();
  	}
  	public function edit_misc_model($id, $data)
  	{
  		$this->db->where("id",$id);
  		$this->db->update("list_of_misc_vehicle_model",$data);
  	}
    
  	public function fetch_misc_varient()
  	{
  	    $this->db->select("list_of_misc_vehicle_varient.id,list_of_misc_vehicle_varient.varient_name,list_of_misc_vehicle_brand.brand_name,list_of_misc_vehicle_model.model_name,list_of_car_fuel_type.fuel_type");
  	    $this->db->join("list_of_misc_vehicle_brand","list_of_misc_vehicle_brand.id = list_of_misc_vehicle_varient.brand_id");
  	    $this->db->join("list_of_misc_vehicle_model","list_of_misc_vehicle_model.id = list_of_misc_vehicle_varient.model_id");
  	    $this->db->join("list_of_car_fuel_type","list_of_car_fuel_type.id = list_of_misc_vehicle_varient.fuel_id");
  		return $this->db->get("list_of_misc_vehicle_varient")->result();
  	}
  	public function add_misc_varient($data)
  	{
  		$this->db->insert("list_of_misc_vehicle_varient",$data);
  	}
  	public function fetch_edit_misc_varient($id)
  	{
  		$this->db->where("id",$id);
  		return $this->db->get("list_of_misc_vehicle_varient")->row();
  	}
  	public function edit_misc_varient($id, $data)
  	{
  		$this->db->where("id",$id);
  		$this->db->update("list_of_misc_vehicle_varient",$data);
  	}
  	public function get_misc_model_list_option($id)
  	{
  	    $this->db->where("brand_id",$id);
  		return $this->db->get("list_of_misc_vehicle_model")->result();
  	}
  	
  	public function get_misc_model_list($id)
  	{
  	    $this->db->where("brand_id",$id);
  		return $this->db->get("list_of_misc_vehicle_model")->result();
  	}
  	
  	//Bike Brand
  	
  	public function fetch_bike_brand()
  	{
  		return $this->db->get("list_of_bike_brand")->result();
  	}
  	public function add_bike_brand($data)
  	{
  		$this->db->insert("list_of_bike_brand",$data);
  	}
  	public function fetch_edit_bike_brand($id)
  	{
  		$this->db->where("id",$id);
  		return $this->db->get("list_of_bike_brand")->row();
  	}
  	public function edit_bike_brand($id, $data)
  	{
  		$this->db->where("id",$id);
  		$this->db->update("list_of_bike_brand",$data);
  	}
  	public function delete_bike_brand($id)
  	{
  		$this->db->where("id",$id);
  		$this->db->delete("list_of_bike_brand");
  	}
  	
  	//Model
  	
  	public function fetch_bike_model()
  	{
  	    $this->db->select("list_of_bike_model.id,list_of_bike_model.model_name,list_of_bike_brand.brand_name");
  	    $this->db->join("list_of_bike_brand","list_of_bike_brand.id = list_of_bike_model.brand_id");
  		return $this->db->get("list_of_bike_model")->result();
  	}
  	public function add_bike_model($data)
  	{
  		$this->db->insert("list_of_bike_model",$data);
  	}
  	public function fetch_edit_bike_model($id)
  	{
  		$this->db->where("id",$id);
  		return $this->db->get("list_of_bike_model")->row();
  	}
  	public function edit_bike_model($id, $data)
  	{
  		$this->db->where("id",$id);
  		$this->db->update("list_of_bike_model",$data);
  	}
  	public function delete_bike_model($id)
  	{
  		$this->db->where("id",$id);
  		$this->db->delete("list_of_bike_model");
  	}
  	//Bike Varient
  	public function fetch_bike_varient()
  	{
  	    $this->db->select("list_of_bike_varient.id,list_of_bike_varient.varient_name,list_of_bike_brand.brand_name,list_of_bike_model.model_name");
  	    $this->db->join("list_of_bike_brand","list_of_bike_brand.id = list_of_bike_varient.brand_id");
  	    $this->db->join("list_of_bike_model","list_of_bike_model.id = list_of_bike_varient.model_id");
  		return $this->db->get("list_of_bike_varient")->result();
  	}
  	public function add_bike_varient($data)
  	{
  		$this->db->insert("list_of_bike_varient",$data);
  	}
  	public function fetch_edit_bike_varient($id)
  	{
  		$this->db->where("id",$id);
  		return $this->db->get("list_of_bike_varient")->row();
  	}
  	public function edit_bike_varient($id, $data)
  	{
  		$this->db->where("id",$id);
  		$this->db->update("list_of_bike_varient",$data);
  	}
  	public function delete_bike_varient($id)
  	{
  		$this->db->where("id",$id);
  		$this->db->delete("list_of_bike_varient");
  	}
  	public function get_bike_model_list($id)
  	{
  	    $this->db->where("brand_id",$id);
  		return $this->db->get("list_of_bike_model")->result();
  	}
  	
    public function add_model1($data)
    {
       $this->db->insert("list_of_car_model",$data);
    }
    
    public function edit_model1($id,$data)
    {
        $this->db->where("id",$id);
        $this->db->update("list_of_car_model",$data);
    }
  	
  	
  	
//   	pets_brees start
       
       public function fetch_pets_breed()
  	{
  		return $this->db->get("list_of_pets_breed")->result();
  	}
  	
  	public function add_pets_breed($data)
  	{
  		if( $this->db->insert("list_of_pets_breed",$data) ){
  		    return true;
  		}
  		
  		return false;
  	}
  	public function fetch_edit_pets_breed($id)
  	{
  		$this->db->where("id",$id);
  		return $this->db->get("list_of_pets_breed")->row();
  	}
  	public function edit_pets_breed($id, $data)
  	{
  		$this->db->where("id",$id);
  		if($this->db->update("list_of_pets_breed",$data)){
  		    return true;
  		}
  		
  		return false;
  	}
       

//      pets breed end
  	
  	
//   	company name add start

   	public function fetch_company()
  	{
  		return $this->db->get("	list_of_insurance_company")->result();
  	}
  	
  	public function add_company_name($data)
  	{
        $this->db->insert("list_of_insurance_company",$data);
        $insert_id = $this->db->insert_id();
        return  $insert_id;
  	}
  	
  	
  	public function fetch_edit_company($id)
  	{
  		$this->db->where("id",$id);
  		return $this->db->get("list_of_insurance_company")->row();
  	}
  	
  	public function get_insurance_company_name($id)
  	{
  	    $this->db->where("id",$id);
  		return $this->db->get("list_of_insurance_company")->row();
  	}

    public function edit_company_name($id, $data)
  	{
  		$this->db->where("id",$id);
  		if($this->db->update("list_of_insurance_company",$data)){
  		    return true;
  		}
  		
  		return false;
  	}


  	
//   	company name add end
  	
  	
  	public function fetch_users()
  	{
  	    $this->db->where("role","user");
  	    return $this->db->get("admin_login")->result();
  	}
  	
  	public function fetch_user_permissions($id)
  	{
  	    $this->db->where("user_id",$id);
  	    return $this->db->get("user_privileges")->row();
  	}
  	
  	
//   	bank name start

    
       public function fetch_bank_name()
  	{
  		return $this->db->get("list_of_bank_name")->result();
  	}
  	
  	public function add_bank_name($data)
  	{
  		if( $this->db->insert("list_of_bank_name",$data) ){
  		    return true;
  		}
  		
  		return false;
  	}
  	
  	public function fetch_edit_bank_name($id)
  	{
  	    $this->db->where("id",$id);
  	    return $this->db->get("list_of_bank_name")->row();
  	}
  	
  	public function edit_bank_name($id,$data)
  	{
  	    $this->db->where("id",$id);
  	    return $this->db->update("list_of_bank_name",$data);
  	}

//       bank name end 
  	
  	public function fetch_policy_type()
  	{
  	    $this->db->where("policy_class","1");
  	    $this->db->where("status","0");
  	    return $this->db->get("list_of_policy_type")->result();
  	}
  	
  	public function fetch_policy_type_gc()
  	{
  	    $this->db->where("policy_class","1");
  	    $this->db->where("status","0");
  	    $this->db->where("v_type","4");
  	    return $this->db->get("list_of_policy_type")->result();
  	}
  	
  	public function fetch_brand_by_policy_id($policy_type)
  	{
  	    $this->db->where("status","0");
  	    $this->db->where("policy_type",$policy_type);
  	    return $this->db->get("list_of_gc_vehicle_brand")->result();
  	}
  	
  	public function fetch_policy_type_pcv()
  	{
  	    $this->db->where("policy_class","1");
  	    $this->db->where("status","0");
  	    $this->db->where("v_type","5");
  	    return $this->db->get("list_of_policy_type")->result();
  	}
  	
  public function fetch_brand_by_policy_id_pcv($policy_type)
  	{
  	    $this->db->where("status","0");
  	    $this->db->where("policy_type",$policy_type);
  	    return $this->db->get("list_of_pc_vehicle_brand")->result();
  	}
  	
  	public function fetch_pcv_seating()
  	{
  	    $this->db->select("pcv_seating.*,list_of_policy_type.policy_type as p_type");
  	    $this->db->from("pcv_seating");
  	    $this->db->join("list_of_policy_type","list_of_policy_type.id = pcv_seating.policy_type");
  	    return $this->db->get()->result();
  	}
  	
  	public function add_pcv_seating($data)
  	{
  	    if( $this->db->insert("pcv_seating",$data) ) {
  	        return true;
  	    }
  	    
  	    return false;
  	}
  	
  	// district master
  	
  	public function add_district($data)
  	{
  	    if( $this->db->insert("list_of_districts",$data) ) {
  	        return true;
  	    }
  	    
  	    return false;
  	}
  	
  	public function fetch_edit_district($id)
  	{
  	    $this->db->where("id",$id);
  	    return $this->db->get("list_of_districts")->row();
  	}
  	
  	public function edit_district($id, $data)
  	{
        $this->db->where("id",$id);
        if( $this->db->update("list_of_districts",$data) ) {
            return true;
        }
         
        return false;
  	}
  	
  	public function fetch_district()
  	{
  	      return $this->db->get("list_of_districts")->result();
  	}
  	
  //joine call//
  
   	public function fetch_bussinesscall($region,$fromdate,$todate,$mobile_no,$insurer,$areaincharge)       
  	{       
  	    $this->db->select("Business_calls.*,admin_login.username as sname,list_of_dealers.dealer_name,list_of_pos_and_agents.name agn_name");
        $this->db->from('Business_calls');
        $this->db->join('admin_login','admin_login.id = Business_calls.areaincharge');
        $this->db->join('list_of_dealers','list_of_dealers.id = Business_calls.insurer','left');
        $this->db->join('list_of_pos_and_agents','list_of_pos_and_agents.id = Business_calls.insurer','left');
        $this->db->join('bussiness_contact_details','bussiness_contact_details.bussiness_id = Business_calls.id','left');
         
        if($region != "")
  	    {
  	        $this->db->where("Business_calls.region",$region);
  	    }
  	    if($insurer != "")
  	    {
  	        $this->db->like('Business_calls.insurer',$insurer);
  	    }
  	    if($mobile_no != "")
  	    {
  	        $this->db->where("bussiness_contact_details.contactnumber",$mobile_no);
  	    }
  	    if($fromdate != "" && $todate != "")
  	    {
  	        $this->db->where("DATE(Business_calls.entry_date) >=",$fromdate);
  	        $this->db->where("DATE(Business_calls.entry_date) <=",$todate);
  	    }
  	    if($areaincharge != "")
  	    {
  	        $this->db->where("Business_calls.areaincharge",$areaincharge);
  	    }
  	    $this->db->order_by("id","desc");
  	    return $this->db->get()->result();       
  	}  
  	
    public function add_bussinesscalldetails($data)
  	{
  	    $this->db->insert("Business_calls",$data);
  	    return $this->db->insert_id();
  	}
  	
  	public function add_bussinesscontactdetails($data1)
  	{
  	    $this->db->insert("bussiness_contact_details",$data1);
  	}
  	
  	public function delete_joinecall($id)
  	{
  		$this->db->where("id",$id);
  		$this->db->delete("Business_calls");
  	}
  	
    public function fetch_view_joinecall($bussiness_id)
  	{
  		$this->db->where("bussiness_id",$bussiness_id);
  		return $this->db->get("bussiness_contact_details")->result();
  	}
  	
  	public function fetch_edit_joinecall($id)
  	{
  	    $this->db->where("id",$id);
        return $this->db->get("Business_calls")->row();
  	}
  	
  	public function edit_Business_calls($id, $data)
    {
        $this->db->where("id",$id);
        $this->db->update("Business_calls",$data);
    }
    
    public function edit_bussinesscontactdetails($id, $data)
    {
        $this->db->where("id",$id);
        $this->db->update("bussiness_contact_details",$data);
    }
    
    public function add_journalvoucher($data)
  	{
  	    $this->db->insert("journalvoucher",$data);
  	    
  	}
  	
  	
  	
  	public function get_class_type($policy_type)
  	{
  	    $this->db->where("id",$policy_type);
  	    return $this->db->get("list_of_class")->row();
  	}
  	
  	public function get_created_person_name($created_id)
  	{
  	    $this->db->where("id",$created_id);
  	    return $this->db->get("admin_login")->row();
  	}
  	
  	public function fetch_contact_details($id)
  	{
  	    $this->db->where("bussiness_id",$id);
  	    return $this->db->get("bussiness_contact_details")->result();
  	}
  	
  	public function delete_old_log($id)
  	{
  	     $this->db->where("bussiness_id",$id);
  	     $this->db->delete("bussiness_contact_details");
  	}
  	
  	public function fetch_policy_class()
  	{
  	    return $this->db->get("list_of_class")->result();
  	}
  	
  	public function fetch_policy_type_by_class($class)
  	{
  	    $this->db->where("policy_class",$class);
  	    return $this->db->get("list_of_policy_type")->result();
  	}
  	
  	public function fetch_area_incharge()
  	{
  	    $this->db->where("role","AI");
  	    return $this->db->get("admin_login")->result();
  	}
  	
  	public function fetch_area_incharge_salary($ai)
  	{
  	     $this->db->where("role","AI");
  	     $this->db->where("id",$ai);
  	    return $this->db->get("admin_login")->row();
  	}
  	
  	public function add_ai_performance($data)
  	{
  	    $this->db->insert("ai_performance",$data);
  	}
  	
  	public function update_ai_performance($data,$id)
  	{
  	    $this->db->where("id",$id);
  	    $this->db->update("ai_performance",$data);
  	}
  	
//   	public function fetch_ai_performance($date)
//   	{
//   	    $this->db->select("ai_performance.*,list_of_policy_type.policy_type as p_type,MAX(ai_performance.ai_id) as ai_i,list_of_class.class,admin_login.name as ai_name");
//   	    $this->db->from("ai_performance");
//   	    $this->db->join("list_of_policy_type","ai_performance.policy_type = list_of_policy_type.id");
//   	    $this->db->join("list_of_class","ai_performance.class = list_of_class.id");
//   	    $this->db->join("admin_login","admin_login.id = ai_performance.ai_id");
//   	    $this->db->where("ai_performance.month",$date);
//   	    $this->db->group_by("ai_performance.ai_id");
  	    
//   	    if($this->session->userdata("session_role") == "AI")
//   	    {
//   	        $this->db->where("ai_performance.ai_id",$this->session->userdata(
//   	            "session_id"));
//   	    }
  	    
//   	    //return $this->db->get()->result();
//   	    return $this->db->get_compiled_select();
  	    
//   	}

public function fetch_ai_performance($date)
{
    $this->db->select("
        ai_performance.ai_id, 
        ai_performance.month, 
        MAX(ai_performance.ai_id) as ai_i, 
        list_of_policy_type.policy_type as p_type, 
        list_of_class.class, 
        admin_login.name as ai_name
    ");
    $this->db->from("ai_performance");
    $this->db->join("list_of_policy_type", "ai_performance.policy_type = list_of_policy_type.id");
    $this->db->join("list_of_class", "ai_performance.class = list_of_class.id");
    $this->db->join("admin_login", "admin_login.id = ai_performance.ai_id");
    $this->db->where("ai_performance.month", $date);
    $this->db->group_by([
        "ai_performance.ai_id", 
        "ai_performance.month", 
        "list_of_policy_type.policy_type", 
        "list_of_class.class", 
        "admin_login.name"
    ]);
    
    if ($this->session->userdata("session_role") == "AI") {
        $this->db->where("ai_performance.ai_id", $this->session->userdata("session_id"));
    }

    return $this->db->get()->result();
}

  	
  	public function fetch_performance_details($ai_id,$date)
  	{
  	    $this->db->select("ai_performance.policy_type,ai_performance.class");
  	    $this->db->from("ai_performance");
  	    $this->db->join("list_of_policy_type","ai_performance.policy_type = list_of_policy_type.id");
  	    $this->db->join("list_of_class","ai_performance.class = list_of_class.id");
  	    $this->db->join("admin_login","admin_login.id = ai_performance.ai_id");
  	    $this->db->where("ai_performance.month",$date);
  	    $this->db->where("ai_id",$ai_id);
  	    return $this->db->get()->result();
  	}
  	
  	public function fetch_ai_active_policy($ai_id,$start_date,$end_date,$class,$policy_type)
  	{
  	     $this->db->select("policy_info.id,total_premium as total");
      	$this->db->join("list_of_leads","policy_info.lead_id = list_of_leads.id");
  	    $this->db->join("list_of_clients","list_of_leads.client_id = list_of_clients.id");
  	    $this->db->join("list_of_pos_and_agents","policy_info.policy_agency_pos = list_of_pos_and_agents.id");
  	    $this->db->join("list_of_insurance_company","policy_info.company = list_of_insurance_company.id");
  	    $this->db->join("type_of_bussiness","list_of_leads.business_type = type_of_bussiness.id");
  	    $this->db->join("list_of_class","list_of_leads.class = list_of_class.id");
  	     $this->db->join("admin_login","admin_login.id = list_of_leads.area_incharge",'left');
  	    $this->db->join("list_of_policy_type","list_of_leads.policy_type = list_of_policy_type.id");
  	    $this->db->join("list_of_premium_cover_type","policy_info.policy_premium = list_of_premium_cover_type.id",'left');
        $this->db->where("policy_info.policy_issue_date >=",$start_date);
        $this->db->where("policy_info.policy_issue_date <=",$end_date);
  	    $this->db->where("list_of_leads.area_incharge",$ai_id);
  	  
  	    if($class != "")
  	    {
  	           $this->db->where("list_of_leads.class",$class);
  	    }
  	    if($policy_type != "")
  	    {
  	         $this->db->where("list_of_leads.policy_type",$policy_type);
  	    }
  	   
  	    return $this->db->get("policy_info")->result();
  	}
  	
  	public function fetch_ai_business_complete($ai_id,$start_date,$end_date,$class,$policy_type)
  	{
  	     $this->db->select("temp_policy_info.id,total_premium as total");
      	$this->db->join("list_of_leads","temp_policy_info.lead_id = list_of_leads.id");
  	    $this->db->join("list_of_clients","list_of_leads.client_id = list_of_clients.id");
  	    $this->db->join("list_of_pos_and_agents","temp_policy_info.policy_agency_pos = list_of_pos_and_agents.id");
  	    $this->db->join("list_of_insurance_company","temp_policy_info.company = list_of_insurance_company.id");
  	    $this->db->join("type_of_bussiness","list_of_leads.business_type = type_of_bussiness.id");
  	    $this->db->join("list_of_class","list_of_leads.class = list_of_class.id");
  	    $this->db->join("list_of_policy_type","list_of_leads.policy_type = list_of_policy_type.id");
  	    $this->db->join("list_of_premium_cover_type","temp_policy_info.policy_premium = list_of_premium_cover_type.id",'left');
  	    $this->db->where("temp_policy_info.policy_issue_date >=",$start_date);
        $this->db->where("temp_policy_info.policy_issue_date <=",$end_date);
  	    $this->db->where("list_of_leads.area_incharge",$ai_id);
  	   if($class != "")
  	    {
  	           $this->db->where("list_of_leads.class",$class);
  	    }
  	    if($policy_type != "")
  	    {
  	         $this->db->where("list_of_leads.policy_type",$policy_type);
  	    }
  	    $this->db->where("list_of_leads.lead_type !=","2");
  	    return $this->db->get("temp_policy_info")->result();
  	}
  	
  	public function fetch_region()
  	{
  	    return $this->db->get("list_of_reigion")->result();
  	}
  	
  	public function add_business_call_images($data0)
  	{
  	    $this->db->insert("business_calls_images",$data0);
  	}
  	
  	public function fetch_business_client_details($bussiness_id)
  	{
  	      $this->db->select("Business_calls.*,admin_login.username as sname,list_of_dealers.dealer_name,list_of_pos_and_agents.name agn_name");
        $this->db->from('Business_calls');
        $this->db->join('admin_login','admin_login.id = Business_calls.areaincharge');
        $this->db->join('list_of_dealers','list_of_dealers.id = Business_calls.insurer','left');
         $this->db->join('list_of_pos_and_agents','list_of_pos_and_agents.id = Business_calls.insurer','left');
          $this->db->where("Business_calls.id",$bussiness_id);
  	    return $this->db->get()->row();
  	}
  	
  	 public function edit_joine_call($id,$data0)
  	{
  	    $this->db->where("id",$id);
  	    $this->db->update("Business_calls",$data0);
  	}
  	
  	
  	public function fetch_business_images($bussiness_id)
  	{
  	    $this->db->where("business_id",$bussiness_id);
  	    return $this->db->get("business_calls_images")->result();
  	}
  	
  	public function delete_business_call_images($id)
  	{
  	    $this->db->where("id",$id);
  	    $this->db->delete("business_calls_images");
  	}
  	
  	public function get_files($id)
  	{
  	    $this->db->where("id",$id);
  	     return $this->db->get("business_calls_images")->row();
  	}
  	
  	public function get_business_calls_records($region,$fromdate,$todate,$mobile_no,$insurer,$areaincharge)
  	{
  	    $this->db->select("Business_calls.id,Business_calls.region,Business_calls.insurer,admin_login.username as cname,Business_calls.location,Business_calls.activice,Business_calls.address,Business_calls.pin");
  	    $this->db->from("Business_calls");
  	    $this->db->join("bussiness_contact_details","bussiness_contact_details.bussiness_id = Business_calls.id");
  	    $this->db->join('admin_login','admin_login.id =Business_calls.areaincharge');
  	    if($region != "")
  	    {
  	        $this->db->where("Business_calls.region",$region);
  	    }
  	    if($fromdate != "" && $todate != "")
  	    {
  	        $this->db->where("DATE(Business_calls.entry_date) >=",$fromdate);
  	        $this->db->where("DATE(Business_calls.entry_date) <=",$todate);
  	    }
  	    if($insurer != "")
  	    {
  	        $this->db->like('Business_calls.insurer',$insurer);
  	    }
  	    if($mobile_no != "")
  	    {
  	        $this->db->where("bussiness_contact_details.contactnumber",$mobile_no);
  	    }
  	    if($areaincharge != "")
  	    {
  	        $this->db->where("Business_calls.areaincharge",$areaincharge);
  	    }
  	    $this->db->group_by("bussiness_contact_details.bussiness_id");
        return $this->db->get()->result();
  	}
  	
  	public function get_contact_details($id,$mobile_no)
  	{
  	    $this->db->select("bussiness_contact_details.*,list_of_class.class as policy_class");
  	    $this->db->from("bussiness_contact_details");
  	    $this->db->join("list_of_class","list_of_class.id = bussiness_contact_details.policy");
  	    $this->db->where("bussiness_contact_details.bussiness_id",$id);
  	    if($mobile_no != "")
  	    {
  	        $this->db->where("bussiness_contact_details.contactnumber",$mobile_no);
  	    }
  	    return $this->db->get()->result();
  	}
  	
  	public function fetch_performance_records($policy_type,$class_type,$area_incharge,$date_string)
  	{
  	    $this->db->select("0-10 as tendays,10-20 as twenty_days,20-30 as thirty_days,id");
        $this->db->where("ai_id",$area_incharge);
        $this->db->where("class",$class_type);
        $this->db->where("policy_type",$policy_type);
        $this->db->where("month",$date_string);
        return $this->db->get("ai_performance")->row();
  	}
  	
  	public function fetch_edit_performance($id)
  	{
  	    $this->db->select("class,policy_type,volume_type,month,ai_id,0-10 as tendays,10-20 as twenty_days,20-30 as thirty_days,id");
        $this->db->where("id",$id);
        return $this->db->get("ai_performance")->row();
  	}
  	
  	public function get_insurer_details_business_call($insurer)
  	{
  	    $this->db->like("insurer",$insurer);
  	    return $this->db->get("Business_calls")->row();
  	}
  	
 	public function add_leave_permission($data)
  	{
  	    $this->db->insert("areaincharge_leave_permission",$data);
  	}
  	
  	public function fetch_leavepermission()
    {
        $this->db->select("areaincharge_leave_permission.*,admin_login.name as ai_name");
        $this->db->from("areaincharge_leave_permission");
        $this->db->join("admin_login","admin_login.id = areaincharge_leave_permission.leaveai");
          if($this->session->userdata("session_role") == "AI")
        {
            $this->db->where("areaincharge_leave_permission.leaveai",$this->session->userdata("session_id"));
        }
        $this->db->order_by("id","desc");
        return $this->db->get()->result();
    }
    
    public function fetch_acheived_active_policy($ai_id,$date)
    {
        $this->db->select("list_of_leads.policy_type,list_of_leads.class");
        $this->db->from("list_of_leads");
        $this->db->join("policy_info","policy_info.lead_id = list_of_leads.id");
        $this->db->where("policy_info.policy_issue_date >=",$date);
  	    $this->db->where("policy_info.policy_issue_date <=",date_format(date_create($date),"Y-m-t"));
  	    $this->db->where("list_of_leads.area_incharge",$ai_id);
  	    $this->db->group_by("list_of_leads.policy_type");
  	    return $this->db->get()->result();
    }
    
    public function fetch_acheived_business_complete($ai_id,$date)
    {
        $this->db->select("list_of_leads.policy_type,list_of_leads.class");
        $this->db->from("list_of_leads");
        $this->db->join("temp_policy_info","temp_policy_info.lead_id = list_of_leads.id");
  	    $this->db->where("list_of_leads.area_incharge",$ai_id);
  	    $this->db->where("temp_policy_info.policy_issue_date >=",$date);
  	    $this->db->where("temp_policy_info.policy_issue_date <=",date_format(date_create($date),"Y-m-t"));
  	    $this->db->where("list_of_leads.lead_type !=","2");
  	    $this->db->group_by("list_of_leads.policy_type");
  	    return $this->db->get()->result();
    }
    
    public function get_policy_type($policy_type)
    {
        $this->db->where("id",$policy_type);
        return $this->db->get("list_of_policy_type")->row();
    }
    
    public function get_class_name($class)
    {
        $this->db->where("id",$class);
        return $this->db->get("list_of_class")->row();
    }
    
    public function fetch_area_incharge_target($ai_id,$date,$policy_type,$class)
    {
         $this->db->select("ai_performance.id,ai_performance.volume_type,ai_performance.0-10 as tendays,ai_performance.10-20 as twentydays,ai_performance.20-30 as thirty_days,ai_performance.policy_type,ai_performance.class,admin_login.name as ai_name,admin_login.phoneno");
  	    $this->db->from("ai_performance");
  	    $this->db->join("list_of_policy_type","ai_performance.policy_type = list_of_policy_type.id");
  	    $this->db->join("list_of_class","ai_performance.class = list_of_class.id");
  	    $this->db->join("admin_login","admin_login.id = ai_performance.ai_id");
  	    $this->db->where("ai_performance.month",$date);
  	    $this->db->where("ai_id",$ai_id);
  	    $this->db->where("ai_performance.class",$class);
  	    $this->db->where("ai_performance.policy_type",$policy_type);
  	    return $this->db->get()->row();
    }
    
    public function get_ai_details($ai_id)
    {
        $this->db->where("id",$ai_id);
        return $this->db->get("admin_login")->row();
    }
    
    public function fetch_exiting_clients()
    {
        $this->db->group_by("insurer");
        return $this->db->get("Business_calls")->result();
    }
    
    public function get_business_details($id)
    {
        $this->db->where("id",$id);
        return $this->db->get("Business_calls")->row();
    }
    
    public function fetch_ai_daily_report($ai,$date)
    {
        $this->db->where("DATE(entry_date)",$date);
        $this->db->where("areaincharge",$ai);
        return $this->db->get("Business_calls")->result();
    }
    
    public function fetch_ai_leave($ai,$date)
    {
         $this->db->where("leaveai",$ai);
        $this->db->where("DATE(leavefrom_date)",$date);
        return $this->db->get("areaincharge_leave_permission")->result();
    }
    
    public function fetch_dealers()
    {
        return $this->db->get("list_of_dealers")->result();
    }
    
    public function fetch_agents($ai)
    {
        $this->db->where("area_incharge",$ai);
        return $this->db->get("list_of_pos_and_agents")->result();
    }
    
    
    public function fetch_class($id)
    {
        $this->db->where("id",$id);
        return $this->db->get("list_of_class")->row();
    }
    
    public function fetch_all_insurance_company()
    {
        return $this->db->get("list_of_insurance_company")->result();
    }
    
   
    //Ambulance Brand
    
    public function fetch_ambulance_brand()
  	{
  	    //$this->db->cache_on();
  		$res = $this->db->get("list_of_ambulance_brand")->result();
  		//$this->db->cache_off();
  		return $res;
  	}
  	public function add_ambulance_brand($data)
  	{
  		$this->db->insert("list_of_ambulance_brand",$data);
  		//$this->db->cache_delete("fetch_brand","index"); 
  	}
  	public function fetch_edit_ambulance_brand($id)
  	{
  	    //$this->db->cache_delete("fetch_edit_brand","index");
  	    //$this->db->cache_delete_all();
  		$this->db->where("id",$id);
  		return $this->db->get("list_of_ambulance_brand")->row();
  	}
  	public function edit_ambulance_brand($id, $data)
  	{
  		$this->db->where("id",$id);
  		$this->db->update("list_of_ambulance_brand",$data);
  		//$this->db->cache_delete("fetch_brand","index"); 
  	}
  	public function delete_ambulance_brand($id)
  	{
  		$this->db->where("id",$id);
  		$this->db->delete("list_of_ambulance_brand");
  		//$this->db->cache_delete("fetch_brand","index"); 
  	}
  	
  	
 
 //Ambulance_Model
  	
  	public function fetch_ambulance_model()
  	{
  	    $this->db->select("list_of_ambulance_model.id,list_of_ambulance_model.model_name,list_of_ambulance_brand.brand_name");
  	    $this->db->join("list_of_ambulance_brand","list_of_ambulance_brand.id = list_of_ambulance_model.brand_id");
  		$res = $this->db->get("list_of_ambulance_model")->result();
  		return $res;
  	}
  	
  
  	public function add_ambulance_model($data)
  	{
  		$this->db->insert("list_of_ambulance_model",$data);
  	}
  	public function fetch_edit_ambulance_model($id)
  	{
  		$this->db->where("id",$id);
  		return $this->db->get("list_of_ambulance_model")->row();
  	}
  	public function edit_ambulance_model($id, $data)
  	{
  		$this->db->where("id",$id);
  		$this->db->update("list_of_ambulance_model",$data);
  	}
  	public function delete_ambulance_model($id)
  	{
  		$this->db->where("id",$id);
  		$this->db->delete("list_of_ambulance_model");
  	}
    public function fetch_users_list()
    {
    $this->db->where("role","user");
    return $this->db->get("admin_login")->result();
    }
    
 
//Ambulance_fuel_type

  	public function fetch_ambulance_fuel_type()
  	{
  		return $this->db->get("list_of_ambulance_fuel_type")->result();
  	}
  	public function add_ambulance_fuel_type($data)
  	{
  		$this->db->insert("list_of_ambulance_fuel_type",$data);
  	}
  	public function fetch_edit_ambulance_fuel_type($id)
  	{
  		$this->db->where("id",$id);
  		return $this->db->get("list_of_ambulance_fuel_type")->row();
  	}
  	public function edit_ambulance_fuel_type($id, $data)
  	{
  		$this->db->where("id",$id);
  		$this->db->update("list_of_ambulance_fuel_type",$data);
  	}
  	public function delete_ambulance_fuel_type($id)
  	{
  		$this->db->where("id",$id);
  		$this->db->delete("list_of_ambulance_fuel_type");
  	}
 
    
//Ambulance_Varient

  	public function fetch_ambulance_varient()
  	{
  	    $this->db->select("list_of_ambulance_varient.id,list_of_ambulance_varient.varient_name,list_of_ambulance_brand.brand_name,list_of_ambulance_model.model_name,list_of_ambulance_fuel_type.fuel_type");
  	    $this->db->join("list_of_ambulance_brand","list_of_ambulance_brand.id = list_of_ambulance_varient.brand_id");
  	    $this->db->join("list_of_ambulance_model","list_of_ambulance_model.id = list_of_ambulance_varient.model_id");
  	    $this->db->join("list_of_ambulance_fuel_type","list_of_ambulance_fuel_type.id = list_of_ambulance_varient.fuel_id");
  		return $this->db->get("list_of_ambulance_varient")->result();
  	}
  	public function add_ambulance_varient($data)
  	{
  		$this->db->insert("list_of_ambulance_varient",$data);
  	}
  	public function fetch_edit_ambulance_varient($id)
  	{
  		$this->db->where("id",$id);
  		return $this->db->get("list_of_ambulance_varient")->row();
  	}
  	public function edit_ambulance_varient($id,$data)
  	{
  		$this->db->where("id",$id);
  		$this->db->update("list_of_ambulance_varient",$data);
  	}
  	public function delete_ambulance_varient($id)
  	{
  		$this->db->where("id",$id);
  		$this->db->delete("list_of_ambulance_varient");
  	}
  
  	public function get_ambulance_model_list($id)
  	{
  	    $this->db->where("brand_id",$id);
  		return $this->db->get("list_of_ambulance_model")->result();
  	}
  	public function fetch_ambulance_model_()
  	{
  	   return $this->db->get("list_of_ambulance_model")->result(); 
  	}
  	
  	public function get_insurance_company_info($res)
  	{
  	    $this->db->where("id",$res);
  	    return $this->db->get("list_of_insurance_company")->row();
  	}
  	
  	public function get_all_insurance_company_info()
  	{
  	    return $this->db->get("list_of_insurance_company")->result();
  	}
  	
  	public function check_insurance_com_ledger_exits($id)
  	{
  	    $this->db->where("insurer_id",$id);
  	    return  $this->db->get("account_tree")->num_rows();
  	}
   public function add_dealer_details($data)
  	{
  	    $this->db->insert("list_of_dealers",$data);
  	    return $this->db->insert_id();
  	}
  public function add_dealer_contact_info($data1)
  {
      $this->db->insert("dealers_contact_info",$data1);
  }
  
  public function get_account_head_for_general_receipt()
  	{
  	    $this->db->where("chracctype","1");
  	    return $this->db->get("account_tree")->result();
  	} 
  public function fetch_sub_category()
    {
        $this->db->where("chracctype","2");
        return $this->db->get("account_tree")->result();
    }	
  public function fetch_cheque_number()
    {
          $this->db->where("status","N");
          return $this->db->get("cheque_book_entry")->result();  
    }
  public function get_paymode_chracctype($sub_category)
  {
      $this->db->where("vchaccid",$sub_category);
     return $this->db->get("account_tree")->row();
  }
  
      
      
    // 2023-08-12
  public function add_acc_jv_post($data)
  {   
	if( $this->db->insert_batch("acc_commission_ledger", $data) ) {
		return true;
	} else {
		return false;
	}  	 
  }
  
  
    // 2023-08-12
    public function add_journalvoucher_batch($data)
    {  	    
        if( $this->db->insert_batch( "journalvoucher", $data ) ) {
            return true;
        } else {
            return false;
        }  	    
    }
  	
    // 2023-08-12
    public function getMaxSRNo($type, $table, $year)
    {        	        
        $data = [];
        $sql = "select 
					COALESCE(max(cast(replace(SUBSTRING_INDEX(journal_no, '/', 2), '".$type."', '') as unsigned)),0)+1 as new_receipt_no
				from 
					{$table}
				where 
					right(journal_no,2) = '".$year."'";
       
        $Q = $this->db->query($sql);
        
        if( $Q->num_rows() > 0 ){
            $data = $Q->row_array();
        }
        $Q->free_result();
        return (isset($data['new_receipt_no']) && !empty($data['new_receipt_no'])) ? $type.$data['new_receipt_no']."/{$year}" : null;
    }
    
    public function add_acc_commission_ledger($data)
    {
        $this->db->insert("acc_commission_ledger",$data2);
    }
    
    
    // 2023-09-07
    public function check_jv($options = [])
    {        
        $data = [];
        $this->db->select('id');
        $this->db->where($options);
        $Q = $this->db->get("journalvoucher");
        
        if( $Q->num_rows() > 0 ){
            $data = $Q->row_array();
        }
        $Q->free_result();
        return (isset($data['id']) && !empty($data['id'])) ? true : false;
    }
  	
}