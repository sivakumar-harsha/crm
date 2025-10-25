<?php  
class PayoutMod extends CI_Model  
{  
  	function __construct()  
  	{ 
    	parent::__construct();  
    	$this->load->dbforge();
  	}
  	
  	public function fetch_policy_type()
  	{
  	    $this->db->where("policy_class","1");
  	    $this->db->where("status","0");
  	    return $this->db->get("list_of_policy_type")->result();
  	}
  	
  	public function fetch_health_policy_type()
  	{
  	    $this->db->where("policy_class","2");
  	    $this->db->where("status","0");
  	    return $this->db->get("list_of_policy_type")->result();
  	}
  	
  	public function get_fuel_type()
  	{
  	    return $this->db->get("list_of_car_fuel_type")->result();
  	}
  	
  	// make 
  	
  	public function fetch_make_car()
  	{
  	    return $this->db->get("list_of_car_brand")->result();
  	}
  	
  	public function fetch_make_bike()
  	{
  	    return $this->db->get("list_of_bike_brand")->result();
  	}
  	
  	public function fetch_make_e_two_wheeler()
  	{
  	    return $this->db->get("list_of_e_two_wheeler_brand")->result();
  	}
  	
  	public function fetch_make_scooter()
  	{
  	    return $this->db->get("list_of_scooter_brand")->result();
  	}
  	
  	public function fetch_make_ambulance()
  	{
  	    return $this->db->get("list_of_ambulance_brand")->result();
  	}
  	
  	
  	
  	public function fetch_make_pc($policy_type)
  	{
  	    $this->db->where("policy_type",$policy_type);
  	    return $this->db->get("list_of_pc_vehicle_brand")->result();
  	}
  	
  	public function fetch_make_gc($policy_type)
  	{
  	    $this->db->where("policy_type",$policy_type);
  	    $this->db->where("status","0");
  	    return $this->db->get("list_of_gc_vehicle_brand")->result();
  	}
  	
  	public function fetch_make_misc()
  	{
  	    return $this->db->get("list_of_misc_vehicle_brand")->result();
  	}
  	
  	
  	
  	
  	// model 
  	
  	public function fetch_car_model($vechi_make)
  	{
  	    if(!in_array("all",$vechi_make))
  	    {
  	    $this->db->where_in("brand_id",$vechi_make);
  	    }
  	    return $this->db->get("list_of_car_model")->result();
  	}
  	
  	public function fetch_bike_model($vechi_make)
  	{
  	    if(!in_array("all",$vechi_make))
  	    {
  	    $this->db->where_in("brand_id",$vechi_make);
  	    }
  	    $this->db->where("status","0");
  	    return $this->db->get("list_of_bike_model")->result();
  	}
  	
  	public function fetch_e_two_wheeler_model($vechi_make)
  	{
  	    if(!in_array("all",$vechi_make))
  	    {
  	    $this->db->where_in("brand_id",$vechi_make);
  	    }
  	    return $this->db->get("list_of_e_two_wheeler_model")->result();
  	}
  	
  	public function fetch_scooter_model($vechi_make)
  	{
  	    if(!in_array("all",$vechi_make))
  	    {
  	    $this->db->where_in("brand_id",$vechi_make);
  	    }
  	    $this->db->where("status","0");
  	    return $this->db->get("list_of_scooter_model")->result();
  	}
  	
  	public function fetch_ambulance_model($vechi_make)
  	{
  	    if(!in_array("all",$vechi_make))
  	    {
  	    $this->db->where_in("brand_id",$vechi_make);
  	    }
  	    return $this->db->get("list_of_ambulance_model")->result();
  	}
  	
  	// pc
  	
  	public function fetch_gc_model($vechile_type,$vechi_make)
  	{
  	    if(!in_array("all",$vechi_make))
  	    {
  	       $this->db->where_in("brand_id",$vechi_make);
  	    }
  	    $this->db->where("policy_type",$vechile_type);
  	    $this->db->where("status","0");
  	    return $this->db->get("list_of_gc_vehicle_model")->result();
  	    
  	}
  	
  	public function fetch_misc_model($vechi_make)
  	{
  	    if(!in_array("all",$vechi_make))
  	    {
  	       $this->db->where_in("brand_id",$vechi_make);
  	    }
  	    return $this->db->get("list_of_gc_vehicle_model")->result();
  	    
  	}
  	
  	public function fetch_pc_model($vechile_type,$vechi_make)
  	{
  	    if(!in_array("all",$vechi_make))
  	    {
  	    $this->db->where_in("brand_id",$vechi_make);
  	    }
  	    $this->db->where("policy_type",$vechile_type);
  	    return $this->db->get("list_of_pc_vehicle_model")->result();
  	}
  	
  	public function list_of_gc_vehicle_model($vechi_make)
  	{
  	    if(!in_array("all",$vechi_make))
  	    {
  	     $this->db->where_in("brand_id",$vechi_make);
  	    }
  	    return $this->db->get("list_of_gc_vehicle_model")->result();
  	}
  	
  	public function list_of_misc_vehicle_model($vechi_make)
  	{
  	    if(!in_array("all",$vechi_make))
  	    {
  	     $this->db->where_in("brand_id",$vechi_make);
  	    }
  	    return $this->db->get("list_of_misc_vehicle_model")->result();
  	}
  	
  	// varient
  	
  	public function fetch_car_varient($vechi_make,$vechi_model)
  	{
  	    if(!in_array("all",$vechi_make))
  	    {
  	        $this->db->where_in("brand_id",$vechi_make);
  	    }
  	    if(!in_array("all",$vechi_model))
  	    {
  	        $this->db->where_in("model_id",$vechi_model);
  	    }
  	    return $this->db->get("list_of_car_varient")->result();
  	}
  	
  	public function fetch_bike_varient($vechi_make,$vechi_model)
  	{
  	    if(!in_array("all",$vechi_make))
  	    {
  	        $this->db->where_in("brand_id",$vechi_make);
  	    }
  	    if(!in_array("all",$vechi_model))
  	    {
  	        $this->db->where_in("model_id",$vechi_model);
  	    }
  	    $this->db->where("status","0");
  	    return $this->db->get("list_of_bike_varient")->result();
  	}
  	
  	public function fetch_e_two_wheeler_varient($vechi_make,$vechi_model)
  	{
  	    if(!in_array("all",$vechi_make))
  	    {
  	        $this->db->where_in("brand_id",$vechi_make);
  	    }
  	    if(!in_array("all",$vechi_model))
  	    {
  	        $this->db->where_in("model_id",$vechi_model);
  	    }
  	    return $this->db->get("list_of_e_two_wheeler_varient")->result();
  	}
  	
  	public function fetch_pc_varient($vechile_type,$vechi_make,$vechi_model)
  	{
  	    if(!in_array("all",$vechi_make))
  	    {
  	        $this->db->where_in("brand_id",$vechi_make);
  	    }
  	    if(!in_array("all",$vechi_model))
  	    {
  	        $this->db->where_in("model_id",$vechi_model);
  	    }
  	    $this->db->where("policy_type",$vechile_type);
  	    return $this->db->get("list_of_pc_vehicle_varient")->result();
  	}
  	
  	public function fetch_gc_varient($vechile_type,$vechi_make,$vechi_model)
  	{
  	    if(!in_array("all",$vechi_make))
  	    {
  	        $this->db->where_in("brand_id",$vechi_make);
  	    }
  	    if(!in_array("all",$vechi_model))
  	    {
  	        $this->db->where_in("model_id",$vechi_model);
  	    }
  	    $this->db->where("policy_type",$vechile_type);
  	    $this->db->where("status","0");
  	    return $this->db->get("list_of_gc_vehicle_varient")->result();
  	}
  	
  	public function fetch_misc_varient($vechi_make,$vechi_model)
  	{
  	    if(!in_array("all",$vechi_make))
  	    {
  	        $this->db->where_in("brand_id",$vechi_make);
  	    }
  	    if(!in_array("all",$vechi_model))
  	    {
  	        $this->db->where_in("model_id",$vechi_model);
  	    }
  	    return $this->db->get("list_of_misc_vehicle_varient")->result();
  	}
  	
  	public function fetch_scooter_varient($vechi_make,$vechi_model)
  	{
  	    if(!in_array("all",$vechi_make))
  	    {
  	        $this->db->where_in("brand_id",$vechi_make);
  	    }
  	    if(!in_array("all",$vechi_model))
  	    {
  	        $this->db->where_in("model_id",$vechi_model);
  	    }
  	    $this->db->where("status","0");
  	    return $this->db->get("list_of_scooter_varient")->result();
  	}
  	
  	public function fetch_ambulance_varient($vechi_make,$vechi_model)
  	{
  	    if(!in_array("all",$vechi_make))
  	    {
  	        $this->db->where_in("brand_id",$vechi_make);
  	    }
  	    if(!in_array("all",$vechi_model))
  	    {
  	        $this->db->where_in("model_id",$vechi_model);
  	    }
  	    return $this->db->get("list_of_ambulance_varient")->result();
  	}
  	
  	public function check_vechi_age_already_exits($insurer_company,$premium_c_type,$insurer_class,$business_type,$policy_type,$ins_state,$f_date,$to_date,$add_type, $payout_type = 'Fresh')
  	{
  	    $this->db->where("insurer_company",$insurer_company);
  	    $this->db->where("policy_premium_type",$premium_c_type);
  	    $this->db->where("class",$insurer_class);
  	    $this->db->where("business_type",$business_type);
  	    $this->db->where("policy_type",$policy_type);
  	    $this->db->where("payout_type",$payout_type);
  	    if($ins_state != "All")
  	    {
  	        $this->db->where("state",$ins_state);
  	    }
  	    $this->db->where('(from_date <= "'.$f_date. '" AND  to_date >="'.$to_date.'")');
  	    $this->db->where("type",$add_type);
  	    
  	    return $this->db->get("company_payout_commission")->result();
  	}
  	
  	public function add_payout_commission($data)
  	{
  	    $this->db->insert("company_payout_commission",$data);
  	    $insert_id = $this->db->insert_id();
        return  $insert_id;
  	}
  	
  	public function add_make_list($make_arr)
  	{
  	    if($this->db->insert("com_make_log",$make_arr)){
  	        return true;
  	    }
  	    
  	    return false;
  	}
  	
  	public function get_car_make_id($id)
  	{
  	    $this->db->where("id",$id);
  	    $res = $this->db->get("list_of_car_model")->row();
  	    return  $res->brand_id;
  	}
  	
  	public function get_bike_make_id($id)
  	{
  	    $this->db->where("id",$id);
  	    $res = $this->db->get("list_of_bike_model")->row();
        return  $res->brand_id;
  	}
  	
  	public function get_e_two_wheeler_make_id($id)
  	{
  	    $this->db->where("id",$id);
  	    $res = $this->db->get("list_of_e_two_wheeler_model")->row();
        return  $res->brand_id;
  	}
  	
  	// pc 
  	
    public function get_pc_make_id($id)
  	{
  	    $this->db->where("id",$id);
  	    $res = $this->db->get("list_of_pc_vehicle_model")->row();
        return  $res->brand_id;
  	}
  	
  	// gc
  	
  	public function get_gc_make_id($id,$policy_type)
  	{
  	    $this->db->where("id",$id);
  	    $this->db->where("policy_type",$policy_type);
  	    $res = $this->db->get("list_of_gc_vehicle_model")->row();
        return  $res->brand_id;
  	}
  	
  	// misc
  	
  	public function get_misc_make_id($id)
  	{
  	    $this->db->where("id",$id);
  	    $res = $this->db->get("list_of_misc_vehicle_model")->row();
        return  $res->brand_id;
  	}
  	
  	public function get_scooter_make_id($id)
  	{
  	    $this->db->where("id",$id);
  	    $res = $this->db->get("list_of_scooter_model")->row();
        return  $res->brand_id;
  	}
  	
  	public function get_bike_model_varient_id($id)
  	{
  	    $this->db->where("id",$id);
  	    return $this->db->get("list_of_bike_varient")->row();
  	}
  	
  	public function get_e_two_wheeler_model_varient_id($id)
  	{
  	    $this->db->where("id",$id);
  	    return $this->db->get("list_of_e_two_wheeler_varient")->row();
  	}
  	
  	public function get_car_model_varient_id($id)
  	{
  	     $this->db->where("id",$id);
  	     return $this->db->get("list_of_car_varient")->row();
  	}
  	
  	// pc
  	
  	public function get_pc_model_varient_id($id)
  	{
  	     $this->db->where("id",$id);
  	     return $this->db->get("list_of_pc_vehicle_varient")->row();
  	}
  	
  	// gc
  	
  	public function get_gc_model_varient_id($id)
  	{
  	     $this->db->where("id",$id);
  	     return $this->db->get("list_of_gc_vehicle_varient")->row();
  	}
  	
  	// misc
  	
  	public function get_misc_model_varient_id($id)
  	{
  	     $this->db->where("id",$id);
  	     return $this->db->get("list_of_misc_vehicle_varient")->row();
  	}
  	public function get_scooter_model_varient_id($id)
  	{
  	     $this->db->where("id",$id);
  	     return $this->db->get("list_of_scooter_varient")->row();
  	}
  	
  	public function add_model_list($data)
  	{
  	    if($this->db->insert("com_model_log",$data)){
  	        return true;
  	    }
  	    
  	    return false;
  	}
  	
  	public function add_varient_list($data)
  	{
  	    if($this->db->insert("com_varient_log",$data)){
  	        return true;
  	    }
  	    
  	    return false;
  	}
  	
  	
  	public function add_rto_log($data)
  	{
  	    if($this->db->insert("commission_rto_log",$data)){
  	        return true;
  	    }
  	    
  	    return false;
  	}
  	
  	// Excluding 
  	
  	public function get_car_make_list_not_in_this_arr($make_arr)
  	{
  	    $this->db->where_not_in("id",$make_arr);
  	    return $this->db->get("list_of_car_brand")->result();
  	}
  	
  	public function get_bike_make_list_not_in_this_arr($make_arr)
  	{
  	    $this->db->where_not_in("id",$make_arr);
  	    return $this->db->get("list_of_bike_brand")->result();
  	}
  	
  	public function get_bike_model_list_not_in_this_arr($model)
  	{
  	    $this->db->where_not_in("id",$model);
  	    return $this->db->get("list_of_bike_model")->result();
  	}
  	
  	public function get_car_model_list_not_in_this_arr($model)
  	{
  	    $this->db->where_not_in("id",$model);
  	    return $this->db->get("list_of_car_model")->result();
  	}
  	
  	
   
  	
  	public function get_car_varient_list_not_in_this_arr($varient)
  	{
  	    $this->db->where_not_in("id",$varient);
  	    return $this->db->get("list_of_car_varient")->result();
  	}
  	
  	public function get_bike_varient_list_not_in_this_arr($varient)
  	{
  	    $this->db->where_not_in("id",$varient);
  	    return $this->db->get("list_of_bike_varient")->result();
  	}
  	
  	// ALL MAKE LIST
  	
  	public function add_all_car_make_list($res,$policy_type,$date)
  	{
  	 $this->db->query('INSERT INTO com_make_log(commission_id,policy_type,make,created_by,created_date)
                     SELECT '.$res.','.$policy_type.',id,'.$this->session->userdata('session_id').',"'.$date.'" from list_of_car_brand');
  	}
  	
  	public function add_all_bike_make_list($res,$policy_type,$date)
  	{
  	    $this->db->query('INSERT INTO com_make_log(commission_id,policy_type,make,created_by,created_date)
                     SELECT '.$res.','.$policy_type.',id,'.$this->session->userdata("session_id").',"'.$date.'"  from list_of_bike_brand');
  	}
  	
  	public function add_all_e_two_wheeler_make_list($res,$policy_type,$date)
  	{
  	    $this->db->query('INSERT INTO com_make_log(commission_id,policy_type,make,created_by,created_date)
                     SELECT '.$res.','.$policy_type.',id,'.$this->session->userdata("session_id").',"'.$date.'"  from list_of_e_two_wheeler_brand');
  	}
  	
  	// model
  	
  	public function add_all_bike_model_list($res,$policy_type,$date)
  	{
  	    $this->db->query('INSERT INTO com_model_log(commission_id,policy_type,make_id,model_id,created_by,created_date)
                     SELECT '.$res.','.$policy_type.',brand_id,id,'.$this->session->userdata("session_id").',"'.$date.'" from list_of_bike_model');
  	}
  	
  	public function add_all_e_two_wheeler_model_list($res,$policy_type,$date)
  	{
  	    $this->db->query('INSERT INTO com_model_log(commission_id,policy_type,make_id,model_id,created_by,created_date)
                     SELECT '.$res.','.$policy_type.',brand_id,id,'.$this->session->userdata("session_id").',"'.$date.'" from list_of_e_two_wheeler_model');
  	}
  	
  	public function add_all_car_model_list($res,$policy_type,$date)
  	{
  	    $this->db->query('INSERT INTO com_model_log(commission_id,policy_type,make_id,model_id,created_by,created_date)
                     SELECT '.$res.','.$policy_type.',brand_id,id,'.$this->session->userdata("session_id").',"'.$date.'" from list_of_car_model');
  	}
  	
  	// pc
  	
  	public function add_all_passenger_c_model_list($res,$policy_type,$date)
  	{
  	    $this->db->query('INSERT INTO com_model_log(commission_id,policy_type,make_id,model_id,created_by,created_date)
                     SELECT '.$res.','.$policy_type.',brand_id,id,'.$this->session->userdata("session_id").',"'.$date.'" from list_of_pc_vehicle_model');
  	}
  	
  	// gc
  	
  	 public function add_all_goods_c_model_list($res,$policy_type,$date)
  	{
  	    $this->db->query('INSERT INTO com_model_log(commission_id,policy_type,make_id,model_id,created_by,created_date)
                     SELECT '.$res.','.$policy_type.',brand_id,id,'.$this->session->userdata("session_id").',"'.$date.'" from list_of_gc_vehicle_model');
  	}
  	// misc
  	 public function add_all_misc_model_list($res,$policy_type,$date)
  	{
  	    $this->db->query('INSERT INTO com_model_log(commission_id,policy_type,make_id,model_id,created_by,created_date)
                     SELECT '.$res.','.$policy_type.',brand_id,id,'.$this->session->userdata("session_id").',"'.$date.'" from list_of_misc_vehicle_model');
  	}
  	
  	public function add_all_scooter_model_list($res,$policy_type,$date)
  	{
  	    $this->db->query('INSERT INTO com_model_log(commission_id,policy_type,make_id,model_id,created_by,created_date)
                     SELECT '.$res.','.$policy_type.',brand_id,id,'.$this->session->userdata("session_id").',"'.$date.'" from list_of_scooter_brand');
  	}
  	
  	
  	
  	// varient
  	
  	public function add_all_car_varient_list($res,$policy_type,$date)
  	{
  	    $this->db->query('INSERT INTO com_varient_log(commission_id,policy_type,make_id,model_id,varient_id,created_by,created_date)
                     SELECT '.$res.','.$policy_type.',brand_id,model_id,id,'.$this->session->userdata("session_id").',"'.$date.'" from list_of_car_varient');
  	}
  	
  	public function add_all_bike_varient_list($res,$policy_type,$date)
  	{
  	    $this->db->query('INSERT INTO com_varient_log(commission_id,policy_type,make_id,model_id,varient_id,created_by,created_date)
                     SELECT '.$res.','.$policy_type.',brand_id,model_id,id,'.$this->session->userdata("session_id").',"'.$date.'" from list_of_bike_varient');
  	}
  	
  	public function add_e_two_wheeler_varient_list($res,$policy_type,$date)
  	{
  	    $this->db->query('INSERT INTO com_varient_log(commission_id,policy_type,make_id,model_id,varient_id,created_by,created_date)
                     SELECT '.$res.','.$policy_type.',brand_id,model_id,id,'.$this->session->userdata("session_id").',"'.$date.'" from list_of_e_two_wheeler_varient');
  	}
  	
  	// pc
  	
  	public function add_all_pc_varient_list($res,$policy_type,$date)
  	{
  	    $this->db->query('INSERT INTO com_varient_log(commission_id,policy_type,make_id,model_id,varient_id,created_by,created_date)
                     SELECT '.$res.','.$policy_type.',brand_id,model_id,id,'.$this->session->userdata("session_id").',"'.$date.'" from list_of_pc_vehicle_varient');
  	}
  	
  	// gc
    public function add_all_gc_varient_list($res,$policy_type,$date)
  	{
  	    $this->db->query('INSERT INTO com_varient_log(commission_id,policy_type,make_id,model_id,varient_id,created_by,created_date)
                     SELECT '.$res.','.$policy_type.',brand_id,model_id,id,'.$this->session->userdata("session_id").',"'.$date.'" from list_of_gc_vehicle_varient');
  	}  	
  	
  	// misc
    public function add_all_misc_varient_list($res,$policy_type,$date)
  	{
  	    $this->db->query('INSERT INTO com_varient_log(commission_id,policy_type,make_id,model_id,varient_id,created_by,created_date)
                     SELECT '.$res.','.$policy_type.',brand_id,model_id,id,'.$this->session->userdata("session_id").',"'.$date.'" from list_of_misc_vehicle_varient');
  	}  
  	
  	public function add_all_scooter_varient_list($res,$policy_type,$date)
  	{
  	    $this->db->query('INSERT INTO com_varient_log(commission_id,policy_type,make_id,model_id,varient_id,created_by,created_date)
                     SELECT '.$res.','.$policy_type.',brand_id,model_id,id,'.$this->session->userdata("session_id").',"'.$date.'" from list_of_scooter_varient');
  	}  
  	// by model id 
  	
  	public function add_all_car_varient_list_by_model_id($res,$policy_type,$date,$model_id)
  	{
  	    $this->db->query('INSERT INTO com_varient_log(commission_id,policy_type,make_id,model_id,varient_id,created_by,created_date)
                     SELECT '.$res.','.$policy_type.',brand_id,model_id,id,'.$this->session->userdata("session_id").',"'.$date.'" from list_of_car_varient where model_id ="'.$model_id.'"');
  	}
  	
  	public function add_all_bike_varient_list_by_model_id($res,$policy_type,$date,$model_id)
  	{
  	    $this->db->query('INSERT INTO com_varient_log(commission_id,policy_type,make_id,model_id,varient_id,created_by,created_date)
                     SELECT '.$res.','.$policy_type.',brand_id,model_id,id,'.$this->session->userdata("session_id").',"'.$date.'" from list_of_bike_varient where model_id ="'.$model_id.'"');
  	}
  	
  	public function add_all_e_two_wheeler_varient_list_model_id($res,$policy_type,$date,$model_id)
  	{
  	    $this->db->query('INSERT INTO com_varient_log(commission_id,policy_type,make_id,model_id,varient_id,created_by,created_date)
                     SELECT '.$res.','.$policy_type.',brand_id,model_id,id,'.$this->session->userdata("session_id").',"'.$date.'" from list_of_e_two_wheeler_varient where model_id ="'.$model_id.'"');
  	}
  	// pc
  	public function add_all_pc_varient_list_by_model_id($res,$policy_type,$date,$model_id)
  	{
  	    $this->db->query('INSERT INTO com_varient_log(commission_id,policy_type,make_id,model_id,varient_id,created_by,created_date)
                     SELECT '.$res.','.$policy_type.',brand_id,model_id,id,'.$this->session->userdata("session_id").',"'.$date.'" from list_of_pc_vehicle_varient where model_id ="'.$model_id.'"');
  	}
  	// gc
  	
  	public function add_all_gc_varient_list_by_model_id($res,$policy_type,$date,$model_id)
  	{
  	    $this->db->query('INSERT INTO com_varient_log(commission_id,policy_type,make_id,model_id,varient_id,created_by,created_date)
                     SELECT '.$res.','.$policy_type.',brand_id,model_id,id,'.$this->session->userdata("session_id").',"'.$date.'" from list_of_gc_vehicle_varient where model_id ="'.$model_id.'"');
  	}
  	
  	// misc
  	
  	public function add_all_misc_varient_list_by_model_id($res,$policy_type,$date,$model_id)
  	{
  	    $this->db->query('INSERT INTO com_varient_log(commission_id,policy_type,make_id,model_id,varient_id,created_by,created_date)
                     SELECT '.$res.','.$policy_type.',brand_id,model_id,id,'.$this->session->userdata("session_id").',"'.$date.'" from list_of_misc_vehicle_varient where model_id ="'.$model_id.'"');
  	}
  	
  	public function add_all_scooter_varient_list_by_model_id($res,$policy_type,$date,$model_id)
  	{
  	    $this->db->query('INSERT INTO com_varient_log(commission_id,policy_type,make_id,model_id,varient_id,created_by,created_date)
                     SELECT '.$res.','.$policy_type.',brand_id,model_id,id,'.$this->session->userdata("session_id").',"'.$date.'" from list_of_scooter_varient where model_id ="'.$model_id.'"');
  	}
  
  	
  	public function add_all_car_varient_list_by_make_id($res,$policy_type,$date,$make_id)
  	{
  	    $this->db->query('INSERT INTO com_varient_log(commission_id,policy_type,make_id,model_id,varient_id,created_by,created_date)
                     SELECT '.$res.','.$policy_type.',brand_id,model_id,id,'.$this->session->userdata("session_id").',"'.$date.'" from list_of_car_varient where brand_id ="'.$make_id.'"');
  	}
  	
  	public function add_all_bike_varient_list_by_make_id($res,$policy_type,$date,$make_id)
  	{
  	    $this->db->query('INSERT INTO com_varient_log(commission_id,policy_type,make_id,model_id,varient_id,created_by,created_date)
                     SELECT '.$res.','.$policy_type.',brand_id,model_id,id,'.$this->session->userdata("session_id").',"'.$date.'" from list_of_bike_varient where brand_id ="'.$make_id.'"');
  	}
  	
  	public function add_all_e_two_wheeler_varient_list_make_id($res,$policy_type,$date,$make_id)
  	{
  	    $this->db->query('INSERT INTO com_varient_log(commission_id,policy_type,make_id,model_id,varient_id,created_by,created_date)
                     SELECT '.$res.','.$policy_type.',brand_id,model_id,id,'.$this->session->userdata("session_id").',"'.$date.'" from list_of_e_two_wheeler_varient where brand_id ="'.$make_id.'"');
  	}
  	
  	// pc
  	public function add_all_pc_varient_list_by_make_id($res,$policy_type,$date,$make_id)
  	{
  	    $this->db->query('INSERT INTO com_varient_log(commission_id,policy_type,make_id,model_id,varient_id,created_by,created_date)
                     SELECT '.$res.','.$policy_type.',brand_id,model_id,id,'.$this->session->userdata("session_id").',"'.$date.'" from list_of_pc_vehicle_varient where brand_id ="'.$make_id.'"');
  	}
  	
  	// gc
  	
  	public function add_all_gc_varient_list_by_make_id($res,$policy_type,$date,$make_id)
  	{
  	    $this->db->query('INSERT INTO com_varient_log(commission_id,policy_type,make_id,model_id,varient_id,created_by,created_date)
                     SELECT '.$res.','.$policy_type.',brand_id,model_id,id,'.$this->session->userdata("session_id").',"'.$date.'" from list_of_gc_vehicle_varient where brand_id ="'.$make_id.'"');
  	}
  	
    public function add_all_misc_varient_list_by_make_id($res,$policy_type,$date,$make_id)
  	{
  	    $this->db->query('INSERT INTO com_varient_log(commission_id,policy_type,make_id,model_id,varient_id,created_by,created_date)
                     SELECT '.$res.','.$policy_type.',brand_id,model_id,id,'.$this->session->userdata("session_id").',"'.$date.'" from list_of_misc_vehicle_varient where brand_id ="'.$make_id.'"');
  	}
  	
  	 public function add_all_scooter_varient_list_by_make_id($res,$policy_type,$date,$make_id)
  	{
  	    $this->db->query('INSERT INTO com_varient_log(commission_id,policy_type,make_id,model_id,varient_id,created_by,created_date)
                     SELECT '.$res.','.$policy_type.',brand_id,model_id,id,'.$this->session->userdata("session_id").',"'.$date.'" from list_of_scooter_varient where brand_id ="'.$make_id.'"');
  	}
  	
  	
  	
  	
  	// by make id
  	
  	public function add_all_car_model_list_by_make_id($res,$policy_type,$date,$id)
  	{
  	     $this->db->query('INSERT INTO com_model_log(commission_id,policy_type,make_id,model_id,created_by,created_date)
                     SELECT '.$res.','.$policy_type.',brand_id,id,'.$this->session->userdata("session_id").',"'.$date.'" from list_of_car_model where brand_id= "'.$id.'"');
  	}
  	
  	public function add_all_bike_model_list_by_make_id($res,$policy_type,$date,$id)
  	{
  	    $this->db->query('INSERT INTO com_model_log(commission_id,policy_type,make_id,model_id,created_by,created_date)
                     SELECT '.$res.','.$policy_type.',brand_id,id,'.$this->session->userdata("session_id").',"'.$date.'" from list_of_bike_model where brand_id= "'.$id.'"');
  	}
  	
  	public function add_all_e_two_wheeler_model_list_by_make_id($res,$policy_type,$date,$id)
  	{
  	    $this->db->query('INSERT INTO com_model_log(commission_id,policy_type,make_id,model_id,created_by,created_date)
                     SELECT '.$res.','.$policy_type.',brand_id,id,'.$this->session->userdata("session_id").',"'.$date.'" from list_of_e_two_wheeler_model where brand_id= "'.$id.'"');
  	}
  	
  	//pc
  	
  	public function add_all_passenger_c_by_make_id($res,$policy_type,$date,$id)
  	{
  	     $this->db->query('INSERT INTO com_model_log(commission_id,policy_type,make_id,model_id,created_by,created_date)
                     SELECT '.$res.','.$policy_type.',brand_id,id,'.$this->session->userdata("session_id").',"'.$date.'" from list_of_pc_vehicle_model where brand_id= "'.$id.'"');
  	}
  	
  	// gc
  	
  	public function add_all_goods_c_by_make_id($res,$policy_type,$date,$id)
  	{
  	     $this->db->query('INSERT INTO com_model_log(commission_id,policy_type,make_id,model_id,created_by,created_date)
                     SELECT '.$res.','.$policy_type.',brand_id,id,'.$this->session->userdata("session_id").',"'.$date.'" from list_of_gc_vehicle_model where brand_id= "'.$id.'"');
  	}
  	
  	// misc
  	
  	public function add_all_misc_by_make_id($res,$policy_type,$date,$id)
  	{
  	     $this->db->query('INSERT INTO com_model_log(commission_id,policy_type,make_id,model_id,created_by,created_date)
                     SELECT '.$res.','.$policy_type.',brand_id,id,'.$this->session->userdata("session_id").',"'.$date.'" from list_of_misc_vehicle_model where brand_id= "'.$id.'"');
  	}
  	
  	public function aadd_all_scooter_model_list_make_id($res,$policy_type,$date,$id)
  	{
  	     $this->db->query('INSERT INTO com_model_log(commission_id,policy_type,make_id,model_id,created_by,created_date)
                     SELECT '.$res.','.$policy_type.',brand_id,id,'.$this->session->userdata("session_id").',"'.$date.'" from list_of_e_two_wheeler_model where brand_id= "'.$id.'"');
  	}
  	
  	
  	
  	public function check_make_already_exits($commission_id,$policy_type,$make)
  	{
  	    if($commission_id != null)
  	    {
      	    $this->db->where_in("commission_id",$commission_id);
      	    $this->db->where("policy_type",$policy_type);
      	    
      	    if(!in_array("all",$make))
      	    {
      	       $this->db->where_in("make",$make);
      	    }
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
      	    $this->db->where("policy_type",$policy_type);
      	    
      	    if(!in_array("all",$make) && !in_array("all",$model))
      	    {
          	    $this->db->where_in("make_id",$make);
          	    $this->db->where_in("model_id",$model);
      	    }
      	    else if(!in_array("all",$make))
      	    {
      	        $this->db->where_in("make_id",$make);
      	    }
      	    else if(!in_array("all",$model))
      	    {
      	        $this->db->where_in("model_id",$model);
      	    }
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
  	    if(!in_array("all",$make) && !in_array("all",$model) && !in_array("all",$varient))
  	    {
      	    $this->db->where_in("make_id",$make);
      	    $this->db->where_in("model_id",$model);
      	    $this->db->where_in("varient_id",$varient);
  	    }
  	    else if(!in_array("all",$make) && !in_array("all",$model))
  	    {
  	        $this->db->where_in("make_id",$make);
      	    $this->db->where_in("model_id",$model);
  	    }
  	    else if(!in_array("all",$make) && in_array("all",$model))
  	    {
  	        $this->db->where_in("make_id",$make);
  	    }
  	    else if(!in_array("all",$varient))
  	    {
  	        $this->db->where_in("varient_id",$varient);
  	    }
  	    $this->db->where("policy_type",$policy_type);
  	    return $this->db->get("com_varient_log")->result();
  	   }
  	   else
  	   {
  	       return array();
  	   }
  	}
  	
  	public function check_rto_already_exits($commission_id,$ins_rto)
  	{
  	    if($commission_id != null)
  	    {
      	    $this->db->where_in("commission_id",$commission_id);
      	    $this->db->where_in("rto",$ins_rto);
      	    return $this->db->get("commission_rto_log")->result();
  	    }
  	    else
  	    {
  	        return array();
  	    }
  	}
  	
  	public function check_rto_already_exits_1($commission_id,$ins_rto)
  	{
      	   if($commission_id != null)
      	   {
          	    $this->db->where_in("commission_id",$commission_id);
          	    $this->db->where_in("rto",$ins_rto);
          	    return $this->db->get("commission_rto_log")->result();
      	   }
  	}
  	// pc
  	public function add_all_passenger_c_make_list($res,$policy_type,$date)
  	{
  	    $this->db->query('INSERT INTO com_make_log(commission_id,policy_type,make,created_by,created_date)
                     SELECT '.$res.','.$policy_type.',id,'.$this->session->userdata("session_id").',"'.$date.'"  from list_of_pc_vehicle_brand');
  	}
  	
  	// gc
  	
  	public function add_all_goods_c_make_list($res,$policy_type,$date)
  	{
  	    $this->db->query('INSERT INTO com_make_log(commission_id,policy_type,make,created_by,created_date)
                     SELECT '.$res.','.$policy_type.',id,'.$this->session->userdata("session_id").',"'.$date.'"  from list_of_gc_vehicle_brand');
  	}
  	
  	//misc
  	
  	public function add_all_misc_make_list($res,$policy_type,$date)
  	{
  	    $this->db->query('INSERT INTO com_make_log(commission_id,policy_type,make,created_by,created_date)
                     SELECT '.$res.','.$policy_type.',id,'.$this->session->userdata("session_id").',"'.$date.'"  from list_of_misc_vehicle_brand');
  	}
  	
  	public function add_all_scooter_make_list($res,$policy_type,$date)
  	{
  	    $this->db->query('INSERT INTO com_make_log(commission_id,policy_type,make,created_by,created_date)
                     SELECT '.$res.','.$policy_type.',id,'.$this->session->userdata("session_id").',"'.$date.'"  from list_of_scooter_brand');
  	}
  	
  	// classification
  	
  	public function fetch_classification($policy_type)
  	{
  	    $this->db->where("motor_category_id",$policy_type);
  	    return $this->db->get("commission_motor_gvw")->result();
  	}
   
   public function fetch_payout_commission($class,$f_date,$to_date)
    {
      $this->db->select("company_payout_commission.*,list_of_insurance_company.company_name,list_of_policy_type.policy_type as p_type,list_of_premium_cover_type.name as premium_name,commission_motor_gvw.motor_gvw as m_gvw,commission_motor_gvw.to_gvw_cc,commission_motor_gvw.from_gvw_cc,commission_motor_gvw.classification as classi,list_of_commision_state.name as commission_state,list_of_car_fuel_type.fuel_type,pcv_seating.seating_capacity");
  	  $this->db->from("company_payout_commission ");
  	  $this->db->join("list_of_insurance_company","list_of_insurance_company.id = company_payout_commission .insurer_company");
  	  $this->db->join("list_of_premium_cover_type","list_of_premium_cover_type.id = company_payout_commission .policy_premium_type");
  	  $this->db->join("commission_motor_gvw","commission_motor_gvw.id = company_payout_commission.classification",'left');
  	  $this->db->join("list_of_car_fuel_type","list_of_car_fuel_type.id = company_payout_commission .fuel_type");
  	  $this->db->join("list_of_policy_type","list_of_policy_type.id = company_payout_commission .policy_type");
  	  $this->db->join("pcv_seating","pcv_seating.id = company_payout_commission .classification",'left');
  	  $this->db->join("list_of_commision_state","list_of_commision_state.id = company_payout_commission .state");
  	  $this->db->order_by("list_of_insurance_company.company_name", "asc");
  	  $this->db->where("company_payout_commission.class",$class);
  	  //$this->db->where('(company_payout_commission.from_date <= "'.$f_date. '" AND  company_payout_commission.to_date >="'.$to_date.'")');
  	  return $this->db->get()->result();
    }
    
    
    public function fetch_payout_commission_health($class, $f_date, $to_date)
	{
		$this->db->select("
			MAX(company_payout_commission.id) AS id,
			company_payout_commission.class,
			company_payout_commission.insurer_company,
			company_payout_commission.business_type,
			company_payout_commission.policy_type,
			MAX(company_payout_commission.from_date) AS from_date,
			MAX(company_payout_commission.to_date) AS to_date,
			list_of_insurance_company.company_name,
			list_of_policy_type.policy_type AS p_type,
			type_of_bussiness.bussiness_type
		");
		$this->db->from("company_payout_commission");
		$this->db->join("list_of_insurance_company", "list_of_insurance_company.id = company_payout_commission.insurer_company");
		$this->db->join("list_of_policy_type", "list_of_policy_type.id = company_payout_commission.policy_type");
		$this->db->join("type_of_bussiness", "type_of_bussiness.id = company_payout_commission.business_type", "left");
		$this->db->order_by("list_of_insurance_company.company_name", "asc");
		$this->db->where("company_payout_commission.class", $class);

		if ($f_date != "" && $to_date != "") {
			$this->db->where("company_payout_commission.from_date >=", $f_date);
			$this->db->where("company_payout_commission.to_date <=", $to_date);
		}

		$this->db->group_by([
			"company_payout_commission.insurer_company",
			"company_payout_commission.business_type",
			"company_payout_commission.policy_type",
			"company_payout_commission.class"
		]);

		return $this->db->get()->result();
	}



    
    public function fetch_payout_commission_health_by_id($id)
    {
      $this->db->select("company_payout_commission.*,list_of_insurance_company.company_name,list_of_policy_type.policy_type as p_type,type_of_bussiness.bussiness_type as b_type");
  	  $this->db->from("company_payout_commission");
  	  $this->db->join("list_of_insurance_company","list_of_insurance_company.id = company_payout_commission .insurer_company");
  	  $this->db->join("list_of_policy_type","list_of_policy_type.id = company_payout_commission .policy_type");
  	  $this->db->join("type_of_bussiness","type_of_bussiness.id = company_payout_commission .business_type");
  	  $this->db->where("company_payout_commission.class","2");
  	  $this->db->where("company_payout_commission.id",$id);
  	  return $this->db->get()->row();
    }
    
  public function get_policy_class($id)
   {
       $this->db->where("id",$id);
       return $this->db->get("company_payout_commission")->row();
   }
   
   
   public function fetch_commission_details_motor($id)
   {
      $this->db->select("company_payout_commission.*,list_of_policy_type.policy_type as p_type,list_of_insurance_company.company_name,list_of_premium_cover_type.name as premium_name,type_of_bussiness.bussiness_type as b_type,commission_motor_gvw.to_gvw_cc,commission_motor_gvw.from_gvw_cc,commission_motor_gvw.classification,list_of_commision_state.name as commission_state,list_of_car_fuel_type.fuel_type,commission_type.type as c_type");
  	  $this->db->from("company_payout_commission");
  	  $this->db->join("list_of_insurance_company","list_of_insurance_company.id = company_payout_commission .insurer_company");
  	  $this->db->join("type_of_bussiness","type_of_bussiness.id = company_payout_commission .business_type");
  	  $this->db->join("list_of_policy_type","list_of_policy_type.id = company_payout_commission .policy_type");
  	  $this->db->join("list_of_premium_cover_type","list_of_premium_cover_type.id = company_payout_commission .policy_premium_type");
  	  $this->db->join("commission_motor_gvw","commission_motor_gvw.id = company_payout_commission .classification",'left');
  	  $this->db->join("list_of_car_fuel_type","list_of_car_fuel_type.id = company_payout_commission .fuel_type");
  	  $this->db->join("list_of_commision_state","list_of_commision_state.id = company_payout_commission .state");
  	  $this->db->join("commission_type","commission_type.id = company_payout_commission.commission_type");
  	  $this->db->where("company_payout_commission.id",$id);
  	  return $this->db->get()->row();
   }
   
   public function fetch_make_car_brand($id,$policy_type)
   {
       $this->db->select("list_of_car_brand.*");
       $this->db->from("list_of_car_brand");
       $this->db->join("com_make_log","com_make_log.make = list_of_car_brand.id");
       $this->db->where("com_make_log.commission_id",$id);
       $this->db->where("com_make_log.policy_type",$policy_type);
       return $this->db->get()->result();
   }
   
   public function fetch_car_model_name($id,$policy_type)
   {
       $this->db->select("list_of_car_model.*");
       $this->db->from("list_of_car_model");
       //$this->db->join("com_model_log","com_model_log.make_id = list_of_car_brand.id");
       $this->db->join("com_model_log","com_model_log.model_id = list_of_car_model.id");
       $this->db->where("com_model_log.commission_id",$id);
       $this->db->where("com_model_log.policy_type",$policy_type);
       return $this->db->get()->result();
   }
   
   public function fetch_car_varient_name($id,$policy_type)
   {
       $this->db->select("list_of_car_varient.*");
       $this->db->from("list_of_car_varient");
       //$this->db->join("com_varient_log","com_model_log.make_id = list_of_car_brand.id");
       //$this->db->join("com_varient_log","com_model_log.model_id = list_of_car_model.id");
       $this->db->join("com_varient_log","com_varient_log.varient_id = list_of_car_varient.id");
       $this->db->where("com_varient_log.commission_id",$id);
       $this->db->where("com_varient_log.policy_type",$policy_type);
       return $this->db->get()->result();
   }
   
   // bike 
   
   public function fetch_make_bike_brand($id,$policy_type)
   {
       $this->db->select("list_of_bike_brand.*");
       $this->db->from("list_of_bike_brand");
       $this->db->join("com_make_log","com_make_log.make = list_of_bike_brand.id");
       $this->db->where("com_make_log.commission_id",$id);
       $this->db->where("com_make_log.policy_type",$policy_type);
       return $this->db->get()->result();
   }
   
   
   
   public function fetch_bike_model_name($id,$policy_type)
   {
       $this->db->select("list_of_bike_model.*");
       $this->db->from("list_of_bike_model");
       //$this->db->join("com_model_log","com_model_log.make_id = list_of_bike_brand.id");
       $this->db->join("com_model_log","com_model_log.model_id = list_of_bike_model.id");
       $this->db->where("com_model_log.commission_id",$id);
       $this->db->where("com_model_log.policy_type",$policy_type);
       return $this->db->get()->result();
   }
   
   public function fetch_bike_varient_name($id,$policy_type)
   {
       $this->db->select("list_of_bike_varient.*");
       $this->db->from("list_of_bike_varient");
       //$this->db->join("com_varient_log","com_model_log.make_id = list_of_bike_brand.id");
       //$this->db->join("com_varient_log","com_model_log.model_id = list_of_bike_model.id");
       $this->db->join("com_varient_log","com_varient_log.varient_id = list_of_bike_varient.id");
       $this->db->where("com_varient_log.commission_id",$id);
       $this->db->where("com_varient_log.policy_type",$policy_type);
       return $this->db->get()->result();
   }
   
   // e two wheeler
   
   public function fetch_make_e_two_wheeler_brand($id,$policy_type)
   {
       $this->db->select("list_of_e_two_wheeler_brand.*");
       $this->db->from("list_of_e_two_wheeler_brand");
       $this->db->join("com_make_log","com_make_log.make = list_of_e_two_wheeler_brand.id");
       $this->db->where("com_make_log.commission_id",$id);
       $this->db->where("com_make_log.policy_type",$policy_type);
       return $this->db->get()->result();
   }
   
   
   
   public function fetch_e_two_wheeler_model_name($id,$policy_type)
   {
       $this->db->select("list_of_e_two_wheeler_model.*");
       $this->db->from("list_of_e_two_wheeler_model");
       //$this->db->join("com_model_log","com_model_log.make_id = list_of_bike_brand.id");
       $this->db->join("com_model_log","com_model_log.model_id = list_of_e_two_wheeler_model.id");
       $this->db->where("com_model_log.commission_id",$id);
       $this->db->where("com_model_log.policy_type",$policy_type);
       return $this->db->get()->result();
   }
   
   public function fetch_e_two_wheeler_varient_name($id,$policy_type)
   {
       $this->db->select("list_of_e_two_wheeler_varient.*");
       $this->db->from("list_of_e_two_wheeler_varient");
       //$this->db->join("com_varient_log","com_model_log.make_id = list_of_bike_brand.id");
       //$this->db->join("com_varient_log","com_model_log.model_id = list_of_bike_model.id");
       $this->db->join("com_varient_log","com_varient_log.varient_id = list_of_e_two_wheeler_varient.id");
       $this->db->where("com_varient_log.commission_id",$id);
       $this->db->where("com_varient_log.policy_type",$policy_type);
       return $this->db->get()->result();
   }
   
   // pc
   
   public function fetch_make_pc_brand($id,$policy_type)
   {
       $this->db->select("list_of_pc_vehicle_brand.*");
       $this->db->from("list_of_pc_vehicle_brand");
       $this->db->join("com_make_log","com_make_log.make = list_of_pc_vehicle_brand.id");
       $this->db->where("com_make_log.commission_id",$id);
       $this->db->where("com_make_log.policy_type",$policy_type);
       return $this->db->get()->result();
   }
   
   public function fetch_pc_model_name($id,$policy_type)
   {
       $this->db->select("list_of_pc_vehicle_model.*");
       $this->db->from("list_of_pc_vehicle_model");
       //$this->db->join("com_model_log","com_model_log.make_id = list_of_bike_brand.id");
       $this->db->join("com_model_log","com_model_log.model_id = list_of_pc_vehicle_model.id");
       $this->db->where("com_model_log.commission_id",$id);
       $this->db->where("com_model_log.policy_type",$policy_type);
       return $this->db->get()->result();
   }
   
   public function fetch_pc_varient_name($id,$policy_type)
   {
       $this->db->select("list_of_pc_vehicle_varient.*");
       $this->db->from("list_of_pc_vehicle_varient");
       //$this->db->join("com_varient_log","com_model_log.make_id = list_of_bike_brand.id");
       //$this->db->join("com_varient_log","com_model_log.model_id = list_of_bike_model.id");
       $this->db->join("com_varient_log","com_varient_log.varient_id = list_of_pc_vehicle_varient.id");
       $this->db->where("com_varient_log.commission_id",$id);
       $this->db->where("com_varient_log.policy_type",$policy_type);
       return $this->db->get()->result();
   }
   
   // gc
   
   public function fetch_make_gc_brand($id,$policy_type)
   {
       $this->db->select("list_of_gc_vehicle_brand.*");
       $this->db->from("list_of_gc_vehicle_brand");
       $this->db->join("com_make_log","com_make_log.make = list_of_gc_vehicle_brand.id");
       $this->db->where("com_make_log.commission_id",$id);
       $this->db->where("com_make_log.policy_type",$policy_type);
       return $this->db->get()->result();
   }
   
   public function fetch_gc_model_name($id,$policy_type)
   {
       $this->db->select("list_of_gc_vehicle_model.*");
       $this->db->from("list_of_gc_vehicle_model");
       //$this->db->join("com_model_log","com_model_log.make_id = list_of_bike_brand.id");
       $this->db->join("com_model_log","com_model_log.model_id = list_of_gc_vehicle_model.id");
       $this->db->where("com_model_log.commission_id",$id);
       $this->db->where("com_model_log.policy_type",$policy_type);
       return $this->db->get()->result();
   }
   
   public function fetch_gc_varient_name($id,$policy_type)
   {
       $this->db->select("list_of_gc_vehicle_varient.*");
        $this->db->from("list_of_gc_vehicle_varient");
       //$this->db->join("com_varient_log","com_model_log.make_id = list_of_bike_brand.id");
       //$this->db->join("com_varient_log","com_model_log.model_id = list_of_bike_model.id");
       $this->db->join("com_varient_log","com_varient_log.varient_id = list_of_gc_vehicle_varient.id");
       $this->db->where("com_varient_log.commission_id",$id);
       $this->db->where("com_varient_log.policy_type",$policy_type);
       return $this->db->get()->result();
   }
   
   public function fetch_make_misc_brand($id,$policy_type)
   {
       $this->db->select("list_of_misc_vehicle_brand.*");
       $this->db->from("list_of_misc_vehicle_brand");
       $this->db->join("com_make_log","com_make_log.make = list_of_misc_vehicle_brand.id");
       $this->db->where("com_make_log.commission_id",$id);
       $this->db->where("com_make_log.policy_type",$policy_type);
       return $this->db->get()->result();
   }
   
   public function fetch_make_scooter_brand($id,$policy_type)
   {
       $this->db->select("list_of_scooter_brand.*");
       $this->db->from("list_of_scooter_brand");
       $this->db->join("com_make_log","com_make_log.make = list_of_scooter_brand.id");
       $this->db->where("com_make_log.commission_id",$id);
       $this->db->where("com_make_log.policy_type",$policy_type);
       return $this->db->get()->result();
   }
   
   public function fetch_make_ambulance_brand($id,$policy_type)
   {
       $this->db->select("list_of_ambulance_brand.*");
       $this->db->from("list_of_ambulance_brand");
       $this->db->join("com_make_log","com_make_log.make = list_of_ambulance_brand.id");
       $this->db->where("com_make_log.commission_id",$id);
       $this->db->where("com_make_log.policy_type",$policy_type);
       return $this->db->get()->result();
   }
   
   public function fetch_misc_model_name($id,$policy_type)
   {
       $this->db->select("list_of_misc_vehicle_model.*");
       $this->db->from("list_of_misc_vehicle_model");
       //$this->db->join("com_model_log","com_model_log.make_id = list_of_bike_brand.id");
       $this->db->join("com_model_log","com_model_log.model_id = list_of_misc_vehicle_model.id");
       $this->db->where("com_model_log.commission_id",$id);
       $this->db->where("com_model_log.policy_type",$policy_type);
       return $this->db->get()->result();
   }
   
   public function fetch_scooter_model_name($id,$policy_type)
   {
       $this->db->select("list_of_scooter_model.*");
       $this->db->from("list_of_scooter_model");
       $this->db->join("com_model_log","com_model_log.model_id = list_of_scooter_model.id");
       $this->db->where("com_model_log.commission_id",$id);
       $this->db->where("com_model_log.policy_type",$policy_type);
       return $this->db->get()->result();
   }
   
   public function fetch_ambulance_model_name($id,$policy_type)
   {
       $this->db->select("list_of_ambulance_model.*");
       $this->db->from("list_of_ambulance_model");
       $this->db->join("com_model_log","com_model_log.model_id = list_of_ambulance_model.id");
       $this->db->where("com_model_log.commission_id",$id);
       $this->db->where("com_model_log.policy_type",$policy_type);
       return $this->db->get()->result();
   }
   
   public function fetch_misc_varient_name($id,$policy_type)
   {
       $this->db->select("list_of_misc_vehicle_varient.*");
        $this->db->from("list_of_misc_vehicle_varient");
       //$this->db->join("com_varient_log","com_model_log.make_id = list_of_bike_brand.id");
       //$this->db->join("com_varient_log","com_model_log.model_id = list_of_bike_model.id");
       $this->db->join("com_varient_log","com_varient_log.varient_id = list_of_misc_vehicle_varient.id");
       $this->db->where("com_varient_log.commission_id",$id);
       $this->db->where("com_varient_log.policy_type",$policy_type);
       return $this->db->get()->result();
   }
   
   public function fetch_scooter_varient_name($id,$policy_type)
   {
       $this->db->select("list_of_scooter_varient.*");
        $this->db->from("list_of_scooter_varient");
       //$this->db->join("com_varient_log","com_model_log.make_id = list_of_bike_brand.id");
       //$this->db->join("com_varient_log","com_model_log.model_id = list_of_bike_model.id");
       $this->db->join("com_varient_log","com_varient_log.varient_id = list_of_scooter_varient.id");
       $this->db->where("com_varient_log.commission_id",$id);
       $this->db->where("com_varient_log.policy_type",$policy_type);
       return $this->db->get()->result();
   }
   
   public function fetch_ambulance_varient_name($id,$policy_type)
   {
       $this->db->select("list_of_ambulance_varient.*");
        $this->db->from("list_of_ambulance_varient");
       //$this->db->join("com_varient_log","com_model_log.make_id = list_of_bike_brand.id");
       //$this->db->join("com_varient_log","com_model_log.model_id = list_of_bike_model.id");
       $this->db->join("com_varient_log","com_varient_log.varient_id = list_of_ambulance_varient.id");
       $this->db->where("com_varient_log.commission_id",$id);
       $this->db->where("com_varient_log.policy_type",$policy_type);
       return $this->db->get()->result();
   }
   
  public function fech_rto_details($id)
   {
       $this->db->where("commission_id",$id);
       return $this->db->get("commission_rto_log")->result();
   }
   
   public function get_city_rto($ins_rto)
   {
        if(in_array("chennai",$ins_rto) && in_array("Coimbatore",$ins_rto) && in_array("Madurai",$ins_rto))
  	    {
  	        $ins_rto_1 = array("chennai","madurai","coimbatore");
  	        $this->db->where_in("city",$ins_rto_1);
  	    }
  	    else if(in_array("chennai",$ins_rto) && in_array("Coimbatore",$ins_rto))
  	    {
  	         $ins_rto_1 = array("chennai","coimbatore");
  	         $this->db->where_in("city",$ins_rto_1);
  	    }
  	    else if(in_array("chennai",$ins_rto) && in_array("Madurai",$ins_rto))
  	    {
  	         $ins_rto_1 = array("chennai","madurai");
  	         $this->db->where_in("city",$ins_rto_1);
  	    }
  	    else if(in_array("Coimbatore",$ins_rto) && in_array("Madurai",$ins_rto))
  	    {
  	         $ins_rto_1 = array("madurai","coimbatore");
  	          $this->db->where_in("city",$ins_rto_1);
  	    }
  	    else if(in_array("chennai",$ins_rto))
  	    {
  	         $this->db->where("city","chennai");
  	    }
  	     else if(in_array("Madurai",$ins_rto))
  	    {
  	        $this->db->where("city","Madurai");
  	    }
  	    else if(in_array("Coimbatore",$ins_rto))
  	    {
  	        $this->db->where("city","Coimbatore");
  	    }
  	    else if(in_array("Bangalore",$ins_rto))
  	    {
  	        $this->db->where("city","Bangalore");
  	    }
  	    $this->db->where("rto_no !=","Chennai");
  	    $this->db->where("rto_no !=","Madurai");
  	    $this->db->where("rto_no !=","Coimbatore");
        $this->db->where("rto_no !=","All RTO");
        $this->db->where("rto_no !=","All TN");
        $this->db->where("rto_no !=","ROTN");
        $this->db->where("rto_no !=","All KA");
        $this->db->like('rto_no', 'TN');
        return $this->db->get("list_of_rto")->result();
   }
   
   
   public function get_ka_city_rto($ins_rto)
   {
  	    if(in_array("Bangalore",$ins_rto))
  	    {
  	        $this->db->where("city","Bangalore");
  	    }
  	    $this->db->where("rto_no !=","Bangalore");
        $this->db->where("rto_no !=","All KA");
        $this->db->like('rto_no', 'KA');
        return $this->db->get("list_of_rto")->result();
   }
   
   public function get_rto_no($ins_rto)
   {
       if($ins_rto != null)
       {
          $this->db->where_in("rto_no",$ins_rto);
          return $this->db->get("list_of_rto")->result();
       }
   }
   
   public function get_coimbatore_rto()
   {
       $this->db->where("rto_no !=","All RTO");
        $this->db->where("rto_no !=","All TN");
        $this->db->where("city","coimbatore");
         $this->db->where("rto_no !=","chennai");
        $this->db->where("rto_no !=","Coimbatore");
        $this->db->where("rto_no !=","Madurai");
        $this->db->where("rto_no !=","ROTN");
       return $this->db->get("list_of_rto")->result();
   }
   
    public function get_madurai_rto()
   {
        $this->db->where("city","madurai");
        $this->db->where("rto_no !=","All RTO");
        $this->db->where("rto_no !=","All TN");
         $this->db->where("rto_no !=","chennai");
        $this->db->where("rto_no !=","Coimbatore");
        $this->db->where("rto_no !=","Madurai");
        $this->db->where("rto_no !=","ROTN");
       return $this->db->get("list_of_rto")->result();
   }
   
   
   public function get_rotn_rto()
   {
       $this->db->like('rto_no', 'TN');
       $this->db->where("rto_no !=","All RTO");
        $this->db->where("rto_no !=","All TN");
       $this->db->where("city !=","chennai");
       $this->db->where("city !=","coimbatore");
       return $this->db->get("list_of_rto")->result();
   }
   
   public function get_all_tn_rto_list()
   {
        $this->db->like('rto_no', 'TN');
        $this->db->where("rto_no !=","All RTO");
        $this->db->where("rto_no !=","All TN");
        $this->db->where("rto_no !=","chennai");
        $this->db->where("rto_no !=","Coimbatore");
        $this->db->where("rto_no !=","Madurai");
        $this->db->where("rto_no !=","ROTN");
        return $this->db->get("list_of_rto")->result();
   }
   
   public function get_all_ka_rto_list()
   {
        $this->db->like('rto_no', 'KA');
        $this->db->where("rto_no !=","All RTO");
        $this->db->where("rto_no !=","All TN");
        $this->db->where("rto_no !=","chennai");
        $this->db->where("rto_no !=","Coimbatore");
        $this->db->where("rto_no !=","Madurai");
        $this->db->where("rto_no !=","ROTN");
        $this->db->where("rto_no !=","All KA");
        return $this->db->get("list_of_rto")->result();
   }
   
   public function get_all_rto_list()
   {
        $this->db->where("rto_no !=","All RTO");
        $this->db->where("rto_no !=","All TN");
        $this->db->where("rto_no !=","chennai");
        $this->db->where("rto_no !=","Coimbatore");
        $this->db->where("rto_no !=","Madurai");
        $this->db->where("rto_no !=","ROTN");
        return $this->db->get("list_of_rto")->result();
   }
   
   
   // nop 
   
   
   
   public function check_this_com_already_exits($insurer_company,$premium_c_type,$insurer_class,$business_type,$policy_type,$ins_state,$f_date,$to_date,$add_type)
   {
      	    $this->db->where("insurer_company",$insurer_company);
      	    $this->db->where("policy_premium_type",$premium_c_type);
      	    $this->db->where("class",$insurer_class);
      	    //$this->db->where("business_type",$business_type);
      	    $this->db->where("policy_type",$policy_type);
      	    
      	    if($ins_state != "All")
      	    {
      	         $this->db->where("state",$ins_state);
      	    }
      	    
      	    $this->db->where("type",$add_type);
      	    $this->db->where('(from_date <= "'.$f_date. '" AND  to_date >="'.$to_date.'")');
      	    return $this->db->get("company_payout_commission")->result();
  	}
   
    public function check_this_com_already_exits_by_commission_id($insurer_company,$premium_c_type,$insurer_class,$business_type,$policy_type,$ins_state,$f_date,$to_date,$add_type,$commission_id)
  	{
  	    if($commission_id != null)
  	    {
      	    $this->db->where("insurer_company",$insurer_company);
      	    $this->db->where("policy_premium_type",$premium_c_type);
      	    $this->db->where("class",$insurer_class);
      	    //$this->db->where("business_type",$business_type);
      	    $this->db->where("policy_type",$policy_type);
      	    $this->db->where("state",$ins_state);
      	    $this->db->where("type",$add_type);
      	    $this->db->where_in("id",$commission_id);
      	    return $this->db->get("company_payout_commission")->result();
  	    }
  	    else
  	    {
  	        return array();
  	    }
  	}
  	
  	
  	 public function edit_check_this_com_already_exits_by_commission_id($insurer_company,$premium_c_type,$insurer_class,$business_type,$policy_type,$ins_state,$f_date,$to_date,$add_type,$commission_id,$add_type1)
  	{
  	    if($commission_id != null)
  	    {
      	    $this->db->where("insurer_company",$insurer_company);
      	    $this->db->where("policy_premium_type",$premium_c_type);
      	    $this->db->where("class",$insurer_class);
      	    //$this->db->where("business_type",$business_type);
      	    $this->db->where("policy_type",$policy_type);
      	    $this->db->where("state",$ins_state);
      	    $this->db->where("type",$add_type);
      	    $this->db->where_in("id",$commission_id);
      	    return $this->db->get("company_payout_commission")->result();
  	    }
  	    else
  	    {
  	        return array();
  	    }
  	}
  	
  	public function check_nop_already_exits($insurer_company,$premium_c_type,$insurer_class,$business_type,$policy_type,$ins_state,$fuel_type,$condition,$no_policy)
  	{
  	    $this->db->where("insurer_company",$insurer_company);
  	    $this->db->where("policy_premium_type",$premium_c_type);
  	    $this->db->where("class",$insurer_class);
  	    $this->db->where("business_type",$business_type);
  	    $this->db->where("policy_type",$policy_type);
  	    $this->db->where("state",$ins_state);
  	    $this->db->where("fuel_type",$fuel_type);
  	    $this->db->where("condition_type",$condition);
  	    $this->db->where("no_of_policy",$no_policy);
  	    return $this->db->get("company_payout_commission")->result();
  	}
  	
  	public function check_target_amount_already_exits($insurer_company,$premium_c_type,$insurer_class,$business_type,$policy_type,$ins_state,$f_date,$to_date,$add_type)
  	{
  	    $this->db->where("insurer_company",$insurer_company);
  	    //$this->db->where("policy_premium_type",$premium_c_type);
  	    $this->db->where("class",$insurer_class);
  	    $this->db->where("business_type",$business_type);
  	    $this->db->where("policy_type",$policy_type);
  	    if($ins_state != "All")
  	    {
  	         $this->db->where("state",$ins_state);
  	    }
  	   $this->db->where('(from_date <= "'.$f_date. '" AND  to_date >="'.$to_date.'")');
  	    return $this->db->get("company_payout_commission")->result();
  	}
  	
  	
  	public function check_target_amount_already_exits_by_commission_id($insurer_company,$premium_c_type,$insurer_class,$business_type,$policy_type,$ins_state,$f_date,$to_date,$add_type,$commission_id)
  	{
      	  if($commission_id != null)
      	  {
                $this->db->where("insurer_company",$insurer_company);
                //$this->db->where("policy_premium_type",$premium_c_type);
                $this->db->where("class",$insurer_class);
                //$this->db->where("business_type",$business_type);
                $this->db->where("policy_type",$policy_type);
                $this->db->where("state",$ins_state);
                $this->db->where("type",$add_type);
                $this->db->where_in("id",$commission_id);
                $this->db->where('(from_date <= "'.$f_date. '" AND  to_date >="'.$to_date.'")');
                return $this->db->get("company_payout_commission")->result();
      	  }
      	  else
      	  {
      	      return array();
      	  }
  	}
   
   public function add_policy_id($arr)
   {
       $this->db->insert("no_of_policy",$arr);
       return true;
   }
    public function get_last_policy_id()
   {
       $this->db->order_by("policy_id", "desc");
       return $this->db->get("no_of_policy")->row();
   }
   
    public function check_policy_id_already_exits($no_policy_id)
   {
       $this->db->where("policy_id",$no_policy_id);
       return $this->db->get("no_of_policy")->row();
   }
   
   // delete
   
   public function delete_payout_commission_entry($id)
   {
       $this->db->where("id",$id);
       if($this->db->delete("company_payout_commission")){
           return true;
       }
       
       return false;
   }
   
   public function delete_make_log($id)
   {
       $this->db->where("commission_id",$id);
       if( $this->db->delete("com_make_log") ){
           return true;
       }
       
       return false;
   }
   
   public function delete_model_log($id)
   {
       $this->db->where("commission_id",$id);
       if( $this->db->delete("com_model_log") ) {
           return true;
       }
       
       return false;
   }
   
   public function delete_varient_log($id)
   {
       $this->db->where("commission_id",$id);
       if($this->db->delete("com_varient_log")){
           return true;
       }
       
       return false;
   }
   
   public function delete_rto_log($id)
   {
       $this->db->where("commission_id",$id);
       if( $this->db->delete("commission_rto_log") ) {
           return true;
       }
       
       return false;
   }
   
   public function payout_commission_excel()
   {
      $this->db->select("company_payout_commission.*,list_of_policy_type.policy_type as p_type,list_of_insurance_company.company_name,list_of_premium_cover_type.name as premium_name,type_of_bussiness.bussiness_type as b_type,commission_motor_gvw.to_gvw_cc,commission_motor_gvw.from_gvw_cc,commission_motor_gvw.classification,list_of_commision_state.name as commission_state,list_of_car_fuel_type.fuel_type,commission_type.type as c_type");
  	  $this->db->from("company_payout_commission");
  	  $this->db->join("list_of_insurance_company","list_of_insurance_company.id = company_payout_commission .insurer_company");
  	  $this->db->join("type_of_bussiness","type_of_bussiness.id = company_payout_commission .business_type");
  	  $this->db->join("list_of_policy_type","list_of_policy_type.id = company_payout_commission .policy_type");
  	  $this->db->join("list_of_premium_cover_type","list_of_premium_cover_type.id = company_payout_commission .policy_premium_type");
  	  $this->db->join("commission_motor_gvw","commission_motor_gvw.id = company_payout_commission .classification",'left');
  	  $this->db->join("list_of_car_fuel_type","list_of_car_fuel_type.id = company_payout_commission .fuel_type");
  	  $this->db->join("list_of_commision_state","list_of_commision_state.id = company_payout_commission .state");
  	  $this->db->join("commission_type","commission_type.id = company_payout_commission.commission_type");
  	  return $this->db->get()->result();
   }
   
   
   public function check_make_all_already_exits($commission_id,$policy_type)
   {
       if($commission_id != null)
       {
               $this->db->where_in("id",$commission_id);
               $this->db->where("policy_type",$policy_type);
               $this->db->where("v_make","all");
               return $this->db->get("company_payout_commission")->result();
               
       }
       else 
       {
           return array();
       }
   }
   
   public function check_model_all_already_exits($commission_id,$policy_type)
   {
       if($commission_id != null)
       {
            $this->db->where_in("id",$commission_id);
            $this->db->where("policy_type",$policy_type);
            $this->db->where("v_model","all");
            return $this->db->get("company_payout_commission")->result();
       }
       else
       {
         return array();
       }
   }
   
   public function check_varient_all_already_exits($commission_id,$policy_type)
   {
       if($commission_id != null)
       {
           $this->db->where_in("id",$commission_id);
           $this->db->where("policy_type",$policy_type);
           $this->db->where("v_varient","all");
           return $this->db->get("company_payout_commission")->result();
       }
       else
       {
          return array();
       }
   }
   
   //Ranjith
   
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
  	public function edit_check_vechi_age_already_exits($insurer_company,$premium_c_type,$insurer_class,$business_type,$policy_type,$ins_state,$f_date,$to_date,$id,$add_type, $payout_type = 'Fresh')
  	{
  	    $this->db->where("insurer_company",$insurer_company);
  	    $this->db->where("policy_premium_type",$premium_c_type);
  	    $this->db->where("class",$insurer_class);
  	    //$this->db->where("business_type",$business_type);
  	    $this->db->where("policy_type",$policy_type);
  	    $this->db->where("payout_type",$payout_type);
  	    $this->db->where("type",$add_type);
        if($ins_state != "All")
        {
        	 $this->db->where("state",$ins_state);
        }
  	    $this->db->where('(from_date <= "'.$f_date. '" AND  to_date >="'.$to_date.'")');
  	    $this->db->where("id !=",$id);
  	    return $this->db->get("company_payout_commission")->result();
  	}
  	
  	public function edit_payout_commission($data,$id)
  	{
      	$this->db->where("id",$id);
  		if($this->db->update("company_payout_commission",$data)){
  		    return true;
  		}
  		
  		return false;
  	}
  	public function delete_company_commission_make_list($id)
  	{
  	    $this->db->where("commission_id",$id);
        if($this->db->delete("com_make_log")){
            return true;
        }
        
        return false;
  	}
  	public function delete_company_commission_model_list($id)
  	{
  	    $this->db->where("commission_id",$id);
        if($this->db->delete("com_model_log")){
            return true;
        }
        
        return false;
  	}
  	public function delete_company_commission_varient_list($id)
  	{
  	    $this->db->where("commission_id",$id);
        if($this->db->delete("com_varient_log")){
            return true;
        }
        
        return false;
  	}
  	public function delete_company_rto_log($id)
  	{
  	     $this->db->where("commission_id",$id);
        if($this->db->delete("commission_rto_log")){
            return true;
        }
        
        return false;
  	}
  	
   public function fetch_seating_classification($policy_type)
  	{
  	    $this->db->where("policy_type",$policy_type);
  	    return $this->db->get("pcv_seating")->result();
  	}
   
   public function fetch_seating_classification_com($classifi_id,$policy_type,$commission_id)
   {
       $this->db->where_in("id",$commission_id);
       $this->db->where("policy_type",$policy_type);
       $this->db->where("classification",$classifi_id);
       return $this->db->get("company_payout_commission")->num_rows();
   }
   
   public function get_classification($commission_id,$classifi_id,$policy_type)
   {
       if($commission_id != null)
       {
           $this->db->where_in("id",$commission_id);
           $this->db->where("policy_type",$policy_type);
           $this->db->where("classification",$classifi_id);
           return $this->db->get("company_payout_commission")->result();
       }
       else
       {
           return array();
       }
      
   }
   
   
   public function get_last_net_premium_id()
   {
       $this->db->select_max('net_premium_id');
       return $this->db->get("net_premium")->row();
   }
   
   
   public function add_payout_grid($data)
   {
       if($this->db->insert("company_payout_grid",$data)){
           return true;
       }
       
       return false;
   }
   
   public function fetch_payout_grid()
   {
       $this->db->select("company_payout_grid.*,list_of_policy_type.policy_type as p_type,list_of_class.class as ins_class");
       $this->db->from("company_payout_grid");
       $this->db->join("list_of_class","list_of_class.id = company_payout_grid.class");
       $this->db->join("list_of_policy_type","list_of_policy_type.id = company_payout_grid .policy_type");
       return $this->db->get()->result();
   }
   
   public function fetch_edit_payout_grid($id)
   {
       $this->db->where("id",$id);
       return $this->db->get("company_payout_grid")->row();
   }
   
   public function update_payout_grid($data,$id)
   {
       $this->db->where("id",$id);
       if($this->db->update("company_payout_grid",$data)){
           return true;
       }
   }
   
   public function get_net_id($commission_id)
   {
       $this->db->where_in("id",$commission_id);
       return $this->db->get("company_payout_commission")->row();
   }
   
  public function add_net_premium_id($arr)
   {
       $this->db->insert("net_premium",$arr);
       return true;
   }
   
   // target amount
   
   public function edit_check_target_amount_already_exits($insurer_company,$premium_c_type,$insurer_class,$business_type,$policy_type,$ins_state,$f_date,$to_date,$id,$add_type)
  	{
  	    $this->db->where("insurer_company",$insurer_company);
  	    //$this->db->where("policy_premium_type",$premium_c_type);
  	    $this->db->where("class",$insurer_class);
  	    $this->db->where("business_type",$business_type);
  	    $this->db->where("policy_type",$policy_type);
  	    $this->db->where("type",$add_type);
        if($ins_state != "All")
        {
        	 $this->db->where("state",$ins_state);
        }
  	    $this->db->where('(from_date <= "'.$f_date. '" AND  to_date >="'.$to_date.'")');
  	    $this->db->where("id !=",$id);
  	    return $this->db->get("company_payout_commission")->result();
  	}
  	
  	public function get_rto($ins_rto)
  	{
  	    $this->db->like('rto_no', "TN");
  	    
  	    if(in_array("chennai",$ins_rto))
  	    {
  	        $this->db->where('city !=', "chennai");
  	    }
  	    if(in_array("Coimbatore",$ins_rto))
  	    {
  	         $this->db->where('city !=', "Coimbatore");
  	    }
  	    if(in_array("Madurai",$ins_rto))
  	    {
  	        $this->db->where('city !=', "Madurai");
  	    }
  	    $this->db->where('city !=', "ROTN(Expect Chennai)");
  	    $this->db->where('city !=', "All TN");
        $this->db->where_not_in('rto_no', $ins_rto);
  	    return $this->db->get("list_of_rto")->result();
  	}
  	
  	public function get_rto_ka($ins_rto)
  	{
  	    $this->db->like('rto_no', "KA");
  	    
  	    if(in_array("Bangalore",$ins_rto))
  	    {
  	        $this->db->where('city !=', "Bangalore");
  	    }
  	    $this->db->where('city !=', "All KA");
        $this->db->where_not_in('rto_no', $ins_rto);
  	    return $this->db->get("list_of_rto")->result();
  	}
   
   public function get_no_of_policy_id($commission_id)
   {
       if($commission_id != null)
       {
           $this->db->where_in("id",$commission_id);
           return $this->db->get("company_payout_commission")->row();
       }
       else
       {
           return array();
       }
   }
   
    public function get_policy_cover_type()
   {
       return $this->db->get("list_of_premium_cover_type")->result();
   }
   
   public function filter_payout_commission($insurer,$policy_type,$make,$model,$varient,$rto,$f_date,$to_date)
    {
      $this->db->select("company_payout_commission.*,list_of_insurance_company.company_name,list_of_policy_type.policy_type as p_type,list_of_premium_cover_type.name as premium_name,commission_motor_gvw.motor_gvw as m_gvw,commission_motor_gvw.to_gvw_cc,commission_motor_gvw.from_gvw_cc,commission_motor_gvw.classification as classi,list_of_commision_state.name as commission_state,list_of_car_fuel_type.fuel_type,pcv_seating.seating_capacity");
  	  $this->db->from("company_payout_commission ");
  	  $this->db->join("list_of_insurance_company","list_of_insurance_company.id = company_payout_commission .insurer_company");
  	  $this->db->join("list_of_premium_cover_type","list_of_premium_cover_type.id = company_payout_commission .policy_premium_type");
  	  $this->db->join("commission_motor_gvw","commission_motor_gvw.id = company_payout_commission.classification",'left');
  	  $this->db->join("list_of_car_fuel_type","list_of_car_fuel_type.id = company_payout_commission .fuel_type");
  	  $this->db->join("list_of_policy_type","list_of_policy_type.id = company_payout_commission .policy_type");
  	  $this->db->join("pcv_seating","pcv_seating.id = company_payout_commission.classification",'left');
  	  $this->db->join("list_of_commision_state","list_of_commision_state.id = company_payout_commission .state");
  	 
  	  if($insurer !="all")
  	  {
  	      $this->db->where("company_payout_commission.insurer_company",$insurer);
  	  }
  	  if($policy_type != "all")
  	  {
  	      $this->db->where("company_payout_commission.policy_type",$policy_type);
  	  }
  	  if($make != "all")
  	  {
  	       $this->db->join("com_make_log","com_make_log.commission_id = company_payout_commission.id");
  	      $this->db->where("com_make_log.policy_type",$policy_type);
  	      $this->db->where("com_make_log.make",$make);
  	  }
  	  if($model !="all")
  	  {
  	       $this->db->join("com_model_log","com_model_log.commission_id = company_payout_commission.id",'left');
  	      $this->db->where("com_model_log.policy_type",$policy_type);
  	      $this->db->where("com_model_log.make_id",$make);
  	      $this->db->where("com_model_log.model_id",$model);
  	  }
  	  if($varient !="all")
  	  {
  	      $this->db->join("com_varient_log","com_varient_log.commission_id = company_payout_commission.id",'left');
  	      $this->db->where("com_varient_log.policy_type",$policy_type);
  	      $this->db->where("com_varient_log.make_id",$make);
  	      $this->db->where("com_varient_log.model_id",$model);
  	      $this->db->where("com_varient_log.varient_id",$varient);
  	  }
  	  if($rto !="all")
  	  {
  	       $this->db->join("commission_rto_log","commission_rto_log.commission_id = company_payout_commission.id");
  	      $this->db->where("commission_rto_log.rto",$rto);
  	  }
  	 $this->db->where('(company_payout_commission.from_date <= "'.$f_date. '" AND  company_payout_commission.to_date >="'.$to_date.'")');
  	  
  
  	  $this->db->where("company_payout_commission.class","1");
  	  return $this->db->get()->result();
    }
    
    // nop edit
    
    public function edit_check_this_com_already_exits($insurer_company,$premium_c_type,$insurer_class,$business_type,$policy_type,$ins_state,$f_date,$to_date,$id,$add_type)
  	{
  	    $this->db->where("insurer_company",$insurer_company);
  	    $this->db->where("policy_premium_type",$premium_c_type);
  	    $this->db->where("class",$insurer_class);
  	    //$this->db->where("business_type",$business_type);
  	    $this->db->where("policy_type",$policy_type);
        if($ins_state != "All")
        {
        	 $this->db->where("state",$ins_state);
        }
  	    $this->db->where("type",$add_type);
  	    $this->db->where('(from_date <= "'.$f_date. '" AND  to_date >="'.$to_date.'")');
  	    $this->db->where("id !=",$id);
  	    return $this->db->get("company_payout_commission")->result();
  	}
  	
  	// Health
  	
  	public function check_health_this_com_already_exits($insurer_company,$insurer_class,$business_type,$policy_type,$ins_state,$f_date,$to_date)
  	{
  	    $this->db->where("insurer_company",$insurer_company);
  	    $this->db->where("class",$insurer_class);
  	    $this->db->where("business_type",$business_type);
  	    $this->db->where("policy_type",$policy_type);
  	    
  	    if($ins_state != "All")
        {
        	 $this->db->where("state",$ins_state);
        }
  	   $this->db->where('(from_date <= "'.$f_date. '" AND  to_date >="'.$to_date.'")');
  	    return $this->db->get("company_payout_commission")->result();
  	}
  	
  	public function edit_check_health_this_com_already_exits($insurer_company,$insurer_class,$business_type,$policy_type,$ins_state,$f_date,$to_date,$id)
  	{
  	    $this->db->where("insurer_company",$insurer_company);
  	    $this->db->where("class",$insurer_class);
  	    $this->db->where("business_type",$business_type);
  	    $this->db->where("policy_type",$policy_type);
  	    $this->db->where("id !=",$id);
  	    
  	    if($ins_state != "All")
        {
        	 $this->db->where("state",$ins_state);
        }
  	   $this->db->where('(from_date <= "'.$f_date. '" AND  to_date >="'.$to_date.'")');
  	    return $this->db->get("company_payout_commission")->result();
  	}
  	
  	public function check_health_target_amount_already_exits($insurer_company,$insurer_class,$business_type,$policy_type,$f_date,$to_date)
  	{
  	    $this->db->where("insurer_company",$insurer_company);
  	    $this->db->where("class",$insurer_class);
  	    $this->db->where("business_type",$business_type);
  	    $this->db->where("policy_type",$policy_type);
  	    $this->db->where('(from_date <= "'.$f_date. '" AND  to_date >="'.$to_date.'")');
  	    return $this->db->get("company_payout_commission")->result();
  	}
  	
    public function edit_check_health_target_amount_already_exits($insurer_company,$insurer_class,$business_type,$policy_type,$f_date,$to_date,$id)
  	{
  	    $this->db->where("insurer_company",$insurer_company);
  	    $this->db->where("class",$insurer_class);
  	    $this->db->where("business_type",$business_type);
  	    $this->db->where("policy_type",$policy_type);
  	    $this->db->where('(from_date <= "'.$f_date. '" AND  to_date >="'.$to_date.'")');
  	    $this->db->where("id !=",$id);
  	    return $this->db->get("company_payout_commission")->result();
  	}
  	
  
  	
  	public function remove_all_rto($id)
  	{
  	    $this->db->where("commission_id",$id);
  	    if($this->db->delete("commission_rto_log")){
  	        return true;
  	    }
  	    
  	    return false;
  	}
  	
    public function get_commission_details_by_id($id)
    {
        $this->db->where_in("id",$id);
        return $this->db->get("company_payout_commission")->result();
    }
    
    
    public function get_old_payout_log($insurance_company,$ins_class,$business_type,$premium_c_type,$policy_type)
    {
        $this->db->where("insurer_company",$insurance_company);
        $this->db->where("policy_premium_type",$premium_c_type);
        $this->db->where("class",$ins_class);
        $this->db->where("business_type",$business_type);
        $this->db->where("policy_type",$policy_type);
        $this->db->order_by('from_date','Desc');
        return $this->db->get("company_payout_commission")->result();
    }
    
    public function fetch_policy_type_using_class($class)
    {
        $this->db->where("policy_class",$class);
        return $this->db->get("list_of_policy_type")->result();
    }
    
    //new
    
    public function get_old_entry($insurer_company,$policy_type,$f_date,$to_date,$commission_type)
    {
        $this->db->select("company_payout_commission.*,list_of_premium_cover_type.name as pc_type,list_of_car_fuel_type.fuel_type as fuel,commission_motor_gvw.to_gvw_cc,commission_motor_gvw.from_gvw_cc,commission_motor_gvw.classification");
        $this->db->from("company_payout_commission");
        $this->db->join("list_of_premium_cover_type","list_of_premium_cover_type.id = company_payout_commission.policy_premium_type");
  	    $this->db->join("list_of_car_fuel_type","list_of_car_fuel_type.id = company_payout_commission .fuel_type");
  	    $this->db->join("commission_motor_gvw","commission_motor_gvw.id = company_payout_commission.classification",'left');
        $this->db->where("company_payout_commission.insurer_company",$insurer_company);
        $this->db->where("company_payout_commission.class","1");
        $this->db->where("company_payout_commission.policy_type",$policy_type);
        $this->db->where("company_payout_commission.commission_type",$commission_type);
        $this->db->where("company_payout_commission.from_date >=",$f_date);
        $this->db->where("company_payout_commission.to_date <=",$to_date);
        $this->db->order_by("id", "desc");
        return $this->db->get()->result();
    }
    
    public function load_all_rto($id)
    {
        $this->db->where("commission_id",$id);
        return $this->db->get("commission_rto_log")->result();
    }
    
    public function load_all_varient($id)
    {
       $this->db->where("commission_id",$id);
       $this->db->group_by('policy_type'); 
       return $this->db->get("com_varient_log")->row();
    }
    
    public function load_all_varient_by_commission_id($id)
    {
        $this->db->where("commission_id",$id);
        return $this->db->get("com_varient_log")->result();
    }
    
  
  	public function load_agent_commission($id)
  	{
  	    $this->db->where("id",$id);
  	    return $this->db->get("company_payout_commission")->row();
  	}
  	
 /* 	public function fetch_payout_commission_entry_motor($class,$f_date,$to_date)
  	{
            $this->db->select("company_payout_commission.*,list_of_insurance_company.company_name,list_of_policy_type.policy_type as p_type,list_of_premium_cover_type.name as premium_name,commission_motor_gvw.motor_gvw as m_gvw,commission_motor_gvw.to_gvw_cc,commission_motor_gvw.from_gvw_cc,commission_motor_gvw.classification as classi,list_of_commision_state.name as commission_state,list_of_car_fuel_type.fuel_type,pcv_seating.seating_capacity");
            $this->db->from("company_payout_commission ");
            $this->db->join("list_of_insurance_company","list_of_insurance_company.id = company_payout_commission .insurer_company");
            $this->db->join("list_of_premium_cover_type","list_of_premium_cover_type.id = company_payout_commission .policy_premium_type");
            $this->db->join("commission_motor_gvw","commission_motor_gvw.id = company_payout_commission.classification",'left');
            $this->db->join("list_of_car_fuel_type","list_of_car_fuel_type.id = company_payout_commission .fuel_type");
            $this->db->join("list_of_policy_type","list_of_policy_type.id = company_payout_commission .policy_type");
            $this->db->join("pcv_seating","pcv_seating.id = company_payout_commission .classification",'left');
            $this->db->join("list_of_commision_state","list_of_commision_state.id = company_payout_commission .state",'left');
            $this->db->order_by("list_of_insurance_company.company_name", "asc");
            $this->db->where("company_payout_commission.class",$class);
            
            
            
            if($f_date != "" && $to_date != "")
            {
                $this->db->where("company_payout_commission.from_date >=",$f_date);
                $this->db->where("company_payout_commission.to_date <=",$to_date);
            }
            $this->db->group_by(array("company_payout_commission.insurer_company", "company_payout_commission.policy_premium_type",'company_payout_commission.type'));
           

            //return $this->db->get()->result();
            return $this->db->get_compiled_select("list_of_leads");
  	}
  	*/
  	
  	public function fetch_payout_commission_entry_motor($class, $f_date, $to_date)
{
    $this->db->select("company_payout_commission.class,
                       company_payout_commission.payout_type,
                       company_payout_commission.insurer_company,
                       company_payout_commission.policy_premium_type,
                       company_payout_commission.policy_type,
                       company_payout_commission.type,
                       company_payout_commission.business_type,
                       company_payout_commission.id,
                       list_of_insurance_company.company_name,
                       pcv_seating.seating_capacity,
                       commission_motor_gvw.from_gvw_cc,
                       commission_motor_gvw.classification as classi, 
                       commission_motor_gvw.to_gvw_cc, 
                       list_of_policy_type.policy_type as p_type,
                       list_of_premium_cover_type.name as premium_name,  
                       commission_motor_gvw.motor_gvw as m_gvw,   
                       list_of_commision_state.name as commission_state,
                       list_of_car_fuel_type.fuel_type");
    
    $this->db->from("company_payout_commission");
    
    // Joining the necessary tables
    $this->db->join("list_of_insurance_company", "list_of_insurance_company.id = company_payout_commission.insurer_company");
    $this->db->join("list_of_premium_cover_type", "list_of_premium_cover_type.id = company_payout_commission.policy_premium_type");
    $this->db->join("commission_motor_gvw", "commission_motor_gvw.id = company_payout_commission.classification", 'left');
    $this->db->join("list_of_car_fuel_type", "list_of_car_fuel_type.id = company_payout_commission.fuel_type");
    $this->db->join("list_of_policy_type", "list_of_policy_type.id = company_payout_commission.policy_type");
    $this->db->join("pcv_seating", "pcv_seating.id = company_payout_commission.classification", 'left');
    $this->db->join("list_of_commision_state", "list_of_commision_state.id = company_payout_commission.state", 'left');
    
    $this->db->order_by("list_of_insurance_company.company_name", "asc");

    // Filtering based on the class and dates
    $this->db->where("company_payout_commission.class", $class);
    
    if ($f_date != "" && $to_date != "") {
        $this->db->where("company_payout_commission.from_date >=", $f_date);
        $this->db->where("company_payout_commission.to_date <=", $to_date);
    }

    // Grouping by the necessary fields
    $this->db->group_by(array(
        "company_payout_commission.class", 
        "company_payout_commission.payout_type",
        "company_payout_commission.insurer_company",
        "company_payout_commission.policy_premium_type",
        "company_payout_commission.policy_type",
        "company_payout_commission.type",
        "company_payout_commission.business_type",
        "company_payout_commission.id",
        "list_of_insurance_company.company_name",
        "pcv_seating.seating_capacity",
        "commission_motor_gvw.from_gvw_cc",
        "commission_motor_gvw.classification",
        "commission_motor_gvw.to_gvw_cc",
        "list_of_policy_type.policy_type",
        "list_of_premium_cover_type.name",
        "commission_motor_gvw.motor_gvw",
        "list_of_commision_state.name",
        "list_of_car_fuel_type.fuel_type"
    ));
    
    // Return the query result
    return $this->db->get()->result();
   // return $this->db->get_compiled_select();
}

  	
  	public function view_payout_commission_entry($ins_company,$p_cover,$policy_type,$type,$f_date,$to_date)
  	{
      	 $this->db->select("company_payout_commission.*,list_of_policy_type.policy_type as p_type,list_of_insurance_company.company_name,list_of_premium_cover_type.name as premium_name,type_of_bussiness.bussiness_type as b_type,commission_motor_gvw.to_gvw_cc,commission_motor_gvw.from_gvw_cc,commission_motor_gvw.classification,list_of_commision_state.name as commission_state,list_of_car_fuel_type.fuel_type,commission_type.type as c_type");
      	  $this->db->from("company_payout_commission");
      	  $this->db->join("list_of_insurance_company","list_of_insurance_company.id = company_payout_commission .insurer_company");
      	  $this->db->join("type_of_bussiness","type_of_bussiness.id = company_payout_commission .business_type",'left');
      	  $this->db->join("list_of_policy_type","list_of_policy_type.id = company_payout_commission .policy_type");
      	  $this->db->join("list_of_premium_cover_type","list_of_premium_cover_type.id = company_payout_commission .policy_premium_type");
      	  $this->db->join("commission_motor_gvw","commission_motor_gvw.id = company_payout_commission .classification",'left');
      	  $this->db->join("list_of_car_fuel_type","list_of_car_fuel_type.id = company_payout_commission .fuel_type");
      	  $this->db->join("list_of_commision_state","list_of_commision_state.id = company_payout_commission .state",'left');
      	  $this->db->join("commission_type","commission_type.id = company_payout_commission.commission_type");
      	  $this->db->where("company_payout_commission.insurer_company",$ins_company);
      	  $this->db->where("company_payout_commission.policy_premium_type",$p_cover);
      	  $this->db->where("company_payout_commission.policy_type",$policy_type);
      	  $this->db->where("company_payout_commission.type",$type);
            if($f_date != "" && $to_date != "")
            {
                $this->db->where("company_payout_commission.from_date >=",$f_date);
                $this->db->where("company_payout_commission.to_date <=",$to_date);
            }
      	  $this->db->order_by("company_payout_commission.id", "desc");
      	  return $this->db->get()->result();
  	}
  	
  	
  	public function get_payout_entry_by_id($id)
  	{
  	    $this->db->where("id",$id);
  	    return $this->db->get("company_payout_commission")->row();
  	}
  	
  	public function get_make($id)
  	{
  	    $this->db->where("commission_id",$id);
  	    return $this->db->get("com_make_log")->result();
  	}
  	
  	public function get_model1($id)
  	{
  	    $this->db->where("commission_id",$id);
  	    return $this->db->get("com_model_log")->result();
  	}
  	
  	public function get_varient($id)
  	{
  	    $this->db->where("commission_id",$id);
  	    return $this->db->get("com_varient_log")->result();
  	}
  	
  	public function get_rto1($id)
  	{
  	    $this->db->where("commission_id",$id);
  	    return $this->db->get("commission_rto_log")->result();
  	}
  	
  	public function view_health_payout_commission_entry($ins_company,$policy_type,$business_type,$f_date,$to_date)
  	{
            $this->db->select("company_payout_commission.*,list_of_policy_type.policy_type as p_type,list_of_insurance_company.company_name,type_of_bussiness.bussiness_type as b_type,list_of_commision_state.name as commission_state,commission_type.type as ctype");
            $this->db->from("company_payout_commission");
            $this->db->join("list_of_insurance_company","list_of_insurance_company.id = company_payout_commission.insurer_company");
            $this->db->join("commission_type","commission_type.id = company_payout_commission.commission_type");
            $this->db->join("type_of_bussiness","type_of_bussiness.id = company_payout_commission .business_type",'left');
            $this->db->join("list_of_policy_type","list_of_policy_type.id = company_payout_commission.policy_type");
            $this->db->join("list_of_commision_state","list_of_commision_state.id = company_payout_commission .state",'left');
            $this->db->where("company_payout_commission.insurer_company",$ins_company);
            $this->db->where("company_payout_commission.policy_type",$policy_type);
            $this->db->where("company_payout_commission.business_type",$business_type);
            
            if($f_date != "" && $to_date != "")
            {
                $this->db->where("company_payout_commission.from_date >=",$f_date);
                $this->db->where("company_payout_commission.to_date <=",$to_date);
            }
            
      	  $this->db->order_by("company_payout_commission.id", "desc");
      	  return $this->db->get()->result();
  	}
  	
  	public function edit_health_commission_entry($id)
  	{
  	     $this->db->where("id",$id);
  	    return $this->db->get("company_payout_commission")->row();
  	}
  	public function get_state_wise_payout_commission($state,$from_date,$to_date,$rto_type)
  	{
  	    $this->db->where("state",$state);
  	    $this->db->where("from_date >=",$from_date);
  	    $this->db->where("to_date <=",$to_date);
  	    $this->db->where("rto_type",$rto_type);
  	    return $this->db->get("company_payout_commission")->result();
  	}
  	
  	public function insert_rto($data)
  	{
  	    if($this->db->insert("commission_rto_log",$data)){
  	        return true;
  	    }
  	    
  	    return false;
  	}
  	
  	// Extra com pay
  	
  	public function add_extra_commission_payout($data)
  	{
  	    $this->db->insert("extra_commission",$data);
  	    return $this->db->insert_id();
  	}
  	
  	public function extra_commission_policy_type($data)
  	{
  	    if($this->db->insert("extra_commission_policy_types",$data)){
  	        return true;
  	    }
  	    
  	    return false;
  	}
  	
  	public function extra_commission_policy_covers($data)
  	{
  	    if($this->db->insert("extra_commission_covers",$data)){
  	        return true;
  	    }
  	    
  	    return false;
  	}
  	
  	public function get_pos_and_agents()
  	{
  	    return $this->db->get("list_of_pos_and_agents")->result();
  	}
  	
  	public function fetch_extra_commission()
  	{
  	    $this->db->select("extra_commission.*,list_of_pos_and_agents.name as agn_name,list_of_pos_and_agents.agent_pos_code as agn_code,admin_login.name as created_name,list_of_insurance_company.company_name as company");
  	    $this->db->from("extra_commission");
  	    $this->db->join("list_of_pos_and_agents","list_of_pos_and_agents.id = extra_commission.agent_id");
  	    $this->db->join("list_of_insurance_company","list_of_insurance_company.id = extra_commission.insurer");
  	    $this->db->join("admin_login","admin_login.id = extra_commission.created_by");
  	    $this->db->group_by("extra_commission.agent_id");
  	    $this->db->group_by("extra_commission.insurer");
  	    return $this->db->get()->result();
  	}
  	
  	
  	public function check_extra_com_already_exits($agent,$month,$policy_type,$policy_c_type)
  	{
  	    $this->db->select("extra_commission.*");
  	    $this->db->from("extra_commission");
  	    $this->db->join("extra_commission_covers","extra_commission_covers.com_id = extra_commission.id");
  	    $this->db->join("extra_commission_policy_types","extra_commission_policy_types.com_id = extra_commission.id");
  	    $this->db->where("extra_commission.agent_id",$agent);
  	    $this->db->where("extra_commission.month",$month);
  	    $this->db->where("extra_commission_covers.policy_cover",$policy_c_type);
  	    $this->db->where("extra_commission_policy_types.policy_type",$policy_type);
  	    return $this->db->get()->num_rows();
  	}
  	
  	public function fetch_agent_extra_com_details($agent_id,$month)
  	{
  	    $this->db->select("extra_commission.*,list_of_policy_type.policy_type as p_type");
  	    $this->db->from("extra_commission");
  	    $this->db->join("extra_commission_policy_types","extra_commission_policy_types.com_id = extra_commission.id");
  	    $this->db->join("list_of_policy_type","list_of_policy_type.id = extra_commission_policy_types.policy_type");
  	    $this->db->where("extra_commission.agent_id",$agent_id);
  	    $this->db->where("extra_commission.month",$month);
  	    return $this->db->get()->result();
  	}
  	
  	public function get_policy_cover_types($com_id)
  	{
  	    $this->db->select("extra_commission_covers.*,list_of_premium_cover_type.name as pc_name");
  	    $this->db->from("extra_commission_covers");
  	    $this->db->join("list_of_premium_cover_type","list_of_premium_cover_type.id = extra_commission_covers.policy_cover");
  	    $this->db->where("extra_commission_covers.com_id",$com_id);
  	    return $this->db->get()->row();
  	}
  	
  	public function list_of_pos_and_agents()
  	{
  	    return $this->db->get("list_of_pos_and_agents")->result();
  	}
  	
  	public function add_agents_special_com($data_agency)
  	{
  	  if($this->db->insert("agent_special_com",$data_agency)){
  	      return true;
  	  }
  	  
  	  return false;
  	}
  	
  	public function fetch_select_agent_using_commission_id($id)
  	{
  	     $this->db->where("commission_id",$id);
  	    return $this->db->get("agent_special_com")->result();
  	}
  	
  	public function edit_agents_special_com($data_agency,$id)
   {
       $this->db->where("commission_id",$id);
       $this->db->update("agent_special_com",$data_agency);
       return true;
   }
   	public function delete_agent_commission_model_list($id)
  	{
  	     $this->db->where("commission_id",$id);
        if($this->db->delete("agent_special_com")){
            return true;
        }
        
        return false;
  	}
  	
    public function fetch_make_car_brands($id)
    {
        $this->db->select("list_of_car_brand.*");
        $this->db->from("list_of_car_brand");
        $this->db->join("com_make_log","com_make_log.make = list_of_car_brand.id");
        $this->db->where_in("com_make_log.commission_id",$id);
        //   $this->db->where_in("com_make_log.policy_type",$policy_type);
        return $this->db->get()->result();
    }
	  
    public function fetch_car_model_names($id)
    {
        $this->db->select("list_of_car_model.*");
        $this->db->from("list_of_car_model");
        $this->db->join("com_model_log","com_model_log.model_id = list_of_car_model.id");
        $this->db->where_in("com_model_log.commission_id",$id);
        //   $this->db->where_in("com_model_log.policy_type",$policy_type);
        return $this->db->get()->result();
    }
	  
    public function fetch_car_varient_names($id)
    {
        $this->db->select("list_of_car_varient.*");
        $this->db->from("list_of_car_varient");		 
        $this->db->join("com_varient_log","com_varient_log.varient_id = list_of_car_varient.id");
        $this->db->where_in("com_varient_log.commission_id",$id);
        //   $this->db->where_in("com_varient_log.policy_type",$policy_type);
        return $this->db->get()->result();
    }
	  
	  // bike 
	  
    public function fetch_make_bike_brands($id)
    {
        $this->db->select("list_of_bike_brand.*");
        $this->db->from("list_of_bike_brand");
        $this->db->join("com_make_log","com_make_log.make = list_of_bike_brand.id");
        $this->db->where_in("com_make_log.commission_id",$id);
        //   $this->db->where_in("com_make_log.policy_type",$policy_type);
        return $this->db->get()->result();
    }
	  
	  
	  
    public function fetch_bike_model_names($id)
    {
        $this->db->select("list_of_bike_model.*");
        $this->db->from("list_of_bike_model");
        $this->db->join("com_model_log","com_model_log.model_id = list_of_bike_model.id");
        $this->db->where_in("com_model_log.commission_id",$id);
        //   $this->db->where_in("com_model_log.policy_type",$policy_type);
        return $this->db->get()->result();
    }
	  
    public function fetch_bike_varient_names($id)
    {
        $this->db->select("list_of_bike_varient.*");
        $this->db->from("list_of_bike_varient");
        $this->db->join("com_varient_log","com_varient_log.varient_id = list_of_bike_varient.id");
        $this->db->where_in("com_varient_log.commission_id",$id);
        //   $this->db->where("com_varient_log.policy_type",$policy_type);
        return $this->db->get()->result();
    }
	  
    // e two wheeler
	  
    public function fetch_make_e_two_wheeler_brands($id)
    {
        $this->db->select("list_of_e_two_wheeler_brand.*");
        $this->db->from("list_of_e_two_wheeler_brand");
        $this->db->join("com_make_log","com_make_log.make = list_of_e_two_wheeler_brand.id");
        $this->db->where_in("com_make_log.commission_id",$id);
        //   $this->db->where("com_make_log.policy_type",$policy_type);
        return $this->db->get()->result();
    }
	  
	  
	  
    public function fetch_e_two_wheeler_model_names($id)
    {
        $this->db->select("list_of_e_two_wheeler_model.*");
        $this->db->from("list_of_e_two_wheeler_model");
        $this->db->join("com_model_log","com_model_log.model_id = list_of_e_two_wheeler_model.id");
        $this->db->where_in("com_model_log.commission_id",$id);
        //   $this->db->where("com_model_log.policy_type",$policy_type);
        return $this->db->get()->result();
    }
	  
    public function fetch_e_two_wheeler_varient_names($id)
    {
        $this->db->select("list_of_e_two_wheeler_varient.*");
        $this->db->from("list_of_e_two_wheeler_varient");
        $this->db->join("com_varient_log","com_varient_log.varient_id = list_of_e_two_wheeler_varient.id");
        $this->db->where_in("com_varient_log.commission_id",$id);
        //   $this->db->where("com_varient_log.policy_type",$policy_type);
        return $this->db->get()->result();
    }
	  
	  // pc
	  
    public function fetch_make_pc_brands($id)
    {
        $this->db->select("list_of_pc_vehicle_brand.*");
        $this->db->from("list_of_pc_vehicle_brand");
        $this->db->join("com_make_log","com_make_log.make = list_of_pc_vehicle_brand.id");
        $this->db->where_in("com_make_log.commission_id",$id);
        //   $this->db->where("com_make_log.policy_type",$policy_type);
        return $this->db->get()->result();
    }
	  
    public function fetch_pc_model_names($id,$policy_type)
    {
        $this->db->select("list_of_pc_vehicle_model.*");
        $this->db->from("list_of_pc_vehicle_model");
        $this->db->join("com_model_log","com_model_log.model_id = list_of_pc_vehicle_model.id");
        $this->db->where_in("com_model_log.commission_id",$id);
        //   $this->db->where("com_model_log.policy_type",$policy_type);
        return $this->db->get()->result();
    }
	  
    public function fetch_pc_varient_names($id)
    {
        $this->db->select("list_of_pc_vehicle_varient.*");
        $this->db->from("list_of_pc_vehicle_varient");
        $this->db->join("com_varient_log","com_varient_log.varient_id = list_of_pc_vehicle_varient.id");
        $this->db->where_in("com_varient_log.commission_id",$id);
        //   $this->db->where("com_varient_log.policy_type",$policy_type);
        return $this->db->get()->result();
    }
	  
	  // gc
	  
    public function fetch_make_gc_brands($id)
    {
        $this->db->select("list_of_gc_vehicle_brand.*");
        $this->db->from("list_of_gc_vehicle_brand");
        $this->db->join("com_make_log","com_make_log.make = list_of_gc_vehicle_brand.id");
        $this->db->where_in("com_make_log.commission_id",$id);
        //   $this->db->where("com_make_log.policy_type",$policy_type);
        return $this->db->get()->result();
    }
	  
    public function fetch_gc_model_names($id)
    {
        $this->db->select("list_of_gc_vehicle_model.*");
        $this->db->from("list_of_gc_vehicle_model");
        $this->db->join("com_model_log","com_model_log.model_id = list_of_gc_vehicle_model.id");
        $this->db->where_in("com_model_log.commission_id",$id);
        //   $this->db->where("com_model_log.policy_type",$policy_type);
        return $this->db->get()->result();
    }
	  
    public function fetch_gc_varient_names($id)
    {
        $this->db->select("list_of_gc_vehicle_varient.*");
        $this->db->from("list_of_gc_vehicle_varient");
        $this->db->join("com_varient_log","com_varient_log.varient_id = list_of_gc_vehicle_varient.id");
        $this->db->where_in("com_varient_log.commission_id",$id);
        //   $this->db->where("com_varient_log.policy_type",$policy_type);
        return $this->db->get()->result();
    }
	  
    public function fetch_make_misc_brands($id)
    {
        $this->db->select("list_of_misc_vehicle_brand.*");
        $this->db->from("list_of_misc_vehicle_brand");
        $this->db->join("com_make_log","com_make_log.make = list_of_misc_vehicle_brand.id");
        $this->db->where_in("com_make_log.commission_id",$id);
        //   $this->db->where("com_make_log.policy_type",$policy_type);
        return $this->db->get()->result();
    }
	  
    public function fetch_make_scooter_brands($id)
    {
        $this->db->select("list_of_scooter_brand.*");
        $this->db->from("list_of_scooter_brand");
        $this->db->join("com_make_log","com_make_log.make = list_of_scooter_brand.id");
        $this->db->where_in("com_make_log.commission_id",$id);
        //   $this->db->where("com_make_log.policy_type",$policy_type);
        return $this->db->get()->result();
    }
	  
    public function fetch_make_ambulance_brands($id)
    {
        $this->db->select("list_of_ambulance_brand.*");
        $this->db->from("list_of_ambulance_brand");
        $this->db->join("com_make_log","com_make_log.make = list_of_ambulance_brand.id");
        $this->db->where_in("com_make_log.commission_id",$id);
        //   $this->db->where("com_make_log.policy_type",$policy_type);
        return $this->db->get()->result();
    }
	  
    public function fetch_misc_model_names($id)
    {
        $this->db->select("list_of_misc_vehicle_model.*");
        $this->db->from("list_of_misc_vehicle_model");
        $this->db->join("com_model_log","com_model_log.model_id = list_of_misc_vehicle_model.id");
        $this->db->where_in("com_model_log.commission_id",$id);
        //   $this->db->where("com_model_log.policy_type",$policy_type);
        return $this->db->get()->result();
    }
	  
    public function fetch_scooter_model_names($id)
    {
        $this->db->select("list_of_scooter_model.*");
        $this->db->from("list_of_scooter_model");
        $this->db->join("com_model_log","com_model_log.model_id = list_of_scooter_model.id");
        $this->db->where_in("com_model_log.commission_id",$id);
        //   $this->db->where("com_model_log.policy_type",$policy_type);
        return $this->db->get()->result();
    }
	  
    public function fetch_ambulance_model_names($id)
    {
        $this->db->select("list_of_ambulance_model.*");
        $this->db->from("list_of_ambulance_model");
        $this->db->join("com_model_log","com_model_log.model_id = list_of_ambulance_model.id");
        $this->db->where_in("com_model_log.commission_id",$id);
        //   $this->db->where("com_model_log.policy_type",$policy_type);
        return $this->db->get()->result();
    }
	  
    public function fetch_misc_varient_names($id)
    {
        $this->db->select("list_of_misc_vehicle_varient.*");
        $this->db->from("list_of_misc_vehicle_varient");
        $this->db->join("com_varient_log","com_varient_log.varient_id = list_of_misc_vehicle_varient.id");
        $this->db->where_in("com_varient_log.commission_id",$id);
        //   $this->db->where("com_varient_log.policy_type",$policy_type);
        return $this->db->get()->result();
    }
	  
    public function fetch_scooter_varient_names($id)
    {
        $this->db->select("list_of_scooter_varient.*");
        $this->db->from("list_of_scooter_varient");
        $this->db->join("com_varient_log","com_varient_log.varient_id = list_of_scooter_varient.id");
        $this->db->where_in("com_varient_log.commission_id",$id);
        //   $this->db->where("com_varient_log.policy_type",$policy_type);
        return $this->db->get()->result();
    }
	  
    public function fetch_ambulance_varient_names($id)
    {
        $this->db->select("list_of_ambulance_varient.*");
        $this->db->from("list_of_ambulance_varient");
        $this->db->join("com_varient_log","com_varient_log.varient_id = list_of_ambulance_varient.id");
        $this->db->where_in("com_varient_log.commission_id",$id);
        //   $this->db->where("com_varient_log.policy_type",$policy_type);
        return $this->db->get()->result();
    }

	public function get_rto_details($id)
   	{
    	$this->db->where_in("commission_id",$id);
		return $this->db->get("commission_rto_log")->result();
   	}
}
