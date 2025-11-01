<?php  
class Configmod extends CI_Model  
{  
  	function __construct()  
  	{ 
    	parent::__construct();  
    	$this->load->dbforge();
  	}
  	
  	public function add_reigion($data)
  	{
  	    if( $this->db->insert("list_of_reigion",$data) ) {
  	        return true;
  	    }
  	    
  	    return false;
  	}
  	
  	public function fetch_reigion()
  	{
  	    $this->db->select("list_of_reigion.*,list_of_districts.district");
  	    $this->db->from("list_of_reigion");
  	    $this->db->join("list_of_districts", "list_of_districts.id = list_of_reigion.district_id",'left');
  	    return $this->db->get()->result();
  	}
  	
  	public function fetch_edit_data($id)
  	{
  	    $this->db->where("id",$id);
  	    return $this->db->get("list_of_reigion")->row();
  	}
  	
  	public function edit_reigion($data,$id)
  	{
  	    $this->db->where("id",$id);
  	    if( $this->db->update("list_of_reigion",$data) ) {
  	        return true;
  	    }
  	    
  	    return false;
  	}
  	
  	// scooter 
  	public function fetch_scooter_brand()
  	{
  		return $this->db->get("list_of_scooter_brand")->result();
  	}
  	public function add_scooter_brand($data)
  	{
  		if($this->db->insert("list_of_scooter_brand",$data)){
  		    return true;
  		}
  		
  		return false;
  	}
  	public function fetch_edit_scooter_brand($id)
  	{
  		$this->db->where("id",$id);
  		return $this->db->get("list_of_scooter_brand")->row();
  	}
  	public function edit_scooter_brand($id, $data)
  	{
  		$this->db->where("id",$id);
  		if($this->db->update("list_of_scooter_brand",$data)){
  		    return true;
  		}
  		
  		return false;
  	}
  	public function delete_scooter_brand($id)
  	{
  		$this->db->where("id",$id);
  		if($this->db->delete("list_of_scooter_brand")){
  		    return true;
  		}
  		
  		return false;
  	}
  
  	//Model
  	
  	public function fetch_brand()
  	{
  		return $this->db->get("list_of_scooter_brand")->result();
  	}
  	
  	public function fetch_scooter_model()
  	{
  	    $this->db->select("list_of_scooter_model.id,list_of_scooter_model.model_name,list_of_scooter_brand.brand_name");
  	    $this->db->join("list_of_scooter_brand","list_of_scooter_brand.id = list_of_scooter_model.brand_id");
  		return $this->db->get("list_of_scooter_model")->result();
  	}
  	public function add_scooter_model($data)
  	{
  		if( $this->db->insert("list_of_scooter_model",$data) ) {
  		    return true;
  		}
  		
  		return false;
  	}
  	public function fetch_edit_scooter_model($id)
  	{
  		$this->db->where("id",$id);
  		return $this->db->get("list_of_scooter_model")->row();
  	}
  	public function edit_scooter_model($id, $data)
  	{
  		$this->db->where("id",$id);
  		if( $this->db->update("list_of_scooter_model",$data) ){
  		    return true;
  		}
  		
  		return false;
  	}
  	public function delete_scooter_model($id)
  	{
  		$this->db->where("id",$id);
  		if( $this->db->delete("list_of_scooter_model") ) {
  		    return true;
  		}
  		
  		return false;
  	}
  	
  	public function fetch_scooter_varient()
  	{
  	    $this->db->select("list_of_scooter_varient.id,list_of_scooter_varient.varient_name,list_of_scooter_brand.brand_name,list_of_scooter_model.model_name");
  	    $this->db->join("list_of_scooter_brand","list_of_scooter_brand.id = list_of_scooter_varient.brand_id");
  	    $this->db->join("list_of_scooter_model","list_of_scooter_model.id = list_of_scooter_varient.model_id");
  		return $this->db->get("list_of_scooter_varient")->result();
  	}
  	public function add_scooter_varient($data)
  	{
  		if($this->db->insert("list_of_scooter_varient",$data)){
  		    return  true;
  		}
  		
  		return false;
  	}
  	public function fetch_edit_scooter_varient($id)
  	{
  		$this->db->where("id",$id);
  		return $this->db->get("list_of_scooter_varient")->row();
  	}
  	public function edit_scooter_varient($id, $data)
  	{
  		$this->db->where("id",$id);
  		if($this->db->update("list_of_scooter_varient",$data)){
  		    return true;
  		}
  		
  		return false;
  	}
  	public function delete_scooter_varient($id)
  	{
  		$this->db->where("id",$id);
  		if($this->db->delete("list_of_scooter_varient")){
  		    return true;
  		}
  		
  		return false;
  	}
  	public function get_scooter_model_list($id)
  	{
  	    $this->db->where("brand_id",$id);
  		return $this->db->get("list_of_scooter_model")->result();
  	}
  	
  	// e two wheeler
  	
  	public function get_e_two_wheeler_brand_logo($id)
  	{
  		$this->db->where("id",$id);
  		return $this->db->get("list_of_e_two_wheeler_brand")->row();
  	}
  	
  	// electric_two_wheeler 
  	public function fetch_electric_two_wheeler_brand()
  	{
  		return $this->db->get("list_of_e_two_wheeler_brand")->result();
  	}
  	public function add_electric_two_wheeler_brand($data)
  	{
  		if($this->db->insert("list_of_e_two_wheeler_brand",$data)){
  		    return true;
  		}
  		
  		return false;
  	}
  	public function fetch_edit_electric_two_wheeler_brand($id)
  	{
  		$this->db->where("id",$id);
  		return $this->db->get("list_of_e_two_wheeler_brand")->row();
  	}
  	public function edit_electric_two_wheeler_brand($id, $data)
  	{
  		$this->db->where("id",$id);
  		if($this->db->update("list_of_e_two_wheeler_brand",$data)){
  		    return true;
  		}
  		
  		return false;
  	}
  	public function delete_electric_two_wheeler_brand($id)
  	{
  		$this->db->where("id",$id);
  		if($this->db->delete("list_of_e_two_wheeler_brand")){
  		    return true;
  		}
  		
  		return false;
  	}
  
  	//Model
  	
  	public function fetch_e_two_wheeler_brand()
  	{
  		return $this->db->get("list_of_e_two_wheeler_brand")->result();
  	}
  	
  	public function fetch_electric_two_wheeler_model()
  	{
  	    $this->db->select("list_of_e_two_wheeler_model.id,list_of_e_two_wheeler_model.model_name,list_of_e_two_wheeler_brand.brand_name");
  	    $this->db->join("list_of_e_two_wheeler_brand","list_of_e_two_wheeler_brand.id = list_of_e_two_wheeler_model.brand_id");
  		return $this->db->get("list_of_e_two_wheeler_model")->result();
  	}
  	public function add_electric_two_wheeler_model($data)
  	{
  		if($this->db->insert("list_of_e_two_wheeler_model",$data)){
  		    return true;
  		}
  		
  		return false;
  	}
  	public function fetch_edit_electric_two_wheeler_model($id)
  	{
  		$this->db->where("id",$id);
  		return $this->db->get("list_of_e_two_wheeler_model")->row();
  	}
  	public function edit_electric_two_wheeler_model($id, $data)
  	{
  		$this->db->where("id",$id);
  		if($this->db->update("list_of_e_two_wheeler_model",$data)){
  		    return true;
  		}
  		
  		return false;
  	}
  	public function delete_electric_two_wheeler_model($id)
  	{
  		$this->db->where("id",$id);
  		if($this->db->delete("list_of_e_two_wheeler_model")){
  		    return true;
  		}
  		
  		return false;
  	}
  	
  	public function fetch_electric_two_wheeler_varient()
  	{
  	    $this->db->select("list_of_e_two_wheeler_varient.id,list_of_e_two_wheeler_varient.varient_name,list_of_e_two_wheeler_brand.brand_name,list_of_e_two_wheeler_model.model_name");
  	    $this->db->join("list_of_e_two_wheeler_brand","list_of_e_two_wheeler_brand.id = list_of_e_two_wheeler_varient.brand_id");
  	    $this->db->join("list_of_e_two_wheeler_model","list_of_e_two_wheeler_model.id = list_of_e_two_wheeler_varient.model_id");
  		return $this->db->get("list_of_e_two_wheeler_varient")->result();
  	}
  	public function add_electric_two_wheeler_varient($data)
  	{
  		if($this->db->insert("list_of_e_two_wheeler_varient",$data)){
  		    return true;
  		}
  		
  		return false;
  	}
  	public function fetch_edit_electric_two_wheeler_varient($id)
  	{
  		$this->db->where("id",$id);
  		return $this->db->get("list_of_e_two_wheeler_varient")->row();
  	}
  	public function edit_electric_two_wheeler_varient($id, $data)
  	{
  		$this->db->where("id",$id);
  		if($this->db->update("list_of_e_two_wheeler_varient",$data)){
  		    return true;
  		}
  		
  		return false;
  	}
  	public function delete_electric_two_wheeler_varient($id)
  	{
  		$this->db->where("id",$id);
  		if($this->db->delete("list_of_e_two_wheeler_varient")){
  		    return true;
  		}
  		
  		return false;
  	}
  	public function get_electric_two_wheeler_model_list($id)
  	{
  	    $this->db->where("brand_id",$id);
  		return $this->db->get("list_of_e_two_wheeler_model")->result();
  	}
  	
  
  	// users //
  	public function add_users($data)
  	{
  	    $this->db->insert("admin_login",$data);
  	    $insert_id = $this->db->insert_id();
        return  $insert_id;
  	}
  	public function add_user_role($data)
  	{
  	    $this->db->insert("user_role",$data);
  	    $insert_id = $this->db->insert_id();
        return  $insert_id;
  	}
  	
  	
  	public function check_email_already_exits($email)
  	{
  	    $this->db->where("email_id",$email);
  	    $res = $this->db->get("admin_login")->num_rows();
  	    if($res > 0)
  	    {
  	        return true;
  	    }
  	    else
  	    {
  	        return false;
  	    }
  	}
  	
  	public function fetch_users()
  	{
  	    $this->db->select("admin_login.*,list_of_reigion.reigion");
  	    $this->db->from("admin_login");
  	    $this->db->join("list_of_reigion","admin_login.reigion_id=list_of_reigion.id",'left');
  	    $this->db->where("role","user");
  	    $this->db->where("status","active");
  	    return $this->db->get()->result();
  	}
  	
  	
  	public function fetch_regions($order_by = '', $order_type = 'ASC')
  	{
  	 //   return $this->db->get("list_of_reigion")->result();
  	    $this->db->from("list_of_reigion");
  	    if( $order_by )
  	        $this->db->order_by($order_by, $order_type);
  	        
		$query = $this->db->get();
        return $query->result();
  	    
  	}
  
  	public function fetch_users_ai($role)
  	{
  	    $this->db->select("admin_login.*,list_of_reigion.reigion");
  	    $this->db->from("admin_login");
  	    $this->db->join("list_of_reigion","admin_login.reigion_id=list_of_reigion.id",'left');
  	    $this->db->where("role",$role);
  	    $this->db->where("status","active");
  	    return $this->db->get()->result();
  	}
  	
  	public function fetch_user_by_session_id($id)
  	{
  	     $this->db->select("admin_login.*,list_of_reigion.reigion");
  	    $this->db->from("admin_login");
  	    $this->db->join("list_of_reigion","admin_login.reigion_id=list_of_reigion.id",'left');
  	    $this->db->where("role","user");
  	    $this->db->where("status","active");
  	    $this->db->where("admin_login.id",$id);
  	    return $this->db->get()->result();
  	}
  	
  	public function fetch_edit_users_data($id)
  	{
  	    $this->db->where("id",$id);
  	    return $this->db->get("admin_login")->row();
  	}
  	
  	public function edit_users($data,$id)
  	{
  	    $this->db->where("id",$id);
  	    if( $this->db->update("admin_login",$data) ) {
  	        return true;
  	    }
  	    
  	    return false;
  	}
  	
  	public function check_edit_email_already_exits($email,$id)
  	{
  	    $this->db->where("email_id",$email);
  	    $this->db->where("id !=",$id);
  	    $res = $this->db->get("admin_login")->num_rows();
  	    if($res > 0)
  	    {
  	        return true;
  	    }
  	    else
  	    {
  	        return false;
  	    }
  	}
  	
  	public function delete_users($id,$data)
  	{
  	    $this->db->where("id",$id);
  	    if ( $this->db->update("admin_login",$data) ) {
  	        return true;
  	    }
  	    
  	    return false;
  	}
  	
  	// pos //
  	
  	public function check_pos_email_already_exits($email)
  	{
  	     $this->db->where("email_id",$email);
  	    $res = $this->db->get("list_of_pos_and_agents")->num_rows();
  	    if($res > 0)
  	    {
  	        return true;
  	    }
  	    else
  	    {
  	        return false;
  	    }
  	    
  	}
  	
  	public function add_pos($data)
  	{
  	    $this->db->insert("list_of_pos_and_agents",$data);
  	     return $this->db->insert_id();
  	}
  	
  	public function fetch_pos($pos_status,$pos)
  	{
  	    $this->db->select("list_of_pos_and_agents.*,admin_login.username as user_name");
  	    $this->db->from("list_of_pos_and_agents");
  	    $this->db->join("admin_login","list_of_pos_and_agents.created_by=admin_login.id",'left');
  	    $this->db->where("list_of_pos_and_agents.role","pos");
  	    if($this->session->userdata('session_id') != "1")
  	    {
  	    $this->db->where("list_of_pos_and_agents.created_by",$this->session->userdata('session_id'));
  	    }
  	    $this->db->where("pos_status",$pos_status);
  	    
  	    if($pos != "all")
  	    {
  	        $this->db->where("sub_pos_by",$pos);
  	    }
  	    
  	    return $this->db->get()->result();
  	}
  	
  	public function fetch_all_pos_list()
  	{
  	    $this->db->select("list_of_pos_and_agents.*,admin_login.username as user_name");
  	    $this->db->from("list_of_pos_and_agents");
  	    $this->db->join("admin_login","list_of_pos_and_agents.user_id=admin_login.id",'left');
  	    $this->db->where("list_of_pos_and_agents.role","pos");
  	    $this->db->where("pos_status","0");
  	    return $this->db->get()->result();
  	}
  	
  	public function fetch_edit_pos_data($id)
  	{
  	  $this->db->where("id",$id);
  	  return $this->db->get("list_of_pos_and_agents")->row();
  	}
  	
  	public function check_edit_pos_email_already_exits($email,$id)
  	{
  	    $this->db->where("email_id",$email);
  	    $this->db->where("id !=",$id);
  	    $res = $this->db->get("list_of_pos_and_agents")->num_rows();
  	    if($res > 0)
  	    {
  	        return true;
  	    }
  	    else
  	    {
  	        return false;
  	    }
  	}
  	
   public function edit_pos($data,$id)
  	{
  	    $this->db->where("id",$id);
  	    return $this->db->update("list_of_pos_and_agents",$data);
  	}
  	
  	public function delete_pos($id)
  	{
  	    $this->db->where("id",$id);
  	    if ( $this->db->delete("list_of_pos_and_agents") ) {
  	        return true;
  	    }
  	    
  	    return false;
  	}
  	
  	// agents //
  	
  	public function add_agent($data)
  	{
  	    $this->db->insert("list_of_pos_and_agents",$data);
  	}
  	public function fetch_agent_info(){
  	    $this->db->where("list_of_pos_and_agents.role","agent");
  	    return $this->db->get('list_of_pos_and_agents')->result();
  	}
  	public function fetch_insurance_info(){
  	    return $this->db->get('list_of_insurance_company')->result();
  	}
  	public function fetch_agent()
  	{
  	    $this->db->select("list_of_pos_and_agents.*,admin_login.username as user_name,list_of_reigion.reigion as region_name");
  	    $this->db->from("list_of_pos_and_agents");
  	    $this->db->join("admin_login","list_of_pos_and_agents.user_id = admin_login.id",'left');
  	    $this->db->join("list_of_reigion","list_of_reigion.id = list_of_pos_and_agents.region",'left');
  	    $this->db->where("list_of_pos_and_agents.role","agent");
  	    
  	    if($this->session->userdata('session_id') != "1")
  	    {
  	        $this->db->where("list_of_pos_and_agents.created_by",$this->session->userdata('session_id'));
  	    }
  	    
  	    return $this->db->get()->result();
  	}
  	
  	public function fetch_area_incharge($id)
  	{
  	    $this->db->where("id",$id);
  	    return $this->db->get("admin_login")->row();
  	}
            	
  	public function fetch_edit_agent_data($id)
  	{
  	  $this->db->where("id",$id);
  	  return $this->db->get("list_of_pos_and_agents")->row();
  	}
  	
  	public function edit_agent($data,$id)
  	{
  	    $this->db->where("id",$id);
  	    $this->db->update("list_of_pos_and_agents",$data);
  	}
  	
  	public function delete_agent($id)
  	{
  	    $this->db->where("id",$id);
  	    if($this->db->delete("list_of_pos_and_agents")){
  	        return true;
  	    }
  	    
  	    return false;
  	}
  	
  	// client type //
  	
  	public function fetch_client_type()
  	{
  		return $this->db->get("type_of_clients")->result();
  	}
  	public function add_client_type($data)
  	{
  		$this->db->insert("type_of_clients",$data);
  	}
  	public function fetch_edit_client_type($id)
  	{
  		$this->db->where("id",$id);
  		return $this->db->get("type_of_clients")->row();
  	}
  	public function edit_client_type($id, $data)
  	{
  		$this->db->where("id",$id);
  		$this->db->update("type_of_clients",$data);
  	}
  	public function delete_client_type($id)
  	{
  		$this->db->where("id",$id);
  		$this->db->delete("type_of_clients");
  	}
  	
  	// bussiness type //
  	
  	public function fetch_bussiness_type()
  	{
  		return $this->db->get("type_of_bussiness")->result();
  	}
  	public function add_bussiness_type($data)
  	{
  		$this->db->insert("type_of_bussiness",$data);
  	}
  	public function fetch_edit_bussiness_type($id)
  	{
  		$this->db->where("id",$id);
  		return $this->db->get("type_of_bussiness")->row();
  	}
  	public function edit_bussiness_type($id, $data)
  	{
  		$this->db->where("id",$id);
  		$this->db->update("type_of_bussiness",$data);
  	}
  	public function delete_bussiness_type($id)
  	{
  		$this->db->where("id",$id);
  		$this->db->delete("type_of_bussiness");
  	}
  	
  	// policy_type //
  	
  	public function fetch_policy_class($order_by = '', $order_type = 'ASC')
  	{
  	    return $this->db->get("list_of_class")->result();
  	}
  	
  	public function add_policy_type($data)
  	{
  	    if($this->db->insert("list_of_policy_type",$data)){
  	        return true;
  	    }
  	    
  	    return false;
  	}
  	
  	public function fetch_policy_type()
	{
		$this->db->select("
			list_of_policy_type.*, 
			list_of_class.class,
			list_of_car_fuel_type.fuel_type AS fuel_type_name
		");
		$this->db->from("list_of_policy_type");
		$this->db->join("list_of_class", "list_of_policy_type.policy_class = list_of_class.id", "left");
		$this->db->join("list_of_car_fuel_type", "list_of_policy_type.fuel_type_id = list_of_car_fuel_type.id", "left");
		return $this->db->get()->result();
	}

  	
  	public function fetch_edit_policy_type($id)
	{
		$this->db->select("
			list_of_policy_type.*,
			list_of_class.class AS class_name,
			list_of_car_fuel_type.fuel_type AS fuel_type_name
		");
		$this->db->from("list_of_policy_type");
		$this->db->join("list_of_class", "list_of_policy_type.policy_class = list_of_class.id", "left");
		$this->db->join("list_of_car_fuel_type", "list_of_policy_type.fuel_type_id = list_of_car_fuel_type.id", "left");
		$this->db->where("list_of_policy_type.id", $id);

		return $this->db->get()->row();
	}

	public function fetch_fuel_types()
	{
		return $this->db->get("list_of_car_fuel_type")->result();
	}


  	
  	public function edit_policy_type($id, $data)
  	{
  	    $this->db->where("id",$id);
  	    if($this->db->update("list_of_policy_type",$data)){
  	        return true;
  	    }
  	    
  	    return false;
  	}
  	
  	// email template master
  	
  	public function add_email_template($data)
  	{
  	    if($this->db->insert("email_templates",$data)){
  	        return true;
  	    }
  	    
  	    return false;
  	}
  	
  	public function fetch_email_templates()
  	{
  	    return $this->db->get("email_templates")->result();
  	}
  	
  	public function fetch_edit_email_templates($id)
  	{
  	    $this->db->where("id",$id);
  	    return $this->db->get("email_templates")->row();
  	}
  	
  	public function edit_email_template($data,$id)
  	{
  	     $this->db->where("id",$id);
  	     if($this->db->update("email_templates",$data)){
  	         return true;
  	     }
  	     
  	     return false;
  	}
  	
  	public function delete_email_template($id)
  	{
  		$this->db->where("id",$id);
  		$this->db->delete("email_templates");
  	}
  	
  	public function fetch_email_template($id)
  	{
  	    $this->db->where("id",$id);
  	    return $this->db->get("email_templates")->row();
  	}
  	
  	public function fetch_customer_details()
  	{
  	    return $this->db->get("list_of_leads")->result();
  	}
  	
  	  	//get_old file path
  	
  	public function get_old_file_path($id)
  	{
  	    $this->db->where("id",$id);
  	    return $this->db->get("list_of_pos_and_agents")->row();
  	}
  	
  	// masters 
  	
  	public function add_motor_category($data)
  	{
  	    $this->db->insert("commission_motor_category",$data);
  	}
  	
  	public function fetch_motor_category()
  	{
  	    return $this->db->get("commission_motor_category")->result();
  	}
  	
  	public function fetch_edit_motor_category($id)
  	{
  	    $this->db->where("id",$id);
  	    return $this->db->get("commission_motor_category")->row();
  	}
  	
  	public function edit_motor_category($id, $data)
  	{
  	    $this->db->where("id",$id);
  	    $this->db->update("commission_motor_category",$data);
  	}
  	
  	public function add_motor_gvw($data)
  	{
  	     if($this->db->insert("commission_motor_gvw",$data)){
  	         return true;
  	     }
  	     
  	     return false;
  	}
  	
  	public function fetch_motor_gvw()
  	{
  	    $this->db->select("commission_motor_gvw.*,list_of_policy_type.policy_type");
  	    $this->db->from("commission_motor_gvw");
  	    $this->db->join("list_of_policy_type","list_of_policy_type.id = commission_motor_gvw.motor_category_id");
  	    return $this->db->get()->result();
  	}
  	
  	public function fetch_edit_motor_gvw($id)
  	{
  	    $this->db->where("id",$id);
  	    return $this->db->get("commission_motor_gvw")->row(); 
  	}
  	
  	public function edit_motor_gvw($id,$data)
  	{
  	    $this->db->where("id",$id);
  	    if($this->db->update("commission_motor_gvw",$data)){
  	        return true;
  	    }
  	    
  	    return false;
  	}
  	
  	// commission category 
  	
  	public function fetch_commission_category()
  	{
  		return $this->db->get("commission_paid_category")->result();
  	}
  	public function fetch_commission_edit_category($id)
  	{
  		$this->db->where("id",$id);
  		return $this->db->get("commission_paid_category")->row();
  	}
  	public function edit_commission_category($id, $data)
  	{
  		$this->db->where("id",$id);
  		if($this->db->update("commission_paid_category",$data)){
  		    return true;
  		}
  		
  		return false;
  	}
  	
  	public function fetch_commission_list($id)
  	{
  	    $this->db->where("id !=",$id);
  	    return $this->db->get("commission_paid_category")->result();
  	}
  	
  	// pos code
  	
  	public function check_pos_code_already_exits($usr_code)
  	{
  	    $this->db->like('agent_pos_code', $usr_code);
  	    $res = $this->db->get("list_of_pos_and_agents")->row();
  	    
  	    if($res != "")
  	    {
  	        return true;
  	    }
  	    else
  	    {
  	         return false;
  	    }
  	    
  	}
  	
  	public function get_agent_pos_code($usr_code)
  	{
  	     $this->db->like('agent_pos_code',$usr_code);
  	    $this->db->order_by("id", "desc");
  	    return $this->db->get("list_of_pos_and_agents")->row();
  	}
  	
  	// payout commission 
  	
  	public function get_insurer_company()
  	{
  	    return $this->db->get("list_of_insurance_company")->result();
  	}
  	
  	public function get_policy_premium_type()
  	{
  	    return $this->db->get("list_of_premium_cover_type")->result();
  	}
  	
  	public function get_motor_category()
  	{
  	    return $this->db->get("commission_motor_category")->result();
  	}
  	
  	public function get_commission_state()
  	{
  	    return $this->db->get("list_of_commision_state")->result();
  	}
  	
  	public function fetch_load_sub_category($commission_category)
  	{
  	    $this->db->where("motor_category_id",$commission_category);
  	    return $this->db->get("commission_motor_gvw")->result();
  	}
  	
  	public function add_payout_commission($data)
  	{
  	     $this->db->insert("payout_commission ",$data);
  	     $insert_id = $this->db->insert_id();
         return  $insert_id;
  	}
  	
  	public function fetch_payout_commission()
  	{
  	    $this->db->select("payout_commission .*,list_of_insurance_company.company_name,list_of_premium_cover_type.name as premium_name,commission_motor_category.motor_category as mcategory,commission_motor_gvw.motor_gvw as m_gvw,list_of_commision_state.name as commission_state");
  	    $this->db->from("payout_commission ");
  	    $this->db->join("list_of_insurance_company","list_of_insurance_company.id = payout_commission .insurer_company");
  	   $this->db->join("list_of_premium_cover_type","list_of_premium_cover_type.id = payout_commission .policy_premium_type");
  	   $this->db->join("commission_motor_category","commission_motor_category.id = payout_commission .category");
  	   $this->db->join("commission_motor_gvw","commission_motor_gvw.id = payout_commission .product");
  	   $this->db->join("list_of_commision_state","list_of_commision_state.id = payout_commission .state");
  	    $this->db->where("payout_commission.class","1");
  	  return $this->db->get()->result();
  	}
  	
  	public function fetch_payout_commission_search($insurer,$premium_type,$business_type,$commission_type)
  	{
  	   $this->db->select("payout_commission.*,list_of_insurance_company.company_name,list_of_premium_cover_type.name as premium_name,commission_motor_category.motor_category as mcategory,commission_motor_gvw.motor_gvw as m_gvw,list_of_commision_state.name as commission_state");
  	   $this->db->from("payout_commission");
  	   $this->db->join("list_of_insurance_company","list_of_insurance_company.id = payout_commission .insurer_company");
  	   $this->db->join("list_of_premium_cover_type","list_of_premium_cover_type.id = payout_commission .policy_premium_type");
  	   $this->db->join("commission_motor_category","commission_motor_category.id = payout_commission .category");
  	   $this->db->join("commission_motor_gvw","commission_motor_gvw.id = payout_commission .product");
  	   $this->db->join("list_of_commision_state","list_of_commision_state.id = payout_commission .state");
  	   $this->db->where("payout_commission.class","1");
  	   
  	   if($insurer != "all")
  	   {
  	       $this->db->where("payout_commission.insurer_company",$insurer);
  	   }
  	   if($premium_type != "all")
  	   {
  	          $this->db->where("payout_commission.policy_premium_type",$premium_type);
  	   }
  	   if($business_type != "all")
  	   {
  	       $this->db->where("payout_commission.business_type",$business_type);
  	   }
  	   if($commission_type != "all")
  	   {
  	       $this->db->where("payout_commission.commission_type",$commission_type);
  	   }
  	  return $this->db->get()->result();
  	}
  	
  	public function fetch_all_pos()
  	{
  	    $this->db->where("pos_status",0);
  	    return $this->db->get("list_of_pos_and_agents")->result();
  	}
  	
  	public function get_rto_list()
  	{
  	    return $this->db->get("list_of_rto")->result();
  	}
  	
  	public function get_insurer_class()
  	{
  	    return $this->db->get("list_of_class")->result();
  	}
  	
  	public function get_business_type()
  	{
  	    return $this->db->get("type_of_bussiness")->result();
  	}
  	
  	public function add_rto_list($arr)
  	{
  	    $this->db->insert("commission_rto_log",$arr);
  	}
  	
  	public function get_commission_type()
  	{
  	    return $this->db->get("commission_type")->result();
  	}
  	
  	// commission validation
  	
  	public function check_no_of_policy_already_exits($insurer_company,$policy_premium_type,$class,$business_type,$commission_type,$category,$product,$state,$no_of_policy)
  	{
  	    $this->db->where("insurer_company",$insurer_company);
  	    $this->db->where("policy_premium_type",$policy_premium_type);
  	    $this->db->where("class",$class);
  	    $this->db->where("business_type",$business_type);
  	    $this->db->where("category",$category);
  	    $this->db->where("product",$product);
  	    $this->db->where("state",$state);
  	    $this->db->where("no_of_policy",$no_of_policy);
  	    return $this->db->get("payout_commission")->row();
  	}
  	
  	public function check_vechi_age_already_exits($insurer_company,$policy_premium_type,$class,$business_type,$policy_type,$commission_type,$category,$product,$state)
  	{
  	    $this->db->where("insurer_company",$insurer_company);
  	    $this->db->where("policy_premium_type",$policy_premium_type);
  	    $this->db->where("class",$class);
  	    //$this->db->where("business_type",$business_type);
  	    $this->db->where("category",$category);
  	    $this->db->where("product",$product);
  	    $this->db->where("state",$state);
  	    return $this->db->get("payout_commission")->result();
  	}
  	
  	
  	public function check_min_max_val_already_exits($insurer_company,$policy_premium_type,$class,$business_type,$commission_type,$category,$product,$state)
  	{
  	    $this->db->where("insurer_company",$insurer_company);
  	    $this->db->where("policy_premium_type",$policy_premium_type);
  	    $this->db->where("class",$class);
  	    $this->db->where("business_type",$business_type);
  	    $this->db->where("category",$category);
  	    $this->db->where("product",$product);
  	    $this->db->where("state",$state);
  	    return $this->db->get("payout_commission")->result();
  	}
  	
  	public function check_no_of_policy_health_already_exits($insurer_company,$policy_premium_type,$class,$business_type,$commission_type,$no_of_policy)
  	{
  	    $this->db->where("insurer_company",$insurer_company);
  	    $this->db->where("policy_premium_type",$policy_premium_type);
  	    $this->db->where("class",$class);
  	    $this->db->where("business_type",$business_type);
  	    $this->db->where("commission_type",$commission_type);
  	    $this->db->where("no_of_policy",$no_of_policy);
  	    return $this->db->get("payout_commission")->row();
  	}

  	public function check_health_min_max_val_already_exits($insurer_company,$policy_premium_type,$class,$business_type,$commission_type)
  	{
  	    $this->db->where("insurer_company",$insurer_company);
  	    $this->db->where("policy_premium_type",$policy_premium_type);
  	    $this->db->where("class",$class);
  	    $this->db->where("business_type",$business_type);
  	    $this->db->where("commission_type",$commission_type);
  	    return $this->db->get("payout_commission")->result();
  	}
  	
  	
  	public function check_rto_by_payout_commission_id($id,$rto)
  	{
  	    $this->db->where("commission_id",$id);
  	    $this->db->where("rto",$rto);
  	    $res = $this->db->get("commission_rto_log")->row();
  	    
  	    if(count($res) > 0)
  	    {
  	        return true;
  	    }
  	    else
  	    {
  	        return false;
  	    }
  	}
  	
  	public function check_all_rto($id)
  	{
  	    $this->db->where("commission_id",$id);
  	    $this->db->where("rto","All RTO");
  	    $res = $this->db->get("commission_rto_log")->row();
  	    if(count($res) > 0)
  	    {
  	        return true;
  	    }
  	    else
  	    {
  	        return false;
  	    }
  	}
  	
  	public function check_all_tn($id)
  	{
  	    $this->db->where("commission_id",$id);
  	    $this->db->where("rto","All TN");
  	    $res = $this->db->get("commission_rto_log")->row();
  	    if(count($res) > 0)
  	    {
  	        return true;
  	    }
  	    else
  	    {
  	        return false;
  	    }
  	}
  	
  	public function fetch_payout_commission_health()
  	{
  	   $this->db->select("payout_commission.*,list_of_insurance_company.company_name,list_of_premium_cover_type.name as premium_name,commission_type.type as c_type");
  	   $this->db->from("payout_commission");
  	   $this->db->join("list_of_insurance_company","list_of_insurance_company.id = payout_commission .insurer_company");
  	   $this->db->join("list_of_premium_cover_type","list_of_premium_cover_type.id = payout_commission .policy_premium_type");
  	   $this->db->join("commission_type","commission_type.id = payout_commission .commission_type");
  	   $this->db->where("payout_commission.class","2");
  	  return $this->db->get()->result();
  	}
  	
   public function get_commission_info($id)
   {
       $this->db->select("payout_commission.*,list_of_commision_state.name as c_state");
       $this->db->from("payout_commission");
       $this->db->join("list_of_commision_state","payout_commission.state = list_of_commision_state.id");
       $this->db->where("payout_commission.id",$id);
       return $this->db->get()->row();
   }
   
   public function get_commission_info_health($id)
   {
       $this->db->select("payout_commission.*");
       $this->db->from("payout_commission");
       $this->db->where("payout_commission.id",$id);
       return $this->db->get()->row();
   }
   
   // no policy
   
   
   public function check_no_policy($insurer_company,$policy_premium_type,$class,$business_type,$commission_type)
  	{
  	    $this->db->where("insurer_company",$insurer_company);
  	    $this->db->where("policy_premium_type",$policy_premium_type);
  	    $this->db->where("class",$class);
  	    $this->db->where("business_type",$business_type);
  	    $this->db->where("commission_type",$commission_type);
  	    return $this->db->get("payout_commission")->result();
  	}
   
   public function check_policy_id_already_exits($no_policy_id)
   {
       $this->db->where("policy_id",$no_policy_id);
       return $this->db->get("no_of_policy")->row();
   }
   
   public function get_last_policy_id()
   {
       $this->db->order_by("policy_id", "desc");
       return $this->db->get("no_of_policy")->row();
   }
   
   public function add_policy_id($arr)
   {
       $this->db->insert("no_of_policy",$arr);
       return true;
   }
   
   // net premium id
   
   public function check_net_premium_id_already_exits($net_premium_id)
   {
        $this->db->where("net_premium_id",$net_premium_id);
       return $this->db->get("net_premium")->row();
   }
   
    public function get_last_net_premium_id()
   {
       $this->db->select_max('net_premium_id');
       return $this->db->get("net_premium")->row();
   }
   
   public function add_net_premium_id($arr)
   {
       $this->db->insert("net_premium",$arr);
       return true;
   }
   
   // view
   
   public function fetch_commission_details_motor($id)
   {
       $this->db->select("payout_commission .*,list_of_insurance_company.company_name,list_of_premium_cover_type.name as premium_name,commission_motor_category.motor_category as mcategory,commission_motor_gvw.motor_gvw as m_gvw,list_of_commision_state.name as commission_state,commission_type.type as c_type");
  	   $this->db->from("payout_commission ");
  	   $this->db->join("list_of_insurance_company","list_of_insurance_company.id = payout_commission .insurer_company");
  	   $this->db->join("list_of_premium_cover_type","list_of_premium_cover_type.id = payout_commission .policy_premium_type");
  	   $this->db->join("commission_motor_category","commission_motor_category.id = payout_commission .category");
  	   $this->db->join("commission_motor_gvw","commission_motor_gvw.id = payout_commission .product");
  	   $this->db->join("commission_type","commission_type.id = payout_commission.commission_type");
  	   $this->db->join("list_of_commision_state","list_of_commision_state.id = payout_commission .state");
  	   $this->db->where("payout_commission.class","1");
  	   $this->db->where("payout_commission.id",$id);
  	   return $this->db->get()->row();
   }
   
   public function fetch_commission_details_health($id)
   {
       $this->db->select("payout_commission .*,list_of_insurance_company.company_name,list_of_premium_cover_type.name as premium_name,commission_type.type as c_type");
  	   $this->db->from("payout_commission ");
  	   $this->db->join("list_of_insurance_company","list_of_insurance_company.id = payout_commission .insurer_company");
  	   $this->db->join("list_of_premium_cover_type","list_of_premium_cover_type.id = payout_commission .policy_premium_type");
  	   $this->db->join("commission_type","commission_type.id = payout_commission.commission_type");
  	   $this->db->where("payout_commission.class","2");
  	   $this->db->where("payout_commission.id",$id);
  	   return $this->db->get()->row();
   }
   
   public function get_policy_class($id)
   {
       $this->db->where("id",$id);
       return $this->db->get("payout_commission")->row();
   }
   public function fech_rto_details($id)
   {
       $this->db->where("commission_id",$id);
       return $this->db->get("commission_rto_log")->result();
   }
   
   public function update_payout_commission($data,$id)
   {
       $this->db->where("id",$id);
       $this->db->update("payout_commission",$data);
   }
   
   public function update_rto_list($data,$id)
   {
       $this->db->where("commission_id",$id);
       $this->db->update("commission_rto_log",$data);
   }
   
   public function fetch_rto_list($id)
   {
       $this->db->select("rto");
       $this->db->where("commission_id",$id);
       return $this->db->get("commission_rto_log")->result();
   }
   
   
   public function delete_rto_list($id)
   {
       $this->db->where("commission_id",$id);
       $this->db->delete("commission_rto_log");
       return true;
   }
   
   public function delete_commission_list($id)
   {
        $this->db->where("id",$id);
       $this->db->delete("payout_commission");
       return true;
   }
   
   public function add_payout_log($data)
   {
       $this->db->insert("payout_log",$data);
       return true;
   }
   
   
   public function update_user_permissions($data,$id)
   {
       $this->db->where("user_id",$id);
       $this->db->update("user_privileges",$data);
   }
   
   public function fetch_user_permissions($id)
   {
       $this->db->select("user_privileges.*,admin_login.role");
       $this->db->from("user_privileges");
       $this->db->join("admin_login","admin_login.id = user_privileges.user_id");
       $this->db->where("user_privileges.user_id",$id);
       return $this->db->get()->row();
   }
   
   public function add_user_permissions($data_1)
   {
       if( $this->db->insert("user_privileges",$data_1) ) {
           return true;
       }
       
       return false;
   }
   
   public function add_log($data)
   {
       if( $this->db->insert("notification_log",$data) ) {
           return true;
       }
       
       return false;
   }
   
   public function get_rto_list_not_in_old_rto($old_rto)
   {
       $this->db->like('rto_no','TN');
       $old_rto[] = 'All TN';
       $old_rto[] = 'TN/N';
       $old_rto[] = 'TN/G';
       $this->db->where_not_in('rto_no', $old_rto);
       return $this->db->get("list_of_rto")->result();
   }
   
   public function get_rto_list_not_in_old_rto_commission_id($id)
   {
       $this->db->like('rto','TN');
       $this->db->where("commission_id",$id);
       return $this->db->get("commission_rto_log")->result();
   }
   
   public function fetch_policy_type_1()
   {
        $this->db->where("policy_class","1");
  	    $this->db->where("status","0");
  	    return $this->db->get("list_of_policy_type")->result();
   }
   
   	public function delete_motor_sub_category($id)
  	{
  		$this->db->where("id",$id);
  		if($this->db->delete("commission_motor_gvw")){
  		    return true;
  		}
  		
  		return false;
  	}
  	
  	public function fetch_area_incharge_1($region)
  	{
  	  
  	    $this->db->select("admin_login.*");
  	      $this->db->from("admin_login");
  	      $this->db->join("ai_regions","ai_regions.ai_id = admin_login.id");
  	      $this->db->group_by('admin_login.id'); 
  	      $this->db->where("ai_regions.region_id",$region);
  	      return  $this->db->get()->result();
  	}
  	
  	public function fetch_area_incharge_2($region)
  	{
  	      $this->db->select("admin_login.*");
  	      $this->db->from("admin_login");
  	      $this->db->join("ai_regions","ai_regions.ai_id = admin_login.id");
  	      $this->db->group_by('admin_login.id'); 
  	      $this->db->where("ai_regions.region_id",$region);
  	      return  $this->db->get()->result();
  	}
  	
  	public function fetch_district()
  	{
  	    return $this->db->get("list_of_districts")->result();
  	}
  	
  	public function add_user_district($district_arr)
  	{
  	    if( $this->db->insert("user_district",$district_arr) ) {
  	        return true;
  	    }
  	    
  	    return false;
  	}
  	
  	public function add_ai_regions($region_arr)
  	{
  	    if( $this->db->insert("ai_regions",$region_arr) ) {
  	        return true;
  	    }
  	    
  	    return false;
  	}
  	
  	public function fetch_edit_users_district($id)
  	{
  	    $this->db->where("user_id",$id);
  	    return $this->db->get("user_district")->result();
  	}
  	
  	public function fetch_edit_ai_regions($id)
  	{
  	    $this->db->where("ai_id",$id);
  	    return $this->db->get("ai_regions")->result();
  	}
  	
  	public function remove_old_user_districts($id)
  	{
  	    $this->db->where("user_id",$id);
  	    if ( $this->db->delete("user_district") ) {
  	        return true;
  	    }
  	    
  	    return false;
  	}
  	
  	public function remove_old_ai_regions($id)
  	{
  	    $this->db->where("ai_id",$id);
  	    if ( $this->db->delete("ai_regions") ) {
  	        return true;
  	    }
  	    
  	    return false;
  	}
  	
  	public function get_district_name($id)
  	{
  	    $this->db->where("id",$id);
  	    return $this->db->get("list_of_districts")->row();
  	}
  	
  	public function get_region_name($id)
  	{
  	    $this->db->where("id",$id);
  	    return $this->db->get("list_of_reigion")->row();
  	}
    
    
    public function get_all_agent_assign_leads()
    {
        $this->db->where("agency_and_pos !=","");
  	    return $this->db->get("list_of_pos_and_agents")->result();
    }
    
    public function list_of_pos_and_agents()
    {
  	    return $this->db->get("list_of_pos_and_agents")->result();
    }
    
    public function get_area_incharge($id)
    {
        $this->db->where("id",$id);
        return $this->db->get("list_of_pos_and_agents")->row();
    }
    
    public function update_area_incharge($data,$id)
    {
        $this->db->where("id",$id);
        $this->db->update("list_of_leads",$data);
    }
    
    
    public function fetch_user_regions($id)
    {
        $this->db->select("list_of_districts.*,list_of_reigion.id r_id,list_of_reigion.reigion as region_name");
        $this->db->from("list_of_districts");
        $this->db->join("list_of_reigion","list_of_reigion.district_id = list_of_districts.id",'left');
        $this->db->join("user_district","user_district.district_id = list_of_districts.id",'left');
        $this->db->where("user_district.user_id",$id);
        return $this->db->get()->result();
    }
    
    public function fetch_ai_regions($id)
    {
        $this->db->select("list_of_reigion.*");
        $this->db->from("list_of_reigion");
        $this->db->join("ai_regions","ai_regions.region_id = list_of_reigion.id",'left');
        $this->db->where("ai_regions.ai_id",$id);
        return $this->db->get()->result();
    }
    
    public function fetch_user_id_using_region($id)
    {
        $this->db->where("ai_regions.ai_id",$id);
        return $this->db->get("ai_regions")->result();
    }
    
    public function fetch_user_id_using_region_id($region_arr)
    {
        if($region_arr != null)
        {
            $this->db->where_in("id",$region_arr);
            return $this->db->get("list_of_reigion")->result();
        }
        else 
        {
            return array();
        }
    }
    
    public function get_user_id_by_district($districts_arr)
    {
        if($districts_arr != null)
        {
            $this->db->where_in("district_id",$districts_arr);
            return $this->db->get("user_district")->result();
        }
        else
        {
            return array();
        }
    }
    
    public function get_user_id($users_arr)
    {
         if($users_arr != null)
        {
            $this->db->where_in("id",$users_arr);
            return $this->db->get("admin_login")->result();
        }
        else
        {
            return array();
        }
    }
    
    
    // 
    
    public function get_agent_region($agency_and_pos)
    {
        $this->db->where("id",$agency_and_pos);
        return $this->db->get("list_of_pos_and_agents")->row();
    }
    
    public function fetch_user_id_using_region_id_test($region_id)
    {
            $this->db->where("id",$region_id);
            return $this->db->get("list_of_reigion")->row();
    }
    
    public function get_user_id_by_district_test($districts_id)
    {
            $this->db->where("district_id",$districts_id);
            return $this->db->get("user_district")->row();
    }
    
    public function update_agents_user_id($data,$id)
    {
        $this->db->where("id",$id);
        $this->db->update("list_of_pos_and_agents",$data);
    }
    
    public function remove_old_user_secondary_districts($id)
    {
        $this->db->where("user_id",$id);
  	    if ( $this->db->delete("user_secondary_district") ) {
  	        return true;
  	    }
  	    
  	    return false;
    }
    
    public function add_user_secondary_district($district_arr)
  	{
  	    if( $this->db->insert("user_secondary_district",$district_arr) ) {
  	        return true;
  	    }
  	    
  	    return false;
  	}
  	
  	public function fetch_edit_users_secondary_district($id)
  	{
  	    $this->db->where("user_id",$id);
  	    return $this->db->get("user_secondary_district")->result();
  	}
  	
  	public function get_foe_by_district($id)
  	{
  	        $this->db->where("user_id",$id);
            return $this->db->get("user_district")->result();
  	}
  	
  	public function get_usr_id_by_district_arr($districts_id,$id)
  	{
  	        $this->db->where_in("district_id",$districts_id);
  	        $this->db->where("user_id !=",$id);
            return $this->db->get("user_district")->row();
  	}
  	
  	public function get_foe($id)
  	{
  	    $this->db->where("id !=",$id);
  	    $this->db->where("role","user");
  	    $this->db->where("status","active");
  	    return $this->db->get("admin_login")->result();
  	}
  	
  	public function get_ai_data($id)
  	{
  	    $this->db->where("id !=",$id);
  	    $this->db->where("role","AI");
  	    $this->db->where("status","active");
  	    return $this->db->get("admin_login")->result();
  	}
  	
  	public function get_current_ai($id)
  	{
  	    $this->db->where("id",$id);
  	    $this->db->where("role","AI");
  	    $this->db->where("status","active");
  	    return $this->db->get("admin_login")->row();
  	}
  	
  	
  	public function get_foe_districts($foe_id)
  	{
  	    $this->db->where("user_id",$foe_id);
  	    return $this->db->get("user_district")->result();
  	}
  	
  		public function get_ai_regions_id($foe_id)
  	{
  	    $this->db->where("ai_id",$foe_id);
  	    return $this->db->get("ai_regions")->result();
  	}
  	
  	public function update_foe_districts($data)
  	{
  	    $this->db->insert("user_district",$data);
  	}
  	
  	public function update_ai_regions($data)
  	{
  	    $this->db->insert("ai_regions",$data);
  	}
  	
  	public function get_all_active_leads($foe_id)
  	{
  	    $this->db->where("assigned_user",$foe_id);
  	    $this->db->where("lead_type !=","2");
  	    return $this->db->get("list_of_leads")->result();
  	}
  	public function get_all_active_leads_ai($ai_id)
  	{
  	    $this->db->where("area_incharge",$ai_id);
  	    $this->db->where("lead_type !=","2");
  	     $this->db->where("policy_status","0");
  	    return $this->db->get("list_of_leads")->result();
  	}
  	
  	public function update_leads_records($arr,$foe_id)
  	{
  	   $this->db->where("assigned_user",$foe_id);
  	   return $this->db->update("list_of_leads",$arr);
  	}
  	
  	public function update_leads_records_ai($arr,$ai_id)
  	{
  	   $this->db->where("id",$ai_id);
  	    $this->db->update("list_of_leads",$arr);
  	}
  	public function check_this_district_already_exits($district_id,$foe_id)
  	{
  	    $this->db->where("user_id",$foe_id);
  	    $this->db->where("district_id",$district_id);
  	    $res = $this->db->get("user_district")->num_rows();
  	    if($res > 0)
  	    {
  	        return true;
  	    }
  	    else
  	    {
  	        return false;
  	    }
  	}

  	
  	public function check_this_region_ai_already_exits($region_id,$foe_id)
  	{
  	    $this->db->where("ai_id",$foe_id);
  	    $this->db->where("region_id",$region_id);
  	    $res = $this->db->get("ai_regions")->num_rows();
  	    if($res > 0)
  	    {
  	        return true;
  	    }
  	    else
  	    {
  	        return false;
  	    }
  	}
  	
  	public function update_change_status($status,$foe_id)
  	{
  	    $this->db->where("id",$foe_id);
  	    $this->db->update("admin_login",$status);
  	}
  	public function update_change_status_ai($status,$foe_id)
  	{
  	    $this->db->where("id",$foe_id);
  	    $this->db->update("admin_login",$status);
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
    
    
    public function get_all_business_complete_policies_1($from_date,$to_date,$lead_id,$agent_id,$insurance_id)
    {
            $this->db->select("policy_info.id,policy_info.policy_no,policy_info.lead_id,policy_info.policy_premium,policy_info.company,list_of_leads.class,policy_info.policy_issue_date,policy_info.com_add_com,policy_info.agn_add_com,policy_info.own_commission_amt,policy_info.agent_commission_amt,policy_info.commission_status,policy_info.policy_agency_pos,list_of_leads.business_type,policy_info.policy_premium,list_of_leads.assigned_user,policy_info.rto,policy_info.vehicle_classification,policy_info.category,policy_info.company,policy_info.state,policy_info.gst,policy_info.policy_s_date,policy_info.policy_ex_date,list_of_premium_cover_type.name as policy_premium_name,type_of_bussiness.bussiness_type as business_name,list_of_class.class as class_name,list_of_policy_type.policy_type,policy_info.total_own_damage,policy_info.basic_tp,policy_info.total_premium,policy_info.policy_no,list_of_clients.client_name,list_of_clients.mobile_no,list_of_pos_and_agents.agent_pos_code,list_of_insurance_company.company_name,list_of_insurance_company.short_name as ins_short_name,admin_login.name as ai_name");
            $this->db->join("list_of_leads","policy_info.lead_id = list_of_leads.id");
            $this->db->join("list_of_clients","list_of_leads.client_id = list_of_clients.id");
            $this->db->join("list_of_pos_and_agents","policy_info.policy_agency_pos = list_of_pos_and_agents.id");
            $this->db->join("list_of_insurance_company","policy_info.company = list_of_insurance_company.id");
            $this->db->join("type_of_bussiness","list_of_leads.business_type = type_of_bussiness.id");
            $this->db->join("list_of_class","list_of_leads.class = list_of_class.id");
            $this->db->join("list_of_policy_type","list_of_leads.policy_type = list_of_policy_type.id");
            $this->db->join("list_of_premium_cover_type","policy_info.policy_premium = list_of_premium_cover_type.id",'left');
            $this->db->join("admin_login","admin_login.id = list_of_leads.area_incharge",'left');
      	    
            if($from_date != "")
            {
                $this->db->where("policy_info.policy_issue_date >=",$from_date);
            }
            if($to_date != "")
            { 
                $this->db->where("policy_info.policy_issue_date <=",$to_date);
            }
            if($lead_id != "")
            {
                $this->db->where("policy_info.lead_id",$lead_id);
            }
            if($agent_id != "")
            {
                $this->db->where("policy_info.policy_agency_pos",$agent_id);
            }
            if($insurance_id != "")
            {
                $this->db->where("policy_info.company",$insurance_id);
            }
            $this->db->where("policy_info.vocher_status",0);
            $this->db->order_by("policy_info.policy_issue_date","Asc");
            $this->db->where("list_of_leads.lead_type !=","2");
            //$this->db->where("list_of_leads.class","2");
            return $this->db->get("policy_info")->result();
    }
  	
  	public function get_all_business_complete_policies($from_date,$to_date)
  	{
      	    $this->fetch_business_query($from_date,$to_date);
      	    
      	    if($_POST['length'] != -1)
          	{
            	$this->db->limit($_POST['length'],$_POST['start']);
          	}
          	
          	$this->db->join("list_of_leads","temp_policy_info.lead_id = list_of_leads.id");
      	    $this->db->join("list_of_clients","list_of_leads.client_id = list_of_clients.id");
      	    $this->db->join("list_of_pos_and_agents","temp_policy_info.policy_agency_pos = list_of_pos_and_agents.id");
      	    $this->db->join("list_of_insurance_company","temp_policy_info.company = list_of_insurance_company.id");
      	    $this->db->join("type_of_bussiness","list_of_leads.business_type = type_of_bussiness.id");
      	    $this->db->join("list_of_class","list_of_leads.class = list_of_class.id");
      	    $this->db->join("list_of_policy_type","list_of_leads.policy_type = list_of_policy_type.id");
      	    $this->db->join("list_of_premium_cover_type","temp_policy_info.policy_premium = list_of_premium_cover_type.id",'left');
      	    $this->db->join("admin_login","admin_login.id = list_of_leads.area_incharge",'left');
      	   return $this->db->get("temp_policy_info")->result();
  	}
  	
  	public function fetch_business_query($from_date,$to_date)
  	{
            $this->db->select("temp_policy_info.id,temp_policy_info.lead_id,temp_policy_info.policy_premium,temp_policy_info.company,list_of_leads.class,temp_policy_info.policy_issue_date,temp_policy_info.com_add_com,temp_policy_info.agn_add_com,temp_policy_info.own_commission_amt,temp_policy_info.agent_commission_amt,temp_policy_info.commission_status,temp_policy_info.policy_agency_pos,list_of_leads.business_type,temp_policy_info.policy_premium,list_of_leads.class,list_of_leads.assigned_user,temp_policy_info.rto,temp_policy_info.vehicle_classification,temp_policy_info.category,temp_policy_info.company,temp_policy_info.state,temp_policy_info.gst,temp_policy_info.policy_s_date,temp_policy_info.policy_ex_date,list_of_premium_cover_type.name as policy_premium_name,type_of_bussiness.bussiness_type as business_name,list_of_class.class as class_name,list_of_policy_type.policy_type,temp_policy_info.total_own_damage,temp_policy_info.basic_tp,temp_policy_info.total_premium,temp_policy_info.policy_no,list_of_clients.client_name,list_of_clients.mobile_no,list_of_pos_and_agents.agent_pos_code,list_of_insurance_company.company_name,list_of_insurance_company.short_name as ins_short_name,admin_login.name as ai_name");
            
                if(isset($_POST['search']['value']) && $_POST['search']['value'] != "")
                {
                $this->db->where("(temp_policy_info.lead_id LIKE '%".$_POST['search']['value']."%' temp_policy_info.policy_no LIKE '%".$_POST['search']['value']."%' OR list_of_clients.client_name LIKE '%".$_POST['search']['value']."%' OR list_of_clients.mobile_no LIKE '%".$_POST['search']['value']."%' OR list_of_clients.other_contact_details LIKE '%".$_POST['search']['value']."%' OR list_of_clients.landline_no LIKE '%".$_POST['search']['value']."%'  OR list_of_clients.date_of_birth LIKE '%".$_POST['search']['value']."%' OR list_of_clients.age LIKE '%".$_POST['search']['value']."%' OR list_of_clients.area LIKE '%".$_POST['search']['value']."%'  OR list_of_leads.location LIKE '%".$_POST['search']['value']."%' OR list_of_leads.lead_generated_date LIKE '%".$_POST['search']['value']."%' OR list_of_clients.address LIKE '%".$_POST['search']['value']."%' OR list_of_clients.email LIKE '%".$_POST['search']['value']."%' OR type_of_bussiness.bussiness_type LIKE '%".$_POST['search']['value']."%' OR list_of_clients.contact_person_name LIKE '%".$_POST['search']['value']."%' OR list_of_policy_type.policy_type LIKE '%".$_POST['search']['value']."%'  OR list_of_class.class LIKE '%".$_POST['search']['value']."%' OR list_of_clients.contact_person_designation LIKE '%".$_POST['search']['value']."%')", NULL, FALSE);	   
                }
                
                if($from_date != "all")
          	    {
          	        $this->db->where("temp_policy_info.policy_issue_date >=",$from_date);
          	    }
          	    if($to_date != "all")
          	    {
          	        $this->db->where("temp_policy_info.policy_issue_date <=",$to_date);
          	    }
          	    $this->db->where("list_of_leads.class","1");
          	    $this->db->order_by("temp_policy_info.policy_issue_date","Asc");
          	    //$this->db->where("temp_policy_info.lead_id","14335");
          	    $this->db->where("list_of_leads.lead_type !=","2");
  	}
  	
  	public function get_filtered_business_complete_count($from_date,$to_date)
	{
      	$this->fetch_business_query($from_date,$to_date);
      	$this->db->join("list_of_leads","temp_policy_info.lead_id = list_of_leads.id");
      	    $this->db->join("list_of_clients","list_of_leads.client_id = list_of_clients.id");
      	    $this->db->join("list_of_pos_and_agents","temp_policy_info.policy_agency_pos = list_of_pos_and_agents.id");
      	    $this->db->join("list_of_insurance_company","temp_policy_info.company = list_of_insurance_company.id");
      	    $this->db->join("type_of_bussiness","list_of_leads.business_type = type_of_bussiness.id");
      	    $this->db->join("list_of_class","list_of_leads.class = list_of_class.id");
      	    $this->db->join("list_of_policy_type","list_of_leads.policy_type = list_of_policy_type.id");
      	    $this->db->join("list_of_premium_cover_type","temp_policy_info.policy_premium = list_of_premium_cover_type.id",'left');
      	    $this->db->join("admin_login","admin_login.id = list_of_leads.area_incharge",'left');
      	$res = $this->db->get("temp_policy_info");
      	return $res->num_rows();
	}
	
	public function get_all_business_complete_count($from_date,$to_date)
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
            $this->db->join("admin_login","admin_login.id = list_of_leads.area_incharge",'left');
            if($from_date != "all")
            {
               $this->db->where("temp_policy_info.policy_issue_date >=",$from_date);
            }
            if($to_date != "all")
            {
               $this->db->where("temp_policy_info.policy_issue_date <=",$to_date);
            }
            $this->db->where("list_of_leads.class","1");
            $this->db->order_by("temp_policy_info.policy_issue_date","Asc");
            $this->db->where("list_of_leads.lead_type !=","2");
            return $this->db->get("temp_policy_info")->num_rows();
	}
  	
  	public function check_commission($insurer_company,$premium_c_type,$policy_class,$bussiness_type,$policy_type,$state,$from_date,$to_date)
  	{
  	    $this->db->where("insurer_company",$insurer_company);
  	    $this->db->where("policy_premium_type",$premium_c_type);
  	    $this->db->where("class",$policy_class);
  	    //$this->db->where("business_type",$bussiness_type);
  	    $this->db->where("policy_type",$policy_type);
  	    //$this->db->where("state",$state);
  	    //$this->db->where("MONTH(from_date)",date_format(date_create($from_date),"m"));
  	    //$this->db->where("YEAR(from_date)",date_format(date_create($from_date),"Y"));
  	    $this->db->where("from_date <=",$from_date);
  	    $this->db->where("to_date >=",$from_date);
  	    return $this->db->get("company_payout_commission")->result();
  	    
  	}
  	
  	
  	public function check_health_commission($insurer_company,$premium_c_type,$policy_class,$bussiness_type,$policy_type,$state,$from_date,$to_date)
  	{
  	    $this->db->where("insurer_company",$insurer_company);
  	    $this->db->where("class",$policy_class);
  	    $this->db->where("business_type",$bussiness_type);
  	    $this->db->where("policy_type",$policy_type);
  	    $this->db->where("from_date <=",$from_date);
  	    $this->db->where("to_date >=",$from_date);
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
      	    $this->db->where("make_id",$make);
      	     $this->db->where("model_id",$model);
      	     $this->db->where("policy_type",$policy_type);
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
  
  	public function check_rto_already_exits_2($commission_id,$ins_rto)
  	{
  	    if($commission_id != null)
  	    {
  	        if($ins_rto != "")
  	        {
          	    $this->db->where_in("commission_id",$commission_id);
          	    $this->db->where("rto",$ins_rto);
          	    return $this->db->get("commission_rto_log")->result();
  	        }
  	        else
  	        {
  	            return array();
  	        }
  	    }
  	    else
  	    {
  	        return array();
  	    }
  	}
  	
  	public function update_commission($id,$data1)
  	{
  	    $this->db->where("id",$id);
  	    $this->db->update("temp_policy_info",$data1);
  	}
  	
  	public function save_policy_data($id)
  	{
  	       $this->db->query('INSERT INTO policy_info(lead_id,policy_client_ref_no,insurer,policy_cover_note_no,policy_no,policy_s_date,policy_ex_date,policy_premium,policy_terms,payment_frequency,next_due_date,renewable_flag,add_ons_opted,add_ons_not_opt,lead_type,sum_insured,discount_percent,no_claim_bonus,no_claim_bonus_val,total_own_damage,tot_add_on_premium,commisson_base_premium,basic_tp,owner_driver_pa,owner_diver_amt,no_of_year_own_drv,fuel_kit,fuel_kit_amt,geograpical,geograpical_amt,un_named_passenger_pa,un_named_passenger_amt,no_seats_per_person,no_seats_per_person_amt,LL_paid,LL_paid_amt,no_drv_emp,pa_paid_drv,pa_paid_drv_amt,no_seats_per_person1,no_seats_per_person_amt1,tot_liability_premium,total_premium,agent_commission_amt,own_commission_amt,com_add_com,agn_add_com,gst,premium_gst,policy_issue_date,policy_agency_pos,policy_source,policy_user,policy_location,previous_policy_no,previous_insurer,previous_insurance_plan,previous_agency_pos,previous_source,dectable_details,policy_additional_info,reference_no,other_reference_no,policy_received,policy_verified,policy_verified_info,policy_cancelled,policy_cancelled_info,commisson_generation,state,company,rto,commission_type,age,category,vehicle_classification,commission_id,com_trigger_status,com_trigger_date,payment_type,pay_ref_no,bank_name,payment_check_date,payment_and_check_no,remarks,payment_collected_date,status)
                     SELECT lead_id,policy_client_ref_no,insurer,policy_cover_note_no,policy_no,policy_s_date,policy_ex_date,policy_premium,policy_terms,payment_frequency,next_due_date,renewable_flag,add_ons_opted,add_ons_not_opt,lead_type,sum_insured,discount_percent,no_claim_bonus,no_claim_bonus_val,total_own_damage,tot_add_on_premium,commisson_base_premium,basic_tp,owner_driver_pa,owner_diver_amt,no_of_year_own_drv,fuel_kit,fuel_kit_amt,geograpical,geograpical_amt,un_named_passenger_pa,un_named_passenger_amt,no_seats_per_person,no_seats_per_person_amt,LL_paid,LL_paid_amt,no_drv_emp,pa_paid_drv,pa_paid_drv_amt,no_seats_per_person1,no_seats_per_person_amt1,tot_liability_premium,total_premium,agent_commission_amt,own_commission_amt,com_add_com,agn_add_com,gst,premium_gst,policy_issue_date,policy_agency_pos,policy_source,policy_user,policy_location,previous_policy_no,previous_insurer,previous_insurance_plan,previous_agency_pos,previous_source,dectable_details,policy_additional_info,reference_no,other_reference_no,policy_received,policy_verified,policy_verified_info,policy_cancelled,policy_cancelled_info,commisson_generation,state,company,rto,commission_type,age,category,vehicle_classification,commission_id,com_trigger_status,com_trigger_date,payment_type,pay_ref_no,bank_name,payment_check_date,payment_and_check_no,remarks,payment_collected_date,status from temp_policy_info Where id = '.$id.'');
  	}
  	
  	public function check_policy_already_exits($lead_id)
  	{
      	    $this->db->where("lead_id",$lead_id);
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
  	
  
  	
  	public function get_all_triggred_policies()
  	{
  	    $this->db->select("policy_info.id,policy_info.commission_id,policy_info.total_premium,policy_info.no_claim_bonus,policy_info.policy_agency_pos,policy_info.total_own_damage,policy_info.tot_liability_premium,list_of_leads.class");
  	    $this->db->from("policy_info");
  	    $this->db->join("list_of_leads","list_of_leads.id = policy_info.lead_id");
  	    $this->db->where("policy_info.com_trigger_status","1");
  	    $this->db->where("policy_info.calc_com_status","0");
  	    return $this->db->get()->result();
  	}
  	public function get_temp_policy_info_data($id){
  	     $this->db->where('lead_id',$id);
  	     return $this->db->get('temp_policy_info')->row();
  	}
  	public function update_commissions($data,$id)
  	{
         $this->db->where("id",$id);
         $this->db->update("policy_info",$data);
  	}
  	
  	public function update_commissions_by_lead_id($data,$id)
  	{
         $this->db->where("lead_id",$id);
         if( $this->db->update("policy_info",$data) ){
             return true;
         }
         
         return false;
  	}
  	
  	public function check_classification_by_commission_id($commission_id)
  	{
  	   if($commission_id != null)
  	   {
  	       $this->db->where_in("id",$commission_id);
  	       return $this->db->get("company_payout_commission")->result();
  	   }
  	}
  	
  	public function get_classification_1($temp_min,$temp_max,$cc,$lead_id)
  	{
  	   $this->db->where("lead_id",$lead_id);
  	   $this->db->where("vechi_cc BETWEEN '$temp_min' AND '$temp_max'");
  	   return $this->db->get("vechile_details")->num_rows();
  	}
  	
  
  	
  	public function update_leads($data,$id)
  	{
  	    $this->db->where("id",$id);
  	    $this->db->update("list_of_leads",$data);
  	}
  	
  	public function get_policy_premium_name($policy_premium)
  	{
  	    $this->db->where("id",$policy_premium);
  	    return $this->db->get("list_of_premium_cover_type")->row();
  	}
  	
  	public function get_all_pondi_rto()
  	{
  	    $this->db->like("rto","PY");
  	    return $this->db->get("commission_rto_log")->result();
  	}
  	
  	public function update_state($data,$id)
  	{
  	    $this->db->where("id",$id);
  	    $this->db->update("company_payout_commission",$data);
  	}
  	
  	public function check_state_by_commission_id($commission_id)
  	{
  	   if($commission_id != null)
  	   {
  	       $this->db->where_in("id",$commission_id);
  	       return $this->db->get("company_payout_commission")->result();
  	   }
  	}
  	
  	public function update_lead_status($data2,$lead_id)
  	{
  	    $this->db->where("id",$lead_id);
  	    $this->db->update("list_of_leads",$data2);
  	}
  	
  	public function get_all_policy_data()
  	{
  	   return $this->db->get("policy_info")->result();
  	}
  	
  	public function check_health_state($commission_id)
  	{
  	     $this->db->where_in("id",$commission_id);
  	     return $this->db->get("company_payout_commission")->result();
  	}
  	
   public function get_health_lead_info($id)
   {
        $this->db->where("id",$id);
        return $this->db->get("list_of_leads")->row();
   }
   
   	public function swap_ai_regions($data)
  	{
  	    $this->db->insert("ai_regions",$data);
  	}
  	
  	public function delete_ai_regions($ai_id)
  	{
  	    $this->db->where("ai_id",$ai_id);
  	    $this->db->delete("ai_regions");
  	}

  	public function get_agents_pos_datas($ai_id)
  	{
  	    $this->db->where("area_incharge",$ai_id);
  	    return $this->db->get("list_of_pos_and_agents")->result();
  	}
  	
  	public function update_agents_pos_datas($arr,$id)
  	{
  	    $this->db->where("id",$id);
  	    $this->db->update("list_of_pos_and_agents",$arr);
  	}
  	
  	public function get_last_acc_id()
  	{
  	     $this->db->select_max('accid');
  	     return $this->db->get("account_tree")->row();
  	}
  	
  	
  	public function get_extra_com_agents($date)
  	{
  	    $this->db->where("month",$date);
  	    $this->db->order_by("id","desc");
  	    return $this->db->get("extra_commission")->result();
  	}
  	
  	public function get_policy_types($id)
  	{
        $this->db->where("com_id",$id);	   
        return $this->db->get("extra_commission_policy_types")->row();
  	}
  	
  	public function get_policy_cover_types($id)
  	{
  	     $this->db->where("com_id",$id);	   
        return $this->db->get("extra_commission_covers")->row();
  	}
 
  	public function get_total_policy_records_by_agent($insurer,$policy_type,$policy_cover,$agent_id,$date,$to_date)
  	{
  	   $this->db->select("policy_info.id,policy_info.lead_id,policy_info.commission_id,policy_info.tot_liability_premium as tp,policy_info.total_own_damage as od,policy_info.total_premium");
  	   $this->db->from("policy_info");
  	   $this->db->join("list_of_leads","list_of_leads.id = policy_info.lead_id");
  	   $this->db->where("list_of_leads.class","1");
  	   $this->db->where("policy_info.company",$insurer);
  	   $this->db->where("list_of_leads.policy_type",$policy_type);
  	   $this->db->where("policy_info.policy_premium",$policy_cover);
  	   $this->db->where("list_of_leads.agency_and_pos",$agent_id);
  	   $this->db->where("policy_info.policy_issue_date >=",$date);
  	   $this->db->where("policy_info.policy_issue_date <=",$to_date);
  	   $this->db->where("vocher_status","0");
  	   return $this->db->get()->result();
  	}
  	
  	public function get_total_policy_amounts_by_agent($insurer,$policy_type,$policy_cover,$agent_id,$date,$to_date)
  	{
  	   $this->db->select("policy_info.id,policy_info.lead_id,policy_info.commission_id,policy_info.tot_liability_premium as tp,policy_info.total_own_damage as od,SUM(policy_info.total_premium) as tot_premium");
  	   $this->db->from("policy_info");
  	   $this->db->join("list_of_leads","list_of_leads.id = policy_info.lead_id");
  	   $this->db->where("list_of_leads.class","1");
  	   $this->db->where("policy_info.company",$insurer);
  	   $this->db->where("list_of_leads.policy_type",$policy_type);
  	   $this->db->where("policy_info.policy_premium",$policy_cover);
  	   $this->db->where("list_of_leads.agency_and_pos",$agent_id);
  	   $this->db->where("policy_info.policy_issue_date >=",$date);
  	   $this->db->where("policy_info.policy_issue_date <=",$to_date);
  	   $this->db->where("vocher_status","0");
  	   return $this->db->get()->row();
  	}
  	
  	public function get_orginal_payout_commission($id)
  	{
  	    $this->db->where("id",$id);
  	    return $this->db->get("company_payout_commission")->row();
  	}
  	
  	public function get_agent_details($id)
  	{   
  	    $this->db->where("id",$id);
  	    return $this->db->get("list_of_pos_and_agents")->row();
  	}
  	
  	public function update_extra_com($data,$id)
  	{
  	    $this->db->where("id",$id);
  	    $this->db->update("policy_info",$data);
  	}
  	
  	public function save_temp_data($id)
  	{
  	       $this->db->query('INSERT INTO temp_policy_info(lead_id,policy_client_ref_no,insurer,policy_cover_note_no,policy_no,policy_s_date,policy_ex_date,policy_premium,policy_terms,payment_frequency,next_due_date,renewable_flag,add_ons_opted,add_ons_not_opt,lead_type,sum_insured,discount_percent,no_claim_bonus,no_claim_bonus_val,total_own_damage,tot_add_on_premium,commisson_base_premium,basic_tp,owner_driver_pa,owner_diver_amt,no_of_year_own_drv,fuel_kit,fuel_kit_amt,geograpical,geograpical_amt,un_named_passenger_pa,un_named_passenger_amt,no_seats_per_person,no_seats_per_person_amt,LL_paid,LL_paid_amt,no_drv_emp,pa_paid_drv,pa_paid_drv_amt,no_seats_per_person1,no_seats_per_person_amt1,tot_liability_premium,total_premium,agent_commission_amt,own_commission_amt,com_add_com,agn_add_com,gst,premium_gst,policy_issue_date,policy_agency_pos,policy_source,policy_user,policy_location,previous_policy_no,previous_insurer,previous_insurance_plan,previous_agency_pos,previous_source,dectable_details,policy_additional_info,reference_no,other_reference_no,policy_received,policy_verified,policy_verified_info,policy_cancelled,policy_cancelled_info,commisson_generation,state,company,rto,commission_type,age,category,vehicle_classification,commission_id,com_trigger_status,com_trigger_date,payment_type,pay_ref_no,bank_name,payment_check_date,payment_and_check_no,remarks,payment_collected_date,status)
                     SELECT lead_id,policy_client_ref_no,insurer,policy_cover_note_no,policy_no,policy_s_date,policy_ex_date,policy_premium,policy_terms,payment_frequency,next_due_date,renewable_flag,add_ons_opted,add_ons_not_opt,lead_type,sum_insured,discount_percent,no_claim_bonus,no_claim_bonus_val,total_own_damage,tot_add_on_premium,commisson_base_premium,basic_tp,owner_driver_pa,owner_diver_amt,no_of_year_own_drv,fuel_kit,fuel_kit_amt,geograpical,geograpical_amt,un_named_passenger_pa,un_named_passenger_amt,no_seats_per_person,no_seats_per_person_amt,LL_paid,LL_paid_amt,no_drv_emp,pa_paid_drv,pa_paid_drv_amt,no_seats_per_person1,no_seats_per_person_amt1,tot_liability_premium,total_premium,agent_commission_amt,own_commission_amt,com_add_com,agn_add_com,gst,premium_gst,policy_issue_date,policy_agency_pos,policy_source,policy_user,policy_location,previous_policy_no,previous_insurer,previous_insurance_plan,previous_agency_pos,previous_source,dectable_details,policy_additional_info,reference_no,other_reference_no,policy_received,policy_verified,policy_verified_info,policy_cancelled,policy_cancelled_info,commisson_generation,state,company,rto,commission_type,age,category,vehicle_classification,commission_id,com_trigger_status,com_trigger_date,payment_type,pay_ref_no,bank_name,payment_check_date,payment_and_check_no,remarks,payment_collected_date,status from policy_info Where lead_id = '.$id.'');
  	}
  	
  	public function delete_policy_data($lead_id)
  	{
  	    $this->db->where("lead_id",$lead_id);
  	    $this->db->delete("policy_info");
  	}
  	
  	public function add_dealer_details($data)
  	{
  	    $this->db->insert("list_of_dealers",$data);
  	    return $this->db->insert_id();
  	}
  	
  	public function add_dealer_contact_info($data1)
  	{
  	    if( $this->db->insert("dealers_contact_info",$data1) ){
  	        return true;
  	    }
  	    
  	    return false;
  	}
  	
  	public function fetch_dealers($region,$brand,$policy_type,$mobile_no,$dealer_name)
  	{
  	    if($region != "")
  	    {
  	        $this->db->where("region",$region);
  	    }
  	    if($brand != "")
  	    {
  	        $this->db->where("brand",$brand);
  	    }
  	    if($policy_type != "")
  	    {
  	        $this->db->where("p_type",$policy_type);
  	    }
  	    if($dealer_name != "")
  	    {
  	        $this->db->where("dealer_name",$dealer_name);
  	    }
  	    return $this->db->get("list_of_dealers")->result();
  	}
  	
  	public function fetch_dealers_details($id)
  	{
  	     $this->db->where("id",$id);
  	    return $this->db->get("list_of_dealers")->row();
  	}
  	
  	public function fetch_dealers_contact_info($id)
  	{
  	    $this->db->where("dealer_id",$id);
  	    return $this->db->get("dealers_contact_info")->result();
  	}
  	
  	public function edit_dealer_details($data,$id)
  	{
  	    $this->db->where("id",$id);
  	    if( $this->db->update("list_of_dealers",$data) ) {
  	        return true;
  	    }
  	    
  	    return false;
  	}
	
	public function getAccountsByLead($lead_id, $note, $table) {
  	    $this->db->where('lead_id', $lead_id);
  	    $this->db->where("note",$note);
  	    
  	    $this->db->get($table)->row();
  	}
  	
  	public function accouts_update($data,$company,$lead_id,$note){
  	    $this->db->where("lead_id",$lead_id);
  	    $this->db->where("note",$note);
  	    if($company=='jayantha')
  	    {
  	        if($this->db->update("acc_commission_ledger",$data)){
  	            return true;
  	        }
  	    }
  	    else
  	    {
  	        if($this->db->update("acc_commission_ledger_orc",$data)){
  	            return true;
  	        }
  	    }
  	}
  	
  	public function remove_contact_details($id)
  	{
  	    $this->db->where("dealer_id",$id);
  	    if( $this->db->delete("dealers_contact_info") ) {
  	        return true;
  	    }
  	    
  	    return false;
  	}
  	
  	public function add_special_category($data3)
  	{
  	   $this->db->insert("special_commission_log",$data3); 
  	}
   public function check_policy_no_already_exits($policy_no)
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
   
   
  public function edit_special_category($data3)
  	{ 
  		$this->db->insert("special_commission_log",$data3); 
  	}
  	
    public function check_this_lead_id_already_exits_in_temp($lead_id)
    {
        $this->db->where("lead_id",$lead_id);
        return $this->db->get("temp_policy_info")->num_rows();
    }
    
    public function get_active_policy_details_fortc($from_date,$to_date,$lead_id,$agent_id,$insurance_id)
  	{
  	    $this->db->select("policy_info.id,policy_info.company,policy_info.basic_tp,policy_info.lead_id,policy_info.policy_premium,policy_info.policy_issue_date,policy_info.commission_id,policy_info.total_premium,policy_info.no_claim_bonus,policy_info.policy_agency_pos,policy_info.total_own_damage,policy_info.tot_liability_premium,list_of_leads.class, policy_info.own_commission_amt, policy_info.agent_commission_amt");
  	    $this->db->from("policy_info");
  	    $this->db->join("list_of_leads","list_of_leads.id = policy_info.lead_id");
  	    //$this->db->where("policy_info.com_trigger_status","1");
  	    $this->db->where("policy_info.vocher_status","0");
  	    if($from_date != '' && $to_date != '')
  	    {
  	        $this->db->where("policy_info.policy_issue_date >=",$from_date);
  	        $this->db->where("policy_info.policy_issue_date <=",$to_date);
  	    }
  	    if($agent_id != ''){
  	        $this->db->where("list_of_leads.agency_and_pos",$agent_id);
  	    }
  	    if($insurance_id != ""){
  	        $this->db->where("policy_info.company",$insurance_id);
  	    }
  	    if($lead_id != "")
  	    {
  	        $this->db->where("policy_info.lead_id",$lead_id);
  	    }
  	    return $this->db->get()->result();
  	}
    
    public function get_active_policy_details($s_date,$end_date)
  	{
  	    $this->db->select("policy_info.id,policy_info.commission_id,policy_info.total_premium,policy_info.no_claim_bonus,policy_info.policy_agency_pos,policy_info.total_own_damage,policy_info.tot_liability_premium,list_of_leads.class");
  	    $this->db->from("policy_info");
  	    $this->db->join("list_of_leads","list_of_leads.id = policy_info.lead_id");
  	    $this->db->where("policy_info.com_trigger_status","1");
  	    $this->db->where("policy_info.policy_issue_date >=",$s_date);
  	    $this->db->where("policy_info.policy_issue_date <=",$end_date);
  	    return $this->db->get()->result();
  	}
  	
  	public function get_all_agents_list()
  	{
  	    return $this->db->get("list_of_pos_and_agents")->result();
  	}
  	
  	public function check_agents_already_exits($id)
  	{
  	    $this->db->where("id",$id);
  	    return $this->db->get("list_of_pos_and_agents")->num_rows();
  	}
  	public function add_school_details($data)
  	{
  	    $this->db->insert("list_of_school",$data);
  	    return $this->db->insert_id();
  	}
  	public function add_school_contact_info($data1)
  	{
  	    if( $this->db->insert("schools_contact_info",$data1) ) {
  	        return true;
  	    }
  	    
  	    return false;
  	}
  	public function add_school_documents_batch($data)
  	{
  	    return $this->db->insert_batch("school_documents",$data);
  	}
 	public function fetch_schools($region,$brand,$policy_type,$mobile_no,$dealer_name)
  	{
  	    if($region != "")
  	    {
  	        $this->db->where("region",$region);
  	    }
  	    if($brand != "")
  	    {
  	        $this->db->where("brand",$brand);
  	    }
  	    if($policy_type != "")
  	    {
  	        $this->db->where("p_type",$policy_type);
  	    }
  	    if($dealer_name != "")
  	    {
  	        $this->db->where("school_name",$dealer_name);
  	    }
  	    return $this->db->get("list_of_school")->result();
  	}
   public function edit_school_details($data,$id)
  	{
  	    $this->db->where("id",$id);
  	    if( $this->db->update("list_of_school",$data) ) {
  	        return true;
  	    }
  	    
  	    return false;
  	}
  public function fetch_school_details($id)
  	{
  	     $this->db->where("id",$id);
  	    return $this->db->get("list_of_school")->row();
  	}
  	
    public function fetch_school_contact_info($id)
  	{
  	    $this->db->where("school_id",$id);
  	    return $this->db->get("school_contact_info")->result();
  	}
  	
    public function remove_school_contact_details($id)
  	{
  	    $this->db->where("school_id",$id);
  	    return $this->db->delete("school_contact_info");
  	}
  	
    public function fetch_school_documents_info($id)
  	{
  	    $this->db->where("school_id",$id);
  	    return $this->db->get("school_documents")->result();
  	}
  	
  	public function getSchoolDoc($id)
  	{
  	    $this->db->where("id",$id);
  	    return $this->db->get("school_documents")->row();
  	}
  	
  	public function remove_school_document($id)
  	{
  	    return $this->db->where("id",$id)->delete("school_documents");
  	}
  	
  	public function check_dealer_code($code)
  	{
  	    $this->db->select('count(*) as count');
  	    $this->db->where('substring(dealer_code,0,3)',$code);
  	    $this->db->get("list_of_dealers")->row();
  	}
  	
  	// as on 2023-04-13 by kgk
  	public function get_active_policy_commission_leg($from_date,$to_date)
  	{
  	    $this->db->where("policy_issue_date >=",$from_date);
  	    $this->db->where("policy_issue_date <=",$to_date);
  	    return $this->db->get("policy_info")->result();
  	}
   
   
   public function update_commissions_by_lead_id_test($data,$id)
  	{
         $this->db->where("lead_id",$id);
         if( $this->db->update("test_test_policy_info",$data) ){
             return true;
         }
         
         return false;
  	}
   
   //excel import start
  	public function checkDataExists($region,$school_name){
  	    $query = $this->db->get_where('list_of_school', array('region' => $region, 'school_name' => $school_name));
        return $query->num_rows() > 0;

  	}
    public function insert_import($data)
        {
            if($this->db->insert('list_of_school',$data)){
                return true;    
            }
            
            return false;
            
        }
    //excel import end
    
    // update by kgk on 2023-05-15
    public function getActivePolicyDetailsFortc($from_date,$to_date,$lead_id,$agent_id,$insurance_id)
  	{
  	    $this->db->select("p.id,p.company,p.basic_tp,p.lead_id,p.policy_premium,p.policy_issue_date,p.commission_id,
  	    p.total_premium,p.no_claim_bonus,p.policy_agency_pos,p.total_own_damage,p.tot_liability_premium,
  	    l.class, p.own_commission_amt, p.agent_commission_amt, p.policy_s_date,
  	    case when vocher_status = '' then 0 else vocher_status end as vocher_status,
  	    case when company_vocher_status = '' then 0 else company_vocher_status end as company_vocher_status, p.cpa, p.applied_splcommission");
  	    $this->db->from("policy_info p");
  	    $this->db->join("list_of_leads l","l.id = p.lead_id");
  	    //$this->db->where("policy_info.com_trigger_status","1");
  	 //   $this->db->where("policy_info.vocher_status","0");
  	    if($from_date != '' && $to_date != '')
  	    {
  	        $this->db->where("p.policy_issue_date >=",$from_date);
  	        $this->db->where("p.policy_issue_date <=",$to_date);
  	    }
  	    if($agent_id != ''){
  	        $this->db->where("l.agency_and_pos",$agent_id);
  	    }
  	    if($insurance_id != ""){
  	        $this->db->where("p.company",$insurance_id);
  	    }
  	    if($lead_id != "")
  	    {
  	        $this->db->where("p.lead_id",$lead_id);
  	    }
  	    return $this->db->get()->result();
  	}
}